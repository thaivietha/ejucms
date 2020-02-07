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
  'level' => 
  array (
    'name' => 'level',
    'type' => 'enum(\'甲级\',\'乙级\',\'丙级\',\'丁级\')',
    'notnull' => false,
    'default' => '甲级',
    'primary' => false,
    'autoinc' => false,
  ),
  'characteristic' => 
  array (
    'name' => 'characteristic',
    'type' => 'set(\'免中介费\',\'赠免租期\',\'交通便利\',\'中心商务区\',\'地标建筑\',\'知名物业\',\'繁华商圈\',\'独栋写字楼\')',
    'notnull' => false,
    'default' => '免中介费',
    'primary' => false,
    'autoinc' => false,
  ),
  'manage_type' => 
  array (
    'name' => 'manage_type',
    'type' => 'enum(\'纯写字楼\',\'商业综合体\',\'酒店写字楼\')',
    'notnull' => false,
    'default' => '纯写字楼',
    'primary' => false,
    'autoinc' => false,
  ),
);