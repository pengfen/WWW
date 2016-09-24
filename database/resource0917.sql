/*
Navicat MySQL Data Transfer

Source Server         : peng
Source Server Version : 50173
Source Host           : 120.24.36.66:3306
Source Database       : resource

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-09-17 20:37:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for resource_auth
-- ----------------------------
DROP TABLE IF EXISTS `resource_auth`;
CREATE TABLE `resource_auth` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '权限名',
  `pid` smallint(6) NOT NULL DEFAULT '0' COMMENT '父id',
  `controller` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `path` varchar(32) NOT NULL DEFAULT '' COMMENT '全路径',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '权限关联图',
  `isShow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 0 显示 1 不显示',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `mid` int(10) unsigned DEFAULT '0' COMMENT '修改者',
  `updatetime` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  `uid` int(10) unsigned DEFAULT '0' COMMENT '创建者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='后台权限表';

-- ----------------------------
-- Records of resource_auth
-- ----------------------------
INSERT INTO `resource_auth` VALUES ('1', '权限管理', '0', '', '', '1', '0', 'upload/2016-09-17/57dc49e4c5653.png', '0', '1474034557', '1', '1474054628', '1');
INSERT INTO `resource_auth` VALUES ('2', '权限列表', '1', 'Auth', 'index', '1-2', '1', '', '0', '1474034557', '0', '0', '1');
INSERT INTO `resource_auth` VALUES ('3', '管理员列表', '1', 'Manager', 'index', '1-3', '1', 'upload/2016-09-17/57dc490cb5879.png', '0', '1474054412', '0', '0', '1');
INSERT INTO `resource_auth` VALUES ('4', '角色列表', '1', 'Role', 'index', '1-4', '1', '', '0', '1474093955', '0', '0', '1');
INSERT INTO `resource_auth` VALUES ('5', '资料管理', '0', '', '', '5', '0', 'upload/2016-09-17/57dd4c5a36b9e.png', '0', '1474120794', '0', '0', '1');
INSERT INTO `resource_auth` VALUES ('6', '技术文章分类', '5', 'Technarticlecate', 'index', '5-6', '1', '', '0', '1474120842', '0', '0', '1');
INSERT INTO `resource_auth` VALUES ('7', '技术文章', '5', 'Technarticle', 'index', '5-7', '1', '', '0', '1474120875', '0', '0', '1');

-- ----------------------------
-- Table structure for resource_manager
-- ----------------------------
DROP TABLE IF EXISTS `resource_manager`;
CREATE TABLE `resource_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '管理名称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '管理密码',
  `regtime` int(10) unsigned DEFAULT '0' COMMENT '注册时间',
  `logtime` int(10) unsigned DEFAULT '0' COMMENT '登录时间',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `rid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `display_name` varchar(30) NOT NULL DEFAULT '' COMMENT '显示名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of resource_manager
-- ----------------------------
INSERT INTO `resource_manager` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1473254891', '0', 'caopeng8787@163.com', '0', '后台管理员');
INSERT INTO `resource_manager` VALUES ('2', 'apeng', 'e10adc3949ba59abbe56e057f20f883e', '1473254891', '0', '411104493@qq.com', '1', 'apeng');

-- ----------------------------
-- Table structure for resource_role
-- ----------------------------
DROP TABLE IF EXISTS `resource_role`;
CREATE TABLE `resource_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名',
  `aids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids',
  `aac` text COMMENT '控制器-操作方法',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `mid` int(10) unsigned DEFAULT '0' COMMENT '修改者',
  `updatetime` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  `uid` int(10) unsigned DEFAULT '0' COMMENT '创建者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台角色表';

-- ----------------------------
-- Records of resource_role
-- ----------------------------
INSERT INTO `resource_role` VALUES ('1', '管理专员', '', null, '1474098936', '0', '0', '1');

-- ----------------------------
-- Table structure for resource_techn_article
-- ----------------------------
DROP TABLE IF EXISTS `resource_techn_article`;
CREATE TABLE `resource_techn_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '文章标题',
  `summary` varchar(200) DEFAULT '' COMMENT '文章摘要',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '文章图片',
  `content` text NOT NULL COMMENT '文章内容',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '文章所属分类id',
  `state` tinyint(1) DEFAULT '0' COMMENT '添加状态 0 后台添加 1 前后添加',
  `views` int(11) DEFAULT '0' COMMENT '浏览量',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `mid` int(10) unsigned DEFAULT '0' COMMENT '修改者',
  `updatetime` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  `uuid` int(10) unsigned DEFAULT '0' COMMENT '创建者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='技术文章表';

-- ----------------------------
-- Records of resource_techn_article
-- ----------------------------

-- ----------------------------
-- Table structure for resource_techn_article_cate
-- ----------------------------
DROP TABLE IF EXISTS `resource_techn_article_cate`;
CREATE TABLE `resource_techn_article_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catename` varchar(100) NOT NULL DEFAULT '' COMMENT '文章分类名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '文章分类父ID',
  `path` varchar(255) NOT NULL DEFAULT '0,' COMMENT '全路径',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分类级别',
  `img` varchar(100) NOT NULL DEFAULT '' COMMENT '分类图片',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `uid` int(10) unsigned DEFAULT '0' COMMENT '创建者',
  `updatetime` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  `mid` int(10) unsigned DEFAULT '0' COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='技术文章分类表';

-- ----------------------------
-- Records of resource_techn_article_cate
-- ----------------------------
INSERT INTO `resource_techn_article_cate` VALUES ('1', '设计', '0', '1', '0', '', '1474121898', '1', '0', '0');
INSERT INTO `resource_techn_article_cate` VALUES ('2', '前端', '0', '2', '0', '', '1474121908', '1', '0', '0');
INSERT INTO `resource_techn_article_cate` VALUES ('3', '后端', '0', '3', '0', '', '1474121919', '1', '0', '0');
INSERT INTO `resource_techn_article_cate` VALUES ('4', '运维', '0', '4', '0', '', '1474121930', '1', '0', '0');
INSERT INTO `resource_techn_article_cate` VALUES ('5', '大数据', '0', '5', '0', '', '1474121952', '1', '0', '0');
INSERT INTO `resource_techn_article_cate` VALUES ('6', 'php', '3', '3-6', '1', '', '1474122522', '1', '0', '0');
INSERT INTO `resource_techn_article_cate` VALUES ('7', 'python', '4', '4-7', '1', '', '1474123584', '1', '0', '0');
