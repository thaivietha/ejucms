<?php
/**
 * User: xyz
 * Date: 2020/3/12
 * Time: 16:31
 */

namespace app\user\controller;

use think\Page;
use think\Db;

class Xinfang  extends Base
{
// 模型标识
    public $nid = 'xinfang';
    // 模型ID
    public $channeltype;
    // 模型附加表
    public $table = 'Xinfang';
    public $type_info;
    public $archives_db;
    public function _initialize() {
        parent::_initialize();
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
        $this->type_info = Db::name("arctype")->where("current_channel={$this->channeltype} and is_del=0 and status=1")->order("id")->find();
        $this->archives_db = Db::name('archives');
    }
    /*
     * 检查关联数据是否存在
     */
    public function ajaxCheck(){
        $aid = input('aid/d',0);
        $title = input('title/s','');
        $condition['channel'] = $this->channeltype;
        $condition['aid'] = $aid;
        $condition['title'] = $title;
        $condition['is_del'] = 0;
        $data = DB::name('archives')->where($condition)->find();
        if ($data){
            $this->success("存在",'',$data);
        }else{
            $this->error("不存在");
        }
    }
    /*
     * js获取小区数据列表
     */
    public function ajaxList(){
        $channel= input('channel/d');
        $typeid = input('typeid/d');
        $keywords = input('keywords/s');
        $province = input('province/d');
        $city = input('city/d');
        $area = input('area/d');
        $condition['a.channel'] = $channel ? $channel : $this->channeltype;

        if ($typeid){
            $condition['a.typeid'] = $typeid;
        }
        if ($province){
            $condition['a.province_id'] = $province;
        }
        if ($city){
            $condition['a.city_id'] = $city;
        }
        if ($area){
            $condition['a.area_id'] = $area;
        }
        if ($keywords){
            $condition['a.title'] =  array('LIKE', "%{$keywords}%");;
        }
        $result = $this->getLists($condition);

        return json($result['list']);
    }
    /**
     * 获取列表数据
     */
    private function getLists($condition,$fields = ""){
        /*
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数

        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = DB::name('archives')
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        /*
         * 完善数据集信息
         * 在数据量大的情况下，经过优化的搜索逻辑，先搜索出主键ID，再通过ID将其他信息补充完整；
         */
        if ($list) {
            $aids = array_keys($list);
            empty($fields) && $fields = "d.*,c.*,b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join('xinfang_content c','a.aid = c.aid')
                ->join('xinfang_system d','a.aid = d.aid')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            $region = get_region_list();
            $price_units = Db::name("channelfield")->where(['name'=>'average_price','channel_id'=>$this->channeltype])->getField("dfvalue_unit");
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['city'] = !empty($region[$row[$val['aid']]['city_id']])?$region[$row[$val['aid']]['city_id']]:'';
                $row[$val['aid']]['area'] = !empty($region[$row[$val['aid']]['area_id']])?$region[$row[$val['aid']]['area_id']]:'';
                $row[$val['aid']]['province'] =  !empty($region[$row[$val['aid']]['province_id']])?$region[$row[$val['aid']]['province_id']]:'';
                empty($row[$val['aid']]['price_units']) && $row[$val['aid']]['price_units'] = $price_units;
                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        return $assign_data;
    }
}