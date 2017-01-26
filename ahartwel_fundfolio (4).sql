-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2017 at 11:11 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahartwel_fundfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `campaignid` int(10) NOT NULL,
  `campaignname` varchar(50) NOT NULL,
  `tag_line` varchar(500) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `campaignimage` varchar(500) DEFAULT NULL,
  `campaignvidio` varchar(500) NOT NULL,
  `amount` int(10) NOT NULL,
  `days` int(10) NOT NULL,
  `total_backers` int(10) NOT NULL,
  `isfunded` tinyint(1) NOT NULL,
  `categoryid` int(11) NOT NULL COMMENT 'multiple category id''s',
  `company_location` varchar(500) NOT NULL,
  `quote_input` text NOT NULL,
  `link` varchar(500) NOT NULL,
  `latitude` decimal(50,0) DEFAULT NULL,
  `longitude` decimal(50,0) DEFAULT NULL,
  `loginid` int(10) NOT NULL,
  `c_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `monthly_charity` tinyint(1) NOT NULL,
  `staff_picks` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaignid`, `campaignname`, `tag_line`, `description`, `campaignimage`, `campaignvidio`, `amount`, `days`, `total_backers`, `isfunded`, `categoryid`, `company_location`, `quote_input`, `link`, `latitude`, `longitude`, `loginid`, `c_date`, `u_date`, `monthly_charity`, `staff_picks`) VALUES
