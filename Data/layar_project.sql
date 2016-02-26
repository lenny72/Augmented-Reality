-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 28 jan 2016 om 13:28
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `layar_project`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `poi`
--

CREATE TABLE IF NOT EXISTS `poi` (
  `id` int(11) NOT NULL,
  `footnote` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `lat` decimal(13,10) NOT NULL,
  `lon` decimal(13,10) NOT NULL,
  `imageURL` varchar(255) NOT NULL,
  `description` varchar(150) NOT NULL,
  `biwStyle` enum('classic','collapsed') NOT NULL,
  `alt` int(10) NOT NULL,
  `doNotIndex` tinyint(1) NOT NULL,
  `showSmallBiw` tinyint(1) NOT NULL,
  `showBiwOnClick` tinyint(1) NOT NULL,
  `poiType` enum('geo','vision') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `poi`
--

INSERT INTO `poi` (`id`, `footnote`, `title`, `lat`, `lon`, `imageURL`, `description`, `biwStyle`, `alt`, `doNotIndex`, `showSmallBiw`, `showBiwOnClick`, `poiType`) VALUES
(1, 'Augmented Reality Project Groep 8', 'Kleinhoefstraat 1', '51.1589310000', '4.9649400000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik Kleinhoefstraat 1: 700kWh', '', 0, 0, 0, 0, 'geo'),
(2, 'Augmented Reality Project Groep 8', 'Kleinhoefstraat 2', '51.1591390000', '4.9648430000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik Kleinhoefstraat 2', '', 0, 0, 0, 0, 'geo'),
(3, 'Augmented Reality Project Groep 8', 'Kleinhoefstraat 3', '51.1588160000', '4.9646610000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruikt Kleinhoefstraat 3: 800kWh', '', 0, 0, 0, 0, 'geo'),
(4, 'Augmented Reality Project Groep 8', 'Thomas More Geel A-Blok', '51.1609960000', '4.9614310000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik A-Blok: 10000kWh', '', 0, 0, 0, 0, 'geo'),
(5, 'Augmented Reality Project Groep 8', 'Thomas More Geel B-Blok', '51.1614470000', '4.9620000000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik B-Blok: 7000kWh', '', 0, 0, 0, 0, 'geo'),
(6, 'Augmented Reality Project Groep 8', 'Thomas More Geel D-Blok', '51.1617500000', '4.9618930000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik D-Blok: 5000kWh', '', 0, 0, 0, 0, 'geo'),
(7, 'Augmented Reality Project Groep 8', 'Thomas More Geel E-Blok', '51.1605460000', '4.9602940000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik E-Blok: 7562kWh', '', 0, 0, 0, 0, 'geo'),
(8, 'Augmented Reality Project Groep 8', 'Thomas More Geel F-Blok', '51.1599870000', '4.9606370000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik F-Blok: 6542kWh', '', 0, 0, 0, 0, 'geo'),
(9, 'Augmented Reality Project Groep 8', 'Thomas More Geel G-Blok', '51.1611310000', '4.9598650000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik G-Blok: 8000kWh', '', 0, 0, 0, 0, 'geo'),
(10, 'Augmented Reality Project Groep 8', 'Thomas More Geel O-Blok', '51.1630690000', '4.9609270000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik O-Blok: 6000kWh', '', 0, 0, 0, 0, 'geo'),
(11, 'Augmented Reality Project Groep 8', 'Thomas More Geel P-Blok', '51.1621870000', '4.9611850000', 'http://samsung-updates.com/wp-content/uploads/2014/09/KitKat-110x110.jpg', 'Verbruik P-Blok: 5000kWh', '', 0, 0, 0, 0, 'geo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
