-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 11:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` tinyint(1) NOT NULL DEFAULT 0,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `created_at`, `updated_at`) VALUES
(9, 'Digital Marketing', 'digital-marketing', 'upload/category/1765070912534433.jpg', NULL, NULL),
(10, 'Graphics & Design', 'graphics-&-design', 'upload/category/1765071262500460.jpg', NULL, NULL),
(11, 'Writing & Translation', 'writing-&-translation', 'upload/category/1765071950614932.jpg', NULL, NULL),
(12, 'Video & Animation', 'video-&-animation', 'upload/category/1765072117374253.jpg', NULL, NULL),
(13, 'Music &    Audio', 'music-&----audio', 'upload/category/1765072378614137.jpg', NULL, '2023-05-05 13:38:14'),
(14, 'Programming & Tech', 'programming-&-tech', 'upload/category/1765072573361812.jpg', NULL, NULL),
(15, 'Sign language', 'sign-language', 'upload/category/1765072800767735.jpg', NULL, NULL),
(16, 'Business & Sales', 'business-&-sales', 'upload/category/1765532603592290.jpg', NULL, '2023-05-10 16:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_01_214511_create_categories_table', 2),
(6, '2023_04_05_012541_create_sub_categories_table', 3),
(7, '2023_04_17_203611_create_products_table', 4),
(8, '2023_04_17_205310_create_multi_imgs_table', 4),
(9, '2023_04_18_231535_create_sliders_table', 5),
(10, '2023_04_25_181156_create_carts_table', 6),
(11, '2023_04_25_191710_create_orders_table', 7),
(12, '2023_04_25_191942_create_order_items_table', 8),
(13, '2023_04_25_202250_create_reply_messages_table', 9),
(14, '2023_04_25_203048_create_contacts_table', 10),
(15, '2023_04_25_205048_create_reply_messages_table', 11),
(16, '2023_04_25_211455_create_reviews_table', 12),
(17, '2023_05_04_134414_add_vendor_id_to_orders_table', 13),
(18, '2023_05_04_185505_add_vendor_id_to_order_items_table', 14),
(19, '2023_05_07_113635_add_admin_id_to_order_items_table', 15),
(20, '2023_05_07_113747_add_admin_id_to_orders_table', 15),
(21, '2023_05_07_114838_add_admin_id_to_carts_table', 16),
(22, '2023_05_07_114852_add_vendor_id_to_carts_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `multi_imgs`
--

CREATE TABLE `multi_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_imgs`
--

INSERT INTO `multi_imgs` (`id`, `product_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(15, 9, 'upload/products/multi-img/1765147420853726.jpg', '2023-05-06 09:22:39', NULL),
(16, 9, 'upload/products/multi-img/1765147420863327.jpg', '2023-05-06 09:22:39', NULL),
(17, 9, 'upload/products/multi-img/1765147420865590.png', '2023-05-06 09:22:39', NULL),
(29, 16, 'upload/products/multi-img/1765256193700440.jpg', '2023-05-07 14:11:33', NULL),
(30, 16, 'upload/products/multi-img/1765256193704216.jpg', '2023-05-07 14:11:33', NULL),
(31, 16, 'upload/products/multi-img/1765256193708764.jpg', '2023-05-07 14:11:33', NULL),
(32, 17, 'upload/products/multi-img/1765256462373040.jpg', '2023-05-07 14:15:50', NULL),
(33, 17, 'upload/products/multi-img/1765256462376333.jpg', '2023-05-07 14:15:50', NULL),
(34, 17, 'upload/products/multi-img/1765256462379632.jpg', '2023-05-07 14:15:50', NULL),
(35, 18, 'upload/products/multi-img/1765257449301501.jpg', '2023-05-07 14:31:31', NULL),
(36, 18, 'upload/products/multi-img/1765257449305021.jpg', '2023-05-07 14:31:31', NULL),
(37, 18, 'upload/products/multi-img/1765257449308186.jpg', '2023-05-07 14:31:31', NULL),
(38, 19, 'upload/products/multi-img/1765257649532712.jpg', '2023-05-07 14:34:42', NULL),
(39, 19, 'upload/products/multi-img/1765257649536405.jpg', '2023-05-07 14:34:42', NULL),
(40, 19, 'upload/products/multi-img/1765257649540086.jpg', '2023-05-07 14:34:42', NULL),
(41, 20, 'upload/products/multi-img/1765262247132154.webp', '2023-05-07 15:47:46', NULL),
(42, 20, 'upload/products/multi-img/1765262247138060.webp', '2023-05-07 15:47:46', NULL),
(43, 20, 'upload/products/multi-img/1765262247146376.webp', '2023-05-07 15:47:46', NULL),
(44, 20, 'upload/products/multi-img/1765262247151612.webp', '2023-05-07 15:47:46', NULL),
(46, 21, 'upload/products/multi-img/1765262424720559.jpg', '2023-05-07 15:50:36', NULL),
(47, 21, 'upload/products/multi-img/1765262424723505.jpg', '2023-05-07 15:50:36', NULL),
(48, 22, 'upload/products/multi-img/1765265685482520.jpg', '2023-05-07 16:42:25', NULL),
(49, 23, 'upload/products/multi-img/1765265950261903.jpg', '2023-05-07 16:46:38', NULL),
(50, 24, 'upload/products/multi-img/1765266486309729.jpg', '2023-05-07 16:55:09', NULL),
(51, 24, 'upload/products/multi-img/1765266486315261.jpg', '2023-05-07 16:55:09', NULL),
(52, 24, 'upload/products/multi-img/1765266486320339.jpg', '2023-05-07 16:55:09', NULL),
(53, 25, 'upload/products/multi-img/1765266732185263.jpg', '2023-05-07 16:59:04', NULL),
(54, 25, 'upload/products/multi-img/1765266732191706.jpg', '2023-05-07 16:59:04', NULL),
(55, 25, 'upload/products/multi-img/1765266732194437.jpg', '2023-05-07 16:59:04', NULL),
(56, 26, 'upload/products/multi-img/1765267376157503.jpg', '2023-05-07 17:09:18', NULL),
(57, 26, 'upload/products/multi-img/1765267376162601.jpg', '2023-05-07 17:09:18', NULL),
(58, 26, 'upload/products/multi-img/1765267376167130.jpg', '2023-05-07 17:09:18', NULL),
(59, 27, 'upload/products/multi-img/1765267567989588.jpg', '2023-05-07 17:12:21', NULL),
(60, 28, 'upload/products/multi-img/1765267703602918.jpg', '2023-05-07 17:14:30', NULL),
(61, 29, 'upload/products/multi-img/1765267824930540.jpg', '2023-05-07 17:16:26', NULL),
(62, 30, 'upload/products/multi-img/1765268261712656.jpg', '2023-05-07 17:23:22', NULL),
(63, 31, 'upload/products/multi-img/1765268370099466.jpg', '2023-05-07 17:25:06', NULL),
(64, 32, 'upload/products/multi-img/1765268469903465.jpg', '2023-05-07 17:26:41', NULL),
(65, 33, 'upload/products/multi-img/1765268612820848.jpg', '2023-05-07 17:28:57', NULL),
(66, 34, 'upload/products/multi-img/1765323694756578.jpg', '2023-05-08 08:04:27', NULL),
(67, 34, 'upload/products/multi-img/1765323694759699.jpg', '2023-05-08 08:04:27', NULL),
(68, 35, 'upload/products/multi-img/1765324002603351.jpg', '2023-05-08 08:09:21', NULL),
(69, 35, 'upload/products/multi-img/1765324002606915.jpg', '2023-05-08 08:09:21', NULL),
(70, 36, 'upload/products/multi-img/1765324651937429.jpg', '2023-05-08 08:19:40', NULL),
(71, 36, 'upload/products/multi-img/1765324651939649.jpg', '2023-05-08 08:19:40', NULL),
(72, 36, 'upload/products/multi-img/1765324651942053.jpg', '2023-05-08 08:19:40', NULL),
(73, 37, 'upload/products/multi-img/1765324913214250.jpg', '2023-05-08 08:23:49', NULL),
(74, 38, 'upload/products/multi-img/1765325240294539.jpg', '2023-05-08 08:29:01', NULL),
(75, 38, 'upload/products/multi-img/1765325240296765.jpg', '2023-05-08 08:29:01', NULL),
(76, 38, 'upload/products/multi-img/1765325240298681.jpg', '2023-05-08 08:29:01', NULL),
(77, 39, 'upload/products/multi-img/1765325341972833.jpg', '2023-05-08 08:30:38', NULL),
(78, 39, 'upload/products/multi-img/1765325341975943.jpg', '2023-05-08 08:30:38', NULL),
(79, 40, 'upload/products/multi-img/1765351605590324.jpg', '2023-05-08 15:28:05', NULL),
(80, 40, 'upload/products/multi-img/1765351605593333.jpg', '2023-05-08 15:28:05', NULL),
(81, 40, 'upload/products/multi-img/1765351605596160.jpg', '2023-05-08 15:28:05', NULL),
(82, 41, 'upload/products/multi-img/1765351866877919.jpg', '2023-05-08 15:32:14', NULL),
(83, 41, 'upload/products/multi-img/1765351866881215.jpg', '2023-05-08 15:32:14', NULL),
(84, 41, 'upload/products/multi-img/1765351866883380.jpg', '2023-05-08 15:32:14', NULL),
(85, 41, 'upload/products/multi-img/1765351866885833.jpg', '2023-05-08 15:32:14', NULL),
(86, 42, 'upload/products/multi-img/1765352105100467.jpg', '2023-05-08 15:36:02', NULL),
(87, 42, 'upload/products/multi-img/1765352105103020.jpg', '2023-05-08 15:36:02', NULL),
(88, 42, 'upload/products/multi-img/1765352105105536.jpg', '2023-05-08 15:36:02', NULL),
(89, 43, 'upload/products/multi-img/1765358832759699.jpg', '2023-05-08 17:22:58', NULL),
(90, 44, 'upload/products/multi-img/1765358936676091.jpg', '2023-05-08 17:24:37', NULL),
(91, 44, 'upload/products/multi-img/1765358936678571.jpg', '2023-05-08 17:24:37', NULL),
(92, 44, 'upload/products/multi-img/1765358936680511.jpg', '2023-05-08 17:24:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_month` varchar(255) NOT NULL,
  `order_year` varchar(255) NOT NULL,
  `delivered_date` varchar(255) DEFAULT NULL,
  `cancel_date` varchar(255) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `return_reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `admin_id` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `adress`, `post_code`, `notes`, `amount`, `order_number`, `invoice_no`, `order_date`, `order_month`, `order_year`, `delivered_date`, `cancel_date`, `return_date`, `return_reason`, `status`, `created_at`, `updated_at`, `vendor_id`, `admin_id`) VALUES
(19, 21, 'Alaa', 'alaa@gmail.com', '0125487411', 'aqaba', NULL, NULL, 19.00, '1', 'EOS25183307', '09 May 2023', 'May', '2023', NULL, NULL, NULL, NULL, 'deliverd', '2023-05-09 14:59:00', '2023-05-09 16:32:54', '23', 0),
(20, 21, 'Alaa', 'alaa@gmail.com', '0125487411', 'aqaba', NULL, NULL, 13.00, '1', 'EOS85053519', '10 May 2023', 'May', '2023', NULL, NULL, NULL, NULL, 'pending', '2023-05-10 17:30:45', NULL, '22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `created_at`, `updated_at`, `vendor_id`, `admin_id`) VALUES
(18, 19, 17, 19.00, '2023-05-09 14:59:00', NULL, 23, 0),
(19, 19, 22, 19.00, '2023-05-09 14:59:00', NULL, 23, 0),
(20, 20, 19, 13.00, '2023-05-10 17:30:45', NULL, 22, 0);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `product_tags` varchar(255) DEFAULT NULL,
  `product_size` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) NOT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `short_descp` text NOT NULL,
  `long_descp` text DEFAULT NULL,
  `product_thambnail` varchar(255) NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_slug`, `product_code`, `product_qty`, `product_tags`, `product_size`, `selling_price`, `discount_price`, `short_descp`, `long_descp`, `product_thambnail`, `vendor_id`, `status`, `created_at`, `updated_at`) VALUES
