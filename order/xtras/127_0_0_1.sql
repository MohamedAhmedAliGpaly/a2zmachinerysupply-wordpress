-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2016 at 07:42 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a2zmachinerysupply`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `ip_address`, `product_id`) VALUES
(6, '::1', 8),
(7, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `category_slug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`) VALUES
(7, 'Bearing Accessories', 'bearing_accessories'),
(8, 'Tools Accessories', 'tools_accessories'),
(12, '1', '1'),
(13, '2', '2'),
(14, '3', '3'),
(16, '555', '555'),
(17, '55', '55'),
(18, '32', '32');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `oder_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_quantity` varchar(45) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`oder_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  `short_description` text,
  `brand` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `image_1` varchar(45) DEFAULT NULL,
  `image_2` varchar(45) DEFAULT NULL,
  `image_3` varchar(45) DEFAULT NULL,
  `size` varchar(25) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `min_order_qty` varchar(45) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `sub_category_id`, `item_name`, `short_description`, `brand`, `country`, `price`, `image_1`, `image_2`, `image_3`, `size`, `color`, `weight`, `min_order_qty`, `created_at`, `updated_at`) VALUES
(16, 7, 1, '6205', 'orginal', 'ntn', 'japan', '2200', '', '', '', '50', 'red', '2', '1', '2016-05-20 06:08 AM', '2016-05-20 06:08 AM'),
(18, 17, 2, '6', '6', '6', '6', '2', '', '', '', '25', '25', '33', '2', '2016-06-12 06:08 PM', '2016-06-12 06:08 PM');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE IF NOT EXISTS `quotation_details` (
  `quotation_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `product_description` varchar(45) DEFAULT NULL,
  `quantity_unit` varchar(45) DEFAULT NULL,
  `expected_price` varchar(10) DEFAULT NULL,
  `quoted_price` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`quotation_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `quotation_details`
--

INSERT INTO `quotation_details` (`quotation_detail_id`, `quotation_id`, `product_description`, `quantity_unit`, `expected_price`, `quoted_price`) VALUES
(23, 1, 'BALL BEARING 6205 ZZ NTN JAPAN', '5', '', NULL),
(24, 1, 'ROLLER BEARING 30307 SKF FRANCH', '2', '650', NULL),
(25, 2, 'DEEP GROOVE BALL BEARING 6005 2RS SKF', '5', '340', NULL),
(27, 3, 'PRESSURE SWITCH 4'' WATER FLOW', '3', '600', '750'),
(28, 4, 'RANCH SHELAI 1/2''', '5', '400', '670'),
(29, 5, '1', '1', '', NULL),
(30, 6, '25', '25', '110', '120'),
(31, 7, '6205 ZZ BALL BEARING', '2', '105', '150'),
(32, 8, '1', '1', '1', NULL),
(46, 2, '2', '2', '2', NULL),
(47, 2, '3', '3', '3', NULL),
(48, 8, '520', '3', '', NULL),
(50, 10, '66', '6', '6', NULL),
(55, 12, '1', '1', '1', '55'),
(58, 12, '4', '4', '4', '55');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE IF NOT EXISTS `quotations` (
  `quotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`quotation_id`, `created_at`, `updated_at`, `status`, `user_id`) VALUES
(1, '2016-05-05 07:02 AM', '2016-05-05 07:02 AM', 'canceled', 1),
(2, '2016-05-05 07:04 AM', '2016-05-05 07:04 AM', 'canceled', 1),
(3, '2016-05-05 07:04 AM', '2016-05-05 07:04 AM', 'processing', 1),
(4, '2016-05-05 07:06 AM', '2016-05-05 07:06 AM', 'canceled', 1),
(5, '2016-05-09 06:46 PM', '2016-05-09 06:46 PM', 'canceled', 4),
(6, '2016-05-09 06:54 PM', '2016-05-09 06:54 PM', 'processing', 1),
(7, '2016-05-18 04:50 PM', '2016-05-18 04:50 PM', 'processing', 5),
(8, '2016-05-20 06:18 AM', '2016-05-20 06:18 AM', 'processing', 1),
(9, NULL, NULL, 'completed', 1),
(10, '2016-06-12 04:26 PM', '2016-06-12 04:26 PM', 'processing', 9),
(11, '2016-06-12 04:26 PM', '2016-06-12 04:26 PM', 'processing', 8),
(12, '2016-06-12 05:05 PM', '2016-06-12 05:05 PM', 'processing', 8);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_name` varchar(45) DEFAULT NULL,
  `sub_category_slug` varchar(45) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_category_id`, `category_id`, `sub_category_name`, `sub_category_slug`, `rank`) VALUES
(22, 12, '5', '5', 1),
(30, NULL, NULL, '', NULL),
(31, NULL, NULL, '', NULL),
(32, NULL, NULL, '', NULL),
(33, NULL, NULL, '', NULL),
(34, NULL, NULL, '', NULL),
(35, NULL, NULL, '', NULL),
(36, NULL, NULL, '', NULL),
(37, NULL, NULL, '', NULL),
(38, NULL, NULL, '', NULL),
(39, 7, 'Love you', 'love_you', NULL),
(40, 8, 'Sey Moli', 'sey_moli', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) DEFAULT NULL,
  `company_address` varchar(45) DEFAULT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `ip_address` varchar(20) NOT NULL,
  `user_agent` text NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `company_name`, `company_address`, `web_url`, `name`, `email`, `password`, `phone`, `mobile`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(8, 'Efty International', 'Bangladesh', '123@inter.com', 'Efty', 'masudrk2015@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '123456789', '01676717945', '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', '2016-06-12 03:40 PM', '2016-06-12 03:42 PM'),
(9, 'Masud International', 'Dhaka', 'masud.com', 'Masud', 'masud@sbh.com', 'c4ca4238a0b923820dcc509a6f75849b', '7164956', '01770520203', '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', '2016-06-12 03:40 PM', '2016-06-12 03:41 PM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
