-- phpMyAdmin SQL Dump
-- version 4.0.10.19
-- https://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018-04-12 12:38:36
-- 服务器版本: 5.5.54-log
-- PHP 版本: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sql272316`
--

-- --------------------------------------------------------

--
-- 表的结构 `h_admin`
--

CREATE TABLE IF NOT EXISTS `h_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_passWord` varchar(50) DEFAULT NULL,
  `h_nickName` varchar(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '1',
  `h_addTime` datetime DEFAULT NULL,
  `h_permissions` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `h_admin`
--

INSERT INTO `h_admin` (`id`, `h_userName`, `h_passWord`, `h_nickName`, `h_isPass`, `h_addTime`, `h_permissions`) VALUES
(5, 'admin', '263f09db1b31b710f3ae012f045b7e6f', '技术账号', 1, NULL, ',基本配置,网站Logo,客服设置,推荐会员提成配置,直荐升级配置,激活会员配置,拍卖配置,提现配置,抽奖配置,农场物品设置,玩家公告,会员列表,会员物品列表,推荐结构,金币拍卖列表,商城商品管理,商城订单列表,会员登录记录,加减激活币,激活币流水明细,加减金币,金币流水明细,充值管理,提现管理,会员消息列表,发送消息给会员,收到的会员消息,清空数据,调整时间,帐号管理,');

-- --------------------------------------------------------

--
-- 表的结构 `h_article`
--

CREATE TABLE IF NOT EXISTS `h_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_location` varchar(20) DEFAULT NULL,
  `h_menuId` int(11) DEFAULT NULL,
  `h_title` varchar(250) DEFAULT NULL,
  `h_pageKey` varchar(250) DEFAULT NULL,
  `h_categoryId` int(11) DEFAULT '0',
  `h_picSmall` varchar(250) DEFAULT NULL,
  `h_picBig` varchar(250) DEFAULT NULL,
  `h_picBig2` varchar(250) DEFAULT NULL,
  `h_picBig3` varchar(250) DEFAULT NULL,
  `h_picBig4` varchar(250) DEFAULT NULL,
  `h_picBig5` varchar(250) DEFAULT NULL,
  `h_picBig6` varchar(250) DEFAULT NULL,
  `h_picBig7` varchar(250) DEFAULT NULL,
  `h_picBig8` varchar(250) DEFAULT NULL,
  `h_picBig9` varchar(250) DEFAULT NULL,
  `h_picBig10` varchar(250) DEFAULT NULL,
  `h_isLink` int(11) DEFAULT NULL,
  `h_href` varchar(250) DEFAULT NULL,
  `h_target` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_order` int(11) DEFAULT '0',
  `h_clicks` int(11) DEFAULT '0',
  `h_keyword` text,
  `h_description` text,
  `h_info` text,
  `h_jj` text,
  `h_dataSheet` varchar(250) DEFAULT NULL,
  `h_download` varchar(250) DEFAULT NULL,
  `h_pm` varchar(250) DEFAULT NULL,
  `h_pfwz` varchar(250) DEFAULT NULL,
  `h_cz` varchar(250) DEFAULT NULL,
  `h_gy` varchar(250) DEFAULT NULL,
  `h_ys` varchar(250) DEFAULT NULL,
  `h_mz` varchar(250) DEFAULT NULL,
  `h_lsj` decimal(9,2) DEFAULT '0.00',
  `h_hyj` decimal(9,2) DEFAULT '0.00',
  `h_tc1` decimal(9,2) DEFAULT '0.00',
  `h_tc2` decimal(9,2) DEFAULT '0.00',
  `h_tc3` decimal(9,2) DEFAULT '0.00',
  `h_kc` int(11) DEFAULT '0' COMMENT '库存',
  `h_isPass` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=416 ;

--
-- 转存表中的数据 `h_article`
--

