-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 11:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL,
  `brand_status` enum('1','0') NOT NULL,
  `brand_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`, `brand_status`, `brand_description`) VALUES
(1, 1, 'something', '1', ''),
(2, 1, 'Microsoft', '1', ''),
(3, 2, 'Google', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_status` enum('1','0') NOT NULL,
  `category_description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`, `category_description`) VALUES
(1, 'hello', '1', ''),
(2, 'pinkiller', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_number` varchar(255) NOT NULL,
  `customer_status` enum('1','0') NOT NULL,
  `customer_description` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_number`, `customer_status`, `customer_description`, `created_date`) VALUES
(1, 'Krishna', 'Hello from the other side', '909203', '1', '', '2019-06-07 00:00:00'),
(2, 'Pawwan', 'Australia', '092039', '1', '', '2019-06-15 00:00:00'),
(3, 'Zaaw  Zaw', 'No 16 53rd lower street', '092039', '1', '', '2019-07-22 00:00:00'),
(4, 'kljdlf', 'No 16 53rd lower street', '09090909', '1', '', '2019-07-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(48) NOT NULL,
  `description` text NOT NULL,
  `roles` bigint(20) UNSIGNED NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `description`, `roles`) VALUES
(1, 'Administrator', '', 1),
(10, 'staff', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `login_id` int(10) UNSIGNED NOT NULL,
  `ip_address` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `success` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`login_id`, `ip_address`, `user_id`, `time`, `success`) VALUES
(1, 0, 1, '2019-06-07 00:36:55', 1),
(2, 0, 1, '2019-06-07 00:49:54', 1),
(3, 0, 1, '2019-06-07 01:06:31', 1),
(4, 0, 1, '2019-06-07 01:46:07', 1),
(5, 0, 1, '2019-06-07 04:49:17', 1),
(6, 0, 1, '2019-06-08 02:42:42', 1),
(7, 0, 1, '2019-06-08 05:07:23', 1),
(8, 0, 1, '2019-06-09 22:49:01', 1),
(9, 0, 1, '2019-06-10 03:39:02', 1),
(10, 0, 1, '2019-06-10 10:56:30', 1),
(11, 0, 1, '2019-06-10 10:56:35', 1),
(12, 0, 1, '2019-06-10 11:21:46', 1),
(13, 0, 1, '2019-06-10 11:47:48', 1),
(14, 0, 1, '2019-06-10 11:50:57', 1),
(15, 0, 0, '2019-06-10 12:07:30', 0),
(16, 0, 1, '2019-06-10 12:07:33', 1),
(17, 0, 1, '2019-06-11 10:16:34', 1),
(18, 0, 1, '2019-06-11 10:52:09', 1),
(19, 0, 1, '2019-06-11 23:20:36', 1),
(20, 0, 1, '2019-06-12 09:01:29', 1),
(21, 0, 1, '2019-06-12 22:40:03', 1),
(22, 0, 1, '2019-06-13 02:07:23', 1),
(23, 0, 1, '2019-06-13 10:21:45', 1),
(24, 0, 1, '2019-06-13 10:23:31', 1),
(25, 0, 1, '2019-06-13 10:24:36', 1),
(26, 0, 1, '2019-06-13 10:27:30', 1),
(27, 0, 1, '2019-06-14 00:19:05', 1),
(28, 0, 1, '2019-06-14 08:48:23', 1),
(29, 0, 1, '2019-06-14 12:57:44', 1),
(30, 0, 1, '2019-06-14 21:58:12', 1),
(31, 0, 1, '2019-06-14 21:58:37', 1),
(32, 0, 1, '2019-06-14 22:06:48', 1),
(33, 0, 1, '2019-06-14 22:08:26', 1),
(34, 0, 1, '2019-06-14 22:10:21', 1),
(35, 0, 1, '2019-06-14 22:10:25', 1),
(36, 0, 1, '2019-06-14 23:00:26', 1),
(37, 0, 1, '2019-06-14 23:09:40', 1),
(38, 0, 1, '2019-06-14 23:10:37', 1),
(39, 0, 1, '2019-06-15 02:35:27', 1),
(40, 0, 1, '2019-06-15 03:09:30', 1),
(41, 0, 1, '2019-06-15 03:10:49', 1),
(42, 0, 1, '2019-06-15 03:49:12', 1),
(43, 0, 1, '2019-06-15 04:02:10', 1),
(44, 0, 1, '2019-06-15 04:02:29', 1),
(45, 0, 1, '2019-06-15 04:04:39', 1),
(46, 0, 1, '2019-06-15 04:05:09', 1),
(47, 0, 1, '2019-06-15 04:10:58', 1),
(48, 0, 1, '2019-06-15 04:11:23', 1),
(49, 0, 1, '2019-06-15 11:22:17', 1),
(50, 0, 1, '2019-06-15 11:32:28', 1),
(51, 0, 1, '2019-06-15 11:40:54', 1),
(52, 0, 1, '2019-06-15 11:45:04', 1),
(53, 0, 1, '2019-06-15 11:45:16', 1),
(54, 0, 1, '2019-06-15 11:57:10', 1),
(55, 0, 1, '2019-06-15 12:02:51', 1),
(56, 0, 1, '2019-06-15 12:12:58', 1),
(57, 0, 1, '2019-06-15 12:14:04', 1),
(58, 0, 1, '2019-06-15 22:24:03', 1),
(59, 0, 1, '2019-06-16 11:52:32', 1),
(60, 0, 1, '2019-06-16 12:01:40', 1),
(61, 0, 1, '2019-06-16 21:47:44', 1),
(62, 0, 1, '2019-06-16 23:26:19', 1),
(63, 0, 1, '2019-06-16 23:26:51', 1),
(64, 0, 1, '2019-06-16 23:53:52', 1),
(65, 0, 1, '2019-06-17 02:05:35', 1),
(66, 0, 1, '2019-06-17 02:14:02', 1),
(67, 0, 1, '2019-06-17 03:56:35', 1),
(68, 0, 1, '2019-06-18 05:22:40', 1),
(69, 0, 1, '2019-06-18 11:35:13', 1),
(70, 0, 1, '2019-06-18 12:03:38', 1),
(71, 0, 1, '2019-06-18 12:14:55', 1),
(72, 0, 1, '2019-06-18 13:02:15', 1),
(73, 0, 1, '2019-06-18 13:05:43', 1),
(74, 0, 1, '2019-06-18 13:22:31', 1),
(75, 0, 1, '2019-06-18 13:34:26', 1),
(76, 0, 1, '2019-06-18 21:26:48', 1),
(77, 0, 1, '2019-06-18 21:33:44', 1),
(78, 0, 1, '2019-06-18 21:33:54', 1),
(79, 0, 1, '2019-06-18 22:27:31', 1),
(80, 0, 1, '2019-06-18 22:28:45', 1),
(81, 0, 1, '2019-06-19 07:37:44', 1),
(82, 0, 1, '2019-06-19 08:44:02', 1),
(83, 0, 1, '2019-06-19 11:35:37', 1),
(84, 0, 1, '2019-06-19 12:03:19', 1),
(85, 0, 1, '2019-06-19 12:09:15', 1),
(86, 0, 1, '2019-06-19 12:13:41', 1),
(87, 0, 1, '2019-06-19 12:33:26', 1),
(88, 0, 1, '2019-06-19 12:34:24', 1),
(89, 0, 1, '2019-06-19 12:35:58', 1),
(90, 0, 1, '2019-06-19 12:38:24', 1),
(91, 0, 1, '2019-06-19 12:38:54', 1),
(92, 0, 1, '2019-06-19 22:43:37', 1),
(93, 0, 1, '2019-06-20 04:59:36', 1),
(94, 0, 1, '2019-06-20 10:56:42', 1),
(95, 0, 1, '2019-06-20 11:06:51', 1),
(96, 0, 1, '2019-06-20 11:07:21', 1),
(97, 0, 1, '2019-06-20 11:55:40', 1),
(98, 0, 1, '2019-06-20 12:05:45', 1),
(99, 0, 1, '2019-06-20 12:13:50', 1),
(100, 0, 1, '2019-06-20 12:13:53', 1),
(101, 0, 1, '2019-06-20 12:15:25', 1),
(102, 0, 1, '2019-06-20 12:15:27', 1),
(103, 0, 1, '2019-06-20 21:34:42', 1),
(104, 0, 1, '2019-06-21 02:58:45', 1),
(105, 0, 1, '2019-06-21 05:48:53', 1),
(106, 0, 1, '2019-06-21 09:33:42', 1),
(107, 0, 1, '2019-06-21 09:36:12', 1),
(108, 0, 1, '2019-06-21 09:42:17', 1),
(109, 0, 1, '2019-06-21 10:28:15', 1),
(110, 0, 1, '2019-06-21 10:33:01', 1),
(111, 0, 1, '2019-06-21 10:52:13', 1),
(112, 0, 1, '2019-06-21 10:52:15', 1),
(113, 0, 1, '2019-06-21 11:17:03', 1),
(114, 0, 1, '2019-06-21 11:27:35', 1),
(115, 0, 1, '2019-06-21 11:54:31', 1),
(116, 0, 1, '2019-06-21 11:59:49', 1),
(117, 0, 1, '2019-06-21 12:21:20', 1),
(118, 0, 1, '2019-06-21 22:07:23', 1),
(119, 0, 1, '2019-06-21 22:34:26', 1),
(120, 0, 1, '2019-06-22 06:21:49', 1),
(121, 0, 1, '2019-06-22 06:29:57', 1),
(122, 0, 1, '2019-06-22 10:15:17', 1),
(123, 0, 1, '2019-06-22 11:02:41', 1),
(124, 0, 1, '2019-06-22 11:42:25', 1),
(125, 0, 1, '2019-06-22 11:42:27', 1),
(126, 0, 1, '2019-06-23 03:43:24', 1),
(127, 0, 1, '2019-06-23 05:05:49', 1),
(128, 0, 1, '2019-06-23 07:45:41', 1),
(129, 0, 1, '2019-06-27 20:44:25', 1),
(130, 0, 1, '2019-07-12 22:21:12', 1),
(131, 0, 1, '2019-07-13 03:02:36', 1),
(132, 0, 1, '2019-07-13 03:04:27', 1),
(133, 0, 1, '2019-07-13 03:06:41', 1),
(134, 0, 1, '2019-07-13 03:08:47', 1),
(135, 0, 1, '2019-07-13 03:12:48', 1),
(136, 0, 1, '2019-07-13 03:15:16', 1),
(137, 0, 1, '2019-07-13 03:24:04', 1),
(138, 0, 1, '2019-07-13 03:38:11', 1),
(139, 0, 1, '2019-07-13 03:40:25', 1),
(140, 0, 1, '2019-07-13 03:42:55', 1),
(141, 0, 1, '2019-07-13 04:35:59', 1),
(142, 0, 1, '2019-07-13 04:42:16', 1),
(143, 0, 1, '2019-07-13 04:48:58', 1),
(144, 0, 1, '2019-07-13 07:46:04', 1),
(145, 0, 1, '2019-07-13 08:36:33', 1),
(146, 0, 1, '2019-07-13 08:36:52', 1),
(147, 0, 1, '2019-07-13 21:50:49', 1),
(148, 0, 1, '2019-07-13 23:12:34', 1),
(149, 0, 1, '2019-07-14 07:08:24', 1),
(150, 0, 1, '2019-07-14 14:25:16', 1),
(151, 0, 1, '2019-07-14 15:00:17', 1),
(152, 0, 1, '2019-07-14 15:01:06', 1),
(153, 0, 1, '2019-07-15 02:24:17', 1),
(154, 0, 1, '2019-07-15 02:29:31', 1),
(155, 0, 1, '2019-07-15 02:52:02', 1),
(156, 0, 1, '2019-07-15 03:00:11', 1),
(157, 0, 1, '2019-07-15 04:12:15', 1),
(158, 0, 1, '2019-07-15 16:39:02', 1),
(159, 0, 1, '2019-07-15 16:39:02', 1),
(160, 0, 1, '2019-07-18 06:07:42', 1),
(161, 0, 1, '2019-07-18 09:45:51', 1),
(162, 0, 0, '2019-07-18 10:05:02', 0),
(163, 0, 1, '2019-07-18 10:05:06', 1),
(164, 0, 1, '2019-07-18 14:32:36', 1),
(165, 0, 1, '2019-07-18 17:08:26', 1),
(166, 0, 1, '2019-07-18 17:18:37', 1),
(167, 0, 1, '2019-07-19 05:13:20', 1),
(168, 0, 1, '2019-07-19 07:54:26', 1),
(169, 0, 1, '2019-07-19 12:32:41', 1),
(170, 0, 1, '2019-07-19 14:48:38', 1),
(171, 0, 1, '2019-07-20 08:59:43', 1),
(172, 0, 1, '2019-07-20 09:00:36', 1),
(173, 0, 1, '2019-07-20 09:01:17', 1),
(174, 0, 1, '2019-07-21 11:18:50', 1),
(175, 0, 1, '2019-07-21 14:42:26', 1),
(176, 0, 1, '2019-07-21 14:47:20', 1),
(177, 0, 1, '2019-07-21 14:48:31', 1),
(178, 0, 1, '2019-07-21 15:45:45', 1),
(179, 0, 1, '2019-07-21 15:52:33', 1),
(180, 0, 1, '2019-07-21 15:52:58', 1),
(181, 0, 1, '2019-07-21 16:01:31', 1),
(182, 0, 1, '2019-07-21 16:21:35', 1),
(183, 0, 1, '2019-07-21 16:22:07', 1),
(184, 0, 1, '2019-07-21 16:22:10', 1),
(185, 0, 1, '2019-07-21 16:24:57', 1),
(186, 0, 1, '2019-07-21 16:26:26', 1),
(187, 0, 1, '2019-07-21 16:27:26', 1),
(188, 0, 1, '2019-07-21 16:28:24', 1),
(189, 0, 1, '2019-07-21 16:28:46', 1),
(190, 0, 1, '2019-07-22 04:07:34', 1),
(191, 0, 1, '2019-07-22 06:17:17', 1),
(192, 0, 1, '2019-07-22 16:17:59', 1),
(193, 0, 1, '2019-07-22 16:22:02', 1),
(194, 0, 1, '2019-07-22 16:24:12', 1),
(195, 0, 1, '2019-07-22 17:05:45', 1),
(196, 0, 1, '2019-07-23 05:06:04', 1),
(197, 0, 1, '2019-07-23 07:16:22', 1),
(198, 0, 1, '2019-07-23 09:05:15', 1),
(199, 0, 1, '2019-07-23 09:21:25', 1),
(200, 0, 1, '2019-07-23 17:29:33', 1),
(201, 0, 1, '2019-07-24 07:05:23', 1),
(202, 0, 1, '2019-07-24 07:54:22', 1),
(203, 0, 1, '2019-07-24 07:57:57', 1),
(204, 0, 1, '2019-07-24 16:51:02', 1),
(205, 0, 1, '2019-07-25 02:53:52', 1),
(206, 0, 1, '2019-07-25 03:00:50', 1),
(207, 0, 1, '2019-07-25 03:45:55', 1),
(208, 0, 1, '2019-07-25 07:07:45', 1),
(209, 0, 1, '2019-07-25 07:19:03', 1),
(210, 0, 1, '2019-07-25 10:09:01', 1),
(211, 0, 1, '2019-07-25 15:24:01', 1),
(212, 0, 0, '2019-07-25 16:50:36', 0),
(213, 0, 1, '2019-07-25 16:50:41', 1),
(214, 0, 1, '2019-07-26 03:41:28', 1),
(215, 0, 1, '2019-07-26 03:52:12', 1),
(216, 0, 1, '2019-07-26 04:07:45', 1),
(217, 0, 1, '2019-07-26 15:41:06', 1),
(218, 0, 1, '2019-07-27 06:10:47', 1),
(219, 0, 1, '2019-07-27 06:13:06', 1),
(220, 0, 1, '2019-07-30 04:10:19', 1),
(221, 0, 1, '2019-07-30 04:10:24', 1),
(222, 0, 1, '2019-07-30 07:14:48', 1),
(223, 0, 1, '2019-07-31 02:37:44', 1),
(224, 0, 1, '2019-08-01 03:50:23', 1),
(225, 0, 1, '2019-08-01 05:46:05', 1),
(226, 0, 1, '2019-08-01 08:20:45', 1),
(227, 0, 1, '2019-08-04 17:53:10', 1),
(228, 0, 1, '2019-08-06 03:09:45', 1),
(229, 0, 1, '2019-08-06 03:24:25', 1),
(230, 0, 1, '2019-08-06 09:34:19', 1),
(231, 0, 0, '2019-08-06 09:34:46', 0),
(232, 0, 0, '2019-08-06 09:34:51', 0),
(233, 0, 0, '2019-08-06 09:35:28', 0),
(234, 0, 0, '2019-08-06 09:35:58', 0),
(235, 0, 0, '2019-08-06 09:36:01', 0),
(236, 0, 1, '2019-08-06 09:48:20', 1),
(237, 0, 1, '2019-08-06 09:50:26', 1),
(238, 0, 1, '2019-08-06 09:51:14', 1),
(239, 0, 1, '2019-08-06 09:53:06', 1),
(240, 0, 1, '2019-08-08 04:59:49', 1),
(241, 0, 1, '2019-08-08 06:44:32', 1),
(242, 0, 1, '2019-08-08 07:46:17', 1),
(243, 0, 1, '2019-08-08 08:08:12', 1),
(244, 0, 1, '2019-08-08 16:41:46', 1),
(245, 0, 1, '2019-08-08 17:02:18', 1),
(246, 0, 1, '2019-08-08 17:10:55', 1),
(247, 0, 1, '2019-08-09 03:59:23', 1),
(248, 0, 1, '2019-08-09 04:02:37', 1),
(249, 0, 1, '2019-08-09 04:10:44', 1),
(250, 0, 1, '2019-08-09 04:11:40', 1),
(251, 0, 1, '2019-08-09 04:18:55', 1),
(252, 0, 1, '2019-08-09 04:39:01', 1),
(253, 0, 1, '2019-08-09 04:40:18', 1),
(254, 0, 1, '2019-08-13 04:09:27', 1),
(255, 0, 1, '2019-08-14 09:23:20', 1),
(256, 0, 1, '2019-08-16 03:48:58', 1),
(257, 0, 1, '2019-08-16 04:07:08', 1),
(258, 0, 1, '2019-08-16 04:07:11', 1),
(259, 0, 1, '2019-08-16 04:08:06', 1),
(260, 0, 1, '2019-08-16 04:15:02', 1),
(261, 0, 1, '2019-08-16 04:16:55', 1),
(262, 0, 1, '2019-08-19 08:36:50', 1),
(263, 0, 1, '2019-08-20 09:42:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monreports`
--

CREATE TABLE `monreports` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `opening_quantity` int(11) DEFAULT NULL,
  `closing_quantity` int(11) DEFAULT NULL,
  `sold_quantity` int(11) DEFAULT NULL,
  `added_quantity` int(11) DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monreports`
--

INSERT INTO `monreports` (`id`, `product_id`, `category_id`, `opening_quantity`, `closing_quantity`, `sold_quantity`, `added_quantity`, `created_date`, `updated_date`) VALUES
(1, 1, 1, 10, 3, NULL, 0, '2019-07-25 03:46:19', '2019-07-30 04:44:08'),
(2, 2, 2, 200, 200, NULL, 0, '2019-07-25 04:23:38', '2019-08-04 17:54:44'),
(3, 2, 2, 200, 193, NULL, 0, '2019-07-25 07:17:52', '2019-08-04 17:54:47'),
(4, 4, 2, 100, 100, NULL, 0, '2019-08-04 18:00:03', '2019-08-04 18:01:14'),
(5, 5, 2, 20, 20, NULL, NULL, '2019-08-04 18:01:38', '2019-08-04 18:01:38'),
(6, 6, 1, 220, 220, NULL, NULL, '2019-08-04 18:02:40', '2019-08-04 18:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `net_due_date` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `paid_status` enum('1','0') NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `customer_name`, `customer_address`, `date_time`, `net_due_date`, `net_amount`, `paid_status`, `user_id`) VALUES
(1, 'INVS1E24FFC640', 'Pawwan', 'Australia', '1562693400', '1563557400', '200.00', '1', 'krishna'),
(2, 'INVSA5342DC8FA', 'Pawwan', 'Australia', '1562175000', '1562866200', '206.00', '1', 'krishna'),
(3, 'INVS749FE0C531', 'Pawwan', 'Australia', '1562693400', '1565199000', '9206.00', '1', 'krishna'),
(4, 'INVSE9C4936F54', 'Krishna', 'Hello from the other side', '1563471000', '1564335000', '206.00', '1', 'krishna'),
(5, 'INVSE9C4936F54', 'Krishna', 'Hello from the other side', '1563471000', '1564335000', '206.00', '1', 'krishna'),
(6, 'INVS400CCD10C1', 'Krishna', 'Hello from the other side', '1562607000', '1563471000', '3371.00', '1', 'krishna'),
(7, 'INVSC6B344CE02', 'Pawwan', 'Australia', '1562779800', '1563384600', '3165.00', '1', 'krishna'),
(8, 'INVSC6B344CE02', 'Pawwan', 'Australia', '1562779800', '1563384600', '3165.00', '1', 'krishna'),
(9, 'INVSC6B344CE02', 'Pawwan', 'Australia', '1562779800', '1563384600', '3165.00', '1', 'krishna'),
(10, 'INVS428A672F59', 'Zaaw  Zaw', 'No 16 53rd lower street', '1562693400', '1563730200', '200.00', '1', 'krishna');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `tax` double(10,2) DEFAULT '0.00',
  `discount` double(10,2) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `foc` int(11) NOT NULL,
  `created_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `rate`, `tax`, `discount`, `amount`, `foc`, `created_date`) VALUES
