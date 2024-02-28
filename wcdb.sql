-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2024 at 05:20 AM
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
(1, '12A, Main Street', 'Wellawatte', 'Colombo', '00200'),
(2, '45, Hillside Avenue', 'Kandy', 'Kandy', '20000'),
(3, '8B, Palm Grove', 'Negombo', 'Negombo', '11500'),
(4, '33, Tea Estate Road', 'Nuwara Eliya', 'Nuwara Eliya', '22200'),
(5, '65, Sea View Gardens', 'Galle', 'Galle', '80000'),
(6, '22, Temple Lane', 'Anuradhapura', 'Anuradhapura', '50000'),
(7, '7C, Lotus Park', 'Matara', 'Matara', '81000'),
(8, '101, Riverbank Street', 'Ratnapura', 'Ratnapura', '70000'),
(9, '18, Coconut Grove', 'Jaffna', 'Jaffna', '40000'),
(10, '3A, Green Valley', 'Trincomalee', 'Trincomalee', '31000'),
(11, '55, Moonlight Terrace', 'Batticaloa', 'Batticaloa', '30000'),
(12, '27, Paradise Lane', 'Kalmunai', 'Kalmunai', '32000'),
(13, '10B, Sunflower Gardens', 'Dambulla', 'Dambulla', '21100'),
(14, '14, Lotus Lane', 'Gampaha', 'Gampaha', '11000'),
(15, '2C, Royal Palm Street', 'Hambantota', 'Hambantota', '82000'),
(16, '39, Pearl Crescent', 'Kalutara', 'Kalutara', '12000'),
(17, '49, Coral Gardens', 'Polonnaruwa', 'Polonnaruwa', '51000'),
(18, '6A, Palm View', 'Battaramulla', 'Colombo', '10120'),
(19, '30, Rosewood Lane', 'Nugegoda', 'Colombo', '10250'),
(20, '77, Emerald Street', 'Panadura', 'Kalutara', '12500'),
(21, '25, Sapphire Lane', 'Weligama', 'Matara', '81700'),
(22, '12, Golden Sunset', 'Badulla', 'Badulla', '90000'),
(23, '4B, Moonlight Crescent', 'Ambalangoda', 'Galle', '80300'),
(24, '18A, Palm Beach Road', 'Mirissa', 'Matara', '81740'),
(25, '33, Coral Springs', 'Wattala', 'Colombo', '11300'),
(26, '7, Ivory Lane', 'Gampola', 'Kandy', '20500'),
(27, '14, Sandalwood Street', 'Ampara', 'Ampara', '32000'),
(28, '22, Blue Horizon', 'Panirendawa', 'Kurunegala', '60000'),
(29, '5C, Starlight Avenue', 'Kalpitiya', 'Puttalam', '61300'),
(30, '29, Cedar Heights', 'Chilaw', 'Puttalam', '61000'),
(31, '11, Emerald Grove', 'Eheliyagoda', 'Ratnapura', '70100'),
(32, '40, Ruby Lane', 'Dikwella', 'Matara', '81200'),
(33, '8, Pine View', 'Ginigathhena', 'Nuwara Eliya', '22120'),
(34, '17A, Sunset Boulevard', 'Negombo', 'Negombo', '11400'),
(35, '61, Orchid Gardens', 'Mannar', 'Mannar', '41000'),
(36, '2, Coral Paradise', 'Pinnawala', 'Kegalle', '71100'),
(37, '14, Silver Sands', 'Tangalle', 'Hambantota', '82100'),
(38, '19B, Golden Grove', 'Horana', 'Kalutara', '12400'),
(39, '44, Coral Beach Road', 'Arugam Bay', 'Ampara', '32500'),
(40, '27, Pineapple Street', 'Wariyapola', 'Kurunegala', '60100'),
(41, '150/A, Kandy Road', 'Ihala Biyanwila', 'Kadawatha', '11850'),
(42, '89', 'Mahena Road', 'Gonahena', '11858'),
(43, '232/A', 'Galagedara ', 'Maththegoda', '10682'),
(44, '22', 'Hansagiri Road, Miriswaththa', 'Gampaha', '11870'),
(45, '34', 'Horana Road', 'Bandaragama', '12530'),
(46, '23', 'Oruwala', 'Athurugiriya', '11232'),
(47, '43/A', 'Katugasthota Road', 'Kandy', '20000'),
(48, '10/B', 'Main Road', 'Maharagama', '10000'),
(49, '100', 'Kandy Road', 'Kadawatha', '11850');

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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `customer_user_id` mediumint(8) UNSIGNED NOT NULL,
  `cus_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `customer_user_id`, `cus_name`) VALUES
(1, 16, 'Anura Shantha'),
(2, 15, 'Sasanka Udana'),
(3, 5, 'Lasith Ranahewa');

-- --------------------------------------------------------

--
-- Table structure for table `chat_records`
--

CREATE TABLE `chat_records` (
  `chat_rec_id` mediumint(8) UNSIGNED NOT NULL,
  `connection` mediumint(8) UNSIGNED NOT NULL,
  `sent_by` mediumint(8) UNSIGNED NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_records`
--

INSERT INTO `chat_records` (`chat_rec_id`, `connection`, `sent_by`, `message`, `created_at`) VALUES
(1, 3, 5, 'Hi', '21/02/2024 06:54'),
(2, 3, 5, 'hi', '21/02/2024 06:54'),
(3, 3, 5, 'hi', '21/02/2024 06:54'),
(4, 3, 5, 'Hi', '21/02/2024 06:54'),
(5, 1, 16, 'Hi', '21/02/2024 07:34'),
(6, 1, 6, 'hi', '21/02/2024 07:36'),
(7, 1, 6, 'hi', '21/02/2024 07:36'),
(8, 1, 16, 'hi', '21/02/2024 07:36'),
(9, 1, 16, 'aaaaaa', '21/02/2024 07:36'),
(10, 1, 16, 'a', '21/02/2024 09:43'),
(11, 1, 16, 'bbbb', '21/02/2024 09:43'),
(12, 1, 6, 'hasasas', '21/02/2024 09:44');

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
(1, 5, 'Lasith', 'Ranahewa', '0766716265', 41),
(2, 15, 'Sasanka', 'Udana', '0766534211', 48),
(3, 16, 'Anura', 'Shantha', '0983525133', 49);

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

