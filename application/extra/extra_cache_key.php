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
// 整站cache缓存key键值存放处，统一管理
// 注意：键名要唯一，不然会出现缓存错乱。
// 参考格式如下：
// 格式：模块_控制器_操作名[_序号]
// 1、中括号的序号可选，在同一个操作名内用于区分开。
// 2、键名不区分大写小写，要注意大小写，系统自己转为小写处理在md5()加密处理。

return array(
    /* -------------------------全局使用------------------------- */
    'common_getEveryTopDirnameList_model'     => array(
        'tag'=>'arctype', 'options'=>array('expire'=>0, 'prefix'=>'')
    ),
    'global_get_province_list'     => array(
        'tag'=>'region', 'options'=>array('expire'=>86400, 'prefix'=>'')
    ),
    'global_get_city_list'     => array(
        'tag'=>'region', 'options'=>array('expire'=>86400, 'prefix'=>'')
    ),
    'global_get_area_list'     => array(
        'tag'=>'region', 'options'=>array('expire'=>86400, 'prefix'=>'')
    ),

    /* -------------------------前台使用------------------------- */

    /* -------------------------后台使用------------------------- */
    'admin_all_menu'     => array(
        'tag'=>'admin_common', 'options'=>array('expire'=>43200, 'prefix'=>'')
    ),
    'admin_auth_role_list_logic'     => array(
        'tag'=>'admin_logic', 'options'=>array('expire'=>-1, 'prefix'=>'')
    ),
    'admin_auth_modular_list_logic'     => array(
        'tag'=>'admin_logic', 'options'=>array('expire'=>-1, 'prefix'=>'')
    ),
    'admin_channeltype_list_logic'     => array(
        'tag'=>'admin_logic', 'options'=>array('expire'=>86400, 'prefix'=>'')
    ),
);