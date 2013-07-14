# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28-log)
# Database: phpcms
# Generation Time: 2013-07-09 17:29:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '金融产品ID',
  `userid` int(11) unsigned NOT NULL COMMENT '会员id',
  `catid` int(11) unsigned NOT NULL COMMENT '所属分类id',
  `type` int(11) unsigned NOT NULL COMMENT '标的类型',
  `money` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '借款金额',
  `money_range` int(11) NOT NULL COMMENT '金额范围',
  `timeout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '还款时间',
  `timeout_range` varchar(1) NOT NULL DEFAULT '' COMMENT '还款范围',
  `money_rate` decimal(10,5) DEFAULT NULL COMMENT '利率 ',
  `trade_type` int(11) unsigned NOT NULL COMMENT '还款方式',
  `max_money` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '最大投标金额',
  `plan` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '标的进度,10个进度',
  `award_money` decimal(10,2) unsigned NOT NULL COMMENT '投标的奖励',
  `date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
