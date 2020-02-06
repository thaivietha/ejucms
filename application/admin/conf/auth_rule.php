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

/**
 * 权限属性说明
 * array
 *      id  主键ID
 *      menu_id   一级模块ID
 *      menu_id2    二级模块ID
 *      name  权限名称
 *      is_modules 是否显示在分组下
 *      auths  权限列表(格式：控制器@*,控制器@操作名 --多个权限以逗号隔开)
 */
return [
    [
        'id' => 1,
        'menu_id' => 1000,
        'menu_id2' => 0,
        'name'  => '内容管理',
        'is_modules'    => 1,
        'auths' => '',
    ],
    [
        'id' => 2,
        'menu_id' => 2000,
        'menu_id2' => 0,
        'name'  => '栏目管理',
        'is_modules'    => 1,
        'auths' => 'Arctype@index,Arctype@add,Arctype@edit,Arctype@del,Arctype@pseudo_del',
    ],
    [
        'id' => 3,
        'menu_id' => 3000,
        'menu_id2' => 0,
        'name'  => '允许操作',
        'is_modules'    => 1,
        'auths' => 'Form@*',
    ],
    [
        'id' => 4,
        'menu_id' => 4000,
        'menu_id2' => 0,
        'name'  => '系统配置',
        'is_modules'    => 1,
        'auths' => '',
    ],
    [
        'id' => 5,
        'menu_id' => 4001,
        'menu_id2' => 4000,
        'name'  => '网站信息',
        'is_modules'    => 1,
        'auths' => 'System@web,System@customvar_index,System@customvar_save,System@web2,System@basic,System@smtp,System@smtp_tpl,System@send_email,System@sms,System@sms_tpl,System@send_mobile,System@question',
    ],
    [
        'id' => 6,
        'menu_id' => 4002,
        'menu_id2' => 4000,
        'name'  => '图片处理',
        'is_modules'    => 1,
        'auths' => 'System@water,System@thumb',
    ],
    [
        'id' => 7,
        'menu_id' => 4003,
        'menu_id2' => 4000,
        'name'  => '区域配置',
        'is_modules'    => 1,
        'auths' => 'Region@*',
    ],
    [
        'id' => 8,
        'menu_id' => 4004,
        'menu_id2' => 4000,
        'name'  => '数据备份',
        'is_modules'    => 1,
        'auths' => 'Tools@*',
    ],
    [
        'id' => 9,
        'menu_id' => 4005,
        'menu_id2' => 4000,
        'name'  => '管理员',
        'is_modules'    => 1,
        'auths' => 'Admin@*',
    ],
    [
        'id' => 24,
        'menu_id' => 4007,
        'menu_id2' => 4000,
        'name'  => '权限组',
        'is_modules'    => 1,
        'auths' => 'AuthRole@*',
    ],
//    [
//        'id' => 10,
//        'menu_id' => 4006,
//        'menu_id2' => 4000,
//        'name'  => '经纪人',
//        'is_modules'    => 1,
//        'auths' => 'Saleman@*',
//    ],
    [
        'id' => 11,
        'menu_id' => 6000,
        'menu_id2' => 0,
        'name'  => '功能模块',
        'is_modules'    => 1,
        'auths' => '',
    ],
    [
        'id' => 12,
        'menu_id' => 6001,
        'menu_id2' => 6000,
        'name'  => '频道模型',
        'is_modules'    => 1,
        'auths' => 'Channeltype@*,Field@*',
    ],
    [
        'id' => 13,
        'menu_id' => 6002,
        'menu_id2' => 6000,
        'name'  => '广告管理',
        'is_modules'    => 1,
        'auths' => 'AdPosition@*',
    ],
    [
        'id' => 14,
        'menu_id' => 6003,
        'menu_id2' => 6000,
        'name'  => '友情链接',
        'is_modules'    => 1,
        'auths' => 'Links@*',
    ],
    [
        'id' => 15,
        'menu_id' => 6005,
        'menu_id2' => 6000,
        'name'  => 'URL配置',
        'is_modules'    => 1,
        'auths' => 'Seo@*',
    ],
    [
        'id' => 16,
        'menu_id' => 6006,
        'menu_id2' => 6000,
        'name'  => '静态生成',
        'is_modules'    => 1,
        'auths' => 'System@clear_cache',
    ],
    [
        'id' => 17,
        'menu_id' => 6007,
        'menu_id2' => 6000,
        'name'  => '模板管理',
        'is_modules'    => 1,
        'auths' => 'Filemanager@*',
    ],
    [
        'id' => 18,
        'menu_id' => 6004,
        'menu_id2' => 6000,
        'name'  => 'Tags管理',
        'is_modules'    => 1,
        'auths' => 'Tags@*',
    ],
    [
        'id' => 19,
        'menu_id' => 6008,
        'menu_id2' => 6000,
        'name'  => 'SiteMap',
        'is_modules'    => 1,
        'auths' => 'Seo@index',
    ],
    [
        'id' => 20,
        'menu_id' => 8000,
        'menu_id2' => 0,
        'name'  => '会员中心',
        'is_modules'    => 1,
        'auths' => '',
    ],
    [
        'id' => 21,
        'menu_id' => 8001,
        'menu_id2' => 8000,
        'name'  => '会员列表',
        'is_modules'    => 1,
        'auths' => 'Users@index,Users@add,Users@edit',
    ],
    [
        'id' => 22,
        'menu_id' => 8004,
        'menu_id2' => 8000,
        'name'  => '经纪人列表',
        'is_modules'    => 1,
        'auths' => 'Users@saleman_list,Users@add,Users@edit',
    ],
    [
        'id' => 22,
        'menu_id' => 8002,
        'menu_id2' => 8000,
        'name'  => '等级管理',
        'is_modules'    => 1,
        'auths' => 'UsersLevel@*',
    ],
    [
        'id' => 23,
        'menu_id' => 8003,
        'menu_id2' => 8000,
        'name'  => '注册设置',
        'is_modules'    => 1,
        'auths' => 'UsersConfig@*',
    ],
    [
        'id' => 24,
        'menu_id' => 9000,
        'menu_id2' => 0,
        'name'  => '高级选项',
        'is_modules'    => 1,
        'auths' => '',
    ],
    [
        'id' => 25,
        'menu_id' => 9001,
        'menu_id2' => 9000,
        'name'  => '回收站',
        'is_modules'    => 1,
        'auths' => 'RecycleBin@*',
    ],

    [
        'id' => 26,
        'menu_id' => 10000,
        'menu_id2' => 0,
        'name'  => '问答管理',
        'is_modules'    => 1,
        'auths' => '',
    ],
    [
        'id' => 27,
        'menu_id' => 10001,
        'menu_id2' => 10000,
        'name'  => '问答列表',
        'is_modules'    => 1,
        'auths' => 'Ask@*,Answer@*',
    ],
    [
        'id' => 28,
        'menu_id' => 6009,
        'menu_id2' => 6000,
        'name'  => '导航管理',
        'is_modules'    => 1,
        'auths' => 'Navigation@*',
    ],
];