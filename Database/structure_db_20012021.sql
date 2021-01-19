-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2021 at 06:49 PM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cct_o_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
`id` bigint(20) unsigned NOT NULL,
  `name` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1',
  `subjectID` bigint(20) unsigned NOT NULL,
  `teacherId` bigint(20) unsigned NOT NULL,
  `noOfQues` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `coe`
--

CREATE TABLE IF NOT EXISTS `coe` (
`id` bigint(20) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1',
  `isFirstLogin` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `code` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
`id` bigint(20) unsigned NOT NULL,
  `createTime` bigint(20) unsigned NOT NULL,
  `startTime` bigint(20) unsigned NOT NULL,
  `desciption` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `batchPassOutYear` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `streamCodeNumber` enum('1','2','3','4','5','6','7') CHARACTER SET utf8mb4 NOT NULL,
  `isCoeVisible` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `isTeacherVisible` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `isActive` enum('0','1','2','3','4') CHARACTER SET utf8mb4 NOT NULL DEFAULT '0',
  `subjectID` bigint(20) unsigned NOT NULL,
  `teacherID` bigint(20) unsigned NOT NULL,
  `defaultCorrectMarks` int(11) NOT NULL DEFAULT '1',
  `defaultWrongMarks` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE IF NOT EXISTS `exam_questions` (
  `examId` bigint(20) unsigned NOT NULL,
  `questionId` bigint(20) unsigned NOT NULL,
  `marks_when_correct` int(11) DEFAULT NULL,
  `marks_when_wrong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Triggers `exam_questions`
--
DELIMITER //
CREATE TRIGGER `setDefaultMarks` BEFORE INSERT ON `exam_questions`
 FOR EACH ROW BEGIN
    DECLARE temp INT(11);
    IF NEW.marks_when_correct IS NULL THEN
        SELECT @defaultCorrect:=defaultCorrectMarks INTO temp FROM exam WHERE id = NEW.examId LIMIT 1;
        SET NEW.marks_when_correct = @defaultCorrect;
        -- INSERT INTO test(test_column) VALUES (@defaultCorrect);
    END IF;
    IF NEW.marks_when_wrong IS NULL THEN
        SELECT @defaultWrong := defaultWrongMarks INTO temp FROM exam WHERE id = NEW.examId LIMIT 1;
        SET NEW.marks_when_wrong = @defaultWrong;
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `form_student`
--

CREATE TABLE IF NOT EXISTS `form_student` (
  `rollNo` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `semester` enum('1','2','3','4','5','6','7','8') COLLATE utf8mb4_bin NOT NULL,
  `department` enum('CSE','IT','CT') COLLATE utf8mb4_bin NOT NULL,
  `regNo` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `contactNo` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `fatherName` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `permanentAddress` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `filled_offline_form` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `compulsory1` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `compulsory2` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `compulsory3` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `compulsory4` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `compulsory5` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `elective1` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `elective2` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `elective3` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `backlog1` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `backlog2` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `backlog3` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `backlog4` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `backlog5` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--

CREATE TABLE IF NOT EXISTS `marksheet` (
  `examId` bigint(20) unsigned NOT NULL,
  `studentId` bigint(20) unsigned NOT NULL,
  `questionShuffle` bigint(20) NOT NULL,
  `attempts` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `marks` int(11) NOT NULL,
  `submitted` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`id` bigint(20) unsigned NOT NULL,
  `chapterId` bigint(20) unsigned NOT NULL,
  `isActive` enum('0','1') CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`id` bigint(20) unsigned NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `joiningYear` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `passOutYear` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1',
  `email` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `registration` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `contactNo` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `departmentCode` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `isFirstLogin` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=182 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` bigint(20) unsigned NOT NULL,
  `subjectCode` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `paperName` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject_under_teacher`
--

CREATE TABLE IF NOT EXISTS `subject_under_teacher` (
  `subjectID` bigint(20) unsigned NOT NULL,
  `teacherId` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`id` bigint(20) unsigned NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `departmentCode` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `designation` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `contactNo` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `isActive` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1',
  `isFirstLogin` enum('0','1') COLLATE utf8mb4_bin NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE IF NOT EXISTS `workspace` (
`id` bigint(20) unsigned NOT NULL,
  `teacherId` bigint(20) unsigned NOT NULL,
  `subjectId` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_exam_questions`
--

CREATE TABLE IF NOT EXISTS `workspace_exam_questions` (
  `examId` bigint(20) unsigned NOT NULL,
  `questionId` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_questions`
--

CREATE TABLE IF NOT EXISTS `workspace_questions` (
`id` bigint(20) unsigned NOT NULL,
  `type` enum('0','1','2') CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `workspace_sections`
--

CREATE TABLE IF NOT EXISTS `workspace_sections` (
  `id` bigint(20) unsigned NOT NULL,
  `questionId` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
 ADD PRIMARY KEY (`id`), ADD KEY `chapter_ibfk_1` (`subjectID`), ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `coe`
--
ALTER TABLE `coe`
 ADD PRIMARY KEY (`id`), ADD KEY `username` (`username`), ADD KEY `id` (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
 ADD PRIMARY KEY (`id`), ADD KEY `subjectCode` (`subjectID`), ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
 ADD PRIMARY KEY (`examId`,`questionId`), ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `form_student`
--
ALTER TABLE `form_student`
 ADD PRIMARY KEY (`rollNo`,`semester`);

--
-- Indexes for table `marksheet`
--
ALTER TABLE `marksheet`
 ADD PRIMARY KEY (`examId`,`studentId`), ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id`), ADD KEY `chapterId` (`chapterId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `departmentCode` (`departmentCode`), ADD KEY `id_2` (`id`), ADD KEY `id_3` (`id`), ADD KEY `rollno` (`username`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `subjectCode` (`subjectCode`);

--
-- Indexes for table `subject_under_teacher`
--
ALTER TABLE `subject_under_teacher`
 ADD PRIMARY KEY (`subjectID`,`teacherId`), ADD KEY `subject_under_teacher_ibfk_2` (`teacherId`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`id`), ADD KEY `departmentCode` (`departmentCode`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`), ADD KEY `username` (`username`);

--
-- Indexes for table `workspace`
--
ALTER TABLE `workspace`
 ADD PRIMARY KEY (`id`), ADD KEY `teacherId` (`teacherId`), ADD KEY `subjectId` (`subjectId`);

--
-- Indexes for table `workspace_exam_questions`
--
ALTER TABLE `workspace_exam_questions`
 ADD PRIMARY KEY (`examId`,`questionId`), ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `workspace_questions`
--
ALTER TABLE `workspace_questions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workspace_sections`
--
ALTER TABLE `workspace_sections`
 ADD PRIMARY KEY (`id`), ADD KEY `questionId` (`questionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `coe`
--
ALTER TABLE `coe`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `workspace`
--
ALTER TABLE `workspace`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `workspace_questions`
--
ALTER TABLE `workspace_questions`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
