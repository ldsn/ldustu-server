-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-02-17 18:01:40
-- 服务器版本： 5.5.37-log
-- PHP Version: 5.3.28

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
`aid` int(11) NOT NULL,
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
  `from` text NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ldsn_article`
--

INSERT INTO `ldsn_article` (`aid`, `uid`, `cid`, `cnum`, `favour`, `visit`, `ismake`, `title`, `description`, `image`, `time`, `from`) VALUES
(5, 5, 1, 0, 1, 0, 1, '测试题目1', '测试描述1', 'www.ldustu.com', 1, ''),
(3, 1, 1, 0, 0, 0, 1, '测试题目2', '测试描述2', 'www.ldustu.com', 2, ''),
(6, 3, 1, 0, 0, 0, 0, '测试题目123', '测试秒速', 'www.ldustu.com', 1424100849, 'somewhere');

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_article_detial`
--

CREATE TABLE IF NOT EXISTS `ldsn_article_detial` (
`de_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ldsn_article_detial`
--

INSERT INTO `ldsn_article_detial` (`de_id`, `art_id`, `content`) VALUES
(2, 3, '简单的内容'),
(3, 4, '内容'),
(4, 6, '测试内容');

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_column`
--

CREATE TABLE IF NOT EXISTS `ldsn_column` (
`colu_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `time` varchar(60) NOT NULL,
  `ps` varchar(120) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ldsn_column`
--

INSERT INTO `ldsn_column` (`colu_id`, `name`, `time`, `ps`) VALUES
(1, '一号栏目', '271893981', '这是第一个测试栏目的相关描述'),
(2, '二号栏目', '2198378192', '这是第二个栏目的相关描述');

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_comment`
--

CREATE TABLE IF NOT EXISTS `ldsn_comment` (
`com_id` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ldsn_comment`
--

INSERT INTO `ldsn_comment` (`com_id`, `aid`, `uid`, `content`, `time`) VALUES
(3, 3, 3, '', 1423114120),
(5, 4, 3, '213789217938点击打我ijo', 1423115365),
(6, 3, 4, '什么鬼', 1424068874),
(7, 3, 4, '什么鬼', 1424068953);

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_favour`
--

CREATE TABLE IF NOT EXISTS `ldsn_favour` (
`fa_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ldsn_favour`
--

INSERT INTO `ldsn_favour` (`fa_id`, `uid`, `aid`) VALUES
(1, 3, 3),
(2, 4, 3);

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_user`
--

CREATE TABLE IF NOT EXISTS `ldsn_user` (
`uid` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `passwd` char(32) NOT NULL,
  `email` varchar(120) NOT NULL,
  `qq` varchar(60) NOT NULL,
  `sign_time` int(11) NOT NULL,
  `login_time` int(11) NOT NULL,
  `login_style` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `ldsn_user`
--

INSERT INTO `ldsn_user` (`uid`, `username`, `passwd`, `email`, `qq`, `sign_time`, `login_time`, `login_style`) VALUES
(1, 'jason', '123456', '351192873@qq.com', '351192873', 1270, 1422968320, 'computer'),
(2, 'jason', '123456', '351192873@qq.com', '351192873', 1270, 1422968320, 'computer'),
(3, 'jason', '123456', '351192873@qq.com', '351192873', 1270, 1422968320, 'computer'),
(4, 'jason', '123', '123', '123', 1422790657, 1422968320, 'computer'),
(5, '王杰', '123', '351192873@qq.com', '351192873', 1422850517, 1422850517, 'computer'),
(6, 'jang', 'weq', '王奉新', '对外界哦', 1422850748, 1422850748, 'computer'),
(8, '123', '123', 'codewangfengxin@qq.com', '1234567', 1422965586, 1422965586, 'computer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ldsn_article`
--
ALTER TABLE `ldsn_article`
 ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `ldsn_article_detial`
--
ALTER TABLE `ldsn_article_detial`
 ADD PRIMARY KEY (`de_id`);

--
-- Indexes for table `ldsn_column`
--
ALTER TABLE `ldsn_column`
 ADD PRIMARY KEY (`colu_id`);

--
-- Indexes for table `ldsn_comment`
--
ALTER TABLE `ldsn_comment`
 ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `ldsn_favour`
--
ALTER TABLE `ldsn_favour`
 ADD PRIMARY KEY (`fa_id`);

--
-- Indexes for table `ldsn_user`
--
ALTER TABLE `ldsn_user`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ldsn_article`
--
ALTER TABLE `ldsn_article`
MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ldsn_article_detial`
--
ALTER TABLE `ldsn_article_detial`
MODIFY `de_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ldsn_column`
--
ALTER TABLE `ldsn_column`
MODIFY `colu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ldsn_comment`
--
ALTER TABLE `ldsn_comment`
MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ldsn_favour`
--
ALTER TABLE `ldsn_favour`
MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ldsn_user`
--
ALTER TABLE `ldsn_user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
