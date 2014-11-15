-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2014 at 10:30 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `notification`
--
CREATE DATABASE IF NOT EXISTS `notification` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `notification`;

-- --------------------------------------------------------

--
-- Table structure for table `car_taglist`
--

CREATE TABLE IF NOT EXISTS `car_taglist` (
  `user_id` bigint(20) NOT NULL,
  `tag_no` bigint(32) NOT NULL,
  `tag_name` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `notify` bigint(20) NOT NULL,
  UNIQUE KEY `epc` (`tag_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_taglist`
--

INSERT INTO `car_taglist` (`user_id`, `tag_no`, `tag_name`, `status`, `notify`) VALUES
(94771155234, 94771155234001, 'reference', 1, -1),
(94771155234, 94771155234003, 'my wallet', 1, -1),
(94771155234, 94771155234006, 'my laptop', 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_taglist`
--

CREATE TABLE IF NOT EXISTS `kitchen_taglist` (
  `user_id` bigint(20) NOT NULL,
  `tag_no` bigint(20) NOT NULL,
  `tag_name` text NOT NULL,
  `status` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  UNIQUE KEY `tag_no` (`tag_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitchen_taglist`
--

INSERT INTO `kitchen_taglist` (`user_id`, `tag_no`, `tag_name`, `status`, `counter`, `time`) VALUES
(94771155234, 94771155234010, 'anchor', 0, 0, 1394115591),
(94771155234, 94771155234011, 'dummy', 0, 0, 1394115593),
(94771155234, 94771155234012, 'Jelly', 0, 0, 1394115151);

-- --------------------------------------------------------

--
-- Table structure for table `priority_taglist`
--

CREATE TABLE IF NOT EXISTS `priority_taglist` (
  `user_id` bigint(20) NOT NULL,
  `tag_no` bigint(20) NOT NULL,
  `tag_name` text NOT NULL,
  `latest_location` text NOT NULL,
  `notify` tinyint(4) NOT NULL,
  `antitheft` tinyint(4) NOT NULL,
  `counter` bigint(20) NOT NULL,
  `autho` text NOT NULL,
  `timetostop` bigint(20) NOT NULL,
  PRIMARY KEY (`tag_no`),
  UNIQUE KEY `tag_no` (`tag_no`),
  KEY `tag_no_2` (`tag_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority_taglist`
--

INSERT INTO `priority_taglist` (`user_id`, `tag_no`, `tag_name`, `latest_location`, `notify`, `antitheft`, `counter`, `autho`, `timetostop`) VALUES
(94771155234, 94771155234001, 'reference', 's,6.796426453421083,79.90146528929472,0,0,0,UOM ENTC 3rd floor PG Seminar Room', 0, 1, 3162, 'YES', 0),
(94771155234, 94771155234003, 'my wallet', 's,6.796756976393807,79.90128859877586,0,0,0,UOM ENTC 3rd Floor Telecom Lab', 0, 0, 2429, 'YES', 0),
(94771155234, 94771155234006, 'my laptop', 's,6.796426453421083,79.90146528929472,0,0,0,UOM ENTC 3rd floor PG Seminar Room', 0, 0, 91, 'YES', 0),
(94773151569, 94773151569001, 'reference', 's,6.796426453421083,79.90146528929472,0,0,0,UOM ENTC 3rd floor PG Seminar Room', 0, 1, 2, 'YES', 0),
(94773151569, 94773151569002, 'my wallet', 's,6.796426453421083,79.90146528929472,0,0,0,UOM ENTC 3rd floor PG Seminar Room', 0, 0, 173, 'YES', 0),
(94773151569, 94773151569003, 'my laptop', 's,6.796426453421083,79.90146528929472,0,0,0,UOM ENTC 3rd floor PG Seminar Room', 0, 0, 29, 'YES', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
