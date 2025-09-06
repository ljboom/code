-- MySQL dump 10.13  Distrib 5.6.44, for Linux (x86_64)
--
-- Host: localhost    Database: licai_ago520_cn
-- ------------------------------------------------------
-- Server version	5.6.44-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `address_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `area` varchar(120) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `default` int(1) DEFAULT '0',
  `time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,53564,'123','123','上海 闸北区 城区','123',1,'1566637247');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `account` varchar(30) NOT NULL COMMENT '管理员账号',
  `password` varchar(32) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员账号密码';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'13mv','3cf5cffa3f6b813727d901bcad5c7612');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `title` varchar(100) NOT NULL DEFAULT '无' COMMENT '标题',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '文章类型',
  `keyword` varchar(200) NOT NULL DEFAULT '无' COMMENT '关键词',
  `content` text NOT NULL COMMENT '内容',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '时间',
  `show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示，0不显示/1显示',
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='文章表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (9,'常见问题',9,'','&lt;ul class=&quot; list-paddingleft-2&quot; style=&quot;list-style-type: disc;&quot;&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;注册时无法收到手机短信验证码？&lt;/span&gt;&lt;/strong&gt;&lt;br/&gt;&lt;span style=&quot;font-size:12px&quot;&gt;短信验证系统由第三方提供，可能存在延迟，请您耐心等待。如超过60秒仍未收到，请重新验证。若多次操作后仍未收到短信验证码，请联系在线客服及时处理。&lt;/span&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;&lt;br/&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;&lt;/span&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot; list-paddingleft-2&quot; style=&quot;list-style-type: disc;&quot;&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;实名认证可以使用护照号、军官证号吗？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;不可以。您只能填写中国大陆居民18位身份证号码，暂不支持护照或其他证件号码。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;充值之后没有投资行为可以直接提现吗？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;不可以。为防止洗黑钱及恶意套取公司推广奖励的情况出现，所有充值的资金必须在购买产品且正常到期后方可申请提现。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;账户名可以更改吗？&lt;/span&gt;&lt;/strong&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;不可以。已注册的账户名是唯一的，注册成功后无法更改。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;账户充值需手续费吗？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;账户充值不收取任何费用。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;认证成功后，身份证号码可以更换吗？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;不可以。为保障投资者账号及资金安全，实名认证通过后身份证信息无法修改。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;可以绑定多张银行卡吗？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;不可以。每个账户只能绑定一张银行卡用以提现。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;实名认证通不过该怎么办？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;1、请核对真实姓名与身份证号是否匹配；&lt;br/&gt;2、请核对真实姓名是否输入正确；&lt;br/&gt;3、请核对身份证号是否输入正确；&lt;br/&gt;4、在确认信息无误的情况下，若仍无法验证通过，请联系在线客服。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;银行卡认证失败该怎么办？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;1、请核对开户名是否与真实姓名一致；&lt;br/&gt;2、请核对开户名与银行卡号是否匹配；&lt;br/&gt;3、请核对开户行、支行名称是否填写正确；&lt;br/&gt;4、请核对银行卡认证金额是否输入正确。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;充值金额是否有上限？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;充值无金额限制。可充值金额取决于您绑卡银行的支付限额标准，&lt;span style=&quot;font-size: 12px;&quot;&gt;详情请咨询银行客服&lt;/span&gt;。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;是否支持信用卡充值？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;可以使用信用卡支付。&lt;span style=&quot;font-size: 12px;&quot;&gt;可充值金额取决于您的信用卡额度及单笔支付限额，详情请咨询银行客服。&lt;/span&gt;&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;提现多长时间可以到账？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;通常，提现申请到账时间为30分钟内，繁忙时段可能延长至2小时。如超过2小时仍未到账，请联系在线客服及时处理。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;账户提现收取手续费吗？&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:12px&quot;&gt;每日可免费申请提现1次，超过次数的将收取单笔提现金额3%的手续费。&lt;/span&gt;&lt;br/&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong style=&quot;padding: 0px; margin: 0px;&quot;&gt;&lt;span style=&quot;col:#c01920;font-size:12px&quot;&gt;同一身份证信息可以注册多个账户吗？&lt;/span&gt;&lt;/strong&gt;&lt;br/&gt;&lt;span style=&quot;font-size:12px&quot;&gt;不可以。同一身份证信息只能实名注册一个会员账户。如发现使用同一身份证信息实名多个会员账户的，将无条件永久冻结账户及账户内的所有资产，所造成的一切经济损失由您个人承担。&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 21:45:32',1,'20190611040129.png'),(46,'营业执照',4,'营业执照','&lt;p&gt;&lt;img src=&quot;/Public/uploads/article/20190809/1565357520959565.jpg&quot; title=&quot;1565357520959565.jpg&quot; alt=&quot;QQ图片20190809212237.jpg&quot;/&gt;&lt;/p&gt;','2019-08-09 21:33:40',1,'20190809213226.png'),(47,'担保公司',6,'担保公司','&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/Public/uploads/article/20190809/1565358234142478.jpg&quot; title=&quot;1565358234142478.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/Public/uploads/article/20190809/1565358235317402.jpg&quot; title=&quot;1565358235317402.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 21:44:11',1,'20190809214247.png'),(29,'最新资讯',1007,'','&lt;h2 class=&quot;yuqing-title&quot; style=&quot;padding: 0px; margin: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-family: &amp;quot;PingFang SC&amp;quot;, &amp;quot;Microsoft Yahei&amp;quot;, Arial, sans-serif; font-size: 32px; vertical-align: baseline; text-align: center; line-height: 36px; white-space: nmal; background-col: rgb(255, 255, 255);&quot;&gt;《哪咤》成国产动画电影票房新冠军 为光线带来超2亿元营收&lt;/h2&gt;&lt;p&gt;&lt;span style=&quot;padding: 0px; margin: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;2019-07-30 14:13&lt;/span&gt;&amp;nbsp;&lt;span style=&quot;padding: 0px; margin: 0px 0px 0px 14px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;来源：澎湃新闻&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;yuqing-hr&quot; style=&quot;padding: 0px; margin: 30px auto; bder-width: 0px 0px 1px; bder-top-style: initial; bder-right-style: initial; bder-bottom-style: solid; bder-left-style: initial; bder-top-col: initial; bder-right-col: initial; bder-bottom-col: rgb(238, 238, 238); bder-left-col: initial; bder-image: initial; outline: 0px; font-family: &amp;quot;PingFang SC&amp;quot;, &amp;quot;Microsoft Yahei&amp;quot;, Arial, sans-serif; font-size: 14px; vertical-align: baseline; width: 805px; white-space: nmal; background-col: rgb(255, 255, 255);&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;《哪咤之魔童降世》刷新国产动画电影票房纪录，光线传媒成为大赢家。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;截至7月30日12:55，上映第5天的国产动画电影《哪咤之魔童降世》累计票房达到9.57亿元，超过《大圣归来》在2015年创下的9.56亿元纪录，成为国产动画电影新票房冠军。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;当天午间，北京光线传媒股份有限公司( 300251，光线传媒 )公告称，其全资子公司光线影业参与出品、发行的影片《哪咤之魔童降世》已于2019年7月26日起在中国大陆地区公映。据不完全统计，截至2019年7月29日24时，该影片在中国大陆地区上映4天，票房成绩已超过人民币8.99亿元(最终结算数据可能存在误差)，超过公司最近一个会计年度经审计的合并财务报表营业收入的 50%。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;公告表示，截至2019年7月29日，公司来源于该影片的营业收入(目前为票房收入) 区间约为人民币 20,300 万元至人民币 24,300 万元(最终结算数据可能存在误差)。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;不过，光线传媒也提醒投资者，目前，该影片还在上映中，在中国大陆地区的票房收入以华夏电影发行有限责任公司的数据为准。同时，该影片在中国大陆地区的版权销售收入及海外地区的发行收入等尚未发行/结算。该影片的票房收入等营业收入与公司实际可确认的营业收入(包括但不限于影片于院线、影院上映后按确认的票房收入及相应的分账方法所计算的收入及其他收入)可能会存在差异。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;综合猫眼等平台的实时票房数据显示，7月26日，《哪咤之魔童降世》上映首日票房超过1亿元；7月27日，影片当天实时票房突破2亿元，成为中国影史首部单日票房破2亿的动画电影；到了第三天，《哪咤之魔童降世》的累积票房已经突破5亿元。第四天，票房成绩已超过8.99亿元。第五天，已经超过《大圣归来》在2015年创下的9.56亿元纪录，成为国产动画电影新票房冠军。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;《哪咤之魔童降世》是由饺子执导、编剧的动画电影。改编自中国神话故事，讲述了哪咤虽“生而为魔”却“逆天而行斗到底”的成长经历的故事。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;外界普遍预期，《哪咤之魔童降世》总票房有望超越15亿元，有望挑战《疯狂动物城》创造的内地动画影片票房纪录(15.3亿元)。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;《哪咤之魔童降世》发行公司为光线影业有限公司(光线影业)，该影片的出品方包括：光线影业、霍尔果斯彩条屋影业有限公司(霍尔果斯彩条屋)、霍尔果斯可可豆动画影视有限公司(霍尔果斯可可豆)、霍尔果斯十月文化传媒有限公司(霍尔果斯十月文化)和北京彩条屋科技有限公司(北京彩条屋)。&lt;/p&gt;&lt;p class=&quot;black&quot; style=&quot;padding: 12px 0px; margin-top: 0px; margin-bottom: 0px; bder: 0px; outline: 0px; font-weight: inherit; font-style: inherit; font-family: inherit; vertical-align: baseline;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;《哪咤之魔童降世》票房大卖，无疑光线影业将成为最大赢家。&lt;/p&gt;&lt;p class=&quot;yuqing-hr&quot; style=&quot;padding: 0px; margin: 30px auto; outline: 0px;&quot;&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 23:03:33',1,'20190610022116.png'),(35,'公司介绍',1008,'','&lt;p&gt;光线传媒（ENLIGHT MEDIA）成立于1998年，经过21年发展，已成为中国最大的&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E6%B0%91%E8%90%A5/6092699&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;民营&lt;/a&gt;传媒娱乐集团 。&lt;/p&gt;&lt;p&gt;主营业务包括&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E7%94%B5%E8%A7%86/228945&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;电视&lt;/a&gt;节目制作与发行，电影&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E6%8A%95%E8%B5%84/211753&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;投资&lt;/a&gt;、&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E5%88%B6%E4%BD%9C/4123323&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;制作&lt;/a&gt;、宣发，&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E7%94%B5%E8%A7%86%E5%89%A7/20488&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;电视剧&lt;/a&gt;投资、发行，&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E8%89%BA%E4%BA%BA%E7%BB%8F%E7%BA%AA&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;艺人经纪&lt;/a&gt;，新媒体互联网、游戏等。其日播娱乐资讯节目《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E4%B8%AD%E5%9B%BD%E5%A8%B1%E4%B9%90%E6%8A%A5%E9%81%93/13217064&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;中国娱乐报道&lt;/a&gt;》、《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E9%9F%B3%E4%B9%90%E9%A3%8E%E4%BA%91%E6%A6%9C/9918323&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;音乐风云榜&lt;/a&gt;》均已连续播出10年以上，发行的电影《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E6%B3%B0%E5%9B%A7&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;泰囧&lt;/a&gt;》&lt;span class=&quot;sup--nmal&quot; style=&quot;font-size: 12px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; col: rgb(51, 102, 204); curs: pointer; padding: 0px 2px;&quot;&gt;&amp;nbsp;&lt;/span&gt;（12.66亿）《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E8%87%B4%E9%9D%92%E6%98%A5/13216454&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;致青春&lt;/a&gt;》（7.26亿）成为现象级影片，2012、2013年投资制作发行影片20部，总票房超过40亿。自有&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E5%93%81%E7%89%8C&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;品牌&lt;/a&gt;手游《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E5%88%86%E6%89%8B%E5%A4%A7%E5%B8%88/14690115&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;分手大师&lt;/a&gt;》已于2014年6月上线。2016年《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E7%BE%8E%E4%BA%BA%E9%B1%BC/15285584&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;美人鱼&lt;/a&gt;》影片票房突破30亿刷新华语电影票房纪录。&lt;span class=&quot;sup--nmal&quot; style=&quot;font-size: 12px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; col: rgb(51, 102, 204); curs: pointer; padding: 0px 2px;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;近二年，光线传媒成立彩条屋计划&lt;span class=&quot;sup--nmal&quot; style=&quot;font-size: 12px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; col: rgb(51, 102, 204); curs: pointer; padding: 0px 2px;&quot;&gt;&amp;nbsp;&lt;/span&gt;&amp;nbsp;，并先后发行了《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E8%A5%BF%E6%B8%B8%E8%AE%B0%E4%B9%8B%E5%A4%A7%E5%9C%A3%E5%BD%92%E6%9D%A5/13845412&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;西游记之大圣归来&lt;/a&gt;》《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E5%A4%A7%E9%B1%BC%E6%B5%B7%E6%A3%A0/9248052&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;大鱼海棠&lt;/a&gt;》《&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E7%B2%BE%E7%81%B5%E7%8E%8B%E5%BA%A7/15842291&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;精灵王座&lt;/a&gt;》等动画电影。&lt;/p&gt;&lt;p&gt;光线通过持续的改进和创新，始终领导行业潮流，光线引人注目的E标已经成为娱乐界著名&lt;a target=&quot;_blank&quot; href=&quot;https://baike.baidu.com/item/%E6%A0%87%E5%BF%97/535105&quot; style=&quot;col: rgb(19, 110, 194); text-decation-line: none;&quot;&gt;标志&lt;/a&gt;之一。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 16:34:13',1,'20190531152421.png');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_type`
--

DROP TABLE IF EXISTS `article_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(30) NOT NULL DEFAULT '无' COMMENT '名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示，0不显示/1显示',
  `ico` varchar(10) NOT NULL DEFAULT 'help' COMMENT '类型图标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8 COMMENT='文章类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_type`
--

