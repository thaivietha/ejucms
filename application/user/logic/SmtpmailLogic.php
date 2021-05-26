<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\user\logic;

use think\Model;
use think\Db;
use think\Request;
use think\Config;

/**
 * 邮箱逻辑定义
 * Class CatsLogic
 * @package user\Logic
 */
class SmtpmailLogic extends Model
{
    /**
     * 初始化操作
     */
    public function initialize() {
        parent::initialize();
    }
    /**
     * 发送邮件
     */
    public function send_email($email = '', $title = '', $type = 'reg', $scene = 2)
    {
        if (empty($email)) {
            return ['code'=>0, 'msg'=>"邮箱地址参数不能为空！"];
        }
        // 查询扩展是否开启
        $openssl_funcs = get_extension_funcs('openssl');
        if (!$openssl_funcs) {
            return ['code'=>0, 'msg'=>"请联系空间商，开启php的 <font color='red'>openssl</font> 扩展！"];
        }
        // 是否填写邮件配置
        $smtp_config = tpCache('smtp');
        foreach ($smtp_config as $key => $val) {
            if (empty($val)) {
                return ['code'=>0, 'msg'=>"该功能待开放，网站管理员尚未完善邮件配置！"];
            }
        }
        // 邮件使用场景
        $send_email_scene = config('send_email_scene');
        $send_scene = $send_email_scene[$scene]['scene'];
        // 获取邮件模板
        $emailtemp = M('smtp_tpl')->where([
                'send_scene'=> $send_scene,
            ])->find();
        // 是否启用邮件模板
        if (empty($emailtemp) || empty($emailtemp['is_open'])) {
            return ['code'=>0, 'msg'=>"该功能待开放，网站管理员尚未启用(<font color='red'>{$emailtemp['tpl_name']}</font>)邮件模板"];
        }
        $users_id = session('users_id');
        if ('retrieve_password' == $type)    //找回密码
        {
            //找回密码
            // 判断会员是否已绑定邮箱
            $userswhere = array(
                'email'    => array('eq',$email),
            );
            $usersdata = M('users')->where($userswhere)->field('is_email,is_activation')->find();
            if (!empty($usersdata)) {
                if (empty($usersdata['is_activation'])) {
                    return ['code'=>0, 'msg'=>'该会员尚未激活，不能找回密码！'];
                } else if (empty($usersdata['is_email'])) {
                    return ['code'=>0, 'msg'=>'邮箱地址未绑定，不能找回密码！'];
                }
                $time = getTime();
                // 数据添加
                $datas['source']    = 4; // 来源，与场景ID对应：0=默认，2=注册，3=绑定邮箱，4=找回密码
                $datas['email']     = $email;
                $datas['code']      = rand(100000,999999);
                $datas['add_time']  = $time;
                M('smtp_record')->add($datas);
            }else{
                return ['code'=>0, 'msg'=>'邮箱地址不存在！'];
            }
        }
        else if ('bind_email' == $type)   //绑定邮箱
        {
            // 邮箱绑定
            // 判断邮箱是否已存在
            $listwhere = array(
                'email'     => array('eq',$email),
                'id' => array('neq',$users_id),
            );
            $users_list = M('users')->where($listwhere)->find();
            if(empty($users_list)){
                // 判断会员是否已绑定相同邮箱
                $userswhere = array(
                    'id' => array('eq',$users_id),
                    'email'    => array('eq',$email),
                    'is_email' => 1,
                );
                $usersdata = M('users')->where($userswhere)->field('is_email')->find();
                if (!empty($usersdata['is_email'])) {
                    return ['code'=>0, 'msg'=>'邮箱已绑定，无需重新绑定！'];
                }
                $time = getTime();
                $datas['source']    = 3; // 来源，与场景ID对应：0=默认，2=注册，3=绑定邮箱，4=找回密码
                $datas['email']     = $email;
                $datas['users_id']  = $users_id;
                $datas['code']      = rand(100000,999999);
                $datas['add_time']  = $time;
                M('smtp_record')->add($datas);
            }else{
                return ['code'=>0, 'msg'=>"邮箱已经存在，不可以绑定！"];
            }
        }else if ('reg' == $type)   //注册
        {
            // 注册
            // 判断邮箱是否已存在
            $listwhere = array(
                'email'     => array('eq',$email),
            );
            $users_list = M('users')->where($listwhere)->find();

            if (empty($users_list)) {
                $time = getTime();
                // 数据添加
                $datas['source']    = 2; // 来源，与场景ID对应：0=默认，2=注册，3=绑定邮箱，4=找回密码
                $datas['email']     = $email;
                $datas['code']      = rand(100000,999999);
                $datas['add_time']  = $time;
                M('smtp_record')->add($datas);
            }else{
                return ['code'=>0, 'msg'=>'邮箱已存在！'];
            }
        }

        // 判断标题拼接
        $web_name = $emailtemp['tpl_name'].'：'.$title.'-'.tpCache('web.web_name');

        $content = '感谢您的注册,您的邮箱验证码为: '.$datas['code'];
        $html = "<p style='text-align: left;'>{$web_name}</p><p style='text-align: left;'>{$content}</p>";
        if (isMobile()) {
            $html .= "<p style='text-align: left;'>——来源：移动端</p>";
        } else {
            $html .= "<p style='text-align: left;'>——来源：电脑端</p>";
        }


        // 实例化类库，调用发送邮件
        $res = send_email($email,$emailtemp['tpl_title'],$html, $send_scene);
        if (intval($res['code']) == 1) {
            return ['code'=>1, 'msg'=>$res['msg']];
        } else {
            return ['code'=>0, 'msg'=>$res['msg']];
        }
    }
}
