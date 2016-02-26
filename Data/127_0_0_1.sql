-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2016 at 10:38 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `augmented-reality`
--
CREATE DATABASE IF NOT EXISTS `augmented-reality` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `augmented-reality`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `about` text NOT NULL,
  `value` int(11) NOT NULL,
  `GeoTag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `name`, `about`, `value`, `GeoTag`) VALUES
(1, 'Fridge', 'This is a fridge', 125, 0),
(2, 'Microwave', 'This is a microwave', 500, 0),
(3, 'Toaster', 'This is a toaster', 250, 0),
(4, 'Electromotor-3000', 'This is a electromotor', 500, 0),
(5, 'PC', 'This is a PC', 200, 0),
(6, 'B Blok', 'Oranje gebouw :D', 3000, 1),
(7, ' D Blok', 'informatica gebouw', 7000, 1),
(8, 'F blok', 'Talen gebouw?', 2500, 1),
(9, 'Agora', 'grote zaal', 2000, 1),
(10, 'Parking', 'Belichting verbruik?', 2500, 1),
(11, 'P Blok', 'Chemie gebouw', 3000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