LOCK TABLES `article_type` WRITE;
/*!40000 ALTER TABLE `article_type` DISABLE KEYS */;
INSERT INTO `article_type` VALUES (4,'营业执照',4,1,'notice'),(6,'风险控制',5,1,'notice'),(9,'常见问题',7,1,'notice'),(1005,'会员等级',6,1,'notice'),(1006,'最新活动',3,1,'notice'),(1007,'最新资讯',2,1,'notice'),(1008,'公司简介',1,1,'notice');
/*!40000 ALTER TABLE `article_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `bank` varchar(30) NOT NULL DEFAULT '无' COMMENT '所属银行',
  `account` varchar(30) NOT NULL DEFAULT '0' COMMENT '银行卡号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8 COMMENT='银行卡';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` VALUES (1001,53560,'工商银行','4325847589632145698'),(1002,53562,'工商银行','5469874563214587987'),(1003,53564,'工商银行','63124668646697');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash`
--

DROP TABLE IF EXISTS `cash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `name` varchar(20) NOT NULL DEFAULT '无' COMMENT '提现姓名',
  `bid` int(11) NOT NULL DEFAULT '0' COMMENT '银行卡编号',
  `bank` varchar(30) NOT NULL DEFAULT '无' COMMENT '所属银行',
  `account` varchar(30) NOT NULL DEFAULT '无' COMMENT '银行卡号',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态，0未提现/1已提现/2提现失败',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '提交时间',
  `time2` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '处理时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9920 DEFAULT CHARSET=utf8 COMMENT='提现记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash`
--

LOCK TABLES `cash` WRITE;
/*!40000 ALTER TABLE `cash` DISABLE KEYS */;
INSERT INTO `cash` VALUES (9918,53562,'abcc',1002,'工商银行','5469874563214587987',1000.00,1,'2019-08-09 22:47:43','2019-08-09 22:49:14'),(9919,53562,'abcc',1002,'工商银行','5469874563214587987',1000.00,1,'2019-08-09 22:47:46','2019-08-09 22:49:12');
/*!40000 ALTER TABLE `cash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codepay_order`
--

DROP TABLE IF EXISTS `codepay_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codepay_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) unsigned NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) unsigned NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  UNIQUE KEY `pay_no` (`pay_no`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codepay_order`
--

LOCK TABLES `codepay_order` WRITE;
/*!40000 ALTER TABLE `codepay_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `codepay_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codepay_user`
--

DROP TABLE IF EXISTS `codepay_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codepay_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `vip` int(1) NOT NULL DEFAULT '0' COMMENT '会员开通',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codepay_user`
--

LOCK TABLES `codepay_user` WRITE;
/*!40000 ALTER TABLE `codepay_user` DISABLE KEYS */;
INSERT INTO `codepay_user` VALUES (1,'admin',0.00,0,0);
/*!40000 ALTER TABLE `codepay_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finance`
--

DROP TABLE IF EXISTS `finance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型,1收入/2支出',
  `reason` varchar(200) NOT NULL DEFAULT '无' COMMENT '摘要',
  `before` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '加入前余额',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31956 DEFAULT CHARSET=utf8 COMMENT='财务表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finance`
--

LOCK TABLES `finance` WRITE;
/*!40000 ALTER TABLE `finance` DISABLE KEYS */;
INSERT INTO `finance` VALUES (31840,53560,1.00,1,'每日签到，获得奖励1元',200001.01,'2019-08-04 20:43:59'),(31841,53560,1.00,1,'每日签到，获得奖励1元',200002.01,'2019-08-07 18:03:06'),(31842,53561,18.00,1,'会员注册，系统赠送18.00元',0.00,'2019-08-07 19:59:58'),(31843,53560,100.00,1,'充值成功并赠送积分100',200003.01,'2019-08-07 23:54:58'),(31844,53560,1.00,1,'每日签到，获得奖励1元',200103.01,'2019-08-08 01:20:42'),(31845,53562,18.00,1,'会员注册，系统赠送18.00元',0.00,'2019-08-09 12:37:27'),(31846,53560,300.00,2,'投资项目：新手项目体验（限投一次），使用余额300元',200104.01,'2019-08-09 16:07:57'),(31847,53560,3444.00,2,'投资项目：88888，使用余额3444元',199804.01,'2019-08-09 18:38:10'),(31848,53560,22.00,1,'投资送红包',196360.01,'2019-08-09 18:38:10'),(31849,53560,300.00,2,'投资项目：11111111，使用余额300元',196382.01,'2019-08-09 18:56:08'),(31850,53560,22.00,1,'投资送红包',196082.01,'2019-08-09 18:56:08'),(31851,53560,300.00,2,'投资项目：11111111，使用余额300元',196104.01,'2019-08-09 18:59:12'),(31852,53560,22.00,1,'投资送红包',195804.01,'2019-08-09 18:59:12'),(31853,53562,300.00,2,'投资项目：11111111，使用余额300元',10000.00,'2019-08-09 19:07:27'),(31854,53561,9.00,1,'推荐会员投资300元奖励9元！',10000.00,'2019-08-09 19:07:27'),(31855,53560,6.00,1,'推荐会员投资300元奖励6元！',195826.01,'2019-08-09 19:07:27'),(31856,53561,6.00,1,'推荐会员投资300元奖励6元！',10009.00,'2019-08-09 19:07:27'),(31857,53562,22.00,1,'投资送红包',9700.00,'2019-08-09 19:07:27'),(31858,53562,300.00,2,'投资项目：11111111，使用余额300元',9722.00,'2019-08-09 19:16:46'),(31859,53561,9.00,1,'推荐会员投资300元奖励9元！',10015.00,'2019-08-09 19:16:46'),(31860,53560,6.00,1,'推荐会员投资300元奖励6元！',195832.01,'2019-08-09 19:16:46'),(31861,53561,6.00,1,'推荐会员投资300元奖励6元！',10024.00,'2019-08-09 19:16:46'),(31862,53562,22.00,1,'投资送红包',9422.00,'2019-08-09 19:16:46'),(31863,53560,10000.00,1,'充值成功并赠送积分10000',195838.01,'2019-08-09 21:29:24'),(31864,53560,200.00,2,'投资项目：我为车狂，使用余额200元',205838.01,'2019-08-09 21:29:45'),(31865,53560,1.00,1,'投资送红包',205638.01,'2019-08-09 21:29:45'),(31866,53560,2.00,1,'每日签到，获得奖励2元',205639.01,'2019-08-09 21:29:47'),(31867,53562,1000.00,2,'余额提现1000元',9444.00,'2019-08-09 22:47:43'),(31868,53562,1000.00,2,'余额提现1000元',8444.00,'2019-08-09 22:47:46'),(31869,53564,10000000.00,1,'充值成功并赠送积分10000000',0.00,'2019-08-09 23:35:49'),(31870,53564,200.00,2,'投资项目：我为车狂，使用余额200元',10000000.00,'2019-08-09 23:37:08'),(31871,53564,1.00,1,'投资送红包',9999800.00,'2019-08-09 23:37:08'),(31872,53564,1000.00,2,'投资项目：光天化日，使用余额1000元',9999801.00,'2019-08-09 23:37:22'),(31873,53564,5000.00,2,'投资项目：冰之下，使用余额5000元',9998801.00,'2019-08-09 23:37:36'),(31874,53564,150000.00,2,'投资项目：西伯利亚风云，使用余额150000元',9993801.00,'2019-08-09 23:37:55'),(31875,53564,50000.00,2,'投资项目：画个圈圈，使用余额50000元',9843801.00,'2019-08-09 23:38:20'),(31876,53564,100000.00,2,'投资项目：日不落酒店，使用余额100000元',9793801.00,'2019-08-09 23:38:42'),(31877,53564,150000.00,2,'投资项目：拳锋2，使用余额150000元',9693801.00,'2019-08-09 23:39:05'),(31878,53564,300000.00,2,'投资项目：恋爱攻略，使用余额300000元',9543801.00,'2019-08-09 23:46:28'),(31879,53564,10000.00,2,'投资项目：跨越星空的爱，使用余额10000元',9243801.00,'2019-08-09 23:47:10'),(31880,53562,6.75,1,'11111111 第1期收益6.75元',7444.00,'2019-08-23 02:00:21'),(31881,53562,6.75,1,'11111111 第2期收益6.75元',7450.75,'2019-08-23 02:00:23'),(31882,53562,6.75,1,'11111111 第3期收益6.75元',7457.50,'2019-08-23 02:00:24'),(31883,53562,6.75,1,'11111111 第4期收益6.75元',7464.25,'2019-08-23 02:00:25'),(31884,53562,306.75,1,'11111111 第5期收益306.75元',7471.00,'2019-08-23 02:00:27'),(31885,53562,6.75,1,'11111111 第1期收益6.75元',7777.75,'2019-08-23 02:00:28'),(31886,53562,6.75,1,'11111111 第2期收益6.75元',7784.50,'2019-08-23 02:00:30'),(31887,53562,6.75,1,'11111111 第3期收益6.75元',7791.25,'2019-08-23 02:00:31'),(31888,53562,6.75,1,'11111111 第4期收益6.75元',7798.00,'2019-08-23 02:00:32'),(31889,53562,306.75,1,'11111111 第5期收益306.75元',7804.75,'2019-08-23 02:00:34'),(31890,53564,206.00,1,'我为车狂 第1期收益206.00元',9233801.00,'2019-08-23 02:00:35'),(31891,53564,1028.50,1,'光天化日 第1期收益1028.50元',9234007.00,'2019-08-23 02:00:35'),(31892,53564,147.50,1,'冰之下 第1期收益147.50元',9235035.50,'2019-08-23 02:00:36'),(31893,53564,147.50,1,'冰之下 第2期收益147.50元',9235183.00,'2019-08-23 02:00:37'),(31894,53564,5147.50,1,'冰之下 第3期收益5147.50元',9235330.50,'2019-08-23 02:00:38'),(31895,53564,2250.00,1,'西伯利亚风云 第1期收益2250.00元',9240478.00,'2019-08-23 02:00:38'),(31896,53564,2250.00,1,'西伯利亚风云 第2期收益2250.00元',9242728.00,'2019-08-23 02:00:40'),(31897,53564,2250.00,1,'西伯利亚风云 第3期收益2250.00元',9244978.00,'2019-08-23 02:00:42'),(31898,53564,2250.00,1,'西伯利亚风云 第4期收益2250.00元',9247228.00,'2019-08-23 02:00:44'),(31899,53564,2250.00,1,'西伯利亚风云 第5期收益2250.00元',9249478.00,'2019-08-23 02:00:46'),(31900,53564,2250.00,1,'西伯利亚风云 第6期收益2250.00元',9251728.00,'2019-08-23 02:00:48'),(31901,53564,2250.00,1,'西伯利亚风云 第7期收益2250.00元',9253978.00,'2019-08-23 02:00:50'),(31902,53564,2250.00,1,'西伯利亚风云 第8期收益2250.00元',9256228.00,'2019-08-23 02:00:52'),(31903,53564,2250.00,1,'西伯利亚风云 第9期收益2250.00元',9258478.00,'2019-08-23 02:00:54'),(31904,53564,2250.00,1,'西伯利亚风云 第10期收益2250.00元',9260728.00,'2019-08-23 02:00:56'),(31905,53564,2250.00,1,'西伯利亚风云 第11期收益2250.00元',9262978.00,'2019-08-23 02:00:58'),(31906,53564,152250.00,1,'西伯利亚风云 第12期收益152250.00元',9265228.00,'2019-08-23 02:00:58'),(31907,53564,1450.00,1,'画个圈圈 第1期收益1450.00元',9417478.00,'2019-08-23 02:00:59'),(31908,53564,1450.00,1,'画个圈圈 第2期收益1450.00元',9418928.00,'2019-08-23 02:01:00'),(31909,53564,1450.00,1,'画个圈圈 第3期收益1450.00元',9420378.00,'2019-08-23 02:01:00'),(31910,53564,1450.00,1,'画个圈圈 第4期收益1450.00元',9421828.00,'2019-08-23 02:01:01'),(31911,53564,51450.00,1,'画个圈圈 第5期收益51450.00元',9423278.00,'2019-08-23 02:01:02'),(31912,53564,2980.00,1,'日不落酒店 第1期收益2980.00元',9474728.00,'2019-08-23 02:01:02'),(31913,53564,2980.00,1,'日不落酒店 第2期收益2980.00元',9477708.00,'2019-08-23 02:01:04'),(31914,53564,2980.00,1,'日不落酒店 第3期收益2980.00元',9480688.00,'2019-08-23 02:01:05'),(31915,53564,2980.00,1,'日不落酒店 第4期收益2980.00元',9483668.00,'2019-08-23 02:01:06'),(31916,53564,2980.00,1,'日不落酒店 第5期收益2980.00元',9486648.00,'2019-08-23 02:01:08'),(31917,53564,2980.00,1,'日不落酒店 第6期收益2980.00元',9489628.00,'2019-08-23 02:01:09'),(31918,53564,102980.00,1,'日不落酒店 第7期收益102980.00元',9492608.00,'2019-08-23 02:01:12'),(31919,53564,4725.00,1,'拳锋2 第1期收益4725.00元',9595588.00,'2019-08-23 02:01:14'),(31920,53564,4725.00,1,'拳锋2 第2期收益4725.00元',9600313.00,'2019-08-23 02:01:16'),(31921,53564,4725.00,1,'拳锋2 第3期收益4725.00元',9605038.00,'2019-08-23 02:01:18'),(31922,53564,4725.00,1,'拳锋2 第4期收益4725.00元',9609763.00,'2019-08-23 02:01:20'),(31923,53564,4725.00,1,'拳锋2 第5期收益4725.00元',9614488.00,'2019-08-23 02:01:22'),(31924,53564,4725.00,1,'拳锋2 第6期收益4725.00元',9619213.00,'2019-08-23 02:01:24'),(31925,53564,4725.00,1,'拳锋2 第7期收益4725.00元',9623938.00,'2019-08-23 02:01:26'),(31926,53564,4725.00,1,'拳锋2 第8期收益4725.00元',9628663.00,'2019-08-23 02:01:28'),(31927,53564,4725.00,1,'拳锋2 第9期收益4725.00元',9633388.00,'2019-08-23 02:01:30'),(31928,53564,4725.00,1,'拳锋2 第10期收益4725.00元',9638113.00,'2019-08-23 02:01:32'),(31929,53564,4725.00,1,'拳锋2 第11期收益4725.00元',9642838.00,'2019-08-23 02:01:34'),(31930,53564,4725.00,1,'拳锋2 第12期收益4725.00元',9647563.00,'2019-08-23 02:01:36'),(31931,53564,4725.00,1,'拳锋2 第13期收益4725.00元',9652288.00,'2019-08-23 02:01:37'),(31932,53564,4725.00,1,'拳锋2 第14期收益4725.00元',9657013.00,'2019-08-23 02:01:38'),(31933,53564,10800.00,1,'恋爱攻略 第1期收益10800.00元',9661738.00,'2019-08-23 02:01:40'),(31934,53564,10800.00,1,'恋爱攻略 第2期收益10800.00元',9672538.00,'2019-08-23 02:01:42'),(31935,53564,10800.00,1,'恋爱攻略 第3期收益10800.00元',9683338.00,'2019-08-23 02:01:44'),(31936,53564,10800.00,1,'恋爱攻略 第4期收益10800.00元',9694138.00,'2019-08-23 02:01:46'),(31937,53564,10800.00,1,'恋爱攻略 第5期收益10800.00元',9704938.00,'2019-08-23 02:01:48'),(31938,53564,10800.00,1,'恋爱攻略 第6期收益10800.00元',9715738.00,'2019-08-23 02:01:50'),(31939,53564,10800.00,1,'恋爱攻略 第7期收益10800.00元',9726538.00,'2019-08-23 02:01:52'),(31940,53564,10800.00,1,'恋爱攻略 第8期收益10800.00元',9737338.00,'2019-08-23 02:01:54'),(31941,53564,10800.00,1,'恋爱攻略 第9期收益10800.00元',9748138.00,'2019-08-23 02:01:56'),(31942,53564,10800.00,1,'恋爱攻略 第10期收益10800.00元',9758938.00,'2019-08-23 02:01:58'),(31943,53564,10800.00,1,'恋爱攻略 第11期收益10800.00元',9769738.00,'2019-08-23 02:02:00'),(31944,53564,10800.00,1,'恋爱攻略 第12期收益10800.00元',9780538.00,'2019-08-23 02:02:02'),(31945,53564,10800.00,1,'恋爱攻略 第13期收益10800.00元',9791338.00,'2019-08-23 02:02:04'),(31946,53564,10800.00,1,'恋爱攻略 第14期收益10800.00元',9802138.00,'2019-08-23 02:02:06'),(31947,53564,666.00,1,'跨越星空的爱 第1期收益666.00元',9812938.00,'2019-08-23 02:02:08'),(31948,53564,666.00,1,'跨越星空的爱 第2期收益666.00元',9813604.00,'2019-08-23 02:02:10'),(31949,53564,10666.00,1,'跨越星空的爱 第3期收益10666.00元',9814270.00,'2019-08-23 02:02:12'),(31950,53564,2.00,1,'每日签到，获得奖励2元',9824936.00,'2019-08-24 16:01:45'),(31951,53564,100.00,1,'充值成功并赠送积分100',9824938.00,'2019-08-24 16:02:46'),(31952,53565,8888.00,1,'111111111111111',0.00,'2019-12-13 15:30:20'),(31953,53565,200.00,2,'投资项目：阿丽塔：战斗天使（限投一次），使用余额200元',8888.00,'2019-12-13 15:33:17'),(31954,53565,1.00,1,'投资送红包',8688.00,'2019-12-13 15:33:17'),(31955,53565,2.00,1,'每日签到，获得奖励2元',8689.00,'2019-12-13 15:33:20');
/*!40000 ALTER TABLE `finance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `goods_j_name` varchar(100) DEFAULT NULL,
  `classify_id` int(11) DEFAULT NULL COMMENT '所属分类ID',
  `goods_price` decimal(8,2) DEFAULT '0.00' COMMENT '价格',
  `goods_kc` int(11) DEFAULT '0' COMMENT '商品库存默认0',
  `goods_remark` varchar(255) DEFAULT NULL COMMENT '商品简介',
  `goods_content` text COMMENT '商品详情',
  `photo` varchar(255) DEFAULT NULL COMMENT '商品缩略图',
  `tujilist` varchar(255) DEFAULT NULL COMMENT '商品轮播图',
  `add_time` varchar(100) DEFAULT NULL COMMENT '添加时间',
  `state` int(1) DEFAULT '1' COMMENT '状态1显示0隐藏',
  `tuijian` int(1) DEFAULT '1' COMMENT '1推荐0不推荐',
  `goods_freight` decimal(11,2) DEFAULT '0.00' COMMENT '运费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (11,'Apple iPhone XS Max 64GB 金色 全网通4G 国行 双卡双待','',6,201000.00,22,'Apple iPhone XS Max 64GB 金色 国行','<p><img src=\"/Uploads/ueditor/2019-06-11/1560252544115751.jpg\" title=\"1560252544115751.jpg\" alt=\"XS MAX介绍.jpg\"/></p>','20190611193706.png','N;','1560254900',1,1,0.00),(12,'Apple iPhone XS Max 256GB 深空灰色 全网通4G 国行 双卡双待','',6,219000.00,18,'Apple iPhone XS Max 256GB 深空灰色 国行','<p><img src=\"/Uploads/ueditor/2019-06-11/1560254612745568.jpg\" title=\"1560254612745568.jpg\" alt=\"XS MAX介绍.jpg\"/></p>','20190611200345.jpg','N;','1560254850',1,1,0.00),(13,'Apple iPhone X 64GB 银色 全网通4G 国行','',6,126000.00,36,'Apple iPhone X 64GB 银色 国行','<p><img src=\"/Uploads/ueditor/2019-06-11/1560255099535315.jpg\" title=\"1560255099535315.jpg\" alt=\"X介绍.jpg\"/></p>','20190611201149.jpg','N;','1560255109',1,1,0.00),(14,'华为 HUAWEI P30 Pro 超感光徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+256GB极光色全网通版双4G手机','',6,145000.00,5,'华为 HUAWEI P30 Pro 8GB+256GB 极光色','<p><img src=\"/Uploads/ueditor/2019-06-11/1560255379299156.jpg\" title=\"1560255379299156.jpg\" alt=\"P30介绍.jpg\"/></p>','20190611201626.jpg','N;','1560255386',1,1,0.00),(15,'华为 HUAWEI 荣耀V20 麒麟980芯片 魅眼全视屏 4800万深感相机 幻夜黑 全网通 8G+128G 手机','',6,65000.00,22,'华为 HUAWEI 荣耀V20 幻夜黑 全网通 8G+128G ','<p><img src=\"/Uploads/ueditor/2019-06-11/1560256354380443.png\" title=\"1560256354380443.png\" alt=\"c34dae37a1640af6.png\"/></p><p><img src=\"/Uploads/ueditor/2019-06-11/1560256381132804.png\" title=\"1560256381132804.png\" alt=\"f21c8e120cc67c2b.png\"/></p><p><img src=\"/Uploads/ueditor/2019-06-11/1560256178279663.png\" title=\"1560256178279663.png\" alt=\"3f5fc49bf0dbe29b.png\"/><img src=\"/Uploads/ueditor/2019-06-11/1560256183692166.png\" title=\"1560256183692166.png\" alt=\"59321061988eee74.png\"/><br/></p>','20190611202948.png','N;','1560256385',1,1,0.00),(16,'小天才儿童电话手表 Z1y 路径追踪防水GPS定位智能手表 学生儿童移动联通双4G手表','',6,19750.00,67,'小天才儿童电话手表 Z1y 活泼蓝 移动联通双4G','<p><img src=\"/Uploads/ueditor/2019-06-11/1560257556764373.jpg\" title=\"1560257556764373.jpg\" alt=\"介绍.jpg\"/></p>','20190611205256.jpg','N;','1560257604',1,1,0.00);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_classify`
--

DROP TABLE IF EXISTS `goods_classify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classify_title` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `classify_goods_num` int(11) DEFAULT '0' COMMENT '商品数量',
  `photo` varchar(255) DEFAULT NULL COMMENT '分类缩略图',
  `add_time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `state` int(1) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_classify`
--

LOCK TABLES `goods_classify` WRITE;
/*!40000 ALTER TABLE `goods_classify` DISABLE KEYS */;
INSERT INTO `goods_classify` VALUES (6,'数码通讯',6,'20190611191916.png','1560251956',1),(10,'家电电器',0,'20190611191930.png','1560251970',1),(11,'厨房用品',0,'20190611191945.png','1560251985',1),(12,'家居生活',0,'20190611192001.png','1560252001',1),(13,'充值卡券',0,'20190611192020.png','1560252020',1);
/*!40000 ALTER TABLE `goods_classify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `webname` varchar(100) NOT NULL DEFAULT '默认网站' COMMENT '网站名称',
  `company` varchar(100) NOT NULL DEFAULT '公司名称' COMMENT '公司名称',
  `tel` varchar(50) NOT NULL DEFAULT '400-000-0000' COMMENT '客服电话',
  `address` varchar(500) NOT NULL DEFAULT '公司地址' COMMENT '公司地址',
  `notice` varchar(500) NOT NULL DEFAULT '网站公告' COMMENT '网站公告',
  `service` varchar(500) NOT NULL DEFAULT 'http://www.yourdomain.com' COMMENT '客服地址',
  `app` varchar(500) NOT NULL DEFAULT 'http://www.yourdomain.com' COMMENT 'app下载链接',
  `icp` varchar(30) NOT NULL DEFAULT '京ICP备12345678号' COMMENT '备案号',
  `wechat` varchar(100) NOT NULL DEFAULT '微信客服' COMMENT '微信客服',
  `qq` varchar(100) NOT NULL DEFAULT '10000' COMMENT 'QQ客服',
  `cash` int(11) NOT NULL DEFAULT '0' COMMENT '最低提现金额',
  `ranking` varchar(1000) NOT NULL DEFAULT '0' COMMENT '排行榜',
  `contract` varchar(5000) NOT NULL DEFAULT '0' COMMENT '合同模板',
  `pay_bank` varchar(200) NOT NULL DEFAULT '无' COMMENT '银行入款支付描述',
  `pay_bank_type` varchar(50) NOT NULL DEFAULT '无' COMMENT '收款银行',
  `pay_bank_name` varchar(50) NOT NULL DEFAULT '无' COMMENT '收款银行开户名',
  `pay_bank_account` varchar(50) NOT NULL DEFAULT '无' COMMENT '收款银行账号',
  `pay_bank_status` int(11) NOT NULL DEFAULT '0' COMMENT '收款银行是否显示，0不显示/1显示',
  `qr_wechat` varchar(200) NOT NULL DEFAULT '无' COMMENT '微信扫码支付描述',
  `qr_wechat_img` varchar(100) NOT NULL DEFAULT '无' COMMENT '微信二维码地址',
  `qr_wechat_status` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示微信扫码,0隐藏/1显示',
  `qr_alipay` varchar(200) NOT NULL DEFAULT '无' COMMENT '支付宝扫码支付描述',
  `qr_alipay_img` varchar(100) NOT NULL DEFAULT '无' COMMENT '支付宝二维码地址',
  `qr_alipay_status` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示支付宝扫码,0隐藏/1显示',
  `online_wechat` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示微信在线支付,0隐藏/1显示',
  `activity_url` varchar(200) NOT NULL DEFAULT '#' COMMENT '活动链接',
  `activity_status` int(11) NOT NULL DEFAULT '0' COMMENT '活动是否开启,0关闭,1开启',
  `jiesuan` int(11) NOT NULL DEFAULT '1' COMMENT '是否开启结算,0关闭/1开启',
  `web` int(11) NOT NULL DEFAULT '1' COMMENT '是否开启电脑版,0关闭/1开启',
  `sms` int(11) NOT NULL DEFAULT '1' COMMENT '短信开关,0关/1开',
  `template` varchar(10) NOT NULL DEFAULT 'one' COMMENT '手机模板',
  `video` varchar(200) NOT NULL DEFAULT '无' COMMENT '视频地址',
  `smsname` varchar(200) NOT NULL DEFAULT '无' COMMENT '短信签名',
  `smskey` varchar(200) NOT NULL DEFAULT '无' COMMENT '短信密钥',
  `token` varchar(200) NOT NULL DEFAULT '无' COMMENT '程序授权码',
  `allowable` varchar(100) NOT NULL,
  `withdrawals` varchar(100) NOT NULL,
  `charged` varchar(100) NOT NULL,
  `icar` int(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info`
--

LOCK TABLES `info` WRITE;
/*!40000 ALTER TABLE `info` DISABLE KEYS */;
INSERT INTO `info` VALUES (1,'日源码传媒股份有限公司','日源码传媒股份有限公司','','','热烈庆祝日源码传媒影视项目成功启航，充值购买《流浪地球》项目，到期后赠送20000元！','http://api.pop800.com/web800/c.do?l=cn&amp;type=0&amp;n=566272&amp;w=0','www.19cd.cn/gxcm','','','',0,'aa#bb#cc\r\ndd#ee#ff\r\ngg#hh#ii','&lt;p&gt;二、理财期未满，甲方不得擅自终止本协议，否则，乙方将取消为甲方的理财服务，甲方不享受任何理财收益，甲方投资时必须看清楚投资项目的一切事宜，按照公司要求进行投资，如有违反规定，甲方并承担由此所引起的一切损失。&lt;/p&gt;\r\n	    &lt;p&gt;三、理财方式以网络投资平台的形式进行合作。理财金由甲方帐户划转到乙方的综合理财帐户上进行具体的理财操作，由于甲方全权委托乙方理财，因此在股权，房地产土地，矿权，新能源，石油，等其它实业的投资风险由乙方承担，乙方首先要考虑资金的安全性，然后才考虑资金的收益。甲方不得以任何形式干预乙方的理财操作。收益是每天发放到甲方账户，待理财投资周期到日止，乙方应将甲方之理财本金划入其在乙方开立的存款帐户上。&lt;/p&gt;\r\n	    &lt;p&gt;四、乙方对甲方投资资金负有控制风险的责任，必须勤勉尽责。如果投资有亏损情况，则无论亏损大小由乙方承担全部损失，按合同承诺付款给甲方。如果乙方出现违约将由担保方丙方履行承诺付款给甲方。&lt;/p&gt;\r\n	    &lt;p&gt;五、保密义务 甲乙双方对其通过接触和通过其他渠道得知的有关各方的商业机密等严格保密，对所有资料严格保密，不得向任何其他人员及机构透露。个人的信息。&lt;/p&gt;\r\n	    &lt;p&gt;六、合同生效&lt;/p&gt;\r\n	    &lt;p&gt;1、本协议经投资人通过投资平台点击确认投资后自动生成并签订，本协议自生成时生效。&lt;/p&gt;\r\n	    &lt;p&gt;2、本协议履行期间，各方如发生争议或者纠纷，应友好协商解决；如协商不成，任何一方有权向乙方所在地人民法院起诉。&lt;/p&gt;\r\n	    &lt;p&gt;3、本协议采用电子文本形式制成，各方均认可该形式的法律效力。&lt;/p&gt;\r\n	    &lt;p&gt;七、理财协议一式三份，乙方一份，甲方一份，丙方一份，具有同等法律效力。&lt;/p&gt;','日源码源码-www.riyuanma.com','中国建设银行股份有限公司','日源码源码','4405014',1,'微信充值，长按二维码保存或截图二维码，打开微信，扫一扫，点击右上角相册，选择刚保存的二维码，充值即可。温馨提示：请您在充值的时候尽量不要充值整数，比如您要充值100元，您可以选择充值100.01元或99.99元，尽量在小数点选择比较特殊的金额，让系统更快识别您的充值订单，以免耽误您的投资，详细充值步骤可以看平台公告。','20190719224124.jpg',0,'支付宝充值，长按二维码保存或截图二维码，打开支付宝，扫一扫，点击右上角相册，选择刚保存的二维码，充值即可。温馨提示：请您在充值的时候尽量不要充值整数，比如您要充值100元，您可以选择充值100.01元或99.99元，尽量在小数点选择比较特殊的金额，让系统更快识别您的充值订单，以免耽误您的投资，详细充值步骤可以看平台公告。','20190719224124.jpg',0,0,'/Public/uploads/activity.png',0,1,0,1,'three','无','日源码传媒','','','','5','0',0);
/*!40000 ALTER TABLE `info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invest`
--

DROP TABLE IF EXISTS `invest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '项目ID',
  `title` varchar(200) NOT NULL DEFAULT '无' COMMENT '项目标题',
  `money` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '投资金额',
  `day` int(11) NOT NULL DEFAULT '0' COMMENT '项目天数',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '项目费率',
  `type1` int(11) NOT NULL DEFAULT '0' COMMENT '项目类型1',
  `type2` varchar(50) NOT NULL DEFAULT '无' COMMENT '项目类型2',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '还款状态',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '投资时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1772 DEFAULT CHARSET=utf8 COMMENT='项目投资表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invest`
--

LOCK TABLES `invest` WRITE;
/*!40000 ALTER TABLE `invest` DISABLE KEYS */;
INSERT INTO `invest` VALUES (1755,53560,62,'新手项目体验（限投一次）',300,3,2.25,1,'每日返息,到期还本',0,'2019-08-09 16:07:57'),(1756,53560,65,'88888',3444,3,22.00,1,'每日返息,到期还本',0,'2019-08-09'),(1757,53560,67,'11111111',300,5,2.25,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1758,53560,67,'11111111',300,5,2.25,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1759,53562,67,'11111111',300,5,2.25,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1760,53562,67,'11111111',300,5,2.25,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1761,53560,63,'我为车狂',200,1,3.00,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1762,53564,63,'我为车狂',200,1,3.00,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1763,53564,68,'光天化日',1000,1,2.85,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1764,53564,70,'冰之下',5000,3,2.95,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1765,53564,74,'西伯利亚风云',150000,12,1.50,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1766,53564,71,'画个圈圈',50000,5,2.90,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1767,53564,72,'日不落酒店',100000,7,2.98,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1768,53564,76,'拳锋2',150000,15,3.15,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1769,53564,80,'恋爱攻略',300000,20,3.60,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1770,53564,75,'跨越星空的爱',10000,3,6.66,1,'每日返息,到期还本',0,'2019-08-09 00:00:00'),(1771,53565,63,'阿丽塔：战斗天使（限投一次）',200,1,3.00,1,'每日返息,到期还本',0,'2019-12-13 15:33:17');
/*!40000 ALTER TABLE `invest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invest_list`
--

DROP TABLE IF EXISTS `invest_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invest_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `iid` int(11) NOT NULL DEFAULT '0' COMMENT '投资记录ID',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '投资期数',
  `title` varchar(200) NOT NULL DEFAULT '无' COMMENT '项目标题',
  `money1` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '待还利息',
  `money2` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '待还本金',
  `time1` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '预计还款时间',
  `time2` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '实际还款时间',
  `pay1` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预计还款金额',
  `pay2` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际还款金额',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '项目记录,0未还款/1还款',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COMMENT='项目投资详情表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invest_list`
--

LOCK TABLES `invest_list` WRITE;
/*!40000 ALTER TABLE `invest_list` DISABLE KEYS */;
INSERT INTO `invest_list` VALUES (65,53560,1755,1,'新手项目体验（限投一次）',6.75,0.00,'2019-08-10 16:07:57','2019-08-23 01:59:55',6.75,6.75,1),(66,53560,1755,2,'新手项目体验（限投一次）',6.75,0.00,'2019-08-11 16:07:57','2019-08-23 01:59:56',6.75,6.75,1),(67,53560,1755,3,'新手项目体验（限投一次）',6.75,300.00,'2019-08-12 16:07:57','2019-08-23 01:59:58',306.75,306.75,1),(68,53560,1756,1,'88888',757.68,0.00,'2019-08-10 18:38:10','2019-08-23 01:59:59',757.68,757.68,1),(69,53560,1756,2,'88888',757.68,0.00,'2019-08-11 18:38:10','2019-08-23 02:00:01',757.68,757.68,1),(70,53560,1756,3,'88888',757.68,3444.00,'2019-08-12 18:38:10','2019-08-23 02:00:02',4201.68,4201.68,1),(71,53560,1757,1,'11111111',6.75,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:03',6.75,6.75,1),(72,53560,1757,2,'11111111',6.75,0.00,'2019-08-11 00:00:00','2019-08-23 02:00:05',6.75,6.75,1),(73,53560,1757,3,'11111111',6.75,0.00,'2019-08-12 00:00:00','2019-08-23 02:00:06',6.75,6.75,1),(74,53560,1757,4,'11111111',6.75,0.00,'2019-08-13 00:00:00','2019-08-23 02:00:08',6.75,6.75,1),(75,53560,1757,5,'11111111',6.75,300.00,'2019-08-14 00:00:00','2019-08-23 02:00:10',306.75,306.75,1),(76,53560,1758,1,'11111111',6.75,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:12',6.75,6.75,1),(77,53560,1758,2,'11111111',6.75,0.00,'2019-08-11 00:00:00','2019-08-23 02:00:14',6.75,6.75,1),(78,53560,1758,3,'11111111',6.75,0.00,'2019-08-12 00:00:00','2019-08-23 02:00:16',6.75,6.75,1),(79,53560,1758,4,'11111111',6.75,0.00,'2019-08-13 00:00:00','2019-08-23 02:00:18',6.75,6.75,1),(80,53560,1758,5,'11111111',6.75,300.00,'2019-08-14 00:00:00','2019-08-23 02:00:20',306.75,306.75,1),(81,53562,1759,1,'11111111',6.75,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:21',6.75,6.75,1),(82,53562,1759,2,'11111111',6.75,0.00,'2019-08-11 00:00:00','2019-08-23 02:00:23',6.75,6.75,1),(83,53562,1759,3,'11111111',6.75,0.00,'2019-08-12 00:00:00','2019-08-23 02:00:24',6.75,6.75,1),(84,53562,1759,4,'11111111',6.75,0.00,'2019-08-13 00:00:00','2019-08-23 02:00:25',6.75,6.75,1),(85,53562,1759,5,'11111111',6.75,300.00,'2019-08-14 00:00:00','2019-08-23 02:00:27',306.75,306.75,1),(86,53562,1760,1,'11111111',6.75,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:28',6.75,6.75,1),(87,53562,1760,2,'11111111',6.75,0.00,'2019-08-11 00:00:00','2019-08-23 02:00:30',6.75,6.75,1),(88,53562,1760,3,'11111111',6.75,0.00,'2019-08-12 00:00:00','2019-08-23 02:00:31',6.75,6.75,1),(89,53562,1760,4,'11111111',6.75,0.00,'2019-08-13 00:00:00','2019-08-23 02:00:32',6.75,6.75,1),(90,53562,1760,5,'11111111',6.75,300.00,'2019-08-14 00:00:00','2019-08-23 02:00:34',306.75,306.75,1),(91,53560,1761,1,'我为车狂',6.00,200.00,'2019-08-10 00:00:00','2019-08-23 02:00:34',206.00,206.00,1),(92,53564,1762,1,'我为车狂',6.00,200.00,'2019-08-10 00:00:00','2019-08-23 02:00:35',206.00,206.00,1),(93,53564,1763,1,'光天化日',28.50,1000.00,'2019-08-10 00:00:00','2019-08-23 02:00:35',1028.50,1028.50,1),(94,53564,1764,1,'冰之下',147.50,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:36',147.50,147.50,1),(95,53564,1764,2,'冰之下',147.50,0.00,'2019-08-11 00:00:00','2019-08-23 02:00:37',147.50,147.50,1),(96,53564,1764,3,'冰之下',147.50,5000.00,'2019-08-12 00:00:00','2019-08-23 02:00:38',5147.50,5147.50,1),(97,53564,1765,1,'西伯利亚风云',2250.00,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:38',2250.00,2250.00,1),(98,53564,1765,2,'西伯利亚风云',2250.00,0.00,'2019-08-11 00:00:00','2019-08-23 02:00:40',2250.00,2250.00,1),(99,53564,1765,3,'西伯利亚风云',2250.00,0.00,'2019-08-12 00:00:00','2019-08-23 02:00:42',2250.00,2250.00,1),(100,53564,1765,4,'西伯利亚风云',2250.00,0.00,'2019-08-13 00:00:00','2019-08-23 02:00:44',2250.00,2250.00,1),(101,53564,1765,5,'西伯利亚风云',2250.00,0.00,'2019-08-14 00:00:00','2019-08-23 02:00:46',2250.00,2250.00,1),(102,53564,1765,6,'西伯利亚风云',2250.00,0.00,'2019-08-15 00:00:00','2019-08-23 02:00:48',2250.00,2250.00,1),(103,53564,1765,7,'西伯利亚风云',2250.00,0.00,'2019-08-16 00:00:00','2019-08-23 02:00:50',2250.00,2250.00,1),(104,53564,1765,8,'西伯利亚风云',2250.00,0.00,'2019-08-17 00:00:00','2019-08-23 02:00:52',2250.00,2250.00,1),(105,53564,1765,9,'西伯利亚风云',2250.00,0.00,'2019-08-18 00:00:00','2019-08-23 02:00:54',2250.00,2250.00,1),(106,53564,1765,10,'西伯利亚风云',2250.00,0.00,'2019-08-19 00:00:00','2019-08-23 02:00:56',2250.00,2250.00,1),(107,53564,1765,11,'西伯利亚风云',2250.00,0.00,'2019-08-20 00:00:00','2019-08-23 02:00:58',2250.00,2250.00,1),(108,53564,1765,12,'西伯利亚风云',2250.00,150000.00,'2019-08-21 00:00:00','2019-08-23 02:00:58',152250.00,152250.00,1),(109,53564,1766,1,'画个圈圈',1450.00,0.00,'2019-08-10 00:00:00','2019-08-23 02:00:59',1450.00,1450.00,1),(110,53564,1766,2,'画个圈圈',1450.00,0.00,'2019-08-11 00:00:00','2019-08-23 02:01:00',1450.00,1450.00,1),(111,53564,1766,3,'画个圈圈',1450.00,0.00,'2019-08-12 00:00:00','2019-08-23 02:01:00',1450.00,1450.00,1),(112,53564,1766,4,'画个圈圈',1450.00,0.00,'2019-08-13 00:00:00','2019-08-23 02:01:01',1450.00,1450.00,1),(113,53564,1766,5,'画个圈圈',1450.00,50000.00,'2019-08-14 00:00:00','2019-08-23 02:01:02',51450.00,51450.00,1),(114,53564,1767,1,'日不落酒店',2980.00,0.00,'2019-08-10 00:00:00','2019-08-23 02:01:02',2980.00,2980.00,1),(115,53564,1767,2,'日不落酒店',2980.00,0.00,'2019-08-11 00:00:00','2019-08-23 02:01:04',2980.00,2980.00,1),(116,53564,1767,3,'日不落酒店',2980.00,0.00,'2019-08-12 00:00:00','2019-08-23 02:01:05',2980.00,2980.00,1),(117,53564,1767,4,'日不落酒店',2980.00,0.00,'2019-08-13 00:00:00','2019-08-23 02:01:06',2980.00,2980.00,1),(118,53564,1767,5,'日不落酒店',2980.00,0.00,'2019-08-14 00:00:00','2019-08-23 02:01:08',2980.00,2980.00,1),(119,53564,1767,6,'日不落酒店',2980.00,0.00,'2019-08-15 00:00:00','2019-08-23 02:01:09',2980.00,2980.00,1),(120,53564,1767,7,'日不落酒店',2980.00,100000.00,'2019-08-16 00:00:00','2019-08-23 02:01:12',102980.00,102980.00,1),(121,53564,1768,1,'拳锋2',4725.00,0.00,'2019-08-10 00:00:00','2019-08-23 02:01:14',4725.00,4725.00,1),(122,53564,1768,2,'拳锋2',4725.00,0.00,'2019-08-11 00:00:00','2019-08-23 02:01:16',4725.00,4725.00,1),(123,53564,1768,3,'拳锋2',4725.00,0.00,'2019-08-12 00:00:00','2019-08-23 02:01:18',4725.00,4725.00,1),(124,53564,1768,4,'拳锋2',4725.00,0.00,'2019-08-13 00:00:00','2019-08-23 02:01:20',4725.00,4725.00,1),(125,53564,1768,5,'拳锋2',4725.00,0.00,'2019-08-14 00:00:00','2019-08-23 02:01:22',4725.00,4725.00,1),(126,53564,1768,6,'拳锋2',4725.00,0.00,'2019-08-15 00:00:00','2019-08-23 02:01:24',4725.00,4725.00,1),(127,53564,1768,7,'拳锋2',4725.00,0.00,'2019-08-16 00:00:00','2019-08-23 02:01:26',4725.00,4725.00,1),(128,53564,1768,8,'拳锋2',4725.00,0.00,'2019-08-17 00:00:00','2019-08-23 02:01:28',4725.00,4725.00,1),(129,53564,1768,9,'拳锋2',4725.00,0.00,'2019-08-18 00:00:00','2019-08-23 02:01:30',4725.00,4725.00,1),(130,53564,1768,10,'拳锋2',4725.00,0.00,'2019-08-19 00:00:00','2019-08-23 02:01:32',4725.00,4725.00,1),(131,53564,1768,11,'拳锋2',4725.00,0.00,'2019-08-20 00:00:00','2019-08-23 02:01:34',4725.00,4725.00,1),(132,53564,1768,12,'拳锋2',4725.00,0.00,'2019-08-21 00:00:00','2019-08-23 02:01:36',4725.00,4725.00,1),(133,53564,1768,13,'拳锋2',4725.00,0.00,'2019-08-22 00:00:00','2019-08-23 02:01:37',4725.00,4725.00,1),(134,53564,1768,14,'拳锋2',4725.00,0.00,'2019-08-23 00:00:00','2019-08-23 02:01:38',4725.00,4725.00,1),(135,53564,1768,15,'拳锋2',4725.00,150000.00,'2019-08-24 00:00:00','0000-00-00 00:00:00',154725.00,0.00,0),(136,53564,1769,1,'恋爱攻略',10800.00,0.00,'2019-08-10 00:00:00','2019-08-23 02:01:40',10800.00,10800.00,1),(137,53564,1769,2,'恋爱攻略',10800.00,0.00,'2019-08-11 00:00:00','2019-08-23 02:01:42',10800.00,10800.00,1),(138,53564,1769,3,'恋爱攻略',10800.00,0.00,'2019-08-12 00:00:00','2019-08-23 02:01:44',10800.00,10800.00,1),(139,53564,1769,4,'恋爱攻略',10800.00,0.00,'2019-08-13 00:00:00','2019-08-23 02:01:46',10800.00,10800.00,1),(140,53564,1769,5,'恋爱攻略',10800.00,0.00,'2019-08-14 00:00:00','2019-08-23 02:01:48',10800.00,10800.00,1),(141,53564,1769,6,'恋爱攻略',10800.00,0.00,'2019-08-15 00:00:00','2019-08-23 02:01:50',10800.00,10800.00,1),(142,53564,1769,7,'恋爱攻略',10800.00,0.00,'2019-08-16 00:00:00','2019-08-23 02:01:52',10800.00,10800.00,1),(143,53564,1769,8,'恋爱攻略',10800.00,0.00,'2019-08-17 00:00:00','2019-08-23 02:01:54',10800.00,10800.00,1),(144,53564,1769,9,'恋爱攻略',10800.00,0.00,'2019-08-18 00:00:00','2019-08-23 02:01:56',10800.00,10800.00,1),(145,53564,1769,10,'恋爱攻略',10800.00,0.00,'2019-08-19 00:00:00','2019-08-23 02:01:58',10800.00,10800.00,1),(146,53564,1769,11,'恋爱攻略',10800.00,0.00,'2019-08-20 00:00:00','2019-08-23 02:02:00',10800.00,10800.00,1),(147,53564,1769,12,'恋爱攻略',10800.00,0.00,'2019-08-21 00:00:00','2019-08-23 02:02:02',10800.00,10800.00,1),(148,53564,1769,13,'恋爱攻略',10800.00,0.00,'2019-08-22 00:00:00','2019-08-23 02:02:04',10800.00,10800.00,1),(149,53564,1769,14,'恋爱攻略',10800.00,0.00,'2019-08-23 00:00:00','2019-08-23 02:02:06',10800.00,10800.00,1),(150,53564,1769,15,'恋爱攻略',10800.00,0.00,'2019-08-24 00:00:00','0000-00-00 00:00:00',10800.00,0.00,0),(151,53564,1769,16,'恋爱攻略',10800.00,0.00,'2019-08-25 00:00:00','0000-00-00 00:00:00',10800.00,0.00,0),(152,53564,1769,17,'恋爱攻略',10800.00,0.00,'2019-08-26 00:00:00','0000-00-00 00:00:00',10800.00,0.00,0),(153,53564,1769,18,'恋爱攻略',10800.00,0.00,'2019-08-27 00:00:00','0000-00-00 00:00:00',10800.00,0.00,0),(154,53564,1769,19,'恋爱攻略',10800.00,0.00,'2019-08-28 00:00:00','0000-00-00 00:00:00',10800.00,0.00,0),(155,53564,1769,20,'恋爱攻略',10800.00,300000.00,'2019-08-29 00:00:00','0000-00-00 00:00:00',310800.00,0.00,0),(156,53564,1770,1,'跨越星空的爱',666.00,0.00,'2019-08-10 00:00:00','2019-08-23 02:02:08',666.00,666.00,1),(157,53564,1770,2,'跨越星空的爱',666.00,0.00,'2019-08-11 00:00:00','2019-08-23 02:02:10',666.00,666.00,1),(158,53564,1770,3,'跨越星空的爱',666.00,10000.00,'2019-08-12 00:00:00','2019-08-23 02:02:12',10666.00,10666.00,1),(159,53565,1771,1,'阿丽塔：战斗天使（限投一次）',6.00,200.00,'2019-12-14 15:33:17','0000-00-00 00:00:00',206.00,0.00,0);
/*!40000 ALTER TABLE `invest_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `title` varchar(100) NOT NULL DEFAULT '无' COMMENT '标题',
  `desc` varchar(144) NOT NULL DEFAULT '无' COMMENT '项目描述',
  `img` varchar(50) NOT NULL DEFAULT 'no_img.jpg' COMMENT '图片链接',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '费率',
  `percent` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '模拟进度',
  `day` int(11) NOT NULL DEFAULT '0' COMMENT '期限',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '返款类型',
  `min` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最小投资金额',
  `max` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最大投资金额',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '最大投资次数',
  `guarantee` varchar(200) NOT NULL DEFAULT '担保公司' COMMENT '担保公司',
  `limit` int(11) NOT NULL DEFAULT '0' COMMENT '最大购买分数',
  `content` text NOT NULL,
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `frbl` decimal(5,2) DEFAULT '0.00' COMMENT '分润比例',
  `red` decimal(5,2) DEFAULT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='项目表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (74,'X战警：黑凤凰','简介：在《X战警：黑凤凰》中，X战警将面临他们最强大又可怕的敌人：他们的一位成员——琴·葛蕾。在一次太空救援任务中，琴被一股神秘的宇宙力量击中险些死亡。返回家中后，这股力量令她变得无比强大的同时也极不稳定。琴在与体内能量搏斗期','20190824155025.jpg',2800.00,1.50,3.00,12,1,50000.00,250000.00,5,'中国人民财产保险股份有限公司',0,'&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;詹妮弗·劳伦斯（Jennifer Lawrence），1990年8月15日出生于美国肯塔基州路易斯维尔，美国演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2007年，参演喜剧《比尔·英格沃秀》，正式出道。2009年，主演情感电影《&lt;span style=&quot;col:#136ec2&quot;&gt;燃烧的平原&lt;/span&gt;》。2010年，凭借悬疑电影《&lt;span style=&quot;col:#136ec2&quot;&gt;冬天的骨头&lt;/span&gt;》获得&lt;span style=&quot;col:#136ec2&quot;&gt;第83届奥斯卡金像奖&lt;/span&gt;最佳女主角奖提名。2011年，在科幻电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：第一战&lt;/span&gt;》中饰演魔形女瑞雯。2012年3月，主演动作电影《&lt;span style=&quot;col:#136ec2&quot;&gt;饥饿游戏&lt;/span&gt;》；12月，主演爱情喜剧电影《&lt;span style=&quot;col:#136ec2&quot;&gt;乌云背后的幸福线&lt;/span&gt;》，凭借该片获得&lt;span style=&quot;col:#136ec2&quot;&gt;第85届奥斯卡金像奖&lt;/span&gt;最佳女主角奖和&lt;span style=&quot;col:#136ec2&quot;&gt;第70届金球奖&lt;/span&gt;音乐喜剧类最佳女主角奖等多个奖项。2013年，凭借犯罪电影《&lt;span style=&quot;col:#136ec2&quot;&gt;美国骗局&lt;/span&gt;》获得&lt;span style=&quot;col:#136ec2&quot;&gt;第71届金球奖&lt;/span&gt;最佳女配角奖。2015年，主演传记电影《&lt;span style=&quot;col:#136ec2&quot;&gt;奋斗的乔伊&lt;/span&gt;》，凭借该片获得&lt;span style=&quot;col:#136ec2&quot;&gt;第73届金球奖&lt;/span&gt;音乐喜剧类最佳女主角奖，并第三次入围&lt;span style=&quot;col:#136ec2&quot;&gt;奥斯卡金像奖&lt;/span&gt;最佳女主角奖。2016年，主演科幻冒险电影《&lt;span style=&quot;col:#136ec2&quot;&gt;太空旅客&lt;/span&gt;》。&lt;br/&gt;&lt;br/&gt;詹姆斯·麦卡沃伊（James McAvoy），1979年4月21日出生于苏格兰，演员。&lt;br/&gt;&lt;/p&gt;&lt;p&gt;1995年，念高中的詹姆斯·麦卡沃伊初登银幕，出演电影《隔壁房间》；2001年，他获得了《&lt;span style=&quot;col:#136ec2&quot;&gt;兄弟连&lt;/span&gt;》中的一个小角色；2006年，他在《&lt;span style=&quot;col:#136ec2&quot;&gt;纳尼亚传奇：狮子、女巫和魔衣柜&lt;/span&gt;》中扮演“羊怪”图姆纳斯。2007年，出演的剧情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;末代独裁&lt;/span&gt;》使他提名了第20届欧洲电影奖的最佳男演员奖和第60届英国电影学院奖最佳男配角。2008年，他凭借在悬疑爱情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;赎罪&lt;/span&gt;》中的表现提名了第65届金球奖、第61届英国电影学院奖、第21届欧洲电影奖最佳男主角。&lt;/p&gt;&lt;p&gt;2011年，他出演科幻电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：第一战&lt;/span&gt;》，饰演青年时期的X教授；此后分别于2014年在电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：逆转未来&lt;/span&gt;》和2016年在电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：天启&lt;/span&gt;》中饰演了该角色。&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;詹姆斯·麦卡沃伊（James McAvoy），1979年4月21日出生于苏格兰，演员。&lt;/p&gt;&lt;p&gt;1995年，念高中的詹姆斯·麦卡沃伊初登银幕，出演电影《隔壁房间》；2001年，他获得了《&lt;span style=&quot;col:#136ec2&quot;&gt;兄弟连&lt;/span&gt;》中的一个小角色；2006年，他在《&lt;span style=&quot;col:#136ec2&quot;&gt;纳尼亚传奇：狮子、女巫和魔衣柜&lt;/span&gt;》中扮演“羊怪”图姆纳斯。2007年，出演的剧情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;末代独裁&lt;/span&gt;》使他提名了第20届欧洲电影奖的最佳男演员奖和第60届英国电影学院奖最佳男配角。2008年，他凭借在悬疑爱情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;赎罪&lt;/span&gt;》中的表现提名了第65届金球奖、第61届英国电影学院奖、第21届欧洲电影奖最佳男主角。&lt;/p&gt;&lt;p&gt;2011年，他出演科幻电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：第一战&lt;/span&gt;》，饰演青年时期的X教授；此后分别于2014年在电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：逆转未来&lt;/span&gt;》和2016年在电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：天启&lt;/span&gt;》中饰演了该角色。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;迈克尔·法斯宾德（Michael Fassbender），1977年4月2日生于&lt;/span&gt;&lt;span style=&quot;font-family:arial, tahoma, Microsoft Yahei, 宋体, sans-serif;col:#136ec2&quot;&gt;&lt;span style=&quot;font-size: 14px; text-indent: 28px;&quot;&gt;德国&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;，演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2000年，他参加了电视剧集《&lt;span style=&quot;col:#136ec2&quot;&gt;兄弟连&lt;/span&gt;》的试镜并得到一个配角角色。2006年，迈克尔·法斯宾德在《&lt;span style=&quot;col:#136ec2&quot;&gt;300勇士&lt;/span&gt;》中扮演斯巴达勇士Stelios。2008年，他凭在《&lt;span style=&quot;col:#136ec2&quot;&gt;饥饿&lt;/span&gt;》中的表演获得了&lt;span style=&quot;col:#136ec2&quot;&gt;英国独立电影奖&lt;/span&gt;最佳男演员奖。2010年，他在《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：第一战&lt;/span&gt;》中饰演了&lt;span style=&quot;col:#136ec2&quot;&gt;万磁王&lt;/span&gt;。2011年，法斯宾德凭借《&lt;span style=&quot;col:#136ec2&quot;&gt;羞耻&lt;/span&gt;》获得美国&lt;span style=&quot;col:#136ec2&quot;&gt;金球奖&lt;/span&gt;剧情类最佳男主角的提名和第68届&lt;span style=&quot;col:#136ec2&quot;&gt;威尼斯电影节&lt;/span&gt;最佳男演员奖。2012年，法斯宾德主演的《&lt;span style=&quot;col:#136ec2&quot;&gt;普罗米修斯&lt;/span&gt;》上映。2014年，法斯宾德凭借《&lt;span style=&quot;col:#136ec2&quot;&gt;为奴十二年&lt;/span&gt;》获得第86届奥斯卡金像奖最佳男配角提名。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;索菲·特纳&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;（Sophie Turner）&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;，1996年2月 21日出生在英国北安普敦，英国演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2011年索菲·特纳开始在HBO出品的连续剧《&lt;span style=&quot;col:#136ec2&quot;&gt;权力的游戏&lt;/span&gt;》中饰演珊莎·史塔克（史塔克家的长女），从而走进大家的视线里。2013年在电影处女作《&lt;span style=&quot;col:#136ec2&quot;&gt;另一个我&lt;/span&gt;》中饰演主角Fay；这一年还因为在《&lt;span style=&quot;col:#136ec2&quot;&gt;权力的游戏&lt;/span&gt;》中的表现，获得青年艺人大奖喜剧或剧情类电视剧最佳年轻女配角的提名。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;尼古拉斯·霍尔特（Nicholas Hoult），1989年12月7日出生于英国伯克希尔沃金厄姆，英国男演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;1996年，作为童星的尼古拉斯·霍尔特出演了他的第一部电影《&lt;span style=&quot;col:#136ec2&quot;&gt;亲密关系&lt;/span&gt;》。2002年，霍尔特因主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;关于一个男孩&lt;/span&gt;》而受到关注并获得青年艺术家奖最佳故事片青年男演员提名。2007年因出演英剧《&lt;span style=&quot;col:#136ec2&quot;&gt;皮囊&lt;/span&gt;》火速蹿红。2008年凭借该剧获得&lt;span style=&quot;col:#136ec2&quot;&gt;蒙特卡洛&lt;/span&gt;电视节最佳男演员提名。2011年，尼古拉斯·霍尔特在好莱坞电影《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：第一战&lt;/span&gt;》中扮演“野兽”一角。2013年，霍尔特出演了《&lt;span style=&quot;col:#136ec2&quot;&gt;温暖的尸体&lt;/span&gt;》和《&lt;span style=&quot;col:#136ec2&quot;&gt;巨人捕手杰克&lt;/span&gt;》两部影片。2014年5月23日，尼古拉斯·霍尔特出演的《&lt;span style=&quot;col:#136ec2&quot;&gt;X战警：逆转未来&lt;/span&gt;》上映。在2015年上映的电影《&lt;span style=&quot;col:#136ec2&quot;&gt;疯狂的麦克斯：狂暴之路&lt;/span&gt;》中扮演纳克斯一角。&lt;br/&gt;&lt;br/&gt;杰西卡·查斯坦（Jessica Chastain），1977年3月24日出生于美国加利福尼亚州，美国电影演员。&lt;br/&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;2004年，她出演电视电影《&lt;span style=&quot;col:#136ec2&quot;&gt;暗影&lt;/span&gt;》，随后在多部美剧里客串。2008年，她凭借主演的首部电影《&lt;span style=&quot;col:#136ec2&quot;&gt;乔琳娜&lt;/span&gt;》获得&lt;span style=&quot;col:#136ec2&quot;&gt;西雅图国际电影节&lt;/span&gt;最佳女主角。2011年，她先后出现在《&lt;span style=&quot;col:#136ec2&quot;&gt;生命之树&lt;/span&gt;》、《&lt;span style=&quot;col:#136ec2&quot;&gt;相助&lt;/span&gt;》、《&lt;span style=&quot;col:#136ec2&quot;&gt;王尔德的莎乐美&lt;/span&gt;》等6部影片中，均有出色表现。2012年，凭《&lt;span style=&quot;col:#136ec2&quot;&gt;相助&lt;/span&gt;》获&lt;span style=&quot;col:#136ec2&quot;&gt;第84届奥斯卡金像奖&lt;/span&gt;最佳女配角提名。2013年，她凭借电影《&lt;span style=&quot;col:#136ec2&quot;&gt;猎杀本·拉登&lt;/span&gt;》中的Maya一角获得&lt;span style=&quot;col:#136ec2&quot;&gt;第70届金球奖&lt;/span&gt;电影类剧情类最佳女主角，并荣获&lt;span style=&quot;col:#136ec2&quot;&gt;第85届奥斯卡金像奖&lt;/span&gt;最佳女主角提名。2016年，凭借《&lt;span style=&quot;col:#136ec2&quot;&gt;斯隆女士&lt;/span&gt;》提名第74届金球奖剧情类电影最佳女主角。2017 年，主演同名小说改编的影片《引诱英格丽·褒曼》，同年，凭借在《&lt;span style=&quot;col:#136ec2&quot;&gt;茉莉的牌局&lt;/span&gt;》中的表现获得第29届棕榈泉国际电影节“主席奖”。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:11:55',5,0.00,0.00,'6'),(63,'阿丽塔：战斗天使（限投一次）','简介：由詹姆斯·卡梅隆（《阿凡达》）制片兼编剧，罗伯特·罗德里格斯（《罪恶之城》）执导，改编自经典日本漫画《铳梦》。阿丽塔（罗莎·萨拉扎尔饰演，代表作《移动迷宫3：死亡解药》）醒来发现既不记得自己是谁，也不认识这个未来世界。..导演:罗伯特·罗德里格兹编剧:木城雪户、詹姆斯·卡','20190824153900.png',2400.00,3.00,3.00,1,1,200.00,200.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;&lt;span style=&quot;font-size: 14px; font-family: arial, 宋体, sans-serif; col: rgb(51,51,51); text-align: justify; text-indent: 28px&quot;&gt;罗莎·萨拉查（Rosa Salazar），出生于1985年7月16日加拿大不列颠哥伦比亚省，加拿大女演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2017年，参演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;加州公路巡警&lt;/span&gt;》。2019年，主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;阿丽塔：战斗天使&lt;/span&gt;》。&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;克里斯托弗·瓦尔兹（Christoph Waltz），1956年10月4日出生于奥地利维也纳，奥地利影视演员。&lt;/p&gt;&lt;p&gt;早期活跃于戏剧舞台，2000年首次执导名为《Wenn man sich traut》的爱情喜剧片。2010年，凭借电影《&lt;span style=&quot;col:#136ec2&quot;&gt;无耻混蛋&lt;/span&gt;》扮演的角色夺得&lt;span style=&quot;col:#136ec2&quot;&gt;第82届奥斯卡金像奖&lt;/span&gt;的最佳男配角奖、第62届戛纳国际电影节的最佳男演员和&lt;span style=&quot;col:#136ec2&quot;&gt;第67届金球奖&lt;/span&gt;最佳男配角奖在内二十多个电影奖项。2013年凭借电影《&lt;span style=&quot;col:#136ec2&quot;&gt;被解救的姜戈&lt;/span&gt;》再次获得第85届奥斯卡奖最佳男配角奖。&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;马赫沙拉·阿里（Mahershala Ali），男，1974年2月16出生于美国&lt;span style=&quot;col:#136ec2&quot;&gt;加利福尼亚州&lt;/span&gt;，美国男&lt;span style=&quot;col:#136ec2&quot;&gt;演员&lt;/span&gt;。&lt;/p&gt;&lt;p&gt;马赫沙拉·阿里曾在《&lt;span style=&quot;col:#136ec2&quot;&gt;纸牌屋&lt;/span&gt;》中饰演雷米·丹顿，阿里凭借精湛细腻的演技，获得了包括金球奖、美国&lt;span style=&quot;col:#136ec2&quot;&gt;演员&lt;/span&gt;公会奖在内诸多大奖“最佳男配角”的提名。2017年2月27日，马赫沙拉·阿里凭借《&lt;span style=&quot;col:#136ec2&quot;&gt;月光男孩&lt;/span&gt;》获得第89届&lt;span style=&quot;col:#136ec2&quot;&gt;奥斯卡金像奖&lt;/span&gt;最佳男配角奖。&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;col: rgb(51,51,51)&quot;&gt;詹妮弗·康纳利（Jennifer Connelly），1970年12月12日出生于美国纽约州卡茨基尔，美国演员，毕业于&lt;/span&gt;&lt;span style=&quot;font-family:arial, tahoma, Microsoft Yahei, 宋体, sans-serif;col:#136ec2&quot;&gt;&lt;span style=&quot;font-size: 14px; text-indent: 28px&quot;&gt;耶鲁大学&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;col: rgb(51,51,51)&quot;&gt;与&lt;/span&gt;&lt;span style=&quot;font-family:arial, tahoma, Microsoft Yahei, 宋体, sans-serif;col:#136ec2&quot;&gt;&lt;span style=&quot;font-size: 14px; text-indent: 28px&quot;&gt;斯坦福大学&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;col: rgb(51,51,51)&quot;&gt;。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;1984年参演《&lt;span style=&quot;col:#136ec2&quot;&gt;美国往事&lt;/span&gt;》步入影视圈，随后参演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;神话&lt;/span&gt;》&amp;nbsp;。2000年演出电影《&lt;span style=&quot;col:#136ec2&quot;&gt;梦之安魂曲&lt;/span&gt;》和2001年演出了传记电影《&lt;span style=&quot;col:#136ec2&quot;&gt;美丽心灵&lt;/span&gt;&amp;nbsp;》后演技获认可，凭借该片中表现获得了2002年&lt;span style=&quot;col:#136ec2&quot;&gt;奥斯卡&lt;/span&gt;最佳女配角奖。2003年参演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;绿巨人&lt;/span&gt;》。2010年主演电影《恋情生变》&amp;nbsp;。2012年主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;维吉尼亚怎么了&lt;/span&gt;》&amp;nbsp;。2014年主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;诺亚方舟：创世之旅&lt;/span&gt;》；参与拍摄并主演电影《在高处》&amp;nbsp;。2017年主演灾难电影《&lt;span style=&quot;col:#136ec2&quot;&gt;无路可退&lt;/span&gt;》。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-07 21:21:59',1,0.00,1.00,'3'),(68,'蜘蛛侠：英雄远征','简介：故事发生在夏天，彼得过暑假了，和朋友们一起去欧洲玩耍。这次他将遇到大反派神秘客。导演:乔·沃茨编剧:史蒂夫·迪特寇斯坦·李主演:汤姆·赫兰德、赞达亚、杰克·吉伦哈尔等主演类型:动作/冒险/喜剧-制片国家/地区:美国语言:英语上映日期:2019年7','20190824154213.jpg',2350.00,2.85,3.00,1,1,1000.00,1000.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;汤姆·赫兰德（Tom Holl），1996年6月1日出生于英国萨里镇，英国男演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;汤姆·赫兰德幼时学习跳舞，2008年因为出演音乐剧《&lt;span style=&quot;col:#136ec2&quot;&gt;跳出我天地&lt;/span&gt;》主角Billy而为人熟知。2012年，因在电影《&lt;span style=&quot;col:#136ec2&quot;&gt;海啸奇迹&lt;/span&gt;》里的表演而获得第84届&lt;span style=&quot;col:#136ec2&quot;&gt;美国国家评论协会奖&lt;/span&gt;最具突破男演员奖。&lt;/p&gt;&lt;p&gt;2015年6月，确定在《&lt;span style=&quot;col:#136ec2&quot;&gt;蜘蛛侠：英雄归来&lt;/span&gt;》和《&lt;span style=&quot;col:#136ec2&quot;&gt;美国队长3：内战&lt;/span&gt;》中扮演彼得·帕克。2015年12月，参演的剧情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;海洋深处&lt;/span&gt;》在美国上映。2016年，宣布加盟电影《&lt;span style=&quot;col:#136ec2&quot;&gt;电力之战&lt;/span&gt;》。2017年，确定参演游戏《&lt;span style=&quot;col:#136ec2&quot;&gt;神秘海域&lt;/span&gt;》电影版。2017年7月，确定主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;混沌漫步&lt;/span&gt;》。2018年，参演的科幻电影《&lt;span style=&quot;col:#136ec2&quot;&gt;复仇者联盟3：无限战争&lt;/span&gt;》在美国上映。&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;赞达亚·科尔曼（Zendaya Coleman），全名赞达亚·马里·施特默·科尔曼（Zendaya Maree Stoermer Coleman），1996年9月1日出生于美国加利福尼亚州奥克兰，美国女演员、歌手、舞者。&lt;/p&gt;&lt;p&gt;2009年，参演&lt;span style=&quot;col:#136ec2&quot;&gt;Kidz Bop&lt;/span&gt;翻唱的歌曲《&lt;span style=&quot;col:#136ec2&quot;&gt;Hot n Cold&lt;/span&gt;》的MV，从而正式进入演艺圈。2010年，出演迪士尼原创情景喜剧《&lt;span style=&quot;col:#136ec2&quot;&gt;舞动芝加哥&lt;/span&gt;》。2012年，其主演的电视电影《&lt;span style=&quot;col:#136ec2&quot;&gt;亦敌亦友&lt;/span&gt;》播出。2013年，参加舞蹈竞技类电视节目《与星共舞第十六季》&amp;nbsp;；9月，发行个人音乐专辑《Zendaya》。2015年，主演真人间谍喜剧《&lt;span style=&quot;col:#136ec2&quot;&gt;少女卧底&lt;/span&gt;》。2016年，获得第18届青少年选择奖最时尚女星奖。2017年7月，其主演的科幻动作片《&lt;span style=&quot;col:#136ec2&quot;&gt;蜘蛛侠：英雄归来&lt;/span&gt;》上映，她凭借该片获得了第19届青少年选择奖最佳暑期电影女演员奖&amp;nbsp;；12月，其主演的传记片《&lt;span style=&quot;col:#136ec2&quot;&gt;马戏之王&lt;/span&gt;》在上映，她凭借该片获得了第20届青少年选择奖最佳剧情片女演员奖等奖项。2018年，获得第31届儿童选择奖最受欢迎电影女演员奖。&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;杰克·吉伦哈尔（Jake Gyllenhaal），1980年12月19日出生于美国&lt;/span&gt;&lt;span style=&quot;font-family:arial, tahoma, Microsoft Yahei, 宋体, sans-serif;col:#136ec2&quot;&gt;&lt;span style=&quot;font-size: 14px; text-indent: 28px;&quot;&gt;加利福尼亚州&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;洛杉矶，美国男演员、制片人。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;1991年，杰克以《&lt;span style=&quot;col:#136ec2&quot;&gt;城市乡巴佬&lt;/span&gt;》一片进入演艺圈。1999年在《&lt;span style=&quot;col:#136ec2&quot;&gt;十月的天空&lt;/span&gt;》中首次担纲主演。2001年主演《&lt;span style=&quot;col:#136ec2&quot;&gt;死亡幻觉&lt;/span&gt;》并获得了第17届独立精神奖最佳男主角提名。2005年因主演《&lt;span style=&quot;col:#136ec2&quot;&gt;断背山&lt;/span&gt;》而获得第78届奥斯卡金像奖最佳男配角提名，并荣获第59届英国电影学院奖最佳男配角奖。2010年主演《&lt;span style=&quot;col:#136ec2&quot;&gt;波斯王子：时之刃&lt;/span&gt;》和《&lt;span style=&quot;col:#136ec2&quot;&gt;爱情与灵药&lt;/span&gt;》，后者使他获得第68届美国电影金球奖音乐喜剧类最佳男主角提名。2012年担任第62届柏林国际电影节评委。2013年凭借《&lt;span style=&quot;col:#136ec2&quot;&gt;囚徒&lt;/span&gt;》一片获颁第17届好莱坞电影奖年度男配角奖。2014年因主演《&lt;span style=&quot;col:#136ec2&quot;&gt;夜行者&lt;/span&gt;》而获得美国金球奖，英国电影学院奖，美国演员工会奖等奖项的最佳男主角提名。2015年担任第68届戛纳国际电影节评委。2016年与艾米·亚当斯主演的《&lt;span style=&quot;col:#136ec2&quot;&gt;夜行动物&lt;/span&gt;》获得第73届威尼斯国际电影节评委会大奖。2017年凭借《夜行动物》获得第70届英国电影学院奖最佳男主角提名；同年10月26日，杰克·吉伦哈尔凭借《&lt;span style=&quot;col:#136ec2&quot;&gt;坚强&lt;/span&gt;》获得第21届好莱坞电影奖最佳男主角奖。&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:00:08',2,0.00,0.00,'3'),(69,'人间·喜剧','简介：平凡夫妻濮通和米粒因被公司拖欠工资导致交不起房租；富二代杨小伟不被亲爹宠爱，欠下巴爷一笔巨款无处偿还。被钱逼到绝路的三人相遇，索性上演了一出富二代绑架案，一路认怂的夫妻变身假绑匪，最穷富二代变身假人质……一番折腾下，杨小伟的首富爸爸杨台竣最终承诺了1000万的“赎金”。但事情远不','20190824154739.jpg',2400.00,2.90,3.00,1,1,3000.00,3000.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;艾伦，北京市人，开心麻花签约演员。毕业于北京电影学院表演系。&lt;br/&gt;2002年，在上戏校的艾伦第一次登台表演。2004年，出演首部电视剧《搭错车》。2006年，加入开心麻花团队，之后第一次出演开心麻花舞台剧《倒霉阿翔》。2008年，出演由高希希执导的电视剧《男人底线》。2011年\r\n \r\n，参加央视小品大赛并表演小品《落叶归根》，而小品获得了三等奖。2012年，首次登上中央电视台春节联欢晚会舞台并表演小品《今天的幸福》。2013年，第二次登上中央电视台春节联欢晚会舞台，表演小品《大城小事》。2014年，登上元宵晚会表演小品《同学会》。2015年3月5日，登上元宵晚会表演小品《其实你不懂我的心》。9月30日，在喜剧电影《夏洛特烦恼》中饰演大春一角。11月，以男主角身份参演由开心麻花推出的爆笑贺岁舞台剧《牢友记》。2016年4月，与王宁搭档加《欢乐喜剧人》第二季，并获得亚军。5月，凭借电影《夏洛特烦恼》获得第33届大众电影百花奖最佳男配角提名。同年9月30日，艾伦主演的电影电影《羞羞的铁拳》上映，最终22亿票房，打破国内2D票房纪录，成为2017年国产票房第二。\r\n 2018年2月25日，艾伦凭借在电影《羞羞的铁拳》中的精彩表现一举获得第九届澳洲国际华语电影节（ICFF）最佳男演员奖项。&lt;br/&gt;&lt;/p&gt;&lt;p&gt;王智（Wang Zhi ），原名王紫瑄，1983年7月29日出生于辽宁省鞍山市，毕业于中央戏剧学院2004级表演系本科，中国内地女演员、新生代功夫女星。&lt;br/&gt;2015年票房超过14亿的黑马电影《夏洛特烦恼》 中，王智饰演的秋雅一角深入人心，她因此备受关注，被媒体誉为国民初恋 。王智在《夏洛特烦恼》的成功演绎，让她获得首届“金羊奖”澳门国际电影节最具潜质奖 ，并提名第33届大众电影百花奖最佳女配角。&lt;br/&gt;王智是国内不可多得屈指可数的功夫女星，她七岁开始拜师学武，多年来一直将咏春和剑术作为日常健身运动 ，有着“行走于都市的女侠”的称号。此外，王智还是中戏乃至全国唯一有过大学生村官经历的表演系本科毕业生。&lt;br/&gt;2013年主演年代动作剧《马永贞》,2014年主演的都市家庭情感剧《妻子的秘密》在湖南卫视热播\r\n 。2016年，王智领衔出演电视剧《超级翁婿》，也在《凉生，我们可不可以不忧伤》&amp;nbsp; \r\n担纲主演；此外，王智还参加了浙江卫视《二十四小时》、《挑战者联盟》等真人秀，更为宣传电影亮相亮相第69届戛纳国际电影节，备受关注 \r\n。2017年，王智在由万达电影出品的院线大片《人间·喜剧》中饰演女一号米粒。&lt;/p&gt;&lt;p&gt;任达华，1955年3月19日出生于中国香港，影视演员。&lt;br/&gt;任达华以模特身份进入演艺圈，无线电视艺员训练班毕业后，于1979年签约为缤缤电影公司基本演员，1987年开始接拍影视剧。任达华2004年凭借《PTU》获得第9届香港电影金紫荆奖最佳男主角奖，2006年凭借《龙城岁月》获得第11届香港电影金紫荆奖最佳男主角奖，2010年凭借《岁月神偷》获得第29届香港电影金像奖最佳男主角奖。&lt;/p&gt;&lt;p&gt;鲁诺（Lenox），1987年3月29日出生于吉林省松原市，拥有二分之一德国血统，中国内地影视男演员、模特，毕业于北京电影学院。&lt;br/&gt;2007年，出演个人首部电视剧《那小子真帅》，从而正式进入演艺圈\r\n \r\n。2008年，在都市职场喜剧《丑女无敌》中饰演小武。2009年，担任动画电影《齐天大圣前传》的配音工作。2010年，主演都市爱情喜剧《恋爱SOS》。2011年，主演都市情感剧《小男人遇上大女人》。2012年，出演革命战争剧《枪械师》。2013年，主演战争剧《好家伙》。2014年，在谍战电影《谍·莲花》中饰演男主角李天虎。2015年，出演剧情电影《老炮儿》\r\n 。2016年，主演动作电影《城南往事之扛把子》。2017，其主演的青春爱情电影《会痛的十七岁》上映 。&lt;/p&gt;&lt;p&gt;金士杰，1951年出生于中国台湾，男演员、剧作家、导演。&lt;br/&gt;1980年，编导了话剧《荷珠新配》。1986年，出演了话剧版《暗恋桃花源》。1989年，出演话剧《这一夜，谁来说相声》。1992年，主演了由赖声川编导的舞台剧改编而成的电影《暗恋桃花源》。1994年，出演了赖声川执导的为表演工作坊成立十周年的电影《红色的天空》。2001年，出演由《爱情书简》改编的爱情话剧作品《收信快乐》。2009年，主演了改编自日本青春爱情小说的电影《台北飘雪》。2011年，为3D动画电影《功夫熊猫2》中的功夫大师配音。2014年，出演了法国导演查理德莫执导的一部宫廷文艺片《画框里的女人》。2015年，主演了庆祝抗日战争暨世界反法西斯战争胜利70周年的电影《老兵》\r\n 。2016年，凭借民国武侠电影《师父》郑山傲一角获得第六届北京国际电影节最佳男配角奖 \r\n；7月，为国产动画《大鱼海棠》当中掌管所有死去人类灵魂的老太婆配音 。2017年6月，出演电视剧《楚乔传》。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:02:27',3,0.00,0.00,'3'),(70,'驯龙高手3','简介：统领伯克岛的酋长嗝嗝，与阿丝翠德共同打造了一个奇妙而热闹的飞龙乌托邦。一只雌性光煞飞龙的意外出现，加上一个前所未有的威胁的到来，令嗝嗝和没牙仔不得不离开自己唯一的家园，前往他们本以为只存在于神话之中的隐秘之境。在发现自己真正的命运之后，飞龙与骑士将携手殊死奋战，保护他们所珍爱的一切','20190824154841.png',2500.00,2.95,3.00,3,1,5000.00,5000.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;刘昊然，1997年10月10日出生于河南省平顶山市，中国内地男演员，就读于中央戏剧学院表演系本科。&lt;/p&gt;&lt;p&gt;2014年，主演电影《北京爱情故事》，正式出道，凭借该片提名第21届北京大学生电影节最佳新人奖。2015年5月，加盟国防教育特别节目《真正男子汉》\r\n ；7月，以专业和文化双料第一名的成绩被中央戏剧学院录取 \r\n；12月，主演悬疑喜剧电影《唐人街探案》，凭借该片获得第20届华鼎奖中国最佳新人奖和2016中国电影指数盛典最佳银幕新锐演员奖，并提名第19届上海国际电影节亚洲新人奖最佳男演员奖，该片中国内地票房达到8.23亿元。&lt;/p&gt;&lt;p&gt;2016年，主演悬疑爱情电影《双生》。2017年8月，主演建军90周年献礼影片《建军大业》\r\n \r\n；12月，主演由陈凯歌执导的魔幻电影《妖猫传》；随后，主演古装权谋剧《琅琊榜之风起长林》。2018年，主演喜剧冒险探案系列电影《唐人街探案2》，凭借该电影提名第34届大众电影百花奖最佳男主角，该片中国内地票房33.97亿元，刷新2D电影和喜剧电影票房纪录，总票房居中国影史前三；同年，还主演了古装剧《九州缥缈录》。&lt;br/&gt;&lt;/p&gt;&lt;p&gt;杰伊·巴鲁切尔，1982年生在加拿大渥太华，电影演员。&lt;/p&gt;&lt;p&gt;杰伊·巴鲁切尔曾通过试镜得到了贾德·阿帕图的大学校园生活喜剧《叛逆校园》中主角角色，出演一位单纯可爱的大学新生。2000年通过热门影片《几近成名》中的一个小角色而登上了大银幕。&lt;/p&gt;&lt;p&gt;亚美莉卡·费雷拉（America Ferrera），1984年4月18日出生于美国加州洛杉矶，演员和制片人。&lt;/p&gt;&lt;p&gt;2002年，主演了电影处女作《曲线窈窕非梦事》并凭借此片获得2003年青年艺人大奖最佳电影年轻女演员的提名。2005年出演了电影《牛仔裤的夏天》。2006年，开始在ABC美剧《丑女贝蒂》出演女主角贝蒂，也凭借此剧获得2007年美国金球奖喜剧或音乐电视剧最佳女演员奖和黄金时段艾美奖喜剧电视剧最佳女主角奖。2010年，在梦工厂动画电影《驯龙高手》为Astrid配音。同年在自己未来丈夫Ryan\r\n Piers Williams执导和编剧的电影《干燥的土地》里饰演女主角。2012年和安娜·肯德里克、迈克尔·佩纳合作出演电影《警戒结束》 \r\n。2014年继续在梦工厂动画电影《驯龙高手2》为Astrid配音。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:04:01',4,0.00,0.00,'3'),(71,'复仇者联盟4','简介：漫威电影公司出品的科幻电影，复仇者联盟3将于2017.05.05上映，本作为漫威宇宙第三阶段收官之作。第二阶段收官之作复仇者联盟2将在2015.5.1上映。','20190824155405.jpg',2550.00,2.90,3.00,5,1,10000.00,50000.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;克里斯·埃文斯（Chris Evans），1981年6月13日出生于&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;马萨诸塞州波士顿&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;，美国演员、导演。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2000年，克里斯·埃文斯出演CBS剧集《&lt;span style=&quot;col:#136ec2&quot;&gt;亡命天涯&lt;/span&gt;》，该剧是他的首部电视剧作品。2001年，克里斯主演了喜剧电影《&lt;span style=&quot;col:#136ec2&quot;&gt;非常男女&lt;/span&gt;》。2005年，克里斯出演科幻电影《&lt;span style=&quot;col:#136ec2&quot;&gt;神奇四侠&lt;/span&gt;》；2007年，克里斯出演“神奇四侠”系列的续集《&lt;span style=&quot;col:#136ec2&quot;&gt;神奇四侠2：银影侠现身&lt;/span&gt;》&amp;nbsp;。2013年，克里斯主演了由&lt;span style=&quot;col:#136ec2&quot;&gt;奉俊昊&lt;/span&gt;执导的漫改电影《&lt;span style=&quot;col:#136ec2&quot;&gt;雪国列车&lt;/span&gt;》&lt;span class=&quot;sup--nmal&quot; style=&quot;font-size: 12px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; col: rgb(51, 102, 204); curs: pointer; padding: 0px 2px;&quot;&gt;&amp;nbsp;[5]&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;&lt;span style=&quot;position: relative; top: -50px; font-size: 0px; line-height: 0;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&amp;nbsp;。2014年，克里斯·埃文斯执导并且主演了爱情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;午夜邂逅&lt;/span&gt;》。2017年，克里斯·埃文斯主演的剧情影片《&lt;span style=&quot;col:#136ec2&quot;&gt;天才少女&lt;/span&gt;》上映&lt;span class=&quot;sup--nmal&quot; style=&quot;font-size: 12px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; col: rgb(51, 102, 204); curs: pointer; padding: 0px 2px;&quot;&gt;&amp;nbsp;&lt;/span&gt;。&lt;br/&gt;&lt;/p&gt;&lt;p&gt;2011年，克里斯·埃文斯主演漫改电影《美国队长：复仇者先锋》，片中饰演“&lt;span style=&quot;col:#136ec2&quot;&gt;美国队长&lt;/span&gt;”&lt;span style=&quot;col:#136ec2&quot;&gt;史蒂夫·罗杰斯&lt;/span&gt;，&amp;nbsp;其后在多部&lt;span style=&quot;col:#136ec2&quot;&gt;漫威&lt;/span&gt;电影出品的作品中饰演该角色。&lt;/p&gt;&lt;p&gt;伊万杰琳·莉莉（Nicole Lilly），1979年8月3日出生于加拿大萨斯喀彻温堡，加拿大影视演员。&lt;/p&gt;&lt;p&gt;2002年，伊万杰琳·莉莉开始参加电视剧的拍摄，2004年，她凭借出演电视剧《&lt;span style=&quot;col:#136ec2&quot;&gt;迷失&lt;/span&gt;》走红。2010年，伊万杰琳·莉莉作为女主角出演《&lt;span style=&quot;col:#136ec2&quot;&gt;铁甲钢拳&lt;/span&gt;》。2011年，她加盟《&lt;span style=&quot;col:#136ec2&quot;&gt;霍比特人&lt;/span&gt;》，饰演幽暗密林的精灵护卫队队长塔瑞尔。2015年主演漫威电影《&lt;span style=&quot;col:#136ec2&quot;&gt;蚁人&lt;/span&gt;》。&lt;br/&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;凯伦·吉兰（Karen Gillan），1987年11月28日出生于苏格兰因弗内斯，英国影视演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2007年，她以模特的身份出道。2009年，她因出演《&lt;span style=&quot;col:#136ec2&quot;&gt;神秘博士&lt;/span&gt;》中&lt;span style=&quot;col:#136ec2&quot;&gt;马特·史密斯&lt;/span&gt;的“伴游”Amy Pond而走红。2011年，她转型大银幕。2012年，她获得第17届英国国家电视奖的最佳剧情类剧集表演女演员&amp;nbsp;。在2014年8月1日上映的《&lt;span style=&quot;col:#136ec2&quot;&gt;银河护卫队&lt;/span&gt;》中，她饰演“星云”一角。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;小罗伯特·唐尼（Robert\r\n Downey \r\nJr.），1965年4月4日出生于美国纽约州纽约市，美国电影演员、制片人。1971年，5岁的他出演电影《狗》。1987年，22岁的小罗伯特·唐尼主演了喜剧片《泡妞专家》，该影片是他主演的第一部电影。1993年，小罗伯特·唐尼凭借电影《卓别林》获得第65届奥斯卡最佳男主角的提名。1997年，他因吸毒被逮捕并强制戒毒。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:05:38',6,0.00,0.00,'6'),(72,'风中有朵雨做的云','简介：沿海小城，年轻警官杨家栋（井柏然饰）初来乍到，恰遇建委主任唐奕杰（张颂文饰）坠楼身亡，杨家栋展开调查，惨遭革职、追杀，一路逃往香港，与死者女儿小诺（马思纯饰）意外邂逅，在小诺的协助下继续追查，浑然不觉自己正落入一个纯情陷阱,《风中有朵雨做的云》是由娄烨执导、张家鲁担任监制的悬疑犯罪','20190824155506.png',2600.00,2.98,2.00,7,1,20000.00,100000.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;井柏然，1989年4月19日出生于辽宁省沈阳市，中国内地影视男演员、流行乐歌手，毕业于沈阳外事服务学校。&lt;/p&gt;&lt;p&gt;2007年，参加东方卫视选秀娱乐节目《加油！好男儿》的比赛，获得沈阳唱区冠军、全国总决赛冠军、最佳网络人气奖，从而正式进入演艺圈\r\n \r\n；同年，加入“BoBo”组合，并推出组合首张EP专辑《光荣》。2008年，随BoBo推出组合首张音乐专辑《世界之大》。2009年，在校园情景剧《青春进行时》中饰演男主角井宝\r\n 。2010年，凭借电影《全城热恋》获得“第17届北京大学生电影节”最佳新人奖；同年，与郭书瑶推出EP专辑《暖暖手》。&lt;/p&gt;&lt;p&gt;2011年，推出首张个人音乐专辑《井柏然》。2012年，获得“第11届中国原创音乐流行榜”最优秀新人奖。2013年，在剧情电影《等风来》中饰演男主角王灿。2014年，主演古装穿越情感剧《相爱穿梭千年》。2015年，主演古装奇幻电影《捉妖记》；同年，凭借电影《失孤》获得“第30届金鸡奖”最佳男配角奖的提名。2016年，在爱情电影《微微一笑很倾城》中饰演男主角肖奈。2017年4月，作为固定成员参加湖南卫视青春伙伴自助远行真人秀节目《花儿与少年第三季》。2018年，继续出演古装奇幻电影《捉妖记2》。4月28日，主演的爱情片《后来的我们》上映。&lt;br/&gt;&lt;/p&gt;&lt;p&gt;马思纯（Sra），1988年3月14日出生于安徽省蚌埠市，毕业于中国传媒大学，中国内地影视女演员。&lt;/p&gt;&lt;p&gt;1995年，马思纯参演个人首部电影《三个人的冬天》。2000年，马思纯参演个人首部电视剧《大宅门》。2007年，她因担任饶雪漫小说《甜酸》的书模而为人所知。2011年，马思纯出演了都市剧《摩登新人类》。2012年，她凭借电影《岁月无声》获得中国电影表演艺术学会金凤凰奖最佳新人奖。&lt;/p&gt;&lt;p&gt;2014年，马思纯凭借青春片《左耳》获得台湾第52届金马奖最佳女配角提名。2015年，马思纯主演了悬爱剧《他来了请闭眼》；同年，她还出版了个人首本图文随笔集《如果有一件小事是重要的》。2016年，马思纯凭借剧情片《七月与安生》获得第53届台湾电影金马奖最佳女主角奖；同年，她还凭借《左耳》获得中国电影表演艺术学会金凤凰奖学会奖&lt;/p&gt;&lt;p&gt;宋佳，1980年11月13日出生于黑龙江省哈尔滨市南岗区，毕业于上海戏剧学院表演系，中国女演员，因有同名的前辈女演员宋佳，故多被媒体称为“小宋佳”。&amp;nbsp;&lt;/p&gt;&lt;p&gt;2006年出演电影《好奇害死猫》开始崭露头角，并因此获第26届中国电影金鸡奖最佳女配角提名；2012年，出演都市励志剧《那样芬芳》，饰演荣芬芳。\r\n \r\n同年，宋佳凭借《悬崖》获得第18届上海电视节最佳电视剧女演员奖和第9届中国金鹰电视艺术节“最佳艺术表演女演员奖”；2013年凭借主演电影《萧红》获29届中国电影金鸡奖“最佳女主角”、第9届中美电影节金天使奖“最佳女演员”。&lt;/p&gt;&lt;p&gt;2014年9月23日，主演的跨年代情感剧《爷们儿》登陆东方、安徽、陕西和天津四大卫视黄金档\r\n \r\n&amp;nbsp;。2014年参与湖南卫视原创校园纪实节目《一年级》，担任实习生活老师。同年主演的近代战争剧《四十九日·祭》于12月1日在湖南卫视金鹰独播剧场播出。2015年3月26日，主演的电视剧《嘿，老头！》在北京卫视和东方卫视黄金档播出。同年12月10日，主演的电影《师父》在电影院上映。2016年1月5日，联合国正式授予“联合国环境署可持续消费项目倡导者”称谓，宋佳成为首位被联合国授予官方身份的80后公众人物。2016年1月12日，主演的电视剧《少帅》在北京卫视和东方卫视黄金档播出。2016年，主演电影《陆垚知马俐》并演唱主题歌。2017年，其主演的电影《冰之下》入围第20届上海国际电影节\r\n 。&lt;/p&gt;&lt;p&gt;秦昊，1978年5月19日出生，演员，2000年毕业于中央戏剧学院表演系。&lt;/p&gt;&lt;p&gt;2005年，主演电影《青红》，并随剧组首次赴戛纳。2009年，主演电影《春风沉醉的夜晚》，获第62届戛纳电影节最佳编剧奖\r\n \r\n。2010年，与王学圻主演电影《日照重庆》。2011年，参与拍摄由张艺谋执导电影《金陵十三钗》。2012年，主演中日合拍电影《初到东京》。2014年，主演的电影《推拿》在柏林首映，并于2016年3月8日，获得首届“金羊奖”澳门国际电影节“金羊奖”最佳男主角。2016年愚人节，主演的电影《火锅英雄》上映。&lt;/p&gt;&lt;p&gt;2017年，主演陈凯歌执导电影《妖猫传》上映 。12月29日，电影《解忧杂货店》上映。同年，主演社会派推理超级网剧《无证之罪》，并加盟现代探险题材电视剧《沙海》。2018年，出演军旅题材电视剧《尉官正年轻》主演的文艺片《你好，之华》上映。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:07:55',7,0.00,0.00,'6'),(73,'吴京主演《流浪地球》','简介：慈欣同名小说《流浪地球》改编的电影预计五月开机，导演郭凡透露该电影已筹备一年半时间，计划将于2018年暑期或19年初公映，具体演员阵容方面也已确定，但导演表示暂不方便透露。为展现《流浪地球》中的宏大世界，整个创作团队一直坚持实打实地创作。三百多人的概设团队和美术团队用十五个月的设','20190824155607.png',2660.00,3.10,2.00,8,1,30000.00,150000.00,5,'中国人民财产保险股份有限公司',0,'&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;吴京，1974年4月3日出生于北京，中国内地影视男演员、电影导演，毕业于北京体育大学。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;1989年进入北京市武术队。1994年获得全国武术比赛精英赛枪术、对练冠军。1995年出演个人首部电影《&lt;span style=&quot;col:#136ec2&quot;&gt;功夫小子闯情关&lt;/span&gt;》，从而进入演艺圈。1998年因在古装剧《&lt;span style=&quot;col:#136ec2&quot;&gt;太极宗师&lt;/span&gt;》中饰演杨昱乾一角而被观众熟知。1999年主演武侠剧《&lt;span style=&quot;col:#136ec2&quot;&gt;小李飞刀&lt;/span&gt;》&lt;span style=&quot;col:#136ec2&quot;&gt;&lt;span style=&quot;position: relative; top: -50px; font-size: 0px; line-height: 0;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;。2003年赴香港发展电影事业。2005年参演动作片《&lt;span style=&quot;col:#136ec2&quot;&gt;杀破狼&lt;/span&gt;》并首次尝试反派角色。2007年，凭借动作警匪片《&lt;span style=&quot;col:#136ec2&quot;&gt;男儿本色&lt;/span&gt;》获得第44届台湾电影&lt;span style=&quot;col:#136ec2&quot;&gt;金马奖&lt;/span&gt;最佳男配角提名。2008年开始转型担任导演，并于同年执导导演处女作《&lt;span style=&quot;col:#136ec2&quot;&gt;狼牙&lt;/span&gt;》。2012年在军旅剧《&lt;span style=&quot;col:#136ec2&quot;&gt;我是特种兵之利刃出鞘&lt;/span&gt;》中首度饰演军人。&lt;/p&gt;&lt;p&gt;2015年主演犯罪悬疑片《&lt;span style=&quot;col:#136ec2&quot;&gt;杀破狼2&lt;/span&gt;》；同年，自编自导自演军事战争片《&lt;span style=&quot;col:#136ec2&quot;&gt;战狼&lt;/span&gt;》，并凭借该片获得第33届大众电影百花奖最佳导演奖提名、&lt;span style=&quot;col:#136ec2&quot;&gt;第22届北京大学生电影节&lt;/span&gt;最佳处女作奖、&lt;span style=&quot;col:#136ec2&quot;&gt;第20届华鼎奖&lt;/span&gt;最最佳新锐导演奖。2017年自导自演动作片《战狼Ⅱ》，该片打破中国内地票房纪录以及全球单一市场单片票房纪录，凭借该片获得&lt;span style=&quot;col:#136ec2&quot;&gt;第十四届广州大学生电影节&lt;/span&gt;最受大学生欢迎的导演以及最受大学生欢迎的男演员奖、&lt;span style=&quot;col:#136ec2&quot;&gt;第四届丝绸之路国际电影节&lt;/span&gt;突出贡献个人奖。&lt;br/&gt;&lt;br/&gt;屈楚萧，出生于四川眉山，中国内地男演员，就读于中央戏剧学院2013级本科班。&lt;/p&gt;&lt;p&gt;2016年，出演网络剧《&lt;span style=&quot;col:#136ec2&quot;&gt;我的朋友陈白露小姐&lt;/span&gt;》而正式进入娱乐圈。2017年，出演古装传奇剧《&lt;span style=&quot;col:#136ec2&quot;&gt;独步天下&lt;/span&gt;》，饰演少年英雄多尔衮；同年，加盟古装剧《&lt;span style=&quot;col:#136ec2&quot;&gt;如懿传&lt;/span&gt;》，饰演五阿哥永琪。2018年，主演网络剧《&lt;span style=&quot;col:#136ec2&quot;&gt;媚者无疆&lt;/span&gt;》。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); text-align: justify; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px;&quot;&gt;屈菁菁，出生于辽宁省沈阳市，毕业于&lt;/span&gt;&lt;span style=&quot;font-family:arial, 宋体, sans-serif;col:#136ec2&quot;&gt;&lt;span style=&quot;font-size: 14px; text-indent: 28px;&quot;&gt;中央戏剧学院&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); text-align: justify; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px;&quot;&gt;，中国内地女演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2007年，屈菁菁首次出演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;命运呼叫转移&lt;/span&gt;》，正式开始演艺生涯。2008年参演谍战剧《&lt;span style=&quot;col:#136ec2&quot;&gt;敌营十八年II&lt;/span&gt;》。2012年参演都市婚孕轻喜剧《&lt;span style=&quot;col:#136ec2&quot;&gt;今夜天使降临&lt;/span&gt;》。2013年出演剧情电影《&lt;span style=&quot;col:#136ec2&quot;&gt;黄金时代&lt;/span&gt;》。2014年主演喜剧动作电影《&lt;span style=&quot;col:#136ec2&quot;&gt;老男孩之猛龙过江&lt;/span&gt;》，凭借该片获得第6届澳洲华语国际电影节推荐新人奖&amp;nbsp;。2015年主演中美合拍动作电影《&lt;span style=&quot;col:#136ec2&quot;&gt;龙之诞生&lt;/span&gt;》。2016年，主演喜剧动作电影《&lt;span style=&quot;col:#136ec2&quot;&gt;东北往事之破马张飞&lt;/span&gt;》，随后客串出演网剧《&lt;span style=&quot;col:#136ec2&quot;&gt;法医秦明&lt;/span&gt;》，10月主演都市情感喜剧《&lt;span style=&quot;col:#136ec2&quot;&gt;当分手大师遇到复合大师&lt;/span&gt;》。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:10:31',8,0.00,0.00,'6'),(75,'毒液：致命守护者','简介：蜘蛛侠最强劲敌“毒液”首登银幕，展现了邪恶外星生物附身无辜人类后所拥有的强大暗黑力量，及其正邪两面的激烈对抗。曾主演《蝙蝠侠：黑暗骑士崛起》《盗梦空间》等多部口碑大片的肌肉型男汤姆·哈迪在片中饰演毒液的宿主——记者艾迪·布洛克。在调查生命基金会的最新科学实验过程中，他受到不明外星物','20190824155721.png',2800.00,6.66,3.00,3,1,10000.00,10000.00,1,'中国人民财产保险股份有限公司',0,'&lt;p&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;汤姆·哈迪（Tom Hardy），1977年9月15日出生于英国伦敦，英国影视演员。&lt;/span&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;2001年参演美剧《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;兄弟连&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》进入演艺圈，同年出演首部电影《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;黑鹰坠落&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》。2002年在《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;星际迷航：复仇女神&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》中饰演反派。2007年主演《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;斯图尔特：倒带人生&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》被提名英国电视学院奖最佳男演员。2008年主演《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;布朗森&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》而获得第12届英国独立电影奖最佳男主角奖。2010年在《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;盗梦空间&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》中饰演“伪装者”Eames。2012年在《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;蝙蝠侠：黑暗骑士崛起&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》中饰演&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;贝恩&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;一角。2015年12月，凭借《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;传奇&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》获得&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;第18届英国独立电影奖&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;最佳男主角奖。2016年凭借电影《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;荒野猎人&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;》获得第88届奥斯卡金像奖最佳男配角提名。&lt;/span&gt;&lt;br/&gt;&lt;br/&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-family: &quot;&gt;米歇尔·威廉姆斯（Michelle Williams），1980年9月9日出生于美国蒙大拿州卡利斯佩尔，美国演员。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;1994年，参与拍摄电影《&lt;span style=&quot;col:#136ec2&quot;&gt;新灵犬莱西&lt;/span&gt;》。1997年，在罗宾斯全美交易竞赛中赢得冠军。1998年，参与拍摄电视剧《&lt;span style=&quot;col:#136ec2&quot;&gt;恋爱时代&lt;/span&gt;》。2005年，主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;断背山&lt;/span&gt;》。2008年，主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;温蒂和露西&lt;/span&gt;》。2010年，主演由德里克·斯安弗朗斯执导的电影《&lt;span style=&quot;col:#136ec2&quot;&gt;蓝色情人节&lt;/span&gt;》。2012年，凭借电影《&lt;span style=&quot;col:#136ec2&quot;&gt;我与梦露的一周&lt;/span&gt;》中&lt;span style=&quot;col:#136ec2&quot;&gt;玛丽莲·梦露&lt;/span&gt;一角获得美国金球奖最佳女主角，凭《&lt;span style=&quot;col:#136ec2&quot;&gt;蓝色情人节&lt;/span&gt;》、《&lt;span style=&quot;col:#136ec2&quot;&gt;我与梦露的一周&lt;/span&gt;》分别获第83、84届奥斯卡金像奖最佳女主角两次提名，2012年被美国《&lt;span style=&quot;col:#136ec2&quot;&gt;人物&lt;/span&gt;》评选为全球最美女性第7位。2013年，主演电影《&lt;span style=&quot;col:#136ec2&quot;&gt;魔境仙踪&lt;/span&gt;》。&lt;br/&gt;&lt;br/&gt;&lt;span style=&quot;font-family: arial, 宋体, sans-serif;&quot;&gt;里兹·阿迈德（Riz Ahmed），1982年12月1日出生于英国伦敦，英国男演员、说唱歌手&lt;/span&gt;&lt;span style=&quot;font-family: arial, 宋体, sans-serif;&quot;&gt;。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2012年，凭借《病态领土》提名第15届英国独立电影奖最佳男主角奖。2014年在《夜行者》中扮演街头小混混，凭借该角色获得提名第30届&lt;span style=&quot;col:#136ec2&quot;&gt;美国独立精神奖&lt;/span&gt;最佳男配角奖和24届哥谭独立电影奖年度突破演员奖。2016年因出演《星球大战外传：侠盗一号》被观众所熟知；同年出演美剧《罪夜之奔》。&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;&lt;span style=&quot;position: relative; top: -50px; font-size: 0px; line-height: 0;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;珍妮·斯蕾特（Jenny Slate），女，1982年3月25日出生于美国马萨诸塞州米尔顿，美国演员、编剧&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;。&lt;br/&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;2014年，凭借《&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;平淡无奇的孩子&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;》提名第24届&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;哥谭独立电影奖&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;最佳突破演员奖&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;。2015年，凭借《平淡无奇的孩子》获得第20届&lt;/span&gt;&lt;span style=&quot;col:#136ec2&quot;&gt;美国广播影评人协会奖&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;最佳喜剧女演员奖&lt;/span&gt;&lt;span style=&quot;col: rgb(51, 51, 51); font-size: 14px; text-align: justify; text-indent: 28px; font-family: arial, 宋体, sans-serif;&quot;&gt;。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;','2019-08-09 20:35:42',9,0.00,0.00,'7');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online`
--

DROP TABLE IF EXISTS `online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `bid` varchar(30) NOT NULL DEFAULT '无' COMMENT '商户号',
  `appid` varchar(100) NOT NULL DEFAULT '无' COMMENT 'APPID',
  `appkey` varchar(100) NOT NULL DEFAULT '无' COMMENT '密钥',
  `domain` varchar(100) NOT NULL DEFAULT '无' COMMENT '域名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='在线支付';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online`
--

LOCK TABLES `online` WRITE;
/*!40000 ALTER TABLE `online` DISABLE KEYS */;
INSERT INTO `online` VALUES (1,'','','','www.j6.com');
/*!40000 ALTER TABLE `online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `openid`
--

DROP TABLE IF EXISTS `openid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `openid` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `un` varchar(50) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `denglutime` datetime DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `openid`
--

LOCK TABLES `openid` WRITE;
/*!40000 ALTER TABLE `openid` DISABLE KEYS */;
INSERT INTO `openid` VALUES (18,NULL,'13333333333','2019-07-22 17:35:09');
/*!40000 ALTER TABLE `openid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `address_id` int(11) DEFAULT NULL COMMENT '地址ID',
  `member_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `pay_time` varchar(11) DEFAULT NULL COMMENT '支付时间',
  `add_time` varchar(11) DEFAULT NULL COMMENT '下单时间',
  `fh_time` varchar(11) DEFAULT NULL,
  `state` int(2) DEFAULT '1' COMMENT '1未付款 2已付款 3已发货 4完成',
  `type` int(2) DEFAULT NULL COMMENT '商品类别1套餐2普通商品',
  `order_sn` varchar(50) DEFAULT NULL COMMENT '订单号',
  `total` decimal(11,2) DEFAULT '0.00' COMMENT '商品总价',
  `kd_dh` varchar(50) DEFAULT NULL,
  `kd_name` varchar(50) DEFAULT NULL,
  `freight` decimal(11,2) DEFAULT NULL,
  `tixingfahuo` int(1) DEFAULT '0' COMMENT '提醒发货1已提醒0未提醒',
  `sh_time` varchar(11) DEFAULT NULL COMMENT '收货时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,NULL,53564,NULL,'1566637221',NULL,1,NULL,'201908241566637221',NULL,NULL,NULL,NULL,0,NULL),(2,1,53564,NULL,'1566637254',NULL,1,NULL,'201908241566637254',NULL,NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `goods_name` varchar(200) DEFAULT NULL COMMENT '商品名称',
  `goods_price` decimal(8,2) DEFAULT NULL COMMENT '商品价格',
  `goods_num` int(11) DEFAULT '0' COMMENT '商品数量',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品ID',
  `goods_photo` varchar(255) DEFAULT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,1,'小天才儿童电话手表 Z1y 路径追踪防水GPS定位智能手表 学生儿童移动联通双4G手表',19750.00,1,NULL,'20190611205256.jpg'),(2,2,'小天才儿童电话手表 Z1y 路径追踪防水GPS定位智能手表 学生儿童移动联通双4G手表',19750.00,1,NULL,'20190611205256.jpg'),(3,1,NULL,NULL,NULL,NULL,NULL),(4,2,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otcms_order_details`
--

DROP TABLE IF EXISTS `otcms_order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otcms_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `goods_name` varchar(200) DEFAULT NULL COMMENT '商品名称',
  `goods_price` decimal(8,2) DEFAULT NULL COMMENT '商品价格',
  `goods_num` int(11) DEFAULT '0' COMMENT '商品数量',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品ID',
  `goods_photo` varchar(255) DEFAULT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otcms_order_details`
--

LOCK TABLES `otcms_order_details` WRITE;
/*!40000 ALTER TABLE `otcms_order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `otcms_order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_class`
--

DROP TABLE IF EXISTS `project_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_class` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `add_time` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL DEFAULT '#000',
  `sort` varchar(20) NOT NULL,
  `user_class` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_class`
--

LOCK TABLES `project_class` WRITE;
/*!40000 ALTER TABLE `project_class` DISABLE KEYS */;
INSERT INTO `project_class` VALUES (3,'新手体验区','20190610004557.png','20190520125632.png','','1565347023','','1',''),(6,'精选区','20190610004853.png','20190520141247.png','','1565354082','','2',''),(7,'VIP专区','20190610010423.png','20190610012410.png','','1565354112','','3','');
/*!40000 ALTER TABLE `project_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge`
--

DROP TABLE IF EXISTS `recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `type` varchar(20) NOT NULL DEFAULT '无' COMMENT '付款方式',
  `orderid` varchar(50) NOT NULL DEFAULT '无' COMMENT '订单编号',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '充值状态，0未充值/1已充值',
  `warn` int(11) NOT NULL DEFAULT '0' COMMENT '充值提醒',
  `reason` varchar(100) NOT NULL DEFAULT '无' COMMENT '充值摘要',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '提交时间',
  `time2` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '审核时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10687 DEFAULT CHARSET=utf8 COMMENT='充值表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge`
--

LOCK TABLES `recharge` WRITE;
/*!40000 ALTER TABLE `recharge` DISABLE KEYS */;
INSERT INTO `recharge` VALUES (10683,53560,10000.00,'银行入款','PAY1565357326428',1,0,'无','2019-08-09 21:28:46','2019-08-09 21:29:24'),(10684,53564,10000000.00,'银行入款','PAY1565364929285',1,0,'付款人：王俊凯<br/>转账附言：1000000','2019-08-09 23:35:29','2019-08-09 23:35:49'),(10672,53560,1.01,'支付宝充值','2019080422001422050556808397',1,0,'无','2019-08-04 00:11:09','2019-08-04 00:11:09'),(10673,53561,9982.00,'系统充值','PAY1565191316254',1,0,'无','2019-08-07 23:21:56','0000-00-00 00:00:00'),(10677,53560,100.00,'微信在线扫吗支付（吗支付）','PAY1565192311720',1,0,'无','2019-08-07 23:38:31','2019-08-07 23:54:58'),(10682,53562,9982.00,'系统充值','PAY1565348757936',1,0,'无','2019-08-09 19:05:57','0000-00-00 00:00:00'),(10685,53564,100.00,'银行入款','PAY1566633721460',1,0,'无','2019-08-24 16:02:01','2019-08-24 16:02:46'),(10686,53565,8888.00,'系统充值','PAY1576222220529',1,0,'无','2019-12-13 15:30:20','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward`
--

DROP TABLE IF EXISTS `reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `register` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '用户注册',
  `register2` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '邀请注册',
  `recharge` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值奖励',
  `invest1` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '投资一级奖励',
  `invest2` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '投资二级奖励',
  `invest3` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '投资三级奖励',
  `qiandao` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '每日签到奖励',
  `shouyilu` varchar(50) NOT NULL COMMENT '收益率',
  `zijin` varchar(200) NOT NULL COMMENT '设置存进余额宝的资金',
  `chongzhijifen` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='奖励设置';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward`
--

LOCK TABLES `reward` WRITE;
/*!40000 ALTER TABLE `reward` DISABLE KEYS */;
INSERT INTO `reward` VALUES (1,18.00,0.00,0.00,5.00,2.00,1.00,2.00,'','','1');
/*!40000 ALTER TABLE `reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `path` varchar(100) NOT NULL DEFAULT '#' COMMENT '图片路径',
  `url` varchar(100) NOT NULL DEFAULT '#' COMMENT '图片链接',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '图片类型，1电脑/2手机',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `show` int(11) NOT NULL DEFAULT '0' COMMENT '显示，0不显示/1显示',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='幻灯片';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

LOCK TABLES `slide` WRITE;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
INSERT INTO `slide` VALUES (25,'20190824164002.jpg','',2,2,1),(26,'20190824164011.jpg','',2,3,1);
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `type` varchar(20) NOT NULL DEFAULT '无' COMMENT '短信类型',
  `msg` varchar(80) NOT NULL DEFAULT '无' COMMENT '内容',
  `code` varchar(20) NOT NULL DEFAULT '0' COMMENT '编码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='短信模板';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms`
--

LOCK TABLES `sms` WRITE;
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
INSERT INTO `sms` VALUES (1,'用户注册','您的手机注册验证码是：###，如非本人操作，请忽略本信息！','18001'),(4,'找回密码','您的找回密码的验证码是：###，如非本人操作，请忽略本信息！','18004'),(3,'收益提醒','您的收益###元已到账，请登录会员中心查看！','18003'),(7,'提现成功提醒','您申请的提现###元已到账，如非本人操作，请忽略本信息！','18007'),(5,'充值成功提醒','您充值的###元已到账，如非本人操作，请忽略本信息！','18005'),(8,'提现失败提现','您申请的提现###元未成功，请联系在线客服！如非本人操作，请忽略本信息！','18008'),(6,'充值失败提醒','您充值的###元未到账，如非本人操作，请忽略本信息！','18006'),(2,'投资成功','您购买的“###”项目已成功！','18002');
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_list`
--

DROP TABLE IF EXISTS `sms_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `phone` varchar(11) NOT NULL DEFAULT '无' COMMENT '手机号码',
  `msg` varchar(100) NOT NULL DEFAULT '无' COMMENT '短信记录',
  `code` varchar(100) NOT NULL DEFAULT '0' COMMENT '返回代码',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发送时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=18684 DEFAULT CHARSET=utf8 COMMENT='短信记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_list`
--

LOCK TABLES `sms_list` WRITE;
/*!40000 ALTER TABLE `sms_list` DISABLE KEYS */;
INSERT INTO `sms_list` VALUES (18678,'13020982137','【普汇中金】您的手机注册验证码是：7543，如非本人操作，请忽略本信息！','000#模板不可用','2019-08-07 19:55:55'),(18679,'13020982137','【普汇中金】您的手机注册验证码是：5849，如非本人操作，请忽略本信息！','000#未自动匹配到合适的模板','2019-08-07 19:59:18'),(18680,'13011223344','【普汇中金】您的手机注册验证码是：9227，如非本人操作，请忽略本信息！','000#','2019-08-09 12:28:38'),(18681,'13100004567','【普汇中金】您的手机注册验证码是：8171，如非本人操作，请忽略本信息！','000#','2019-08-09 12:31:01'),(18682,'13100004567','【普汇中金】您的手机注册验证码是：2625，如非本人操作，请忽略本信息！','000#','2019-08-09 12:31:45'),(18683,'13100004567','【普汇中金】您的手机注册验证码是：2585，如非本人操作，请忽略本信息！','000#请求参数缺失','2019-08-09 12:37:01');
/*!40000 ALTER TABLE `sms_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `uid` int(50) NOT NULL,
  `content` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station`
--

LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
INSERT INTO `station` VALUES (1,2,'aaaaaaaaaaaaaaaaaa','1560088562'),(2,2,'dsafaada','1560088647'),(3,2,'dsssssssssss','1970-01-01 08:00:00'),(4,2,'dsssssssss','2019-06-09 22:00:03'),(5,2,'起初站内只有一只沙发和一张桌子，但现在已经有了电视机、艺术品，甚至装上了窗帘。ItstartedwithasofaatablenowhasaTV,artevencurtains.www.hjengli','2019-06-09 22:01:45');
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `phone` varchar(50) NOT NULL DEFAULT '0' COMMENT '手机号',
  `name` varchar(20) NOT NULL DEFAULT '无' COMMENT '姓名',
  `idcard` varchar(18) NOT NULL DEFAULT '无' COMMENT '身份证号码',
  `auth` int(11) NOT NULL DEFAULT '0' COMMENT '是否认证,0未认证/1已认证',
  `password` varchar(32) NOT NULL DEFAULT '0' COMMENT '登录密码',
  `password2` varchar(32) NOT NULL DEFAULT '0' COMMENT '交易密码',
  `top` int(11) NOT NULL DEFAULT '0' COMMENT '推荐人',
  `member` int(11) NOT NULL DEFAULT '0' COMMENT '会员等级',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `value` int(11) NOT NULL DEFAULT '0' COMMENT '成长值',
  `income` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总收益金额',
  `logintime` varchar(20) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `clock` int(11) NOT NULL DEFAULT '0' COMMENT '是否锁定,0否/1是',
  `qiandao` varchar(20) NOT NULL DEFAULT '0' COMMENT '签到时间',
  `time` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `reg_ip` varchar(20) NOT NULL,
  `jifen` varchar(200) DEFAULT '0',
  `dongjiemoney` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=53566 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (53561,'13020982137','李哲','430123198802281765',0,'e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',53560,8001,10030.00,0,30.00,'1565180735',0,'0','2019-08-07 19:59:58','36.155.93.206','0',''),(53562,'13100004567','abcc','abc',1,'e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',53561,8001,8111.50,600,67.50,'1565362066',0,'0','2019-08-09 12:37:27','120.253.193.170','0',''),(53564,'13888888888','王俊凯','410521198654643164',1,'e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',0,8009,9825038.00,766200,274937.00,'1566637701',0,'2019-08-24 16:01:45','2019-08-09 23:33:09','112.96.43.175','10000100',NULL),(53563,'16680147605','无','无',0,'006e8c548a7049adb915d586535a133a','006e8c548a7049adb915d586535a133a',0,0,0.00,0,0.00,'1565365561',0,'0','2019-08-09 22:22:45','112.96.43.175','0',NULL),(53565,'18812345678','日源码','441323199201251573',1,'cac6e7c8c36ff0768f900cefb3dd30ca','cac6e7c8c36ff0768f900cefb3dd30ca',0,8001,8691.00,200,2.00,'1576223643',0,'2019-12-13 15:33:20','2019-12-13 15:19:33','182.246.108.184','0',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_member`
--

DROP TABLE IF EXISTS `user_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(20) NOT NULL DEFAULT '无' COMMENT '等级名称',
  `value` int(11) NOT NULL DEFAULT '0' COMMENT '等级积分',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '等级加息利率',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8014 DEFAULT CHARSET=utf8 COMMENT='会员等级表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_member`
--

LOCK TABLES `user_member` WRITE;
/*!40000 ALTER TABLE `user_member` DISABLE KEYS */;
INSERT INTO `user_member` VALUES (8001,'VIP0',0,0.00),(8003,'VIP2',50000,0.00),(8004,'VIP3',100000,0.00),(8008,'VIP1',200000,0.00),(8009,'VIP4',300000,0.00);
/*!40000 ALTER TABLE `user_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xydzp`
--

DROP TABLE IF EXISTS `xydzp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xydzp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) DEFAULT NULL,
  `wid` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ms` varchar(1023) DEFAULT NULL COMMENT '优惠描述',
  `kssj` datetime DEFAULT NULL,
  `jssj` datetime DEFAULT NULL,
  `sl` int(11) DEFAULT NULL COMMENT '优惠券数量',
  `pic` varchar(255) DEFAULT '/res/whd/xydzp.jpg',
  `gjz` varchar(50) DEFAULT NULL,
  `j1mc` varchar(255) DEFAULT NULL,
  `j1ms` varchar(1023) DEFAULT NULL,
  `j1gl` varchar(8) DEFAULT NULL,
  `j1sl` int(11) DEFAULT NULL,
  `j2mc` varchar(255) DEFAULT NULL,
  `j2ms` varchar(1023) DEFAULT NULL,
  `j2gl` varchar(8) DEFAULT NULL,
  `j2sl` int(11) DEFAULT NULL,
  `j3mc` varchar(255) DEFAULT NULL,
  `j3ms` varchar(1023) DEFAULT NULL,
  `j3gl` varchar(8) DEFAULT NULL,
  `j3sl` int(11) DEFAULT NULL,
  `mrzs` int(11) DEFAULT NULL COMMENT '每人参与总数',
  `mtsl` int(11) DEFAULT NULL COMMENT '每天数量',
  `isshowsl` tinyint(1) DEFAULT '1' COMMENT '是否显示奖品数量',
  `j1yj` int(11) DEFAULT NULL COMMENT '已经被抽到的次数',
  `j2yj` int(11) DEFAULT NULL,
  `j3yj` int(11) DEFAULT NULL,
  `j4mc` varchar(255) DEFAULT NULL,
  `j4ms` varchar(1023) DEFAULT NULL,
  `j4gl` varchar(8) DEFAULT NULL,
  `j4sl` int(11) DEFAULT NULL,
  `j5mc` varchar(255) DEFAULT NULL,
  `j5ms` varchar(1023) DEFAULT NULL,
  `j5gl` varchar(8) DEFAULT NULL,
  `j5sl` int(11) DEFAULT NULL,
  `j6mc` varchar(255) DEFAULT NULL,
  `j6ms` varchar(1023) DEFAULT NULL,
  `j6gl` varchar(8) DEFAULT NULL,
  `j6sl` int(11) DEFAULT NULL,
  `j7mc` varchar(255) DEFAULT NULL,
  `j7ms` varchar(1023) DEFAULT NULL,
  `j7gl` varchar(8) DEFAULT NULL,
  `j7sl` int(11) DEFAULT NULL,
  `j8mc` varchar(255) DEFAULT NULL,
  `j8ms` varchar(1023) DEFAULT NULL,
  `j8gl` varchar(8) DEFAULT NULL,
  `j8sl` int(11) DEFAULT NULL,
  `j4yj` int(11) DEFAULT '0',
  `j5yj` int(11) DEFAULT '0',
  `j6yj` int(11) DEFAULT '0',
  `j7yj` int(11) DEFAULT '0',
  `j8yj` int(11) DEFAULT '0',
  `mrzd` int(11) DEFAULT '0' COMMENT '每天最多中奖数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=496 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xydzp`
--

LOCK TABLES `xydzp` WRITE;
/*!40000 ALTER TABLE `xydzp` DISABLE KEYS */;
INSERT INTO `xydzp` VALUES (483,102,108,'幸运大转盘','dsa','2014-10-21 10:10:56','2019-12-30 23:59:59',1,'/res/whd/xydzp.jpg','大转盘','手机充值','手机话费','10',20,'手机充值','手机话费','20',15,'手机充值','手机话费','30',10,66,44,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,5);
/*!40000 ALTER TABLE `xydzp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xydzp_record`
--

DROP TABLE IF EXISTS `xydzp_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xydzp_record` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `openid` int(11) DEFAULT '0',
  `tel` char(11) DEFAULT NULL COMMENT '手机号',
  `jx` tinyint(4) DEFAULT NULL COMMENT '获得的奖项',
  `jtime` datetime DEFAULT NULL COMMENT '抓奖时间',
  `jdate` date DEFAULT NULL,
  `iscom` tinyint(1) DEFAULT '0' COMMENT '是否领奖',
  `un` varchar(255) DEFAULT NULL,
  `dizhi` varchar(255) DEFAULT NULL COMMENT '收货地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xydzp_record`
--

LOCK TABLES `xydzp_record` WRITE;
/*!40000 ALTER TABLE `xydzp_record` DISABLE KEYS */;
INSERT INTO `xydzp_record` VALUES (78,53560,'13333333333',0,'2019-08-09 15:40:53','2019-08-09',0,NULL,NULL),(79,53560,'13333333333',0,'2019-08-09 15:43:36','2019-08-09',0,NULL,NULL);
/*!40000 ALTER TABLE `xydzp_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yuebao`
--

DROP TABLE IF EXISTS `yuebao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yuebao` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `paypal` varchar(255) NOT NULL,
  `time` varchar(200) NOT NULL,
  `dayyuebao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yuebao`
--

LOCK TABLES `yuebao` WRITE;
/*!40000 ALTER TABLE `yuebao` DISABLE KEYS */;
INSERT INTO `yuebao` VALUES (7,3,'6000','1559353495',''),(6,2,'2','1559273310','');
/*!40000 ALTER TABLE `yuebao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-13 16:23:35
