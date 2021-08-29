-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2021 at 12:38 PM
-- Server version: 8.0.23
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `jela`
--

DROP TABLE IF EXISTS `jela`;
CREATE TABLE IF NOT EXISTS `jela` (
  `cena` int DEFAULT NULL,
  `naziv` varchar(100) NOT NULL,
  `opis` varchar(100) NOT NULL,
  `id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jela`
--

INSERT INTO `jela` (`cena`, `naziv`, `opis`, `id`) VALUES
(400, 'pileca_salata', 'piletina,zelena salata,maslinovo ulje,feta sir,paradajz', 1),
(200, 'sendvic', 'tost,pecenica,kackavalj,kecap,majonez,krastavac', 2),
(570, 'pasta', 'testenina,sunka,sos,zacini', 3),
(480, 'pizza', 'testo,kecap,kackavalj,origano,prsuta,masline,zacini', 4),
(260, 'sufle', 'brasno,jaja,secer,kakao,cokolada,margarin', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
