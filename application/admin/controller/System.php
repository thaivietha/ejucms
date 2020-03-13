<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\admin\controller;
use think\Db;
use think\Cache;
use think\Request;
use think\Page;

class System extends Base
{
    // 选项卡是否显示
    public $tabase = '';
    
    public function _initialize() {
        parent::_initialize();
        $this->tabase = input('param.tabase/d');
    }

    public function index()
    {
        $this->redirect(url('System/web'));
    }
    //问答配置
    public function question(){
        $inc_type =  'question';
        $config = tpCache($inc_type);
        if (IS_POST) {
            $param = input('post.');
            if (empty($param['typename'])){
                $this->error("栏目标题不能为空");
            }
            Db::name("arctype")->where("channeltype=-1 and current_channel=-1")->setField(['typename'=>$param['typename']]);
            if ($param['question_status']){
                $r = Db::name("arctype")->where("current_channel=-1 and channeltype=-1")->update([
                    'is_hidden' => 0,
                    'update_time'   => getTime(),
                ]);
            }else{
                $r = Db::name("arctype")->where("current_channel=-1 and channeltype=-1")->update([
                    'is_hidden' => 1,
                    'update_time'   => getTime(),
                ]);
            }
            if ($r !== false){
                if (isset($config['question_status']) && $config['question_status'] != $param['question_status']){
                    Db::name("navig_list")->where("navig_url='home_Ask_index'")->save(['status'=>$param['question_status']]);
                    // 清除logic逻辑定义的缓存
                    extra_cache('admin_navig_list_list_logic', null);
                    // 清除一下缓存
                    \think\Cache::clear("navig_list");
                }
                \think\Cache::clear('arctype');
            }
//            $param['web_keywords'] = str_replace('，', ',', $param['web_keywords']);
            tpCache($inc_type, $param);
            write_global_params(); // 写入全局内置参数
            $this->success('操作成功', url('System/question'));
            exit;
        }
        $this->assign('config',$config);//当前配置项
        $arctype = Db::name("arctype")->where("channeltype=-1 and current_channel=-1")->find();
        $this->assign('arctype',$arctype);//栏目内容向

        return $this->fetch();
    }
    /**
     * 网站设置
     */
    public function web()
    {
        $inc_type =  'web';

        if (IS_POST) {
            $param = input('post.');
            $param['web_keywords'] = str_replace('，', ',', $param['web_keywords']);
            $param['web_description'] = filter_line_return($param['web_description']);
            
            // 网站根网址
            $web_basehost = rtrim($param['web_basehost'], '/');
            if (!is_http_url($web_basehost) && !empty($web_basehost)) {
                $web_basehost = $this->request->scheme().'://'.$web_basehost;
            }
            $param['web_basehost'] = $web_basehost;

            // 网站LOGO
            if (!empty($param['old_web_logo']) && !empty($param['web_logo']) && !is_http_url($param['web_logo'])) {
                $image_ext_str = config("global.image_ext");
                $image_ext_match = str_replace(',','|',$image_ext_str);
                $img_match = '/(\w+\.(?:'.$image_ext_match.'))$/i';
                preg_match($img_match, $param['web_logo'],$matches);
                preg_match($img_match, $param['old_web_logo'],$matches_old);
                if (empty($matches) || (!empty($param['old_web_logo']) && empty($matches_old))){
                    $this->error('网站LOGO名称不合法！');
                }
                $source = './'.preg_replace('#^'.$this->root_dir.'/#i', '', $param['web_logo']);
                $destination = '/'.preg_replace('#^'.$this->root_dir.'/#i', '', $param['old_web_logo']);
                if (file_exists($source) && @copy($source, '.'.$destination)) {
                    $param['web_logo'] = $this->root_dir.$destination;
                    @unlink($source);
                }
            }
            unset($param['old_web_logo']);

            // 浏览器地址图标
            if (!empty($param['web_ico']) && !is_http_url($param['web_ico'])) {
                $source = './'.preg_replace('#^'.$this->root_dir.'/#i', '', $param['web_ico']);
                $destination = '/favicon.ico';
                if (file_exists($source) && @copy($source, '.'.$destination)) {
                    $param['web_ico'] = $this->root_dir.$destination;
                    @unlink($source);
                }
            }

            tpCache($inc_type, $param);
            write_global_params(); // 写入全局内置参数
            $this->success('操作成功', url('System/web'));
            exit;
        }

        $config = tpCache($inc_type);
        // 网站logo
        $config['web_logo'] = handle_subdir_pic($config['web_logo']);
        $config['web_ico'] = preg_replace('#^(/[/\w]+)?(/)#i', $this->root_dir.'$2', $config['web_ico']); // 支持子目录
        
        /*系统模式*/
        $web_cmsmode = isset($config['web_cmsmode']) ? $config['web_cmsmode'] : 2;
        $this->assign('web_cmsmode', $web_cmsmode);
        /*--end*/

        /*自定义变量*/
        $eyou_row = M('config_attribute')->field('a.attr_id, a.attr_name, a.attr_var_name, a.attr_input_type, b.value, b.id, b.name')
            ->alias('a')
            ->join('__CONFIG__ b', 'b.name = a.attr_var_name', 'LEFT')
            ->where([
                'a.inc_type'    => $inc_type,
                'b.is_del'  => 0,
            ])
            ->order('a.attr_id asc')
            ->select();
        foreach ($eyou_row as $key => $val) {
            $val['value'] = handle_subdir_pic($val['value'], 'html'); // 支持子目录
            $val['value'] = handle_subdir_pic($val['value']); // 支持子目录
            $eyou_row[$key] = $val;
        }
        $this->assign('eyou_row',$eyou_row);
        /*--end*/

        $this->assign('config',$config);//当前配置项
        return $this->fetch();
    }

