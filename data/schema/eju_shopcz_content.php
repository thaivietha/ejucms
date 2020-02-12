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
  'supporting' => 
  array (
    'name' => 'supporting',
    'type' => 'set(\'电梯\',\'冰箱\',\'洗衣机\',\'热水器\',\'阳台\',\'网络\',\'暖气\',\'停车位\',\'客梯\',\'货梯\',\'扶梯\',\'空调\',\'上水\',\'下水\',\'可明火\',\'排烟\',\'排污\',\'燃气\',\'外摆区\')',
    'notnull' => false,
    'default' => '电梯',
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
  'diy_qzq' => 
  array (
    'name' => 'diy_qzq',
    'type' => 'enum(\'三个月\',\'六个月\',\'十二个月\')',
    'notnull' => false,
    'default' => '三个月',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_spxz' => 
  array (
    'name' => 'diy_spxz',
    'type' => 'enum(\'商铺新房\',\'二手商铺\')',
    'notnull' => false,
    'default' => '商铺新房',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_jyzt' => 
  array (
    'name' => 'diy_jyzt',
    'type' => 'enum(\'经营中\',\'空置中\')',
    'notnull' => false,
    'default' => '经营中',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_klrq' => 
  array (
    'name' => 'diy_klrq',
    'type' => 'enum(\'办公人群\',\'学生人群\',\'居民人群\',\'旅游人群\',\'其他\')',
    'notnull' => false,
    'default' => '办公人群',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_miankuan' => 
  array (
    'name' => 'diy_miankuan',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_cenggao' => 
  array (
    'name' => 'diy_cenggao',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
    'primary' => false,
    'autoinc' => false,
  ),
  'diy_jinshen' => 
  array (
    'name' => 'diy_jinshen',
    'type' => 'float(9,2)',
    'notnull' => false,
    'default' => '0.00',
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
  'diy_jgmy' => 
  array (
    'name' => 'diy_jgmy',
    'type' => 'varchar(200)',
    'notnull' => false,
    'default' => '',
    'primary' => false,
    'autoinc' => false,
  ),
);