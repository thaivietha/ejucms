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

if (3 == $seo_pseudo) {
    $rewrite = [];
    $rewrite_str = '';
    /*多站点*/
    if (stristr($request->baseFile(), 'index.php') && isMobile()) {
        if (1 == $web_region_domain) {
            $subdomain = \think\Cookie::get('subdomain');
            $rewrite_str = $subdomain.'/';
            $rewrite = [
                // 首页
                $rewrite_str.'$' => array('home/Index/index',array('method' => 'get', 'ext' => ''), 'cache'=>1),
            ];
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
            $rewrite_str.'<dirname>/<aid>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>/<column>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>/<column>_<sid>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'<dirname>/<aid>/<column>_<photo_type>$' => array('home/View/index',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
        );
    } else {
        $home_rewrite = array(
            // 文章模型伪静态
            $rewrite_str.'article$' => array('home/Article/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'article/<tid>$' => array('home/Article/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'article/<dirname>/<aid>$' => array('home/Article/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 楼盘模型伪静态
            $rewrite_str.'xinfang$' => array('home/Xinfang/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'xinfang/<tid>$' => array('home/Xinfang/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>_<sid>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            $rewrite_str.'xinfang/<dirname>/<aid>/<column>_<photo_type>$' => array('home/Xinfang/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 团购模型伪静态
            $rewrite_str.'tuan$' => array('home/Tuan/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'tuan/<tid>$' => array('home/Tuan/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'tuan/<dirname>/<aid>$' => array('home/Tuan/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 图集模型伪静态
            $rewrite_str.'images$' => array('home/Images/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'images/<tid>$' => array('home/Images/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'images/<dirname>/<aid>$' => array('home/Images/view',array('method' => 'get', 'ext' => 'html'),'cache'=>1),
            // 单页模型伪静态
            $rewrite_str.'single$' => array('home/Single/index',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
            $rewrite_str.'single/<tid>$' => array('home/Single/lists',array('method' => 'get', 'ext' => 'html'), 'cache'=>1),
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