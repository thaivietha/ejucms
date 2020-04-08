<?php
/**
 * User: xyz
 * Date: 2020/3/31
 * Time: 8:59
 */

namespace think\template\taglib\eju;

use think\Db;

class TagRemarkList extends Base
{

    public $aid = '';
    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = I('param.aid/d', 0);
    }

    public function getRemarklist($param = array(),$aid, $pagesize = 10, $orderby = '', $orderway = ''){
        $param = array_merge(input('param.'), $param);
        $aid = !empty($aid) ? $aid : $this->aid;
        $result = false;
        empty($orderway) && $orderway = 'desc';
        $orderby = getOrderBy($orderby,$orderway);
        $condition_str = "a.is_del=0 and a.status=1";
        foreach ($param as $key=>$val){
            if ($key == 'users_id' && !empty($val)){     //经纪人
                $condition_str .= " and a.users_id = {$val}";
            }
        }
        if (!empty($aid)){
            $condition_str .= " and a.aid = {$aid}";
        }
        $list = array();
        $query_get = array();
        /*列表分页URL问号的查询部分*/
        $get_arr = input('get.');
        foreach ($get_arr as $key => $val) {
            if (empty($val) || stristr($key, '/')) {
                unset($get_arr[$key]);
            }
        }
        $param_arr = input('param.');
        foreach ($param_arr as $key => $val) {
            if (empty($val) || stristr($key, '/')) {
                unset($param_arr[$key]);
            }
        }
        $seo_pseudo = config('ey_config.seo_pseudo');
        if ($seo_pseudo == 1) { // 动态URL模式
            $query_get = $get_arr;
        } elseif ($seo_pseudo == 3) { // 伪静态URL模式
            $query_get = array();
        } elseif ($seo_pseudo == 2) { // 静态页面模式
            $query_get = $get_arr;
        }
        /*--end*/
        $paginate_type = config('paginate.type');
        if (isMobile()) {
            $paginate_type = 'mobile';
        }
        $paginate = array(
            'type'  => $paginate_type,
            'var_page' => config('paginate.var_page'),
            'query' => $query_get,
        );
        $pages = Db::name('remark')
            ->field("a.remark_id")
            ->alias('a')
            ->where($condition_str)
            ->order($orderby)
            ->paginate($pagesize, false, $paginate);

        //获取所有区域
        if ($pages->total() > 0) {
            $list = $pages->items();

            $aids = get_arr_column($list, 'remark_id');
            $fields = "b.*, a.*";
            $row = Db::name('remark')
                ->field($fields)
                ->alias('a')
                ->join('users b', 'a.users_id = b.id', 'LEFT')
                ->where('a.remark_id', 'in', $aids)
                ->getAllWithIndex('remark_id');
            foreach ($list as $key => $val) {
                $arcval = $row[$val['remark_id']];
                /*封面图*/
                empty($arcval['true_name']) && $arcval['true_name'] = "游客";
                empty($arcval['litpic']) && $arcval['litpic'] =  "/public/static/common/images/dfboy.png";//get_default_pic($arcval['litpic']); // 默认封面图
                /*--end*/
                $list[$key] = $arcval;
            }
            /*--end*/
        }

        $count_list = Db::name('remark')->field("AVG(price) as price,AVG(place) as place,AVG(mating) as mating,AVG(traffic) as traffic,AVG(science) as science,AVG(score) as score")->alias('a')->where($condition_str)->select();
        $result['count_list'] = !empty($count_list[0]) ? $count_list[0] : [];  //总评分
        foreach ($result['count_list'] as $key=>$val){
            $result['count_list'][$key] = round($val,2);
         }
        $result['pages'] = $pages; // 分页显示输出
        $result['list'] = $list; // 赋值数据集
        $result['count'] = $pages->total();  //数据总数

        return $result;



    }
}