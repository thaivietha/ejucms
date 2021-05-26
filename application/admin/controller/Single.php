<?php
/**
 * User: xyz
 * Date: 2020/3/9
 * Time: 17:24
 */

namespace app\admin\controller;


use think\Page;
use think\Db;


class Single  extends Base
{
    // 模型标识
    public $nid = 'single';
    // 模型ID
    public $channeltype;
    // 模型附加表
    public $table = 'Single';
    // 模型信息
    public $channeltype_info;

    /*
     * 初始化操作
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->archives_db = Db::name('archives');
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
        $this->assign('nid', $this->nid);
        $this->assign('channeltype', $this->channeltype);
        $this->channeltype_info = Db::name('channeltype')->field('id,ntitle')->find($this->channeltype);
        $this->assign('channeltype_info', $this->channeltype_info);
    }

    /*
     *  js打开获取楼盘列表
     */
    public function ajaxSelectHouse(){
        $channel= input('channel/d');
        $typeid = input('typeid/d');
        $keywords = input('keywords/s');
        $func = input('func/s');
        $condition = array();
        $condition['a.channel'] = $channel ? $channel : $this->channeltype;
        if ($typeid){
            $condition['a.typeid'] = $typeid;
        }
        if ($keywords){
            $condition['a.title'] =  array('LIKE', "%{$keywords}%");
        }
        $assign_data = $this->getLists($condition);
        $assign_data['func'] = $func;
        $this->assign($assign_data);

        return $this->fetch();
    }
    /**
     * 获取列表数据
     */
    private function getLists($condition){
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
            $fields = "c.*,b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join('single_content c','a.aid = c.aid')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            $region = get_region_list();
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['city'] = !empty($region[$row[$val['aid']]['city_id']]['name'])?$region[$row[$val['aid']]['city_id']]['name']:'';
                $row[$val['aid']]['area'] = !empty($region[$row[$val['aid']]['area_id']]['name'])?$region[$row[$val['aid']]['area_id']]['name']:'';
                $row[$val['aid']]['province'] =  !empty($region[$row[$val['aid']]['province_id']]['name'])?$region[$row[$val['aid']]['province_id']]['name']:'';
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