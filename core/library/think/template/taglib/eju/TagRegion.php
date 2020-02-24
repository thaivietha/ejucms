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

namespace think\template\taglib\eju;

use think\Db;
use think\Request;

/**
 * 区域列表
 */
class TagRegion extends Base
{
    public $currentstyle = '';
    public $subDomain = '';
    public $opencity = ''; // 子域名开启的级别（1=省份，2=城市，3=市县），支持 1,2 写法
    public $field = '';
    public $web_region_domain = null;
    public $url_screen_var = null;
    public $orderby;
    public $orderway = 'desc';
    public $ishot;
    public $typeid = '';
    public $channel = '';
    public $groupby = '';

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->subDomain = request()->subDomain(); // 子域名
        $this->field = 'id,name,level,parent_id,initial,litpic,domain';
        $this->web_region_domain = tpCache('web.web_region_domain'); // 是否开启子站点
        $this->url_screen_var = config('global.url_screen_var'); // 筛选动态标识
    }

    /**
     * 获取指定级别的区域列表
     * @param string type son表示下一级区域,self表示同级区域,top顶级区域
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getRegion($type = 'top', $currentstyle = '', $opencity = '', $domain = '', $orderby = '', $orderway = '', $ishot = '',$typeid = '',$channel = '',$groupby = '')
    {
        $this->currentstyle = $currentstyle;
        $this->opencity = !empty($opencity) ? explode(',', str_replace('，', ',', $opencity)) : [];
        $this->groupby = $groupby;
        empty($domain) && $this->subDomain != 'www' && $this->subDomain != 'm' &&  $domain = $this->subDomain;
        if (empty($domain)) {
            $regionInfo = \think\Cookie::get("regionInfo");
            if(is_json($regionInfo))
            {
                $regionInfo = json_decode($regionInfo,true);
            }
            if (!empty($regionInfo['domain'])) {
                $domains[] = $regionInfo['domain'];
            } else {
                $domains[] = Db::name('region')->where(['is_default'=>1])->getField('domain');
            }
        } else {
            $domains = explode(',', str_replace('，', ',', $domain));
        }
        !empty($orderway) && $this->orderway = $orderway;
        $this->ishot = $ishot;

        switch ($orderby) {
            case 'hot':
                $this->orderby = "is_hot {$this->orderway}, sort_order asc, initial asc, id asc";
                break;
            
            default:
                $this->orderby = "sort_order asc, initial asc, id asc";
                break;
        }
        !empty($typeid) && $this->typeid = $typeid;
        !empty($channel) && $this->channel = $channel;
        $result = $this->getSwitchRegion($domains, $type);

        return $result;
    }

    /**
     * 获取指定级别的区域列表
     * @param string type son表示下一级区域,self表示同级区域,top顶级区域
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getSwitchRegion($domain = '', $type = 'top')
    {
        $result = array();
        switch ($type) {
            case 'son': // 下级区域
                $result = $this->getSon($domain, false);
                break;

            case 'self': // 同级同上级区域
                $result = $this->getSelf($domain);
                break;
            case 'selflevel':    //所有同级区域（不一定同上级，比如获取全国城市集合）
                $result = $this->getLevel($domain);
                break;
            case 'top': // 顶级区域
                $result = $this->getTop();
                break;

            case 'sonself': // 下级、同级区域
                $result = $this->getSon($domain, true);
                break;
        }
        if (!empty($this->groupby)){
            $result = $this->setGroup($result,$this->groupby);
        }

        return $result;
    }

    /**
     * 获取下一级区域
     * @param string $self true表示没有子区域时，获取同级区域
     * @author wengxianhu by 2017-7-26
     */
    public function getSon($domain, $self = false)
    {
        $result = [];
        if (!empty($this->typeid)){
            $firstTypeid = $this->typeid;
        }else if (!empty($this->channel)){
            $firstTypeid = model('Arctype')->getFristTypeid($this->channel); // 指定模型的第一个区域ID
        }else{
            $firstTypeid = model('Arctype')->getFristTypeid(9); // 指定模型的第一个区域ID
        }
        /*获取当前或者指定的区域*/
        $row = M('region')->field($this->field)
            ->where([
                'domain'    => ['IN', $domain],
//                'level' => ['elt', 2],
                'status'  => 1,
            ])
            ->order($this->orderby)
            // ->cache(true,EYOUCMS_CACHE_TIME,"region")
            ->select();
        if (empty($row)) {
            return $result;
        }
        /*end*/
        foreach ($row as $key => $val) {
            // 封面图
            $row[$key]['litpic'] = handle_subdir_pic($row[$key]['litpic']);
            if (3 == $row[$key]['level']) { // 三级区域
                // 获取该二级区域
                $map = [
                    'id'    => $row[$key]['parent_id'],
                ];
                if ($this->ishot == 'off') {
                    $map['is_hot'] = 1;
                } else if ($this->ishot == 'on') {
                    $map['is_hot'] = 0;
                }
                $row1 = M('region')->field($this->field)
                    ->where($map)
                    ->order($this->orderby)
                    // ->cache(true,EYOUCMS_CACHE_TIME,"region")
                    ->find();
                /*区域的URL*/
                if (!empty($this->web_region_domain) && !empty($row['domain']) && (empty($this->opencity) || in_array($row['level'], $this->opencity))) {
                    $domainurl = getRegionDomainUrl($row['domain']);
                } else {
                    $vars = [
                        'tid'           => $firstTypeid,
                        'province_id'   => $row1['parent_id'],
                        'city_id'       => $row[$key]['parent_id'],
                        'area_id'       => $row[$key]['id'],
                        $this->url_screen_var => 1,
                    ];
                    $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                }
                $row[$key]['domainurl'] = $domainurl;
                /*--end*/

                $row[$key]['currentstyle'] = $this->currentstyle;
                $row[$key]['has_children']    = 0;
                $row[$key]['children']    = [];

                $result = $row;
            }else if (2 == $row[$key]['level'])
            {
                /*获取三级区域*/
                $map = [
                    'parent_id' => $row[$key]['id'],
                    'status'  => 1,
                ];
                if ($this->ishot == 'off') {
                    $map['is_hot'] = 1;
                } else if ($this->ishot == 'on') {
                    $map['is_hot'] = 0;
                }
                $row3 = M('region')->field($this->field)
                    ->where($map)
                    ->order($this->orderby)
                    // ->cache(true,EYOUCMS_CACHE_TIME,"region")
                    ->select();
                if (empty($row3) && $self === true) { // 没有子区域，获取同级区域
                    $map = [
                        'parent_id' => $row[$key]['parent_id'],
                        'status'  => 1,
                    ];
                    if ($this->ishot == 'off') {
                        $map['is_hot'] = 1;
                    } else if ($this->ishot == 'on') {
                        $map['is_hot'] = 0;
                    }
                    $row3 = M('region')->field($this->field)
                        ->where($map)
                        ->order($this->orderby)
                        // ->cache(true,EYOUCMS_CACHE_TIME,"region")
                        ->select();
                }
                $res3 = [];
                foreach($row3 as $k3 => $v3){
                    // 封面图
                    $v3['litpic'] = handle_subdir_pic($v3['litpic']);

                    /*区域的URL*/
                    if (!empty($this->web_region_domain) && !empty($v3['domain']) && (empty($this->opencity) || in_array($v3['level'], $this->opencity))) {
                        $domainurl = getRegionDomainUrl($v3['domain']);
                    } else {
                        $vars = [
                            'tid'           => $firstTypeid,
                            'province_id'   => $row[$key]['parent_id'],
                            'city_id'       => $v3['parent_id'],
                            'area_id'       => $v3['id'],
                            $this->url_screen_var => 1,
                        ];
                        $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                    }
                    $v3['domainurl'] = $domainurl;
                    /*--end*/
                    /*区域焦点*/
                    $v3['currentstyle'] = '';
                    if ($this->subDomain == $v3['domain']) {
                        $v3['currentstyle'] = $this->currentstyle;
                    }
                    /*end*/
                    $v3['has_children']    = 0;
                    $v3['children']    = [];
                    $res3[] = $v3;
                }
                /*--end*/
                $result = $res3;
            }else if (1 == $row[$key]['level'])
            {
                $result = [];
                $arr1 = $this->getTop($domain);
                $arr = convert_arr_key($arr1, 'domain');
                if ($self === true) {
                    $result = $arr1;
                } else {
                    foreach ($domain as $key => $val) {
                        $children = !empty($arr[$val]['children']) ? $arr[$val]['children'] : [];
                        $result = array_merge($result, $children);
                    }
                }
            }
        }
        /*没有子区域时，获取同级区域*/
        if (empty($result) && $self == true) {
            $result = $this->getSelf($domain);
        }
        /*--end*/


        return $result;
    }
    /*
     *  获取所有同级区域
     */
    public function getLevel($domain = []){
        $result = array();
        if (empty($domain)) {
            return $result;
        }
        if (!empty($this->typeid)){
            $firstTypeid = $this->typeid;
        }else if (!empty($this->channel)){
            $firstTypeid = model('Arctype')->getFristTypeid($this->channel); // 指定模型的第一个区域ID
        }else{
            $firstTypeid = model('Arctype')->getFristTypeid(9); // 指定模型的第一个区域ID
        }
        /*获取指定区域域名的上一级区域域名列表*/
        $map = array(
            'domain'   => array('in', $domain),
            'status'  => 1,
        );
        $res = M('region')->field('level')
            ->where($map)
            ->group('level')
            ->select();
        $levelArr = get_arr_column($res, 'level');
        $map = array(
            'status'    => 1,
            'level'    => ['IN', $levelArr],
        );
        if ($this->ishot == 'off') {
            $map['is_hot'] = 1;
        } else if ($this->ishot == 'on') {
            $map['is_hot'] = 0;
        }
        $row = M('region')->field($this->field)
            ->where($map)
            ->order($this->orderby)
            ->group('domain')
            ->select();
        /*--end*/
        foreach ($row as $key => $val) {
            // 封面图
            $row[$key]['litpic'] = handle_subdir_pic($row[$key]['litpic']);
            if (3 == $row[$key]['level']) { // 三级区域
                // 获取该二级区域
                $map = [
                    'id'    => $row[$key]['parent_id'],
                ];
                if ($this->ishot == 'off') {
                    $map['is_hot'] = 1;
                } else if ($this->ishot == 'on') {
                    $map['is_hot'] = 0;
                }
                $row1 = M('region')->field($this->field)
                    ->where($map)
                    ->order($this->orderby)
                    // ->cache(true,EYOUCMS_CACHE_TIME,"region")
                    ->find();
                /*区域的URL*/
                if (!empty($this->web_region_domain) && !empty($val['domain']) && (empty($this->opencity) || in_array($val['level'], $this->opencity))) {
                    $domainurl = getRegionDomainUrl($val['domain']);
                } else {
                    $vars = [
                        'tid'           => $firstTypeid,
                        'province_id'   => $row1['parent_id'],
                        'city_id'       => $row[$key]['parent_id'],
                        'area_id'       => $row[$key]['id'],
                        $this->url_screen_var => 1,
                    ];
                    $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                }
                $row[$key]['domainurl'] = $domainurl;
                /*--end*/
                if (in_array($val['domain'], $domain)) {
                    $row[$key]['currentstyle'] = $this->currentstyle;
                }
                $row[$key]['has_children']    = 0;
                $row[$key]['children']    = [];
                $result = $row;
            }else if (2 == $row[$key]['level'])
            {
                if (!empty($this->web_region_domain) && !empty($val['domain']) && (empty($this->opencity) || in_array($val['level'], $this->opencity))) {
                    $domainurl = getRegionDomainUrl($val['domain']);
                } else {
                    $vars = [
                        'tid'           => $firstTypeid,
                        'province_id'   => $row[$key]['parent_id'],
                        'city_id'       => $row[$key]['id'],
                        $this->url_screen_var => 1,
                    ];
                    $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                }
                $row[$key]['domainurl'] = $domainurl;
                /*--end*/
                if (in_array($val['domain'], $domain)) {
                    $row[$key]['currentstyle'] = $this->currentstyle;
                }
                $row[$key]['has_children']    = 0;
                $row[$key]['children']    = [];
                $result = $row;
            }else if (1 == $row[$key]['level'])
            {
                if (!empty($this->web_region_domain) && !empty($val['domain']) && (empty($this->opencity) || in_array($val['level'], $this->opencity))) {
                    $domainurl = getRegionDomainUrl($val['domain']);
                } else {
                    $vars = [
                        'tid'           => $firstTypeid,
                        'province_id'   => $row[$key]['id'],
                        $this->url_screen_var => 1,
                    ];
                    $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                }
                $row[$key]['domainurl'] = $domainurl;
                /*--end*/
                if (in_array($val['domain'], $domain)) {
                    $row[$key]['currentstyle'] = $this->currentstyle;
                }
                $row[$key]['has_children']    = 0;
                $row[$key]['children']    = [];
                $result = $row;
            }
        }
        /*没有子区域时，获取同级区域*/
        if (empty($result)) {
            $result = $this->getTop();
        }
        /*--end*/


        return $result;
    }
    /*
     * 数据按照指定条件分组
     */
    public function setGroup($row,$type = 'initial'){
        $parent = [];
        if ($type == 'parent_id'){
            $parent_arr = get_arr_column($row,$type);
            $parent = M('region')->field($this->field)
                ->where(['id'=>['IN',$parent_arr]])
                ->group('domain')
                ->order($this->orderby)
                ->select();
            $parent = convert_arr_key($parent,'id');
        }
        $result = array();
        foreach($row as $key => $val){
            if ($type == 'parent_id'){
                $result[$parent[$val[$type]]['name']][] = $val;
            }else{
                $result[$val[$type]][] = $val;
            }
        }
//        var_dump($result);die();

        return $result;
    }
    /**
     * 获取同级区域
     * @author wengxianhu by 2017-7-26
     */
    public function getSelf($domain = [])
    {
        $result = array();
        if (empty($domain)) {
            return $result;
        }

        /*获取指定区域域名的上一级区域域名列表*/
        $map = array(
            'domain'   => array('in', $domain),
            'status'  => 1,
        );
        $res = M('region')->field('parent_id')
            ->where($map)
            ->group('parent_id')
            ->select();
        $pidArr = get_arr_column($res, 'parent_id');
        $map = array(
            'status'    => 1,
            'parent_id'    => ['IN', $pidArr],
        );
        if ($this->ishot == 'off') {
            $map['is_hot'] = 1;
        } else if ($this->ishot == 'on') {
            $map['is_hot'] = 0;
        }
        $res = M('region')->field('domain')
            ->where($map)
            ->group('domain')
            ->select();
        /*--end*/

        /*获取上一级区域域名对应下的子孙区域*/
        if ($res) {
            $domainArr = get_arr_column($res, 'domain');
            if (empty($domainArr)) {
                $result = $this->getTop();
            } else {
                $result = $this->getSon($domainArr, true);
            }
        }
        /*--end*/

        return $result;
    }

    /**
     * 获取顶级区域
     * @author wengxianhu by 2017-7-26
     */
    public function getTop($domain = [])
    {
        if (!empty($this->typeid)){
            $firstTypeid = $this->typeid;
        }else if (!empty($this->channel)){
            $firstTypeid = model('Arctype')->getFristTypeid($this->channel); // 指定模型的第一个区域ID
        }else{
            $firstTypeid = model('Arctype')->getFristTypeid(9); // 指定模型的第一个区域ID
        }

        /*获取一级区域*/
        $map = [
            'level' => 1,
            'status'  => 1,
        ];
        if ($this->ishot == 'off') {
            $map['is_hot'] = 1;
        } else if ($this->ishot == 'on') {
            $map['is_hot'] = 0;
        }
        !empty($domain) && $map['domain'] = ['IN', $domain];
        $row1 = M('region')->field($this->field)
            ->where($map)
            ->order($this->orderby)
            // ->cache(true,EYOUCMS_CACHE_TIME,"region")
            ->select();
        $idArr1 = [];
        $res1 = [];
        foreach($row1 as $key => $val){
            // 收集一级区域的ID
            $idArr1[] = $val['id']; 

            // 封面图
            $val['litpic'] = handle_subdir_pic($val['litpic']);

            /*区域的URL*/
            if (!empty($this->web_region_domain) && !empty($val['domain']) && (empty($this->opencity) || in_array($val['level'], $this->opencity))) {
                $domainurl = getRegionDomainUrl($val['domain']);
            } else {
                $vars = [
                    'tid'           => $firstTypeid,
                    'province_id'   => $val['id'],
                    $this->url_screen_var => 1,
                ];
                $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
            }
            $val['domainurl'] = $domainurl;
            /*--end*/

            /*区域焦点*/
            $val['currentstyle'] = '';
            if (in_array($val['domain'], $domain)) {
                $val['currentstyle'] = $this->currentstyle;
            }
            /*end*/

            $res1[$val['id']] = $val;       
        }

        /*--end*/

        /*获取二级区域*/
        $map = [
            'parent_id' => ['IN', $idArr1],
            'status'  => 1,
        ];
        if ($this->ishot == 'off') {
            $map['is_hot'] = 1;
        } else if ($this->ishot == 'on') {
            $map['is_hot'] = 0;
        }
        $row2 = M('region')->field($this->field)
            ->where($map)
            ->order($this->orderby)
            // ->cache(true,EYOUCMS_CACHE_TIME,"region")
            ->select();
        $res2Group = [];
        $idArr2 = [];
        $res2 = [];
        foreach($row2 as $key => $val){
            // 收集二级区域的ID
            $idArr2[] = $val['id']; 
        
            // 封面图
            $val['litpic'] = handle_subdir_pic($val['litpic']);

            /*区域的URL*/
            if (!empty($this->web_region_domain) && !empty($val['domain']) && (empty($this->opencity) || in_array($val['level'], $this->opencity))) {
                $domainurl = getRegionDomainUrl($val['domain']);
            } else {
                $vars = [
                    'tid'           => $firstTypeid,
                    'province_id'   => $val['parent_id'],
                    'city_id'       => $val['id'],
                    $this->url_screen_var => 1,
                ];
                $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
            }
            $val['domainurl'] = $domainurl;
            /*--end*/

            /*区域焦点*/
            $val['currentstyle'] = '';
            if (in_array($val['domain'], $domain)) {
                $val['currentstyle'] = $this->currentstyle;
            }
            /*end*/

            $val['has_children']    = 0;
            $val['children']    = [];

            $res2[$val['id']] = $val;

            /*分组归类*/
            if (!isset($res2Group[$val['parent_id']]))
            {
                $res2Group[$val['parent_id']] = [$val];
            } else {
                $res2Group[$val['parent_id']][] = $val;
            }
            /*end*/
        }
        /*--end*/

        /*获取三级区域*/
        $map = [
            'parent_id' => ['IN', $idArr2],
            'status'  => 1,
        ];
        if ($this->ishot == 'off') {
            $map['is_hot'] = 1;
        } else if ($this->ishot == 'on') {
            $map['is_hot'] = 0;
        }
        $row3 = M('region')->field($this->field)
            ->where($map)
            ->order($this->orderby)
            // ->cache(true,EYOUCMS_CACHE_TIME,"region")
            ->select();
        $res3Group = [];
        $res3 = [];
        foreach($row3 as $key => $val){
            // 封面图
            $val['litpic'] = handle_subdir_pic($val['litpic']);

            /*区域的URL*/
            if (!empty($this->web_region_domain) && !empty($val['domain']) && (empty($this->opencity) || in_array($val['level'], $this->opencity))) {
                $domainurl = getRegionDomainUrl($val['domain']);
            } else {
                $vars = [
                    'tid'           => $firstTypeid,
                    'province_id'   => $res2[$val['parent_id']]['parent_id'],
                    'city_id'       => $val['parent_id'],
                    'area_id'       => $val['id'],
                    $this->url_screen_var => 1,
                ];
                $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
            }

            $val['domainurl'] = $domainurl;
            /*--end*/

            /*区域焦点*/
            $val['currentstyle'] = '';
            if (in_array($val['domain'], $domain)) {
                $val['currentstyle'] = $this->currentstyle;
            }
            /*end*/

            $val['has_children']    = 0;
            $val['children']    = [];

            $res3[$val['id']] = $val;

            /*分组归类*/
            if (!isset($res3Group[$val['parent_id']]))
            {
                $res3Group[$val['parent_id']] = [$val];
            } else {
                $res3Group[$val['parent_id']][] = $val;
            }
            /*end*/
        }
        /*--end*/

        foreach($res2Group as $key => $subGroup){
            foreach($subGroup as $k2 => $v2){
                $children = !empty($res3Group[$v2['id']]) ? $res3Group[$v2['id']] : [];
                $v2['has_children']    = count($children);
                $v2['children']    = $children;
                $res2Group[$key][$k2] = $v2;
            }
        }

        $result = [];
        foreach($res1 as $key => $val){
            $children = !empty($res2Group[$val['id']]) ? $res2Group[$val['id']] : [];
            $val['has_children']    = count($children);
            $val['children']    = $children;
            $result[] = $val;
        }

        return $result;
    }
}