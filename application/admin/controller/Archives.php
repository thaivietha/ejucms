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
use app\common\logic\ArctypeLogic;

class Archives extends Base
{
    // 允许发布文档的模型ID
    public $allowReleaseChannel = array();
    
    public function _initialize() {
        parent::_initialize();
        $this->allowReleaseChannel = config('global.allow_release_channel');
    }

    /**
     * 内容管理
     */
    public function index()
    {
        $arctype_list = array();
        // 目录列表
        $arctypeLogic = new ArctypeLogic(); 
        $where['is_del'] = '0'; // 回收站功能
        $arctype_list = $arctypeLogic->arctype_list(0, 0, false, 0, $where, false);
        $zNodes = "[";
        foreach ($arctype_list as $key => $val) {
            $current_channel = $val['current_channel'];
            if (6 == $current_channel) {
                $gourl = url('Arctype/single_edit', array('typeid'=>$val['id']));
                $typeurl = url("Arctype/single_edit", array('typeid'=>$val['id'],'gourl'=>$gourl));
            } else if (8 == $current_channel) {
                $typeurl = url("Guestbook/index", array('typeid'=>$val['id']));
            } else {
                $typeurl = url('Archives/index_archives', array('typeid'=>$val['id']));
            }
            $typename = $val['typename'];
            $zNodes .= "{"."id:{$val['id']}, pId:{$val['parent_id']}, name:\"{$typename}\", url:'{$typeurl}',target:'content_body'";
            /*默认展开一级栏目*/
            if (empty($val['parent_id'])) {
                $zNodes .= ",open:true";
            }
            /*--end*/
            /*栏目有下级栏目时，显示图标*/
            if (1 == $val['has_children']) {
                $zNodes .= ",isParent:true";
            } else {
                $zNodes .= ",isParent:false";
            }
            /*--end*/
            $zNodes .= "},";
        }
        $zNodes .= "]";
        $this->assign('zNodes', $zNodes);

        return $this->fetch();
    }

    /**
     * 内容管理 - 新版
     */
    public function index_manage()
    {
        $contentManage = [];
        $channel_list = model('Channeltype')->getArctypeChannel('yes');
        foreach ($channel_list as $key => $val) {
            if (in_array($val['id'], [6])) {
                continue;
            }
            $contentManage[$val['id']] = [
                'id'    => $val['id'],
                'nid'    => $val['nid'],
            ];
        }
        $this->assign('contentManage',$contentManage);
        $menu = getMenuList();
        $adPosition = $tags = $links = 0;
        if (!empty($menu[6000])){
            if (!empty($menu[6000]['child'])){
                foreach ($menu[6000]['child'] as $val){
                    if ($val['id'] == 6002){
                        $adPosition = 1;
                    }
                    if ($val['id'] == 6004){
                        $tags = 1;
                    }
                    if ($val['id'] == 6003){
                        $links = 1;
                    }
                }
            }
        }
        $this->assign('adPosition',$adPosition);
        $this->assign('tags',$tags);
        $this->assign('links',$links);

        return $this->fetch();
    }

