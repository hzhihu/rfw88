SET NAMES 'utf8';

-- 增加是否前台注册页面显示
ALTER TABLE `v9_model_field` ADD `isaddReg` TINYINT(1)  UNSIGNED  NOT NULL  DEFAULT '0'  COMMENT '是否前台注册显示'  AFTER `isadd`;

--增加模型分类表

DROP TABLE IF EXISTS `v9_member_type`;

CREATE TABLE `v9_member_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `desc` varchar(250) DEFAULT NULL COMMENT '详细信息',
  `sort` tinyint(3) DEFAULT NULL COMMENT '排序',
  `disable` tinyint(1) DEFAULT NULL COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员类型表';

-- 增加模型分类表数据
INSERT INTO `v9_member_type` (`id`, `name`, `desc`, `sort`, `disable`)
VALUES
    (8, '个人详细资料', '个人详细资料', 1, 1),
    (9, '我的基本信息', '我的基本信息', 0, 1),
    (10, '房产资料', '房产资料', 2, 1),
    (11, '单位资料', '单位资料', 3, 1),
    (12, '私营业主资料', '私营业主资料', 4, 1),
    (13, '财务状况', '财务状况', 5, 1),
    (14, '联系方式', '联系方式', 6, 1),
    (15, '配偶资料', '配偶资料', 7, 1),
    (16, '教育背景', '教育背景', 8, 1),
    (17, '工作经历', '工作经历', 9, 1),
    (18, '其它信息', '其它信息', 10, 1);


-- 增加所属于模型分类
ALTER TABLE `v9_model_field` ADD `mtype` TINYINT(1)  UNSIGNED  NOT NULL  DEFAULT '0'  COMMENT '所属于模型分类'  AFTER `formtype`;


-- 增加会员模型是否注册时显示字段
ALTER TABLE `v9_model` ADD `reg_view` TINYINT(1)  UNSIGNED  NULL  DEFAULT '1'  COMMENT '是否前台显示'  AFTER `js_template`;
UPDATE `v9_model` SET `reg_view` = '0' WHERE `modelid` = '10';



-- 增加会员认证中心
CREATE TABLE IF NOT EXISTS `v9_attestation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户名称',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '上传的类型',
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '认证的状态',
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '认证的图片',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '认证的简介',
  `jifen` int(20) NOT NULL DEFAULT '0' COMMENT '认证的积分',
  `verify_time` varchar(32) NULL DEFAULT '' COMMENT '审核时间',
  `verify_user` int(11)  NULL DEFAULT '0' COMMENT '审核人',
  `verify_remark` varchar(250)  NULL DEFAULT '' COMMENT '审核备注',
  `addtime` varchar(50) NOT NULL DEFAULT '',
  `addip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='实名证件表';

CREATE TABLE IF NOT EXISTS `v9_attestation_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  `order` varchar(10) NOT NULL,
  `status` int(2) NOT NULL,
  `jifen` int(20) NOT NULL DEFAULT '0' COMMENT '积分',
  `summary` varchar(200) NOT NULL COMMENT '简介',
  `remark` varchar(200) NOT NULL  COMMENT '备注',
  `addtime` varchar(50) NOT NULL,
  `addip` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='实名证件类型';



