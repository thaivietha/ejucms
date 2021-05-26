<?php
/**
 * User: xyz
 * Date: 2020/2/7
 * Time: 8:59
 */

namespace app\home\controller;


class Tool extends Base
{
    public function _initialize() {
        parent::_initialize();
    }
    //房贷计算器
    public function jisuanqi(){
        return $this->fetch();
    }
    //电话号码
    public function bohao(){
        $aid = input('aid/d',0);
        if (!is_numeric($aid) || strval(intval($aid)) !== strval($aid)) {
            abort(404,'页面不存在');
        }
        $aid = intval($aid);
        $where = [
            'a.aid'     => $aid,
            'a.is_del'      => 0,
        ];
        $archivesInfo = M('archives')->field('a.typeid, a.channel,a.status,a.users_id, b.nid, b.ctl_name,a.aid as aid,a.province_id as province_id,a.city_id as city_id,a.area_id as area_id')
            ->alias('a')
            ->join('__CHANNELTYPE__ b', 'a.channel = b.id', 'LEFT')
            ->where($where)
            ->find();
        if (empty($archivesInfo)) {
            abort(404,'页面不存在');
        }
        $modelName = $archivesInfo['ctl_name'];
        $result = model($modelName)->getInfo($aid);
//        var_dump($result);die();
        $this->assign("field",$result);


        return $this->fetch();
    }
}