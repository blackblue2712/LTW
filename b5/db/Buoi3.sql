-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2019 at 05:07 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `id` int(11) NOT NULL,
  `tendangnhap` varchar(50) NOT NULL,
  `matkhau` varchar(64) NOT NULL,
  `hinhanh` varchar(100) DEFAULT NULL,
  `gioitinh` varchar(6) DEFAULT NULL,
  `nghenghiep` varchar(25) DEFAULT NULL,
  `sothich` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thanhvien`
--

INSERT INTO `thanhvien` (`id`, `tendangnhap`, `matkhau`, `hinhanh`, `gioitinh`, `nghenghiep`, `sothich`) VALUES
(1, 'knaldt', 'e10adc3949ba59abbe56e057f20f883e', '3c01cfa63341d61f8f50.jpg', 'female', 'student', 'Listen music-Play game-Go'),
(2, 'mio', 'e10adc3949ba59abbe56e057f20f883e', 'a57dbccb2744c21a9b55.jpg', 'male', 'student', 'Read book-Listen music-Co'),
(12, 'b1706729', 'e10adc3949ba59abbe56e057f20f883e', 'maxResizedH9GI.jpg', 'male', 'student', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`idsp`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idsp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
