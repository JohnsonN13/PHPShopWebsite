-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 05, 2021 at 01:33 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borntoride`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `price` double NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `category`) VALUES
(1, 'Cube Elite C:85X', 'images/cube.png', 'Muni d\'un cadre léger et de freins hydrauliques. Il associe efficacité et confort pour un parfait contrôle de vos mouvements.', 3500, 'Cube'),
(2, 'Rockrider ST 520', 'images/rockrider.png', 'Pour pouvoir prendre plus de risques et toujours progresser, vous aurez besoin de contrôle. Conçu et approuvé le VTT ST 520 est celui qu\'il vous faut.', 300, 'Rockrider'),
(3, 'Rocky Mountain Sherpa', 'images/rockymoutain.png', 'Le Sherpa permet de s\'attaquer à des terrains plus difficiles. Pour une route ambitieuse de l’arrière-pays qui ne vous avait encore jamais traversé l’esprit en termes de possibilités.', 4990, 'RockyMountain'),
(4, 'Rocky Moutain Thunderbolt', 'images/rockymoutain2.png', 'Rapide et maniable, le Thunderbolt, c’est le coup de foudre assuré. Que vous aimiez gravir les montées techniques ou vous amuser avec tous les obstacles du sentier, ce vélo sera à la hauteur de votre créativité.', 6490, 'RockyMountain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