    /**
     * 核心设置
     */
    public function web2()
    {
        $inc_type = 'web';
        if (IS_POST) {
            $param = input('post.');

            /*EjuCMS安装目录*/
            empty($param['web_cmspath']) && $param['web_cmspath'] = ROOT_DIR; // 支持子目录
            $web_cmspath = trim($param['web_cmspath'], '/');
            $web_cmspath = !empty($web_cmspath) ? '/'.$web_cmspath : '';
            $param['web_cmspath'] = $web_cmspath;
            /*--end*/
            /*自定义后台路径名*/
            $adminbasefile = trim($param['adminbasefile']).'.php'; // 新的文件名
            $param['web_adminbasefile'] = ROOT_DIR.'/'.$adminbasefile; // 支持子目录
            $adminbasefile_old = trim($param['adminbasefile_old']).'.php'; // 旧的文件名
            unset($param['adminbasefile']);
            unset($param['adminbasefile_old']);
            if ('index.php' == $adminbasefile) {
                $this->error("后台路径禁止使用index", null, '', 1);
            }
            /*--end*/
            $param['web_sqldatapath'] = '/'.trim($param['web_sqldatapath'], '/'); // 数据库备份目录

            /*后台LOGO*/
            $web_adminlogo = $param['web_adminlogo'];
            $web_adminlogo_old = tpCache('web.web_adminlogo');
            if ($web_adminlogo != $web_adminlogo_old && !empty($web_adminlogo)) {
                $image_ext_str = config("global.image_ext");
                $image_ext_match = str_replace(',','|',$image_ext_str);
                $img_match = '/(\w+\.(?:'.$image_ext_match.'))$/i';
                preg_match($img_match, $web_adminlogo,$matches);
                preg_match($img_match, $web_adminlogo_old,$matches_old);
                if (empty($matches) || (!empty($web_adminlogo_old) && empty($matches_old))){
                    $this->error('网站后台LOGO名称不合法！');
                }
                $source = preg_replace('#^'.ROOT_DIR.'#i', '', $web_adminlogo); // 支持子目录
                $destination = '/public/static/admin/images/logo.png';
                if (@copy('.'.$source, '.'.$destination)) {
                    $param['web_adminlogo'] = ROOT_DIR.$destination;
                    @unlink('.'.$source);
                }
            }
            /*--end*/
            $web_main_domain_old = tpCache('web.web_main_domain');
            tpCache($inc_type,$param);
            write_global_params(); // 写入全局内置参数

            $refresh = false;
            $gourl = !empty($param['web_main_domain']) ? "//".$param['web_main_domain'].".".$this->request->rootDomain().ROOT_DIR.'/'.$adminbasefile
            : "//".$this->request->rootDomain().ROOT_DIR.'/'.$adminbasefile;
            if ($web_main_domain_old != $param['web_main_domain']){
                $refresh = true;
            }
//            $gourl = $this->request->domain().ROOT_DIR.'/'.$adminbasefile; // 支持子目录
            /*更改自定义后台路径名*/
            if ($adminbasefile_old != $adminbasefile && eyPreventShell($adminbasefile_old)) {
                if (file_exists($adminbasefile_old)) {
                    if(rename($adminbasefile_old, $adminbasefile)) {
                        $refresh = true;
                    }
                } else {
                    $this->error("根目录{$adminbasefile_old}文件不存在！", null, '', 2);
                }
            }
            /*--end*/
            /*刷新整个后台*/
            if ($refresh) {
                $this->success('操作成功', $gourl, '', 1, [], '_parent');
            }
            /*--end*/

            $this->success('操作成功', url('System/web2'));
        }

        $config = tpCache($inc_type);
        //自定义后台路径名
        $baseFile = explode('/', $this->request->baseFile());
        $web_adminbasefile = end($baseFile);
        $adminbasefile = preg_replace('/^(.*)\.([^\.]+)$/i', '$1', $web_adminbasefile);
        $this->assign('adminbasefile', $adminbasefile);
        // 数据库备份目录
        $sqlbackuppath = config('DATA_BACKUP_PATH');
        $this->assign('sqlbackuppath', $sqlbackuppath);

        $this->assign('config',$config);//当前配置项
        return $this->fetch();
    }

