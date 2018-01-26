-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-26 09:35:16
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heater`
--

-- --------------------------------------------------------

--
-- 表的结构 `heater_admin`
--

CREATE TABLE `heater_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `count` int(11) DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `role` tinyint(1) DEFAULT '1' COMMENT '0为超级管理员,1为管理员',
  `switch` varchar(5) DEFAULT 'true' COMMENT 'true为开启,false为关闭',
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `heater_admin`
--

INSERT INTO `heater_admin` (`id`, `username`, `password`, `count`, `email`, `role`, `switch`, `update_time`, `create_time`) VALUES
(1, 'ferre', '6226514790b1175cf90bca075f3887a6c54ef58e', 58, '1573646491@qq.com', 0, 'true', 1516777041, 1513926388),
(3, 'root', '6226514790b1175cf90bca075f3887a6c54ef58e', 11, '1573646491@qq.com', 0, 'true', 1516847736, 1514172018);

-- --------------------------------------------------------

--
-- 表的结构 `heater_alog`
--

CREATE TABLE `heater_alog` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `heater_alog`
--

INSERT INTO `heater_alog` (`id`, `type`, `name`, `ip`, `time`) VALUES
(1, 1, 'ferre', '127.0.0.1', 1512548564),
(2, 1, '127.0.0.1', '127.0.0.1', 1512548920),
(3, 1, 'ferre', '127.0.0.1', 1512548928),
(4, 1, 'ferre', '127.0.0.1', 1512549457),
(5, 0, '127.0.0.1', '127.0.0.1', 1512549461),
(6, 1, 'ferre', '127.0.0.1', 1512549466),
(7, 0, '弗雷尔', '127.0.0.1', 1512549887),
(8, 1, 'ferre', '127.0.0.1', 1512549892),
(9, 1, 'ferre', '127.0.0.1', 1512612399),
(10, 1, 'ferre', '127.0.0.1', 1512700862),
(11, 1, 'ferre', '127.0.0.1', 1512976444),
(12, 1, 'ferre', '127.0.0.1', 1513130910),
(13, 0, 'ferre', '127.0.0.1', 1513931337),
(14, 0, 'ferre', '127.0.0.1', 1513931370),
(15, 1, 'ferre', '127.0.0.1', 1513931422),
(16, 0, '123', '127.0.0.1', 1513931565),
(17, 0, '123', '127.0.0.1', 1513931567),
(18, 0, '123', '127.0.0.1', 1513932261),
(19, 0, '213', '127.0.0.1', 1513932353),
(20, 1, 'ferre', '127.0.0.1', 1513932358),
(21, 1, 'ferre', '127.0.0.1', 1513932466),
(22, 1, 'ferre', '127.0.0.1', 1513932485),
(23, 1, 'ferre', '127.0.0.1', 1513932494),
(24, 1, 'ferre', '127.0.0.1', 1513932539),
(25, 1, 'ferre', '127.0.0.1', 1513932589),
(26, 1, 'ferre', '127.0.0.1', 1513932718),
(27, 1, 'ferre', '127.0.0.1', 1513933220),
(28, 1, 'ferre', '127.0.0.1', 1513933311),
(29, 1, 'ferre', '127.0.0.1', 1513933432),
(30, 0, 'root', '127.0.0.1', 1513936006),
(31, 0, 'root', '127.0.0.1', 1513936078),
(32, 1, 'ferre', '127.0.0.1', 1513936085),
(33, 0, 'root', '127.0.0.1', 1513936110),
(34, 1, 'root', '127.0.0.1', 1514166200),
(35, 1, 'root', '127.0.0.1', 1514166204),
(36, 1, 'ferre', '127.0.0.1', 1514167965),
(37, 1, 'root', '127.0.0.1', 1514167973),
(38, 1, 'root', '127.0.0.1', 1514167980),
(39, 1, 'root', '127.0.0.1', 1514169474),
(40, 1, 'root', '127.0.0.1', 1514169490),
(41, 1, 'root', '127.0.0.1', 1514172027),
(42, 1, 'root', '127.0.0.1', 1514190751),
(43, 1, 'root', '127.0.0.1', 1514192690),
(44, 1, 'ferre', '127.0.0.1', 1514193952),
(45, 1, 'root', '127.0.0.1', 1514194000),
(46, 1, 'ferre', '127.0.0.1', 1514273313),
(47, 1, 'root', '127.0.0.1', 1514273505),
(48, 1, 'ferre', '127.0.0.1', 1514519440),
(49, 1, 'ferre', '127.0.0.1', 1514945977),
(50, 1, 'ferre', '127.0.0.1', 1514965498),
(51, 1, 'ferre', '127.0.0.1', 1514965611),
(52, 1, 'ferre', '127.0.0.1', 1514965630),
(53, 1, 'ferre', '127.0.0.1', 1514965673),
(54, 1, 'ferre', '127.0.0.1', 1514965724),
(55, 1, 'root', '127.0.0.1', 1514965948),
(56, 1, 'ferre', '127.0.0.1', 1514966218),
(57, 1, 'alexa', '127.0.0.1', 1514966529),
(58, 1, 'ferre', '127.0.0.1', 1514966627),
(59, 0, 'alexa', '127.0.0.1', 1514966943),
(60, 1, 'ferre', '127.0.0.1', 1514966949),
(61, 1, 'ferre', '127.0.0.1', 1514967411),
(62, 1, 'ferre', '127.0.0.1', 1514969132),
(63, 1, 'alexa', '127.0.0.1', 1514969159),
(64, 1, 'ferre', '127.0.0.1', 1514969244),
(65, 1, 'alexa', '127.0.0.1', 1514969257),
(66, 1, 'ferre', '127.0.0.1', 1515033598),
(67, 1, 'ferre', '127.0.0.1', 1515050225),
(68, 0, 'alexa1', '123', 1514966943),
(69, 1, 'ferre', '123', 1514966627),
(71, 0, 'alexa', '123', 1514793094),
(72, 1, 'freeze', '321', 1514793094),
(73, 0, 'hate', '213', 1514793094),
(74, 0, 'as', '1', 1514793094),
(75, 1, 'ferre', '127.0.0.1', 1515119061),
(76, 1, 'ferre', '127.0.0.1', 1515402042),
(77, 1, 'ferre', '127.0.0.1', 1515479746),
(78, 1, 'root', '127.0.0.1', 1515479865),
(79, 1, 'ferre', '127.0.0.1', 1515480169),
(80, 1, 'ferre', '127.0.0.1', 1515484508),
(81, 1, 'ferre', '127.0.0.1', 1515492059),
(82, 1, 'ferre', '127.0.0.1', 1515553231),
(83, 1, 'ferre', '127.0.0.1', 1515636357),
(84, 0, 'ferre超级管理员', '127.0.0.1', 1515643296),
(85, 1, 'ferre', '127.0.0.1', 1515643304),
(86, 1, 'ferre', '127.0.0.1', 1515750624),
(87, 0, 'root', '127.0.0.1', 1516634526),
(88, 0, 'root', '127.0.0.1', 1516634621),
(89, 1, 'root', '127.0.0.1', 1516634631),
(90, 1, 'root', '127.0.0.1', 1516634718),
(91, 1, 'ferre', '127.0.0.1', 1516691151),
(92, 1, 'ferre', '127.0.0.1', 1516762717),
(93, 1, 'ferre', '127.0.0.1', 1516777040),
(94, 1, 'root', '127.0.0.1', 1516847736);

