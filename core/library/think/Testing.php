<?php

namespace think;

use think\model\driver\Driver;

class Testing
{
    /**
     * 构造方法
     * @access public
     */
    public function __construct()
    {
        // 初始化
        $this->_initialize();
    }

    /**
     * 初始化操作
     * @access protected
     */
    protected function _initialize()
    {

    }

    static public function checksud()
    {
        $object = new Driver();
        $object::service_upgrade_domain();
    }

    static public function setcprh($name, $globalTpCache = [])
    {
        $object = new Driver();
        return $object::setcprh($name, $globalTpCache);
    }
}