    /**
     * 附件设置
     */
    public function basic()
    {
        $inc_type =  'basic';

        // 文件上传最大限制
        $maxFileupload = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 0;
        if (0 !== $maxFileupload) {
            $max_filesize = unformat_bytes($maxFileupload);
            $max_filesize = $max_filesize / 1024 / 1024; // 单位是MB的大小
        } else {
            $max_filesize = 500;
        }
        $max_sizeunit = 'MB';
        $maxFileupload = $max_filesize.$max_sizeunit;

        if (IS_POST) {
            $param = input('post.');
            $param['file_size'] = intval($param['file_size']);

            if (0 < $max_filesize && $max_filesize < $param['file_size']) {
                $this->error("附件上传大小超过空间的最大限制".$maxFileupload);
            }

            // 过滤php扩展名的附件类型
            $image_type = explode('|', $param['image_type']);
            foreach ($image_type as $key => $val) {
                $val = trim($val);
                if (stristr($val, 'php') || empty($val)) {
                    unset($image_type[$key]);
                }
            }
            $param['image_type'] = implode('|', $image_type);

            $file_type = explode('|', $param['file_type']);
            foreach ($file_type as $key => $val) {
                $val = trim($val);
                if (stristr($val, 'php') || empty($val)) {
                    unset($file_type[$key]);
                }
            }
            $param['file_type'] = implode('|', $file_type);

            $media_type = explode('|', $param['media_type']);
            foreach ($media_type as $key => $val) {
                $val = trim($val);
                if (stristr($val, 'php') || empty($val)) {
                    unset($media_type[$key]);
                }
            }
            $param['media_type'] = implode('|', $media_type);
            /*end*/

            tpCache($inc_type,$param);
            $this->success('操作成功', url('System/basic'));
        }

        $config = tpCache($inc_type);
        $this->assign('config',$config);//当前配置项
        $this->assign('max_filesize',$max_filesize);// 文件上传最大字节数
        $this->assign('max_sizeunit',$max_sizeunit);// 文件上传最大字节的单位
        return $this->fetch();
    }

    /**
     * 图片水印
     */
    public function water()
    {
        $inc_type =  'water';

        if (IS_POST) {
            $param = input('post.');
            $tabase = input('post.tabase/d');
            unset($param['tabase']);

            tpCache($inc_type,$param);
            $this->success('操作成功', url('System/'.$inc_type, ['tabase'=>$tabase]));
        }

        $config = tpCache($inc_type);
        $config['mark_img'] = handle_subdir_pic($config['mark_img']);

        $this->assign('config',$config);//当前配置项
        return $this->fetch();
    }

