-- ���ձ�
CREATE TABLE `resource_recycle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '������id',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT 'ɾ����ͼƬ',
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'ɾ������ 0 ͼƬ 1 ��Դ��',
  `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT 'ɾ����',
  `deltime` int unsigned DEFAULT 0 COMMENT 'ɾ��ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ���Գ���ɾ�� ����id����
delete from `resource_recycle`;
truncate `resource_recycle`;