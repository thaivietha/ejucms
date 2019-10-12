<?php
/**
 * User: xyz
 * Date: 2019/10/8
 * Time: 17:15
 */

namespace think\template\taglib\eju;


class TagMinmax extends Base
{
    public $aid = '';
    public $tid = '';
    public $fieldLogic;

    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = I('param.aid/d', 0);
        $this->tid = I('param.tid/d', 0);
    }

    public function getMinmax($aid = 0 ,$type){
        $aid = !empty($aid) ? $aid : $this->aid;
        $where = [];
        if (!empty($aid)){
            $where['aid'] = $aid;
        }
        switch ($type){
            case "huxing":
                $table = 'xinfang_huxing';
                $fields = "min(huxing_area) as min_area,min(huxing_room) as min_room,min(huxing_average_price) as min_average_price,min(huxing_price) as min_price,
                max(huxing_area) as max_area,max(huxing_room) as max_room,max(huxing_average_price) as max_average_price,max(huxing_price) as max_price";
                break;
            defualt:
                $table = 'xinfang_huxing';
                $fields = "min(huxing_area) as min_area,min(huxing_room) as min_room,min(huxing_average_price) as min_average_price,min(huxing_price) as min_price,
                max(huxing_area) as max_area,max(huxing_room) as max_room,max(huxing_average_price) as max_average_price,max(huxing_price) as max_price";
        }
        $result = db($table)->alias("a")->field($fields)->where($where)->select();

        return $result;
    }
}