    /**
     * 缩略图配置
     */
    public function thumb()
    {
        $inc_type =  'thumb';

        if (IS_POST) {
            $param = input('post.');
            $tabase = input('post.tabase/d');
            unset($param['tabase']);
            isset($param['thumb_width']) && $param['thumb_width'] = preg_replace('/[^0-9]/', '', $param['thumb_width']);
            isset($param['thumb_height']) && $param['thumb_height'] = preg_replace('/[^0-9]/', '', $param['thumb_height']);

            $thumbConfig = tpCache('thumb'); // 旧数据

            tpCache($inc_type,$param);

            /*校验配置是否改动，若改动将会清空缩略图目录*/
            unset($param['__token__']);
            if (md5(serialize($param)) != md5(serialize($thumbConfig))) {
                delFile(RUNTIME_PATH.'html'); // 清空缓存页面
                delFile(UPLOAD_PATH.'thumb'); // 清空缩略图
            }
            /*--end*/

            $this->success('操作成功', url('System/'.$inc_type, ['tabase'=>$tabase]));
        }

        $config = tpCache($inc_type);

        // 设置缩略图默认配置
        if (!isset($config['thumb_open'])) {
            /*多语言*/
            $thumbextra = config('global.thumb');
            $param = [
                'thumb_open'    => $thumbextra['open'],
                'thumb_mode'    => $thumbextra['mode'],
                'thumb_color'   => $thumbextra['color'],
                'thumb_width'   => $thumbextra['width'],
                'thumb_height'  => $thumbextra['height'],
            ];
            tpCache($inc_type,$param);
            $config = tpCache($inc_type);
            /*--end*/
        }

        $this->assign('config',$config);//当前配置项
        return $this->fetch();
    }

    /**
     * 邮件配置
     */
    public function smtp()
    {
        $inc_type =  'smtp';
        if (IS_POST) {
            $param = input('post.');
            tpCache($inc_type,$param);
            $this->success('操作成功', url('System/smtp'));
        }
        $smtp_config = tpCache($inc_type);
        $this->assign('config',$smtp_config);//当前配置项(邮件)
        $this->assign('sms_config',tpCache('sms'));//当前配置项(短信)
        return $this->fetch();
    }

    /**
     * 邮件模板列表
     */
    public function smtp_tpl()
    {
        $list = array();
        $keywords = input('keywords/s');

        $map = array();
        if (!empty($keywords)) {
            $map['tpl_name'] = array('LIKE', "%{$keywords}%");
        }

        $count = Db::name('smtp_tpl')->where($map)->count('tpl_id');// 查询满足要求的总记录数
        $pageObj = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = Db::name('smtp_tpl')->where($map)
            ->order('tpl_id asc')
            ->limit($pageObj->firstRow.','.$pageObj->listRows)
            ->select();
        $pageStr = $pageObj->show(); // 分页显示输出
        $this->assign('list', $list); // 赋值数据集
        $this->assign('pageStr', $pageStr); // 赋值分页输出
        $this->assign('pageObj', $pageObj); // 赋值分页对象
        
        return $this->fetch();
    }
    public function sms_tpl(){
        $list = array();
        $keywords = input('keywords/s');
        $map = array();
        if (!empty($keywords)) {
            $map['tpl_title'] = array('LIKE', "%{$keywords}%");
        }

        $count = Db::name('sms_template')->where($map)->count('tpl_id');// 查询满足要求的总记录数
        $pageObj = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = Db::name('sms_template')->where($map)
            ->order('tpl_id asc')
            ->limit($pageObj->firstRow.','.$pageObj->listRows)
            ->select();
        $pageStr = $pageObj->show(); // 分页显示输出
        $this->assign('list', $list); // 赋值数据集
        $this->assign('pageStr', $pageStr); // 赋值分页输出
        $this->assign('pageObj', $pageObj); // 赋值分页对象

        return $this->fetch();
    }
    /**
     * 邮件模板列表 - 编辑
     */
    public function smtp_tpl_edit()
    {
        if (IS_POST) {
            $post = input('post.');
            $post['tpl_id'] = eyIntval($post['tpl_id']);
            if(!empty($post['tpl_id'])){
                $post['tpl_title'] = trim($post['tpl_title']);

                /*组装存储数据*/
                $nowData = array(
                    'update_time'   => getTime(),
                );
                $saveData = array_merge($post, $nowData);
                /*--end*/
                
                $r = Db::name('smtp_tpl')->where([
                        'tpl_id'    => $post['tpl_id'],
                    ])->update($saveData);
                if ($r) {
                    $tpl_name = Db::name('smtp_tpl')->where([
                            'tpl_id'    => $post['tpl_id'],
                        ])->getField('tpl_name');
                    adminLog('编辑邮件模板：'.$tpl_name); // 写入操作日志
                    $this->success("操作成功", url('System/smtp_tpl'));
                }
            }
            $this->error("操作失败");
        }

        $id = input('id/d', 0);
        $row = Db::name('smtp_tpl')->where([
                'tpl_id'    => $id,
            ])->find();
        if (empty($row)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }

        $this->assign('row',$row);
        return $this->fetch();
    }
    /**
     * 短信配置
     */
    public function sms()
    {
        $inc_type =  'sms';

        if (IS_POST) {
            $param = input('post.');
            /*多语言*/
            tpCache($inc_type,$param);
            /*--end*/
            $this->success('操作成功', url('System/sms'));
        }

        $config = tpCache($inc_type);
        $this->assign('config',$config);//当前配置项
        return $this->fetch();
    }
    /*
     * 配置短信模板
     */
    public function sms_tpl_old(){
        if (IS_POST){
            $param = input('post.');
            if (!strstr($param['tpl_content'],'${content}')){
                $this->error('发送短信内容必须包含${content}');
            }
            Db::name('sms_template')->update($param);
            $this->success('操作成功');
        }
        $list = Db::name('sms_template')->where("tpl_id > 0")->find();
        $this->assign('config',$list);//当前配置项

        return $this->fetch();
    }
    /**
     * 清空缓存
     */
    public function clear_cache()
    {
        if (IS_POST) {
            if (!function_exists('unlink')) {
                $this->error('php.ini未开启unlink函数，请联系空间商处理！');
            }

            $this->clearSystemCache();

            // 清除其他临时文件
            $this->clearOtherCache();

            /*兼容每个用户的自定义字段，重新生成数据表字段缓存文件*/
            $systemTables = ['arctype'];
            $data = Db::name('channeltype')
                ->where('nid','NEQ','guestbook')
                ->column('table');
            $tables = array_merge($systemTables, $data);
            foreach ($tables as $key => $table) {
                if ('arctype' != $table) {
                    $table = $table.'_content';
                }
                try {
                    schemaTable($table);
                } catch (\Exception $e) {}
            }
            /*--end*/

            /*清除旧升级备份包，保留最后一个备份文件*/
            $backupArr = glob(DATA_PATH.'backup/v*_www');
            for ($i=0; $i < count($backupArr) - 1; $i++) { 
                delFile($backupArr[$i], true);
            }

            $backupArr = glob(DATA_PATH.'backup/*');
            foreach ($backupArr as $key => $filepath) {
                if (file_exists($filepath) && !stristr($filepath, '.htaccess') && !stristr($filepath, '_www')) {
                    if (is_dir($filepath)) {
                        delFile($filepath, true);
                    } else if (is_file($filepath)) {
                        @unlink($filepath);
                    }
                }
            }
            /*--end*/

            $this->success('清除成功', $this->request->baseFile());
        }
        
        return $this->fetch();
    }

