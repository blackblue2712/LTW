-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2019 at 05:28 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Buoi3`
--

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `idsp` int(11) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `chitietsp` varchar(225) DEFAULT NULL,
  `giasp` int(11) NOT NULL,
  `hinhanhsp` varchar(50) DEFAULT NULL,
  `idtv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`idsp`, `tensp`, `chitietsp`, `giasp`, `hinhanhsp`, `idtv`) VALUES
(3, 'HP', 'Lorem', 14000000, 'sdv1mhp.jpg', 1),
(10, 'Asus', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem magnam error, esse numquam mollitia hic nostrum! Magnam distinctio saepe atque.', 12300000, 'ZaxUnasus.jpg', 1),
(11, 'Acer', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem magnam error, esse numquam mollitia hic nostrum! Magnam distinctio saepe atque.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem magnam error, esse num', 91301023, '9Tixaacer.jpg', 1),
(22, '\'\"/?', '2131313', 123123, '8MwTAdell.jpg', 1),
(23, 'tést', '<script>alert(1)</script>', 23123, 'd00d23f26073852ddc62.jpg', 1),
(26, 'Asysyssy', '13123', 1212314, 'jnKAFasus.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`idsp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
