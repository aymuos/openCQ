-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 05:50 PM
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
(1, 'Orthogonal projections', '1', 17, 1, 0),
(2, '', '1', 1, 2, 0),
(3, 'xyz', '1', 1, 2, 0),
(4, 'Differentiation & Integration ', '1', 19, 1, 0),
(5, '', '0', 19, 1, 0),
(6, 'Differential Equations', '1', 19, 1, 0),
(7, '', '0', 19, 1, 0),
(8, 'Limits', '1', 19, 1, 0),
(9, 'Fundamental Number System', '1', 19, 1, 0);

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
(1, 'grey', 'root', '1', '0');

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
('BSEH', 'General Science'),
('CSE', 'Computer Science and Engineering'),
('CT ', 'Ceramic Technology'),
('IT', 'Information Technology');

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

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `examId` bigint(20) UNSIGNED NOT NULL,
  `questionId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chapterId` bigint(20) UNSIGNED NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
(1, 'white', 'Me White', '2017', '2021', 'root', '1', 'tree@waterme.oxy', '48489510', '87956268445', 'CSE', '1'),
(2, 'black', 'Me Black', '2017', '2021', 'root', '1', 'inbox@upload.contact', '85246612021', '88795662659', 'CT ', '1'),
(3, 'red', 'Me Red', '2017', '2022', 'root', '1', 'f24@500.code', '785201256', '8017256942', 'IT', '1');

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
(1, 'BS(CS)306', 'Probability and Statistics', '1'),
(2, 'CS301', 'Numerical Methods', '1'),
(3, 'CS302', 'Digital Logic', '1'),
(4, 'CS303', 'computer organization', '1'),
(5, 'CS304', 'Data Structure and Algorithms', '1'),
(6, 'CS391', 'NM Lab', '1'),
(7, 'CS392', 'DL Lab', '1'),
(8, 'CS393', 'CO Lab', '1'),
(9, 'CS394', 'Algo Lab', '1'),
(10, 'cS407', 'Life science', '1'),
(11, 'Cs405', 'Graphy theory', '1'),
(12, 'CS406', 'Communication Engineering', '1'),
(13, 'CS407', 'microprocessor', '1'),
(14, 'CS408', 'Automata and formal languages', '1'),
(15, 'CS496 ', 'software lab', '1'),
(16, 'ESL(CS/IT)103', 'Engineering Graphics and Design', '1'),
(17, 'ES(CT)103', 'Engineering Graphics and Design', '1'),
(18, 'BS(CT)102', 'Chemistry', '1'),
(19, 'BS(CT)101', 'Mathematics-1', '1'),
(20, 'BS(CS/IT)102', 'Physics', '1'),
(21, 'ES(CS/IT)101', 'Basic Electrical Engineering', '1'),
(22, 'ES(CT)101', 'Programming for Problem Solving', '1'),
(23, 'BSL(CT)103', 'Chemistry Lab', '1');

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
(1, 1),
(17, 1),
(19, 1);

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
(1, 'cyan', 'root', 'Me Cyan', 'CSE', 'Prof', 'xyz', 'xyz@gmail.com', '78646798', '1', '0'),
(2, 'brown', 'root', 'Me Brown', 'IT', 'HOD', 'abcd', 'open@proton.com', '4876956985', '1', '0'),
(3, 'orange', 'root', 'Me Orange', 'BSEH', 'Prof', 'cdef', 'house@orkut.in', '7895841218', '1', '1'),
(4, 'root', 'root', '', 'BSEH', '', '', '', '', '1', '0');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coe`
--
ALTER TABLE `coe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
