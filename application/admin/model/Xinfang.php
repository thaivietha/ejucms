<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-1-7
 */

namespace app\admin\model;

use think\Model;

/**
 * 标签索引
 */
class Xinfang extends Model
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
            model('xinfang_photo')->where("aid","=",$aid)->whereNotIn('photo_id',$notdel_data)->delete();
            $insert_data && model('xinfang_photo')->insertAll($insert_data);
            $update_data && model('xinfang_photo')->saveAll($update_data);
        }
        //处理保存户型
        if (!empty($post['huxing_title'])){
            $insert_data = $update_data = $notdel_data = [];
            $huxing_characteristic = array_merge($post['huxing_characteristic']);
            foreach ($post['huxing_title'] as $key=>$val){
                $huxing_characteristic_arr = !empty($huxing_characteristic[$key]) ? $huxing_characteristic[$key]:[];
                if (!empty($post['huxing_id'][$key])){
                    $notdel_data[] = $post['huxing_id'][$key];
                    $update_data[] = [
                        'huxing_id'=>$post['huxing_id'][$key],'aid'=>$aid,'huxing_title'=>$val,'huxing_pic'=>$post['huxing_pic'][$key]
                        ,'huxing_price'=>!empty($post['huxing_price'][$key])?$post['huxing_price'][$key]:'0'
                        ,'huxing_characteristic'=>implode(',',$huxing_characteristic_arr)
                        ,'huxing_area'=>!empty($post['huxing_area'][$key])?$post['huxing_area'][$key]:'0'
                        ,'sale_status'=>!empty($post['sale_status'][$key])?$post['sale_status'][$key]:''
                        ,'huxing_aspect'=>!empty($post['huxing_aspect'][$key])?$post['huxing_aspect'][$key]:''
                        ,'huxing_fitment'=>!empty($post['huxing_fitment'][$key])?$post['huxing_fitment'][$key]:''
                        ,'huxing_manage_type'=>!empty($post['huxing_manage_type'][$key])?$post['huxing_manage_type'][$key]:''
                        ,'huxing_remark'=>!empty($post['huxing_remark'][$key])?$post['huxing_remark'][$key]:''
                        ,'huxing_room'=>!empty($post['huxing_room'][$key])?$post['huxing_room'][$key]:'0'
                        ,'huxing_living_room'=>!empty($post['huxing_living_room'][$key])?$post['huxing_living_room'][$key]:'0'
                        ,'huxing_kitchen'=>!empty($post['huxing_kitchen'][$key])?$post['huxing_kitchen'][$key]:'0'
                        ,'huxing_toilet'=>!empty($post['huxing_toilet'][$key])?$post['huxing_toilet'][$key]:'0'
                        ,'is_hot'=>!empty($post['is_hot'][$key])?$post['is_hot'][$key]:'0'
                        ,'sort_order'=> $key + 1
                    ];
                }else{
                    $insert_data[] = [
                        'aid'=>$aid
                        ,'huxing_title'=>$val
                        ,'huxing_pic'=>$post['huxing_pic'][$key]
                        ,'huxing_price'=>!empty($post['huxing_price'][$key])?$post['huxing_price'][$key]:'0'
                        ,'huxing_characteristic'=>implode(',',$huxing_characteristic_arr)
                        ,'huxing_area'=>!empty($post['huxing_area'][$key])?$post['huxing_area'][$key]:'0'
                        ,'sale_status'=>!empty($post['sale_status'][$key])?$post['sale_status'][$key]:''
                        ,'huxing_aspect'=>!empty($post['huxing_aspect'][$key])?$post['huxing_aspect'][$key]:''
                        ,'huxing_fitment'=>!empty($post['huxing_fitment'][$key])?$post['huxing_fitment'][$key]:''
                        ,'huxing_manage_type'=>!empty($post['huxing_manage_type'][$key])?$post['huxing_manage_type'][$key]:''
                        ,'huxing_remark'=>!empty($post['huxing_remark'][$key])?$post['huxing_remark'][$key]:''
                        ,'huxing_room'=>!empty($post['huxing_room'][$key])?$post['huxing_room'][$key]:'0'
                        ,'huxing_living_room'=>!empty($post['huxing_living_room'][$key])?$post['huxing_living_room'][$key]:'0'
                        ,'huxing_kitchen'=>!empty($post['huxing_kitchen'][$key])?$post['huxing_kitchen'][$key]:'0'
                        ,'huxing_toilet'=>!empty($post['huxing_toilet'][$key])?$post['huxing_toilet'][$key]:'0'
                        ,'is_hot'=>!empty($post['is_hot'][$key])?$post['is_hot'][$key]:'0'
                        ,'sort_order'=> $key + 1
                    ];
                }

            }
            model('xinfang_huxing')->where("aid","=",$aid)->whereNotIn('huxing_id',$notdel_data)->delete();
            $insert_data && model('xinfang_huxing')->insertAll($insert_data);
            $update_data && model('xinfang_huxing')->saveAll($update_data);
        }
        //处理价格变动
        $price = model('xinfang_price')->getLast($aid,"*","type");
        $average_price = !empty($post["addonFieldSys"]['average_price']) ? $post["addonFieldSys"]['average_price'] : '0';
        $starting_price = !empty($post["addonFieldSys"]['starting_price']) ? $post["addonFieldSys"]['starting_price'] : '0';
        if ($price){  //之前已经存在价格记录
            if ((!empty($average_price) && $price[1]['price'] != $average_price) || (!empty($starting_price) && $price[2]['price'] != $starting_price)){
                //价格相对上次发生变动
                $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
                $endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
                if ($price[1]['create_time'] >= $beginToday && $price[1]['create_time'] <= $endToday){  //今天之内存在变动，更新
                    $price[1]['price'] = $average_price;
                    $price[2]['price'] = $starting_price;
                    model('xinfang_price')->saveAll($price);
                }else{  //今天之前存在更新，插入
                    $price_insert[] = ['aid'=>$aid,'price'=>$average_price,'type'=>1,'create_time'=>time(),
                        'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
                    $price_insert[] = ['aid'=>$aid,'price'=>$starting_price,'type'=>2,'create_time'=>time(),
                        'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
                    model('xinfang_price')->insertAll($price_insert);
                }
            }
        }else{
            $price_insert[] = ['aid'=>$aid,'price'=>$average_price,'type'=>1,'create_time'=>time(),
                'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
            $price_insert[] = ['aid'=>$aid,'price'=>$starting_price,'type'=>2,'create_time'=>time(),
                'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
            model('xinfang_price')->insertAll($price_insert);
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
        M('xinfang_content')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除户型表
        M('xinfang_huxing')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除相册表
        M('xinfang_photo')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除价格趋势表
        M('xinfang_price')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除中间表
        M('xinfang_system')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除TAG标签
        model('Taglist')->delByAids($aidArr);
    }
    /*
     * 获取单条新房基本信息
     */
    public function getOne($condition,$fields = "d.*,c.*,b.*, a.*, a.aid as aid"){
        $row = db('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join('xinfang_content c','a.aid = c.aid')
            ->join('xinfang_system d','a.aid = d.aid')
            ->where($condition)
            ->find();

        return $row;
    }
}