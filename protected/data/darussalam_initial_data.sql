
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2013 at 03:02 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `darussalam`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) NOT NULL,
  PRIMARY KEY (`author_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`) VALUES
(2, 'zahid nadeem'),
(3, 'Ubaid'),
(4, 'Talha');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `user_id`, `city_id`, `quantity`, `added_date`, `session_id`) VALUES
(2, 3, 3, 1, 1, '1366347453', ''),
(3, 5, 3, 2, 10, '1366347462', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_id` (`category_id`),
  KEY `category_id_2` (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `city_id` (`city_id`),
  KEY `city_id_2` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `added_date`, `parent_id`, `city_id`) VALUES
(1, 'Books', '25-03-2013', 0, 1),
(2, 'Books', '25-03-2013', 0, 1),
(3, 'Ahadees', '1364464356', 2, 1),
(4, 'Madni', '28-03-2013', 3, 1),
(5, 'Maki', '28-03-2013', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `api_username` varchar(255) NOT NULL,
  `api_password` varchar(255) NOT NULL,
  `api_signature` varchar(255) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `city_id` (`city_id`),
  KEY `layout_id` (`layout_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `city_name`, `short_name`, `address`, `layout_id`, `api_username`, `api_password`, `api_signature`) VALUES
(1, 1, 'Lahore', 'lhr', 'STR lahore', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(2, 1, 'Karachi', 'kc', 'nazim abad', 2, 'ubaidullah-facilitator_api1.darussalampk.com', '1366182478', 'Aapaqm6ans4WJekg4.XfJgGjSuI5A6JoJ-0wPCJBJcNA.zUb7O3t19LN'),
(3, 2, 'New York', 'ny', 'stc ny 5400', 3, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(4, 3, 'London', 'ln', 'london street 7 gulbarb 2', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(5, 4, 'Riyadh', 'ria', 'Riyadh soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(6, 4, 'Mecca', 'mec', 'Mecca soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(7, 4, 'Jeddah', 'jed', 'jeddah soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(8, 4, 'Medina', 'med', 'Medina soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(9, 4, 'Dammam', 'dam', 'Dammam soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(10, 4, 'Khobar', 'kho', 'Khobar soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(11, 4, 'Al-Ahsa', 'al-ahsa', '	Al-Ahsa soudi arabia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(12, 5, 'Bogota', 'bog', 'Bogota colombia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(13, 5, 'Medellin', 'mdl', 'Medell?n colombia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(14, 5, 'Cali', 'cali', 'Cali colombia', 1, 'zahid.nadeem-facilitator_api1.darussalampk.com', '1366199236', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AsZ74UA0FGC.aXRCRZeTDD1bRWiS'),
(15, 6, 'bejing', 'bej', 'abjd', 2, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `site_id` int(11) NOT NULL,
  PRIMARY KEY (`country_id`),
  KEY `country_id` (`country_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `short_name`, `site_id`) VALUES
(1, 'Pakistan', 'pk', 1),
(2, 'United States', 'US', 1),
(3, 'United Kingdom', 'uk', 1),
(4, 'Saudi Arabia', 'ksa', 1),
(5, 'Colombia', 'col', 1),
(6, 'Chaina', 'cha', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kemail_queue`
--

DROP TABLE IF EXISTS `kemail_queue`;
CREATE TABLE IF NOT EXISTS `kemail_queue` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `priority` int(1) NOT NULL DEFAULT '5',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `from` varchar(500) NOT NULL,
  `to` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `body` longtext NOT NULL,
  `additional_headers` longtext,
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) NOT NULL,
  PRIMARY KEY (`language_id`),
  KEY `language_id` (`language_id`),
  KEY `language_id_2` (`language_id`),
  KEY `language_id_3` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `language_name`) VALUES
(2, 'English'),
(3, 'Arabic');

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

DROP TABLE IF EXISTS `layout`;
CREATE TABLE IF NOT EXISTS `layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_name` varchar(255) NOT NULL,
  `layout_description` varchar(255) NOT NULL,
  `layout_color` varchar(255) NOT NULL,
  `site_id` int(11) NOT NULL,
  PRIMARY KEY (`layout_id`),
  UNIQUE KEY `layout_id_2` (`layout_id`),
  KEY `layout_id` (`layout_id`),
  KEY `site_id` (`site_id`),
  KEY `site_id_2` (`site_id`),
  KEY `site_id_3` (`site_id`),
  KEY `layout_id_3` (`layout_id`),
  KEY `site_id_4` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`layout_id`, `layout_name`, `layout_description`, `layout_color`, `site_id`) VALUES
(1, 'default', 'default', 'black', 1),
(2, 'classic', 'Classic theme', 'purple', 1),
(3, 'dtech', 'dtech theme', 'black', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `added_date` varchar(255) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,4) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_id` (`order_id`),
  KEY `customer_id` (`user_id`),
  KEY `order_id_2` (`order_id`),
  KEY `customer_id_2` (`user_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `total_price`, `order_date`) VALUES
(1, 3, 123.0000, '2013-04-18'),
(2, 3, 123.0000, '2013-04-18'),
(3, 3, 90.0000, '2013-04-18'),
(4, 3, 90.0000, '2013-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `user_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `total_price` decimal(10,4) NOT NULL,
  PRIMARY KEY (`user_order_id`),
  KEY `customer_order_id` (`user_order_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_order_id` (`user_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `is_featured` enum('0','1') NOT NULL,
  `product_price` decimal(10,4) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`city_id`),
  KEY `user_id_2` (`city_id`),
  KEY `product_id` (`product_id`),
  KEY `product_id_2` (`product_id`),
  KEY `user_id_3` (`city_id`),
  KEY `frenchise_id` (`city_id`),
  KEY `frenchise_id_2` (`city_id`),
  KEY `city_id` (`city_id`),
  KEY `product_id_3` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `city_id`, `added_date`, `is_featured`, `product_price`) VALUES
(1, 'Life Of Abu Baker Sidique (RA)', 'Life of abu baker sidique RA in Urdu', 1, '27-03-2013', '1', 123.0000),
(2, 'Golden Stories Of Abu Baker Sidique (RA)', 'Some Golden stories from life of Hazrat Abu Baker Siddique RA.', 1, '27-03-2013', '1', 90.0000),
(3, 'Ibn Ul Khitab (RA)', 'About life of Umer ibn ul khitab (RA)', 1, '27-03-2013', '1', 33.0000),
(4, 'Sayedana Umer''s Life', 'About life of umer farooq RA', 2, '27-03-2013', '1', 76.0000),
(5, 'The Sealed Necter', 'The sealed nector is islamic book', 2, '27-03-2013', '1', 123.0000),
(6, 'Golden Stories Of Abu Baker Sidique (RA)', 'Golden Stories Of Abu Baker Sidique (RA)', 2, '27-03-2013', '1', 100.0000);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_category_id`),
  KEY `category_id` (`category_id`),
  KEY `product_id` (`product_id`),
  KEY `product_category_id` (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_category_id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

DROP TABLE IF EXISTS `product_discount`;
CREATE TABLE IF NOT EXISTS `product_discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `discount_type` enum('fixed','percentage') NOT NULL,
  `discount_value` decimal(10,4) NOT NULL,
  PRIMARY KEY (`discount_id`),
  KEY `discount_id` (`discount_id`),
  KEY `discount_id_2` (`discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_small` varchar(255) NOT NULL,
  `image_large` varchar(255) NOT NULL,
  PRIMARY KEY (`product_image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image_small`, `image_large`) VALUES
(1, 1, 'abu_baker_sidique_small.jpg', 'abu_baker_sidique_large.jpg'),
(2, 2, 'goden_stories_abu_baker_sidique_small.jpg', 'goden_stories_abu_baker_sidique_large.jpg'),
(3, 3, 'Ibn_ul_khitab_large.jpg', 'Ibn_ul_khitab_large.jpg'),
(4, 4, 'sayedna_umer_life_small.jpg', 'sayedna_umer_life_large.jpg'),
(5, 5, 'the_sealed_necter_small.jpg', 'the_sealed_necter_large.jpg'),
(6, 6, 'goden_stories_abu_baker_sidique_small.jpg', 'goden_stories_abu_baker_sidique_large.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_language`
--

DROP TABLE IF EXISTS `product_language`;
CREATE TABLE IF NOT EXISTS `product_language` (
  `product_language_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`product_language_id`),
  KEY `product_id` (`product_id`),
  KEY `language_id` (`language_id`),
  KEY `language_id_2` (`language_id`),
  KEY `language_id_3` (`language_id`),
  KEY `product_id_2` (`product_id`),
  KEY `language_id_4` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_language`
--

INSERT INTO `product_language` (`product_language_id`, `product_id`, `language_id`) VALUES
(1, 1, 3),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_profile`
--

DROP TABLE IF EXISTS `product_profile`;
CREATE TABLE IF NOT EXISTS `product_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `profile_id` (`profile_id`),
  KEY `author_id` (`author_id`),
  KEY `profile_id_2` (`profile_id`),
  KEY `author_id_2` (`author_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_profile`
--

INSERT INTO `product_profile` (`profile_id`, `product_id`, `author_id`, `isbn`) VALUES
(1, 1, 2, '546546-654-14');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reviews` text NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `is_approved` enum('yes','no') NOT NULL,
  `is_email` tinyint(1) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`reviews_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id_2` (`product_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`reviews_id`, `product_id`, `user_id`, `reviews`, `added_date`, `is_approved`, `is_email`, `rating`) VALUES
(1, 1, 3, 'dfdf', '1366632961', 'yes', 0, 5),
(2, 1, 3, 'asdf', '1366632966', 'yes', 0, 2),
(3, 2, 3, 'dfdf', '1366632978', 'yes', 0, 3),
(4, 1, 3, 'dd', '1366633056', 'yes', 0, 3),
(5, 2, 3, 'dd', '1366633171', 'yes', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL,
  `site_descriptoin` varchar(255) NOT NULL,
  `site_headoffice` int(11) NOT NULL,
  PRIMARY KEY (`site_id`),
  KEY `site_id` (`site_id`),
  KEY `site_id_2` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`site_id`, `site_name`, `site_descriptoin`, `site_headoffice`) VALUES
(1, 'darussalam', 'darussalam', 1),
(2, 'yahoo.com', 'abc', 15);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
CREATE TABLE IF NOT EXISTS `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yiiuser` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `provideruser` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `yiiuser`, `provider`, `provideruser`) VALUES
(1, 4, 'facebook', '100000456873660'),
(2, 5, 'google', '101970047434735800356');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL COMMENT '1 for active 0 for disabled',
  `city_id` int(11) DEFAULT NULL,
  `activation_key` varchar(255) DEFAULT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `site_id` int(11) NOT NULL,
  `join_date` varchar(222) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`),
  KEY `user_id_3` (`user_id`),
  KEY `frenchise_id` (`city_id`),
  KEY `frenchise_id_2` (`city_id`),
  KEY `user_id_4` (`user_id`),
  KEY `city_id` (`city_id`),
  KEY `site_id` (`site_id`),
  KEY `role_id` (`role_id`),
  KEY `status_id` (`status_id`),
  KEY `role_id_2` (`role_id`),
  KEY `status_id_2` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_email`, `role_id`, `status_id`, `city_id`, `activation_key`, `is_active`, `site_id`, `join_date`, `social_id`) VALUES
(1, '', '1b3231655cebb7a1f783eddf27d254ca', 'super@yahoo.com', 1, 1, 1, '1', 'active', 1, '28 March, 2013', ''),
(2, '', '21232f297a57a5a743894a0e4a801fc3', 'admin@yahoo.com', 2, 1, 1, '', 'active', 1, '', ''),
(3, '', '91ec1f9324753048c0096d036a694f86', 'customer@yahoo.com', 3, 1, 1, '1', 'active', 1, '', ''),
(4, '', '21232f297a57a5a743894a0e4a801fc3', 'zahidiubb@yahoo.com', 3, 1, NULL, 'd3c9aad03688a6f6e764cfad6ba538d24fc6bda7', 'inactive', 1, '', '100000456873660');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `gender` varchar(123) NOT NULL,
  `city` varchar(123) NOT NULL,
  PRIMARY KEY (`user_profile_id`),
  KEY `customer_id` (`user_profile_id`),
  KEY `user_id` (`user_id`),
  KEY `user_profile_id` (`user_profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_profile_id`, `user_id`, `first_name`, `last_name`, `address`, `contact_number`, `gender`, `city`) VALUES
(1, 1, 'super', 'admin', 'STC lahore', '03336566326', '', ''),
(2, 2, 'sub', 'admin', 'abc', '', '', ''),
(3, 3, 'Richard', 'Arnold', 'abc', '', '', ''),
(4, 4, 'Zahid', 'Nadeem', 'Bahawalpur', '', 'male', ''),
(27, 3, 'dd', 'sdf', 'df', '3333333333', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`),
  KEY `role_id` (`role_id`),
  KEY `role_id_2` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_title`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `user_id` int(11) NOT NULL COMMENT 'refer to your user id on your application',
  `hybridauth_session` text NOT NULL COMMENT 'will contain the hybridauth session data',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_title` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`),
  KEY `status_id` (`status_id`),
  KEY `status_id_2` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`status_id`, `status_title`) VALUES
(0, 'inactive'),
(1, 'active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `city_ibfk_2` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`layout_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `country_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `layout`
--
ALTER TABLE `layout`
  ADD CONSTRAINT `layout_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_language`
--
ALTER TABLE `product_language`
  ADD CONSTRAINT `product_language_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_language_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_profile`
--
ALTER TABLE `product_profile`
  ADD CONSTRAINT `product_profile_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_profile_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`site_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `user_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;