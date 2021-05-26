<?php
/**
 * User: xyz
 * Date: 2019/11/11
 * Time: 11:35
 */

namespace app\admin\controller;

use think\Db;

class UsersConfig extends Base
{
    /*
     * 注册设置
     */
    public function register(){
        $users_verification_list = ['不验证','后台激活','邮件验证','短信验证'];
        $info = getUsersConfigData('all');
        $assign_data = ['users_verification_list'=>$users_verification_list,'info'=>$info];
        $this->assign($assign_data);
        if (IS_POST) {
            $post = input('post.');
            if (!empty($post['users'])){
                getUsersConfigData('users', $post['users']);
            }

            $this->success('操作成功');
        }
        return $this->fetch();
    }
}