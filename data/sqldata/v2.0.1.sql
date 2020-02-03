
ALTER TABLE `eju_ershou_content` MODIFY COLUMN `content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' AFTER `update_time`;
ALTER TABLE `eju_officecs_content` MODIFY COLUMN `content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' AFTER `update_time`;
ALTER TABLE `eju_officecz_content` MODIFY COLUMN `content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' AFTER `update_time`;
ALTER TABLE `eju_shopcs_content` MODIFY COLUMN `content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' AFTER `update_time`;
ALTER TABLE `eju_shopcs_content` MODIFY COLUMN `supporting`  set('电梯','冰箱','洗衣机','热水器','阳台','网络','暖气','停车位','客梯','货梯','扶梯','空调','上水','下水','可明火','排烟','排污','燃气','外摆区') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '电梯' COMMENT '商铺配套' AFTER `building_age`;
ALTER TABLE `eju_shopcs_system` MODIFY COLUMN `characteristic`  set('底层沿街','可分割两层','低价急售','独栋','繁华地段','知名商户入驻') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '底层沿街' COMMENT '特色标签' AFTER `average_price`;
ALTER TABLE `eju_shopcs_system` MODIFY COLUMN `fitment`  enum('毛坯','简装','精装','豪装') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '毛坯' COMMENT '装修情况' AFTER `manage_type`;
ALTER TABLE `eju_shopcz_content` MODIFY COLUMN `content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' AFTER `update_time`;
ALTER TABLE `eju_shopcz_content` MODIFY COLUMN `supporting`  set('电梯','冰箱','洗衣机','热水器','阳台','网络','暖气','停车位','客梯','货梯','扶梯','空调','上水','下水','可明火','排烟','排污','燃气','外摆区') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '电梯' COMMENT '商铺配套' AFTER `building_age`;
ALTER TABLE `eju_shopcz_system` MODIFY COLUMN `industry`  set('其他','酒店宾馆','百货超市','生活服务','美容美发','休闲娱乐','服饰鞋包','餐饮美食') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '餐饮美食' COMMENT '经营行业' AFTER `division`;
ALTER TABLE `eju_users` MODIFY COLUMN `level_id`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '经纪人级别（1为会员）' AFTER `id`;
ALTER TABLE `eju_users` ADD COLUMN `is_saleman`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为商家内部经纪人' AFTER `is_lock`;
ALTER TABLE `eju_users_content` MODIFY COLUMN `login_count`  int(11) UNSIGNED NULL DEFAULT 0 COMMENT '登录次数' AFTER `last_ip`;
ALTER TABLE `eju_users_content` MODIFY COLUMN `day_send`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当天共发布条数' AFTER `login_count`;
ALTER TABLE `eju_users_content` MODIFY COLUMN `day_top`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当天总共置顶条数' AFTER `day_send`;
ALTER TABLE `eju_users_content` ADD COLUMN `deal`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '历史成交' AFTER `update_time`;
ALTER TABLE `eju_users_content` ADD COLUMN `look`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最近30天带看' AFTER `deal`;
ALTER TABLE `eju_users_content` ADD COLUMN `service_area`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '服务区域（区域id集合）' AFTER `look`;
ALTER TABLE `eju_users_content` ADD COLUMN `users_label`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标签' AFTER `service_area`;
ALTER TABLE `eju_users_content` ADD COLUMN `company`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所属公司' AFTER `users_label`;
ALTER TABLE `eju_users_content` ADD COLUMN `content`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '介绍' AFTER `company`;
ALTER TABLE `eju_users_content` DROP COLUMN `ershou_send`;
ALTER TABLE `eju_users_content` DROP COLUMN `zufang_send`;
ALTER TABLE `eju_users_content` DROP COLUMN `ershou_top`;
ALTER TABLE `eju_users_content` DROP COLUMN `zufang_top`;
ALTER TABLE `eju_users_content` DROP COLUMN `day_ershou_send`;
ALTER TABLE `eju_users_content` DROP COLUMN `day_zufang_send`;
ALTER TABLE `eju_users_content` DROP COLUMN `day_ershou_top`;
ALTER TABLE `eju_users_content` DROP COLUMN `day_zufang_top`;


CREATE UNIQUE INDEX `users_id` ON `eju_users_content`(`users_id`) USING BTREE ;
CREATE TABLE `eju_users_count` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`users_id`  int(11) NOT NULL DEFAULT 0 COMMENT '用户id' ,
`type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶，5：商铺出售发布，6：商铺出售置顶，7：商铺出租发布，8：商铺出租置顶，9：写字楼出售发布，10：写字楼出售置顶，11：写字楼出租发布，12：写字楼出租置顶）' ,
`style`  tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT '时间，1：当天，2：一共' ,
`num`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '数量' ,
`add_time`  int(11) NULL DEFAULT 0 COMMENT '添加时间' ,
`update_time`  int(11) NULL DEFAULT 0 COMMENT '更新时间' ,
PRIMARY KEY (`id`),
INDEX `users_id` (`users_id`) USING BTREE 
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Fixed
DELAY_KEY_WRITE=0
;
ALTER TABLE `eju_users_level` ADD COLUMN `check_shopcs`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '商铺出售是否需要审核' AFTER `check_zufang`;
ALTER TABLE `eju_users_level` ADD COLUMN `check_shopcz`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '商铺出租是否需要审核' AFTER `check_shopcs`;
ALTER TABLE `eju_users_level` ADD COLUMN `check_officecs`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '写字楼出售是否需要审核' AFTER `check_shopcz`;
ALTER TABLE `eju_users_level` ADD COLUMN `check_officecz`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '写字楼出租是否需要审核' AFTER `check_officecs`;
ALTER TABLE `eju_users_level` MODIFY COLUMN `is_system`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员为系统内置，不允许删除' AFTER `is_del`;
ALTER TABLE `eju_users_log` MODIFY COLUMN `users_id`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id' AFTER `id`;
ALTER TABLE `eju_users_log` MODIFY COLUMN `type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶，5：商铺出售发布，6：商铺出售置顶，7：商铺出租发布，8：商铺出租置顶，9：写字楼出售发布，10：写字楼出售置顶，11：写字楼出租发布，12：写字楼出租置顶）' AFTER `aid`;
ALTER TABLE `eju_xiaoqu_system` MODIFY COLUMN `characteristic`  set('小户型','低密居住','旅游地产','教育地产','宜居生态','公园地产','海景楼盘','养生社区') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '特色' AFTER `average_price`;
ALTER TABLE `eju_xiaoqu_system` MODIFY COLUMN `manage_type`  set('住宅','商铺','写字楼','公寓','别墅','其他') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '物业类型' AFTER `characteristic`;
ALTER TABLE `eju_xiaoqu_system` MODIFY COLUMN `building_type`  set('低层','高层','多层','复式') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '建筑类型' AFTER `building_age`;
ALTER TABLE `eju_xiaoqu_system` ADD COLUMN `is_houtai`  tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否为后台（0：会员自定义）' AFTER `building_type`;
ALTER TABLE `eju_xinfang_content` MODIFY COLUMN `building_num`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '楼栋数量' AFTER `floor_case`;
ALTER TABLE `eju_xinfang_price` MODIFY COLUMN `type`  tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：新房均价，2：新房起价' AFTER `price`;
ALTER TABLE `eju_zufang_content` MODIFY COLUMN `content`  longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房源介绍' AFTER `update_time`;
ALTER TABLE `eju_zufang_system` MODIFY COLUMN `hire_type`  enum('整租','合租') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '整租' COMMENT '租赁方式' AFTER `pay_way`;
