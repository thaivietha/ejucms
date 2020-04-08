<?php
/**
 * User: xyz
 * Date: 2019/11/7
 * Time: 18:29
 */

namespace app\user\controller;

use think\Page;
use think\Db;

class Ershou extends Base
{
    // 模型标识
    public $nid = 'ershou';
    // 模型ID
    public $channeltype = 0;
    // 模型附加表
    public $table = 'Ershou';

    public $type_info;
    public $archives_db;
    public function _initialize() {
        parent::_initialize();
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
        $this->type_info = Db::name("arctype")->where("current_channel={$this->channeltype} and is_del=0 and status=1")->order("id")->find();
        $this->archives_db = Db::name('archives');
    }
    /*
     * 列表
     */
    public function index(){
        $param = input('param.');
        $condition = array();
        $condition['a.is_del'] = array('eq',0);
        $condition['a.users_id'] = array('eq',$this->users_id);
        if (isset($param['keywords']) && !empty($param['keywords'])){
            $condition['a.title'] = array('LIKE', "%{$param['keywords']}%");
        }
        if (!empty($param['status']) && $param['status'] == 1){
            $condition['a.status'] = ['eq',1];
        }else if(!empty($param['status']) && $param['status'] == 2){
            $condition['a.status'] = ['eq',0];
        }
        $condition['a.typeid'] = array('eq', $this->type_info['id']);
        $condition['a.channel'] = array('eq', $this->channeltype);
        $count = $this->archives_db->alias('a')
            ->where($condition)->count('a.aid');// 查询满足要求的总记录数
        $Page = new Page($count,config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数  config('paginate.list_rows')
        $list = $this->archives_db
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');

        if ($list) {
            $aids = array_keys($list);
            $fields = "d.*,c.*,b.*, a.*, a.aid as aid";
            $row = $this->archives_db
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join("ershou_system c","a.aid = c.aid","LEFT")
                ->join("ershou_content d","a.aid = d.aid","LEFT")
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['xiaoqu_name'] = $this->archives_db->where("aid=".$row[$val['aid']]['joinaid'])->getField('title');
                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出

        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象
        $assign_data['type_info'] = $this->type_info;
        $assign_data['table'] = $this->table;
        $this->assign($assign_data);


        return $this->fetch('users/ershou_index');
    }
    public function add(){
        $permission = model('users')->getPermission($this->users,1);
        if (!$permission){
            $this->error("您已经没有操作条数", url("Ershou/index"));
        }
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$this->channeltype];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (IS_POST) {
            $post = input('post.');
            $post['tags'] = "";
            $typeid = $post['typeid'] = $this->type_info['id'];
            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }
            //判断所有必选项是否已经填写
            $field = new \app\admin\model\Field();
            $check = $field->checkChannelFieldRequire($this->channeltype, $post);
            if ($check){
                $this->error("{$check['title']}不能为空！");
            }
            //判断所有必选项是否已经填写
            $field = new \app\admin\model\Field();
            $check = $field->checkChannelFieldRequire($this->channeltype, $post);
            if ($check){
                $this->error("{$check['title']}不能为空！");
            }
            //判断是选择的小区，还是自己添加的小区，如果是自己添加的小区，得先添加小区，再添加二手房
            if (!empty($channelJoin)){
                if (!empty($post['joinaid']) && !empty($post['join_title'])){
                    $condition['a.title'] = $post['join_title'];
                    $condition['a.channel'] = $channelJoin['id'];
                    $condition['a.is_del'] = 0;
                    $join = DB::name('archives')->alias("a")->where($condition)->find();
                }
                if (empty($join) && !empty($post['join_title'])){       //不存在该关联数据
                    $join_db = new Archives();
                    $type_info = Db::name("arctype")->where("current_channel={$channelJoin['id']} and is_del=0 and status=1")->order("id")->find();
                    $aid = $join_db->add_ajax($post,$channelJoin['id'],$type_info['id'],$channelJoin['ctl_name']);
                    $join = DB::name('archives')->alias("a")->where(['a.aid'=>$aid])->find();
                }
                if (!empty($join)){
                    $post['joinaid'] = $join['aid'];
                }
            }
            if(!empty($channelOrigin['join_must']) && empty($post['joinaid'])){
                $this->error("请选择关联{$channelJoin['ntitle']}！");
            }
            /*获取第一个html类型的内容，作为文档的内容来截取SEO描述*/
            $contentField = Db::name('channelfield')->where([
                'channel_id'    => $this->channeltype,
                'dtype'         => 'htmltext',
            ])->getField('name');
            $content = input('post.addonFieldExt.'.$contentField, '', null);
            /*--end*/

            // 根据标题自动提取相关的关键字
            $seo_keywords = !empty($post['seo_keywords']) ? $post['seo_keywords'] : '';
            if (!empty($seo_keywords)) {
                $seo_keywords = str_replace('，', ',', $seo_keywords);
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
            if (empty($post['seo_description']) && !empty($content)) {
                $seo_description = @msubstr(checkStrHtml($content), 0, config('global.arc_seo_description_length'), false);
            } else {
                $seo_description = !empty($post['seo_description'])? $post['seo_description'] : '';
            }
            // 外部链接跳转
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = !empty($post['jumplinks'])? $post['jumplinks'] : '';
            }
            // --存储数据
            $newData = array(
                'typeid'=> $this->type_info['id'],
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
                'admin_id'  => '',
                'sort_order'    => 100,
                'add_time'     => getTime(),
                'update_time'  => getTime(),
                'show_time' => getTime(),
                'users_id' => $this->users_id,
                'author' => !empty($this->users['true_name']) ? $this->users['true_name'] : $this->users['nickname'],
                'province_id'  => empty($post['province_id']) ? 0 : $post['province_id'],
                'city_id'      => empty($post['city_id']) ? 0 : $post['city_id'],
                'area_id'      => empty($post['area_id']) ? 0 : $post['area_id'],
                'status' =>  !empty($this->users['check_ershou']) ? 0 : 1,
            );
            $data = array_merge($post, $newData);
            $aid = $this->archives_db->insertGetId($data);
            $_POST['aid'] = $aid;
            if ($aid) {
                // ---------后置操作
                model($this->table)->afterSave($aid, $data, 'add');
                // ---------end
                model('users')->changeContent($this->users_id,1,$aid);
                adminLog('新增数据：'.$data['title']);

                // 生成静态页面代码
                $this->success("操作成功!", url("Ershou/index"));
                exit;
            }

            $this->error("操作失败!");
            exit;
        }
        /*自定义字段*/
        $field = new \app\admin\model\Field();
        $addonFieldExtList = $field->getChannelFieldList($this->channeltype);
        $addonFieldExtList = convert_arr_key($addonFieldExtList,'name');
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = 0;
        /*获取可显示的系统字段*/
        $condition['ifcontrol'] = 0;
        $condition['channel_id'] = $this->channeltype;
        $channelfield_row = Db::name('channelfield')->where($condition)->field('name,ifeditable')->getAllWithIndex('name');
        $assign_data['channelfield_row'] = $channelfield_row;
        $assign_data['field'] = ['litpic'=>''];
        /*--end*/
        //模型信息
        if (!empty($channelJoin) && !empty($assign_data['field']['joinaid'])){
            $join = model($channelJoin['ctl_name'])->getOne("c.aid={$assign_data['field']['joinaid']}");
        }
        $assign_data['channelJoin'] = $channelJoin;
        $assign_data['join_title'] = !empty($join['title']) ? $join['title']:'';
        $assign_data['original_price'] = !empty($join['price']) ? $join['price']:'';
        $assign_data['price_units'] = !empty($join['price_units']) ? $join['price_units']:'元/㎡';
        $assign_data['searchurl'] = !empty($channelJoin['ctl_name']) ? url($channelJoin['ctl_name']."/ajaxList") : '';
        $assign_data['checkurl'] = !empty($channelJoin['ctl_name']) ? url($channelJoin['ctl_name']."/ajaxCheck") : '';

        $this->assign($assign_data);

        return $this->fetch('users/ershou_add');
    }
    /*
     * 编辑
     */
    public function edit(){
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$this->channeltype];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (IS_POST) {
            $post = input('post.');
            $post['tags'] = '';
            $typeid = $post['typeid'] = $this->type_info['id'];
            if (empty($typeid)) {
                $this->error('请选择所属栏目！');
            }
            //判断所有必选项是否已经填写
            $field = new \app\admin\model\Field();
            $check = $field->checkChannelFieldRequire($this->channeltype, $post);
            if ($check){
                $this->error("{$check['title']}不能为空！");
            }
            //判断是选择的小区，还是自己添加的小区，如果是自己添加的小区，得先添加小区，再添加二手房
            if (!empty($channelJoin)){
                if (!empty($post['joinaid']) && !empty($post['join_title'])){
                    $condition['a.title'] = $post['join_title'];
                    $condition['a.channel'] = $channelJoin['id'];
                    $condition['a.is_del'] = 0;
                    $join = DB::name('archives')->alias("a")->where($condition)->find();
                }
                if (empty($join) && !empty($post['join_title'])){       //不存在该关联数据
                    $join_db = new Archives();
                    $type_info = Db::name("arctype")->where("current_channel={$channelJoin['id']} and is_del=0 and status=1")->order("id")->find();
                    $aid = $join_db->add_ajax($post,$channelJoin['id'],$type_info['id'],$channelJoin['ctl_name']);
                    $join = DB::name('archives')->alias("a")->where(['a.aid'=>$aid])->find();
                }
                if (!empty($join)){
                    $post['joinaid'] = $join['aid'];
                }
            }
            if(!empty($channelOrigin['join_must']) && empty($post['joinaid'])){
                $this->error("请选择关联{$channelJoin['ntitle']}！");
            }
            /*获取第一个html类型的内容，作为文档的内容来截取SEO描述*/
            $contentField = Db::name('channelfield')->where([
                'channel_id'    => $this->channeltype,
                'dtype'         => 'htmltext',
            ])->getField('name');
            $content = input('post.addonFieldExt.'.$contentField, '', null);
            /*--end*/

            // 根据标题自动提取相关的关键字
            $seo_keywords = !empty($post['seo_keywords']) ? $post['seo_keywords'] : '';
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
                $seo_description = !empty($post['seo_description'])?$post['seo_description']:'';
            }
            // --外部链接
            $jumplinks = '';
            $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
            if (intval($is_jump) > 0) {
                $jumplinks = $post['jumplinks'];
            }
            // --存储数据
            $newData = array(
                'typeid'=> $this->type_info['id'],
                'channel'   => $this->channeltype,
                'is_b'      => empty($post['is_b']) ? 0 : $post['is_b'],
                'is_head'      => empty($post['is_head']) ? 0 : $post['is_head'],
                'is_special'      => empty($post['is_special']) ? 0 : $post['is_special'],
                'is_recom'      => empty($post['is_recom']) ? 0 : $post['is_recom'],
                'is_jump'   => $is_jump,
                'is_litpic'     => $is_litpic,
                'jumplinks' => $jumplinks,
                'seo_keywords'     => $seo_keywords,
                'seo_description'     => $seo_description,
                'update_time'     => getTime(),
                'author' => !empty($this->users['nickname']) ? $this->users['nickname'] : $this->users['username'],
                'province_id'  => empty($post['province_id']) ? 0 : $post['province_id'],
                'city_id'      => empty($post['city_id']) ? 0 : $post['city_id'],
                'area_id'      => empty($post['area_id']) ? 0 : $post['area_id'],
                'status' =>  !empty($this->users['check_ershou']) ? 0 : 1,
            );
            $data = array_merge($post, $newData);

