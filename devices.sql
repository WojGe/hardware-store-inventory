-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2023 at 01:28 PM
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
-- Database: `shop_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `brand` text NOT NULL,
  `model` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `condit` varchar(11) NOT NULL,
  `details` text DEFAULT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `category`, `brand`, `model`, `quantity`, `condit`, `details`, `img`) VALUES
(1, 'processor', 'Intel', 'Core i7-13700K', 4, 'new', 'Cooler nor included', '65267f370d5c18.90836386.jpg'),
(2, 'graphics card', 'Nvidia', 'GeForce RTX 4090', 2, 'new', NULL, '65267db5ccd6b6.34975135.jpg'),
(3, 'motherboard', 'MSI', 'Z270 Gaming Plus', 3, 'pre-owned', NULL, NULL),
(4, 'mouse', 'Logitech', 'M185', 12, 'new', NULL, NULL),
(5, 'laptop', 'Lenovo', 'Thinkpad T410', 1, 'pre-owned', 'Broken', '65267dde91bad7.62840781.jpg'),
(6, 'pc case', 'Silentium PC', 'Regnum RG1W', 3, 'new', 'Sealed', NULL),
(7, 'graphics card', 'Nvidia', 'GeForce GTX 1080Ti', 3, 'refurbished', NULL, NULL),
(8, 'software', 'Microsoft', 'Windows 11', 312, 'new', 'Home Edition', '65267f7bb8cfd7.25141974.png'),
(9, 'monitor', 'iiyama', 'G-Master G2450HS-B1 Black Hawk', 4, 'new', NULL, NULL),
(10, 'webcam', 'Logitech', 'C920', 12, 'new', NULL, NULL),
(11, 'processor', 'AMD', 'Ryzen 9 5900X', 14, 'new', 'Socket AM4', NULL),
(12, 'drives', 'Seagate', 'IronWolf 6TB', 14, 'new', 'HDD; 3.5inch; SATA III; 5400rpm; Cache: 256MB', NULL),
(13, 'pc case', 'ENDORFY', 'Arx 700 ARGB', 14, 'new', 'Window; RGB', '65267f4ee58606.45611215.jpg'),
(14, 'optical drive', 'ASUS', 'DVD+/-RW DRW-24D5MT', 43, 'new', NULL, NULL),
(15, 'processor', 'Intel', 'i5-11600KF', 31, 'new', NULL, '6525432ebee039.34502135.jpg'),
(16, 'processor', 'AMD', 'Ryzen 5 7600', 12, 'new', 'AM5', '65267ac802c101.55892251.png'),
(17, 'nas', 'Synology', 'DiskStation® DS923+', 3, 'new', NULL, '65267fc1d85b08.44417351.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
