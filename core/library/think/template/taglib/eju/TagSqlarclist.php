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

class TagSqlarclist extends Base
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
     * 获取列表
     */
    public function getSqlarclist($aid = 0,$map = [],$mapkey=[],$table = '',$fields = "*",$order = "",$limit = "",$group = "",$addfields = ""
        ,$max="",$min="",$sum="",$count='',$jointable = [],$region = 0,$addwhere = '')
    {
        if (empty($table)){
            echo '标签sqlarclist报错：缺少属性 table 。';
            return false;
        }

        if ('region' == $table) {
            return $this->getRegionData($table, $fields, $addwhere, $limit);
        }

        $aid = !empty($aid) ? $aid : $this->aid;
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
            $fields .= ",".$addfields;
        }
        if (!empty($max)){
            $max = explode(',',$max);
            foreach ($max as $value){
                $fields .= ",max({$value}) as max_$value";
            }
        }
        if (!empty($min)){
            $min = explode(',',$min);
            foreach ($min as $value){
                $fields .= ",min({$value}) as min_$value";
            }
        }
        if (!empty($sum)){
            $sum = explode(',',$sum);
            foreach ($sum as $value){
                $fields .= ",sum({$value}) as sum_$value";
            }
        }
        if ($count == 'on'){
            $fields .= ",count(*) as count";
        }

        $result = db($table)->alias("a");
        if (!empty($jointable)){
            foreach ($jointable as $val){
                $result = $result->join($val['table'],$val['map'],$val["method"]);
            }
        }
        $result = $result->field($fields)->where($where);
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
                    $result[$key]['litpic'] = get_default_pic(handle_subdir_pic($val['litpic']));
                }
                if (isset($val['huxing_pic'])){
                    $result[$key]['huxing_pic'] = get_default_pic(handle_subdir_pic($val['huxing_pic']));
                }
                if (isset($val['photo_pic'])){
                    $result[$key]['photo_pic'] = get_default_pic(handle_subdir_pic($val['photo_pic']));
                }
                if (isset($val['saleman_pic'])){
                    $result[$key]['saleman_pic'] = get_default_pic(handle_subdir_pic($val['saleman_pic']));
                }
                if (isset($val['pic'])){
                    $result[$key]['pic'] = get_default_pic(handle_subdir_pic($val['pic']));
                }
            }
        }
        return $result;
    }

    /**
     * 获取区域多条信息
     * @author wengxianhu by 2018-4-20
     */
    public function getRegionData($table, $fields = '', $addwhere = '', $limit = '')
    {
        $fields = !empty($fields) ? $fields : '*';
        $where = "";
        if (!empty($addwhere)) {
            if (!empty($where)) {
                $where = "(".$addwhere.") AND ".$where;
            } else {
                $where = $addwhere;
            }
        }

        $result = M($table)->field($fields)->where($where)->limit($limit)->select();

        switch ($table) {
            case 'region':
                {
                    $web_region_domain = config('ey_config.web_region_domain'); // 是否开启子站点
                    $url_screen_var = config('global.url_screen_var'); // 筛选动态标识
                    $firstTypeid = model('Arctype')->getFristTypeid(9); // 指定模型的第一个区域ID
                    foreach ($result as $key => $val) {
                        // 封面图
                        $val['litpic'] = !empty($val['litpic']) ? handle_subdir_pic($val['litpic']) : get_default_pic($val['litpic']);

                        /*区域的URL*/
                        if (!empty($web_region_domain) && !empty($val['domain']) && 2 >= $val['level']) {
                            $domainurl = getRegionDomainUrl($val['domain']);
                        } else {
                            if ($val['level'] == 1){
                                $vars = [
                                    'tid'           => $firstTypeid,
                                    'province_id'   => $val['id'],
                                    $url_screen_var => 1,
                                ];
                            }else{
                                $vars = [
                                    'tid'           => $firstTypeid,
                                    'province_id'   => $val['parent_id'],
                                    'city_id'   => $val['id'],
                                    $url_screen_var => 1,
                                ];
                            }

                            $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                        }
                        $val['domainurl'] = $domainurl;
                        /*--end*/

                        $result[$key] = $val;
                    }
                }
                break;
            
            default:
                # code...
                break;
        }

        return $result;
    }
}