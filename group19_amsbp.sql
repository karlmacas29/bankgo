-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 04:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group19_amsbp`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_inq`
--

CREATE TABLE `balance_inq` (
  `bal_id` int(11) NOT NULL,
  `bal_balance` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance_inq`
--

INSERT INTO `balance_inq` (`bal_id`, `bal_balance`, `client_id`) VALUES
(1, 3540, 1),
(3, 999902, 7),
(4, 0, 8),
(5, 825000, 9);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `staff_if` int(11) NOT NULL,
  `card_exp_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `client_firstN` varchar(50) NOT NULL,
  `client_lastN` varchar(50) NOT NULL,
  `client_gender` char(10) NOT NULL,
  `client_bdate` date NOT NULL,
  `client_c_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `card_id`, `client_firstN`, `client_lastN`, `client_gender`, `client_bdate`, `client_c_address`) VALUES
(1, 100, 'Karl', 'Macas', 'Male', '2003-01-29', 'Carmen'),
(7, 104, 'Hello', 'World', 'Male', '2001-01-01', 'Panabo'),
(8, 101, 'John', 'Doe', 'Others', '2001-01-01', 'Panabo'),
(9, 111, 'Glenn Mark', 'Gulay', 'Male', '2001-01-01', 'Panabo');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `client_id` int(11) NOT NULL,
  `dept_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dep_amount` int(11) NOT NULL,
  `rect_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`client_id`, `dept_time`, `dep_amount`, `rect_code`) VALUES
(1, '2023-01-04 02:28:31', 5374, 1),
(7, '2023-01-04 01:04:23', 1000002, 7),
(8, '2023-01-04 01:09:21', 0, 8),
(9, '2023-01-04 02:58:39', 900000, 9);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `wit_code` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rect_code` int(11) NOT NULL,
  `wit_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`wit_code`, `client_id`, `rect_code`, `wit_amount`) VALUES
(1, 1, 1, 3434),
(3, 7, 7, 100),
(4, 8, 8, 0),
(5, 9, 9, 75000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_inq`
--
ALTER TABLE `balance_inq`
  ADD PRIMARY KEY (`bal_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`wit_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_inq`
--
ALTER TABLE `balance_inq`
  MODIFY `bal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `wit_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
