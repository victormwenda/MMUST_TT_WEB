-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2015 at 02:32 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mmusttimetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('victor_mwenda', 'victor_mwenda');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `course_code` text NOT NULL,
  `submission_date` date NOT NULL,
  `assignment_no` text NOT NULL,
  `department_id` text NOT NULL,
  `student_adm_yr` year(4) NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL,
  `school_course_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`course_code`, `submission_date`, `assignment_no`, `department_id`, `student_adm_yr`, `faculty_id`, `campus_id`, `school_course_code`) VALUES
('BIT 314', '2015-02-23', 'Assignment 1', 'DEPARTMENT_181', 2012, 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 317', '2015-02-23', 'Assignment 1', 'DEPARTMENT_181', 2012, 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 315', '2015-02-23', 'Assignment 1', 'DEPARTMENT_181', 2012, 'FACULTY_883', 'campus_631', 'SIT');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `campus_id` text NOT NULL,
  `campus_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campus_id`, `campus_name`) VALUES
('campus_631', 'Kakamega Main Campus');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `course_code` text NOT NULL,
  `lec_id` text NOT NULL,
  `class_room` text NOT NULL,
  `class_start` time NOT NULL,
  `class_stop` time NOT NULL,
  `class_days` text NOT NULL,
  `student_adm_yr` year(4) NOT NULL,
  `department_id` text NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL,
  `school_course_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`course_code`, `lec_id`, `class_room`, `class_start`, `class_stop`, `class_days`, `student_adm_yr`, `department_id`, `faculty_id`, `campus_id`, `school_course_id`) VALUES
('BIT 317', 'LEC_366', 'SPD 004', '07:00:00', '10:00:00', '1', 2012, 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 315', 'LEC_112', 'LBB 016', '07:00:00', '10:00:00', '4', 2012, 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 315', 'LEC_112', 'LBB 016', '07:00:00', '10:00:00', '3', 2012, 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 314', 'LEC_759', 'LBB 016', '12:00:00', '15:00:00', '4', 2012, 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 314', 'LEC_759', 'SPD 004', '13:00:00', '16:00:00', '1', 2012, 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 'SIT'),
('BIT 314', 'LEC_759', 'SPD 004', '16:00:00', '19:00:00', '2', 2012, 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 'SIT');

-- --------------------------------------------------------

--
-- Table structure for table `commits_info`
--

CREATE TABLE IF NOT EXISTS `commits_info` (
  `commits` int(11) NOT NULL,
  `assignments` int(11) NOT NULL,
  `campus` int(11) NOT NULL,
  `classes` int(11) NOT NULL,
  `courses` int(11) NOT NULL,
  `departments` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `exams` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `notifications` int(11) NOT NULL,
  `school_courses` int(11) NOT NULL,
  `students` int(11) NOT NULL,
  `uploads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commits_info`
--

INSERT INTO `commits_info` (`commits`, `assignments`, `campus`, `classes`, `courses`, `departments`, `downloads`, `exams`, `faculty`, `lecturer`, `notifications`, `school_courses`, `students`, `uploads`) VALUES
(43, 4, 2, 6, 4, 2, 3, 7, 2, 4, 3, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_code` text NOT NULL,
  `course_name` text NOT NULL,
  `lec_id` text NOT NULL,
  `department_id` text NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL,
  `student_adm_yr` year(4) NOT NULL,
  `school_course_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_name`, `lec_id`, `department_id`, `faculty_id`, `campus_id`, `student_adm_yr`, `school_course_code`) VALUES
('BIT 314', 'Web Programming', 'LEC_759', 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 317', 'Network Programming', 'LEC_366', 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 315', 'Event Driven Programming', 'LEC_112', 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 2012, 'SIT');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` text NOT NULL,
  `department_name` text NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `faculty_id`, `campus_id`) VALUES
('DEPARTMENT_181', 'Department of Computer Science', 'FACULTY_883', 'campus_631');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `course_code` text NOT NULL,
  `fileid` text NOT NULL,
  `department_id` text NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL,
  `student_adm_yr` year(4) NOT NULL,
  `school_course` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`course_code`, `fileid`, `department_id`, `faculty_id`, `campus_id`, `student_adm_yr`, `school_course`) VALUES
