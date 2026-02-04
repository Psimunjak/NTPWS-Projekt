-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 08:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `country` varchar(50) NOT NULL,
  `pizza` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`firstname`, `lastname`, `address`, `email`, `date`, `time`, `country`, `pizza`) VALUES
('Ante', 'Antic', 'Vrbik 8b', 'anteantic@gmail.com', '2026-01-18', '18:30:00', 'si', 'Vegetarian');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `news_id`, `image`) VALUES
(1, 2, 'uploads/696e795a21862_ha.jpg'),
(2, 2, 'uploads/696e795a21e34_hawaiian.jpg'),
(3, 2, 'uploads/696e795a22a03_mar.jpg'),
(4, 2, 'uploads/696e795a22fe8_margherita.jpg'),
(5, 2, 'uploads/696e795a234ed_pep.jpg'),
(6, 2, 'uploads/696e795a23a61_pepperoni.jpg'),
(7, 2, 'uploads/696e795a24060_pizzeria.jpg'),
(8, 2, 'uploads/696e795a24823_sea.jpg'),
(9, 2, 'uploads/696e795a24e66_seafood.jpg'),
(10, 2, 'uploads/696e795a2541d_veg.jpg'),
(11, 2, 'uploads/696e795a259ae_veggie.jpg'),
(12, 3, 'uploads/696e7a4276af3_margherita.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `contents` varchar(1000) DEFAULT NULL,
  `date` date NOT NULL,
  `archive` tinyint(1) NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `contents`, `date`, `archive`, `valid`) VALUES
(2, 'Brand New', 'uploads/696e795a208da_pizzeria.jpg', 'Our brand new limited time pizza flavor.', '2026-01-19', 0, 1),
(3, 'Old News', 'uploads/696e7a42760c7_mar.jpg', 'Introducing classic Margherita.', '2026-01-19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `perm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `email`, `country`, `city`, `street`, `dob`, `password`, `username`, `valid`, `perm`) VALUES
('Adam', 'Adamic', 'aa11@gmail.com', 'Croatia', 'Zagreb', 'Nova Cesta', '2025-01-30', '$2y$10$rzfKPI83iID7/417DVo5JO9vxoVE4SW.xRljdWtE6olz8SUEFMvOO', 'admin', 1, 2),
('Ante', 'Antic', 'anteantic@gmail.com', 'Croatia', 'Zagreb', 'Ilica', '2026-01-01', '$2y$10$21BNbYyPllkmWEXjzBgvOOiABof8jfMIroNR7dHQUYyEvLXQHNHQm', 'ante', 1, 0),
('Edward', 'Edwardic', 'ee1@gmail.com', 'Croatia', 'Split', 'Adamova', '2004-01-23', '$2y$10$qbl83YaREMVU3/2QNADh8.razCXUxtjwNNjHgSwvsB5W1RAfpNReW', 'editor', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
