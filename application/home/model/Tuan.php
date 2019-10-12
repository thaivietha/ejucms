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
        if (!empty($result['joinaid'])){
            $xinfang = model('Xinfang')->getInfo($result['joinaid'],'',true);
            $result['xinfang'] = get_xinfang_info($result['joinaid'],$xinfang);
        }
        return $result;
    }

    public function getForeignKeys(){
        return $this->foreign_key;
    }
}