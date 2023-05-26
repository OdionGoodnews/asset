-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 14, 2021 at 02:23 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpeasset`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_brand` varchar(255) NOT NULL,
  `item_catergory` varchar(255) NOT NULL,
  `item_location` varchar(255) NOT NULL,
  `item_amount` varchar(255) NOT NULL,
  `warranty` varchar(255) NOT NULL,
  `item_date` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `item_img` varchar(240) NOT NULL,
  `enrol_user` varchar(240) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_info`
--

DROP TABLE IF EXISTS `staff_info`;
CREATE TABLE IF NOT EXISTS `staff_info` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT 'waiting...',
  `gender` varchar(255) NOT NULL DEFAULT 'none',
  `profile` varchar(255) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_info`
--

INSERT INTO `staff_info` (`id`, `email`, `password`, `firstname`, `lastname`, `confirmpassword`, `telephone`, `gender`, `profile`) VALUES
(2, 'odionosaze564@gmail.com', 'odion', 'Odion', 'Goodnews', 'odion', '09098983443', 'Female', '781225.jpg'),
(3, 'osaze@gmail.com', 'odionosaze', 'o', 'o', 'odionosaze', '', '', ''),
(4, 'kk@gmail.com', 'odion', 'dk', 'k', 'odion', '', '', ''),
(5, 'ood@gmail.com', 'odion', 'jjdjju', 'j', 'odion', '', '', ''),
(6, 'okkjdj@gmail.com', 'odion', 'ofood', 'kdk', 'odion', '', '', ''),
(7, 'okksjdy@gmail.com', 'odion', 'odoffji', 'iey', 'odion', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
