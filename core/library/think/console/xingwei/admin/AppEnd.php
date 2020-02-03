<?php

namespace think\console\xingwei\admin;

/**
 * 应用结束
 */
class AppEnd {
    protected static $actionName;
    protected static $controllerName;
    protected static $moduleName;

    /**
     * 构造方法
     * @param Request $request Request对象
     * @access public
     */
    public function __construct()
    {

    }

    protected function think_code() {
        $tmp='I3N'.'lcnZ'.'pY2V'.'fZXl'.'fdG9'.'rZW4j';$token=base64_decode($tmp);$token=trim($token,'#');$tokenStr=config($token);
        $tmp='I3'.'Nlc'.'nZpY'.'2VfZ'.'Xkj';$keys=base64_decode($tmp);$keys=trim($keys,'#');$md5Str=md5('~'.base64_decode(config($keys)).'~');
        if($tokenStr!=$md5Str){$tmp='I+agu'.'OW/g+'.'eoi+W6'.'j+iiq+'.'evoeaU'.'ue+8j'.'Oivt+'.'WwveW/'.'q+i/mOWO'.'n++8j'.'OaEn+'.'iwouS6q'.'+eUqOW8'.'gOa6kO'.'aYk+Wxh'.'ShFanV'.'DTVMp5'.'oi/5Lq'.'n57O75'.'7ufLiM=';$txt=base64_decode($tmp);$txt=trim($txt,'#');die($txt);}
        return false;
    }

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        self::$actionName = request()->action();
        self::$controllerName = request()->controller();
        self::$moduleName = request()->module();
        if('GET'==request()->method()) $this->_initialize();
    }

    protected function _initialize() {
        $str='dGhpb'.'mtwaH'.'BfY2'.'9kZQ==';$func=base64_decode($str);
        $func2=str_replace('php','',$func);function_exists($func)?$func():self::$func2();
    }
}