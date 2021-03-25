-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 23, 2020 at 05:39 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earlybird`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(5) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(16) NOT NULL,
  `contact_num` varchar(14) DEFAULT NULL,
  `email_address` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `full_name`, `username`, `password`, `contact_num`, `email_address`) VALUES
(1, 'Super Admin', 'superadmin', 'superuser', '0123456789', 'superadmin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `airport_manager`
--

DROP TABLE IF EXISTS `airport_manager`;
CREATE TABLE IF NOT EXISTS `airport_manager` (
  `amid` int(5) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(16) NOT NULL,
  `contact_num` varchar(14) DEFAULT NULL,
  `email_address` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`amid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airport_manager`
--

INSERT INTO `airport_manager` (`amid`, `full_name`, `username`, `password`, `contact_num`, `email_address`) VALUES
(6, 'Sample Manager', 'samplemanager', 'samplemanager', '0123456789', 'samplemanager@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `bid` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `tid` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `contact_number` varchar(14) NOT NULL,
  `email_address` varchar(24) NOT NULL,
  `fairline` varchar(32) NOT NULL,
  `fprice` decimal(10,2) NOT NULL,
  `ftax` decimal(10,2) NOT NULL,
  `fsurcharge` decimal(10,2) NOT NULL,
  `ftotal` decimal(10,2) NOT NULL,
  `ftotalrnd` decimal(10,2) NOT NULL,
  `fcallsign` varchar(10) NOT NULL,
  `fmodel` varchar(10) NOT NULL,
  `fclass` varchar(16) NOT NULL,
  `fdepartcty` varchar(64) NOT NULL,
  `farrcty` varchar(64) NOT NULL,
  `fdepartair` varchar(64) NOT NULL,
  `farrair` varchar(64) NOT NULL,
  `fdepartdate` date NOT NULL,
  `farrdate` date NOT NULL,
  `fdeparttime` time NOT NULL,
  `farrtime` time NOT NULL,
  `feta` time NOT NULL,
  `fdctycode` varchar(5) NOT NULL,
  `factycode` varchar(5) NOT NULL,
  `fm_name` varchar(40) NOT NULL,
  `l_name` varchar(40) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nationality` varchar(64) NOT NULL,
  `countryoforigin` varchar(64) NOT NULL,
  `pass_no` varchar(16) NOT NULL,
  `pass_exp` date NOT NULL,
  `booktime` time NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
CREATE TABLE IF NOT EXISTS `flight` (
  `fid` int(5) NOT NULL AUTO_INCREMENT,
  `fairline` varchar(32) NOT NULL,
  `fprice` decimal(10,2) NOT NULL,
  `fcallsign` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `fmodel` varchar(10) NOT NULL,
  `fclass` varchar(16) NOT NULL,
  `fdepartcty` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `farrcty` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `fdepartair` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `farrair` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `fdepartdate` date NOT NULL,
  `farrdate` date NOT NULL,
  `fdeparttime` time NOT NULL,
  `farrtime` time NOT NULL,
  `feta` time NOT NULL,
  `fdctycode` varchar(5) NOT NULL,
  `factycode` varchar(5) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(16) NOT NULL,
  `contact_num` varchar(14) DEFAULT NULL,
  `email_address` varchar(24) DEFAULT NULL,
  `img_dir` varchar(255) CHARACTER SET utf8mb4 DEFAULT '../../assets/img/test-images/default.png',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `first_name`, `last_name`, `username`, `password`, `contact_num`, `email_address`, `img_dir`) VALUES
(16, 'Sample', 'User', 'sampleuser', 'sampleuser', NULL, NULL, '../../assets/img/test-images/default.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
