<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class AdPosition extends Base
{
    private $ad_position_system_id = array(); // 系统默认位置ID，不可删除

    public function _initialize() {
        parent::_initialize();
    }
    //列表管理
    public function index()
    {
        $list = array();
        $get = input('get.');
        $keywords = input('keywords/s');
        $condition = [];
        // 应用搜索条件
        foreach (['keywords'] as $key) {
            if (isset($get[$key]) && $get[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$get[$key]}%");
                } else {
                    $tmp_key = 'a.'.$key;
                    $condition[$tmp_key] = array('eq', $get[$key]);
                }
            }
        }
        $adPositionM =  M('ad_position');
        $count = $adPositionM->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $adPositionM->alias('a')->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        // 获取指定位置的广告数目
        $cid = get_arr_column($list, 'id');
        $ad_list = M('ad')->field('pid, count(id) AS has_children')
            ->where([
                'pid'   => ['IN', $cid],
            ])->group('pid')
            ->getAllWithIndex('pid');
        $this->assign('ad_list', $ad_list);

        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$Page);// 赋值分页对象
        return $this->fetch();
    }
    
    /**
     * 新增广告
     */
    public function add()
    {
        //防止php超时
        function_exists('set_time_limit') && set_time_limit(0);
        if (IS_POST) {
            $post = input('post.');
            $map = array(
                'title' => trim($post['title']),
            );
            if(M('ad_position')->where($map)->count() > 0){
                $this->error('该广告名称已存在，请检查', url('AdPosition/index'));
            }
            // 添加广告位置表信息
            $data = array(
                'title'       => trim($post['title']),
                'admin_id'    => session('admin_id'),
                'add_time'    => getTime(),
                'update_time' => getTime(),
            );
            $insertId = M('ad_position')->insertGetId($data);
            if ($insertId) {
                // 读取组合广告位的图片及信息
                $i = '1';
                foreach ($post['img_litpic'] as $key => $value) {
                    if (!empty($value)) {
                        if (!empty($post['img_target'][$key])) {
                            $target = '1';
                        }else{
                            $target = '0';
                        }
                        // 主要参数
                        $AdData['litpic']      = $value;
                        $AdData['pid']         = $insertId;
                        $AdData['title']       = trim($post['img_title'][$key]);
                        $AdData['links']       = $post['img_links'][$key];
                        $AdData['intro']       = $post['intro'][$key];
                        $AdData['target']      = $target;
                        // 其他参数
                        $AdData['media_type']  = 1;
                        $AdData['admin_id']    = session('admin_id');
                        $AdData['sort_order']  = $i++;
                        $AdData['add_time']    = getTime();
                        $AdData['update_time'] = getTime();
                        $AdData['province_id']       = trim($post['province_id'][$key]);
                        $AdData['city_id']       = trim($post['city_id'][$key]);
                        $AdData['area_id']       = trim($post['area_id'][$key]);
                        // 添加到广告图表
                        $ad_id = Db::name('ad')->add($AdData);
                    }
                }
                adminLog('新增广告：'.$post['title']);
                $this->success("操作成功", url('AdPosition/index'));
            } else {
                $this->error("操作失败", url('AdPosition/index'));
            }
            exit;
        }

        return $this->fetch();
    }
    
    /**
     * 编辑广告
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.');
            if(!empty($post['id'])){
                if(array_key_exists($post['id'], $this->ad_position_system_id)){
                    $this->error("不可更改系统预定义位置", url('AdPosition/edit',array('id'=>$post['id'])));
                }

                $map = array(
                    'id'    => array('NEQ', $post['id']),
                    'title' => trim($post['title']),
                );

                if(Db::name('ad_position')->where($map)->count() > 0){
                    $this->error('该广告名称已存在，请检查', url('AdPosition/index'));
                }

                $data = array(
                    'id'          => $post['id'],
                    'title'       => trim($post['title']),
                    'update_time' => getTime(),
                );
                $r = Db::name('ad_position')->update($data);
            }

            if ($r) {
                $i = '1';
                $ad_db = Db::name('ad');
                // 读取组合广告位的图片及信息
                foreach ($post['img_litpic'] as $key => $value) {
                    if (!empty($value)) {
                        // 是否新窗口打开
                        if (!empty($post['img_target'][$key])) {
                            $target = '1';
                        }else{
                            $target = '0';
                        }
                        // 广告位ID，为空则表示添加
                        $ad_id = $post['img_id'][$key];
                        if (!empty($ad_id)) {
                            // 查询更新条件
                            $where = [
                                'id'   => $ad_id,
                            ];
                            if ($ad_db->where($where)->count() > 0) {
                                // 主要参数
                                $AdData['litpic']      = $value;
                                $AdData['title']       = $post['img_title'][$key];
                                $AdData['links']       = $post['img_links'][$key];
                                $AdData['intro']       = $post['intro'][$key];
                                $AdData['target']      = $target;
                                // 其他参数
                                $AdData['sort_order']  = $i++;
                                $AdData['update_time'] = getTime();
                                $AdData['province_id']       = trim($post['province_id'][$key]);
                                $AdData['city_id']       = trim($post['city_id'][$key]);
                                $AdData['area_id']       = trim($post['area_id'][$key]);
                                // 更新，不需要同步多语言
                                $ad_db->where($where)->update($AdData);
                            }else{
                                // 主要参数
                                $AdData['litpic']      = $value;
                                $AdData['pid']         = $post['id'];
                                $AdData['title']       = $post['img_title'][$key];
                                $AdData['links']       = $post['img_links'][$key];
                                $AdData['intro']       = $post['intro'][$key];
                                $AdData['target']      = $target;
                                // 其他参数
                                $AdData['media_type']  = 1;
                                $AdData['admin_id']    = session('admin_id');
                                $AdData['sort_order']  = $i++;
                                $AdData['add_time']    = getTime();
                                $AdData['update_time'] = getTime();
                                $AdData['province_id']       = trim($post['province_id'][$key]);
                                $AdData['city_id']       = trim($post['city_id'][$key]);
                                $AdData['area_id']       = trim($post['area_id'][$key]);
                                $ad_id = $ad_db->add($AdData);
                            }
                        }else{
                            // 主要参数
                            $AdData['litpic']      = $value;
                            $AdData['pid']         = $post['id'];
                            $AdData['title']       = $post['img_title'][$key];
                            $AdData['links']       = $post['img_links'][$key];
                            $AdData['intro']       = $post['intro'][$key];
                            $AdData['target']      = $target;
                            // 其他参数
                            $AdData['media_type']  = 1;
                            $AdData['admin_id']    = session('admin_id');
                            $AdData['sort_order']  = $i++;
                            $AdData['add_time']    = getTime();
                            $AdData['update_time'] = getTime();
                            $AdData['province_id']       = trim($post['province_id'][$key]);
                            $AdData['city_id']       = trim($post['city_id'][$key]);
                            $AdData['area_id']       = trim($post['area_id'][$key]);
                            $ad_id = $ad_db->add($AdData);
                        }
                    }
                }

                adminLog('编辑广告：'.$post['title']);
                $this->success("操作成功", url('AdPosition/index'));
            } else {
                $this->error("操作失败");
            }
        }

        $assign_data = array();

        $id = input('id/d');
        $field = M('ad_position')->field('a.*')
            ->alias('a')
            ->where(array('a.id'=>$id))
            ->find();
        if (empty($field)) {
            $this->error('广告不存在，请联系管理员！');
            exit;
        }
        $assign_data['field'] = $field;

        // 广告
        $ad_data = Db::name('ad')->where(array('pid'=>$field['id']))->order('sort_order asc')->select();
        $count_arr = [];
        $region_list = get_region_list();
        foreach ($ad_data as $key => $val) {
            $ad_data[$key]['litpic'] = handle_subdir_pic($val['litpic']); // 支持子目录
            if($val['area_id']){
                $ad_data[$key]['region_name'] = $region_list[$val['area_id']]['name'];
                $ad_data[$key]['region_id'] = $val['area_id'];
            }else if($val['city_id']){
                $ad_data[$key]['region_name'] = $region_list[$val['city_id']]['name'];
                $ad_data[$key]['region_id'] = $val['city_id'];
            }else if($val['province_id']){
                $ad_data[$key]['region_name'] = $region_list[$val['province_id']]['name'];
                $ad_data[$key]['region_id'] = $val['province_id'];
            }else{
                $ad_data[$key]['region_name'] = "不限区域";
                $ad_data[$key]['region_id'] = 0;
            }
            if (empty($count_arr) || $count_arr['id'] > $ad_data[$key]['region_id']){  //第一个广告或者区域id更小的区域
                $count_arr = [
                    "id" => $ad_data[$key]['region_id'] ,
                    "province_id" => $ad_data[$key]['province_id'] ,
                    "city_id" => $ad_data[$key]['city_id'] ,
                    "area_id" => $ad_data[$key]['area_id'] ,
                    "name" => !empty($region_list[$ad_data[$key]['region_id']]['name']) ? $region_list[$ad_data[$key]['region_id']]['name'] : "不限区域",
                    "count" => 1
                ];
            }else if($count_arr['id'] == $ad_data[$key]['region_id']){  //相同区域
                $count_arr['count']++;
            }
        }
        $assign_data['ad_data'] = $ad_data;
        $assign_data['count_arr'] = $count_arr;
        $this->assign($assign_data);
        return $this->fetch();
    }

    /**
     * 删除广告图片
     */
    public function del_imgupload()
    {
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            $r = Db::name('ad')->where([
                    'id' => ['IN', $id_arr],
                ])
                ->cache(true,null,'ad')
                ->delete();
            if ($r) {
                adminLog('删除广告-id：'.implode(',', $id_arr));
            }
        }
    }
    /**
     * 删除
     */
    public function del()
    {
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            foreach ($id_arr as $key => $val) {
                if(array_key_exists($val, $this->ad_position_system_id)){
                    $this->error('系统预定义，不能删除');
                }
            }

            $ad_count = M('ad')->where('pid','IN',$id_arr)->count();
            if ($ad_count > 0){
                $this->error('该位置下有广告，不允许删除，请先删除该位置下的广告');
            }

            $r = M('ad_position')->where('id','IN',$id_arr)->delete();
            if ($r) {
                adminLog('删除广告-id：'.implode(',', $id_arr));
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
    //选中广告区域
    public function ajaxSelectRegion(){
        $param = input('param.');
        $count_all = 0;
        $list = $province_arr = $city_arr = $area_arr = $count_arr = [];
        if (!empty($param['province'])){
            $province_arr = explode(',',$param['province']);
        }
        if (!empty($param['city'])){
            $city_arr = explode(',',$param['city']);
        }
        if (!empty($param['area'])){
            $area_arr = explode(',',$param['area']);
        }
        foreach ($area_arr as $key=>$val){
            if (!empty($val)){      //当前为一个区域广告
                if (empty($count_arr[$val])){
                    $count_arr[$val] = 1;
                }else{
                    $count_arr[$val]++;
                }
            }else if(!empty($city_arr[$key])){  //当前为一个城市广告
                if (empty($count_arr[$city_arr[$key]])){
                    $count_arr[$city_arr[$key]] = 1;
                }else{
                    $count_arr[$city_arr[$key]]++;
                }
            }else if(!empty($province_arr[$key])){  //当前为一个省份广告
                if (empty($count_arr[$province_arr[$key]])){
                    $count_arr[$province_arr[$key]] = 1;
                }else{
                    $count_arr[$province_arr[$key]]++;
                }
            }else{      //当前为一个通用广告
                if (empty($count_arr[0])){
                    $count_arr[0] = 1;
                }else{
                    $count_arr[0]++;
                }
            }
            $count_all++;
        }
        $result = Db::name("region")->where("status=1 and (domain<>'' or level=1)")->order("level asc")->select();  //
        $parent_arr = get_arr_column($result,'parent_id');
        $parent_arr = array_unique($parent_arr);
        $result = convert_arr_key($result,'id');
//        ['21'=>['id'=>'21','name'=>'海南','count'=>0,'child'=>['35'=>['id'=>'35','name'=>'海口','count'=>0,'child'=>['75'=>['id'=>'75','name'=>'龙华区','count'=>0,'child'=>[]]]]]]];
        foreach ($result as $val){
            $val['count'] = !empty($count_arr[$val['id']]) ? $count_arr[$val['id']] : 0;
            if ($val['parent_id'] == 0 && $val['level'] == 1){    //第一层
                $list[$val['id']] = $val;
            }
            if ($val['level'] == 2 && !empty($list[$val['parent_id']])){    //第二层
                $list[$val['parent_id']]['child'][$val['id']] = $val;
            }else if($val['level'] == 2){
                $list[$val['id']] = $val;
            }
            if ($val['level'] == 3){    //第二层
                $list[$result[$val['parent_id']]['parent_id']]['child'][$val['parent_id']]['child'][$val['id']] = $val;;
            }
        }
        $this->assign('list', $list);
        $func = input('func/s');
        $assign_data['count_arr'] = $count_arr;
        $assign_data['count_all'] = $count_all;
        $assign_data['func'] = $func;
        $this->assign($assign_data);
        return $this->fetch();
    }

}