INSERT INTO `h_article` (`id`, `h_location`, `h_menuId`, `h_title`, `h_pageKey`, `h_categoryId`, `h_picSmall`, `h_picBig`, `h_picBig2`, `h_picBig3`, `h_picBig4`, `h_picBig5`, `h_picBig6`, `h_picBig7`, `h_picBig8`, `h_picBig9`, `h_picBig10`, `h_isLink`, `h_href`, `h_target`, `h_addTime`, `h_order`, `h_clicks`, `h_keyword`, `h_description`, `h_info`, `h_jj`, `h_dataSheet`, `h_download`, `h_pm`, `h_pfwz`, `h_cz`, `h_gy`, `h_ys`, `h_mz`, `h_lsj`, `h_hyj`, `h_tc1`, `h_tc2`, `h_tc3`, `h_kc`, `h_isPass`) VALUES
(409, '网站主栏目', 108, '理财静态', NULL, 227, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-10 10:38:51', 0, 0, NULL, NULL, '<p><strong><font color="#ff0000">理财静态：<br />\r\n购买10元理财币&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 每天收益2元/天&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8天16元出局<br />\r\n购买30元理财币&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 每天收益6元/天&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8天48元出局<br />\r\n购买200元理财币&nbsp;&nbsp;&nbsp; 每天收益40元/天&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8天320元出局<br />\r\n购买500元理财币&nbsp;&nbsp;&nbsp; 每天收益106元/天&nbsp;&nbsp;&nbsp; 8天848元出局<br />\r\n购买1500元理财币&nbsp; 每天收益338元/天&nbsp; 8天2704元出局<br />\r\n购买3000元理财币&nbsp; 每天收益712元/天&nbsp; 8天5696元出局</font></strong></p>\r\n\r\n<p><strong><font color="#ff0000">提现：1金币起提（1金币=1元）10分钟内到账，提现无手续费。<br />\r\n分红：下单后立即到账第一天的分红，可随时提现，第二天分红以第一天购买时间结算。</font></strong></p>\r\n\r\n<p><strong><font color="#ff0000">动态推荐奖8代：<br />\r\n一代8%&nbsp;&nbsp; 二代4%&nbsp;&nbsp; 三代5%&nbsp;&nbsp; 四代3%&nbsp;<br />\r\n五代2%&nbsp;&nbsp; 六代1%&nbsp;&nbsp; 七代2%&nbsp;&nbsp; 八代1%</font></strong></p>\r\n\r\n<p><strong><font color="#ff0000">提现奖：<br />\r\n直推人10人提现1000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 奖励100元<br />\r\n直推人20人提现3000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 奖励528元<br />\r\n直推人30人提现5000&nbsp;&nbsp;&nbsp;&nbsp; 奖励1088元<br />\r\n直推人40人提现10000&nbsp;&nbsp; 奖励1688元​</font></strong></p>\r\n优势：手机网站+PC网站+APP操作，高防高配服务器，备案域名。顶尖技术防黑客攻击！<br />\r\n<span style="color: rgb(255,0,0)"><strong>比公众号稳定三倍，不封号、不死盘，稳定运营、长远发展！</strong></span>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `h_category`
--

CREATE TABLE IF NOT EXISTS `h_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_location` varchar(20) DEFAULT NULL,
  `h_menuId` int(11) DEFAULT NULL,
  `h_title` varchar(250) DEFAULT NULL,
  `h_pageKey` varchar(200) DEFAULT NULL,
  `h_order` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_picBig` varchar(250) DEFAULT NULL,
  `h_picBigN` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228 ;

--
-- 转存表中的数据 `h_category`
--

INSERT INTO `h_category` (`id`, `h_location`, `h_menuId`, `h_title`, `h_pageKey`, `h_order`, `h_addTime`, `h_picBig`, `h_picBigN`) VALUES
(227, '网站主栏目', 108, '玩家公告', NULL, 1, '2016-01-31 21:25:00', '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_config`
--

CREATE TABLE IF NOT EXISTS `h_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_webName` varchar(50) DEFAULT NULL,
  `h_webLogo` varchar(250) DEFAULT NULL,
  `h_webLogoLogin` varchar(250) DEFAULT NULL,
  `h_webKeyword` varchar(250) DEFAULT NULL,
  `h_keyword` text,
  `h_description` text,
  `h_leftContact` text,
  `h_counter` text,
  `h_footer` text,
  `h_rewriteOpen` int(11) DEFAULT '0',
  `h_point1Member` int(11) DEFAULT '0' COMMENT '激活会员需要多少激活币',
  `h_point1MemberPoint2` int(11) DEFAULT '0' COMMENT '被激活的会员拥有多少金币',
  `h_point2Quit` int(11) DEFAULT '0' COMMENT '放弃已经拍下来的金币，扣多少金币作为惩罚',
  `h_withdrawFee` decimal(11,2) DEFAULT '0.00' COMMENT '提现手续费百分比',
  `h_withdrawMinCom` int(11) DEFAULT '0' COMMENT '提现要求至少直荐多少人',
  `h_withdrawMinMoney` int(11) DEFAULT '0' COMMENT '提现最低要求金额',
  `h_point2Lottery` int(11) DEFAULT '0' COMMENT '抽奖一次扣多少金币',
  `h_lottery1` int(11) DEFAULT '0' COMMENT '1等奖中奖概率，万分之几',
  `h_lottery2` int(11) DEFAULT '0',
  `h_lottery3` int(11) DEFAULT '0',
  `h_lottery4` int(11) DEFAULT '0',
  `h_lottery5` int(11) DEFAULT '0',
  `h_lottery6` int(11) DEFAULT '0',
  `h_point2Com1` decimal(11,2) DEFAULT '0.00' COMMENT '1代直推奖励',
  `h_point2Com2` decimal(11,2) DEFAULT '0.00',
  `h_point2Com3` decimal(11,2) DEFAULT '0.00',
  `h_point2Com4` decimal(11,2) DEFAULT '0.00',
  `h_point2Com5` decimal(11,2) DEFAULT '0.00',
  `h_point2Com6` decimal(11,2) DEFAULT '0.00' COMMENT '6-10保留，未用',
  `h_point2Com7` decimal(11,3) DEFAULT '0.000',
  `h_point2Com8` decimal(11,3) DEFAULT '0.000',
  `h_point2Com9` decimal(11,2) DEFAULT '0.00',
  `h_point2Com10` decimal(11,2) DEFAULT '0.00',
  `h_levelUpTo0` int(11) DEFAULT '0' COMMENT '升级至vip需要直荐多少人',
  `h_levelUpTo1` int(11) DEFAULT '0',
  `h_levelUpTo2` int(11) DEFAULT '0',
  `h_levelUpTo3` int(11) DEFAULT '0',
  `h_levelUpTo4` int(11) DEFAULT '0',
  `h_levelUpTo5` int(11) DEFAULT '0' COMMENT '5-10保留，未启用',
  `h_levelUpTo6` int(11) DEFAULT '0',
  `h_levelUpTo7` int(11) DEFAULT '0',
  `h_levelUpTo8` int(11) DEFAULT '0',
  `h_levelUpTo9` int(11) DEFAULT '0',
  `h_levelUpTo10` int(11) DEFAULT '0',
  `h_serviceQQ` char(255) DEFAULT NULL,
  `h_point2ComReg` int(11) DEFAULT '0' COMMENT '推荐1个注册会员送金币',
  `h_point2ComRegAct` int(11) DEFAULT '0' COMMENT '推荐的会员被激活时送金币',
  `h_point2ComBuy` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `h_config`
--

INSERT INTO `h_config` (`id`, `h_webName`, `h_webLogo`, `h_webLogoLogin`, `h_webKeyword`, `h_keyword`, `h_description`, `h_leftContact`, `h_counter`, `h_footer`, `h_rewriteOpen`, `h_point1Member`, `h_point1MemberPoint2`, `h_point2Quit`, `h_withdrawFee`, `h_withdrawMinCom`, `h_withdrawMinMoney`, `h_point2Lottery`, `h_lottery1`, `h_lottery2`, `h_lottery3`, `h_lottery4`, `h_lottery5`, `h_lottery6`, `h_point2Com1`, `h_point2Com2`, `h_point2Com3`, `h_point2Com4`, `h_point2Com5`, `h_point2Com6`, `h_point2Com7`, `h_point2Com8`, `h_point2Com9`, `h_point2Com10`, `h_levelUpTo0`, `h_levelUpTo1`, `h_levelUpTo2`, `h_levelUpTo3`, `h_levelUpTo4`, `h_levelUpTo5`, `h_levelUpTo6`, `h_levelUpTo7`, `h_levelUpTo8`, `h_levelUpTo9`, `h_levelUpTo10`, `h_serviceQQ`, `h_point2ComReg`, `h_point2ComRegAct`, `h_point2ComBuy`) VALUES
(1, '****国际理财', '/ui/images/logo.png', '/upload/logo.png.png', '玉洁国际理财', '玉洁国际理财', '玉洁国际理财', '', '', '', 0, 0, 0, 10, '0.00', 1, 1, 2, 1, 1, 1, 200, 1666, 7668, '0.08', '0.04', '0.05', '0.03', '0.02', '0.01', '0.020', '0.010', '0.00', '0.00', 0, 111111, 111111, 111111, 111111, 0, 0, 0, 0, 0, 0, '无，客服微信：wxlc2288', 0, 10, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h_farm_shop`
--

CREATE TABLE IF NOT EXISTS `h_farm_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_title` char(50) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_point2Day` int(11) DEFAULT '0' COMMENT '每天生产金币',
  `h_life` int(11) DEFAULT '0' COMMENT '生存周期',
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  `h_minMemberLevel` int(11) DEFAULT '0' COMMENT '购买最低会员等级',
  `h_dayBuyMaxNum` int(11) DEFAULT '0' COMMENT '每天限购数量',
  `h_allMaxNum` int(11) DEFAULT '0' COMMENT '农场中最多存在多少只',
  `h_order` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_location` varchar(20) DEFAULT NULL,
  `h_menuId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- 转存表中的数据 `h_farm_shop`
--

INSERT INTO `h_farm_shop` (`id`, `h_title`, `h_pic`, `h_point2Day`, `h_life`, `h_money`, `h_minMemberLevel`, `h_dayBuyMaxNum`, `h_allMaxNum`, `h_order`, `h_addTime`, `h_location`, `h_menuId`) VALUES
(107, '200元普通理财', '/upload/2017/05/200.png', 40, 8, 200, 1, 1, 5000, 0, '0000-00-00 00:00:00', NULL, NULL),
(108, '500元普通理财', '/upload/2017/05/500.png', 106, 8, 500, 2, 1, 5000, 0, '0000-00-00 00:00:00', NULL, NULL),
(109, '10元普通理财', '/upload/2017/05/10.png', 2, 8, 10, 0, 1, 500, 0, '2016-12-25 00:00:00', NULL, NULL),
(115, '1500元普通理财', '/upload/2017/05/1500.png', 338, 8, 1500, 3, 1, 5000, 0, '2017-01-11 13:50:58', NULL, NULL),
(117, '3000元普通理财', '/upload/2017/05/3000.png', 712, 8, 3000, 4, 1, 5000, 0, '2017-12-16 17:52:50', NULL, NULL),
(118, '30元股权认购', '/upload/2017/05/30.png', 25, 5, 100, 0, 1, 5000, 0, '2017-12-18 16:41:50', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_guestbook`
--

CREATE TABLE IF NOT EXISTS `h_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_fullName` varchar(50) DEFAULT NULL,
  `h_address` varchar(250) DEFAULT NULL,
  `h_email` varchar(50) DEFAULT NULL,
  `h_phone` varchar(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_log_point1`
--

CREATE TABLE IF NOT EXISTS `h_log_point1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_price` decimal(14,2) DEFAULT '0.00',
  `h_about` varchar(250) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(50) DEFAULT NULL,
  `h_type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_log_point2`
--

CREATE TABLE IF NOT EXISTS `h_log_point2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_price` decimal(14,2) DEFAULT '0.00',
  `h_about` varchar(250) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(50) DEFAULT NULL,
  `h_type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `h_log_point2`
--

INSERT INTO `h_log_point2` (`id`, `h_userName`, `h_price`, `h_about`, `h_addTime`, `h_actIP`, `h_type`) VALUES
(1, '18876115599', '99999.00', '', '2018-04-03 09:33:05', '112.66.21.160', '管理员操作'),
(2, '18876115599', '-10.00', '10元普通理财，数量：1', '2018-04-03 09:37:18', '112.66.21.160', '购买物品'),
(3, '18876115599', '2.00', '登录，系统自动拾取物品金币', '2018-04-03 09:37:18', '112.66.21.160', '物品产币'),
(4, '18876115599', '-200.00', '200元普通理财，数量：1', '2018-04-03 16:00:27', '117.136.46.120', '购买物品'),
(5, '18876115599', '40.00', '登录，系统自动拾取物品金币', '2018-04-03 16:00:27', '117.136.46.120', '物品产币'),
(6, '18876115599', '42.00', '登录，系统自动拾取物品金币', '2018-04-04 22:57:31', '112.66.30.223', '物品产币'),
(7, '18876115599', '-200.00', '200元普通理财，数量：1', '2018-04-04 23:41:41', '110.52.129.43, 10.123.150.44', '购买物品'),
(8, '18876115599', '40.00', '登录，系统自动拾取物品金币', '2018-04-04 23:41:41', '110.52.129.43, 10.123.150.44', '物品产币'),
(9, '18876115599', '-10.00', '10元普通理财，数量：1', '2018-04-05 01:27:07', '221.210.48.2', '购买物品'),
(10, '18876115599', '2.00', '登录，系统自动拾取物品金币', '2018-04-05 01:27:07', '221.210.48.2', '物品产币'),
(11, '18876115599', '-30.00', '30元普通理财，数量：1', '2018-04-05 01:27:10', '221.210.48.2', '购买物品'),
(12, '18876115599', '6.00', '登录，系统自动拾取物品金币', '2018-04-05 01:27:10', '221.210.48.2', '物品产币'),
(13, '18876115599', '-500.00', '500元普通理财，数量：1', '2018-04-05 01:27:11', '221.210.48.2', '购买物品'),
(14, '18876115599', '106.00', '登录，系统自动拾取物品金币', '2018-04-05 01:27:11', '221.210.48.2', '物品产币'),
(15, '18876115599', '-1500.00', '1500元普通理财，数量：1', '2018-04-05 01:27:13', '221.210.48.2', '购买物品'),
(16, '18876115599', '338.00', '登录，系统自动拾取物品金币', '2018-04-05 01:27:13', '221.210.48.2', '物品产币'),
(17, '18876115599', '-3000.00', '3000元普通理财，数量：1', '2018-04-05 01:27:15', '221.210.48.2', '购买物品'),
(18, '18876115599', '712.00', '登录，系统自动拾取物品金币', '2018-04-05 01:27:15', '221.210.48.2', '物品产币'),
(19, '18876115599', '1328.00', '登录，系统自动拾取物品金币', '2018-04-06 11:33:35', '113.250.227.66', '物品产币'),
(20, '18876115599', '-10.00', '10元普通理财，数量：1', '2018-04-06 11:34:08', '113.250.227.66', '购买物品'),
(21, '18876115599', '2.00', '登录，系统自动拾取物品金币', '2018-04-06 11:34:08', '113.250.227.66', '物品产币'),
(22, '18876115599', '2496.00', '登录，系统自动拾取物品金币', '2018-04-08 13:27:40', '117.42.216.54', '物品产币'),
(23, '18876115599', '-200.00', '200元普通理财，数量：1', '2018-04-08 13:27:53', '117.42.216.54', '购买物品'),
(24, '18876115599', '40.00', '登录，系统自动拾取物品金币', '2018-04-08 13:27:53', '117.42.216.54', '物品产币'),
(25, '18876115599', '-500.00', '500元普通理财，数量：1', '2018-04-08 13:46:22', '117.42.216.54', '购买物品'),
(26, '18876115599', '106.00', '登录，系统自动拾取物品金币', '2018-04-08 13:46:22', '117.42.216.54', '物品产币'),
(27, '18876115599', '2788.00', '登录，系统自动拾取物品金币', '2018-04-10 15:23:27', '112.66.21.187', '物品产币'),
(28, '18876115599', '1352.00', '登录，系统自动拾取物品金币', '2018-04-11 15:44:21', '112.66.23.71', '物品产币'),
(29, '18876115599', '-3000.00', '3000元普通理财，数量：1', '2018-04-11 15:56:46', '112.96.68.174', '购买物品'),
(30, '18876115599', '712.00', '登录，系统自动拾取物品金币', '2018-04-11 15:56:46', '112.96.68.174', '物品产币'),
(31, '18876115599', '-10.00', '10元普通理财，数量：1', '2018-04-11 21:42:51', '115.60.45.114', '购买物品'),
(32, '18876115599', '2.00', '登录，系统自动拾取物品金币', '2018-04-11 21:42:51', '115.60.45.114', '物品产币'),
(33, '18876115599', '-100.00', '一百元股权认购，数量：1', '2018-04-11 22:30:46', '117.61.11.148', '购买物品'),
(34, '18876115599', '25.00', '登录，系统自动拾取物品金币', '2018-04-11 22:30:46', '117.61.11.148', '物品产币'),
(35, '18876115599', '-1500.00', '1500元普通理财，数量：1', '2018-04-12 00:49:31', '223.104.64.254', '购买物品'),
(36, '18876115599', '338.00', '登录，系统自动拾取物品金币', '2018-04-12 00:49:31', '223.104.64.254', '物品产币'),
(37, '15046446306', '1000.00', '', '2018-04-12 11:21:58', '27.193.229.152', '管理员操作'),
(38, '15046446306', '-10.00', '10元普通理财，数量：1', '2018-04-12 11:22:48', '27.193.229.152', '购买物品'),
(39, '15046446306', '2.00', '登录，系统自动拾取物品金币', '2018-04-12 11:22:48', '27.193.229.152', '物品产币'),
(40, '15765489214', '0.16', '第1代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:48', '27.193.229.152', '物品产币分红'),
(41, '18876115599', '0.08', '第2代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:48', '27.193.229.152', '物品产币分红'),
(42, '15046446306', '-100.00', '30元股权认购，数量：1', '2018-04-12 11:22:50', '27.193.229.152', '购买物品'),
(43, '15046446306', '25.00', '登录，系统自动拾取物品金币', '2018-04-12 11:22:50', '27.193.229.152', '物品产币'),
(44, '15765489214', '2.00', '第1代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:50', '27.193.229.152', '物品产币分红'),
(45, '18876115599', '1.00', '第2代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:50', '27.193.229.152', '物品产币分红'),
(46, '15046446306', '-200.00', '200元普通理财，数量：1', '2018-04-12 11:22:52', '27.193.229.152', '购买物品'),
(47, '15046446306', '40.00', '登录，系统自动拾取物品金币', '2018-04-12 11:22:52', '27.193.229.152', '物品产币'),
(48, '15765489214', '3.20', '第1代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:52', '27.193.229.152', '物品产币分红'),
(49, '18876115599', '1.60', '第2代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:52', '27.193.229.152', '物品产币分红'),
(50, '15046446306', '-500.00', '500元普通理财，数量：1', '2018-04-12 11:22:54', '27.193.229.152', '购买物品'),
(51, '15046446306', '106.00', '登录，系统自动拾取物品金币', '2018-04-12 11:22:54', '27.193.229.152', '物品产币'),
(52, '15765489214', '8.48', '第1代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:54', '27.193.229.152', '物品产币分红'),
(53, '18876115599', '4.24', '第2代会员15046446306登录，系统自动拾取其物品金币', '2018-04-12 11:22:54', '27.193.229.152', '物品产币分红');

-- --------------------------------------------------------

--
-- 表的结构 `h_member`
--

CREATE TABLE IF NOT EXISTS `h_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_passWord` varchar(32) DEFAULT NULL,
  `h_passWordII` varchar(32) DEFAULT NULL,
  `h_fullName` varchar(20) DEFAULT NULL,
  `h_sex` varchar(2) DEFAULT NULL,
  `h_mobile` varchar(11) DEFAULT NULL,
  `h_qq` varchar(20) DEFAULT NULL,
  `h_email` varchar(50) DEFAULT NULL,
  `h_regTime` datetime DEFAULT NULL,
  `h_regIP` char(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '0' COMMENT '是否激活，激活才能登录',
  `h_moneyCurr` decimal(9,2) DEFAULT '0.00' COMMENT '会员余额',
  `h_parentUserName` varchar(20) DEFAULT NULL,
  `h_level` int(11) DEFAULT '0',
  `h_point1` decimal(14,2) DEFAULT '0.00' COMMENT '激活币',
  `h_point2` decimal(14,2) DEFAULT '0.00' COMMENT '金币',
  `h_lastTime` datetime DEFAULT NULL,
  `h_lastIP` char(50) DEFAULT NULL,
  `h_alipayUserName` char(100) DEFAULT NULL,
  `h_alipayFullName` char(100) DEFAULT NULL,
  `h_addrAddress` char(255) DEFAULT NULL,
  `h_addrPostcode` char(20) DEFAULT NULL,
  `h_addrFullName` char(20) DEFAULT NULL,
  `h_addrTel` char(20) DEFAULT NULL,
  `h_weixin` char(100) DEFAULT NULL,
  `h_logins` int(11) DEFAULT '0',
  `h_a1` char(255) DEFAULT NULL,
  `h_q1` char(255) DEFAULT NULL,
  `h_a2` char(255) DEFAULT NULL,
  `h_q2` char(255) DEFAULT NULL,
  `h_a3` char(255) DEFAULT NULL,
  `h_q3` char(255) DEFAULT NULL,
  `h_isLock` int(11) DEFAULT '0' COMMENT '锁定，不可登录',
  `first_buy` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `h_member`
--

INSERT INTO `h_member` (`id`, `h_userName`, `h_passWord`, `h_passWordII`, `h_fullName`, `h_sex`, `h_mobile`, `h_qq`, `h_email`, `h_regTime`, `h_regIP`, `h_isPass`, `h_moneyCurr`, `h_parentUserName`, `h_level`, `h_point1`, `h_point2`, `h_lastTime`, `h_lastIP`, `h_alipayUserName`, `h_alipayFullName`, `h_addrAddress`, `h_addrPostcode`, `h_addrFullName`, `h_addrTel`, `h_weixin`, `h_logins`, `h_a1`, `h_q1`, `h_a2`, `h_q2`, `h_a3`, `h_q3`, `h_isLock`, `first_buy`) VALUES
(1, '18876115599', '5abd06d6f6ef0e022e11b8a41f57ebda', '5abd06d6f6ef0e022e11b8a41f57ebda', NULL, NULL, NULL, NULL, NULL, '2018-03-22 12:50:25', '112.66.20.71', 1, '0.00', '', 4, '0.00', '99720.92', '2018-04-12 11:08:55', '27.193.229.152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, '15765489214', '745c4376b30e615b21ccb17dc92c173c', '5e543256c480ac577d30f76f9120eb74', '刘鑫垚', NULL, NULL, NULL, NULL, '2018-04-05 01:40:42', '221.210.48.2', 1, '0.00', '18876115599', 4, '0.00', '13.84', '2018-04-10 18:48:58', '221.210.48.2', '15046446306', '刘鑫垚', 'undefined', 'undefined', 'undefined', 'undefined', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, '15046446306', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'qq', NULL, NULL, '', NULL, '2018-04-06 23:54:44', '221.210.48.2', 1, '0.00', '15765489214', 4, '0.00', '363.00', '2018-04-12 11:22:41', '27.193.229.152', '', '', '', '', '', '', NULL, 3, '', '', '', '', '', '', 0, 0),
(3, '15765489211', '9507450460eb69c979bd22c7da5152d4', '5e543256c480ac577d30f76f9120eb74', NULL, NULL, NULL, NULL, NULL, '2018-04-05 19:30:38', '223.104.17.114', 1, '0.00', '15765489214', 4, '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h_member_farm`
--

CREATE TABLE IF NOT EXISTS `h_member_farm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_pid` int(11) DEFAULT '0' COMMENT '动物id',
  `h_num` int(11) DEFAULT '0' COMMENT '动物数量',
  `h_addTime` datetime DEFAULT NULL COMMENT '购买时间',
  `h_endTime` datetime DEFAULT NULL COMMENT '动物死亡时间',
  `h_lastSettleTime` datetime DEFAULT NULL COMMENT '最后一次结算时间，直接在结算时记录当前时间；只用于显示或者备忘，结算算法中不用这个字段',
  `h_settleLen` int(11) DEFAULT '0' COMMENT '结算次数',
  `h_isEnd` int(11) DEFAULT '0' COMMENT '动物是否死亡',
  `h_title` char(50) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_point2Day` int(11) DEFAULT '0' COMMENT '每天生产金币',
  `h_life` int(11) DEFAULT '0' COMMENT '生存周期',
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `h_member_farm`
--

INSERT INTO `h_member_farm` (`id`, `h_userName`, `h_pid`, `h_num`, `h_addTime`, `h_endTime`, `h_lastSettleTime`, `h_settleLen`, `h_isEnd`, `h_title`, `h_pic`, `h_point2Day`, `h_life`, `h_money`) VALUES
(1, '18876115599', 109, 1, '2018-04-03 09:37:18', '2018-04-12 09:37:18', '2018-04-10 15:23:27', 8, 1, '10元普通理财', '/upload/2017/05/10.png', 2, 8, 10),
(2, '18876115599', 107, 1, '2018-04-03 16:00:27', '2018-04-12 16:00:27', '2018-04-10 15:23:27', 8, 1, '200元普通理财', '/upload/2017/05/200.png', 40, 8, 200),
(3, '18876115599', 107, 1, '2018-04-04 23:41:41', '2018-04-13 23:41:41', '2018-04-11 15:44:21', 8, 1, '200元普通理财', '/upload/2017/05/200.png', 40, 8, 200),
(4, '18876115599', 109, 1, '2018-04-05 01:27:07', '2018-04-14 01:27:07', '2018-04-11 15:44:21', 7, 0, '10元普通理财', '/upload/2017/05/10.png', 2, 8, 10),
(5, '18876115599', 118, 1, '2018-04-05 01:27:10', '2018-04-14 01:27:10', '2018-04-11 15:44:21', 7, 0, '30元普通理财', '/upload/2017/05/30.png', 6, 8, 30),
(6, '18876115599', 108, 1, '2018-04-05 01:27:11', '2018-04-14 01:27:11', '2018-04-11 15:44:21', 7, 0, '500元普通理财', '/upload/2017/05/500.png', 106, 8, 500),
(7, '18876115599', 115, 1, '2018-04-05 01:27:13', '2018-04-14 01:27:13', '2018-04-11 15:44:21', 7, 0, '1500元普通理财', '/upload/2017/05/1500.png', 338, 8, 1500),
(8, '18876115599', 117, 1, '2018-04-05 01:27:15', '2018-04-14 01:27:15', '2018-04-11 15:44:21', 7, 0, '3000元普通理财', '/upload/2017/05/3000.png', 712, 8, 3000),
(9, '18876115599', 109, 1, '2018-04-06 11:34:08', '2018-04-15 11:34:08', '2018-04-11 15:44:21', 6, 0, '10元普通理财', '/upload/2017/05/10.png', 2, 8, 10),
(10, '18876115599', 107, 1, '2018-04-08 13:27:53', '2018-04-17 13:27:53', '2018-04-11 15:44:21', 4, 0, '200元普通理财', '/upload/2017/05/200.png', 40, 8, 200),
(11, '18876115599', 108, 1, '2018-04-08 13:46:22', '2018-04-17 13:46:22', '2018-04-11 15:44:21', 4, 0, '500元普通理财', '/upload/2017/05/500.png', 106, 8, 500),
(12, '18876115599', 117, 1, '2018-04-11 15:56:46', '2018-04-20 15:56:46', '2018-04-11 15:56:46', 1, 0, '3000元普通理财', '/upload/2017/05/3000.png', 712, 8, 3000),
(13, '18876115599', 109, 1, '2018-04-11 21:42:51', '2018-04-20 21:42:51', '2018-04-11 21:42:51', 1, 0, '10元普通理财', '/upload/2017/05/10.png', 2, 8, 10),
(14, '18876115599', 118, 1, '2018-04-11 22:30:46', '2018-04-17 22:30:46', '2018-04-11 22:30:46', 1, 0, '一百元股权认购', '/upload/2017/05/30.png', 25, 5, 100),
(15, '18876115599', 115, 1, '2018-04-12 00:49:31', '2018-04-21 00:49:31', '2018-04-12 00:49:31', 1, 0, '1500元普通理财', '/upload/2017/05/1500.png', 338, 8, 1500),
(16, '15046446306', 109, 1, '2018-04-12 11:22:48', '2018-04-21 11:22:48', '2018-04-12 11:22:48', 1, 0, '10元普通理财', '/upload/2017/05/10.png', 2, 8, 10),
(17, '15046446306', 118, 1, '2018-04-12 11:22:50', '2018-04-18 11:22:50', '2018-04-12 11:22:50', 1, 0, '30元股权认购', '/upload/2017/05/30.png', 25, 5, 100),
(18, '15046446306', 107, 1, '2018-04-12 11:22:52', '2018-04-21 11:22:52', '2018-04-12 11:22:52', 1, 0, '200元普通理财', '/upload/2017/05/200.png', 40, 8, 200),
(19, '15046446306', 108, 1, '2018-04-12 11:22:54', '2018-04-21 11:22:54', '2018-04-12 11:22:54', 1, 0, '500元普通理财', '/upload/2017/05/500.png', 106, 8, 500);

-- --------------------------------------------------------

--
-- 表的结构 `h_member_msg`
--

CREATE TABLE IF NOT EXISTS `h_member_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_toUserName` varchar(20) DEFAULT NULL COMMENT '买家',
  `h_info` text,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(39) DEFAULT NULL,
  `h_isRead` int(11) DEFAULT '0',
  `h_readTime` datetime DEFAULT NULL,
  `h_isDelete` int(11) DEFAULT '0' COMMENT '放弃或删除',
  `h_deleteTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `h_member_msg`
--

INSERT INTO `h_member_msg` (`id`, `h_userName`, `h_toUserName`, `h_info`, `h_addTime`, `h_actIP`, `h_isRead`, `h_readTime`, `h_isDelete`, `h_deleteTime`) VALUES
(1, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费10金币', '2018-04-03 09:37:18', '112.66.21.160', 0, NULL, 0, NULL),
(2, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费200金币', '2018-04-03 16:00:27', '117.136.46.120', 0, NULL, 0, NULL),
(3, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费200金币', '2018-04-04 23:41:41', '110.52.129.43, 10.123.150.44', 0, NULL, 0, NULL),
(4, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费10金币', '2018-04-05 01:27:07', '221.210.48.2', 0, NULL, 0, NULL),
(5, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费30金币', '2018-04-05 01:27:10', '221.210.48.2', 0, NULL, 0, NULL),
(6, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费500金币', '2018-04-05 01:27:11', '221.210.48.2', 0, NULL, 0, NULL),
(7, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费1500金币', '2018-04-05 01:27:13', '221.210.48.2', 0, NULL, 0, NULL),
(8, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费3000金币', '2018-04-05 01:27:15', '221.210.48.2', 0, NULL, 0, NULL),
(9, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费10金币', '2018-04-06 11:34:08', '113.250.227.66', 0, NULL, 0, NULL),
(10, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费200金币', '2018-04-08 13:27:53', '117.42.216.54', 0, NULL, 0, NULL),
(11, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费500金币', '2018-04-08 13:46:22', '117.42.216.54', 0, NULL, 0, NULL),
(12, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费3000金币', '2018-04-11 15:56:46', '112.96.68.174', 0, NULL, 0, NULL),
(13, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费10金币', '2018-04-11 21:42:51', '115.60.45.114', 0, NULL, 0, NULL),
(14, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费100金币', '2018-04-11 22:30:46', '117.61.11.148', 0, NULL, 0, NULL),
(15, '[系统消息]', '18876115599', '恭喜您购买物品成功，本次共消费1500金币', '2018-04-12 00:49:31', '223.104.64.254', 0, NULL, 0, NULL),
(16, '[系统消息]', '15046446306', '恭喜您购买物品成功，本次共消费10金币', '2018-04-12 11:22:48', '27.193.229.152', 0, NULL, 0, NULL),
(17, '[系统消息]', '15046446306', '恭喜您购买物品成功，本次共消费100金币', '2018-04-12 11:22:50', '27.193.229.152', 0, NULL, 0, NULL),
(18, '[系统消息]', '15046446306', '恭喜您购买物品成功，本次共消费200金币', '2018-04-12 11:22:52', '27.193.229.152', 0, NULL, 0, NULL),
(19, '[系统消息]', '15046446306', '恭喜您购买物品成功，本次共消费500金币', '2018-04-12 11:22:54', '27.193.229.152', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_member_shop_cart`
--

CREATE TABLE IF NOT EXISTS `h_member_shop_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_oid` varchar(20) DEFAULT NULL,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_pid` int(11) DEFAULT '0' COMMENT '动物id',
  `h_num` int(11) DEFAULT '0' COMMENT '动物数量',
  `h_addTime` datetime DEFAULT NULL COMMENT '购买时间',
  `h_title` char(50) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_member_shop_order`
--

CREATE TABLE IF NOT EXISTS `h_member_shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_oid` varchar(20) DEFAULT NULL,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL COMMENT '购买时间',
  `h_addrAddress` char(255) DEFAULT NULL,
  `h_addrPostcode` char(20) DEFAULT NULL,
  `h_addrFullName` char(20) DEFAULT NULL,
  `h_addrTel` char(20) DEFAULT NULL,
  `h_remark` text,
  `h_state` char(20) DEFAULT NULL COMMENT '待发货、已发货、拒绝发货',
  `h_money` int(11) DEFAULT '0' COMMENT '订单总价',
  `h_isReturn` int(20) DEFAULT '0' COMMENT '若审核失败，是否返款了，只返一次',
  `h_reply` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_menu`
--

CREATE TABLE IF NOT EXISTS `h_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_location` varchar(20) DEFAULT NULL,
  `h_type` varchar(20) DEFAULT NULL,
  `h_adminFile` varchar(30) DEFAULT NULL,
  `h_title` varchar(200) DEFAULT NULL,
  `h_pageKey` varchar(200) DEFAULT NULL,
  `h_href` varchar(250) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '1',
  `h_target` varchar(10) DEFAULT NULL,
  `h_order` int(11) DEFAULT '0',
  `h_picBigWidth` int(11) DEFAULT '0',
  `h_picBigHeight` int(11) DEFAULT '0',
  `h_picSmallWidth` int(11) DEFAULT '0',
  `h_picSmallHeight` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- 转存表中的数据 `h_menu`
--

INSERT INTO `h_menu` (`id`, `h_location`, `h_type`, `h_adminFile`, `h_title`, `h_pageKey`, `h_href`, `h_isPass`, `h_target`, `h_order`, `h_picBigWidth`, `h_picBigHeight`, `h_picSmallWidth`, `h_picSmallHeight`) VALUES
(83, '网站主栏目', 'link', 'link.php', '首页', 'index', '/', 1, '_self', 1, 0, 0, 0, 0),
(108, '网站主栏目', 'news', 'news.php', '玩家公告', 'wan-jia-gong-gao', 'http://', 1, '_self', 2, 600, 450, 200, 150),
(109, '网站主栏目', 'pics', 'pics1.php', '农场商店', 'nong-chang-shang-dian', 'http://', 1, '_self', 3, 600, 450, 200, 150);

-- --------------------------------------------------------

--
-- 表的结构 `h_pay_order`
--

CREATE TABLE IF NOT EXISTS `h_pay_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_payId` char(32) DEFAULT NULL,
  `h_orderId` varchar(32) DEFAULT NULL,
  `h_payWay` char(50) DEFAULT NULL,
  `h_payType` char(50) DEFAULT NULL,
  `h_payPrice` decimal(9,2) DEFAULT '0.00' COMMENT '打折后的金额',
  `h_addTime` datetime DEFAULT NULL,
  `h_payTime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '支付时间',
  `h_payState` char(50) DEFAULT '待支付' COMMENT '待支付、已支付、支付失败',
  `h_wxNickName` varchar(250) DEFAULT NULL,
  `h_wxOpenId` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_payId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- 转存表中的数据 `h_pay_order`
--

INSERT INTO `h_pay_order` (`id`, `h_payId`, `h_orderId`, `h_payWay`, `h_payType`, `h_payPrice`, `h_addTime`, `h_payTime`, `h_payState`, `h_wxNickName`, `h_wxOpenId`) VALUES
(106, '20160112212109858', '20160111112850636', '微信', 'JsApiPay', '88888.00', '2016-01-12 21:21:09', '2016-01-12 21:21:09', '已支付', '', ''),
(107, NULL, '10000503011708230012000001710322', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(108, NULL, '20170823200040011100650087321263', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(109, NULL, '20170301200040011100760021939020', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(110, NULL, '20170823200040011100650087356619', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(111, NULL, '20171216110070001502190020303227', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(112, NULL, '20171216110070001502190020247523', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(113, NULL, '20171216110070001502190020289596', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(114, NULL, '10000503011712180242020000310339', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(115, NULL, '10000503011712180112000001110378', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(116, NULL, '10000503011712160112030000410417', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(117, NULL, '10000503011712060112010001210299', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(118, NULL, '20171218200040011100860073845747', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(119, NULL, '20171218200040011100130072347816', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(120, NULL, '10000503011712190112090000710014', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(121, NULL, '20171219200040011100130072586274', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(122, NULL, '10000503011803100242070000810167', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(123, NULL, '10000503011803100242030000410176', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(124, NULL, '20180311200040011100140037643306', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(125, NULL, '10000503011803140242080000910276', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(126, NULL, '10000503011803150242020001310266', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(127, NULL, '10000503011803150242050000610368', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(128, NULL, '10000503011803150242050000610368', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(129, NULL, '10000503011803170242040000510295', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(130, NULL, '10000503011803170242090001010296', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(131, NULL, '10000503011803170242020000320320', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(132, NULL, '20180315200040011100140040217464', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(133, NULL, '20180316200040011100140040773310', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(134, NULL, '20180313200040011100140038705651', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(135, NULL, '10000503011803170242020000310606', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(136, NULL, '10000503011803170242010001210609', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(137, NULL, '10000503011803170242090001010592', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(138, NULL, '10000503011803170242020000310606', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(139, NULL, '10000503011803170242090001010592', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(140, NULL, '10000503011803170242010001210609', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_point2_sell`
--

CREATE TABLE IF NOT EXISTS `h_point2_sell` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0',
  `h_alipayUserName` char(100) DEFAULT NULL,
  `h_alipayFullName` char(100) DEFAULT NULL,
  `h_weixin` char(100) DEFAULT NULL,
  `h_tel` char(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_state` char(20) DEFAULT NULL COMMENT '挂单中、等待买家付款、买家放弃、卖家放弃、等待卖家确认收款、交易完成',
  `h_buyUserName` varchar(20) DEFAULT NULL COMMENT '买家',
  `h_buyTime` datetime DEFAULT NULL,
  `h_buyIsPay` int(11) DEFAULT '0',
  `h_payTime` datetime DEFAULT NULL,
  `h_isDelete` int(11) DEFAULT '0' COMMENT '放弃或删除',
  `h_deleteTime` datetime DEFAULT NULL,
  `h_confirmTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_point2_shop`
--

CREATE TABLE IF NOT EXISTS `h_point2_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_title` char(255) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_minComMembers` int(11) DEFAULT '0' COMMENT '至少要直荐多少人',
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  `h_minMemberLevel` int(11) DEFAULT '0' COMMENT '购买最低会员等级',
  `h_info` text,
  `h_addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_recharge`
--

CREATE TABLE IF NOT EXISTS `h_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0',
  `h_fee` int(11) DEFAULT '0',
  `h_bank` tinyint(2) DEFAULT '0',
  `h_bankFullname` varchar(32) DEFAULT NULL,
  `h_bankCardId` varchar(32) DEFAULT NULL,
  `h_mobile` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_isRead` int(20) DEFAULT '0',
  `h_state` tinyint(20) DEFAULT NULL COMMENT '待审核、已打款、审核失败',
  `h_isReturn` int(20) DEFAULT '0' COMMENT '若审核失败，是否返款了，只返一次',
  `h_reply` char(255) DEFAULT NULL,
  `h_actIP` char(39) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_withdraw`
--

CREATE TABLE IF NOT EXISTS `h_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0',
  `h_fee` int(11) DEFAULT '0',
  `h_bank` varchar(32) DEFAULT NULL,
  `h_bankFullname` varchar(32) DEFAULT NULL,
  `h_bankCardId` varchar(32) DEFAULT NULL,
  `h_mobile` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_isRead` int(20) DEFAULT '0',
  `h_state` char(20) DEFAULT NULL COMMENT '待审核、已打款、审核失败',
  `h_isReturn` int(20) DEFAULT '0' COMMENT '若审核失败，是否返款了，只返一次',
  `h_reply` char(255) DEFAULT NULL,
  `h_actIP` char(39) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_log_login_member`
--

CREATE TABLE IF NOT EXISTS `t_log_login_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` char(20) DEFAULT NULL,
  `h_ip` char(39) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- 转存表中的数据 `t_log_login_member`
--

INSERT INTO `t_log_login_member` (`id`, `h_userName`, `h_ip`, `h_addTime`) VALUES
(1, '18876115599', '112.66.17.61', '2018-03-23 13:55:53'),
(2, '18876115599', '103.83.60.204', '2018-03-23 18:46:26'),
(3, '18876115599', '101.254.211.5', '2018-03-23 18:47:40'),
(4, '18876115599', '103.83.60.204', '2018-03-23 18:53:39'),
(5, '18876115599', '103.83.60.204', '2018-03-23 18:54:18'),
(6, '18876115599', '112.66.17.61', '2018-03-23 19:18:28'),
(7, '18876115599', '103.83.60.204', '2018-03-23 20:13:50'),
(8, '18876115599', '27.186.120.45', '2018-03-23 21:09:28'),
(9, '18876115599', '113.75.208.46', '2018-03-23 22:27:30'),
(10, '18876115599', '112.66.17.61', '2018-03-24 21:40:14'),
(11, '18876115599', '112.66.22.186', '2018-03-27 21:17:31'),
(12, '18876115599', '14.223.184.145', '2018-03-27 23:20:47'),
(13, '18876115599', '183.11.74.224', '2018-03-27 23:22:12'),
(14, '18876115599', '112.66.22.186', '2018-03-28 00:10:22'),
(15, '18876115599', '223.104.189.176', '2018-03-28 01:20:01'),
(16, '18876115599', '112.66.22.186', '2018-03-28 17:48:28'),
(17, '18876115599', '183.11.75.214', '2018-03-29 21:08:57'),
(18, '18876115599', '183.11.75.214', '2018-03-29 21:11:50'),
(19, '18876115599', '59.60.151.225', '2018-03-31 22:45:14'),
(20, '18876115599', '223.149.32.81', '2018-03-31 23:09:40'),
(21, '18876115599', '223.149.32.81', '2018-03-31 23:29:11'),
(22, '18876115599', '223.149.32.81', '2018-03-31 23:29:26'),
(23, '18876115599', '223.149.32.81', '2018-03-31 23:39:20'),
(24, '18876115599', '39.181.143.124', '2018-04-01 01:26:23'),
(25, '18876115599', '112.66.31.50', '2018-04-01 08:56:25'),
(26, '18876115599', '120.229.70.82', '2018-04-01 11:42:35'),
(27, '18876115599', '1.198.113.168', '2018-04-02 01:24:53'),
(28, '18876115599', '112.66.21.160', '2018-04-02 12:52:09'),
(29, '18876115599', '106.17.181.111', '2018-04-02 18:17:53'),
(30, '18876115599', '112.66.21.160', '2018-04-03 09:32:00'),
(31, '18876115599', '112.66.21.160', '2018-04-03 09:37:11'),
(32, '18876115599', '117.136.46.120', '2018-04-03 16:00:21'),
(33, '18876115599', '112.66.30.223', '2018-04-04 22:57:31'),
(34, '18876115599', '112.66.30.223', '2018-04-04 23:02:38'),
(35, '18876115599', '110.52.129.43', '2018-04-04 23:37:17'),
(36, '18876115599', '110.52.129.43', '2018-04-04 23:40:26'),
(37, '18876115599', '221.210.48.2', '2018-04-05 01:26:47'),
(38, '18876115599', '221.210.48.2', '2018-04-05 01:28:34'),
(39, '18876115599', '221.210.48.2', '2018-04-05 01:39:44'),
(40, '15765489214', '221.210.48.2', '2018-04-05 01:41:34'),
(41, '18876115599', '112.252.83.145', '2018-04-05 10:48:12'),
(42, '15765489214', '221.210.48.2', '2018-04-05 13:07:25'),
(43, '15765489214', '223.104.17.114', '2018-04-05 15:19:54'),
(44, '15765489214', '223.104.17.114', '2018-04-05 17:14:36'),
(45, '15765489214', '223.104.17.114', '2018-04-05 19:28:09'),
(46, '15765489214', '113.5.4.131', '2018-04-06 11:08:18'),
(47, '15765489214', '113.5.4.131', '2018-04-06 11:14:24'),
(48, '15765489214', '111.41.248.86', '2018-04-06 11:26:58'),
(49, '18876115599', '113.250.227.66', '2018-04-06 11:33:35'),
(50, '15765489214', '113.5.4.131', '2018-04-06 20:33:07'),
(51, '15765489214', '113.5.4.131', '2018-04-06 21:40:25'),
(52, '18876115599', '117.151.139.184', '2018-04-06 21:53:08'),
(53, '18876115599', '219.157.159.52', '2018-04-06 22:09:15'),
(54, '15046446306', '221.210.48.2', '2018-04-06 23:56:13'),
(55, '15046446306', '221.210.48.2', '2018-04-07 00:54:34'),
(56, '18876115599', '220.178.192.24', '2018-04-07 02:22:57'),
(57, '15765489214', '113.5.5.59', '2018-04-07 21:10:28'),
(58, '18876115599', '117.42.216.54', '2018-04-08 13:27:40'),
(59, '18876115599', '117.42.216.54', '2018-04-08 13:45:27'),
(60, '18876115599', '117.61.1.253', '2018-04-09 10:54:58'),
(61, '18876115599', '117.61.1.253', '2018-04-09 10:55:57'),
(62, '18876115599', '112.66.21.187', '2018-04-10 15:23:27'),
(63, '18876115599', '112.66.21.187', '2018-04-10 18:44:39'),
(64, '18876115599', '112.66.21.187', '2018-04-10 18:47:20'),
(65, '15765489214', '221.210.48.2', '2018-04-10 18:48:58'),
(66, '18876115599', '112.66.23.71', '2018-04-11 10:55:00'),
(67, '18876115599', '27.23.235.142', '2018-04-11 11:46:47'),
(68, '18876115599', '175.2.59.70', '2018-04-11 11:54:56'),
(69, '18876115599', '117.61.144.206', '2018-04-11 12:11:59'),
(70, '18876115599', '144.0.154.85', '2018-04-11 13:34:39'),
(71, '18876115599', '112.66.23.71', '2018-04-11 15:44:21'),
(72, '18876115599', '112.96.68.174', '2018-04-11 15:56:30'),
(73, '18876115599', '113.57.246.235', '2018-04-11 17:13:37'),
(74, '18876115599', '113.57.246.235', '2018-04-11 17:14:27'),
(75, '18876115599', '124.135.93.212', '2018-04-11 21:35:06'),
(76, '18876115599', '124.135.93.212', '2018-04-11 21:42:23'),
(77, '18876115599', '115.60.45.114', '2018-04-11 21:42:36'),
(78, '18876115599', '124.31.164.158', '2018-04-11 21:43:38'),
(79, '18876115599', '117.136.85.52', '2018-04-11 21:56:37'),
(80, '18876115599', '124.135.93.212', '2018-04-11 22:17:07'),
(81, '18876115599', '117.136.85.139', '2018-04-11 22:30:26'),
(82, '18876115599', '223.104.64.254', '2018-04-12 00:48:37'),
(83, '18876115599', '117.61.2.143', '2018-04-12 00:52:42'),
(84, '18876115599', '27.193.229.152', '2018-04-12 09:42:14'),
(85, '18876115599', '27.193.229.152', '2018-04-12 09:49:06'),
(86, '18876115599', '27.193.229.152', '2018-04-12 09:52:57'),
(87, '18876115599', '27.193.229.152', '2018-04-12 09:57:28'),
(88, '18876115599', '27.193.229.152', '2018-04-12 11:08:55'),
(89, '15046446306', '27.193.229.152', '2018-04-12 11:22:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