(16, 10, 14, 'logo for your brand', 'logo-for-your-brand', '1', '1', 'New services,Top services', NULL, '7.00', NULL, 'I will design a simple exclusive logo for your streetwear brand', '<p>Are you looking for an original, exclusive and eye-catching streetwear style logo design? YEAH..YOU MEET THE RIGHT PEOPLE!</p>\r\n<p>and congrats you are my priority client</p>', 'upload/products/thambnail/1765256193692331.jpg', '22', 1, '2023-05-07 14:11:33', NULL),
(17, 10, 14, 'business logo design', 'business-logo-design', '2', '1', 'New services,Top services', NULL, '10.00', '9.00', 'I will create modern and minimal business logo design', '<p><em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Welcome to my&nbsp;</em><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">do modern minimalist simple business logo designs</span><em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;Gig !! This gig is the extremely talented logo designers.</em></p>', 'upload/products/thambnail/1765256462366628.jpg', '22', 1, '2023-05-07 14:34:52', '2023-05-07 14:34:52'),
(18, 10, 15, 'clickable HTML email', 'clickable-html-email', '3', '1', 'New services,Top services', NULL, '7.00', NULL, 'I will make clickable HTML email signature for gmail, outlook etc', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Hi There,&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Thanks for visiting my Clickable Html Email Signature Service. I\'m available there to make Html email Signatures and work for the&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\">standard concept</span>. I will give you a&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">new design concept</span></span>&nbsp;that makes your HTML Email Signature<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\">&nbsp;<span style=\"background: #ffecd1;\">UNIQUE</span></span>&nbsp;from others.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">&nbsp;</p>', 'upload/products/thambnail/1765257449293538.jpg', '22', 1, '2023-05-07 14:31:31', NULL),
(19, 10, 15, 'business cards in 24h', 'business-cards-in-24h', '4', '1', 'New services,Top services', NULL, '15.00', '13.00', 'I will design stunning business cards within 24 hours', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I will make single and double sided unique, modern, innovative, sleek-Minimalistic, neat and clean, awesome yet professional and eye-catching Business cards.</span></p>', 'upload/products/thambnail/1765257649521661.jpg', '22', 1, '2023-05-07 14:34:42', NULL),
(20, 10, 16, 'seamless pattern', 'seamless-pattern', '5', '1', 'New services,Top services', NULL, '5.00', NULL, 'I will create exclusive and amazing seamless pattern', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I will create beautiful and unique seamless patterns for you that you can use for Fabric, wallpaper, textile, Accessories, Home Decor, Stationery, Website background, etc. All designs will be unique and commercially useable.</span></p>', 'upload/products/thambnail/1765262247125234.jpg', '22', 1, '2023-05-07 15:47:46', NULL),
(21, 10, 16, 'seamless pattern design', 'seamless-pattern-design', '6', '1', 'New services,Top services', NULL, '8.00', NULL, 'I will custom fabric textile pattern vector repeat seamless pattern design', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I will create custom fabric, textile pattern vector repeat seamless pattern design for you. I can create modern, unique, trendy, flashy and baby &amp; kids seamless pattern fabric textile designs that you can use for any product.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I can also create patterns inspired by any concept that you have in your mind.</p>', 'upload/products/thambnail/1765262424708498.jpg', '22', 1, '2023-05-07 15:52:36', '2023-05-07 15:52:36'),
(22, 9, 7, 'etsy tags for SEO', 'etsy-tags-for-seo', '1', '1', 'New services,Top services', NULL, '10.00', NULL, 'I will rewrite your etsy titles and tags for SEO', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;I have learned a LOT! I want to help you improve your Etsy shop by offering you constructive feedback. I believe in your business, and I want you to be</span></p>', 'upload/products/thambnail/1765266007328782.jpg', '23', 1, '2023-05-07 16:42:25', '2023-05-07 16:47:32'),
(23, 9, 7, 'optimize amazon PPC', 'optimize-amazon-ppc', '2', '1', 'New services,Top services', NULL, '20.00', '15.00', 'I will setup manage and optimize amazon PPC campaigns', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;Let me help you to understand How to be successful in selling on Amazon with my professional service.</span></p>', 'upload/products/thambnail/1765265950254190.jpg', '23', 1, '2023-05-07 16:46:38', NULL),
(24, 9, 8, 'youtube video promotion', 'youtube-video-promotion', '3', '1', 'New services,Top services', NULL, '10.00', NULL, 'I will do organic youtube video promotion through google ads', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">According to Youtube Creator Academy, you need to set some steps like Targeting Audiences and Discoverability to gain any forms of engagement (Views, Likes or Subscribers). But, what if you don\'t have time to do that? Lemme handle it for you! I will bring large audiences to watch your video using&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Real and Organic&nbsp;</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">promotion with the most effective, creative, and efficient ways. I don\'t sell fake traffic. I only provide organic promotion services and not using bots at all.</span></p>', 'upload/products/thambnail/1765266486302042.jpg', '23', 1, '2023-05-07 16:55:09', NULL),
(25, 9, 9, 'setup instantly account', 'setup-instantly-account', '4', '1', 'New services,Top services', NULL, '7.00', NULL, 'I will setup instantly account for cold emails outreach', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Instantly helps you scale your outreach campaigns through unlimited email sending accounts, unlimited warmup, and smart AI.</span></p>', 'upload/products/thambnail/1765266732177601.jpg', '23', 1, '2023-05-07 16:59:04', NULL),
(26, 11, 23, 'professional resume', 'professional-resume', '1', '1', 'New services,Top services', NULL, '7.00', '5.00', 'I will provide professional resume writing and cover letter writing', '<p>Do you need a Professional Resume/ Writing service and cover letter design that can boost your chances? I will design a Professional Resume/CV, beautiful formatting that makes employers stop and read what\'s on-page.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>My substantial experience in conscription has provided me with an in-depth knowledge of industry-specific requirements across a vast range of disciplines, including IT. I can make your resume glow.</p>', 'upload/products/thambnail/1765267376151822.jpg', '24', 1, '2023-05-07 17:09:18', NULL),
(27, 11, 23, 'resume and cover letter', 'resume-and-cover-letter', '2', '1', 'New services,Top services', NULL, '13.00', '11.00', 'I will edit, write and upgrade your resume, CV and cover letter', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">A resume and cover letter must be able to catch the attention of potential employers and make you stand out from the crowd.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Not getting the desired results with your current Resume /CV and cover letter? Does your resume/CV or cover letter need&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">reformatting&nbsp;</span></span>or a&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">total makeover</span></span>? Do you need feedback on how to improve your resume /CV and cover letter and increase your chances of getting the job interview?</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Look no further, I will help you to&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">review&nbsp;</span></span>and&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">upgrade&nbsp;</span></span>your current resume /CV, cover letter or&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">create a new</span></span>&nbsp;resume/CV and cover letter from scratch.&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">&nbsp;</p>', 'upload/products/thambnail/1765267567984104.jpg', '24', 1, '2023-05-07 17:12:21', NULL),
(28, 11, 24, 'website content & other', 'website-content-&-other', '3', '1', 'New services,Top services', NULL, '15.00', NULL, 'I will write website content, about us, bio, brand story, mission', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Every website visitor is interested in who you are! Thats why the about us page is&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\">essential</span>&nbsp;for your business!</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">In the eyes of your potential customers you have to sound&nbsp;<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\">professional, reliable and experienced</span>! Here is where we come in!</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">If you are a business owner, artist, real estate professional, youtuber, doctor, lawyer, and you want to tell the world you\'re the best at what you do, this gig is exactly what you need!</p>', 'upload/products/thambnail/1765267703596723.jpg', '24', 1, '2023-05-07 17:14:30', NULL),
(29, 11, 24, 'professional bio or about us page', 'professional-bio-or-about-us-page', '5', '1', 'New services,Top services', NULL, '20.00', '18.00', 'I will craft a compelling professional bio or about us page', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Are you ready to turn your dreams into reality? Unlock your full potential with a mesmerizing biography that showcases your skills and accomplishments. My expertise in crafting captivating biographies will capture your unique voice, highlighting your professional experience in an eye-catching and intriguing way.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">&nbsp;</p>', 'upload/products/thambnail/1765267824927048.jpg', '24', 1, '2023-05-07 17:16:26', NULL),
(30, 13, 29, 'fix your audio with top quality treatment', 'fix-your-audio-with-top-quality-treatment', '1', '1', 'New services,Top services', NULL, '20.00', NULL, 'I will edit, clean, repair and fix your audio with top quality treatment', '<p>Audio restoration, clarification and editing. I have worked with audio professionally for a number of years and developed broad skills in this field. I can edit podcasts, lectures, inerviews, tv and film dialogue to the highest standards. I will also send samples of your own material so you know how your finished product will sound. Please give me information if possible as to the purpose of the audio for example i\'e broadcast, stem, mix etc)</p>\r\n<p>&nbsp;</p>\r\n<p>I will turn your damaged audio into usable material by reducing or removing noises, clicks, pops, reverb, and more.</p>', 'upload/products/thambnail/1765268261708298.jpg', '25', 1, '2023-05-07 17:23:22', NULL),
(31, 13, 29, 'clean up any audio in 24h', 'clean-up-any-audio-in-24h', '2', '1', 'New services,Top services', NULL, '5.00', NULL, 'I will deeply edit, clean up and enhance your any audio', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">First impressions are important. And let\'s face it, most people can tell the difference between good and bad audio quality. So, it\'s important for your videos, or social media content to have great sound, and make a good impression! (</span><em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">As a professional voice actor, trust me, I know!</em><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">)</span></p>', 'upload/products/thambnail/1765268370092349.jpg', '25', 1, '2023-05-07 17:25:06', NULL),
(32, 13, 31, 'professional voice over', 'professional-voice-over', '3', '1', 'New services,Top services', NULL, '10.00', NULL, 'I will be your professional voice over', '<p>Necessary Licensing Rights (Commercial Rights &amp; Full Broadcast Rights) have to be added to your order in most cases, depending on the Use of Audio.&nbsp;</p>', 'upload/products/thambnail/1765268469896930.jpg', '25', 1, '2023-05-07 17:26:41', NULL),
(33, 13, 31, 'Arabic accent voice over', 'arabic-accent-voice-over', '4', '1', 'New services,Top services', NULL, '20.00', '15.00', 'I will do saudi and jordanian accent voice over', '<p>&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Dear Customer,</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Welcome to my page. plz to prior making order contact me to help you with free demo for small part of the script.</p>', 'upload/products/thambnail/1765268612815413.jpg', '25', 1, '2023-05-07 17:28:57', NULL),
(34, 13, 30, 'female voice over 24h', 'female-voice-over-24h', '1', '1', 'New services,Top services', NULL, '10.00', NULL, 'I will record a professional female voice over 24h', '<p>Are you tired of boring and generic voice overs that don\'t capture the attention of your audience?</p>\r\n<p>&nbsp;</p>\r\n<p>Do you want a voiceover that not only communicates your message clearly but also captivates your listeners from start to finish?</p>\r\n<p>&nbsp;</p>\r\n<p>Look no further!</p>\r\n<p>&nbsp;</p>\r\n<p>As a professional female voiceover artist, I offer my services to bring your project to life with my engaging and versatile voice. With years of experience in the industry, I have honed my skills to deliver voice overs that are not only professional but also unique and memorable.</p>', 'upload/products/thambnail/1765323694750904.jpg', '26', 1, '2023-05-08 08:04:27', NULL),
(35, 13, 30, 'female Arabic voice over', 'female-arabic-voice-over', '2', '1', 'New services,Top services', NULL, '15.00', '10.00', '- I will do Arabic voice over, female Arabic voice over', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\"><em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">أنا آلاء، من الشرق الأوسط، أمتهن العمل الحر كمترجمة، كما أني أقدم&nbsp;<span style=\"background: #ffecd1;\">خدمة التعليق الصوتي باللغة العربية</span></em></p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">This is Alaa. I am a native Arabic translator and a f<span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">emale Arabic voiceover artist.</span></span></p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\"><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\">I can, professionally, record scripts in all, but not limited to, the following fields:</span></p>\r\n<ul style=\"border: 0px; margin: 0px 5px; outline: 0px; padding: 0px; list-style: none none; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">Marketing &amp; Ads |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">المشاريع الدعائية التسويقية</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">Audio Books |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">الكتب المسموعة</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">Tutorials |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">الشروحات</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">Documentaries |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">الأفلام الوثائقية</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">IVR |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">الرد الآلي للهاتف</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">YouTube |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">فيديوهات اليوتيوب</em></li>\r\n</ul>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\"><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\"><span style=\"background: #ffecd1;\">I can record in many Arabic accents, including:</span></span></p>\r\n<ul style=\"border: 0px; margin: 0px 5px; outline: 0px; padding: 0px; list-style: none none; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\"><span style=\"background: #ffecd1;\">Fusha&nbsp;</span>(Standard Arabic) |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">اللغة العربية الفصحى</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\"><span style=\"background: #ffecd1;\">Egyptian&nbsp;</span>Arabic |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">العامية المصرية</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">Saudi / Emirati&nbsp;<span style=\"background: #ffecd1;\">Gulf&nbsp;</span>accents |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">اللهجات الخليجية</em></li>\r\n<li style=\"border: 0px; margin: 0px 0px 0px 24px; outline: 0px; padding: 0px; list-style: outside none disc;\">Syrian / Palestine&nbsp;<span style=\"background: #ffecd1;\">Levantine&nbsp;</span>accents |&nbsp;<em style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">اللهجات الشامية</em></li>\r\n</ul>', 'upload/products/thambnail/1765324002593107.jpg', '26', 1, '2023-05-08 08:09:21', NULL),
(36, 14, 36, 'help with all PC gamemaker', 'help-with-all-pc-gamemaker', '1', '1', 'New services,Top services', NULL, '15.00', NULL, 'I will code, debug and help with all PC gamemaker projects', '<p>The price is for average work-hour. I will give you an approximate time and associated cost for your project, and do my best with helping you solve and complete your projects. I like helping everyone, and advice is free :)</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>I usually make discounts for simple problems and bigger/longer projects, and for simple stuff try to help in a day or two.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>I\'m a game developer focusing on Gamemaker Studio 2, and I\'m offering help with any PC project in GMS2, even for game support/tool systems (was working on a bigger GMS2 projects, with &gt;10k lines of codes, coded from scratch, made tools before...). The projects I have worked on so far are all 2D, as GMS2 is not the best solution for 3D. Although I like challenges! My background is engineering, and in my free time I do drawings as well.</p>', 'upload/products/thambnail/1765324651933907.jpg', '27', 1, '2023-05-08 08:19:40', NULL),
(37, 14, 36, 'fix your Minecraft modpack in 24 h', 'fix-your-minecraft-modpack-in-24-h', '2', '1', 'New services,Top services', NULL, '30.00', '22.00', 'I will create or fix your minecraft modpack in 24 hours or less', '<p>Your DEFINITIVE modpack creator</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>In the last 5 years i\'ve been creating modpacks, testing mods, servers and plugins. That gave me knowledge to create themed modpacks, Modded servers with plugins, mini-games, shops, and I\'ve learned how to optimize the game as much as possible to run in almost any computer!</p>', 'upload/products/thambnail/1765324913210563.jpg', '27', 1, '2023-05-08 08:23:49', NULL),
(38, 14, 34, 'apple shortcut', 'apple-shortcut', '1', '1', 'New services,Top services', NULL, '10.00', NULL, 'I will create an apple shortcut that can run on iphone ipad mac watch homepod and alexa', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Before placing an order, please feel free to contact me to confirm if your request can be achieved through Apple Shortcuts.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Apple Shortcuts &amp; Automations : I specialize in creating custom Apple Shortcuts and Automations for your various needs, whether for work, home, or personal use. My services also extend to designing Automations for your Apple devices and smart home, which can integrate with Siri and Alexa.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">My expertise ranges from building simple Shortcuts like handling files or photos to developing advanced Shortcuts such as creating databases, spreadsheets, HTML, and integrating websites and app APIs.</p>', 'upload/products/thambnail/1765325240290834.jpg', '28', 1, '2023-05-08 08:29:01', NULL),
(39, 14, 34, 'amazon seller ios shortcut', 'amazon-seller-ios-shortcut', '2', '1', 'New services,Top services', NULL, '15.00', '12.00', 'I will create amazon seller ios shortcut for iphone, ipad, mac to handle shipping,sales', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I can build a small app (Shortcut) that runs on your iPhone, iPad and Mac to handle all the numbers related to your business like selling on Amazon, eBay...etc also you can use this Shortcut as an automation on your device to run certain tasks like sending an email or reminding you of something related to your business.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">This type of mini apps will help you keep track of all inventory, sales, revenue and create a custom spreadsheet or connect to a certain spreadsheet.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">A huge number of ideas that can be used to make handling an online business easier and more efficient.</p>', 'upload/products/thambnail/1765325341969814.jpg', '28', 1, '2023-05-08 08:30:38', NULL),
(40, 14, 33, 'build web apps', 'build-web-apps', '1', '1', 'New services,Top services', NULL, '85.00', NULL, 'I will build web apps, sites with js, react, nextjs, PHP and node', '<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">What I offer here is to share your lenses, picture what you have in mind and then find the best approach to help you actualize your Web Applications Project.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I develop apps with latest technology using Html/CSS, Reactjs, Nextjs, Nodejs, JavaScript and Laravel.</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\"><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold;\">My Packages Include the following:</span></p>\r\n<ul style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; list-style: none none; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">HTML, CSS , JAVASCRIPT , Bootstrap, React, Nextjs.</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">React js Full Stack Development using MERN stack.</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Responsive Design</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Google Maps integration</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">CSS, Bootstrap, Material UI Usage</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Eye-Catching GUI</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Node.js or Laravel Backend</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">Firebase Database Connection</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">MongoDB Database Connection</li>\r\n<li style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px;\">SQL Database Connection</li>\r\n</ul>', 'upload/products/thambnail/1765351605586166.jpg', '29', 1, '2023-05-08 15:28:05', NULL),
(41, 14, 33, 'front end web developer', 'front-end-web-developer', '2', '1', 'New services,Top services', NULL, '25.00', NULL, 'I will be your front end web developer using HTML,CSS, bootstrap,js', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I have been working as a&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">FRONT END Web developer, BACK END Web developer&nbsp;</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">having a strong command of any design format conversion into&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Html, CSS, Bootstrap, React</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">(PSD to HTML, xd to HTML, Sketch to HTML, zeplin to HTML, Figma to HTML, etc).&nbsp;</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">I can proudly assist you with&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Html5</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">,&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Css3</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">,&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Bootstrap</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">,&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Javascript, React js</span><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">. Responsive Web templates, Mobile templates, front-end development, and all front-end related technologies.</span></p>', 'upload/products/thambnail/1765351866871513.jpg', '29', 1, '2023-05-08 15:32:14', NULL),
(42, 14, 33, 'fix wordpress, PHP', 'fix-wordpress,-php', '3', '1', 'New services,Top services', NULL, '20.00', '15.00', 'I will fix wordpress, PHP, javascript, HTML CSS', '<p><span style=\"color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">&nbsp;I specialize in&nbsp;</span><span style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px; font-weight: bold; color: #62646a; font-family: Macan, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">PHP JS, WordPress and CSS.</span></p>', 'upload/products/thambnail/1765352105097120.jpg', '29', 1, '2023-05-08 15:36:02', NULL),
(43, 15, 40, 'Arabic sign language', 'arabic-sign-language', '1', '1', 'New services,Top services', NULL, '10.00', NULL, 'Translate videos into Arabic sign language', '<p>Translate videos into Arabic sign language</p>', 'upload/products/thambnail/1765358832752550.jpg', '2', 1, '2023-05-08 17:22:58', NULL),
(44, 15, 40, 'Teaching sign language', 'teaching-sign-language', '2', '1', 'New services,Top services', NULL, '50.00', '45.00', 'Teaching Arabic sign language', '<p>Teaching Arabic sign language</p>', 'upload/products/thambnail/1765358936671719.jpg', '2', 1, '2023-05-08 17:24:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reply_messages`
--

CREATE TABLE `reply_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin` varchar(255) DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `message_id` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `replymessage` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reply_messages`
--

INSERT INTO `reply_messages` (`id`, `user_id`, `admin_id`, `vendor_id`, `admin`, `vendor`, `message_id`, `message`, `replymessage`, `created_at`, `updated_at`) VALUES
(2, 21, NULL, 1, 'Admin tabark', NULL, '3', 'i love it', 'great', '2023-05-10 17:32:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(6, 20, 21, 'great work', '4', '1', '2023-05-08 15:11:36', '2023-05-08 15:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_title` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_title`, `short_title`, `slider_image`, `created_at`, `updated_at`) VALUES
(6, 'find your spectacular freelance service for your business', 'Connect to the future', 'upload/slider/1765074750560371.png', NULL, '2023-05-07 16:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
(7, 9, 'ecommerce SEO', 'ecommerce-seo', NULL, NULL),
(8, 9, 'Video Marketing', 'video-marketing', NULL, NULL),
(9, 9, 'Email Marketing', 'email-marketing', NULL, NULL),
(10, 9, 'Social Media Marketing', 'social-media-marketing', NULL, NULL),
(11, 9, 'Public Relations', 'public-relations', NULL, NULL),
(12, 9, 'Book & eBook Marketing', 'book-&-ebook-marketing', NULL, NULL),
(13, 9, 'Mobile App Marketing', 'mobile-app-marketing', NULL, NULL),
(14, 10, 'Logo Design', 'logo-design', NULL, NULL),
(15, 10, 'Business Cards & Stationery', 'business-cards-&-stationery', NULL, NULL),
(16, 10, 'Pattern Design', 'pattern-design', NULL, NULL),
(17, 10, 'Landing Page Design', 'landing-page-design', NULL, NULL),
(19, 10, 'Image Editing', 'image-editing', NULL, NULL),
(20, 10, 'T-Shirts & Merchandise', 't-shirts-&-merchandise', NULL, NULL),
(21, 10, 'Book Cover Design', 'book-cover-design', NULL, NULL),
(22, 11, 'Articles & Blog Posts', 'articles-&-blog-posts', NULL, NULL),
(23, 11, 'Resume Writing', 'resume-writing', NULL, NULL),
(24, 11, 'Website Content', 'website-content', NULL, NULL),
(25, 12, 'Logo Animation', 'logo-animation', NULL, NULL),
(26, 12, 'Visual Effects', 'visual-effects', NULL, NULL),
(27, 12, 'Slideshow Videos', 'slideshow-videos', NULL, NULL),
(28, 12, '3D Product Animation', '3d-product-animation', NULL, NULL),
(29, 13, 'Audio Editing', 'audio-editing', NULL, NULL),
(30, 13, 'Female voice over', 'female-voice-over', NULL, NULL),
(31, 13, 'Male voice over', 'male-voice-over', NULL, NULL),
(32, 14, 'HTML & CSS developers', 'html-&-css-developers', NULL, NULL),
(33, 14, 'Web Application', 'web-application', NULL, NULL),
(34, 14, 'IOS developers', 'ios-developers', NULL, NULL),
(35, 14, 'WordPress', 'wordpress', NULL, NULL),
(36, 14, 'Game Development', 'game-development', NULL, NULL),
(37, 16, 'Sales', 'sales', NULL, NULL),
(38, 16, 'Business Plans', 'business-plans', NULL, NULL),
(39, 16, 'Data Analytics', 'data-analytics', NULL, NULL),
(40, 15, 'Arabic sign language', 'arabic-sign-language', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `vendor_join` varchar(255) DEFAULT NULL,
  `vendor_short_info` text DEFAULT NULL,
  `role` enum('admin','vendor','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `vendor_join`, `vendor_short_info`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin tabark', 'admin', 'admin@gmail.com', NULL, '$2y$10$BQ.xdFcxVvfWBlTXZYc1dOCJi0SPOLIo9rQ59uLwceSk.apBnXdLe', '202305091953admin.png', '0775584215', 'Aqaba, Jordan', NULL, '', 'admin', 'active', NULL, NULL, '2023-05-09 16:55:45'),
(2, 'Tabark Alhawadi', 'Sign language Expert', 'Tabark21@gmail.com', NULL, '$2y$10$KTeeoUrkGfqXkC8TGJZlmeid.zMso2IzHyRwX0h2Tj9DL6pNqgHLq', '202305081849IMG-20230315-WA0013.jpg', '0778845215', 'Amman, Jordan', '2022', 'Sign Language Expert, Sign Language Lecturer', 'vendor', 'active', NULL, NULL, '2023-05-08 17:13:56'),
(3, 'User12', 'user', 'user@gmail.com', NULL, '$2y$10$5m.f73tvzz6KifTHJdY7ruD21N/mJc8pCJycQWLnjpQuza3KOX9Z6', '202304251957BS3.png', '0778451236', 'Amman, Jordan', NULL, '', 'user', 'active', NULL, NULL, '2023-04-25 16:58:15'),
(19, 'develop web pages', 'jack', 'jack@gmail.com', NULL, '$2y$10$UNYfkU0wlYFcSFQ/x.3GYOLTM8ttUcUkZztUCvMgSLcd4Zmqovo0m', NULL, '0775412854', NULL, '2022', NULL, 'vendor', 'inactive', NULL, NULL, '2023-05-08 09:34:30'),
(20, 'design', 'tabark', 'tabark@gmail.com', NULL, '$2y$10$IDeNHQdiKYYZpt6BxAO7GeswhLOn0dM1G6b0ua0qlO.6B4MreFwui', NULL, '0775412854', NULL, '2022', NULL, 'vendor', 'inactive', NULL, NULL, '2023-04-17 15:59:35'),
(21, 'Alaa', 'mosa', 'alaa@gmail.com', NULL, '$2y$10$EoR76vt4ym2wFRZL4.700uBReJrrewQWr.K.aDompDnvlO9yUb8TS', '202304301904coach_alaa-removebg-preview.png', '0125487411', 'aqaba', NULL, NULL, 'user', 'active', NULL, '2023-04-20 06:37:26', '2023-04-30 16:04:04'),
(22, 'Leen Ammar', 'graphic designer', 'leen@gmail.com', NULL, '$2y$10$EaGHFQo0RmPmQI5zhGQNTudgs/omu9i0o5pbJVrTYYJznLtiV4nUi', '202305072033WhatsApp Image 2022-12-17 at 13.49.28.jpg', '0775421366', 'Aqaba, Jordan', '2023', 'My name Leen Ammar, As a passionate graphic designer with a specialty in logo design and brand identity, I have a keen eye for creating minimalist designs that carry a deep sense of meaning and nostalgia.\r\n\r\nWith more than three years of experience working as an independent designer for over 200 companies worldwide, I have honed my ability to adapt to the specific needs of each client.', 'vendor', 'active', NULL, NULL, '2023-05-07 17:33:44'),
(23, 'Shaim\'a Bassam', 'Digital Marketer', 'shaima@gmail.com', NULL, '$2y$10$yRBDx0hJ7nK3f174WWU6kup53S2vJJGM6/Z3dmf7JWbnULE63wCSa', '202305072033Screenshot_20230507_220605_Instagram.jpg', '0771548725', 'Aqaba, Jordan', '2023', 'I am a digital marketing agency owner. I specialize in email marketing and deliverability, content marketing, web hosting/design, and marketing consulting. With my skills and experience, I\'ve been able to help digital marketers and small business owners increase their email deliverability and online awareness so they can generate more leads and make more sales for their business.', 'vendor', 'active', NULL, NULL, '2023-05-07 17:33:17'),
(24, 'Salwa Yehya', 'Expert CV and Resume Writing Services', 'salwa@gmail.com', NULL, '$2y$10$uwTmdBuLE.qJ.TjZ.2B0DeMUHqoBdFVSwYkD0M.RqeJ7Jw0uctRsO', '202305072003115406432.png', '0778451268', 'Aqaba, Jordan', '2023', 'As a skilled writer, I offer professional CV and resume services, LinkedIn profile optimisation, and crafting compelling cover letters for any industry. I have extensive experience tailoring my writing to various fields and can accurately showcase your experiences whilst improving your chances of landing job interviews. My writing can effectively highlight your strengths and make you stand out to potential employers. Dedicated to providing my clients with a competitive edge.', 'vendor', 'active', NULL, NULL, '2023-05-07 17:03:51'),
(25, 'Zohde Tamimi', 'sound designer, mix and mastering engineer', 'zohde@gmail.com', NULL, '$2y$10$E8nn4lpdjqCQsfp8Y9AvgOBYs6KaZuUfktvc/bc7J9tMSEPdg.i0K', '2023050720191668494971037.jpg', '0778412569', 'Aqaba, Jordan', '2023', 'I am a sound designer, mix and mastering engineer, producer, beatmaker, audio editor and performer of my own songs. I specialize in audio design for advertisements, movies and many other projects, as well as create meditative and relaxing background music. Work experience: 5 years.  Interested? Contact me, I\'ll be glad to cooperate.', 'vendor', 'active', NULL, NULL, '2023-05-07 17:19:34'),
(26, 'Shaima yaseen', 'voiceover artist', 'shaimay@gmail.com', NULL, '$2y$10$/45JSfxLe26pF6f5Wr.u7O5RTSScW0cE/kI0x7OCOHFswrc2.wIsO', '2023050720301668954207347.jpg', '0774216587', 'Amman, Jordan', '2023', 'I am a professional voice over artist based in Amman. My studio setup is industry standard and has been used to record national commercials, professional audiobooks, and every sample you hear on my page. My voice has been featured on national radio broadcasts, podcasts, web commercials, e-learning courses, explainer videos, phone systems, and more!', 'vendor', 'active', NULL, NULL, '2023-05-08 15:23:42'),
(27, 'Asem Yassen', 'programmer', 'asem@gmail.com', NULL, '$2y$10$1gZxCBaADQHu4gpN39gdtOcuiJn0kmkDeKsNo44B9u1/kQ.cwz3BK', '202305081111asem.04.00.jpg', '0779541268', 'Aqaba, Jordan', '2023', 'Experienced electrical/IT engineer with previous history of working in the automotive and wireless/IT industry. I love to draw and do design in my spare time and sometimes for others, besides teaching others what I know (Maths, Physics, Programming ...).', 'vendor', 'active', NULL, NULL, '2023-05-08 08:14:41'),
(28, 'Abdelmajied', 'ios developer', 'abed@gmail.com', NULL, '$2y$10$JmeXd.b1GvzetpBJ0y9w5eYXJk19/GGsXY2.Usa3RQbut8.sjf9eW', '202305081125Screenshot_20230507_223155_WhatsApp.jpg', '0778451268', 'Amman, Jordan', '2022', 'I\'m a problem solver especially in software, technology invented to make our lives easier that\'s why I learned how to code, I\'m a beginner Android developer with 2 apps on the market and a very experienced Apple Shortcuts builder. I\'ve built more than 300 Shortcuts for many customers, Shortcuts always a better choice for some customers if they need a small app that does certain things and it doesn\'t cost a lot of money.', 'vendor', 'active', NULL, NULL, '2023-05-08 15:24:10'),
(29, 'Jack Alloussi', 'Software and Web Application', 'jacklusy@gmail.com', NULL, '$2y$10$XjulTgPh/wkh9zLUDU3CuuHjWb8ZggsX8AX8/fwC2kLbNIlRbbwaG', '2023050812361678730773734.jpg', '0779452168', 'Amman, Jordan', '2022', 'I am software engineer.I have completed my Masters. I am working on web application development and software development in a MNC. I have 2 years experience in this field.', 'vendor', 'active', NULL, NULL, '2023-05-08 09:36:38'),
(30, 'mona', 'mona', 'mona@gmail.com', NULL, '$2y$10$FOVobjwgqs7M8a8jWvmTTuhyUtZDYjx0aayfRo6/4kjAW.xyPr032', '202305102156coach_mona-removebg-preview.png', '0778452132', 'Alkarak, Jordan', NULL, NULL, 'user', 'active', NULL, '2023-05-10 18:55:54', '2023-05-10 18:56:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_messages`
--
ALTER TABLE `reply_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reply_messages`
--
ALTER TABLE `reply_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
