-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 03, 2022 alle 22:09
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `credenziali`
--
CREATE DATABASE IF NOT EXISTS `credenziali` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `credenziali`;

-- --------------------------------------------------------

--
-- Struttura della tabella `logindb`
--

CREATE TABLE IF NOT EXISTS `logindb` (
  `user` varchar(30) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `logindb`
--

INSERT INTO `logindb` (`user`, `password`) VALUES
('admin@mupin.it', '$2y$10$vPPv/fCt1lZuvbBphJWVpO0XCG9GMVC9wBEAhMwFngaUAbAh7q5wC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/* Privilegi per `user`@`%`*/

GRANT SELECT ON *.* TO `user`@`%`;
