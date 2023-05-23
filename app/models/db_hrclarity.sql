-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2023 at 03:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hrclarity`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `venue` varchar(250) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `venue`, `start_date`, `end_date`, `date_created`) VALUES
(1, 'Quarterly Meeting', 'All employees to meet for a breed meeting about the quarterly progress. Heads of Department to ensure all their team members attend the meeting.', 'Union Hall', '2023-05-23', '2023-05-23', '2023-05-23'),
(3, 'Obcaecati enim quia ', 'Delectus excepturi ', 'Nihil nihil providen', '2023-05-25', '2023-05-25', '2023-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(100) NOT NULL,
  `department_name` varchar(45) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `date_created`) VALUES
(9, 'Computer', '2023-05-18'),
(10, 'Marketting', '2023-05-18'),
(11, 'Accounts', '2023-05-18'),
(13, 'Administration', '2023-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(100) NOT NULL,
  `leave_type` varchar(30) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `user_id` int(100) NOT NULL,
  `leave_status` varchar(20) NOT NULL DEFAULT 'pending',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `leave_type`, `from_date`, `to_date`, `user_id`, `leave_status`, `date_created`) VALUES
(1, 'sick', '2023-05-16', '2023-05-19', 2, 'approved', '2023-05-12'),
(2, 'sabbatical', '2023-05-22', '2023-05-30', 2, 'rejected', '2023-05-12'),
(3, 'leave of absence', '2023-05-23', '2023-05-29', 3, 'approved', '2023-05-12'),
(4, 'maternal', '2023-05-22', '2023-05-27', 3, 'pending', '2023-05-13'),
(5, 'study', '2023-05-15', '2023-05-20', 3, 'approved', '2023-05-13'),
(6, 'sick', '2023-05-25', '2023-05-27', 21, 'pending', '2023-05-23'),
(7, 'study', '2023-05-30', '2023-05-28', 21, 'approved', '2023-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int(100) NOT NULL,
  `department_id` int(100) DEFAULT NULL,
  `occupation_name` varchar(30) NOT NULL,
  `basic_salary` double NOT NULL,
  `house_allowance` double NOT NULL,
  `medical_allowance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `department_id`, `occupation_name`, `basic_salary`, `house_allowance`, `medical_allowance`) VALUES
(2, 9, 'Web Developer', 80000, 15000, 1700),
(3, 10, 'Content Creator', 30000, 10000, 500),
(4, 11, 'Accountant', 50000, 10000, 1700),
(7, 13, 'HR', 60000, 20000, 1700);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_number` int(8) NOT NULL,
  `email_address` varchar(120) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `occupation_id` int(100) DEFAULT NULL,
  `user_level_id` int(3) NOT NULL,
  `user_status` int(3) NOT NULL DEFAULT 1,
  `profile_picture` varchar(250) NOT NULL DEFAULT '../../assets/uploads/profile_pictures/default.png',
  `password` varchar(200) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `id_number`, `email_address`, `phone_number`, `occupation_id`, `user_level_id`, `user_status`, `profile_picture`, `password`, `date_created`) VALUES
(1, 'admin', 'db_admin', 'female', '1998-08-12', 244558744, 'hr@gmail.com', '0725044587', 7, 2, 1, '../../assets/uploads/profile_pictures/default.png', 'hr', '2023-03-11'),
(2, 'Karen', 'Caldwell', 'male', '1968-02-10', 2297478, 'karen@gmail.com', '+1 (875) 222-5647', NULL, 1, 1, '../../assets/uploads/profile_pictures/default.png', 'u', '2023-05-12'),
(3, 'Aphrodite', 'Spencer', 'male', '1975-07-28', 717, 'test1@gmail.com', '+1 (295) 853-8208', NULL, 1, 1, '../../assets/uploads/profile_pictures/default.png', 't', '2023-05-12'),
(4, 'Chiquita', 'Pruitt', 'female', '1981-08-18', 72312254, 'pruitt@mailinator.com', '+1 (173) 403-9266', 4, 1, 1, '../../assets/uploads/profile_pictures/default.png', 'p', '2023-05-15'),
(5, 'Wing', 'Browning', 'male', '1966-09-22', 952556511, 'kawo@gmail.com', '+1 (307) 533-4812', 2, 1, 2, '../../assets/uploads/profile_pictures/default.png', 'k', '2023-05-15'),
(6, 'Rhonda', 'Hoover', 'female', '1973-07-09', 36247854, 'fego@mailinator.com', '+1 (611) 661-1104', 3, 1, 1, '../../assets/uploads/profile_pictures/default.png', 'f', '2023-05-15'),
(19, 'Aaron', 'Simon', 'female', '1973-09-15', 74, 'aaron@gmail.com', '+1 (668) 247-8136', 2, 1, 1, '../../assets/uploads/profile_pictures/default.png', 'a', '2023-05-22'),
(20, 'Jenna', 'Adams', 'female', '2001-08-15', 742, 'adam@gmail.com', '+1 (272) 189-6325', 4, 1, 2, '../../assets/uploads/profile_pictures/default.png', 'a', '2023-05-22'),
(21, 'Odette', 'Schultz', 'male', '1962-12-22', 960, 'odette@gmail.com', '+1 (638) 531-9354', 2, 1, 1, '../../assets/uploads/profile_pictures/default.png', 'o', '2023-05-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `occupation_id` (`occupation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `occupations`
--
ALTER TABLE `occupations`
  ADD CONSTRAINT `occupations_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
