<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/23
 * Time: 10:48
 */

namespace app\common\model;

use think\Model;

class FormAttr extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 获取单条数据
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($id, $field = '*')
    {
        $result = db('form_attr')->field($field)->find($id);

        return $result;
    }
}