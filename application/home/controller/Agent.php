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
        $web_region_domain = config('ey_config.web_region_domain');  //是否开启子域名
        $web_mobile_domain = config('ey_config.web_mobile_domain');    //手机子域名
        $web_main_domain = tpCache('web.web_main_domain');   //主域名
        $subDomain = input('param.subdomain/s','');
        empty($subDomain) && $subDomain = request()->subDomain();
        //判断是否为合法的二级域名
        if($web_region_domain && $subDomain != $web_mobile_domain && $subDomain != $web_main_domain ){
            $have = false;
            $region_list = get_region_list();
            foreach ($region_list as $val){
                if ($subDomain == $val['domain']){
                    $have = true;
                    break;
                }
            }
            if (!$have){
                abort(404,'页面不存在');
            }
        }
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
            $service_xiaoqu_list = Db::name("archives") ->field("b.*, a.*")
                ->alias('a')
                ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
                ->where(["a.aid"=>["in",$service_xiaoqu_arr]])
                ->select();
//                ->getAllWithIndex('aid');
            foreach ($service_xiaoqu_list as $k=>$v){
                if (in_array($v['aid'],$service_xiaoqu_arr)){
                    $v['arcurl'] =  arcurl('home/Xiaoqu/view', $v,true,false,'',null);
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
    //自定义栏目列表
    public function custom(){
        $dirname = input('dirname/s',"");


        return $this->fetch($dirname);
    }
}








