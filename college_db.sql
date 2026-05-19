-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2026 at 05:24 PM
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
-- Database: `college_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `pin_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `total_fee` int(11) NOT NULL,
  `due_fee` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `balance_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `pin_no`, `name`, `branch`, `year`, `phone`, `total_fee`, `due_fee`, `due_date`, `balance_fee`) VALUES
(1, '24173-CM-001', 'Keerthi', 'CME', '2nd', '9876543210', 5000, 2000, '2026-05-25', 3000),
(4, '24173-CM-002', 'suzy', 'ECE', '2nd', '9876543210', 5000, 2000, '2026-05-30', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `students_fees`
--

CREATE TABLE `students_fees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `branch` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `paid_fee` int(11) DEFAULT NULL,
  `due_fee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `rollno` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `pinno` varchar(20) DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `paid_fee` int(11) DEFAULT NULL,
  `due_fee` int(11) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_fees`
--

INSERT INTO `student_fees` (`id`, `rollno`, `name`, `year`, `pinno`, `total_fee`, `paid_fee`, `due_fee`, `branch`, `phone`) VALUES
(1, '24173-CM-001', 'Keerthi', '2nd Year', '24173-CM-001', 5000, 2000, 3000, 'CME', '9876543210'),
(2, '24173-CM-002', 'kari', '1st Year', '24173-CM-002', 4700, 1000, 3700, 'ECE', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `pinno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `pinno`) VALUES
(3, 'student', 'keerthi', NULL, '24173-CM-001'),
(4, 'admin', 'gayathri', NULL, '24173admin001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_fees`
--
ALTER TABLE `students_fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`pin`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_fees`
--
ALTER TABLE `students_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
