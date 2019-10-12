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
use app\admin\controller\Base;
use think\Controller;
use think\Db;

class Index extends Base
{
    public function uphtml()
    {
        return $this->fetch();
    }

    public function index()
    {
        $this->assign('home_url', $this->request->domain().ROOT_DIR.'/');
        $this->assign('admin_info', getAdminInfo(session('admin_id')));
        $this->assign('menu',getMenuList());

        return $this->fetch();
    }

    /**
     * 欢迎页
     */
    public function welcome()
    {
        $globalConfig = tpCache('global');
        $this->assign('sys_info',$this->get_sys_info($globalConfig));
        $this->assign('web_show_popup_upgrade', $globalConfig['web_show_popup_upgrade']);

        // 纠正上传附件的大小，始终以空间大小为准
        $file_size = $globalConfig['file_size'];
        $maxFileupload = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 0;
        $maxFileupload = intval($maxFileupload);
        if (empty($file_size) || $file_size > $maxFileupload) {
            tpCache('basic', ['file_size'=>$maxFileupload]);
        }
        // 快捷导航
        $quickMenu = Db::name('quickentry')->where([
                'type'      => 1,
                'checked'   => 1,
                'status'    => 1,
            ])->order('sort_order asc, id asc')->select();
        $this->assign('quickMenu',$quickMenu);

        // 内容统计
        $contentTotal = $this->contentTotalList();
        $this->assign('contentTotal',$contentTotal);

        return $this->fetch();
    }

    /**
     * 内容统计管理
     */
    public function ajax_content_total()
    {
        if (IS_AJAX_POST) {
            $checkedids = input('post.checkedids/a', []);
            $ids = input('post.ids/a', []);
            $saveData = [];
            foreach ($ids as $key => $val) {
                if (in_array($val, $checkedids)) {
                    $checked = 1;
                } else {
                    $checked = 0;
                }
                $saveData[$key] = [
                    'id'            => $val,
                    'checked'       => $checked,
                    'sort_order'    => intval($key) + 1,
                    'update_time'   => getTime(),
                ];
            }
            if (!empty($saveData)) {
                $r = model('Quickentry')->saveAll($saveData);
                if ($r) {
                    $this->success('操作成功', url('Index/welcome'));
                }
            }
            $this->error('操作失败');
        }

        $totalList = Db::name('quickentry')->where([
                'type'      => ['IN', [2]],
                'status'    => 1,
            ])->order('sort_order asc, id asc')->select();
        $this->assign('totalList',$totalList);

        return $this->fetch();
    }

    private function contentTotalList()
    {
        $archivesTotalRow = null;
        $quickentryList = Db::name('quickentry')->where([
                'type'      => 2,
                'checked'   => 1,
                'status'    => 1,
            ])->order('sort_order asc, id asc')->select();
        foreach ($quickentryList as $key => $val) {
            $code = $val['controller'].'@'.$val['action'].'@'.$val['vars'];
            if ($code == 'Form@index@') // 用户报名
            {
                $map = [
                    'is_del'    => 0,
                ];
                $quickentryList[$key]['total'] = Db::name('form_list')->where($map)->count();
            }
            else if (1 == $val['groups']) // 模型内容统计
            {
                if (null === $archivesTotalRow) {
                    $archivesTotalRow = Db::name('archives')->field('channel, count(aid) as total')->where([
                            'status'    => 1,
                            'is_del'    => 0,
                        ])->group('channel')
                        ->getAllWithIndex('channel');
                }
                parse_str($val['vars'], $vars);
                $total = !empty($archivesTotalRow[$vars['channel']]['total']) ? intval($archivesTotalRow[$vars['channel']]['total']) : 0;
                $quickentryList[$key]['total'] = $total;
            }
            else if ($code == 'AdPosition@index@') // 广告
            {
                $map = [
                    'is_del'    => 0,
                ];
                $quickentryList[$key]['total'] = Db::name('ad_position')->where($map)->count();
            }
            else if ($code == 'Links@index@') // 友情链接
            {
                $quickentryList[$key]['total'] = Db::name('links')->count();
            }
            else if ($code == 'Tags@index@') // Tags标签
            {
                $quickentryList[$key]['total'] = Db::name('tagindex')->count();
            }
            else if ($code == 'Saleman@index@') // 经纪人
            {
                $quickentryList[$key]['total'] = Db::name('saleman')->count();
            }
        }

        return $quickentryList;
    }

    /**
     * 快捷导航管理
     */
    public function ajax_quickmenu()
    {
        if (IS_AJAX_POST) {
            $checkedids = input('post.checkedids/a', []);
            $ids = input('post.ids/a', []);
            $saveData = [];
            foreach ($ids as $key => $val) {
                if (in_array($val, $checkedids)) {
                    $checked = 1;
                } else {
                    $checked = 0;
                }
                $saveData[$key] = [
                    'id'            => $val,
                    'checked'       => $checked,
                    'sort_order'    => intval($key) + 1,
                    'update_time'   => getTime(),
                ];
            }
            if (!empty($saveData)) {
                $r = model('Quickentry')->saveAll($saveData);
                if ($r) {
                    $this->success('操作成功', url('Index/welcome'));
                }
            }
            $this->error('操作失败');
        }

        $menuList = Db::name('quickentry')->where([
                'type'      => ['IN', [1]],
                'groups'    => 0,
                'status'    => 1,
            ])->order('sort_order asc, id asc')->select();
        $this->assign('menuList',$menuList);

        return $this->fetch();
    }

