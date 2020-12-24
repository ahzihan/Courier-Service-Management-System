-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2020 at 04:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'test', 'test@email.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Akbar Hossain', 'ahzihan7@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

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
(11, 'Dhaka', 0),
(12, 'Barisal', 0),
(13, 'Rajshahi', 0),
(15, 'Uttora', 0),
(16, 'Mohammadpur', 0),
(17, 'Dhanmondi', 0),
(28, 'Mohammadpur', 2),
(29, 'Uttora', 2),
(30, 'Uttora', 2),
(31, 'Dhanmondi', 3),
(32, 'Mohammadpur', 2),
(33, 'Zigatola', 3),
(34, 'Uttora', 2);

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
(3, 'national', ''),
(5, 'Admin', '');

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
(13, 'Akbar', '01776328578', 'ahzihan7@gmail.com', 'Mohammadpur', '12345', 11),
(15, 'ahzihan', '01930470759', 'ahzihan7@gmail.com', 'Dhaka', '12345', 13),
(16, 'Akbar', '01776328578', 'ahzihan7@gmail.com', 'Dhaka', '12345', 12),
(17, 'Omio', '017', 'ahzihan7@gmail.com', 'Dhaka', '12345', 29),
(18, 'Omio', '017', 'ahzihan7@gmail.com', 'dhaj', '123', 30);

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
  `designation` enum('area_manager','HRM','delivery_man','other') NOT NULL,
  `emp_phone` varchar(20) NOT NULL,
  `emp_email` varchar(150) NOT NULL,
  `emp_address` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `emp_name`, `designation`, `emp_phone`, `emp_email`, `emp_address`, `password`) VALUES
(1, 'Akbar', 'HRM', '01776328578', 'ahzihan7@gmail.com', 'Mohammadpur-1207', '12345'),
(2, 'Zihan', 'area_manager', '01776328578', 'ahzihan7@gmail.com', 'Dhaka', '12345'),
(3, 'Farabi', 'area_manager', '01847101721', 'farabi@gmail.com', 'H-262,Uttara,Dhaka-1230', '12345'),
(4, 'Akbar', 'delivery_man', '01776328578', 'ahzihan7@gmail.com', 'Dhaka', '12345'),
(5, 'Akbar Hossain', 'area_manager', '01776328578', 'ahzihan7@gmail.com', 'Dhaka', '12345'),
(6, 'Farabi', '', '01776328578', 'ahzihan7@gmail.com', 'dha', '1234');

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
(2, 'AH Zihan', 'Mohammadpur', '01930470759', 'ahzihan7@gmail.com', '12345', 0),
(5, 'Rafsan Jani Omio', 'Mohammadpur', '01610676767', 'omio@gmail.com', '12345', 0),
(18, 'Alamin', 'Mohammadpur', '01610676766', 'alamin@gmail.com', '12345 ', 0),
(19, 'Omio', 'Mohammadpur-1207', '01765438769', 'omi@gmail.com', '12345', 11),
(20, 'Rafsan', 'Mohammadpur-1207', '01765438769', 'rafsan@gmail.com', '12345', 11),
(21, 'Omio', 'Mohammadpur-1207', '017', 'omi@gmail.com', '12345', 29);

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
  `status` enum('pending','success') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `payment_collection`
--

CREATE TABLE `payment_collection` (
  `paymentID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `merchantID` (`merchantID`);

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
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `price` (`price`);

--
-- Indexes for table `payment_collection`
--
ALTER TABLE `payment_collection`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `orderID` (`orderID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `areaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_man`
--
ALTER TABLE `delivery_man`
  MODIFY `dID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `delivery_man_charge`
--
ALTER TABLE `delivery_man_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_collection`
--
ALTER TABLE `fee_collection`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `merchant_payemt`
--
ALTER TABLE `merchant_payemt`
  MODIFY `paidID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_collection`
--
ALTER TABLE `payment_collection`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `merchant_payemt`
--
ALTER TABLE `merchant_payemt`
  ADD CONSTRAINT `merchant_payemt_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