-- 增加认证字段
ALTER TABLE `v9_member`ADD  `avatar_status` int(2) DEFAULT '0' COMMENT '实名认证' AFTER `vip`;
ALTER TABLE `v9_member`ADD  `email_status` varchar(50) DEFAULT 0 COMMENT '邮箱认证' AFTER `avatar_status`;
ALTER TABLE `v9_member`ADD  `phone_status` varchar(50) DEFAULT '0' COMMENT '手机认证' AFTER `email_status`;
ALTER TABLE `v9_member`ADD  `phone` varchar(50) DEFAULT NULL COMMENT '手机' AFTER `phone_status`;
ALTER TABLE `v9_member`ADD  `card_type` varchar(10) DEFAULT NULL COMMENT '实名认证证件类型,1为身份证,2为军官证,3为台胞证' AFTER `phone_status`;
ALTER TABLE `v9_member`ADD  `card_id` varchar(50) DEFAULT NULL COMMENT '证件号码' AFTER `card_type`;
ALTER TABLE `v9_member`ADD  `card_pic1` varchar(150) DEFAULT NULL COMMENT '身份证正面上传' AFTER `card_id`;
ALTER TABLE `v9_member`ADD  `card_pic2` varchar(150) DEFAULT NULL COMMENT '身份证背面上传' AFTER `card_pic1`;
ALTER TABLE `v9_member`ADD  `nation` varchar(10) DEFAULT NULL COMMENT '民 族' AFTER `card_pic2`;
ALTER TABLE `v9_member`ADD  `realname` varchar(20) DEFAULT '' COMMENT '真实姓名' AFTER `nation`;
ALTER TABLE `v9_member`ADD  `sex` varchar(10) DEFAULT NULL COMMENT '性 别' AFTER `realname`;
ALTER TABLE `v9_member`ADD  `birthday` varchar(11) DEFAULT NULL COMMENT '出生日期' AFTER `sex`;
ALTER TABLE `v9_member`ADD  `province` varchar(20) DEFAULT NULL COMMENT '籍贯省' AFTER `birthday`;
ALTER TABLE `v9_member`ADD  `city` varchar(20) DEFAULT NULL COMMENT '籍贯城市' AFTER `province`;
ALTER TABLE `v9_member`ADD  `area` varchar(20) DEFAULT NULL COMMENT '籍贯区域' AFTER `city`;
ALTER TABLE `v9_member`ADD  `real_status` varchar(2) DEFAULT NULL COMMENT '认证的状态' AFTER `area`;



