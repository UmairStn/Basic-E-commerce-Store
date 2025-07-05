-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2025 at 02:47 PM
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
-- Database: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

DROP TABLE IF EXISTS `completed_orders`;
CREATE TABLE `completed_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_mobile` varchar(20) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `completed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`id`, `order_id`, `customer_name`, `customer_address`, `contact_email`, `contact_mobile`, `product_name`, `product_details`, `total_amount`, `completed_date`) VALUES
(9, 12, 'umr', 'main street, Colombo.', 'uxmr228@gmail.com', '0771234567', 'FreshWave Body Spray', '\r\n                                    Price: Rs.1799.00 × 1 units\r\n                                ', 1799.00, '2025-06-30 15:26:00'),
(10, 11, 'umr', 'Negombo', 'uxmr228@gmail.com', '0771234567', 'Velvet Matte Lipstick', '\r\n                                    Price: Rs.999.00 × 1 units\r\n                                ', 999.00, '2025-06-30 15:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_name`, `user_email`, `mobile`, `address`, `product_name`, `product_price`, `quantity`, `total_amount`, `order_date`) VALUES
(15, 'dfdfdfdfd', 'agkshayanc@gmail.com', '0771234567', 'sdsdsds233', 'LumiBright Whitening Cream', 3499.00, 1, 3499.00, '2025-07-01 04:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

DROP TABLE IF EXISTS `productdetails`;
CREATE TABLE `productdetails` (
  `product_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`product_id`, `name`, `description`, `category`, `image`, `quantity`, `price`, `created_at`) VALUES
('11', ' Radiant Glow Serum Descriptio', 'A lightweight facial serum infused with vitamin C and hyaluronic acid to brighten and deeply hydrate your skin, leaving it radiant and smooth.', 'skincare', 'https://images.unsplash.com/photo-1731599974318-97a336b9bd5f?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 2, 4999.00, '2025-07-01 04:21:31'),
('3', 'HydraBoost Moisturizer', 'An ultra-hydrating daily moisturizer enriched with aloe vera and green tea extracts to keep your skin fresh and supple.', 'skincare', 'https://plus.unsplash.com/premium_photo-1670537994863-5ad53a3214e0?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 15, 1599.00, '2025-06-30 12:43:27'),
('4', 'Shimmer & Shine Highlighter', 'A silky highlighter that gives your skin a luminous glow, perfect for enhancing cheekbones, brow bones, and décolletage.', 'makeup', 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=1187&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 25, 1899.00, '2025-06-30 12:44:22'),
('5', 'Rose Petal Lip Balm', 'A nourishing lip balm enriched with rose extract and shea butter to keep your lips soft, hydrated, and subtly tinted.', 'skincare', 'https://images.unsplash.com/file-1715714113747-b8b0561c490eimage?w=416&dpr=2&auto=format&fit=crop&q=60', 24, 899.00, '2025-06-30 14:38:21'),
('56', 'lipstick-organge', 'djsdsds', 'makeup', 'https://images.unsplash.com/photo-1731599974318-97a336b9bd5f?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 1, 100.00, '2025-07-01 04:20:18'),
('6', 'SunShield SPF 50 Sunscreen', 'A lightweight, non-greasy sunscreen that offers broad-spectrum protection against harmful UVA and UVB rays while moisturizing your skin.', 'skincare', 'https://images.unsplash.com/photo-1698912269897-c9325da81afc?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8U1BGJTIwNTAlMjBTdW5zY3JlZW4lMjBwcm9kdWN0c3xlbnwwfHwwfHx8MA%3D%3D', 29, 2999.00, '2025-06-30 14:39:08'),
('7', 'LumiBright Whitening Cream', 'A gentle whitening cream enriched with vitamin C, niacinamide, and licorice extract to visibly brighten skin tone and reduce dark spots for a radiant, even complexion.', 'makeup', 'https://images.unsplash.com/photo-1638609927040-8a7e97cd9d6a?q=80&w=765&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 29, 3499.00, '2025-06-30 14:44:16'),
('8', 'FreshWave Body Spray', 'An invigorating body spray with a clean, aquatic scent that keeps you feeling fresh and confident throughout the day.', 'makeup', 'https://images.unsplash.com/photo-1604523412953-ec5f89b57be3?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 24, 1799.00, '2025-06-30 14:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

DROP TABLE IF EXISTS `signup`;
CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `email`, `password`, `created_at`) VALUES
(5, 'u2@gamil.com', '$2y$10$4PaEVqRbiS2mC/m0YlfmP./Rovwc6ApQCNSq2th/hfP9rkB8H1CCW', '2025-07-05 12:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_code` varchar(255) NOT NULL COMMENT 'Stores hashed password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `login_code`) VALUES
(1, 'umr', 'Staff', 'umarmhd828@gmail.com', '1234'),
(3, 'umair', 'Staff', 'u1@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
