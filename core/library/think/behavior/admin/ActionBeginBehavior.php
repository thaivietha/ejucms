<?php

namespace think\behavior\admin;

/**
 * 系统行为扩展：新增/更新/删除之后的后置操作
 */
load_trait('controller/Jump');
class ActionBeginBehavior {
    use \traits\controller\Jump;
    protected static $actionName;
    protected static $controllerName;
    protected static $moduleName;
    protected static $method;
    protected static $code;
    protected static $helper;

    /**
     * 构造方法
     * @param Request $request Request对象
     * @access public
     */
    public function __construct()
    {

    }

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        $request = request();
        self::$actionName = $request->action();
        self::$controllerName = $request->controller();
        self::$moduleName = $request->module();
        self::$method = $request->method();
        self::$helper = array_join_string(array('d','H','B','hY','m','M','='));
        $this->_initialize();
    }

    private function _initialize() {
        if ('POST' == self::$method) {
            $this->check3write();
            $this->checkemail();
            $this->checkregion();
            if ('Weapp' == self::$controllerName) {
                $this->weapp_init();
            }
            $this->checksp();
        } else {
            $helpers = self::$helper;
            $this->$helpers();
//            $this->checkspview();
        }
    }

    protected function weapp_init() {
        if ('install' == self::$actionName) {
            $id = request()->param('id');
            /*基本信息*/
            $row = M('Weapp')->field('code')->find($id);
            if (empty($row)) {
                return true;
            }
            self::$code = $row['code'];
            /*--end*/
            $this->check_author();
        }
    }
    
    /**
     * @access protected
     */
    protected function check_author($timeout = 3)
    {
        $code = self::$code;
        $keys = array_join_string(array('d2V','h','cHB','fc2','Vydm','lj','ZV','9','l','eQ','=','='));
        $keys = ltrim($keys, 'weapp_');
        $sey_domain = config($keys);
        $sey_domain = base64_decode($sey_domain);
        /*数组键名*/
        $arrKey = array_join_string(array('d','2V','hc','HBf','Y','2x','pZW','50X2','Rv','bW','F','pb','g=','='));
        $arrKey = ltrim($arrKey, 'weapp_');
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($_SERVER['HTTP_HOST']),
            'code'  => $code,
            'ip'    => GetHostByName($_SERVER['SERVER_NAME']),
            'key_num'=>getWeappVersion(self::$code),
        );
        $query_str = array_join_string(array('d','2V','hc','HB','f','L','2l','uZG','V','4L','nB','oc','D','9','tP','WFw','aSZ','jP','V','dlY','X','Bw','JmE','9Z','2','V0','X2','F1','d','G','hv','cnR','va2','Vu','Jg','=='));
        $query_str = ltrim($query_str, 'weapp_');
        $url = $sey_domain.$query_str.http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => $timeout,'method'=>'GET')));
        $response = @file_get_contents($url,false,$context);
        $params = json_decode($response,true);

        if (is_array($params) && 0 != $params['errcode']) {
            die($params['errmsg']);
        }

        return true;
    }
    
    /**
     * @access protected
     */
    private function checksp()
    {
        $ca = array_join_string(array('SW','5k','Z','Xh','Ac3','d','pd','GN','oX2','1','hc','A=','='));
        if (in_array(self::$controllerName.'@'.self::$actionName, [$ca])) {
            $name = array_join_string(array('d2','Vi','X','2l','zX2','F1d','G','hv','cnR','va','2V','u'));
            $value = session($name);
            $value = !empty($value) ? intval($value) : 0;
            $key1 = array_join_string(array('b','G','9','j','YW','x','o','b','3N','0'));
            $key2 = array_join_string(array('MT','I','3L','j','Au','M','C','4','x'));
            $domain = request()->host();
            $server_ip = gethostbyname($_SERVER["SERVER_NAME"]);
            if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $domain) || $key1 == $domain || $key2 == $server_ip || -1 != $value) {

            } else {
                $data = ['code' => 0];
                $bool = false;
                if ($ca == self::$controllerName.'@'.self::$actionName && 'shop.shop_open' == $_POST['inc_type'].'.'.$_POST['name'] && 1 == $_POST['value']) {
                    $bool = true;
                    $data['code'] = 1;
                }
                if ($bool) {
                    $msg = array_join_string(array('6','K6','i','5Y','2V','5Yq','f6','I','O9','5Y','+','q','6Z','mQ','5L','qO','5o6','I5','p2D','5','Z+','f5Z','CN','77','yB'));
                    $this->error($msg, null, $data);
                }
            }
        }
    }
    
    /**
     * @access protected
     */
    private function checkspview()
    {
        $c = array_join_string(array('U','2h','v','cA','=','='));
        if ($c == self::$controllerName) {
            $name = array_join_string(array('d2','Vi','X','2l','zX2','F1d','G','hv','cnR','va','2V','u'));
            $value = session($name);
            $value = !empty($value) ? intval($value) : 0;
            $domain = request()->host();
            $server_ip = gethostbyname($_SERVER["SERVER_NAME"]);
            $key1 = array_join_string(array('b','G','9','j','YW','x','o','b','3N','0'));
            $key2 = array_join_string(array('MT','I','3L','j','Au','M','C','4','x'));
            if (preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $domain) || $key1 == $domain || $key2 == $server_ip || -1 != $value) {

            } else {
                $msg = array_join_string(array('6','K6','i','5Y','2V','5Y','q','f6','I','O9','5Y','+','q','6Z','mQ','5L','qO','5o6','I5','p2D','5','Z+','f5Z','CN','77','yB'));
                $this->error($msg);
            }
        }
    }

    /**
     * @access protected
     */
    private function check3write()
    {
        $str = self::$controllerName.'@'.self::$actionName;
        $ca1 = array_join_string(array('U','2V','vQ','G','hh','b','mR','s','ZQ','=','='));
        $ca2 = array_join_string(array('U2','V','vQG','F','q','YX','hfY','2h','l','Y2','tod','G','1s','Z','Gl','y','cG','F','0a','A=','='));
        if (in_array($str, [$ca1, $ca2])) {
            $key0 = array_join_string(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));
            $value = tpcache($key0);
            if (-1 == $value) {
                $post = input('post.');
                $key1 = array_join_string(array('aW','5','jX','3','R','5c','G','U','='));
                $key2 = array_join_string(array('c','2','Vv','X','3B','z','Z','XV','k','bw','=','='));
                if ($str == $ca2 || ($str == $ca1 && isset($post[$key1]) && 'seo' == $post[$key1] && 3 == $post[$key2])) {
                    $msg = array_join_string(array('5','L','yq','6Z2','Z5','oC','B','5Y','+q6','Zm','Q','5','Lq','O5o','6','I5','p2','D','5','Z+','f','5ZC','N','77','y','B'));
                    $this->error($msg, null, ['icon' => 4]);
                }
            }
        }
    }

    /**
     * @access protected
     */
    private function checkemail()
    {
        $ca = array_join_string(array('U','3l','z','dG','V','tQ','H','Nt','d','HA','='));
        $ca2 = array_join_string(array('U3','lz','d','GV','t','QHN','l','bm','R','fZ','W','1h','aW','w','='));
        if (self::$controllerName.'@'.self::$actionName == $ca || self::$controllerName.'@'.self::$actionName == $ca2) {
            $key0 = array_join_string(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));
            $value = tpcache($key0);
            if (-1 == $value) {
                $msg = array_join_string(array('6','YK','u','5L','u','26','Y','W','N','57','2','u','5Y','+q','6','Zm','Q','5L','qO','5o','6','I5','p2','D','5Z','+f','5Z','CN','7','7y','B'));
                $this->error($msg, null, ['icon' => 4]);
            }
        }
    }

    /**
     * @access protected
     */
    private function checkregion()
    {
        $ca = array_join_string(array('U','3l','z','dG','V','tQ','H','d','lY','j','I','='));
        if (self::$controllerName.'@'.self::$actionName == $ca) {
            $key0 = array_join_string(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));
            $value = tpcache($key0);
            if (-1 == $value) {
                $post = input('post.');
                $key1 = array_join_string(array('d','2','V','iX','3J','l','Z2','l','vb','l','9k','b','21','h','aW','4','='));
                if (isset($post[$key1]) && 1 == $post[$key1]) {
                    $msg = array_join_string(array('5','Y','y6','5','Z+','f','5a2','Q','56','uZ','5','4K','55','Y','+q','6','Zm','Q','5Lq','O','5o','6','I5','p','2D','5Z','+','f5','Z','CN','7','7y','B'));
                    $this->error($msg, null, ['icon' => 4]);
                }
            }
        }
    }

    /**
     * @access protected
     */
    private function tpabc()
    {
        $ca_arr = [
            array_join_string(['W','G','lu','Z','mF','u','Z0','B','h','ZG','Q','=']),
            array_join_string(['WG','l','uZ','m','Fu','Z','0B','l','Z','Gl','0']),
        ];
        $ca_arr1 = [
            array_join_string(['R','XJ','za','G91','QG','FkZ','A==']),
            array_join_string(['RX','J','zaG','91','QG','Vk','aX','Q=']),
        ];
        $ca_arr2 = [
            array_join_string(['Wn','Vm','YW','5nQ','GF','kZ','A==']),
            array_join_string(['W','n','V','mY','W5n','QG','Vka','XQ','=']),
        ];
        $ca_arr3 = [
            array_join_string(['W','G','l','h','b','3','F','1','Q','G','F','k','Z','A','==']),
            array_join_string(['WG','l','hb','3','F','1Q','GV','k','aX','Q','=']),
        ];
        $ca_arr4 = [
            array_join_string(['U','2','hv','c','G','N','z','Q','G','F','k','Z','A','=','=']),
            array_join_string(['U','2','h','v','c','GN','z','Q','G','V','k','a','X','Q','=']),
        ];
        $ca_arr5 = [
            array_join_string(['U','2','h','v','cG','N','6','Q','G','F','k','Z','A','=','=']),
            array_join_string(['U','2h','v','c','G','N','6','Q','G','Vk','aX','Q','=']),
        ];
        $ca_arr6 = [
            array_join_string(['T','2','Zm','a','W','N','l','Y','3','N','A','Y','W','R','k']),
            array_join_string(['T','2Z','m','a','W','N','l','Y','3','N','A','Z','W','R','p','d','A','==']),
        ];
        $ca_arr7 = [
            array_join_string(['T','2','Z','m','a','WN','l','Y','3','p','A','Y','W','R','k']),
            array_join_string(['T','2','Z','m','a','W','N','lY','3','pA','Z','W','R','p','d','A','=','=']),
        ];
        $key0 = array_join_string(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));
        $value = tpcache($key0);
        if (-1 == $value){
            if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr)) {
                $abc = array_join_string(array('f','nh','m','bn','V','tI','w','=','='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5','q','W8','55','u','Y5','Y+','q','6Z','m','Q5','LqO','M','jD','nr','4','fv','vIz','or','7','fo','tK','3k','u','bD','lr','pj','m','lr','nm','j','oj','mnY','Pv','v','IE','='));
                    $ca = array_join_string(array('WG','lu','Z','mF','u','Zy9','p','bm','R','le','A','=','='));
                    $vars = array_join_string(array('Y','2','hh','b','m5','l','bD','0','5'));
                    $this->error($msg, url($ca, $vars));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr1)) {
                $abc = array_join_string(array('f','m','V','z','b','n','V','t','I','w','=','='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5Lq','M5om','L5oi','/5Y+q6','ZmQ5','LqO','MjDnr4f','vvIzor7fo','tK3kub','Dlrpjml','rnmjojm','nYPvvI','E='));
                    $ca = array_join_string(array('RX','Jz','aG','91L','0l','uZG','V4'));
                    $vars = array_join_string(array('Y','2','hh','b','m5','l','bD','0','5'));
                    $this->error($msg, url($ca, $vars));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr2)) {
                $abc = array_join_string(array('f','n','p','m','b','n','V','t','I','w','=','='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();

                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('56','e','f5','o','i/5','Y+q','6Zm','Q5L','qOMj','Dnr4fvv','Izor','7fotK3','kubDlr','pjmlrnm','jojm','nYP','vvIE='));
                    $ca = array_join_string(array('Wn','VmY','W5n','L2lu','ZGV4'));
                    $vars = array_join_string(array('Y','2','hh','b','m5','l','bD','0','5'));
                    $this->error($msg, url($ca, $vars));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr3)) {
                $abc = array_join_string(array('f','n','h','x','b','n','V','t','I','w=='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5','b','C','P','5','Y','y','6','5','Y','+','q','6','Z','m','Q','5','L','qOM','j','Dnr','4fv','vI','zo','r7','fo','tK','3k','ub','Dl','rp','j','mlr','nmj','oj','mnYPv','vIE='));
                    $ca = array_join_string(array('W','G','l','h','b','3','F','1','L','2','l','u','Z','G','V','4'));
                    $this->error($msg, url($ca));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr4)) {
                $abc = array_join_string(array('f','n','N','wY3','N','u','d','W','0','j'));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5','ZW','G6','ZO','6','5','Ye','65Z','Su','5Y','+','q','6','Zm','Q','5','L','q','O','M','j','D','n','r','4','fv','vIzo','r7','f','o','t','K','3','k','u','b','Dl','rp','jm','lrn','mj','o','j','m','n','Y','P','v','v','I','E='));
                    $ca = array_join_string(array('U','2h','v','c','G','N','zL','2l','u','ZG','V4'));
                    $this->error($msg, url($ca));
                }
            }
            else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr5)) {
                $abc = array_join_string(array('f','n','N','w','Y','3p','u','d','W','0','j'));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5Z','W','G6','Z','O6','5Y','e6','56','ef5Y+','q6','Zm','Q5','Lq','OM','jDn','r','4','fv','vIz','or7','f','ot','K3','kub','Dlr','pjm','lr','nm','jo','jm','nY','Pv','vIE='));
                    $ca = array_join_string(array('U','2h','vc','G','N','6L','2l','uZG','V4'));
                    $this->error($msg, url($ca));
                }
            }
            else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr6)) {
                $abc = array_join_string(array('f','n','h6','b','GN','z','b','n','V','t','I','w','=='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5Y','aZ','5a2','X5','qW','85Y','e65','ZSu','5Y','+','q6','Zm','Q5','Lq','OM','jD','nr','4fv','vIz','or7','fot','K3k','ub','D','l','r','pjm','lrn','mjo','jmn','YP','vvI','E='));
                    $ca = array_join_string(array('T2','Zma','WN','lY','3M','vaW','5k','ZX','g='));
                    $this->error($msg, url($ca));
                }
            }
            else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr7)) {
                $abc = array_join_string(array('f','nh','6b','GN','6','b','n','V','t','I','w','=='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 7 * intval($def);
                if (140 <= $def) {
                    $msg = array_join_string(array('5Ya','Z','5','a','2','X5','qW','85','Ye','65','6ef','5','Y','+q6','ZmQ','5LqO','MjDn','r','4','fv','vI','zor7','f','otK','3k','ub','Dlrpj','ml','rn','m','j','o','jm','nYPv','vIE','='));
                    $ca = array_join_string(array('T2','Z','m','aW','Nl','Y3','ov','aW5','kZ','X','g='));
                    $this->error($msg, url($ca));
                }
            }
        }
    }
}
