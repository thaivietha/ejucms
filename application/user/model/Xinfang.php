<?php
/**
 * User: xyz
 * Date: 2020/3/12
 * Time: 17:18
 */

namespace app\user\model;

use think\Model;
use think\Db;

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
        $field = new \app\admin\model\Field();
        $addonFieldExt = !empty($post['addonFieldExt']) ? $post['addonFieldExt'] : array();
        $field->dealChannelPostData($post['channel'], $post, $addonFieldExt);   //编辑子表信息(content)
        $addonFieldSys = !empty($post['addonFieldSys']) ? $post['addonFieldSys'] : array();
        $field->dealChannelPostData($post['channel'], $post, $addonFieldSys,'system');   //编辑子表信息(system)
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
                        ,'photo_type'=>!empty($post['photo_type'][$key]) ? $post['photo_type'][$key] : ""
                        ,'sort_order'=> $key + 1
                    ];
                }else{
                    $insert_data[] = [
                        'aid'=>$aid
                        ,'photo_title'=>$val
                        ,'photo_pic'=>$post['photo_pic'][$key]
                        ,'photo_type'=>!empty($post['photo_type'][$key]) ? $post['photo_type'][$key] : ""
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
        $average_price = !empty($post["addonFieldSys"]['average_price']) ? intval($post["addonFieldSys"]['average_price']) : '0';
        $starting_price = !empty($post["addonFieldSys"]['starting_price']) ? intval($post["addonFieldSys"]['starting_price']) : '0';
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
    /*
     * 获取单条新房基本信息
     */
    public function getOne($condition,$fields = "d.*,c.*,b.*, a.*, a.aid as aid,d.average_price as price"){
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