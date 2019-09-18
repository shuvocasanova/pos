-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 03:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `date`) VALUES
(1, 'Tablets', '2019-09-05 07:18:15'),
(2, 'Creams', '2019-09-05 07:18:15'),
(5, 'Shampoo', '2019-09-18 12:00:55'),
(6, 'Soap', '2019-09-18 12:01:06'),
(7, 'Tooth Paste', '2019-09-18 12:01:18'),
(8, 'Face Wash', '2019-09-18 12:01:31'),
(9, 'Lotion', '2019-09-18 12:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_document` int(11) NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `total_purchase` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `last_purchase` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `id_document`, `phone`, `address`, `total_purchase`, `due`, `last_purchase`, `date`) VALUES
(2, 'Shuvo Das', 1234578, '01767057140', 'Chelopara, Bogura', 311, 499, 0, '2019-09-17 08:20:52'),
(3, 'Don Das', 154, '01755206743', 'Chelopara, Bogura', 129, 500, 0, '2019-09-18 11:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL,
  `buying_price` float NOT NULL,
  `selling_price` float NOT NULL,
  `sales` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `code`, `name`, `image`, `stock`, `buying_price`, `selling_price`, `sales`, `date`) VALUES
(42, 1, '101', 'Ranidin 150mg', '', 0, 2, 2.8, 66, '2019-09-18 12:04:32'),
(44, 1, '102', 'Seclo 40mg', '', 2, 4.2, 5.04, 209, '2019-09-18 12:04:39'),
(45, 1, '103', 'Napa', '', 31, 2.9, 4.06, 45, '2019-09-18 12:03:58'),
(46, 1, '104', 'Seclo 40mg', '', 137, 4, 5, 377, '2019-09-18 12:03:58'),
(47, 1, '105', 'Napa Extra', '', 40, 1.5, 2.1, 13, '2019-09-18 12:03:58'),
(48, 1, '106', 'LevoCartinine', '', 97, 4, 5, 49, '2019-09-18 12:03:59'),
(49, 1, '107', 'Rani 20', '', 33, 2, 2.8, 22, '2019-09-18 12:03:59'),
(50, 1, '108', 'Rabe 20', '', 53, 4, 5.6, 70, '2019-09-18 12:03:59'),
(51, 1, '109', 'Oil', '', 39, 3, 4.2, 15, '2019-09-18 12:03:59'),
(52, 1, '110', 'Max 20', '', 227, 12, 16.8, 15, '2019-09-18 12:03:59'),
(53, 1, '111', 'Xtra', '', 552, 4, 5.6, 2, '2019-09-18 12:03:59'),
(54, 1, '112', 'Fan', '', 560, 5, 7, 2, '2019-09-18 12:03:59'),
(55, 5, '501', 'Mistine Royal Jelly Shampoo 500ml', '', 30, 120, 168, 20, '2019-09-18 12:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idSeller` int(11) NOT NULL,
  `products` text NOT NULL,
  `discount` float NOT NULL,
  `netPrice` float NOT NULL,
  `totalPrice` float NOT NULL,
  `totalPaid` float NOT NULL,
  `due` float NOT NULL,
  `saledate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `idCustomer`, `idSeller`, `products`, `discount`, `netPrice`, `totalPrice`, `totalPaid`, `due`, `saledate`) VALUES
(19, 10001, 2, 1, '[{\"id\":\"42\",\"name\":\"Ranidin 150mg\",\"quantity\":\"9\",\"stock\":\"1\",\"price\":\"2.8\",\"totalPrice\":\"25.2\"}]', 2.52, 25.2, 22.68, 23, -0.32, '2019-09-17 08:02:09'),
(20, 10002, 3, 1, '[{\"id\":\"45\",\"name\":\"Napa\",\"quantity\":\"10\",\"stock\":\"34\",\"price\":\"4.06\",\"totalPrice\":\"40.599999999999994\"},{\"id\":\"46\",\"name\":\"Seclo 40mg\",\"quantity\":\"10\",\"stock\":\"160\",\"price\":\"5\",\"totalPrice\":\"50\"}]', 0, 90.6, 90.6, 90, 0.6, '2019-09-17 08:20:07'),
(21, 10003, 2, 1, '[{\"id\":\"45\",\"name\":\"Napa\",\"quantity\":\"1\",\"stock\":\"33\",\"price\":\"4.06\",\"totalPrice\":\"4.06\"},{\"id\":\"46\",\"name\":\"Seclo 40mg\",\"quantity\":\"1\",\"stock\":\"159\",\"price\":\"5\",\"totalPrice\":\"5\"}]', 1.812, 9.06, 7.248, 6, 1.248, '2019-09-17 08:20:22'),
(22, 10004, 3, 1, '[{\"id\":\"49\",\"name\":\"Rani 20\",\"quantity\":\"10\",\"stock\":\"35\",\"price\":\"2.8\",\"totalPrice\":\"28\"},{\"id\":\"48\",\"name\":\"LevoCartinine\",\"quantity\":\"1\",\"stock\":\"99\",\"price\":\"5\",\"totalPrice\":\"5\"}]', 0.66, 33, 32.34, 30, 2.34, '2019-09-17 08:20:37'),
(23, 10005, 2, 1, '[{\"id\":\"46\",\"name\":\"Seclo 40mg\",\"quantity\":\"20\",\"stock\":\"139\",\"price\":\"5\",\"totalPrice\":\"100\"}]', 2, 100, 98, 90, 8, '2019-09-17 08:20:52'),
(24, 10006, 3, 1, '[{\"id\":\"42\",\"name\":\"Ranidin 150mg\",\"quantity\":\"1\",\"stock\":\"0\",\"price\":\"2.8\",\"totalPrice\":\"2.8\"},{\"id\":\"44\",\"name\":\"Seclo 40mg\",\"quantity\":\"1\",\"stock\":\"2\",\"price\":\"5.04\",\"totalPrice\":\"5.04\"},{\"id\":\"45\",\"name\":\"Napa\",\"quantity\":\"1\",\"stock\":\"32\",\"price\":\"4.06\",\"totalPrice\":\"4.06\"},{\"id\":\"46\",\"name\":\"Seclo 40mg\",\"quantity\":\"1\",\"stock\":\"138\",\"price\":\"5\",\"totalPrice\":\"5\"},{\"id\":\"47\",\"name\":\"Napa Extra\",\"quantity\":\"1\",\"stock\":\"41\",\"price\":\"2.1\",\"totalPrice\":\"2.1\"},{\"id\":\"49\",\"name\":\"Rani 20\",\"quantity\":\"1\",\"stock\":\"34\",\"price\":\"2.8\",\"totalPrice\":\"2.8\"},{\"id\":\"48\",\"name\":\"LevoCartinine\",\"quantity\":\"1\",\"stock\":\"98\",\"price\":\"5\",\"totalPrice\":\"5\"},{\"id\":\"50\",\"name\":\"Rabe 20\",\"quantity\":\"1\",\"stock\":\"54\",\"price\":\"5.6\",\"totalPrice\":\"5.6\"},{\"id\":\"51\",\"name\":\"Oil\",\"quantity\":\"1\",\"stock\":\"40\",\"price\":\"4.2\",\"totalPrice\":\"4.2\"},{\"id\":\"52\",\"name\":\"Max 20\",\"quantity\":\"1\",\"stock\":\"228\",\"price\":\"16.8\",\"totalPrice\":\"16.8\"},{\"id\":\"54\",\"name\":\"Fan\",\"quantity\":\"1\",\"stock\":\"561\",\"price\":\"7\",\"totalPrice\":\"7\"},{\"id\":\"53\",\"name\":\"Xtra\",\"quantity\":\"1\",\"stock\":\"553\",\"price\":\"5.6\",\"totalPrice\":\"5.6\"},{\"id\":\"55\",\"name\":\"Mistine Royal Jelly Shampoo 500ml\",\"quantity\":\"20\",\"stock\":\"30\",\"price\":\"168\",\"totalPrice\":\"3360\"}]', 10, 3426, 3083.4, 3084, -0.6, '2019-09-18 12:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `picture` text NOT NULL,
  `status` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `profile`, `picture`, `status`, `last_login`, `date`) VALUES
(1, 'Admin', 'admin', 'admin', 'Administrator', '', 1, '2019-09-03 21:16:27', '2019-09-03 20:17:11'),
(3, 'shuvo', 'shuvosk', 'shuvo123', 'administrator', '', 0, '2019-09-03 21:16:27', '2019-09-02 00:22:58'),
(4, 'Shuvo', 'shuvosk', '1234', 'administrator', '', 0, '2019-09-03 21:16:27', '2019-09-03 19:44:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
