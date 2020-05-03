-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2020 at 06:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `name` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1',
  `subjectID` bigint(20) UNSIGNED NOT NULL,
  `teacherId` bigint(20) UNSIGNED NOT NULL,
  `noOfQues` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `name`, `isActive`, `subjectID`, `teacherId`, `noOfQues`) VALUES
(8, 'Scenery beautiful', '1', 6, 4, 3),
(9, 'kolkata rocks', '1', 6, 4, 3),
(10, 'joker lost', '1', 6, 4, 3),
(11, 'howrah taj', '1', 4, 8, 3),
(12, 'housing society', '1', 4, 8, 3),
(13, 'load, load , everywhere', '1', 4, 8, 3),
(14, 'oak tree', '1', 5, 9, 3),
(15, 'dare pass', '1', 5, 9, 3),
(16, 'not a good home', '1', 5, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `coe`
--

CREATE TABLE `coe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1',
  `isFirstLogin` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `coe`
--

INSERT INTO `coe` (`id`, `username`, `password`, `isActive`, `isFirstLogin`) VALUES
(1, 'root', 'shoot', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `code` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`code`, `name`) VALUES
('CSE', 'CSE'),
('CT', 'CT'),
('IT', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `createTime` bigint(20) UNSIGNED NOT NULL,
  `startTime` bigint(20) UNSIGNED NOT NULL,
  `desciption` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `batchPassOutYear` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `streamCodeNumber` enum('1','2','3','4','5','6','7') CHARACTER SET utf8mb4 NOT NULL,
  `isCoeVisible` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `isTeacherVisible` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `isActive` enum('0','1','2','3','4') CHARACTER SET utf8mb4 NOT NULL DEFAULT '0',
  `subjectID` bigint(20) UNSIGNED NOT NULL,
  `teacherID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `createTime`, `startTime`, `desciption`, `batchPassOutYear`, `streamCodeNumber`, `isCoeVisible`, `isTeacherVisible`, `isActive`, `subjectID`, `teacherID`) VALUES
