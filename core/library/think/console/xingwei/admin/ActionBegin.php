<?php

namespace think\console\xingwei\admin;

/**
 * 操作开始执行
 */
load_trait('controller/Jump');

class ActionBegin
{
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
        self::$helper = arrayJointString(['dHB','hY','mM=']);
        $this->_initialize();
    }

    private function _initialize()
    {
        if ('POST' == self::$method) {
            $this->tp3();
            $this->tp1();
            $this->tp2();
            if ('Weapp' == self::$controllerName) {
                $this->weapp_init();
            }
        } else {
            $helpers = self::$helper;
            $this->$helpers();
        }
    }

    protected function weapp_init()
    {
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
        $keys = arrayJointString(array('d2V', 'h', 'cHB', 'fc2', 'Vydm', 'lj', 'ZV', '9', 'l', 'eQ', '=', '='));
        $keys = ltrim($keys, 'weapp_');
        $sey_domain = config($keys);
        $sey_domain = base64_decode($sey_domain);
        /*数组键名*/
        $arrKey = arrayJointString(array('d', '2V', 'hc', 'HBf', 'Y', '2x', 'pZW', '50X2', 'Rv', 'bW', 'F', 'pb', 'g=', '='));
        $arrKey = ltrim($arrKey, 'weapp_');
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($_SERVER['HTTP_HOST']),
            'code' => $code,
            'ip' => GetHostByName($_SERVER['SERVER_NAME']),
            'key_num' => getWeappVersion(self::$code),
        );
        $query_str = arrayJointString(array('d', '2V', 'hc', 'HB', 'f', 'L', '2l', 'uZG', 'V', '4L', 'nB', 'oc', 'D', '9', 'tP', 'WFw', 'aSZ', 'jP', 'V', 'dlY', 'X', 'Bw', 'JmE', '9Z', '2', 'V0', 'X2', 'F1', 'd', 'G', 'hv', 'cnR', 'va2', 'Vu', 'Jg', '=='));
        $query_str = ltrim($query_str, 'weapp_');
        $url = $sey_domain . $query_str . http_build_query($vaules);
        $context = stream_context_set_default(array('http' => array('timeout' => $timeout, 'method' => 'GET')));
        $response = @file_get_contents($url, false, $context);
        $params = json_decode($response, true);

        if (is_array($params) && 0 != $params['errcode']) {
            die($params['errmsg']);
        }

        return true;
    }

    /**
     * write @access protected
     */
    private function tp3()
    {
        $tips = arrayJointString(['ZX', 'Jy', 'b3', 'I=']);
        $str = self::$controllerName . '@' . self::$actionName;
        $ca1 = arrayJointString(['U', '2V', 'vQ', 'G', 'hh', 'b', 'mR', 's', 'ZQ', '=', '=']);
        $ca2 = arrayJointString(['U2', 'V', 'vQG', 'F', 'q', 'YX', 'hfY', '2h', 'l', 'Y2', 'tod', 'G', '1s', 'Z', 'Gl', 'y', 'cG', 'F', '0a', 'A=', '=']);
        if (in_array($str, [$ca1, $ca2])) {
            $key0 = arrayJointString(['d', '2', 'Vi', 'L', 'n', 'dl', 'Yl9', 'p', 'c1', '9', 'hd', 'XRo', 'b', '3J', '0b', '2', 'tl', 'b', 'g=', '=']);
            $value = tpcache($key0);
            $value *= 9;
            if (-9 == $value) {
                $post = input('post.');
                $key1 = arrayJointString(['aW5jX', '3R5cG', 'U=']);
                $key2 = arrayJointString(['c2Vv', 'X3BzZ', 'XVkbw', '==']);
                if ($str == $ca2 || ($str == $ca1 && isset($post[$key1]) && 'seo' == $post[$key1] && 3 == $post[$key2])) {
                    $ico4 = 4;
                    $this->$tips(arrayJointString(['5Lyq', '6Z2', 'Z5', 'oC', 'B5Y+q6', 'Zm', 'Q', '5', 'Lq', 'O5o', '6', 'I5', 'p2', 'D5Z+f', '5ZC', 'N77yB']), null, ['icon' => $ico4]);
                }
            }
        }
    }

    /**
     * email @access protected
     */
    private function tp1()
    {
        $ca = arrayJointString(['U', '3l', 'z', 'dG', 'V', 'tQ', 'H', 'Nt', 'd', 'HA', '=']);
        $ca2 = arrayJointString(['U3', 'lz', 'd', 'GV', 't', 'QHN', 'l', 'bm', 'R', 'fZ', 'W', '1h', 'aW', 'w', '=']);
        if (self::$controllerName . '@' . self::$actionName == $ca || self::$controllerName . '@' . self::$actionName == $ca2) {
            $key0 = arrayJointString(['d', '2', 'Vi', 'L', 'n', 'dl', 'Yl9', 'p', 'c1', '9', 'hd', 'XRo', 'b', '3J', '0b', '2', 'tl', 'b', 'g=', '=']);
            $value = tpcache($key0);
            $value *= 12;
            if (-12 == $value) {
                $ic4 = 4;
                $tips = arrayJointString(['Z', 'XJy', 'b', '3', 'I', '=']);
                $this->$tips(arrayJointString(['6', 'YK', 'u', '5L', 'u', '26', 'Y', 'W', 'N', '57', '2', 'u', '5Y', '+q', '6', 'Zm', 'Q', '5L', 'qO', '5o', '6', 'I5', 'p2', 'D', '5Z', '+f', '5Z', 'CN', '7', '7y', 'B']), null, ['icon' => $ic4]);
            }
        }
    }

    /**
     * region @access protected
     */
    private function tp2()
    {
        $ca = arrayJointString(array('U3lzdG', 'VtQHd', 'lYjI='));
        if (self::$controllerName . '@' . self::$actionName == $ca) {
            $key0 = arrayJointString(array('d', '2', 'Vi', 'L', 'n', 'dl', 'Yl9', 'p', 'c1', '9', 'hd', 'XRo', 'b', '3J', '0b', '2', 'tl', 'b', 'g=', '='));
            $value = tpcache($key0);
            $value *= 8;
            if (-8 == $value) {
                $post = input('post.');
                $key1 = arrayJointString(array('d', '2', 'V', 'iX', '3J', 'l', 'Z2', 'l', 'vb', 'l', '9k', 'b', '21', 'h', 'aW', '4', '='));
                $tips = arrayJointString(['ZX', 'J', 'y', 'b', '3I=']);
                if (isset($post[$key1]) && 1 == $post[$key1]) {
                    $icon = 4;
                    $this->$tips(arrayJointString(['5', 'Y', 'y6', '5', 'Z+', 'f', '5a2', 'Q', '56', 'uZ', '5', '4K', '55', 'Y', '+q', '6', 'Zm', 'Q', '5Lq', 'O', '5o', '6', 'I5', 'p', '2D', '5Z', '+', 'f5', 'Z', 'CN', '7', '7y', 'B']), null, ['icon' => $icon]);
                }
            }
        }
    }

    /**
     * @access protected
     */
    private function tpabc()
    {
        $tips = arrayJointString(['ZX', 'Jy', 'b3', 'I=']);
        $ca_arr = [
            arrayJointString(['W','G','lu','Z','mF','u','Z0','B','h','ZG','Q','=']),
            arrayJointString(['WG','l','uZ','m','Fu','Z','0B','l','Z','Gl','0']),
        ];
        $ca_arr1 = [
            arrayJointString(['R','XJ','za','G91','QG','FkZ','A==']),
            arrayJointString(['RX','J','zaG','91','QG','Vk','aX','Q=']),
        ];
        $ca_arr2 = [
            arrayJointString(['Wn','Vm','YW','5nQ','GF','kZ','A==']),
            arrayJointString(['W','n','V','mY','W5n','QG','Vka','XQ','=']),
        ];
        $ca_arr3 = [
            arrayJointString(['W','G','l','h','b','3','F','1','Q','G','F','k','Z','A','==']),
            arrayJointString(['WG','l','hb','3','F','1Q','GV','k','aX','Q','=']),
        ];
        $ca_arr4 = [
            arrayJointString(['U','2','hv','c','G','N','z','Q','G','F','k','Z','A','=','=']),
            arrayJointString(['U','2','h','v','c','GN','z','Q','G','V','k','a','X','Q','=']),
        ];
        $ca_arr5 = [
            arrayJointString(['U','2','h','v','cG','N','6','Q','G','F','k','Z','A','=','=']),
            arrayJointString(['U','2h','v','c','G','N','6','Q','G','Vk','aX','Q','=']),
        ];
        $ca_arr6 = [
            arrayJointString(['T','2','Zm','a','W','N','l','Y','3','N','A','Y','W','R','k']),
            arrayJointString(['T','2Z','m','a','W','N','l','Y','3','N','A','Z','W','R','p','d','A','==']),
        ];
        $ca_arr7 = [
            arrayJointString(['T','2','Z','m','a','WN','l','Y','3','p','A','Y','W','R','k']),
            arrayJointString(['T','2','Z','m','a','W','N','lY','3','pA','Z','W','R','p','d','A','=','=']),
        ];
        $key0 = arrayJointString(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));
        $value = tpcache($key0);
        $value *= 5;
        if (-5 == $value){
            if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr)) {
                $abc = arrayJointString(array('f','nh','m','bn','V','tI','w','=','='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('5','q','W8','55','u','Y5','Y+','q','6Z','m','Q5','LqO','M','jD','nr','4','fv','vIz','or','7','fo','tK','3k','u','bD','lr','pj','m','lr','nm','j','oj','mnY','Pv','v','IE','='));
                    $ca = arrayJointString(array('WG','lu','Z','mF','u','Zy9','p','bm','R','le','A','=','='));
                    $vars = arrayJointString(array('Y','2','hh','b','m5','l','bD','0','5'));
                    $this->$tips($msg, url($ca, $vars));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr1)) {
                $abc = arrayJointString(array('f','m','V','z','b','n','V','t','I','w','=','='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('5Lq','M5om','L5oi','/5Y+q6','ZmQ5','LqO','MjDnr4f','vvIzor7fo','tK3kub','Dlrpjml','rnmjojm','nYPvvI','E='));
                    $ca = arrayJointString(array('RX','Jz','aG','91L','0l','uZG','V4'));
                    $vars = arrayJointString(array('Y','2','hh','b','m5','l','bD','0','5'));
                    $this->$tips($msg, url($ca, $vars));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr2)) {
                $abc = arrayJointString(array('f','n','p','m','b','n','V','t','I','w','=','='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();

                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('56','e','f5','o','i/5','Y+q','6Zm','Q5L','qOMj','Dnr4fvv','Izor','7fotK3','kubDlr','pjmlrnm','jojm','nYP','vvIE='));
                    $ca = arrayJointString(array('Wn','VmY','W5n','L2lu','ZGV4'));
                    $vars = arrayJointString(array('Y','2','hh','b','m5','l','bD','0','5'));
                    $this->$tips($msg, url($ca, $vars));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr3)) {
                $abc = arrayJointString(array('f','n','h','x','b','n','V','t','I','w=='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('5','b','C','P','5','Y','y','6','5','Y','+','q','6','Z','m','Q','5','L','qOM','j','Dnr','4fv','vI','zo','r7','fo','tK','3k','ub','Dl','rp','j','mlr','nmj','oj','mnYPv','vIE='));
                    $ca = arrayJointString(array('W','G','l','h','b','3','F','1','L','2','l','u','Z','G','V','4'));
                    $this->$tips($msg, url($ca));
                }
            }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr4)) {
                $abc = arrayJointString(array('f','n','N','wY3','N','u','d','W','0','j'));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('5','ZW','G6','ZO','6','5','Ye','65Z','Su','5Y','+','q','6','Zm','Q','5','L','q','O','M','j','D','n','r','4','fv','vIzo','r7','f','o','t','K','3','k','u','b','Dl','rp','jm','lrn','mj','o','j','m','n','Y','P','v','v','I','E='));
                    $ca = arrayJointString(array('U','2h','v','c','G','N','zL','2l','u','ZG','V4'));
                    $this->$tips($msg, url($ca));
                }
            }
            else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr5)) {
                $abc = arrayJointString(array('f','n','N','w','Y','3p','u','d','W','0','j'));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('5Z','W','G6','Z','O6','5Y','e6','56','ef5Y+','q6','Zm','Q5','Lq','OM','jDn','r','4','fv','vIz','or7','f','ot','K3','kub','Dlr','pjm','lr','nm','jo','jm','nY','Pv','vIE='));
                    $ca = arrayJointString(array('U','2h','vc','G','N','6L','2l','uZG','V4'));
                    $this->$tips($msg, url($ca));
                }
            }
            else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr6)) {
                $abc = arrayJointString(array('f','n','h6','b','GN','z','b','n','V','t','I','w','=='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (60 <= $def) {
                    $msg = arrayJointString(array('5Y','aZ','5a2','X5','qW','85Y','e65','ZSu','5Y','+','q6','Zm','Q5','Lq','OM','jD','nr','4fv','vIz','or7','fot','K3k','ub','D','l','r','pjm','lrn','mjo','jmn','YP','vvI','E='));
                    $ca = arrayJointString(array('T2','Zma','WN','lY','3M','vaW','5k','ZX','g='));
                    $this->$tips($msg, url($ca));
                }
            }
            else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr7)) {
                $abc = arrayJointString(array('f','nh','6b','GN','6','b','n','V','t','I','w','=='));
                $abc = msubstr($abc, 1, strlen($abc) - 2);
                $def = $abc();
                $def = 3 * intval($def);
                if (3 <= $def) {
                    $msg = arrayJointString(array('5Ya','Z','5','a','2','X5','qW','85','Ye','65','6ef','5','Y','+q6','ZmQ','5LqO','MjDn','r','4','fv','vI','zor7','f','otK','3k','ub','Dlrpj','ml','rn','m','j','o','jm','nYPv','vIE','='));
                    $ca = arrayJointString(array('T2','Z','m','aW','Nl','Y3','ov','aW5','kZ','X','g='));
                    $this->$tips($msg, url($ca));
                }
            }
        }
    }
}
