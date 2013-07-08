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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 增加所属于模型分类
ALTER TABLE `v9_model_field` ADD `mtype` TINYINT(1)  UNSIGNED  NOT NULL  DEFAULT '0'  COMMENT '所属于模型分类'  AFTER `formtype`;


-- 增加会员模型是否注册时显示字段
ALTER TABLE `v9_model` ADD `reg_view` TINYINT(1)  UNSIGNED  NULL  DEFAULT '1'  COMMENT '是否前台显示'  AFTER `js_template`;
UPDATE `v9_model` SET `reg_view` = '0' WHERE `modelid` = '10';