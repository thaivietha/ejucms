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

return array(
    // 模板设置
    'template' => array(
        // 模板路径
        'view_path' => './application/api/template/',
        // 模板后缀
        'view_suffix' => 'htm',
        // 模板引擎禁用函数
        'tpl_deny_func_list' => 'eval,echo,exit',
        // 默认模板引擎是否禁用PHP原生代码 苦恼啊！ 鉴于百度统计使用原生php，这里暂时无法开启
        'tpl_deny_php'       => false,
    ),
    // 视图输出字符串内容替换
    'view_replace_str' => array(),
);
?>