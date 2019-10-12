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

namespace app\api\controller;

use think\Db;

class Ajax extends Base
{
    /*
     * 初始化操作
     */
    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 内容页浏览量的自增接口
     */
    public function arcclick()
    {
        if (IS_AJAX) {
            $aid = input('aid/d', 0);
            $click = 0;
            if (empty($aid)) {
                echo($click);
                exit;
            }

            if ($aid > 0) {
                $archives_db = Db::name('archives');
                $archives_db->where(array('aid'=>$aid))->setInc('click'); 
                $click = $archives_db->where(array('aid'=>$aid))->getField('click');
            }

            echo($click);
            exit;
        }
    }

    /**
     * arclist列表分页arcpagelist标签接口
     */
    public function arcpagelist()
    {
        $pnum = input('page/d', 0);
        $pagesize = input('pagesize/d', 0);
        $tagid = input('tagid/s', '');
        $tagidmd5 = input('tagidmd5/s', '');
        !empty($tagid) && $tagid = preg_replace("/[^a-zA-Z0-9-_]/",'', $tagid);
        !empty($tagidmd5) && $tagidmd5 = preg_replace("/[^a-zA-Z0-9_]/",'', $tagidmd5);

        if (empty($tagid) || empty($pnum) || empty($tagidmd5)) {
            $this->error('参数有误');
        }

        $data = [
            'code' => 1,
            'msg'   => '',
            'lastpage'  => 0,
        ];

        $arcmulti_db = Db::name('arcmulti');
        $arcmultiRow = $arcmulti_db->where(['tagid'=>$tagidmd5])->find();
        if(!empty($arcmultiRow) && !empty($arcmultiRow['querysql']))
        {
            // arcpagelist标签属性pagesize优先级高于arclist标签属性pagesize
            if (0 < intval($pagesize)) {
                $arcmultiRow['pagesize'] = $pagesize;
            }

            // 取出属性并解析为变量
            $attarray = unserialize(stripslashes($arcmultiRow['attstr']));
            // extract($attarray, EXTR_SKIP); // 把数组中的键名直接注册为了变量

            // 通过页面及总数解析当前页面数据范围
            $pnum < 2 && $pnum = 2;
            $strnum = intval($attarray['row']) + ($pnum - 2) * $arcmultiRow['pagesize'];

            // 拼接完整的SQL
            $querysql = preg_replace('#LIMIT(\s+)(\d+)(,\d+)?#i', '', $arcmultiRow['querysql']);
            $querysql = preg_replace('#SELECT(\s+)(.*)(\s+)FROM#i', 'SELECT COUNT(*) AS totalNum FROM', $querysql);
            $queryRow = Db::query($querysql);
            if (!empty($queryRow)) {
                $tpl_content = '';
                $filename = './template/'.THEME_STYLE.'/'.'system/arclist_'.$tagid.'.'.\think\Config::get('template.view_suffix');
                if (!file_exists($filename)) {
                    $data['code'] = -1;
                    $data['msg'] = "模板追加文件 arclist_{$tagid}.htm 不存在！";
                    $this->error("标签模板不存在", null, $data);
                } else {
                    $tpl_content = @file_get_contents($filename);
                }
                if (empty($tpl_content)) {
                    $data['code'] = -1;
                    $data['msg'] = "模板追加文件 arclist_{$tagid}.htm 没有HTML代码！";
                    $this->error("标签模板不存在", null, $data);
                }

                /*拼接完整的arclist标签语法*/
                $offset = intval($strnum);
                $row = intval($offset) + intval($arcmultiRow['pagesize']);
                $innertext = "{eju:arclist";
                foreach ($attarray as $key => $val) {
                    if (in_array($key, ['tagid','offset','row'])) {
                        continue;
                    }
                    $innertext .= " {$key}='{$val}'";
                }
                $innertext .= " limit='{$offset},{$row}'}";
                $innertext .= $tpl_content;
                $innertext .= "{/eju:arclist}";
                /*--end*/
                $msg = $this->display($innertext); // 渲染模板标签语法
                $data['msg'] = $msg;

                //是否到了最终页
                if (!empty($queryRow[0]['totalNum']) && $queryRow[0]['totalNum'] <= $row) {
                    $data['lastpage'] = 1;
                }

            } else {
                $data['lastpage'] = 1;
            }
        }

        $this->success('请求成功', null, $data);
    }

