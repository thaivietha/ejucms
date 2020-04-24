<?php

return array(
    'schema' => 2,  //1：原生数据值，2：前缀_数字(ai_2-ch_1),3:纯数字相关(1-2-3-1-2)---第三种情况暂时不能实现（跟自适应背道而驰）
    'list'=> [   //使用筛选的栏目
        '1'=> ['nid'=>'article','ctl_name'=>'Article'],
        '6'=>['nid'=>'single','ctl_name'=>'Single'],
        '9'=>['nid'=>'xinfang','ctl_name'=>'Xinfang'],
        '10'=>['nid'=>'tuan','ctl_name'=>'Tuan'],
        '11'=>['nid'=>'xiaoqu','ctl_name'=>'Xiaoqu'],
        '12'=>['nid'=>'ershou','ctl_name'=>'Ershou'],
        '13'=>['nid'=>'zufang','ctl_name'=>'Zufang'],
        '14'=>['nid'=>'shopcs','ctl_name'=>'Shopcs'],
        '15'=>['nid'=>'shopcz','ctl_name'=>'Shopcz'],
        '16'=>['nid'=>'officecs','ctl_name'=>'Officecs'],
        '17'=>['nid'=>'officecz','ctl_name'=>'Officecz'],
        '18'=>['nid'=>'qiuzu','ctl_name'=>'Qiuzu'],
    ],
    'pattern' =>[
        'total_price' =>  '.*?',
        'area' =>  '.*?',
        'aspect' =>  '.*?',
        'room' =>  '.*?',
        'floo_type' =>  '.*?',
        'hire_type' =>  '.*?',
        'division' =>  '.*?',
        'industry' =>  '.*?',
        'level' =>  '.*?',
        'area_id' =>  '.*?',
        'average_price' =>  '.*?',
        'building_type' =>  '.*?',
        'characteristic' =>  '.*?',
        'city_id' =>  '.*?',
        'fitment' =>  '.*?',
        'manage_type' =>  '.*?',
        'province_id' =>  '.*?',
        'sale_status' =>  '.*?',
    ]
);