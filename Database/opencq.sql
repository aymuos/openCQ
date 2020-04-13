-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 06:00 AM
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
-- Database: `opencq`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(1000) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `subjectCode` varchar(100) NOT NULL,
  `teacherId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `check_duplicate_chapter`
--

CREATE TABLE `check_duplicate_chapter` (
  `chapter` varchar(500) NOT NULL,
  `subjectCode` varchar(100) NOT NULL,
  `teacherId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `check_duplicate_department`
--

CREATE TABLE `check_duplicate_department` (
  `department` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `check_duplicate_subject`
--

CREATE TABLE `check_duplicate_subject` (
  `subject` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `code` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `createTime` bigint(20) UNSIGNED NOT NULL,
  `startTime` bigint(20) UNSIGNED NOT NULL,
  `desciption` varchar(500) NOT NULL,
  `isCoeVisible` enum('0','1') NOT NULL DEFAULT '1',
  `isTeacherVisible` enum('0','1') NOT NULL DEFAULT '1',
  `isActive` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `subjectCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `examId` bigint(20) UNSIGNED NOT NULL,
  `questionId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--

CREATE TABLE `marksheet` (
  `examId` bigint(20) UNSIGNED NOT NULL,
  `studentId` varchar(100) NOT NULL,
  `questionShuffle` bigint(20) NOT NULL,
  `optionShuffle` bigint(20) NOT NULL,
  `attempts` varchar(200) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `statement` varchar(1000) NOT NULL,
  `url` longblob NOT NULL DEFAULT '',
  `acStatement` varchar(1000) NOT NULL,
  `acUrl` longblob NOT NULL DEFAULT '',
  `wa1Statement` varchar(1000) NOT NULL,
  `wa1Url` longblob NOT NULL DEFAULT '',
  `wa2Statement` varchar(1000) NOT NULL,
  `wa2Url` longblob NOT NULL DEFAULT '',
  `wa3Statement` varchar(1000) NOT NULL,
  `wa3Url` longblob NOT NULL DEFAULT '',
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `chapterId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `joiningYear` varchar(100) NOT NULL,
  `batchYear` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `email` varchar(250) DEFAULT NULL,
  `registration` varchar(250) DEFAULT NULL,
  `contactNo` varchar(250) NOT NULL,
  `departmentCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `code` varchar(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `semester` enum('1','2','3','4','5','6','7','8') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject_under_teacher`
--

CREATE TABLE `subject_under_teacher` (
  `subjectCode` varchar(100) NOT NULL,
  `teacherId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `contactNo` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `departmentCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_ibfk_1` (`subjectCode`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `check_duplicate_chapter`
--
ALTER TABLE `check_duplicate_chapter`
  ADD PRIMARY KEY (`chapter`,`subjectCode`,`teacherId`),
  ADD KEY `subjectCode` (`subjectCode`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `check_duplicate_department`
--
ALTER TABLE `check_duplicate_department`
  ADD PRIMARY KEY (`department`);

--
-- Indexes for table `check_duplicate_subject`
--
ALTER TABLE `check_duplicate_subject`
  ADD PRIMARY KEY (`subject`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjectCode` (`subjectCode`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`examId`,`questionId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `marksheet`
--
ALTER TABLE `marksheet`
  ADD PRIMARY KEY (`examId`,`studentId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapterId` (`chapterId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentCode` (`departmentCode`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `subject_under_teacher`
--
ALTER TABLE `subject_under_teacher`
  ADD PRIMARY KEY (`subjectCode`,`teacherId`),
  ADD KEY `subject_under_teacher_ibfk_2` (`teacherId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentCode` (`departmentCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_1` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chapter_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `check_duplicate_chapter`
--
ALTER TABLE `check_duplicate_chapter`
  ADD CONSTRAINT `check_duplicate_chapter_ibfk_1` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `check_duplicate_chapter_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`examId`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_questions_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `question` (`id`);

--
-- Constraints for table `marksheet`
--
ALTER TABLE `marksheet`
  ADD CONSTRAINT `marksheet_ibfk_1` FOREIGN KEY (`examId`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `marksheet_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `student` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`chapterId`) REFERENCES `chapter` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`departmentCode`) REFERENCES `department` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `subject_under_teacher`
--
ALTER TABLE `subject_under_teacher`
  ADD CONSTRAINT `subject_under_teacher_ibfk_1` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_under_teacher_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`departmentCode`) REFERENCES `department` (`code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
