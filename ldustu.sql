-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-03-15 16:50:16
-- 服务器版本： 5.6.19
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ldustu`
--

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_article`
--

CREATE TABLE IF NOT EXISTS `ldsn_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `cnum` int(11) NOT NULL,
  `favour` int(11) NOT NULL,
  `visit` int(11) NOT NULL DEFAULT '0',
  `ismake` smallint(6) NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `time` int(11) NOT NULL,
  `from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_article_detial`
--

CREATE TABLE IF NOT EXISTS `ldsn_article_detial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `content` text NOT NULL,
  `tag` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


-- --------------------------------------------------------

--
-- 表的结构 `ldsn_column`
--

CREATE TABLE IF NOT EXISTS `ldsn_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `time` varchar(60) NOT NULL,
  `ps` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `ldsn_comment`
--

CREATE TABLE IF NOT EXISTS `ldsn_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_favour`
--

CREATE TABLE IF NOT EXISTS `ldsn_favour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_user`
--

CREATE TABLE IF NOT EXISTS `ldsn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `passwd` char(32) NOT NULL,
  `email` varchar(120) NOT NULL,
  `qq` varchar(60) NOT NULL,
  `telphone` bigint(15) NOT NULL,
  `head_pic` text NOT NULL,
  `sign_time` int(11) NOT NULL,
  `login_time` int(11) NOT NULL,
  `login_style` varchar(60) NOT NULL,
  `qqopenid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;



-- 2015-03-16 20:15
ALTER TABLE  `ldsn_comment` CHANGE  `id`  `comment_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `aid`  `article_id` INT( 11 ) NOT NULL ,
CHANGE  `uid`  `user_id` INT( 11 ) NOT NULL ,
CHANGE  `time`  `create_time` INT( 11 ) NOT NULL;


-- 2015-03-16 20:24
ALTER TABLE  `ldsn_user` CHANGE  `id`  `user_id` INT( 11 ) NOT NULL AUTO_INCREMENT;


-- 2015-03-16 23:16
RENAME TABLE  `ldustu`.`ldsn_article_detial` TO  `ldustu`.`ldsn_article_detail`;

-- 2015-03-17 00:45
ALTER TABLE  `ldsn_favour` CHANGE  `id`  `favor_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `uid`  `user_id` INT( 11 ) NOT NULL ,
CHANGE  `aid`  `article_id` INT( 11 ) NOT NULL;

RENAME TABLE  `ldustu`.`ldsn_favour` TO  `ldustu`.`ldsn_favor` ;

ALTER TABLE  `ldsn_article` CHANGE  `id`  `article_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `uid`  `user_id` INT( 11 ) NOT NULL ,
CHANGE  `cid`  `column_id` INT( 11 ) NOT NULL ,
CHANGE  `favour`  `favor` INT( 11 ) NOT NULL ,
CHANGE  `time`  `create_time` INT( 11 ) NOT NULL;

ALTER TABLE  `ldsn_article_detail` CHANGE  `id`  `detail_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `aid`  `article_id` INT( 11 ) NOT NULL;

ALTER TABLE  `ldsn_column` CHANGE  `id`  `column_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `name`  `column_name` VARCHAR( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `time`  `create_time` INT NOT NULL;


-- 2015-03-21 14:50
RENAME TABLE  `ldustu`.`ldsn_favor` TO  `ldustu`.`ldsn_favour` ;
ALTER TABLE  `ldsn_favour` CHANGE  `favor_id`  `favour_id` INT( 11 ) NOT NULL AUTO_INCREMENT;

-- 2015-03-21 15:10
ALTER TABLE  `ldsn_user` CHANGE  `passwd`  `password` CHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- 2015-03-22 09:34
ALTER TABLE  `ldsn_article` CHANGE  `cnum`  `comment_num` INT( 11 ) NOT NULL COMMENT  '评论数',
CHANGE  `favor`  `favour_num` INT( 11 ) NOT NULL COMMENT  '点赞数',
CHANGE  `visit`  `view_num` INT( 11 ) NOT NULL DEFAULT  '0' COMMENT  '访问数',
CHANGE  `ismake`  `status` SMALLINT( 6 ) NOT NULL DEFAULT  '0' COMMENT  '文章状态，0未审核，1审核通过',
CHANGE  `image`  `thumbnail` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT  '封面图片',
CHANGE  `from`  `from_device` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT  '来自何种设备发布';

-- 2015-03-23 09:54
ALTER TABLE  `ldsn_article` CHANGE  `comment_num`  `comment_num` INT( 11 ) NOT NULL DEFAULT  '0' COMMENT  '评论数',
CHANGE  `favour_num`  `favour_num` INT( 11 ) NOT NULL DEFAULT  '0' COMMENT  '点赞数';

-- 2015-03-23 12:46
ALTER TABLE  `ldsn_user` ADD  `favour_num` INT NOT NULL ,
ADD  `comment_num` INT NOT NULL;

-- 2015-03-23 16:30
ALTER TABLE  `ldsn_user` ADD  `article_num` INT NOT NULL;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--
-- 数据库: `ldustu`
--

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_ad`
--

CREATE TABLE IF NOT EXISTS `ldsn_ad` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告主键ID',
  `ad_type` varchar(60) NOT NULL COMMENT '类型',
  `ad_index` int(11) NOT NULL COMMENT '提取序列',
  `ad_name` varchar(60) NOT NULL COMMENT '广告名称',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `ad_content` text NOT NULL COMMENT '广告内容',
  PRIMARY KEY (`ad_id`),
  KEY `ad_type` (`ad_type`),
  KEY `create_time` (`create_time`),
  KEY `end_time` (`end_time`),
  KEY `start_time` (`start_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `ldsn_article` ADD  `index_status` INT NOT NULL DEFAULT  '0' COMMENT  '是否在首页显示，显示则为1，默认为0' AFTER  `view_num`;

-- 2015.05.28
ALTER TABLE  `ldsn_article` ADD  `index_pic_status` INT NOT NULL DEFAULT  '0' COMMENT  '首页顶部两张图片的状态取状态为1的，默认为0' AFTER  `index_status`;
-- 2015.05.28
ALTER TABLE  `ldsn_user` ADD  `level_status` INT NOT NULL DEFAULT  '0' COMMENT  '权限等级普通用户为0，管理员为1';

--
-- 数据库: `ldustu`
--

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_article_update`
-- 更新时间2015.06.03

CREATE TABLE IF NOT EXISTS `ldsn_article_update` (
  `up_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '更新表主键ID',
  `article_id` int(11) NOT NULL COMMENT '被更新文章ID',
  `user_id` int(11) NOT NULL COMMENT '更新操作用户',
  `update_time` int(11) NOT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`up_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