    /**
     * 清空数据缓存
     */
    public function fastClearCache($arr = array())
    {
        $this->clearSystemCache();
        $script = "<script>parent.layer.msg('操作成功', {time:3000,icon: 1});window.location='".url('Index/welcome')."';</script>";
        echo $script;
    }

    /**
     * 清空数据缓存
     */
    public function clearSystemCache($arr = array())
    {
        if (empty($arr)) {
            delFile(rtrim(RUNTIME_PATH, '/'), true);
        } else {
            foreach ($arr as $key => $val) {
                delFile(RUNTIME_PATH.$val, true);
            }
        }

        tpCache('global');

        return true;
    }

    /**
     * 清空页面缓存
     */
    public function clearHtmlCache($arr = array())
    {
        if (empty($arr)) {
            delFile(rtrim(HTML_ROOT, '/'), true);
        } else {
            $seo_pseudo = tpCache('seo.seo_pseudo');
            foreach ($arr as $key => $val) {
                $fileList = glob(HTML_ROOT.'http*/'.$val.'*');
                if (!empty($fileList)) {
                    foreach ($fileList as $k2 => $v2) {
                        if (file_exists($v2) && is_dir($v2)) {
                            delFile($v2, true);
                        } else if (file_exists($v2) && is_file($v2)) {
                            @unlink($v2);
                        }
                    }
                }
                if ($val == 'index' && 2 != $seo_pseudo) {
                    foreach (['index.html','indexs.html'] as $sk1 => $sv1) {
                        $filename = ROOT_PATH.$sv1;
                        if (file_exists($filename)) {
                            @unlink($filename);
                        }
                    }
                }
            }
        }
    }

