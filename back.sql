/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : back

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2019-03-07 00:19:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '文章简介',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章封面',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '文章点击量',
  `publish_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章发布时间',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '作者,程序默认存储登录用户',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `is_wechat` int(11) DEFAULT '1' COMMENT '检测是否是微信浏览器  1检测 0不检测',
  `is_jump` int(11) DEFAULT '1' COMMENT '开启随机跳转 1开启 0不开启',
  `arrow` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击文章内部箭头返回地址',
  `physics` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物理按键点击返回',
  `music` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '背景音乐地址',
  `appid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信appId',
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信密匙',
  `right_now` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '网站立即跳转到指定地址',
  `cnzz` text COLLATE utf8mb4_unicode_ci COMMENT '文章流量统计',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_encryption` tinyint(1) DEFAULT NULL,
  `iframe` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `source_check` tinyint(1) DEFAULT '0',
  `template_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('51', '阿萨德', '阿萨德', 'http://www.wx.com/storage/sencpzXkqbMJnS2mHPmMRUzOayVMMv3y5XHqq8Uj.gif', '0', '2019-03-06 22:47:34', 'ALG', '<p>撒的</p>', '1', '1', null, null, null, null, null, null, null, null, null, '0', '1', '1', '1');
INSERT INTO `articles` VALUES ('52', '阿萨德123', '撒的', 'http://www.wx.com/storage/KwWfkYmjTEBoKR0TXIsxuFZlv0zOoAxHBpMEPiJu.gif', '0', '2019-03-06 22:54:27', 'ALG', '<p>阿萨德</p>', '0', null, null, null, null, null, null, null, null, null, '1', '1', '1', '0', '1');

