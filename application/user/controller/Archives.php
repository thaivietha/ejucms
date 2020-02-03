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
        }
    }
    /*
     * 置顶
     */
    public function stick(){
        if (IS_POST) {
            $aid = input('aid/a');
            $type = input('type/d', 0);
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
                model('users')->changeContent($this->users_id,$type,$aid,$num);
                adminLog('置顶文档-id：'.$aid);
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }

//        $aid = input('param.id/d', 0);
//        $type = input('param.type/d', 0);
//        $assign_data['aid'] = $aid;
//        $assign_data['type'] = $type;
//        $assign_data['form_action'] = url('Archives/stick');
//        $this->assign($assign_data);
//        return $this->fetch('users/archives_stick');
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
}