/**
* 后台用户表
*/
CREATE TABLE `cms_admin`(
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/**
* 菜单管理表
*/
CREATE TABLE `cms_menu`(
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/**
* 新闻内容主表
*/
CREATE TABLE `cms_news`(
	`news_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
	`catid` smallint(5) unsigned NOT NULL DEFAULT '0',
	`title` varchar(80) NOT NULL DEFAULT '',
	`small_title` varchar(50) NOT NULL DEFAULT '',
	`title_font_color` varchar(250) DEFAULT NULL COMMENT '标题颜色',
	`thumb` varchar(100) NOT NULL DEFAULT '',
	`keywords` char(40) NOT NULL DEFAULT '',
	`description` varchar(250) NOT NULL COMMENT '文章描述',
	`listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
	`status` tinyint(1) NOT NULL DEFAULT '1',
	`copyfrom` varchar(250) DEFAULT NULL COMMENT '文章来源',
	`username` char(20) NOT NULL,
	`create_time` int(10) unsigned NOT NULL DEFAULT '0',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0',
 	`count` int(10) unsigned NOT NULL DEFAULT '0',
 	PRIMARY KEY (`news_id`),
 	KEY `listorder` (`listorder`),
 	KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/**
*新闻内容副表
*/
CREATE TABLE `cms_news_content`(
	`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	`news_id` mediumint(8) unsigned NOT NULL,
	`content` mediumtext NOT NULL,
	`create_time` int(10) unsigned NOT NULL DEFAULT '0',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/**
*推荐位管理表
*/
CREATE TABLE `cms_position`(
	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`name` char(30) NOT NULL DEFAULT '',
	`status` tinyint(1) NOT NULL DEFAULT '1',
	`description` char(100) DEFAULT NULL,
	`create_time` int(10) unsigned NOT NULL DEFAULT '0',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/**
*推荐位内容管理表
*/
CREATE TABLE `cms_position_content`(
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;