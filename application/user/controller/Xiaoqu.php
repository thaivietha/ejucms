<?php
/**
 * User: xyz
 * Date: 2019/11/8
 * Time: 11:56
 */

namespace app\user\controller;

use think\Page;
use think\Db;

class Xiaoqu extends Base
{
    // 模型标识
    public $nid = 'xiaoqu';
    // 模型ID
    public $channeltype;
    // 模型附加表
    public $table = 'Xiaoqu';
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
     * 检查小区是否存在
     */
    public function ajaxCheck(){
        $aid = input('aid/d');
        $title = input('title/s');
        $condition['channel'] = $this->channeltype;
        $condition['aid'] = $aid;
        $condition['title'] = $title;
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
        $result = $this->getLists($condition,"a.aid,a.title,a.province_id,a.city_id,a.area_id,d.lng,d.lat,d.address,c.property,d.building_age");

        return json($result['list']);
    }
    /*
     *  js打开获取楼盘列表
     */
    public function ajaxSelectHouse(){
        $channel= input('channel/d');
        $typeid = input('typeid/d');
        $keywords = input('keywords/s');
        $func = input('func/s');
        $province = input('province/d');
        $city = input('city/d');
        $area = input('area/d');
        $condition = array();
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
        $assign_data = $this->getLists($condition);
        $assign_data['func'] = $func;
        $this->assign($assign_data);

        return $this->fetch('users/xiaoqu_ajax_select_house');
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
                ->join('xiaoqu_content c','a.aid = c.aid')
                ->join('xiaoqu_system d','a.aid = d.aid')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            $region = DB::name("region")->where("level=1 or level=2")->getField("id,name");
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $row[$val['aid']]['city'] = !empty($region[$row[$val['aid']]['city_id']])?$region[$row[$val['aid']]['city_id']]:'';
                $row[$val['aid']]['area'] = !empty($region[$row[$val['aid']]['area_id']])?$region[$row[$val['aid']]['area_id']]:'';
                $row[$val['aid']]['province'] =  !empty($region[$row[$val['aid']]['province_id']])?$region[$row[$val['aid']]['province_id']]:'';
                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        return $assign_data;
    }
    public function add_ajax($post){
        /*获取第一个html类型的内容，作为文档的内容来截取SEO描述*/
        $contentField = Db::name('channelfield')->where([
            'channel_id'    => $this->channeltype,
            'dtype'         => 'htmltext',
        ])->getField('name');
        $content = input('post.addonFieldExt.'.$contentField, '', null);
        /*--end*/
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
        } else if (!empty($post['seo_description'])){
            $seo_description = $post['seo_description'];
        }
        // 外部链接跳转
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
            'is_jump'     => $is_jump,
            'is_litpic'     => $is_litpic,
            'jumplinks' => $jumplinks,
            'seo_keywords'     => '',
            'seo_description'     => $seo_description,
            'admin_id'  => '0',
            'users_id' => $this->users_id,
            'sort_order'    => 100,
            'author' => !empty($this->users['nickname']) ? $this->users['nickname'] : $this->users['username'],
            'add_time'     => !empty($post['add_time']) ? strtotime($post['add_time']):getTime(),
            'update_time'  => !empty($post['add_time']) ? strtotime($post['add_time']):getTime(),
            'province_id'  => empty($post['province_id']) ? 0 : $post['province_id'],
            'city_id'      => empty($post['city_id']) ? 0 : $post['city_id'],
            'area_id'      => empty($post['area_id']) ? 0 : $post['area_id'],
            'status' =>  1,
            'show_time'      => getTime(),
        );
        $data = array_merge($post, $newData);
        if (!empty($data['aid'])){
            unset($data['aid']);
        }
        if (!empty($data['joinaid'])){
            unset($data['joinaid']);
        }
        $aid = $this->archives_db->insertGetId($data);
        $_POST['aid'] = $aid;
        if ($aid) {
            $data['addonFieldSys']['is_houtai'] = 0;
            // ---------后置操作
            model($this->table)->afterSave($aid, $data, 'add');
            // ---------end
            adminLog('新增数据：'.$data['title']);

            // 生成静态页面代码
            return $aid;
        }

        return false;
    }
}