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
 * Date: 2019-6-5
 */

namespace think\template\taglib\eju;

use think\Request;
use think\Db;

/**
 * 搜索表单
 */
class TagScreening extends Base
{
    public $tid = '';
    public $channelfield_db = '';
    public $dirname = '';
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->channelfield_db = Db::name('channelfield');
        $this->dirname = input('param.tid/s');
        $this->tid = input('param.tid/s', '');
        $this->tid = $this->getTrueTypeid($this->tid);
    }

    // URL中隐藏index.php入口文件，此方法仅此控制器使用到
    private function auto_hide_index($url = '')
    {
        if (empty($url)) return false;
        // 是否开启去除index.php文件
        $seo_inlet = null;
        $seo_inlet === null && $seo_inlet = config('ey_config.seo_inlet');
//        if (1 == $seo_inlet && !isMobile()) {
//            $url = str_replace('/index.php', '/', $url);
//        }
        return $url;
    }

    /**
     * 获取搜索表单
     */
    public function getScreening($currentstyle='', $addfields='', $addfieldids='', $alltxt_o='',$typeid = 0,$target ='',$region = '',$opencity = '',$show = '',$ajax = '',$present='')
    {
        if (empty($this->tid) && empty($typeid)){
            return false;
        }else if (!empty($typeid)){
            $this->tid = $typeid;
        }
        $opencity_arr = [];
        if($opencity){
            $opencity_arr = explode(',',$opencity);
        }
        // 定义筛选标识
        $url_screen_var = config('global.url_screen_var');
        $reset_param_query = $param = input('param.');   //获取重置的初始值
        if ($present == 'on'){
            $param[$url_screen_var] = 1;
        }

        // 是否在伪静态下搜索
        $seo_pseudo = config('ey_config.seo_pseudo');
        // 查询数据条件
        $where = [
            'a.is_screening' => 1,
            'a.ifeditable'   => 1,
            'b.id'=>$this->tid,
            // 根据需求新增条件
        ];

        // 是否指定参数读取
        if (!empty($addfields)) {
            $where['a.name'] = array('IN',$addfields);
        }else if (!empty($addfieldids)){
            $where['a.id'] = array('IN',$addfieldids);
        }
        // 数据查询
        $row_list = $this->channelfield_db
            ->field('a.id,a.title,a.name,a.dfvalue,a.dtype,a.define,dfvalue_unit')
            ->alias('a')
            ->join('__ARCTYPE__ b','b.current_channel= a.channel_id', 'LEFT')
//            ->join('__CHANNELFIELD_BIND__ b', 'b.field_id = a.id', 'LEFT')
            ->where($where)
            ->order("a.sort_order asc")
            ->select();
        $row = [];
        if (!empty($addfields)){
            $addfields_arr = explode(',',$addfields);
            foreach ($addfields_arr as $value1){
                foreach ($row_list as $value2){
                    $value1 == $value2['name'] && $row[] = $value2;
                }
            }
        }else{
            $row = $row_list;
        }

        // Onclick点击事件方法名称加密，防止冲突
        $OnclickScreening  = 'ey_'.md5('OnclickScreening');
        // Onchange改变事件方法名称加密，防止冲突
        $OnchangeScreening = 'ey_'.md5('OnchangeScreening');
        //Onclick点击事件选中方法名称加密(添加筛选项目),防止冲突
        $OnclickSelect  = 'ey_'.md5('OnclickSelect');
        $OnclickEmpty = 'ey_'.md5('OnclickEmpty');     //清空选中（js）
        $OnclickSure =  'ey_'.md5('OnclickSure');       //确定选中筛选
        $hidden_div_name = 'ey_'.md5("screening_hidden_div".$addfields);
        // 定义搜索点击的name值
        $is_data = '';
        $regionInfo = \think\Cookie::get("regionInfo");
        if(is_json($regionInfo))
        {
            $regionInfo = json_decode($regionInfo,true);
        }
        // 隐藏域参数处理
        $hidden  = '<div id="'.$hidden_div_name.'" style="display:none;">';
        // 数据处理输出
        $domain = 0;
        $seo_pseudo  = config('ey_config.seo_pseudo');
        foreach ($row as $key => $value) {
            // 搜索的name值
            $name = $value['name'];
            $row[$key]['screen'] = $value['title'];
                // 封装onClick事件
            $row[$key]['onClick']  = " onClick='{$OnclickScreening}(this,\"{$target}\");' ";
            // 封装onchange事件
            $row[$key]['onChange'] = " onChange='{$OnchangeScreening}(this);' ";
            $row[$key]['onSelect'] = " onClick='{$OnclickSelect}(this,\"{$currentstyle}\");' ";
            if ($ajax == 'on'){
                $hidden .= '<input name="'.$name.'" id="'.$name.'" type="hidden" value="'.$param[$name].'"/>';
            }
            if (!empty($reset_param_query[$name])){
                unset($reset_param_query[$name]);
            }
            /* end */
            $all = [];
            $alltxt = $alltxt_o;
            if (!empty($alltxt_o)) {
                // 等于OFF表示关闭，不需要此项
                if ('off' == $alltxt_o) {
                    $alltxt = '';
                }else if('on' == $alltxt_o){
                    $alltxt = $value['title'];
                }
            }else{
                $alltxt = '全部';
            }
            if (isset($param[$name]) && !empty($param[$name])) {
                // 搜索点击的name值
                $is_data = $param[$name];
            }else{
                $is_data = $alltxt;
            }
            /*参数值含有单引号、双引号、分号，直接跳转404*/
            if (preg_match('#(\'|\"|;)#', $is_data)) {
                abort(404,'页面不存在');
            }
            /*end*/
            if (!empty($alltxt)){
                $all[] = [
                    'id'   => '',
                    'name' => $alltxt,
                ];
            }
            $RegionData = [];
            // 筛选值处理
            if ('region' == $value['dtype']) {  // 类型为区域则执行
                // 反序列化参数值
                $dfvalue = unserialize($value['dfvalue']);
                // 拆分ID值
                $region_ids = explode(',', $dfvalue['region_ids']);
                $region_names = explode('，', $dfvalue['region_names']);

                foreach ($region_ids as $id_key => $id_value) {
                    $RegionData[$id_key]['id'] = $id_value;
                    $RegionData[$id_key]['name'] = $region_names[$id_key];
                }
            }else if('region_db' == $value['dtype']){  // 类型为内数据表关联区域则执行
                $is_unset = false;
                if($show == 1){   //从自身开始
                    if($regionInfo['level'] == 2 &&  $name == "province_id"){
                        $is_unset = true;
                    }else if ($regionInfo['level'] == 3  &&  ($name == "province_id" || $name == "city_id")){
                        $is_unset = true;
                    }
                }else if($show == 2){     //从下级开始
                    if ($regionInfo['level'] == 1  &&  $name == "province_id"){
                        $is_unset = true;
                    }else if($regionInfo['level'] == 2 &&  ($name == "province_id" || $name == "city_id")){
                        $is_unset = true;
                    }else if ($regionInfo['level'] == 3 ){
                        $is_unset = true;
                    }
                }
                if (!$is_unset){
                    if (empty($value['dfvalue'])){       //省份，不存在上级
                        $RegionData = get_next_region_list(0);
                    }else if (!empty($param[$value['dfvalue']]) && 'on' == $region){   //存在上级筛选，且关联显示
                        $RegionData = get_next_region_list($param[$value['dfvalue']]);
                    }else if($show == 1&& (($regionInfo['level'] == 2  &&  $name == "city_id") || ($regionInfo['level'] == 3  &&  $name == "area_id"))){ //从当前开始
                        $RegionData = get_next_region_list($regionInfo['parent_id']);
                    }else if ($show == 2 && (($regionInfo['level'] == 1  &&  $name == "city_id") || ($regionInfo['level'] == 2  &&  $name == "area_id"))){  //从下级开始显示
                        $RegionData = get_next_region_list($regionInfo['id']);
                    }
                    if (count($RegionData) == 1){
                        $simple = array_merge($RegionData);
//                        if ($simple[0]['level'] < 3){
                            if ($simple[0]['level'] == 1){
                                $param['province_id'] = $simple[0]['id'];
                            }else if($simple[0]['level'] == 2){
                                $param['city_id'] = $simple[0]['id'];
                            }
                            $RegionData = [];
//                        }
                    }
                }
            }else if('config' == $value['define']){    //自定义区域筛选
                $dfvalue = config($value['dfvalue']);
                foreach($dfvalue as $k=>$v){
                    $RegionData[$k]['id'] = $k;
                    $RegionData[$k]['name'] = $v['name'];
                }
            }else if(in_array($value['dtype'],['int','decimal','float'])){   //数值区间
                if (!empty($value['dfvalue'])){
                    $dfvalue = explode(',',$value['dfvalue']);
                    $max = 0;
                    foreach($dfvalue as $k=>$v){
                        if ($k == 0){
                            $RegionData[$k]['id'] = "0,".$v;
                            $RegionData[$k]['name'] = $v.$value['dfvalue_unit']."以下";
                        }else{
                            $RegionData[$k]['id'] = $dfvalue[$k-1].",".$v;
                            $RegionData[$k]['name'] = $dfvalue[$k-1]."-".$v.$value['dfvalue_unit'];
                        }
                        $max = $v;
                    }
                    $RegionData[] = ['id'=>$max,'name'=>$max.$value['dfvalue_unit']."以上"];

                }
            }else{
                // 类型为非特殊
                $dfvalue = explode(',', $value['dfvalue']);
                foreach($dfvalue as $k=>$v){
                    $RegionData[$k]['id'] = $v;
                    $RegionData[$k]['name'] = $v;
                }
            }
            if (empty($RegionData)){
                unset($row[$key]);
                continue;
            }

//            var_dump($RegionData);die();
            // 合并数组
            $RegionData = array_merge($all,$RegionData);
            // 在伪静态下拼装控制器方式参数名
            if (!isset($param[$url_screen_var]) || 3 == $seo_pseudo) {
                $param_query = [];
                $param_query['m'] = 'home';
                $param_query['c'] = 'Lists';
                $param_query['a'] = 'index';
                $param_query['tid'] = $this->tid;
                $param_new = request()->param();
                unset($param_new['tid']);
                unset($param_new['s']);
                $param_query = array_merge($param_new,$param_query);
            } else {
                $param_query = request()->param();
            }
            /* 筛选标识始终追加在最后 */
            $param_query[$url_screen_var] = 1;
            /* end */
            foreach ($RegionData as $kk => $vv) {
                $param_query['domain'] = "";//$regionInfo['domain'];     //默认二级域名
                // 参数拼装URL
                if (!empty($vv['id'])) {
                    $param_query[$name] = $vv['id'];
                    if (!empty($vv['domain'])){
                        $param_query['domain'] = $vv['domain'];     //设置二级域名
                    }
                }else{      //选择不限，去掉该字段已选项
                    unset($param_query[$name]);
                }
                $param_query = $this->unsetNextFiledName($row,$name,$param_query);   //点击该栏目时,去掉所有下级的筛选条件
                $domain = 0;
                if (!empty($vv['level']) && !empty($opencity_arr) && in_array($vv['level'],$opencity_arr)){
                    $domain = 1;
                }
                $url = $this->makeUrl($param_query,$domain);
                // 拼装onClick事件
                $RegionData[$kk]['onClick'] = $row[$key]['onClick']." data-url='{$url}' ";
                $RegionData[$kk]['onChange'] = $row[$key]['onChange']." data-url='{$url}' ";

                //点击选中促发js事件
                $RegionData[$kk]['onSelect'] = $row[$key]['onSelect']." data-name='{$name}' data-value='{$vv['id']}'";
                $RegionData[$kk]['onSelectId'] = $name.$vv['id'].'_id';
                $RegionData[$kk]['onSelectName'] = $name."_name";
                    // 拼装onchange参数
                $RegionData[$kk]['SelectUrl'] = " data-url='{$url}' ";
                // 初始化参数，默认未选中
                $RegionData[$kk]['name']         = "{$vv['name']}";
                $RegionData[$kk]['SelectValue']  = "";
                $RegionData[$kk]['currentstyle'] = "";
                // 选中时执行
                if ($vv['id'] == $is_data || $vv['name'] == $is_data) {
                    $RegionData[$kk]['name']         = "{$vv['name']}";
                    $RegionData[$kk]['SelectValue']  = "selected";
                    $RegionData[$kk]['currentstyle'] = $currentstyle;
                    if (!empty($vv['id'])){
                        $row[$key]['screen'] = "{$vv['name']}";      //显示选中筛选项
                    }
                    $row[$key]['onName'] = !empty($vv['id']) ? $vv['name'] : "";
                    $row[$key]['onId'] = !empty($vv['id']) ? $vv['id'] : "";
                    if (!empty($vv['id'])){
                        unset($param_query[$name]);
                        $url = $this->makeUrl($param_query,$domain);
                        $row[$key]['handle'] = $row[$key]['onClick']." data-url='{$url}' ";
                    }
                }
            }
            // 数据赋值到数组中
            $row[$key]['dfvalue'] = $RegionData;
        }
        $hidden .= '</div>';
        //重置链接
//        !empty($param_query['domain']) && $reset_param_query['domain'] = $param_query['domain'];
//        if ($present == 'on'){
//            $reset_param_query['m'] = MODULE_NAME;
//            $reset_param_query['c'] = CONTROLLER_NAME;
//            $reset_param_query['a'] = ACTION_NAME;
//        }else{
//            $reset_param_query['m'] = 'home';
//            $reset_param_query['c'] = 'Lists';
//            $reset_param_query['a'] = 'index';
//            $reset_param_query['tid'] = $this->tid;
//        }
        if (isset($reset_param_query['keywords'])){
            unset($reset_param_query['keywords']);
        }
        $reset_param_query[$url_screen_var] = 1;
        $resetUrl = $this->makeUrl($reset_param_query,$domain);

        //初始链接
        if (!isset($param[$url_screen_var]) || 3 == $seo_pseudo) {
            $origin_param_query = [];
            $origin_param_query['m'] = 'home';
            $origin_param_query['c'] = 'Lists';
            $origin_param_query['a'] = 'index';
            $origin_param_query['tid'] = $this->tid;
            $param_new = request()->param();
            unset($param_new['tid']);
            unset($param_new['s']);
            $origin_param_query = array_merge($param_new,$origin_param_query);
        } else {
            $origin_param_query = request()->param();
        }
        /* 筛选标识始终追加在最后 */
        $origin_param_query[$url_screen_var] = 1;
        $originUrl = $this->makeUrl($origin_param_query,$domain);

        $hidden .= <<<EOF
<script type="text/javascript">
    function {$OnclickScreening}(obj,target) {
        var dataurl = obj.attributes['data-url'].value;
        if (dataurl) {
            if (target === '_blank'){
                window.open(dataurl);  
            }else{
                window.location.href = dataurl;
            }
        }else{
            console.log('内部错误，data-url 没有赋值！');
        }
    }
    function {$OnchangeScreening}(obj) {
        var index = obj.selectedIndex;
        var dataurl = obj.options[index].attributes['data-url'].value;
        if (dataurl) {
            window.location.href = dataurl;
        }else{
            console.log('内部错误，data-url 没有赋值！');
        }
    }
    function {$OnclickSelect}(obj,currentstyle) {
         var name = obj.attributes['data-name'].value;
         var value = obj.attributes['data-value'].value;
        if (name) {
            var texs = document.getElementsByName(name+'_name');
            for(var i = 0; i < texs.length; i++) {
                texs[i].className = "";
            }
            document.getElementById(name).value=value;
            document.getElementById(name+value+'_id').className=currentstyle;
        }else{
            console.log('内部错误，data-name 没有赋值！');
        }
    }
    function {$OnclickEmpty}(currentstyle) {
       var texs = document.getElementById('{$hidden_div_name}').childNodes;
       for(var i = 0; i < texs.length; i++) {
           var xuanzhong = document.getElementById(texs[i].id+texs[i].value+"_id");
           if(xuanzhong){
               xuanzhong .className = '';
           }
           var buxian = document.getElementById(texs[i].id+"_id");
           if(buxian){
               buxian.className =currentstyle;
           }
            texs[i].value = "";
        }
    }
    function {$OnclickSure}(originUrl){
        var texs = document.getElementById('{$hidden_div_name}').childNodes;
        for(var i = 0; i < texs.length; i++) {
             var re = "&"+texs[i].name+"=((?!&).)*";
             var replace_str = originUrl.match(new RegExp(re)); 
             if (replace_str){
                 originUrl = originUrl.replace(replace_str[0],'');
             }
             if (texs[i].value){
                  originUrl = originUrl + "&" + texs[i].name + "=" + texs[i].value;
             }
        }
        window.location.href = originUrl;
    }
</script>
EOF;
        $result = array(
            'hidden'    => $hidden,
            'resetUrl' => $resetUrl,
            'OnclickEmpty' => "onclick='{$OnclickEmpty}(\"{$currentstyle}\")'",
            'OnclickSure' => "onclick='{$OnclickSure}(\"{$originUrl}\")'",
            'list'       => array_merge($row),
        );
        return $result;
    }
    /*
     * 根据传值,生成url
     * $domain  是否开启二级域名
     */
    private function makeUrl($param_query,$domain = 0){
        $web_region_domain = config('tpcache.web_region_domain');
        if ($web_region_domain && $domain == '1' && $param_query['domain'] != ""){
            $first_url = '//'.$param_query['domain'].'.'.request()->rootDomain().ROOT_DIR.'/index.php?';
        }else{
            $first_url = ROOT_DIR.'/index.php?';
        }
        unset($param_query['domain']);
        unset($param_query['page']);
        $param_url = http_build_query($param_query);
        $url = $first_url.$param_url;
        $url = urldecode($url);

        return $this->auto_hide_index($url);
    }
    /*
     * 选中上级筛选项时，清空下级筛选项的选中条件
     */
    private function unsetNextFiledName($row,$field,&$param_query){
        foreach ($row as $val){
            if ($val['dfvalue'] == $field){
               unset($param_query[$val['name']]);
                $param_query = $this->unsetNextFiledName($row,$val['name'],$param_query);
                break;
            }
        }
        return $param_query;
    }
}