-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2019 at 06:50 AM
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
-- Database: `mul-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Development', '2019-05-09 20:31:43', '2019-05-09 20:35:18'),
(2, 'Business', '2019-05-09 20:34:44', '2019-05-09 20:36:02'),
(3, 'IT & Software', '2019-05-09 20:36:14', '2019-05-09 20:36:14'),
(4, 'Personal Development', '2019-05-09 20:36:28', '2019-05-09 20:36:28'),
(5, 'Design', '2019-05-09 20:36:35', '2019-05-09 20:36:35'),
(6, 'Marketing', '2019-05-09 20:36:45', '2019-05-09 20:36:45'),
(7, 'Lifestyle', '2019-05-09 20:36:55', '2019-05-09 20:36:55'),
(8, 'Photography', '2019-05-09 20:37:04', '2019-05-09 20:37:04'),
(9, 'Health & Fitness', '2019-05-09 20:37:13', '2019-05-09 20:37:13'),
(10, 'Music', '2019-05-09 20:37:20', '2019-05-09 20:37:20'),
(11, 'Teaching & Academics', '2019-05-09 20:37:32', '2019-05-09 20:37:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
