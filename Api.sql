-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2017 at 01:20 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'first cat', 'image path', '2017-08-23 10:04:32', NULL),
(2, 'second cat', 'image path', '2017-08-23 10:04:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`) VALUES
(1, 'Mansoura', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'comment comment', 1, 1, '2017-08-23 11:42:35', NULL),
(2, 'comment2', 1, 1, '2017-08-23 11:49:00', NULL),
(3, 'comment api', 1, 1, '2017-08-23 10:45:11', '2017-08-23 10:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `user_id`, `status`, `image`, `description`, `unit_id`, `created_at`, `updated_at`) VALUES
(1, 'Name', 10, 1, 2, 2, 'http://localhost:8000/assets/img/user.jpg', 'desc', 1, '2017-08-23 09:20:54', '2017-09-10 12:16:04'),
(2, 'Name', 54, 1, 7, 2, 'http://localhost:8000/assets/img/user.jpg', 'desc', 1, '2017-08-23 09:21:12', '2017-09-05 12:25:39'),
(3, 'Name', 54, 1, 7, 2, 'http://localhost:8000/assets/img/user.jpg', 'desc', 1, '2017-08-23 09:22:21', '2017-09-10 11:42:09'),
(4, 'Name', 54, 1, 3, 2, 'http://localhost:8000/assets/img/user.jpg', 'desc', 1, '2017-08-23 09:22:37', '2017-09-07 07:15:29'),
(5, 'Name', 54, 1, 1, 3, 'http://localhost:8000/assets/img/user.jpg', 'desc', 1, '2017-08-23 10:34:58', '2017-09-10 12:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Egypt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `token`, `name`, `email`, `password`, `status`, `image`, `phone`, `is_admin`, `city_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '123456789', 'Elsayed', 'elsayed@yahoo.com', '$2y$10$pqCmAtLWRR3mb4MOmoSvi.FvMzVaa13Y7hSYy3EXp2XhXoUZoiKoe', 1, 'http://localhost:8000/assets/img/user.jpg', '01068379284', 0, 1, 'DcTFbk5UIPnez31sWm1wyErw9FPzq4GOsd8xbwMpoMQrF4pibhhM88O4kXov', '2017-08-23 09:36:13', NULL),
(2, '86935866136352', 'Elsayed Ahmed', '', '123456', 2, 'http://localhost:8000/assets/img/user.jpg', '012222222', 1, 1, '', '2017-08-23 12:31:33', '2017-09-10 12:22:39'),
(3, '88322826411351', 'Elsayed Ahmed', '', '123456', 1, 'http://localhost:8000/assets/img/user.jpg', '0122222228', 1, 1, '', '2017-08-23 12:33:52', '2017-08-23 12:33:52'),
(4, '88776167442612', 'Elsayed Ahmed', '', '123456', 2, 'http://localhost:8000/assets/img/user.jpg', '01282222228', 1, 1, '', '2017-08-23 12:34:37', '2017-09-06 06:14:32'),
(5, '89261656582662', 'Elsayed Ahmed', '', '123456', 1, 'http://localhost:8000/assets/img/user.jpg', '0128222228828', 0, 1, '', '2017-08-23 12:35:26', '2017-08-23 12:35:26'),
(6, '09787275582131', 'xyz', 'sss@dd.d', '$2y$10$N13jOyNgwUa9MJbkQuXSSOz/lKJMSQYR4HETtpoOdQDLsJxXF9y/.', 1, 'http://localhost:8000/assets/img/user.jpg', 'sss@dd.d', 1, NULL, '', '2017-09-06 07:42:58', '2017-09-06 07:42:58'),
(7, '23053683345274', 'Elsayed', 'eee@ff.f', '$2y$10$QuzD.oRqY24oFmAJOEZUz.CIzUO6ivHUppGV3kQht4Q2JO.yW..rK', 3, 'http://localhost:8000/assets/img/user.jpg', 'eee@ff.f', 1, NULL, '', '2017-09-06 08:05:05', '2017-09-10 12:12:03'),
(8, '24291538135675', 'Elsayed', 'elsayed@yahoo.com', '$2y$10$WWiziewxU6e/dcgREAHHZuqutpgPy1TNfTfVT.z.1I02igGd/TUMG', 1, 'http://localhost:8000/assets/img/user.jpg', 'eee@ff.fe', 1, NULL, '', '2017-09-06 08:07:09', '2017-09-06 08:07:09'),
(9, '39512668642424', 'Alaa', 'alaa@yahoo.com', '$2y$10$nic5j3wvtpFm43nEhvkTvOctZI1nqluLuCxWYS0FkaMTSKj0/PTrK', 1, NULL, '01063548524', 1, NULL, NULL, '2017-09-10 12:32:31', '2017-09-10 12:32:31'),
(10, '81163548523246', 'string', '', 'string', 1, 'http://localhost:8000/assets/images/users/59b66eb446b4d.png', 'string', 0, 1, NULL, '2017-09-11 09:08:36', '2017-09-11 09:08:36'),
(11, '89316642468223', 'Ahmed', '', 'string', 1, 'http://localhost:8000/assets/images/users/59b671e40db03.png', '0125454545', 0, 1, NULL, '2017-09-11 09:22:12', '2017-09-11 09:22:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
