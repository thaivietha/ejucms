<?php
/**
 * User: xyz
 * Date: 2020/4/28
 * Time: 16:55
 */

namespace think\template\taglib\eju;

use think\Db;

class TagRegionview extends Base
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    public function getRegionview(){
        $ip = clientIP();
        $city = "";
        $city_str = httpRequest("https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query={$ip}&co=&resource_id=6006&oe=utf8","get");
        if ($city_str){
            $city_arr = json_decode($city_str,true);
            if ($city_arr['status'] == 0 && !empty($city_arr['data'][0] ["location"])){
                $city = $city_arr['data'][0] ["location"];
            }
        }
        $one = [];
        $where = "status=1 and domain<>''";
        if (empty($city)){
            $where .= " and is_default=1";
        }
        $list = Db::name("region")->where($where)->getAllWithIndex('id');
        foreach ($list as $key=>$val){
            if (empty($city) || strstr($city,$val['name'])){
                $val['domainurl'] = getRegionDomainUrl($val['domain']);
                $one = $val;
                break;
            }else if($val['is_default'] == 1){
                $val['domainurl'] = getRegionDomainUrl($val['domain']);
                $one = $val;
            }
        }

        return $one;
    }
}