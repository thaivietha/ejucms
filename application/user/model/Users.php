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
     * 发布、置顶变更用户权限使用情况
     * $users    用户信息
     * 类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶，5：商铺出售发布，6：商铺出售置顶，7：商铺出租发布，8：商铺出租置顶，9：写字楼出售发布，10：写字楼出售置顶，11：写字楼出租发布，12：写字楼出租置顶,,13:求租发布，14：求租置顶）
     *$aid          房源id
     * $num         操作数量
     *$paynum       付费数量
     */
    public function changeContent($users,$type,$aid,$num = 1,$paynum = 0){
        is_array($aid) && $aid = implode(',',$aid);
        $freenum = $num - $paynum;
        $data_log = [
            'users_id' => $users['users_id'],
            'aid' => $aid,
            'type' => $type,
            'num' => $num,
            'add_time' => getTime(),
            'update_time' => getTime()
        ];
        $have = Db::name("users_count")->where(['users_id'=>$users['users_id'],'type'=>$type])->find();
        if ($have){
            Db::name("users_count")->where(['users_id'=>$users['users_id'],'type'=>$type])->setInc("num",$num);
        }else{
            $time = getTime();
            $data_count = [
                [
                    'users_id' =>$users['users_id'],
                    'type' =>$type,
                    'style' =>1,
                    'num' =>1,
                    'add_time' =>$time,
                    'update_time' =>$time
                ],
                [
                    'users_id' =>$users['users_id'],
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
        if (intval($type)%2==0){   //置顶
            $data_content['all_top'] = Db::raw('all_top+'.$num);
            $data_content['day_top'] = Db::raw('day_top+'.$num);
            $data_content['free_all_top'] = Db::raw('free_all_top+'.$freenum);
            $data_content['free_day_top'] = Db::raw('free_day_top+'.$freenum);
        }else{      //发布
            $data_content['all_send'] = Db::raw('all_send+'.$num);
            $data_content['day_send'] = Db::raw('day_send+'.$num);
            $data_content['free_all_send'] = Db::raw('free_all_send+'.$freenum);
            $data_content['free_day_sand'] = Db::raw('free_day_sand+'.$freenum);
        }
        Db::name("users_content")->where('users_id',$users['users_id'])->update($data_content);
        if ($paynum > 0){      //需要付费，减去相应余额
            if (intval($type)%2==0) {   //判断置顶
                $pay_money = $paynum * $users['fee_top'];
            }else{      //判断发布
                $pay_money = $paynum * $users['fee_send'];
            }
            if ($pay_money){
                $data_users_money['users_money'] = Db::raw('users_money-'.$pay_money);
                Db::name("users")->where("id=".$users['users_id'])->update($data_users_money);
            }
        }
    }
    /*
     * 判断免费剩余是否充裕
     * $users   用户基本信息 --- 包括level信息
     * $content 用户数量统计信息
     *$type     操作类型
     * $num     数量
     * return   返回需要额外付费使用的剩余条数，小于|等于0表示不需要额外付费，大于0需要额外付费
     */
    public function checkFree($users,$content,$type,$num = 1){
        $result = 0;
        if (intval($type)%2==0){   //判断置顶
            $free_day_top = $users['fee_day_top'] - $content['free_day_top'];  //当日剩余免费
            $free_all_top = $users['fee_all_top'] - $content['free_all_top'];  //全部剩余免费
            if ($users['fee_day_top'] == -1 && $users['fee_all_top'] == -1){   //不限制每天和全部免费免费置顶数量
                return 0;
            }else if($users['fee_day_top'] == -1){   //不限制每天免费置顶数量
                if($free_all_top >= $num){
                    return 0;
                }
                $result = $num - $free_all_top;
            }else if($users['fee_all_top'] == -1){    //不限制全部免费置顶数量
                if($free_day_top >= $num){
                    return 0;
                }
                $result = $num - $free_day_top;
            }else{      //每天和全部免费都是限制个数的
                $result = $free_all_top > $free_day_top ? $num - $free_day_top : $num - $free_all_top;
            }
        }else{      //判断发布
            $free_day_sand = $users['free_day_send'] - $content['free_day_sand'];  //当日剩余免费
            $free_all_send = $users['free_all_send'] - $content['free_all_send'];  //全部剩余免费
            if ($users['free_day_send'] == -1 && $users['free_all_send'] == -1){   //不限制每天和全部免费免费置顶数量
                return 0;
            }else if($users['free_day_send'] == -1){   //不限制每天免费置顶数量
                if($free_all_send >= $num){
                    return 0;
                }
                $result = $num - $free_all_send;
            }else if($users['free_all_send'] == -1){    //不限制全部免费置顶数量
                if($free_day_sand >= $num){
                    return 0;
                }
                $result = $num - $free_day_sand;
            }else{      //每天和全部免费都是限制个数的
                $result = $free_all_send > $free_day_sand ? $num - $free_day_sand : $num - $free_all_send;
            }
        }

        return $result;
    }
    /*
     * 判断余额是否充足，可以支撑操作
     * $users   用户基本信息 --- 包括level信息
     * $type     操作类型
     * $num     付费数量
     * return   返回true表示足够支付，false表示余额不足
     */
    public function checkMoney($users,$type,$num = 1){
        $users_money = $users['users_money']; //Db::name("users")->where("id=".$users['users_id'])->getField("users_money");
        $pay_money = 0;
        if (intval($type)%2==0) {   //判断置顶
            $pay_money = $num * $users['fee_top'];
        }else{      //判断发布
            $pay_money = $num * $users['fee_send'];
        }
        if ($users_money < $pay_money){
            return false;
        }

        return true;
    }
    /*
     * 判断用户是否有仍然有权限操作
     * param    $users  array   用户基本信息
     * param    $type   int     操作类型,1：二手发布，2：二手置顶，3：租房发布，4：租房置顶
     * 返回值：    true-可以操作，false-不能继续操作
     */
    public function getPermission($users,$type,$num = 1){
        $content = $this->getContentInfo($users['users_id']);
        $fee_num = $this->checkFree($users,$content,$type,$num);  //获取需要付费的条数
        if ($fee_num <= 0){  //不需要额外支付
            return [true,0];
        }
        if (intval($type)%2==0){   //判断置顶
            if ($fee_num > 0 && $users['fee_top'] == -1){   //不允许付费置顶
                return false;
            }
        }else{      //判断发布
            if ($fee_num > 0 && $users['fee_send'] == -1){   //不允许付费发布
                return false;
            }
        }
        if (!$this->checkMoney($users,$type,$fee_num)){
            return false;
        }
        return [true,$fee_num];
    }
    public function getPermission_old($users,$type,$num = 1){
        $content = $this->getContentInfo($users['users_id']);
        if (intval($type)%2==0){   //判断置顶
            if ($users['fee_day_top'] == 0 || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] == 0) || ($users['fee_day_top'] >= ($content['day_top']+$num) && $users['fee_all_top'] > ($content['all_top']+$num)))
            {
                return true;
            }
        }else{      //判断发布
            if ($users['free_day_send'] == 0 || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] == 0) || ($users['free_day_send'] >= ($content['day_send']+$num) && $users['free_all_send'] >= ($content['all_send']+$num)))
            {
                return true;
            }
        }

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
                'free_day_sand' => 0,
                'free_day_top' => 0,
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