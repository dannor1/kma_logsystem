-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 10:50 PM
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
-- Database: `kma_log_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Budget'),
(2, 'Metro Chief Executive\'s Office'),
(3, 'Metro Coordinating Director'),
(4, 'Planning'),
(5, 'Records');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `staff_id`, `name`, `department_id`, `phone`, `email`, `position`, `date_of_birth`, `hire_date`, `password`, `is_admin`, `role`) VALUES
(2, '1132', 'Samuel Amoah', 4, '0531114854', 'admin@gmail.com', 'Admin', '2024-09-11', '2024-09-11', '$2y$10$JoyVj.g06yului4tIs0QjufwlkdY8CvFHIiN7zZv.BrI0NQQQ4bZK', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `date_received` date NOT NULL,
  `log_time` time NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `from_whom_received` varchar(255) NOT NULL,
  `date_of_letter` date NOT NULL,
  `letter_ref_no` varchar(100) NOT NULL,
  `received_by` int(11) DEFAULT NULL,
  `type_of_letter` enum('Official','Unofficial','Dispatched','Income') NOT NULL,
  `subject` text NOT NULL,
  `file_process` enum('incoming','outgoing','pending') NOT NULL,
  `attached_file` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `year`, `month`, `date_received`, `log_time`, `serial_no`, `from_whom_received`, `date_of_letter`, `letter_ref_no`, `received_by`, `type_of_letter`, `subject`, `file_process`, `attached_file`, `department_id`) VALUES
(2, 2002, 'April', '2024-09-11', '13:43:00', '11223344', 'Samuel Amoah', '2024-09-11', 'tyughbrtufy', 2, 'Unofficial', 'PAYMENT OF 50% SHARE OF NET REVENUE FOR WEEK FIVE, OF JUNE,2024 ', 'pending', 'uploads/Add-Log-K-M-A-Log-System.png', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `received_by` (`received_by`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`received_by`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
