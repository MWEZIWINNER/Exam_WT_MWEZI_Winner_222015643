-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 06:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_finance_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `balance` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `user_id`, `account_name`, `account_type`, `balance`) VALUES
(1, 1, '0', '0', '200000.00'),
(2, 2, '0', '0', '600000.00');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `budget_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`budget_id`, `user_id`, `category_id`, `amount`) VALUES
(1, 1, 1, '200000.00'),
(2, 2, 2, '500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `user_id`, `category_name`) VALUES
(1, 2, 'vacation'),
(2, 1, 'grociery'),
(3, 2, 'shoping');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `date_spent` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `user_id`, `category_id`, `amount`, `date_spent`) VALUES
(1, 1, 1, '2000.00', '0000-00-00'),
(2, 2, 2, '600.00', '0000-00-00'),
(3, 1, 2, '6666666.00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `goal_name` varchar(255) DEFAULT NULL,
  `target_amount` decimal(10,2) DEFAULT NULL,
  `current_amount` decimal(10,2) DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goal_id`, `user_id`, `goal_name`, `target_amount`, `current_amount`, `target_date`, `completed`, `created_at`) VALUES
(1, 1, 'school fees', '2000000.00', '1000000.00', '0000-00-00', 0, '2024-05-07 22:07:16'),
(2, 1, 'shopping', '2500000.00', '2000000.00', '0000-00-00', 0, '2024-05-07 22:08:02'),
(3, 2, 'charity', '99999999.99', '99999999.99', '0000-00-00', 0, '2024-05-09 17:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `date_received` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `user_id`, `source`, `amount`, `date_received`) VALUES
(1, 1, 'salary', '10000000.00', '0000-00-00'),
(2, 2, 'bonus', '20000.00', '0000-00-00'),
(3, 2, 'salary', '500000.00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminder_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reminder_text` text DEFAULT NULL,
  `reminder_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`reminder_id`, `user_id`, `reminder_text`, `reminder_date`) VALUES
(1, 1, '0', '0000-00-00'),
(2, 2, '0', '0000-00-00'),
(3, 2, '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `report_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `report_name`, `start_date`, `end_date`, `report_data`) VALUES
(1, 1, 'intare', '2024-05-02', '0000-00-00', '0'),
(2, 2, 'entered', '2024-05-02', '0000-00-00', '0'),
(3, 2, 'saved', '2024-05-03', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `date`, `amount`, `category`) VALUES
(1, 1, NULL, '1.00', 'shopping'),
(2, 2, '0089-06-07', '234567.00', 'ghjkkk'),
(3, 3, '2024-05-02', '40000.00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `created_at`) VALUES
(1, '0', '3456', '0', '0', '2024-05-07 21:12:26'),
(2, '34356', '5678', '456789', '0', '2024-05-07 21:13:20'),
(7, '34356', '$2y$10$lKmi2gRTMD2hLBBBt7een.yLIvty3PL9F0m8bEakkgq', '456789@gmail.com', '', '2024-05-11 14:08:49'),
(8, 'irani', '$2y$10$VsTw8MAknp4Qw8GsnN07W.J6WwTm96VrfDzc./IvpKI', 'kwizera@gmail.com', '', '2024-05-22 16:37:50'),
(9, 'irani', '$2y$10$ykPAt79.h2yEfBMuFjrQf.T.3mL69vaBTuIUQ/zTqay', 'kwizera@gmail.com', '', '2024-05-22 16:37:56'),
(10, 'irani', '$2y$10$Fk6ZEwgWtujvCbjltaxnN.QYlfVe2oA7O3sr6ul/jUC', 'kwizera@gmail.com', '', '2024-05-22 16:38:29'),
(11, 'kayumba', '$2y$10$QR/xpz/DNFsmaGDITiDcOuHPccGZ81S5Gzn5WK5SLpc', 'kayumba@gmail.com', 'kayumba d', '2024-05-22 16:47:46'),
(12, 'kayumba', '$2y$10$TPeU6lrmVjb2ssVvwWrgde.vaZYcXjej873La4qTt1k', 'kayumba@gmail.com', 'kayumba h', '2024-05-22 17:40:23'),
(13, 'paul', '$2y$10$oT4PMUx6Z.adDl/JTEGksO1ztkQFbrqtbw.5MhtyGiJ', 'paul@gmail.com', 'paul king', '2024-05-22 18:59:40'),
(14, 'paul', '$2y$10$RIvAc1nurzAH/Id968rBWO9ofPwWimTh2ElDrYuTwHc', 'paul@gmail.com', 'paul king', '2024-05-22 18:59:53'),
(15, 'paul', '$2y$10$GYBScA/wbAiViXJf6tZyE..gkfKsFZgYLlWdJXbVfpI', 'paul@gmail.com', 'paul king', '2024-05-22 19:00:35'),
(16, 'mmm', '$2y$10$WSFFmc7U2ft7WcYDXOu2SehHc5pkuH5ahJYC8QezJHS', 'mmm@gmail.com', 'winner', '2024-05-22 19:26:09'),
(17, 'kenny', '$2y$10$m3.fF9XvnqO9PoaHF7.5ZOGSfiSEen47JwLkpFVLJIO', 'kenny@gmail.com', 'kennyk', '2024-05-22 23:13:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`budget_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
