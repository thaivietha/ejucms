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
        $id = intval($id);
        $where = "mobile='$mobile'";
        if (!empty($username)){
            $where .= " or username='$username'";
        }
        if (!empty($email)){
            $where .= " or email='$email'";
        }
        $where = "(".$where.")";
        if (!empty($id)){
            $where .= " and id<>$id";
        }
        $have = self::where($where)->find();

        return $have;
    }
    /*
     * 获取全部置业人员列表
     */
    public static function get_list($is_saleman = 0,$id = 0){
        $id = intval($id);
        if ($is_saleman && !empty($id)){
            $where = "is_del=0 and status=1 and (is_saleman=1 or id={$id})";
        }else if ($is_saleman){
            $where = "is_del=0 and status=1 and is_saleman=1";
        }else if (!empty($id)){
            $where = "is_del=0 and status=1 and id={$id}";
        }else{
            $where = "is_del=0 and status=1";
        }
        $result =self::field('id,username,true_name,mobile')
            ->where($where)
            ->getAllWithIndex('id');

        return $result;
    }

}