    /**
     * 录入商业授权
     */
    public function authortoken()
    {
        $domain = config('service_ey');
        $domain = base64_decode($domain);
        $vaules = array(
            'cms_type'  => 1,
            'client_domain' => urldecode($this->request->host(true)),
        );
        $url = $domain.'/index.php?m=api&c=CmsService&a=check_authortoken&'.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 3,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);
        if (false === $response || (is_array($params) && 1 == $params['code'])) {
            $web_authortoken = $params['msg'];
            tpCache('web', array('web_authortoken'=>$web_authortoken));

            session('isset_author', null);
            adminLog('验证商业授权');
            $this->success('授权成功');
        }
        $this->error('验证授权失败');
    }
    
    /**
     * ajax 修改指定表数据字段  一般修改状态 比如 是否推荐 是否开启 等 图标切换的
     * table,id_name,id_value,field,value
     */
    public function changeTableVal()
    {
        if (IS_AJAX_POST) {
            $url = null;
            $data = [
                'refresh'   => 0,
            ];

            $param = input('param.');
            $table    = input('param.table/s'); // 表名
            $id_name  = input('param.id_name/s'); // 表主键id名
            $id_value = input('param.id_value/d'); // 表主键id值
            $field    = input('param.field/s'); // 修改哪个字段
            $value    = input('param.value/s', '', null); // 修改字段值
            $value    = eyPreventShell($value) ? $value : strip_sql($value);

            /*插件专用*/
            if ('weapp' == $table) {
                if (1 == intval($value)) { // 启用
                    action('Weapp/enable', ['id' => $id_value]);
                } else if (-1 == intval($value)) { // 禁用
                    action('Weapp/disable', ['id' => $id_value]);
                }
            }
            /*end*/

            /*处理数据的安全性*/
            if (empty($id_value)) {
                $this->error('查询条件id不合法！');
            }
            foreach ($param as $key => $val) {
                if ('value' == $key) {
                    continue;
                }
                if (!preg_match('/^([A-Za-z0-9_-]*)$/i', $val)) {
                    $this->error('数据含有非法入侵字符！');
                }
            }
            /*end*/

            $savedata = [
                $field => $value,
                'update_time'   => getTime(),
            ];
            M($table)->where("$id_name = $id_value")->cache(true,null,$table)->save($savedata); // 根据条件保存修改的数据

            // 以下代码可以考虑去掉，与行为里的清除缓存重复 AppEndBehavior.php / clearHtmlCache
            switch ($table) {
                case 'auth_modular':
                    extra_cache('admin_auth_modular_list_logic', null);
                    extra_cache('admin_all_menu', null);
                    break;

                case 'region':
                    extra_cache('global_get_province_list', null);
                    extra_cache('global_get_city_list', null);
                    extra_cache('global_get_area_list', null);
                    break;

                default:
                    // 清除logic逻辑定义的缓存
                    extra_cache('admin_'.$table.'_list_logic', null);
                    // 清除一下缓存
                    \think\Cache::clear($table);
                    break;
            }

            $this->success('更新成功', $url, $data);
        }
    }

    /**
     * 系统信息
     */
    private function get_sys_info($globalConfig = [])
    {
        $sys_info['os']             = PHP_OS;
        $sys_info['zlib']           = function_exists('gzclose') ? 'YES' : '<font color="red">NO（请开启 php.ini 中的php-zlib扩展）</font>';//zlib
        $sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off       
        $sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
        $sys_info['curl']           = function_exists('curl_init') ? 'YES' : '<font color="red">NO（请开启 php.ini 中的php-curl扩展）</font>';  
        $sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['phpv']           = phpversion();
        $sys_info['ip']             = serverIP();
        $sys_info['postsize']       = @ini_get('file_uploads') ? ini_get('post_max_size') :'unknown';
        $sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
        $sys_info['max_ex_time']    = @ini_get("max_execution_time").'s'; //脚本最大执行时间
        $sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
        $sys_info['domain']         = $_SERVER['HTTP_HOST'];
        $sys_info['memory_limit']   = ini_get('memory_limit');
        $sys_info['version']        = file_get_contents(DATA_PATH.'conf/version.txt');
        $mysqlinfo = Db::query("SELECT VERSION() as version");
        $sys_info['mysql_version']  = $mysqlinfo[0]['version'];
        if(function_exists("gd_info")){
            $gd = gd_info();
            $sys_info['gdinfo']     = $gd['GD Version'];
        }else {
            $sys_info['gdinfo']     = "未知";
        }
        if (extension_loaded('zip')) {
            $sys_info['zip']     = "YES";
        } else {
            $sys_info['zip']     = '<font color="red">NO（请开启 php.ini 中的php-zip扩展）</font>';
        }
        $sys_info['curent_version'] = getCmsVersion(); //当前程序版本
        $sys_info['web_name'] = !empty($globalConfig['web_name']) ? $globalConfig['web_name'] : tpCache('global.web_name');

        return $sys_info;
    }
}
