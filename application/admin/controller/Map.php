<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/9
 * Time: 17:00
 */

namespace app\admin\controller;

class Map extends Base
{
    public function getLocationByAddress()
    {
        $city = input('get.city/d',0);
        $city_name = get_city_name($city);
        $address = input('get.address');
        $ak      = config('global.baidu_map_ak');
        $url = "http://api.map.baidu.com/geocoder/v2/?address={$address}&city={$city_name}&output=json&ak={$ak}";
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
    public function updateLocation()
    {
        $location = input('get.map');
        $keyword = "";
        $province = input('get.province/d',0);
        if ($province){
            $keyword .= get_province_name($province);
        }
        $city = input('get.city/d',0);
        if ($city){
            $keyword .= get_city_name($city);
        }
        $area = input('get.area/d',0);
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
        $this->assign('city',$city);
        return $this->fetch('map_mark');
    }
}