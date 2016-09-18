-- 操作日志记录表
CREATE TABLE `resource_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '日志内容',
  `controller` varchar(20) NOT NULL DEFAULT '' COMMENT '操作控制器名',
  `action` varchar(20) NOT NULL DEFAULT '' COMMENT '操作方法名',
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '前后台标志 0前台 1后台',
  `rectime` int unsigned DEFAULT 0 COMMENT '日志记录时间',
  `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
  `uid` int unsigned DEFAULT 0 COMMENT '创建者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志记录表';