-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 01:11 AM
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
-- Database: `hrsys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `sss` varchar(50) DEFAULT NULL,
  `gsis` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `employee_status` varchar(50) DEFAULT NULL,
  `salary_grade` varchar(50) DEFAULT NULL,
  `hired_at` date DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_ended` enum('Yes','No') DEFAULT 'No',
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `middle_name`, `name`, `address`, `civil_status`, `blood_type`, `philhealth`, `sss`, `gsis`, `pagibig`, `tin`, `department`, `position`, `employee_status`, `salary_grade`, `hired_at`, `appointment_date`, `appointment_ended`, `role`, `email`, `password`, `created_at`) VALUES
(1, 'EMP-001', 'Juan', 'Dela Cruz', 'Santos', 'Nestor Dela Rosa', 'San Nicolas, Ilocos Norte', 'Single', 'O+', 'PH123', 'SSS123', 'GSIS123', 'PAG123', 'TIN123', 'Human Resource', 'Staff', 'Regular', 'SG-11', '2025-01-10', '2025-01-10', 'No', 'Admin', 'juan@email.com', '123456', '2026-02-13 00:31:50'),
(2, '', '', '', NULL, 'Ian Angelo Rodriguez', NULL, 'Single', NULL, 'Phil123456', 'SSS123456', 'GSIS123456', 'PAGIBIG123456', 'TIN123456', 'Human Resource', 'IT Intern', NULL, NULL, '2026-02-02', NULL, 'No', NULL, NULL, NULL, '2026-02-13 00:34:51'),
(3, '', '', '', NULL, 'Mark Lawrence Marasigan', NULL, 'Single', NULL, 'Phil123654', 'SSS123654', 'GSIS123654', 'PAGIBIG123654', 'TIN123654', 'Human Resource', 'IT Intern', NULL, NULL, '2026-02-02', NULL, 'No', NULL, NULL, NULL, '2026-02-16 01:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `created_at`) VALUES
(1, 'admin123@gmail.com', '$2y$10$LvTnMhhrJwpS/oOc8yMhE.vAe2VQlv4HNnN7D2H2eyJV5nKn98qiK', 'System Admin', '2026-02-12 03:07:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
