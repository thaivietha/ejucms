<?php

namespace app\user\model;

use think\Model;
use think\Config;
use think\Db;
/**
 * 会员
 */
class Users extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }
    /*
     * 变更用户权限使用情况
     * 类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶，5：商铺出售发布，6：商铺出售置顶，7：商铺出租发布，8：商铺出租置顶，9：写字楼出售发布，10：写字楼出售置顶，11：写字楼出租发布，12：写字楼出租置顶）
     */
    public function changeContent($users_id,$type,$aid,$num = 1){
        is_array($aid) && $aid = implode(',',$aid);
        $data_log = [
            'users_id' => $users_id,
            'aid' => $aid,
            'type' => $type,
            'num' => $num,
            'add_time' => getTime(),
            'update_time' => getTime()
        ];
        $have = Db::name("users_count")->where(['users_id'=>$users_id,'type'=>$type])->find();
        if ($have){
            Db::name("users_count")->where(['users_id'=>$users_id,'type'=>$type])->setInc("num",$num);
        }else{
            $time = getTime();
            $data_count = [
                [
                    'users_id' =>$users_id,
                    'type' =>$type,
                    'style' =>1,
                    'num' =>1,
                    'add_time' =>$time,
                    'update_time' =>$time
                ],
                [
                    'users_id' =>$users_id,
                    'type' =>$type,
                    'style' =>2,
                    'num' =>1,
                    'add_time' =>$time,
                    'update_time' =>$time
                ]
            ];
            Db::name("users_count")->insertAll($data_count);
        }
        Db::name('users_log')->insert($data_log);
        $data_content = [
            'update_time'    => getTime(),
            'last_time'    => getTime(),
        ];
        if (intval($type)%2==0){
            $data_content['all_top'] = Db::raw('all_top+'.$num);
            $data_content['day_top'] = Db::raw('day_top+'.$num);
        }else{
            $data_content['all_send'] = Db::raw('all_send+'.$num);
            $data_content['day_send'] = Db::raw('day_send+'.$num);
        }
//        switch ($type){
//            case '1':
//            case '3':
//            case '5':
//            case '7':
//            case '9':
//            case '11':
//            case '13':
//                $data_content['all_send'] = Db::raw('all_send+'.$num);
//                $data_content['day_send'] = Db::raw('day_send+'.$num);
//                break;
//            case '2':
//            case '4':
//            case '6':
//            case '8':
//            case '10':
//            case '12':
//            case '14':
//                $data_content['all_top'] = Db::raw('all_top+'.$num);
//                $data_content['day_top'] = Db::raw('day_top+'.$num);
//                break;
//        }
        Db::name("users_content")->where('users_id',$users_id)->update($data_content);
    }
    /*
     * 判断用户是否有仍然有权限操作1：二手发布，2：二手置顶，3：租房发布，4：租房置顶
     * param    $users  array   用户基本信息
     * param    $type   int     操作类型
     * 返回值：    true-仍然存在条数，false-条数已用完，不能继续操作
     */
    public function getPermission($users,$type,$num = 1){
        $content = $this->getContentInfo($users['users_id']);
        if (intval($type)%2==0){
            if ($users['fee_day_top'] == 0 || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] == 0) || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] > ($content['all_top']+$num)))
            {
                return true;
            }
        }else{
            if ($users['free_day_send'] == 0 || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] == 0) || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] >= ($content['all_send']+$num)))
            {
                return true;
            }
        }
//        switch ($type){
//            case '1':
//            case '3':
//            case '5':
//            case '7':
//            case '9':
//            case '11':
//            case '13':
//                if ($users['free_day_send'] == 0 || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] == 0) || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] >= ($content['all_send']+$num)))
//                {
//                    return true;
//                }
//                break;
//            case '2':
//            case '4':
//            case '6':
//            case '8':
//            case '10':
//            case '12':
//            case '14':
//                if ($users['fee_day_top'] == 0 || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] == 0) || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] > ($content['all_top']+$num)))
//                {
//                    return true;
//                }
//                break;
//        }

        return false;
    }
    /*
     * 获取当前会员基本数量使用信息（并初始化）
     */
    public function getContentInfo($users_id){
        $content = Db::name("users_content")->where('users_id',$users_id)->find();
        $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
        if ($content['last_time'] < $beginToday){ //判断当天是否存在操作，如果还未操作过，把所有当天值置为0
            $data_content = [
                'update_time' => getTime(),
                'last_time' => getTime(),
                'day_send' => 0,
                'day_top' => 0,
            ];
            Db::name("users_count")->where(["users_id"=>$users_id,'style'=>1])->update(['num'=>0]);
            Db::name("users_content")->where('users_id',$users_id)->update($data_content);
            $content = array_merge($content,$data_content);
        }

        return $content;
    }
    /*
     * 获取各个种类基本信息使用情况
     */
    public function getCountInfo($users_id){
        $result = [];
        $list = Db::name("users_count")->where(["users_id"=>$users_id])->select();
        foreach ($list as $key=>$val){
            if (empty($result[$val['style']])){
                $result[$val['style']] = [];
            }
            if (empty($result[$val['style']][$val['type']])){
                $result[$val['style']][$val['type']] = $val;
            }
        }

        return $result;
    }

}