            $r = Db::name('archives')->where([
                'aid'   => $data['aid'],
                'users_id' => $this->users_id
            ])->update($data);
            if ($r) {
                // ---------后置操作
                model($this->table)->afterSave($data['aid'], $data, 'edit');
                // ---------end
                adminLog('编辑二手房：'.$data['title']);
                // 生成静态页面代码
                $this->success("操作成功!", url("Ershou/index"));
                exit;
            }

            $this->error("操作失败!");
            exit;
        }
        $assign_data = array();
        $id = input('id/d');
        $info = model($this->table)->getInfo($id, null, false);
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        if ($info['users_id'] != $this->users_id){
            $this->error('您没有权限编辑别人的房源');
            exit;
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
        /*自定义字段*/
        $lng = "";
        $lat = "";
        $field = new \app\admin\model\Field();
        $addonFieldExtList = $field->getChannelFieldList($info['channel'], false, $id, $info,"content,system");

        foreach ($addonFieldExtList as $key => $val) {
            if ($val['name'] == 'lng'){
                $lng = $val['dfvalue'];
            }
            if ($val['name'] == 'lat'){
                $lat = $val['dfvalue'];
            }
        }
        if (!empty($lng) && !empty($lat)){
            $assign_data['map'] = $lng.','.$lat;
        }
        $addonFieldExtList = convert_arr_key($addonFieldExtList,'name');
        $assign_data['addonFieldExtList'] = $addonFieldExtList;
        $assign_data['aid'] = $id;

        //读取相册信息
        $photo_list = model("ershou_photo")->getListByWhere(['aid'=>$id,'is_del'=>0]);
        $assign_data['photo_list'] = $photo_list;

        //模型信息
        if (!empty($channelJoin) && !empty($assign_data['field']['joinaid'])){
            $join = model($channelJoin['ctl_name'])->getOne("c.aid={$assign_data['field']['joinaid']}");
        }
        $assign_data['channelJoin'] = $channelJoin;
        $assign_data['join_title'] = !empty($join['title']) ? $join['title']:'';
        $assign_data['original_price'] = !empty($join['price']) ? $join['price']:'';
        $assign_data['price_units'] = !empty($join['price_units']) ? $join['price_units']:'元/㎡';
        $assign_data['searchurl'] = !empty($channelJoin['ctl_name']) ? url($channelJoin['ctl_name']."/ajaxList") : '';
        $assign_data['checkurl'] = !empty($channelJoin['ctl_name']) ? url($channelJoin['ctl_name']."/ajaxCheck") : '';

        $this->assign($assign_data);

        return $this->fetch('users/ershou_edit');
    }
    /*
    * 检查关联数据是否存在
    */
    public function ajaxCheck(){
        $aid = input('aid/d',0);
        $title = input('title/s','');
        $condition['channel'] = $this->channeltype;
        $condition['aid'] = $aid;
        $condition['title'] = $title;
        $condition['is_del'] = 0;
        $data = DB::name('archives')->where($condition)->find();
        if ($data){
            $this->success("存在",'',$data);
        }else{
            $this->error("不存在");
        }
    }
    /*
     * js获取小区数据列表
     */
    public function ajaxList(){
        $channel= input('channel/d');
        $typeid = input('typeid/d');
        $keywords = input('keywords/s');
        $province = input('province/d');
        $city = input('city/d');
        $area = input('area/d');
        $condition['a.channel'] = $channel ? $channel : $this->channeltype;

        if ($typeid){
            $condition['a.typeid'] = $typeid;
        }
        if ($province){
            $condition['a.province_id'] = $province;
        }
        if ($city){
            $condition['a.city_id'] = $city;
        }
        if ($area){
            $condition['a.area_id'] = $area;
        }
        if ($keywords){
            $condition['a.title'] =  array('LIKE', "%{$keywords}%");;
        }
        $result = $this->getLists($condition);

        return json($result['list']);
    }
    /**
     * 获取列表数据
     */
    private function getLists($condition,$fields = ""){
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
            empty($fields) && $fields = "d.*,c.*,b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join('ershou_content c','a.aid = c.aid')
                ->join('ershou_system d','a.aid = d.aid')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            $region = get_region_list();
            $price_units = Db::name("channelfield")->where(['name'=>'total_price','channel_id'=>$this->channeltype])->getField("dfvalue_unit");
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['city'] = !empty($region[$row[$val['aid']]['city_id']])?$region[$row[$val['aid']]['city_id']]:'';
                $row[$val['aid']]['area'] = !empty($region[$row[$val['aid']]['area_id']])?$region[$row[$val['aid']]['area_id']]:'';
                $row[$val['aid']]['province'] =  !empty($region[$row[$val['aid']]['province_id']])?$region[$row[$val['aid']]['province_id']]:'';
                empty($row[$val['aid']]['price_units']) && $row[$val['aid']]['price_units'] = $price_units;
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
