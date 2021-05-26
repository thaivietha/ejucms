<?php
/**
 * User: xyz
 * Date: 2020/3/31
 * Time: 16:48
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Remark extends Base
{
    public function _initialize() {
        parent::_initialize();
    }
    public function index(){
        //留言信息管理
        $condition = [];
        $aid = input("aid/d",0);
        $keywords = input("keywords/s",'');
        if (!empty($aid)){      //楼盘id
            $condition['a.aid'] = $aid;
        }
        if (!empty($keywords)){      //内容
            $condition['a.content'] = array('LIKE', "%{$keywords}%");
        }

        $formListM =  Db::name('remark');
        $count = $formListM->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $formListM->field("b.*,a.*")->alias('a')->join("users b",'a.users_id = b.id','left')->where($condition)->order('a.remark_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $aid_arr = get_arr_column($list,'aid');
        $title_arr = Db::name('archives')->where(['aid'=>['in',$aid_arr]])->getAllWithIndex('aid');
        foreach ($list as $key=>$val){
            $list[$key]['title'] = !empty($title_arr[$val['aid']]['title']) ? $title_arr[$val['aid']]['title'] : '';
        }
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$Page);// 赋值分页对象

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
            $r = Db::name('remark')->where('remark_id','IN',$id_arr)->delete();
            if ($r) {
                adminLog('删除点评-id：'.implode(',', $id_arr));
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
}