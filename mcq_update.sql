-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2020 at 08:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmcq`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE `allocation` (
  `subject_id` varchar(10) NOT NULL,
  `teacher_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`subject_id`, `teacher_id`) VALUES
('ES145', 'root'),
('PS4', '24');

-- --------------------------------------------------------

--
-- Table structure for table `attempt_choice`
--

CREATE TABLE `attempt_choice` (
  `student_id` varchar(100) NOT NULL,
  `exam_choice_id` bigint(20) UNSIGNED NOT NULL,
  `is_marked` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attempt_choice`
--

INSERT INTO `attempt_choice` (`student_id`, `exam_choice_id`, `is_marked`) VALUES
('18', 37, '0'),
('18', 38, '0'),
('18', 39, '0'),
('18', 40, '0'),
('18', 41, '0'),
('18', 42, '0'),
('18', 43, '0'),
('18', 44, '0'),
('18', 45, '0'),
('18', 46, '0'),
('18', 47, '0'),
('18', 48, '0'),
('19', 37, '1'),
('19', 38, '0'),
('19', 39, '0'),
('19', 40, '0'),
('19', 41, '0'),
('19', 42, '0'),
('19', 43, '0'),
('19', 44, '0'),
('19', 45, '0'),
('19', 46, '0'),
('19', 47, '0'),
('19', 48, '0'),
('20', 37, '0'),
('20', 38, '0'),
('20', 39, '0'),
('20', 40, '0'),
('20', 41, '0'),
('20', 42, '0'),
('20', 43, '0'),
('20', 44, '0'),
('20', 45, '0'),
('20', 46, '0'),
('20', 47, '0'),
('20', 48, '0'),
('24', 37, '1'),
('24', 38, '0'),
('24', 39, '0'),
('24', 40, '0'),
('24', 41, '0'),
('24', 42, '1'),
('24', 43, '0'),
('24', 44, '0'),
('24', 45, '0'),
('24', 46, '1'),
('24', 47, '0'),
('24', 48, '0'),
('30', 37, '1'),
('30', 38, '0'),
('30', 39, '0'),
('30', 40, '0'),
('30', 41, '0'),
('30', 42, '1'),
('30', 43, '0'),
('30', 44, '0'),
('30', 45, '0'),
('30', 46, '0'),
('30', 47, '1'),
('30', 48, '0'),
('41', 37, '0'),
('41', 38, '0'),
('41', 39, '0'),
('41', 40, '0'),
('41', 41, '0'),
('41', 42, '0'),
('41', 43, '0'),
('41', 44, '0'),
('41', 45, '0'),
('41', 46, '0'),
('41', 47, '0'),
('41', 48, '0'),
('root', 37, '1'),
('root', 38, '0'),
('root', 39, '0'),
('root', 40, '0'),
('root', 41, '0'),
('root', 42, '0'),
('root', 43, '0'),
('root', 44, '1'),
('root', 45, '1'),
('root', 46, '0'),
('root', 47, '0'),
('root', 48, '0');

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `teacher_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `name`, `subject_id`, `teacher_id`) VALUES
(104, 'qwerty', 'ES145', 'root'),
(105, 'corona', 'ES145', 'root'),
(106, 'deadline khub headache diche', 'ES145', 'root'),
(107, 'Fun', 'ES145', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `choice`
--

CREATE TABLE `choice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `url` varchar(300) NOT NULL DEFAULT '-1',
  `is_right` enum('0','1') NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choice`
--

INSERT INTO `choice` (`id`, `name`, `url`, `is_right`, `question_id`) VALUES
(123, 'Abella Ranger', '-1', '1', 20),
(124, 'Soumya', '-1', '0', 20),
(125, ' Aymuos ', '-1', '0', 20),
(126, 'Dino James', '-1', '0', 20),
(127, '0', '-1', '1', 21),
(128, '1', '-1', '0', 21),
(129, ' 10', '-1', '0', 21),
(130, '11', '-1', '0', 21),
(131, 'Dettol', '-1', '1', 22),
(132, 'Savlon', '-1', '0', 22),
(133, ' Mercury', '-1', '0', 22),
(134, 'Water', '-1', '0', 22),
(135, 'Jessa Rhodes', '-1', '1', 23),
(136, 'Katana Kombat', '-1', '0', 23),
(137, '  Milly Esha', '-1', '0', 23),
(138, 'Leila', '-1', '0', 23);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `is_active` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `description` varchar(100) DEFAULT '',
  `create_time` bigint(20) UNSIGNED NOT NULL,
  `start_time` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `subject_id`, `teacher_id`, `is_active`, `description`, `create_time`, `start_time`) VALUES