-- --------------------------------------------------------

--
-- 表的结构 `heater_article`
--

CREATE TABLE `heater_article` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL DEFAULT 'Ferre',
  `title` text NOT NULL,
  `cate` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT '6',
  `content` text NOT NULL,
  `thumb` text NOT NULL,
  `desc` text NOT NULL,
  `keywords` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `heater_artsee`
--

CREATE TABLE `heater_artsee` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `rid` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `heater_banner`
--

CREATE TABLE `heater_banner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `thumb` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `heater_category`
--

CREATE TABLE `heater_category` (
  `id` int(11) NOT NULL,
  `catename` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `heater_category`
--

INSERT INTO `heater_category` (`id`, `catename`, `sort`, `pid`) VALUES
(1, 'HOME', 1, 0),
(2, '解决方案', 2, 0),
(3, '文档中心', 3, 0),
(4, 'ABOUT', 4, 0),
(5, 'CONTACT', 5, 0),
(6, '服务内容', 6, 0),
(7, '柱状图', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `heater_link`
--

CREATE TABLE `heater_link` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `sort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `heater_system`
--

CREATE TABLE `heater_system` (
  `id` int(11) NOT NULL,
  `is_close` tinyint(4) NOT NULL,
  `title` text NOT NULL,
  `keywords` text NOT NULL,
  `desc` text NOT NULL,
  `tag` text NOT NULL,
  `is_mail` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0为本地存储；1为七牛云；2为阿里云OSS',
  `record` varchar(50) NOT NULL DEFAULT '',
  `is_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `heater_system`
--

INSERT INTO `heater_system` (`id`, `is_close`, `title`, `keywords`, `desc`, `tag`, `is_mail`, `type`, `record`, `is_update`) VALUES
(1, 0, 'Alexa 1', '萨法1', 'About Alexa', 'Alexa,Charts,图形化,可视化工具', 1, 1, '蜀ICP备17036283号-2', 0);

-- --------------------------------------------------------

--
-- 表的结构 `heater_tourist`
--

CREATE TABLE `heater_tourist` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `heater_admin`
--
ALTER TABLE `heater_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_alog`
--
ALTER TABLE `heater_alog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_article`
--
ALTER TABLE `heater_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_artsee`
--
ALTER TABLE `heater_artsee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_banner`
--
ALTER TABLE `heater_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_category`
--
ALTER TABLE `heater_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_link`
--
ALTER TABLE `heater_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_system`
--
ALTER TABLE `heater_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heater_tourist`
--
ALTER TABLE `heater_tourist`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `heater_admin`
--
ALTER TABLE `heater_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `heater_alog`
--
ALTER TABLE `heater_alog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- 使用表AUTO_INCREMENT `heater_article`
--
ALTER TABLE `heater_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `heater_artsee`
--
ALTER TABLE `heater_artsee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `heater_banner`
--
ALTER TABLE `heater_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `heater_category`
--
ALTER TABLE `heater_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `heater_link`
--
ALTER TABLE `heater_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `heater_system`
--
ALTER TABLE `heater_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `heater_tourist`
--
ALTER TABLE `heater_tourist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
