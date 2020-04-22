<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/12
 * Time: 15:19
 */

namespace app\home\controller;

use think\Db;

class Map extends Base
{
    public function _initialize() {
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
    }

    /**
     * @return mixed
     * 新房地图
     */
    public function index()
    {
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('xinfang_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取楼盘列表
     */
    public function getHouseLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('xinfang')->getlists($zoom, 0);
        return json($result);
    }
    /**
     * @return mixed
     * 小区地图
     */
    public function xiaoqu()
    {
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('xiaoqu_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取小区列表
     */
    public function getXiaoquLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('xiaoqu')->getlists($zoom, 0);
        return json($result);
    }
    /**
     * @return mixed
     * 二手地图
     */
    public function ershou()
    {
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('ershou_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取二手列表
     */
    public function getErshouLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('ershou')->getlists($zoom, 0);
        return json($result);
    }
    /*
     * 租房地图
     */
    public function zufang(){
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('zufang_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取租房列表
     */
    public function getZufangLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('zufang')->getlists($zoom, 0);
        return json($result);
    }
    /*
     * 商铺出售地图
     */
    public function shopcs(){
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('shopcs_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取商铺出售列表
     */
    public function getShopcsLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('shopcs')->getlists($zoom, 0);
        return json($result);
    }
    /*
    * 商铺出租地图
    */
    public function shopcz(){
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('shopcz_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取商铺出租列表
     */
    public function getShopczLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('shopcz')->getlists($zoom, 0);
        return json($result);
    }
    /*
        * 写字楼出售地图
        */
    public function officecs(){
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('officecs_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取写字楼出售列表
     */
    public function getOfficecsLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('officecs')->getlists($zoom, 0);
        return json($result);
    }
    /*
      * 写字楼出租地图
      */
    public function officecz(){
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $xinfang_content = db('officecz_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 异步获取写字楼出租列表
     */
    public function getOfficeczLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('officecz')->getlists($zoom, 0);
        return json($result);
    }









    /*
     * 全景地图
     */
    public function panorama(){
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "110.337494";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "19.984587";
        if (!empty($aid)){
            $channelid = db("archives")->where("aid=".$aid)->getField('channel');
            $table = db("channeltype")->where("id=".$channelid)->getField('table');
            $table .= "_system";
            $xinfang_content = db($table)->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    public function updateLocation()
    {
        $location = input('get.map');
        $keyword = "";
        $province = input('get.province/d',0);
        $city = input('get.city/d',0);
        $area = input('get.area/d',0);
        if ($province){
            $keyword .= get_province_name($province);
        }
        if ($city){
            $keyword .= get_city_name($city);
        }
        if ($area){
            $keyword .= get_area_name($area);
        }
        $keyword .=  input('get.keyword/s');
        $lng = 0;//'110.211023,';
        $lat = 0;//'20.007536';
        if($location && strpos($location,',')!==false)
        {
            $map = explode(',',$location);
            $lng = $map[0];
            $lat = isset($map[1]) ? $map[1] : 0;
        }
        $this->assign('lng',$lng);
        $this->assign('lat',$lat);
        $this->assign('ak',config('global.baidu_map_ak'));
        $this->assign('keyword',$keyword);
        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
        return $this->fetch('map_mark');
    }
    public function getLocationByAddress()
    {
        $province = input('get.province/d',0);
        $city = input('get.city/d',0);
        $area = input('get.area/d',0);
        $city_name = "";
        $address = "";
        if ($province){
            $address .= get_province_name($province);
        }
        if ($city){
            $city_name = get_city_name($city);
            $address .= $city_name;
        }
        if ($area){
            $address .= get_area_name($area);
        }
        $address .=  input('get.address/s');
        $ak      = config('global.baidu_map_ak');
        $url = "https://api.map.baidu.com/geocoder/v2/?address={$address}&city={$city_name}&output=json&ak={$ak}";
        $result = file_get_contents($url);
        $result = json_decode($result,true);
        $return['code'] = 0;
        if($result['status'] == 0)
        {
            $return['code'] = 1;
            $map['lng'] = $result['result']['location']['lng'];
            $map['lat'] = $result['result']['location']['lat'];
            $map['map'] = $map['lng'].','.$map['lat'];
            $return['data'] = $map;
        }
        return json($return);
    }
}