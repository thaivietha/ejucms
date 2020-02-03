
ALTER TABLE `eju_ershou_content` ADD COLUMN `panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' AFTER `supporting`;
CREATE TABLE `eju_ershou_price` (
`price_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`price`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' ,
`day`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08-07' ,
`month`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08' ,
`year`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019' ,
`create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`price_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
ALTER TABLE `eju_ershou_system` ADD COLUMN `average_price`  float(9,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '均价' AFTER `total_price`;
CREATE TABLE `eju_officecs_content` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文档ID' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
`content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' ,
`property`  int(10) NOT NULL DEFAULT 0 COMMENT '产权年限' ,
`building_age`  int(10) NOT NULL DEFAULT 0 COMMENT '建造年代' ,
`property_fee`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '物业费' ,
`panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecs_photo` (
`photo_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`photo_title`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '相片标题' ,
`photo_pic`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片地址' ,
`photo_type`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片类型' ,
`sort_order`  int(10) NOT NULL DEFAULT 0 COMMENT '排序号' ,
`is_del`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否被删除' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`photo_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecs_price` (
`price_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`price`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' ,
`day`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08-07' ,
`month`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08' ,
`year`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019' ,
`create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`price_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecs_system` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`total_price`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '价格' ,
`area`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '面积' ,
`average_price`  float(9,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '均价，根据面积何总价自动计算获得' ,
`characteristic`  set('免中介费','可注册','赠免租期','交通便利','中心商务区','地标建筑','知名物业','繁华商圈','独栋写字楼') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '免中介费' COMMENT '特色标签' ,
`manage_type`  enum('纯写字楼','商业综合体','酒店写字楼') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '纯写字楼' COMMENT '类型' ,
`fitment`  enum('毛坯','简装','精装','豪装') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '毛坯' COMMENT '装修情况' ,
`add_time`  int(11) NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NULL DEFAULT 0 COMMENT '更新时间' ,
`saleman_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '置业人员' ,
`address`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '地址' ,
`lng`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '精度' ,
`lat`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '维度' ,
`sale_name`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系人' ,
`sale_phone`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系电话' ,
`phone_code`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '号码转码' ,
`floo_type`  enum('低层','中层','高层') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '低层' COMMENT '楼层' ,
`floor_count`  int(10) NOT NULL DEFAULT 0 COMMENT '楼层数' ,
`level`  enum('甲级','乙级','丙级','丁级') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '甲级' COMMENT '等级' ,
`division`  enum('不可分割','可分割') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '不可分割' COMMENT '是否可分割' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecz_content` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文档ID' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
`content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' ,
`property`  int(10) NOT NULL DEFAULT 0 COMMENT '产权年限' ,
`building_age`  int(10) NOT NULL DEFAULT 0 COMMENT '建造年代' ,
`property_fee`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '物业费' ,
`panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecz_photo` (
`photo_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`photo_title`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '相片标题' ,
`photo_pic`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片地址' ,
`photo_type`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片类型' ,
`sort_order`  int(10) NOT NULL DEFAULT 0 COMMENT '排序号' ,
`is_del`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否被删除' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`photo_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecz_price` (
`price_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`price`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' ,
`day`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08-07' ,
`month`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08' ,
`year`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019' ,
`create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`price_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_officecz_system` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`total_price`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '租金' ,
`area`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '面积' ,
`average_price`  float(9,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '均价，根据面积何总价自动计算获得' ,
`fitment`  enum('毛坯','简装','精装','豪装') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '毛坯' COMMENT '装修' ,
`add_time`  int(11) NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NULL DEFAULT 0 COMMENT '更新时间' ,
`saleman_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '置业人员' ,
`address`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '地址' ,
`lng`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '精度' ,
`lat`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '维度' ,
`sale_name`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系人' ,
`sale_phone`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系电话' ,
`phone_code`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '号码转码' ,
`floo_type`  enum('低层','中层','高层') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '低层' COMMENT '楼层' ,
`floor_count`  int(10) NOT NULL DEFAULT 0 COMMENT '楼层数' ,
`price_units`  enum('元/月','元/㎡/月','元/季','元/年') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '元/月' COMMENT '价格单位' ,
`pay_way`  enum('押一付一','押一付三') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '押一付一' COMMENT '付款方式' ,
`division`  enum('不可分割','可分割') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '不可分割' COMMENT '是否可分割' ,
`level`  enum('甲级','乙级','丙级','丁级') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '甲级' COMMENT '等级' ,
`characteristic`  set('免中介费','可注册','赠免租期','交通便利','中心商务区','地标建筑','知名物业','繁华商圈','独栋写字楼') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '免中介费' COMMENT '特色标签' ,
`manage_type`  enum('纯写字楼','商业综合体','酒店写字楼') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '纯写字楼' COMMENT '类型' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcs_content` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文档ID' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
`content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' ,
`property`  int(10) NOT NULL DEFAULT 0 COMMENT '产权年限' ,
`building_age`  int(10) NOT NULL DEFAULT 0 COMMENT '建造年代' ,
`supporting`  set('网络','空调','电梯','冰箱','洗衣机','热水器','阳台','网络','暖气','停车位','客梯','货梯','扶梯','空调','上水','下水','可明火','排烟','排污','燃气','外摆区') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '网络' COMMENT '商铺配套' ,
`property_fee`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '物业费' ,
`panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcs_photo` (
`photo_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`photo_title`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '相片标题' ,
`photo_pic`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片地址' ,
`photo_type`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片类型' ,
`sort_order`  int(10) NOT NULL DEFAULT 0 COMMENT '排序号' ,
`is_del`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否被删除' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`photo_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcs_price` (
`price_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`price`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' ,
`day`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08-07' ,
`month`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08' ,
`year`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019' ,
`create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`price_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcs_system` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`total_price`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '价格' ,
`area`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '面积' ,
`average_price`  float(9,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '均价，根据面积何总价自动计算获得' ,
`characteristic`  set('底层沿街','可分割两层','低价急售','独栋','繁华地段','知名商户入驻') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '底层沿街' COMMENT '特色标签' ,
`manage_type`  enum('住宅底商','商业街铺面','其他','购物中心百货','写字楼配套底商','临街别墅') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '住宅底商' COMMENT '类型' ,
`fitment`  enum('毛坯','简装','精装','豪装') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '毛坯' COMMENT '装修情况' ,
`add_time`  int(11) NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NULL DEFAULT 0 COMMENT '更新时间' ,
`saleman_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '置业人员' ,
`address`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '地址' ,
`lng`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '精度' ,
`lat`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '维度' ,
`sale_name`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系人' ,
`sale_phone`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系电话' ,
`phone_code`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '号码转码' ,
`floo_type`  enum('低层','中层','高层') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '低层' COMMENT '楼层' ,
`floor_count`  int(10) NOT NULL DEFAULT 0 COMMENT '楼层数' ,
`industry`  set('其他','酒店宾馆','百货超市','生活服务','美容美发','休闲娱乐','服饰鞋包','餐饮美食') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '餐饮美食' COMMENT '经营行业' ,
`division`  enum('不可分割','可分割') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '不可分割' COMMENT '是否可分割' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcz_content` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文档ID' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
`content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' ,
`property`  int(10) NOT NULL DEFAULT 0 COMMENT '产权年限' ,
`building_age`  int(10) NOT NULL DEFAULT 0 COMMENT '建造年代' ,
`supporting`  set('网络','空调','电梯','冰箱','洗衣机','热水器','阳台','网络','暖气','停车位','客梯','货梯','扶梯','空调','上水','下水','可明火','排烟','排污','燃气','外摆区') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '电梯' COMMENT '配套' ,
`property_fee`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '物业费' ,
`panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcz_photo` (
`photo_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`photo_title`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '相片标题' ,
`photo_pic`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片地址' ,
`photo_type`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片类型' ,
`sort_order`  int(10) NOT NULL DEFAULT 0 COMMENT '排序号' ,
`is_del`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否被删除' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`photo_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcz_price` (
`price_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`price`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' ,
`day`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08-07' ,
`month`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08' ,
`year`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019' ,
`create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`price_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_shopcz_system` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`total_price`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '租金' ,
`area`  float(9,2) NOT NULL DEFAULT 0.00 COMMENT '面积' ,
`average_price`  float(9,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '均价，根据面积何总价自动计算获得' ,
`characteristic`  set('底层沿街','可分割两层','低价急售','独栋','繁华地段','知名商户入驻') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '底层沿街' COMMENT '特色' ,
`manage_type`  enum('住宅底商','商业街铺面','其他','购物中心百货','写字楼配套底商','临街别墅') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '住宅底商' COMMENT '类型' ,
`fitment`  enum('毛坯','简装','精装','豪装') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '毛坯' COMMENT '装修' ,
`add_time`  int(11) NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NULL DEFAULT 0 COMMENT '更新时间' ,
`saleman_id`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '置业人员' ,
`address`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '地址' ,
`lng`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '精度' ,
`lat`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '维度' ,
`sale_name`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系人' ,
`sale_phone`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '联系电话' ,
`phone_code`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '号码转码' ,
`floo_type`  enum('低层','中层','高层') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '低层' COMMENT '楼层' ,
`floor_count`  int(10) NOT NULL DEFAULT 0 COMMENT '楼层数' ,
`price_units`  enum('元/月','元/㎡/月','元/季','元/年') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '元/月' COMMENT '价格单位' ,
`pay_way`  enum('押一付一','押一付三') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '押一付一' COMMENT '付款方式' ,
`division`  enum('不可分割','可分割') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '不可分割' COMMENT '是否可分割' ,
`industry`  set('其他','酒店宾馆','百货超市','生活服务','美容美发','休闲娱乐','服饰鞋包','餐饮美食') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '餐饮美食' COMMENT '经营行业' ,
`lease_type`  enum('否','是') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '否' COMMENT '是否转让' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
ALTER TABLE `eju_xiaoqu_content` ADD COLUMN `panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' AFTER `update_time`;

ALTER TABLE `eju_xinfang_content` ADD COLUMN `panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' AFTER `update_time`;

CREATE TABLE `eju_xinfang_sand` (
`sand_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`title`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '楼栋名称' ,
`unit`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '单元数' ,
`elevator`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '电梯数' ,
`floor_num`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '楼层数' ,
`room_num`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '总户数' ,
`open_time`  int(11) UNSIGNED NULL DEFAULT 0 COMMENT '开盘时间' ,
`complate_time`  int(11) UNSIGNED NULL DEFAULT 0 COMMENT '交房时间' ,
`sale_status`  char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '销售状态' ,
`huxing_id`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '户型id \',\'分隔' ,
`is_del`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`sand_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
CREATE TABLE `eju_xinfang_sand_pic` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 ,
`litpic`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '沙盘图片' ,
`data`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '位置标注' ,
`is_del`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 ,
`add_time`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
ALTER TABLE `eju_zufang_content` ADD COLUMN `panoram`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '全景相册' AFTER `supporting`;
CREATE TABLE `eju_zufang_price` (
`price_id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`aid`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新房aid' ,
`price`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '价格' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' ,
`day`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08-07' ,
`month`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019-08' ,
`year`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '2019' ,
`create_time`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间' ,
`add_time`  int(11) NOT NULL DEFAULT 0 COMMENT '新增时间' ,
`update_time`  int(11) NOT NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`price_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0
;
ALTER TABLE `eju_zufang_system` ADD COLUMN `average_price`  float(9,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '均价' AFTER `total_price`;

INSERT INTO `eju_channeltype` (`nid`, `title`, `ntitle`, `table`, `ctl_name`, `status`, `ifsystem`, `is_repeat_title`, `is_del`, `sort_order`, `add_time`, `update_time`) VALUES ('shopcs', '商铺出售模型', '商铺出售', 'shopcs', 'Shopcs', '1', '1', '1', '0', '100', '1571023592', '1571023592');

INSERT INTO `eju_channeltype` (`nid`, `title`, `ntitle`, `table`, `ctl_name`, `status`, `ifsystem`, `is_repeat_title`, `is_del`, `sort_order`, `add_time`, `update_time`) VALUES ('shopcz', '商铺出租模型', '商铺出租', 'shopcz', 'Shopcz', '1', '1', '1', '0', '100', '1571023592', '1571023592');

INSERT INTO `eju_channeltype` (`nid`, `title`, `ntitle`, `table`, `ctl_name`, `status`, `ifsystem`, `is_repeat_title`, `is_del`, `sort_order`, `add_time`, `update_time`) VALUES ('officecs', '写字楼出售模型', '写字楼出售', 'officecs', 'Officecs', '1', '1', '1', '0', '100', '1571023592', '1571023592');

INSERT INTO `eju_channeltype` (`nid`, `title`, `ntitle`, `table`, `ctl_name`, `status`, `ifsystem`, `is_repeat_title`, `is_del`, `sort_order`, `add_time`, `update_time`) VALUES ('officecz', '写字楼出租模型', '写字楼出租', 'officecz', 'Officecz', '1', '1', '1', '0', '100', '1571023592', '1571023592');