-- --------------------------------------------------------

--
-- Table structure for table `finished_production`
--

CREATE TABLE `finished_production` (
  `finished_production_id` mediumint(8) UNSIGNED NOT NULL,
  `production_id` mediumint(8) UNSIGNED NOT NULL,
  `added` enum('NA','A') NOT NULL DEFAULT 'NA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_production`
--

INSERT INTO `finished_production` (`finished_production_id`, `production_id`, `added`) VALUES
(1, 1, 'A'),
(2, 1, 'A'),
(3, 2, 'A'),
(4, 3, 'A'),
(5, 4, 'A'),
(6, 5, 'A'),
(7, 6, 'A'),
(8, 7, 'A'),
(9, 8, 'A'),
(10, 9, 'A'),
(11, 10, 'A'),
(12, 11, 'A'),
(13, 12, 'A'),
(14, 13, 'A'),
(15, 14, 'NA'),
(16, 18, 'NA'),
(17, 17, 'A'),
(18, 16, 'NA'),
(19, 15, 'NA'),
(20, 21, 'NA'),
(21, 19, 'NA'),
(22, 20, 'A'),
(23, 22, 'NA'),
(24, 23, 'NA'),
(25, 25, 'NA'),
(26, 27, 'NA'),
(27, 26, 'NA'),
(28, 33, 'NA'),
(29, 34, 'A'),
(30, 35, 'A');

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
(1, 'Particleboard', '2m * 2m * 5cm', 654, '2024-01-28 14:49:14', '2024-01-30 08:26:33'),
(2, 'Fibreboard', '2m * 2m * 4cm', 877, '2024-01-28 14:49:35', '2024-01-30 08:26:33'),
(3, 'Acrylic paint - White', '1 liters', 827, '2024-01-28 14:49:56', '2024-01-30 08:26:33'),
(4, 'Acrylic paint - Teak', '1 liters', 0, '2024-01-28 14:50:08', '2024-01-28 14:51:43'),
(5, 'Epoxy Resin ', '750 ml', 807, '2024-01-28 14:51:31', '2024-01-30 08:26:33'),
(6, 'Plywood ', '4m * 40cm * 10cm', 0, '2024-01-28 14:53:30', '2024-01-28 14:53:30'),
(7, 'Polyurethane foam ', '30 kg/cu.m', 0, '2024-01-28 14:53:48', '2024-01-28 14:53:48'),
(8, ' Cotton Fabric - 43', '43% Cotton Fabric - 20m * 2m', 0, '2024-01-28 14:55:06', '2024-01-28 14:55:06');

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
-- Dumping data for table `material_order`
--

INSERT INTO `material_order` (`material_order_id`, `material_id`, `supplier_id`, `quantity`, `price_per_unit`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 10, 780.00, 7800.00, '2024-01-28 14:58:01', '2024-01-28 14:58:01'),
(2, 1, 4, 100, 700.00, 70000.00, '2024-01-28 14:58:49', '2024-01-28 14:58:49'),
(3, 2, 4, 100, 400.00, 40000.00, '2024-01-28 14:59:00', '2024-01-28 14:59:00'),
(4, 3, 2, 50, 380.00, 19000.00, '2024-01-28 14:59:14', '2024-01-28 14:59:14'),
(5, 5, 2, 50, 420.00, 21000.00, '2024-01-28 14:59:33', '2024-01-28 14:59:33'),
(6, 1, 4, 1000, 680.00, 680000.00, '2024-01-28 15:45:07', '2024-01-28 15:45:07'),
(7, 2, 4, 1000, 440.00, 440000.00, '2024-01-28 15:45:21', '2024-01-28 15:45:21'),
(8, 3, 2, 1000, 350.00, 350000.00, '2024-01-28 15:45:56', '2024-01-28 15:45:56'),
(9, 5, 2, 1000, 350.00, 350000.00, '2024-01-28 15:46:14', '2024-01-28 15:46:14');

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
-- Table structure for table `material_stk`
--

CREATE TABLE `material_stk` (
  `stock_no` mediumint(8) UNSIGNED NOT NULL,
  `material_order_id` mediumint(8) UNSIGNED NOT NULL,
  `material_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_stk`
--

INSERT INTO `material_stk` (`stock_no`, `material_order_id`, `material_id`, `quantity`, `price_per_unit`, `created_at`) VALUES
(1, 1, 1, 0, 780.00, '2024-01-28 14:58:01'),
(2, 2, 1, 0, 700.00, '2024-01-28 14:58:49'),
(3, 3, 2, 0, 400.00, '2024-01-28 14:59:00'),
(4, 4, 3, 0, 380.00, '2024-01-28 14:59:14'),
(5, 5, 5, 0, 420.00, '2024-01-28 14:59:33'),
(6, 6, 1, 656, 680.00, '2024-01-28 15:45:07'),
(7, 7, 2, 878, 440.00, '2024-01-28 15:45:21'),
(8, 8, 3, 828, 350.00, '2024-01-28 15:45:56'),
(9, 9, 5, 808, 350.00, '2024-01-28 15:46:14');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `listed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `product_category_id`, `product_inventory_id`, `product_measurement_id`, `price`, `created_at`, `updated_at`, `deleted_at`, `listed`) VALUES
(1, 'MICKE Desk', 'It’s easy to keep sockets and cables out of sight but close at hand with the cable outlet at the back.\r\nYou can mount the legs to the right or left, according to your space or preference.\r\nDrawer stops prevent the drawers from being pulled out too far.\r\nCan be placed in the middle of a room because the back is finished.\r\nYou can extend your work surface by combining desks and drawer units. All desks and drawer units in the MICKE series are the same height.', 5, 1, 1, 69990.00, '2024-01-24 16:02:16', '2024-01-29 05:16:17', NULL, 1),
(2, 'HYLTARP 3 Seat Sofa', 'Skillful craftsmanship and a perfect fit means that the sofa will always shows off its best side.\r\n\r\nThe chaise longue has storage under the seat. The lid automatically stops in the open position so that you can easily pick out and put back the things that you are storing.\r\n\r\nThe sofa have a soft comfort with high-resilience foam and pocket springs that follow your body and provide support – whether you are sitting, lying down or hanging out on the sofa.\r\n\r\nReversible back cushions provide soft support for your back and two different sides to wear. Thanks to the combination of polyester fibres and foam the cushions will retain their shape and comfort year after year.\r\n\r\nThis cover is made of Gransel, a fabric with elements of linen and viscose that add a slight lustre. The threads in different sizes create a natural, vibrant expression.\r\n\r\nThe cover is easy to keep clean since it is removable and can be machine washed.\r\n\r\nA range of coordinated covers makes it easy for you to give your furniture a new look.\r\n\r\n10 year guarantee.', 2, 2, 2, 245000.00, '2024-01-24 16:11:23', '2024-01-29 05:16:16', NULL, 1),
(14, 'test', 'test', 1, 14, 14, 100.00, '2024-01-28 12:20:30', '2024-01-29 05:17:47', NULL, 0);

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
(1, 1, 10, 'completed', '2024-01-28 15:00:39', '2024-01-28 15:17:02'),
(2, 1, 1, 'completed', '2024-01-28 15:07:35', '2024-01-28 15:17:04'),
(3, 1, 12, 'completed', '2024-01-28 15:08:00', '2024-01-28 15:17:07'),
(4, 1, 1, 'completed', '2024-01-28 15:13:09', '2024-01-28 15:17:09'),
(5, 1, 10, 'completed', '2024-01-28 15:13:21', '2024-01-28 15:17:11'),
(6, 1, 1, 'completed', '2024-01-28 15:13:37', '2024-01-28 15:17:12'),
(7, 1, 1, 'completed', '2024-01-28 15:13:55', '2024-01-28 15:17:15'),
(8, 1, 1, 'completed', '2024-01-28 15:16:22', '2024-01-28 15:17:17'),
(9, 1, 1, 'completed', '2024-01-28 15:18:10', '2024-01-28 15:24:15'),
(10, 1, 1, 'completed', '2024-01-28 15:20:01', '2024-01-28 15:24:19'),
(11, 1, 1, 'completed', '2024-01-28 15:24:46', '2024-01-28 15:26:55'),
(12, 1, 1, 'completed', '2024-01-28 15:27:28', '2024-01-28 15:31:28'),
(13, 1, 1, 'completed', '2024-01-28 15:28:59', '2024-01-28 15:31:33'),
(14, 1, 1, 'completed', '2024-01-28 15:29:20', '2024-01-28 15:31:37'),
(15, 1, 1, 'completed', '2024-01-28 15:29:32', '2024-01-28 15:31:49'),
(16, 1, 1, 'completed', '2024-01-28 15:29:55', '2024-01-28 15:31:46'),
(17, 1, 1, 'completed', '2024-01-28 15:30:11', '2024-01-28 15:31:43'),
(18, 1, 1, 'completed', '2024-01-28 15:30:22', '2024-01-28 15:31:40'),
(19, 1, 1, 'completed', '2024-01-28 15:32:29', '2024-01-28 15:47:48'),
(20, 1, 1, 'completed', '2024-01-28 15:34:48', '2024-01-28 15:47:51'),
(21, 1, 1, 'completed', '2024-01-28 15:36:38', '2024-01-28 15:47:45'),
(22, 1, 1, 'completed', '2024-01-28 15:46:34', '2024-01-28 15:55:47'),
(23, 1, 1, 'completed', '2024-01-28 15:46:55', '2024-01-28 15:55:50'),
(24, 1, 1, 'processing', '2024-01-28 15:47:07', '2024-01-28 15:55:25'),
(25, 1, 1, 'completed', '2024-01-28 15:48:05', '2024-01-28 15:55:53'),
(26, 1, 1, 'completed', '2024-01-28 15:48:54', '2024-01-28 15:56:02'),
(27, 1, 1, 'completed', '2024-01-28 15:49:39', '2024-01-28 15:55:57'),
(28, 1, 1, 'pending', '2024-01-28 15:50:39', '2024-01-28 15:50:39'),
(29, 1, 1, 'pending', '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(30, 1, 1, 'processing', '2024-01-28 15:51:47', '2024-02-13 15:05:40'),
(31, 1, 1, 'pending', '2024-01-28 15:55:01', '2024-01-28 15:55:01'),
(32, 1, 1, 'pending', '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(33, 1, 150, 'completed', '2024-01-28 15:56:45', '2024-01-30 00:21:15'),
(34, 14, 10, 'completed', '2024-01-30 04:33:06', '2024-01-30 04:34:44'),
(35, 1, 12, 'completed', '2024-01-30 08:26:33', '2024-01-30 08:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `production_material`
--

CREATE TABLE `production_material` (
  `production_material_id` mediumint(8) NOT NULL,
  `production_id` mediumint(8) UNSIGNED NOT NULL,
  `stock_no` mediumint(8) UNSIGNED NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production_material`
--

INSERT INTO `production_material` (`production_material_id`, `production_id`, `stock_no`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(2, 1, 2, 10, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(3, 1, 3, 10, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(4, 1, 4, 10, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(5, 1, 5, 10, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(6, 2, 1, 0, '2024-01-28 15:07:36', '2024-01-28 15:07:36'),
(7, 2, 2, 2, '2024-01-28 15:07:36', '2024-01-28 15:07:36'),
(8, 2, 3, 1, '2024-01-28 15:07:36', '2024-01-28 15:07:36'),
(9, 2, 4, 1, '2024-01-28 15:07:36', '2024-01-28 15:07:36'),
(10, 2, 5, 1, '2024-01-28 15:07:36', '2024-01-28 15:07:36'),
(11, 3, 1, 0, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(12, 3, 2, 24, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(13, 3, 3, 12, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(14, 3, 4, 12, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(15, 3, 5, 12, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(16, 4, 1, 0, '2024-01-28 15:13:09', '2024-01-28 15:13:09'),
(17, 4, 2, 2, '2024-01-28 15:13:09', '2024-01-28 15:13:09'),
(18, 4, 3, 1, '2024-01-28 15:13:09', '2024-01-28 15:13:09'),
(19, 4, 4, 1, '2024-01-28 15:13:09', '2024-01-28 15:13:09'),
(20, 4, 5, 1, '2024-01-28 15:13:09', '2024-01-28 15:13:09'),
(21, 5, 1, 0, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(22, 5, 2, 20, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(23, 5, 3, 10, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(24, 5, 4, 10, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(25, 5, 5, 10, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(26, 6, 1, 0, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(27, 6, 2, 2, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(28, 6, 3, 1, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(29, 6, 4, 1, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(30, 6, 5, 1, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(31, 7, 1, 0, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(32, 7, 2, 2, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(33, 7, 3, 1, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(34, 7, 4, 1, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(35, 7, 5, 1, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(36, 8, 1, 0, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(37, 8, 2, 2, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(38, 8, 3, 1, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(39, 8, 4, 1, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(40, 8, 5, 1, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(41, 9, 1, 0, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(42, 9, 2, 2, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(43, 9, 3, 1, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(44, 9, 4, 1, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(45, 9, 5, 1, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(46, 10, 1, 0, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(47, 10, 2, 2, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(48, 10, 3, 1, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(49, 10, 4, 1, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(50, 10, 5, 1, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(51, 11, 1, 0, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(52, 11, 2, 2, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(53, 11, 3, 1, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(54, 11, 4, 1, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(55, 11, 5, 1, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(56, 12, 1, 0, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(57, 12, 2, 2, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(58, 12, 3, 1, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(59, 12, 4, 1, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(60, 12, 5, 1, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(61, 13, 1, 0, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(62, 13, 2, 2, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(63, 13, 3, 1, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(64, 13, 4, 1, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(65, 13, 5, 1, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(66, 14, 1, 0, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(67, 14, 2, 2, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(68, 14, 3, 1, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(69, 14, 4, 1, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(70, 14, 5, 1, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(71, 15, 1, 0, '2024-01-28 15:29:32', '2024-01-28 15:29:32'),
(72, 15, 2, 2, '2024-01-28 15:29:32', '2024-01-28 15:29:32'),
(73, 15, 3, 1, '2024-01-28 15:29:32', '2024-01-28 15:29:32'),
(74, 15, 4, 1, '2024-01-28 15:29:32', '2024-01-28 15:29:32'),
(75, 15, 5, 1, '2024-01-28 15:29:32', '2024-01-28 15:29:32'),
(76, 16, 1, 0, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(77, 16, 2, 2, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(78, 16, 3, 1, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(79, 16, 4, 1, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(80, 16, 5, 1, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(81, 17, 1, 0, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(82, 17, 2, 2, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(83, 17, 3, 1, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(84, 17, 4, 1, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(85, 17, 5, 1, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(86, 18, 1, 0, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(87, 18, 2, 2, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(88, 18, 3, 1, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(89, 18, 4, 1, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(90, 18, 5, 1, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(91, 19, 1, 0, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(92, 19, 2, 2, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(93, 19, 3, 1, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(94, 19, 4, 1, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(95, 19, 5, 1, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(96, 20, 1, 0, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(97, 20, 2, 2, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(98, 20, 3, 1, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(99, 20, 4, 1, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(100, 20, 5, 1, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(101, 21, 1, 0, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(102, 21, 2, 2, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(103, 21, 3, 1, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(104, 21, 4, 1, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(105, 21, 5, 1, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(106, 22, 1, 0, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(107, 22, 2, 2, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(108, 22, 3, 1, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(109, 22, 4, 0, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(110, 22, 8, 1, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(111, 22, 5, 0, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(112, 22, 9, 1, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(113, 23, 1, 0, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(114, 23, 2, 2, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(115, 23, 3, 1, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(116, 23, 4, 0, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(117, 23, 8, 1, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(118, 23, 5, 0, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(119, 23, 9, 1, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(120, 24, 1, 0, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(121, 24, 2, 2, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(122, 24, 3, 1, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(123, 24, 4, 0, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(124, 24, 8, 1, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(125, 24, 5, 0, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(126, 24, 9, 1, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(127, 25, 1, 0, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(128, 25, 2, 2, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(129, 25, 3, 1, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(130, 25, 4, 0, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(131, 25, 8, 1, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(132, 25, 5, 0, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(133, 25, 9, 1, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(134, 26, 1, 0, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(135, 26, 2, 2, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(136, 26, 6, 0, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(137, 26, 3, 1, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(138, 26, 4, 0, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(139, 26, 8, 1, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(140, 26, 5, 0, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(141, 26, 9, 1, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(142, 27, 1, 0, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(143, 27, 2, 0, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(144, 27, 6, 2, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(145, 27, 3, 1, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(146, 27, 4, 0, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(147, 27, 8, 1, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(148, 27, 5, 0, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(149, 27, 9, 1, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(150, 29, 1, 0, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(151, 29, 2, 0, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(152, 29, 6, 2, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(153, 29, 3, 1, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(154, 29, 4, 0, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(155, 29, 8, 1, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(156, 29, 5, 0, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(157, 29, 9, 1, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(158, 30, 1, 0, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(159, 30, 2, 0, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(160, 30, 6, 2, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(161, 30, 3, 1, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(162, 30, 4, 0, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(163, 30, 8, 1, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(164, 30, 5, 0, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(165, 30, 9, 1, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(166, 31, 1, 0, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(167, 31, 2, 0, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(168, 31, 6, 2, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(169, 31, 3, 1, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(170, 31, 4, 0, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(171, 31, 8, 1, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(172, 31, 5, 0, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(173, 31, 9, 1, '2024-01-28 15:55:02', '2024-01-28 15:55:02'),
(174, 32, 1, 0, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(175, 32, 2, 0, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(176, 32, 6, 2, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(177, 32, 3, 1, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(178, 32, 4, 0, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(179, 32, 8, 1, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(180, 32, 5, 0, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(181, 32, 9, 1, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(182, 33, 1, 0, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(183, 33, 2, 0, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(184, 33, 6, 300, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(185, 33, 3, 40, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(186, 33, 7, 110, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(187, 33, 4, 0, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(188, 33, 8, 150, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(189, 33, 5, 0, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(190, 33, 9, 150, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(191, 34, 1, 0, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(192, 34, 2, 0, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(193, 34, 6, 10, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(194, 34, 5, 0, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(195, 34, 9, 20, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(196, 35, 1, 0, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(197, 35, 2, 0, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(198, 35, 6, 24, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(199, 35, 3, 0, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(200, 35, 7, 12, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(201, 35, 4, 0, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(202, 35, 8, 12, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(203, 35, 5, 0, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(204, 35, 9, 12, '2024-01-30 08:26:33', '2024-01-30 08:26:33');

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

--
-- Dumping data for table `production_worker`
--

INSERT INTO `production_worker` (`production_worker_id`, `production_id`, `worker_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(2, 1, 7, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(3, 1, 8, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(4, 1, 1, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(5, 1, 11, '2024-01-28 15:00:39', '2024-01-28 15:00:39'),
(6, 2, 9, '2024-01-28 15:07:35', '2024-01-28 15:07:35'),
(7, 3, 10, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(8, 3, 26, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(9, 3, 2, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(10, 3, 12, '2024-01-28 15:08:00', '2024-01-28 15:08:00'),
(11, 4, 27, '2024-01-28 15:13:09', '2024-01-28 15:13:09'),
(12, 5, 28, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(13, 5, 13, '2024-01-28 15:13:21', '2024-01-28 15:13:21'),
(14, 6, 29, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(15, 6, 3, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(16, 6, 14, '2024-01-28 15:13:37', '2024-01-28 15:13:37'),
(17, 7, 30, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(18, 7, 31, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(19, 7, 32, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(20, 7, 33, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(21, 7, 34, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(22, 7, 35, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(23, 7, 36, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(24, 7, 37, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(25, 7, 38, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(26, 7, 39, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(27, 7, 4, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(28, 7, 15, '2024-01-28 15:13:55', '2024-01-28 15:13:55'),
(29, 8, 40, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(30, 8, 5, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(31, 8, 16, '2024-01-28 15:16:22', '2024-01-28 15:16:22'),
(32, 9, 6, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(33, 9, 7, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(34, 9, 8, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(35, 9, 9, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(36, 9, 10, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(37, 9, 26, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(38, 9, 27, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(39, 9, 28, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(40, 9, 29, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(41, 9, 30, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(42, 9, 1, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(43, 9, 17, '2024-01-28 15:18:10', '2024-01-28 15:18:10'),
(44, 10, 31, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(45, 10, 32, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(46, 10, 33, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(47, 10, 34, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(48, 10, 35, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(49, 10, 36, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(50, 10, 37, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(51, 10, 38, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(52, 10, 39, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(53, 10, 40, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(54, 10, 2, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(55, 10, 18, '2024-01-28 15:20:01', '2024-01-28 15:20:01'),
(56, 11, 6, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(57, 11, 7, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(58, 11, 8, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(59, 11, 9, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(60, 11, 10, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(61, 11, 26, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(62, 11, 27, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(63, 11, 28, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(64, 11, 29, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(65, 11, 30, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(66, 11, 3, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(67, 11, 4, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(68, 11, 5, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(69, 11, 1, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(70, 11, 2, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(71, 11, 19, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(72, 11, 20, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(73, 11, 21, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(74, 11, 22, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(75, 11, 23, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(76, 11, 24, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(77, 11, 25, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(78, 11, 11, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(79, 11, 12, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(80, 11, 13, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(81, 11, 14, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(82, 11, 15, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(83, 11, 16, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(84, 11, 17, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(85, 11, 18, '2024-01-28 15:24:46', '2024-01-28 15:24:46'),
(86, 12, 31, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(87, 12, 32, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(88, 12, 33, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(89, 12, 34, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(90, 12, 35, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(91, 12, 36, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(92, 12, 37, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(93, 12, 38, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(94, 12, 39, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(95, 12, 40, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(96, 12, 1, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(97, 12, 11, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(98, 12, 12, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(99, 12, 13, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(100, 12, 14, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(101, 12, 15, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(102, 12, 16, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(103, 12, 17, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(104, 12, 18, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(105, 12, 19, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(106, 12, 20, '2024-01-28 15:27:28', '2024-01-28 15:27:28'),
(107, 13, 6, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(108, 13, 2, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(109, 13, 21, '2024-01-28 15:28:59', '2024-01-28 15:28:59'),
(110, 14, 7, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(111, 14, 22, '2024-01-28 15:29:20', '2024-01-28 15:29:20'),
(112, 15, 3, '2024-01-28 15:29:32', '2024-01-28 15:29:32'),
(113, 16, 8, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(114, 16, 4, '2024-01-28 15:29:55', '2024-01-28 15:29:55'),
(115, 17, 5, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(116, 17, 23, '2024-01-28 15:30:11', '2024-01-28 15:30:11'),
(117, 18, 9, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(118, 18, 24, '2024-01-28 15:30:22', '2024-01-28 15:30:22'),
(119, 19, 10, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(120, 19, 1, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(121, 19, 25, '2024-01-28 15:32:29', '2024-01-28 15:32:29'),
(122, 20, 26, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(123, 20, 2, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(124, 20, 11, '2024-01-28 15:34:48', '2024-01-28 15:34:48'),
(125, 21, 27, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(126, 21, 28, '2024-01-28 15:36:38', '2024-01-28 15:36:38'),
(127, 22, 8, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(128, 22, 3, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(129, 22, 23, '2024-01-28 15:46:34', '2024-01-28 15:46:34'),
(130, 23, 4, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(131, 23, 24, '2024-01-28 15:46:55', '2024-01-28 15:46:55'),
(132, 24, 5, '2024-01-28 15:47:07', '2024-01-28 15:47:07'),
(133, 25, 26, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(134, 25, 2, '2024-01-28 15:48:05', '2024-01-28 15:48:05'),
(135, 26, 10, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(136, 26, 11, '2024-01-28 15:48:54', '2024-01-28 15:48:54'),
(137, 27, 27, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(138, 27, 1, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(139, 27, 25, '2024-01-28 15:49:39', '2024-01-28 15:49:39'),
(140, 28, 28, '2024-01-28 15:50:39', '2024-01-28 15:50:39'),
(141, 29, 9, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(142, 29, 21, '2024-01-28 15:50:54', '2024-01-28 15:50:54'),
(143, 30, 7, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(144, 30, 12, '2024-01-28 15:51:47', '2024-01-28 15:51:47'),
(145, 31, 6, '2024-01-28 15:55:01', '2024-01-28 15:55:01'),
(146, 31, 13, '2024-01-28 15:55:01', '2024-01-28 15:55:01'),
(147, 32, 10, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(148, 32, 1, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(149, 32, 11, '2024-01-28 15:56:22', '2024-01-28 15:56:22'),
(150, 33, 27, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(151, 33, 26, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(152, 33, 8, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(153, 33, 31, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(154, 33, 32, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(155, 33, 33, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(156, 33, 34, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(157, 33, 35, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(158, 33, 36, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(159, 33, 37, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(160, 33, 2, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(161, 33, 4, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(162, 33, 3, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(163, 33, 25, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(164, 33, 24, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(165, 33, 23, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(166, 33, 14, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(167, 33, 15, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(168, 33, 16, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(169, 33, 17, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(170, 33, 18, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(171, 33, 19, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(172, 33, 20, '2024-01-28 15:56:45', '2024-01-28 15:56:45'),
(173, 34, 8, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(174, 34, 14, '2024-01-30 04:33:06', '2024-01-30 04:33:06'),
(175, 35, 8, '2024-01-30 08:26:33', '2024-01-30 08:26:33'),
(176, 35, 14, '2024-01-30 08:26:33', '2024-01-30 08:26:33');

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
(1, 'Wardrobes'),
(2, 'Sofas'),
(3, 'Chest of drawers & Bedside tables'),
(4, 'Bookcases & Shelving units'),
(6, 'Chairs'),
(7, 'Cabinets & Cupboards'),
(9, 'Beds & Bed frames'),
(10, 'TV & Media furniture'),
(11, 'Armchairs & Chaise longues'),
(12, 'Furniture Sets'),
(13, 'Children\'s furniture');

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
(5, 2, 'uploads/images/1706112718hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1193846_pe901657_s5.avif', '2024-01-24 16:11:58'),
(6, 2, 'uploads/images/1706112726hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1249971_pe923599_s5.avif', '2024-01-24 16:12:06'),
(7, 2, 'uploads/images/1706112731hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1194612_pe902012_s5.avif', '2024-01-24 16:12:11'),
(8, 2, 'uploads/images/1706112737hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1256066_pe924902_s5.avif', '2024-01-24 16:12:17'),
(126, 1, 'uploads/images/1706414101micke-desk-white__0736022_pe740349_s5.avif', '2024-01-28 03:55:01'),
(127, 1, 'uploads/images/1706414112micke-desk-white__0921905_pe787996_s5.avif', '2024-01-28 03:55:12'),
(128, 1, 'uploads/images/1706414120micke-desk-white__0849937_pe565227_s5.webp', '2024-01-28 03:55:20');

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
(1, 56),
(2, 0),
(14, 10);

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
(12, 1, 1, 2, '2024-01-28 14:56:04', '2024-01-28 14:56:04'),
(13, 1, 2, 1, '2024-01-28 14:56:08', '2024-01-28 14:56:08'),
(14, 1, 3, 1, '2024-01-28 14:56:14', '2024-01-28 14:56:14'),
(15, 1, 5, 1, '2024-01-28 14:56:19', '2024-01-28 14:56:19'),
(16, 2, 6, 2, '2024-01-28 14:56:38', '2024-01-28 14:56:38'),
(17, 2, 7, 3, '2024-01-28 14:56:47', '2024-01-28 14:56:47'),
(18, 2, 8, 1, '2024-01-28 14:56:54', '2024-01-28 14:56:54');

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
(1, 73.00, 50.00, 75.00, 9.80),
(2, 262.00, 162.00, 91.00, 32.80),
(14, 3.00, 2.00, 1.00, 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `review_id` mediumint(8) UNSIGNED NOT NULL,
  `product_id` mediumint(8) UNSIGNED NOT NULL,
  `customer_id` mediumint(8) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT 0,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`review_id`, `product_id`, `customer_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 'Great product, exceeded my expectations.', '2024-01-27 01:48:54', '2024-01-27 01:48:54'),
(2, 2, 1, 3, 'Good product, but there is room for improvement.', '2024-01-27 01:48:54', '2024-01-27 01:48:54'),
(3, 2, 1, 5, 'Excellent! No complaints at all.', '2024-01-27 01:48:54', '2024-01-27 01:48:54');

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
(2, 6, 'Lakruwan', 'Ilankoon', '0715676532', 42, '2024-01-24 16:15:14', '2024-01-24 16:15:14'),
(3, 7, 'Pahasara', 'Jayasuriya', '0768736713', 43, '2024-01-24 16:17:00', '2024-01-24 16:17:00'),
(4, 8, 'Ravija', 'Salpitikorala', '0881337723', 44, '2024-01-24 16:18:39', '2024-01-24 16:18:39'),
(5, 9, 'Bimsara', 'Jayadewa', '0779826743', 45, '2024-01-24 16:20:27', '2024-01-24 16:20:27');

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

--
-- Dumping data for table `supplier_details`
--

INSERT INTO `supplier_details` (`supplier_id`, `name`, `email`, `telephone`, `brn`, `address_id`, `created_at`, `updated_at`) VALUES
(1, 'Nawaloka Polysacks', 'nawaloka@gmail.com', '0112525254', 'LK LTD 123456AB', 1, '2024-01-08 15:10:11', '2024-01-08 15:10:11'),
(2, 'Nippon Paint Lanka', 'contact@nipponpaint.com.lk', '0114600400', 'LK LTD 56273782', 2, '2024-01-08 15:26:51', '2024-01-28 14:43:46'),
(3, 'Steel Corporation Sri Lanka', 'lanwa@ceylonsteelcorp.lk', '0117356543', 'LK LTD 111322AK', 46, '2024-01-24 16:42:18', '2024-01-24 16:42:18'),
(4, 'Pine Wood', 'pinewoodlk@gmail.com', '0115626372', 'LK LTD 1313134AK', 47, '2024-01-28 12:10:09', '2024-01-28 12:10:26');

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
(4, 'adm@wcf.com', '$2y$10$rdL8/otwmQWVgvyK9tSnfuMziXng/2FQRG94jQClzmJLq4svwAwpu', 'admin', '2024-01-24 13:48:45', '2024-01-24 13:48:45'),
(5, 'lasithmrana@gmail.com', '$2y$10$bW3QkJs2Xp.wQP/ST2sZuO4cpsFm.vzsu1LB0OERIjjAanwSTSzVC', 'customer', '2024-01-24 15:18:09', '2024-01-24 15:18:09'),
(6, 'lakruwan17@gmail.com', '$2y$10$ZUZ2jGjfOFaycpwYAq3YM.Ri90MVDjrPjDCE/5ZaK65M7Wbx71B/S', 'osr', '2024-01-24 16:15:14', '2024-01-24 16:15:14'),
(7, 'pahasara@gmail.com', '$2y$10$ceXxryGhmtoJQZNwbJVqo.SK8ZdSqECncT6DlpNz451X5o1zXbU/W', 'gm', '2024-01-24 16:17:00', '2024-01-24 16:17:00'),
(8, 'ravija@gmail.com', '$2y$10$qFteeK9LmmV0gMbz5gmFO.BU4da9qq98Ij9Fo5FbR/xSgyv1My8AS', 'pm', '2024-01-24 16:18:39', '2024-01-24 16:18:39'),
(9, 'bimsara@gmail.com', '$2y$10$U68teWNHuSJIfFq.w9L9Nu76Ec1oYPORR1/DH5nnJHoGayDTQJSKW', 'sk', '2024-01-24 16:20:27', '2024-01-24 16:20:27'),
(10, 'aaa', 'aaa', 'customer', '2023-11-03 08:00:28', '2024-01-25 08:01:02'),
(11, '', '', 'customer', '2024-01-19 08:01:08', '2024-01-25 08:01:22'),
(13, 'ad', 'ad', 'customer', '2024-01-25 08:35:29', '2024-01-25 08:35:29'),
(14, 'dad', 'ad', 'customer', '2023-08-09 08:35:40', '2024-01-25 08:35:53'),
(15, 'sasanka@gmail.com', '$2y$10$xglbDpcRv2WqSIg7TUb.oerd06zcCLytvELkemk1iZ3gEVn7EozSG', 'customer', '2024-02-20 10:23:06', '2024-02-20 10:23:06'),
(16, 'anura@gmail.com', '$2y$10$fvtSOzraQAtElEceSKJA4ObRmWBA2SmsVCSEmjR1NTbyqaXcgHUKq', 'customer', '2024-02-20 13:39:20', '2024-02-21 02:13:29');

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
  `worker_role` enum('carpenter','painter','supervisor','') NOT NULL,
  `availability` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `first_name`, `last_name`, `mobile_number`, `address_id`, `worker_role`, `availability`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nimal', 'Gamage', '0489237936', 1, 'supervisor', 'unavailable', '2024-01-24 14:23:16', '2024-01-28 15:56:22', NULL),
(2, 'Chaminda', 'Gunawardena', '0381225252', 2, 'supervisor', 'available', '2024-01-24 14:23:16', '2024-01-30 00:21:15', NULL),
(3, 'Rohan', 'Mendis', '0861662866', 3, 'supervisor', 'available', '2024-01-24 14:23:16', '2024-01-30 00:21:15', NULL),
(4, 'Nalin', 'Karunaratne', '0774079840', 4, 'supervisor', 'available', '2024-01-24 14:23:16', '2024-01-30 00:21:15', NULL),
(5, 'Amila', 'Kumara', '0475125724', 5, 'supervisor', 'unavailable', '2024-01-24 14:23:16', '2024-01-28 15:47:07', NULL),
(6, 'Chathuranga', 'Fernando', '0981151422', 6, 'carpenter', 'unavailable', '2024-01-24 14:30:43', '2024-01-28 15:55:01', NULL),
(7, 'Tharuka', 'Perera', '0479893718', 7, 'carpenter', 'unavailable', '2024-01-24 14:30:43', '2024-01-28 15:51:47', NULL),
(8, 'Chaminda', 'Fernando', '0212612640', 8, 'carpenter', 'available', '2024-01-24 14:30:43', '2024-01-30 08:30:21', NULL),
(9, 'Asanka', 'Herath', '0709299571', 9, 'carpenter', 'unavailable', '2024-01-24 14:30:43', '2024-01-28 15:50:54', NULL),
(10, 'Chamathka', 'Jayawardena', '0834280905', 10, 'carpenter', 'unavailable', '2024-01-24 14:30:43', '2024-01-28 15:56:22', NULL),
(11, 'Shashika', 'Fernando', '0477564058', 26, 'painter', 'unavailable', '2024-01-24 14:31:23', '2024-01-28 15:56:22', NULL),
(12, 'Chamal', 'Mendis', '0208298731', 27, 'painter', 'unavailable', '2024-01-24 14:31:23', '2024-01-28 15:51:47', NULL),
(13, 'Tharuka', 'Gunawardena', '0761702460', 28, 'painter', 'unavailable', '2024-01-24 14:31:23', '2024-01-28 15:55:01', NULL),
(14, 'Nalin', 'Perera', '0375015893', 29, 'painter', 'available', '2024-01-24 14:31:23', '2024-01-30 08:30:21', NULL),
(15, 'Kamal', 'Perera', '0715489632', 30, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(16, 'Nimal', 'Fernando', '0472598163', 36, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(17, 'Dinesh', 'Gunawardena', '0758369214', 37, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(18, 'Amila', 'Silva', '0775123986', 40, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(19, 'Chathuranga', 'Mendis', '0718546293', 38, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(20, 'Saman', 'Karunaratne', '0789654123', 39, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(21, 'Priyan', 'Kumara', '0471596328', 31, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-28 15:50:54', NULL),
(22, 'Roshan', 'Jayawardena', '0753698214', 32, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-28 15:50:39', NULL),
(23, 'Chamath', 'Rajapakse', '0771548632', 33, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(24, 'Sachin', 'Perera', '0715489632', 34, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(25, 'Kasun', 'Dissanayake', '0775489632', 35, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-30 00:21:15', NULL),
(26, 'Saman', 'Wijesinghe', '0773642915', 11, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(27, 'Nalin', 'Jayasinghe', '0631857024', 12, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(28, 'Shashika', 'Mendis', '0452901367', 13, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-28 15:50:39', NULL),
(29, 'Chathura', 'Gunawardena', '0274165032', 14, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-28 15:26:55', NULL),
(30, 'Asanga', 'Perera', '0765328104', 15, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-28 15:26:55', NULL),
(31, 'Nimal', 'Bandara', '0356709418', 16, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(32, 'Chaminda', 'Silva', '0847052361', 17, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(33, 'Thushara', 'Karunaratne', '0709286503', 18, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(34, 'Pradeep', 'Herath', '0612579046', 19, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(35, 'Dinesh', 'Ranasinghe', '0524810379', 20, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(36, 'Dilusha', 'Kumara', '0436145802', 21, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(37, 'Janith', 'Perera', '0268509135', 22, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-30 00:21:15', NULL),
(38, 'Anjana', 'Jayawardena', '0759230468', 23, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-28 15:31:28', NULL),
(39, 'Nilantha', 'Fernando', '0371654092', 24, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-28 15:31:28', NULL),
(40, 'Kavishka', 'Gunawardena', '0813972506', 25, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-28 15:31:28', NULL);

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
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `chat_ibfk_1` (`customer_user_id`);

--
-- Indexes for table `chat_records`
--
ALTER TABLE `chat_records`
  ADD PRIMARY KEY (`chat_rec_id`);

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
-- Indexes for table `finished_production`
--
ALTER TABLE `finished_production`
  ADD PRIMARY KEY (`finished_production_id`),
  ADD KEY `production_id` (`production_id`);

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
-- Indexes for table `material_stk`
--
ALTER TABLE `material_stk`
  ADD PRIMARY KEY (`stock_no`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `material_order_id` (`material_order_id`);

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
-- Indexes for table `production_material`
--
ALTER TABLE `production_material`
  ADD PRIMARY KEY (`production_material_id`),
  ADD KEY `material_stk_id` (`stock_no`),
  ADD KEY `production_id` (`production_id`);

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
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `address_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_records`
--
ALTER TABLE `chat_records`
  MODIFY `chat_rec_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finished_production`
--
ALTER TABLE `finished_production`
  MODIFY `finished_production_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `material_order`
--
ALTER TABLE `material_order`
  MODIFY `material_order_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `material_stk`
--
ALTER TABLE `material_stk`
  MODIFY `stock_no` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `product_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `production_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `production_material`
--
ALTER TABLE `production_material`
  MODIFY `production_material_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `production_worker`
--
ALTER TABLE `production_worker`
  MODIFY `production_worker_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `product_inventory_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_material`
--
ALTER TABLE `product_material`
  MODIFY `product_material_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_measurement`
--
ALTER TABLE `product_measurement`
  MODIFY `product_measurement_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `review_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `shopping_session_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier_details`
--
ALTER TABLE `supplier_details`
  MODIFY `supplier_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`customer_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `finished_production`
--
ALTER TABLE `finished_production`
  ADD CONSTRAINT `finished_production_ibfk_1` FOREIGN KEY (`production_id`) REFERENCES `production` (`production_id`);

--
-- Constraints for table `material_order`
--
ALTER TABLE `material_order`
  ADD CONSTRAINT `material_order_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `material_order_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_details` (`supplier_id`);

--
-- Constraints for table `material_stk`
--
ALTER TABLE `material_stk`
  ADD CONSTRAINT `material_stk_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_stk_ibfk_2` FOREIGN KEY (`material_order_id`) REFERENCES `material_order` (`material_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `production_material`
--
ALTER TABLE `production_material`
  ADD CONSTRAINT `production_material_ibfk_1` FOREIGN KEY (`stock_no`) REFERENCES `material_stk` (`stock_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `production_material_ibfk_2` FOREIGN KEY (`production_id`) REFERENCES `production` (`production_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `product_material_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_review_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
