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

$home_rewrite = array();
$route = array(
    '__pattern__' => array(
        'tid' => '\w+',
        'aid' => '\d+',
        'column' =>  '\w+',
        'photo_type' =>  '.*?',
    ),
    '__alias__' => array(),
    '__domain__' => [
        '*' => 'home?domain=*',
    ],
);

$globalTpCache = tpCache('global');
config('tpcache', $globalTpCache);
// mysql的sql-mode模式参数
$system_sql_mode = !empty($globalTpCache['system_sql_mode']) ? $globalTpCache['system_sql_mode'] : config('ey_config.system_sql_mode');
config('ey_config.system_sql_mode', $system_sql_mode);
// 是否https链接
$is_https = !empty($globalTpCache['web_is_https']) ? true : config('is_https');
config('is_https', $is_https);
// 模板风格
$system_tpl_theme = !empty($globalTpCache['system_tpl_theme']) ? $globalTpCache['system_tpl_theme'] : config('ey_config.system_tpl_theme');
config('ey_config.system_tpl_theme', $system_tpl_theme);
// 子站点开关
$web_region_domain = !empty($globalTpCache['web_region_domain']) ? $globalTpCache['web_region_domain'] : config('ey_config.web_region_domain');
config('ey_config.web_region_domain', $web_region_domain);
// 手机独立域名的开启
$web_mobile_domain_open = !empty($globalTpCache['web_mobile_domain_open']) ? $globalTpCache['web_mobile_domain_open'] : config('ey_config.web_mobile_domain_open');
config('ey_config.web_mobile_domain_open', $web_mobile_domain_open);
// 手机独立域名
$web_mobile_domain = !empty($globalTpCache['web_mobile_domain']) ? $globalTpCache['web_mobile_domain'] : config('ey_config.web_mobile_domain');
config('ey_config.web_mobile_domain', $web_mobile_domain);
// 前台默认区域
$system_default_subdomain = !empty($globalTpCache['system_default_subdomain']) ? $globalTpCache['system_default_subdomain'] : config('ey_config.system_default_subdomain');
config('ey_config.system_default_subdomain', $system_default_subdomain);
// URL模式
$seo_pseudo = !empty($globalTpCache['seo_pseudo']) ? intval($globalTpCache['seo_pseudo']) : config('ey_config.seo_pseudo');
config('ey_config.seo_pseudo', $seo_pseudo);
// 动态URL格式
$seo_dynamic_format = !empty($globalTpCache['seo_dynamic_format']) ? intval($globalTpCache['seo_dynamic_format']) : config('ey_config.seo_dynamic_format');
config('ey_config.seo_dynamic_format', $seo_dynamic_format);
// 伪静态格式
$seo_rewrite_format = !empty($globalTpCache['seo_rewrite_format']) ? intval($globalTpCache['seo_rewrite_format']) : config('ey_config.seo_rewrite_format');
config('ey_config.seo_rewrite_format', $seo_rewrite_format); 
// 是否隐藏入口文件
$seo_inlet = !empty($globalTpCache['seo_inlet']) ? $globalTpCache['seo_inlet'] : config('ey_config.seo_inlet');
config('ey_config.seo_inlet', $seo_inlet);
//伪静态模式
if (3 == $seo_pseudo) {
    $rewrite = [];
    $rewrite_str = '';
    /*多站点手机端加上站点区域*/
    if (stristr($request->baseFile(), 'index.php') && (isMobile() || $request->subDomain() == $web_mobile_domain)) {
        if (1 == $web_region_domain) {
            $subdomain = \think\Cookie::get('subdomain');
            $rewrite_str = $subdomain.'/';
            if (1 == $seo_rewrite_format){
                $rewrite = [
                    '<subdomain>/search$' => array('home/Search/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/<tid>$' => array('home/Lists/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
                    '<subdomain>/$' => array('home/Index/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
                ];
            }else{
                $rewrite = [
                    '<subdomain>/search$' => array('home/Search/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    //模型标识
                    '<subdomain>/article/<tid>$' => array('home/Article/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/xinfang/<tid>$' => array('home/Xinfang/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/tuan/<tid>$' => array('home/Tuan/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/images/<tid>$' => array('home/Images/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/single/<tid>$' => array('home/Single/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/xiaoqu/<tid>$' => array('home/Xiaoqu/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/ershou/<tid>$' => array('home/Ershou/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/zufang/<tid>$' => array('home/Zufang/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/officecs/<tid>$' => array('home/Officecs/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/officecz/<tid>$' => array('home/Officecz/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/shopcs/<tid>$' => array('home/Shopcs/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/shopcz/<tid>$' => array('home/Shopcz/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/qiuzu/<tid>$' => array('home/Qiuzu/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                    '<subdomain>/$' => array('home/Index/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
                ];
            }

        }
    }
    /*--end*/
    if (1 == $seo_rewrite_format) { // 精简伪静态
        $home_rewrite = array(
            // 标签伪静态
            $rewrite_str.'tags$' => array('home/Tags/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
            $rewrite_str.'tags/<tagid>$' => array('home/Tags/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            // 搜索伪静态
            $rewrite_str.'search$' => array('home/Search/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            // 列表页
            $rewrite_str.'<tid>$' => array('home/Lists/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
            //内容详情页
            $rewrite_str.'<dirname>/<aid>/<column>_<sid>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>/<column>_<photo_type>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>/<column>/<room>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>/<column>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
        );
    } else {
        $home_rewrite = array(
            // 文章模型伪静态
            $rewrite_str.'article/<tid>$' => array('home/Article/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'article/<dirname>/<aid>/<column>_<sid>$' => array('home/Article/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'article/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Article/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'article/<dirname>/<aid>/<column>/<room>$' => array('home/Article/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'article/<dirname>/<aid>/<column>$' => array('home/Article/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'article/<dirname>/<aid>$' => array('home/Article/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),

            // 楼盘模型伪静态
            $rewrite_str.'xinfang/<tid>$' => array('home/Xinfang/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>_<sid>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>/<room>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 团购模型伪静态
            $rewrite_str.'tuan/<tid>$' => array('home/Tuan/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'tuan/<dirname>/<aid>/<column>_<sid>$' => array('home/Tuan/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'tuan/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Tuan/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'tuan/<dirname>/<aid>/<column>/<room>$' => array('home/Tuan/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'tuan/<dirname>/<aid>/<column>$' => array('home/Tuan/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'tuan/<dirname>/<aid>$' => array('home/Tuan/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 图集模型伪静态
            $rewrite_str.'images/<tid>$' => array('home/Images/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'images/<dirname>/<aid>/<column>_<sid>$' => array('home/Images/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'images/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Images/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'images/<dirname>/<aid>/<column>/<room>$' => array('home/Images/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'images/<dirname>/<aid>/<column>$' => array('home/Images/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'images/<dirname>/<aid>$' => array('home/Images/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 单页模型伪静态
            $rewrite_str.'single/<tid>$' => array('home/Single/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            // 小区模型伪静态
            $rewrite_str.'xiaoqu/<tid>$' => array('home/Xiaoqu/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'xiaoqu/<dirname>/<aid>/<column>_<sid>$' => array('home/Xiaoqu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xiaoqu/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Xiaoqu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xiaoqu/<dirname>/<aid>/<column>/<room>$' => array('home/Xiaoqu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xiaoqu/<dirname>/<aid>/<column>$' => array('home/Xiaoqu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xiaoqu/<dirname>/<aid>$' => array('home/Xiaoqu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 二手房模型伪静态
            $rewrite_str.'ershou/<tid>$' => array('home/Ershou/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'ershou/<dirname>/<aid>/<column>_<sid>$' => array('home/Ershou/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'ershou/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Ershou/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'ershou/<dirname>/<aid>/<column>/<room>$' => array('home/Ershou/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'ershou/<dirname>/<aid>/<column>$' => array('home/Ershou/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'ershou/<dirname>/<aid>$' => array('home/Ershou/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 租房模型伪静态
            $rewrite_str.'zufang/<tid>$' => array('home/Zufang/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'zufang/<dirname>/<aid>/<column>_<sid>$' => array('home/Zufang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'zufang/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Zufang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'zufang/<dirname>/<aid>/<column>/<room>$' => array('home/Zufang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'zufang/<dirname>/<aid>/<column>$' => array('home/Zufang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'zufang/<dirname>/<aid>$' => array('home/Zufang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            //商铺出售模型伪静态
            $rewrite_str.'shopcs/<tid>$' => array('home/Shopcs/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'shopcs/<dirname>/<aid>/<column>_<sid>$' => array('home/Shopcs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcs/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Shopcs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcs/<dirname>/<aid>/<column>/<room>$' => array('home/Shopcs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcs/<dirname>/<aid>/<column>$' => array('home/Shopcs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcs/<dirname>/<aid>$' => array('home/Shopcs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            //商铺出租模型伪静态
            $rewrite_str.'shopcz/<tid>$' => array('home/Shopcz/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'shopcz/<dirname>/<aid>/<column>_<sid>$' => array('home/Shopcz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcz/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Shopcz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcz/<dirname>/<aid>/<column>/<room>$' => array('home/Shopcz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcz/<dirname>/<aid>/<column>$' => array('home/Shopcz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'shopcz/<dirname>/<aid>$' => array('home/Shopcz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            //写字楼出售模型伪静态
            $rewrite_str.'officecs/<tid>$' => array('home/Officecs/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'officecs/<dirname>/<aid>/<column>_<sid>$' => array('home/Officecs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecs/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Officecs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecs/<dirname>/<aid>/<column>/<room>$' => array('home/Officecs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecs/<dirname>/<aid>/<column>$' => array('home/Officecs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecs/<dirname>/<aid>$' => array('home/Officecs/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            //写字楼出租模型伪静态
            $rewrite_str.'officecz/<tid>$' => array('home/Officecz/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'officecz/<dirname>/<aid>/<column>_<sid>$' => array('home/Officecz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecz/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Officecz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecz/<dirname>/<aid>/<column>/<room>$' => array('home/Officecz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecz/<dirname>/<aid>/<column>$' => array('home/Officecz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'officecz/<dirname>/<aid>$' => array('home/Officecz/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            //求租模型伪静态
            $rewrite_str.'qiuzu/<tid>$' => array('home/Qiuzu/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'qiuzu/<dirname>/<aid>/<column>_<sid>$' => array('home/Qiuzu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'qiuzu/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Qiuzu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'qiuzu/<dirname>/<aid>/<column>/<room>$' => array('home/Qiuzu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'qiuzu/<dirname>/<aid>/<column>$' => array('home/Qiuzu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'qiuzu/<dirname>/<aid>$' => array('home/Qiuzu/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 标签伪静态
            $rewrite_str.'tags$' => array('home/Tags/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
            $rewrite_str.'tags/<tagid>$' => array('home/Tags/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            // 搜索伪静态
            $rewrite_str.'search$' => array('home/Search/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        );
        /*自定义模型*/
        $cacheKey = "application_route_channeltype";
        $channeltype_row = \think\Cache::get($cacheKey);
        if (empty($channeltype_row)) {
            $channeltype_row = \think\Db::name('channeltype')->field('nid,ctl_name')
                ->where([
                    'ifsystem' => 0,
                ])
                ->select();
            \think\Cache::set($cacheKey, $channeltype_row, EYOUCMS_CACHE_TIME, "channeltype");
        }
        foreach ($channeltype_row as $value) {
            $home_rewrite += array(
                $rewrite_str.$value['nid'].'$' => array('home/'.$value['ctl_name'].'/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                $rewrite_str.$value['nid'].'/<tid>$' => array('home/'.$value['ctl_name'].'/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
                $rewrite_str.$value['nid'].'/<dirname>/<aid>$' => array('home/'.$value['ctl_name'].'/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            );
        }
        /*--end*/
    }
    /*问答模型*/
    $home_rewrite += [
        $rewrite_str.'ask/list_<is_recom>_<aid>$' => array('home/Ask/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'ask/list_<is_recom>$' => array('home/Ask/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'ask$' => array('home/Ask/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
//        $rewrite_str.'ask/add_<aid>$' => array('home/Ask/add_ask',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
//        $rewrite_str.'ask/add$' => array('home/Ask/add_ask',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
//        $rewrite_str.'ask/edit_<ask_id>$' => array('home/Ask/edit_ask',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'ask/view_<ask_id>_<orderby>$' => array('home/Ask/details',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'ask/view_<ask_id>$' => array('home/Ask/details',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
//        $rewrite_str.'aswer/edit_<answer_id>$' => array('home/Ask/ajax_edit_answer',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
    ];
    /*经纪人*/
    $home_rewrite += [
        $rewrite_str.'agent/index/<users_id>$' => array('home/Agent/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'agent/ershou/<users_id>$' => array('home/Agent/ershou',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'agent/zufang/<users_id>$' => array('home/Agent/zufang',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'agent/shopcs/<users_id>$' => array('home/Agent/shopcs',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'agent/shopcz/<users_id>$' => array('home/Agent/shopcz',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'agent/officecs/<users_id>$' => array('home/Agent/officecs',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
        $rewrite_str.'agent/officecz/<users_id>$' => array('home/Agent/officecz',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
    ];

    $home_rewrite = array_merge($rewrite, $home_rewrite);

}
/*插件模块路由*/
$weapp_route_file = 'weapp/route.php';
if (file_exists(APP_PATH.$weapp_route_file)) {
    $weapp_route = include_once $weapp_route_file;
    $route = array_merge($weapp_route, $route);
}
/*--end*/

$route = array_merge($route, $home_rewrite);

return $route;
