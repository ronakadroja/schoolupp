-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 01:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `s_id` varchar(10) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_address` text NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_phone` varchar(10) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `a_email` varchar(100) NOT NULL,
  `a_phone` varchar(10) NOT NULL,
  `a_dob` date NOT NULL,
  `a_gender` varchar(10) NOT NULL,
  `a_qualification` varchar(100) NOT NULL,
  `a_username` varchar(20) NOT NULL,
  `a_pass` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'inactive',
  `token` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`s_id`, `s_name`, `s_address`, `s_email`, `s_phone`, `a_name`, `a_email`, `a_phone`, `a_dob`, `a_gender`, `a_qualification`, `a_username`, `a_pass`, `status`, `token`) VALUES
('sid67687', 'Nalanada', '321, Ghanchivali Sheri, Sarvad, Morbi - 363660', 'ronakadroja1234@gmail.com', '1', 'Adroja Ronak Rameshbhai', 'ronakadroja1234@gmail.com', '6354020935', '2022-06-27', 'Male', 'jkkjkj', 'ronak1234', '1234', 'active', 'e7d02592bcc4c47b5f428a99cea9574b');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `stu_id` varchar(10) NOT NULL,
  `standard` varchar(10) NOT NULL,
  `stu_name` varchar(200) NOT NULL,
  `att_date` varchar(10) NOT NULL,
  `attendance` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `stu_id`, `standard`, `stu_name`, `att_date`, `attendance`) VALUES
(10, 'STU-22809', '9 B', 'Adroja Ronak Rameshbhai', '05/07/2022', 'Present'),
(11, 'STU-87396', '9 B', 'Shingala Denis Harsukhbhai', '05/07/2022', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `c_id` varchar(15) NOT NULL,
  `c_name` varchar(5) NOT NULL,
  `c_division` varchar(2) NOT NULL,
  `c_teacher` varchar(100) NOT NULL,
  `c_strength` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`c_id`, `c_name`, `c_division`, `c_teacher`, `c_strength`) VALUES
('CLASS-333', '9', 'B', 'TEACHER-738', 60),
('CLASS-603', '4', 'B', 'TEACHER-107', 12);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `standard` varchar(10) NOT NULL,
  `start_exam` date NOT NULL,
  `end_exam` date NOT NULL,
  `exam_tt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_type`, `standard`, `start_exam`, `end_exam`, `exam_tt`) VALUES
