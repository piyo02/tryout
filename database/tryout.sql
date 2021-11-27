-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 05:51 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tryout`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name`, `created_at`, `updated_at`, `variation_id`) VALUES
(1, 'Tes Pengetahuan Umum', '2021-11-22 22:40:43', '2021-11-22 22:40:43', 1),
(2, 'Tes Angka Hilang', '2021-11-23 06:43:44', '2021-11-23 06:43:44', 2),
(3, 'Tes Grup Angka Hilang', '2021-11-23 09:14:39', '2021-11-23 09:14:39', 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2021_11_12_133639_create_roles_table', 1),
(6, '2021_11_12_134409_add_role_id_to_users_table', 1),
(7, '2021_11_13_013551_create_tryouts_table', 1),
(8, '2021_11_13_013804_create_student_profile_table', 1),
(9, '2021_11_13_014209_create_collections_table', 1),
(10, '2021_11_13_014617_create_questions_table', 1),
(11, '2021_11_13_014807_create_options_table', 1),
(12, '2021_11_13_015006_create_worksheets_table', 1),
(13, '2021_11_13_015251_create_result_worksheets_table', 1),
(14, '2021_11_13_015420_create_student_answers_table', 1),
(15, '2021_11_14_174329_create_variations_table', 1),
(16, '2021_11_14_174739_add_variation_id_to_collections_table', 1),
(17, '2021_11_14_174937_add_variation_id_to_questions_table', 1),
(18, '2021_11_15_175547_add_collection_id_to_tryouts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` tinyint(4) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `value`, `skor`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, 2, '2021-11-23 06:45:09', '2021-11-23 06:45:09'),
(2, 'B', 0, 2, '2021-11-23 06:45:09', '2021-11-23 06:45:09'),
(3, 'C', 0, 2, '2021-11-23 06:45:09', '2021-11-23 06:45:09'),
(4, 'D', 0, 2, '2021-11-23 06:45:09', '2021-11-23 06:45:09'),
(5, 'E', 0, 2, '2021-11-23 06:45:09', '2021-11-23 06:45:09'),
(6, 'A', 0, 3, '2021-11-23 06:45:30', '2021-11-23 06:45:30'),
(7, 'B', 0, 3, '2021-11-23 06:45:30', '2021-11-23 06:45:30'),
(8, 'C', 1, 3, '2021-11-23 06:45:30', '2021-11-23 06:45:30'),
(9, 'D', 0, 3, '2021-11-23 06:45:30', '2021-11-23 06:45:30'),
(10, 'E', 0, 3, '2021-11-23 06:45:30', '2021-11-23 06:45:30'),
(11, 'A', 0, 4, '2021-11-23 06:45:47', '2021-11-23 06:45:47'),
(12, 'B', 0, 4, '2021-11-23 06:45:47', '2021-11-23 06:45:47'),
(13, 'C', 0, 4, '2021-11-23 06:45:47', '2021-11-23 06:45:47'),
(14, 'D', 1, 4, '2021-11-23 06:45:47', '2021-11-23 06:45:47'),
(15, 'E', 0, 4, '2021-11-23 06:45:47', '2021-11-23 06:45:47'),
(16, 'A', 1, 6, '2021-11-23 06:46:57', '2021-11-23 06:46:57'),
(17, 'B', 0, 6, '2021-11-23 06:46:57', '2021-11-23 06:46:57'),
(18, 'C', 0, 6, '2021-11-23 06:46:57', '2021-11-23 06:46:57'),
(19, 'D', 0, 6, '2021-11-23 06:46:57', '2021-11-23 06:46:57'),
(20, 'E', 0, 6, '2021-11-23 06:46:57', '2021-11-23 06:46:57'),
(21, 'A', 0, 7, '2021-11-23 06:47:15', '2021-11-23 06:47:15'),
(22, 'B', 1, 7, '2021-11-23 06:47:15', '2021-11-23 06:47:15'),
(23, 'C', 0, 7, '2021-11-23 06:47:15', '2021-11-23 06:47:15'),
(24, 'D', 0, 7, '2021-11-23 06:47:15', '2021-11-23 06:47:15'),
(25, 'E', 0, 7, '2021-11-23 06:47:15', '2021-11-23 06:47:15'),
(26, 'A', 0, 8, '2021-11-23 06:47:35', '2021-11-23 06:47:35'),
(27, 'B', 0, 8, '2021-11-23 06:47:35', '2021-11-23 06:47:35'),
(28, 'C', 0, 8, '2021-11-23 06:47:35', '2021-11-23 06:47:35'),
(29, 'D', 0, 8, '2021-11-23 06:47:35', '2021-11-23 06:47:35'),
(30, 'E', 1, 8, '2021-11-23 06:47:36', '2021-11-23 06:47:36'),
(31, 'A', 1, 11, '2021-11-23 09:15:52', '2021-11-23 09:15:52'),
(32, 'B', 0, 11, '2021-11-23 09:15:52', '2021-11-23 09:15:52'),
(33, 'C', 0, 11, '2021-11-23 09:15:52', '2021-11-23 09:15:52'),
(34, 'D', 0, 11, '2021-11-23 09:15:52', '2021-11-23 09:15:52'),
(35, 'E', 0, 11, '2021-11-23 09:15:52', '2021-11-23 09:15:52'),
(36, 'A', 0, 12, '2021-11-23 09:16:15', '2021-11-23 09:16:15'),
(37, 'B', 0, 12, '2021-11-23 09:16:16', '2021-11-23 09:16:16'),
(38, 'C', 1, 12, '2021-11-23 09:16:16', '2021-11-23 09:16:16'),
(39, 'D', 0, 12, '2021-11-23 09:16:16', '2021-11-23 09:16:16'),
(40, 'E', 0, 12, '2021-11-23 09:16:16', '2021-11-23 09:16:16'),
(41, 'A', 0, 13, '2021-11-23 09:16:36', '2021-11-23 09:16:36'),
(42, 'B', 0, 13, '2021-11-23 09:16:36', '2021-11-23 09:16:36'),
(43, 'C', 0, 13, '2021-11-23 09:16:36', '2021-11-23 09:16:36'),
(44, 'D', 0, 13, '2021-11-23 09:16:37', '2021-11-23 09:16:37'),
(45, 'E', 1, 13, '2021-11-23 09:16:37', '2021-11-23 09:16:37'),
(46, 'A', 1, 18, '2021-11-23 09:18:12', '2021-11-23 09:18:12'),
(47, 'B', 0, 18, '2021-11-23 09:18:13', '2021-11-23 09:18:13'),
(48, 'C', 0, 18, '2021-11-23 09:18:13', '2021-11-23 09:18:13'),
(49, 'D', 0, 18, '2021-11-23 09:18:13', '2021-11-23 09:18:13'),
(50, 'E', 0, 18, '2021-11-23 09:18:13', '2021-11-23 09:18:13'),
(51, 'A', 0, 19, '2021-11-23 09:18:35', '2021-11-23 09:18:35'),
(52, 'B', 0, 19, '2021-11-23 09:18:36', '2021-11-23 09:18:36'),
(53, 'C', 1, 19, '2021-11-23 09:18:36', '2021-11-23 09:18:36'),
(54, 'D', 0, 19, '2021-11-23 09:18:36', '2021-11-23 09:18:36'),
(55, 'E', 0, 19, '2021-11-23 09:18:36', '2021-11-23 09:18:36'),
(56, 'A', 0, 20, '2021-11-23 09:18:52', '2021-11-23 09:18:52'),
(57, 'B', 0, 20, '2021-11-23 09:18:53', '2021-11-23 09:18:53'),
(58, 'C', 0, 20, '2021-11-23 09:18:53', '2021-11-23 09:18:53'),
(59, 'D', 1, 20, '2021-11-23 09:18:53', '2021-11-23 09:18:53'),
(60, 'E', 0, 20, '2021-11-23 09:18:53', '2021-11-23 09:18:53'),
(61, 'A', 1, 21, '2021-11-23 09:19:16', '2021-11-23 09:19:16'),
(62, 'B', 0, 21, '2021-11-23 09:19:16', '2021-11-23 09:19:16'),
(63, 'C', 0, 21, '2021-11-23 09:19:16', '2021-11-23 09:19:16'),
(64, 'D', 0, 21, '2021-11-23 09:19:16', '2021-11-23 09:19:16'),
(65, 'E', 0, 21, '2021-11-23 09:19:16', '2021-11-23 09:19:16'),
(66, 'A', 0, 22, '2021-11-23 09:19:39', '2021-11-23 09:19:39'),
(67, 'B', 0, 22, '2021-11-23 09:19:39', '2021-11-23 09:19:39'),
(68, 'C', 0, 22, '2021-11-23 09:19:40', '2021-11-23 09:19:40'),
(69, 'D', 1, 22, '2021-11-23 09:19:40', '2021-11-23 09:19:40'),
(70, 'E', 0, 22, '2021-11-23 09:19:40', '2021-11-23 09:19:40'),
(71, 'A', 0, 23, '2021-11-23 09:20:26', '2021-11-23 09:20:35'),
(72, 'B', 0, 23, '2021-11-23 09:20:26', '2021-11-23 09:20:35'),
(73, 'C', 0, 23, '2021-11-23 09:20:26', '2021-11-23 09:20:35'),
(74, 'D', 0, 23, '2021-11-23 09:20:26', '2021-11-23 09:20:35'),
(75, 'E', 1, 23, '2021-11-23 09:20:26', '2021-11-23 09:20:36'),
(76, 'A', 0, 24, '2021-11-23 09:21:03', '2021-11-23 09:21:03'),
(77, 'B', 0, 24, '2021-11-23 09:21:03', '2021-11-23 09:21:03'),
(78, 'C', 1, 24, '2021-11-23 09:21:03', '2021-11-23 09:21:03'),
(79, 'D', 0, 24, '2021-11-23 09:21:03', '2021-11-23 09:21:03'),
(80, 'E', 0, 24, '2021-11-23 09:21:03', '2021-11-23 09:21:03'),
(81, 'A', 1, 25, '2021-11-23 09:21:30', '2021-11-23 09:21:30'),
(82, 'B', 0, 25, '2021-11-23 09:21:30', '2021-11-23 09:21:30'),
(83, 'C', 0, 25, '2021-11-23 09:21:30', '2021-11-23 09:21:30'),
(84, 'D', 0, 25, '2021-11-23 09:21:30', '2021-11-23 09:21:30'),
(85, 'E', 0, 25, '2021-11-23 09:21:30', '2021-11-23 09:21:30'),
(86, 'A', 0, 26, '2021-11-23 09:21:47', '2021-11-23 09:21:47'),
(87, 'B', 1, 26, '2021-11-23 09:21:48', '2021-11-23 09:21:48'),
(88, 'C', 0, 26, '2021-11-23 09:21:48', '2021-11-23 09:21:48'),
(89, 'D', 0, 26, '2021-11-23 09:21:48', '2021-11-23 09:21:48'),
(90, 'E', 0, 26, '2021-11-23 09:21:48', '2021-11-23 09:21:48'),
(91, 'A', 1, 27, '2021-11-23 09:22:21', '2021-11-23 09:22:21'),
(92, 'B', 0, 27, '2021-11-23 09:22:21', '2021-11-23 09:22:21'),
(93, 'C', 0, 27, '2021-11-23 09:22:21', '2021-11-23 09:22:21'),
(94, 'D', 0, 27, '2021-11-23 09:22:21', '2021-11-23 09:22:21'),
(95, 'E', 0, 27, '2021-11-23 09:22:22', '2021-11-23 09:22:22'),
(96, 'A', 0, 28, '2021-11-23 09:22:36', '2021-11-23 09:22:36'),
(97, 'B', 0, 28, '2021-11-23 09:22:36', '2021-11-23 09:22:36'),
(98, 'C', 0, 28, '2021-11-23 09:22:36', '2021-11-23 09:22:36'),
(99, 'D', 1, 28, '2021-11-23 09:22:36', '2021-11-23 09:22:36'),
(100, 'E', 0, 28, '2021-11-23 09:22:36', '2021-11-23 09:22:36'),
(101, 'A', 0, 29, '2021-11-23 09:23:06', '2021-11-23 09:23:06'),
(102, 'B', 0, 29, '2021-11-23 09:23:06', '2021-11-23 09:23:06'),
(103, 'C', 1, 29, '2021-11-23 09:23:06', '2021-11-23 09:23:06'),
(104, 'D', 0, 29, '2021-11-23 09:23:06', '2021-11-23 09:23:06'),
(105, 'E', 0, 29, '2021-11-23 09:23:06', '2021-11-23 09:23:06'),
(106, 'A', 1, 32, '2021-11-23 09:58:09', '2021-11-23 09:59:00'),
(107, 'B', 0, 32, '2021-11-23 09:58:09', '2021-11-23 09:59:00'),
(108, 'C', 0, 32, '2021-11-23 09:58:09', '2021-11-23 09:59:00'),
(109, 'D', 0, 32, '2021-11-23 09:58:09', '2021-11-23 09:59:00'),
(110, 'E', 0, 32, '2021-11-23 09:58:09', '2021-11-23 09:59:00'),
(111, 'A', 1, 33, '2021-11-23 09:58:25', '2021-11-23 09:58:50'),
(112, 'B', 0, 33, '2021-11-23 09:58:25', '2021-11-23 09:58:50'),
(113, 'C', 0, 33, '2021-11-23 09:58:25', '2021-11-23 09:58:50'),
(114, 'D', 0, 33, '2021-11-23 09:58:25', '2021-11-23 09:58:50'),
(115, 'E', 0, 33, '2021-11-23 09:58:25', '2021-11-23 09:58:50'),
(121, 'A', 0, 35, '2021-11-23 09:59:21', '2021-11-23 09:59:21'),
(122, 'B', 0, 35, '2021-11-23 09:59:21', '2021-11-23 09:59:21'),
(123, 'C', 1, 35, '2021-11-23 09:59:21', '2021-11-23 09:59:21'),
(124, 'D', 0, 35, '2021-11-23 09:59:21', '2021-11-23 09:59:21'),
(125, 'E', 0, 35, '2021-11-23 09:59:21', '2021-11-23 09:59:21'),
(126, 'A', 0, 37, '2021-11-23 10:00:11', '2021-11-23 10:00:11'),
(127, 'B', 1, 37, '2021-11-23 10:00:11', '2021-11-23 10:00:11'),
(128, 'C', 0, 37, '2021-11-23 10:00:11', '2021-11-23 10:00:11'),
(129, 'D', 0, 37, '2021-11-23 10:00:11', '2021-11-23 10:00:11'),
(130, 'E', 0, 37, '2021-11-23 10:00:11', '2021-11-23 10:00:11'),
(131, 'A', 0, 38, '2021-11-23 10:00:36', '2021-11-23 10:00:36'),
(132, 'B', 0, 38, '2021-11-23 10:00:36', '2021-11-23 10:00:36'),
(133, 'C', 0, 38, '2021-11-23 10:00:36', '2021-11-23 10:00:36'),
(134, 'D', 0, 38, '2021-11-23 10:00:36', '2021-11-23 10:00:36'),
(135, 'E', 1, 38, '2021-11-23 10:00:36', '2021-11-23 10:00:36'),
(136, 'A', 0, 39, '2021-11-23 10:00:56', '2021-11-23 10:00:56'),
(137, 'B', 0, 39, '2021-11-23 10:00:56', '2021-11-23 10:00:56'),
(138, 'C', 0, 39, '2021-11-23 10:00:56', '2021-11-23 10:00:56'),
(139, 'D', 0, 39, '2021-11-23 10:00:56', '2021-11-23 10:00:56'),
(140, 'E', 1, 39, '2021-11-23 10:00:56', '2021-11-23 10:00:56'),
(141, 'A', 0, 41, '2021-11-23 10:01:41', '2021-11-23 10:01:41'),
(142, 'B', 1, 41, '2021-11-23 10:01:41', '2021-11-23 10:01:41'),
(143, 'C', 0, 41, '2021-11-23 10:01:41', '2021-11-23 10:01:41'),
(144, 'D', 0, 41, '2021-11-23 10:01:41', '2021-11-23 10:01:41'),
(145, 'E', 0, 41, '2021-11-23 10:01:41', '2021-11-23 10:01:41'),
(146, 'A', 0, 42, '2021-11-23 10:01:58', '2021-11-23 10:01:58'),
(147, 'B', 1, 42, '2021-11-23 10:01:58', '2021-11-23 10:01:58'),
(148, 'C', 0, 42, '2021-11-23 10:01:58', '2021-11-23 10:01:58'),
(149, 'D', 0, 42, '2021-11-23 10:01:58', '2021-11-23 10:01:58'),
(150, 'E', 0, 42, '2021-11-23 10:01:58', '2021-11-23 10:01:58'),
(151, 'A', 1, 43, '2021-11-23 10:02:16', '2021-11-23 10:02:16'),
(152, 'B', 0, 43, '2021-11-23 10:02:16', '2021-11-23 10:02:16'),
(153, 'C', 0, 43, '2021-11-23 10:02:16', '2021-11-23 10:02:16'),
(154, 'D', 0, 43, '2021-11-23 10:02:16', '2021-11-23 10:02:16'),
(155, 'E', 0, 43, '2021-11-23 10:02:16', '2021-11-23 10:02:16'),
(156, 'A', 0, 46, '2021-11-23 10:03:12', '2021-11-23 10:03:12'),
(157, 'B', 0, 46, '2021-11-23 10:03:12', '2021-11-23 10:03:12'),
(158, 'C', 1, 46, '2021-11-23 10:03:12', '2021-11-23 10:03:12'),
(159, 'D', 0, 46, '2021-11-23 10:03:12', '2021-11-23 10:03:12'),
(160, 'E', 0, 46, '2021-11-23 10:03:12', '2021-11-23 10:03:12'),
(161, 'A', 0, 47, '2021-11-23 10:03:27', '2021-11-23 10:03:27'),
(162, 'B', 0, 47, '2021-11-23 10:03:27', '2021-11-23 10:03:27'),
(163, 'C', 0, 47, '2021-11-23 10:03:27', '2021-11-23 10:03:27'),
(164, 'D', 0, 47, '2021-11-23 10:03:27', '2021-11-23 10:03:27'),
(165, 'E', 1, 47, '2021-11-23 10:03:27', '2021-11-23 10:03:27'),
(166, 'A', 1, 48, '2021-11-23 10:03:37', '2021-11-23 10:03:37'),
(167, 'B', 0, 48, '2021-11-23 10:03:37', '2021-11-23 10:03:37'),
(168, 'C', 0, 48, '2021-11-23 10:03:37', '2021-11-23 10:03:37'),
(169, 'D', 0, 48, '2021-11-23 10:03:37', '2021-11-23 10:03:37'),
(170, 'E', 0, 48, '2021-11-23 10:03:37', '2021-11-23 10:03:37'),
(171, 'A', 1, 49, '2021-11-23 10:03:54', '2021-11-23 10:03:54'),
(172, 'B', 0, 49, '2021-11-23 10:03:54', '2021-11-23 10:03:54'),
(173, 'C', 0, 49, '2021-11-23 10:03:54', '2021-11-23 10:03:54'),
(174, 'D', 0, 49, '2021-11-23 10:03:54', '2021-11-23 10:03:54'),
(175, 'E', 0, 49, '2021-11-23 10:03:54', '2021-11-23 10:03:54'),
(176, 'A', 0, 50, '2021-11-23 10:04:11', '2021-11-23 10:04:11'),
(177, 'B', 0, 50, '2021-11-23 10:04:11', '2021-11-23 10:04:11'),
(178, 'C', 0, 50, '2021-11-23 10:04:11', '2021-11-23 10:04:11'),
(179, 'D', 1, 50, '2021-11-23 10:04:11', '2021-11-23 10:04:11'),
(180, 'E', 0, 50, '2021-11-23 10:04:11', '2021-11-23 10:04:11'),
(181, 'A', 0, 51, '2021-11-23 10:04:22', '2021-11-23 10:04:22'),
(182, 'B', 0, 51, '2021-11-23 10:04:22', '2021-11-23 10:04:22'),
(183, 'C', 1, 51, '2021-11-23 10:04:22', '2021-11-23 10:04:22'),
(184, 'D', 0, 51, '2021-11-23 10:04:22', '2021-11-23 10:04:22'),
(185, 'E', 0, 51, '2021-11-23 10:04:22', '2021-11-23 10:04:22'),
(186, 'AA', 0, 52, '2021-11-23 10:05:54', '2021-11-23 10:05:54'),
(187, 'BB', 1, 52, '2021-11-23 10:05:54', '2021-11-23 10:05:54'),
(188, 'CC', 0, 52, '2021-11-23 10:05:54', '2021-11-23 10:05:54'),
(189, 'DD', 0, 52, '2021-11-23 10:05:54', '2021-11-23 10:05:54'),
(190, 'EE', 0, 52, '2021-11-23 10:05:55', '2021-11-23 10:05:55'),
(191, 'AA', 0, 53, '2021-11-23 10:06:20', '2021-11-23 10:06:20'),
(192, 'BB', 1, 53, '2021-11-23 10:06:20', '2021-11-23 10:06:20'),
(193, 'CC', 0, 53, '2021-11-23 10:06:20', '2021-11-23 10:06:20'),
(194, 'DD', 0, 53, '2021-11-23 10:06:20', '2021-11-23 10:06:20'),
(195, 'E', 0, 53, '2021-11-23 10:06:20', '2021-11-23 10:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `value`, `parent_id`, `collection_id`, `created_by`, `status`, `created_at`, `updated_at`, `variation_id`) VALUES
(1, 'public/uploads/questions/soal-21637649865.html', NULL, 2, 1, 1, '2021-11-23 06:44:26', '2021-11-23 06:44:38', 5),
(2, 'public/uploads/questions/soal-21637649908.html', 1, 2, 1, 1, '2021-11-23 06:45:08', '2021-11-23 06:45:08', 5),
(3, 'public/uploads/questions/soal-21637649930.html', 1, 2, 1, 1, '2021-11-23 06:45:30', '2021-11-23 06:45:30', 5),
(4, 'public/uploads/questions/soal-21637649947.html', 1, 2, 1, 1, '2021-11-23 06:45:47', '2021-11-23 06:45:47', 5),
(5, 'public/uploads/questions/soal-21637649980.html', NULL, 2, 1, 1, '2021-11-23 06:46:20', '2021-11-23 06:46:20', 4),
(6, 'public/uploads/questions/soal-21637650017.html', 5, 2, 1, 1, '2021-11-23 06:46:57', '2021-11-23 06:46:57', 4),
(7, 'public/uploads/questions/soal-21637650034.html', 5, 2, 1, 1, '2021-11-23 06:47:14', '2021-11-23 06:47:14', 4),
(8, 'public/uploads/questions/soal-21637650055.html', 5, 2, 1, 1, '2021-11-23 06:47:35', '2021-11-23 06:47:35', 4),
(9, 'public/uploads/questions/soal-31637658893.html', NULL, 3, 1, 1, '2021-11-23 09:14:53', '2021-11-23 09:14:53', 4),
(10, 'public/uploads/questions/soal-31637658931.html', 9, 3, 1, 1, '2021-11-23 09:15:31', '2021-11-23 09:15:31', 4),
(11, 'public/uploads/questions/soal-31637658951.html', 10, 3, 1, 1, '2021-11-23 09:15:52', '2021-11-23 09:15:52', 4),
(12, 'public/uploads/questions/soal-31637658975.html', 10, 3, 1, 1, '2021-11-23 09:16:15', '2021-11-23 09:16:15', 4),
(13, 'public/uploads/questions/soal-31637658996.html', 10, 3, 1, 1, '2021-11-23 09:16:36', '2021-11-23 09:16:36', 4),
(14, 'public/uploads/questions/soal-31637659024.html', 9, 3, 1, 1, '2021-11-23 09:17:04', '2021-11-23 09:17:04', 4),
(15, 'public/uploads/questions/soal-31637659038.html', 9, 3, 1, 1, '2021-11-23 09:17:18', '2021-11-23 09:17:18', 4),
(16, 'public/uploads/questions/soal-31637659051.html', 9, 3, 1, 1, '2021-11-23 09:17:31', '2021-11-23 09:17:51', 4),
(17, 'public/uploads/questions/soal-31637659063.html', 9, 3, 1, 1, '2021-11-23 09:17:43', '2021-11-23 09:17:43', 4),
(18, 'public/uploads/questions/soal-31637659092.html', 17, 3, 1, 1, '2021-11-23 09:18:12', '2021-11-23 09:18:12', 4),
(19, 'public/uploads/questions/soal-31637659115.html', 17, 3, 1, 1, '2021-11-23 09:18:35', '2021-11-23 09:18:35', 4),
(20, 'public/uploads/questions/soal-31637659132.html', 17, 3, 1, 1, '2021-11-23 09:18:52', '2021-11-23 09:18:52', 4),
(21, 'public/uploads/questions/soal-31637659156.html', 16, 3, 1, 1, '2021-11-23 09:19:16', '2021-11-23 09:19:16', 4),
(22, 'public/uploads/questions/soal-31637659179.html', 16, 3, 1, 1, '2021-11-23 09:19:39', '2021-11-23 09:19:39', 4),
(23, 'public/uploads/questions/soal-31637659226.html', 16, 3, 1, 1, '2021-11-23 09:20:26', '2021-11-23 09:20:35', 4),
(24, 'public/uploads/questions/soal-31637659263.html', 15, 3, 1, 1, '2021-11-23 09:21:03', '2021-11-23 09:21:03', 4),
(25, 'public/uploads/questions/soal-31637659289.html', 15, 3, 1, 1, '2021-11-23 09:21:30', '2021-11-23 09:21:30', 4),
(26, 'public/uploads/questions/soal-31637659307.html', 15, 3, 1, 1, '2021-11-23 09:21:47', '2021-11-23 09:21:47', 4),
(27, 'public/uploads/questions/soal-31637659341.html', 14, 3, 1, 1, '2021-11-23 09:22:21', '2021-11-23 09:22:21', 4),
(28, 'public/uploads/questions/soal-31637659356.html', 14, 3, 1, 1, '2021-11-23 09:22:36', '2021-11-23 09:22:36', 4),
(29, 'public/uploads/questions/soal-31637659386.html', 14, 3, 1, 1, '2021-11-23 09:23:06', '2021-11-23 09:23:06', 4),
(30, 'public/uploads/questions/soal-31637660279.html', NULL, 3, 1, 1, '2021-11-23 09:37:59', '2021-11-23 09:58:37', 6),
(31, 'public/uploads/questions/soal-31637660317.html', 30, 3, 1, 1, '2021-11-23 09:38:37', '2021-11-23 09:38:37', 4),
(32, 'public/uploads/questions/soal-31637661489.html', 31, 3, 1, 1, '2021-11-23 09:58:09', '2021-11-23 09:59:00', 6),
(33, 'public/uploads/questions/soal-31637661505.html', 31, 3, 1, 1, '2021-11-23 09:58:25', '2021-11-23 09:58:50', 6),
(35, 'public/uploads/questions/soal-31637661561.html', 31, 3, 1, 1, '2021-11-23 09:59:21', '2021-11-23 09:59:21', 6),
(36, 'public/uploads/questions/soal-31637661591.html', 30, 3, 1, 1, '2021-11-23 09:59:51', '2021-11-23 09:59:51', 6),
(37, 'public/uploads/questions/soal-31637661611.html', 36, 3, 1, 1, '2021-11-23 10:00:11', '2021-11-23 10:00:11', 6),
(38, 'public/uploads/questions/soal-31637661636.html', 36, 3, 1, 1, '2021-11-23 10:00:36', '2021-11-23 10:00:36', 6),
(39, 'public/uploads/questions/soal-31637661656.html', 36, 3, 1, 1, '2021-11-23 10:00:56', '2021-11-23 10:00:56', 6),
(40, 'public/uploads/questions/soal-31637661683.html', 30, 3, 1, 1, '2021-11-23 10:01:23', '2021-11-23 10:01:23', 5),
(41, 'public/uploads/questions/soal-31637661701.html', 40, 3, 1, 1, '2021-11-23 10:01:41', '2021-11-23 10:01:41', 4),
(42, 'public/uploads/questions/soal-31637661718.html', 40, 3, 1, 1, '2021-11-23 10:01:58', '2021-11-23 10:01:58', 5),
(43, 'public/uploads/questions/soal-31637661736.html', 40, 3, 1, 1, '2021-11-23 10:02:16', '2021-11-23 10:02:16', 5),
(44, 'public/uploads/questions/soal-31637661762.html', 30, 3, 1, 1, '2021-11-23 10:02:42', '2021-11-23 10:02:42', 4),
(45, 'public/uploads/questions/soal-31637661776.html', 30, 3, 1, 1, '2021-11-23 10:02:56', '2021-11-23 10:02:56', 4),
(46, 'public/uploads/questions/soal-31637661791.html', 44, 3, 1, 1, '2021-11-23 10:03:11', '2021-11-23 10:03:11', 4),
(47, 'public/uploads/questions/soal-31637661806.html', 44, 3, 1, 1, '2021-11-23 10:03:27', '2021-11-23 10:03:27', 4),
(48, 'public/uploads/questions/soal-31637661817.html', 44, 3, 1, 1, '2021-11-23 10:03:37', '2021-11-23 10:03:37', 4),
(49, 'public/uploads/questions/soal-31637661834.html', 45, 3, 1, 1, '2021-11-23 10:03:54', '2021-11-23 10:03:54', 4),
(50, 'public/uploads/questions/soal-31637661851.html', 45, 3, 1, 1, '2021-11-23 10:04:11', '2021-11-23 10:04:11', 4),
(51, 'public/uploads/questions/soal-31637661862.html', 45, 3, 1, 1, '2021-11-23 10:04:22', '2021-11-23 10:04:22', 4),
(52, 'public/uploads/questions/soal-11637661954.html', NULL, 1, 1, 1, '2021-11-23 10:05:54', '2021-11-23 10:05:54', 5),
(53, 'public/uploads/questions/soal-11637661979.html', NULL, 1, 1, 1, '2021-11-23 10:06:20', '2021-11-23 10:06:20', 4);

-- --------------------------------------------------------

--
-- Table structure for table `result_worksheets`
--

CREATE TABLE `result_worksheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skor` tinyint(4) NOT NULL,
  `question_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` tinyint(4) NOT NULL,
  `wrong` tinyint(4) NOT NULL,
  `worksheet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `result_worksheets`
--

INSERT INTO `result_worksheets` (`id`, `skor`, `question_type`, `correct`, `wrong`, `worksheet_id`, `created_at`, `updated_at`) VALUES
(1, 0, 'Kecepatan', 0, 1, 2, '2021-11-23 10:08:33', '2021-11-23 10:08:33'),
(2, 1, 'Ketelitian', 1, 0, 2, '2021-11-23 10:08:33', '2021-11-23 10:08:33'),
(3, 1, 'Kecepatan', 1, 2, 8, '2021-11-23 10:42:54', '2021-11-23 10:42:54'),
(4, 3, 'Ketelitian', 3, 0, 8, '2021-11-23 10:42:54', '2021-11-23 10:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'role admin', '2021-11-22 22:40:42', '2021-11-22 22:40:42'),
(2, 'User Admin', 'uadmin', 'role uadmin', '2021-11-22 22:40:42', '2021-11-22 22:40:42'),
(3, 'Mentor', 'mentor', 'role mentor', '2021-11-22 22:40:42', '2021-11-22 22:40:42'),
(4, 'Siswa', 'student', 'role student', '2021-11-22 22:40:42', '2021-11-22 22:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worksheet_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skor` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`id`, `worksheet_id`, `question_id`, `option_id`, `skor`, `created_at`, `updated_at`) VALUES
(9, 2, 52, 187, 1, '2021-11-23 10:07:25', '2021-11-23 10:07:32'),
(10, 2, 53, 193, 0, '2021-11-23 10:07:25', '2021-11-23 10:07:45'),
(25, 8, 2, 1, 1, '2021-11-23 10:41:57', '2021-11-23 10:42:33'),
(26, 8, 3, 8, 1, '2021-11-23 10:41:57', '2021-11-23 10:42:35'),
(27, 8, 4, 14, 1, '2021-11-23 10:41:57', '2021-11-23 10:42:37'),
(28, 8, 6, 17, 0, '2021-11-23 10:41:57', '2021-11-23 10:42:38'),
(29, 8, 7, 25, 0, '2021-11-23 10:41:57', '2021-11-23 10:42:39'),
(30, 8, 8, 30, 1, '2021-11-23 10:41:57', '2021-11-23 10:42:42'),
(37, 13, 10, NULL, 0, '2021-11-23 16:49:54', '2021-11-23 16:49:54'),
(38, 13, 11, NULL, 0, '2021-11-23 16:49:54', '2021-11-23 16:49:54'),
(39, 13, 12, NULL, 0, '2021-11-23 16:49:54', '2021-11-23 16:49:54'),
(40, 13, 13, NULL, 0, '2021-11-23 16:49:54', '2021-11-23 16:49:54'),
(41, 13, 14, NULL, 0, '2021-11-23 16:49:54', '2021-11-23 16:49:54'),
(42, 13, 15, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(43, 13, 16, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(44, 13, 17, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(45, 13, 18, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(46, 13, 19, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(47, 13, 20, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(48, 13, 21, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(49, 13, 22, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(50, 13, 23, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(51, 13, 24, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(52, 13, 25, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(53, 13, 26, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(54, 13, 27, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(55, 13, 28, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(56, 13, 29, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(57, 13, 31, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(58, 13, 32, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(59, 13, 33, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(60, 13, 35, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(61, 13, 36, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(62, 13, 37, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(63, 13, 38, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(64, 13, 39, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(65, 13, 40, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(66, 13, 41, NULL, 0, '2021-11-23 16:49:55', '2021-11-23 16:49:55'),
(67, 13, 42, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(68, 13, 43, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(69, 13, 44, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(70, 13, 45, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(71, 13, 46, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(72, 13, 47, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(73, 13, 48, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(74, 13, 49, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(75, 13, 50, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56'),
(76, 13, 51, NULL, 0, '2021-11-23 16:49:56', '2021-11-23 16:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_profiles`
--

INSERT INTO `student_profiles` (`id`, `address`, `phone`, `birthday`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'BTN GRAHA MANDIRI PERMAI BLOK K/7', '081232578168', 'Kendari, 03-01-2000', 4, '2021-11-22 22:40:43', '2021-11-22 22:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `tryouts`
--

CREATE TABLE `tryouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryouts`
--

INSERT INTO `tryouts` (`id`, `token`, `date`, `time`, `status`, `created_at`, `updated_at`, `collection_id`) VALUES
(1, 'TLYTP', '2021-11-23', 5, 0, '2021-11-23 06:47:58', '2021-11-23 06:47:58', 2),
(2, '7AUHF', '2021-11-24', 5, 0, '2021-11-24 09:25:20', '2021-11-23 09:25:20', 3),
(3, 'MABAG', '2021-11-23', 5, 0, '2021-11-23 10:05:05', '2021-11-23 10:05:05', 2),
(4, 'AG9LA', '2021-11-23', 10, 0, '2021-11-23 10:06:34', '2021-11-23 10:06:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/users/user.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$vucdf6sGc4ltTg4qRPUoNO4ek6fLlitDBa7dqcUv65Gtl5UEnbTH2', 'images/users/user.jpg', NULL, '2021-11-22 22:40:42', '2021-11-22 22:40:42', 1),
(2, 'Administrator', 'uadmin@gmail.com', NULL, '$2y$10$5bNlr1T/Zo6KBEjj7d3.gOGNrkSVfZMluVzU4HBteceyQL5jnazMO', 'images/users/user.jpg', NULL, '2021-11-22 22:40:42', '2021-11-22 22:40:42', 2),
(3, 'Mentor', 'mentor@gmail.com', NULL, '$2y$10$HV6fbxAJmeelle7sxiJKJ.CYvsYFSCnkUibMdKITJj.36gVRSyhHm', 'images/users/user.jpg', NULL, '2021-11-22 22:40:43', '2021-11-22 22:40:43', 3),
(4, 'Siswa', 'student@gmail.com', NULL, '$2y$10$eipVCc/bwwqePYVnT2P/ROhhkK9HPVqZkZ1CyAKiv5GasFs/oQZYe', 'images/users/user.jpg', NULL, '2021-11-22 22:40:43', '2021-11-22 22:40:43', 4);

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `about`, `value`, `created_at`, `updated_at`) VALUES
(1, 'collection', 'Soal Biasa', '2021-11-22 22:40:43', '2021-11-22 22:40:43'),
(2, 'collection', 'Soal Kolom', '2021-11-22 22:40:43', '2021-11-22 22:40:43'),
(3, 'collection', 'Soal Kolom Group', '2021-11-22 22:40:43', '2021-11-22 22:40:43'),
(4, 'question', 'Kecepatan', '2021-11-22 22:40:44', '2021-11-22 22:40:44'),
(5, 'question', 'Ketelitian', '2021-11-22 22:40:44', '2021-11-22 22:40:44'),
(6, 'question', 'Ketahanan', '2021-11-22 22:40:44', '2021-11-22 22:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `worksheets`
--

CREATE TABLE `worksheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tryout_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `total_skor` tinyint(4) NOT NULL,
  `final_value` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worksheets`
--

INSERT INTO `worksheets` (`id`, `user_id`, `tryout_id`, `start_date`, `end_date`, `status`, `total_skor`, `final_value`, `created_at`, `updated_at`) VALUES
(2, 4, 4, '2021-11-23 18:07:25', '2021-11-23 18:17:25', 1, 1, 1, '2021-11-23 10:07:25', '2021-11-23 10:08:34'),
(8, 4, 1, '2021-11-23 18:41:57', '2021-11-23 18:46:57', 1, 4, 4, '2021-11-23 10:41:57', '2021-11-23 10:42:54'),
(13, 4, 2, '2021-11-24 00:49:54', '2021-11-24 00:54:54', 0, 0, 0, '2021-11-23 16:49:54', '2021-11-23 16:49:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collections_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_collection_id_foreign` (`collection_id`),
  ADD KEY `questions_created_by_foreign` (`created_by`),
  ADD KEY `questions_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `result_worksheets`
--
ALTER TABLE `result_worksheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `result_worksheets_worksheet_id_foreign` (`worksheet_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_answers_worksheet_id_foreign` (`worksheet_id`),
  ADD KEY `student_answers_question_id_foreign` (`question_id`),
  ADD KEY `student_answers_option_id_foreign` (`option_id`);

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `tryouts`
--
ALTER TABLE `tryouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tryouts_collection_id_foreign` (`collection_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worksheets`
--
ALTER TABLE `worksheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worksheets_user_id_foreign` (`user_id`),
  ADD KEY `worksheets_tryout_id_foreign` (`tryout_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `result_worksheets`
--
ALTER TABLE `result_worksheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tryouts`
--
ALTER TABLE `tryouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `worksheets`
--
ALTER TABLE `worksheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`),
  ADD CONSTRAINT `questions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `questions_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);

--
-- Constraints for table `result_worksheets`
--
ALTER TABLE `result_worksheets`
  ADD CONSTRAINT `result_worksheets_worksheet_id_foreign` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`);

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `student_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `student_answers_worksheet_id_foreign` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`);

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `student_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tryouts`
--
ALTER TABLE `tryouts`
  ADD CONSTRAINT `tryouts_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `worksheets`
--
ALTER TABLE `worksheets`
  ADD CONSTRAINT `worksheets_tryout_id_foreign` FOREIGN KEY (`tryout_id`) REFERENCES `tryouts` (`id`),
  ADD CONSTRAINT `worksheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
