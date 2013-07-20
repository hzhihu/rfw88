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



--增加认证字段
ALTER TABLE `v9_member`ADD  `avatar_status` int(2) DEFAULT '0' COMMENT '实名认证' AFTER `vip`;
ALTER TABLE `v9_member`ADD  `email_status` varchar(50) DEFAULT 0 COMMENT '邮箱认证' AFTER `avatar_status`;
ALTER TABLE `v9_member`ADD  `phone_status` varchar(50) DEFAULT '0' COMMENT '头像认证' AFTER `email_status`;



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

