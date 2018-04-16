-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2017 at 03:08 AM
-- Server version: 5.7.10
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel5`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `accepted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, 1, 1, '2016-01-21 07:13:37', '2016-01-21 07:13:51'),
(3, 2, 3, 1, '2016-01-21 07:36:21', '2016-01-21 07:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `likeable`
--

CREATE TABLE `likeable` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likeable`
--

INSERT INTO `likeable` (`id`, `user_id`, `likeable_id`, `likeable_type`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'App\\Status', '2016-01-21 06:35:43', '2016-01-21 06:35:43'),
(2, 1, 3, 'App\\Status', '2016-01-21 06:36:29', '2016-01-21 06:36:29'),
(3, 3, 2, 'App\\Status', '2016-01-21 07:35:33', '2016-01-21 07:35:33'),
(4, 3, 3, 'App\\Status', '2016-01-21 07:37:24', '2016-01-21 07:37:24'),
(5, 1, 8, 'App\\Status', '2016-02-02 22:15:24', '2016-02-02 22:15:24'),
(6, 1, 5, 'App\\Status', '2016-02-02 22:15:34', '2016-02-02 22:15:34'),
(7, 2, 8, 'App\\Status', '2016-02-02 22:24:20', '2016-02-02 22:24:20'),
(8, 2, 12, 'App\\Status', '2016-02-02 22:24:24', '2016-02-02 22:24:24'),
(9, 2, 13, 'App\\Status', '2016-02-02 22:24:29', '2016-02-02 22:24:29'),
(10, 2, 11, 'App\\Status', '2016-02-02 22:24:42', '2016-02-02 22:24:42'),
(11, 2, 9, 'App\\Status', '2016-02-02 22:24:44', '2016-02-02 22:24:44'),
(12, 2, 10, 'App\\Status', '2016-02-02 22:24:49', '2016-02-02 22:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_08_031250_create_friends_table', 1),
('2015_12_09_003813_create_statuses_table', 1),
('2015_12_09_190353_create_likeable_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `user_id`, `parent_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'What\'s up?', '2016-01-21 06:20:14', '2016-01-21 06:20:14'),
(2, 1, 1, 'What?', '2016-01-21 06:20:43', '2016-01-21 06:20:43'),
(3, 2, NULL, 'I just arrived!', '2016-01-21 06:21:53', '2016-01-21 06:21:53'),
(4, 1, 1, 'hey?', '2016-01-21 06:27:15', '2016-01-21 06:27:15'),
(5, 2, 1, 'what up to?', '2016-01-21 06:27:48', '2016-01-21 06:27:48'),
(6, 2, 1, 'nothing.....', '2016-01-21 06:28:03', '2016-01-21 06:28:03'),
(7, 1, 1, 'ooops....', '2016-01-21 06:28:17', '2016-01-21 06:28:17'),
(8, 3, NULL, 'Salut!', '2016-01-21 07:13:18', '2016-01-21 07:13:18'),
(9, 1, 3, 'dfsdfdsf', '2016-02-02 22:16:45', '2016-02-02 22:16:45'),
(10, 1, 1, 'asdasdas', '2016-02-02 22:17:29', '2016-02-02 22:17:29'),
(11, 1, 8, 'fdgdfgdfg', '2016-02-02 22:17:35', '2016-02-02 22:17:35'),
(12, 1, NULL, 'dsfsfsdfsdf', '2016-02-02 22:17:47', '2016-02-02 22:17:47'),
(13, 1, 12, 'ddddd', '2016-02-02 22:17:55', '2016-02-02 22:17:55'),
(14, 2, NULL, 'wwwww', '2016-02-03 06:53:12', '2016-02-03 06:53:12'),
(15, 2, 14, 'pffff', '2016-02-03 06:53:20', '2016-02-03 06:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'victor_traian@yahoo.com', 'victor92', '$2y$10$7RYbwsySmUIRmDuKu16PvOYe9/VEI8cpSvmOaYDrgKjoeCIeQOs92', 'Traian', 'Alexandru', 'Toronto', 'uHr1xzbtFgtzTXh5pRMN4X8QFJauNcf6gAZdTLkRs4NnXUO9n9LZDgowCClT', '2016-01-21 06:18:49', '2017-12-12 02:29:53'),
(2, 'victortraian92@gmail.com', 'victortraian', '$2y$10$ccLMY8NjJT0JppIlWf4E/ulo4vfET/ytQOL/HbuWCTbE9p7cTAGhq', 'Alecs', 'Torres', 'Sao Paolo', 'k527XgoOvr0FElBaNNtnoOmKUOVFM4dxapZMch5RjNuzEf1KOpMZJYlcZFNI', '2016-01-21 06:21:32', '2016-02-02 22:50:23'),
(3, 'victor_train@hotmail.com', 'alex', '$2y$10$14csetOPWKkeMAA0QDrzUOi/87lNCPk7yB/N0E/fX2pfmVtUOPlxW', 'Victor', 'tra', 'Pitesti', NULL, '2016-01-21 07:12:28', '2016-01-21 07:13:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likeable`
--
ALTER TABLE `likeable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `likeable`
--
ALTER TABLE `likeable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
