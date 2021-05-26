<?php
/**
 * User: xyz
 * Date: 2019/10/14
 * Time: 15:18
 */

namespace app\common\model;

use think\Model;

class Xiaoqu extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }
    /*
 * 获取单条新房基本信息
 */
    public function getOne($condition,$fields = "d.*,c.*,b.*, a.*, a.aid as aid"){
        $row = db('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join('xiaoqu_content c','a.aid = c.aid')
            ->join('xiaoqu_system d','a.aid = d.aid')
            ->where($condition)
            ->find();

        return $row;
    }
}