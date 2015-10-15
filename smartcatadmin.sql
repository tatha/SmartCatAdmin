/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : smartcatadmin

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-10-15 17:12:18
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `sca_menu`
-- ----------------------------
DROP TABLE IF EXISTS `sca_menu`;
CREATE TABLE `sca_menu` (
  `m_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(50) DEFAULT NULL,
  `m_url` varchar(50) DEFAULT NULL,
  `m_icon` varchar(50) DEFAULT NULL,
  `m_parent_id` int(5) DEFAULT NULL,
  `m_position` int(5) DEFAULT NULL,
  `m_submenu` enum('1','0') DEFAULT '0' COMMENT '''0'' for no submenu, ''1'' for submenu',
  `m_status` enum('A','D') DEFAULT 'A',
  `m_display` enum('Y','N') DEFAULT 'Y',
  `m_update_by` varchar(10) DEFAULT NULL,
  `m_update_on` timestamp NULL DEFAULT NULL,
  `m_update_from` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sca_menu
-- ----------------------------
INSERT INTO `sca_menu` VALUES ('1', 'Dashboard', 'dashboard.html', 'icomoon-icon-home-8', '0', '1', '0', 'A', 'Y', null, null, null);
INSERT INTO `sca_menu` VALUES ('2', 'SU Control Panel', '#', 'iconic-icon-equalizer', '0', '2', '1', 'A', 'Y', '', '0000-00-00 00:00:00', '');
INSERT INTO `sca_menu` VALUES ('3', 'User Management', 'manage_user.html', 'icomoon-icon-user-4', '2', '1', '0', 'A', 'Y', '', '0000-00-00 00:00:00', '');
INSERT INTO `sca_menu` VALUES ('4', 'User Permission', 'manage_permission.html', 'icomoon-icon-license', '2', '2', '0', 'A', 'Y', '', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `sca_menu_perm`
-- ----------------------------
DROP TABLE IF EXISTS `sca_menu_perm`;
CREATE TABLE `sca_menu_perm` (
  `mp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mp_roleid` int(3) NOT NULL,
  `mp_menuid` int(3) NOT NULL,
  `mp_view` enum('1','0') DEFAULT '0',
  `mp_add` enum('1','0') DEFAULT '0',
  `mp_edit` enum('1','0') DEFAULT '0',
  `mp_delete` enum('1','0') DEFAULT '0',
  `mp_update_by` varchar(10) DEFAULT NULL,
  `mp_update_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `mp_update_from` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`mp_id`),
  UNIQUE KEY `pk_menuidgid` (`mp_menuid`,`mp_roleid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sca_menu_perm
-- ----------------------------
INSERT INTO `sca_menu_perm` VALUES ('1', '1', '1', '1', '0', '0', '0', null, null, null);
INSERT INTO `sca_menu_perm` VALUES ('2', '1', '2', '1', '0', '0', '0', null, null, null);
INSERT INTO `sca_menu_perm` VALUES ('3', '1', '3', '1', '0', '0', '0', null, null, null);
INSERT INTO `sca_menu_perm` VALUES ('4', '1', '4', '1', '0', '0', '0', null, null, null);

-- ----------------------------
-- Table structure for `sca_role`
-- ----------------------------
DROP TABLE IF EXISTS `sca_role`;
CREATE TABLE `sca_role` (
  `r_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `r_name` varchar(255) DEFAULT NULL,
  `r_status` enum('A','D') DEFAULT NULL,
  `r_update_by` int(11) DEFAULT NULL,
  `r_update_on` timestamp NULL DEFAULT NULL,
  `r_update_from` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sca_role
-- ----------------------------
INSERT INTO `sca_role` VALUES ('1', 'Super Admin', 'A', null, null, null);

-- ----------------------------
-- Table structure for `sca_users`
-- ----------------------------
DROP TABLE IF EXISTS `sca_users`;
CREATE TABLE `sca_users` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_username` varchar(255) NOT NULL DEFAULT '',
  `u_fname` varchar(50) DEFAULT NULL,
  `u_lname` varchar(50) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_contact` varchar(100) DEFAULT NULL,
  `u_password` varchar(50) DEFAULT NULL,
  `u_role` int(11) DEFAULT NULL,
  `u_secret` varchar(50) DEFAULT NULL,
  `u_status` enum('A','D') DEFAULT 'A',
  `u_locked` enum('0','1') DEFAULT '0',
  `u_failed_attempt` int(11) DEFAULT NULL,
  `u_update_by` int(11) DEFAULT NULL,
  `u_update_on` timestamp NULL DEFAULT NULL,
  `u_update_from` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`u_id`,`u_username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sca_users
-- ----------------------------
INSERT INTO `sca_users` VALUES ('1', 'sa', 'Tathagata', 'Basu', 'tathagatabasu.basu@gmail.com', '9831919772', '16ad5892d13a0b7c9220684e52a548b1', '1', null, 'A', '0', '0', '1', '2014-12-05 18:05:57', '127.0.0.1');
