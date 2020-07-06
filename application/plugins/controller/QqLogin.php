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

namespace app\plugins\controller;

use think\Cookie;
use weapp\QqLogin\vendor\qq;
use think\Db;

class QqLogin extends Base
{
    private $qqappid = '';
    private $qqappkey = '';
    private $bind = '';
    private $qqbackpath = "";
    private $qqHelper;

    /**
     * 构造方法
     */
    public function __construct()
    {
        parent::__construct();
        $qqlogin = Db::name('weapp')->where('code', 'QqLogin')->find();
        if (empty($qqlogin['status'])) {
            $this->error('请后台启用QQ登录插件！');
        }
        $data = unserialize($qqlogin['data']);
        if (empty($data['appid']) || empty($data['appkey'])) {
            $this->error("登录失败，请联系管理员配置QQ登录信息");
        }
        $this->qqappid    = $data['appid'];
        $this->qqappkey   = $data['appkey'];
        $this->bind       = $data['bind'];
        $this->qqHelper   = new qq($this->qqappid, $this->qqappkey);
        $web_basehost = tpCache('web.web_basehost');
        $this->qqbackpath = $web_basehost . $this->root_dir . '/index.php?m=plugins&c=QqLogin&a=callback';
    }

    //登陆
    public function login()
    {
        $this->qqHelper->login($this->qqappid, $this->qqbackpath);
    }

    //返回
    public function callback()
    {
        $this->qqHelper->callback($this->qqbackpath);
        $openid = $this->qqHelper->get_openid();
        $bind = $this->bind;
        $users  = [];
        $origin = Db::name("weapp_qqlogin")->where('openid', $openid)->find();    //判断是否存在
        if (1==$bind){
            if (!empty($origin)) {   //已经使用此qq登陆过
                if (empty($origin['sta'])) {//但是没有sta标识  0-需要注册或者绑定
                    $this->redirect(url('plugins/QqLogin/bind', ['qqid' => $openid]));
                } else {
                    $users = Db::name("users")->where([
                        'id' => $origin['users_id'],
                    ])->find();
                    if (empty($users)){
                        $this->redirect(url('plugins/QqLogin/bind', ['qqid' => $openid]));
                    }
                }
            } else {      //未使用该qq登陆过
                Db::name('weapp_qqlogin')->insert([
                    'openid'   => $openid,
                    'add_time' => getTime(),
                ]);
                $this->redirect(url('plugins/QqLogin/bind', ['qqid' => $openid]));
            }
        }else{
            if (!empty($origin)){   //已经使用此qq登陆过
                $users = Db::name("users")->where([
                    'id' => $origin['users_id'],
                ])->find();
                if (empty($users)) {
                    //不存在，自动注册账号，并且登陆
                    $users = $this->setReg($openid);
                    if (!empty($users['users_id'])) {
                        Db::name('weapp_qqlogin')->where('openid', $openid)->update([
                            'users_id'  => $users['id'],
                            'update_time'   => getTime(),
                        ]);
                    }
                }
            }else{      //未使用该qq登陆过
                $users = $this->setReg($openid);
                if (!empty($users)) {
                    Db::name('weapp_qqlogin')->insert([
                        'users_id'   => $users['id'],
                        'openid'     => $openid,
                        'nickname'   => $users['nickname'],
                        'add_time'   => getTime(),
                    ]);
                }
            }
        }
        $this->setLogin($users);
    }


