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
  'characteristic' => 
  array (
    'name' => 'characteristic',
    'type' => 'set(\'南北通透\',\'冬暖夏凉\')',
    'notnull' => false,
    'default' => '南北通透',
    'primary' => false,
    'autoinc' => false,
  ),
  'aspect' => 
  array (
    'name' => 'aspect',
    'type' => 'enum(\'东\',\'西\',\'南\',\'北\',\'东北\',\'西北\',\'东南\',\'西南\')',
    'notnull' => false,
    'default' => '东',
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
  'manage_type' => 
  array (
    'name' => 'manage_type',
    'type' => 'enum(\'住宅\',\'铺面\',\'别墅\')',
    'notnull' => false,
    'default' => '住宅',
    'primary' => false,
    'autoinc' => false,
  ),
  'room' => 
  array (
    'name' => 'room',
    'type' => 'enum(\'1\',\'2\',\'3\',\'4\',\'5\',\'6\')',
    'notnull' => false,
    'default' => '1',
    'primary' => false,
    'autoinc' => false,
  ),
  'living_room' => 
  array (
    'name' => 'living_room',
    'type' => 'enum(\'0\',\'1\',\'2\',\'3\',\'4\')',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'kitchen' => 
  array (
    'name' => 'kitchen',
    'type' => 'enum(\'0\',\'1\',\'2\')',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'toilet' => 
  array (
    'name' => 'toilet',
    'type' => 'enum(\'0\',\'1\',\'2\')',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'balcony' => 
  array (
    'name' => 'balcony',
    'type' => 'enum(\'0\',\'1\',\'2\',\'3\')',
    'notnull' => false,
    'default' => '0',
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
  'price_units' => 
  array (
    'name' => 'price_units',
    'type' => 'enum(\'元/月\',\'元/季\',\'元/年\')',
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
  'hire_type' => 
  array (
    'name' => 'hire_type',
    'type' => 'enum(\'整租\',\'合租\')',
    'notnull' => false,
    'default' => '整租',
    'primary' => false,
    'autoinc' => false,
  ),
  'room_type' => 
  array (
    'name' => 'room_type',
    'type' => 'enum(\'主卧\',\'次卧\')',
    'notnull' => false,
    'default' => '主卧',
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
);