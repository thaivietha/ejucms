<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-1-7
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Custom extends Base
{
    // 模型标识
    public $nid = '';
    // 模型ID
    public $channeltype = 0;

    /*
     * 初始化操作
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->archives_db = Db::name('archives');
        
        $this->channeltype = input('param.channel/d', 0);
        $channeltypeRow = Db::name('channeltype')->field('nid')->where(['id'=>['eq',$this->channeltype]])->find();
        if (empty($this->channeltype) || empty($channeltypeRow)) {
            $this->error('自定义模型ID丢失，打开失败！');
        }
        $this->nid = $channeltypeRow['nid'];
        $this->assign('nid', $this->nid);
        $this->assign('channeltype', $this->channeltype);
    }
    /*
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
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
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
            $fields = "b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
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
     * 列表
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
        foreach (['keywords','typeid','flag','channel'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition["a.aid|a.title"] =['like',"%{$param[$key]}%"];
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    if(!empty($auth_role_info['permission']['arctype']) && !empty($typeid)){
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

        // 回收站
        $condition['a.is_del'] = array('eq', 0);

        /*自定义排序*/
        $orderby = input('param.orderby/s');
        $orderway = input('param.orderway/s');
        if (!empty($orderby)) {
            $orderby = "a.{$orderby} {$orderway}";
            $orderby .= ", a.aid desc";
        } else {
            $orderby = "a.aid desc";
        }
        /*end*/

        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = $this->archives_db->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        unset($param['openurl']);
        $Page = new Page($count, config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $this->archives_db
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order($orderby)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');

        /**
         * 完善数据集信息
         * 在数据量大的情况下，经过优化的搜索逻辑，先搜索出主键ID，再通过ID将其他信息补充完整；
         */
        if ($list) {
            $aids = array_keys($list);
            $fields = "b.*, a.*, a.aid as aid";
            $row = $this->archives_db
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $list[$key] = $row[$val['aid']];
            }
        }
        $pageStr = $Page->show(); // 分页显示输出
        $assign_data['pageStr'] = $pageStr; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        /*允许发布文档列表的栏目*/
        $arctype_html = allow_release_arctype($typeid, [$this->channeltype]);
        $typeidNum = substr_count($arctype_html, '</option>');
        $assign_data['arctype_html'] = $arctype_html;
        $assign_data['typeidNum'] = $typeidNum;
        /*--end*/

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
            $typeid = input('post.typeid/d', 0);

            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }
//            if (empty($post['seo_title'])){
//                $post['seo_title'] = $post['title'];
//            }
            /*获取第一个html类型的内容，作为文档的内容来截取SEO描述*/        
            $contentField = Db::name('channelfield')->where([
                    'channel_id'    => $this->channeltype,
                    'dtype'         => 'htmltext',
                ])->getField('name');
            $content = input('post.addonFieldExt.'.$contentField, '', null);
            /*--end*/

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
                'typeid'=> $typeid,
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

            $aid = $this->archives_db->insertGetId($data);
            $_POST['aid'] = $aid;
            if ($aid) {
                // ---------后置操作
                model('Custom')->afterSave($aid, $data, 'add');
                // ---------end
                adminLog('新增文档：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功", url("Index/uphtml", ['aid'=>$aid,'tid'=>$typeid,'channel'=>$this->channeltype,'controller'=>CONTROLLER_NAME,'action'=>ACTION_NAME]));
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
        
        /*获取可显示的系统字段*/
        $condition['ifcontrol'] = 0;
        $condition['channel_id'] = $this->channeltype;
        $channelfield_row = Db::name('channelfield')->where($condition)->field('name,ifeditable')->getAllWithIndex('name');
        $assign_data['channelfield_row'] = $channelfield_row;
        /*--end*/

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
        //模型信息
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$this->channeltype];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (!empty($channelJoin) && !empty($assign_data['field']['joinaid'])){
            $join = model($channelJoin['ctl_name'])->getOne("c.aid={$assign_data['field']['joinaid']}");
        }
        $assign_data['join_title'] = !empty($join['title']) ? $join['title']:'';
        $assign_data['original_price'] = !empty($join['price']) ? $join['price']:'';
        $assign_data['price_units'] = !empty($join['price_units']) ? $join['price_units']:'元/㎡';
        $assign_data['channelJoin'] = $channelJoin;
        $assign_data['ajaxSelectHouseUrl'] = !empty($channelJoin['ctl_name']) ? url($channelJoin['ctl_name']."/ajaxSelectHouse",['func'=>'set_house_back']) : '';
        //判断是否关联经纪人
        $assign_data['channelOrigin'] = $channelOrigin;
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
            $typeid = input('post.typeid/d', 0);

            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }

            /*获取第一个html类型的内容，作为文档的内容来截取SEO描述*/        
            $contentField = Db::name('channelfield')->where([
                    'channel_id'    => $this->channeltype,
                    'dtype'         => 'htmltext',
                ])->getField('name');
            $content = input('post.addonFieldExt.'.$contentField, '', null);
            /*--end*/

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
                $is_litpic = !empty($post['is_litpic']) ? $post['is_litpic'] : 0; // 有封面图
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
                'show_time'      => getTime(),
            );
            $data = array_merge($post, $newData);

            $r = M('archives')->where([
                    'aid'   => $data['aid'],
                ])->update($data);
            
            if ($r) {
                // ---------后置操作
                model('Custom')->afterSave($data['aid'], $data, 'edit');
                // ---------end
                adminLog('编辑文档：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功", url("Index/uphtml", ['aid'=>$data['aid'],'tid'=>$typeid,'channel'=>$this->channeltype,'controller'=>CONTROLLER_NAME,'action'=>ACTION_NAME]));
            }

            $this->error("操作失败!");
            exit;
        }

        $assign_data = array();

        $id = input('id/d');
        $info = model('Custom')->getInfo($id, null, false);
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
        $info['litpic'] = handle_subdir_pic($info['litpic']);
    
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

        /*获取可显示的系统字段*/
        $condition['ifcontrol'] = 0;
        $condition['channel_id'] = $this->channeltype;
        $channelfield_row = Db::name('channelfield')->where($condition)->field('name,ifeditable')->getAllWithIndex('name');
        $assign_data['channelfield_row'] = $channelfield_row;
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
        //经纪人信息
        if (!empty($info['relate'])){
            $relate_list = Db::name("users")->where(["id"=>["in",$info['relate']]])->select();
            $this->assign("relate_list",$relate_list);
        }
        //模型信息
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$this->channeltype];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (!empty($channelJoin) && !empty($assign_data['field']['joinaid'])){
            $join = model($channelJoin['ctl_name'])->getOne("c.aid={$assign_data['field']['joinaid']}");
        }
        $assign_data['join_title'] = !empty($join['title']) ? $join['title']:'';
        $assign_data['original_price'] = !empty($join['price']) ? $join['price']:'';
        $assign_data['price_units'] = !empty($join['price_units']) ? $join['price_units']:'元/㎡';
        $assign_data['channelJoin'] = $channelJoin;
        $assign_data['ajaxSelectHouseUrl'] = !empty($channelJoin['ctl_name']) ? url($channelJoin['ctl_name']."/ajaxSelectHouse",['func'=>'set_house_back']) : '';
        //判断是否关联经纪人
        $assign_data['channelOrigin'] = $channelOrigin;

        $this->assign($assign_data);
        return $this->fetch();
    }
    
    /**
     * 删除
     */
    public function del()
    {
        $archivesLogic = new \app\admin\logic\ArchivesLogic;
        $archivesLogic->del();
    }
}