    /**
     *扫码登录绑定/注册账号
     */
    public function bind($qqid)
    {
        $userModel = new \app\user\model\Users();
        // 跳转会员中心链接
        $referurl = url("user/Users/centre");
        if (IS_POST) {
            $post      = input('post.');
            $type      = $post['type'];
            $openid    = $post['qqid'];
            $username  = empty($post['username']) ? $post['mobile'] : $post['username'];
            $password  = $post['password'];
            $password2 = $post['password2'];
            //用户名查重
            $users_reg_notallow = explode(',', getUsersConfigData('users.users_reg_notallow'));
            if (empty($post['mobile'])) {
                $this->error('登录手机号码不能为空！', null, ['status'=>1]);
            }
            empty($post['email']) && $post['email'] = '';
            if (empty($password)) {
                $this->error('登录密码不能为空！', null, ['status' => 0]);
            }
            if (1 == $type && empty($password2)) {
                $this->error('确认密码不能为空！', null, ['status' => 0]);
            }
            if (1 == $type && !empty($password) && !empty($password2)) {
                if (func_encrypt($password) !== func_encrypt($password2)) {
                    $this->error('两次输入密码不相同!', null, ['status' => 4]);
                }
            }
            if ($type == 1) {//注册
                //用户名、邮箱、email唯一性检测
                $user = new \app\common\model\Users();
                if ($user_info = $user::check_update($post['username'],$post['mobile'],$post['email'])){
                    if ($user_info['username'] == $post['username']){
                        $this->error("用户名{$post['username']}已被注册", null, ['status'=>1]);
                    }else if ($user_info['mobile'] == $post['mobile']){
                        $this->error("手机号码{$post['mobile']}已被注册", null, ['status'=>1]);
                    }else{
                        $this->error("邮箱{$post['email']}已被注册", null, ['status'=>1]);
                    }
                }
                $qq_info = $this->qqHelper->get_user_info();
                $qq_info = json_decode($qq_info, true);
                if (!empty($qq_info['nickname'])) {
                    $qq_info['nickname'] = filterNickname($qq_info['nickname']);
                }
                if (!empty($qq_info['figureurl_qq_2'])) {
                    $head_pic = $qq_info['figureurl_qq_2'];
                } else {
                    $head_pic = $qq_info['figureurl_qq_1'];
                }
                $head_pic = !empty($head_pic) ? $head_pic : ROOT_DIR . '/public/static/common/images/dfboy.png';
                // 添加会员到会员表。
                $data['mobile']       = !empty($post['mobile']) ? $post['mobile'] : '';
                $data['username']       = $username;
                $data['nickname']       = !empty($qq_info['nickname']) ? $qq_info['nickname'] : $username;
                $data['true_name']       = !empty($qq_info['nickname']) ? $qq_info['nickname'] : $username;
                $data['password']       = func_encrypt($password);
                $data['is_mobile']      = !empty($ParaData['mobile_1']) ? 1 : 0;
                $data['is_email']       = !empty($ParaData['email_2']) ? 1 : 0;
                $data['last_ip']        = clientIP();
                $data['head_pic']       = $head_pic;
                $data['reg_time']       = getTime();
                $data['last_login']     = getTime();
                $data['register_place'] = 2;  // 注册位置，后台注册不受注册验证影响，1为后台注册，2为前台注册。

                $level_id      = Db::name('users_level')->where([
                    'is_system' => 1,
                ])->getField('id');
                $data['level'] = $level_id;

                $users_id = Db::name('users')->insertGetId($data);
                // 判断会员是否添加成功
                if (!empty($users_id)) {
                    Db::name('weapp_qqlogin')->where('openid', $openid)->update([
                        'users_id'    => $users_id,
                        'nickname'    => $data['nickname'],
                        'sta'         => 1,
                        'update_time' => getTime()
                    ]);
                    $now_time = time();
                    $data_content = [
                        'users_id'=>$users_id,
                        'add_time'    => $now_time,
                        'update_time'    => $now_time
                    ];
                    session('users_id',$users_id);
                    if (session('users_id')){
                        setcookie('users_id',$users_id,null);
                        $data_content['login_count'] = 1;
                        $data_content['last_login'] = $now_time;
                        $data_content['last_ip'] = clientIP();
                    }
                    Db::name("users_content")->insertGetId($data_content);
                    $this->success('登录成功！', $referurl, ['status' => 2]);
                }
                $this->error('注册失败', null, ['status' => 5]);

            } elseif ($type == 2) {
                //绑定已有账号
                $users = Db::name('users')->where([
                    'mobile' => $post['mobile'],
                    'is_del'   => 0,
                ])->find();
                if ($users) {
                    $users_id = $users['id'];
                    //查询账号是否已绑定其他账号
                    $bind_user = Db::name('weapp_qqlogin')->where(['users_id' => $users_id, 'sta' => 1])->find();
                    if (empty($bind_user)) {
                        if (strval($users['password']) === strval(func_encrypt($post['password']))) {
                            Db::name('weapp_qqlogin')->where('openid', $openid)->update([
                                'users_id'    => $users_id,
                                'sta'         => 1,
                                'nickname'    => $users['nickname'],
                                'update_time' => getTime()
                            ]);
                            session('users_id',$users_id);
                            if (session('users_id')){
                                setcookie('users_id',$users_id,null);
                            }
                        } else {
                            $this->error('密码不正确！', null, ['status' => 0]);
                        }
                    } else {
                        $this->error('用户名已绑定QQ账号！', null, ['status' => 1]);
                    }

                } else {
                    $this->error('用户不存在！', null, ['status' => 1]);
                }
            }
            $this->success('登录成功！', $referurl, ['status' => 2]);
        }
        // 默认主题颜色
        $theme_color = getUsersConfigData('theme_color');
        $theme_color = !empty($theme_color) ? $theme_color : '#ff6565';

        $this->assign('theme_color', $theme_color);
        $this->assign('qqid', $qqid);
        $usersConfig = getUsersConfigData('users');
        $this->assign('usersConfig', $usersConfig);

        $html = $this->fetch('./public/plugins/template/qqlogin/bind.htm');
        if (isMobile()) {
            $str = <<<EOF
<div id="update_mobile_file" style="display: none;">
    <form id="form1" style="text-align: center;" >
        <input type="button" value="点击上传" onclick="up_f.click();" class="btn btn-primary form-control"/><br>
        <p><input type="file" id="up_f" name="up_f" onchange="MobileHeadPic();" style="display:none"/></p>
    </form>
</div>
</body>
EOF;
            $html = str_ireplace('</body>', $str, $html);
        }

        return $html;
//        return $this->fetch('template/plugins/qqlogin/bind.htm');
    }
    //登陆
    public function setLogin($users)
    {
        if (!empty($users)) {
            if (empty($users['is_activation'])) {
                $this->error('该会员尚未激活，请联系管理员！', url('user/Users/login'));
            }
            session('users_id',$users['id']);
            if (session('users_id')){
                setcookie('users_id',$users['id'],null);
            }
            $referurl = url("user/Users/centre");
            // 跳转链接
            $this->redirect($referurl);
        } else {
            $this->error('登录失败', null, ['status' => 1]);
        }
    }

