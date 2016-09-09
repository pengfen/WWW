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
  `uid` int unsigned DEFAULT 0 COMMENT '创建者',
  `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间',
  `mid` int unsigned DEFAULT 0 COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台角色表';

ALTER TABLE `resource_role`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '添加时间' AFTER `aac`;
ALTER TABLE `resource_role`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '创建者';
ALTER TABLE `resource_role`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间';
ALTER TABLE `resource_role`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '修改人';

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
  `uid` int unsigned DEFAULT 0 COMMENT '创建者',
  `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间',
  `mid` int unsigned DEFAULT 0 COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台权限表';

INSERT INTO `data_auth` (`id`, `name`, `pid`, `controller`, `action`, `path`, `level`, `image`) VALUES
(1, '权限管理', 0, '', '', '1', 0, ''),
(2, '权限列表', 1, 'Auth', 'index', '1-2', 1, '');

ALTER TABLE `resource_auth`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '添加时间' AFTER `image`;
ALTER TABLE `resource_auth`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '创建者';
ALTER TABLE `resource_auth`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间';
ALTER TABLE `resource_auth`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '修改人';
ALTER TABLE `resource_auth`
ADD COLUMN `isShow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 0 显示 1 不显示';


INSERT INTO `resource_auth` VALUES ('1', '权限管理', '0', '', '', '1', '0', 'Uploads/2015-09-20/55fea199dc54b.png', '0', '0', '0', '0', '0'),('2', '权限列表', '1', 'Auth', 'index', '1-2', '1', 'Uploads/2015-09-20/55fe7e2c1485f.png', '0', '0', '0', '0', '0'),('3', '管理员列表', '1', 'Manager', 'index', '1-3', '1', 'Uploads/2015-09-12/55f3e4df5f257.png', '0', '0', '0', '0', '0'),('4', '会员管理', '0', '', '', '4', '0', 'Uploads/2015-10-13/561cfe2187ff2.png', '0', '0', '0', '0', '0'),('5', '会员列表', '4', 'User', 'index', '4-5', '1', '', '0', '0', '0', '0', '0'),('6', '目录管理', '0', '', '', '5', '0', 'Uploads/2015-09-12/55f4245783d4e.png', '0', '0', '0', '0', '0'),('7', '后台目录列表', '6', 'Dir', 'index', '5-7', '1', 'Uploads/2015-09-12/55f424dd34473.png', '0', '0', '0', '0', '0'),('10', '目录关联列表', '6', 'Assoc', 'index', '5-10', '1', 'Uploads/2015-09-12/55f4249b4acf4.png', '0', '0', '0', '0', '0'),('11', '方法逻辑列表', '6', 'Logic', 'index', '5-11', '1', 'Uploads/2015-09-12/55f424afb57dc.png', '0', '0', '0', '0', '0'),('12', '项目记录列表', '6', 'Project', 'index', '5-12', '1', 'Uploads/2015-09-12/55f424ca1470d.png', '0', '0', '0', '0', '0'),('13', '角色列表', '1', 'Role', 'index', '1-13', '1', 'Uploads/2015-09-12/55f3e4995016d.png', '0', '0', '0', '0', '0'),('14', '资料管理', '0', '', '', '14', '0', 'Uploads/2015-09-13/55f51aa09ab1b.png', '0', '0', '0', '0', '0'),('15', '技术分类', '24', 'Categorys', 'index', '24-15', '1', 'Uploads/2015-09-13/55f51abddbcec.png', '0', '0', '0', '0', '0'),('16', '课程列表', '34', 'Lesson', 'index', '34-16', '1', 'Uploads/2015-09-13/55f51ad91d546.png', '0', '0', '0', '0', '0'),('17', '功能列表', '14', 'Function', 'index', '14-17', '1', 'Uploads/2015-09-13/55f51aefefda6.png', '0', '0', '0', '0', '1'),('18', '关联页', '14', 'AssocPage', 'index', '14-18', '1', 'Uploads/2015-09-13/55f4bd42aef12.png', '0', '0', '0', '0', '1'),('19', '模块列表', '14', 'Module', 'index', '14-19', '1', 'Uploads/2015-09-13/55f51b0dddb17.png', '0', '0', '0', '0', '1'),('20', '实例列表', '14', 'Instance', 'index', '14-20', '1', 'Uploads/2015-09-13/55f51b2075bcc.png', '0', '0', '0', '0', '1'),('21', '页面管理', '0', '', '', '21', '0', 'Uploads/2015-09-27/560741556e5fd.png', '0', '0', '0', '0', '0'),('22', '逻辑列表', '21', 'BusinessLogic', 'index', '21-22', '1', 'Uploads/2015-09-25/56054957d4b2d.png', '0', '0', '0', '0', '0'),('23', '导航列表', '21', 'Nav', 'index', '21-23', '1', '', '0', '0', '0', '0', '0'),('24', '分类管理', '0', '', '', '24', '0', 'Uploads/2015-09-20/55fe08fe3ae2a.png', '0', '0', '0', '0', '0'),('25', '技术方向列表', '24', 'Direct', 'index', '24-25', '1', '', '0', '0', '0', '0', '0'),('26', '难度列表', '24', 'Difficult', 'index', '24-26', '1', '', '0', '0', '0', '0', '0'),('27', '实现及bug管理', '0', '', '', '27', '0', '', '0', '0', '0', '0', '0'),('28', '功能实现列表', '27', 'Realize', 'index', '27-28', '1', '', '0', '0', '0', '0', '0'),('29', '开发团队列表', '27', 'Develop', 'index', '27-29', '1', '', '0', '0', '0', '0', '0'),('30', 'bug 列表', '27', 'Bug', 'index', '27-30', '1', '', '0', '0', '0', '0', '0'),('31', '回收站管理', '0', '', '', '31', '0', '', '0', '0', '0', '0', '0'),('32', '图片回收列表', '31', 'ImageRecycle', 'index', '31-32', '1', '', '0', '0', '0', '0', '0'),('34', '课程管理', '0', '', '', '34', '0', 'Uploads/2015-09-21/55fffd6d53b09.png', '0', '0', '0', '0', '0'),('35', '用户关联课程列表', '34', 'UserLesson', 'index', '34-35', '1', '', '0', '0', '0', '0', '0'),('36', '课程评论列表', '34', 'LessonComment', 'index', '34-36', '1', '', '0', '0', '0', '0', '0'),('37', '课程笔记列表', '34', 'LessonNote', 'index', '34-37', '1', '', '0', '0', '0', '0', '0'),('38', '技术文章分类', '14', 'TechnArticleCate', 'index', '14-38', '1', '', '1473230029', '1', '0', '0', '0'),('39', '技术文章', '14', 'TechnArticle', 'index', '14-39', '1', '', '1473230029', '1', '0', '0', '0');