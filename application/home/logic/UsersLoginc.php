<?php
/**
 * User: xyz
 * Date: 2020/1/17
 * Time: 18:05
 */

namespace app\home\logic;


class UsersLoginc
{
// Url处理
    public function GetUrlData($param = array())
    {
        if (empty($param['users_id'])) $param['users_id'] = 0;
        $result = [];
        //经纪人详情页
        $result['arcurl'] = url('home/Agent/index', ['users_id'=>$param['users_id']], true, false, 1);
        //经纪人二手房
        $result['ershouurl'] = url('home/Agent/ershou', ['users_id'=>$param['users_id']], true, false, 1);
        //经纪人租房
        $result['zufangurl'] = url('home/Agent/zufang', ['users_id'=>$param['users_id']], true, false, 1);
        //经纪人商铺出售
        $result['shopcsurl'] = url('home/Agent/shopcs', ['users_id'=>$param['users_id']], true, false, 1);
        //经纪人商铺出租
        $result['shopczurl'] = url('home/Agent/shopcz', ['users_id'=>$param['users_id']], true, false, 1);
        //经纪人写字楼出售
        $result['officecsurl'] = url('home/Agent/officecs', ['users_id'=>$param['users_id']], true, false, 1);
        //经纪人写字楼出租
        $result['officeczurl'] = url('home/Agent/officecz', ['users_id'=>$param['users_id']], true, false, 1);

        return $result;
    }
}