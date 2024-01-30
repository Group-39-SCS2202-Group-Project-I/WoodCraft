-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2024 at 05:58 AM
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
(46, '23', 'Oruwala', 'Athurugiriya', '11232');

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
(1, 5, 'Lasith', 'Ranahewa', '0766716265', 41);

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
(2, 2, 'NA');

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
(1, 'Particleboard', 'Composite wood product made from wood chips and resin.', 0, '2024-01-24 13:56:45', '2024-01-25 18:42:31'),
(2, 'Paper foil', 'Thin sheet of paper coated with a foil layer for decorative purposes.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(3, 'Fibreboard', 'Engineered wood product made from wood fibers and resin.', 59, '2024-01-24 13:56:45', '2024-01-25 19:20:02'),
(4, 'Printed acrylic paint', 'Acrylic paint with printed design for artistic or decorative use.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(5, 'Aluminum alloy', 'Metal alloy composed primarily of aluminum.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(6, 'Tempered glass', 'Glass that has undergone a heating and cooling process for increased strength.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(7, 'Polyethylene', 'Thermoplastic polymer commonly used in various applications.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(8, 'Vinyl flooring', 'Flooring material made from polyvinyl chloride (PVC).', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(9, 'Ceramic tiles', 'Clay-based tiles used for flooring or wall covering.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(10, 'Stainless steel', 'Steel alloy with a minimum of 10.5% chromium for corrosion resistance.', 82, '2024-01-24 13:56:45', '2024-01-25 19:20:02'),
(11, 'Bamboo veneer', 'Thin layer of bamboo used for decorative purposes.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(12, 'Polycarbonate', 'Transparent thermoplastic known for its impact resistance.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(13, 'Marble slab', 'Natural stone slab commonly used for countertops and flooring.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(14, 'MDF (Medium Density Fiberboard)', 'Engineered wood product with medium density.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(15, 'Melamine laminate', 'Thin decorative layer with a melamine resin coating.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(16, 'Galvanized steel', 'Steel coated with a layer of zinc for corrosion resistance.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(17, 'Cotton canvas', 'Heavy-duty fabric commonly used for painting and upholstery.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(18, 'Concrete block', 'Solid masonry unit made from concrete.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(19, 'Glass fiber reinforced plastic (GRP)', 'Composite material with glass fibers embedded in a polymer matrix.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(20, 'Granite tile', 'Natural stone tile commonly used for countertops and flooring.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(21, 'Porcelain enamel', 'Glass-like coating fused onto metal for durability and aesthetics.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(22, 'HDPE (High-Density Polyethylene)', 'Durable thermoplastic used in various applications.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(23, 'Brass', 'Metal alloy composed of copper and zinc.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(24, 'Acoustic foam', 'Foam material designed to absorb sound waves.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(25, 'Quartz countertop', 'Engineered stone surface made from quartz crystals and resin.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(26, 'Rubber flooring', 'Flooring material made from natural or synthetic rubber.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(27, 'Plywood', 'Engineered wood product made from thin layers of wood veneer.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(28, 'Corkboard', 'Board material made from cork for pinning notes and messages.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(29, 'Laminate flooring', 'Flooring material with a laminated surface for durability.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(30, 'Corian', 'Solid surface material used for countertops and other applications.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(31, 'Acrylic sheet', 'Transparent thermoplastic sheet with various applications.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(32, 'Plasterboard', 'Panel made from gypsum plaster and sandwiched between two layers of paper.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(33, 'Nylon fabric', 'Synthetic fabric known for its strength and durability.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(34, 'Galvalume', 'Steel coated with a combination of aluminum, zinc, and silicon.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(35, 'Oak veneer', 'Thin layer of oak wood used for decorative purposes.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(36, 'Polyester resin', 'Thermosetting resin commonly used in composite materials.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(37, 'Birch plywood', 'Plywood made from birch wood veneer.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(38, 'Rubberized asphalt', 'Asphalt mix modified with rubber for enhanced performance.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(39, 'Fiberglass insulation', 'Insulating material made from glass fibers.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(40, 'Linoleum flooring', 'Flooring material made from linseed oil, cork, and other natural materials.', 0, '2024-01-24 13:56:45', '2024-01-24 13:56:45'),
(41, 'Walnut wood stain', 'Wood stain in a rich walnut color for enhancing the natural wood grain.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(42, 'Mahogany wood finish', 'Wood finish in a deep mahogany shade for a classic look.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(43, 'Chestnut wood varnish', 'Wood varnish in a chestnut color for protecting and enhancing wooden surfaces.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(44, 'Maple wood paint', 'Wood paint in a light maple color for a natural and bright finish.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(45, 'Oak wood preservative', 'Wood preservative in a clear finish for protecting oak surfaces.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(46, 'Cherry wood lacquer', 'Wood lacquer in a cherry color for a glossy and durable finish.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(47, 'Pine wood primer', 'Wood primer in a light color suitable for pine surfaces.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(48, 'Ebony wood paint', 'Wood paint in an ebony black color for a dramatic look.', 0, '2024-01-24 13:59:04', '2024-01-24 13:59:04'),
(49, 'Down Feathers Cushion', 'Luxuriously soft and plush, but requires maintenance and prone to allergies', 188, '2024-01-24 16:28:36', '2024-01-25 19:20:02'),
(50, 'Latex Cushion', 'Supportive and bouncy, resistant to dust mites and allergens', 0, '2024-01-24 16:28:36', '2024-01-24 16:28:36'),
(51, 'Arctic White Wood Paint', 'A stark, true white with a hint of blue, ideal for a modern, minimalist look.', 40, '2024-01-24 16:33:31', '2024-01-25 18:42:31'),
(52, 'Chantilly Lace Wood Paint', 'A creamy white with a touch of beige, adding a touch of elegance to any space.', 0, '2024-01-24 16:33:58', '2024-01-24 16:33:58');

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
(1, 1, 1, 100, 1200.00, 120000.00, '2024-01-24 16:36:57', '2024-01-24 16:36:57'),
(2, 3, 1, 125, 1800.00, 225000.00, '2024-01-24 16:37:17', '2024-01-24 16:37:17'),
(3, 51, 2, 50, 800.00, 40000.00, '2024-01-24 16:37:48', '2024-01-24 16:37:48'),
(4, 10, 3, 100, 560.00, 56000.00, '2024-01-24 16:45:00', '2024-01-24 16:45:00'),
(5, 51, 2, 50, 510.00, 25500.00, '2024-01-25 18:27:55', '2024-01-25 18:27:55'),
(6, 49, 1, 200, 1200.00, 240000.00, '2024-01-25 18:56:35', '2024-01-25 18:56:35');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `listed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `product_category_id`, `product_inventory_id`, `product_measurement_id`, `price`, `created_at`, `updated_at`, `deleted_at`, `listed`) VALUES
(1, 'MICKE Desk', 'It’s easy to keep sockets and cables out of sight but close at hand with the cable outlet at the back.\r\nYou can mount the legs to the right or left, according to your space or preference.\r\nDrawer stops prevent the drawers from being pulled out too far.\r\nCan be placed in the middle of a room because the back is finished.\r\nYou can extend your work surface by combining desks and drawer units. All desks and drawer units in the MICKE series are the same height.', 5, 1, 1, 69990.00, '2024-01-24 16:02:16', '2024-01-26 13:05:49', NULL, 1),
(2, 'HYLTARP 3 Seat Sofa', 'Skillful craftsmanship and a perfect fit means that the sofa will always shows off its best side.\r\n\r\nThe chaise longue has storage under the seat. The lid automatically stops in the open position so that you can easily pick out and put back the things that you are storing.\r\n\r\nThe sofa have a soft comfort with high-resilience foam and pocket springs that follow your body and provide support – whether you are sitting, lying down or hanging out on the sofa.\r\n\r\nReversible back cushions provide soft support for your back and two different sides to wear. Thanks to the combination of polyester fibres and foam the cushions will retain their shape and comfort year after year.\r\n\r\nThis cover is made of Gransel, a fabric with elements of linen and viscose that add a slight lustre. The threads in different sizes create a natural, vibrant expression.\r\n\r\nThe cover is easy to keep clean since it is removable and can be machine washed.\r\n\r\nA range of coordinated covers makes it easy for you to give your furniture a new look.\r\n\r\n10 year guarantee.', 2, 2, 2, 245000.00, '2024-01-24 16:11:23', '2024-01-26 11:31:15', NULL, 1),
(7, 'OSKARSHAMN Wing chair', 'This classic and timeless wing chair with an embracing backrest gives you relaxing me-time and is also great to sit on while enjoying socialising with others.\r\n\r\nClean lines, simple and at the same time a softly rounded design with wooden legs all make the wing chair easy to like and place anywhere.\r\n\r\nThe wing chair has a high comfort level thanks to the seat with a combination of supportive springs and soft foam, lumbar support, armrests and an extra-high backrest that you can lean against.\r\n\r\nYou can complete your wing chair with OSKARSHAMN footstool to sit even more comfortably.\r\n\r\n10 year guarantee.', 6, 7, 7, 29990.00, '2024-01-25 08:54:17', '2024-01-26 14:02:32', NULL, 0),
(8, 'sasaas', 'asa', 4, 8, 8, 13.00, '2024-01-26 00:40:59', '2024-01-26 14:02:33', NULL, 0);

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
(1, 1, 5, 'completed', '2024-01-24 16:45:48', '2024-01-24 16:53:43'),
(2, 1, 5, 'completed', '2024-01-24 16:49:02', '2024-01-25 15:24:51'),
(3, 1, 5, 'processing', '2024-01-24 16:50:20', '2024-01-24 16:53:30'),
(4, 1, 1, 'pending', '2024-01-25 18:30:41', '2024-01-25 18:30:41'),
(5, 1, 1, 'pending', '2024-01-25 18:38:22', '2024-01-25 18:38:22'),
(6, 1, 1, 'pending', '2024-01-25 18:40:24', '2024-01-25 18:40:24'),
(7, 1, 1, 'pending', '2024-01-25 18:40:54', '2024-01-25 18:40:54'),
(8, 1, 1, 'pending', '2024-01-25 18:42:31', '2024-01-25 18:42:31'),
(9, 2, 2, 'pending', '2024-01-25 19:15:52', '2024-01-25 19:15:52'),
(10, 2, 1, 'pending', '2024-01-25 19:17:43', '2024-01-25 19:17:43'),
(11, 2, 1, 'pending', '2024-01-25 19:19:23', '2024-01-25 19:19:23'),
(12, 2, 1, 'pending', '2024-01-25 19:19:31', '2024-01-25 19:19:31'),
(13, 2, 1, 'pending', '2024-01-25 19:20:02', '2024-01-25 19:20:02');

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
(1, 1, 6, '2024-01-24 16:45:48', '2024-01-24 16:45:48'),
(2, 1, 22, '2024-01-24 16:45:48', '2024-01-24 16:45:48'),
(3, 2, 8, '2024-01-24 16:49:02', '2024-01-24 16:49:02'),
(4, 2, 23, '2024-01-24 16:49:02', '2024-01-24 16:49:02'),
(5, 3, 9, '2024-01-24 16:50:20', '2024-01-24 16:50:20'),
(6, 3, 25, '2024-01-24 16:50:20', '2024-01-24 16:50:20'),
(7, 4, 10, '2024-01-25 18:30:41', '2024-01-25 18:30:41'),
(8, 4, 11, '2024-01-25 18:30:41', '2024-01-25 18:30:41'),
(9, 5, 26, '2024-01-25 18:38:22', '2024-01-25 18:38:22'),
(10, 6, 30, '2024-01-25 18:40:24', '2024-01-25 18:40:24'),
(11, 6, 15, '2024-01-25 18:40:24', '2024-01-25 18:40:24'),
(12, 7, 31, '2024-01-25 18:40:54', '2024-01-25 18:40:54'),
(13, 8, 32, '2024-01-25 18:42:31', '2024-01-25 18:42:31'),
(14, 9, 33, '2024-01-25 19:15:52', '2024-01-25 19:15:52'),
(15, 9, 1, '2024-01-25 19:15:52', '2024-01-25 19:15:52'),
(16, 9, 17, '2024-01-25 19:15:52', '2024-01-25 19:15:52'),
(17, 10, 34, '2024-01-25 19:17:43', '2024-01-25 19:17:43'),
(18, 11, 35, '2024-01-25 19:19:23', '2024-01-25 19:19:23'),
(19, 12, 36, '2024-01-25 19:19:31', '2024-01-25 19:19:31'),
(20, 12, 2, '2024-01-25 19:19:31', '2024-01-25 19:19:31'),
(21, 12, 19, '2024-01-25 19:19:31', '2024-01-25 19:19:31'),
(22, 13, 37, '2024-01-25 19:20:02', '2024-01-25 19:20:02'),
(23, 13, 20, '2024-01-25 19:20:02', '2024-01-25 19:20:02');

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
(5, 'Tables & Desks'),
(6, 'Chairs'),
(7, 'Cabinets & Cupboards'),
(8, 'Dining furniture'),
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
(1, 1, 'uploads/images/1706112377micke-desk-white__0736022_pe740349_s5.avif', '2024-01-24 16:06:17'),
(2, 1, 'uploads/images/1706112390micke-desk-white__0921905_pe787996_s5.avif', '2024-01-24 16:06:30'),
(3, 1, 'uploads/images/1706112402micke-desk-white__0849937_pe565227_s5.webp', '2024-01-24 16:06:42'),
(4, 1, 'uploads/images/1706112430micke-desk-white__0526705_pe645106_s5.avif', '2024-01-24 16:07:10'),
(5, 2, 'uploads/images/1706112718hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1193846_pe901657_s5.avif', '2024-01-24 16:11:58'),
(6, 2, 'uploads/images/1706112726hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1249971_pe923599_s5.avif', '2024-01-24 16:12:06'),
(7, 2, 'uploads/images/1706112731hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1194612_pe902012_s5.avif', '2024-01-24 16:12:11'),
(8, 2, 'uploads/images/1706112737hyltarp-3-seat-sofa-w-chaise-longue-left-gransel-natural__1256066_pe924902_s5.avif', '2024-01-24 16:12:17');

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
(1, 5),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0);

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
(1, 2, 3, 11, '2024-01-24 16:24:42', '2024-01-24 16:24:42'),
(2, 2, 10, 3, '2024-01-24 16:25:30', '2024-01-24 16:25:30'),
(3, 2, 49, 2, '2024-01-24 16:30:54', '2024-01-24 16:30:54'),
(4, 1, 1, 4, '2024-01-24 16:31:22', '2024-01-24 16:31:22'),
(5, 1, 51, 3, '2024-01-24 16:34:19', '2024-01-24 16:34:19');

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
(3, 31.00, 13.00, 31.00, 13.00),
(4, 31.00, 133.00, 31.00, 13.00),
(5, 13.00, 31.00, 13.00, 31.00),
(6, 13.00, 13.00, 13.00, 13.00),
(7, 54.00, 82.00, 99.00, 18.00),
(8, 31.00, 31.00, 13.00, 13.00);

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
(3, 2, 1, 5, 'Excellent! No complaints at all.', '2024-01-27 01:48:54', '2024-01-27 01:48:54'),
(5, 8, 1, 4, 'Satisfied with the purchase, would recommend.', '2024-01-27 01:48:54', '2024-01-27 01:48:54');

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
(2, 'Nippon Paint Lanka', 'info@nipponpaint.com.lk', '0114600400', 'LK LTD 56273782', 2, '2024-01-08 15:26:51', '2024-01-08 15:26:51'),
(3, 'Steel Corporation Sri Lanka', 'lanwa@ceylonsteelcorp.lk', '0117356543', 'LK LTD 111322AK', 46, '2024-01-24 16:42:18', '2024-01-24 16:42:18');

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
(14, 'dad', 'ad', 'customer', '2023-08-09 08:35:40', '2024-01-25 08:35:53');

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
(1, 'Nimal', 'Gamage', '0489237936', 1, 'supervisor', 'unavailable', '2024-01-24 14:23:16', '2024-01-25 19:15:52', NULL),
(2, 'Chaminda', 'Gunawardena', '0381225252', 2, 'supervisor', 'unavailable', '2024-01-24 14:23:16', '2024-01-25 19:19:31', NULL),
(3, 'Rohan', 'Mendis', '0861662866', 3, 'supervisor', 'available', '2024-01-24 14:23:16', '2024-01-24 14:23:16', NULL),
(4, 'Nalin', 'Karunaratne', '0774079840', 4, 'supervisor', 'available', '2024-01-24 14:23:16', '2024-01-24 14:23:16', NULL),
(5, 'Amila', 'Kumara', '0475125724', 5, 'supervisor', 'available', '2024-01-24 14:23:16', '2024-01-24 14:23:16', NULL),
(6, 'Chathuranga', 'Fernando', '0981151422', 6, 'carpenter', 'available', '2024-01-24 14:30:43', '2024-01-24 16:53:43', NULL),
(7, 'Tharuka', 'Perera', '0479893718', 7, 'carpenter', 'available', '2024-01-24 14:30:43', '2024-01-24 15:13:35', NULL),
(8, 'Chaminda', 'Fernando', '0212612640', 8, 'carpenter', 'available', '2024-01-24 14:30:43', '2024-01-25 15:24:51', NULL),
(9, 'Asanka', 'Herath', '0709299571', 9, 'carpenter', 'unavailable', '2024-01-24 14:30:43', '2024-01-24 16:50:20', NULL),
(10, 'Chamathka', 'Jayawardena', '0834280905', 10, 'carpenter', 'unavailable', '2024-01-24 14:30:43', '2024-01-25 18:30:41', NULL),
(11, 'Shashika', 'Fernando', '0477564058', 26, 'painter', 'unavailable', '2024-01-24 14:31:23', '2024-01-25 18:30:41', NULL),
(12, 'Chamal', 'Mendis', '0208298731', 27, 'painter', 'available', '2024-01-24 14:31:23', '2024-01-24 15:12:26', NULL),
(13, 'Tharuka', 'Gunawardena', '0761702460', 28, 'painter', 'available', '2024-01-24 14:31:23', '2024-01-24 15:12:36', NULL),
(14, 'Nalin', 'Perera', '0375015893', 29, 'painter', 'available', '2024-01-24 14:31:23', '2024-01-24 15:12:46', NULL),
(15, 'Kamal', 'Perera', '0715489632', 30, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-25 18:40:24', NULL),
(16, 'Nimal', 'Fernando', '0472598163', 36, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-24 15:12:11', NULL),
(17, 'Dinesh', 'Gunawardena', '0758369214', 37, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-25 19:15:52', NULL),
(18, 'Amila', 'Silva', '0775123986', 40, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-24 15:08:06', NULL),
(19, 'Chathuranga', 'Mendis', '0718546293', 38, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-25 19:19:31', NULL),
(20, 'Saman', 'Karunaratne', '0789654123', 39, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-25 19:20:02', NULL),
(21, 'Priyan', 'Kumara', '0471596328', 31, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-24 15:14:16', NULL),
(22, 'Roshan', 'Jayawardena', '0753698214', 32, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-24 16:53:43', NULL),
(23, 'Chamath', 'Rajapakse', '0771548632', 33, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-25 15:24:51', NULL),
(24, 'Sachin', 'Perera', '0715489632', 34, 'painter', 'available', '2024-01-24 14:34:48', '2024-01-24 15:14:28', NULL),
(25, 'Kasun', 'Dissanayake', '0775489632', 35, 'painter', 'unavailable', '2024-01-24 14:34:48', '2024-01-24 16:50:20', NULL),
(26, 'Saman', 'Wijesinghe', '0773642915', 11, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 18:38:22', NULL),
(27, 'Nalin', 'Jayasinghe', '0631857024', 12, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-24 15:12:57', NULL),
(28, 'Shashika', 'Mendis', '0452901367', 13, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-24 15:13:05', NULL),
(29, 'Chathura', 'Gunawardena', '0274165032', 14, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-24 15:13:22', NULL),
(30, 'Asanga', 'Perera', '0765328104', 15, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 18:40:24', NULL),
(31, 'Nimal', 'Bandara', '0356709418', 16, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 18:40:54', NULL),
(32, 'Chaminda', 'Silva', '0847052361', 17, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 18:42:31', NULL),
(33, 'Thushara', 'Karunaratne', '0709286503', 18, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 19:15:52', NULL),
(34, 'Pradeep', 'Herath', '0612579046', 19, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 19:17:43', NULL),
(35, 'Dinesh', 'Ranasinghe', '0524810379', 20, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 19:19:23', NULL),
(36, 'Dilusha', 'Kumara', '0436145802', 21, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 19:19:31', NULL),
(37, 'Janith', 'Perera', '0268509135', 22, 'carpenter', 'unavailable', '2024-01-24 14:59:34', '2024-01-25 19:20:02', NULL),
(38, 'Anjana', 'Jayawardena', '0759230468', 23, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-24 15:13:49', NULL),
(39, 'Nilantha', 'Fernando', '0371654092', 24, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-24 15:14:03', NULL),
(40, 'Kavishka', 'Gunawardena', '0813972506', 25, 'carpenter', 'available', '2024-01-24 14:59:34', '2024-01-24 14:59:34', NULL);

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
  MODIFY `address_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `customer_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finished_production`
--
ALTER TABLE `finished_production`
  MODIFY `finished_production_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `material_order`
--
ALTER TABLE `material_order`
  MODIFY `material_order_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `product_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `production_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `production_worker`
--
ALTER TABLE `production_worker`
  MODIFY `production_worker_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `product_inventory_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_material`
--
ALTER TABLE `product_material`
  MODIFY `product_material_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_measurement`
--
ALTER TABLE `product_measurement`
  MODIFY `product_measurement_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `supplier_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`),
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
