-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 06:36 PM
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
-- Database: `roomallocate`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `roomno` varchar(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `email`, `roomno`, `month`, `year`, `amount_paid`, `balance`, `date`) VALUES
(1, 'Kalungi', 'rk@gmail.com', 'A4', 'October', 2023, 200000, 400000, '0000-00-00'),
(2, 'Kalungi', 'rk@gmail.com', 'A4', 'October', 2023, 200000, 200000, '0000-00-00'),
(3, 'Kalungi', 'rk@gmail.com', 'A4', 'October', 2023, 200000, 0, '0000-00-00'),
(4, 'Kalungi', 'rk@gmail.com', 'A4', 'January', 2023, 200000, 400000, '0000-00-00'),
(5, 'Kalungi', 'rk@gmail.com', 'A4', 'February', 2023, 200000, 400000, '0000-00-00'),
(7, 'Kalungi', 'rk@gmail.com', 'A4', 'January', 2023, 200000, 0, '23-10-29'),
(8, 'Kalungi', 'rk@gmail.com', 'A4', 'March', 2023, 200000, 400000, '23-11-29'),
(9, 'Kalungi', 'rk@gmail.com', 'A4', 'March', 2023, 200000, 200000, '23-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `roomno` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `own` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomno`, `status`, `descr`, `own`) VALUES
(2, 'A2', 'active', 'dsfjhdskjklslkjkds', 'booked'),
(3, 'A3', 'active', 'mxcmxfjkfdjkfkfjdkfwr', 'Not booked'),
(4, 'A4', 'active', 'dsgfdghg', 'Not booked'),
(5, 'A5', 'active', 'fdshfdfdfdd', 'Not booked'),
(7, 'A6', 'active', 'mxcmxfjkfdjkfkfjdk', 'booked'),
(9, 'A7', 'active', 'mxcmxfjkfdjkfkfjdk', 'Not booked');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(14) NOT NULL,
  `roomno` varchar(10) NOT NULL,
  `university` varchar(30) NOT NULL,
  `entrydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phonenumber`, `roomno`, `university`, `entrydate`) VALUES
(6, 'Kalungi', 'rk@gmail.com', '0703696380', 'A4', 'Muteesa', '2023-10-05'),
(7, 'Rashid', 'rk1@gmail.com', '0742477971', 'A6', 'Muteesa', '2023-10-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roomno` (`roomno`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
