
ALTER TABLE `eju_form` ADD COLUMN `channel_id`  int(6) UNSIGNED NOT NULL DEFAULT 1 COMMENT '模型id' AFTER `id`;
ALTER TABLE `eju_sms_log` MODIFY COLUMN `status`  int(1) NOT NULL DEFAULT 0 COMMENT '发送状态,1:成功,0:失败,2:已使用' AFTER `code`;
ALTER TABLE `eju_users_content` ADD COLUMN `service_xiaoqu`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主营小区' AFTER `service_area`;
ALTER TABLE `eju_users_content` ADD COLUMN `license_img`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '营业执照图片' AFTER `content`;
ALTER TABLE `eju_users_content` ADD COLUMN `license`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '营业执照编码' AFTER `license_img`;
ALTER TABLE `eju_users_log` MODIFY COLUMN `aid`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文档id' AFTER `users_id`;

