<?php
/**
 * User: xyz
 * Date: 2019/11/8
 * Time: 10:48
 */

namespace app\user\controller;

use think\Db;

class Archives extends Base
{
    public function _initialize() {
        parent::_initialize();
    }
    /**
     * 删除文档
     */
    public function del()
    {
        if (IS_POST) {
            $tid = input('tid/d',0);
            $del_id = input('del_id/a');
            $id_arr = eyIntval($del_id);
            $have = db('archives')->where([
                'aid' => ['IN', $id_arr],
                'users_id' => ['neq',$this->users_id]
            ])->find();
            if ($have){
                $this->error('不允许删除其他人的信息！');
            }
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->del();
            del_archives_chache($del_id);
            if (!empty($tid)){
                del_type_chache([$tid]);
            }
        }
    }
    /*
     * 置顶
     */
    public function stick(){
        if (IS_POST) {
            $aid = input('stick_id/a');
            $type = input('type/d', 0);
            $tid = input('tid/d',0);
            $num = 1;//input('num/d');
            if (empty($type) || empty($aid)) {
                $this->error('置顶失败！');
            } else if (empty($num)) {
                $this->error('至少置顶一天！');
            }
            $count = count($aid);
            $permission = model('users')->getPermission($this->users,$type,$count);
            if (!$permission){
                $this->error("您剩余操作条数不够");
            }

            $to_time = $num * 24 * 60 * 60 + getTime();
            $data = [
                'show_time' => $to_time,
                'update_time' => getTime()
            ];
            $r = Db::name('archives')->where([
                'aid'   => ['IN',$aid],
                'users_id' => $this->users_id
            ])->update($data);
            if($r){
                model('users')->changeContent($this->users_id,$type,$aid,$count);
                adminLog('置顶文档-id：'.$aid);
                del_archives_chache($aid);
                if (!empty($tid)){
                    del_type_chache([$tid]);
                }
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }
    }
    /*
     * 获取region
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
    //添加对应模型数据
    public function add_ajax($post,$channeltype,$typeid,$table){
        /*获取第一个html类型的内容，作为文档的内容来截取SEO描述*/
        $contentField = Db::name('channelfield')->where([
            'channel_id'    => $channeltype,
            'dtype'         => 'htmltext',
        ])->getField('name');
        $content = input('post.addonFieldExt.'.$contentField, '', null);
        /*--end*/
        if (!empty($post['join_title'])){
            $post['title'] = $post['join_title'];
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
        } else if (!empty($post['seo_description'])){
            $seo_description = $post['seo_description'];
        }
        // 外部链接跳转
        $jumplinks = '';
        $is_jump = isset($post['is_jump']) ? $post['is_jump'] : 0;
        if (intval($is_jump) > 0) {
            $jumplinks = $post['jumplinks'];
        }
        $post['addonFieldExt']['content'] = htmlspecialchars(strip_sql($content));
        // --存储数据
        $newData = array(
            'typeid'=> $typeid,
            'channel'   => $channeltype,
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
            'author' => !empty($this->users['true_name']) ? $this->users['true_name'] : $this->users['nickname'],
            'add_time'     => !empty($post['add_time']) ? strtotime($post['add_time']):getTime(),
            'update_time'  => !empty($post['add_time']) ? strtotime($post['add_time']):getTime(),
            'province_id'  => empty($post['province_id']) ? 0 : $post['province_id'],
            'city_id'      => empty($post['city_id']) ? 0 : $post['city_id'],
            'area_id'      => empty($post['area_id']) ? 0 : $post['area_id'],
            'status' =>  1,
            'show_time'      => getTime(),
            'add_type'      => 0,
        );
        $data = array_merge($post, $newData);
        if (!empty($data['aid'])){
            unset($data['aid']);
        }
        if (!empty($data['joinaid'])){
            unset($data['joinaid']);
        }
        $aid = Db::name('archives')->insertGetId($data);
        $_POST['aid'] = $aid;
        if ($aid) {
//            $data['addonFieldExt'] = [];
//            $data['addonFieldSys'] = [];
            // ---------后置操作
            model($table)->afterSave($aid, $data, 'add');
            // ---------end
            adminLog('新增数据：'.$data['title']);

            // 生成静态页面代码
            return $aid;
        }

        return false;
    }
}