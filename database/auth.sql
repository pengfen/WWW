-- Ȩ�޿���ϵͳ manager role auth

-- ����Ա��
CREATE TABLE IF NOT EXISTS `resource_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '��������',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '��������',
  `regtime` int(10) unsigned DEFAULT 0 COMMENT 'ע��ʱ��',
  `logtime` int(10) unsigned DEFAULT 0 COMMENT '��¼ʱ��',
  `email` varchar(30) DEFAULT NULL COMMENT '����',
  `rid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '��ɫid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `resource_manager` (`id`, `username`, `password`, `regtime`, `logtime`, `email`, `rid`) VALUES
(1, 'admin', password(123456), unix_timestamp(), 0, 'caopeng8787@163.com', 0),
(2, 'apeng', 'e10adc3949ba59abbe56e057f20f883e', unix_timestamp(), 0, '411104493@qq.com', 1);

-- ��ɫ��
CREATE TABLE IF NOT EXISTS `resource_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '��ɫ��',
  `aids` varchar(128) NOT NULL DEFAULT '' COMMENT 'Ȩ��ids',
  `aac` text COMMENT '������-��������',
  `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT '������',
  `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��',
  `uid` int unsigned DEFAULT 0 COMMENT '�޸���',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE `resource_role`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��' AFTER `aac`;
ALTER TABLE `resource_role`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '������';
ALTER TABLE `resource_role`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��';
ALTER TABLE `resource_role`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '�޸���';

-- Ȩ�ޱ�
CREATE TABLE IF NOT EXISTS `resource_auth` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT 'Ȩ����',
  `pid` smallint(6) NOT NULL DEFAULT '0' COMMENT '��id',
  `controller` varchar(32) NOT NULL DEFAULT '' COMMENT '������',
  `action` varchar(32) NOT NULL DEFAULT '' COMMENT '��������',
  `path` varchar(32) NOT NULL DEFAULT '' COMMENT 'ȫ·��',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Ȩ�޼���',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ȩ�޹���ͼ',
  `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT '������',
  `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��',
  `uid` int unsigned DEFAULT 0 COMMENT '�޸���',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `data_auth` (`id`, `name`, `pid`, `controller`, `action`, `path`, `level`, `image`) VALUES
(1, 'Ȩ�޹���', 0, '', '', '1', 0, ''),
(2, 'Ȩ���б�', 1, 'Auth', 'index', '1-2', 1, '');

ALTER TABLE `resource_auth`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��' AFTER `image`;
ALTER TABLE `resource_auth`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '������';
ALTER TABLE `resource_auth`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��';
ALTER TABLE `resource_auth`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '�޸���';