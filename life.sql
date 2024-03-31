-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 09:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `life`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_signup`
--

CREATE TABLE `admin_signup` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_signup`
--

INSERT INTO `admin_signup` (`admin_id`, `username`, `email`, `password`) VALUES
(2, 'riddhi', 'riddhi@gmail.com', 'riddhi1234');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `admin_id`, `brand_title`) VALUES
(1, 2, 'Blue Dart'),
(2, 2, 'Ecom Express'),
(3, 2, 'dhdqwhild');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(100) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`, `admin_id`) VALUES
(1, 'De-Toxifiers', 2),
(2, 'Shakes', 2),
(3, 'Skin', 2),
(4, 'qhdjlqwhjldq', 2);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`order_id`, `user_id`, `invoice_no`, `pro_id`, `quantity`, `order_status`) VALUES
(1, 1, 1668983560, 2, 1, 'pending'),
(2, 1, 338133759, 2, 2, 'pending'),
(3, 1, 271329355, 3, 2, 'pending'),
(4, 1, 1757964743, 2, 1, 'pending'),
(5, 1, 1482765642, 3, 1, 'pending'),
(6, 1, 495459324, 2, 1, 'pending'),
(7, 1, 1237266498, 0, 1, 'pending'),
(8, 1, 1998196377, 0, 1, 'pending'),
(9, 1, 490649735, 0, 1, 'pending'),
(10, 1, 273602974, 2, 2, 'pending'),
(11, 1, 164599546, 2, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `pro1_id` int(11) NOT NULL,
  `pro2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `admin_id`, `plan_name`, `pro1_id`, `pro2_id`) VALUES
