-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2014 at 10:29 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendance`
--
CREATE DATABASE IF NOT EXISTS `attendance` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `attendance`;

-- --------------------------------------------------------

--
-- Table structure for table `lectures_info`
--

CREATE TABLE IF NOT EXISTS `lectures_info` (
  `lecturer` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `lecture_hall` text NOT NULL,
  `day_of_week` varchar(20) NOT NULL,
  `time_from` bigint(32) NOT NULL,
  `time_to` bigint(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture_hall_map`
--

CREATE TABLE IF NOT EXISTS `lecture_hall_map` (
  `user_id` bigint(20) NOT NULL,
  `lecture_hall` varchar(20) NOT NULL,
  `reader_no` bigint(20) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture_hall_map`
--

INSERT INTO `lecture_hall_map` (`user_id`, `lecture_hall`, `reader_no`) VALUES
(94773151569, 'entc1', 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
