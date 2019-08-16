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

 Date: 16/08/2019 12:48:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for home_user
-- ----------------------------
DROP TABLE IF EXISTS `home_user`;
CREATE TABLE `home_user`  (
  `id` int(11) NOT NULL,
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户手机号',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名，默认手机号',
  `create_ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '注册IP',
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户状态 1正常  其他异常',
  `create_time` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '注册时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
