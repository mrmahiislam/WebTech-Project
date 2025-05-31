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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `aqi` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country`, `aqi`, `status`) VALUES
(1, 'Dhaka', 'Bangladesh', 180, 'Unhealthy'),
(2, 'New York City', 'USA', 61, 'Moderate'),
(3, 'London', 'UK', 32, 'Good'),
(4, 'Tokyo', 'Japan', 22, 'Good'),
(5, 'Beijing', 'China', 113, 'Unhealthy for Sensitive Groups'),
(6, 'Delhi', 'India', 124, 'Unhealthy for Sensitive Groups'),
(7, 'Paris', 'France', 32, 'Good'),
(8, 'Los Angeles', 'USA', 64, 'Moderate'),
(9, 'Cairo', 'Egypt', 150, 'Unhealthy'),
(10, 'Mexico City', 'Mexico', 80, 'Moderate'),
(11, 'Moscow', 'Russia', 60, 'Moderate'),
(12, 'Jakarta', 'Indonesia', 90, 'Moderate'),
(13, 'Istanbul', 'Turkey', 75, 'Moderate'),
(14, 'Bangkok', 'Thailand', 160, 'Unhealthy'),
(15, 'Seoul', 'South Korea', 70, 'Moderate'),
(16, 'São Paulo', 'Brazil', 85, 'Moderate'),
(17, 'Nairobi', 'Kenya', 55, 'Moderate'),
(18, 'Sydney', 'Australia', 30, 'Good'),
(19, 'Toronto', 'Canada', 40, 'Good'),
(20, 'Berlin', 'Germany', 45, 'Good'),
(21, 'Barcelona', 'Spain', 42, 'Good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
