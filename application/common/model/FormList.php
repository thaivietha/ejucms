<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/23
 * Time: 11:41
 */

namespace app\common\model;

use think\Model;

class FormList extends Model
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
        $result = db('form_list')->field($field)->find($id);

        return $result;
    }
}