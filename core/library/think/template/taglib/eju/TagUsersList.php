<?php
/**
 * User: xyz
 * Date: 2020/1/17
 * Time: 11:12
 */

namespace think\template\taglib\eju;

use think\Page;
use think\Request;
use app\home\logic\FieldLogic;
use app\home\logic\UsersLoginc;
use think\Db;

class TagUsersList extends Base
{
    public $fieldLogic;
    public $url_screen_var;
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->fieldLogic = new FieldLogic();
        $this->UsersLoginc = new UsersLoginc();
        // 定义筛选标识
        $this->url_screen_var = config('global.url_screen_var');
    }
    /**
     * 获取分页列表
     * @author wengxianhu by 2018-4-20
     */
    public function getUserslist($param = array(), $pagesize = 10, $orderby = '', $orderway = '', $thumb = ''){
        $param = array_merge(input('param.'), $param);
        $is_count_arr = [];
        if (!empty($param['is_count'])){
            $is_count_arr = explode(',',$param['is_count']);
        }
        $result = false;
        empty($orderway) && $orderway = 'desc';
        // 给排序字段加上表别名
        $orderby = getOrderBy($orderby,$orderway);
        $condition_str = "a.level_id>1 and a.status=1 and a.is_del=0";
        foreach ($param as $key=>$val){
            if ($key == 'is_saleman' && !empty($val)){     //内部经纪人
                $condition_str .= " and a.is_saleman = {$val}";
            }else if($key == 'level' && !empty($val)){      //经纪人级别
                $condition_str .= " and a.level_id = {$val}";
            }else if($key == 'keywords' && !empty($val)){   //关键字筛选
                $condition_str .= " and (a.username like '%{$val}%' or a.mobile='{$val}' or b.company like '%{$val}%')";
            }else if ($key == 'province_id' && !empty($val)){   //筛选负责区域所在省份(暂时不筛选省份)

            }else if ($key == 'city_id' && !empty($val)){  //筛选负责区域所在城市
                $area = get_next_region_list($val);
                $area_str = "find_in_set('{$val}',service_area)";
                foreach ($area as $v){
                    $area_str .=" or find_in_set('".$v['id']."',service_area)";
                }
                $condition_str .= " and ($area_str)";
            }else if ($key == 'area_id' && !empty($val)){  //筛选负责区域所在区域
                $condition_str .= " and find_in_set('{$val}',service_area)";
            }
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
        $pages = Db::name('users')
            ->field("a.id")
            ->alias('a')
            ->join('users_content b', 'a.id = b.users_id', 'LEFT')
            ->where($condition_str)
            ->order($orderby)
            ->paginate($pagesize, false, $paginate);

        //获取所有区域
        $region_list = get_info_list('region','id','status=1');
        if ($pages->total() > 0) {
            $list = $pages->items();
            $aids = get_arr_column($list, 'id');

            $fields = "c.*,b.*, a.*";
            $row = Db::name('users')
                ->field($fields)
                ->alias('a')
                ->join('users_content b', 'a.id = b.users_id', 'LEFT')
                ->join('users_level c','a.level_id=c.id','LEFT')
                ->where('a.id', 'in', $aids)
                ->getAllWithIndex('id');
            // 获取模型对应的控制器名称
            $channel_list = model('Channeltype')->getAll('id, ctl_name', array(), 'id');

            foreach ($list as $key => $val) {
                $arcval = $row[$val['id']];
                $controller_name = $channel_list[$arcval['channel']]['ctl_name'];
                /*封面图*/
                $arcval['litpic'] = get_default_pic($arcval['litpic']); // 默认封面图
                if ('on' == $thumb) { // 属性控制是否使用缩略图
                    $arcval['litpic'] = thumb_img($arcval['litpic']);
                }
                /*--end*/
                //主营区域数组化
                $service_area = [];
                if (!empty($arcval['service_area'])){
                    $service_area_arr = explode(',',$arcval['service_area']);
                    foreach ($region_list as $k=>$v){
                        if (in_array($k,$service_area_arr)){
                            $service_area[] = $v;
                        }
                    }
                }
                $arcval['service_area'] = $service_area;
                //主营小区数组化
                $service_xiaoqu = [];
                if (!empty($arcval['service_xiaoqu'])){
                    $service_xiaoqu_arr = explode(',',$arcval['service_xiaoqu']);
                    $service_xiaoqu_list = Db::name("archives")->field("b.*, a.*")
                        ->alias('a')
                        ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
                        ->where(["a.aid"=>["in",$service_xiaoqu_arr]])
                        ->select();
                    foreach ($service_xiaoqu_list as $k=>$v){
                        if (in_array($v['aid'],$service_xiaoqu_arr)){
                            $v['arcurl'] =  arcurl('home/Xiaoqu/view', $v);
                            $service_xiaoqu[] = $v;
                        }
                    }
                }
                $arcval['service_xiaoqu'] = $service_xiaoqu;
                //经纪人数据统计
                if (!empty($is_count_arr)){
                    foreach ($is_count_arr as $v){
                        $arcval['count_'.$v] = Db::name("archives")->where(['users_id'=>$arcval['users_id'],'is_del'=>0,'status'=>1,'channel'=>['in',$v]])->count();
                    }
                }

                //内页路由
                $resultUrl = $this->UsersLoginc->GetUrlData(['users_id'=>$val['id']]);
                $arcval = array_merge($resultUrl,$arcval);

                $list[$key] = $arcval;
            }
            /*--end*/
        }

        $result['pages'] = $pages; // 分页显示输出
        $result['list'] = $list; // 赋值数据集
        $result['count'] = $pages->total();  //数据总数

        return $result;
    }


}