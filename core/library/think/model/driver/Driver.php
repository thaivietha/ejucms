<?php

namespace think\model\driver;

class Driver
{
    /**
     * @access public
     */
    static public function service_upgrade_domain() {$keys_token=arrayJointString(['fn','NlcnZ','pY2VfZ','X','lfdG9r','ZW5+']);$keys_token=msubstr($keys_token,1,strlen($keys_token)-2);$token=config($keys_token);$keys=arrayJointString(['fnNl','cnZpY2','VfZX','l+']);$keys=msubstr($keys,1,strlen($keys)-2);$domain=config($keys);$domainMd5=md5('~'.base64_decode($domain).'~');if($token!=$domainMd5){$msg=arrayJointString(['5qC45b+','D56','iL5bqP6KK','r5','6+h5pS5','77yM6','K+','35bC95b+r6L+Y5Y6','f','77','yM5oSf6LCi5Lqr','5','5','S','o5byA5rqQ','5Y','W','N6','LS','5RWp1','Q21z5oi','/','5L','q','n572R56uZ5bu','66K6+57O7','57ufLg==']);$msg=msubstr($msg,1,-1);die($msg);}return false;}

    /**
     * @access public
     */
    static public function testing_ization()
    {
        $tmp64='aXN'.'zZX'.'Rf'.'YXV0'.'aG9y';
        $session_key=base64_decode($tmp64);
        $isset_1_session=session($session_key);
        if(!empty($isset_1_session) && !isset($_GET['cl'.'o'.'se'.'_w'.'e'.'b'])) return false;
        session($session_key, 1);

        static $request=null;
        null == $request && $request=\think\Request::instance();

        $basehost=$request->host(true);
        if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $basehost)) return false;

        $keys=arrayJointString(['fnNlcn','ZpY2Vf','ZXl+']);$keys=msubstr($keys,1,strlen($keys)-2);$domain=base64_decode(config($keys));

        $arrKey=arrayJointString(['fmN','saWV','udF9k','b21haW','5+']);$arrKey=msubstr($arrKey,1,strlen($arrKey)-2);
        $vaules=[$arrKey => urldecode($basehost)];
        $query_str=arrayJointString(['fi','9p','bmRleC5waHA','/b','T1','hcGkmYz1DbX','N','TZ','XJ2aWNlJmE','9Z2V0X2F','1d','GhvcnRva2Vu','JmNtc190','eXBlPTE','m','fg=','=']);$query_str=msubstr($query_str,1,strlen($query_str)-2);
        $url=$domain.$query_str.http_build_query($vaules);$context=stream_context_set_default(['http'=>['timeout'=>2,'method'=>'GET']]);
        $response=@file_get_contents($url,false,$context);$params=json_decode($response,true);

        $is2eyKey=arrayJointString(['IXdl','Yl9pc','19hd','XRob3','J0b2t','lbn4=']);$is2eyKey=msubstr($is2eyKey,1,strlen($is2eyKey)-2);session($is2eyKey,0);
        $tmp2Black='cGhw'.'X2'.'V5b3'.'Vf'.'Ymxh'.'Y2ts'.'aXN'.'0';$tmp2Black=base64_decode($tmp2Black);tpCache('web',[$is2eyKey=>0]);tpCache('php',[$tmp2Black=>'']);
        if(is_array($params)&&$params['errcode']==0){if(empty($params['info']['code'])){tpCache('web',[$is2eyKey=>-1]);session($is2eyKey,-1);return true;}}
        if(is_array($params)&&$params['errcode']==10002){session($session_key,null);$tmpval='EL+#$JK'.base64_encode($params['errmsg']).'WENXHSK#0m3s';tpCache('php',[$tmp2Black=>$tmpval]);die($params['errmsg']);}

        return true;
    }
}
