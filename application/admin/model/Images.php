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
 * 图集
 */
class Images extends Model
{
    // 模型标识
    public $nid = 'images';
    // 模型ID
    public $channeltype = '';

    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
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
        model('Field')->dealChannelPostData($post['channel'], $post, $addonFieldExt);

        // ---------多图
        model('ImagesUpload')->saveimg($aid, $post);
        // ---------end

        // --处理TAG标签
        model('Taglist')->savetags($aid, $post['typeid'], $post['tags']);
    }

    /**
     * 获取单条记录
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($aid, $field = '', $isshowbody = true)
    {
        $result = array();
        $field = !empty($field) ? $field : '*';
        $result = db('archives')->field($field)
            ->where([
                'aid'   => $aid,
            ])
            ->find();
        if ($isshowbody) {
            $tableName = M('channeltype')->where('id','eq',$result['channel'])->getField('table');
            $result['addonFieldExt'] = db($tableName.'_content')->where('aid',$aid)->find();
        }

        // 图集TAG标签
        if (!empty($result)) {
            $typeid = isset($result['typeid']) ? $result['typeid'] : 0;
            $tags = model('Taglist')->getListByAid($aid, $typeid);
            $result['tags'] = $tags;
        }

        return $result;
    }
    

    /**
     * 获取多条记录
     * @author lindaoyun by 2017-9-18
     */
    public function getListByLimit($map = array(),  $limit = 15, $field = '*', $order = 'a.aid desc')
    {
        $data = array();
        $field_arr = explode(',', $field);
        foreach ($field_arr as $key => $val) {
            array_push($data, 'a.'.trim($val));
        }
        $field = implode(',', $data);
        $field = 'b.*, '.$field;

        if (!empty($map) && is_array($map)) {
            foreach ($map as $key => $val) {
                if (preg_match("/^(a\.)/i", $val) == 0) {
                    $map['a.'.$key] = $val;
                    unset($map[$key]);
                }
            }
        }
        $map['a.channel'] = $this->channeltype;

        $result = db('archives')
            ->field($field)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
            ->where($map)
            ->order($order)
            ->limit($limit)
            ->select();

        return $result;
    }   

    /**
     * 获取多条记录
     * @author wengxianhu by 2017-7-26
     */
    public function getListByClick($limit = 10, $map = array(), $field = '*')
    {
        $map['channel'] = $this->channeltype;
        $map['status'] = 1;
        $result = db('archives')
            ->field($field)
            ->where($map)
            // ->cache(true,EYOUCMS_CACHE_TIME)
            ->order('click desc')
            ->limit($limit)
            ->select();

        return $result;
    }   

    /**
     * 获取当前图集的所有上下级分类
     */
    public function getAllCateByTypeid($typeid)
    {
        $result = M('arctype')->field('id,parent_id,typename')
            ->where(array('id|parent_id'=>$typeid, 'status'=>1))
            ->order('parent_id asc, sort_order asc')
            ->getAllWithIndex('id');   

        return $result;     
    }

    /**
     * 删除的后置操作方法
     * 自定义的一个函数 用于数据删除后做的相应处理操作, 使用时手动调用
     * @param int $aid
     */
    public function afterDel($aidArr = array())
    {
        if (is_string($aidArr)) {
            $aidArr = explode(',', $aidArr);
        }
        // 同时删除内容
        M('images_content')->where(
                array(
                    'aid'=>array('IN', $aidArr)
                )
            )
            ->delete();
        // 同时删除图片
        $result = M('images_upload')->field('image_url')
            ->where(
                array(
                    'aid'=>array('IN', $aidArr)
                )
            )
            ->select();
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                if (!is_http_url($val['image_url'])) {
                    @unlink(ROOT_PATH.trim($val['image_url'], '/'));
                }
            }
            M('images_upload')->where(
                array(
                    'aid'=>array('IN', $aidArr)
                )
            )
            ->delete();
        }
        // 同时删除TAG标签
        model('Taglist')->delByAids($aidArr);
    }
}