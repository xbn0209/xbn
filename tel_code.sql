/*
 Navicat Premium Data Transfer

 Source Server         : api
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : apitest

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 16/08/2019 13:15:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tel_code
-- ----------------------------
DROP TABLE IF EXISTS `tel_code`;
CREATE TABLE `tel_code`  (
  `id` int(11) NOT NULL,
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '接收验证码的手机',
  `code` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '验证码',
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '验证码状态 1已验证 2已发送',
  `time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '验证码发送时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