(22, 1, 1, '1', '200', 0.00, 0.00, '200.00', 0, '2019-07-25'),
(23, 2, 1, '1', '200', 3.00, 0.00, '206.00', 0, '2019-07-25'),
(29, 3, 2, '3', '3000', 0.00, 0.00, '9000.00', 0, '2019-07-25'),
(30, 3, 1, '1', '200', 0.00, 0.00, '206.00', 0, '2019-07-25'),
(31, 5, 1, '1', '200', 3.00, 0.00, '206.00', 0, '2019-07-26'),
(32, 6, 2, '1', '3000', 0.00, 0.00, '3165.00', 0, '2019-07-30'),
(33, 6, 1, '1', '200', 0.00, 0.00, '206.00', 0, '2019-07-30'),
(34, 7, 2, '1', '3000', 0.00, 0.00, '3165.00', 0, '2019-07-30'),
(35, 8, 2, '1', '3000', 0.00, 0.00, '3165.00', 0, '2019-07-30'),
(36, 9, 2, '1', '3000', 0.00, 0.00, '3165.00', 0, '2019-07-30'),
(37, 10, 1, '1', '200', 3.00, 3.00, '200.00', 1, '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_man_date` varchar(255) NOT NULL,
  `product_ex_date` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_remain_quantity` int(11) NOT NULL,
  `product_added_quantity` int(11) DEFAULT NULL,
  `act_added_quantity` int(11) DEFAULT NULL,
  `product_unit` varchar(150) NOT NULL,
  `product_base_price` int(11) NOT NULL,
  `product_selling_price` int(11) NOT NULL,
  `product_profit_price` int(11) NOT NULL,
  `product_tax` decimal(4,2) NOT NULL,
  `product_enter_by` varchar(255) NOT NULL,
  `product_status` enum('1','0') NOT NULL,
  `product_description` text NOT NULL,
  `product_date` date NOT NULL,
  `product_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_man_date`, `product_ex_date`, `product_quantity`, `product_remain_quantity`, `product_added_quantity`, `act_added_quantity`, `product_unit`, `product_base_price`, `product_selling_price`, `product_profit_price`, `product_tax`, `product_enter_by`, `product_status`, `product_description`, `product_date`, `product_updated_date`, `is_deleted`) VALUES
(1, 1, 1, 'Biogessic', '07/18/2019', '08/23/2019', 10, 3, 0, NULL, 'Stp', 100, 200, 100, '3.00', 'krishna', '1', '', '2019-07-25', '2019-07-30 04:44:08', '0'),
(2, 2, 3, 'Pixle', '08/15/2019', '08/15/2019', 200, 193, 0, NULL, 'Sachet', 1000, 3000, 2000, '5.50', 'krishna', '1', '', '2019-07-25', '2019-07-30 04:43:39', '0'),
(3, 2, 3, 'This is something that is called a product', '08/02/2019', '09/13/2019', 100, 100, 0, NULL, 'Sachet', 1000, 2000, 1000, '5.00', 'krishna', '1', '', '2019-08-05', '2019-08-04 17:58:32', '0'),
(4, 2, 3, 'This is something that is called a product', '08/02/2019', '09/13/2019', 100, 100, 0, NULL, 'Sachet', 1000, 2000, 1000, '5.00', 'krishna', '1', '', '2019-08-05', '2019-08-04 18:00:03', '0'),
(5, 2, 3, 'motorcycle', '08/09/2019', '08/14/2019', 20, 20, 0, NULL, 'Sth', 1000, 1000, 0, '3.00', 'krishna', '1', '', '2019-08-05', '2019-08-04 18:01:38', '0'),
(6, 1, 1, 'Biogessiclkjlkjlk', '08/02/2019', '08/13/2019', 220, 220, 0, NULL, 'Sachet', 85, 500, 415, '3.00', 'krishna', '1', '', '2019-08-05', '2019-08-04 18:02:40', '0');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `userdata_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `fname` varchar(40) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `position` varchar(40) NOT NULL,
  `social_id` varchar(12) NOT NULL,
  `id_type` enum('','Tazkara','Passport','Driver License','Bank ID Card') DEFAULT 'Tazkara',
  `birth_date` int(11) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `picture` text,
  `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`userdata_id`, `user_id`, `first_name`, `last_name`, `fname`, `gender`, `email`, `phone`, `address`, `position`, `social_id`, `id_type`, `birth_date`, `create_date`, `picture`, `memo`) VALUES
(1, 1, 'krishna', 'aryal', 'toemu', 1, 'aryalkrishna642@gmail.com', '09400372581', 'No 16 53rd lower street', 'admin', '3333', 'Tazkara', -26614800, 1552366425, 'uploads/hospital/staff/1/1_profile_picture.jpg', ''),
(20, 9, 'pawan', NULL, NULL, 1, 'pawan@gmail.com', '09969516236', 'No 16 53rd lower street', 'staff', '', 'Tazkara', 1558389600, 1558406388, NULL, 'This guy is cool'),
(21, 10, 'Pawsuram', NULL, NULL, 1, 'aryalkrishna642@gmail.com', '09400372581', 'No 16 53rd lower street', 'admin', '', 'Tazkara', 0, 1559186737, NULL, ''),
(22, 11, 'someone', NULL, NULL, 1, 'aryalkrishna642@gmail.com', '020902930923', 'No 16 53rd lower street', 'admin', '', 'Tazkara', 1559167200, 1559187011, NULL, ''),
(23, 12, 'sunainar', NULL, NULL, 1, 'aryalkrishna642@gmail.com', '09400372581', 'No 16 53rd lower street', 'admin', '', 'Tazkara', 890262000, 1559187742, NULL, ''),
(24, 13, 'Someone', NULL, NULL, 1, 'aryalkrishna642@gmail.com', '09400372581', 'No 16 53rd lower street', 'admin', '', 'Tazkara', 1559340000, 1559368071, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `password_last_set` datetime NOT NULL,
  `password_never_expires` tinyint(1) NOT NULL DEFAULT '0',
  `remember_me` varchar(40) NOT NULL,
  `activation_code` varchar(40) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `forgot_code` varchar(40) NOT NULL,
  `forgot_generated` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` datetime NOT NULL,
  `last_login_ip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `password_last_set`, `password_never_expires`, `remember_me`, `activation_code`, `active`, `forgot_code`, `forgot_generated`, `enabled`, `last_login`, `last_login_ip`) VALUES
(1, 'krishna', '$2a$08$qW6WZmpoAFpwPsXHBL.GOetTRidz7o6SYfbdPwkYV9GfgdR16iupC', '2019-03-12 05:53:45', 1, '', '', 1, '', '0000-00-00 00:00:00', 1, '2019-08-20 16:12:54', 0),
(9, 'pawan', '$2a$08$pv4NvQe0kIp6CjMIbIY9OO3uuKamCQcFCKKkhRNbXsl8ivdkC0W7S', '2019-05-21 04:39:48', 0, '', '', 1, '', '0000-00-00 00:00:00', 0, '2019-06-01 17:21:32', 0),
(10, 'pawsu', '$2a$08$f39F/ACUh73ldX714ePFQOcvWSUn3kgEkZ/TyWMYMB3UQ7Df0/Dhu', '2019-05-30 05:25:37', 0, '', '81927b9927c2dfb0e595f1d5d8a8862c1f2505b0', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 'someone', '$2a$08$QaPVmw0V87t6r/358HhYI.r45EOo14OryihjiLqRiewosvworeVyy', '2019-05-30 05:30:11', 0, '', '62aa09a2cc4621561c77d659fcf91f921b9bdecd', 0, '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 0),
(12, 'sunainar', '$2a$08$cSOGpQx4NeWklJ277EiJmeIwhTW3FclEdJRBJj/oJEBGALwRn4/Ji', '2019-05-30 05:42:22', 0, '', '', 1, '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 0),
(13, 'sodmflskdf', '$2a$08$YPWNUBRK4AMAjxQL63.qQO3/vNjqqtYg9/M2EFHhNpfShFTtTgcCO', '2019-06-01 07:47:51', 0, '', '', 1, '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `assoc_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`assoc_id`, `user_id`, `group_id`) VALUES
(2, 1, 1),
(3, 2, 2),
(6, 3, 2),
(5, 4, 1),
(7, 5, 1),
(8, 6, 1),
(9, 7, 1),
(10, 8, 10),
(11, 9, 10),
(12, 10, 1),
(13, 11, 1),
(14, 12, 1),
(15, 13, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `monreports`
--
ALTER TABLE `monreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userdata_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`assoc_id`),
  ADD KEY `user_id` (`user_id`,`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `monreports`
--
ALTER TABLE `monreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userdata_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `assoc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
