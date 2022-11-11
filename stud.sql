-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 04:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stud`
--

-- --------------------------------------------------------

--
-- Table structure for table `atsiliepimai`
--

CREATE TABLE `atsiliepimai` (
  `priezastis` text NOT NULL,
  `zinute` text NOT NULL,
  `atsiliepimoData` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atsiliepimai`
--

INSERT INTO `atsiliepimai` (`priezastis`, `zinute`, `atsiliepimoData`, `id`) VALUES
('a', 'd', '2022-11-11 05:16:52', 5),
('awdawd', 'awdawd', '2022-11-11 05:18:11', 6),
('awdawd', 'awdawd', '2022-11-11 05:20:48', 7);

-- --------------------------------------------------------

--
-- Table structure for table `kambariai`
--

CREATE TABLE `kambariai` (
  `pavadinimas` varchar(50) NOT NULL,
  `tipas` int(11) NOT NULL,
  `parosKaina` float NOT NULL,
  `aprasymas` text NOT NULL,
  `id` int(11) NOT NULL,
  `arUzsakytas` tinyint(1) NOT NULL DEFAULT 0,
  `uzsakovoVardas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kambariai`
--

INSERT INTO `kambariai` (`pavadinimas`, `tipas`, `parosKaina`, `aprasymas`, `id`, `arUzsakytas`, `uzsakovoVardas`) VALUES
('tests', 2, 56, 'tests', 3, 1, 'user'),
('tests', 1, 56, 'tests', 7, 0, NULL),
('awdadw', 2, 254, '535a1wdawd', 17, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keliones`
--

CREATE TABLE `keliones` (
  `id` int(5) NOT NULL,
  `kur` varchar(20) NOT NULL,
  `kada` varchar(30) NOT NULL,
  `kaina` decimal(8,2) NOT NULL,
  `organizuoja` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keliones`
--

INSERT INTO `keliones` (`id`, `kur`, `kada`, `kaina`, `organizuoja`) VALUES
(1, 'Ryga', '12/25/2021', '199.00', 'Rimas'),
(2, 'Ryga', '12/28/2021', '209.00', 'Pranas'),
(3, 'Minskas', '01/02/2022', '120.00', 'Jonas'),
(4, 'Talinas', '12/31/2021', '350.00', 'Rimas'),
(5, 'Ryga', '12/28/2021', '320.00', 'Rimas'),
(6, 'Talinas', '12/15/2021', '200.00', 'Pranas');

-- --------------------------------------------------------

--
-- Table structure for table `lukasnavasinskas`
--

CREATE TABLE `lukasnavasinskas` (
  `id` int(5) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `epastas` varchar(50) NOT NULL,
  `kam` varchar(20) NOT NULL,
  `data` datetime NOT NULL,
  `zinute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paieska`
--

CREATE TABLE `paieska` (
  `id` int(11) NOT NULL,
  `veterinaras` varchar(20) NOT NULL,
  `gyvunoID` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `priezastis` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paieska`
--

INSERT INTO `paieska` (`id`, `veterinaras`, `gyvunoID`, `priezastis`) VALUES
(12, 'pranas', '2r', 'taip '),
(13, 'pranas', '2r', 'Dinges'),
(15, 'pranas', '2r', 'Dinges'),
(17, 'pranas', '2r', 'Dinges'),
(18, 'pranas', '2r', 'Dingo'),
(20, 'pranas', '2r', 'Dingo'),
(24, 'pranas', '2r', 'Dingo'),
(25, 'pranas', '2r', 'Dingo'),
(26, 'pranas', 'dfsg', ' Op'),
(39, 'pranas', '2r', ' uu'),
(40, 'pranas', '2r', ' uu'),
(41, 'pranas', 'snmxyh', 'Rado'),
(42, 'pranas', 'snmxyh', 'Rado'),
(43, 'pranas', '22er', ' Pamat'),
(44, 'pranas', '22er', ' Pamatė žmogus'),
(45, 'pranas', '22er', ' Pamatė žmogus'),
(46, 'pranas', '22er', ' Pamatė žmogus'),
(47, 'pranas', '22er', ' Pamatė žmogus'),
(48, 'pranas', '2r', ' Paieška'),
(49, 'pranas', '2r', ' Paieška'),
(50, 'pranas', '2r', ' Paieška');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) NOT NULL,
  `userlevel` tinyint(1) UNSIGNED DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('user2', '96da763b7a969b1028ee3007569eaf3a', '18c7c458ba07eb9c2b26dc24fa64f18b', 4, 'user@user.user', '2022-11-11 02:22:35'),
('admin', '6e5b5410415bde908bd4dee15dfb167a', '6dabe7f9ee8ba2cd1257de365e5985bb', 5, 'a@a.a', '2022-11-11 03:20:50'),
('direktorius', 'aee0d39499bf0f4b77fec6aee2aa1b9f', 'b8f6444155381269f039cbea0717dfd5', 9, 'DIREk@max.lt', '2022-11-11 03:26:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atsiliepimai`
--
ALTER TABLE `atsiliepimai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kambariai`
--
ALTER TABLE `kambariai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keliones`
--
ALTER TABLE `keliones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lukasnavasinskas`
--
ALTER TABLE `lukasnavasinskas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paieska`
--
ALTER TABLE `paieska`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atsiliepimai`
--
ALTER TABLE `atsiliepimai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kambariai`
--
ALTER TABLE `kambariai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `keliones`
--
ALTER TABLE `keliones`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lukasnavasinskas`
--
ALTER TABLE `lukasnavasinskas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paieska`
--
ALTER TABLE `paieska`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
