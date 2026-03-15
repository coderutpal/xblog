-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2026 at 07:45 AM
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
-- Database: `xblog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL DEFAULT 1000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'Photoshop', 'photoshop', 1, 1, '2025-09-19 00:00:36', '2026-01-18 22:07:56'),
(2, 'Illustrator', 'illustrator', 1, 2, '2025-09-19 00:05:52', '2026-01-18 22:07:56'),
(3, 'Affinity', 'affinity', 1, 3, '2025-09-19 00:07:03', '2026-01-18 22:07:56'),
(4, 'CorelDraw', 'coreldraw', 1, 4, '2025-09-19 00:07:16', '2026-01-18 22:07:56'),
(6, 'CodeIgnator', 'codeignator', 3, 6, '2025-09-19 00:07:38', '2026-01-18 22:07:56'),
(7, 'CakePhp', 'cakephp', 3, 7, '2025-09-19 00:07:44', '2026-01-18 22:07:56'),
(8, 'VueJS', 'vuejs', 3, 8, '2025-09-19 00:08:12', '2026-01-18 22:07:56'),
(9, 'AngularJs', 'angularjs', 3, 10, '2025-09-19 00:08:29', '2026-01-18 22:07:56'),
(10, 'NextJs', 'nextjs', 3, 9, '2025-09-19 00:09:09', '2026-01-18 22:07:56'),
(11, 'ReactJs', 'reactjs', 3, 1000, '2025-09-19 00:09:34', '2025-09-19 00:09:34'),
(12, 'React Native', 'react-native', 2, 2, '2025-09-19 00:09:55', '2026-03-05 21:57:29'),
(13, 'Flutter', 'flutter', 2, 3, '2025-09-19 00:10:05', '2026-03-05 21:57:29'),
(14, 'MS Office', 'ms-office', 4, 4, '2025-09-19 00:10:23', '2026-03-05 21:57:29'),
(15, 'MatLab', 'matlab', 4, 5, '2025-09-19 00:10:57', '2026-03-05 21:57:29'),
(16, 'Aurduino', 'aurduino', 6, 6, '2025-09-19 00:11:17', '2026-03-05 21:57:29'),
(17, 'WordPress', 'wordpress', 3, 7, '2026-02-21 01:02:58', '2026-03-05 21:57:29'),
(18, 'Laravel', 'laravel', 3, 1, '2026-03-05 21:57:19', '2026-03-05 21:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `site_meta_keywords` varchar(255) DEFAULT NULL,
  `site_meta_description` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_footer_logo` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_email`, `site_phone`, `site_meta_keywords`, `site_meta_description`, `site_logo`, `site_footer_logo`, `site_favicon`, `created_at`, `updated_at`) VALUES
(1, 'Ushan Blog', 'admin@xblog.com', '0987654321', 'Laravel', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum oben.', 'site_logo_69b57ebd0833d.png', 'site_footer_logo_69b57ec98d454.png', 'site_favicon_69b5051fbfa94.png', NULL, '2026-03-14 09:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2025_07_02_223026_create_user_social_links_table', 1),
(21, '2025_07_04_063032_create_general_settings_table', 1),
(22, '2025_07_09_124120_create_parent_categories_table', 1),
(23, '2025_07_09_124159_create_categories_table', 1),
(24, '2025_09_03_013634_create_posts_table', 1),
(25, '2026_03_14_072351_add_footer_logo_to_general_settings_table', 2),
(26, '2026_03_14_075615_add_site_footer_logo_to_general_settings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `parent_categories`
--

CREATE TABLE `parent_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT 1000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_categories`
--

INSERT INTO `parent_categories` (`id`, `name`, `slug`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'Graphics Design', 'graphics-design', 1000, '2025-09-18 23:58:39', '2025-09-18 23:58:39'),
(2, 'App Development', 'app-development', 1000, '2025-09-18 23:58:52', '2025-09-18 23:58:52'),
(3, 'Web Development', 'web-development', 1000, '2025-09-18 23:59:06', '2025-09-18 23:59:06'),
(4, 'Computer Science', 'computer-science', 1000, '2025-09-18 23:59:36', '2025-09-18 23:59:36'),
(5, 'Data Analysis', 'data-analysis', 1000, '2025-09-18 23:59:49', '2025-09-18 23:59:49'),
(6, 'Embeded System', 'embeded-system', 1000, '2025-09-19 00:00:07', '2025-09-19 00:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category`, `title`, `slug`, `content`, `featured_image`, `tags`, `meta_keywords`, `meta_description`, `visibility`, `created_at`, `updated_at`) VALUES
(3, 4, 4, 'Laravel isterlo vonmei dserrt', 'laravel-isterlo-vonmei-dserrt', '<p>Hello bong song</p>', '696daf1583f03_Green Modern Discussion Topic Youtube Thumbnail.png', 'Heello, ksdhjkas,jksdfhsl', 'Laracvel, de, meta', 'nld,mkgndofi l,djs\'dfj sd;lfks esdf;asdljf ;\'sa', 1, '2026-01-18 22:12:10', '2026-01-18 22:12:10'),
(4, 4, 6, 'How to be a boss of Codignator', 'how-to-be-a-boss-of-codignator', '<p><strong>How to be a boss of Codignator&nbsp;</strong></p>', '69a8fcf75bdb7_install-wordpress-and-customize-wordpress-theme.jpg', 'Codignator', 'Boss of Codignator', 'Codignator', 0, '2026-01-18 22:15:39', '2026-03-04 21:48:07'),
(5, 4, 13, 'Flutter App development career', 'flutter-app-development-career', '<p>Updated</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/ufiles//Hacker.webp\" style=\"height:200px; width:300px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/ufiles//Web%20Development.jpg\" style=\"height:300px; width:533px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>updated</p>', '69a9029e95f40_PHP Web Developer  PHP Developer  PHP Expert  PHP Programmer  MySQL PHP.jpg', 'Flutter', 'Flutter App development career', 'Flutter App development career', 0, '2026-01-18 23:16:16', '2026-03-04 22:12:14'),
(6, 5, 17, 'Top 5  WordPress free theme for E-commerce Website', 'top-5-wordpress-free-theme-for-e-commerce-website', '<p><strong>Top 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5</strong></p>\r\n\r\n<p>&nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce WebsiteTop 5 &nbsp;WordPress free theme for E-commerce Website</p>', '699958800af7a_image-4.png', 'WordPress,Website', 'Top 5,  WordPress, ,theme, E-commerce, Website', 'Top 5  WordPress free theme for E-commerce WebsiteTop 5  WordPress free theme for E-commerce WebsiteTop 5  WordPress free theme for E-commerce WebsiteTop 5  WordPress free theme for E-commerce WebsiteTop 5  WordPress free theme for E-commerce WebsiteTop 5  WordPress free theme for E-commerce Website', 1, '2026-02-21 01:02:28', '2026-02-21 01:02:28'),
(7, 4, 4, 'CorelDraw Graphics Design Works', 'coreldraw-graphics-design-works', '<p>CorelDraw Graphics Design Meme posting</p>', '69a8fc84df15f_image-5.png', 'CorelDraw,Graphics', 'CorelDraw, Graphics, Design, Works,', 'CorelDraw Graphics Design WorksCorelDraw CorelDraw Graphics Design Works Graphics Design Works CorelDraw Graphics Design Works CorelDraw Graphics Design Works CorelDraw Graphics Design WorksCorelDraw Graphics Design WorksCorelDraw Graphics Design WorksCorelDraw Graphics Design WorksCorelDraw Graphics Design WorksCorelDraw Graphics Design WorksCorelDraw Graphics Design WorksCorelDraw Graphics Design Works', 1, '2026-03-04 21:38:27', '2026-03-04 21:46:13'),
(8, 4, 4, 'CorelDraw content Is moyeb Karl Mearn', 'coreldraw-content-is-moyeb-karl-mearn', '<p>CorelDraw content Is moyeb Karl</p>', '69a9024a9f729_Ramadan-Card-1441_2.jpg', 'Ajana, Kuyab', 'CorelDraw, content, Is, moyeb, Karl', 'CorelDraw content Is moyeb Karl', 1, '2026-03-04 21:38:42', '2026-03-04 22:17:30'),
(9, 4, 16, 'Aurdunio  lain Lase junioed', 'aurdunio-lain-lase-junioed', '<p>Aurdunio &nbsp;lain Lase junioed</p>', '69a901b9b8c30_shopping-bag-logo-design-shopping-bag-online-shop-sale-logo-design-template_852937-2388.jpg', 'Aurdunio', 'Aurdunio  lain Lase junioed', 'Aurdunio  lain Lase junioed', 1, '2026-03-04 22:06:48', '2026-03-04 22:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('A9VbnW16fgorNln0SplbXaukniUkJEKdQ7gKQhUe', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaUlMWVFZWXQ5YW5CWFpUWFZ0a2xWS1NkQ2VHOTJnUjhjT3ZLcGVHYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3NldHRpbmdzP3RhYj1nZW5lcmFsX3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9maWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1773502825),
('ALZbEPnmbJSvCfjf55t9wNumYehIgPY1csUHhsVf', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaDdPZjBtWnFRZ1JqTjJ3TDdTTjVWMGJkbktBb01FaVRsQ3dFMVBOdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1773427183),
('G0IxFVtI27pcDptScmwzrZkWrlz6mJ4XAEQR0QGp', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUjRRTmt2OGdWSWFLQkRSMk53ZHJmVDJMa1hKTENJall5c3M4STZhTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1772684253),
('hZu68ekkwuGLgPSfkpaAFPx4KPag7uS574DyraMh', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibmVUNWVQUEJjWkMydFg2bXE5c3RhV3J1Y2QyWllZMnNUU2pIUExVdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcG9zdHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1772769493),
('JW6Qa2w50yzoy8saWiTIosa6dM8eR296EnlXzbVP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlhFWEZUZFBFQmVQVWUxRjUxOUloc2NTU1pLOGRCWGhDS1hGZmRuSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1773460015),
('xl1VoqJQaqgFkciI6pzSP1q561oIYbe7uf672Ybb', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYXVkQUU1bXp2dGJlSFc5RzA4MUNWOGVCQTR4WlJEVHZMcGxDeklMYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1773392971),
('YKhSsPskCyLeOT2rjLWKdyosoUZPKHVqIeCOZmah', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMEFsVThBWWROUFJKRFlsenRhSjFka0phbXV4MUZQMjl1RGJlUWRtdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1773472237),
('yl6nyuLsePEnmIQTd2lFKcjW9KKnbVl0bR1X9QMy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZWdMM3hWckxVU1hJdU5HczlONFlTdnpTU0c1RGFaVEJVelpNSUNNTyI7czo0OiJmYWlsIjtzOjY5OiJZb3UgbXVzdCBiZSBsb2dnZWQgaW4gdG8gYWNjZXNzIGFkbWluIGFyZWEuIFBsZWFzZSBsb2dpbiB0byBjb250aW51ZS4iO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YToxOntpOjA7czo0OiJmYWlsIjt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXRlZ29yaWVzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXRlZ29yaWVzIjt9fQ==', 1773418340),
('Z9ZdofE5vuT1KqtAcq7vdO51T87NKaWUa3kWv6eJ', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaFVrYXZ6Z2NmaXVGR3ZzbGcwTEZWNXdkRldacVh3dVpXdTVVMmVmcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1773557080);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'admin',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `picture`, `bio`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Utpal [Supper Admin]', 'admin@xblog.com', 'admin', NULL, '$2y$12$AiiqZecTa665zAisrE.jO.27uMY/6HfbGjNhr/YJQCghTfvSLR/AC', 'IMG68cd0657b1fa0.png', NULL, 'supperAdmin', 'active', NULL, '2025-09-18 23:47:06', '2026-02-23 09:50:52'),
(5, 'Shiuly Rani', 'shiuly@xblog.com', 'shiuly', NULL, '$2y$12$AiiqZecTa665zAisrE.jO.27uMY/6HfbGjNhr/YJQCghTfvSLR/AC', '', NULL, 'admin', 'active', NULL, '2025-09-18 23:47:06', '2026-01-19 08:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_social_links`
--

CREATE TABLE `user_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_social_links`
--

INSERT INTO `user_social_links` (`id`, `user_id`, `facebook_url`, `instagram_url`, `youtube_url`, `linkedin_url`, `twitter_url`, `github_url`, `created_at`, `updated_at`) VALUES
(1, 3, 'https://www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 4, 'https://www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_categories`
--
ALTER TABLE `parent_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parent_categories_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_social_links`
--
ALTER TABLE `user_social_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_social_links_user_id_unique` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `parent_categories`
--
ALTER TABLE `parent_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_social_links`
--
ALTER TABLE `user_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
