<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/31
 * Time: 15:09
 */

namespace think\template\taglib\eju;

use think\Db;
use app\home\logic\FieldLogic;
use app\common\model\Arctype;

class TagSonarclist extends Base
{
    public $aid = '';
    public $tid = '';
    public $fieldLogic;
    protected function _initialize()
    {
        parent::_initialize();
        $this->fieldLogic = new FieldLogic();
        $this->aid = I('param.aid/d', 0);
        $this->tid = I('param.tid/d', 0);
    }
    /*
     * 获取总数
     */
    public function getSonCount($aid = 0,$map = [],$mapkey = [],$table = '',$group = ""){
//        $aid = !empty($aid) ? $aid : $this->aid;
        if (empty($table)){
            echo '标签sonarclist报错：缺少属性 table 。';
            return false;
        }
        $where = [];
        if ($aid){
            $where['aid'] = $aid;
        }
        if (!empty($map)){
            foreach ($map as $key=>$val){
                $where[$mapkey[$key]] = $val;
            }
        }
        if (empty($where)){
            echo '标签sonarclist报错：缺少属性 where 。';
            return false;
        }
        $result = db($table)->where($where);
        if (!empty($group)){
            $result = $result->group($group);
        }

        $result = $result->count();

        return $result;
    }
    /*
     * 获取单个信息
     */
    public function getSonarcview($aid = 0,$table = '',$map = [],$mapkey = [],$field = "*"){
        $aid = !empty($aid) ? $aid : $this->aid;
        if (empty($table)){
            echo '标签sonarcview报错：缺少属性 table 。';
            return false;
        }
        if (empty($aid)){
           echo '标签sonarcview报错：缺少属性 aid 。';
            return false;
        }
        $where = [];
        if (!empty($map)){
            foreach ($map as $key=>$val){
                $where[$mapkey[$key]] = $val;
            }
        }
        $result = db($table)->field($field)->where($where)->find($aid);
        if (!empty($result['channel'])){
            $channeltype_info = model('Channeltype')->getInfo($result['channel']);
            $controller_name = $channeltype_info['ctl_name'];
        }
        if (isset($result['is_part'])){
            if ($result['is_part'] == 1) {
                $result['typeurl'] = $result['typelink'];
            } else {
                $result['typeurl'] = typeurl('home/'.$controller_name."/lists", $result);
            }
        }
        if (isset($result['is_jump'])){
            if ($result['is_jump'] == 1) {
                $result['arcurl'] = $result['jumplinks'];
            } else {
                $result['arcurl'] = arcurl('home/'.$controller_name.'/view', $result);
            }
        }
        if (isset($result['litpic'])){
            $result['litpic'] = thumb_img(get_default_pic($result['litpic'])); // 默认封面图
        }
        return $result;
    }
    /*
     * 获取列表
     */
    public function getSonarclist($aid = 0,$map = [],$mapkey=[],$table = '',$field = "*",$order = "",$limit = "",$group = "",$addfields = ""
        ,$max="",$min="",$sum="",$count=0,$jointable = [],$region = 0){
        $aid = !empty($aid) ? $aid : $this->aid;
        if (empty($table)){
            echo '标签sonarclist报错：缺少属性 table 。';
            return false;
        }
        $where = [];
        if (!empty($aid)){
            $foreignkey = model($table)->getForeignKeys();
            $where[$foreignkey] = $aid;
        }
        //判断是否需要筛选区域    region ，1：筛选，0：不筛选（默认）
        $regionInfo = \think\Cookie::get("regionInfo");
        if(is_json($regionInfo))
        {
            $regionInfo = json_decode($regionInfo,true);
        }
        if (!empty($region) && $regionInfo['level'] == 1){
            $where['province_id'] = $regionInfo['id'];
        }else if(!empty($region) && $regionInfo['level'] == 2){
            $where['city_id'] = $regionInfo['id'];
        }
        if (!empty($map)){
            foreach ($map as $key=>$val){
                $where[$mapkey[$key]] = $val;
            }
        }
        if (empty($where)){
            echo '标签sonarclist报错：缺少属性 where 。';
            return false;
        }
        if (!empty($addfields)){
            $field .= ",".$addfields;
        }
        if (!empty($max)){
            $max = explode(',',$max);
            foreach ($max as $value){
                $field .= ",max({$value}) as max_$value";
            }
        }
        if (!empty($min)){
            $min = explode(',',$min);
            foreach ($min as $value){
                $field .= ",min({$value}) as min_$value";
            }
        }
        if (!empty($sum)){
            $sum = explode(',',$sum);
            foreach ($sum as $value){
                $field .= ",sum({$value}) as sum_$value";
            }
        }
        if (!empty($count)){
            $field .= ",count(*) as count";
        }

        $result = db($table)->alias("a");
        if (!empty($jointable)){
            foreach ($jointable as $val){
                $result = $result->join($val['table'],$val['map'],$val["method"]);
            }
        }
        $result = $result->field($field)->where($where);
        if (!empty($group)){
            $result = $result->group($group);
        }
        if (!empty($order)){
            $result = $result->order($order);
        }
        if (!empty($limit)){
            $result = $result->limit($limit);
        }
        $result = $result->select();
        if (!empty($result)){
            $controller_name = "";
            if (!empty($result[0]['channel'])){
                $result = $this->fieldLogic->getChannelFieldList($result, $result[0]['channel'], true);

                $channeltype_info = model('Channeltype')->getInfo($result[0]['channel']);
                $controller_name = $channeltype_info['ctl_name'];
            }
            foreach ($result as $key=>$val){
                if (isset($val['is_part'])){
                    if ($val['is_part'] == 1) {
                        $result[$key]['typeurl'] = $val['typelink'];
                    } else {
                        $result[$key]['typeurl'] = typeurl('home/'.$controller_name."/lists", $val);
                    }
                }
                if (isset($val['is_jump'])){
                    if ($val['is_jump'] == 1) {
                        $result[$key]['arcurl'] = $val['jumplinks'];
                    } else {
                        if (empty($val['dirname']) || empty($val['dirpath'])){
                            $arctype_info = model("arctype")->field("dirname,dirpath")->where("id={$val['typeid']}")->find();
                            $val['dirname'] = !empty($arctype_info) ? $arctype_info['dirname'] :'xinfang';
                            $val['dirpath'] = !empty($arctype_info) ? $arctype_info['dirpath'] :'/xinfang';
                        }
                        $result[$key]['arcurl'] = arcurl('home/'.$controller_name.'/view', $val);
                    }
                }
                if (isset($val['litpic'])){
                    $result[$key]['litpic'] = thumb_img(get_default_pic($val['litpic'])); // 默认封面图
                }
                if (isset($val['huxing_pic'])){
                    $result[$key]['huxing_pic'] = thumb_img(get_default_pic($val['huxing_pic']));
                }
                if (isset($val['photo_pic'])){
                    $result[$key]['photo_pic'] = thumb_img(get_default_pic($val['photo_pic']));
                }
                if (isset($val['saleman_pic'])){
                    $result[$key]['saleman_pic'] = thumb_img(get_default_pic($val['saleman_pic']));
                }
                if (isset($val['pic'])){
                    $result[$key]['pic'] = thumb_img(get_default_pic($val['pic']));
                }
            }
        }
        return $result;
    }
}