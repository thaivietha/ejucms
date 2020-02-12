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
    'type' => 'int(10) unsigned',
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
  'content' => 
  array (
    'name' => 'content',
    'type' => 'longtext',
    'notnull' => false,
    'default' => NULL,
    'primary' => false,
    'autoinc' => false,
  ),
  'property' => 
  array (
    'name' => 'property',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'building_age' => 
  array (
    'name' => 'building_age',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'property_fee' => 
  array (
    'name' => 'property_fee',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'panoram' => 
  array (
    'name' => 'panoram',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'sfbhwyf' => 
  array (
    'name' => 'sfbhwyf',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_xingzhi' => 
  array (
    'name' => 'diy_xingzhi',
    'type' => 'enum(\'新房写字楼\',\'二手写字楼\')',
    'notnull' => false,
    'default' => '新房写字楼',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_syl' => 
  array (
    'name' => 'diy_syl',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_gws' => 
  array (
    'name' => 'diy_gws',
    'type' => 'int(10)',
    'notnull' => false,
    'default' => '0',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_sfzc' => 
  array (
    'name' => 'diy_sfzc',
    'type' => 'enum(\'可注册\',\'不可注册\',\'暂无数据\')',
    'notnull' => false,
    'default' => '可注册',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_xgfy' => 
  array (
    'name' => 'diy_xgfy',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
);