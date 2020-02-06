<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 易而优团队 by 陈风任 <491085389@qq.com>
 * Date: 2018-4-3
 */

namespace app\admin\controller;

use think\Page;
use think\Db;
use app\common\logic\NavigationLogic;

class Navigation extends Base
{
    public $navigationlogic;
    
    public function _initialize() {
        parent::_initialize();
        $this->navigationlogic = new NavigationLogic();
        $this->navig_list_db = Db::name('navig_list');
        $this->navig_position_db = Db::name('navig_position');

        /*兼容每个用户的自定义字段，重新生成数据表字段缓存文件*/
        $arctypeFieldInfo = include DATA_PATH.'schema/'.PREFIX.'navigation.php';
        foreach (['weapp_code'] as $key => $val) {
            if (!isset($arctypeFieldInfo[$val])) {
                try {
                    schemaTable('navigation');
                } catch (\Exception $e) {}
                break;
            }
        }
        /*--end*/
    }

/*    public function index()
    {
        // 导航位置数据
        $order = 'sort_order asc, position_id asc';
        $PosiData = $this->navig_position_db->where('is_del', 0)->order($order)->select();
        $AssignData['PosiData'] = $PosiData;

        // 导航位置ID
        $position_id = input('param.position_id/d') ? input('param.position_id/d') : 0;
        $position_id = empty($position_id) && !empty($PosiData) ? $PosiData[0]['position_id'] : $position_id;
        $AssignData['position_id'] = $position_id;
        foreach ($PosiData as $key => $value) {
            if ($value['position_id'] == $position_id) {
                $AssignData['position_name'] = $value['position_name'];
                break;
            }
        }

        // 导航列表数据
        $where = [
            'is_del' => 0,
            'position_id' => $position_id
        ];
        $order = 'sort_order asc, navig_id asc';
        $NavigData = $this->navig_list_db->where($where)->order($order)->select();
        $AssignData['NavigData'] = $NavigData;

        $this->assign($AssignData);
        return $this->fetch();
    }*/

    public function index()
    {
        // 导航位置数据
        $order = 'sort_order asc, position_id asc';
        $PosiData = $this->navig_position_db->where('is_del', 0)->order($order)->select();
        $AssignData['PosiData'] = $PosiData;

        // 导航位置ID
        $position_id = input('param.position_id/d') ? input('param.position_id/d') : 0;
        $position_id = empty($position_id) && !empty($PosiData) ? $PosiData[0]['position_id'] : $position_id;
        $AssignData['position_id'] = $position_id;
        $position_name = '指向菜单';
        foreach ($PosiData as $key => $value) {
            if ($value['position_id'] == $position_id) {
                $position_name = $value['position_name'];
                break;
            }
        }

        $navig_list = array();
        // 目录列表
        $where['position_id']   = $position_id;
        $where['is_del'] = '0';
        $navig_list = $this->navigationlogic->navig_list(0, 0, false, 0, $where, false);
        foreach ($navig_list as $key=>$val){
            $navig_list[$key]['position_name'] = $position_name;
        }

        $navig_list = array_merge($navig_list);
        $this->assign('navig_list', $navig_list);
        $this->assign('json_navig_list', json_encode($navig_list));

        // 菜单最多级别
        $navig_max_level = intval(config('global.navig_max_level'));
        $this->assign('navig_max_level', $navig_max_level);
        
        $this->assign($AssignData);

        return $this->fetch();
    }