-- 地区
CREATE TABLE IF NOT EXISTS `v9_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `nid` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
    KEY `nid` (`nid`),
    KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地区表';



-- 常用信息表
DROP TABLE IF EXISTS `v9_linkage`;
CREATE TABLE `v9_linkage` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `status` smallint(2) unsigned DEFAULT '0' COMMENT '状态',
  `order` smallint(6) DEFAULT '0' COMMENT '排序',
  `type_id` smallint(5) unsigned DEFAULT '0' COMMENT '类型',
  `pid` varchar(30) DEFAULT NULL COMMENT '所属联动',
  `name` varchar(250) DEFAULT NULL COMMENT '联动名称',
  `value` varchar(250) DEFAULT NULL COMMENT '联动的值',
  `addtime` int(10) DEFAULT '0',
  `addip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `type_ida` (`type_id`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='常用信息表';


DROP TABLE IF EXISTS `v9_linkage_type`;
CREATE TABLE `v9_linkage_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` smallint(6) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `nid` varchar(50) DEFAULT NULL,
  `addtime` int(10) DEFAULT '0',
  `addip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nid` (`nid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='常用信息分类表';




DROP TABLE IF EXISTS `v9_upfiles`;
CREATE TABLE `v9_upfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '名称',
  `code` varchar(50) DEFAULT NULL COMMENT '模块',
  `aid` varchar(50) DEFAULT NULL COMMENT '所属模块id',
  `status` int(2) DEFAULT '0' COMMENT '状态',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `filetype` varchar(50) DEFAULT NULL COMMENT '文件类型',
  `filename` varchar(100) DEFAULT NULL COMMENT '文件名称',
  `filesize` int(10) DEFAULT '0' COMMENT '文件大小',
  `fileurl` varchar(200) DEFAULT NULL COMMENT '文件地址',
  `if_cover` int(2) DEFAULT '0' COMMENT '是否封面',
  `order` int(10) DEFAULT '0' COMMENT '排序',
  `hits` int(11) DEFAULT '0' COMMENT '点击次数',
  `addtime` varchar(30) DEFAULT NULL COMMENT '添加时间',
  `addip` varchar(30) DEFAULT NULL COMMENT '添加ip',
  `updatetime` varchar(30) DEFAULT NULL COMMENT '修改时间',
  `updateip` varchar(30) DEFAULT NULL COMMENT '修改ip',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='上传文件表';

DROP TABLE IF EXISTS `v9_account_bank`;
CREATE TABLE `v9_account_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '用户ID',
  `account` varchar(100) DEFAULT NULL COMMENT '账号',
  `bank` varchar(50) DEFAULT NULL COMMENT '所属银行',
  `branch` varchar(100) DEFAULT NULL COMMENT '支行',
  `province` int(5) DEFAULT '0' COMMENT '省份',
  `city` int(5) DEFAULT '0' COMMENT '城市',
  `area` int(5) DEFAULT '0' COMMENT '区',
  `addtime` varchar(11) DEFAULT NULL,
  `addip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='银行帐户';


DROP TABLE IF EXISTS `v9_account`;
CREATE TABLE `v9_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '用户名称',
  `total` decimal(11,2) DEFAULT '0.00' COMMENT '资金总额',
  `use_money` decimal(11,2) DEFAULT '0.00' COMMENT '已使用资金总额',
  `no_use_money` decimal(11,2) DEFAULT '0.00' COMMENT '没有使用资金总额',
  `collection` decimal(11,2) DEFAULT '0.00' COMMENT '取款金额',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帐户金额表';


DROP TABLE IF EXISTS `v9_borrow`;
CREATE TABLE `v9_borrow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '所属站点',
  `userid` int(11) DEFAULT '0' COMMENT '用户名称',
  `name` varchar(255) DEFAULT NULL COMMENT '标题',
  `status` int(2) DEFAULT '0' COMMENT '状态',
  `order` int(11) DEFAULT '0' COMMENT '排序',
  `hits` int(11) DEFAULT '0' COMMENT '点击次数',
  `litpic` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `flag` varchar(50) DEFAULT NULL COMMENT '属性',
  `is_vouch` int(2) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '',
  `view_type` int(11) NOT NULL DEFAULT '0',
  `vouch_award` varchar(40) NOT NULL DEFAULT '',
  `vouch_user` varchar(100) NOT NULL DEFAULT '',
  `vouch_account` varchar(50) NOT NULL DEFAULT '',
  `vouch_times` int(11) NOT NULL DEFAULT '0',
  `source` varchar(50) DEFAULT NULL COMMENT '来源',
  `publish` varchar(50) DEFAULT NULL COMMENT '发布时间',
  `customer` varchar(11) DEFAULT NULL COMMENT '客服',
  `number_id` varchar(50) DEFAULT NULL,
  `verify_user` varchar(11) DEFAULT NULL COMMENT '审核人',
  `verify_time` varchar(50) DEFAULT NULL COMMENT '客服',
  `verify_remark` varchar(255) DEFAULT NULL,
  `repayment_user` int(11) DEFAULT '0',
  `forst_account` varchar(50) DEFAULT '0',
  `repayment_account` varchar(50) DEFAULT NULL,
  `monthly_repayment` varchar(50) DEFAULT NULL COMMENT '每月还款额',
  `repayment_yesaccount` varchar(50) DEFAULT '0',
  `repayment_yesinterest` int(11) NOT NULL DEFAULT '0',
  `repayment_time` varchar(50) DEFAULT NULL,
  `repayment_remark` varchar(250) DEFAULT NULL,
  `success_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `payment_account` varchar(50) DEFAULT NULL,
  `each_time` varchar(50) DEFAULT NULL,
  `use` varchar(50) DEFAULT NULL COMMENT '用途',
  `time_limit` varchar(50) DEFAULT NULL COMMENT '借款期限',
  `style` varchar(50) DEFAULT NULL COMMENT '还款方式',
  `account` varchar(50) DEFAULT NULL COMMENT '借贷总金额',
  `account_yes` varchar(10) DEFAULT '0',
  `tender_times` varchar(11) DEFAULT '0',
  `apr` decimal(18,2) DEFAULT NULL COMMENT '年利率',
  `lowest_account` varchar(50) DEFAULT NULL COMMENT '最低投标金额',
  `most_account` varchar(50) DEFAULT NULL COMMENT '最多投标总额',
  `valid_time` varchar(50) DEFAULT NULL COMMENT '有效时间',
  `award` varchar(50) DEFAULT NULL COMMENT '投标奖励',
  `part_account` varchar(50) DEFAULT NULL COMMENT '分摊奖励金额',
  `funds` varchar(50) DEFAULT NULL COMMENT '比例奖励的比例',
  `is_false` varchar(50) DEFAULT NULL COMMENT '标的失败时也同样奖励 ',
  `open_account` varchar(50) DEFAULT NULL COMMENT '公开我的帐户资金情况',
  `open_borrow` varchar(50) DEFAULT NULL COMMENT '公开我的借款资金情况',
  `open_tender` varchar(50) DEFAULT NULL COMMENT '公开我的投标资金情况',
  `open_credit` varchar(50) DEFAULT NULL COMMENT '公开我的信用额度情况',
  `content` text COMMENT '详细说明',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`userid`),
  KEY `user_ids` (`userid`,`status`),
  KEY `user_idst` (`status`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='贷款表';


DROP TABLE IF EXISTS `v9_account_log`;
CREATE TABLE `v9_account_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0' COMMENT '用户ID',
  `type` varchar(100) DEFAULT NULL COMMENT '类型',
  `total` decimal(11,2) DEFAULT '0.00',
  `money` decimal(20,2) DEFAULT NULL COMMENT '金额',
  `use_money` decimal(10,2) DEFAULT '0.00' COMMENT '可用金额',
  `no_use_money` decimal(10,2) DEFAULT '0.00' COMMENT '冻结金额',
  `collection` decimal(11,2) DEFAULT '0.00',
  `to_user` int(11) DEFAULT NULL COMMENT '交易对方',
  `remark` varchar(250) DEFAULT '0' COMMENT '备注',
  `addtime` varchar(11) DEFAULT NULL,
  `addip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`userid`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='资金记录';



DROP TABLE IF EXISTS `v9_member_cache`;
CREATE TABLE `v9_member_cache` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `kefu_userid` int(11) DEFAULT NULL,
  `kefu_username` int(11) DEFAULT NULL,
  `kefu_addtime` int(11) DEFAULT NULL,
  `vip_status` int(2) DEFAULT '0',
  `vip_remark` varchar(250) DEFAULT NULL,
  `vip_money` varchar(100) DEFAULT NULL,
  `vip_verify_remark` varchar(100) DEFAULT NULL,
  `vip_verify_time` varchar(100) DEFAULT NULL,
  `bbs_topics_num` int(11) DEFAULT '0',
  `bbs_posts_num` int(11) DEFAULT '0',
  `credit` int(11) DEFAULT '0' COMMENT '积分',
  `account` int(11) DEFAULT '0' COMMENT '帐户总额',
  `account_use` int(11) DEFAULT '0' COMMENT '可用金额',
  `account_nouse` int(11) DEFAULT '0' COMMENT '冻结金额',
  `account_waitin` int(11) DEFAULT '0' COMMENT '代收总额',
  `account_waitintrest` int(11) DEFAULT '0' COMMENT '代收利息',
  `account_intrest` int(11) DEFAULT '0' COMMENT '净赚利息',
  `account_award` int(11) DEFAULT '0' COMMENT '投标奖励',
  `account_payment` int(11) DEFAULT '0' COMMENT '待还总额',
  `account_expired` int(11) DEFAULT '0' COMMENT '逾期总额',
  `account_waitvip` int(11) DEFAULT '0' COMMENT 'vip会费',
  `borrow_amount` int(11) DEFAULT '3000' COMMENT '借款额度',
  `vouch_amount` int(11) NOT NULL DEFAULT '0' COMMENT '担保额度',
  `borrow_loan` int(11) DEFAULT '0' COMMENT '成功借出',
  `borrow_success` int(11) DEFAULT '0' COMMENT '成功借款',
  `borrow_wait` int(11) DEFAULT '0' COMMENT '等待满标',
  `borrow_paymeng` int(11) DEFAULT '0' COMMENT '待还借款',
  `friends_apply` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='会员缓丛记录表';


DROP TABLE IF EXISTS `v9_borrow_tender`;
CREATE TABLE `v9_borrow_tender` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '所属站点',
  `userid` int(11) DEFAULT '0' COMMENT '用户名称',
  `status` int(2) DEFAULT '0' COMMENT '状态',
  `borrow_id` int(11) DEFAULT '0',
  `money` varchar(50) DEFAULT NULL,
  `account` varchar(10) DEFAULT '0',
  `repayment_account` varchar(50) DEFAULT '0' COMMENT '总额',
  `interest` varchar(11) NOT NULL DEFAULT '0',
  `repayment_yesaccount` varchar(50) DEFAULT '0' COMMENT '已还总额',
  `wait_account` varchar(11) DEFAULT '0' COMMENT '待还总额',
  `wait_interest` varchar(11) DEFAULT '0' COMMENT '待还利息',
  `repayment_yesinterest` varchar(50) DEFAULT '0' COMMENT '已还利息',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`userid`),
  KEY `user_idb` (`borrow_id`),
  KEY `user_idub` (`userid`,`borrow_id`),
  KEY `user_idubs` (`userid`,`borrow_id`,`status`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='招标';



DROP TABLE IF EXISTS `v9_borrow_collection`;
CREATE TABLE `v9_borrow_collection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '所属站点',
  `status` int(2) DEFAULT '0',
  `order` int(2) DEFAULT NULL,
  `tender_id` int(11) DEFAULT '0' COMMENT '借款id',
  `repay_time` varchar(50) DEFAULT NULL COMMENT '估计还款时间',
  `repay_yestime` varchar(50) DEFAULT NULL COMMENT '已经还款时间',
  `repay_account` varchar(50) DEFAULT '0' COMMENT '预还金额',
  `repay_yesaccount` varchar(50) DEFAULT '0' COMMENT '实还金额',
  `interest` varchar(50) DEFAULT '0',
  `capital` varchar(50) DEFAULT '0',
  `late_days` int(11) NOT NULL DEFAULT '0',
  `late_interest` varchar(11) NOT NULL DEFAULT '0',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='贷款还款金额';



DROP TABLE IF EXISTS `v9_borrow_repayment`;
CREATE TABLE `v9_borrow_repayment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0' COMMENT '所属站点',
  `status` int(2) DEFAULT '0',
  `webstatus` int(2) NOT NULL DEFAULT '0' COMMENT '网站代还',
  `order` int(2) DEFAULT NULL,
  `borrow_id` int(11) DEFAULT '0' COMMENT '借款id',
  `repayment_time` varchar(50) DEFAULT NULL COMMENT '估计还款时间',
  `repayment_yestime` varchar(50) DEFAULT NULL COMMENT '已经还款时间',
  `repayment_account` varchar(50) DEFAULT '0' COMMENT '预还金额',
  `repayment_yesaccount` varchar(50) DEFAULT '0' COMMENT '实还金额',
  `late_days` int(11) NOT NULL DEFAULT '0',
  `late_interest` varchar(11) NOT NULL DEFAULT '0',
  `interest` varchar(50) DEFAULT '0',
  `capital` varchar(50) DEFAULT '0',
  `forfeit` varchar(50) DEFAULT '0' COMMENT '滞纳金',
  `reminder_fee` varchar(50) DEFAULT '0' COMMENT '崔收费',
  `addtime` varchar(50) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_idb` (`borrow_id`),
  KEY `user_idubs` (`borrow_id`,`status`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='贷款实际还款金额表';


DROP TABLE IF EXISTS `v9_member_amount`;
CREATE TABLE `v9_member_amount` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '调整恢复额度',
  `userid` int(11) NOT NULL DEFAULT '0',
  `credit` decimal(11,2) NOT NULL DEFAULT '0.00',
  `credit_use` decimal(11,2) NOT NULL DEFAULT '0.00',
  `credit_nouse` decimal(11,2) NOT NULL DEFAULT '0.00',
  `borrow_vouch` decimal(11,2) NOT NULL DEFAULT '0.00',
  `borrow_vouch_use` decimal(11,2) NOT NULL DEFAULT '0.00',
  `borrow_vouch_nouse` decimal(11,2) NOT NULL DEFAULT '0.00',
  `tender_vouch` decimal(11,2) NOT NULL DEFAULT '0.00',
  `tender_vouch_use` decimal(11,2) NOT NULL DEFAULT '0.00',
  `tender_vouch_nouse` decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8 COMMENT='会员资金表';