<?php

namespace think\coding;

class Driver
{
    /**
     * @access public
     */
    static public function check_service_domain() {
        $keys_token = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','f','d','G','9','r','Z','W','5','+'));
        $keys_token = msubstr($keys_token, 1, strlen($keys_token) - 2);
        $token = config($keys_token);

        $keys = array_join_string(array('f','n','N','l','c','n','Z','p','Y','2','V','f','Z','X','l','+'));
        $keys = msubstr($keys, 1, strlen($keys) - 2);
        $domain = config($keys);
        $domainMd5 = md5('~'.base64_decode($domain).'~');

        if ($token != $domainMd5) {
            $msg = array_join_string(array('5','qC','4','5b','+','D','56','i','L5','b','q','P6','KK','r5','6+','h5','p','S5','77','y','M6','K+','35','bC','9','5','b+','r','6L','+Y','5Y6','f','77','yM','5oS','f6','LC','i5','Lq','r','5','5','S','o','5','b','y','A','5','r','qQ','5Y','W','N6','LS','5','R','W','p1','Q','21','z','5','oi','/','5L','q','n','57','2','R56','u','Z5','bu','6','6','K','6','+','57','O','7','57','u','f','Lg','=','='));
            $msg = msubstr($msg, 1, -1);
            die($msg);
        }

        return false;
    }

    static public function reset_copy_right()
    {
        static $request = null;
        null == $request && $request = \think\Request::instance();
        if ($request->module() == 'home' && $request->controller() == 'Index' && $request->action() == 'index') {
            $tmpArray = array('I','1','9','j','b','X','N','j','b','3','B','5','c','m','l','n','a','H','R','+');
            $cname = array_join_string($tmpArray);
            $cname = msubstr($cname, 1, strlen($cname) - 2);
            tpCache('php', [$cname=>'']);
        }
    }

    static public function set_copy_right($name, $globalTpCache = array())
    {
        $value = isset($globalTpCache[$name]) ? $globalTpCache[$name] : '';

        $tmpArray = array('f','n','d','l','Y','l','9','j','b','3','B','5','c','m','l','n','a','H','R','+');
        $tmpName = array_join_string($tmpArray);
        $tmpName = msubstr($tmpName, 1, strlen($tmpName) - 2);

        if ($name == $tmpName) {
            static $request = null;
            null == $request && $request = \think\Request::instance();
            if ($request->module() == 'home' && $request->controller() == 'Index' && $request->action() == 'index') {
                $tmpArray = array('I','19','j','bX','Njb','3','B5','c','m','ln','a','HR','+');
                $cname = array_join_string($tmpArray);
                $cname = msubstr($cname, 1, strlen($cname) - 2);
                $is_cr = tpCache('php.'.$cname);
                if ($name == $tmpName && empty($is_cr)) {
                    tpCache('php', [$cname=>get_rand_str(24, 0, 1)]);
                }
            }

            $tmpArray = array('IX','d','lY','l9','pc','1','9','hd','XR','ob3','J0','b2','tl','b','n','4=');
            $is_author_key = array_join_string($tmpArray);
            $is_author_key = msubstr($is_author_key, 1, strlen($is_author_key) - 2);
            if (!empty($globalTpCache[$is_author_key]) && -1 == intval($globalTpCache[$is_author_key])) {
                $tmp_array = array('PG','E','g','aH','Jl','Z','j0','i','a','HR','0','cD','ovL','3','d3','d','y','5l','anV','j','bX','Mu','Y','29','tL','3','Bv','d2','Vy','Yn','ku','c','G','h','w','Ii','B0','Y','X','J','n','ZX','Q','9','I','l9','i','bG','F','ua','y','I','+','UG','9','3Z','XJl','Z','C','Bi','e','SB','F','an','V','DbX','M','8','L','2','E','+');
                $value .= array_join_string($tmp_array);
            }
        }

        return $value;
    }

    static public function check_copy_right()
    {
        static $request = null;
        null == $request && $request = \think\Request::instance();
        if ($request->module() != 'admin') {
            $tmpArray = array('I','19','j','bX','Njb','3','B5','c','m','ln','a','HR','+');
            $cname = array_join_string($tmpArray);
            $cname = msubstr($cname, 1, strlen($cname) - 2);
            $val = tpCache('php.'.$cname);
            if (empty($val)) {
                $tmpArray = array('f','u','m','ml','umh','t','e','ao','o','ea','d','v+','m','H','jO','S','4j','e','WP','r+','e','8u','uW','wk','eW','6','le','mD','q','O','e','Ji','Oa','dg+','a','gh','+e','tv','u+8','m','nt','lan','U6','Z2','x','v','Ym','Fs','IG5','h','bW','U9','J','3','d','lYl','9','jb','3B','5','cm','l','na','H','Qn','I','C9','9f','g','=','=');
                $msg = array_join_string($tmpArray);
                $msg = msubstr($msg, 1, -1);
                exception($msg);
            }
        }
    }

    /**
     * 检!测!码
     * @access public
     */
    static public function check_author_ization()
    {
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
}
