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
use think\Db;
use app\user\model\Users;

class WxLogin extends Base
{
    private $users_db;
    /**
     * 构造方法
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function _initialize()
    {
        parent::_initialize();
        $this->users_db = Db::name('users');      // 会员数据表

        session('?users_id');
    }

    public function login()
    {
        $status = Db::name('weapp')->where('code', 'WxLogin')->getField('status');
        if ($status != 1) {
            $this->error('请后台启用微信扫码登录插件！');
        } else if (isMobile()) {
            $this->redirect('user/Users/users_select_login');
            exit;
        }

        /*上一个访问页面的URL*/
        $referurl = cookie('referurl');
        if (empty($referurl)) {
            $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url("user/Users/centre");
            cookie('referurl', $referurl);
        }
        /*end*/

        if ($this->users_id > 0) {
            $this->redirect('user/Users/centre');
            exit;
        }
        $web_basehost = tpCache('web.web_basehost');
        $redirect_uri = $web_basehost . $this->root_dir . '/index.php?m=plugins&c=WxLogin&a=callback&lang=cn';
        $redirect_uri = urlencode($redirect_uri);//该回调需要url编码
        $data         = Db::name('weapp')->where('code', 'WxLogin')->getField('data');
        $data         = unserialize($data);
        $appID        = $data['appid'];
        $scope        = "snsapi_login";//写死，微信暂时只支持这个值
        //准备向微信发请求
        $url = "https://open.weixin.qq.com/connect/qrconnect?appid=" . $appID . "&redirect_uri=" . $redirect_uri
            . "&response_type=code&scope=" . $scope . "&state=STATE#wechat_redirect";
        $this->redirect($url);
        exit;
    }

    public function callback()
    {
        $data   = Db::name('weapp')->where('code', 'WxLogin')->getField('data');
        $data   = unserialize($data);
        $appid  = $data['appid'];
        $secret = $data['secret'];
        //这个值决定了是自动生成用户还是弹出页面让用户选择绑定 1-用户可选择绑定或注册 0-自动生成用户
        $bind = $data['bind'];
        $code   = input('param.code/s');
        if (!empty($code))  //有code
        {
            //通过code获得 access_token + openid
            $url         = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid
                . "&secret=" . $secret . "&code=" . $code . "&grant_type=authorization_code";
            $jsonResult  = httpRequest($url);
            $resultArray = json_decode($jsonResult, true);
            if (!empty($resultArray['errcode'])) {
                $this->error($resultArray['errmsg']);
            }
            $access_token = $resultArray["access_token"];
            $openid       = $resultArray["openid"];
            $unionid      = $resultArray["unionid"];

            //通过access_token + openid 获得用户所有信息,结果全部存储在$infoArray里
            $infoUrl    = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid;
            $infoResult = httpRequest($infoUrl);
            $infoArray  = json_decode($infoResult, true);
            $nickname = filterNickname($infoArray['nickname']);

            if (!empty($infoArray['errcode'])) {
                $this->error($infoArray['errmsg']);
            }
            //先判断微信用户是否存在
            $we_user = Db::name('weapp_wxlogin')->where('unionid', $unionid)->field('users_id,sta')->find();
            $users = [];
            if (1 == $bind) {
                //自行选择注册或者绑定
            	if (empty($we_user)) {
	                //微信用户信息存在表里
	                Db::name('weapp_wxlogin')->insert([
	                    'headimgurl' => $infoArray['headimgurl'],
	                    'openid'     => $openid,
	                    'unionid'    => $unionid,
	                    'nickname'   => $nickname,
	                    'add_time'   => getTime(), 
	                ]);
	                $this->redirect(url('plugins/WxLogin/bind', ['wxid' => $unionid]));
	            } else {
	                if ( 0 == $we_user['users_id']) {
	                    $this->redirect(url('plugins/WxLogin/bind', ['wxid' => $unionid]));
	                } else{
	                	$users_id = $we_user['users_id'];
                        $users = $this->users_db->where('id',$users_id)->find();
                    }
	            }
	            if ( empty($users) ) {
	            	$this->redirect(url('plugins/WxLogin/bind', ['wxid' => $unionid]));
	            }
            }else{
            	//如果用户不存在  创建新用户
	            if (empty($we_user)) {
	                //微信用户信息存在表里
	                Db::name('weapp_wxlogin')->insert([
	                    'headimgurl' => $infoArray['headimgurl'],
	                    'openid'     => $openid,
	                    'unionid'    => $unionid,
	                    'nickname'   => $nickname,
	                    'add_time'   => getTime(),
	                ]);//自动生成
	            	$users_id = $this->setReg($unionid, $infoArray);
	            	if (!empty($users_id)) {
	            		Db::name('weapp_wxlogin')->where('unionid',$unionid)->update([
		                    'users_id' => $users_id,
		                    'update_time'   => getTime(),]);
	            	}
	            } else {
	                $users_id = $we_user['users_id'];
	            }
	            $users = $this->users_db->where([
	                'users_id' => $users_id,
	            ])->find();
	            if (empty($users)) {
	            	$users_id = $this->setReg($unionid, $infoArray);
	                if (!empty($users_id)) {
	                    Db::name('weapp_wxlogin')->where('unionid', $unionid)->update([
	                        'users_id'    => $users_id,
	                        'update_time' => getTime(),
	                    ]);
	                    $users = $this->users_db->find($users_id);
	                } else {
	                    $this->error('用户不存在,登录失败！', url('user/Users/login'));
	                }
	            }
            }
            
            if (empty($users['is_activation'])) {
                $this->error('该会员尚未激活，请联系管理员！', url('user/Users/login'));
            }
            // 跳转链接
            $referurl = cookie('referurl');
            Cookie::delete('referurl');
            if (strpos($referurl,'m=plugins&c=WxLogin&a=bind')) {
            	$this->redirect(url('user/Users/centre'));
            }
            $this->redirect($referurl);
        }
    }

    /**
     * 注册
     */
    private function setReg($unionid,$infoArray)
    {
        // 生成用户名
        $username = $this->createUsername();
        // 用户昵称
        $nickname = filterNickname($infoArray['nickname']);
        // 创建用户账号
        $addData  = [
            'username'            => $username,//用户名-生成
            'nickname'            => !empty($nickname) ? $nickname : $username,//昵称，同微信用户名
            'level_id'               => 1,
            'unionid'             => $unionid,
            'register_place'      => 2,
            'reg_time'            => getTime(),
            'head_pic'            => !empty($infoArray['headimgurl']) ? $infoArray['headimgurl'] : ROOT_DIR . '/public/static/common/images/dfboy.png',
            'add_time'            => getTime(),
        ];
        $users_id = $this->users_db->insertGetId($addData);

        return $users_id;
    }

    /**
     *微信扫码登录绑定/注册账号
     */
    public function bind($wxid)
    {
        $userModel = new \app\user\model\Users();
        // 跳转链接
        $referurl = url("user/Users/centre");
        if (IS_POST) {
            $post = input('post.');
            $type     = $post['type'];
            $unionid     = $post['wxid'];
            $username  = empty($post['username']) ? $post['mobile'] : $post['username'];
            $password     = $post['password'];
            $password2     = $post['password2'];
            //用户名查重
            $users_reg_notallow = explode(',', getUsersConfigData('users.users_reg_notallow'));
            if (!empty($users_reg_notallow)) {
                if (in_array($username, $users_reg_notallow)) {
                    $this->error('用户名为系统禁止注册！', null, ['status' => 1]);
                }
            }
            if (empty($post['mobile'])) {
                $this->error('登录手机号码不能为空！', null, ['status'=>1]);
            }
            if (empty($password)) {
                $this->error('登录密码不能为空！', null, ['status' => 0]);
            }
            if ( 1 == $type && empty($password2)) {
                $this->error('确认密码不能为空！', null, ['status' => 0]);
            }
            if (1 == $type &&!empty($password) && !empty($password2)) {
                if( func_encrypt($password) !== func_encrypt($password2)){
                	$this->error('两次输入密码不相同!', null, ['status' => 4]);
                }
            }
            $info = Db::name('weapp_wxlogin')->where('unionid', $unionid)->find();
            if ( $type == 1 ) {//empty($info['users_id'])
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
	            // 会员设置
	            $users_verification = getUsersConfigData('users.users_verification');
	            $users_verification = !empty($users_verification) ? $users_verification : 0;

	            // 处理判断是否为后台审核，verification=1为后台审核。
	            if (1 == $users_verification) $data['is_activation'] = 0;

	            // 添加会员到会员表
                $data['mobile']       = !empty($post['mobile']) ? $post['mobile'] : '';
	            $data['username']       = $username;
	            $data['nickname']       = !empty($info['nickname']) ? $info['nickname'] : $username;
	            $data['password']       = func_encrypt($password);
	            $data['is_mobile']      = !empty($ParaData['mobile_1']) ? 1 : 0;
	            $data['is_email']       = !empty($ParaData['email_2']) ? 1 : 0;
	            $data['last_ip']        = clientIP();
	            $data['head_pic']       = !empty($info['headimgurl']) ? $info['headimgurl'] : ROOT_DIR . '/public/static/common/images/dfboy.png';
	            $data['reg_time']       = getTime();
	            $data['last_login']     = getTime();
	            $data['register_place'] = 2;  // 注册位置，后台注册不受注册验证影响，1为后台注册，2为前台注册。

	            $level_id      = Db::name('users_level')->where([
	                'is_system' => 1,
	            ])->getField('id');
	            $data['level_id'] = $level_id;

	            $users_id = Db::name('users')->insertGetId($data);

	            // 判断会员是否添加成功
	            if (!empty($users_id)) {
	            	Db::name('weapp_wxlogin')->where('unionid', $unionid)->update([
                            'users_id'    => $users_id,
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
                $users = $this->users_db->where([
                    'mobile' => $post['mobile'],
                    'is_del'   => 0,
                ])->find();
                if ($users) {
                	$users_id = $users['id'];
                	//查询账号是否已绑定其他账号
                	$bind_user = Db::name('weapp_wxlogin')->where(['users_id'=> $users_id,'sta'=>1])->find();
                	if (empty($bind_user)) {
                		if (strval($users['password']) === strval(func_encrypt($post['password']))) {
	                        Db::name('weapp_wxlogin')->where('unionid', $unionid)->update([
	                            'users_id'    => $users_id,
	                            'sta'         => 1,
	                            'update_time' => getTime()
	                        ]);
                            session('users_id',$users_id);
                            if (session('users_id')){
                                setcookie('users_id',$users_id,null);
                            }
	                    } else {
	                        $this->error('密码不正确！', null, ['status' => 0]);
	                    }
                	}else{
                		$this->error('用户名已绑定微信账号！', null, ['status' => 1]);
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
        $this->assign('wxid', $wxid);
        $usersConfig = getUsersConfigData('users');
        $this->assign('usersConfig', $usersConfig);
        $html = $this->fetch('./public/plugins/template/wxlogin/bind.htm');
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
        //return $this->fetch('template/plugins/wxlogin/bind.htm');
    }

     /**
     * 生成用户名，确保唯一性
     */
    public function createUsername()
    {
        $username = 'WX' . get_rand_str(6, 0, 1);
        $username = strtoupper($username);
        $count = $this->users_db->where('username', $username)->count();
        if (!empty($count)) {
            return $this->createUsername();
        }

        return $username;
    }
}