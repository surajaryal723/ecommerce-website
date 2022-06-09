-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2022 at 06:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronics_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `action` varchar(10) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `product_id`, `action`, `created_on`) VALUES
(22, 42, 'Deleted', '2022-03-17'),
(23, 43, 'Deleted', '2022-03-17'),
(24, 44, 'Inserted', '2022-03-17'),
(25, 45, 'Inserted', '2022-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `full_name`, `username`, `password`) VALUES
(1237375, 'Suraj Aryal', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `title`, `image_name`, `featured`, `active`) VALUES
(62, 'laptops', 'Product_Category_586.jpg', 'Yes', 'Yes'),
(63, 'mobiles', 'Product_Category_319.jpg', 'Yes', 'Yes'),
(64, 'cameras', 'Product_Category_410.jpg', 'Yes', 'Yes'),
(65, 'camera', 'Product_Category_725.jpg', 'Yes', 'Yes'),
(66, 'headphones', 'Product_Category_668.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `product_id`, `user_id`, `customer_name`, `customer_contact`, `customer_email`, `product_name`, `price`, `quantity`, `total`, `order_date`, `status`, `address`) VALUES
(46, 39, 44, 'Suraj Aryal', '+919336191489', 'aryalsuraj723@gmail.com', 'iphone', '232000.00', 1, '232000.00', '2022-02-06 04:17:09', 'Delivered', 'bangalore'),
(47, 39, 44, 'Suraj Aryal', '+919336191489', 'aryalsuraj723@gmail.com', 'iphone', '232000.00', 1, '232000.00', '2022-02-07 11:33:35', 'Delivered', 'bangalore'),
(48, 44, 44, 'Suraj Aryal', '+919336191489', 'aryalsuraj723@gmail.com', 'asus', '49999.00', 1, '49999.00', '2022-03-26 06:09:05', 'On Delivery', 'bangalore\r\n'),
(49, 44, 44, 'Suraj Aryal', '+919336191489', 'aryalsuraj723@gmail.com', 'asus', '49999.00', 1, '49999.00', '2022-03-28 09:20:25', 'Cancelled', 'bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(44, 'asus', 'gaming phone', '49999.00', 'Product-5565.jpg', 63, 'Yes', 'Yes'),
(45, 'macbook', 'a coding laptop', '92999.00', 'Product-8205.jpg', 62, 'Yes', 'Yes');

--
-- Triggers `tbl_product`
--
DELIMITER $$
CREATE TRIGGER `deleteTrigger` BEFORE DELETE ON `tbl_product` FOR EACH ROW INSERT INTO logs VALUES(null,OLD.product_id,'Deleted',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertTrigger` AFTER INSERT ON `tbl_product` FOR EACH ROW INSERT INTO logs VALUES(null,NEW.product_id,'Inserted',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateTrigger` AFTER UPDATE ON `tbl_product` FOR EACH ROW INSERT INTO logs VALUES(null,NEW.product_id,'Updated',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Contact` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `Fullname`, `Contact`, `Email`, `Password`) VALUES
(44, 'Suraj Aryal', '+919336191489', 'aryalsuraj723@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Contact` (`Contact`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1237381;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
