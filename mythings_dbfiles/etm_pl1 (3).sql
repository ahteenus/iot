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
-- Database: `etm_pl1`
--
CREATE DATABASE IF NOT EXISTS `etm_pl1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `etm_pl1`;

-- --------------------------------------------------------

--
-- Table structure for table `hetmr`
--

CREATE TABLE IF NOT EXISTS `hetmr` (
  `epc` bigint(20) NOT NULL,
  `tag_no` bigint(20) NOT NULL,
  `tag_name` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` text NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `carcheck` tinyint(4) NOT NULL,
  `kitchen` tinyint(4) NOT NULL,
  PRIMARY KEY (`tag_no`),
  UNIQUE KEY `tag_no` (`tag_no`),
  UNIQUE KEY `epc` (`epc`),
  KEY `tag_no_2` (`tag_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hetmr`
--

INSERT INTO `hetmr` (`epc`, `tag_no`, `tag_name`, `user_id`, `type`, `priority`, `carcheck`, `kitchen`) VALUES
(40551, 94771155234001, 'reference', 94771155234, 'PHONE', 1, 1, 0),
(125699, 94771155234002, 'my shoe', 94771155234, 'RFID', 0, 0, 0),
(40552, 94771155234003, 'my wallet', 94771155234, 'RFID', 1, 1, 0),
(125700, 94771155234004, 'my bag', 94771155234, 'RFID', 0, 0, 0),
(125701, 94771155234005, 'my spectacles', 94771155234, 'RFID', 0, 0, 0),
(125702, 94771155234006, 'my laptop', 94771155234, 'RFID', 1, 1, 0),
(800, 94771155234010, 'anchor 400g', 94771155234, 'RFID', 0, 0, 1),
(804, 94771155234011, 'dummy', 94771155234, 'RFID', 0, 0, 1),
(802, 94771155234012, 'Jelly', 94771155234, 'RFID', 0, 0, 1),
(125703, 94773151569001, 'refferance', 94773151569, 'RFID', 1, 0, 0),
(125704, 94773151569002, 'my wallet', 94773151569, 'RFID', 1, 0, 0),
(125705, 94773151569003, 'my laptop', 94773151569, 'RFID', 1, 0, 0),
(125706, 94773151569004, 'my umbrella', 94773151569, 'RFID', 0, 0, 0),
(125707, 94773151569005, 'my socks', 94773151569, 'RFID', 0, 0, 0),
(125708, 94773151569006, 'my phone', 94773151569, 'SMART PHONE', 0, 0, 0),
(900, 94773151569007, 'Student1', 94773151569, 'RFID', 0, 0, 0),
(901, 94773151569008, 'Student2', 94773151569, 'RFID', 0, 0, 0),
(902, 94773151569009, 'Student3', 94773151569, 'RFID', 0, 0, 0),
(903, 94773151569010, 'Student4', 94773151569, 'RFID', 0, 0, 0),
(904, 94773151569011, 'Student5', 94773151569, 'RFID', 0, 0, 0),
(905, 94773151569012, 'Student6', 94773151569, 'RFID', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tetmr_moratuwa`
--

CREATE TABLE IF NOT EXISTS `tetmr_moratuwa` (
  `epc` bigint(20) NOT NULL,
  `tag_no` bigint(20) NOT NULL,
  `tag_name` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `counter` int(11) NOT NULL,
  `carcheck` tinyint(4) NOT NULL,
  `kitchen` tinyint(4) NOT NULL,
  UNIQUE KEY `epc` (`epc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tetmr_moratuwa`
--

INSERT INTO `tetmr_moratuwa` (`epc`, `tag_no`, `tag_name`, `user_id`, `priority`, `counter`, `carcheck`, `kitchen`) VALUES
(800, 94771155234010, 'anchor 400g', 94771155234, 0, 2, 0, 1),
(802, 94771155234012, 'Jelly', 94771155234, 0, 9, 0, 1),
(804, 94771155234011, 'dummy', 94771155234, 0, 10, 0, 1),
(900, 94773151569007, 'Student1', 94773151569, 0, 23, 0, 0),
(901, 94773151569008, 'Student2', 94773151569, 0, 16, 0, 0),
(902, 94773151569009, 'Student3', 94773151569, 0, 23, 0, 0),
(904, 94773151569011, 'Student5', 94773151569, 0, 14, 0, 0),
(905, 94773151569012, 'Student6', 94773151569, 0, 20, 0, 0),
(40551, 94771155234001, 'reference', 94771155234, 1, 85, 1, 0),
(40552, 94771155234003, 'my wallet', 94771155234, 1, 188, 1, 0),
(125702, 94771155234006, 'my laptop', 94771155234, 1, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tetmr_piliyandala`
--

CREATE TABLE IF NOT EXISTS `tetmr_piliyandala` (
  `epc` bigint(20) NOT NULL,
  `tag_no` bigint(20) NOT NULL,
  `tag_name` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `counter` int(11) NOT NULL,
  `carcheck` tinyint(4) NOT NULL,
  `kitchen` tinyint(4) NOT NULL,
  PRIMARY KEY (`tag_no`),
  UNIQUE KEY `tag_no` (`tag_no`),
  UNIQUE KEY `epc` (`epc`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tetmr_piliyandala`
--

INSERT INTO `tetmr_piliyandala` (`epc`, `tag_no`, `tag_name`, `user_id`, `priority`, `counter`, `carcheck`, `kitchen`) VALUES
(40551, 94771155234001, 'reference', 94771155234, 1, 134, 1, 0),
(40552, 94771155234003, 'my wallet', 94771155234, 1, 104, 1, 0),
(800, 94771155234010, 'anchor 400g', 94771155234, 0, 57, 0, 1),
(804, 94771155234011, 'dummy', 94771155234, 0, 146, 0, 1),
(802, 94771155234012, 'Jelly', 94771155234, 0, 130, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
