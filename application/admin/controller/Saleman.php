<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/12
 * Time: 9:49
 */

namespace app\admin\controller;

use think\Page;

class Saleman extends Base
{
    public function initialize(){
        parent::_initialize();
    }

    public function edit(){
        if (IS_POST){
            $post = input('post.');
            if (empty($post['saleman_name'])) {
                $this->error("人员姓名不能为空！");
            }
            if (!empty($post['id'])) {
                $post['update_time'] = getTime();
                $r = model("saleman")->where(['id'=>intval($post['id'])])->save($post);
                if ($r) {
                    adminLog('编辑经纪人：'.$post['saleman_name']);
                    $this->success("操作成功", url('Saleman/index'));
                }
            }
            $this->error("操作失败");
        }
        $id = input('param.id/d', 0);
        $info = model("saleman")->getInfo($id);
        $info['saleman_pic'] = handle_subdir_pic($info['saleman_pic']);
        $assign_data['field'] = $info;
        $this->assign($assign_data);

        return $this->fetch();
    }

    public function add(){
        if (IS_POST) {
            $post = input('post.');
            if (empty($post['saleman_name'])) {
                $this->error("人员姓名不能为空！");
            }
            $id = model('saleman')->insertGetId($post);
            if ($id){
                adminLog('新增经纪人：'.$post['saleman_name']);
                $this->success("操作成功", url('Saleman/index'));
                exit;
            }
            $this->error("操作失败");
            exit;
        }

        return $this->fetch();
    }

    public function index(){
        $assign_data = array();
        $condition = array();
        $keywords = input('keywords/s');
        if ($keywords){
            $condition['saleman_name'] = ['LIKE', "%{$keywords}%"];
        }
        $count = db('saleman')->where($condition)->count('id');// 查询满足要求的总记录数

        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = model('saleman')
            ->field("*")
            ->where($condition)
            ->order('id desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $pageStr = $Page->show(); // 分页显示输出
        $assign_data['pageStr'] = $pageStr; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象
        $this->assign($assign_data);

        return $this->fetch();
    }
    
    /**
     * 删除
     */
    public function del()
    {
        if (IS_POST) {
            $id_arr = input('del_id/a');
            $id_arr = eyIntval($id_arr);
            if(!empty($id_arr)){
                $result = M('saleman')->field('saleman_name')
                    ->where([
                        'id'    => ['IN', $id_arr],
                    ])->select();
                $saleman_name_list = get_arr_column($result, 'saleman_name');

                $r = M('saleman')->where([
                        'id'    => ['IN', $id_arr],
                    ])->delete();
                if($r){
                    adminLog('删除经纪人：'.implode(',', $saleman_name_list));
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
}