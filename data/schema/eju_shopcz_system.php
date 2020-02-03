<?php 
return array (
  'id' => 
  array (
    'name' => 'id',
    'type' => 'int(11) unsigned',
    'notnull' => false,
    'default' => NULL,
    'primary' => true,
    'autoinc' => true,
  ),
  'aid' => 
  array (
    'name' => 'aid',
    'type' => 'int(11) unsigned',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'total_price' => 
  array (
    'name' => 'total_price',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'area' => 
  array (
    'name' => 'area',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'average_price' => 
  array (
    'name' => 'average_price',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'characteristic' => 
  array (
    'name' => 'characteristic',
    'type' => 'set(\'底层沿街\',\'可分割两层\',\'低价急售\',\'独栋\',\'繁华地段\',\'知名商户入驻\')',
    'notnull' => false,
    'default' => '底层沿街',
    'primary' => false,
    'autoinc' => false,
  ),
  'manage_type' => 
  array (
    'name' => 'manage_type',
    'type' => 'enum(\'住宅底商\',\'商业街铺面\',\'其他\',\'购物中心百货\',\'写字楼配套底商\',\'临街别墅\')',
    'notnull' => false,
    'default' => '住宅底商',
    'primary' => false,
    'autoinc' => false,
  ),
  'fitment' => 
  array (
    'name' => 'fitment',
    'type' => 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\')',
    'notnull' => false,
    'default' => '毛坯',
    'primary' => false,
    'autoinc' => false,
  ),
  'add_time' => 
  array (
    'name' => 'add_time',
    'type' => 'int(11)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'update_time' => 
  array (
    'name' => 'update_time',
    'type' => 'int(11)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'saleman_id' => 
  array (
    'name' => 'saleman_id',
    'type' => 'int(10) unsigned',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'address' => 
  array (
    'name' => 'address',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'lng' => 
  array (
    'name' => 'lng',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'lat' => 
  array (
    'name' => 'lat',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'sale_name' => 
  array (
    'name' => 'sale_name',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'sale_phone' => 
  array (
    'name' => 'sale_phone',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'phone_code' => 
  array (
    'name' => 'phone_code',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'floo_type' => 
  array (
    'name' => 'floo_type',
    'type' => 'enum(\'低层\',\'中层\',\'高层\')',
    'notnull' => false,
    'default' => '低层',
    'primary' => false,
    'autoinc' => false,
  ),
  'floor_count' => 
  array (
    'name' => 'floor_count',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'price_units' => 
  array (
    'name' => 'price_units',
    'type' => 'enum(\'元/月\',\'元/㎡/月\',\'元/季\',\'元/年\')',
    'notnull' => false,
    'default' => '元/月',
    'primary' => false,
    'autoinc' => false,
  ),
  'pay_way' => 
  array (
    'name' => 'pay_way',
    'type' => 'enum(\'押一付一\',\'押一付三\')',
    'notnull' => false,
    'default' => '押一付一',
    'primary' => false,
    'autoinc' => false,
  ),
  'division' => 
  array (
    'name' => 'division',
    'type' => 'enum(\'不可分割\',\'可分割\')',
    'notnull' => false,
    'default' => '不可分割',
    'primary' => false,
    'autoinc' => false,
  ),
  'industry' => 
  array (
    'name' => 'industry',
    'type' => 'set(\'其他\',\'酒店宾馆\',\'百货超市\',\'生活服务\',\'美容美发\',\'休闲娱乐\',\'服饰鞋包\',\'餐饮美食\')',
    'notnull' => false,
    'default' => '餐饮美食',
    'primary' => false,
    'autoinc' => false,
  ),
  'lease_type' => 
  array (
    'name' => 'lease_type',
    'type' => 'enum(\'否\',\'是\')',
    'notnull' => false,
    'default' => '否',
    'primary' => false,
    'autoinc' => false,
  ),
);