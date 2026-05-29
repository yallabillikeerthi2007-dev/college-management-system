-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 07:36 AM
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
-- Database: `college_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `branch` varchar(20) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `total_fee` int(11) DEFAULT NULL,
  `paid_fee` int(11) DEFAULT NULL,
  `balance_fee` int(11) DEFAULT NULL,
  `due_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studs`
--

CREATE TABLE `studs` (
  `id` int(11) NOT NULL,
  `pin_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `total_fee` int(11) NOT NULL,
  `paid_fee` int(11) DEFAULT NULL,
  `due_date` date NOT NULL,
  `balance_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studs`
--

INSERT INTO `studs` (`id`, `pin_no`, `name`, `branch`, `year`, `phone`, `total_fee`, `paid_fee`, `due_date`, `balance_fee`) VALUES
(1, '24173-CM-001', 'Keerthi', 'CME', '2nd', '9876543210', 5000, 2000, '2026-05-25', 3000),
(4, '24173-CM-002', 'suzy', 'ECE', '2nd', '9876543210', 5000, 2000, '2026-05-30', 3000),
(9, '24173-CM-004', 'suzya', 'CME', '1st Year', '6304320238', 4700, 3000, '2026-12-20', 1700);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `pin`) VALUES
(1, 'admin', 'admin', 'admin123', ''),
(2, 'student', 'keerthi', 'keerthi', '24173-cm-001'),
(3, 'student', 'deepthi', 'deepthi', '24173-cm-002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studs`
--
ALTER TABLE `studs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studs`
--
ALTER TABLE `studs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