    /**
     * 获取表单令牌
     */
    public function get_token($name = '__token__')
    {
        if (IS_AJAX) {
            echo $this->request->token($name);
            exit;
        }
    }

    // 验证码获取
    public function vertify()
    {
        $type = input('param.type/s', 'default');
        $configList = \think\Config::get('captcha');
        $captchaArr = array_keys($configList);
        if (in_array($type, $captchaArr)) {
            /*验证码插件开关*/
            $admin_login_captcha = config('captcha.'.$type);
            $config = (!empty($admin_login_captcha['is_on']) && !empty($admin_login_captcha['config'])) ? $admin_login_captcha['config'] : config('captcha.default');
            /*--end*/
            ob_clean(); // 清空缓存，才能显示验证码
            $Verify = new \think\Verify($config);
            $Verify->entry($type);
        }
        exit();
    }
      
    /**
     * 邮箱发送
     */
    public function send_email()
    {
        // 超时后，断掉邮件发送
        function_exists('set_time_limit') && set_time_limit(5);

        $type = input('param.type/s');
        
        // 报名发送邮件
        if (IS_AJAX_POST && 'form_submit' == $type) {
            $form_id = input('post.form_id/d');
            $list_id = input('post.list_id/d');

            $send_email_scene = config('send_email_scene');
            $scene = $send_email_scene[1]['scene'];

            $web_name = tpCache('web.web_name');
            // 判断标题拼接
            $formRow  = M('form')->field('name')->find($form_id);
            $web_name = $formRow['name'].'-'.$web_name;

            // 拼装发送的字符串内容
            $row = M('form_attr')->field('a.attr_name, b.attr_value')
                ->alias('a')
                ->join('__FORM_VALUE__ b', 'a.attr_id = b.attr_id AND a.form_id = '.$form_id, 'LEFT')
                ->where([
                    'b.list_id' => $list_id,
                ])
                ->order('a.attr_id sac')
                ->select();
            $content = '';
            $sms_content = '';
            foreach ($row as $key => $val) {
                $content .= $val['attr_name'] . '：' . $val['attr_value'].'<br/>';
                if (preg_match("/^1\d{10}$/",$val['attr_value'],$result)){
                    $sms_content .= $val['attr_name'] . '：' . $val['attr_value'];
                }
            }
            $html = "<p style='text-align: left;'>{$web_name}</p><p style='text-align: left;'>{$content}</p>";
            if (isMobile()) {
                $html .= "<p style='text-align: left;'>——来源：移动端</p>";
            } else {
                $html .= "<p style='text-align: left;'>——来源：电脑端</p>";
            }
            // 发送邮件
            $res = send_email(null,null,$html, $scene);
            //发送短信
//            $sms_res = sendSms(4, $this->eju['global']['sms_test_mobile'], ['content'=>$sms_content]);
//            if (intval($sms_res['status']) == 1 && intval($res['code']) == 1){
//                $this->success('短信发送成功：'.$sms_res['msg']."，邮箱发送成功:".$res['msg']);
//            }else if(intval($sms_res['status']) == 1){
//                $this->error("短信发送成功,邮箱发送失败:".$res['msg']);
//            }else if(intval($res['code']) == 1){
//                $this->error("邮箱发送成功,短信发送失败:".$sms_res['msg']);
//            }else{
//                $this->error("邮箱发送失败:".$res['msg'].",短信发送失败:".$sms_res['msg']);
//            }
            if (intval($res['code']) == 1) {
                $this->success($res['msg']);
            } else {
                $this->error($res['msg']);
            }
        }
    }
    /**
     * 获取表单数据信息
     */
    public function form_submit(){
        $form_id = input('post.form_id/d');

        if (IS_POST && !empty($form_id))
        {
            $post = input('post.');
            $ip = clientIP();

            $map = array(
                'ip'    => $ip,
                'form_id'    => $form_id,
                'add_time'  => array('gt', getTime() - 60),
            );
            $count = M('form_list')->where($map)->count('list_id');
            if ($count > 0 && 1>1) {
                $this->error('同一个IP在60秒之内不能重复提交！');
            }

            $come_url = input('post.come_url/s');
            $parent_come_url = input('post.parent_come_url/s');
            $come_url = !empty($parent_come_url)? $parent_come_url :$come_url;
            $come_from = input('post.come_from/s', '请添加come_from隐藏信息');
            $city = "";
/*            try {
                $city_arr = getCityLocation($ip);
                if (!empty($city_arr)) {
                    !empty($city_arr['country']) && $city .= $city_arr['country'];
                    !empty($city_arr['area']) && $city .= $city_arr['area'];
                    !empty($city_arr['region']) && $city .= $city_arr['region'];
                    !empty($city_arr['city']) && $city .= $city_arr['city'];
                }
            } catch (\Exception $e) {}*/
            
            $newData = array(
                'form_id'    => $form_id,
                'ip'    => $ip,
                'come_from' => $come_from,
                'come_url' => $come_url,
                'city' => $city,
                'add_time'  => getTime(),
                'update_time' => getTime(),
            );
            $data = array_merge($post, $newData);

            // 数据验证
            $token = '__token__';
            foreach ($post as $key => $val) {
                if (preg_match('/^__token__/i', $key)) {
                    $token = $key;
                    continue;
                }
            }
            $rule = [
                'form_id'    => 'require|token:'.$token,
            ];
            $message = [
                'form_id.require' => '表单缺少标签属性{$field.hidden}',
            ];
            $validate = new \think\Validate($rule, $message);
            if(!$validate->batch()->check($data))
            {
                $error = $validate->getError();
                $error_msg = array_values($error);
                $this->error($error_msg[0]);
            } else {
                $formlistRow = [];
                /*处理是否重复表单数据的提交*/
                $formdata = $data;
                foreach ($formdata as $key => $val) {
                    if (in_array($key, ['form_id']) || preg_match('/^attr_(\d+)$/i', $key)) {
                        continue;
                    }
                    unset($formdata[$key]);
                }
                $md5data = md5(serialize($formdata));
                $data['md5data'] = $md5data;
                $formlistRow = M('form_list')->field('list_id')->where(['md5data'=>$md5data])->find();
                /*--end*/
                if (empty($formlistRow)) { // 非重复表单的才能写入数据库
                    $list_id = M('form_list')->insertGetId($data);
                    if ($list_id > 0) {
                        $this->saveFormValue($list_id, $form_id);
                    }
                } else {
                    // 存在重复数据的表单，将在后台显示在最前面
                    $list_id = $formlistRow['list_id'];
                    M('form_list')->where('list_id',$list_id)->update([
                            'is_read'   => 0,
                            'add_time'   => getTime(),
                            'update_time'   => getTime(),
                        ]);
                }

                $this->success('提交成功', null, ['form_id'=>$form_id,'list_id'=>$list_id]);
            }
        }

        $this->error('表单缺少标签属性{$field.hidden}');
    }

    /**
     *  给指定报名信息添加表单值到 form_value
     * @param int $list_id  报名id
     * @param int $form_id  表单id
     */
    private function saveFormValue($list_id, $form_id)
    {  
        // post 提交的属性  以 attr_id _ 和值的 组合为键名    
        $post = input("post.");

        foreach($post as $key => $val)
        {
            if(!strstr($key, 'attr_'))
                continue;                                 

            $attr_id = str_replace('attr_', '', $key);
            is_array($val) && $val = implode(',', $val);
            $val = trim($val);
            $attr_value = stripslashes(filter_line_return($val, '。'));
            $adddata = array(
                'form_id'   => $form_id,
                'list_id'   => $list_id,
                'attr_id'   => intval($attr_id),
                'attr_value'   => $attr_value,
                'add_time'   => getTime(),
                'update_time'   => getTime(),
            );
            M('form_value')->add($adddata);
        }
    }
}