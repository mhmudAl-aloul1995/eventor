-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 02:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `remember_token` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `remember_token`, `image`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$vfph0Bb2iX3UhQTQmjwsAuP4Km6AaP6GgwuBIu6jhQgaaKmsxXwTG', NULL, 'admin.png', 1, '2019-11-04 00:00:00', '2020-06-06 04:38:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applying_coupon`
--

CREATE TABLE `applying_coupon` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `district` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_code`, `country_id`, `district`, `created_at`, `updated_at`) VALUES
(2973, 'Doha', 'QAT', 896, 'Doha', NULL, NULL),
(3173, 'Riyadh', 'SAU', 901, 'Riyadh', NULL, NULL),
(3174, 'Jedda', 'SAU', 901, 'Mekka', NULL, NULL),
(3175, 'Mekka', 'SAU', 901, 'Mekka', NULL, NULL),
(3176, 'Medina', 'SAU', 901, 'Medina', NULL, NULL),
(3177, 'al-Dammam', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3178, 'al-Taif', 'SAU', 901, 'Mekka', NULL, NULL),
(3179, 'Tabuk', 'SAU', 901, 'Tabuk', NULL, NULL),
(3180, 'Burayda', 'SAU', 901, 'al-Qasim', NULL, NULL),
(3181, 'al-Hufuf', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3182, 'al-Mubarraz', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3183, 'Khamis Mushayt', 'SAU', 901, 'Asir', NULL, NULL),
(3184, 'Hail', 'SAU', 901, 'Hail', NULL, NULL),
(3185, 'al-Kharj', 'SAU', 901, 'Riad', NULL, NULL),
(3186, 'al-Khubar', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3187, 'Jubayl', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3188, 'Hafar al-Batin', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3189, 'al-Tuqba', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3190, 'Yanbu', 'SAU', 901, 'Medina', NULL, NULL),
(3191, 'Abha', 'SAU', 901, 'Asir', NULL, NULL),
(3192, 'Ara´ar', 'SAU', 901, 'al-Khudud al-Samaliy', NULL, NULL),
(3193, 'al-Qatif', 'SAU', 901, 'al-Sharqiya', NULL, NULL),
(3194, 'al-Hawiya', 'SAU', 901, 'Mekka', NULL, NULL),
(3195, 'Unayza', 'SAU', 901, 'Qasim', NULL, NULL),
(3196, 'Najran', 'SAU', 901, 'Najran', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(52) COLLATE utf8mb4_unicode_ci NOT NULL,
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `government_form` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `head_of_state` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code2` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `continent`, `government_form`, `head_of_state`, `code2`, `status`) VALUES
(896, 'QAT', 'Qatar', 'Asia', 'Monarchy', 'Hamad ibn Khalifa al-Thani', 'QA', 1),
(901, 'SAU', 'Saudi Arabia', 'Asia', 'Monarchy', 'Fahd ibn Abdul-Aziz al-Sa´ud', 'SA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `discount` int(11) NOT NULL,
  `max_use` int(11) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `use_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `total_apply` float DEFAULT NULL COMMENT 'المجموع الاجمالي الذي يقبل ان يطبق عليه كود الخصم',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `name`, `code`, `type`, `discount`, `max_use`, `start_date`, `end_date`, `use_count`, `status`, `total_apply`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Bumper Offer', 'TECS-7509', 'amount', 10, 10, '2020-06-17', '2020-06-25', 10, 0, NULL, '2020-06-11 07:27:55', '2020-06-18 11:26:04', '0000-00-00 00:00:00'),
(6, 'new offer', 'CIBQ-6469', 'percentage', 10, 10, '2020-06-19', '2020-06-30', 1, 0, NULL, '2020-06-19 04:34:53', '2020-06-19 04:35:38', '0000-00-00 00:00:00'),
(9, 'latest new offer', 'JZTI-9648', 'percentage', 20, 5, '2020-08-30', '2020-09-30', 0, 0, 400, '2020-08-22 05:15:02', '2020-12-20 00:28:08', '2020-09-15 07:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(11) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `seq_type` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `debit` float NOT NULL COMMENT 'مدين',
  `credit` float NOT NULL COMMENT 'دائن',
  `notes` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type_description` varchar(255) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `image`, `status`, `created_at`, `updated_at`, `type_description`, `parent`, `sort`) VALUES
(1, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'حفلات الزواج', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `file`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'english', 'english.json', '1580901280.png', 1, '2020-02-05 11:14:40', '2020-12-30 09:22:49'),
(2, 'arabic', 'arebic.json', '1580901435.png', 1, '2020-02-05 11:17:15', '2020-02-05 11:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `language_description`
--

CREATE TABLE `language_description` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `id_ref` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_description`
--

INSERT INTO `language_description` (`id`, `table_id`, `language_id`, `id_ref`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 'Marriage Parties', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 1, 2, '1', 'حفلات الزواج', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `notification_type` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_template`
--

CREATE TABLE `notification_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mail_content` text NOT NULL,
  `message_content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_template`
--

INSERT INTO `notification_template` (`id`, `title`, `subject`, `mail_content`, `message_content`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User Verification', 'User Verification', 'Dear {{name}},<br>&nbsp; &nbsp;<br>&nbsp; &nbsp; Your registration is completed successfully.<br><br>&nbsp; &nbsp; Your Verification code is <b>{{otp}}</b>.<br><br>From {{shop_name}}', 'Dear {{name}}, Your Verification code is {{otp}}. From {{shop_name}}', '1574854450.png', '2019-11-27 11:34:10', '2019-11-27 13:13:54', '0000-00-00 00:00:00'),
(2, 'Forget Password', 'Forget Password', 'Dear {{name}},<br>&nbsp; &nbsp; &nbsp;&nbsp;<br>&nbsp; &nbsp; Your new passowrd is <b>{{password}}</b>.<br><br>From {{shop_name}}<br><br>', 'Dear {{name}},  Your new passowrd is {{password}}. From {{shop_name}}', '1574860457.jpg', '2019-11-27 11:42:00', '2019-11-27 13:14:17', '0000-00-00 00:00:00'),
(3, 'Create Order', 'Create Order', 'Dear {{name}},<br><br>&nbsp; &nbsp;Your Order is successfully created in {{shop}}.<br>&nbsp; &nbsp;<br>&nbsp; &nbsp;Thank you for using our application.<br><br>From {{shop_name}}', 'Dear {{name}}, Your Order is successfully created in {{shop}}. From {{shop_name}}', '1581055777.png', '2019-11-27 13:17:14', '2020-02-07 06:09:37', '0000-00-00 00:00:00'),
(4, 'Cancel Order', 'Cancel Order', 'Dear {{name}},<br><br>&nbsp; &nbsp;Your Order {{order_no}} on {{shop}} is Rejected by Restaurant.<br><br>From {{shop_name}}', 'Dear {{name}}, Your Order {{order_no}} on {{shop}} is Rejected by Restaurant. From {{shop_name}}', '1574861383.png', '2019-11-27 13:27:27', '2020-02-07 10:41:59', '0000-00-00 00:00:00'),
(6, 'Order Arrive', 'Order Arrive', 'Dear {{name}},<br>&nbsp; &nbsp; &nbsp;&nbsp;<br>&nbsp; &nbsp;You have new order {{order_no}} in {{shop}} from {{customer_name}}.<br><br>From {{shop_name}}', 'Dear {{name}}, You have new order {{order_no}} in {{shop}} from {{customer_name}}. From {{shop_name}}', '1574940643.png', '2019-11-28 11:30:43', '2019-12-24 07:42:41', '0000-00-00 00:00:00'),
(7, 'Order Status', 'Order Status', 'Dear {{name}},<br><br>&nbsp; &nbsp;Your Order {{order_no}} on {{shop}} is successfully {{status}}.<br><br>From {{shop_name}}', 'Dear {{name}}, Your Order {{order_no}} on {{shop}} is successfully {{status}}. From {{shop_name}}', '1600767832.png', '2019-12-24 07:38:55', '2020-09-22 09:43:52', '0000-00-00 00:00:00'),
(8, 'Payment Status', 'Payment Status', 'Dear {{name}},<br><br>&nbsp; &nbsp;Your Payment for order {{order_no}} is successfully {{payment_status}}.<br><br>From {{shop_name}}', 'Dear {{name}}, Your Payment for order {{order_no}} is successfully {{payment_status}}. From {{shop_name}}', '1577267855.png', '2019-12-25 09:57:35', '2019-12-25 10:20:56', '0000-00-00 00:00:00'),
(9, 'Order Request', 'Order Request', 'Dear {{name}},<br><br>&nbsp; &nbsp; &nbsp; You have new request for order {{order_no}}&nbsp;at {{user_address}} by {{shop}}.<br><br>from {{shop_name}}<br><br>', 'Dear {{name}}, You have new request for order {{order_no}} at {{user_address}} by {{shop}}. from {{shop_name}}', '1579160492.png', '2020-01-16 07:41:32', '2020-01-16 07:45:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `payment` int(11) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `coupon_price` int(11) DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `order_status` varchar(50) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_token` varchar(50) DEFAULT NULL,
  `order_otp` int(11) DEFAULT NULL,
  `reject_by` varchar(255) DEFAULT NULL,
  `review_status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders_dtl`
--

CREATE TABLE `orders_dtl` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `invoice_date` varchar(50) NOT NULL,
  `from_date` varchar(50) NOT NULL,
  `to_date` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `is_vat` int(11) DEFAULT 0,
  `vat_price` int(11) NOT NULL,
  `discount` int(11) DEFAULT 0,
  `net_price` int(11) NOT NULL,
  `service_status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_name`) VALUES
(1, 'الحجز'),
(2, 'تم التأكيد'),
(3, 'السداد'),
(4, 'تمت الخدمة');

-- --------------------------------------------------------

--
-- Table structure for table `order_status_history`
--

CREATE TABLE `order_status_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_status_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status_history`
--

INSERT INTO `order_status_history` (`id`, `order_id`, `order_status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 3, '2021-02-25 08:05:54', '2021-02-25 08:05:54', NULL),
(2, 3, 3, '2021-02-25 08:06:59', '2021-02-25 08:06:59', NULL),
(3, 3, 3, '2021-02-25 08:08:49', '2021-02-25 08:08:49', NULL),
(4, 3, 3, '2021-02-25 08:08:57', '2021-02-25 08:08:57', NULL),
(5, 3, 3, '2021-02-25 08:09:16', '2021-02-25 08:09:16', NULL),
(6, 3, 3, '2021-02-25 08:09:51', '2021-02-25 08:09:51', NULL),
(7, 3, 3, '2021-02-25 08:34:11', '2021-02-25 08:34:11', NULL),
(8, 3, 1, '2021-02-25 08:41:44', '2021-02-25 08:41:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `other_detail`
--

CREATE TABLE `other_detail` (
  `id` int(11) NOT NULL,
  `other_description` text DEFAULT NULL,
  `other_status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `other_detail_category`
--

CREATE TABLE `other_detail_category` (
  `id` int(11) NOT NULL,
  `other_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `q_name` varchar(255) NOT NULL,
  `q_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `q_name`, `q_type`) VALUES
(1, 'ما مدى رضاك', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `priority` int(11) DEFAULT 0,
  `price` float NOT NULL,
  `is_vat` int(11) DEFAULT 1,
  `vat_no` varchar(255) NOT NULL,
  `supp_id` int(11) DEFAULT 0,
  `Infants_from` int(11) DEFAULT 0,
  `Infants_to` int(11) DEFAULT 0,
  `children_from` int(11) DEFAULT 0,
  `children_to` int(11) DEFAULT 0,
  `Adults_from` int(11) DEFAULT 0,
  `Adults_to` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services_booking`
--

CREATE TABLE `services_booking` (
  `id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `booking_type` int(11) NOT NULL,
  `id_ref` int(11) DEFAULT 1,
  `from_date` varchar(50) NOT NULL,
  `to_date` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services_category`
--

CREATE TABLE `services_category` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `determine_invitees` int(11) NOT NULL DEFAULT 0,
  `is_base` int(11) NOT NULL DEFAULT 0 COMMENT 'اذا كانت القيمة 1 معناه ان هذه الفئة يتم احتساب المسافات بموجبها\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services_category_other`
--

CREATE TABLE `services_category_other` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `other_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services_detail`
--

CREATE TABLE `services_detail` (
  `id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `other_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `the_key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `the_key`, `value`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pay_before', 'pay_before', '1', 1, NULL, '2021-01-12 17:12:57', NULL),
(2, 'mdhd', 'vvvvv', '22222', 1, '2021-01-12 17:18:42', '2021-01-12 17:18:42', NULL),
(3, 'uu', 'vvvvv', '22222', 1, '2021-01-12 17:19:02', '2021-01-12 17:19:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(50) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `balance` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `location`, `phone`, `email`, `website`, `description`, `logo`, `favicon`, `created_at`, `updated_at`, `balance`) VALUES
(1, 'شركة التصوير الحديثه', 'الرياض', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment`
--

CREATE TABLE `supplier_payment` (
  `id` int(11) NOT NULL,
  `seq_no` int(11) NOT NULL,
  `seq_type` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `debit` float NOT NULL COMMENT 'مدين',
  `credit` float NOT NULL COMMENT 'دائن',
  `notes` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_language`
--

CREATE TABLE `table_language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table_description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_language`
--

INSERT INTO `table_language` (`id`, `name`, `table_description`, `created_at`, `updated_at`) VALUES
(1, 'event_types', 'نوع الحدث', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'services_category', 'التصنيفات او الفئات', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'services', 'الخدمات', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'order_status', 'حالات الطلب', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'other_detail', 'تفاصيل اضافية للخدمات', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_condations` int(11) NOT NULL DEFAULT 0,
  `verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `lat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_notification` int(11) NOT NULL DEFAULT 0,
  `enable_location` int(11) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `ip_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `soc_name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_evaluations`
--

CREATE TABLE `user_evaluations` (
  `id` int(10) UNSIGNED NOT NULL,
  `evaluated_user_id` bigint(20) UNSIGNED NOT NULL,
  `evaluator_user_id` bigint(20) UNSIGNED NOT NULL,
  `evaluation_no` tinyint(1) NOT NULL DEFAULT 0,
  `evaluation_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_question_answers`
--

CREATE TABLE `user_question_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_template`
--
ALTER TABLE `notification_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status_history`
--
ALTER TABLE `order_status_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_evaluations`
--
ALTER TABLE `user_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_question_answers`
--
ALTER TABLE `user_question_answers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4083;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=959;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_template`
--
ALTER TABLE `notification_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_status_history`
--
ALTER TABLE `order_status_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_evaluations`
--
ALTER TABLE `user_evaluations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_question_answers`
--
ALTER TABLE `user_question_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
