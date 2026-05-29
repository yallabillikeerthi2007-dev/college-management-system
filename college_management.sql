-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 08:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `dept` varchar(10) NOT NULL,
  `year` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') DEFAULT NULL,
  `present_days` int(11) DEFAULT 0,
  `total_days` int(11) DEFAULT 0,
  `percentage` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `student_name`, `dept`, `year`, `date`, `status`, `present_days`, `total_days`, `percentage`) VALUES
(1, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(2, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(3, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(4, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(5, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(6, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(7, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(8, 24173, '', 'CME', '2024-2027', '2008-07-14', 'Present', 0, 0, 0.00),
(9, 24173, 'koribilli sarika', 'CME', '2024-2027', '2026-05-25', 'Absent', 0, 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(50) DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `teacher_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `teacher_id`, `subject_name`, `year`, `dept`, `teacher_name`) VALUES
(1, '3', 'PROGRAMMING IN C', 'sem1', 'CME', 'MT-MOHANA TIRUMULA'),
(2, '4', 'BASIC COMPUTER ENGINEERING', 'sem1', 'CME', 'GGR-G.GIRISH REDDY'),
(3, '5', 'ENGINEERING DRAWING', 'sem1', 'CME', 'BS-B.SURESH'),
(4, '7', 'MATHEMATICS-I', 'sem1', 'CME', 'RG-R.GANESH KUMAR'),
(5, '8', 'ENGLISH', 'sem1', 'CME', 'BUM-B.UMA MAHESHWARI'),
(6, '9', 'ENGINEERING CHEMISTRY', 'sem1', 'CME', 'ysr-Y.Srinivas Rao'),
(7, '10', 'ENGINEERING PHYSICS', 'sem1', 'CME', 'K.Govinda Rao'),
(8, '1', 'MULTIMEDIA LABORATORY', 'sem3', 'CME', 'BNM-B NARASIMHA MURTHY'),
(9, '2', 'DIGITAL ELECTRONICS', 'sem3', 'CME', 'CHS-CH SAROJINI'),
(10, '2', 'DIGITAL ELECTRONICS LABORATORY', 'sem3', 'CME', 'CHS-CH SAROJINI'),
(11, '4', 'OPERATING SYSTEM', 'sem3', 'CME', 'GGR-G.GIRISH REDDY'),
(12, '5', 'DATA STRUCTURES AND ALGORITHMS', 'sem3', 'CME', 'BS-B.SURESH'),
(13, '5', 'DATA STRUCTURES AND ALGORITHMS LABORATORY', 'sem3', 'CME', 'BS-B.SURESH'),
(14, '6', 'DBMS', 'sem3', 'CME', 'MG-M.GAYATHRI'),
(15, '6', 'DBMS LABORATORY', 'sem3', 'CME', 'MG-M.GAYATHRI'),
(16, '7', 'MATHEMATICS-II', 'sem3', 'CME', 'RG-R.GANESH KUMAR'),
(17, '1', 'SOFTWARE ENGINEERING', 'sem4', 'CME', 'BNM-B NARASIMHA MURTHY'),
(18, '2', 'OOPS THROUGH JAVA', 'sem4', 'CME', 'CHS-CH SAROJINI'),
(19, '2', 'OOPS THROUGH JAVA LABORATORY', 'sem4', 'CME', 'CHS-CH SAROJINI'),
(20, '4', 'COMPUTER NETWORK AND CYBER SECURITY', 'sem4', 'CME', 'GGR-G.GIRISH REDDY'),
(21, '5', 'COMPUTER ORGANIZATION AND MICROPROCESSOR', 'sem4', 'CME', 'BS-B.SURESH'),
(22, '6', 'WEB TECHNOLOGIES', 'sem4', 'CME', 'MG-M.GAYATHRI'),
(23, '8', 'ENGLISH', 'sem4', 'CME', 'BUM-B.UMA MAHESHWARI');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept` varchar(10) NOT NULL,
  `qualification` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `name`, `dept`, `qualification`, `phone`, `email`, `password`) VALUES
(1, '1', 'BNM-B NARASIMHA MURTHY', 'CME', '', '', '', 'college'),
(2, '2', 'CHS-CH SAROJINI', 'CME', '', '', '', 'college'),
(3, '3', 'MT-MOHANA TIRUMULA', 'CME', '', '', '', 'college'),
(4, '4', 'GGR-G.GIRISH REDDY', 'CME', '', '', '', 'college'),
(5, '5', 'BS-B.SURESH', 'CME', '', '', '', 'college'),
(6, '6', 'MG-M.GAYATHRI', 'CME', '', '', '', 'college'),
(7, '7', 'RG-R.GANESH KUMAR', 'CME', '', '', '', 'college'),
(8, '8', 'BUM-B.UMA MAHESHWARI', 'CME', '', '', '', 'college'),
(10, '9', 'ysr-Y.Srinivas Rao', 'CME', '', '', '', 'college'),
(11, '10', 'K.Govinda Rao', 'CME', '', '', '', 'college');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `dept` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`id`, `teacher_id`, `teacher_name`, `dept`, `date`, `status`) VALUES
(1, '1', 'BNM-B NARASIMHA MURTHY', 'CME', '2026-08-05', 'Present'),
(2, '2', 'CHS-CH SAROJINI', 'CME', '2026-08-05', 'Present'),
(3, '3', 'MT-MOHANA TIRUMULA', 'CME', '2026-08-05', 'Present'),
(4, '4', 'GGR-G.GIRISH REDDY', 'CME', '2026-08-05', 'Present'),
(5, '5', 'BS-B.SURESH', 'CME', '2026-08-05', 'Present'),
(6, '6', 'MG-M.GAYATHRI', 'CME', '2026-08-05', 'Present'),
(7, '7', 'RG-R.GANESH KUMAR', 'CME', '2026-08-05', 'Present'),
(8, '8', 'BUM-B.UMA MAHESHWARI', 'CME', '2026-08-05', 'Present'),
(9, '9', 'ysr-Y.Srinivas Rao', 'CME', '2026-08-05', 'Present'),
(10, '10', 'K.Govinda Rao', 'CME', '2026-08-05', 'Present');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
