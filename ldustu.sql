-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-12-31 15:46:01
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
-- 表的结构 `ldsn_admin`
--

CREATE TABLE IF NOT EXISTS `ldsn_admin` (
`ad_id` int(11) NOT NULL,
  `ad_name` varchar(60) NOT NULL,
  `ad_pawd` varchar(60) NOT NULL,
  `ad_time` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_article`
--

CREATE TABLE IF NOT EXISTS `ldsn_article` (
`art_id` int(11) NOT NULL,
  `art_title` varchar(120) NOT NULL,
  `art_content` text NOT NULL,
  `art_time` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_des` varchar(120) NOT NULL,
  `ps2` int(11) NOT NULL,
  `ps3` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_column`
--

CREATE TABLE IF NOT EXISTS `ldsn_column` (
`clu_id` int(11) NOT NULL,
  `clu_title` varchar(120) NOT NULL,
  `clu_descript` varchar(120) NOT NULL,
  `clu_time` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ldsn_power`
--

CREATE TABLE IF NOT EXISTS `ldsn_power` (
`pw_id` int(11) NOT NULL,
  `pw_level` int(11) NOT NULL,
  `pw_userid` int(11) NOT NULL,
  `pw_ps` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ldsn_admin`
--
ALTER TABLE `ldsn_admin`
 ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `ldsn_article`
--
ALTER TABLE `ldsn_article`
 ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `ldsn_column`
--
ALTER TABLE `ldsn_column`
 ADD PRIMARY KEY (`clu_id`);

--
-- Indexes for table `ldsn_power`
--
ALTER TABLE `ldsn_power`
 ADD PRIMARY KEY (`pw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ldsn_admin`
--
ALTER TABLE `ldsn_admin`
MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ldsn_article`
--
ALTER TABLE `ldsn_article`
MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ldsn_column`
--
ALTER TABLE `ldsn_column`
MODIFY `clu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ldsn_power`
--
ALTER TABLE `ldsn_power`
MODIFY `pw_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
