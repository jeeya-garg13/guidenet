-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 07:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guidenet`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `SENDER_NAME` varchar(255) NOT NULL,
  `SENDER_ID` varchar(255) NOT NULL,
  `RECEIVER_ID` varchar(255) NOT NULL,
  `MESSAGE` text NOT NULL,
  `TIMESTAMP` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `SENDER_NAME`, `SENDER_ID`, `RECEIVER_ID`, `MESSAGE`, `TIMESTAMP`) VALUES
(0, 'Jaina', 'BT123', 'btbtc22077', 'hiii', '2025-09-18 05:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `id` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`id`, `EMAIL`, `PASSWORD`) VALUES
('BT123', 'btbtc22077_jeeya@banasthali.in', '$2y$10$wYkWJ6.VShQKO/9b6ey1G.xUjM.tF2ADqrsMuvELmh6aT.h3o3P2C'),
('btbtc22077', 'gargjiya815@gmail.com', '$2y$10$kGQhd/TfgYonfiuuYwnNCu1qsQW1bzmWHwM9INvxjCmCvmK.S.Zpi');

-- --------------------------------------------------------

--
-- Table structure for table `stud_registration`
--

CREATE TABLE `stud_registration` (
  `ID` varchar(255) NOT NULL,
  `REG_NO` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CONTACT` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COURSE` varchar(255) NOT NULL,
  `BRANCH` varchar(255) NOT NULL,
  `INTERNSHIP` varchar(255) DEFAULT NULL,
  `PLACEMENT` varchar(255) DEFAULT NULL,
  `RESUME` mediumblob DEFAULT NULL,
  `ADVICE` varchar(255) DEFAULT NULL,
  `DOB` date NOT NULL,
  `STATE` varchar(255) NOT NULL,
  `ABOUT` text DEFAULT NULL,
  `PROFILEPICTURE` varchar(255) DEFAULT NULL,
  `HOBBY` longtext DEFAULT NULL,
  `LANGUAGES` longtext DEFAULT NULL,
  `SKILLS` longtext DEFAULT NULL,
  `TWELFTH` varchar(255) DEFAULT NULL,
  `12_YEAR` int(11) DEFAULT NULL,
  `12_RESULT` double DEFAULT NULL,
  `TENTH` varchar(255) DEFAULT NULL,
  `10_YEAR` int(11) DEFAULT NULL,
  `10_RESULT` int(11) DEFAULT NULL,
  `EXTRA_CURRICULAR` longtext DEFAULT NULL,
  `CLUBS` longtext DEFAULT NULL,
  `CGPA` float DEFAULT NULL,
  `CERTIFICATES` longtext DEFAULT NULL,
  `INTERN_COMP` varchar(255) DEFAULT NULL,
  `INTERN_PERIOD` varchar(255) DEFAULT NULL,
  `PLACE_COMP` varchar(255) DEFAULT NULL,
  `PLACE_PERIOD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud_registration`
--

INSERT INTO `stud_registration` (`ID`, `REG_NO`, `NAME`, `CONTACT`, `EMAIL`, `COURSE`, `BRANCH`, `INTERNSHIP`, `PLACEMENT`, `RESUME`, `ADVICE`, `DOB`, `STATE`, `ABOUT`, `PROFILEPICTURE`, `HOBBY`, `LANGUAGES`, `SKILLS`, `TWELFTH`, `12_YEAR`, `12_RESULT`, `TENTH`, `10_YEAR`, `10_RESULT`, `EXTRA_CURRICULAR`, `CLUBS`, `CGPA`, `CERTIFICATES`, `INTERN_COMP`, `INTERN_PERIOD`, `PLACE_COMP`, `PLACE_PERIOD`) VALUES
('BT123', '12345', 'Jaina', '44121215454', 'btbtc22077_jeeya@banasthali.in', 'B.Tech', 'CS', NULL, NULL, NULL, NULL, '2008-12-17', 'MP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('btbtc22077', '2022/1608', 'jeeya', '8392838339', 'gargjiya815@gmail.com', 'btech', 'cs', '', '', NULL, '', '2008-12-10', 'up', '', 'user_btbtc22077.jpg', '', '', '', '', 0, 0, '', 0, 0, '', '', 0, '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud_registration`
--
ALTER TABLE `stud_registration`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `REG_NO` (`REG_NO`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
