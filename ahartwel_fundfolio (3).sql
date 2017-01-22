-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2017 at 10:27 AM
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
  `u_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaignid`, `campaignname`, `tag_line`, `description`, `campaignimage`, `campaignvidio`, `amount`, `days`, `total_backers`, `isfunded`, `categoryid`, `company_location`, `quote_input`, `link`, `latitude`, `longitude`, `loginid`, `c_date`, `u_date`) VALUES
(1, 'test', '', 'test dec dddkkd  ', 'website_wireframe.png', '', 1000, 20, 25, 0, 5, '', '', '', NULL, NULL, 1, '2016-12-27 15:44:26', '0000-00-00 00:00:00'),
(2, 'test 2', '', 'test dec 2', 'website_wireframe.png', '', 500, 15, 20, 0, 2, '', '', '', NULL, NULL, 2, '2016-12-29 19:42:35', '0000-00-00 00:00:00'),
(3, 'test 3', '', 'test test 3', 'website_wireframe.png', '', 1500, 25, 10, 0, 5, '', '', '', NULL, NULL, 3, '2016-12-29 19:42:35', '0000-00-00 00:00:00'),
(4, 'test 4', '', 'test dec 4', 'website_wireframe.png', '', 3000, 40, 100, 0, 3, '', '', '', NULL, NULL, 4, '2016-12-29 20:00:39', '0000-00-00 00:00:00'),
(5, 'test 5', '', 'test dec 5', 'website_wireframe.png', '', 2000, 35, 100, 0, 3, '', '', '', NULL, NULL, 5, '2016-12-29 20:00:39', '0000-00-00 00:00:00'),
(9, 'yf creative1', 'tag line1', 'dec 1', '', '', 200, 20, 100, 0, 1, 'mandiid1', 'ddddd quote', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-11 20:26:42', '2017-01-11 16:26:42'),
(8, 'yf creative', 'ddd', 'dec', '', '', 111, 20, 100, 0, 1, 'lahore', 'qdddd', 'ddddd', '0', '0', 5, '2017-01-11 20:23:36', '2017-01-11 16:23:36'),
(10, 'yf creativew', 'tag linee', 'ddddd dddd ddd', '_DSC7293_1.jpg', '', 444, 20, 100, 0, 4, 'mandiid', 'quotedd', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-11 20:30:47', '2017-01-11 16:30:47'),
(11, 'ddd', 'ddd', 'ssss', '_MG_2022e.jpg', '', 5, 20, 100, 0, 1, 'mandiid', 'sss', '', '0', '0', 5, '2017-01-11 21:33:43', '2017-01-11 17:33:43'),
(12, 'ddd', 'ddd', '', '_MG_3805-1.jpg', '', 50, 20, 100, 0, 1, '', '', '', '0', '0', 5, '2017-01-11 21:44:50', '2017-01-11 17:44:50'),
(13, 'yf creative', 'tag line', '', '', '', 50, 20, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-11 21:49:04', '2017-01-11 17:49:04'),
(14, 'ddd', 'dd', '', '', '', 50, 20, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-11 21:49:58', '2017-01-11 17:49:58'),
(15, 'sss', 'ddd', '', '', '', 10, 20, 100, 0, 1, '', '', '', '0', '0', 5, '2017-01-11 21:51:49', '2017-01-11 17:51:49'),
(16, 'sdddd', 'dddd', '', '', '', 70, 20, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-11 21:53:45', '2017-01-11 17:53:45'),
(17, 'dddd', 'dddd', 'ddddddd', '240606_4743096811863_821680589_o.jpg', '', 500, 20, 100, 0, 1, 'location', 'dddd', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-12 17:39:00', '2017-01-12 13:39:00'),
(18, 'sss', 'sss', 'sssdc', '1483645350.PNG', '', 54, 0, 100, 0, 1, 'London, United Kingdom', 'ddddd', 'http://localhost/yfcreative/Fundfolio/HTML/', '0', '0', 5, '2017-01-21 12:43:12', '2017-01-21 08:43:12'),
(19, 'sss', 'ss', '', '', '', 0, 0, 100, 0, 3, '', '', '', '0', '0', 5, '2017-01-21 19:42:17', '2017-01-21 15:42:17'),
(20, 'ddd', 'ssss', '', '', '', 0, 0, 100, 0, 7, '', '', '', '0', '0', 5, '2017-01-21 20:04:37', '2017-01-21 16:04:37'),
(21, 'skkksks kskkkkskkks ksskksksddjjj jj jj j jhhhhddd', 'jjdjdjjdjdldld dldkkdkdkdk jjdjjjdjjjjjjjjdjn d d dd d  d d d d d', 'gjhhhhh hhhhhh', '240606_4743096811863_821680589_o.jpg', '', 54, 0, 100, 0, 1, 'London, United Kingdom', 'hhjjjj hhh', '', '0', '0', 5, '2017-01-21 21:06:07', '2017-01-21 17:06:07'),
(22, 'dddd', 'dddd', '', 'baadshahi-mosque.png', '', 56, 0, 100, 0, 1, 'Istanbul, Ä°stanbul, Turkey', 'sssd\r\nd\r\ndd\r\n', 'ddddd', '0', '0', 5, '2017-01-22 08:50:12', '2017-01-22 04:50:12');

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
  `c_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `email`, `name`, `password`, `profilepic`, `socialid`, `location`, `location_latitude`, `location_longitude`, `interested_category`, `c_date`) VALUES
(1, 'admin@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '', '', '', NULL, NULL, '', '2017-01-02 20:59:42'),
(2, '', 'Rana Shahid Bashir', '', '1380054458692109', '1380054458692109', '', NULL, NULL, '', '2017-01-04 21:29:27'),
(3, 'admin1@gmail.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', '1483647229.jpg', '', '', NULL, NULL, '', '2017-01-21 12:34:14'),
(4, 'test@gmail.com', 'shahid bashir', '827ccb0eea8a706c4c34a16891f84e7b', 'baadshahi-mosque.png', '', 'Lahore, Punjab, Pakistan', NULL, NULL, '', '2017-01-21 18:22:43'),
(5, 'tes1t@gmail.com', 'dddd', '827ccb0eea8a706c4c34a16891f84e7b', '13 - 1.jpg', '', 'London, United Kingdom', NULL, NULL, '', '2017-01-21 20:50:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`campaignid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

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
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `campaignid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
