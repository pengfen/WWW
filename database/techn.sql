-- 技术文章表
CREATE TABLE `resource_techn_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '文章标题',
  `summary` varchar(200) DEFAULT NULL DEFAULT '' COMMENT '文章摘要',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '文章图片',
  `content` text NOT NULL DEFAULT '' COMMENT '文章内容',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '文章所属分类id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  `state` tinyint(1) DEFAULT '0' COMMENT '添加状态 0 后台添加 1 前后添加',
  `views` int(11) DEFAULT '0' COMMENT '浏览量',
  `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
  `uid` int unsigned DEFAULT 0 COMMENT '创建者',
  `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间',
  `mid` int unsigned DEFAULT 0 COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='技术文章表';

-- 技术文章分类表
CREATE TABLE `resource_techn_article_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catename` varchar(100) NOT NULL DEFAULT '' COMMENT '文章分类名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '文章分类父ID',
  `path` varchar(255) NOT NULL DEFAULT '0,' COMMENT '全路径',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分类级别',
  `img` varchar(100) NOT NULL DEFAULT '' COMMENT '分类图片',
  `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
  `uid` int unsigned DEFAULT 0 COMMENT '创建者',
  `updatetime` int unsigned DEFAULT 0 COMMENT '修改时间',
  `mid` int unsigned DEFAULT 0 COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='技术文章分类表';

--insert into resource_auth(name, pid, controller, action, path, level, addtime, mid) values
--('技术文章分类', 14, 'TechnArticleCate', 'index', '41', 1, unix_timestamp(), 1),
--('技术文章', 41, 'TechnArticle', 'index', '41-42', 1, unix_timestamp(), 1);