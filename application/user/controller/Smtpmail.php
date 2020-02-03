<?php
/**
 * User: xyz
 * Date: 2019/11/11
 * Time: 16:36
 */

namespace app\user\controller;

use app\user\logic\SmtpmailLogic;
use think\Verify;

class Smtpmail extends Base
{
    public $smtpmailLogic;

    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->smtpmailLogic = new SmtpmailLogic;
    }
    /*
     * 注册邮箱发送
     */
    public function send_email_reg($email = '', $title = '', $type = 'reg', $scene = 2,$mobile = '',$vertify = ''){
        // 超时后，断掉邮件发送
        function_exists('set_time_limit') && set_time_limit(5);
        $users_reg_captcha = config('captcha.users_reg');
        if (function_exists('imagettftext') && !empty($users_reg_captcha['is_on'])) {
            if (empty($vertify)) {
                $this->error('图片验证码不能为空！', null, ['status'=>1]);
            }
            $verify = new Verify();      // 处理判断验证码
            if (!$verify->check($vertify, "users_reg")) {
                $this->error('图片验证码错误', null, ['status'=>'vertify']);
            }
        }
        $user = new \app\common\model\Users();
        if (empty($mobile)){
            $this->error("手机号码不能为空");
        }
        if ($user_info = $user::check_update($mobile,$mobile,$email)){
            if ($user_info['mobile'] == $mobile){
                $this->error("手机号码{$mobile}已被注册");
            }else if ($user_info['username'] == $mobile){
                $this->error("用户名{$mobile}已被注册");
            }else{
                $this->error("邮箱{$email}已被注册");
            }
        }
        $data = $this->smtpmailLogic->send_email($email, $title, $type, $scene);
        if (1 == $data['code']) {
            $this->success($data['msg']);
        } else {
            $this->error($data['msg']);
        }
    }
    /*
     * 找回密码发送邮件
     */
    public function send_email_retrieve($email = '', $title = '', $type = 'reg', $scene = 2,$vertify = ''){
        // 超时后，断掉邮件发送
        function_exists('set_time_limit') && set_time_limit(5);
        $usersConfig = getUsersConfigData('all');
        if (function_exists('imagettftext') && ! empty($usersConfig['users_retrieve_password'])) {
            if (empty($vertify)) {
                $this->error('图片验证码不能为空！', null, ['status'=>1]);
            }
            $verify = new Verify();      // 处理判断验证码
            if (!$verify->check($vertify, "users_retrieve_password")) {
                $this->error('图片验证码错误', null, ['status'=>'vertify']);
            }
        }

        $data = $this->smtpmailLogic->send_email($email, $title, $type, $scene);
        if (1 == $data['code']) {
            $this->success($data['msg']);
        } else {
            $this->error($data['msg']);
        }
    }
    /**
     * 绑定发送邮件
     */
    public function send_email($email = '', $title = '', $type = 'reg', $scene = 2)
    {
        // 超时后，断掉邮件发送
        function_exists('set_time_limit') && set_time_limit(5);
        $data = $this->smtpmailLogic->send_email($email, $title, $type, $scene);
        if (1 == $data['code']) {
            $this->success($data['msg']);
        } else {
            $this->error($data['msg']);
        }
    }
    /*
     * 发送注册短信
     */
    public function send_mobile_reg($mobile = '',$vertify = ''){
        // 超时后，断掉邮件发送
        function_exists('set_time_limit') && set_time_limit(5);
        $users_reg_captcha = config('captcha.users_reg');
        if (function_exists('imagettftext') && !empty($users_reg_captcha['is_on'])) {
            if (empty($vertify)) {
                $this->error('图片验证码不能为空！', null, ['status'=>1]);
            }
            $verify = new Verify();      // 处理判断验证码
            if (!$verify->check($vertify, "users_reg")) {
                $this->error('图片验证码错误', null, ['status'=>'vertify']);
            }
        }
        $user = new \app\common\model\Users();
        if (empty($mobile)){
            $this->error("手机号码不能为空");
        }
        if ($user_info = $user::check_mobile($mobile)){
            if (!empty($user_info) && $user_info['mobile'] == $mobile){
                $this->error("手机号码{$mobile}已被注册");
            }
        }
        $res = sendSms(1, $mobile, ['content'=>mt_rand(100000,999999)]);
        if (intval($res['code']) == 1) {
            $this->success($res['msg']);
        } else {
            $this->error($res['msg']);
        }
    }

}