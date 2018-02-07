-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-02-07 10:41:56
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
(1, 'ferre', '6226514790b1175cf90bca075f3887a6c54ef58e', 62, '1573646491@qq.com', 0, 'true', 1517381386, 1513926388),
(3, 'root', '6226514790b1175cf90bca075f3887a6c54ef58e', 12, '1573646491@qq.com', 0, 'true', 1517970064, 1514172018);

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
(94, 1, 'root', '127.0.0.1', 1516847736),
(95, 1, 'ferre', '127.0.0.1', 1517197202),
(96, 1, 'ferre', '127.0.0.1', 1517278880),
(97, 1, 'ferre', '127.0.0.1', 1517279895),
(98, 1, 'ferre', '127.0.0.1', 1517381385),
(99, 0, 'root', '127.0.0.1', 1517970059),
(100, 1, 'root', '127.0.0.1', 1517970064);

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

--
-- 转存表中的数据 `heater_article`
--

INSERT INTO `heater_article` (`id`, `author`, `title`, `cate`, `order`, `content`, `thumb`, `desc`, `keywords`, `tag`, `time`, `pic`) VALUES
(1, 'Ferre', 'Alexa', '7', 6, '<p>1</p>', '/uploads/thumb/alexa15173848344b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', '在文本框中输入文字，会自动统计字数。算字数时1个汉字（包括韩文、日文）算为2个英文字节，换行算1个英文字符。本计算字数可用于统计中文汉字、韩文、日文、法文、英语字符、阿拉伯数字、标点符号以及各种特殊符号的字符数，即时显示打字个数。你在写短信、文章、小说、论文、报告、作文时，都可以使用本计算器测字数，不用自己一个字一个字的数字数。', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517295326, '/uploads/20180131\\846769c6006037f1deffc8a408770ce5.jpg'),
(2, 'Ferre', 'Alexa2', '7', 6, '<p>2</p>', '/uploads/thumb/alexa15173848244b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517295748, '/uploads/20180131\\bda00da3f7532be6707efdb0cd3c8015.jpg'),
(3, 'Ferre', 'Alexa3', '11', 6, '<p>3</p>', '/uploads/thumb/alexa15173848164b84b15bff6ee5796152495a230e45e3d7e947d9.png', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517301107, '/uploads/20180131\\38040534ae8df2c755a69d3170c5f078.png'),
(4, 'Ferre', '这这这', '11', 6, '<p>4</p>', '/uploads/thumb/alexa15173848074b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517301127, '/uploads/20180131\\8379b99b628d8363e5622d1cbbb4f619.jpg'),
(5, 'Ferre', '文档中心', '3', 6, '<p>湘玉给你溜肥肠</p>', '/uploads/thumb/alexa15178182454b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517301441, '/uploads/20180205\\e72ebcffddfe2446dd950b571d6af820.jpg'),
(6, 'Ferre', 'Freeze', '11', 6, '<p>3</p>', '/uploads/thumb/alexa15173862534b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,可视化工具', 1517386253, '/uploads/20180131\\b81d19d0a1e2d3792859fbdf41f08e33.jpg'),
(7, 'Ferre', 'Fake', '11', 6, '<p>2</p>', '/uploads/thumb/alexa15173862754b84b15bff6ee5796152495a230e45e3d7e947d9.png', 'About Alexa', 'Alexa,Ferre', 'Charts,图形化,可视化工具', 1517386275, '/uploads/20180131\\07dc777f2b8bdc883409d71e77d5db37.png'),
(8, 'Ferre', 'this is design1', '9', 6, '<p>KuroKy，全名 Kuro &quot;KuroKy&quot; Salehi Takhasomi，拥有伊朗和德国双重国籍，KuroKy这个id是从他的真实名字演变而来KuroKy在urban英语字典里的意思是：看遍天下黄片的怪人。</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517797298, ''),
(9, 'Ferre', 'this is design2', '9', 6, '<p>码工，目前国内具有响力的电商装修服务平台，我们是电商装修工具领域的领头羊！</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517797318, ''),
(10, 'Ferre', 'this is design3', '9', 6, '<p>专注于开发简单实用的电商装修工具，致力于装修模块的不断推陈出新，降低操作使用门槛，不断拓展更广阔的电商应用平台，为广大电商设计师群体及中小卖家的店铺装修提供更多的便利。</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517797336, ''),
(11, 'Ferre', 'fea1', '8', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and&nbsp;</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517800915, ''),
(12, 'Ferre', 'fea2', '8', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and&nbsp;</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517800921, ''),
(13, 'Ferre', 'fea3', '8', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and&nbsp;</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517800929, ''),
(14, 'Ferre', 'fea4', '8', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and&nbsp;</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517800938, ''),
(15, 'Ferre', 'fea5', '8', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and&nbsp;</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517800951, ''),
(16, 'Ferre', 'fea6', '8', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and&nbsp;</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517800961, ''),
(17, 'Ferre', 'clients1', '10', 6, '<p>今天早上，成都高新区天府新谷有人跳楼。我只想说快过年了，你都不能让家人安心过年，一点都不负责任啊，现在法治社会，要学会遇事靠法，拿起法律武器解决问题<br/></p>', '/uploads/thumb/alexa15178116744b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517811674, '/uploads/20180205\\8ea26b767d4a735a9fa5e89561651462.jpg'),
(18, 'Ferre', 'clients2', '10', 6, '<p>今天早上，成都高新区天府新谷有人跳楼。我只想说快过年了，你都不能让家人安心过年，一点都不负责任啊，现在法治社会，要学会遇事靠法，拿起法律武器解决问题</p>', '/uploads/thumb/alexa15178116844b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517811684, '/uploads/20180205\\131c7968a30eea015ffa59ddd0264e16.jpg'),
(19, 'Ferre', 'clients3', '10', 6, '<p>今天早上，成都高新区天府新谷有人跳楼。我只想说快过年了，你都不能让家人安心过年，一点都不负责任啊，现在法治社会，要学会遇事靠法，拿起法律武器解决问题</p>', '/uploads/thumb/alexa15178116954b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517811695, '/uploads/20180205\\4e6f6915f6a5428c1ef8b19675cc5514.jpg'),
(20, 'Ferre', 'clients4', '10', 6, '<p>今天早上，成都高新区天府新谷有人跳楼。我只想说快过年了，你都不能让家人安心过年，一点都不负责任啊，现在法治社会，要学会遇事靠法，拿起法律武器解决问题</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517811704, ''),
(21, 'Ferre', 'clients5', '10', 6, '<p>今天早上，成都高新区天府新谷有人跳楼。我只想说快过年了，你都不能让家人安心过年，一点都不负责任啊，现在法治社会，要学会遇事靠法，拿起法律武器解决问题</p>', '/uploads/thumb/alexa15178117154b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517811715, '/uploads/20180205\\9a3f90d01e15f08593a9c28a6e235465.jpg'),
(22, 'Ferre', 'clients6', '10', 6, '<p>It is a long established fact that a reader will be distracted by the readable contentof a page when looking at its layout.</p>', '/uploads/thumb/alexa15178117254b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517811725, '/uploads/20180205\\26f0debd1faec2379182efb22687eb19.jpg'),
(23, 'Ferre', 'Blog1', '3', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and</p>', '/uploads/thumb/alexa15178175514b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', '图形化,可视化工具', 1517817551, '/uploads/20180205\\9479d58e6801f9cb6552980198470514.jpg'),
(24, 'Ferre', 'Blog2', '2', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and</p>', '/uploads/thumb/alexa15178175654b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517817565, '/uploads/20180205\\91662d8efefbdaf673a0932fcc30c3bb.jpg'),
(25, 'Ferre', 'Blog3', '3', 6, '<p>Instantly translate your text from one language to another with Bing Translator. Powered by Microsoft Translator, the site provides free translation to and</p>', '/uploads/thumb/alexa15178175794b84b15bff6ee5796152495a230e45e3d7e947d9.jpg', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517817579, '/uploads/20180205\\82b97aece68c93d5d4f54a8d060c03c7.jpg'),
(26, 'Ferre', 'contact', '5', 6, '<p>asd</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517905589, ''),
(27, 'Ferre', '服务内容', '6', 5, '<p>dsa</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517905601, ''),
(28, 'Ferre', '​2018-02-07', '12', 6, '<p>基本完成除三方登录和产品外的所有功能</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517985167, ''),
(29, 'Ferre', '2018-01-17', '12', 4, '<p>开始Heater的需求分析</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517985363, ''),
(30, 'Ferre', '2018-01-10', '12', 2, '<p>分析Heater面临的问题</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517985414, ''),
(31, 'Ferre', '2018-01-15', '12', 3, '<p>业余时间对Heater编码</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517985476, ''),
(32, 'Ferre', '2017-12-20', '12', 1, '<p>对Heater项目的定义和规划</p>', '', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517985547, ''),
(33, 'Ferre', 'Freke', '7', 12, '<style>.upload{\r\n    padding: 4px 10px;\r\n    height: 20px;\r\n    line-height: 20px;\r\n    position: relative;\r\n    border: 1px solid #999;\r\n    text-decoration: none;\r\n    color: #fff;\r\n	background: #996de9;\r\n	border-radius: 5px;\r\n}\r\n.change{\r\n    position: absolute;\r\n    overflow: hidden;\r\n    right: 0;\r\n    top: 0;\r\n    opacity: 0;\r\n}\r\n.upload:hover{background: #fff;color: #996de9;border-color: #996de9;}</style><form action=\"\" method=\"post\" enctype=\"multipart/form-data\"><a href=\"javascript:;\" class=\"upload\">选择文件<input class=\"change button\" type=\"file\" name=\"heater\"/></a><br/><button type=\"submit\" class=\"btn btn-theme\" style=\"margin-top: 20px;margin-bottom: 50px;\"><em class=\"fa fa-fw fa-paper-plane-o\"></em>解析文件</button></form>', '/uploads/thumb/alexa15179915914b84b15bff6ee5796152495a230e45e3d7e947d9.png', 'About Alexa', 'Alexa,Ferre', 'Alexa,Charts,图形化,可视化工具', 1517991546, '/uploads/20180207\\0d33ac343eb0f8e82bf2f6e2e5469288.png');

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

--
-- 转存表中的数据 `heater_banner`
--

INSERT INTO `heater_banner` (`id`, `title`, `desc`, `thumb`, `link`, `sort`, `time`) VALUES
(1, 'Yii帮助Web开发人员建立复杂的应用程序，可以减少开发时间。', 'Yii是一个免费的，开源的，基于PHP5的Web应用程序开发框架，代码简洁，DRY设计并且鼓励快速开发。它的工作可以简化您的应用程序开发，并有助于确保一个非常高效的，可扩展和可维护的终端产品。', '/banner/20180129\\0ed41257c73cc8c847144acadc80d91b.jpg', 'http://www.baidu.com', 1, 1517197326),
(2, 'You have successfully created your Yii-powered application.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ', '/banner/20180129\\2a48ebccea3604cc595f71ddfb34924a.jpg', 'http://fheater.com/admin/index/index.html', 2, 1517198289);

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
(7, '柱状图', 0, 2),
(8, 'FEATURES', 0, 4),
(9, 'DESIGN', 0, 4),
(10, 'CLIENTS', 0, 4),
(11, '折线图', 0, 2),
(12, '进程', 12, 4);

-- --------------------------------------------------------

--
-- 表的结构 `heater_feedback`
--

CREATE TABLE `heater_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `heater_feedback`
--

INSERT INTO `heater_feedback` (`id`, `name`, `email`, `message`, `ip`, `time`) VALUES
(1, '123', '1573646491@qq.com', '', '', 0),
(2, '123', '1573646491@qq.com', '', '', 0),
(3, 'dsa', '18408229270@163.com', '', '', 0),
(4, 'dsa', '1573646491@qq.com', '', '', 0),
(5, 'sad', '1573646491@qq.com', '', '127.0.0.1', 1517815125),
(6, 'asd', '1573646491@qq.com', 'ad', '127.0.0.1', 1517815521),
(7, 'das', '110@qq.com', '你好', '127.0.0.1', 1517815615),
(8, 'dsa', '18408229270@163.com', 'sda', '127.0.0.1', 1517815869),
(9, 'fdas', '18408229270@163.com', '1', '127.0.0.1', 1517815908),
(10, 'da', '18408229270@163.com', '1', '127.0.0.1', 1517815943),
(11, '213', '1573646491@qq.com', '123', '127.0.0.1', 1517815961),
(12, '1', '2@qq.com', '213', '127.0.0.1', 1517817477),
(13, 'sad', '18408229270@163.com', '213', '127.0.0.1', 1517821521),
(14, 'sad', '1573646491@qq.com', '打', '127.0.0.1', 1517990535);

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

--
-- 转存表中的数据 `heater_link`
--

INSERT INTO `heater_link` (`id`, `name`, `url`, `sort`) VALUES
(1, 'Alexa', 'http://alexa.ferre.top/', '3'),
(2, 'Alexa-Admin', 'http://admin.ferre.top/admin', '2'),
(3, '百度', 'https://www.baidu.com', '6'),
(4, '谷歌', 'https://www.google.com.hk/', '8');

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
(1, 0, 'Alexa-Heater', 'Heater,基于ECharts的图表制作,Excel图表生成,折线图生成,柱状图', 'Heater是一个基于Echarts的图表制作网站', 'Alexa,Charts,图形化,可视化工具', 1, 0, '蜀ICP备17036283号-2', 0);

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
-- Indexes for table `heater_feedback`
--
ALTER TABLE `heater_feedback`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `heater_alog`
--
ALTER TABLE `heater_alog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- 使用表AUTO_INCREMENT `heater_article`
--
ALTER TABLE `heater_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- 使用表AUTO_INCREMENT `heater_artsee`
--
ALTER TABLE `heater_artsee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `heater_banner`
--
ALTER TABLE `heater_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `heater_category`
--
ALTER TABLE `heater_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `heater_feedback`
--
ALTER TABLE `heater_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `heater_link`
--
ALTER TABLE `heater_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
