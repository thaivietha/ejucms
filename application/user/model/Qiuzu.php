<?php
/**
 * User: xyz
 * Date: 2019/11/8
 * Time: 10:58
 */

namespace app\user\model;

use think\Model;
use think\Db;

class Qiuzu extends Model
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
        if (!empty($post['map'])){
            $map_arr = explode(',',$post['map']);
            $post['addonFieldSys']['lng'] = !empty($map_arr[0])?$map_arr[0]:'';
            $post['addonFieldSys']['lat'] = !empty($map_arr[1])?$map_arr[1]:'';
        }
        $field = new \app\admin\model\Field();
        $addonFieldExt = !empty($post['addonFieldExt']) ? $post['addonFieldExt'] : array();
        $field->dealChannelPostData($post['channel'], $post, $addonFieldExt);   //编辑子表信息(content)

        $addonFieldSys = !empty($post['addonFieldSys']) ? $post['addonFieldSys'] : array();
        $field->dealChannelPostData($post['channel'], $post, $addonFieldSys,'system');   //编辑子表信息(system)

        // --处理TAG标签
        model('Taglist')->savetags($aid, $post['typeid'], $post['tags']);
    }

    /**
     * 获取单条记录
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($aid, $field = null, $isshowbody = true)
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
        // 文章TAG标签
        if (!empty($result)) {
            $typeid = isset($result['typeid']) ? $result['typeid'] : 0;
            $tags = model('Taglist')->getListByAid($aid, $typeid);
            $result['tags'] = $tags;
        }

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
        M('qiuzu_content')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除中间表
        M('qiuzu_system')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除相册表
        M('qiuzu_photo')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除TAG标签
        model('Taglist')->delByAids($aidArr);
    }
    /*
     * 获取单条新房基本信息
     */
    /*
     * 获取单条新房基本信息
     */
    public function getOne($condition,$fields = "d.*,c.*,b.*, a.*, a.aid as aid,d.total_price as price"){
        $row = db('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join('qiuzu_content c','a.aid = c.aid')
            ->join('qiuzu_system d','a.aid = d.aid')
            ->where($condition)
            ->find();
        if ($row && empty($row['price_units'])){
            $price_units = Db::name("channelfield")->where(['name'=>'total_price','channel_id'=>$row['current_channel']])->getField("dfvalue_unit");
            $row['price_units'] = $price_units;
        }

        return $row;
    }

}