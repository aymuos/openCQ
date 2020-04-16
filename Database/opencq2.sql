-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 04:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

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
  `subjectID` bigint(20) UNSIGNED NOT NULL,
  `teacherId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coe`
--

CREATE TABLE `coe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `isFirstLogin` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `code` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`code`, `name`) VALUES
('CSE', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `createTime` bigint(20) UNSIGNED NOT NULL,
  `startTime` bigint(20) UNSIGNED NOT NULL,
  `desciption` varchar(500) NOT NULL,
  `batchPassOutYear` varchar(100) NOT NULL,
  `streamCodeNumber` enum('1','2','3','4','5','6','7') NOT NULL,
  `isCoeVisible` enum('0','1') NOT NULL DEFAULT '1',
  `isTeacherVisible` enum('0','1') NOT NULL DEFAULT '1',
  `isActive` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `subjectID` bigint(20) UNSIGNED NOT NULL,
  `teacherID` bigint(20) UNSIGNED NOT NULL
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
  `studentId` bigint(20) UNSIGNED NOT NULL,
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
  `chapterId` bigint(20) UNSIGNED NOT NULL,
  `problemStatement` longblob NOT NULL,
  `ac` longblob NOT NULL,
  `wa1` longblob NOT NULL,
  `wa2` longblob NOT NULL,
  `wa3` longblob NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `joiningYear` varchar(100) NOT NULL,
  `passOutYear` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `email` varchar(250) DEFAULT NULL,
  `registration` varchar(250) DEFAULT NULL,
  `contactNo` varchar(250) NOT NULL,
  `departmentCode` varchar(100) NOT NULL,
  `isFirstLogin` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `name`, `joiningYear`, `passOutYear`, `password`, `isActive`, `email`, `registration`, `contactNo`, `departmentCode`, `isFirstLogin`) VALUES
(1, 'GCECTB-R17-3018', 'Rashed Mehdi', '', '', '', '1', NULL, NULL, '', 'CSE', '0');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subjectCode` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `paperName` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_under_teacher`
--

CREATE TABLE `subject_under_teacher` (
  `subjectID` bigint(20) UNSIGNED NOT NULL,
  `teacherId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `departmentCode` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contactNo` varchar(250) NOT NULL DEFAULT '1',
  `isActive` enum('0','1') NOT NULL DEFAULT '1',
  `isFirstLogin` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_ibfk_1` (`subjectID`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `coe`
--
ALTER TABLE `coe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `id` (`id`);

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
  ADD KEY `subjectCode` (`subjectID`),
  ADD KEY `teacherID` (`teacherID`);

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
  ADD KEY `chapterId` (`chapterId`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `departmentCode` (`departmentCode`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`),
  ADD KEY `rollno` (`username`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `subjectCode` (`subjectCode`);

--
-- Indexes for table `subject_under_teacher`
--
ALTER TABLE `subject_under_teacher`
  ADD PRIMARY KEY (`subjectID`,`teacherId`),
  ADD KEY `subject_under_teacher_ibfk_2` (`teacherId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentCode` (`departmentCode`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coe`
--
ALTER TABLE `coe`
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
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `chapter_ibfk_3` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`teacherID`) REFERENCES `teacher` (`id`);

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
  ADD CONSTRAINT `marksheet_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `student` (`id`);

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
  ADD CONSTRAINT `subject_under_teacher_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `subject_under_teacher_ibfk_3` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`departmentCode`) REFERENCES `department` (`code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
