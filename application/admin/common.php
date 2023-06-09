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

if (!function_exists('is_adminlogin')) 
{
    /**
     * 检验登陆
     * @param
     * @return bool
     */
    function is_adminlogin(){
        $admin_id = session('admin_id');
        if(isset($admin_id) && $admin_id > 0){
            return $admin_id;
        }else{
            return false;
        }
    }
}

if (!function_exists('adminLog')) 
{
    /**
     * 管理员操作记录
     * @param $log_url 操作URL
     * @param $log_info 记录信息
     */
    function adminLog($log_info = ''){
        $admin_id = session('admin_id');
        $admin_id = !empty($admin_id) ? $admin_id : -1;
        $add['log_time'] = getTime();
        $add['admin_id'] = $admin_id;
        $add['log_info'] = $log_info;
        $add['log_ip'] = clientIP();
        $add['log_url'] = request()->baseUrl() ;
        M('admin_log')->add($add);
    }
}

if (!function_exists('getAdminInfo')) 
{
    /**
     * 获取管理员登录信息
     */
    function getAdminInfo($admin_id = 0)
    {
        $admin_info = [];
        $admin_id = empty($admin_id) ? session('admin_id') : $admin_id;
        if (0 < intval($admin_id)) {
            $admin_info = \think\Db::name('admin')
                ->field('a.*, b.name AS role_name')
                ->alias('a')
                ->join('__AUTH_ROLE__ b', 'b.id = a.role_id', 'LEFT')
                ->where("a.admin_id", $admin_id)
                ->find();
            if (!empty($admin_info)) {
                // 头像
                empty($admin_info['head_pic']) && $admin_info['head_pic'] = get_head_pic($admin_info['head_pic']);
                
                // 权限组
                $admin_info['role_id'] = !empty($admin_info['role_id']) ? $admin_info['role_id'] : -1;
                if (-1 == $admin_info['role_id']) {
                    if (!empty($admin_info['parent_id'])) {
                        $role_name = '超级管理员';
                    } else {
                        $role_name = '创始人';
                    }
                } else {
                    $role_name = $admin_info['role_name'];
                }
                $admin_info['role_name'] = $role_name;
            }
        }
        
        return $admin_info;
    }
}

if (!function_exists('get_conf')) 
{
    /**
     * 获取conf配置文件
     */
    function get_conf($name = 'global')
    {            
        $arr = include APP_PATH.MODULE_NAME.'/conf/'.$name.'.php';
        return $arr;
    }
}

if (!function_exists('get_auth_rule')) 
{
    /**
     * 获取权限列表文件
     */
    function get_auth_rule($where = [])
    {
        $auth_rule = include APP_PATH.MODULE_NAME.'/conf/auth_rule.php';
        if (!empty($where)) {
            foreach ($auth_rule as $k1 => $rules) {
                foreach ($where as $k2 => $v2) {
                    if ($rules[$k2] != $v2) {
                        unset($auth_rule[$k1]);
                    }
                }
            }
        }
        return $auth_rule;
    }
}
/*
 * 检测不需要权限的
 */
if(!function_exists('is_uneed_check_access')){
    function is_uneed_check_access($str = 'Index@index'){
        $arr = explode('@', $str);
        $ctl = !empty($arr[0]) ? $arr[0] : '';
        $ctl_all = $ctl.'@*';
        if (stristr($str,"ajax")){  //包含ajax不需要设置权限可以访问
            return true;
        }
        $filter_login_action = config('filter_login_action');   //不需要登陆就可以访问
        if (in_array($str, $filter_login_action) || in_array($ctl_all, $filter_login_action)) {
            return true;
        }
        $uneed_check_action = config('uneed_check_action');     //需要登陆，但是不需要特别设置就可以访问
        if (in_array($str, $uneed_check_action) || in_array($ctl_all, $uneed_check_action)) {
            return true;
        }

        return false;
    }
}
/*
 * 检测增删改审核权限
 *
 */
if (!function_exists('is_cud_check_access')){
    function is_cud_check_access($str = 'Index@index'){
        $ctl_act = strtolower($str);
        $arr = explode('@', $ctl_act);
        $ctl = !empty($arr[0]) ? $arr[0] : '';
        $act = !empty($arr[1]) ? $arr[1] : '';
        $actArr = ['add','edit','del'];
        $admin_info = session('admin_info');
        $auth_role_info = !empty($admin_info['auth_role_info']) ? $admin_info['auth_role_info'] : [];
        $cudArr = !empty($auth_role_info['cud']) ? $auth_role_info['cud'] : [];

        if ('weapp' == $ctl && 'execute' == $act) {
            $sa = input('param.sa/s');
            foreach ($actArr as $key => $cud) {
                $sa = preg_replace('/^(.*)_('.$cud.')$/i', '$2', $sa); // 同名add 或者以_add类似结尾都符合
                if ($sa == $cud) {
                    if (!in_array($sa, $cudArr)) {
                        return false;
                    }
                    break;
                }
            }
        } else {
            array_push($actArr, 'changetableval'); // 审核信息
            foreach ($actArr as $key => $cud) {
                $act = preg_replace('/^(.*)_('.$cud.')$/i', '$2', $act); // 同名add 或者以_add类似结尾都符合
                if ($act == $cud) {
                    if (!in_array($act, $cudArr)) {
                        return false;
                    }
                    break;
                }
            }
        }

        return true;
    }
}
/*
 * 检测栏目内容arctype的权限
 */
