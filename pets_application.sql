-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2024 at 04:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pets_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_sex` enum('Male','Female') NOT NULL,
  `pet_age` int(11) DEFAULT NULL,
  `pet_weight` float DEFAULT NULL,
  `pet_color` varchar(100) DEFAULT NULL,
  `neutering_status` enum('Intact','Neutered') NOT NULL,
  `microchip` varchar(255) DEFAULT NULL,
  `passed_away` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_name`, `pet_breed`, `pet_sex`, `pet_age`, `pet_weight`, `pet_color`, `neutering_status`, `microchip`, `passed_away`, `notes`, `created_at`, `user_id`) VALUES
(1, 'dog', 'hello', 'Male', 15, 10, 'white', 'Intact', '', 1, '', '2024-10-03 11:25:50', NULL),
(2, 'dog', 'hello', 'Male', 15, 10, 'white', 'Intact', 'yes', 1, 'swasdsd', '2024-10-03 13:36:03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `repeated_times` int(11) DEFAULT 1,
  `repeat_interval` varchar(50) NOT NULL,
  `ends` date DEFAULT NULL,
  `notification` tinyint(1) DEFAULT 0,
  `notification_time` int(11) DEFAULT 10,
  `notification_unit` varchar(20) DEFAULT 'minutes',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `category`, `date`, `time`, `repeated_times`, `repeat_interval`, `ends`, `notification`, `notification_time`, `notification_unit`, `notes`) VALUES
(1, '', '2024-10-02', '12:24:00', 1, 'day', '2024-10-04', 1, 0, 'minutes', 'ddd'),
(2, '', '0000-00-00', '00:00:00', 1, 'day', '0000-00-00', 0, 0, 'minutes', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'Dipak', 'Borase', 'borasedipak@gmail.com', '$2y$10$1A6PZaL93dwR7QiTE.w84OxTYLpb4NJoj8NbZbAsyPHsH2fUVbtYG', '2024-09-21 13:00:46'),
(2, 'dipak', 'borase', 'damahe_parti@gmail.com', '$2y$10$p38DMvHnv7TxFaEMaCDwi.gaXhpAvyuiCM.uK03K3rNoRahO1Xkk2', '2024-10-02 12:08:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
