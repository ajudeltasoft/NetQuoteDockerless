-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2020 at 01:51 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nq_revised`
--

-- --------------------------------------------------------

--
-- Table structure for table `mtx_productmodifications`
--

CREATE TABLE `mtx_productmodifications` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `prodid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mtx_productmodifications`
--

INSERT INTO `mtx_productmodifications` (`id`, `catid`, `modid`, `prodid`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 1),
(4, 1, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mtx_productmodifications`
--
ALTER TABLE `mtx_productmodifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mtx_productmodifications`
--
ALTER TABLE `mtx_productmodifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
