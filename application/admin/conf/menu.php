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

// 内容管理
$archives_child = [];
$channel_list = model('Channeltype')->getArctypeChannel('yes');
foreach ($channel_list as $key => $val) {
    if (in_array($val['id'], [6])) {
        continue;
    }
    $parent_id = 1000;
    $id = $parent_id + intval($val['id']);
    $action = 'index';
    if (empty($val['ifsystem'])) {
        $controller = 'Custom';
    } else {
        if (6 == $val['id']) {
            $controller = 'Arctype';
            $action = 'single_index';
        } else {
            $controller = $val['ctl_name'];
        }
    }
    $url = url($controller.'/'.$action, ['channel'=>$val['id']]);
    $archives_child[$id] = [
        'id'=>$id,
        'parent_id'=>$parent_id,
        'name' => $val['ntitle'].'列表',
        'controller'=>$controller,
        'action'=>$action,
        'url'=>$url, 
        'target'=>'_self',
        'icon'=>'',
        'grade'=>1,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[],
    ];
}

/*静态生成*/
$seo_html_arr = [];
if (2 == tpCache('seo.seo_pseudo')) {
    $seo_html_arr = array(
        'is_menu' => 1,
    );
}
/*--end*/

/**
 * 权限模块属性说明
 * array
 *      id  主键ID
 *      parent_id   父ID
 *      name    模块名称
 *      controller  控制器
 *      action  操作名
 *      url     跳转链接(控制器与操作名为空时，才使用url)
 *      target  打开窗口方式
 *      icon    菜单图标
 *      grade   层级
 *      is_menu 是否显示菜单
 *      is_modules  是否显示权限模块分组
 *      is_quick 是否显示快捷菜单
 *      child   子模块
 */
return  [
    '1000'=>[
        'id'=>1000,
        'parent_id'=>0,
        'name' => '内容管理',
        'controller'=>'',
        'action'=>'',
        'url'=>'',
        'target'=>'_self',
        'icon'  => 'layui-icon-file-b',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>$archives_child,
    ],
    '2000'=>[
        'id'=>2000,
        'parent_id'=>0,
        'name'=>'栏目管理',
        'controller'=>'Arctype',
        'action'=>'index',
        'url'=>'', 
        'target'=>'_self',
        'icon'  => 'layui-icon-template-1',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[],
    ],
    '3000'=>[
        'id'=>3000,
        'parent_id'=>0,
        'name'=>'报名管理',
        'controller'=>'Form',
        'action'=>'index',
        'url'=>'', 
        'target'=>'_self',
        'icon'  => 'layui-icon-notice',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[],
    ],
    '4000'=>[
        'id'=>4000,
        'parent_id'=>0,
        'name'=>'系统配置',
        'controller'=>'',
        'action'=>'',
        'url'=>'', 
        'target'=>'_self',
        'icon'  => 'layui-icon-set',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[
            '4001' => [
                'id'=>4001,
                'parent_id'=>4000,
                'name' => '网站信息',
                'controller'=>'System',
                'action'=>'web',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child' => [],
            ],
            '4002' => [
                'id'=>4002,
                'parent_id'=>4000,
                'name' => '图片处理',
                'controller'=>'System',
                'action'=>'water',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '4003' => [
                'id'=>4003,
                'parent_id'=>4000,
                'name' => '区域配置',
                'controller'=>'Region',
                'action'=>'index',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '4004' => [
                'id'=>4004,
                'parent_id'=>4000,
                'name' => '数据备份',
                'controller'=>'Tools',
                'action'=>'index',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '4005' => [
                'id'=>4005,
                'parent_id'=>4000,
                'name' => '管理员',
                'controller'=>'Admin',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '4006' => [
                'id'=>4006,
                'parent_id'=>4000,
                'name' => '经纪人',
                'controller'=>'Saleman',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
        ],
    ],
    '6000'=>[
        'id'=>6000,
        'parent_id'=>0,
        'name'=>'功能模块',
        'controller'=>'',
        'action'=>'',
        'url'=>'', 
        'target'=>'_self',
        'icon'  => 'layui-icon-app',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[
            '6001' => [
                'id'=>6001,
                'parent_id'=>6000,
                'name' => '频道模型',
                'controller'=>'Channeltype',
                'action'=>'index',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child' => [],
            ],
            '6002' => [
                'id'=>6002,
                'parent_id'=>6000,
                'name' => '广告管理',
                'controller'=>'AdPosition',
                'action'=>'index',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child' => [],
            ],
            '6003' => [
                'id'=>6003,
                'parent_id'=>6000,
                'name' => '友情链接',
                'controller'=>'Links',
                'action'=>'index',
                'url'=>'', 
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child' => [],
            ],
            '6005' => [
                'id'=>6005,
                'parent_id'=>6000,
                'name' => 'URL配置',
                'controller'=>'Seo',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '6006' => [
                'id'=>6006,
                'parent_id'=>6000,
                'name' => '静态生成',
                'controller'=>'',
                'action'=>'',
                'url'=>url('Seo/index',['inc_type'=>'html']),
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>!empty($seo_html_arr['is_menu']) ? $seo_html_arr['is_menu'] : 0,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '6007' => [
                'id'=>6007,
                'parent_id'=>6000,
                'name' => '模板管理',
                'controller'=>'Filemanager',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '6004' => [
                'id'=>6004,
                'parent_id'=>6000,
                'name' => 'Tags管理',
                'controller'=>'Tags',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child' => [],
            ],
            '6008' => [
                'id'=>6008,
                'parent_id'=>6000,
                'name' => 'SiteMap',
                'controller'=>'',
                'action'=>'',
                'url'=>url('Seo/index',['inc_type'=>'sitemap']),
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
        ],
    ],
    '8000'=>[
        'id'=>8000,
        'parent_id'=>0,
        'name'=>'会员中心',
        'controller'=>'',
        'action'=>'',
        'url'=>'',
        'target'=>'_self',
        'icon'  => 'layui-icon-user',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[
            '8001' => [
                'id'=>8001,
                'parent_id'=>8000,
                'name' => '会员列表',
                'controller'=>'Users',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '8002' => [
                'id'=>8002,
                'parent_id'=>8000,
                'name' => '等级管理',
                'controller'=>'UsersLevel',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '8003' => [
                'id'=>8003,
                'parent_id'=>8000,
                'name' => '注册设置',
                'controller'=>'UsersConfig',
                'action'=>'register',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
        ],
    ],
];