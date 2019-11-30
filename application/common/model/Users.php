<?php
/**
 * User: xyz
 * Date: 2019/10/31
 * Time: 15:54
 */

namespace app\common\model;

use think\Model;

class Users extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }
    /*
     * 检测手机号码是否被占用,插入数据时不需要传入id值
     * 返回值：true已存在，false不存在
     */
    public static function check_mobile($mobile,$id = 0){
        $where['mobile'] = ['eq',$mobile];
        if ($id){
            $where['id'] = ['neq',$id];
        }
        $have = self::where($where)->find();

        return $have;
    }
    /*
     * 检测邮箱是否被占用,插入数据时不需要传入id值
     * 返回值：true已存在，false不存在
     */
    public static function check_email($email,$id = 0){
        $where['email'] = ['eq',$email];
        if ($id){
            $where['id'] = ['neq',$id];
        }
        $have = self::where($where)->find();

        return $have;
    }
    /*
     * 检测手机号码和邮箱是否已经被占用
     */
    public static function check_update($username,$mobile,$email,$id = 0){
        $where = "mobile='$mobile'";
        if (!empty($username)){
            $where .= " or username='$username'";
        }
        if (!empty($email)){
            $where .= " or email='$email'";
        }
        $where = "(".$where.")";
        if ($id){
            $where .= " and id<>$id";
        }
        $have = self::where($where)->find();

        return $have;
    }
}