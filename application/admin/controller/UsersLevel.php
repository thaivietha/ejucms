<?php
/**
 * User: xyz
 * Date: 2019/10/31
 * Time: 15:46
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class UsersLevel extends Base
{
    /*
     * 会员级别列表
     */
    public function index(){
        $keywords = input('keywords/s');
        $condition = array();
        if (!empty($keywords)) {
            $condition['level_name'] = array('LIKE', "%{$keywords}%");
        }
        $userCate =  M('users_level');
        $count = $userCate->where($condition)->count('id');// 查询满足要求的总记录数
        $Page = $pager = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $userCate->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象
        return $this->fetch();
    }
    /*
     * 添加会员级别
     */
    public function add(){
        if (IS_POST) {
            $post = input('post.');
            // --存储数据
            $nowData = array(
                'add_time'    => getTime(),
                'update_time'    => getTime(),
            );
            $data = array_merge($post, $nowData);
            $insertId = M('UsersLevel')->insertGetId($data);
            if (false !== $insertId) {
                adminLog('新增会员级别：'.$post['level_name']);
                $this->success("操作成功", url('UsersLevel/index'));
            }else{
                $this->error("操作失败", url('UsersLevel/index'));
            }
            exit;
        }

        return $this->fetch();
    }
    /*
     * 编辑会员级别
     */
    public function edit(){
        if (IS_POST) {
            $post = input('post.');
            $r = false;
            if(!empty($post['id'])){
                // --存储数据
                $nowData = array('update_time'    => getTime());
                $data = array_merge($post, $nowData);
                $r = M('UsersLevel')->where(['id'    => $post['id']])->update($data);
            }
            if (false !== $r) {
                adminLog('编辑会员级别：'.$post['title']);
                $this->success("操作成功",url('UsersLevel/index'));
            }else{
                $this->error("操作失败",url('UsersLevel/index'));
            }
            exit;
        }
        $id = input('id/d');
        $info = M('UsersLevel')->where(['id'    => $id])->find();
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        $this->assign('info',$info);

        return $this->fetch();
    }
    /**
     * 删除会员等级
     */
    public function del()
    {
        if (IS_POST) {
            $id_arr = input('del_id/a');
            $id_arr = eyIntval($id_arr);
            if(!empty($id_arr)){
                //判断是否还存在当前等级的会员
                $hava_user = M('Users')->where(['level_id' => ['IN', $id_arr]])->find();
                if ($hava_user){
                    $this->error('当前级别存在会员，不能删除');
                }
                $have_system = M('UsersLevel')->where(['id'    => ['IN', $id_arr],'is_system'=>1])->find();
                if ($have_system){
                    $this->error($have_system['level_name'].'为系统内置级别，不能删除');
                }
                $result = M('UsersLevel')->field('level_name')->where(['id'    => ['IN', $id_arr]])->select();
                $title_list = get_arr_column($result, 'level_name');
                $r = M('UsersLevel')->where(['id'=> ['IN', $id_arr]])->delete();
                if($r){
                    adminLog('删除会员等级：'.implode(',', $title_list));
                    $this->success('删除成功');
                }else{
                    $this->error('删除失败');
                }
            } else {
                $this->error('参数有误');
            }
        }
        $this->error('非法访问');
    }
    /*
     * 设置默认等级
     */
    public function setSystem(){
        $id = input('id/d', 0);
        $is_true = Db::name('users_level')->where(['id'=>$id])->update(['is_system'=>1]);
        if ($is_true){
            Db::name('users_level')->where(['id'=>['neq',$id]])->update(['is_system'=>0]);
            $this->success("设置成功！");
        }else{
            $this->error("设置失败！");
        }
    }
}