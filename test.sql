-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-11-23 06:28:58
-- 服务器版本： 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL DEFAULT '1',
  `name` varchar(20) NOT NULL,
  `content` varchar(50) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) DEFAULT NULL,
  `limit` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`id`, `status`, `name`, `content`, `start`, `end`, `limit`) VALUES
(28, 1, '项目1', '内容1', '2018-01-01', '2019-01-02', '1=>1,2=>10,3=>1,4=>10,5=>1,6=>1,9=>2,'),
(32, 1, '项目3', '内容3', '2018-01-01', '2019-01-01', '1=>2,2=>50,3=>10,4=>30,5=>50,6=>50,7=>50,8=>50,9=>200,'),
(29, 1, '项目2', '内容2', '2018-05-04', '2018-09-03', '1=>2,2=>20,3=>2,4=>20,5=>2,6=>2,9=>4,');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` int(2) NOT NULL DEFAULT '0',
  `company` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `research` varchar(50) DEFAULT '0',
  `patent` varchar(50) DEFAULT '0',
  `technology` varchar(50) DEFAULT '0',
  `undergraduate` varchar(50) DEFAULT '0',
  `master` varchar(50) DEFAULT '0',
  `doctor` varchar(50) DEFAULT '0',
  `no_degree` varchar(50) DEFAULT '0',
  `number` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `permission`, `company`, `location`, `date`, `research`, `patent`, `technology`, `undergraduate`, `master`, `doctor`, `no_degree`, `number`) VALUES
(1, '123', '123', 1, '', '', '2017-10-01', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, '111', '111', 0, '临安盛浩有限公司', '浙江省杭州市临安区', '2018-10-02', '10', '2', '10', '1', '1', '1', '1', '111'),
(6, '222', '222', 0, '重庆盛浩有限公司', '重庆市', '2018-08-08', '20', '3', '20', '2', '2', '2', '2', '222'),
(7, '333', '333', 0, '中山盛浩有限公司', '广东省中山市', '2016-10-10', '30', '3', '30', '3', '3', '3', '3', '333'),
(14, '233', '233', 0, '北京盛浩有限公司', '北京市朝阳区', '2018-10-05', '23', '23', '23', '23', '23', '23', '23', '233'),
(16, '321', '321', 0, '重庆盛浩有限公司', '重庆市', '2016-01-01', '20', '5', '20', '12', '213', '23', '213', '321'),
(17, 'aaa', 'aaa', 0, '台湾盛浩有限公司', '台湾省台北市', '2018-11-17', '555', '12', '50', '12', '32', '21', '21', '222'),
(18, 'bbb', 'bbb', 0, '台州盛浩有限公司', '浙江省台州市', '2018-11-17', '233', '23', '23', '36', '12', '25', '43', '233');

-- --------------------------------------------------------

--
-- 表的结构 `user_apply`
--

DROP TABLE IF EXISTS `user_apply`;
CREATE TABLE IF NOT EXISTS `user_apply` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `step` int(10) NOT NULL DEFAULT '-1',
  `reason` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_apply`
--

INSERT INTO `user_apply` (`id`, `user_id`, `item_id`, `step`, `reason`) VALUES
(11, 6, 28, -1, NULL),
(9, 16, 28, -1, NULL),
(10, 5, 28, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `_limit_list`
--

DROP TABLE IF EXISTS `_limit_list`;
CREATE TABLE IF NOT EXISTS `_limit_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_limit` varchar(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `_limit_list`
--

INSERT INTO `_limit_list` (`id`, `_limit`, `status`) VALUES
(1, '成立时间', 1),
(2, '研发投入', 1),
(3, '专利发明', 1),
(4, '技术比例', 1),
(5, '本科生', 1),
(6, '硕士生', 1),
(7, '博士生', 1),
(8, '本科以下', 1),
(9, '总人数', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
