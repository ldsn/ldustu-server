-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-02-10 16:11:16
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
`art_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `clu_id` int(11) NOT NULL,
  `vit_num` int(11) NOT NULL DEFAULT '0',
  `ismake` smallint(6) NOT NULL DEFAULT '0',
  `art_title` varchar(120) NOT NULL,
  `art_des` text NOT NULL,
  `art_time` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ldsn_article`
--

INSERT INTO `ldsn_article` (`art_id`, `user_id`, `clu_id`, `vit_num`, `ismake`, `art_title`, `art_des`, `art_time`) VALUES
(4, 1, 2, 0, 1, '', '', 1),
(3, 1, 1, 0, 1, '', '', 2);

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_article_detial`
--

CREATE TABLE IF NOT EXISTS `ldsn_article_detial` (
`de_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `source` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ldsn_article_detial`
--

INSERT INTO `ldsn_article_detial` (`de_id`, `art_id`, `content`, `source`) VALUES
(2, 3, '简单的内容', '这是一个测试'),
(3, 4, '内容', '来源');

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_column`
--

CREATE TABLE IF NOT EXISTS `ldsn_column` (
`colu_id` int(11) NOT NULL,
  `colu_name` varchar(60) NOT NULL,
  `colu_create_time` varchar(60) NOT NULL,
  `colu_ps` varchar(120) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ldsn_column`
--

INSERT INTO `ldsn_column` (`colu_id`, `colu_name`, `colu_create_time`, `colu_ps`) VALUES
(1, '一号栏目', '271893981', '这是第一个测试栏目的相关描述'),
(2, '二号栏目', '2198378192', '这是第二个栏目的相关描述');

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_comment`
--

CREATE TABLE IF NOT EXISTS `ldsn_comment` (
`com_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `beuser_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `coment_content` text NOT NULL,
  `com_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ldsn_comment`
--

INSERT INTO `ldsn_comment` (`com_id`, `user_id`, `beuser_id`, `art_id`, `coment_content`, `com_time`) VALUES
(2, 0, 0, 4, '', 0),
(3, 3, 4, 4, '', 1423114120),
(4, 3, 4, 4, '213789217938点击打我ijo', 1423114135),
(5, 3, 0, 4, '213789217938点击打我ijo', 1423115365);

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_favour`
--

CREATE TABLE IF NOT EXISTS `ldsn_favour` (
`fa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_power`
--

CREATE TABLE IF NOT EXISTS `ldsn_power` (
`pw_id` int(11) NOT NULL,
  `pw_level` int(11) NOT NULL,
  `pw_name` varchar(60) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ldsn_power`
--

INSERT INTO `ldsn_power` (`pw_id`, `pw_level`, `pw_name`) VALUES
(1, 1, '超级管理员'),
(2, 2, '频道管理员'),
(3, 3, '信息审核员'),
(4, 4, '信息发布员');

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_user`
--

CREATE TABLE IF NOT EXISTS `ldsn_user` (
`user_id` int(11) NOT NULL,
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

INSERT INTO `ldsn_user` (`user_id`, `username`, `passwd`, `email`, `qq`, `sign_time`, `login_time`, `login_style`) VALUES
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
 ADD PRIMARY KEY (`art_id`);

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
-- Indexes for table `ldsn_power`
--
ALTER TABLE `ldsn_power`
 ADD PRIMARY KEY (`pw_id`);

--
-- Indexes for table `ldsn_user`
--
ALTER TABLE `ldsn_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ldsn_article`
--
ALTER TABLE `ldsn_article`
MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ldsn_article_detial`
--
ALTER TABLE `ldsn_article_detial`
MODIFY `de_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ldsn_column`
--
ALTER TABLE `ldsn_column`
MODIFY `colu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ldsn_comment`
--
ALTER TABLE `ldsn_comment`
MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ldsn_favour`
--
ALTER TABLE `ldsn_favour`
MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ldsn_power`
--
ALTER TABLE `ldsn_power`
MODIFY `pw_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ldsn_user`
--
ALTER TABLE `ldsn_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
