-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 03:32 PM
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
-- Database: `db_crs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_course`
--

CREATE TABLE `tb_course` (
  `c_code` varchar(10) NOT NULL,
  `c_name` varchar(35) NOT NULL,
  `c_credit` int(11) NOT NULL,
  `c_lec` varchar(10) NOT NULL,
  `c_max_student` int(11) NOT NULL,
  `c_current_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_course`
--

INSERT INTO `tb_course` (`c_code`, `c_name`, `c_credit`, `c_lec`, `c_max_student`, `c_current_student`) VALUES
('SECJ0090', 'Programming Technique II', 3, 'L002', 50, 1),
('SECJ2013', 'Data Structure and Algorithm', 3, 'L001', 50, 0),
('SECJ2154', 'Object-Oriented Programming', 4, 'L001', 50, 0),
('SECP2523', 'Database (WBL)', 3, 'L001', 50, 0),
('SECP2753', 'Data Mining', 3, 'L001', 50, 0),
('SECP3204', 'Software Engineering (WBL)', 4, 'L002', 80, 0),
('SECP3223', 'Data Analytic Programming', 3, 'L001', 50, 0),
('SECP3723', 'System Development Technology (WBL)', 3, 'L003', 50, 0),
('SECR2043', 'Operating Systems', 3, 'L004', 40, 0),
('SECR2213', 'Network Communication', 3, 'L004', 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_registration`
--

CREATE TABLE `tb_registration` (
  `r_tid` int(11) NOT NULL COMMENT 'This is the transaction ID',
  `r_student` varchar(10) NOT NULL,
  `r_course` varchar(10) NOT NULL,
  `r_sem` varchar(11) NOT NULL,
  `r_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_registration`
--

INSERT INTO `tb_registration` (`r_tid`, `r_student`, `r_course`, `r_sem`, `r_status`) VALUES
(137, 'S001', 'SECJ0090', '2024/2025-2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `s_id` int(11) NOT NULL,
  `s_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`s_id`, `s_desc`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `u_sno` varchar(10) NOT NULL,
  `u_pwd` varchar(128) NOT NULL,
  `u_email` varchar(40) NOT NULL,
  `u_name` varchar(150) NOT NULL,
  `u_contact` varchar(12) NOT NULL,
  `u_state` varchar(20) NOT NULL,
  `u_reg` timestamp NULL DEFAULT NULL,
  `u_utype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`u_sno`, `u_pwd`, `u_email`, `u_name`, `u_contact`, `u_state`, `u_reg`, `u_utype`) VALUES
('L001', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'lecturer@gmail.com', 'lecturertest', '01111111111', 'Johor', '2023-01-31 16:00:00', 1),
('L002', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'fazura@gmail.com', 'Fazura', '01125326321', 'Kelantan', '2023-09-30 16:00:00', 1),
('L003', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'firzana@gmail.com', 'Firzana', '01123632521', 'Johor', '2023-01-31 16:00:00', 1),
('L004', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'satar@gmail.com', 'Ahmad Satar', '172222222', 'Kelantan', '2023-09-30 16:00:00', 1),
('S001', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'student@gmail.com', 'studenttest', '02222222222', 'Perak', '2024-01-31 16:00:00', 2),
('S002', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'ahmad@gmail.com', 'Ahmad Abdul', '157777777', 'Selangor', '2024-09-30 16:00:00', 2),
('S003', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'hello@gmail.com', 'Mohamed Alif Fathi', '111234567', 'Perak', '2024-11-13 05:06:48', 2),
('S009', '$2y$10$.uFYoQxIWWSdWJ807VqdTOjjOesutTUJTO9FHOtwTgr9Xd4A3mtB2', 'alifptn1234@gmail.com', 'Alif Fathi', '0189561219', 'Perak', '2025-01-31 13:37:00', 2),
('T001', '$2y$10$0uokb0tzQjTYRq9Hf6GnR.q7nkISOD8Tf/czmOXm02mQcuKUJZ/am', 'itstaff@gmail.com', 'itstafftest', '03333333333', 'Johor', '2023-01-31 16:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_utype`
--

CREATE TABLE `tb_utype` (
  `t_id` int(11) NOT NULL,
  `t_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_utype`
--

INSERT INTO `tb_utype` (`t_id`, `t_desc`) VALUES
(1, 'Lecturer'),
(2, 'Student'),
(3, 'IT Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD PRIMARY KEY (`c_code`),
  ADD KEY `c_lec` (`c_lec`);

--
-- Indexes for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD PRIMARY KEY (`r_tid`),
  ADD KEY `r_student` (`r_student`),
  ADD KEY `r_course` (`r_course`),
  ADD KEY `r_status` (`r_status`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`u_sno`),
  ADD KEY `u_utype` (`u_utype`);

--
-- Indexes for table `tb_utype`
--
ALTER TABLE `tb_utype`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `r_tid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This is the transaction ID', AUTO_INCREMENT=138;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD CONSTRAINT `tb_course_ibfk_1` FOREIGN KEY (`c_lec`) REFERENCES `tb_user` (`u_sno`);

--
-- Constraints for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD CONSTRAINT `tb_registration_ibfk_1` FOREIGN KEY (`r_student`) REFERENCES `tb_user` (`u_sno`),
  ADD CONSTRAINT `tb_registration_ibfk_2` FOREIGN KEY (`r_course`) REFERENCES `tb_course` (`c_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_registration_ibfk_3` FOREIGN KEY (`r_status`) REFERENCES `tb_status` (`s_id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`u_utype`) REFERENCES `tb_utype` (`t_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
