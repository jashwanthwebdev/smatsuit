CODEIGNITER REST API'S



MYSQL DATABASE
---------------------------------------------------------------------------------------------------------

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 04:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smatbotcontact`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_tb`
--

CREATE TABLE `contact_tb` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `data_store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_tb`
--

INSERT INTO `contact_tb` (`contact_id`, `first_name`, `last_name`, `email`, `mobile_number`, `data_store`) VALUES
(2, 'Jashwanth', 'Kumar', 'aervajashwanth@yahoo.com', '8121244826', 'hyd'),
(4, 'Jashwanth', 'Kumar', 'aervajashwanth@gmail.com', '9032771453', 'Hyderabad'),
(6, 'Jashwanth', 'kumar', 'aervajashwanth@gmail.com', '9032771453', 'hyderabad'),
(7, 'Jashwanth Kumar', 'kumar', 'aervajashwanth@gmail.com', '9032771453', 'hyderabad'),
(8, 'AVN', 'kumar', 'aervajashwanth@yahoo.com', '8121244826', 'Sec');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_tb`
--
ALTER TABLE `contact_tb`
  ADD PRIMARY KEY (`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_tb`
--
ALTER TABLE `contact_tb`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