    /**
     * 内容管理 - 所有文档列表风格（只针对eju_archives表，排除单页记录）
     */
    public function index_archives(){
        $assign_data = array();
        $typeid_get =  input('typeid/d', 0);
        $channel =  input('channel/d', 0);
        $typeid_ses =  session('admin_info.typeid');
        $typeid = 0;
        if ($typeid_get){
            $typeid = $typeid_get;
        }else if($channel){
            $typeid_chan = db('arctype')->where("current_channel={$channel} and is_del=0 and status=1")->order("id asc")->getField('id');
            if ($typeid_chan){
                $typeid = $typeid_chan;
            }
        }else if ($typeid_ses){
            $typeid = $typeid_ses;
        }

        $assign_data['typeid'] = $typeid; // 栏目ID
        $condition = array();
        $condition['a.status'] = 1;
        $condition['a.is_del'] = 0;
        $arctype_list = db('arctype')
            ->alias('a')
            ->field('b.*,a.*')
            ->join('__CHANNELTYPE__ b', 'a.current_channel = b.id', 'LEFT')
            ->where($condition)
            ->order("a.id asc")
            ->getAllWithIndex("id");
        foreach ($arctype_list as $key=>$val){
            if ($val['ifsystem'] == 0){
                $arctype_list[$key]['ctl_name'] = "Custom";
            }else if ($val['current_channel'] == 6){
                $arctype_list[$key]['ctl_name'] = "Arctype";
            }
        }

        $ctl_name = $arctype_list[$typeid]['ctl_name'];
        $assign_data['url_table'] = url($ctl_name."/getAjaxHtml");  //请求链接

        $arctype_list = group_same_key($arctype_list,'parent_id');
        for ($i=0; $i < 3; $i++) {
            foreach ($arctype_list as $key => $val) {
                foreach ($arctype_list[$key] as $key2 => $val2) {
                    if (!isset($arctype_list[$val2['id']])) continue;
                    $val2['children'] = $arctype_list[$val2['id']];
                    $arctype_list[$key][$key2] = $val2;
                }
            }
        }
        $assign_data['arctype_list'] = !empty($arctype_list[0]) ? $arctype_list[0] : [];
        $assign_data['arctype_html'] = allow_release_arctype($typeid, array());

        $this->assign($assign_data);


        return $this->fetch('index_archives');
    }

    /**
     * 内容管理 - 栏目展开风格
     */
    private function index_arctype() {
        $arctype_list = array();
        // 目录列表
        $arctypeLogic = new ArctypeLogic(); 
        $arctype_list = $arctypeLogic->arctype_list(0, 0, false, 0, array(), false);
        $this->assign('arctype_list', $arctype_list);

        // 模型列表
        $channeltype_list = getChanneltypeList();
        $this->assign('channeltype_list', $channeltype_list);

        // 栏目最多级别
        $arctype_max_level = intval(config('global.arctype_max_level'));
        $this->assign('arctype_max_level', $arctype_max_level);

        // 允许发布文档的模型
        $this->assign('allow_release_channel', $this->allowReleaseChannel);

        return $this->fetch('index_arctype');
    }

    /**
     * 发布文档
     */
    public function add()
    {
        $typeid = input('param.typeid/d', 0);
        if (!empty($typeid)) {
            $row = db('arctype')
                ->alias('a')
                ->field('b.ctl_name,b.id,b.ifsystem')
                ->join('__CHANNELTYPE__ b', 'a.current_channel = b.id', 'LEFT')
                ->where('a.id', 'eq', $typeid)
                ->find();
            $data = [
                'typeid'    => $typeid,
            ];
            if (empty($row['ifsystem'])) {
                $ctl_name = 'Custom';
                $data['channel'] = $row['id'];
            } else {
                $ctl_name = $row['ctl_name'];
            }
            $gourl = url('Archives/index_archives', array('typeid'=>$typeid));
            $data['gourl'] = $gourl;
            $jumpUrl = url("{$ctl_name}/add", $data);
        } else {
            $jumpUrl = url("Archives/release");
        }
        $this->redirect($jumpUrl);
    }

    /**
     * 编辑文档
     */
    public function edit()
    {
        $id = input('param.id/d', 0);
        $typeid = input('param.typeid/d', 0);
        $row = db('archives')
            ->alias('a')
            ->field('a.channel,b.ctl_name,b.id,b.ifsystem')
            ->join('__CHANNELTYPE__ b', 'a.channel = b.id', 'LEFT')
            ->where('a.aid', 'eq', $id)
            ->find();
        if (empty($row['channel'])) {
            $channelRow = Db::name('channeltype')->field('id as channel, ctl_name')
                ->where('nid','article')
                ->find();
            $row = array_merge($row, $channelRow);
        }
        $data = [
            'id'    => $id,
        ];
        if (empty($row['ifsystem'])) {
            $ctl_name = 'Custom';
            $data['channel'] = $row['id'];
        } else {
            $ctl_name = $row['ctl_name'];
        }
        $arcurl = input('param.arcurl/s');
        $data['arcurl'] = $arcurl;
        $jumpUrl = url("{$ctl_name}/edit", $data);
        $this->redirect($jumpUrl);
    }

    /**
     * 删除文档
     */
    public function del()
    {
        if (IS_POST) {
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->del();
        }
    }

