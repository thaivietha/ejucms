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

// 模板错误提示
switch_exception();

if (!function_exists('set_home_url_mode')) 
{
    // 设置前台URL模式
    function set_home_url_mode() {
        $seo_pseudo = tpCache('seo.seo_pseudo');
        if ($seo_pseudo == 1) {
            config('url_common_param', true);
            config('url_route_on', false);
        } elseif ($seo_pseudo == 2) {
            config('url_common_param', false);
            config('url_route_on', true);
        } elseif ($seo_pseudo == 3) {
            config('url_common_param', false);
            config('url_route_on', true);
        }
    }
}

if (!function_exists('set_arcseotitle')) 
{
    /**
     * 设置内容标题
     */
    function set_arcseotitle($title = '', $seo_title = '', $typename = '')
    {
        /*针对没有自定义SEO标题的文档*/
        if (empty($seo_title)) {
            static $web_name = null;
            null === $web_name && $web_name = tpCache('web.web_name');
            static $seo_viewtitle_format = null;
            null === $seo_viewtitle_format && $seo_viewtitle_format = tpCache('seo.seo_viewtitle_format');
            switch ($seo_viewtitle_format) {
                case '1':
                    $seo_title = $title;
                    break;
                
                case '3':
                    $seo_title = $title.'_'.$typename.'_'.$web_name;
                    break;
                
                case '2':
                default:
                    $seo_title = $title.'_'.$web_name;
                    break;
            }
        }else{  //过滤标签
            $seo_title = set_str_replace($seo_title, $title);
        }
        /*--end*/

        return $seo_title;
    }
}

if (!function_exists('set_typeseotitle')) 
{
    /**
     * 设置栏目标题
     */
    function set_typeseotitle($typename = '', $seo_title = '')
    {
        /*针对没有自定义SEO标题的列表*/
        if (empty($seo_title)) {
            $web_name = tpCache('web.web_name');
            $seo_liststitle_format = tpCache('seo.seo_liststitle_format');
            switch ($seo_liststitle_format) {
                case '1':
                    $seo_title = $typename.'_'.$web_name;
                    break;
                
                case '2':
                default:
                    $page = I('param.page/d', 1);
                    if ($page > 1) {
                        $typename .= "_第{$page}页";
                    }
                    $seo_title = $typename.'_'.$web_name;
                    break;
            }
        }else{  //过滤标签
            $seo_title = set_str_replace($seo_title, $typename);
        }

        return $seo_title;
    }
}

if (!function_exists('set_str_replace')) 
{
    /**
     * 自动替换区域变量、标题变量
     * @param string $seo_title [description]
     * @param string $title     [description]
     */
    function set_str_replace($seo_title = '', $title = '')
    {
        $regionInfo = \think\Cookie::get("regionInfo");
        if (!empty($regionInfo)) {
            if(is_json($regionInfo))
            {
                $regionInfo = json_decode($regionInfo,true);
            }
            $search = ['{{region}}', '{{title}}'];
            $replace = [$regionInfo['name'], $title];
            $seo_title = str_replace($search, $replace, $seo_title);
        }

        return $seo_title;
    }
}

//获取房间配套图片url
if (!function_exists('get_supporting_icon')) {
    function get_supporting_icon($name){
        $name = func_preg_replace([' ','　'], '', $name);
        $name = get_pinyin($name);

        return ROOT_DIR . '/public/static/common/images/supporting/'.$name.'.png';
    }
}