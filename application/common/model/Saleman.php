<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/12
 * Time: 9:55
 */

namespace app\common\model;

use think\Model;

class Saleman extends Model
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
        $result = db('saleman')->field($field)->find($id);

        return $result;
    }


}