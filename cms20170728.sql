-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: localhost    Database: imooc_cms
-- ------------------------------------------------------
-- Server version	5.6.11-log

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
-- Table structure for table `cms_admin`
--

DROP TABLE IF EXISTS `cms_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_admin` (
  `admin_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) NOT NULL DEFAULT '0',
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_admin`
--

LOCK TABLES `cms_admin` WRITE;
/*!40000 ALTER TABLE `cms_admin` DISABLE KEYS */;
INSERT INTO `cms_admin` VALUES (1,'123','123456','0',0,'','',-1),(2,'admin','aaf2c101a49b8e456f7a28f41ad95f41','0',1501158373,'abc','',1),(3,'ycj','305f02f561a36f1dc6c124233dbfb4f3','0',1501254099,'','',1),(4,'admin123','047197693fdd9e8e06015d339cd31d6d','0',0,'','',-1),(5,'ycj123','4fd897afd29b4faeb8efda91e63b53b7','0',0,'','',-1),(6,'云昌捷','ef9c1e78a90b2bcdd0897808fd1751c1','0',0,'','',-1),(7,'wlx','983558e7da942d2c44496aaa56d0adbf','0',1501149897,'843235510@qq.com','吴柳欣',1),(8,'fy','ba492518a054e36993aaa5a4f0f578d4','0',0,'','符勇',1);
/*!40000 ALTER TABLE `cms_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_menu`
--

DROP TABLE IF EXISTS `cms_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`f`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_menu`
--

LOCK TABLES `cms_menu` WRITE;
/*!40000 ALTER TABLE `cms_menu` DISABLE KEYS */;
INSERT INTO `cms_menu` VALUES (2,'用户管理',0,'admin','admin','index',1,1,1),(3,'汽车',0,'home','index','index',0,1,0),(4,'体育',0,'home','index','index',0,1,0),(5,'推荐位管理',0,'admin','position','index',3,1,1),(6,'文章管理',0,'admin','content','index',4,1,1),(7,'sbsbsb',0,'home','dda','aad',0,-1,0),(8,'电子游戏',0,'home','index','index',0,1,0),(9,'科研与产业党委',0,'admin','index','index',0,-1,1),(10,'菜单管理',0,'admin','menu','index',5,1,1),(11,'推荐位内容管理',0,'admin','positioncontent','index',2,1,1),(12,'基本管理',0,'admin','basic','index',0,1,1),(13,'产品',0,'home','fsdfa','index',0,-1,0);
/*!40000 ALTER TABLE `cms_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_news`
--

DROP TABLE IF EXISTS `cms_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_news` (
  `news_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(50) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) DEFAULT NULL COMMENT '鏍囬?棰滆壊',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL COMMENT '鏂囩珷鎻忚堪',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT '鏂囩珷鏉ユ簮',
  `username` char(20) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`),
  KEY `listorder` (`listorder`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_news`
--

LOCK TABLES `cms_news` WRITE;
/*!40000 ALTER TABLE `cms_news` DISABLE KEYS */;
INSERT INTO `cms_news` VALUES (4,4,'asdsddds','sds','blue','/upload/2017/07/18/596dd16e82c15.png','sfsf','fsdfsf',2,-1,'2','ycj',1500369293,1500532266,0),(5,4,'111ada','','red','/upload/2017/07/23/59745db108060.jpg','','daad',0,1,'1','ycj',1500369677,1500996657,9),(6,8,'中国崛起11','zg','red','/upload/2017/07/19/596ef3efcfac6.png','ggy','akuwfhalierfhq',1,-1,'1','ycj',1500379895,1500798179,0),(7,8,'中国崛起','zg','red','/upload/2017/07/19/596ef3efcfac6.png','ggy','akuwfhalierfhq',0,-1,'1','ycj',1500444558,1500861247,0),(8,3,'人民代表大会','123','red','/upload/2017/07/23/59745d99b904f.png','我','文峰区',0,1,'3','ycj',1500448427,1500798365,40),(9,4,'2016年江苏省高职院校单独招生工作相关问答','','','','','水电费',0,-1,'1','ycj',1500639134,1500689880,0),(10,8,'php教程2','gsg','red','/upload/2017/07/24/59753dd2143b8.png','php','php',0,1,'3','ycj',1500711953,1500855772,39),(11,4,'2016年江苏省高职院校单独招生工作相关问答','2016高职单招','blue','/upload/2017/07/24/597552edea540.jpg','','最全的招生信息',0,1,'2','ycj',1500856562,1500861169,41),(12,8,'南京高温预警','可怕','red','/upload/2017/07/24/597563ecbde82.png','本地','十年来最热',0,1,'2','ycj',1500865558,1501086128,173);
/*!40000 ALTER TABLE `cms_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_news_content`
--

DROP TABLE IF EXISTS `cms_news_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_news_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` mediumint(8) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_news_content`
--

LOCK TABLES `cms_news_content` WRITE;
/*!40000 ALTER TABLE `cms_news_content` DISABLE KEYS */;
INSERT INTO `cms_news_content` VALUES (2,4,'&lt;p&gt;\r\n	asdfadfsafds\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	fa\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	sdfs\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	af\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	sadf\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	sf\r\n&lt;/p&gt;',1500369293,0),(3,5,'adda&lt;img src=&quot;/upload/2017/07/18/596dd2fd70ed6.jpg&quot; alt=&quot;&quot; /&gt;',1500369677,1500798393),(4,6,'&lt;p&gt;\n	wdhfgaj\n&lt;/p&gt;\n&lt;p&gt;\n	是否看过红色客观上\n&lt;/p&gt;',1500379895,1500450502),(5,7,'&lt;p&gt;\r\n	wdhfgaj\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	fcgf\r\n&lt;/p&gt;',1500444558,1500712461),(6,8,'&lt;p&gt;\r\n	阿道夫哈克斯豆腐花\r\n&lt;/p&gt;',1500448427,1500798365),(7,9,'( ⊙ o ⊙ )是的',1500639134,0),(8,10,'&lt;p&gt;\r\n	如何使用php??\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	请开始打开编辑器???\r\n&lt;/p&gt;',1500711953,1500855772),(9,11,'相关信息',1500856562,1500861169),(10,12,'高温预警',1500865558,1500968549);
/*!40000 ALTER TABLE `cms_news_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_position`
--

DROP TABLE IF EXISTS `cms_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_position` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_position`
--

LOCK TABLES `cms_position` WRITE;
/*!40000 ALTER TABLE `cms_position` DISABLE KEYS */;
INSERT INTO `cms_position` VALUES (1,'首页大图',1,'首页重要有图新闻',1500638785,0),(2,'右侧栏目新闻',1,'次要新闻',1500638832,1500640194),(3,'特别',-1,'好文',1500638864,1500856162),(4,'广告',1,'钱',1500638874,1500640216);
/*!40000 ALTER TABLE `cms_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_position_content`
--

DROP TABLE IF EXISTS `cms_position_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_position_content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(5) unsigned NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) unsigned NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_position_content`
--

LOCK TABLES `cms_position_content` WRITE;
/*!40000 ALTER TABLE `cms_position_content` DISABLE KEYS */;
INSERT INTO `cms_position_content` VALUES (1,2,'中国崛起11','/upload/2017/07/19/596ef3efcfac6.png',NULL,6,0,-1,1500379895,1500798233),(2,2,'中国崛起','/upload/2017/07/19/596ef3efcfac6.png','',7,0,-1,1500444558,1500861236),(3,2,'人民代表大会','/upload/2017/07/23/59745d99b904f.png','',8,0,1,1500448427,1500798453),(4,4,'111ada','','',5,0,-1,1500369677,1500855952),(6,1,'文章10测试','/upload/2017/07/24/59753dd2143b8.png','',10,0,1,1500712060,1500855784),(7,3,'百度','/upload/2017/07/22/597329e5df7ae.jpg','http://www.baidu.com',0,1,-1,1500712271,1500856154),(8,1,'php教程','/upload/2017/07/22/59730be00c3a1.jpg',NULL,10,0,-1,1500712437,1500712979),(9,1,'思科培训','/upload/2017/07/23/59745c5e82736.png','http://www.imooc.com',0,0,-1,1500798068,1500855811),(10,2,'php教程2','/upload/2017/07/24/59753dd2143b8.png','',10,0,-1,1500798301,1500865991),(11,2,'111ada','/upload/2017/07/23/59745db108060.jpg','',5,0,1,1500798309,1500800209),(12,4,'百家号','/upload/2017/07/24/5975401fdb714.jpg','http://www.baidu.com',0,0,1,1500856379,0),(13,4,'接口实践课程','/upload/2017/07/24/5975406b2a45d.jpg','http://www.imooc.com',0,0,1,1500856451,1500967140),(14,2,'南京高温预警','/upload/2017/07/24/597563ecbde82.png',NULL,12,0,1,1500866007,0);
/*!40000 ALTER TABLE `cms_position_content` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-28 23:06:46