(1, 2, 'Weight Loss', 2, 3),
(2, 2, 'Plan ', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plan_order`
--

CREATE TABLE `plan_order` (
  `plan_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `due_amount` decimal(10,2) NOT NULL,
  `total_plans` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('pending','complete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_quantity` int(100) NOT NULL,
  `pro_des` varchar(255) NOT NULL,
  `pro_keyword` varchar(255) NOT NULL,
  `pro_cost_price` varchar(255) NOT NULL,
  `pro_price` varchar(100) NOT NULL,
  `margin` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `pro_image` varchar(255) NOT NULL,
  `pro_image2` varchar(255) NOT NULL,
  `pro_image3` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `admin_id`, `stock`, `pro_name`, `pro_quantity`, `pro_des`, `pro_keyword`, `pro_cost_price`, `pro_price`, `margin`, `category_id`, `brand_id`, `pro_image`, `pro_image2`, `pro_image3`, `date`, `status`, `supplier_id`) VALUES
(2, 2, 100, 'Afresh', 3445, 'sdfnskljf', 'skin', '800', '1000', 200, 3, 1, 'pro2.jpg', 'pro2.jpg', 'pro2.jpg', '2024-03-27 08:29:21', 'TRUE', 1),
(3, 2, 150, 'Nutritional Shake', 23, 'fdgsg', 'gesg', '340', '500', 160, 1, 2, 'pro1.jpg', 'pro1.jpg', 'pro1.jpg', '2024-03-27 09:49:42', 'TRUE', 2),
(4, 2, 250, 'Shake Mix', 4567, 'hsquiohuoqh', 'wdhwoqhid', '1000', '3000', 2000, 2, 1, 'pro1.jpg', 'pro1.jpg', 'pro1.jpg', '2024-03-27 09:50:51', 'TRUE', 2);

-- --------------------------------------------------------

--
-- Table structure for table `productsuppliers`
--

CREATE TABLE `productsuppliers` (
  `ps_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `total_products` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsuppliers`
--

INSERT INTO `productsuppliers` (`ps_id`, `supplier_id`, `total_products`, `created_by`, `created_at`) VALUES
(1, 1, 1, 0, '2024-03-25 15:45:43'),
(2, 2, 2, 0, '2024-03-25 15:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `p_s_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `quantity_recieved` int(11) NOT NULL,
  `quantity_remaining` int(11) NOT NULL,
  `quantity_delivered` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `batch` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_orders`
--

INSERT INTO `product_orders` (`p_s_id`, `supplier_id`, `pro_id`, `quantity_ordered`, `quantity_recieved`, `quantity_remaining`, `quantity_delivered`, `status`, `batch`, `created_at`, `admin_id`) VALUES
(2, 1, 2, 100, 50, 50, 0, 'ORDERED', 1711528081, '2024-03-27 08:28:22', 2),
(3, 2, 3, 100, 100, 0, 0, 'ARRIVED', 1711528133, '2024-03-27 09:49:42', 2),
(4, 1, 2, 200, 250, -50, 0, 'INCOMPLETE', 1711533018, '2024-03-27 09:50:51', 2),
(5, 2, 3, 200, 0, 200, 0, 'ORDERED', 1711533018, '2024-03-27 09:50:51', 2);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sess_id` int(11) NOT NULL,
  `sess_name` varchar(255) NOT NULL,
  `trainer_name` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `start_sess` time NOT NULL,
  `end_sess` time NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sess_id`, `sess_name`, `trainer_name`, `des`, `start_sess`, `end_sess`, `url`) VALUES
(17, 'xsadaggah', 'sqisiqjsqs', 'wsqwsqsq', '03:03:00', '03:03:00', ''),
(18, 'abcd', 'efgh', 'hgjyufgeuifgayugfyugf', '00:00:00', '00:21:38', 'www.google.com'),
(19, 'sukjdhsuo', '', 'agkudgyodyh\r\n', '21:41:00', '17:40:00', 'https://www.google.co.in/');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `admin_id`, `supplier_name`, `added_at`, `email`, `updated_at`) VALUES
(1, 2, 'Herbalife', '2024-03-18 07:50:56', 'herballife123@gmail.com', '2024-03-18 05:38:59'),
(2, 2, 'herblife 2', '2024-03-18 07:50:59', 'herblife@gmail.com', '2024-03-17 17:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `pro_id`, `quantity_ordered`) VALUES
(2, 4, 123456),
(3, 3, 98876),
(4, 2, 12),
(5, 3, 34),
(6, 4, 56),
(7, 2, 12),
(8, 3, 34),
(9, 4, 56),
(10, 2, 12),
(11, 3, 34),
(12, 4, 56),
(13, 2, 12),
(14, 3, 34),
(15, 4, 56),
(16, 3, 100),
(17, 4, 100),
(18, 3, 100),
(19, 4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_details`
--

CREATE TABLE `trainer_details` (
  `trainer_id` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `trainer_fname` varchar(255) NOT NULL,
  `trainer_lname` varchar(255) NOT NULL,
  `trainer_contact` varchar(20) NOT NULL,
  `trainer_qual` varchar(255) NOT NULL,
  `trainer_work` varchar(255) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_details`
--

INSERT INTO `trainer_details` (`trainer_id`, `admin_id`, `trainer_fname`, `trainer_lname`, `trainer_contact`, `trainer_qual`, `trainer_work`, `join_date`) VALUES
('T1', 2, 'riddhi', 'chavan', '9248914174', 'iljhediohwdoewiodhwe', 'jkwduiwdhi', '2024-03-18 06:33:55'),
('T2', 2, 'mrunmai', 'bhave', '0987654567', 'djkdgwighd', 'dwudghukwhd\r\nbdkwhjkh\r\nwdjkwh', '2024-03-18 07:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `height` int(100) NOT NULL,
  `weight` int(100) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip` int(100) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `user_ip`, `fname`, `lname`, `gender`, `age`, `height`, `weight`, `house_no`, `street`, `city`, `state`, `zip`, `contact`) VALUES
(1, 'tanuja', 'tanuja123@gmail.com', 'tanuja123', '::1', 'Tanuja Anil', 'Chavan', 'Female', 44, 155, 75, '', '', '', '', 0, '9284191447'),
(3, 'baby', 'baby1234@gmail.com', 'baby1234', '::1', '', '', '', 0, 0, 0, '', '', '', '', 0, '8976542735');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `due_amount` int(255) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`order_id`, `user_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 1000, 1668983560, 1, '2024-03-09 10:03:50', 'complete'),
(2, 1, 2000, 338133759, 1, '2024-03-10 11:20:44', 'complete'),
(3, 1, 2000, 271329355, 1, '2024-03-11 03:57:27', 'complete'),
(4, 1, 1000, 1757964743, 1, '2024-03-11 04:02:49', 'complete'),
(5, 1, 1000, 1482765642, 1, '2024-03-11 04:09:06', 'complete'),
(6, 1, 1000, 495459324, 1, '2024-03-27 07:44:06', 'complete'),
(7, 1, 0, 1237266498, 0, '2024-03-27 07:14:07', 'pending'),
(8, 1, 0, 1998196377, 0, '2024-03-27 07:16:03', 'pending'),
(9, 1, 0, 490649735, 0, '2024-03-27 07:32:12', 'pending'),
(10, 1, 2000, 273602974, 1, '2024-03-27 09:42:37', 'complete'),
(11, 1, 1000, 164599546, 1, '2024-03-27 09:46:23', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_no`, `amount`, `payment_mode`, `date`) VALUES
(1, 1, 1668983560, 1000, 'UPI', '2024-03-09 10:03:50'),
(2, 2, 338133759, 2000, 'Cash on delivery', '2024-03-10 11:20:44'),
(3, 3, 271329355, 2000, 'Pay Offline', '2024-03-11 03:57:27'),
(4, 4, 1757964743, 1000, 'Netbanking', '2024-03-11 04:02:49'),
(5, 5, 1482765642, 1000, 'Select Payment Mode', '2024-03-11 04:09:06'),
(6, 6, 495459324, 1000, 'Netbanking', '2024-03-27 07:44:06'),
(7, 10, 273602974, 2000, 'Cash on delivery', '2024-03-27 09:42:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_signup`
--
ALTER TABLE `admin_signup`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_title` (`category_title`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `pro1_id` (`pro1_id`),
  ADD KEY `pro2_id` (`pro2_id`);

--
-- Indexes for table `plan_order`
--
ALTER TABLE `plan_order`
  ADD PRIMARY KEY (`plan_order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `productsuppliers`
--
ALTER TABLE `productsuppliers`
  ADD PRIMARY KEY (`ps_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`p_s_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sess_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `trainer_details`
--
ALTER TABLE `trainer_details`
  ADD PRIMARY KEY (`trainer_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_signup`
--
ALTER TABLE `admin_signup`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan_order`
--
ALTER TABLE `plan_order`
  MODIFY `plan_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productsuppliers`
--
ALTER TABLE `productsuppliers`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `p_s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `sess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`);

--
-- Constraints for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD CONSTRAINT `pending_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`),
  ADD CONSTRAINT `plan_ibfk_2` FOREIGN KEY (`pro1_id`) REFERENCES `products` (`pro_id`),
  ADD CONSTRAINT `plan_ibfk_3` FOREIGN KEY (`pro2_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `plan_order`
--
ALTER TABLE `plan_order`
  ADD CONSTRAINT `plan_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`);

--
-- Constraints for table `productsuppliers`
--
ALTER TABLE `productsuppliers`
  ADD CONSTRAINT `productsuppliers_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD CONSTRAINT `product_orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `product_orders_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`),
  ADD CONSTRAINT `product_orders_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `trainer_details`
--
ALTER TABLE `trainer_details`
  ADD CONSTRAINT `trainer_details_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_signup` (`admin_id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD CONSTRAINT `user_payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