(5, 1588272283, 1588274017, 'are you a ninja?', '2011', '7', '1', '0', '4', 6, 4),
(6, 1588272808, 1588274017, 'wanna be a detective?', '2025', '1', '0', '1', '4', 4, 8),
(7, 1588273023, 1588274017, 'look into my eyes', '2030', '2', '1', '1', '3', 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `examId` bigint(20) UNSIGNED NOT NULL,
  `questionId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`examId`, `questionId`) VALUES
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(6, 21),
(6, 22),
(6, 23),
(6, 24),
(6, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 29),
(7, 30),
(7, 31),
(7, 32),
(7, 33),
(7, 34),
(7, 35),
(7, 36),
(7, 37),
(7, 38);

-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--

CREATE TABLE `marksheet` (
  `examId` bigint(20) UNSIGNED NOT NULL,
  `studentId` bigint(20) UNSIGNED NOT NULL,
  `questionShuffle` bigint(20) NOT NULL,
  `attempts` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `marks` int(11) NOT NULL,
  `submitted` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `marksheet`
--

INSERT INTO `marksheet` (`examId`, `studentId`, `questionShuffle`, `attempts`, `marks`, `submitted`) VALUES
(5, 3, 1767784613, '134300004', 3, '0'),
(5, 4, 1473859207, '000000000', 0, '0'),
(5, 5, 1246158628, '111000440', 3, '0'),
(6, 3, 1345268606, '100000000', 1, '0'),
(6, 5, 1728170153, '000000000', 0, '0'),
(6, 6, 394587977, '000000000', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chapterId` bigint(20) UNSIGNED NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `chapterId`, `isActive`) VALUES
(12, 8, '1'),
(13, 8, '1'),
(14, 8, '1'),
(15, 9, '1'),
(16, 9, '1'),
(17, 9, '1'),
(18, 10, '1'),
(19, 10, '1'),
(20, 10, '1'),
(21, 11, '1'),
(22, 11, '1'),
(23, 11, '1'),
(24, 12, '1'),
(25, 12, '1'),
(26, 12, '1'),
(27, 13, '1'),
(28, 13, '1'),
(29, 13, '1'),
(30, 14, '1'),
(31, 14, '1'),
(32, 14, '1'),
(33, 15, '1'),
(34, 15, '1'),
(35, 15, '1'),
(36, 16, '1'),
(37, 16, '1'),
(38, 16, '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `joiningYear` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `passOutYear` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `email` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `registration` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `contactNo` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `departmentCode` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `isFirstLogin` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `name`, `joiningYear`, `passOutYear`, `password`, `isActive`, `email`, `registration`, `contactNo`, `departmentCode`, `isFirstLogin`) VALUES
(1, 'GCECTB-R17-3018', 'Rashed Mehdi', '2017', '2021', '!@me', '0', '', '', '', 'CSE', '0'),
(2, '', 'Rashed Mehdi', '', '', '1234', '0', '', '', '', 'CSE', '0'),
(3, 'Having fun', '', '', '', '!@me', '0', '', '', '', 'CSE', '1'),
(4, 'lucifer morningstone', 'birla planetorium', '', '', '123', '0', '', '', '', 'CSE', '1'),
(5, 'alpachino', 'alfonso ninja', '', '', '#@me', '1', '', '', '', 'IT', '1'),
(6, 'loream ipsum', '', '', '', 'load test', '1', '', '', '', 'CSE', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subjectCode` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `paperName` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subjectCode`, `paperName`, `isActive`) VALUES
(3, 'CS502', 'Algo2', '1'),
(4, 'WSN305', 'Watson Down', '1'),
(5, 'OP780', 'Better Half', '1'),
(6, 'MU250', 'Manchester Rocks', '1'),
(7, 'PT450', 'Random Challenge', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subject_under_teacher`
--

CREATE TABLE `subject_under_teacher` (
  `subjectID` bigint(20) UNSIGNED NOT NULL,
  `teacherId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `subject_under_teacher`
--

INSERT INTO `subject_under_teacher` (`subjectID`, `teacherId`) VALUES
(4, 8),
(4, 9),
(5, 9),
(6, 4),
(6, 8),
(6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `departmentCode` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `designation` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `address` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `contactNo` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `isFirstLogin` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `password`, `name`, `departmentCode`, `designation`, `address`, `email`, `contactNo`, `isActive`, `isFirstLogin`) VALUES
(1, 'GCECT/F/00001', '987', 'Test Teacher Account', 'CSE', 'Assistant professor', 'sds', 'sdsd', '', '1', '0'),
(2, 'GCECT/F/0012', '452', 'Test Account #2', 'CT', '', '', '', '', '1', '1'),
(3, 'GCECT/F/00254', '', 'Test Account #3', 'IT', '', '', '', '', '1', '1'),
(4, 'BB', 'AtoZ', 'Bhuvan Bam', 'CSE', '', '', '', '', '1', '1'),
(8, 'sherlock', 'watson', 'nice to meet you', 'CT', '', '', '', '', '1', '0'),
(9, 'loream ipsum', 'load test', 'server crash', 'IT', '', '', '', '', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE `workspace` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacherId` bigint(20) UNSIGNED NOT NULL,
  `subjectId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_exam_questions`
--

CREATE TABLE `workspace_exam_questions` (
  `examId` bigint(20) UNSIGNED NOT NULL,
  `questionId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_questions`
--

CREATE TABLE `workspace_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('0','1','2') CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_sections`
--

CREATE TABLE `workspace_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questionId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
  ADD KEY `chapterId` (`chapterId`);

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
-- Indexes for table `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacherId` (`teacherId`),
  ADD KEY `subjectId` (`subjectId`);

--
-- Indexes for table `workspace_exam_questions`
--
ALTER TABLE `workspace_exam_questions`
  ADD PRIMARY KEY (`examId`,`questionId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `workspace_questions`
--
ALTER TABLE `workspace_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workspace_sections`
--
ALTER TABLE `workspace_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionId` (`questionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `coe`
--
ALTER TABLE `coe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `workspace`
--
ALTER TABLE `workspace`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workspace_questions`
--
ALTER TABLE `workspace_questions`
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

--
-- Constraints for table `workspace`
--
ALTER TABLE `workspace`
  ADD CONSTRAINT `workspace_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `workspace_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`id`);

--
-- Constraints for table `workspace_exam_questions`
--
ALTER TABLE `workspace_exam_questions`
  ADD CONSTRAINT `workspace_exam_questions_ibfk_1` FOREIGN KEY (`examId`) REFERENCES `workspace` (`id`),
  ADD CONSTRAINT `workspace_exam_questions_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `workspace_questions` (`id`);

--
-- Constraints for table `workspace_sections`
--
ALTER TABLE `workspace_sections`
  ADD CONSTRAINT `workspace_sections_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `workspace_questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
