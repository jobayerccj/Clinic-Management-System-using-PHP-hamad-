-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2014 at 11:36 AM
-- Server version: 5.5.37
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arvsush_mayo`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `employee_no` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `organisation` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`,`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_name`, `password`, `first_name`, `last_name`, `designation`, `employee_no`, `organisation`, `email_id`, `activation_code`, `date_time`) VALUES
(1, 'vikasdhiman', '5f4ef7265c6c65fac3533c1871245363', 'Vikas', 'dhiman', 'PHP Developer', '1234567', 'Student', 'vikasdhiman107@gmail.com', '', '0000-00-00 00:00:00'),
(2, 'testing', 'ae2b1fca515949e5d54fb22b8ed95575', 'Vikas1', 'sdsfsdfdsf', 'PHP Developer1', '12345671', 'Student1', 'testing@gmail.com', '', '0000-00-00 00:00:00'),
(3, 'fdsfdssf', '013f890e35d1b7f5e45f21e60f7863d6', 'Vikas1', 'sdsfsdfdsf', 'PHP Developer1', '12345671', 'Student1', 'dsfdsfdsf@kkk.ccc', '', '0000-00-00 00:00:00'),
(4, 'dsfdsfdsfs', '21b4ccfc4e349ab92882447a0c6bf408', 'Vikas1', 'sdsfsdfdsf', 'PHP Developer1', '12345671', 'Student1', 'sfdsf@kkk.com', '', '0000-00-00 00:00:00'),
(5, 'test', '098f6bcd4621d373cade4e832627b4f6', 'Vikas1', '', 'PHP Developer1', '12345671', 'Student1', 'vikas@nordiff.com', '', '0000-00-00 00:00:00'),
(6, 'dsfdsfdf', '959cb62b8a013899467385588a1d0d42', 'Vikas1', '', 'PHP Developer1', '12345671', 'Student1', 'vikas@gmail.com', '', '0000-00-00 00:00:00'),
(7, 'dsfsdfsfsdf', '2866c8394f5ab1a1917dba7bb916c216', 'fdsfdsfdsfdsf', 'sdsfsdfdsf', 'dsfsdfdsfds', 'fdsfdsfds', 'dsfsdfdsf', 'nirmalu@gmail.com', '', '0000-00-00 00:00:00'),
(8, 'vikasdhiman1', '0f0edff4dcc9e46a50a6e4e4ef191d31', 'sdafdsfd', 'fdsfdsfsdfds', 'fdsffdsfds', 'sdfdsafdswfdsa', 'fdsfdsfdsfdsf', 'vikasdhiman108@gmail.com', '', '0000-00-00 00:00:00'),
(9, 'nirmalu', 'fe5cf07e6f2633d233617139a82b0c65', 'dsfdsfdsfdsf', 'dsfdsfdsfds', 'dsafdsfsda', 'fdsafdsfdsa', 'fdsafdsafds', 'nirmal@gmail.com', '', '0000-00-00 00:00:00'),
(11, 'viku', 'bebe68374a49cb41b7c9219e97250044', 'vikas', 'vikas', 'vikas', 'vikas', 'vikas', 'vikas1@gmail.com', '', '0000-00-00 00:00:00'),
(12, 'vikasdh', '3808c74c421bc7e9e73471ae9b1a40a4', 'Vikas', 'Dhiman', 'PHP Developer', '1234567', 'Student', 'vikasdh@gmail.com', '', '0000-00-00 00:00:00'),
(13, '', 'ec37a79f088a590bc704e0469b2493f5', 'dsfdsfsf', 'dsfdsfsdf', 'dsfdsfdsf', 'sdfsdfdsafds', 'sdfdsfdsf', 'dsfsf@kkk.vvvvv', '', '0000-00-00 00:00:00'),
(14, 'dsfdsafddd', 'e1fbdd5ce51f262f5e6ee09c6811d869', 'fdsfdsafsd', 'fdsfdsa', 'fdsafsda', 'fsdfsdafdsaf', 'fsdafdsafds', 'dsfsf@kkk.vvv', '', '0000-00-00 00:00:00'),
(15, 'fdsfdsfssss', 'd15f0289da057f2d9e6c61fab93b463d', 'dsfdsafsdfsda', 'dsfdsfdsf', 'dsfsdfsd', 'fdsfdsafsd', 'dsfsdafsdf', 'dsfsf@kkk.vvvs', '', '0000-00-00 00:00:00'),
(16, 'sffasdf', '20dbfa65fb6b2ec2d4f1fcf10492c345', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(17, '                fffffffdsfdsfdsf', 'e10adc3949ba59abbe56e057f20f883e', 'dsfdsfdsf', 'dsfsdfsd', 'dsfdsfds', 'fsdfsdfsdf', 'dsfsdfdsf', 'dfsdfsf@gmail.com', '', '0000-00-00 00:00:00'),
(18, 'testing123', 'ae2b1fca515949e5d54fb22b8ed95575', 'test', 'test', 'test', 'test', 'test', 'testing@google.com', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_active` tinyint(1) NOT NULL,
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `user_password_reset_timestamp` bigint(20) NOT NULL,
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_failed_logins` tinyint(1) NOT NULL,
  `user_last_failed_login` int(11) NOT NULL,
  `user_registration_datetime` datetime NOT NULL,
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`,`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`) VALUES
(20, 'test', 'ae2b1fca515949e5d54fb22b8ed95575', 'vikas@gmail.com', 0, 'ca89963a005ac3511ac74a5c912b02e8', '', 0, '', 0, 0, '2014-08-08 07:45:42', '122.173.0.147');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('test', 'ae2b1fca515949e5d54fb22b8ed95575');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
