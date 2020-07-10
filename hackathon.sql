-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 08:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_info`
--

CREATE TABLE `bill_info` (
  `bill_id` int(11) NOT NULL,
  `so_name` varchar(64) NOT NULL,
  `so_companyname` varchar(64) NOT NULL,
  `who_name` varchar(16) NOT NULL,
  `product_name` varchar(16) NOT NULL,
  `quantity` int(16) NOT NULL,
  `cost` int(16) NOT NULL,
  `date_of_loading` date NOT NULL,
  `date_of_departing` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `p_id` int(11) NOT NULL,
  `who_email` varchar(32) NOT NULL,
  `so_companyname` varchar(64) NOT NULL,
  `p_name` int(16) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size_of_product` int(11) NOT NULL,
  `date_of_loading` date NOT NULL,
  `date_of_departing` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `so_info`
--

CREATE TABLE `so_info` (
  `who_email` varchar(32) NOT NULL,
  `so_email` varchar(32) NOT NULL,
  `so_name` varchar(16) NOT NULL,
  `so_contact` varchar(16) NOT NULL,
  `so_companyname` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `who_info`
--

CREATE TABLE `who_info` (
  `who_email` varchar(32) NOT NULL,
  `who_name` varchar(64) NOT NULL,
  `who_contact` varchar(10) NOT NULL,
  `who_password` varchar(32) NOT NULL,
  `wh_address` text NOT NULL,
  `wh_size` int(16) NOT NULL,
  `cost_per_m3` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_info`
--
ALTER TABLE `bill_info`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `who_email` (`who_email`);

--
-- Indexes for table `so_info`
--
ALTER TABLE `so_info`
  ADD KEY `who_email` (`who_email`);

--
-- Indexes for table `who_info`
--
ALTER TABLE `who_info`
  ADD PRIMARY KEY (`who_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_info`
--
ALTER TABLE `bill_info`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_info`
--
ALTER TABLE `product_info`
  ADD CONSTRAINT `product_info_ibfk_1` FOREIGN KEY (`who_email`) REFERENCES `who_info` (`who_email`);

--
-- Constraints for table `so_info`
--
ALTER TABLE `so_info`
  ADD CONSTRAINT `so_info_ibfk_1` FOREIGN KEY (`who_email`) REFERENCES `who_info` (`who_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