(7, 'endsem', '4 B', '2022-07-08', '2022-07-14', '1656931853Schedule.pdf'),
(8, 'classtest', '4 B', '2022-07-06', '2022-07-08', '1656933365examtt.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `marks_entry`
--

CREATE TABLE `marks_entry` (
  `id` int(11) NOT NULL,
  `standard` varchar(10) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `exam_type` varchar(30) NOT NULL,
  `exam_date` varchar(20) NOT NULL,
  `stu_id` varchar(20) NOT NULL,
  `total_marks` int(3) NOT NULL,
  `obt_marks` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks_entry`
--

INSERT INTO `marks_entry` (`id`, `standard`, `subject`, `exam_type`, `exam_date`, `stu_id`, `total_marks`, `obt_marks`) VALUES
(14, '9 B', 'science', 'endsem', '12/07/2022', 'STU-22809', 100, 99),
(15, '9 B', 'science', 'endsem', '12/07/2022', 'STU-87396', 100, 20),
(16, '4 B', 'gujarati', 'classtest', '04/07/2022', 'STU-23004', 50, 40);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `n_title` varchar(300) NOT NULL,
  `n_desc` varchar(700) NOT NULL,
  `odience` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `n_title`, `n_desc`, `odience`, `date`) VALUES
(4, 'Ronak Birthday', 'On 19th of July there is birthday of your classmate, your friend Ronak Adroja. He is throwing a party at Octane Pizza.  So please be present at the party.', 'Student', '2022-07-04 16:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `p_id` varchar(50) NOT NULL,
  `p_fname` varchar(30) NOT NULL,
  `p_lname` varchar(20) NOT NULL,
  `p_adhar` varchar(12) NOT NULL,
  `p_gender` varchar(10) NOT NULL,
  `p_address` text NOT NULL,
  `p_email` varchar(50) NOT NULL,
  `p_contact` varchar(11) NOT NULL,
  `p_job` varchar(70) NOT NULL,
  `p_son` varchar(20) NOT NULL,
  `p_pass` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`p_id`, `p_fname`, `p_lname`, `p_adhar`, `p_gender`, `p_address`, `p_email`, `p_contact`, `p_job`, `p_son`, `p_pass`, `status`) VALUES
('PAR-4566', 'Rameshbhai', 'Adroja', '123456789012', 'Male', '321, Ghanchivali Sheri, Sarvad, Morbi - 363660', 'ronakadroja1234@gmail.com', '1234567890', 'Farmer + Manager', 'STU-22809', 'Par@Rameshbhai123', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `standard` varchar(10) NOT NULL,
  `class_teacher` varchar(100) NOT NULL,
  `timetable` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `standard`, `class_teacher`, `timetable`) VALUES
(4, 'CLASS-333', 'TEACHER-889', '1656485329Index-01.pdf'),
(5, 'CLASS-603', 'TEACHER-675', '1656497033Schedule.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` varchar(30) NOT NULL,
  `stu_fname` varchar(50) NOT NULL,
  `stu_mname` varchar(50) NOT NULL,
  `stu_lname` varchar(50) NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_doj` date NOT NULL,
  `stu_gender` varchar(10) NOT NULL,
  `stu_email` varchar(100) NOT NULL,
  `stu_address` text NOT NULL,
  `stu_std` varchar(10) NOT NULL,
  `stu_pass` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_fname`, `stu_mname`, `stu_lname`, `stu_dob`, `stu_doj`, `stu_gender`, `stu_email`, `stu_address`, `stu_std`, `stu_pass`, `status`) VALUES
('STU-22809', 'Ronak', 'Rameshbhai', 'Adroja', '2022-06-30', '2022-06-30', 'Male', 'ronakadroja1234@gmail.com', '321, Ghanchivali Sheri, Sarvad, Morbi - 363660', '9 B', 'Stu@Ronak123', 'active'),
('STU-23004', 'Jil', 'Niranjanbhai', 'Patel', '2022-06-30', '2022-06-30', 'Male', 'jil1710.jp@gmail.com', 'Gamtalav\r\nBujarang', '4 B', 'Stu@Jil123', 'active'),
('STU-87396', 'Denis', 'Harsukhbhai', 'Shingala', '2022-07-13', '2022-07-14', 'Female', 'denis@gmail.com', 'Surat', '9 B', 'Stu@Denis123', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` varchar(10) NOT NULL,
  `sub_standard` varchar(10) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `sub_teacher` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_standard`, `sub_name`, `sub_teacher`) VALUES
('SUB-193', '4 B', 'gujarati', 'TEACHER-738'),
('SUB-268', '9 B', 'science', 'TEACHER-738'),
('SUB-494', '4 B', 'english', 'TEACHER-563'),
('SUB-679', '9 B', 'gujarati', 'TEACHER-107');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tid` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `bday` date NOT NULL,
  `skill` varchar(500) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tid`, `fname`, `lname`, `address`, `contact`, `bday`, `skill`, `gender`, `email`, `password`, `status`) VALUES
('TEACHER-107', 'ronak', 'adroja', '321, Ghanchivali Sheri, Sarvad, Morbi - 363660', '9510920621', '2022-06-29', 'Maths', 'Male', 'ronakadroja1234@gmail.com', 'Tea@ronak123', 'active'),
('TEACHER-563', 'Akshay', 'Dobariya', 'Junagadh', '9586804648', '2022-07-05', 'cricket', 'Male', 'akshay@gmail.com', 'Tea@Akshay123', 'active'),
('TEACHER-738', 'Jil', 'Patel', 'anand', '1234567890', '2022-06-29', 'developer', 'Male', 'jil1704.jp@gmail.com', 'Tea@Jil123', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `marks_entry`
--
ALTER TABLE `marks_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `marks_entry`
--
ALTER TABLE `marks_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
