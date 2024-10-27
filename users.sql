-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2024 at 08:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Serial_Number` int(3) NOT NULL,
  `Username` text NOT NULL,
  `Email` varchar(22) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Serial_Number`, `Username`, `Email`, `Password`, `Date`) VALUES
(1, 'avi', 'avi@avii.com', 'isithashed?', '2024-10-28 00:19:42'),
(2, 'dummy', 'dummy@dum.com', '$2y$10$03UfId0WeGLi5N31O7qWp.J1uBzpBN6D9ng2D240286/mvV6Kh1Yy', '2024-10-28 00:20:52'),
(3, 'vidit', 'vidit@vidit.com', '$2y$10$T07V10PoibrVe7SQilQ28Od8/OLM/mev0cF2qCVU.hAwrz39Oki5G', '2024-10-28 00:30:58'),
(4, 'test1', 'test@t1', 'nothashed', '2024-10-28 01:12:00'),
(5, 'saxena', 'saxena@ok.com', '$2y$10$SrgN3LqwrurVrKdiSS6AkuprQdSTUf.0xh53TV7cA0UimxZMV6X1G', '2024-10-28 01:06:55'),
(6, 'test2', 'test@t2', 'nothashed', '2024-10-28 01:12:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Serial_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Serial_Number` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
