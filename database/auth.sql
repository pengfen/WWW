-- 权限控制系统 manager role auth

-- 管理员表
CREATE TABLE IF NOT EXISTS `resource_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '管理名称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '管理密码',
  `regtime` int(10) unsigned DEFAULT 0 COMMENT '注册时间',
  `logtime` int(10) unsigned DEFAULT 0 COMMENT '登录时间',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `rid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表';

INSERT INTO `resource_manager` (`id`, `username`, `password`, `regtime`, `logtime`, `email`, `rid`) VALUES
(1, 'admin', password(123456), unix_timestamp(), 0, 'caopeng8787@163.com', 0),
(2, 'apeng', 'e10adc3949ba59abbe56e057f20f883e', unix_timestamp(), 0, '411104493@qq.com', 1);

-- 角色表
CREATE TABLE IF NOT EXISTS `resource_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名',
  `aids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids',
  `aac` text COMMENT '控制器-操作方法',
  `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
  `mid` int unsigned DEFAULT 0 COMMENT '创建者',
  `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间',
  `uid` int unsigned DEFAULT 0 COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台角色表';

ALTER TABLE `resource_role`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '添加时间' AFTER `aac`;
ALTER TABLE `resource_role`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '创建者';
ALTER TABLE `resource_role`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间';
ALTER TABLE `resource_role`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '修改人';

-- 权限表
CREATE TABLE IF NOT EXISTS `resource_auth` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '权限名',
  `pid` smallint(6) NOT NULL DEFAULT '0' COMMENT '父id',
  `controller` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `path` varchar(32) NOT NULL DEFAULT '' COMMENT '全路径',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '权限关联图',
  `isShow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 0 显示 1 不显示',
  `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
  `mid` int unsigned DEFAULT 0 COMMENT '创建者',
  `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间',
  `uid` int unsigned DEFAULT 0 COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台权限表';

INSERT INTO `data_auth` (`id`, `name`, `pid`, `controller`, `action`, `path`, `level`, `image`) VALUES
(1, '权限管理', 0, '', '', '1', 0, ''),
(2, '权限列表', 1, 'Auth', 'index', '1-2', 1, '');

ALTER TABLE `resource_auth`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '添加时间' AFTER `image`;
ALTER TABLE `resource_auth`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '创建者';
ALTER TABLE `resource_auth`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间';
ALTER TABLE `resource_auth`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '修改人';
ALTER TABLE `resource_auth`
ADD COLUMN `isShow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 0 显示 1 不显示',