-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2022 at 11:24 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(128) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `roleid` int(6) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `pwd`, `roleid`, `email`, `fullname`, `phone`, `reg_date`, `stt`) VALUES
(1, 'admin', '202CB962AC59075B964B07152D234B70', 1, 'tunglam.sor@gmail.com', 'Hoàng Tùng Lâm', '0345071246', '2021-12-09 01:51:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `iduser` int(6) UNSIGNED NOT NULL,
  `idproduct` int(6) UNSIGNED NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`iduser`, `idproduct`, `quantity`) VALUES
(1, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(6) UNSIGNED NOT NULL,
  `categoryname` varchar(128) CHARACTER SET utf8 NOT NULL,
  `stt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `categoryname`, `stt`) VALUES
(1, 'Decorate', 1),
(2, 'Postcard', 1),
(3, 'Houseware', 1),
(4, 'Clothes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(6) UNSIGNED NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  `productid` int(6) UNSIGNED NOT NULL,
  `rate` int(1) NOT NULL,
  `mess` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `feed_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `userid`, `productid`, `rate`, `mess`, `feed_date`, `img`) VALUES
(4, 1, 3, 4, 'Hang giong hinh', '2021-12-21 04:07:05', '581633845b.jpg'),
(5, 3, 27, 3, 'Vải hơi cứng', '2021-12-27 11:37:40', '14635d8d35.jpg'),
(6, 3, 14, 5, 'Hàng giống ảnh', '2021-12-27 11:47:12', '07cf016dc3.jpg'),
(7, 6, 27, 4, 'Màu đẹp', '2021-12-27 11:50:21', '9c0fb6d3b5.jpg'),
(8, 8, 15, 1, 'Mua màu trắng mà giao màu hồng... Dỗi!!', '2021-12-29 16:36:03', 'a9fbf29b27.jpg'),
(9, 8, 22, 4, 'Thảm êm, mỗi tội màu trắng nhanh bẩn quá', '2021-12-29 16:36:25', '4618354bed.jpg'),
(10, 7, 13, 4, 'Giấy đẹp, giày không thấm mực', '2021-12-30 10:47:48', '409fef7b38.jpg'),
(11, 7, 21, 5, 'Đầy đủ như yêu cầu', '2021-12-30 10:48:13', 'c129708228.jpg'),
(12, 1, 27, 4, 'Đóng gói đẹp', '2022-01-07 11:03:22', '7008f8f45a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id` int(6) UNSIGNED NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) NOT NULL,
  `mess` varchar(255) CHARACTER SET utf8 NOT NULL,
  `stt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`id`, `userid`, `username`, `email`, `mess`, `stt`) VALUES
(2, 1, 'Hoàng Lâm', 'hoangtunglamltd@gmail.com', 'Mình test message nha', 1),
(3, 6, 'Phạm Uyên', 'uyenmeu@gmail.com', 'Web lag qua', 0),
(4, 1, 'Hoàng Lâm', 'hoangtunglamltd@gmail.com', 'Test mess', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderbill`
--

CREATE TABLE `tbl_orderbill` (
  `id` int(6) UNSIGNED NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `useraddress` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(15) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `paid` int(1) NOT NULL,
  `dateorder` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deliverystt` int(1) NOT NULL,
  `deliverydate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orderbill`
--

INSERT INTO `tbl_orderbill` (`id`, `userid`, `username`, `useraddress`, `phone`, `note`, `paid`, `dateorder`, `deliverystt`, `deliverydate`) VALUES
(9, 1, 'Hoàng Lâm', 'Buon Ju', '0345071246', 'Hàng dễ vỡ', 1, '2021-12-21 10:41:02', 1, '2021-12-21 10:41:02'),
(10, 3, 'Đỗ Thảo', 'Quảng Bình', '03999482777', '', 1, '2021-12-27 11:27:43', 1, '2021-12-27 11:27:43'),
(11, 6, 'Phạm Uyên', 'Huế', '039994918277', 'Gửi giờ hành chính', 1, '2021-12-27 11:48:41', 1, '2021-12-27 11:48:41'),
(12, 7, 'Thùy Dương', 'TP Huế', '01000399909', '', 1, '2021-12-29 16:33:27', 1, '2021-12-29 16:33:27'),
(13, 8, 'Nguyễn Trương Thành Nhân', 'TP Đà Nẵng', '011593499939', '', 1, '2021-12-29 16:33:28', 1, '2021-12-29 16:33:28'),
(14, 1, 'Hoàng Lâm', 'Buon Ju', '0345071246', '', 1, '2022-01-06 13:36:40', 1, '2022-01-06 13:36:40'),
(15, 1, 'Hoàng Lâm', 'Buon Ju', '0345071246', '', 1, '2022-01-07 12:17:46', 1, '2022-01-07 12:17:46'),
(16, 1, 'Hoàng Lâm', 'Buon Ju', '0345071246', 'Giao giờ hành chính', 0, '2022-01-06 13:03:21', 0, NULL),
(17, 1, 'Hoàng Lâm', 'Buon Ju', '0345071246', '', 0, '2022-01-06 13:09:16', 0, NULL),
(18, 1, 'Hoàng Lâm', 'Buon Ju', '0345071246', '', 0, '2022-01-06 13:11:20', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderinfo`
--

CREATE TABLE `tbl_orderinfo` (
  `id` int(6) UNSIGNED NOT NULL,
  `orderid` int(6) UNSIGNED NOT NULL,
  `productid` int(6) UNSIGNED NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` double(16,4) NOT NULL,
  `feedback` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orderinfo`
--

INSERT INTO `tbl_orderinfo` (`id`, `orderid`, `productid`, `quantity`, `price`, `feedback`) VALUES
(7, 9, 3, 2, 700000.0000, 1),
(8, 9, 27, 1, 550000.0000, 1),
(9, 10, 14, 1, 300000.0000, 1),
(10, 10, 27, 1, 550000.0000, 1),
(11, 11, 27, 1, 550000.0000, 1),
(12, 12, 13, 1, 430000.0000, 1),
(13, 12, 21, 1, 750000.0000, 1),
(14, 13, 15, 1, 700000.0000, 1),
(15, 13, 22, 1, 300000.0000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(6) UNSIGNED NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` double(16,4) NOT NULL,
  `sale` double(16,4) NOT NULL,
  `categoryid` int(6) UNSIGNED NOT NULL,
  `info` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `descript` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `stt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `productname`, `price`, `sale`, `categoryid`, `info`, `descript`, `quantity`, `img`, `stt`) VALUES
(1, 'Product 08', 150000.0000, 15.0000, 1, 'Mều nè', 'Mều nè', 2, '4419964524.jpg', 1),
(2, 'Product 07', 500000.0000, 0.0000, 1, 'Mều lè', 'Mều lè', 4, 'b9fdb57be8.jpg', 1),
(3, 'Product 03', 700000.0000, 0.0000, 2, 'Vyn Vyn', 'Vyn Vyn', 2, 'c02a076570.jpg', 1),
(4, 'Product 02', 650000.0000, 20.0000, 1, 'Vyn nef', 'Vyn nef', 8, '0f52bd1c02.jpg', 1),
(5, 'Product 15', 450000.0000, 0.0000, 3, 'Girl 01', 'Girl 01', 4, '6cf51959dd.jpg', 1),
(6, 'Product 14', 350000.0000, 15.0000, 1, 'Lorem', 'Lorem', 64, 'f26f5a8a2f.jpg', 1),
(7, 'Product 04', 800000.0000, 5.0000, 3, 'Lorem ne', 'Lorem ne', 7, '61de803a23.jpg', 1),
(8, 'Product 19', 650000.0000, 5.0000, 4, 'Lorem el', 'Lorem el', 3, '52a189b977.jpg', 1),
(9, 'Product 05', 450000.0000, 0.0000, 3, 'lorem nhiha', 'lorem nhiha', 8, 'e112314857.jpg', 1),
(10, 'Product 06', 600000.0000, 0.0000, 3, 'Logem nhi ha', 'Logem nhi ha', 5, '154bc1b14b.jpg', 1),
(13, 'Product 10', 430000.0000, 10.0000, 2, 'KL201', 'KL201', 4, '7413b85257.jpg', 1),
(14, 'Product 09', 300000.0000, 0.0000, 1, '999d', '999d', 18, '9f851cfd40.jpg', 1),
(15, 'Product 12', 700000.0000, 5.0000, 1, 'Kang H', 'Kang H', 2, 'd93228a87b.jpg', 1),
(18, 'Product 11', 500000.0000, 0.0000, 2, 'inf for kangdong', 'des for kangdong', 4, 'fa47ad5dd6.jpg', 1),
(20, 'Product 16', 700000.0000, 0.0000, 2, 'kala hudong', 'kala hudong', 4, 'a49c57ad0f.jpg', 1),
(21, 'Product 13', 750000.0000, 0.0000, 2, 'kr cn', 'kr cn', 4, 'c38a9a1856.jpg', 1),
(22, 'Product 01', 300000.0000, 0.0000, 3, 'huchi', 'huchi', 4, 'b7e55024c9.jpg', 1),
(26, 'Product 18', 400000.0000, 0.0000, 4, 'cnzhong', 'cnzhong', 4, '032e925932.jpg', 1),
(27, 'Product 17', 550000.0000, 7.0000, 4, 'hie', 'hie', 4, 'eaff926f6d.jpg', 1),
(28, 'Product 20', 310000.0000, 0.0000, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui et doloribus maxime amet natus magni nulla illum excepturi accusamus explicabo, quos, placeat repellendus voluptates omnis laborum tenetur quia alias. Sed.', 0, '6a1f8e6d97.jfif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(6) UNSIGNED NOT NULL,
  `rolename` varchar(128) CHARACTER SET utf8 NOT NULL,
  `stt` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `rolename`, `stt`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_useraccount`
--

CREATE TABLE `tbl_useraccount` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(128) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sex` int(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `uaddress` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stt` int(1) NOT NULL,
  `secretnumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_useraccount`
--

INSERT INTO `tbl_useraccount` (`id`, `username`, `pwd`, `firstname`, `lastname`, `sex`, `birthday`, `email`, `phone`, `uaddress`, `reg_date`, `stt`, `secretnumber`) VALUES
(1, 'tunglamltd', '202cb962ac59075b964b07152d234b70', 'Hoàng', 'Lâm', 0, '2000-05-02', 'hoangtunglamltd@gmail.com', '0345071246', 'Buon Ju', '2022-01-06 06:35:03', 1, NULL),
(2, 'duyentm', '12853a7027503fd9e0996ac053f83876', 'Nguyễn', 'Duyên', NULL, NULL, ' duyentm@gmail.com', NULL, NULL, '2021-12-29 12:39:44', 1, NULL),
(3, 'tharod', '5b95299bb94f9230b3bf4c3a438f9069', 'Đỗ', 'Thảo', NULL, NULL, 'tharod@gmail.com', NULL, NULL, '2021-12-29 12:39:48', 1, NULL),
(4, 'oanhnguyen1928', '5ce981b44eeb7885bb12ad18eb3309d1', 'Nguyễn', 'Thị Oanh', NULL, NULL, 'nguyenthioanh@gmail.com', NULL, NULL, '2021-12-29 12:39:50', 1, NULL),
(5, 'bachhoang14', '5f4158d5da8b4e4b780799c462c0fb9c', 'Hoàng', 'Tùng Bách', NULL, NULL, 'bachdevilhoang@gmail.com', NULL, NULL, '2021-12-29 12:39:52', 1, NULL),
(6, 'meu2929', '11a2be2b47637baef589dbc34cc297aa', 'Phạm', 'Uyên', NULL, NULL, 'uyenmeu@gmail.com', NULL, NULL, '2021-12-29 12:39:54', 1, NULL),
(7, 'berpotato', '6b3e3b782b34a9f88b4e5524c866e019', 'Thùy', 'Dương', NULL, NULL, 'duong123@gmail.coim', NULL, NULL, '2021-12-29 12:39:56', 1, NULL),
(8, 'thanhnhan205', 'a024743b3c33f03a34db3492e693a797', 'Nguyễn', 'Trương Thành Nhân', NULL, NULL, 'thanhnhan205@gmail.com', NULL, NULL, '2021-12-29 12:39:58', 1, NULL),
(9, 'touyennguyen', '9a03e8aece2e54829e375a42c9ea398a', 'Nguyên', 'Tố Uyên', NULL, NULL, 'uyennguyen@gmail.com', NULL, NULL, '2021-12-29 12:40:00', 1, NULL),
(10, 'tuannguyen41', 'd2387a13563565184b1c1fb40e119272', 'Nguyễn', 'Tuấn', NULL, NULL, 'tuannguyenspa@gmail.com', NULL, NULL, '2021-12-29 12:40:02', 1, NULL),
(11, 'bickngoc5', '2fcb09103b1187603c4c034596f57b9d', 'Lê', 'Thị Bích Ngọc', NULL, NULL, 'lebichngoc@gmail.com', NULL, NULL, '2021-12-29 12:40:04', 1, NULL),
(12, 'khanhsheep', 'dd9407501157051c3872744a44deb17c', 'Hồ', 'Quốc Khánh', NULL, NULL, 'khanhho@gmail.com', NULL, NULL, '2021-12-29 12:40:06', 1, NULL),
(13, 'kupin48', '2ca4c46417ae70f1bb632590923263ef', 'Phạm', 'Văn', NULL, NULL, 'kupin9239@gmail.com', NULL, NULL, '2021-12-29 12:40:07', 1, NULL),
(15, 'phamloc', '202cb962ac59075b964b07152d234b70', 'Phạm', 'Lộc', NULL, NULL, 'locpham@yahoo.com', NULL, NULL, '2022-01-05 11:19:51', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleid` (`roleid`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`iduser`,`idproduct`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_orderbill`
--
ALTER TABLE `tbl_orderbill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_orderinfo`
--
ALTER TABLE `tbl_orderinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_useraccount`
--
ALTER TABLE `tbl_useraccount`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_orderbill`
--
ALTER TABLE `tbl_orderbill`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_orderinfo`
--
ALTER TABLE `tbl_orderinfo`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_useraccount`
--
ALTER TABLE `tbl_useraccount`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `tbl_role` (`id`);

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `tbl_feedback_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_useraccount` (`id`),
  ADD CONSTRAINT `tbl_feedback_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `tbl_product` (`id`);

--
-- Constraints for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD CONSTRAINT `tbl_message_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_useraccount` (`id`);

--
-- Constraints for table `tbl_orderbill`
--
ALTER TABLE `tbl_orderbill`
  ADD CONSTRAINT `tbl_orderbill_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_useraccount` (`id`);

--
-- Constraints for table `tbl_orderinfo`
--
ALTER TABLE `tbl_orderinfo`
  ADD CONSTRAINT `tbl_orderinfo_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `tbl_orderbill` (`id`),
  ADD CONSTRAINT `tbl_orderinfo_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `tbl_product` (`id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `tbl_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
