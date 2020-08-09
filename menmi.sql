-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 09, 2020 at 08:44 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL,
  `order` varchar(45) DEFAULT '100',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'AliceBlue', 'F0F8FF', NULL, 0, '2020-01-11 08:59:59', NULL),
(2, 'AntiqueWhite', 'FAEBD7', NULL, 0, '2020-01-11 08:59:59', NULL),
(3, 'Aqua', '00FFFF', NULL, 0, '2020-01-11 08:59:59', NULL),
(4, 'Aquamarine', '7FFFD4', NULL, 0, '2020-01-11 08:59:59', NULL),
(5, 'Azure', 'F0FFFF', NULL, 0, '2020-01-11 08:59:59', NULL),
(6, 'Beige', 'F5F5DC', NULL, 0, '2020-01-11 08:59:59', NULL),
(7, 'Bisque', 'FFE4C4', NULL, 0, '2020-01-11 08:59:59', NULL),
(8, 'Black', '000000', '2', 0, '2020-01-11 08:59:59', NULL),
(9, 'BlanchedAlmond', 'FFEBCD', NULL, 0, '2020-01-11 08:59:59', NULL),
(10, 'Blue', '0000FF', '5', 0, '2020-01-11 08:59:59', NULL),
(11, 'BlueViolet', '8A2BE2', NULL, 0, '2020-01-11 08:59:59', NULL),
(12, 'Brown', 'A52A2A', NULL, 0, '2020-01-11 08:59:59', NULL),
(13, 'BurlyWood', 'DEB887', NULL, 0, '2020-01-11 08:59:59', NULL),
(14, 'CadetBlue', '5F9EA0', NULL, 0, '2020-01-11 08:59:59', NULL),
(15, 'Chartreuse', '7FFF00', NULL, 0, '2020-01-11 08:59:59', NULL),
(16, 'Chocolate', 'D2691E', NULL, 0, '2020-01-11 08:59:59', NULL),
(17, 'Coral', 'FF7F50', NULL, 0, '2020-01-11 08:59:59', NULL),
(18, 'CornflowerBlue', '6495ED', NULL, 0, '2020-01-11 08:59:59', NULL),
(19, 'Cornsilk', 'FFF8DC', NULL, 0, '2020-01-11 08:59:59', NULL),
(20, 'Crimson', 'DC143C', NULL, 0, '2020-01-11 08:59:59', NULL),
(21, 'Cyan', '00FFFF', NULL, 0, '2020-01-11 08:59:59', NULL),
(22, 'DarkBlue', '00008B', NULL, 0, '2020-01-11 08:59:59', NULL),
(23, 'DarkCyan', '008B8B', NULL, 0, '2020-01-11 08:59:59', NULL),
(24, 'DarkGoldenRod', 'B8860B', NULL, 0, '2020-01-11 08:59:59', NULL),
(25, 'DarkGray', 'A9A9A9', NULL, 0, '2020-01-11 08:59:59', NULL),
(26, 'DarkGrey', 'A9A9A9', NULL, 0, '2020-01-11 08:59:59', NULL),
(27, 'DarkGreen', '006400', NULL, 0, '2020-01-11 08:59:59', NULL),
(28, 'DarkKhaki', 'BDB76B', NULL, 0, '2020-01-11 09:00:00', NULL),
(29, 'DarkMagenta', '8B008B', NULL, 0, '2020-01-11 09:00:00', NULL),
(30, 'DarkOliveGreen', '556B2F', NULL, 0, '2020-01-11 09:00:00', NULL),
(31, 'DarkOrange', 'FF8C00', NULL, 0, '2020-01-11 09:00:00', NULL),
(32, 'DarkOrchid', '9932CC', NULL, 0, '2020-01-11 09:00:00', NULL),
(33, 'DarkRed', '8B0000', NULL, 0, '2020-01-11 09:00:00', NULL),
(34, 'DarkSalmon', 'E9967A', NULL, 0, '2020-01-11 09:00:00', NULL),
(35, 'DarkSeaGreen', '8FBC8F', NULL, 0, '2020-01-11 09:00:00', NULL),
(36, 'DarkSlateBlue', '483D8B', NULL, 0, '2020-01-11 09:00:00', NULL),
(37, 'DarkSlateGray', '2F4F4F', NULL, 0, '2020-01-11 09:00:00', NULL),
(38, 'DarkSlateGrey', '2F4F4F', NULL, 0, '2020-01-11 09:00:00', NULL),
(39, 'DarkTurquoise', '00CED1', NULL, 0, '2020-01-11 09:00:00', NULL),
(40, 'DarkViolet', '9400D3', NULL, 0, '2020-01-11 09:00:00', NULL),
(41, 'DeepPink', 'FF1493', NULL, 0, '2020-01-11 09:00:00', NULL),
(42, 'DeepSkyBlue', '00BFFF', NULL, 0, '2020-01-11 09:00:00', NULL),
(43, 'DimGray', '696969', NULL, 0, '2020-01-11 09:00:00', NULL),
(44, 'DimGrey', '696969', NULL, 0, '2020-01-11 09:00:00', NULL),
(45, 'DodgerBlue', '1E90FF', NULL, 0, '2020-01-11 09:00:00', NULL),
(46, 'FireBrick', 'B22222', NULL, 0, '2020-01-11 09:00:00', NULL),
(47, 'FloralWhite', 'FFFAF0', NULL, 0, '2020-01-11 09:00:00', NULL),
(48, 'ForestGreen', '228B22', NULL, 0, '2020-01-11 09:00:00', NULL),
(49, 'Fuchsia', 'FF00FF', NULL, 0, '2020-01-11 09:00:00', NULL),
(50, 'Gainsboro', 'DCDCDC', NULL, 0, '2020-01-11 09:00:00', NULL),
(51, 'GhostWhite', 'F8F8FF', NULL, 0, '2020-01-11 09:00:00', NULL),
(52, 'Gold', 'FFD700', '8', 0, '2020-01-11 09:00:00', NULL),
(53, 'GoldenRod', 'DAA520', NULL, 0, '2020-01-11 09:00:00', NULL),
(54, 'Grey', '808080', '7', 0, '2020-01-11 09:00:00', NULL),
(55, 'Green', '008000', '4', 0, '2020-01-11 09:00:00', NULL),
(56, 'GreenYellow', 'ADFF2F', NULL, 0, '2020-01-11 09:00:00', NULL),
(57, 'HoneyDew', 'F0FFF0', NULL, 0, '2020-01-11 09:00:00', NULL),
(58, 'HotPink', 'FF69B4', NULL, 0, '2020-01-11 09:00:00', NULL),
(59, 'IndianRed', 'CD5C5C', NULL, 0, '2020-01-11 09:00:00', '2020-02-13 03:39:34'),
(60, 'Indigo', '4B0082', NULL, 0, '2020-01-11 09:00:00', '2020-02-13 03:39:34'),
(61, 'Ivory', 'FFFFF0', NULL, 0, '2020-01-11 09:00:00', NULL),
(62, 'Khaki', 'F0E68C', NULL, 0, '2020-01-11 09:00:00', NULL),
(63, 'Lavender', 'E6E6FA', NULL, 0, '2020-01-11 09:00:00', NULL),
(64, 'LavenderBlush', 'FFF0F5', NULL, 0, '2020-01-11 09:00:00', NULL),
(65, 'LawnGreen', '7CFC00', NULL, 0, '2020-01-11 09:00:00', NULL),
(66, 'LemonChiffon', 'FFFACD', NULL, 0, '2020-01-11 09:00:00', NULL),
(67, 'LightBlue', 'ADD8E6', NULL, 0, '2020-01-11 09:00:00', NULL),
(68, 'LightCoral', 'F08080', NULL, 0, '2020-01-11 09:00:00', NULL),
(69, 'LightCyan', 'E0FFFF', NULL, 0, '2020-01-11 09:00:00', NULL),
(70, 'LightGoldenRodY', 'FAFAD2', NULL, 0, '2020-01-11 09:00:00', NULL),
(71, 'LightGray', 'D3D3D3', NULL, 0, '2020-01-11 09:00:00', NULL),
(72, 'LightGrey', 'D3D3D3', NULL, 0, '2020-01-11 09:00:00', NULL),
(73, 'LightGreen', '90EE90', NULL, 0, '2020-01-11 09:00:00', NULL),
(74, 'LightPink', 'FFB6C1', NULL, 0, '2020-01-11 09:00:00', NULL),
(75, 'LightSalmon', 'FFA07A', NULL, 0, '2020-01-11 09:00:00', NULL),
(76, 'LightSeaGreen', '20B2AA', NULL, 0, '2020-01-11 09:00:00', NULL),
(77, 'LightSkyBlue', '87CEFA', NULL, 0, '2020-01-11 09:00:00', NULL),
(78, 'LightSlateGray', '778899', NULL, 0, '2020-01-11 09:00:00', NULL),
(79, 'LightSlateGrey', '778899', NULL, 0, '2020-01-11 09:00:00', NULL),
(80, 'LightSteelBlue', 'B0C4DE', NULL, 0, '2020-01-11 09:00:00', NULL),
(81, 'LightYellow', 'FFFFE0', NULL, 0, '2020-01-11 09:00:00', NULL),
(82, 'Lime', '00FF00', NULL, 0, '2020-01-11 09:00:00', NULL),
(83, 'LimeGreen', '32CD32', NULL, 0, '2020-01-11 09:00:00', NULL),
(84, 'Linen', 'FAF0E6', NULL, 0, '2020-01-11 09:00:00', NULL),
(85, 'Magenta', 'FF00FF', '10', 0, '2020-01-11 09:00:00', NULL),
(86, 'Maroon', '800000', NULL, 0, '2020-01-11 09:00:00', NULL),
(87, 'MediumAquaMarin', '66CDAA', NULL, 0, '2020-01-11 09:00:00', NULL),
(88, 'MediumBlue', '0000CD', NULL, 0, '2020-01-11 09:00:00', NULL),
(89, 'MediumOrchid', 'BA55D3', NULL, 0, '2020-01-11 09:00:00', NULL),
(90, 'MediumPurple', '9370DB', NULL, 0, '2020-01-11 09:00:00', NULL),
(91, 'MediumSeaGreen', '3CB371', NULL, 0, '2020-01-11 09:00:00', NULL),
(92, 'MediumSlateBlue', '7B68EE', NULL, 0, '2020-01-11 09:00:00', NULL),
(93, 'MediumSpringGre', '00FA9A', NULL, 0, '2020-01-11 09:00:00', NULL),
(94, 'MediumTurquoise', '48D1CC', NULL, 0, '2020-01-11 09:00:00', NULL),
(95, 'MediumVioletRed', 'C71585', NULL, 0, '2020-01-11 09:00:00', NULL),
(96, 'MidnightBlue', '191970', NULL, 0, '2020-01-11 09:00:00', NULL),
(97, 'MintCream', 'F5FFFA', NULL, 0, '2020-01-11 09:00:00', NULL),
(98, 'MistyRose', 'FFE4E1', NULL, 0, '2020-01-11 09:00:00', NULL),
(99, 'Moccasin', 'FFE4B5', NULL, 0, '2020-01-11 09:00:00', NULL),
(100, 'NavajoWhite', 'FFDEAD', NULL, 0, '2020-01-11 09:00:00', NULL),
(101, 'Navy', '000080', NULL, 0, '2020-01-11 09:00:00', NULL),
(102, 'OldLace', 'FDF5E6', NULL, 0, '2020-01-11 09:00:00', NULL),
(103, 'Olive', '808000', NULL, 0, '2020-01-11 09:00:00', NULL),
(104, 'OliveDrab', '6B8E23', NULL, 0, '2020-01-11 09:00:00', NULL),
(105, 'Orange', 'FFA500', NULL, 0, '2020-01-11 09:00:00', NULL),
(106, 'OrangeRed', 'FF4500', NULL, 0, '2020-01-11 09:00:00', NULL),
(107, 'Orchid', 'DA70D6', NULL, 0, '2020-01-11 09:00:00', NULL),
(108, 'PaleGoldenRod', 'EEE8AA', NULL, 0, '2020-01-11 09:00:00', NULL),
(109, 'PaleGreen', '98FB98', NULL, 0, '2020-01-11 09:00:00', NULL),
(110, 'PaleTurquoise', 'AFEEEE', NULL, 0, '2020-01-11 09:00:00', NULL),
(111, 'PaleVioletRed', 'DB7093', NULL, 0, '2020-01-11 09:00:00', NULL),
(112, 'PapayaWhip', 'FFEFD5', NULL, 0, '2020-01-11 09:00:00', NULL),
(113, 'PeachPuff', 'FFDAB9', NULL, 0, '2020-01-11 09:00:00', NULL),
(114, 'Peru', 'CD853F', NULL, 0, '2020-01-11 09:00:00', NULL),
(115, 'Pink', 'FFC0CB', '12', 0, '2020-01-11 09:00:00', NULL),
(116, 'Plum', 'DDA0DD', NULL, 0, '2020-01-11 09:00:00', NULL),
(117, 'PowderBlue', 'B0E0E6', NULL, 0, '2020-01-11 09:00:00', NULL),
(118, 'Purple', '800080', NULL, 0, '2020-01-11 09:00:00', NULL),
(119, 'RebeccaPurple', '663399', NULL, 0, '2020-01-11 09:00:00', NULL),
(120, 'Red', 'FF0000', '3', 0, '2020-01-11 09:00:00', NULL),
(121, 'RosyBrown', 'BC8F8F', NULL, 0, '2020-01-11 09:00:00', NULL),
(122, 'RoyalBlue', '4169E1', NULL, 0, '2020-01-11 09:00:00', NULL),
(123, 'SaddleBrown', '8B4513', NULL, 0, '2020-01-11 09:00:00', NULL),
(124, 'Salmon', 'FA8072', NULL, 0, '2020-01-11 09:00:00', NULL),
(125, 'SandyBrown', 'F4A460', NULL, 0, '2020-01-11 09:00:00', NULL),
(126, 'SeaGreen', '2E8B57', NULL, 0, '2020-01-11 09:00:00', NULL),
(127, 'SeaShell', 'FFF5EE', NULL, 0, '2020-01-11 09:00:00', NULL),
(128, 'Sienna', 'A0522D', NULL, 0, '2020-01-11 09:00:00', NULL),
(129, 'Silver', 'C0C0C0', '9', 0, '2020-01-11 09:00:00', NULL),
(130, 'SkyBlue', '87CEEB', NULL, 0, '2020-01-11 09:00:00', NULL),
(131, 'SlateBlue', '6A5ACD', NULL, 0, '2020-01-11 09:00:00', NULL),
(132, 'SlateGray', '708090', NULL, 0, '2020-01-11 09:00:00', NULL),
(133, 'SlateGrey', '708090', NULL, 0, '2020-01-11 09:00:00', NULL),
(134, 'Snow', 'FFFAFA', NULL, 0, '2020-01-11 09:00:00', NULL),
(135, 'SpringGreen', '00FF7F', NULL, 0, '2020-01-11 09:00:00', NULL),
(136, 'SteelBlue', '4682B4', NULL, 0, '2020-01-11 09:00:00', NULL),
(137, 'Tan', 'D2B48C', NULL, 0, '2020-01-11 09:00:00', NULL),
(138, 'Teal', '008080', NULL, 0, '2020-01-11 09:00:00', NULL),
(139, 'Thistle', 'D8BFD8', NULL, 0, '2020-01-11 09:00:00', NULL),
(140, 'Tomato', 'FF6347', NULL, 0, '2020-01-11 09:00:00', NULL),
(141, 'Turquoise', '40E0D0', NULL, 0, '2020-01-11 09:00:00', NULL),
(142, 'Violet', 'EE82EE', NULL, 0, '2020-01-11 09:00:00', NULL),
(143, 'Wheat', 'F5DEB3', NULL, 0, '2020-01-11 09:00:00', NULL),
(144, 'White', 'FFFFFF', '1', 0, '2020-01-11 09:00:00', NULL),
(145, 'WhiteSmoke', 'F5F5F5', NULL, 0, '2020-01-11 09:00:00', NULL),
(146, 'Yellow', 'FFFF00', '6', 0, '2020-01-11 09:00:00', NULL),
(147, 'YellowGreen', '9ACD32', NULL, 0, '2020-01-11 09:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) DEFAULT NULL,
  `curr_id` int(10) DEFAULT '1',
  `name` varchar(45) DEFAULT NULL,
  `short_name` varchar(15) DEFAULT NULL,
  `initials` varchar(6) DEFAULT NULL,
  `tagline` varchar(80) DEFAULT NULL,
  `short_description` varchar(400) DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `phone_1` varchar(20) DEFAULT NULL,
  `phone_2` varchar(20) DEFAULT NULL,
  `phone_3` varchar(20) DEFAULT NULL,
  `email_1` varchar(45) DEFAULT NULL,
  `email_2` varchar(45) DEFAULT NULL,
  `email_3` varchar(45) DEFAULT NULL,
  `address_1` varchar(100) DEFAULT NULL,
  `address_2` varchar(100) DEFAULT NULL,
  `address_3` varchar(100) DEFAULT NULL,
  `bank_info` varchar(1000) DEFAULT NULL,
  `logo_site` varchar(45) DEFAULT NULL,
  `logo_portal` varchar(45) DEFAULT NULL,
  `license` varchar(45) DEFAULT NULL,
  `license_period` varchar(12) DEFAULT NULL,
  `license_date` datetime DEFAULT NULL,
  `social_facebook` varchar(60) DEFAULT NULL,
  `social_twitter` varchar(60) DEFAULT NULL,
  `social_whatsapp` varchar(60) DEFAULT NULL,
  `social_instagram` varchar(60) DEFAULT NULL,
  `social_linkedin` varchar(60) DEFAULT NULL,
  `social_googleplus` varchar(60) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `companies_ibfk_2_idx` (`curr_id`),
  KEY `curr_id` (`curr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `owner_id`, `curr_id`, `name`, `short_name`, `initials`, `tagline`, `short_description`, `description`, `phone_1`, `phone_2`, `phone_3`, `email_1`, `email_2`, `email_3`, `address_1`, `address_2`, `address_3`, `bank_info`, `logo_site`, `logo_portal`, `license`, `license_period`, `license_date`, `social_facebook`, `social_twitter`, `social_whatsapp`, `social_instagram`, `social_linkedin`, `social_googleplus`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 1, 1, ' SoftMall Transact', 'SoftMall', 'SM', '...ecommerce redefined', 'We manufacture and distribute cleaning solvents and we provide cleaning services for homes, hospitals, hotels, schools and offices; we supply genuine janitorial equipment and we train janitors in line with international best practices.', 'MenMi Cleaning Solutions is a subsidiary of MenMi Integrated Services; we are poised to make cleaning so much easier. We manufacture and distribute cleaning solvents and we provide cleaning services for homes, hospitals, hotels, schools and offices; we supply genuine janitorial equipment and we train janitors in line with international best practices.<br />\r\n<br />\r\n<br />\r\nxxddv<br />\r\nccx', '+234 7063418556', '+234 7063418556', NULL, 'info@softmall', NULL, NULL, 'Lagos, Nigeria', 'xxxxx', 'xxxx', 'Fidelity Bank: 6019192254<br />', 'site.png', 'portal.png', 'v1q7GX9cR', '10 year', '2019-12-21 07:00:16', 'https://facebook.com/softmall', 'https://twitter.com/softmall', 'https://whatsapp.com/softmall', 'https://instagram.com/softmall', 'https://linkedin.com/softmall', NULL, 0, '2019-12-31 07:03:20', '2020-02-11 13:49:59'),
(2, 2, 1, 'MenMi Cleaning Solution', 'MenMi', 'MM', '...makes cleaning easy', 'We manufacture and distribute cleaning solvents and we provide cleaning services for homes, hospitals, hotels, schools and offices; we supply genuine janitorial equipment and we train janitors in line with international best practices.', 'MenMi Cleaning Solutions is a subsidiary of MenMi Integrated Services; we are poised to make cleaning so much easier. We manufacture and distribute cleaning solvents and we provide cleaning services for homes, hospitals, hotels, schools and offices; we supply genuine janitorial equipment and we train janitors in line with international best practices.', '+234 8023553304', '+2348035222208', NULL, 'menmi.washup@gmail.com', NULL, NULL, 'Calabar, Cross River State', 'xxxxx', 'xxxx', 'First Bank: 2034363816<br />\r\nGTBank:    0477890417<br />\r\nZenith Bank: 1016360300<br />\r\n<br />\r\nCxxx', 'logo_site.png', 'logo_portal.png', 'v1q7GX9cR', '1 month', '2019-12-21 07:00:16', 'https://facebook.com/menmi', 'https://twitter.com/menmi', 'https://whatsapp.com/menmi', 'https://instagram.com/menmi', 'https://linkedin.com/menmi', '', 0, '2019-12-31 07:03:20', '2020-02-11 13:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `continent_id` int(1) DEFAULT '0',
  `order` int(3) DEFAULT '0',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `continent_id`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'Afghanistan', 0, 1, 0, '2020-02-24 07:25:05', NULL),
(2, 'Albania', 0, 2, 0, '2020-02-24 07:25:05', NULL),
(3, 'Algeria', 0, 3, 0, '2020-02-24 07:25:05', NULL),
(4, 'Andorra', 0, 4, 0, '2020-02-24 07:25:05', NULL),
(5, 'Angola', 0, 5, 0, '2020-02-24 07:25:05', NULL),
(6, 'Antigua and Barbuda', 0, 6, 0, '2020-02-24 07:25:05', NULL),
(7, 'Argentina', 0, 7, 0, '2020-02-24 07:25:05', NULL),
(8, 'Armenia', 0, 8, 0, '2020-02-24 07:25:05', NULL),
(9, 'Aruba', 0, 9, 0, '2020-02-24 07:25:05', NULL),
(10, 'Australia', 0, 10, 0, '2020-02-24 07:25:05', NULL),
(11, 'Austria', 0, 11, 0, '2020-02-24 07:25:05', NULL),
(12, 'Azerbaijan', 0, 12, 0, '2020-02-24 07:25:05', NULL),
(13, 'Bahamas', 0, 13, 0, '2020-02-24 07:25:05', NULL),
(14, 'The Bahrain', 0, 14, 0, '2020-02-24 07:25:05', NULL),
(15, 'Bangladesh', 0, 15, 0, '2020-02-24 07:25:05', NULL),
(16, 'Barbados', 0, 16, 0, '2020-02-24 07:25:05', NULL),
(17, 'Belarus', 0, 17, 0, '2020-02-24 07:25:05', NULL),
(18, 'Belgium', 0, 18, 0, '2020-02-24 07:25:05', NULL),
(19, 'Belize', 0, 19, 0, '2020-02-24 07:25:05', NULL),
(20, 'Benin', 0, 20, 0, '2020-02-24 07:25:05', NULL),
(21, 'Bhutan', 0, 21, 0, '2020-02-24 07:25:05', NULL),
(22, 'Bolivia', 0, 22, 0, '2020-02-24 07:25:05', NULL),
(23, 'Bosnia and Herzegovi', 0, 23, 0, '2020-02-24 07:25:05', NULL),
(24, 'Botswana', 0, 24, 0, '2020-02-24 07:25:05', NULL),
(25, 'Brazil', 0, 25, 0, '2020-02-24 07:25:05', NULL),
(26, 'Brunei', 0, 26, 0, '2020-02-24 07:25:05', NULL),
(27, 'Bulgaria', 0, 27, 0, '2020-02-24 07:25:05', NULL),
(28, 'Burkina Faso', 0, 28, 0, '2020-02-24 07:25:05', NULL),
(29, 'Burma', 0, 29, 0, '2020-02-24 07:25:05', NULL),
(30, 'Burundi', 0, 30, 0, '2020-02-24 07:25:05', NULL),
(31, 'Cambodia', 0, 31, 0, '2020-02-24 07:25:05', NULL),
(32, 'Cameroon', 0, 32, 0, '2020-02-24 07:25:05', NULL),
(33, 'Canada', 0, 33, 0, '2020-02-24 07:25:05', NULL),
(34, 'Cabo Verde', 0, 34, 0, '2020-02-24 07:25:05', NULL),
(35, 'Central African Repu', 0, 35, 0, '2020-02-24 07:25:05', NULL),
(36, 'Chad', 0, 36, 0, '2020-02-24 07:25:05', NULL),
(37, 'Chile', 0, 37, 0, '2020-02-24 07:25:05', NULL),
(38, 'China', 0, 38, 0, '2020-02-24 07:25:05', NULL),
(39, 'Colombia', 0, 39, 0, '2020-02-24 07:25:05', NULL),
(40, 'Comoros', 0, 40, 0, '2020-02-24 07:25:05', NULL),
(41, 'Congo', 0, 41, 0, '2020-02-24 07:25:05', NULL),
(42, 'Democratic Republic ', 0, 42, 0, '2020-02-24 07:25:05', NULL),
(43, 'Costa Rica', 0, 43, 0, '2020-02-24 07:25:05', NULL),
(44, 'Cote d Ivoire', 0, 44, 0, '2020-02-24 07:25:05', NULL),
(45, 'Croatia', 0, 45, 0, '2020-02-24 07:25:05', NULL),
(46, 'Cuba', 0, 46, 0, '2020-02-24 07:25:05', NULL),
(47, 'Curacao', 0, 47, 0, '2020-02-24 07:25:05', NULL),
(48, 'Cyprus', 0, 48, 0, '2020-02-24 07:25:05', NULL),
(49, 'Czechia', 0, 49, 0, '2020-02-24 07:25:05', NULL),
(50, 'Denmark', 0, 50, 0, '2020-02-24 07:25:05', NULL),
(51, 'Djibouti', 0, 51, 0, '2020-02-24 07:25:05', NULL),
(52, 'Dominica', 0, 52, 0, '2020-02-24 07:25:05', NULL),
(53, 'Dominican Republic', 0, 53, 0, '2020-02-24 07:25:05', NULL),
(54, 'East Timor (see Timo', 0, 54, 0, '2020-02-24 07:25:05', NULL),
(55, 'Ecuador', 0, 55, 0, '2020-02-24 07:25:05', NULL),
(56, 'Egypt', 0, 56, 0, '2020-02-24 07:25:05', NULL),
(57, 'El Salvador', 0, 57, 0, '2020-02-24 07:25:05', NULL),
(58, 'Equatorial Guinea', 0, 58, 0, '2020-02-24 07:25:05', NULL),
(59, 'Eritrea', 0, 59, 0, '2020-02-24 07:25:05', NULL),
(60, 'Estonia', 0, 60, 0, '2020-02-24 07:25:05', NULL),
(61, 'Ethiopia', 0, 61, 0, '2020-02-24 07:25:05', NULL),
(62, 'Fiji', 0, 62, 0, '2020-02-24 07:25:05', NULL),
(63, 'Finland', 0, 63, 0, '2020-02-24 07:25:05', NULL),
(64, 'France', 0, 64, 0, '2020-02-24 07:25:05', NULL),
(65, 'Gabon', 0, 65, 0, '2020-02-24 07:25:05', NULL),
(66, 'Gambia', 0, 66, 0, '2020-02-24 07:25:05', NULL),
(67, 'Georgia', 0, 67, 0, '2020-02-24 07:25:05', NULL),
(68, 'Germany', 0, 68, 0, '2020-02-24 07:25:05', NULL),
(69, 'Ghana', 0, 69, 0, '2020-02-24 07:25:05', NULL),
(70, 'Greece', 0, 70, 0, '2020-02-24 07:25:05', NULL),
(71, 'Grenada', 0, 71, 0, '2020-02-24 07:25:05', NULL),
(72, 'Guatemala', 0, 72, 0, '2020-02-24 07:25:05', NULL),
(73, 'Guinea', 0, 73, 0, '2020-02-24 07:25:05', NULL),
(74, 'Guinea-Bissau', 0, 74, 0, '2020-02-24 07:25:05', NULL),
(75, 'Guyana', 0, 75, 0, '2020-02-24 07:25:05', NULL),
(76, 'Haiti', 0, 76, 0, '2020-02-24 07:25:05', NULL),
(77, 'Holy See', 0, 77, 0, '2020-02-24 07:25:05', NULL),
(78, 'Honduras', 0, 78, 0, '2020-02-24 07:25:05', NULL),
(79, 'Hong Kong', 0, 79, 0, '2020-02-24 07:25:05', NULL),
(80, 'Hungary', 0, 80, 0, '2020-02-24 07:25:05', NULL),
(81, 'Iceland', 0, 81, 0, '2020-02-24 07:25:05', NULL),
(82, 'India', 0, 82, 0, '2020-02-24 07:25:05', NULL),
(83, 'Indonesia', 0, 83, 0, '2020-02-24 07:25:05', NULL),
(84, 'Iran', 0, 84, 0, '2020-02-24 07:25:05', NULL),
(85, 'Iraq', 0, 85, 0, '2020-02-24 07:25:05', NULL),
(86, 'Ireland', 0, 86, 0, '2020-02-24 07:25:05', NULL),
(87, 'Israel', 0, 87, 0, '2020-02-24 07:25:05', NULL),
(88, 'Italy', 0, 88, 0, '2020-02-24 07:25:05', NULL),
(89, 'Jamaica', 0, 89, 0, '2020-02-24 07:25:05', NULL),
(90, 'Japan', 0, 90, 0, '2020-02-24 07:25:05', NULL),
(91, 'Jordan', 0, 91, 0, '2020-02-24 07:25:05', NULL),
(92, 'Kazakhstan', 0, 92, 0, '2020-02-24 07:25:05', NULL),
(93, 'Kenya', 0, 93, 0, '2020-02-24 07:25:05', NULL),
(94, 'Kiribati', 0, 94, 0, '2020-02-24 07:25:05', NULL),
(95, 'Korea, North', 0, 95, 0, '2020-02-24 07:25:05', NULL),
(96, 'Korea, South', 0, 96, 0, '2020-02-24 07:25:05', NULL),
(97, 'Kosovo', 0, 97, 0, '2020-02-24 07:25:05', NULL),
(98, 'Kuwait', 0, 98, 0, '2020-02-24 07:25:05', NULL),
(99, 'Kyrgyzstan', 0, 99, 0, '2020-02-24 07:25:05', NULL),
(100, 'Laos', 0, 100, 0, '2020-02-24 07:25:05', NULL),
(101, 'Latvia', 0, 101, 0, '2020-02-24 07:25:05', NULL),
(102, 'Lebanon', 0, 102, 0, '2020-02-24 07:25:05', NULL),
(103, 'Lesotho', 0, 103, 0, '2020-02-24 07:25:05', NULL),
(104, 'Liberia', 0, 104, 0, '2020-02-24 07:25:05', NULL),
(105, 'Libya', 0, 105, 0, '2020-02-24 07:25:05', NULL),
(106, 'Liechtenstein', 0, 106, 0, '2020-02-24 07:25:05', NULL),
(107, 'Lithuania', 0, 107, 0, '2020-02-24 07:25:05', NULL),
(108, 'Luxembourg', 0, 108, 0, '2020-02-24 07:25:05', NULL),
(109, 'Macau', 0, 109, 0, '2020-02-24 07:25:05', NULL),
(110, 'Macedonia', 0, 110, 0, '2020-02-24 07:25:05', NULL),
(111, 'Madagascar', 0, 111, 0, '2020-02-24 07:25:05', NULL),
(112, 'Malawi', 0, 112, 0, '2020-02-24 07:25:05', NULL),
(113, 'Malaysia', 0, 113, 0, '2020-02-24 07:25:05', NULL),
(114, 'Maldives', 0, 114, 0, '2020-02-24 07:25:05', NULL),
(115, 'Mali', 0, 115, 0, '2020-02-24 07:25:05', NULL),
(116, 'Malta', 0, 116, 0, '2020-02-24 07:25:05', NULL),
(117, 'Marshall Islands', 0, 117, 0, '2020-02-24 07:25:05', NULL),
(118, 'Mauritania', 0, 118, 0, '2020-02-24 07:25:05', NULL),
(119, 'Mauritius', 0, 119, 0, '2020-02-24 07:25:05', NULL),
(120, 'Mexico', 0, 120, 0, '2020-02-24 07:25:05', NULL),
(121, 'Micronesia', 0, 121, 0, '2020-02-24 07:25:05', NULL),
(122, 'Moldova', 0, 122, 0, '2020-02-24 07:25:05', NULL),
(123, 'Monaco', 0, 123, 0, '2020-02-24 07:25:05', NULL),
(124, 'Mongolia', 0, 124, 0, '2020-02-24 07:25:05', NULL),
(125, 'Montenegro', 0, 125, 0, '2020-02-24 07:25:05', NULL),
(126, 'Morocco', 0, 126, 0, '2020-02-24 07:25:05', NULL),
(127, 'Mozambique', 0, 127, 0, '2020-02-24 07:25:05', NULL),
(128, 'Namibia', 0, 128, 0, '2020-02-24 07:25:05', NULL),
(129, 'Nauru', 0, 129, 0, '2020-02-24 07:25:05', NULL),
(130, 'Nepal', 0, 130, 0, '2020-02-24 07:25:05', NULL),
(131, 'Netherlands', 0, 131, 0, '2020-02-24 07:25:05', NULL),
(132, 'New Zealand', 0, 132, 0, '2020-02-24 07:25:05', NULL),
(133, 'Nicaragua', 0, 133, 0, '2020-02-24 07:25:05', NULL),
(134, 'Niger', 0, 134, 0, '2020-02-24 07:25:05', NULL),
(135, 'Nigeria', 0, 135, 0, '2020-02-24 07:25:05', NULL),
(136, 'North Korea', 0, 136, 0, '2020-02-24 07:25:05', NULL),
(137, 'Norway', 0, 137, 0, '2020-02-24 07:25:05', NULL),
(138, 'Oman', 0, 138, 0, '2020-02-24 07:25:05', NULL),
(139, 'Pakistan', 0, 139, 0, '2020-02-24 07:25:05', NULL),
(140, 'Palau', 0, 140, 0, '2020-02-24 07:25:05', NULL),
(141, 'Palestinian Territor', 0, 141, 0, '2020-02-24 07:25:05', NULL),
(142, 'Panama', 0, 142, 0, '2020-02-24 07:25:05', NULL),
(143, 'Papua New Guinea', 0, 143, 0, '2020-02-24 07:25:05', NULL),
(144, 'Paraguay', 0, 144, 0, '2020-02-24 07:25:05', NULL),
(145, 'Peru', 0, 145, 0, '2020-02-24 07:25:05', NULL),
(146, 'Philippines', 0, 146, 0, '2020-02-24 07:25:05', NULL),
(147, 'Poland', 0, 147, 0, '2020-02-24 07:25:05', NULL),
(148, 'Portugal', 0, 148, 0, '2020-02-24 07:25:05', NULL),
(149, 'Qatar', 0, 149, 0, '2020-02-24 07:25:05', NULL),
(150, 'Romania', 0, 150, 0, '2020-02-24 07:25:05', NULL),
(151, 'Russia', 0, 151, 0, '2020-02-24 07:25:05', NULL),
(152, 'Rwanda', 0, 152, 0, '2020-02-24 07:25:05', NULL),
(153, 'Saint Kitts and Nevi', 0, 153, 0, '2020-02-24 07:25:05', NULL),
(154, 'Saint Lucia', 0, 154, 0, '2020-02-24 07:25:05', NULL),
(155, 'Saint Vincent and th', 0, 155, 0, '2020-02-24 07:25:05', NULL),
(156, 'Samoa', 0, 156, 0, '2020-02-24 07:25:05', NULL),
(157, 'San Marino', 0, 157, 0, '2020-02-24 07:25:05', NULL),
(158, 'Sao Tome and Princip', 0, 158, 0, '2020-02-24 07:25:05', NULL),
(159, 'Saudi Arabia', 0, 159, 0, '2020-02-24 07:25:05', NULL),
(160, 'Senegal', 0, 160, 0, '2020-02-24 07:25:05', NULL),
(161, 'Serbia', 0, 161, 0, '2020-02-24 07:25:05', NULL),
(162, 'Seychelles', 0, 162, 0, '2020-02-24 07:25:05', NULL),
(163, 'Sierra Leone', 0, 163, 0, '2020-02-24 07:25:05', NULL),
(164, 'Singapore', 0, 164, 0, '2020-02-24 07:25:05', NULL),
(165, 'Sint Maarten', 0, 165, 0, '2020-02-24 07:25:05', NULL),
(166, 'Slovakia', 0, 166, 0, '2020-02-24 07:25:05', NULL),
(167, 'Slovenia', 0, 167, 0, '2020-02-24 07:25:05', NULL),
(168, 'Solomon Islands', 0, 168, 0, '2020-02-24 07:25:05', NULL),
(169, 'Somalia', 0, 169, 0, '2020-02-24 07:25:05', NULL),
(170, 'South Africa', 0, 170, 0, '2020-02-24 07:25:05', NULL),
(171, 'South Korea', 0, 171, 0, '2020-02-24 07:25:05', NULL),
(172, 'South Sudan', 0, 172, 0, '2020-02-24 07:25:05', NULL),
(173, 'Spain', 0, 173, 0, '2020-02-24 07:25:05', NULL),
(174, 'Sri Lanka', 0, 174, 0, '2020-02-24 07:25:05', NULL),
(175, 'Sudan', 0, 175, 0, '2020-02-24 07:25:05', NULL),
(176, 'Suriname', 0, 176, 0, '2020-02-24 07:25:05', NULL),
(177, 'Swaziland', 0, 177, 0, '2020-02-24 07:25:05', NULL),
(178, 'Sweden', 0, 178, 0, '2020-02-24 07:25:05', NULL),
(179, 'Switzerland', 0, 179, 0, '2020-02-24 07:25:05', NULL),
(180, 'Syria', 0, 180, 0, '2020-02-24 07:25:05', NULL),
(181, 'Taiwan', 0, 181, 0, '2020-02-24 07:25:05', NULL),
(182, 'Tajikistan', 0, 182, 0, '2020-02-24 07:25:05', NULL),
(183, 'Tanzania', 0, 183, 0, '2020-02-24 07:25:05', NULL),
(184, 'Thailand', 0, 184, 0, '2020-02-24 07:25:05', NULL),
(185, 'Timor-Leste', 0, 185, 0, '2020-02-24 07:25:05', NULL),
(186, 'Togo', 0, 186, 0, '2020-02-24 07:25:05', NULL),
(187, 'Tonga', 0, 187, 0, '2020-02-24 07:25:05', NULL),
(188, 'Trinidad and Tobago', 0, 188, 0, '2020-02-24 07:25:05', NULL),
(189, 'Tunisia', 0, 189, 0, '2020-02-24 07:25:05', NULL),
(190, 'Turkey', 0, 190, 0, '2020-02-24 07:25:05', NULL),
(191, 'Turkmenistan', 0, 191, 0, '2020-02-24 07:25:05', NULL),
(192, 'Tuvalu', 0, 192, 0, '2020-02-24 07:25:05', NULL),
(193, 'Uganda', 0, 193, 0, '2020-02-24 07:25:05', NULL),
(194, 'Ukraine', 0, 194, 0, '2020-02-24 07:25:05', NULL),
(195, 'United Arab Emirates', 0, 195, 0, '2020-02-24 07:25:05', NULL),
(196, 'United Kingdom (UK)', 0, 196, 0, '2020-02-24 07:25:05', NULL),
(197, 'United States of Ame', 0, 197, 0, '2020-02-24 07:25:05', NULL),
(198, 'Uruguay', 0, 198, 0, '2020-02-24 07:25:05', NULL),
(199, 'Uzbekistan', 0, 199, 0, '2020-02-24 07:25:05', NULL),
(200, 'Vanuatu', 0, 200, 0, '2020-02-24 07:25:05', NULL),
(201, 'Venezuela', 0, 201, 0, '2020-02-24 07:25:05', NULL),
(202, 'Vietnam', 0, 202, 0, '2020-02-24 07:25:05', NULL),
(203, 'Yemen', 0, 203, 0, '2020-02-24 07:25:05', NULL),
(204, 'Zambia', 0, 204, 0, '2020-02-24 07:25:05', NULL),
(205, 'Zimbabwe', 0, 205, 0, '2020-02-24 07:25:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `symbol` varchar(10) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `order` tinyint(3) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `country`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'Naira', '8358', '=N=', 'Nigerian', 1, 0, '2019-12-28 13:55:42', '2020-02-11 16:08:46'),
(2, 'Dollar', '36', '$', 'USA', 2, 0, '2019-12-28 13:55:42', '2020-02-11 16:08:46'),
(3, 'Pounds', '163', '£', 'United Kingdom', 3, 0, '2019-12-28 13:55:42', '2020-02-11 16:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `other_name` varchar(25) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` varchar(3000) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `index_id` (`id`),
  KEY `index_comp` (`company_id`),
  KEY `index_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `company_id`, `title`, `first_name`, `last_name`, `other_name`, `email`, `phone`, `message`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, NULL, 'Paul', 'Aduwu', NULL, 'nwankwoikemefuna23@gmail.com', '7063418556', 'dddd', 0, '2020-03-01 22:26:18', NULL),
(2, 2, NULL, 'Peredesebofa', 'Asuquo', NULL, 'young4urch@gmail.com', '7063418556', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. \r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, '2020-03-01 22:27:59', NULL),
(3, 2, NULL, 'Paul', 'Asuquo', NULL, 'eniolajohnayobami@gmail.com', '07063418556', 'asefgrthtrtrhbvfd', 0, '2020-03-01 22:36:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL DEFAULT 'cube',
  `rights` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `pix_dir` varchar(45) DEFAULT NULL,
  `doc_dir` varchar(45) DEFAULT NULL,
  `order` tinyint(2) NOT NULL,
  `max` int(6) DEFAULT '-1',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `id` (`id`),
  KEY `name` (`name`),
  KEY `parent_id_2` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `parent_id`, `name`, `title`, `icon`, `rights`, `active`, `pix_dir`, `doc_dir`, `order`, `max`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 0, 'products', 'Products', 'cube', '1,2,3,4', 1, 'products', NULL, 1, -1, 0, '2019-12-28 14:32:39', '2020-02-17 19:34:28'),
(2, 1, 'product_cats', 'Product Categories', 'cube', '1,2,3,4', 1, NULL, NULL, 1, 30, 0, '2019-12-28 14:32:39', '2020-02-17 18:53:57'),
(3, 0, 'sliders', 'Sliders', 'cube', '1,2,3,4', 1, 'sliders', NULL, 2, -1, 0, '2020-01-11 16:31:05', '2020-02-17 19:34:28'),
(6, 1, 'product_sizes', 'Product Sizes', 'cube', '1,2,3,4', 1, NULL, NULL, 1, 15, 0, '2019-12-28 14:32:39', '2020-02-17 18:53:57'),
(7, 0, 'users', 'Users', 'users', '1,2,3,4', 1, 'photos', NULL, 4, -1, 0, '2020-02-11 12:09:03', '2020-02-22 19:47:33'),
(8, 0, 'settings', 'Settings', 'wrench', '1,3', 1, 'settings', NULL, 4, -1, 0, '2020-02-11 12:09:03', '2020-02-17 19:34:28'),
(9, 1, 'product_tags', 'Product Tags', 'tag', '1,2,3,4', 1, NULL, NULL, 1, 100, 0, '2019-12-28 14:32:39', '2020-02-28 11:35:37'),
(11, 0, 'orders', 'Orders', 'cube', '1,2,3,4', 1, 'orders', NULL, 1, -1, 0, '2019-12-28 14:32:39', '2020-02-17 19:34:28'),
(12, 0, 'messages', 'Messages', 'envelope', '1,2,3,4', 1, NULL, NULL, 1, -1, 0, '2020-03-02 00:29:07', NULL),
(13, 0, 'subscribers', 'Subscribers', 'envelope', '1,2,3,4', 1, NULL, NULL, 1, -1, 0, '2020-03-02 07:56:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `ref_id` varchar(12) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - Submitted / Pending\n2 - Received\n3 - Processed\n4 - In Transit\n5 - Delivered\n6 - Completed',
  `comment` varchar(1000) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `amount_paid` int(10) DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `payment_id` int(10) DEFAULT NULL,
  `payment_mode` tinyint(2) DEFAULT NULL,
  `payment_notes` varchar(255) DEFAULT NULL,
  `processed_by` int(10) DEFAULT NULL,
  `date_processed` datetime DEFAULT NULL,
  `ship_title` varchar(10) DEFAULT NULL,
  `ship_first_name` varchar(25) NOT NULL,
  `ship_last_name` varchar(25) NOT NULL,
  `ship_other_name` varchar(25) DEFAULT NULL,
  `ship_email` varchar(45) NOT NULL,
  `ship_phone` varchar(20) DEFAULT NULL,
  `ship_country` int(3) DEFAULT NULL,
  `ship_state` int(2) DEFAULT NULL,
  `ship_address` varchar(60) DEFAULT NULL,
  `ship_apartment` varchar(15) DEFAULT NULL,
  `ship_is_bill` tinyint(1) DEFAULT '1',
  `ship_extra` varchar(1000) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `ref_id`, `status`, `comment`, `paid`, `amount_paid`, `date_paid`, `payment_id`, `payment_mode`, `payment_notes`, `processed_by`, `date_processed`, `ship_title`, `ship_first_name`, `ship_last_name`, `ship_other_name`, `ship_email`, `ship_phone`, `ship_country`, `ship_state`, `ship_address`, `ship_apartment`, `ship_is_bill`, `ship_extra`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 3, 'RF15E56C5411', 3, NULL, 1, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2020-02-26 19:21:37', '2020-03-01 18:03:41'),
(2, 4, 'RF25E56CE879', 3, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2020-02-26 20:01:11', '2020-03-01 21:54:44'),
(3, 4, 'RF35E56D12B5', 5, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2020-02-26 20:12:27', '2020-03-01 22:13:05'),
(4, 4, 'RF45E56D6A80', 5, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2020-02-26 20:35:52', '2020-03-01 21:54:44'),
(5, 3, 'RF55E56EA4AF', 3, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2020-02-26 21:59:38', '2020-03-01 13:10:53'),
(6, 4, 'RF65E56EDB8C', 5, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, '2020-02-26 22:14:16', '2020-03-01 21:54:44'),
(7, 3, 'RF75E595D008', 3, NULL, 0, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', 1, 'Deliver My Goods On Time Biko', 0, '2020-02-28 18:33:36', '2020-03-01 19:35:02'),
(8, 4, 'RF85E595DD0B', 3, NULL, 0, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', 1, 'Deliver My Goods On Time Biko', 0, '2020-02-28 18:37:04', '2020-03-01 21:54:44'),
(9, 3, 'RF95E596C3CA', 5, NULL, 1, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', 1, 'Deliver My Goods On Time Biko', 0, '2020-02-28 19:38:36', '2020-03-01 19:35:02'),
(10, 3, 'RF105E908D82', 1, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', NULL, 'Deliver My Goods On Time Biko', 0, '2020-04-10 15:15:14', '2020-04-10 17:12:13'),
(11, 3, 'RF115E9098A7', 1, NULL, 0, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', NULL, 'Deliver My Goods On Time Biko', 0, '2020-04-10 16:02:47', '2020-04-10 17:12:13'),
(12, 3, 'RF125E90A266', 1, NULL, 0, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', NULL, 'Deliver My Goods On Time Biko', 0, '2020-04-10 16:44:22', '2020-04-10 17:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `color` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - Unprocessed\n1 - Processed',
  `comment` varchar(1000) DEFAULT NULL,
  `deducted` tinyint(1) DEFAULT '0',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `size`, `color`, `status`, `comment`, `deducted`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 1, 17, 2, 1800, NULL, 0, 0, NULL, 0, 0, '2020-02-26 19:21:37', NULL),
(2, 1, 11, 5, 400, NULL, 0, 0, NULL, 0, 0, '2020-02-26 19:21:37', NULL),
(3, 2, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-02-26 20:01:11', NULL),
(4, 2, 18, 1, 1300, NULL, 0, 0, NULL, 0, 0, '2020-02-26 20:01:11', NULL),
(5, 3, 12, 1, 2000, NULL, 0, 0, NULL, 0, 0, '2020-02-26 20:12:27', NULL),
(6, 4, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-02-26 20:35:52', NULL),
(7, 4, 12, 1, 2000, NULL, 0, 0, NULL, 0, 0, '2020-02-26 20:35:52', NULL),
(8, 5, 1, 1, 2600, NULL, 0, 0, NULL, 0, 0, '2020-02-26 21:59:39', NULL),
(9, 6, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-02-26 22:14:16', NULL),
(10, 6, 18, 1, 1300, NULL, 0, 0, NULL, 0, 0, '2020-02-26 22:14:16', NULL),
(11, 7, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-02-28 18:33:36', NULL),
(12, 7, 11, 1, 400, NULL, 0, 0, NULL, 0, 0, '2020-02-28 18:33:36', NULL),
(13, 7, 12, 1, 2000, NULL, 0, 0, NULL, 0, 0, '2020-02-28 18:33:36', NULL),
(14, 8, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-02-28 18:37:04', NULL),
(15, 8, 18, 2, 1300, NULL, 0, 0, NULL, 0, 0, '2020-02-28 18:37:04', NULL),
(16, 9, 18, 1, 1300, NULL, 0, 0, NULL, 1, 0, '2020-02-28 19:38:36', '2020-03-01 18:45:13'),
(17, 9, 11, 1, 400, NULL, 0, 1, NULL, 1, 0, '2020-02-28 19:38:36', '2020-03-01 18:40:39'),
(18, 10, 13, 1, 1200, NULL, 0, 0, NULL, 0, 0, '2020-04-10 15:15:14', NULL),
(19, 10, 15, 1, 750, NULL, 0, 0, NULL, 0, 0, '2020-04-10 15:15:14', NULL),
(20, 11, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-04-10 16:02:47', NULL),
(21, 11, 18, 1, 1300, NULL, 0, 0, NULL, 0, 0, '2020-04-10 16:02:47', NULL),
(22, 11, 1, 1, 2600, NULL, 0, 0, NULL, 0, 0, '2020-04-10 16:02:47', NULL),
(23, 12, 17, 1, 1800, NULL, 0, 0, NULL, 0, 0, '2020-04-10 16:44:22', NULL),
(24, 12, 18, 1, 1300, NULL, 0, 0, NULL, 0, 0, '2020-04-10 16:44:22', NULL),
(25, 12, 19, 1, 3600, NULL, 0, 0, NULL, 0, 0, '2020-04-10 16:44:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `other_name` varchar(25) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `tranx_ref` varchar(45) DEFAULT NULL,
  `provider` varchar(20) DEFAULT NULL,
  `provider_ref` varchar(30) DEFAULT NULL,
  `amount` int(7) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `cat_id` int(10) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `serial_no` varchar(20) DEFAULT NULL,
  `stock` int(6) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `price_old` double DEFAULT NULL,
  `description` text,
  `image` varchar(45) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `size` tinyint(3) DEFAULT NULL,
  `other_sizes` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `p_tags` varchar(255) DEFAULT NULL,
  `colors` varchar(255) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT '0',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `templates_ibfk_1_idx` (`company_id`),
  KEY `cat_id` (`cat_id`),
  KEY `size` (`size`),
  KEY `color` (`colors`),
  KEY `tags` (`tags`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `name`, `cat_id`, `barcode`, `serial_no`, `stock`, `price`, `price_old`, `description`, `image`, `images`, `size`, `other_sizes`, `tags`, `p_tags`, `colors`, `rating`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, 'CareKare Car Wash', 2, NULL, NULL, 71, 2600, 2800, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. <br />\r\n<br />\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br />\r\n<br />\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'car_wash.jpg', 'car_wash.jpg', 5, NULL, '1,2,3', '4,1', '97,2,3,6,9,20', 3, 0, '2020-01-12 11:45:12', '2020-02-22 21:06:45'),
(10, 2, 'CareKare Car Wash', 2, NULL, NULL, 14, 3700, 5300, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. <br />\r\n<br />\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br />\r\n<br />\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'car_wash2.jpg', 'car_wash2.jpg', 10, NULL, '1,3', '1,3', '31,33', 5, 0, '2020-01-12 11:45:12', '2020-02-22 21:06:45'),
(11, 2, 'KitchCare  Dish Wash', 1, NULL, NULL, 107, 400, 546, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'dish_wash.jpg', 'dish_wash.jpg', 1, NULL, '1,2,3', '2,3', '85,90,105,120,2,13', 2, 0, '2020-01-12 11:45:12', '2020-03-01 18:40:39'),
(12, 2, 'FabriCare Fabric Wash', 3, NULL, NULL, 60, 2000, 2300, NULL, 'fabric_wash.jpg', 'fabric_wash.jpg', 5, NULL, '1', NULL, '60,55,40,57', 4, 0, '2020-01-12 11:45:12', '2020-02-22 21:06:45'),
(13, 2, 'LooNeat Toilet Cleaner', 4, NULL, NULL, 31, 1200, 1500, NULL, 'toilet_cleaner.jpg', 'toilet_cleaner.jpg', 4, NULL, '1,3', NULL, '23', 3, 0, '2020-01-12 11:45:12', '2020-02-22 21:12:47'),
(14, 2, 'HanyWash Handwash Gel', 6, NULL, NULL, 200, 990, 1100, NULL, 'hand_wash.jpg', 'hand_wash.jpg', 2, NULL, '1,2,5', '1', NULL, 5, 0, '2020-01-12 11:45:12', '2020-02-22 21:12:47'),
(15, 2, 'Sana Bleach', 5, NULL, NULL, 30, 750, 900, NULL, 'bleach.jpg', 'bleach.jpg', 10, NULL, '1,4', NULL, '7,10,11,12,77', 1, 0, '2020-01-12 11:45:12', '2020-02-22 21:06:45'),
(16, 2, 'FloorVendar Tile Cleaner', 7, '3443', NULL, 3, 2500, 3000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. <br />\r\n<br />\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br />\r\n<br />\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />\r\n<br />\r\njames cameron brooo', 'tile_cleaner.jpg', 'tile_cleaner.jpg', 11, NULL, NULL, '6', NULL, 0, 0, '2020-01-12 12:32:31', '2020-04-16 03:42:34'),
(17, 2, 'SqueaKlean Stain Remover', 8, NULL, NULL, 19, 1800, 2200, NULL, 'glass_cleaner.jpg', 'glass_cleaner.jpg', 10, NULL, '4', '1,3,2', NULL, 5, 0, '2020-01-12 12:32:31', '2020-02-22 21:07:13'),
(18, 2, 'Rubyttol Antiseptic', 8, NULL, NULL, 15, 1300, 2200, NULL, 'antiseptic.jpg', 'antiseptic.jpg', 5, NULL, '4', '1,3,2', NULL, 5, 0, '2020-01-12 12:32:31', '2020-03-01 18:45:13'),
(19, 2, 'HanyRub Hand Sanitizer', 8, NULL, NULL, 19, 3600, 4100, NULL, 'sanitizer.jpg', 'sanitizer.jpg', 5, NULL, '4', '1,3,2', NULL, 5, 0, '2020-01-12 12:32:31', '2020-02-22 21:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_cats`
--

DROP TABLE IF EXISTS `product_cats`;
CREATE TABLE IF NOT EXISTS `product_cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `order` int(4) DEFAULT '100',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_categories_ibfk_2_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_cats`
--

INSERT INTO `product_cats` (`id`, `company_id`, `name`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, 'Dish Wash', 100, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37'),
(2, 2, 'Car Wash', 2, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37'),
(3, 2, 'Fabric Wash', 3, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37'),
(4, 2, 'Toilet Wash', 6, 0, '2020-01-11 13:29:09', '2020-04-16 04:01:18'),
(5, 2, 'Bleach', 5, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37'),
(6, 2, 'Handwash Gel', 6, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37'),
(7, 2, 'Tile Cleaner', 7, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37'),
(8, 2, 'Stain Remover', 8, 0, '2020-01-11 13:29:09', '2020-02-22 17:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `short_name` varchar(10) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `index1` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `company_id`, `short_name`, `name`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, '1L', '1 Litre', 1, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(2, 2, '2L', '2 Litres', 2, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(3, 2, '3L', '3 Litres', 3, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(4, 2, '4L', '4 Litres', 4, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(5, 2, '5L', '5 Litres', 5, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(6, 2, '6L', '6 Litres', 6, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(7, 2, '7L', '7 Litres', 7, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(8, 2, '8L', '8 Litres', 8, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(9, 2, '9L', '9 Litres', 9, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(10, 2, '10L', '10 Litres', 10, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(11, 2, '15L', '15 Litres', 11, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(12, 2, '20L', '20 Litres', 17, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46'),
(13, 2, '25L', '25 Litres', 13, 0, '2020-01-11 13:49:56', '2020-02-22 17:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

DROP TABLE IF EXISTS `product_tags`;
CREATE TABLE IF NOT EXISTS `product_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `order` int(4) DEFAULT '100',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_tags_ibfk_2_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `company_id`, `short_name`, `name`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, 'Car Wash', 'Car Wash', 1, 0, '2020-02-16 18:20:39', '2020-02-22 17:25:54'),
(2, 2, 'Dish Wash', 'Dish Wash', 2, 0, '2020-02-16 18:31:37', '2020-02-22 17:25:54'),
(3, 2, 'Glass Cleaner', 'Glass Cleaner', 3, 0, '2020-02-17 17:36:21', '2020-02-22 17:25:54'),
(4, 2, 'Toilet', 'Toilet', 4, 0, '2020-02-17 17:47:57', '2020-02-22 17:25:54'),
(5, 2, 'Tiles', 'Tiles', 5, 0, '2020-04-16 02:40:21', NULL),
(6, 2, 'Tiles2', 'Tiles3', 6, 0, '2020-04-16 02:42:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `order` int(4) DEFAULT '0',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `services_ibfk_2_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `home_slider` tinyint(1) DEFAULT '0',
  `shop_slider` tinyint(1) DEFAULT '0',
  `sidebar_slider` tinyint(1) DEFAULT '1',
  `shop_sidebar_position` varchar(5) DEFAULT 'left',
  `blog_sidebar_position` varchar(5) DEFAULT 'right',
  `home_banner` tinyint(1) DEFAULT '1',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `settings_ibfk_2_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_id`, `home_slider`, `shop_slider`, `sidebar_slider`, `shop_sidebar_position`, `blog_sidebar_position`, `home_banner`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 1, 1, 0, 1, 'left', 'right', 1, 0, '2020-02-11 22:19:59', '2020-02-22 17:27:43'),
(2, 2, 1, 0, 1, 'left', 'right', 1, 0, '2020-02-11 22:19:59', '2020-02-22 17:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `cat_id` int(2) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `order` tinyint(2) DEFAULT '10',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sliders_ibfk_2_idx` (`company_id`),
  KEY `sliders_ibfk_3_idx` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `company_id`, `cat_id`, `name`, `url`, `image`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, 1, 'Happy New Year 2020', NULL, 'slide1.jpeg', 1, 0, '2020-01-11 15:41:49', '2020-02-22 17:28:26'),
(2, 2, 1, 'Your Clothes Deserve Menmi', 'http://menmi.com/shop', 'slide2.jpeg', 2, 0, '2020-01-11 15:41:49', '2020-02-22 17:28:26'),
(3, 2, 1, 'Merry Christmas', '', 'slide3.jpeg', 3, 0, '2020-01-11 15:41:49', '2020-02-22 17:28:26'),
(4, 2, 2, 'Happy New Year 2020', NULL, 'slide21.jpeg', 1, 0, '2020-01-11 15:41:49', '2020-02-22 17:28:26'),
(5, 2, 2, 'Your Clothes Deserve Menmi', 'http://menmi.com/shop', 'slide22.jpeg', 2, 0, '2020-01-11 15:41:49', '2020-02-22 17:28:26'),
(6, 2, 2, 'Merry Christmas', NULL, 'slide23.jpeg', 3, 0, '2020-01-11 15:41:49', '2020-02-22 17:28:26'),
(7, 2, 3, 'New Arrivals', 'http://menmi.com/shop', 'add-slide1.jpeg', 1, 0, '2020-02-15 19:58:33', '2020-03-02 01:51:12'),
(8, 2, 3, 'Spring Shopping', 'http://menmi.com/shop', 'add-slide2.jpeg', 2, 0, '2020-02-15 19:59:40', '2020-03-02 01:51:12'),
(9, 2, 3, 'Classy Menmi Detergent', 'http://menmi.com/shop', 'add-slide3.jpeg', 3, 0, '2020-02-15 20:00:46', '2020-04-16 00:52:22'),
(12, 2, 4, 'About Menmi 1', 'http://menmi.com/shop', 'about_us_slide1.jpg', 1, 0, '2020-02-15 20:00:46', '2020-02-22 17:28:26'),
(13, 2, 4, 'About Menmi 2', 'http://menmi.com/shop', 'about_us_slide2.jpg', 2, 0, '2020-02-15 20:00:46', '2020-02-22 17:28:26'),
(14, 2, 4, 'About Menmi 3', 'http://menmi.com/shop', 'about_us_slide3.jpg', 3, 0, '2020-02-15 20:00:46', '2020-02-22 17:28:26'),
(15, 2, 5, 'Home Banner 1', 'http://menmi.com/shop', 'banner1.png', 1, 0, '2020-03-01 22:51:45', '2020-03-02 00:11:09'),
(16, 2, 5, 'Home Banner 2', 'http://menmi.com/shop', 'banner2.png', 2, 0, '2020-03-01 22:51:45', '2020-03-02 00:11:09'),
(17, 2, 5, 'Home Banner 3', 'http://menmi.com/shop', 'banner3.png', 3, 0, '2020-03-01 22:51:45', '2020-03-02 00:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `slider_cats`
--

DROP TABLE IF EXISTS `slider_cats`;
CREATE TABLE IF NOT EXISTS `slider_cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `order` int(4) DEFAULT '100',
  `max` tinyint(2) DEFAULT '-1',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_cats`
--

INSERT INTO `slider_cats` (`id`, `name`, `title`, `order`, `max`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'home_top', 'Home Top', 1, 6, 0, '2020-01-23 14:35:30', '2020-02-17 19:08:14'),
(2, 'shop_top', 'Shop Top', 2, 6, 0, '2020-01-23 14:35:30', '2020-02-17 19:08:14'),
(3, 'sidebar', 'Sidebar', 3, 3, 0, '2020-02-14 23:15:16', '2020-02-17 19:08:14'),
(4, 'about', 'About Us', 4, 3, 0, '2020-02-16 08:35:06', '2020-02-17 19:08:14'),
(5, 'home_banner', 'Home Banner', 1, 3, 0, '2020-02-23 21:09:58', '2020-02-28 17:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `country_id` int(3) DEFAULT NULL,
  `order` int(3) DEFAULT '0',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'Abuja (FCT)', 135, 1, 0, '2020-02-24 07:28:27', NULL),
(2, 'Abia', 135, 2, 0, '2020-02-24 07:28:27', NULL),
(3, 'Adamawa', 135, 3, 0, '2020-02-24 07:28:27', NULL),
(4, 'Akwa Ibom', 135, 4, 0, '2020-02-24 07:28:27', NULL),
(5, 'Anambra', 135, 5, 0, '2020-02-24 07:28:27', NULL),
(6, 'Bauchi', 135, 6, 0, '2020-02-24 07:28:27', NULL),
(7, 'Bayelsa', 135, 7, 0, '2020-02-24 07:28:27', NULL),
(8, 'Benue', 135, 8, 0, '2020-02-24 07:28:27', NULL),
(9, 'Borno', 135, 9, 0, '2020-02-24 07:28:27', NULL),
(10, 'Cross River', 135, 10, 0, '2020-02-24 07:28:27', NULL),
(11, 'Delta', 135, 11, 0, '2020-02-24 07:28:27', NULL),
(12, 'Ebonyi', 135, 12, 0, '2020-02-24 07:28:27', NULL),
(13, 'Edo', 135, 13, 0, '2020-02-24 07:28:27', NULL),
(14, 'Ekiti', 135, 14, 0, '2020-02-24 07:28:27', NULL),
(15, 'Enugu', 135, 15, 0, '2020-02-24 07:28:27', NULL),
(16, 'Gombe', 135, 16, 0, '2020-02-24 07:28:27', NULL),
(17, 'Imo', 135, 17, 0, '2020-02-24 07:28:27', NULL),
(18, 'Jigawa', 135, 18, 0, '2020-02-24 07:28:27', NULL),
(19, 'Kaduna', 135, 19, 0, '2020-02-24 07:28:27', NULL),
(20, 'Kano', 135, 20, 0, '2020-02-24 07:28:27', NULL),
(21, 'Katsina', 135, 21, 0, '2020-02-24 07:28:27', NULL),
(22, 'Kebbi', 135, 22, 0, '2020-02-24 07:28:27', NULL),
(23, 'Kogi', 135, 23, 0, '2020-02-24 07:28:27', NULL),
(24, 'Kwara', 135, 24, 0, '2020-02-24 07:28:27', NULL),
(25, 'Lagos', 135, 25, 0, '2020-02-24 07:28:27', NULL),
(26, 'Nasarawa', 135, 26, 0, '2020-02-24 07:28:27', NULL),
(27, 'Niger', 135, 27, 0, '2020-02-24 07:28:27', NULL),
(28, 'Ogun', 135, 28, 0, '2020-02-24 07:28:27', NULL),
(29, 'Ondo', 135, 29, 0, '2020-02-24 07:28:27', NULL),
(30, 'Osun', 135, 30, 0, '2020-02-24 07:28:27', NULL),
(31, 'Oyo', 135, 31, 0, '2020-02-24 07:28:27', NULL),
(32, 'Plateau', 135, 32, 0, '2020-02-24 07:28:27', NULL),
(33, 'Rivers', 135, 33, 0, '2020-02-24 07:28:27', NULL),
(34, 'Sokoto', 135, 34, 0, '2020-02-24 07:28:27', NULL),
(35, 'Taraba', 135, 35, 0, '2020-02-24 07:28:27', NULL),
(36, 'Yobe', 135, 36, 0, '2020-02-24 07:28:27', NULL),
(37, 'Zamfara', 135, 37, 0, '2020-02-24 07:28:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  `name` varchar(15) NOT NULL,
  `title` varchar(45) NOT NULL,
  `key` varchar(20) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `bs_bg` varchar(20) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `type`, `name`, `title`, `key`, `color`, `bs_bg`, `icon`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'order', 'pending', 'Pending', '1', 'grey', 'info', NULL, 0, '2020-02-28 02:28:05', NULL),
(2, 'order', 'received', 'Received', '2', 'grey', 'info', NULL, 0, '2020-02-28 02:28:05', NULL),
(3, 'order', 'cancelled', 'Cancelled', '3', 'red', 'danger', NULL, 0, '2020-02-28 02:28:05', NULL),
(4, 'order', 'processed', 'Processed', '4', 'blue', 'primary', NULL, 0, '2020-02-28 02:28:05', NULL),
(5, 'order', 'transit', 'In Transit', '5', 'blue', 'primary', NULL, 0, '2020-02-28 02:28:05', NULL),
(6, 'order', 'delivered', 'Delivered', '6', 'blue', 'success', NULL, 0, '2020-02-28 02:28:05', NULL),
(7, 'order', 'completed', 'Completed', '7', 'green', 'success', NULL, 0, '2020-02-28 02:28:05', NULL),
(8, 'payment', 'online', 'Online', '1', NULL, NULL, NULL, 0, '2020-02-28 02:28:05', NULL),
(9, 'payment', 'offline', 'Offline', '2', NULL, NULL, NULL, 0, '2020-02-28 02:28:05', NULL),
(10, 'sex', 'male', 'Male', '1', NULL, NULL, NULL, 0, '2020-02-28 02:41:01', NULL),
(11, 'sex', 'female', 'Female', '2', NULL, NULL, NULL, 0, '2020-02-28 02:41:01', NULL),
(12, 'sex', 'other', 'Other', '0', NULL, NULL, NULL, 0, '2020-02-28 02:41:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `other_name` varchar(25) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `index_id` (`id`),
  KEY `index_comp` (`company_id`),
  KEY `index_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `company_id`, `title`, `first_name`, `last_name`, `other_name`, `email`, `phone`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, NULL, '', '', NULL, 'valkaycelestino@gmail.com', NULL, 0, '2020-02-16 09:10:53', '2020-02-22 17:23:57'),
(2, 2, NULL, '', '', NULL, 'nwankwoikemefuna23@gmail.com', NULL, 0, '2020-02-16 09:12:19', '2020-02-22 17:23:57'),
(3, 2, NULL, '', '', NULL, 'valkaycelestino223@gmail.com', NULL, 0, '2020-03-02 08:40:35', NULL),
(4, 2, NULL, '', '', NULL, 'valkaycelestinoxxx@gmail.com', NULL, 0, '2020-03-02 08:41:32', NULL),
(5, 2, NULL, '', '', NULL, 'menmi.washup223@gmail.com', NULL, 0, '2020-03-02 08:42:32', NULL),
(6, 2, NULL, '', '', NULL, 'valkaycelestino33444@gmail.com', NULL, 0, '2020-03-02 08:45:52', NULL),
(7, 2, NULL, '', '', NULL, 'valkaycelestino334@gmail.com', NULL, 0, '2020-03-02 08:48:56', NULL),
(8, 2, NULL, '', '', NULL, 'valkaycelestino233@gmail.com', NULL, 0, '2020-03-02 08:52:10', NULL),
(9, 2, NULL, '', '', NULL, 'valkaycelestin3333o@gmail.com', NULL, 0, '2020-03-02 08:53:34', NULL),
(10, 2, NULL, '', '', NULL, 'valkaycelestino222@gmail.com', NULL, 0, '2020-03-02 08:54:46', NULL),
(11, 2, NULL, '', '', NULL, 'valkaycelest334ino@gmail.com', NULL, 0, '2020-03-02 08:55:46', NULL),
(12, 2, NULL, '', '', NULL, 'nwankwoikemsdsefuna23@gmail.co', NULL, 0, '2020-03-02 09:00:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `order` int(4) DEFAULT '100',
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `title`, `order`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 'featured', 'Featured', 1, 0, '2020-01-12 11:26:58', '2020-01-12 12:29:29'),
(2, 'splash', 'Splash Deal', 2, 0, '2020-01-12 11:26:58', '2020-01-12 12:29:29'),
(3, 'popular', 'Popular', 3, 0, '2020-01-12 11:26:58', '2020-01-12 13:33:57'),
(4, 'new', 'New', 4, 0, '2020-01-12 11:26:58', '2020-01-12 13:33:57'),
(5, 'old', 'Old', 10, 0, '2020-01-12 11:40:01', '2020-01-12 12:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup` int(11) DEFAULT '2',
  `company_id` int(10) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `other_name` varchar(25) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `password_set` tinyint(1) DEFAULT '0',
  `sex` tinyint(1) DEFAULT '0',
  `country` int(3) DEFAULT NULL,
  `state` int(2) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `apartment` varchar(15) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `ship_title` varchar(10) DEFAULT NULL,
  `ship_first_name` varchar(25) NOT NULL,
  `ship_last_name` varchar(25) NOT NULL,
  `ship_other_name` varchar(25) DEFAULT NULL,
  `ship_email` varchar(45) NOT NULL,
  `ship_phone` varchar(20) DEFAULT NULL,
  `ship_country` int(3) DEFAULT NULL,
  `ship_state` int(2) DEFAULT NULL,
  `ship_address` varchar(60) DEFAULT NULL,
  `ship_apartment` varchar(15) DEFAULT NULL,
  `ship_is_bill` tinyint(1) DEFAULT '1',
  `ship_extra` varchar(1000) DEFAULT NULL,
  `payment_method` tinyint(2) DEFAULT '1',
  `level` int(2) DEFAULT '5',
  `permissions` varchar(1000) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `token_period` varchar(15) DEFAULT NULL,
  `token_date` datetime DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `index2` (`id`),
  KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usergroup`, `company_id`, `title`, `first_name`, `last_name`, `other_name`, `email`, `phone`, `username`, `password`, `password_set`, `sex`, `country`, `state`, `address`, `apartment`, `photo`, `ship_title`, `ship_first_name`, `ship_last_name`, `ship_other_name`, `ship_email`, `ship_phone`, `ship_country`, `ship_state`, `ship_address`, `ship_apartment`, `ship_is_bill`, `ship_extra`, `payment_method`, `level`, `permissions`, `token`, `token_period`, `token_date`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 2, 1, NULL, 'SoftMall', 'Transact', NULL, 'account@softmall.com', NULL, 'softmall', '$2y$10$63vjOZDgUD2xbhMkqPGhi.T6RRBwaJQXt9m4C3VcYmO56kHf1r3nG', 0, 1, NULL, 25, NULL, NULL, 'softmall.png', NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 8, 1, '1#1|2|3|4&2#1|2|3|4', 'v1q7GX9cR', '10 year', '2020-12-21 07:00:16', 0, '2019-12-28 14:00:57', '2020-04-10 17:13:08'),
(2, 2, 2, NULL, 'Nkabono', 'Nglass', NULL, 'menmi.washup@gmail.com', NULL, 'nglass', '$2y$10$vn2b98Hzezc018vLlfmuz.YOT18KgE3rN.yaOpT/Qn0rQgMZy.hHi', 1, 1, NULL, 4, NULL, NULL, 'nglass.png', NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, 8, 1, '1#1|2|3|4&2#1|2|3|4', 'v1q7GX9cR', '1 month', '2020-12-21 07:00:16', 0, '2019-12-28 14:00:57', '2020-04-10 17:13:08'),
(3, 4, NULL, NULL, 'Ikemefuna', 'Nwankwo', NULL, 'valkaycelestino@gmail.com', '07063418556', NULL, '$2y$10$PmynMO/YSdf5yuEWnAHrMOKxvaeKV22Dij0.j2MS6xHU/9r7wLCv2', 1, 1, NULL, 12, '10 Oweh Street, Jibowu, Lagos', '10', NULL, NULL, 'Celestino', 'Valkay', NULL, 'ikemvalkay@yaho.com', '07063339220', NULL, 25, 'Somewhere Close To Yaba', '192', NULL, 'Deliver My Goods On Time Biko', 9, 5, NULL, NULL, NULL, NULL, 0, '2020-02-23 07:57:34', '2020-04-10 17:44:22'),
(4, 4, NULL, NULL, 'Odion', 'Ighalo', NULL, 'ighalo@gmail.com', '09063418556', NULL, '$2y$10$PmynMO/YSdf5yuEWnAHrMOKxvaeKV22Dij0.j2MS6xHU/9r7wLCv2', 1, 1, NULL, 12, '90 Canada Street, Abeokuta', '37', NULL, NULL, 'Odion', 'Samson', NULL, 'orion@yaho.com', '08063339220', NULL, 10, 'Somewhere Close to Gariki', '399', 0, 'Deliver My Goods On Time Ejoor', 9, 5, NULL, NULL, NULL, NULL, 0, '2020-02-23 07:57:34', '2020-04-10 17:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `title`, `trashed`, `date_created`, `date_updated`) VALUES
(1, 's_admin', 'Super Admin', 0, '2020-01-04 06:48:47', '2020-01-04 08:05:26'),
(2, 'admin', 'Admin', 0, '2020-01-04 06:48:47', NULL),
(3, 'staff', 'Staff', 0, '2020-02-22 15:25:21', '2020-02-22 16:26:32'),
(4, 'customer', 'Customer', 0, '2020-01-04 06:48:47', '2020-02-22 16:26:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `companies_ibfk_2` FOREIGN KEY (`curr_id`) REFERENCES `currencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `product_cats` (`id`);

--
-- Constraints for table `product_cats`
--
ALTER TABLE `product_cats`
  ADD CONSTRAINT `product_cats_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sliders_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `slider_cats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
