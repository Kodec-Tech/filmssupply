-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2024 at 08:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmssupply`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Balance` varchar(100) NOT NULL,
  `SavingBalance` varchar(100) NOT NULL,
  `SavingTarget` varchar(100) NOT NULL,
  `AccountType` text NOT NULL,
  `State` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `ref_bonus` varchar(128) DEFAULT NULL,
  `invite_code` varchar(255) DEFAULT NULL,
  `referral` varchar(255) DEFAULT NULL,
  `bonus` varchar(225) DEFAULT NULL,
  `amount_processing` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `AccountNo`, `Balance`, `SavingBalance`, `SavingTarget`, `AccountType`, `State`, `username`, `ref_bonus`, `invite_code`, `referral`, `bonus`, `amount_processing`) VALUES
(60, '1125', '0.0', '0.0', '', 'Saving', 0, 'admin', '0.0', 'YVIFK', NULL, '300', NULL),
(61, '6792', '0.0', '0.0', '', 'Saving', 0, 'samy', '0.0', 'SAWFP', NULL, '300', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(11) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `setting_value2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `setting_name`, `setting_value`, `last_updated`, `setting_value2`) VALUES
(1, 'social_links', 'https://web.whatsapp.com/', '2024-08-16 11:07:38', 'https://telegram.io'),
(2, 'maintenance_mode', 'OFF', '2024-08-16 10:48:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bind_wallet`
--

CREATE TABLE `bind_wallet` (
  `id` int(11) NOT NULL,
  `acctNo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `coin_type` varchar(255) NOT NULL,
  `wallet_network` varchar(255) NOT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bind_wallet`
--

INSERT INTO `bind_wallet` (`id`, `acctNo`, `username`, `coin_type`, `wallet_network`, `wallet_address`, `create_date`) VALUES
(5, '841492', 'samy', 'Bitcoin', 'BTC', 'xDdfdfaaaaaaaaaaaaadsmnfvddXdfdf', '2024-07-14 15:44:31'),
(6, '701955', 'sarada', 'Bitcoin', 'TRC20', 'rjr349085908r4iccen', '2024-07-15 14:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `C_No` int(11) NOT NULL,
  `Account_No` varchar(12) NOT NULL,
  `C_First_Name` text NOT NULL,
  `C_Last_Name` text NOT NULL,
  `Gender` text NOT NULL,
  `C_Father_Name` text NOT NULL,
  `C_Mother_Name` text NOT NULL,
  `C_Birth_Date` date NOT NULL,
  `C_Adhar_No` varchar(12) NOT NULL,
  `C_Pan_No` varchar(10) NOT NULL,
  `C_Mobile_No` varchar(25) NOT NULL,
  `C_Email` varchar(200) NOT NULL,
  `C_Pincode` varchar(6) NOT NULL,
  `C_Adhar_Doc` varchar(500) NOT NULL,
  `C_Pan_Doc` varchar(500) NOT NULL,
  `Create_Date` date NOT NULL DEFAULT current_timestamp(),
  `ProfileColor` varchar(100) NOT NULL,
  `ProfileImage` varchar(400) NOT NULL,
  `Bio` varchar(100) NOT NULL,
  `Country` varchar(25) DEFAULT NULL,
  `kyc_approval` varchar(20) NOT NULL,
  `downline` varchar(128) DEFAULT NULL,
  `withdrawal_pin` varchar(10) NOT NULL,
  `currency` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`C_No`, `Account_No`, `C_First_Name`, `C_Last_Name`, `Gender`, `C_Father_Name`, `C_Mother_Name`, `C_Birth_Date`, `C_Adhar_No`, `C_Pan_No`, `C_Mobile_No`, `C_Email`, `C_Pincode`, `C_Adhar_Doc`, `C_Pan_Doc`, `Create_Date`, `ProfileColor`, `ProfileImage`, `Bio`, `Country`, `kyc_approval`, `downline`, `withdrawal_pin`, `currency`) VALUES
(74, '1125', 'owner', 'owner', 'Not Available', '', '', '0000-00-00', '', '', '535353645334', 'admin@gmail.com', '', '', '', '2024-08-29', '#125db4', '', '', '', '', NULL, '111111', '$'),
(75, '6792', 'Veronica', 'Rich', 'Not Available', '', '', '0000-00-00', '', '', '264545454545', 'kaleb@mailinator.com', '', '', '', '2024-08-29', '#6de4f0', '', '', '', '', NULL, '111111', '£');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expiry_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `State` int(11) NOT NULL,
  `AuthKey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `AccountNo`, `Username`, `Password`, `Status`, `State`, `AuthKey`) VALUES
(69, '1125', 'admin', '$2y$10$fj.1x515Tz5Vy9qLbRN94O0y5uz8S9f2eH6z9id4nwQvC6GXv/VKi', 'Super', 1, '0'),
(70, '6792', 'samy', '$2y$10$9JodLHv6brWJkxasZDH/e.UQIAus310tzJKE4RfSWiVgEXlsN/gYO', 'Active', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `merge_product`
--

CREATE TABLE `merge_product` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `acctNo` varchar(255) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_amount` varchar(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `commission` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `grand_order` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mymembership`
--

CREATE TABLE `mymembership` (
  `level_id` int(11) NOT NULL,
  `AcctNo` varchar(28) NOT NULL,
  `username` varchar(28) NOT NULL,
  `level` varchar(28) NOT NULL DEFAULT 'normal',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mymembership`
--

INSERT INTO `mymembership` (`level_id`, `AcctNo`, `username`, `level`, `created_at`) VALUES
(46, '6792', 'samy', 'normal', '2024-08-29 18:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_amount` varchar(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `commission` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_amount`, `order_number`, `commission`, `level`, `product_img`, `created_time`) VALUES
(81, 'Movie Abbey Testing First onboarding ', '200', 'ORD-5633610574', '0.7', 'normal', '../movies-img/movie_abbey.jpg07242024173924.jpg', '2024-07-24 15:39:24'),
(82, 'averfe ie Abbey Testing First onboarding ', '120', 'ORD-5630772676', '0.7', 'normal', '../movies-img/history_img1.jpg07242024190930.jpg', '2024-07-24 16:06:52'),
(83, 'OPERn edodvrnodrn ', '50', 'ORD-9920545665', '0.7', 'normal', '../movies-img/comin_soon8.jpg07242024210438.jpg', '2024-07-24 19:04:38'),
(84, 'Marabaha Indian movie', '120', 'ORD-8292784482', '0.9', 'vip', '../movies-img/coming_soon5.png07262024133714.png', '2024-07-26 11:37:14'),
(85, 'movie vvip', '200', 'ORD-3859330472', '1.5', 'vvip', '../movies-img/coming_soon4.jfif08202024180039.jfif', '2024-07-26 11:56:42'),
(87, 'movie gold', '300', 'ORD-6220189052', '2.3', 'gold', '../movies-img/movie4.jpeg07262024140639.jpeg', '2024-07-26 12:06:21'),
(88, 'movie diamond test', '677', 'ORD-6134469160', '2.5', 'diamond', '../movies-img/movie3.jpeg07262024140920.jpeg', '2024-07-26 12:09:20'),
(89, 'movie vvvip', '56', 'ORD-4398560244', '1.8', 'vvvip', '../movies-img/coming_soon6.jpg07302024002922.jpg', '2024-07-29 22:29:22'),
(90, 'test2', '120', 'ORD-9673084478', '0.9', 'vip', '../movies-img/image.png08202024173819.png', '2024-08-20 15:38:19'),
(91, 'test3', '140', 'ORD-8252078491', '0.9', 'vip', '../movies-img/pic.jpg08202024173844.jpg', '2024-08-20 15:38:44'),
(92, 'test4', '410', 'ORD-1210054549', '0.9', 'vip', '../movies-img/back.png08202024173900.png', '2024-08-20 15:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `threat_response`
--

CREATE TABLE `threat_response` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `banned` int(11) DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threat_response`
--

INSERT INTO `threat_response` (`id`, `ip_address`, `banned`, `login_count`) VALUES
(18, '::1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `FAccountNo` varchar(255) NOT NULL,
  `Name` text NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `Debit` varchar(100) NOT NULL,
  `Credit` varchar(100) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Status` text NOT NULL,
  `ProfileColor` varchar(100) NOT NULL,
  `type` varchar(128) DEFAULT NULL,
  `wallet_network` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `AccountNo`, `FAccountNo`, `Name`, `Amount`, `Debit`, `Credit`, `Date`, `Status`, `ProfileColor`, `type`, `wallet_network`) VALUES
(95, '841492', 'NA', 'Filmsupply', '900', '0.0', '900', '2024-07-15', 'Credited', 'blue', 'deposit', NULL),
(96, '841492', 'xDdfdfaaaaaaaaaaaaadsmnfvddXdfdf', 'Bitcoin', '20', '20', '0.0', '2024-07-23', 'Pending', '', 'withdrawal', 'BTC'),
(97, '841492', 'xDdfdfaaaaaaaaaaaaadsmnfvddXdfdf', 'Bitcoin', '20', '20', '0.0', '2024-07-23', 'approve', '', 'withdrawal', 'BTC');

-- --------------------------------------------------------

--
-- Table structure for table `user_task`
--

CREATE TABLE `user_task` (
  `id` int(11) NOT NULL,
  `acctNo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_amount` varchar(255) NOT NULL,
  `today_earning` varchar(255) NOT NULL,
  `commission_earned` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `level` varchar(255) DEFAULT NULL,
  `reset` varchar(255) DEFAULT 'false',
  `order_number` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_task`
--

INSERT INTO `user_task` (`id`, `acctNo`, `username`, `product_id`, `product_title`, `product_img`, `product_amount`, `today_earning`, `commission_earned`, `status`, `created_date`, `level`, `reset`, `order_number`) VALUES
(176, '1597', 'phoenix', 84, 'Marabaha Indian movie', '../movies-img/coming_soon5.png07262024133714.png', '120', '1.08', '1.08', 'completed', '2024-08-20 17:31:40', 'vip', 'false', 'ORD-8292784482'),
(177, '1597', 'phoenix', 90, 'test2', '../movies-img/image.png08202024173819.png', '120', '1.08', '1.08', 'completed', '2024-08-20 17:31:48', 'vip', 'false', 'ORD-9673084478'),
(178, '1597', 'phoenix', 92, 'test4', '../movies-img/back.png08202024173900.png', '410', '3.69', '3.69', 'completed', '2024-08-20 17:31:53', 'vip', 'false', 'ORD-1210054549'),
(179, '1597', 'phoenix', 91, 'test3', '../movies-img/pic.jpg08202024173844.jpg', '140', '1.26', '1.26', 'completed', '2024-08-20 17:32:02', 'vip', 'false', 'ORD-8252078491');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bind_wallet`
--
ALTER TABLE `bind_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`C_No`),
  ADD UNIQUE KEY `Account_No` (`Account_No`),
  ADD UNIQUE KEY `C_Email` (`C_Email`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`AccountNo`),
  ADD UNIQUE KEY `Unique` (`ID`),
  ADD UNIQUE KEY `AccountNo` (`AccountNo`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `merge_product`
--
ALTER TABLE `merge_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mymembership`
--
ALTER TABLE `mymembership`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `threat_response`
--
ALTER TABLE `threat_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_task`
--
ALTER TABLE `user_task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bind_wallet`
--
ALTER TABLE `bind_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `C_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `merge_product`
--
ALTER TABLE `merge_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mymembership`
--
ALTER TABLE `mymembership`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `threat_response`
--
ALTER TABLE `threat_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_task`
--
ALTER TABLE `user_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
