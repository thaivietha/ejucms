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

use think\Page;
use think\Request;
use app\home\logic\FieldLogic;
use think\Db;

/**
 * 文章分页列表
 */
class TagList extends Base
{
    public $tid = '';
    public $fieldLogic;
    public $url_screen_var;

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->fieldLogic = new FieldLogic();
        $this->tid = input('param.tid/s', '');

        /*应用于文档列表*/
        $aid = input('param.aid/d', 0);
        if ($aid > 0) {
            $this->tid = M('archives')->where('aid', $aid)->getField('typeid');
        }
        /*--end*/
        /*typeid|tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);
        /*--end*/

        // 定义筛选标识
        $this->url_screen_var = config('global.url_screen_var');
    }

    /**
     * 获取分页列表
     * @author wengxianhu by 2018-4-20
     */
    public function getList($param = array(), $pagesize = 10, $orderby = '', $addfields = '', $orderway = '', $thumb = '')
    {
        $module_name_tmp = strtolower(request()->module());
        $ctl_name_tmp = strtolower(request()->controller());
        $action_name_tmp = strtolower(request()->action());
        empty($orderway) && $orderway = 'desc';

        /*搜索、标签搜索(全局搜索)*/
        if (in_array($ctl_name_tmp, array('search','tags'))) {
            return $this->getSearchList($pagesize, $orderby, $addfields, $orderway);
        }
        /*--end*/

        /*自定义字段筛选,排序字段*/
        $channeltype = ("" != $param['channel'] && is_numeric($param['channel'])) ? intval($param['channel']) : '';
        $param['typeid'] = !empty($param['typeid']) ? $param['typeid'] : $this->tid;

        if (!empty($param['typeid'])) {
            if (!preg_match('/^\d+([\d\,]*)$/i', $param['typeid'])) {
                echo '标签list报错：typeid属性值语法错误，请正确填写栏目ID。';
                return false;
            }
            // 过滤typeid中含有空值的栏目ID
            $typeidArr_tmp = explode(',', $param['typeid']);
            $typeidArr_tmp = array_unique($typeidArr_tmp);
            foreach($typeidArr_tmp as $k => $v){   
                if (empty($v)) unset($typeidArr_tmp[$k]);  
            }
            $param['typeid'] = implode(',', $typeidArr_tmp);
            // end
        }

        $typeid = $param['typeid'];
        
        /*不指定模型ID、栏目ID，默认显示所有可以发布文档的模型ID下的文档*/
        if (("" === $channeltype && empty($typeid)) || 0 === $channeltype) {
            $allow_release_channel = config('global.allow_release_channel');
            $channeltype = $param['channel'] = implode(',', $allow_release_channel);
        }
        /*--end*/

        // 如果指定了频道ID，则频道下的所有文档都展示
        if (!empty($channeltype)) { // 优先展示模型下的文章
            unset($param['typeid']);
        } elseif (!empty($typeid)) { // 其次展示栏目下的文章
            // unset($param['channel']);
            $typeidArr = explode(',', $typeid);
            if (count($typeidArr) == 1) {
                $typeid = intval($typeid);
                $channel_info = M('Arctype')->field('id,current_channel')->where(array('id'=>$typeid))->find();
                if (empty($channel_info)) {
                    echo '标签list报错：指定属性 typeid 的栏目ID不存在。';
                    return false;
                }
                $channeltype = !empty($channel_info) ? $channel_info["current_channel"] : '';

                /*获取当前栏目下的同模型所有子孙栏目*/
                $arctype_list = model("Arctype")->getHasChildren($channel_info['id']);
                foreach ($arctype_list as $key => $val) {
                    if ($channeltype != $val['current_channel']) {
                        unset($arctype_list[$key]);
                    }
                }
                $typeids = get_arr_column($arctype_list, "id");
                !in_array($typeid, $typeids) && $typeids[] = $typeid;
                $typeid = implode(",", $typeids);
                $param['typeid'] = $typeid;
                /*--end*/
            } elseif (count($typeidArr) > 1) {
                $firstTypeid = $typeidArr[0];
                $firstTypeid = M('Arctype')->where(array('id|dirname'=>array('eq', $firstTypeid)))->getField('id');
                $channeltype = M('Arctype')->where(array('id'=>array('eq', $firstTypeid)))->getField('current_channel');
            }
            $param['channel'] = $channeltype;
        } else { // 再次展示控制器对应的模型文章
            $controller_name = request()->controller();
            $channeltype_info = model('Channeltype')->getInfoByWhere(array('ctl_name'=>$controller_name), 'id');
            if (!empty($channeltype_info)) {
                $channeltype = $channeltype_info['id'];
                $param['channel'] = $channeltype;
            }
        }

        /*        if (empty($typeid) && empty($channeltype)) {
                    echo '标签list报错：至少指定属性 typeid | channelid 任何一个。';
                    return $result;
                }*/
        $param = array_merge(input('param.'), $param);

        return $this->GetFieldScreeningList($param,$pagesize, $orderby, $addfields, $orderway, $thumb);

    }

    /**
     * 获取搜索分页列表
     * @author wengxianhu by 2018-4-20
     */
    public function getSearchList($pagesize = 10, $orderby = '', $addfields = '', $orderway = '', $thumb = '')
    {
        $result = false;
        empty($orderway) && $orderway = 'desc';

        $condition = array();
        // 获取到所有URL参数
        $param = input('param.');

        if (strtolower(request()->controller()) == 'tags') {
            $tag = input('param.tag/s', '');
            $tagid = input('param.tagid/d', 0);
            if (!empty($tag)) {
                $tagidArr = M('tagindex')->where(array('tag'=>array('LIKE', "%{$tag}%")))->column('id', 'id');
                $aidArr = M('taglist')->field('aid')->where(array('tid'=>array('in', $tagidArr)))->column('aid', 'aid');
                $condition['aid'] = array('in', $aidArr);
            } elseif ($tagid > 0) {
                $aidArr = M('taglist')->field('aid')->where(array('tid'=>array('eq', $tagid)))->column('aid', 'aid');
                $condition['aid'] = array('in', $aidArr);
            }
        }

        // 应用搜索条件
        foreach (['keywords','typeid','notypeid','channelid','flag','noflag'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ('keywords' == $key) {
                    $keywords = trim($param[$key]);
                    $condition['a.title'] = array('LIKE', "%{$keywords}%");
                } else if (in_array($key, array('typeid'))) {
                    $param[$key] = str_replace('，', ',', $param[$key]);
                    $condition['a.'.$key] = array('in', $param[$key]);
                } elseif ($key == 'channelid') {
                    $condition['a.channel'] = array('eq', $param[$key]);
                } elseif ($key == 'notypeid') {
                    $param[$key] = str_replace('，', ',', $param[$key]);
                    $condition['a.typeid'] = array('not in', $param[$key]);
                } elseif ($key == 'flag') {
                    $flag_arr = explode(",", $param[$key]);
                    $where_or_flag = array();
                    foreach ($flag_arr as $k2 => $v2) {
                        if ($v2 == "c") {
                            array_push($where_or_flag, "a.is_recom = 1");
                        } elseif ($v2 == "h") {
                            array_push($where_or_flag, "a.is_head = 1");
                        } elseif ($v2 == "a") {
                            array_push($where_or_flag, "a.is_special = 1");
                        } elseif ($v2 == "j") {
                            array_push($where_or_flag, "a.is_jump = 1");
                        } elseif ($v2 == "p") {
                            array_push($where_or_flag, "a.is_litpic = 1");
                        } elseif ($v2 == "b") {
                            array_push($where_or_flag, "a.is_b = 1");
                        }
                    }
                    if (!empty($where_or_flag)) {
                        $where_flag_str = " (".implode(" OR ", $where_or_flag).") ";
                        array_push($condition, $where_flag_str);
                    } 
                } elseif ($key == 'noflag') {
                    $flag_arr = explode(",", $param[$key]);
                    $where_or_flag = array();
                    foreach ($flag_arr as $nk2 => $nv2) {
                        if ($nv2 == "c") {
                            array_push($where_or_flag, "a.is_recom <> 1");
                        } elseif ($nv2 == "h") {
                            array_push($where_or_flag, "a.is_head <> 1");
                        } elseif ($nv2 == "a") {
                            array_push($where_or_flag, "a.is_special <> 1");
                        } elseif ($nv2 == "j") {
                            array_push($where_or_flag, "a.is_jump <> 1");
                        } elseif ($nv2 == "p") {
                            array_push($where_or_flag, "a.is_litpic <> 1");
                        } elseif ($nv2 == "b") {
                            array_push($where_or_flag, "a.is_b <> 1");
                        }
                    }
                    if (!empty($where_or_flag)) {
                        $where_flag_str = " (".implode(" OR ", $where_or_flag).") ";
                        array_push($condition, $where_flag_str);
                    }
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }
        $condition['a.arcrank'] = array('gt', -1);
        $condition['a.status'] = array('eq', 1);
        $condition['a.is_del'] = array('eq', 0); // 回收站功能

        // 给排序字段加上表别名
        $orderby = getOrderBy($orderby,$orderway);

        /**
         * 数据查询，搜索出主键ID的值
         */
        $list = array();
        $query_get = input('get.');
        $paginate_type = config('paginate.type');
        if (isMobile()) {
            $paginate_type = 'mobile';
        }
        $paginate = array(
            'type'  => $paginate_type,
            'var_page' => config('paginate.var_page'),
            'query' => $query_get,
        );
        $pages = db('archives')
            ->field("a.aid")
            ->alias('a')
            ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
            ->where('a.channel','NOT IN',[6]) // 排除单页
            ->where($condition)
            ->order($orderby)
            ->paginate($pagesize, false, $paginate);

        /**
         * 完善数据集信息
         * 在数据量大的情况下，经过优化的搜索逻辑，先搜索出主键ID，再通过ID将其他信息补充完整；
         */
        if ($pages->total() > 0) {
            $list = $pages->items();
            $aids = get_arr_column($list, 'aid');
            $fields = "b.*, a.*";
            $row = db('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            // 获取模型对应的控制器名称
            $channel_list = model('Channeltype')->getAll('id, ctl_name', array(), 'id');

            foreach ($list as $key => $val) {
                $arcval = $row[$val['aid']];
                $controller_name = $channel_list[$arcval['channel']]['ctl_name'];
                /*获取指定路由模式下的URL*/
                if ($arcval['is_part'] == 1) {
                    $arcval['typeurl'] = $arcval['typelink'];
                } else {
                    $arcval['typeurl'] = typeurl('home/'.$controller_name."/lists", $arcval);
                }
                /*--end*/
                /*文档链接*/
                if ($arcval['is_jump'] == 1) {
                    $arcval['arcurl'] = $arcval['jumplinks'];
                } else {
                    $arcval['arcurl'] = arcurl('home/'.$controller_name."/view", ['aid'   => $arcval['aid'], 'dirname'   => $arcval['dirname']]);
                }
                /*--end*/
                /*封面图*/
                $arcval['litpic'] = get_default_pic($arcval['litpic']); // 默认封面图
                if ('on' == $thumb) { // 属性控制是否使用缩略图
                    $arcval['litpic'] = thumb_img($arcval['litpic']);
                }
                /*--end*/

                $list[$key] = $arcval;
            }

            /*附加表*/
            if (!empty($addfields) && !empty($list)) {
                $channeltypeRow = model('Channeltype')->getAll('id,table', [], 'id'); // 模型对应数据表
                $channelGroupRow = group_same_key($list, 'current_channel'); // 模型下的文档集合
                foreach ($channelGroupRow as $channelid => $tmp_list) {
                    $addtableName = ''; // 附加字段的数据表名
                    $tmp_aid_arr = get_arr_column($tmp_list, 'aid');
                    $channeltype_table = $channeltypeRow[$channelid]['table']; // 每个模型对应的数据表

                    $addfields = str_replace('，', ',', $addfields); // 替换中文逗号
                    $addfields = trim($addfields, ',');
                    $addtableName = $channeltype_table.'_content';
                    $resultExt = M($addtableName)->field("aid,$addfields")->where('aid','in',$tmp_aid_arr)->getAllWithIndex('aid');
                    /*自定义字段的数据格式处理*/
                    $resultExt = $this->fieldLogic->getChannelFieldList($resultExt, $channelid, true);
                    /*--end*/
                    foreach ($list as $key2 => $val2) {
                        $valExt = !empty($resultExt[$val2['aid']]) ? $resultExt[$val2['aid']] : array();
                        $val2 = array_merge($valExt, $val2);
                        $list[$key2] = $val2;
                    }
                }
            }
            /*--end*/
        }
        $result['pages'] = $pages; // 分页显示输出
        $result['list'] = $list; // 赋值数据集
        $result['count'] = $pages->total();  //数据总数
        return $result;
    }


    /**
     * 获取搜索分页列表
     * @author 陈风任 by 2019-6-11
     */
    public function GetFieldScreeningList($param_new = array(),$pagesize = 10, $orderby = '', $addfields = '', $orderway = '', $thumb = '')
    {
        $result = false;
        empty($orderway) && $orderway = 'desc';

        $condition = array();

        if (empty($param_new['channel'])) {
            echo '标签list报错：未找到对应模型ID。';
            return false;
        }
        // 所有应用于搜索的自定义字段
        $where = [
//            'is_screening' => 1,
            'channel_id'=> $param_new['channel']
            // 根据需求新增条件
        ];
        $channelfield = db('channelfield')->where($where)->field('channel_id,id,name,dtype,define,dfvalue,ifmain,is_screening')->select();
        $regionInfo = \think\Cookie::get("regionInfo");
        if(is_json($regionInfo))
        {
            $regionInfo = json_decode($regionInfo,true);
        }
        $orderbys = input('param.orderby/s', '');
        $hava_system = $if_system = $if_content = 0;    //是否筛选(存在)从表
        foreach ($channelfield as $key => $value) {
            $fieldname = $value['name'];
            if (!empty($fieldname)) {
                if (!empty($orderbys) && $orderbys == $fieldname && $value['ifmain'] == 2){
                    $if_system = 1;
                }else if (!empty($orderbys) && $orderbys == $fieldname && $value['ifmain'] == 0){
                    $if_content = 1;
                }
                if ($value['ifmain'] == 2){
                    $hava_system = 1;
                }
                if (!empty($param_new[$fieldname]) && !empty($value['is_screening'])) {
                    // $param_new[$fieldname] = func_preg_replace(['"','\'',';'], '', $param_new[$fieldname]);
                    $param_new[$fieldname] = addslashes($param_new[$fieldname]);
                    if ($value['ifmain'] == 2){
                        $if_system = 1;
                    }else if ($value['ifmain'] == 0){
                        $if_content = 1;
                    }
                    if ($value['define'] == 'config'){    //配置文件定义数值区间
                        $dfvalue = config($value['dfvalue']);
                        !empty($dfvalue[$param_new[$fieldname]]['sql']) && array_push($condition, $fieldname." ".$dfvalue[$param_new[$fieldname]]['sql']);
                        continue;
                    }
                    if (in_array($value['dtype'],['int','decimal','float'])){   //后台定义数值区间
                        $list = explode(',',$param_new[$fieldname]);
                        if (count($list) >1){
                            array_push($condition, $fieldname." between {$list[0]} and {$list[1]} ");
                        }else{
                            array_push($condition, $fieldname."> {$list[0]} ");
                        }
                        continue;
                    }
                    if (empty($param_new[$fieldname]) || is_numeric($param_new[$fieldname])){   //数字
                        array_push($condition, $fieldname." = '".$param_new[$fieldname]."'");
                        continue;
                    }
                    // 分割参数，判断多选或单选，拼装sql语句
                    $val  = explode('|', $param_new[$fieldname]);
                    if (!empty($val) && !empty($val[0])) {
                        array_push($condition, "(FIND_IN_SET('".$val[0]."',".$fieldname."))");
                    }
                }else if (tpCache('web.web_region_domain') == 1 && (($fieldname == "province_id" && $regionInfo['level'] == 1) || ($fieldname =="city_id" && $regionInfo['level'] == 2))){ //开启二级域名,区域筛选为空时，选中默认项
                    array_push($condition, "(".$fieldname." = '".$regionInfo['id']."' or ".$fieldname." = 0)");
                }else if(tpCache('web.web_region_domain') == 0 && tpCache('web.web_region_show_data') == 0 && ($fieldname == "province_id")){   //关闭二级域名，不显示其他信息
                    array_push($condition, "(".$fieldname." = 0)");
                }
            }
        }
        if (empty($hava_system)){
            $where_sys = ['channel_id'=> $param_new['channel'],'ifmain'=>2];
            $have = db('channelfield')->where($where_sys)->find();
            $hava_system = $have ? 1: 0;
        }

        // 应用搜索条件
        foreach (array('keywords','typeid','notypeid','flag','noflag','channel','joinaid','users_id') as $key) {
            if (isset($param_new[$key]) && $param_new[$key] !== '') {
                if ($key == 'keywords') {
                    array_push($condition, "a.title LIKE '%{$param_new[$key]}%'");
                } elseif ($key == 'channel') {
                    $param_new[$key] = str_replace('，', ',', $param_new[$key]);
                    array_push($condition, "a.channel IN ({$param_new[$key]})");
                }  elseif ($key == 'typeid') {
                    $param_new[$key] = str_replace('，', ',', $param_new[$key]);
                    array_push($condition, "a.typeid IN ({$param_new[$key]})");
                } elseif ($key == 'notypeid') {
                    array_push($condition, "a.typeid NOT IN (".$param_new[$key].")");
                } elseif($key == 'joinaid'){
                    array_push($condition, "a.joinaid={$param_new[$key]}");
                } elseif($key == 'users_id'){
                    array_push($condition, "a.users_id={$param_new[$key]}");
                } elseif ($key == 'flag') {
                    $flag_arr = explode(",", $param_new[$key]);
                    $where_or_flag = array();
                    foreach ($flag_arr as $k2 => $v2) {
                        if ($v2 == "c") {
                            array_push($where_or_flag, "a.is_recom = 1");
                        } elseif ($v2 == "h") {
                            array_push($where_or_flag, "a.is_head = 1");
                        } elseif ($v2 == "a") {
                            array_push($where_or_flag, "a.is_special = 1");
                        } elseif ($v2 == "j") {
                            array_push($where_or_flag, "a.is_jump = 1");
                        } elseif ($v2 == "p") {
                            array_push($where_or_flag, "a.is_litpic = 1");
                        } elseif ($v2 == "b") {
                            array_push($where_or_flag, "a.is_b = 1");
                        }
                    }
                    if (!empty($where_or_flag)) {
                        $where_flag_str = " (".implode(" OR ", $where_or_flag).") ";
                        array_push($condition, $where_flag_str);
                    }
                } elseif ($key == 'noflag') {
                    $flag_arr = explode(",", $param_new[$key]);
                    $where_or_flag = array();
                    foreach ($flag_arr as $nk2 => $nv2) {
                        if ($nv2 == "c") {
                            array_push($where_or_flag, "a.is_recom <> 1");
                        } elseif ($nv2 == "h") {
                            array_push($where_or_flag, "a.is_head <> 1");
                        } elseif ($nv2 == "a") {
                            array_push($where_or_flag, "a.is_special <> 1");
                        } elseif ($nv2 == "j") {
                            array_push($where_or_flag, "a.is_jump <> 1");
                        } elseif ($nv2 == "p") {
                            array_push($where_or_flag, "a.is_litpic <> 1");
                        } elseif ($nv2 == "b") {
                            array_push($where_or_flag, "a.is_b <> 1");
                        }
                    }
                    if (!empty($where_or_flag)) {
                        $where_flag_str = " (".implode(" OR ", $where_or_flag).") ";
                        array_push($condition, $where_flag_str);
                    }
                } else {
                    array_push($condition, "a.{$key} = '".$param_new[$key]."'");
                }
            }
        }
        // 查询条件拼装
        array_push($condition, "a.arcrank > -1");
        array_push($condition, "a.status = 1");
        array_push($condition, "a.is_del = 0");// 回收站功能

        // 是否伪静态下
        $seo_pseudo = config('ey_config.seo_pseudo');
//        if (!isset($param_new[$this->url_screen_var]) && 3 == $seo_pseudo) {
//             $arctype_where = [
//                'dirname' => $param_new['tid'],
//            ];
//            $param_new['tid'] = Db::name('arctype')->where($arctype_where)->getField('id');
//        }
//        // 是否为顶级栏目
//        $parent_id = Db::name('arctype')->where('id',$param_new['tid'])->getField('parent_id');
//        if (empty($parent_id)) {
//            array_push($condition, "a.typeid IN ({$param_new['tid']})");
//        }else{
//            // 非顶级栏目则查询当前栏目数据
//            array_push($condition, "a.typeid = ".$param_new['tid']);
//        }
        // 拼装查询所有条件成sql
        $condition_str = "";
        if (0 < count($condition)) {
            $condition_str = implode(" AND ", $condition);
        }
        // 给排序字段加上表别名
        $orderby = getOrderBy($orderby,$orderway);
        /**
         * 数据查询，搜索出主键ID的值
         */
        $list = array();
        $query_get = array();
        /*列表分页URL问号的查询部分*/
        $get_arr = input('get.');
        foreach ($get_arr as $key => $val) {
            if (empty($val) || stristr($key, '/')) {
                unset($get_arr[$key]);
            }
        }
        $param_arr = input('param.');
        foreach ($param_arr as $key => $val) {
            if (empty($val) || stristr($key, '/')) {
                unset($param_arr[$key]);
            }
        }
        $seo_pseudo = config('ey_config.seo_pseudo');
        if ($seo_pseudo == 1) { // 动态URL模式
            $query_get = $get_arr;
        } elseif ($seo_pseudo == 3) { // 伪静态URL模式
            $query_get = array();
        } elseif ($seo_pseudo == 2) { // 静态页面模式
            $query_get = $get_arr;
        }
        /*--end*/

        $paginate_type = config('paginate.type');
        if (isMobile()) {
            $paginate_type = 'mobile';
        }
        $paginate = array(
            'type'  => $paginate_type,
            'var_page' => config('paginate.var_page'),
            'query' => $query_get,
        );
        $channeltype_info = model('Channeltype')->getInfo($param_new['channel']);
        $channeltype_table = $channeltype_info['table'];
        $tableContent = $channeltype_table.'_content';
        $tableSystem = $channeltype_table.'_system';

        $model = db('archives')
            ->field("a.aid")
            ->alias('a')
            ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT');
        if ($if_system){
            $model = $model->join($tableSystem.' c',"a.aid = c.aid","LEFT");
        }
        if ($if_content){
            $model = $model->join($tableContent.' d',"a.aid = d.aid","LEFT");
        }
        $pages = $model ->where($condition_str)
            ->order($orderby)
            ->paginate($pagesize, false, $paginate);
        if ($pages->total() > 0) {
            $list = $pages->items();
            $aids = get_arr_column($list, 'aid');
            if($hava_system){
                $fields = "c.*,b.*, a.*";
                $row = db('archives')
                    ->field($fields)
                    ->alias('a')
                    ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                    ->join($tableSystem.' c',"a.aid = c.aid","LEFT")
                    ->where('a.aid', 'in', $aids)
                    ->getAllWithIndex('aid');
            }else{
                $fields = "b.*, a.*";
                $row = db('archives')
                    ->field($fields)
                    ->alias('a')
                    ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                    ->where('a.aid', 'in', $aids)
                    ->getAllWithIndex('aid');
            }
            // 获取模型对应的控制器名称
            $channel_list = model('Channeltype')->getAll('id, ctl_name', array(), 'id');

            foreach ($list as $key => $val) {
                $arcval = $row[$val['aid']];
                $controller_name = $channel_list[$arcval['channel']]['ctl_name'];
                /*获取指定路由模式下的URL*/
                if ($arcval['is_part'] == 1) {
                    $arcval['typeurl'] = $arcval['typelink'];
                } else {
                    $arcval['typeurl'] = typeurl('home/'.$controller_name."/lists", $arcval);
                }
                /*--end*/
                /*文档链接*/
                if ($arcval['is_jump'] == 1) {
                    $arcval['arcurl'] = $arcval['jumplinks'];
                } else {
                    $arcval['arcurl'] = arcurl('home/'.$controller_name."/view", ['aid'   => $arcval['aid'], 'dirname'   => $arcval['dirname']]);
                }
                /*--end*/
                /*封面图*/
                $arcval['litpic'] = get_default_pic($arcval['litpic']); // 默认封面图
                if ('on' == $thumb) { // 属性控制是否使用缩略图
                    $arcval['litpic'] = thumb_img($arcval['litpic']);
                }
                /*--end*/
                //地图
                $mapurl = url('home/Map/index', ['aid'=>$val['aid']], true, false, 1);
                $arcval['mapurl'] = $mapurl;

                $list[$key] = $arcval;
            }

            /*附加表*/
            if (!empty($addfields) && !empty($list)) {
                $channeltypeRow = model('Channeltype')->getAll('id,table', [], 'id'); // 模型对应数据表
                $channelGroupRow = group_same_key($list, 'current_channel'); // 模型下的文档集合
                foreach ($channelGroupRow as $channelid => $tmp_list) {
                    $addtableName = ''; // 附加字段的数据表名
                    $tmp_aid_arr = get_arr_column($tmp_list, 'aid');
                    $channeltype_table = $channeltypeRow[$channelid]['table']; // 每个模型对应的数据表
                    $addfields = str_replace('，', ',', $addfields); // 替换中文逗号
                    $addfields = trim($addfields, ',');
                    $addtableName = $channeltype_table.'_content';
                    $resultExt = M($addtableName)->field("aid,$addfields")->where('aid','in',$tmp_aid_arr)->getAllWithIndex('aid');
                    /*自定义字段的数据格式处理*/
//                    $resultExt = $this->fieldLogic->getChannelFieldList($resultExt, $channelid, true);
                    /*--end*/
                    foreach ($list as $key2 => $val2) {
                        $valExt = !empty($resultExt[$val2['aid']]) ? $resultExt[$val2['aid']] : array();
                        $val2 = array_merge($valExt, $val2);
                        $list[$key2] = $val2;
                    }
                }
            }
            $list = $this->fieldLogic->getChannelFieldList($list, $param_new['channel'], true);

            /*--end*/
        }

        $result['pages'] = $pages; // 分页显示输出
        $result['list'] = $list; // 赋值数据集
        $result['count'] = $pages->total();  //数据总数

        return $result;
    }
    private function makeUrl($param_query,$domain = 0){
        $web_region_domain = config('tpcache.web_region_domain');
        if ($web_region_domain && $domain == '1' && $param_query['domain'] != ""){
            $first_url = '//'.$param_query['domain'].'.'.request()->rootDomain().ROOT_DIR.'/index.php?';
        }else{
            $first_url = ROOT_DIR.'/index.php?';
        }
        unset($param_query['domain']);
        $param_url = http_build_query($param_query);
        $url = $first_url.$param_url;
        $url = urldecode($url);

        return $url;
    }
}