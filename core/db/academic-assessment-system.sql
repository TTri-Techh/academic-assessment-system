-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 30, 2024 at 07:59 PM
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
-- Table structure for table `chapterly_assessment`
--

CREATE TABLE `chapterly_assessment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `chapter_no` int(11) DEFAULT NULL,
  `mark` varchar(4) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `month_no` varchar(11) DEFAULT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapterly_assessment`
--

INSERT INTO `chapterly_assessment` (`id`, `student_id`, `teacher_id`, `subject_id`, `class_id`, `chapter_id`, `chapter_no`, `mark`, `remark`, `month_no`, `year`, `created_at`, `updated_at`) VALUES
(11, 5, 2, 1, 1, 1, 1, 'A', 'အရမ်းချစ်တတ်', NULL, '2024', '2024-10-28 12:01:51', '2024-10-28 12:01:51'),
(12, 6, 2, 1, 1, 1, 1, 'E', 'လိုသေးတယ်', NULL, '2024', '2024-10-28 12:01:51', '2024-10-28 12:01:51'),
(13, 5, 2, 1, 1, 2, 2, NULL, NULL, NULL, '2024', '2024-10-28 12:05:03', '2024-10-28 12:05:03'),
(14, 6, 2, 1, 1, 2, 2, NULL, NULL, NULL, '2024', '2024-10-28 12:05:03', '2024-10-28 12:05:03'),
(15, 5, 2, 2, 1, 3, 1, 'A', '', NULL, '2024', '2024-10-28 12:05:20', '2024-10-28 12:05:20'),
(16, 6, 2, 2, 1, 3, 1, 'S', '', NULL, '2024', '2024-10-28 12:05:20', '2024-10-28 12:05:20'),
(17, 5, 2, 2, 1, 4, 2, NULL, NULL, NULL, '2024', '2024-10-28 12:06:03', '2024-10-28 12:06:03'),
(18, 6, 2, 2, 1, 4, 2, NULL, NULL, NULL, '2024', '2024-10-28 12:06:03', '2024-10-28 12:06:03'),
(19, 7, 3, 1, 4, 5, 1, 'A', '', NULL, '2024', '2024-10-28 20:37:37', '2024-10-28 20:37:37'),
(20, 8, 3, 1, 4, 5, 1, '', '', NULL, '2024', '2024-10-28 20:37:37', '2024-10-28 20:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `chapter` text DEFAULT NULL,
  `chapter_no` int(11) DEFAULT NULL,
  `learning_outcomes` text DEFAULT NULL,
  `check_points` text DEFAULT NULL,
  `month_no` varchar(11) DEFAULT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `class_id`, `chapter`, `chapter_no`, `learning_outcomes`, `check_points`, `month_no`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'အချစ်', 1, 'ချစ်တတ်ရန်', 'ချစ်သလား?', NULL, '2024', '2024-10-28 12:01:51', '2024-10-29 13:21:21'),
