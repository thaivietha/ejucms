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
use think\Config;

class Article extends Base
{
    // 模型标识
    public $nid = 'article';
    // 模型ID
    public $channeltype = '';
    
    public function _initialize() {
        parent::_initialize();
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
            $fields = "c.*,b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join("article_content c","a.aid = c.aid","LEFT")
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
     * ajax获取列表数据(应用于首页)
     */
    public function ajax_get_list(){
        $condition['a.channel'] = array('eq', $this->channeltype);
        $condition['a.is_del'] = array('eq', 0);
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

        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        $Page = new Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数  config('paginate.list_rows')
        $list = DB::name('archives')
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.add_time desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        if ($list) {
            $aids = array_keys($list);
            $fields = "b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->order('a.add_time desc')
                ->getAllWithIndex('aid');
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $openurl = url('Archives/edit',[/*'typeid'=>$row[$val['aid']]['typeid'],*/ 'id'=>$val['aid']]);//urlencode(url('Archives/edit',['typeid'=>$val['typeid'],'id'=>$val['aid']]));
                $row[$val['aid']]['lay_href'] = url('Article/index',[/*'typeid'=>$row[$val['aid']]['typeid'],*/ 'msg'=>'编辑','openurl'=>$openurl]);
                $list[$key] = $row[$val['aid']];
            }
        }
        $list = array_merge($list);

        return ['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
    }
    
    /**
     * 文档列表
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
        foreach (['keywords','typeid','flag'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition["a.aid|a.title"] =['like',"%{$param[$key]}%"];
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
        //主动添加
        $condition['a.add_type'] = array('eq', 1);
        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        unset($param['openurl']);
        $Page = new Page($count, config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数
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
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$this->channeltype];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (IS_POST) {
            $post = input('post.');
            $typeid = input('post.typeid/d', 0);
            $content = input('post.addonFieldExt.content', '', null);
            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }
            if(!empty($channelOrigin['join_must']) && empty($post['joinaid'])){
                $this->error("请选择关联{$channelJoin['ntitle']}！");
            }
            //判断所有必选项是否已经填写
            $check = model('Field')->checkChannelFieldRequire($this->channeltype, $post);
            if ($check){
                $this->error("{$check['title']}不能为空！");
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
            !empty($post['relate']) && $post['relate'] = implode(',',$post['relate']);
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
                'province_id'  => empty($post['province_id']) ? 0 : $post['province_id'],
                'city_id'      => empty($post['city_id']) ? 0 : $post['city_id'],
                'area_id'      => empty($post['area_id']) ? 0 : $post['area_id'],
                'show_time'      => getTime(),
            );
            $data = array_merge($post, $newData);

            $aid = M('archives')->insertGetId($data);
            $_POST['aid'] = $aid;
            if ($aid) {
                // ---------后置操作
                model('Article')->afterSave($aid, $data, 'add');
                // ---------end
                adminLog('新增文档：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功", url("Index/uphtml", ['aid'=>$aid,'tid'=>$typeid,'channel'=>$this->channeltype,'controller'=>CONTROLLER_NAME,'action'=>ACTION_NAME]));
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
        $assign_data['web_region_domain'] = tpCache('web.web_region_domain');

        //模型信息
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
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$this->channeltype];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (IS_POST) {
            $post = input('post.');
            $typeid = input('post.typeid/d', 0);
            $content = input('post.addonFieldExt.content', '', null);

            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }
            if(!empty($channelOrigin['join_must']) && empty($post['joinaid'])){
                $this->error("请选择关联{$channelJoin['ntitle']}！");
            }
            //判断所有必选项是否已经填写
            $check = model('Field')->checkChannelFieldRequire($this->channeltype, $post);
            if ($check){
                $this->error("{$check['title']}不能为空！");
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
            if(!empty($post['relate'])){
                $post['relate'] = implode(',',$post['relate']);
            }else{
                $post['relate'] = "";
            }
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
                'province_id'  => empty($post['province_id']) ? 0 : $post['province_id'],
                'city_id'      => empty($post['city_id']) ? 0 : $post['city_id'],
                'area_id'      => empty($post['area_id']) ? 0 : $post['area_id'],
                'show_time'      => getTime(),
            );
            $data = array_merge($post, $newData);

            $r = M('archives')->where([
                    'aid'   => $data['aid'],
                ])->update($data);
            
            if ($r) {
                // ---------后置操作
                model('Article')->afterSave($data['aid'], $data, 'edit');
                // ---------end
                adminLog('编辑文档：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功", url("Index/uphtml", ['aid'=>$data['aid'],'tid'=>$typeid,'channel'=>$this->channeltype,'controller'=>CONTROLLER_NAME,'action'=>ACTION_NAME]));
                exit;
            }

            $this->error("操作失败!");
            exit;
        }

        $assign_data = array();


        $id = input('id/d');

        $info = model('Article')->getInfo($id, null, false);
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
        $addonFieldExtList = model('Field')->getChannelFieldList($info['channel'], false, $id, $info);
//        $channelfieldBindRow = Db::name('channelfield_bind')->where([
//                'typeid'    => ['IN', [0,$typeid]],
//            ])->column('field_id');
//        if (!empty($channelfieldBindRow)) {
//            foreach ($addonFieldExtList as $key => $val) {
//                if ($val['name'] == 'city_id'){
//                    $assign_data['city_id'] = $val['dfvalue'];
//                }
//                if ($val['name'] == 'province_id'){
//                    $assign_data['province_id'] = $val['dfvalue'];
//                }
//
//
//                if (!in_array($val['id'], $channelfieldBindRow)) {
//                    unset($addonFieldExtList[$key]);
//                }
//            }
//        }
        $addonFieldExtList = convert_arr_key($addonFieldExtList,'name');
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
        $assign_data['web_region_domain'] = tpCache('web.web_region_domain');
        //经纪人信息
        if (!empty($info['relate'])){
            $relate_list = Db::name("users")->where(["id"=>["in",$info['relate']]])->select();
            $this->assign("relate_list",$relate_list);
        }
        //模型信息
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
        if (IS_POST) {
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->del();
        }
    }
    /*
     *  js打开获取楼盘列表
     */
    public function ajaxSelectHouse(){
        $channel= input('channel/d');
        $typeid = input('typeid/d');
        $keywords = input('keywords/s');
        $func = input('func/s');
        $condition = array();
        $condition['a.channel'] = $channel ? $channel : $this->channeltype;
        if ($typeid){
            $condition['a.typeid'] = $typeid;
        }
        if ($keywords){
            $condition['a.title'] =  array('LIKE', "%{$keywords}%");
        }
        $assign_data = $this->getLists($condition);
        $assign_data['func'] = $func;
        $this->assign($assign_data);

        return $this->fetch();
    }
    /**
     * 获取列表数据
     */
    private function getLists($condition){
        /*
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
        /*
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
                ->join('article_content c','a.aid = c.aid')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');

            $region = get_region_list();

            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['city'] = !empty($region[$row[$val['aid']]['city_id']]['name'])?$region[$row[$val['aid']]['city_id']]['name']:'';
                $row[$val['aid']]['area'] = !empty($region[$row[$val['aid']]['area_id']]['name'])?$region[$row[$val['aid']]['area_id']]['name']:'';
                $row[$val['aid']]['province'] =  !empty($region[$row[$val['aid']]['province_id']]['name'])?$region[$row[$val['aid']]['province_id']]['name']:'';
                $list[$key] = $row[$val['aid']];
            }

        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        return $assign_data;
    }
}