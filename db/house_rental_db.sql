-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 08:16 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `house_rental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adID`, `username`, `password`, `status`) VALUES
(1, 'emmy', 'admin@123', 1),
(2, 'enock', 'admin@123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requesttable`
--

CREATE TABLE `requesttable` (
  `reqID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `houseReference` varchar(20) NOT NULL,
  `statusLandlord` varchar(12) DEFAULT NULL,
  `statusAuthority` varchar(12) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `dateOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requesttable`
--

INSERT INTO `requesttable` (`reqID`, `clientID`, `houseReference`, `statusLandlord`, `statusAuthority`, `status`, `dateOn`) VALUES
(3, 2, '56721416', 'success', 'success', 2, '2022-12-08 16:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `cli_id` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `ID_CardNumber` varchar(17) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateOn` date NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`cli_id`, `fname`, `lname`, `email`, `phone`, `ID_CardNumber`, `password`, `dateOn`, `status`) VALUES
(2, 'muhire', 'alli', 'ndagijimanaenock11@gmail.com', '078398287', '1234567891234567', '$2y$10$ArIrtJGW7JqjlrTLaCPHEeO4L6fJnk9XM8D.Ppth81OgZTE5SESbi', '2022-12-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_house`
--

CREATE TABLE `tbl_house` (
  `hid` int(11) NOT NULL,
  `reference` varchar(15) NOT NULL,
  `houseNumber` varchar(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `district` varchar(20) NOT NULL,
  `sector` varchar(20) NOT NULL,
  `village` varchar(20) NOT NULL,
  `cell` varchar(20) NOT NULL,
  `owner` int(11) NOT NULL,
  `details` longtext NOT NULL,
  `thumbnailPath` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_house`
--

INSERT INTO `tbl_house` (`hid`, `reference`, `houseNumber`, `price`, `district`, `sector`, `village`, `cell`, `owner`, `details`, `thumbnailPath`, `date`, `status`) VALUES
(1, '56721416', 'NH0001', '10', 'Gasabo', 'Rusororo', 'Kabutare', 'Nyagahinga', 1, 'iyi nzu ifite ibyumba 4 na Sallon', 'thurmbnail/IMG-6391b4dac4d248.28414234.jpg', '2022-12-08 11:56:42', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payrequest`
--

CREATE TABLE `tbl_payrequest` (
  `idP` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `houseReference` varchar(12) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `Transactionref` varchar(200) NOT NULL,
  `TransactionIDMoMo` varchar(255) DEFAULT NULL,
  `status` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payrequest`
--

INSERT INTO `tbl_payrequest` (`idP`, `client_ID`, `houseReference`, `phone`, `amount`, `Transactionref`, `TransactionIDMoMo`, `status`, `date`) VALUES
(22, 2, '56721416', '0783982872', '10', '6392201ae502e', NULL, 'pending', '2022-12-08 17:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `uid` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(200) NOT NULL,
  `userType` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`uid`, `fname`, `lname`, `phone`, `email`, `userType`, `password`, `date`, `status`) VALUES
(1, 'emmanuel', 'Maniraguha', '0783385712', 'emmanuelmaniraguhe@gmail.com', 'landlord', '$2y$10$SGMgjdHV5mjGVuL4pV8hmOsVVM2yp6ASLDPYYgHaSF5ndoYF1l4Y6', '2022-12-08', 1),
(2, 'Chantal', 'Ingabire', '0783982872', 'chantalinbabire44@gmail.com', 'authorit', '$2y$10$GOZ6uFm6ZB.J.EHzlhbbaun3hVsv9V2y4DoHkU95u7Cps5m3CFkbC', '2022-12-08', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adID`);

--
-- Indexes for table `requesttable`
--
ALTER TABLE `requesttable`
  ADD PRIMARY KEY (`reqID`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indexes for table `tbl_house`
--
ALTER TABLE `tbl_house`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `tbl_payrequest`
--
ALTER TABLE `tbl_payrequest`
  ADD PRIMARY KEY (`idP`),
  ADD KEY `client_ID` (`client_ID`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requesttable`
--
ALTER TABLE `requesttable`
  MODIFY `reqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_house`
--
ALTER TABLE `tbl_house`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_payrequest`
--
ALTER TABLE `tbl_payrequest`
  MODIFY `idP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_payrequest`
--
ALTER TABLE `tbl_payrequest`
  ADD CONSTRAINT `tbl_payrequest_ibfk_1` FOREIGN KEY (`client_ID`) REFERENCES `tbl_client` (`cli_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
