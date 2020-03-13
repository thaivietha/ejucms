<?php

namespace app\user\controller;

use think\Db;
use think\Config;
use think\Verify;

class Users extends Base
{
    public function _initialize() {
        parent::_initialize();
    }
    // 登陆
    public function login()
    {
        if ($this->users_id > 0) {
            $this->redirect('user/Users/centre');
            exit;
        }

        $website = input('param.website/s');
        if (isWeixin() && empty($website)) {
            $this->redirect('user/Users/users_select_login');
            exit;
        }
        // 默认开启验证码
        $is_vertify = 1;
        $users_login_captcha = config('captcha.users_login');
        if (!function_exists('imagettftext') || empty($users_login_captcha['is_on'])) {
            $is_vertify = 0; // 函数不存在，不符合开启的条件
        }
        $this->assign('is_vertify', $is_vertify);

        if (IS_AJAX_POST) {
            $post = input('post.');
            $post['mobile'] = trim($post['mobile']);

            if (empty($post['mobile'])) {
                $this->error('登陆账号不能为空！', null, ['status'=>1]);
            }
            if (empty($post['password'])) {
                $this->error('密码不能为空！', null, ['status'=>1]);
            }
            if (1 == $is_vertify) {
                if (empty($post['vertify'])) {
                    $this->error('图片验证码不能为空！', null, ['status'=>1]);
                }
                $verify = new Verify();
                if (!$verify->check($post['vertify'], "users_login")) {
                    $this->error('验证码错误', null, ['status'=>'vertify']);
                }
            }

            $users = Db::name("users")->where([
                'mobile'  => $post['mobile'],
            ])->find();
            if (!empty($users)) {
                if (!empty($users['is_del'])) {
                    $this->error('该会员已被删除，请联系管理员！', null, ['status'=>1]);
                }
                if (empty($users['is_activation'])) {
                    $this->error('该会员尚未激活，请联系管理员！', null, ['status'=>1]);
                }
                $users_id = $users['id'];
                if (strval($users['password']) === strval(func_encrypt($post['password']))) {
                    // 判断是前台还是后台注册的会员，后台注册不受注册验证影响，1为后台注册，2为前台注册。
                    if (2 == $users['register_place']) {
                        $usersVerificationRow = M('users_config')->where([
                            'name'  => 'users_verification',
                        ])->find();
                        if ($usersVerificationRow['update_time'] <= $users['reg_time']) {
                            // 判断是否需要后台审核
                            if ($usersVerificationRow['value'] == 1 && $users['is_activation'] == 0) {
                                $this->error('管理员审核中，请稍等！', null, ['status'=>2]);
                            }
                        }
                    }
                    $data = [
                        'last_ip'       => clientIP(),
                        'last_login'    => getTime(),
                        'login_count'   => Db::raw('login_count+1'),
                    ];
                    Db::name("users_content")->where('users_id',$users_id)->update($data);
                    unset($users['password']);
                    // 会员users_id存入session
                    session('users_id',$users_id);
//                    session('users',$users);
                    setcookie('users_id',$users_id,null);
                    // 回跳路径
                    $url =  input('post.referurl/s', null, 'htmlspecialchars_decode,urldecode');
                    $this->success('登录成功', $url);
                }else{
                    $this->error('密码不正确！', null, ['status'=>1]);
                }
            }else{
                $this->error('该号码不存在，请注册！', null, ['status'=>1]);
            }
        }

        // 跳转链接
        $referurl  = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url("user/Users/centre"); // url("user/Users/centre");

        $this->assign('referurl', $referurl);

        return $this->fetch('users_login');
    }
    // 会员中心（主页）
    public function centre()
    {
        $this->assign('home_url', $this->request->domain().ROOT_DIR.'/');
        $this->assign('menu',getMenuList());

        return $this->fetch('users_centre');
    }
    // 会员中心首页
    public function index()
    {
        $level_list = Db::name("users_level")->where("status",1)->select();
        $assign_data['level_list'] = $level_list;
        $content = model("users")->getContentInfo($this->users_id);
        $assign_data['content'] = $content;
        $count = model("users")->getCountInfo($this->users_id);
        $assign_data['count'] = $count;
        $this->assign($assign_data);

        return $this->fetch('users_index');
    }
    //更新会员资料
    public function edit(){
        if (IS_POST){
            $post = input('post.');
            if (!empty($post['users_id'])){
                unset($post['users_id']);
            }
            $user = new \app\common\model\Users();
            if ($user_info = $user::check_update($post['username'],$post['mobile'],$post['email'],$this->users_id)){
                if (!empty($user_info['username']) && $user_info['username'] == $post['username']){
                    $this->error("用户名{$post['username']}已被注册");
                }else if (!empty($user_info['mobile']) && $user_info['mobile'] == $post['mobile']){
                    $this->error("手机号码{$post['mobile']}已被注册");
                }else if (!empty($user_info['email']) && $user_info['email'] == $post['email']){
                    $this->error("邮箱{$post['email']}已被注册");
                }
            }
            $post['update_time'] = getTime();
            $r = Db::name("users")->where('id',$this->users_id)->update($post);
            if ($r){
                $this->success('保存成功');
            }else{
                $this->error('保存失败，不存在修改的信息');
            }
        }
        $assign_data['field'] = $this->users;
        $this->assign($assign_data);
        return $this->fetch('users_edit');
    }
    //绑定邮箱
    public function bind_email(){
        if (IS_AJAX_POST) {
            $post = input('post.');
            if (!empty($post['email']) && !empty($post['email_code'])) {
                // 邮箱格式验证是否正确
                if (!check_email($post['email'])) {
                    $this->error('邮箱格式不正确！');
                }
                // 是否已存在相同邮箱地址
                $ListWhere = [
                    'id' => ['NEQ',$this->users_id],
                    'email'     => $post['email'],
                ];
                $ListData = Db::name('users')->where($ListWhere)->count();
                if (!empty($ListData)) {
                    $this->error('该邮箱已存在，不可绑定！');
                }

                // 判断验证码是否存在并且是否可用
                $RecordWhere = [
                    'email'     => $post['email'],
                    'code'      => $post['email_code'],
                    'users_id'  => $this->users_id,
                ];
                $RecordData = Db::name('smtp_record')->where($RecordWhere)->field('record_id,email,status,add_time')->find();
                if (!empty($RecordData)) {
                    // 验证码存在
                    $time   = getTime();
                    $RecordData['add_time'] += Config::get('global.email_default_time_out');
                    if (1 == $RecordData['status'] || $RecordData['add_time'] <= $time) {
                        // 验证码不可用
                        $this->error('邮箱验证码已被使用或超时，请重新发送！');
                    }else{
                        // 查询会员输入的邮箱并且为绑定邮箱来源的所有验证码
                        $RecordWhere = [
                            'source'   => 3,
                            'email'    => $RecordData['email'],
                            'users_id' => $this->users_id,
                            'status'   => 0,
                        ];

                        // 更新数据
                        $RecordData = [
                            'status'      => 1,
                            'update_time' => $time,
                        ];
                        Db::name('smtp_record')->where($RecordWhere)->update($RecordData);
                        $UsersData = [
                            'id'    => $this->users_id,
                            'is_email'    => '1',
                            'email'       => $post['email'],
                            'update_time' => $time,
                        ];
                        Db::name('users')->update($UsersData);

                        $this->success('操作成功！');
                    }
                }else{
                    $this->error('输入的邮箱地址和邮箱验证码不一致，请重新输入！');
                }
            }else{
                $this->error('邮箱、验证码不能为空！');
            }
        }
        $title = input('param.title/s');
        $this->assign('title',$title);
        return $this->fetch();
    }
    //修改密码
    public function pwd(){
        if (IS_AJAX_POST) {
            $post = input('post.');
            if (empty($post['oldpassword'])) {
                $this->error('原密码不能为空！');
            } else if (empty($post['password'])) {
                $this->error('新密码不能为空！');
            } else if ($post['password'] != $post['password2']) {
                $this->error('重复密码与新密码不一致！');
            }

            $users = Db::name("users")->field('password')->where([
                'id'  => $this->users_id,
            ])->find();
            if (!empty($users)) {
                if (strval($users['password']) === strval(func_encrypt($post['oldpassword']))) {
                    $r = Db::name("users")->where([
                        'id'  => $this->users_id,
                    ])->update([
                        'password'    => func_encrypt($post['password']),
                        'update_time' => getTime(),
                    ]);
                    if ($r) {
                        $this->success('修改成功');
                    }
                    $this->error('修改失败');
                }else{
                    $this->error('原密码错误，请重新输入！');
                }
            }
            $this->error('登录失效，请重新登录！');
        }
        return $this->fetch('users_pwd');
    }
    // 退出登陆
    public function logout()
    {
        session('users_id', null);
        setcookie('users_id','',getTime()-3600);
        $this->redirect(ROOT_DIR.'/');
    }
    //用户注册
    public function reg(){
        if ($this->users_id > 0) {
            $this->redirect('user/Users/centre');
            exit;
        }
        $is_vertify = 1; // 默认开启验证码
        $users_reg_captcha = config('captcha.users_reg');
        if (!function_exists('imagettftext') || empty($users_reg_captcha['is_on'])) {
            $is_vertify = 0; // 函数不存在，不符合开启的条件
        }
        $users_verification = !empty($this->usersConfig['users_verification']) ? $this->usersConfig['users_verification'] : 0;
        $this->assign('is_vertify', $is_vertify);
        $this->assign('users_verification', $users_verification);
        $levelList = Db::name("users_level")->where([
            'is_del' => 0,'is_system'=>1
        ])->select();
        $this->assign('level_list', $levelList);

        if (IS_AJAX_POST) {
            $post = input('post.');
            empty($post['email']) && $post['email'] = '';
            if (empty($post['mobile'])) {
                $this->error('登录手机号码不能为空！', null, ['status'=>1]);
            }
            if (empty($post['username'])) {
                $post['username'] = $post['mobile'];
            }
            if (empty($post['password'])) {
                $this->error('登录密码不能为空！', null, ['status'=>1]);
            }
            if (empty($post['verify_password'])) {
                $this->error('重复密码不能为空！', null, ['status'=>1]);
            }
            if ($post['password'] != $post['verify_password']) {
                $this->error('两次密码输入不一致！', null, ['status'=>1]);
            }
            if ($users_verification < 2 && 1 == $is_vertify) {     //第二次检测不需要再次检测验证码
                if (empty($post['vertify'])) {
                    $this->error('图片验证码不能为空！', null, ['status'=>1]);
                }
                $verify = new Verify();      // 处理判断验证码
                if (!$verify->check($post['vertify'], "users_reg")) {
                    $this->error('图片验证码错误', null, ['status'=>'vertify']);
                }
            }
            //用户名、邮箱、email唯一性检测
            $user = new \app\common\model\Users();
            if ($user_info = $user::check_update($post['username'],$post['mobile'],$post['email'])){
                if ($user_info['username'] == $post['username']){
                    $this->error("用户名{$post['username']}已被注册");
                }else if ($user_info['mobile'] == $post['mobile']){
                    $this->error("手机号码{$post['mobile']}已被注册");
                }else{
                    $this->error("邮箱{$post['email']}已被注册");
                }
            }
            $now_time = getTime();
            // 会员设置
            // 处理判断是否为后台审核，verification=1为后台审核。
            if (1 == $users_verification) {
                $data['is_activation'] = 0;     //等待后台激活
            }else if (2 == $users_verification){        // 验证邮箱验证码
                $data['is_email'] = 1;
                // 查询会员输入的邮箱并且为找回密码来源的所有验证码
                $RecordWhere = [
                    'source'   => 2,
                    'email'    => $post['email'],
                    'users_id' => 0,
                    'status'   => 0,
                    'code'     => $post['email_code']
                ];
                $RecordData = [
                    'status'      => 1,
                    'update_time' => $now_time,
                ];
                $r = Db::name("smtp_record")->where($RecordWhere)->update($RecordData);
                if (!$r){
                    $this->error("操作失败，邮箱验证码不正确");
                }
            }else if(3 == $users_verification){     //短信验证码
                $data['is_mobile'] = 1;
                $RecordWhere = ['mobile'=>$post['mobile'],'status'=>1,'scene'=>2,'code'=>$post['mobile_code']];
                $RecordData = [
                    'status'      => 2
                ];
                $r = Db::name("sms_log")->where($RecordWhere)->update($RecordData);
                if (!$r){
                    $this->error("操作失败，短信验证码不正确");
                }
            }

            // 添加会员到会员表
            $data['username']       = $post['username'];
            $data['nickname']       = !empty($post['nickname']) ? $post['nickname'] : func_substr_replace($post['username'],"*",3,4);
            $data['true_name']       = !empty($post['true_name']) ? $post['true_name'] : func_substr_replace($post['username'],"*",3,4);
            $data['mobile']       = !empty($post['mobile']) ? $post['mobile'] : '';
            $data['email']       = !empty($post['email']) ? $post['email'] : '';
            $data['password']       = func_encrypt($post['password']);
            $data['litpic']       = ROOT_DIR . '/public/static/common/images/dfboy.png';
            $data['reg_time']       = $now_time;
            $data['add_time']       = $now_time;
            $data['update_time']       = $now_time;
            $data['register_place'] = 2;  // 注册位置，后台注册不受注册验证影响，1为后台注册，2为前台注册。
//            $level_id = Db::name("users_level")->where([
//                'is_del' => 0,
//            ])->order("is_system desc")->getField('id');
            $data['level_id']  = !empty($post['level_id']) ? $post['level_id'] : 1;
            $users_id = Db::name("users")->insertGetId($data);
            // 判断会员是否添加成功
            if (!empty($users_id)) {
                $data_content = [
                    'users_id'=>$users_id,
                    'add_time'    => $now_time,
                    'update_time'    => $now_time
                ];
                if (1 == $users_verification){  // 需要后台审核
                    $url = url('user/Users/login');
                    $msg = "注册成功，等管理员激活才能登录！";
                    $status = 0;
                }else{  // 无需审核，直接登陆
                    session('users_id',$users_id);
                    if (session('users_id')){
                        setcookie('users_id',$users_id,null);
                        $data_content['login_count'] = 1;
                        $data_content['last_login'] = $now_time;
                        $data_content['last_ip'] = clientIP();
                        $url = url('user/Users/centre');
                        $msg = "注册成功，正在为您跳转至会员中心！";
                        $status = 1;
                    }else{
                        $url = url('user/Users/login');
                        $msg = "注册成功，请登录！";
                        $status = 0;
                    }
                }
                Db::name("users_content")->insertGetId($data_content);
                $this->success($msg, $url, ['status'=>$status]);
            }
            $this->error('注册失败', null, ['status'=>4]);
        }

        return $this->fetch('users_reg');
    }
    /*
     * 找回密码
     */
    public function retrieve_password(){
        if ($this->users_id > 0) {
            $this->redirect('user/Users/centre');
            exit;
        }
        $is_vertify = 1; // 默认开启验证码
        if (!function_exists('imagettftext') || empty($this->usersConfig['users_retrieve_password'])) {
            $is_vertify = 0; // 函数不存在，不符合开启的条件
        }
        $this->assign('is_vertify', $is_vertify);

        if (IS_AJAX_POST) {
            $post = input('post.');
            // POST数据基础判断
            if (empty($post['email'])) {
                $this->error('邮箱地址不能为空！');
            }
//            if (1 == $is_vertify) {
//                if (empty($post['vertify'])) {
//                    $this->error('图片验证码不能为空！');
//                }
//                $verify = new Verify();
//                if (!$verify->check($post['vertify'], "users_retrieve_password")) {
//                    $this->error('图形验证码错误，请重新输入！');
//                }
//            }
            if (empty($post['email_code'])) {
                $this->error('邮箱验证码不能为空！');
            }

            // 判断会员输入的邮箱是否已绑定
            $UsersWhere = array(
                'email'    => array('eq',$post['email']),
            );
            $UsersData = Db::name('users')->where($UsersWhere)->field('is_email')->find();
            if (empty($UsersData['is_email'])) {
                $this->error('邮箱未绑定，不能找回密码！');
            }

            // 查询会员输入的邮箱验证码是否存在
            $RecordWhere = [
                'code'  => $post['email_code'],
                'source' => 4,
                'email' => $post['email']
            ];
            $RecordData = Db::name('smtp_record')->where($RecordWhere)->field('status,add_time,email')->find();
            if (!empty($RecordData)) {
                // 邮箱验证码是否超时
                $time = getTime();
                $RecordData['add_time'] += Config::get('global.email_default_time_out');
                if ('1' == $RecordData['status'] || $RecordData['add_time'] <= $time) {
                    $this->error('邮箱验证码已被使用或超时，请重新发送！');
                }else{
                    session('users_retrieve_password_email', $post['email']); // 标识邮箱验证通过
                    $em  = rand(10,99).base64_encode($post['email']).'/=';
                    $url = url('user/Users/reset_password',['em' => base64_encode($em)]);
                    $this->success('操作成功', $url);
                }

            }else{
                $this->error('邮箱验证码不正确，请重新输入！');
            }
        }

        session('users_retrieve_password_email', null); // 标识邮箱验证通过

        return $this->fetch();
    }
    /*
     * 重置密码
     */
    public function reset_password(){
        if (IS_AJAX_POST) {
            $post = input('post.');
            if (empty($post['password'])) {
                $this->error('新密码不能为空！');
            }
            if ($post['password'] != $post['verify_password']) {
                $this->error('两次密码输入不一致！');
            }
            $email = session('users_retrieve_password_email');
            if (!empty($email)) {
                $data = [
                    'password'  => func_encrypt($post['password']),
                    'update_time'   => getTime(),
                ];
                $return  = Db::name("users")->where([
                    'email' => $email,
                ])->update($data);
                if ($return) {
                    session('users_retrieve_password_email', null); // 标识邮箱验证通过
                    $url = url('user/Users/login');
                    $this->success('重置成功，请使用新密码登陆！', $url);
                }
            }
            $this->error('重置失败！');
        }

        // 没有传入邮箱，重定向至找回密码页面
        $em = base64_decode(input('param.em/s'));
        $em = base64_decode(msubstr($em, 2, -2));
        $email = session('users_retrieve_password_email');
        if(empty($email) || !check_email($em) || $em != $email){
            $this->redirect('user/Users/retrieve_password');
            exit;
        }
        $users  = Db::name("users")->where([
            'email' => $email,
        ])->find();

        if (!empty($users)) {
            // 查询会员输入的邮箱并且为找回密码来源的所有验证码
            $RecordWhere = [
                'source'   => 4,
                'email'    => $email,
                'users_id' => 0,
                'status'   => 0,
            ];
            // 更新数据
            $RecordData = [
                'status'      => 1,
                'update_time' => getTime(),
            ];
            Db::name("smtp_record")->where($RecordWhere)->update($RecordData);
        }
        $this->assign('users', $users);
        return $this->fetch();
    }
}