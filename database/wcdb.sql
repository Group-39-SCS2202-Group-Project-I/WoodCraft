-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2024 at 10:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wcdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` mediumint(8) UNSIGNED NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_line_1`, `address_line_2`, `city`, `zip_code`) VALUES
(2, '150', 'Pahala Biyanwila', 'KA', '11851'),
(3, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(4, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(5, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(6, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(7, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(8, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(9, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(11, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(13, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(14, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(16, '150/A, Kandy Road', '150/A, Kandy Road', 'Kadawatha', '11850'),
(21, '123', 'Gampaha Road', 'Yakkala', '12345'),
(22, '123', 'Gampaha Road', 'Yakkala', '12345'),
(23, '123', 'Gampaha Road', 'Yakkala', '12345'),
(24, '123', 'Gampaha Road', 'Yakkala', '12345'),
(25, '123', 'Gampaha Road', 'Yakkala', '12345'),
(28, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawa', '11851'),
(30, '123', 'ssss', 'sssss', '12122'),
(31, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(32, '123', 'adadddad', 'adada', '12133'),
(33, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(34, '123', 'Pahala s', 'Gampaha', '12331'),
(35, '1111', '22222', '333333', '12344'),
(36, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(37, 'asdads', 'adsdas', 'asdadad', '11850'),
(38, 'asdads', 'adsdas', 'asdadad', '11850'),
(39, 'asdads', 'adsdas', 'asdadad', '11850'),
(40, '2112', '1212', 'sddsadd', '21233'),
(44, '150/A', 'Kandy Road', 'Kadawatha', '11850'),
(45, '150/A', 'Kandy Road', 'Kadawatha', '11850'),
(46, '150/A', 'Kandy Road', 'Kadawatha', '11850'),
(47, '150', 'Kandadadady Road', 'Kaddadaawatha', '11350'),
(48, '150/A', 'Kandy Road', 'Kadawatha', '11850'),
(49, '150/A', 'Kandy Road', 'Kadawatha', '11850'),
(50, '150/A', 'Kandy Road', 'Kadawatha', '11850'),
(51, '31331', '1212', 'Kiribathgoda', '21313'),
(52, '150/A', 'Kandy Road', 'Kadawatha', '11850');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_order`
--

CREATE TABLE `bulk_order` (
  `bulk_order_id` mediumint(8) UNSIGNED NOT NULL,
  `order_details_id` mediumint(8) UNSIGNED NOT NULL,
  `customer_id` mediumint(8) UNSIGNED NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` mediumint(8) UNSIGNED NOT NULL,
  `shopping_session_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item_delivery_cost`
--

CREATE TABLE `cart_item_delivery_cost` (
  `cart_item_delivery_cost_id` mediumint(8) UNSIGNED NOT NULL,
  `cart_item_id` mediumint(8) UNSIGNED NOT NULL,
  `delivery_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `address_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`, `first_name`, `last_name`, `telephone`, `address_id`) VALUES
(6, 11, 'Lasith', 'Ranahewa', '0766716265', 14),
(8, 20, 'Lasith', 'Ranahewa', '0766716265', 45),
(9, 26, 'jdad', 'addad', '0213331311', 51);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` mediumint(8) UNSIGNED NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount_percent` mediumint(8) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `description`, `discount_percent`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'new year', 'hehehehe', 5, 0, '2023-12-23 09:11:17', '2023-12-23 09:11:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` mediumint(8) UNSIGNED NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `material_description` text DEFAULT NULL,
  `stock_available` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_name`, `material_description`, `stock_available`, `created_at`, `updated_at`) VALUES
(1, 'addaad', 'sadadad', 0, '2023-12-30 14:00:29', '2023-12-30 14:00:29'),
(2, 'dqdqs', 'eqdqddq', 0, '2024-01-01 05:40:28', '2024-01-01 05:40:28'),
(3, 'asdasdasdasdad', 'sfasfasf', 0, '2024-01-01 05:40:37', '2024-01-01 17:38:16'),
(6, 'asdasdadasd', '', 0, '2024-01-01 05:51:46', '2024-01-01 05:51:46'),
(8, 'dsdd', '', 0, '2024-01-02 08:27:09', '2024-01-02 08:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `material_order`
--

CREATE TABLE `material_order` (
  `material_order_id` mediumint(8) UNSIGNED NOT NULL,
  `material_id` mediumint(8) UNSIGNED NOT NULL,
  `supplier_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` mediumint(8) UNSIGNED NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `material_order`
--
DELIMITER $$
CREATE TRIGGER `calculate_total` BEFORE INSERT ON `material_order` FOR EACH ROW BEGIN
   SET NEW.total = NEW.quantity * NEW.price_per_unit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `order_type` enum('retail','bulk') NOT NULL DEFAULT 'retail',
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','delivering','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_id` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` mediumint(8) UNSIGNED NOT NULL,
  `order_details_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` mediumint(8) UNSIGNED NOT NULL,
  `order_details_id` mediumint(8) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `product_category_id` mediumint(8) UNSIGNED NOT NULL,
  `product_inventory_id` mediumint(8) UNSIGNED NOT NULL,
  `product_measurement_id` mediumint(8) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `product_category_id`, `product_inventory_id`, `product_measurement_id`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Brooklyn Sofa', 'The Brooklyn Sofa in Pink is a chic and modern addition to your living space. With its sleek silhouette and soft pink upholstery, it effortlessly combines style and comfort. ', 32, 7, 7, 227699.00, '2023-12-29 17:38:47', '2023-12-29 17:41:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `production_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` mediumint(8) UNSIGNED NOT NULL,
  `status` enum('pending','processing','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`production_id`, `product_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 3, 'pending', '2024-01-01 17:15:53', '2024-01-01 17:15:53'),
(2, 7, 1, 'completed', '2024-01-01 17:16:18', '2024-01-01 17:16:18'),
(3, 7, 8, 'processing', '2024-01-01 17:33:18', '2024-01-01 17:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `production_worker`
--

CREATE TABLE `production_worker` (
  `production_worker_id` mediumint(8) UNSIGNED NOT NULL,
  `production_id` mediumint(8) UNSIGNED NOT NULL,
  `worker_id` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` mediumint(8) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `category_name`) VALUES
(32, 'Sofas'),
(33, 'Coffee Tables'),
(34, 'Divans and Wooden Benches'),
(35, 'TV Stands and Telephone Stands'),
(36, 'Bedroom Sets'),
(37, 'Wooden and Steel Beds'),
(38, 'Wooden Side Cupboards'),
(39, 'Dressing Tables and Mirror Stands');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image_url`, `created_at`) VALUES
(17, 7, 'uploads/images/1703871623ezgif-3-904f5f6809.jpg', '2023-12-29 17:40:23'),
(20, 7, 'uploads/images/1704166587barcelona-football-logo.jpeg', '2024-01-02 03:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `product_inventory_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`product_inventory_id`, `quantity`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_material`
--

CREATE TABLE `product_material` (
  `product_material_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `material_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity_needed` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_material`
--

INSERT INTO `product_material` (`product_material_id`, `product_id`, `material_id`, `quantity_needed`, `created_at`, `updated_at`) VALUES
(5, 7, 2, 5, '2024-01-01 15:13:14', '2024-01-01 15:37:31'),
(7, 7, 6, 33, '2024-01-02 04:55:50', '2024-01-02 04:55:50'),
(8, 7, 3, 66, '2024-01-02 09:10:32', '2024-01-02 09:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_measurement`
--

CREATE TABLE `product_measurement` (
  `product_measurement_id` mediumint(8) UNSIGNED NOT NULL,
  `length` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_measurement`
--

INSERT INTO `product_measurement` (`product_measurement_id`, `length`, `width`, `height`, `weight`) VALUES
(1, 23.00, 23.00, 23.00, 23.00),
(2, 31.00, 12.00, 12.00, 12.00),
(3, 3131.00, 12.00, 13.00, 3.00),
(4, 12.00, 31.00, 12.00, 3.00),
(5, 32.00, 32.00, 1.00, 12.00),
(6, 223.00, 33.00, 13.00, 12.00),
(7, 238.76, 162.56, 83.82, 88.00);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_session`
--

CREATE TABLE `shopping_session` (
  `shopping_session_id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `address_id` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`, `first_name`, `last_name`, `mobile_number`, `address_id`, `created_at`, `updated_at`) VALUES
(1, 13, 'aaa', 'dasdadaddad', '0444444421', 35, '2023-12-20 02:25:13', '2023-12-23 07:50:26'),
(2, 17, 'Laqwqwsith', 'sqq', '0987654321', 39, '2023-12-20 04:17:58', '2023-12-20 04:17:58'),
(3, 18, 'dadad', 'dadad', '0998712612', 40, '2023-12-20 05:35:14', '2023-12-20 05:35:14'),
(5, 21, 'dsd', 'adaa', '1212121212', 46, '2023-12-22 13:24:50', '2023-12-22 13:24:50'),
(6, 22, 'khkhwda', 'ad', '0766716265', 47, '2023-12-23 12:51:41', '2023-12-23 12:51:41'),
(7, 23, 'Kasun', 'Kasun', '0766716265', 48, '2023-12-28 06:09:32', '2023-12-28 06:09:32'),
(8, 24, 'lasith', 'madhuka', '0766716265', 49, '2023-12-28 06:16:46', '2023-12-28 06:16:46'),
(9, 25, 'ada', 'aad', '0766716265', 50, '2023-12-28 15:15:52', '2023-12-28 15:15:52'),
(10, 27, 'pm', 'wcf', '0766716265', 52, '2023-12-30 09:32:58', '2023-12-30 09:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_details`
--

CREATE TABLE `supplier_details` (
  `supplier_id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `brn` varchar(255) NOT NULL,
  `address_id` mediumint(8) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','osr','gm','sk','pm','admin') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(2, 'gm@wcf.com', '$2y$10$EAgW.SKfo10oqiu3PNtoZu9rG1wuAtMceaiSmgu3rjZM1MCMb6ruu', 'gm', '2023-12-15 07:42:12', '2023-12-15 07:42:12'),
(3, 'sk@wcf.com', '$2y$10$qLVwYIIFxV9EK3DMgsAXzOLjFeJ8iCnbOS9YCRmh8YS8B8eXkhCg.', 'sk', '2023-12-15 07:42:33', '2023-12-15 07:42:33'),
(4, 'adm@wcf.com', '$2y$10$057tmqTRxHFPLu/zW6hDUewSMPYWG6iIJ3ERaZV8FfzrNYvw4pSlO', 'admin', '2023-12-15 07:42:54', '2023-12-15 07:42:54'),
(5, 'pm@wcf.com', '$2y$10$d/v9oyvt0Y18ERV5nahkluw5gZl3swlvqXrJzYK32HDVmJZHUTILq', 'pm', '2023-12-15 07:43:22', '2023-12-15 07:43:22'),
(11, 'lasithmrana@gmail.com', '$2y$10$s5AfaZtSDpNB1PMz2Hk9rOoWZfOs95IMV/Jo3ii0hwDmtrzgVMtE.', 'customer', '2023-12-19 09:49:26', '2023-12-19 09:49:26'),
(13, 'aaaa@gmail.com', '$2y$10$9KtsJQGW3gzVxALC7hqi0u/ImmYX.DoRnXtXcdERocFwRaHSmwHTK', 'osr', '2023-12-20 02:24:06', '2023-12-20 02:24:06'),
(14, 'mashawickramasinghe04@gmail.com', '12345lmR#', 'gm', '2023-12-20 04:15:37', '2023-12-20 04:15:37'),
(15, 'test@test.com', '1422952lmR#', 'gm', '2023-12-20 04:16:51', '2023-12-20 04:16:51'),
(16, 'test2@test.com', '1422952lmR#', 'gm', '2023-12-20 04:17:25', '2023-12-20 04:17:25'),
(17, 'test3@test.com', '1422952lmR#', 'gm', '2023-12-20 04:17:58', '2023-12-20 04:17:58'),
(18, 'adad@test.com', '12345aA#', 'sk', '2023-12-20 05:35:14', '2023-12-20 05:35:14'),
(20, 'las@gmail.com', '$2y$10$ooN1lcevG15SSExRvu.sROvzRhbn1/k0WkG.BJhz2lyLK9E/F3CjG', 'customer', '2023-12-22 11:06:00', '2023-12-22 11:06:00'),
(21, 'dada@gmail.com', '1422952lmR#', 'pm', '2023-12-22 13:24:50', '2023-12-22 13:24:50'),
(22, 'test@gmail.com', '1234lmR#', 'pm', '2023-12-23 12:51:41', '2023-12-23 12:51:41'),
(23, 'osr@wcf.com', '12345aA#', 'osr', '2023-12-28 06:09:32', '2023-12-28 06:09:32'),
(24, 'lasithmrana2@gmail.com', '$2y$10$WftpSY/KsUlMNBzQz6m9ieZd753h7ITwGi9JCnTCYS.wtk6QjHUDm', 'osr', '2023-12-28 06:16:46', '2023-12-28 06:16:46'),
(25, 'dada@gmail.coma', '$2y$10$7OhOlh3fGPl3M3siy2lqG.qjjxVcIJUy1d6E2CDfi06gafdY.QDky', 'osr', '2023-12-28 15:15:52', '2023-12-28 15:15:52'),
(26, 'asds@gmail.com', '$2y$10$SjLsGZvD1wzvZFod94NlX.oZFkPxZOGvYCNECbreI04UVkw2As38i', 'customer', '2023-12-29 11:48:17', '2023-12-29 11:48:17'),
(27, 'pm@test.com', '$2y$10$r5oO/9Q2Aeg0.reSZp9ieu.cTko3QWXOI19cbkaeaJekf0ErOLBf2', 'pm', '2023-12-30 09:32:58', '2023-12-30 09:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `worker_id` mediumint(8) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `address_id` mediumint(8) UNSIGNED NOT NULL,
  `availability` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `first_name`, `last_name`, `mobile_number`, `address_id`, `availability`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'Lasith', 'Ranahewa', '0987654321', 28, 'available', '2023-12-19 16:38:44', '2023-12-19 18:22:49', NULL),
(18, 'Kathrine', 'Jess', '0765454421', 30, 'available', '2023-12-19 16:41:32', '2023-12-19 16:41:32', NULL),
(19, 'Lasith', 'Ranahewa', '0112133131', 31, 'available', '2023-12-19 16:46:36', '2023-12-19 16:46:36', NULL),
(20, 'Nimal', 'Kamal', '0779873553', 32, 'available', '2023-12-19 16:57:27', '2023-12-19 16:57:27', NULL),
(21, 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', '0987654322', 33, 'available', '2023-12-19 18:29:08', '2023-12-19 18:29:08', NULL),
(22, 'Amali', 'Bimal', '0213456789', 34, 'available', '2023-12-20 01:16:36', '2023-12-20 14:17:12', NULL),
(25, 'addadsasas', 'asasass', '0987654322', 44, 'available', '2023-12-21 09:27:27', '2023-12-28 05:54:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `bulk_order`
--
ALTER TABLE `bulk_order`
  ADD PRIMARY KEY (`bulk_order_id`),
  ADD KEY `order_details_id` (`order_details_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `shopping_session_id` (`shopping_session_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cart_item_delivery_cost`
--
ALTER TABLE `cart_item_delivery_cost`
  ADD PRIMARY KEY (`cart_item_delivery_cost_id`),
  ADD KEY `cart_item_id` (`cart_item_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `material_order`
--
ALTER TABLE `material_order`
  ADD PRIMARY KEY (`material_order_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_details_id` (`order_details_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_ibfk_2` (`product_inventory_id`),
  ADD KEY `product_ibfk_3` (`product_measurement_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`production_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `production_worker`
--
ALTER TABLE `production_worker`
  ADD PRIMARY KEY (`production_worker_id`),
  ADD KEY `production_id` (`production_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`product_inventory_id`);

--
-- Indexes for table `product_material`
--
ALTER TABLE `product_material`
  ADD PRIMARY KEY (`product_material_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `product_measurement`
--
ALTER TABLE `product_measurement`
  ADD PRIMARY KEY (`product_measurement_id`);

--
-- Indexes for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD PRIMARY KEY (`shopping_session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `supplier_details`
--
ALTER TABLE `supplier_details`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`),
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `bulk_order`
--
ALTER TABLE `bulk_order`
  MODIFY `bulk_order_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item_delivery_cost`
--
ALTER TABLE `cart_item_delivery_cost`
  MODIFY `cart_item_delivery_cost_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `material_order`
--
ALTER TABLE `material_order`
  MODIFY `material_order_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `production_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `production_worker`
--
ALTER TABLE `production_worker`
  MODIFY `production_worker_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `product_inventory_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_material`
--
ALTER TABLE `product_material`
  MODIFY `product_material_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_measurement`
--
ALTER TABLE `product_measurement`
  MODIFY `product_measurement_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `shopping_session_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier_details`
--
ALTER TABLE `supplier_details`
  MODIFY `supplier_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bulk_order`
--
ALTER TABLE `bulk_order`
  ADD CONSTRAINT `bulk_order_ibfk_1` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`order_details_id`),
  ADD CONSTRAINT `bulk_order_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`shopping_session_id`) REFERENCES `shopping_session` (`shopping_session_id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `cart_item_delivery_cost`
--
ALTER TABLE `cart_item_delivery_cost`
  ADD CONSTRAINT `cart_item_delivery_cost_ibfk_1` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_item` (`cart_item_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `material_order`
--
ALTER TABLE `material_order`
  ADD CONSTRAINT `material_order_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `material_order_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_details` (`supplier_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`order_details_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`product_inventory_id`) REFERENCES `product_inventory` (`product_inventory_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`product_measurement_id`) REFERENCES `product_measurement` (`product_measurement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `production_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `production_worker`
--
ALTER TABLE `production_worker`
  ADD CONSTRAINT `production_worker_ibfk_1` FOREIGN KEY (`production_id`) REFERENCES `production` (`production_id`),
  ADD CONSTRAINT `production_worker_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_material`
--
ALTER TABLE `product_material`
  ADD CONSTRAINT `product_material_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `product_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`);

--
-- Constraints for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD CONSTRAINT `shopping_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `supplier_details`
--
ALTER TABLE `supplier_details`
  ADD CONSTRAINT `supplier_details_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `worker`
--
ALTER TABLE `worker`
  ADD CONSTRAINT `worker_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
