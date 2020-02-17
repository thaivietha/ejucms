<?php
namespace think\console\output\kernel;

/**
 * 模块初始化
 * 加密方式：by 小虎哥 <1105415366@qq.com>
 */
class ThinkamMi {
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
        $this->_initialize();
    }

    protected function _initialize() {
        $testingObj = new \think\model\driver\Driver();
        $testingObj::testing_ization();
    }
}
?>