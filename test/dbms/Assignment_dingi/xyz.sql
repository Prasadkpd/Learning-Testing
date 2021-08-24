-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 09:54 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

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
(1, 'Lakshan Dhanushka', '91/8P Sadasarana Mawatha \nRilawulla Kandana\n11320', '91/8P Sadasarana Mawatha \nRilawulla Kandana\n11320', '0772169960', 25, 10000, 0, 'active', 'good custome', 'user'),
(2, 'Tishan Ekanayaka', '25/4 K palugasdamana\nkelegama\n223344', '\n\n', '0778853858', 27, 0, 0, 'active', '', 'user'),
(3, 'Heshan Tharindu', '54/ 678\nAdurugiriya welipillawa\n885563', '789\ncalifonia - america\n887745', '0778865423', 90, 100000, 0, 'active', '', 'user'),
(4, 'Nohim Piwithuru', '78/6 A Piwithuru Mawatha\nYaya 4 rajanganaya\n001123', '78/6 A Piwithuru Mawatha\nYaya 4 rajanganaya\n001123', '011225632', 23, 12563, 0, 'active', '', 'user'),
(5, 'Anurudda Ekanayaka', '78/965 Kiwlawala\nRagama\n44523', '\n\n', '0778853256', 24, 12225, 0, 'active', '', 'user'),
(6, 'sandun kumara', '123/ 456\nDewatagahamulla Kandana\n112233', '\n\n', '0778853821', 12, 1000, 0, 'active', '', 'user');

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
(1, '2020-12-29 03:06:00', 2, 'admin', 6398.45, 'active'),
(2, '2020-12-29 03:52:55', 2, 'admin', 620.5, 'active'),
(3, '2020-12-29 03:53:39', 1, 'admin', 19541.2, 'active'),
(4, '2020-12-29 04:35:19', 6, 'admin', 500, 'active'),
(5, '2020-12-29 04:38:51', 1, 'admin', 2306.25, 'active'),
(6, '2020-12-29 04:44:04', 1, 'admin', 6018.75, 'active'),
(7, '2020-12-29 06:10:22', 1, 'admin', 0, 'canceled'),
(8, '2020-12-29 08:28:06', 2, 'admin', 1792.15, 'active');

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
(1, 'CH089', 234, 0),
(1, 'TB101', 23, 0),
(2, 'CH089', 10, 0),
(2, 'TB101', 20, 0),
(3, 'CH089', 123, 0),
(3, 'TB105', 145, 0),
(4, 'CH089', 20, 0),
(4, 'TB105', 20, 0),
(5, 'TB101', 10, 0),
(5, 'TB333', 24, 20),
(6, 'TB101', 10, 0),
(6, 'TB105', 33, 0),
(6, 'TB333', 24, 20),
(7, 'CH005', 50, 50),
(8, 'CH005', 2, 2),
(8, 'CH089', 45, 0),
(8, 'TB101', 32, 0);

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
('CH005', 'WOOD995', 30),
('CH089', 'SCRW110', 26),
('CH089', 'WOOD223', 8),
('TB101', 'SCRW110', 34),
('TB101', 'WOOD995', 12),
('TB105', 'WOOD995', 50);

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
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'USER', 'user@xyz.com', '2020-12-29 00:18:31', 'basic', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD KEY `FK_create_by` (`cus_create_by`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_no`),
  ADD KEY `FK_cus_id` (`cus_id`),
  ADD KEY `FK_order_by` (`order_by`);

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

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_create_by` FOREIGN KEY (`cus_create_by`) REFERENCES `users` (`user_uname`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `FK_order_by` FOREIGN KEY (`order_by`) REFERENCES `users` (`user_uname`);

--
-- Constraints for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD CONSTRAINT `FK_order_no` FOREIGN KEY (`order_no`) REFERENCES `orders` (`order_no`),
  ADD CONSTRAINT `FK_prod_code_order_table` FOREIGN KEY (`prod_code`) REFERENCES `product` (`prod_code`);

--
-- Constraints for table `produc_part`
--
ALTER TABLE `produc_part`
  ADD CONSTRAINT `FK_part_no` FOREIGN KEY (`part_no`) REFERENCES `part` (`part_no`),
  ADD CONSTRAINT `FK_prod_code` FOREIGN KEY (`prod_code`) REFERENCES `product` (`prod_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