-- ----------------------------
-- Table structure for visit_logs
-- ----------------------------
DROP TABLE IF EXISTS `visit_logs`;
CREATE TABLE `visit_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ip地址',
  `system_type` text COLLATE utf8mb4_unicode_ci COMMENT '系统及其型号',
  `event` text COLLATE utf8mb4_unicode_ci COMMENT '触发事件',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of visit_logs
-- ----------------------------
INSERT INTO `visit_logs` VALUES ('1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 13:41:12', '2019-03-06 13:41:12');
INSERT INTO `visit_logs` VALUES ('2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 13:42:40', '2019-03-06 13:42:40');
INSERT INTO `visit_logs` VALUES ('3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:44:30', '2019-03-06 13:44:30');
INSERT INTO `visit_logs` VALUES ('4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:44:42', '2019-03-06 13:44:42');
INSERT INTO `visit_logs` VALUES ('5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:46:12', '2019-03-06 13:46:12');
INSERT INTO `visit_logs` VALUES ('6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:48:07', '2019-03-06 13:48:07');
INSERT INTO `visit_logs` VALUES ('7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:49:09', '2019-03-06 13:49:09');
INSERT INTO `visit_logs` VALUES ('8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:49:32', '2019-03-06 13:49:32');
INSERT INTO `visit_logs` VALUES ('9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:50:24', '2019-03-06 13:50:24');
INSERT INTO `visit_logs` VALUES ('10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:51:08', '2019-03-06 13:51:08');
INSERT INTO `visit_logs` VALUES ('11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:51:42', '2019-03-06 13:51:42');
INSERT INTO `visit_logs` VALUES ('12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:51:50', '2019-03-06 13:51:50');
INSERT INTO `visit_logs` VALUES ('13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:53:15', '2019-03-06 13:53:15');
INSERT INTO `visit_logs` VALUES ('14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:53:33', '2019-03-06 13:53:33');
INSERT INTO `visit_logs` VALUES ('15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:54:07', '2019-03-06 13:54:07');
INSERT INTO `visit_logs` VALUES ('16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:54:16', '2019-03-06 13:54:16');
INSERT INTO `visit_logs` VALUES ('17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:55:23', '2019-03-06 13:55:23');
INSERT INTO `visit_logs` VALUES ('18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:55:41', '2019-03-06 13:55:41');
INSERT INTO `visit_logs` VALUES ('19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:56:04', '2019-03-06 13:56:04');
INSERT INTO `visit_logs` VALUES ('20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:56:25', '2019-03-06 13:56:25');
INSERT INTO `visit_logs` VALUES ('21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:57:14', '2019-03-06 13:57:14');
INSERT INTO `visit_logs` VALUES ('22', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:57:45', '2019-03-06 13:57:45');
INSERT INTO `visit_logs` VALUES ('23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:57:54', '2019-03-06 13:57:54');
INSERT INTO `visit_logs` VALUES ('24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:58:05', '2019-03-06 13:58:05');
INSERT INTO `visit_logs` VALUES ('25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:58:32', '2019-03-06 13:58:32');
INSERT INTO `visit_logs` VALUES ('26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 13:59:07', '2019-03-06 13:59:07');
INSERT INTO `visit_logs` VALUES ('27', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 14:00:37', '2019-03-06 14:00:37');
INSERT INTO `visit_logs` VALUES ('28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 14:10:38', '2019-03-06 14:10:38');
INSERT INTO `visit_logs` VALUES ('29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 14:12:43', '2019-03-06 14:12:43');
INSERT INTO `visit_logs` VALUES ('30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', '2019-03-06 14:13:53', '2019-03-06 14:13:53');
INSERT INTO `visit_logs` VALUES ('31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:15:16', '2019-03-06 14:15:16');
INSERT INTO `visit_logs` VALUES ('32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:22:22', '2019-03-06 14:22:22');
INSERT INTO `visit_logs` VALUES ('33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:23:39', '2019-03-06 14:23:39');
INSERT INTO `visit_logs` VALUES ('34', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:24:37', '2019-03-06 14:24:37');
INSERT INTO `visit_logs` VALUES ('35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:38:20', '2019-03-06 14:38:20');
INSERT INTO `visit_logs` VALUES ('36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:47:34', '2019-03-06 14:47:34');
INSERT INTO `visit_logs` VALUES ('37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:54:27', '2019-03-06 14:54:27');
INSERT INTO `visit_logs` VALUES ('38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 14:54:59', '2019-03-06 14:54:59');
INSERT INTO `visit_logs` VALUES ('39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 15:12:23', '2019-03-06 15:12:23');
INSERT INTO `visit_logs` VALUES ('40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 15:12:58', '2019-03-06 15:12:58');
INSERT INTO `visit_logs` VALUES ('41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 15:13:59', '2019-03-06 15:13:59');
INSERT INTO `visit_logs` VALUES ('42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:38:34', '2019-03-06 23:38:34');
INSERT INTO `visit_logs` VALUES ('43', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:39:15', '2019-03-06 23:39:15');
INSERT INTO `visit_logs` VALUES ('44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:39:33', '2019-03-06 23:39:33');
INSERT INTO `visit_logs` VALUES ('45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:42:13', '2019-03-06 23:42:13');
INSERT INTO `visit_logs` VALUES ('46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:42:57', '2019-03-06 23:42:57');
INSERT INTO `visit_logs` VALUES ('47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:43:39', '2019-03-06 23:43:39');
INSERT INTO `visit_logs` VALUES ('48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:44:40', '2019-03-06 23:44:40');
INSERT INTO `visit_logs` VALUES ('49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:48:08', '2019-03-06 23:48:08');
INSERT INTO `visit_logs` VALUES ('50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:48:25', '2019-03-06 23:48:25');
INSERT INTO `visit_logs` VALUES ('51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:49:01', '2019-03-06 23:49:01');
INSERT INTO `visit_logs` VALUES ('52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-06 23:51:31', '2019-03-06 23:51:31');
INSERT INTO `visit_logs` VALUES ('53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:00:03', '2019-03-07 00:00:03');
INSERT INTO `visit_logs` VALUES ('54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:00:31', '2019-03-07 00:00:31');
INSERT INTO `visit_logs` VALUES ('55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:02:17', '2019-03-07 00:02:17');
INSERT INTO `visit_logs` VALUES ('56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:04:01', '2019-03-07 00:04:01');
INSERT INTO `visit_logs` VALUES ('57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:05:53', '2019-03-07 00:05:53');
INSERT INTO `visit_logs` VALUES ('58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:07:50', '2019-03-07 00:07:50');
INSERT INTO `visit_logs` VALUES ('59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '', '2019-03-07 00:08:34', '2019-03-07 00:08:34');
