# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28-log)
# Database: phpcms
# Generation Time: 2013-07-09 15:35:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `phpssouid` mediumint(8) unsigned NOT NULL COMMENT 'phpsso用户id',
  `username` char(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `encrypt` char(6) NOT NULL DEFAULT '' COMMENT '随机码',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `regip` char(15) NOT NULL DEFAULT '' COMMENT '注册IP',
  `lastip` char(15) NOT NULL DEFAULT '' COMMENT '上次登录ip',
  `loginnum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `areaid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '地区id',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '金钱总额',
  `point` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `message` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有短消息',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否定锁',
  `vip` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'vip等级',
  `overduedate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'vip过期时间',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '会员来源站点id',
  `connectid` char(35) NOT NULL DEFAULT '' COMMENT '备注',
  `from` char(10) NOT NULL DEFAULT '' COMMENT '来源',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`(20)),
  KEY `phpssouid` (`phpssouid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;

INSERT INTO `member` (`userid`, `phpssouid`, `username`, `password`, `encrypt`, `nickname`, `regdate`, `lastdate`, `regip`, `lastip`, `loginnum`, `email`, `groupid`, `areaid`, `amount`, `point`, `modelid`, `message`, `islock`, `vip`, `overduedate`, `siteid`, `connectid`, `from`)
VALUES
	(1,1,'test','edc55b7d7cc5ecf3da925e7bb7d3a4da','SWM6S4','',1373294137,1373294137,'127.0.0.1','',0,'99@qq.com',9,0,0.00,0,10,0,0,0,0,1,'',''),
	(3,3,'wxh','e4900ebc6aaec865de4fa57fcb54746e','k2Tp1t','wxh',1373299143,1373300174,'127.0.0.1','127.0.0.1',0,'hzhihu@gmail.com',9,0,0.00,0,10,0,0,0,0,1,'','');

/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_ integral_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_ integral_history`;

CREATE TABLE `member_ integral_history` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员ID',
  `from_type` varchar(50) NOT NULL DEFAULT '' COMMENT '积分来源类型',
  `integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `date_time` timestamp NULL DEFAULT NULL COMMENT '积分交易时间',
  `total_integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当前会员的总积分',
  `desc` varchar(100) DEFAULT NULL COMMENT '交易说明信息',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员积分交易明细';



# Dump of table member_address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_address`;

CREATE TABLE `member_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `truename` char(40) NOT NULL DEFAULT '' COMMENT '用户真实名字',
  `province` char(40) NOT NULL DEFAULT '0' COMMENT '国家',
  `address` char(255) NOT NULL DEFAULT '' COMMENT '常用联系地址',
  `mobile` char(13) NOT NULL DEFAULT '' COMMENT '手机',
  `telephone` char(15) NOT NULL DEFAULT '' COMMENT '电话',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `code` mediumint(6) unsigned NOT NULL COMMENT '邮政编码',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员联系地址表';



# Dump of table member_amount
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_amount`;

CREATE TABLE `member_amount` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '会员账户总额',
  `balance` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '会员账户可用余额',
  `freeze` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '会员冻结账户余额',
  `wait_money` decimal(10,3) DEFAULT NULL COMMENT '会员待收金额',
  `wait_interest` decimal(10,3) DEFAULT NULL COMMENT '会员待收利息',
  `reward` decimal(10,3) DEFAULT NULL COMMENT '会员投标奖励金额',
  `repayment` decimal(10,3) DEFAULT NULL COMMENT '会员待还金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员资产管理表';



# Dump of table member_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_detail`;

CREATE TABLE `member_detail` (
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `account` varchar(255) NOT NULL DEFAULT '' COMMENT '账号',
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员详细信息表';

LOCK TABLES `member_detail` WRITE;
/*!40000 ALTER TABLE `member_detail` DISABLE KEYS */;

INSERT INTO `member_detail` (`userid`, `birthday`, `account`)
VALUES
	(1,NULL,''),
	(3,'0000-00-00','2222');

/*!40000 ALTER TABLE `member_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_group`;

CREATE TABLE `member_group` (
  `groupid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组id',
  `name` char(15) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否系统会员组',
  `starnum` tinyint(2) unsigned NOT NULL COMMENT '会员组星星数',
  `point` smallint(6) unsigned NOT NULL COMMENT '积分范围',
  `allowmessage` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '许允发短消息数量',
  `allowvisit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许访问',
  `allowpost` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发稿',
  `allowpostverify` tinyint(1) unsigned NOT NULL COMMENT '是否投稿不需审核',
  `allowsearch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许搜索',
  `allowupgrade` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许自主升级',
  `allowsendmessage` tinyint(1) unsigned NOT NULL COMMENT '允许发送短消息',
  `allowpostnum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '每天允许发文章数',
  `allowattachment` tinyint(1) NOT NULL COMMENT '是否允许上传附件',
  `price_y` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '包年价格',
  `price_m` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '包月价格',
  `price_d` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '包天价格',
  `icon` char(30) NOT NULL DEFAULT '' COMMENT '用户组图标',
  `usernamecolor` char(7) NOT NULL DEFAULT '' COMMENT '用户名颜色',
  `description` char(100) NOT NULL DEFAULT '' COMMENT '描述',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`groupid`),
  KEY `disabled` (`disabled`),
  KEY `listorder` (`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组表';

LOCK TABLES `member_group` WRITE;
/*!40000 ALTER TABLE `member_group` DISABLE KEYS */;

INSERT INTO `member_group` (`groupid`, `name`, `issystem`, `starnum`, `point`, `allowmessage`, `allowvisit`, `allowpost`, `allowpostverify`, `allowsearch`, `allowupgrade`, `allowsendmessage`, `allowpostnum`, `allowattachment`, `price_y`, `price_m`, `price_d`, `icon`, `usernamecolor`, `description`, `sort`, `disabled`)
VALUES
	(8,'游客',1,0,0,0,0,0,0,1,0,0,0,0,0.00,0.00,0.00,'','','',0,0),
	(2,'新手上路',1,1,50,100,1,1,0,0,0,1,0,0,50.00,10.00,1.00,'','','',2,0),
	(6,'注册会员',1,2,100,150,0,1,0,0,1,1,0,0,300.00,30.00,1.00,'','','',6,0),
	(4,'中级会员',1,3,150,500,1,1,0,1,1,1,0,0,500.00,60.00,1.00,'','','',4,0),
	(5,'高级会员',1,5,300,999,1,1,0,1,1,1,0,0,360.00,90.00,5.00,'','','',5,0),
	(1,'禁止访问',1,0,0,0,0,1,0,1,0,0,0,0,0.00,0.00,0.00,'','','0',0,0),
	(7,'邮件认证',1,0,0,0,0,0,0,0,0,0,0,0,0.00,0.00,0.00,'images/group/vip.jpg','#000000','',7,0),
	(9,'test',0,1,1,0,0,0,0,0,0,0,0,0,0.00,0.00,0.00,'images/group/vip.jpg','#000000','',0,0);

/*!40000 ALTER TABLE `member_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_menu`;

CREATE TABLE `member_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '识标id',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '菜单名',
  `parentid` smallint(6) NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `m` char(20) NOT NULL DEFAULT '' COMMENT '所属模型',
  `c` char(20) NOT NULL DEFAULT '' COMMENT '所属控制器',
  `a` char(20) NOT NULL DEFAULT '' COMMENT '所属action',
  `data` char(100) NOT NULL DEFAULT '' COMMENT '附加数据',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `display` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否可见',
  `isurl` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否是外部链接',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '外部链接地址',
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`a`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员前台菜单表';

LOCK TABLES `member_menu` WRITE;
/*!40000 ALTER TABLE `member_menu` DISABLE KEYS */;

INSERT INTO `member_menu` (`id`, `name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`, `isurl`, `url`)
VALUES
	(1,'member_init',0,'member','index','init','t=0',0,'1','',''),
	(2,'account_manage',0,'member','index','account_manage','t=1',0,'1','',''),
	(3,'favorite',0,'member','index','favorite','t=2',0,'1','',''),
	(4,'business_centre',0,'yp','business','init','t=3',4,'1','0','');

/*!40000 ALTER TABLE `member_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_order_his
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_order_his`;

CREATE TABLE `member_order_his` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned DEFAULT NULL COMMENT '会员ID',
  `username` char(10) NOT NULL DEFAULT '' COMMENT '会员名',
  `account` char(10) DEFAULT NULL COMMENT '会员账号',
  `type` tinyint(1) NOT NULL COMMENT '资金收还是出，1为收，0为出',
  `total_money` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '金额',
  `old_amount_money` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '之前账号总金额',
  `new_amout_money` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '之后账号总金额',
  `now_balance` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '当前的可用金额',
  `now_freeze` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '当前冻结的金额',
  `trade_man` varchar(50) DEFAULT '' COMMENT '交易人',
  `trade_desc` varchar(100) DEFAULT NULL COMMENT '交易备注',
  `trade_time` timestamp NULL DEFAULT NULL COMMENT '交易时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员资金记录表';



# Dump of table member_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_type`;

CREATE TABLE `member_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `desc` varchar(250) DEFAULT NULL COMMENT '详细信息',
  `sort` tinyint(3) unsigned DEFAULT '0' COMMENT '排序',
  `disable` tinyint(1) unsigned DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `disable` (`disable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台会员页面对应的的模块';

LOCK TABLES `member_type` WRITE;
/*!40000 ALTER TABLE `member_type` DISABLE KEYS */;

INSERT INTO `member_type` (`id`, `name`, `desc`, `sort`, `disable`)
VALUES
	(8,'个人详细资料','个人详细资料',1,1),
	(9,'我的基本信息','我的基本信息',0,1),
	(10,'房产资料','房产资料',2,1),
	(11,'单位资料','单位资料',3,1),
	(12,'私营业主资料','私营业主资料',4,1),
	(13,'财务状况','财务状况',5,1),
	(14,'联系方式','联系方式',6,1),
	(15,'配偶资料','配偶资料',7,1),
	(16,'教育背景','教育背景',8,1),
	(17,'工作经历','工作经历',9,1),
	(18,'其它信息','其它信息',10,1);

/*!40000 ALTER TABLE `member_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_verify
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_verify`;

CREATE TABLE `member_verify` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `encrypt` char(6) NOT NULL DEFAULT '' COMMENT '随机数',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `regdate` int(10) unsigned NOT NULL COMMENT '注册时间',
  `regip` char(15) NOT NULL DEFAULT '' COMMENT '注册IP',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '邮箱 ',
  `modelid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '所属模型ID',
  `point` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '默认点数',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '默认钱金额',
  `modelinfo` char(255) NOT NULL DEFAULT '0' COMMENT '模型详细 信息',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态{5:用户名已存在;4:拒绝;3:删除:2:忽略;0:未审核;1:通过}',
  `siteid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '所属站点id',
  `message` char(100) DEFAULT NULL COMMENT '审核信息',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`(20))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员审核表';



# Dump of table member_vip
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_vip`;

CREATE TABLE `member_vip` (
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='vip会员对应表';



# Dump of table model
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model`;

CREATE TABLE `model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型id',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '名称',
  `description` char(100) NOT NULL DEFAULT '' COMMENT '描述',
  `tablename` char(20) NOT NULL DEFAULT '' COMMENT '表名',
  `setting` text NOT NULL COMMENT '配置信息',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `items` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '信息数',
  `enablesearch` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启全站搜索',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用 1 禁用',
  `default_style` char(30) NOT NULL DEFAULT '' COMMENT '风格',
  `category_template` char(30) NOT NULL DEFAULT '' COMMENT '栏目模板',
  `list_template` char(30) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `show_template` char(30) NOT NULL DEFAULT '' COMMENT '内容页模板',
  `js_template` varchar(30) NOT NULL DEFAULT '' COMMENT 'js模板',
  `reg_view` tinyint(1) unsigned DEFAULT '1' COMMENT '是否前台显示',
  `sort` tinyint(3) NOT NULL COMMENT '排序',
  `type` tinyint(1) NOT NULL COMMENT '模块标识',
  PRIMARY KEY (`modelid`),
  KEY `type` (`type`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型表';

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;

INSERT INTO `model` (`modelid`, `siteid`, `name`, `description`, `tablename`, `setting`, `addtime`, `items`, `enablesearch`, `disabled`, `default_style`, `category_template`, `list_template`, `show_template`, `js_template`, `reg_view`, `sort`, `type`)
VALUES
	(1,1,'文章模型','','news','',0,0,1,0,'default','category','list','show','',1,0,0),
	(2,1,'下载模型','','download','',0,0,1,0,'default','category_download','list_download','show_download','',1,0,0),
	(3,1,'图片模型','','picture','',0,0,1,0,'default','category_picture','list_picture','show_picture','',1,0,0),
	(10,1,'会员模型','会员模型','member_detail','',0,0,1,0,'','','','','',0,0,2),
	(11,1,'企业库','企业会员','yp_company','array (\n  \'ismenu\' => \'0\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n)',1373201196,0,1,0,'','','','','',1,0,4),
	(12,1,'新闻','','yp_news','array (\n  \'ismenu\' => \'0\',\n  \'meta_title\' => \'中国最全的黄页信息\',\n  \'meta_keywords\' => \'中国最全的黄页信息\',\n  \'meta_description\' => \'中国最全的黄页信息\',\n)',1373201196,0,1,0,'','','','','',1,0,5),
	(13,1,'产品','','yp_product','array (\n  \'ismenu\' => \'1\',\n  \'meta_title\' => \'品牌正品 商城保障\',\n  \'meta_keywords\' => \'C2C,购物平台,正品保障\',\n  \'meta_description\' => \'亚洲最大网上购物网站——打造的在线B2C购物平台（B2C，Business to Customer）。在商城购物，享受100%正品保障、7天退换货、提供发票的服务。加入商城，将为全新的B2C事业创造更多的奇迹。\',\n)',1373201196,0,1,0,'','model_product','list_product','show_product','',1,0,5),
	(14,1,'商机','','yp_buy','array (\n  \'ismenu\' => \'1\',\n  \'meta_title\' => \'品牌正品 商城保障\',\n  \'meta_keywords\' => \'C2C,购物平台,正品保障\',\n  \'meta_description\' => \'亚洲最大网上购物网站——打造的在线B2C购物平台（B2C，Business to Customer）。在商城购物，享受100%正品保障、7天退换货、提供发票的服务。加入商城，将为全新的B2C事业创造更多的奇迹。\',\n)',1373201196,0,1,0,'','model_buy','list_buy','show_buy','',1,0,5);

/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table model_field
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_field`;

CREATE TABLE `model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '字段id',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `field` varchar(20) NOT NULL DEFAULT '' COMMENT '字段英文',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `tips` text NOT NULL COMMENT '表单提示',
  `css` varchar(30) NOT NULL DEFAULT '' COMMENT '样式',
  `minlength` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最小值',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最大值',
  `pattern` varchar(255) NOT NULL DEFAULT '' COMMENT '正则',
  `errortips` varchar(255) NOT NULL DEFAULT '' COMMENT '错误提示',
  `formtype` varchar(20) NOT NULL DEFAULT '' COMMENT '表单类别',
  `mtype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '所属于模型分类',
  `setting` mediumtext NOT NULL COMMENT '配置',
  `formattribute` varchar(255) NOT NULL DEFAULT '' COMMENT '表单附加属性',
  `unsetgroupids` varchar(255) NOT NULL DEFAULT '' COMMENT '禁止设置字段值的会员组',
  `unsetroleids` varchar(255) NOT NULL DEFAULT '' COMMENT '禁止设置字段值的角色',
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否内部字段 1是',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否系统字段 1 是',
  `isunique` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否唯一 1 是',
  `isbase` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为基本信息 1 是',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为搜索条件 1是',
  `isadd` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '在前台投稿中显示 1 显示',
  `isfulltext` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '入库到全站搜索 1是',
  `isposition` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否入库到推荐位 1 是',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 禁用 0启用',
  `isomnipotent` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为万能字段的附属字段 1 是',
  `isaddReg` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否前台注册显示',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`,`disabled`),
  KEY `field` (`field`,`modelid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型字段表，所有新增字段值都由此表管理。';

LOCK TABLES `model_field` WRITE;
/*!40000 ALTER TABLE `model_field` DISABLE KEYS */;

INSERT INTO `model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `mtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`, `isaddReg`)
VALUES
	(1,1,1,'catid','栏目','','',1,6,'/^[0-9]{1,6}$/','请选择栏目','catid',0,'array (\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,1,0,1,1,1,0,0,1,0,0,0),
	(2,1,1,'typeid','类别','','',0,0,'','','typeid',0,'array (\n  \'minnumber\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','','',0,1,0,1,1,1,0,0,2,0,0,0),
	(3,1,1,'title','标题','','inputtitle',1,80,'','请输入标题','title',0,'','','','',0,1,0,1,1,1,1,1,4,0,0,0),
	(4,1,1,'thumb','缩略图','','',0,100,'','','image',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'show_type\' => \'1\',\n  \'upload_maxsize\' => \'1024\',\n  \'upload_allowext\' => \'jpg|jpeg|gif|png|bmp\',\n  \'watermark\' => \'0\',\n  \'isselectimage\' => \'1\',\n  \'images_width\' => \'\',\n  \'images_height\' => \'\',\n)','','','',0,1,0,0,0,1,0,1,14,0,0,0),
	(5,1,1,'keywords','关键词','多关键词之间用空格或者“,”隔开','',0,40,'','','keyword',0,'array (\r\n  \'size\' => \'100\',\r\n  \'defaultvalue\' => \'\',\r\n)','','-99','-99',0,1,0,1,1,1,1,0,7,0,0,0),
	(6,1,1,'description','摘要','','',0,255,'','','textarea',0,'array (\r\n  \'width\' => \'98\',\r\n  \'height\' => \'46\',\r\n  \'defaultvalue\' => \'\',\r\n  \'enablehtml\' => \'0\',\r\n)','','','',0,1,0,1,0,1,1,1,10,0,0,0),
	(7,1,1,'updatetime','更新时间','','',0,0,'','','datetime',0,'array (\r\n  \'dateformat\' => \'int\',\r\n  \'format\' => \'Y-m-d H:i:s\',\r\n  \'defaulttype\' => \'1\',\r\n  \'defaultvalue\' => \'\',\r\n)','','','',1,1,0,1,0,0,0,0,12,0,0,0),
	(8,1,1,'content','内容','<div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>','',1,999999,'','内容不能为空','editor',0,'array (\n  \'toolbar\' => \'full\',\n  \'defaultvalue\' => \'\',\n  \'enablekeylink\' => \'1\',\n  \'replacenum\' => \'2\',\n  \'link_mode\' => \'0\',\n  \'enablesaveimage\' => \'1\',\n)','','','',0,0,0,1,0,1,1,0,13,0,0,0),
	(9,1,1,'voteid','添加投票','','',0,0,'','','omnipotent',0,'array (\n  \'formtext\' => \'<input type=\\\'text\\\' name=\\\'info[voteid]\\\' id=\\\'voteid\\\' value=\\\'{FIELD_VALUE}\\\' size=\\\'3\\\'> \r\n<input type=\\\'button\\\' value=\"选择已有投票\" onclick=\"omnipotent(\\\'selectid\\\',\\\'?m=vote&c=vote&a=public_get_votelist&from_api=1\\\',\\\'选择已有投票\\\')\" class=\"button\">\r\n<input type=\\\'button\\\' value=\"新增投票\" onclick=\"omnipotent(\\\'addvote\\\',\\\'?m=vote&c=vote&a=add&from_api=1\\\',\\\'添加投票\\\',0)\" class=\"button\">\',\n  \'fieldtype\' => \'mediumint\',\n  \'minnumber\' => \'1\',\n)','','','',0,0,0,1,0,0,1,0,21,0,0,0),
	(10,1,1,'pages','分页方式','','',0,0,'','','pages',0,'','','-99','-99',0,0,0,1,0,0,0,0,16,0,0,0),
	(11,1,1,'inputtime','发布时间','','',0,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d H:i:s\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,0,0,0,0,1,17,0,0,0),
	(12,1,1,'posids','推荐位','','',0,0,'','','posid',0,'array (\n  \'cols\' => \'4\',\n  \'width\' => \'125\',\n)','','','',0,1,0,1,0,0,0,0,18,0,0,0),
	(13,1,1,'url','URL','','',0,100,'','','text',0,'','','','',1,1,0,1,0,0,0,0,50,0,0,0),
	(14,1,1,'listorder','排序','','',0,6,'','','number',0,'','','','',1,1,0,1,0,0,0,0,51,0,0,0),
	(15,1,1,'status','状态','','',0,2,'','','box',0,'','','','',1,1,0,1,0,0,0,0,55,0,0,0),
	(16,1,1,'template','内容页模板','','',0,30,'','','template',0,'array (\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,0,0,0,0,0,0,0,53,0,0,0),
	(17,1,1,'groupids_view','阅读权限','','',0,0,'','','groupid',0,'array (\n  \'groupids\' => \'\',\n)','','','',0,0,0,1,0,0,0,0,19,0,0,0),
	(18,1,1,'readpoint','阅读收费','','',0,5,'','','readpoint',0,'array (\n  \'minnumber\' => \'1\',\n  \'maxnumber\' => \'99999\',\n  \'decimaldigits\' => \'0\',\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,0,0,0,0,0,0,0,55,0,0,0),
	(19,1,1,'relation','相关文章','','',0,0,'','','omnipotent',0,'array (\n  \'formtext\' => \'<input type=\\\'hidden\\\' name=\\\'info[relation]\\\' id=\\\'relation\\\' value=\\\'{FIELD_VALUE}\\\' style=\\\'50\\\' >\r\n<ul class=\"list-dot\" id=\"relation_text\"></ul>\r\n<div>\r\n<input type=\\\'button\\\' value=\"添加相关\" onclick=\"omnipotent(\\\'selectid\\\',\\\'?m=content&c=content&a=public_relationlist&modelid={MODELID}\\\',\\\'添加相关文章\\\',1)\" class=\"button\" style=\"width:66px;\">\r\n<span class=\"edit_content\">\r\n<input type=\\\'button\\\' value=\"显示已有\" onclick=\"show_relation({MODELID},{ID})\" class=\"button\" style=\"width:66px;\">\r\n</span>\r\n</div>\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n)','','2,6,4,5,1,17,18,7','',0,0,0,0,0,0,1,0,15,0,0,0),
	(20,1,1,'allow_comment','允许评论','','',0,0,'','','box',0,'array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'88\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'1\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,0,0,0,0,0,0,0,54,0,0,0),
	(21,1,1,'copyfrom','来源','','',0,100,'','','copyfrom',0,'array (\n  \'defaultvalue\' => \'\',\n)','','','',0,0,0,1,0,1,0,0,8,0,0,0),
	(80,1,1,'username','用户名','','',0,20,'','','text',0,'','','','',1,1,0,1,0,0,0,0,98,0,0,0),
	(22,2,1,'catid','栏目','','',1,6,'/^[0-9]{1,6}$/','请选择栏目','catid',0,'array (\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,1,0,1,1,1,0,0,1,0,0,0),
	(23,2,1,'typeid','类别','','',0,0,'','','typeid',0,'array (\n  \'minnumber\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','','',0,1,0,1,1,1,0,0,2,1,0,0),
	(24,2,1,'title','标题','','inputtitle',1,80,'','请输入标题','title',0,'','','','',0,1,0,1,1,1,1,1,4,0,0,0),
	(25,2,1,'keywords','关键词','多关键词之间用空格或者“,”隔开','',0,40,'','','keyword',0,'array (\r\n  \'size\' => \'100\',\r\n  \'defaultvalue\' => \'\',\r\n)','','-99','-99',0,1,0,1,1,1,1,0,7,0,0,0),
	(26,2,1,'description','摘要','','',0,255,'','','textarea',0,'array (\r\n  \'width\' => \'98\',\r\n  \'height\' => \'46\',\r\n  \'defaultvalue\' => \'\',\r\n  \'enablehtml\' => \'0\',\r\n)','','','',0,1,0,1,0,1,1,1,10,0,0,0),
	(27,2,1,'updatetime','更新时间','','',0,0,'','','datetime',0,'array (\r\n  \'dateformat\' => \'int\',\r\n  \'format\' => \'Y-m-d H:i:s\',\r\n  \'defaulttype\' => \'1\',\r\n  \'defaultvalue\' => \'\',\r\n)','','','',1,1,0,1,0,0,0,0,12,0,0,0),
	(28,2,1,'content','内容','<div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>','',1,999999,'','内容不能为空','editor',0,'array (\n  \'toolbar\' => \'full\',\n  \'defaultvalue\' => \'\',\n  \'enablekeylink\' => \'1\',\n  \'replacenum\' => \'2\',\n  \'link_mode\' => \'0\',\n  \'enablesaveimage\' => \'1\',\n  \'height\' => \'\',\n  \'disabled_page\' => \'1\',\n)','','','',0,0,0,1,0,1,1,0,13,0,0,0),
	(29,2,1,'thumb','缩略图','','',0,100,'','','image',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'show_type\' => \'1\',\n  \'upload_maxsize\' => \'1024\',\n  \'upload_allowext\' => \'jpg|jpeg|gif|png|bmp\',\n  \'watermark\' => \'0\',\n  \'isselectimage\' => \'1\',\n  \'images_width\' => \'\',\n  \'images_height\' => \'\',\n)','','','',0,1,0,0,0,1,0,1,14,0,0,0),
	(30,2,1,'relation','相关文章','','',0,0,'','','omnipotent',0,'array (\n  \'formtext\' => \'<input type=\\\'hidden\\\' name=\\\'info[relation]\\\' id=\\\'relation\\\' value=\\\'{FIELD_VALUE}\\\' style=\\\'50\\\' >\r\n<ul class=\"list-dot\" id=\"relation_text\"></ul>\r\n<div>\r\n<input type=\\\'button\\\' value=\"添加相关\" onclick=\"omnipotent(\\\'selectid\\\',\\\'?m=content&c=content&a=public_relationlist&modelid={MODELID}\\\',\\\'添加相关文章\\\',1)\" class=\"button\" style=\"width:66px;\">\r\n<span class=\"edit_content\">\r\n<input type=\\\'button\\\' value=\"显示已有\" onclick=\"show_relation({MODELID},{ID})\" class=\"button\" style=\"width:66px;\">\r\n</span>\r\n</div>\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n)','','2,6,4,5,1,17,18,7','',0,0,0,0,0,0,1,0,15,0,0,0),
	(31,2,1,'pages','分页方式','','',0,0,'','','pages',0,'','','-99','-99',0,0,0,1,0,0,0,0,16,1,0,0),
	(32,2,1,'inputtime','发布时间','','',0,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d H:i:s\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,0,0,0,0,1,17,0,0,0),
	(33,2,1,'posids','推荐位','','',0,0,'','','posid',0,'array (\n  \'cols\' => \'4\',\n  \'width\' => \'125\',\n)','','','',0,1,0,1,0,0,0,0,18,0,0,0),
	(34,2,1,'groupids_view','阅读权限','','',0,0,'','','groupid',0,'array (\n  \'groupids\' => \'\',\n)','','','',0,0,0,1,0,0,0,0,19,0,0,0),
	(35,2,1,'url','URL','','',0,100,'','','text',0,'','','','',1,1,0,1,0,0,0,0,50,0,0,0),
	(36,2,1,'listorder','排序','','',0,6,'','','number',0,'','','','',1,1,0,1,0,0,0,0,51,0,0,0),
	(37,2,1,'template','内容页模板','','',0,30,'','','template',0,'array (\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,0,0,0,0,0,0,0,53,0,0,0),
	(38,2,1,'allow_comment','允许评论','','',0,0,'','','box',0,'array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'88\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'1\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,0,0,0,0,0,0,0,54,0,0,0),
	(39,2,1,'status','状态','','',0,2,'','','box',0,'','','','',1,1,0,1,0,0,0,0,55,0,0,0),
	(40,2,1,'readpoint','阅读收费','','',0,5,'','','readpoint',0,'array (\n  \'minnumber\' => \'1\',\n  \'maxnumber\' => \'99999\',\n  \'decimaldigits\' => \'0\',\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,0,0,0,0,0,0,0,55,0,0,0),
	(41,2,1,'username','用户名','','',0,20,'','','text',0,'','','','',1,1,0,1,0,0,0,0,98,0,0,0),
	(42,2,1,'downfiles','本地下载','','',0,0,'','','downfiles',0,'array (\n  \'upload_allowext\' => \'rar|zip\',\n  \'isselectimage\' => \'0\',\n  \'upload_number\' => \'10\',\n  \'downloadlink\' => \'1\',\n  \'downloadtype\' => \'1\',\n)','','','',0,0,0,1,0,1,0,0,8,0,0,0),
	(43,2,1,'downfile','镜像下载','','',0,0,'','','downfile',0,'array (\n  \'downloadlink\' => \'1\',\n  \'downloadtype\' => \'1\',\n  \'upload_allowext\' => \'rar|zip\',\n  \'isselectimage\' => \'0\',\n  \'upload_number\' => \'1\',\n)','','','',0,0,0,1,0,1,0,0,9,0,0,0),
	(44,2,1,'systems','软件平台','<select name=\'selectSystem\' onchange=\"ChangeInput(this,document.myform.systems,\'/\')\">\r\n	<option value=\'WinXP\'>WinXP</option>\r\n	<option value=\'Vista\'>Windows 7</option>\r\n	<option value=\'Win2000\'>Win2000</option>\r\n	<option value=\'Win2003\'>Win2003</option>\r\n	<option value=\'Unix\'>Unix</option>\r\n	<option value=\'Linux\'>Linux</option>\r\n	<option value=\'MacOS\'>MacOS</option>\r\n</select>','',0,100,'','','text',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'Win2000/WinXP/Win2003\',\n  \'ispassword\' => \'0\',\n)','','','',0,1,0,1,0,1,1,0,14,0,0,0),
	(45,2,1,'copytype','软件授权形式','','',0,15,'','','box',0,'array (\n  \'options\' => \'免费版|免费版\r\n共享版|共享版\r\n试用版|试用版\r\n演示版|演示版\r\n注册版|注册版\r\n破解版|破解版\r\n零售版|零售版\r\nOEM版|OEM版\',\n  \'boxtype\' => \'select\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n  \'cols\' => \'5\',\n  \'width\' => \'80\',\n  \'size\' => \'1\',\n  \'default_select_value\' => \'免费版\',\n)','','','',0,1,0,1,0,1,0,0,12,0,0,0),
	(46,2,1,'language','软件语言','','',0,16,'','','box',0,'array (\n  \'options\' => \'英文|英文\r\n简体中文|简体中文\r\n繁体中文|繁体中文\r\n简繁中文|简繁中文\r\n多国语言|多国语言\r\n其他语言|其他语言\',\n  \'boxtype\' => \'select\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n  \'cols\' => \'5\',\n  \'width\' => \'80\',\n  \'size\' => \'1\',\n  \'default_select_value\' => \'简体中文\',\n)','','','',0,1,0,1,0,1,0,0,13,0,0,0),
	(47,2,1,'classtype','软件类型','','',0,20,'','','box',0,'array (\n  \'options\' => \'国产软件|国产软件\r\n国外软件|国外软件\r\n汉化补丁|汉化补丁\r\n程序源码|程序源码\r\n其他|其他\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n  \'cols\' => \'5\',\n  \'width\' => \'80\',\n  \'size\' => \'1\',\n  \'default_select_value\' => \'国产软件\',\n)','','','',0,1,0,1,0,1,0,0,17,0,0,0),
	(48,2,1,'version','版本号','','',0,20,'','','text',0,'array (\n  \'size\' => \'10\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,1,0,0,0,1,1,0,13,0,0,0),
	(49,2,1,'filesize','文件大小','','',0,10,'','','text',0,'array (\n  \'size\' => \'10\',\n  \'defaultvalue\' => \'未知\',\n  \'ispassword\' => \'0\',\n)','','','',0,1,0,0,0,1,1,0,14,0,0,0),
	(50,2,1,'stars','评分等级','','',0,20,'','','box',0,'array (\n  \'options\' => \'★☆☆☆☆|★☆☆☆☆\r\n★★☆☆☆|★★☆☆☆\r\n★★★☆☆|★★★☆☆\r\n★★★★☆|★★★★☆\r\n★★★★★|★★★★★\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n  \'cols\' => \'5\',\n  \'width\' => \'88\',\n  \'size\' => \'1\',\n  \'default_select_value\' => \'★★★☆☆\',\n)','','','',0,1,0,1,0,1,0,0,17,0,0,0),
	(51,3,1,'allow_comment','允许评论','','',0,0,'','','box',0,'array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'88\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'1\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,0,0,0,0,0,0,0,54,0,0,0),
	(52,3,1,'template','内容页模板','','',0,30,'','','template',0,'array (\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,0,0,0,0,0,0,0,53,0,0,0),
	(53,3,1,'url','URL','','',0,100,'','','text',0,'','','','',1,1,0,1,0,0,0,0,50,0,0,0),
	(54,3,1,'listorder','排序','','',0,6,'','','number',0,'','','','',1,1,0,1,0,0,0,0,51,0,0,0),
	(55,3,1,'posids','推荐位','','',0,0,'','','posid',0,'array (\n  \'cols\' => \'4\',\n  \'width\' => \'125\',\n)','','','',0,1,0,1,0,0,0,0,18,0,0,0),
	(56,3,1,'groupids_view','阅读权限','','',0,0,'','','groupid',0,'array (\n  \'groupids\' => \'\',\n)','','','',0,0,0,1,0,0,0,0,19,0,0,0),
	(57,3,1,'inputtime','发布时间','','',0,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d H:i:s\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,0,0,0,0,1,17,0,0,0),
	(58,3,1,'pages','分页方式','','',0,0,'','','pages',0,'','','-99','-99',0,0,0,1,0,0,0,0,16,0,0,0),
	(59,3,1,'relation','相关组图','','',0,0,'','','omnipotent',0,'array (\n  \'formtext\' => \'<input type=\\\'hidden\\\' name=\\\'info[relation]\\\' id=\\\'relation\\\' value=\\\'{FIELD_VALUE}\\\' style=\\\'50\\\' >\r\n<ul class=\"list-dot\" id=\"relation_text\"></ul>\r\n<div>\r\n<input type=\\\'button\\\' value=\"添加相关\" onclick=\"omnipotent(\\\'selectid\\\',\\\'?m=content&c=content&a=public_relationlist&modelid={MODELID}\\\',\\\'添加相关文章\\\',1)\" class=\"button\" style=\"width:66px;\">\r\n<span class=\"edit_content\">\r\n<input type=\\\'button\\\' value=\"显示已有\" onclick=\"show_relation({MODELID},{ID})\" class=\"button\" style=\"width:66px;\">\r\n</span>\r\n</div>\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n)','','2,6,4,5,1,17,18,7','',0,0,0,0,0,0,1,0,15,0,0,0),
	(60,3,1,'thumb','缩略图','','',0,100,'','','image',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'show_type\' => \'1\',\n  \'upload_maxsize\' => \'1024\',\n  \'upload_allowext\' => \'jpg|jpeg|gif|png|bmp\',\n  \'watermark\' => \'0\',\n  \'isselectimage\' => \'1\',\n  \'images_width\' => \'\',\n  \'images_height\' => \'\',\n)','','','',0,1,0,0,0,1,0,1,14,0,0,0),
	(61,3,1,'content','内容','<div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>','',0,999999,'','','editor',0,'array (\n  \'toolbar\' => \'full\',\n  \'defaultvalue\' => \'\',\n  \'enablekeylink\' => \'1\',\n  \'replacenum\' => \'2\',\n  \'link_mode\' => \'0\',\n  \'enablesaveimage\' => \'1\',\n  \'height\' => \'\',\n  \'disabled_page\' => \'1\',\n)','','','',0,0,0,1,0,1,1,0,13,0,0,0),
	(62,3,1,'updatetime','更新时间','','',0,0,'','','datetime',0,'array (\r\n  \'dateformat\' => \'int\',\r\n  \'format\' => \'Y-m-d H:i:s\',\r\n  \'defaulttype\' => \'1\',\r\n  \'defaultvalue\' => \'\',\r\n)','','','',1,1,0,1,0,0,0,0,12,0,0,0),
	(63,3,1,'description','摘要','','',0,255,'','','textarea',0,'array (\r\n  \'width\' => \'98\',\r\n  \'height\' => \'46\',\r\n  \'defaultvalue\' => \'\',\r\n  \'enablehtml\' => \'0\',\r\n)','','','',0,1,0,1,0,1,1,1,10,0,0,0),
	(64,3,1,'title','标题','','inputtitle',1,80,'','请输入标题','title',0,'','','','',0,1,0,1,1,1,1,1,4,0,0,0),
	(65,3,1,'keywords','关键词','多关键词之间用空格或者“,”隔开','',0,40,'','','keyword',0,'array (\r\n  \'size\' => \'100\',\r\n  \'defaultvalue\' => \'\',\r\n)','','-99','-99',0,1,0,1,1,1,1,0,7,0,0,0),
	(66,3,1,'typeid','类别','','',0,0,'','','typeid',0,'array (\n  \'minnumber\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','','',0,1,0,1,1,1,0,0,2,0,0,0),
	(67,3,1,'catid','栏目','','',1,6,'/^[0-9]{1,6}$/','请选择栏目','catid',0,'array (\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,1,0,1,1,1,0,0,1,0,0,0),
	(68,3,1,'status','状态','','',0,2,'','','box',0,'','','','',1,1,0,1,0,0,0,0,55,0,0,0),
	(69,3,1,'readpoint','阅读收费','','',0,5,'','','readpoint',0,'array (\n  \'minnumber\' => \'1\',\n  \'maxnumber\' => \'99999\',\n  \'decimaldigits\' => \'0\',\n  \'defaultvalue\' => \'\',\n)','','-99','-99',0,0,0,0,0,0,0,0,55,0,0,0),
	(70,3,1,'username','用户名','','',0,20,'','','text',0,'','','','',1,1,0,1,0,0,0,0,98,0,0,0),
	(71,3,1,'pictureurls','组图','','',0,0,'','','images',0,'array (\n  \'upload_allowext\' => \'gif|jpg|jpeg|png|bmp\',\n  \'isselectimage\' => \'1\',\n  \'upload_number\' => \'50\',\n)','','','',0,0,0,1,0,1,0,0,15,0,0,0),
	(72,3,1,'copyfrom','来源','','',0,0,'','','copyfrom',0,'array (\n  \'defaultvalue\' => \'\',\n)','','','',0,0,0,1,0,1,0,0,8,0,0,0),
	(73,1,1,'islink','转向链接','','',0,0,'','','islink',0,'','','','',0,1,0,0,0,1,0,0,30,0,0,0),
	(74,2,1,'islink','转向链接','','',0,0,'','','islink',0,'','','','',0,1,0,0,0,1,0,0,30,0,0,0),
	(75,3,1,'islink','转向链接','','',0,0,'','','islink',0,'','','','',0,1,0,0,0,1,0,0,30,0,0,0),
	(83,10,1,'birthday','生日','','',0,0,'','生日格式错误','datetime',8,'array (\n  \'fieldtype\' => \'date\',\n  \'format\' => \'Y-m-d\',\n  \'defaulttype\' => \'0\',\n)','','','',0,0,0,0,0,1,1,0,0,0,0,0),
	(84,11,1,'companyname','企业名称','','',1,100,'','请输入企业名称','text',0,'array (\n  \'size\' => \'35\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,1,0,1,1,1,1,0,0,0,0,0),
	(85,11,1,'catids','主营行业','','size=\"8\" style=\"width:195px;\"',0,200,'','','catids',0,'array (\n  \'boxtype\' => \'down\',\n  \'filtertype\' => \'1\',\n)','onchange=\"select_catids();\"','','',0,1,0,1,0,1,1,0,0,0,0,0),
	(86,11,1,'pattern','经营模式','','',0,255,'','','box',0,'array (\n  \'options\' => \'生产型|生产型\r\n贸易型|贸易型\r\n服务型|服务型\r\n政府或其他机构|政府或其他机构\',\n  \'boxtype\' => \'checkbox\',\n  \'fieldtype\' => \'varchar\',\n  \'width\' => \'\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'0\',\n  \'filtertype\' => \'0\',\n)','','','',0,1,0,1,0,1,1,0,0,0,0,0),
	(87,11,1,'products','主营产品或服务','','',0,0,'','','textarea',0,'array (\n  \'width\' => \'60\',\n  \'height\' => \'125\',\n  \'defaultvalue\' => \'\',\n  \'enablehtml\' => \'0\',\n)','','','',0,1,0,1,1,1,1,0,1,0,0,0),
	(88,11,1,'genre','公司类型','','',1,30,'','','box',0,'array (\n  \'options\' => \'企业单位|企业单位\r\n个体经营|个体经营\r\n事业单位或社会团体|事业单位或社会团体\r\n未经工商注册，个人|未经工商注册，个人\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'varchar\',\n  \'width\' => \'150\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'未经工商注册，个人\',\n  \'outputtype\' => \'0\',\n  \'filtertype\' => \'0\',\n)','','','',0,1,0,1,0,1,1,0,2,0,0,0),
	(89,11,1,'areaname','公司所在地','','',1,10,'','','box',0,'array (\n  \'options\' => \'北京|北京\r\n上海|上海\r\n杭州|杭州\r\n广州|广州\r\n深圳|深圳\r\n南京|南京\r\n武汉|武汉\r\n天津|天津\r\n成都|成都\r\n哈尔滨|哈尔滨\r\n重庆|重庆\r\n宁波|宁波\r\n无锡|无锡\r\n济南|济南\r\n苏州|苏州\r\n温州|温州\r\n青岛|青岛\r\n沈阳|沈阳\r\n福州|福州\r\n西安|西安\r\n长沙|长沙\r\n合肥|合肥\r\n南宁|南宁\r\n南昌|南昌\r\n郑州|郑州\r\n厦门|厦门\r\n大连|大连\r\n常州|常州\r\n石家庄|石家庄\r\n东莞|东莞\r\n安徽|安徽\r\n福建|福建\r\n甘肃|甘肃\r\n广东|广东\r\n广西|广西\r\n贵州|贵州\r\n海南|海南\r\n河北|河北\r\n黑龙江|黑龙江\r\n河南|河南\r\n湖北|湖北\r\n湖南|湖南\r\n江苏|江苏\r\n江西|江西\r\n吉林|吉林\r\n辽宁|辽宁\r\n内蒙古|内蒙古\r\n宁夏|宁夏\r\n青海|青海\r\n山东|山东\r\n山西|山西\r\n陕西|陕西\r\n四川|四川\r\n新疆|新疆\r\n西藏|西藏\r\n云南|云南\r\n浙江|浙江\r\n澳门|澳门\r\n台湾|台湾\r\n香港|香港\r\n惠州|惠州\r\n佛山|佛山\r\n珠海|珠海\r\n中山|中山\r\n海外|海外\r\n其它|其它\',\n  \'boxtype\' => \'select\',\n  \'fieldtype\' => \'varchar\',\n  \'width\' => \'\',\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'0\',\n  \'filtertype\' => \'0\',\n)','','','',0,1,0,1,0,1,1,0,3,0,0,0),
	(90,11,1,'address','经营地址','','',0,100,'','','text',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','-99','-99',0,1,0,1,0,1,1,0,4,0,0,0),
	(91,11,1,'qq','企业QQ','','',0,0,'','','text',0,'array (\n  \'size\' => \'20\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,1,0,1,0,1,1,0,0,0,0,0),
	(92,11,1,'web_url','官网网址','','',0,0,'','','text',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,1,0,1,0,1,1,0,0,0,0,0),
	(93,12,1,'status','状态','','',0,2,'','','box',0,'','','','',1,1,0,1,0,0,0,0,55,0,0,0),
	(94,12,1,'listorder','排序','','',0,6,'','','number',0,'','','','',1,1,0,1,0,0,0,0,51,0,0,0),
	(95,12,1,'posids','推荐位','','',0,0,'','','posid',0,'array (\n  \'cols\' => \'4\',\n  \'width\' => \'125\',\n)','','','',0,1,0,1,0,0,0,0,18,0,0,0),
	(96,12,1,'url','URL','','',0,100,'','','text',0,'','','','',1,1,0,1,0,0,0,0,50,0,0,0),
	(97,12,1,'thumb','缩略图','','',0,100,'','','image',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'show_type\' => \'1\',\n  \'upload_maxsize\' => \'1024\',\n  \'upload_allowext\' => \'jpg|jpeg|gif|png|bmp\',\n  \'watermark\' => \'0\',\n  \'isselectimage\' => \'1\',\n  \'images_width\' => \'\',\n  \'images_height\' => \'\',\n)','','','',0,1,0,0,0,1,0,1,5,0,0,0),
	(98,12,1,'pages','分页方式','','',0,0,'','','pages',0,'','','','',0,0,0,1,0,1,0,0,16,0,0,0),
	(99,12,1,'inputtime','发布时间','','',0,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d H:i:s\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,0,0,0,0,1,17,0,0,0),
	(100,12,1,'content','内容','<div class=\"content_attr\"><label><input name=\"add_introduce\" type=\"checkbox\"  value=\"1\" checked>是否截取内容</label><input type=\"text\" name=\"introcude_length\" value=\"200\" size=\"3\">字符至内容摘要\r\n<label><input type=\'checkbox\' name=\'auto_thumb\' value=\"1\" checked>是否获取内容第</label><input type=\"text\" name=\"auto_thumb_no\" value=\"1\" size=\"2\" class=\"\">张图片作为标题图片\r\n</div>','',1,999999,'','内容不能为空','editor',0,'array (\n  \'toolbar\' => \'full\',\n  \'defaultvalue\' => \'\',\n  \'enablekeylink\' => \'1\',\n  \'replacenum\' => \'2\',\n  \'link_mode\' => \'0\',\n  \'enablesaveimage\' => \'0\',\n  \'height\' => \'\',\n  \'disabled_page\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,13,0,0,0),
	(101,12,1,'updatetime','更新时间','','',0,0,'','','datetime',0,'array (\r\n  \'dateformat\' => \'int\',\r\n  \'format\' => \'Y-m-d H:i:s\',\r\n  \'defaulttype\' => \'1\',\r\n  \'defaultvalue\' => \'\',\r\n)','','','',1,1,0,1,0,0,0,0,12,0,0,0),
	(102,12,1,'keywords','关键词','多关键词之间用空格或者“,”隔开','',0,40,'','','keyword',0,'array (\r\n  \'size\' => \'100\',\r\n  \'defaultvalue\' => \'\',\r\n)','','-99','-99',0,1,0,1,1,1,1,0,7,0,0,0),
	(103,12,1,'description','摘要','','',0,255,'','','textarea',0,'array (\r\n  \'width\' => \'98\',\r\n  \'height\' => \'46\',\r\n  \'defaultvalue\' => \'\',\r\n  \'enablehtml\' => \'0\',\r\n)','','','',0,1,0,1,0,1,1,1,10,0,0,0),
	(104,12,1,'title','标题','','inputtitle',1,80,'','请输入标题','title',0,'','','','',0,1,0,1,1,1,1,1,4,0,0,0),
	(105,12,1,'catid','分类','','',1,0,'/^[0-9]{1,6}$/','请选择栏目','catids',0,'array (\n  \'boxtype\' => \'pop\',\n  \'filtertype\' => \'1\',\n)','','','',0,1,0,1,1,1,0,0,1,0,0,0),
	(106,12,1,'username','用户名','','',0,20,'','','text',0,'','','','',1,1,0,1,0,0,0,0,98,0,0,0),
	(107,12,1,'elite','推荐','','',0,0,'','','box',0,'array (\n  \'options\' => \'是|1\r\n否|0\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'40\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,1,0,1,0,1,0,0,14,0,0,0),
	(108,12,1,'typeid','类别','','',0,0,'','','typeid',0,'array (\n  \'minnumber\' => \'\',\n  \'defaultvalue\' => \'\',\n)','','','',0,1,0,1,1,1,0,0,2,1,0,0),
	(109,13,1,'catid','产品分类','','',1,6,'/^[0-9]{1,6}$/','请选择栏目','catids',0,'array (\n  \'boxtype\' => \'down\',\n  \'filtertype\' => \'1\',\n)','','','',0,1,0,1,1,1,0,0,1,0,0,0),
	(110,13,1,'title','产品名称','','inputtitle',1,80,'','请输入标题','title',0,'','','','',0,1,0,1,1,1,1,1,4,0,0,0),
	(111,13,1,'keywords','关键词','多关键词之间用空格或者“,”隔开','',0,40,'','','keyword',0,'array (\r\n  \'size\' => \'100\',\r\n  \'defaultvalue\' => \'\',\r\n)','','-99','-99',0,1,0,1,1,1,1,0,7,0,0,0),
	(112,13,1,'updatetime','更新时间','','',0,0,'','','datetime',0,'array (\r\n  \'dateformat\' => \'int\',\r\n  \'format\' => \'Y-m-d H:i:s\',\r\n  \'defaulttype\' => \'1\',\r\n  \'defaultvalue\' => \'\',\r\n)','','','',1,1,0,1,0,0,0,0,12,0,0,0),
	(113,13,1,'content','产品介绍','','',1,999999,'','内容不能为空','editor',0,'array (\n  \'toolbar\' => \'basic\',\n  \'defaultvalue\' => \'\',\n  \'enablekeylink\' => \'1\',\n  \'replacenum\' => \'2\',\n  \'link_mode\' => \'0\',\n  \'enablesaveimage\' => \'1\',\n  \'height\' => \'\',\n  \'disabled_page\' => \'1\',\n)','','','',0,0,0,1,0,1,1,0,13,0,0,0),
	(114,13,1,'elite','推荐','','',0,0,'','','box',0,'array (\n  \'options\' => \'是|1\r\n否|0\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'40\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,1,0,1,0,1,0,0,14,0,0,0),
	(115,13,1,'thumb','缩略图','','',0,100,'','','image',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'show_type\' => \'1\',\n  \'upload_maxsize\' => \'1024\',\n  \'upload_allowext\' => \'jpg|jpeg|gif|png|bmp\',\n  \'watermark\' => \'0\',\n  \'isselectimage\' => \'1\',\n  \'images_width\' => \'\',\n  \'images_height\' => \'\',\n)','','','',0,1,0,0,0,1,0,1,6,0,0,0),
	(116,13,1,'inputtime','发布时间','','',0,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d H:i:s\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,0,0,0,0,1,17,0,0,0),
	(117,13,1,'posids','推荐位','','',0,0,'','','posid',0,'array (\n  \'cols\' => \'4\',\n  \'width\' => \'125\',\n)','','','',0,1,0,1,0,0,0,0,18,0,0,0),
	(118,13,1,'url','URL','','',0,100,'','','text',0,'array (\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',1,1,0,1,0,0,0,1,50,0,0,0),
	(119,13,1,'listorder','排序','','',0,6,'','','number',0,'','','','',1,1,0,1,0,0,0,0,51,0,0,0),
	(120,13,1,'status','状态','','',0,2,'','','box',0,'','','','',1,1,0,1,0,0,0,0,55,0,0,0),
	(121,13,1,'username','用户名','','',0,20,'','','text',0,'array (\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',1,1,0,1,0,0,0,1,98,0,0,0),
	(122,13,1,'exhibit','展示图','','',0,0,'','','images',0,'array (\n  \'upload_allowext\' => \'gif|jpg|jpeg|png|bmp\',\n  \'isselectimage\' => \'0\',\n  \'upload_number\' => \'10\',\n)','','','',0,0,0,1,0,1,0,0,6,0,0,0),
	(123,13,1,'standard','型号','','',0,0,'','','text',0,'array (\n  \'size\' => \'20\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,5,0,0,0),
	(124,13,1,'brand','品牌','','',0,0,'','','text',0,'array (\n  \'size\' => \'30\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,6,0,0,0),
	(125,13,1,'yieldly','商品产地','','',0,0,'','','text',0,'array (\n  \'size\' => \'20\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,6,0,0,0),
	(126,13,1,'price','价格','','',0,0,'','','number',0,'array (\n  \'minnumber\' => \'0\',\n  \'maxnumber\' => \'\',\n  \'decimaldigits\' => \'2\',\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n  \'rangetype\' => \'1\',\n)','','','',0,1,0,1,0,1,0,0,8,0,0,0),
	(127,13,1,'areaid','地区','','',0,0,'','','linkage',0,'array (\n  \'linkageid\' => \'1\',\n  \'showtype\' => \'0\',\n  \'space\' => \'\',\n  \'filtertype\' => \'1\',\n)','','','',0,1,0,1,0,1,0,0,11,0,0,0),
	(128,13,1,'units','计量单位','','',0,0,'','','box',0,'array (\n  \'options\' => \'把|把\r\n包|包\r\n本|本\r\n部|部\r\n打|打\r\n袋|袋\r\n单|单\r\n刀|刀\r\n吊|吊\r\n顶|顶\r\n对|对\r\n吨|吨\r\n幅|幅\r\n个|个\r\n根|根\r\n公斤|公斤\r\n公升|公升\r\n罐|罐\r\n毫米|毫米\r\n毫升|毫升\r\n盒|盒\r\n架|架\r\n件|件\r\n节|节\r\n具|具\r\n卷|卷\r\n卡|卡\r\n棵|棵\r\n颗|颗\r\n克|克\r\n块|块\r\n款|款\r\n厘米|厘米\r\n立方|立方\r\n立方根|立方根\r\n粒|粒\r\n辆|辆\r\n码|码\r\n枚|枚\r\n米|米\r\n面|面\r\n盆|盆\r\n片|片\r\n票|票\r\n平方厘米|平方厘米\r\n平方米|平方米\r\n平方英尺|平方英尺\r\n瓶|瓶\r\n千克|千克\r\n升|升\r\n束|束\r\n双|双\r\n台|台\r\n套|套\r\n条|条\r\n桶|桶\r\n头|头\r\n箱|箱\r\n英寸|英寸\r\n盏|盏\r\n张|张\r\n支|支\r\n只|只\r\n株|株\r\n组|组\r\n尊|尊\r\n座|座\',\n  \'boxtype\' => \'select\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'80\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,0,0,1,0,1,0,0,8,0,0,0),
	(129,14,1,'catid','商机分类','','',1,0,'','请选择分类','catids',0,'array (\n  \'boxtype\' => \'down\',\n  \'filtertype\' => \'1\',\n)','','','',0,1,0,1,1,1,0,0,1,0,0,0),
	(130,14,1,'title','商品名称','','inputtitle',1,120,'','请输入标题','title',0,'','','','',0,1,0,1,1,1,1,1,4,0,0,0),
	(131,14,1,'keywords','关键词','多关键词之间用空格或者“,”隔开','',0,40,'','','keyword',0,'array (\r\n  \'size\' => \'100\',\r\n  \'defaultvalue\' => \'\',\r\n)','','-99','-99',0,1,0,1,1,1,1,0,7,0,0,0),
	(132,14,1,'updatetime','更新时间','','',0,0,'','','datetime',0,'array (\r\n  \'dateformat\' => \'int\',\r\n  \'format\' => \'Y-m-d H:i:s\',\r\n  \'defaulttype\' => \'1\',\r\n  \'defaultvalue\' => \'\',\r\n)','','','',1,1,0,1,0,0,0,0,12,0,0,0),
	(133,14,1,'content','商品介绍','','',1,999999,'','内容不能为空','editor',0,'array (\n  \'toolbar\' => \'basic\',\n  \'defaultvalue\' => \'\',\n  \'enablekeylink\' => \'1\',\n  \'replacenum\' => \'2\',\n  \'link_mode\' => \'0\',\n  \'enablesaveimage\' => \'1\',\n  \'height\' => \'\',\n  \'disabled_page\' => \'1\',\n)','','','',0,0,0,1,0,1,1,0,13,0,0,0),
	(134,14,1,'brand','品牌','','',0,0,'','','text',0,'array (\n  \'size\' => \'30\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,6,0,0,0),
	(135,14,1,'standard','商品型号','','',0,0,'','','text',0,'array (\n  \'size\' => \'20\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,4,0,0,0),
	(136,14,1,'price','价格','','',0,0,'','','number',0,'array (\n  \'minnumber\' => \'\',\n  \'maxnumber\' => \'\',\n  \'decimaldigits\' => \'2\',\n  \'size\' => \'20\',\n  \'defaultvalue\' => \'\',\n  \'rangetype\' => \'1\',\n)','','','',0,1,0,1,0,1,1,0,8,0,0,0),
	(137,14,1,'thumb','缩略图','','',0,100,'','','image',0,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'show_type\' => \'1\',\n  \'upload_maxsize\' => \'1024\',\n  \'upload_allowext\' => \'jpg|jpeg|gif|png|bmp\',\n  \'watermark\' => \'0\',\n  \'isselectimage\' => \'1\',\n  \'images_width\' => \'\',\n  \'images_height\' => \'\',\n)','','','',0,1,0,0,0,1,0,1,5,0,0,0),
	(138,14,1,'inputtime','发布时间','','',0,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d H:i:s\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,0,0,0,0,1,17,0,0,0),
	(139,14,1,'posids','推荐位','','',0,0,'','','posid',0,'array (\n  \'cols\' => \'4\',\n  \'width\' => \'125\',\n)','','','',0,1,0,1,0,0,0,0,18,0,0,0),
	(140,14,1,'url','URL','','',0,100,'','','text',0,'','','','',1,1,0,1,0,0,0,0,50,0,0,0),
	(141,14,1,'listorder','排序','','',0,6,'','','number',0,'','','','',1,1,0,1,0,0,0,0,51,0,0,0),
	(142,14,1,'status','状态','','',0,2,'','','box',0,'','','','',1,1,0,1,0,0,0,0,55,0,0,0),
	(143,14,1,'username','用户名','','',0,20,'','','text',0,'array (\n  \'size\' => \'\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',1,1,0,1,0,0,0,1,98,0,0,0),
	(144,14,1,'tid','商机类型','','',1,100,'','','box',0,'array (\n  \'options\' => \'供应|1\r\n求购|2\r\n二手|3\r\n促销|4\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'80\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'1\',\n)','','','',0,1,0,1,0,1,0,0,0,0,0,0),
	(145,14,1,'elite','推荐','','',0,0,'','','box',0,'array (\n  \'options\' => \'是|1\r\n否|0\',\n  \'boxtype\' => \'radio\',\n  \'fieldtype\' => \'tinyint\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'40\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'1\',\n  \'filtertype\' => \'0\',\n)','','','',0,1,0,1,0,1,0,0,14,0,0,0),
	(146,14,1,'areaid','地区','','',0,0,'','','linkage',0,'array (\n  \'linkageid\' => \'1\',\n  \'space\' => \'\',\n  \'filtertype\' => \'1\',\n)','','','',0,1,0,1,0,1,0,0,10,0,0,0),
	(147,14,1,'yieldly','商品产地','','',0,0,'','','text',0,'array (\n  \'size\' => \'20\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,1,0,1,1,0,9,0,0,0),
	(148,14,1,'units','计量单位','','',0,0,'','','box',0,'array (\n  \'options\' => \'把|把\r\n包|包\r\n本|本\r\n部|部\r\n打|打\r\n袋|袋\r\n单|单\r\n刀|刀\r\n吊|吊\r\n顶|顶\r\n对|对\r\n吨|吨\r\n幅|幅\r\n个|个\r\n根|根\r\n公斤|公斤\r\n公升|公升\r\n罐|罐\r\n毫米|毫米\r\n毫升|毫升\r\n盒|盒\r\n架|架\r\n件|件\r\n节|节\r\n具|具\r\n卷|卷\r\n卡|卡\r\n棵|棵\r\n颗|颗\r\n克|克\r\n块|块\r\n款|款\r\n厘米|厘米\r\n立方|立方\r\n立方根|立方根\r\n粒|粒\r\n辆|辆\r\n码|码\r\n枚|枚\r\n米|米\r\n面|面\r\n盆|盆\r\n片|片\r\n票|票\r\n平方厘米|平方厘米\r\n平方米|平方米\r\n平方英尺|平方英尺\r\n瓶|瓶\r\n千克|千克\r\n升|升\r\n束|束\r\n双|双\r\n台|台\r\n套|套\r\n条|条\r\n桶|桶\r\n头|头\r\n箱|箱\r\n英寸|英寸\r\n盏|盏\r\n张|张\r\n支|支\r\n只|只\r\n株|株\r\n组|组\r\n尊|尊\r\n座|座\',\n  \'boxtype\' => \'select\',\n  \'fieldtype\' => \'varchar\',\n  \'minnumber\' => \'1\',\n  \'width\' => \'80\',\n  \'size\' => \'1\',\n  \'defaultvalue\' => \'\',\n  \'outputtype\' => \'1\',\n)','','','',0,0,0,1,0,1,0,0,8,0,0,0),
	(149,14,1,'expiration','过期时间','','',1,0,'','','datetime',0,'array (\n  \'fieldtype\' => \'int\',\n  \'format\' => \'Y-m-d\',\n  \'defaulttype\' => \'0\',\n)','','','',0,1,0,1,0,1,0,0,2,0,0,0),
	(150,10,0,'account','昵 称','','',1,0,'','','text',9,'array (\n  \'size\' => \'50\',\n  \'defaultvalue\' => \'\',\n  \'ispassword\' => \'0\',\n)','','','',0,0,0,0,0,1,0,0,0,0,0,0);

/*!40000 ALTER TABLE `model_field` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
