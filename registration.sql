-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 02:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registrationsignup`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `ZipCode` varchar(20) DEFAULT NULL,
  `PreferredCity` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`ID`, `FullName`, `Email`, `Password`, `Age`, `ZipCode`, `PreferredCity`) VALUES
(30, 'MOHIMINUL ISLAM MAHI', '22-78996-3@student.aiub.edu', '$2y$10$yzWdUT.kgoS97blT4ZIDWOpSH5VFpaFQh9RvQNAaHC/JmP/rldkya', 25, '1216', 'dhaka'),
(31, 'MOHIMINUL ISLAM MAHI', '22-49331-3@student.aiub.edu', '$2y$10$OjElpDC.u1t.eMqNAfBZp..0HX4dvkAjzY0XezfFkKvTXqD6DNMU2', 64, '1216', 'dhaka'),
(32, 'Grab It', '22-48799-3@student.aiub.edu', '$2y$10$d55ya0ucbxfZZsMN2cXs0u4sffMbdIxVStjLxsl7mHXw30d6wdb/S', 76, '1216', 'dhaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
