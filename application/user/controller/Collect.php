<?php
/**
 * User: xyz
 * Date: 2020/3/26
 * Time: 18:17
 */

namespace app\user\controller;

use think\Page;
use think\Db;

class Collect  extends Base
{
    public $archives_db;
    public function _initialize() {
        parent::_initialize();
        $this->archives_db = Db::name('archives');
    }
    public function index(){
        $param = input('param.');

        $condition['a.is_del'] = array('eq',0);
        $condition['b.users_id'] = array('eq',$this->users_id);

        $count = $this->archives_db->alias('a')->join("users_collect b","a.aid = b.aid","LEFT")
            ->where($condition)->count('a.aid');// 查询满足要求的总记录数
        $Page = new Page($count,config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数  config('paginate.list_rows')
        $list = $this->archives_db
            ->field("a.aid")
            ->alias('a')
            ->join("users_collect b","a.aid = b.aid","LEFT")
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        if ($list) {
            $aids = array_keys($list);
            $fields = "b.*,b.add_time as collect_time, a.*, a.aid as aid";
            $row = $this->archives_db
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            $region_list = get_region_list();
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['province_name'] = !empty($region_list[$row[$val['aid']]['province_id']]['name']) ? $region_list[$row[$val['aid']]['province_id']]['name'] : '';
                $row[$val['aid']]['city_name'] = !empty($region_list[$row[$val['aid']]['city_id']]['name']) ? $region_list[$row[$val['aid']]['city_id']]['name'] : '';
                $row[$val['aid']]['area_name'] = !empty($region_list[$row[$val['aid']]['area_id']]['name']) ? $region_list[$row[$val['aid']]['area_id']]['name'] : '';

                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象
        $this->assign($assign_data);

        return $this->fetch('users/collect_index');
    }

}