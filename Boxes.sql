-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2014 at 02:05 AM
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

INSERT INTO `posts` (`ID`, `IDofPoster`, `likes`, `likers`, `flags`, `commentCount`, `comments`, `commenters`, `post`, `date`) VALUES
(1, 1, 3, '0,3,1', 0, 0, '', '', 'Hello World! This is the first post in Boxes! Although this post is manually written yours doesn''t have to be! This is really really fun! I lost the game... I can see this turning into either a success or a failure, or maybe a bit of both lol! Lets simulate a enter sign.\r\n\r\nhaha, I am going to have to find a more "airy" font to use inside of the posts. And a better more "boxy" font for the rest of the time!!! This is almost running out the box! (which is the goal) haha. Just one more line :D so close!!! :DDDD I am going to have to ad emjocon soonish aswell!', '2014-04-14 18:23:54'),
(2, 1, 4757, '0,3,1', 0, 0, NULL, NULL, 'Hello World!!', '2014-04-14 19:57:48'),
(3, 1, 4772, '0,1', 0, 0, NULL, NULL, 'This is awesome!!!', '2014-04-20 22:24:13'),
(4, 1, 48, '0,1', 0, 0, NULL, NULL, 'House App Challenge, I am almost ready!!!', '2014-04-21 11:55:06'),
(5, 1, 73, '0,1', 0, 0, NULL, NULL, 'DMC: Almost ready!!!', '2014-04-21 11:55:47');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `useRealName`, `password`, `salt`, `email`, `verified`, `firstName`, `middleName`, `lastName`, `Posts`, `Buddies`, `added`) VALUES
(1, 'MDooley', 0, '12345Password12345', '12345', 'MDooley47@gmail.com', 0, 'Matthew', 'Donald', 'Dooley', '1,2,3,4,5', NULL, '0000-00-00 00:00:00'),
(2, 'Boxes Admin', 0, 'Password', '47', 'Admin@Boxed.com', 0, 'Boxes', NULL, 'Admin', '1,2,4', NULL, '0000-00-00 00:00:00');
