-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2016 at 07:32 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `product`, `user`, `date`) VALUES
(1, 1, 1, '2016-10-14 06:28:50'),
(2, 2, 2, '2016-10-14 06:21:25'),
(3, 3, 3, '2016-10-14 07:23:25'),
(4, 1, 2, '2016-10-15 04:26:28'),
(5, 3, 5, '2016-10-15 04:27:28'),
(6, 4, 3, '2016-10-16 10:16:18'),
(7, 4, 4, '2016-10-16 09:45:24'),
(8, 5, 5, '2016-10-17 05:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `image`) VALUES
(1, 'muffins', '', 'uploads/categories/5.jpg'),
(2, 'cakes', '', 'uploads/categories/2.jpg'),
(3, 'pankakes', '', 'uploads/categories/1.jpg'),
(4, 'croassons', '', 'uploads/categories/4.jpg'),
(5, 'struddles', '', 'uploads/categories/3.jpg'),
(6, 'special offers', '', 'uploads/categories/4.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `izvestaj`
--
-- CREATE TABLE IF NOT EXISTS `izvestaj` (
-- );
-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `special` tinyint(4) NOT NULL DEFAULT '0',
  `product_code` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock`, `image`, `category_id`, `status`, `special`, `product_code`) VALUES
(1, 'chocolate muffin', 'chocolate dream!', '2,30', 1, 'uploads/products/1.jpg', 1, 1, 1, '1'),
(2, 'vanila muffin', 'creammy', '4.90', 1, 'uploads/products/2.jpg', 1, 1, 1, '2'),
(3, 'chocolate cake', 'special cake!', '5.90', 1, 'uploads/products/3.jpg', 2, 1, 1, '3'),
(4, 'pankakes', 'speacial.', '1.90', 1, 'uploads/products/4.jpg', 3, 1, 1, '4'),
(5, ' chocolate croasson', 'tasty.', '6.00', 1, 'uploads/products/5.jpg', 4, 1, 1, '5'),
(6, 'vanila croasson', 'mmm!!!', '6.90', 1, 'uploads/products/6.jpg', 4, 1, 1, '6'),
(7, 'strowbery croasson', 'special!', '5.00', 1, 'uploads/products/7.jpg', 4, 1, 1, '7'),
(8, 'fruit cake', 'healthy', '4.90', 1, 'uploads/products/8.jpg', 2, 1, 1, '8'),
(9, 'vanila cake', 'good as always', '2.00', 1, 'uploads/products/9.jpg', 2, 1, 1, '9'),
(10, 'cockies', 'mmm', '6.00', 1, 'uploads/products/10.jpg', 6, 1, 1, '10'),
(11, 'cherry struddles', 'mmm', '4.90', 1, 'uploads/categories/3.jpg', 5, 1, 1, '11'),
(19, 'croasson with pankakes', 'Strava proizvod!', '4.00', 1, 'uploads/products/12.jpg', 4, 1, 1, '12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_surname` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `user_status`) VALUES
(1, 'Milos', 'Milosevic', 'misa@misa.com', 'b201272a7344411b1dd09d7b8a3f25b3', 1),
(2, 'Pera', 'Peric', 'pera@pera.com', 'd8795f0d07280328f80e59b1e8414c49', 2),
(3, 'Nikola', 'Nikolic', 'nikola@nikola.com', '9365ea12b2d910e1aceaac190fbc97a5', 2),
(4, 'Marija', 'Maric', 'marija@marija.com', 'cb74c183402afe708a490f0048af6e41', 2),
(5, 'Mile', 'Milic', 'mile@mile.com', 'ea08e678edbf8892b8d67fc36f4a3bf9', 2),
(6, 'Laza', 'Lazic', 'laza@laza.com', '767fdd322137520a943c56285f51953f', 3),
(7, 'Nikola', 'Nikolic', 'nikola@nikola.com', '9365ea12b2d910e1aceaac190fbc97a5', 3);

-- --------------------------------------------------------

--
-- Structure for view `izvestaj`
--
DROP TABLE IF EXISTS `izvestaj`;
-- in use(#1356 - View 'proteinshop.izvestaj' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
