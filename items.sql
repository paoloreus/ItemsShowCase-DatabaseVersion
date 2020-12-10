-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 04:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `items`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(20) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL,
  `category` varchar(30) NOT NULL,
  `status` enum('SHOW','HIDE') NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `image2`, `image3`, `image4`, `image5`, `category`, `status`, `views`) VALUES
(1, 'Ford Mustang', '2020 model', 19200, 'ford.jpg', '', '', '', '', 'cars', 'SHOW', 0),
(2, 'Dodge Chrisler', '2020 model', 19800, 'dodge.jpg', '', '', '', '', 'cars', 'SHOW', 0),
(3, 'Samsung Galaxy', 'S10 model', 999, 'samsung.jpg', '', '', '', '', 'phones', 'SHOW', 0),
(4, 'Apple iPhone', 'iPhone 10', 1100, 'iphone.jpg', '', '', '', '', 'phones', 'SHOW', 0),
(5, 'Hugo Boss', 'Men Suit', 450, 'hugoboss.jpg', '', '', '', '', 'clothing', 'SHOW', 0),
(8, 'Adidas Shoes', 'Adidas Bouncing whatever shoes', 225, 'adidas.jpg', '', '', '', '', 'clothing', 'HIDE', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