    /**
     * 生成用户名，确保唯一性
     */
    public function createUsername($username = '')
    {
        if (empty($username)) {
            $username = 'QQ' . get_rand_str(6, 0, 1);
        }
        $username = strtoupper($username);
        $count    = Db::name('users')->where('username', $username)->count();
        if (!empty($count)) {
            $username = 'QQ' . get_rand_str(6, 0, 1);
            return $this->createUsername($username);
        }

        return $username;
    }

    //注册
    public function setReg($openid)
    {
        $users   = [];
        $qq_info = $this->qqHelper->get_user_info();
        $qq_info = json_decode($qq_info, true);
        if (!empty($qq_info['nickname'])) {
            $qq_info['nickname'] = filterNickname($qq_info['nickname']);
        }
        if (!empty($qq_info['figureurl_qq_2'])) {
            $head_pic = $qq_info['figureurl_qq_2'];
        } else {
            $head_pic = $qq_info['figureurl_qq_1'];
        }
        $now_time = getTime();
        $head_pic = !empty($head_pic) ? $head_pic : ROOT_DIR . '/public/static/common/images/dfboy.png';
        $username                    = 'QQ' . substr($openid, 2, 6);
        $username                    = $this->createUsername($username);
        $data['username']            = $username;
        $data['nickname']            = !empty($qq_info['nickname']) ? $qq_info['nickname'] : $username;
        $data['level_id']               = 1;
        $data['openid']              = $openid;
        $data['register_place']      = 2; // 注册位置，后台注册不受注册验证影响，1为后台注册，2为前台注册。
        $data['reg_time']            = $now_time;
        $data['head_pic']            = $head_pic;
        $data['add_time']            = $now_time;
        $users_id                    = Db::name('users')->insertGetId($data);
        if (!empty($users_id)) {
            $data_content = [
                'users_id'=>$users_id,
                'add_time'    => $now_time,
                'update_time'    => $now_time,
                'login_count'    => 1,
                'last_login'    => $now_time,
                'last_ip'    => clientIP(),
            ];
            Db::name("users_content")->insertGetId($data_content);
            $users = Db::name('users')->find($users_id);
        }
        return $users;
    }
}