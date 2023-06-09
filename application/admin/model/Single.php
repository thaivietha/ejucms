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

namespace app\admin\model;

use think\Model;

/**
 * 单页
 */
class Single extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 后置操作方法
     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用
     * @param int $aid 产品id
     * @param array $post post数据
     * @param string $opt 操作
     */
    public function afterSave($aid, $post, $opt)
    {
        $post['aid'] = $aid;
        $addonFieldExt = !empty($post['addonFieldExt']) ? $post['addonFieldExt'] : array();
        model('Field')->dealChannelPostData(6, $post, $addonFieldExt);
    }

    /**
     * 删除的后置操作方法
     * 自定义的一个函数 用于数据删除后做的相应处理操作, 使用时手动调用
     * @param int $aid
     */
    public function afterDel($typeidArr = array())
    {
        if (is_string($typeidArr)) {
            $typeidArr = explode(',', $typeidArr);
        }

        // 同时删除单页文档表
        M('archives')->where(
                array(
                    'typeid'=>array('IN', $typeidArr)
                )
            )
            ->delete();
        // 同时删除内容
        M('single_content')->where(
                array(
                    'typeid'=>array('IN', $typeidArr)
                )
            )
            ->delete();
        // 清除缓存
        \think\Cache::clear("arctype");
        extra_cache('admin_all_menu', NULL);
        \think\Cache::clear('admin_archives_release');
    }

    /*
    * 获取单条新房基本信息
    */
    public function getOne($condition,$fields = "c.*,b.*, a.*, a.aid as aid"){
        $row = db('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join('single_content c','a.aid = c.aid')
            ->where($condition)
            ->find();

        return $row;
    }
}