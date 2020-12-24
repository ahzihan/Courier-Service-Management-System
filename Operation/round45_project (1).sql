-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2020 at 04:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `round45_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'test', 'test@email.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `areaID` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`areaID`, `area_name`, `manager`) VALUES
(1, 'Dhanmondi', 1),
(2, 'Mirpur', 2),
(3, 'Uttora', 2),
(4, 'Bonani', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `extra_charge` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `category_name`, `extra_charge`) VALUES
(3, 'Disposable', '0'),
(4, 'Glass', '50'),
(5, 'Electronics Product', '20');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cod_collection`
-- (See below for the actual view)
--
CREATE TABLE `cod_collection` (
`paymnentBy` int(11)
,`merchantID` int(11)
,`m_name` varchar(255)
,`orderID` int(11)
,`order_type` enum('Cash on Delivery','Only Delivery')
,`delivery_man` varchar(100)
,`total_price` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` enum('management','delivery_man','stock') NOT NULL,
  `msg` text NOT NULL,
  `status` enum('pending','processing','solved') NOT NULL,
  `responded_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_man`
--

CREATE TABLE `delivery_man` (
  `dID` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `d_phone` varchar(20) NOT NULL,
  `d_email` varchar(100) NOT NULL,
  `d_address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `areaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_man`
--

INSERT INTO `delivery_man` (`dID`, `d_name`, `d_phone`, `d_email`, `d_address`, `password`, `areaID`) VALUES
(1, 'Rafiq', '01963741258', 'rafiq@gmail.com', 'Dhanmondi', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, 'Faruq', '01479147369', 'faruq@gmail.com', 'Mirpur', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(3, 'Rahim', '01963741258', 'rahim@email.com', 'Uttora', '827ccb0eea8a706c4c34a16891f84e7b', 3),
(4, 'Karim', '01479147369', 'k@email.com', 'Bonani', '827ccb0eea8a706c4c34a16891f84e7b', 4),
(5, 'Shafik', '01963741258', 'shafik@email.com', 'Dhanmondi', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(6, 'Zahid', '01479147369', 'zahid@email.com', 'Mirpur', '827ccb0eea8a706c4c34a16891f84e7b', 2);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_man_charge`
--

CREATE TABLE `delivery_man_charge` (
  `id` int(11) NOT NULL,
  `dID` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(150) NOT NULL,
  `approved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `emp_phone` varchar(20) NOT NULL,
  `emp_email` varchar(150) NOT NULL,
  `emp_address` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `emp_name`, `designation`, `emp_phone`, `emp_email`, `emp_address`, `password`) VALUES
(1, 'Shahriar Hossen', 'Operation Team Member', '01859414563', 'mshpranto@gmail.com', 'Jigatola,Dhaka', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Jahanur Islam', 'Manager', '01698741258', 'jahanurcse96@gmail.com', 'Mohammodpur,Dhaka', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `id` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('attend','absent') NOT NULL,
  `shift` enum('Day Shift','Night Shift') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fee_collection`
--

CREATE TABLE `fee_collection` (
  `feeID` int(11) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `method` varchar(150) NOT NULL,
  `collected_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fee_collection`
--

INSERT INTO `fee_collection` (`feeID`, `merchantID`, `date`, `amount`, `method`, `collected_by`) VALUES
(1, 2, '2020-11-01', '50', 'cash', 2),
(2, 1, '2020-11-02', '10', 'cash', 2),
(3, 2, '2020-11-03', '80', 'cash', 1),
(5, 1, '2020-11-03', '10', 'cash', 1),
(6, 3, '2020-11-04', '30', 'cash', 2),
(13, 1, '2020-11-05', '20', 'cash', 1),
(21, 2, '2020-11-12', '20', 'Bank', 1),
(22, 3, '2020-11-13', '20', 'Cash', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fee_collection_merchant`
-- (See below for the actual view)
--
CREATE TABLE `fee_collection_merchant` (
`m_id` int(11)
,`m_name` varchar(255)
,`total_fee` double
,`paid` double
,`extra_charge` double
);

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `id` int(11) NOT NULL,
  `delivery_charge` varchar(100) NOT NULL,
  `pickup_charge` varchar(100) NOT NULL,
  `company_name` text NOT NULL,
  `logo` text NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `merchant_charge` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`id`, `delivery_charge`, `pickup_charge`, `company_name`, `logo`, `address`, `phone`, `email`, `merchant_charge`) VALUES
(1, '50', '50', 'mtech', 'logo.png', 'Uttora', '+8801859414563', 'mtech@email.com', '10');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchantID` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_address` text NOT NULL,
  `m_phone` varchar(20) NOT NULL,
  `m_email` varchar(150) NOT NULL,
  `m_password` varchar(20) NOT NULL,
  `areaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchantID`, `m_name`, `m_address`, `m_phone`, `m_email`, `m_password`, `areaID`) VALUES
(1, 'rokomari', 'Dhanmondi', '01596321654', 'mailinnur1@gmail.com', '12345', 1),
(2, 'Ajker Deal', 'Mirpur', '01478963214', 'sharirepranto@gmail.com', '12345', 2),
(3, 'yellow', 'Dhanmondi', '01596321654', 'rokomari@email.com', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_payemt`
--

CREATE TABLE `merchant_payemt` (
  `paidID` int(11) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` varchar(150) NOT NULL,
  `payment_by` int(11) NOT NULL,
  `status` enum('pending','success') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchant_payemt`
--

INSERT INTO `merchant_payemt` (`paidID`, `merchantID`, `date`, `method`, `amount`, `payment_by`, `status`) VALUES
(7, 1, '2020-11-01', 'cash', '20', 2, NULL),
(8, 1, '2020-11-12', 'cash', '10', 1, NULL),
(9, 2, '2020-11-12', 'cash', '10', 1, NULL),
(10, 3, '2020-11-12', 'cash', '20', 2, NULL),
(11, 3, '2020-11-12', 'cash', '50', 2, NULL),
(12, 2, '2020-11-12', 'cash', '50', 2, NULL),
(13, 1, '2020-11-13', 'cash', '20', 1, NULL),
(14, 2, '2020-11-13', 'bank', '40', 1, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `merchant_payment_collection`
-- (See below for the actual view)
--
CREATE TABLE `merchant_payment_collection` (
`paymnentBy` int(11)
,`merchantID` int(11)
,`m_name` varchar(255)
,`orderID` int(11)
,`order_type` enum('Cash on Delivery','Only Delivery')
,`delivery_man` varchar(100)
,`total_price` decimal(54,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `date` date NOT NULL,
  `priority` enum('emergency','normal','medium') NOT NULL,
  `pickup_address` text NOT NULL,
  `delivery_address` text NOT NULL,
  `fee` varchar(255) NOT NULL,
  `status` enum('pending','received','picked_up','processing','delivered') NOT NULL,
  `pickup_man` int(11) NOT NULL,
  `delivery_man` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `pickup_area` int(11) NOT NULL,
  `delivery_area` int(11) NOT NULL,
  `order_type` enum('Cash on Delivery','Only Delivery') NOT NULL,
  `feedback` text NOT NULL,
  `received_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `merchantID`, `date`, `priority`, `pickup_address`, `delivery_address`, `fee`, `status`, `pickup_man`, `delivery_man`, `code`, `pickup_area`, `delivery_area`, `order_type`, `feedback`, `received_by`) VALUES
(1, 1, '2020-10-23', 'normal', 'Jighatola', 'Mohammodpur', '100', 'pending', 5, 5, 'abc111', 1, 1, 'Cash on Delivery', 'good', 1),
(2, 2, '2020-10-22', 'normal', 'Mirpur-10', 'Mirpur-2', '100', 'pending', 2, 2, 'ttt147', 2, 2, 'Cash on Delivery', 'good', 2),
(3, 2, '2020-10-03', 'medium', 'Uttora', 'Bonani', '100', 'pending', 3, 4, 'ban111', 3, 4, 'Cash on Delivery', 'ok', 2),
(4, 3, '2020-11-04', 'normal', 'Mirpur', 'Dhanmondi', '100', 'delivered', 2, 1, '5677', 2, 1, 'Only Delivery', 'ok', 2),
(5, 3, '2020-11-02', 'emergency', 'bonani', 'uttara', '100', 'picked_up', 4, 3, '5677', 4, 3, 'Cash on Delivery', 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `product` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `wieght` varchar(150) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderID`, `product`, `price`, `qty`, `wieght`, `categoryID`) VALUES
(1, 1, 'deaner set', '3000.00', '1', '20', 4),
(2, 1, 'fridz', '35000.00', '2', '200', 5),
(3, 2, 'document', '1200.00', '1', '0.5', 3),
(4, 2, 'Book', '300.00', '2', '3', 3),
(5, 2, 'glass set', '500.00', '6', '2', 4),
(6, 3, 'shirt', '500.00', '2', '1', 3),
(7, 4, 'pant', '600.00', '1', '.3', 3),
(8, 5, 't-shirt', '500.00', '1', '1', 3),
(9, 3, 'pant', '2000.00', '1', '2', 3),
(10, 3, 'shirt', '500.00', '', '1', 3),
(11, 5, 'document', '2500.00', '1', '1', 3),
(12, 5, 'cirtificate', '2500.00', '1', '1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment_collection`
--

CREATE TABLE `payment_collection` (
  `paymentID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payment_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_collection`
--

INSERT INTO `payment_collection` (`paymentID`, `orderID`, `date`, `amount`, `payment_by`) VALUES
(3, 5, '2020-11-09', '5500.00', 4),
(4, 3, '2020-11-10', '3000.00', 4),
(5, 2, '2020-11-11', '2000.00', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_details`
-- (See below for the actual view)
--
CREATE TABLE `product_details` (
`merchantID` int(11)
,`orderID` int(11)
,`date` date
,`pickup_address` text
,`delivery_address` text
,`fee` varchar(255)
,`code` varchar(50)
,`order_type` enum('Cash on Delivery','Only Delivery')
,`product` text
,`wieght` varchar(150)
,`qty` varchar(20)
,`price` decimal(10,2)
,`category_name` varchar(255)
,`extra_charge` varchar(100)
,`total_fee` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_details_invoice`
-- (See below for the actual view)
--
CREATE TABLE `product_details_invoice` (
`merchantID` int(11)
,`orderID` int(11)
,`date` date
,`pickup_address` text
,`delivery_address` text
,`fee` varchar(255)
,`code` varchar(50)
,`order_type` enum('Cash on Delivery','Only Delivery')
,`product` text
,`wieght` varchar(150)
,`qty` varchar(20)
,`price` decimal(10,2)
,`category_name` varchar(255)
,`extra_charge` varchar(100)
,`total_fee` double
);

-- --------------------------------------------------------

--
-- Table structure for table `replacement`
--

CREATE TABLE `replacement` (
  `replaceID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `qty` varchar(20) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `search_order`
-- (See below for the actual view)
--
CREATE TABLE `search_order` (
`orderID` int(11)
,`pickup_area` int(11)
,`delivery_area` int(11)
,`date` date
,`priority` enum('emergency','normal','medium')
,`status` enum('pending','received','picked_up','processing','delivered')
,`order_type` enum('Cash on Delivery','Only Delivery')
,`received_by` varchar(100)
,`pickup_man` int(11)
,`delivery_man` int(11)
,`merchant_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `stock_in_date` date NOT NULL,
  `stock_out_date` date NOT NULL,
  `return_date` date NOT NULL,
  `approved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wastage`
--

CREATE TABLE `wastage` (
  `wastageID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `approved_by` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `cod_collection`
--
DROP TABLE IF EXISTS `cod_collection`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cod_collection`  AS  select `orders`.`delivery_man` AS `paymnentBy`,`merchant`.`merchantID` AS `merchantID`,`merchant`.`m_name` AS `m_name`,`orders`.`orderID` AS `orderID`,`orders`.`order_type` AS `order_type`,(select `delivery_man`.`d_name` from `delivery_man` where `delivery_man`.`dID` = `orders`.`delivery_man`) AS `delivery_man`,(select sum(`order_details`.`price`) from `order_details` where `order_details`.`orderID` = `orders`.`orderID` group by `order_details`.`orderID`) AS `total_price` from (`merchant` join `orders` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`order_type` = 'cash on delivery' ;

-- --------------------------------------------------------

--
-- Structure for view `fee_collection_merchant`
--
DROP TABLE IF EXISTS `fee_collection_merchant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fee_collection_merchant`  AS  select `merchant`.`merchantID` AS `m_id`,`merchant`.`m_name` AS `m_name`,sum(`orders`.`fee`) AS `total_fee`,(select sum(`fee_collection`.`amount`) from `fee_collection` where `fee_collection`.`merchantID` = `merchant`.`merchantID`) AS `paid`,(select sum(`product_details`.`extra_charge`) from `product_details` where `product_details`.`merchantID` = `merchant`.`merchantID`) AS `extra_charge` from (`merchant` join `orders` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`status` = 'delivered' group by `merchant`.`merchantID` ;

-- --------------------------------------------------------

--
-- Structure for view `merchant_payment_collection`
--
DROP TABLE IF EXISTS `merchant_payment_collection`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `merchant_payment_collection`  AS  select `orders`.`delivery_man` AS `paymnentBy`,`merchant`.`merchantID` AS `merchantID`,`merchant`.`m_name` AS `m_name`,`orders`.`orderID` AS `orderID`,`orders`.`order_type` AS `order_type`,(select `delivery_man`.`d_name` from `delivery_man` where `delivery_man`.`dID` = `orders`.`delivery_man`) AS `delivery_man`,sum((select sum(`order_details`.`price`) from `order_details` where `order_details`.`orderID` = `orders`.`orderID` group by `order_details`.`orderID`)) AS `total_price` from (`merchant` join `orders` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`order_type` = 'cash on delivery' group by `orders`.`merchantID` ;

-- --------------------------------------------------------

--
-- Structure for view `product_details`
--
DROP TABLE IF EXISTS `product_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_details`  AS  select `merchant`.`merchantID` AS `merchantID`,`orders`.`orderID` AS `orderID`,`orders`.`date` AS `date`,`orders`.`pickup_address` AS `pickup_address`,`orders`.`delivery_address` AS `delivery_address`,`orders`.`fee` AS `fee`,`orders`.`code` AS `code`,`orders`.`order_type` AS `order_type`,`order_details`.`product` AS `product`,`order_details`.`wieght` AS `wieght`,`order_details`.`qty` AS `qty`,`order_details`.`price` AS `price`,`category`.`category_name` AS `category_name`,`category`.`extra_charge` AS `extra_charge`,`orders`.`fee` + `category`.`extra_charge` AS `total_fee` from (((`orders` join `order_details` on(`orders`.`orderID` = `order_details`.`orderID`)) join `category` on(`category`.`categoryID` = `order_details`.`categoryID`)) join `merchant` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`status` = 'delivered' ;

-- --------------------------------------------------------

--
-- Structure for view `product_details_invoice`
--
DROP TABLE IF EXISTS `product_details_invoice`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_details_invoice`  AS  select `merchant`.`merchantID` AS `merchantID`,`orders`.`orderID` AS `orderID`,`orders`.`date` AS `date`,`orders`.`pickup_address` AS `pickup_address`,`orders`.`delivery_address` AS `delivery_address`,`orders`.`fee` AS `fee`,`orders`.`code` AS `code`,`orders`.`order_type` AS `order_type`,`order_details`.`product` AS `product`,`order_details`.`wieght` AS `wieght`,`order_details`.`qty` AS `qty`,`order_details`.`price` AS `price`,`category`.`category_name` AS `category_name`,`category`.`extra_charge` AS `extra_charge`,`orders`.`fee` + `category`.`extra_charge` AS `total_fee` from (((`orders` join `order_details` on(`orders`.`orderID` = `order_details`.`orderID`)) join `category` on(`category`.`categoryID` = `order_details`.`categoryID`)) join `merchant` on(`merchant`.`merchantID` = `orders`.`merchantID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `search_order`
--
DROP TABLE IF EXISTS `search_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `search_order`  AS  select `orders`.`orderID` AS `orderID`,`orders`.`pickup_area` AS `pickup_area`,`orders`.`delivery_area` AS `delivery_area`,`orders`.`date` AS `date`,`orders`.`priority` AS `priority`,`orders`.`status` AS `status`,`orders`.`order_type` AS `order_type`,(select `employee`.`emp_name` from `employee` where `employee`.`empID` = `orders`.`received_by`) AS `received_by`,`orders`.`pickup_man` AS `pickup_man`,`orders`.`delivery_man` AS `delivery_man`,`merchant`.`m_name` AS `merchant_name` from (`orders` join `merchant` on(`orders`.`merchantID` = `merchant`.`merchantID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`areaID`),
  ADD KEY `manager` (`manager`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `responded_by` (`responded_by`);

--
-- Indexes for table `delivery_man`
--
ALTER TABLE `delivery_man`
  ADD PRIMARY KEY (`dID`),
  ADD KEY `areaID` (`areaID`);

--
-- Indexes for table `delivery_man_charge`
--
ALTER TABLE `delivery_man_charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `dID` (`dID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `fee_collection`
--
ALTER TABLE `fee_collection`
  ADD PRIMARY KEY (`feeID`),
  ADD KEY `collected_by` (`collected_by`),
  ADD KEY `merchantID` (`merchantID`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchantID`),
  ADD KEY `areaID` (`areaID`);

--
-- Indexes for table `merchant_payemt`
--
ALTER TABLE `merchant_payemt`
  ADD PRIMARY KEY (`paidID`),
  ADD KEY `merchantID` (`merchantID`),
  ADD KEY `payment_by` (`payment_by`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `pickup_man` (`pickup_man`),
  ADD KEY `delivery_man` (`delivery_man`),
  ADD KEY `received_by` (`received_by`),
  ADD KEY `merchantID` (`merchantID`),
  ADD KEY `pickup_area` (`pickup_area`),
  ADD KEY `delivery_area` (`delivery_area`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `payment_collection`
--
ALTER TABLE `payment_collection`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `payment_by` (`payment_by`);

--
-- Indexes for table `replacement`
--
ALTER TABLE `replacement`
  ADD PRIMARY KEY (`replaceID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `wastage`
--
ALTER TABLE `wastage`
  ADD PRIMARY KEY (`wastageID`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `orderID` (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `areaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_man`
--
ALTER TABLE `delivery_man`
  MODIFY `dID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_man_charge`
--
ALTER TABLE `delivery_man_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_collection`
--
ALTER TABLE `fee_collection`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchant_payemt`
--
ALTER TABLE `merchant_payemt`
  MODIFY `paidID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_collection`
--
ALTER TABLE `payment_collection`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `replacement`
--
ALTER TABLE `replacement`
  MODIFY `replaceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wastage`
--
ALTER TABLE `wastage`
  MODIFY `wastageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`responded_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_man`
--
ALTER TABLE `delivery_man`
  ADD CONSTRAINT `delivery_man_ibfk_1` FOREIGN KEY (`areaID`) REFERENCES `area` (`areaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_man_charge`
--
ALTER TABLE `delivery_man_charge`
  ADD CONSTRAINT `delivery_man_charge_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_man_charge_ibfk_2` FOREIGN KEY (`dID`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD CONSTRAINT `emp_attendance_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fee_collection`
--
ALTER TABLE `fee_collection`
  ADD CONSTRAINT `fee_collection_ibfk_1` FOREIGN KEY (`collected_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fee_collection_ibfk_2` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `merchant`
--
ALTER TABLE `merchant`
  ADD CONSTRAINT `merchant_ibfk_1` FOREIGN KEY (`areaID`) REFERENCES `area` (`areaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `merchant_payemt`
--
ALTER TABLE `merchant_payemt`
  ADD CONSTRAINT `merchant_payemt_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `merchant_payemt_ibfk_2` FOREIGN KEY (`payment_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`pickup_area`) REFERENCES `area` (`areaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`delivery_area`) REFERENCES `area` (`areaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`pickup_man`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`delivery_man`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_6` FOREIGN KEY (`received_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_collection`
--
ALTER TABLE `payment_collection`
  ADD CONSTRAINT `payment_collection_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_collection_ibfk_2` FOREIGN KEY (`payment_by`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replacement`
--
ALTER TABLE `replacement`
  ADD CONSTRAINT `replacement_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replacement_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wastage`
--
ALTER TABLE `wastage`
  ADD CONSTRAINT `wastage_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wastage_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
