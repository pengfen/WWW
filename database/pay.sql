-- 理财相关表

-- 支付宝收益表
CREATE TABLE `resource_pay` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 3 COMMENT '类型 0 转入 1 转出 3非转入转出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '转入转出金额',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付宝收益表';

-- 黄金收益表
CREATE TABLE `resource_gold` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`hold_gold` decimal(15,4) NOT NULL DEFAULT '0.0' COMMENT '持有黄金',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 3 COMMENT '类型 0 买入 1 卖出 3非转入转出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '买入卖出金额',
	`cost_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '成本',
	`current_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '现价',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='黄金收益表';

-- 指基收益表
CREATE TABLE `resource_index_fund` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`name` varchar(50) NOT NULL DEFAULT '' COMMENT '指基名',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '收益',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`now_worth` decimal(15,4) NOT NULL DEFAULT '0.0' COMMENT '最新净值',
	`hold_lot` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '持有份额',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 3 COMMENT '类型 0 买入 1 卖出 3非转入转出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '买入卖出金额',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明',
	`account_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '账户总收益'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='指基表';
ALTER TABLE `resource_index_fund` 
ADD COLUMN `now_worth` decimal(15,4) NOT NULL DEFAULT '0.0' COMMENT '最新净值';
ALTER TABLE `resource_index_fund` 
ADD COLUMN `hold_lot` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '持有份额';
ALTER TABLE `resource_index_fund` 
ADD COLUMN `type` tinyint(1) unsigned NOT NULL DEFAULT 3 COMMENT '类型 0 买入 1 卖出 3非转入转出';
ALTER TABLE `resource_index_fund` 
ADD COLUMN `money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '买入卖出金额';
ALTER TABLE `resource_index_fund` 
ADD COLUMN `note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明';
ALTER TABLE `resource_index_fund` 
ADD COLUMN `account_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '账户总收益';

-- p2p账号收益表
CREATE TABLE `resource_p2p_account` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='P2P收益表';

ALTER TABLE `resource_share` 
ADD COLUMN

-- p2p平台表
CREATE TABLE `resource_p2p` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`name` varchar(50) NOT NULL DEFAULT '' COMMENT 'p2p平台名',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='P2P收益表';

-- p2p收益表
CREATE TABLE `resource_p2p_revenue` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`name` varchar(50) NOT NULL DEFAULT '' COMMENT 'p2p平台名',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '收益',
	`red_bonus` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '红包收益',
	`other_bonus` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '其它收益',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总金额',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 3 COMMENT '类型 0 加仓 1 减仓 3非转入转出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '加减仓金额',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '说明'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='P2P收益表';


-- 股票账号收益表
CREATE TABLE `resource_share_account` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总资产',
	`total_market_value` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总市值',
	`float_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '浮动盈亏',
	`daily_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '当日盈亏',
	`advisable` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '可用',
	`available` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '可取',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '总收益',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 3 COMMENT '类型 0 转入 1 转出 3非转入转出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '转入转出金额',
	`addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='股票账号表';

-- 股票表
CREATE TABLE `resource_share` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`name` varchar(20) NOT NULL DEFAULT '0.0' COMMENT '股票名',
	`share_code` char(6) NOT NULL DEFAULT '' COMMENT '股票代码',
    `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`isShow` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '是否显示'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='股票表';

ALTER TABLE `resource_share` 
ADD COLUMN `isShow` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '是否显示 0 显示 1不显示';

-- 股票收益表
CREATE TABLE `resource_share_revenue` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`real_market_value` decimal(15, 2) NOT NULL DEFAULT '0.0' COMMENT '实际市值',
	`market_value` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '市值',
	`sid` int unsigned NOT NULL DEFAULT 0 COMMENT '股票ID',
	`daily_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '盈亏',
	`current_rate` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '成交价',
    `volume` int unsigned NOT NULL DEFAULT 1000 COMMENT '成交量',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '类型 0 买入 1 加仓 2 减仓 3 卖出',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '成交金额',
	`closetime` int unsigned DEFAULT 0 COMMENT '成交时间',
    `addtime` int unsigned DEFAULT 0 COMMENT '添加时间',
	`uid` int unsigned DEFAULT 0 COMMENT '所属用户id',
	`cost_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '成本',
	`current_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '现价'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='股票收益表';

ALTER TABLE `resource_share_revenue` 
ADD COLUMN `real_market_value` decimal(15, 2) NOT NULL DEFAULT '0.0' COMMENT '实际市值';
