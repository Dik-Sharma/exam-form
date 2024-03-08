-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3325
-- Generation Time: Aug 16, 2022 at 12:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_category`
--

CREATE TABLE `applicant_category` (
  `id` int(11) NOT NULL,
  `category` int(1) NOT NULL,
  `certificate` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_details`
--

CREATE TABLE `applicant_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `fatheroccupation` varchar(128) NOT NULL,
  `fatherdesignation` varchar(128) NOT NULL,
  `fatherofficeaddress` varchar(256) NOT NULL,
  `mothername` varchar(256) NOT NULL,
  `motheroccupation` varchar(128) NOT NULL,
  `motherdesignation` varchar(128) NOT NULL,
  `motherofficeaddress` varchar(255) NOT NULL,
  `spousename` varchar(255) NOT NULL,
  `occupation` varchar(128) NOT NULL,
  `designation` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `place_of_birth` varchar(128) NOT NULL,
  `village_town` varchar(128) NOT NULL,
  `police_station` varchar(128) NOT NULL,
  `district` varchar(128) NOT NULL,
  `state` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant_details`
--

INSERT INTO `applicant_details` (`id`, `name`, `dob`, `fathername`, `fatheroccupation`, `fatherdesignation`, `fatherofficeaddress`, `mothername`, `motheroccupation`, `motherdesignation`, `motherofficeaddress`, `spousename`, `occupation`, `designation`, `address`, `place_of_birth`, `village_town`, `police_station`, `district`, `state`) VALUES
(0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `applied_positions`
--

CREATE TABLE `applied_positions` (
  `id` int(11) NOT NULL,
  `preference_1` int(11) NOT NULL,
  `preference_2` int(11) NOT NULL,
  `preference_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marksheets`
--

CREATE TABLE `marksheets` (
  `id` int(11) NOT NULL,
  `tenth` mediumblob NOT NULL,
  `twelfth` mediumblob NOT NULL,
  `ug` mediumblob NOT NULL,
  `pg` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photo_signature`
--

CREATE TABLE `photo_signature` (
  `id` int(11) NOT NULL,
  `photo` mediumblob NOT NULL,
  `signature` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `applicationid` int(100) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `dateofbirth` date NOT NULL,
  `Name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`applicationid`, `username`, `password_hash`, `city`, `dateofbirth`, `Name`) VALUES
(100, 'diksharma040@gmail.com', '$2y$10$KrIaBEo6SW5yJQNcqOnGGu24Ty25zjMjTqGrBXWacUj8NUFDkugsi', 'Guwahati', '1999-01-19', 'Dik Sharma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_category`
--
ALTER TABLE `applicant_category`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `applicant_details`
--
ALTER TABLE `applicant_details`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `applied_positions`
--
ALTER TABLE `applied_positions`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `marksheets`
--
ALTER TABLE `marksheets`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `photo_signature`
--
ALTER TABLE `photo_signature`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`applicationid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `applicationid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
