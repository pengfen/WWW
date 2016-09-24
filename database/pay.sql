-- 理财相关表

-- 支付宝收益表
CREATE TABLE `resource_pay` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '类型 0 转入 1 转出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '转入转出金额',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付宝收益表';

-- p2p收益表
CREATE TABLE `resource_p2p` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`name` varchar(50) NOT NULL DEFAULT '' COMMENT 'p2p平台名',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '收益',
	`red_bonus` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '红包收益',
	`other_bonus` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '其它收益',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '类型 0 加仓 1 减仓',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '加减仓金额',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='P2P收益表';

-- 股票账号表
CREATE TABLE `resource_share_account` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`sid` varchar(255) NOT NULL DEFAULT '' COMMENT '股票收益表id',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总资产',
	`total_marker_value` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总市值',
	`float_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '浮动盈亏',
	`daily_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '当日盈亏',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='股票账号表';

-- 股票收益表
CREATE TABLE `resource_share` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`marker_value` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '市值',
	`name` varchar(20) NOT NULL DEFAULT '0.0' COMMENT '股票名',
	`share_code` char(6) NOT NULL DEFAULT '' COMMENT '股票代码',
	`daily_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '盈亏',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '类型 0 加仓 1 减仓',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '加减仓金额',
    `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`cost_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '成本',
	`current_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '现价',
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='股票收益表';

-- 黄金收益表
CREATE TABLE `resource_gold` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL '0.0' COMMENT '总金额',
	`revenue` decimal(15,2) NOT NULL '0.0' COMMENT '收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`hold_gold` decimal(15,4) NOT NULL '0.0' COMMENT '持有黄金',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '类型 0 加仓 1 减仓',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '加减仓金额',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='黄金收益表';
