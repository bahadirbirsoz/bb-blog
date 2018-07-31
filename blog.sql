/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-07-31 09:26:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'qwe');
INSERT INTO `category` VALUES ('2', 'Yeni asd');
INSERT INTO `category` VALUES ('3', 'zxc');
INSERT INTO `category` VALUES ('4', 'Yeni Kategori');
INSERT INTO `category` VALUES ('5', 'asd qwe');

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` enum('draft','publish') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES ('1', '1', '1', 'Başlık', 'HTML içerik olabillir burası', 'publish', '2018-07-29 12:55:07', '2018-07-29 13:37:21', '2018-07-29 13:37:21');
INSERT INTO `post` VALUES ('2', '4', '1', 'Yeni Başlık', 'HTML içerik olabillir burası', 'publish', '2018-07-29 13:00:30', '2018-07-29 13:37:22', '2018-07-29 13:37:22');

-- ----------------------------
-- Table structure for `token`
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `token_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `expired_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', '1', 'C55WHLCR41NQE51SP5Q6U4SWU7P8J2J0A2Z9R8N0QLVNUJGICC', null, null);
INSERT INTO `token` VALUES ('2', '1', null, null, null);
INSERT INTO `token` VALUES ('3', '1', null, null, null);
INSERT INTO `token` VALUES ('4', '1', 'W61W1WWO8WENZJBCYPWK6Q33NN37KTZ720XMVKKBZLP6YHJZZR', '2018-07-29 09:54:05', null);
INSERT INTO `token` VALUES ('5', '1', 'JAUGCXUCW7XQ0J4LW2AH74M58OLN9AR0LWGDHG850DREZGGO7G', '2018-07-29 10:12:57', null);
INSERT INTO `token` VALUES ('6', '1', '4KAECSNPM0AVXIY1NBZILYKFE75QGL0DXBNOKCIQDHFVPY9NZ3', '2018-07-29 10:14:48', '2018-07-29 10:30:34');
INSERT INTO `token` VALUES ('7', '1', 'JZM7YJJFET7H5EXTSRNT8TGHNSYYRD6XTY2ZUAQ5UKG62VTEAT', '2018-07-29 10:31:06', null);
INSERT INTO `token` VALUES ('8', '1', 'WT8PMRS6KXYH8A031XYIC04QI1TUV8WHW53CI8XIIDZLYMHNVV', '2018-07-29 10:35:26', null);

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'bahadir@birsoz.net', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Bahadır', 'Birsöz', null, null, 'admin');
