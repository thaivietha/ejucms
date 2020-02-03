<?php
/**
 * User: xyz
 * Date: 2019/10/15
 * Time: 10:41
 */

namespace app\admin\model;

use think\Model;

class Shopcs extends Model
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
        model('Field')->dealChannelPostData($post['channel'], $post, $addonFieldExt);   //编辑子表信息(content)
        //计算均价
        if (!empty($post['addonFieldSys']['area'])){
            $post['addonFieldSys']['average_price'] = number_format($post['addonFieldSys']['total_price']/$post['addonFieldSys']['area'],2);
        }else{
            $post['addonFieldSys']['average_price'] = 0;
        }
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
            model('shopcs_photo')->where("aid","=",$aid)->whereNotIn('photo_id',$notdel_data)->delete();
            $insert_data && model('shopcs_photo')->insertAll($insert_data);
            $update_data && model('shopcs_photo')->saveAll($update_data);
        }
        //处理价格变动
        $price = model('shopcs_price')->getLast($aid,"*","type");
        $average_price = !empty($post["addonFieldSys"]['average_price']) ? $post["addonFieldSys"]['average_price'] : '0';
        $total_price = !empty($post["addonFieldSys"]['total_price']) ? $post["addonFieldSys"]['total_price'] : '0';
        if ($price){  //之前已经存在价格记录
            if ((!empty($average_price) && $price[1]['price'] != $average_price) || (!empty($total_price) && $price[3]['price'] != $total_price)){
                //价格相对上次发生变动
                $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
                $endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
                if ($price[1]['create_time'] >= $beginToday && $price[1]['create_time'] <= $endToday){  //今天之内存在变动，更新
                    $price[1]['price'] = $average_price;
                    $price[3]['price'] = $total_price;
                    model('shopcs_price')->saveAll($price);
                }else{  //今天之前存在更新，插入
                    $price_insert[] = ['aid'=>$aid,'price'=>$average_price,'type'=>1,'create_time'=>time(),
                        'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
                    $price_insert[] = ['aid'=>$aid,'price'=>$total_price,'type'=>3,'create_time'=>time(),
                        'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
                    model('shopcs_price')->insertAll($price_insert);
                }
            }
        }else{
            $price_insert[] = ['aid'=>$aid,'price'=>$average_price,'type'=>1,'create_time'=>time(),
                'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
            $price_insert[] = ['aid'=>$aid,'price'=>$total_price,'type'=>3,'create_time'=>time(),
                'day'=>date('Y-m-d',time()), 'month'=>date('Y-m',time()), 'year'=>date('Y',time())];
            model('shopcs_price')->insertAll($price_insert);
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
        M('shopcs_content')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除中间表
        M('shopcs_system')->where(array('aid'=>array('IN', $aidArr)))->delete();
        // 同时删除相册表
        M('shopcs_photo')->where(array('aid'=>array('IN', $aidArr)))->delete();
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
            ->join('shopcs_content c','a.aid = c.aid')
            ->join('shopcs_system d','a.aid = d.aid')
            ->where($condition)
            ->find();

        return $row;
    }
}