    /**
     * 新增
     */
    public function add()
    {
        //防止php超时
        function_exists('set_time_limit') && set_time_limit(0);
        
        if (IS_POST) {
            $post = input('post.');
            if (!empty($post)) {
                if (empty($post['arctype_sync'])) {
                    if (empty($post['navig_name'])) $this->error("请填写导航名称");
                    if (empty($post['navig_url'])) $this->error("请填写导航链接");
                }
                
                /*封面图的本地/远程图片处理*/
                $is_remote = !empty($post['is_remote']) ? $post['is_remote'] : 0;
                $litpic = '';
                if (1 == $is_remote) {
                    $litpic = $post['litpic_remote'];
                } else {
                    $litpic = $post['navig_pic'];
                }
                /*--end*/

                // url格式化
                $post['navig_url'] = htmlspecialchars_decode($post['navig_url']);

                $newData = array(
                    'sort_order' => 100,
                    'target'    => !empty($post['target']) ? 1 : 0,
                    'nofollow'    => !empty($post['nofollow']) ? 1 : 0, 
                    'is_del' => 0,
                    'add_time'  => getTime(),
                    'update_time'  => getTime()
                );
                $data = array_merge($post, $newData);
                $insertId = $this->navig_list_db->add($data);
                if($insertId){
                    adminLog('新增导航：'.$data['navig_name']);
                    $this->success("操作成功!", url('Navigation/index', ['position_id'=>$post['position_id']]));
                }
            }
            $this->error("操作失败!");
        }

        $ReturnData = array();

        // 导航位置
        $position_id = input('param.position_id/d') ? input('param.position_id/d') : 0;
        if (empty($position_id)) $this->error("请选择导航位置");
        $where = [
            'is_del' => 0,
            'position_id' => $position_id,
        ];
        $AssignData['PosiData'] = $this->navig_position_db->where($where)->find();

        // 所属菜单
        $parent_id = input('param.parent_id/d');
        $grade = 0;
        $pnavigname = '';
        if (0 < $parent_id) {
            $info = M('navig_list')->where(array('navig_id'=>$parent_id))->find();
            if ($info) {
                // 级别
                $grade = $info['grade'] + 1;
                // 上级菜单名称
                $pnavigname = $info['navig_name'];
            }
        }
        $AssignData['grade'] = $grade;
        $AssignData['parent_id'] = $parent_id;
        $AssignData['pnavigname'] = $pnavigname;

        // 所属菜单
        // $navig_select = $this->navigationlogic->getNavigList($position_id);
        // $AssignData['navig_select'] = $navig_select;

        // 前台功能下拉框
        $AssignData['Function'] =  $this->navigationlogic->ForegroundFunction();

        // 全部栏目下拉框
        $AssignData['ArctypeHtml'] = $this->navigationlogic->GetAllArctype();

        $this->assign($AssignData);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.');
            if(!empty($post)){

                if (empty($post['arctype_sync'])) {
                    if (empty($post['navig_name'])) $this->error("请填写导航名称");
                    if (empty($post['navig_url'])) $this->error("请填写导航链接");
                }
                
                /*封面图的本地/远程图片处理*/
                $is_remote = !empty($post['is_remote']) ? $post['is_remote'] : 0;
                $litpic = '';
                if (1 == $is_remote) {
                    $litpic = $post['litpic_remote'];
                } else {
                    $litpic = $post['navig_pic'];
                }
                /*--end*/

                // 当前更改的等级
                $grade = 0; 
                // 根据菜单ID获取最新的最顶级模型ID
                if (intval($post['parent_id']) > 0) {
                    $navig_row = M('navig_list')->field('grade')->where('navig_id', $post['parent_id'])->find();
                    $grade = $navig_row['grade'] + 1;
                }

                // url格式化
                $post['navig_url'] = htmlspecialchars_decode($post['navig_url']);

                $newData = array(
                    'grade' => $grade,
                    'target'    => !empty($post['target']) ? 1 : 0,
                    'nofollow'    => !empty($post['nofollow']) ? 1 : 0, 
                    'is_del' => 0,
                    'add_time'  => getTime(),
                    'update_time'  => getTime()
                );
                $data = array_merge($post, $newData);
                $ResultID = $this->navig_list_db->update($data);
                if($ResultID){
                    adminLog('修改导航：'.$data['navig_name']);
                    $this->success("操作成功", url('Navigation/index', ['position_id'=>$post['position_id']]));
                }
            }
            $this->error("操作失败");
        }

        $ReturnData = array();

        // 导航位置
        $navig_id = input('param.navig_id/d') ? input('param.navig_id/d') : 0;
        if (empty($navig_id)) $this->error("请选择导航");
        $field = 'a.*, b.position_name, c.typename';
        $NavigList = $this->navig_list_db
            ->field($field)
            ->alias('a')
            ->join('__NAVIG_POSITION__ b', 'a.position_id = b.position_id', 'LEFT')
            ->join('__ARCTYPE__ c', 'a.type_id = c.id', 'LEFT')
            ->where('a.navig_id', $navig_id)
            ->find();

        $NavigList['navig_name'] = !empty($NavigList['arctype_sync']) ? $NavigList['typename'] : $NavigList['navig_name'];
        $AssignData['NavigList'] = $NavigList;

        // 是否有子菜单
        $hasChildren = $this->navigationlogic->hasChildren($navig_id);
        if ($hasChildren > 0) {
            $select_html = Db::name('navig_list')->where('navig_id', $NavigList['parent_id'])->getField('navig_name');
            $select_html = !empty($select_html) ? $select_html : '顶级菜单';
        } else {
            // 所属菜单
            $select_html = '<option value="0" data-grade="-1">顶级菜单</option>';
            $selected = $NavigList['parent_id'];
            $navig_max_level = intval(config('global.navig_max_level'));
            $options = $this->navigationlogic->navig_list(0, $selected, false, $navig_max_level - 1);
            foreach ($options AS $var)
            {
                $select_html .= '<option value="' . $var['navig_id'] . '" data-grade="' . $var['grade'] . '"';
                $select_html .= ($selected == $var['navig_id']) ? "selected='true'" : '';
                $select_html .= ($navig_id == $var['navig_id']) ? "disabled='true' style='background-color:#f5f5f5;' " : '';
                $select_html .= '>';
                if ($var['level'] > 0)
                {
                    $select_html .= str_repeat('&nbsp;', $var['level'] * 4);
                }
                $select_html .= htmlspecialchars(addslashes($var['navig_name'])) . '</option>';
            }
        }
        $this->assign('select_html',$select_html);
        $this->assign('hasChildren',$hasChildren);

        // 所属菜单
        // $navig_select = $this->navigationlogic->getNavigList($NavigList['position_id']);
        // $AssignData['navig_select'] = $navig_select;

        // 前台功能下拉框
        $AssignData['Function'] =  $this->navigationlogic->ForegroundFunction();

        // 全部栏目下拉框
        $AssignData['ArctypeHtml'] = $this->navigationlogic->GetAllArctype($NavigList['type_id']);

        $this->assign($AssignData);
        return $this->fetch();
    }
    
    /**
     * 删除
     */
    public function del()
    {
        if (IS_POST) {
            $post = input('post.');
            $post['del_id'] = eyIntval($post['del_id']);
            /*当前栏目信息*/
            $row = $this->navig_list_db->field('navig_name')->where('navig_id', 'IN', $post['del_id'])->find();
            $r = $this->navig_list_db->delete($post['del_id']);
            if (false !== $r) {
                adminLog('删除导航菜单：' . $row['navig_name']);
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }
}
