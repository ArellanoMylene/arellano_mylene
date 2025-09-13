-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2025 at 11:16 AM
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
-- Database: `mockdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `created_at`, `updated_at`) VALUES
(2, 'Mylene', 'Arellano', 'mylene12289@gmail.com', '2025-08-22 08:23:18', '2025-09-02 05:45:57'),
(6, 'Nitchel Paula', 'Acosta', 'acosta1234@gmail.com', '2025-08-28 22:06:52', '2025-08-28 22:06:52'),
(7, 'Vincent', 'Acha', 'acha1278@gmail.com', '2025-09-01 21:35:59', '2025-09-01 21:35:59'),
(8, 'Judith', 'Fajardo', 'fajardo1112@gmail.com', '2025-09-01 21:36:24', '2025-09-01 21:36:24'),
(9, 'Joana Ruth', 'Canunigo', 'joana222@gmail.com', '2025-09-01 21:36:53', '2025-09-01 21:36:53'),
(10, 'Renz Idol', 'Agamata', 'agamata555@gmail.com', '2025-09-01 21:37:13', '2025-09-01 21:37:13'),
(11, 'Brenda Joy', 'Rioganes', 'rioganes333@gmail.com', '2025-09-01 21:38:22', '2025-09-01 21:38:22'),
(13, 'Mica ', 'Palpallatoc', 'mica123@gmail.com', '2025-09-02 00:58:18', '2025-09-02 00:58:18');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