(1, 'test', '', 'test dec dddkkd  ', 'website_wireframe.png', '', 1000, 20, 25, 0, 5, '', '', '', NULL, NULL, 1, '2016-12-27 15:44:26', '0000-00-00 00:00:00', 0, 0),
(2, 'test 2', '', 'test dec 2', 'website_wireframe.png', '', 500, 15, 20, 0, 2, '', '', '', NULL, NULL, 2, '2016-12-29 19:42:35', '0000-00-00 00:00:00', 0, 0),
(3, 'test 3', '', 'test test 3', 'website_wireframe.png', '', 1500, 25, 10, 0, 5, '', '', '', NULL, NULL, 3, '2016-12-29 19:42:35', '0000-00-00 00:00:00', 0, 0),
(4, 'test 4', '', 'test dec 4', 'website_wireframe.png', '', 3000, 40, 100, 0, 3, '', '', '', NULL, NULL, 4, '2016-12-29 20:00:39', '0000-00-00 00:00:00', 0, 0),
(5, 'test 5', '', 'test dec 5', 'website_wireframe.png', '', 2000, 35, 100, 0, 3, '', '', '', NULL, NULL, 5, '2016-12-29 20:00:39', '0000-00-00 00:00:00', 0, 0),
(9, 'yf creative1', 'tag line1', 'dec 1', '', '', 200, 20, 100, 0, 1, 'mandiid1', 'ddddd quote', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-11 20:26:42', '2017-01-11 16:26:42', 0, 0),
(8, 'yf creative', 'ddd', 'dec', '', '', 111, 20, 100, 0, 1, 'lahore', 'qdddd', 'ddddd', '0', '0', 5, '2017-01-11 20:23:36', '2017-01-11 16:23:36', 0, 0),
(10, 'yf creativew', 'tag linee', 'ddddd dddd ddd', '_DSC7293_1.jpg', '', 444, 20, 100, 0, 4, 'mandiid', 'quotedd', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-11 20:30:47', '2017-01-11 16:30:47', 0, 0),
(11, 'ddd', 'ddd', 'ssss', '_MG_2022e.jpg', '', 5, 20, 100, 0, 1, 'mandiid', 'sss', '', '0', '0', 5, '2017-01-11 21:33:43', '2017-01-11 17:33:43', 0, 0),
(12, 'ddd', 'ddd', '', '_MG_3805-1.jpg', '', 50, 20, 100, 0, 1, '', '', '', '0', '0', 5, '2017-01-11 21:44:50', '2017-01-11 17:44:50', 0, 0),
(13, 'yf creative', 'tag line', '', '', '', 50, 20, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-11 21:49:04', '2017-01-11 17:49:04', 0, 0),
(14, 'ddd', 'dd', '', '', '', 50, 20, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-11 21:49:58', '2017-01-11 17:49:58', 0, 0),
(15, 'sss', 'ddd', '', '', '', 10, 20, 100, 0, 1, '', '', '', '0', '0', 5, '2017-01-11 21:51:49', '2017-01-11 17:51:49', 1, 0),
(16, 'sdddd', 'dddd', '', '', '', 70, 20, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-11 21:53:45', '2017-01-11 17:53:45', 0, 0),
(17, 'dddd', 'dddd', 'ddddddd', '240606_4743096811863_821680589_o.jpg', '', 500, 20, 100, 0, 1, 'location', 'dddd', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-12 17:39:00', '2017-01-12 13:39:00', 0, 0),
(18, 'sss', 'sss', 'sssdc', '1483645350.PNG', '', 54, 0, 100, 0, 1, 'London, United Kingdom', 'ddddd', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-21 12:43:12', '2017-01-21 08:43:12', 0, 0),
(19, 'sss', 'ss', '', '', '', 0, 0, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-21 19:42:17', '2017-01-21 15:42:17', 0, 0),
(20, 'ddd', 'ssss', '', '', '', 0, 0, 100, 0, 7, '', '', '', '0', '0', 5, '2017-01-21 20:04:37', '2017-01-21 16:04:37', 0, 0),
(21, 'skkksks kskkkkskkks ksskksksddjjj jj jj j jhhhhddd', 'jjdjdjjdjdldld dldkkdkdkdk jjdjjjdjjjjjjjjdjn d d dd d  d d d d d', 'gjhhhhh hhhhhh', '240606_4743096811863_821680589_o.jpg', '', 54, 0, 100, 0, 1, 'London, United Kingdom', 'hhjjjj hhh', '', '0', '0', 5, '2017-01-21 21:06:07', '2017-01-21 17:06:07', 0, 0),
(22, 'dddd', 'dddd', '', 'baadshahi-mosque.png', '', 56, 0, 100, 0, 1, 'Istanbul, Ä°stanbul, Turkey', 'sssd\r\nd\r\ndd\r\n', 'ddddd', '0', '0', 5, '2017-01-22 08:50:12', '2017-01-22 04:50:12', 0, 0),
(23, 'ssss', 'ddddd', 'ssss\r\nffffffff\r\nf\r\nf\r\nf\r\nf\r\nf', 'vlcsnap-2016-07-12-00h12m26s979.png', '', 456, 0, 100, 0, 3, 'Los Angeles, CA, United States', 'ssss\r\nd\r\nd\r\nd\r\nd\r\n', 'ssss', '0', '0', 5, '2017-01-22 09:54:01', '2017-01-22 05:54:01', 0, 0),
(24, 'test4', 'its work fine', 'tkkdkkd dec\r\nskkskks\r\ndkkdkdkdkdk\r\n jdjdjjdjd', '1c5673338c9cb545b6f3128b8054f684.jpg', '', 500, 0, 100, 0, 4, 'Islamabad, Islamabad Capital Territory, Pakistan', 'skskksksks', 'http://dev.mysql.com/doc/refman/5.7/en/sorting-rows.html', '0', '0', 0, '2017-01-22 10:59:56', '2017-01-22 06:59:56', 0, 0),
(25, 'ssss', 'ddd', 'ssss', '1c5673338c9cb545b6f3128b8054f684.jpg', '', 23, 15, 100, 0, 1, 'Texas, United States', 'sss\r\ns\r\ns\r\ns\r\ns', 'https://drive.google.com/drive/folders/0ByiLvaOcPItpNHFhZ1d6b3ZSblU', '0', '0', 9, '2017-01-22 12:12:35', '2017-01-22 08:12:35', 0, 0),
(26, 'test img name', 'what a name', 'sjdjjd\r\nd\r\nf\r\nf\r\nf\r\nd\r\nd\r\n\r\ndd\r\n\r\nf\r\nf\r\nf\r\nd\r\nd\r\nd\r\nf\r\nf', 'img_1485290047.JPG', '', 100, 15, 100, 0, 1, 'Lahore, Punjab, Pakistan', 'dddd\r\ns\r\nd\r\n\r\nds\r\n\r\nd\r\ns\r\nd\r\nsd\r\n\r\nd\r\ndf\r\nfd\r\nd\r\nd\r\n\r\ndf', 'http://localhost/yfcreative/fundfolio-git-new/Fundfolio1/HTML/', '0', '0', 15, '2017-01-24 20:34:07', '2017-01-24 16:34:07', 0, 0),
(27, 'dddd', 'ssss', '', '', '', 345, 15, 100, 0, 1, '', '', '', '0', '0', 15, '2017-01-24 20:54:06', '2017-01-24 16:54:06', 0, 1),
(28, 'ddff', 'ssdfff', 'ssdff \r\n ididiidd djdjdjjdd dddd', 'img_1485291361.JPG', 'vid_1485291361.mp4', 234, 19, 100, 0, 1, 'Lahore, Punjab, Pakistan', 'jkskks\r\n\r\nfd\r\n\r\nds\r\nf\r\n', 'http://localhost/yfcreative/fundfolio-git-new/Fundfolio1/HTML/', '0', '0', 15, '2017-01-24 20:56:00', '2017-01-24 16:56:00', 0, 0),
(29, 'sdfsfd', 'sddddf', '', '', '', 223, 11, 100, 0, 1, 'Las Vegas, NV, United States', '', '', '0', '0', 15, '2017-01-24 21:03:18', '2017-01-24 17:03:18', 0, 0),
(30, '', '', '', '', '', 0, 0, 100, 0, 0, '', '', '', '0', '0', 15, '2017-01-24 21:05:01', '2017-01-24 17:05:01', 0, 1),
(31, 'ddds', 'ffffd', '', 'img_1485292004.jpg', '', 344, 10, 100, 0, 1, '', 'ssdffff', '', '0', '0', 15, '2017-01-24 21:06:44', '2017-01-24 17:06:44', 0, 0),
(32, 'sss', 'sss', '', 'img_1485292085.jpg', '', 0, 1, 100, 0, 3, '', '', '', '0', '0', 15, '2017-01-24 21:08:04', '2017-01-24 17:08:04', 0, 0),
(33, 'dssdf', 'fdsfd', '', 'img_1485292158.jpg', '', 333, 7, 100, 0, 2, '', '', '', '0', '0', 15, '2017-01-24 21:09:18', '2017-01-24 17:09:18', 1, 0),
(34, 'sdddf', 'sdfffff', 'sffddff', 'img_1485292267.jpg', 'vid_1485292267.mp4', 422, 12, 100, 0, 1, 'Tennessee, United States', 'ffdsfdfff', 'sffff ddd', '0', '0', 15, '2017-01-24 21:11:06', '2017-01-24 17:11:06', 1, 0),
(35, 'sffdd', 'fsddff', 'sddsf\r\nf\r\ns\r\n\r\ndf\r\n', 'img_1485292438.jpg', 'vid_1485292438.mp4', 54, 20, 100, 0, 1, 'Istanbul, Ä°stanbul, Turkey', 'fgdgggg fffggdfgg ', 'test .com', '0', '0', 15, '2017-01-24 21:13:58', '2017-01-24 17:13:58', 1, 1),
(36, 'ddddss', 'ddssddsd', 'sssd\r\nd\r\nd\r\ns\r\ndd', 'img_1485368708.jpg', 'vid_1485368708.mp4', 333, 22, 100, 0, 1, 'LA, United States', 'sssddssdd\r\nd\r\nd\r\n\r\nd', 'ssddffdssdf', '0', '0', 12, '2017-01-25 18:25:08', '2017-01-25 14:25:08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `campaign_fund`
--

CREATE TABLE `campaign_fund` (
  `id` bigint(11) NOT NULL,
  `campaignid` int(11) NOT NULL,
  `matrix` text CHARACTER SET utf8 NOT NULL COMMENT 'json values',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign_fund`
--

INSERT INTO `campaign_fund` (`id`, `campaignid`, `matrix`, `created_on`, `updated_on`) VALUES
(1, 26, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":""}', '2017-01-25 01:34:07', '2017-01-25 01:34:07'),
(2, 27, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":"","21":"","22":"","23":"","24":"","25":""}', '2017-01-25 01:54:06', '2017-01-25 01:54:06'),
(3, 28, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":"","21":""}', '2017-01-25 01:56:00', '2017-01-25 01:56:00'),
(4, 29, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":""}', '2017-01-25 02:03:18', '2017-01-25 02:03:18'),
(5, 30, '[]', '2017-01-25 02:05:01', '2017-01-25 02:05:01'),
(6, 31, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":"","21":"","22":"","23":"","24":"","25":""}', '2017-01-25 02:06:44', '2017-01-25 02:06:44'),
(7, 32, '[]', '2017-01-25 02:08:04', '2017-01-25 02:08:04'),
(8, 33, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":"","21":"","22":"","23":"","24":""}', '2017-01-25 02:09:18', '2017-01-25 02:09:18'),
(9, 34, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":"","21":"","22":"","23":"","24":"","25":"","26":"","27":"","28":""}', '2017-01-25 02:11:06', '2017-01-25 02:11:06'),
(10, 35, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":""}', '2017-01-25 02:13:58', '2017-01-25 02:13:58'),
(11, 36, '{"1":"","2":"","3":"","4":"","5":"","6":"","7":"","8":"","9":"","10":"","11":"","12":"","13":"","14":"","15":"","16":"","17":"","18":"","19":"","20":"","21":"","22":"","23":"","24":""}', '2017-01-25 23:25:08', '2017-01-25 23:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(3) NOT NULL,
  `categorytype` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categorytype`) VALUES
(1, 'Business'),
(2, 'Travel'),
(3, 'Sports'),
(4, 'Health'),
(5, 'Philanthropy'),
(6, 'Arts'),
(7, 'Journalism'),
(8, 'Pets & Animals'),
(9, 'Education');

-- --------------------------------------------------------

--
-- Table structure for table `fundfolio_payments`
--

CREATE TABLE `fundfolio_payments` (
  `id` int(6) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `itemid` varchar(25) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdtime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `giftid` int(10) NOT NULL,
  `campaignid` int(10) NOT NULL,
  `loginid` int(10) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`giftid`, `campaignid`, `loginid`, `amount`) VALUES
(1, 1, 2, 100),
(2, 2, 2, 50),
(3, 1, 3, 100),
(4, 2, 3, 100),
(5, 1, 4, 100),
(6, 2, 4, 200);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginid` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `socialid` varchar(500) NOT NULL COMMENT 'For facebook or google plus authentication id',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(6) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `itemid` varchar(25) NOT NULL,
  `userid` int(11) NOT NULL,
  `createdtime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `popularity`
--

CREATE TABLE `popularity` (
  `campaignid` int(10) NOT NULL,
  `viewcount` int(10) DEFAULT NULL,
  `totaluserdonatedcount` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `profilepic` varchar(500) DEFAULT NULL COMMENT 'path of image',
  `socialid` varchar(100) NOT NULL,
  `location` varchar(500) NOT NULL,
  `location_latitude` decimal(50,0) DEFAULT NULL,
  `location_longitude` decimal(50,0) DEFAULT NULL,
  `interested_category` varchar(100) NOT NULL COMMENT 'have multiple category id''s like "1$2$3$" which indicates i am interested in category id 1, 2, 3',
  `community_points` int(11) NOT NULL,
  `c_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `email`, `name`, `password`, `profilepic`, `socialid`, `location`, `location_latitude`, `location_longitude`, `interested_category`, `community_points`, `c_date`) VALUES
(1, 'admin@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '', '', '', NULL, NULL, '', 0, '2017-01-02 20:59:42'),
(2, '', 'Rana Shahid Bashir', '', '1380054458692109', '1380054458692109', '', NULL, NULL, '', 0, '2017-01-04 21:29:27'),
(3, 'admin1@gmail.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', '1483647229.jpg', '', '', NULL, NULL, '', 0, '2017-01-21 12:34:14'),
(4, 'test@gmail.com', 'shahid bashir', '827ccb0eea8a706c4c34a16891f84e7b', 'baadshahi-mosque.png', '', 'Lahore, Punjab, Pakistan', NULL, NULL, '', 0, '2017-01-21 18:22:43'),
(5, 'tes1t@gmail.com', 'dddd', '827ccb0eea8a706c4c34a16891f84e7b', '13 - 1.jpg', '', 'London, United Kingdom', NULL, NULL, '', 0, '2017-01-21 20:50:46'),
(6, 'test2@gmail.com', 'abc', 'e10adc3949ba59abbe56e057f20f883e', 'baadshahi-mosque.png', '', 'Los Angeles, CA, United States', NULL, NULL, '', 0, '2017-01-22 09:51:49'),
(7, 'test3@gmail.com', 'test 3', 'e10adc3949ba59abbe56e057f20f883e', 'baadshahi-mosque.png', '', 'LA, United States', NULL, NULL, '', 0, '2017-01-22 10:22:21'),
(8, 'test4@gmail.com', 'test4', '827ccb0eea8a706c4c34a16891f84e7b', 'baadshahi-mosque.png', '', 'Lahore, Punjab, Pakistan', NULL, NULL, '', 0, '2017-01-22 10:56:53'),
(9, 'test5@gmail.com', 'ddddd', '827ccb0eea8a706c4c34a16891f84e7b', '20121025_5331-2.jpg', '', 'London, United Kingdom', NULL, NULL, '', 0, '2017-01-22 11:10:17'),
(10, 'test6@gmail.com', 'shahid bashir', '827ccb0eea8a706c4c34a16891f84e7b', '6027_1085579694806255_257908367928930892_n.jpg', '', 'Lahore, Punjab, Pakistan', NULL, NULL, '', 0, '2017-01-23 19:36:35'),
(11, 'test8@gmail.com', 'rana gi', '827ccb0eea8a706c4c34a16891f84e7b', '6027_1085579694806255_257908367928930892_n.jpg', '', 'LA, United States', NULL, NULL, '', 0, '2017-01-23 20:20:43'),
(12, 'test10@gmail.com', 'kkdkkdk', '827ccb0eea8a706c4c34a16891f84e7b', 'baadshahi-mosque.png', '', 'London, United Kingdom', NULL, NULL, '', 0, '2017-01-23 21:27:38'),
(13, 'testgmail.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', NULL, NULL, '', 0, '2017-01-24 20:03:35'),
(14, 'test11@gmail.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', NULL, NULL, '', 0, '2017-01-24 20:08:38'),
(15, 'test12@gmail.com', 'test img', '827ccb0eea8a706c4c34a16891f84e7b', 'img_1485289800.png', '', 'Lahore, Punjab, Pakistan', NULL, NULL, '', 0, '2017-01-24 20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_campaign_rel`
--

CREATE TABLE `user_campaign_rel` (
  `id` bigint(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `campaignid` int(11) NOT NULL,
  `has_liked` tinyint(1) NOT NULL,
  `facebook_shared` varchar(1500) NOT NULL,
  `twitter_shared` varchar(1500) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_campaign_rel`
--

INSERT INTO `user_campaign_rel` (`id`, `userid`, `campaignid`, `has_liked`, `facebook_shared`, `twitter_shared`, `created_on`, `updated_on`) VALUES
(1, 5, 25, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 6, 25, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`campaignid`);

--
-- Indexes for table `campaign_fund`
--
ALTER TABLE `campaign_fund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `fundfolio_payments`
--
ALTER TABLE `fundfolio_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`giftid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_campaign_rel`
--
ALTER TABLE `user_campaign_rel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `campaignid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `campaign_fund`
--
ALTER TABLE `campaign_fund`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `fundfolio_payments`
--
ALTER TABLE `fundfolio_payments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `giftid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `loginid` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user_campaign_rel`
--
ALTER TABLE `user_campaign_rel`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
