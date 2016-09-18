-- 回收表
CREATE TABLE `resource_recycle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作者id',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '删除的图片',
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除分类 0 图片 1 资源包',
  `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
  `mid` int unsigned DEFAULT 0 COMMENT '删除者',
  `deltime` int unsigned DEFAULT 0 COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 测试常用删除 自增id清零
delete from `resource_recycle`;
truncate `resource_recycle`;