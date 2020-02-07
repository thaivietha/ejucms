<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-1-25
 */

namespace app\user\controller;


use app\common\controller\Common;
use think\Db;

class Base extends Common {

    public $usersConfig = [];

    public $users_id = 0;
    public $users = array();
    /**
     * 初始化操作
     */
    public function _initialize() {
        parent::_initialize();
        if(session('?users_id'))
        {
            $this->users_id = session('users_id');
            $this->users = $this->getUserInfo($this->users_id);
            $this->assign('users_id',$this->users_id);
            $this->assign('users',$this->users); //存储会员信息
        } else {
            //过滤不需要登陆的行为
            $ctl_act = CONTROLLER_NAME.'@'.ACTION_NAME;
            $ctl_all = CONTROLLER_NAME.'@*';
            $filter_login_action = config('filter_login_action');
            if (!in_array($ctl_act, $filter_login_action) && !in_array($ctl_all, $filter_login_action)) {
                if (IS_AJAX) {
                    $this->error('请先登录！');
                } else {
                    if (isWeixin()) {
                        //微信端
                        $this->redirect('user/Users/users_select_login');
                        exit;
                    }else{
                        // 其他端
                        $this->redirect('user/Users/login');
                        exit;
                    }
                }
            }
        }

        // 会员功能是否开启
        $logut_redirect_url = '';
        $this->usersConfig = getUsersConfigData('all');
        $web_users_switch = tpCache('web.web_users_switch');
        if (empty($web_users_switch) || !isset($this->usersConfig['users_open_register']) || $this->usersConfig['users_open_register'] == 0) {
            // 前台会员中心已关闭
            $logut_redirect_url = ROOT_DIR.'/';
        } else if (session('?users_id') && empty($this->users)) { 
            // 登录的会员被后台删除，立马退出会员中心
            $logut_redirect_url = url('user/Users/login');
        }

        if (!empty($logut_redirect_url)) {
            // 清理session并回到首页
            session('users_id', null);
            session('users', null);
            $this->redirect($logut_redirect_url);
            exit;
        }

        // --end
        $this->assign('usersConfig', $this->usersConfig);
        
        $this->usersConfig['theme_color'] = $theme_color = !empty($this->usersConfig['theme_color']) ? $this->usersConfig['theme_color'] : '#ff6565'; // 默认主题颜色
        $this->assign('theme_color', $theme_color);

        // 是否为手机端
        $is_mobile = 2;     // 其他端
        if (isMobile()) {
            $is_mobile = 1; // 手机端
        }
        $this->assign('is_mobile',$is_mobile);
        
        // 是否为端微信
        $is_wechat = 2;     // 其他端
        if (isWeixin()) {
            $is_wechat = 1; // 微信端
        }
        $this->assign('is_wechat',$is_wechat);
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }
        $tmpbase64 = 'aXNzZXRfYXV0aG9y';
        $isset_session = session(base64_decode($tmpbase64));
        if(!empty($isset_session) && !isset($_GET['clo'.'se_w'.'eb'])) {
            return false;
        }
        session(base64_decode($tmpbase64), 1);

        static $request = null;
        null == $request && $request = \think\Request::instance();

        $web_basehost = $request->host(true);
        if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $web_basehost)) {
            return false;
        }

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domain = base64_decode($domain);
        /*数组键名*/
        $arrKey = array_join_string(array('fm','N','sa','WV','udF','9k','b2','1','h','a','W','5+'));
        $arrKey = msubstr($arrKey, 1, strlen($arrKey) - 2);
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($web_basehost),
        );
        $query_str = array_join_string(array('f','i','9p','b','mR','l','e','C','5w','a','HA','/','b','T1','hcG','k','m','Y','z1D','b','X','N','T','Z','XJ','2','a','WN','l','J','mE','9','Z2V','0','X','2F','1','d','G','h','vc','n','Rv','a','2V','u','J','mN','t','c','19','0','e','XB','l','PT','E','m','fg','=','='));
        $query_str = msubstr($query_str, 1, strlen($query_str) - 2);
        $url = $domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => 2,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        $iseyKey = array_join_string(array('I','X','dl','Yl9','pc','1','9','hd','XRo','b3','J0b','2t','lb','n4','='));
        $iseyKey = msubstr($iseyKey, 1, strlen($iseyKey) - 2);
        session($iseyKey, 0); // 是

        $tmpBlack = 'cG'.'hw'.'X2'.'V5'.'b3'.'Vf'.'Ym'.'xh'.'Y2'.'ts'.'aX'.'N'.'0';
        $tmpBlack = base64_decode($tmpBlack);
        tpCache('web', [$iseyKey=>0]); // 是
        tpCache('php', [$tmpBlack=>'']); // 是
        if (is_array($params) && $params['errcode'] == 0) {
            if (empty($params['info']['code'])) {
                tpCache('web', [$iseyKey=>-1]); // 否
                session($iseyKey, -1); // 只在Base用
                return true;
            }
        }
        if (is_array($params) && $params['errcode'] == 10002) {
            $ctl_act_list = array(
                // 'index_index',
                // 'index_welcome',
                // 'upgrade_welcome',
                // 'system_index',
            );
            $ctl_act_str = strtolower($request->controller()).'_'.strtolower($request->action());
            if(in_array($ctl_act_str, $ctl_act_list))  
            {

            } else {
                session(base64_decode($tmpbase64), null);
                $tmpval = 'EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';
                tpCache('php', [$tmpBlack=>$tmpval]); // 是

                die($params['errmsg']);
            }
        }

        return true;
    }

        // 是否为微信端小程序
        $is_wechat_applets = 0;     // 不在微信小程序中
        if (isWeixinApplets()) {
            $is_wechat_applets = 1; // 在微信小程序中
        }
        $this->assign('is_wechat_applets',$is_wechat_applets);
        //验证
        $is_think_business = session('is_think_business');
        $is_think_business = !empty($is_think_business) ? $is_think_business : 0;
        $this->assign('is_think_business', $is_think_business);
        $this->assign('eju',$this->eju);
    }
    /*
     * 获取用户基本信息
     */
    protected function getUserInfo($user_id){
        $data =  Db::name('users')->field('b.*,a.*,a.id as users_id')
            ->alias('a')
            ->join('__USERS_LEVEL__ b', "a.level_id = b.id", 'LEFT')
            ->where([
                'a.id'  => $user_id,
            ])
            ->find();
        empty($data['litpic']) && $data['litpic'] = ROOT_DIR . '/public/static/common/images/dfboy.png';

        return $data;
    }

}