if (!function_exists('is_arctype_check_access')){
    function is_arctype_check_access($str = 'Index@index'){
        $ctl_act = $str; //strtolower($str);
        $arr = explode('@', $ctl_act);
        $ctl = !empty($arr[0]) ? $arr[0] : '';
        $auth_role_info = session('admin_info.auth_role_info');
        $permission_arctype = !empty($auth_role_info['permission']['arctype']) ? $auth_role_info['permission']['arctype'] : [];
        if ($ctl == 'Custom'){
            $channel_id = \think\Db::name('channeltype')->where("is_del=0 and ifsystem=0")->getField('id',true);
            if ($channel_id){
                $have = \think\Db::name("arctype")->where(['is_del'=>0,'current_channel'=>['in',$channel_id],'id'=>['in',$permission_arctype]])->find();
                if ($have){
                    return true;
                }
            }
        }else{
            $channel_id = \think\Db::name('channeltype')->where("is_del=0 and ctl_name='{$ctl}'")->getField('id');
            if ($channel_id){
                $have = \think\Db::name("arctype")->where(['is_del'=>0,'current_channel'=>$channel_id,'id'=>['in',$permission_arctype]])->find();
                if ($have){
                    return true;
                }
            }
        }

        return false;
    }
}
/*
 * 检测控制器rules的权限
 */
if (!function_exists('is_rules_check_access')){
    function is_rules_check_access($str = 'Index@index'){
        $ctl_act = strtolower($str);
        $arr = explode('@', $ctl_act);
        $ctl = !empty($arr[0]) ? $arr[0] : '';
        $act = !empty($arr[1]) ? $arr[1] : '';
        $ctl_all = $ctl.'@*';
        if (preg_match('/^ajax_(.*)$/i',$act) || preg_match('/^(.*)_ajax$/i',$act)){
            return true;
        }
        $auth_role_info = session('admin_info.auth_role_info');
        $permission = $auth_role_info['permission'];
        $permission_rules = !empty($permission['rules']) ? $permission['rules'] : [];
        $auth_rule = get_auth_rule();  //全部权限节点
        $admin_auths = []; // 用户当前拥有权限对应的菜单ID
        foreach($auth_rule as $key => $val){
            if (in_array($val['id'], $permission_rules)) {
                $admin_auths = array_merge($admin_auths, explode(',', strtolower($val['auths'])));
            }
        }
        $admin_auths = array_unique($admin_auths);
        if (in_array($ctl_act, $admin_auths) || in_array($ctl_all, $admin_auths)) {
            return true;
        }

        return false;
    }
}
/**
 * 检测是否有该权限（完全）
 */
if (!function_exists('is_check_access'))
{
    function is_check_access($str = 'Index@index') {
        $role_id = session('admin_info.role_id');
        if (0 < intval($role_id)) {
            if (!is_cud_check_access($str)){
                return false;
            }
            if (is_uneed_check_access($str)){
                return true;
            }
            if (is_arctype_check_access($str)){
                return true;
            }
            if (is_rules_check_access($str)){
                return true;
            }
        }else{
            return true;
        }

        return false;
    }
}
if (!function_exists('getMenuList'))
{
    /**
     * 根据角色权限过滤菜单
     * $is_menu    是否过滤非菜单栏目
     */
    function getMenuList($is_menu = true) {
        $menuArr = getAllMenu();
        $role_id = session('admin_info.role_id');
        if (0 < intval($role_id)) {
            $auth_role_info = session('admin_info.auth_role_info');
            $permission = $auth_role_info['permission'];
            $permission_rules = !empty($permission['rules']) ? $permission['rules'] : [];

            $auth_rule = get_auth_rule();
            $admin_auths = []; // 用户当前拥有权限对应的菜单ID
            foreach($auth_rule as $key => $val){
                if (in_array($val['id'], $permission_rules)) {
                    $admin_auths = array_merge($admin_auths, explode(',', $val['menu_id']), explode(',', $val['menu_id2']));
                }
            }
            $admin_auths = array_unique($admin_auths);
            $arctypeLogic = new app\common\logic\ArctypeLogic();
            $arctype_list = $arctypeLogic->arctype_list(0, 0, false, 0, ['is_del'=>0], false);
            $channeltype = get_arr_column($arctype_list, 'current_channel');
            foreach($menuArr as $k=>$val){
                foreach ($val['child'] as $j=>$v){
                    foreach ($v['child'] as $s=>$son){
                        if (($is_menu && empty($son['is_menu'])) || (empty($son['channel']) && !in_array($son['id'], $admin_auths)) || (!empty($son['channel']) && !in_array($son['channel'],$channeltype))) {
                            unset($menuArr[$k]['child'][$j]['child'][$s]);//过滤三级菜单
                        }
                    }
                    if (($is_menu && empty($v['is_menu'])) || (empty($v['channel'])  && empty($menuArr[$k]['child'][$j]['child']) && !in_array($v['id'], $admin_auths)) || (!empty($v['channel']) && !in_array($v['channel'],$channeltype))) {
                        unset($menuArr[$k]['child'][$j]);//过滤二级菜单
                    }
                }
                //一级是直接操作项目，且没有被赋予权限，或者，下级才是操作权限，所有下级都没有被赋予权限
                if (($is_menu && empty($val['is_menu'])) || (empty($val['channel'])  && empty($menuArr[$k]['child']) && !in_array($val['id'], $admin_auths)) || (!empty($val['channel']) && !in_array($val['channel'],$channeltype))) {
                    unset($menuArr[$k]);//过滤一级级菜单
                }
            }
        }
//        $config = tpCache('question');
//        if (empty($config['question_status'])){   //没有开启问答
//            unset($menuArr[10000]);
//        }

        return $menuArr;
    }
}


