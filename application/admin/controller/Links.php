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
use think\Cache;

class Links extends Base
{
    public function index()
    {
        $list = array();
        $keywords = input('keywords/s');

        $condition = array();
        if (!empty($keywords)) {
            $condition['title'] = array('LIKE', "%{$keywords}%");
        }

        $linksM =  M('links');
        $count = $linksM->where($condition)->count('id');// 查询满足要求的总记录数
        $Page = $pager = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $linksM->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象
        return $this->fetch();
    }

    /**
     * 添加友情链接
     */
    public function add()
    {
        if (IS_POST) {
            $post = input('post.');

            // --存储数据
            $nowData = array(
                'typeid'    => empty($post['typeid']) ? 1 : $post['typeid'],
                'url'    => trim($post['url']),
                'sort_order'    => 100,
                'add_time'    => getTime(),
                'update_time'    => getTime(),
            );
            $data = array_merge($post, $nowData);
            $insertId = M('links')->insertGetId($data);
            if (false !== $insertId) {
                Cache::clear('links');
                adminLog('新增友情链接：'.$post['title']);
                $this->success("操作成功", url('Links/index'));
            }else{
                $this->error("操作失败", url('Links/index'));
            }
            exit;
        }

        return $this->fetch();
    }
    
    /**
     * 编辑友情链接
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.');
            $r = false;
            if(!empty($post['id'])){
                // --存储数据
                $nowData = array(
                    'typeid'    => empty($post['typeid']) ? 1 : $post['typeid'],
                    'url'    => trim($post['url']),
                    'update_time'    => getTime(),
                );
                $data = array_merge($post, $nowData);
                $r = M('links')->where([
                        'id'    => $post['id'],
                    ])
                    ->cache(true, null, "links")
                    ->update($data);
            }
            if (false !== $r) {
                adminLog('编辑友情链接：'.$post['title']);
                $this->success("操作成功",url('Links/index'));
            }else{
                $this->error("操作失败",url('Links/index'));
            }
            exit;
        }

        $id = input('id/d');
        $info = M('links')->where([
                'id'    => $id,
            ])->find();
        if (empty($info)) {
            $this->error('数据不存在，请联系管理员！');
            exit;
        }
        $info['logo'] = handle_subdir_pic($info['logo']);
        $this->assign('info',$info);

        return $this->fetch();
    }
    
    /**
     * 删除友情链接
     */
    public function del()
    {
        if (IS_POST) {
            $id_arr = input('del_id/a');
            $id_arr = eyIntval($id_arr);
            if(!empty($id_arr)){
                $result = M('links')->field('title')
                    ->where([
                        'id'    => ['IN', $id_arr],
                    ])->select();
                $title_list = get_arr_column($result, 'title');

                $r = M('links')->where([
                        'id'    => ['IN', $id_arr],
                    ])
                    ->cache(true, null, "links")
                    ->delete();
                if($r){
                    adminLog('删除友情链接：'.implode(',', $title_list));
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