<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/5
 * Time: 15:02
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Tuan  extends Base
{
    // 模型标识
    public $nid = 'tuan';
    // 模型ID
    public $channeltype = '';

    public function _initialize() {
        parent::_initialize();
        $this->archives_db = Db::name('archives');
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
        $this->assign('nid', $this->nid);
        $this->assign('channeltype', $this->channeltype);
    }

    /**
     * 内容列表动态获取数据（包括html和数据）
     */
    public function getAjaxHtml(){
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $typeid = input('typeid/d', 0);
        $begin = strtotime(input('add_time_begin'));
        $end = strtotime(input('add_time_end'));
        $admin_info = session('admin_info');
        $auth_role_info = [];
        if (0 < intval($admin_info['role_id'])) {
            $auth_role_info = $admin_info['auth_role_info'];
            if(! empty($auth_role_info)){
                if(isset($auth_role_info['only_oneself']) && 1 == $auth_role_info['only_oneself']){
                    $condition['a.admin_id'] = $admin_info['admin_id'];
                }
                if(!empty($auth_role_info['permission']['arctype'])){
                    $condition['a.typeid'] = array('IN', $auth_role_info['permission']['arctype']);
                }
            }
        }
        // 应用搜索条件
        foreach (['keywords','typeid','flag'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    if(!empty($auth_role_info['permission']['arctype']) && !empty($typeids)){
                        $typeids = array_intersect($typeids, $auth_role_info['permission']['arctype']);
                    }
                    $condition['a.typeid'] = array('IN', $typeids);
                } else if ($key == 'flag') {
                    $condition['a.'.$param[$key]] = array('eq', 1);
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }
        // 时间检索
        if ($begin > 0 && $end > 0) {
            $condition['a.add_time'] = array('between',"$begin,$end");
        } else if ($begin > 0) {
            $condition['a.add_time'] = array('egt', $begin);
        } else if ($end > 0) {
            $condition['a.add_time'] = array('elt', $end);
        }
        // 模型ID
        $condition['a.channel'] = array('eq', $this->channeltype);
        // 回收站
        $condition['a.is_del'] = array('eq', 0);
        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        $Page = new Page($count, 5);// 实例化分页类 传入总记录数和每页显示的记录数 config('paginate.list_rows')
        $list = DB::name('archives')
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');

        /**
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
                ->join("tuan_content c","a.aid = c.aid","LEFT")
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');

            foreach ($row as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['sale_status'] = $val['end_time'] > time() ? "团购中":"团购结束";

                $result = [];
                if ($val['joinaid']){
                    $result = db('archives')->field("b.*, a.*,c.dirname,c.dirpath,c.parent_id")
                        ->alias('a')
                        ->join('__XINFANG_CONTENT__ b', 'b.aid = a.aid', 'LEFT')
                        ->join('__ARCTYPE__ c', 'a.typeid = c.id', 'LEFT')
                        ->find($val['joinaid']);
                }
                $row[$val['aid']]['xinfang'] = $result;

                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象
        // 栏目ID
        $assign_data['typeid'] = $typeid; // 栏目ID

        $this->assign($assign_data);

        return $this->fetch('ajax_index');
    }

    /**
     * 文章列表
     */
    public function index()
    {
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $flag = input('flag/s');
        $typeid = input('typeid/d', 0);
        $begin = strtotime(input('add_time_begin'));
        $end = strtotime(input('add_time_end'));

        //省份搜索
        $province_id = input('province_id/d',0);
        $city_id = input('city_id/d',0);
        //城市搜索
        if (!empty($city_id)){
            $xinfang['city_id'] = $city_id;
            if (empty($province_id)){
                $province_id = model('region')->where("id=".$city_id)->getField('parent_id');
            }
        }else if (!empty($province_id)){
            $xinfang['province_id'] = $province_id;
        }
        if (!empty($xinfang)){
            $xinfang['channel'] = 9;
            $joinaid_arr = db("archives")->where($xinfang)->getField("aid",true);
            $condition['a.joinaid'] = ['in',$joinaid_arr];
        }
        $assign_data['province_id'] = $province_id;
        $assign_data['city_id'] = $city_id;

        //状态搜索
        $sale_status = input('sale_status',"");
        if (!empty($sale_status)){
            if ($sale_status == 1){     //活动中
                $condition['c.end_time'] = array('egt', time());
            }else{      //活动结束
                $condition['c.end_time'] = array('lt', time());
            }
        }
        /*权限控制 by 小虎哥*/
        $admin_info = session('admin_info');
        $auth_role_info = [];
        if (0 < intval($admin_info['role_id'])) {
            $auth_role_info = $admin_info['auth_role_info'];
            if(! empty($auth_role_info)){
                if(isset($auth_role_info['only_oneself']) && 1 == $auth_role_info['only_oneself']){
                    $condition['a.admin_id'] = $admin_info['admin_id'];
                }
                if(!empty($auth_role_info['permission']['arctype'])){
                    $condition['a.typeid'] = array('IN', $auth_role_info['permission']['arctype']);
                }
            }
        }
        /*--end*/
        // 应用搜索条件
        foreach (['keywords','typeid','flag'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    if(!empty($auth_role_info['permission']['arctype']) && !empty($typeids)){
                        $typeids = array_intersect($typeids, $auth_role_info['permission']['arctype']);
                    }
                    $condition['a.typeid'] = array('IN', $typeids);
                } else if ($key == 'flag') {
                    $condition['a.'.$param[$key]] = array('eq', 1);
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }
        // 时间检索
        if ($begin > 0 && $end > 0) {
            $condition['a.add_time'] = array('between',"$begin,$end");
        } else if ($begin > 0) {
            $condition['a.add_time'] = array('egt', $begin);
        } else if ($end > 0) {
            $condition['a.add_time'] = array('elt', $end);
        }

        // 模型ID
        $condition['a.channel'] = array('eq', $this->channeltype);

        // 回收站
        $condition['a.is_del'] = array('eq', 0);

        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->join("tuan_content c","a.aid=c.aid","LEFT")->where($condition)->count('a.aid');// 查询满足要求的总记录数
        unset($param['openurl']);
        $Page = new Page($count, config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数
        $list = DB::name('archives')
            ->join("tuan_content c","a.aid=c.aid","LEFT")
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        if ($list) {
            $aids = array_keys($list);
            $fields = "c.*,b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join("tuan_content c","a.aid = c.aid","LEFT")
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');

            foreach ($row as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['sale_status'] = $val['end_time'] > time() ? "团购中":"团购结束";

                $result = [];
                if ($val['joinaid']){
                    $result = db('archives')->field("b.*, a.*,c.dirname,c.dirpath,c.parent_id")
                        ->alias('a')
                        ->join('__XINFANG_CONTENT__ b', 'b.aid = a.aid', 'LEFT')
                        ->join('__ARCTYPE__ c', 'a.typeid = c.id', 'LEFT')
                        ->find($val['joinaid']);
                }
                $row[$val['aid']]['xinfang'] = $result;

                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        // 栏目ID
        $assign_data['typeid'] = $typeid; // 栏目ID
        /*当前栏目信息*/
        $arctype_info = array();
        if ($typeid > 0) {
            $arctype_info = M('arctype')->field('typename')->find($typeid);
        }
        $assign_data['arctype_info'] = $arctype_info;
        /*--end*/

        /*允许发布文档列表的栏目*/
        $arctype_html = allow_release_arctype($typeid, [$this->channeltype]);
        $typeidNum = substr_count($arctype_html, '</option>');
        $assign_data['arctype_html'] = $arctype_html;
        $assign_data['typeidNum'] = $typeidNum;
        //团购状态
        $assign_data['sale_status_list'] = [1=>'团购中',2=>'团购结束'];

        /*返回*/
        $gourl = '';
        $goback = input('param.goback/d');
        if (1 == $goback) {
            $gourl = url('Arctype/index');
        }
        $assign_data['gourl'] = $gourl;
        /*--end*/

        $this->assign($assign_data);

        return $this->fetch();
    }
    
    /**
     * 添加
     */
    public function add()
    {
        if (IS_POST) {
            $post = input('post.');
            $content = input('post.addonFieldExt.content', '', null);
            $typeid = input('post.typeid/d', 0);
            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }
//            if (empty($post['seo_title'])){
//                $post['seo_title'] = $post['title'];
//            }
            // 根据标题自动提取相关的关键字
            $seo_keywords = $post['seo_keywords'];
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
            } else {
                // $seo_keywords = get_split_word($post['title'], $content);
            }

            // 自动获取内容第一张图片作为封面图
            if (empty($post['litpic'])) {
                $post['litpic'] = get_html_first_imgurl($content);
            }
            /*是否有封面图*/
            if (empty($post['litpic'])) {
                $is_litpic = 0; // 无封面图
            } else {
                $is_litpic = 1; // 有封面图
            }

            // SEO描述
            $seo_description = '';
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = $post['seo_description'];
            }

            // 外部链接跳转
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }

            // 模板文件，如果文档模板名与栏目指定的一致，默认就为空。让它跟随栏目的指定而变
            if ($post['type_tempview'] == $post['tempview']) {
                unset($post['type_tempview']);
                unset($post['tempview']);
            }

            // --存储数据
            $newData = array(
                'typeid'=> empty($post['typeid']) ? 0 : $post['typeid'],
                'channel'   => $this->channeltype,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'     => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'admin_id'  => session('admin_info.admin_id'),
                'sort_order'    => 100,
                'add_time'     => strtotime($post['add_time']),
                'update_time'  => strtotime($post['add_time']),
                'show_time'      => getTime(),
            );
            $data = array_merge($post, $newData);

            $aid = M('archives')->insertGetId($data);
            $_POST['aid'] = $aid;
            if ($aid) {
                // ---------后置操作
                model('Tuan')->afterSave($aid, $data, 'add');
                // ---------end
                adminLog('新增资讯：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功!", url("Index/uphtml").'&aid='.$aid.'&tid='.$post['typeid'].'&controller=Tuan&action=add');
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $typeid = input('param.typeid/d', 0);
        if (empty($typeid)) {
            $arctypeInfo = Db::name('arctype')->where([
                    'current_channel'  => $this->channeltype,
                    'parent_id' => 0,
                    'status'    => 1,
                    'is_del'    => 0,
                ])
                ->order('sort_order asc, id asc')
                ->find();
            $typeid = $arctypeInfo['id'];
        } else {
            $arctypeInfo = Db::name('arctype')->find($typeid);
        }

        /*允许发布文档列表的栏目*/
        $arctype_html = allow_release_arctype($typeid, array($this->channeltype));

        $assign_data['arctype_html'] = $arctype_html;
        /*--end*/
        /*自定义字段*/
        $addonFieldExtList = model('Field')->getChannelFieldList($this->channeltype);
        $addonFieldExtList = convert_arr_key($addonFieldExtList,'name');
        $channelfieldBindRow = Db::name('channelfield_bind')->where([
            'typeid'    => ['IN', [0,$typeid]],
        ])->column('field_id');
        if (!empty($channelfieldBindRow)) {
            foreach ($addonFieldExtList as $key => $val) {
                if (!in_array($val['id'], $channelfieldBindRow)) {
                    unset($addonFieldExtList[$key]);
                }
            }
        }
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = 0;
        /*--end*/
        // 阅读权限
        $arcrank_list = get_arcrank_list();
        $assign_data['arcrank_list'] = $arcrank_list;

        /*模板列表*/
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $templateList = $archivesLogic->getTemplateList($this->nid);
        $this->assign('templateList', $templateList);
        /*--end*/

        /*默认模板文件*/
        $tempview = 'view_'.$this->nid.'.'.config('template.view_suffix');
        !empty($arctypeInfo['tempview']) && $tempview = $arctypeInfo['tempview'];
        $this->assign('tempview', $tempview);
        /*--end*/

        $this->assign($assign_data);

        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.');
            $content = input('post.addonFieldExt.content', '', null);
            $typeid = input('post.typeid/d', 0);
            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }

            // 根据标题自动提取相关的关键字
            $seo_keywords = $post['seo_keywords'];
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
            } else {
                // $seo_keywords = get_split_word($post['title'], $content);
            }

            // 自动获取内容第一张图片作为封面图
            if (empty($post['litpic'])) {
                $post['litpic'] = get_html_first_imgurl($content);
            }
            /*是否有封面图*/
            if (empty($post['litpic'])) {
                $is_litpic = 0; // 无封面图
            } else {
                $is_litpic = $post['is_litpic']; // 有封面图
            }

            // SEO描述
            $seo_description = '';
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = $post['seo_description'];
            }

            // --外部链接
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }

            // 模板文件，如果文档模板名与栏目指定的一致，默认就为空。让它跟随栏目的指定而变
            if ($post['type_tempview'] == $post['tempview']) {
                unset($post['type_tempview']);
                unset($post['tempview']);
            }

            // 同步栏目切换模型之后的文档模型
            $channel = Db::name('arctype')->where(['id'=>$typeid])->getField('current_channel');
            // --存储数据
            $newData = array(
                'typeid'=> $typeid,
                'channel'   => $channel,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'   => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'add_time'     => strtotime($post['add_time']),
                'update_time'     => getTime(),
            );
            $data = array_merge($post, $newData);

            $r = M('archives')->where([
                'aid'   => $data['aid'],
            ])->update($data);
            if ($r) {
                // ---------后置操作
                model('Tuan')->afterSave($data['aid'], $data, 'edit');
                // ---------end
                adminLog('编辑文章：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功!", url("Index/uphtml").'&aid='.$data['aid'].'&tid='.$typeid.'&controller=Tuan&action=edit');
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $assign_data = array();

        $id = input('id/d');
        $info = model('Tuan')->getInfo($id, null, false);
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        $admin_info = session('admin_info');
        if (0 < intval($admin_info['role_id'])) {
            $auth_role_info = $admin_info['auth_role_info'];
            if(! empty($auth_role_info)){
                if(isset($auth_role_info['only_oneself']) && 1 == $auth_role_info['only_oneself'] && $admin_info['admin_id'] != $info['admin_id']){
                    $this->error('您不能操作其他人文档');
                }
                if(!empty($auth_role_info['permission']['arctype']) && !in_array($info['typeid'],$auth_role_info['permission']['arctype'])){
                    $this->error('您没有权限操作该文档数据');
                }
            }
        }
        /*兼容采集没有归属栏目的文档*/
        if (empty($info['channel'])) {
            $channelRow = Db::name('channeltype')->field('id as channel')
                ->where('id',$this->channeltype)
                ->find();
            $info = array_merge($info, $channelRow);
        }
        /*--end*/
        $typeid = $info['typeid'];

        // 栏目信息
        $arctypeInfo = Db::name('arctype')->find($typeid);
        $info['channel'] = $arctypeInfo['current_channel'];
        // SEO描述
        if (!empty($info['seo_description'])) {
            $info['seo_description'] = @msubstr(checkStrHtml($info['seo_description']), 0, config('global.arc_seo_description_length'), false);
        }
        $assign_data['field'] = $info;
        /*允许发布文档列表的栏目，文档所在模型以栏目所在模型为主，兼容切换模型之后的数据编辑*/
        $arctype_html = allow_release_arctype($typeid, array($info['channel']));
        $assign_data['arctype_html'] = $arctype_html;
        /*--end*/
        /*自定义字段*/
        $addonFieldExtList = model('Field')->getChannelFieldList($info['channel'], 0, $id, $info);
        $addonFieldExtList = convert_arr_key($addonFieldExtList,'name');
        $channelfieldBindRow = Db::name('channelfield_bind')->where([
            'typeid'    => ['IN', [0,$typeid]],
        ])->column('field_id');
        if (!empty($channelfieldBindRow)) {
            foreach ($addonFieldExtList as $key => $val) {

                if (!in_array($val['id'], $channelfieldBindRow)) {
                    unset($addonFieldExtList[$key]);
                }
            }
        }

        $assign_data['addonFieldExtList'] = $addonFieldExtList;

        $assign_data['aid'] = $id;
        /*--end*/
        // 阅读权限
        $arcrank_list = get_arcrank_list();
        $assign_data['arcrank_list'] = $arcrank_list;
        /*模板列表*/
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $templateList = $archivesLogic->getTemplateList($this->nid);
        $this->assign('templateList', $templateList);
        /*--end*/
        /*默认模板文件*/
        $tempview = $info['tempview'];
        empty($tempview) && $tempview = $arctypeInfo['tempview'];
        $this->assign('tempview', $tempview);
        /*--end*/

        if ($assign_data['field']['joinaid']){
            $xinfang = model("xinfang")->getOne("c.aid={$assign_data['field']['joinaid']}","title,average_price,price_units");
            $assign_data['xinfangTitle'] = $xinfang ? $xinfang['title']:'';
            $assign_data['average_price'] = $xinfang ? $xinfang['average_price']:'';
            $assign_data['price_units'] = $xinfang ? $xinfang['price_units']:'';
        }
        $this->assign($assign_data);
        return $this->fetch();
    }

    /**
     * 删除
     */
    public function del()
    {
        if (IS_POST) {
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->del();
        }
    }
}