if (!function_exists('getAllMenu')) 
{
    /**
     * 获取左侧菜单
     */
    function getAllMenu() {
        $menuArr = false;//extra_cache('admin_all_menu');
        if (!$menuArr) {
            $menuArr = get_conf('menu');
            extra_cache('admin_all_menu', $menuArr);
        }
        return $menuArr;
    }
}



if (!function_exists('tpversion')) 
{
    function tpversion($timeout = 3)
    {
        if(!empty($_SESSION['isset_push']))
            return false;
        $_SESSION['isset_push'] = 1;
        error_reporting(0);//关闭所有错误报告
        $install_time = DEFAULT_INSTALL_DATE;
        $serial_number = DEFAULT_SERIALNUMBER;

        $constsant_path = APP_PATH.'admin/conf/constant.php';
        if (file_exists($constsant_path)) {
            require_once($constsant_path);
            defined('INSTALL_DATE') && $install_time = INSTALL_DATE;
            defined('SERIALNUMBER') && $serial_number = SERIALNUMBER;
        }
        $curent_version = getCmsVersion();
        $mysqlinfo = \think\Db::query("SELECT VERSION() as version");
        $mysql_version  = $mysqlinfo[0]['version'];
        $vaules = array(
            'domain'=>$_SERVER['HTTP_HOST'], 
            'key_num'=>$curent_version, 
            'install_time'=>$install_time, 
            'serial_number'=>$serial_number,
            'ip'    => GetHostByName($_SERVER['SERVER_NAME']),
            'phpv'  => urlencode(phpversion()),
            'mysql_version' => urlencode($mysql_version),
            'web_server'    => urlencode($_SERVER['SERVER_SOFTWARE']),
            'web_title' => tpCache('web.web_title'),
        );
        // api_Service_user_push
        $service_ey = config('service_ey');
        $tmp_str = 'L2luZGV4LnBocD9tPWFwaSZjPUNtc1NlcnZpY2UmYT11c2VyX3B1c2gmY21zX3R5cGU9MSY=';
        $url = base64_decode($service_ey).base64_decode($tmp_str).http_build_query($vaules);
        stream_context_set_default(array('http' => array('timeout' => $timeout)));
        @file_get_contents($url);
    }
}

if (!function_exists('push_zzbaidu')) 
{
    /**
     * 将新链接推送给百度蜘蛛
     */
    function push_zzbaidu($type = 'urls', $aid = '', $typeid = '')
    {
        // 获取token的值：http://ziyuan.baidu.com/linksubmit/index?site=http://www.ejucms.com/
        $aid = intval($aid);
        $typeid = intval($typeid);
        $sitemap_zzbaidutoken = tpCache('sitemap.sitemap_zzbaidutoken');
        if (empty($sitemap_zzbaidutoken) || (empty($aid) && empty($typeid)) || !function_exists('curl_init')) {
            return '';
        }

        $urlsArr = array();
        $channeltype_list = model('Channeltype')->getAll('id, ctl_name', array(), 'id');

        if ($aid > 0) {
            $res = M('archives')->field('b.*, a.*, a.aid, b.id as typeid')
                ->alias('a')
                ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
                ->find($aid);
            $arcurl = get_arcurl($res, false);
            array_push($urlsArr, $arcurl);
        }
        if (0 < $typeid) {
            $res = M('arctype')->field('a.*')
                ->alias('a')
                ->find($typeid);
            $typeurl = get_typeurl($res, false);
            array_push($urlsArr, $typeurl);
        }

        $type = ('edit' == $type) ? 'update' : 'urls';
        $api = 'http://data.zz.baidu.com/'.$type.'?site='.request()->host(true).'&token='.$sitemap_zzbaidutoken;
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urlsArr),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        
        return $result;    
    }
}

if (!function_exists('sitemap_auto')) 
{
    /**
     * 自动生成引擎sitemap
     */
    function sitemap_auto()
    {
        $sitemap_config = tpCache('sitemap');
        if (isset($sitemap_config['sitemap_auto']) && $sitemap_config['sitemap_auto'] > 0) {
            sitemap_all();
        }
    }
}

if (!function_exists('sitemap_all')) 
{
    /**
     * 生成全部引擎sitemap
     */
    function sitemap_all()
    {
        sitemap_xml();
    }
}

