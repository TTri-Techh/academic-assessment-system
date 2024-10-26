-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 26, 2024 at 07:09 PM
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
(0, 'Kindergarten', 'သူငယ်တန်း', 'KG', '2024-10-23 08:54:35'),
(1, 'Grade-1', 'ပထမတန်း', 'G-1', '2024-10-23 08:57:28'),
(2, 'Grade-2', 'ဒုတိယတန်း', 'G-2', '2024-10-23 08:57:56'),
(3, 'Grade-3', 'တတိယတန်း', 'G-3', '2024-10-23 08:57:56'),
(4, 'Grade-4', 'စတုတ္ထတန်း', 'G-4', '2024-10-23 08:58:20'),
(5, 'Grade-5', 'ပဥ္စမတန်း', 'G-5', '2024-10-23 08:58:20');

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
(1, 4, 1, 1, 1, 1, 1, 1, 4, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(2, 4, 1, 1, 2, 1, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
(3, 4, 1, 2, 3, 0, 0, 0, 0, '2024', '2024-10-26 22:27:05', '2024-10-26 22:27:05'),
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
(4, 0, 'Qui nostrud acc', 'Dillon Benton', 'Evan Leach', 'dillonbenton', '123456', 0, '2016-04-03', 'Ina Chan', 'Daryl Murphy', 'Labore eum ipsa ill', 'Aspernatur alias cor', '09398475454', 'Cupiditate aut est ', '2024-10-26 16:41:04');

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
(1, 'U KO KO Gyi', 'ဦးကိုကိုကြီး', 'ukokogyi', 'ဦးမောင်မောင်ကြီး', 'ဒေါ်ဒေါ်ကြီး', 'B.Sc(Phys)', 'မူပြ', 0, '1981-04-25', '1975-02-12', '1970-01-15', '1973-05-18', '$2y$10$eRtzhx7oYsIIsdTfifmnQ.Ao72Xx1decj9X/hhn0/Y1Cdf8R55gVK', 1, '09398475454', 'active', 'Voluptatem dicta fac', 'ပြီး', 'မပြီး', 'Non nemo proident n', '2024-10-23 14:01:12', '2024-10-23 14:01:12'),
(2, 'Linda Acevedo', 'Holmes Patton', 'lindaacevedo', 'Desiree Bolton', 'Aladdin Gill', 'Veritatis id rerum e', 'Qui est sit commodo ', 1, '1995-02-09', '2001-06-15', '1991-03-15', '2005-01-28', '$2y$10$OHX953Iluf5/0CgW2gC63.gXuUK6uV4.D4yANXdtYjpjokIYxIZqK', 1, '09398475454', 'active', 'Qui ex officia elit', 'ပြီး', 'မပြီး', 'Dolorem laborum nost', '2024-10-23 14:01:28', '2024-10-23 14:01:28'),
(3, 'south paw', 'Claudia Yates', 'cassandrablake1', 'Robin Gill', 'Rajah Morton', 'Minima corporis dele', 'Molestiae commodi ei', 0, '1981-04-25', '1975-02-12', '1970-01-15', '1973-05-18', '$2y$10$riEGrhh2txP4e02VgXNMUuMd7mCX3SudY7AXWdF0Cbzvt/KLVLE8q', 1, '09398475454', 'inactive', 'Voluptatem dicta fac', 'ပြီး', 'မပြီး', 'Non nemo proident n', '2024-10-23 16:35:12', '2024-10-23 16:35:12');

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

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
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

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
