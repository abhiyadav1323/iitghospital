-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2016 at 12:25 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iitghospital`
--
CREATE DATABASE IF NOT EXISTS `iitghospital` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iitghospital`;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `mid` int(100) NOT NULL AUTO_INCREMENT,
  `mname` varchar(100) NOT NULL,
  `mquantity` int(100) NOT NULL,
  `mexpiry` date NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`mid`, `mname`, `mquantity`, `mexpiry`) VALUES
(1, 'Levodopa', 387, '2016-04-04'),
(3, 'Paracetamol', 22, '2016-04-30'),
(4, 'Tylenol', 456, '2016-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `username`, `password`, `dob`, `phone`, `gender`, `email`, `file`) VALUES
(21, 'Jayesh Mathur', 'jayesh', '363b122c528f54df4a0446b6bab05515', '2016-04-22', '8989898989', 'male', 'j@g.com', '/var/www/html/patients/jayesh/profile.jpg'),
(26, 'Abhishek Yadav', 'abhishek.cse', '0cc175b9c0f1b6a831c399e269772661', '2016-04-22', '7576918001', 'male', 'abhishek.cse@iitg.ernet.in', '/var/www/html/patients/abhishek.cse/profile.jpg'),
(27, 'Ankit', 'ankit', '0cc175b9c0f1b6a831c399e269772661', '2016-04-22', '8769472875', 'male', 'ankit@iitg.ernet.in', '/var/www/html/patients/ankit/profile.jpg'),
(28, 'gaurav', 'gaurav', 'b2f5ff47436671b6e533d8dc3614845d', '2016-04-28', '8769472875', 'male', 'g@g.com', '/var/www/html/patients/gaurav/profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pharma_queue`
--

CREATE TABLE IF NOT EXISTS `pharma_queue` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` varchar(100) NOT NULL,
  `reciept` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `dob`, `gender`, `post`, `username`, `password`, `email`) VALUES
(14, 'Abhishek Yadav', '2016-02-06', 'male', 'doctor', 'abhishek.cse', '0cc175b9c0f1b6a831c399e269772661', 'abhishek.cse@iitg.ernet.in'),
(15, 'Arpan', '2016-02-20', 'male', 'pharmacist', 'arpan', '0cc175b9c0f1b6a831c399e269772661', 'arpan.indora@iitg.ernet.in'),
(16, 'Vistaar', '2016-02-10', 'male', 'receptionist', 'vistaar', '9e3669d19b675bd57058fd4664205d2a', 'vistaar@iitg.ernet.in'),
(19, 'Ankit', '04/23/2016', 'male', 'office', 'ankit', '0cc175b9c0f1b6a831c399e269772661', 'a@g.com'),
(22, 'new admin3', '15/12/1996', 'male', 'doctor', 'new.admin3', '0ebdcceea9225f7ce5d59d66339350fb', 'new.admin2@a.net.in');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
