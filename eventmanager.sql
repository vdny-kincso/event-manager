-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 11:39 PM
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
-- Database: `eventmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `organizer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start_date`, `end_date`, `hero_image`, `organizer_id`) VALUES
(1, 'database', 'learn database in sql', '2026-01-11', '2026-01-17', NULL, 1),
(2, 'Programming ', 'Learn with us to programm', '2026-02-02', '2026-02-07', NULL, 2),
(8, 'C++', 'C++ is fun', '2026-02-03', '2026-02-13', '1769904056_Screenshot 2024-10-27 165617.png', 2),
(9, 'Terminal', 'learn to use Terminal and debug', '2026-02-09', '2026-02-27', '1769904459_Screenshot 2024-11-25 091201.png', 2),
(23, 'wwwww', '', '2026-02-03', '2026-02-07', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `user_id`, `event_id`, `created_at`) VALUES
(7, 2, 1, '2026-01-31 23:32:50'),
(8, 2, 23, '2026-02-04 17:12:07'),
(19, 6, 1, '2026-02-04 17:24:00'),
(20, 6, 2, '2026-02-04 17:24:05'),
(24, 6, 23, '2026-02-04 19:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `created_at`) VALUES
(1, 'ana@ana', '$2y$10$I/7yPMeQTZWQLjmBQvdeRuLHAuhlNyAA4Y/x0Ut3V06Y4kHCTGEg6', 'ana', '2026-01-30 23:49:11'),
(2, 'adam@adam', '$2y$10$QLW52.K3LwUS65mkNPKe..QVXZDU6hhBfhV1GdbVim9b6Tz7pB74y', 'adam', '2026-01-30 23:52:06'),
(4, 'elod@elod', '$2y$10$SP6JSRh7RuzKgTylbSSPpu1eMnxPT5DwMfRyuwCPrbSXoS9iU/KR.', 'elod', '2026-02-02 20:31:51'),
(6, 'ana@anaaa', '$2y$10$7L.9bKfFSGu4f9T0PB3Kr.Aa/bPie.EzZImS1LWt3F4arjXiOGFDO', 'ana', '2026-02-04 17:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`id`, `event_id`, `title`, `start_time`, `end_time`) VALUES
(1, 2, 'Code', '2026-02-04 01:43:00', '2026-02-06 01:41:00'),
(9, 23, 'aaa', '2026-02-03 00:00:00', '2026-02-03 00:00:00'),
(10, 23, 'yeeess', '2026-02-03 00:00:00', '2026-02-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_registrations`
--

CREATE TABLE `workshop_registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop_registrations`
--

INSERT INTO `workshop_registrations` (`id`, `user_id`, `workshop_id`, `created_at`) VALUES
(6, 6, 1, '2026-02-04 17:47:44'),
(7, 6, 9, '2026-02-04 19:49:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_registration` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `workshop_registrations`
--
ALTER TABLE `workshop_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`workshop_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `workshop_registrations`
--
ALTER TABLE `workshop_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workshop_registrations`
--
ALTER TABLE `workshop_registrations`
  ADD CONSTRAINT `workshop_registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `workshop_registrations_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