    /**
     * 清除其他临时文件
     */
    private function clearOtherCache()
    {
        $arr = [
            'template',
        ];
        foreach ($arr as $key => $val) {
            delFile(RUNTIME_PATH.$val, true);
        }

        return true;
    }
      
    /**
     * 发送测试邮件
     */
    public function send_email()
    {
        $param = $smtp_config = input('post.');
        $title = '演示标题';
        $content = '演示一串随机数字：' . mt_rand(100000,999999);
        $res = send_email($param['smtp_from_eamil'], $title, $content, 0, $smtp_config);
        if (intval($res['code']) == 1) {
            tpCache('smtp',$smtp_config);
            $this->success($res['msg']);
        } else {
            $this->error($res['msg']);
        }
    }
      
    /**
     * 发送测试短信
     */
    public function send_mobile()
    {
        $param = $sms_config = input('post.');
        $res = sendSms(4, $param['sms_test_mobile'], ['content'=>mt_rand(100000,999999)]);
        if (intval($res['code']) == 1) {
            tpCache('sms',$sms_config);
            $this->success($res['msg']);
        } else {
            $this->error($res['msg']);
        }
    }

    /**
     * 自定义变量列表
     */
    public function customvar_index()
    {
        $list = array();
        $keywords = input('keywords/s');

        $condition = array();
        // 应用搜索条件
        if (!empty($keywords)) {
            $condition['a.attr_name'] = array('LIKE', "%{$keywords}%");
        }

        $attr_var_names = M('config')->field('name')
            ->where([
                'is_del'    => 0,
            ])->getAllWithIndex('name');
        $condition['a.attr_var_name'] = array('IN', array_keys($attr_var_names));

        $count = M('config_attribute')->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $pageObj = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = M('config_attribute')->alias('a')
            ->field('a.*, b.id')
            ->join('__CONFIG__ b', 'b.name = a.attr_var_name', 'LEFT')
            ->where($condition)
            ->order('a.attr_id asc')
            ->limit($pageObj->firstRow.','.$pageObj->listRows)
            ->select();

        $pageStr = $pageObj->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pageObj',$pageObj);// 赋值分页对象

        return $this->fetch();
    }

    /**
     * 保存自定义变量
     */
    public function customvar_save()
    {
        if (IS_POST) {
            $post = input('post.');

            // 数据拼装
            $addData = $editData = $configData = [];
            foreach ($post['attr_name'] as $key => $val) {
                $attr_name  = trim($val);
                $attr_input_type = intval($post['attr_input_type'][$key]);
                if (empty($post['attr_id'][$key])) {
                    $addData[] = [
                        'inc_type'  => 'web',
                        'attr_name'  => $attr_name,
                        'attr_input_type' => $attr_input_type,
                        'add_time' => getTime(),
                    ];
                } else {
                    $attr_id = intval($post['attr_id'][$key]);
                    $editData[] = [
                        'attr_id'  => $attr_id,
                        'inc_type'  => 'web',
                        'attr_name'  => $attr_name,
                        'attr_var_name' => 'web_attr_'.$attr_id,
                        'attr_input_type' => $attr_input_type,
                        'update_time' => getTime(),
                    ];
                }
            }
            if (!empty($addData)) {
                $rdata = model('ConfigAttribute')->saveAll($addData);
                if ($rdata) {
                    foreach ($rdata as $k1 => $v1) {
                        $attr_id = $v1->getData('attr_id');
                        $addData[$k1]['attr_id'] = $attr_id;
                        $addData[$k1]['attr_var_name'] = 'web_attr_'.$attr_id;
                        $addData[$k1]['update_time'] = getTime();
                        unset($addData[$k1]['add_time']);
                    }
                    $editData = array_merge($editData, $addData);
                }
            }
            if (!empty($editData)) {
                $r = model('ConfigAttribute')->saveAll($editData);
                if ($r) {
                    // 保存到config表，更新缓存
                    foreach ($addData as $key => $val) {
                        $configData[$val['attr_var_name']] = '';
                    }
                    !empty($configData) && tpCache('web', $configData);
                    // end

                    adminLog('新增自定义变量：'.implode(',', $post['attr_name']));
                    $this->success('操作成功', url('System/web'));
                } else {
                    $this->error('操作失败');
                }
            } 
        }
        $this->error('非法访问！');
    }

