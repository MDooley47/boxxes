-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2014 at 01:20 PM
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
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'post ID',
  `IDofPoster` bigint(20) NOT NULL COMMENT 'who Posted it',
  `likes` bigint(20) NOT NULL COMMENT 'likes it has',
  `likers` longtext NOT NULL,
  `flags` int(11) DEFAULT NULL,
  `commentCount` mediumint(9) DEFAULT NULL COMMENT 'how many comments there are',
  `comments` longtext COMMENT 'split at '', ''',
  `commenters` longtext COMMENT 'array corr with comments',
  `post` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `IDofPoster`, `likes`, `likers`, `flags`, `commentCount`, `comments`, `commenters`, `post`, `date`) VALUES
(1, 1, 3, '0,3,1', 0, 0, '', '', 'Hello World! This is the first post in Boxes! Although this post is manually written yours doesn''t have to be! This is really really fun! I lost the game... I can see this turning into either a success or a failure, or maybe a bit of both lol! Lets simulate a enter sign.\r\n\r\nhaha, I am going to have to find a more "airy" font to use inside of the posts. And a better more "boxy" font for the rest of the time!!! This is almost running out the box! (which is the goal) haha. Just one more line :D so close!!! :DDDD I am going to have to ad emjocon soonish aswell!', '2014-04-14 18:23:54'),
(2, 1, 4757, '0,3,1', 0, 0, NULL, NULL, 'Hello World!!', '2014-04-14 19:57:48'),
(3, 1, 4772, '0,1', 0, 0, NULL, NULL, 'This is awesome!!!', '2014-04-20 22:24:13'),
(4, 1, 48, '0,1', 0, 0, NULL, NULL, 'House App Challenge, I am almost ready!!!', '2014-04-21 11:55:06'),
(5, 1, 73, '0,1', 0, 0, NULL, NULL, 'DMC: Almost ready!!!', '2014-04-21 11:55:47'),
(6, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:30:56'),
(7, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:31:46'),
(8, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:32:31'),
(9, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:42:49'),
(10, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:43:28'),
(11, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:43:31'),
(12, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:43:40'),
(13, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:44:11'),
(14, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 19:44:29'),
(15, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 20:00:17'),
(16, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 20:01:48'),
(17, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 20:09:06'),
(18, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 20:09:36'),
(19, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 20:11:42'),
(20, 1, 0, '0', 0, 0, '', '', '', '2014-04-28 20:18:25'),
(21, 1, 0, '0', 0, 0, '', '', 'Hello World!!!', '2014-04-28 20:19:09'),
(22, 1, 0, '0', 0, 0, '', '', 'Hello World!!!', '2014-04-28 20:20:49'),
(23, 1, 0, '0', 0, 0, '', '', 'Hello World!!!', '2014-04-28 20:21:03'),
(24, 1, 0, '0', 0, 0, '', '', 'Hello World!!!', '2014-04-28 20:21:58'),
(25, 1, 0, '0', 0, 0, '', '', 'Testing again!!!!', '2014-04-28 20:22:16'),
(26, 1, 0, '0', 0, 0, '', '', 'And a third time!!!', '2014-04-28 20:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID of the user',
  `UserName` varchar(25) NOT NULL COMMENT 'username',
  `useRealName` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(500) NOT NULL,
  `salt` varchar(20) NOT NULL COMMENT 'password salt',
  `email` varchar(200) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `firstName` varchar(25) NOT NULL,
  `middleName` varchar(25) DEFAULT NULL,
  `lastName` varchar(25) NOT NULL,
  `Posts` longtext,
  `Buddies` longtext,
  `added` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `useRealName`, `password`, `salt`, `email`, `verified`, `firstName`, `middleName`, `lastName`, `Posts`, `Buddies`, `added`) VALUES
(1, 'MDooley', 0, '12345Password12345', '12345', 'MDooley47@gmail.com', 0, 'Matthew', 'Donald', 'Dooley', '1,2,3,4,5,21,25,26', NULL, '0000-00-00 00:00:00'),
(2, 'Boxes Admin', 0, 'Password', '47', 'Admin@Boxed.com', 0, 'Boxes', NULL, 'Admin', '1,2,4', NULL, '0000-00-00 00:00:00'),
(25, 'MDooley20', 1, 'fBblDGmz5ghifBblDGmz5g', 'fBblDGmz5g', 'matthewd1997@example.xxx', 0, 'Matthew', '', 'Dooley', '', '', '2014-04-24 22:15:53'),
(26, 'MD', 0, 'bcdZMLnTbvhibcdZMLnTbv', 'bcdZMLnTbv', 'hi@hi.com', 0, 'Matthew', 'null', 'Dooley', '', '', '2014-04-25 21:04:17'),
(27, 'Hello', 0, 'hSL2Q2FWNiHihSL2Q2FWNi', 'hSL2Q2FWNi', 'awesome@hi.com', 0, 'df', '', 'asdf', '', '', '2014-04-25 21:18:51'),
(28, 'lol', 0, 'oCAit4UA2floloCAit4UA2f', 'oCAit4UA2f', 'lol@lol.co', 0, 'lol', '', 'lol', '', '', '2014-04-25 21:32:17'),
(29, 'hahahaha', 0, 'uAx7qn6HZahahauAx7qn6HZa', 'uAx7qn6HZa', 'hah@ha.co', 0, 'haha', '', 'haha', '', '', '2014-04-25 21:56:38'),
(30, 'BobDooley', 0, 'CFg1ukw0TwHello*()HelloCFg1ukw0Tw', 'CFg1ukw0Tw', 'Bob@Dooling.com', 0, 'Bob', '', 'Bob', '', '', '2014-04-25 22:00:13'),
(31, 'BobDooling', 0, 'UgY2SnfXtbHelloUgY2SnfXtb', 'UgY2SnfXtb', 'Bob@Dooley.com', 0, 'Bob', '', 'Bob', '', '', '2014-04-25 22:01:48'),
(32, 'Person1', 0, 'pmOtPrdmt1okaypmOtPrdmt1', 'pmOtPrdmt1', 'Person@peeps.co', 0, 'Bill', '', 'Bill', '', '', '2014-04-25 22:11:45'),
(33, 'Hahayutan', 0, 'oQcH97A8EByutaboQcH97A8EB', 'oQcH97A8EB', 'MDooley@hah.ca', 0, 'Matthew', '', 'Matthew', '', '', '2014-04-25 22:27:11'),
(34, 'Dools Dooley', 0, 'fSawlevvZlBoxxes7*()fSawlevvZl', 'fSawlevvZl', 'Dools@Boxxes.co', 0, 'Matthew', '', 'Matthew', '', '', '2014-04-26 13:54:26'),
(35, 'DSdsfa', 0, 'ImtponWjSmhiImtponWjSm', 'ImtponWjSm', 'Whatevs@whatevs.co', 0, 'Matthew', '', 'Matthew', '', '', '2014-04-27 19:03:47');
--
-- Database: `Boxes_houseapp`
--
CREATE DATABASE `Boxes_houseapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Boxes_houseapp`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'post ID',
  `IDofPoster` bigint(20) NOT NULL COMMENT 'who Posted it',
  `likes` bigint(20) NOT NULL COMMENT 'likes it has',
  `likers` longtext NOT NULL,
  `flags` int(11) DEFAULT NULL,
  `commentCount` mediumint(9) DEFAULT NULL COMMENT 'how many comments there are',
  `comments` longtext COMMENT 'split at '', ''',
  `commenters` longtext COMMENT 'array corr with comments',
  `post` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID of the user',
  `UserName` varchar(25) NOT NULL COMMENT 'username',
  `useRealName` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(500) NOT NULL,
  `salt` varchar(20) NOT NULL COMMENT 'password salt',
  `email` varchar(200) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `firstName` varchar(25) NOT NULL,
  `middleName` varchar(25) DEFAULT NULL,
  `lastName` varchar(25) NOT NULL,
  `Posts` longtext,
  `Buddies` longtext,
  `added` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