if (!function_exists('sitemap_xml')) 
{
    /**
     * 生成xml形式的sitemap
     */
    function sitemap_xml()
    {
        $globalConfig = tpCache('global');
        if (!isset($globalConfig['sitemap_xml']) || empty($globalConfig['sitemap_xml'])) {
            return '';
        }

        $modelu_name = 'home';
        $filename = ROOT_PATH . "sitemap.xml";

        /* 分类列表(用于生成列表链接的sitemap) */
        $map = array(
            'status'    => 1,
            'is_del'    => 0,
        );
        if (is_array($globalConfig)) {
            // 过滤隐藏栏目
            if (isset($globalConfig['sitemap_not1']) && $globalConfig['sitemap_not1'] > 0) {
                $map['is_hidden'] = 0;
            }
            // 过滤外部模块
            if (isset($globalConfig['sitemap_not2']) && $globalConfig['sitemap_not2'] > 0) {
                $map['is_part'] = 0;
            }
        }
        $result_arctype = M('arctype')->field("*, id AS loc, add_time AS lastmod, 'hourly' AS changefreq, '0.8' AS priority")
            ->where($map)
            ->order('sort_order asc, id asc')
            ->getAllWithIndex('id');

        /* 文章列表(用于生成文章详情链接的sitemap) */
        $map = array(
            'channel'   => ['IN', config('global.allow_release_channel')],
            'arcrank'   => array('gt', -1),
            'status'    => 1,
            'is_del'    => 0,
        );
        if (is_array($globalConfig)) {
            // 过滤外部模块
            if (isset($globalConfig['sitemap_not2']) && $globalConfig['sitemap_not2'] > 0) {
                $map['is_jump'] = 0;
            }
        }
        if (!isset($globalConfig['sitemap_archives_num']) || $globalConfig['sitemap_archives_num'] == '') {
            $sitemap_archives_num = 100;
        } else {
            $sitemap_archives_num = intval($globalConfig['sitemap_archives_num']);
        }
        $field = "aid,province_id,city_id,area_id, channel, is_jump, jumplinks, add_time, update_time, typeid, aid AS loc, add_time AS lastmod, 'daily' AS changefreq, '0.5' AS priority";
        $result_archives = M('archives')->field($field)
            ->where($map)
            ->order('aid desc')
            ->limit($sitemap_archives_num)
            ->select();

            // header('Content-Type: text/xml');//这行很重要，php默认输出text/html格式的文件，所以这里明确告诉浏览器输出的格式为xml,不然浏览器显示不出xml的格式
            $xml_wrapper = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</urlset>
XML;

        if (function_exists('simplexml_load_string')) {
            $xml = @simplexml_load_string($xml_wrapper);
        } else if (class_exists('SimpleXMLElement')) {
            $xml = new SimpleXMLElement($xml_wrapper);
        }
        if (!$xml) {
            return true;
        }

        // 更新频率
        $sitemap_changefreq_index = !empty($globalConfig['sitemap_changefreq_index']) ? $globalConfig['sitemap_changefreq_index'] : 'always';
        $sitemap_changefreq_list = !empty($globalConfig['sitemap_changefreq_list']) ? $globalConfig['sitemap_changefreq_list'] : 'hourly';
        $sitemap_changefreq_view = !empty($globalConfig['sitemap_changefreq_view']) ? $globalConfig['sitemap_changefreq_view'] : 'daily';

        // 优先级别
        $sitemap_priority_index = !empty($globalConfig['sitemap_priority_index']) ? $globalConfig['sitemap_priority_index'] : '1.0';
        $sitemap_priority_list = !empty($globalConfig['sitemap_priority_list']) ? $globalConfig['sitemap_priority_list'] : '0.8';
        $sitemap_priority_view = !empty($globalConfig['sitemap_priority_view']) ? $globalConfig['sitemap_priority_view'] : '0.5';

        /*首页*/
        $url = request()->domain().ROOT_DIR;
        $item = $xml->addChild('url'); //使用addChild添加节点
        foreach (['loc','lastmod','changefreq','priority'] as $key1) {
            if ('loc' == $key1) {
                $row = $url;
            } else if ('lastmod' == $key1) {
                $row = date('Y-m-d');
            } else if ('changefreq' == $key1) {
                $row = $sitemap_changefreq_index;
            } else if ('priority' == $key1) {
                $row = $sitemap_priority_index;
            }
            try {
                $node = $item->addChild($key1, $row);
            } catch (\Exception $e) {}
            if (isset($attribute_array[$key1]) && is_array($attribute_array[$key1])) {
                foreach ($attribute_array[$key1] as $akey => $aval) {//设置属性值，我这里为空
                    $node->addAttribute($akey, $aval);
                }
            }
        }
        //如果存在多站点，则每个站点添加
        $web_region_domain = config('ey_config.web_region_domain');  //是否开启子域名
        if ($web_region_domain){
            $domain = request()->host();
            $domain_arr = explode('.',$domain);
            $web_mobile_domain = config('ey_config.web_mobile_domain');
            $scheme = request()->isSsl() || \think\Config::get('is_https') ? 'https://' : 'http://';
            $region_list = get_region_list();
            foreach ($region_list as $val){
                if (!empty($val['domain']) && !empty($domain_arr) && $domain_arr[0] != $web_mobile_domain){
                    //各个分站点首页
                    $domain_arr[0] = $val['domain'];
                    $url = $scheme.implode('.',$domain_arr);
                    $item = $xml->addChild('url'); //使用addChild添加节点
                    foreach (['loc','lastmod','changefreq','priority'] as $key1) {
                        if ('loc' == $key1) {
                            $row = $url;
                        } else if ('lastmod' == $key1) {
                            $row = date('Y-m-d');
                        } else if ('changefreq' == $key1) {
                            $row = $sitemap_changefreq_index;
                        } else if ('priority' == $key1) {
                            $row = $sitemap_priority_index;
                        }
                        try {
                            $node = $item->addChild($key1, $row);
                        } catch (\Exception $e) {}
                        if (isset($attribute_array[$key1]) && is_array($attribute_array[$key1])) {
                            foreach ($attribute_array[$key1] as $akey => $aval) {//设置属性值，我这里为空
                                $node->addAttribute($akey, $aval);
                            }
                        }
                    }
                    //各个分站点栏目页
                    foreach ($result_arctype as $sub) {
                        if (is_array($sub)) {
                            $item = $xml->addChild('url'); //使用addChild添加节点
                            foreach ($sub as $key => $row) {
                                if (in_array($key, array('loc','lastmod','changefreq','priority'))) {
                                    if ($key == 'loc') {
                                        if ($sub['is_part'] == 1) {
                                            $row = $sub['typelink'];
                                        } else {
                                            if ($val['level'] == 1){
                                                $sub['province_id'] = $val['id'];
                                            }else if($val['level'] == 2){
                                                $sub['city_id'] = $val['id'];
                                            }else if($val['level'] == 3){
                                                $sub['area_id'] = $val['id'];
                                            }
                                            $row = get_typeurl($sub, false);
                                        }
                                        $row = str_replace('&amp;', '&', $row);
                                        $row = str_replace('&', '&amp;', $row);
                                    } else if ($key == 'lastmod') {
                                        $row = date('Y-m-d');
                                    } else if ($key == 'changefreq') {
                                        $row = $sitemap_changefreq_list;
                                    } else if ($key == 'priority') {
                                        $row = $sitemap_priority_list;
                                    }
                                    try {
                                        $node = $item->addChild($key, $row);
                                    } catch (\Exception $e) {}
                                    if (isset($attribute_array[$key]) && is_array($attribute_array[$key])) {
                                        foreach ($attribute_array[$key] as $akey => $aval) {//设置属性值，我这里为空
                                            $node->addAttribute($akey, $aval);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            }
        }else{
            /*所有栏目*/
            foreach ($result_arctype as $sub) {
                if (is_array($sub)) {
                    $item = $xml->addChild('url'); //使用addChild添加节点
                    foreach ($sub as $key => $row) {
                        if (in_array($key, array('loc','lastmod','changefreq','priority'))) {
                            if ($key == 'loc') {
                                if ($sub['is_part'] == 1) {
                                    $row = $sub['typelink'];
                                } else {
                                    $row = get_typeurl($sub, false);
                                }
                                $row = str_replace('&amp;', '&', $row);
                                $row = str_replace('&', '&amp;', $row);
                            } else if ($key == 'lastmod') {
                                $row = date('Y-m-d');
                            } else if ($key == 'changefreq') {
                                $row = $sitemap_changefreq_list;
                            } else if ($key == 'priority') {
                                $row = $sitemap_priority_list;
                            }
                            try {
                                $node = $item->addChild($key, $row);
                            } catch (\Exception $e) {}
                            if (isset($attribute_array[$key]) && is_array($attribute_array[$key])) {
                                foreach ($attribute_array[$key] as $akey => $aval) {//设置属性值，我这里为空
                                    $node->addAttribute($akey, $aval);
                                }
                            }
                        }
                    }
                }
            }
            /*--end*/
        }
        /*--end*/

        /*所有文档*/
        foreach ($result_archives as $val) {
            if (is_array($val) && isset($result_arctype[$val['typeid']])) {
                $item = $xml->addChild('url'); //使用addChild添加节点
                $val = array_merge($result_arctype[$val['typeid']], $val);
                foreach ($val as $key => $row) {
                    if (in_array($key, array('loc','lastmod','changefreq','priority'))) {
                        if ($key == 'loc') {
                            if ($val['is_jump'] == 1) {
                                $row = $val['jumplinks'];
                            } else {
                                $row = get_arcurl($val, false);
                            }
                            $row = str_replace('&amp;', '&', $row);
                            $row = str_replace('&', '&amp;', $row);
                        } else if ($key == 'lastmod') {
                            $lastmod_time = empty($val['update_time']) ? $val['add_time'] : $val['update_time'];
                            $row = date('Y-m-d', $lastmod_time);
                        } else if ($key == 'changefreq') {
                            $row = $sitemap_changefreq_view;
                        } else if ($key == 'priority') {
                            $row = $sitemap_priority_view;
                        }
                        try {
                            $node = $item->addChild($key, $row);
                        } catch (\Exception $e) {}
                        if (isset($attribute_array[$key]) && is_array($attribute_array[$key])) {
                            foreach ($attribute_array[$key] as $akey => $aval) {//设置属性值，我这里为空
                                $node->addAttribute($akey, $aval);
                            }
                        }
                    }
                }
            }
        }
        /*--end*/

        $content = $xml->asXML(); //用asXML方法输出xml，默认只构造不输出。
        @file_put_contents($filename, $content);
    }
}

if (!function_exists('get_typeurl')) 
{
    /**
     * 获取栏目链接
     *
     * @param array $arctype_info 栏目信息
     * @param boolean $admin 后台访问链接，还是前台链接
     */
    function get_typeurl($arctype_info = array(), $admin = true)
    {
        /*兼容采集没有归属栏目的文档*/
        if (empty($arctype_info['current_channel'])) {
            $channelRow = \think\Db::name('channeltype')->field('id as channel')
                ->where('id',1)
                ->find();
            $arctype_info = array_merge($arctype_info, $channelRow);
        }
        /*--end*/
        
        static $result = null;
        null === $result && $result = model('Channeltype')->getAll('id, ctl_name', array(), 'id');
        $ctl_name = '';
        if ($result) {
            $ctl_name = $result[$arctype_info['current_channel']]['ctl_name'];
        }

        static $seo_pseudo = null;
        static $seo_dynamic_format = null;
        if (null === $seo_pseudo || null === $seo_dynamic_format) {
            $seoConfig = tpCache('seo');
            $seo_pseudo = !empty($seoConfig['seo_pseudo']) ? $seoConfig['seo_pseudo'] : config('ey_config.seo_pseudo');
            $seo_dynamic_format = !empty($seoConfig['seo_dynamic_format']) ? $seoConfig['seo_dynamic_format'] : config('ey_config.seo_dynamic_format');
        }

        if (2 == $seo_pseudo && $admin) {
            $typeurl = ROOT_DIR."/index.php?m=home&c=Lists&a=index&tid={$arctype_info['id']}&t=".getTime();
        } else {
            static $domain = null;
            null === $domain && $domain = request()->domain();
            $typeurl = typeurl("home/{$ctl_name}/lists", $arctype_info, true, false, $seo_pseudo, $seo_dynamic_format);
//            $typeurl = typeurl("home/{$ctl_name}/lists", $arctype_info, true, $domain, $seo_pseudo, $seo_dynamic_format);
        }
        // 自动隐藏index.php入口文件
        $typeurl = auto_hide_index($typeurl);

        return $typeurl;
    }
}

if (!function_exists('get_arcurl')) 
{
    /**
     * 获取文档链接
     *
     * @param array $arctype_info 栏目信息
     * @param boolean $admin 后台访问链接，还是前台链接
     */
    function get_arcurl($arcview_info = array(), $admin = true)
    {
        /*兼容采集没有归属栏目的文档*/
        if (empty($arcview_info['channel'])) {
            $channelRow = \think\Db::name('channeltype')->field('id as channel')
                ->where('id',1)
                ->find();
            $arcview_info = array_merge($arcview_info, $channelRow);
        }
        /*--end*/
        static $result = null;
        null === $result && $result = model('Channeltype')->getAll('id, ctl_name', array(), 'id');
        $ctl_name = '';
        if ($result) {
            $ctl_name = $result[$arcview_info['channel']]['ctl_name'];
        }

        static $seo_pseudo = null;
        static $seo_dynamic_format = null;
        if (null === $seo_pseudo || null === $seo_dynamic_format) {
            $seoConfig = tpCache('seo');
            $seo_pseudo = !empty($seoConfig['seo_pseudo']) ? $seoConfig['seo_pseudo'] : config('ey_config.seo_pseudo');
            $seo_dynamic_format = !empty($seoConfig['seo_dynamic_format']) ? $seoConfig['seo_dynamic_format'] : config('ey_config.seo_dynamic_format');
        }
        static $domain = null;
        null === $domain && $domain = request()->domain();
        if (!empty($arcview_info['room'])){
            unset($arcview_info['room']);
        }
        $arcurl = arcurl("home/{$ctl_name}/view", $arcview_info, true,false,$seo_pseudo,$seo_dynamic_format);
        if (2 != $seo_pseudo){
            // 自动隐藏index.php入口文件
            $arcurl = auto_hide_index($arcurl);
        }
//        if (2 == $seo_pseudo && $admin) {
//            $arcurl = ROOT_DIR."/index.php?m=home&c=View&a=index&aid={$arcview_info['aid']}&t=".getTime();
//        } else {
//            static $domain = null;
//            null === $domain && $domain = request()->domain();
//            $arcurl = arcurl("home/{$ctl_name}/view", $arcview_info, true, $domain, $seo_pseudo, $seo_dynamic_format);
//            // 自动隐藏index.php入口文件
//            $arcurl = auto_hide_index($arcurl);
//        }

        return $arcurl;
    }
}

if (!function_exists('get_total_arc')) 
{
    /**
     * 获取指定栏目的文档数
     */
    function get_total_arc($typeid)
    {
        $total = 0;
        $current_channel = M('arctype')->where('id', $typeid)->getField('current_channel');
        $allow_release_channel = config('global.allow_release_channel');
        if (in_array($current_channel, $allow_release_channel)) { // 能发布文档的模型
            $result = model('Arctype')->getHasChildren($typeid);
            $typeidArr = get_arr_column($result, 'id');
            $map = array(
                'typeid'    => array('IN', $typeidArr),
                'channel'    => array('eq', $current_channel),
                'is_del'    => 0, // 回收站功能
            );
            $total = M('archives')->where($map)->count();
        } elseif ($current_channel == 8) { // 留言模型
            $total = M('guestbook')->where(array('typeid'=>array('eq', $typeid)))->count();
        }

        return $total;
    }
}

if (!function_exists('replace_path')) 
{
    /**
     * 将路径斜杆、反斜杠替换为冒号符，适用于IIS服务器在URL上的双重转义限制
     * @param string $filepath 相对路径
     * @param string $replacement 目标字符
     * @param boolean $is_back false为替换，true为还原
     */
    function replace_path($filepath = '', $replacement = ':', $is_back = false)
    {
        if (false == $is_back) {
            $filepath = str_replace(DIRECTORY_SEPARATOR, $replacement, $filepath);
            $filepath = preg_replace('#\/#', $replacement, $filepath);
        } else {
            $filepath = preg_replace('#'.$replacement.'#', '/', $filepath);
            $filepath = str_replace('//', ':/', $filepath);
        }
        return $filepath;
    }
}

if (!function_exists('get_seo_pseudo_list')) 
{
    /**
     * URL模式下拉列表
     */
    function get_seo_pseudo_list($key = '')
    {
        $data = array(
            1   => '动态URL',
            3   => '伪静态化',
            // 2   => '静态页面',
        );

        return isset($data[$key]) ? $data[$key] : $data;
    }
}

if (!function_exists('get_chown_pathinfo')) 
{
    /**
     * 对指定的操作系统获取目录的所有组与所有者
     * @param string $path 目录路径
     * @return array
     */
    function get_chown_pathinfo($path = '') 
    {
        $pathinfo = true;

        if (function_exists('stat')) {
            /*指定操作系统，在列表内才进行后续获取*/
            $isValidate = false;
            $os = PHP_OS;
            $osList = array('linux','unix');
            foreach ($osList as $key => $val) {
                if (stristr($os, $val)) {
                    $isValidate = true;
                    continue;
                }
            }
            /*--end*/

            if (true === $isValidate) {
                $path = !empty($path) ? $path : ROOT_PATH;
                $stat = stat($path);
                if (function_exists('posix_getpwuid')) {
                    $pathinfo = posix_getpwuid($stat['uid']); 
                } else {
                    $pathinfo = array(
                        'name'  => (0 == $stat['uid']) ? 'root' : '',
                        'uid'  => $stat['uid'],
                        'gid'  => $stat['gid'],
                    );
                }
            }
        }

        return $pathinfo;
    }
}

if (!function_exists('auto_hide_index')) 
{
    /**
     * URL中隐藏index.php入口文件（适用后台显示前台的URL）
     */
    function auto_hide_index($url) {
        static $web_adminbasefile = null;
        if (null === $web_adminbasefile) {
            $web_adminbasefile = tpCache('web.web_adminbasefile');
            $web_adminbasefile = !empty($web_adminbasefile) ? $web_adminbasefile : ROOT_DIR.'/login.php'; // 支持子目录
        }
        $url = str_replace($web_adminbasefile, ROOT_DIR.'/index.php', $url); // 支持子目录
        $seo_inlet = config('ey_config.seo_inlet');
        if (1 == $seo_inlet) {
            $url = str_replace('/index.php/', '/', $url);
        }
        return $url;
    }
}

if (!function_exists('menu_select')) 
{
    /*组装成层级下拉列表框*/
    function menu_select($selected = 0)
    {
        $select_html = '';
        $menuArr = getAllMenu();
        if (!empty($menuArr)) {
            foreach ($menuArr AS $key => $val)
            {
                $select_html .= '<option value="' . $val['id'] . '" data-grade="' . $val['grade'] . '"';
                $select_html .= ($selected == $val['id']) ? ' selected="ture"' : '';
                if (!empty($val['child'])) {
                    $select_html .= ' disabled="true" style="background-color:#f5f5f5;"';
                }
                $select_html .= '>';
                if ($val['grade'] > 0)
                {
                    $select_html .= str_repeat('&nbsp;', $val['grade'] * 4);
                }
                $name = !empty($val['name']) ? $val['name'] : '默认';
                $select_html .= htmlspecialchars(addslashes($name)) . '</option>';

                if (empty($val['child'])) {
                    continue;
                }
                foreach ($menuArr[$key]['child'] as $key2 => $val2) {
                    $select_html .= '<option value="' . $val2['id'] . '" data-grade="' . $val2['grade'] . '"';
                    $select_html .= ($selected == $val2['id']) ? ' selected="ture"' : '';
                    if (!empty($val2['child'])) {
                        $select_html .= ' disabled="true" style="background-color:#f5f5f5;"';
                    }
                    $select_html .= '>';
                    if ($val2['grade'] > 0)
                    {
                        $select_html .= str_repeat('&nbsp;', $val2['grade'] * 4);
                    }
                    $select_html .= htmlspecialchars(addslashes($val2['name'])) . '</option>';

                    if (empty($val2['child'])) {
                        continue;
                    }
                    foreach ($menuArr[$key]['child'][$key2]['child'] as $key3 => $val3) {
                        $select_html .= '<option value="' . $val3['id'] . '" data-grade="' . $val3['grade'] . '"';
                        $select_html .= ($selected == $val3['id']) ? ' selected="ture"' : '';
                        if (!empty($val3['child'])) {
                            $select_html .= ' disabled="true" style="background-color:#f5f5f5;"';
                        }
                        $select_html .= '>';
                        if ($val3['grade'] > 0)
                        {
                            $select_html .= str_repeat('&nbsp;', $val3['grade'] * 4);
                        }
                        $select_html .= htmlspecialchars(addslashes($val3['name'])) . '</option>';
                    }
                }
            }
        }

        return $select_html;
    }
}

if (!function_exists('schemaTable')) 
{
    /**
     * 重新生成数据表缓存字段文件
     */
    function schemaTable($name)
    {
        $table = $name;
        $prefix = \think\Config::get('database.prefix');
        if (!preg_match('/^'.$prefix.'/i', $name)) {
            $table = $prefix.$name;
        }
        /*调用命令行的指令*/
        \think\Console::call('optimize:schema', ['--table', $table]);
        /*--end*/
    }
}

if (!function_exists('testWriteAble')) 
{
    /**
     * 测试目录路径是否有写入权限
     * @param string $d 目录路劲
     * @return boolean
     */
    function testWriteAble($filepath)
    {
        $tfile = '_ejut.txt';
        $fp = @fopen($filepath.$tfile,'w');
        if(!$fp) {
            return false;
        }
        else {
            fclose($fp);
            $rs = @unlink($filepath.$tfile);
            return true;
        }
    }
}

if (!function_exists('showArchivesFlagStr')) 
{
    /**
     * 在文档列表显示文档属性标识
     * @param array $archivesInfo 文档信息
     * @return string
     */
    function showArchivesFlagStr($archivesInfo = [])
    {
        $arr = [];
        $channel_list = getChanneltypeList();
        foreach ($channel_list as $key=>$val){
            if ($archivesInfo['channel'] == $key){
                if ($val['nid'] == 'article'){
                    if (!empty($archivesInfo['is_head'])) {
                        $arr['is_head'] = [
                            'small_name'   => '头条',
                        ];
                    }
                    if (!empty($archivesInfo['is_recom'])) {
                        $arr['is_recom'] = [
                            'small_name'   => '推荐',
                        ];
                    }
                    if (!empty($archivesInfo['is_special'])) {
                        $arr['is_special'] = [
                            'small_name'   => '幻灯',
                        ];
                    }
                    if (!empty($archivesInfo['is_b'])) {
                        $arr['is_b'] = [
                            'small_name'   => '加粗',
                        ];
                    }
                    if (!empty($archivesInfo['is_litpic'])) {
                        $arr['is_litpic'] = [
                            'small_name'   => '图片',
                        ];
                    }
                    if (!empty($archivesInfo['is_jump'])) {
                        $arr['is_jump'] = [
                            'small_name'   => '跳转',
                        ];
                    }
                }else if($val['nid'] == 'xinfang'){
                    if (!empty($archivesInfo['is_head'])) {
                        $arr['is_head'] = [
                            'small_name'   => '刚需',
                        ];
                    }
                    if (!empty($archivesInfo['is_recom'])) {
                        $arr['is_recom'] = [
                            'small_name'   => '推荐',
                        ];
                    }
                    if (!empty($archivesInfo['is_special'])) {
                        $arr['is_special'] = [
                            'small_name'   => '特推',
                        ];
                    }
                    if (!empty($archivesInfo['is_b'])) {
                        $arr['is_b'] = [
                            'small_name'   => '热销',
                        ];
                    }
                    if (!empty($archivesInfo['is_litpic'])) {
                        $arr['is_litpic'] = [
                            'small_name'   => '图片',
                        ];
                    }
                    if (!empty($archivesInfo['is_sale'])) {
                        $arr['is_sale'] = [
                            'small_name'   => '特价',
                        ];
                    }
                    if (!empty($archivesInfo['is_moods'])) {
                        $arr['is_moods'] = [
                            'small_name'   => '人气',
                        ];
                    }
                    if (!empty($archivesInfo['is_jump'])) {
                        $arr['is_jump'] = [
                            'small_name'   => '跳转',
                        ];
                    }
                }else if($val['nid'] == 'shopcz'){
                    if (!empty($archivesInfo['is_recom'])) {
                        $arr['is_recom'] = [
                            'small_name'   => '推荐',
                        ];
                    }
                    if (!empty($archivesInfo['is_head'])) {
                        $arr['is_head'] = [
                            'small_name'   => '热点',
                        ];
                    }
                }
            }
        }

        return $arr;
    }
}