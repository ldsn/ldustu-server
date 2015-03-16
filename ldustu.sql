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





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
