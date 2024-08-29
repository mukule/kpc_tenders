-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 05:03 PM
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
-- Database: `kpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `awarded_contracts`
--

CREATE TABLE `awarded_contracts` (
  `id` int(11) NOT NULL,
  `ref_num` varchar(255) NOT NULL,
  `cont_details` text NOT NULL,
  `pro_method` varchar(255) NOT NULL,
  `cont_cat` varchar(255) NOT NULL,
  `supp_name` varchar(255) NOT NULL,
  `cont_value` decimal(15,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awarded_contracts`
--

INSERT INTO `awarded_contracts` (`id`, `ref_num`, `cont_details`, `pro_method`, `cont_cat`, `supp_name`, `cont_value`, `start_date`, `end_date`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'KPC/tender/001', 'rttryt', 'RFQ', 'YOUTH', 'rerrre', 565445.00, '2024-08-30 18:23:00', '2024-09-06 15:43:00', '2024-08-29 09:28:23', '2024-08-29 09:43:58', 4, 4),
(2, 'KPC/tender/002', 'dfgfd', 'RESTRICTED', 'YOUTH', 'Nelson Masibo', 1000.00, '2024-08-30 15:32:00', '0000-00-00 00:00:00', '2024-08-29 09:32:38', '2024-08-29 09:32:38', 4, 4);

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
-- Table structure for table `doc_types`
--

CREATE TABLE `doc_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_types`
--

INSERT INTO `doc_types` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Tender document', 4, '2024-08-26 10:20:17', '2024-08-26 10:20:17', 4),
(2, 'ADDENDUMs', 4, '2024-08-26 10:21:14', '2024-08-26 10:25:15', 4),
(3, 'CLARIFICATIONS', 4, '2024-08-26 10:25:36', '2024-08-26 10:25:36', 4),
(4, 'DRAWINGS', 4, '2024-08-26 10:25:47', '2024-08-26 10:25:47', 4);

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
-- Table structure for table `eligibility`
--

CREATE TABLE `eligibility` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eligibility`
--

INSERT INTO `eligibility` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Internationals', 4, '2024-08-26 09:47:53', '2024-08-26 09:52:29', 4),
(2, 'National', 4, '2024-08-26 09:53:11', '2024-08-26 09:53:11', 4),
(3, 'Women', 4, '2024-08-26 09:53:18', '2024-08-26 09:53:18', 4),
(4, 'Youth', 4, '2024-08-26 09:53:24', '2024-08-26 09:53:24', 4),
(7, 'PWD', 4, '2024-08-26 09:57:23', '2024-08-26 09:57:23', 4);

-- --------------------------------------------------------

--
-- Table structure for table `procurement_plans`
--

CREATE TABLE `procurement_plans` (
  `id` int(11) NOT NULL,
  `type_of_procurement_plan` text NOT NULL,
  `goods_desc` text NOT NULL,
  `units` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `pro_methods` varchar(20) NOT NULL,
  `agpo_category` varchar(20) NOT NULL,
  `section` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `procurement_plans`
--

INSERT INTO `procurement_plans` (`id`, `type_of_procurement_plan`, `goods_desc`, `units`, `quantity`, `pro_methods`, `agpo_category`, `section`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Capital', 'cvdvbvd', 'LS', '5cvvvv', 'OPEN(NATIONAL)', 'ALL', 'Projects', 4, 4, '2024-08-29 11:24:30', '2024-08-29 11:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ref_number` varchar(100) NOT NULL,
  `start_date` datetime NOT NULL,
  `close_date` datetime NOT NULL,
  `document_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`document_types`)),
  `site_visit_details1` text DEFAULT NULL,
  `site_visit_details2` text DEFAULT NULL,
  `eligibility` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `name`, `ref_number`, `start_date`, `close_date`, `document_types`, `site_visit_details1`, `site_visit_details2`, `eligibility`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Website Design', 'kpc/tenders/001', '2024-08-29 12:57:00', '2024-09-06 12:58:00', '[\"1\",\"2\",\"3\",\"4\"]', 'ddwsdds', 'sddsdss', '2', 4, 4, '2024-08-28 06:58:11', '2024-08-28 09:00:29'),
(2, 'Website Design', 'kpc/tenders/002', '2024-08-27 13:15:00', '2024-08-30 13:15:00', '[\"1\",\"2\",\"3\",\"4\"]', 'vbdfbfed', 'fdfgfd', '3', 4, 4, '2024-08-28 07:15:56', '2024-08-28 07:15:56'),
(3, 'Website Design', 'kpc/tenders/003', '2024-08-29 13:25:00', '2024-08-31 13:25:00', '[\"1\",\"2\",\"3\"]', 'fdfd', 'dffd', '3', 4, 4, '2024-08-28 07:25:58', '2024-08-28 07:25:58'),
(4, 'Website Design', 'kpc/tenders/004', '2024-08-29 13:27:00', '2024-09-05 13:27:00', '[\"1\",\"2\",\"3\",\"4\"]', 'seeewe', 'rdfss', '7', 4, 4, '2024-08-28 07:27:32', '2024-08-28 07:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `tender_documents`
--

CREATE TABLE `tender_documents` (
  `id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `doc_type_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tender_documents`
--

