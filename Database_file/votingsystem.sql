-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 09:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `result_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `result_date`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin123', '2021-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `candidate` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `candidate`, `city`, `description`, `logo`) VALUES
(1, 'PTI', 'Imran Khan', 'Islamabad', 'A party to equalize the justice for all. To change the country.', 'pti.jpg'),
(2, 'PMLN', 'Nawaz sharef', 'Lahore', 'A party to give honor to the voters all. To change the country from devasting situation.', 'pmln.jpg'),
(3, 'PPP', 'Bilwal', 'Karachi', 'Enter Party Description goes here Like A party to inspire the poor life etc ..', '48hours.jpg'),
(4, 'FPSC', 'Oonas', NULL, 'Enter Party Description etc', 'arrival.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `cnic` varchar(200) NOT NULL,
  `phoneno` varchar(200) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `name`, `fname`, `email`, `password`, `dob`, `cnic`, `phoneno`, `address`, `picture`) VALUES
(1, 'Bilal Shafique', 'Safiq Ahmad', 'bilal@gmail.com', 'bilal123', '2020-11-04', '3850293235339', '030912901212', 'Sahiwal Pakistan', '48hours.jpg'),
(2, 'Qadeer raza', 'raza ahmad', 'qadeer@gmail.com', 'qadeer123', '2020-11-04', '3850293235339', '030912901212', 'Sahiwal Pakisatan', ''),
(3, 'Ali raza', 'raza ahmad', 'ali@gmail.com', 'aliraza123', '2020-02-05', '3850293235339', '030912901212', 'Farid town sahiwal', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `vid`, `pid`) VALUES
(2, 1, 1),
(7, 2, 3),
(9, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vid` (`vid`),
  ADD KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `pid` FOREIGN KEY (`pid`) REFERENCES `parties` (`id`),
  ADD CONSTRAINT `vid` FOREIGN KEY (`vid`) REFERENCES `voters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
