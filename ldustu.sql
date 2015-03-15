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

--
-- 转存表中的数据 `ldsn_article`
--

INSERT INTO `ldsn_article` (`id`, `uid`, `cid`, `cnum`, `favour`, `visit`, `ismake`, `title`, `description`, `image`, `time`, `from`) VALUES
(5, 5, 1, 0, 1, 0, 1, '测试题目1', '测试描述1', 'www.ldustu.com', 1, ''),
(4, 1, 1, 0, 5, 0, 1, '测试题目2', '测试描述2', 'www.ldustu.com', 2, ''),
(6, 3, 1, 0, 1, 0, 1, '测试题目3', '测试秒速', 'www.ldustu.com', 3, 'somewhere'),
(7, 3, 2, 0, 1, 0, 1, '测试题目4', '测试秒速', 'www.ldustu.com', 4, 'somewhere');

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

--
-- 转存表中的数据 `ldsn_article_detial`
--

INSERT INTO `ldsn_article_detial` (`id`, `aid`, `content`, `tag`) VALUES
(2, 3, '简单的内容', ''),
(3, 4, '内容', ''),
(4, 6, '测试内容', ''),
(5, 7, '测试内容', '');

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

--
-- 转存表中的数据 `ldsn_column`
--

INSERT INTO `ldsn_column` (`id`, `name`, `time`, `ps`) VALUES
(1, '一号栏目', '271893981', '这是第一个测试栏目的相关描述'),
(2, '二号栏目', '2198378192', '这是第二个栏目的相关描述');

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

--
-- 转存表中的数据 `ldsn_comment`
--

INSERT INTO `ldsn_comment` (`id`, `aid`, `uid`, `content`, `time`) VALUES
(16, 3, 3, '卧槽123', 1426325629),
(12, 3, 3, '卧槽', 1426324646),
(6, 3, 4, '什么鬼', 1424068874),
(7, 3, 4, '什么鬼', 1424068953),
(8, 0, 0, '', 1425181374),
(9, 3, 3, 'fjaoidwjo', 1425181717),
(10, 3, 3, 'fjaoidwjo', 1425181759),
(11, 3, 3, 'fjaoidwjo', 1425182059),
(13, 3, 3, '卧槽', 1426324703),
(14, 3, 3, '卧槽', 1426324713),
(15, 3, 3, '卧槽', 1426324798),
(17, 3, 3, '卧槽12311111', 1426325652),
(18, 3, 3, '卧槽12311111', 1426325940),
(19, 3, 3, '卧槽12311111', 1426327223),
(20, 3, 3, '卧槽12311111', 1426327264),
(21, 3, 3, '卧槽12311111', 1426327322),
(22, 3, 3, '卧槽12311111', 1426327360),
(23, 3, 3, '卧槽12311111', 1426327362),
(24, 3, 3, '卧槽12311111', 1426327363),
(25, 3, 3, '卧槽12311111', 1426327363),
(26, 3, 3, '卧槽12311111', 1426327364),
(27, 3, 3, '卧槽12311111', 1426327364),
(28, 3, 3, '卧槽12311111', 1426327364),
(29, 3, 3, '卧槽12311111', 1426327364),
(30, 3, 3, '卧槽12311111', 1426327364),
(31, 3, 3, '卧槽12311111', 1426327365),
(32, 3, 3, '卧槽12311111', 1426327395),
(33, 3, 3, '卧槽12311111', 1426327410),
(34, 3, 3, '卧槽12311111', 1426327803);

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

--
-- 转存表中的数据 `ldsn_favour`
--

INSERT INTO `ldsn_favour` (`id`, `uid`, `aid`) VALUES
(1, 3, 3),
(2, 4, 3),
(4, 3, 0),
(6, 3, 4),
(19, 4, 4),
(20, 5, 4),
(26, 6, 4),
(27, 2, 4);

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

--
-- 转存表中的数据 `ldsn_user`
--

INSERT INTO `ldsn_user` (`id`, `username`, `passwd`, `email`, `qq`, `telphone`, `head_pic`, `sign_time`, `login_time`, `login_style`, `qqopenid`) VALUES
(1, 'jason', '123456', '351192873@qq.com', '351192873', 0, '', 1270, 1426312081, 'computer', '111'),
(2, 'jason', '123456', '351192873@qq.com', '351192873', 0, '', 1270, 1426312081, 'computer', '0'),
(3, 'jason', '123456', '351192873@qq.com', '351192873', 0, '', 1270, 1426312081, 'computer', '0'),
(4, 'jason', '123', '123', '123', 0, '', 1422790657, 1426312081, 'computer', '0'),
(5, '王杰', '123', '351192873@qq.com', '351192873', 0, '', 1422850517, 1425177013, 'computer', '0'),
(6, 'jang', 'weq', '王奉新', '对外界哦', 0, '', 1422850748, 1425177013, 'computer', '0'),
(8, '123', '123', 'codewangfengxin@qq.com', '1234567', 0, '', 1422965586, 1422965586, 'computer', '0'),
(9, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(10, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(11, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(12, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(13, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(14, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(15, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(16, 'wxyoo1', 'a454d57565266240e90439967c1d7e2f', '759822115@qq.com', '759822115', 15311801028, '', 0, 0, '', ''),
(17, 'wxyo1', 'd41d8cd98f00b204e9800998ecf8427e', '7@qq.com', '759822115', 15311801028, '', 0, 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
