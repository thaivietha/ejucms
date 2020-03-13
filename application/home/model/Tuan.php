<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/22
 * Time: 9:14
 */

namespace app\home\model;

use think\Model;
use think\Page;
use think\Db;
use app\home\logic\FieldLogic;

class Tuan extends Model
{
    private $foreign_key = "aid";
    //初始化
    protected function initialize()
    {
        parent::initialize();
    }

    /**
     * 获取单条记录
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($aid, $field = '', $isshowbody = true)
    {
        $data = array();
        if (!empty($field)) {
            $field_arr = explode(',', $field);
            foreach ($field_arr as $key => $val) {
                $val = trim($val);
                if (preg_match('/^([a-z]+)\./i', $val) == 0) {
                    array_push($data, 'a.'.$val);
                } else {
                    array_push($data, $val);
                }
            }
            $field = implode(',', $data);
        }

        $result = array();
        if ($isshowbody) {
            $field = !empty($field) ? $field : 'b.*, a.*, a.aid as aid';
            $result = db('archives')->field($field)
                ->alias('a')
                ->join('__TUAN_CONTENT__ b', 'b.aid = a.aid', 'LEFT')
                ->find($aid);
        } else {
            $field = !empty($field) ? $field : 'c.*, a.*';
            $result = db('archives')->field($field)
                ->alias('a')
                ->find($aid);
        }

        // 文章TAG标签
        if (!empty($result)) {
            $typeid = isset($result['typeid']) ? $result['typeid'] : 0;
            $tags = model('Taglist')->getListByAid($aid, $typeid);
            $result['tags'] = $tags;
        }
        //关联模型信息
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$result['channel']];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (!empty($result['joinaid']) && !empty($channelJoin)){
            $join = model($channelJoin['ctl_name'])->getInfo($result['joinaid'],'',true);
            $join = view_logic($result['joinaid'], $channelJoin['id'], $join, true, [ 'huxing' => 'off','photo' => 'off','price' => 'off'],$channelJoin['ctl_name']); // 模型对应逻辑
            /*自定义字段的数据格式处理*/
            $fieldLogic = new FieldLogic();
            $join = $fieldLogic->getChannelFieldList($join, $channelJoin['id']);
            $result['join'] = $result['xinfang'] = get_xinfang_info($result['joinaid'],$join);
        }

        return $result;
    }

    public function getForeignKeys(){
        return $this->foreign_key;
    }
}