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

namespace app\home\model;

use think\Model;
use think\Page;
use think\Db;
use app\home\logic\FieldLogic;
/**
 * 文章
 */
class Ershou extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 获取单条记录
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($aid, $field = '', $isshowbody = true)
    {
        $data = array();
        if (!empty($field)) {
            $field_arr = explode(',', $field);
            foreach ($field_arr as $key => $val) {
                $val = trim($val);
                if (preg_match('/^([a-z]+)\./i', $val) == 0) {
                    array_push($data, 'a.'.$val);
                } else {
                    array_push($data, $val);
                }
            }
            $field = implode(',', $data);
        }

        $result = array();
        if ($isshowbody) {
            $field = !empty($field) ? $field : 'd.*,b.*, a.*,c.dirname,c.dirpath,c.parent_id';
            $result = db('archives')->field($field)
                ->alias('a')
                ->join('__ERSHOU_CONTENT__ b', 'b.aid = a.aid', 'LEFT')
                ->join('__ARCTYPE__ c', 'a.typeid = c.id', 'LEFT')
                ->join('__ERSHOU_SYSTEM__ d', 'a.aid = d.aid', 'LEFT')
                ->find($aid);
        } else {
            $field = !empty($field) ? $field : 'a.*';
            $result = db('archives')->field($field)
                ->alias('a')
                ->find($aid);
        }

        // 文章TAG标签
        if (!empty($result)) {
            $typeid = isset($result['typeid']) ? $result['typeid'] : 0;
            $tags = model('Taglist')->getListByAid($aid, $typeid);
            $result['tags'] = $tags;
        }
        if (!empty($result['joinaid'])){
            $xiaoqu = model('Xiaoqu')->getInfo($result['joinaid'],'',true);
            $archivesInfo = M('archives')->field('a.typeid, a.channel,a.status,a.users_id, b.nid, b.ctl_name')
                ->alias('a')
                ->join('__CHANNELTYPE__ b', 'a.channel = b.id', 'LEFT')
                ->where([
                    'a.aid'     => $result['joinaid'],
                    'a.is_del'      => 0,
                ])
                ->find();
            $xiaoqu = view_logic($result['joinaid'], $archivesInfo['channel'], $xiaoqu, true, [ 'huxing' => 'off','photo' => 'off','price' => 'off',],$archivesInfo['ctl_name']); // 模型对应逻辑
            /*自定义字段的数据格式处理*/
            $fieldLogic = new FieldLogic();
            $xiaoqu = $fieldLogic->getChannelFieldList($xiaoqu, $archivesInfo['channel']);
            $result['xiaoqu'] = get_xinfang_info($result['joinaid'],$xiaoqu);

        }

        return $result;
    }
    /*
 * 获取列表数据
 */
    public function getlists($zoom,$city = 0){
        $return['code'] = 1;
        $url_screen_var = config('global.url_screen_var');
        $param_query['m'] = 'home';
        $param_query['c'] = 'Lists';
        $param_query['a'] = 'index';
//        $param_query['tid'] = $this->tid;
        $param_query[$url_screen_var] = 1;
        $where  = $this->search($city);
        $sort = $this->getSort();
        $lists = db('archives')
            ->field("d.*,c.*,b.*,a.*,a.aid as aid")
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join("ershou_content c","a.aid = c.aid",'LEFT')
            ->join("ershou_system d","a.aid = d.aid",'LEFT')
            ->where($where)
            ->order($sort)
            ->select();
        if($lists)
        {
            $sale_list = get_saleman_list();
            foreach ($lists as $key => $val) {
                $param_query['tid'] = $val['typeid'];
                $lists[$key]['litpic'] = handle_subdir_pic($val['litpic']); // 支持子目录
                $lists[$key]['province'] =  !empty($val['province_id'])?get_province_name($val['province_id']):'';
                $lists[$key]['city'] = !empty($val['city_id'])?get_city_name($val['city_id']):'';
                $lists[$key]['area'] = !empty($val['area_id'])?get_area_name($val['area_id']):'';
                $lists[$key]['sale_status_name'] = '';
                $lists[$key]['sale_phone'] = $sale_list[$val['saleman_id']]['saleman_mobile'];
                if ($val['is_jump'] == 1) {
                    $lists[$key]['arcurl'] = $val['jumplinks'];
                } else {
                    $lists[$key]['arcurl'] = arcurl("home/Ershou/index", $val);
                }
                $manage_type_arr = explode(",",$val['manage_type']);
                $lists[$key]['manage_type_name'] = '';
                if ($manage_type_arr){
                    foreach($manage_type_arr as $vo) {
                        $param_query['manage_type'] = $vo;
                        $url = ROOT_DIR.'/index.php?'.http_build_query($param_query);
                        $url = urldecode($url);
                        $lists[$key]['manage_type_name'] .= "<a href='".$url."' target='_blank' rel='nofollow'>$vo</a>  ";
                        $lists[$key]['manage_type_name_i'] = "<i>$vo</i>";
                        unset($param_query['manage_type']);
                    }
                }
                $characteristic_arr = explode(",",$val['characteristic']);
                $lists[$key]['characteristic_name'] = '';
                $lists[$key]['characteristic_name_i'] = '';
                if ($characteristic_arr){
                    foreach($characteristic_arr as $vo) {
                        $param_query['characteristic'] = $vo;
                        $url = ROOT_DIR.'/index.php?'.http_build_query($param_query);
                        $url = urldecode($url);
                        $lists[$key]['characteristic_name'] .= "<a href='".$url."' target='_blank' rel='nofollow'>$vo</a>  ";
                        $lists[$key]['characteristic_name_i'] .= "<i>$vo</i>";
                        unset($param_query['characteristic']);
                    }
                }
            }
            $return['code'] = 1;
            $return['data'] = $lists;
//            if($zoom < 13)
//            {
//                $return['countData'] = $this->countAreaHouse($lists,$city);
//            }
            $return['zoom'] = $zoom;
        }else{
            $return['data'] = [];
        }

        return $return;
    }
    private function getSort()
    {
        $order = "a.aid desc";
        $orderbys = input('param.orderby/s', '');
        $orderways = input('param.orderway/s', '');
        if(!empty($orderbys)){
            $order =  $orderbys." ".$orderways;
        }

        return $order;
    }
    /**
     * @return array
     * 搜索条件
     */
    private function search($city = 0)
    {
        $param_new = input('param.');
        $condition[] = "a.channel = 12";
        $condition[] = "a.status =1";
        $condition[] = "a.is_del = 0";
        if(!empty($param_new['keyword'])){
            array_push($condition, "a.title LIKE '%{$param_new['keyword']}%'");
        }
        $where = [
            'is_screening' => 1,
            'channel_id'=> 12
            // 根据需求新增条件
        ];

        $channelfield = db('channelfield')->where($where)->field('channel_id,id,name,dtype,define,dfvalue')->select();
        foreach ($channelfield as $key => $value) {
            // 值不为空则执行
            if (!empty($param_new[$value['name']])) {
                $name = $value['name'];
                if (!empty($name)) {
                    if ($value['define'] == 'config'){    //配置文件定义数值区间
                        $dfvalue = config($value['dfvalue']);
                        !empty($dfvalue[$param_new[$name]]['sql']) && array_push($condition, $name." ".$dfvalue[$param_new[$name]]['sql']);
                        continue;
                    }
                    if (in_array($value['dtype'],['int','decimal','float'])){   //后台定义数值区间
                        $list = explode(',',$param_new[$name]);
                        if (count($list) >1){
                            array_push($condition, $name." between {$list[0]} and {$list[1]} ");
                        }else{
                            array_push($condition, $name."> {$list[0]} ");
                        }
                        continue;
                    }
                    if (empty($param_new[$name]) || is_numeric($param_new[$name])){   //数字
                        array_push($condition, $name." = '".$param_new[$name]."'");
                        continue;
                    }

                    // 分割参数，判断多选或单选，拼装sql语句
                    $val  = explode('|', $param_new[$name]);
                    if (!empty($val) && !empty($val[0])) {
                        array_push($condition, "(FIND_IN_SET('".$val[0]."',".$name."))");
                    }
                }
            }
        }
        $bssw_lat            = input('get.bssw_lat');//地图可视区域左下角经度
        $bssw_lng            = input('get.bssw_lng');//地图可视区域左上角纬度
        $bsne_lat            = input('get.bsne_lat');//地图可视区域右下角经度
        $bsne_lng            = input('get.bsne_lng');//地图可视区域右上角纬度
        if($bsne_lat && $bssw_lat && $bssw_lng && $bsne_lng)
        {
            array_push($condition, "lat between ".min($bssw_lat,$bsne_lat)." and ".max($bssw_lat,$bsne_lat));
            array_push($condition, "lng between ".min($bssw_lng,$bsne_lng)." and ".max($bssw_lng,$bsne_lng));
        }
        $condition_str = "";
        if (0 < count($condition)) {
            $condition_str = implode(" AND ", $condition);
        }

        return $condition_str;
    }
}