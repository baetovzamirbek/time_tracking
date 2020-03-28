-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2020 at 08:10 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `time`
--

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`) VALUES
(1, '2020-03-23'),
(2, '2020-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `late`
--

CREATE TABLE `late` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `late`
--

INSERT INTO `late` (`id`, `user_id`, `date`, `time`) VALUES
(748, 1, '2020-03-09', '14:44:00'),
(749, 1, '2020-03-11', '14:44:00'),
(750, 1, '2020-03-16', '09:15:14'),
(751, 1, '2020-03-17', '15:38:05'),
(752, 2, '2020-03-09', '14:44:00'),
(753, 2, '2020-03-11', '14:44:00'),
(754, 2, '2020-03-13', '09:00:03'),
(756, 3, '2020-03-03', '11:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `notWorkDays`
--

CREATE TABLE `notWorkDays` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `every_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notWorkDays`
--

INSERT INTO `notWorkDays` (`id`, `date`, `every_year`) VALUES
(2, '2020-05-27', 1),
(3, '2020-05-18', 0),
(5, '2020-03-05', 1),
(6, '2020-01-01', 0),
(9, '2020-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `startTime`
--

CREATE TABLE `startTime` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `startTime`
--

INSERT INTO `startTime` (`id`, `time`) VALUES
(1, '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `day` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `start_time`, `end_time`, `day`, `user_id`) VALUES
(1, '14:44:00', '14:50:00', '2020-03-11', 1),
(2, '14:44:00', '14:50:00', '2020-03-09', 1),
(3, '09:24:00', '17:30:12', '2020-02-04', 1),
(4, '09:24:00', '15:30:12', '2020-02-06', 1),
(5, '09:24:00', '15:30:12', '2020-01-16', 1),
(33, '09:00:00', '11:06:00', '2020-03-12', 1),
(37, '13:00:00', '15:06:00', '2020-03-12', 1),
(38, '17:00:00', '17:30:00', '2020-03-12', 1),
(46, '15:23:59', '15:24:00', '2020-03-12', 1),
(47, '15:26:36', '15:26:37', '2020-03-12', 1),
(48, '15:26:40', '15:26:41', '2020-03-12', 1),
(49, '15:29:41', '15:29:42', '2020-03-12', 1),
(50, '17:17:27', '17:17:28', '2020-03-12', 1),
(51, '09:00:03', '16:00:00', '2020-03-13', 1),
(55, '14:44:00', '14:50:00', '2020-03-11', 2),
(56, '14:44:00', '14:50:00', '2020-03-09', 2),
(57, '09:24:00', '17:30:12', '2020-02-04', 2),
(58, '09:24:00', '15:30:12', '2020-02-06', 2),
(59, '09:24:00', '15:30:12', '2020-01-16', 2),
(60, '09:00:00', '11:06:00', '2020-03-12', 2),
(61, '13:00:00', '15:06:00', '2020-03-12', 2),
(62, '17:00:00', '17:30:00', '2020-03-12', 2),
(63, '15:23:59', '15:24:00', '2020-03-12', 2),
(64, '15:26:36', '15:26:37', '2020-03-12', 2),
(65, '15:26:40', '15:26:41', '2020-03-12', 2),
(66, '15:29:41', '15:29:42', '2020-03-12', 2),
(67, '17:17:27', '17:17:28', '2020-03-12', 2),
(68, '09:00:03', '15:51:06', '2020-03-13', 2),
(83, '23:53:42', '23:53:49', '2020-03-13', 1),
(84, '23:54:32', '23:54:33', '2020-03-13', 1),
(85, '05:01:00', '12:00:00', '2020-03-02', 1),
(87, '07:00:00', '12:04:00', '2020-03-02', 2),
(88, '09:31:00', '19:04:00', '2020-03-02', 3),
(89, '11:16:36', '13:45:27', '2020-03-03', 3),
(90, '11:16:36', '13:45:27', '2020-02-03', 2),
(91, '09:15:14', '16:41:39', '2020-03-16', 1),
(92, '08:20:20', '16:41:40', '2020-03-16', 2),
(93, '08:26:32', '17:33:54', '2020-03-16', 3),
(94, '15:38:05', '16:41:28', '2020-03-17', 1),
(97, '09:54:50', '14:44:51', '2020-03-18', 1),
(98, '09:55:33', '15:42:36', '2020-03-18', 9),
(99, '14:29:35', '14:48:19', '2020-03-18', 2),
(100, '14:47:32', '15:42:33', '2020-03-18', 1),
(101, '13:29:35', '15:42:35', '2020-03-18', 2),
(102, '23:46:17', '00:06:30', '2020-03-23', 3),
(103, '00:06:40', NULL, '2020-03-24', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `name`, `email`, `password`, `status`, `role`) VALUES
(1, 'Zamir', 'Zamir', 'baetov@mmm.ru', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 1),
(2, 'Ulan', 'Ulan', 'baetov@mmm.ru', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 1),
(3, 'Mirbek', 'Mirbek', 'baetov@mmm.ru', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 1),
(4, 'nurdan', 'Nurdan', 'nurdan@zzz.kg', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 1),
(8, 'admin', 'admin', 'baetbaetov@mmm.ru', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 2),
(9, 'nurdan', 'nurdan', 'nnnbaetov@mmm.ru', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 0, 1),
(10, '1', '1asdf', 'baetov@mmm.ru', 'sdf', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `late`
--
ALTER TABLE `late`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notWorkDays`
--
ALTER TABLE `notWorkDays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `startTime`
--
ALTER TABLE `startTime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `late`
--
ALTER TABLE `late`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=757;
--
-- AUTO_INCREMENT for table `notWorkDays`
--
ALTER TABLE `notWorkDays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `startTime`
--
ALTER TABLE `startTime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
