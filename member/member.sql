-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2016 at 07:08 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `member`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psword` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `sex` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `birthday` date DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jointime` date DEFAULT NULL,
  `logintime` date DEFAULT NULL,
  `item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `username`, `psword`, `level`, `sex`, `birthday`, `phone`, `email`, `address`, `jointime`, `logintime`, `item`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'M', '2016-09-09', NULL, NULL, NULL, '2016-09-09', '2016-09-12', 1),
(2, '小德', 'ben210005', 'd9570778', 'admin', 'M', '1988-05-06', NULL, 'ben210005@gmail.com', '', NULL, '2016-09-10', 2),
(3, 'ken123', 'ken123', 'ken123', 'member', 'M', '1988-05-01', NULL, 'ken123@gmail.com', NULL, '2016-09-09', '2016-09-12', 15),
(4, 'merry', 'merry', 'merry', 'member', 'M', '1988-01-06', NULL, 'merry@gmail.com', '', '2016-09-09', '2016-09-12', 20),
(5, 'johny', 'johny', 'johny', 'member', 'M', '1988-01-12', NULL, 'johny@gmail.com', '台灣大道三段', '2016-09-09', '2016-09-09', 25),
(6, 'andrew', 'andrew', 'andrew', 'member', 'M', '1988-01-14', NULL, 'andrew@gmail.com', '', '2016-09-09', '2016-09-12', 12),
(7, 'amily', 'amily', 'amily123', 'member', 'M', '1988-01-07', NULL, 'amily@gmail.com', '', '2016-09-09', '2016-09-09', 7),
(8, 'tonychen', 'tonychen', 'tonychen', 'member', 'M', '1988-05-06', NULL, 'tonychen@gmail.com', '', '2016-09-10', '2016-09-10', 8),
(9, 'Abel', 'Abel', 'Abel', 'member', 'M', '2016-06-08', NULL, 'Abel@gmail.com', NULL, '2016-07-07', NULL, NULL),
(10, 'Adam', 'Adam', 'Adam', 'member', 'M', '2016-04-06', NULL, 'Adam@gmail.com', NULL, '2016-08-02', NULL, NULL),
(14, 'Allen', 'Allen', 'Allen', 'member', 'M', '2016-03-09', NULL, 'Allen@gmail.com', NULL, '2016-08-03', NULL, NULL),
(16, 'Colin', 'Colin', 'Colin', 'member', 'M', '2016-03-09', NULL, 'Colin@gmail.com', NULL, '2016-08-17', NULL, NULL),
(18, 'Duncan', 'Duncan', 'Duncan', 'member', 'M', '2016-03-02', NULL, 'Duncan@gmail.com', NULL, '2016-07-20', NULL, NULL),
(20, 'Gale', 'Gale', 'Gale', 'member', 'M', '2016-04-06', NULL, 'Gale@gmail.com', NULL, '2016-07-11', NULL, NULL),
(22, 'Henry', 'Henry', 'Henry', 'member', 'M', '2015-10-08', NULL, 'Henry@gmail.com', NULL, '2016-08-03', NULL, NULL),
(24, 'Joyce', 'Joyce', 'Joyce', 'member', 'M', '2016-03-09', NULL, 'Joyce@gmail.com', NULL, '2016-08-10', NULL, NULL),
(26, 'Mike', 'Mike', 'Mike', 'member', 'M', '2016-03-10', NULL, 'Mike@gmail.com', NULL, '2016-09-09', '2016-09-12', NULL),
(28, 'Nick', 'Nick', 'Nick', 'member', 'M', '2016-08-16', NULL, 'Nick@gmail.com', NULL, '2016-08-23', NULL, NULL),
(29, 'kkman', 'kkman', 'kkman', 'member', 'M', '1988-05-01', NULL, 'kkman@gmail.com', '', '2016-09-12', '2016-09-12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
