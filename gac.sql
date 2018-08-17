-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 11:38 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gac`
--
CREATE DATABASE IF NOT EXISTS `gac` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gac`;

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ImportDate` (`strdate` VARCHAR(12)) RETURNS DATE NO SQL
BEGIN
     Declare Result varchar(50);
     set result := concat(substring(strdate,7,4),'-',substring(strdate,4,2),'-',substring(strdate,1,2));
     Return cast(Result as date);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_appel`
--

CREATE TABLE `ticket_appel` (
  `id` int(11) NOT NULL,
  `Compte_facture` varchar(11) NOT NULL,
  `No_facture` varchar(11) NOT NULL,
  `No_abonne` varchar(11) NOT NULL,
  `Date_facturation` date NOT NULL,
  `Heure_facturation` time NOT NULL,
  `Dure_vol_reel` varchar(15) NOT NULL,
  `Dure_vol_facturee` varchar(15) NOT NULL,
  `Type_facturation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket_appel`
--
ALTER TABLE `ticket_appel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket_appel`
--
ALTER TABLE `ticket_appel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
