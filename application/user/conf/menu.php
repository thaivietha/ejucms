<?php
return  [
    '1000'=>[
        'id'=>1000,
        'parent_id'=>0,
        'name'=>'用户首页',
        'controller'=>'Users',
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
    '2000'=>[
        'id'=>2000,
        'parent_id'=>0,
        'name'=>'房源管理',
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
            '2001' => [
                'id'=>2001,
                'parent_id'=>2000,
                'name' => '二手房',
                'controller'=>'Ershou',
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
            '2002' => [
                'id'=>2002,
                'parent_id'=>2000,
                'name' => '出租房',
                'controller'=>'Zufang',
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
            '2003' => [
                'id'=>2003,
                'parent_id'=>2000,
                'name' => '商铺出售',
                'controller'=>'Shopcs',
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
            '2004' => [
                'id'=>2004,
                'parent_id'=>2000,
                'name' => '商铺出租',
                'controller'=>'Shopcz',
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
            '2005' => [
                'id'=>2005,
                'parent_id'=>2000,
                'name' => '写字楼出售',
                'controller'=>'Officecs',
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
            '2006' => [
                'id'=>2006,
                'parent_id'=>2000,
                'name' => '写字楼出租',
                'controller'=>'Officecz',
                'action'=>'index',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ]

        ],
    ],
    '3000'=>[
        'id'=>3000,
        'parent_id'=>0,
        'name'=>'个人信息',
        'controller'=>'',
        'action'=>'',
        'url'=>'',
        'target'=>'_self',
        'icon'  => 'layui-icon-link',
        'grade'=>0,
        'is_menu'=>1,
        'is_modules'=>1,
        'is_quick'=>0,
        'child'=>[
            '3001' => [
                'id'=>3001,
                'parent_id'=>3000,
                'name' => '编辑资料',
                'controller'=>'Users',
                'action'=>'edit',
                'url'=>'',
                'target'=>'_self',
                'icon'=>'',
                'grade'=>1,
                'is_menu'=>1,
                'is_modules'=>1,
                'is_quick'=>0,
                'child'=>[],
            ],
            '3003' => [
                'id'=>3003,
                'parent_id'=>3000,
                'name' => '修改密码',
                'controller'=>'Users',
                'action'=>'pwd',
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