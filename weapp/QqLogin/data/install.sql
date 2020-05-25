/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : eyoucms_develop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-13 14:30:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for #@__weapp_qqlogin
-- ----------------------------
DROP TABLE IF EXISTS `#@__weapp_qqlogin`;
CREATE TABLE `#@__weapp_qqlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `openid` varchar(100) NOT NULL DEFAULT '' COMMENT 'openid',
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT 'QQ昵称',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sta` tinyint(1) NOT NULL DEFAULT '0' COMMENT '修改用户名或者绑定已有账号标识,0-未标记,1-已标记',
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='qq登陆记录表';