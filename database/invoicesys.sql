-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 01:39 PM
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
-- Database: `invoicesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test category', 2, '2024-06-30 10:03:21', '2024-06-30 10:03:21'),
(2, 'test category', 2, '2024-06-30 10:03:21', '2024-06-30 10:03:21'),
(3, 'Test', 2, '2024-06-30 10:14:35', '2024-06-30 10:14:35'),
(4, 'best', 2, '2024-06-30 10:15:47', '2024-06-30 10:15:47'),
(5, 'again', 2, '2024-06-30 10:22:13', '2024-06-30 10:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `corporate_users`
--

CREATE TABLE `corporate_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', NULL, NULL),
(2, 'India', NULL, NULL),
(3, 'Sweden', NULL, NULL),
(4, 'America', NULL, NULL),
(5, 'Other', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 4, NULL, NULL),
(2, 'EUR', '€', 3, NULL, NULL),
(3, 'BDT', '৳', 1, NULL, NULL),
(4, 'INR', '₹', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_no` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `personal_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `gln` varchar(255) DEFAULT NULL,
  `vat_no` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email_invoice` varchar(255) DEFAULT NULL,
  `email_cc` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_no`, `customer_name`, `customer_type`, `personal_id`, `address`, `postcode`, `city`, `gln`, `vat_no`, `phone_no`, `mobile_no`, `email_invoice`, `email_cc`, `website`, `country_id`, `language_id`, `currency_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tawofiq', 'Regular', '1215215', 'bangladesh', '1212', 'Dhaka', '11021', NULL, '01521109057', '020016660', 'tawfiq@email.com', NULL, NULL, 1, 1, 1, 2, '2024-06-30 10:03:07', '2024-06-30 10:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_requirements`
--

CREATE TABLE `delivery_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terms_of_delivery` varchar(255) NOT NULL,
  `delivery_method` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_setting_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `notes` text DEFAULT NULL,
  `payment_details` text DEFAULT NULL,
  `qr_link` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `status` enum('draft','complete','rejected') NOT NULL DEFAULT 'draft',
  `total_price_excluding_vat` decimal(10,2) DEFAULT NULL,
  `total_price_including_vat` decimal(10,2) DEFAULT NULL,
  `received_money` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `transaction_type` enum('in','out') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `user_id`, `customer_id`, `invoice_category_id`, `invoice_setting_id`, `invoice_date`, `delivery_date`, `products`, `notes`, `payment_details`, `qr_link`, `file_path`, `status`, `total_price_excluding_vat`, `total_price_including_vat`, `received_money`, `due_amount`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1, 'inv000001', 2, 1, 2, 1, '2024-06-30', '2024-06-30', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000001.pdf', 'rejected', 450.00, 500.00, 500.00, 0.00, 'in', '2024-06-30 10:24:02', '2024-06-30 12:20:42'),
(2, 'inv000002', 2, 1, 2, 1, '2024-06-30', '2024-06-30', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000002.pdf', 'rejected', 450.00, 500.00, 500.00, 0.00, 'in', '2024-06-30 10:25:12', '2024-06-30 12:21:31'),
(3, 'inv000003', 2, 1, 2, 1, '2024-06-30', '2024-06-30', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000003.pdf', 'complete', 450.00, 500.00, 500.00, 0.00, 'in', '2024-06-30 10:25:15', '2024-06-30 10:25:15'),
(4, 'inv000004', 2, 1, 1, 1, '2024-07-01', '2024-07-06', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000004.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-06-30 10:30:16', '2024-06-30 10:30:16'),
(7, 'inv000007', 2, 1, 1, 1, '2024-06-30', '2024-06-30', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000007.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-06-30 10:43:19', '2024-06-30 10:43:19'),
(8, 'inv000008', 2, 1, 1, 1, '2024-06-30', '2024-06-30', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000008.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-06-30 10:44:42', '2024-06-30 10:44:42'),
(9, 'inv000009', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'tvhdbahdbhab', NULL, NULL, 'invoices/inv000009.pdf', 'draft', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:10:39', '2024-07-01 04:10:39'),
(10, 'inv000010', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'test', NULL, NULL, 'invoices/inv000010.pdf', 'draft', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:11:03', '2024-07-01 04:11:03'),
(11, 'inv000011', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'test', NULL, NULL, 'invoices/inv000011.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:11:25', '2024-07-01 04:11:25'),
(12, 'inv000012', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'test project', NULL, NULL, 'invoices/inv000012.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:37:07', '2024-07-01 04:37:07'),
(13, 'inv000013', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'adad', NULL, NULL, 'invoices/inv000013.pdf', 'draft', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:38:47', '2024-07-01 04:38:47'),
(14, 'inv000014', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'dda', NULL, NULL, 'invoices/inv000014.pdf', 'draft', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:39:11', '2024-07-01 04:39:11'),
(15, 'inv000015', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', NULL, NULL, NULL, 'invoices/inv000015.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:42:27', '2024-07-01 04:42:27'),
(16, 'inv000016', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'dada', NULL, NULL, 'invoices/inv000016.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:42:45', '2024-07-01 04:42:45'),
(17, 'inv000017', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'tada', NULL, NULL, 'invoices/inv000017.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:55:58', '2024-07-01 04:55:58'),
(18, 'inv000018', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'daaa', NULL, NULL, 'invoices/inv000018.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 04:56:15', '2024-07-01 04:56:15'),
(19, 'inv000019', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'test', NULL, NULL, 'invoices/inv000019.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 05:01:32', '2024-07-01 05:01:32'),
(20, 'inv000020', 2, 1, 1, 1, '2024-07-01', '2024-07-01', '\"[{\\\"name\\\":\\\"Rice\\\",\\\"category\\\":\\\"Test Category\\\",\\\"priceExVat\\\":\\\"450.00\\\",\\\"priceIncVat\\\":\\\"500.00\\\"}]\"', 'afa', NULL, NULL, 'invoices/inv000020.pdf', 'complete', 450.00, 500.00, 0.00, 500.00, 'in', '2024-07-01 05:01:53', '2024-07-01 05:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_categories`
--

CREATE TABLE `invoice_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_categories`
--

INSERT INTO `invoice_categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Test Category', 2, '2024-06-30 09:58:15', '2024-06-30 09:58:15'),
(2, 'another category', 2, '2024-06-30 10:03:56', '2024-06-30 10:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_settings`
--

CREATE TABLE `invoice_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_person_name` varchar(255) NOT NULL,
  `emails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`emails`)),
  `phones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`phones`)),
  `base_currency_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `social_media_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_media_links`)),
  `sender_references` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sender_references`)),
  `invoice_created_by` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `watermark_logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_settings`
--

INSERT INTO `invoice_settings` (`id`, `user_id`, `company_person_name`, `emails`, `phones`, `base_currency_id`, `address`, `website`, `social_media_links`, `sender_references`, `invoice_created_by`, `logo_path`, `watermark_logo_path`, `created_at`, `updated_at`) VALUES
(1, 2, 'Personal', '[\"personal@gmail.com\"]', '[\"01521109057\"]', 1, 'Dhaka', NULL, NULL, '[{\"name\":\"arnab\",\"email\":\"aranb@gmail.com\",\"phone\":\"01681961483\"}]', 'User', 'logos/1719833009.png', 'watermark_logos/1719762364.png', '2024-06-30 09:46:04', '2024-07-01 05:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'English', NULL, NULL),
(2, 'Spanish', NULL, NULL),
(3, 'French', NULL, NULL),
(4, 'German', NULL, NULL),
(5, 'Chinese', NULL, NULL),
(6, 'Japanese', NULL, NULL),
(7, 'Korean', NULL, NULL),
(8, 'Portuguese', NULL, NULL),
(9, 'Russian', NULL, NULL),
(10, 'Italian', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_31_102257_create_services_table', 1),
(6, '2024_05_31_102332_create_packages_table', 1),
(7, '2024_06_02_091449_create_user_services_table', 1),
(8, '2024_06_05_143930_create_package_user_table', 1),
(9, '2024_06_05_175021_create_corporate_users_table', 1),
(10, '2024_06_09_125310_create_countries_table', 1),
(11, '2024_06_09_125425_create_currencies_table', 1),
(12, '2024_06_10_092536_create_languages_table', 1),
(13, '2024_06_10_092621_create_customers_table', 1),
(14, '2024_06_10_092656_create_references_table', 1),
(15, '2024_06_10_092745_create_delivery_requirements_table', 1),
(16, '2024_06_10_092910_create_payment_requirements_table', 1),
(17, '2024_06_11_221736_add_customer_id_to_payment_requirements_table', 1),
(18, '2024_06_12_185447_create_invoice_settings_table', 1),
(19, '2024_06_14_210350_modify_sender_references_in_invoice_settings_table', 1),
(20, '2024_06_16_201500_create_categories_table', 1),
(21, '2024_06_16_201536_create_subcategories_table', 1),
(22, '2024_06_17_201537_create_products_table', 1),
(23, '2024_06_21_090314_sender_references_table', 1),
(24, '2024_06_23_123222_create_invoice_categories_table', 1),
(25, '2024_06_23_171000_create_payment_gateways_table', 1),
(26, '2024_06_23_171001_create_payments_table', 1),
(27, '2024_06_23_171049_create_transactions_table', 1),
(28, '2024_06_24_164055_create_invoices_table', 1),
(29, '2024_06_28_200742_add_file_path_to_invoices_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `service_id`, `image`, `name`, `description`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 1, 'packages/1719762285.png', 'free', '', NULL, NULL, '2024-06-30 09:44:45', '2024-06-30 09:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `package_user`
--

CREATE TABLE `package_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_gateway_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `total_received` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_sent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `payment_gateway_id`, `account_name`, `account_number`, `total_received`, `total_sent`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Tahmim', '1232515', 0.00, 0.00, '2024-07-01 05:21:21', '2024-07-01 05:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test gateway', 2, '2024-06-30 09:54:29', '2024-06-30 09:54:29'),
(2, 'Paypal', 2, '2024-07-01 05:21:11', '2024-07-01 05:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `payment_requirements`
--

CREATE TABLE `payment_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `terms_of_payment` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `pay_to_account` varchar(255) NOT NULL,
  `customer_discount` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price_including_vat` decimal(10,2) DEFAULT NULL,
  `price_excluding_vat` decimal(10,2) DEFAULT NULL,
  `instock` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `subcategory_id`, `price_including_vat`, `price_excluding_vat`, `instock`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Rice', 1, 1, 500.00, 450.00, 50, 2, '2024-06-30 10:23:09', '2024-06-30 10:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sender_references`
--

CREATE TABLE `sender_references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_setting_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sender_references`
--

INSERT INTO `sender_references` (`id`, `invoice_setting_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(5, 1, 'arnab', 'aranb@gmail.com', NULL, '2024-07-01 05:23:30', '2024-07-01 05:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `cover_image`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'cover_images/1719762285.png', 'Invoice System', 'Manage invoices, products, and customers.', '2024-06-30 09:43:49', '2024-06-30 09:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'test sub', '2024-06-30 10:22:28', '2024-06-30 10:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `additional_email` varchar(255) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `additional_email`, `postal_code`, `zip_code`, `country`, `city`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '1234567890', '2024-06-30 09:43:48', '$2y$12$4DDxWDFebOEKeQJqrIBjJe4huX9GN/t2tkc83ZmkCYqrJonivYXyi', 'admin', NULL, NULL, NULL, NULL, NULL, 'KH0szsLPD2Xs0Z0IHKNWk73oJZxH8Tcb8ivplpYY6RSdcqqyAt9WRsnb6SRM', '2024-06-30 09:43:49', '2024-06-30 09:43:49'),
(2, 'User', 'user@user.com', '0987654321', '2024-06-30 09:43:49', '$2y$12$bET4kI.mtu.2lxcXZ1ydLui0XqI1XpikErPznjyJth1xco2kzHfZW', 'user', NULL, NULL, NULL, NULL, NULL, '9TWPKK3oe6', '2024-06-30 09:43:49', '2024-06-30 09:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_services`
--

CREATE TABLE `user_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `registration_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_services`
--

INSERT INTO `user_services` (`id`, `user_id`, `service_id`, `package_id`, `registration_type`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'personal', '2024-06-30 09:45:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `corporate_users`
--
ALTER TABLE `corporate_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_country_id_foreign` (`country_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_no_unique` (`customer_no`),
  ADD KEY `customers_country_id_foreign` (`country_id`),
  ADD KEY `customers_language_id_foreign` (`language_id`),
  ADD KEY `customers_currency_id_foreign` (`currency_id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `delivery_requirements`
--
ALTER TABLE `delivery_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_requirements_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_id_unique` (`invoice_id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `invoices_invoice_category_id_foreign` (`invoice_category_id`),
  ADD KEY `invoices_invoice_setting_id_foreign` (`invoice_setting_id`);

--
-- Indexes for table `invoice_categories`
--
ALTER TABLE `invoice_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_settings_user_id_foreign` (`user_id`),
  ADD KEY `invoice_settings_base_currency_id_foreign` (`base_currency_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_service_id_foreign` (`service_id`);

--
-- Indexes for table `package_user`
--
ALTER TABLE `package_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_user_package_id_foreign` (`package_id`),
  ADD KEY `package_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_payment_gateway_id_foreign` (`payment_gateway_id`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateways_user_id_foreign` (`user_id`);

--
-- Indexes for table `payment_requirements`
--
ALTER TABLE `payment_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_requirements_user_id_foreign` (`user_id`),
  ADD KEY `payment_requirements_customer_id_foreign` (`customer_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `references_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sender_references`
--
ALTER TABLE `sender_references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_references_invoice_setting_id_foreign` (`invoice_setting_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_user_id_foreign` (`user_id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_services`
--
ALTER TABLE `user_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_services_user_id_foreign` (`user_id`),
  ADD KEY `user_services_service_id_foreign` (`service_id`),
  ADD KEY `user_services_package_id_foreign` (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `corporate_users`
--
ALTER TABLE `corporate_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_requirements`
--
ALTER TABLE `delivery_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoice_categories`
--
ALTER TABLE `invoice_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_user`
--
ALTER TABLE `package_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_requirements`
--
ALTER TABLE `payment_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sender_references`
--
ALTER TABLE `sender_references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_services`
--
ALTER TABLE `user_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `corporate_users`
--
ALTER TABLE `corporate_users`
  ADD CONSTRAINT `corporate_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `customers_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `customers_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `delivery_requirements`
--
ALTER TABLE `delivery_requirements`
  ADD CONSTRAINT `delivery_requirements_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_invoice_category_id_foreign` FOREIGN KEY (`invoice_category_id`) REFERENCES `invoice_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_invoice_setting_id_foreign` FOREIGN KEY (`invoice_setting_id`) REFERENCES `invoice_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_categories`
--
ALTER TABLE `invoice_categories`
  ADD CONSTRAINT `invoice_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  ADD CONSTRAINT `invoice_settings_base_currency_id_foreign` FOREIGN KEY (`base_currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `invoice_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_user`
--
ALTER TABLE `package_user`
  ADD CONSTRAINT `package_user_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_payment_gateway_id_foreign` FOREIGN KEY (`payment_gateway_id`) REFERENCES `payment_gateways` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD CONSTRAINT `payment_gateways_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_requirements`
--
ALTER TABLE `payment_requirements`
  ADD CONSTRAINT `payment_requirements_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_requirements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `references`
--
ALTER TABLE `references`
  ADD CONSTRAINT `references_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `sender_references`
--
ALTER TABLE `sender_references`
  ADD CONSTRAINT `sender_references_invoice_setting_id_foreign` FOREIGN KEY (`invoice_setting_id`) REFERENCES `invoice_settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subcategories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_services`
--
ALTER TABLE `user_services`
  ADD CONSTRAINT `user_services_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