    /*
     * 添加属性
     */
    public function add_attribute(){
        if (IS_POST) {
            $post = input('post.');
            $aids = !empty($post['aids']) ? eyIntval($post['aids']) : '';

            if (empty($aids)) {
                $this->error('参数有误，请联系技术支持');
            }
            // 抽取相符合模型ID的文档aid
            $aids = Db::name('archives')->where([
                'aid'   =>  ['IN', $aids],
            ])->column('aid');

            // 移动文档处理
            $update_data = array(
                'update_time'   => getTime(),
            );
            if ($post['is_head']){
                $update_data['is_head'] = 1;
            }
            if ($post['is_recom']){
                $update_data['is_recom'] = 1;
            }
            if ($post['is_special']){
                $update_data['is_special'] = 1;
            }
            if ($post['is_b']){
                $update_data['is_b'] = 1;
            }
            if ($post['is_litpic']){
                $update_data['is_litpic'] = 1;
            }
            $r = M('archives')->where([
                'aid' => ['IN', $aids],
            ])->update($update_data);
            if($r){
                adminLog('添加属性-id：'.$aids);
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }
        /*表单提交URL*/
        $form_action = url('Archives/add_attribute');
        $this->assign('form_action', $form_action);
        /*--end*/

        return $this->fetch();
    }

    /*
     * 删除属性
     */
    public function del_attribute(){
        if (IS_POST) {
            $post = input('post.');
            $aids = !empty($post['aids']) ? eyIntval($post['aids']) : '';

            if (empty($aids)) {
                $this->error('参数有误，请联系技术支持');
            }
            // 抽取相符合模型ID的文档aid
            $aids = Db::name('archives')->where([
                'aid'   =>  ['IN', $aids],
            ])->column('aid');

            // 移动文档处理
            $update_data = array(
                'update_time'   => getTime(),
            );
            if ($post['is_head']){
                $update_data['is_head'] = 0;
            }
            if ($post['is_recom']){
                $update_data['is_recom'] = 0;
            }
            if ($post['is_special']){
                $update_data['is_special'] = 0;
            }
            if ($post['is_b']){
                $update_data['is_b'] = 0;
            }
            if ($post['is_litpic']){
                $update_data['is_litpic'] = 0;
            }
            $r = M('archives')->where([
                'aid' => ['IN', $aids],
            ])->update($update_data);
            if($r){
                adminLog('添加属性-id：'.$aids);
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }
        /*表单提交URL*/
        $form_action = url('Archives/del_attribute');
        $this->assign('form_action', $form_action);
        /*--end*/

        return $this->fetch('add_attribute');
    }
    
    /**
     * 移动
     */
    public function move()
    {
        if (IS_POST) {
            $post = input('post.');
            $typeid = !empty($post['typeid']) ? eyIntval($post['typeid']) : '';
            $aids = !empty($post['aids']) ? eyIntval($post['aids']) : '';

            if (empty($typeid) || empty($aids)) {
                $this->error('参数有误，请联系技术支持');
            }

            // 获取移动栏目的模型ID
            $current_channel = Db::name('arctype')->where([
                    'id'    => $typeid,
                ])->getField('current_channel');
            // 抽取相符合模型ID的文档aid
            $aids = Db::name('archives')->where([
                    'aid'   =>  ['IN', $aids],
                    'channel'   =>  $current_channel,
                ])->column('aid');
            // 移动文档处理
            $update_data = array(
                'typeid'    => $typeid,
                'update_time'   => getTime(),
            );
            $r = M('archives')->where([
                    'aid' => ['IN', $aids],
                ])->update($update_data);
            if($r){
                adminLog('移动文档-id：'.$aids);
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }

        $typeid = input('param.typeid/d', 0);

        /*允许发布文档列表的栏目*/
        $allowReleaseChannel = [];
        if (!empty($typeid)) {
            $channelId = Db::name('arctype')->where('id',$typeid)->getField('current_channel');
            $allowReleaseChannel[] = $channelId;
        }
        $arctype_html = allow_release_arctype($typeid, $allowReleaseChannel);
        $this->assign('arctype_html', $arctype_html);
        /*--end*/

        /*表单提交URL*/
        $form_action = url('Archives/move');
        $this->assign('form_action', $form_action);
        /*--end*/

        return $this->fetch();
    }

    /**
     * 复制
     */
    public function batch_copy()
    {
        if (IS_POST) {
            $typeid = input('post.typeid/d');
            $aids = input('post.aids/s');
            $num = input('post.num/d');

            if (empty($typeid) || empty($aids)) {
                $this->error('复制失败！');
            } else if (empty($num)) {
                $this->error('复制数量至少一篇！');
            }

            // 获取复制栏目的模型ID
            $current_channel = Db::name('arctype')->where([
                    'id'    => $typeid,
                ])->getField('current_channel');
            // 抽取相符合模型ID的文档aid
            $aids = Db::name('archives')->where([
                    'aid'   =>  ['IN', $aids],
                    'channel'   =>  $current_channel,
                ])->column('aid');
            // 复制文档处理
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $r = $archivesLogic->batch_copy($aids, $typeid, $current_channel, $num);
            if($r){
                adminLog('复制文档-id：'.$aids);
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }

        $typeid = input('param.typeid/d', 0);

        /*允许发布文档列表的栏目*/
        $allowReleaseChannel = [];
        if (!empty($typeid)) {
            $channelId = Db::name('arctype')->where('id',$typeid)->getField('current_channel');
            $allowReleaseChannel[] = $channelId;
        }
        $arctype_html = allow_release_arctype($typeid, $allowReleaseChannel);
        $this->assign('arctype_html', $arctype_html);
        /*--end*/

        /*表单提交URL*/
        $form_action = url('Archives/batch_copy');
        $this->assign('form_action', $form_action);
        /*--end*/

        return $this->fetch();
    }

    /**
     * 发布内容
     */
    public function release()
    {
        $typeid = input('param.typeid/d', 0);
        if (0 < $typeid) {
            $param = input('param.');
            $row = db('arctype')
                ->field('b.ctl_name,b.id')
                ->alias('a')
                ->join('__CHANNELTYPE__ b', 'a.current_channel = b.id', 'LEFT')
                ->where('a.id', 'eq', $typeid)
                ->find();
            /*针对不支持发布文档的模型*/
            if (!in_array($row['id'], $this->allowReleaseChannel)) {
                $this->error('该栏目不支持发布文档！', url('Archives/release'));
                exit;
            }
            /*-----end*/

            $gourl = url('Archives/index_archives', array('typeid'=>$typeid), true, true);
            $jumpUrl = url("Archives/add", array('typeid'=>$typeid,'gourl'=>$gourl), true, true);
            header('Location: '.$jumpUrl);
            exit;
        }

        $iframe = input('param.iframe/d',0);

        /*允许发布文档列表的栏目*/
        $select_html = allow_release_arctype();
        $this->assign('select_html',$select_html);
        /*--end*/

        /*不允许发布文档的模型ID，用于JS判断*/
        $js_allow_channel_arr = '[';
        foreach ($this->allowReleaseChannel as $key => $val) {
            if ($key > 0) {
                $js_allow_channel_arr .= ',';
            }
            $js_allow_channel_arr .= $val;
        }
        $js_allow_channel_arr = $js_allow_channel_arr.']';
        $this->assign('js_allow_channel_arr', $js_allow_channel_arr);
        /*--end*/

        $this->assign('iframe', $iframe);
        $template = "release";
        return $this->fetch($template);
    }

    public function ajax_get_arctype()
    {
        $pid = input('pid/d');
        $html = '';
        $status = 0;
        if (0 < $pid) {
            $map = array(
                'current_channel'    => array('IN', $this->allowReleaseChannel),
                'parent_id' => $pid,
            );
            $row = model('Arctype')->getAll('id,typename', $map, 'id');
            if (!empty($row)) {
                $status = 1;
                $html = '<option value="0">请选择栏目…</option>';
                foreach ($row as $key => $val) {
                    $html .= '<option value="'.$val['id'].'">'.$val['typename'].'</option>';
                }
            }
        }

        respose(array(
            'status'    => $status,
            'msg'   => $html,
        ));
    }
}