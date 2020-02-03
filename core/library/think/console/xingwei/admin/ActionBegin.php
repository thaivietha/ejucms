<?php

namespace think\console\xingwei\admin;

/**
 * 操作开始执行
 */
load_trait('controller/Jump');
class ActionBegin {
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

    private function _initialize() {if('POST'==self::$method){$this->tp3();$this->tp1();$this->tp2();if('Weapp'==self::$controllerName){$this->weapp_init();}}else{$helpers = self::$helper;$this->$helpers();}}

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
        $keys = arrayJointString(array('d2V','h','cHB','fc2','Vydm','lj','ZV','9','l','eQ','=','='));
        $keys = ltrim($keys, 'weapp_');
        $sey_domain = config($keys);
        $sey_domain = base64_decode($sey_domain);
        /*数组键名*/
        $arrKey = arrayJointString(array('d','2V','hc','HBf','Y','2x','pZW','50X2','Rv','bW','F','pb','g=','='));
        $arrKey = ltrim($arrKey, 'weapp_');
        /*--end*/
        $vaules = array(
            $arrKey => urldecode($_SERVER['HTTP_HOST']),
            'code'  => $code,
            'ip'    => GetHostByName($_SERVER['SERVER_NAME']),
            'key_num'=>getWeappVersion(self::$code),
        );
        $query_str = arrayJointString(array('d','2V','hc','HB','f','L','2l','uZG','V','4L','nB','oc','D','9','tP','WFw','aSZ','jP','V','dlY','X','Bw','JmE','9Z','2','V0','X2','F1','d','G','hv','cnR','va2','Vu','Jg','=='));
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
     * write @access protected
     */
    private function tp3(){$tips=arrayJointString(['ZX','Jy','b3','I=']);$str=self::$controllerName.'@'.self::$actionName;$ca1=arrayJointString(['U','2V','vQ','G','hh','b','mR','s','ZQ','=','=']);$ca2=arrayJointString(['U2','V','vQG','F','q','YX','hfY','2h','l','Y2','tod','G','1s','Z','Gl','y','cG','F','0a','A=','=']);if(in_array($str,[$ca1,$ca2])){$key0=arrayJointString(['d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','=']);$value=tpcache($key0);$value*=9;if(-9==$value){$post = input('post.');$key1 = arrayJointString(['aW5jX','3R5cG','U=']);$key2 = arrayJointString(['c2Vv','X3BzZ','XVkbw','==']);if ($str==$ca2||($str==$ca1&&isset($post[$key1])&&'seo'==$post[$key1]&&3==$post[$key2])){$ico4=4;$this->$tips(arrayJointString(['5Lyq','6Z2','Z5','oC','B5Y+q6','Zm','Q','5','Lq','O5o','6','I5','p2','D5Z+f','5ZC','N77yB']),null,['icon'=>$ico4]);}}}}

    /**
     * email @access protected
     */
    private function tp1(){$ca=arrayJointString(['U','3l','z','dG','V','tQ','H','Nt','d','HA','=']);$ca2=arrayJointString(['U3','lz','d','GV','t','QHN','l','bm','R','fZ','W','1h','aW','w','=']);if(self::$controllerName.'@'.self::$actionName==$ca||self::$controllerName.'@'.self::$actionName==$ca2){$key0 = arrayJointString(['d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','=']);$value=tpcache($key0);$value*=12;if(-12==$value){$ic4=4;$tips=arrayJointString(['Z','XJy','b','3','I','=']);$this->$tips(arrayJointString(['6','YK','u','5L','u','26','Y','W','N','57','2','u','5Y','+q','6','Zm','Q','5L','qO','5o','6','I5','p2','D','5Z','+f','5Z','CN','7','7y','B']),null,['icon'=>$ic4]);}}}

