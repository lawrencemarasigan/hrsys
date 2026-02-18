-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2026 at 08:51 AM
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
  `name` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `hired_at` date DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `sss` varchar(50) DEFAULT NULL,
  `gsis` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees`
(`id`, `name`, `department`, `position`, `hired_at`, `civil_status`, `philhealth`, `sss`, `gsis`, `tin`, `pagibig`)
VALUES
(1,'John Doe','Human Resource','Staff','2025-12-19','Single','PH100000001','SSS100000001','GSIS100000001','TIN100000001','PAG100000001'),
(2,'Jenny Johnson','MSWDO','Staff','2026-01-12','Married','PH100000002','SSS100000002','GSIS100000002','TIN100000002','PAG100000002'),
(3,'Dwayne Joseph','Agriculture','Intern','2026-01-12','Single','PH100000003','SSS100000003','GSIS100000003','TIN100000003','PAG100000003'),
(4,'Maria Santos','Human Resource','HR Assistant','2025-03-10','Single','PH100000004','SSS100000004','GSIS100000004','TIN100000004','PAG100000004'),
(5,'Juan Dela Cruz','PESO','Job Placement Officer','2024-07-15','Married','PH100000005','SSS100000005','GSIS100000005','TIN100000005','PAG100000005'),
(6,'Anna Reyes','Treasurer','Account Clerk','2023-09-20','Single','PH100000006','SSS100000006','GSIS100000006','TIN100000006','PAG100000006'),
(7,'Mark Villanueva','MDRRMO','Rescue Officer','2024-01-05','Married','PH100000007','SSS100000007','GSIS100000007','TIN100000007','PAG100000007'),
(8,'Paolo Mendoza','Tourism','Tourism Aide','2025-06-12','Single','PH100000008','SSS100000008','GSIS100000008','TIN100000008','PAG100000008'),
(9,'Kimberly Tan','MSWDO','Social Worker I','2023-02-14','Single','PH100000009','SSS100000009','GSIS100000009','TIN100000009','PAG100000009'),
(10,'John Lim','Human Resource','Recruitment Officer','2024-12-01','Married','PH100000010','SSS100000010','GSIS100000010','TIN100000010','PAG100000010'),
(11,'Christine Go','PESO','Career Coach','2025-03-10','Single','PH100000011','SSS100000011','GSIS100000011','TIN100000011','PAG100000011'),
(12,'Ryan Bautista','MDRRMO','Emergency Responder','2024-08-08','Single','PH100000012','SSS100000012','GSIS100000012','TIN100000012','PAG100000012'),
(13,'Angelica Cruz','MSWDO','Community Worker','2023-04-19','Married','PH100000013','SSS100000013','GSIS100000013','TIN100000013','PAG100000013'),
(14,'Noel Garcia','Agriculture','Farm Technician','2024-05-21','Single','PH100000014','SSS100000014','GSIS100000014','TIN100000014','PAG100000014'),
(15,'Patrick Flores','Tourism','Tourism Officer','2025-07-30','Single','PH100000015','SSS100000015','GSIS100000015','TIN100000015','PAG100000015'),
(16,'Elaine Ramos','Treasurer','Bookkeeper','2023-02-17','Married','PH100000016','SSS100000016','GSIS100000016','TIN100000016','PAG100000016'),
(17,'Joshua Aquino','Human Resource','Training Officer','2024-05-11','Single','PH100000017','SSS100000017','GSIS100000017','TIN100000017','PAG100000017'),
(18,'Rhea Castillo','PESO','Employment Facilitator','2025-10-06','Married','PH100000018','SSS100000018','GSIS100000018','TIN100000018','PAG100000018'),
(19,'Miguel Navarro','MDRRMO','Safety Officer','2023-09-23','Single','PH100000019','SSS100000019','GSIS100000019','TIN100000019','PAG100000019'),
(20,'Trisha Perez','MSWDO','Case Manager','2024-06-01','Married','PH100000020','SSS100000020','GSIS100000020','TIN100000020','PAG100000020'),
(21,'Kevin Ong','Treasurer','Finance Assistant','2025-01-27','Single','PH100000021','SSS100000021','GSIS100000021','TIN100000021','PAG100000021'),
(22,'Lara Villamor','Human Resource','HR Officer','2023-11-18','Single','PH100000022','SSS100000022','GSIS100000022','TIN100000022','PAG100000022'),
(23,'Francis De Leon','MDRRMO','Disaster Risk Analyst','2024-02-03','Married','PH100000023','SSS100000023','GSIS100000023','TIN100000023','PAG100000023'),
(24,'Joyce Hernandez','Tourism','Tour Guide','2025-08-14','Single','PH100000024','SSS100000024','GSIS100000024','TIN100000024','PAG100000024'),
(25,'Albert Chua','Treasurer','Financial Analyst','2023-03-22','Married','PH100000025','SSS100000025','GSIS100000025','TIN100000025','PAG100000025'),
(26,'Monica Lim','Human Resource','HR Manager','2024-12-05','Single','PH100000026','SSS100000026','GSIS100000026','TIN100000026','PAG100000026'),
(27,'Dennis Yu','Agriculture','Field Supervisor','2025-09-09','Married','PH100000027','SSS100000027','GSIS100000027','TIN100000027','PAG100000027'),
(28,'Sheila Torres','MSWDO','Family Welfare Officer','2023-06-07','Single','PH100000028','SSS100000028','GSIS100000028','TIN100000028','PAG100000028'),
(29,'Carlo Pineda','Tourism','Event Coordinator','2024-04-28','Married','PH100000029','SSS100000029','GSIS100000029','TIN100000029','PAG100000029'),
(30,'Nina Santiago','PESO','Livelihood Program Officer','2025-07-16','Single','PH100000030','SSS100000030','GSIS100000030','TIN100000030','PAG100000030'),
(31,'Roberto Manalo','Agriculture','Irrigation Technician','2023-10-02','Married','PH100000031','SSS100000031','GSIS100000031','TIN100000031','PAG100000031'),
(32,'Bea Mercado','Human Resource','HR Generalist','2024-11-11','Single','PH100000032','SSS100000032','GSIS100000032','TIN100000032','PAG100000032'),
(33,'Ian Cabrera','MDRRMO','Operations Officer','2025-03-19','Single','PH100000033','SSS100000033','GSIS100000033','TIN100000033','PAG100000033'),
(34,'Jasmine Fajardo','Treasurer','Payroll Officer','2024-06-25','Married','PH100000034','SSS100000034','GSIS100000034','TIN100000034','PAG100000034'),
(35,'Leo Alonzo','Tourism','Tourism Staff','2023-01-14','Single','PH100000035','SSS100000035','GSIS100000035','TIN100000035','PAG100000035'),
(36,'Therese Gutierrez','MSWDO','Social Development Officer','2024-08-21','Married','PH100000036','SSS100000036','GSIS100000036','TIN100000036','PAG100000036'),
(37,'Marco Evangelista','MDRRMO','Rescue Team Leader','2025-10-30','Single','PH100000037','SSS100000037','GSIS100000037','TIN100000037','PAG100000037'),
(38,'Cathy Soriano','PESO','Employment Officer','2023-04-08','Married','PH100000038','SSS100000038','GSIS100000038','TIN100000038','PAG100000038'),
(39,'Ronnie Abad','Agriculture','Agri Technician','2024-09-13','Single','PH100000039','SSS100000039','GSIS100000039','TIN100000039','PAG100000039'),
(40,'Kyla Panganiban','Tourism','Tourism Promotion Officer','2025-12-01','Married','PH100000040','SSS100000040','GSIS100000040','TIN100000040','PAG100000040'),
(41,'Victor Dizon','Treasurer','Revenue Officer','2023-07-29','Single','PH100000041','SSS100000041','GSIS100000041','TIN100000041','PAG100000041'),
(42,'April Montoya','Human Resource','HR Specialist','2024-05-04','Married','PH100000042','SSS100000042','GSIS100000042','TIN100000042','PAG100000042'),
(43,'Enzo Ramirez','MDRRMO','Disaster Response Aide','2025-02-09','Single','PH100000043','SSS100000043','GSIS100000043','TIN100000043','PAG100000043'),
(44,'Clarisse Uy','PESO','PESO Staff','2023-11-26','Married','PH100000044','SSS100000044','GSIS100000044','TIN100000044','PAG100000044'),
(45,'Henry Lao','Treasurer','Cashier','2024-03-15','Single','PH100000045','SSS100000045','GSIS100000045','TIN100000045','PAG100000045'),
(46,'Mika Tan','Tourism','Tourism Researcher','2025-06-22','Married','PH100000046','SSS100000046','GSIS100000046','TIN100000046','PAG100000046'),
(47,'Oliver Co','Treasurer','Treasury Analyst','2023-08-18','Single','PH100000047','SSS100000047','GSIS100000047','TIN100000047','PAG100000047'),
(48,'Diane Rosales','MSWDO','Social Welfare Aide','2024-12-19','Married','PH100000048','SSS100000048','GSIS100000048','TIN100000048','PAG100000048'),
(49,'Arvin Dela Rosa','Agriculture','Crop Specialist','2025-04-27','Single','PH100000049','SSS100000049','GSIS100000049','TIN100000049','PAG100000049'),
(50,'Sophia Natividad','Human Resource','HR Manager','2023-09-06','Married','PH100000050','SSS100000050','GSIS100000050','TIN100000050','PAG100000050'),
(51,'Bryan Tiong','MDRRMO','Emergency Planner','2024-02-24','Single','PH100000051','SSS100000051','GSIS100000051','TIN100000051','PAG100000051'),
(52,'Patricia Velasco','PESO','Employment Program Manager','2025-07-31','Married','PH100000052','SSS100000052','GSIS100000052','TIN100000052','PAG100000052'),
(53,'Jomar Ibañez','MDRRMO','Rescue Technician','2023-10-17','Single','PH100000053','SSS100000053','GSIS100000053','TIN100000053','PAG100000053'),
(54,'Katrina Flores','Tourism','Tourism Marketing Officer','2024-01-05','Married','PH100000054','SSS100000054','GSIS100000054','TIN100000054','PAG100000054'),
(55,'Rey Padilla','Treasurer','Budget Officer','2025-03-08','Single','PH100000055','SSS100000055','GSIS100000055','TIN100000055','PAG100000055'),
(56,'Janine Co','Human Resource','Recruitment Assistant','2023-06-14','Married','PH100000056','SSS100000056','GSIS100000056','TIN100000056','PAG100000056'),
(57,'Christian Puno','Agriculture','Agricultural Officer','2024-09-09','Single','PH100000057','SSS100000057','GSIS100000057','TIN100000057','PAG100000057'),
(58,'Alyssa Domingo','MSWDO','Child Welfare Officer','2025-11-20','Married','PH100000058','SSS100000058','GSIS100000058','TIN100000058','PAG100000058'),
(59,'Nikko Perez','PESO','Job Fair Coordinator','2023-02-02','Single','PH100000059','SSS100000059','GSIS100000059','TIN100000059','PAG100000059'),
(60,'Melvin Santos','Agriculture','Farm Supervisor','2024-07-07','Married','PH100000060','SSS100000060','GSIS100000060','TIN100000060','PAG100000060'),
(61,'Camille Abella','Tourism','Tourism Media Officer','2025-01-16','Single','PH100000061','SSS100000061','GSIS100000061','TIN100000061','PAG100000061'),
(62,'Jerome Valdez','MDRRMO','Emergency Operations Officer','2023-12-28','Married','PH100000062','SSS100000062','GSIS100000062','TIN100000062','PAG100000062'),
(63,'Ralph Magno','MSWDO','Social Case Worker','2024-06-03','Single','PH100000063','SSS100000063','GSIS100000063','TIN100000063','PAG100000063'),
(64,'Tanya Belmonte','Treasurer','Compliance Officer','2025-08-09','Married','PH100000064','SSS100000064','GSIS100000064','TIN100000064','PAG100000064'),
(65,'Owen Lee','Human Resource','HR Generalist','2023-04-26','Single','PH100000065','SSS100000065','GSIS100000065','TIN100000065','PAG100000065'),
(66,'Paula David','Tourism','Tourism Supervisor','2024-10-12','Married','PH100000066','SSS100000066','GSIS100000066','TIN100000066','PAG100000066'),
(67,'Dennis Cruz','MDRRMO','Disaster Management Officer','2025-09-17','Single','PH100000067','SSS100000067','GSIS100000067','TIN100000067','PAG100000067'),
(68,'Hazel Moran','MSWDO','Community Development Officer','2023-05-30','Married','PH100000068','SSS100000068','GSIS100000068','TIN100000068','PAG100000068'),
(69,'Vincent Yap','Agriculture','Supply Officer','2024-11-23','Single','PH100000069','SSS100000069','GSIS100000069','TIN100000069','PAG100000069'),
(70,'Mae Tolentino','PESO','Youth Employment Officer','2025-02-28','Married','PH100000070','SSS100000070','GSIS100000070','TIN100000070','PAG100000070'),
(71,'Arthur Sy','Treasurer','Investment Officer','2023-01-09','Single','PH100000071','SSS100000071','GSIS100000071','TIN100000071','PAG100000071'),
(72,'Bianca Roces','Human Resource','Onboarding Specialist','2024-08-16','Married','PH100000072','SSS100000072','GSIS100000072','TIN100000072','PAG100000072'),
(73,'Joel Macapagal','MDRRMO','Emergency Coordinator','2025-12-10','Single','PH100000073','SSS100000073','GSIS100000073','TIN100000073','PAG100000073'),
(74,'Shane Legaspi','MSWDO','Social Welfare Officer','2023-07-01','Married','PH100000074','SSS100000074','GSIS100000074','TIN100000074','PAG100000074'),
(75,'Felix Ong','PESO','PESO Head','2024-04-02','Single','PH100000075','SSS100000075','GSIS100000075','TIN100000075','PAG100000075'),
(76,'Ivy Calderon','Tourism','Tourism Events Officer','2025-05-18','Married','PH100000076','SSS100000076','GSIS100000076','TIN100000076','PAG100000076'),
(77,'Andre Gutierrez','Agriculture','Agri Program Manager','2023-09-25','Single','PH100000077','SSS100000077','GSIS100000077','TIN100000077','PAG100000077'),
(78,'Mariel Tadeo','Treasurer','Tax Specialist','2024-02-11','Married','PH100000078','SSS100000078','GSIS100000078','TIN100000078','PAG100000078'),
(79,'Cedric Tan','PESO','Livelihood Coordinator','2025-06-29','Single','PH100000079','SSS100000079','GSIS100000079','TIN100000079','PAG100000079'),
(80,'Lynette Perez','Human Resource','People Operations Officer','2023-10-08','Married','PH100000080','SSS100000080','GSIS100000080','TIN100000080','PAG100000080'),
(81,'Donny Velasco','MSWDO','Field Social Worker','2024-12-14','Single','PH100000081','SSS100000081','GSIS100000081','TIN100000081','PAG100000081'),
(82,'Zara Lim','Tourism','Tourism Desk Officer','2025-01-21','Married','PH100000082','SSS100000082','GSIS100000082','TIN100000082','PAG100000082'),
(83,'Aiden Cruz','MDRRMO','Logistics Officer','2024-04-06','Single','PH100000083','SSS100000083','GSIS100000083','TIN100000083','PAG100000083'),
(84,'Marianne Uy','PESO','Program Assistant','2023-06-18','Married','PH100000084','SSS100000084','GSIS100000084','TIN100000084','PAG100000084'),
(85,'Rogelio Pineda','Agriculture','Livestock Technician','2025-03-22','Single','PH100000085','SSS100000085','GSIS100000085','TIN100000085','PAG100000085'),
(86,'Celine Navarro','Human Resource','HR Coordinator','2024-01-30','Married','PH100000086','SSS100000086','GSIS100000086','TIN100000086','PAG100000086'),
(87,'Victor Ramos','Treasurer','Collections Officer','2023-08-07','Single','PH100000087','SSS100000087','GSIS100000087','TIN100000087','PAG100000087'),
(88,'Althea Romero','MSWDO','Senior Social Worker','2025-07-05','Married','PH100000088','SSS100000088','GSIS100000088','TIN100000088','PAG100000088'),
(89,'Brian Lopez','Tourism','Tourism Operations Officer','2024-09-09','Single','PH100000089','SSS100000089','GSIS100000089','TIN100000089','PAG100000089'),
(90,'Erwin Tan','MDRRMO','Disaster Logistics Officer','2023-03-12','Married','PH100000090','SSS100000090','GSIS100000090','TIN100000090','PAG100000090'),
(91,'Liza Mendoza','PESO','Employment Data Analyst','2025-01-18','Single','PH100000091','SSS100000091','GSIS100000091','TIN100000091','PAG100000091'),
(92,'Noah Villanueva','Agriculture','Agri Extension Officer','2024-06-10','Married','PH100000092','SSS100000092','GSIS100000092','TIN100000092','PAG100000092'),
(93,'Kris Aquino','Human Resource','HR Business Partner','2023-02-22','Single','PH100000093','SSS100000093','GSIS100000093','TIN100000093','PAG100000093'),
(94,'Ramon Diaz','Treasurer','Senior Accountant','2025-10-03','Married','PH100000094','SSS100000094','GSIS100000094','TIN100000094','PAG100000094'),
(95,'Faith Soriano','MSWDO','Women Welfare Officer','2024-11-27','Single','PH100000095','SSS100000095','GSIS100000095','TIN100000095','PAG100000095'),
(96,'Joel Tan','Tourism','Tourism Planning Officer','2023-05-16','Married','PH100000096','SSS100000096','GSIS100000096','TIN100000096','PAG100000096'),
(97,'Harold Ong','PESO','Industry Partnership Officer','2025-06-02','Single','PH100000097','SSS100000097','GSIS100000097','TIN100000097','PAG100000097'),
(98,'Mara Castillo','MDRRMO','Preparedness Officer','2024-02-14','Married','PH100000098','SSS100000098','GSIS100000098','TIN100000098','PAG100000098'),
(99,'Dustin Reyes','Agriculture','Post-Harvest Officer','2023-09-01','Single','PH100000099','SSS100000099','GSIS100000099','TIN100000099','PAG100000099'),
(100,'Aira Villanueva','MSWDO','Youth Program Officer','2025-12-01','Married','PH100000100','SSS100000100','GSIS100000100','TIN100000100','PAG100000100');


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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
