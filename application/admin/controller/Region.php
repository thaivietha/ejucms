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

use think\Db;
use think\Page;

class Region extends Base
{
    private $web_region_domain;

    public function _initialize(){
        parent::_initialize();
        $this->web_region_domain = tpCache('web.web_region_domain');
        $this->assign('web_region_domain', $this->web_region_domain);
    }

    public function edit(){
        if (IS_POST) {
            $post = input('post.');
            $r = false;
            if(!empty($post['id'])){
                $name = trim($post['name']);

                $domain = trim($post['domain']);
                if (1 == $this->web_region_domain && !empty($domain)) {
                    $domain = str_replace('.', '', $domain);
                    $domain = strtolower($domain);
                    $count = Db::name('region')->where([
                            'domain'    => $domain,
                            'id'    => ['NEQ', $post['id']],
                        ])->count();
                    if (!empty($count)) {
                        $this->error('二级域名已存在！');
                    }
                    // 检测
                    if (!empty($domain) && !$this->domain_unique($domain, $post['id'])) {
                        $this->error('二级域名与系统内置冲突，请更改！');
                    }
                    /*--end*/
                }

                // --存储数据
                $nowData = array(
                    'name'  => $name,
                    'domain'  => $domain,
                    'initial'   => getFirstCharter($name),
                    'update_time'    => getTime(),
                );
                if (!empty($post['city_id'])){
                    $nowData['level'] = 3;
                    $nowData['parent_id'] = intval($post['city_id']);
                } else if (!empty($post['province_id'])){
                    $nowData['level'] = 2;
                    $nowData['parent_id'] = intval($post['province_id']);
                } else {
                    $nowData['level'] = 1;
                    $nowData['parent_id'] = 0;
                }
                if (!empty($post['map'])){
                    $map_arr = explode(',', str_replace('，', ',', $post['map']));
                    $nowData['lng'] = !empty($map_arr[0])?$map_arr[0]:'';
                    $nowData['lat'] = !empty($map_arr[1])?$map_arr[1]:'';
                }
                $data = array_merge($post, $nowData);
                $r = M('region')->where([
                        'id'    => $post['id'],
                    ])
                    ->cache(true, null, "region")
                    ->update($data);
            }
            if (false !== $r) {
                extra_cache('global_get_province_list', null);
                extra_cache('global_get_city_list', null);
                extra_cache('global_get_area_list', null);
                adminLog('编辑区域：'.$data['name']);
                $this->success("操作成功", url('Region/index',['pid'=>$post['parent_id']]));
            }else{
                $this->error("操作失败");
            }
            exit;
        }

        $id = input('param.id/d', 0);
        $info = model("region")->getInfo($id);
        $info['litpic'] = handle_subdir_pic($info['litpic']);
        $assign_data['field'] = $info;
        $region = array_reverse(getParentRegionId($info['parent_id']));
        $assign_data['province_id'] = !empty($region[0]) ? $region[0] : 0;
        $assign_data['city_id'] = !empty($region[1]) ? $region[1] : 0;
        if (!empty($info['lng']) && !empty($info['lat'])){
            $assign_data['map'] = $info['lng'].','.$info['lat'];
        }

        // 省份列表
        $province_all = $this->get_province_all();
        $assign_data['province_all'] = $province_all;
        $assign_data['rootDomain'] = request()->rootDomain().ROOT_DIR;

        // 是否有下级
        $assign_data['has_children'] = Db::name('region')->where(['parent_id'=>$id])->count();

        $this->assign($assign_data);

        return $this->fetch();
    }

    public function add(){
        if (IS_POST) {
            $post = input('post.');
            $name = trim($post['name']);

            $domain = trim($post['domain']);
            if (1 == $this->web_region_domain && !empty($domain)) {
                $domain = strtolower($domain);
                $domain = str_replace('.', '', $domain);
                $count = Db::name('region')->where([
                        'domain'    => $domain,
                    ])->count();
                if (!empty($count)) {
                    $this->error('二级域名已存在！');
                }
                // 检测
                if (!empty($domain) && !$this->domain_unique($domain)) {
                    $this->error('二级域名与系统内置冲突，请更改！');
                }
                /*--end*/
            }

            // --存储数据
            $nowData = array(
                'name'  => $name,
                'domain'  => $domain,
                'initial'   => getFirstCharter($name),
                'sort_order'    => 100,
                'add_time'    => getTime(),
                'update_time'    => getTime(),
            );
            if (!empty($post['city_id'])){
                $nowData['level'] = 3;
                $nowData['parent_id'] = intval($post['city_id']);
            } else if (!empty($post['province_id'])){
                $nowData['level'] = 2;
                $nowData['parent_id'] = intval($post['province_id']);
            } else {
                $nowData['level'] = 1;
                $nowData['parent_id'] = 0;
            }
            if (!empty($post['map'])){
                $map_arr = explode(',', str_replace('，', ',', $post['map']));
                $nowData['lng'] = !empty($map_arr[0])?$map_arr[0]:'';
                $nowData['lat'] = !empty($map_arr[1])?$map_arr[1]:'';
            }
            $data = array_merge($post, $nowData);
            $insertId = M('region')->insertGetId($data);
            if (false !== $insertId) {
                \think\Cache::clear('region');
                extra_cache('global_get_province_list', null);
                extra_cache('global_get_city_list', null);
                extra_cache('global_get_area_list', null);
                adminLog('新增区域：'.$data['name']);
                $this->success("操作成功", url('Region/index', ['pid'=>$data['parent_id']]));
            }else{
                $this->error("操作失败");
            }
            exit;
        }

        $pid = input('param.pid/d', 0);
        $region = array_reverse(getParentRegionId($pid));
        $assign_data['province_id'] = !empty($region[0]) ? $region[0] : 0;
        $assign_data['city_id'] = !empty($region[1]) ? $region[1] : 0;

        // 省份列表
        $province_all = $this->get_province_all();
        $assign_data['province_all'] = $province_all;
        $assign_data['rootDomain'] = request()->rootDomain().ROOT_DIR;

        $this->assign($assign_data);

        return $this->fetch();
    }

