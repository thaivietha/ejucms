<?php
/**
 * User: xyz
 * Date: 2020/2/7
 * Time: 8:59
 */

namespace app\home\controller;


class Tool extends Base
{
    public function _initialize() {
        parent::_initialize();
    }
    //房贷计算器
    public function jisuanqi(){
        return $this->fetch();
    }
}