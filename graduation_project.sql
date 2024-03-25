-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2023 at 06:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graduation_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cpu` int(100) NOT NULL,
  `RAM` int(100) NOT NULL,
  `hard_disk` int(100) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `cpu`, `RAM`, `hard_disk`, `price`) VALUES
(1, 'Instance tiny', 1, 512, 1, 20),
(2, 'Instance small', 1, 2048, 20, 40),
(3, 'Instance medium', 2, 4096, 40, 60),
(4, 'Firewall', 4, 2048, 5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'malak', 'malak@malak', '123'),
(2, 'sally', 'sally@sally', '123'),
(3, 'sara', 'sara@sara', '123'),
(4, 'muhammed', 'mohamed.elgenddyy@gmail.com', '123'),
(5, 'omar', 'omar@omar', '345'),
(9, 'admin', 'admin@admin', 'htjpdhslsl');

-- --------------------------------------------------------

--
-- Table structure for table `users_firewall`
--

CREATE TABLE `users_firewall` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_firewall`
--

INSERT INTO `users_firewall` (`id`, `user_id`, `ip`) VALUES
(1, 9, '192.168.0.137');

-- --------------------------------------------------------

--
-- Table structure for table `users_services`
--

CREATE TABLE `users_services` (
  `user_id` int(100) NOT NULL,
  `service_id` int(100) NOT NULL,
  `instance_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_firewall`
--
ALTER TABLE `users_firewall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_services`
--
ALTER TABLE `users_services`
  ADD PRIMARY KEY (`user_id`,`service_id`,`instance_id`),
  ADD KEY `id_service` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_firewall`
--
ALTER TABLE `users_firewall`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_firewall`
--
ALTER TABLE `users_firewall`
  ADD CONSTRAINT `users_firewall_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_services`
--
ALTER TABLE `users_services`
  ADD CONSTRAINT `users_services_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `users_services_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
