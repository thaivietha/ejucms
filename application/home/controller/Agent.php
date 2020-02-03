<?php
/**
 * User: xyz
 * Date: 2020/1/17
 * Time: 17:10
 */

namespace app\home\controller;

use think\Db;
use think\Config;
use app\home\logic\UsersLoginc;

class Agent extends Base
{
    public $field;
    public $users_id;
    public function _initialize()
    {
        parent::_initialize();
        $this->UsersLoginc = new UsersLoginc();
        $this->users_id = input('users_id/d',0);
        $result = Db::name('users')
            ->field("c.*,b.*, a.*")
            ->alias('a')
            ->join('users_content b', 'a.id = b.users_id', 'LEFT')
            ->join('users_level c','a.level_id=c.id','LEFT')
            ->where(['a.id'=>['eq',$this->users_id]])
            ->find();
        //主营区域数组化
        $service_area = [];
        $region_list = get_info_list('region','id','status=1');
        if (!empty($result['service_area'])){
            $service_area_arr = explode(',',$result['service_area']);
            foreach ($region_list as $k=>$v){
                if (in_array($k,$service_area_arr)){
                    $service_area[] = $v;
                }
            }
        }
        $result['service_area'] = $service_area;
        //主营小区数组化
        $service_xiaoqu = [];
        if (!empty($result['service_xiaoqu'])){
            $service_xiaoqu_arr = explode(',',$result['service_xiaoqu']);
            $service_xiaoqu_list = Db::name("archives")->where(["aid"=>["in",$service_xiaoqu_arr]])->getAllWithIndex('aid');
            foreach ($service_xiaoqu_list as $k=>$v){
                if (in_array($k,$service_xiaoqu_arr)){
                    $v['arcurl'] =  arcurl('home/Xiaoqu/view', $v);
                    $service_xiaoqu[] = $v;
                }
            }
        }
        $result['service_xiaoqu'] = $service_xiaoqu;
        //内页路由
        $resultUrl = $this->UsersLoginc->GetUrlData(['users_id'=>$result['id']]);
        $this->field = array_merge($resultUrl,$result);

        $param = input('param.');
        $eju = array(
            'field' => $this->field,
            'get' => $param
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);
    }
    //经纪人详情页
    public function index(){
        return $this->fetch();
    }
    //二手房列表
    public function ershou(){
        return $this->fetch();
    }
    //租房列表
    public function zufang(){
        return $this->fetch();
    }
    //商铺出售列表
    public function shopcs(){
        return $this->fetch();
    }
    //商铺出租列表
    public function shopcz(){
        return $this->fetch();
    }
    //写字楼出售列表
    public function officecs(){
        return $this->fetch();
    }
    //写字楼出租列表
    public function officecz(){
        return $this->fetch();
    }
}