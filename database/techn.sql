-- �������±�
CREATE TABLE `resource_techn_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '���±���',
  `summary` varchar(200) DEFAULT NULL DEFAULT '' COMMENT '����ժҪ',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '����ͼƬ',
  `content` text NOT NULL DEFAULT '' COMMENT '��������',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '������������id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Ȩ�޼���',
  `state` tinyint(1) DEFAULT '0' COMMENT '���״̬ 0 ��̨��� 1 ǰ�����',
  `views` int(11) DEFAULT '0' COMMENT '�����',
  `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
  `uid` int unsigned DEFAULT 0 COMMENT '������',
  `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT '�޸���',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='�������±�';

-- �������·����
CREATE TABLE `resource_techn_article_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catename` varchar(100) NOT NULL DEFAULT '' COMMENT '���·�����',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '���·��ุID',
  `path` varchar(255) NOT NULL DEFAULT '0,' COMMENT 'ȫ·��',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '���༶��',
  `img` varchar(100) NOT NULL DEFAULT '' COMMENT '����ͼƬ',
  `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
  `uid` int unsigned DEFAULT 0 COMMENT '������',
  `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT '�޸���',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='�������·����';

--insert into resource_auth(name, pid, controller, action, path, level, addtime, mid) values
--('�������·���', 14, 'TechnArticleCate', 'index', '41', 1, unix_timestamp(), 1),
--('��������', 41, 'TechnArticle', 'index', '41-42', 1, unix_timestamp(), 1);