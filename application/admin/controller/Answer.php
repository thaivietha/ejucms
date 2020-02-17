<?php
/**
 * User: xyz
 * Date: 2019/12/13
 * Time: 17:15
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Answer extends Base
{
    public function _initialize() {
        parent::_initialize();
    }
    public function index(){
        $condition = [];
        $aid = input("aid/d",0);
        $question_id = input("ask_id/d",0);
        $keywords = input("keywords/s",'');
        if (!empty($aid)){      //楼盘id
            $condition['a.aid'] = $aid;
        }
        if (!empty($question_id)){
            $condition['a.ask_id'] = $question_id;
        }
        if (!empty($keywords)){
            $condition['a.content'] = array('LIKE', "%{$keywords}%");
        }

        $formListM =  Db::name('answer');
        $count = $formListM->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $formListM->alias('a')->where($condition)->order('a.is_review asc,a.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $question_id_arr = get_arr_column($list,'ask_id');
        $question_arr = Db::name('ask')->where(['ask_id'=>['in',$question_id_arr]])->getAllWithIndex('ask_id');
        foreach ($list as $key=>$val){
            $list[$key]['question'] = $question_arr[$val['ask_id']];
        }
        $show = $Page->show();// 分页显示输出
        $this->assign('ask_id',$question_id);// 问题id
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$Page);// 赋值分页对象

        return $this->fetch();
    }
    /**
     * 添加回复
     */
    public function add()
    {
        if (IS_POST) {
            $post = input('post.');
            // --存储数据
            $nowData = array(
                'users_ip' => clientIP(),
                'add_time'    => getTime(),
                'update_time'    => getTime(),
                'username'  => '管理员',
            );
            $data = array_merge($post, $nowData);
            $insertId = Db::name("answer")->insertGetId($data);
            if (false !== $insertId) {
                adminLog('新增回答：'.$post['content']);
                $this->success("操作成功", url('Ask/detail',['ask_id'=>$post['ask_id']]));
            }else{
                $this->error("操作失败", url('Ask/detail',['ask_id'=>$post['ask_id']]));
            }
            exit;
        }
        $id = input('ask_id/d');
        $info = Db::name("ask")->where([
            'ask_id'    => $id,
        ])->find();
        if (empty($info)) {
            $this->error('问题不存在，请联系管理员！');
            exit;
        }
        $this->assign('info',$info);

        return $this->fetch();
    }

    /**
     * 编辑提问
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.');
            $r = false;
            if(!empty($post['id'])){
                // --存储数据
                $nowData = array(
                    'update_time'    => getTime(),
                );
                $data = array_merge($post, $nowData);
                $r = Db::name("answer")->where([
                    'id'    => $post['id'],
                ])->update($data);
            }
            if (false !== $r) {
                adminLog('编辑回答：'.$post['content']);
                $this->success("操作成功",url('Ask/detail',['ask_id'=>$post['ask_id']]));
            }else{
                $this->error("操作失败",url('Ask/detail',['ask_id'=>$post['ask_id']]));
            }
            exit;
        }

        $id = input('id/d');
        $info = Db::name("answer")->where([
            'id'    => $id,
        ])->find();
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        $question = Db::name("ask")->where("ask_id=".$info['ask_id'])->find();
        if (empty($question)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        $this->assign('info',$info);
        $this->assign('ask',$question);

        return $this->fetch();
    }
    /**
     * 删除信息
     */
    public function del()
    {
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            Db::name('answer_like')->where('answer_id','IN',$id_arr)->delete();
            $r = Db::name('answer')->where('id','IN',$id_arr)->delete();
            if ($r) {
                adminLog('删除回答内容-id：'.implode(',', $id_arr));
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
}