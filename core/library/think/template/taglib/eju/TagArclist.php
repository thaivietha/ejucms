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
use app\home\logic\FieldLogic;

/**
 * 文档列表
 */
class TagArclist extends Base
{
    public $tid = '';
    public $aid = '';
    public $fieldLogic;
    public $archives_db;

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->fieldLogic = new FieldLogic();
        $this->tid = input("param.tid/s", ''); // 应用于栏目列表
        $this->archives_db = Db::name('archives');
        /*应用于文档列表*/
        $this->aid = input('param.aid/d', 0);
        if ($this->aid > 0) {
            $this->tid = $this->archives_db->where('aid', $this->aid)->getField('typeid');
        }
        /*--end*/
        /*tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);
        /*--end*/
    }

    /**
     *  arclist解析函数
     *
     * @author wengxianhu by 2018-4-20
     * @access    public
     * @param     array  $param  查询数据条件集合
     * @param     int  $row  调用行数
     * @param     string  $orderby  排列顺序
     * @param     string  $addfields  附加表字段，以逗号隔开
     * @param     string  $orderway  排序方式
     * @param     string  $tagid  标签id
     * @param     string  $tag  标签属性集合
     * @param     string  $pagesize  分页显示条数
     * @param     string  $thumb  是否开启缩略图
     * @return    array
     */
    public function getArclist($param = array(),  $row = 15, $orderby = '', $addfields = '', $orderway = '', $tagid = '', $tag = '', $pagesize = 0, $thumb = '')
    {
        $result = false;
        $condition = array();
        $param = array_merge($param,input('param.'));
        $channeltype = ("" != $param['channel'] && is_numeric($param['channel'])) ? intval($param['channel']) : '';
        $param['typeid'] = !empty($param['typeid']) ? $param['typeid'] : $this->tid;
        empty($orderway) && $orderway = 'desc';
        $pagesize = empty($pagesize) ? intval($row) : intval($pagesize);
        $limit = $row;

        if (!empty($param['typeid'])) {
            if (!preg_match('/^\d+([\d\,]*)$/i', $param['typeid'])) {
                echo '标签arclist报错：typeid属性值语法错误，请正确填写栏目ID。';
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

        $allow_release_channel = config('global.allow_release_channel');
        /*不指定模型ID、栏目ID，默认显示所有可以发布文档的模型ID下的文档*/
        if (("" === $channeltype && empty($typeid)) || 0 === $channeltype) {
            $channeltype = $param['channel'] = implode(',', $allow_release_channel);
        }
        /*--end*/

        if (!empty($channeltype)) { // 如果指定了频道ID，则频道下的所有文档都展示
            unset($param['typeid']);
        } else {
            // unset($param['channel']);
            if (!empty($typeid)) {
                $typeidArr = explode(',', $typeid);
                if (count($typeidArr) == 1) {
                    $typeid = intval($typeid);
                    $channel_info = M('Arctype')->field('id,current_channel')->where(array('id'=>array('eq', $typeid)))->find();
                    if (empty($channel_info)) {
                        echo '标签arclist报错：指定属性 typeid 的栏目ID不存在。';
                        return false;
                    }
                    $channeltype = !empty($channel_info) ? $channel_info["current_channel"] : ''; // 当前栏目ID所属模型ID
                    /*当前模型ID不属于含有列表模型，直接返回无数据*/
                    if (false === array_search($channeltype, $allow_release_channel)) {
                        return false;
                    }
                    /*end*/
                    /*获取当前栏目下的所有同模型的子孙栏目*/
                    $arctype_list = model("Arctype")->getHasChildren($channel_info['id']);
                    foreach ($arctype_list as $key => $val) {
                        if ($channeltype != $val['current_channel']) {
                            unset($arctype_list[$key]);
                        }
                    }
                    $typeids = get_arr_column($arctype_list, "id");
                    !in_array($typeid, $typeids) && $typeids[] = $typeid;
                    $typeid = implode(",", $typeids);
                    /*--end*/
                } elseif (count($typeidArr) > 1) {
                   $firstTypeid = $typeidArr[0];
                    $firstTypeid = M('Arctype')->where(array('id|dirname'=>array('eq', $firstTypeid)))->getField('id');
                    $channeltype = M('Arctype')->where(array('id'=>array('eq', $firstTypeid)))->getField('current_channel');
                }
                $param['channel'] = $channeltype;
            }
        }
        // 所有应用于搜索的自定义字段
        $hava_system = $if_system = $if_content = 0;
        $where = [
            'channel_id'=> $param['channel']
            // 根据需求新增条件
        ];
        $channelfield = db('channelfield')->where($where)->field('channel_id,id,name,dtype,define,dfvalue,ifmain,is_screening')->select();
        $regionInfo = \think\Cookie::get("regionInfo");
        if(is_json($regionInfo))
        {
            $regionInfo = json_decode($regionInfo,true);
        }
        $orderbys = input('param.orderby/s', '');
        foreach ($channelfield as $key => $value) {
            // 值不为空则执行
            $name = $value['name'];
            if (!empty($name)) {
                if (!empty($orderbys) && $orderbys == $name && $value['ifmain'] == 2){
                    $if_system = 1;
                }else if (!empty($orderbys) && $orderbys == $name && $value['ifmain'] == 0){
                    $if_content = 1;
                }
                if ($value['ifmain'] == 2){
                    $hava_system = 1;
                }
                if (!empty($param[$name])  && !empty($value['is_screening'])) {
                    if ($value['ifmain'] == 2){
                        $if_system = 1;
                    }else if ($value['ifmain'] == 0){
                        $if_content = 1;
                    }
                    if (1 == $param['screen']){  //是否筛选(存在)从表 screen = 1启用页面筛选项目（默认）,screen = 0 不启用页面筛选项
                        if ($value['define'] == 'config'){    //配置文件定义数值区间
                            $dfvalue = config($value['dfvalue']);
                            !empty($dfvalue[$param[$name]]['sql']) && array_push($condition, $name." ".$dfvalue[$param[$name]]['sql']);
                            continue;
                        }
                        if (in_array($value['dtype'],['int','decimal','float'])){   //后台定义数值区间
                            $list = explode(',',$param[$name]);
                            if (count($list) >1){
                                array_push($condition, $name." between {$list[0]} and {$list[1]} ");
                            }else{
                                array_push($condition, $name."> {$list[0]} ");
                            }
                            continue;
                        }

                        if (empty($param[$name]) || is_numeric($param[$name])){   //数字
                            array_push($condition, $name." = '".$param[$name]."'");
                            continue;
                        }

                        // 分割参数，判断多选或单选，拼装sql语句
                        $val  = explode('|', $param[$name]);
                        if (!empty($val) && !empty($val[0])) {
                            array_push($condition, "(FIND_IN_SET('".$val[0]."',".$name."))");
                        }
                    }
                }else if (config('ey_config.web_region_domain') == 1 && (($name == "province_id" && $regionInfo['level'] == 1) || ($name =="city_id" && $regionInfo['level'] == 2))){ //开启二级域名,区域筛选为空时，选中默认项
                    array_push($condition, "(a.".$name." = '".$regionInfo['id']."' or a.".$name." = 0)");
                }else if(config('ey_config.web_region_domain') == 0 && config('tpcache.web_region_show_data') == 0 && ($name == "province_id")){   //关闭二级域名，不显示其他信息
                    array_push($condition, "(a.".$name." = 0)");
                }
                //关闭二级域名，无差别显示所有，无需操作
            }
        }
        if (empty($hava_system)){
            $where_sys = ['channel_id'=> $param['channel'],'ifmain'=>2];
            $hava = db('channelfield')->where($where_sys)->find();
            $hava_system = $hava ? 1: 0;
        }
        // 查询条件
        foreach (array('keywords','typeid','notypeid','flag','noflag','channel','joinaid','users_id') as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    if (1 == $param['screen']){
                        array_push($condition, "a.title LIKE '%{$param[$key]}%'");
                    }
                } elseif ($key == 'channel') {
                    array_push($condition, "a.channel IN ({$channeltype})");
                } elseif ($key == 'typeid') {
                    array_push($condition, "a.typeid IN ({$typeid})");
                } elseif ($key == 'notypeid') {
                    $param[$key] = str_replace('，', ',', $param[$key]);
                    array_push($condition, "a.typeid NOT IN (".$param[$key].")");
                } elseif($key == 'joinaid'){
                    array_push($condition, "a.joinaid={$param[$key]}");
                } elseif($key == 'users_id'){
                    array_push($condition, "a.users_id={$param[$key]}");
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
                    array_push($condition, "a.{$key} = '".$param[$key]."'");
                }
            }
        }
        array_push($condition, "a.arcrank > -1");
        array_push($condition, "a.status = 1");
        array_push($condition, "a.is_del = 0"); // 回收站功能
        $where_str = "";
        if (0 < count($condition)) {
            $where_str = implode(" AND ", $condition);
        }

        // 给排序字段加上表别名
        $isinput = 1 == $param['screen'] ? true : false;
        $orderby = getOrderBy($orderby,$orderway,true,$isinput);
        // 获取查询的控制器名
        $channeltype_info = model('Channeltype')->getInfo($channeltype);
        $controller_name = $channeltype_info['ctl_name'];
        $channeltype_table = $channeltype_info['table'];
        $tableContent = $channeltype_table.'_content';
        $tableSystem = $channeltype_table.'_system';

        /*用于arclist标签的分页*/
        if(0 < $pagesize) {
            $tag['typeid'] = $typeid;
            isset($tag['channelid']) && $tag['channelid'] = $channeltype;
            $tagidmd5 = $this->attDef($tag); // 进行tagid的默认处理
        }
        /*--end*/
        if ($hava_system){
            $model = $this->archives_db
                ->field("c.*,b.*, a.*")
                ->alias('a')
                ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT');
            $model = $model->join($tableSystem.' c',"a.aid = c.aid","LEFT");
        }else{
            $model = $this->archives_db
                ->field("b.*, a.*")
                ->alias('a')
                ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT');
        }
        if ($if_content){
            $model = $model->join($tableContent.' d',"a.aid = d.aid","LEFT");
        }
        $result = $model ->where($where_str)
            ->orderRaw($orderby)
            ->limit($limit)
            ->select();

        // 查询数据处理
        $aidArr = array();
        $addtableName = ''; // 附加字段的数据表名
        $querysql = $this->archives_db->getLastSql(); // 用于arclist标签的分页
        foreach ($result as $key => $val) {
            array_push($aidArr, $val['aid']); // 收集文档ID
            /*栏目链接*/
            if ($val['is_part'] == 1) {
                $val['typeurl'] = $val['typelink'];
            } else {
                $val['typeurl'] = typeurl('home/'.$controller_name."/lists", $val);
            }
            /*--end*/
            /*文档链接*/
            if ($val['is_jump'] == 1) {
                $val['arcurl'] = $val['jumplinks'];
            } else {
                $arcparam = $val;
                if (!empty($arcparam['room'])){
                    unset($arcparam['room']);
                }
                $val['arcurl'] = arcurl('home/'.$controller_name."/view",  $arcparam,true,false,'',null);

            }
            /*--end*/
            /*封面图*/
            $val['litpic'] = get_default_pic($val['litpic']); // 默认封面图
            if ('on' == $thumb) { // 属性控制是否使用缩略图
                $val['litpic'] = thumb_img($val['litpic']);
            }
            /*--end*/
            /*地图*/
            $mapurl = url('home/Map/index', ['aid'=>$val['aid']], true, false, 1);
            $val['mapurl'] = $mapurl;
            /*--end*/

            $result[$key] = $val;
        }
        /*附加表*/
        if (!empty($addfields) && !empty($aidArr)) {
            $addfields = str_replace('，', ',', $addfields); // 替换中文逗号
            $addfields = trim($addfields, ',');
            $resultExt = db::name($tableContent)->field("aid,$addfields")->where('aid','in',$aidArr)->getAllWithIndex('aid');

        }
        foreach ($result as $key => $val){
            $valExt = !empty($resultExt[$val['aid']]) ? $resultExt[$val['aid']] : array();
            $val = array_merge($valExt, $val);

            $result[$key] = $val;
        }
        $result = $this->fieldLogic->getChannelFieldList($result, $channeltype, true);
        //分页特殊处理
        if(false !== $tagidmd5 && 0 < $pagesize)
        {
            $arcmulti_db = \think\Db::name('arcmulti');
            $arcmultiRow = $arcmulti_db->field('tagid')->where(['tagid'=>$tagidmd5])->find();
            $attstr = addslashes(serialize($tag)); //记录属性,以便分页样式统一调用

            if(empty($arcmultiRow))
            {
                $arcmulti_db->insert([
                    'tagid' => $tagidmd5,
                    'tagname'   => 'arclist',
                    'innertext' => '',
                    'pagesize'  => $pagesize,
                    'querysql'  => $querysql,
                    'ordersql'  => $orderby,
                    'addfieldsSql'  => $addfields,
                    'addtableName'  => $addtableName,
                    'attstr'    => $attstr,
                    'add_time'   => getTime(),
                    'update_time'   => getTime(),
                ]);
            } else {
                $arcmulti_db->where([
                    'tagid' => $tagidmd5,
                    'tagname' => 'arclist',
                ])->update([
                    'innertext' => '',
                    'pagesize'  => $pagesize,
                    'querysql'  => $querysql,
                    'ordersql'  => $orderby,
                    'addfieldsSql'  => $addfields,
                    'addtableName'  => $addtableName,
                    'attstr'    => $attstr,
                    'update_time'   => getTime(),
                ]);
            }
        }

        $data = [
            'tag'    => $tag,
            'list'      => $result,
        ];

        return $data;
    }

    /**
     *  生成hash唯一串
     *
     * @param     array  $tag 标签属性
     * @return    string
     */
    private function attDef($tag)
    {
        $tagmd5 = md5(serialize($tag));
        if (!empty($tag['tagid'])) {
            $tagidmd5 = $tag['tagid'].'_'.$tagmd5;
        } else {
            $tagidmd5 = false; // 'arclist_'.$tagmd5;
            // $tagidmd5 = 'arclist_'.$tagmd5;
        }

        return $tagidmd5;
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