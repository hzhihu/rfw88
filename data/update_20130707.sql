SET NAMES 'utf8';

-- 增加是否前台注册页面显示
ALTER TABLE `v9_model_field` MODIFY COLUMN `isaddReg` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否前台注册显示' AFTER `isadd`;