(1524284, 'ES145', '24', '3', '', 1584780248, 1584872523),
(1524286, 'ES145', 'root', '0', '', 1584819682, 0),
(1524287, 'ES145', 'root', '0', '', 1584819689, 0),
(1524288, 'ES145', 'root', '0', '', 1584821909, 0),
(1524289, 'ES145', 'root', '0', '', 1584852800, 0),
(1524290, 'ES145', 'root', '0', '', 1584855377, 0),
(1524291, 'ES145', 'root', '0', '', 1584856771, 0),
(1524292, 'ES145', 'root', '0', '', 1584856914, 0),
(1524293, 'ES145', 'root', '0', '', 1584857689, 0),
(1524294, 'ES145', 'root', '0', '', 1584858035, 0),
(1524295, 'ES145', 'root', '0', '', 1584858295, 0),
(1524296, 'ES145', 'root', '3', '', 1584864329, 1584872523),
(1524297, 'ES145', 'root', '0', '', 1584864986, 0),
(1524298, 'ES145', 'root', '0', '', 1584864992, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_choice`
--

CREATE TABLE `exam_choice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `url` varchar(300) NOT NULL,
  `exam_question_id` bigint(20) UNSIGNED NOT NULL,
  `is_right` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_choice`
--

INSERT INTO `exam_choice` (`id`, `name`, `url`, `exam_question_id`, `is_right`) VALUES
(25, 'Abella Ranger', '-1', 27, '1'),
(26, 'Soumya', '-1', 27, '0'),
(27, ' Aymuos ', '-1', 27, '0'),
(28, 'Dino James', '-1', 27, '0'),
(29, '0', '-1', 28, '1'),
(30, '1', '-1', 28, '0'),
(31, ' 10', '-1', 28, '0'),
(32, '11', '-1', 28, '0'),
(33, 'Dettol', '-1', 29, '1'),
(34, 'Savlon', '-1', 29, '0'),
(35, ' Mercury', '-1', 29, '0'),
(36, 'Water', '-1', 29, '0'),
(37, 'Abella Ranger', '-1', 30, '1'),
(38, 'Soumya', '-1', 30, '0'),
(39, ' Aymuos ', '-1', 30, '0'),
(40, 'Dino James', '-1', 30, '0'),
(41, '0', '-1', 31, '1'),
(42, '1', '-1', 31, '0'),
(43, ' 10', '-1', 31, '0'),
(44, '11', '-1', 31, '0'),
(45, 'Dettol', '-1', 32, '1'),
(46, 'Savlon', '-1', 32, '0'),
(47, ' Mercury', '-1', 32, '0'),
(48, 'Water', '-1', 32, '0'),
(49, 'Abella Ranger', '-1', 33, '1'),
(50, 'Soumya', '-1', 33, '0'),
(51, ' Aymuos ', '-1', 33, '0'),
(52, 'Dino James', '-1', 33, '0'),
(53, '0', '-1', 34, '1'),
(54, '1', '-1', 34, '0'),
(55, ' 10', '-1', 34, '0'),
(56, '11', '-1', 34, '0');

-- --------------------------------------------------------

--
-- Table structure for table `exam_mark`
--

CREATE TABLE `exam_mark` (
  `student_id` varchar(100) NOT NULL,
  `exam_question_id` bigint(20) UNSIGNED NOT NULL,
  `mark` int(11) NOT NULL DEFAULT 0,
  `shuffle` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_mark`
--

INSERT INTO `exam_mark` (`student_id`, `exam_question_id`, `mark`, `shuffle`) VALUES
('18', 30, 0, '2.0.3.1'),
('18', 31, 0, '1.2.3.0'),
('18', 32, 0, '2.3.1.0'),
('19', 30, 1, '2.3.1.0'),
('19', 31, 0, '0.1.2.3'),
('19', 32, 0, '1.3.2.0'),
('20', 30, 0, '1.2.3.0'),
('20', 31, 0, '0.3.2.1'),
('20', 32, 0, '1.2.3.0'),
('24', 30, 1, '1.3.2.0'),
('24', 31, 0, '0.1.2.3'),
('24', 32, 0, '1.0.2.3'),
('30', 30, 1, '2.1.3.0'),
('30', 31, 0, '0.3.2.1'),
('30', 32, 0, '3.1.0.2'),
('41', 30, 0, '2.0.1.3'),
('41', 31, 0, '0.1.2.3'),
('41', 32, 0, '0.2.3.1'),
('root', 30, 1, '3.0.1.2'),
('root', 31, 0, '3.0.1.2'),
('root', 32, 1, '0.1.2.3');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE `exam_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `url` varchar(300) NOT NULL DEFAULT '-1',
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`id`, `name`, `url`, `exam_id`, `chapter_name`) VALUES
(27, 'who is she?', 'uploads/20.jpg', 1524295, 'qwerty'),
(28, 'test question', '', 1524295, 'qwerty'),
(29, 'what is this', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACCCAYAAACKAxD9AAAgAElEQVR4AeydBXRd15X3lTaTdmbaybSZYtqmaRomJ2YGycwUc+yY7cTMbMvMzJYZxMzMzCwLLFlMFj7W0+9b+8rPUbPapl87ieVZPmtd3af78J79P5v3PmY860MH6AEjtGKkBYNyyGM5aAWj0YhGp0ZtVKFFjYZmGqmjlip0GJRD06pBpW+mWdeEzqDGqHyogYZWaJKjBZpbQGNowWBswWg00Nragl5dBaiVH9', 1524295, 'qwerty'),
(30, 'who is she?', 'uploads/20.jpg', 1524296, 'qwerty'),
(31, 'test question', '', 1524296, 'qwerty'),
(32, 'what is this', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACCCAYAAACKAxD9AAAgAElEQVR4AeydBXRd15X3lTaTdmbaybSZYtqmaRomJ2YGycwUc+yY7cTMbMvMzJYZxMzMzCwLLFlMFj7W0+9b+8rPUbPapl87ieVZPmtd3af78J79P5v3PmY860MH6AEjtGKkBYNyyGM5aAWj0YhGp0ZtVKFFjYZmGqmjlip0GJRD06pBpW+mWdeEzqDGqHyogYZWaJKjBZpbQGNowWBswWg00Nragl5dBaiVH9', 1524296, 'qwerty'),
(33, 'who is she?', 'uploads/20.jpg', 1524298, 'qwerty'),
(34, 'test question', '', 1524298, 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `url` varchar(1000) NOT NULL DEFAULT '-1',
  `chapter_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `name`, `url`, `chapter_id`) VALUES
