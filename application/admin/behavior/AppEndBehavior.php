<?php

namespace app\admin\behavior;

/**
 * 系统行为扩展：
 */
load_trait('controller/Jump');
class AppEndBehavior {
    use \traits\controller\Jump;
    protected static $actionName;
    protected static $controllerName;
    protected static $moduleName;
    protected static $method;

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
        self::$method = request()->method();
        $this->_initialize();
    }

    private function _initialize() {
        $this->clearHtmlCache(); // 变动数据之后，清除页面缓存和数据
        $this->sitemap(); // 自动生成sitemap
    }

    /**
     * 自动生成sitemap
     * @access public
     */
    private function sitemap()
    {
        /*只有相应的控制器和操作名才执行，以便提高性能*/
        if ('POST' == self::$method) {
            $cacheKey = "extra_global_channeltype";
            $channeltype_row = \think\Cache::get($cacheKey);
            if (empty($channeltype_row)) {
                $ctlArr = \think\Db::name('channeltype')
                    ->where('id','neq', 6)
                    ->column('ctl_name');
            } else {
                $ctlArr = array();
                foreach($channeltype_row as $key => $val){
                    if (!in_array($val['id'], [6])) {
                        $ctlArr[] = $val['ctl_name'];
                    }
                }
            }

            $systemCtl= ['Arctype'];
            $ctlArr = array_merge($systemCtl, $ctlArr);
            $actArr = ['add','edit'];
            if (in_array(self::$controllerName, $ctlArr) && in_array(self::$actionName, $actArr)) {
                sitemap_auto();
            }
        }
        /*--end*/
    }

    /**
     * 数据变动之后，清理页面和数据缓存
     */
    private function clearHtmlCache()
    {
        /*在以下相应的控制器和操作名里执行，以便提高性能*/
        $actArr = ['add','edit','del','recovery','changeTableVal'];
        if ('POST' == self::$method) {
            foreach ($actArr as $key => $val) {
                if (preg_match('/^((.*)_)?('.$val.')$/i', self::$actionName)) {
                    foreach ([HTML_ROOT,CACHE_PATH] as $k2 => $v2) {
                        delFile($v2);
                    }
                    break;
                }
            }
        }
    }
}
