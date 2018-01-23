-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-23 16:59:19
-- 服务器版本： 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

--
-- 转存表中的数据 `heater_banner`
--

INSERT INTO `heater_banner` (`id`, `title`, `desc`, `thumb`, `link`, `sort`, `time`) VALUES
(12, '1', '2', '/banner/20180123\\b2e9cb9a09bb0ffd90bd26ea7ae47a8d.jpg', 'http://fheater.com/admin/index/index.html', 1, 1516722652),
(15, '3', '3', '/banner/20180123\\fda7f2929951bca9e2343938daf5142b.jpg', 'http://fheater.com/admin/index/index.html', 3, 1516723109);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `heater_banner`
--
ALTER TABLE `heater_banner`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `heater_banner`
--
ALTER TABLE `heater_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
