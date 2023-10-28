-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2023 at 04:24 AM
-- Server version: 10.6.11-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u363824010_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylogs`
--

CREATE TABLE `activitylogs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `device_info` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `department_id`, `date`, `time`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 3, 8, 8, '2023-04-29', '00:08:00', 'pending', 'Fugiat pariatur maxime omnis et aut et.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(2, 4, 3, 3, '2023-02-16', '16:28:03', 'confirmed', 'Eum non repudiandae illum omnis sit atque atque.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(3, 5, 4, 8, '2023-07-16', '12:33:33', 'confirmed', 'Minus repellat tempore explicabo iure dolor voluptatem ullam.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(4, 4, 10, 4, '2022-12-26', '05:32:44', 'pending', 'Accusantium fuga dignissimos ea reiciendis aut rerum.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(5, 1, 6, 10, '2023-02-07', '00:07:25', 'pending', 'Incidunt ut tempore maiores voluptas ut.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(6, 1, 1, 1, '2023-09-18', '20:39:46', 'confirmed', 'Minus expedita tempore reiciendis occaecati deleniti possimus amet deserunt.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(7, 7, 8, 4, '2022-08-22', '08:31:21', 'pending', 'Rerum ex ut est quia assumenda explicabo.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(8, 1, 3, 9, '2023-10-16', '15:19:22', 'confirmed', 'Nisi voluptas accusamus inventore sit totam.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(9, 10, 2, 1, '2023-05-14', '17:26:30', 'pending', 'Ullam molestiae hic neque et odio sint.', '2023-03-06 09:33:22', '2023-03-06 09:33:22'),
(10, 1, 5, 6, '2022-06-29', '04:13:25', 'confirmed', 'Aspernatur est voluptate accusamus ut omnis temporibus laudantium.', '2023-03-06 09:33:22', '2023-03-06 09:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `dayoff_schedules`
--

CREATE TABLE `dayoff_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dep_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 4, 'Dialysis', 'Dialysis Department', '2023-02-04 10:06:49', '2023-02-04 10:06:49'),
(6, 2, 'Pharmacy', 'Pharmacy Department', '2023-02-12 13:51:33', '2023-02-12 13:51:33'),
(8, 1, 'Laboratory', 'Laboratory Department', '2023-02-12 15:49:59', '2023-02-12 15:49:59'),
(9, 3, 'Radiology', 'Radiology Dept', '2023-02-12 15:50:09', '2023-02-12 15:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hemodialysis`
--

CREATE TABLE `hemodialysis` (
  `id` int(11) NOT NULL,
  `test` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hemodialysis_categories`
--

CREATE TABLE `hemodialysis_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hemodialysis_deliveries`
--

CREATE TABLE `hemodialysis_deliveries` (
  `id` int(11) NOT NULL,
  `dialysis_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `lot_no` int(20) NOT NULL,
  `expiry` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

CREATE TABLE `laboratories` (
  `id` int(11) NOT NULL,
  `test` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`id`, `test`, `category_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdf', 1, '500.00', '2023-03-10 12:32:53', '2023-03-10 12:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_categories`
--

CREATE TABLE `laboratory_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratory_categories`
--

INSERT INTO `laboratory_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sdff', '2023-03-10 12:32:36', '2023-03-10 12:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_deliveries`
--

CREATE TABLE `laboratory_deliveries` (
  `id` int(11) NOT NULL,
  `lab_id` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `lot_no` int(20) NOT NULL,
  `expiry` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratory_deliveries`
--

INSERT INTO `laboratory_deliveries` (`id`, `lab_id`, `category_id`, `brand`, `lot_no`, `expiry`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, '1', 1, 'sad', 43423, '2023-03-10', 34, '34.00', '2023-03-10 12:31:57', '2023-03-10 12:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pharma_id` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `brand_number` varchar(50) DEFAULT NULL,
  `registration_number` varchar(100) DEFAULT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `expire_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `upload_request` text DEFAULT NULL,
  `upload_id` text DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `bday` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `fund_type` varchar(100) DEFAULT NULL,
  `patient_ticket` varchar(100) DEFAULT NULL,
  `request_status` int(11) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `patient_signature` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `upload_request`, `upload_id`, `firstname`, `lastname`, `address`, `bday`, `age`, `gender`, `fund_type`, `patient_ticket`, `request_status`, `date_paid`, `remarks`, `patient_signature`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'test', 'lang', 'Atulayan', '02-06-1996', 21, 'Male', 'OMOE', '12345', 4, NULL, NULL, NULL, '2023-03-10 12:26:47', '2023-03-10 12:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacies`
--

CREATE TABLE `pharmacies` (
  `id` int(11) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_categories`
--

CREATE TABLE `pharmacy_categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radiologies`
--

CREATE TABLE `radiologies` (
  `id` int(11) NOT NULL,
  `test` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radiologies`
--

INSERT INTO `radiologies` (`id`, `test`, `category_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'fds', 1, '30000.00', '2023-03-10 13:31:25', '2023-03-10 13:31:25'),
(2, 'dfgdfgfd', 2, '677.00', '2023-03-10 13:31:53', '2023-03-10 13:31:53'),
(3, 'dfgdf', 3, '55.00', '2023-03-10 13:32:10', '2023-03-10 13:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `radiology_categories`
--

CREATE TABLE `radiology_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radiology_categories`
--

INSERT INTO `radiology_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'X-ray', '2023-03-10 16:36:10', '2023-03-10 16:36:10'),
(2, 'Ultrasound', '2023-03-10 16:36:27', '2023-03-10 16:36:27'),
(3, 'C.T. Scan', '2023-03-10 16:36:46', '2023-03-10 16:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `radiology_deliveries`
--

CREATE TABLE `radiology_deliveries` (
  `id` int(11) NOT NULL,
  `radiology_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `lot_no` int(40) NOT NULL,
  `expiry` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radiology_deliveries`
--

INSERT INTO `radiology_deliveries` (`id`, `radiology_id`, `category_id`, `brand`, `lot_no`, `expiry`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sdf', 43423, '2023-03-10', 34, '34.00', '2023-03-10 13:33:35', '2023-03-10 13:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `test_charge_tickets`
--

CREATE TABLE `test_charge_tickets` (
  `id` int(11) NOT NULL,
  `ticket_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `ticket_status` int(11) NOT NULL DEFAULT 0,
  `date_created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_charge_tickets`
--

INSERT INTO `test_charge_tickets` (`id`, `ticket_number`, `dept_id`, `item_id`, `qty`, `amount`, `ticket_status`, `date_created`, `created_at`, `updated_at`) VALUES
(1, '12345', 1, 1, 5, '500.00', 2, '2023-03-10', '2023-03-10 12:26:04', '2023-03-10 12:26:04'),
(2, '12345', 1, 1, 1, '500.00', 2, '2023-03-11', '2023-03-10 12:26:04', '2023-03-10 12:26:04'),
(3, '12345', 1, 1, 1, '500.00', 2, '2023-04-19', '2023-04-19 12:26:04', '2023-03-10 12:26:04'),
(4, '12345', 1, 1, 1, '500.00', 2, '2023-04-19', '2023-03-10 12:26:04', '2023-03-10 12:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `time_schedules`
--

CREATE TABLE `time_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_day` varchar(255) NOT NULL,
  `week_num` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_schedules`
--

INSERT INTO `time_schedules` (`id`, `week_day`, `week_num`, `start_time`, `end_time`, `duration`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'monday', 1, '00:20:23', '21:23:00', NULL, 40, '2023-02-12 13:52:29', '2023-02-12 13:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `isActivated` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `employee_id`, `email`, `password`, `picture`, `birth_date`, `age`, `gender`, `mobile`, `type`, `email_verified_at`, `remember_token`, `dept_id`, `isActivated`, `created_at`, `updated_at`) VALUES
(1, 'Diana', 'Binarao', NULL, 'fardanph@gmail.com', '$2y$10$Xcn8S4.EV/JxD70ShW2alOUzuyPts6UZEaJPa6LSkHBSHXsx6y6Ka', NULL, '2013-12-16', NULL, 'female', NULL, '1', '2023-03-06 09:37:57', NULL, NULL, 1, '2023-03-06 09:37:58', '2023-03-06 09:37:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylogs`
--
ALTER TABLE `activitylogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dayoff_schedules`
--
ALTER TABLE `dayoff_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hemodialysis`
--
ALTER TABLE `hemodialysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hemodialysis_categories`
--
ALTER TABLE `hemodialysis_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hemodialysis_deliveries`
--
ALTER TABLE `hemodialysis_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratory_categories`
--
ALTER TABLE `laboratory_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratory_deliveries`
--
ALTER TABLE `laboratory_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacies`
--
ALTER TABLE `pharmacies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_categories`
--
ALTER TABLE `pharmacy_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radiologies`
--
ALTER TABLE `radiologies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radiology_categories`
--
ALTER TABLE `radiology_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radiology_deliveries`
--
ALTER TABLE `radiology_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_charge_tickets`
--
ALTER TABLE `test_charge_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_schedules`
--
ALTER TABLE `time_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitylogs`
--
ALTER TABLE `activitylogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dayoff_schedules`
--
ALTER TABLE `dayoff_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hemodialysis`
--
ALTER TABLE `hemodialysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hemodialysis_categories`
--
ALTER TABLE `hemodialysis_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hemodialysis_deliveries`
--
ALTER TABLE `hemodialysis_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laboratory_categories`
--
ALTER TABLE `laboratory_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laboratory_deliveries`
--
ALTER TABLE `laboratory_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmacies`
--
ALTER TABLE `pharmacies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_categories`
--
ALTER TABLE `pharmacy_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radiologies`
--
ALTER TABLE `radiologies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `radiology_categories`
--
ALTER TABLE `radiology_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `radiology_deliveries`
--
ALTER TABLE `radiology_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_charge_tickets`
--
ALTER TABLE `test_charge_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time_schedules`
--
ALTER TABLE `time_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
