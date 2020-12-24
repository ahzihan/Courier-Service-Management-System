

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO admin VALUES("1","test","test@email.com","827ccb0eea8a706c4c34a16891f84e7b");





CREATE TABLE `area` (
  `areaID` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) NOT NULL,
  `manager` int(11) NOT NULL,
  PRIMARY KEY (`areaID`),
  KEY `manager` (`manager`),
  CONSTRAINT `area_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO area VALUES("1","Dhanmondi","1");
INSERT INTO area VALUES("2","Mirpur","2");
INSERT INTO area VALUES("3","Uttora","2");
INSERT INTO area VALUES("4","Bonani","1");





CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `extra_charge` varchar(100) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO category VALUES("3","Disposable","0");
INSERT INTO category VALUES("4","Glass","50");
INSERT INTO category VALUES("5","Electronics Product","20");





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cod_collection` AS select `orders`.`delivery_man` AS `paymnentBy`,`merchant`.`merchantID` AS `merchantID`,`merchant`.`m_name` AS `m_name`,`orders`.`orderID` AS `orderID`,`orders`.`order_type` AS `order_type`,(select `delivery_man`.`d_name` from `delivery_man` where `delivery_man`.`dID` = `orders`.`delivery_man`) AS `delivery_man`,(select sum(`order_details`.`price`) from `order_details` where `order_details`.`orderID` = `orders`.`orderID` group by `order_details`.`orderID`) AS `total_price` from (`merchant` join `orders` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`order_type` = 'cash on delivery';

INSERT INTO cod_collection VALUES("5","1","rokomari","1","Cash on Delivery","Shafik","38000.00");
INSERT INTO cod_collection VALUES("2","2","Ajker Deal","2","Cash on Delivery","Faruq","2000.00");
INSERT INTO cod_collection VALUES("4","2","Ajker Deal","3","Cash on Delivery","Karim","3000.00");
INSERT INTO cod_collection VALUES("3","3","yellow","5","Cash on Delivery","Rahim","5500.00");
INSERT INTO cod_collection VALUES("2","2","Ajker Deal","7","Cash on Delivery","Faruq","500.00");





CREATE TABLE `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` enum('management','delivery_man','stock') NOT NULL,
  `msg` text NOT NULL,
  `status` enum('pending','processing','solved') NOT NULL,
  `responded_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderID` (`orderID`),
  KEY `responded_by` (`responded_by`),
  CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`responded_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `delivery_man` (
  `dID` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(100) NOT NULL,
  `d_phone` varchar(20) NOT NULL,
  `d_email` varchar(100) NOT NULL,
  `d_address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `areaID` int(11) NOT NULL,
  PRIMARY KEY (`dID`),
  KEY `areaID` (`areaID`),
  CONSTRAINT `delivery_man_ibfk_1` FOREIGN KEY (`areaID`) REFERENCES `area` (`areaID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO delivery_man VALUES("1","Rafiq","01963741258","rafiq@gmail.com","Dhanmondi","827ccb0eea8a706c4c34a16891f84e7b","1");
INSERT INTO delivery_man VALUES("2","Faruq","01479147369","faruq@gmail.com","Mirpur","827ccb0eea8a706c4c34a16891f84e7b","2");
INSERT INTO delivery_man VALUES("3","Rahim","01963741258","rahim@email.com","Uttora","827ccb0eea8a706c4c34a16891f84e7b","3");
INSERT INTO delivery_man VALUES("4","Karim","01479147369","k@email.com","Bonani","827ccb0eea8a706c4c34a16891f84e7b","4");
INSERT INTO delivery_man VALUES("5","Shafik","01963741258","shafik@email.com","Dhanmondi","827ccb0eea8a706c4c34a16891f84e7b","1");
INSERT INTO delivery_man VALUES("6","Zahid","01479147369","zahid@email.com","Mirpur","827ccb0eea8a706c4c34a16891f84e7b","2");





CREATE TABLE `delivery_man_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_manID` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('logged_in','logged_out','','') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_manID` (`delivery_manID`),
  CONSTRAINT `delivery_man_attendance_ibfk_1` FOREIGN KEY (`delivery_manID`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `delivery_man_charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dID` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(150) NOT NULL,
  `approved_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `approved_by` (`approved_by`),
  KEY `dID` (`dID`),
  CONSTRAINT `delivery_man_charge_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `delivery_man_charge_ibfk_2` FOREIGN KEY (`dID`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `emp_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empID` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('attend','absent') NOT NULL,
  `shift` enum('Day Shift','Night Shift') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empID` (`empID`),
  CONSTRAINT `emp_attendance_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `employee` (
  `empID` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `emp_phone` varchar(20) NOT NULL,
  `emp_email` varchar(150) NOT NULL,
  `emp_address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`empID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO employee VALUES("1","Shahriar Hossen","Operation Team Member","01859414563","mshpranto@gmail.com","Jigatola,Dhaka","827ccb0eea8a706c4c34a16891f84e7b");
INSERT INTO employee VALUES("2","Jahanur Islam","Manager","01698741258","jahanurcse96@gmail.com","Mohammodpur,Dhaka","827ccb0eea8a706c4c34a16891f84e7b");





CREATE TABLE `fee_collection` (
  `feeID` int(11) NOT NULL AUTO_INCREMENT,
  `merchantID` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `method` varchar(150) NOT NULL,
  `collected_by` int(11) NOT NULL,
  PRIMARY KEY (`feeID`),
  KEY `collected_by` (`collected_by`),
  KEY `merchantID` (`merchantID`),
  CONSTRAINT `fee_collection_ibfk_1` FOREIGN KEY (`collected_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fee_collection_ibfk_2` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO fee_collection VALUES("1","2","2020-11-01","50","cash","2");
INSERT INTO fee_collection VALUES("2","1","2020-11-02","10","cash","2");
INSERT INTO fee_collection VALUES("3","2","2020-11-03","80","cash","1");
INSERT INTO fee_collection VALUES("5","1","2020-11-03","10","cash","1");
INSERT INTO fee_collection VALUES("6","3","2020-11-04","30","cash","2");
INSERT INTO fee_collection VALUES("13","1","2020-11-05","20","cash","1");
INSERT INTO fee_collection VALUES("21","2","2020-11-12","20","Bank","1");
INSERT INTO fee_collection VALUES("22","3","2020-11-13","20","Cash","1");





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fee_collection_merchant` AS select `merchant`.`merchantID` AS `m_id`,`merchant`.`m_name` AS `m_name`,sum(`orders`.`fee`) AS `total_fee`,(select sum(`fee_collection`.`amount`) from `fee_collection` where `fee_collection`.`merchantID` = `merchant`.`merchantID`) AS `paid`,(select sum(`product_details`.`extra_charge`) from `product_details` where `product_details`.`merchantID` = `merchant`.`merchantID`) AS `extra_charge` from (`merchant` join `orders` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`status` = 'delivered' group by `merchant`.`merchantID`;

INSERT INTO fee_collection_merchant VALUES("1","rokomari","100","40","70");
INSERT INTO fee_collection_merchant VALUES("2","Ajker Deal","200","150","50");
INSERT INTO fee_collection_merchant VALUES("3","yellow","100","50","0");





CREATE TABLE `general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_charge` varchar(100) NOT NULL,
  `pickup_charge` varchar(100) NOT NULL,
  `company_name` text NOT NULL,
  `logo` text NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `merchant_charge` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO general VALUES("1","50","50","mtech","logo.png","Uttora","+8801859414563","mtech@email.com","10");





CREATE TABLE `merchant` (
  `merchantID` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(255) NOT NULL,
  `m_address` text NOT NULL,
  `m_phone` varchar(20) NOT NULL,
  `m_email` varchar(150) NOT NULL,
  `m_password` varchar(20) NOT NULL,
  `areaID` int(11) NOT NULL,
  PRIMARY KEY (`merchantID`),
  KEY `areaID` (`areaID`),
  CONSTRAINT `merchant_ibfk_1` FOREIGN KEY (`areaID`) REFERENCES `area` (`areaID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO merchant VALUES("1","rokomari","Dhanmondi","01596321654","mailinnur1@gmail.com","12345","1");
INSERT INTO merchant VALUES("2","Ajker Deal","Mirpur","01478963214","sharirepranto@gmail.com","12345","2");
INSERT INTO merchant VALUES("3","yellow","Dhanmondi","01596321654","rokomari@email.com","12345","1");
INSERT INTO merchant VALUES("4","ChalDal","Bonani","01759852963","chaldal@email.com","12345","4");





CREATE TABLE `merchant_payemt` (
  `paidID` int(11) NOT NULL AUTO_INCREMENT,
  `merchantID` int(11) NOT NULL,
  `date` date NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` varchar(150) NOT NULL,
  `payment_by` int(11) NOT NULL,
  `status` enum('pending','success') DEFAULT NULL,
  PRIMARY KEY (`paidID`),
  KEY `merchantID` (`merchantID`),
  KEY `payment_by` (`payment_by`),
  CONSTRAINT `merchant_payemt_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `merchant_payemt_ibfk_2` FOREIGN KEY (`payment_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO merchant_payemt VALUES("7","1","2020-11-01","cash","20","2","success");
INSERT INTO merchant_payemt VALUES("8","1","2020-11-12","cash","10","1","success");
INSERT INTO merchant_payemt VALUES("9","2","2020-11-12","cash","10","1","success");
INSERT INTO merchant_payemt VALUES("10","3","2020-11-12","cash","20","2","success");
INSERT INTO merchant_payemt VALUES("11","3","2020-11-12","cash","50","2","success");
INSERT INTO merchant_payemt VALUES("12","2","2020-11-12","cash","50","2","success");
INSERT INTO merchant_payemt VALUES("13","1","2020-11-13","cash","20","1","success");
INSERT INTO merchant_payemt VALUES("14","2","2020-11-13","bank","40","1","success");





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `merchant_payment_collection` AS select `orders`.`delivery_man` AS `paymnentBy`,`merchant`.`merchantID` AS `merchantID`,`merchant`.`m_name` AS `m_name`,`orders`.`orderID` AS `orderID`,`orders`.`order_type` AS `order_type`,(select `delivery_man`.`d_name` from `delivery_man` where `delivery_man`.`dID` = `orders`.`delivery_man`) AS `delivery_man`,sum((select sum(`order_details`.`price`) from `order_details` where `order_details`.`orderID` = `orders`.`orderID` group by `order_details`.`orderID`)) AS `total_price` from (`merchant` join `orders` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`order_type` = 'cash on delivery' group by `orders`.`merchantID`;

INSERT INTO merchant_payment_collection VALUES("5","1","rokomari","1","Cash on Delivery","Shafik","38000.00");
INSERT INTO merchant_payment_collection VALUES("2","2","Ajker Deal","2","Cash on Delivery","Faruq","5500.00");
INSERT INTO merchant_payment_collection VALUES("3","3","yellow","5","Cash on Delivery","Rahim","5500.00");





CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `product` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `wieght` varchar(150) NOT NULL,
  `categoryID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderID` (`orderID`),
  KEY `categoryID` (`categoryID`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO order_details VALUES("1","1","deaner set","3000.00","1","20","4");
INSERT INTO order_details VALUES("2","1","fridz","35000.00","2","200","5");
INSERT INTO order_details VALUES("3","2","document","1200.00","1","0.5","3");
INSERT INTO order_details VALUES("4","2","Book","300.00","2","3","3");
INSERT INTO order_details VALUES("5","2","glass set","500.00","6","2","4");
INSERT INTO order_details VALUES("6","3","shirt","500.00","2","1","3");
INSERT INTO order_details VALUES("7","4","pant","600.00","1",".3","3");
INSERT INTO order_details VALUES("8","5","t-shirt","500.00","1","1","3");
INSERT INTO order_details VALUES("9","3","pant","2000.00","1","2","3");
INSERT INTO order_details VALUES("10","3","shirt","500.00","","1","3");
INSERT INTO order_details VALUES("11","5","document","2500.00","1","1","3");
INSERT INTO order_details VALUES("12","5","cirtificate","2500.00","1","1","3");
INSERT INTO order_details VALUES("14","7","Book","500.00","2","1","3");





CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
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
  `received_by` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `pickup_man` (`pickup_man`),
  KEY `delivery_man` (`delivery_man`),
  KEY `received_by` (`received_by`),
  KEY `merchantID` (`merchantID`),
  KEY `pickup_area` (`pickup_area`),
  KEY `delivery_area` (`delivery_area`),
  KEY `customer_name` (`customer_name`),
  KEY `customer_phone` (`customer_phone`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO orders VALUES("1","1","2020-10-23","normal","Jighatola","Mohammodpur","100","delivered","5","5","abc111","1","1","Cash on Delivery","good","1","Ashik","018");
INSERT INTO orders VALUES("2","2","2020-10-22","normal","Mirpur-10","Mirpur-2","100","delivered","2","2","ttt147","2","2","Cash on Delivery","good","2","Shahriar","019");
INSERT INTO orders VALUES("3","2","2020-10-03","medium","Uttora","Bonani","100","delivered","3","4","ban111","3","4","Cash on Delivery","ok","2","Jahanur","017");
INSERT INTO orders VALUES("4","3","2020-11-04","normal","Mirpur","Dhanmondi","100","delivered","2","1","5677","2","1","Only Delivery","ok","2","Shahin","018");
INSERT INTO orders VALUES("5","3","2020-11-02","emergency","bonani","uttara","100","picked_up","4","3","5677","4","3","Cash on Delivery","ok","1","Mohayminul","018");
INSERT INTO orders VALUES("7","2","2020-11-14","normal","5/A","Mirpur road","","pending","1","2","","1","2","Cash on Delivery","","1","Siddik","017");





CREATE TABLE `payment_collection` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payment_by` int(11) NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `orderID` (`orderID`),
  KEY `payment_by` (`payment_by`),
  CONSTRAINT `payment_collection_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_collection_ibfk_2` FOREIGN KEY (`payment_by`) REFERENCES `delivery_man` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO payment_collection VALUES("3","5","2020-11-09","5500.00","4");
INSERT INTO payment_collection VALUES("4","3","2020-11-10","3000.00","4");
INSERT INTO payment_collection VALUES("5","2","2020-11-11","2000.00","2");





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_details` AS select `merchant`.`merchantID` AS `merchantID`,`orders`.`orderID` AS `orderID`,`orders`.`date` AS `date`,`orders`.`pickup_address` AS `pickup_address`,`orders`.`delivery_address` AS `delivery_address`,`orders`.`fee` AS `fee`,`orders`.`code` AS `code`,`orders`.`order_type` AS `order_type`,`order_details`.`product` AS `product`,`order_details`.`wieght` AS `wieght`,`order_details`.`qty` AS `qty`,`order_details`.`price` AS `price`,`category`.`category_name` AS `category_name`,`category`.`extra_charge` AS `extra_charge`,`orders`.`fee` + `category`.`extra_charge` AS `total_fee` from (((`orders` join `order_details` on(`orders`.`orderID` = `order_details`.`orderID`)) join `category` on(`category`.`categoryID` = `order_details`.`categoryID`)) join `merchant` on(`merchant`.`merchantID` = `orders`.`merchantID`)) where `orders`.`status` = 'delivered';

INSERT INTO product_details VALUES("2","2","2020-10-22","Mirpur-10","Mirpur-2","100","ttt147","Cash on Delivery","document","0.5","1","1200.00","Disposable","0","100");
INSERT INTO product_details VALUES("2","2","2020-10-22","Mirpur-10","Mirpur-2","100","ttt147","Cash on Delivery","Book","3","2","300.00","Disposable","0","100");
INSERT INTO product_details VALUES("2","3","2020-10-03","Uttora","Bonani","100","ban111","Cash on Delivery","shirt","1","2","500.00","Disposable","0","100");
INSERT INTO product_details VALUES("2","3","2020-10-03","Uttora","Bonani","100","ban111","Cash on Delivery","pant","2","1","2000.00","Disposable","0","100");
INSERT INTO product_details VALUES("2","3","2020-10-03","Uttora","Bonani","100","ban111","Cash on Delivery","shirt","1","","500.00","Disposable","0","100");
INSERT INTO product_details VALUES("3","4","2020-11-04","Mirpur","Dhanmondi","100","5677","Only Delivery","pant",".3","1","600.00","Disposable","0","100");
INSERT INTO product_details VALUES("1","1","2020-10-23","Jighatola","Mohammodpur","100","abc111","Cash on Delivery","deaner set","20","1","3000.00","Glass","50","150");
INSERT INTO product_details VALUES("2","2","2020-10-22","Mirpur-10","Mirpur-2","100","ttt147","Cash on Delivery","glass set","2","6","500.00","Glass","50","150");
INSERT INTO product_details VALUES("1","1","2020-10-23","Jighatola","Mohammodpur","100","abc111","Cash on Delivery","fridz","200","2","35000.00","Electronics Product","20","120");





CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_details_invoice` AS select `merchant`.`merchantID` AS `merchantID`,`orders`.`orderID` AS `orderID`,`orders`.`date` AS `date`,`orders`.`pickup_address` AS `pickup_address`,`orders`.`delivery_address` AS `delivery_address`,`orders`.`fee` AS `fee`,`orders`.`code` AS `code`,`orders`.`order_type` AS `order_type`,`order_details`.`product` AS `product`,`order_details`.`wieght` AS `wieght`,`order_details`.`qty` AS `qty`,`order_details`.`price` AS `price`,`category`.`category_name` AS `category_name`,`category`.`extra_charge` AS `extra_charge`,`orders`.`fee` + `category`.`extra_charge` AS `total_fee` from (((`orders` join `order_details` on(`orders`.`orderID` = `order_details`.`orderID`)) join `category` on(`category`.`categoryID` = `order_details`.`categoryID`)) join `merchant` on(`merchant`.`merchantID` = `orders`.`merchantID`));

INSERT INTO product_details_invoice VALUES("2","2","2020-10-22","Mirpur-10","Mirpur-2","100","ttt147","Cash on Delivery","document","0.5","1","1200.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("2","2","2020-10-22","Mirpur-10","Mirpur-2","100","ttt147","Cash on Delivery","Book","3","2","300.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("2","3","2020-10-03","Uttora","Bonani","100","ban111","Cash on Delivery","shirt","1","2","500.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("2","3","2020-10-03","Uttora","Bonani","100","ban111","Cash on Delivery","pant","2","1","2000.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("2","3","2020-10-03","Uttora","Bonani","100","ban111","Cash on Delivery","shirt","1","","500.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("3","4","2020-11-04","Mirpur","Dhanmondi","100","5677","Only Delivery","pant",".3","1","600.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("3","5","2020-11-02","bonani","uttara","100","5677","Cash on Delivery","t-shirt","1","1","500.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("3","5","2020-11-02","bonani","uttara","100","5677","Cash on Delivery","document","1","1","2500.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("3","5","2020-11-02","bonani","uttara","100","5677","Cash on Delivery","cirtificate","1","1","2500.00","Disposable","0","100");
INSERT INTO product_details_invoice VALUES("2","7","2020-11-14","5/A","Mirpur road","","","Cash on Delivery","Book","1","2","500.00","Disposable","0","0");
INSERT INTO product_details_invoice VALUES("1","1","2020-10-23","Jighatola","Mohammodpur","100","abc111","Cash on Delivery","deaner set","20","1","3000.00","Glass","50","150");
INSERT INTO product_details_invoice VALUES("2","2","2020-10-22","Mirpur-10","Mirpur-2","100","ttt147","Cash on Delivery","glass set","2","6","500.00","Glass","50","150");
INSERT INTO product_details_invoice VALUES("1","1","2020-10-23","Jighatola","Mohammodpur","100","abc111","Cash on Delivery","fridz","200","2","35000.00","Electronics Product","20","120");





CREATE TABLE `replacement` (
  `replaceID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `qty` varchar(20) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`replaceID`),
  KEY `orderID` (`orderID`),
  KEY `approved_by` (`approved_by`),
  CONSTRAINT `replacement_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `replacement_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `search_order` AS select `orders`.`orderID` AS `orderID`,`orders`.`pickup_area` AS `pickup_area`,`orders`.`delivery_area` AS `delivery_area`,`orders`.`date` AS `date`,`orders`.`priority` AS `priority`,`orders`.`status` AS `status`,`orders`.`order_type` AS `order_type`,(select `employee`.`emp_name` from `employee` where `employee`.`empID` = `orders`.`received_by`) AS `received_by`,`orders`.`pickup_man` AS `pickup_man`,`orders`.`delivery_man` AS `delivery_man`,`merchant`.`m_name` AS `merchant_name` from (`orders` join `merchant` on(`orders`.`merchantID` = `merchant`.`merchantID`));

INSERT INTO search_order VALUES("1","1","1","2020-10-23","normal","delivered","Cash on Delivery","Shahriar Hossen","5","5","rokomari");
INSERT INTO search_order VALUES("2","2","2","2020-10-22","normal","delivered","Cash on Delivery","Jahanur Islam","2","2","Ajker Deal");
INSERT INTO search_order VALUES("3","3","4","2020-10-03","medium","delivered","Cash on Delivery","Jahanur Islam","3","4","Ajker Deal");
INSERT INTO search_order VALUES("4","2","1","2020-11-04","normal","delivered","Only Delivery","Jahanur Islam","2","1","yellow");
INSERT INTO search_order VALUES("5","4","3","2020-11-02","emergency","picked_up","Cash on Delivery","Shahriar Hossen","4","3","yellow");
INSERT INTO search_order VALUES("7","1","2","2020-11-14","normal","pending","Cash on Delivery","Shahriar Hossen","1","2","Ajker Deal");





CREATE TABLE `stock` (
  `stockID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `stock_in_date` date NOT NULL,
  `stock_out_date` date NOT NULL,
  `return_date` date NOT NULL,
  `approved_by` int(11) NOT NULL,
  PRIMARY KEY (`stockID`),
  KEY `orderID` (`orderID`),
  KEY `approved_by` (`approved_by`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `wastage` (
  `wastageID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `approved_by` int(11) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`wastageID`),
  KEY `approved_by` (`approved_by`),
  KEY `orderID` (`orderID`),
  CONSTRAINT `wastage_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wastage_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