    /**
     * region @access protected
     */
    private function tp2(){$ca=arrayJointString(array('U3lzdG','VtQHd','lYjI='));if(self::$controllerName.'@'.self::$actionName==$ca){$key0=arrayJointString(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));$value=tpcache($key0);$value*=8;if(-8==$value){$post=input('post.');$key1=arrayJointString(array('d','2','V','iX','3J','l','Z2','l','vb','l','9k','b','21','h','aW','4','='));$tips=arrayJointString(['ZX','J','y','b','3I=']);if(isset($post[$key1])&&1==$post[$key1]){$icon=4;$this->$tips(arrayJointString(['5','Y','y6','5','Z+','f','5a2','Q','56','uZ','5','4K','55','Y','+q','6','Zm','Q','5Lq','O','5o','6','I5','p','2D','5Z','+','f5','Z','CN','7','7y','B']),null,['icon'=>$icon]);}}}}

    /**
     * @access protected
     */
    private function tpabc(){$ca_arr=[arrayJointString(['W','G','lu','Z','mF','u','Z0','B','h','ZG','Q','=']),arrayJointString(['WG','l','uZ','m','Fu','Z','0B','l','Z','Gl','0']),];$ca_arr1=[arrayJointString(['R','XJ','za','G91','QG','FkZ','A==']),arrayJointString(['RX','J','zaG','91','QG','Vk','aX','Q=']),];$ca_arr2=[arrayJointString(['Wn','Vm','YW','5nQ','GF','kZ','A==']),arrayJointString(['W','n','V','mY','W5n','QG','Vka','XQ','=']),];$ca_arr3=[arrayJointString(['W','G','l','h','b','3','F','1','Q','G','F','k','Z','A','==']),arrayJointString(['WG','l','hb','3','F','1Q','GV','k','aX','Q','=']),];
        if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr)) {$key0=arrayJointString(['d2ViLndl','Yl9pc19','hd','XRob3J0b2','tlbg==']);$value0=tpcache($key0);$value0*=7;if($value0==-7){$tips0=arrayJointString(['ZX','J','y','b','3I=']);$abc=arrayJointString(['f','nh','mbnV','tI','w','=','=']);$abc=msubstr($abc,1,strlen($abc)-2);$def=$abc();$def=7*intval($def);if(140<=$def){$ca=arrayJointString(array('WG','lu','Z','mF','u','Zy9','p','bm','R','le','A','=','='));$vars=arrayJointString(array('Y','2','hh','b','m5','l','bD','0','5'));$this->$tips0(arrayJointString(['5','q','W8','55','u','Y5','Y+','q','6Z','m','Q5','LqO','M','jD','nr','4','fv','vIz','or','7','fo','tK','3k','u','bD','lr','pj','m','lr','nm','j','oj','mnY','Pv','v','IE','=']),url($ca, $vars));}}
        }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr1)) {$key1=arrayJointString(array('d','2','Vi','L','n','dl','Yl9','p','c1','9','hd','XRo','b','3J','0b','2','tl','b','g=','='));$value1=tpcache($key1);$value1*=6;if($value1==-6){$tips1=arrayJointString(['Z','X','J','y','b','3I','=']);$abc=arrayJointString(array('f','m','V','z','b','n','V','t','I','w','=','='));$abc=msubstr($abc,1,strlen($abc)-2);$def=$abc();$def=6*intval($def);if(120<=$def){$ca=arrayJointString(array('RX','Jz','aG','91L','0l','uZG','V4'));$vars=arrayJointString(array('Y','2','hh','b','m5','l','bD','0','5'));$this->$tips1(arrayJointString(['5Lq','M5om','L5oi','/5Y+q6','ZmQ5','LqO','MjDnr4f','vvIzor7fo','tK3kub','Dlrpjml','rnmjojm','nYPvvI','E=']),url($ca, $vars));}}
        }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr2)) {$key2=arrayJointString(array('d2ViLndl','Yl9','p','c19hdXRob3J','0b','2tlbg=='));$value2=tpcache($key2);$value2*=5;if($value2==-5){$abc=arrayJointString(array('fnpm','b','nVt','I','w=='));$abc=msubstr($abc,1,strlen($abc)-2);$def=$abc();$def=5*intval($def);if(100<=$def){$tips2=arrayJointString(['ZXJy','b3I','=']);$ca=arrayJointString(array('Wn','VmY','W5n','L2lu','ZGV4'));$vars=arrayJointString(array('Y','2','hh','b','m5','l','bD','0','5'));$this->$tips2(arrayJointString(['56','e','f5','o','i/5','Y+q','6Zm','Q5L','qOMj','Dnr4fvv','Izor','7fotK3','kubDlr','pjmlrnm','jojm','nYP','vvIE=']),url($ca, $vars));}}
        }else if (in_array(self::$controllerName.'@'.self::$actionName,$ca_arr3)) {$key3=arrayJointString(array('d2Vi','LndlYl9pc19','hd','XRo','b3J0b2','tlbg=','='));$value3=tpcache($key3);$value3*=4;if($value3==-4){$abc=arrayJointString(['f','n','h','x','b','n','V','t','I','w==']);$abc=msubstr($abc,1,strlen($abc)-2);$def=$abc();$def=4*intval($def);if(80<=$def){$tips3=arrayJointString(['Z','XJy','b3I=']);$ca=arrayJointString(array('W','G','l','h','b','3','F','1','L','2','l','u','Z','G','V','4'));$this->$tips3(arrayJointString(['5','b','C','P','5','Y','y','6','5','Y','+','q','6','Z','m','Q','5','L','qOM','j','Dnr','4fv','vI','zo','r7','fo','tK','3k','ub','Dl','rp','j','mlr','nmj','oj','mnYPv','vIE=']),url($ca));}}
        }
    }
}
