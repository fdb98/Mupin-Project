-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 03, 2022 alle 22:11
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
-- Database: `mupin`
--
CREATE DATABASE IF NOT EXISTS `mupin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mupin`;

-- --------------------------------------------------------

--
-- Struttura della tabella `computer`
--

CREATE TABLE IF NOT EXISTS `computer` (
  `id_catalogo` varchar(20) NOT NULL,
  `modello` varchar(200) NOT NULL,
  `anno` int(4) NOT NULL,
  `CPU` varchar(100) NOT NULL,
  `Frequenza_HZ` float NOT NULL,
  `RAM` int(11) NOT NULL,
  `HDD` float DEFAULT NULL,
  `SO` varchar(200) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `URL_materiale_ricerca` varchar(250) DEFAULT NULL,
  `Tag` varchar(200) DEFAULT NULL,
  `n_foto` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_catalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `id`
--

CREATE TABLE IF NOT EXISTS `id` (
  `id_catalogo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_catalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `id_catalogo` varchar(20) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `autore` varchar(200) NOT NULL,
  `casa_editrce` varchar(200) NOT NULL,
  `anno` int(4) NOT NULL,
  `n_pagine` float DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `URL_materiale_ricerca` varchar(250) DEFAULT NULL,
  `Tag` varchar(200) DEFAULT NULL,
  `n_foto` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_catalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `periferica`
--

CREATE TABLE IF NOT EXISTS `periferica` (
  `id_catalogo` varchar(20) NOT NULL,
  `Modello` varchar(200) NOT NULL,
  `Tipo` varchar(200) NOT NULL,
  `Note` text DEFAULT NULL,
  `URL_materiale_ricerca` varchar(250) DEFAULT NULL,
  `Tag` varchar(200) DEFAULT NULL,
  `n_foto` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_catalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `rivista`
--

CREATE TABLE IF NOT EXISTS `rivista` (
  `id_catalogo` varchar(20) NOT NULL,
  `Titolo` varchar(200) NOT NULL,
  `n_rivista` int(11) NOT NULL,
  `Anno` int(4) NOT NULL,
  `Casa_editrice` varchar(200) NOT NULL,
  `Note` text DEFAULT NULL,
  `URL_research_material` varchar(250) DEFAULT NULL,
  `Tag` varchar(200) DEFAULT NULL,
  `n_foto` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_catalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `computer`
--
ALTER TABLE `computer`
  ADD CONSTRAINT `id_catalogo` FOREIGN KEY (`id_catalogo`) REFERENCES `id` (`id_catalogo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_catalogo`) REFERENCES `id` (`id_catalogo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `periferica`
--
ALTER TABLE `periferica`
  ADD CONSTRAINT `id_catalogo_p` FOREIGN KEY (`id_catalogo`) REFERENCES `id` (`id_catalogo`);

--
-- Limiti per la tabella `rivista`
--
ALTER TABLE `rivista`
  ADD CONSTRAINT `rivista_ibfk_1` FOREIGN KEY (`id_catalogo`) REFERENCES `id` (`id_catalogo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* Privilegi per `admin`@`%`*/

GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO `admin`@`%` IDENTIFIED BY PASSWORD '*1207E372CE34C190D0ED8E09CB22DCABE091E694';

GRANT ALL PRIVILEGES ON `mupin`.* TO `admin`@`%`;


/* Privilegi per `user`@`%`*/

GRANT SELECT ON *.* TO `user`@`%`;