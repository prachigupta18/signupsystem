-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 08:32 AM
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
-- Database: `logdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `form1`
--

CREATE TABLE `form1` (
  `sno` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `passwrd` varchar(255) NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form1`
--

INSERT INTO `form1` (`sno`, `uname`, `passwrd`, `dt`) VALUES
(1, 'pp', '$2y$10$dEDwv59BxGHsQGBa19NgHOhdzXfc6dr3umA/qTh8uUncsmAyz5arO', '2023-01-05 12:55:10'),
(2, 'pg', '$2y$10$t8K2ILlK7obklINJxEnS4eQ.Sa76I0Ke0jZwC2qCYySUIS.6L4iaO', '2023-01-05 13:04:43'),
(3, 'mamta', '$2y$10$PKWjzKCZ52kxHWynk8z9XuUo8xmidtwYGRkyzUyDJGLU9Sv2DwK9S', '2023-01-07 12:53:48'),
(4, 'prachigupta', '$2y$10$CGkmnLEJSK4ygxuoiSWF9OdcMJjIjR/PWY4pniqSsN/3AseZU6cnC', '2023-01-08 16:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `sno` int(11) NOT NULL,
  `pfimage` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(22) NOT NULL,
  `mobilenumber` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`sno`, `pfimage`, `firstname`, `lastname`, `email`, `gender`, `mobilenumber`, `address`, `city`) VALUES
(10, '1673360919-abj.png', 'yogendra', 'gupta', 'ykgupta2507@gmail.com', 'male', '8890201666', 'krishna govind colony', 'Keshorai patan'),
(12, '1673414038-03.jpg', 'Hello', 'gupta', 'mkgupta@gmail.com', 'male', '7734586258', 'we24rw5t', 'Rajasthan'),
(13, '1673415607-_2.jpg', 'arpan', 'gupta', 'arpan25@gmail.com', 'male', '8973546723', 'paras colony', 'Keshorai patan'),
(14, '1673421218-gc-gmc.png', 'arpan', 'gupta', 'Pihukhandelwal897@gmail.com', 'male', '7734586258', 'keshorai patan', 'Bundi Raj'),
(15, '1673421318-prachi.jpg', 'mamta', 'khandelwal', 'prachigupta18@gmail.com', 'female', '9414538979', 'near by sbi bank , Keshorai Patan', 'Bundi Raj'),
(16, '1673421440-landscaping.png', 'suresh', 'gupta', 'suresh874@gmail.com', 'male', '8973546723', 'randthambor circle', 'sawai madhopur'),
(17, '1673421538-25231.png', 'aman', 'gupta', 'aman@gmail.com', 'male', '9929894666', 'lalsot', 'dosa'),
(18, '1673421794-landscaping.png', 'rajni', 'sharma', 'rajnisui@gmail.com', 'female', '9784654589', 'nmbjhoiu89uoih', 'Kota Raj'),
(19, '1673422312-asdf.png', 'prachi', 'gupta', 'Pihukhandelwal897@gmail.com', 'female', '8955576444', 'krishna govind colony', 'bundi'),
(20, '1673422373-nursery-logo.png', 'prachi', 'khandelwal', 'prachigupta18@gmail.com', 'female', '7737158254', 'keshorai patan', 'Bundi Raj'),
(21, '1673422506-alvin.jpg', 'Hello', 'World', 'vhui@gmail.com', 'male', '8974665565', 'vghderruiohghg', 'mp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form1`
--
ALTER TABLE `form1`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form1`
--
ALTER TABLE `form1`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
