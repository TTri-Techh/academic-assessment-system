-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 23, 2024 at 12:40 PM
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
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name_eng` varchar(255) NOT NULL,
  `class_name_mm` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name_eng`, `class_name_mm`, `grade_level`, `created_at`) VALUES
(1, 'Kindergarten', 'သူငယ်တန်း', 'KG', '2024-10-23 08:54:35'),
(2, 'Grade-1', 'ပထမတန်း', 'G-1', '2024-10-23 08:57:28'),
(3, 'Grade-2', 'ဒုတိယတန်း', 'G-2', '2024-10-23 08:57:56'),
(4, 'Grade-3', 'တတိယတန်း', 'G-3', '2024-10-23 08:57:56'),
(5, 'Grade-4', 'စတုတ္ထတန်း', 'G-4', '2024-10-23 08:58:20'),
(6, 'Grade-5', 'ပဥ္စမတန်း', 'G-5', '2024-10-23 08:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name_eng` varchar(255) NOT NULL,
  `name_mm` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `education` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `start_edu_at` date DEFAULT NULL,
  `start_current_rank_at` date DEFAULT NULL,
  `start_current_school_at` date DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '123456',
  `password_status` int(11) NOT NULL DEFAULT 0,
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('active','inactive','','') NOT NULL DEFAULT 'active',
  `address` varchar(255) DEFAULT NULL,
  `bed_status` enum('မပြီး','ပြီး','','') NOT NULL DEFAULT 'မပြီး',
  `phaung_gyi_status` enum('မပြီး','ပြီး','','') NOT NULL DEFAULT 'မပြီး',
  `completed_course` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name_eng`, `name_mm`, `username`, `father_name`, `mother_name`, `education`, `rank`, `class_id`, `dob`, `start_edu_at`, `start_current_rank_at`, `start_current_school_at`, `password`, `password_status`, `phone`, `status`, `address`, `bed_status`, `phaung_gyi_status`, `completed_course`, `created_at`, `updated_at`) VALUES
(1, 'U KO KO', 'koko myan', 'cassandrablake', 'Robin Gill', 'Rajah Morton', 'Minima corporis dele', 'Molestiae commodi ei', 2, '1981-04-25', '1975-02-12', '1970-01-15', '1973-05-18', '123456', 0, '09398475454', 'active', 'Voluptatem dicta fac', 'ပြီး', 'မပြီး', 'Non nemo proident n', '2024-10-23 14:01:12', '2024-10-23 14:01:12'),
(2, 'Linda Acevedo', 'Holmes Patton', 'lindaacevedo', 'Desiree Bolton', 'Aladdin Gill', 'Veritatis id rerum e', 'Qui est sit commodo ', 1, '1995-02-09', '2001-06-15', '1991-03-15', '2005-01-28', '123456', 0, '09398475454', 'active', 'Qui ex officia elit', 'ပြီး', 'မပြီး', 'Dolorem laborum nost', '2024-10-23 14:01:28', '2024-10-23 14:01:28'),
(3, 'south paw', 'Claudia Yates', 'cassandrablake1', 'Robin Gill', 'Rajah Morton', 'Minima corporis dele', 'Molestiae commodi ei', NULL, '1981-04-25', '1975-02-12', '1970-01-15', '1973-05-18', '123456', 0, '09398475454', 'inactive', 'Voluptatem dicta fac', 'ပြီး', 'မပြီး', 'Non nemo proident n', '2024-10-23 16:35:12', '2024-10-23 16:35:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_name` (`name_eng`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
