-- �����ر�

-- ֧���������
CREATE TABLE `resource_pay` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�ܽ��',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '����',
	`addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
	`uid` int unsigned DEFAULT 0 COMMENT '�����û�id',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '���� 0 ת�� 1 ת��',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT 'ת��ת�����',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '˵��',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '������'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='֧���������';

-- p2p�����
CREATE TABLE `resource_p2p` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`name` varchar(50) NOT NULL DEFAULT '' COMMENT 'p2pƽ̨��',
	`revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '����',
	`red_bonus` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�������',
	`other_bonus` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '��������',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '������',
	`addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
	`uid` int unsigned DEFAULT 0 COMMENT '�����û�id',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�ܽ��',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '���� 0 �Ӳ� 1 ����',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�Ӽ��ֽ��',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '˵��'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='P2P�����';

-- ��Ʊ�˺ű�
CREATE TABLE `resource_share_account` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`sid` varchar(255) NOT NULL DEFAULT '' COMMENT '��Ʊ�����id',
	`amount` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '���ʲ�',
	`total_marker_value` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '����ֵ',
	`float_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '����ӯ��',
	`daily_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '����ӯ��',
	`addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
	`uid` int unsigned DEFAULT 0 COMMENT '�����û�id',
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='��Ʊ�˺ű�';

-- ��Ʊ�����
CREATE TABLE `resource_share` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`marker_value` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '��ֵ',
	`name` varchar(20) NOT NULL DEFAULT '0.0' COMMENT '��Ʊ��',
	`share_code` char(6) NOT NULL DEFAULT '' COMMENT '��Ʊ����',
	`daily_pl` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT 'ӯ��',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '���� 0 �Ӳ� 1 ����',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�Ӽ��ֽ��',
    `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
	`uid` int unsigned DEFAULT 0 COMMENT '�����û�id',
	`cost_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�ɱ�',
	`current_price` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�ּ�',
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='��Ʊ�����';

-- �ƽ������
CREATE TABLE `resource_gold` (
    `id` int unsigned NOT NULL AUTO_INCREMENT primary key,
	`amount` decimal(15,2) NOT NULL '0.0' COMMENT '�ܽ��',
	`revenue` decimal(15,2) NOT NULL '0.0' COMMENT '����',
	`addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
	`uid` int unsigned DEFAULT 0 COMMENT '�����û�id',
	`hold_gold` decimal(15,4) NOT NULL '0.0' COMMENT '���лƽ�',
	`type` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '���� 0 �Ӳ� 1 ����',
	`money` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '�Ӽ��ֽ��',
	`note` varchar(255) NOT NULL DEFAULT '' COMMENT '˵��',
	`total_revenue` decimal(15,2) NOT NULL DEFAULT '0.0' COMMENT '������'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='�ƽ������';
