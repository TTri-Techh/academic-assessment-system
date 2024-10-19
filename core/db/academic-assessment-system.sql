-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 19, 2024 at 01:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academic-assessment-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$4nygqGIwY8hMcRDmtGmBpum5IkQmoSmPf4lbYJV7gY648N9SVEUca', '2024-10-17 12:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '123456',
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `username`, `password`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Khant Thiha Htun', 'khantthihahtun', '123456', '09398475454', 'active', '2024-10-18 22:42:32', '2024-10-18 22:42:32'),
(8, 'Sue Yan Shin', 'sueyanshin', '123456', '09423700132', 'active', '2024-10-18 23:05:50', '2024-10-18 23:05:50'),
(9, 'Khant Thiha Htun', 'khantthihahtun1', '123456', '09423700132', 'active', '2024-10-19 17:58:14', '2024-10-19 17:58:14'),
(10, 'Sue Yan Shin', 'sueyanshin1', '123456', '09423700132', 'active', '2024-10-19 17:58:21', '2024-10-19 17:58:21'),
(11, 'Sue Yan Shin', 'sueyanshin2', '123456', '09423700132', 'active', '2024-10-19 17:58:27', '2024-10-19 17:58:27'),
(12, 'Sue Yan Shin', 'sueyanshin3', '123456', '09423700132', 'active', '2024-10-19 17:58:34', '2024-10-19 17:58:34'),
(13, 'Sue Yan Shin', 'sueyanshin4', '123456', '09423700132', 'active', '2024-10-19 17:58:40', '2024-10-19 17:58:40'),
(14, 'Sue Yan Shin', 'sueyanshin5', '123456', '09423700132', 'active', '2024-10-19 17:58:48', '2024-10-19 17:58:48'),
(15, 'Sue Yan Shin', 'sueyanshin6', '123456', '09423700132', 'active', '2024-10-19 17:58:54', '2024-10-19 17:58:54'),
(16, 'Sue Yan Shin', 'sueyanshin7', '123456', '09423700132', 'active', '2024-10-19 17:58:59', '2024-10-19 17:58:59'),
(17, 'Sue Yan Shin', 'sueyanshin8', '123456', '09423700132', 'active', '2024-10-19 17:59:06', '2024-10-19 17:59:06'),
(18, 'Sue Yan Shin', 'sueyanshin9', '123456', '09423700132', 'active', '2024-10-19 17:59:14', '2024-10-19 17:59:14'),
(19, 'Sue Yan Shin', 'sueyanshin10', '123456', '09423700132', 'active', '2024-10-19 17:59:20', '2024-10-19 17:59:20'),
(20, 'Sue Yan Shin', 'sueyanshin11', '123456', '09423700132', 'active', '2024-10-19 17:59:26', '2024-10-19 17:59:26'),
(21, 'Sue Yan Shin', 'sueyanshin12', '123456', '09423700132', 'active', '2024-10-19 17:59:32', '2024-10-19 17:59:32'),
(22, 'Sue Yan Shin', 'sueyanshin13', '123456', '09423700132', 'active', '2024-10-19 18:00:17', '2024-10-19 18:00:17'),
(23, 'Sue Yan Shin', 'sueyanshin14', '123456', '09423700132', 'active', '2024-10-19 18:00:25', '2024-10-19 18:00:25'),
(24, 'Sue Yan Shin', 'sueyanshin15', '123456', '09423700132', 'active', '2024-10-19 18:00:31', '2024-10-19 18:00:31'),
(25, 'Sue Yan Shin', 'sueyanshin16', '123456', '09423700132', 'active', '2024-10-19 18:00:37', '2024-10-19 18:00:37'),
(26, 'Sue Yan Shin', 'sueyanshin17', '123456', '09423700132', 'active', '2024-10-19 18:00:43', '2024-10-19 18:00:43'),
(27, 'Sue Yan Shin', 'sueyanshin18', '123456', '09423700132', 'active', '2024-10-19 18:00:50', '2024-10-19 18:00:50'),
(28, 'Sue Yan Shin', 'sueyanshin19', '123456', '09423700132', 'active', '2024-10-19 18:01:00', '2024-10-19 18:01:00'),
(29, 'Sue Yan Shin', 'sueyanshin20', '123456', '09423700132', 'active', '2024-10-19 18:01:06', '2024-10-19 18:01:06'),
(30, 'Sue Yan Shin', 'sueyanshin21', '123456', '09423700132', 'active', '2024-10-19 18:01:13', '2024-10-19 18:01:13'),
(31, 'Sue Yan Shin', 'sueyanshin22', '123456', '09423700132', 'active', '2024-10-19 18:01:18', '2024-10-19 18:01:18'),
(32, 'Sue Yan Shin', 'sueyanshin23', '123456', '09423700132', 'active', '2024-10-19 18:01:24', '2024-10-19 18:01:24'),
(33, 'Sue Yan Shin', 'sueyanshin24', '123456', '09423700132', 'active', '2024-10-19 18:01:38', '2024-10-19 18:01:38'),
(34, 'Sue Yan Shin', 'sueyanshin25', '123456', '09423700132', 'active', '2024-10-19 18:01:45', '2024-10-19 18:01:45'),
(35, 'Sue Yan Shin', 'sueyanshin26', '123456', '09423700132', 'active', '2024-10-19 18:01:52', '2024-10-19 18:01:52'),
(36, 'Sue Yan Shin', 'sueyanshin27', '123456', '09423700132', 'active', '2024-10-19 18:01:58', '2024-10-19 18:01:58'),
(37, 'Sue Yan Shin', 'sueyanshin28', '123456', '09423700132', 'active', '2024-10-19 18:02:07', '2024-10-19 18:02:07'),
(38, 'Sue Yan Shin', 'sueyanshin29', '123456', '09423700132', 'active', '2024-10-19 18:02:13', '2024-10-19 18:02:13'),
(39, 'Sue Yan Shin', 'sueyanshin30', '123456', '09423700132', 'active', '2024-10-19 18:02:18', '2024-10-19 18:02:18'),
(40, 'Sue Yan Shin', 'sueyanshin31', '123456', '09423700132', 'active', '2024-10-19 18:02:25', '2024-10-19 18:02:25'),
(41, 'Sue Yan Shin', 'sueyanshin32', '123456', '09423700132', 'active', '2024-10-19 18:02:32', '2024-10-19 18:02:32'),
(42, 'Sue Yan Shin', 'sueyanshin33', '123456', '09423700132', 'active', '2024-10-19 18:02:38', '2024-10-19 18:02:38'),
(43, 'Sue Yan Shin', 'sueyanshin34', '123456', '09423700132', 'active', '2024-10-19 18:02:46', '2024-10-19 18:02:46'),
(44, 'Sue Yan Shin', 'sueyanshin35', '123456', '09423700132', 'active', '2024-10-19 18:02:53', '2024-10-19 18:02:53'),
(45, 'Sue Yan Shin', 'sueyanshin36', '123456', '09423700132', 'active', '2024-10-19 18:03:14', '2024-10-19 18:03:14'),
(46, 'Sue Yan Shin', 'sueyanshin37', '123456', '09423700132', 'active', '2024-10-19 18:03:21', '2024-10-19 18:03:21'),
(47, 'Sue Yan Shin', 'sueyanshin38', '123456', '09423700132', 'active', '2024-10-19 18:03:27', '2024-10-19 18:03:27'),
(48, 'Sue Yan Shin', 'sueyanshin39', '123456', '09423700132', 'active', '2024-10-19 18:03:35', '2024-10-19 18:03:35'),
(49, 'Sue Yan Shin', 'sueyanshin40', '123456', '09423700132', 'active', '2024-10-19 18:03:42', '2024-10-19 18:03:42'),
(50, 'Sue Yan Shin', 'sueyanshin41', '123456', '09423700132', 'active', '2024-10-19 18:03:47', '2024-10-19 18:03:47'),
(51, 'Sue Yan Shin', 'sueyanshin42', '123456', '09423700132', 'active', '2024-10-19 18:03:52', '2024-10-19 18:03:52'),
(52, 'Sue Yan Shin', 'sueyanshin43', '123456', '09423700132', 'active', '2024-10-19 18:04:00', '2024-10-19 18:04:00'),
(53, 'Sue Yan Shin', 'sueyanshin44', '123456', '09423700132', 'active', '2024-10-19 18:04:06', '2024-10-19 18:04:06'),
(54, 'Sue Yan Shin', 'sueyanshin45', '123456', '09423700132', 'active', '2024-10-19 18:04:15', '2024-10-19 18:04:15'),
(55, 'Sue Yan Shin', 'sueyanshin46', '123456', '09423700132', 'active', '2024-10-19 18:04:23', '2024-10-19 18:04:23'),
(56, 'Sue Yan Shin', 'sueyanshin47', '123456', '09423700132', 'active', '2024-10-19 18:04:31', '2024-10-19 18:04:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
