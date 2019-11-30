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
     * 类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶）
     */
    public function changeContent($users_id,$type,$aid,$num = 1){
        $data_log = [
            'users_id' => $users_id,
            'aid' => $aid,
            'type' => $type,
            'num' => $num,
            'add_time' => getTime(),
            'update_time' => getTime()
        ];
        Db::name('users_log')->insert($data_log);
        $data = [
            'update_time'    => getTime()
        ];
        switch ($type){
            case '1':
                $data['ershou_send'] = Db::raw('ershou_send+'.$num);
                $data['all_send'] = Db::raw('all_send+'.$num);
                $data['day_ershou_send'] = Db::raw('day_ershou_send+'.$num);
                $data['day_send'] = Db::raw('day_send+'.$num);
                break;
            case '2':
                $data['ershou_top'] = Db::raw('ershou_top+'.$num);
                $data['all_top'] = Db::raw('all_top+'.$num);
                $data['day_ershou_top'] = Db::raw('day_ershou_top+'.$num);
                $data['day_top'] = Db::raw('day_top+'.$num);
                break;
            case '3':
                $data['zufang_send'] = Db::raw('zufang_send+'.$num);
                $data['all_send'] = Db::raw('all_send+'.$num);
                $data['day_zufang_send'] = Db::raw('day_zufang_send+'.$num);
                $data['day_send'] = Db::raw('day_send+'.$num);
                break;
            case '4':
                $data['zufang_top'] = Db::raw('zufang_top+'.$num);
                $data['all_top'] = Db::raw('all_top+'.$num);
                $data['day_zufang_top'] = Db::raw('day_zufang_top+'.$num);
                $data['day_top'] = Db::raw('day_top+'.$num);
                break;
        }
        Db::name("users_content")->where('users_id',$users_id)->update($data);
    }
    /*
     * 判断用户是否有仍然有权限操作1：二手发布，2：二手置顶，3：租房发布，4：租房置顶
     * param    $users  array   用户基本信息
     * param    $type   int     操作类型
     * 返回值：    true-仍然存在条数，false-条数已用完，不能继续操作
     */
    public function getPermission($users,$type,$num = 1){
        $content = $this->getContentInfo($users['users_id']);
        switch ($type){
            case '1':
            case '3':
                if ($users['free_day_send'] == 0 || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] == 0) || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] >= ($content['all_send']+$num)))
                {
                    return true;
                }
                break;
            case '2':
            case '4':
                if ($users['fee_day_top'] == 0 || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] == 0) || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] > ($content['all_top']+$num)))
                {
                    return true;
                }
                break;
        }

        return false;
    }
    /*
     * 获取当前会员基本数量使用信息
     */
    public function getContentInfo($users_id){
        $content = Db::name("users_content")->where('users_id',$users_id)->find();
        $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));

        if ($content['update_time'] < $beginToday){ //判断当天是否存在操作，如果还未操作过，把所有当天值置为0
            $data = [
                'update_time' => getTime(),
                'day_send' => 0,
                'day_ershou_send' => 0,
                'day_zufang_send' => 0,
                'day_top' => 0,
                'day_ershou_top' => 0,
                'day_zufang_top' => 0
            ];
            Db::name("users_content")->where('users_id',$users_id)->update($data);
            $content = array_merge($content,$data);
        }

        return $content;
    }


}