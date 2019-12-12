-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2019 at 08:36 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rating` int(11) DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `batch_id`, `date`, `rating`, `review`, `notes`, `approved`, `status`) VALUES
(1, 9, 2, '2019-05-17 18:00:00', 4, 'jshdfjsdlkfds;km', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_limit` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `code`, `title`, `description`, `class_limit`, `trainer_id`, `course_id`, `status`) VALUES
(1, '254', 'morning shift', 'this is morning shift batch ', 20, 8, 3, 1),
(2, '254', 'morning shift', 'this is morning shift batch ', 20, 9, 3, 1),
(3, '254', 'morning shift', 'this is morning shift batch ', 20, 7, 3, 1),
(4, '254', 'morning shift', 'this is morning shift batch ', 1, 7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_class` int(11) NOT NULL,
  `duration` float NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `title`, `description`, `number_of_class`, `duration`, `status`) VALUES
(1, '1010', 'PHP Course', 'Hello Hello Hello Hello                                     ', 20, 40, 1),
(3, 'DWKS', 'Marathon  Engine Systems logo', 'hello', 32, 120, 1),
(4, 'DWKSzxcsdfgdgd', 'Marathon', '                                                            hello                  sfdsadfsdf                                    ', 20, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notice_type_id` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `finish_at` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `created_by`, `notice_type_id`, `title`, `description`, `batch_id`, `start_at`, `finish_at`, `status`) VALUES
(1, 6, 1, 'this is important', 'ththis is importantthis is importantthis is importantthis is important', 2, '2019-05-08 05:07:56', '2019-12-22 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices_types`
--

CREATE TABLE `notices_types` (
  `id` int(11) NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bootstrap_class` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'primary',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices_types`
--

INSERT INTO `notices_types` (`id`, `title`, `description`, `bootstrap_class`, `status`) VALUES
(1, 'Important', NULL, 'info', 1),
(2, 'Warning', NULL, 'warning', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `status`) VALUES
(1, 'Management', 1),
(2, 'Trainer', 1),
(3, 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `image`, `email`, `msisdn`, `password`, `status`) VALUES
(6, 1, 'Md. Shahajahan Ali', 'http://localhost/attendance/uploads/users/photos/15581856446.GIF', 'msacse1@gmail.com', '01681692786', '25d55ad283aa400af464c76d713c07ad', 1),
(7, 3, 'roven kha', 'http://localhost/attendance/uploads/users/photos/15581866877.jpg', 'ashah3562@gmail.com', '01833825028', 'e10adc3949ba59abbe56e057f20f883e', 1),
(8, 2, 'Yousuf Mahmud', '', 'fahim@gmail.com', '01833825028', 'e10adc3949ba59abbe56e057f20f883e', 1),
(9, 2, 'murad', '', 'murad@gmail.com', '01833825028', 'e10adc3949ba59abbe56e057f20f883e', 1),
(10, 3, 'bappi hossen', '', 'bappi@gmail.com', '1858787907', 'e10adc3949ba59abbe56e057f20f883e', 0),
(14, 3, 'sdfsadfsdf', '', 'sdfsdfsd@sfsadds.com', '01681692786', 'e10adc3949ba59abbe56e057f20f883e', 1),
(15, 2, 'Bappi dsdf', 'http://localhost/attendance/uploads/users/photos/1558187021.', 'bappi_ifci@yahoo.com', '0168169278645', 'e10adc3949ba59abbe56e057f20f883e', 1),
(16, 2, 'sfdsfsd', 'http://localhost/attendance/uploads/users/photos/no_image.png', 'bappi_ifci@yahoo.comd', '01681692786', '96e79218965eb72c92a549dd5a330112', 1),
(17, 1, 'Bappi sdsfssdfdsf', 'http://localhost/attendance/uploads/users/photos/155818770817.jpg', 'bappi_ifci@yahoo.comss', '01681692786', '96e79218965eb72c92a549dd5a330112', 1),
(18, 3, 'Md. Shahajahan Ali', '', 'shahajahan@gmail.com', 'shahajahan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_batch`
--

CREATE TABLE `user_batch` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `own_rating` int(1) DEFAULT NULL,
  `own_review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `got_rating` int(11) DEFAULT NULL,
  `got_review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_batch`
--

INSERT INTO `user_batch` (`id`, `user_id`, `batch_id`, `own_rating`, `own_review`, `got_rating`, `got_review`, `status`) VALUES
(11, 7, 2, NULL, NULL, NULL, NULL, 1),
(12, 7, 4, 3, 'dgfgdfgdgfd', NULL, NULL, 1),
(27, 10, 1, NULL, NULL, NULL, NULL, 1),
(28, 10, 2, NULL, NULL, NULL, NULL, 1),
(29, 10, 3, NULL, NULL, NULL, NULL, 1),
(30, 10, 4, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_fk0` (`user_id`),
  ADD KEY `attendances_fk1` (`batch_id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batches_fk0` (`trainer_id`),
  ADD KEY `batches_fk1` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_fk0` (`created_by`),
  ADD KEY `notices_fk1` (`notice_type_id`),
  ADD KEY `notices_fk2` (`batch_id`);

--
-- Indexes for table `notices_types`
--
ALTER TABLE `notices_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_fk0` (`role_id`);

--
-- Indexes for table `user_batch`
--
ALTER TABLE `user_batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_batch_fk0` (`user_id`),
  ADD KEY `user_batch_fk1` (`batch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notices_types`
--
ALTER TABLE `notices_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_batch`
--
ALTER TABLE `user_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attendances_fk1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`);

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_fk0` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `batches_fk1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notices_fk1` FOREIGN KEY (`notice_type_id`) REFERENCES `notices_types` (`id`),
  ADD CONSTRAINT `notices_fk2` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_batch`
--
ALTER TABLE `user_batch`
  ADD CONSTRAINT `user_batch_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_batch_fk1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
