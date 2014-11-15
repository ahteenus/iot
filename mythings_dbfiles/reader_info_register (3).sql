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
-- Database: `reader_info_register`
--
CREATE DATABASE IF NOT EXISTS `reader_info_register` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reader_info_register`;

-- --------------------------------------------------------

--
-- Table structure for table `readergroup_gps_table`
--

CREATE TABLE IF NOT EXISTS `readergroup_gps_table` (
  `index` bigint(20) NOT NULL AUTO_INCREMENT,
  `reader_group` text NOT NULL,
  `point1` text NOT NULL,
  `point2` text NOT NULL,
  `point3` text NOT NULL,
  `point4` text NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `readergroup_gps_table`
--

INSERT INTO `readergroup_gps_table` (`index`, `reader_group`, `point1`, `point2`, `point3`, `point4`) VALUES
(1, 'moratuwa', '6.777432321245485', '6.808336056221107', '79.86543703009374', '79.90897178649902'),
(2, 'piliyandala', '6.777432321245485', '6.836033523090354', '79.90897178649902', '79.93017196655273'),
(3, 'piliyandala', '5', '7', '78', '81');

-- --------------------------------------------------------

--
-- Table structure for table `reader_public`
--

CREATE TABLE IF NOT EXISTS `reader_public` (
  `reader_no` int(11) NOT NULL,
  `reader_location` text NOT NULL,
  `reader_group` varchar(20) NOT NULL,
  `reader_owner` varchar(20) NOT NULL,
  UNIQUE KEY `reader_no` (`reader_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reader_public`
--

INSERT INTO `reader_public` (`reader_no`, `reader_location`, `reader_group`, `reader_owner`) VALUES
(1, 's,6.796426453421083,79.90146528929472,0,0,0,UOM ENTC 3rd floor PG Seminar Room', 'moratuwa', 'iot'),
(2, 's,6.796756976393807,79.90128859877586,0,0,0,UOM ENTC 3rd Floor Telecom Lab', 'moratuwa', 'iot'),
(3, 's,6.796756976393807,79.90128859877586,0,0,0,Piliyandala Town\n', 'piliyandala', 'iot'),
(4, 's,6.7966,79.90129,0,0,0,Suwarapola', 'piliyandala', 'iot'),
(5, 'mycar', 'piliyandala', '94771155234'),
(6, 'mykitchen', 'piliyandala', '94771155234'),
(7, 's,6.796756976393807,79.90128859877586,0,0,0,UOM ENTC 1', 'moratuwa', '94773151569');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
