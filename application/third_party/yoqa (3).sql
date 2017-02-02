-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2016 at 06:46 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yoqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `a0`
--

CREATE TABLE IF NOT EXISTS `a0` (
  `id_a0` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `assessment_date` date DEFAULT NULL,
  `email_log_id` int(11) DEFAULT NULL,
  `a0_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a0`
--

INSERT INTO `a0` (`id_a0`, `id_company`, `token`, `assessment_date`, `email_log_id`, `a0_added_on`, `changed_on`) VALUES
(1, 1, '', '2016-07-11', 1, '2016-07-12 10:39:15', '2016-07-12 13:07:11'),
(2, 4, '', '2016-07-11', 2, '2016-07-12 10:43:39', '2016-07-12 13:07:05'),
(3, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeRdhShtYJtbD2U9xEmc4pJ/yMizNRkIu', NULL, 3, '2016-07-19 03:20:53', '2016-07-19 03:20:56'),
(4, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeKXo3umg/0nxHYz4CgleBjaUQ789Du3K', NULL, NULL, '2016-07-19 06:14:02', '2016-07-19 06:14:04'),
(5, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeAtKV.G5uCPqO3A8X4rH6DVtMWMm364S', NULL, NULL, '2016-07-19 06:16:56', '2016-07-19 06:16:58'),
(6, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeZePXtXm/DbUP5glDYmgZF66Ik3H7WEm', NULL, NULL, '2016-07-19 06:20:50', '2016-07-19 06:20:51'),
(7, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeQSndxEiVZxYWcgurC6gsqWWrt.3VtJq', NULL, NULL, '2016-07-19 06:24:54', '2016-07-19 06:24:55'),
(8, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeH17KfiZdzAueo1uoka0M1hbnvehnq/y', NULL, NULL, '2016-07-19 06:27:15', '2016-07-19 06:27:17'),
(9, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeo/kjOoXVdHVK/6U2rJsySu2B/XdQ8Iq', NULL, NULL, '2016-07-19 06:28:41', '2016-07-19 06:28:42'),
(10, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeCKugi5h4YNiXpkBhPF7Zq90ciHEozO6', NULL, NULL, '2016-07-19 07:41:07', '2016-07-19 07:41:08'),
(11, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe71pM6X7KdPSvM4Vg9QzuVpLcp7r6mOK', NULL, NULL, '2016-07-19 08:02:30', '2016-07-19 08:02:31'),
(12, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeyO7bd4fEDF.5Tm3eTpXJ62.KOE12Wra', NULL, NULL, '2016-07-19 08:10:46', '2016-07-19 08:10:47'),
(13, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeI0dWnZDP1k7PRcj2PFziIGllKNt2VWi', NULL, NULL, '2016-07-19 08:16:29', '2016-07-19 08:16:31'),
(14, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKewfUeWI2zTb1plqkKEFuYF/87bqWvirq', NULL, NULL, '2016-07-19 08:17:02', '2016-07-19 08:17:04'),
(15, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe4PK1wPTjmPNPCX8i.1/lYNNxPP9A3k6', NULL, NULL, '2016-07-19 08:31:44', '2016-07-19 08:31:47'),
(16, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeKImssklmDmWZ56xjfXvi6yEfNVl2d9O', NULL, NULL, '2016-07-19 08:36:48', '2016-07-19 08:36:49'),
(17, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeCDiWoUtIaDP2CJJEJN7OchCWMZPIL.m', NULL, NULL, '2016-07-20 09:39:58', '2016-07-20 09:40:00'),
(18, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKewani32e5ZQxII/wY7qkkxCyvtvZQNiK', NULL, NULL, '2016-07-20 09:47:10', '2016-07-20 09:47:12'),
(19, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeRkzvaZ/CyiLIAXW3Ujz25KWRZeBXGAe', NULL, NULL, '2016-07-20 09:48:11', '2016-07-20 09:48:13'),
(20, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe.c5.dotydcu7JMcMbZwUP1rRq919TeO', NULL, NULL, '2016-07-20 09:50:14', '2016-07-20 09:50:15'),
(21, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeqSMAtXNxzj27V1nFxzPiWXlGzlUBWuO', NULL, NULL, '2016-07-20 09:55:49', '2016-07-20 09:55:50'),
(22, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeh/9znSM2grQAGl9c2YWN9aJr9i3MSLC', NULL, 4, '2016-07-20 09:56:45', '2016-07-20 09:56:47'),
(23, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKexTt6slF1YgjfHmq9IRYTYBhZweSHDpe', NULL, NULL, '2016-07-20 10:07:55', '2016-07-20 10:07:57'),
(24, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe5HiUnrBeBpi8fj4Y2EdZxKvClfZSTim', NULL, 5, '2016-07-20 10:14:13', '2016-07-20 10:14:15'),
(25, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe6y.RyCTYceKevFA.8ZH4cI62Ka1YVou', NULL, 6, '2016-07-20 10:14:46', '2016-07-20 10:14:48'),
(26, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeUeJ30AuX0eIE4Rxzq.rjGSTwBmNBjJ6', NULL, 7, '2016-07-20 10:17:34', '2016-07-20 10:17:36'),
(27, 1, '', '2016-07-19', NULL, '2016-07-20 10:21:48', '2016-07-20 10:26:34'),
(28, 1, '', '2016-07-19', NULL, '2016-07-20 10:33:44', '2016-07-20 10:42:58'),
(29, 1, '', '2016-07-21', NULL, '2016-07-20 11:47:06', '2016-07-20 11:48:00'),
(30, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeI7m1RMVmO6aPQqwGOtNRVisPRADgOO.', NULL, NULL, '2016-07-21 06:52:35', '2016-07-21 06:52:36'),
(31, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeRUE6DnzWUDjK8YFCWrPKuNVvpuoxzL6', NULL, NULL, '2016-07-21 10:37:05', '2016-07-21 10:37:05'),
(32, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKeOiP16zm6R.dwXoeblQa6eGKL4uNoCFK', NULL, NULL, '2016-07-21 10:39:01', '2016-07-21 10:39:01'),
(33, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKegwZnH2bsS5tPbZliY429vU/i/LlYu/C', NULL, NULL, '2016-07-21 10:39:44', '2016-07-21 10:39:45'),
(34, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe.saDVMBV9XXx7g3JPx.6hac0BwVFyiC', NULL, NULL, '2016-07-21 10:40:17', '2016-07-21 10:40:18'),
(35, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe4nDqlLashALGIMqHqOXKXVu4z6OMAea', NULL, NULL, '2016-07-21 10:42:41', '2016-07-21 10:42:41'),
(36, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKejKfCDrOPEdPNsbVfV9rX1p2O/0uAQ2y', NULL, NULL, '2016-07-21 10:44:47', '2016-07-21 10:44:48'),
(37, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKegnzRLuKPj3m.YGfiv26Fg9dYUHpqN4u', NULL, NULL, '2016-07-21 10:47:43', '2016-07-21 10:47:44'),
(38, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKekZEubrkvWvVqCz.PuTdINQBwk.IX7bK', NULL, NULL, '2016-07-21 10:48:31', '2016-07-21 10:48:31'),
(39, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKejV3v5tlPjjPhNX.vQ/9MP65ypMcQGgG', NULL, NULL, '2016-07-21 11:10:33', '2016-07-21 11:10:33'),
(40, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKenDyfhdgMFeCB88GLBmqh181WBySJFQK', NULL, NULL, '2016-07-21 11:12:46', '2016-07-21 11:12:47'),
(41, 1, '$2y$11$IUAjJCVeJiohQCMkJV4mKe10Z1M51qRaU4NtHWsIaGOnI2pnzyfuS', NULL, NULL, '2016-07-21 13:49:56', '2016-07-21 13:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `a0_cat`
--

CREATE TABLE IF NOT EXISTS `a0_cat` (
  `id_a0_cat` int(11) NOT NULL,
  `id_a0` int(11) NOT NULL,
  `type` enum('YQ-005','JPA-009','JECA-004') NOT NULL,
  `ref` enum('new','exist') NOT NULL DEFAULT 'new',
  `id_certificate` varchar(50) DEFAULT NULL,
  `status` enum('process','fail','success','remidial') NOT NULL DEFAULT 'process',
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a0_cat`
--

INSERT INTO `a0_cat` (`id_a0_cat`, `id_a0`, `type`, `ref`, `id_certificate`, `status`, `added_time`, `modified_time`, `last_updated_by`) VALUES
(1, 1, 'JECA-004', 'new', 'JECA-004/1', 'success', '2016-07-12 10:39:17', '2016-07-19 08:39:14', NULL),
(2, 1, 'YQ-005', 'new', 'YQ-005/1', 'success', '2016-07-12 10:39:17', '2016-07-20 05:09:20', NULL),
(3, 1, 'JPA-009', 'new', 'JPA-009/1', 'success', '2016-07-12 10:39:17', '2016-07-15 02:32:47', NULL),
(4, 2, 'JPA-009', 'new', NULL, 'process', '2016-07-12 10:43:40', '2016-07-12 10:43:40', NULL),
(5, 0, 'JPA-009', 'new', NULL, 'process', '2016-07-19 02:51:30', '2016-07-19 02:51:30', NULL),
(6, 0, 'JPA-009', 'new', NULL, 'process', '2016-07-19 02:51:30', '2016-07-19 02:51:30', NULL),
(7, 0, 'JPA-009', 'new', NULL, 'process', '2016-07-19 02:52:51', '2016-07-19 02:52:51', NULL),
(8, 3, 'JPA-009', 'new', NULL, 'process', '2016-07-19 03:20:55', '2016-07-19 03:20:55', NULL),
(9, 5, 'JPA-009', 'new', NULL, 'process', '2016-07-19 06:16:58', '2016-07-19 06:16:58', NULL),
(10, 6, 'JPA-009', 'new', NULL, 'process', '2016-07-19 06:20:52', '2016-07-19 06:20:52', NULL),
(13, 8, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 06:27:17', '2016-07-19 06:27:17', NULL),
(14, 9, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 06:28:42', '2016-07-19 06:28:42', NULL),
(15, 10, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 07:41:09', '2016-07-19 07:41:09', NULL),
(16, 11, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 08:02:32', '2016-07-19 08:02:32', NULL),
(17, 12, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 08:10:48', '2016-07-19 08:10:48', NULL),
(18, 13, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 08:16:31', '2016-07-19 08:16:31', NULL),
(19, 14, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 08:17:04', '2016-07-19 08:17:04', NULL),
(20, 15, 'JPA-009', 'exist', 'JPA-009/1', 'success', '2016-07-19 08:31:48', '2016-07-20 11:51:52', NULL),
(21, 16, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-19 08:36:50', '2016-07-19 08:36:50', NULL),
(22, 17, 'JECA-004', 'new', NULL, 'process', '2016-07-20 09:40:00', '2016-07-20 09:40:00', NULL),
(23, 21, 'JECA-004', 'new', NULL, 'process', '2016-07-20 09:55:50', '2016-07-20 09:55:50', NULL),
(24, 22, 'YQ-005', 'new', NULL, 'process', '2016-07-20 09:56:46', '2016-07-20 09:56:46', NULL),
(25, 22, 'JPA-009', 'new', NULL, 'process', '2016-07-20 09:56:46', '2016-07-20 09:56:46', NULL),
(26, 23, 'YQ-005', 'new', NULL, 'process', '2016-07-20 10:07:57', '2016-07-20 10:07:57', NULL),
(27, 24, 'JECA-004', 'new', NULL, 'process', '2016-07-20 10:14:15', '2016-07-20 10:14:15', NULL),
(28, 25, 'JECA-004', 'new', NULL, 'process', '2016-07-20 10:14:48', '2016-07-20 10:14:48', NULL),
(29, 26, 'JECA-004', 'new', 'JECA-004/3', 'success', '2016-07-20 10:17:36', '2016-07-20 10:48:54', NULL),
(30, 27, 'JECA-004', 'new', 'JECA-004/2', 'success', '2016-07-20 10:21:50', '2016-07-20 10:27:19', NULL),
(31, 28, 'JECA-004', 'exist', 'JECA-004/1', 'process', '2016-07-20 10:33:45', '2016-07-20 11:25:51', NULL),
(32, 29, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-20 11:47:08', '2016-07-20 11:47:08', NULL),
(33, 30, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-21 06:52:37', '2016-07-21 06:52:37', NULL),
(34, 31, 'YQ-005', 'exist', 'YQ-005/1', 'process', '2016-07-21 10:37:05', '2016-07-21 10:37:05', NULL),
(35, 32, 'YQ-005', 'exist', 'YQ-005/1', 'process', '2016-07-21 10:39:02', '2016-07-21 10:39:02', NULL),
(36, 33, 'JPA-009', 'exist', 'JPA-009/1', 'process', '2016-07-21 10:39:45', '2016-07-21 10:39:45', NULL),
(37, 34, 'JECA-004', 'exist', 'JECA-004/1', 'process', '2016-07-21 10:40:18', '2016-07-21 10:40:18', NULL),
(38, 35, 'YQ-005', 'exist', 'YQ-005/1', 'process', '2016-07-21 10:42:41', '2016-07-21 10:42:41', NULL),
(39, 36, 'YQ-005', 'exist', 'YQ-005/1', 'process', '2016-07-21 10:44:48', '2016-07-21 10:44:48', NULL),
(40, 37, 'JECA-004', 'exist', 'JECA-004/1', 'process', '2016-07-21 10:47:44', '2016-07-21 10:47:44', NULL),
(41, 38, 'JECA-004', 'exist', 'JECA-004/1', 'process', '2016-07-21 10:48:31', '2016-07-21 10:48:31', NULL),
(42, 39, 'JECA-004', 'exist', 'JECA-004/1', 'process', '2016-07-21 11:10:33', '2016-07-21 11:10:33', NULL),
(43, 40, 'YQ-005', 'exist', 'YQ-005/1', 'process', '2016-07-21 11:12:47', '2016-07-21 11:12:47', NULL),
(44, 41, 'JECA-004', 'exist', 'JECA-004/1', 'process', '2016-07-21 13:49:59', '2016-07-21 13:49:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assessment_collective`
--

CREATE TABLE IF NOT EXISTS `assessment_collective` (
  `id_assessment_group` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'bisa id_a0 atau rs',
  `type_schedule` set('new assessment','reassessment') NOT NULL DEFAULT 'new assessment',
  `coordinator_name` varchar(255) NOT NULL,
  `coordinator_email` varchar(255) NOT NULL,
  `collective_token` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auditor`
--

CREATE TABLE IF NOT EXISTS `auditor` (
  `id_auditor` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `birth_place` varchar(200) NOT NULL,
  `birth_date` date NOT NULL,
  `religion` enum('Islam','Kristen','Katolik','Hindu','Budha','Konghucu','Protestan') NOT NULL DEFAULT 'Islam',
  `address` text NOT NULL,
  `desa` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kabupaten` text NOT NULL,
  `kota` text NOT NULL,
  `provinsi` text NOT NULL,
  `postal` int(11) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL DEFAULT 'L',
  `npwp` varchar(50) NOT NULL,
  `martial_status` varchar(200) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `jabatan` int(11) NOT NULL,
  `auditor_added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `competency` text NOT NULL,
  `instansi` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1 COMMENT='!do not truncate';

--
-- Dumping data for table `auditor`
--

INSERT INTO `auditor` (`id_auditor`, `fullname`, `birth_place`, `birth_date`, `religion`, `address`, `desa`, `kecamatan`, `kabupaten`, `kota`, `provinsi`, `postal`, `gender`, `npwp`, `martial_status`, `telephone_number`, `phone_number`, `email`, `jabatan`, `auditor_added_time`, `competency`, `instansi`) VALUES
(1, 'Ir. Emiliana Kasmudjiastuti', 'Yogyakarta', '1956-01-05', 'Katolik', 'Jl. Panuluh 379 H Pringwulung, Kab. Sleman, Prop. DI Yogyakarta, RT. 014, RW.042, Kelurahan/Desa Condong Catur, Kecamatan Depok, Kab/Kota Kab. Sleman, D.I Yogyakarta', 'Condong catur', 'Depok', 'Sleman', 'Sleman', 'Yogyakarta', 55225, 'P', '05.380.085.0-542.000', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0l'),
(2, 'Sri Sutyasmi, S.T', 'Wonogiri', '1954-11-18', 'Islam', 'Rejowinangun, KG.I, 495A Yogyakarta, RT. 25, RW. 08', 'Rejowinangun', 'Kota Gede', 'Yogyakarta', 'Yogyakarta', 'D.I Yogyakarta', 55171, 'P', '58.709.571.2-541.000', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(3, 'Ir. Arum Yuniari', 'Surabaya', '1957-06-06', 'Protestan', 'Griya Purwa Asri B309 Kalasan Sleman Yogyakarta, RT. 12, RW.04', 'Purwomartani', 'Kalasan', 'Sleman', 'Sleman', 'D.I Yogyakarta', 0, 'P', '05.380.051.2-543.000', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(4, 'Ir. Nursamsi Sarengat', 'Wonosobo', '1951-07-01', 'Islam', 'Madusari, RT. 008, RW.03, ', 'Wonosari', 'Umbulharjo', 'Yogyakarta', 'Yogyakarta', 'D.I Yogyakarta', 0, 'L', '05.234.031.2-503.000', 'menikah', 'null', 'null', 'null', 1, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(5, 'Eko Sulistyo Wibowo, S.T.,M.Eng', 'Ngawi', '1983-08-06', 'Islam', 'Gedongan, RT. 03, RW. 04', 'Sinduadi', 'Mlati', 'Sleman', 'Sleman', 'D.I Yogyakarta', 55284, 'L', '89.988.808.5-646.000', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(6, 'Syaiful Harjanto, S.T.', 'Magelang', '1938-01-01', 'Islam', 'Niten, RT. 006, ', 'Tirtonirmolo', 'Kasihan', 'Bantul', 'Bantul', 'D.I Yogyakarta', 55181, 'L', '48.963.665.4.524.000', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(7, 'Tri Rahayu Setyo Utami, M.Eng', 'Pati', '1979-02-27', 'Islam', 'Taraman, RT.01, RW.01 ', 'Sinduharjo', 'Ngaglik', 'Sleman', 'Sleman', 'D.I Yogyakarta', 55581, 'P', '58.708.449.2-542.00', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(8, 'Christiana Maria Herry Purwanti, S.T.', 'Sleman', '1959-05-17', 'Katolik', 'Kronggahan, RT. 02, RW. 01,', 'Trihanggo', 'Gamping', 'Sleman', 'Sleman', 'D.I Yogyakarta', 55291, 'P', '58.709.611.6-542.000', 'menikah', 'null', 'null', 'null', 3, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(9, 'C. Yuwono Sumasto, S.T.', 'Yogyakarta', '1963-07-24', 'Katolik', 'Pugeran MJ 2-51, RT. 03, RW. 01,', 'Suryodiningrat', 'Mantrijeron', 'Yogyakarta', 'Yogyakarta', 'D.I Yogyakarta', 55144, 'L', '58.709.616.5-541.000', 'menikah', 'null', 'null', 'null', 1, '0000-00-00 00:00:00', 'LSSML (JECA)', '0'),
(10, 'Drs.Ir. Prayitno, Apt, M.Sc', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 1, '2016-06-16 15:46:25', 'LSSM (YOQA),LSPro (JPA)', '0'),
(11, 'Ir. Niken Karsiati', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 1, '2016-06-16 15:46:25', 'LSSM (YOQA),LSPro (JPA)', '0'),
(12, 'Ir. Valentina Sri Pertiwi Rumiyati, M.P', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 1, '2016-06-16 15:46:25', 'LSSM (YOQA),LSPro (JPA)', '0'),
(13, 'Ir. Dwi Wahini Nurhajati, M.Eng', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 1, '2016-06-16 15:46:25', 'LSSM (YOQA),LSPro (JPA)', '0'),
(14, 'Satija, M.Si', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 1, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(15, 'R. Jaka Susila, B.Sc,ST', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 1, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(16, 'Ir. Meiyanti', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 2, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(17, 'Dra. Supraptiningsih, M.Si.', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 2, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(18, 'Dra. Murwati', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 2, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(19, 'Sri Waskito, SE', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(20, 'Ir. Emi Sulistyo Astuti, MP', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(21, 'Widodo, BSc, S.Sos', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:26', 'LSSM (YOQA),LSPro (JPA)', '0'),
(22, 'Heru Budi Susanto, S.E, M.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(23, 'Siti Azizah Wahyuni, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(24, 'Hastungkara Wijaya Wardani, S.H', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(25, 'Rihastiwi Setiya Murti, S.Si', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(26, 'Ir. Widari', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(27, 'Budiwiyono, S.Kom', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(28, 'M. Endang Titiek W., B.Sc, S.Pd', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(29, 'Dini Noor Hidayah, S.Ip', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(30, 'Rambat, M.Sc', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(31, 'Dwi Ningsih, S.T., M.Si., M.Ale', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(32, 'Ike Setyorini, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(33, 'Aulia Muhammad, S.E', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(34, 'Rangga Kistiwoyo, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(35, 'Dona Rahmawati, S.Tp', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(36, 'Siti Muhalimah, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:27', 'LSSM (YOQA),LSPro (JPA)', '0'),
(37, 'Wahyu Pradana Arsitika, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:28', 'LSSM (YOQA),LSPro (JPA)', '0'),
(38, 'Dodi Irwanto, M.Eng', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:28', 'LSSM (YOQA),LSPro (JPA)', '0'),
(39, 'Indiah Ratna Dewi, S.Si', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:28', 'LSSM (YOQA),LSPro (JPA)', '0'),
(40, 'Haris Nur Salam, A.Md, S.Pd', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:28', 'LSSM (YOQA),LSPro (JPA)', '0'),
(41, 'YB Agung Adhi Nugroho', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 3, '2016-06-16 15:46:28', 'LSSM (YOQA),LSPro (JPA)', '0'),
(42, 'Widodo, B.Sc, S.Sos', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:26', '', 'BBKKP'),
(43, 'Supriyadi, S.E', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:26', '', 'BBKKP'),
(44, 'Subandriyo, S.E', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(45, 'Christiana Maria Herry Purwanti, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(46, 'Lourentius Triyono', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(47, 'Sugeng', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(48, 'Marcus Rahna Nurhandaru, A.Md', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(49, 'Thomas Tukirin, A.Md', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(50, 'Aprial Purwanto, A.Md', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(51, 'Agung Nugroho', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(52, 'Yuno Ardianto, S.H', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:27', '', 'BBKKP'),
(53, 'Indriyana Prastiwi Hariyani, S.T', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBKKP'),
(54, 'Vita Kurniawati, A.Md', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBKKP'),
(55, 'Paino', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBKKP'),
(56, 'Asep Suhendi', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBIA'),
(57, 'Indera Wirawan', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBIA'),
(58, 'Rika Firmansyah, S.Si', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBIA'),
(59, 'Sri Harjanto', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBIA'),
(60, 'Drs. Solechan', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'BBIA'),
(61, 'Darmawi', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'Kalimantan Barat'),
(62, 'Suma Warukiza', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'Kalimantan Barat'),
(63, 'Bagus Edi Suwarno', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'Kalimantan Selatan'),
(64, 'Nurhalipah', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'Kalimantan Selatan'),
(65, 'RO Suharianti', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:28', '', 'Kalimantan Selatan'),
(66, 'Suyatno', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'Kalimantan Selatan'),
(67, 'Haga Taruna Ratih', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'Kalimantan Tengah'),
(68, 'Muhammadsyah', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'PT. Batanghari Barisan'),
(69, 'Budi Hendriyanto', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'PT. Famili Raya'),
(70, 'Andre Sutrisno', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'PT. Teluk Luas'),
(71, 'Hidayat', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'Jambi'),
(72, 'Afrinal', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'Medan'),
(73, 'Ponimin', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'Medan'),
(74, 'Angga Novi Reza', '', '0000-00-00', 'Islam', '', '', '', '', '', '', NULL, 'L', '', '', '', '', '', 5, '2016-06-16 16:22:29', '', 'Riau');

-- --------------------------------------------------------

--
-- Table structure for table `auditor_log`
--

CREATE TABLE IF NOT EXISTS `auditor_log` (
  `auditor_log_id` int(11) NOT NULL,
  `id_auditor` int(11) NOT NULL,
  `auditor_as` varchar(200) NOT NULL COMMENT 'id jabatan | current jabatan auditor',
  `id_assessment` int(11) NOT NULL COMMENT 'assessment = id_a0 | reassessment = id_rs',
  `assessment_type` enum('assessment','reassessment') NOT NULL DEFAULT 'assessment',
  `auditor_log_timeadd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auditor_log`
--

INSERT INTO `auditor_log` (`auditor_log_id`, `id_auditor`, `auditor_as`, `id_assessment`, `assessment_type`, `auditor_log_timeadd`) VALUES
(4, 4, '1', 1, 'assessment', '2016-07-24 07:44:36'),
(5, 1, '3', 2, 'assessment', '2016-07-12 13:03:10'),
(6, 2, '3', 2, 'assessment', '2016-07-12 13:03:10'),
(7, 3, '3', 2, 'assessment', '2016-07-12 13:03:10'),
(8, 5, '3', 2, 'assessment', '2016-07-12 13:03:10'),
(9, 4, '1', 1, 'assessment', '2016-07-13 07:26:03'),
(10, 1, '3', 1, 'assessment', '2016-07-13 07:26:03'),
(11, 42, '5', 1, 'assessment', '2016-07-13 07:26:03'),
(12, 2, '3', 1, 'assessment', '2016-07-20 10:26:21'),
(13, 43, '5', 1, 'assessment', '2016-07-20 10:26:21'),
(14, 4, '1', 27, 'assessment', '2016-07-20 10:26:21'),
(15, 1, '3', 27, 'assessment', '2016-07-20 10:26:22'),
(16, 2, '3', 27, 'assessment', '2016-07-20 10:26:22'),
(17, 43, '5', 27, 'assessment', '2016-07-20 10:26:22'),
(18, 42, '5', 27, 'assessment', '2016-07-20 10:44:39'),
(19, 4, '1', 28, 'assessment', '2016-07-20 10:44:39'),
(20, 1, '3', 28, 'assessment', '2016-07-20 10:44:39'),
(21, 2, '3', 28, 'assessment', '2016-07-20 10:44:39'),
(22, 42, '5', 28, 'assessment', '2016-07-20 10:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `auditor_riwayat_kegiatan`
--

CREATE TABLE IF NOT EXISTS `auditor_riwayat_kegiatan` (
  `id_auditor_riwayat_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `penyelenggara` text NOT NULL COMMENT 'value : instansi / negara. lebih dari 1 pisahkan dengan ;',
  `type_kegiatan` enum('pelatihan','seminar') NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auditor_riwayat_pendidikan`
--

CREATE TABLE IF NOT EXISTS `auditor_riwayat_pendidikan` (
  `id_riwayat_pendidikan_auditor` int(11) NOT NULL,
  `id_auditor` int(11) NOT NULL,
  `pendidikan_formal` varchar(200) NOT NULL,
  `jurusan` text NOT NULL,
  `tahun_lulus` date NOT NULL,
  `jenjang` varchar(200) NOT NULL,
  `timestamp_add_riwayat_pendidikan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auditor_riwayat_pendidikan`
--

INSERT INTO `auditor_riwayat_pendidikan` (`id_riwayat_pendidikan_auditor`, `id_auditor`, `pendidikan_formal`, `jurusan`, `tahun_lulus`, `jenjang`, `timestamp_add_riwayat_pendidikan`) VALUES
(2, 4, 'Universitas Gadjah Mada', 'Teknologi Pertanian', '1981-10-09', 'Sarjana', '2016-07-22 12:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id_brand` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_commodity` int(11) DEFAULT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `id_company`, `id_commodity`, `brand_name`, `brand_added_on`) VALUES
(1, 1, 0, 'Kakikukaku', '2016-07-12 10:39:17'),
(2, 4, 0, 'Kakakukiko', '2016-07-12 10:43:40'),
(3, 1, 0, 'Baju Kokopandan', '2016-07-19 03:20:55'),
(4, 1, 0, 'efwefsdf', '2016-07-19 06:20:52'),
(5, 1, 0, 'fghfgh', '2016-07-19 06:20:52'),
(6, 1, 0, 'efwefsdf', '2016-07-19 06:24:55'),
(7, 1, 0, 'fghfgh', '2016-07-19 06:24:55'),
(8, 1, 0, 'efwefsdf', '2016-07-19 06:27:17'),
(9, 1, 0, 'fghfgh', '2016-07-19 06:27:17'),
(10, 1, 0, 'efwefsdf', '2016-07-19 06:28:42'),
(11, 1, 0, 'fghfgh', '2016-07-19 06:28:42'),
(12, 1, 0, 'wewefwdsasdasd', '2016-07-19 07:41:08'),
(13, 1, 0, 'wewefwdsasdasd', '2016-07-19 08:02:32'),
(14, 1, 0, 'wewefwdsasdasd', '2016-07-19 08:10:47'),
(15, 1, 0, 'wewefwdsasdasd', '2016-07-19 08:16:31'),
(16, 1, 0, 'wewefwdsasdasd', '2016-07-19 08:17:04'),
(17, 1, 0, 'wewefwdsasdasd', '2016-07-19 08:31:47'),
(18, 1, 0, 'wewefwdsasdasd', '2016-07-19 08:36:49'),
(19, 1, 0, 'terterfsdf', '2016-07-20 09:56:46'),
(20, 1, 0, 'karajungan', '2016-07-20 11:47:08'),
(21, 1, 0, 'sasarean', '2016-07-20 11:47:08'),
(22, 1, 0, 'kamisama', '2016-07-21 06:52:36'),
(23, 1, 0, 'asdwefwefwef', '2016-07-21 10:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `id_certificate` varchar(200) NOT NULL,
  `id_a0_cat` int(11) NOT NULL,
  `certificate_status` enum('active','revoke','icebox','resign') NOT NULL DEFAULT 'active',
  `certificate_note` mediumtext NOT NULL COMMENT 'ditulis saat revoke dan lain2',
  `certificate_md5` varchar(50) NOT NULL,
  `certificate_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id_certificate`, `id_a0_cat`, `certificate_status`, `certificate_note`, `certificate_md5`, `certificate_timestamp`) VALUES
('JECA-004/1', 1, 'active', '', 'e1e5a03bb920e86183332e1798a4bd05', '2016-07-19 08:39:14'),
('JECA-004/2', 30, 'active', '', 'bdb0baaf11f5b8e58df0842241b39ee6', '2016-07-20 10:27:19'),
('JECA-004/3', 29, 'active', '', 'df59e966a231c43ce8c7afa9325e803d', '2016-07-20 10:48:54'),
('JPA-009/1', 3, 'active', '', '5e45d0b30a386155c6807f5096c2029f', '2016-07-18 04:20:05'),
('YQ-005/1', 2, 'active', '', '9a29e1b2dc7117f4754848a171871a65', '2016-07-20 05:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `certification_category`
--

CREATE TABLE IF NOT EXISTS `certification_category` (
  `audit_reference` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `use_period` int(4) NOT NULL COMMENT 'in month',
  `resurvey_attempt` int(4) NOT NULL COMMENT 'in times',
  `grace_period` int(4) NOT NULL COMMENT 'in month',
  `expired_period` int(20) NOT NULL DEFAULT '15' COMMENT 'in days',
  `type` enum('YQ-005','JPA-009','JECA-004') NOT NULL,
  `certification_description` text NOT NULL,
  `certificate_title` text NOT NULL,
  `certificate_note` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COMMENT='!do not truncate';

--
-- Dumping data for table `certification_category`
--

INSERT INTO `certification_category` (`audit_reference`, `name`, `use_period`, `resurvey_attempt`, `grace_period`, `expired_period`, `type`, `certification_description`, `certificate_title`, `certificate_note`) VALUES
(1, 'ISO 2001:1990', 36, 4, 4, 15, 'YQ-005', '', '', ''),
(2, 'ISO 9001:2002', 24, 3, 3, 15, 'YQ-005', '', '', ''),
(3, 'SNI 1:2001', 60, 2, 2, 15, 'JPA-009', '', '', ''),
(4, 'ISO 4005:3220', 24, 5, 3, 15, 'YQ-005', '', '', ''),
(5, 'ISO 3003:2002', 45, 3, 3, 15, 'YQ-005', '', '', ''),
(6, 'ISO 5004:7001', 30, 10, 2, 15, 'YQ-005', '', '', ''),
(7, 'JECA 14000:2001', 40, 20, 1, 15, 'JECA-004', '', '', ''),
(8, 'SNI 0191:2003', 60, 2, 2, 15, 'JPA-009', '', '', ''),
(9, 'SNI 1001:2000', 60, 2, 2, 15, 'JPA-009', '', '', ''),
(10, 'SNI 1811:2007/Amd1:2010', 24, 4, 2, 15, 'JPA-009', '', 'Helm pengendara kendaraan bermotor roda dua untuk umum', ''),
(11, 'SNI 7037:2009', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu pengaman dari kulit dengan sistem Goodyear welt', ''),
(12, 'SNI 7079:2009', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu pengaman dari kulit dengan Sol poliuretan dan termoplastik poliuretan sistem cetak injeksi', ''),
(13, 'SNI 0111:2009', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu pengaman dari kulit dengan Sol karet cetak vulkanisasi', ''),
(14, 'SNI 12-1848-2006', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu Bot PVC', ''),
(15, 'SNI 12-1548-1989', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu bot PVC cetak tahan minyak dan lemak', ''),
(16, 'SNI 12-1547-2005', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu bot PVC tahan kimia', ''),
(17, 'SNI 7276:2008', 24, 4, 2, 15, 'JPA-009', '', 'Tangki silinder vertikal (PE)', ''),
(18, 'SNI 3747:2013', 24, 4, 2, 15, 'JPA-009', '', 'Kakao bubuk', ''),
(19, 'SNI 2907:2008', 24, 4, 2, 15, 'JPA-009', '', 'Biji Kopi', ''),
(20, 'SNI 01-3553-2006', 24, 4, 2, 15, 'JPA-009', '', 'Air Minum dalam kemasan', ''),
(21, 'SNI 3140.3:2010/Amd1:2011', 24, 4, 2, 15, 'JPA-009', '', 'Gula Kristal - Bagian 3: Putih', ''),
(22, 'SNI 06-1903-2000', 24, 4, 2, 15, 'JPA-009', '', 'Standar Indonesian Rubber', 'SIR 10,SIR 20'),
(23, 'SNI 06-1903-2011', 24, 4, 2, 15, 'JPA-009', '', 'Karet Spesifikasi Teknis', ''),
(24, 'SNI 06-7213-2006/Amd1:2008', 24, 4, 2, 15, 'JPA-009', '', 'Selang Karet untuk kompor gas LPG', ''),
(25, 'SNI 1843:2008/Amd1:2011', 24, 4, 2, 15, 'JPA-009', '', 'Rol karet pengupas gabah', ''),
(26, 'SNI 06-0001-1987', 24, 4, 2, 15, 'JPA-009', '', 'Karet Konvensional', ''),
(27, 'SNI 7655:2010', 24, 4, 2, 15, 'JPA-009', '', 'Rubber Seal- Karet perapat pada katup tabung LPG', ''),
(28, 'SNI 2582:2010', 24, 4, 2, 15, 'JPA-009', '', 'Terpal plastik untuk biji-bijian produk pertanian', ''),
(29, 'SNI 19-0057-1998', 24, 4, 2, 15, 'JPA-009', '', 'karung tenun plastik poliolefin', ''),
(30, 'SNI 7322:2008', 24, 4, 2, 15, 'JPA-009', '', 'produk melamin - perlengkapan makanan dan minuman', ''),
(31, 'SNI 0778:2009', 24, 4, 2, 15, 'JPA-009', '', 'sol karet cetak', ''),
(32, 'SNI 06-0084-2002', 24, 4, 2, 15, 'JPA-009', '', 'pipa PVC untuk saluran air minum', ''),
(33, 'SNI 0098:2012', 24, 4, 2, 15, 'JPA-009', '', 'ban mobil penumpang', '14-23,23-30'),
(34, 'SNI 0099:2012', 24, 4, 2, 15, 'JPA-009', '', 'ban truk dan bus', '14-23,23-31'),
(35, 'SNI 0100:2012', 24, 4, 2, 15, 'JPA-009', '', 'ban truk ringan', '14-23,23-32'),
(36, 'SNI 0101:2012', 24, 4, 2, 15, 'JPA-009', '', 'ban sepeda motor', '14-23,23-33'),
(37, 'SNI 6700:2012', 24, 4, 2, 15, 'JPA-009', '', 'ban dalam kendaraan bermotor', '14-23,23-34'),
(38, 'SNI 2942. 1:2009', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu - kulit sistem lem - Bagian 1 - Wanita', '14-23,23-35'),
(39, 'SNI 2942. 2:2009', 24, 4, 2, 15, 'JPA-009', '', 'Sepatu - kulit sistem lem - Bagian 2 - Pria', '14-23,23-36');

-- --------------------------------------------------------

--
-- Table structure for table `certification_request`
--

CREATE TABLE IF NOT EXISTS `certification_request` (
  `id_certification_request` int(11) NOT NULL,
  `audit_reference` varchar(100) NOT NULL,
  `id_a0_cat` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL DEFAULT '0',
  `scope` varchar(200) NOT NULL,
  `nace` varchar(200) NOT NULL,
  `product_line` varchar(200) NOT NULL,
  `id_lampiran` int(11) DEFAULT NULL COMMENT 'lokasi lampiran perusahaan yang mengusung',
  `revoke_request` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certification_request`
--

INSERT INTO `certification_request` (`id_certification_request`, `audit_reference`, `id_a0_cat`, `id_brand`, `scope`, `nace`, `product_line`, `id_lampiran`, `revoke_request`) VALUES
(1, '7', 1, 0, '2', '', '', NULL, 0),
(2, '1', 2, 0, '1', '10.11.1', '8', NULL, 0),
(3, '18', 3, 1, '1', '10.11.1,10.11.2', '5', NULL, 0),
(4, '38', 4, 2, '3', '19.10.1', '24', NULL, 0),
(5, '11', 5, 0, '1', '', '2', NULL, 0),
(6, '', 20, 17, '4', '', '', NULL, 0),
(7, '20', 21, 18, '4', '', '7', NULL, 0),
(8, '7', 22, 0, '1,5', '', '', NULL, 0),
(9, '7', 23, 0, '1,2', '', '', NULL, 0),
(10, '1,2', 24, 0, '1', '', '', NULL, 0),
(11, '10', 25, 19, '1', '', '1', NULL, 0),
(12, '1', 26, 0, '1,2,5,4', '', '4', NULL, 0),
(13, '7', 27, 0, '1,2', '', '', NULL, 0),
(14, '7', 28, 0, '1,2', '', '', NULL, 0),
(15, '7', 29, 0, '1,2', '', '', NULL, 0),
(16, '7', 30, 0, '1,2', '', '', NULL, 0),
(17, '7', 31, 0, '1,2', '', '', NULL, 0),
(18, '10', 32, 20, '1', '', '1', NULL, 0),
(19, '10', 32, 21, '1', '', '1', NULL, 0),
(20, '', 36, 23, '', '', '', 2, 0),
(21, '', 43, 0, '', '12.00.1,13.10.1,13.10.2', '', NULL, 0),
(22, '', 44, 0, '', '', '8', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `certification_type`
--

CREATE TABLE IF NOT EXISTS `certification_type` (
  `use_period` int(4) NOT NULL COMMENT 'in month',
  `resurvey_attempt` int(4) NOT NULL COMMENT 'in times',
  `grace_period` int(4) NOT NULL COMMENT 'in month',
  `expired_period` int(20) NOT NULL DEFAULT '15' COMMENT 'in days',
  `type` enum('YQ-005','JPA-009','JECA-004') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='!do not truncate';

--
-- Dumping data for table `certification_type`
--

INSERT INTO `certification_type` (`use_period`, `resurvey_attempt`, `grace_period`, `expired_period`, `type`) VALUES
(24, 3, 3, 15, 'YQ-005'),
(36, 4, 10, 15, 'JPA-009'),
(24, 3, 10, 15, 'JECA-004');

-- --------------------------------------------------------

--
-- Table structure for table `commodity`
--

CREATE TABLE IF NOT EXISTS `commodity` (
  `id_commodity` int(11) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `commodity_added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subcommodity` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Ruang lingkup';

--
-- Dumping data for table `commodity`
--

INSERT INTO `commodity` (`id_commodity`, `commodity_name`, `commodity_added_time`, `subcommodity`) VALUES
(1, 'Industri kulit dan produk kulit', '2016-06-03 06:12:52', 'SIR 3,SIR 5,SIR 10'),
(2, 'Produk Karet dan plastik', '2016-06-03 06:12:52', 'Kain Sutera,Kain Blacu,Kain Satin'),
(3, 'Kimia, produk kimia dan serat', '2016-06-03 06:17:00', ''),
(4, 'Tekstil dan produk tekstil', '2016-06-03 06:17:00', 'Air Embun,Air Hujan'),
(5, 'Kelompok pabrik lain', '2016-06-16 17:09:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id_company` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `country_code` int(11) NOT NULL,
  `company_address` text NOT NULL,
  `company_post` text NOT NULL,
  `company_region` text NOT NULL COMMENT 'provinsi, kota / kabupaten(subdistrict)',
  `company_reference_number` varchar(10) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `company_fax` varchar(20) NOT NULL,
  `company_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_hash` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_company`, `company_name`, `country_code`, `company_address`, `company_post`, `company_region`, `company_reference_number`, `telephone`, `email`, `company_fax`, `company_added_on`, `company_hash`) VALUES
(1, 'PT. Tahu Bulat', 3, 'Jogja', '12345', '', '', '', 'dhoni.p.saputra@gmail.com', '85736911759', '2016-06-29 16:17:52', ''),
(2, 'PT. Tahu Kotak', 3, 'Jl. Mantingan Pandean, Km.01 Ngelo Jatimulyo\nMantingan', '63257', '', '', '', 'dhoni.p.saputra@gmail.com', '85736911759', '2016-06-30 18:26:57', ''),
(3, 'Company C', 3, 'Jalan C, No. C3, Kecamatan C, Kabupaten C, Kota C, C, Indonesia', 'C123413', '', '', '', 'C.Company@c.com', '857893871', '2016-07-06 03:55:23', ''),
(4, 'Cplusco Machine', 3, 'Semarang', '38234', '', '', '', 'dellacroug@gmail.com', '85736911759', '2016-07-12 04:24:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_contact`
--

CREATE TABLE IF NOT EXISTS `company_contact` (
  `id_company` int(11) NOT NULL,
  `contact_name` varchar(200) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `contact_added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contact_updated_by` int(11) DEFAULT NULL,
  `contact_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_contact`
--

INSERT INTO `company_contact` (`id_company`, `contact_name`, `contact_number`, `ext`, `contact_added_time`, `contact_updated_by`, `contact_updated_at`) VALUES
(1, 'Dhoni', '85736911759', '', '2016-06-29 16:17:52', NULL, '2016-06-29 16:17:52'),
(2, 'Dhoni', '85736911759', '1', '2016-06-30 18:26:58', NULL, '2016-06-30 18:26:58'),
(3, 'C Company ', '62857893871', '1', '2016-07-06 03:55:23', NULL, '2016-07-06 03:55:23'),
(4, 'Dhoni', '085736911759', '', '2016-07-12 04:24:39', NULL, '2016-07-12 04:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id_country` int(11) NOT NULL,
  `country_name` text NOT NULL,
  `capital` text NOT NULL,
  `region` enum('asia','africa','europe') NOT NULL,
  `subregion` enum('South-Eastern Asia') NOT NULL,
  `callingCodes` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id_country`, `country_name`, `capital`, `region`, `subregion`, `callingCodes`) VALUES
(1, 'Brunei', 'Bandar Seri Begawan', 'asia', 'South-Eastern Asia', 673),
(2, 'Cambodia', 'Phnom Penh', 'asia', 'South-Eastern Asia', 855),
(3, 'Indonesia', 'Jakarta', 'asia', 'South-Eastern Asia', 62),
(4, 'Laos', 'Vientiane', 'asia', 'South-Eastern Asia', 856),
(5, 'Malaysia', 'Kuala Lumpur', 'asia', 'South-Eastern Asia', 60),
(6, 'Myanmar', 'Naypyidaw', 'asia', 'South-Eastern Asia', 95),
(7, 'Philippines', 'Manila', 'asia', 'South-Eastern Asia', 63),
(8, 'Singapore', 'Singapore', 'asia', 'South-Eastern Asia', 65),
(9, 'Thailand', 'Bangkok', 'asia', 'South-Eastern Asia', 66),
(10, 'East Timor', 'Dili', 'asia', 'South-Eastern Asia', 670),
(11, 'Vietnam', 'Hanoi', 'asia', 'South-Eastern Asia', 84);

-- --------------------------------------------------------

--
-- Table structure for table `email_log`
--

CREATE TABLE IF NOT EXISTS `email_log` (
  `email_log_id` int(11) NOT NULL,
  `email_recipients` text NOT NULL,
  `email_subject` text NOT NULL,
  `email_text` longtext NOT NULL,
  `email_sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_log`
--

INSERT INTO `email_log` (`email_log_id`, `email_recipients`, `email_subject`, `email_text`, `email_sent_at`) VALUES
(1, 'dhoni.p.saputra@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan PT. Tahu Bulat.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/1/IUAjJCVeJiohQCMkJV4mKe%7C%7CXathBH3oYi7Pxluia0BR40HDc6CfNa" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-12 10:39:17'),
(2, 'dellacroug@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan Cplusco Machine.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/2/IUAjJCVeJiohQCMkJV4mKeJAqDCg39T6TROA.Iwq5XvzcZhEMBuj6" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-12 10:43:40'),
(3, 'dhoni.p.saputra@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan PT. Tahu Bulat.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/3/IUAjJCVeJiohQCMkJV4mKeRdhShtYJtbD2U9xEmc4pJ%7C%7CyMizNRkIu" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-19 03:20:56'),
(4, 'dhoni.p.saputra@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan PT. Tahu Bulat.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/22/IUAjJCVeJiohQCMkJV4mKeh%7C%7C9znSM2grQAGl9c2YWN9aJr9i3MSLC" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-20 09:56:47'),
(5, 'dhoni.p.saputra@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan PT. Tahu Bulat.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/24" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-20 10:14:15'),
(6, 'dhoni.p.saputra@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan PT. Tahu Bulat.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/25" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-20 10:14:48'),
(7, 'dhoni.p.saputra@gmail.com', 'Confirmation Assessment date', '<div class="display:inline;">\r\nHallo, Perusahaan PT. Tahu Bulat.<br>\r\nKami Mendapatkan pemberitahuan bahwa perusahaan anda telah mengajukan peninjauan sertifikasi kepada kami.\r\nRincian permintaan terdapat pada attachment.\r\n\r\nJika perusahaan anda memang mengajukannya, permintaan anda telah kami terima dan sedang kami pelajari. \r\n<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan sertifikasi dengan menuju tautan di bawah ini. </p>\r\n</div>\r\n<div style="display:inline;"> \r\n	<a href="http://localhost/projects/yoqa/assessment/confirmation/26" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Assessment</a>\r\n</div>\r\n<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>\r\n', '2016-07-20 10:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE IF NOT EXISTS `issued` (
  `id_issued` int(11) NOT NULL,
  `id_certificate` varchar(200) NOT NULL,
  `issued_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issued`
--

INSERT INTO `issued` (`id_issued`, `id_certificate`, `issued_date`) VALUES
(1, 'JPA-009/1', '2016-07-15'),
(2, 'JECA-004/1', '2016-07-19'),
(3, 'YQ-005/1', '2016-07-20'),
(4, 'JECA-004/2', '2016-07-20'),
(5, 'JECA-004/3', '2016-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Lead (aktif)'),
(2, 'Lead (purna)'),
(3, 'senior'),
(4, 'junior'),
(5, 'PPC');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE IF NOT EXISTS `lampiran` (
  `id_lampiran` int(11) NOT NULL,
  `content_lampiran` longtext NOT NULL,
  `id_files` text NOT NULL,
  `timestamp_lampiran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lampiran_token` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lampiran`
--

INSERT INTO `lampiran` (`id_lampiran`, `content_lampiran`, `id_files`, `timestamp_lampiran`, `lampiran_token`) VALUES
(1, '<p>qwdqwdqwdqd</p>\n', '', '2016-07-21 06:52:37', ''),
(2, '', '', '2016-07-21 10:39:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_files`
--

CREATE TABLE IF NOT EXISTS `master_files` (
  `file_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `raw_name` text NOT NULL,
  `original_name` text NOT NULL,
  `client_name` text NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `file_size` float NOT NULL,
  `file_upload_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_files`
--

INSERT INTO `master_files` (`file_id`, `file_name`, `file_type`, `file_path`, `raw_name`, `original_name`, `client_name`, `file_ext`, `file_size`, `file_upload_timestamp`) VALUES
(1, 'da578c97f6f9f36516c8dfe77f46a3cc.jpg', 'image/jpeg', 'C:/xampp/htdocs/projects/yoqa/application/clients/1/files/', 'da578c97f6f9f36516c8dfe77f46a3cc', 'nisekoi_ichijou_pendant_by_atashinchiii-d7sqv56.jpg', 'nisekoi_ichijou_pendant_by_atashinchiii-d7sqv56.jpg', '.jpg', 82, '2016-07-14 11:59:11'),
(2, '88be77a23e693f76ed34fa6a861fbef0.jpg', 'image/jpeg', 'C:/xampp/htdocs/projects/yoqa/application/clients/1/files/', '88be77a23e693f76ed34fa6a861fbef0', '67d9c3a4141682399311165048_700w_0.jpg', '67d9c3a4141682399311165048_700w_0.jpg', '.jpg', 8, '2016-07-14 12:01:32'),
(3, 'bbe88ff3d27bbf08fa01363dd80f18bc.jpg', 'image/jpeg', 'C:/xampp/htdocs/projects/yoqa/application/clients/1/files/', 'bbe88ff3d27bbf08fa01363dd80f18bc', '6d2.jpg', '6d2.jpg', '.jpg', 49, '2016-07-15 02:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `nace`
--

CREATE TABLE IF NOT EXISTS `nace` (
  `nace_item` varchar(200) NOT NULL,
  `nace_parent` varchar(200) NOT NULL,
  `nace_name` text NOT NULL,
  `nace_type` varchar(100) NOT NULL,
  `nace_added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nace_edited_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nace`
--

INSERT INTO `nace` (`nace_item`, `nace_parent`, `nace_name`, `nace_type`, `nace_added_time`, `nace_edited_time`) VALUES
('10', '0', 'Manufacture of food products', 'nace_category', '2016-06-24 01:15:54', '2016-06-24 01:15:54'),
('10.1', '10', 'processing and preserving of meat and production of meat products', 'nace_subcategory', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('10.11', '10.1', 'processing and preserving of meat', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.11.1', '10.11', 'production of fresh, chilled or frozen meat', 'nace_item', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('10.11.2', '10.11', 'production and drying of hides, skins and pulled wool', 'nace_item', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('10.12', '10.1', 'processing and preserving of poultry meat', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.12.1', '10.12', 'production and preserving of poultry meat', 'nace_item', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('10.13', '10.1', 'production of meat and pultry meat products', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.13.1', '10.13', 'production of meat and pultry meat products', 'nace_item', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('10.2', '10', 'processing and preserving of fish, crustaceans and molluscs', 'nace_subcategory', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('10.20', '10.2', 'processing and preserving of fish, crustaceans and molluscs', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.20.1', '10.20', 'production and preserving of fish, crustaceans and molluscs', 'nace_item', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('10.3', '10', 'processing and preserving of fruit and vegetables', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.31', '10.3', 'processing and preserving of potatoes', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.31.1', '10.31', 'processing and preserving of potatoes', 'nace_item', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('10.31.2', '10.31', 'manufacture of potatoes chips and other snacks', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.32', '10.3', 'manufacture of fruit and vegetable juice', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.32.1', '10.32', 'manufacture of fruit and vegetable juice (incl. fruit drinks and nectars)', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.39', '10.3', 'other processing and preserving of fruit and vegetables', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.39.1', '10.39', 'processing and preserving of fruit and vegetables n.e.c', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.39.2', '10.39', 'processing of nuts', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.4', '10', 'manufacture of vegetable and animal oils and fats', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.41', '10.4', 'manufacture of olis and fats', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.41.1', '10.41', 'production of crude olive oil', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.41.2', '10.41', 'production of refined olive-oil', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.41.3', '10.41', 'production of other crude vegetable oils', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.41.4', '10.41', 'production of other refined vegetable oils', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.42', '10.4', 'manufacture of margarine and similar edible fats', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.42.1', '10.42', 'manufacture of margarine and similar edible fats', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.5', '10', 'manufacture of dairy products', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.51', '10.5', 'operation of dairies and cheese making', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.51.1', '10.51', 'production of pasteurised milk, milk cream and butter', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.51.2', '10.51', 'production of cheese and curd', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.51.3', '10.51', 'production of dairy products n.e.c (incl. yoghurt)', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.52', '10.5', 'manufacture of ice cream', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.52.1', '10.52', 'production of ice cream and other edible ice', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.6', '10', 'manufacture of grain mill products, starches and stach products', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.61', '10.6', 'Manufacture of grain mill products', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.61.1', '10.61', 'production of flour from cereals and vegetables', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.61.2', '10.61', 'production of other grain mill products (e.g. groats)', 'nace_item', '2016-06-24 01:16:06', '2016-06-24 01:16:06'),
('10.62', '10.6', 'manufacture if starches and starch products', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.62.1', '10.62', 'manufacture of starches and starch products', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.7', '10', 'manufacture of bakery and farinaceous products', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.71', '10.7', 'manufacture of bread; manufacture of fresh pastry goods and cakes', 'nace_sub_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('10.71.1', '10.71', 'manufacture of bread and rolls', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.71.2', '10.71', 'manufacture of fresh pastry goods and cakes', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.72', '10.7', 'manufacture of rusks and biscuits; manufacture of preserved pastry goods and cakes', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.72.1', '10.72', 'manufacture of rusks and biscuits and "dry" bakery products', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.72.2', '10.72', 'manufacture of preserved pastry goods and cakes', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.72.3', '10.72', 'manufacture of snack products whether sweet or salted', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.73', '10.7', 'manufacture if macaroni, noodles, couscous and similar farinaceous products', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.73.1', '10.73', 'manufacture of macaroni, noodles, couscous and similar farinaceous products', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.8', '10', 'manufacture of other food products', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.81', '10.8', 'manufacture of sugar', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.81.1', '10.81', 'manufacture of sugar', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.82', '10.8', 'manufacture of cocoa, chocolate and sugar confectionery', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.82.1', '10.82', 'manufacture of cocoa, chocolate, chocolate confectionery and sugar confectionery', 'nace_item', '2016-06-24 01:16:07', '2016-06-24 01:16:07'),
('10.83', '10.8', 'processing of tea and cofee', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.83.1', '10.83', 'processing and packing of coffee and tea. production of coffee products and herb infusions', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('10.84', '10.8', 'manufacture of condiments and seasonings', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.84.1', '10.84', 'manufacture of spices, suces, condiments, prepared mustard, vinegar and salt', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('10.85', '10.8', 'manufacture of prepared meals and dishes', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.85.1', '10.85', 'manufacture of frozen prepared meals and dishes', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('10.86', '10.8', 'manufacture of homogenized food preparations and dietetic food', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.86.1', '10.86', 'manufacture of homogenised food preparations and dietetic food', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('10.89', '10.8', 'manufacture of other food products n.e.c', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.89.1', '10.89', 'manufacture processing and bottling of other food products n.e.c', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('10.9', '10', 'manufacture of prepared amimal feeds', 'nace_subcategory', '2016-06-24 01:15:56', '2016-06-24 01:15:56'),
('10.91', '10.9', 'manufacture of prepared feeds for afarm animals', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.91.1', '10.91', 'manufacture of prepared feeds for farm animals', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('10.92', '10.9', 'manufacture of prepared pet foods', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('10.92.1', '10.92', 'manufactures of prepared pet foods', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11', '0', 'Manufacture of beverages', 'nace_category', '2016-06-24 01:15:54', '2016-06-24 01:15:54'),
('11.0', '11', 'manufacture of beverages', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('11.01', '11.0', 'Distilling, rectifying and blending of spirits', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.01.1', '11.01', 'distilling, rectifiying and blending of spirits (e.g. whisky, brandy, gin, liqueurs, ets.)', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11.02', '11.0', 'manufacture of wine from grape', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.02.1', '11.02', 'manufacture of wine from grape', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11.03', '11.0', 'manufacture of cider and other fruit wines', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.03.1', '11.03', 'manufacture of cider and other fruit wines', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11.04', '11.0', 'manufacture of other non-distilled fermented beverages', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.04.1', '11.04', 'manufacture of vermouth and similar beverages', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11.05', '11.0', 'manufacture of beer', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.05.1', '11.05', 'manufacture of beer', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11.06', '11.0', 'manufacture of malt', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.06.1', '11.06', 'manufacture of malt', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('11.07', '11.0', 'manufacture of soft drinks; production of mineral waters and other bottled waters', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('11.07.1', '11.07', 'production of soft drinks. production and bottling of natural mineral waters', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('12', '0', 'Manufacture of tobacco products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('12.0', '12', 'manufacture of tobacco products', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('12.00', '12.0', 'manufacture of tobacco products', 'nace_sub_subcategory', '2016-06-24 01:16:00', '2016-06-24 01:16:00'),
('12.00.1', '12.00', 'processing of tobacco leaves and manufacture of tobacco products', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('13', '0', 'Manufacture of textiles', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('13.1', '13', 'preparation and spinning of textile fibres', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('13.10', '13.1', 'preparetion and spinning of textile fibres', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.10.1', '13.10', 'preparation and spinning of textile fibres (cotton, wool, worst and silk)', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('13.10.2', '13.10', 'manufacture if sewing threads of any textile material', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('13.10.3', '13.10', 'preparation and spinning of other extile fibres', 'nace_item', '2016-06-24 01:16:08', '2016-06-24 01:16:08'),
('13.2', '13', 'weaving of textiles', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('13.20', '13.2', 'weaving of textiles', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.20.1', '13.20', 'weaving of textiles (using cotton, silk, wool, linum)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.20.2', '13.20', 'other textile weaving (using hemp, jute, bast, polypropylene fibres, etc)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.3', '13', 'finishing of textiles', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('13.30', '13.3', 'finishing of textiles', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.30.1', '13.30', 'finishing ot textiles (bleaching, dyeing, printing, etc) of not self-produced textiles and textile articles including wearing apparel)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.9', '13', 'manufacture of other textiles', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('13.91', '13.9', 'manufacture of knitted and crocheted fabrics', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.91.1', '13.91', 'manufacture of knitted and crocheted fabrics', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.92', '13.9', 'manufacture of made-up textile articles, except apparel', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.92.1', '13.92', 'manufacture of made-up articles of any textile material for the household (e.g. blankets, table, toilet or kitchen linen, quilts, cushions, furniture or bed covers, curtains, etc)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.92.2', '13.92', 'manufacture of other made-up textiles (e.g. tarpaulins, tents, covers for cars, flags, sleeping bags, camping goods, etc)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.93', '13.9', 'manufacture of carpets and rugs', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.93.1', '13.93', 'manufacture of carpets and rugs', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.94', '13.9', 'manufacture of cordage, rope, twine and netting', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.94.1', '13.94', 'manufacture of rope, twine and cables of textile fibres. manufacture of nets and other products made of rope, twine or netting (incl. loading slings)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.95', '13.9', 'manufacture of non-wovens and articles made from non-wovens, except apparel', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.95.1', '13.95', 'manufacture of non-wovens except apparel', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.96', '13.9', 'manufacture of other technical and industrial textiles', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.96.1', '13.96', 'manufacture of textile wadding and articles of wadding (sanitary towels or tampons), fabric impregnated, coated, covered or laminated with plastic', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.99', '13.9', 'manufacture of other textiles n.e.c', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('13.99.1', '13.99', 'manufacture of felt, labels, badges, lace and embroidery', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('13.99.9', '13.99', 'manufacture of other textiles (incl. buttons and belt covering)', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14', '0', 'Manufacture of wearing apparel', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('14.1', '14', 'manufacture of waring apparel, except fur apparel', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('14.11', '14.1', 'manufacture of leather clothes', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('14.11.1', '14.11', 'manufacture of weaving apparel made of leather or imitation leather', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14.12', '14.1', 'manufacture of workwear', 'nace_sub_subcategory', '2016-06-24 01:16:01', '2016-06-24 01:16:01'),
('14.12.1', '14.12', 'manufacture of workwear', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14.13', '14.1', 'manufacture of outerwear', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('14.13.1', '14.13', 'manufacture of other outwear made of woven knitted or chrocheated fabric non-wovens, etc., for men, women and children', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14.14', '14.1', 'manufacture of underwear', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('14.14.1', '14.14', 'manufacture of shirts, T-shirts and blouses', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14.14.2', '14.14', 'manufacture of pyjamas, night dresses, dressing gowns and underwear for men, women and children', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14.19', '14.1', ',amifactire of other wearing apparel and accessories', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('14.19.1', '14.19', 'manufacture of babies'' garments', 'nace_item', '2016-06-24 01:16:09', '2016-06-24 01:16:09'),
('14.19.2', '14.19', 'manufacture of athlete''s wear, skisuits, swimwear, etc.', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('14.19.3', '14.19', 'manufacture of other clothing accessories (e.g. gloves, belts, shawls, ties, cravats, etc.)', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('14.19.4', '14.19', 'manufacture of hats and caps', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('14.2', '14', 'manufacture of artilcles of fur', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('14.20', '14.2', 'manufacture of articles of fur', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('14.20.1', '14.20', 'manufacture of articles made of furskins', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('14.3', '14', 'manufacture of knitted and crocheted apparel', 'nace_subcategory', '2016-06-24 01:15:57', '2016-06-24 01:15:57'),
('14.31', '14.3', 'manufacture of knitted and crocheted hosiery', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('14.31.1', '14.31', 'manufacture of hosiery (incl. socks, tights and panty-hose)', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('14.39', '14.3', 'manufacture of other knitted and crocheted apparel', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('14.39.1', '14.39', 'manufacture of knitted and chrocheted pullovers, cardigans, jerseys and similar articles', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('15', '0', 'Manufacture of leather and related products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('15.1', '15', 'Tanning and dressing of leather; manufacture of luggage, handbags, saddlery and harness; dressing and dyeing of fur', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('15.11', '15.1', 'tanning and dressing of leather; dressing and dyeing of fur', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('15.11.1', '15.11', 'dressing (e.g. scrapping, tanning, bleaching, etc.) and dyeing of furskins', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('15.11.2', '15.11', 'production of tanned leather. manufacture of dressed leather and composistion leather', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('15.12', '15.1', 'manufacture of luggage, handbafs and the like, saddlery and harness', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('15.12.1', '15.12', 'manufacture of luggage, handbags and the like of any material. manufacture if saddlery, harness and other articles of leather or composition leather. leather cutting', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('15.2', '15', 'manufacture of footwear', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('15.20', '15.2', 'manufacture of footware', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('15.20.1', '15.20', 'manufacture of footwear of any material', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('15.20.2', '15.20', 'manufacture of parts of footwear (e.g. uppers and parts of uppers, outer and inner soles, heels, etc) ( incl. sewing of footwear)', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('16', '0', 'Manufacture of wood and of products of wood and cork, except furniture; manufacture of articles of straw and plaiting materials', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('16.01.1', '16.01', 'sawmilling and planning of wood. impregnation of wood', 'nace_item', '2016-06-24 01:16:10', '2016-06-24 01:16:10'),
('16.1', '16', 'sawmilling and planning of wood', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('16.10', '16.1', 'sawmilling and planning of wood', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('16.2', '16', 'manufacture of products of wood, cork, straw and plaiting materials', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('16.21', '16.2', 'manufacture of veneer sheets and wood based panels', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('16.21.1', '16.21', 'manufacture of plywood, laminboard, particle board, fibre board, other panels and boards and vaneer sheets', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('16.22', '16.2', 'manufacture of assembled parquet floors', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('16.22.1', '16.22', 'manufacture of parquet floor blocks', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('16.23', '16.2', 'manufacture of other bulders carpentry and joinery', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('16.23.1', '16.23', 'manufacture of builders'' carpentry and joinery', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('16.23.2', '16.23', 'manufacture of prefabricated buildings or elements there of wood', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('16.24', '16.2', 'manufacture of wooden containers', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('16.24.1', '16.24', 'manufacture of wooden packing cases, boxes, barrels, pallets, etc', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('16.29', '16.2', 'manufacture of other products of wood; manufacture of articles of cork, straw and plaiting materials', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('16.29.1', '16.29', 'manufacture of wooden frames, statuettes, ornaments and other products of wood n.e.c ( incl. wood terner )', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('16.29.2', '16.29', 'manufacture of articles of cork, plaits, basketware and wickerwork of straw and plaiting materials', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17', '0', 'Manfucature of paper and paper products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('17.1', '17', 'manufacture of pulp, paper and paperboard', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('17.11', '17.1', 'manufacture of pulp', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('17.11.1', '17.11', 'manufacture of pulp ', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17.12', '17.1', 'manufacture of paper and paperboard', 'nace_sub_subcategory', '2016-06-24 01:16:02', '2016-06-24 01:16:02'),
('17.12.1', '17.12', 'manufacture of paper and paperboard', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17.2', '17', 'manufacture of articles of paper and paperboard', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('17.21', '17.2', 'manufacture of corrugateed paper and paperboards and of container of paper and paperboard', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('17.21.1', '17.21', 'manufacture of container, boxes, sacks and bags of paper or paperboard', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17.22', '17.2', 'manufacture of household and sanitary goods and of toilet requisites', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('17.22.1', '17.22', 'manufacture of households and personel hygiene paper and wadding and articles of wadding', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17.23', '17.2', 'manufacture of paper stationary', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('17.23.1', '17.23', 'manufacture of paper stationery, envelopes and letter - cards', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17.24', '17.2', 'manufacture of wallpaper', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('17.24.1', '17.24', 'manufacture of wallpaper', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('17.29', '17.2', 'manufacture of other articles of paper and paperboard', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('17.29.1', '17.29', 'manufacture of labels and other articles of paper and paperboard', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('18', '0', 'Printing and reproduction of recorded media', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('18.1', '18', 'printing and service activities related to printing', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('18.11', '18.1', 'printing of newspaper', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('18.11.1', '18.11', 'printing of newspapers', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('18.12', '18.1', 'other printing', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('18.12.1', '18.12', 'other printing (excl. cloth printing )', 'nace_item', '2016-06-24 01:16:11', '2016-06-24 01:16:11'),
('18.13', '18.1', 'pre-press and pre-media services', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('18.13.1', '18.13', 'pre-press and pre-media services', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('18.14', '18.1', 'binding and related services', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('18.14.1', '18.14', 'bookbinding', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('18.14.9', '18.14', 'ancillary activities related to printing', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('18.2', '18', 'reproduction of recorded media', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('18.20', '18.2', 'reproduction of recorded media', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('18.20.1', '18.20', 'reproduction of sound recording (i.e reproduction from master copies of gramophone records, compact and DVD discs and tapes with music)', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('18.20.2', '18.20', 'reproduction of video recording ( i.e. reproduction from master copies of tapes, records, compact and DVD discs and other video recordings with motion pictures )', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('18.20.3', '18.20', 'reproduction of computer media from master copies of software and data on discs and tapes', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('19', '0', 'Manufacture of coke and refined petroleum products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('19.1', '19', 'manufacture of coke oven products', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('19.10', '19.1', 'manufacture of coke oven products', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('19.10.1', '19.10', 'manufacture of coke oven products', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('19.2', '19', 'manufacture of refined petroleum products', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('19.20', '19.2', 'manufacture of refined petroleum products', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('19.20.1', '19.20', 'manufacture of refined petroleum products', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20', '0', 'Manfucature of chemicals and chemical products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('20.1', '20', 'manufacture of basic chemicals, fertilizers and nitrogen compounds, plastics and synthetic rubber in primary forms', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('20.11', '20.1', 'manufacture of industrial gasses', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.11.1', '20.11', 'manufacture if oxygen, acetylene, carbon dioxide and other industrial gasses', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.12', '20.1', 'manufacture of dyes and pigments', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.12.1', '20.12', 'manufacture of dyes and pigments in basic form or as concentrate', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.13', '20.1', 'manufacture of other inorganic basic chemicals', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.13.1', '20.13', 'manufacture of other inorganic basic chemicals', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.14', '20.1', 'manufacture of other basic checmicals', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.14.1', '20.14', 'manufacture of other organic basic chemicals ( e.g. hydrocarbons, ethylic alcohol )', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.14.2', '20.14', 'production of charcoal by means of industrial method ( i.e. distillation of wood )', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.15', '20.1', 'manufacture of fertilizers and nitrogen compounds', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.15.1', '20.15', 'manufacture of fertilisers and nitrogen compounds', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.16', '20.1', 'manufacture of plastic in primary forms', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.16.1', '20.16', 'manufacture of plastics in primary forms', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.17', '20.1', 'manufacture of synthetic rubber in primary forms', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.17.1', '20.17', 'manufacture of synthetic rubber in primary forms', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.2', '20', 'manufacture of pesticides and other agrochemical products', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('20.20', '20.2', 'manufacture of pesticides and other agrochemical products', 'nace_sub_subcategory', '2016-06-24 01:16:03', '2016-06-24 01:16:03'),
('20.20.1', '20.20', 'manufacture of pesticides and other agrochemical products', 'nace_item', '2016-06-24 01:16:12', '2016-06-24 01:16:12'),
('20.3', '20', 'manufacture of paint, varnishes and similar coatings, printing ink and mastics', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('20.30', '20.3', 'manufacture of paints, varnishes and similar coatings, printing ink and mastics', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.30.1', '20.30', 'manufacture of paints, varnished, thinner, lacquers and similar products', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.30.2', '20.30', 'manufacture of insulted construction materials and mastics', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.4', '20', 'manufacture of soap and detergents, cleaning and polishing preparations, perfumes and toilet preparations', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('20.41', '20.4', 'manufacture of soap and detergents, cleaning and polishing preparations.', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.41.1', '20.41', 'manufacture of soap, washing powders, detergents and other cleaning preparations', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.41.2', '20.41', 'manufacture of polishes and creams for leather, wood, glass, etc.', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.42', '20.4', 'manufacture of perfurmes and toilet preparations', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.42.1', '20.42', 'manufacture of perfumes and toilet preparations', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.5', '20', 'manufacture of other chemical products', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('20.51', '20.5', 'manufacture of explosives', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.51.1', '20.51', 'manufactures of explosives and pyrotechnics products', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.51.2', '20.51', 'manufacture of matches', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.52', '20.5', 'manufactures of glues', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.52.2', '20.52', 'manufacture of glues', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.53', '20.5', 'manufactures of essential oils', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.53.1', '20.53', 'manufacture of essential oils', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.59', '20.5', 'manufactures of other chemical products n.e.c', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.59.1', '20.59', 'manufacture of photographic chemical material', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.59.2', '20.59', 'manufacture of gelatine', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.59.9', '20.59', 'manufacture of other chemical products n.e.c', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('20.6', '20', 'manufacture of man-made fibres', 'nace_subcategory', '2016-06-24 01:15:58', '2016-06-24 01:15:58'),
('20.60', '20.6', 'manufacture of man-made fibres', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('20.60.1', '20.60', 'manufacture of man-made fibres', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('21', '0', 'Manfucature of basic pharmaceutical products and pharmaceutical preparations', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('21.1', '21', 'manufacture of basic pharmaceutical products', 'nace_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('21.10', '21.1', 'manufacture of basic pharmaceutical products', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('21.10.1', '21.10', 'manufacture of basic pharmaceutical products', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('21.2', '21', 'manufacture of pharmaceutical preparations', 'nace_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('21.20', '21.2', 'manufacture of pharmaceutical preparations', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('21.20.1', '21.20', 'manufacture of pharmaceutical preparations', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('22', '0', 'manufacture of rubber and plastic products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('22.1', '22', 'manufacture of rubber products', 'nace_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('22.11', '22.1', 'manufacture of rubber tyres and tubes; retreading and rebuilding of rubber tyres', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('22.11.1', '22.11', 'manifacture of rubber tyres and tubes', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('22.11.2', '22.11', 'retreading and rebuilding of rubber tyres', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('22.19', '22.1', 'manufacture of rubber products', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('22.19.1', '22.19', 'manufacture of other rubber products', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('22.2', '22', 'manufacture of plastics products', 'nace_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('22.21', '22.2', 'manufactures of plastic plates, sheets, tubes and profiles', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('22.21.1', '22.21', 'manufacture of plastic plates, sheets, tubes, pipes and pipe fittings, expanded polystyrene and foam rubber', 'nace_item', '2016-06-24 01:16:13', '2016-06-24 01:16:13'),
('22.22', '22.2', 'manufacture of plastic packing goods', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('22.22.1', '22.22', 'manufacture of plastic packing goods', 'nace_item', '2016-06-24 01:16:14', '2016-06-24 01:16:14'),
('22.23', '22.2', 'manufacture of builders'' ware of plastic', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('22.23.1', '22.23', 'manufacture of builders'' ware of plastic', 'nace_item', '2016-06-24 01:16:14', '2016-06-24 01:16:14'),
('22.29', '22.2', 'manufacture of other plastic products', 'nace_sub_subcategory', '2016-06-24 01:16:04', '2016-06-24 01:16:04'),
('22.29.1', '22.29', 'manufacture of other plastic products', 'nace_item', '2016-06-24 01:16:14', '2016-06-24 01:16:14'),
('23', '0', 'manufacture of other non-metallic mineral products', 'nace_category', '2016-06-24 01:15:55', '2016-06-24 01:15:55'),
('23.1', '23', 'manufacture of glass and glass products', 'nace_subcategory', '2016-06-24 01:15:59', '2016-06-24 01:15:59'),
('23.11', '23.1', 'manufacture of flat glass', 'nace_sub_subcategory', '2016-06-24 01:16:05', '2016-06-24 01:16:05'),
('23.11.1', '23.11', 'manufacture of flat glass, including wired, coloured or tinted flat glass', 'nace_item', '2016-06-24 01:16:14', '2016-06-24 01:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `notes_log`
--

CREATE TABLE IF NOT EXISTS `notes_log` (
  `notes_log_id` int(11) NOT NULL,
  `id_a0_cat` int(11) NOT NULL,
  `notes_content` longtext NOT NULL,
  `notes_addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes_status` varchar(200) NOT NULL,
  `notes_for_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for new, 1 for re',
  `attachments` varchar(100) NOT NULL COMMENT 'di implode dari master_files'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes_log`
--

INSERT INTO `notes_log` (`notes_log_id`, `id_a0_cat`, `notes_content`, `notes_addtime`, `notes_status`, `notes_for_type`, `attachments`) VALUES
(1, 3, '', '2016-07-14 11:59:11', 'remidial', 0, '1'),
(2, 3, 'Mesin Masih jorok.', '2016-07-14 12:01:32', 'remidial', 0, '2'),
(3, 3, '', '2016-07-15 02:32:50', 'success', 0, '3'),
(4, 1, '', '2016-07-19 08:39:19', 'success', 0, ''),
(5, 2, '', '2016-07-20 05:09:29', 'success', 0, ''),
(6, 30, '', '2016-07-20 10:27:23', 'success', 0, ''),
(7, 29, '', '2016-07-20 10:48:55', 'success', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `old_ref_certificate`
--

CREATE TABLE IF NOT EXISTS `old_ref_certificate` (
  `id_certificate` varchar(200) NOT NULL,
  `old_reference` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_line`
--

CREATE TABLE IF NOT EXISTS `product_line` (
  `product_line_id` int(10) NOT NULL,
  `product_subcategory` int(11) NOT NULL,
  `product_line_name` text NOT NULL,
  `SNI` varchar(200) NOT NULL,
  `product_line_note` text NOT NULL,
  `product_line_parent` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_line`
--

INSERT INTO `product_line` (`product_line_id`, `product_subcategory`, `product_line_name`, `SNI`, `product_line_note`, `product_line_parent`) VALUES
(1, 1, 'Helm kendaraan bermotor', '10', '', '02.03'),
(2, 2, 'Sepatu pengaman', '11,12,13', '', '02.06'),
(3, 2, 'Sepatu Bot', '14,15,16', '', '02.06'),
(4, 3, 'Tangki Plastik', '17', '', '04.01'),
(5, 4, 'Kakao', '18', '', '13.05'),
(6, 4, 'Kopi', '19', '', '13.06'),
(7, 5, 'Air minum dalam kemasan', '20', '', '13.07'),
(8, 6, 'Gula kristal Putih', '21', '', '20.03'),
(9, 7, 'SIR', '22,23', 'SIR 10,SIR 20', '20.03'),
(10, 7, 'Selang Karet', '24', '', '20.03'),
(11, 7, 'Rol Karet', '25', '', '20.03'),
(12, 7, 'Karet Konvensional', '26', '', '20.03'),
(13, 7, 'Rubber Seal', '27', '', '20.03'),
(14, 7, 'Terpal Plastik', '28', '', '20.03'),
(15, 7, 'Karung', '29', '', '20.03'),
(16, 7, 'Produk melamin', '30', '', '20.03'),
(17, 7, 'Sol karet Cetak', '31', '', '20.03'),
(18, 7, 'Pipa PVC', '32', '', '20.03'),
(19, 8, 'Ban Mobil penumpang', '33', '', '20.04'),
(20, 8, 'Ban truk dan bus', '34', '', '20.04'),
(21, 8, 'Ban truk ringan', '35', '', '20.04'),
(22, 8, 'Ban sepeda motor', '36', '', '20.04'),
(23, 8, 'ban dalam kendaraan bermotor', '37', '', '20.04'),
(24, 9, 'Sepatu wanita', '38', '', '20.06'),
(25, 9, 'Sepatu pria', '39', '', '20.06');

-- --------------------------------------------------------

--
-- Table structure for table `product_line_category`
--

CREATE TABLE IF NOT EXISTS `product_line_category` (
  `product_category_id` int(11) NOT NULL,
  `product_category_name` varchar(37) DEFAULT NULL,
  `product_line_number` varchar(20) NOT NULL,
  `product_line_parent` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_line_category`
--

INSERT INTO `product_line_category` (`product_category_id`, `product_category_name`, `product_line_number`, `product_line_parent`) VALUES
(1, 'Peralatan Perlindungan', '02', '0'),
(2, 'Komponen Fluida untuk Penggunaan Umum', '04', '0'),
(3, 'Produk Pangan', '13', '0'),
(4, 'Karet dan Produk Plastik', '20', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_line_subcategory`
--

CREATE TABLE IF NOT EXISTS `product_line_subcategory` (
  `product_subcategory_id` int(11) NOT NULL,
  `product_category_id` int(1) DEFAULT NULL,
  `product_subcategory_name` varchar(29) DEFAULT NULL,
  `product_line_number` varchar(20) NOT NULL,
  `product_line_parent` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_line_subcategory`
--

INSERT INTO `product_line_subcategory` (`product_subcategory_id`, `product_category_id`, `product_subcategory_name`, `product_line_number`, `product_line_parent`) VALUES
(1, 1, 'Peralatan Perlindungan Kepala', '02.03', '02'),
(2, 1, 'Perlindungan Lutut dan Kaki', '02.06', '02'),
(3, 2, 'Alat Penyimpanan Fluida', '04.01', '04'),
(4, 3, 'teh, Kopi, Coklat', '13.05', '13'),
(5, 3, 'Minuman', '13.06', '13'),
(6, 3, 'Gula, Produk Gula dan Pati', '13.07', '13'),
(7, 4, 'Produk Plastik dan Karet', '20.03', '20'),
(8, 4, 'Ban', '20.04', '20'),
(9, 4, 'Alas Kaki', '20.06', '20');

-- --------------------------------------------------------

--
-- Table structure for table `rs`
--

CREATE TABLE IF NOT EXISTS `rs` (
  `id_rs` int(11) NOT NULL,
  `id_rs_schedule` int(11) DEFAULT NULL,
  `id_issued` int(11) NOT NULL,
  `deadline_date` date NOT NULL,
  `rs_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rs_status` enum('process','success','fail','remidial') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rs`
--

INSERT INTO `rs` (`id_rs`, `id_rs_schedule`, `id_issued`, `deadline_date`, `rs_updated`, `rs_status`) VALUES
(1, NULL, 1, '2017-01-15', '2016-07-21 15:39:18', 'success'),
(2, NULL, 1, '2017-08-15', '2016-07-15 09:32:47', NULL),
(3, NULL, 1, '2018-02-15', '2016-07-15 09:32:47', NULL),
(4, NULL, 1, '2018-09-15', '2016-07-15 09:32:47', NULL),
(5, NULL, 2, '2016-11-19', '2016-07-21 15:44:48', 'success'),
(6, NULL, 2, '2017-04-19', '2016-07-21 16:06:23', NULL),
(7, NULL, 2, '2017-09-19', '2016-07-19 15:39:14', NULL),
(8, NULL, 3, '2017-02-20', '2016-07-20 12:09:20', NULL),
(9, NULL, 3, '2017-09-20', '2016-07-20 12:09:20', NULL),
(10, NULL, 3, '2018-04-20', '2016-07-20 12:09:20', NULL),
(11, NULL, 4, '2016-11-20', '2016-07-20 17:27:19', NULL),
(12, NULL, 4, '2017-04-20', '2016-07-20 17:27:19', NULL),
(13, NULL, 4, '2017-09-20', '2016-07-20 17:27:19', NULL),
(14, NULL, 5, '2016-11-20', '2016-07-20 17:48:54', NULL),
(15, NULL, 5, '2017-04-20', '2016-07-20 17:48:54', NULL),
(16, NULL, 5, '2017-09-20', '2016-07-20 17:48:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rs_schedule`
--

CREATE TABLE IF NOT EXISTS `rs_schedule` (
  `id_rs_schedule` int(11) NOT NULL,
  `survey_date` date DEFAULT NULL COMMENT 'survey date <= rs.deadline_date',
  `token` varchar(200) NOT NULL,
  `resurvey_added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL,
  `username` text NOT NULL,
  `user_fullname` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `user_secret_token` text NOT NULL,
  `level` enum('1','10') NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_timeadd` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `user_fullname`, `email`, `password`, `user_secret_token`, `level`, `active`, `user_timeadd`) VALUES
(1, 'dhonisaputra', 'Dhoni Purnomo Saputra', 'dhoni.p.saputra@gmail.com', 'e9cbd2ea8015a084ce9cf83a3c65b51f8fa10a39', '$2y$11$IUAjJCVeJiohQCMkJV4mKe7YK6e4LJwrdV8701EuxhY2POet968AC', '10', 1, '2016-05-12 09:56:43'),
(2, 'heathcliff', 'Kayaba Akihito', 'heathcliff@cplusco.com', 'e9cbd2ea8015a084ce9cf83a3c65b51f8fa10a39', '$2y$11$IUAjJCVeJiohQCMkJV4mKeW2U/W0daHELvu.gPma4VV/5T1PLd61a', '10', 1, '2016-05-13 07:47:19'),
(3, 'dhoni', '', 'dhoni.p.saputra@gmail.com', 'e9cbd2ea8015a084ce9cf83a3c65b51f8fa10a39', '$2y$11$IUAjJCVeJiohQCMkJV4mKewNluCnZ5q05Y0LCcGiumMfVixVsJXXO', '10', 1, '2016-06-30 11:20:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a0`
--
ALTER TABLE `a0`
  ADD PRIMARY KEY (`id_a0`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `email_log_id` (`email_log_id`);

--
-- Indexes for table `a0_cat`
--
ALTER TABLE `a0_cat`
  ADD PRIMARY KEY (`id_a0_cat`),
  ADD KEY `id_A0` (`id_a0`),
  ADD KEY `cat_certificate` (`type`),
  ADD KEY `id_certificate` (`id_certificate`);

--
-- Indexes for table `assessment_collective`
--
ALTER TABLE `assessment_collective`
  ADD PRIMARY KEY (`id_assessment_group`);

--
-- Indexes for table `auditor`
--
ALTER TABLE `auditor`
  ADD PRIMARY KEY (`id_auditor`);

--
-- Indexes for table `auditor_log`
--
ALTER TABLE `auditor_log`
  ADD PRIMARY KEY (`auditor_log_id`);

--
-- Indexes for table `auditor_riwayat_kegiatan`
--
ALTER TABLE `auditor_riwayat_kegiatan`
  ADD PRIMARY KEY (`id_auditor_riwayat_kegiatan`);

--
-- Indexes for table `auditor_riwayat_pendidikan`
--
ALTER TABLE `auditor_riwayat_pendidikan`
  ADD PRIMARY KEY (`id_riwayat_pendidikan_auditor`),
  ADD KEY `id_auditor` (`id_auditor`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `id_commodity` (`id_commodity`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id_certificate`,`id_a0_cat`),
  ADD UNIQUE KEY `certificate_md5` (`certificate_md5`),
  ADD KEY `id_A0_cat` (`id_a0_cat`);

--
-- Indexes for table `certification_category`
--
ALTER TABLE `certification_category`
  ADD PRIMARY KEY (`audit_reference`);

--
-- Indexes for table `certification_request`
--
ALTER TABLE `certification_request`
  ADD PRIMARY KEY (`id_certification_request`);

--
-- Indexes for table `certification_type`
--
ALTER TABLE `certification_type`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`id_commodity`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`);

--
-- Indexes for table `company_contact`
--
ALTER TABLE `company_contact`
  ADD PRIMARY KEY (`id_company`,`contact_number`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`);

--
-- Indexes for table `email_log`
--
ALTER TABLE `email_log`
  ADD PRIMARY KEY (`email_log_id`);

--
-- Indexes for table `issued`
--
ALTER TABLE `issued`
  ADD PRIMARY KEY (`id_issued`),
  ADD KEY `id_certificate` (`id_certificate`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`);

--
-- Indexes for table `master_files`
--
ALTER TABLE `master_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `nace`
--
ALTER TABLE `nace`
  ADD PRIMARY KEY (`nace_item`,`nace_parent`);

--
-- Indexes for table `notes_log`
--
ALTER TABLE `notes_log`
  ADD PRIMARY KEY (`notes_log_id`);

--
-- Indexes for table `old_ref_certificate`
--
ALTER TABLE `old_ref_certificate`
  ADD PRIMARY KEY (`id_certificate`,`old_reference`);

--
-- Indexes for table `product_line`
--
ALTER TABLE `product_line`
  ADD PRIMARY KEY (`product_line_id`,`product_subcategory`);

--
-- Indexes for table `product_line_category`
--
ALTER TABLE `product_line_category`
  ADD PRIMARY KEY (`product_category_id`),
  ADD UNIQUE KEY `product_line_number` (`product_line_number`);

--
-- Indexes for table `product_line_subcategory`
--
ALTER TABLE `product_line_subcategory`
  ADD PRIMARY KEY (`product_subcategory_id`),
  ADD UNIQUE KEY `product_line_number` (`product_line_number`);

--
-- Indexes for table `rs`
--
ALTER TABLE `rs`
  ADD PRIMARY KEY (`id_rs`),
  ADD KEY `id_rs_schedule` (`id_rs_schedule`),
  ADD KEY `id_issued` (`id_issued`);

--
-- Indexes for table `rs_schedule`
--
ALTER TABLE `rs_schedule`
  ADD PRIMARY KEY (`id_rs_schedule`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a0`
--
ALTER TABLE `a0`
  MODIFY `id_a0` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `a0_cat`
--
ALTER TABLE `a0_cat`
  MODIFY `id_a0_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `assessment_collective`
--
ALTER TABLE `assessment_collective`
  MODIFY `id_assessment_group` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auditor`
--
ALTER TABLE `auditor`
  MODIFY `id_auditor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `auditor_log`
--
ALTER TABLE `auditor_log`
  MODIFY `auditor_log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `auditor_riwayat_kegiatan`
--
ALTER TABLE `auditor_riwayat_kegiatan`
  MODIFY `id_auditor_riwayat_kegiatan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auditor_riwayat_pendidikan`
--
ALTER TABLE `auditor_riwayat_pendidikan`
  MODIFY `id_riwayat_pendidikan_auditor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `certification_category`
--
ALTER TABLE `certification_category`
  MODIFY `audit_reference` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `certification_request`
--
ALTER TABLE `certification_request`
  MODIFY `id_certification_request` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `commodity`
--
ALTER TABLE `commodity`
  MODIFY `id_commodity` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `email_log`
--
ALTER TABLE `email_log`
  MODIFY `email_log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `id_issued` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_files`
--
ALTER TABLE `master_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notes_log`
--
ALTER TABLE `notes_log`
  MODIFY `notes_log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_line`
--
ALTER TABLE `product_line`
  MODIFY `product_line_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `product_line_category`
--
ALTER TABLE `product_line_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_line_subcategory`
--
ALTER TABLE `product_line_subcategory`
  MODIFY `product_subcategory_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `rs`
--
ALTER TABLE `rs`
  MODIFY `id_rs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `rs_schedule`
--
ALTER TABLE `rs_schedule`
  MODIFY `id_rs_schedule` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
