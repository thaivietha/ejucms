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
            $archivesLogic = new \app\admin\logic\ArchivesLogic;
            $archivesLogic->del();
        }
    }
    /*
     * 置顶
     */
    public function stick(){
        if (IS_POST) {
            $aid = input('post.aid/d');
            $type = input('param.type/d', 0);
            $num = input('post.num/d');
            $permission = model('users')->getPermission($this->users,2,$num);
            if (!$permission){
                $this->error("您剩余操作条数不够", url("Ershou/index"));
            }
            if (empty($type) || empty($aid)) {
                $this->error('置顶失败！');
            } else if (empty($num)) {
                $this->error('至少置顶一天！');
            }
            $to_time = $num * 24 * 60 * 60 + getTime();
            $data = [
                'show_time' => $to_time,
                'update_time' => getTime()
            ];
            $r = Db::name('archives')->where([
                'aid'   => $aid,
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

        $aid = input('param.id/d', 0);
        $type = input('param.type/d', 0);
        $assign_data['aid'] = $aid;
        $assign_data['type'] = $type;
        $assign_data['form_action'] = url('Archives/stick');
        $this->assign($assign_data);
        return $this->fetch('users/archives_stick');
    }
}