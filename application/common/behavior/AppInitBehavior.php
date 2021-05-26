<?php

namespace app\common\behavior;

/**
 * 系统行为扩展：
 */
class AppInitBehavior {
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
        self::$method = request()->method();
        $this->_initialize();
    }

    private function _initialize() {
        $this->saveSqlmode(); // 保存mysql的sql-mode模式参数
    }

    /**
     * 保存mysql的sql-mode模式参数
     */
    private function saveSqlmode(){
        /*在后台模块才执行，以便提高性能*/
        if (!stristr(request()->baseFile(), 'index.php')) {
            if ('GET' == self::$method) {
                $key = 'isset_saveSqlmode';
                $sessvalue = session($key);
                if(!empty($sessvalue))
                    return true;
                session($key, 1);

                $sql_mode = db()->query("SELECT @@global.sql_mode AS sql_mode");
                $system_sql_mode = isset($sql_mode[0]['sql_mode']) ? $sql_mode[0]['sql_mode'] : '';
                tpCache('system', ['system_sql_mode'=>$system_sql_mode]);
            }
        }
        /*--end*/
    }
}
