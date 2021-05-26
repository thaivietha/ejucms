<?php
/**
 * User: xyz
 * Date: 2019/10/14
 * Time: 15:20
 */

namespace app\admin\model;

use think\Model;
use think\Db;

class Xiaoqu extends Model
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
        $addonFieldExt = !empty($post['addonFieldExt']) ? $post['addonFieldExt'] : array();
        model('Field')->dealChannelPostData($post['channel'], $post, $addonFieldExt);   //编辑子表信息(content)
        $addonFieldSys = !empty($post['addonFieldSys']) ? $post['addonFieldSys'] : array();
        model('Field')->dealChannelPostData($post['channel'], $post, $addonFieldSys,'system');   //编辑子表信息(system)
        // --处理TAG标签
        model('Taglist')->savetags($aid, $post['typeid'], $post['tags']);
        //处理保存相册
        if (!empty($post['photo_title'])){
            $insert_data = $update_data = $notdel_data = [];
            foreach ($post['photo_title'] as $key=>$val){
                if (!empty($post['photo_id'][$key])){
                    $notdel_data[] = $post['photo_id'][$key];
                    $update_data[] = [
                        'photo_id'=>$post['photo_id'][$key]
                        ,'aid'=>$aid
                        ,'photo_title'=>$val
                        ,'photo_pic'=>$post['photo_pic'][$key]
                        ,'photo_type'=>$post['photo_type'][$key]
                        ,'sort_order'=> $key + 1
                    ];
                }else{
                    $insert_data[] = [
                        'aid'=>$aid
                        ,'photo_title'=>$val
                        ,'photo_pic'=>$post['photo_pic'][$key]
                        ,'photo_type'=>$post['photo_type'][$key]
                        ,'sort_order'=> $key + 1
                    ];
                }
            }
            model('xiaoqu_photo')->where("aid","=",$aid)->whereNotIn('photo_id',$notdel_data)->delete();
            $insert_data && model('xiaoqu_photo')->insertAll($insert_data);
            $update_data && model('xiaoqu_photo')->saveAll($update_data);
        }
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
        M('xiaoqu_content')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除中间表
        M('xiaoqu_system')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除相册表
        M('xiaoqu_photo')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除TAG标签
        model('Taglist')->delByAids($aidArr);
    }
    /*
     * 获取单条新房基本信息
     */
    public function getOne($condition,$fields = "d.*,c.*,b.*, a.*, a.aid as aid,d.average_price as price"){
        $row = db('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join('xiaoqu_content c','a.aid = c.aid')
            ->join('xiaoqu_system d','a.aid = d.aid')
            ->where($condition)
            ->find();

        return $row;
    }
}