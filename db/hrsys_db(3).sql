-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2026 at 03:23 AM
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
(2, '', '', '', NULL, 'Ian Angelo Rodriguez', NULL, 'Single', NULL, 'Phil123456', 'SSS123456', 'GSIS123456', 'PAGIBIG123456', 'TIN123456', 'Human Resource', 'IT Intern', 'Casual', NULL, '2026-02-02', NULL, 'No', NULL, NULL, NULL, '2026-02-13 00:34:51'),
(3, '', '', '', NULL, 'Mark Lawrence Marasigan', NULL, 'Single', NULL, 'Phil123654', 'SSS123654', 'GSIS123654', 'PAGIBIG123654', 'TIN123654', 'Human Resource', 'IT Intern', 'Casual', NULL, '2026-02-02', NULL, 'No', NULL, NULL, NULL, '2026-02-16 01:42:23'),
(4, '', 'Juan', 'Dela Cruz', 'Santos', 'Juan Santos Dela Cruz', 'San Nicolas', 'Single', 'O+', NULL, NULL, NULL, NULL, NULL, 'HR', 'HR Officer', 'Permanent', 'SG 10', '2023-01-01', '2023-01-01', 'No', 'Employee', 'emp1@email.com', '123456', '2026-02-18 01:02:19'),
(5, '', 'Maria', 'Reyes', 'Lopez', 'Maria Lopez Reyes', 'San Nicolas', 'Married', 'A+', NULL, NULL, NULL, NULL, NULL, 'Finance', 'Accountant', 'Permanent', 'SG 12', '2023-01-02', '2023-01-02', 'No', 'Employee', 'emp2@email.com', '123456', '2026-02-18 01:02:19'),
(6, '', 'Carlos', 'Garcia', 'Mendoza', 'Carlos Mendoza Garcia', 'San Nicolas', 'Single', 'B+', NULL, NULL, NULL, NULL, NULL, 'IT', 'IT Staff', 'Contractual', 'SG 8', '2023-01-03', '2023-01-03', 'No', 'Employee', 'emp3@email.com', '123456', '2026-02-18 01:02:19'),
(7, '', 'Ana', 'Torres', 'Villanueva', 'Ana Villanueva Torres', 'San Nicolas', 'Married', 'AB+', NULL, NULL, NULL, NULL, NULL, 'Admin', 'Admin Staff', 'Permanent', 'SG 9', '2023-01-04', '2023-01-04', 'No', 'Employee', 'emp4@email.com', '123456', '2026-02-18 01:02:19'),
(8, '', 'Mark', 'Santos', 'Diaz', 'Mark Diaz Santos', 'San Nicolas', 'Single', 'O-', NULL, NULL, NULL, NULL, NULL, 'Engineering', 'Engineer', 'Permanent', 'SG 15', '2023-01-05', '2023-01-05', 'No', 'Employee', 'emp5@email.com', '123456', '2026-02-18 01:02:19'),
(9, '', 'Liza', 'Cruz', 'Perez', 'Liza Perez Cruz', 'San Nicolas', 'Single', 'A-', NULL, NULL, NULL, NULL, NULL, 'HR', 'HR Assistant', 'Permanent', 'SG 7', '2023-01-06', '2023-01-06', 'No', 'Employee', 'emp6@email.com', '123456', '2026-02-18 01:02:19'),
(10, '', 'Paolo', 'Ramos', 'Lee', 'Paolo Lee Ramos', 'San Nicolas', 'Married', 'B-', NULL, NULL, NULL, NULL, NULL, 'Finance', 'Budget Officer', 'Permanent', 'SG 13', '2023-01-07', '2023-01-07', 'No', 'Employee', 'emp7@email.com', '123456', '2026-02-18 01:02:19'),
(11, '', 'Jenny', 'Lim', 'Co', 'Jenny Co Lim', 'San Nicolas', 'Single', 'O+', NULL, NULL, NULL, NULL, NULL, 'IT', 'System Admin', 'Permanent', 'SG 14', '2023-01-08', '2023-01-08', 'No', 'Employee', 'emp8@email.com', '123456', '2026-02-18 01:02:19'),
(12, '', 'Arvin', 'Tan', 'Uy', 'Arvin Uy Tan', 'San Nicolas', 'Married', 'A+', NULL, NULL, NULL, NULL, NULL, 'Engineering', 'Technician', 'Permanent', 'SG 9', '2023-01-09', '2023-01-09', 'No', 'Employee', 'emp9@email.com', '123456', '2026-02-18 01:02:19'),
(13, '', 'Grace', 'Flores', 'Castro', 'Grace Castro Flores', 'San Nicolas', 'Single', 'AB-', NULL, NULL, NULL, NULL, NULL, 'Admin', 'Clerk', 'Contractual', 'SG 6', '2023-01-10', '2023-01-10', 'No', 'Employee', 'emp10@email.com', '123456', '2026-02-18 01:02:19'),
(14, '', 'Leo', 'Navarro', 'Silva', 'Leo Silva Navarro', 'San Nicolas', 'Single', 'O+', NULL, NULL, NULL, NULL, NULL, 'HR', 'HR Staff', 'Permanent', 'SG 8', '2023-01-11', '2023-01-11', 'No', 'Employee', 'emp11@email.com', '123456', '2026-02-18 01:02:19'),
(15, '', 'Ella', 'Gomez', 'Aquino', 'Ella Aquino Gomez', 'San Nicolas', 'Married', 'A+', NULL, NULL, NULL, NULL, NULL, 'Finance', 'Cashier', 'Permanent', 'SG 7', '2023-01-12', '2023-01-12', 'No', 'Employee', 'emp12@email.com', '123456', '2026-02-18 01:02:19'),
(16, '', 'Noel', 'Valdez', 'Sison', 'Noel Sison Valdez', 'San Nicolas', 'Single', 'B+', NULL, NULL, NULL, NULL, NULL, 'IT', 'Programmer', 'Permanent', 'SG 12', '2023-01-13', '2023-01-13', 'No', 'Employee', 'emp13@email.com', '123456', '2026-02-18 01:02:19'),
(17, '', 'Ivy', 'Chua', 'Tan', 'Ivy Tan Chua', 'San Nicolas', 'Married', 'O-', NULL, NULL, NULL, NULL, NULL, 'Engineering', 'Engineer', 'Permanent', 'SG 15', '2023-01-14', '2023-01-14', 'No', 'Employee', 'emp14@email.com', '123456', '2026-02-18 01:02:19'),
(18, '', 'Ryan', 'Soriano', 'Lim', 'Ryan Lim Soriano', 'San Nicolas', 'Single', 'A-', NULL, NULL, NULL, NULL, NULL, 'Admin', 'Admin Aide', 'Permanent', 'SG 5', '2023-01-15', '2023-01-15', 'No', 'Employee', 'emp15@email.com', '123456', '2026-02-18 01:02:19'),
(19, '', 'Mia', 'Alvarez', 'Cruz', 'Mia Cruz Alvarez', 'San Nicolas', 'Single', 'B-', NULL, NULL, NULL, NULL, NULL, 'HR', 'Recruiter', 'Permanent', 'SG 11', '2023-01-16', '2023-01-16', 'No', 'Employee', 'emp16@email.com', '123456', '2026-02-18 01:02:19'),
(20, '', 'Ken', 'Morales', 'Santos', 'Ken Santos Morales', 'San Nicolas', 'Married', 'AB+', NULL, NULL, NULL, NULL, NULL, 'Finance', 'Auditor', 'Permanent', 'SG 14', '2023-01-17', '2023-01-17', 'No', 'Employee', 'emp17@email.com', '123456', '2026-02-18 01:02:19'),
(21, '', 'Nina', 'Ponce', 'Reyes', 'Nina Reyes Ponce', 'San Nicolas', 'Single', 'O+', NULL, NULL, NULL, NULL, NULL, 'IT', 'IT Support', 'Permanent', 'SG 9', '2023-01-18', '2023-01-18', 'No', 'Employee', 'emp18@email.com', '123456', '2026-02-18 01:02:19'),
(22, '', 'Dan', 'Ocampo', 'Rivera', 'Dan Rivera Ocampo', 'San Nicolas', 'Married', 'A+', NULL, NULL, NULL, NULL, NULL, 'Engineering', 'Supervisor', 'Permanent', 'SG 16', '2023-01-19', '2023-01-19', 'No', 'Employee', 'emp19@email.com', '123456', '2026-02-18 01:02:19'),
(23, '', 'Faith', 'Domingo', 'Lopez', 'Faith Lopez Domingo', 'San Nicolas', 'Single', 'B+', NULL, NULL, NULL, NULL, NULL, 'Admin', 'Secretary', 'Permanent', 'SG 8', '2023-01-20', '2023-01-20', 'No', 'Employee', 'emp20@email.com', '123456', '2026-02-18 01:02:19'),
(24, '', 'John', 'Castillo', 'Perez', 'John Perez Castillo', 'San Nicolas', 'Single', 'O+', NULL, NULL, NULL, NULL, NULL, 'HR', 'HR Assistant', 'Permanent', 'SG 7', '2023-01-21', '2023-01-21', 'No', 'Employee', 'emp21@email.com', '123456', '2026-02-18 01:02:19'),
(25, '', 'Rica', 'Delos Santos', 'Garcia', 'Rica Garcia Delos Santos', 'San Nicolas', 'Married', 'A+', NULL, NULL, NULL, NULL, NULL, 'Finance', 'Bookkeeper', 'Permanent', 'SG 9', '2023-01-22', '2023-01-22', 'No', 'Employee', 'emp22@email.com', '123456', '2026-02-18 01:02:19'),
(26, '', 'Sam', 'Villanueva', 'Cruz', 'Sam Cruz Villanueva', 'San Nicolas', 'Single', 'B+', NULL, NULL, NULL, NULL, NULL, 'IT', 'Web Dev', 'Permanent', 'SG 12', '2023-01-23', '2023-01-23', 'No', 'Employee', 'emp23@email.com', '123456', '2026-02-18 01:02:19'),
(27, '', 'Joy', 'Herrera', 'Diaz', 'Joy Diaz Herrera', 'San Nicolas', 'Single', 'O-', NULL, NULL, NULL, NULL, NULL, 'Engineering', 'Engineer', 'Permanent', 'SG 15', '2023-01-24', '2023-01-24', 'No', 'Employee', 'emp24@email.com', '123456', '2026-02-18 01:02:19'),
(28, '', 'Carl', 'Rivas', 'Santos', 'Carl Santos Rivas', 'San Nicolas', 'Married', 'AB+', NULL, NULL, NULL, NULL, NULL, 'Admin', 'Clerk', 'Permanent', 'SG 6', '2023-01-25', '2023-01-25', 'No', 'Employee', 'emp25@email.com', '123456', '2026-02-18 01:02:19'),
(29, '', 'Aira', 'Mendoza', 'Torres', 'Aira Torres Mendoza', 'San Nicolas', 'Single', 'A-', NULL, NULL, NULL, NULL, NULL, 'HR', 'HR Staff', 'Permanent', 'SG 8', '2023-01-26', '2023-01-26', 'No', 'Employee', 'emp26@email.com', '123456', '2026-02-18 01:02:19'),
(30, '', 'Vince', 'Aquino', 'Lim', 'Vince Lim Aquino', 'San Nicolas', 'Single', 'B-', NULL, NULL, NULL, NULL, NULL, 'Finance', 'Accountant', 'Permanent', 'SG 12', '2023-01-27', '2023-01-27', 'No', 'Employee', 'emp27@email.com', '123456', '2026-02-18 01:02:19'),
(31, '', 'Sheila', 'Tan', 'Uy', 'Sheila Uy Tan', 'San Nicolas', 'Married', 'O+', NULL, NULL, NULL, NULL, NULL, 'IT', 'Network Admin', 'Permanent', 'SG 14', '2023-01-28', '2023-01-28', 'No', 'Employee', 'emp28@email.com', '123456', '2026-02-18 01:02:19'),
(32, '', 'Daryl', 'Reyes', 'Lopez', 'Daryl Lopez Reyes', 'San Nicolas', 'Single', 'A+', NULL, NULL, NULL, NULL, NULL, 'Engineering', 'Technician', 'Permanent', 'SG 9', '2023-01-29', '2023-01-29', 'No', 'Employee', 'emp29@email.com', '123456', '2026-02-18 01:02:19'),
(33, '', 'Anne', 'Flores', 'Castro', 'Anne Castro Flores', 'San Nicolas', 'Married', 'B+', NULL, NULL, NULL, NULL, NULL, 'Admin', 'Staff', 'Contractual', 'SG 7', '2023-01-30', '2023-01-30', 'No', 'Employee', 'emp30@email.com', '123456', '2026-02-18 01:02:19'),
(34, '', 'asas', 'sasas', 'sasas', 'asas sasas sasas', 'sasas', 'Separated', 'A+', '123', '1212', '3321', '2121', '2122212', 'IT', 'Staff', 'Casual', '20.00', '2026-02-19', '0000-00-00', 'Yes', 'Employee', 'admin@gmail.com', '$2y$10$yKR732K/yhVunkjASfTWAuvRiHtERtckV/Okz8KsUl25n.aKfvIhS', '2026-02-19 01:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `leave_app_no` int(11) NOT NULL,
  `employee_id` varchar(25) DEFAULT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `position` varchar(30) DEFAULT NULL,
  `type_of_leave` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`leave_app_no`, `employee_id`, `employee_name`, `department`, `position`, `type_of_leave`, `start_date`, `end_date`, `status`) VALUES
(1, 'EMP123', 'John Doe', 'Human Resource', 'Employee', 'Sick Leave', NULL, NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_no` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `request_type` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_no`, `employee_id`, `employee_name`, `department`, `position`, `request_type`, `status`) VALUES
(1, 'EMP12345', 'John Doe', 'Human Resource', 'Employee', 'Print Employee Details', 'Approve');

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
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`leave_app_no`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_no`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `leave_app_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
