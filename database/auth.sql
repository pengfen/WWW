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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='����Ա��';

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
  `uid` int unsigned DEFAULT 0 COMMENT '������',
  `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT '�޸���',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='��̨��ɫ��';

ALTER TABLE `resource_role`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��' AFTER `aac`;
ALTER TABLE `resource_role`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '������';
ALTER TABLE `resource_role`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��';
ALTER TABLE `resource_role`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '�޸���';

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
  `isShow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '�Ƿ���ʾ 0 ��ʾ 1 ����ʾ',
  `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��',
  `uid` int unsigned DEFAULT 0 COMMENT '������',
  `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��',
  `mid` int unsigned DEFAULT 0 COMMENT '�޸���',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='��̨Ȩ�ޱ�';

INSERT INTO `data_auth` (`id`, `name`, `pid`, `controller`, `action`, `path`, `level`, `image`) VALUES
(1, 'Ȩ�޹���', 0, '', '', '1', 0, ''),
(2, 'Ȩ���б�', 1, 'Auth', 'index', '1-2', 1, '');

ALTER TABLE `resource_auth`
ADD COLUMN `addtime` int unsigned DEFAULT 0 COMMENT '���ʱ��' AFTER `image`;
ALTER TABLE `resource_auth`
ADD COLUMN `uid` int unsigned DEFAULT 0 COMMENT '������';
ALTER TABLE `resource_auth`
ADD COLUMN `updatetime` int unsigned DEFAULT 0 COMMENT '�޸�ʱ��';
ALTER TABLE `resource_auth`
ADD COLUMN `mid` int unsigned DEFAULT 0 COMMENT '�޸���';
ALTER TABLE `resource_auth`
ADD COLUMN `isShow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '�Ƿ���ʾ 0 ��ʾ 1 ����ʾ';


INSERT INTO `resource_auth` VALUES ('1', 'Ȩ�޹���', '0', '', '', '1', '0', 'Uploads/2015-09-20/55fea199dc54b.png', '0', '0', '0', '0', '0'),('2', 'Ȩ���б�', '1', 'Auth', 'index', '1-2', '1', 'Uploads/2015-09-20/55fe7e2c1485f.png', '0', '0', '0', '0', '0'),('3', '����Ա�б�', '1', 'Manager', 'index', '1-3', '1', 'Uploads/2015-09-12/55f3e4df5f257.png', '0', '0', '0', '0', '0'),('4', '��Ա����', '0', '', '', '4', '0', 'Uploads/2015-10-13/561cfe2187ff2.png', '0', '0', '0', '0', '0'),('5', '��Ա�б�', '4', 'User', 'index', '4-5', '1', '', '0', '0', '0', '0', '0'),('6', 'Ŀ¼����', '0', '', '', '5', '0', 'Uploads/2015-09-12/55f4245783d4e.png', '0', '0', '0', '0', '0'),('7', '��̨Ŀ¼�б�', '6', 'Dir', 'index', '5-7', '1', 'Uploads/2015-09-12/55f424dd34473.png', '0', '0', '0', '0', '0'),('10', 'Ŀ¼�����б�', '6', 'Assoc', 'index', '5-10', '1', 'Uploads/2015-09-12/55f4249b4acf4.png', '0', '0', '0', '0', '0'),('11', '�����߼��б�', '6', 'Logic', 'index', '5-11', '1', 'Uploads/2015-09-12/55f424afb57dc.png', '0', '0', '0', '0', '0'),('12', '��Ŀ��¼�б�', '6', 'Project', 'index', '5-12', '1', 'Uploads/2015-09-12/55f424ca1470d.png', '0', '0', '0', '0', '0'),('13', '��ɫ�б�', '1', 'Role', 'index', '1-13', '1', 'Uploads/2015-09-12/55f3e4995016d.png', '0', '0', '0', '0', '0'),('14', '���Ϲ���', '0', '', '', '14', '0', 'Uploads/2015-09-13/55f51aa09ab1b.png', '0', '0', '0', '0', '0'),('15', '��������', '24', 'Categorys', 'index', '24-15', '1', 'Uploads/2015-09-13/55f51abddbcec.png', '0', '0', '0', '0', '0'),('16', '�γ��б�', '34', 'Lesson', 'index', '34-16', '1', 'Uploads/2015-09-13/55f51ad91d546.png', '0', '0', '0', '0', '0'),('17', '�����б�', '14', 'Function', 'index', '14-17', '1', 'Uploads/2015-09-13/55f51aefefda6.png', '0', '0', '0', '0', '1'),('18', '����ҳ', '14', 'AssocPage', 'index', '14-18', '1', 'Uploads/2015-09-13/55f4bd42aef12.png', '0', '0', '0', '0', '1'),('19', 'ģ���б�', '14', 'Module', 'index', '14-19', '1', 'Uploads/2015-09-13/55f51b0dddb17.png', '0', '0', '0', '0', '1'),('20', 'ʵ���б�', '14', 'Instance', 'index', '14-20', '1', 'Uploads/2015-09-13/55f51b2075bcc.png', '0', '0', '0', '0', '1'),('21', 'ҳ�����', '0', '', '', '21', '0', 'Uploads/2015-09-27/560741556e5fd.png', '0', '0', '0', '0', '0'),('22', '�߼��б�', '21', 'BusinessLogic', 'index', '21-22', '1', 'Uploads/2015-09-25/56054957d4b2d.png', '0', '0', '0', '0', '0'),('23', '�����б�', '21', 'Nav', 'index', '21-23', '1', '', '0', '0', '0', '0', '0'),('24', '�������', '0', '', '', '24', '0', 'Uploads/2015-09-20/55fe08fe3ae2a.png', '0', '0', '0', '0', '0'),('25', '���������б�', '24', 'Direct', 'index', '24-25', '1', '', '0', '0', '0', '0', '0'),('26', '�Ѷ��б�', '24', 'Difficult', 'index', '24-26', '1', '', '0', '0', '0', '0', '0'),('27', 'ʵ�ּ�bug����', '0', '', '', '27', '0', '', '0', '0', '0', '0', '0'),('28', '����ʵ���б�', '27', 'Realize', 'index', '27-28', '1', '', '0', '0', '0', '0', '0'),('29', '�����Ŷ��б�', '27', 'Develop', 'index', '27-29', '1', '', '0', '0', '0', '0', '0'),('30', 'bug �б�', '27', 'Bug', 'index', '27-30', '1', '', '0', '0', '0', '0', '0'),('31', '����վ����', '0', '', '', '31', '0', '', '0', '0', '0', '0', '0'),('32', 'ͼƬ�����б�', '31', 'ImageRecycle', 'index', '31-32', '1', '', '0', '0', '0', '0', '0'),('34', '�γ̹���', '0', '', '', '34', '0', 'Uploads/2015-09-21/55fffd6d53b09.png', '0', '0', '0', '0', '0'),('35', '�û������γ��б�', '34', 'UserLesson', 'index', '34-35', '1', '', '0', '0', '0', '0', '0'),('36', '�γ������б�', '34', 'LessonComment', 'index', '34-36', '1', '', '0', '0', '0', '0', '0'),('37', '�γ̱ʼ��б�', '34', 'LessonNote', 'index', '34-37', '1', '', '0', '0', '0', '0', '0'),('38', '�������·���', '14', 'TechnArticleCate', 'index', '14-38', '1', '', '1473230029', '1', '0', '0', '0'),('39', '��������', '14', 'TechnArticle', 'index', '14-39', '1', '', '1473230029', '1', '0', '0', '0');