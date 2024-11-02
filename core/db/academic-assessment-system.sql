-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 02, 2024 at 05:35 AM
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
(5, 'လူမှုရေး'),
(6, 'ပန်းချီ'),
(7, 'ဂီတ'),
(8, 'ကာယ'),
(9, 'စာရိတ္တ'),
(10, 'ဘဝတွက်တာ');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monthly_chapters`
--
ALTER TABLE `monthly_chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monthly_test`
--
ALTER TABLE `monthly_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qcpr`
--
ALTER TABLE `qcpr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
