-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 08:18 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xyz`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_ship_address` varchar(255) DEFAULT NULL,
  `cus_phone` varchar(255) NOT NULL,
  `cus_discount` double NOT NULL DEFAULT 0,
  `cus_credit_limit` double DEFAULT 0,
  `cus_used_credit_limit` double NOT NULL DEFAULT 0,
  `cus_status` varchar(10) NOT NULL DEFAULT 'active',
  `cus_remarks` varchar(255) NOT NULL DEFAULT '',
  `cus_create_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_address`, `cus_ship_address`, `cus_phone`, `cus_discount`, `cus_credit_limit`, `cus_used_credit_limit`, `cus_status`, `cus_remarks`, `cus_create_by`) VALUES
(1, 'Aradya Kavishadi', 'No.120, Police rd, Batapola 75000', 'No.120, Police rd, Batapola 75000', '0715649783', 30, 90000, 0, 'active', 'good custome', 'user'),
(2, 'Hirushi Maddawatta', 'No.210, Baddegama rd, Galle 80000 ', 'No.210, Baddegama rd, Galle 80000 ', '0775631952', 25, 1000, 0, 'active', '', 'user'),
(3, 'Jithmi Dewmini', 'No.210, Wataraka rd, Mathara 69000 ', 'No.210, Wataraka rd, Mathara 69000 ', '0777596321', 15, 60000, 0, 'active', '', 'user'),
(4, 'Vishmi Pabasara', 'No.10, Galle rd, Collombo 20000 ', '', '0713654236', 50, 30000, 0, 'active', '', 'user'),
(5, 'Malmi Ushana', 'No.419/A, Kurudugaha rd, Elpitiya 10000 ', 'No.419/A, Kurudugaha rd, Elpitiya 10000 ', '0762126456', 10, 15000, 0, 'active', '', 'user'),
(6, 'Danushka Pabodhi', 'No.419/A, Rukman mawatha, Hapugala 36874', '', '0776975278', 20, 12500, 0, 'active', '', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_no` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cus_id` int(11) DEFAULT NULL,
  `order_by` varchar(255) NOT NULL,
  `order_value` float NOT NULL,
  `order_status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_no`, `order_date`, `cus_id`, `order_by`, `order_value`, `order_status`) VALUES
(1, '2020-12-29 03:06:00', 2, 'admin', 4500, 'active'),
(2, '2020-12-29 03:52:55', 2, 'admin', 1263.25, 'canceled'),
(3, '2020-12-29 03:53:39', 1, 'admin', 2000, 'active'),
(4, '2020-12-29 04:35:19', 6, 'admin', 750, 'active'),
(5, '2020-12-29 04:38:51', 1, 'admin', 3561.5, 'active'),
(6, '2020-12-29 04:44:04', 1, 'admin', 7500.25, 'active'),
(7, '2020-12-29 06:10:22', 1, 'admin', 0, 'canceled'),
(8, '2020-12-29 08:28:06', 2, 'admin', 3600, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `order_no` int(11) NOT NULL,
  `prod_code` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  `filled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`order_no`, `prod_code`, `qty`, `filled`) VALUES
(1, 'CH089', 10, 0),
(1, 'TB101', 66, 0),
(2, 'CH089', 55, 0),
(2, 'TB101', 46, 0),
(3, 'CH089', 123, 0),
(3, 'TB105', 145, 0),
(4, 'CH089', 30, 0),
(4, 'TB105', 65, 0),
(5, 'TB101', 10, 0),
(5, 'TB333', 26, 20),
(6, 'TB101', 15, 0),
(6, 'TB105', 33, 0),
(6, 'TB333', 22, 20),
(7, 'CH005', 16, 10),
(8, 'CH005', 4, 2),
(8, 'CH089', 33, 0),
(8, 'TB101', 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `part_no` varchar(25) NOT NULL,
  `part_desc` varchar(255) NOT NULL,
  `part_QOH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`part_no`, `part_desc`, `part_QOH`) VALUES
('HG885', 'BOLT 1X50', 40),
('SCRW110', '1.25\" SCREWS', 6),
('WOOD223', '1 X 2 - 30\" WOOD', 9),
('WOOD7785', '8 X 8 REDWOOD WOOD', 30),
('WOOD995', '2 X 4 - 48\" WOOD', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_code` varchar(25) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_price` double DEFAULT 0,
  `prod_QOH` int(11) DEFAULT NULL,
  `prod_bo` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_code`, `prod_desc`, `prod_price`, `prod_QOH`, `prod_bo`) VALUES
('CH005', 'WOOD CHAIR', 40, 68, 0),
('CH089', 'PARTIO CHAIRS', 35, 0, 47606),
('FR223', 'HALF SIZE REFRIGERATOR', 750.99, 15, 0),
('HH005', 'Nut', 10, 100, 0),
('TB101', 'PATIO TABLE', 25, 0, 955),
('TB105', 'PLASTIC TABLE', 150, 0, 308),
('TB333', 'IRON TABLE', 100, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `produc_part`
--

CREATE TABLE `produc_part` (
  `prod_code` varchar(25) NOT NULL,
  `part_no` varchar(25) NOT NULL,
  `qty_required` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produc_part`
--

INSERT INTO `produc_part` (`prod_code`, `part_no`, `qty_required`) VALUES
('CH089', 'SCRW110', 26),
('CH089', 'WOOD223', 8),
('FR223', 'WOOD223', 30),
('FR223', 'WOOD995', 50),
('TB101', 'SCRW110', 34),
('TB101', 'WOOD223', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_uname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role` varchar(255) NOT NULL DEFAULT 'basic',
  `user_status` varchar(255) NOT NULL DEFAULT 'DISABLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_uname`, `user_password`, `user_name`, `user_email`, `user_last_login`, `user_role`, `user_status`) VALUES
('admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Administrator', 'admin@xyz.com', '2020-12-29 00:22:47', 'admin', 'ACTIVE'),
('danushka', '202cb962ac59075b964b07152d234b70', '', 'lakshan@techfixsolutions.com', '2020-12-29 01:19:00', 'BASIC', 'ACTIVE'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'USER', 'user@xyz.com', '2021-01-08 07:13:21', 'basic', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD KEY `FK_create_by` (`cus_create_by`(191));

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_no`),
  ADD KEY `FK_cus_id` (`cus_id`),
  ADD KEY `FK_order_by` (`order_by`(191));

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`order_no`,`prod_code`),
  ADD KEY `FK_prod_code_order_table` (`prod_code`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`part_no`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_code`);

--
-- Indexes for table `produc_part`
--
ALTER TABLE `produc_part`
  ADD PRIMARY KEY (`prod_code`,`part_no`),
  ADD KEY `FK_part_no` (`part_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
