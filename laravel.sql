-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 07:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_name`) VALUES
('Colours'),
('uncategorised'),
('GG');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(255) NOT NULL,
  `sku` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `discount` int(11) NOT NULL DEFAULT 0,
  `discount_setting` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uncategorised',
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sale` int(11) NOT NULL DEFAULT 0,
  `visit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `sku`, `item_name`, `state`, `discount`, `discount_setting`, `start_date`, `end_date`, `category`, `price`, `img`, `stock`, `sale`, `visit`) VALUES
(1, 'colours-1', 'Red', 'active', 5, '5', '2022-02-16', '2022-02-16', 'Colours', '120.00', 'images/1.png', 93, 3, 41),
(2, 'colours-2', 'Yellow', 'active', 0, '0', '', '', 'Colours', '39.95', 'images/2.png', 94, 3, 30),
(3, 'colours-3', 'Cyan', 'active', 0, '', '', '', 'Colours', '49.95', 'images/3.png', 86, 1, 47),
(4, 'colours-4', 'Purple', 'active', 0, '', '', '', 'uncategorised', '29.95', 'images/4.png', 97, 13, 24),
(5, 'colours-5', 'Green', 'active', 0, '', '', '', 'uncategorised', '59.95', 'images/5.png', 96, 14, 21),
(8, 'colours-6', 'Blue', 'active', 0, '', '', '', 'uncategorised', '14.00', 'images/1644853040.jpg', 100, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_04_105421_create_orders_table', 2),
(6, '2022_02_04_110507_create_items_table', 3),
(7, '2022_02_04_110507_create_item_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receive_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `order_date`, `order_items`, `order_total`, `address`, `receive_date`, `order_status`) VALUES
(1, 'test@test.com', '2022-01-06', 'a:2:{i:0;a:5:{s:9:\"item_name\";s:6:\"Yellow\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/2.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:5:\"39.95\";}i:1;a:5:{s:9:\"item_name\";s:4:\"Cyan\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:5:\"49.95\";}}', '89.9', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"100\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-01-13', 'Processing'),
(3, 'test@test.com', '2022-02-06', 'a:3:{i:0;a:5:{s:9:\"item_name\";s:6:\"Yellow\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/2.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:5:\"39.95\";}i:1;a:5:{s:9:\"item_name\";s:4:\"Cyan\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:5:\"49.95\";}i:2;a:5:{s:9:\"item_name\";s:3:\"Red\";s:8:\"quantity\";s:1:\"3\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:6:\"120.00\";}}', '449.9', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"100\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-13', 'Delivered'),
(4, 'darkliyznyanlin910@gmail.com', '2022-02-06', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:3:\"Red\";s:8:\"quantity\";s:1:\"8\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:2:\"97\";s:5:\"price\";s:6:\"120.00\";}}', '960', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"100\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-13', 'Delivered'),
(5, 'darkliyznyanlin910@gmail.com', '2022-02-06', 'a:2:{i:0;a:5:{s:9:\"item_name\";s:4:\"Cyan\";s:8:\"quantity\";s:1:\"2\";s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";s:2:\"99\";s:5:\"price\";s:5:\"49.95\";}i:1;a:5:{s:9:\"item_name\";s:6:\"Yellow\";s:8:\"quantity\";s:1:\"3\";s:3:\"img\";s:12:\"images/2.png\";s:5:\"stock\";s:2:\"99\";s:5:\"price\";s:5:\"39.95\";}}', '219.75', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"100\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-12', 'Processing'),
(6, 'admin@test.com', '2022-02-07', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:3:\"Red\";s:8:\"quantity\";s:1:\"3\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:3:\"103\";s:5:\"price\";s:6:\"120.00\";}}', '360', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"100\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-14', 'Out for Delivery'),
(7, 'hrif.ifan@gmail.com', '2022-02-10', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:6:\"Yellow\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/2.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:5:\"39.95\";}}', '39.95', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"100\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-17', 'Processing'),
(11, 'admin@test.com', '2022-02-11', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:6:\"Yellow\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/2.png\";s:5:\"stock\";s:2:\"99\";s:5:\"price\";s:5:\"39.95\";}}', '39.95', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"120\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-18', 'Processing'),
(12, 'admin@test.com', '2022-02-11', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:6:\"Purple\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/4.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:5:\"29.95\";}}', '29.95', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"120\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-18', 'Processing'),
(13, 'admin@test.com', '2022-02-11', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:4:\"Cyan\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";s:2:\"92\";s:5:\"price\";s:5:\"49.95\";}}', '49.95', 'a:4:{s:6:\"street\";s:4:\"test\";s:5:\"block\";s:3:\"123\";s:4:\"unit\";s:3:\"123\";s:11:\"postal_code\";s:5:\"45678\";}', '2022-02-18', 'Processing'),
(14, 'admin@test.com', '2022-02-11', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:3:\"Red\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:3:\"100\";s:5:\"price\";s:6:\"120.00\";}}', '120', 'a:4:{s:6:\"street\";s:6:\"123434\";s:5:\"block\";s:6:\"234234\";s:4:\"unit\";s:5:\"23423\";s:11:\"postal_code\";s:8:\"42342342\";}', '2022-02-18', 'Processing'),
(15, 'admin@test.com', '2022-02-12', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:6:\"Purple\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/4.png\";s:5:\"stock\";s:2:\"98\";s:5:\"price\";s:5:\"29.95\";}}', '29.95', 'a:4:{s:6:\"street\";s:4:\"test\";s:5:\"block\";s:3:\"123\";s:4:\"unit\";s:3:\"123\";s:11:\"postal_code\";s:5:\"45678\";}', '2022-02-19', 'Processing'),
(16, 'admin@test.com', '2022-02-12', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:3:\"Red\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:2:\"98\";s:5:\"price\";s:6:\"120.00\";}}', '120', 'a:4:{s:6:\"street\";s:8:\"ijklj;k;\";s:5:\"block\";s:5:\"ffhfi\";s:4:\"unit\";s:4:\"3578\";s:11:\"postal_code\";s:5:\"78905\";}', '2022-02-19', 'Processing'),
(17, 'test@test.com', '2022-02-12', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:3:\"Red\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:2:\"97\";s:5:\"price\";s:6:\"120.00\";}}', '120', 'a:4:{s:6:\"street\";s:21:\"New Upper Changi Road\";s:5:\"block\";s:2:\"88\";s:4:\"unit\";s:2:\"88\";s:11:\"postal_code\";s:6:\"182728\";}', '2022-02-19', 'Processing'),
(18, 'admin@test.com', '2022-02-14', 'a:1:{i:0;a:5:{s:9:\"item_name\";s:4:\"Cyan\";s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";s:2:\"90\";s:5:\"price\";s:5:\"49.95\";}}', '49.95', 'a:4:{s:6:\"street\";s:9:\"axsvdcsdv\";s:5:\"block\";s:5:\"SFDBS\";s:4:\"unit\";s:4:\"fBxb\";s:11:\"postal_code\";s:3:\"dfs\";}', '2022-02-21', 'Processing'),
(19, 'admin@test.com', '2022-02-15', 'a:2:{i:0;a:9:{s:2:\"id\";s:1:\"1\";s:9:\"item_name\";s:3:\"Red\";s:8:\"discount\";i:11;s:8:\"quantity\";s:1:\"3\";s:3:\"img\";s:12:\"images/1.png\";s:5:\"stock\";s:2:\"96\";s:5:\"price\";s:6:\"120.00\";s:5:\"saved\";d:13.2;s:10:\"item_total\";d:320.4;}i:1;a:9:{s:2:\"id\";s:1:\"2\";s:9:\"item_name\";s:6:\"Yellow\";s:8:\"discount\";i:5;s:8:\"quantity\";s:1:\"3\";s:3:\"img\";s:12:\"images/2.png\";s:5:\"stock\";s:2:\"97\";s:5:\"price\";s:5:\"39.95\";s:5:\"saved\";d:2;s:10:\"item_total\";d:113.85000000000001;}}', '479.85', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"120\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-02-22', 'Processing'),
(20, 'admin@test.com', '2022-02-16', 'a:1:{i:0;a:9:{s:2:\"id\";s:1:\"3\";s:9:\"item_name\";s:4:\"Cyan\";s:8:\"discount\";i:0;s:8:\"quantity\";i:2;s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";i:89;s:5:\"price\";s:5:\"49.95\";s:5:\"saved\";i:0;s:10:\"item_total\";d:99.9;}}', '99.9', 'a:4:{s:6:\"street\";s:7:\"testing\";s:5:\"block\";s:4:\"test\";s:4:\"unit\";s:4:\"test\";s:11:\"postal_code\";s:4:\"test\";}', '2022-02-23', 'Processing'),
(21, 'admin@test.com', '2022-03-08', 'a:1:{i:0;a:9:{s:2:\"id\";s:1:\"3\";s:9:\"item_name\";s:4:\"Cyan\";s:8:\"discount\";i:0;s:8:\"quantity\";s:1:\"1\";s:3:\"img\";s:12:\"images/3.png\";s:5:\"stock\";i:87;s:5:\"price\";s:5:\"49.95\";s:5:\"saved\";i:0;s:10:\"item_total\";d:49.95;}}', '49.95', 'a:4:{s:6:\"street\";s:8:\"Street 1\";s:5:\"block\";s:3:\"120\";s:4:\"unit\";s:3:\"100\";s:11:\"postal_code\";s:6:\"124120\";}', '2022-03-15', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Johnny', 'darkliyznyanlin910@gmail.com', NULL, 'admin', '$2y$10$oBDYSbnjf8Qtz9ZShC0lJ.xmo9Tmc6mWIPy/VZRth2k.mc0t4gEkq', NULL, '2022-02-03 20:36:47', '2022-02-03 20:36:47'),
(2, 'Test', 'test@test.com', NULL, 'user', '$2y$10$/xThoJky/4xqkMjItaviBO0jJdjPyu0GQcxznUrtK24ltc0TaR0m.', NULL, '2022-02-03 20:41:43', '2022-02-03 20:41:43'),
(3, 'Admin', 'admin@test.com', NULL, 'admin', '$2y$10$/KmNXRAHMsLlS0TPi1I3bu.XTzuV17JCfUaEpEFfohASs0XSp68Nq', '5HfNZSZ6IrrTMLCiGQpkbjkpv5vAr4FzSf5mblL6MZ9nOpn596j3qYvJ5N20', '2022-02-05 22:38:36', '2022-02-05 22:38:36'),
(4, 'weilin', 'weilin@weilin.com', NULL, 'user', '$2y$10$EEEXXxUsePma/El2XU/Ua.Jkh4NjdPFes8Nep7sVQa6fTE3DTZ7vS', NULL, '2022-02-07 23:03:24', '2022-02-07 23:03:24'),
(5, 'Harith', 'hrif.ifan@gmail.com', NULL, 'user', '$2y$10$KDEMzM5gJOXoqa5rG4FLKeZePdngN27.lJLWheIIAXknVVgW8MQxy', NULL, '2022-02-10 03:01:54', '2022-02-10 03:01:54'),
(6, 'Moon', 'Banmoonseng@gmail.com', NULL, 'user', '$2y$10$tgDaQbJnTGNRTO2XE8FF8uknINhc967mGy8jdmE5onzIh.Nvk0Pta', NULL, '2022-02-11 07:42:21', '2022-02-11 07:42:21'),
(7, 'Hein Htet Zaw', 'uheinhtetzaw@gmail.com', NULL, 'user', '$2y$10$FBR3KGlIsVmQUi7aVFHf3ulVn1q/KujUU9VCydjp7480/osyaY57q', NULL, '2022-02-14 08:03:13', '2022-02-14 08:03:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