(2, 1, 1, NULL, 2, NULL, NULL, NULL, '2024', '2024-10-28 12:05:03', '2024-10-28 12:05:03'),
(3, 2, 1, 'Unit-1', 1, 'Fuck', 'knows how to fuck', NULL, '2024', '2024-10-28 12:05:20', '2024-10-28 12:10:23'),
(4, 2, 1, NULL, 2, NULL, NULL, NULL, '2024', '2024-10-28 12:06:03', '2024-10-28 12:06:03'),
(5, 1, 4, '', 1, '', '', NULL, '2024', '2024-10-28 20:37:37', '2024-10-29 13:52:10');

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
(0, 'Kindergarten', 'KG', 'KG', '2024-10-23 08:54:35'),
(1, 'Grade-1', 'ပထမတန်း', 'G-1', '2024-10-23 08:57:28'),
(2, 'Grade-2', 'ဒုတိယတန်း', 'G-2', '2024-10-23 08:57:56'),
(3, 'Grade-3', 'တတိယတန်း', 'G-3', '2024-10-23 08:57:56'),
(4, 'Grade-4', 'စတုတ္ထတန်း', 'G-4', '2024-10-23 08:58:20'),
(5, 'Grade-5', 'ပဥ္စမတန်း', 'G-5', '2024-10-23 08:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g0_students_assessment`
--

CREATE TABLE `g0_students_assessment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_result_id` int(11) NOT NULL,
  `mark_1` int(11) DEFAULT NULL,
  `mark_2` int(11) DEFAULT NULL,
  `mark_3` int(11) DEFAULT NULL,
  `mark_4` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `g0_students_assessment`
--

INSERT INTO `g0_students_assessment` (`id`, `student_id`, `teacher_id`, `subject_id`, `subject_result_id`, `mark_1`, `mark_2`, `mark_3`, `mark_4`, `year`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 1, 1, 2, 1, 4, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(2, 4, 1, 1, 2, 1, 2, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(3, 4, 1, 2, 3, 1, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(4, 4, 1, 2, 4, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(5, 4, 1, 2, 7, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(6, 4, 1, 2, 8, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(7, 4, 1, 3, 9, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(8, 4, 1, 3, 10, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(9, 4, 1, 3, 11, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(10, 4, 1, 3, 12, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(11, 4, 1, 3, 13, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(12, 4, 1, 4, 14, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(13, 4, 1, 4, 15, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(14, 4, 1, 4, 16, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(15, 4, 1, 5, 17, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(16, 4, 1, 5, 18, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(17, 4, 1, 6, 19, 0, 0, 0, 0, '2024', '2024-10-26 22:27:06', '2024-10-26 22:27:06'),
(18, 4, 1, 6, 20, 0, 0, 0, 0, '2024', '2024-10-26 22:27:06', '2024-10-26 22:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `g0_subjects`
--

CREATE TABLE `g0_subjects` (
  `id` int(11) NOT NULL,
  `subject_no` varchar(11) DEFAULT NULL,
  `subject_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `g0_subjects`
--

INSERT INTO `g0_subjects` (`id`, `subject_no`, `subject_name`) VALUES
(1, '၁', 'ကိုယ်စိတ်နှစ်ဖြာကျန်းမာချမ်းသာခြင်း'),
(2, '၂', 'စာရိတ္တ၊ မိတ္တနှင့် စိတ်လှုပ်ရှားမှုဆိုင်ရာဖွံ့ဖြိုးတိုးတက်ခြင်း'),
(3, '၃', 'အပြန်အလှန်ပြော ဆိုဆက်သွယ်ခြင်း'),
(4, '၄', 'သင်္ချာအခြေခံများကို စူးစမ်းခြင်း'),
(5, '၅', 'အနုပညာရသခံစားခြင်းနှင့် ဖန်တီးခြင်း'),
(6, '၆', 'ပတ်ဝန်းကျင်လောကကိုသိရှိနားလည်ခြင်း');

-- --------------------------------------------------------

--
-- Table structure for table `g0_subject_results`
--

CREATE TABLE `g0_subject_results` (
  `id` int(11) NOT NULL,
  `result_name` text DEFAULT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `g0_subject_results`
--

INSERT INTO `g0_subject_results` (`id`, `result_name`, `subject_id`) VALUES
(1, 'ကလေးများ ကျန်းမာသန်စွမ်းပြီး အခြားကလေးများနှင့်အတူတကွစုပေါင်းကစားနိုင်သည်။', 1),
(2, 'တစ်ကိုယ်ရေသန့်ရှင်းရေးအလေ့အကျင့်ကောင်းများကို နေ့စဉ်ပုံမှန်လုပ်ဆောင်နိုင်သည်။', 1),
(3, 'မိမိကိုယ်မိမိသိရှိပြီး မိမိနှင့်အခြားသူများအကြားတူညီမှု၊ ကွဲပြားခြားနားမှုတို့ကိုပြောပြနိုင်သည်။', 2),
(4, 'မိမိနေထိုင်ရာလူမှုပတ်ဝန်းကျင်တွင် ကောင်းသော အမူအကျင့်များကိုပြသနိုင်သည်။', 2),
(7, 'မိမိ မိသားစု အတွင်းအစဉ်အလာအရကျင်းပသောပွဲများနှင့်အခြားလူမျိုးစုများ၏ အစဉ်အလာအရ ကျင်းပသော\r\nပွဲတော်များတွင် ပါဝင်ပြီးအခြားလူမျိုးစုများ၏ယဉ်ကျေးမှုကိုလေးစားသည်။', 2),
(8, 'ပတ်ဝန်းကျင်ကို လွတ်လပ်စွာစူးစမ်း လေ့လာနိုင်သည်။', 2),
(9, 'စကားသံအမျိုးမျိုးကို နားထောင်၍အသံများကိုခွဲခြား နိုင်သည်။', 3),
(10, 'သီချင်းများ၊ ကဗျာများ၊ ပုံပြင်များ၊ ဇာတ်လမ်းများကိုနားထောင်ပြီးအမူအရာဖြင့် သရုပ်ဆောင်ပြနိုင်သည်။', 3),
(11, 'မေးခွန်းများကိုနားထောင်ပြီး မရှင်းလင်းသည်များကိုရှင်းပြရန်တောင်းဆိုတတ်သည်။\r\n', 3),
(12, 'ရုပ်ပုံများကို ကြည့်ပြီးပုံပြင်ကိုကြိုတင်ခန့်မှန်းနိုင်သည်။\n', 3),
(13, 'ဗျည်းအက္ခရာများ နှင့်ကိန်းများကို ခွဲခြားသတ်မှတ်နိုင်ပြီးအရစ်အဆွဲမှန်စွာဖြင့်ကူးရေးတတ်သည်။', 3),
(14, 'ပစ္စည်းအရေအတွက်မည်မျှရှိသည်ကိုအနီးစပ်ဆုံးခန့်မှန်းနိုင်သည်။', 4),
(15, 'သင်္ချာအခြေခံအသိသညာဖြစ်သောနှိုင်းယှဉ်ခြင်း၊အမျိုးအစား ခွဲခြားခြင်း၊တူရာ စုခြင်းစသည်တို့ကိုပြုလုပ် နိုင်သည်။', 4),
(16, 'ကိန်းများကို(၁မှ ၂၀)အထိသိ၍ ဖတ်တတ်ပြီး ရေတွက်သည်။', 4),
(17, 'အဝိုင်း အခြေခံ၊လူပုံများ၊ တိရစ္ဆာန်ပုံများနှင့်သစ်ပင်ပုံများကိုရေးဆွဲတတ်သည်။', 5),
(18, 'သီချင်း၊ ကဗျာများကို ကာရန်နှင့်အညီသီဆိုနိုင်ပြီးကခြင်း၊ လက်ခုပ်တီးခြင်းကိုပြုလုပ်နိုင်သည်။', 5),
(19, 'တိရစ္ဆာန်များ၊ သစ်ပင်များအကြောင်းသိရှိပြီးလူသားများနှင့်အပြန်အလှန်ဆက်သွယ်ပုံကိုပြောပြနိုင်သည်။', 6),
(20, 'အရာဝတ္ထုများ၊ ပစ္စည်းများကိုအာရုံ(၅)ပါးသုံးပြီးစူးစမ်းလေ့လာနိုင်သည်။', 6);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_assessment`
--

CREATE TABLE `monthly_assessment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `monthly_chapter_id` int(11) NOT NULL,
  `mark` varchar(4) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `month_no` varchar(11) DEFAULT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_assessment`
--

INSERT INTO `monthly_assessment` (`id`, `student_id`, `teacher_id`, `subject_id`, `class_id`, `monthly_chapter_id`, `mark`, `remark`, `month_no`, `year`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 1, 1, 1, 'A', 'sooo goat like me', '1', '2024', '2024-10-28 10:57:27', '2024-10-28 10:57:27'),
(2, 6, 2, 1, 1, 1, 'E', 'so bad', '1', '2024', '2024-10-28 10:57:27', '2024-10-28 10:57:27'),
(3, 5, 2, 1, 1, 2, 'S', '', '2', '2024', '2024-10-28 10:57:31', '2024-10-28 10:57:31'),
(4, 6, 2, 1, 1, 2, '', '', '2', '2024', '2024-10-28 10:57:31', '2024-10-28 10:57:31'),
(5, 5, 2, 1, 1, 3, 'A', '', '3', '2024', '2024-10-28 10:57:41', '2024-10-28 10:57:41'),
(6, 6, 2, 1, 1, 3, '', '', '3', '2024', '2024-10-28 10:57:41', '2024-10-28 10:57:41'),
(7, 5, 2, 1, 1, 4, 'A', '', '4', '2024', '2024-10-28 11:04:48', '2024-10-28 11:04:48'),
(8, 6, 2, 1, 1, 4, '', '', '4', '2024', '2024-10-28 11:04:48', '2024-10-28 11:04:48'),
(9, 5, 2, 2, 1, 5, 'S', '', '1', '2024', '2024-10-28 11:31:03', '2024-10-28 11:31:03'),
(10, 6, 2, 2, 1, 5, '', '', '1', '2024', '2024-10-28 11:31:03', '2024-10-28 11:31:03'),
(11, 5, 2, 3, 1, 6, 'A', '', '1', '2024', '2024-10-29 22:57:13', '2024-10-29 22:57:13'),
(12, 6, 2, 3, 1, 6, '', '', '1', '2024', '2024-10-29 22:57:13', '2024-10-29 22:57:13'),
(13, 5, 2, 4, 1, 7, 'A', '', '1', '2024', '2024-10-29 22:57:19', '2024-10-29 22:57:19'),
(14, 6, 2, 4, 1, 7, '', '', '1', '2024', '2024-10-29 22:57:19', '2024-10-29 22:57:19'),
(15, 5, 2, 5, 1, 8, 'S', '', '1', '2024', '2024-10-29 22:57:24', '2024-10-29 22:57:24'),
(16, 6, 2, 5, 1, 8, '', '', '1', '2024', '2024-10-29 22:57:25', '2024-10-29 22:57:25'),
(17, 5, 2, 2, 1, 9, 'A', '', '2', '2024', '2024-10-30 00:16:52', '2024-10-30 00:16:52'),
(18, 6, 2, 2, 1, 9, '', '', '2', '2024', '2024-10-30 00:16:53', '2024-10-30 00:16:53'),
(19, 5, 2, 2, 1, 10, 'S', '', '3', '2024', '2024-10-30 00:17:00', '2024-10-30 00:17:00'),
(20, 6, 2, 2, 1, 10, '', '', '3', '2024', '2024-10-30 00:17:00', '2024-10-30 00:17:00'),
(21, 5, 2, 2, 1, 11, 'S', '', '4', '2024', '2024-10-30 00:17:07', '2024-10-30 00:17:07'),
(22, 6, 2, 2, 1, 11, '', '', '4', '2024', '2024-10-30 00:17:07', '2024-10-30 00:17:07'),
(23, 5, 2, 3, 1, 12, 'S', '', '3', '2024', '2024-10-30 00:17:21', '2024-10-30 00:17:21'),
(24, 6, 2, 3, 1, 12, '', '', '3', '2024', '2024-10-30 00:17:21', '2024-10-30 00:17:21'),
(25, 5, 2, 3, 1, 13, 'S', '', '2', '2024', '2024-10-30 00:17:23', '2024-10-30 00:17:23'),
(26, 6, 2, 3, 1, 13, '', '', '2', '2024', '2024-10-30 00:17:23', '2024-10-30 00:17:23'),
(27, 5, 2, 3, 1, 14, 'S', '', '4', '2024', '2024-10-30 00:17:36', '2024-10-30 00:17:36'),
(28, 6, 2, 3, 1, 14, '', '', '4', '2024', '2024-10-30 00:17:36', '2024-10-30 00:17:36'),
(29, 5, 2, 4, 1, 15, 'S', '', '2', '2024', '2024-10-30 00:17:54', '2024-10-30 00:17:54'),
(30, 6, 2, 4, 1, 15, '', '', '2', '2024', '2024-10-30 00:17:54', '2024-10-30 00:17:54'),
(31, 5, 2, 4, 1, 16, 'A', '', '3', '2024', '2024-10-30 00:18:00', '2024-10-30 00:18:00'),
(32, 6, 2, 4, 1, 16, '', '', '3', '2024', '2024-10-30 00:18:00', '2024-10-30 00:18:00'),
(33, 5, 2, 4, 1, 17, 'A', '', '4', '2024', '2024-10-30 00:18:05', '2024-10-30 00:18:05'),
(34, 6, 2, 4, 1, 17, '', '', '4', '2024', '2024-10-30 00:18:05', '2024-10-30 00:18:05'),
(35, 5, 2, 5, 1, 18, 'A', '', '2', '2024', '2024-10-30 00:18:49', '2024-10-30 00:18:49'),
(36, 6, 2, 5, 1, 18, '', '', '2', '2024', '2024-10-30 00:18:49', '2024-10-30 00:18:49'),
(37, 5, 2, 5, 1, 19, 'S', '', '3', '2024', '2024-10-30 00:18:54', '2024-10-30 00:18:54'),
(38, 6, 2, 5, 1, 19, '', '', '3', '2024', '2024-10-30 00:18:54', '2024-10-30 00:18:54'),
(39, 5, 2, 5, 1, 20, 'A', '', '4', '2024', '2024-10-30 00:19:01', '2024-10-30 00:19:01'),
(40, 6, 2, 5, 1, 20, '', '', '4', '2024', '2024-10-30 00:19:02', '2024-10-30 00:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_chapters`
--

CREATE TABLE `monthly_chapters` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `chapter` text DEFAULT NULL,
  `learning_outcomes` text DEFAULT NULL,
  `check_points` text DEFAULT NULL,
  `month_no` varchar(11) DEFAULT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_chapters`
--

INSERT INTO `monthly_chapters` (`id`, `subject_id`, `class_id`, `chapter`, `learning_outcomes`, `check_points`, `month_no`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Ch-1', '', '', '1', '2024', '2024-10-28 10:57:27', '2024-10-28 12:11:01'),
(2, 1, 1, '', '', '', '2', '2024', '2024-10-28 10:57:31', '2024-10-30 00:16:24'),
(3, 1, 1, 'Ch-13', '', '', '3', '2024', '2024-10-28 10:57:39', '2024-10-28 10:57:54'),
(4, 1, 1, '', '', '', '4', '2024', '2024-10-28 11:04:48', '2024-10-30 00:16:40'),
(5, 2, 1, '', '', '', '1', '2024', '2024-10-28 11:31:02', '2024-10-29 22:58:40'),
(6, 3, 1, '', '', '', '1', '2024', '2024-10-29 22:57:13', '2024-10-29 23:17:31'),
(7, 4, 1, '', '', '', '1', '2024', '2024-10-29 22:57:19', '2024-10-29 22:57:23'),
(8, 5, 1, '', '', '', '1', '2024', '2024-10-29 22:57:24', '2024-10-29 22:57:30'),
(9, 2, 1, '', '', '', '2', '2024', '2024-10-30 00:16:52', '2024-10-30 00:16:58'),
(10, 2, 1, '', '', '', '3', '2024', '2024-10-30 00:17:00', '2024-10-30 00:17:04'),
(11, 2, 1, '', '', '', '4', '2024', '2024-10-30 00:17:07', '2024-10-30 00:17:11'),
(12, 3, 1, '', '', '', '3', '2024', '2024-10-30 00:17:21', '2024-10-30 00:17:34'),
(13, 3, 1, '', '', '', '2', '2024', '2024-10-30 00:17:22', '2024-10-30 00:17:27'),
(14, 3, 1, '', '', '', '4', '2024', '2024-10-30 00:17:36', '2024-10-30 00:17:42'),
(15, 4, 1, '', '', '', '2', '2024', '2024-10-30 00:17:54', '2024-10-30 00:17:57'),
(16, 4, 1, '', '', '', '3', '2024', '2024-10-30 00:18:00', '2024-10-30 00:18:03'),
(17, 4, 1, '', '', '', '4', '2024', '2024-10-30 00:18:05', '2024-10-30 00:18:12'),
(18, 5, 1, '', '', '', '2', '2024', '2024-10-30 00:18:49', '2024-10-30 00:18:52'),
(19, 5, 1, '', '', '', '3', '2024', '2024-10-30 00:18:54', '2024-10-30 00:18:58'),
(20, 5, 1, '', '', '', '4', '2024', '2024-10-30 00:19:00', '2024-10-30 00:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_test`
--

CREATE TABLE `monthly_test` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `myanmar_mark` int(11) DEFAULT NULL,
  `myanmar_grade` varchar(11) DEFAULT NULL,
  `english_mark` int(11) DEFAULT NULL,
  `english_grade` varchar(11) DEFAULT NULL,
  `math_mark` int(11) DEFAULT NULL,
  `math_grade` varchar(11) DEFAULT NULL,
  `science_mark` int(11) DEFAULT NULL,
  `science_grade` varchar(11) DEFAULT NULL,
  `social_mark` int(11) DEFAULT NULL,
  `social_grade` varchar(11) DEFAULT NULL,
  `total_mark` int(11) DEFAULT NULL,
  `total_grade` varchar(11) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `month_no` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_test`
--

INSERT INTO `monthly_test` (`id`, `student_id`, `class_id`, `teacher_id`, `myanmar_mark`, `myanmar_grade`, `english_mark`, `english_grade`, `math_mark`, `math_grade`, `science_mark`, `science_grade`, `social_mark`, `social_grade`, `total_mark`, `total_grade`, `result`, `month_no`, `year`, `created_at`, `updated_at`) VALUES
(1, 7, 4, 3, 78, 'B', 67, 'B', 90, 'A', 100, 'A', 39, 'D', 374, 'B', 'Fail', 1, '2024', '2024-10-29 14:29:35', '2024-10-29 14:29:35'),
(2, 8, 4, 3, 50, 'C', 60, 'B', 66, 'B', 80, 'A', 100, 'A', 356, 'B', 'Pass', 1, '2024', '2024-10-29 14:29:36', '2024-10-29 14:29:36'),
(3, 7, 4, 3, 77, 'B', 54, 'C', 66, 'B', 80, 'A', 87, 'A', 364, 'B', 'Pass', 2, '2024', '2024-10-29 23:48:58', '2024-10-29 23:48:58'),
(4, 8, 4, 3, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', 2, '2024', '2024-10-29 23:48:58', '2024-10-29 23:48:58'),
(5, 7, 4, 3, 45, 'C', 34, 'D', 34, 'D', 34, 'D', 23, 'D', 170, 'D', 'Fail', 3, '2024', '2024-10-30 00:11:06', '2024-10-30 00:11:06'),
(6, 8, 4, 3, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', 3, '2024', '2024-10-30 00:11:06', '2024-10-30 00:11:06'),
(7, 7, 4, 3, 70, 'B', 54, 'C', 67, 'B', 80, 'A', 90, 'A', 361, 'B', 'Pass', 4, '2024', '2024-10-30 00:11:28', '2024-10-30 00:11:28'),
(8, 8, 4, 3, 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', 4, '2024', '2024-10-30 00:11:28', '2024-10-30 00:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `qcpr`
--

CREATE TABLE `qcpr` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qcpr`
--

INSERT INTO `qcpr` (`id`, `class_id`, `teacher_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2024-10-29 17:13:06', '2024-10-30 00:56:20'),
(2, 4, 3, 1, '2024-10-29 23:33:20', '2024-10-29 23:34:48'),
(3, 0, 1, 0, '2024-10-31 01:25:37', '2024-10-31 01:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `chapter_no` varchar(255) DEFAULT NULL,
  `chapter_name` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `enrollment_no` varchar(15) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_mm` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '123456',
  `password_status` int(11) NOT NULL DEFAULT 0,
  `dob` date NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `parent_job` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `class_id`, `enrollment_no`, `name_en`, `name_mm`, `username`, `password`, `password_status`, `dob`, `father_name`, `mother_name`, `guardian`, `parent_job`, `phone`, `address`, `created_at`) VALUES
(4, 0, 'Qui nostrud acc', 'Dillon Benton', 'Evan Leach', 'dillonbenton', '123456', 0, '2016-04-03', 'Ina Chan', 'Daryl Murphy', 'Labore eum ipsa ill', 'Aspernatur alias cor', '09398475454', 'Cupiditate aut est ', '2024-10-26 16:41:04'),
(5, 1, '0002', 'Kyaw Kyaw', 'ကျော်ကျော်', 'kyawkyaw', '$2y$10$kUbGTulDptVG5GuaHyz3kO1LfW3vkzV0xe5.PD8Ski/lkuUoDKQQ2', 1, '2017-08-28', 'Nayda Rose', 'Brett Farley', 'Rerum duis voluptas ', 'Quia et ex quam odio', '09398475454', 'Sit architecto ea s', '2024-10-28 00:01:50'),
(6, 1, '0003', 'Khant Si Thu', 'Garrett Chan', 'khantsithu', '123456', 0, '2019-11-24', 'Bertha Nixon', 'Ayanna Strong', 'Ea tempore inventor', 'Neque suscipit offic', '09398475454', 'Maiores aliquid illo', '2024-10-28 01:29:52'),
(7, 4, '0004', 'Sein Sein', 'စိန်စိန်', 'seinsein', '$2y$10$Ly.2fkBZbS9rq/nydQ2hju55QMfTK6AXqIT90NcmdkbYx0QSa13DG', 1, '1976-10-18', 'Ira Coffey', 'Ethan Bridges', 'Aut quaerat mollit i', 'Et hic nisi iste con', '09398475454', 'Assumenda est culpa', '2024-10-28 14:49:46'),
(8, 4, '0005', 'Olivia', 'အိုလစ်ဗျာ', 'olivia', '123456', 0, '2010-07-01', 'Clark Nguyen', 'Lester Mathis', 'Dolore voluptatem C', 'Aut non veritatis no', '09398475454', 'Ut quis est ut dolor', '2024-10-28 14:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(1, 'မြန်မာစာ'),
(2, 'အင်္ဂလိပ်စာ'),
(3, 'သင်္ချာ'),
(4, 'သိပ္ပံ'),
(5, 'လူမှုရေး');

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
(1, 'U KO KO Gyi', 'ဦးကိုကိုကြီး', 'ukokogyi', 'ဦးမောင်မောင်ကြီး', 'ဒေါ်ဒေါ်ကြီး', 'B.Sc(Phys)', 'မူပြ', 0, '1981-04-25', '1975-02-12', '1970-01-15', '1973-05-18', '$2y$10$32HfsiZoWQV2ZgXoh0aE/OQRNFL.vOQ0WK0/g7tPhlWhWamHdfpzC', 1, '09398475454', 'active', 'Voluptatem dicta fac', 'ပြီး', 'မပြီး', 'Non nemo proident n', '2024-10-23 14:01:12', '2024-10-23 14:01:12'),
(2, 'Daw Phyu Phyu Win', 'ဒေါ်ဖြူဖြူဝင်း', 'dawphyuphyuwin', 'Desiree Bolton', 'Aladdin Gill', 'Veritatis id rerum e', 'Qui est sit commodo ', 1, '1995-02-09', '2001-06-15', '1991-03-15', '2005-01-28', '$2y$10$tPMSpEGDZkTXziWX9fYeuOVK4VoIBtbdrHhKMwqwfa04sHi07tJuW', 1, '09398475454', 'active', 'Qui ex officia elit', 'ပြီး', 'မပြီး', 'Dolorem laborum nost', '2024-10-23 14:01:28', '2024-10-23 14:01:28'),
(3, 'Ko Myo Min Ko', 'ကိုမျိုးမင်းကို', 'komyominko', 'Robin Gill', 'Rajah Morton', 'Minima corporis dele', 'Molestiae commodi ei', 4, '1981-04-25', '1975-02-12', '1970-01-15', '1973-05-18', '$2y$10$yrVF7udw.fnl49omZDHmv.71G0sLDQ/qAZYYn/nofJpuuO65s/05.', 1, '09398475454', 'active', 'Voluptatem dicta fac', 'ပြီး', 'မပြီး', 'Non nemo proident n', '2024-10-23 16:35:12', '2024-10-23 16:35:12'),
(5, 'Cherokee Clemons', 'Karen Trevino', 'cherokeeclemons', 'Scarlet Alvarez', 'Yvonne Trevino', 'Maxime velit est est', 'Et qui aliquid labor', 5, '2001-07-23', '2003-11-13', '1982-11-27', '2003-08-25', '123456', 0, '09398475454', 'active', 'Magni eius dolor off', 'မပြီး', 'မပြီး', 'Repudiandae exercita', '2024-10-28 15:51:21', '2024-10-28 15:51:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapterly_assessment`
--
ALTER TABLE `chapterly_assessment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `monthly_assessment_ibfk_5` (`class_id`),
  ADD KEY `monthly_assessment_ibfk_4` (`chapter_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `g0_students_assessment`
--
ALTER TABLE `g0_students_assessment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `subject_result_id` (`subject_result_id`);

--
-- Indexes for table `g0_subjects`
--
ALTER TABLE `g0_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `g0_subject_results`
--
ALTER TABLE `g0_subject_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `monthly_assessment`
--
ALTER TABLE `monthly_assessment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `monthly_assessment_ibfk_5` (`class_id`),
  ADD KEY `monthly_assessment_ibfk_4` (`monthly_chapter_id`);

--
-- Indexes for table `monthly_chapters`
--
ALTER TABLE `monthly_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `monthly_test`
--
ALTER TABLE `monthly_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `qcpr`
--
ALTER TABLE `qcpr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
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
-- AUTO_INCREMENT for table `chapterly_assessment`
--
ALTER TABLE `chapterly_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g0_students_assessment`
--
ALTER TABLE `g0_students_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `g0_subjects`
--
ALTER TABLE `g0_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `g0_subject_results`
--
ALTER TABLE `g0_subject_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `monthly_assessment`
--
ALTER TABLE `monthly_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `monthly_chapters`
--
ALTER TABLE `monthly_chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `monthly_test`
--
ALTER TABLE `monthly_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `qcpr`
--
ALTER TABLE `qcpr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapterly_assessment`
--
ALTER TABLE `chapterly_assessment`
  ADD CONSTRAINT `chapterly_assessment_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapterly_assessment_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapterly_assessment_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapterly_assessment_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapterly_assessment_ibfk_5` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `g0_students_assessment`
--
ALTER TABLE `g0_students_assessment`
  ADD CONSTRAINT `g0_students_assessment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `g0_students_assessment_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `g0_students_assessment_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `g0_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `g0_students_assessment_ibfk_4` FOREIGN KEY (`subject_result_id`) REFERENCES `g0_subject_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `g0_subject_results`
--
ALTER TABLE `g0_subject_results`
  ADD CONSTRAINT `g0_subject_results_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `g0_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monthly_assessment`
--
ALTER TABLE `monthly_assessment`
  ADD CONSTRAINT `monthly_assessment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_assessment_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_assessment_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_assessment_ibfk_4` FOREIGN KEY (`monthly_chapter_id`) REFERENCES `monthly_chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_assessment_ibfk_5` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monthly_chapters`
--
ALTER TABLE `monthly_chapters`
  ADD CONSTRAINT `monthly_chapters_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_chapters_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monthly_test`
--
ALTER TABLE `monthly_test`
  ADD CONSTRAINT `monthly_test_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_test_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_test_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qcpr`
--
ALTER TABLE `qcpr`
  ADD CONSTRAINT `qcpr_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qcpr_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
