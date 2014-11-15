-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2014 at 10:31 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `user_info`
--
CREATE DATABASE IF NOT EXISTS `user_info` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `user_info`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `index` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `phone` text NOT NULL,
  `encrypted_phone` text NOT NULL,
  `phone type` text NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`index`, `username`, `name`, `email`, `password`, `user_id`, `phone`, `encrypted_phone`, `phone type`, `salt`) VALUES
(0, '090222m', 'Asitha', 'asithagihan03@gmail.com', '32838ee60a5c1d11c18abf054dd37deb1819b9efb43adf91ffd91110f1939cf9ca83a4a7a8ea9305d6bfcac9e7fd9350af45db887f0736e85e9625dfa1b22614', 94771155234, 'tel:AZ110wuH3dKJk9Xj4AQxf9bfBsrfdizP2x0sQ', '94771155234', '', '15990076844a8af8c9be6bca7747953772b6a8efb56b8ba65a828cda53803a54846da905425fc011151c073132533a252e61c9c0ab5ea930c2f2ae0ae9fa2932'),
(1, '090188l', 'Bilesh', 'hpatalee@gmail.com', '32838ee60a5c1d11c18abf054dd37deb1819b9efb43adf91ffd91110f1939cf9ca83a4a7a8ea9305d6bfcac9e7fd9350af45db887f0736e85e9625dfa1b22614', 94773151569, 'tel:AZ110wuH3dKJk9Xj4AQxf9bfBsrfdizP2x0sQ', '94773151569', '', '15990076844a8af8c9be6bca7747953772b6a8efb56b8ba65a828cda53803a54846da905425fc011151c073132533a252e61c9c0ab5ea930c2f2ae0ae9fa2932'),
(2, '090087c', 'Bilesh', 'hpatalee@gmail.com', '090087c', 94773151569, '94771155234', '94773151569', '', '15990076844a8af8c9be6bca7747953772b6a8efb56b8ba65a828cda53803a54846da905425fc011151c073132533a252e61c9c0ab5ea930c2f2ae0ae9fa2932'),
(3, '090088b', 'Bilesh', 'hpatalee@gmail.com', '090088b', 94773151569, '94771155234', '94773151569', '', '15990076844a8af8c9be6bca7747953772b6a8efb56b8ba65a828cda53803a54846da905425fc011151c073132533a252e61c9c0ab5ea930c2f2ae0ae9fa2932'),
(4, '090089a', 'Bilesh', 'hpatalee@gmail.com', '090089a', 94773151569, '94771155234', '94773151569', '', '15990076844a8af8c9be6bca7747953772b6a8efb56b8ba65a828cda53803a54846da905425fc011151c073132533a252e61c9c0ab5ea930c2f2ae0ae9fa2932');

-- --------------------------------------------------------

--
-- Table structure for table `user_attempts`
--

CREATE TABLE IF NOT EXISTS `user_attempts` (
  `index` int(11) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `time` varchar(30) NOT NULL,
  KEY `index` (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_places`
--

CREATE TABLE IF NOT EXISTS `user_places` (
  `index` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `place` text NOT NULL,
  `count` int(11) NOT NULL,
  UNIQUE KEY `index` (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `user_places`
--

INSERT INTO `user_places` (`index`, `user_id`, `place`, `count`) VALUES
(37, 94771155234, 'moratuwa', 3),
(38, 94771155234, 'piliyandala', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_priority_places`
--

CREATE TABLE IF NOT EXISTS `user_priority_places` (
  `user_id` bigint(20) NOT NULL,
  `place_1` text NOT NULL,
  `place_2` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_priority_places`
--

INSERT INTO `user_priority_places` (`user_id`, `place_1`, `place_2`) VALUES
(94771155234, 'moratuwa', 'piliyandala'),
(94773151569, 'moratuwa', 'piliyandala');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
