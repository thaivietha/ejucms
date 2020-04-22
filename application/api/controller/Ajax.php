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
        function_exists('set_time_limit') && set_time_limit(10);

        $type = input('param.type/s');
        
        // 报名发送邮件
        if (IS_AJAX_POST && 'form_submit' == $type) {
            $form_id = input('post.form_id/d');
            $list_id = input('post.list_id/d');

            $send_email_scene = config('send_email_scene');
            $scene = $send_email_scene[1]['scene'];

            $web_name = tpCache('web.web_name');
            // 判断标题拼接
            $formRow  = M('form')->field('name,channel_id')->find($form_id);
            $web_name = $formRow['name'].'-'.$web_name;
            if (!empty($formRow['channel_id'])){
                $ntitle = Db::name("channeltype")->where("id=".$formRow['channel_id'])->getField("ntitle");
                $web_name = $ntitle."-".$web_name;
            }
            $from_list = Db::name("form_list")->where("list_id=".$list_id)->find();
            // 拼装发送的字符串内容
            $row = M('form_attr')->field('a.attr_name, b.attr_value')
                ->alias('a')
                ->join('__FORM_VALUE__ b', 'a.attr_id = b.attr_id AND a.form_id = '.$form_id, 'LEFT')
                ->where([
                    'b.list_id' => $list_id,
                ])
                ->order('a.attr_id sac')
                ->select();
            $content = $sms_content = $user = $tel = '';
            foreach ($row as $key => $val) {
                $content .= $val['attr_name'] . '：' . $val['attr_value'].'<br/>';
                if (preg_match("/^1\d{10}$/",$val['attr_value'],$result)){
                    $sms_content .= $val['attr_name'] . '：' . $val['attr_value'];
                    $tel = $val['attr_value'];
                }else{
                    $user = $val['attr_value'];
                }
            }
            $html = "<p style='text-align: left;'>{$web_name}</p><p style='text-align: left;'>{$content}</p>";
            if (isMobile()) {
                $html .= "<p style='text-align: left;'>——来源：移动端 -- {$from_list['come_from']}</p>";
            } else {
                $html .= "<p style='text-align: left;'>——来源：电脑端 -- {$from_list['come_from']}</p>";
            }
            $sms_arr = ['form'=>$web_name,'user'=>$user,'tel'=>$tel,'from'=>$from_list['come_from']];
            $config_list = Db::name('form_config')->where("status=1")->getAllWithIndex("role");
            if (!empty($from_list['aid'])){
                $user_id = Db::name("archives")->where("aid=".$from_list['aid'])->find();
                //经纪人
                $relate_arr = [];
                if(!empty($user_id['users_id'])){
                    $relate_arr[] = $user_id['users_id'];
                }
                //关联经纪人信息
                if (!empty($user_id['relate'])){
                    $relate_arr = array_unique(array_merge(explode(",",$user_id['relate']),$relate_arr));
                }
                $users_arr = Db::name("users")->where(['id'=>['in',$relate_arr]])->getAllWithIndex('id');

//                $users_info = Db::name("archives")->alias("a")->field("b.mobile,b.email")->join("users b","a.users_id = b.id","left")->where("a.aid=".$from_list['aid'])->find();
            }
            if (!empty($config_list[2]['note']) && !empty($users_arr)){   //发送经纪人短信
                foreach ($users_arr as $val){
                    $res = sendSms($scene, $val['mobile'], $sms_arr);
                }
            }
            if (!empty($config_list[2]['email']) && !empty($users_arr)){   //发送经纪人邮箱
                foreach ($users_arr as $val){
                    $res =  send_email($val['email'],null,$html, $scene);
                }
            }
//            if (!empty($config_list[2]['note']) && !empty($users_info['mobile'])){   //发送经纪人短信
//                $res = sendSms($scene, $users_info['mobile'], $sms_arr);
//            }
//            if (!empty($config_list[2]['email']) && !empty($users_info['email'])){   //发送经纪人邮箱
//                $res = send_email($users_info['email'],null,$html, $scene);  //第一个字段是收件箱
//            }

            if (!empty($config_list[1]['note'])){   //发送管理员短信
                $res = sendSms($scene, $this->eju['global']['sms_test_mobile'], $sms_arr);
            }
            if (!empty($config_list[1]['email'])){   //发送管理员邮箱
                $res = send_email($this->eju['global']['smtp_from_eamil'],null,$html, $scene);  //第一个字段是收件箱
            }
            if (!empty($res['code']) && intval($res['code']) == 1) {
                $this->success($res['msg']);
            } else if(!empty($res['msg'])){
                $this->error($res['msg']);
            }else{
                $this->error("发送失败");
            }
        }
    }
    /*
     * 收藏、取消收藏
     * $cancle  0:收藏，1：取消收藏
     */
    public function collect_change(){
        $aid = input('post.aid/d');
        if (IS_POST && !empty($aid)){
            $users_id = 0;
            $cancle = 0;
            if(session('?users_id')){
                $users_id = session('users_id');
            }else{
                $gourl = url('user/Users/login');
                $this->redirect($gourl,302);
            }
            $have = Db::name("users_collect")->where(['users_id'=> $users_id ,'aid'=>$aid])->find();
            if ($have){     //已经存在收藏，操作为取消收藏
                Db::name("users_collect")->where(['users_id'=> $users_id ,'aid'=>$aid])->delete();
                $cancle = 1;
            }else{
                Db::name("users_collect")->insert(['users_id'=>$users_id,'aid'=>$aid,'add_time'=>getTime(),'update_time'=>getTime()]);
            }
            $this->success('操作成功', null, ['cancle'=>$cancle,'aid'=>$aid]);
        }
        $this->error('表单缺少标签属性aid');
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
            foreach ($post as $key=>$val){
                $post[$key] = htmlspecialchars($val);
            }
            $map = array(
                'ip'    => $ip,
                'form_id'    => $form_id,
                'add_time'  => array('gt', getTime() - 60),
            );
            $count = M('form_list')->where($map)->count('list_id');
            if ($count > 0 && 1>1) {
                $this->error('同一个IP在60秒之内不能重复提交！');
            }

            $come_url = input('post.come_url/s'); //htmlspecialchars(input('post.come_url/s'));
            $parent_come_url = input('post.parent_come_url/s');  //htmlspecialchars(input('post.parent_come_url/s'));
            $come_url = !empty($parent_come_url)? $parent_come_url :$come_url;
            $come_from = input('post.come_from/s', '请添加come_from隐藏信息');  //htmlspecialchars(input('post.come_from/s', '请添加come_from隐藏信息'));
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
                'aid'    => !empty($post['aid']) ? $post['aid'] : 0,
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
            $val = remove_xss($val);
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
    /**
     * 检验会员登录
     */
    public function check_user()
    {
        if (IS_AJAX) {
            $type = input('param.type/s', 'default');
            $img = input('param.img/s');
            if ('login' == $type) {
                $users_id = session('users_id');
                if (!empty($users_id)) {
                    $currentstyle = input('param.currentstyle/s');
                    $users = M('users')->field('username,nickname,litpic')
                        ->where([
                            'id'  => $users_id,
                        ])->find();
                    if (!empty($users)) {
                        $nickname = $users['nickname'];
                        if (empty($nickname)) {
                            $nickname = $users['username'];
                        }
                        $head_pic = get_head_pic($users['litpic']);
                        if ('on' == $img) {
                            $users['html'] = "<img class='{$currentstyle}' alt='{$nickname}' src='{$head_pic}' />";
                        } else {
                            $users['html'] = $nickname;
                        }
                        $users['ey_is_login'] = 1;
                        $this->success('请求成功', null, $users);
                    }
                }
                $this->success('请先登录', null, ['ey_is_login'=>0]);
            }
            else if ('reg' == $type)
            {
                if (session('?users_id')) {
                    $users['ey_is_login'] = 1;
                } else {
                    $users['ey_is_login'] = 0;
                }
                $this->success('请求成功', null, $users);
            }
            else if ('logout' == $type)
            {
                if (session('?users_id')) {
                    $users['ey_is_login'] = 1;
                } else {
                    $users['ey_is_login'] = 0;
                }
                $this->success('请求成功', null, $users);
            }
        }
        $this->error('访问错误');
    }
    /**
     * 获取用户信息
     */
    public function get_tag_user_info()
    {
        $t_uniqid = input('param.t_uniqid/s', '');
        if (IS_AJAX && !empty($t_uniqid)) {
            $users_id = session('users_id');
            if (!empty($users_id)) {
                $users = Db::name('users')->field('b.*, a.*')
                    ->alias('a')
                    ->join('__USERS_LEVEL__ b', 'a.level_id = b.id', 'LEFT')
                    ->where([
                        'a.id' => $users_id,
                    ])->find();
                if (!empty($users)) {
                    $users['reg_time'] = MyDate('Y-m-d H:i:s', $users['reg_time']);
                    $users['update_time'] = MyDate('Y-m-d H:i:s', $users['update_time']);
                } else {
                    $users = [];
                    $tableFields1 = Db::name('users')->getTableFields();
                    $tableFields2 = Db::name('users_level')->getTableFields();
                    $tableFields = array_merge($tableFields1, $tableFields2);
                    foreach ($tableFields as $key => $val) {
                        $users[$val] = '';
                    }
                }
                $users['url'] = url('user/Users/centre');
                unset($users['password']);
                unset($users['paypwd']);
                $dtypes = [];
                foreach ($users as $key => $val) {
                    $html_key = md5($key.'-'.$t_uniqid);
                    $users[$html_key] = $val;

                    $dtype = 'txt';
                    if (in_array($key, ['head_pic'])) {
                        $dtype = 'img';
                    } else if (in_array($key, ['url'])) {
                        $dtype = 'href';
                    }
                    $dtypes[$html_key] = $dtype;

                    unset($users[$key]);
                }

                $data = [
                    'ey_is_login'   => 1,
                    'users'  => $users,
                    'dtypes'  => $dtypes,
                ];
                $this->success('请求成功', null, $data);
            }
            $this->success('请先登录', null, ['ey_is_login'=>0]);
        }
        $this->error('访问错误');
    }
    /*
     * 获取region列表
     */
    public function get_region_list(){
        $keywords = addslashes(input('param.keywords/s',''));
        $level = input('param.level/d','0');
        $list = [];
        $where = "status=1 and domain<>''";
        if ($level){
            $where .= " and level={$level}";
        }
        if (!empty($keywords)){
            $where .= " and (initial='{$keywords}' or name like '%{$keywords}%' or domain like '%{$keywords}%')";
            $list = Db::name("region")->where($where)->getAllWithIndex('id');

            foreach ($list as $key=>$val){
                $list[$key]['domainurl'] = getRegionDomainUrl($val['domain']);
            }
        }
        return json($list);
    }

}