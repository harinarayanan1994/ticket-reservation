-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2013 at 04:56 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `toDate` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `From` varchar(20) NOT NULL,
  `To` varchar(20) NOT NULL,
  `Departure` varchar(20) NOT NULL,
  `seats` int(11) NOT NULL DEFAULT '0',
  `Credit_card` varchar(20) NOT NULL,
  `Card_Number` mediumtext NOT NULL,
  `Fare` int(20) NOT NULL,
  `seatnum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cancelled`
--

CREATE TABLE IF NOT EXISTS `cancelled` (
  `seats` int(11) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `From` varchar(20) NOT NULL,
  `To` varchar(20) NOT NULL,
  `Departure` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `Bus_Number` varchar(20) NOT NULL,
  `From` varchar(20) NOT NULL,
  `To` varchar(20) NOT NULL,
  `Departure` text NOT NULL,
  `Arrival` text NOT NULL,
  `Fare_per_ticket` int(11) NOT NULL,
  PRIMARY KEY (`Bus_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Bus_Number`, `From`, `To`, `Departure`, `Arrival`, `Fare_per_ticket`) VALUES
('KA34F4562', 'Bangalore', 'Neyveli', '20:00', '05:15', 2500),
('KA34F4567', 'Neyveli', 'Bangalore', '21:30', '07:00', 2500),
('TN31A1145', 'Chennai', 'Neyveli', '07:45', '12:30', 440),
('TN31A1234', 'Chennai', 'Neyveli', '15:30', '21:00', 440),
('TN31A1236', 'Bangalore', 'Neyveli', '04:00', '12:30', 2500),
('TN31A1239', 'Neyveli', 'Coimbatore', '09:00', '17:30', 890),
('TN31A1245', 'Neyveli', 'Trivandrum', '22:00', '06:45', 1050),
('TN31A1257', 'Neyveli', 'Bangalore', '05:00', '13:30', 2500),
('TN31A2441', 'Madurai', 'Neyveli', '09:45', '15:00', 270),
('TN31A2445', 'Neyveli', 'Chennai', '04:00', '09:00', 440),
('TN31A2446', 'Chennai', 'Neyveli', '17:00', '21:30', 440),
('TN31A2469', 'Trivandrum', 'Neyveli', '22:30', '08:00', 1050),
('TN31A3467', 'Neyveli', 'Madurai', '15:30', '22:00', 270),
('TN31A3469', 'Coimbatore', 'Neyveli', '09:00', '16:00', 890),
('TN31E4567', 'Neyveli', 'Trivandrum', '22:00', '08:00', 1050),
('TN31S3324', 'Neyveli', 'Chennai', '23:45', '04:45', 440),
('TN31S3456', 'Madurai', 'Neyveli', '21:00', '03:30', 270),
('TN31S3480', 'Neyveli', 'Chennai', '14:00', '18:30', 440),
('TN31S3499', 'Neyveli', 'Madurai', '13:30', '19:30', 270),
('TN31S3500', 'Coimbatore', 'Neyveli', '23:30', '08:45', 890),
('TN31W9600', 'Neyveli', 'Coimbatore', '21:00', '06:00', 890);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Name` varchar(40) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Gender` text NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Password` mediumtext NOT NULL,
  PRIMARY KEY (`Username`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Email_2` (`Email`),
  UNIQUE KEY `Email_3` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Username`, `Gender`, `Email`, `Address`, `Phone`, `Password`) VALUES
('Hari', 'hari_nara', 'male', 'padmasrihari69@gmail.com', '', 0, '827ccb0eea8a706c4c34a16891f84e7b'),
('Hari narayanan S', 'hari_narayana', 'male', 'drsmysrinivasan@yahoo.co.in', '', 0, '827ccb0eea8a706c4c34a16891f84e7b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
