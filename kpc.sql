-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 08:01 AM
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
-- Database: `kpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `created_by`, `active`, `updated_at`, `updated_by`) VALUES
(1, 'Careers Department', '2024-08-23 17:47:32', 3, 1, '2024-08-23 17:47:32', NULL),
(2, 'Tenders Department', '2024-08-23 17:48:37', 3, 1, '2024-08-23 17:48:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `education_levels`
--

CREATE TABLE `education_levels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_levels`
--

INSERT INTO `education_levels` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Masters', 4, '2024-08-25 07:59:17', 4, '2024-08-25 07:59:17'),
(2, 'Undergraduate', 4, '2024-08-25 08:27:02', 4, '2024-08-25 08:27:02'),
(3, 'Post Diploma', 4, '2024-08-25 08:27:25', 4, '2024-08-25 08:59:47'),
(4, 'Certificate', 4, '2024-08-25 08:27:37', 4, '2024-08-25 08:27:37'),
(6, 'High School', 4, '2024-08-25 09:04:20', 4, '2024-08-25 09:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `access_lvl` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `access_lvl`, `created_at`, `password`, `department_id`, `updated_at`, `active`) VALUES
(1, 'Nelson', 'NELSON MUKULE MASIBO', 'nelsonmasibo6@gmail.com', 1, '2024-08-23 07:57:05', '$2y$10$tx7bvnJOS8vgk0tF6NudcerZa6Wzs3zT4ydyCWjQzT7XbROnjQNxS', NULL, '2024-08-24 10:04:05', 0),
(2, 'Masibo', 'NELSON MUKULE MASIBO', 'nelson.masibo@kenyawebsolutions.com', 2, '2024-08-23 09:19:08', '$2y$10$HSXZUMbrlhEochK7WX6XGuNtmMFyEhC4Dz9FxV.ki/mFEehK.FL/i', NULL, '2024-08-24 10:01:01', 1),
(3, 'Maish', 'DAVID KIAMA', 'david.kiamaa@gmail.com', 1, '2024-08-23 15:33:22', '$2y$10$CXSGjkBfJDFOMzByLJeKPe/hyfFtLOchf8phOSKzyGicYViQ6YAcS', NULL, '2024-08-24 10:00:54', 0),
(4, 'Neilah', 'Neilah Masibo', 'neilahmasibo@gmail.com', 1, '2024-08-23 18:55:30', '$2y$10$PUFtGviH3eQ86D5zoyypxu8OqQuM2Pw7d0ZgAWV7czkv983Jqitqe', 2, '2024-08-23 18:55:30', 1),
(5, 'Wilkister', 'Wilkister Ogonyo', 'wilkisterogonyo1@gmail.com', 3, '2024-08-23 18:57:42', '$2y$10$z1GNzVnnX1aZl5h4/we.mOqnhDlNw36jlqsZsh9QG14JrjiYwyNY6', 1, '2024-08-24 15:17:56', 1),
(6, 'shynat', 'dennis nganga', 'shynat@gmail.com', 3, '2024-08-24 15:12:31', '$2y$10$N0UA2Lo4BL15K71HSoIxW.nBHdE222sLxDI1AGrPD.Oh8K.kO5zxm', 2, '2024-08-24 15:20:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `vac_function` int(11) NOT NULL,
  `open_date` datetime NOT NULL,
  `close_date` datetime NOT NULL,
  `min_educational_level` int(11) NOT NULL,
  `min_work_experience` int(11) NOT NULL,
  `vac_type` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vac_function`
--

CREATE TABLE `vac_function` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vac_type`
--

CREATE TABLE `vac_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_created_by` (`created_by`),
  ADD KEY `fk_updated_by` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vac_function` (`vac_function`),
  ADD KEY `min_educational_level` (`min_educational_level`),
  ADD KEY `vac_type` (`vac_type`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `vac_function`
--
ALTER TABLE `vac_function`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `vac_type`
--
ALTER TABLE `vac_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vac_type_created_by` (`created_by`),
  ADD KEY `fk_vac_type_updated_by` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `education_levels`
--
ALTER TABLE `education_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vac_function`
--
ALTER TABLE `vac_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vac_type`
--
ALTER TABLE `vac_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `vacancy_ibfk_1` FOREIGN KEY (`vac_function`) REFERENCES `vac_function` (`id`),
  ADD CONSTRAINT `vacancy_ibfk_2` FOREIGN KEY (`min_educational_level`) REFERENCES `education_levels` (`id`),
  ADD CONSTRAINT `vacancy_ibfk_3` FOREIGN KEY (`vac_type`) REFERENCES `vac_type` (`id`),
  ADD CONSTRAINT `vacancy_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vacancy_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `vac_function`
--
ALTER TABLE `vac_function`
  ADD CONSTRAINT `vac_function_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vac_function_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `vac_type`
--
ALTER TABLE `vac_type`
  ADD CONSTRAINT `fk_vac_type_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_vac_type_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
