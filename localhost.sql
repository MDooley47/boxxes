-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2014 at 03:27 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Boxes`
--
CREATE DATABASE `Boxes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Boxes`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID of the user',
  `UserName` varchar(25) NOT NULL COMMENT 'username',
  `password` varchar(30) NOT NULL,
  `salt` varchar(200) NOT NULL COMMENT 'password salt',
  `email` varchar(200) NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `password`, `salt`, `email`, `added`) VALUES
(1, 'MDooley', '12345Password12345', '12345', 'MDooley47@gmail.com', '2014-03-25 21:01:27');