(20, 'who is she?', 'uploads/20.jpg', 104),
(21, 'test question', '', 104),
(22, 'what is this', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACCCAYAAACKAxD9AAAgAElEQVR4AeydBXRd15X3lTaTdmbaybSZYtqmaRomJ2YGycwUc+yY7cTMbMvMzJYZxMzMzCwLLFlMFj7W0+9b+8rPUbPapl87ieVZPmtd3af78J79P5v3PmY860MH6AEjtGKkBYNyyGM5aAWj0YhGp0ZtVKFFjYZmGqmjlip0GJRD06pBpW+mWdeEzqDGqHyogYZWaJKjBZpbQGNowWBswWg00Nragl5dBaiVH9DS9nVtM9qqA0PjMzO7Zs/ML/1bP9TYBgITwVtahEhGWlu+BocCilZBBCDX5RDwaEHdpEenNiJ0+4vnNEBzq/z5+mhtoMVYh95Yg66lGo2hCgN69LSg0ulpUhtoVOlp1Arc9OiUL/lbP7xjXX/2gWCaT6GZidCmcws0aRvR6jUYDa0K4WkC6oFHQB0YBRAmcMjZAOigtRkMDS3QWA2qOtA2glEFrdrHKNLTip4G+RiNHsGZ8v3Gto9T00q98mGmH9ixz888EHSt2ici4C8IKkQVQDwewhXaBIes3zbxIau5nmYaaKaeJh5RrxzNNKN6fAjZhVnIoWCkBbTCSZqhuaENW3p5wvTCegOtzS3CoJT3mL6/o5+ffSCgVQirzLxpNYt4NhgQkMgQggu5KyghTZuAa7EdJ6L3s9FjBYvuzGX+zdl8cW0mc6/NZPGtL1jt8CXbPdexx38Lx2NucCHJGptsT4JLosloyKWqpQYtWgxoFcFgVFiIHgw60ClfDqIw6NshsYMj4f8EEITQQniR86IbyIoXhVCIX2WoIKowjPO+p1h+bRFTL4xh3DULxtuYM97RnM8dJyvHHKfPmO88lUVuM/jS43OWe3/BKp95TLg3gsnWo5hpPYYFNpNYaTeNzQ5zsHRewH6XRVwPv4pPvhcxtVFk67OoowYVDag1ddAifOTZGM88EISFa1rUCh', 104),
(23, 'Who is She?', 'uploads/23.jpg', 106);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `stream` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registration` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `stream`, `password`, `registration`, `email`, `year`) VALUES
('18', 'Rashed', 'CSE', 'root', NULL, NULL, NULL),
('19', 'Rishav', 'CSE', 'root', NULL, NULL, NULL),
('20', 'Lucifer', 'CSE', 'root', NULL, NULL, NULL),
('24', 'Saranya', 'CSE', 'root', NULL, NULL, NULL),
('30', 'Soumya', 'CSE', 'root', NULL, NULL, NULL),
('41', 'crush', 'CT', 'root', NULL, NULL, NULL),
('root', 'root', 'CSE', 'root', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_allocation`
--

CREATE TABLE `student_allocation` (
  `student_id` varchar(100) NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `shuffle` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_allocation`
--

INSERT INTO `student_allocation` (`student_id`, `exam_id`, `is_active`, `shuffle`) VALUES
('18', 1524296, '1', '0.2.1'),
('19', 1524296, '1', '0.2.1'),
('20', 1524296, '1', '2.1.0'),
('24', 1524296, '0', '0.1.2'),
('30', 1524296, '0', '2.0.1'),
('41', 1524296, '0', '1.2.0'),
('root', 1524296, '0', '2.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` varchar(10) NOT NULL,
  `name` varchar(500) NOT NULL,
  `UG` enum('0','1') NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `UG`, `department`) VALUES
('ES145', 'English', '0', 'CSE'),
('PS4', 'GAME', '1', 'CSE'),
('WE782', 'IPL', '1', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `password`) VALUES
('19', 'Rishav', 'root'),
('24', 'Saranya', 'root'),
('root', 'root', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`subject_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `attempt_choice`
--
ALTER TABLE `attempt_choice`
  ADD PRIMARY KEY (`student_id`,`exam_choice_id`),
  ADD KEY `exam_choice_id` (`exam_choice_id`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `choice`
--
ALTER TABLE `choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `exam_choice`
--
ALTER TABLE `exam_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_id` (`exam_question_id`);

--
-- Indexes for table `exam_mark`
--
ALTER TABLE `exam_mark`
  ADD PRIMARY KEY (`student_id`,`exam_question_id`),
  ADD KEY `exam_question_id` (`exam_question_id`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_allocation`
--
ALTER TABLE `student_allocation`
  ADD PRIMARY KEY (`student_id`,`exam_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `choice`
--
ALTER TABLE `choice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1524299;

--
-- AUTO_INCREMENT for table `exam_choice`
--
ALTER TABLE `exam_choice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation`
--
ALTER TABLE `allocation`
  ADD CONSTRAINT `allocation_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allocation_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attempt_choice`
--
ALTER TABLE `attempt_choice`
  ADD CONSTRAINT `attempt_choice_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attempt_choice_ibfk_2` FOREIGN KEY (`exam_choice_id`) REFERENCES `exam_choice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapter_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `choice`
--
ALTER TABLE `choice`
  ADD CONSTRAINT `choice_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_choice`
--
ALTER TABLE `exam_choice`
  ADD CONSTRAINT `exam_choice_ibfk_1` FOREIGN KEY (`exam_question_id`) REFERENCES `exam_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_mark`
--
ALTER TABLE `exam_mark`
  ADD CONSTRAINT `exam_mark_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_mark_ibfk_2` FOREIGN KEY (`exam_question_id`) REFERENCES `exam_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD CONSTRAINT `exam_question_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_allocation`
--
ALTER TABLE `student_allocation`
  ADD CONSTRAINT `student_allocation_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_allocation_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
