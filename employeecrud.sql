-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2022 at 08:35 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeecrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `desigID` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedOn` datetime NOT NULL,
  `desigstatus` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`desigID`, `designation`, `createdOn`, `updatedOn`, `desigstatus`) VALUES
(1, 'PHP Developers', '2022-02-05 13:46:28', '2022-02-05 14:57:18', 'Active'),
(2, 'Designers', '2022-02-05 14:18:27', '2022-02-05 14:58:41', 'Active'),
(3, 'gsetset', '2022-02-05 14:23:04', '2022-02-05 14:57:59', 'Deleted'),
(5, 'test', '2022-02-05 18:29:33', '0000-00-00 00:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `empName` varchar(100) NOT NULL,
  `empEmail` varchar(100) NOT NULL,
  `empDesig` int(11) NOT NULL,
  `empPswd` varchar(100) NOT NULL,
  `empStatus` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `empCreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `empUpdatedOn` datetime NOT NULL,
  `empImgName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `empName`, `empEmail`, `empDesig`, `empPswd`, `empStatus`, `empCreatedOn`, `empUpdatedOn`, `empImgName`) VALUES
(1, 'jenin', 'jenin@gmail.com', 1, 'de000753dceed5bc48466206a91ef4ff', 'Inactive', '2022-02-05 18:47:57', '2022-02-05 19:12:25', ''),
(2, 'yequ', 'yesq@dty.com', 2, '4dd905318520885120b281a6cd05df5a', 'Inactive', '2022-02-05 18:50:01', '2022-02-06 07:30:40', ''),
(3, 'Advanced', 'jenins@gmail.com', 2, '82a89964aaa07cbf8782cfd86c76bae4', 'Inactive', '2022-02-05 18:54:16', '2022-02-06 07:26:25', 'nayanthara.jpg'),
(4, 'tet', 'jenivygns@gmail.com', 5, '9b3934a78f28eef86c7ddc64bd8eb867', 'Active', '2022-02-05 18:54:33', '2022-02-06 08:10:58', ''),
(5, 'Premium', 'admin@gmail.com', 5, '99cc1e5717a129eac6ba3e3bfdb60339', 'Inactive', '2022-02-05 18:54:55', '0000-00-00 00:00:00', ''),
(10, 'treesa c s', 'liyatreesacs98@gmail.com', 1, '33154aec1ca154c253f0794ca13313e4', 'Active', '2022-02-06 08:43:20', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`desigID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `desigID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
