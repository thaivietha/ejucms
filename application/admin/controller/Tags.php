<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\admin\controller;

use think\Page;

class Tags extends Base
{
    public function index()
    {
        $list = array();
        $keywords = input('keywords/s');

        $condition = array();
        if (!empty($keywords)) {
            $condition['tag'] = array('LIKE', "%{$keywords}%");
        }

        $tagsM =  M('tagindex');
        $count = $tagsM->where($condition)->count('id');// 查询满足要求的总记录数
        $Page = $pager = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $tagsM->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象
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
                $result = M('tagindex')->field('tag')
                    ->where([
                        'id'    => ['IN', $id_arr],
                    ])->select();
                $title_list = get_arr_column($result, 'tag');

                $r = M('tagindex')->where([
                        'id'    => ['IN', $id_arr],
                    ])->delete();
                if($r){
                    M('taglist')->where([
                        'tid'    => ['IN', $id_arr],
                    ])->delete();
                    adminLog('删除Tags标签：'.implode(',', $title_list));
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
    
    /**
     * 清空
     */
    public function clearall()
    {
        if (IS_POST) {
            $r = M('tagindex')->truncate();
            if(false !== $r){
                M('taglist')->truncate();
                adminLog('清空Tags标签');
                $this->success('操作成功');
            }
        }
        $this->error('操作失败');
    }
}