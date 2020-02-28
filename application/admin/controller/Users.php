<?php
/**
 * User: xyz
 * Date: 2019/10/31
 * Time: 15:40
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Users extends Base
{
    /*
     * 会员列表
     */
    public function index(){
        $keywords = input('keywords/s');
        $condition = array();
        $condition['level_id'] = 1;
        if (!empty($keywords)) {
            $condition['user_name'] = array('LIKE', "%{$keywords}%");
        }
        $users =  M('Users');
        $count = $users->where($condition)->count('id');// 查询满足要求的总记录数
        $Page = $pager = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $users->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $level_list = Db::name("users_level")->where("is_del = 0")->getField('id,level_name');
        foreach ($list as $key=>$val){
            $list[$key]['level_name'] = $level_list[$val['level_id']];
        }
        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象

        return $this->fetch();
    }
    /*
     * 经纪人列表
     */
    public function saleman_list(){
        $keywords = input('keywords/s');
        $condition = array();
        $condition['level_id'] = ['neq',1];
        if (!empty($keywords)) {
            $condition['user_name'] = array('LIKE', "%{$keywords}%");
        }
        $users =  M('Users');
        $count = $users->where($condition)->count('id');// 查询满足要求的总记录数
        $Page = $pager = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $users->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $level_list = Db::name("users_level")->where("is_del = 0")->getField('id,level_name');
        foreach ($list as $key=>$val){
            $list[$key]['level_name'] = $level_list[$val['level_id']];
        }
        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象

        return $this->fetch();
    }
    /*
     *  添加会员
     */
    public function add(){
        if (IS_POST) {
            $post = input('post.');
            $user = new \app\common\model\Users();
            if ($user_info = $user::check_update($post['username'],$post['mobile'],$post['email'])){
                if ($user_info['mobile'] == $post['mobile']){
                    $this->error("操作失败，手机号码{$post['mobile']}已被注册");
                }else if($user_info['username'] == $post['username']){
                    $this->error("操作失败，用户名{$post['username']}已被注册");
                }else{
                    $this->error("操作失败，邮箱{$post['email']}已被注册");
                }
            }
            if ($post['password'] != $post['verify_password']){
                $this->error("两次密码输入不一致，请重新输入");
            }
            $post['password'] = func_encrypt($post['password']);
            !empty($post['users_label']) && $post['users_label'] = implode(',',$post['users_label']);
            !empty($post['service_area']) && $post['service_area'] = implode(',',$post['service_area']);
            !empty($post['service_xiaoqu']) && $post['service_xiaoqu'] = implode(',',$post['service_xiaoqu']);
            // --存储数据
            $nowData = array(
                'add_time'    => getTime(),
                'update_time'    => getTime(),
            );
            $data = array_merge($post, $nowData);
            $insertId = $user->insertGetId($data);
            if (false !== $insertId) {
                $data_content = [
                    'users_id'=>$insertId,
                    'add_time'    => getTime(),
                    'update_time'    => getTime()
                ];
                $data_content = array_merge($post, $data_content);
                Db::name("users_content")->insertGetId($data_content);
                adminLog('新增会员：'.$post['user_name']);
                if (!empty($post['back'])){
                    $url = 'Users/'.$post['back'];
                }else{
                    $url = "Users/index";
                }
                $this->success("操作成功", url($url));
            }else{
                $this->error("操作失败");
            }
            exit;
        }

        $back = input('back/s');
        if (!empty($back) && $back == "saleman_list"){
            $where = "is_del=0 and id>1";
        }else{
            $where = "is_del=0 and id=1";
        }
        $level_list = Db::name("users_level")->where($where)->getField("id,level_name");
        $this->assign('level_list',$level_list);
        $users_label_value = getUsersConfigData('users.users_label_value');
        $users_label_list = explode(",",$users_label_value);
        $this->assign('users_label_list',$users_label_list);
        return $this->fetch();
    }
    /*
     * 编辑会员
     */
    public function edit(){
        if (IS_POST) {
            $post = input('post.');
            $r = false;
            if(!empty($post['id'])){
                $post['id'] = intval($post['id']);
                $user = new \app\common\model\Users();
                if ($user_info = $user::check_update($post['username'],$post['mobile'],$post['email'],$post['id'])){
                    if ($user_info['mobile'] == $post['mobile']){
                        $this->error("操作失败，手机号码{$post['mobile']}已被注册");
                    }else if($user_info['username'] == $post['username']){
                        $this->error("操作失败，用户名{$post['username']}已被注册");
                    }else{
                        $this->error("操作失败，邮箱{$post['email']}已被注册");
                    }
                }
                if (empty($post['password'])){
                    unset($post['password']);
                }else{
                    $post['password'] = func_encrypt($post['password']);
                }
                $users_label = implode(',',$post['users_label']);
                $service_area = implode(',',$post['service_area']);
                $service_xiaoqu = implode(',',$post['service_xiaoqu']);
                $post['users_label'] = !empty($users_label) ? $users_label : '';
                $post['service_area'] = !empty($service_area) ? $service_area : '';
                $post['service_xiaoqu'] = !empty($service_xiaoqu) ? $service_xiaoqu : '';
                $nowData = array('update_time'    => getTime());
                $data = array_merge($post, $nowData);
                $r = Db::name('users')->where(['id'    => $post['id']])->update($data);
            }
            if (!empty($post['back'])){
                $url = 'Users/'.$post['back'];
            }else{
                $url = "Users/index";
            }
            if (false !== $r) {
                Db::name("users_content")->where(['users_id'=> $post['id']])->update($data);
                adminLog('编辑会员：'.$post['users_name']);
                $this->success("操作成功",url($url));
            }else{
                $this->error("操作失败",url($url));
            }
            exit;
        }
        $id = input('id/d');
        $back = input('back/s');
        $info = Db::name('users')->alias('a')->join("users_content b","a.id=b.users_id","left")->where(['a.id'    => $id])->find();
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        $info['users_label'] = explode(",", $info['users_label']);
        if (!empty($info['service_area'])){
            $service_area_list = Db::name("region")->where(["id"=>["in",$info['service_area']]])->select();
            $this->assign("service_area_list",$service_area_list);
        }
        if (!empty($info['service_xiaoqu'])){
            $service_xiaoqu_list = Db::name("archives")->where(["aid"=>["in",$info['service_xiaoqu']]])->select();
            $this->assign("service_xiaoqu_list",$service_xiaoqu_list);
        }
        $info['litpic'] = handle_subdir_pic($info['litpic']);
        $this->assign('info',$info);
        if (!empty($back) && $back == "saleman_list"){
            $where = "is_del=0 and id>1";
        }else{
            $where = "is_del=0 and id=1";
        }
        $level_list = Db::name("users_level")->where($where)->getField("id,level_name");
        $this->assign('level_list',$level_list);
        $users_label_value = getUsersConfigData('users.users_label_value');
        $users_label_list = explode(",",$users_label_value);
        $this->assign('users_label_list',$users_label_list);
        return $this->fetch();
    }
    /**
     * 删除会员
     */
    public function del()
    {
        if (IS_POST) {
            $id_arr = input('del_id/a');
            $thorough = input('thorough/d');
            if (empty($id_arr)){
                $this->error('参数有误');
            }
            $id_arr = eyIntval($id_arr);
            if ($thorough){
                $result = Db::name('users')->field('username')->where(['id'    => ['IN', $id_arr]])->select();
                $title_list = get_arr_column($result, 'username');
                $r = Db::name('users')->where(['id'=> ['IN', $id_arr]])->delete();
                if($r){
                    Db::name('users_content')->where(['users_id'=> ['IN', $id_arr]])->delete();
                    adminLog('删除会员：'.implode(',', $title_list));
                    $this->success('删除成功');
                }else{
                    $this->error('删除失败');
                }
            }else{
                $r = Db::name('users')->where(['id'=> ['IN', $id_arr]])->update(['is_del'=>1]);
                if($r){
                    $this->success('删除成功');
                }else{
                    $this->error('删除失败');
                }
            }
        }
        $this->error('非法访问');
    }

}