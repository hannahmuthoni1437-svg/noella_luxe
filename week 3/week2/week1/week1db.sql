-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 03, 2026 at 11:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `image`) VALUES
(0, 'Birkin Style Luxury Bag', 8500, 'luxury', 'birkin.jpg'),
(0, 'Premium Structured Handbag', 6200, 'luxury', 'structured.jpg'),
(0, 'Elegant Leather Tote Bag', 8200, 'luxury', 'elegant.jpg'),
(0, 'Coach Inspired Tabby Bag', 3200, 'coach', 'coach_tabby.jpg'),
(0, 'Coach teri Bag', 2500, 'coach', 'coach_teri.jpg'),
(0, 'Coach Everyday Tote', 3500, 'coach', 'coach_tote.jpg'),
(0, 'Cute Fashion Handbag', 1500, 'affordable', 'cute_bag.jpg'),
(0, 'Mini Stylish Crossbody', 1800, 'affordable', 'crossbody.jpg'),
(0, 'Trendy Party Bag ', 1800, 'affordable', 'party_bag.jpg'),
(0, 'School Backpack Black', 2000, 'affordable', 'school_black.jpg'),
(0, 'Pink School Backpack', 2200, 'school', 'school_pink.jpg'),
(0, 'Laptop School Bag', 2500, 'school', 'school_laptop.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(0, 'karanjamuthoni98@gmail.com', 'MUTHONIse43@', 'user'),
(0, '[value-2]', '[value-3]', '[value-4]'),
(0, 'maria45@gmail.com', 'Grawa@45', 'user'),
(0, 'mary56@gmail.com', 'Grace@56', 'user'),
(0, 'minmin56@gmail.com', 'xsfr', 'user'),
(0, 'vsgj@gmail', 'sxxb', 'user'),
(0, 'gracie@gmail.com', '$2y$10$DLNRzVU/iGbX/Nv2DEt5iu2pTOUJx0C7317i2vJuIP1/o7bsmu9pa', 'user'),
(0, 'mary56@gmail.com', '$2y$10$UYNJFQabNzVYPWmv/PxQSeA76o4wzQRDZKYaD0s3pbgB1mFVpjxce', 'user'),
(0, 'mary56@gmail.com', '$2y$10$aQ0lLeUvF8r7EP1E83lISOUqICVlHfKizOgVR41OqhKgYAXgT4M8a', 'user'),
(0, 'briana@gmail.com', '$2y$10$5EEuKY8NpL5CWKZrKreoiOEo0U3u2Pw5CFqNKXJwsFMiISlNK51jS', 'user'),
(0, 'lucyshinto@gmail.com', '$2y$10$vAQn09ZGXXXzc..u1UZ2JenzJsk4Gf292PHHpBeEk75UhvCALK3/W', 'user'),
(0, 'lucyshinto@gmail.com', '$2y$10$kNCZQhHOHq7VVCJUFwZSD.9uGFMJcgaRRZYLHYIMhQ9it7SBzLTVW', 'user'),
(0, 'lucyShinto@gmail.com', '$2y$10$KHr0bWIHFGjk4FmPxqpNEu2eVJnkRCQHEPY3tSHsa60iG8wvtmvGe', 'user'),
(0, 'lucyshinto@gmail.com', '$2y$10$53EMsisQyPRAPHIdwfck2.wTlaGkxBymbd2cdRjZ.KyRNEXHl2bN2', 'user'),
(0, 'lucyShinto@gmail.com', '$2y$10$uiZrsgRcY7H7n/eC/aGUHOVsWWZdteBX7fw3enYI5IoWWwd3FuPS6', 'user'),
(0, 'lucyshinto@gmail.com', '$2y$10$0WiXK0l67dA2zVr7j5A2SuRsv6PwKeDKrYoBaLdBmqqAI/uaFIaNu', 'user'),
(0, 'karanjamuthoni@gmail.com', '$2y$10$G3y5833MDI2pFD6bfvDeKeC3n4sew4WJeFTFI1TlipkdHSR33OzSi', 'user'),
(0, '[leila34@gmail.com]', '[Leila@234]', '[Admin]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
