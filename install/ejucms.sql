-- ----------------------------------------
-- EjuCms MySQL Data Transfer 
-- 
-- Server         : 127.0.0.1_3306
-- Server Version : 5.7.26-log
-- Host           : 127.0.0.1:3306
-- Database       : dd22
-- 
-- Part : #1
-- Version : #v2.4.0
-- Date : 2020-05-12 17:10:18
-- -----------------------------------------

SET FOREIGN_KEY_CHECKS = 0;


-- -----------------------------
-- Table structure for `eju_ad`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ad`;
CREATE TABLE `eju_ad` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '广告位置ID',
  `media_type` tinyint(1) DEFAULT '0' COMMENT '广告类型',
  `title` varchar(60) DEFAULT '' COMMENT '广告名称',
  `links` varchar(255) DEFAULT '' COMMENT '广告链接',
  `litpic` varchar(255) DEFAULT '' COMMENT '图片地址',
  `start_time` int(11) DEFAULT '0' COMMENT '投放时间',
  `end_time` int(11) DEFAULT '0' COMMENT '结束时间',
  `intro` text COMMENT '描述',
  `link_man` varchar(60) DEFAULT '' COMMENT '添加人',
  `link_email` varchar(60) DEFAULT '' COMMENT '添加人邮箱',
  `link_phone` varchar(60) DEFAULT '' COMMENT '添加人联系电话',
  `click` int(11) DEFAULT '0' COMMENT '点击量',
  `bgcolor` varchar(30) DEFAULT '' COMMENT '背景颜色',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1=显示，0=屏蔽',
  `sort_order` int(11) DEFAULT '0' COMMENT '排序',
  `target` varchar(50) DEFAULT '' COMMENT '是否开启浏览器新窗口',
  `admin_id` int(10) DEFAULT '0' COMMENT '管理员ID',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `province_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '省份',
  `city_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在城市',
  `area_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在区域',
  PRIMARY KEY (`id`),
  KEY `position_id` (`pid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- -----------------------------
-- Records of `eju_ad`
-- -----------------------------
INSERT INTO `eju_ad` VALUES ('1', '1', '1', '幻灯一', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-191011110045934.jpg', '0', '0', '', '', '', '', '0', '', '1', '1', '0', '1', '0', '1570765888', '1570765888', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('2', '1', '1', '幻灯二', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-1910111100491R.jpg', '0', '0', '', '', '', '', '0', '', '1', '2', '0', '1', '0', '1570765888', '1570765888', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('3', '1', '1', '幻灯三', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-191011110051505.jpg', '0', '0', '', '', '', '', '0', '', '1', '3', '0', '1', '0', '1570765888', '1570765888', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('4', '2', '1', '楼盘一', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-1910111H519513.jpg', '0', '0', '', '', '', '', '0', '', '1', '1', '0', '1', '0', '1570785957', '1570785957', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('5', '2', '1', '楼盘二', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-1910111H51b96.jpg', '0', '0', '', '', '', '', '0', '', '1', '2', '0', '1', '0', '1570785957', '1570785957', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('6', '2', '1', '楼盘三', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-1910111H51RC.jpg', '0', '0', '', '', '', '', '0', '', '1', '3', '0', '1', '0', '1570785957', '1570785957', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('7', '2', '1', '楼盘四', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-1910111H51T38.jpg', '0', '0', '', '', '', '', '0', '', '1', '4', '0', '1', '0', '1570785957', '1570785957', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('8', '2', '1', '楼盘五', 'http://www.ejucms.com/', '/uploads/allimg/20191011/1-1910111H51Q53.jpg', '0', '0', '', '', '', '', '0', '', '1', '5', '0', '1', '0', '1570785957', '1570785957', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('9', '3', '1', '广告一', 'tel:13800001111', '/uploads/allimg/20191011/1-1910111I300558.png', '0', '0', '', '', '', '', '0', '', '1', '1', '0', '1', '0', '1570786420', '1570786472', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('10', '3', '1', '广告二', 'tel:13800001111', '/uploads/allimg/20191011/1-1910111I300261.jpg', '0', '0', '', '', '', '', '0', '', '1', '2', '0', '1', '0', '1570786420', '1570786472', '0', '0', '0');
INSERT INTO `eju_ad` VALUES ('11', '3', '1', '广告三', 'tel:13800001111', '/uploads/allimg/20191011/1-1910111I300409.jpg', '0', '0', '', '', '', '', '0', '', '1', '3', '0', '1', '0', '1570786420', '1570786472', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_ad_position`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ad_position`;
CREATE TABLE `eju_ad_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '广告位置名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0关闭1开启',
  `admin_id` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='广告位置表';

-- -----------------------------
-- Records of `eju_ad_position`
-- -----------------------------
INSERT INTO `eju_ad_position` VALUES ('1', '首页头部大幻灯', '1', '1', '0', '1570765888', '1570765888');
INSERT INTO `eju_ad_position` VALUES ('2', '新房列表广告', '1', '1', '0', '1570785957', '1570785957');
INSERT INTO `eju_ad_position` VALUES ('3', '手机端楼盘列表广告', '1', '1', '0', '1570786420', '1570786472');

-- -----------------------------
-- Table structure for `eju_admin`
-- -----------------------------
DROP TABLE IF EXISTS `eju_admin`;
CREATE TABLE `eju_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `pen_name` varchar(50) DEFAULT '' COMMENT '笔名（发布文章后显示责任编辑的名字）',
  `true_name` varchar(20) DEFAULT '' COMMENT '真实姓名',
  `mobile` varchar(11) DEFAULT '' COMMENT '手机号码',
  `email` varchar(60) DEFAULT '' COMMENT 'email',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `head_pic` varchar(255) DEFAULT '' COMMENT '头像',
  `last_login` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` varchar(15) DEFAULT '' COMMENT '最后登录ip',
  `login_cnt` int(11) DEFAULT '0' COMMENT '登录次数',
  `session_id` varchar(50) DEFAULT '' COMMENT 'session_id',
  `parent_id` int(10) DEFAULT '0' COMMENT '父管理员ID',
  `role_id` int(10) NOT NULL DEFAULT '-1' COMMENT '角色组ID（-1表示超级管理员）',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(0=屏蔽，1=正常)',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `typeid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '默认栏目id',
  PRIMARY KEY (`admin_id`),
  KEY `user_name` (`user_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- -----------------------------
-- Records of `eju_admin`
-- -----------------------------
INSERT INTO `eju_admin` VALUES ('1', 'admin', '', 'admin', '', '', '0559f7772adb28128217e0865fe4b09f', '', '1589271710', '127.0.0.1', '2', 'k3js2krcjj2v7ob8usif1oek21', '0', '-1', '1', '1589271703', '0', '0');

-- -----------------------------
-- Table structure for `eju_admin_log`
-- -----------------------------
DROP TABLE IF EXISTS `eju_admin_log`;
CREATE TABLE `eju_admin_log` (
  `log_id` bigint(16) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `admin_id` int(10) NOT NULL DEFAULT '-1' COMMENT '管理员id',
  `log_info` text COMMENT '日志描述',
  `log_ip` varchar(30) DEFAULT '' COMMENT 'ip地址',
  `log_url` varchar(255) DEFAULT '' COMMENT 'url',
  `log_time` int(11) DEFAULT '0' COMMENT '日志时间',
  PRIMARY KEY (`log_id`),
  KEY `admin_id` (`admin_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COMMENT='管理员操作日志表';

-- -----------------------------
-- Records of `eju_admin_log`
-- -----------------------------
INSERT INTO `eju_admin_log` VALUES ('47', '1', '编辑会员：', '127.0.0.1', '/login.php', '1586762660');
INSERT INTO `eju_admin_log` VALUES ('33', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762499');
INSERT INTO `eju_admin_log` VALUES ('34', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762500');
INSERT INTO `eju_admin_log` VALUES ('35', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762500');
INSERT INTO `eju_admin_log` VALUES ('36', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762501');
INSERT INTO `eju_admin_log` VALUES ('37', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762501');
INSERT INTO `eju_admin_log` VALUES ('38', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762502');
INSERT INTO `eju_admin_log` VALUES ('39', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762503');
INSERT INTO `eju_admin_log` VALUES ('40', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762503');
INSERT INTO `eju_admin_log` VALUES ('41', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762504');
INSERT INTO `eju_admin_log` VALUES ('42', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762505');
INSERT INTO `eju_admin_log` VALUES ('43', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762505');
INSERT INTO `eju_admin_log` VALUES ('44', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762506');
INSERT INTO `eju_admin_log` VALUES ('45', '-1', '自动退出', '127.0.0.1', '/login.php', '1586762524');
INSERT INTO `eju_admin_log` VALUES ('46', '1', '后台登录', '127.0.0.1', '/login.php', '1586762530');
INSERT INTO `eju_admin_log` VALUES ('48', '1', '编辑文章：金盘名邸', '127.0.0.1', '/login.php', '1586762874');
INSERT INTO `eju_admin_log` VALUES ('49', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763408');
INSERT INTO `eju_admin_log` VALUES ('50', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763408');
INSERT INTO `eju_admin_log` VALUES ('51', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763409');
INSERT INTO `eju_admin_log` VALUES ('52', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763409');
INSERT INTO `eju_admin_log` VALUES ('53', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763409');
INSERT INTO `eju_admin_log` VALUES ('54', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763411');
INSERT INTO `eju_admin_log` VALUES ('55', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763411');
INSERT INTO `eju_admin_log` VALUES ('56', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763411');
INSERT INTO `eju_admin_log` VALUES ('57', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763411');
INSERT INTO `eju_admin_log` VALUES ('58', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763411');
INSERT INTO `eju_admin_log` VALUES ('59', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763411');
INSERT INTO `eju_admin_log` VALUES ('60', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763415');
INSERT INTO `eju_admin_log` VALUES ('61', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763415');
INSERT INTO `eju_admin_log` VALUES ('62', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763415');
INSERT INTO `eju_admin_log` VALUES ('63', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763415');
INSERT INTO `eju_admin_log` VALUES ('64', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763415');
INSERT INTO `eju_admin_log` VALUES ('65', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763415');
INSERT INTO `eju_admin_log` VALUES ('66', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763423');
INSERT INTO `eju_admin_log` VALUES ('67', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763423');
INSERT INTO `eju_admin_log` VALUES ('68', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763423');
INSERT INTO `eju_admin_log` VALUES ('69', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763423');
INSERT INTO `eju_admin_log` VALUES ('70', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763423');
INSERT INTO `eju_admin_log` VALUES ('71', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763423');
INSERT INTO `eju_admin_log` VALUES ('72', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763427');
INSERT INTO `eju_admin_log` VALUES ('73', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763427');
INSERT INTO `eju_admin_log` VALUES ('74', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763427');
INSERT INTO `eju_admin_log` VALUES ('75', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763427');
INSERT INTO `eju_admin_log` VALUES ('76', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763427');
INSERT INTO `eju_admin_log` VALUES ('77', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763427');
INSERT INTO `eju_admin_log` VALUES ('78', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763431');
INSERT INTO `eju_admin_log` VALUES ('79', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763431');
INSERT INTO `eju_admin_log` VALUES ('80', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763431');
INSERT INTO `eju_admin_log` VALUES ('81', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763431');
INSERT INTO `eju_admin_log` VALUES ('82', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763431');
INSERT INTO `eju_admin_log` VALUES ('83', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763431');
INSERT INTO `eju_admin_log` VALUES ('84', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763438');
INSERT INTO `eju_admin_log` VALUES ('85', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763438');
INSERT INTO `eju_admin_log` VALUES ('86', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763438');
INSERT INTO `eju_admin_log` VALUES ('87', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763439');
INSERT INTO `eju_admin_log` VALUES ('88', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763439');
INSERT INTO `eju_admin_log` VALUES ('89', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763439');
INSERT INTO `eju_admin_log` VALUES ('90', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763442');
INSERT INTO `eju_admin_log` VALUES ('91', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763442');
INSERT INTO `eju_admin_log` VALUES ('92', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763442');
INSERT INTO `eju_admin_log` VALUES ('93', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763442');
INSERT INTO `eju_admin_log` VALUES ('94', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763443');
INSERT INTO `eju_admin_log` VALUES ('95', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763443');
INSERT INTO `eju_admin_log` VALUES ('96', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763446');
INSERT INTO `eju_admin_log` VALUES ('97', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763446');
INSERT INTO `eju_admin_log` VALUES ('98', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763446');
INSERT INTO `eju_admin_log` VALUES ('99', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763446');
INSERT INTO `eju_admin_log` VALUES ('100', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763446');
INSERT INTO `eju_admin_log` VALUES ('101', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763446');
INSERT INTO `eju_admin_log` VALUES ('102', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763450');
INSERT INTO `eju_admin_log` VALUES ('103', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763450');
INSERT INTO `eju_admin_log` VALUES ('104', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763450');
INSERT INTO `eju_admin_log` VALUES ('105', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763450');
INSERT INTO `eju_admin_log` VALUES ('106', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763450');
INSERT INTO `eju_admin_log` VALUES ('107', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763450');
INSERT INTO `eju_admin_log` VALUES ('108', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763453');
INSERT INTO `eju_admin_log` VALUES ('109', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763453');
INSERT INTO `eju_admin_log` VALUES ('110', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763454');
INSERT INTO `eju_admin_log` VALUES ('111', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763454');
INSERT INTO `eju_admin_log` VALUES ('112', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763454');
INSERT INTO `eju_admin_log` VALUES ('113', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763454');
INSERT INTO `eju_admin_log` VALUES ('114', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763457');
INSERT INTO `eju_admin_log` VALUES ('115', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763457');
INSERT INTO `eju_admin_log` VALUES ('116', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763457');
INSERT INTO `eju_admin_log` VALUES ('117', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763457');
INSERT INTO `eju_admin_log` VALUES ('118', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763457');
INSERT INTO `eju_admin_log` VALUES ('119', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763458');
INSERT INTO `eju_admin_log` VALUES ('120', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763461');
INSERT INTO `eju_admin_log` VALUES ('121', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763461');
INSERT INTO `eju_admin_log` VALUES ('122', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763461');
INSERT INTO `eju_admin_log` VALUES ('123', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763462');
INSERT INTO `eju_admin_log` VALUES ('124', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763462');
INSERT INTO `eju_admin_log` VALUES ('125', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763462');
INSERT INTO `eju_admin_log` VALUES ('126', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763464');
INSERT INTO `eju_admin_log` VALUES ('127', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763465');
INSERT INTO `eju_admin_log` VALUES ('128', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763465');
INSERT INTO `eju_admin_log` VALUES ('129', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763465');
INSERT INTO `eju_admin_log` VALUES ('130', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763465');
INSERT INTO `eju_admin_log` VALUES ('131', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763469');
INSERT INTO `eju_admin_log` VALUES ('132', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763472');
INSERT INTO `eju_admin_log` VALUES ('133', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763472');
INSERT INTO `eju_admin_log` VALUES ('134', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763472');
INSERT INTO `eju_admin_log` VALUES ('135', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763473');
INSERT INTO `eju_admin_log` VALUES ('136', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763473');
INSERT INTO `eju_admin_log` VALUES ('137', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763473');
INSERT INTO `eju_admin_log` VALUES ('138', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763480');
INSERT INTO `eju_admin_log` VALUES ('139', '-1', '自动退出', '127.0.0.1', '/login.php', '1586763487');
INSERT INTO `eju_admin_log` VALUES ('140', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764393');
INSERT INTO `eju_admin_log` VALUES ('141', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764396');
INSERT INTO `eju_admin_log` VALUES ('142', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764400');
INSERT INTO `eju_admin_log` VALUES ('143', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764404');
INSERT INTO `eju_admin_log` VALUES ('144', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764408');
INSERT INTO `eju_admin_log` VALUES ('145', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764410');
INSERT INTO `eju_admin_log` VALUES ('146', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764411');
INSERT INTO `eju_admin_log` VALUES ('147', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764411');
INSERT INTO `eju_admin_log` VALUES ('148', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764411');
INSERT INTO `eju_admin_log` VALUES ('149', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764412');
INSERT INTO `eju_admin_log` VALUES ('150', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764412');
INSERT INTO `eju_admin_log` VALUES ('151', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764414');
INSERT INTO `eju_admin_log` VALUES ('152', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764414');
INSERT INTO `eju_admin_log` VALUES ('153', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764414');
INSERT INTO `eju_admin_log` VALUES ('154', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764415');
INSERT INTO `eju_admin_log` VALUES ('155', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764415');
INSERT INTO `eju_admin_log` VALUES ('156', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764416');
INSERT INTO `eju_admin_log` VALUES ('157', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764418');
INSERT INTO `eju_admin_log` VALUES ('158', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764418');
INSERT INTO `eju_admin_log` VALUES ('159', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764418');
INSERT INTO `eju_admin_log` VALUES ('160', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764419');
INSERT INTO `eju_admin_log` VALUES ('161', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764419');
INSERT INTO `eju_admin_log` VALUES ('162', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764420');
INSERT INTO `eju_admin_log` VALUES ('163', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764422');
INSERT INTO `eju_admin_log` VALUES ('164', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764422');
INSERT INTO `eju_admin_log` VALUES ('165', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764422');
INSERT INTO `eju_admin_log` VALUES ('166', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764422');
INSERT INTO `eju_admin_log` VALUES ('167', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764423');
INSERT INTO `eju_admin_log` VALUES ('168', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764424');
INSERT INTO `eju_admin_log` VALUES ('169', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764426');
INSERT INTO `eju_admin_log` VALUES ('170', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764426');
INSERT INTO `eju_admin_log` VALUES ('171', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764426');
INSERT INTO `eju_admin_log` VALUES ('172', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764426');
INSERT INTO `eju_admin_log` VALUES ('173', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764427');
INSERT INTO `eju_admin_log` VALUES ('174', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764428');
INSERT INTO `eju_admin_log` VALUES ('175', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764429');
INSERT INTO `eju_admin_log` VALUES ('176', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764429');
INSERT INTO `eju_admin_log` VALUES ('177', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764429');
INSERT INTO `eju_admin_log` VALUES ('178', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764430');
INSERT INTO `eju_admin_log` VALUES ('179', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764431');
INSERT INTO `eju_admin_log` VALUES ('180', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764431');
INSERT INTO `eju_admin_log` VALUES ('181', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764433');
INSERT INTO `eju_admin_log` VALUES ('182', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764433');
INSERT INTO `eju_admin_log` VALUES ('183', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764433');
INSERT INTO `eju_admin_log` VALUES ('184', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764434');
INSERT INTO `eju_admin_log` VALUES ('185', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764435');
INSERT INTO `eju_admin_log` VALUES ('186', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764435');
INSERT INTO `eju_admin_log` VALUES ('187', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764437');
INSERT INTO `eju_admin_log` VALUES ('188', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764437');
INSERT INTO `eju_admin_log` VALUES ('189', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764437');
INSERT INTO `eju_admin_log` VALUES ('190', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764437');
INSERT INTO `eju_admin_log` VALUES ('191', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764438');
INSERT INTO `eju_admin_log` VALUES ('192', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764439');
INSERT INTO `eju_admin_log` VALUES ('193', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764439');
INSERT INTO `eju_admin_log` VALUES ('194', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764440');
INSERT INTO `eju_admin_log` VALUES ('195', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764440');
INSERT INTO `eju_admin_log` VALUES ('196', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764440');
INSERT INTO `eju_admin_log` VALUES ('197', '-1', '自动退出', '127.0.0.1', '/login.php', '1586764440');
INSERT INTO `eju_admin_log` VALUES ('198', '1', '新增数据：1242141221', '127.0.0.1', '/', '1586764459');
INSERT INTO `eju_admin_log` VALUES ('199', '1', '删除文档-id：79', '127.0.0.1', '/', '1586764463');
INSERT INTO `eju_admin_log` VALUES ('200', '1', '编辑模型：二手房模型', '127.0.0.1', '/login.php', '1586764483');
INSERT INTO `eju_admin_log` VALUES ('201', '1', '编辑模型：租房模型', '127.0.0.1', '/login.php', '1586764496');
INSERT INTO `eju_admin_log` VALUES ('202', '1', '编辑模型：团购模型', '127.0.0.1', '/login.php', '1586764509');
INSERT INTO `eju_admin_log` VALUES ('203', '1', '编辑文章：富力首府（办公楼）', '127.0.0.1', '/login.php', '1586764564');
INSERT INTO `eju_admin_log` VALUES ('204', '1', '编辑文章：富力首府（办公楼）', '127.0.0.1', '/login.php', '1586764863');
INSERT INTO `eju_admin_log` VALUES ('205', '1', '编辑文章：雅居乐清水湾', '127.0.0.1', '/login.php', '1586764894');
INSERT INTO `eju_admin_log` VALUES ('206', '1', '编辑文章：雅居乐清水湾', '127.0.0.1', '/login.php', '1586765728');
INSERT INTO `eju_admin_log` VALUES ('207', '1', '新增数据：11111', '127.0.0.1', '/login.php', '1586765751');
INSERT INTO `eju_admin_log` VALUES ('208', '1', '删除文档-id：80', '127.0.0.1', '/login.php', '1586765756');
INSERT INTO `eju_admin_log` VALUES ('209', '1', '新增数据：1111', '127.0.0.1', '/login.php', '1586765769');
INSERT INTO `eju_admin_log` VALUES ('210', '1', '删除文档-id：81', '127.0.0.1', '/login.php', '1586765781');
INSERT INTO `eju_admin_log` VALUES ('211', '1', '新增数据：1111', '127.0.0.1', '/login.php', '1586765799');
INSERT INTO `eju_admin_log` VALUES ('212', '1', '删除文档-id：82', '127.0.0.1', '/login.php', '1586765812');
INSERT INTO `eju_admin_log` VALUES ('213', '-1', '自动退出', '127.0.0.1', '/login.php', '1586914953');
INSERT INTO `eju_admin_log` VALUES ('214', '1', '后台登录', '127.0.0.1', '/login.php', '1586915413');
INSERT INTO `eju_admin_log` VALUES ('215', '1', '新增会员：', '127.0.0.1', '/login.php', '1586915463');
INSERT INTO `eju_admin_log` VALUES ('216', '1', '编辑会员：', '127.0.0.1', '/login.php', '1586915526');
INSERT INTO `eju_admin_log` VALUES ('217', '1', '新增数据：第一个会员房源', '127.0.0.1', '/', '1586916619');
INSERT INTO `eju_admin_log` VALUES ('218', '1', '新增数据：第一个会员房源', '127.0.0.1', '/', '1586916640');
INSERT INTO `eju_admin_log` VALUES ('219', '-1', '自动退出', '127.0.0.1', '/login.php', '1589271705');
INSERT INTO `eju_admin_log` VALUES ('220', '1', '后台登录', '127.0.0.1', '/login.php', '1589271710');

-- -----------------------------
-- Table structure for `eju_answer`
-- -----------------------------
DROP TABLE IF EXISTS `eju_answer`;
CREATE TABLE `eju_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ask_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '问题id',
  `is_bestanswer` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否最佳答案，0否，1是',
  `is_review` tinyint(1) NOT NULL DEFAULT '1' COMMENT '问题是否审核，1是，0否',
  `users_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `click_like` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞量',
  `users_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '用户IP地址',
  `content` text NOT NULL COMMENT '内容',
  `ifcheck` tinyint(1) NOT NULL DEFAULT '1',
  `answer_pid` int(10) NOT NULL DEFAULT '0' COMMENT '子答案的父答案',
  `at_users_id` int(10) NOT NULL DEFAULT '0' COMMENT '被@的用户ID',
  `at_answer_id` int(10) NOT NULL DEFAULT '0' COMMENT '@答案ID',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `question_id` (`ask_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='回答表';

-- -----------------------------
-- Records of `eju_answer`
-- -----------------------------
INSERT INTO `eju_answer` VALUES ('1', '2', '0', '1', '3', 'xuyuzi', '0', '127.0.0.1', '&lt;p&gt;这是第一个回答-修改&lt;br/&gt;&lt;/p&gt;', '1', '0', '0', '0', '1586916509', '1586916935');

-- -----------------------------
-- Table structure for `eju_answer_like`
-- -----------------------------
DROP TABLE IF EXISTS `eju_answer_like`;
CREATE TABLE `eju_answer_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ask_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '问题ID',
  `answer_id` int(10) NOT NULL DEFAULT '0' COMMENT '答案ID',
  `users_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `users_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '用户IP地址',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='点赞记录表';


-- -----------------------------
-- Table structure for `eju_archives`
-- -----------------------------
DROP TABLE IF EXISTS `eju_archives`;
CREATE TABLE `eju_archives` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `joinaid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联文档id',
  `typeid` int(10) NOT NULL DEFAULT '0' COMMENT '当前栏目',
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '模型ID',
  `is_b` tinyint(1) NOT NULL DEFAULT '0' COMMENT '加粗',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  `litpic` varchar(250) NOT NULL DEFAULT '' COMMENT '缩略图',
  `is_head` tinyint(1) NOT NULL DEFAULT '0' COMMENT '头条（0=否，1=是）',
  `is_special` tinyint(1) NOT NULL DEFAULT '0' COMMENT '特荐（0=否，1=是）',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶（0=否，1=是）',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐（0=否，1=是）',
  `is_jump` tinyint(1) NOT NULL DEFAULT '0' COMMENT '跳转链接（0=否，1=是）',
  `is_litpic` tinyint(1) NOT NULL DEFAULT '0' COMMENT '图片（0=否，1=是）',
  `is_sale` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '特价',
  `is_moods` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '人气',
  `author` varchar(200) NOT NULL DEFAULT '' COMMENT '作者',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `arcrank` tinyint(1) NOT NULL DEFAULT '0' COMMENT '阅读权限：0=开放浏览，-1=待审核稿件',
  `jumplinks` varchar(200) NOT NULL DEFAULT '' COMMENT '外链跳转',
  `ismake` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否静态页面（0=动态，1=静态）',
  `seo_title` varchar(200) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(200) NOT NULL DEFAULT '' COMMENT 'SEO关键词',
  `seo_description` text NOT NULL COMMENT 'SEO描述',
  `users_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '会员价',
  `prom_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '产品类型：0普通产品，1虚拟产品',
  `tempview` varchar(200) NOT NULL DEFAULT '' COMMENT '文档模板文件名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0=屏蔽，1=正常)',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `admin_id` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `del_method` tinyint(1) NOT NULL DEFAULT '0' COMMENT '伪删除状态，1为主动删除，2为跟随上级栏目被动删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `province_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '省份',
  `city_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在城市',
  `area_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所在区域',
  `users_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属经纪人id',
  `relate` varchar(20) DEFAULT '' COMMENT '关联经纪人id集合',
  `show_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '置顶时间',
  `add_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1：主动添加，0：关联自动生成',
  PRIMARY KEY (`aid`),
  KEY `province_id` (`province_id`,`channel`) USING BTREE,
  KEY `typeid` (`typeid`,`channel`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COMMENT='文档主表';

-- -----------------------------
-- Records of `eju_archives`
-- -----------------------------
INSERT INTO `eju_archives` VALUES ('1', '0', '1', '9', '0', '融创观澜湖公园壹号', '/uploads/allimg/20191011/1-191011110640X1.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570766148', '1570776910', '21', '35', '0', '2', '', '1570766148', '1');
INSERT INTO `eju_archives` VALUES ('2', '0', '1', '9', '0', '远大购物广场', '/uploads/allimg/20191011/1-191011142A1G0.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570776916', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('3', '0', '1', '9', '0', '观澜湖·观悦', '/uploads/allimg/20191011/1-191011143012234.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570776921', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('4', '0', '1', '9', '0', '观澜湖·九里', '/uploads/allimg/20191011/1-191011143334305.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570775839', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('5', '0', '1', '9', '0', '南海·幸福汇', '/uploads/allimg/20191011/1-191011144204449.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570776127', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('6', '0', '1', '9', '0', '绿地城·江东首府', '/uploads/allimg/20191011/1-191011144344303.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570776241', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('7', '0', '1', '9', '0', '世茂·秀英里', '/uploads/allimg/20191011/1-1910111452533Y.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570776884', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('8', '0', '1', '9', '0', '碧桂园·中央半岛', '/uploads/allimg/20191011/1-191011145550621.jpg', '1', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570777023', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('9', '0', '1', '9', '0', '恒大·美丽沙', '/uploads/allimg/20191011/1-191011145K4527.jpg', '0', '1', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570777138', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('10', '0', '1', '9', '0', '大华·锦绣海岸', '/uploads/allimg/20191011/1-191011145920529.gif', '0', '1', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570777214', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('11', '0', '1', '9', '0', '雅居乐金沙湾', '/uploads/allimg/20191011/1-191011150051216.jpg', '0', '1', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570777342', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('12', '0', '1', '9', '0', '富力首府（办公楼）', '/uploads/allimg/20191011/1-191011150329B8.jpg', '0', '1', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570777448', '21', '35', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('13', '0', '1', '9', '0', '保利崖州湾', '/uploads/allimg/20191011/1-191011150I31D.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570778361', '21', '36', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('14', '0', '1', '9', '0', '万科湖畔度假公园', '/uploads/allimg/20191011/1-191011150KK56.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570778379', '21', '36', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('15', '0', '1', '9', '0', '融创·美伦熙语', '/uploads/allimg/20191011/1-191011151405242.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570778393', '21', '45', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('16', '0', '1', '9', '0', '博鳌阳光海岸', '/uploads/allimg/20191011/1-191011151J0212.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570778409', '21', '38', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('17', '0', '1', '9', '0', '雅居乐清水湾', '/uploads/allimg/20191011/1-191011152113420.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1570778489', '21', '50', '0', '2', '', '1570775121', '1');
INSERT INTO `eju_archives` VALUES ('18', '0', '1', '9', '0', '金盘名邸', '/uploads/allimg/20191011/1-191011152F6263.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '', '', '融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。项目紧邻观澜湖旅游度假区主入口，延观澜湖2', '0.00', '0', '', '1', '100', '1', '0', '0', '1570775121', '1586762873', '21', '35', '0', '2', '', '1586762873', '1');
INSERT INTO `eju_archives` VALUES ('19', '0', '6', '1', '0', '绿地集团战略重组贵州药材 大健康产业混改首单亮相', '/uploads/allimg/20191011/1-191011153H1627.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '240', '0', '', '0', '', '', '绿地集团混改事业再下一城。　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779425', '1570779718', '0', '0', '0', '0', '', '1570779425', '1');
INSERT INTO `eju_archives` VALUES ('20', '0', '6', '1', '0', '权威解读：你的户口、土地、收入将有这些变化', '/uploads/allimg/20191011/1-191011153ZX11.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '192', '0', '', '0', '', '', '中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。户口——放开放宽除个别超大城市外的城市落户限制《意见》设定了“到2022年城市落户限制', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779544', '1570779707', '0', '0', '0', '0', '', '1570779544', '1');
INSERT INTO `eju_archives` VALUES ('21', '0', '6', '1', '0', '选房看什么？从区位到配套为您详细解读', '/uploads/allimg/20191011/1-19101115403ML.png', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '241', '0', '', '0', '', '', '绿地集团混改事业再下一城。　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779610', '1570779639', '0', '0', '0', '0', '', '1570779610', '1');
INSERT INTO `eju_archives` VALUES ('22', '0', '6', '1', '0', '国管公积金“认房又认贷”二套房首付最低六成', '/uploads/allimg/20191011/1-1910111542415V.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '239', '0', '', '0', '', '', '绿地集团混改事业再下一城。　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779610', '1570779763', '0', '0', '0', '0', '', '1570779610', '1');
INSERT INTO `eju_archives` VALUES ('23', '0', '6', '1', '0', '取消落户限制！这份通知干货多！', '/uploads/allimg/20191011/1-1910111544101U.png', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '238', '0', '', '0', '', '', '绿地集团混改事业再下一城。　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779610', '1570779855', '0', '0', '0', '0', '', '1570779610', '1');
INSERT INTO `eju_archives` VALUES ('24', '0', '6', '1', '0', '超12城放松房贷利率，置业者的春天要来了？', '/uploads/allimg/20191011/1-191011155011616.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '194', '0', '', '0', '', '', '中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。户口——放开放宽除个别超大城市外的城市落户限制《意见》设定了“到2022年城市落户限制', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779610', '1570780213', '0', '0', '0', '0', '', '1570779610', '1');
INSERT INTO `eju_archives` VALUES ('25', '0', '6', '1', '0', '2019购房好时机？别忘了买房需要牢记这七大原则！', '/uploads/allimg/20191011/1-19101115502S23.png', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '192', '0', '', '0', '', '', '中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。户口——放开放宽除个别超大城市外的城市落户限制《意见》设定了“到2022年城市落户限制', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779610', '1570780287', '0', '0', '0', '0', '', '1570779610', '1');
INSERT INTO `eju_archives` VALUES ('26', '0', '6', '1', '0', '房地产调控政策大复盘：回首过去20年政策有何变化？', '/uploads/allimg/20191011/1-19101115504D21.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '192', '0', '', '0', '', '', '中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。户口——放开放宽除个别超大城市外的城市落户限制《意见》设定了“到2022年城市落户限制', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779610', '1570780262', '0', '0', '0', '0', '', '1570779610', '1');
INSERT INTO `eju_archives` VALUES ('27', '0', '6', '1', '0', '个人应该如何选择房地产？四大技巧深度解析', '/uploads/allimg/20191011/1-191011155254131.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '197', '0', '', '0', '', '', '中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。户口——放开放宽除个别超大城市外的城市落户限制《意见》设定了“到2022年城市落户限制', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779881', '1570780776', '0', '0', '0', '0', '', '1570779881', '1');
INSERT INTO `eju_archives` VALUES ('28', '0', '5', '1', '0', '父母房子留给子女 哪种方式更省钱？', '/uploads/allimg/20191011/1-1910111553262W.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '192', '0', '', '0', '', '', '中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。户口——放开放宽除个别超大城市外的城市落户限制《意见》设定了“到2022年城市落户限制', '0.00', '0', '', '1', '100', '1', '0', '0', '1570779961', '1570780425', '0', '0', '0', '0', '', '1570779961', '1');
INSERT INTO `eju_archives` VALUES ('29', '1', '3', '10', '0', '融创观澜湖公园壹号', '/uploads/allimg/20191011/1-191011154PV48.jpg', '0', '0', '0', '0', '0', '0', '0', '0', '小编', '173', '0', '', '0', '', '', '报名团购享优惠：1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。2.免费接机，免费看房，置业顾问全程陪同。3.购房成功可报销机票。4.参加团购可获更多优惠、特价房源等信息。融创观澜湖公园壹号（相册 动态 户型）为中国地产十强', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780023', '1570780113', '0', '0', '0', '0', '', '1570780023', '1');
INSERT INTO `eju_archives` VALUES ('30', '0', '5', '1', '0', '购房指南：异地购房的注意事项', '/uploads/allimg/20191011/1-19101115540UN.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '147', '0', '', '0', '', '', '目前随着时代的发展，异地购房的现象越来越普遍。较大的原因在于很多人的工作和户口不在同一个地方，大多希望能够在工作地安居定业。也有一小部分人希望在适宜养老的地方购房，为未来有个舒适的养老环境做准备。由于都是异地，和在本地购房还是有些差异。一、符合购房资', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780431', '1570780431', '0', '0', '0', '0', '', '1570780431', '1');
INSERT INTO `eju_archives` VALUES ('31', '0', '5', '1', '0', '房产证可以抵押给个人吗？有哪些注意事项？', '/uploads/allimg/20191011/1-191011155455336.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '109', '0', '', '0', '', '', '房产证可以抵押给个人，但是在房产证抵押时一定要签定一份《房产抵押借款合同》，对借款金额、是否支付利息或利率标准、还款期限、还款方式、抵押物及抵押登记的办理以及违约责任等内容作出明确具体的约定，并在合同签订后到房屋产权管理部门办理抵押登记手续。1.房产', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780481', '1570780481', '0', '0', '0', '0', '', '1570780481', '1');
INSERT INTO `eju_archives` VALUES ('32', '0', '5', '1', '0', '买电梯房不懂梯户比？这关系到您居住的舒适度', '/uploads/allimg/20191011/1-191011155524458.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '239', '0', '', '0', '', '', '随着各种纠纷的产生，有关公摊面积的话题也频频上了头条和热搜，但其实，与公摊面积更为紧密相连的是梯户比。一般来说，在购房的过程，大家除了考虑价格、位置、周边设施、容积率等因素外，经常会忽略一个重要的因素——梯户比，因为梯户比不仅关系着公摊面积、电梯运营', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780520', '1570780520', '0', '0', '0', '0', '', '1570780520', '1');
INSERT INTO `eju_archives` VALUES ('33', '0', '5', '1', '0', '购房指南：实地看房时需要注意哪些问题', '/uploads/allimg/20191011/1-191011155553Z7.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '287', '0', '', '0', '', '', '如何挑选一套适合自己家庭需要、性价比又高的房子是每一个买房人较关注的问题，同时也是困扰每个购房者的问题。每到一个售楼部销售人员都会给你说的天花乱坠，自家的房子要多好有多好，但是要挑选好一套称心如意的房子你必须学会自己看房。一、看房前应准备什么？首先明', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780542', '1570780542', '0', '0', '0', '0', '', '1570780542', '1');
INSERT INTO `eju_archives` VALUES ('34', '0', '5', '1', '0', '房子继承问题差别早知道！', '/uploads/allimg/20191011/1-191011155F3962.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '258', '0', '', '0', '', '', '每个孩子都是父母的宝贝，从孩子出生开始就成了父母努力的动力，他们拼搏一辈子就是为了给孩子更好的生活，而他们奋斗一辈子除了供孩子读书生活，剩下的积蓄可能都倾注在了房子上。人的生老病死不是人为可控的，很多时候都来的那么突然，老人的突然离世会增加资产处理的', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780610', '1570780610', '0', '0', '0', '0', '', '1570780610', '1');
INSERT INTO `eju_archives` VALUES ('35', '0', '5', '1', '0', '海景别墅值得购买吗？优缺点大梳理', '/uploads/allimg/20191011/1-191011155H9245.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '123', '0', '', '0', '', '', '择海而居望海而眠，海边的一栋别墅就能满足您的海居梦想，朝朝対海景看春暖花开。但是海景别墅的优缺点您有充分的了解过吗？海景别墅不一定适合每个想要购房的置业者，下面小编为您解析海景别墅自身有哪些优劣之处。什么是海景别墅呢？就是可以近距离观赏到海景的别墅，', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780639', '1570780790', '0', '0', '0', '0', '', '1570780639', '1');
INSERT INTO `eju_archives` VALUES ('36', '0', '5', '1', '0', '购房小知识：同个小区怎么选楼房？', '/uploads/allimg/20191011/1-191011160015A0.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '118', '0', '', '0', '', '', '相同的一个小区里，怎么选出适合的楼房？正常情况下，房子的价格往往是不少购房者较关注的核心，但今天的主题是：在房价合适的情况下，同个小区怎么选楼房？因为除了房价之外，购房者接下来需要着重关注的就是如何在一个小区众多房源中选择适合自己的好房子，一般一个社', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780792', '1570780792', '0', '0', '0', '0', '', '1570780792', '1');
INSERT INTO `eju_archives` VALUES ('37', '0', '5', '1', '0', '房产证加名小知识点必须了解清楚', '/uploads/allimg/20191011/1-191011160043223.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '219', '0', '', '0', '', '', '我们经常可以在新闻上看到夫妻俩为了在房产证上写谁的名字而大打出手的情况，因此，很多年轻夫妻在结婚时，为了表达诚意，会在自己婚前购买的房产证上加上对方的名字，但是对于房产证加名字这一件事，很多人只听说过，却没有实际操作过，那么房产证上可以写几个名字？房', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780831', '1570780831', '0', '0', '0', '0', '', '1570780831', '1');
INSERT INTO `eju_archives` VALUES ('38', '0', '7', '1', '0', '买房为什么认定品牌开发商？价格“9”字头开售揭露优势', '/uploads/allimg/20191011/1-191011160122205.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '105', '0', '', '0', '', '', '其实，不管是什么时候，也不管买什么东西，选择品牌，是最好不过的，在房地产这块也一样，买房最好选择品牌开发商，这是为什么呢？因为品牌代表着各方面的质量，品牌开发商的房子不仅不用担心开发过程中出现的资金链断裂而造成的烂尾楼的情况，而且往往在地段、配套、物', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780863', '1570780863', '0', '0', '0', '0', '', '1570780863', '1');
INSERT INTO `eju_archives` VALUES ('39', '0', '7', '1', '0', '为什么越来越多的人选择精装房 透露现在不买会后悔', '/uploads/allimg/20191011/1-19101116021I04.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '116', '0', '', '0', '', '', '房子一直以来都是人们最为关注的话题，现新房出售主要有两种形式，一是毛坯房，二是精装房，买毛坯房常常让业主费尽脑筋，尤其是在装修方面要花大量的心思，很多事情都需要亲力亲为，而精装房直接住而无装修之烦恼，“拎包入住”是精装房代表性的关键词，那么精装房到底', '0.00', '0', '', '1', '100', '1', '0', '0', '1570780923', '1570780923', '0', '0', '0', '0', '', '1570780923', '1');
INSERT INTO `eju_archives` VALUES ('40', '0', '7', '1', '0', '富力悦海湾PK观澜湖观悦——海南居住度假投资哪家强？', '/uploads/allimg/20191011/1-191011160342c1.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '236', '0', '', '0', '', '', '大家应该都知道海南是特别适合养老度假的吧？毕竟海南山好水好景好人更好，独特的地理位置、优越的自然风景吸引着无数购房者的目光，越来越多的外地人聚集海南买房养老，或过冬养老、或旅游度假、或投资升值，那么海南哪里比较适合养老、度假、投资呢？今天小编就要给大', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781010', '1570781010', '0', '0', '0', '0', '', '1570781010', '1');
INSERT INTO `eju_archives` VALUES ('41', '0', '7', '1', '0', '融创观澜湖公园壹号PK观澜湖九里 果岭养生楼盘大解析', '/uploads/allimg/20191011/1-19101116051Tb.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '154', '0', '', '0', '', '', '海口为海南的省会城市，海口观澜湖以整体占地33000亩的庞大之势，打造全新的海口新时尚中心。举头可一览万亩果岭，高达80%绿化率，万亩园林以及丰沛的配套，成为不少置业者的青睐，也汇聚了不少养生度假高端社区。作为观澜湖两大热门置业楼盘：观澜湖九里和融创', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781091', '1570781091', '0', '0', '0', '0', '', '1570781091', '1');
INSERT INTO `eju_archives` VALUES ('42', '0', '7', '1', '0', '恒大海花岛——海南稀有的海景资源，打造旅游休闲度假岛', '/uploads/allimg/20191011/1-191011160600246.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '182', '0', '', '0', '', '', '海南吸引人的地方就在它的环境资源——阳光、空气、蓝天、海水，这些才是很珍贵的，海南恒大海花岛是每家每户都家喻户晓的楼盘，可想而知人气是有多么的强大，而且是大品牌开发商，无论是品牌力量还是价格都是非常具有吸引力，恒大海花岛是一线的海景楼盘，在海南将会是', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781149', '1570781149', '0', '0', '0', '0', '', '1570781149', '1');
INSERT INTO `eju_archives` VALUES ('43', '0', '7', '1', '0', '海口观澜湖观悦楼盘分析：回家就是度假的生活', '/uploads/allimg/20191011/1-191011160J2G6.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '170', '0', '', '0', '', '', '海口观澜湖近几年的发展十分迅速，为世界各地的游客提供了一个集高秋运动、旅游度假、休闲娱乐、环球美食和温泉水疗于一身的绝佳旅游目的地。整个观澜湖的度假区面积广袤，各大楼盘崛地而起，不少人也因此到头疼，今天小编就向大家来介绍观澜湖观悦这个楼盘，让我们一起', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781249', '1570781249', '0', '0', '0', '0', '', '1570781249', '1');
INSERT INTO `eju_archives` VALUES ('44', '0', '7', '1', '0', '融创观澜湖公园壹号三房宽敞户型邀您品析', '/uploads/allimg/20191011/1-191011160UM15.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '194', '0', '', '0', '', '', '融创观澜湖公园壹号项目定位海口观澜湖景观旅游片区。项目家内外的景致浑然天成，择居于此，幸福的风景不远，倾心的生活更近。本期小编为大家带来项目建面123.67-129.98㎡的三房户型和您一同品析。融创观澜湖公园壹号实景图项目规划为3室2厅2卫1厨，整', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781313', '1570781313', '0', '0', '0', '0', '', '1570781313', '1');
INSERT INTO `eju_archives` VALUES ('45', '0', '7', '1', '0', '富力悦海湾别墅样板间实景图赏', '/uploads/ueditor/20191011/1-191011161053S6.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '184', '0', '', '0', '', '', '位于海南临高的富力悦海湾项目作为十强地产富力在临高开发的精品滨海旅居大盘，项目产品类型多样满足客户各种需求。本期小编为大家带来的是项目别墅样板间实景图片赏析。富力悦海湾别墅样板间实景图富力悦海湾别墅样板间实景图项目别墅产品皆为精装修交付，项目外立面采', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781421', '1570781421', '0', '0', '0', '0', '', '1570781421', '1');
INSERT INTO `eju_archives` VALUES ('46', '0', '7', '1', '0', '融创美伦熙语为何如此火爆？', '/uploads/allimg/20191011/1-19101116113M60.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '207', '0', '', '0', '', '', '融创美伦熙语项目立身于澄迈长寿乡，以精品打造水景生活成为岛内外购房者的青睐之选。那么作为热销楼盘，项目究竟有何优点呢？项目优势总结有四点。首先是由融创开发，品牌开放商融创的出品给予了项目另一重保障；其二在于项目周边完善的配套和发达的交通网便于日常生活', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781486', '1570781486', '0', '0', '0', '0', '', '1570781486', '1');
INSERT INTO `eju_archives` VALUES ('47', '1', '4', '1', '0', '融创观澜湖公园壹号内部打造了3万㎡园林景观', '/uploads/ueditor/20191011/1-191011161351249.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '299', '0', '', '0', '', '', '海南海口融创观澜湖公园壹号项目内部打造了3万㎡的园林景观，每一处都是诗情画意，生活宁静祥和，此外，在每栋住宅区之间安排了富有层次的疏林草地，让社区富有观赏性的同时更具隐蔽性。超大观景阳台正对观澜湖景区，高尔夫果岭、百亩荔枝林，绿意生活尽收眼底。目前在', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781586', '1570781586', '21', '35', '0', '0', '', '1570781586', '1');
INSERT INTO `eju_archives` VALUES ('48', '1', '4', '1', '0', '融创观澜湖公园壹号纯板式果岭美宅热销中 均价13300元/㎡', '/uploads/allimg/20191011/1-19101116163I61.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '258', '0', '', '0', '', '', '融创观澜湖公园壹号四期纯板式果岭美宅热销中，建面为108-143㎡，均价13300元/㎡，南北通透，楼体坐北朝南，高尔夫果岭、荔枝林景观尽收眼底，带来一见倾心的诗意生活。项目共54栋楼,一期规划有1栋会所、14栋南北通透的板式高层公寓、40栋 精品别', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781659', '1570781799', '0', '0', '0', '0', '', '1570781659', '1');
INSERT INTO `eju_archives` VALUES ('49', '1', '4', '1', '0', '融创观澜湖公园壹号四期2-3#预计2020年12月交房', '/uploads/allimg/20191011/1-19101116150M63.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '171', '0', '', '0', '', '', '融创观澜湖公园壹号项目为低层、高层板楼，2019年4月28日四期2#和3#开盘，项目共54栋楼,一期规划有1栋会所、14栋南北通透的板式高层公寓、40栋精品别墅，14栋高层公寓每栋均为21层，首层架空，预计2020年12月四期交房。在售户型建面101', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781691', '1570781768', '21', '35', '0', '0', '', '1570781691', '1');
INSERT INTO `eju_archives` VALUES ('50', '1', '4', '1', '0', '融创观澜湖公园壹号精装交付 引入品牌进行布置', '/uploads/allimg/20191011/1-19101116155I01.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '158', '0', '', '0', '', '', '融创观澜湖公园壹号精装交付，厨房、卫浴等重点空间将引入品牌进行布置，中央空调入户，台盆柜、镜柜、橱柜精心收纳动线，实现无忧入住优质生活体验。百年荔枝林、生态农庄、湿地景观等环绕周边，鲜氧丰富，尽情深呼吸。免费来电可享五重优惠折扣大礼包，不仅如此，还有', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781722', '1570781774', '0', '0', '0', '0', '', '1570781722', '1');
INSERT INTO `eju_archives` VALUES ('51', '11', '4', '1', '0', '海南海囗雅居乐金沙湾小区内配套已落实 售海景洋房', '/uploads/allimg/20191011/1-191011162143515.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '119', '0', '', '0', '', '', '雅居乐金沙湾占地面积376666平方米，建筑面积700000平方米，2、3、4栋为26层；叠拼4层；联排2层；1栋公寓10层。小区内部规划有超市、图书馆、商业街、运动场地、健身设施、会所、老年文化中心。【在售海景洋房，建面92-143㎡，均价1300', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781804', '1570782118', '0', '0', '0', '0', '', '1570781804', '1');
INSERT INTO `eju_archives` VALUES ('52', '11', '4', '1', '0', '雅居乐金沙湾坐享四周便利 路网通达', '/uploads/allimg/20191011/1-191011162151P0.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '136', '0', '', '0', '', '', '雅居乐金沙湾位于海口西海岸金沙湾路，北邻海口新海港，南靠金沙湾旅游度假区，东接海口火车站及海口高铁站，西距海边约500米，项目距离海口市中心约17公里，距离海口美兰机场大约40公里，路网发达，交通便捷。目前在售洋房户型，均价13000元/平，免费来电', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781934', '1570782113', '0', '0', '0', '0', '', '1570781934', '1');
INSERT INTO `eju_archives` VALUES ('53', '11', '4', '1', '0', '雅居乐金沙湾城市园林营造舒心娱乐生活', '/uploads/allimg/20191011/1-191011162205U2.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '120', '0', '', '0', '', '', '雅居乐金沙湾作为整体绿化率高达42%的小区，初入眼帘的便是，项目丰富的4D体验区，开放式的草坪，配合着环绕型的“椰林梯台”台地景观，形成了一个自然的室外剧场，或儿童嬉戏，或天然日浴，或夜半观影，都是一家人的开心选择。位于栈道另一侧的水上游乐场，以及下', '0.00', '0', '', '1', '100', '1', '0', '0', '1570781998', '1570782127', '0', '0', '0', '0', '', '1570781998', '1');
INSERT INTO `eju_archives` VALUES ('54', '11', '4', '1', '0', '雅居乐金沙湾主推四期6#产品 智能家电呵护安全', '/uploads/allimg/20191011/1-191011162243214.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '266', '0', '', '0', '', '', '雅居乐金沙湾项目覆盖一线海景别墅、亲海精装洋房、海上百变空间等丰富产品线，更甄选国内外一线精装品牌，智能化精装交付，联网密码入户、智能面板开关、无线门磁防护，形成有效预警，呵护全家安全。【在售楼栋】四期6#【户型面积】建面约103-105平三房【房源', '0.00', '0', '', '1', '100', '1', '0', '0', '1570782130', '1570782130', '21', '35', '0', '0', '', '1570782130', '1');
INSERT INTO `eju_archives` VALUES ('55', '11', '4', '1', '0', '海南海口雅居乐金沙湾建面43-142平户型热销中', '/uploads/allimg/20191011/1-19101116240Q52.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '251', '0', '', '0', '', '', '海南海口雅居乐金沙湾位于西海岸金沙湾区金德路，项目规划总占地面积约565亩，总建筑面积约70万平方，预计分五期开发。项目一期占地67079㎡，约100亩，建筑面积134158㎡，容积率2.0。【在售户型】建面43-142平户型热销中；【房源售价】均价', '0.00', '0', '', '1', '100', '1', '0', '0', '1570782205', '1570782205', '21', '35', '0', '0', '', '1570782205', '1');
INSERT INTO `eju_archives` VALUES ('56', '2', '3', '10', '0', '远大购物广场', '/uploads/allimg/20191011/1-1910111G935304.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '282', '0', '', '0', '', '', '报名团购享优惠：1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。2.免费接机，免费看房，置业顾问全程陪同。3.购房成功可报销机票。4.参加团购可获更多优惠、特价房源等信息。融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自', '0.00', '0', '', '1', '100', '1', '0', '0', '1570785547', '1570785547', '0', '0', '0', '0', '', '1570785547', '1');
INSERT INTO `eju_archives` VALUES ('57', '3', '3', '10', '0', '观澜湖·观悦', '/uploads/allimg/20191011/1-1910111H10B58.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '小编', '169', '0', '', '0', '', '', '报名团购享优惠：1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。2.免费接机，免费看房，置业顾问全程陪同。3.购房成功可报销机票。4.参加团购可获更多优惠、特价房源等信息。融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自', '0.00', '0', '', '1', '100', '1', '0', '0', '1570785646', '1570785646', '0', '0', '0', '0', '', '1570785646', '1');
INSERT INTO `eju_archives` VALUES ('58', '17', '3', '10', '0', '雅居乐清水湾', '/uploads/allimg/20191011/1-1910111H231638.jpg', '0', '0', '0', '0', '0', '0', '0', '0', '小编', '173', '0', '', '0', '', '', '报名团购享优惠：1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。2.免费接机，免费看房，置业顾问全程陪同。3.购房成功可报销机票。4.参加团购可获更多优惠、特价房源等信息。融创观澜湖公园壹号（相册 动态 户型）为中国地产十强', '0.00', '0', '', '1', '100', '1', '0', '0', '1570785722', '1586765728', '21', '50', '0', '0', '', '1586765728', '1');
INSERT INTO `eju_archives` VALUES ('59', '0', '8', '6', '0', '关于我们', '', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '0', '', '0', '', '', '', '0.00', '0', '', '1', '100', '0', '0', '0', '1570786941', '0', '0', '0', '0', '0', '', '1570786941', '1');
INSERT INTO `eju_archives` VALUES ('60', '0', '9', '6', '0', '公司简介', '', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '0', '', '0', '', '', '', '0.00', '0', '', '1', '100', '0', '0', '0', '1570786951', '0', '0', '0', '0', '0', '', '1570786951', '1');
INSERT INTO `eju_archives` VALUES ('61', '0', '10', '11', '0', '招鑫公馆', '/uploads/allimg/20191029/1-1910291K310b7.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '招鑫公馆', '', '招鑫公馆项目位于海口市海甸岛东片开发区内，东临碧海大道，南临吉安花园小区，西临祥安小区，北邻天恒燕泰住宅楼及燕泰***际大酒店。项目用地总面积为12476.32㎡(建面)，建筑总面积33135.83㎡(建面)。项目主力户型为80.1-89.31㎡(建', '0.00', '0', '', '1', '100', '1', '0', '0', '1572342601', '1572578194', '21', '35', '0', '0', '', '1572342601', '1');
INSERT INTO `eju_archives` VALUES ('62', '0', '10', '11', '0', '长信蓝郡', '/uploads/allimg/20191029/1-1910291Q605a4.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '长信蓝郡', '', '长信·蓝郡位于海口市西海岸长秀片区，该项目占地约14万㎡(建面)，总建筑面积约50万㎡(建面)，项目分为西区与东区。小区交通便利，地理位置优越，环境甚佳，是理想的居住小区用地。本项目周边教育配套设施***，拥揽岛内一线教育资源（海口市教育幼儿园、海口', '0.00', '0', '', '1', '100', '1', '0', '0', '1572343433', '1572598720', '21', '35', '0', '0', '', '1572343433', '1');
INSERT INTO `eju_archives` VALUES ('63', '0', '10', '11', '0', '水岸珈蓝', '/uploads/allimg/20191029/1-1910291R014135.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '水岸珈蓝', '', '水岸珈蓝一梯两户，南北通透，三栋12层纯板楼。入户花园，飘窗，景观阳台，***层架空，院内生活共享！&nbsp;', '0.00', '0', '', '1', '100', '1', '0', '0', '1572343433', '1572578165', '21', '35', '0', '0', '', '1572343433', '1');
INSERT INTO `eju_archives` VALUES ('64', '0', '10', '11', '0', '洛杉矶城', '/uploads/allimg/20191029/1-1910291RR3402.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '洛杉矶城', '', '洛杉矶城位于新城市主轴滨海大道旁，毗邻海口新港码头，有***际一流的滨海景观及发达的道路交通系统，距美兰机场30车程，火车站15车程。总用地面积：15128.07平方米，建筑占地面积3452.5平方米，总建筑面积（地上）6244平方米，商铺建筑面积9', '0.00', '0', '', '1', '100', '1', '0', '0', '1572343433', '1572578217', '21', '35', '0', '0', '', '1572343433', '1');
INSERT INTO `eju_archives` VALUES ('65', '0', '10', '11', '0', '金外滩', '/uploads/allimg/20191029/1-1910291S12U10.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '金外滩', '', '金外滩，位于海口市丽晶路20号，东临杜鹃路，南靠滨海大道，西为丽晶路(景观大道)，北临琼洲海峡。金外滩由海南云通房地产开发有限公司开发建设，与广阔碧蓝的大海仅数步之遥。建筑设计特邀国际著名建筑设计单位NSIAP新建设计国际有限公司(新加坡)担纲设计，', '0.00', '0', '', '1', '100', '1', '0', '0', '1572343433', '1572578143', '21', '35', '0', '0', '', '1572343433', '1');
INSERT INTO `eju_archives` VALUES ('66', '0', '10', '11', '0', '泉海好家园', '/uploads/allimg/20191030/1-191030143S0S0.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '泉海好家园', '泉海好家园', '泉海好家园项目位于海口湾滨海沿线中央地带，丽晶路与港爱路交汇处——北眺琼洲海峡，东邻万绿园，南靠国贸CBD中心区，西临西秀海滩，都市繁华与滨海风情无缝连接，是海口中轴线板块与西海岸板块的黄金交汇点。这里不仅有1400亩城市绿肺万绿园及海口湾休闲滨海长', '0.00', '0', '', '1', '100', '1', '0', '0', '1572343433', '1572578132', '21', '35', '0', '0', '', '1572343433', '1');
INSERT INTO `eju_archives` VALUES ('67', '61', '11', '12', '0', '招鑫公馆2室 首付 28万 ', '/uploads/allimg/20191030/1-19103014510O16.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '招鑫公馆2室 首付 28万 业主置换', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576282', '1572576291', '21', '35', '0', '2', '', '1572576282', '1');
INSERT INTO `eju_archives` VALUES ('68', '62', '11', '12', '0', '长信蓝郡 3室 首付 48万 ', '/uploads/allimg/20191030/1-19103014551OL.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '长信蓝郡 3室 首付 48万 ', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576270', '1572576279', '21', '35', '0', '2', '', '1572576270', '1');
INSERT INTO `eju_archives` VALUES ('69', '63', '11', '12', '0', '水岸珈蓝 2室 首付 28万 ', '/uploads/allimg/20191030/1-191030145I5500.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '水岸珈蓝 2室 首付 28万 ', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576249', '1572576267', '21', '35', '0', '2', '', '1572576249', '1');
INSERT INTO `eju_archives` VALUES ('70', '64', '11', '12', '0', '洛杉矶城 2室 首付 32万 ', '/uploads/allimg/20191030/1-1910301500204R.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '洛杉矶城 2室 首付 32万 ', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576236', '1572576245', '21', '35', '0', '2', '', '1572576236', '1');
INSERT INTO `eju_archives` VALUES ('71', '65', '11', '12', '0', '金外滩 3室 首付 65万 ', '/uploads/allimg/20191030/1-191030150256238.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '金外滩 3室 首付 65万 ', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576221', '1572576233', '21', '35', '0', '2', '', '1572576221', '1');
INSERT INTO `eju_archives` VALUES ('72', '65', '11', '12', '0', '金外滩 2室 首付 28万 ', '/uploads/allimg/20191030/1-19103015045X57.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '金外滩 2室 首付 28万 ', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576191', '1572576216', '21', '35', '0', '2', '', '1572576191', '1');
INSERT INTO `eju_archives` VALUES ('73', '61', '12', '13', '0', '招鑫公馆 大两房 可年租 半年租', '/uploads/allimg/20191030/1-191030151U2E4.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '招鑫公馆 大两房 可年租 半年租', '', '招鑫公馆项目位于海口市海甸岛东片开发区内，东临碧海大道，南临吉安花园小区，西临祥安小区,北邻天恒燕泰住宅楼。项目用地总面积为12476.32平方米，建筑总面积33135.83平方米，容积率2.2，绿地率40%。项目周边片区居住氛围纯熟，学校、银行等生', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576682', '1572576695', '21', '35', '0', '2', '', '1572576682', '1');
INSERT INTO `eju_archives` VALUES ('74', '62', '12', '13', '0', '长信蓝郡 三房3500拎包入住', '/uploads/allimg/20191030/1-191030152I1N6.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '长信蓝郡 三房3500拎包入住', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576669', '1572576678', '21', '35', '0', '2', '', '1572576669', '1');
INSERT INTO `eju_archives` VALUES ('75', '63', '12', '13', '0', '水岸珈蓝 拎包入住', '/uploads/allimg/20191030/1-191030153005227.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '水岸珈蓝 拎包入住', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576713', '1572576725', '21', '35', '0', '2', '', '1572576713', '1');
INSERT INTO `eju_archives` VALUES ('76', '64', '12', '13', '0', '洛杉矶城 大两房 可年租 半年租', '/uploads/allimg/20191030/1-19103015305W27.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '洛杉矶城 大两房 可年租 半年租', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576733', '1572576744', '21', '35', '0', '2', '', '1572576733', '1');
INSERT INTO `eju_archives` VALUES ('77', '65', '12', '13', '0', '金外滩 三房装修出租5000元一个月', '/uploads/allimg/20191030/1-191030153313A4.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '金外滩 三房装修出租5000元一个月', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576634', '1572576645', '21', '35', '0', '2', '', '1572576634', '1');
INSERT INTO `eju_archives` VALUES ('78', '66', '12', '13', '0', '大两房 可年租 半年租', '/uploads/allimg/20191030/1-19103015344XK.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '', '0', '0', '', '0', '大两房 可年租 半年租', '', '小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错', '0.00', '0', '', '1', '100', '1', '0', '0', '1572576621', '1572576631', '21', '35', '0', '2', '', '1572576621', '1');
INSERT INTO `eju_archives` VALUES ('83', '0', '11', '12', '0', '第一个会员房源', '/uploads/allimg/20200415/1-20041510101M40.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '程序猿', '0', '0', '', '0', '', '', '', '0.00', '0', '', '1', '100', '0', '0', '0', '1586916619', '1586916619', '21', '35', '0', '3', '', '1586916619', '1');
INSERT INTO `eju_archives` VALUES ('84', '0', '12', '13', '0', '第一个会员房源', '/uploads/allimg/20200415/1-20041510103R05.jpg', '0', '0', '0', '0', '0', '1', '0', '0', '程序猿', '0', '0', '', '0', '', '', '', '0.00', '0', '', '1', '100', '0', '0', '0', '1586916639', '1586916639', '21', '35', '0', '3', '', '1586916639', '1');

-- -----------------------------
-- Table structure for `eju_arcmulti`
-- -----------------------------
DROP TABLE IF EXISTS `eju_arcmulti`;
CREATE TABLE `eju_arcmulti` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tagid` varchar(60) NOT NULL DEFAULT '' COMMENT '标签ID',
  `tagname` varchar(60) NOT NULL DEFAULT '' COMMENT '标签名',
  `innertext` text NOT NULL COMMENT '标签模板代码',
  `pagesize` int(10) NOT NULL DEFAULT '0' COMMENT '分页列表',
  `querysql` text NOT NULL COMMENT '完整SQL',
  `ordersql` varchar(200) DEFAULT '' COMMENT '排序SQL',
  `addfieldsSql` varchar(255) DEFAULT '' COMMENT '附加字段SQL',
  `addtableName` varchar(50) DEFAULT '' COMMENT '附加字段的数据表，不包含表前缀',
  `attstr` text COMMENT '属性字符串',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `tagid` (`tagid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='多页标记存储数据表';

-- -----------------------------
-- Records of `eju_arcmulti`
-- -----------------------------
INSERT INTO `eju_arcmulti` VALUES ('1', 'lists0003_29dde42bf4d11a26a7ed98a3bb8dbdc6', 'arclist', '', '10', 'SELECT `b`.*,`c`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_xinfang_system` `c` ON `c`.`aid`=`a`.`aid` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  city_id = \'35\' AND a.typeid IN (1) AND a.channel IN (9) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:9:{s:5:\\\"tagid\\\";s:9:\\\"lists0003\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:1:\\\"1\\\";s:9:\\\"channelid\\\";s:1:\\\"9\\\";}', '1570790709', '1570791569');
INSERT INTO `eju_arcmulti` VALUES ('2', 'lists0002_297394be0208380e6e6251d0c2bb0f46', 'arclist', '', '5', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (2,4,5,6,7) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 5', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0002\\\";s:3:\\\"row\\\";s:1:\\\"5\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:9:\\\"2,4,5,6,7\\\";s:9:\\\"channelid\\\";s:1:\\\"1\\\";}', '1570790806', '1570832680');
INSERT INTO `eju_arcmulti` VALUES ('3', 'lists0001_c6c9982a2a31ba203954daa8c4689088', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (5) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"5\\\";s:9:\\\"channelid\\\";s:1:\\\"1\\\";}', '1570790809', '1570790809');
INSERT INTO `eju_arcmulti` VALUES ('4', 'lists0001_163370fa3390e1b3c32bc0b363e2413b', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (6) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"6\\\";s:9:\\\"channelid\\\";s:1:\\\"1\\\";}', '1570790810', '1570790810');
INSERT INTO `eju_arcmulti` VALUES ('5', 'lists0001_6fd74958d4a07e5f7d0f89ab00ea5ba8', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (7) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"7\\\";s:9:\\\"channelid\\\";s:1:\\\"1\\\";}', '1570790811', '1570790811');
INSERT INTO `eju_arcmulti` VALUES ('6', 'lists0003_1ca39597432ce504e13de2d5a671ee5a', 'arclist', '', '10', 'SELECT `b`.*,`c`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_xinfang_system` `c` ON `c`.`aid`=`a`.`aid` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  average_price between 0 and 6000  AND a.typeid IN (1) AND a.channel IN (9) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:9:{s:5:\\\"tagid\\\";s:9:\\\"lists0003\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:1:\\\"1\\\";s:9:\\\"channelid\\\";i:9;}', '1571018755', '1572837050');
INSERT INTO `eju_arcmulti` VALUES ('7', 'lists0002_796eda4a2d7d78553db5e05ea08e255b', 'arclist', '', '5', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (2,4,5,6,7) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 5', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0002\\\";s:3:\\\"row\\\";s:1:\\\"5\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:9:\\\"2,4,5,6,7\\\";s:9:\\\"channelid\\\";i:1;}', '1571021361', '1572849185');
INSERT INTO `eju_arcmulti` VALUES ('8', 'lists0001_96d1c639affc11e0471c8c25d34861bb', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (6) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"6\\\";s:9:\\\"channelid\\\";i:1;}', '1571102892', '1572800908');
INSERT INTO `eju_arcmulti` VALUES ('9', 'lists0001_2a7740d389b98749b5a7f96c1e0749fa', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (5) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"5\\\";s:9:\\\"channelid\\\";i:1;}', '1571120972', '1572811404');
INSERT INTO `eju_arcmulti` VALUES ('10', 'lists0001_055b612d32e75843628e6c9fbfe79d4f', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (7) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"7\\\";s:9:\\\"channelid\\\";i:1;}', '1571551454', '1572799409');
INSERT INTO `eju_arcmulti` VALUES ('11', 'lists0001_f13f79aa423e93afc4455074396d6447', 'arclist', '', '10', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (4) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:6:{s:5:\\\"tagid\\\";s:9:\\\"lists0001\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:1:\\\"4\\\";s:9:\\\"channelid\\\";i:1;}', '1571551460', '1572738811');
INSERT INTO `eju_arcmulti` VALUES ('12', 'lists0004_8aa1105061bfdae9166b4fcb95d7cb26', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_xiaoqu_system` `c` ON `a`.`aid`=`c`.`aid` WHERE  (  a.typeid IN (10) AND a.channel IN (11) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:9:{s:5:\\\"tagid\\\";s:9:\\\"lists0004\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:2:\\\"10\\\";s:9:\\\"channelid\\\";i:11;}', '1572342375', '1572853811');
INSERT INTO `eju_arcmulti` VALUES ('13', 'lists0005_241f2121b41d1d73664a49c855b168a4', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_ershou_system` `c` ON `a`.`aid`=`c`.`aid` LEFT JOIN `eju_ershou_content` `d` ON `a`.`aid`=`d`.`aid` WHERE  (  (FIND_IN_SET(\'100万-120万\',diy_junjia)) AND a.typeid IN (11) AND a.channel IN (12) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:9:{s:5:\\\"tagid\\\";s:9:\\\"lists0005\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:2:\\\"11\\\";s:9:\\\"channelid\\\";i:12;}', '1572342440', '1572851572');
INSERT INTO `eju_arcmulti` VALUES ('14', 'lists0006_d01a822c525c09ab470cf444200b4124', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_zufang_system` `c` ON `a`.`aid`=`c`.`aid` LEFT JOIN `eju_zufang_content` `d` ON `a`.`aid`=`d`.`aid` WHERE  (  (FIND_IN_SET(\'1000元以下\',diy_junjia)) AND a.typeid IN (12) AND a.channel IN (13) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 ) ORDER BY a.add_time desc LIMIT 10', 'a.add_time desc', '', '', 'a:9:{s:5:\\\"tagid\\\";s:9:\\\"lists0006\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:2:\\\"12\\\";s:9:\\\"channelid\\\";i:13;}', '1572342444', '1572851565');
INSERT INTO `eju_arcmulti` VALUES ('15', 'lists0003_cd5439a779ce17eb35c7eab4db84c238', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_xinfang_system` `c` ON `a`.`aid`=`c`.`aid` WHERE  (  a.typeid IN (1) AND a.channel IN (9) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 AND a.add_type = 1 ) ORDER BY a.show_time desc LIMIT 10', 'a.show_time desc', '', '', 'a:8:{s:5:\\\"tagid\\\";s:9:\\\"lists0003\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:1:\\\"1\\\";}', '1586916708', '1586916708');
INSERT INTO `eju_arcmulti` VALUES ('16', 'lists0002_0bd70f6f61588546be84ff1134aa97db', 'arclist', '', '5', 'SELECT `b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` WHERE  (  a.typeid IN (2,4,5,6,7) AND a.channel IN (1) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 AND a.add_type = 1 ) ORDER BY a.show_time desc LIMIT 5', 'a.show_time desc', '', '', 'a:5:{s:5:\\\"tagid\\\";s:9:\\\"lists0002\\\";s:3:\\\"row\\\";s:1:\\\"5\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:6:\\\"typeid\\\";s:9:\\\"2,4,5,6,7\\\";}', '1586916838', '1586916838');
INSERT INTO `eju_arcmulti` VALUES ('17', 'lists0004_4221937884c21c9db783fcafaf696b07', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_xiaoqu_system` `c` ON `a`.`aid`=`c`.`aid` WHERE  (  a.typeid IN (10) AND a.channel IN (11) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 AND a.add_type = 1 ) ORDER BY a.show_time desc LIMIT 10', 'a.show_time desc', '', '', 'a:8:{s:5:\\\"tagid\\\";s:9:\\\"lists0004\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:2:\\\"10\\\";}', '1586916852', '1586916852');
INSERT INTO `eju_arcmulti` VALUES ('18', 'lists0005_a49039c26b92d4778e9843efe6a9c2dc', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_ershou_system` `c` ON `a`.`aid`=`c`.`aid` WHERE  (  a.typeid IN (11) AND a.channel IN (12) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 AND a.add_type = 1 ) ORDER BY a.show_time desc LIMIT 10', 'a.show_time desc', '', '', 'a:8:{s:5:\\\"tagid\\\";s:9:\\\"lists0005\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:2:\\\"11\\\";}', '1586916862', '1586916862');
INSERT INTO `eju_arcmulti` VALUES ('19', 'lists0006_45094d4c1551bfd0d08c50663b2e129e', 'arclist', '', '10', 'SELECT `c`.*,`b`.*,`a`.* FROM `eju_archives` `a` LEFT JOIN `eju_arctype` `b` ON `b`.`id`=`a`.`typeid` LEFT JOIN `eju_zufang_system` `c` ON `a`.`aid`=`c`.`aid` WHERE  (  a.typeid IN (12) AND a.channel IN (13) AND a.arcrank > -1 AND a.status = 1 AND a.is_del = 0 AND a.add_type = 1 ) ORDER BY a.show_time desc LIMIT 10', 'a.show_time desc', '', '', 'a:8:{s:5:\\\"tagid\\\";s:9:\\\"lists0006\\\";s:3:\\\"row\\\";s:2:\\\"10\\\";s:3:\\\"key\\\";s:1:\\\"n\\\";s:8:\\\"titlelen\\\";s:2:\\\"30\\\";s:7:\\\"infolen\\\";s:3:\\\"160\\\";s:7:\\\"orderby\\\";s:3:\\\"new\\\";s:2:\\\"id\\\";s:5:\\\"field\\\";s:6:\\\"typeid\\\";s:2:\\\"12\\\";}', '1586916870', '1586916870');

-- -----------------------------
-- Table structure for `eju_arcrank`
-- -----------------------------
DROP TABLE IF EXISTS `eju_arcrank`;
CREATE TABLE `eju_arcrank` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `rank` smallint(6) DEFAULT '0' COMMENT '权限值',
  `name` char(20) DEFAULT '' COMMENT '会员名称',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文档阅读权限表';

-- -----------------------------
-- Records of `eju_arcrank`
-- -----------------------------
INSERT INTO `eju_arcrank` VALUES ('1', '0', '开放浏览', '0', '1552376880');
INSERT INTO `eju_arcrank` VALUES ('2', '-1', '待审核稿件', '0', '1552376880');

-- -----------------------------
-- Table structure for `eju_arctype`
-- -----------------------------
DROP TABLE IF EXISTS `eju_arctype`;
CREATE TABLE `eju_arctype` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `channeltype` int(10) DEFAULT '0' COMMENT '栏目顶级模型ID',
  `current_channel` int(10) DEFAULT '0' COMMENT '栏目当前模型ID',
  `parent_id` int(10) DEFAULT '0' COMMENT '栏目上级ID',
  `pointto_id` int(10) unsigned DEFAULT '0',
  `typename` varchar(200) DEFAULT '' COMMENT '栏目名称',
  `dirname` varchar(200) DEFAULT '' COMMENT '目录英文名',
  `dirpath` varchar(200) DEFAULT '' COMMENT '目录存放HTML路径',
  `englist_name` varchar(200) DEFAULT '' COMMENT '栏目英文名',
  `grade` tinyint(1) DEFAULT '0' COMMENT '栏目等级',
  `typelink` varchar(200) DEFAULT '' COMMENT '栏目链接',
  `litpic` varchar(250) DEFAULT '' COMMENT '栏目图片',
  `templist` varchar(200) DEFAULT '' COMMENT '列表模板文件名',
  `tempview` varchar(200) DEFAULT '' COMMENT '文档模板文件名',
  `seo_title` varchar(200) DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(200) DEFAULT '' COMMENT 'seo关键字',
  `seo_description` text COMMENT 'seo描述',
  `sort_order` int(10) DEFAULT '0' COMMENT '排序号',
  `is_hidden` tinyint(1) DEFAULT '0' COMMENT '是否隐藏栏目：0=显示，1=隐藏',
  `is_part` tinyint(1) DEFAULT '0' COMMENT '栏目属性：0=内容栏目，1=外部链接',
  `admin_id` int(10) DEFAULT '0' COMMENT '管理员ID',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `del_method` tinyint(1) DEFAULT '0' COMMENT '伪删除状态，1为主动删除，2为跟随上级栏目被动删除',
  `status` tinyint(1) DEFAULT '1' COMMENT '启用 (1=正常，0=屏蔽)',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dirname` (`dirname`) USING BTREE,
  KEY `parent_id` (`channeltype`,`parent_id`) USING BTREE,
  KEY `parent_id_2` (`parent_id`,`sort_order`,`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文档栏目表';

-- -----------------------------
-- Records of `eju_arctype`
-- -----------------------------
INSERT INTO `eju_arctype` VALUES ('1', '9', '9', '0', '0', '新房', 'xinfang', '/xinfang', '', '0', '', '', 'lists_xinfang.htm', 'view_xinfang.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765903', '1570765903');
INSERT INTO `eju_arctype` VALUES ('2', '1', '1', '0', '0', '楼市', 'loushi', '/loushi', '', '0', '', '', 'lists_article_list.htm', 'view_article.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765913', '1570780318');
INSERT INTO `eju_arctype` VALUES ('3', '9', '10', '0', '0', '团购', 'tuangou', '/tuangou', '', '0', '', '', 'lists_tuan.htm', 'view_tuan.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765919', '1570765926');
INSERT INTO `eju_arctype` VALUES ('4', '1', '1', '2', '0', '楼盘动态', 'loupandongtai', '/loushi/loupandongtai', '', '1', '', '', 'lists_article.htm', 'view_article.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765964', '1570780318');
INSERT INTO `eju_arctype` VALUES ('5', '1', '1', '2', '0', '购房指南', 'goufangzhinan', '/loushi/goufangzhinan', '', '1', '', '', 'lists_article.htm', 'view_article.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765971', '1570780318');
INSERT INTO `eju_arctype` VALUES ('6', '1', '1', '2', '0', '本地资讯', 'bendizixun', '/loushi/bendizixun', '', '1', '', '', 'lists_article.htm', 'view_article.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765978', '1570780318');
INSERT INTO `eju_arctype` VALUES ('7', '1', '1', '2', '0', '楼盘导购 ', 'loupandaogou', '/loushi/loupandaogou', '', '1', '', '', 'lists_article.htm', 'view_article.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570765984', '1570780318');
INSERT INTO `eju_arctype` VALUES ('8', '6', '6', '0', '0', '关于我们', 'guanyuwomen', '/guanyuwomen', '', '0', '', '', 'lists_single.htm', '', '', '', '', '100', '1', '0', '1', '0', '0', '1', '1570786941', '1570787003');
INSERT INTO `eju_arctype` VALUES ('9', '6', '6', '8', '0', '公司简介', 'gongsijianjie', '/guanyuwomen/gongsijianjie', '', '1', '', '', 'lists_single.htm', '', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1570786951', '1570786951');
INSERT INTO `eju_arctype` VALUES ('10', '11', '11', '0', '0', '小区', 'xiaoqu', '/xiaoqu', '', '0', '', '', 'lists_xiaoqu.htm', 'view_xiaoqu.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1572342368', '1572342368');
INSERT INTO `eju_arctype` VALUES ('11', '12', '12', '0', '0', '二手房', 'ershoufang', '/ershoufang', '', '0', '', '', 'lists_ershou.htm', 'view_ershou.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1572342383', '1572342383');
INSERT INTO `eju_arctype` VALUES ('12', '13', '13', '0', '0', '租房', 'zufang', '/zufang', '', '0', '', '', 'lists_zufang.htm', 'view_zufang.htm', '', '', '', '100', '0', '0', '1', '0', '0', '1', '1572342393', '1572342393');
INSERT INTO `eju_arctype` VALUES ('13', '-1', '-1', '0', '0', '问答', '', '', '', '0', '/index.php?m=home&c=Ask&a=index', '', '', '', '', '', '', '100', '0', '1', '-1', '0', '0', '1', '1577088124', '1577088124');

-- -----------------------------
-- Table structure for `eju_article_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_article_content`;
CREATE TABLE `eju_article_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `content` longtext COMMENT '内容详情',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `description` text COMMENT '简介',
  `come_from` varchar(200) NOT NULL DEFAULT '' COMMENT '来源',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='楼市资讯表';

-- -----------------------------
-- Records of `eju_article_content`
-- -----------------------------
INSERT INTO `eju_article_content` VALUES ('1', '19', '&lt;p&gt;绿地集团混改事业再下一城。&lt;/p&gt;&lt;p&gt;　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股，绿地持股70%（收购60%老股+增资10%）、贵州黔晟持股30%。&lt;/p&gt;&lt;p&gt;　　资料显示，贵州药材和贵州药业公司均系贵州黔晟二级子公司，为“一套班子、两块牌子”运营，两家公司同时进行混改。目前，贵州药业公司已通过非主业资产剥离，整体划拨至贵州药材名下，成为贵州药材全资子公司。&lt;/p&gt;&lt;p&gt;　　据了解，此次战略重组贵州药材，系绿地集团在大健康领域的首单混改项目。下一步，绿地将复制“绿地混改”模式，将部分股权转让给贵州药材管理团队及核心员工，实现由绿地控股、贵州黔晟、管理团队及核心员工共同持股的三元结构。&lt;/p&gt;&lt;p&gt;　　收购与增资扩股并行&lt;/p&gt;&lt;p&gt;　　通过此次战略重组，绿地与贵州黔晟聚焦“大健康”整合资源，结合中医中药、旅游度假等特色产业，共同打造贵州省中药材行业新的投资、管理平台和龙头企业。&lt;/p&gt;&lt;p&gt;　　绿地控股董事长、总裁张玉良指出：“参与贵州药材混改，是‘绿地混改’在大健康领域的首单，也是继贵州建工后，再度参与贵州省国资国企改革。绿地康养产业在大健康关键资源领域实现了布局，构筑资源优势，完善大健康产业链，强化核心竞争力。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　“贵州药材未来将实现道地中药材种植、产地初加工、饮片炮制、有效成分提取、成药制造、保健品和饮品开发全产业链布局，成为行业领军企业，打造绿地独有的中医药健康服务品牌IP，成为绿地特色康养产业的重要支撑之一。力争通过3年发展，贵州药材实现营业收入16亿元，利润2.4亿元，还将通过品牌输出、轻资产等方式，推动贵州医疗产业、养老产业、健康管理产业快速发展。”张玉良补充道。&lt;/p&gt;&lt;p&gt;　　公开资料显示，贵州药材成立于1994年，主营业务为中药材流通，为中药材产业链后端。贵州药业成立于2017年，主营业务为中药材种苗繁育、种植、研发、加工、收储等，为中药材产业链中、前端，已在贵州省投资建设两个中药材基地。&lt;/p&gt;&lt;p&gt;　　地产+中药纳入康养产业集团&lt;/p&gt;&lt;p&gt;　　相比其他“地产+养老”模式，绿地集团将贵州药材纳入康养产业集团体系，实现了产业与资本的协同。&lt;/p&gt;&lt;p&gt;　　根据绿地集团的规划，中医板块将与绿地旗下的综合性医疗机构、中高端养老社区全面协同，丰富绿地医康养产业资源、完善产业链条，打造新型医疗养老产业平台。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　另外，绿地集团利用现代化科技手段，助力贵州药材发展成为集科技、研发、育苗、流通为一体的现代化医药企业。以贵州为枢纽，依托绿地各产业板块“一带一路”沿线的布局，推动中医药业走出去。&lt;/p&gt;&lt;p&gt;　　近年来，绿地支持贵州省产业升级发展的脚步进一步加快，在国企混改、地产开发、精准扶贫、康养产业、金融生态建设等领域取得了进展。绿地集团通过挖掘贵州在大健康领域的独特优势，使得旗下康养产业在贵州布局持续升级。绿地在贵州打造的优先连锁康养旅居酒店——贵阳绿地新都会康养居酒店2018年年底已开业，遵义绿地康养居酒店正在快速建设中。&lt;/p&gt;&lt;p&gt;　　据了解，绿地康养产业正以康养居为代表的旅居养老产业为核心，以康养谷和康养社区为支撑，依托会员制核心圈层，结合物联网、大数据、移动互联等技术，构建“动静相宜”的综合康养体系。未来还将不断通过资本运作、收并购等方式，衍生发展医疗服务、中医中药、养老科技等相关领域，打造覆盖康养产业链上下游、全龄段的大健康产业生态体系。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570779718', '1570779718', '', '');
INSERT INTO `eju_article_content` VALUES ('3', '21', '&lt;p&gt;绿地集团混改事业再下一城。&lt;/p&gt;&lt;p&gt;　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股，绿地持股70%（收购60%老股+增资10%）、贵州黔晟持股30%。&lt;/p&gt;&lt;p&gt;　　资料显示，贵州药材和贵州药业公司均系贵州黔晟二级子公司，为“一套班子、两块牌子”运营，两家公司同时进行混改。目前，贵州药业公司已通过非主业资产剥离，整体划拨至贵州药材名下，成为贵州药材全资子公司。&lt;/p&gt;&lt;p&gt;　　据了解，此次战略重组贵州药材，系绿地集团在大健康领域的首单混改项目。下一步，绿地将复制“绿地混改”模式，将部分股权转让给贵州药材管理团队及核心员工，实现由绿地控股、贵州黔晟、管理团队及核心员工共同持股的三元结构。&lt;/p&gt;&lt;p&gt;　　收购与增资扩股并行&lt;/p&gt;&lt;p&gt;　　通过此次战略重组，绿地与贵州黔晟聚焦“大健康”整合资源，结合中医中药、旅游度假等特色产业，共同打造贵州省中药材行业新的投资、管理平台和龙头企业。&lt;/p&gt;&lt;p&gt;　　绿地控股董事长、总裁张玉良指出：“参与贵州药材混改，是‘绿地混改’在大健康领域的首单，也是继贵州建工后，再度参与贵州省国资国企改革。绿地康养产业在大健康关键资源领域实现了布局，构筑资源优势，完善大健康产业链，强化核心竞争力。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　“贵州药材未来将实现道地中药材种植、产地初加工、饮片炮制、有效成分提取、成药制造、保健品和饮品开发全产业链布局，成为行业领军企业，打造绿地独有的中医药健康服务品牌IP，成为绿地特色康养产业的重要支撑之一。力争通过3年发展，贵州药材实现营业收入16亿元，利润2.4亿元，还将通过品牌输出、轻资产等方式，推动贵州医疗产业、养老产业、健康管理产业快速发展。”张玉良补充道。&lt;/p&gt;&lt;p&gt;　　公开资料显示，贵州药材成立于1994年，主营业务为中药材流通，为中药材产业链后端。贵州药业成立于2017年，主营业务为中药材种苗繁育、种植、研发、加工、收储等，为中药材产业链中、前端，已在贵州省投资建设两个中药材基地。&lt;/p&gt;&lt;p&gt;　　地产+中药纳入康养产业集团&lt;/p&gt;&lt;p&gt;　　相比其他“地产+养老”模式，绿地集团将贵州药材纳入康养产业集团体系，实现了产业与资本的协同。&lt;/p&gt;&lt;p&gt;　　根据绿地集团的规划，中医板块将与绿地旗下的综合性医疗机构、中高端养老社区全面协同，丰富绿地医康养产业资源、完善产业链条，打造新型医疗养老产业平台。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　另外，绿地集团利用现代化科技手段，助力贵州药材发展成为集科技、研发、育苗、流通为一体的现代化医药企业。以贵州为枢纽，依托绿地各产业板块“一带一路”沿线的布局，推动中医药业走出去。&lt;/p&gt;&lt;p&gt;　　近年来，绿地支持贵州省产业升级发展的脚步进一步加快，在国企混改、地产开发、精准扶贫、康养产业、金融生态建设等领域取得了进展。绿地集团通过挖掘贵州在大健康领域的独特优势，使得旗下康养产业在贵州布局持续升级。绿地在贵州打造的优先连锁康养旅居酒店——贵阳绿地新都会康养居酒店2018年年底已开业，遵义绿地康养居酒店正在快速建设中。&lt;/p&gt;&lt;p&gt;　　据了解，绿地康养产业正以康养居为代表的旅居养老产业为核心，以康养谷和康养社区为支撑，依托会员制核心圈层，结合物联网、大数据、移动互联等技术，构建“动静相宜”的综合康养体系。未来还将不断通过资本运作、收并购等方式，衍生发展医疗服务、中医中药、养老科技等相关领域，打造覆盖康养产业链上下游、全龄段的大健康产业生态体系。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570779639', '1570779639', '', '');
INSERT INTO `eju_article_content` VALUES ('2', '20', '&lt;p&gt;中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;户口&lt;/p&gt;&lt;p&gt;——放开放宽除个别超大城市外的城市落户限制&lt;/p&gt;&lt;p&gt;《意见》设定了“到2022年城市落户限制逐步消除”的目标，并要求“有力有序有效深化户籍制度改革，放开放宽除个别超大城市外的城市落户限制”。&lt;/p&gt;&lt;p&gt;数据显示，截至2018底，仍有2.26亿已成为城镇常住人口但尚未落户城市的农业转移人口，其中65%分布在地级以上的城市，基本上是大城市。因此，需要推动大中小城市放开放宽落户限制。&lt;/p&gt;&lt;p&gt;根据发改委今年4月份发布的《2019年新型城镇化建设重点任务》，城区常住人口100万—300万的II型大城市要全面取消落户限制；城区常住人口300万—500万的I型大城市要全面放开放宽落户条件，并全面取消重点群体落户限制。超大特大城市要调整完善积分落户政策，大幅增加落户规模、精简积分项目，确保社保缴纳年限和居住年限分数占主要比例。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;5月6日，国家发改委召开专题新闻发布会，介绍关于建立健全城乡融合发展体制机制和政策体系有关情况，并回答记者提问。&lt;/p&gt;&lt;p&gt;哪些人是重点群体？发改委规划司司长陈亚军6日表示，解决农民工的落户问题首先是坚持存量优先、带动增量的原则。存量优先就是指已经在城市长期就业、工作、居住的这部分农业转移人口，特别是举家迁徙的，还有新生代农民工，以及农村学生升学和参军进入城镇的人口。&lt;/p&gt;&lt;p&gt;“这些重点人群才是落户的重点，而不是说片面的去抢人才。城市需要人才，但是更需要不同层次的人口，绝不能搞选择性落户。”陈亚军说。&lt;/p&gt;&lt;p&gt;清华大学政治经济学研究中心主任蔡继明认为，户籍制度改革要惠及各个阶层，不能搞选择性改革，只盯住所谓高端人才。要把已在城镇就业的农业转移人口作为重点落户群体。&lt;/p&gt;&lt;p&gt;“放宽落户不等于放松对房地产的调控。”陈亚军表示，“房子是用来住的，不是用来炒的”这个定位是必须坚持、不能动摇的。同时，消除城市落户的限制并不是放弃对人口的因城施策。&lt;/p&gt;&lt;p&gt;陈亚军指出，超大城市、特大城市要更多的通过优化积分落户的政策来调控人口，既要留下愿意来城市发展、能为城市做出贡献的人口，又要立足城市功能定位，防止无序的蔓延。个别的超大城市、特大城市还是要严格把握好人口总量控制的这条线，合理疏解中心城区非核心功能，引导人口合理的流动和分布，防止“大城市病”的发生。　&lt;/p&gt;&lt;p&gt;土地&lt;/p&gt;&lt;p&gt;——闲置宅基地可转为集体经营性建设用地入市&lt;/p&gt;&lt;p&gt;《意见》提出了农村土地制度改革的若干举措，包括三大方面：改革完善农村承包地制度、稳慎改革农村宅基地制度、建立集体经营性建设用地入市制度。&lt;/p&gt;&lt;p&gt;在改革完善农村承包地制度方面，保持农村土地承包关系稳定并长久不变，落实第二轮土地承包到期后再延长30年政策。加快完成农村承包地确权登记颁证。&lt;/p&gt;&lt;p&gt;在稳慎改革农村宅基地制度方面，适度放活宅基地和农民房屋使用权。鼓励农村集体经济组织及其成员盘活利用闲置宅基地和闲置房屋。&lt;/p&gt;&lt;p&gt;在建立集体经营性建设用地入市制度方面，允许村集体在农民自愿前提下，依法把有偿收回的闲置宅基地、废弃的集体公益性建设用地转变为集体经营性建设用地入市。&lt;/p&gt;&lt;p&gt;发改委规划司城乡融合发展处处长刘春雨表示，需要注意的是城里人到农村买宅基地的口子不能开，按规划严格实行土地用途管制的原则不能突破，严格禁止下乡利用农村宅基地建设别墅大院和私人会馆。&lt;/p&gt;&lt;p&gt;刘春雨指出，要严格守住土地所有制的性质不改变、耕地红线不突破、农民利益不受损，不能把集体所有制改没了、耕地改少了、农民利益受损了。要以维护农民的基本权益为底线，绝不能代替农民作主，不能强迫农民选择，要真正让农民得到改革的红利。&lt;/p&gt;&lt;p&gt;收入&lt;/p&gt;&lt;p&gt;——统筹提高四个方面收入&lt;/p&gt;&lt;p&gt;国家统计局数据显示，2018年城镇居民人均可支配收入39251元，农村居民人均可支配收入14617元。城乡居民人均收入倍差2.69，比上年缩小0.02。&lt;/p&gt;&lt;p&gt;陈亚军说，虽然城乡居民收入比从较高点的2007年3.14倍，持续下降到2012年的2.88倍，进而下降到2018年的2.69倍，但近几年的缩小幅度逐渐收窄，农民持续增收面临比较大的挑战。&lt;/p&gt;&lt;p&gt;如何真正实现让农民富起来，农民的“钱袋子”鼓起来？为此，《意见》提出，拓宽农民增收渠道，促进农民收入持续增长，持续缩小城乡居民生活水平差距。统筹提高农民的工资性、经营性、财产性、转移性四个方面的收入。&lt;/p&gt;&lt;p&gt;在工资性收入方面，《意见》提出，规范招工用人制度，消除一切就业歧视，健全农民工劳动权益保护机制，落实农民工与城镇职工平等就业制度。健全城乡均等的公共就业创业服务制度，努力增加就业岗位和创业机会。&lt;/p&gt;&lt;p&gt;在经营性收入方面，刘春雨表示，既要完善财政、信贷、保险、用地等政策，降低农业成本、提高农业收入；又要提高职业农民技能，培育发展新型农业经营主体，统筹提高农业效益和农民收入。&lt;/p&gt;&lt;p&gt;在财产性收入方面，刘春雨表示，要以市场化改革为导向，推动农村集体产权制度改革，加快完成农村集体资产的清产核资，并且把经营性资产量化到集体成员，提高农民财产性收入，推动农村资源变资产、资金变股金、农民变股东。&lt;/p&gt;&lt;p&gt;在转移性收入方面，《意见》提出，完善对农民直接补贴政策，健全生产者补贴制度，逐步扩大覆盖范围。在统筹整合涉农资金基础上，探索建立普惠性农民补贴长效机制。&lt;/p&gt;&lt;div&gt;&lt;br/&gt;&lt;/div&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570779707', '1570779707', '', '');
INSERT INTO `eju_article_content` VALUES ('4', '22', '&lt;p&gt;绿地集团混改事业再下一城。&lt;/p&gt;&lt;p&gt;　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股，绿地持股70%（收购60%老股+增资10%）、贵州黔晟持股30%。&lt;/p&gt;&lt;p&gt;　　资料显示，贵州药材和贵州药业公司均系贵州黔晟二级子公司，为“一套班子、两块牌子”运营，两家公司同时进行混改。目前，贵州药业公司已通过非主业资产剥离，整体划拨至贵州药材名下，成为贵州药材全资子公司。&lt;/p&gt;&lt;p&gt;　　据了解，此次战略重组贵州药材，系绿地集团在大健康领域的首单混改项目。下一步，绿地将复制“绿地混改”模式，将部分股权转让给贵州药材管理团队及核心员工，实现由绿地控股、贵州黔晟、管理团队及核心员工共同持股的三元结构。&lt;/p&gt;&lt;p&gt;　　收购与增资扩股并行&lt;/p&gt;&lt;p&gt;　　通过此次战略重组，绿地与贵州黔晟聚焦“大健康”整合资源，结合中医中药、旅游度假等特色产业，共同打造贵州省中药材行业新的投资、管理平台和龙头企业。&lt;/p&gt;&lt;p&gt;　　绿地控股董事长、总裁张玉良指出：“参与贵州药材混改，是‘绿地混改’在大健康领域的首单，也是继贵州建工后，再度参与贵州省国资国企改革。绿地康养产业在大健康关键资源领域实现了布局，构筑资源优势，完善大健康产业链，强化核心竞争力。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　“贵州药材未来将实现道地中药材种植、产地初加工、饮片炮制、有效成分提取、成药制造、保健品和饮品开发全产业链布局，成为行业领军企业，打造绿地独有的中医药健康服务品牌IP，成为绿地特色康养产业的重要支撑之一。力争通过3年发展，贵州药材实现营业收入16亿元，利润2.4亿元，还将通过品牌输出、轻资产等方式，推动贵州医疗产业、养老产业、健康管理产业快速发展。”张玉良补充道。&lt;/p&gt;&lt;p&gt;　　公开资料显示，贵州药材成立于1994年，主营业务为中药材流通，为中药材产业链后端。贵州药业成立于2017年，主营业务为中药材种苗繁育、种植、研发、加工、收储等，为中药材产业链中、前端，已在贵州省投资建设两个中药材基地。&lt;/p&gt;&lt;p&gt;　　地产+中药纳入康养产业集团&lt;/p&gt;&lt;p&gt;　　相比其他“地产+养老”模式，绿地集团将贵州药材纳入康养产业集团体系，实现了产业与资本的协同。&lt;/p&gt;&lt;p&gt;　　根据绿地集团的规划，中医板块将与绿地旗下的综合性医疗机构、中高端养老社区全面协同，丰富绿地医康养产业资源、完善产业链条，打造新型医疗养老产业平台。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　另外，绿地集团利用现代化科技手段，助力贵州药材发展成为集科技、研发、育苗、流通为一体的现代化医药企业。以贵州为枢纽，依托绿地各产业板块“一带一路”沿线的布局，推动中医药业走出去。&lt;/p&gt;&lt;p&gt;　　近年来，绿地支持贵州省产业升级发展的脚步进一步加快，在国企混改、地产开发、精准扶贫、康养产业、金融生态建设等领域取得了进展。绿地集团通过挖掘贵州在大健康领域的独特优势，使得旗下康养产业在贵州布局持续升级。绿地在贵州打造的优先连锁康养旅居酒店——贵阳绿地新都会康养居酒店2018年年底已开业，遵义绿地康养居酒店正在快速建设中。&lt;/p&gt;&lt;p&gt;　　据了解，绿地康养产业正以康养居为代表的旅居养老产业为核心，以康养谷和康养社区为支撑，依托会员制核心圈层，结合物联网、大数据、移动互联等技术，构建“动静相宜”的综合康养体系。未来还将不断通过资本运作、收并购等方式，衍生发展医疗服务、中医中药、养老科技等相关领域，打造覆盖康养产业链上下游、全龄段的大健康产业生态体系。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570779763', '1570779763', '', '');
INSERT INTO `eju_article_content` VALUES ('5', '23', '&lt;p&gt;绿地集团混改事业再下一城。&lt;/p&gt;&lt;p&gt;　　5月27日，绿地控股与贵州省黔晟国有资产经营有限责任公司（下称“贵州黔晟”， 系贵州省国资平台）签署贵州省药材有限责任公司（简称“贵州药材”）战略重组协议，绿地集团通过“股权收购+增资扩股”相结合的方式实现对贵州药材控股，绿地持股70%（收购60%老股+增资10%）、贵州黔晟持股30%。&lt;/p&gt;&lt;p&gt;　　资料显示，贵州药材和贵州药业公司均系贵州黔晟二级子公司，为“一套班子、两块牌子”运营，两家公司同时进行混改。目前，贵州药业公司已通过非主业资产剥离，整体划拨至贵州药材名下，成为贵州药材全资子公司。&lt;/p&gt;&lt;p&gt;　　据了解，此次战略重组贵州药材，系绿地集团在大健康领域的首单混改项目。下一步，绿地将复制“绿地混改”模式，将部分股权转让给贵州药材管理团队及核心员工，实现由绿地控股、贵州黔晟、管理团队及核心员工共同持股的三元结构。&lt;/p&gt;&lt;p&gt;　　收购与增资扩股并行&lt;/p&gt;&lt;p&gt;　　通过此次战略重组，绿地与贵州黔晟聚焦“大健康”整合资源，结合中医中药、旅游度假等特色产业，共同打造贵州省中药材行业新的投资、管理平台和龙头企业。&lt;/p&gt;&lt;p&gt;　　绿地控股董事长、总裁张玉良指出：“参与贵州药材混改，是‘绿地混改’在大健康领域的首单，也是继贵州建工后，再度参与贵州省国资国企改革。绿地康养产业在大健康关键资源领域实现了布局，构筑资源优势，完善大健康产业链，强化核心竞争力。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　“贵州药材未来将实现道地中药材种植、产地初加工、饮片炮制、有效成分提取、成药制造、保健品和饮品开发全产业链布局，成为行业领军企业，打造绿地独有的中医药健康服务品牌IP，成为绿地特色康养产业的重要支撑之一。力争通过3年发展，贵州药材实现营业收入16亿元，利润2.4亿元，还将通过品牌输出、轻资产等方式，推动贵州医疗产业、养老产业、健康管理产业快速发展。”张玉良补充道。&lt;/p&gt;&lt;p&gt;　　公开资料显示，贵州药材成立于1994年，主营业务为中药材流通，为中药材产业链后端。贵州药业成立于2017年，主营业务为中药材种苗繁育、种植、研发、加工、收储等，为中药材产业链中、前端，已在贵州省投资建设两个中药材基地。&lt;/p&gt;&lt;p&gt;　　地产+中药纳入康养产业集团&lt;/p&gt;&lt;p&gt;　　相比其他“地产+养老”模式，绿地集团将贵州药材纳入康养产业集团体系，实现了产业与资本的协同。&lt;/p&gt;&lt;p&gt;　　根据绿地集团的规划，中医板块将与绿地旗下的综合性医疗机构、中高端养老社区全面协同，丰富绿地医康养产业资源、完善产业链条，打造新型医疗养老产业平台。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;　　另外，绿地集团利用现代化科技手段，助力贵州药材发展成为集科技、研发、育苗、流通为一体的现代化医药企业。以贵州为枢纽，依托绿地各产业板块“一带一路”沿线的布局，推动中医药业走出去。&lt;/p&gt;&lt;p&gt;　　近年来，绿地支持贵州省产业升级发展的脚步进一步加快，在国企混改、地产开发、精准扶贫、康养产业、金融生态建设等领域取得了进展。绿地集团通过挖掘贵州在大健康领域的独特优势，使得旗下康养产业在贵州布局持续升级。绿地在贵州打造的优先连锁康养旅居酒店——贵阳绿地新都会康养居酒店2018年年底已开业，遵义绿地康养居酒店正在快速建设中。&lt;/p&gt;&lt;p&gt;　　据了解，绿地康养产业正以康养居为代表的旅居养老产业为核心，以康养谷和康养社区为支撑，依托会员制核心圈层，结合物联网、大数据、移动互联等技术，构建“动静相宜”的综合康养体系。未来还将不断通过资本运作、收并购等方式，衍生发展医疗服务、中医中药、养老科技等相关领域，打造覆盖康养产业链上下游、全龄段的大健康产业生态体系。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570779855', '1570779855', '', '');
INSERT INTO `eju_article_content` VALUES ('6', '24', '&lt;p&gt;中共中、国务院5日对外发布《关于建立健全城乡融合发展体制机制和政策体系的意见》，这份9000多字的重磅文件，未来会对你我的户口、土地、收入有重要影响。来看权威解读。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;户口&lt;/p&gt;&lt;p&gt;——放开放宽除个别超大城市外的城市落户限制&lt;/p&gt;&lt;p&gt;《意见》设定了“到2022年城市落户限制逐步消除”的目标，并要求“有力有序有效深化户籍制度改革，放开放宽除个别超大城市外的城市落户限制”。&lt;/p&gt;&lt;p&gt;数据显示，截至2018底，仍有2.26亿已成为城镇常住人口但尚未落户城市的农业转移人口，其中65%分布在地级以上的城市，基本上是大城市。因此，需要推动大中小城市放开放宽落户限制。&lt;/p&gt;&lt;p&gt;根据发改委今年4月份发布的《2019年新型城镇化建设重点任务》，城区常住人口100万—300万的II型大城市要全面取消落户限制；城区常住人口300万—500万的I型大城市要全面放开放宽落户条件，并全面取消重点群体落户限制。超大特大城市要调整完善积分落户政策，大幅增加落户规模、精简积分项目，确保社保缴纳年限和居住年限分数占主要比例。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;5月6日，国家发改委召开专题新闻发布会，介绍关于建立健全城乡融合发展体制机制和政策体系有关情况，并回答记者提问。&lt;/p&gt;&lt;p&gt;哪些人是重点群体？发改委规划司司长陈亚军6日表示，解决农民工的落户问题首先是坚持存量优先、带动增量的原则。存量优先就是指已经在城市长期就业、工作、居住的这部分农业转移人口，特别是举家迁徙的，还有新生代农民工，以及农村学生升学和参军进入城镇的人口。&lt;/p&gt;&lt;p&gt;“这些重点人群才是落户的重点，而不是说片面的去抢人才。城市需要人才，但是更需要不同层次的人口，绝不能搞选择性落户。”陈亚军说。&lt;/p&gt;&lt;p&gt;清华大学政治经济学研究中心主任蔡继明认为，户籍制度改革要惠及各个阶层，不能搞选择性改革，只盯住所谓高端人才。要把已在城镇就业的农业转移人口作为重点落户群体。&lt;/p&gt;&lt;p&gt;“放宽落户不等于放松对房地产的调控。”陈亚军表示，“房子是用来住的，不是用来炒的”这个定位是必须坚持、不能动摇的。同时，消除城市落户的限制并不是放弃对人口的因城施策。&lt;/p&gt;&lt;p&gt;陈亚军指出，超大城市、特大城市要更多的通过优化积分落户的政策来调控人口，既要留下愿意来城市发展、能为城市做出贡献的人口，又要立足城市功能定位，防止无序的蔓延。个别的超大城市、特大城市还是要严格把握好人口总量控制的这条线，合理疏解中心城区非核心功能，引导人口合理的流动和分布，防止“大城市病”的发生。　&lt;/p&gt;&lt;p&gt;土地&lt;/p&gt;&lt;p&gt;——闲置宅基地可转为集体经营性建设用地入市&lt;/p&gt;&lt;p&gt;《意见》提出了农村土地制度改革的若干举措，包括三大方面：改革完善农村承包地制度、稳慎改革农村宅基地制度、建立集体经营性建设用地入市制度。&lt;/p&gt;&lt;p&gt;在改革完善农村承包地制度方面，保持农村土地承包关系稳定并长久不变，落实第二轮土地承包到期后再延长30年政策。加快完成农村承包地确权登记颁证。&lt;/p&gt;&lt;p&gt;在稳慎改革农村宅基地制度方面，适度放活宅基地和农民房屋使用权。鼓励农村集体经济组织及其成员盘活利用闲置宅基地和闲置房屋。&lt;/p&gt;&lt;p&gt;在建立集体经营性建设用地入市制度方面，允许村集体在农民自愿前提下，依法把有偿收回的闲置宅基地、废弃的集体公益性建设用地转变为集体经营性建设用地入市。&lt;/p&gt;&lt;p&gt;发改委规划司城乡融合发展处处长刘春雨表示，需要注意的是城里人到农村买宅基地的口子不能开，按规划严格实行土地用途管制的原则不能突破，严格禁止下乡利用农村宅基地建设别墅大院和私人会馆。&lt;/p&gt;&lt;p&gt;刘春雨指出，要严格守住土地所有制的性质不改变、耕地红线不突破、农民利益不受损，不能把集体所有制改没了、耕地改少了、农民利益受损了。要以维护农民的基本权益为底线，绝不能代替农民作主，不能强迫农民选择，要真正让农民得到改革的红利。&lt;/p&gt;&lt;p&gt;收入&lt;/p&gt;&lt;p&gt;——统筹提高四个方面收入&lt;/p&gt;&lt;p&gt;国家统计局数据显示，2018年城镇居民人均可支配收入39251元，农村居民人均可支配收入14617元。城乡居民人均收入倍差2.69，比上年缩小0.02。&lt;/p&gt;&lt;p&gt;陈亚军说，虽然城乡居民收入比从较高点的2007年3.14倍，持续下降到2012年的2.88倍，进而下降到2018年的2.69倍，但近几年的缩小幅度逐渐收窄，农民持续增收面临比较大的挑战。&lt;/p&gt;&lt;p&gt;如何真正实现让农民富起来，农民的“钱袋子”鼓起来？为此，《意见》提出，拓宽农民增收渠道，促进农民收入持续增长，持续缩小城乡居民生活水平差距。统筹提高农民的工资性、经营性、财产性、转移性四个方面的收入。&lt;/p&gt;&lt;p&gt;在工资性收入方面，《意见》提出，规范招工用人制度，消除一切就业歧视，健全农民工劳动权益保护机制，落实农民工与城镇职工平等就业制度。健全城乡均等的公共就业创业服务制度，努力增加就业岗位和创业机会。&lt;/p&gt;&lt;p&gt;在经营性收入方面，刘春雨表示，既要完善财政、信贷、保险、用地等政策，降低农业成本、提高农业收入；又要提高职业农民技能，培育发展新型农业经营主体，统筹提高农业效益和农民收入。&lt;/p&gt;&lt;p&gt;在财产性收入方面，刘春雨表示，要以市场化改革为导向，推动农村集体产权制度改革，加快完成农村集体资产的清产核资，并且把经营性资产量化到集体成员，提高农民财产性收入，推动农村资源变资产、资金变股金、农民变股东。&lt;/p&gt;&lt;p&gt;在转移性收入方面，《意见》提出，完善对农民直接补贴政策，健全生产者补贴制度，逐步扩大覆盖范围。在统筹整合涉农资金基础上，探索建立普惠性农民补贴长效机制。&lt;/p&gt;&lt;div&gt;&lt;br/&gt;&lt;/div&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780213', '1570780213', '', '');
INSERT INTO `eju_article_content` VALUES ('7', '25', '&lt;p&gt;较近冷了2018年一整年的楼市在2019年开始有一些新的动向，近3个月以来全国已经有19个城市出台了楼市松绑相关政策，随着现在楼市调控的政策的不断出台，不少城市的房价做出了不同程度的下降调整，这一切似乎也预示着2019年是一个不错的购房好时机，那么在2019年如何买房怎样才能放心呢？小编建议在房价走势不明、或将出现拐点的形势之下，做为一个聪明的购房人在买房之前一定要记住以下七个基本原则：&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、明确适合买什么价位的房&lt;/p&gt;&lt;p&gt;　　由于现在的房价已经处于高位水平，为了让自己不背上过于沉重的贷款压力，在买房之前应该要了解满足生活需求的住宅选择标准后，对自己的资产进行一个大概的评估，确定出一个自己可承受的价格范围，判断价格低限，可以用贷款较高额度与较高年限，来进行出每月还款额，建议每月还款额占家庭月收入比的1/3以下为较佳。这样一来我们就可以在有限的财力之下，购买到既符合置业期望、又具有充分选择空间的购房价格定位。&lt;/p&gt;&lt;p&gt;二、性价比较优选房&lt;/p&gt;&lt;p&gt;衡量房子的性价比高还是低，还需从楼盘的价格及优惠、地段区位、交通配套、居住环境、物业管理等多方面进行比拼，按照自身购房需求，对各购房因素进行排序选择综合评分较高的楼盘。而如果该楼盘刚好推出了极大力度的优惠活动，无疑是买在了性价比较优的时机。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;三、确认公摊面积&lt;/p&gt;&lt;p&gt;买房时，一定要把钱花到刀刃上，如果房子的公摊面积太大，等于白白浪费了自己一部分的血汗钱，所以我们在买房前，较好在购房合同中明确规定的公摊面积的多少，包括公摊面积大小、位置等，只有公摊面积确定了，你的得房率才能明确不至于白花钱。&lt;/p&gt;&lt;p&gt;四、明确交房的时间&lt;/p&gt;&lt;p&gt;对于购房者来说，较害怕的一件事情就是开发商延期交房，甚至迟迟无法交房。所以在买房时，一定要在购房合同中明确规定交房时间，同时约定高额的违约金，这样才能买到放心房也更有保障。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;五、注意房屋的产权&lt;/p&gt;&lt;p&gt;在房产市场中，经常会有一些产权不明确的房源，如果你购买了这样的房子，在短时间内你也很难入住，有时候还会惹上长时间的法律官司，所以在买房时，我们还是要注意房子的产权，如果房子产权有问题，无论你有多满意，较好还是别买有产权问题的房子。&lt;/p&gt;&lt;p&gt;六、买现房更省心&lt;/p&gt;&lt;p&gt;现房相较于期房无疑是置业的首选。尤其是对于次的购房者，由于缺乏购房经验还是建议购买现房比较好，因为现房可以直接观察楼盘质量和户型好坏、周边配套如何等，更避免交房时诸多问题的产生；同时即买即可装修入住，没有交房延期等担忧。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;七、关注区域未来规划&lt;/p&gt;&lt;p&gt;买房不应该只盯着楼盘周边眼前的配套、环境等现状，而忽略了楼盘长远的保值升值潜力。在买房之前还要需要研究城市建设进展情况，如政府近期重大投资项目、重要交通规划或商业规划等，尽量寻找具有升值潜力的区域置业。&lt;/p&gt;&lt;p&gt;小编觉得2019年应该会是个不错的购房时机，但是大家买房时一定要牢记这七大原则，虽然买房的好时机往往是可遇不可求的，但是还是要谨慎决定比较好，如您还想了解更多购房资讯欢迎您致电咨询！&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780287', '1570780287', '', '');
INSERT INTO `eju_article_content` VALUES ('14', '33', '&lt;p&gt;如何挑选一套适合自己家庭需要、性价比又高的房子是每一个买房人较关注的问题，同时也是困扰每个购房者的问题。每到一个售楼部销售人员都会给你说的天花乱坠，自家的房子要多好有多好，但是要挑选好一套称心如意的房子你必须学会自己看房。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、看房前应准备什么？&lt;/p&gt;&lt;p&gt;首先明确自己的购房目的，是刚需还是改需，是养老还是度假，想买多大面积的，想在哪个区域买，房子周围是否要有学校、配套是否齐全等。其次要做好预算，确定可承受的价格范围，分清各项需求的主次关系，在可选范围内，筛选符合自己要求的房子。看房前较好先了解一些房产的基本术语，例如公摊面积等，做到心中有数。&lt;/p&gt;&lt;p&gt;二、看新房应注意什么？&lt;/p&gt;&lt;p&gt;1、一定要看五证&lt;/p&gt;&lt;p&gt;看国有土地使用证、建设用地规划许可证、建设工程规划许可证、建设工程施工许可证、商品销售（预售）许可证是否齐全，尤其是商品销售许可证，必须是原件。&lt;/p&gt;&lt;p&gt;2、看沙盘时应注意什么？&lt;/p&gt;&lt;p&gt;（1）户型的好坏直接影响购房者入住的舒适度首先要注意看户型是否方正，其次看功能分区是否合理，卧室、厨房等分区是否明显，动静区是否分离。&lt;/p&gt;&lt;p&gt;（2）看沙盘上是否注明“模型”或“效果图”字样及模型比例看沙盘的比例尺寸，确定沙盘是否根据实际规划比例制作。&lt;/p&gt;&lt;p&gt;（3）看小区整体规划沙盘是小区的缩影。在沙盘上，小区密度是否过大、建筑与景观的搭配是否协调、交通的分布是否合理、公共设施的分布是否人性化、小区与周边环境的关系等都一目了然，而这些对以后的居住质量影响非常大。&lt;/p&gt;&lt;p&gt;（4）看楼间距90％的沙盘是放大楼体间距的。一般情况下，低层住宅楼间距应大于15米，而那些高层住宅楼间距应当大于24米。&lt;/p&gt;&lt;p&gt;（5）看小区内交通小区内交通的合理性对于居住的安全和环境的静谧性是比较关键的，这也是在看房中容易忽略的问题。购房者要询问一下对小区内交通的规划等。&lt;/p&gt;&lt;p&gt;（6）看公共设施具体位置为了美观，沙盘中常会把小区内的变电站、垃圾箱、化粪池、地下车库出入口等隐藏，然后用绿地取而代之。看沙盘时，一定要问清楚这些公共设施的具体位置、高度及与楼栋之间的距离。&lt;/p&gt;&lt;p&gt;（7）看周边相关法律规定，开发商对沙盘模型内关于楼盘内具体情景的解读是有效的，楼盘外的则无效，也可以不涉及。也就是说，楼盘外即使有铁路、高压线、垃圾中转站等，开发商也可以不告知，所以购房者应该在看房时主动寻问周边的情况。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;3、公摊面积&lt;/p&gt;&lt;p&gt;现在的房子公摊一般都较大，如果有赠送面积一定要问好，赠送面积如果只是他说你可以使用，但却没有在房产证上体现出来，那这部分是不受法律保护的，购房者应该注意看房产证上的面积是否真的加上赠送面积了。&lt;/p&gt;&lt;p&gt;4、容积率&lt;/p&gt;&lt;p&gt;总建筑面积与用地面积的比率。一般越低越好，小区活动空间会大一些。&lt;/p&gt;&lt;p&gt;5、看样板间时应注意什么？&lt;/p&gt;&lt;p&gt;（1）用尺量家具尺寸开发商为了让样板间的卧室看起来宽敞，往往放置不足尺寸的床。大家在看房时，可以带着简易卷尺，边看边量。&lt;/p&gt;&lt;p&gt;（2）找到被隐藏的管线位置大家看样板间时，要仔细询问销售员屋内管线分布情况，如厨房、卫生间的管道位置。如果日后你要对房子进行改装，知道这些很重要。&lt;/p&gt;&lt;p&gt;（3）观察样板间自然采光去看房时你会注意到，就算是大白天，样板间的灯也是全开的。这往往使购房者忽略了日常的采光情况。可以要求销售员将灯全部关掉，方便观察白天室内的采光程度。&lt;/p&gt;&lt;p&gt;（4）问清交房标准大部分精装产品的样板间，并非交房后的较终标准，而且都说装修实材是“大品牌”。这时，购房者有必要询问装修实材的型号、价格，以免上当。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;总之，看房时一定要把这些问题都询问清楚，尽可能的多比较几家再做打算。尤其是次看房，一定要提前了解好相关内容，以免看房时一头雾水。以下就是小编介绍的实地看房时需要注意的问题，希望能助您置业成功。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780605', '1570780605', '', '');
INSERT INTO `eju_article_content` VALUES ('8', '26', '&lt;p&gt;20年间国内商品房市场经历了从无到有的过程，过去20年房地产的周期和调控政策可以分为四个周期和三轮政策调控：1998年实行房改、2003年房地产成为支柱产业、2008年的四万亿刺激计划、2015年去库存政策、2010国十条限购限贷政策、2016稳房市去库存。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、1998-2002年国内房地产市场正式启动成新经济增长点&lt;/p&gt;&lt;p&gt;1997年亚洲爆发的金融危机对的进出口、投资行业、旅游业等产生了不同程度影响。&lt;/p&gt;&lt;p&gt;1998年7月《国务院关于进一步深化城镇住房制度改革加快住房建设的通知》（国发〔1998〕23号）正式印发，启动国内房地产市场，目的是为了刺激住房消费需求、扩大内需以对冲外贸下滑趋势并确立房地产业为我国经济的新增长点。这一时期我国的房价有涨有降总体处于较为平稳的状态。&lt;/p&gt;&lt;p&gt;二、2003-2004年确立支柱产业并推进房地产市场健康发展&lt;/p&gt;&lt;p&gt;2003 年房地产被确立成为我国的支柱产业，同年全国房地产开发投资额首次突破 1 万亿元。为进一步促进房地产市场健康发展、解决房地产价格投资增长过快等问题，2003年8月国务院发布的《国务院关于促进房地产市场持续健康发展的通知》（简称18号文）中提出：房地产业已经成为国民经济的支柱产业同时促进房地产市场持续健康发展。&lt;/p&gt;&lt;p&gt;但此时房地产价格上涨势头并未控制住，反而加快了上升速度：全国新建商品房价格2003年上涨4.8%、2004年上涨15%；而商品房新开工面积增长率由2003年的27.82%下降到2004年的10.43%。&lt;/p&gt;&lt;p&gt;三、2005-2007年提出稳定国内房地产市场&lt;/p&gt;&lt;p&gt;2003年国务院18号文出台后国内的房地产投资过热现象得到一定程度缓解，但住房价格涨势依然明显。2005年3月26日国务院发布8号文要求：高度重视稳定住房价格工作。受政府调控影响城镇房地产投资额占全社会固定资产额比重开始下降，但是由于城镇人口存量大、住房需求大、房地产行业投机行为普遍存在，房价稳定效果并不明显。&lt;/p&gt;&lt;p&gt;四、2008-2009年出台政策刺激住房消费&lt;/p&gt;&lt;p&gt;2008年国际金融危机和世界经济危机对我国经济也造成了冲击，也打击了许多投资者的信心。2008年11月国务院常务会议提出未未2年内投资四万亿元刺激经济。2008年12月国务院发布《关于促进房地产市场健康发展的若干意见》用来应对国际金融危机和国内房地产销量下降的情况。&lt;/p&gt;&lt;p&gt;房价开始暴涨、保增长目的达到且大量资金流向房地产、房地产市场复苏，2009年全国平均房价增长率更是达到23.3%。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;五、2010-2013年房价调控遏制房价过快上涨苗头&lt;/p&gt;&lt;p&gt;2009年国内宽松的信贷和投资政策导致年房价过快增长。同年12月14日国务院出台“国四条”遏制部分城市房价的过快上涨，并从2010年4月14日开始接连出台多条高密度房价调控措施坚决遏制房价过快增长。此时房价仍在增长，但增长已放缓且有进一步放缓的趋势。&lt;/p&gt;&lt;p&gt;六、2014-2016年再度刺激房价涨势分化&lt;/p&gt;&lt;p&gt;2014年经济再度出现下滑趋势国内GDP增长呈个位数、稳增长诉求明显。继2014年“930”新政和“1121” 降息以后房市开始回升。继2015年“330”新政持续降息降准、6月股灾之后一二线房价和销量加速上涨。2016年2月的税费减免政策出台后一二线房价暴涨。同时2015-2016年房地产市场出现明显分化，在一二线房价暴涨的同时三四线房价稳定并持续去库存。&lt;/p&gt;&lt;p&gt;七、2016年住房不炒稳房市去库存成主旋律&lt;/p&gt;&lt;p&gt;2016年随着经济逐渐走稳、外汇储备及汇率企稳、通胀预期抬头、一二线房价上涨等现象出现，此时刺激房地产稳增长、保外汇任务算是基本完成但三四线去库存效果区域差异较大。2016年12月中央经济工作会议提出并强调要促进房地产市场平稳健康发展、坚持住房不炒。房地产政策开始收紧并从全面转向局部，一二线热点城市房市抑制、三四线城市进入去库存阶段。&lt;/p&gt;&lt;p&gt;以上就是小编为大家整理的20年国内房市调控政策历程。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780262', '1570780262', '', '');
INSERT INTO `eju_article_content` VALUES ('9', '27', '&lt;p&gt;对于购房者来说房子不仅仅是用来自住的，还可以成为出租商品，在房价下跌的时候入手多套房源，过后趁着房价上涨转手出售，目前各地各区域房价处在攀升状态，选择房地产置业何尝不是一种赚钱的好方法，但选择房地产也要保持谨慎，这里有一定的技巧，那么您个人是否全面了解该如何选择房地产了呢？选择房地产要注意事项有哪些？以下文章内容小编将为大家讲解。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;个人应该如何选择房地产？&lt;/p&gt;&lt;p&gt;1、盯紧银行房贷是否松紧&lt;/p&gt;&lt;p&gt;银行对买房贷款的态度会间接影响到市场，有经验的购房者对银行放松贷款就能判定房产受市场欢迎，是可以考虑选择，反之银行收紧贷款，这时候选择房产会有高风险，买房需要谨慎入手，这也能说明有时候看银行对房贷的态度比房产专家、政策消息来得更加准确，真实、可靠、可信度提高了，这其实也是一种不错参考的方法之一。&lt;/p&gt;&lt;p&gt;2、当地房地产均价波动&lt;/p&gt;&lt;p&gt;房地产均价变化情况直接告诉您是否要入手，每个楼盘都有表明均价，当均价不是较低、较高是可以当做房地产选择的参考指标。当房地产均价降低了，解释说是因为房产增多了，这是片面的观点，需要您谨慎思考，但某项房产增多了，就能说明市场对这类房产需求增加了，一定程度上也能反映出政府政策的指向。&lt;/p&gt;&lt;p&gt;3、时刻保持理性的心态&lt;/p&gt;&lt;p&gt;选择房地产要具备一定的理性心态，不能一味的跟随大众的步伐，要有自我选择的主见，如果不急于需要，当地房价下降时，应先观望再选择比较为好，百分百的理清自我思路方能选择优质房地产。&lt;/p&gt;&lt;p&gt;4、从平台渠道集齐信息&lt;/p&gt;&lt;p&gt;随着科技越来越先进，各种平台信息能让您全方位收集资料，有时候媒体报道也会掺杂一些虚假信息，这时候就要看自己的判断力，学会辨清虚假信息，收集更多有用的资料，善于利用收集到的信息，去选择优异的房地产。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;选择房地产需要耐心、认真、细心的心态，选择房地产必读这些技巧方面的内容，保证您所选择的决策是成功的，这样才能给自己带来利益，希望小编这篇文章对初次选择房地产的您有帮助。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780776', '1570780776', '', '');
INSERT INTO `eju_article_content` VALUES ('12', '31', '&lt;p&gt;房产证可以抵押给个人，但是在房产证抵押时一定要签定一份《房产抵押借款合同》，对借款金额、是否支付利息或利率标准、还款期限、还款方式、抵押物及抵押登记的办理以及违约责任等内容作出明确具体的约定，并在合同签订后到房屋产权管理部门办理抵押登记手续。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;1.房产证抵押给个人的注意事项&lt;/p&gt;&lt;p&gt;（1）明确房产证抵押的对方是谁，如果是个人与个人抵押的话，则需要明白：房产证抵押不等于房产抵押。&lt;/p&gt;&lt;p&gt;（2）在房产证抵押时一定要签定一份《房产抵押借款合同》，对借款金额、是否支付利息或利率标准、还款期限、还款方式、抵押物及抵押登记的办理以及违约责任等内容作出明确具体的约定，并在合同签订后到房屋产权管理部门办理抵押登记手续。这样做才能合理地保证双方权益，另外这样做还有几个好处：&lt;/p&gt;&lt;p&gt;1)可以了解此房产有没有抵押给别人；&lt;/p&gt;&lt;p&gt;2)做了抵押登记后，该房产就不能买卖；&lt;/p&gt;&lt;p&gt;3)如果发生纠纷，该房产又被抵押给多人，拍卖后有抵押登记的可以先受偿(如果都有登记，则按借款时间先后顺序受偿)。这样才能使自身的权益得到较大限度的保障。&lt;/p&gt;&lt;p&gt;2.其他注意事项&lt;/p&gt;&lt;p&gt;（1）目前使用房屋产权证进行抵押的情况越来越多，制作假产权证的事件也随之增多。所以，市民在遇到有人用房屋产权证向自己借钱的时候，一定要事先到房产部门查阅房产档案，避免收到假的房屋产权证。&lt;/p&gt;&lt;p&gt;（2）保管好自己的房产证、身份证等证件，不要轻易泄露个人的重要信息，以防遭人盗用和“克隆”；借款给别人时，不要被高额利润所诱惑，更不能单凭房屋产权证明和嫌疑人一面之词就轻易签订借款合同，要按照房产证上的地址，登门了解房主的情况，同时要核实房产证的真假以及借款人是否为房地产权利人；银行信贷人员应加强贷前调查，尤其要对贷款人的真实身份进行严格审查，不仅核对姓名、性别、民族、出生日期、住址、公民身份证等项目，还要核对照片。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780506', '1570780506', '', '');
INSERT INTO `eju_article_content` VALUES ('13', '32', '&lt;p&gt;随着各种纠纷的产生，有关公摊面积的话题也频频上了头条和热搜，但其实，与公摊面积更为紧密相连的是梯户比。一般来说，在购房的过程，大家除了考虑价格、位置、周边设施、容积率等因素外，经常会忽略一个重要的因素——梯户比，因为梯户比不仅关系着公摊面积、电梯运营维修费用，还会影响业主居住的舒适度，那么，什么是梯户比？&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、什么是梯户比？&lt;/p&gt;&lt;p&gt;说起房屋面积，购房者你可能会想到公摊面积和建筑面积，但是你知道梯户比吗？梯户比就是单元楼电梯数和每层楼住户数的比例，例如一层楼如果有2个电梯，4户家庭，那么它的梯户比为2：4。&lt;/p&gt;&lt;p&gt;其实，梯户比对于住户的舒适感而言，是非常重要的，这往往跟电梯有所关联。根据2003年版《住宅设计规范》：“七层及以上的住宅或住户入口层楼面距室外设计地面的高度超过16m以上的住宅必须设置电梯。十二层及以上的高层住宅，每栋楼设置电梯不应少于两台，其中宜配置一台可容纳担架的电梯。”&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;二、梯户比不仅关系着公摊面积和电梯运营维修费用，还会影响业主居住的舒适度&lt;/p&gt;&lt;p&gt;1、从费用角度看&lt;/p&gt;&lt;p&gt;虽然从表面上来看，梯户比与公摊面积似乎是没有什么交集，但梯户比是会影响到公摊面积。因为电梯井是公摊的一部分，在住户和楼层相同的情况下，楼梯越多，公摊面积越大，户内的实用面积就越小，房屋的价值就会降低，举个例子，2梯4户的公摊比1梯4户的公摊面积大。&lt;/p&gt;&lt;p&gt;2、再看运营和维修成本&lt;/p&gt;&lt;p&gt;从字面上来说，梯户比其实是很好理解的，说白了，就是电梯与户数之比，因此电梯的使用还关系到后期电梯的运营成本和维修费用，而这部分费用会体现在物业费中。举个例子，1梯1户的运营成本比2梯2户的高，1梯1户业主的物业费一般也会比2梯2户的高一些。&lt;/p&gt;&lt;p&gt;3、从业主的舒适度看&lt;/p&gt;&lt;p&gt;在正文一开始的时候，小编就提到过，梯户比其实也是会影响到业主的舒适感 ，这是因为梯户比会影响房屋的采光、私密性、电梯等待时间。比如，梯户比会影响整栋楼的结构和户型布局，梯户比越高，每层的住户越多，单套面积相对越小，可能出现采光不好的房型。&lt;/p&gt;&lt;p&gt;4、从私密性和电梯等待时间方面来看&lt;/p&gt;&lt;p&gt;对于早上赶着时间去上班的人群而言，电梯的等候时间就显得非常重要了。一般来说，梯户比越高，就会有更多的住户要共享空间，私密性越差，等待电梯的时间就会越长，举个例子。1梯1户肯定比3梯8户的私密性好，电梯等待时间也短。&lt;/p&gt;&lt;p&gt;以上就是本文的全部内容了。在买房时，其实是有不少购房者都会忽略梯户比了，甚至也有不认识的，因此，小编就来给大家科普来了，此外，还有人问，在买房时如何选择梯户比呢？主要考虑2个因素，首先是自身的经济能力和需求，其次是要考虑整栋楼的楼层。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780535', '1570780535', '', '');
INSERT INTO `eju_article_content` VALUES ('10', '28', '&lt;p&gt;“父母把房子赠与子女是不是不要缴税了？”“父母能不能低价把房子卖给子女？”日前，关于房屋产权无偿赠与他人如何缴税以及免征个人所得税问题，引发不少市民关注。而父母的房产要留给子女，通过赠与、买卖、继承哪种方式更省钱？昨日，记者邀请相关业内人士结合案例进行了解读。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;房产赠与免征个税引发关注&lt;/p&gt;&lt;p&gt;日前，财政部、国家税务总局印发《关于个人取得有关收入适用个人所得税应税所得项目的公告》，明确房屋产权所有人将房屋产权无偿赠与他人的，受赠人因无偿受赠房屋取得的受赠收入，按照“偶然所得”项目计算缴纳个人所得税。“从‘其他所得’变为‘偶然所得’，《公告》主要是对征税的项目归类做了调整，税率本身没有变，仍然是20%。”业内人士举例说，就好比晚上上班的人之前叫“晚班”现在叫“夜班”，实质上是一样的。&lt;/p&gt;&lt;p&gt;另外，公告中还提到，房屋产权所有人将房屋产权无偿赠与直系亲属、抚养人或赡养人，以及房屋产权所有人去世后依法继承或受赠的，对当事双方不征收个人所得税。这也成为不少自媒体炒作的由头，甚至别有居心的人将其解读为“购房利好”。&lt;/p&gt;&lt;p&gt;其实，2009年5月发布的《关于个人无偿受赠房屋有关个人所得税问题的通知》，就有关于房屋无偿赠与免征个税的相关规定，而且与本次公告的情形完全相同，而这一提示也出现在本次公告原文中。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;不同过户方式缴纳费用不一样&lt;/p&gt;&lt;p&gt;“当初是我自己花钱买的房，将来想要把房子过户给子女，直接把房本上的名字改一下不就行了，为什么还要办相关手续？还要花钱？”市民周先生的这番话，是不少人的想法。&lt;/p&gt;&lt;p&gt;湖南睿邦律师事务所执行主任刘明律师表示，按照我国的相关法律规定，父母把房子过户给子女的手续并不简单，而父母“在世”与“去世后”的差别也很大。多数情况下，在父母去世后，子女可依法继承其房产，但较好能够提供相关公证材料，而父母在世则可通过赠与或直接“卖”给子女。&lt;/p&gt;&lt;p&gt;“不同的方式需要承担的费用也不同，涉及契税、个人所得税、公证费、房地产价值评估费等，其中继承所需交的公证费相对来说是比较少的。”房产中介资深人士蔡先生介绍，和继承相似，无偿赠与方式也要公证。而根据前面公告规定，直系亲属间的赠与可以免征个人所得税，这在一定程度上大大减轻了当事人负担。不过，继承人或受赠人再次交易该房产时，仍可能要缴纳额度比较高的个人所得税。&lt;/p&gt;&lt;p&gt;那么，通过买卖的方式把房子过户给子女，是不是可以把价格定得非常低呢？业内人士表示，对此法律上并没有强制性的规定，而且契税的征收也不以交易价格计算，而是根据房屋评估价计算税率。根据今年4月份长沙市财政局等部门联合印发的《关于调整第二套住房交易环节契税政策的通知》，从2019年4月22日起，在长沙市范围内停止执行对家庭第二套改善型住房的契税优惠政策，即对个人购买家庭第二套改善型住房，按4%税率征收契税。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;按照《财政部 国家税务总局关于个人无偿受赠房屋有关个人所得税问题的通知》（财税〔2009〕78号）第一条规定，符合以下情形的，对当事双方不征收个人所得税：&lt;/p&gt;&lt;p&gt;（一）房屋产权所有人将房屋产权无偿赠与配偶、父母、子女、祖父母、外祖父母、孙子女、外孙子女、兄弟姐妹；&lt;/p&gt;&lt;p&gt;（二）房屋产权所有人将房屋产权无偿赠与对其承担直接抚养或者赡养义务的抚养人或者赡养人；&lt;/p&gt;&lt;p&gt;（三）房屋产权所有人死亡，依法取得房屋产权的法定继承人、遗嘱继承人或者受遗赠人。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780425', '1570780425', '', '');
INSERT INTO `eju_article_content` VALUES ('11', '30', '&lt;p&gt;目前随着时代的发展，异地购房的现象越来越普遍。较大的原因在于很多人的工作和户口不在同一个地方，大多希望能够在工作地安居定业。也有一小部分人希望在适宜养老的地方购房，为未来有个舒适的养老环境做准备。由于都是异地，和在本地购房还是有些差异。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、符合购房资格&lt;/p&gt;&lt;p&gt;异地贷款买房，首先要知道当地的购房政策。不同的城市有不同的条件，不满足条件的就不能购房了。例如：北京要求交够5年社保，要注意的是必须连续5年，中间一个月都不能少。而长沙需要提供一年以上当地纳税证明或社会保险缴纳证明。各地都不尽相同。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;很多城市的房产价格以及购房资格都是与国家的宏观政策和当地的经济、房产政策息息相关的，如果你要选择到外地购房，那就应该进一步了解国家的相关政策以及当地的相关政策，包括国家的房地产政策和对这些地区的定位，以及当地对异地购房的一些特殊规定等，这样就可以做到心中有数。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;二、征信和收入经过考核&lt;/p&gt;&lt;p&gt;无论在什么地方贷款买房，都需要有稳定的工作、收入和良好的信用才能通过银行的贷款审批。而对于异地的购房者来说要更加严格。银行批贷款一般要求月流水或收入证明是你月供的2倍。也就是说你的月供是1万元，则要求你的收入证明要超过2万元。如果是已婚，银行会看两个人加起来的收入流水。顺便提一句，如果你的另一半也不是本地人，一定要在户口本的状态上改为已婚。否则买房时会让你天南地北的办理手续。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;三、购房资料齐全&lt;/p&gt;&lt;p&gt;1、身份证的原件和复印件，或者是其他身份证明；&lt;/p&gt;&lt;p&gt;2、户口薄的原件和复印件，包括首页、户主、本人页；&lt;/p&gt;&lt;p&gt;3、如果是已经结婚的，要提供结婚证原件和复印件；&lt;/p&gt;&lt;p&gt;4、如果是单身的，则要单身证明原件；&lt;/p&gt;&lt;p&gt;5、有稳定的经济收入，信用良好，有相关单位开具的收入证明；&lt;/p&gt;&lt;p&gt;6、相关部门要求的其它证明资料。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;四、了解信贷政策&lt;/p&gt;&lt;p&gt;异地贷款买房需要非常详细的了解当地银行贷款要求和政策，本身异地办事就已经非常麻烦了，一定要在老家把所需资料准备清楚，免得较后因为一两个材料又要回老家准备，所以一定先弄清楚和完全。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;五、贷款时选等额本息还是等额本金问题&lt;/p&gt;&lt;p&gt;等额本息：在还款期内，每月偿还同等数额的贷款，包含了本金和利息。因为每月贷款额度相同，所以前期还款利息&amp;gt;本金，后期还款本金&amp;gt;利息，则适合收入稳定、刚需，近几年不打算换房的用户。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;等额本金：在还款期内把贷款数总额等分，每月偿还同等数额的本金和剩余贷款在该月所产生的利息。所以每月还贷额度会越来越少，所支出的的总利息会比等额本息的少，但在前期的还款额度较大，需要你有足额还贷。这种方式适合近几年要换房的用户。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;六、有抵押或担保人&lt;/p&gt;&lt;p&gt;异地贷款需要抵押也是不可缺少的环节。除了房子本身要作为抵押以外，一般要提供其他的事物或者一个担保人来做担保。在所有资料都齐全、征信和收入也通过考核后，抵押物的合法有效，担保人的同意承诺书也通过，银行才能同意你的贷款。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780473', '1570780473', '', '');
INSERT INTO `eju_article_content` VALUES ('15', '34', '&lt;p&gt;每个孩子都是父母的宝贝，从孩子出生开始就成了父母努力的动力，他们拼搏一辈子就是为了给孩子更好的生活，而他们奋斗一辈子除了供孩子读书生活，剩下的积蓄可能都倾注在了房子上。&lt;/p&gt;&lt;p&gt;人的生老病死不是人为可控的，很多时候都来的那么突然，老人的突然离世会增加资产处理的难度，提前了解知道能尽量避免家庭矛盾，还能选择更经济划算的方式过户给子女，减轻子女的负担，房产作为其中较大宗的资产，不同的过户方式费用可谓是天壤之别。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;父母将房产过户给子女有三种方式：生前赠与过户、生前买卖过户、离世后遗产继承过户，今天就来说说，根据新规哪种过户方式较划算？生前好还是身后好？&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;①生前赠与过户&lt;/p&gt;&lt;p&gt;提到赠与很多人下意识的会认为是免费的，毕竟平时人们相互间送个东西也是常有的事，也没有见谁给过钱，但是这用在房子上却是不行的，房子作为一个特殊商品，它的赠与过程不是简单的把一个东西给另一个人，它的赠与是要产生费用的。&lt;/p&gt;&lt;p&gt;这笔费用还不少，生前赠与过户的费用包含个税、契税、评估费和公证费，其中个税已于09年以后免征，现在主要收取后三项，契税3%、评估费0.25%、公证费1%。&lt;/p&gt;&lt;p&gt;以一套500万的房子来说，采用赠与的方式过户，要缴纳契税15万，评估费1.25万，公证费5万，共计21.25万。房子越贵费用越高，大城市的要更高，毕竟房价摆在那。所以，从省钱角度看，不建议采取“赠与”的过户方式。&lt;/p&gt;&lt;p&gt;②生前买卖过户&lt;/p&gt;&lt;p&gt;生前买卖过户，听到买卖两个字就可以看做是一场交易，这就跟我们平时正常二手房交易是一样的，按照现行房产交易规则进行就可以了，买卖过户产生的费用主要与房产套数、价格、面积以及不动产证取得时间有关。主要包括增值税、契税、个税、登记费几项费用。&lt;/p&gt;&lt;p&gt;其中，不动产证不满2年，增值税按交易总价5.6%缴纳，满2年，免交；契税满5年的唯一住房，且面积小于90平米，按交易总价1%缴纳，90平米以上按1.5%缴纳，不唯一房产，则要按3%缴纳；个税：普通住宅按交易总价1%缴纳，非普通住宅按2%缴纳；登记费80元。&lt;/p&gt;&lt;p&gt;一套100平米的满5年价值500万的唯一住房，算下来过户费用是12.5万，这比生前赠与过户划算多了。&lt;/p&gt;&lt;p&gt;③离世后遗产继承过户&lt;/p&gt;&lt;p&gt;这是平时大家见的较多的一种，毕竟生老病死谁也预料不到，老人走的匆忙来不及安排的比比皆是，房子较后只能以遗产的方式传给子女，这三种方式过户子女只需要缴纳几百元到数千元的公证费、登记费即可，手续办理也相对简单，但如果继承者再次转卖这个房产（遗产）时，就需要缴纳房产差额20%的个人所得税。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780638', '1570780638', '', '');
INSERT INTO `eju_article_content` VALUES ('16', '35', '&lt;p&gt;择海而居望海而眠，海边的一栋别墅就能满足您的海居梦想，朝朝対海景看春暖花开。但是海景别墅的优缺点您有充分的了解过吗？海景别墅不一定适合每个想要购房的置业者，下面小编为您解析海景别墅自身有哪些优劣之处。&lt;/p&gt;&lt;p&gt;什么是海景别墅呢？就是可以近距离观赏到海景的别墅，具有宽阔面积的海景资源是海景别墅重要的配套资源之一。&lt;/p&gt;&lt;p&gt;根据房屋和海岸线的距离可分为一线、二线和三线海景别墅，一线海景别墅通常是指距海边不超过300米距离，二线海景别墅定位在距海边800米以内的距离，三线海景别墅则是定位距离海边800米以外的别墅。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;海景别墅的优点：&lt;/p&gt;&lt;p&gt;1.&amp;nbsp;调整环境温度。因为海水面对太阳辐射的反射率比较小的缘故，所以海水气温变化幅度比陆地也要小，具有调节气温的特点，所以住在海边可以做到冬暖夏凉，一年四季气温较为稳定。&lt;/p&gt;&lt;p&gt;2.&amp;nbsp;安静的居住环境。沿海居住离城市闹市区较远可以远离纷扰嘈杂的环境，享受更加纯净的新鲜空气和安谧居住氛围，配套宽大的活动空间例如瞰海观景台、海边高尔夫球场等都能提升您的居住品质。&lt;/p&gt;&lt;p&gt;3.&amp;nbsp;放松身心。好的居住环境包括好的景观资源和低密度视野开阔的住宅社区，搭配好的居住休闲配套、高档的绿化景观设计共同构成宜居社区环境，选择海景别墅居住能满足您调整修养身心的需求。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;海景别墅的缺点：&lt;/p&gt;&lt;p&gt;1.&amp;nbsp;临海别墅因处在离主要城区较远的关系，一时间周边医疗、教育、交通等配套会出现衔接不上的问题。因此需要大家结合自身情况综合考虑，并做好购房前的置业咨询来判断是否需要购入临海别墅。&lt;/p&gt;&lt;p&gt;2.&amp;nbsp;潮的居住环境。因为亲海近海的关系，海面起雾时家具、金属家电等容易受到潮湿空气的影响发生锈蚀霉坏的情况，因此要注意选择通风采光效果好的户型。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;因此小编想跟您分享一些购买海景别墅的几点建议：&lt;/p&gt;&lt;p&gt;1.&amp;nbsp;亲海金海别墅。如果想置业的朋友决定购入一套海景别墅的话，建议选择距海5公里以内的别墅项目，因为其稀缺性和地块的重要性未来别墅将会很大的升值空间，别墅自身价值也会提升不少。&lt;/p&gt;&lt;p&gt;2.&amp;nbsp;品牌开发商开发的楼盘。社区品质和规划将在很大程度上决定未来居住的舒适度，好的开发商在规划设计时会考虑给社区匹配好的配套和把关住宅建筑质量让您住的更放心。&lt;/p&gt;&lt;p&gt;3.&amp;nbsp;户型空间方正朝向好。好的朝向、空间设计方正实用的户型适用于很多住宅类型，方便我们合理安排房屋功能分区，房屋的采光、通风效果也会更好。&lt;/p&gt;&lt;p&gt;4.&amp;nbsp;留心装修材料。精装交付的房型需留心开放商所选用的装修材料，其安全质量是否达标，尤其是亲海别墅更要达到耐用耐锈蚀的标准才能避免房屋老化过早。&lt;/p&gt;&lt;p&gt;海景别墅因其高性价比的配置、巨大的升值空间和优越的景观资源成为了职业者热衷的住房类型，在购买之前需要结合自己的需求充分考虑之后再决定是否购买。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780790', '1570780790', '', '');
INSERT INTO `eju_article_content` VALUES ('17', '36', '&lt;p&gt;相同的一个小区里，怎么选出适合的楼房？正常情况下，房子的价格往往是不少购房者较关注的核心，但今天的主题是：在房价合适的情况下，同个小区怎么选楼房？因为除了房价之外，购房者接下来需要着重关注的就是如何在一个小区众多房源中选择适合自己的好房子，一般一个社区往往有多栋楼，不同的楼栋楼层居住的体验感舒适度也是不尽相同，那么要怎么挑选呢？一般跟以下这些问题有关。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、采光问题&lt;/p&gt;&lt;p&gt;在同个小区里选择楼房的时候，一定要首先选择采光好的房子。比如，楼间距不能太近，楼房高度越高所需要的楼间距就应该越宽，普通小区居住用房可以用楼高：楼间距＝1：1．2比值计算。&lt;/p&gt;&lt;p&gt;相信有过住房经过的人都知道，如果楼间距过近，那么房子的采光和私密感都不会太好。因为本来楼盘之间的密度就很大，果楼间距过近太阳，能够照射到的面积就越小，造成的后果除了光线比较暗，大白天也要开灯之外，还会让房间内的温度较低，且比较潮湿。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;二、景观问题&lt;/p&gt;&lt;p&gt;一般来说，在小区里空气较好的位置就莫过于小区景观所处的地方了，即小区中绿化好的位置更宜居。绿化多的区域不仅视野开阔，景观良好，还可以净化空气、隔离噪音和粉尘，从而制造出良好的生活环境，因此价格也较高。&lt;/p&gt;&lt;p&gt;如果你是经济能力比较好，且更注意入住后的舒适感和生活品质的购房者，那么在选房的时候较好能选择景观视野较好的楼栋。如果在北方城市，冬天盛行西北风向，夏季盛行东南风向，因此若楼栋西北方向有建筑，东南向有大片绿化的位置比较理想。&lt;/p&gt;&lt;p&gt;三、出行问题&lt;/p&gt;&lt;p&gt;不管是自己创业还是上班族，交通是否便利是在买房时必须要看的因素。在看房的时候，如果销售人员说小区离某一地铁站或公交站很近，那么必须仔细确认一下购买房屋所处的楼栋，距离地铁站或者公交站到底有多远？从小区的哪个门进出比较方便？&lt;/p&gt;&lt;p&gt;总而言之，出行问题是购房者你衡量同个小区里哪一个楼房更合适你的条件。比如，如果购房者经常开车出入小区的话，那么在就要注意所选楼栋与停车场的距离，不然到了刮风下雨就会严重影响出行，还要注意把握好房源与车库的出入口、小区内的交通干道等位置的距离。&lt;/p&gt;&lt;p&gt;四、生活配套问题&lt;/p&gt;&lt;p&gt;很多人之所以选择老破旧二手房，就是因为其生活配套齐全。因此在选房时要注意，现在很多新区的小区面积都很大，尤其是分多期开发的大体量楼盘，开发商都会建设生活配套，比如运动器材、垃圾箱、超市、药店等，但是这些配套设施不可能完全满足每一栋业主的需求。&lt;/p&gt;&lt;p&gt;也就是说，上面这些生活配套虽然都齐全，但是都是集中在一个位置里的。因此也要考虑和社区内配套的距离问题，距离要适度，既不能太近太不能太远，如果去超市买一袋盐还需要走十几分钟，确实就有点影响日常生活了。&lt;/p&gt;&lt;p&gt;以上就是本文的全部内容了。同个小区怎么选楼房？对此，小编想说的就是，看完上面这些内容后，购房者你就知道了。此外，离小区大门或边门近的房子、离垃圾回收站、加油站近等等有污染的房子，也都较好不要买，毕竟长久住在靠近污染源处对身体健康也不好。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780825', '1570780825', '', '');
INSERT INTO `eju_article_content` VALUES ('18', '37', '&lt;p&gt;我们经常可以在新闻上看到夫妻俩为了在房产证上写谁的名字而大打出手的情况，因此，很多年轻夫妻在结婚时，为了表达诚意，会在自己婚前购买的房产证上加上对方的名字，但是对于房产证加名字这一件事，很多人只听说过，却没有实际操作过，那么房产证上可以写几个名字？房产证上加名字需要哪些手续？&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;夫妻婚前加名字，买卖和赠与都可以。但因为双方在法律上都属于单身，所以受限购影响，如果对方已经有房，是不可以添加对方名字的。通过赠与方式加名字的，夫妻双方需先到公证处办理赠与公证书，夫妻一方赠与另一方一定比例产权，之后双方携带房产证、身份证、公证书到中心办理加名手续；通过买卖方式加名字的，方法和普通二手房过户方法基本相同。两种方法都要缴纳税费，赠与方式还需要缴纳公证费用。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;父母子女加名，选择赠与更合适。首先直系亲属间赠与是不限购的，不需要做购房资格审查，需要先去公证处办理房产赠与的公证，缴纳一定的公证费用，其他流程和夫妻之间婚后加名字类似，同样免征契税、个税和营业税，仅收取房屋登记费和印花税等。以上所有方式的前提是房屋贷款已还完。在贷款未还完之前，是不可以加名字的，所以叔不建议共有产权人购房时只写一个人的名字，有一定风险；但也有例外，夫妻中一人婚前贷款未还清，婚后共同还款人自动增加，房屋产权在通常情况下也会自动分割。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780853', '1570780853', '', '');
INSERT INTO `eju_article_content` VALUES ('19', '38', '&lt;p&gt;其实，不管是什么时候，也不管买什么东西，选择品牌，是最好不过的，在房地产这块也一样，买房最好选择品牌开发商，这是为什么呢？&lt;/p&gt;&lt;p&gt;因为品牌代表着各方面的质量，品牌开发商的房子不仅不用担心开发过程中出现的资金链断裂而造成的烂尾楼的情况，而且往往在地段、配套、物业等方面有着很大优势，品牌开发商在以下多个方面都有不错的保障。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;1、品牌实力&lt;/p&gt;&lt;p&gt;品牌效应会让消费者觉得质量更好更有保障，大开发商整体的品牌、资金实力更强，大开发商整体的品牌、资金实力更强，不会出现烂尾、延期交房等违约的情况，在房产质量和房子设计以及服务体验方面都会比其他同行的要求更高。&lt;/p&gt;&lt;p&gt;2、对产权证有保障。&lt;/p&gt;&lt;p&gt;大开发商，给房产证上一层保护膜，很少出现大品牌开发商没有房产证的情况。&lt;/p&gt;&lt;p&gt;3、提供完美生活环境&lt;/p&gt;&lt;p&gt;相比于小开发商，无论是设计阶段还是施工阶段，大开发商的品控都要强很多，小区的环境绿化会更好，设计也更合理些，小区的一草一木、一个景观，都会提高你今后的入住体验。&lt;/p&gt;&lt;p&gt;4、物业人性化、靠谱&lt;/p&gt;&lt;p&gt;物业服务会人性化，后期的物业服务更是一种良好的保障，更有利于提高生活品质，社区出入管理、水电气暖供应、卫生保洁、停车管理、设施设备维护、服务态度等等，日后房子升值，起决定性作用的就是地段和物业。&lt;/p&gt;&lt;p&gt;5、地段优越&lt;/p&gt;&lt;p&gt;大开发商地段位置确实是非常优越的，这点相信很多购房者都非常明白，有些稀有的资源是其他小开发商所不可及的。&lt;/p&gt;&lt;p&gt;6、保值增值&lt;/p&gt;&lt;p&gt;将来升值空间大，即使是在同一地段的两个楼盘，大品牌开发商的楼盘价值也是比小楼盘更高一些的，大品牌开发商的房子更具有保值增值的能力，当然也会更具有抵抗风险的能力。&lt;/p&gt;&lt;p&gt;品牌开发商推荐楼盘&lt;/p&gt;&lt;p&gt;融创无忌海&lt;/p&gt;&lt;p&gt;项目毗邻省会海口、美兰机场，交通条件便利，主推户型建面69-94㎡低密洋房，均价仅9900元/㎡,自带五大康养体系，养生生活无需忧愁，全龄全享，多功能人性化社区，坐拥千余亩生态湖景的天然地理优势，是个休闲度假、养老的好居所。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;融创观澜湖公园壹号&lt;/p&gt;&lt;p&gt;项目一线果岭精装板楼， 目前主推户型建面101-140㎡，户型赠送面积大，均价13300元/㎡，海南大学国际校区坐落在观澜湖，被三大知名学校环绕，不仅如此，周边的娱乐设施也是很齐全，高铁海口东站、美兰机场、高速近在咫尺。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;项目携手海南生态软件园倾力打造，强强联手致力于打造海口又一地标建筑，品牌项目自有保证，融创物业又以专业贴心、全方位的管家服务出名，主推户型建面75-105㎡，特价11000元/㎡，项目配套有业主食堂、咖啡吧、温泉泡池、泳池、业主活动中心、健康跑道等配套，为您带来不一样的居住体验。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570780921', '1570780921', '', '');
INSERT INTO `eju_article_content` VALUES ('20', '39', '&lt;p&gt;房子一直以来都是人们最为关注的话题，现新房出售主要有两种形式，一是毛坯房，二是精装房，买毛坯房常常让业主费尽脑筋，尤其是在装修方面要花大量的心思，很多事情都需要亲力亲为，而精装房直接住而无装修之烦恼，“拎包入住”是精装房代表性的关键词，那么精装房到底有什么优势呢？&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;精装房有哪些优势？&lt;/p&gt;&lt;p&gt;1、节省时间、精力&lt;/p&gt;&lt;p&gt;毛坯房从买房到装修，再到业主住进去安顿下来，往往都要花上一两年的时间，但是精装房就要省事很多，没有装修的烦恼，您购买之后就可以直接拎包入住，是非常方便省心的事。&lt;/p&gt;&lt;p&gt;2、节省购房成本&lt;/p&gt;&lt;p&gt;购买精装房还能节省成本，精装房的建造全过程都是由专业人事跟进的，可以说精装房整合了地产、装修、建材、监理、运输等各个环节，达到了资源的合理配置与优化，为业主省去装修麻烦的同时，也节省了中间环节的多余支出。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;3、质量、售后有保障&lt;/p&gt;&lt;p&gt;不管是前期设计、设备选型，还是材料采购和施工验收，都会安排专业人员进行严格把关，装修质量更有保证。从售后服务的角度来讲，购买精装修房，消费者购买的是完整的住宅产品，有着十分明确的投诉对象，所以售后服务也更有保障。&lt;/p&gt;&lt;p&gt;4、更加低碳环保&lt;/p&gt;&lt;p&gt;一般来说，如果选购的是毛坯房，那么整幢楼的装修时间跨度会较长，可能入住一段时间后，还有邻居在装修，噪音较大，还可能造成家装的二次污染，家里有小孩的话，更是影响睡眠和玩耍。而精装房则不存在这个问题，所有房子一次性装修完毕，通风和进行室内空气治理后，家人可放心入住，十分低碳环保。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781008', '1570781008', '', '');
INSERT INTO `eju_article_content` VALUES ('21', '40', '&lt;p&gt;大家应该都知道海南是特别适合养老度假的吧？毕竟海南山好水好景好人更好，独特的地理位置、优越的自然风景吸引着无数购房者的目光，越来越多的外地人聚集海南买房养老，或过冬养老、或旅游度假、或投资升值，那么海南哪里比较适合养老、度假、投资呢？今天小编就要给大家介绍两个优质楼盘，富力悦海湾和观澜湖观悦，那么富力悦海湾和观澜湖观悦哪个更好、更值得购买呢，跟着小编一起来详细了解一下吧！&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;项目交通区位PK&lt;/p&gt;&lt;p&gt;富力悦海湾位于临高角风景旅游度假区，东邻澄迈县，西南与儋州市接壤，北濒琼州海峡；环岛西线高速公路和环岛高铁贯穿境内，交通便利，18公里接驳高铁临高南站，环岛西线高速70公里直达省会海口，100公里高速直通美兰国际机场。项目自身将配套业主巴士、观光游览车等丰富的交通系统，确保无忧出行。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖观悦交通路网四通八达，繁华、繁花自由切换，近距通达大环岛高速，约10公里相距东环高速，随时随地，大可以来一场环海南岛的旅行，距离美兰国际机场约15公里，出行便利。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：两个项目的区位都是优越的，都可以满足日常生活的基本出行，虽然观澜湖观悦比富力悦海湾靠近美兰机场，但是富力悦海湾靠近高铁南站，而且富力悦海湾有专属的业主巴士、观光游览车等出行，更加贴切业主的日常需求，所以在交通区位PK上，富力悦海湾更胜一筹。&lt;/p&gt;&lt;p&gt;项目开发商PK&lt;/p&gt;&lt;p&gt;富力悦海湾的开发商是富力地产，富力地产是香港上市企业，中国房地产十强，50余城开发布局。海南富力深耕海南11年，已先后成功开发富力湾、月亮湾、盈溪谷、红树湾、海洋欢乐世界等系列旅居楼盘，广获富力业主的高度认同。富力悦海湾全新升级，不断超越，是海南富力2018年重点发展项目。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖观悦的开发商是海南盛嘉实业有限公司，凭借先进的经营理念、专业的技术支持、务实的工作态度、精心的服务，深耕于房地产业，赢得了广大客户的认可和市场口碑，不断深入探索新的业务发展模式的同时，不断加强自身品牌的塑造。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：从开发商PK中，可以看出富力悦海湾的开发商是知名大品牌，让住宅的品质得打了保障，买房一般都会选择大开发商，雄厚的实力让人信服，在这一点上，富力悦海湾完胜观澜湖观悦。&lt;/p&gt;&lt;p&gt;项目规划PK&lt;/p&gt;&lt;p&gt;富力悦海湾规划占地7800亩，逾800万平米建筑面积，1.6的低容积率，低密度建筑分布，宽阔的楼间距，40%的高绿地率，产品有7栋25-26层的高层住宅楼、10栋17-18层高层住宅楼、10栋9层多层住宅楼、临街商业、1个1层地下室及公共服务设施，21栋洋房别墅。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖观悦占地约108亩，总建筑面积大约14万平米，容积率2.4，绿化率15%，由住宅、别墅组成，纯板式结构。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：在规划面积上富力悦海湾比观澜湖观悦还要大，容积率低于观澜湖观悦，在舒适度上富力悦海湾比观澜湖观悦好，而且产品丰富性更多，带动片区发展，这一模式也为临高，为产品提升了增值潜力，所以小编认为富力悦海湾在整体规划上会更好一些。&lt;/p&gt;&lt;p&gt;项目居住环境PK&lt;/p&gt;&lt;p&gt;富力悦海湾沿海、沿江、沿溪打造“三大公园”， 享江湾美景、亲水生活，原生态林木资源丰富，错落有致的多重立体景观体系，打造公园般的生活场景，每栋房屋前后都有一定距离，这样保证了每层都有足够的采光率，房屋前后都会铺设草坪，周边也会种植些花草树木，即可以每天为户主输送新鲜的氧气，又能防止尘土飞扬，无论是小区环境还是周边环境，满眼尽是绿色，步行就可以到达海边，居住在这边养老、度假都适宜。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖观悦有高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意的生活，社区的园林设计动静结合，这里绿意环绕鲜氧常伴，园林内还有多重美景供业主欣赏，清晨时分，漫步园林中，呼吸着新鲜空气，美好的一天从此时此刻开始。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：两个项目的小区实景环境优美，居住舒适，而富力悦海湾巧妙打造公园般居住空间，尽显绿意盎然的居住生活，精心布局的景观更显有归家宜居的感觉，所以小编认为富力悦海湾会更好一些。&lt;/p&gt;&lt;p&gt;项目配套PK&lt;/p&gt;&lt;p&gt;富力悦海湾内部规划以大健康生活体验为主旨的五大健康中心（健康管理中心、爱乐歌剧院、奥林匹克体育中心、悦海生活广场、湾主体验馆）、妈祖庙公园、安悦园、滨海广场、渔人码头、海上运动公园、彩虹跑道、帆船基地等多场景运动配套及国际双语幼儿园等教育配套入驻项目，社区以星级酒店标准深化物业服务，打造邻里中心、智能社区、无障社区，缔造全龄全周期旅居目的地。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖观悦项目坐拥18洞的高尔夫球场、20余块专业足球训练场、超20000平火山岩五大洲主题温泉SPA、澳洲狂野水世界乐园、冯小刚电影公社、兰桂坊酒吧街、星美国际影城、风情美食街、奥特莱斯，为居者及游客打造一个度假胜地。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：在内部配套方面都能满足居住生活、度假生活，满足全方位高端配套需求，但富力悦海湾配套更加广泛一些，园林、运动、人文、健康、农业等全龄度假配套应有尽有，还配备有幼儿园、智能配套，满足多层人次的理想生活，所以小编更倾向于富力悦海湾。&lt;/p&gt;&lt;p&gt;项目户型PK&lt;/p&gt;&lt;p&gt;富力悦海湾主推住宅、别墅，建面55-104平、177-180平，非毛坯交房，270度环绕观海建筑设计，阔绰观景阳台，瞰海、悦江、赏溪，轻松享受海居生活，主卧套房布局，私密性高。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖观悦在售住宅、别墅户型，建面66.55平两房、约77-90平三房，精装修交付，纯板式设计，户型方正，通通通明亮，采光通风效果好，灵动空间随心而变，宽敞景观阳台，满目皆风景。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：整体来看，两个项目均主推养老度假小户型，格局方正，观景效果俱佳，满足不同人士的购房需求，富力悦海湾主推一房至四房户型，户型丰富、多样，功能齐全又可以观海、观江，小编认为富力悦海湾比观澜湖观悦性价比高，比较好一些。&lt;/p&gt;&lt;p&gt;小编结语&lt;/p&gt;&lt;p&gt;经过多方面对比，从区位上看两个项目出行便捷，小区环境绿化和配套都各有特色，但是富力悦海湾总体来说比观澜湖观悦好一些，富力悦海湾具有丰富的康养体系，为健康终身护航，品牌开发商，品质当然不错，如何选择当然还是要根据自身的实际情况来选择。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781089', '1570781089', '', '');
INSERT INTO `eju_article_content` VALUES ('22', '41', '&lt;p&gt;海口为海南的省会城市，海口观澜湖以整体占地33000亩的庞大之势，打造全新的海口新时尚中心。举头可一览万亩果岭，高达80%绿化率，万亩园林以及丰沛的配套，成为不少置业者的青睐，也汇聚了不少养生度假高端社区。作为观澜湖两大热门置业楼盘：观澜湖九里和融创观澜湖公园壹号，他们规划如何？值不值得买？下面为您全面的解析。&lt;/p&gt;&lt;p&gt;一、区位PK&lt;/p&gt;&lt;p&gt;融创观澜湖公园壹号位于观澜湖度假区内，紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，森林覆盖率超过70%，被称为海口城市之肺，百年荔枝林、生态农庄、湿地景观等环绕周边，鲜氧丰富，尽情深呼吸，交通网发达，便捷交通，畅行全岛。&lt;/p&gt;&lt;p&gt;观澜湖九里位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目约198亩，总建筑面积：22.2万平米。紧邻观澜湖新城，延观澜湖1号黑石球场顺势排布，高尔夫果岭、荔枝林景观尽收眼底，让您吃、住、行、游、购、娱一站满足。羊山大道、迎宾大道、绕城高速、东线高速环绕周边，便捷立体交通，畅达全岛各地，日常出行更加便利。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;PK结果：&lt;/p&gt;&lt;p&gt;两个楼盘共享观澜湖度假区奢华配套，周边环绕鲜氧绿林和国际高尔夫球场，环境优美空气清新，同时交通网络发达，既能远离城市喧嚣，又能轻松穿越全岛，因此两个楼盘都各有优势。&lt;/p&gt;&lt;p&gt;二、项目规划PK&lt;/p&gt;&lt;p&gt;融创观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的优先旅游度假兼自住的综合型项目，项目位于海口市“南优”板块，3万亩观澜湖旅游度假区内，总占地面积217亩，总建筑面积为33.3万平方米，综合容积率为2.3。紧邻观澜湖旅游度假区的主入口，延着观澜湖2号高尔夫球场建设，房型纯板式结构，南北通透。&lt;/p&gt;&lt;p&gt;观澜湖九里位于海口观澜湖旅游度假区内1号黑石球场旁，毗邻疯狂水世界，由海南胜雨实业有限公司巨资开发，项目总占地面积约198亩，总建筑面积约22.2万㎡，地容积率为1.23，绿化率超30%，涵盖别墅+洋房+高层住宅丰富产品线，果岭阔景住宅，户型方正，南北通透。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;规划PK结果：&lt;/p&gt;&lt;p&gt;两个项目规划各有特色，共享观澜湖度假区内丰富配套，娱乐设施建设齐全，产品类型丰富能满足不同客户需求，因此选择任何一个项目都能满足您。&lt;/p&gt;&lt;p&gt;三、户型PK&lt;/p&gt;&lt;p&gt;融创观澜湖壹号项目目前在售主要户型为B户型3室2厅2卫1厨，建面约123.7平，户型优势：&lt;/p&gt;&lt;p&gt;①全明户型，南向卧室，尽享舒适生活；&lt;/p&gt;&lt;p&gt;②户型方正，功能分区合理，家人各得其乐；&lt;/p&gt;&lt;p&gt;③U型厨房设计，餐厅客厅分而不离，生活随心掌握。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;观澜湖九里目前主要在售户型是五期建面为102平米三房两厅两卫，户型优势：&lt;/p&gt;&lt;p&gt;①各个空间户型方正，后期空间利用率高；&lt;/p&gt;&lt;p&gt;②全明通透户型，居住舒适度较高，整个空间采光充足，利于后期居住；&lt;/p&gt;&lt;p&gt;③居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;户型PK结果：&lt;/p&gt;&lt;p&gt;两个项目户型主力户型面积宽敞阔绰，通透明亮，都适合度假自住。&lt;/p&gt;&lt;p&gt;四、价格PK&lt;/p&gt;&lt;p&gt;融创观澜湖公园壹号均价15000元/平，还有限时特惠9套房源推出。折上再享更低价。&lt;/p&gt;&lt;p&gt;观澜湖九里均价17500元/平，全款购房98折优惠。&lt;/p&gt;&lt;p&gt;价格PK结果：&lt;/p&gt;&lt;p&gt;两个项目各方面来说都想差不多，都是高端的度假休闲社区，但是融创观澜湖公园壹号价格更具有一些优势，项目性价比也因此得到体现，更具吸引力。&lt;/p&gt;&lt;p&gt;以上内容仅供参考，购房需参考自身实际情况选择。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781147', '1570781147', '', '');
INSERT INTO `eju_article_content` VALUES ('23', '42', '&lt;p&gt;海南吸引人的地方就在它的环境资源——阳光、空气、蓝天、海水，这些才是很珍贵的，海南恒大海花岛是每家每户都家喻户晓的楼盘，可想而知人气是有多么的强大，而且是大品牌开发商，无论是品牌力量还是价格都是非常具有吸引力，恒大海花岛是一线的海景楼盘，在海南将会是非常稀有的，在这里可以和家人一起感受生活的魅力，让疲惫的心情得以栖息，休闲度假生活尽在其中。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;一、项目优点&lt;/p&gt;&lt;p&gt;1、一线海景，亲密感受海景变化；&lt;/p&gt;&lt;p&gt;2、综合性项目，集居住、旅游、度假、观光、商业、娱乐等为一体的特大型滨海综合地产；&lt;/p&gt;&lt;p&gt;3、大品牌开发商，品牌影响力保证房屋质量标准；&lt;/p&gt;&lt;p&gt;4、建设水平和建设规模综合水平比肩迪拜棕榈岛；&lt;/p&gt;&lt;p&gt;5、区位占据环岛高铁西海岸重要渠道；&lt;/p&gt;&lt;p&gt;二、项目规划&lt;/p&gt;&lt;p&gt;海花岛由三个离岸式岛屿组成，规划填海面积约8平方公里，规划平面形态为盛开在海中的三朵花，故人工岛取名为“海花岛”。 作为以旅居地产为核心的海花岛，产品覆盖范围非常广，有中小高层、花园洋房、瀚海别墅、精美别墅等多项产品，可以满足购房者的各种需求。&lt;/p&gt;&lt;p&gt;三、项目配套&lt;/p&gt;&lt;p&gt;恒大地产集团投资人民币1600亿以上，在海花岛上建有集风情酒店区、美食文化街、酒店、湿地公园、影视传媒基地、康乐园、海上乐园、沙滩泳场、游艇会等设施，打造集大众娱乐、商务交流、俱乐部会员运动、休闲度假为一体的旅游休闲度假岛。岛上还建有种类非常丰富的美食街，为远道而来的游客提供味觉上的享受，还有各种各样的公园，可以说绝大部分能在普通旅游地看到的，在这里都能找到。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;四、区位优势&lt;/p&gt;&lt;p&gt;项目位于海南省儋州市滨海新区近海海域，拥有多维立体交通，空有海南岛三大国际机场：海口美兰国际机场、三亚凤凰国际机场、儋州国际机场；陆有高铁和环岛高速贯穿整个海南岛；海有近在咫尺的游轮码头。这就是恒大集团在海南岛斥巨资倾力打造面向的集四大枢纽于一体——游轮、高速、高铁、机场的旅游黄金岛屿。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;五、居住环境&lt;/p&gt;&lt;p&gt;海花岛的设施布局独到，建筑精美奇特，非常科幻而且科技感十足，整体给人感觉非常的震撼，社区环境优美，高绿化、空气质量好、噪音低、空气湿度适宜，营造一个风景宜人的居住环境。&lt;/p&gt;&lt;p&gt;六、近期动态优惠&lt;/p&gt;&lt;p&gt;项目目前在售户型建面89-149㎡，二房至三房户型，户型丰富多样化，均价19000元/㎡，项目楼房户型方正，空间利用合理，采光通风良好，视野开阔，一线海景房，购房享全款96折，购房成功免费领取1000—5000元家电大礼包，更多楼盘优惠活动详情欢迎您免费来单咨询。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781182', '1570781182', '', '');
INSERT INTO `eju_article_content` VALUES ('24', '43', '&lt;p&gt;海口观澜湖近几年的发展十分迅速，为世界各地的游客提供了一个集高秋运动、旅游度假、休闲娱乐、环球美食和温泉水疗于一身的绝佳旅游目的地。整个观澜湖的度假区面积广袤，各大楼盘崛地而起，不少人也因此到头疼，今天小编就向大家来介绍观澜湖观悦这个楼盘，让我们一起从区位和环境着手了解这宜人之地。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;项目位于海口市观澜湖旅游度假区内，观澜湖是海口的高端旅游度假区，区域内历史文化丰富，汇集了大量的旅游度假产品及高端酒店。不仅是建造的高尔夫球的项目，更致力于创造独一无二的休闲度假品牌，引领国际时尚生活模式，观澜湖高楼耸立配套齐全，学校、商铺、交通发展的也比较齐全。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;项目环境方面有高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意的生活。不仅如此在这里还有一望无际的绿色，清新空气全天围绕，当然也可移动到草地让，与大自然亲密接触。社区的园林设计动静结合，这里绿意环绕鲜氧常伴，园林内还有多重美景供业主欣赏，清晨时分，漫步园林中，呼吸着新鲜空气，美好的一天从此时此刻开始。如需了解更多项目信息和优惠政策可免费致电售楼处咨询。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781279', '1570781279', '', '');
INSERT INTO `eju_article_content` VALUES ('25', '44', '&lt;p&gt;融创观澜湖公园壹号项目定位海口观澜湖景观旅游片区。项目家内外的景致浑然天成，择居于此，幸福的风景不远，倾心的生活更近。本期小编为大家带来项目建面123.67-129.98㎡的三房户型和您一同品析。&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-191011160936301.jpg&quot; title=&quot;1-191011160936301.jpg&quot; alt=&quot;1-191011160936301.jpg&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;融创观澜湖公园壹号实景图&lt;/p&gt;&lt;p&gt;项目规划为3室2厅2卫1厨，整体户型方正且动静分离。双卫的设计更贴合人性舒适宜居。双阳台给您更加广阔的居住视野，尽揽观澜湖美好风光。全明户型规划各部分空间均有窗，保证了整体空间采光和通风居住舒适度好。参与本站购房节活动购买限量10套特惠房源，如需了解更多项目详情和优惠政策可免费致电售楼处咨询。&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-191011160959337.jpg&quot; title=&quot;1-191011160959337.jpg&quot; alt=&quot;1-191011160959337.jpg&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;融创观澜湖公园壹号户型图&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781404', '1570781404', '', '');
INSERT INTO `eju_article_content` VALUES ('26', '45', '&lt;p&gt;位于海南临高的富力悦海湾项目作为十强地产富力在临高开发的精品滨海旅居大盘，项目产品类型多样满足客户各种需求。本期小编为大家带来的是项目别墅样板间实景图片赏析。&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-191011161053S6.jpg&quot; title=&quot;1-191011161053S6.jpg&quot; alt=&quot;1-191011161053S6.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;富力悦海湾别墅样板间实景图&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-19101116105W11.jpg&quot; title=&quot;1-19101116105W11.jpg&quot; alt=&quot;1-19101116105W11.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;富力悦海湾别墅样板间实景图&lt;/p&gt;&lt;p&gt;项目别墅产品皆为精装修交付，项目外立面采用富有异域色彩的西班牙建筑风格。 砖红色屋顶加之外墙采用文化石的设计，凸显出色彩的热情明快。样板间内部装修还是延续明亮的色彩在宽敞的空间里营造度假的舒适氛围。我是均采用带窗的全明设计不止保证温暖阳光的照射，还拓展了您的居住视野让住户品味美景。如需了解更多详情欢迎来电免费咨询。&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-19101116110J16.jpg&quot; title=&quot;1-19101116110J16.jpg&quot; alt=&quot;1-19101116110J16.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;富力悦海湾别墅样板间内部实景&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-191011161113431.jpg&quot; title=&quot;1-191011161113431.jpg&quot; alt=&quot;1-191011161113431.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;富力悦海湾别墅样板间内部实景&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-191011161122100.jpg&quot; title=&quot;1-191011161122100.jpg&quot; alt=&quot;1-191011161122100.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;富力悦海湾别墅样板间内部实景&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781484', '1570781484', '', '');
INSERT INTO `eju_article_content` VALUES ('27', '46', '&lt;p&gt;融创美伦熙语项目立身于澄迈长寿乡，以精品打造水景生活成为岛内外购房者的青睐之选。那么作为热销楼盘，项目究竟有何优点呢？&lt;/p&gt;&lt;p&gt;项目优势总结有四点。首先是由融创开发，品牌开放商融创的出品给予了项目另一重保障；其二在于项目周边完善的配套和发达的交通网便于日常生活；其三就在于美伦河公园和沃克公园的双景观围绕，不止自然生态优良，景观也十分优美；较后就是项目为品牌房企联合海南生态软件园共同打造且获得海南省政府的支持。&lt;/p&gt;&lt;p&gt;四大优势让您品味项目魅力，现购房团购让您享受92-98折优惠等您领取。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781507', '1570781507', '', '');
INSERT INTO `eju_article_content` VALUES ('28', '47', '&lt;p&gt;海南海口融创观澜湖公园壹号项目内部打造了3万㎡的园林景观，每一处都是诗情画意，生活宁静祥和，此外，在每栋住宅区之间安排了富有层次的疏林草地，让社区富有观赏性的同时更具隐蔽性。超大观景阳台正对观澜湖景区，高尔夫果岭、百亩荔枝林，绿意生活尽收眼底。&lt;/p&gt;&lt;p&gt;目前在售户型建面101-185平，均价15000元/平，购房享全款99折优惠，详情欢迎您免费来电咨询。&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-191011161351249.jpg&quot; title=&quot;1-191011161351249.jpg&quot; alt=&quot;1-191011161351249.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;海南海口融创观澜湖公园壹号效果图&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-19101116135UZ.jpg&quot; title=&quot;1-19101116135UZ.jpg&quot; alt=&quot;1-19101116135UZ.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;海南海口融创观澜湖公园壹号效果图&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/uploads/ueditor/20191011/1-1910111614052Q.jpg&quot; title=&quot;1-1910111614052Q.jpg&quot; alt=&quot;1-1910111614052Q.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;海南海口融创观澜湖公园壹号效果图&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781651', '1570781651', '', '');
INSERT INTO `eju_article_content` VALUES ('29', '48', '&lt;p&gt;融创观澜湖公园壹号四期纯板式果岭美宅热销中，建面为108-143㎡，均价13300元/㎡，南北通透，楼体坐北朝南，高尔夫果岭、荔枝林景观尽收眼底，带来一见倾心的诗意生活。项目共54栋楼,一期规划有1栋会所、14栋南北通透的板式高层公寓、40栋 精品别墅。&lt;/p&gt;&lt;p&gt;全款97折、分期98折、按揭99折优惠，如想了解更多详情可免费致电。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781799', '1570781799', '', '');
INSERT INTO `eju_article_content` VALUES ('30', '49', '&lt;p&gt;融创观澜湖公园壹号项目为低层、高层板楼，2019年4月28日四期2#和3#开盘，项目共54栋楼,一期规划有1栋会所、14栋南北通透的板式高层公寓、40栋精品别墅，14栋高层公寓每栋均为21层，首层架空，预计2020年12月四期交房。&lt;/p&gt;&lt;p&gt;在售户型建面101-140㎡，均价13300元/㎡，购房享全款95折优惠，此优惠名额有限，领完为止，更多楼盘活动详情欢迎您免费致电并领取优惠折扣。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781768', '1570781768', '', '');
INSERT INTO `eju_article_content` VALUES ('31', '50', '&lt;p&gt;融创观澜湖公园壹号精装交付，厨房、卫浴等重点空间将引入品牌进行布置，中央空调入户，台盆柜、镜柜、橱柜精心收纳动线，实现无忧入住优质生活体验。百年荔枝林、生态农庄、湿地景观等环绕周边，鲜氧丰富，尽情深呼吸。&lt;/p&gt;&lt;p&gt;免费来电可享五重优惠折扣大礼包，不仅如此，还有更多的优惠折扣替您省钱购房。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570781774', '1570781774', '', '');
INSERT INTO `eju_article_content` VALUES ('32', '51', '&lt;p&gt;雅居乐金沙湾占地面积376666平方米，建筑面积700000平方米，2、3、4栋为26层；叠拼4层；联排2层；1栋公寓10层。小区内部规划有超市、图书馆、商业街、运动场地、健身设施、会所、老年文化中心。&lt;/p&gt;&lt;p&gt;【在售海景洋房，建面92-143㎡，均价13000元/㎡，购房享五重折扣大礼包活动】&lt;/p&gt;&lt;p&gt;如想了解更多房源优惠活动或在售户型，可免费致电售楼处或线上咨询置业顾问，一对一解答了解更多信息。&lt;/p&gt;', '1570782118', '1570782118', '', '');
INSERT INTO `eju_article_content` VALUES ('33', '52', '&lt;p&gt;雅居乐金沙湾位于海口西海岸金沙湾路，北邻海口新海港，南靠金沙湾旅游度假区，东接海口火车站及海口高铁站，西距海边约500米，项目距离海口市中心约17公里，距离海口美兰机场大约40公里，路网发达，交通便捷。&lt;/p&gt;&lt;p&gt;目前在售洋房户型，均价13000元/平，免费来电想五重折扣大礼包活动，详情可免费致电。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1570782113', '1570782113', '', '');
INSERT INTO `eju_article_content` VALUES ('34', '53', '&lt;p&gt;雅居乐金沙湾作为整体绿化率高达42%的小区，初入眼帘的便是，项目丰富的4D体验区，开放式的草坪，配合着环绕型的“椰林梯台”台地景观，形成了一个自然的室外剧场，或儿童嬉戏，或天然日浴，或夜半观影，都是一家人的开心选择。位于栈道另一侧的水上游乐场，以及下沉式的水中休息平台，是“大陆”与“海洋”的自然平衡，坐看风景，卧听游水。&lt;/p&gt;&lt;p&gt;购房享全款99折优惠，购房成功免费赠送1000-5000元家电大礼包，如想了解更多房源信息可免费致电。&lt;/p&gt;', '1570782127', '1570782127', '', '');
INSERT INTO `eju_article_content` VALUES ('35', '54', '&lt;p&gt;雅居乐金沙湾项目覆盖一线海景别墅、亲海精装洋房、海上百变空间等丰富产品线，更甄选国内外一线精装品牌，智能化精装交付，联网密码入户、智能面板开关、无线门磁防护，形成有效预警，呵护全家安全。&lt;/p&gt;&lt;p&gt;【在售楼栋】四期6#&lt;/p&gt;&lt;p&gt;【户型面积】建面约103-105平三房&lt;/p&gt;&lt;p&gt;【房源价格】均价为13000元/平&lt;/p&gt;&lt;p&gt;如想了解更多房源信息、在售楼栋等，可免费来电咨询，以防错过购房好时机。&lt;/p&gt;', '1570782194', '1570782194', '', '');
INSERT INTO `eju_article_content` VALUES ('36', '55', '&lt;p&gt;海南海口雅居乐金沙湾位于西海岸金沙湾区金德路，项目规划总占地面积约565亩，总建筑面积约70万平方，预计分五期开发。项目一期占地67079㎡，约100亩，建筑面积134158㎡，容积率2.0。&lt;/p&gt;&lt;p&gt;【在售户型】建面43-142平户型热销中；&lt;/p&gt;&lt;p&gt;【房源售价】均价约13000元/㎡起。&lt;/p&gt;', '1570782286', '1570782286', '', '');

-- -----------------------------
-- Table structure for `eju_ask`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ask`;
CREATE TABLE `eju_ask` (
  `ask_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联内容（楼盘）id',
  `users_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `ask_title` varchar(80) NOT NULL DEFAULT '' COMMENT '问题标题',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '问题是否推荐',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '问题状态：0未解决，1已解决，2已关闭',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览点击量',
  `replies` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '问题回复量',
  `content` text NOT NULL COMMENT '问题内容',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '问题网址',
  `users_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '问题发布时IP地址',
  `location` varchar(100) DEFAULT '' COMMENT '提问者所在位置',
  `is_review` tinyint(1) NOT NULL DEFAULT '1' COMMENT '问题是否审核，1是，0否',
  `follow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '关注问题则表示有回复时发送邮件通知到问题发布人',
  `solve_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '解决时间(这个问题存在最佳答案则表示已解决)',
  `bestanswer_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最佳答案',
  `sort_order` int(10) NOT NULL DEFAULT '100' COMMENT '排序号',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  PRIMARY KEY (`ask_id`),
  KEY `house_id` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='问题表';

-- -----------------------------
-- Records of `eju_ask`
-- -----------------------------
INSERT INTO `eju_ask` VALUES ('2', '0', '3', '第一个提问-修改', '0', '0', '6', '1', '&lt;p&gt;第一个提问&lt;/p&gt;', '', '127.0.0.1', '本地局域网', '1', '0', '0', '0', '100', '1586916345', '1586917006', 'xuyuzi');

-- -----------------------------
-- Table structure for `eju_auth_role`
-- -----------------------------
DROP TABLE IF EXISTS `eju_auth_role`;
CREATE TABLE `eju_auth_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '' COMMENT '角色名',
  `pid` int(10) DEFAULT '0' COMMENT '父角色ID',
  `remark` text COMMENT '备注信息',
  `grade` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `online_update` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '在线升级',
  `only_oneself` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '只看自己发布',
  `cud` varchar(255) DEFAULT '' COMMENT '增改删',
  `permission` text COMMENT '已允许的权限',
  `built_in` tinyint(1) DEFAULT '0' COMMENT '内置用户组，1表示内置',
  `sort_order` int(10) DEFAULT '0' COMMENT '排序号',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(1=正常，0=屏蔽)',
  `admin_id` int(10) DEFAULT '0' COMMENT '操作管理员ID',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员角色表';

-- -----------------------------
-- Records of `eju_auth_role`
-- -----------------------------
INSERT INTO `eju_auth_role` VALUES ('1', '优化推广员', '0', '', '0', '0', '1', 'a:3:{i:0;s:3:\"add\";i:1;s:4:\"edit\";i:2;s:3:\"del\";}', 'a:2:{s:5:\"rules\";a:8:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"8\";i:4;s:1:\"9\";i:5;s:2:\"10\";i:6;s:2:\"14\";i:7;i:2;}s:7:\"arctype\";a:67:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:8;i:7;i:9;i:8;i:10;i:9;i:11;i:10;i:12;i:11;i:13;i:12;i:20;i:13;i:21;i:14;i:22;i:15;i:23;i:16;i:24;i:17;i:25;i:18;i:26;i:19;i:27;i:20;i:28;i:21;i:29;i:22;i:30;i:23;i:31;i:24;i:32;i:25;i:33;i:26;i:34;i:27;i:35;i:28;i:36;i:29;i:37;i:30;i:38;i:31;i:39;i:32;i:40;i:33;i:41;i:34;i:42;i:35;i:43;i:36;i:44;i:37;i:45;i:38;i:46;i:39;i:47;i:40;i:48;i:41;i:49;i:42;i:50;i:43;i:51;i:44;i:52;i:45;i:53;i:46;i:54;i:47;i:55;i:48;s:2:\"62\";i:49;s:2:\"63\";i:50;s:2:\"64\";i:51;s:2:\"65\";i:52;s:2:\"66\";i:53;s:2:\"67\";i:54;s:2:\"68\";i:55;s:2:\"69\";i:56;s:2:\"70\";i:57;s:2:\"71\";i:58;s:1:\"1\";i:59;s:1:\"2\";i:60;s:1:\"3\";i:61;s:1:\"4\";i:62;s:1:\"5\";i:63;s:1:\"6\";i:64;s:1:\"7\";i:65;s:1:\"8\";i:66;s:1:\"9\";}}', '1', '100', '1', '0', '1541207843', '1561686896');
INSERT INTO `eju_auth_role` VALUES ('2', '内容管理员', '0', '', '0', '0', '1', 'a:3:{i:0;s:3:\"add\";i:1;s:4:\"edit\";i:2;s:3:\"del\";}', 'a:2:{s:5:\"rules\";a:4:{i:0;s:1:\"1\";i:1;s:2:\"10\";i:2;s:2:\"14\";i:3;i:2;}s:7:\"arctype\";a:67:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:8;i:7;i:9;i:8;i:10;i:9;i:11;i:10;i:12;i:11;i:13;i:12;i:20;i:13;i:21;i:14;i:22;i:15;i:23;i:16;i:24;i:17;i:25;i:18;i:26;i:19;i:27;i:20;i:28;i:21;i:29;i:22;i:30;i:23;i:31;i:24;i:32;i:25;i:33;i:26;i:34;i:27;i:35;i:28;i:36;i:29;i:37;i:30;i:38;i:31;i:39;i:32;i:40;i:33;i:41;i:34;i:42;i:35;i:43;i:36;i:44;i:37;i:45;i:38;i:46;i:39;i:47;i:40;i:48;i:41;i:49;i:42;i:50;i:43;i:51;i:44;i:52;i:45;i:53;i:46;i:54;i:47;i:55;i:48;s:2:\"62\";i:49;s:2:\"63\";i:50;s:2:\"64\";i:51;s:2:\"65\";i:52;s:2:\"66\";i:53;s:2:\"67\";i:54;s:2:\"68\";i:55;s:2:\"69\";i:56;s:2:\"70\";i:57;s:2:\"71\";i:58;s:1:\"1\";i:59;s:1:\"2\";i:60;s:1:\"3\";i:61;s:1:\"4\";i:62;s:1:\"5\";i:63;s:1:\"6\";i:64;s:1:\"7\";i:65;s:1:\"8\";i:66;s:1:\"9\";}}', '1', '100', '1', '0', '1541207846', '1561686896');

-- -----------------------------
-- Table structure for `eju_channelfield`
-- -----------------------------
DROP TABLE IF EXISTS `eju_channelfield`;
CREATE TABLE `eju_channelfield` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '字段名称',
  `channel_id` int(10) NOT NULL DEFAULT '0' COMMENT '所属文档模型id',
  `short_name` varchar(10) NOT NULL DEFAULT '' COMMENT '简称',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '字段标题',
  `dtype` varchar(32) NOT NULL DEFAULT '' COMMENT '字段类型',
  `define` text NOT NULL COMMENT '字段定义',
  `maxlength` int(10) NOT NULL DEFAULT '0' COMMENT '最大长度，文本数据必须填写，大于255为text类型',
  `dfvalue` text NOT NULL COMMENT '默认值',
  `dfvalue_unit` varchar(50) NOT NULL DEFAULT '' COMMENT '数值单位',
  `remark` varchar(256) NOT NULL DEFAULT '' COMMENT '提示说明',
  `is_screening` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否应用于条件筛选',
  `is_order` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否应用于排序',
  `ifeditable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否在编辑页显示',
  `ifrequire` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否必填',
  `ifsystem` tinyint(1) NOT NULL DEFAULT '0' COMMENT '字段分类，1=系统(不可修改)，0=自定义',
  `ifmain` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否主表字段',
  `ifcontrol` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，控制该条数据是否允许被控制，1为不允许控制，0为允许控制',
  `sort_order` int(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `join_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '关联字段id(多字段or关联查询）',
  PRIMARY KEY (`id`),
  KEY `channel_id` (`channel_id`,`is_screening`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1510 DEFAULT CHARSET=utf8 COMMENT='自定义字段表';

-- -----------------------------
-- Records of `eju_channelfield`
-- -----------------------------
INSERT INTO `eju_channelfield` VALUES ('1', 'add_time', '0', '', '新增时间', 'datetime', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533091575', '1533091575', '0');
INSERT INTO `eju_channelfield` VALUES ('2', 'update_time', '0', '', '更新时间', 'datetime', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533091601', '1533091601', '0');
INSERT INTO `eju_channelfield` VALUES ('3', 'aid', '0', '', '文档ID', 'int', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533091624', '1533091624', '0');
INSERT INTO `eju_channelfield` VALUES ('4', 'typeid', '0', '', '当前栏目ID', 'int', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533091930', '1533091930', '0');
INSERT INTO `eju_channelfield` VALUES ('5', 'channel', '0', '', '模型ID', 'int', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092214', '1533092214', '0');
INSERT INTO `eju_channelfield` VALUES ('6', 'is_b', '0', '', '是否加粗', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092246', '1533092246', '0');
INSERT INTO `eju_channelfield` VALUES ('7', 'title', '0', '', '文档标题', 'text', 'varchar(250)', '250', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1533092381', '1533092381', '0');
INSERT INTO `eju_channelfield` VALUES ('8', 'litpic', '0', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092398', '1533092398', '0');
INSERT INTO `eju_channelfield` VALUES ('9', 'is_head', '0', '', '是否头条', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092420', '1533092420', '0');
INSERT INTO `eju_channelfield` VALUES ('10', 'is_special', '0', '', '是否特荐', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092439', '1533092439', '0');
INSERT INTO `eju_channelfield` VALUES ('11', 'is_top', '0', '', '是否置顶', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092454', '1533092454', '0');
INSERT INTO `eju_channelfield` VALUES ('12', 'is_recom', '0', '', '是否推荐', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092468', '1533092468', '0');
INSERT INTO `eju_channelfield` VALUES ('13', 'is_jump', '0', '', '是否跳转', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092484', '1533092484', '0');
INSERT INTO `eju_channelfield` VALUES ('14', 'author', '0', '', '编辑者', 'text', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092498', '1533092498', '0');
INSERT INTO `eju_channelfield` VALUES ('15', 'click', '0', '', '浏览量', 'int', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092512', '1533092512', '0');
INSERT INTO `eju_channelfield` VALUES ('16', 'arcrank', '0', '', '阅读权限', 'select', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092534', '1533092534', '0');
INSERT INTO `eju_channelfield` VALUES ('17', 'jumplinks', '0', '', '跳转链接', 'text', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092553', '1533092553', '0');
INSERT INTO `eju_channelfield` VALUES ('18', 'ismake', '0', '', '是否静态页面', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092698', '1533092698', '0');
INSERT INTO `eju_channelfield` VALUES ('19', 'seo_title', '0', '', 'SEO标题', 'text', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092713', '1533092713', '0');
INSERT INTO `eju_channelfield` VALUES ('20', 'seo_keywords', '0', '', 'SEO关键词', 'text', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092725', '1533092725', '0');
INSERT INTO `eju_channelfield` VALUES ('21', 'seo_description', '0', '', 'SEO描述', 'text', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092739', '1533092739', '0');
INSERT INTO `eju_channelfield` VALUES ('22', 'status', '0', '', '状态', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092753', '1533092753', '0');
INSERT INTO `eju_channelfield` VALUES ('23', 'sort_order', '0', '', '排序号', 'int', 'int(11)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533092766', '1533092766', '0');
INSERT INTO `eju_channelfield` VALUES ('27', 'content', '6', '', '内容详情', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '0', '0', '0', '100', '1', '1533464715', '1533464715', '0');
INSERT INTO `eju_channelfield` VALUES ('29', 'content', '1', '', '内容详情', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '0', '0', '0', '100', '1', '1533464713', '1564737280', '0');
INSERT INTO `eju_channelfield` VALUES ('30', 'update_time', '-99', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('31', 'add_time', '-99', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('32', 'status', '-99', '', '启用 (1=正常，0=屏蔽)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('33', 'is_part', '-99', '', '栏目属性：0=内容栏目，1=外部链接', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('34', 'is_hidden', '-99', '', '是否隐藏栏目：0=显示，1=隐藏', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('35', 'sort_order', '-99', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('36', 'seo_description', '-99', '', 'seo描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('37', 'seo_keywords', '-99', '', 'seo关键字', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('38', 'seo_title', '-99', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('39', 'tempview', '-99', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('40', 'templist', '-99', '', '列表模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('41', 'litpic', '-99', '', '栏目图片', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('42', 'typelink', '-99', '', '栏目链接', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('43', 'grade', '-99', '', '栏目等级', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('44', 'englist_name', '-99', '', '栏目英文名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('45', 'dirpath', '-99', '', '目录存放HTML路径', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('46', 'dirname', '-99', '', '目录英文名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('47', 'typename', '-99', '', '栏目名称', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('48', 'parent_id', '-99', '', '栏目上级ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('49', 'current_channel', '-99', '', '栏目当前模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('50', 'channeltype', '-99', '', '栏目顶级模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('51', 'id', '-99', '', '栏目ID', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1533524780', '1533524780', '0');
INSERT INTO `eju_channelfield` VALUES ('52', 'del_method', '-99', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1547890773', '1547890773', '0');
INSERT INTO `eju_channelfield` VALUES ('53', 'is_del', '0', '', '是否伪删除', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1547890773', '1547890773', '0');
INSERT INTO `eju_channelfield` VALUES ('54', 'del_method', '0', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1547890773', '1547890773', '0');
INSERT INTO `eju_channelfield` VALUES ('55', 'prom_type', '0', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1557042574', '1557042574', '0');
INSERT INTO `eju_channelfield` VALUES ('56', 'users_price', '0', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1557042574', '1557042574', '0');
INSERT INTO `eju_channelfield` VALUES ('132', 'update_time', '10', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('133', 'add_time', '10', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('134', 'del_method', '10', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('135', 'is_del', '10', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('136', 'admin_id', '10', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('138', 'sort_order', '10', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('139', 'status', '10', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('140', 'tempview', '10', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('141', 'prom_type', '10', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('142', 'users_price', '10', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('143', 'seo_description', '10', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('144', 'seo_keywords', '10', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('145', 'seo_title', '10', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('146', 'ismake', '10', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('147', 'jumplinks', '10', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('148', 'arcrank', '10', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('149', 'click', '10', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('150', 'author', '10', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('151', 'is_litpic', '10', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('152', 'is_jump', '10', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('153', 'is_recom', '10', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('154', 'is_top', '10', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('155', 'is_special', '10', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('156', 'is_head', '10', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('157', 'litpic', '10', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('158', 'title', '10', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('159', 'is_b', '10', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('160', 'channel', '10', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('161', 'typeid', '10', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('162', 'aid', '10', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315259', '1562315259', '0');
INSERT INTO `eju_channelfield` VALUES ('167', 'content', '10', '', '团购详情', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '0', '0', '0', '100', '1', '1562315259', '1569666521', '0');
INSERT INTO `eju_channelfield` VALUES ('168', 'description', '10', '', '团购优惠', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '0', '0', '0', '100', '1', '1562315259', '1569663098', '0');
INSERT INTO `eju_channelfield` VALUES ('176', 'update_time', '1', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('177', 'add_time', '1', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('178', 'del_method', '1', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('179', 'is_del', '1', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('180', 'admin_id', '1', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('182', 'sort_order', '1', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('183', 'status', '1', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('184', 'tempview', '1', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('185', 'prom_type', '1', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('186', 'users_price', '1', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('187', 'seo_description', '1', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('188', 'seo_keywords', '1', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('189', 'seo_title', '1', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('190', 'ismake', '1', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('191', 'jumplinks', '1', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('192', 'arcrank', '1', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('193', 'click', '1', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('194', 'author', '1', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('195', 'is_litpic', '1', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('196', 'is_jump', '1', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('197', 'is_recom', '1', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('198', 'is_top', '1', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('199', 'is_special', '1', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('200', 'is_head', '1', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('201', 'litpic', '1', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('202', 'title', '1', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('203', 'is_b', '1', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('204', 'channel', '1', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('205', 'typeid', '1', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('206', 'aid', '1', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562315416', '1562315416', '0');
INSERT INTO `eju_channelfield` VALUES ('208', 'update_time', '9', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('209', 'add_time', '9', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('210', 'del_method', '9', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('211', 'is_del', '9', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('212', 'admin_id', '9', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('214', 'sort_order', '9', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('215', 'status', '9', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('216', 'tempview', '9', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('217', 'prom_type', '9', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('218', 'users_price', '9', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('219', 'seo_description', '9', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('220', 'seo_keywords', '9', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('221', 'seo_title', '9', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('222', 'ismake', '9', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('223', 'jumplinks', '9', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('224', 'arcrank', '9', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('225', 'click', '9', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('226', 'author', '9', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('227', 'is_litpic', '9', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('228', 'is_jump', '9', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('229', 'is_recom', '9', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('230', 'is_top', '9', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('231', 'is_special', '9', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('232', 'is_head', '9', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('233', 'litpic', '9', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('234', 'title', '9', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('235', 'is_b', '9', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('236', 'channel', '9', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('237', 'typeid', '9', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('238', 'aid', '9', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('239', 'province_id', '9', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '1', '1', '1', '1', '-3', '1', '1562557502', '1563500762', '0');
INSERT INTO `eju_channelfield` VALUES ('240', 'city_id', '9', '', '城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '1', '1', '1', '1', '-2', '1', '1562557502', '1562557712', '0');
INSERT INTO `eju_channelfield` VALUES ('241', 'address', '9', '', '楼盘地址', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1562557502', '1569750939', '0');
INSERT INTO `eju_channelfield` VALUES ('242', 'sales_address', '9', '', '售楼处地址', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('243', 'lng', '9', '', '经度', '', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '2', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('244', 'lat', '9', '', '纬度', '', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '2', '1', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('245', 'starting_price', '9', '', '起价', 'text', 'varchar(200)', '200', '', '元/㎡', '请填写起价', '0', '1', '1', '0', '1', '2', '0', '100', '1', '1562557502', '1586762816', '0');
INSERT INTO `eju_channelfield` VALUES ('246', 'average_price', '9', '', '均价', 'int', 'int(10)', '10', '6000,10000,15000,20000', '元/㎡', '', '1', '1', '1', '0', '1', '2', '0', '100', '1', '1562557502', '1586762783', '0');
INSERT INTO `eju_channelfield` VALUES ('1426', 'price_max', '18', '', '租金上限', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('248', 'sale_phone', '9', '', ' 售楼电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('249', 'qr_code', '9', '', '扫码看房', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562557502', '1569027922', '0');
INSERT INTO `eju_channelfield` VALUES ('250', 'phone_qr_code', '9', '', '扫码拨号', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562557502', '1569027915', '0');
INSERT INTO `eju_channelfield` VALUES ('251', 'voice', '9', '', '语音介绍', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562557502', '1569570861', '0');
INSERT INTO `eju_channelfield` VALUES ('252', 'opening_time', '9', '', '开盘时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '4', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('253', 'opening_time_memo', '9', '', '开盘备注', 'text', 'varchar(200)', '200', '', '', '开盘备注', '0', '0', '1', '0', '1', '0', '0', '5', '1', '1562557502', '1570775854', '0');
INSERT INTO `eju_channelfield` VALUES ('254', 'complate_time', '9', '', '交房时间', 'datetime', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '13', '1', '1562557502', '1562644217', '0');
INSERT INTO `eju_channelfield` VALUES ('255', 'complate_time_memo', '9', '', '交房备注', 'text', 'varchar(200)', '200', '', '', '交房备注', '0', '0', '1', '0', '1', '0', '0', '14', '1', '1562557502', '1569741113', '0');
INSERT INTO `eju_channelfield` VALUES ('256', 'is_discount', '9', '', '优惠楼盘', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '11', '1', '1562557502', '1568966730', '0');
INSERT INTO `eju_channelfield` VALUES ('257', 'discount', '9', '', '优惠信息', 'text', 'varchar(255)', '255', '', '', '', '0', '0', '1', '0', '1', '0', '0', '12', '1', '1562557502', '1562557502', '0');
INSERT INTO `eju_channelfield` VALUES ('258', 'characteristic', '9', '', '特色', 'checkbox', 'SET(\'小户型\',\'低密居住\',\'旅游地产\',\'教育地产\',\'宜居生态\',\'公园地产\',\'海景楼盘\',\'养生社区\')', '0', '小户型,低密居住,旅游地产,教育地产,宜居生态,公园地产,海景楼盘,养生社区', '', '', '1', '0', '1', '0', '1', '2', '0', '15', '1', '1562557502', '1585045017', '0');
INSERT INTO `eju_channelfield` VALUES ('261', 'floor_area', '9', '', '占地面积', 'text', 'varchar(100)', '100', '', '㎡', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('262', 'building_area', '9', '', '建筑面积', 'text', 'varchar(100)', '100', '', '㎡', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('263', 'main_unit', '9', '', '主力户型', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('264', 'plot_ratio', '9', '', '容积率', 'text', 'varchar(10)', '10', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('265', 'greening_rate', '9', '', '绿化率', 'text', 'varchar(200)', '200', '', '%', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1574939953', '0');
INSERT INTO `eju_channelfield` VALUES ('266', 'property', '9', '', '房屋产权', 'text', 'varchar(200)', '200', '', '年', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1574939941', '0');
INSERT INTO `eju_channelfield` VALUES ('267', 'households', '9', '', '户数', 'text', 'varchar(200)', '200', '', '户', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1574939923', '0');
INSERT INTO `eju_channelfield` VALUES ('268', 'carport', '9', '', '车位数', 'text', 'varchar(200)', '200', '', '个', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1574939910', '0');
INSERT INTO `eju_channelfield` VALUES ('269', 'floor_case', '9', '', '楼层情况', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('270', 'building_num', '9', '', '楼栋数量', 'text', 'varchar(200)', '200', '', '栋', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1574939899', '0');
INSERT INTO `eju_channelfield` VALUES ('271', 'manage_company', '9', '', '物业公司', 'text', 'varchar(255)', '255', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('272', 'manage_type', '9', '', '类型', 'checkbox', 'SET(\'住宅\',\'商铺\',\'写字楼\',\'公寓\',\'别墅\',\'其他\')', '0', '住宅,商铺,写字楼,公寓,别墅,其他', '', '', '1', '0', '1', '0', '1', '2', '0', '18', '1', '1562657345', '1585045023', '0');
INSERT INTO `eju_channelfield` VALUES ('273', 'property_fee', '9', '', '物业费', 'text', 'varchar(200)', '200', '', '元/平·月', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1574939884', '0');
INSERT INTO `eju_channelfield` VALUES ('274', 'developer', '9', '', '开发商', 'text', 'varchar(255)', '255', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('275', 'licence', '9', '', '预售证号', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1562657345', '1568968898', '0');
INSERT INTO `eju_channelfield` VALUES ('276', 'content', '9', '', '项目介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '102', '1', '1562657345', '1562657345', '0');
INSERT INTO `eju_channelfield` VALUES ('277', 'location_introduce', '9', '', '区位介绍', 'multitext', 'text', '0', '', '', '', '0', '0', '0', '0', '1', '0', '0', '101', '1', '1562657345', '1570775798', '0');
INSERT INTO `eju_channelfield` VALUES ('284', 'sale_status', '9', '', '销售状态', 'radio', 'enum(\'预售\',\'在售\',\'售罄\',\'\')', '0', '预售,在售,售罄', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1563498078', '1585045066', '0');
INSERT INTO `eju_channelfield` VALUES ('287', 'total_price', '9', '', '参考总价', 'decimal', 'decimal(10,2)', '10', '', '万元', '请输入参考总价', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1564385444', '1586762747', '0');
INSERT INTO `eju_channelfield` VALUES ('288', 'price_time', '9', '', '价格有效期', 'datetime', 'int(11)', '11', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1564451223', '1564451223', '0');
INSERT INTO `eju_channelfield` VALUES ('291', 'begin_time', '10', '', '活动开始时间', 'datetime', 'int(11)', '11', '', '', '请输入活动开始时间', '0', '0', '1', '0', '0', '0', '0', '2', '1', '1566268716', '1569049208', '0');
INSERT INTO `eju_channelfield` VALUES ('292', 'end_time', '10', '', '活动结束时间', 'datetime', 'int(11)', '11', '', '', '请输入活动结束时间', '0', '0', '1', '0', '0', '0', '0', '3', '1', '1566268739', '1569049254', '0');
INSERT INTO `eju_channelfield` VALUES ('293', 'apply_num', '10', '', '报名人数', 'int', 'int(10)', '10', '', '人', '', '0', '0', '1', '0', '0', '0', '0', '4', '1', '1566272099', '1566897021', '0');
INSERT INTO `eju_channelfield` VALUES ('294', 'joinaid', '10', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1567675644', '1567675644', '0');
INSERT INTO `eju_channelfield` VALUES ('326', 'joinaid', '1', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1568962806', '1568962806', '0');
INSERT INTO `eju_channelfield` VALUES ('327', 'description', '1', '', '简介', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '0', '0', '0', '100', '1', '1568962806', '1568962806', '0');
INSERT INTO `eju_channelfield` VALUES ('328', 'come_from', '1', '', '来源', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '0', '0', '0', '100', '1', '1568962806', '1568962806', '0');
INSERT INTO `eju_channelfield` VALUES ('393', 'joinaid', '9', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1568966713', '1568966713', '0');
INSERT INTO `eju_channelfield` VALUES ('425', 'is_del', '-99', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569036451', '1569036451', '0');
INSERT INTO `eju_channelfield` VALUES ('426', 'admin_id', '-99', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569036451', '1569036451', '0');
INSERT INTO `eju_channelfield` VALUES ('459', 'area_id', '9', '', '区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '0', '0', '0');
INSERT INTO `eju_channelfield` VALUES ('460', 'phone_code', '9', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '分机号', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1569554917', '1570775995', '0');
INSERT INTO `eju_channelfield` VALUES ('461', 'area_id', '10', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1569556182', '1569556182', '0');
INSERT INTO `eju_channelfield` VALUES ('463', 'price_units', '9', '', '价格单位', 'select', 'enum(\'元/㎡\',\'元/套\',\'\')', '0', '元/㎡,元/套', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1569575673', '1585045057', '0');
INSERT INTO `eju_channelfield` VALUES ('464', 'area_id', '6', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('465', 'city_id', '6', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '1', '1', '1', '1', '-2', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('466', 'province_id', '6', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '1', '1', '1', '1', '-3', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('467', 'update_time', '6', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('468', 'add_time', '6', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('469', 'del_method', '6', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('470', 'is_del', '6', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('471', 'admin_id', '6', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('472', 'sort_order', '6', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('473', 'status', '6', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('474', 'tempview', '6', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('475', 'prom_type', '6', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('476', 'users_price', '6', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('477', 'seo_description', '6', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('478', 'seo_keywords', '6', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('479', 'seo_title', '6', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('480', 'ismake', '6', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('481', 'jumplinks', '6', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('482', 'arcrank', '6', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('483', 'click', '6', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('484', 'author', '6', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('485', 'is_litpic', '6', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('486', 'is_jump', '6', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('487', 'is_recom', '6', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('488', 'is_top', '6', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('489', 'is_special', '6', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('490', 'is_head', '6', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('491', 'litpic', '6', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('492', 'title', '6', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('493', 'is_b', '6', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('494', 'channel', '6', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('495', 'typeid', '6', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('496', 'joinaid', '6', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('497', 'aid', '6', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1569576429', '1569576429', '0');
INSERT INTO `eju_channelfield` VALUES ('502', 'building_type', '9', '', '建筑形式', 'checkbox', 'SET(\'低层\',\'高层\',\'多层\',\'复式\')', '0', '低层,高层,多层,复式', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '0', '1585045050', '0');
INSERT INTO `eju_channelfield` VALUES ('503', 'fitment', '9', '', '装修情况', 'checkbox', 'SET(\'毛坯\',\'简装\',\'精装\',\'豪装\')', '0', '毛坯,简装,精装,豪装', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '0', '1585045033', '0');
INSERT INTO `eju_channelfield` VALUES ('504', 'city_id', '10', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-2', '1', '1569632029', '1569632029', '0');
INSERT INTO `eju_channelfield` VALUES ('505', 'province_id', '10', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '0', '1', '1', '1', '-3', '1', '1569632029', '1569632029', '0');
INSERT INTO `eju_channelfield` VALUES ('508', 'price', '10', '', '团购价格', 'decimal', 'decimal(10,2)', '10', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1569663316', '1569663316', '0');
INSERT INTO `eju_channelfield` VALUES ('509', 'area_id', '1', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1569667082', '1569667082', '0');
INSERT INTO `eju_channelfield` VALUES ('518', 'area_id', '0', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('519', 'city_id', '0', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '1', '1', '1', '1', '-2', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('520', 'province_id', '0', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '1', '1', '1', '1', '-3', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('521', 'admin_id', '0', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('522', 'tempview', '0', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('523', 'is_litpic', '0', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('524', 'joinaid', '0', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1570500751', '1570500751', '0');
INSERT INTO `eju_channelfield` VALUES ('525', 'city_id', '1', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-2', '1', '1570935916', '1570935916', '0');
INSERT INTO `eju_channelfield` VALUES ('526', 'province_id', '1', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '0', '1', '1', '1', '-3', '1', '1570935916', '1570935916', '0');
INSERT INTO `eju_channelfield` VALUES ('527', 'area_id', '11', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('528', 'city_id', '11', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '1', '1', '1', '1', '-2', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('529', 'province_id', '11', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '1', '1', '1', '1', '-3', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('530', 'update_time', '11', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('531', 'add_time', '11', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('532', 'del_method', '11', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('533', 'is_del', '11', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('534', 'admin_id', '11', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('535', 'sort_order', '11', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('536', 'status', '11', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('537', 'tempview', '11', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('538', 'prom_type', '11', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('539', 'users_price', '11', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('540', 'seo_description', '11', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('541', 'seo_keywords', '11', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('542', 'seo_title', '11', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('543', 'ismake', '11', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('544', 'jumplinks', '11', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('545', 'arcrank', '11', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('546', 'click', '11', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('547', 'author', '11', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('548', 'is_litpic', '11', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('549', 'is_jump', '11', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('550', 'is_recom', '11', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('551', 'is_top', '11', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('552', 'is_special', '11', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('553', 'is_head', '11', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('554', 'litpic', '11', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('555', 'title', '11', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('556', 'is_b', '11', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('557', 'channel', '11', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('558', 'typeid', '11', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('559', 'joinaid', '11', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('560', 'aid', '11', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('561', 'floor_area', '11', '', '占地面积', 'text', 'varchar(200)', '200', '', '㎡', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('562', 'building_area', '11', '', '建筑面积', 'text', 'varchar(200)', '200', '', '㎡', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('563', 'plot_ratio', '11', '', '容积率', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('564', 'greening_rate', '11', '', '绿化率', 'text', 'varchar(200)', '200', '', '%', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1574940028', '0');
INSERT INTO `eju_channelfield` VALUES ('565', 'property', '11', '', '产权', 'text', 'varchar(200)', '200', '', '年', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('566', 'households', '11', '', '户数', 'text', 'varchar(200)', '200', '', '户', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1574940015', '0');
INSERT INTO `eju_channelfield` VALUES ('567', 'carport', '11', '', '车位数', 'text', 'varchar(200)', '200', '', '个', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1574940004', '0');
INSERT INTO `eju_channelfield` VALUES ('568', 'floor_case', '11', '', '楼层情况', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('569', 'building_num', '11', '', '楼栋数量', 'text', 'varchar(200)', '200', '', '栋', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1574939993', '0');
INSERT INTO `eju_channelfield` VALUES ('570', 'manage_company', '11', '', '物业公司', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('571', 'property_fee', '11', '', '物业费', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('572', 'developer', '11', '', '开发商', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('573', 'location_introduce', '11', '', '区位介绍', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1583375007', '0');
INSERT INTO `eju_channelfield` VALUES ('574', 'content', '11', '', '小区介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1583375002', '0');
INSERT INTO `eju_channelfield` VALUES ('575', 'lng', '11', '', '经度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('576', 'lat', '11', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('577', 'average_price', '11', '', '均价', 'int', 'int(10)', '10', '', '元/㎡', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1586762999', '0');
INSERT INTO `eju_channelfield` VALUES ('578', 'characteristic', '11', '', '特色', 'checkbox', 'SET(\'小户型\',\'低密居住\',\'旅游地产\',\'教育地产\',\'宜居生态\',\'公园地产\',\'海景楼盘\',\'养生社区\')', '0', '小户型,低密居住,旅游地产,教育地产,宜居生态,公园地产,海景楼盘,养生社区', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045110', '0');
INSERT INTO `eju_channelfield` VALUES ('579', 'manage_type', '11', '', '物业类型', 'checkbox', 'SET(\'住宅\',\'商铺\',\'写字楼\',\'公寓\',\'别墅\',\'其他\')', '0', '住宅,商铺,写字楼,公寓,别墅,其他', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045103', '0');
INSERT INTO `eju_channelfield` VALUES ('580', 'address', '11', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('581', 'sale_phone', '11', '', '售房电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('582', 'phone_code', '11', '', '转码号码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('583', 'price_units', '11', '', '价格单位', 'select', 'enum(\'元/㎡\',\'元/套\',\'\')', '0', '元/㎡,元/套', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045095', '0');
INSERT INTO `eju_channelfield` VALUES ('584', 'building_age', '11', '', '建筑年代', 'int', 'int(10)', '10', '0', '年', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572485895', '0');
INSERT INTO `eju_channelfield` VALUES ('585', 'building_type', '11', '', '建筑类型', 'checkbox', 'SET(\'低层\',\'高层\',\'多层\',\'复式\')', '0', '低层,高层,多层,复式', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045087', '0');
INSERT INTO `eju_channelfield` VALUES ('586', 'area_id', '12', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('587', 'city_id', '12', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '1', '1', '1', '1', '-2', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('588', 'province_id', '12', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '1', '1', '1', '1', '-3', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('589', 'update_time', '12', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('590', 'add_time', '12', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('591', 'del_method', '12', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('592', 'is_del', '12', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('593', 'admin_id', '12', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('594', 'sort_order', '12', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('595', 'status', '12', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('596', 'tempview', '12', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('597', 'prom_type', '12', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('598', 'users_price', '12', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('599', 'seo_description', '12', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('600', 'seo_keywords', '12', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('601', 'seo_title', '12', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('602', 'ismake', '12', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('603', 'jumplinks', '12', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('604', 'arcrank', '12', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('605', 'click', '12', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('606', 'author', '12', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('607', 'is_litpic', '12', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('608', 'is_jump', '12', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('609', 'is_recom', '12', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('610', 'is_top', '12', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('611', 'is_special', '12', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('612', 'is_head', '12', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('613', 'litpic', '12', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('614', 'title', '12', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('615', 'is_b', '12', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('616', 'channel', '12', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('617', 'typeid', '12', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('618', 'joinaid', '12', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('619', 'aid', '12', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('620', 'content', '12', '', '房源介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('621', 'property', '12', '', '产权年限', 'int', 'int(10)', '10', '0', '年', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('622', 'building_age', '12', '', '建造年代', 'int', 'int(10)', '10', '0', '年', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('623', 'supporting', '12', '', '配套', 'checkbox', 'SET(\'电视\',\'空调\',\'电梯\',\'冰箱\',\'洗衣机\',\'热水器\',\'阳台\',\'床\',\'沙发\',\'衣柜\',\'抽油烟机\',\'独立卫生间\')', '0', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1585045124', '0');
INSERT INTO `eju_channelfield` VALUES ('624', 'total_price', '12', '', '价格', 'float', 'float(9,2)', '9', '', '万元', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1586763057', '0');
INSERT INTO `eju_channelfield` VALUES ('625', 'area', '12', '', '面积', 'float', 'float(9,2)', '9', '', '㎡', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1586763037', '0');
INSERT INTO `eju_channelfield` VALUES ('626', 'characteristic', '12', '', '特色', 'checkbox', 'SET(\'南北通透\',\'冬暖夏凉\')', '0', '南北通透,冬暖夏凉', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045197', '0');
INSERT INTO `eju_channelfield` VALUES ('627', 'aspect', '12', '', '朝向', 'select', 'enum(\'东\',\'西\',\'南\',\'北\',\'东北\',\'西北\',\'东南\',\'西南\',\'\')', '0', '东,西,南,北,东北,西北,东南,西南', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045190', '0');
INSERT INTO `eju_channelfield` VALUES ('628', 'fitment', '12', '', '装修', 'select', 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\',\'\')', '0', '毛坯,简装,精装,豪装', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045183', '0');
INSERT INTO `eju_channelfield` VALUES ('629', 'manage_type', '12', '', '类型', 'select', 'enum(\'住宅\',\'铺面\',\'别墅\',\'\')', '0', '住宅,铺面,别墅', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045175', '0');
INSERT INTO `eju_channelfield` VALUES ('630', 'room', '12', '', '室', 'select', 'enum(\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'\')', '0', '1,2,3,4,5,6', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045167', '0');
INSERT INTO `eju_channelfield` VALUES ('631', 'living_room', '12', '', '客厅', 'select', 'enum(\'0\',\'1\',\'2\',\'3\',\'4\',\'\')', '0', '0,1,2,3,4', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045159', '0');
INSERT INTO `eju_channelfield` VALUES ('632', 'kitchen', '12', '', '厨房', 'select', 'enum(\'0\',\'1\',\'2\',\'3\',\'\')', '0', '0,1,2,3', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045153', '0');
INSERT INTO `eju_channelfield` VALUES ('633', 'toilet', '12', '', '卫生间', 'select', 'enum(\'0\',\'1\',\'2\',\'3\',\'\')', '0', '0,1,2,3', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045147', '0');
INSERT INTO `eju_channelfield` VALUES ('634', 'balcony', '12', '', '阳台', 'select', 'enum(\'0\',\'1\',\'2\',\'3\',\'\')', '0', '0,1,2,3', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045141', '0');
INSERT INTO `eju_channelfield` VALUES ('636', 'address', '12', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('637', 'lng', '12', '', '精度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('638', 'lat', '12', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('639', 'sale_name', '12', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('640', 'sale_phone', '12', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('641', 'phone_code', '12', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('642', 'floo_type', '12', '', '楼层', 'select', 'enum(\'低层\',\'中层\',\'高层\',\'\')', '0', '低层,中层,高层', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045132', '0');
INSERT INTO `eju_channelfield` VALUES ('643', 'floor_count', '12', '', '楼层数', 'int', 'int(10)', '10', '0', '层', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('644', 'area_id', '13', '', '所在区域', 'region_db', 'int(10)', '10', 'city_id', '', '', '1', '0', '1', '0', '1', '1', '1', '-1', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('645', 'city_id', '13', '', '所在城市', 'region_db', 'int(10)', '10', 'province_id', '', '', '1', '0', '1', '1', '1', '1', '1', '-2', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('646', 'province_id', '13', '', '省份', 'region_db', 'int(10)', '10', '0', '', '', '1', '0', '1', '1', '1', '1', '1', '-3', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('647', 'update_time', '13', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('648', 'add_time', '13', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('649', 'del_method', '13', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('650', 'is_del', '13', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('651', 'admin_id', '13', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('652', 'sort_order', '13', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('653', 'status', '13', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('654', 'tempview', '13', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('655', 'prom_type', '13', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('656', 'users_price', '13', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('657', 'seo_description', '13', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('658', 'seo_keywords', '13', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('659', 'seo_title', '13', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('660', 'ismake', '13', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('661', 'jumplinks', '13', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('662', 'arcrank', '13', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('663', 'click', '13', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('664', 'author', '13', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('665', 'is_litpic', '13', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('666', 'is_jump', '13', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('667', 'is_recom', '13', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('668', 'is_top', '13', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('669', 'is_special', '13', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('670', 'is_head', '13', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('671', 'litpic', '13', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('672', 'title', '13', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '1', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('673', 'is_b', '13', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('674', 'channel', '13', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('675', 'typeid', '13', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('676', 'joinaid', '13', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('677', 'aid', '13', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('678', 'content', '13', '', '房源介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('679', 'property', '13', '', '产权年限', 'int', 'int(10)', '10', '0', '年', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('680', 'building_age', '13', '', '建造年代', 'int', 'int(10)', '10', '0', '年', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('681', 'supporting', '13', '', '配套', 'checkbox', 'SET(\'电视\',\'空调\',\'电梯\',\'冰箱\',\'洗衣机\',\'热水器\',\'阳台\',\'床\',\'沙发\',\'衣柜\',\'抽油烟机\',\'独立卫生间\')', '0', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1572340836', '1585045210', '0');
INSERT INTO `eju_channelfield` VALUES ('682', 'total_price', '13', '', '价格', 'float', 'float(9,2)', '9', '', '万元', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1586763113', '0');
INSERT INTO `eju_channelfield` VALUES ('683', 'area', '13', '', '面积', 'float', 'float(9,2)', '9', '', '㎡', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1586763096', '0');
INSERT INTO `eju_channelfield` VALUES ('684', 'characteristic', '13', '', '特色', 'checkbox', 'SET(\'南北通透\',\'冬暖夏凉\')', '0', '南北通透,冬暖夏凉', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045326', '0');
INSERT INTO `eju_channelfield` VALUES ('685', 'aspect', '13', '', '朝向', 'select', 'enum(\'东\',\'西\',\'南\',\'北\',\'东北\',\'西北\',\'东南\',\'西南\',\'\')', '0', '东,西,南,北,东北,西北,东南,西南', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045317', '0');
INSERT INTO `eju_channelfield` VALUES ('686', 'fitment', '13', '', '装修', 'select', 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\',\'\')', '0', '毛坯,简装,精装,豪装', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045308', '0');
INSERT INTO `eju_channelfield` VALUES ('687', 'manage_type', '13', '', '类型', 'select', 'enum(\'住宅\',\'铺面\',\'别墅\',\'\')', '0', '住宅,铺面,别墅', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045301', '0');
INSERT INTO `eju_channelfield` VALUES ('688', 'room', '13', '', '室', 'select', 'enum(\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'\')', '0', '1,2,3,4,5,6', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045295', '0');
INSERT INTO `eju_channelfield` VALUES ('689', 'living_room', '13', '', '客厅', 'select', 'enum(\'0\',\'1\',\'2\',\'3\',\'4\',\'\')', '0', '0,1,2,3,4', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045288', '0');
INSERT INTO `eju_channelfield` VALUES ('690', 'kitchen', '13', '', '厨房', 'select', 'enum(\'0\',\'1\',\'2\',\'\')', '0', '0,1,2', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045274', '0');
INSERT INTO `eju_channelfield` VALUES ('691', 'toilet', '13', '', '卫生间', 'select', 'enum(\'0\',\'1\',\'2\',\'\')', '0', '0,1,2', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045266', '0');
INSERT INTO `eju_channelfield` VALUES ('692', 'balcony', '13', '', '阳台', 'select', 'enum(\'0\',\'1\',\'2\',\'3\',\'\')', '0', '0,1,2,3', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045259', '0');
INSERT INTO `eju_channelfield` VALUES ('694', 'address', '13', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('695', 'lng', '13', '', '精度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('696', 'lat', '13', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('697', 'price_units', '13', '', '价格单位', 'select', 'enum(\'元/月\',\'元/季\',\'元/年\',\'\')', '0', '元/月,元/季,元/年', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045250', '0');
INSERT INTO `eju_channelfield` VALUES ('698', 'pay_way', '13', '', '付款方式', 'select', 'enum(\'押一付一\',\'押一付三\',\'\')', '0', '押一付一,押一付三', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045244', '0');
INSERT INTO `eju_channelfield` VALUES ('699', 'hire_type', '13', '', '租赁方式', 'select', 'enum(\'整租\',\'合租\',\'\')', '0', '整租,合租', '', '', '1', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045231', '0');
INSERT INTO `eju_channelfield` VALUES ('700', 'room_type', '13', '', '单间厅室', 'select', 'enum(\'主卧\',\'次卧\',\'\')', '0', '主卧,次卧', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045225', '0');
INSERT INTO `eju_channelfield` VALUES ('701', 'sale_name', '13', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('702', 'sale_phone', '13', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('703', 'phone_code', '13', '', '转机码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('704', 'floo_type', '13', '', '楼层', 'select', 'enum(\'低层\',\'中层\',\'高层\',\'\')', '0', '低层,中层,高层', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1585045218', '0');
INSERT INTO `eju_channelfield` VALUES ('705', 'floor_count', '13', '', '楼层数', 'int', 'int(10)', '10', '0', '层', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1572340836', '1572340836', '0');
INSERT INTO `eju_channelfield` VALUES ('1300', 'add_type', '13', '', '1：主动添加，0：关联自动生成', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1299', 'average_price', '12', '', '均价', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('716', 'show_time', '9', '', '置顶时间', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1574939832', '1574939832', '0');
INSERT INTO `eju_channelfield` VALUES ('717', 'users_id', '9', '', '用户id', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1574939832', '1574939832', '0');
INSERT INTO `eju_channelfield` VALUES ('718', 'show_time', '11', '', '置顶时间', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1574939976', '1574939976', '0');
INSERT INTO `eju_channelfield` VALUES ('719', 'users_id', '11', '', '用户id', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1574939976', '1574939976', '0');
INSERT INTO `eju_channelfield` VALUES ('1375', 'content', '15', '', '房源介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1376', 'property', '15', '', '产权年限', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1377', 'building_age', '15', '', '建造年代', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1378', 'supporting', '15', '', '配套', 'checkbox', 'set(\'电梯\',\'冰箱\',\'洗衣机\',\'热水器\',\'阳台\',\'网络\',\'暖气\',\'停车位\',\'客梯\',\'货梯\',\'扶梯\',\'空调\',\'上水\',\'下水\',\'可明火\',\'排烟\',\'排污\',\'燃气\',\'外摆区\')', '0', '电梯,冰箱,洗衣机,热水器,阳台,网络,暖气,停车位,客梯,货梯,扶梯,空调,上水,下水,可明火,排烟,排污,燃气,外摆区', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1389', 'diy_jgmy', '15', '', '价格是否可谈', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1388', 'diy_xgfy', '15', '', '相关费用', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1387', 'diy_jinshen', '15', '', '进深', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1386', 'diy_cenggao', '15', '', '层高', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1385', 'diy_miankuan', '15', '', '面宽', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1384', 'diy_klrq', '15', '', '客流人群', 'select', 'enum(\'办公人群\',\'学生人群\',\'居民人群\',\'旅游人群\',\'其他\',\'\')', '0', '办公人群,学生人群,居民人群,旅游人群,其他,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1383', 'diy_jyzt', '15', '', '经营状态', 'select', 'enum(\'经营中\',\'空置中\',\'\')', '0', '经营中,空置中,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1382', 'diy_spxz', '15', '', '商铺性质', 'select', 'enum(\'商铺新房\',\'二手商铺\',\'\')', '0', '商铺新房,二手商铺,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1381', 'diy_qzq', '15', '', '起租期', 'select', 'enum(\'三个月\',\'六个月\',\'十二个月\',\'\')', '0', '三个月,六个月,十二个月,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1380', 'panoram', '15', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1361', 'content', '14', '', '房源介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1362', 'property', '14', '', '产权年限', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1363', 'building_age', '14', '', '建造年代', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1364', 'supporting', '14', '', '商铺配套', 'checkbox', 'set(\'电梯\',\'冰箱\',\'洗衣机\',\'热水器\',\'阳台\',\'网络\',\'暖气\',\'停车位\',\'客梯\',\'货梯\',\'扶梯\',\'空调\',\'上水\',\'下水\',\'可明火\',\'排烟\',\'排污\',\'燃气\',\'外摆区\')', '0', '电梯,冰箱,洗衣机,热水器,阳台,网络,暖气,停车位,客梯,货梯,扶梯,空调,上水,下水,可明火,排烟,排污,燃气,外摆区', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1365', 'property_fee', '14', '', '物业费', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1366', 'panoram', '14', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1367', 'diy_miankuan', '14', '', '面宽', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1368', 'diy_cenggao', '14', '', '层高', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1369', 'diy_jinshen', '14', '', '进深', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1370', 'diy_jyzt', '14', '', '经营状态', 'select', 'enum(\'经营中\',\'空置中\',\'\')', '0', '经营中,空置中,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1371', 'diy_yqsy', '14', '', '预期收益', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1372', 'diy_klrq', '14', '', '客流人群', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1049', 'total_price', '14', '', '价格', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763249', '0');
INSERT INTO `eju_channelfield` VALUES ('1050', 'area', '14', '', '面积', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763268', '0');
INSERT INTO `eju_channelfield` VALUES ('1051', 'average_price', '14', '', '均价，根据面积何总价自动计算获得', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763232', '0');
INSERT INTO `eju_channelfield` VALUES ('1052', 'characteristic', '14', '', '特色标签', 'checkbox', 'SET(\'底层沿街\',\'可分割两层\',\'低价急售\',\'独栋\',\'繁华地段\',\'知名商户入驻\')', '0', '底层沿街,可分割两层,低价急售,独栋,繁华地段,知名商户入驻', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045454', '0');
INSERT INTO `eju_channelfield` VALUES ('1053', 'manage_type', '14', '', '类型', 'select', 'enum(\'住宅底商\',\'商业街铺面\',\'其他\',\'购物中心百货\',\'写字楼配套底商\',\'临街别墅\',\'\')', '0', '住宅底商,商业街铺面,其他,购物中心百货,写字楼配套底商,临街别墅', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045447', '0');
INSERT INTO `eju_channelfield` VALUES ('1054', 'fitment', '14', '', '装修情况', 'select', 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\',\'\')', '0', '毛坯,简装,精装,豪装', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045413', '0');
INSERT INTO `eju_channelfield` VALUES ('1507', 'typeid', '17', '', '当前栏目', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1056', 'address', '14', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1057', 'lng', '14', '', '精度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1058', 'lat', '14', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1059', 'sale_name', '14', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1060', 'sale_phone', '14', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1061', 'phone_code', '14', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1062', 'floo_type', '14', '', '楼层', 'select', 'enum(\'低层\',\'中层\',\'高层\',\'\')', '0', '低层,中层,高层', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045405', '0');
INSERT INTO `eju_channelfield` VALUES ('1063', 'floor_count', '14', '', '楼层数', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1064', 'industry', '14', '', '经营行业', 'checkbox', 'SET(\'其他\',\'酒店宾馆\',\'百货超市\',\'生活服务\',\'美容美发\',\'休闲娱乐\',\'服饰鞋包\',\'餐饮美食\')', '0', '其他,酒店宾馆,百货超市,生活服务,美容美发,休闲娱乐,服饰鞋包,餐饮美食', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045395', '0');
INSERT INTO `eju_channelfield` VALUES ('1065', 'division', '14', '', '是否可分割', 'select', 'enum(\'不可分割\',\'可分割\',\'\')', '0', '不可分割,可分割', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045388', '0');
INSERT INTO `eju_channelfield` VALUES ('1398', 'diy_gws', '16', '', '工位数', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1397', 'diy_syl', '16', '', '使用率', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1390', 'content', '16', '', '房源介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1391', 'property', '16', '', '产权年限', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1392', 'building_age', '16', '', '建造年代', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1393', 'property_fee', '16', '', '物业费', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1394', 'panoram', '16', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1395', 'sfbhwyf', '16', '', '是否包含物业费', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1396', 'diy_xingzhi', '16', '', '性质', 'select', 'enum(\'新房写字楼\',\'二手写字楼\',\'\')', '0', '新房写字楼,二手写字楼,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1400', 'diy_xgfy', '16', '', '相关费用', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1373', 'diy_xgfy', '14', '', '相关费用', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1374', 'diy_jgmy', '14', '', '价格是否可谈', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1119', 'total_price', '15', '', '租金', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763296', '0');
INSERT INTO `eju_channelfield` VALUES ('1120', 'area', '15', '', '面积', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763313', '0');
INSERT INTO `eju_channelfield` VALUES ('1121', 'average_price', '15', '', '均价，根据面积何总价自动计算获得', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763333', '0');
INSERT INTO `eju_channelfield` VALUES ('1122', 'characteristic', '15', '', '特色', 'checkbox', 'SET(\'底层沿街\',\'可分割两层\',\'低价急售\',\'独栋\',\'繁华地段\',\'知名商户入驻\')', '0', '底层沿街,可分割两层,低价急售,独栋,繁华地段,知名商户入驻', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045569', '0');
INSERT INTO `eju_channelfield` VALUES ('1123', 'manage_type', '15', '', '类型', 'select', 'enum(\'住宅底商\',\'商业街铺面\',\'其他\',\'购物中心百货\',\'写字楼配套底商\',\'临街别墅\',\'\')', '0', '住宅底商,商业街铺面,其他,购物中心百货,写字楼配套底商,临街别墅', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045575', '0');
INSERT INTO `eju_channelfield` VALUES ('1124', 'fitment', '15', '', '装修', 'select', 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\',\'\')', '0', '毛坯,简装,精装,豪装', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045550', '0');
INSERT INTO `eju_channelfield` VALUES ('1501', 'is_special', '17', '', '特荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1126', 'address', '15', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1127', 'lng', '15', '', '精度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1128', 'lat', '15', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1129', 'sale_name', '15', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1130', 'sale_phone', '15', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1131', 'phone_code', '15', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1132', 'floo_type', '15', '', '楼层', 'select', 'enum(\'低层\',\'中层\',\'高层\',\'\')', '0', '低层,中层,高层', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045541', '0');
INSERT INTO `eju_channelfield` VALUES ('1133', 'floor_count', '15', '', '楼层数', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1134', 'price_units', '15', '', '价格单位', 'select', 'enum(\'元/月\',\'元/㎡/月\',\'元/季\',\'元/年\',\'\')', '0', '元/月,元/㎡/月,元/季,元/年', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045532', '0');
INSERT INTO `eju_channelfield` VALUES ('1135', 'pay_way', '15', '', '付款方式', 'select', 'enum(\'押一付一\',\'押一付三\',\'\')', '0', '押一付一,押一付三', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045525', '0');
INSERT INTO `eju_channelfield` VALUES ('1136', 'division', '15', '', '是否可分割', 'select', 'enum(\'不可分割\',\'可分割\',\'\')', '0', '不可分割,可分割', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045519', '0');
INSERT INTO `eju_channelfield` VALUES ('1137', 'industry', '15', '', '经营行业', 'checkbox', 'SET(\'其他\',\'酒店宾馆\',\'百货超市\',\'生活服务\',\'美容美发\',\'休闲娱乐\',\'服饰鞋包\',\'餐饮美食\')', '0', '其他,酒店宾馆,百货超市,生活服务,美容美发,休闲娱乐,服饰鞋包,餐饮美食', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045512', '0');
INSERT INTO `eju_channelfield` VALUES ('1138', 'lease_type', '15', '', '是否转让', 'select', 'enum(\'否\',\'是\',\'\')', '0', '否,是', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045505', '0');
INSERT INTO `eju_channelfield` VALUES ('1409', 'diy_syl', '17', '', '使用率', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1408', 'diy_qzq', '17', '', '起租期', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1401', 'content', '17', '', '房源介绍', 'htmltext', 'longtext', '0', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1402', 'property', '17', '', '产权年限', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1403', 'building_age', '17', '', '建造年代', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1404', 'property_fee', '17', '', '物业费', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1405', 'panoram', '17', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1406', 'sfbhwyf', '17', '', '是否包含物业费', 'text', 'varchar(200)', '200', '', '', '请填写（不包含物业费）或者（包含物业费）', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589274503', '0');
INSERT INTO `eju_channelfield` VALUES ('1407', 'diy_xingzhi', '17', '', '性质', 'select', 'enum(\'新房写字楼\',\'二手写字楼\',\'\')', '0', '新房写字楼,二手写字楼,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1412', 'diy_xgfy', '17', '', '相关费用', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1188', 'total_price', '16', '', '价格', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763362', '0');
INSERT INTO `eju_channelfield` VALUES ('1189', 'area', '16', '', '面积', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763381', '0');
INSERT INTO `eju_channelfield` VALUES ('1190', 'average_price', '16', '', '均价，根据面积何总价自动计算获得', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763403', '0');
INSERT INTO `eju_channelfield` VALUES ('1191', 'characteristic', '16', '', '标签', 'checkbox', 'SET(\'免中介费\',\'可注册\',\'赠免租期\',\'交通便利\',\'中心商务区\',\'地标建筑\',\'知名物业\',\'繁华商圈\',\'独栋写字楼\')', '0', '免中介费,可注册,赠免租期,交通便利,中心商务区,地标建筑,知名物业,繁华商圈,独栋写字楼', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045651', '0');
INSERT INTO `eju_channelfield` VALUES ('1192', 'manage_type', '16', '', '类型', 'select', 'enum(\'纯写字楼\',\'商业综合体\',\'酒店写字楼\',\'\')', '0', '纯写字楼,商业综合体,酒店写字楼', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045621', '0');
INSERT INTO `eju_channelfield` VALUES ('1193', 'fitment', '16', '', '装修情况', 'select', 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\',\'\')', '0', '毛坯,简装,精装,豪装', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045613', '0');
INSERT INTO `eju_channelfield` VALUES ('1195', 'address', '16', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1196', 'lng', '16', '', '精度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1197', 'lat', '16', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1198', 'sale_name', '16', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1199', 'sale_phone', '16', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1200', 'phone_code', '16', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1201', 'floo_type', '16', '', '楼层', 'select', 'enum(\'低层\',\'中层\',\'高层\',\'\')', '0', '低层,中层,高层', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045605', '0');
INSERT INTO `eju_channelfield` VALUES ('1202', 'floor_count', '16', '', '楼层数', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1203', 'level', '16', '', '等级', 'select', 'enum(\'甲级\',\'乙级\',\'丙级\',\'丁级\',\'\')', '0', '甲级,乙级,丙级,丁级', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045601', '0');
INSERT INTO `eju_channelfield` VALUES ('1204', 'division', '16', '', '是否可分割', 'select', 'enum(\'不可分割\',\'可分割\',\'\')', '0', '不可分割,可分割', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045596', '0');
INSERT INTO `eju_channelfield` VALUES ('1413', 'priority', '18', '', '优先区域', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1414', 'lease', '18', '', '租约年限', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1415', 'certificate', '18', '', '办证需要', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1416', 'transfer', '18', '', '是否接受转让费', 'select', 'enum(\'不接受\',\'接受\')', '0', '不接受,接受', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1417', 'floors', '18', '', '意向楼层', 'text', 'varchar(100)', '100', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1418', 'supporting', '18', '', '需求硬件配套', 'checkbox', 'set(\'外摆区\',\'天然气\',\'停车位\',\'排污管道\',\'烟管道\',\'煤气罐\',\'380伏\',\'下水\',\'上水\',\'可明火\')', '0', '外摆区,天然气,停车位,排污管道,烟管道,煤气罐,380伏,下水,上水,可明火', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1509', 'aid', '17', '', 'aid', 'int', 'int(10)', '10', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1508', 'joinaid', '17', '', '关联文档id', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1494', 'author', '17', '', '作者', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1495', 'is_moods', '17', '', '人气', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1496', 'is_sale', '17', '', '特价', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1497', 'is_litpic', '17', '', '图片（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1498', 'is_jump', '17', '', '跳转链接（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1499', 'is_recom', '17', '', '推荐（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1500', 'is_top', '17', '', '置顶（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1506', 'channel', '17', '', '模型ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1505', 'is_b', '17', '', '加粗', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1504', 'title', '17', '', '标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1503', 'litpic', '17', '', '缩略图', 'img', 'varchar(250)', '250', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1255', 'total_price', '17', '', '租金', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763460', '0');
INSERT INTO `eju_channelfield` VALUES ('1256', 'area', '17', '', '面积', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763502', '0');
INSERT INTO `eju_channelfield` VALUES ('1257', 'average_price', '17', '', '均价，根据面积何总价自动计算获得', 'float', 'float(9,2)', '9', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1586763536', '0');
INSERT INTO `eju_channelfield` VALUES ('1258', 'fitment', '17', '', '装修', 'select', 'enum(\'毛坯\',\'简装\',\'精装\',\'豪装\',\'\')', '0', '毛坯,简装,精装,豪装', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585046126', '0');
INSERT INTO `eju_channelfield` VALUES ('1502', 'is_head', '17', '', '头条（0=否，1=是）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1260', 'address', '17', '', '地址', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1261', 'lng', '17', '', '精度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1262', 'lat', '17', '', '维度', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1263', 'sale_name', '17', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1264', 'sale_phone', '17', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1265', 'phone_code', '17', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1266', 'floo_type', '17', '', '楼层', 'select', 'enum(\'低层\',\'中层\',\'高层\',\'\')', '0', '低层,中层,高层', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585046093', '0');
INSERT INTO `eju_channelfield` VALUES ('1267', 'floor_count', '17', '', '楼层数', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1583374906', '0');
INSERT INTO `eju_channelfield` VALUES ('1268', 'price_units', '17', '', '价格单位', 'select', 'enum(\'元/月\',\'元/㎡/月\',\'元/季\',\'元/年\',\'\')', '0', '元/月,元/㎡/月,元/季,元/年', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045695', '0');
INSERT INTO `eju_channelfield` VALUES ('1269', 'pay_way', '17', '', '付款方式', 'select', 'enum(\'押一付一\',\'押一付三\',\'\')', '0', '押一付一,押一付三', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045689', '0');
INSERT INTO `eju_channelfield` VALUES ('1270', 'division', '17', '', '是否可分割', 'select', 'enum(\'不可分割\',\'可分割\',\'\')', '0', '不可分割,可分割', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045684', '0');
INSERT INTO `eju_channelfield` VALUES ('1271', 'level', '17', '', '等级', 'select', 'enum(\'甲级\',\'乙级\',\'丙级\',\'丁级\',\'\')', '0', '甲级,乙级,丙级,丁级', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585046117', '0');
INSERT INTO `eju_channelfield` VALUES ('1272', 'characteristic', '17', '', '特色', 'checkbox', 'SET(\'免中介费\',\'赠免租期\',\'交通便利\',\'中心商务区\',\'地标建筑\',\'知名物业\',\'繁华商圈\',\'独栋写字楼\')', '0', '免中介费,赠免租期,交通便利,中心商务区,地标建筑,知名物业,繁华商圈,独栋写字楼', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585045712', '0');
INSERT INTO `eju_channelfield` VALUES ('1273', 'manage_type', '17', '', '类型', 'select', 'enum(\'纯写字楼\',\'商业综合体\',\'酒店写字楼\',\'\')', '0', '纯写字楼,商业综合体,酒店写字楼', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374906', '1585046113', '0');
INSERT INTO `eju_channelfield` VALUES ('1274', 'is_moods', '11', '', '人气', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1583374962', '1583374962', '0');
INSERT INTO `eju_channelfield` VALUES ('1275', 'is_sale', '11', '', '特价', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1583374962', '1583374962', '0');
INSERT INTO `eju_channelfield` VALUES ('1276', 'panoram', '11', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1583374963', '1583374963', '0');
INSERT INTO `eju_channelfield` VALUES ('1277', 'is_houtai', '11', '', '是否为后台（0：会员自定义）', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1583374963', '1583374963', '0');
INSERT INTO `eju_channelfield` VALUES ('1278', 'add_type', '9', '', '1：主动添加，0：关联自动生成', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045009', '1585045009', '0');
INSERT INTO `eju_channelfield` VALUES ('1279', 'relate', '9', '', '关联经纪人id集合', 'text', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045009', '1585045009', '0');
INSERT INTO `eju_channelfield` VALUES ('1280', 'is_moods', '9', '', '人气', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045009', '1585045009', '0');
INSERT INTO `eju_channelfield` VALUES ('1281', 'is_sale', '9', '', '特价', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045009', '1585045009', '0');
INSERT INTO `eju_channelfield` VALUES ('1282', 'panoram', '9', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1585045009', '1585045009', '0');
INSERT INTO `eju_channelfield` VALUES ('1283', 'video', '9', '', '楼盘视频', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1585045009', '1585045009', '0');
INSERT INTO `eju_channelfield` VALUES ('1284', 'add_type', '10', '', '1：主动添加，0：关联自动生成', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045075', '1585045075', '0');
INSERT INTO `eju_channelfield` VALUES ('1285', 'show_time', '10', '', '置顶时间', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045075', '1585045075', '0');
INSERT INTO `eju_channelfield` VALUES ('1286', 'relate', '10', '', '关联经纪人id集合', 'text', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045075', '1585045075', '0');
INSERT INTO `eju_channelfield` VALUES ('1287', 'users_id', '10', '', '所属经纪人id', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045075', '1585045075', '0');
INSERT INTO `eju_channelfield` VALUES ('1288', 'is_moods', '10', '', '人气', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045075', '1585045075', '0');
INSERT INTO `eju_channelfield` VALUES ('1289', 'is_sale', '10', '', '特价', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045075', '1585045075', '0');
INSERT INTO `eju_channelfield` VALUES ('1290', 'add_type', '11', '', '1：主动添加，0：关联自动生成', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045079', '1585045079', '0');
INSERT INTO `eju_channelfield` VALUES ('1291', 'relate', '11', '', '关联经纪人id集合', 'text', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045079', '1585045079', '0');
INSERT INTO `eju_channelfield` VALUES ('1292', 'add_type', '12', '', '1：主动添加，0：关联自动生成', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1293', 'show_time', '12', '', '置顶时间', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1294', 'relate', '12', '', '关联经纪人id集合', 'text', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1295', 'users_id', '12', '', '所属经纪人id', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1296', 'is_moods', '12', '', '人气', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1297', 'is_sale', '12', '', '特价', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1298', 'panoram', '12', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1585045119', '1585045119', '0');
INSERT INTO `eju_channelfield` VALUES ('1301', 'show_time', '13', '', '置顶时间', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1302', 'relate', '13', '', '关联经纪人id集合', 'text', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1303', 'users_id', '13', '', '所属经纪人id', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1304', 'is_moods', '13', '', '人气', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1305', 'is_sale', '13', '', '特价', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1306', 'panoram', '13', '', '全景相册', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1585045205', '1585045205', '0');
INSERT INTO `eju_channelfield` VALUES ('1379', 'property_fee', '15', '', '物业费', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1399', 'diy_sfzc', '16', '', '是否可注册', 'select', 'enum(\'可注册\',\'不可注册\',\'暂无数据\',\'\')', '0', '可注册,不可注册,暂无数据,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1411', 'diy_sfzc', '17', '', '是否可注册', 'select', 'enum(\'可注册\',\'不可注册\',\'暂无数据\',\'\')', '0', '可注册,不可注册,暂无数据,', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1410', 'diy_gws', '17', '', '工位数', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '0', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1492', 'arcrank', '17', '', '阅读权限：0=开放浏览，-1=待审核稿件', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1493', 'click', '17', '', '浏览量', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1425', 'price_min', '18', '', '租金下限', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1419', 'sale_name', '18', '', '联系人', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1420', 'sale_phone', '18', '', '联系电话', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1421', 'phone_code', '18', '', '号码转码', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1422', 'area_min', '18', '', '面积下限', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1423', 'area_max', '18', '', '面积上限', 'float', 'float(9,2)', '9', '0.00', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1424', 'price_type', '18', '', '租金类型', 'select', 'enum(\'月租金\',\'日租金\',\'\')', '0', '月租金,日租金,', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1491', 'jumplinks', '17', '', '外链跳转', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1489', 'seo_title', '17', '', 'SEO标题', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1490', 'ismake', '17', '', '是否静态页面（0=动态，1=静态）', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1488', 'seo_keywords', '17', '', 'SEO关键词', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1487', 'seo_description', '17', '', 'SEO描述', 'multitext', 'text', '0', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1486', 'users_price', '17', '', '会员价', 'decimal', 'decimal(10,2)', '10', '0.00', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1484', 'tempview', '17', '', '文档模板文件名', 'text', 'varchar(200)', '200', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1485', 'prom_type', '17', '', '产品类型：0普通产品，1虚拟产品', 'switch', 'tinyint(1) unsigned', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1482', 'sort_order', '17', '', '排序号', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1483', 'status', '17', '', '状态(0=屏蔽，1=正常)', 'switch', 'tinyint(1)', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1481', 'admin_id', '17', '', '管理员ID', 'int', 'int(10)', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1480', 'is_del', '17', '', '伪删除，1=是，0=否', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1478', 'add_time', '17', '', '新增时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1479', 'del_method', '17', '', '伪删除状态，1为主动删除，2为跟随上级栏目被动删除', 'switch', 'tinyint(1)', '1', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1477', 'update_time', '17', '', '更新时间', 'datetime', 'int(11)', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1476', 'province_id', '17', '', '省份', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1475', 'city_id', '17', '', '所在城市', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1474', 'area_id', '17', '', '所在区域', 'int', 'int(10) unsigned', '10', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1473', 'users_id', '17', '', '所属经纪人id', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1427', 'manage_type', '18', '', '经营类型', 'select', 'enum(\'休闲娱乐\',\'酒楼餐饮\',\'\')', '0', '休闲娱乐,酒楼餐饮,', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1428', 'shop_type', '18', '', '商铺类型', 'select', 'enum(\'店铺\',\'档口\',\'摊位\',\'\')', '0', '店铺,档口,摊位,', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1429', 'price_units', '18', '', '租金单位', 'select', 'enum(\'元/日.㎡\',\'元/月\',\'\')', '0', '元/日.㎡,元/月,', '', '', '0', '0', '1', '0', '1', '2', '0', '100', '1', '1589273454', '1589273454', '0');
INSERT INTO `eju_channelfield` VALUES ('1471', 'show_time', '17', '', '置顶时间', 'datetime', 'int(11) unsigned', '11', '0', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1472', 'relate', '17', '', '关联经纪人id集合', 'text', 'varchar(20)', '20', '', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');
INSERT INTO `eju_channelfield` VALUES ('1470', 'add_type', '17', '', '1：主动添加，0：关联自动生成', 'switch', 'tinyint(1) unsigned', '1', '1', '', '', '0', '0', '1', '0', '1', '1', '1', '100', '1', '1589274504', '1589274504', '0');

-- -----------------------------
-- Table structure for `eju_channelfield_bind`
-- -----------------------------
DROP TABLE IF EXISTS `eju_channelfield_bind`;
CREATE TABLE `eju_channelfield_bind` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `typeid` int(10) DEFAULT '0' COMMENT '栏目ID',
  `field_id` int(10) DEFAULT '0' COMMENT '自定义字段ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型，1：筛选，2：排序',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COMMENT='栏目与自定义字段绑定表';

-- -----------------------------
-- Records of `eju_channelfield_bind`
-- -----------------------------
INSERT INTO `eju_channelfield_bind` VALUES ('1', '0', '27', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('2', '0', '29', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('3', '0', '167', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('4', '0', '168', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('5', '0', '242', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('6', '0', '249', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('7', '0', '250', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('8', '0', '251', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('34', '0', '253', '1', '1570775854', '1570775854');
INSERT INTO `eju_channelfield_bind` VALUES ('10', '0', '255', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('11', '0', '257', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('12', '0', '261', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('13', '0', '262', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('14', '0', '264', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('69', '0', '265', '1', '1574939953', '1574939953');
INSERT INTO `eju_channelfield_bind` VALUES ('68', '0', '266', '1', '1574939941', '1574939941');
INSERT INTO `eju_channelfield_bind` VALUES ('67', '0', '267', '1', '1574939923', '1574939923');
INSERT INTO `eju_channelfield_bind` VALUES ('66', '0', '268', '1', '1574939910', '1574939910');
INSERT INTO `eju_channelfield_bind` VALUES ('19', '0', '269', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('65', '0', '270', '1', '1574939899', '1574939899');
INSERT INTO `eju_channelfield_bind` VALUES ('21', '0', '271', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('64', '0', '273', '1', '1574939884', '1574939884');
INSERT INTO `eju_channelfield_bind` VALUES ('23', '0', '274', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('24', '0', '275', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('25', '0', '276', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('26', '0', '277', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('27', '0', '288', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('28', '0', '291', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('29', '0', '292', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('30', '0', '293', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('31', '0', '327', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('32', '0', '328', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('33', '0', '508', '1', '1570767798', '1570767798');
INSERT INTO `eju_channelfield_bind` VALUES ('35', '0', '460', '1', '1570775995', '1570775995');
INSERT INTO `eju_channelfield_bind` VALUES ('39', '10', '584', '1', '1572485895', '1572485895');
INSERT INTO `eju_channelfield_bind` VALUES ('88', '10', '578', '1', '1585045110', '1585045110');
INSERT INTO `eju_channelfield_bind` VALUES ('87', '10', '579', '1', '1585045103', '1585045103');
INSERT INTO `eju_channelfield_bind` VALUES ('99', '0', '626', '1', '1585045197', '1585045197');
INSERT INTO `eju_channelfield_bind` VALUES ('116', '0', '684', '1', '1585045326', '1585045326');
INSERT INTO `eju_channelfield_bind` VALUES ('96', '11', '629', '1', '1585045175', '1585045175');
INSERT INTO `eju_channelfield_bind` VALUES ('113', '12', '687', '1', '1585045301', '1585045301');
INSERT INTO `eju_channelfield_bind` VALUES ('169', '10', '577', '1', '1586762999', '1586762999');
INSERT INTO `eju_channelfield_bind` VALUES ('103', '12', '699', '1', '1585045231', '1585045231');
INSERT INTO `eju_channelfield_bind` VALUES ('173', '12', '682', '1', '1586763113', '1586763113');
INSERT INTO `eju_channelfield_bind` VALUES ('171', '11', '624', '1', '1586763057', '1586763057');
INSERT INTO `eju_channelfield_bind` VALUES ('70', '0', '569', '1', '1574939993', '1574939993');
INSERT INTO `eju_channelfield_bind` VALUES ('71', '0', '567', '1', '1574940004', '1574940004');
INSERT INTO `eju_channelfield_bind` VALUES ('72', '0', '566', '1', '1574940015', '1574940015');
INSERT INTO `eju_channelfield_bind` VALUES ('73', '0', '564', '1', '1574940028', '1574940028');
INSERT INTO `eju_channelfield_bind` VALUES ('74', '0', '574', '1', '1583375002', '1583375002');
INSERT INTO `eju_channelfield_bind` VALUES ('75', '0', '573', '1', '1583375007', '1583375007');
INSERT INTO `eju_channelfield_bind` VALUES ('85', '10', '585', '1', '1585045087', '1585045087');
INSERT INTO `eju_channelfield_bind` VALUES ('79', '1', '258', '1', '1585045017', '1585045017');
INSERT INTO `eju_channelfield_bind` VALUES ('80', '1', '272', '1', '1585045023', '1585045023');
INSERT INTO `eju_channelfield_bind` VALUES ('81', '1', '503', '1', '1585045033', '1585045033');
INSERT INTO `eju_channelfield_bind` VALUES ('82', '1', '502', '1', '1585045050', '1585045050');
INSERT INTO `eju_channelfield_bind` VALUES ('83', '1', '463', '1', '1585045057', '1585045057');
INSERT INTO `eju_channelfield_bind` VALUES ('84', '1', '284', '1', '1585045066', '1585045066');
INSERT INTO `eju_channelfield_bind` VALUES ('86', '0', '583', '1', '1585045095', '1585045095');
INSERT INTO `eju_channelfield_bind` VALUES ('89', '0', '623', '1', '1585045124', '1585045124');
INSERT INTO `eju_channelfield_bind` VALUES ('90', '0', '642', '1', '1585045132', '1585045132');
INSERT INTO `eju_channelfield_bind` VALUES ('91', '0', '634', '1', '1585045141', '1585045141');
INSERT INTO `eju_channelfield_bind` VALUES ('92', '0', '633', '1', '1585045147', '1585045147');
INSERT INTO `eju_channelfield_bind` VALUES ('93', '0', '632', '1', '1585045153', '1585045153');
INSERT INTO `eju_channelfield_bind` VALUES ('94', '0', '631', '1', '1585045159', '1585045159');
INSERT INTO `eju_channelfield_bind` VALUES ('95', '0', '630', '1', '1585045167', '1585045167');
INSERT INTO `eju_channelfield_bind` VALUES ('97', '0', '628', '1', '1585045183', '1585045183');
INSERT INTO `eju_channelfield_bind` VALUES ('98', '0', '627', '1', '1585045190', '1585045190');
INSERT INTO `eju_channelfield_bind` VALUES ('100', '0', '681', '1', '1585045210', '1585045210');
INSERT INTO `eju_channelfield_bind` VALUES ('101', '0', '704', '1', '1585045218', '1585045218');
INSERT INTO `eju_channelfield_bind` VALUES ('102', '0', '700', '1', '1585045225', '1585045225');
INSERT INTO `eju_channelfield_bind` VALUES ('105', '0', '698', '1', '1585045244', '1585045244');
INSERT INTO `eju_channelfield_bind` VALUES ('106', '0', '697', '1', '1585045250', '1585045250');
INSERT INTO `eju_channelfield_bind` VALUES ('107', '0', '692', '1', '1585045259', '1585045259');
INSERT INTO `eju_channelfield_bind` VALUES ('108', '0', '691', '1', '1585045266', '1585045266');
INSERT INTO `eju_channelfield_bind` VALUES ('109', '0', '690', '1', '1585045274', '1585045274');
INSERT INTO `eju_channelfield_bind` VALUES ('111', '0', '689', '1', '1585045288', '1585045288');
INSERT INTO `eju_channelfield_bind` VALUES ('112', '0', '688', '1', '1585045295', '1585045295');
INSERT INTO `eju_channelfield_bind` VALUES ('114', '0', '686', '1', '1585045308', '1585045308');
INSERT INTO `eju_channelfield_bind` VALUES ('115', '0', '685', '1', '1585045317', '1585045317');
INSERT INTO `eju_channelfield_bind` VALUES ('117', '0', '1044', '1', '1585045372', '1585045372');
INSERT INTO `eju_channelfield_bind` VALUES ('118', '0', '1038', '1', '1585045381', '1585045381');
INSERT INTO `eju_channelfield_bind` VALUES ('119', '0', '1065', '1', '1585045388', '1585045388');
INSERT INTO `eju_channelfield_bind` VALUES ('120', '0', '1064', '1', '1585045395', '1585045395');
INSERT INTO `eju_channelfield_bind` VALUES ('121', '0', '1062', '1', '1585045405', '1585045405');
INSERT INTO `eju_channelfield_bind` VALUES ('122', '0', '1054', '1', '1585045413', '1585045413');
INSERT INTO `eju_channelfield_bind` VALUES ('124', '0', '1053', '1', '1585045447', '1585045447');
INSERT INTO `eju_channelfield_bind` VALUES ('125', '0', '1052', '1', '1585045454', '1585045454');
INSERT INTO `eju_channelfield_bind` VALUES ('126', '0', '1113', '1', '1585045472', '1585045472');
INSERT INTO `eju_channelfield_bind` VALUES ('127', '0', '1112', '1', '1585045478', '1585045478');
INSERT INTO `eju_channelfield_bind` VALUES ('128', '0', '1111', '1', '1585045484', '1585045484');
INSERT INTO `eju_channelfield_bind` VALUES ('129', '0', '1110', '1', '1585045489', '1585045489');
INSERT INTO `eju_channelfield_bind` VALUES ('130', '0', '1107', '1', '1585045498', '1585045498');
INSERT INTO `eju_channelfield_bind` VALUES ('131', '0', '1138', '1', '1585045505', '1585045505');
INSERT INTO `eju_channelfield_bind` VALUES ('132', '0', '1137', '1', '1585045512', '1585045512');
INSERT INTO `eju_channelfield_bind` VALUES ('133', '0', '1136', '1', '1585045519', '1585045519');
INSERT INTO `eju_channelfield_bind` VALUES ('134', '0', '1135', '1', '1585045525', '1585045525');
INSERT INTO `eju_channelfield_bind` VALUES ('135', '0', '1134', '1', '1585045532', '1585045532');
INSERT INTO `eju_channelfield_bind` VALUES ('136', '0', '1132', '1', '1585045541', '1585045541');
INSERT INTO `eju_channelfield_bind` VALUES ('137', '0', '1124', '1', '1585045550', '1585045550');
INSERT INTO `eju_channelfield_bind` VALUES ('140', '0', '1123', '1', '1585045575', '1585045575');
INSERT INTO `eju_channelfield_bind` VALUES ('139', '0', '1122', '1', '1585045569', '1585045569');
INSERT INTO `eju_channelfield_bind` VALUES ('141', '0', '1186', '1', '1585045585', '1585045585');
INSERT INTO `eju_channelfield_bind` VALUES ('142', '0', '1183', '1', '1585045590', '1585045590');
INSERT INTO `eju_channelfield_bind` VALUES ('143', '0', '1204', '1', '1585045596', '1585045596');
INSERT INTO `eju_channelfield_bind` VALUES ('144', '0', '1203', '1', '1585045601', '1585045601');
INSERT INTO `eju_channelfield_bind` VALUES ('145', '0', '1201', '1', '1585045605', '1585045605');
INSERT INTO `eju_channelfield_bind` VALUES ('146', '0', '1193', '1', '1585045613', '1585045613');
INSERT INTO `eju_channelfield_bind` VALUES ('147', '0', '1192', '1', '1585045621', '1585045621');
INSERT INTO `eju_channelfield_bind` VALUES ('149', '0', '1191', '1', '1585045651', '1585045651');
INSERT INTO `eju_channelfield_bind` VALUES ('150', '0', '1253', '1', '1585045658', '1585045658');
INSERT INTO `eju_channelfield_bind` VALUES ('151', '0', '1249', '1', '1585045665', '1585045665');
INSERT INTO `eju_channelfield_bind` VALUES ('163', '0', '1273', '1', '1585046113', '1585046113');
INSERT INTO `eju_channelfield_bind` VALUES ('160', '0', '1272', '1', '1585045712', '1585045712');
INSERT INTO `eju_channelfield_bind` VALUES ('164', '0', '1271', '1', '1585046117', '1585046117');
INSERT INTO `eju_channelfield_bind` VALUES ('155', '0', '1270', '1', '1585045684', '1585045684');
INSERT INTO `eju_channelfield_bind` VALUES ('156', '0', '1269', '1', '1585045689', '1585045689');
INSERT INTO `eju_channelfield_bind` VALUES ('157', '0', '1268', '1', '1585045695', '1585045695');
INSERT INTO `eju_channelfield_bind` VALUES ('162', '0', '1266', '1', '1585046093', '1585046093');
INSERT INTO `eju_channelfield_bind` VALUES ('165', '0', '1258', '1', '1585046126', '1585046126');
INSERT INTO `eju_channelfield_bind` VALUES ('166', '0', '287', '1', '1586762747', '1586762747');
INSERT INTO `eju_channelfield_bind` VALUES ('167', '1', '246', '1', '1586762784', '1586762784');
INSERT INTO `eju_channelfield_bind` VALUES ('168', '0', '245', '1', '1586762816', '1586762816');
INSERT INTO `eju_channelfield_bind` VALUES ('170', '0', '625', '1', '1586763037', '1586763037');
INSERT INTO `eju_channelfield_bind` VALUES ('172', '0', '683', '1', '1586763096', '1586763096');
INSERT INTO `eju_channelfield_bind` VALUES ('174', '0', '1051', '1', '1586763232', '1586763232');
INSERT INTO `eju_channelfield_bind` VALUES ('175', '0', '1049', '1', '1586763249', '1586763249');
INSERT INTO `eju_channelfield_bind` VALUES ('176', '0', '1050', '1', '1586763268', '1586763268');
INSERT INTO `eju_channelfield_bind` VALUES ('177', '0', '1119', '1', '1586763296', '1586763296');
INSERT INTO `eju_channelfield_bind` VALUES ('178', '0', '1120', '1', '1586763314', '1586763314');
INSERT INTO `eju_channelfield_bind` VALUES ('179', '0', '1121', '1', '1586763333', '1586763333');
INSERT INTO `eju_channelfield_bind` VALUES ('180', '0', '1188', '1', '1586763362', '1586763362');
INSERT INTO `eju_channelfield_bind` VALUES ('181', '0', '1189', '1', '1586763381', '1586763381');
INSERT INTO `eju_channelfield_bind` VALUES ('182', '0', '1190', '1', '1586763403', '1586763403');
INSERT INTO `eju_channelfield_bind` VALUES ('183', '0', '1255', '1', '1586763461', '1586763461');
INSERT INTO `eju_channelfield_bind` VALUES ('184', '0', '1256', '1', '1586763503', '1586763503');
INSERT INTO `eju_channelfield_bind` VALUES ('185', '0', '1257', '1', '1586763536', '1586763536');
INSERT INTO `eju_channelfield_bind` VALUES ('186', '0', '1406', '1', '1589274503', '1589274503');

-- -----------------------------
-- Table structure for `eju_channeltype`
-- -----------------------------
DROP TABLE IF EXISTS `eju_channeltype`;
CREATE TABLE `eju_channeltype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` varchar(50) NOT NULL DEFAULT '' COMMENT '识别id',
  `title` varchar(30) DEFAULT '' COMMENT '名称',
  `ntitle` varchar(30) DEFAULT '' COMMENT '左侧菜单名称',
  `table` varchar(50) DEFAULT '' COMMENT '表名',
  `ctl_name` varchar(50) DEFAULT '' COMMENT '控制器名称（区分大小写）',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(1=启用，0=屏蔽)',
  `ifsystem` tinyint(1) DEFAULT '0' COMMENT '字段分类，1=系统(不可修改)，0=自定义',
  `is_repeat_title` tinyint(1) DEFAULT '1' COMMENT '文档标题重复，1=允许，0=不允许',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `sort_order` smallint(6) DEFAULT '100' COMMENT '排序',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `join_id` int(10) unsigned DEFAULT '0' COMMENT '关联模型id',
  `is_join_user` tinyint(3) unsigned DEFAULT '0' COMMENT '是否关联经纪人',
  `join_must` tinyint(3) unsigned DEFAULT '0' COMMENT '是否必须填写关联内容',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idention` (`nid`) USING BTREE,
  UNIQUE KEY `ctl_name` (`ctl_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='系统模型表';

-- -----------------------------
-- Records of `eju_channeltype`
-- -----------------------------
INSERT INTO `eju_channeltype` VALUES ('1', 'article', '资讯模型', '资讯', 'article', 'Article', '1', '1', '1', '0', '30', '1523091961', '1569036187', '9', '0', '0');
INSERT INTO `eju_channeltype` VALUES ('6', 'single', '单页模型', '单页', 'single', 'Single', '1', '1', '1', '0', '50', '1523091961', '1568948101', '0', '0', '0');
INSERT INTO `eju_channeltype` VALUES ('9', 'xinfang', '新房模型', '新房', 'xinfang', 'Xinfang', '1', '1', '1', '0', '10', '1562052280', '1570844357', '0', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('10', 'tuan', '团购模型', '团购', 'tuan', 'Tuan', '1', '1', '1', '0', '20', '1562229347', '1586764509', '9', '0', '1');
INSERT INTO `eju_channeltype` VALUES ('11', 'xiaoqu', '小区模型', '小区', 'xiaoqu', 'Xiaoqu', '1', '1', '1', '0', '100', '1571023592', '1571023592', '0', '0', '0');
INSERT INTO `eju_channeltype` VALUES ('12', 'ershou', '二手房模型', '二手房', 'ershou', 'Ershou', '1', '1', '1', '0', '100', '1571023592', '1586764482', '0', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('13', 'zufang', '租房模型', '租房', 'zufang', 'Zufang', '1', '1', '1', '0', '100', '1571023592', '1586764496', '0', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('14', 'shopcs', '商铺出售模型', '商铺出售', 'shopcs', 'Shopcs', '1', '1', '1', '0', '100', '1571023592', '1571023592', '11', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('15', 'shopcz', '商铺出租模型', '商铺出租', 'shopcz', 'Shopcz', '1', '1', '1', '0', '100', '1571023592', '1571023592', '11', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('16', 'officecs', '写字楼出售模型', '写字楼出售', 'officecs', 'Officecs', '1', '1', '1', '0', '100', '1571023592', '1571023592', '11', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('17', 'officecz', '写字楼出租模型', '写字楼出租', 'officecz', 'Officecz', '1', '1', '1', '0', '100', '1571023592', '1571023592', '11', '1', '0');
INSERT INTO `eju_channeltype` VALUES ('18', 'qiuzu', '求租模型', '求租', 'qiuzu', 'Qiuzu', '1', '1', '1', '1', '100', '1571023592', '1571023592', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_common_pic`
-- -----------------------------
DROP TABLE IF EXISTS `eju_common_pic`;
CREATE TABLE `eju_common_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '常用图片ID',
  `pic_path` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='常用图片';

-- -----------------------------
-- Records of `eju_common_pic`
-- -----------------------------
INSERT INTO `eju_common_pic` VALUES ('1', '/uploads/allimg/20191011/1-191011103FH63.jpg', '1586915447', '1586915447');

-- -----------------------------
-- Table structure for `eju_config`
-- -----------------------------
DROP TABLE IF EXISTS `eju_config`;
CREATE TABLE `eju_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '' COMMENT '配置的key键名',
  `value` text,
  `inc_type` varchar(64) DEFAULT '' COMMENT '配置分组',
  `desc` varchar(50) DEFAULT '' COMMENT '描述',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '是否已删除，0=否，1=是',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  PRIMARY KEY (`id`),
  KEY `inc_type` (`inc_type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=277 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- -----------------------------
-- Records of `eju_config`
-- -----------------------------
INSERT INTO `eju_config` VALUES ('1', 'is_mark', '0', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('2', 'mark_txt', '易优Cms', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('3', 'mark_img', '/uploads/allimg/20190114/f0d5e5830502125f5077212a90ef3a33.png', 'water', '', '0', '1547463466', '0');
INSERT INTO `eju_config` VALUES ('4', 'mark_width', '200', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('5', 'mark_height', '50', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('6', 'mark_degree', '54', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('7', 'mark_quality', '56', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('8', 'mark_sel', '9', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('9', 'sms_time_out', '120', 'sms', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('10', 'theme_style', '1', 'basic', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('11', 'file_size', '2', 'basic', '', '0', '1568967582', '0');
INSERT INTO `eju_config` VALUES ('12', 'image_type', 'jpg|gif|png|bmp|jpeg|ico', 'basic', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('13', 'file_type', 'zip|gz|rar|iso|doc|xsl|ppt|wps', 'basic', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('14', 'media_type', 'swf|mpg|mp3|rm|rmvb|wmv|wma|wav|mid|mov|mp4', 'basic', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('15', 'web_keywords', '', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('17', 'sms_platform', '1', 'sms', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('18', 'seo_viewtitle_format', '2', 'seo', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('24', 'mark_type', 'img', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('25', 'mark_txt_size', '30', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('26', 'mark_txt_color', '#000000', 'water', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('27', 'oss_switch', '0', 'oss', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('28', 'web_name', '易居房产系统', 'web', '', '0', '1570844060', '0');
INSERT INTO `eju_config` VALUES ('29', 'web_logo', '/uploads/allimg/20191011/1-191011115322C1.png', 'web', '', '0', '1570766005', '0');
INSERT INTO `eju_config` VALUES ('30', 'web_ico', '/favicon.ico', 'web', '', '0', '1568962123', '0');
INSERT INTO `eju_config` VALUES ('31', 'web_basehost', 'http://www.meiz22.hk', 'web', '', '0', '1569722591', '0');
INSERT INTO `eju_config` VALUES ('32', 'web_description', '', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('33', 'web_copyright', 'Copyright © 2012-2018 易居CMS 版权所有', 'web', '', '0', '1570843964', '0');
INSERT INTO `eju_config` VALUES ('34', 'web_thirdcode_pc', '', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('35', 'web_thirdcode_wap', '', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('39', 'seo_arcdir', '/html', 'seo', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('40', 'seo_pseudo', '1', 'seo', '', '0', '1570784691', '0');
INSERT INTO `eju_config` VALUES ('41', 'list_symbol', '&gt;', 'basic', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('42', 'sitemap_auto', '1', 'sitemap', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('43', 'sitemap_not1', '0', 'sitemap', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('44', 'sitemap_not2', '1', 'sitemap', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('45', 'sitemap_xml', '1', 'sitemap', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('46', 'sitemap_txt', '0', 'sitemap', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('47', 'sitemap_zzbaidutoken', '', 'sitemap', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('48', 'seo_expires_in', '7200', 'seo', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('55', 'web_title', '易居房产系统', 'web', '', '0', '1570844060', '0');
INSERT INTO `eju_config` VALUES ('57', 'web_authortoken', '', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('62', 'seo_inlet', '1', 'seo', '', '0', '1569719545', '0');
INSERT INTO `eju_config` VALUES ('63', 'web_cmspath', '', 'web', '', '0', '1568962212', '0');
INSERT INTO `eju_config` VALUES ('64', 'web_sqldatapath', '/data/sqldata', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('65', 'web_cmsurl', '', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('66', 'web_templets_dir', '/template/default', 'web', '', '0', '1566469690', '0');
INSERT INTO `eju_config` VALUES ('67', 'web_templeturl', '/template/default', 'web', '', '0', '1566469690', '0');
INSERT INTO `eju_config` VALUES ('68', 'web_templets_pc', '/template/default/pc', 'web', '', '0', '1566469690', '0');
INSERT INTO `eju_config` VALUES ('69', 'web_templets_m', '/template/default/mobile', 'web', '', '0', '1566469690', '0');
INSERT INTO `eju_config` VALUES ('70', 'web_ejucms', 'http://www.ejucms.com', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('76', 'seo_liststitle_format', '2', 'seo', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('77', 'web_status', '1', 'web', '', '0', '1570760871', '0');
INSERT INTO `eju_config` VALUES ('78', '_cmscopyright', 'ek8wPtsFKdp81rz4nt2l9Nag', 'php', '', '0', '1577262901', '0');
INSERT INTO `eju_config` VALUES ('79', 'web_recordnum', '琼ICP备xxxxxxxx号', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('80', 'web_is_authortoken', '-1', 'web', '', '0', '1589271711', '0');
INSERT INTO `eju_config` VALUES ('81', 'web_adminbasefile', '/login.php', 'web', '', '0', '1571217410', '0');
INSERT INTO `eju_config` VALUES ('82', 'seo_rewrite_format', '1', 'seo', '', '0', '1571877572', '0');
INSERT INTO `eju_config` VALUES ('83', 'web_cmsmode', '0', 'web', '', '0', '1572854321', '0');
INSERT INTO `eju_config` VALUES ('84', 'web_htmlcache_expires_in', '0', 'web', '', '0', '1546477337', '0');
INSERT INTO `eju_config` VALUES ('85', 'web_show_popup_upgrade', '0', 'web', '', '0', '1569662660', '0');
INSERT INTO `eju_config` VALUES ('86', 'web_weapp_switch', '1', 'web', '', '0', '1561383057', '0');
INSERT INTO `eju_config` VALUES ('88', 'seo_dynamic_format', '1', 'seo', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('89', 'system_sql_mode', 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION', 'system', '', '0', '1583374721', '0');
INSERT INTO `eju_config` VALUES ('170', 'web_exception', '0', 'web', '', '0', '1546477337', '0');
INSERT INTO `eju_config` VALUES ('174', 'web_is_https', '0', 'web', '', '0', '1552968816', '0');
INSERT INTO `eju_config` VALUES ('176', 'smtp_syn_weapp', '1', 'smtp', '', '0', '1553566547', '0');
INSERT INTO `eju_config` VALUES ('178', 'php_eyou_blacklist', '', 'php', '', '0', '1553654429', '0');
INSERT INTO `eju_config` VALUES ('190', 'system_auth_code', 'Res3P83GfQCuOsZSsQEz', 'system', '', '0', '1557462848', '0');
INSERT INTO `eju_config` VALUES ('192', 'system_upgrade_filelist', 'YXBwbGljYXRpb24vY29tbW9uL21vZGVsL0FyY3R5cGUucGhwPGJyPmFwcGxpY2F0aW9uL2NvbW1vbi9tb2RlbC9Vc2Vycy5waHA8YnI+YXBwbGljYXRpb24vdXNlci9jb21tb24ucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvY29udHJvbGxlci9PZmZpY2Vjei5waHA8YnI+YXBwbGljYXRpb24vdXNlci9jb250cm9sbGVyL0FyY2hpdmVzLnBocDxicj5hcHBsaWNhdGlvbi91c2VyL2NvbnRyb2xsZXIvQXJ0aWNsZS5waHA8YnI+YXBwbGljYXRpb24vdXNlci9jb250cm9sbGVyL1R1YW4ucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvY29udHJvbGxlci9TaG9wY3oucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvY29udHJvbGxlci9PZmZpY2Vjcy5waHA8YnI+YXBwbGljYXRpb24vdXNlci9jb250cm9sbGVyL1Nob3Bjcy5waHA8YnI+YXBwbGljYXRpb24vdXNlci9jb250cm9sbGVyL1hpbmZhbmcucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvY29udHJvbGxlci9FcnNob3UucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvY29udHJvbGxlci9adWZhbmcucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvY29udHJvbGxlci9Vc2Vycy5waHA8YnI+YXBwbGljYXRpb24vdXNlci9jb250cm9sbGVyL1hpYW9xdS5waHA8YnI+YXBwbGljYXRpb24vdXNlci9sb2dpYy9DaGFubmVsTG9naWMucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvbW9kZWwvT2ZmaWNlY3oucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvbW9kZWwvQXJ0aWNsZS5waHA8YnI+YXBwbGljYXRpb24vdXNlci9tb2RlbC9UdWFuLnBocDxicj5hcHBsaWNhdGlvbi91c2VyL21vZGVsL1Nob3Bjei5waHA8YnI+YXBwbGljYXRpb24vdXNlci9tb2RlbC9PZmZpY2Vjcy5waHA8YnI+YXBwbGljYXRpb24vdXNlci9tb2RlbC9TaG9wY3MucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvbW9kZWwvWGluZmFuZy5waHA8YnI+YXBwbGljYXRpb24vdXNlci9tb2RlbC9FcnNob3UucGhwPGJyPmFwcGxpY2F0aW9uL3VzZXIvbW9kZWwvWnVmYW5nLnBocDxicj5hcHBsaWNhdGlvbi91c2VyL21vZGVsL1VzZXJzLnBocDxicj5hcHBsaWNhdGlvbi91c2VyL21vZGVsL1hpYW9xdS5waHA8YnI+YXBwbGljYXRpb24vY29tbW9uLnBocDxicj5hcHBsaWNhdGlvbi9mdW5jdGlvbi5waHA8YnI+YXBwbGljYXRpb24vYXBpL2NvbnRyb2xsZXIvQWpheC5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vY29tbW9uLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0ZpZWxkLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL09mZmljZWN6LnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0FkbWluLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0FyY2hpdmVzLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0FydGljbGUucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL2NvbnRyb2xsZXIvVHVhbi5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vY29udHJvbGxlci9TaG9wY3oucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL2NvbnRyb2xsZXIvU2luZ2xlLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL09mZmljZWNzLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0Zvcm0ucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL2NvbnRyb2xsZXIvU2hvcGNzLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0luZGV4LnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL0NoYW5uZWx0eXBlLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL1N5c3RlbS5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vY29udHJvbGxlci9DdXN0b20ucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL2NvbnRyb2xsZXIvVG9vbHMucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL2NvbnRyb2xsZXIvWGluZmFuZy5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vY29udHJvbGxlci9FcnNob3UucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL2NvbnRyb2xsZXIvWnVmYW5nLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL1VzZXJzLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9jb250cm9sbGVyL1hpYW9xdS5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vbG9naWMvRmllbGRMb2dpYy5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vbW9kZWwvRmllbGQucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL21vZGVsL09mZmljZWN6LnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9tb2RlbC9BcnRpY2xlLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9tb2RlbC9UdWFuLnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9tb2RlbC9TaG9wY3oucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL21vZGVsL1NpbmdsZS5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vbW9kZWwvT2ZmaWNlY3MucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL21vZGVsL1Nob3Bjcy5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vbW9kZWwvWGluZmFuZy5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vbW9kZWwvRXJzaG91LnBocDxicj5hcHBsaWNhdGlvbi9hZG1pbi9tb2RlbC9adWZhbmcucGhwPGJyPmFwcGxpY2F0aW9uL2FkbWluL21vZGVsL1hpYW9xdS5waHA8YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvZmllbGQvY2hhbm5lbF9pbmRleC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvc2hvcGNzL2VkaXQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3Nob3Bjcy9hZGQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3Nob3Bjcy9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvaW5kZXgvYWpheF9idXNpbmVzcy5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvaW5kZXgvd2VsY29tZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvdHVhbi9lZGl0Lmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS90dWFuL2FkZC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvdHVhbi9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvb2ZmaWNlY3MvZWRpdC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvb2ZmaWNlY3MvYWRkLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9vZmZpY2Vjcy9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvZXJzaG91L2VkaXQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL2Vyc2hvdS9hZGQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL2Vyc2hvdS9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvc2hvcGN6L2VkaXQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3Nob3Bjei9hZGQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3Nob3Bjei9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvdXNlcnMvZWRpdC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvdXNlcnMvaW5kZXguaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3VzZXJzL3NhbGVtYW5fbGlzdC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvdXNlcnMvYWpheF9zZWxlY3RfcmVsYXRlLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS94aW5mYW5nL2VkaXQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3hpbmZhbmcvYWRkLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS94aW5mYW5nL2luZGV4Lmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS94aW5mYW5nL2FqYXhfc2VsZWN0X2hvdXNlLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9vZmZpY2Vjei9lZGl0Lmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9vZmZpY2Vjei9hZGQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL29mZmljZWN6L2FqYXhfc2VsZWN0X2hvdXNlLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9zeXN0ZW0vd2ViMi5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvYXJ0aWNsZS9lZGl0Lmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9hcnRpY2xlL2FkZC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvYXJ0aWNsZS9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvYXJjaGl2ZXMvaW5kZXhfbWFuYWdlLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS96dWZhbmcvZWRpdC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvenVmYW5nL2FkZC5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUvenVmYW5nL2FqYXhfc2VsZWN0X2hvdXNlLmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9jaGFubmVsdHlwZS9lZGl0Lmh0bTxicj5hcHBsaWNhdGlvbi9hZG1pbi90ZW1wbGF0ZS9jaGFubmVsdHlwZS9hZGQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3NpbmdsZS9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vYWRtaW4vdGVtcGxhdGUveGlhb3F1L2VkaXQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3hpYW9xdS9hZGQuaHRtPGJyPmFwcGxpY2F0aW9uL2FkbWluL3RlbXBsYXRlL3hpYW9xdS9hamF4X3NlbGVjdF9ob3VzZS5odG08YnI+YXBwbGljYXRpb24vaG9tZS9jb250cm9sbGVyL1ZpZXcucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvY29udHJvbGxlci9NYXAucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvY29udHJvbGxlci9Bc2sucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvbG9naWMvVXNlcnNMb2dpbmMucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvbW9kZWwvT2ZmaWNlY3oucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvbW9kZWwvQXJ0aWNsZS5waHA8YnI+YXBwbGljYXRpb24vaG9tZS9tb2RlbC9UdWFuLnBocDxicj5hcHBsaWNhdGlvbi9ob21lL21vZGVsL1Nob3Bjei5waHA8YnI+YXBwbGljYXRpb24vaG9tZS9tb2RlbC9PZmZpY2Vjcy5waHA8YnI+YXBwbGljYXRpb24vaG9tZS9tb2RlbC9TaG9wY3MucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvbW9kZWwvWGluZmFuZy5waHA8YnI+YXBwbGljYXRpb24vaG9tZS9tb2RlbC9FcnNob3UucGhwPGJyPmFwcGxpY2F0aW9uL2hvbWUvbW9kZWwvWnVmYW5nLnBocDxicj5hcHBsaWNhdGlvbi9ob21lL21vZGVsL1hpYW9xdS5waHA8YnI+Y29yZS9saWJyYXJ5L3RoaW5rL1VybC5waHA8YnI+Y29yZS9saWJyYXJ5L3RoaW5rL0NvbnRyb2xsZXIucGhwPGJyPmNvcmUvbGlicmFyeS90aGluay90ZW1wbGF0ZS90YWdsaWIvZWp1L1RhZ0FyY3ZpZXcucGhwPGJyPmNvcmUvbGlicmFyeS90aGluay90ZW1wbGF0ZS90YWdsaWIvZWp1L1RhZ1JlZ2lvbi5waHA8YnI+Y29yZS9saWJyYXJ5L3RoaW5rL3RlbXBsYXRlL3RhZ2xpYi9lanUvVGFnR2xvYmFsLnBocDxicj5jb3JlL2xpYnJhcnkvdGhpbmsvdGVtcGxhdGUvdGFnbGliL2VqdS9UYWdMaXN0LnBocDxicj5jb3JlL2xpYnJhcnkvdGhpbmsvdGVtcGxhdGUvdGFnbGliL2VqdS9UYWdEaXl1cmwucGhwPGJyPmNvcmUvbGlicmFyeS90aGluay90ZW1wbGF0ZS90YWdsaWIvZWp1L1RhZ0FyY2xpc3QucGhwPGJyPmNvcmUvbGlicmFyeS90aGluay90ZW1wbGF0ZS90YWdsaWIvZWp1L1RhZ0Zvcm0ucGhwPGJyPmNvcmUvbGlicmFyeS90aGluay90ZW1wbGF0ZS90YWdsaWIvRWp1LnBocDxicj5kYXRhL3NjaGVtYS9lanVfYXJjaGl2ZXMucGhwPGJyPmRhdGEvc2NoZW1hL2VqdV9jaGFubmVsdHlwZS5waHA8YnI+ZGF0YS9zY2hlbWEvZWp1X3hpbmZhbmdfc2FuZC5waHA8YnI+ZGF0YS9zY2hlbWEvZWp1X3VzZXJzX2NvbnRlbnQucGhwPGJyPmRhdGEvc2NoZW1hL2VqdV91c2Vycy5waHA8YnI+ZGF0YS9jb25mL3ZlcnNpb24udHh0PGJyPnB1YmxpYy9wbHVnaW5zL2xheXVpL2Nzcy9sYXl1aS5jc3M8YnI+dGVtcGxhdGUvZGVmYXVsdC9wYy91c2Vycy9vZmZpY2Vjel9hZGQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvcGMvdXNlcnMvenVmYW5nX2VkaXQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvcGMvdXNlcnMvenVmYW5nX2FkZC5odG08YnI+dGVtcGxhdGUvZGVmYXVsdC9wYy91c2Vycy9zaG9wY3NfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L3BjL3VzZXJzL3Nob3Bjel9hZGQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvcGMvdXNlcnMvb2ZmaWNlY3NfZWRpdC5odG08YnI+dGVtcGxhdGUvZGVmYXVsdC9wYy91c2Vycy9lcnNob3VfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L3BjL3VzZXJzL3Nob3Bjel9lZGl0Lmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L3BjL3VzZXJzL2Vyc2hvdV9lZGl0Lmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L3BjL3VzZXJzL29mZmljZWN6X2VkaXQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvcGMvdXNlcnMvc2hvcGNzX2VkaXQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvcGMvdXNlcnMvb2ZmaWNlY3NfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9vZmZpY2Vjel9hZGQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvbW9iaWxlL3VzZXJzL3p1ZmFuZ19lZGl0Lmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy96dWZhbmdfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9zaG9wY3NfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9zaG9wY3pfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9vZmZpY2Vjc19lZGl0Lmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9lcnNob3VfYWRkLmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9zaG9wY3pfZWRpdC5odG08YnI+dGVtcGxhdGUvZGVmYXVsdC9tb2JpbGUvdXNlcnMvZXJzaG91X2VkaXQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvbW9iaWxlL3VzZXJzL29mZmljZWN6X2VkaXQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvbW9iaWxlL3VzZXJzL3Nob3Bjc19lZGl0Lmh0bTxicj50ZW1wbGF0ZS9kZWZhdWx0L21vYmlsZS91c2Vycy9vZmZpY2Vjc19hZGQuaHRtPGJyPnRlbXBsYXRlL2RlZmF1bHQvbW9iaWxlL3Rvb2wvYm9oYW8uaHRt', 'system', '', '0', '1585044916', '0');
INSERT INTO `eju_config` VALUES ('193', 'system_version', 'v2.4.0', 'system', '', '0', '1572340822', '0');
INSERT INTO `eju_config` VALUES ('195', 'web_users_switch', '1', 'web', '', '0', '1561383059', '0');
INSERT INTO `eju_config` VALUES ('197', 'seo_html_arcdir_limit', '/application,/core,/data,/extend,/install,/public,/template,/uploads,/vendor,/weapp', 'seo', '', '0', '1561456822', '0');
INSERT INTO `eju_config` VALUES ('198', 'seo_html_arcdir', '/html', 'seo', '', '0', '1561714582', '0');
INSERT INTO `eju_config` VALUES ('199', 'seo_html_listname', '1', 'seo', '', '0', '1561710967', '0');
INSERT INTO `eju_config` VALUES ('200', 'seo_html_pagename', '1', 'seo', '', '0', '1561389643', '0');
INSERT INTO `eju_config` VALUES ('201', 'seo_force_inlet', '1', 'seo', '', '0', '1570782456', '0');
INSERT INTO `eju_config` VALUES ('207', 'system_correctarctypedirpath', '1', 'system', '', '0', '1562052310', '0');
INSERT INTO `eju_config` VALUES ('209', 'thumb_open', '0', 'thumb', '', '0', '1562313846', '0');
INSERT INTO `eju_config` VALUES ('210', 'thumb_mode', '2', 'thumb', '', '0', '1562313846', '0');
INSERT INTO `eju_config` VALUES ('211', 'thumb_color', '#FFFFFF', 'thumb', '', '0', '1562313846', '0');
INSERT INTO `eju_config` VALUES ('212', 'thumb_width', '300', 'thumb', '', '0', '1562313846', '0');
INSERT INTO `eju_config` VALUES ('213', 'thumb_height', '300', 'thumb', '', '0', '1562313846', '0');
INSERT INTO `eju_config` VALUES ('220', 'web_templets_mobile', '/template/default/mobile', 'web', '', '0', '0', '0');
INSERT INTO `eju_config` VALUES ('232', 'file', '', 'web', '', '0', '1568962123', '0');
INSERT INTO `eju_config` VALUES ('233', '_ajax', '1', 'web', '', '0', '1568962123', '0');
INSERT INTO `eju_config` VALUES ('234', 'basic_indexname', '首页', 'basic', '', '0', '1568967416', '0');
INSERT INTO `eju_config` VALUES ('235', 'max_filesize', '2000', 'basic', '', '0', '1568967416', '0');
INSERT INTO `eju_config` VALUES ('236', 'max_sizeunit', 'MB', 'basic', '', '0', '1568967416', '0');
INSERT INTO `eju_config` VALUES ('237', '_ajax', '1', 'basic', '', '0', '1568967416', '0');
INSERT INTO `eju_config` VALUES ('238', 'system_tpl_theme', 'default', 'system', '', '0', '1569223975', '0');
INSERT INTO `eju_config` VALUES ('239', 'web_region_domain', '0', 'web', '', '0', '1570783192', '0');
INSERT INTO `eju_config` VALUES ('240', 'web_region_show_data', '1', 'web', '', '0', '1570783192', '0');
INSERT INTO `eju_config` VALUES ('241', 'web_mobile_domain_open', '1', 'web', '', '0', '1569659938', '0');
INSERT INTO `eju_config` VALUES ('242', 'web_mobile_domain', 'm', 'web', '', '0', '1572854353', '0');
INSERT INTO `eju_config` VALUES ('243', 'web_attr_1', '/uploads/allimg/20191011/1-191011115322C1.png', 'web', '', '0', '1586916705', '0');
INSERT INTO `eju_config` VALUES ('244', 'web_attr_2', '400-123-4567', 'web', '', '0', '1570783936', '0');
INSERT INTO `eju_config` VALUES ('245', 'web_adminlogo', '', 'web', '', '0', '1570782554', '0');
INSERT INTO `eju_config` VALUES ('246', 'old_web_adminlogo', '', 'web', '', '0', '1570782554', '0');
INSERT INTO `eju_config` VALUES ('247', 'web_attr_3', '1234567890', 'web', '', '0', '1570783936', '0');
INSERT INTO `eju_config` VALUES ('248', 'web_attr_4', '/uploads/allimg/20191011/1-1910111A214110.jpg', 'web', '', '0', '1570783936', '0');
INSERT INTO `eju_config` VALUES ('249', 'system_channeltype_xiaoqu', '1', 'system', '', '0', '1572340836', '0');
INSERT INTO `eju_config` VALUES ('250', 'system_channeltype_ershou', '1', 'system', '', '0', '1572340836', '0');
INSERT INTO `eju_config` VALUES ('251', 'system_channeltype_zufang', '1', 'system', '', '0', '1572340836', '0');
INSERT INTO `eju_config` VALUES ('252', 'system_channeltype_unit', '1', 'system', '', '0', '1572340836', '0');
INSERT INTO `eju_config` VALUES ('253', 'question_acrtype', '1', 'question', '', '0', '1577088124', '0');
INSERT INTO `eju_config` VALUES ('254', 'question_status', '1', 'question', '', '0', '1577088151', '0');
INSERT INTO `eju_config` VALUES ('255', 'question_ask_status', '0', 'question', '', '0', '1577088151', '0');
INSERT INTO `eju_config` VALUES ('256', 'question_ask_check', '1', 'question', '', '0', '1577088733', '0');
INSERT INTO `eju_config` VALUES ('257', 'question_ans_status', '0', 'question', '', '0', '1577088151', '0');
INSERT INTO `eju_config` VALUES ('258', 'question_ans_check', '1', 'question', '', '0', '1577088733', '0');
INSERT INTO `eju_config` VALUES ('259', '_ajax', '1', 'question', '', '0', '1577088151', '0');
INSERT INTO `eju_config` VALUES ('264', 'system_salemantousers', '1', 'system', '', '0', '1582104547', '0');
INSERT INTO `eju_config` VALUES ('265', 'system_channeltype_unit_20', '1', 'system', '', '0', '1582104547', '0');
INSERT INTO `eju_config` VALUES ('266', 'web_main_domain', 'www', 'web', '', '0', '1583374728', '0');
INSERT INTO `eju_config` VALUES ('267', 'system_channeltype_shopcs', '1', 'system', '', '0', '1589273454', '0');
INSERT INTO `eju_config` VALUES ('268', 'system_channeltype_shopcz', '1', 'system', '', '0', '1589273454', '0');
INSERT INTO `eju_config` VALUES ('269', 'system_channeltype_officecs', '1', 'system', '', '0', '1589273454', '0');
INSERT INTO `eju_config` VALUES ('270', 'system_channeltype_officecz', '1', 'system', '', '0', '1589273454', '0');
INSERT INTO `eju_config` VALUES ('271', 'system_salemantousers22', '1', 'system', '', '0', '1583374906', '0');
INSERT INTO `eju_config` VALUES ('272', 'system_channeltype_unit_22', '1', 'system', '', '0', '1583374906', '0');
INSERT INTO `eju_config` VALUES ('273', 'system_channeltype_unit_23', '1', 'system', '', '0', '1585044957', '0');
INSERT INTO `eju_config` VALUES ('274', 'system_no_first_into', '1', 'system', '', '0', '1585044957', '0');
INSERT INTO `eju_config` VALUES ('275', 'system_channeltype_qiuzu', '1', 'system', '', '0', '1589273454', '0');
INSERT INTO `eju_config` VALUES ('276', 'system_channeltype_unit_24', '1', 'system', '', '0', '1586764433', '0');

-- -----------------------------
-- Table structure for `eju_config_attribute`
-- -----------------------------
DROP TABLE IF EXISTS `eju_config_attribute`;
CREATE TABLE `eju_config_attribute` (
  `attr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表单id',
  `inc_type` varchar(20) DEFAULT '' COMMENT '变量分组',
  `attr_name` varchar(60) DEFAULT '' COMMENT '变量标题',
  `attr_var_name` varchar(50) DEFAULT '' COMMENT '变量名',
  `attr_input_type` tinyint(1) unsigned DEFAULT '0' COMMENT ' 0=文本框，1=下拉框，2=多行文本框，3=上传图片',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`attr_id`),
  KEY `inc_type` (`inc_type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='自定义变量表';

-- -----------------------------
-- Records of `eju_config_attribute`
-- -----------------------------
INSERT INTO `eju_config_attribute` VALUES ('1', 'web', '手机端LOGO', 'web_attr_1', '3', '1570765827', '1570783913');
INSERT INTO `eju_config_attribute` VALUES ('2', 'web', '服务热线', 'web_attr_2', '0', '1570765827', '1570783913');
INSERT INTO `eju_config_attribute` VALUES ('3', 'web', 'QQ号码', 'web_attr_3', '0', '1570783913', '1570783913');
INSERT INTO `eju_config_attribute` VALUES ('4', 'web', '微信二维码', 'web_attr_4', '3', '1570783913', '1570783913');

-- -----------------------------
-- Table structure for `eju_ershou_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ershou_content`;
CREATE TABLE `eju_ershou_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `content` longtext NOT NULL COMMENT '房源介绍',
  `property` int(10) NOT NULL DEFAULT '0' COMMENT '产权年限',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建造年代',
  `supporting` set('电视','空调','电梯','冰箱','洗衣机','热水器','阳台','床','沙发','衣柜','抽油烟机','独立卫生间') DEFAULT '' COMMENT '配套',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='二手房附加表';

-- -----------------------------
-- Records of `eju_ershou_content`
-- -----------------------------
INSERT INTO `eju_ershou_content` VALUES ('1', '67', '1572576291', '1572576291', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错&lt;/p&gt;', '70', '2016', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_ershou_content` VALUES ('2', '68', '1572576279', '1572576279', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错&lt;/p&gt;', '70', '2014', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_ershou_content` VALUES ('3', '69', '1572576267', '1572576267', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错&lt;/p&gt;', '70', '2004', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,抽油烟机,独立卫生间', '');
INSERT INTO `eju_ershou_content` VALUES ('4', '70', '1572576245', '1572576245', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错&lt;/p&gt;', '70', '2008', '空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,独立卫生间', '');
INSERT INTO `eju_ershou_content` VALUES ('5', '71', '1572576233', '1572576233', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错&lt;/p&gt;', '70', '2006', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_ershou_content` VALUES ('6', '72', '1572576216', '1572576216', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。产权证：不满二年。海景学校*房。周边环境非常不错&lt;/p&gt;', '70', '2006', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_ershou_content` VALUES ('9', '83', '1586916619', '1586916619', '', '0', '0', '', '');

-- -----------------------------
-- Table structure for `eju_ershou_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ershou_photo`;
CREATE TABLE `eju_ershou_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COMMENT='二手房相册表';

-- -----------------------------
-- Records of `eju_ershou_photo`
-- -----------------------------
INSERT INTO `eju_ershou_photo` VALUES ('1', '67', '', '/uploads/allimg/20191030/1-191030145229551.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('2', '67', '', '/uploads/allimg/20191030/1-191030145229243.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('3', '67', '', '/uploads/allimg/20191030/1-191030145229146.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('4', '67', '', '/uploads/allimg/20191030/1-19103014522aD.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('5', '67', '', '/uploads/allimg/20191030/1-19103014522W40.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('6', '67', '', '/uploads/allimg/20191030/1-19103014522R28.jpg', '', '6', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('7', '67', '', '/uploads/allimg/20191030/1-191030145146111.jpg', '', '7', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('8', '67', '', '/uploads/allimg/20191030/1-191030145146161.jpg', '', '8', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('9', '67', '', '/uploads/allimg/20191030/1-191030145146116.jpg', '', '9', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('10', '67', '', '/uploads/allimg/20191030/1-191030145146107.jpg', '', '10', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('66', '68', '', '/uploads/allimg/20191030/1-19103014555T25.jpg', '', '6', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('65', '68', '', '/uploads/allimg/20191030/1-19103014555WE.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('64', '68', '', '/uploads/allimg/20191030/1-19103014555TE.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('63', '68', '', '/uploads/allimg/20191030/1-191030145559443.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('62', '68', '', '/uploads/allimg/20191030/1-19103014555aZ.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('61', '68', '', '/uploads/allimg/20191030/1-19103014555b04.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('71', '69', '', '/uploads/allimg/20191030/1-191030145Q9519.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('70', '69', '', '/uploads/allimg/20191030/1-191030145QbX.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('69', '69', '', '/uploads/allimg/20191030/1-191030145R04R.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('68', '69', '', '/uploads/allimg/20191030/1-191030145R04V.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('67', '69', '', '/uploads/allimg/20191030/1-191030145R0636.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('77', '70', '', '/uploads/allimg/20191030/1-191030150053c9.jpg', '', '6', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('76', '70', '', '/uploads/allimg/20191030/1-191030150053T2.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('75', '70', '', '/uploads/allimg/20191030/1-191030150053556.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('74', '70', '', '/uploads/allimg/20191030/1-191030150053B5.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('73', '70', '', '/uploads/allimg/20191030/1-191030150053a0.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('72', '70', '', '/uploads/allimg/20191030/1-1910301500531Q.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('82', '71', '', '/uploads/allimg/20191030/1-191030150331Y0.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('81', '71', '', '/uploads/allimg/20191030/1-191030150331C7.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('80', '71', '', '/uploads/allimg/20191030/1-191030150331396.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('79', '71', '', '/uploads/allimg/20191030/1-191030150331H1.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('78', '71', '', '/uploads/allimg/20191030/1-1910301503313L.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('87', '72', '', '/uploads/allimg/20191030/1-19103015052DL.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('86', '72', '', '/uploads/allimg/20191030/1-191030150526110.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('85', '72', '', '/uploads/allimg/20191030/1-191030150526336.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('84', '72', '', '/uploads/allimg/20191030/1-19103015052O23.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_ershou_photo` VALUES ('83', '72', '', '/uploads/allimg/20191030/1-19103015052L52.jpg', '', '1', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_ershou_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ershou_price`;
CREATE TABLE `eju_ershou_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='二手房价格';

-- -----------------------------
-- Records of `eju_ershou_price`
-- -----------------------------
INSERT INTO `eju_ershou_price` VALUES ('1', '79', '0', '1', '2020-04-13', '2020-04', '2020', '1586764458', '0', '0');
INSERT INTO `eju_ershou_price` VALUES ('2', '79', '0', '3', '2020-04-13', '2020-04', '2020', '1586764458', '0', '0');
INSERT INTO `eju_ershou_price` VALUES ('3', '80', '0', '1', '2020-04-13', '2020-04', '2020', '1586765751', '0', '0');
INSERT INTO `eju_ershou_price` VALUES ('4', '80', '0', '3', '2020-04-13', '2020-04', '2020', '1586765751', '0', '0');
INSERT INTO `eju_ershou_price` VALUES ('5', '83', '0', '1', '2020-04-15', '2020-04', '2020', '1586916619', '0', '0');
INSERT INTO `eju_ershou_price` VALUES ('6', '83', '0', '3', '2020-04-15', '2020-04', '2020', '1586916619', '0', '0');

-- -----------------------------
-- Table structure for `eju_ershou_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_ershou_system`;
CREATE TABLE `eju_ershou_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `total_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `average_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '均价',
  `area` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积',
  `characteristic` set('南北通透','冬暖夏凉') DEFAULT '' COMMENT '特色',
  `aspect` enum('东','西','南','北','东北','西北','东南','西南','') NOT NULL DEFAULT '东' COMMENT '朝向',
  `fitment` enum('毛坯','简装','精装','豪装','') NOT NULL DEFAULT '毛坯' COMMENT '装修',
  `manage_type` enum('住宅','铺面','别墅','') NOT NULL DEFAULT '住宅' COMMENT '类型',
  `room` enum('1','2','3','4','5','6','') NOT NULL DEFAULT '1' COMMENT '室',
  `living_room` enum('0','1','2','3','4','') NOT NULL DEFAULT '0' COMMENT '客厅',
  `kitchen` enum('0','1','2','3','') NOT NULL DEFAULT '0' COMMENT '厨房',
  `toilet` enum('0','1','2','3','') NOT NULL DEFAULT '0' COMMENT '卫生间',
  `balcony` enum('0','1','2','3','') NOT NULL DEFAULT '0' COMMENT '阳台',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '精度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '号码转码',
  `floo_type` enum('低层','中层','高层','') NOT NULL DEFAULT '低层' COMMENT '楼层',
  `floor_count` int(10) NOT NULL DEFAULT '0' COMMENT '楼层数',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='二手房系统表';

-- -----------------------------
-- Records of `eju_ershou_system`
-- -----------------------------
INSERT INTO `eju_ershou_system` VALUES ('1', '67', '110', '0', '80', '南北通透,冬暖夏凉', '南', '简装', '住宅', '2', '2', '1', '1', '1', '1572576291', '1572576291', '海口海甸岛东片开发区', '110.363126', '20.067355', '张生', '13800001111', '', '中层', '21');
INSERT INTO `eju_ershou_system` VALUES ('2', '68', '150', '0', '120', '南北通透,冬暖夏凉', '南', '豪装', '住宅', '3', '2', '1', '2', '2', '1572576279', '1572576279', '海口和谐路海南华侨中学旁', '110.259159', '20.021787', '张生', '13800001111', '', '高层', '28');
INSERT INTO `eju_ershou_system` VALUES ('3', '69', '100', '0', '90', '南北通透,冬暖夏凉', '南', '简装', '住宅', '2', '2', '1', '2', '1', '1572576267', '1572576267', '海口丽晶路10-1号', '110.300711', '20.031024', '张生', '13800001111', '', '中层', '23');
INSERT INTO `eju_ershou_system` VALUES ('4', '70', '120', '0', '88', '南北通透,冬暖夏凉', '南', '豪装', '住宅', '2', '2', '1', '2', '1', '1572576245', '1572576245', '海口市龙华区滨海大道62号', '110.299756', '20.028129', '张生', '13800001111', '', '中层', '20');
INSERT INTO `eju_ershou_system` VALUES ('5', '71', '160', '0', '130', '南北通透,冬暖夏凉', '南', '精装', '住宅', '3', '2', '1', '2', '2', '1572576233', '1572576233', '海口海口市丽晶路20号', '110.299192', '20.037073', '张生', '13800001111', '', '高层', '32');
INSERT INTO `eju_ershou_system` VALUES ('6', '72', '98', '0', '84', '南北通透,冬暖夏凉', '南', '简装', '住宅', '2', '2', '1', '1', '1', '1572576216', '1572576216', '海口海口市丽晶路20号', '110.299192', '20.037073', '张生', '13800001111', '', '低层', '32');
INSERT INTO `eju_ershou_system` VALUES ('9', '83', '0', '0', '0', '', '东', '毛坯', '住宅', '1', '0', '0', '0', '0', '1586916619', '1586916619', '', '', '', '程序猿', '18789221089', '', '低层', '0');

-- -----------------------------
-- Table structure for `eju_field_type`
-- -----------------------------
DROP TABLE IF EXISTS `eju_field_type`;
CREATE TABLE `eju_field_type` (
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '字段类型',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '中文类型名',
  `ifoption` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要设置选项',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='字段类型表';

-- -----------------------------
-- Records of `eju_field_type`
-- -----------------------------
INSERT INTO `eju_field_type` VALUES ('checkbox', '多选项', '1', '5', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('datetime', '日期和时间', '0', '12', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('decimal', '金额类型', '0', '9', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('float', '小数类型', '0', '8', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('htmltext', 'HTML文本', '0', '3', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('img', '单张图', '0', '10', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('imgs', '多张图', '0', '11', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('int', '整数类型', '0', '7', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('multitext', '多行文本', '0', '2', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('radio', '单选项', '1', '4', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('region', '区域类型', '1', '6', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('region_db', '新的区域', '1', '0', '1532485708', '0');
INSERT INTO `eju_field_type` VALUES ('select', '下拉框', '1', '6', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('switch', '开关', '0', '13', '1532485708', '1532485708');
INSERT INTO `eju_field_type` VALUES ('text', '单行文本', '0', '1', '1532485708', '1532485708');

-- -----------------------------
-- Table structure for `eju_form`
-- -----------------------------
DROP TABLE IF EXISTS `eju_form`;
CREATE TABLE `eju_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` int(6) unsigned NOT NULL DEFAULT '1' COMMENT '模型id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '表单名称',
  `intro` text NOT NULL COMMENT '表单描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0关闭1开启',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建人员',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='表单管理表';

-- -----------------------------
-- Records of `eju_form`
-- -----------------------------
INSERT INTO `eju_form` VALUES ('1', '1', '电话表单', '收集游客手机号', '1', '0', '1', '1570784098', '1570784098');
INSERT INTO `eju_form` VALUES ('2', '1', '游客信息', '收集游客姓名和手机号', '1', '0', '1', '1570784133', '1570784133');

-- -----------------------------
-- Table structure for `eju_form_attr`
-- -----------------------------
DROP TABLE IF EXISTS `eju_form_attr`;
CREATE TABLE `eju_form_attr` (
  `attr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表单id',
  `attr_name` varchar(60) DEFAULT '' COMMENT '字段名称',
  `form_id` int(11) unsigned DEFAULT '0' COMMENT '栏目ID',
  `input_type` varchar(32) DEFAULT '' COMMENT '字段类型',
  `attr_values` text COMMENT '可选值列表',
  `sort_order` int(11) unsigned DEFAULT '100' COMMENT '表单排序',
  `is_fill` tinyint(1) unsigned DEFAULT '0' COMMENT '是否必填，1：必填',
  `input_rule` tinyint(1) unsigned DEFAULT '0' COMMENT '正则规则',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '是否已删除，0=否，1=是',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`attr_id`),
  KEY `form_id` (`form_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='表单字段表';

-- -----------------------------
-- Records of `eju_form_attr`
-- -----------------------------
INSERT INTO `eju_form_attr` VALUES ('1', '电话号码', '1', 'text', '', '100', '1', '1', '1', '0', '1570784098', '1570784098');
INSERT INTO `eju_form_attr` VALUES ('2', '电话号码', '2', 'text', '', '100', '1', '0', '1', '0', '1570784133', '1570784133');
INSERT INTO `eju_form_attr` VALUES ('3', '姓名', '2', 'text', '', '100', '1', '0', '0', '0', '1570784133', '1570784133');

-- -----------------------------
-- Table structure for `eju_form_config`
-- -----------------------------
DROP TABLE IF EXISTS `eju_form_config`;
CREATE TABLE `eju_form_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '提醒人，中间用逗号隔开（1：网站管理员，2：关联经纪人）',
  `person` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `note` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否发送短信（0：不发送）',
  `email` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发送邮箱（0：不发送）',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0关闭1开启',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='表单消息配置表';

-- -----------------------------
-- Records of `eju_form_config`
-- -----------------------------
INSERT INTO `eju_form_config` VALUES ('1', '1', '0', '0', '1', '1', '1582270859', '1582270859');
INSERT INTO `eju_form_config` VALUES ('2', '2', '0', '0', '0', '1', '1582270859', '1582270859');

-- -----------------------------
-- Table structure for `eju_form_list`
-- -----------------------------
DROP TABLE IF EXISTS `eju_form_list`;
CREATE TABLE `eju_form_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '表单id',
  `md5data` varchar(50) NOT NULL DEFAULT '' COMMENT '数据序列化之后的MD5加密，提交内容的唯一性',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT 'ip所在城市',
  `come_from` varchar(100) NOT NULL DEFAULT '' COMMENT '来源页面seo',
  `come_url` varchar(100) NOT NULL DEFAULT '' COMMENT '来源页码链接',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已读',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `aid` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`list_id`),
  KEY `form_id` (`form_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='表单列表';

-- -----------------------------
-- Records of `eju_form_list`
-- -----------------------------
INSERT INTO `eju_form_list` VALUES ('1', '2', 'ccd49949cf2366b38ce2a4c670013c11', '36.101.199.210', '', '团购', '/?m=home&amp;c=Lists&amp;a=index&amp;tid=3', '1', '0', '1570784866', '1570788073', '0');

-- -----------------------------
-- Table structure for `eju_form_value`
-- -----------------------------
DROP TABLE IF EXISTS `eju_form_value`;
CREATE TABLE `eju_form_value` (
  `value_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言表单id自增',
  `form_id` int(11) unsigned NOT NULL DEFAULT '0',
  `list_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '留言id',
  `attr_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '表单id',
  `attr_value` text COMMENT '表单值',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`value_id`),
  KEY `form_id` (`form_id`,`list_id`,`attr_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='表单内容表';

-- -----------------------------
-- Records of `eju_form_value`
-- -----------------------------
INSERT INTO `eju_form_value` VALUES ('1', '2', '1', '2', '13800000000', '1570784866', '1570784866');
INSERT INTO `eju_form_value` VALUES ('2', '2', '1', '3', '张生', '1570784866', '1570784866');

-- -----------------------------
-- Table structure for `eju_hooks`
-- -----------------------------
DROP TABLE IF EXISTS `eju_hooks`;
CREATE TABLE `eju_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text COMMENT '描述',
  `module` varchar(50) DEFAULT '' COMMENT '钩子挂载的插件',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态：0=无效，1=有效',
  `add_time` int(10) DEFAULT NULL,
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='插件钩子表';


-- -----------------------------
-- Table structure for `eju_images_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_images_content`;
CREATE TABLE `eju_images_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `content` longtext COMMENT '内容详情',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图集附加表';


-- -----------------------------
-- Table structure for `eju_images_upload`
-- -----------------------------
DROP TABLE IF EXISTS `eju_images_upload`;
CREATE TABLE `eju_images_upload` (
  `img_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '图集ID',
  `title` varchar(200) DEFAULT '' COMMENT '产品标题',
  `image_url` varchar(255) DEFAULT '' COMMENT '文件存储路径',
  `width` int(11) DEFAULT '0' COMMENT '图片宽度',
  `height` int(11) DEFAULT '0' COMMENT '图片高度',
  `filesize` mediumint(8) unsigned DEFAULT '0' COMMENT '文件大小',
  `mime` varchar(50) DEFAULT '' COMMENT '图片类型',
  `sort_order` smallint(5) DEFAULT '0' COMMENT '排序',
  `add_time` int(10) unsigned DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`img_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图集图片表';


-- -----------------------------
-- Table structure for `eju_links`
-- -----------------------------
DROP TABLE IF EXISTS `eju_links`;
CREATE TABLE `eju_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(1) DEFAULT '1' COMMENT '类型：1=文字链接，2=图片链接',
  `title` varchar(50) DEFAULT '' COMMENT '网站标题',
  `url` varchar(100) DEFAULT '' COMMENT '网站地址',
  `logo` varchar(255) DEFAULT '' COMMENT '网站LOGO',
  `sort_order` int(11) DEFAULT '0' COMMENT '排序号',
  `target` tinyint(1) DEFAULT '0' COMMENT '是否开启浏览器新窗口',
  `email` varchar(50) DEFAULT NULL,
  `intro` text COMMENT '网站简况',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(1=显示，0=屏蔽)',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- -----------------------------
-- Records of `eju_links`
-- -----------------------------
INSERT INTO `eju_links` VALUES ('1', '1', '百度', 'http://www.baidu.com', '', '100', '1', '', '', '1', '1570840724', '1570840724');
INSERT INTO `eju_links` VALUES ('2', '1', '腾讯', 'http://www.qq.com', '', '100', '1', '', '', '1', '1570840735', '1570840735');
INSERT INTO `eju_links` VALUES ('3', '1', '新浪', 'http://www.sina.com.cn', '', '100', '1', '', '', '1', '1570840744', '1570840744');
INSERT INTO `eju_links` VALUES ('4', '1', '淘宝', 'http://www.taobao.com', '', '100', '1', '', '', '1', '1570840752', '1570840752');
INSERT INTO `eju_links` VALUES ('5', '1', '微博', 'http://www.weibo.com', '', '100', '1', '', '', '1', '1570840761', '1570840761');
INSERT INTO `eju_links` VALUES ('6', '1', '易居CMS', 'http://www.ejucms.com/', '', '100', '1', '', '', '1', '1570840791', '1570840791');

-- -----------------------------
-- Table structure for `eju_minipro`
-- -----------------------------
DROP TABLE IF EXISTS `eju_minipro`;
CREATE TABLE `eju_minipro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '页面组',
  `value` text NOT NULL COMMENT '组装之后的值',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小程序表';


-- -----------------------------
-- Table structure for `eju_minipro_info`
-- -----------------------------
DROP TABLE IF EXISTS `eju_minipro_info`;
CREATE TABLE `eju_minipro_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) NOT NULL DEFAULT '0' COMMENT '文档ID',
  `channel` int(9) NOT NULL DEFAULT '0' COMMENT '频道ID',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-开盘通知 2-降价通知',
  `title` varchar(255) DEFAULT '' COMMENT '标题',
  `mobile` varchar(20) DEFAULT '' COMMENT '手机',
  `ip` varchar(20) DEFAULT '' COMMENT 'ip',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-正常',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `openid` varchar(255) DEFAULT '' COMMENT '微信openid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小程序收集客户信息表';


-- -----------------------------
-- Table structure for `eju_navig_list`
-- -----------------------------
DROP TABLE IF EXISTS `eju_navig_list`;
CREATE TABLE `eju_navig_list` (
  `navig_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `topid` int(10) NOT NULL DEFAULT '0' COMMENT '顶级菜单ID',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `navig_name` varchar(200) NOT NULL DEFAULT '' COMMENT '导航名称',
  `englist_name` varchar(200) NOT NULL DEFAULT '' COMMENT '英文名称',
  `navig_url` varchar(200) NOT NULL DEFAULT '' COMMENT '导航链接',
  `position_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航位置',
  `arctype_sync` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否与栏目同步',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '同步栏目的ID',
  `navig_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '导航图片',
  `grade` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单等级',
  `target` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否打开新窗口，1=是，0=否',
  `nofollow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否使用nofollow，1=是，0=否',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用 (1=正常，0=停用)',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序号',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`navig_id`),
  KEY `type_id` (`type_id`),
  KEY `position_id` (`position_id`,`status`,`is_del`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航列表';


-- -----------------------------
-- Table structure for `eju_navig_position`
-- -----------------------------
DROP TABLE IF EXISTS `eju_navig_position`;
CREATE TABLE `eju_navig_position` (
  `position_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '导航列表ID',
  `position_name` varchar(200) NOT NULL DEFAULT '' COMMENT '导航列表名称',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '伪删除，1=是，0=否',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='导航位置表';

-- -----------------------------
-- Records of `eju_navig_position`
-- -----------------------------
INSERT INTO `eju_navig_position` VALUES ('1', 'PC端主导航', '100', '0', '0', '0');
INSERT INTO `eju_navig_position` VALUES ('2', 'PC端顶部导航', '100', '0', '0', '0');
INSERT INTO `eju_navig_position` VALUES ('3', 'PC端中部导航', '100', '1', '0', '0');
INSERT INTO `eju_navig_position` VALUES ('5', '移动端中部导航', '100', '0', '0', '0');
INSERT INTO `eju_navig_position` VALUES ('4', 'PC端底部导航', '100', '0', '0', '0');
INSERT INTO `eju_navig_position` VALUES ('6', '移动端侧边导航', '100', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_officecs_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecs_content`;
CREATE TABLE `eju_officecs_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` longtext NOT NULL COMMENT '房源介绍',
  `property` int(10) NOT NULL DEFAULT '0' COMMENT '产权年限',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建造年代',
  `property_fee` varchar(200) NOT NULL DEFAULT '' COMMENT '物业费',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  `sfbhwyf` varchar(200) NOT NULL DEFAULT '' COMMENT '是否包含物业费',
  `diy_xingzhi` enum('新房写字楼','二手写字楼','') NOT NULL DEFAULT '新房写字楼' COMMENT '性质',
  `diy_syl` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '使用率',
  `diy_gws` int(10) NOT NULL DEFAULT '0' COMMENT '工位数',
  `diy_sfzc` enum('可注册','不可注册','暂无数据','') NOT NULL DEFAULT '可注册' COMMENT '是否可注册',
  `diy_xgfy` varchar(200) NOT NULL DEFAULT '' COMMENT '相关费用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出售附加表';


-- -----------------------------
-- Table structure for `eju_officecs_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecs_photo`;
CREATE TABLE `eju_officecs_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出售相册表';


-- -----------------------------
-- Table structure for `eju_officecs_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecs_price`;
CREATE TABLE `eju_officecs_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出售价格表';


-- -----------------------------
-- Table structure for `eju_officecs_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecs_system`;
CREATE TABLE `eju_officecs_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `total_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `area` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积',
  `average_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '均价，根据面积何总价自动计算获得',
  `characteristic` set('免中介费','可注册','赠免租期','交通便利','中心商务区','地标建筑','知名物业','繁华商圈','独栋写字楼') DEFAULT '' COMMENT '标签',
  `manage_type` enum('纯写字楼','商业综合体','酒店写字楼','') NOT NULL DEFAULT '纯写字楼' COMMENT '类型',
  `fitment` enum('毛坯','简装','精装','豪装','') NOT NULL DEFAULT '毛坯' COMMENT '装修情况',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '精度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '号码转码',
  `floo_type` enum('低层','中层','高层','') NOT NULL DEFAULT '低层' COMMENT '楼层',
  `floor_count` int(10) NOT NULL DEFAULT '0' COMMENT '楼层数',
  `level` enum('甲级','乙级','丙级','丁级','') NOT NULL DEFAULT '甲级' COMMENT '等级',
  `division` enum('不可分割','可分割','') NOT NULL DEFAULT '不可分割' COMMENT '是否可分割',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出售系统表';


-- -----------------------------
-- Table structure for `eju_officecz_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecz_content`;
CREATE TABLE `eju_officecz_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` longtext NOT NULL COMMENT '房源介绍',
  `property` int(10) NOT NULL DEFAULT '0' COMMENT '产权年限',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建造年代',
  `property_fee` varchar(200) NOT NULL DEFAULT '' COMMENT '物业费',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  `sfbhwyf` varchar(200) NOT NULL DEFAULT '' COMMENT '是否包含物业费',
  `diy_xingzhi` enum('新房写字楼','二手写字楼','') NOT NULL DEFAULT '新房写字楼' COMMENT '性质',
  `diy_qzq` varchar(200) NOT NULL DEFAULT '' COMMENT '起租期',
  `diy_syl` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '使用率',
  `diy_gws` int(10) NOT NULL DEFAULT '0' COMMENT '工位数',
  `diy_sfzc` enum('可注册','不可注册','暂无数据','') NOT NULL DEFAULT '可注册' COMMENT '是否可注册',
  `diy_xgfy` varchar(200) NOT NULL DEFAULT '' COMMENT '相关费用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出租附加表';


-- -----------------------------
-- Table structure for `eju_officecz_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecz_photo`;
CREATE TABLE `eju_officecz_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出租相册表';


-- -----------------------------
-- Table structure for `eju_officecz_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecz_price`;
CREATE TABLE `eju_officecz_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出租价格表';


-- -----------------------------
-- Table structure for `eju_officecz_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_officecz_system`;
CREATE TABLE `eju_officecz_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `total_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '租金',
  `area` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积',
  `average_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '均价，根据面积何总价自动计算获得',
  `fitment` enum('毛坯','简装','精装','豪装','') NOT NULL DEFAULT '毛坯' COMMENT '装修',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '精度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '号码转码',
  `floo_type` enum('低层','中层','高层','') NOT NULL DEFAULT '低层' COMMENT '楼层',
  `floor_count` int(10) NOT NULL DEFAULT '0' COMMENT '楼层数',
  `price_units` enum('元/月','元/㎡/月','元/季','元/年','') NOT NULL DEFAULT '元/月' COMMENT '价格单位',
  `pay_way` enum('押一付一','押一付三','') NOT NULL DEFAULT '押一付一' COMMENT '付款方式',
  `division` enum('不可分割','可分割','') NOT NULL DEFAULT '不可分割' COMMENT '是否可分割',
  `level` enum('甲级','乙级','丙级','丁级','') NOT NULL DEFAULT '甲级' COMMENT '等级',
  `characteristic` set('免中介费','赠免租期','交通便利','中心商务区','地标建筑','知名物业','繁华商圈','独栋写字楼') DEFAULT '' COMMENT '特色',
  `manage_type` enum('纯写字楼','商业综合体','酒店写字楼','') NOT NULL DEFAULT '纯写字楼' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='写字楼出租系统表';


-- -----------------------------
-- Table structure for `eju_qiuzu_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_qiuzu_content`;
CREATE TABLE `eju_qiuzu_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `priority` varchar(100) DEFAULT '' COMMENT '优先区域',
  `lease` varchar(100) DEFAULT '' COMMENT '租约年限',
  `certificate` varchar(100) DEFAULT '' COMMENT '办证需要',
  `transfer` enum('不接受','接受') DEFAULT '接受' COMMENT '是否接受转让费',
  `floors` varchar(100) DEFAULT '' COMMENT '意向楼层',
  `supporting` set('外摆区','天然气','停车位','排污管道','烟管道','煤气罐','380伏','下水','上水','可明火') NOT NULL DEFAULT '' COMMENT '需求硬件配套',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='求租附加表';


-- -----------------------------
-- Table structure for `eju_qiuzu_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_qiuzu_system`;
CREATE TABLE `eju_qiuzu_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '号码转码',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `area_min` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积下限',
  `area_max` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积上限',
  `price_type` enum('月租金','日租金','') NOT NULL DEFAULT '月租金' COMMENT '租金类型',
  `price_min` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '租金下限',
  `price_max` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '租金上限',
  `manage_type` enum('休闲娱乐','酒楼餐饮','') NOT NULL DEFAULT '休闲娱乐' COMMENT '经营类型',
  `shop_type` enum('店铺','档口','摊位','') NOT NULL DEFAULT '店铺' COMMENT '商铺类型',
  `price_units` enum('元/日.㎡','元/月','') NOT NULL COMMENT '租金单位',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='求租系统表';


-- -----------------------------
-- Table structure for `eju_quickentry`
-- -----------------------------
DROP TABLE IF EXISTS `eju_quickentry`;
CREATE TABLE `eju_quickentry` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT '' COMMENT '名称',
  `laytext` varchar(50) DEFAULT '' COMMENT '完整标题',
  `type` smallint(5) DEFAULT '0' COMMENT '归类，1=快捷入口，2=内容统计',
  `controller` varchar(20) DEFAULT '' COMMENT '控制器名',
  `action` varchar(20) DEFAULT '' COMMENT '操作名',
  `vars` varchar(100) DEFAULT '' COMMENT 'URL参数字符串',
  `groups` smallint(5) DEFAULT '0' COMMENT '分组，1=模型',
  `checked` tinyint(4) DEFAULT '0' COMMENT '选中，0=否，1=是',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态，1=有效，0=无效',
  `sort_order` int(10) DEFAULT '0' COMMENT '排序',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='快捷入口表';

-- -----------------------------
-- Records of `eju_quickentry`
-- -----------------------------
INSERT INTO `eju_quickentry` VALUES ('1', '楼盘', '楼盘列表', '1', 'Xinfang', 'index', 'channel=9', '1', '0', '1', '3', '1569232484', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('2', '团购', '团购列表', '1', 'Tuan', 'index', 'channel=10', '1', '0', '1', '4', '1569232484', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('3', '资讯', '资讯列表', '1', 'Article', 'index', 'channel=1', '1', '0', '1', '6', '1569232484', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('4', '图集', '图集列表', '1', 'Images', 'index', 'channel=3', '1', '0', '0', '7', '1569232484', '1569308463');
INSERT INTO `eju_quickentry` VALUES ('5', '单页', '单页列表', '1', 'Arctype', 'single_index', 'channel=6', '1', '0', '1', '8', '1569232484', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('7', '回收站', '回收站', '1', 'RecycleBin', 'archives_index', '', '0', '1', '1', '5', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('8', '栏目管理', '栏目管理', '1', 'Arctype', 'index', '', '0', '1', '1', '3', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('9', '报名管理', '报名管理', '1', 'Form', 'index', '', '0', '1', '1', '6', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('10', '网站信息', '网站信息', '1', 'System', 'web', '', '0', '0', '1', '7', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('11', '图片处理', '图片处理', '1', 'System', 'water', '', '0', '0', '1', '8', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('12', '区域配置', '区域配置', '1', 'Region', 'index', '', '0', '0', '1', '9', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('13', '数据备份', '数据备份', '1', 'Tools', 'index', '', '0', '0', '1', '10', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('14', 'URL配置', 'URL配置', '1', 'Seo', 'index', '', '0', '1', '1', '2', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('15', '模板管理', '模板管理', '1', 'Filemanager', 'index', '', '0', '1', '1', '4', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('16', 'SiteMap', 'SiteMap', '1', 'Seo', 'index', 'inc_type=sitemap', '0', '0', '1', '11', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('17', '频道模型', '频道模型', '1', 'Channeltype', 'index', '', '0', '1', '1', '12', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('18', '广告管理', '广告管理', '1', 'AdPosition', 'index', '', '0', '1', '1', '1', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('19', '友情链接', '友情链接', '1', 'Links', 'index', '', '0', '0', '1', '13', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('20', 'Tags管理', 'Tags管理', '1', 'Tags', 'index', '', '0', '0', '1', '14', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('21', '管理员管理', '管理员管理', '1', 'Admin', 'index', '', '0', '0', '1', '15', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('23', '资讯', '资讯列表', '2', 'Article', 'index', 'channel=1', '1', '1', '1', '2', '1569310798', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('24', '楼盘', '楼盘列表', '2', 'Xinfang', 'index', 'channel=9', '1', '1', '1', '1', '1569310798', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('25', '团购', '团购列表', '2', 'Tuan', 'index', 'channel=10', '1', '1', '1', '3', '1569310798', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('26', '图集', '图集', '2', 'Images', 'index', 'channel=3', '1', '1', '0', '3', '1569310798', '1569632220');
INSERT INTO `eju_quickentry` VALUES ('27', '用户报名', '用户报名', '2', 'Form', 'index', '', '0', '1', '1', '4', '1569310798', '1570843649');
INSERT INTO `eju_quickentry` VALUES ('28', '广告', '广告管理', '2', 'AdPosition', 'index', '', '0', '1', '1', '6', '1569232484', '1570843649');
INSERT INTO `eju_quickentry` VALUES ('29', '友情链接', '友情链接', '2', 'Links', 'index', '', '0', '0', '1', '5', '1569232484', '1570843649');
INSERT INTO `eju_quickentry` VALUES ('30', 'Tags标签', 'Tags管理', '2', 'Tags', 'index', '', '0', '1', '1', '7', '1569232484', '1570843649');
INSERT INTO `eju_quickentry` VALUES ('32', '小区', '小区列表', '2', 'Xiaoqu', 'index', 'channel=11', '1', '0', '1', '100', '1572343299', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('33', '二手房', '二手房列表', '2', 'Ershou', 'index', 'channel=12', '1', '0', '1', '100', '1572343299', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('34', '租房', '租房列表', '2', 'Zufang', 'index', 'channel=13', '1', '0', '1', '100', '1572343299', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('35', '小区', '小区列表', '1', 'Xiaoqu', 'index', 'channel=11', '1', '0', '1', '100', '1572343303', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('36', '二手房', '二手房列表', '1', 'Ershou', 'index', 'channel=12', '1', '0', '1', '100', '1572343303', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('37', '租房', '租房列表', '1', 'Zufang', 'index', 'channel=13', '1', '0', '1', '100', '1572343303', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('38', '微信小程序', '微信小程序', '1', 'Minipro', 'index', '', '0', '0', '1', '100', '1569232484', '1569749707');
INSERT INTO `eju_quickentry` VALUES ('39', '导航管理', '导航管理', '1', 'Navigation', 'index', '', '0', '0', '1', '100', '1569232484', '1581066443');
INSERT INTO `eju_quickentry` VALUES ('40', '商铺出售', '商铺出售', '2', 'Shopcs', 'index', 'channel=14', '1', '0', '1', '100', '1582104547', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('41', '商铺出租', '商铺出租', '2', 'Shopcz', 'index', 'channel=15', '1', '0', '1', '100', '1582104547', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('42', '写字楼出售', '写字楼出售', '2', 'Officecs', 'index', 'channel=16', '1', '0', '1', '100', '1582104547', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('43', '写字楼出租', '写字楼出租', '2', 'Officecz', 'index', 'channel=17', '1', '0', '1', '100', '1582104547', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('44', '商铺出售', '商铺出售', '2', 'Shopcs', 'index', 'channel=14', '1', '0', '1', '100', '1583374729', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('45', '商铺出租', '商铺出租', '2', 'Shopcz', 'index', 'channel=15', '1', '0', '1', '100', '1583374730', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('46', '写字楼出售', '写字楼出售', '2', 'Officecs', 'index', 'channel=16', '1', '0', '1', '100', '1583374730', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('47', '写字楼出租', '写字楼出租', '2', 'Officecz', 'index', 'channel=17', '1', '0', '1', '100', '1583374730', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('48', '商铺出售', '商铺出售', '2', 'Shopcs', 'index', 'channel=14', '1', '0', '1', '100', '1583374906', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('49', '商铺出租', '商铺出租', '2', 'Shopcz', 'index', 'channel=15', '1', '0', '1', '100', '1583374906', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('50', '写字楼出售', '写字楼出售', '2', 'Officecs', 'index', 'channel=16', '1', '0', '1', '100', '1583374906', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('51', '写字楼出租', '写字楼出租', '2', 'Officecz', 'index', 'channel=17', '1', '0', '1', '100', '1583374906', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('52', '求租', '求租', '2', 'Qiuzu', 'index', 'channel=18', '1', '0', '1', '100', '1586764339', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('53', '商铺出售', '商铺出售', '2', 'Shopcs', 'index', 'channel=14', '1', '0', '1', '100', '1589273454', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('54', '商铺出租', '商铺出租', '2', 'Shopcz', 'index', 'channel=15', '1', '0', '1', '100', '1589273454', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('55', '写字楼出售', '写字楼出售', '2', 'Officecs', 'index', 'channel=16', '1', '0', '1', '100', '1589273454', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('56', '写字楼出租', '写字楼出租', '2', 'Officecz', 'index', 'channel=17', '1', '0', '1', '100', '1589273454', '1589273454');
INSERT INTO `eju_quickentry` VALUES ('57', '求租', '求租', '2', 'Qiuzu', 'index', 'channel=18', '1', '0', '1', '100', '1589273454', '1589273454');

-- -----------------------------
-- Table structure for `eju_region`
-- -----------------------------
DROP TABLE IF EXISTS `eju_region`;
CREATE TABLE `eju_region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(32) DEFAULT '' COMMENT '地区名称',
  `level` tinyint(4) DEFAULT '0' COMMENT '地区等级 分省市县区',
  `parent_id` int(10) DEFAULT '0' COMMENT '父id',
  `initial` varchar(5) DEFAULT '' COMMENT '首字母',
  `lng` varchar(30) NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(30) NOT NULL DEFAULT '' COMMENT '纬度',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1：开启，0：隐藏）',
  `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否热门',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认区域',
  `litpic` varchar(200) NOT NULL DEFAULT '' COMMENT '图片',
  `domain` varchar(50) NOT NULL DEFAULT '' COMMENT '二级域名',
  `sort_order` int(6) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `domain` (`domain`) USING BTREE,
  KEY `level` (`level`,`status`) USING BTREE,
  KEY `initial` (`initial`,`sort_order`,`id`) USING BTREE,
  KEY `parent_id` (`parent_id`,`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='子站点区域表';

-- -----------------------------
-- Records of `eju_region`
-- -----------------------------
INSERT INTO `eju_region` VALUES ('1', '北京', '1', '0', 'B', '116.413384', '39.910925', '0', '0', '0', '', 'beijing', '100', '0', '1569461730');
INSERT INTO `eju_region` VALUES ('2', '天津', '1', '0', 'T', '117.32084732039', '39.092255825706', '0', '0', '0', '', 'tianjin', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('3', '河北', '1', '0', 'H', '114.52131056628', '38.048235722856', '0', '0', '0', '', 'hebei', '100', '0', '1569486657');
INSERT INTO `eju_region` VALUES ('4', '山西', '1', '0', 'S', '112.56901498644', '37.880050298426', '0', '0', '0', '', 'shanxi', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('5', '内蒙古', '1', '0', 'N', '111.772606', '40.823156', '0', '0', '0', '', 'namenggu', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('6', '辽宁', '1', '0', 'L', '123.435598', '41.841465', '0', '0', '0', '', 'liaoning', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('7', '吉林', '1', '0', 'J', '126.555635', '43.843568', '0', '0', '0', '', 'jilin', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('8', '黑龙江', '1', '0', 'H', '126.669653', '45.74793', '0', '0', '0', '', 'heilongjiang', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('9', '上海', '1', '0', 'S', '121.480539', '31.235929', '0', '0', '0', '', 'shanghai', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('10', '江苏', '1', '0', 'J', '118.769552', '32.066777', '0', '0', '0', '', 'jiangsu', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('11', '浙江', '1', '0', 'Z', '120.159533', '30.271548', '0', '0', '0', '', 'zhejiang', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('12', '安徽', '1', '0', 'A', '117.336828', '31.740252', '0', '0', '0', '', 'anhui', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('13', '福建', '1', '0', 'F', '119.30185547305', '26.106259313629', '0', '0', '0', '', 'fujian', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('14', '江西', '1', '0', 'J', '115.91561159628', '28.680502085983', '0', '0', '0', '', 'jiangxi', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('15', '山东', '1', '0', 'S', '117.026472', '36.677057', '0', '0', '0', '', 'shandong', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('16', '河南', '1', '0', 'H', '113.759388', '34.772795', '0', '0', '0', '', 'henan', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('17', '湖北', '1', '0', 'H', '114.356023', '30.554088', '0', '0', '0', '', 'hubei', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('18', '湖南', '1', '0', 'H', '112.989855', '28.116486', '0', '0', '0', '', 'hunan', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('19', '广东', '1', '0', 'G', '113.272824', '23.139079', '0', '0', '0', '', 'guangdong', '100', '0', '1570760882');
INSERT INTO `eju_region` VALUES ('20', '广西', '1', '0', 'G', '108.334521', '22.821269', '0', '0', '0', '', 'guangxi', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('21', '海南', '1', '0', 'H', '110.355357', '20.024511', '1', '0', '1', '', 'hainan', '100', '0', '1569653490');
INSERT INTO `eju_region` VALUES ('22', '重庆', '1', '0', 'Z', '106.558434', '29.568996', '0', '0', '0', '', 'zhongqing', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('23', '四川', '1', '0', 'S', '104.072856', '30.578662', '0', '0', '0', '', 'sichuan', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('24', '贵州', '1', '0', 'G', '106.711781', '26.605903', '0', '0', '0', '', 'guizhou', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('25', '云南', '1', '0', 'Y', '102.71614662221', '25.051560059762', '0', '0', '0', '', 'yunnan', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('26', '西藏', '1', '0', 'X', '91.123659', '29.654463', '0', '0', '0', '', 'xicang', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('27', '陕西', '1', '0', 'S', '108.960393', '34.275808', '0', '0', '0', '', 'shanxi', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('28', '甘肃', '1', '0', 'G', '103.832801', '36.065932', '0', '0', '0', '', 'gansu', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('29', '青海', '1', '0', 'Q', '101.786462', '36.627159', '0', '0', '0', '', 'qinghai', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('30', '宁夏', '1', '0', 'N', '106.265605', '38.476878', '0', '0', '0', '', 'ningxia', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('31', '新疆', '1', '0', 'X', '87.631784', '43.800591', '0', '0', '0', '', 'xinjiang', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('32', '台湾', '1', '0', 'T', '121.42171529923', '31.206748720157', '0', '0', '0', '', 'taiwan', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('33', '香港', '1', '0', 'X', '116.39547498865', '34.424534987851', '0', '0', '0', '', 'xianggang', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('34', '澳门', '1', '0', 'A', '125.2955548661', '43.83932719616', '0', '0', '0', '', 'aomen', '100', '0', '1569460512');
INSERT INTO `eju_region` VALUES ('35', '海口', '2', '21', 'H', '110.30000497734', '20.013847261468', '1', '0', '0', '', 'haikou', '1', '0', '1570777523');
INSERT INTO `eju_region` VALUES ('36', '三亚', '2', '21', 'S', '109.518557', '18.258736', '1', '0', '0', '', 'sanya', '2', '0', '1570777524');
INSERT INTO `eju_region` VALUES ('37', '五指山', '2', '21', 'W', '109.52354', '18.780994', '1', '0', '0', '', 'wuzhishan', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('38', '琼海', '2', '21', 'Q', '110.48167114299', '19.265031030425', '1', '0', '0', '', 'qionghai', '4', '0', '1570777550');
INSERT INTO `eju_region` VALUES ('39', '儋州', '2', '21', 'D', '109.5870848957', '19.527081771523', '1', '0', '0', '', 'danzhou', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('40', '文昌', '2', '21', 'W', '110.804509', '19.549062', '1', '0', '0', '', 'wenchang', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('41', '万宁', '2', '21', 'W', '110.399434', '18.800107', '1', '0', '0', '', 'wanning', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('42', '东方', '2', '21', 'D', '108.65839015259', '19.100893533883', '1', '0', '0', '', 'dongfang', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('43', '定安', '2', '21', 'D', '110.365533', '19.68712', '1', '0', '0', '', 'dingan', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('44', '屯昌', '2', '21', 'T', '110.10857732457', '19.357374924278', '1', '0', '0', '', 'tunchang', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('45', '澄迈', '2', '21', 'C', '110.01399805849', '19.744836864024', '1', '0', '0', '', 'chengmai', '3', '0', '1570777544');
INSERT INTO `eju_region` VALUES ('46', '临高', '2', '21', 'L', '109.697443', '19.919475', '1', '0', '0', '', 'lingao', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('47', '白沙', '2', '21', 'B', '109.45747066911', '19.231378733013', '1', '0', '0', '', 'baisha', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('48', '昌江', '2', '21', 'C', '109.06246408734', '19.303997876684', '1', '0', '0', '', 'changjiang', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('49', '乐东', '2', '21', 'L', '109.18050798895', '18.755871493855', '1', '0', '0', '', 'ledong', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('50', '陵水', '2', '21', 'L', '110.04446409255', '18.512331595699', '1', '0', '0', '', 'lingshui', '5', '0', '1570777557');
INSERT INTO `eju_region` VALUES ('51', '保亭', '2', '21', 'B', '109.7034815143', '18.646909955376', '1', '0', '0', '', 'baoting', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('52', '琼中', '2', '21', 'Q', '109.84451062847', '19.039163789181', '1', '0', '0', '', 'qiongzhong', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('54', '广州', '2', '19', 'G', '113.27079303372', '23.135308099234', '0', '0', '0', '', 'guangzhou', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('55', '韶关', '2', '19', 'S', '113.602485', '24.815159', '0', '0', '0', '', 'shaoguan', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('56', '深圳', '2', '19', 'S', '114.064552', '22.548457', '0', '0', '0', '', 'shenchou', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('57', '珠海', '2', '19', 'Z', '113.582555', '22.276565', '0', '0', '0', '', 'zhuhai', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('58', '汕头', '2', '19', 'S', '116.688529', '23.359092', '0', '0', '0', '', 'shantou', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('59', '佛山', '2', '19', 'F', '113.128512', '23.027759', '0', '0', '0', '', 'fushan', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('60', '江门', '2', '19', 'J', '113.08495780795', '22.600969180275', '0', '0', '0', '', 'jiangmen', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('61', '湛江', '2', '19', 'Z', '110.371052', '21.289925', '0', '0', '0', '', 'zhanjiang', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('62', '茂名', '2', '19', 'M', '110.93154257997', '21.669064031332', '0', '0', '0', '', 'maoming', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('63', '肇庆', '2', '19', 'Z', '112.471489', '23.052889', '0', '0', '0', '', 'zhaoqing', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('64', '惠州', '2', '19', 'H', '114.423558', '23.116359', '0', '0', '0', '', 'huizhou', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('65', '梅州', '2', '19', 'M', '116.129537', '24.294178', '0', '0', '0', '', 'meizhou', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('66', '汕尾', '2', '19', 'S', '115.380793', '22.792459', '0', '0', '0', '', 'shanwei', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('67', '河源', '2', '19', 'H', '114.707446', '23.749684', '0', '0', '0', '', 'heyuan', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('68', '阳江', '2', '19', 'Y', '111.989675', '21.862327', '0', '0', '0', '', 'yangjiang', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('69', '清远', '2', '19', 'Q', '113.062468', '23.68823', '0', '0', '0', '', 'qingyuan', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('70', '东莞', '2', '19', 'D', '113.75842', '23.027308', '0', '0', '0', '', 'dongguan', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('71', '中山', '2', '19', 'Z', '113.398919', '22.524318', '0', '0', '0', '', 'zhongshan', '100', '0', '1569460552');
INSERT INTO `eju_region` VALUES ('72', '潮州', '2', '19', 'C', '116.628715', '23.662954', '0', '0', '0', '', 'chaozhou', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('73', '揭阳', '2', '19', 'J', '116.378692', '23.556933', '0', '0', '0', '', 'jieyang', '100', '0', '1569460553');
INSERT INTO `eju_region` VALUES ('74', '云浮', '2', '19', 'Y', '112.05083', '22.921045', '0', '0', '0', '', 'yunfu', '100', '0', '1569460553');

-- -----------------------------
-- Table structure for `eju_region_all`
-- -----------------------------
DROP TABLE IF EXISTS `eju_region_all`;
CREATE TABLE `eju_region_all` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(32) DEFAULT '' COMMENT '地区名称',
  `level` tinyint(4) DEFAULT '0' COMMENT '地区等级 分省市县区',
  `parent_id` int(10) DEFAULT '0' COMMENT '父id',
  `initial` varchar(5) DEFAULT '' COMMENT '首字母',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1：开启，0：隐藏）',
  `sort_order` int(6) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `level` (`level`,`status`) USING BTREE,
  KEY `initial` (`initial`,`sort_order`,`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=47929 DEFAULT CHARSET=utf8 COMMENT='区域表';

-- -----------------------------
-- Records of `eju_region_all`
-- -----------------------------
INSERT INTO `eju_region_all` VALUES ('1', '北京市', '1', '0', 'B', '0', '100', '0', '1569461730');
INSERT INTO `eju_region_all` VALUES ('2', '市辖区', '2', '1', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3', '东城区', '3', '2', 'D', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('14', '西城区', '3', '2', 'X', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('22', '崇文区', '3', '2', 'C', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('30', '宣武区', '3', '2', 'X', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('39', '朝阳区', '3', '2', 'C', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('83', '丰台区', '3', '2', 'F', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('105', '石景山区', '3', '2', 'S', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('115', '海淀区', '3', '2', 'H', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('145', '门头沟区', '3', '2', 'M', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('159', '房山区', '3', '2', 'F', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('188', '通州区', '3', '2', 'T', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('204', '顺义区', '3', '2', 'S', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('227', '昌平区', '3', '2', 'C', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('245', '大兴区', '3', '2', 'D', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('264', '怀柔区', '3', '2', 'H', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('281', '平谷区', '3', '2', 'P', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('300', '县', '2', '1', 'X', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('301', '密云县', '3', '300', 'M', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('322', '延庆县', '3', '300', 'Y', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('338', '天津市', '1', '0', 'T', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('339', '市辖区', '2', '338', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('340', '和平区', '3', '339', 'H', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('347', '河东区', '3', '339', 'H', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('361', '河西区', '3', '339', 'H', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('375', '南开区', '3', '339', 'N', '1', '100', '0', '1569460570');
INSERT INTO `eju_region_all` VALUES ('388', '河北区', '3', '339', 'H', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('399', '红桥区', '3', '339', 'H', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('410', '塘沽区', '3', '339', 'T', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('425', '汉沽区', '3', '339', 'H', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('435', '大港区', '3', '339', 'D', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('445', '东丽区', '3', '339', 'D', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('460', '西青区', '3', '339', 'X', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('473', '津南区', '3', '339', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('488', '北辰区', '3', '339', 'B', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('504', '武清区', '3', '339', 'W', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('538', '宝坻区', '3', '339', 'B', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('569', '市辖县', '2', '338', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('570', '宁河县', '3', '569', 'N', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('586', '静海县', '3', '569', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('608', '蓟县', '3', '569', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('636', '河北省', '1', '0', 'H', '1', '100', '0', '1569461732');
INSERT INTO `eju_region_all` VALUES ('637', '石家庄市', '2', '636', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('638', '市辖区', '3', '637', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('639', '长安区', '3', '637', 'C', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('651', '桥东区', '3', '637', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('662', '桥西区', '3', '637', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('675', '新华区', '3', '637', 'X', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('691', '井陉矿区', '3', '637', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('697', '裕华区', '3', '637', 'Y', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('708', '井陉县', '3', '637', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('726', '正定县', '3', '637', 'Z', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('736', '栾城县', '3', '637', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('745', '行唐县', '3', '637', 'X', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('761', '灵寿县', '3', '637', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('777', '高邑县', '3', '637', 'G', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('783', '深泽县', '3', '637', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('790', '赞皇县', '3', '637', 'Z', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('802', '无极县', '3', '637', 'W', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('814', '平山县', '3', '637', 'P', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('838', '元氏县', '3', '637', 'Y', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('854', '赵县', '3', '637', 'Z', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('866', '辛集市', '3', '637', 'X', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('882', '藁城市', '3', '637', 'G', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('898', '晋州市', '3', '637', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('909', '新乐市', '3', '637', 'X', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('922', '鹿泉市', '3', '637', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('936', '唐山市', '2', '636', 'T', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('937', '市辖区', '3', '936', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('938', '路南区', '3', '936', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('952', '路北区', '3', '936', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('965', '古冶区', '3', '936', 'G', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('977', '开平区', '3', '936', 'K', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('989', '丰南区', '3', '936', 'F', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1007', '丰润区', '3', '936', 'F', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1034', '滦县', '3', '936', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1048', '滦南县', '3', '936', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1067', '乐亭县', '3', '936', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1085', '迁西县', '3', '936', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1104', '玉田县', '3', '936', 'Y', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1125', '唐海县', '3', '936', 'T', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1140', '遵化市', '3', '936', 'Z', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1168', '迁安市', '3', '936', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1188', '秦皇岛市', '2', '636', 'Q', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('1189', '市辖区', '3', '1188', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1190', '海港区', '3', '1188', 'H', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1208', '山海关区', '3', '1188', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1218', '北戴河区', '3', '1188', 'B', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1223', '青龙县', '3', '1188', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1249', '昌黎县', '3', '1188', 'C', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1266', '抚宁县', '3', '1188', 'F', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1278', '卢龙县', '3', '1188', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1291', '邯郸市', '2', '636', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('1292', '市辖区', '3', '1291', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1293', '邯山区', '3', '1291', 'H', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1307', '丛台区', '3', '1291', 'C', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1319', '复兴区', '3', '1291', 'F', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1329', '峰峰矿区', '3', '1291', 'F', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1339', '邯郸县', '3', '1291', 'H', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1350', '临漳县', '3', '1291', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1365', '成安县', '3', '1291', 'C', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1375', '大名县', '3', '1291', 'D', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1396', '涉县', '3', '1291', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1414', '磁县', '3', '1291', 'C', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1434', '肥乡县', '3', '1291', 'F', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1444', '永年县', '3', '1291', 'Y', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1465', '邱县', '3', '1291', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1473', '鸡泽县', '3', '1291', 'J', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1481', '广平县', '3', '1291', 'G', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1489', '馆陶县', '3', '1291', 'G', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1498', '魏县', '3', '1291', 'W', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1520', '曲周县', '3', '1291', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1531', '武安市', '3', '1291', 'W', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1554', '邢台市', '2', '636', 'X', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('1555', '市辖区', '3', '1554', 'S', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1556', '桥东区', '3', '1554', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1564', '桥西区', '3', '1554', 'Q', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1572', '邢台县', '3', '1554', 'X', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1593', '临城县', '3', '1554', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1602', '内邱县', '3', '1554', 'N', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1612', '柏乡县', '3', '1554', 'B', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1619', '隆尧县', '3', '1554', 'L', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1633', '任县', '3', '1554', 'R', '1', '100', '0', '1569460571');
INSERT INTO `eju_region_all` VALUES ('1642', '南和县', '3', '1554', 'N', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1651', '宁晋县', '3', '1554', 'N', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1669', '巨鹿县', '3', '1554', 'J', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1680', '新河县', '3', '1554', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1687', '广宗县', '3', '1554', 'G', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1696', '平乡县', '3', '1554', 'P', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1704', '威县', '3', '1554', 'W', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1721', '清河县', '3', '1554', 'Q', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1728', '临西县', '3', '1554', 'L', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1738', '南宫市', '3', '1554', 'N', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1754', '沙河市', '3', '1554', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1772', '保定市', '2', '636', 'B', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('1773', '市辖区', '3', '1772', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1774', '新市区', '3', '1772', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1787', '北市区', '3', '1772', 'B', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1796', '南市区', '3', '1772', 'N', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1806', '满城县', '3', '1772', 'M', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1820', '清苑县', '3', '1772', 'Q', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1839', '涞水县', '3', '1772', 'L', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1856', '阜平县', '3', '1772', 'F', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1870', '徐水县', '3', '1772', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1885', '定兴县', '3', '1772', 'D', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1902', '唐县', '3', '1772', 'T', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1923', '高阳县', '3', '1772', 'G', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1933', '容城县', '3', '1772', 'R', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1942', '涞源县', '3', '1772', 'L', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1960', '望都县', '3', '1772', 'W', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1969', '安新县', '3', '1772', 'A', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('1982', '易县', '3', '1772', 'Y', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2010', '曲阳县', '3', '1772', 'Q', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2029', '蠡县', '3', '1772', 'L', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2043', '顺平县', '3', '1772', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2054', '博野县', '3', '1772', 'B', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2062', '雄县', '3', '1772', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2072', '涿州市', '3', '1772', 'Z', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2088', '定州市', '3', '1772', 'D', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2114', '安国市', '3', '1772', 'A', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2126', '高碑店市', '3', '1772', 'G', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2142', '张家口市', '2', '636', 'Z', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('2143', '市辖区', '3', '2142', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2144', '桥东区', '3', '2142', 'Q', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2154', '桥西区', '3', '2142', 'Q', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2164', '宣化区', '3', '2142', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2176', '下花园区', '3', '2142', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2183', '宣化县', '3', '2142', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2198', '张北县', '3', '2142', 'Z', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2220', '康保县', '3', '2142', 'K', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2237', '沽源县', '3', '2142', 'G', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2256', '尚义县', '3', '2142', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2271', '蔚县', '3', '2142', 'W', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2294', '阳原县', '3', '2142', 'Y', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2309', '怀安县', '3', '2142', 'H', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2321', '万全县', '3', '2142', 'W', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2333', '怀来县', '3', '2142', 'H', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2351', '涿鹿县', '3', '2142', 'Z', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2369', '赤城县', '3', '2142', 'C', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2388', '崇礼县', '3', '2142', 'C', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2400', '承德市', '2', '636', 'C', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('2401', '市辖区', '3', '2400', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2402', '双桥区', '3', '2400', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2415', '双滦区', '3', '2400', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2422', '鹰手营子矿区', '3', '2400', 'Y', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2427', '承德县', '3', '2400', 'C', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2453', '兴隆县', '3', '2400', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2474', '平泉县', '3', '2400', 'P', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2494', '滦平县', '3', '2400', 'L', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2517', '隆化县', '3', '2400', 'L', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2543', '丰宁县', '3', '2400', 'F', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2570', '宽城县', '3', '2400', 'K', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2589', '围场县', '3', '2400', 'W', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2629', '沧州市', '2', '636', 'C', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('2630', '市辖区', '3', '2629', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2631', '新华区', '3', '2629', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2639', '运河区', '3', '2629', 'Y', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2648', '沧县', '3', '2629', 'C', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2668', '青县', '3', '2629', 'Q', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2680', '东光县', '3', '2629', 'D', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2690', '海兴县', '3', '2629', 'H', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2701', '盐山县', '3', '2629', 'Y', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2714', '肃宁县', '3', '2629', 'S', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2724', '南皮县', '3', '2629', 'N', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2734', '吴桥县', '3', '2629', 'W', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2745', '献县', '3', '2629', 'X', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2765', '孟村县', '3', '2629', 'M', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2772', '泊头市', '3', '2629', 'B', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2788', '任邱市', '3', '2629', 'R', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2809', '黄骅市', '3', '2629', 'H', '1', '100', '0', '1569460572');
INSERT INTO `eju_region_all` VALUES ('2828', '河间市', '3', '2629', 'H', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2849', '廊坊市', '2', '636', 'L', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('2850', '市辖区', '3', '2849', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2851', '安次区', '3', '2849', 'A', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2862', '广阳区', '3', '2849', 'G', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2873', '固安县', '3', '2849', 'G', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2883', '永清县', '3', '2849', 'Y', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2895', '香河县', '3', '2849', 'X', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2906', '大城县', '3', '2849', 'D', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2918', '文安县', '3', '2849', 'W', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2932', '大厂县', '3', '2849', 'D', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2939', '霸州市', '3', '2849', 'B', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2953', '三河市', '3', '2849', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2968', '衡水市', '2', '636', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('2969', '市辖区', '3', '2968', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2970', '桃城区', '3', '2968', 'T', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2983', '枣强县', '3', '2968', 'Z', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('2995', '武邑县', '3', '2968', 'W', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3005', '武强县', '3', '2968', 'W', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3012', '饶阳县', '3', '2968', 'R', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3020', '安平县', '3', '2968', 'A', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3029', '故城县', '3', '2968', 'G', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3043', '景县', '3', '2968', 'J', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3060', '阜城县', '3', '2968', 'F', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3071', '冀州市', '3', '2968', 'J', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3083', '深州市', '3', '2968', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3102', '山西', '1', '0', 'S', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('3103', '太原市', '2', '3102', 'T', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3104', '市辖区', '3', '3103', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3105', '小店区(人口含高新经济区)', '3', '3103', 'X', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3117', '迎泽区', '3', '3103', 'Y', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3126', '杏花岭区', '3', '3103', 'X', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3140', '尖草坪区', '3', '3103', 'J', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3155', '万柏林区', '3', '3103', 'W', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3171', '晋源区', '3', '3103', 'J', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3178', '清徐县', '3', '3103', 'Q', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3188', '阳曲县', '3', '3103', 'Y', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3200', '娄烦县', '3', '3103', 'L', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3209', '古交市', '3', '3103', 'G', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3224', '大同市', '2', '3102', 'D', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3225', '市辖区', '3', '3224', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3226', '大同市城区', '3', '3224', 'D', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3241', '矿区', '3', '3224', 'K', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3266', '南郊区', '3', '3224', 'N', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3277', '新荣区', '3', '3224', 'X', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3286', '阳高县', '3', '3224', 'Y', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3300', '天镇县', '3', '3224', 'T', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3312', '广灵县', '3', '3224', 'G', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3322', '灵丘县', '3', '3224', 'L', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3335', '浑源县', '3', '3224', 'H', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3354', '左云县', '3', '3224', 'Z', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3364', '大同县', '3', '3224', 'D', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3379', '阳泉市', '2', '3102', 'Y', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3380', '市辖区', '3', '3379', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3381', '城区', '3', '3379', 'C', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3388', '矿区', '3', '3379', 'K', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3395', '郊区', '3', '3379', 'J', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3405', '平定县', '3', '3379', 'P', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3416', '盂县', '3', '3379', 'Y', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3431', '长治市', '2', '3102', 'C', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3432', '市辖区', '3', '3431', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3433', '长治市城区', '3', '3431', 'C', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3445', '长治市郊区', '3', '3431', 'C', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3454', '长治县', '3', '3431', 'C', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3466', '襄垣县', '3', '3431', 'X', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3478', '屯留县', '3', '3431', 'T', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3493', '平顺县', '3', '3431', 'P', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3506', '黎城县', '3', '3431', 'L', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3516', '壶关县', '3', '3431', 'H', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3530', '长子县', '3', '3431', 'C', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3543', '武乡县', '3', '3431', 'W', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3558', '沁县', '3', '3431', 'Q', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3572', '沁源县', '3', '3431', 'Q', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3587', '潞城市', '3', '3431', 'L', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3597', '晋城市', '2', '3102', 'J', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3598', '市辖区', '3', '3597', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3599', '晋城市城区', '3', '3597', 'J', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3608', '沁水县', '3', '3597', 'Q', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3623', '阳城县', '3', '3597', 'Y', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3642', '陵川县', '3', '3597', 'L', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3655', '泽州县', '3', '3597', 'Z', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3673', '高平市', '3', '3597', 'G', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3690', '朔州市', '2', '3102', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3691', '市辖区', '3', '3690', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3692', '朔城区', '3', '3690', 'S', '1', '100', '0', '1569460573');
INSERT INTO `eju_region_all` VALUES ('3709', '平鲁区', '3', '3690', 'P', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3723', '山阴县', '3', '3690', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3739', '应县', '3', '3690', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3752', '右玉县', '3', '3690', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3763', '怀仁县', '3', '3690', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3776', '晋中市', '2', '3102', 'J', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3777', '市辖区', '3', '3776', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3778', '榆次区', '3', '3776', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3799', '榆社县', '3', '3776', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3810', '左权县', '3', '3776', 'Z', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3822', '和顺县', '3', '3776', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3833', '昔阳县', '3', '3776', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3846', '寿阳县', '3', '3776', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3861', '太谷县', '3', '3776', 'T', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3871', '祁县', '3', '3776', 'Q', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3880', '平遥县', '3', '3776', 'P', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3895', '灵石县', '3', '3776', 'L', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3908', '介休市', '3', '3776', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3925', '运城市', '2', '3102', 'Y', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('3926', '市辖区', '3', '3925', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3927', '盐湖区', '3', '3925', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3950', '临猗县', '3', '3925', 'L', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3967', '万荣县', '3', '3925', 'W', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3982', '闻喜县', '3', '3925', 'W', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('3996', '稷山县', '3', '3925', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4004', '新绛县', '3', '3925', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4013', '绛县', '3', '3925', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4024', '垣曲县', '3', '3925', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4036', '夏县', '3', '3925', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4048', '平陆县', '3', '3925', 'P', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4059', '芮城县', '3', '3925', 'R', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4070', '永济市', '3', '3925', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4082', '河津市', '3', '3925', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4093', '忻州市', '2', '3102', 'X', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4094', '市辖区', '3', '4093', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4095', '忻府区', '3', '4093', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4116', '定襄县', '3', '4093', 'D', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4126', '五台县', '3', '4093', 'W', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4146', '代县', '3', '4093', 'D', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4158', '繁峙县', '3', '4093', 'F', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4172', '宁武县', '3', '4093', 'N', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4189', '静乐县', '3', '4093', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4204', '神池县', '3', '4093', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4215', '五寨县', '3', '4093', 'W', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4228', '岢岚县', '3', '4093', 'K', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4241', '河曲县', '3', '4093', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4255', '保德县', '3', '4093', 'B', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4269', '偏关县', '3', '4093', 'P', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4280', '原平市', '3', '4093', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4304', '临汾市', '2', '3102', 'L', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4305', '市辖区', '3', '4304', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4306', '尧都区', '3', '4304', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4333', '曲沃县', '3', '4304', 'Q', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4341', '翼城县', '3', '4304', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4352', '襄汾县', '3', '4304', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4366', '洪洞县', '3', '4304', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4383', '古县', '3', '4304', 'G', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4391', '安泽县', '3', '4304', 'A', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4399', '浮山县', '3', '4304', 'F', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4409', '吉县', '3', '4304', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4418', '乡宁县', '3', '4304', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4429', '大宁县', '3', '4304', 'D', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4436', '隰县', '3', '4304', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4445', '永和县', '3', '4304', 'Y', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4453', '蒲县', '3', '4304', 'P', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4463', '汾西县', '3', '4304', 'F', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4472', '侯马市', '3', '4304', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4481', '霍州市', '3', '4304', 'H', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4494', '吕梁市', '2', '3102', 'L', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4495', '市辖区', '3', '4494', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4496', '离石区', '3', '4494', 'L', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4509', '文水县', '3', '4494', 'W', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4522', '交城县', '3', '4494', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4533', '兴县', '3', '4494', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4551', '临县', '3', '4494', 'L', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4575', '柳林县', '3', '4494', 'L', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4591', '石楼县', '3', '4494', 'S', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4601', '岚县', '3', '4494', 'L', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4614', '方山县', '3', '4494', 'F', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4622', '中阳县', '3', '4494', 'Z', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4630', '交口县', '3', '4494', 'J', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4638', '孝义市', '3', '4494', 'X', '1', '100', '0', '1569460574');
INSERT INTO `eju_region_all` VALUES ('4655', '汾阳市', '3', '4494', 'F', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4670', '内蒙古', '1', '0', 'N', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('4671', '呼和浩特市', '2', '4670', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4672', '市辖区', '3', '4671', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4673', '新城区', '3', '4671', 'X', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4684', '回民区', '3', '4671', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4693', '玉泉区', '3', '4671', 'Y', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4702', '赛罕区', '3', '4671', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4715', '土左旗', '3', '4671', 'T', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4727', '托克托县', '3', '4671', 'T', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4733', '和林格尔县', '3', '4671', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4742', '清水河县', '3', '4671', 'Q', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4749', '武川县', '3', '4671', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4759', '包头市', '2', '4670', 'B', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4760', '市辖区', '3', '4759', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4761', '东河区', '3', '4759', 'D', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4775', '昆都仑区', '3', '4759', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4791', '青山区', '3', '4759', 'Q', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4803', '石拐区', '3', '4759', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4810', '白云鄂博矿区', '3', '4759', 'B', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4813', '九原区', '3', '4759', 'J', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4823', '土默特右旗', '3', '4759', 'T', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4833', '固阳县', '3', '4759', 'G', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4840', '达茂联合旗', '3', '4759', 'D', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4849', '乌海市', '2', '4670', 'W', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4850', '乌海市辖区', '3', '4849', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4851', '海勃湾区', '3', '4849', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4859', '海南区', '3', '4849', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4865', '乌达区', '3', '4849', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4874', '赤峰市', '2', '4670', 'C', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('4875', '市辖区', '3', '4874', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4876', '红山区', '3', '4874', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4888', '元宝山区', '3', '4874', 'Y', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4896', '松山区', '3', '4874', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4919', '阿鲁科尔沁旗', '3', '4874', 'A', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4932', '巴林左旗', '3', '4874', 'B', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4944', '巴林右旗', '3', '4874', 'B', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4953', '林西县', '3', '4874', 'L', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4963', '克什克腾旗', '3', '4874', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4975', '翁牛特旗', '3', '4874', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4988', '喀喇沁旗', '3', '4874', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('4999', '宁城县', '3', '4874', 'N', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5013', '敖汉旗', '3', '4874', 'A', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5029', '通辽市', '2', '4670', 'T', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5030', '市辖区', '3', '5029', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5031', '科尔沁区', '3', '5029', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5062', '科尔沁左翼中旗', '3', '5029', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5079', '科左后旗', '3', '5029', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5104', '开鲁县', '3', '5029', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5118', '库伦旗', '3', '5029', 'K', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5125', '奈曼旗', '3', '5029', 'N', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5139', '扎鲁特旗', '3', '5029', 'Z', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5155', '霍林郭勒市', '3', '5029', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5162', '鄂尔多斯市', '2', '4670', 'E', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5163', '东胜区', '3', '5162', 'D', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5176', '达拉特旗', '3', '5162', 'D', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5185', '准格尔旗', '3', '5162', 'Z', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5195', '鄂托克前旗', '3', '5162', 'E', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5201', '鄂托克旗', '3', '5162', 'E', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5210', '杭锦旗', '3', '5162', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5219', '乌审旗', '3', '5162', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5228', '伊金霍洛旗', '3', '5162', 'Y', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5236', '呼伦贝尔市', '2', '4670', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5237', '市辖区', '3', '5236', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5238', '海拉尔区', '3', '5236', 'H', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5249', '阿荣旗', '3', '5236', 'A', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5262', '莫力达瓦旗', '3', '5236', 'M', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5277', '鄂伦春旗', '3', '5236', 'E', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5303', '鄂温旗', '3', '5236', 'E', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5314', '陈巴尔虎旗镇', '3', '5236', 'C', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5323', '新巴尔虎左旗', '3', '5236', 'X', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5330', '新巴尔虎右旗', '3', '5236', 'X', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5337', '满洲里市', '3', '5236', 'M', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5354', '牙克石市', '3', '5236', 'Y', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5371', '扎兰屯市', '3', '5236', 'Z', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5397', '额尔古纳市', '3', '5236', 'E', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5410', '根河市', '3', '5236', 'G', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5418', '巴彦淖尔市', '2', '4670', 'B', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5419', '市辖区', '3', '5418', 'S', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5420', '临河区', '3', '5418', 'L', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5440', '五原县', '3', '5418', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5450', '磴口县', '3', '5418', 'D', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5461', '乌拉特前旗', '3', '5418', 'W', '1', '100', '0', '1569460575');
INSERT INTO `eju_region_all` VALUES ('5477', '乌拉特中旗', '3', '5418', 'W', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5489', '乌拉特后旗', '3', '5418', 'W', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5495', '杭锦后旗', '3', '5418', 'H', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5505', '乌兰察布市', '2', '4670', 'W', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5506', '市辖区', '3', '5505', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5507', '集宁区', '3', '5505', 'J', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5518', '卓资县', '3', '5505', 'Z', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5526', '化德县', '3', '5505', 'H', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5532', '商都县', '3', '5505', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5542', '兴和县', '3', '5505', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5551', '凉城县', '3', '5505', 'L', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5562', '察哈尔右翼前旗', '3', '5505', 'C', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5571', '察右中旗', '3', '5505', 'C', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5582', '察哈尔右翼后旗', '3', '5505', 'C', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5590', '四子王旗', '3', '5505', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5603', '丰镇市', '3', '5505', 'F', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5616', '兴安盟', '2', '4670', 'X', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5617', '乌兰浩特市', '3', '5616', 'W', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5629', '阿尔山市', '3', '5616', 'A', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5636', '科右前旗', '3', '5616', 'K', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5655', '科右中旗', '3', '5616', 'K', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5677', '扎赉特旗', '3', '5616', 'Z', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5692', '突泉县', '3', '5616', 'T', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5702', '锡林郭勒盟', '2', '4670', 'X', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5703', '二连浩特市', '3', '5702', 'E', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5709', '锡林浩特市', '3', '5702', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5723', '阿巴嘎旗', '3', '5702', 'A', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5731', '苏尼特左旗', '3', '5702', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5738', '苏尼特右旗', '3', '5702', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5745', '东乌珠穆沁旗', '3', '5702', 'D', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5758', '西乌珠穆沁旗', '3', '5702', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5766', '太仆寺旗', '3', '5702', 'T', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5774', '镶黄旗', '3', '5702', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5778', '正镶白旗', '3', '5702', 'Z', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5785', '正蓝旗', '3', '5702', 'Z', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5794', '多伦县', '3', '5702', 'D', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5799', '阿拉善盟', '2', '4670', 'A', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5800', '阿拉善左旗', '3', '5799', 'A', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5814', '阿拉善右旗', '3', '5799', 'A', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5820', '额济纳旗', '3', '5799', 'E', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5827', '辽宁省', '1', '0', 'L', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('5828', '沈阳市', '2', '5827', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('5829', '市辖区', '3', '5828', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5830', '和平区', '3', '5828', 'H', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5848', '沈河区', '3', '5828', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5859', '大东区', '3', '5828', 'D', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5873', '皇姑区', '3', '5828', 'H', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5894', '铁西区', '3', '5828', 'T', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5909', '苏家屯区', '3', '5828', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5934', '东陵区', '3', '5828', 'D', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5954', '新城子区', '3', '5828', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5975', '于洪区', '3', '5828', 'Y', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('5998', '辽中县', '3', '5828', 'L', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6020', '康平县', '3', '5828', 'K', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6038', '法库县', '3', '5828', 'F', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6058', '新民市', '3', '5828', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6088', '大连市', '2', '5827', 'D', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6089', '市辖区', '3', '6088', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6090', '中山区', '3', '6088', 'Z', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6099', '西岗区', '3', '6088', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6107', '沙河口区', '3', '6088', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6117', '甘井子区', '3', '6088', 'G', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6137', '旅顺口区', '3', '6088', 'L', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6153', '金州区', '3', '6088', 'J', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6178', '长海县', '3', '6088', 'C', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6184', '瓦房店市', '3', '6088', 'W', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6217', '普兰店市', '3', '6088', 'P', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6239', '庄河市', '3', '6088', 'Z', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6266', '鞍山市', '2', '5827', 'A', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6267', '市辖区', '3', '6266', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6268', '铁东区', '3', '6266', 'T', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6282', '铁西区', '3', '6266', 'T', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6293', '立山区', '3', '6266', 'L', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6303', '千山区', '3', '6266', 'Q', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6316', '台安县', '3', '6266', 'T', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6331', '岫岩县', '3', '6266', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6354', '海城市', '3', '6266', 'H', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6384', '抚顺市', '2', '5827', 'F', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6385', '市辖区', '3', '6384', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6386', '新抚区', '3', '6384', 'X', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6395', '东洲区', '3', '6384', 'D', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6409', '望花区', '3', '6384', 'W', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6422', '顺城区', '3', '6384', 'S', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6432', '抚顺县', '3', '6384', 'F', '1', '100', '0', '1569460576');
INSERT INTO `eju_region_all` VALUES ('6445', '新宾县', '3', '6384', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6461', '清原县', '3', '6384', 'Q', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6476', '本溪市', '2', '5827', 'B', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6477', '市辖区', '3', '6476', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6478', '平山区', '3', '6476', 'P', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6488', '溪湖区', '3', '6476', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6499', '明山区', '3', '6476', 'M', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6509', '南芬区', '3', '6476', 'N', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6515', '本溪县', '3', '6476', 'B', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6528', '桓仁县', '3', '6476', 'H', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6542', '丹东市', '2', '5827', 'D', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6543', '市辖区', '3', '6542', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6544', '元宝区', '3', '6542', 'Y', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6552', '振兴区', '3', '6542', 'Z', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6563', '振安区', '3', '6542', 'Z', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6573', '宽甸县', '3', '6542', 'K', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6596', '东港市', '3', '6542', 'D', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6621', '凤城市', '3', '6542', 'F', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6643', '锦州市', '2', '5827', 'J', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6644', '市辖区', '3', '6643', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6645', '古塔区', '3', '6643', 'G', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6655', '凌河区', '3', '6643', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6668', '太和区', '3', '6643', 'T', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6683', '黑山县', '3', '6643', 'H', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6706', '义县', '3', '6643', 'Y', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6725', '凌海市', '3', '6643', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6750', '北镇市', '3', '6643', 'B', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6771', '营口市', '2', '5827', 'Y', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6772', '市辖区', '3', '6771', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6773', '站前区', '3', '6771', 'Z', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6781', '西市区', '3', '6771', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6789', '鲅鱼圈区', '3', '6771', 'B', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6797', '老边区', '3', '6771', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6804', '盖州市', '3', '6771', 'G', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6832', '大石桥市', '3', '6771', 'D', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6851', '阜新市', '2', '5827', 'F', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6852', '市辖区', '3', '6851', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6853', '海州区', '3', '6851', 'H', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6865', '新邱区', '3', '6851', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6871', '太平区', '3', '6851', 'T', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6878', '清河门区', '3', '6851', 'Q', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6885', '细河区', '3', '6851', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6893', '阜新县', '3', '6851', 'F', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6930', '彰武县', '3', '6851', 'Z', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6955', '辽阳市', '2', '5827', 'L', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('6956', '市辖区', '3', '6955', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6957', '白塔区', '3', '6955', 'B', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6964', '文圣区', '3', '6955', 'W', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6971', '宏伟区', '3', '6955', 'H', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6977', '弓长岭区', '3', '6955', 'G', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6983', '太子河区', '3', '6955', 'T', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('6989', '辽阳县', '3', '6955', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7007', '灯塔市', '3', '6955', 'D', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7024', '盘锦市', '2', '5827', 'P', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7025', '市辖区', '3', '7024', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7026', '双台子区', '3', '7024', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7036', '兴隆台区', '3', '7024', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7055', '大洼县', '3', '7024', 'D', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7072', '盘山县', '3', '7024', 'P', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7088', '铁岭市', '2', '5827', 'T', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7089', '市辖区', '3', '7088', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7090', '银州区', '3', '7088', 'Y', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7099', '清河区', '3', '7088', 'Q', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7105', '铁岭县', '3', '7088', 'T', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7121', '西丰县', '3', '7088', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7140', '昌图县', '3', '7088', 'C', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7180', '调兵山市', '3', '7088', 'D', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7186', '开原市', '3', '7088', 'K', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7208', '朝阳市', '2', '5827', 'C', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7209', '市辖区', '3', '7208', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7210', '双塔区', '3', '7208', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7225', '龙城区', '3', '7208', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7238', '朝阳县', '3', '7208', 'C', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7267', '建平县', '3', '7208', 'J', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7299', '喀喇沁左翼县', '3', '7208', 'K', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7322', '北票市', '3', '7208', 'B', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7360', '凌源市', '3', '7208', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7391', '葫芦岛市', '2', '5827', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7392', '市辖区', '3', '7391', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7393', '连山区', '3', '7391', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7419', '龙港区', '3', '7391', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7433', '南票区', '3', '7391', 'N', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7446', '绥中县', '3', '7391', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7474', '建昌县', '3', '7391', 'J', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7503', '兴城市', '3', '7391', 'X', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7531', '吉林省', '1', '0', 'J', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('7532', '长春市', '2', '7531', 'C', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7533', '长春市辖区', '3', '7532', 'C', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7534', '南关区', '3', '7532', 'N', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7552', '宽城区', '3', '7532', 'K', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7569', '朝阳区', '3', '7532', 'C', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7582', '二道区', '3', '7532', 'E', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7597', '绿园区', '3', '7532', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7610', '双阳区', '3', '7532', 'S', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7619', '农安县', '3', '7532', 'N', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7642', '九台市', '3', '7532', 'J', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7658', '榆树市', '3', '7532', 'Y', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7687', '德惠市', '3', '7532', 'D', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7706', '吉林市', '2', '7531', 'J', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7707', '吉林市辖区', '3', '7706', 'J', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7708', '昌邑区', '3', '7706', 'C', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7731', '龙潭区', '3', '7706', 'L', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7752', '船营区', '3', '7706', 'C', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7768', '丰满区', '3', '7706', 'F', '1', '100', '0', '1569460577');
INSERT INTO `eju_region_all` VALUES ('7781', '永吉县', '3', '7706', 'Y', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7792', '蛟河市', '3', '7706', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7810', '桦甸市', '3', '7706', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7828', '舒兰市', '3', '7706', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7849', '磐石市', '3', '7706', 'P', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7868', '四平市', '2', '7531', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7869', '四平市辖区', '3', '7868', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7870', '铁西区', '3', '7868', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7878', '铁东区', '3', '7868', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7892', '梨树县', '3', '7868', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7916', '伊通县', '3', '7868', 'Y', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7933', '公主岭市', '3', '7868', 'G', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7964', '双辽市', '3', '7868', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7986', '辽源市', '2', '7531', 'L', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('7987', '辽源市辖区', '3', '7986', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('7988', '龙山区', '3', '7986', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8000', '西安区', '3', '7986', 'X', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8008', '东丰县', '3', '7986', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8023', '东辽县', '3', '7986', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8037', '通化市', '2', '7531', 'T', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8038', '通化市辖区', '3', '8037', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8039', '东昌区', '3', '8037', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8051', '二道江区', '3', '8037', 'E', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8058', '通化县', '3', '8037', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8076', '辉南县', '3', '8037', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8088', '柳河县', '3', '8037', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8104', '梅河口市', '3', '8037', 'M', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8129', '集安市', '3', '8037', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8144', '白山市', '2', '7531', 'B', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8145', '白山市辖区', '3', '8144', 'B', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8146', '八道江区', '3', '8144', 'B', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8159', '江源区', '3', '8144', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8168', '抚松县', '3', '8144', 'F', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8183', '靖宇县', '3', '8144', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8192', '长白县', '3', '8144', 'C', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8202', '临江市', '3', '8144', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8216', '松原市', '2', '7531', 'S', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8217', '松原市辖区', '3', '8216', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8218', '宁江区', '3', '8216', 'N', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8239', '前郭县', '3', '8216', 'Q', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8266', '长岭县', '3', '8216', 'C', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8300', '乾安县', '3', '8216', 'Q', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8311', '扶余县', '3', '8216', 'F', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8333', '白城市', '2', '7531', 'B', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8334', '白城市辖区', '3', '8333', 'B', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8335', '洮北区', '3', '8333', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8362', '镇赉县', '3', '8333', 'Z', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8375', '通榆县', '3', '8333', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8393', '洮南市', '3', '8333', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8420', '大安市', '3', '8333', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8445', '延边州', '2', '7531', 'Y', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8446', '延吉市', '3', '8445', 'Y', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8456', '图们市', '3', '8445', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8464', '敦化市', '3', '8445', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8489', '珲春市', '3', '8445', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8504', '龙井市', '3', '8445', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8515', '和龙市', '3', '8445', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8530', '汪清县', '3', '8445', 'W', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8545', '安图县', '3', '8445', 'A', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8558', '黑龙江省', '1', '0', 'H', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('8559', '哈尔滨市', '2', '8558', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8560', '市辖区', '3', '8559', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8561', '道里区', '3', '8559', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8585', '南岗区', '3', '8559', 'N', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8606', '道外区', '3', '8559', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8633', '平房区', '3', '8559', 'P', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8642', '松北区', '3', '8559', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8650', '香坊区', '3', '8559', 'X', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8676', '呼兰区', '3', '8559', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8694', '阿城区', '3', '8559', 'A', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8714', '依兰县', '3', '8559', 'Y', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8729', '方正县', '3', '8559', 'F', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8740', '宾县', '3', '8559', 'B', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8758', '巴彦县', '3', '8559', 'B', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8778', '木兰县', '3', '8559', 'M', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8788', '通河县', '3', '8559', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8800', '延寿县', '3', '8559', 'Y', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8812', '双城市', '3', '8559', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8838', '尚志市', '3', '8559', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8858', '五常市', '3', '8559', 'W', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8884', '齐齐哈尔市', '2', '8558', 'Q', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('8885', '市辖区', '3', '8884', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8886', '龙沙区', '3', '8884', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8894', '建华区', '3', '8884', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8901', '铁锋区', '3', '8884', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8911', '昂昂溪区', '3', '8884', 'A', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8918', '富拉尔基区', '3', '8884', 'F', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8928', '碾子山区', '3', '8884', 'N', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8934', '梅里斯达斡尔族区', '3', '8884', 'M', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8943', '龙江县', '3', '8884', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8958', '依安县', '3', '8884', 'Y', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8976', '泰来县', '3', '8884', 'T', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('8998', '甘南县', '3', '8884', 'G', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9011', '富裕县', '3', '8884', 'F', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9024', '克山县', '3', '8884', 'K', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9048', '克东县', '3', '8884', 'K', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9067', '拜泉县', '3', '8884', 'B', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9084', '讷河市', '3', '8884', 'N', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9117', '鸡西市', '2', '8558', 'J', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('9118', '市辖区', '3', '9117', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9119', '鸡冠区', '3', '9117', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9129', '恒山区', '3', '9117', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9139', '滴道区', '3', '9117', 'D', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9146', '梨树区', '3', '9117', 'L', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9153', '城子河区', '3', '9117', 'C', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9161', '麻山区', '3', '9117', 'M', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9164', '鸡东县', '3', '9117', 'J', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9178', '虎林市', '3', '9117', 'H', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9199', '密山市', '3', '9117', 'M', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9222', '鹤岗市', '2', '8558', 'H', '1', '100', '0', '1569460550');
INSERT INTO `eju_region_all` VALUES ('9223', '市辖区', '3', '9222', 'S', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9224', '向阳区', '3', '9222', 'X', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9230', '工农区', '3', '9222', 'G', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9237', '南山区', '3', '9222', 'N', '1', '100', '0', '1569460578');
INSERT INTO `eju_region_all` VALUES ('9244', '兴安区', '3', '9222', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9250', '东山区', '3', '9222', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9261', '兴山区', '3', '9222', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9266', '萝北县', '3', '9222', 'L', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9283', '绥滨县', '3', '9222', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9296', '双鸭山市', '2', '8558', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('9297', '市辖区', '3', '9296', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9298', '尖山区', '3', '9296', 'J', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9307', '岭东区', '3', '9296', 'L', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9317', '四方台区', '3', '9296', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9323', '宝山区', '3', '9296', 'B', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9335', '集贤县', '3', '9296', 'J', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9356', '友谊县', '3', '9296', 'Y', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9370', '宝清县', '3', '9296', 'B', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9393', '饶河县', '3', '9296', 'R', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9419', '大庆市', '2', '8558', 'D', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('9420', '市辖区', '3', '9419', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9421', '萨尔图区', '3', '9419', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9431', '龙凤区', '3', '9419', 'L', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9440', '让胡路区', '3', '9419', 'R', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9451', '红岗区', '3', '9419', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9458', '大同区', '3', '9419', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9474', '肇州县', '3', '9419', 'Z', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9489', '肇源县', '3', '9419', 'Z', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9514', '林甸县', '3', '9419', 'L', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9527', '杜尔伯特县', '3', '9419', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9553', '伊春市', '2', '8558', 'Y', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('9554', '市辖区', '3', '9553', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9555', '伊春区', '3', '9553', 'Y', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9561', '南岔区', '3', '9553', 'N', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9581', '友好区', '3', '9553', 'Y', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9599', '西林区', '3', '9553', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9603', '翠峦区', '3', '9553', 'C', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9614', '新青区', '3', '9553', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9631', '美溪区', '3', '9553', 'M', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9647', '金山屯区', '3', '9553', 'J', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9660', '五营区', '3', '9553', 'W', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9671', '乌马河区', '3', '9553', 'W', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9685', '汤旺河区', '3', '9553', 'T', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9702', '带岭区', '3', '9553', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9715', '乌伊岭区', '3', '9553', 'W', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9729', '红星区', '3', '9553', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9742', '上甘岭区', '3', '9553', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9756', '嘉荫县', '3', '9553', 'J', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9772', '铁力市', '3', '9553', 'T', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9785', '佳木斯市', '2', '8558', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('9786', '市辖区', '3', '9785', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9787', '向阳区', '3', '9785', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9795', '前进区', '3', '9785', 'Q', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9802', '东风区', '3', '9785', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9810', '郊区', '3', '9785', 'J', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9825', '桦南县', '3', '9785', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9839', '桦川县', '3', '9785', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9851', '汤原县', '3', '9785', 'T', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9866', '抚远县', '3', '9785', 'F', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9879', '同江市', '3', '9785', 'T', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9907', '富锦市', '3', '9785', 'F', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9930', '七台河市', '2', '8558', 'Q', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('9931', '市辖区', '3', '9930', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9932', '新兴区', '3', '9930', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9944', '桃山区', '3', '9930', 'T', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9952', '茄子河区', '3', '9930', 'Q', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9962', '勃利县', '3', '9930', 'B', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9981', '牡丹江市', '2', '8558', 'M', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('9982', '市辖区', '3', '9981', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9983', '东安区', '3', '9981', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9989', '阳明区', '3', '9981', 'Y', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('9996', '爱民区', '3', '9981', 'A', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10005', '西安区', '3', '9981', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10014', '东宁县', '3', '9981', 'D', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10022', '林口县', '3', '9981', 'L', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10036', '绥芬河市', '3', '9981', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10039', '海林市', '3', '9981', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10056', '宁安市', '3', '9981', 'N', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10072', '穆棱市', '3', '9981', 'M', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10084', '黑河市', '2', '8558', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10085', '市辖区', '3', '10084', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10086', '爱辉区', '3', '10084', 'A', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10122', '嫩江县', '3', '10084', 'N', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10150', '逊克县', '3', '10084', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10168', '孙吴县', '3', '10084', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10192', '北安市', '3', '10084', 'B', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10214', '五大连池市', '3', '10084', 'W', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10252', '绥化市', '2', '8558', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10253', '市辖区', '3', '10252', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10254', '北林区', '3', '10252', 'B', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10281', '望奎县', '3', '10252', 'W', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10301', '兰西县', '3', '10252', 'L', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10320', '青冈县', '3', '10252', 'Q', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10342', '庆安县', '3', '10252', 'Q', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10360', '明水县', '3', '10252', 'M', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10380', '绥棱县', '3', '10252', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10401', '安达市', '3', '10252', 'A', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10425', '肇东市', '3', '10252', 'Z', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10452', '海伦市', '3', '10252', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10483', '大兴安岭地区', '2', '8558', 'D', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10484', '加格达奇区', '3', '10483', 'J', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10495', '松岭区', '3', '10483', 'S', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10500', '新林区', '3', '10483', 'X', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10509', '呼中区', '3', '10483', 'H', '1', '100', '0', '1569460579');
INSERT INTO `eju_region_all` VALUES ('10515', '呼玛县', '3', '10483', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10525', '塔河县', '3', '10483', 'T', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10534', '漠河县', '3', '10483', 'M', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10543', '上海市', '1', '0', 'S', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('10544', '市辖区', '2', '10543', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10545', '黄浦区', '3', '10544', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10555', '卢湾区', '3', '10544', 'L', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10560', '徐汇区', '3', '10544', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10575', '长宁区', '3', '10544', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10586', '静安区', '3', '10544', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10592', '普陀区', '3', '10544', 'P', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10602', '闸北区', '3', '10544', 'Z', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10612', '虹口区', '3', '10544', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10623', '杨浦区', '3', '10544', 'Y', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10636', '闵行区', '3', '10544', 'M', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10650', '宝山区', '3', '10544', 'B', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10664', '嘉定区', '3', '10544', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10678', '浦东新区', '3', '10544', 'P', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10704', '金山区', '3', '10544', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10715', '松江区', '3', '10544', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10735', '青浦区', '3', '10544', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10747', '南汇区', '3', '10544', 'N', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10765', '奉贤区', '3', '10544', 'F', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10779', '县', '2', '10543', 'X', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10780', '崇明县', '3', '10779', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10808', '江苏省', '1', '0', 'J', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('10809', '南京市', '2', '10808', 'N', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10810', '市辖区', '3', '10809', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10811', '玄武区', '3', '10809', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10820', '白下区', '3', '10809', 'B', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10831', '秦淮区', '3', '10809', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10837', '建邺区', '3', '10809', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10845', '鼓楼区', '3', '10809', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10853', '下关区', '3', '10809', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10860', '浦口区', '3', '10809', 'P', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10876', '栖霞区', '3', '10809', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10894', '雨花台区', '3', '10809', 'Y', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10903', '江宁区', '3', '10809', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10916', '六合区', '3', '10809', 'L', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10937', '溧水县', '3', '10809', 'L', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10947', '高淳县', '3', '10809', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10960', '无锡市', '2', '10808', 'W', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('10961', '市辖区', '3', '10960', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10962', '崇安区', '3', '10960', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10969', '南长区', '3', '10960', 'N', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10976', '北塘区', '3', '10960', 'B', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10981', '锡山区', '3', '10960', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10990', '惠山区', '3', '10960', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('10999', '滨湖区', '3', '10960', 'B', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11018', '江阴市', '3', '10960', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11039', '宜兴市', '3', '10960', 'Y', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11067', '徐州市', '2', '10808', 'X', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11068', '市辖区', '3', '11067', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11069', '鼓楼区', '3', '11067', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11081', '云龙区', '3', '11067', 'Y', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11089', '九里区', '3', '11067', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11103', '贾汪区', '3', '11067', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11115', '泉山区', '3', '11067', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11126', '丰县', '3', '11067', 'F', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11142', '沛县', '3', '11067', 'P', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11160', '铜山县', '3', '11067', 'T', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11182', '睢宁县', '3', '11067', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11200', '新沂市', '3', '11067', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11218', '邳州市', '3', '11067', 'P', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11245', '常州市', '2', '10808', 'C', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11246', '常州市区', '3', '11245', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11247', '天宁区', '3', '11245', 'T', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11254', '钟楼区', '3', '11245', 'Z', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11262', '戚墅堰区', '3', '11245', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11266', '新北区', '3', '11245', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11276', '武进区', '3', '11245', 'W', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11311', '溧阳市', '3', '11245', 'L', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11331', '金坛市', '3', '11245', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11348', '苏州市', '2', '10808', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11349', '市辖区', '3', '11348', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11350', '沧浪区', '3', '11348', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11357', '平江区', '3', '11348', 'P', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11368', '金阊区', '3', '11348', 'J', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11374', '苏州高新区虎丘区', '3', '11348', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11387', '吴中区', '3', '11348', 'W', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11409', '相城区', '3', '11348', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11419', '常熟市', '3', '11348', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11433', '张家港市', '3', '11348', 'Z', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11448', '昆山市', '3', '11348', 'K', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11460', '吴江市', '3', '11348', 'W', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11472', '太仓市', '3', '11348', 'T', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11482', '南通市', '2', '10808', 'N', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11483', '市辖区', '3', '11482', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11484', '崇川区', '3', '11482', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11502', '港闸区', '3', '11482', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11510', '海安县', '3', '11482', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11526', '如东', '3', '11482', 'R', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11542', '启东市', '3', '11482', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11568', '如皋市', '3', '11482', 'R', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11600', '通州市', '3', '11482', 'T', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11627', '海门市', '3', '11482', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11663', '连云港市', '2', '10808', 'L', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11664', '市辖区', '3', '11663', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11665', '连云区', '3', '11663', 'L', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11678', '新浦区', '3', '11663', 'X', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11692', '海州区', '3', '11663', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11699', '赣榆县', '3', '11663', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11722', '东海县', '3', '11663', 'D', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11747', '灌云县', '3', '11663', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11771', '灌南县', '3', '11663', 'G', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11786', '淮安市', '2', '10808', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11787', '市辖区', '3', '11786', 'S', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11788', '清河区', '3', '11786', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11801', '楚州区', '3', '11786', 'C', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11830', '淮阴区', '3', '11786', 'H', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11853', '清浦区', '3', '11786', 'Q', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11863', '涟水县', '3', '11786', 'L', '1', '100', '0', '1569460580');
INSERT INTO `eju_region_all` VALUES ('11896', '洪泽县', '3', '11786', 'H', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11909', '盱眙县', '3', '11786', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11931', '金湖县', '3', '11786', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11947', '盐城市', '2', '10808', 'Y', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('11948', '市辖区', '3', '11947', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11949', '亭湖区', '3', '11947', 'T', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11967', '盐都区', '3', '11947', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11982', '响水县', '3', '11947', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('11998', '滨海县', '3', '11947', 'B', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12017', '阜宁县', '3', '11947', 'F', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12040', '射阳县', '3', '11947', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12066', '建湖县', '3', '11947', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12083', '东台市', '3', '11947', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12117', '大丰市', '3', '11947', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12135', '扬州市', '2', '10808', 'Y', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12136', '市辖区', '3', '12135', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12137', '广陵区', '3', '12135', 'G', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12144', '邗江区', '3', '12135', 'H', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12160', '维扬区', '3', '12135', 'W', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12175', '宝应县', '3', '12135', 'B', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12191', '仪征市', '3', '12135', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12212', '高邮市', '3', '12135', 'G', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12235', '江都市', '3', '12135', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12249', '镇江市', '2', '10808', 'Z', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12250', '市区', '3', '12249', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12251', '京口区', '3', '12249', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12265', '润州区', '3', '12249', 'R', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12273', '丹徒区', '3', '12249', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12282', '丹阳市', '3', '12249', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12300', '扬中市', '3', '12249', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12312', '句容市', '3', '12249', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12343', '泰州市', '2', '10808', 'T', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12344', '市辖区', '3', '12343', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12345', '海陵区', '3', '12343', 'H', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12362', '高港区', '3', '12343', 'G', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12370', '兴化市', '3', '12343', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12407', '靖江市', '3', '12343', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12423', '泰兴市', '3', '12343', 'T', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12450', '姜堰市', '3', '12343', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12475', '宿迁市', '2', '10808', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12476', '市辖区', '3', '12475', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12477', '宿城区', '3', '12475', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12496', '宿豫区', '3', '12475', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12515', '沭阳县', '3', '12475', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12551', '泗阳县', '3', '12475', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12570', '泗洪县', '3', '12475', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12596', '浙江省', '1', '0', 'Z', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('12597', '杭州市', '2', '12596', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12598', '市辖区', '3', '12597', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12599', '上城区', '3', '12597', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12606', '下城区', '3', '12597', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12615', '江干区', '3', '12597', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12626', '拱墅区', '3', '12597', 'G', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12637', '西湖区', '3', '12597', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12652', '滨江区', '3', '12597', 'B', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12656', '萧山区', '3', '12597', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12685', '余杭区', '3', '12597', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12705', '桐庐县', '3', '12597', 'T', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12719', '淳安县', '3', '12597', 'C', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12743', '建德市', '3', '12597', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12760', '富阳市', '3', '12597', 'F', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12786', '临安市', '3', '12597', 'L', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12813', '宁波市', '2', '12596', 'N', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12814', '市辖区', '3', '12813', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12815', '海曙区', '3', '12813', 'H', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12824', '江东区', '3', '12813', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12832', '江北区', '3', '12813', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12841', '北仑区', '3', '12813', 'B', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12851', '镇海区', '3', '12813', 'Z', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12858', '鄞州区', '3', '12813', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12881', '象山县', '3', '12813', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12900', '宁海县', '3', '12813', 'N', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12919', '余姚市', '3', '12813', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12941', '慈溪市', '3', '12813', 'C', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12962', '奉化市', '3', '12813', 'F', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12974', '温州市', '2', '12596', 'W', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('12975', '市辖区', '3', '12974', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12976', '鹿城区', '3', '12974', 'L', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('12998', '龙湾区', '3', '12974', 'L', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13009', '瓯海区', '3', '12974', 'O', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13023', '洞头县', '3', '12974', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13030', '永嘉县', '3', '12974', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13069', '平阳县', '3', '12974', 'P', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13101', '苍南县', '3', '12974', 'C', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13138', '文成县', '3', '12974', 'W', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13172', '泰顺县', '3', '12974', 'T', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13209', '瑞安市', '3', '12974', 'R', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13248', '乐清市', '3', '12974', 'L', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13280', '嘉兴市', '2', '12596', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13281', '市辖区', '3', '13280', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13282', '南湖区', '3', '13280', 'N', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13295', '秀洲区', '3', '13280', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13304', '嘉善县', '3', '13280', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13316', '海盐县', '3', '13280', 'H', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13325', '海宁市', '3', '13280', 'H', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13339', '平湖市', '3', '13280', 'P', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13350', '桐乡市', '3', '13280', 'T', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13364', '湖州市', '2', '12596', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13365', '市辖区', '3', '13364', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13366', '吴兴区', '3', '13364', 'W', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13382', '南浔区', '3', '13364', 'N', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13392', '德清县', '3', '13364', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13404', '长兴县', '3', '13364', 'C', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13421', '安吉县', '3', '13364', 'A', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13437', '绍兴市', '2', '12596', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13438', '市辖区', '3', '13437', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13439', '越城区', '3', '13437', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13453', '绍兴县', '3', '13437', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13473', '新昌县', '3', '13437', 'X', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13490', '诸暨市', '3', '13437', 'Z', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13518', '上虞市', '3', '13437', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13542', '嵊州市', '3', '13437', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13564', '金华市', '2', '12596', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13565', '市辖区', '3', '13564', 'S', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13566', '婺城区', '3', '13564', 'W', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13594', '金东区', '3', '13564', 'J', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13606', '武义县', '3', '13564', 'W', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13625', '浦江县', '3', '13564', 'P', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13641', '磐安县', '3', '13564', 'P', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13662', '兰溪市', '3', '13564', 'L', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13678', '义乌市', '3', '13564', 'Y', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13692', '东阳市', '3', '13564', 'D', '1', '100', '0', '1569460581');
INSERT INTO `eju_region_all` VALUES ('13711', '永康市', '3', '13564', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13726', '衢州市', '2', '12596', 'Q', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13727', '市辖区', '3', '13726', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13728', '柯城区', '3', '13726', 'K', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13746', '衢江区', '3', '13726', 'Q', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13768', '常山县', '3', '13726', 'C', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13783', '开化县', '3', '13726', 'K', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13802', '龙游县', '3', '13726', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13818', '江山市', '3', '13726', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13840', '舟山市', '2', '12596', 'Z', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13841', '市辖区', '3', '13840', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13842', '定海区', '3', '13840', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13859', '普陀区', '3', '13840', 'P', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13874', '岱山县', '3', '13840', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13882', '嵊泗县', '3', '13840', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13890', '台州市', '2', '12596', 'T', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('13891', '市辖区', '3', '13890', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13892', '椒江区', '3', '13890', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13903', '黄岩区', '3', '13890', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13923', '路桥区', '3', '13890', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13934', '玉环县', '3', '13890', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13944', '三门县', '3', '13890', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13959', '天台县', '3', '13890', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13975', '仙居县', '3', '13890', 'X', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('13996', '温岭市', '3', '13890', 'W', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14013', '临海市', '3', '13890', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14033', '丽水市', '2', '12596', 'L', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14034', '市辖区', '3', '14033', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14035', '莲都区', '3', '14033', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14054', '青田县', '3', '14033', 'Q', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14086', '缙云县', '3', '14033', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14111', '遂昌县', '3', '14033', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14132', '松阳县', '3', '14033', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14153', '云和县', '3', '14033', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14168', '庆元县', '3', '14033', 'Q', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14189', '景宁县', '3', '14033', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14214', '龙泉市', '3', '14033', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14234', '安徽省', '1', '0', 'A', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('14235', '合肥市', '2', '14234', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14236', '市辖区', '3', '14235', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14237', '瑶海区', '3', '14235', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14254', '庐阳区', '3', '14235', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14269', '蜀山区', '3', '14235', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14286', '包河区', '3', '14235', 'B', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14297', '长丰县', '3', '14235', 'C', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14314', '肥东县', '3', '14235', 'F', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14334', '肥西县', '3', '14235', 'F', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14351', '芜湖市', '2', '14234', 'W', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14352', '市辖区', '3', '14351', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14353', '镜湖区', '3', '14351', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14366', '弋江区', '3', '14351', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14374', '鸠江区', '3', '14351', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14382', '三山区', '3', '14351', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14387', '芜湖县', '3', '14351', 'W', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14394', '繁昌县', '3', '14351', 'F', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14401', '南陵县', '3', '14351', 'N', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14410', '蚌埠市', '2', '14234', 'B', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14411', '市辖区', '3', '14410', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14412', '龙子湖区', '3', '14410', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14422', '蚌山区', '3', '14410', 'B', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14434', '禹会区', '3', '14410', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14443', '淮上区', '3', '14410', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14449', '怀远县', '3', '14410', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14471', '五河县', '3', '14410', 'W', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14487', '固镇县', '3', '14410', 'G', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14500', '淮南市', '2', '14234', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14501', '市辖区', '3', '14500', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14502', '大通区', '3', '14500', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14508', '田家庵区', '3', '14500', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14523', '谢家集区', '3', '14500', 'X', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14535', '八公山区', '3', '14500', 'B', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14542', '潘集区', '3', '14500', 'P', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14554', '凤台县', '3', '14500', 'F', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14575', '马鞍山市', '2', '14234', 'M', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14576', '市辖区', '3', '14575', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14577', '金家庄区', '3', '14575', 'J', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14583', '花山区', '3', '14575', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14589', '雨山区', '3', '14575', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14597', '当涂县', '3', '14575', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14612', '淮北市', '2', '14234', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14613', '市辖区', '3', '14612', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14614', '杜集区', '3', '14612', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14620', '相山区', '3', '14612', 'X', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14632', '烈山区', '3', '14612', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14641', '濉溪县', '3', '14612', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14653', '铜陵市', '2', '14234', 'T', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14654', '市辖区', '3', '14653', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14655', '铜官山区', '3', '14653', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14663', '狮子山区', '3', '14653', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14671', '铜陵市郊区', '3', '14653', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14678', '铜陵县', '3', '14653', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14687', '安庆市', '2', '14234', 'A', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14688', '市辖区', '3', '14687', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14689', '迎江区', '3', '14687', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14700', '大观区', '3', '14687', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14712', '宜秀区', '3', '14687', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14720', '怀宁县', '3', '14687', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14741', '枞阳县', '3', '14687', 'C', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14764', '潜山县', '3', '14687', 'Q', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14782', '太湖县', '3', '14687', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14798', '宿松县', '3', '14687', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14823', '望江县', '3', '14687', 'W', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14834', '岳西县', '3', '14687', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14859', '桐城市', '3', '14687', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14887', '黄山市', '2', '14234', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('14888', '市辖区', '3', '14887', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14889', '屯溪区', '3', '14887', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14900', '黄山区', '3', '14887', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14917', '徽州区', '3', '14887', 'H', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14926', '歙县', '3', '14887', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14955', '休宁县', '3', '14887', 'X', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14977', '黟县', '3', '14887', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('14986', '祁门县', '3', '14887', 'Q', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15005', '滁州市', '2', '14234', 'C', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15006', '市辖区', '3', '15005', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15007', '琅琊区', '3', '15005', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15016', '南谯区', '3', '15005', 'N', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15034', '来安县', '3', '15005', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15053', '全椒县', '3', '15005', 'Q', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15071', '定远县', '3', '15005', 'D', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15109', '凤阳县', '3', '15005', 'F', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15136', '天长市', '3', '15005', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15166', '明光市', '3', '15005', 'M', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15194', '阜阳市', '2', '14234', 'F', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15195', '市辖区', '3', '15194', 'S', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15196', '颍州区', '3', '15194', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15211', '颍东区', '3', '15194', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15224', '颍泉区', '3', '15194', 'Y', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15231', '临泉县', '3', '15194', 'L', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15264', '太和县', '3', '15194', 'T', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15296', '阜南县', '3', '15194', 'F', '1', '100', '0', '1569460582');
INSERT INTO `eju_region_all` VALUES ('15328', '颍上县', '3', '15194', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15359', '界首市', '3', '15194', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15378', '宿州市', '2', '14234', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15379', '市辖区', '3', '15378', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15380', '墉桥区', '3', '15378', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15417', '砀山县', '3', '15378', 'D', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15437', '萧县', '3', '15378', 'X', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15461', '灵璧县', '3', '15378', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15482', '泗县', '3', '15378', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15499', '巢湖市', '2', '14234', 'C', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15500', '市辖区', '3', '15499', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15501', '居巢区', '3', '15499', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15520', '庐江县', '3', '15499', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15542', '无为县', '3', '15499', 'W', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15566', '含山县', '3', '15499', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15575', '和县', '3', '15499', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15586', '六安市', '2', '14234', 'L', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15587', '市辖区', '3', '15586', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15588', '金安区', '3', '15586', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15612', '裕安区', '3', '15586', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15635', '寿县', '3', '15586', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15662', '霍邱县', '3', '15586', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15698', '舒城县', '3', '15586', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15720', '金寨县', '3', '15586', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15747', '霍山县', '3', '15586', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15764', '亳州市', '2', '14234', 'H', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15765', '市辖区', '3', '15764', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15766', '谯城区', '3', '15764', 'Q', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15795', '涡阳县', '3', '15764', 'W', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15823', '蒙城县', '3', '15764', 'M', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15843', '利辛县', '3', '15764', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15871', '池州市', '2', '14234', 'C', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15872', '市辖区', '3', '15871', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15873', '贵池区', '3', '15871', 'G', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15900', '东至县', '3', '15871', 'D', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15930', '石台县', '3', '15871', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15944', '青阳县', '3', '15871', 'Q', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15958', '宣城市', '2', '14234', 'X', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('15959', '市辖区', '3', '15958', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15960', '宣州区', '3', '15958', 'X', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('15987', '郎溪县', '3', '15958', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16001', '广德县', '3', '15958', 'G', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16013', '泾县', '3', '15958', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16025', '绩溪县', '3', '15958', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16037', '旌德县', '3', '15958', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16048', '宁国市', '3', '15958', 'N', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16068', '福建省', '1', '0', 'F', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('16069', '福州市', '2', '16068', 'F', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16070', '市辖区', '3', '16069', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16071', '鼓楼区', '3', '16069', 'G', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16082', '台江区', '3', '16069', 'T', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16093', '仓山区', '3', '16069', 'C', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16108', '马尾区', '3', '16069', 'M', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16113', '晋安区', '3', '16069', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16123', '闽侯县', '3', '16069', 'M', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16140', '连江县', '3', '16069', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16164', '罗源县', '3', '16069', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16177', '闽清县', '3', '16069', 'M', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16194', '永泰县', '3', '16069', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16216', '平潭县', '3', '16069', 'P', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16232', '福清市', '3', '16069', 'F', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16259', '长乐市', '3', '16069', 'C', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16278', '厦门市', '2', '16068', 'X', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16279', '市辖区', '3', '16278', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16280', '思明区', '3', '16278', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16294', '海沧区', '3', '16278', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16303', '湖里区', '3', '16278', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16315', '集美区', '3', '16278', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16326', '同安区', '3', '16278', 'T', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16341', '翔安区', '3', '16278', 'X', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16348', '莆田市', '2', '16068', 'P', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16349', '市辖区', '3', '16348', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16350', '城厢区', '3', '16348', 'C', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16358', '涵江区', '3', '16348', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16372', '荔城区', '3', '16348', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16379', '秀屿区', '3', '16348', 'X', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16393', '仙游县', '3', '16348', 'X', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16412', '三明市', '2', '16068', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16413', '市辖区', '3', '16412', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16414', '梅列区', '3', '16412', 'M', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16421', '三元区', '3', '16412', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16430', '明溪县', '3', '16412', 'M', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16440', '清流县', '3', '16412', 'Q', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16455', '宁化县', '3', '16412', 'N', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16472', '大田县', '3', '16412', 'D', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16492', '尤溪县', '3', '16412', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16508', '沙县', '3', '16412', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16521', '将乐县', '3', '16412', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16535', '泰宁县', '3', '16412', 'T', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16545', '建宁县', '3', '16412', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16556', '永安市', '3', '16412', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16572', '泉州市', '2', '16068', 'Q', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16573', '市辖区', '3', '16572', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16574', '鲤城区', '3', '16572', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16584', '丰泽区', '3', '16572', 'F', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16593', '洛江区', '3', '16572', 'L', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16600', '泉港区', '3', '16572', 'Q', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16608', '惠安县', '3', '16572', 'H', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16625', '安溪县', '3', '16572', 'A', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16650', '永春县', '3', '16572', 'Y', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16673', '德化县', '3', '16572', 'D', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16692', '金门县', '3', '16572', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16693', '石狮市', '3', '16572', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16703', '晋江市', '3', '16572', 'J', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16726', '南安市', '3', '16572', 'N', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16754', '漳州市', '2', '16068', 'Z', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16755', '市辖区', '3', '16754', 'S', '1', '100', '0', '1569460583');
INSERT INTO `eju_region_all` VALUES ('16756', '芗城区', '3', '16754', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16772', '龙文区', '3', '16754', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16778', '云霄县', '3', '16754', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16790', '漳浦县', '3', '16754', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16821', '诏安县', '3', '16754', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16842', '长泰县', '3', '16754', 'C', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16852', '东山县', '3', '16754', 'D', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16860', '南靖县', '3', '16754', 'N', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16872', '平和县', '3', '16754', 'P', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16889', '华安县', '3', '16754', 'H', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16899', '龙海市', '3', '16754', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16924', '南平市', '2', '16068', 'N', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('16925', '市辖区', '3', '16924', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16926', '延平区', '3', '16924', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16948', '顺昌县', '3', '16924', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16961', '浦城县', '3', '16924', 'P', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16982', '光泽县', '3', '16924', 'G', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('16991', '松溪县', '3', '16924', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17001', '政和县', '3', '16924', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17012', '邵武市', '3', '16924', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17033', '武夷山市', '3', '16924', 'W', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17044', '建瓯市', '3', '16924', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17063', '建阳市', '3', '16924', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17077', '龙岩市', '2', '16068', 'L', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17078', '市辖区', '3', '17077', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17079', '新罗区', '3', '17077', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17099', '长汀县', '3', '17077', 'C', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17118', '永定县', '3', '17077', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17143', '上杭县', '3', '17077', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17166', '武平县', '3', '17077', 'W', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17184', '连城县', '3', '17077', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17202', '漳平市', '3', '17077', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17219', '宁德市　', '2', '16068', 'N', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17220', '市辖区', '3', '17219', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17221', '蕉城区', '3', '17219', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17239', '霞浦县', '3', '17219', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17254', '古田县', '3', '17219', 'G', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17269', '屏南县', '3', '17219', 'P', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17281', '寿宁县', '3', '17219', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17296', '周宁县', '3', '17219', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17306', '柘荣县', '3', '17219', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17316', '福安市', '3', '17219', 'F', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17341', '福鼎市', '3', '17219', 'F', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17359', '江西省', '1', '0', 'J', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('17360', '南昌市', '2', '17359', 'N', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17361', '市辖区', '3', '17360', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17362', '东湖区', '3', '17360', 'D', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17374', '西湖区', '3', '17360', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17387', '青云谱区', '3', '17360', 'Q', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17395', '湾里区', '3', '17360', 'W', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17402', '青山湖区', '3', '17360', 'Q', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17420', '南昌县', '3', '17360', 'N', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17443', '新建县', '3', '17360', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17471', '安义县', '3', '17360', 'A', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17485', '进贤县', '3', '17360', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17508', '景德镇市', '2', '17359', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17509', '市辖区', '3', '17508', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17510', '昌江区', '3', '17508', 'C', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17534', '珠山区', '3', '17508', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17545', '浮梁县', '3', '17508', 'F', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17568', '乐平市', '3', '17508', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17589', '萍乡市', '2', '17359', 'P', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17590', '市辖区', '3', '17589', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17591', '安源区', '3', '17589', 'A', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17604', '湘东区', '3', '17589', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17616', '莲花县', '3', '17589', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17630', '上栗县', '3', '17589', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17640', '芦溪县', '3', '17589', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17651', '九江市', '2', '17359', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17652', '市辖区', '3', '17651', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17653', '庐山区', '3', '17651', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17667', '浔阳区', '3', '17651', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17676', '九江县', '3', '17651', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17693', '武宁县', '3', '17651', 'W', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17714', '修水县', '3', '17651', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17751', '永修县', '3', '17651', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17773', '德安县', '3', '17651', 'D', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17792', '星子县', '3', '17651', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17807', '都昌县', '3', '17651', 'D', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17834', '湖口县', '3', '17651', 'H', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17849', '彭泽县', '3', '17651', 'P', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17872', '瑞昌市', '3', '17651', 'R', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17894', '新余市', '2', '17359', 'X', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17895', '市辖区', '3', '17894', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17896', '渝水区', '3', '17894', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17917', '分宜县', '3', '17894', 'F', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17934', '鹰潭市', '2', '17359', 'Y', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('17935', '市辖区', '3', '17934', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17936', '月湖区', '3', '17934', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17945', '余江县', '3', '17934', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17966', '贵溪市', '3', '17934', 'G', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('17999', '赣州市', '2', '17359', 'G', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('18000', '市辖区', '3', '17999', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18001', '章贡区', '3', '17999', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18016', '赣县', '3', '17999', 'G', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18037', '信丰县', '3', '17999', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18055', '大余县', '3', '17999', 'D', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18068', '上犹县', '3', '17999', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18084', '崇义县', '3', '17999', 'C', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18102', '安远县', '3', '17999', 'A', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18122', '龙南县', '3', '17999', 'L', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18139', '定南县', '3', '17999', 'D', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18148', '全南县', '3', '17999', 'Q', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18161', '宁都县', '3', '17999', 'N', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18187', '于都县', '3', '17999', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18212', '兴国县', '3', '17999', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18239', '会昌县', '3', '17999', 'H', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18260', '寻乌县', '3', '17999', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18276', '石城县', '3', '17999', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18287', '瑞金市', '3', '17999', 'R', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18306', '南康市', '3', '17999', 'N', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18330', '吉安市', '2', '17359', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('18331', '市辖区', '3', '18330', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18332', '吉州区', '3', '18330', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18345', '青原区', '3', '18330', 'Q', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18356', '吉安县', '3', '18330', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18378', '吉水县', '3', '18330', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18398', '峡江县', '3', '18330', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18411', '新干县', '3', '18330', 'X', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18429', '永丰县', '3', '18330', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18454', '泰和县', '3', '18330', 'T', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18483', '遂川县', '3', '18330', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18510', '万安县', '3', '18330', 'W', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18529', '安福县', '3', '18330', 'A', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18550', '永新县', '3', '18330', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18575', '井冈山市', '3', '18330', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18598', '宜春市', '2', '17359', 'Y', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('18599', '市辖区', '3', '18598', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18600', '袁州区', '3', '18598', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18639', '奉新县', '3', '18598', 'F', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18659', '万载县', '3', '18598', 'W', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18678', '上高县', '3', '18598', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18696', '宜丰县', '3', '18598', 'Y', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18714', '靖安县', '3', '18598', 'J', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18727', '铜鼓县', '3', '18598', 'T', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18741', '丰城市', '3', '18598', 'F', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18777', '樟树市', '3', '18598', 'Z', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18799', '高安市', '3', '18598', 'G', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18829', '抚州市', '2', '17359', 'F', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('18830', '市辖区', '3', '18829', 'S', '1', '100', '0', '1569460584');
INSERT INTO `eju_region_all` VALUES ('18831', '临川区', '3', '18829', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18869', '南城县', '3', '18829', 'N', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18882', '黎川县', '3', '18829', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18900', '南丰县', '3', '18829', 'N', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18915', '崇仁县', '3', '18829', 'C', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18931', '乐安县', '3', '18829', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18949', '宜黄县', '3', '18829', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18965', '金溪县', '3', '18829', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18980', '资溪县', '3', '18829', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('18988', '东乡县', '3', '18829', 'D', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19010', '广昌县', '3', '18829', 'G', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19024', '上饶市', '2', '17359', 'S', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('19025', '市辖区', '3', '19024', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19026', '信州区', '3', '19024', 'X', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19038', '上饶县', '3', '19024', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19062', '广丰县', '3', '19024', 'G', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19088', '玉山县', '3', '19024', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19108', '铅山县', '3', '19024', 'Q', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19136', '横峰县', '3', '19024', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19151', '弋阳县', '3', '19024', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19171', '余干县', '3', '19024', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19202', '鄱阳县', '3', '19024', 'P', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19234', '万年县', '3', '19024', 'W', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19248', '婺源县', '3', '19024', 'W', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19265', '德兴市', '3', '19024', 'D', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19280', '山东省', '1', '0', 'S', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('19281', '济南市', '2', '19280', 'J', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('19282', '市辖区', '3', '19281', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19283', '历下区', '3', '19281', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19295', '市中区', '3', '19281', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19311', '槐荫区', '3', '19281', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19326', '天桥区', '3', '19281', 'T', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19342', '历城区', '3', '19281', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19359', '长清区', '3', '19281', 'C', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19370', '平阴县', '3', '19281', 'P', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19378', '济阳县', '3', '19281', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19387', '商河县', '3', '19281', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19400', '章丘市', '3', '19281', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19421', '青岛市', '2', '19280', 'Q', '1', '100', '0', '1569460551');
INSERT INTO `eju_region_all` VALUES ('19422', '市辖区', '3', '19421', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19423', '市南区', '3', '19421', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19438', '市北区', '3', '19421', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19456', '四方区', '3', '19421', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19464', '黄岛区', '3', '19421', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19471', '崂山区', '3', '19421', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19476', '李沧区', '3', '19421', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19488', '城阳区', '3', '19421', 'C', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19497', '胶州市', '3', '19421', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19516', '即墨市', '3', '19421', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19540', '平度市', '3', '19421', 'P', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19572', '胶南市', '3', '19421', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19590', '莱西市', '3', '19421', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19608', '淄博市', '2', '19280', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('19609', '市辖区', '3', '19608', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19610', '淄川区', '3', '19608', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19632', '张店区', '3', '19608', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19649', '博山区', '3', '19608', 'B', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19663', '临淄区', '3', '19608', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19678', '周村区', '3', '19608', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19688', '桓台县', '3', '19608', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19700', '高青县', '3', '19608', 'G', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19710', '沂源县', '3', '19608', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19724', '枣庄市', '2', '19280', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('19725', '市辖区', '3', '19724', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19726', '市中区', '3', '19724', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19738', '薛城区', '3', '19724', 'X', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19748', '峄城区', '3', '19724', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19756', '台儿庄区', '3', '19724', 'T', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19763', '山亭区', '3', '19724', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19774', '滕州市', '3', '19724', 'T', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19796', '东营市', '2', '19280', 'D', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('19797', '市辖区', '3', '19796', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19798', '东营区', '3', '19796', 'D', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19809', '河口区', '3', '19796', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19817', '垦利县', '3', '19796', 'K', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19825', '利津县', '3', '19796', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19835', '广饶县', '3', '19796', 'G', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19846', '烟台市', '2', '19280', 'Y', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('19847', '市辖区', '3', '19846', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19848', '芝罘区', '3', '19846', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19861', '福山区', '3', '19846', 'F', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19873', '牟平区', '3', '19846', 'M', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19887', '莱山区', '3', '19846', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19893', '长岛县', '3', '19846', 'C', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19902', '龙口市', '3', '19846', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19916', '莱阳市', '3', '19846', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19935', '莱州市', '3', '19846', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19952', '蓬莱市', '3', '19846', 'P', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19965', '招远市', '3', '19846', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19980', '栖霞市', '3', '19846', 'Q', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('19996', '海阳市', '3', '19846', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20012', '潍坊市', '2', '19280', 'W', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20013', '市辖区', '3', '20012', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20014', '潍城区', '3', '20012', 'W', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20023', '寒亭区', '3', '20012', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20034', '坊子区', '3', '20012', 'F', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20043', '奎文区', '3', '20012', 'K', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20055', '临朐县', '3', '20012', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20074', '昌乐县', '3', '20012', 'C', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20091', '青州市', '3', '20012', 'Q', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20113', '诸城市', '3', '20012', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20137', '寿光市', '3', '20012', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20155', '安丘市', '3', '20012', 'A', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20179', '高密市', '3', '20012', 'G', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20200', '昌邑市', '3', '20012', 'C', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20216', '济宁市', '2', '19280', 'J', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20217', '市辖区', '3', '20216', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20218', '市中区', '3', '20216', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20227', '任城区', '3', '20216', 'R', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20257', '鱼台县', '3', '20216', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20268', '金乡县', '3', '20216', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20282', '嘉祥县', '3', '20216', 'J', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20298', '汶上县', '3', '20216', 'W', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20313', '泗水县', '3', '20216', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20327', '梁山县', '3', '20216', 'L', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20342', '曲阜市', '3', '20216', 'Q', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20355', '兖州市', '3', '20216', 'Y', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20368', '邹城市', '3', '20216', 'Z', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20386', '泰安市', '2', '19280', 'T', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20387', '市辖区', '3', '20386', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20388', '泰山区', '3', '20386', 'T', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20397', '岱岳区', '3', '20386', 'D', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20416', '宁阳县', '3', '20386', 'N', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20429', '东平县', '3', '20386', 'D', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20444', '新泰市', '3', '20386', 'X', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20465', '肥城市', '3', '20386', 'F', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20480', '威海市', '2', '19280', 'W', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20481', '市辖区', '3', '20480', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20482', '环翠区', '3', '20480', 'H', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20500', '文登市', '3', '20480', 'W', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20519', '荣成市', '3', '20480', 'R', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20542', '乳山市', '3', '20480', 'R', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20558', '日照市', '2', '19280', 'R', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20559', '市辖区', '3', '20558', 'S', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20560', '东港区', '3', '20558', 'D', '1', '100', '0', '1569460585');
INSERT INTO `eju_region_all` VALUES ('20573', '岚山区', '3', '20558', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20583', '五莲县', '3', '20558', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20596', '莒县', '3', '20558', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20618', '莱芜市', '2', '19280', 'L', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20619', '市辖区', '3', '20618', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20620', '莱城区', '3', '20618', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20636', '钢城区', '3', '20618', 'G', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20642', '临沂市', '2', '19280', 'L', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20643', '临沂市辖区', '3', '20642', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20644', '兰山区', '3', '20642', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20656', '罗庄区', '3', '20642', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20665', '河东区', '3', '20642', 'H', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20678', '沂南县', '3', '20642', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20696', '郯城县', '3', '20642', 'T', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20714', '沂水县', '3', '20642', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20734', '苍山县', '3', '20642', 'C', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20756', '费县', '3', '20642', 'F', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20775', '平邑县', '3', '20642', 'P', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20792', '莒南县', '3', '20642', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20811', '蒙阴县', '3', '20642', 'M', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20823', '临沭县', '3', '20642', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20836', '德州市', '2', '19280', 'D', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20837', '市辖区', '3', '20836', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20838', '德城区', '3', '20836', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20850', '陵县', '3', '20836', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20864', '宁津县', '3', '20836', 'N', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20876', '庆云县', '3', '20836', 'Q', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20886', '临邑县', '3', '20836', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20899', '齐河县', '3', '20836', 'Q', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20914', '平原县', '3', '20836', 'P', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20927', '夏津县', '3', '20836', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20942', '武城县', '3', '20836', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20952', '乐陵市', '3', '20836', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20969', '禹城市', '3', '20836', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20981', '聊城市', '2', '19280', 'L', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('20982', '市辖区', '3', '20981', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('20983', '东昌府区', '3', '20981', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21004', '阳谷县', '3', '20981', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21023', '莘县', '3', '20981', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21046', '茌平县', '3', '20981', 'C', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21063', '东阿县', '3', '20981', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21075', '冠县', '3', '20981', 'G', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21093', '高唐县', '3', '20981', 'G', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21106', '临清市', '3', '20981', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21123', '滨州市', '2', '19280', 'B', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('21124', '市辖区', '3', '21123', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21125', '滨城区', '3', '21123', 'B', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21141', '惠民县', '3', '21123', 'H', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21156', '阳信县', '3', '21123', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21166', '无棣县', '3', '21123', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21178', '沾化县', '3', '21123', 'Z', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21190', '博兴县', '3', '21123', 'B', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21201', '邹平县', '3', '21123', 'Z', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21218', '菏泽市', '2', '19280', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('21219', '市辖区', '3', '21218', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21220', '牡丹区', '3', '21218', 'M', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21245', '曹县', '3', '21218', 'C', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21271', '单县', '3', '21218', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21292', '成武县', '3', '21218', 'C', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21305', '巨野县', '3', '21218', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21322', '郓城县', '3', '21218', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21344', '鄄城县', '3', '21218', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21361', '定陶县', '3', '21218', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21373', '东明县', '3', '21218', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21387', '河南省', '1', '0', 'H', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('21388', '郑州市', '2', '21387', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('21389', '市辖区', '3', '21388', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21390', '中原区', '3', '21388', 'Z', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21404', '二七区', '3', '21388', 'E', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21420', '管城回族区', '3', '21388', 'G', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21435', '金水区', '3', '21388', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21453', '上街区', '3', '21388', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21460', '惠济区', '3', '21388', 'H', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21469', '中牟县', '3', '21388', 'Z', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21487', '巩义市', '3', '21388', 'G', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21508', '荥阳市', '3', '21388', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21523', '新密市', '3', '21388', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21542', '新郑市', '3', '21388', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21558', '登封市', '3', '21388', 'D', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21575', '开封市', '2', '21387', 'K', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('21576', '市辖区', '3', '21575', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21577', '龙亭区', '3', '21575', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21584', '顺河区', '3', '21575', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21593', '鼓楼区', '3', '21575', 'G', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21602', '禹王台区', '3', '21575', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21610', '金明区', '3', '21575', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21618', '杞县', '3', '21575', 'Q', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21640', '通许县', '3', '21575', 'T', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21653', '尉氏县', '3', '21575', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21671', '开封县', '3', '21575', 'K', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21687', '兰考县', '3', '21575', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21711', '洛阳市', '2', '21387', 'L', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('21712', '市辖区', '3', '21711', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21713', '老城区', '3', '21711', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21722', '西工区', '3', '21711', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21733', '廛河回族区', '3', '21711', 'C', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21742', '涧西区', '3', '21711', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21758', '吉利区', '3', '21711', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21761', '洛龙区', '3', '21711', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21770', '孟津县', '3', '21711', 'M', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21781', '新安县', '3', '21711', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21794', '栾川县', '3', '21711', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21809', '嵩县', '3', '21711', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21829', '汝阳县', '3', '21711', 'R', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21844', '宜阳县', '3', '21711', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21862', '洛宁县', '3', '21711', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21881', '伊川县', '3', '21711', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21896', '偃师市', '3', '21711', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21913', '平顶山市', '2', '21387', 'P', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('21914', '市辖区', '3', '21913', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21915', '新华区', '3', '21913', 'X', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21928', '卫东区', '3', '21913', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21940', '石龙区', '3', '21913', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21945', '湛河区', '3', '21913', 'Z', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21954', '宝丰县', '3', '21913', 'B', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21968', '叶  县', '3', '21913', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('21987', '鲁山县', '3', '21913', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22009', '郏  县', '3', '21913', 'J', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22024', '舞钢市', '3', '21913', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22037', '汝州市', '3', '21913', 'R', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22058', '安阳市', '2', '21387', 'A', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22059', '市辖区', '3', '22058', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22060', '文峰区', '3', '22058', 'W', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22080', '北关区', '3', '22058', 'B', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22090', '殷都区', '3', '22058', 'Y', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22101', '龙安区', '3', '22058', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22111', '安阳县', '3', '22058', 'A', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22133', '汤阴县', '3', '22058', 'T', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22144', '滑县', '3', '22058', 'H', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22167', '内黄县', '3', '22058', 'N', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22185', '林州市', '3', '22058', 'L', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22206', '鹤壁市', '2', '21387', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22207', '市辖区', '3', '22206', 'S', '1', '100', '0', '1569460586');
INSERT INTO `eju_region_all` VALUES ('22208', '鹤山区', '3', '22206', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22216', '山城区', '3', '22206', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22224', '淇滨区', '3', '22206', 'Q', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22232', '浚县', '3', '22206', 'J', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22243', '淇县', '3', '22206', 'Q', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22251', '新乡市', '2', '21387', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22252', '市辖区', '3', '22251', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22253', '红旗区', '3', '22251', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22264', '卫滨区', '3', '22251', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22273', '凤泉区', '3', '22251', 'F', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22279', '牧野区', '3', '22251', 'M', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22290', '新乡县', '3', '22251', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22299', '获嘉县', '3', '22251', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22312', '原阳县', '3', '22251', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22330', '延津县', '3', '22251', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22347', '封丘县', '3', '22251', 'F', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22367', '长垣县', '3', '22251', 'C', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22386', '卫辉市', '3', '22251', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22400', '辉县市', '3', '22251', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22423', '焦作市', '2', '21387', 'J', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22424', '市辖区', '3', '22423', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22425', '解放区', '3', '22423', 'J', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22435', '中站区', '3', '22423', 'Z', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22446', '马村区', '3', '22423', 'M', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22454', '山阳区', '3', '22423', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22465', '修武县', '3', '22423', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22475', '博爱县', '3', '22423', 'B', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22487', '武陟县', '3', '22423', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22503', '温县', '3', '22423', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22515', '济源市', '3', '22423', 'J', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22532', '沁阳市', '3', '22423', 'Q', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22546', '孟州市', '3', '22423', 'M', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22558', '濮阳市', '2', '21387', 'P', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22559', '市辖区', '3', '22558', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22560', '华龙区', '3', '22558', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22578', '清丰县', '3', '22558', 'Q', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22596', '南乐县', '3', '22558', 'N', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22609', '范县', '3', '22558', 'F', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22622', '台前县', '3', '22558', 'T', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22632', '濮阳县', '3', '22558', 'P', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22655', '许昌市', '2', '21387', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22656', '市辖区', '3', '22655', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22657', '魏都区', '3', '22655', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22671', '许昌县', '3', '22655', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22688', '鄢陵县', '3', '22655', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22701', '襄城县', '3', '22655', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22718', '禹州市', '3', '22655', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22745', '长葛市', '3', '22655', 'C', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22762', '漯河市', '2', '21387', 'L', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22763', '市辖区', '3', '22762', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22764', '源汇区', '3', '22762', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22773', '郾城区', '3', '22762', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22783', '召陵区', '3', '22762', 'Z', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22793', '舞阳县', '3', '22762', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22808', '临颖县', '3', '22762', 'L', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22824', '三门峡市', '2', '21387', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22825', '市辖区', '3', '22824', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22826', '湖滨区', '3', '22824', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22838', '渑池县', '3', '22824', 'M', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22851', '陕县', '3', '22824', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22865', '卢氏县', '3', '22824', 'L', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22885', '义马市', '3', '22824', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22893', '灵宝市', '3', '22824', 'L', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22910', '南阳市', '2', '21387', 'N', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('22911', '市辖区', '3', '22910', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22912', '宛城区', '3', '22910', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22930', '卧龙区', '3', '22910', 'W', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22951', '南召县', '3', '22910', 'N', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22973', '方城县', '3', '22910', 'F', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('22992', '西峡县', '3', '22910', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23013', '镇平县', '3', '22910', 'Z', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23036', '内乡县', '3', '22910', 'N', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23053', '淅川县', '3', '22910', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23071', '社旗县', '3', '22910', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23087', '唐河县', '3', '22910', 'T', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23108', '新野县', '3', '22910', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23123', '桐柏县', '3', '22910', 'T', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23140', '邓州市', '3', '22910', 'D', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23170', '商丘市', '2', '21387', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('23171', '市辖区', '3', '23170', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23172', '梁园区', '3', '23170', 'L', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23192', '睢阳区', '3', '23170', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23211', '民权县', '3', '23170', 'M', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23232', '睢县', '3', '23170', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23253', '宁陵县', '3', '23170', 'N', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23268', '柘城县', '3', '23170', 'Z', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23290', '虞城县', '3', '23170', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23317', '夏邑县', '3', '23170', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23342', '永城市', '3', '23170', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23372', '信阳市', '2', '21387', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('23373', '市辖区', '3', '23372', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23374', '浉河区', '3', '23372', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23393', '平桥区', '3', '23372', 'P', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23414', '罗山县', '3', '23372', 'L', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23435', '光山县', '3', '23372', 'G', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23455', '新县', '3', '23372', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23471', '商城县', '3', '23372', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23492', '固始县', '3', '23372', 'G', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23525', '潢川县', '3', '23372', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23549', '淮滨县', '3', '23372', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23567', '息县', '3', '23372', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23589', '周口市', '2', '21387', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('23590', '市辖区', '3', '23589', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23591', '川汇区', '3', '23589', 'C', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23604', '扶沟县', '3', '23589', 'F', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23621', '西华县', '3', '23589', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23647', '商水县', '3', '23589', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23672', '沈丘县', '3', '23589', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23695', '郸城县', '3', '23589', 'D', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23716', '淮阳县', '3', '23589', 'H', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23736', '太康县', '3', '23589', 'T', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23766', '鹿邑县', '3', '23589', 'L', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23796', '项城市', '3', '23589', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23818', '驻马店市', '2', '21387', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('23819', '市辖区', '3', '23818', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23820', '驿城区', '3', '23818', 'Y', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23840', '西平县', '3', '23818', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23861', '上蔡县', '3', '23818', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23886', '平舆县', '3', '23818', 'P', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23905', '正阳县', '3', '23818', 'Z', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23926', '确山县', '3', '23818', 'Q', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23940', '泌阳县', '3', '23818', 'M', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23965', '汝南县', '3', '23818', 'R', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23983', '遂平县', '3', '23818', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('23999', '新蔡县', '3', '23818', 'X', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('24022', '湖北省', '1', '0', 'H', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('24023', '武汉市', '2', '24022', 'W', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24024', '市辖区', '3', '24023', 'S', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('24025', '江岸区', '3', '24023', 'J', '1', '100', '0', '1569460587');
INSERT INTO `eju_region_all` VALUES ('24043', '江汉区', '3', '24023', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24057', '硚口区', '3', '24023', 'Q', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24069', '汉阳区', '3', '24023', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24082', '武昌区', '3', '24023', 'W', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24098', '青山区', '3', '24023', 'Q', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24111', '洪山区', '3', '24023', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24129', '东西湖区', '3', '24023', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24142', '汉南区', '3', '24023', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24150', '蔡甸区', '3', '24023', 'C', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24165', '江夏区', '3', '24023', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24185', '黄陂区', '3', '24023', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24205', '武汉市新洲区', '3', '24023', 'W', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24224', '黄石市', '2', '24022', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24225', '市辖区', '3', '24224', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24226', '黄石港区', '3', '24224', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24233', '西塞山区', '3', '24224', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24242', '下陆区', '3', '24224', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24247', '铁山区', '3', '24224', 'T', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24250', '阳新县', '3', '24224', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24273', '大冶市', '3', '24224', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24291', '十堰市', '2', '24022', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24292', '市辖区', '3', '24291', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24293', '茅箭区', '3', '24291', 'M', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24302', '张湾区', '3', '24291', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24314', '郧县', '3', '24291', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24335', '郧西县', '3', '24291', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24354', '竹山县', '3', '24291', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24374', '竹溪县', '3', '24291', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24405', '房县', '3', '24291', 'F', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24435', '丹江口市', '3', '24291', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24453', '宜昌市', '2', '24022', 'Y', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24454', '市辖区', '3', '24453', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24455', '西陵区', '3', '24453', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24465', '伍家岗区', '3', '24453', 'W', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24471', '点军区', '3', '24453', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24477', '猇亭区', '3', '24453', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24481', '夷陵区', '3', '24453', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24495', '远安县', '3', '24453', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24503', '兴山县', '3', '24453', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24512', '秭归县', '3', '24453', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24525', '长阳县', '3', '24453', 'C', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24537', '五峰县', '3', '24453', 'W', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24546', '宜都市', '3', '24453', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24559', '当阳市', '3', '24453', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24570', '枝江市', '3', '24453', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24580', '襄樊市', '2', '24022', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24581', '市辖区', '3', '24580', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24582', '襄城区', '3', '24580', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24591', '樊城区', '3', '24580', 'F', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24608', '襄阳区', '3', '24580', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24623', '南漳县', '3', '24580', 'N', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24635', '谷城县', '3', '24580', 'G', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24647', '保康县', '3', '24580', 'B', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24659', '老河口市', '3', '24580', 'L', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24674', '枣阳市', '3', '24580', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24692', '宜城市', '3', '24580', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24706', '鄂州市', '2', '24022', 'E', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24707', '市辖区', '3', '24706', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24708', '粱子湖区', '3', '24706', 'L', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24714', '华容区', '3', '24706', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24722', '鄂城区', '3', '24706', 'E', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24737', '荆门市', '2', '24022', 'J', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24738', '市辖区', '3', '24737', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24739', '东宝区', '3', '24737', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24749', '掇刀区', '3', '24737', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24755', '京山县', '3', '24737', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24778', '沙洋县', '3', '24737', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24794', '钟祥市', '3', '24737', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24816', '孝感市', '2', '24022', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24817', '市辖区', '3', '24816', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24818', '孝南区', '3', '24816', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24838', '孝昌县', '3', '24816', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24853', '大悟县', '3', '24816', 'D', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24871', '云梦县', '3', '24816', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24885', '应城市', '3', '24816', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24903', '安陆市', '3', '24816', 'A', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24920', '汉川市', '3', '24816', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24949', '荆州市', '2', '24022', 'J', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('24950', '市辖区', '3', '24949', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24951', '沙市区', '3', '24949', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24965', '荆州区', '3', '24949', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24978', '公安县', '3', '24949', 'G', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('24995', '监利县', '3', '24949', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25019', '江陵县', '3', '24949', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25032', '石首市', '3', '24949', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25048', '洪湖市', '3', '24949', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25069', '松滋市', '3', '24949', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25086', '黄冈市', '2', '24022', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25087', '市辖区', '3', '25086', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25088', '黄州区', '3', '25086', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25099', '团风县', '3', '25086', 'T', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25112', '红安县', '3', '25086', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25126', '罗田县', '3', '25086', 'L', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25143', '英山县', '3', '25086', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25158', '浠水县', '3', '25086', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25175', '蕲春县', '3', '25086', 'Q', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25192', '黄梅县', '3', '25086', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25211', '麻城市', '3', '25086', 'M', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25235', '武穴市', '3', '25086', 'W', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25249', '咸宁市', '2', '24022', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25250', '市辖区', '3', '25249', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25251', '咸安区', '3', '25249', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25266', '嘉鱼县', '3', '25249', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25276', '通城县', '3', '25249', 'T', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25290', '崇阳县', '3', '25249', 'C', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25303', '通山县', '3', '25249', 'T', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25317', '赤壁市', '3', '25249', 'C', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25335', '随州市', '2', '24022', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25336', '市辖区', '3', '25335', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25337', '曾都区', '3', '25335', 'Z', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25367', '广水市', '3', '25335', 'G', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25388', '恩施州', '2', '24022', 'E', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25389', '恩施市', '3', '25388', 'E', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25406', '利川市', '3', '25388', 'L', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25422', '建始县', '3', '25388', 'J', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25433', '巴东县', '3', '25388', 'B', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25446', '宣恩县', '3', '25388', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25456', '咸丰县', '3', '25388', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25467', '来凤县', '3', '25388', 'L', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25476', '鹤峰县', '3', '25388', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25487', '省直辖行政单位', '2', '24022', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25488', '仙桃市', '3', '25487', 'X', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25516', '潜江市', '3', '25487', 'Q', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25541', '天门市', '3', '25487', 'T', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25570', '神农架林区', '3', '25487', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25579', '湖南省', '1', '0', 'H', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('25580', '长沙市', '2', '25579', 'C', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25581', '市辖区', '3', '25580', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25582', '芙蓉区', '3', '25580', 'F', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25596', '天心区', '3', '25580', 'T', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25607', '岳麓区', '3', '25580', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25620', '开福区', '3', '25580', 'K', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25634', '雨花区', '3', '25580', 'Y', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25645', '长沙县', '3', '25580', 'C', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25666', '望城县', '3', '25580', 'W', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25686', '宁乡县', '3', '25580', 'N', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25720', '浏阳市', '3', '25580', 'L', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25758', '株洲市', '2', '25579', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25759', '市辖区', '3', '25758', 'S', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25760', '荷塘区', '3', '25758', 'H', '1', '100', '0', '1569460588');
INSERT INTO `eju_region_all` VALUES ('25768', '芦淞区', '3', '25758', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25777', '石峰区', '3', '25758', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25785', '天元区', '3', '25758', 'T', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25791', '株洲县', '3', '25758', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25810', '攸县', '3', '25758', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25836', '茶陵县', '3', '25758', 'C', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25863', '炎陵县', '3', '25758', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25881', '醴陵市', '3', '25758', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25912', '湘潭市', '2', '25579', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('25913', '市辖区', '3', '25912', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25914', '雨湖区', '3', '25912', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25929', '岳塘区', '3', '25912', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25947', '湘潭县', '3', '25912', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25970', '湘乡市', '3', '25912', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('25993', '韶山市', '3', '25912', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26001', '衡阳市', '2', '25579', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('26002', '市辖区', '3', '26001', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26003', '珠晖区', '3', '26001', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26019', '雁峰区', '3', '26001', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26028', '石鼓区', '3', '26001', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26037', '蒸湘区', '3', '26001', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26045', '南岳区', '3', '26001', 'N', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26051', '衡阳县', '3', '26001', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26080', '衡南县', '3', '26001', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26112', '衡山县', '3', '26001', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26130', '衡东县', '3', '26001', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26155', '祁东县', '3', '26001', 'Q', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26179', '耒阳市', '3', '26001', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26215', '常宁市', '3', '26001', 'C', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26242', '邵阳市', '2', '25579', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('26243', '市辖区', '3', '26242', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26244', '双清区', '3', '26242', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26257', '大祥区', '3', '26242', 'D', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26272', '北塔区', '3', '26242', 'B', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26279', '邵东县', '3', '26242', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26306', '新邵县', '3', '26242', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26322', '邵阳县', '3', '26242', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26348', '隆回县', '3', '26242', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26375', '洞口县', '3', '26242', 'D', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26399', '绥宁县', '3', '26242', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26425', '新宁县', '3', '26242', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26444', '城步县', '3', '26242', 'C', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26465', '武冈市', '3', '26242', 'W', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26485', '岳阳市', '2', '25579', 'Y', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('26486', '市辖区', '3', '26485', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26487', '岳阳楼区', '3', '26485', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26511', '云溪区', '3', '26485', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26521', '君山区', '3', '26485', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26529', '岳阳县', '3', '26485', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26551', '华容县', '3', '26485', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26572', '湘阴县', '3', '26485', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26592', '平江县', '3', '26485', 'P', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26620', '汩罗市', '3', '26485', 'G', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26657', '临湘市', '3', '26485', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26683', '常德市', '2', '25579', 'C', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('26684', '市辖区', '3', '26683', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26685', '武陵区', '3', '26683', 'W', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26702', '鼎城区', '3', '26683', 'D', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26741', '安乡县', '3', '26683', 'A', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26762', '汉寿县', '3', '26683', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26793', '澧县', '3', '26683', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26826', '临澧县', '3', '26683', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26844', '桃源县', '3', '26683', 'T', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26885', '石门县', '3', '26683', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26912', '津市市', '3', '26683', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26925', '张家界市', '2', '25579', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('26926', '市辖区', '3', '26925', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26927', '永定区', '3', '26925', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26959', '武陵源区', '3', '26925', 'W', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26966', '慈利县', '3', '26925', 'C', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('26998', '桑植县', '3', '26925', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27038', '益阳市', '2', '25579', 'Y', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('27039', '市辖区', '3', '27038', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27040', '资阳区', '3', '27038', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27049', '赫山区', '3', '27038', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27069', '南县', '3', '27038', 'N', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27087', '桃江县', '3', '27038', 'T', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27106', '安化县', '3', '27038', 'A', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27130', '沅江市', '3', '27038', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27147', '郴州市', '2', '25579', 'C', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('27148', '市辖区', '3', '27147', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27149', '北湖区', '3', '27147', 'B', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27168', '苏仙区', '3', '27147', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27188', '桂阳县', '3', '27147', 'G', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27228', '宜章县', '3', '27147', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27256', '永兴县', '3', '27147', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27282', '嘉禾县', '3', '27147', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27300', '临武县', '3', '27147', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27323', '汝城县', '3', '27147', 'R', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27347', '桂东县', '3', '27147', 'G', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27367', '安仁县', '3', '27147', 'A', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27389', '资兴市', '3', '27147', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27418', '永州市', '2', '25579', 'Y', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('27419', '市辖区', '3', '27418', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27420', '零陵区', '3', '27418', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27437', '冷水滩区', '3', '27418', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27459', '祁阳县', '3', '27418', 'Q', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27492', '东安县', '3', '27418', 'D', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27511', '双牌县', '3', '27418', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27527', '道县', '3', '27418', 'D', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27554', '江永县', '3', '27418', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27567', '宁远县', '3', '27418', 'N', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27585', '蓝山县', '3', '27418', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27606', '新田县', '3', '27418', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27626', '江华县', '3', '27418', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27650', '怀化市', '2', '25579', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('27651', '市辖区', '3', '27650', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27652', '鹤城区', '3', '27650', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27667', '中方县', '3', '27650', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27690', '沅陵县', '3', '27650', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27714', '辰溪县', '3', '27650', 'C', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27745', '溆浦县', '3', '27650', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27789', '会同县', '3', '27650', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27815', '麻阳县', '3', '27650', 'M', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27839', '新晃县', '3', '27650', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27863', '芷江县', '3', '27650', 'Z', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27892', '靖州苗族侗族县', '3', '27650', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27906', '通道县', '3', '27650', 'T', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27930', '洪江市', '3', '27650', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27963', '娄底市', '2', '25579', 'L', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('27964', '市辖区', '3', '27963', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27965', '娄星区', '3', '27963', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27980', '双峰县', '3', '27963', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('27997', '新化县', '3', '27963', 'X', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28027', '冷水江市', '3', '27963', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28044', '涟源市', '3', '27963', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28065', '湘西州', '2', '25579', 'X', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28066', '吉首市', '3', '28065', 'J', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28082', '泸溪县', '3', '28065', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28099', '凤凰县', '3', '28065', 'F', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28124', '花垣县', '3', '28065', 'H', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28143', '保靖县', '3', '28065', 'B', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28161', '古丈县', '3', '28065', 'G', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28174', '永顺县', '3', '28065', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28205', '龙山县', '3', '28065', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28240', '广东省', '1', '0', 'G', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('28241', '广州市', '2', '28240', 'G', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28242', '市辖区', '3', '28241', 'S', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28243', '荔湾区', '3', '28241', 'L', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28266', '越秀区', '3', '28241', 'Y', '1', '100', '0', '1569460589');
INSERT INTO `eju_region_all` VALUES ('28289', '海珠区', '3', '28241', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28308', '天河区', '3', '28241', 'T', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28330', '白云区', '3', '28241', 'B', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28349', '黄埔区', '3', '28241', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28359', '番禺区', '3', '28241', 'F', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28377', '花都区', '3', '28241', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28386', '南沙区', '3', '28241', 'N', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28392', '萝岗区', '3', '28241', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28399', '增城市', '3', '28241', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28409', '从化市', '3', '28241', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28421', '韶关市', '2', '28240', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28422', '市辖区', '3', '28421', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28423', '武江区', '3', '28421', 'W', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28431', '浈江区', '3', '28421', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28448', '曲江区', '3', '28421', 'Q', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28463', '始兴县', '3', '28421', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28475', '仁化县', '3', '28421', 'R', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28488', '翁源县', '3', '28421', 'W', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28497', '乳源县', '3', '28421', 'R', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28509', '新丰县', '3', '28421', 'X', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28517', '乐昌市', '3', '28421', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28539', '南雄市', '3', '28421', 'N', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28558', '深圳市', '2', '28240', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28559', '市辖区', '3', '28558', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28560', '罗湖区', '3', '28558', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28571', '福田区', '3', '28558', 'F', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28581', '南山区', '3', '28558', 'N', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28590', '宝安区', '3', '28558', 'B', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28604', '龙岗区', '3', '28558', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28619', '盐田区', '3', '28558', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28626', '珠海市', '2', '28240', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28627', '市辖区', '3', '28626', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28628', '香洲区', '3', '28626', 'X', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28646', '斗门区', '3', '28626', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28654', '金湾区', '3', '28626', 'J', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28659', '汕头市', '2', '28240', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28660', '市辖区', '3', '28659', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28661', '龙湖区', '3', '28659', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28669', '金平区', '3', '28659', 'J', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28687', '濠江区', '3', '28659', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28695', '潮阳区', '3', '28659', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28709', '潮南区', '3', '28659', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28721', '澄海区', '3', '28659', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28733', '南澳县', '3', '28659', 'N', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28737', '佛山市', '2', '28240', 'F', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28738', '市辖区', '3', '28737', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28739', '禅城区', '3', '28737', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28744', '南海区', '3', '28737', 'N', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28753', '顺德区', '3', '28737', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28764', '三水区', '3', '28737', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28776', '高明区', '3', '28737', 'G', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28785', '江门市', '2', '28240', 'J', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28786', '市辖区', '3', '28785', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28787', '蓬江区', '3', '28785', 'P', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28797', '江海区', '3', '28785', 'J', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28803', '新会区', '3', '28785', 'X', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28818', '台山市', '3', '28785', 'T', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28837', '开平市', '3', '28785', 'K', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28853', '鹤山市', '3', '28785', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28867', '恩平市', '3', '28785', 'E', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28880', '湛江市', '2', '28240', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('28881', '市辖区', '3', '28880', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28882', '湛江市赤坎区', '3', '28880', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28891', '湛江市霞山区', '3', '28880', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28904', '湛江市坡头区', '3', '28880', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28914', '湛江市麻章区', '3', '28880', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28923', '遂溪县', '3', '28880', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28941', '徐闻县', '3', '28880', 'X', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28962', '廉江市', '3', '28880', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('28984', '雷州市', '3', '28880', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29010', '吴川市', '3', '28880', 'W', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29026', '茂名市', '2', '28240', 'M', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29027', '市辖区', '3', '29026', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29028', '茂南区', '3', '29026', 'M', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29045', '茂港区', '3', '29026', 'M', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29053', '电白县', '3', '29026', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29075', '高州市', '3', '29026', 'G', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29107', '化州市', '3', '29026', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29138', '信宜市', '3', '29026', 'X', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29159', '肇庆市', '2', '28240', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29160', '市辖区', '3', '29159', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29161', '端州区', '3', '29159', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29169', '鼎湖区', '3', '29159', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29178', '广宁县', '3', '29159', 'G', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29196', '怀集县', '3', '29159', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29217', '封开县', '3', '29159', 'F', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29234', '德庆县', '3', '29159', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29248', '高要市', '3', '29159', 'G', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29266', '四会市', '3', '29159', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29282', '惠州市', '2', '28240', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29283', '市辖区', '3', '29282', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29284', '惠城区', '3', '29282', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29304', '惠阳区', '3', '29282', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29317', '博罗县', '3', '29282', 'B', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29335', '惠东县', '3', '29282', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29355', '龙门县', '3', '29282', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29371', '梅州市', '2', '28240', 'M', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29372', '市辖区', '3', '29371', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29373', '梅江区', '3', '29371', 'M', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29380', '梅县', '3', '29371', 'M', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29400', '大埔县', '3', '29371', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29418', '丰顺县', '3', '29371', 'F', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29436', '五华县', '3', '29371', 'W', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29453', '平远县', '3', '29371', 'P', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29466', '蕉岭县', '3', '29371', 'J', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29477', '兴宁市', '3', '29371', 'X', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29498', '汕尾市', '2', '28240', 'S', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29499', '市辖区', '3', '29498', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29500', '城区', '3', '29498', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29511', '海丰县', '3', '29498', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29529', '陆河县', '3', '29498', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29538', '陆丰市', '3', '29498', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29568', '河源市', '2', '28240', 'H', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29569', '市辖区', '3', '29568', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29570', '源城区', '3', '29568', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29578', '紫金县', '3', '29568', 'Z', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29599', '龙川县', '3', '29568', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29625', '连平县', '3', '29568', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29639', '和平县', '3', '29568', 'H', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29657', '东源县', '3', '29568', 'D', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29679', '阳江市', '2', '28240', 'Y', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29680', '市辖区', '3', '29679', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29681', '江城区', '3', '29679', 'J', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29698', '阳西县', '3', '29679', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29709', '阳东县', '3', '29679', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29729', '阳春市', '3', '29679', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29755', '清远市', '2', '28240', 'Q', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29756', '市辖区', '3', '29755', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29757', '清城区', '3', '29755', 'Q', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29766', '佛冈县', '3', '29755', 'F', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29773', '阳山县', '3', '29755', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29787', '连山县', '3', '29755', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29797', '连南县', '3', '29755', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29805', '清新县', '3', '29755', 'Q', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29816', '英德市', '3', '29755', 'Y', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29842', '连州市', '3', '29755', 'L', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29855', '东莞市', '2', '28240', 'D', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29890', '中山市', '2', '28240', 'Z', '1', '100', '0', '1569460552');
INSERT INTO `eju_region_all` VALUES ('29915', '潮州市', '2', '28240', 'C', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('29916', '市辖区', '3', '29915', 'S', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29917', '潮州市湘桥区', '3', '29915', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29930', '潮州市潮安县', '3', '29915', 'C', '1', '100', '0', '1569460590');
INSERT INTO `eju_region_all` VALUES ('29954', '潮州市饶平县', '3', '29915', 'C', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('29977', '揭阳市', '2', '28240', 'J', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('29978', '市辖区', '3', '29977', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('29979', '榕城区', '3', '29977', 'R', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('29990', '揭东县', '3', '29977', 'J', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30008', '揭西县', '3', '29977', 'J', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30032', '惠来县', '3', '29977', 'H', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30054', '普宁市', '3', '29977', 'P', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30086', '云浮市', '2', '28240', 'Y', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30087', '市辖区', '3', '30086', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30088', '云城区', '3', '30086', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30096', '新兴县', '3', '30086', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30112', '郁南县', '3', '30086', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30132', '云安县', '3', '30086', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30141', '罗定市', '3', '30086', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30164', '广西', '1', '0', 'G', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('30165', '南宁市', '2', '30164', 'N', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30166', '市辖区', '3', '30165', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30167', '兴宁区', '3', '30165', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30174', '青秀区', '3', '30165', 'Q', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30186', '江南区', '3', '30165', 'J', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30196', '西乡塘区', '3', '30165', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30214', '良庆区', '3', '30165', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30222', '邕宁区', '3', '30165', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30228', '武鸣县', '3', '30165', 'W', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30245', '隆安县', '3', '30165', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30257', '马山县', '3', '30165', 'M', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30270', '上林县', '3', '30165', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30282', '宾阳县', '3', '30165', 'B', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30300', '横县', '3', '30165', 'H', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30319', '柳州市', '2', '30164', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30320', '市辖区', '3', '30319', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30321', '城中区', '3', '30319', 'C', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30329', '鱼峰区', '3', '30319', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30338', '柳南区', '3', '30319', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30348', '柳北区', '3', '30319', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30361', '柳江县', '3', '30319', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30374', '柳城县', '3', '30319', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30387', '鹿寨县', '3', '30319', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30398', '融安县', '3', '30319', 'R', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30411', '融水县', '3', '30319', 'R', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30432', '三江县', '3', '30319', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30448', '桂林市', '2', '30164', 'G', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30449', '市辖区', '3', '30448', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30450', '秀峰区', '3', '30448', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30454', '叠彩区', '3', '30448', 'D', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30458', '象山区', '3', '30448', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30463', '七星区', '3', '30448', 'Q', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30469', '雁山区', '3', '30448', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30475', '阳朔县', '3', '30448', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30485', '临桂县', '3', '30448', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30497', '灵川县', '3', '30448', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30509', '全州县', '3', '30448', 'Q', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30528', '兴安县', '3', '30448', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30539', '永福县', '3', '30448', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30549', '灌阳县', '3', '30448', 'G', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30559', '龙胜县', '3', '30448', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30570', '资源县', '3', '30448', 'Z', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30578', '平乐县', '3', '30448', 'P', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30589', '荔浦县', '3', '30448', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30603', '恭城县', '3', '30448', 'G', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30613', '梧州市', '2', '30164', 'W', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30614', '市辖区', '3', '30613', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30615', '万秀区', '3', '30613', 'W', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30622', '蝶山区', '3', '30613', 'D', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30628', '长洲区', '3', '30613', 'C', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30633', '苍梧县', '3', '30613', 'C', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30646', '藤县', '3', '30613', 'T', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30663', '蒙山县', '3', '30613', 'M', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30673', '岑溪市', '3', '30613', 'C', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30688', '北海市', '2', '30164', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30689', '市辖区', '3', '30688', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30690', '海城区', '3', '30688', 'H', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30699', '银海区', '3', '30688', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30704', '铁山港区', '3', '30688', 'T', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30708', '合浦县', '3', '30688', 'H', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30724', '防城港市', '2', '30164', 'F', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30725', '市辖区', '3', '30724', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30726', '港口区', '3', '30724', 'G', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30732', '防城区', '3', '30724', 'F', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30748', '上思县', '3', '30724', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30758', '东兴市', '3', '30724', 'D', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30762', '钦州市', '2', '30164', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30763', '市辖区', '3', '30762', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30764', '钦南区', '3', '30762', 'Q', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30783', '钦北区', '3', '30762', 'Q', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30796', '灵山县', '3', '30762', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30817', '浦北县', '3', '30762', 'P', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30834', '贵港市', '2', '30164', 'G', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30835', '市辖区', '3', '30834', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30836', '港北区', '3', '30834', 'G', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30845', '港南区', '3', '30834', 'G', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30855', '覃塘区', '3', '30834', 'Q', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30866', '平南县', '3', '30834', 'P', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30888', '桂平市', '3', '30834', 'G', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30915', '玉林市', '2', '30164', 'Y', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('30916', '市辖区', '3', '30915', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30917', '玉州区', '3', '30915', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30933', '容县', '3', '30915', 'R', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30949', '陆川县', '3', '30915', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30964', '博白县', '3', '30915', 'B', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('30993', '兴业县', '3', '30915', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31007', '北流市', '3', '30915', 'B', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31033', '百色市', '2', '30164', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31034', '市辖区', '3', '31033', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31035', '右江区', '3', '31033', 'Y', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31045', '田阳县', '3', '31033', 'T', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31056', '田东县', '3', '31033', 'T', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31067', '平果县', '3', '31033', 'P', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31081', '德保县', '3', '31033', 'D', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31095', '靖西县', '3', '31033', 'J', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31115', '那坡县', '3', '31033', 'N', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31125', '凌云县', '3', '31033', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31134', '乐业县', '3', '31033', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31143', '田林县', '3', '31033', 'T', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31158', '西林县', '3', '31033', 'X', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31167', '隆林县', '3', '31033', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31184', '贺州市', '2', '30164', 'H', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31185', '市辖区', '3', '31184', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31186', '八步区', '3', '31184', 'B', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31208', '昭平县', '3', '31184', 'Z', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31221', '钟山县', '3', '31184', 'Z', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31236', '富川县', '3', '31184', 'F', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31249', '河池市', '2', '30164', 'H', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31250', '市辖区', '3', '31249', 'S', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31251', '金城江区', '3', '31249', 'J', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31264', '南丹县', '3', '31249', 'N', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31276', '天峨县', '3', '31249', 'T', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31286', '凤山县', '3', '31249', 'F', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31296', '东兰县', '3', '31249', 'D', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31311', '罗城县', '3', '31249', 'L', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31323', '环江县', '3', '31249', 'H', '1', '100', '0', '1569460591');
INSERT INTO `eju_region_all` VALUES ('31336', '巴马县', '3', '31249', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31347', '都安县', '3', '31249', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31367', '大化县', '3', '31249', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31384', '宜州市', '3', '31249', 'Y', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31401', '来宾市', '2', '30164', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31402', '市辖区', '3', '31401', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31403', '兴宾区', '3', '31401', 'X', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31427', '忻城县', '3', '31401', 'X', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31440', '象州县', '3', '31401', 'X', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31452', '武宣县', '3', '31401', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31463', '金秀县', '3', '31401', 'J', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31474', '合山市', '3', '31401', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31478', '崇左市', '2', '30164', 'C', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31479', '市辖区', '3', '31478', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31480', '江州区', '3', '31478', 'J', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31490', '扶绥县', '3', '31478', 'F', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31502', '宁明县', '3', '31478', 'N', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31516', '龙州县', '3', '31478', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31529', '大新县', '3', '31478', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31544', '天等县', '3', '31478', 'T', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31558', '凭祥市', '3', '31478', 'P', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31563', '海南省', '1', '0', 'H', '1', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('31564', '海口', '2', '31563', 'H', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31565', '市辖区', '3', '31564', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31566', '秀英区', '3', '31564', 'X', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31575', '龙华区', '3', '31564', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31587', '琼山区', '3', '31564', 'Q', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31601', '美兰区', '3', '31564', 'M', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31618', '三亚', '2', '31563', 'S', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31619', '市辖区', '3', '31618', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31634', '五指山', '2', '31563', 'W', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31635', '冲山镇', '3', '31634', 'C', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31636', '南圣镇', '3', '31634', 'N', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31637', '毛阳镇', '3', '31634', 'M', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31638', '番阳镇', '3', '31634', 'F', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31639', '畅好乡', '3', '31634', 'C', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31640', '毛道乡', '3', '31634', 'M', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31641', '水满乡', '3', '31634', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31642', '国营畅好农场', '3', '31634', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31643', '琼海', '2', '31563', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31644', '嘉积镇', '3', '31643', 'J', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31645', '万泉镇', '3', '31643', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31646', '石壁镇', '3', '31643', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31647', '中原镇', '3', '31643', 'Z', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31648', '博敖镇', '3', '31643', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31649', '阳江镇', '3', '31643', 'Y', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31650', '龙江镇', '3', '31643', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31651', '潭门镇', '3', '31643', 'T', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31652', '塔洋镇', '3', '31643', 'T', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31653', '长坡镇', '3', '31643', 'C', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31654', '大路镇', '3', '31643', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31655', '会山镇', '3', '31643', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31656', '国营东太农场', '3', '31643', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31657', '国营东平农场', '3', '31643', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31658', '国营东红农场', '3', '31643', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31659', '国营东升农场', '3', '31643', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31660', '国营南俸农场', '3', '31643', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31661', '彬村山华侨农场', '3', '31643', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31662', '儋州', '2', '31563', 'D', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31663', '那大镇', '3', '31662', 'N', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31664', '和庆镇', '3', '31662', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31665', '南丰镇', '3', '31662', 'N', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31666', '大成镇', '3', '31662', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31667', '雅星镇', '3', '31662', 'Y', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31668', '兰洋镇', '3', '31662', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31669', '光村镇', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31670', '木棠镇', '3', '31662', 'M', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31671', '海头镇', '3', '31662', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31672', '峨蔓镇', '3', '31662', 'E', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31673', '三都镇', '3', '31662', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31674', '王五镇', '3', '31662', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31675', '白马井镇', '3', '31662', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31676', '中和镇', '3', '31662', 'Z', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31677', '排浦镇', '3', '31662', 'P', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31678', '东成镇', '3', '31662', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31679', '新州镇', '3', '31662', 'X', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31680', '国营西培农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31681', '国营西华农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31682', '国营西庆农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31683', '国营西流农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31684', '国营西联农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31685', '国营蓝洋农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31686', '国营新盈农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31687', '国营八一农场东山分场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31688', '国营八一农场金川分场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31689', '国营八一农场长岭分场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31690', '国营八一农场英岛分场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31691', '国营八一农场春江分场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31692', '国营八一农场强打管区', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31693', '国营龙山农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31694', '国营红岭农场', '3', '31662', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31695', '洋浦经济开发区', '3', '31662', 'Y', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31696', '华南热作学院', '3', '31662', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31697', '文昌', '2', '31563', 'W', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31698', '文城镇', '3', '31697', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31699', '重兴镇', '3', '31697', 'Z', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31700', '蓬莱镇', '3', '31697', 'P', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31701', '会文镇', '3', '31697', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31702', '东路镇', '3', '31697', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31703', '潭牛镇', '3', '31697', 'T', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31704', '东阁镇', '3', '31697', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31705', '文教镇', '3', '31697', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31706', '东郊镇', '3', '31697', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31707', '龙楼镇', '3', '31697', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31708', '昌洒镇', '3', '31697', 'C', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31709', '翁田镇', '3', '31697', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31710', '抱罗镇', '3', '31697', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31711', '冯坡镇', '3', '31697', 'F', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31712', '锦山镇', '3', '31697', 'J', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31713', '铺前镇', '3', '31697', 'P', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31714', '国营东路农场', '3', '31697', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31715', '国营南阳农场', '3', '31697', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31716', '国营罗豆农场', '3', '31697', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31717', '国营文昌橡胶研究所', '3', '31697', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31718', '万宁', '2', '31563', 'W', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31719', '万城镇', '3', '31718', 'W', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31720', '龙滚镇', '3', '31718', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31721', '和乐镇', '3', '31718', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31722', '后安镇', '3', '31718', 'H', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31723', '大茂镇', '3', '31718', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31724', '东澳镇', '3', '31718', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31725', '礼纪镇', '3', '31718', 'L', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31726', '长丰镇', '3', '31718', 'C', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31727', '山根镇', '3', '31718', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31728', '北大镇', '3', '31718', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31729', '南桥镇', '3', '31718', 'N', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31730', '三更罗镇', '3', '31718', 'S', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31731', '国营东兴农场', '3', '31718', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31732', '国营东和农场', '3', '31718', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31733', '国营东岭农场', '3', '31718', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31734', '国营南林农场', '3', '31718', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31735', '国营新中农场', '3', '31718', 'G', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31736', '兴隆华侨农场', '3', '31718', 'X', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31737', '地方国营六连林场', '3', '31718', 'D', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31738', '东方', '2', '31563', 'D', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31739', '八所镇', '3', '31738', 'B', '1', '100', '0', '1569460592');
INSERT INTO `eju_region_all` VALUES ('31740', '东河镇', '3', '31738', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31741', '大田镇', '3', '31738', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31742', '感城镇', '3', '31738', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31743', '板桥镇', '3', '31738', 'B', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31744', '三家镇', '3', '31738', 'S', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31745', '四更镇', '3', '31738', 'S', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31746', '新龙镇', '3', '31738', 'X', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31747', '天安乡', '3', '31738', 'T', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31748', '江边乡', '3', '31738', 'J', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31749', '国营广坝农场', '3', '31738', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31750', '国营公爱农场', '3', '31738', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31751', '国营红泉农场', '3', '31738', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31752', '省国营东方华侨农场', '3', '31738', 'S', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31753', '定安', '2', '31563', 'D', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31754', '定城镇', '3', '31753', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31755', '新竹镇', '3', '31753', 'X', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31756', '龙湖镇', '3', '31753', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31757', '黄竹镇', '3', '31753', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31758', '雷鸣镇', '3', '31753', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31759', '龙门镇', '3', '31753', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31760', '龙河镇', '3', '31753', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31761', '岭口镇', '3', '31753', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31762', '翰林镇', '3', '31753', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31763', '富文镇', '3', '31753', 'F', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31764', '国营中瑞农场', '3', '31753', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31765', '国营南海农场', '3', '31753', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31766', '国营金鸡岭农场', '3', '31753', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31767', '定安热作研究所', '3', '31753', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31768', '屯昌', '2', '31563', 'T', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31769', '屯城镇', '3', '31768', 'T', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31770', '新兴镇', '3', '31768', 'X', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31771', '枫木镇', '3', '31768', 'F', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31772', '乌坡镇', '3', '31768', 'W', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31773', '南吕镇', '3', '31768', 'N', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31774', '南坤镇', '3', '31768', 'N', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31775', '坡心镇', '3', '31768', 'P', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31776', '西昌镇', '3', '31768', 'X', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31777', '国营中建农场', '3', '31768', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31778', '国营中坤农场', '3', '31768', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31779', '国营黄岭农场', '3', '31768', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31780', '国营南吕农场', '3', '31768', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31781', '国营广青农场', '3', '31768', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31782', '国营晨星农场', '3', '31768', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31783', '澄迈', '2', '31563', 'C', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31784', '金江镇', '3', '31783', 'J', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31785', '老城镇', '3', '31783', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31786', '瑞溪镇', '3', '31783', 'R', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31787', '永发镇', '3', '31783', 'Y', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31788', '加乐镇', '3', '31783', 'J', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31789', '文儒镇', '3', '31783', 'W', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31790', '中兴镇', '3', '31783', 'Z', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31791', '仁兴镇', '3', '31783', 'R', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31792', '福山镇', '3', '31783', 'F', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31793', '桥头镇', '3', '31783', 'Q', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31794', '国营红光农场', '3', '31783', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31795', '国营红岗农场', '3', '31783', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31796', '国营西达农场', '3', '31783', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31797', '国营昆仑农场', '3', '31783', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31798', '国营和岭农场', '3', '31783', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31799', '国营金安农场', '3', '31783', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31800', '澄迈县华侨农场', '3', '31783', 'C', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31801', '临高', '2', '31563', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31802', '临城镇', '3', '31801', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31803', '波莲镇', '3', '31801', 'B', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31804', '东英镇', '3', '31801', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31805', '博厚镇', '3', '31801', 'B', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31806', '皇桐镇', '3', '31801', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31807', '多文镇', '3', '31801', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31808', '和舍镇', '3', '31801', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31809', '南宝镇', '3', '31801', 'N', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31810', '新盈镇', '3', '31801', 'X', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31811', '调楼镇', '3', '31801', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31812', '国营红华农场', '3', '31801', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31813', '国营加来农场', '3', '31801', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31814', '白沙', '2', '31563', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31815', '牙叉镇', '3', '31814', 'Y', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31816', '七坊镇', '3', '31814', 'Q', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31817', '邦溪镇', '3', '31814', 'B', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31818', '打安镇', '3', '31814', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31819', '细水乡', '3', '31814', 'X', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31820', '元门乡', '3', '31814', 'Y', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31821', '南开乡', '3', '31814', 'N', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31822', '阜龙乡', '3', '31814', 'F', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31823', '青松乡', '3', '31814', 'Q', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31824', '金波乡', '3', '31814', 'J', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31825', '荣邦乡', '3', '31814', 'R', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31826', '国营金波农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31827', '国营白沙农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31828', '国营牙叉农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31829', '国营卫星农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31830', '国营龙江农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31831', '国营珠碧江农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31832', '国营芙蓉田农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31833', '国营大岭农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31834', '国营邦溪农场', '3', '31814', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31835', '昌江', '2', '31563', 'C', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31836', '石碌镇', '3', '31835', 'S', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31837', '叉河镇', '3', '31835', 'C', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31838', '十月田镇', '3', '31835', 'S', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31839', '乌烈镇', '3', '31835', 'W', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31840', '昌化镇', '3', '31835', 'C', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31841', '海尾镇', '3', '31835', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31842', '七叉镇', '3', '31835', 'Q', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31843', '王下乡', '3', '31835', 'W', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31844', '国营红田农场', '3', '31835', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31845', '国营红林农场', '3', '31835', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31846', '国营坝王岭林场', '3', '31835', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31847', '海南钢铁公司', '3', '31835', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31848', '乐东', '2', '31563', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31849', '抱由镇', '3', '31848', 'B', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31850', '万冲镇', '3', '31848', 'W', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31851', '大安镇', '3', '31848', 'D', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31852', '志仲镇', '3', '31848', 'Z', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31853', '千家镇', '3', '31848', 'Q', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31854', '九所镇', '3', '31848', 'J', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31855', '利国镇', '3', '31848', 'L', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31856', '黄流镇', '3', '31848', 'H', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31857', '佛罗镇', '3', '31848', 'F', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31858', '尖峰镇', '3', '31848', 'J', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31859', '莺歌海镇', '3', '31848', 'Y', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31860', '国营乐中农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31861', '国营山荣农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31862', '国营乐光农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31863', '国营报伦农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31864', '国营福报农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31865', '国营保国农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31866', '国营保显农场', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31867', '国营尖峰岭林业公司', '3', '31848', 'G', '1', '100', '0', '1569460593');
INSERT INTO `eju_region_all` VALUES ('31868', '国营莺歌海盐场', '3', '31848', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31869', '陵水', '2', '31563', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31870', '椰林镇', '3', '31869', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31871', '光坡镇', '3', '31869', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31872', '三才镇', '3', '31869', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31873', '英州镇', '3', '31869', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31874', '隆广镇', '3', '31869', 'L', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31875', '文罗镇', '3', '31869', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31876', '本号镇', '3', '31869', 'B', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31877', '新村镇', '3', '31869', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31878', '黎安镇', '3', '31869', 'L', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31879', '提蒙乡', '3', '31869', 'T', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31880', '群英乡', '3', '31869', 'Q', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31881', '国营岭门农场', '3', '31869', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31882', '国营南平农场', '3', '31869', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31883', '国营吊罗山林业公司', '3', '31869', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31884', '保亭', '2', '31563', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31885', '保城镇', '3', '31884', 'B', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31886', '什玲镇', '3', '31884', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31887', '加茂镇', '3', '31884', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31888', '响水镇', '3', '31884', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31889', '新政镇', '3', '31884', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31890', '三道镇', '3', '31884', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31891', '六弓乡', '3', '31884', 'L', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31892', '南林乡', '3', '31884', 'N', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31893', '毛感乡', '3', '31884', 'M', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31894', '国营五指山茶场', '3', '31884', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31895', '国营新星农场', '3', '31884', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31896', '国营保亭热作所', '3', '31884', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31897', '国营金江农场', '3', '31884', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31898', '国营南茂农场', '3', '31884', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31899', '国营三道农场', '3', '31884', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31900', '琼中', '2', '31563', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31901', '营根镇', '3', '31900', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31902', '湾岭镇', '3', '31900', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31903', '黎母山镇', '3', '31900', 'L', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31904', '和平镇', '3', '31900', 'H', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31905', '长征镇', '3', '31900', 'C', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31906', '红毛镇', '3', '31900', 'H', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31907', '中平镇', '3', '31900', 'Z', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31908', '吊罗山乡', '3', '31900', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31909', '上安乡', '3', '31900', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31910', '什运乡', '3', '31900', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31911', '国营新进农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31912', '国营大丰农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31913', '国营阳江农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31914', '国营乌石农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31915', '国营南方农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31916', '国营岭头农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31917', '国营加钗农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31918', '国营长征农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31919', '国营乘坡农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31920', '国营太平农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31921', '国营新伟农场', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31922', '国营黎母山林业公司', '3', '31900', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31923', '西沙群岛', '3', '31924', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31924', '三沙', '2', '31563', 'S', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31925', '南沙群岛', '3', '31924', 'N', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31927', '中沙群岛的岛礁及其海域', '3', '31924', 'Z', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31929', '重庆市', '1', '0', 'Z', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('31930', '市辖区', '2', '31929', 'S', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('31931', '万州区', '3', '31930', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('31984', '涪陵区', '3', '31930', 'F', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32031', '渝中区', '3', '31930', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32044', '大渡口区', '3', '31930', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32053', '江北区', '3', '31930', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32066', '沙坪坝区', '3', '31930', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32093', '九龙坡区', '3', '31930', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32112', '南岸区', '3', '31930', 'N', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32127', '北碚区', '3', '31930', 'B', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32145', '万盛区', '3', '31930', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32156', '双桥区', '3', '31930', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32160', '渝北区', '3', '31930', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32191', '巴南区', '3', '31930', 'B', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32213', '黔江区', '3', '31930', 'Q', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32244', '长寿区', '3', '31930', 'C', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32263', '江津区', '3', '31930', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32291', '合川区', '3', '31930', 'H', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32322', '永川区', '3', '31930', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32345', '南川区', '3', '31930', 'N', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32380', '县', '2', '31929', 'X', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('32381', '綦江县', '3', '32380', 'Q', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32401', '潼南县', '3', '32380', 'T', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32424', '铜梁县', '3', '32380', 'T', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32453', '大足县', '3', '32380', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32478', '荣昌县', '3', '32380', 'R', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32499', '璧山县', '3', '32380', 'B', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32513', '梁平县', '3', '32380', 'L', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32549', '城口县', '3', '32380', 'C', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32574', '丰都县', '3', '32380', 'F', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32606', '垫江县', '3', '32380', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32632', '武隆县', '3', '32380', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32659', '忠县', '3', '32380', 'Z', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32688', '开县', '3', '32380', 'K', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32727', '云阳县', '3', '32380', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32771', '奉节县', '3', '32380', 'F', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32802', '巫山县', '3', '32380', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32829', '巫溪县', '3', '32380', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32861', '石柱县', '3', '32380', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32894', '秀山县', '3', '32380', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32927', '酉阳县', '3', '32380', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('32967', '彭水县', '3', '32380', 'P', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33007', '四川省', '1', '0', 'S', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('33008', '成都市', '2', '33007', 'C', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('33009', '市辖区', '3', '33008', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33010', '锦江区', '3', '33008', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33027', '青羊区', '3', '33008', 'Q', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33042', '金牛区', '3', '33008', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33058', '武侯区', '3', '33008', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33076', '成华区', '3', '33008', 'C', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33091', '龙泉驿区', '3', '33008', 'L', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33104', '青白江区', '3', '33008', 'Q', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33116', '新都区', '3', '33008', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33130', '温江区', '3', '33008', 'W', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33141', '金堂县', '3', '33008', 'J', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33163', '双流县', '3', '33008', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33189', '郫县', '3', '33008', 'P', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33205', '大邑县', '3', '33008', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33226', '蒲江县', '3', '33008', 'P', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33239', '新津县', '3', '33008', 'X', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33252', '都江堰市', '3', '33008', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33272', '彭州市', '3', '33008', 'P', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33293', '邛崃市', '3', '33008', 'Q', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33318', '崇州市', '3', '33008', 'C', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33344', '自贡市', '2', '33007', 'Z', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('33345', '市辖区', '3', '33344', 'S', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33346', '自流井区', '3', '33344', 'Z', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33360', '贡井区', '3', '33344', 'G', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33374', '大安区', '3', '33344', 'D', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33391', '沿滩区', '3', '33344', 'Y', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33405', '荣县', '3', '33344', 'R', '1', '100', '0', '1569460594');
INSERT INTO `eju_region_all` VALUES ('33433', '富顺县', '3', '33344', 'F', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33460', '攀枝花市', '2', '33007', 'P', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('33461', '市辖区', '3', '33460', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33462', '攀枝花东区', '3', '33460', 'P', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33473', '西区', '3', '33460', 'X', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33481', '仁和区', '3', '33460', 'R', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33497', '米易县', '3', '33460', 'M', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33511', '盐边县', '3', '33460', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33528', '泸州市', '2', '33007', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('33529', '市辖区', '3', '33528', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33530', '江阳区', '3', '33528', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33548', '纳溪区', '3', '33528', 'N', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33563', '龙马潭区', '3', '33528', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33577', '泸县', '3', '33528', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33597', '合江县', '3', '33528', 'H', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33625', '叙永县', '3', '33528', 'X', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33654', '古蔺县', '3', '33528', 'G', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33681', '德阳市', '2', '33007', 'D', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('33682', '市辖区', '3', '33681', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33683', '旌阳区', '3', '33681', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33701', '中江县', '3', '33681', 'Z', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33747', '罗江县', '3', '33681', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33758', '广汉市', '3', '33681', 'G', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33778', '什邡市', '3', '33681', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33795', '绵竹市', '3', '33681', 'M', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33817', '绵阳市', '2', '33007', 'M', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('33818', '市辖区', '3', '33817', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33819', '涪城区', '3', '33817', 'F', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33844', '游仙区', '3', '33817', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33873', '三台县', '3', '33817', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33937', '盐亭县', '3', '33817', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33974', '安县', '3', '33817', 'A', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('33995', '梓潼县', '3', '33817', 'Z', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34028', '北川县', '3', '33817', 'B', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34049', '平武县', '3', '33817', 'P', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34075', '江油市', '3', '33817', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34120', '广元市', '2', '33007', 'G', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('34121', '市辖区', '3', '34120', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34122', '市中区', '3', '34120', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34143', '元坝区', '3', '34120', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34173', '朝天区', '3', '34120', 'C', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34199', '旺苍县', '3', '34120', 'W', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34238', '青川县', '3', '34120', 'Q', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34276', '剑阁县', '3', '34120', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34334', '苍溪县', '3', '34120', 'C', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34376', '遂宁市', '2', '33007', 'S', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('34377', '市辖区', '3', '34376', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34378', '船山区', '3', '34376', 'C', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34404', '安居区', '3', '34376', 'A', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34426', '蓬溪县', '3', '34376', 'P', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34458', '射洪县', '3', '34376', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34489', '大英县', '3', '34376', 'D', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34501', '内江市', '2', '33007', 'N', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('34502', '市辖区', '3', '34501', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34503', '市中区', '3', '34501', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34524', '东兴区', '3', '34501', 'D', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34554', '威远县', '3', '34501', 'W', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34575', '资中县', '3', '34501', 'Z', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34609', '隆昌县', '3', '34501', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34628', '乐山市', '2', '33007', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('34629', '市辖区', '3', '34628', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34630', '市中区', '3', '34628', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34661', '沙湾区', '3', '34628', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34676', '五通桥区', '3', '34628', 'W', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34689', '金口河区', '3', '34628', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34696', '犍为县', '3', '34628', 'Q', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34727', '井研县', '3', '34628', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34755', '夹江县', '3', '34628', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34778', '沐川县', '3', '34628', 'M', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34799', '峨边县', '3', '34628', 'E', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34819', '马边县', '3', '34628', 'M', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34840', '峨眉山市', '3', '34628', 'E', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34859', '南充市', '2', '33007', 'N', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('34860', '市辖区', '3', '34859', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34861', '顺庆区', '3', '34859', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34890', '高坪区', '3', '34859', 'G', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34923', '嘉陵区', '3', '34859', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('34967', '南部县', '3', '34859', 'N', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35040', '营山县', '3', '34859', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35094', '蓬安县', '3', '34859', 'P', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35134', '仪陇县', '3', '34859', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35193', '西充县', '3', '34859', 'X', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35238', '阆中市', '3', '34859', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35288', '眉山市', '2', '33007', 'M', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('35289', '市辖区', '3', '35288', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35290', '东坡区', '3', '35288', 'D', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35317', '仁寿县', '3', '35288', 'R', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35378', '彭山县', '3', '35288', 'P', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35392', '洪雅县', '3', '35288', 'H', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35408', '丹棱县', '3', '35288', 'D', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35416', '青神县', '3', '35288', 'Q', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35427', '宜宾市', '2', '33007', 'Y', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('35428', '市辖区', '3', '35427', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35429', '翠屏区', '3', '35427', 'C', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35454', '宜宾县', '3', '35427', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35481', '南溪县', '3', '35427', 'N', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35497', '江安县', '3', '35427', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35516', '长宁县', '3', '35427', 'C', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35535', '高县', '3', '35427', 'G', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35555', '珙县', '3', '35427', 'G', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35573', '筠连县', '3', '35427', 'J', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35592', '兴文县', '3', '35427', 'X', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35608', '屏山县', '3', '35427', 'P', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35625', '广安市', '2', '33007', 'G', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('35626', '市辖区', '3', '35625', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35627', '广安区', '3', '35625', 'G', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35677', '岳池县', '3', '35625', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35721', '武胜县', '3', '35625', 'W', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35753', '邻水县', '3', '35625', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35799', '华蓥市', '3', '35625', 'H', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35813', '达州市', '2', '33007', 'D', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('35814', '市辖区', '3', '35813', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35815', '通川区', '3', '35813', 'T', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35829', '达县', '3', '35813', 'D', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35894', '宣汉县', '3', '35813', 'X', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35949', '开江县', '3', '35813', 'K', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('35970', '大竹县', '3', '35813', 'D', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36021', '渠县', '3', '35813', 'Q', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36082', '万源市', '3', '35813', 'W', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36136', '雅安市', '2', '33007', 'Y', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('36137', '市辖区', '3', '36136', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36138', '雨城区', '3', '36136', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36161', '名山县', '3', '36136', 'M', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36182', '荥经县', '3', '36136', 'Y', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36204', '汉源县', '3', '36136', 'H', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36245', '石棉县', '3', '36136', 'S', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36263', '天全县', '3', '36136', 'T', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36279', '芦山县', '3', '36136', 'L', '1', '100', '0', '1569460595');
INSERT INTO `eju_region_all` VALUES ('36289', '宝兴县', '3', '36136', 'B', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36299', '巴中市', '2', '33007', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('36300', '市辖区', '3', '36299', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36301', '巴州区', '3', '36299', 'B', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36354', '通江县', '3', '36299', 'T', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36404', '南江县', '3', '36299', 'N', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36453', '平昌县', '3', '36299', 'P', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36497', '资阳市', '2', '33007', 'Z', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('36498', '市辖区', '3', '36497', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36499', '雁江区', '3', '36497', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36527', '安岳县', '3', '36497', 'A', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36597', '乐至县', '3', '36497', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36623', '简阳市', '3', '36497', 'J', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36679', '阿坝州', '2', '33007', 'A', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('36680', '汶川县', '3', '36679', 'W', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36694', '理县', '3', '36679', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36708', '茂县', '3', '36679', 'M', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36731', '松潘县', '3', '36679', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36759', '九寨沟县', '3', '36679', 'J', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36778', '金川县', '3', '36679', 'J', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36802', '小金县', '3', '36679', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36824', '黑水县', '3', '36679', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36842', '马尔康县', '3', '36679', 'M', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36858', '壤塘县', '3', '36679', 'R', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36871', '阿坝县', '3', '36679', 'A', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36893', '若尔盖县', '3', '36679', 'R', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36914', '红原县', '3', '36679', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36926', '甘孜州', '2', '33007', 'G', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('36927', '康定县', '3', '36926', 'K', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36949', '泸定县', '3', '36926', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36962', '丹巴县', '3', '36926', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36978', '九龙县', '3', '36926', 'J', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('36997', '雅江县', '3', '36926', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37015', '道孚县', '3', '36926', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37038', '炉霍县', '3', '36926', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37055', '甘孜县', '3', '36926', 'G', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37078', '新龙县', '3', '36926', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37098', '德格县', '3', '36926', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37125', '白玉县', '3', '36926', 'B', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37143', '石渠县', '3', '36926', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37166', '色达县', '3', '36926', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37184', '理塘县', '3', '36926', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37209', '巴塘县', '3', '36926', 'B', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37229', '乡城县', '3', '36926', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37242', '稻城县', '3', '36926', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37257', '得荣县', '3', '36926', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37270', '凉山州', '2', '33007', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('37271', '西昌市', '3', '37270', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37315', '木里县', '3', '37270', 'M', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37345', '盐源县', '3', '37270', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37380', '德昌', '3', '37270', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37404', '会理县', '3', '37270', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37455', '会东县', '3', '37270', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37509', '宁南县', '3', '37270', 'N', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37535', '普格县', '3', '37270', 'P', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37570', '布拖县', '3', '37270', 'B', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37601', '金阳县', '3', '37270', 'J', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37636', '昭觉县', '3', '37270', 'Z', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37684', '喜德县', '3', '37270', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37709', '冕宁县', '3', '37270', 'M', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37748', '越西县', '3', '37270', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37790', '甘洛县', '3', '37270', 'G', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37819', '美姑县', '3', '37270', 'M', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37856', '雷波县', '3', '37270', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37906', '贵州省', '1', '0', 'G', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('37907', '贵阳市', '2', '37906', 'G', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('37908', '市辖区', '3', '37907', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37909', '南明区', '3', '37907', 'N', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37927', '云岩区', '3', '37907', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37944', '花溪区', '3', '37907', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37961', '乌当区', '3', '37907', 'W', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37977', '白云区', '3', '37907', 'B', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37987', '小河区', '3', '37907', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('37991', '开阳县', '3', '37907', 'K', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38008', '息烽县', '3', '37907', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38019', '修文县', '3', '37907', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38030', '清镇市', '3', '37907', 'Q', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38042', '六盘水市', '2', '37906', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('38043', '钟山区', '3', '38042', 'Z', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38053', '六枝特区', '3', '38042', 'L', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38073', '水城县', '3', '38042', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38107', '盘县', '3', '38042', 'P', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38145', '遵义市', '2', '37906', 'Z', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('38146', '市辖区', '3', '38145', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38147', '红花岗区', '3', '38145', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38164', '汇川区', '3', '38145', 'H', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38174', '遵义县', '3', '38145', 'Z', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38206', '桐梓县', '3', '38145', 'T', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38231', '绥阳县', '3', '38145', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38247', '正安县', '3', '38145', 'Z', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38267', '道真县', '3', '38145', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38282', '务川县', '3', '38145', 'W', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38298', '凤冈县', '3', '38145', 'F', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38313', '湄潭县', '3', '38145', 'M', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38329', '余庆县', '3', '38145', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38340', '习水县', '3', '38145', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38364', '赤水市', '3', '38145', 'C', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38382', '仁怀市', '3', '38145', 'R', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38402', '安顺市', '2', '37906', 'A', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('38403', '市辖区', '3', '38402', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38404', '西秀区', '3', '38402', 'X', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38429', '平坝县', '3', '38402', 'P', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38440', '普定县', '3', '38402', 'P', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38452', '镇宁县', '3', '38402', 'Z', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38469', '关岭县', '3', '38402', 'G', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38484', '紫云县', '3', '38402', 'Z', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38497', '铜仁地区', '2', '37906', 'T', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('38498', '铜仁市', '3', '38497', 'T', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38516', '江口县', '3', '38497', 'J', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38526', '玉屏县', '3', '38497', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38533', '石阡县', '3', '38497', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38552', '思南县　', '3', '38497', 'S', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38580', '印江县', '3', '38497', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38598', '德江县', '3', '38497', 'D', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38619', '沿河县', '3', '38497', 'Y', '1', '100', '0', '1569460596');
INSERT INTO `eju_region_all` VALUES ('38642', '松桃县', '3', '38497', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38671', '万山特区', '3', '38497', 'W', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38677', '黔西南州', '2', '37906', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('38678', '兴义市', '3', '38677', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38705', '兴仁县', '3', '38677', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38722', '普安县', '3', '38677', 'P', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38737', '晴隆县', '3', '38677', 'Q', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38752', '贞丰县', '3', '38677', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38766', '望谟县', '3', '38677', 'W', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38784', '册亨县', '3', '38677', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38799', '安龙县', '3', '38677', 'A', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38816', '毕节地区', '2', '37906', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('38817', '毕节市', '3', '38816', 'B', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38859', '大方县', '3', '38816', 'D', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38896', '黔西县', '3', '38816', 'Q', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38925', '金沙县', '3', '38816', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38952', '织金县', '3', '38816', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('38985', '纳雍县', '3', '38816', 'N', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39011', '威宁县', '3', '38816', 'W', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39047', '赫章县', '3', '38816', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39075', '黔东南州', '2', '37906', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('39076', '凯里市', '3', '39075', 'K', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39092', '黄平县', '3', '39075', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39107', '施秉县', '3', '39075', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39116', '三穗县', '3', '39075', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39126', '镇远县', '3', '39075', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39139', '岑巩县', '3', '39075', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39151', '天柱县', '3', '39075', 'T', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39168', '锦屏县', '3', '39075', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39184', '剑河县', '3', '39075', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39197', '台江县', '3', '39075', 'T', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39206', '黎平县', '3', '39075', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39232', '榕江县', '3', '39075', 'R', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39252', '从江县', '3', '39075', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39274', '雷山县', '3', '39075', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39284', '麻江县', '3', '39075', 'M', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39294', '丹寨县', '3', '39075', 'D', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39302', '黔南州', '2', '37906', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('39303', '都匀市', '3', '39302', 'D', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39327', '福泉市', '3', '39302', 'F', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39345', '荔波县', '3', '39302', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39363', '贵定县', '3', '39302', 'G', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39384', '瓮安县', '3', '39302', 'W', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39408', '独山县', '3', '39302', 'D', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39427', '平塘县', '3', '39302', 'P', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39447', '罗甸县', '3', '39302', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39474', '长顺县', '3', '39302', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39493', '龙里县', '3', '39302', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39508', '惠水县', '3', '39302', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39534', '三都县', '3', '39302', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39556', '云南省', '1', '0', 'Y', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('39557', '昆明市', '2', '39556', 'K', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('39558', '市辖区', '3', '39557', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39559', '五华区', '3', '39557', 'W', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39571', '盘龙区', '3', '39557', 'P', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39582', '官渡区', '3', '39557', 'G', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39594', '西山区', '3', '39557', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39605', '东川区', '3', '39557', 'D', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39614', '呈贡县', '3', '39557', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39622', '晋宁县', '3', '39557', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39632', '富民县', '3', '39557', 'F', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39640', '宜良县', '3', '39557', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39650', '石林县', '3', '39557', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39659', '嵩明县', '3', '39557', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39667', '禄劝县', '3', '39557', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39684', '寻甸县', '3', '39557', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39701', '安宁市', '3', '39557', 'A', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39710', '曲靖市', '2', '39556', 'Q', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('39711', '市辖区', '3', '39710', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39712', '麒麟区', '3', '39710', 'Q', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39724', '马龙县', '3', '39710', 'M', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39733', '陆良县', '3', '39710', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39744', '师宗县', '3', '39710', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39753', '罗平县', '3', '39710', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39766', '富源县', '3', '39710', 'F', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39778', '会泽县', '3', '39710', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39800', '沾益县', '3', '39710', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39809', '宣威市', '3', '39710', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39836', '玉溪市', '2', '39556', 'Y', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('39837', '市辖区', '3', '39836', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39838', '红塔区', '3', '39836', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39850', '江川县', '3', '39836', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39858', '澄江县', '3', '39836', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39865', '通海县', '3', '39836', 'T', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39875', '华宁县', '3', '39836', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39881', '易门县', '3', '39836', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39889', '峨山县', '3', '39836', 'E', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39899', '新平县', '3', '39836', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39912', '元江县', '3', '39836', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39923', '保山市', '2', '39556', 'B', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('39924', '市辖区', '3', '39923', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39925', '隆阳区', '3', '39923', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39946', '施甸县', '3', '39923', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39960', '腾冲县', '3', '39923', 'T', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39979', '龙陵县', '3', '39923', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('39990', '昌宁县', '3', '39923', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40004', '昭通市', '2', '39556', 'Z', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('40005', '市辖区', '3', '40004', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40006', '昭阳区', '3', '40004', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40027', '鲁甸县', '3', '40004', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40040', '巧家县', '3', '40004', 'Q', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40057', '盐津县', '3', '40004', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40068', '大关县', '3', '40004', 'D', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40078', '永善县', '3', '40004', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40094', '绥江县', '3', '40004', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40100', '镇雄县', '3', '40004', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40129', '彝良县', '3', '40004', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40145', '威信县', '3', '40004', 'W', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40156', '水富县', '3', '40004', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40160', '丽江市', '2', '39556', 'L', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('40161', '市辖区', '3', '40160', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40162', '古城区', '3', '40160', 'G', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40172', '玉龙县', '3', '40160', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40189', '永胜县', '3', '40160', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40205', '华坪县', '3', '40160', 'H', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40214', '宁蒗县', '3', '40160', 'N', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40230', '思茅市', '2', '39556', 'S', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40231', '市辖区', '3', '40230', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40232', '翠云区', '3', '40230', 'C', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40240', '普洱县', '3', '40230', 'P', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40250', '墨江县', '3', '40230', 'M', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40266', '景东县', '3', '40230', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40280', '景谷县', '3', '40230', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40291', '镇沅县', '3', '40230', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40301', '江城县', '3', '40230', 'J', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40310', '孟连县', '3', '40230', 'M', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40318', '澜沧县', '3', '40230', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40340', '西盟县', '3', '40230', 'X', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40348', '临沧市', '2', '39556', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40349', '市辖区', '3', '40348', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40350', '临翔区', '3', '40348', 'L', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40361', '凤庆县', '3', '40348', 'F', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40375', '云县', '3', '40348', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40388', '永德县', '3', '40348', 'Y', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40400', '镇康县', '3', '40348', 'Z', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40408', '双江县', '3', '40348', 'S', '1', '100', '0', '1569460597');
INSERT INTO `eju_region_all` VALUES ('40417', '耿马县', '3', '40348', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40429', '沧源县', '3', '40348', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40441', '楚雄州', '2', '39556', 'C', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40442', '楚雄市', '3', '40441', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40458', '双柏县', '3', '40441', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40467', '牟定县', '3', '40441', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40475', '南华县', '3', '40441', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40486', '姚安县', '3', '40441', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40496', '大姚县', '3', '40441', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40509', '永仁县', '3', '40441', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40517', '元谋县', '3', '40441', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40528', '武定县', '3', '40441', 'W', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40540', '禄丰县', '3', '40441', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40555', '红河州', '2', '39556', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40556', '个旧市', '3', '40555', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40567', '开远市', '3', '40555', 'K', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40576', '蒙自县', '3', '40555', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40588', '屏边县', '3', '40555', 'P', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40596', '建水县', '3', '40555', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40611', '石屏县', '3', '40555', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40621', '弥勒县', '3', '40555', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40635', '泸西县', '3', '40555', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40644', '元阳县', '3', '40555', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40659', '红河县', '3', '40555', 'H', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40673', '金平县', '3', '40555', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40688', '绿春县', '3', '40555', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40698', '河口县', '3', '40555', 'H', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40705', '文山州', '2', '39556', 'W', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40706', '文山县', '3', '40705', 'W', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40722', '砚山县', '3', '40705', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40734', '西畴县', '3', '40705', 'X', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40744', '麻栗坡县', '3', '40705', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40756', '马关县', '3', '40705', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40770', '丘北县', '3', '40705', 'Q', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40783', '广南县', '3', '40705', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40802', '富宁县', '3', '40705', 'F', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40816', '西双版纳州', '2', '39556', 'X', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40817', '景洪市', '3', '40816', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40829', '勐海县', '3', '40816', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40841', '勐腊县', '3', '40816', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40852', '大理州', '2', '39556', 'D', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40853', '大理市', '3', '40852', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40866', '漾濞县', '3', '40852', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40876', '祥云县', '3', '40852', 'X', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40887', '宾川县', '3', '40852', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40901', '弥渡县', '3', '40852', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40910', '南涧县', '3', '40852', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40919', '巍山县', '3', '40852', 'W', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40930', '永平县', '3', '40852', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40938', '云龙县', '3', '40852', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40950', '洱源县', '3', '40852', 'E', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40960', '剑川县', '3', '40852', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40969', '鹤庆县', '3', '40852', 'H', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40979', '德宏州', '2', '39556', 'D', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('40980', '瑞丽市', '3', '40979', 'R', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('40988', '潞西市', '3', '40979', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41000', '梁河县', '3', '40979', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41010', '盈江县', '3', '40979', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41026', '陇川县', '3', '40979', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41036', '怒江州', '2', '39556', 'N', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41037', '泸水县', '3', '41036', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41047', '福贡县', '3', '41036', 'F', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41055', '贡山县', '3', '41036', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41061', '兰坪县', '3', '41036', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41070', '迪庆州', '2', '39556', 'D', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41071', '香格里拉县', '3', '41070', 'X', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41083', '德钦县', '3', '41070', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41092', '维西县', '3', '41070', 'W', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41103', '西藏', '1', '0', 'X', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('41104', '拉萨市', '2', '41103', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41105', '市辖区', '3', '41104', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41106', '城关区', '3', '41104', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41118', '林周县', '3', '41104', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41129', '当雄县', '3', '41104', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41138', '尼木县', '3', '41104', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41147', '曲水县', '3', '41104', 'Q', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41154', '堆龙德庆', '3', '41104', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41162', '达孜县', '3', '41104', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41169', '墨竹工卡县', '3', '41104', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41178', '昌都地区', '2', '41103', 'C', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41179', '昌都县', '3', '41178', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41195', '江达县', '3', '41178', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41209', '贡觉县', '3', '41178', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41222', '类乌齐县', '3', '41178', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41233', '丁青县', '3', '41178', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41247', '察亚县', '3', '41178', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41261', '八宿县', '3', '41178', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41276', '左贡县', '3', '41178', 'Z', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41287', '芒康县', '3', '41178', 'M', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41304', '洛隆县', '3', '41178', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41316', '边坝县', '3', '41178', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41328', '山南地区', '2', '41103', 'S', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41329', '乃东县', '3', '41328', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41337', '扎囊县', '3', '41328', 'Z', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41343', '贡嘎县', '3', '41328', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41352', '桑日县', '3', '41328', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41357', '琼结县', '3', '41328', 'Q', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41362', '曲松县', '3', '41328', 'Q', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41368', '措美县', '3', '41328', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41373', '洛扎县', '3', '41328', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41381', '加查县', '3', '41328', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41389', '隆子县', '3', '41328', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41401', '错那县', '3', '41328', 'C', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41412', '浪卡子县', '3', '41328', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41423', '日喀则地区', '2', '41103', 'R', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41424', '日喀则市', '3', '41423', 'R', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41437', '南木林县', '3', '41423', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41455', '江孜县', '3', '41423', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41475', '定日县', '3', '41423', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41489', '萨迦县', '3', '41423', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41501', '拉孜县', '3', '41423', 'L', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41513', '昂仁县', '3', '41423', 'A', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41531', '谢通门县', '3', '41423', 'X', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41551', '白朗县', '3', '41423', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41563', '仁布县', '3', '41423', 'R', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41573', '康马县', '3', '41423', 'K', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41583', '定结县', '3', '41423', 'D', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41594', '仲巴县', '3', '41423', 'Z', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41608', '亚东县', '3', '41423', 'Y', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41616', '吉隆县', '3', '41423', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41622', '聂拉木县', '3', '41423', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41630', '萨嘎县', '3', '41423', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41639', '岗巴县', '3', '41423', 'G', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41645', '那曲地区', '2', '41103', 'N', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41646', '那曲县', '3', '41645', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41659', '嘉黎县', '3', '41645', 'J', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41670', '比如县', '3', '41645', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41681', '聂荣县', '3', '41645', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41692', '安多县', '3', '41645', 'A', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41706', '申扎县', '3', '41645', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41715', '索县', '3', '41645', 'S', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41726', '班戈县', '3', '41645', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41737', '巴青县', '3', '41645', 'B', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41748', '尼玛县', '3', '41645', 'N', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41770', '阿里地区', '2', '41103', 'A', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41771', '普兰县', '3', '41770', 'P', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41775', '札达县', '3', '41770', 'Z', '1', '100', '0', '1569460598');
INSERT INTO `eju_region_all` VALUES ('41782', '噶尔县', '3', '41770', 'G', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41788', '日土县', '3', '41770', 'R', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41794', '革吉县', '3', '41770', 'G', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41800', '改则县', '3', '41770', 'G', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41808', '措勤县', '3', '41770', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41814', '林芝地区', '2', '41103', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41815', '林芝县', '3', '41814', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41823', '工布江达县', '3', '41814', 'G', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41833', '米林县', '3', '41814', 'M', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41842', '墨脱县', '3', '41814', 'M', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41851', '波密县', '3', '41814', 'B', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41863', '察隅县', '3', '41814', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41870', '朗县', '3', '41814', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41877', '陕西省', '1', '0', 'S', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('41878', '西安市', '2', '41877', 'X', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('41879', '市辖区', '3', '41878', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41880', '新城区', '3', '41878', 'X', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41890', '碑林区', '3', '41878', 'B', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41899', '莲湖区', '3', '41878', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41909', '灞桥区', '3', '41878', 'B', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41919', '未央区', '3', '41878', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41930', '雁塔区', '3', '41878', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41939', '阎良区', '3', '41878', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41947', '临潼区', '3', '41878', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41971', '长安区', '3', '41878', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('41997', '蓝田县', '3', '41878', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42020', '周至县', '3', '41878', 'Z', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42043', '户县', '3', '41878', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42060', '高陵县', '3', '41878', 'G', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42069', '铜川市', '2', '41877', 'T', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('42070', '市辖区', '3', '42069', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42071', '王益区', '3', '42069', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42079', '印台区', '3', '42069', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42091', '耀州区', '3', '42069', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42108', '宜君县', '3', '42069', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42119', '宝鸡市', '2', '41877', 'B', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('42120', '市辖区', '3', '42119', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42121', '渭滨区', '3', '42119', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42133', '金台区', '3', '42119', 'J', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42146', '陈仓区', '3', '42119', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42165', '凤翔县', '3', '42119', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42183', '岐山县', '3', '42119', 'Q', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42198', '扶风县', '3', '42119', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42211', '眉县', '3', '42119', 'M', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42224', '陇县', '3', '42119', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42240', '千阳县', '3', '42119', 'Q', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42252', '麟游县', '3', '42119', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42263', '凤县', '3', '42119', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42278', '太白县', '3', '42119', 'T', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42287', '咸阳市', '2', '41877', 'X', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('42288', '市辖区', '3', '42287', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42289', '秦都区', '3', '42287', 'Q', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42302', '杨凌区', '3', '42287', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42308', '渭城区', '3', '42287', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42319', '三原县', '3', '42287', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42334', '泾阳县', '3', '42287', 'J', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42351', '乾县', '3', '42287', 'Q', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42372', '礼泉县', '3', '42287', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42388', '永寿县', '3', '42287', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42402', '彬县', '3', '42287', 'B', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42419', '长武县', '3', '42287', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42431', '旬邑县', '3', '42287', 'X', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42446', '淳化县', '3', '42287', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42462', '武功县', '3', '42287', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42475', '兴平市', '3', '42287', 'X', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42490', '渭南市', '2', '41877', 'W', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('42491', '市辖区', '3', '42490', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42492', '临渭区', '3', '42490', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42523', '华县', '3', '42490', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42538', '潼关县', '3', '42490', 'T', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42547', '大荔县', '3', '42490', 'D', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42577', '合阳县', '3', '42490', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42594', '澄城县', '3', '42490', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42609', '蒲城县', '3', '42490', 'P', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42634', '白水县', '3', '42490', 'B', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42649', '富平县', '3', '42490', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42674', '韩城市', '3', '42490', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42691', '华阴市', '3', '42490', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42703', '延安市', '2', '41877', 'Y', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('42704', '市辖区', '3', '42703', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42705', '宝塔区', '3', '42703', 'B', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42729', '延长县', '3', '42703', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42742', '延川县', '3', '42703', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42757', '子长县', '3', '42703', 'Z', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42771', '安塞县', '3', '42703', 'A', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42784', '志丹县', '3', '42703', 'Z', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42796', '吴起县', '3', '42703', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42809', '甘泉县', '3', '42703', 'G', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42818', '富县', '3', '42703', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42833', '洛川县', '3', '42703', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42850', '宜川县', '3', '42703', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42863', '黄龙县', '3', '42703', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42874', '黄陵县', '3', '42703', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42888', '汉中市', '2', '41877', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('42889', '市辖区', '3', '42888', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42890', '汉台区', '3', '42888', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42908', '南郑县', '3', '42888', 'N', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42939', '城固县', '3', '42888', 'C', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42965', '洋县', '3', '42888', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('42992', '西乡县', '3', '42888', 'X', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43016', '勉县', '3', '42888', 'M', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43042', '宁强县', '3', '42888', 'N', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43069', '略阳县', '3', '42888', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43091', '镇巴县', '3', '42888', 'Z', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43116', '留坝县', '3', '42888', 'L', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43126', '佛坪县', '3', '42888', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43136', '榆林市', '2', '41877', 'Y', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43137', '市辖区', '3', '43136', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43138', '榆阳区', '3', '43136', 'Y', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43170', '神木县', '3', '43136', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43190', '府谷县', '3', '43136', 'F', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43211', '横山县', '3', '43136', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43230', '靖边县', '3', '43136', 'J', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43253', '定边县', '3', '43136', 'D', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43279', '绥德县', '3', '43136', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43300', '米脂县', '3', '43136', 'M', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43314', '佳县', '3', '43136', 'J', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43335', '吴堡县', '3', '43136', 'W', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43344', '清涧县', '3', '43136', 'Q', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43360', '子洲县', '3', '43136', 'Z', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43379', '安康市', '2', '41877', 'A', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43380', '市辖区', '3', '43379', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43381', '汉滨区', '3', '43379', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43428', '汉阴县', '3', '43379', 'H', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43447', '石泉县', '3', '43379', 'S', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43463', '宁陕县', '3', '43379', 'N', '1', '100', '0', '1569460599');
INSERT INTO `eju_region_all` VALUES ('43478', '紫阳县', '3', '43379', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43504', '岚皋县', '3', '43379', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43522', '平利县', '3', '43379', 'P', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43535', '镇坪县', '3', '43379', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43546', '旬阳县', '3', '43379', 'X', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43575', '白河县', '3', '43379', 'B', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43592', '商洛市', '2', '41877', 'S', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43593', '市辖区', '3', '43592', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43594', '商州区', '3', '43592', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43628', '洛南县', '3', '43592', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43654', '丹凤县', '3', '43592', 'D', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43676', '商南县', '3', '43592', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43699', '山阳县', '3', '43592', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43730', '镇安县', '3', '43592', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43759', '柞水县', '3', '43592', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43776', '甘肃省', '1', '0', 'G', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('43777', '兰州市', '2', '43776', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43778', '市辖区', '3', '43777', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43779', '城关区', '3', '43777', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43804', '七里河区', '3', '43777', 'Q', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43820', '兰州市西固区', '3', '43777', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43836', '安宁区', '3', '43777', 'A', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43845', '红古区', '3', '43777', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43853', '永登县', '3', '43777', 'Y', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43872', '皋兰县', '3', '43777', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43880', '榆中县', '3', '43777', 'Y', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43904', '嘉峪关市', '2', '43776', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43905', '市辖', '3', '43904', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43914', '金昌市', '2', '43776', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43915', '市辖区', '3', '43914', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43916', '金川区', '3', '43914', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43925', '永昌县', '3', '43914', 'Y', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43936', '白银市', '2', '43776', 'B', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('43937', '市辖区', '3', '43936', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43938', '白银区', '3', '43936', 'B', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43949', '平川区', '3', '43936', 'P', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43961', '靖远县', '3', '43936', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('43980', '会宁县', '3', '43936', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44009', '景泰县', '3', '43936', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44022', '天水市', '2', '43776', 'T', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44023', '市辖区', '3', '44022', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44024', '秦州区', '3', '44022', 'Q', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44048', '麦积区', '3', '44022', 'M', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44069', '清水县', '3', '44022', 'Q', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44088', '秦安县', '3', '44022', 'Q', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44106', '甘谷县', '3', '44022', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44122', '武山县', '3', '44022', 'W', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44138', '张家川县', '3', '44022', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44154', '武威市', '2', '43776', 'W', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44155', '市辖区', '3', '44154', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44156', '凉州区', '3', '44154', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44202', '民勤县', '3', '44154', 'M', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44221', '古浪县', '3', '44154', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44242', '天祝县', '3', '44154', 'T', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44265', '张掖市', '2', '43776', 'Z', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44266', '市辖区', '3', '44265', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44267', '甘州区', '3', '44265', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44294', '肃南县', '3', '44265', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44305', '民乐县', '3', '44265', 'M', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44317', '临泽县', '3', '44265', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44331', '高台县', '3', '44265', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44341', '山丹县', '3', '44265', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44352', '平凉市', '2', '43776', 'P', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44353', '市辖区', '3', '44352', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44354', '崆峒区', '3', '44352', 'K', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44375', '泾川县', '3', '44352', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44392', '灵台县', '3', '44352', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44408', '崇信县', '3', '44352', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44418', '华亭县', '3', '44352', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44431', '庄浪县', '3', '44352', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44451', '静宁县', '3', '44352', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44477', '酒泉市', '2', '43776', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44478', '市辖区', '3', '44477', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44479', '肃州区', '3', '44477', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44504', '金塔县', '3', '44477', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44516', '瓜州县', '3', '44477', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44531', '肃北县', '3', '44477', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44535', '阿克塞县', '3', '44477', 'A', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44539', '玉门市', '3', '44477', 'Y', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44557', '敦煌市', '3', '44477', 'D', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44569', '庆阳市', '2', '43776', 'Q', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44570', '市辖区', '3', '44569', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44571', '西峰区', '3', '44569', 'X', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44582', '庆城县', '3', '44569', 'Q', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44598', '环县', '3', '44569', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44620', '华池县', '3', '44569', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44636', '合水县', '3', '44569', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44649', '正宁县', '3', '44569', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44660', '宁县', '3', '44569', 'N', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44679', '镇原县', '3', '44569', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44699', '定西市', '2', '43776', 'D', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44700', '市辖区', '3', '44699', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44701', '安定区', '3', '44699', 'A', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44723', '通渭县', '3', '44699', 'T', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44742', '陇西县', '3', '44699', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44760', '渭源县', '3', '44699', 'W', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44777', '临洮县', '3', '44699', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44796', '漳县', '3', '44699', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44810', '岷县', '3', '44699', 'M', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44829', '陇南市', '2', '43776', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('44830', '市辖区', '3', '44829', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44831', '武都区', '3', '44829', 'W', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44868', '成县', '3', '44829', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44886', '文县', '3', '44829', 'W', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44907', '宕昌县', '3', '44829', 'D', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44933', '康县', '3', '44829', 'K', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44955', '西和县', '3', '44829', 'X', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('44976', '礼县', '3', '44829', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45006', '徽县', '3', '44829', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45022', '两当县', '3', '44829', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45035', '临夏州', '2', '43776', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45036', '临夏市', '3', '45035', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45047', '临夏县', '3', '45035', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45073', '康乐县', '3', '45035', 'K', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45089', '永靖县', '3', '45035', 'Y', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45107', '广河县', '3', '45035', 'G', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45117', '和政县', '3', '45035', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45131', '东乡县', '3', '45035', 'D', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45156', '积石山县', '3', '45035', 'J', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45174', '甘南州', '2', '43776', 'G', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45175', '合作市', '3', '45174', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45186', '临潭县', '3', '45174', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45203', '卓尼县', '3', '45174', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45219', '舟曲县', '3', '45174', 'Z', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45239', '迭部县', '3', '45174', 'D', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45251', '玛曲县', '3', '45174', 'M', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45263', '碌曲县', '3', '45174', 'L', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45272', '夏河县', '3', '45174', 'X', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45286', '青海省', '1', '0', 'Q', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('45287', '西宁市', '2', '45286', 'X', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45288', '市辖区', '3', '45287', 'S', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45289', '城东区', '3', '45287', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45299', '城中区', '3', '45287', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45306', '城西区', '3', '45287', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45314', '城北区', '3', '45287', 'C', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45320', '大通县', '3', '45287', 'D', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45341', '湟中县', '3', '45287', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45358', '湟源县', '3', '45287', 'H', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45368', '海东地区', '2', '45286', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45369', '平安县', '3', '45368', 'P', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45378', '民和县', '3', '45368', 'M', '1', '100', '0', '1569460600');
INSERT INTO `eju_region_all` VALUES ('45401', '乐都县', '3', '45368', 'L', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45421', '互助县', '3', '45368', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45441', '化隆县', '3', '45368', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45461', '循化县', '3', '45368', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45471', '海北州', '2', '45286', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45472', '门源县', '3', '45471', 'M', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45487', '祁连县', '3', '45471', 'Q', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45495', '海晏县', '3', '45471', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45502', '刚察县', '3', '45471', 'G', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45510', '黄南州', '2', '45286', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45511', '同仁县', '3', '45510', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45523', '尖扎县', '3', '45510', 'J', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45533', '泽库县', '3', '45510', 'Z', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45542', '河南县', '3', '45510', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45548', '海南州', '2', '45286', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45549', '共和县', '3', '45548', 'G', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45566', '同德县', '3', '45548', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45573', '贵德县', '3', '45548', 'G', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45581', '兴海县', '3', '45548', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45589', '贵南县', '3', '45548', 'G', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45597', '果洛州', '2', '45286', 'G', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45598', '玛沁县', '3', '45597', 'M', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45607', '班玛县', '3', '45597', 'B', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45617', '甘德县', '3', '45597', 'G', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45625', '达日县', '3', '45597', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45636', '久治县', '3', '45597', 'J', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45643', '玛多县', '3', '45597', 'M', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45648', '玉树州', '2', '45286', 'Y', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45649', '玉树县', '3', '45648', 'Y', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45659', '杂多县', '3', '45648', 'Z', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45668', '称多县', '3', '45648', 'C', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45676', '治多县', '3', '45648', 'Z', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45683', '囊谦县', '3', '45648', 'N', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45694', '曲麻莱县', '3', '45648', 'Q', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45701', '海西州', '2', '45286', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45702', '格尔木市', '3', '45701', 'G', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45714', '德令哈市', '3', '45701', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45727', '乌兰县', '3', '45701', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45733', '都兰县', '3', '45701', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45742', '天峻县', '3', '45701', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45753', '宁夏', '1', '0', 'N', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('45754', '银川市', '2', '45753', 'Y', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45755', '市辖区', '3', '45754', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45756', '兴庆区', '3', '45754', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45772', '西夏区', '3', '45754', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45784', '金凤区', '3', '45754', 'J', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45794', '永宁县', '3', '45754', 'Y', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45803', '贺兰县', '3', '45754', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45813', '灵武市', '3', '45754', 'L', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45825', '石嘴山市', '2', '45753', 'S', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45826', '市辖区', '3', '45825', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45827', '大武口区', '3', '45825', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45839', '惠农区', '3', '45825', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45856', '平罗县', '3', '45825', 'P', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45871', '吴忠市', '2', '45753', 'W', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45872', '市辖区', '3', '45871', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45877', '利通区', '3', '45871', 'L', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45892', '盐池县', '3', '45871', 'Y', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45903', '同心县', '3', '45871', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45914', '青铜峡市', '3', '45871', 'Q', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45926', '固原市', '2', '45753', 'G', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('45927', '市辖区', '3', '45926', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45928', '原州区', '3', '45926', 'Y', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45944', '西吉县', '3', '45926', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45964', '隆德县', '3', '45926', 'L', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45978', '泾源县', '3', '45926', 'J', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45986', '彭阳县', '3', '45926', 'P', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('45999', '中卫市', '2', '45753', 'Z', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46000', '市辖区', '3', '45999', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46012', '沙坡头区', '3', '45999', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46013', '中宁县', '3', '45999', 'Z', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46026', '海原县', '3', '45999', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46047', '新疆', '1', '0', 'X', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('46048', '乌鲁木齐市', '2', '46047', 'W', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46049', '市辖区', '3', '46048', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46050', '天山区', '3', '46048', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46065', '沙依巴克区', '3', '46048', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46079', '新市区', '3', '46048', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46095', '水磨沟区', '3', '46048', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46104', '头屯河区', '3', '46048', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46114', '达坂城区', '3', '46048', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46123', '东山区', '3', '46048', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46128', '乌鲁木齐县', '3', '46048', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46138', '克拉玛依市', '2', '46047', 'K', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46139', '市辖区', '3', '46138', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46140', '独山子区', '3', '46138', 'D', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46144', '克拉玛依区', '3', '46138', 'K', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46155', '白碱滩区', '3', '46138', 'B', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46158', '乌尔禾区', '3', '46138', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46162', '吐鲁番地区', '2', '46047', 'T', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46163', '吐鲁番市', '3', '46162', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46178', '鄯善县', '3', '46162', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46189', '托克逊县', '3', '46162', 'T', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46197', '哈密地区', '2', '46047', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46198', '哈密市', '3', '46197', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46230', '巴里坤县', '3', '46197', 'B', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46246', '伊吾县', '3', '46197', 'Y', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46255', '昌吉州', '2', '46047', 'C', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46256', '昌吉市', '3', '46255', 'C', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46275', '阜康市', '3', '46255', 'F', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46289', '米泉市', '3', '46255', 'M', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46299', '呼图壁县', '3', '46255', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46316', '玛纳斯', '3', '46255', 'M', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46337', '奇台县', '3', '46255', 'Q', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46355', '吉木萨尔县', '3', '46255', 'J', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46366', '木垒县', '3', '46255', 'M', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46380', '博州', '2', '46047', 'B', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46381', '博乐市', '3', '46380', 'B', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46399', '精河县', '3', '46380', 'J', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46410', '温泉县', '3', '46380', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46422', '巴州', '2', '46047', 'B', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46423', '库尔勒市', '3', '46422', 'K', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46451', '轮台县', '3', '46422', 'L', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46463', '尉犁县', '3', '46422', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46476', '若羌县', '3', '46422', 'R', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46486', '且末县', '3', '46422', 'Q', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46500', '焉耆县', '3', '46422', 'Y', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46512', '和静县', '3', '46422', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46531', '和硕县', '3', '46422', 'H', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46542', '博湖县', '3', '46422', 'B', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46551', '阿克苏地区', '2', '46047', 'A', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46552', '阿克苏市', '3', '46551', 'A', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46571', '温宿县', '3', '46551', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46592', '库车县', '3', '46551', 'K', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46617', '沙雅县', '3', '46551', 'S', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46630', '新和县', '3', '46551', 'X', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46640', '拜城县', '3', '46551', 'B', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46657', '乌什县', '3', '46551', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46668', '阿瓦提县', '3', '46551', 'A', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46682', '柯坪县', '3', '46551', 'K', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46688', '克州', '2', '46047', 'K', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46689', '阿图什市', '3', '46688', 'A', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46704', '阿克陶县', '3', '46688', 'A', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46723', '阿合奇县', '3', '46688', 'A', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46733', '乌恰县', '3', '46688', 'W', '1', '100', '0', '1569460601');
INSERT INTO `eju_region_all` VALUES ('46747', '喀什地区', '2', '46047', 'K', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46748', '喀什市', '3', '46747', 'K', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46761', '疏附县', '3', '46747', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46780', '疏勒县', '3', '46747', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46797', '英吉沙县', '3', '46747', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46813', '泽普县', '3', '46747', 'Z', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46830', '莎车县', '3', '46747', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46863', '叶城县', '3', '46747', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46885', '麦盖提县', '3', '46747', 'M', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46902', '岳普湖县', '3', '46747', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46913', '伽师县', '3', '46747', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46928', '巴楚县', '3', '46747', 'B', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46942', '塔什库尔干县', '3', '46747', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46957', '和田地区', '2', '46047', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('46958', '和田市', '3', '46957', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46971', '和田县', '3', '46957', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('46983', '墨玉县', '3', '46957', 'M', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47002', '皮山县', '3', '46957', 'P', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47020', '洛浦县', '3', '46957', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47032', '策勒县', '3', '46957', 'C', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47042', '于田县', '3', '46957', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47061', '民丰县', '3', '46957', 'M', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47069', '伊犁州', '2', '46047', 'Y', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47070', '伊宁市', '3', '47069', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47091', '奎屯市', '3', '47069', 'K', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47099', '伊宁县', '3', '47069', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47121', '察布查尔县', '3', '47069', 'C', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47143', '霍城县', '3', '47069', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47164', '巩留县', '3', '47069', 'G', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47180', '新源县', '3', '47069', 'X', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47196', '昭苏县', '3', '47069', 'Z', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47214', '特克斯县', '3', '47069', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47226', '尼勒克县', '3', '47069', 'N', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47241', '塔城地区', '2', '46047', 'T', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47242', '塔城市', '3', '47241', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47258', '乌苏市', '3', '47241', 'W', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47291', '额敏县', '3', '47241', 'E', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47315', '沙湾县', '3', '47241', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47338', '托里县', '3', '47241', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47351', '裕民县', '3', '47241', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47360', '和布县', '3', '47241', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47374', '阿勒泰地区', '2', '46047', 'A', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47375', '阿勒泰市', '3', '47374', 'A', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47393', '布尔津县', '3', '47374', 'B', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47401', '富蕴县', '3', '47374', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47411', '福海县', '3', '47374', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47424', '哈巴河县', '3', '47374', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47433', '青河县', '3', '47374', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47441', '吉木乃县', '3', '47374', 'J', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47450', '省直辖行政单位', '2', '46047', 'S', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47451', '石河子市', '3', '47450', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47460', '阿拉尔市', '3', '47450', 'A', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47477', '图木舒克市', '3', '47450', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47486', '五家渠市', '3', '47450', 'W', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47493', '台湾', '1', '0', 'T', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('47494', '香港', '1', '0', 'X', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('47495', '澳门', '1', '0', 'A', '0', '100', '0', '1569460512');
INSERT INTO `eju_region_all` VALUES ('47496', '龙华新区', '3', '28558', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47497', '光明新区', '3', '28558', 'G', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47498', '九龙', '2', '47494', 'J', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('47499', '香港岛', '2', '47494', 'X', '1', '100', '0', '1569460553');
INSERT INTO `eju_region_all` VALUES ('47500', '新界', '2', '47494', 'X', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47501', '观塘区', '3', '47498', 'G', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47502', '黄大仙区', '3', '47498', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47503', '九龙城区', '3', '47498', 'J', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47504', '深水埗区', '3', '47498', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47505', '油尖旺区', '3', '47498', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47506', '东区', '3', '47499', 'D', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47507', '南区', '3', '47499', 'N', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47508', '湾仔', '3', '47499', 'W', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47509', '中西区', '3', '47499', 'Z', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47510', '北区', '3', '47500', 'B', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47511', '大埔区', '3', '47500', 'D', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47512', '葵青区', '3', '47500', 'K', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47513', '离岛区', '3', '47500', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47514', '荃湾区', '3', '47500', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47515', '沙田区', '3', '47500', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47516', '屯门区', '3', '47500', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47517', '西贡区', '3', '47500', 'X', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47518', '元朗区', '3', '47500', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47519', '澳门半岛', '2', '47495', 'A', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47520', '离岛', '2', '47495', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47521', '大堂区', '3', '47519', 'D', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47522', '风顺堂区', '3', '47519', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47523', '花地玛堂区', '3', '47519', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47524', '花王堂区', '3', '47519', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47525', '望德堂区', '3', '47519', 'W', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47526', '嘉模堂区', '3', '47520', 'J', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47527', '路氹填海区', '3', '47520', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47528', '圣方济各堂区', '3', '47520', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47529', '高雄市', '2', '47493', 'G', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47530', '花莲县', '2', '47493', 'H', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47531', '基隆市', '2', '47493', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47532', '嘉义市', '2', '47493', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47533', '嘉义县', '2', '47493', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47534', '金门县', '2', '47493', 'J', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47535', '连江县', '2', '47493', 'L', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47536', '苗栗县', '2', '47493', 'M', '1', '100', '0', '1569460554');
INSERT INTO `eju_region_all` VALUES ('47537', '南投县', '2', '47493', 'N', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47538', '澎湖县', '2', '47493', 'P', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47539', '屏东县', '2', '47493', 'P', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47540', '台北市', '2', '47493', 'T', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47541', '台东县', '2', '47493', 'T', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47542', '台南市', '2', '47493', 'T', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47543', '台中市', '2', '47493', 'T', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47544', '桃园市', '2', '47493', 'T', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47545', '新北市', '2', '47493', 'X', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47546', '新竹市', '2', '47493', 'X', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47547', '新竹县', '2', '47493', 'X', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47548', '宜兰县', '2', '47493', 'Y', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47549', '云林县', '2', '47493', 'Y', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47550', '彰化县', '2', '47493', 'Z', '1', '100', '0', '1569460555');
INSERT INTO `eju_region_all` VALUES ('47551', '阿莲区', '3', '47529', 'A', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47552', '大寮区', '3', '47529', 'D', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47553', '大社区', '3', '47529', 'D', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47554', '大树区', '3', '47529', 'D', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47555', '凤山区', '3', '47529', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47556', '冈山区', '3', '47529', 'G', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47557', '鼓山区', '3', '47529', 'G', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47558', '湖内区', '3', '47529', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47559', '甲仙区', '3', '47529', 'J', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47560', '林园区', '3', '47529', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47561', '苓雅区', '3', '47529', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47562', '六龟区', '3', '47529', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47563', '路竹区', '3', '47529', 'L', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47564', '茂林区', '3', '47529', 'M', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47565', '美浓区', '3', '47529', 'M', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47566', '弥陀区', '3', '47529', 'M', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47567', '楠梓区', '3', '47529', 'N', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47568', '那玛夏区', '3', '47529', 'N', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47569', '内门区', '3', '47529', 'N', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47570', '鸟松区', '3', '47529', 'N', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47571', '旗津区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47572', '旗门区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47573', '其它区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47574', '前金区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47575', '前镇区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47576', '桥头区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47577', '茄萣区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47578', '芩雅区', '3', '47529', 'Q', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47579', '仁武区', '3', '47529', 'R', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47580', '三民区', '3', '47529', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47581', '杉林区', '3', '47529', 'S', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47582', '桃源区', '3', '47529', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47583', '田寮区', '3', '47529', 'T', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47584', '小港区', '3', '47529', 'X', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47585', '新兴区', '3', '47529', 'X', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47586', '燕巢区', '3', '47529', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47587', '盐埕区', '3', '47529', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47588', '永安区', '3', '47529', 'Y', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47589', '梓官区', '3', '47529', 'Z', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47590', '左营区', '3', '47529', 'Z', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47591', '丰滨乡', '3', '47530', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47592', '凤林镇', '3', '47530', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47593', '富里乡', '3', '47530', 'F', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47594', '光复乡', '3', '47530', 'G', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47595', '花莲市', '3', '47530', 'H', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47596', '吉安乡', '3', '47530', 'J', '1', '100', '0', '1569460602');
INSERT INTO `eju_region_all` VALUES ('47597', '瑞穗乡', '3', '47530', 'R', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47598', '寿丰乡', '3', '47530', 'S', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47599', '太鲁阁', '3', '47530', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47600', '万荣乡', '3', '47530', 'W', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47601', '新城乡', '3', '47530', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47602', '秀林乡', '3', '47530', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47603', '玉里镇', '3', '47530', 'Y', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47604', '卓溪乡', '3', '47530', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47605', '安乐区', '3', '47531', 'A', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47606', '暖暖区', '3', '47531', 'N', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47607', '七堵区', '3', '47531', 'Q', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47608', '其它区', '3', '47531', 'Q', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47609', '仁爱区', '3', '47531', 'R', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47610', '信义区', '3', '47531', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47611', '中山区', '3', '47531', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47612', '中正区', '3', '47531', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47613', '东区', '3', '47532', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47614', '西区', '3', '47532', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47615', '其它区', '3', '47532', 'Q', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47616', '阿里山乡', '3', '47533', 'A', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47617', '布袋镇', '3', '47533', 'B', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47618', '大林镇', '3', '47533', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47619', '大埔乡', '3', '47533', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47620', '东石乡', '3', '47533', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47621', '番路乡', '3', '47533', 'F', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47622', '六脚乡', '3', '47533', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47623', '鹿草乡', '3', '47533', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47624', '梅山乡', '3', '47533', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47625', '民雄乡', '3', '47533', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47626', '朴子市', '3', '47533', 'P', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47627', '水上乡', '3', '47533', 'S', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47628', '太保市', '3', '47533', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47629', '溪口乡', '3', '47533', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47630', '新港乡', '3', '47533', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47631', '义竹乡', '3', '47533', 'Y', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47632', '中埔乡', '3', '47533', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47633', '竹崎乡', '3', '47533', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47634', '金城镇', '3', '47534', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47635', '金湖镇', '3', '47534', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47636', '金宁乡', '3', '47534', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47637', '金沙镇', '3', '47534', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47638', '烈屿乡', '3', '47534', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47639', '乌邱乡', '3', '47534', 'W', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47640', '北竿乡', '3', '47535', 'B', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47641', '东引乡', '3', '47535', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47642', '莒光乡', '3', '47535', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47643', '南竿乡', '3', '47535', 'N', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47644', '大湖乡', '3', '47536', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47645', '公馆乡', '3', '47536', 'G', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47646', '后龙镇', '3', '47536', 'H', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47647', '苗栗市', '3', '47536', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47648', '南庄乡', '3', '47536', 'N', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47649', '三湾乡', '3', '47536', 'S', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47650', '三义乡', '3', '47536', 'S', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47651', '狮潭乡', '3', '47536', 'S', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47652', '泰安乡', '3', '47536', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47653', '铜锣乡', '3', '47536', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47654', '通宵镇', '3', '47536', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47655', '头份镇', '3', '47536', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47656', '头屋乡', '3', '47536', 'T', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47657', '西湖乡', '3', '47536', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47658', '苑里镇', '3', '47536', 'Y', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47659', '造桥乡', '3', '47536', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47660', '竹南镇', '3', '47536', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47661', '卓兰镇', '3', '47536', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47662', '草屯镇', '3', '47537', 'C', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47663', '国姓乡', '3', '47537', 'G', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47664', '集集镇', '3', '47537', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47665', '鹿谷乡', '3', '47537', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47666', '名间乡', '3', '47537', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47667', '南投市', '3', '47537', 'N', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47668', '埔里镇', '3', '47537', 'P', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47669', '仁爱乡', '3', '47537', 'R', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47670', '水里乡', '3', '47537', 'S', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47671', '信义乡', '3', '47537', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47672', '鱼池乡', '3', '47537', 'Y', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47673', '中寮乡', '3', '47537', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47674', '竹山镇', '3', '47537', 'Z', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47675', '白沙乡', '3', '47538', 'B', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47676', '湖西乡', '3', '47538', 'H', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47677', '马公市', '3', '47538', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47678', '七美乡', '3', '47538', 'Q', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47679', '望安乡', '3', '47538', 'W', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47680', '西屿乡', '3', '47538', 'X', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47681', '长治乡', '3', '47539', 'C', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47682', '潮州镇', '3', '47539', 'C', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47683', '车城乡', '3', '47539', 'C', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47684', '春日乡', '3', '47539', 'C', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47685', '东港镇', '3', '47539', 'D', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47686', '枋寮乡', '3', '47539', 'F', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47687', '枋山乡', '3', '47539', 'F', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47688', '高树乡', '3', '47539', 'G', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47689', '恒春镇', '3', '47539', 'H', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47690', '佳冬乡', '3', '47539', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47691', '九如乡', '3', '47539', 'J', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47692', '崁顶乡', '3', '47539', 'K', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47693', '来义乡', '3', '47539', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47694', '里港乡', '3', '47539', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47695', '林边乡', '3', '47539', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47696', '麟洛乡', '3', '47539', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47697', '琉球乡', '3', '47539', 'L', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47698', '玛家乡', '3', '47539', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47699', '满州乡', '3', '47539', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47700', '牡丹乡', '3', '47539', 'M', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47701', '南州乡', '3', '47539', 'N', '1', '100', '0', '1569460603');
INSERT INTO `eju_region_all` VALUES ('47702', '内埔乡', '3', '47539', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47703', '屏东市', '3', '47539', 'P', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47704', '三地门乡', '3', '47539', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47705', '狮子乡', '3', '47539', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47706', '泰武乡', '3', '47539', 'T', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47707', '万丹乡', '3', '47539', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47708', '万峦乡', '3', '47539', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47709', '雾台乡', '3', '47539', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47710', '新埤乡', '3', '47539', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47711', '新园乡', '3', '47539', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47712', '盐埔乡', '3', '47539', 'Y', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47713', '竹田乡', '3', '47539', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47714', '北投区', '3', '47540', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47715', '大安区', '3', '47540', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47716', '大同区', '3', '47540', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47717', '南港区', '3', '47540', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47718', '内湖区', '3', '47540', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47719', '士林区', '3', '47540', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47720', '松山区', '3', '47540', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47721', '万华区', '3', '47540', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47722', '文山区', '3', '47540', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47723', '信义区', '3', '47540', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47724', '中山区', '3', '47540', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47725', '中正区', '3', '47540', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47726', '其它区', '3', '47540', 'Q', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47727', '卑南乡', '3', '47541', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47728', '长滨乡', '3', '47541', 'C', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47729', '成功镇', '3', '47541', 'C', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47730', '池上乡', '3', '47541', 'C', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47731', '达仁乡', '3', '47541', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47732', '大武乡', '3', '47541', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47733', '东河乡', '3', '47541', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47734', '关山镇', '3', '47541', 'G', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47735', '海端乡', '3', '47541', 'H', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47736', '金峰乡', '3', '47541', 'J', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47737', '兰屿乡', '3', '47541', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47738', '鹿野乡', '3', '47541', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47739', '绿岛乡', '3', '47541', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47740', '台东市', '3', '47541', 'T', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47741', '太麻里乡', '3', '47541', 'T', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47742', '延平乡', '3', '47541', 'Y', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47743', '中西区', '3', '47542', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47744', '东区', '3', '47542', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47745', '南区', '3', '47542', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47746', '北区', '3', '47542', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47747', '安平区', '3', '47542', 'A', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47748', '安南区', '3', '47542', 'A', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47749', '其它区', '3', '47542', 'Q', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47750', '永康区', '3', '47542', 'Y', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47751', '归仁区', '3', '47542', 'G', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47752', '新化区', '3', '47542', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47753', '左镇区', '3', '47542', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47754', '玉井区', '3', '47542', 'Y', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47755', '楠西区', '3', '47542', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47756', '南化区', '3', '47542', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47757', '仁德区', '3', '47542', 'R', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47758', '关庙区', '3', '47542', 'G', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47759', '龙崎区', '3', '47542', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47760', '官田区', '3', '47542', 'G', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47761', '麻豆区', '3', '47542', 'M', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47762', '佳里区', '3', '47542', 'J', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47763', '西港区', '3', '47542', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47764', '七股区', '3', '47542', 'Q', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47765', '将军区', '3', '47542', 'J', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47766', '学甲区', '3', '47542', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47767', '北门区', '3', '47542', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47768', '新营区', '3', '47542', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47769', '后壁区', '3', '47542', 'H', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47770', '白河区', '3', '47542', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47771', '东山区', '3', '47542', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47772', '六甲区', '3', '47542', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47773', '下营区', '3', '47542', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47774', '柳营区', '3', '47542', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47775', '盐水区', '3', '47542', 'Y', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47776', '善化区', '3', '47542', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47777', '大内区', '3', '47542', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47778', '山上区', '3', '47542', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47779', '新市区', '3', '47542', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47780', '安定区', '3', '47542', 'A', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47781', '中区', '3', '47543', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47782', '东区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47783', '南区', '3', '47543', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47784', '西区', '3', '47543', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47785', '北区', '3', '47543', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47786', '北屯区', '3', '47543', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47787', '西屯区', '3', '47543', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47788', '南屯区', '3', '47543', 'N', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47789', '其它区', '3', '47543', 'Q', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47790', '太平区', '3', '47543', 'T', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47791', '大里区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47792', '雾峰区', '3', '47543', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47793', '乌日区', '3', '47543', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47794', '丰原区', '3', '47543', 'F', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47795', '后里区', '3', '47543', 'H', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47796', '石冈区', '3', '47543', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47797', '东势区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47798', '和平区', '3', '47543', 'H', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47799', '新社区', '3', '47543', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47800', '潭子区', '3', '47543', 'T', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47801', '大雅区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47802', '神冈区', '3', '47543', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47803', '大肚区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47804', '沙鹿区', '3', '47543', 'S', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47805', '龙井区', '3', '47543', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47806', '梧栖区', '3', '47543', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47807', '清水区', '3', '47543', 'Q', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47808', '大甲区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47809', '外埔区', '3', '47543', 'W', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47810', '大安区', '3', '47543', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47811', '中坜区', '3', '47544', 'Z', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47812', '平镇区', '3', '47544', 'P', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47813', '龙潭区', '3', '47544', 'L', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47814', '杨梅区', '3', '47544', 'Y', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47815', '新屋区', '3', '47544', 'X', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47816', '观音区', '3', '47544', 'G', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47817', '桃园区', '3', '47544', 'T', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47818', '龟山区', '3', '47544', 'G', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47819', '八德区', '3', '47544', 'B', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47820', '大溪区', '3', '47544', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47821', '复兴区', '3', '47544', 'F', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47822', '大园区', '3', '47544', 'D', '1', '100', '0', '1569460604');
INSERT INTO `eju_region_all` VALUES ('47823', '芦竹区', '3', '47544', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47824', '万里区', '3', '47545', 'W', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47825', '金山区', '3', '47545', 'J', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47826', '板桥区', '3', '47545', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47827', '汐止区', '3', '47545', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47828', '深坑区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47829', '石碇区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47830', '瑞芳区', '3', '47545', 'R', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47831', '平溪区', '3', '47545', 'P', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47832', '双溪区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47833', '贡寮区', '3', '47545', 'G', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47834', '新店区', '3', '47545', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47835', '坪林区', '3', '47545', 'P', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47836', '乌来区', '3', '47545', 'W', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47837', '永和区', '3', '47545', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47838', '中和区', '3', '47545', 'Z', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47839', '土城区', '3', '47545', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47840', '三峡区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47841', '树林区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47842', '莺歌区', '3', '47545', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47843', '三重区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47844', '新庄区', '3', '47545', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47845', '泰山区', '3', '47545', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47846', '林口区', '3', '47545', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47847', '芦洲区', '3', '47545', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47848', '五股区', '3', '47545', 'W', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47849', '八里区', '3', '47545', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47850', '淡水区', '3', '47545', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47851', '三芝区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47852', '石门区', '3', '47545', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47853', '东区', '3', '47546', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47854', '北区', '3', '47546', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47855', '香山区', '3', '47546', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47856', '其它区', '3', '47546', 'Q', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47857', '竹北市', '3', '47547', 'Z', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47858', '湖口乡', '3', '47547', 'H', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47859', '新丰乡', '3', '47547', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47860', '新埔镇', '3', '47547', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47861', '关西镇', '3', '47547', 'G', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47862', '芎林乡', '3', '47547', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47863', '宝山乡', '3', '47547', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47864', '竹东镇', '3', '47547', 'Z', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47865', '五峰乡', '3', '47547', 'W', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47866', '横山乡', '3', '47547', 'H', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47867', '尖石乡', '3', '47547', 'J', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47868', '北埔乡', '3', '47547', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47869', '峨眉乡', '3', '47547', 'E', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47870', '宜兰市', '3', '47548', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47871', '头城镇', '3', '47548', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47872', '礁溪乡', '3', '47548', 'J', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47873', '壮围乡', '3', '47548', 'Z', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47874', '员山乡', '3', '47548', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47875', '罗东镇', '3', '47548', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47876', '三星乡', '3', '47548', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47877', '大同乡', '3', '47548', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47878', '五结乡', '3', '47548', 'W', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47879', '冬山乡', '3', '47548', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47880', '苏澳镇', '3', '47548', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47881', '南澳乡', '3', '47548', 'N', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47882', '钓鱼台', '3', '47548', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47883', '斗南镇', '3', '47549', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47884', '大埤乡', '3', '47549', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47885', '虎尾镇', '3', '47549', 'H', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47886', '土库镇', '3', '47549', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47887', '褒忠乡', '3', '47549', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47888', '东势乡', '3', '47549', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47889', '台西乡', '3', '47549', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47890', '仑背乡', '3', '47549', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47891', '麦寮乡', '3', '47549', 'M', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47892', '斗六市', '3', '47549', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47893', '林内乡', '3', '47549', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47894', '古坑乡', '3', '47549', 'G', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47895', '莿桐乡', '3', '47549', 'C', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47896', '西螺镇', '3', '47549', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47897', '二仑乡', '3', '47549', 'E', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47898', '北港镇', '3', '47549', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47899', '水林乡', '3', '47549', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47900', '口湖乡', '3', '47549', 'K', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47901', '四湖乡', '3', '47549', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47902', '元长乡', '3', '47549', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47903', '彰化市', '3', '47550', 'Z', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47904', '芬园乡', '3', '47550', 'F', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47905', '花坛乡', '3', '47550', 'H', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47906', '秀水乡', '3', '47550', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47907', '鹿港镇', '3', '47550', 'L', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47908', '福兴乡', '3', '47550', 'F', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47909', '线西乡', '3', '47550', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47910', '和美镇', '3', '47550', 'H', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47911', '伸港乡', '3', '47550', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47912', '员林镇', '3', '47550', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47913', '社头乡', '3', '47550', 'S', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47914', '永靖乡', '3', '47550', 'Y', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47915', '埔心乡', '3', '47550', 'P', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47916', '溪湖镇', '3', '47550', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47917', '大村乡', '3', '47550', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47918', '埔盐乡', '3', '47550', 'P', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47919', '田中镇', '3', '47550', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47920', '北斗镇', '3', '47550', 'B', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47921', '田尾乡', '3', '47550', 'T', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47922', '埤头乡', '3', '47550', 'P', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47923', '溪州乡', '3', '47550', 'X', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47924', '竹塘乡', '3', '47550', 'Z', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47925', '二林镇', '3', '47550', 'E', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47926', '大城乡', '3', '47550', 'D', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47927', '芳苑乡', '3', '47550', 'F', '1', '100', '0', '1569460605');
INSERT INTO `eju_region_all` VALUES ('47928', '二水乡', '3', '47550', 'E', '1', '100', '0', '1569460605');

-- -----------------------------
-- Table structure for `eju_remark`
-- -----------------------------
DROP TABLE IF EXISTS `eju_remark`;
CREATE TABLE `eju_remark` (
  `remark_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `users_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点评人id',
  `price` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '价格分',
  `place` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '地段分',
  `mating` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '配套分',
  `traffic` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '交通分',
  `science` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '环境分',
  `score` float(4,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '综合评分',
  `content` text COMMENT '点评内容',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`remark_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新房点评表';


-- -----------------------------
-- Table structure for `eju_search_word`
-- -----------------------------
DROP TABLE IF EXISTS `eju_search_word`;
CREATE TABLE `eju_search_word` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) DEFAULT '' COMMENT '关键词',
  `searchNum` int(10) DEFAULT '1' COMMENT '搜索次数',
  `sort_order` int(10) DEFAULT '0' COMMENT '排序号',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `word` (`word`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索词统计表';


-- -----------------------------
-- Table structure for `eju_shopcs_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcs_content`;
CREATE TABLE `eju_shopcs_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` longtext NOT NULL COMMENT '房源介绍',
  `property` int(10) NOT NULL DEFAULT '0' COMMENT '产权年限',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建造年代',
  `supporting` set('电梯','冰箱','洗衣机','热水器','阳台','网络','暖气','停车位','客梯','货梯','扶梯','空调','上水','下水','可明火','排烟','排污','燃气','外摆区') DEFAULT '' COMMENT '商铺配套',
  `property_fee` varchar(200) NOT NULL DEFAULT '' COMMENT '物业费',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  `diy_miankuan` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面宽',
  `diy_cenggao` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '层高',
  `diy_jinshen` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '进深',
  `diy_jyzt` enum('经营中','空置中','') NOT NULL DEFAULT '经营中' COMMENT '经营状态',
  `diy_yqsy` varchar(200) NOT NULL DEFAULT '' COMMENT '预期收益',
  `diy_klrq` varchar(200) NOT NULL DEFAULT '' COMMENT '客流人群',
  `diy_xgfy` varchar(200) NOT NULL DEFAULT '' COMMENT '相关费用',
  `diy_jgmy` varchar(200) NOT NULL DEFAULT '' COMMENT '价格是否可谈',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出售附加表';


-- -----------------------------
-- Table structure for `eju_shopcs_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcs_photo`;
CREATE TABLE `eju_shopcs_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出售相册表';


-- -----------------------------
-- Table structure for `eju_shopcs_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcs_price`;
CREATE TABLE `eju_shopcs_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出售价格表';


-- -----------------------------
-- Table structure for `eju_shopcs_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcs_system`;
CREATE TABLE `eju_shopcs_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `total_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `area` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积',
  `average_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '均价，根据面积何总价自动计算获得',
  `characteristic` set('底层沿街','可分割两层','低价急售','独栋','繁华地段','知名商户入驻') DEFAULT '' COMMENT '特色标签',
  `manage_type` enum('住宅底商','商业街铺面','其他','购物中心百货','写字楼配套底商','临街别墅','') NOT NULL DEFAULT '住宅底商' COMMENT '类型',
  `fitment` enum('毛坯','简装','精装','豪装','') NOT NULL DEFAULT '毛坯' COMMENT '装修情况',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '精度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '号码转码',
  `floo_type` enum('低层','中层','高层','') NOT NULL DEFAULT '低层' COMMENT '楼层',
  `floor_count` int(10) NOT NULL DEFAULT '0' COMMENT '楼层数',
  `industry` set('其他','酒店宾馆','百货超市','生活服务','美容美发','休闲娱乐','服饰鞋包','餐饮美食') DEFAULT '' COMMENT '经营行业',
  `division` enum('不可分割','可分割','') NOT NULL DEFAULT '不可分割' COMMENT '是否可分割',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出售系统表';


-- -----------------------------
-- Table structure for `eju_shopcz_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcz_content`;
CREATE TABLE `eju_shopcz_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` longtext NOT NULL COMMENT '房源介绍',
  `property` int(10) NOT NULL DEFAULT '0' COMMENT '产权年限',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建造年代',
  `supporting` set('电梯','冰箱','洗衣机','热水器','阳台','网络','暖气','停车位','客梯','货梯','扶梯','空调','上水','下水','可明火','排烟','排污','燃气','外摆区') DEFAULT '' COMMENT '配套',
  `property_fee` varchar(200) NOT NULL DEFAULT '' COMMENT '物业费',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  `diy_qzq` enum('三个月','六个月','十二个月','') NOT NULL DEFAULT '三个月' COMMENT '起租期',
  `diy_spxz` enum('商铺新房','二手商铺','') NOT NULL DEFAULT '商铺新房' COMMENT '商铺性质',
  `diy_jyzt` enum('经营中','空置中','') NOT NULL DEFAULT '经营中' COMMENT '经营状态',
  `diy_klrq` enum('办公人群','学生人群','居民人群','旅游人群','其他','') NOT NULL DEFAULT '办公人群' COMMENT '客流人群',
  `diy_miankuan` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面宽',
  `diy_cenggao` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '层高',
  `diy_jinshen` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '进深',
  `diy_xgfy` varchar(200) NOT NULL DEFAULT '' COMMENT '相关费用',
  `diy_jgmy` varchar(200) NOT NULL DEFAULT '' COMMENT '价格是否可谈',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出租附加表';


-- -----------------------------
-- Table structure for `eju_shopcz_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcz_photo`;
CREATE TABLE `eju_shopcz_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出租相册表';


-- -----------------------------
-- Table structure for `eju_shopcz_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcz_price`;
CREATE TABLE `eju_shopcz_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出租价格表';


-- -----------------------------
-- Table structure for `eju_shopcz_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_shopcz_system`;
CREATE TABLE `eju_shopcz_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `total_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '租金',
  `area` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积',
  `average_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '均价，根据面积何总价自动计算获得',
  `characteristic` set('底层沿街','可分割两层','低价急售','独栋','繁华地段','知名商户入驻') DEFAULT '' COMMENT '特色',
  `manage_type` enum('住宅底商','商业街铺面','其他','购物中心百货','写字楼配套底商','临街别墅','') NOT NULL DEFAULT '住宅底商' COMMENT '类型',
  `fitment` enum('毛坯','简装','精装','豪装','') NOT NULL DEFAULT '毛坯' COMMENT '装修',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '精度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '号码转码',
  `floo_type` enum('低层','中层','高层','') NOT NULL DEFAULT '低层' COMMENT '楼层',
  `floor_count` int(10) NOT NULL DEFAULT '0' COMMENT '楼层数',
  `price_units` enum('元/月','元/㎡/月','元/季','元/年','') NOT NULL DEFAULT '元/月' COMMENT '价格单位',
  `pay_way` enum('押一付一','押一付三','') NOT NULL DEFAULT '押一付一' COMMENT '付款方式',
  `division` enum('不可分割','可分割','') NOT NULL DEFAULT '不可分割' COMMENT '是否可分割',
  `industry` set('其他','酒店宾馆','百货超市','生活服务','美容美发','休闲娱乐','服饰鞋包','餐饮美食') DEFAULT '' COMMENT '经营行业',
  `lease_type` enum('否','是','') NOT NULL DEFAULT '否' COMMENT '是否转让',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商铺出租系统表';


-- -----------------------------
-- Table structure for `eju_single_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_single_content`;
CREATE TABLE `eju_single_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `typeid` int(10) DEFAULT '0' COMMENT '栏目ID',
  `content` longtext COMMENT '内容详情',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='单页附加表';

-- -----------------------------
-- Records of `eju_single_content`
-- -----------------------------
INSERT INTO `eju_single_content` VALUES ('1', '59', '8', '', '1570786941', '1570786941');
INSERT INTO `eju_single_content` VALUES ('2', '60', '9', '&lt;p&gt;易居房产系统(ejucms)是一套本地化O2O房产网站平台系统。通过系统用户快速找到自己合适的房源&lt;br style=&quot;color: rgb(68, 68, 68); font-family: &amp;quot;PingFang SC&amp;quot;, &amp;quot;Source Han Sans SC&amp;quot;, &amp;quot;HanHei SC&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, &amp;quot;Hiragino Sans GB&amp;quot;, Arial, sans-serif; text-align: center; text-indent: 24px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;房产代理公司主推自己的独家签售的楼盘，及展示公司合作销售的楼盘，快速获取潜在的意向客户报名，促进成交。&lt;br style=&quot;color: rgb(68, 68, 68); font-family: &amp;quot;PingFang SC&amp;quot;, &amp;quot;Source Han Sans SC&amp;quot;, &amp;quot;HanHei SC&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, &amp;quot;Hiragino Sans GB&amp;quot;, Arial, sans-serif; text-align: center; text-indent: 24px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;产品实现PC,手机数据同步，方便新房代理机构，租房公寓等互联网化扩张发展，帮助客户快速搭建类似于&lt;br style=&quot;color: rgb(68, 68, 68); font-family: &amp;quot;PingFang SC&amp;quot;, &amp;quot;Source Han Sans SC&amp;quot;, &amp;quot;HanHei SC&amp;quot;, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, &amp;quot;Hiragino Sans GB&amp;quot;, Arial, sans-serif; text-align: center; text-indent: 24px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;海南品房阁，楼86，房多多，Q房网， 麦田房产，房天下，海外房产等网站平台。&lt;/p&gt;', '1570786993', '1570786993');

-- -----------------------------
-- Table structure for `eju_sms_log`
-- -----------------------------
DROP TABLE IF EXISTS `eju_sms_log`;
CREATE TABLE `eju_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `session_id` varchar(128) NOT NULL DEFAULT '' COMMENT 'session_id',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '发送时间',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '验证码',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '发送状态,1:成功,0:失败,2:已使用',
  `msg` varchar(255) NOT NULL DEFAULT '' COMMENT '短信内容',
  `scene` int(1) NOT NULL DEFAULT '0' COMMENT '发送场景',
  `error_msg` text NOT NULL COMMENT '发送短信异常内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `eju_sms_template`
-- -----------------------------
DROP TABLE IF EXISTS `eju_sms_template`;
CREATE TABLE `eju_sms_template` (
  `tpl_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tpl_title` varchar(128) NOT NULL DEFAULT '' COMMENT '短信标题',
  `sms_sign` varchar(50) NOT NULL DEFAULT '' COMMENT '短信签名',
  `sms_tpl_code` varchar(100) NOT NULL DEFAULT '' COMMENT '短信模板ID',
  `tpl_content` varchar(1000) NOT NULL DEFAULT '' COMMENT '发送短信内容',
  `send_scene` varchar(100) NOT NULL DEFAULT '' COMMENT '短信发送场景',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`tpl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `eju_sms_template`
-- -----------------------------
INSERT INTO `eju_sms_template` VALUES ('1', '消息通知', '易居CMS', 'SMS_130954860', '您有新的消息：${content}，请注意查收！', '4', '1544763495', '1544763495');
INSERT INTO `eju_sms_template` VALUES ('2', '报名表单', '易居CMS', 'SMS_184115130', '您有来自${form}表单的消息，内容为${content}，来源：${from}。', '1', '1544763495', '1582270283');
INSERT INTO `eju_sms_template` VALUES ('3', '会员注册', '易居CMS', 'SMS_183792679', '您的注册验证码是：${code}，如非本人操作，请忽略本短信！', '2', '1544763495', '1544763495');

-- -----------------------------
-- Table structure for `eju_smtp_record`
-- -----------------------------
DROP TABLE IF EXISTS `eju_smtp_record`;
CREATE TABLE `eju_smtp_record` (
  `record_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `source` tinyint(1) DEFAULT '0' COMMENT '来源，与场景ID对应：0=默认，2=注册，3=绑定邮箱，4=找回密码',
  `email` varchar(50) DEFAULT '' COMMENT '邮件地址',
  `users_id` int(10) DEFAULT '0' COMMENT '用户ID',
  `code` varchar(20) DEFAULT '' COMMENT '发送邮件内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否使用，默认0，0为未使用，1为使用',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮件发送记录表';


-- -----------------------------
-- Table structure for `eju_smtp_tpl`
-- -----------------------------
DROP TABLE IF EXISTS `eju_smtp_tpl`;
CREATE TABLE `eju_smtp_tpl` (
  `tpl_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tpl_name` varchar(200) DEFAULT '' COMMENT '模板名称',
  `tpl_title` varchar(200) DEFAULT '' COMMENT '邮件标题',
  `tpl_content` text COMMENT '发送邮件内容',
  `send_scene` tinyint(1) DEFAULT '0' COMMENT '邮件发送场景(1=留言表单）',
  `is_open` tinyint(1) DEFAULT '0' COMMENT '是否开启使用这个模板，1为是，0为否。',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`tpl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='邮件模板表';

-- -----------------------------
-- Records of `eju_smtp_tpl`
-- -----------------------------
INSERT INTO `eju_smtp_tpl` VALUES ('1', '报名表单', '您有新的表单消息，请查收！', '${content}', '1', '1', '1544763495', '1552638302');
INSERT INTO `eju_smtp_tpl` VALUES ('2', '会员注册', '验证码已发送至您的邮箱，请登录邮箱查看验证码！', '${content}', '2', '1', '1544763495', '1544763495');
INSERT INTO `eju_smtp_tpl` VALUES ('3', '绑定邮箱', '验证码已发送至您的邮箱，请登录邮箱查看验证码！', '${content}', '3', '1', '1544763495', '1544763495');
INSERT INTO `eju_smtp_tpl` VALUES ('4', '找回密码', '验证码已发送至您的邮箱，请登录邮箱查看验证码！', '${content}', '4', '1', '1544763495', '1544763495');

-- -----------------------------
-- Table structure for `eju_tagindex`
-- -----------------------------
DROP TABLE IF EXISTS `eju_tagindex`;
CREATE TABLE `eju_tagindex` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'tagid',
  `tag` varchar(50) NOT NULL DEFAULT '' COMMENT 'tag内容',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `count` int(10) unsigned DEFAULT '0' COMMENT '点击',
  `total` int(10) unsigned DEFAULT '0' COMMENT '文档数',
  `weekcc` int(10) unsigned DEFAULT '0' COMMENT '周统计',
  `monthcc` int(10) unsigned DEFAULT '0' COMMENT '月统计',
  `weekup` int(10) unsigned DEFAULT '0' COMMENT '每周更新',
  `monthup` int(10) unsigned DEFAULT '0' COMMENT '每月更新',
  `add_time` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`) USING BTREE,
  KEY `count` (`count`,`total`,`weekcc`,`monthcc`,`weekup`,`monthup`,`add_time`) USING BTREE,
  KEY `tag` (`tag`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签索引表';


-- -----------------------------
-- Table structure for `eju_taglist`
-- -----------------------------
DROP TABLE IF EXISTS `eju_taglist`;
CREATE TABLE `eju_taglist` (
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'tagid',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `tag` varchar(50) DEFAULT '' COMMENT 'tag内容',
  `arcrank` tinyint(1) DEFAULT '0' COMMENT '阅读权限',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`tid`,`aid`),
  KEY `aid` (`aid`,`typeid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章标签表';


-- -----------------------------
-- Table structure for `eju_tuan_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_tuan_content`;
CREATE TABLE `eju_tuan_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '资讯id',
  `aid` int(11) NOT NULL,
  `content` longtext NOT NULL COMMENT '团购详情',
  `description` text NOT NULL COMMENT '团购优惠',
  `begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '活动开始时间',
  `end_time` int(11) NOT NULL COMMENT '活动结束时间',
  `apply_num` int(10) NOT NULL DEFAULT '0' COMMENT '报名人数',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '团购价格',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='楼市资讯表';

-- -----------------------------
-- Records of `eju_tuan_content`
-- -----------------------------
INSERT INTO `eju_tuan_content` VALUES ('1', '29', '&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;报名团购享优惠：&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;2.免费接机，免费看房，置业顾问全程陪同。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;3.购房成功可报销机票。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;4.参加团购可获更多优惠、特价房源等信息。&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;融创观澜湖公园壹号（相册&amp;nbsp;动态&amp;nbsp;户型）为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套。&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;项目位于观澜湖度假区，利用项目本身的天时地利，规划沿高尔夫景观顺势布局开发，形似一条“卧龙”，万亩果岭景观尽收眼底。项目总占地217亩，总建筑面积33.3万方，容积率2.3，片区绿化率80%，预计开发周期五年。一区规划设计为1栋临时接待中心、14栋高层板式住宅、40栋高端别墅，总户数2320户，停车位1010个。一期首推7、9#楼，共360套精装住宅和15栋别墅。&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;项目现代简约的设计风格与时尚元素搭配，高层建筑立面造型以舒展、柔软线条营造休闲、度假、活泼的氛围，外立面灰白色涂料搭配，展现轻快的简约基调，将建筑与大自然有机结合，体验在度假中生活，在生活中度假。以板楼为主的建筑形态，一字型排布，纯南北向通风采光，保障了项目所有产品的度假享受。&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px; outline: none; font-family: &amp;quot;Microsoft YaHei&amp;quot;, Helvetica, arial, sans-serif; color: rgb(51, 51, 51); font-size: 14px; white-space: normal;&quot;&gt;观澜湖国际旅游度假区，城市资源与自然资源的黄金交织点，醇熟生活大城。拥有10个18洞的高尔夫球场、与巴塞罗那俱乐部合作的20余块专业足球训练场、超20000㎡火山岩五大洲主题温泉SPA、澳洲狂野水世界乐园、冯小刚电影公社、兰桂坊酒吧街、星美国际影城、风情美食街、奥特莱斯、24万㎡商业广场及5万㎡海南免税购物中心等，满足吃、住、行、游、购、娱一站式度假生活体验。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。\n2.免费接机，免费看房，置业顾问全程陪同。\n3.购房成功可报销机票。\n4.参加团购可获更多优惠、特价房源等信息。', '1570723200', '1575993600', '3', '1570780113', '1570780113', '15000.00');
INSERT INTO `eju_tuan_content` VALUES ('2', '56', '&lt;p&gt;报名团购享优惠：&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;2.免费接机，免费看房，置业顾问全程陪同。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;3.购房成功可报销机票。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;4.参加团购可获更多优惠、特价房源等信息。&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '报名团购享优惠：\n1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。\n2.免费接机，免费看房，置业顾问全程陪同。\n3.购房成功可报销机票。\n4.参加团购可获更多优惠、特价房源等信息。', '1568131200', '1578672000', '4', '1570785642', '1570785642', '16300.00');
INSERT INTO `eju_tuan_content` VALUES ('3', '57', '&lt;p&gt;报名团购享优惠：&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;2.免费接机，免费看房，置业顾问全程陪同。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;3.购房成功可报销机票。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;4.参加团购可获更多优惠、特价房源等信息。&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '报名团购享优惠：\n1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。\n2.免费接机，免费看房，置业顾问全程陪同。\n3.购房成功可报销机票。\n4.参加团购可获更多优惠、特价房源等信息。', '1565452800', '1602345600', '6', '1570785720', '1570785720', '17100.00');
INSERT INTO `eju_tuan_content` VALUES ('4', '58', '&lt;p&gt;报名团购享优惠：&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;2.免费接机，免费看房，置业顾问全程陪同。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;3.购房成功可报销机票。&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;4.参加团购可获更多优惠、特价房源等信息。&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;融创观澜湖公园壹号（相册&amp;nbsp;动态&amp;nbsp;户型）为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套。&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;项目位于观澜湖度假区，利用项目本身的天时地利，规划沿高尔夫景观顺势布局开发，形似一条“卧龙”，万亩果岭景观尽收眼底。项目总占地217亩，总建筑面积33.3万方，容积率2.3，片区绿化率80%，预计开发周期五年。一区规划设计为1栋临时接待中心、14栋高层板式住宅、40栋高端别墅，总户数2320户，停车位1010个。一期首推7、9#楼，共360套精装住宅和15栋别墅。&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;项目现代简约的设计风格与时尚元素搭配，高层建筑立面造型以舒展、柔软线条营造休闲、度假、活泼的氛围，外立面灰白色涂料搭配，展现轻快的简约基调，将建筑与大自然有机结合，体验在度假中生活，在生活中度假。以板楼为主的建筑形态，一字型排布，纯南北向通风采光，保障了项目所有产品的度假享受。&lt;/p&gt;&lt;p&gt;&lt;br style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p&gt;观澜湖国际旅游度假区，城市资源与自然资源的黄金交织点，醇熟生活大城。拥有10个18洞的高尔夫球场、与巴塞罗那俱乐部合作的20余块专业足球训练场、超20000㎡火山岩五大洲主题温泉SPA、澳洲狂野水世界乐园、冯小刚电影公社、兰桂坊酒吧街、星美国际影城、风情美食街、奥特莱斯、24万㎡商业广场及5万㎡海南免税购物中心等，满足吃、住、行、游、购、娱一站式度假生活体验。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '报名团购享优惠：\n1.报名参团享独家优惠折扣，还有我们最贴心优质的服务。\n2.免费接机，免费看房，置业顾问全程陪同。\n3.购房成功可报销机票。\n4.参加团购可获更多优惠、特价房源等信息。', '1569945600', '1575216000', '8', '1586765728', '1586765728', '111.00');

-- -----------------------------
-- Table structure for `eju_users`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users`;
CREATE TABLE `eju_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '经纪人级别（1为会员）',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `true_name` varchar(20) DEFAULT '' COMMENT '真实姓名',
  `is_mobile` tinyint(1) DEFAULT '0' COMMENT '绑定手机号，0为不绑定，1为绑定',
  `mobile` varchar(11) DEFAULT '' COMMENT '手机号码',
  `is_email` tinyint(1) DEFAULT '0' COMMENT '绑定邮箱，0为不绑定，1为绑定',
  `email` varchar(60) DEFAULT '' COMMENT 'email',
  `qq` varchar(13) NOT NULL DEFAULT '' COMMENT 'qq号码',
  `party` varchar(255) DEFAULT '' COMMENT '第三方商桥',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `litpic` varchar(255) DEFAULT '' COMMENT '头像',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(0=屏蔽，1=正常)',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `reg_time` int(11) unsigned DEFAULT '0' COMMENT '注册时间',
  `register_place` tinyint(1) DEFAULT '2' COMMENT '注册位置。后台注册不受注册验证影响，1为后台注册，2为前台注册。默认为2。',
  `open_id` varchar(30) NOT NULL DEFAULT '' COMMENT '微信唯一标识openid',
  `admin_id` int(10) DEFAULT '0' COMMENT '关联管理员ID',
  `is_activation` tinyint(1) DEFAULT '1' COMMENT '是否激活，0否，1是。\r\n后台注册默认为1激活。\r\n前台注册时，当会员功能设置选择后台审核，需后台激活才可以登陆。',
  `is_lock` tinyint(1) DEFAULT '0' COMMENT '是否被锁定冻结',
  `is_saleman` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为商家内部经纪人',
  `consult` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '咨询人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- -----------------------------
-- Records of `eju_users`
-- -----------------------------
INSERT INTO `eju_users` VALUES ('1', '1', '张生', '张生', '张生', '0', '13800001111', '0', 'admin@email.com', '', '', '5c553ce162cd9a4f45e76c11ca4bafcf', '/uploads/allimg/20191011/1-191011103FH63.jpg', '1', '1582104547', '1586762660', '0', '1582104547', '1', '', '0', '1', '0', '1', '0');
INSERT INTO `eju_users` VALUES ('3', '3', 'xuyuzi', 'xuyuzi', '程序猿', '0', '18789221089', '0', '287735759@qq.com', '287735759', '', 'a4415f3166861e1a7fcd59adfd1459fe', '/uploads/allimg/20191011/1-191011103FH63.jpg', '1', '1586915463', '1586915526', '0', '0', '2', '', '0', '1', '0', '1', '0');

-- -----------------------------
-- Table structure for `eju_users_collect`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users_collect`;
CREATE TABLE `eju_users_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文档id',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`) USING BTREE,
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员收藏表';


-- -----------------------------
-- Table structure for `eju_users_config`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users_config`;
CREATE TABLE `eju_users_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员功能配置表ID',
  `name` varchar(50) DEFAULT '' COMMENT '配置的key键名',
  `value` text COMMENT '配置的value值',
  `desc` varchar(100) DEFAULT '' COMMENT '键名说明',
  `inc_type` varchar(64) DEFAULT '' COMMENT '配置分组',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='会员配置表';

-- -----------------------------
-- Records of `eju_users_config`
-- -----------------------------
INSERT INTO `eju_users_config` VALUES ('1', 'users_reg_notallow', 'www,bbs,ftp,mail,user,users,admin,administrator,eyoucms', '不允许注册的会员名', 'users', '1547890773');
INSERT INTO `eju_users_config` VALUES ('2', 'users_verification', '0', '验证方式', 'users', '1573545028');
INSERT INTO `eju_users_config` VALUES ('3', 'users_open_register', '1', '开放注册', 'users', '1577262944');
INSERT INTO `eju_users_config` VALUES ('4', 'users_label_value', '高效,专业', '', 'users', '1586915519');

-- -----------------------------
-- Table structure for `eju_users_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users_content`;
CREATE TABLE `eju_users_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(0=屏蔽，1=正常)',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_login` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` varchar(15) DEFAULT '' COMMENT '最后登录ip',
  `login_count` int(11) unsigned DEFAULT '0' COMMENT '登录次数',
  `day_send` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当天共发布条数',
  `day_top` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当天总共置顶条数',
  `all_send` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '共发布条数',
  `all_top` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '全部置顶数',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `last_time` int(11) unsigned DEFAULT '0' COMMENT '最后添加数据时间',
  `deal` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '历史成交',
  `look` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近30天带看',
  `service_area` varchar(200) NOT NULL DEFAULT '' COMMENT '服务区域（区域id集合）',
  `service_xiaoqu` varchar(200) NOT NULL DEFAULT '' COMMENT '主营小区',
  `users_label` varchar(200) NOT NULL DEFAULT '' COMMENT '标签',
  `company` varchar(200) NOT NULL DEFAULT '' COMMENT '所属公司',
  `content` text COMMENT '介绍',
  `license_img` varchar(100) NOT NULL DEFAULT '' COMMENT '营业执照图片',
  `license` varchar(100) NOT NULL DEFAULT '' COMMENT '营业执照编码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id` (`users_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员信息表';

-- -----------------------------
-- Records of `eju_users_content`
-- -----------------------------
INSERT INTO `eju_users_content` VALUES ('1', '1', '1', '0', '1586762668', '127.0.0.1', '2', '1', '0', '1', '0', '1582104547', '1586764459', '1586764459', '0', '0', '', '', '', '', '', '', '');
INSERT INTO `eju_users_content` VALUES ('3', '3', '1', '0', '1586916331', '127.0.0.1', '1', '2', '0', '2', '0', '1586915463', '1586916640', '1586916640', '0', '0', '', '', '高效,专业', '', '', '', '');

-- -----------------------------
-- Table structure for `eju_users_count`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users_count`;
CREATE TABLE `eju_users_count` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶，5：商铺出售发布，6：商铺出售置顶，7：商铺出租发布，8：商铺出租置顶，9：写字楼出售发布，10：写字楼出售置顶，11：写字楼出租发布，12：写字楼出租置顶）',
  `style` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '时间，1：当天，2：一共',
  `num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='会员统计表';

-- -----------------------------
-- Records of `eju_users_count`
-- -----------------------------
INSERT INTO `eju_users_count` VALUES ('1', '1', '1', '1', '1', '1586764458', '1586764458');
INSERT INTO `eju_users_count` VALUES ('2', '1', '1', '2', '1', '1586764458', '1586764458');
INSERT INTO `eju_users_count` VALUES ('3', '3', '1', '1', '1', '1586916619', '1586916619');
INSERT INTO `eju_users_count` VALUES ('4', '3', '1', '2', '1', '1586916619', '1586916619');
INSERT INTO `eju_users_count` VALUES ('5', '3', '3', '1', '1', '1586916640', '1586916640');
INSERT INTO `eju_users_count` VALUES ('6', '3', '3', '2', '1', '1586916640', '1586916640');

-- -----------------------------
-- Table structure for `eju_users_level`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users_level`;
CREATE TABLE `eju_users_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `free_day_send` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '每天免费发布',
  `free_all_send` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '共免费发布',
  `fee_day_top` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '每天免费置顶',
  `fee_all_top` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '共免费置顶',
  `check_ershou` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '二手房是否需要审核',
  `check_zufang` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '租房是否需要审核',
  `check_shopcs` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '商铺出售是否需要审核',
  `check_shopcz` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '商铺出租是否需要审核',
  `check_officecs` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '写字楼出售是否需要审核',
  `check_officecz` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '写字楼出租是否需要审核',
  `check_qiuzu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '求租是否需要审核',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1：启用，0：关闭）',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会员为系统内置，不允许删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员级别表';

-- -----------------------------
-- Records of `eju_users_level`
-- -----------------------------
INSERT INTO `eju_users_level` VALUES ('1', '注册会员', '5', '50', '5', '50', '1', '1', '1', '1', '1', '1', '1', '1', '1572511812', '1573438344', '0', '1');
INSERT INTO `eju_users_level` VALUES ('2', '中级会员', '5', '0', '5', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1572512423', '1573035421', '0', '1');
INSERT INTO `eju_users_level` VALUES ('3', '高级会员', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1573442442', '1573442442', '0', '0');

-- -----------------------------
-- Table structure for `eju_users_log`
-- -----------------------------
DROP TABLE IF EXISTS `eju_users_log`;
CREATE TABLE `eju_users_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `aid` varchar(100) NOT NULL DEFAULT '' COMMENT '文档id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型（1：二手发布，2：二手置顶，3：租房发布，4：租房置顶，5：商铺出售发布，6：商铺出售置顶，7：商铺出租发布，8：商铺出租置顶，9：写字楼出售发布，10：写字楼出售置顶，11：写字楼出租发布，12：写字楼出租置顶）',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `num` int(6) unsigned NOT NULL DEFAULT '1' COMMENT '变动条数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员日志表';

-- -----------------------------
-- Records of `eju_users_log`
-- -----------------------------
INSERT INTO `eju_users_log` VALUES ('1', '1', '79', '1', '0', '1586764458', '1586764458', '1');
INSERT INTO `eju_users_log` VALUES ('2', '3', '83', '1', '0', '1586916619', '1586916619', '1');
INSERT INTO `eju_users_log` VALUES ('3', '3', '84', '3', '0', '1586916640', '1586916640', '1');

-- -----------------------------
-- Table structure for `eju_weapp`
-- -----------------------------
DROP TABLE IF EXISTS `eju_weapp`;
CREATE TABLE `eju_weapp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT '' COMMENT '插件标识',
  `name` varchar(55) DEFAULT '' COMMENT '中文名字',
  `config` text COMMENT '配置信息',
  `data` text COMMENT '额外序列化存储数据，简单插件可以不创建表，存储这里即可',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：0=未安装，1=启用，-1=禁用',
  `tag_weapp` tinyint(1) DEFAULT '1' COMMENT '1=自动绑定，2=手工调用。关联模板标签weapp，自动调用内置的show钩子方法',
  `thorough` tinyint(1) DEFAULT '0' COMMENT '彻底卸载：0=是，1=否',
  `position` varchar(30) DEFAULT 'default' COMMENT '插件位置',
  `sort_order` int(10) DEFAULT '100' COMMENT '排序号',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `code` (`code`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='插件应用表';


-- -----------------------------
-- Table structure for `eju_xiaoqu_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xiaoqu_content`;
CREATE TABLE `eju_xiaoqu_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `floor_area` varchar(200) NOT NULL DEFAULT '' COMMENT '占地面积',
  `building_area` varchar(200) NOT NULL DEFAULT '' COMMENT '建筑面积',
  `plot_ratio` varchar(200) NOT NULL DEFAULT '' COMMENT '容积率',
  `greening_rate` varchar(200) NOT NULL DEFAULT '' COMMENT '绿化率',
  `property` varchar(200) NOT NULL DEFAULT '' COMMENT '产权',
  `households` varchar(200) NOT NULL DEFAULT '' COMMENT '户数',
  `carport` varchar(200) NOT NULL DEFAULT '' COMMENT '车位数',
  `floor_case` varchar(200) NOT NULL DEFAULT '' COMMENT '楼层情况',
  `building_num` varchar(200) NOT NULL DEFAULT '' COMMENT '楼栋数量',
  `manage_company` varchar(200) NOT NULL DEFAULT '' COMMENT '物业公司',
  `property_fee` varchar(200) NOT NULL DEFAULT '' COMMENT '物业费',
  `developer` varchar(200) NOT NULL DEFAULT '' COMMENT '开发商',
  `location_introduce` varchar(200) NOT NULL DEFAULT '' COMMENT '区位介绍',
  `content` longtext COMMENT '小区介绍',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='小区附加表';

-- -----------------------------
-- Records of `eju_xiaoqu_content`
-- -----------------------------
INSERT INTO `eju_xiaoqu_content` VALUES ('1', '61', '12476', '33135', '2.20', '40%', '70', '290户', '228个', '暂无', '3栋', '海南现代物业管理有限公司', '2.40元/㎡·月', '海南招鑫房地产投资有限公司', '招鑫公馆向北临近海甸五东路，交通方便，有18、25、44路等多条公交路线到招鑫公馆下。', '&lt;p&gt;招鑫公馆项目位于海口市海甸岛东片开发区内，东临碧海大道，南临吉安花园小区，西临祥安小区，北邻天恒燕泰住宅楼及燕泰***际大酒店。项目用地总面积为12476.32㎡(建面)，建筑总面积33135.83㎡(建面)。项目主力户型为80.1-89.31㎡(建面)的2房，103.15-119.35㎡(建面)3房，户型优越。 项目周边片区居住氛围纯熟，超市、学校、银行、医院等生活配套设施**&lt;/p&gt;', '1572578194', '1572578194', '');
INSERT INTO `eju_xiaoqu_content` VALUES ('2', '62', '48072', '133585', '2.0', '40%', '70', '1122户', '890个', '暂无', '1栋', '海南现代物业管理有限公司', '2.40元/㎡·月', '海口市城市建设投资有限公司', '35、37、40、41、57、旅游B线等公交车经过', '&lt;p&gt;长信·蓝郡位于海口市西海岸长秀片区，该项目占地约14万㎡(建面)，总建筑面积约50万㎡(建面)，项目分为西区与东区。小区交通便利，地理位置优越，环境甚佳，是理想的居住小区用地。本项目周边教育配套设施***，拥揽岛内一线教育资源（海口市教育幼儿园、海口第九小学、海南华侨中学），***良好的教育设施，优质的教学设备，对本区少儿及青少年健康成长的保证。纯净的滨海城市居住区域，高素质人群&lt;/p&gt;', '1572598720', '1572598720', '');
INSERT INTO `eju_xiaoqu_content` VALUES ('3', '63', '12000', '22000', '1.60', '40%', '70', '149户', '98个', '暂无', '4栋', '海南现代物业管理有限公司', '2.20元/㎡·月', '海南和德投资有限公司', '3、7、18、28、41、A、B线等公车', '&lt;p&gt;水岸珈蓝一梯两户，南北通透，三栋12层纯板楼。入户花园，飘窗，景观阳台，***层架空，院内生活共享！&amp;nbsp;&lt;/p&gt;', '1572578165', '1572578165', '');
INSERT INTO `eju_xiaoqu_content` VALUES ('4', '64', '15128', '62441', '2.20', '40%', '70', '474户', '270个', '暂无', '3栋', '海南一诺', '1.80元/㎡·月', '海南一诺房地产开发有限公司', '3路、7路、9路、28路、34路、37路、39路等等公车均可到达，交通便捷。', '&lt;p&gt;洛杉矶城位于新城市主轴滨海大道旁，毗邻海口新港码头，有***际一流的滨海景观及发达的道路交通系统，距美兰机场30车程，火车站15车程。总用地面积：15128.07平方米，建筑占地面积3452.5平方米，总建筑面积（地上）6244平方米，商铺建筑面积9866平方米，住宅建筑面积52574.4平米(建面)。容积率4.13，绿化率35%。主推三房与两房的户型。海口新外滩，一个集城市功能&lt;/p&gt;', '1572578217', '1572578217', '');
INSERT INTO `eju_xiaoqu_content` VALUES ('5', '65', '57100', '68722', '1.20', '50%', '70', '838户', '412个', '暂无', '8栋', '海南现代物业管理有限公司', '1.60元/平米·月', '海南云通房地产开发有限公司', '小区四面环路，分别为丽晶路、杜鹃路、滨海大道…… •； 37路（空调大巴）：绿色佳园——火车站 •； 28路（空调大巴）：美舍河——热带海洋世界公园 •； 39路：经济学院——西站 •； 201路：新埠桥——秀英 •； 7路：教育学院——农垦 小区至国贸商圈车行3分钟，至老城区商圈车行10分钟，至美兰机场车行25分钟，至海口火车站车车行30分钟。', '&lt;p&gt;金外滩，位于海口市丽晶路20号，东临杜鹃路，南靠滨海大道，西为丽晶路(景观大道)，北临琼洲海峡。&lt;/p&gt;&lt;p&gt;金外滩由海南云通房地产开发有限公司开发建设，与广阔碧蓝的大海仅数步之遥。建筑设计特邀国际著名建筑设计单位NSIAP新建设计国际有限公司(新加坡)担纲设计，园林景观由国际知名景观设计大师Mark S.Mahan规划设计，强强联手，共同缔造海口湾一线海&lt;/p&gt;', '1572578143', '1572578143', '');
INSERT INTO `eju_xiaoqu_content` VALUES ('6', '66', '23332', '60000', '2.40', '58.70%', '70', '352户', '300多个', '暂无', '', '海南现代物业管理有限公司', '1.45元/平米·月', '海口港集团和海南铭泰物业管理有限公司', '37、28、17、7、39、旅游A线、B线. 37路起始站绿色佳园至火车站,28路美舍河至秀英, 39路经济学院至西站,旅游A线府城大园至秀英海瑞,B线是亚洲豪苑至火车站.', '&lt;div&gt;泉海好家园项目位于海口湾滨海沿线中央地带，丽晶路与港爱路交汇处——北眺琼洲海峡，东邻万绿园，南靠国贸CBD中心区，西临西秀海滩，都市繁华与滨海风情无缝连接，是海口中轴线板块与西海岸板块的黄金交汇点。这里不仅有1400亩城市绿肺万绿园及海口湾休闲滨海长廊，更享市中心齐全繁华的配套资源。&lt;/div&gt;&lt;div&gt;根据片区控制性规划，项目所属的海口湾秀英港片区，&lt;/div&gt;', '1572578132', '1572578132', '');

-- -----------------------------
-- Table structure for `eju_xiaoqu_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xiaoqu_photo`;
CREATE TABLE `eju_xiaoqu_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COMMENT='小区相册表';

-- -----------------------------
-- Records of `eju_xiaoqu_photo`
-- -----------------------------
INSERT INTO `eju_xiaoqu_photo` VALUES ('1', '61', '', '/uploads/allimg/20191029/1-1910291P1121K.jpg', '样板间', '1', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('2', '61', '', '/uploads/allimg/20191029/1-1910291P112W6.jpg', '样板间', '2', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('3', '61', '', '/uploads/allimg/20191029/1-1910291P112251.jpg', '样板间', '3', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('4', '61', '', '/uploads/allimg/20191029/1-1910291P1121B.jpg', '样板间', '4', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('5', '61', '', '/uploads/allimg/20191029/1-1910291P112M2.jpg', '样板间', '5', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('6', '61', '', '/uploads/allimg/20191029/1-1910291P112H7.jpg', '样板间', '6', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('7', '61', '', '/uploads/allimg/20191029/1-1910291P044632.jpg', '实景图', '7', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('8', '61', '', '/uploads/allimg/20191029/1-1910291P044301.jpg', '实景图', '8', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('9', '61', '', '/uploads/allimg/20191029/1-1910291P044611.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('10', '61', '', '/uploads/allimg/20191029/1-1910291P044200.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('11', '61', '', '/uploads/allimg/20191029/1-1910291P0442Y.jpg', '实景图', '11', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('12', '61', '', '/uploads/allimg/20191029/1-1910291P0444M.jpg', '实景图', '12', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('13', '61', '', '/uploads/allimg/20191029/1-1910291P02E18.jpg', '交通图', '13', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('14', '61', '', '/uploads/allimg/20191029/1-1910291P015a9.jpg', '效果图', '14', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('15', '61', '', '/uploads/allimg/20191029/1-1910291P015226.jpg', '效果图', '15', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('16', '61', '', '/uploads/allimg/20191029/1-1910291P014153.jpg', '效果图', '16', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('17', '62', '', '/uploads/allimg/20191029/1-1910291P1121K.jpg', '样板间', '1', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('18', '62', '', '/uploads/allimg/20191029/1-1910291P112W6.jpg', '样板间', '2', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('19', '62', '', '/uploads/allimg/20191029/1-1910291P112251.jpg', '样板间', '3', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('20', '62', '', '/uploads/allimg/20191029/1-1910291P1121B.jpg', '样板间', '4', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('21', '62', '', '/uploads/allimg/20191029/1-1910291P112M2.jpg', '样板间', '5', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('22', '62', '', '/uploads/allimg/20191029/1-1910291P112H7.jpg', '样板间', '6', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('23', '62', '', '/uploads/allimg/20191029/1-1910291P044632.jpg', '实景图', '7', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('24', '62', '', '/uploads/allimg/20191029/1-1910291P044301.jpg', '实景图', '8', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('25', '62', '', '/uploads/allimg/20191029/1-1910291P044611.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('26', '62', '', '/uploads/allimg/20191029/1-1910291P044200.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('27', '62', '', '/uploads/allimg/20191029/1-1910291P0442Y.jpg', '实景图', '11', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('28', '62', '', '/uploads/allimg/20191029/1-1910291P0444M.jpg', '实景图', '12', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('29', '62', '', '/uploads/allimg/20191029/1-1910291P02E18.jpg', '交通图', '13', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('30', '62', '', '/uploads/allimg/20191029/1-1910291P015a9.jpg', '效果图', '14', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('31', '62', '', '/uploads/allimg/20191029/1-1910291P015226.jpg', '效果图', '15', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('32', '62', '', '/uploads/allimg/20191029/1-1910291P014153.jpg', '效果图', '16', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('33', '63', '', '/uploads/allimg/20191029/1-1910291P1121K.jpg', '样板间', '1', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('34', '63', '', '/uploads/allimg/20191029/1-1910291P112W6.jpg', '样板间', '2', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('35', '63', '', '/uploads/allimg/20191029/1-1910291P112251.jpg', '样板间', '3', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('36', '63', '', '/uploads/allimg/20191029/1-1910291P1121B.jpg', '样板间', '4', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('37', '63', '', '/uploads/allimg/20191029/1-1910291P112M2.jpg', '样板间', '5', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('38', '63', '', '/uploads/allimg/20191029/1-1910291P112H7.jpg', '样板间', '6', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('39', '63', '', '/uploads/allimg/20191029/1-1910291P044632.jpg', '实景图', '7', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('40', '63', '', '/uploads/allimg/20191029/1-1910291P044301.jpg', '实景图', '8', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('41', '63', '', '/uploads/allimg/20191029/1-1910291P044611.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('42', '63', '', '/uploads/allimg/20191029/1-1910291P044200.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('43', '63', '', '/uploads/allimg/20191029/1-1910291P0442Y.jpg', '实景图', '11', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('44', '63', '', '/uploads/allimg/20191029/1-1910291P0444M.jpg', '实景图', '12', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('45', '63', '', '/uploads/allimg/20191029/1-1910291P02E18.jpg', '交通图', '13', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('46', '63', '', '/uploads/allimg/20191029/1-1910291P015a9.jpg', '效果图', '14', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('47', '63', '', '/uploads/allimg/20191029/1-1910291P015226.jpg', '效果图', '15', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('48', '63', '', '/uploads/allimg/20191029/1-1910291P014153.jpg', '效果图', '16', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('49', '64', '', '/uploads/allimg/20191029/1-1910291P1121K.jpg', '样板间', '1', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('50', '64', '', '/uploads/allimg/20191029/1-1910291P112W6.jpg', '样板间', '2', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('51', '64', '', '/uploads/allimg/20191029/1-1910291P112251.jpg', '样板间', '3', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('52', '64', '', '/uploads/allimg/20191029/1-1910291P1121B.jpg', '样板间', '4', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('53', '64', '', '/uploads/allimg/20191029/1-1910291P112M2.jpg', '样板间', '5', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('54', '64', '', '/uploads/allimg/20191029/1-1910291P112H7.jpg', '样板间', '6', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('55', '64', '', '/uploads/allimg/20191029/1-1910291P044632.jpg', '实景图', '7', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('56', '64', '', '/uploads/allimg/20191029/1-1910291P044301.jpg', '实景图', '8', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('57', '64', '', '/uploads/allimg/20191029/1-1910291P044611.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('58', '64', '', '/uploads/allimg/20191029/1-1910291P044200.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('59', '64', '', '/uploads/allimg/20191029/1-1910291P0442Y.jpg', '实景图', '11', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('60', '64', '', '/uploads/allimg/20191029/1-1910291P0444M.jpg', '实景图', '12', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('61', '64', '', '/uploads/allimg/20191029/1-1910291P02E18.jpg', '交通图', '13', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('62', '64', '', '/uploads/allimg/20191029/1-1910291P015a9.jpg', '效果图', '14', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('63', '64', '', '/uploads/allimg/20191029/1-1910291P015226.jpg', '效果图', '15', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('64', '64', '', '/uploads/allimg/20191029/1-1910291P014153.jpg', '效果图', '16', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('65', '65', '', '/uploads/allimg/20191029/1-1910291P1121K.jpg', '样板间', '1', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('66', '65', '', '/uploads/allimg/20191029/1-1910291P112W6.jpg', '样板间', '2', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('67', '65', '', '/uploads/allimg/20191029/1-1910291P112251.jpg', '样板间', '3', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('68', '65', '', '/uploads/allimg/20191029/1-1910291P1121B.jpg', '样板间', '4', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('69', '65', '', '/uploads/allimg/20191029/1-1910291P112M2.jpg', '样板间', '5', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('70', '65', '', '/uploads/allimg/20191029/1-1910291P112H7.jpg', '样板间', '6', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('71', '65', '', '/uploads/allimg/20191029/1-1910291P044632.jpg', '实景图', '7', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('72', '65', '', '/uploads/allimg/20191029/1-1910291P044301.jpg', '实景图', '8', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('73', '65', '', '/uploads/allimg/20191029/1-1910291P044611.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('74', '65', '', '/uploads/allimg/20191029/1-1910291P044200.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('75', '65', '', '/uploads/allimg/20191029/1-1910291P0442Y.jpg', '实景图', '11', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('76', '65', '', '/uploads/allimg/20191029/1-1910291P0444M.jpg', '实景图', '12', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('77', '65', '', '/uploads/allimg/20191029/1-1910291P02E18.jpg', '交通图', '13', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('78', '65', '', '/uploads/allimg/20191029/1-1910291P015a9.jpg', '效果图', '14', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('79', '65', '', '/uploads/allimg/20191029/1-1910291P015226.jpg', '效果图', '15', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('80', '65', '', '/uploads/allimg/20191029/1-1910291P014153.jpg', '效果图', '16', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('81', '66', '', '/uploads/allimg/20191029/1-1910291P1121K.jpg', '样板间', '1', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('82', '66', '', '/uploads/allimg/20191029/1-1910291P112W6.jpg', '样板间', '2', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('83', '66', '', '/uploads/allimg/20191029/1-1910291P112251.jpg', '样板间', '3', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('84', '66', '', '/uploads/allimg/20191029/1-1910291P1121B.jpg', '样板间', '4', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('85', '66', '', '/uploads/allimg/20191029/1-1910291P112M2.jpg', '样板间', '5', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('86', '66', '', '/uploads/allimg/20191029/1-1910291P112H7.jpg', '样板间', '6', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('87', '66', '', '/uploads/allimg/20191029/1-1910291P044632.jpg', '实景图', '7', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('88', '66', '', '/uploads/allimg/20191029/1-1910291P044301.jpg', '实景图', '8', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('89', '66', '', '/uploads/allimg/20191029/1-1910291P044611.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('90', '66', '', '/uploads/allimg/20191029/1-1910291P044200.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('91', '66', '', '/uploads/allimg/20191029/1-1910291P0442Y.jpg', '实景图', '11', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('92', '66', '', '/uploads/allimg/20191029/1-1910291P0444M.jpg', '实景图', '12', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('93', '66', '', '/uploads/allimg/20191029/1-1910291P02E18.jpg', '交通图', '13', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('94', '66', '', '/uploads/allimg/20191029/1-1910291P015a9.jpg', '效果图', '14', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('95', '66', '', '/uploads/allimg/20191029/1-1910291P015226.jpg', '效果图', '15', '0', '0', '0');
INSERT INTO `eju_xiaoqu_photo` VALUES ('96', '66', '', '/uploads/allimg/20191029/1-1910291P014153.jpg', '效果图', '16', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_xiaoqu_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xiaoqu_system`;
CREATE TABLE `eju_xiaoqu_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `average_price` int(10) NOT NULL DEFAULT '0' COMMENT '均价',
  `characteristic` set('小户型','低密居住','旅游地产','教育地产','宜居生态','公园地产','海景楼盘','养生社区') DEFAULT '' COMMENT '特色',
  `manage_type` set('住宅','商铺','写字楼','公寓','别墅','其他') DEFAULT '' COMMENT '物业类型',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '售房电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '转码号码',
  `price_units` enum('元/㎡','元/套','') NOT NULL DEFAULT '元/㎡' COMMENT '价格单位',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建筑年代',
  `building_type` set('低层','高层','多层','复式') DEFAULT '' COMMENT '建筑类型',
  `is_houtai` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否为后台（0：会员自定义）',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='小区系统表';

-- -----------------------------
-- Records of `eju_xiaoqu_system`
-- -----------------------------
INSERT INTO `eju_xiaoqu_system` VALUES ('1', '61', '1572578194', '1572578194', '110.363126', '20.067355', '15300', '小户型,宜居生态,海景楼盘', '住宅', '海口海甸岛东片开发区', '13800000000', '', '元/㎡', '2016', '高层,多层', '1');
INSERT INTO `eju_xiaoqu_system` VALUES ('2', '62', '1572598720', '1572598720', '110.259159', '20.021787', '22042', '小户型,教育地产,宜居生态', '住宅', '海口和谐路海南华侨中学旁', '13800000000', '', '元/㎡', '2014', '高层,多层', '1');
INSERT INTO `eju_xiaoqu_system` VALUES ('3', '63', '1572578165', '1572578165', '110.300711', '20.031024', '8999', '小户型,宜居生态,养生社区', '住宅', '海口丽晶路10-1号', '13800000000', '', '元/㎡', '2008', '高层,多层', '1');
INSERT INTO `eju_xiaoqu_system` VALUES ('4', '64', '1572578217', '1572578217', '110.299756', '20.028129', '13861', '低密居住,旅游地产,宜居生态,海景楼盘', '住宅', '海口市龙华区滨海大道62号', '13800000000', '', '元/㎡', '2008', '高层,多层', '1');
INSERT INTO `eju_xiaoqu_system` VALUES ('5', '65', '1572578143', '1572578143', '110.299192', '20.037073', '11000', '低密居住,宜居生态,海景楼盘', '住宅', '海口海口市丽晶路20号', '13800000000', '', '元/㎡', '2006', '高层,多层', '1');
INSERT INTO `eju_xiaoqu_system` VALUES ('6', '66', '1572578132', '1572578132', '110.297804', '20.029692', '0', '小户型,宜居生态,海景楼盘', '住宅', '海口滨海大道丽晶路1号', '13800000000', '', '元/㎡', '2007', '高层,多层', '1');

-- -----------------------------
-- Table structure for `eju_xinfang_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_content`;
CREATE TABLE `eju_xinfang_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '文档id',
  `sales_address` varchar(100) NOT NULL DEFAULT '' COMMENT '售楼处地址',
  `qr_code` varchar(250) NOT NULL DEFAULT '' COMMENT '扫码看房',
  `phone_qr_code` varchar(250) NOT NULL DEFAULT '' COMMENT '扫码拨号',
  `voice` varchar(100) NOT NULL DEFAULT '' COMMENT '语音介绍地址',
  `opening_time_memo` varchar(100) NOT NULL DEFAULT '' COMMENT '开盘备注 1#楼已开盘',
  `complate_time_memo` varchar(100) NOT NULL DEFAULT '' COMMENT '交房备注',
  `discount` text NOT NULL COMMENT '优惠信息',
  `floor_area` varchar(100) NOT NULL DEFAULT '' COMMENT '占地面积',
  `building_area` varchar(100) NOT NULL DEFAULT '' COMMENT '建筑面积',
  `plot_ratio` varchar(10) NOT NULL DEFAULT '' COMMENT '容积率',
  `greening_rate` varchar(200) NOT NULL DEFAULT '' COMMENT '绿化率',
  `property` varchar(200) NOT NULL DEFAULT '' COMMENT '房屋产权',
  `households` varchar(200) NOT NULL DEFAULT '' COMMENT '户数',
  `carport` varchar(200) NOT NULL DEFAULT '' COMMENT '车位数',
  `floor_case` varchar(100) NOT NULL DEFAULT '' COMMENT '楼层情况',
  `building_num` varchar(100) NOT NULL DEFAULT '' COMMENT '楼栋数量',
  `manage_company` varchar(255) NOT NULL DEFAULT '' COMMENT '物业公司',
  `property_fee` varchar(200) NOT NULL DEFAULT '' COMMENT '物业费',
  `developer` varchar(255) NOT NULL DEFAULT '' COMMENT '开发商',
  `licence` varchar(200) NOT NULL DEFAULT '' COMMENT '预售证号',
  `content` longtext NOT NULL COMMENT '项目介绍',
  `location_introduce` text NOT NULL COMMENT '区位介绍',
  `price_time` int(11) NOT NULL COMMENT '价格有效期',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  `video` varchar(200) NOT NULL DEFAULT '' COMMENT '楼盘视频',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='新房基本信息表';

-- -----------------------------
-- Records of `eju_xinfang_content`
-- -----------------------------
INSERT INTO `eju_xinfang_content` VALUES ('1', '1', '海口市龙华区羊山大道39号观澜湖新城兰桂坊入口旁', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南胜丽实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570776910', '1570776910', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('2', '2', '海口市西海岸市政府西侧长海大道6号', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南胜丽实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570776916', '1570776916', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('3', '3', '海南省海口观澜湖度假区内', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南盛嘉实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570776921', '1570776921', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('4', '4', '海口市龙华区羊山大道39号观澜湖新城兰桂坊入口旁', '', '', '', '', '', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南胜雨实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570775839', '1570775839', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('5', '5', '海口市西海岸南片区南海大道与粤海大道交汇处', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海口美之安房地产开发有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570776127', '1570776127', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('6', '6', '海口市美兰区新大洲大道与海榆大道交汇处', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海口绿地鸿翔置业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570776241', '1570776241', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('7', '7', '海口市秀英区丘海一横路26-27号', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南宏福祥实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570776884', '1570776884', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('8', '8', '海口市新埠岛新埠大道北端', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海口市新埠岛开发建设总公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570777023', '1570777023', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('9', '9', '海口市海甸岛碧海大道29号（世纪大桥向北至海边）', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '新世界中国地产（海口）有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570777138', '1570777138', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('10', '10', '海口市西海岸滨海大道与长荣路交叉口', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南成燕房地产开发有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570777214', '1570777214', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('11', '11', '海口市西海岸金沙湾区域金德路', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南雅海旅游发展有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570777342', '1570777342', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('12', '12', '海南·海口·国兴大道大英山东四路富力首府城市会客厅', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南胜丽实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570777448', '1570777448', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('13', '13', '三亚崖州区政府斜对面', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '三亚广兴实业开发有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570778361', '1570778361', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('14', '14', '三亚市吉阳镇迎宾路中段高原水库旁', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南诗波特投资有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570778379', '1570778379', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('15', '15', '澄迈老城经济开发区生态软件园内', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '融创中国', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570778393', '1570778393', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('16', '16', '琼海市博鳌镇滨海大道（旅游中心接待区东北侧）', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '北京华油房地产开发有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570778409', '1570778409', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('17', '17', '陵水县英州镇清水湾大道', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南雅居乐房地产开发有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1570778489', '1570778489', '', '');
INSERT INTO `eju_xinfang_content` VALUES ('18', '18', '海口市龙华区龙昆南椰海大道与学院路交汇处', '', '', '', '暂无', '2017-08-19 00:00:00', '', '144666', '333000', '2.30', '80', '', '2280', '370', '延高尔夫球场景观顺延排布，首层架空，层高19-21层，带地下车库位', '54', '融创物业', '4.50', '海南勤田实业有限公司', '[2017]海房预字（0103）号', '&lt;p&gt;融创·观澜湖公园壹号为中国地产十强融创在海南省会海口市开发的旅游度假兼自住的综合型项目，项目位于海口市观澜湖旅游度假区内，共享观澜湖成熟配套，项目总占地217亩，总建筑面积33.3万平方米，综合容积率2.3。&lt;/p&gt;&lt;p&gt;项目紧邻观澜湖旅游度假区主入口，延观澜湖2号高尔夫球场顺势排布，纯板式结构，南北通透。楼体坐北朝南，高尔夫果岭、百年荔枝林景观尽收眼底，带来一见倾心的诗意生活。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '', '1577863929', '1586762873', '1586762873', '', '');

-- -----------------------------
-- Table structure for `eju_xinfang_huxing`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_huxing`;
CREATE TABLE `eju_xinfang_huxing` (
  `huxing_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `huxing_title` varchar(200) NOT NULL DEFAULT '' COMMENT '户型标题',
  `huxing_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片',
  `sale_status` varchar(50) NOT NULL DEFAULT '' COMMENT '销售状态，1：在售，2：售罄',
  `huxing_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `huxing_average_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '均价',
  `huxing_characteristic` varchar(255) NOT NULL DEFAULT '' COMMENT '特色：南北通透，冬暖夏凉',
  `huxing_area` decimal(6,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '户型面积',
  `huxing_aspect` varchar(50) NOT NULL DEFAULT '' COMMENT '朝向，1：南',
  `huxing_fitment` varchar(50) NOT NULL DEFAULT '' COMMENT '装修，1：精装',
  `huxing_manage_type` varchar(100) NOT NULL DEFAULT '' COMMENT '类型，1：住宅，2：商用',
  `huxing_remark` varchar(500) NOT NULL DEFAULT '' COMMENT '备注',
  `huxing_room` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '室',
  `huxing_living_room` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '客厅',
  `huxing_kitchen` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '厨',
  `huxing_toilet` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '卫生间',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否热门',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`huxing_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COMMENT='户型图';

-- -----------------------------
-- Records of `eju_xinfang_huxing`
-- -----------------------------
INSERT INTO `eju_xinfang_huxing` VALUES ('1', '1', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('2', '1', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('3', '1', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('4', '1', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('5', '1', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('6', '2', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('7', '2', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('8', '2', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('9', '2', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('10', '2', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('11', '3', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('12', '3', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('13', '3', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('14', '3', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('15', '3', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('16', '4', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('17', '4', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('18', '4', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('19', '4', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('20', '4', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('21', '5', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('22', '5', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('23', '5', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('24', '5', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('25', '5', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('26', '6', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('27', '6', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('28', '6', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('29', '6', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('30', '6', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('31', '7', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('32', '7', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('33', '7', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('34', '7', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('35', '7', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('36', '8', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('37', '8', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('38', '8', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('39', '8', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('40', '8', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('41', '9', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('42', '9', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('43', '9', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('44', '9', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('45', '9', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('46', '10', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('47', '10', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('48', '10', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('49', '10', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('50', '10', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('51', '11', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('52', '11', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('53', '11', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('54', '11', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('55', '11', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('56', '12', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('57', '12', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('58', '12', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('59', '12', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('60', '12', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('61', '13', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('62', '13', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('63', '13', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('64', '13', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('65', '13', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('66', '14', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('67', '14', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('68', '14', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('69', '14', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('70', '14', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('71', '15', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('72', '15', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('73', '15', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('74', '15', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('75', '15', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('76', '16', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('77', '16', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('78', '16', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('79', '16', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('80', '16', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('81', '17', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('82', '17', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('83', '17', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('84', '17', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('85', '17', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('86', '18', '高层公寓A2户型', '/uploads/allimg/20191011/1-191011122030503.jpg', '在售', '89.00', '0.00', '户型方正,采光充足', '67.03', '南', '', '', '户型方正，功能分区合理，精巧实用', '2', '2', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('87', '18', 'C户型', '/uploads/allimg/20191011/1-191011121ZJ09.jpg', '在售', '216.00', '0.00', '户型方正,采光充足,全明格局', '130.91', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离，兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理。', '4', '2', '1', '2', '2', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('88', '18', 'A户型3-1#-306', '/uploads/allimg/20191011/1-191011121643O2.jpg', '在售', '134.00', '0.00', '户型方正,明厨明卫,全明格局', '101.00', '南', '', '', '兼顾到了卧室和卫生间的私密性；各个功能区的尺寸比例规范，布局合理，能很好地满足日常功能需求，整体空间开阔，采光充足，居住舒适度好。', '3', '2', '1', '2', '3', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('89', '18', '高层公寓B户型', '/uploads/allimg/20191011/1-191011121529233.jpg', '在售', '107.00', '0.00', '南北通透,户型方正,采光充足,明厨明卫,全明格局', '81.18', '南', '', '', '全明方正户型，功能合理，布局清晰', '3', '2', '1', '2', '4', '0', '0', '0', '0');
INSERT INTO `eju_xinfang_huxing` VALUES ('90', '18', 'B户型', '/uploads/allimg/20191011/1-191011111HR92.jpg', '在售', '164.00', '0.00', '采光充足,全明格局', '123.67', '南', '', '', '整体户型方正，活动区域开阔，居住舒适度高；全明户型，各部分空间均有窗，可保证整体空间采光和通风，居住舒适度好；居室布局合理，通风良好，动静分离。', '3', '2', '1', '2', '5', '0', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_xinfang_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_photo`;
CREATE TABLE `eju_xinfang_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=253 DEFAULT CHARSET=utf8 COMMENT='新房相册表';

-- -----------------------------
-- Records of `eju_xinfang_photo`
-- -----------------------------
INSERT INTO `eju_xinfang_photo` VALUES ('1', '1', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('2', '1', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('3', '1', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('4', '1', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('5', '1', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('6', '1', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('7', '1', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('8', '1', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('9', '1', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('10', '1', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('11', '1', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('12', '1', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('13', '1', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('14', '1', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('15', '2', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('16', '2', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('17', '2', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('18', '2', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('19', '2', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('20', '2', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('21', '2', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('22', '2', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('23', '2', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('24', '2', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('25', '2', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('26', '2', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('27', '2', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('28', '2', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('29', '3', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('30', '3', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('31', '3', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('32', '3', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('33', '3', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('34', '3', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('35', '3', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('36', '3', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('37', '3', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('38', '3', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('39', '3', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('40', '3', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('41', '3', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('42', '3', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('43', '4', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('44', '4', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('45', '4', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('46', '4', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('47', '4', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('48', '4', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('49', '4', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('50', '4', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('51', '4', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('52', '4', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('53', '4', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('54', '4', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('55', '4', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('56', '4', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('57', '5', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('58', '5', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('59', '5', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('60', '5', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('61', '5', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('62', '5', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('63', '5', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('64', '5', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('65', '5', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('66', '5', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('67', '5', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('68', '5', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('69', '5', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('70', '5', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('71', '6', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('72', '6', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('73', '6', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('74', '6', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('75', '6', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('76', '6', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('77', '6', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('78', '6', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('79', '6', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('80', '6', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('81', '6', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('82', '6', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('83', '6', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('84', '6', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('85', '7', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('86', '7', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('87', '7', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('88', '7', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('89', '7', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('90', '7', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('91', '7', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('92', '7', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('93', '7', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('94', '7', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('95', '7', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('96', '7', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('97', '7', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('98', '7', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('99', '8', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('100', '8', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('101', '8', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('102', '8', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('103', '8', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('104', '8', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('105', '8', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('106', '8', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('107', '8', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('108', '8', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('109', '8', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('110', '8', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('111', '8', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('112', '8', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('113', '9', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('114', '9', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('115', '9', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('116', '9', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('117', '9', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('118', '9', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('119', '9', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('120', '9', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('121', '9', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('122', '9', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('123', '9', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('124', '9', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('125', '9', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('126', '9', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('127', '10', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('128', '10', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('129', '10', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('130', '10', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('131', '10', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('132', '10', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('133', '10', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('134', '10', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('135', '10', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('136', '10', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('137', '10', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('138', '10', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('139', '10', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('140', '10', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('141', '11', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('142', '11', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('143', '11', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('144', '11', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('145', '11', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('146', '11', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('147', '11', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('148', '11', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('149', '11', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('150', '11', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('151', '11', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('152', '11', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('153', '11', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('154', '11', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('155', '12', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('156', '12', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('157', '12', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('158', '12', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('159', '12', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('160', '12', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('161', '12', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('162', '12', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('163', '12', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('164', '12', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('165', '12', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('166', '12', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('167', '12', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('168', '12', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('169', '13', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('170', '13', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('171', '13', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('172', '13', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('173', '13', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('174', '13', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('175', '13', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('176', '13', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('177', '13', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('178', '13', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('179', '13', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('180', '13', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('181', '13', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('182', '13', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('183', '14', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('184', '14', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('185', '14', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('186', '14', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('187', '14', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('188', '14', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('189', '14', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('190', '14', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('191', '14', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('192', '14', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('193', '14', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('194', '14', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('195', '14', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('196', '14', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('197', '15', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('198', '15', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('199', '15', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('200', '15', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('201', '15', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('202', '15', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('203', '15', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('204', '15', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('205', '15', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('206', '15', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('207', '15', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('208', '15', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('209', '15', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('210', '15', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('211', '16', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('212', '16', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('213', '16', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('214', '16', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('215', '16', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('216', '16', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('217', '16', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('218', '16', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('219', '16', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('220', '16', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('221', '16', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('222', '16', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('223', '16', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('224', '16', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('225', '17', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('226', '17', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('227', '17', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('228', '17', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('229', '17', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('230', '17', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('231', '17', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('232', '17', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('233', '17', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('234', '17', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('235', '17', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('236', '17', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('237', '17', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('238', '17', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('239', '18', '', '/uploads/allimg/20191011/1-19101111140Y40.jpg', '效果图', '1', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('240', '18', '', '/uploads/allimg/20191011/1-19101111140X44.jpg', '效果图', '2', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('241', '18', '', '/uploads/allimg/20191011/1-19101111140X16.jpg', '效果图', '3', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('242', '18', '', '/uploads/allimg/20191011/1-19101111140U18.jpg', '效果图', '4', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('243', '18', '', '/uploads/allimg/20191011/1-19101111140SQ.jpg', '效果图', '5', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('244', '18', '', '/uploads/allimg/20191011/1-19101111140QU.jpg', '效果图', '6', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('245', '18', '', '/uploads/allimg/20191011/1-1910111116313D.jpg', '交通图', '7', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('246', '18', '', '/uploads/allimg/20191011/1-191011111631149.jpg', '交通图', '8', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('247', '18', '', '/uploads/allimg/20191011/1-19101111160IU.jpg', '实景图', '9', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('248', '18', '', '/uploads/allimg/20191011/1-19101111160H28.jpg', '实景图', '10', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('249', '18', '', '/uploads/allimg/20191011/1-19101111153RJ.jpg', '配套图', '11', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('250', '18', '', '/uploads/allimg/20191011/1-19101111153Y50.jpg', '配套图', '12', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('251', '18', '', '/uploads/allimg/20191011/1-191011111516202.jpg', '样板间', '13', '0', '0', '0');
INSERT INTO `eju_xinfang_photo` VALUES ('252', '18', '', '/uploads/allimg/20191011/1-1910111115161Z.jpg', '样板间', '14', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_xinfang_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_price`;
CREATE TABLE `eju_xinfang_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='价格走势表';

-- -----------------------------
-- Records of `eju_xinfang_price`
-- -----------------------------
INSERT INTO `eju_xinfang_price` VALUES ('1', '1', '15400', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('2', '1', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('3', '2', '17300', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('4', '2', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('5', '3', '17100', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('6', '3', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('7', '4', '16000', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('8', '4', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('9', '5', '16300', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('10', '5', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('11', '6', '16000', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('12', '6', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('13', '7', '17200', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('14', '7', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('15', '8', '17296', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('16', '8', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('17', '9', '21500', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('18', '9', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('19', '10', '15400', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('20', '10', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('21', '11', '13900', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('22', '11', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('23', '12', '30000', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('24', '12', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('25', '13', '18500', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('26', '13', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('27', '14', '25000', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('28', '14', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('29', '15', '12500', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('30', '15', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('31', '16', '19000', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('32', '16', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('33', '17', '20000', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('34', '17', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('35', '18', '15400', '1', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');
INSERT INTO `eju_xinfang_price` VALUES ('36', '18', '0', '2', '2019-10-11', '2019-10', '2019', '1570767028', '0', '0');

-- -----------------------------
-- Table structure for `eju_xinfang_sand`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_sand`;
CREATE TABLE `eju_xinfang_sand` (
  `sand_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) DEFAULT '' COMMENT '楼栋名称',
  `unit` varchar(100) DEFAULT '' COMMENT '单元数',
  `elevator` varchar(100) DEFAULT '' COMMENT '电梯数',
  `floor_num` varchar(100) DEFAULT '' COMMENT '楼层数',
  `room_num` varchar(100) DEFAULT '' COMMENT '总户数',
  `open_time` int(11) unsigned DEFAULT '0' COMMENT '开盘时间',
  `complate_time` int(11) unsigned DEFAULT '0' COMMENT '交房时间',
  `sale_status` varchar(50) DEFAULT '' COMMENT '销售状态',
  `huxing_id` varchar(50) DEFAULT '' COMMENT '户型id '',''分隔',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`sand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `eju_xinfang_sand_pic`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_sand_pic`;
CREATE TABLE `eju_xinfang_sand_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `litpic` varchar(100) DEFAULT NULL COMMENT '沙盘图片',
  `data` text COMMENT '位置标注',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `eju_xinfang_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_xinfang_system`;
CREATE TABLE `eju_xinfang_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '文档id',
  `lng` varchar(20) NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(20) NOT NULL DEFAULT '' COMMENT '纬度',
  `starting_price` varchar(200) NOT NULL DEFAULT '' COMMENT '起价',
  `average_price` int(10) NOT NULL DEFAULT '0' COMMENT '均价',
  `opening_time` int(11) NOT NULL DEFAULT '0' COMMENT '开盘时间',
  `complate_time` int(10) NOT NULL DEFAULT '0' COMMENT '交房时间',
  `is_discount` tinyint(1) NOT NULL DEFAULT '1' COMMENT '优惠楼盘',
  `characteristic` set('小户型','低密居住','旅游地产','教育地产','宜居生态','公园地产','海景楼盘','养生社区') DEFAULT '' COMMENT '特色',
  `fitment` set('毛坯','简装','精装','豪装') DEFAULT '' COMMENT '装修情况',
  `building_type` set('低层','高层','多层','复式') DEFAULT '' COMMENT '建筑形式',
  `manage_type` set('住宅','商铺','写字楼','公寓','别墅','其他') DEFAULT '' COMMENT '类型',
  `sale_status` enum('预售','在售','售罄','') NOT NULL DEFAULT '预售' COMMENT '销售状态',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '参考总价',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '楼盘地址',
  `sale_phone` varchar(50) NOT NULL DEFAULT '' COMMENT '售楼电话',
  `phone_code` varchar(20) NOT NULL DEFAULT '' COMMENT '号码转码',
  `main_unit` varchar(100) NOT NULL DEFAULT '' COMMENT '主力户型',
  `price_units` enum('元/㎡','元/套','') NOT NULL DEFAULT '元/㎡' COMMENT '价格单位',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='新房基本信息表';

-- -----------------------------
-- Records of `eju_xinfang_system`
-- -----------------------------
INSERT INTO `eju_xinfang_system` VALUES ('1', '1', '110.315859', '19.919459', '', '15400', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态', '精装', '高层,多层', '住宅', '在售', '0.00', '1570776910', '1570776910', '海口市观澜湖旅游度假区内', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('2', '2', '110.198416', '20.053444', '', '17300', '1503072000', '1546185600', '0', '低密居住,旅游地产,海景楼盘', '精装', '高层,多层', '商铺,写字楼,公寓', '在售', '0.00', '1570776916', '1570776916', '海口市西海岸市政府西侧长海大道6号', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('3', '3', '110.302826', '19.880376', '', '17100', '1503072000', '1546185600', '0', '旅游地产,宜居生态,养生社区', '精装', '高层,多层', '住宅,公寓,别墅', '在售', '0.00', '1570776921', '1570776921', '海南省海口观澜湖度假区内（5-6号球场）', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('4', '4', '110.312985', '19.906866', '', '16000', '1498838400', '1546185600', '0', '旅游地产,宜居生态,养生社区', '精装', '高层,多层', '住宅', '在售', '0.00', '1570775839', '1570775839', '海口观澜湖旅游度假区内1号黑石球场旁', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('5', '5', '110.182941', '19.98934', '', '16300', '1503072000', '1546185600', '0', '小户型,旅游地产,宜居生态,养生社区', '精装', '低层,高层,多层', '住宅,商铺', '在售', '0.00', '1570776127', '1570776127', '海口市西海岸南片区南海大道与粤海大道交汇处', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('6', '6', '110.429481', '19.971889', '', '16000', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态', '精装', '低层,高层,多层', '住宅,商铺', '在售', '0.00', '1570776241', '1570776241', '海口市美兰区新大洲大道与海榆大道交汇处', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('7', '7', '110.290488', '20.022418', '', '17200', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态,海景楼盘', '精装', '高层,多层', '住宅,商铺', '在售', '0.00', '1570776884', '1570776884', '海口市秀英区丘海一横路26-27号', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('8', '8', '110.368238', '20.08937', '', '17296', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态,海景楼盘', '精装', '高层,多层,复式', '住宅,商铺,别墅', '在售', '0.00', '1570777023', '1570777023', '海口市新埠岛新埠大道北端', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('9', '9', '110.3269', '20.077146', '', '21500', '1503072000', '1546185600', '0', '低密居住,旅游地产,教育地产,宜居生态,公园地产,海景楼盘,养生社区', '精装', '高层,多层', '住宅,商铺,公寓,别墅', '在售', '0.00', '1570777138', '1570777138', '海口市海甸岛碧海大道29号（世纪大桥向北至海边）', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('10', '10', '110.18161', '20.056485', '', '15400', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态', '简装', '高层,多层', '住宅', '在售', '0.00', '1570777214', '1570777214', '海口市西海岸滨海大道与长荣路交叉口', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('11', '11', '110.159592', '20.035045', '', '13900', '1503072000', '1546185600', '0', '低密居住,旅游地产,教育地产,宜居生态,海景楼盘', '豪装', '高层,多层', '住宅,公寓,别墅', '在售', '0.00', '1570777342', '1570777342', '海口市西海岸金沙湾区域金德路', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('12', '12', '110.369538', '20.021945', '', '30000', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态', '精装', '高层,多层', '写字楼', '在售', '0.00', '1570777448', '1570777448', '海南·海口·国兴大道大英山东四路富力首府城市会客厅', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('13', '13', '109.176015', '18.361347', '', '18500', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态,公园地产,养生社区', '精装', '低层,高层,多层', '住宅', '在售', '0.00', '1570778361', '1570778361', '三亚崖州区政府斜对面', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('14', '14', '109.563616', '18.285437', '', '25000', '1503072000', '1546185600', '0', '低密居住,旅游地产,教育地产,宜居生态,养生社区', '毛坯,精装', '低层,高层,多层,复式', '住宅,公寓,别墅', '在售', '0.00', '1570778379', '1570778379', '三亚市吉阳镇迎宾路中段高原水库旁', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('15', '15', '110.315859', '19.919459', '', '12500', '1503072000', '1546185600', '0', '低密居住,宜居生态,养生社区', '毛坯,简装,精装', '低层,高层,多层', '住宅', '在售', '0.00', '1570778393', '1570778393', '澄迈老城经济开发区生态软件园内', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('16', '16', '110.59776', '19.186439', '', '19000', '1503072000', '1546185600', '0', '旅游地产,教育地产,宜居生态,公园地产,海景楼盘,养生社区', '精装,豪装', '高层,多层', '住宅,公寓,别墅', '在售', '0.00', '1570778409', '1570778409', '琼海市博鳌镇滨海大道（旅游中心接待区东北侧）', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('17', '17', '109.866134', '18.400366', '', '20000', '1503072000', '1546185600', '0', '低密居住,旅游地产,宜居生态', '精装', '高层,多层,复式', '住宅,公寓,别墅', '在售', '0.00', '1570778489', '1570778489', '陵水县英州镇清水湾大道', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');
INSERT INTO `eju_xinfang_system` VALUES ('18', '18', '110.337494', '19.984587', '', '0', '1503072000', '1546185600', '0', '低密居住,旅游地产,教育地产,宜居生态', '精装', '高层,多层', '住宅', '预售', '0.00', '1586762873', '1586762873', '海口市龙华区龙昆南椰海大道与学院路交汇处', '400-123-4567', '', '两居（65平）三居（80-100平', '元/㎡');

-- -----------------------------
-- Table structure for `eju_zufang_content`
-- -----------------------------
DROP TABLE IF EXISTS `eju_zufang_content`;
CREATE TABLE `eju_zufang_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `content` longtext NOT NULL COMMENT '房源介绍',
  `property` int(10) NOT NULL DEFAULT '0' COMMENT '产权年限',
  `building_age` int(10) NOT NULL DEFAULT '0' COMMENT '建造年代',
  `supporting` set('电视','空调','电梯','冰箱','洗衣机','热水器','阳台','床','沙发','衣柜','抽油烟机','独立卫生间') DEFAULT '' COMMENT '配套',
  `panoram` varchar(200) NOT NULL DEFAULT '' COMMENT '全景相册',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='租房附加表';

-- -----------------------------
-- Records of `eju_zufang_content`
-- -----------------------------
INSERT INTO `eju_zufang_content` VALUES ('1', '73', '1572576695', '1572576695', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错&lt;/p&gt;', '70', '2016', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_zufang_content` VALUES ('2', '74', '1572576678', '1572576678', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错&lt;/p&gt;', '70', '2014', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_zufang_content` VALUES ('3', '75', '1572576725', '1572576725', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错&lt;/p&gt;', '70', '2008', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_zufang_content` VALUES ('4', '76', '1572576744', '1572576744', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错&lt;/p&gt;', '70', '2008', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_zufang_content` VALUES ('5', '77', '1572576645', '1572576645', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错&lt;/p&gt;', '70', '2006', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_zufang_content` VALUES ('6', '78', '1572576631', '1572576631', '&lt;p&gt;小区品质不错，绿化环境也可以，有泳池，有物业管理，有停车位，居家安静舒适。二房二厅一卫一阳台，户型方正，格局不错，光线好，通风好。朝东向，可观江景，实业非常不错。精装修，北欧风格。周边环境非常不错&lt;/p&gt;', '70', '2007', '电视,空调,电梯,冰箱,洗衣机,热水器,阳台,床,沙发,衣柜,抽油烟机,独立卫生间', '');
INSERT INTO `eju_zufang_content` VALUES ('8', '84', '1586916639', '1586916639', '', '0', '0', '', '');

-- -----------------------------
-- Table structure for `eju_zufang_photo`
-- -----------------------------
DROP TABLE IF EXISTS `eju_zufang_photo`;
CREATE TABLE `eju_zufang_photo` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `photo_title` varchar(200) NOT NULL DEFAULT '' COMMENT '相片标题',
  `photo_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `photo_type` varchar(100) NOT NULL DEFAULT '' COMMENT '图片类型',
  `sort_order` int(10) NOT NULL DEFAULT '0' COMMENT '排序号',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`photo_id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='租房相册表';

-- -----------------------------
-- Records of `eju_zufang_photo`
-- -----------------------------
INSERT INTO `eju_zufang_photo` VALUES ('1', '73', '', '/uploads/allimg/20191030/1-191030151Z0W2.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('2', '73', '', '/uploads/allimg/20191030/1-191030151Z0233.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('3', '73', '', '/uploads/allimg/20191030/1-191030151Z0V2.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('4', '73', '', '/uploads/allimg/20191030/1-191030151Z0Q9.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('5', '73', '', '/uploads/allimg/20191030/1-191030151Z0941.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('35', '74', '', '/uploads/allimg/20191030/1-191030152Qc23.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('34', '74', '', '/uploads/allimg/20191030/1-191030152Qa31.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('33', '74', '', '/uploads/allimg/20191030/1-191030152QbB.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('32', '74', '', '/uploads/allimg/20191030/1-191030152Qa22.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('31', '74', '', '/uploads/allimg/20191030/1-191030152Q9194.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('11', '75', '', '/uploads/allimg/20191030/1-191030151Z0W2.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('12', '75', '', '/uploads/allimg/20191030/1-191030151Z0233.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('13', '75', '', '/uploads/allimg/20191030/1-191030151Z0V2.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('14', '75', '', '/uploads/allimg/20191030/1-191030151Z0Q9.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('15', '75', '', '/uploads/allimg/20191030/1-191030151Z0941.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('40', '76', '', '/uploads/allimg/20191030/1-19103015310b41.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('39', '76', '', '/uploads/allimg/20191030/1-19103015310b11.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('38', '76', '', '/uploads/allimg/20191030/1-191030153109630.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('37', '76', '', '/uploads/allimg/20191030/1-19103015310aN.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('46', '77', '', '/uploads/allimg/20191030/1-191030153323C1.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('45', '77', '', '/uploads/allimg/20191030/1-191030153324550.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('44', '77', '', '/uploads/allimg/20191030/1-191030153324C7.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('43', '77', '', '/uploads/allimg/20191030/1-191030153324E2.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('42', '77', '', '/uploads/allimg/20191030/1-191030153324G4.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('52', '78', '', '/uploads/allimg/20191030/1-19103015352X95.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('51', '78', '', '/uploads/allimg/20191030/1-19103015352T25.jpg', '', '4', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('50', '78', '', '/uploads/allimg/20191030/1-19103015352QC.jpg', '', '3', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('49', '78', '', '/uploads/allimg/20191030/1-19103015352XV.jpg', '', '2', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('48', '78', '', '/uploads/allimg/20191030/1-19103015352W35.jpg', '', '1', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('36', '74', '', '/uploads/allimg/20191030/1-191030152Qb45.jpg', '', '6', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('41', '76', '', '/uploads/allimg/20191030/1-19103015310b14.jpg', '', '5', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('47', '77', '', '/uploads/allimg/20191030/1-191030153323Q7.jpg', '', '6', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('53', '78', '', '/uploads/allimg/20191030/1-19103015352W62.jpg', '', '6', '0', '0', '0');
INSERT INTO `eju_zufang_photo` VALUES ('54', '78', '', '/uploads/allimg/20191030/1-19103015352G40.jpg', '', '7', '0', '0', '0');

-- -----------------------------
-- Table structure for `eju_zufang_price`
-- -----------------------------
DROP TABLE IF EXISTS `eju_zufang_price`;
CREATE TABLE `eju_zufang_price` (
  `price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新房aid',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '价格',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1：新房均价，2：新房起价',
  `day` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08-07',
  `month` varchar(20) NOT NULL DEFAULT '' COMMENT '2019-08',
  `year` varchar(20) NOT NULL DEFAULT '' COMMENT '2019',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='租房价格表';

-- -----------------------------
-- Records of `eju_zufang_price`
-- -----------------------------
INSERT INTO `eju_zufang_price` VALUES ('1', '81', '0', '1', '2020-04-13', '2020-04', '2020', '1586765769', '0', '0');
INSERT INTO `eju_zufang_price` VALUES ('2', '81', '0', '3', '2020-04-13', '2020-04', '2020', '1586765769', '0', '0');
INSERT INTO `eju_zufang_price` VALUES ('3', '84', '0', '1', '2020-04-15', '2020-04', '2020', '1586916640', '0', '0');
INSERT INTO `eju_zufang_price` VALUES ('4', '84', '0', '3', '2020-04-15', '2020-04', '2020', '1586916640', '0', '0');

-- -----------------------------
-- Table structure for `eju_zufang_system`
-- -----------------------------
DROP TABLE IF EXISTS `eju_zufang_system`;
CREATE TABLE `eju_zufang_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned NOT NULL DEFAULT '0',
  `total_price` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `area` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '面积',
  `characteristic` set('南北通透','冬暖夏凉') DEFAULT '' COMMENT '特色',
  `aspect` enum('东','西','南','北','东北','西北','东南','西南','') NOT NULL DEFAULT '东' COMMENT '朝向',
  `fitment` enum('毛坯','简装','精装','豪装','') NOT NULL DEFAULT '毛坯' COMMENT '装修',
  `manage_type` enum('住宅','铺面','别墅','') NOT NULL DEFAULT '住宅' COMMENT '类型',
  `room` enum('1','2','3','4','5','6','') NOT NULL DEFAULT '1' COMMENT '室',
  `living_room` enum('0','1','2','3','4','') NOT NULL DEFAULT '0' COMMENT '客厅',
  `kitchen` enum('0','1','2','') NOT NULL DEFAULT '0' COMMENT '厨房',
  `toilet` enum('0','1','2','') NOT NULL DEFAULT '0' COMMENT '卫生间',
  `balcony` enum('0','1','2','3','') NOT NULL DEFAULT '0' COMMENT '阳台',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '精度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '维度',
  `price_units` enum('元/月','元/季','元/年','') NOT NULL DEFAULT '元/月' COMMENT '价格单位',
  `pay_way` enum('押一付一','押一付三','') NOT NULL DEFAULT '押一付一' COMMENT '付款方式',
  `hire_type` enum('整租','合租','') NOT NULL DEFAULT '整租' COMMENT '租赁方式',
  `room_type` enum('主卧','次卧','') NOT NULL DEFAULT '主卧' COMMENT '单间厅室',
  `sale_name` varchar(200) NOT NULL DEFAULT '' COMMENT '联系人',
  `sale_phone` varchar(200) NOT NULL DEFAULT '' COMMENT '联系电话',
  `phone_code` varchar(200) NOT NULL DEFAULT '' COMMENT '转机码',
  `floo_type` enum('低层','中层','高层','') NOT NULL DEFAULT '低层' COMMENT '楼层',
  `floor_count` int(10) NOT NULL DEFAULT '0' COMMENT '楼层数',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='租房系统表';

-- -----------------------------
-- Records of `eju_zufang_system`
-- -----------------------------
INSERT INTO `eju_zufang_system` VALUES ('1', '73', '2800', '80', '南北通透,冬暖夏凉', '南', '精装', '住宅', '2', '2', '1', '1', '1', '1572576695', '1572576695', '海口海甸岛东片开发区', '110.363126', '20.067355', '元/月', '押一付三', '整租', '主卧', '张生', '13800001111', '', '中层', '21');
INSERT INTO `eju_zufang_system` VALUES ('2', '74', '3500', '120', '南北通透,冬暖夏凉', '南', '精装', '住宅', '3', '2', '1', '2', '2', '1572576678', '1572576678', '海口和谐路海南华侨中学旁', '110.259159', '20.021787', '元/月', '押一付一', '整租', '主卧', '张生', '13800001111', '', '高层', '28');
INSERT INTO `eju_zufang_system` VALUES ('3', '75', '2400', '90', '南北通透,冬暖夏凉', '南', '精装', '住宅', '2', '2', '1', '1', '1', '1572576725', '1572576725', '海口丽晶路10-1号', '110.300711', '20.031024', '元/月', '押一付三', '整租', '主卧', '张生', '13800001111', '', '中层', '23');
INSERT INTO `eju_zufang_system` VALUES ('4', '76', '1800', '88', '南北通透,冬暖夏凉', '南', '精装', '住宅', '2', '2', '1', '1', '1', '1572576744', '1572576744', '海口市龙华区滨海大道62号', '110.299756', '20.028129', '元/月', '押一付三', '整租', '主卧', '张生', '13800001111', '', '中层', '20');
INSERT INTO `eju_zufang_system` VALUES ('5', '77', '5000', '140', '南北通透,冬暖夏凉', '南', '精装', '住宅', '3', '2', '2', '2', '1', '1572576645', '1572576645', '海口海口市丽晶路20号', '110.299192', '20.037073', '元/月', '押一付三', '整租', '主卧', '张生', '13800001111', '', '高层', '32');
INSERT INTO `eju_zufang_system` VALUES ('6', '78', '3200', '94', '南北通透,冬暖夏凉', '南', '精装', '住宅', '2', '2', '1', '2', '1', '1572576631', '1572576631', '海口滨海大道丽晶路1号', '110.297804', '20.029692', '元/月', '押一付三', '整租', '主卧', '张生', '13800001111', '', '中层', '28');
INSERT INTO `eju_zufang_system` VALUES ('8', '84', '0', '0', '', '东', '毛坯', '住宅', '1', '0', '0', '0', '0', '1586916640', '1586916640', '', '', '', '元/月', '押一付一', '整租', '主卧', '程序猿', '18789221089', '', '低层', '0');
