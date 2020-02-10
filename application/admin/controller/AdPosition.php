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
    //区域管理
    public function region(){
        $id = input('pid/d');
        if (empty($id)) {
            $this->error('广告id不存在，请联系管理员！');
            exit;
        }
        $field = M('ad_position')->field('a.*')
            ->alias('a')
            ->where(array('a.id'=>$id))
            ->find();
        if (empty($field)) {
            $this->error('广告不存在，请联系管理员！');
            exit;
        }
        $assign_data['field'] = $field;
        // 应用搜索条件
        $condition['a.pid'] = $field['id'];
        foreach (['keywords'] as $key) {
            if (isset($get[$key]) && $get[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.name'] = array('LIKE', "%{$get[$key]}%");
                } else {
                    $tmp_key = 'a.'.$key;
                    $condition[$tmp_key] = array('eq', $get[$key]);
                }
            }
        }
        //区域
        $adPositionM =  M('ad_region');
        $count = $adPositionM->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $adPositionM->alias('a')->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $province_list = get_province_list();
        $city_list = get_city_list();
        $area_list = get_area_list();
        foreach ($list as $key=>$val){
            $name = "";
            if (!empty($val['province_id'])){
                $name .= !empty($province_list[$val['province_id']]) ? $province_list[$val['province_id']]['name'] : '';
            }
            if (!empty($val['city_id'])){
                $name .= !empty($city_list[$val['city_id']]) ? "->".$city_list[$val['city_id']]['name'] : '';
            }
            if (!empty($val['area_id'])){
                $name .= !empty($area_list[$val['area_id']]) ? "->".$area_list[$val['area_id']]['name'] : '';
            }
            $list[$key]['name'] = $name;
        }

        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$Page);// 赋值分页对象


        return $this->fetch();
    }
    //新增区域广告
    public function region_add(){
        //防止php超时
        function_exists('set_time_limit') && set_time_limit(0);
        if (IS_POST) {
            $post = input('post.');
            $pid = trim($post['pid']);
            $map = array(
                'pid' => $pid,
                'province_id' => trim($post['province_id']),
                'city_id' => trim($post['city_id']),
                'area_id' => trim($post['area_id']),
                'is_del' => 0,
                'status' => 1
            );
            if (Db::name("ad_region")->where($map)->find()){    //已经存在该区域
                $this->error('该广告名称该区域已存在，请检查', url('AdPosition/region',['pid'=>$pid]));
            }
            //添加区域信息
            $region = [
                'pid' => trim($post['pid']),
                'province_id' => trim($post['province_id']),
                'city_id' => trim($post['city_id']),
                'area_id' => trim($post['area_id']),
                'add_time'    => getTime(),
                'update_time' => getTime(),
            ];
            $rid = Db::name("ad_region")->insertGetId($region);
            if ($rid) {
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
                        $AdData['pid']         = $pid;
                        $AdData['rid']         = $rid;
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
                        // 添加到广告图表
                        $ad_id = Db::name('ad')->add($AdData);
                    }
                }
                adminLog('新增广告：'.$post['title']);
                $this->success("操作成功", url('AdPosition/region',['pid'=>$pid]));
            } else {
                $this->error("操作失败", url('AdPosition/region',['pid'=>$pid]));
            }
            exit;
        }
        $id = input('pid/d');
        if (empty($id)) {
            $this->error('广告id不存在，请联系管理员！');
            exit;
        }
        $field = M('ad_position')->field('a.*')
            ->alias('a')
            ->where(array('a.id'=>$id))
            ->find();
        if (empty($field)) {
            $this->error('广告不存在，请联系管理员！');
            exit;
        }
        $this->assign('field',$field);

        return $this->fetch();
    }
    //编辑区域广告
    public function region_edit(){
        if (IS_POST) {
            $post = input('post.');
            if(!empty($post['rid'])){
                $map = array(
                    'id'    => array('NEQ', $post['rid']),
                    'pid' => trim($post['pid']),
                    'province_id' => trim($post['province_id']),
                    'city_id' => trim($post['city_id']),
                    'area_id' => trim($post['area_id']),
                    'is_del' => 0,
                    'status' => 1
                );
                if (Db::name("ad_region")->where($map)->find()){    //已经存在该区域
                    $this->error('该广告名称该区域已存在，请检查', url('AdPosition/region',['pid'=>$post['pid']]));
                }
                $data = array(
                    'id'          => $post['rid'],
                    'province_id' => trim($post['province_id']),
                    'city_id' => trim($post['city_id']),
                    'area_id' => trim($post['area_id']),
                    'update_time' => getTime(),
                );
                $r = Db::name('ad_region')->update($data);
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
                                    // 更新，不需要同步多语言
                                    $ad_db->where($where)->update($AdData);
                                }else{
                                    // 主要参数
                                    $AdData['litpic']      = $value;
                                    $AdData['pid']         = $post['pid'];
                                    $AdData['rid']         = $post['rid'];
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
                                    $ad_id = $ad_db->add($AdData);
                                }
                            }else{
                                // 主要参数
                                $AdData['litpic']      = $value;
                                $AdData['pid']         = $post['pid'];
                                $AdData['rid']         = $post['rid'];
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
                                $ad_id = $ad_db->add($AdData);
                            }
                        }
                    }
                    adminLog('编辑广告：'.$post['title']);
                    $this->success("操作成功", url('AdPosition/region',['pid'=>$post['pid']]));
                }
            }

            $this->error("操作失败");
        }

        $assign_data = array();
        //判断广告区域
        $id = input('id/d');
        $region = Db::name("ad_region")->where(['id'=>$id])->find();
        if (empty($region)) {
            $this->error('广告区域不存在，请联系管理员！');
            exit;
        }
        //广告位置
        $field = Db::name('ad_position')->field('a.*,a.id as pid,b.id as rid,b.province_id,b.city_id,b.area_id')
            ->alias('a')
            ->join("ad_region b","a.id = b.pid","left")
            ->where(array('b.id'=>$id))
            ->find();
        if (empty($field)) {
            $this->error('广告不存在，请联系管理员！');
            exit;
        }
        $assign_data['field'] = $field;

        // 广告
        $ad_data = Db::name('ad')->where(array('pid'=>$field['pid'],'rid'=>$field['rid']))->order('sort_order asc')->select();
        foreach ($ad_data as $key => $val) {
            $ad_data[$key]['litpic'] = handle_subdir_pic($val['litpic']); // 支持子目录
        }
        $assign_data['ad_data'] = $ad_data;

        $this->assign($assign_data);
        return $this->fetch();
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
        $ad_data = Db::name('ad')->where(array('pid'=>$field['id'],'rid'=>0))->order('sort_order asc')->select();
        foreach ($ad_data as $key => $val) {
            $ad_data[$key]['litpic'] = handle_subdir_pic($val['litpic']); // 支持子目录
        }
        $assign_data['ad_data'] = $ad_data;
        
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
    //删除区域广告
    public function region_del(){
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            $ad_count = M('ad')->where('rid','IN',$id_arr)->count();
            if ($ad_count > 0)
                $this->error('该区域位置下有广告，不允许删除，请先删除该位置下的广告');{
            }

            $r = M('ad_region')->where('id','IN',$id_arr)->delete();
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

}