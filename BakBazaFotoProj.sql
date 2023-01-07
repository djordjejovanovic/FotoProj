-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 07, 2023 at 04:18 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fotoproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_price` int NOT NULL,
  `item_text` varchar(255) DEFAULT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_text`, `item_image`) VALUES
(1, 'Puzzle', 750, 'Puzzle with chosen photo', 'item3.jpg'),
(3, 'Photo album', 1000, 'Photo album (100pcs)', 'item2.jpg'),
(4, 'Pillow', 1200, 'Pillow with photo', 'item5.jpg'),
(5, 'Box', 650, 'Lovely Box', 'item4.jpg'),
(6, 'Mug', 800, 'Magic mug', 'item1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(256) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_type` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_name`, `user_password`, `user_type`) VALUES
(2, 'djoleuser@gmail.com', 'DjoleUser', '592178280823b132822135b5c7dd2a21', 0),
(3, 'djoleadmin@gmail.com', 'DjoleAdmin', 'ccaf15ca63f3ddc0cd75469638230aab', 1),
(5, 'djoledsczv@gmail.com', 'Djole', '4e94e0c7698bdd836253bd6386bd2150', 0),
(6, 'djoledsczv@gmail.com', 'djoletmp', 'dd9ca4cf0e24cf3b9f73111fe541b42d', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
