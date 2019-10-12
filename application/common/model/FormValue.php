<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/23
 * Time: 16:37
 */

namespace app\common\model;

use think\Model;

class FormValue extends Model
{
//初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 获取单条数据
     */
    public function getInfo($id, $field = '*')
    {
        $result = db('form_value')->field($field)->find($id);

        return $result;
    }

}