    public function index()
    {
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $parent_id = input('pid/d', 0);

        // 应用搜索条件
        foreach (['keywords','pid'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['name'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'pid') {
                    $condition['parent_id'] = array('eq', $param[$key]);
                } else {
                    $condition[$key] = array('eq', $param[$key]);
                }
            }
        }

        // 上一级区域名称
        $parentInfo = Db::name('region')->where(['id'=>$parent_id])->find();
        $parentLevel = !empty($parentInfo['level']) ? intval($parentInfo['level']) : 0;
        $condition['level'] = $parentLevel + 1;

        $regionM =  M('region');
        $count = $regionM->where($condition)->count('id');// 查询满足要求的总记录数
        $Page = $pager = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $regionM->where($condition)->order('is_default desc,sort_order asc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象
        $this->assign('parentInfo',$parentInfo);

        return $this->fetch();
    }
    /*
     * 开启关闭启用
     * 开启当前，判断当前是否为唯一开启，如果是，则将当前设置为默认区域
     * 关闭当前，判断当前是否为原来默认区域：如果是，则判断当前同级（相同上级）是否存在开启：如存在，设置为默认，如不存在：判断第一级是否存在开启：如存在，设置第一个为默认，如不存在，继续往下级查找。
     *
     * 至少必须存在一个开启区域
     */
    public function setStatus(){
        $id = input('id/d', 0);
        $status = input('status/d', 0);
        $list = Db::name("region")->where("status=1")->order("level")->getField("id,parent_id,status,is_default,level");
        $count = count($list);
        $is_true = true;
        if ($status == 1){
            if ($count == 0 || ($count == 1 && empty($list[$id]))){
                $is_true = $this->setIsDefault($id);
            }
        }else{
            if ($count == 1 && !empty($list[$id])){
                $this->error("必须至少存在一个开启区域！".$status);
            }
            if (!empty($list[$id]) && $list[$id]['is_default'] == 1){
                $peer_id = $top_id = $any_id = 0;
                foreach ($list as $val){
                    if (empty($peer_id) && $val['id']!= $id && $val['parent_id'] == $list[$id]['parent_id']){
                        $peer_id = $val['id'];
                        break;
                    }
                    if (empty($top_id) && $val['id']!= $id && $val['parent_id'] == 0){
                        $top_id =  $val['id'];
                    }
                    if (empty($any_id) && $val['id']!= $id){
                        $any_id =  $val['id'];
                    }
                }
                if ($peer_id){
                    $default_id = $peer_id;
                }else if($top_id){
                    $default_id = $top_id;
                }else{
                    $default_id = $any_id;
                }
                $is_true = $this->setIsDefault($default_id);
            }
        }
        if (!$is_true){
            $this->error("设置失败,请检查二级域名不能为空！");
        }
        Db::name('region')->where(['id'=>$id])->update(['status'=>$status]);

        $this->success("设置成功");
    }
    /*
     * 设置默认区域
     */
    private function setIsDefault($id){
        $subdomain = Db::name('region')->where(['id'=>$id])->getField('domain');
        if ($this->web_region_domain && empty($subdomain)) {    //如果为开启状态，且二级域名为空，不允许设置
            return false;
        }
        $is_true = Db::name('region')->where(['id'=>$id])->update(['is_default'=>1]);
        if ($is_true){
            Db::name('region')->where(['id'=>['neq',$id]])->update(['is_default'=>0]);
            tpCache('system', ['system_default_subdomain'=>$subdomain]);
        }

        return $is_true;
    }
    /*
     * 设置是否默认
     */
    public function setSortOrder(){
        $id = input('id/d', 0);
        $is_true = $this->setIsDefault($id);
        if ($is_true){
            $this->success("设置成功");
        }else{
            $this->error("设置失败,请检查二级域名不能为空！");
        }
    }
    //获取全部省份
    private function get_province_all()
    {
        $result = Db::name('region')->field('id, name')
            ->where('level',1)
            ->order("sort_order asc")
            ->getAllWithIndex('id');

        return $result;
    }
    /**
    * 获取子类列表
    */  
    public function ajax_get_region($pid = 0,$level = 2, $text = '--请选择--'){
        $data = model('Region')->getList($pid,'*','',$level);
        $html = "<option value=''>".urldecode($text)."</option>";
        foreach($data as $key=>$val){
            $html.="<option value='".$val['id']."'>".$val['name']."</option>";
        }
        $isempty = 0;
        if (empty($data)){
            $isempty = 1;
        }
        $this->success($html,'',['isempty'=>$isempty]);

    }
    /*
     * 获取区域列表（关联栏目）
     * pid          上级id
     * level        级别
     * relevance    关联模型（表名称），为空时表示不关联
     * text         不选择时显示text
     */
    public function ajax_get_region_arc($pid = 0,$level = 1,$channel = '9', $text = '--请选择--'){
        $regionIds = $this->getAllRegionIds($level,'',$channel);
        $data = Db::name('Region')->field("*")
            ->where(["id"=>['in',$regionIds],'parent_id'=>$pid])
            ->select();
        if ($level == 1 && count($data) == 1){   //只存在一个省份
            $html = "<input type='hidden' id='province_id' name='province_id' value='".$data[0]['id']."'>";
        }else if ($level == 1){
            $html = "<select name='province_id' id='province_id' lay-ignore>";
            $html .= "<option value=''>".urldecode($text)."</option>";
            foreach($data as $key=>$val){
                $html.="<option value='".$val['id']."'>".$val['name']."</option>";
            }
            $html .= "</select>";
        }else{
            $html = "<select name='city_id' id='city_id' lay-ignore>";
            $html .= "<option value=''>".urldecode($text)."</option>";
            foreach($data as $key=>$val){
                $html.="<option value='".$val['id']."'>".$val['name']."</option>";
            }
            $html .= "</select>";
        }

        $this->success($html);
    }
    /*
     * 获取所有区域（id）集合
     */
    private function getAllRegionIds($level,$typeid = "",$channel = ""){
        $field = "province_id";
        if ($level == 2){
            $field = "city_id";
        }else if ($level == 3){
            $field = "area_id";
        }
        $where['status'] = 1;
        $where['is_del'] = 0;
        if (!empty($typeid)){
            $where['typeid'] = ['in',$typeid];
        }else if (!empty($channel)){
            $where['channel'] = ['in',$channel];
        }
        $regionIds = Db::name('archives')->where($where)->group($field)->getField($field,true);

        return $regionIds;
    }
    /**
     * 删除
     */
    public function del()
    {
        if (IS_POST) {
            $id_arr = input('del_id/a');
            $id_arr = eyIntval($id_arr);
            if(!empty($id_arr)){

                $count = Db::name('region')->where([
                        'is_default'    => 1,
                        'id' => ['IN', $id_arr],
                    ])->count();
                if ($count > 0){
                    $this->error('默认区域不允许删除');
                }

                $count = Db::name('region')->where('parent_id','IN',$id_arr)->count();
                if ($count > 0){
                    $this->error('所选区域有下级区域，请先删除下级区域');
                }

                $result = Db::name('region')->field('name')
                    ->where([
                        'id'    => ['IN', $id_arr],
                    ])->select();
                $name_list = get_arr_column($result, 'name');

                $r = Db::name('region')->where([
                        'id'    => ['IN', $id_arr],
                    ])
                    ->cache(true, null, "region")
                    ->delete();
                if($r){
                    extra_cache('global_get_province_list', null);
                    extra_cache('global_get_city_list', null);
                    extra_cache('global_get_area_list', null);
                    adminLog('删除区域：'.implode(',', $name_list));
                    $this->success('删除成功');
                }else{
                    $this->error('删除失败');
                }
            } else {
                $this->error('参数有误');
            }
        }
        $this->error('非法访问');
    }

    /**
     * 判断子域名的唯一性
     */
    private function domain_unique($domain = '', $id = 0)
    {
        $result = Db::name('region')->field('id,domain')->getAllWithIndex('id');
        if (!empty($result)) {
            if (0 < $id) unset($result[$id]);
            !empty($result) && $result = get_arr_column($result, 'domain');
        }
        empty($result) && $result = [];
        $dirnames = Db::name('arctype')->column('dirname');
        foreach ($dirnames as $key => $val) {
            $dirnames[$key] = strtolower($val);
        }
        $disableDirname = array_merge($this->disableDirname, $dirnames, $result);
        if (in_array(strtolower($domain), $disableDirname)) {
            return false;
        }
        return true;
    }
    /*
     * js打开获取子区域列表
     */
    public function ajaxSelectRegion(){
        $list = Db::name("region")->where("status=1")->select();
        $this->assign('list', $list);
        $this->assign('json_arctype_list', json_encode($list));
        $func = input('func/s');
        $assign_data['func'] = $func;
        $this->assign($assign_data);

        return $this->fetch();
    }
    /*
     * js获取region
     */
    public function ajaxGetOne($where = ""){
        return Db::name('region')->where($where)->find();
    }
}