    /**
     * 删除自定义变量
     */
    public function customvar_del()
    {
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        $thorough = input('thorough/d');
        if(IS_POST && !empty($id_arr)){
            $attr_var_name = Db::name('config')->where([
                    'id'    => ['IN', $id_arr],
                ])->column('name');

            if (1 == $thorough) {
                $r = Db::name('config')->where('name', 'IN', $attr_var_name)->delete();
            } else {
                $r = Db::name('config')->where('name', 'IN', $attr_var_name)->update(array('is_del'=>1, 'update_time'=>getTime()));
            }
            if($r){
                if (1 == $thorough) {
                    Db::name('config_attribute')->where('attr_var_name', 'IN', $attr_var_name)->delete();
                } else {
                    Db::name('config_attribute')->where('attr_var_name', 'IN', $attr_var_name)->update(array('update_time'=>getTime()));
                }
                adminLog('删除自定义变量：'.$attr_var_name);
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('参数有误');
        }
    }

    /**
     * 标签调用的弹窗说明
     */
    public function ajax_tag_call()
    {
        if (IS_AJAX_POST) {
            $name = input('post.name/s');
            $msg = '';
            switch ($name) {
                case 'thumb_open':
                    {
                        $msg = '
<div yne-bulb-block="paragraph">
    <span style="color:red">（温馨提示：高级调用不会受缩略图功能的开关影响！）</span></div>
<div yne-bulb-block="paragraph">
    【标签方法的格式】</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;thumb_img=###,宽度,高度,生成方式</div>
<br data-filtered="filtered">
<div yne-bulb-block="paragraph">
    【指定宽高度的调用】</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;列表页/内容页：{$eju.field.litpic<span style="color:red">|thumb_img=###,500,500</span>}</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;标签arclist/list里：{$field.litpic<span style="color:red">|thumb_img=###,500,500</span>}</div>
<br data-filtered="filtered">
<div yne-bulb-block="paragraph">
    【指定生成方式的调用】</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;生成方式：1 = 拉伸；2 = 留白；3 = 截减；<br data-filtered="filtered">
    &nbsp;&nbsp;&nbsp;&nbsp;以标签arclist为例：</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;缩略图拉伸：{$field.litpic<span style="color:red">|thumb_img=###,500,500,1</span>}</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;缩略图留白：{$field.litpic<span style="color:red">|thumb_img=###,500,500,2</span>}</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;缩略图截减：{$field.litpic<span style="color:red">|thumb_img=###,500,500,3</span>}</div>
<div yne-bulb-block="paragraph">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;默&nbsp;认&nbsp;生&nbsp;成：{$field.litpic<span style="color:red">|thumb_img=###,500,500</span>}&nbsp;&nbsp;&nbsp;&nbsp;(以默认全局配置的生成方式)</div>
';
                    }
                    break;
                
                case 'navig':
                    {
$position_id = input('post.position_id/d');
$msg = <<<EOF
<div style="color:red"> 
复制下方代码在需要放置导航的模板文件里进行粘贴
</div>
<br/>
【一级导航标签写法：】<br/>
{eju:navig position_id='{$position_id}' type='top' currentstyle="active" id="field"} <br/>
&lt;li&gt;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="{\$field.navig_pic}" width="40" height="40"><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href="{\$field.navig_url}" {\$field.target} {\$field.nofollow}>{\$field.navig_name}&lt;/a&gt;<br/>
&lt;/li&gt;<br/>
{/eju:navig}
<br/><br/>
【二级导航标签写法：】<br/>
{eju:navig position_id='{$position_id}' type='top' currentstyle="active" id="field"} <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href="{\$field.navig_url}" class='{\$field.currentstyle}' {\$field.target} {\$field.nofollow}>{\$field.navig_name}&lt;/a&gt;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;{eju:notempty name="\$field.children"}<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;ul&gt;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{eju:navig name="\$field.children" id="field2"}<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;li class='{\$field2.currentstyle}'&gt;&lt;a href="{\$field2.navig_url}" {\$field2.target} {\$field2.nofollow}>{\$field2.navig_name}&lt;/a&gt;&lt;/li&gt;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{/eju:navig}<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/ul&gt;<br/>
&nbsp;&nbsp;&nbsp;&nbsp;{/eju:notempty}<br/>
{/eju:navig}
EOF;
                    }
                    break;

                default:
                    # code...
                    break;
            }
            $this->success('请求成功', null, ['msg'=>$msg]);
        }
        $this->error('非法访问！');
    }


}