INSERT INTO `tender_documents` (`id`, `tender_id`, `doc_type_id`, `document_name`, `file`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 'Tender document', 'uploads/tender_documents/1724912480_7badb3a53ec0b18177b0.pdf', '2024-08-29 03:21:20', '2024-08-29 06:30:10', 4, 4),
(3, 1, 2, 'Addedum', 'uploads/tender_documents/1724913968_894f4200f41965b21165.pdf', '2024-08-29 03:46:08', '2024-08-29 08:17:06', 4, 0),
(4, 1, 3, 'clarification doc', 'uploads/tender_documents/1724920041_902e7108a4641972bbff.pdf', '2024-08-29 05:27:21', '2024-08-29 08:28:13', 4, 0),
(5, 1, 4, 'Drawing doc', 'tender_documents/1724920358_33b1d684815f0132ac2e.pdf', '2024-08-29 05:32:38', '2024-08-29 05:32:38', 4, 0),
(6, 1, 4, 'drawing doc2', 'uploads/tender_documents/1724920508_ec31c49fc9777359deb3.pdf', '2024-08-29 05:35:08', '2024-08-29 05:35:08', 4, 0),
(7, 4, 1, 'tender doc', 'uploads/tender_documents/1724920562_a49b6eed86872f824b16.pdf', '2024-08-29 05:36:02', '2024-08-29 05:36:02', 4, 0),
(8, 4, 4, 'Drawing doc', 'uploads/tender_documents/1724921108_51217ad85b478ec7636f.pdf', '2024-08-29 05:45:08', '2024-08-29 05:45:08', 4, 0);

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

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `title`, `ref`, `vac_function`, `open_date`, `close_date`, `min_educational_level`, `min_work_experience`, `vac_type`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Web developer', 'kpc/ict/1', 1, '2024-08-12 11:58:00', '2024-08-27 11:58:00', 1, 0, 1, '2024-08-26 08:58:37', 4, '2024-08-26 08:58:37', 4),
(2, 'Server Admin', 'kpc/ict/2', 1, '2024-08-06 12:14:00', '2024-08-22 12:14:00', 3, 0, 2, '2024-08-26 09:14:19', 4, '2024-08-26 09:14:19', 4),
(3, 'Server admin', 'kpc/ict/3', 1, '2024-08-27 12:47:00', '2024-08-29 12:47:00', 1, 0, 1, '2024-08-26 09:48:09', 5, '2024-08-26 10:29:48', 4);

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

--
-- Dumping data for table `vac_function`
--

INSERT INTO `vac_function` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'ICT', 4, '2024-08-26 06:39:01', 4, '2024-08-26 06:39:01'),
(2, 'Finance', 4, '2024-08-26 06:41:53', 4, '2024-08-26 06:41:53'),
(4, 'Procurement & Supplies Management, Business Administration', 4, '2024-08-26 06:45:20', 4, '2024-08-26 06:45:20'),
(5, 'Procurement & Supplies Management, Business Administration', 4, '2024-08-26 06:45:46', 4, '2024-08-26 06:45:46'),
(6, 'Networks adminstrator', 4, '2024-08-26 06:47:25', 4, '2024-08-26 07:04:35');

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
-- Dumping data for table `vac_type`
--

INSERT INTO `vac_type` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Career', 4, '2024-08-26 08:03:36', 4, '2024-08-26 08:17:55'),
(2, 'Interships', 4, '2024-08-26 08:19:11', 4, '2024-08-26 08:22:22'),
(3, 'Attachment', 4, '2024-08-26 08:19:20', 4, '2024-08-26 08:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awarded_contracts`
--
ALTER TABLE `awarded_contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `doc_types`
--
ALTER TABLE `doc_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_created_by` (`created_by`),
  ADD KEY `fk_updated_by` (`updated_by`);

--
-- Indexes for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `procurement_plans`
--
ALTER TABLE `procurement_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_documents`
--
ALTER TABLE `tender_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_id` (`tender_id`),
  ADD KEY `doc_type_id` (`doc_type_id`);

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
-- AUTO_INCREMENT for table `awarded_contracts`
--
ALTER TABLE `awarded_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doc_types`
--
ALTER TABLE `doc_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `education_levels`
--
ALTER TABLE `education_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eligibility`
--
ALTER TABLE `eligibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `procurement_plans`
--
ALTER TABLE `procurement_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tender_documents`
--
ALTER TABLE `tender_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vac_function`
--
ALTER TABLE `vac_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vac_type`
--
ALTER TABLE `vac_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awarded_contracts`
--
ALTER TABLE `awarded_contracts`
  ADD CONSTRAINT `awarded_contracts_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `awarded_contracts_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `doc_types`
--
ALTER TABLE `doc_types`
  ADD CONSTRAINT `doc_types_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `doc_types_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD CONSTRAINT `eligibility_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `eligibility_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `procurement_plans`
--
ALTER TABLE `procurement_plans`
  ADD CONSTRAINT `procurement_plans_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `procurement_plans_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `tender_documents`
--
ALTER TABLE `tender_documents`
  ADD CONSTRAINT `tender_documents_ibfk_1` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tender_documents_ibfk_2` FOREIGN KEY (`doc_type_id`) REFERENCES `doc_types` (`id`) ON DELETE CASCADE;

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
