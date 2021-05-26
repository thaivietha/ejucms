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

$plugins_route = array();

/*引入全部插件的路由配置*/
$route_list = glob(WEAPP_DIR_NAME.DS.'*'.DS.'route.php');
if (!empty($route_list)) {
    foreach ($route_list as $key => $file) {
        $route_value = include_once $file;
        if (!empty($route_value)) {
            $plugins_route = array_merge($route_value, $plugins_route);
        }
    }
}
/*--end*/

$route = array(
    '__pattern__' => array(),
    '__alias__' => array(),
    '__domain__' => array(),
);

$route = array_merge($route, $plugins_route);

return $route;
