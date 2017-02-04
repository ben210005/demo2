-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-02-03 14:27:43
-- 伺服器版本: 10.1.19-MariaDB
-- PHP 版本： 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `luckyball`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ball`
--

CREATE TABLE `ball` (
  `num_id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ball_1` int(11) NOT NULL,
  `ball_2` int(11) NOT NULL,
  `ball_3` int(11) NOT NULL,
  `ball_4` int(11) NOT NULL,
  `ball_5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `ball`
--

INSERT INTO `ball` (`num_id`, `ball_1`, `ball_2`, `ball_3`, `ball_4`, `ball_5`) VALUES
('20170203089', 6, 5, 8, 6, 3),
('20170203092', 7, 0, 7, 0, 2);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `ball`
--
ALTER TABLE `ball`
  ADD PRIMARY KEY (`num_id`),
  ADD UNIQUE KEY `num_id` (`num_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