('BIT 314', 'FILE_431', 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 315', 'FILE_431', 'DEPARTMENT_181', 'FACULTY_883', 'campus_631', 2012, 'SIT');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `course_code` text NOT NULL,
  `department_id` text NOT NULL,
  `exam_type` int(11) NOT NULL,
  `exam_room` text NOT NULL,
  `exam_date` date NOT NULL,
  `exam_start` time NOT NULL,
  `exam_duration` int(11) NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL,
  `student_adm_yr` year(4) NOT NULL,
  `school_course_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`course_code`, `department_id`, `exam_type`, `exam_room`, `exam_date`, `exam_start`, `exam_duration`, `faculty_id`, `campus_id`, `student_adm_yr`, `school_course_code`) VALUES
('BIT 317', 'DEPARTMENT_181', 2, 'LBB 114', '2015-02-17', '08:00:00', 2, 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 314', 'DEPARTMENT_181', 2, 'LBB 113', '2015-02-19', '08:00:00', 2, 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 315', 'DEPARTMENT_181', 2, 'LBB 114', '2015-02-19', '14:00:00', 2, 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 315', 'DEPARTMENT_181', 1, 'SPD 004', '2015-02-24', '14:01:00', 2, 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 317', 'DEPARTMENT_181', 1, 'SPD 004', '2015-02-24', '14:01:00', 2, 'FACULTY_883', 'campus_631', 2012, 'SIT'),
('BIT 314', 'DEPARTMENT_181', 1, 'SPD 004', '2015-02-24', '14:01:00', 2, 'FACULTY_883', 'campus_631', 2012, 'SIT');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` text NOT NULL,
  `faculty_name` text NOT NULL,
  `campus_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `campus_id`) VALUES
('FACULTY_883', 'Faculty of Science', 'campus_631');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `lec_id` text NOT NULL,
  `lec_name` text NOT NULL,
  `lec_email` text NOT NULL,
  `lec_phone` text NOT NULL,
  `lec_avator_uri` text NOT NULL,
  `lec_qualification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lec_id`, `lec_name`, `lec_email`, `lec_phone`, `lec_avator_uri`, `lec_qualification`) VALUES
('LEC_759', 'Michael Ojunju', 'mikejj@yahoo.com', '0711792705', 'uploads/images/avators/lec/person_1.png', 'Masters/Bsc/Dip/Cert It'),
('LEC_112', 'Raphael Angulu', 'rangulu@mmust.ac.ke', '0729260641', 'uploads/images/avators/lec/person_1.png', 'Masters Information Technology,Bsc Computer Science'),
('LEC_366', 'Kelvin Omieno', 'komieno@mmust.ac.ke', '0726849197', 'uploads/images/avators/lec/person_1.png', 'Masters Information Technology,Bsc Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` text NOT NULL,
  `notification_title` text NOT NULL,
  `notification_message` text NOT NULL,
  `notification_send_time` mediumtext NOT NULL,
  `notification_sender` text NOT NULL,
  `department_id` text NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL,
  `student_adm_yr` year(4) NOT NULL,
  `school_course` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `notification_title`, `notification_message`, `notification_send_time`, `notification_sender`, `department_id`, `faculty_id`, `campus_id`, `student_adm_yr`, `school_course`) VALUES
('NTF_566', 'Exam Timetable final draft', 'The final draft of the exam timetable has been released', '1423141623', 'Registrar AA', 'ALL', 'ALL', 'ALL', 2012, 'ALL'),
('NTF_692', 'Web Programming Assignment Presentations', 'The Course Lec, My Ojunju is marking the assignment now in LBB 016', '1423141687', 'Class Rep I.T 3rd Yr', 'ALL', 'ALL', 'ALL', 2012, 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `school_courses`
--

CREATE TABLE IF NOT EXISTS `school_courses` (
  `course_code` text NOT NULL,
  `course_name` text NOT NULL,
  `department_id` text NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_courses`
--

INSERT INTO `school_courses` (`course_code`, `course_name`, `department_id`, `faculty_id`, `campus_id`) VALUES
('SIT', 'Bachelor of Science in Information Technology', 'DEPARTMENT_181', 'FACULTY_883', 'campus_631');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `reg_no` text NOT NULL,
  `full_name` text NOT NULL,
  `pursuing_course` text NOT NULL,
  `department_id` text NOT NULL,
  `phonenumber` text NOT NULL,
  `email` text NOT NULL,
  `student_category` int(11) NOT NULL,
  `adm_yr` year(4) NOT NULL,
  `faculty_id` text NOT NULL,
  `campus_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`reg_no`, `full_name`, `pursuing_course`, `department_id`, `phonenumber`, `email`, `student_category`, `adm_yr`, `faculty_id`, `campus_id`) VALUES
('SIT/0050/12', 'RWANDA VICTOR MWENDA', 'SIT', 'DEPARTMENT_181', '0718034449', 'vmwenda.vm@gmail.com', 1, 2012, 'FACULTY_883', 'campus_631');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `fileid` text NOT NULL,
  `filename` text NOT NULL,
  `filesize` mediumtext NOT NULL,
  `filedesc` text NOT NULL,
  `fileuploader` text NOT NULL,
  `file_upload_time` mediumtext NOT NULL,
  `fileuri` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`fileid`, `filename`, `filesize`, `filedesc`, `fileuploader`, `file_upload_time`, `fileuri`) VALUES
('FILE_431', 'Test File', '90165', 'Test File DescriptionTest File DescriptionTest File DescriptionTest File DescriptionTest File DescriptionTest File DescriptionTest File Description', 'Victor Mwenda', '1424855794', 'uploads/docs/adb_interface.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
