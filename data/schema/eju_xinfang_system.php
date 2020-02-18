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
    'type' => 'int(11)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'lng' => 
  array (
    'name' => 'lng',
    'type' => 'varchar(20)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'lat' => 
  array (
    'name' => 'lat',
    'type' => 'varchar(20)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'starting_price' => 
  array (
    'name' => 'starting_price',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'average_price' => 
  array (
    'name' => 'average_price',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'saleman_id' => 
  array (
    'name' => 'saleman_id',
    'type' => 'int(11) unsigned',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'opening_time' => 
  array (
    'name' => 'opening_time',
    'type' => 'int(11)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'complate_time' => 
  array (
    'name' => 'complate_time',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'is_discount' => 
  array (
    'name' => 'is_discount',
    'type' => 'tinyint(1)',
    'notnull' => false,
    'default' => '1',
    'primary' => false,
    'autoinc' => false,
  ),
  'characteristic' => 
  array (
    'name' => 'characteristic',
    'type' => 'set(\'小户型\',\'低密居住\',\'旅游地产\',\'教育地产\',\'宜居生态\',\'公园地产\',\'海景楼盘\',\'养生社区\')',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'fitment' => 
  array (
    'name' => 'fitment',
    'type' => 'set(\'毛坯\',\'简装\',\'精装\',\'豪装\')',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'building_type' => 
  array (
    'name' => 'building_type',
    'type' => 'set(\'低层\',\'高层\',\'多层\',\'复式\')',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'manage_type' => 
  array (
    'name' => 'manage_type',
    'type' => 'set(\'住宅\',\'商铺\',\'写字楼\',\'公寓\',\'别墅\',\'其他\')',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'sale_status' => 
  array (
    'name' => 'sale_status',
    'type' => 'enum(\'预售\',\'在售\',\'售罄\')',
    'notnull' => false,
    'default' => '预售',
    'primary' => false,
    'autoinc' => false,
  ),
  'total_price' => 
  array (
    'name' => 'total_price',
    'type' => 'decimal(10,2)',
    'notnull' => false,
    'default' => '0.00',
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
  'address' => 
  array (
    'name' => 'address',
    'type' => 'varchar(100)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'sale_phone' => 
  array (
    'name' => 'sale_phone',
    'type' => 'varchar(50)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'phone_code' => 
  array (
    'name' => 'phone_code',
    'type' => 'varchar(20)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'main_unit' => 
  array (
    'name' => 'main_unit',
    'type' => 'varchar(100)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'price_units' => 
  array (
    'name' => 'price_units',
    'type' => 'enum(\'元/㎡\',\'元/套\',\'万/套\')',
    'notnull' => false,
    'default' => '元/㎡',
    'primary' => false,
    'autoinc' => false,
  ),
);