-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 07:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\Brand', 'created', 5, 'App\\Models\\User', 7, '{\"attributes\":{\"bra_name\":\"Sadas\"}}', NULL, '2022-02-03 05:30:11', '2022-02-03 05:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bra_user_id` int(11) UNSIGNED NOT NULL,
  `bra_id` int(11) UNSIGNED NOT NULL,
  `bra_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `bra_browser_info` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bra_ip_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bra_created_at` timestamp NULL DEFAULT current_timestamp(),
  `bra_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bra_user_id`, `bra_id`, `bra_name`, `bra_browser_info`, `bra_ip_address`, `bra_created_at`, `bra_updated_at`) VALUES
(1, 1, 'Oppo', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '127.0.0.1', '2022-01-15 06:41:24', '2022-01-15 06:41:24'),
(7, 2, 'Hello', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '127.0.0.1', '2022-01-24 07:08:58', '2022-01-24 07:08:58'),
(7, 3, 'SuperMax', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '127.0.0.1', '2022-01-24 07:16:56', '2022-01-24 07:16:56'),
(7, 4, 'Fdsaf', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '127.0.0.1', '2022-01-24 07:20:24', '2022-01-24 07:20:24'),
(7, 5, 'Sadas', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', '127.0.0.1', '2022-02-03 10:30:11', '2022-02-03 10:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `cash_account`
--

CREATE TABLE `cash_account` (
  `ca_ip_address` varchar(250) DEFAULT NULL,
  `ca_browser_info` varchar(250) DEFAULT NULL,
  `ca_id` int(11) UNSIGNED NOT NULL,
  `ca_user_id` int(11) UNSIGNED NOT NULL,
  `ca_name` varchar(500) DEFAULT NULL,
  `ca_balance` int(11) NOT NULL,
  `ca_created_at` timestamp NULL DEFAULT current_timestamp(),
  `ca_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_account`
--

INSERT INTO `cash_account` (`ca_ip_address`, `ca_browser_info`, `ca_id`, `ca_user_id`, `ca_name`, `ca_balance`, `ca_created_at`, `ca_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 1, 'Meezan', 60889, '2022-01-15 07:36:57', '2022-01-15 02:36:57'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 7, 'Jazz Cash', 12640, '2022-01-22 07:13:21', '2022-01-22 02:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `cash_book`
--

CREATE TABLE `cash_book` (
  `cb_user_id` int(11) UNSIGNED NOT NULL,
  `cb_id` int(11) UNSIGNED NOT NULL,
  `cb_ca_id` int(11) UNSIGNED NOT NULL,
  `cb_jrv_id` int(11) UNSIGNED DEFAULT NULL,
  `cb_job_id` int(11) UNSIGNED DEFAULT NULL,
  `cb_jpv_id` int(11) UNSIGNED DEFAULT NULL,
  `cb_type` varchar(250) DEFAULT NULL,
  `cb_type_id` int(25) DEFAULT NULL,
  `cb_in` int(11) DEFAULT NULL,
  `cb_out` int(11) DEFAULT NULL,
  `cb_credit` int(11) DEFAULT NULL,
  `cb_total` int(11) NOT NULL,
  `cb_ip_address` varchar(250) DEFAULT NULL,
  `cb_browser_info` varchar(250) DEFAULT NULL,
  `cb_created_at` timestamp NULL DEFAULT current_timestamp(),
  `cb_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_book`
--

INSERT INTO `cash_book` (`cb_user_id`, `cb_id`, `cb_ca_id`, `cb_jrv_id`, `cb_job_id`, `cb_jpv_id`, `cb_type`, `cb_type_id`, `cb_in`, `cb_out`, `cb_credit`, `cb_total`, `cb_ip_address`, `cb_browser_info`, `cb_created_at`, `cb_updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, 'Opening_Stock', 1, 53000, NULL, NULL, 53000, NULL, NULL, '2022-01-15 07:36:57', NULL),
(1, 2, 1, NULL, 1, NULL, 'Job Invoice', 1, 1000, NULL, NULL, 54000, NULL, NULL, '2022-01-15 07:37:14', NULL),
(1, 3, 1, NULL, 1, NULL, 'Job Invoice', 2, 88, NULL, NULL, 54088, NULL, NULL, '2022-01-15 07:37:33', NULL),
(1, 4, 1, NULL, NULL, NULL, 'Sale_Invoice', 1, 2018, NULL, NULL, 56106, NULL, NULL, '2022-01-15 07:53:25', NULL),
(1, 5, 1, NULL, NULL, NULL, 'Purchase_Invoice', 1, NULL, 45, NULL, 56061, NULL, NULL, '2022-01-15 08:03:32', NULL),
(1, 6, 1, NULL, NULL, NULL, 'Sale_Invoice', 2, 138, NULL, NULL, 56199, NULL, NULL, '2022-01-15 11:05:18', NULL),
(1, 7, 1, NULL, NULL, NULL, 'Purchase_Invoice', 4, NULL, 227, NULL, 55972, NULL, NULL, '2022-01-15 11:09:30', NULL),
(2, 8, 1, NULL, NULL, NULL, 'Sale_Invoice', 3, 405, NULL, NULL, 56377, NULL, NULL, '2022-01-17 09:02:53', NULL),
(2, 9, 1, NULL, NULL, NULL, 'Job Invoice', 3, 800, NULL, NULL, 57177, NULL, NULL, '2022-01-17 09:57:26', NULL),
(2, 10, 1, NULL, NULL, NULL, 'Sale_Invoice', 4, 300, NULL, NULL, 57477, NULL, NULL, '2022-01-17 09:58:47', NULL),
(2, 11, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 4, 1000, NULL, NULL, 58477, NULL, NULL, '2022-01-17 10:03:38', NULL),
(2, 12, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 5, 18, NULL, NULL, 58495, NULL, NULL, '2022-01-17 10:04:48', NULL),
(2, 13, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 6, 100, NULL, NULL, 58595, NULL, NULL, '2022-01-17 10:06:49', NULL),
(2, 14, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 7, 200, NULL, NULL, 58795, NULL, NULL, '2022-01-17 10:08:49', NULL),
(2, 15, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 8, 490, NULL, NULL, 59285, NULL, NULL, '2022-01-17 11:44:53', NULL),
(2, 16, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 9, 90, NULL, NULL, 59375, NULL, NULL, '2022-01-17 11:46:16', NULL),
(2, 17, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 10, 400, NULL, NULL, 59775, NULL, NULL, '2022-01-17 11:47:22', NULL),
(2, 18, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 11, 400, NULL, NULL, 60175, NULL, NULL, '2022-01-17 11:50:02', NULL),
(2, 19, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 13, 10, NULL, NULL, 60185, NULL, NULL, '2022-01-17 12:19:35', NULL),
(2, 20, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 14, 100, NULL, NULL, 60285, NULL, NULL, '2022-01-17 12:22:14', NULL),
(2, 21, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 15, 450, NULL, NULL, 60735, NULL, NULL, '2022-01-17 12:23:09', NULL),
(2, 22, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 16, 10, NULL, NULL, 60745, NULL, NULL, '2022-01-17 12:23:43', NULL),
(2, 23, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 17, 50, NULL, NULL, 60795, NULL, NULL, '2022-01-17 12:24:04', NULL),
(2, 24, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 18, 8, NULL, NULL, 60803, NULL, NULL, '2022-01-18 06:19:22', NULL),
(2, 25, 1, NULL, NULL, NULL, 'Credit Purchase Invoice', 2, NULL, 20, NULL, 60783, NULL, NULL, '2022-01-18 06:58:03', NULL),
(2, 26, 1, NULL, NULL, NULL, 'Credit Purchase Invoice', 3, NULL, 99, NULL, 60684, NULL, NULL, '2022-01-18 07:03:54', NULL),
(2, 27, 1, NULL, NULL, NULL, 'Credit Sale Invoice', 19, 5, NULL, NULL, 60689, NULL, NULL, '2022-01-18 07:04:37', NULL),
(7, 28, 2, NULL, NULL, NULL, 'Opening_Stock', 2, 4540, NULL, NULL, 4540, NULL, NULL, '2022-01-22 07:13:21', NULL),
(7, 29, 1, NULL, 1, NULL, 'Job Invoice', 5, 200, NULL, NULL, 60889, NULL, NULL, '2022-01-24 12:29:28', NULL),
(7, 30, 2, NULL, 1, NULL, 'Job Invoice', 6, 100, NULL, NULL, 4640, NULL, NULL, '2022-01-24 12:36:37', NULL),
(7, 31, 2, NULL, NULL, NULL, 'Cash_Receipt', 1, 1000, NULL, NULL, 5640, NULL, NULL, '2022-01-25 10:44:10', NULL),
(7, 32, 2, NULL, NULL, NULL, 'Cash_Payment', 1, NULL, 200, NULL, 5440, NULL, NULL, '2022-01-25 10:48:32', NULL),
(7, 33, 2, NULL, NULL, NULL, 'Sale_Invoice', 5, 8000, NULL, NULL, 13440, NULL, NULL, '2022-01-25 11:00:15', NULL),
(7, 34, 2, NULL, NULL, NULL, 'Purchase_Invoice', 5, NULL, 800, NULL, 12640, NULL, NULL, '2022-01-25 11:00:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_payment_voucher`
--

CREATE TABLE `cash_payment_voucher` (
  `jpv_ip_address` varchar(250) DEFAULT NULL,
  `jpv_browser_info` varchar(250) DEFAULT NULL,
  `jpv_id` int(11) UNSIGNED NOT NULL,
  `jpv_user_id` int(11) UNSIGNED NOT NULL,
  `jpv_recieve_datetime` timestamp NULL DEFAULT current_timestamp(),
  `jpv_job_no` int(11) UNSIGNED DEFAULT NULL,
  `jpv_cash_account` int(11) NOT NULL,
  `jpv_deliver_to` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jpv_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jpv_amount` int(11) NOT NULL,
  `jpv_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jpv_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_payment_voucher`
--

INSERT INTO `cash_payment_voucher` (`jpv_ip_address`, `jpv_browser_info`, `jpv_id`, `jpv_user_id`, `jpv_recieve_datetime`, `jpv_job_no`, `jpv_cash_account`, `jpv_deliver_to`, `jpv_remarks`, `jpv_amount`, `jpv_created_at`, `jpv_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 1, 7, '2022-01-25 10:48:32', NULL, 2, 'nabeel', 'gasfg', 200, '2022-01-25 10:48:32', '2022-01-25 05:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `cash_receipt_voucher`
--

CREATE TABLE `cash_receipt_voucher` (
  `jrv_ip_address` varchar(250) DEFAULT NULL,
  `jrv_browser_info` varchar(250) DEFAULT NULL,
  `jrv_id` int(11) UNSIGNED NOT NULL,
  `jrv_user_id` int(11) UNSIGNED NOT NULL,
  `jrv_recieve_datetime` timestamp NULL DEFAULT current_timestamp(),
  `jrv_job_no` int(11) UNSIGNED DEFAULT NULL,
  `jrv_cash_account` int(11) NOT NULL,
  `jrv_recieved_by` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `jrv_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `jrv_amount` int(11) NOT NULL,
  `jrv_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jrv_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_receipt_voucher`
--

INSERT INTO `cash_receipt_voucher` (`jrv_ip_address`, `jrv_browser_info`, `jrv_id`, `jrv_user_id`, `jrv_recieve_datetime`, `jrv_job_no`, `jrv_cash_account`, `jrv_recieved_by`, `jrv_remarks`, `jrv_amount`, `jrv_created_at`, `jrv_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 1, 7, '2022-01-25 10:44:10', NULL, 2, 'ali', 'hjbknj', 1000, '2022-01-25 10:44:10', '2022-01-25 05:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_ip_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_browser_info` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_id` int(11) UNSIGNED NOT NULL,
  `cat_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_bra_id` int(10) UNSIGNED DEFAULT NULL,
  `cat_user_id` int(11) UNSIGNED DEFAULT NULL,
  `cat_created_at` timestamp NULL DEFAULT current_timestamp(),
  `cat_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_ip_address`, `cat_browser_info`, `cat_id`, `cat_name`, `cat_bra_id`, `cat_user_id`, `cat_created_at`, `cat_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 'mobile', 1, 7, '2022-01-24 07:03:41', '2022-01-24 02:03:41'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 'ups', 1, 7, '2022-01-24 07:04:03', '2022-01-24 02:04:03'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 'website', 1, 7, '2022-01-24 07:04:24', '2022-01-24 02:04:24'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 'mobile', 2, 7, '2022-01-24 07:09:11', '2022-01-24 02:09:11'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 'ups', 2, 7, '2022-01-24 07:21:01', '2022-01-24 02:21:01'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 6, 'gogo', 2, 7, '2022-01-24 07:23:01', '2022-01-24 02:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cli_ip_address` varchar(250) DEFAULT NULL,
  `cli_browser_info` varchar(250) DEFAULT NULL,
  `cli_id` int(11) UNSIGNED NOT NULL,
  `cli_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `cli_user_id` int(11) UNSIGNED NOT NULL,
  `cli_number` varchar(255) DEFAULT NULL,
  `cli_address` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `cli_remarks` varchar(250) DEFAULT NULL,
  `cli_created_at` timestamp NULL DEFAULT current_timestamp(),
  `cli_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cli_ip_address`, `cli_browser_info`, `cli_id`, `cli_name`, `cli_user_id`, `cli_number`, `cli_address`, `cli_remarks`, `cli_created_at`, `cli_updated_at`) VALUES
(NULL, NULL, 1, 'Nabeel', 1, '0320-2305303', NULL, NULL, '2022-01-15 07:35:46', NULL),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 'Nabeel', 7, '3123-2131241', 'gulgasht', NULL, '2022-01-15 09:32:40', '2022-01-22 07:46:20'),
(NULL, NULL, 3, 'Dasf', 7, '2132-1321321', 'dera adda', NULL, '2022-01-24 07:54:41', NULL),
(NULL, NULL, 4, 'Nabeel', 7, NULL, NULL, NULL, '2022-02-03 10:08:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_purchase_invoice`
--

CREATE TABLE `credit_purchase_invoice` (
  `cpi_id` int(11) NOT NULL,
  `cpi_pi_id` int(11) DEFAULT NULL,
  `cpi_user_id` int(11) DEFAULT NULL,
  `cpi_remarks` varchar(250) DEFAULT NULL,
  `cpi_cash_account` int(11) DEFAULT NULL,
  `cpi_party_id` int(11) DEFAULT NULL,
  `cpi_real_estimated_cost` int(200) DEFAULT NULL,
  `cpi_estimated_cost` int(200) DEFAULT NULL,
  `cpi_amount_paid` int(200) DEFAULT NULL,
  `cpi_remaining_cost` int(200) DEFAULT NULL,
  `cpi_discount` int(200) DEFAULT NULL,
  `cpi_status` varchar(200) NOT NULL,
  `cpi_ip_address` varchar(200) DEFAULT NULL,
  `cpi_browser_info` varchar(200) DEFAULT NULL,
  `cpi_created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_purchase_invoice`
--

INSERT INTO `credit_purchase_invoice` (`cpi_id`, `cpi_pi_id`, `cpi_user_id`, `cpi_remarks`, `cpi_cash_account`, `cpi_party_id`, `cpi_real_estimated_cost`, `cpi_estimated_cost`, `cpi_amount_paid`, `cpi_remaining_cost`, `cpi_discount`, `cpi_status`, `cpi_ip_address`, `cpi_browser_info`, `cpi_created_at`) VALUES
(1, 4, 1, NULL, 1, NULL, 227, 220, 7, 220, 0, '', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', NULL),
(2, 4, 2, 'yguyg', 1, 1, 227, 220, 20, 199, 1, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', NULL),
(3, 4, 2, 'dfhfd', 1, 1, 227, 199, 99, 100, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', NULL),
(4, 5, 7, NULL, 2, 2, 800, 0, 800, 0, 0, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_sale_invoice`
--

CREATE TABLE `credit_sale_invoice` (
  `csi_id` int(11) NOT NULL,
  `csi_si_id` int(11) DEFAULT NULL,
  `csi_user_id` int(11) DEFAULT NULL,
  `csi_remarks` varchar(250) DEFAULT NULL,
  `csi_cash_account` int(11) DEFAULT NULL,
  `csi_party_id` int(11) DEFAULT NULL,
  `csi_real_estimated_cost` int(200) DEFAULT NULL,
  `csi_estimated_cost` int(200) DEFAULT NULL,
  `csi_amount_paid` int(200) DEFAULT NULL,
  `csi_remaining_cost` int(200) DEFAULT NULL,
  `csi_discount` int(200) DEFAULT NULL,
  `csi_status` varchar(200) NOT NULL,
  `csi_ip_address` varchar(250) DEFAULT NULL,
  `csi_browser_info` varchar(250) DEFAULT NULL,
  `csi_created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_sale_invoice`
--

INSERT INTO `credit_sale_invoice` (`csi_id`, `csi_si_id`, `csi_user_id`, `csi_remarks`, `csi_cash_account`, `csi_party_id`, `csi_real_estimated_cost`, `csi_estimated_cost`, `csi_amount_paid`, `csi_remaining_cost`, `csi_discount`, `csi_status`, `csi_ip_address`, `csi_browser_info`, `csi_created_at`) VALUES
(1, 2, 1, 'dfgafsg', 1, NULL, 138, 100, 38, 100, 0, '', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 11:05:18'),
(2, 3, 2, 'sggfdsg', 1, NULL, 405, 355, 50, 355, 0, '', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 09:02:53'),
(3, 4, 2, NULL, 1, 1, 308, 8, 300, 8, 0, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 09:58:47'),
(4, 1, 2, NULL, 1, 1, 2018, 1818, 1000, 818, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 10:03:38'),
(5, 1, 2, NULL, 1, 1, 2018, 818, 18, 800, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 10:04:48'),
(6, 1, 2, NULL, 1, 1, 2018, 800, 100, 700, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 10:06:49'),
(7, 1, 2, NULL, 1, 1, 2018, 700, 200, 490, 10, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 10:08:49'),
(8, 1, 2, NULL, 1, 1, 2018, 490, 490, 0, NULL, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 11:44:53'),
(9, 1, 2, NULL, 1, 1, 2018, 490, 90, 400, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 11:46:16'),
(10, 1, 2, NULL, 1, 1, 2018, 400, 400, 0, NULL, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 11:47:22'),
(11, 1, 2, NULL, 1, 1, 2018, 400, 400, 0, NULL, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 11:50:02'),
(13, 2, 2, NULL, 1, 1, 138, 100, 10, 90, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 12:19:35'),
(14, 2, 2, NULL, 1, 1, 138, 90, 100, -10, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 12:22:14'),
(15, 2, 2, NULL, 1, 1, 138, -10, 450, -460, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 12:23:09'),
(16, 2, 2, NULL, 1, 1, 138, -460, 10, -470, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 12:23:43'),
(17, 2, 2, NULL, 1, 1, 138, -470, 50, -520, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 12:24:04'),
(18, 4, 2, NULL, 1, 1, 308, 8, 8, 0, NULL, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-18 06:19:22'),
(19, 3, 2, '.kjbjk', 1, 1, 405, 355, 5, 350, NULL, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-18 07:04:37'),
(20, 5, 7, NULL, 2, 2, 8000, 0, 8000, 0, 0, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', '2022-01-25 11:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_versions`
--

CREATE TABLE `estimate_versions` (
  `ev_user_id` int(11) UNSIGNED NOT NULL,
  `ev_id` int(11) UNSIGNED NOT NULL,
  `ev_job_no` int(11) UNSIGNED NOT NULL,
  `ev_old_estimate_version` int(11) DEFAULT NULL,
  `ev_new_estimate_version` int(11) DEFAULT NULL,
  `ev_reason` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `ev_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ev_ip_address` varchar(250) DEFAULT NULL,
  `ev_browser_info` varchar(250) DEFAULT NULL,
  `ev_created_at` timestamp NULL DEFAULT current_timestamp(),
  `ev_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimate_versions`
--

INSERT INTO `estimate_versions` (`ev_user_id`, `ev_id`, `ev_job_no`, `ev_old_estimate_version`, `ev_new_estimate_version`, `ev_reason`, `ev_remarks`, `ev_ip_address`, `ev_browser_info`, `ev_created_at`, `ev_updated_at`) VALUES
(7, 1, 2, 1200, 1400, 'bs aisa hi', '.kjbjkbujk', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-24 10:40:24', '2022-01-24 10:40:24');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser_info` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_parts_to_job`
--

CREATE TABLE `issue_parts_to_job` (
  `iptj_ip_address` varchar(250) DEFAULT NULL,
  `iptj_browser_info` varchar(250) DEFAULT NULL,
  `iptj_id` int(11) UNSIGNED NOT NULL,
  `iptj_user_id` int(11) UNSIGNED NOT NULL,
  `iptj_job_no` int(11) UNSIGNED NOT NULL,
  `iptj_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `iptj_status` varchar(500) NOT NULL,
  `iptj_created_at` timestamp NULL DEFAULT current_timestamp(),
  `iptj_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_parts_to_job`
--

INSERT INTO `issue_parts_to_job` (`iptj_ip_address`, `iptj_browser_info`, `iptj_id`, `iptj_user_id`, `iptj_job_no`, `iptj_remarks`, `iptj_status`, `iptj_created_at`, `iptj_updated_at`) VALUES
(NULL, NULL, 1, 1, 2, NULL, 'Issued', '2022-01-15 09:33:13', NULL),
(NULL, NULL, 2, 7, 2, NULL, 'Issued', '2022-01-24 08:24:35', NULL),
(NULL, NULL, 3, 7, 2, NULL, 'Issued', '2022-01-24 08:25:20', NULL),
(NULL, NULL, 4, 7, 2, NULL, 'Issued', '2022-01-24 09:28:42', NULL),
(NULL, NULL, 5, 7, 2, NULL, 'Issued', '2022-01-24 10:10:44', NULL),
(NULL, NULL, 6, 7, 2, NULL, 'Issued', '2022-01-24 10:10:59', NULL),
(NULL, NULL, 7, 7, 2, NULL, 'Issued', '2022-01-24 10:12:30', NULL),
(NULL, NULL, 8, 7, 2, NULL, 'Returned', '2022-01-24 10:32:49', NULL),
(NULL, NULL, 9, 7, 4, NULL, 'Issued', '2022-01-25 07:40:52', NULL),
(NULL, NULL, 10, 7, 4, NULL, 'Issued', '2022-01-25 07:42:30', NULL),
(NULL, NULL, 11, 7, 4, NULL, 'Returned', '2022-01-25 07:43:22', NULL),
(NULL, NULL, 12, 7, 3, NULL, 'Issued', '2022-01-25 11:16:36', NULL),
(NULL, NULL, 13, 7, 3, NULL, 'Issued', '2022-01-25 11:20:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issue_parts_to_job_items`
--

CREATE TABLE `issue_parts_to_job_items` (
  `iptji_id` int(11) UNSIGNED NOT NULL,
  `iptji_user_id` int(11) UNSIGNED NOT NULL,
  `iptji_iptj_id` int(11) UNSIGNED NOT NULL,
  `iptji_parts` varchar(250) NOT NULL,
  `iptji_qty` int(11) NOT NULL,
  `iptji_rate` decimal(50,2) DEFAULT NULL,
  `iptji_amount` decimal(50,2) DEFAULT NULL,
  `iptji_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `iptji_updated_at` timestamp NULL DEFAULT NULL,
  `iptji_ip_address` varchar(250) DEFAULT NULL,
  `iptji_browser_info` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_parts_to_job_items`
--

INSERT INTO `issue_parts_to_job_items` (`iptji_id`, `iptji_user_id`, `iptji_iptj_id`, `iptji_parts`, `iptji_qty`, `iptji_rate`, `iptji_amount`, `iptji_created_at`, `iptji_updated_at`, `iptji_ip_address`, `iptji_browser_info`) VALUES
(1, 1, 1, '1', 12, '3.00', '36.00', '2022-01-15 09:33:13', NULL, NULL, NULL),
(2, 7, 2, '1', 1, '3.00', '3.00', '2022-01-24 08:24:35', NULL, NULL, NULL),
(3, 7, 3, '1', -1, '3.00', '-3.00', '2022-01-24 08:25:21', NULL, NULL, NULL),
(4, 7, 4, '2', -45, '10.00', '-450.00', '2022-01-24 09:28:42', NULL, NULL, NULL),
(5, 7, 5, '2', 12, '10.00', '120.00', '2022-01-24 10:10:44', NULL, NULL, NULL),
(6, 7, 6, '1', 45, '3.00', '135.00', '2022-01-24 10:10:59', NULL, NULL, NULL),
(7, 7, 7, '1', 1, '3.00', '3.00', '2022-01-24 10:12:30', NULL, NULL, NULL),
(8, 7, 8, '1', 4, '3.00', '12.00', '2022-01-24 10:32:49', NULL, NULL, NULL),
(9, 7, 9, '1', 5, '3.00', '15.00', '2022-01-25 07:40:52', NULL, NULL, NULL),
(10, 7, 10, '5', 2, '10.00', '20.00', '2022-01-25 07:42:30', NULL, NULL, NULL),
(11, 7, 11, '1', 2, '3.00', '6.00', '2022-01-25 07:43:22', NULL, NULL, NULL),
(12, 7, 12, '1', 12, '3.00', '36.00', '2022-01-25 11:16:36', NULL, NULL, NULL),
(13, 7, 13, '3', 20, '10.00', '200.00', '2022-01-25 11:20:35', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_accessories`
--

CREATE TABLE `job_accessories` (
  `ja_user_id` int(11) UNSIGNED NOT NULL,
  `ja_id` int(11) UNSIGNED NOT NULL,
  `ja_ji_id` int(11) UNSIGNED NOT NULL,
  `ja_accessories` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ja_ip_address` varchar(250) DEFAULT NULL,
  `ja_browser_info` varchar(250) DEFAULT NULL,
  `ja_created_at` timestamp NULL DEFAULT current_timestamp(),
  `ja_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_close`
--

CREATE TABLE `job_close` (
  `jc_user_id` int(11) UNSIGNED NOT NULL,
  `jc_id` int(11) UNSIGNED NOT NULL,
  `jc_job_no` int(11) UNSIGNED NOT NULL,
  `jc_reason` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jc_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jc_ip_address` varchar(250) DEFAULT NULL,
  `jc_browser_info` varchar(250) DEFAULT NULL,
  `jc_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jc_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_close`
--

INSERT INTO `job_close` (`jc_user_id`, `jc_id`, `jc_job_no`, `jc_reason`, `jc_remarks`, `jc_ip_address`, `jc_browser_info`, `jc_created_at`, `jc_updated_at`) VALUES
(1, 1, 1, '1', NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 06:56:23', '2022-01-15 01:56:23'),
(1, 2, 1, '1', NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 07:36:17', '2022-01-15 02:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `job_close_reason`
--

CREATE TABLE `job_close_reason` (
  `jcr_ip_address` varchar(250) DEFAULT NULL,
  `jcr_browser_info` varchar(250) DEFAULT NULL,
  `jcr_id` int(11) UNSIGNED NOT NULL,
  `jcr_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jcr_user_id` int(11) UNSIGNED NOT NULL,
  `jcr_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jcr_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_close_reason`
--

INSERT INTO `job_close_reason` (`jcr_ip_address`, `jcr_browser_info`, `jcr_id`, `jcr_name`, `jcr_user_id`, `jcr_created_at`, `jcr_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 'complete', 1, '2022-01-15 06:42:02', '2022-01-15 01:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `job_complaint`
--

CREATE TABLE `job_complaint` (
  `jc_user_id` int(11) UNSIGNED NOT NULL,
  `jc_id` int(11) UNSIGNED NOT NULL,
  `jc_ji_id` int(11) UNSIGNED NOT NULL,
  `jc_complaint` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jc_ip_address` varchar(250) DEFAULT NULL,
  `jc_browser_info` varchar(250) DEFAULT NULL,
  `jc_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jc_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_hold`
--

CREATE TABLE `job_hold` (
  `jh_ip_address` varchar(250) DEFAULT NULL,
  `jh_browser_info` varchar(250) DEFAULT NULL,
  `jh_id` int(11) UNSIGNED NOT NULL,
  `jh_user_id` int(11) UNSIGNED NOT NULL,
  `jh_job_no` int(11) UNSIGNED NOT NULL,
  `jh_reason` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jh_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jh_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jh_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_hold`
--

INSERT INTO `job_hold` (`jh_ip_address`, `jh_browser_info`, `jh_id`, `jh_user_id`, `jh_job_no`, `jh_reason`, `jh_remarks`, `jh_created_at`, `jh_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 7, 2, '1', 'kjnkj', '2022-01-24 10:43:29', '2022-01-24 05:43:29'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 7, 2, '1', 'sfg dsgasdf gagsagdsa dsgasdg ds', '2022-01-24 10:54:34', '2022-01-24 05:54:34'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 7, 2, '1', 'fvsdfdsfadsfdsaf', '2022-01-24 10:57:31', '2022-01-24 05:57:31'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 7, 4, '1', 'sdq 3wrd fwqrewrweqr ewr', '2022-01-24 11:00:59', '2022-01-24 06:00:59'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 7, 4, '1', 'sgasdf', '2022-01-24 11:01:39', '2022-01-24 06:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `job_hold_reason`
--

CREATE TABLE `job_hold_reason` (
  `jhr_ip_address` varchar(250) DEFAULT NULL,
  `jhr_browser_info` varchar(250) DEFAULT NULL,
  `jhr_id` int(11) UNSIGNED NOT NULL,
  `jhr_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jhr_user_id` int(11) UNSIGNED NOT NULL,
  `jhr_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jhr_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_hold_reason`
--

INSERT INTO `job_hold_reason` (`jhr_ip_address`, `jhr_browser_info`, `jhr_id`, `jhr_name`, `jhr_user_id`, `jhr_created_at`, `jhr_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 'paisy khatam ho gai', 7, '2022-01-22 08:08:31', '2022-01-22 08:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `job_information`
--

CREATE TABLE `job_information` (
  `ji_ip_address` varchar(250) DEFAULT NULL,
  `ji_cli_id` int(11) UNSIGNED NOT NULL,
  `ji_browser_info` varchar(250) DEFAULT NULL,
  `ji_id` int(11) UNSIGNED NOT NULL,
  `ji_user_id` int(11) UNSIGNED NOT NULL,
  `ji_recieve_datetime` timestamp NULL DEFAULT current_timestamp(),
  `ji_delivery_datetime` timestamp NULL DEFAULT current_timestamp(),
  `ji_warranty_status` tinyint(1) DEFAULT 1,
  `ji_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ji_vendor` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ji_bra_id` int(11) UNSIGNED NOT NULL,
  `ji_cat_id` int(11) UNSIGNED NOT NULL,
  `ji_mod_id` int(11) UNSIGNED NOT NULL,
  `ji_equipment` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `ji_job_status` varchar(255) DEFAULT NULL,
  `ji_serial_no` int(11) NOT NULL,
  `ji_estimated_cost` int(111) DEFAULT NULL,
  `ji_remaining` int(11) DEFAULT NULL,
  `ji_amount_pay` int(11) DEFAULT NULL,
  `ji_discount` int(11) DEFAULT NULL,
  `ji_created_at` timestamp NULL DEFAULT current_timestamp(),
  `ji_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_information`
--

INSERT INTO `job_information` (`ji_ip_address`, `ji_cli_id`, `ji_browser_info`, `ji_id`, `ji_user_id`, `ji_recieve_datetime`, `ji_delivery_datetime`, `ji_warranty_status`, `ji_title`, `ji_vendor`, `ji_bra_id`, `ji_cat_id`, `ji_mod_id`, `ji_equipment`, `ji_job_status`, `ji_serial_no`, `ji_estimated_cost`, `ji_remaining`, `ji_amount_pay`, `ji_discount`, `ji_created_at`, `ji_updated_at`) VALUES
('127.0.0.1', 4, 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 1, 7, '2022-01-15 07:35:46', '2022-01-18 19:00:00', NULL, 'Oppo-mobile-a31-dsfdsf-6515', NULL, 1, 1, 1, 'dsfdsf', 'Credit', 6515, 2000, 500, 1500, NULL, '2022-01-15 07:35:46', '2022-02-03 10:13:39'),
(NULL, 2, NULL, 2, 1, '2022-01-15 09:32:40', '2022-01-26 19:00:00', NULL, 'Oppo-mobile-a31--3432', NULL, 1, 1, 1, NULL, 'Hold', 3432, 1400, 1200, 0, NULL, '2022-01-15 09:32:40', NULL),
(NULL, 3, NULL, 3, 7, '2022-01-24 07:54:41', '2022-01-26 19:00:00', 1, 'Hello-mobile-a31--3421', '1', 2, 4, 4, NULL, 'Assign', 3421, 1200, 1200, 0, NULL, '2022-01-24 07:54:41', NULL),
(NULL, 3, NULL, 4, 7, '2022-01-24 08:23:47', '2022-01-26 19:00:00', NULL, 'Oppo-mobile-a31--213213', NULL, 1, 1, 1, NULL, 'Assign', 213213, 345, 345, 0, NULL, '2022-01-24 08:23:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_information_items`
--

CREATE TABLE `job_information_items` (
  `jii_ip_address` varchar(250) DEFAULT NULL,
  `jii_browser_info` varchar(250) DEFAULT NULL,
  `jii_id` int(11) UNSIGNED NOT NULL,
  `jii_ji_id` int(11) UNSIGNED NOT NULL,
  `jii_user_id` int(11) UNSIGNED NOT NULL,
  `jii_item_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jii_status` varchar(255) DEFAULT NULL,
  `jii_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jii_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_information_items`
--

INSERT INTO `job_information_items` (`jii_ip_address`, `jii_browser_info`, `jii_id`, `jii_ji_id`, `jii_user_id`, `jii_item_name`, `jii_status`, `jii_created_at`, `jii_updated_at`) VALUES
(NULL, NULL, 3, 2, 1, 'asdsa', 'Complain', '2022-01-15 09:32:40', NULL),
(NULL, NULL, 4, 2, 1, 'erewr', 'Accessory', '2022-01-15 09:32:40', NULL),
(NULL, NULL, 5, 3, 7, 'asdsa', 'Complain', '2022-01-24 07:54:41', NULL),
(NULL, NULL, 6, 3, 7, 'erewr', 'Accessory', '2022-01-24 07:54:41', NULL),
(NULL, NULL, 7, 4, 7, 'd', 'Complain', '2022-01-24 08:23:47', NULL),
(NULL, NULL, 8, 4, 7, 'sadfasd', 'Accessory', '2022-01-24 08:23:47', NULL),
(NULL, NULL, 14, 1, 7, 'ac', 'Complain', '2022-02-03 10:13:39', NULL),
(NULL, NULL, 15, 1, 7, 'asdsa12', 'Complain', '2022-02-03 10:13:39', NULL),
(NULL, NULL, 16, 1, 7, 'asd', 'Accessory', '2022-02-03 10:13:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_issue_to_technician`
--

CREATE TABLE `job_issue_to_technician` (
  `jitt_ip_address` varchar(250) DEFAULT NULL,
  `jitt_browser_info` varchar(250) DEFAULT NULL,
  `jitt_id` int(11) UNSIGNED NOT NULL,
  `jitt_user_id` int(11) UNSIGNED NOT NULL,
  `jitt_job_no` int(11) UNSIGNED NOT NULL,
  `jitt_technician` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jitt_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jitt_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_issue_to_technician`
--

INSERT INTO `job_issue_to_technician` (`jitt_ip_address`, `jitt_browser_info`, `jitt_id`, `jitt_user_id`, `jitt_job_no`, `jitt_technician`, `jitt_created_at`, `jitt_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 1, 1, '1', '2022-01-15 07:36:03', '2022-01-15 02:36:03'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 1, 2, '2', '2022-01-15 09:33:02', '2022-01-15 04:33:02'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 7, 2, '2', '2022-01-24 10:54:13', '2022-01-24 05:54:13'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 7, 2, '2', '2022-01-24 10:57:18', '2022-01-24 05:57:18'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 7, 4, '6', '2022-01-24 11:00:47', '2022-01-24 06:00:47'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 6, 7, 3, '6', '2022-01-25 07:41:55', '2022-01-25 02:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `job_parts_return`
--

CREATE TABLE `job_parts_return` (
  `jpr_user_id` int(11) UNSIGNED NOT NULL,
  `jpr_id` int(11) UNSIGNED NOT NULL,
  `jpr_job_no` int(11) UNSIGNED NOT NULL,
  `jpr_reamrks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jpr_parts` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `jpr_qty` int(11) NOT NULL,
  `jpr_ip_address` varchar(250) DEFAULT NULL,
  `jpr_browser_info` varchar(250) DEFAULT NULL,
  `jpr_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jpr_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_reopen`
--

CREATE TABLE `job_reopen` (
  `jro_ip_address` varchar(250) DEFAULT NULL,
  `jro_browser_info` varchar(250) DEFAULT NULL,
  `jro_id` int(11) UNSIGNED NOT NULL,
  `jro_user_id` int(11) UNSIGNED NOT NULL,
  `jro_job_no` int(11) UNSIGNED NOT NULL,
  `jro_reason` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jro_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jro_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jro_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_reopen`
--

INSERT INTO `job_reopen` (`jro_ip_address`, `jro_browser_info`, `jro_id`, `jro_user_id`, `jro_job_no`, `jro_reason`, `jro_remarks`, `jro_created_at`, `jro_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 7, 2, 'thanks for comming', NULL, '2022-01-24 10:50:44', '2022-01-24 05:50:44'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 7, 2, 'dsafasd fsadf', NULL, '2022-01-24 10:55:08', '2022-01-24 05:55:08'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 7, 4, 'dsafasd fsadf', 'rwer wqe', '2022-01-24 11:01:10', '2022-01-24 06:01:10'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 7, 4, 'dsafasd fsadf', 'sdfds', '2022-01-24 11:01:49', '2022-01-24 06:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `job_transfer`
--

CREATE TABLE `job_transfer` (
  `jt_ip_address` varchar(250) DEFAULT NULL,
  `jt_browser_info` varchar(250) DEFAULT NULL,
  `jt_id` int(11) UNSIGNED NOT NULL,
  `jt_user_id` int(11) UNSIGNED NOT NULL,
  `jt_job_no` int(11) UNSIGNED DEFAULT NULL,
  `jt_technician` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `jt_new_technician` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `jitt_id` int(11) UNSIGNED DEFAULT NULL,
  `jt_created_at` timestamp NULL DEFAULT current_timestamp(),
  `jt_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_transfer`
--

INSERT INTO `job_transfer` (`jt_ip_address`, `jt_browser_info`, `jt_id`, `jt_user_id`, `jt_job_no`, `jt_technician`, `jt_new_technician`, `jitt_id`, `jt_created_at`, `jt_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 7, 2, '1', '2', NULL, '2022-01-24 10:33:09', '2022-01-24 05:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_table`
--

CREATE TABLE `model_table` (
  `mod_ip_address` varchar(250) DEFAULT NULL,
  `mod_browser_info` varchar(250) DEFAULT NULL,
  `mod_id` int(11) UNSIGNED NOT NULL,
  `mod_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `mod_user_id` int(11) UNSIGNED NOT NULL,
  `mod_cat_id` int(11) UNSIGNED NOT NULL,
  `mod_bra_id` int(11) UNSIGNED NOT NULL,
  `mod_created_at` timestamp NULL DEFAULT current_timestamp(),
  `mod_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model_table`
--

INSERT INTO `model_table` (`mod_ip_address`, `mod_browser_info`, `mod_id`, `mod_name`, `mod_user_id`, `mod_cat_id`, `mod_bra_id`, `mod_created_at`, `mod_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 'a31', 1, 1, 1, '2022-01-15 06:41:50', '2022-01-15 01:41:50'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 'go11', 7, 1, 1, '2022-01-24 07:09:29', '2022-01-24 02:09:29'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 'go11', 7, 4, 2, '2022-01-24 07:14:50', '2022-01-24 02:14:50'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 'a31', 7, 4, 2, '2022-01-24 07:28:00', '2022-01-24 02:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `par_ip_address` varchar(250) DEFAULT NULL,
  `par_browser_info` varchar(250) DEFAULT NULL,
  `par_id` int(11) UNSIGNED NOT NULL,
  `par_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `par_user_id` int(11) UNSIGNED NOT NULL,
  `par_purchase_price` int(11) NOT NULL,
  `par_bottom_price` int(11) NOT NULL,
  `par_sale_price` int(11) NOT NULL,
  `par_avg_price` int(11) DEFAULT NULL,
  `par_last_purchase_price` int(11) DEFAULT NULL,
  `par_status` varchar(200) DEFAULT NULL,
  `par_total_qty` int(11) DEFAULT NULL,
  `par_created_at` timestamp NULL DEFAULT current_timestamp(),
  `par_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`par_ip_address`, `par_browser_info`, `par_id`, `par_name`, `par_user_id`, `par_purchase_price`, `par_bottom_price`, `par_sale_price`, `par_avg_price`, `par_last_purchase_price`, `par_status`, `par_total_qty`, `par_created_at`, `par_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 'ups ic', 1, 3, 7, 9, NULL, NULL, 'Opening', 160, '2022-01-15 06:17:52', '2022-01-15 01:17:52'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 'Capacitor', 1, 10, 30, 40, NULL, NULL, 'Opening', 58180, '2022-01-15 07:51:26', '2022-01-15 02:51:26'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 'Hard Drive Disk', 7, 10, 30, 40, NULL, NULL, 'Opening', 495, '2022-01-22 07:19:08', '2022-01-22 07:19:30'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 'transistors', 7, 10, 150, 561, NULL, NULL, 'Opening', 0, '2022-01-24 12:12:10', '2022-01-24 07:12:10'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 'asdsad', 7, 10, 700, 123123, NULL, NULL, 'Opening', 154, '2022-01-24 13:39:09', '2022-01-24 08:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `party_id` int(11) NOT NULL,
  `party_name` varchar(200) NOT NULL,
  `party_number` varchar(200) NOT NULL,
  `party_address` varchar(200) DEFAULT NULL,
  `party_created_by` varchar(250) DEFAULT NULL,
  `party_ip_address` varchar(250) DEFAULT NULL,
  `party_browser_info` varchar(250) DEFAULT NULL,
  `party_created_at` timestamp NULL DEFAULT current_timestamp(),
  `party_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`party_id`, `party_name`, `party_number`, `party_address`, `party_created_by`, `party_ip_address`, `party_browser_info`, `party_created_at`, `party_updated_at`) VALUES
(1, 'Walk In Customer', '03115487895', 'cantt', '1', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 06:19:01', '2022-01-15 06:19:01'),
(2, 'Usman', '1313-1315315', 'not available in multan', '7', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-22 07:30:00', '2022-01-22 07:38:45');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `code`, `parent`, `level`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 'Admin Dashboard', 'web', NULL, NULL),
(2, 21010, 210, 3, 'role-create', 'web', NULL, NULL),
(3, 21011, 210, 3, 'role-list', 'web', NULL, NULL),
(4, 21012, 210, 3, 'role-edit', 'web', NULL, NULL),
(5, 21110, 211, 3, 'employee-create', 'web', NULL, NULL),
(6, 21111, 211, 3, 'employee-list', 'web', NULL, NULL),
(7, 21112, 211, 3, 'employee-edit', 'web', NULL, NULL),
(8, 21210, 212, 3, 'cash-account-create', 'web', NULL, NULL),
(9, 21211, 212, 3, 'cash-account-list', 'web', NULL, NULL),
(10, 21310, 213, 3, 'part-registration-create', 'web', NULL, NULL),
(11, 21311, 213, 3, 'part-registration-list', 'web', NULL, NULL),
(12, 21312, 213, 3, 'part-registration-edit', 'web', NULL, NULL),
(13, 21313, 213, 3, 'openinning-stock-create', 'web', NULL, NULL),
(14, 21410, 214, 3, 'sale-purchase-party-create', 'web', NULL, NULL),
(15, 21411, 214, 3, 'sale-purchase-party-list', 'web', NULL, NULL),
(16, 21412, 214, 3, 'sale-purchase-party-edit', 'web', NULL, NULL),
(17, 21510, 215, 3, 'Warrenty-vendor-create', 'web', NULL, NULL),
(18, 21511, 215, 3, 'Warrenty-vendor-list', 'web', NULL, NULL),
(19, 21512, 215, 3, 'Warrenty-vendor-edit', 'web', NULL, NULL),
(20, 21610, 216, 3, 'client-list', 'web', NULL, NULL),
(21, 21611, 216, 3, 'client-edit', 'web', NULL, NULL),
(22, 21711, 217, 3, 'brand-create', 'web', NULL, NULL),
(23, 21712, 217, 3, 'brand-list', 'web', NULL, NULL),
(24, 21713, 217, 3, 'brand-edit', 'web', NULL, NULL),
(25, 21810, 218, 3, 'category-create', 'web', NULL, NULL),
(26, 21811, 218, 3, 'category-list', 'web', NULL, NULL),
(27, 21812, 218, 3, 'category-edit', 'web', NULL, NULL),
(28, 21910, 219, 3, 'model-create', 'web', NULL, NULL),
(29, 21911, 219, 3, 'model-list', 'web', NULL, NULL),
(30, 21912, 219, 3, 'model-edit', 'web', NULL, NULL),
(31, 22010, 220, 3, 'job-lab-hold-reason-create', 'web', NULL, NULL),
(32, 22011, 220, 3, 'job-lab-hold-reason-list', 'web', NULL, NULL),
(33, 22012, 220, 3, 'job-lab-hold-reason-edit', 'web', NULL, NULL),
(34, 22110, 221, 3, 'job-lab-close-reason-create', 'web', NULL, NULL),
(35, 22110, 221, 3, 'job-lab-close-reason-list', 'web', NULL, NULL),
(36, 22110, 221, 3, 'job-lab-close-reason-edit', 'web', NULL, NULL),
(37, 3, 0, 1, 'Job Management', 'web', NULL, NULL),
(38, 310, 3, 2, 'job information', 'web', NULL, NULL),
(39, 31010, 310, 3, 'job-information-create', 'web', NULL, NULL),
(40, 31011, 310, 3, 'job-information-list', 'web', NULL, NULL),
(41, 31012, 310, 3, 'job-information-edit', 'web', NULL, NULL),
(42, 31013, 310, 3, 'detail-job-information-list', 'web', NULL, NULL),
(43, 311, 3, 2, 'job issue to technician', 'web', NULL, NULL),
(44, 31110, 311, 3, 'job-issue-to-technician-create', 'web', NULL, NULL),
(45, 31111, 311, 3, 'job-issue-to-technician-list', 'web', NULL, NULL),
(46, 312, 3, 2, 'issue parts to job', 'web', NULL, NULL),
(47, 31210, 312, 3, 'issue-parts-to-job-create', 'web', NULL, NULL),
(48, 31211, 312, 3, 'issue-parts-to-job-list', 'web', NULL, NULL),
(49, 313, 3, 2, 'job parts return', 'web', NULL, NULL),
(50, 31310, 313, 3, 'add-job-parts-return', 'web', NULL, NULL),
(52, 314, 3, 2, 'job transfer', 'web', NULL, NULL),
(53, 31410, 314, 3, 'job-transfer-create', 'web', NULL, NULL),
(54, 31411, 314, 3, 'job-transfer-list', 'web', NULL, NULL),
(55, 315, 3, 2, 'job close', 'web', NULL, NULL),
(56, 31510, 315, 3, 'job-close-create', 'web', NULL, NULL),
(57, 31511, 315, 3, 'job-close-list', 'web', NULL, NULL),
(58, 316, 3, 2, 'estimate version', 'web', NULL, NULL),
(59, 31610, 316, 3, 'estimate-version-create', 'web', NULL, NULL),
(60, 31611, 316, 3, 'estimate-version-list', 'web', NULL, NULL),
(61, 317, 3, 2, 'job hold', 'web', NULL, NULL),
(62, 31710, 317, 3, 'job-hold-create', 'web', NULL, NULL),
(63, 31711, 317, 3, 'job-hold-list', 'web', NULL, NULL),
(64, 318, 3, 2, 'job reopen', 'web', NULL, NULL),
(65, 31810, 318, 3, 'job-reopen-create', 'web', NULL, NULL),
(66, 31811, 318, 3, 'job-reopen-list', 'web', NULL, NULL),
(75, 410, 4, 2, 'product loss', 'web', NULL, NULL),
(76, 41010, 410, 3, 'product-loss-create', 'web', NULL, NULL),
(77, 41011, 410, 3, 'product-loss-list', 'web', NULL, NULL),
(78, 411, 4, 2, 'product recover', 'web', NULL, NULL),
(79, 41110, 411, 3, 'product-recover-create', 'web', NULL, NULL),
(80, 41111, 411, 3, 'product-recover-list', 'web', NULL, NULL),
(81, 412, 4, 2, 'Stock movement list', 'web', NULL, NULL),
(82, 41210, 412, 3, 'stock-list', 'web', NULL, NULL),
(91, 5, 0, 1, 'Cash Invoice', 'web', NULL, NULL),
(92, 6, 0, 1, 'Reports', 'web', NULL, NULL),
(93, 610, 6, 2, 'time-report', 'web', NULL, NULL),
(94, 611, 6, 2, 'issue-parts-report', 'web', NULL, NULL),
(95, 612, 6, 2, 'profit-report', 'web', NULL, NULL),
(96, 613, 6, 2, 'technisian-lab-report', 'web', NULL, NULL),
(97, 4, 0, 1, 'Stock Movement', 'web', NULL, NULL),
(98, 2, 0, 1, 'Registration', 'web', NULL, NULL),
(99, 210, 2, 2, 'Roles', 'web', NULL, NULL),
(100, 211, 2, 2, 'Employee', 'web', NULL, NULL),
(101, 212, 2, 2, 'Cash Account', 'web', NULL, NULL),
(102, 213, 2, 2, 'Part Registration', 'web', NULL, NULL),
(103, 214, 2, 2, 'Sale Purchase Party', 'web', NULL, NULL),
(104, 215, 2, 2, 'Warrenty Vendor', 'web', NULL, NULL),
(105, 216, 2, 2, 'Client', 'web', NULL, NULL),
(106, 217, 2, 2, 'Brand', 'web', NULL, NULL),
(107, 218, 2, 2, 'Category', 'web', NULL, NULL),
(108, 219, 2, 2, 'Model', 'web', NULL, NULL),
(109, 220, 2, 2, 'Job Hold Reason', 'web', NULL, NULL),
(110, 221, 2, 2, 'Job Close Reason', 'web', NULL, NULL),
(111, 510, 5, 2, 'sale invoice for job', 'web', NULL, NULL),
(112, 511, 5, 2, 'sale invoice', 'web', NULL, NULL),
(113, 512, 5, 2, 'purchase invoice', 'web', NULL, NULL),
(114, 513, 5, 2, 'cash receipt voucher', 'web', NULL, NULL),
(115, 514, 5, 2, 'cash payment voucher', 'web', NULL, NULL),
(116, 515, 5, 2, 'cash book', 'web', NULL, NULL),
(117, 51110, 511, 3, 'sale-invoice-create', 'web', NULL, NULL),
(118, 51111, 511, 3, 'sale-invoice-list', 'web', NULL, NULL),
(119, 51112, 511, 3, 'sale-invoice-edit', 'web', NULL, NULL),
(120, 51113, 511, 3, 'detail-sale-invoice-list', 'web', NULL, NULL),
(121, 51010, 510, 3, 'sale-invoice-for-job-create', 'web', NULL, NULL),
(122, 51011, 510, 3, 'sale-invoice-for-job-list', 'web', NULL, NULL),
(123, 51210, 512, 3, 'purchase-invoice-create', 'web', NULL, NULL),
(124, 51211, 512, 3, 'purchase-invoice-list', 'web', NULL, NULL),
(125, 51212, 512, 3, 'purchase-invoice-edit', 'web', NULL, NULL),
(126, 51213, 512, 3, 'detail-purchase-invoice-list', 'web', NULL, NULL),
(127, 51310, 513, 3, 'cash-receipt-voucher-create', 'web', NULL, NULL),
(128, 51311, 513, 3, 'cash-receipt-voucher-list', 'web', NULL, NULL),
(129, 51412, 514, 3, 'cash-payment-voucher-create', 'web', NULL, NULL),
(130, 51413, 514, 3, 'cash-payment-voucher-list', 'web', NULL, NULL),
(131, 51510, 515, 3, 'cash-book-list', 'web', NULL, NULL);

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
-- Table structure for table `product_loss`
--

CREATE TABLE `product_loss` (
  `pl_ip_address` varchar(250) DEFAULT NULL,
  `pl_browser_info` varchar(250) DEFAULT NULL,
  `pl_id` int(11) UNSIGNED NOT NULL,
  `pl_user_id` int(11) UNSIGNED NOT NULL,
  `pl_part_id` int(11) UNSIGNED NOT NULL,
  `pl_qty` int(11) DEFAULT NULL,
  `pl_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `pl_sto_id` int(11) UNSIGNED DEFAULT NULL,
  `pl_created_at` timestamp NULL DEFAULT current_timestamp(),
  `pl_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_loss`
--

INSERT INTO `product_loss` (`pl_ip_address`, `pl_browser_info`, `pl_id`, `pl_user_id`, `pl_part_id`, `pl_qty`, `pl_remarks`, `pl_sto_id`, `pl_created_at`, `pl_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 7, 2, 2000, 'sgfsdgdfgsdf  sdf sdf df', NULL, '2022-01-24 11:04:34', '2022-01-24 06:04:34'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 7, 1, 100, NULL, NULL, '2022-01-24 11:55:52', '2022-01-24 06:55:52'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 7, 1, 5, NULL, NULL, '2022-01-24 11:56:37', '2022-01-24 06:56:37'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 7, 1, 5, NULL, NULL, '2022-01-24 11:57:21', '2022-01-24 06:57:21'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 7, 3, 0, NULL, NULL, '2022-01-24 12:02:28', '2022-01-24 07:02:28'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 6, 7, 1, 2, NULL, NULL, '2022-01-24 12:05:18', '2022-01-24 07:05:18'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 7, 7, 1, 3, 'frgr g g reg regew', NULL, '2022-01-24 12:19:49', '2022-01-24 07:19:49'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 8, 7, 3, 5, 'dasfdsafasd', NULL, '2022-01-25 11:58:08', '2022-01-25 06:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_recover`
--

CREATE TABLE `product_recover` (
  `pr_ip_address` varchar(250) DEFAULT NULL,
  `pr_browser_info` varchar(250) DEFAULT NULL,
  `pr_id` int(11) UNSIGNED NOT NULL,
  `pr_user_id` int(11) UNSIGNED NOT NULL,
  `pr_part_id` int(11) UNSIGNED NOT NULL,
  `pr_qty` int(11) NOT NULL,
  `pr_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `pr_sto_id` int(11) UNSIGNED DEFAULT NULL,
  `pr_created_at` timestamp NULL DEFAULT current_timestamp(),
  `pr_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_recover`
--

INSERT INTO `product_recover` (`pr_ip_address`, `pr_browser_info`, `pr_id`, `pr_user_id`, `pr_part_id`, `pr_qty`, `pr_remarks`, `pr_sto_id`, `pr_created_at`, `pr_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 7, 1, 250, NULL, NULL, '2022-01-24 12:02:41', '2022-01-24 07:02:41'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 7, 2, 60000, NULL, NULL, '2022-01-24 12:02:50', '2022-01-24 07:02:50'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 7, 3, 500, NULL, NULL, '2022-01-24 12:03:10', '2022-01-24 07:03:10'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 7, 1, 3, NULL, NULL, '2022-01-24 12:08:50', '2022-01-24 07:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice`
--

CREATE TABLE `purchase_invoice` (
  `pi_user_id` int(11) UNSIGNED NOT NULL,
  `pi_id` int(11) UNSIGNED NOT NULL,
  `pi_party_id` int(11) NOT NULL,
  `pi_cash_account` int(11) NOT NULL,
  `pi_total_items` int(11) DEFAULT NULL,
  `pi_total_price` int(11) DEFAULT NULL,
  `pi_discount` int(11) DEFAULT NULL,
  `pi_grand_total` int(11) DEFAULT NULL,
  `pi_amount_pay` int(11) DEFAULT NULL,
  `pi_remaining` int(11) DEFAULT NULL,
  `pi_status` varchar(200) DEFAULT NULL,
  `pi_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `pi_ip_address` varchar(250) DEFAULT NULL,
  `pi_browser_info` varchar(250) DEFAULT NULL,
  `pi_created_at` timestamp NULL DEFAULT current_timestamp(),
  `pi_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_invoice`
--

INSERT INTO `purchase_invoice` (`pi_user_id`, `pi_id`, `pi_party_id`, `pi_cash_account`, `pi_total_items`, `pi_total_price`, `pi_discount`, `pi_grand_total`, `pi_amount_pay`, `pi_remaining`, `pi_status`, `pi_remarks`, `pi_ip_address`, `pi_browser_info`, `pi_created_at`, `pi_updated_at`) VALUES
(1, 1, 1, 1, 5, NULL, NULL, 45, 45, 0, 'Paid', NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 08:03:32', '2022-01-15 03:03:32'),
(1, 4, 1, 1, 8, NULL, NULL, 227, 127, 100, 'Credit', NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 11:09:30', '2022-01-15 06:09:30'),
(7, 5, 2, 2, 20, NULL, NULL, 800, 800, 0, 'Paid', NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', '2022-01-25 11:00:45', '2022-01-25 06:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_items`
--

CREATE TABLE `purchase_invoice_items` (
  `pii_user_id` int(11) UNSIGNED NOT NULL,
  `pii_id` int(11) UNSIGNED NOT NULL,
  `pii_pi_id` int(11) UNSIGNED DEFAULT NULL,
  `pii_part_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `pii_qty` int(11) DEFAULT NULL,
  `pii_rate` int(11) DEFAULT NULL,
  `pii_discount` int(11) DEFAULT NULL,
  `pii_amount` int(11) DEFAULT NULL,
  `pii_ip_address` varchar(250) DEFAULT NULL,
  `pii_browser_info` varchar(250) DEFAULT NULL,
  `pii_created_at` timestamp NULL DEFAULT current_timestamp(),
  `pii_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_invoice_items`
--

INSERT INTO `purchase_invoice_items` (`pii_user_id`, `pii_id`, `pii_pi_id`, `pii_part_name`, `pii_qty`, `pii_rate`, `pii_discount`, `pii_amount`, `pii_ip_address`, `pii_browser_info`, `pii_created_at`, `pii_updated_at`) VALUES
(1, 1, 1, '1', 5, 9, NULL, 45, NULL, NULL, '2022-01-15 08:03:32', NULL),
(1, 2, 4, '1', 3, 9, NULL, 27, NULL, NULL, '2022-01-15 11:09:30', NULL),
(1, 3, 4, '2', 5, 40, NULL, 200, NULL, NULL, '2022-01-15 11:09:30', NULL),
(7, 4, 5, '3', 20, 40, NULL, 800, NULL, NULL, '2022-01-25 11:00:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin role', 'web', '2022-01-18 07:29:33', '2022-01-19 06:48:43'),
(2, 'cashier', 'web', '2022-01-21 02:25:50', '2022-01-21 02:25:50'),
(3, 'labour', 'web', '2022-01-21 02:28:30', '2022-01-21 02:28:30'),
(4, 'Admin', 'web', '2022-01-22 02:03:41', '2022-01-22 02:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(3, 3),
(3, 4),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(5, 4),
(6, 1),
(6, 4),
(7, 1),
(7, 4),
(8, 1),
(8, 4),
(9, 1),
(9, 4),
(10, 1),
(10, 4),
(11, 1),
(11, 4),
(12, 1),
(12, 4),
(13, 1),
(13, 4),
(14, 1),
(14, 4),
(15, 1),
(15, 4),
(16, 1),
(16, 4),
(17, 1),
(17, 4),
(18, 1),
(18, 4),
(19, 1),
(19, 4),
(20, 1),
(20, 4),
(21, 1),
(21, 4),
(22, 1),
(22, 4),
(23, 1),
(23, 4),
(24, 1),
(24, 4),
(25, 1),
(25, 4),
(26, 1),
(26, 4),
(27, 1),
(27, 4),
(28, 1),
(28, 4),
(29, 1),
(29, 4),
(30, 1),
(30, 4),
(31, 1),
(31, 4),
(32, 1),
(32, 4),
(33, 1),
(33, 4),
(34, 1),
(34, 4),
(35, 1),
(35, 4),
(36, 1),
(36, 4),
(37, 1),
(37, 4),
(38, 1),
(38, 4),
(39, 1),
(39, 4),
(40, 1),
(40, 4),
(41, 1),
(41, 4),
(42, 1),
(42, 4),
(43, 1),
(43, 4),
(44, 1),
(44, 4),
(45, 1),
(45, 4),
(46, 1),
(46, 4),
(47, 1),
(47, 4),
(48, 1),
(48, 4),
(49, 1),
(49, 3),
(49, 4),
(50, 1),
(50, 3),
(50, 4),
(52, 1),
(52, 3),
(52, 4),
(53, 1),
(53, 3),
(53, 4),
(54, 1),
(54, 3),
(54, 4),
(55, 1),
(55, 3),
(55, 4),
(56, 1),
(56, 4),
(57, 1),
(57, 4),
(58, 1),
(58, 4),
(59, 1),
(59, 4),
(60, 1),
(60, 3),
(60, 4),
(61, 1),
(61, 4),
(62, 1),
(62, 4),
(63, 1),
(63, 4),
(64, 1),
(64, 4),
(65, 1),
(65, 4),
(66, 1),
(66, 4),
(75, 1),
(75, 4),
(76, 1),
(76, 4),
(77, 1),
(77, 4),
(78, 1),
(78, 4),
(79, 1),
(79, 4),
(80, 1),
(80, 4),
(81, 1),
(81, 4),
(82, 1),
(82, 4),
(91, 1),
(91, 4),
(92, 1),
(92, 4),
(93, 1),
(93, 4),
(94, 1),
(94, 4),
(95, 1),
(95, 4),
(96, 1),
(96, 4),
(97, 1),
(97, 4),
(98, 4),
(99, 4),
(100, 1),
(100, 4),
(101, 1),
(101, 4),
(102, 1),
(102, 4),
(103, 1),
(103, 4),
(104, 1),
(104, 4),
(105, 1),
(105, 4),
(106, 1),
(106, 4),
(107, 1),
(107, 4),
(108, 1),
(108, 4),
(109, 1),
(109, 4),
(110, 1),
(110, 4),
(111, 1),
(111, 4),
(112, 1),
(112, 4),
(113, 1),
(113, 4),
(114, 1),
(114, 4),
(115, 1),
(115, 4),
(116, 1),
(116, 4),
(117, 1),
(117, 4),
(118, 1),
(118, 4),
(119, 1),
(119, 4),
(120, 1),
(120, 4),
(121, 1),
(121, 4),
(122, 1),
(122, 4),
(123, 1),
(123, 4),
(124, 1),
(124, 4),
(125, 1),
(125, 4),
(126, 1),
(126, 4),
(127, 1),
(127, 4),
(128, 1),
(128, 4),
(129, 1),
(129, 4),
(130, 1),
(130, 4),
(131, 1),
(131, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice`
--

CREATE TABLE `sale_invoice` (
  `si_user_id` int(11) UNSIGNED NOT NULL,
  `si_id` int(11) UNSIGNED NOT NULL,
  `si_party_id` int(11) NOT NULL,
  `si_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `si_cash_account` int(11) NOT NULL,
  `si_total_items` int(11) DEFAULT NULL,
  `si_total_price` int(11) DEFAULT NULL,
  `si_discount` int(11) DEFAULT NULL,
  `si_grand_total` int(11) DEFAULT NULL,
  `si_amount_pay` int(11) NOT NULL,
  `si_remaining` int(11) NOT NULL,
  `si_status` varchar(250) DEFAULT NULL,
  `si_ip_address` varchar(250) DEFAULT NULL,
  `si_browser_info` varchar(250) DEFAULT NULL,
  `si_created_at` timestamp NULL DEFAULT current_timestamp(),
  `si_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_invoice`
--

INSERT INTO `sale_invoice` (`si_user_id`, `si_id`, `si_party_id`, `si_remarks`, `si_cash_account`, `si_total_items`, `si_total_price`, `si_discount`, `si_grand_total`, `si_amount_pay`, `si_remaining`, `si_status`, `si_ip_address`, `si_browser_info`, `si_created_at`, `si_updated_at`) VALUES
(1, 1, 1, NULL, 1, 52, NULL, NULL, 2018, 2018, 0, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 07:53:25', '2022-01-15 07:53:25'),
(1, 2, 1, 'dfgafsg', 1, 5, NULL, NULL, 138, 658, -520, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 11:05:18', '2022-01-15 11:05:18'),
(2, 3, 1, 'sggfdsg', 1, 45, NULL, NULL, 405, 55, 350, 'Credit', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 09:02:53', '2022-01-17 09:02:53'),
(2, 4, 1, NULL, 1, 17, NULL, NULL, 308, 308, 0, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 09:58:47', '2022-01-17 09:58:47'),
(7, 5, 2, NULL, 2, 200, NULL, NULL, 8000, 8000, 0, 'Paid', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', '2022-01-25 11:00:15', '2022-01-25 11:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice_for_jobs`
--

CREATE TABLE `sale_invoice_for_jobs` (
  `sifj_user_id` int(11) UNSIGNED NOT NULL,
  `sifj_id` int(11) UNSIGNED NOT NULL,
  `sifj_remarks` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `sifj_cash_account` int(11) DEFAULT NULL,
  `sifj_job_no` int(11) UNSIGNED DEFAULT NULL,
  `sifj_real_estimated_cost` int(11) DEFAULT NULL,
  `sifj_estimated_cost` int(11) DEFAULT NULL,
  `sifj_amount_paid` int(11) DEFAULT NULL,
  `sifj_remaining_cost` int(11) DEFAULT NULL,
  `sifj_discount` decimal(50,2) DEFAULT NULL,
  `sifj_ip_address` varchar(250) DEFAULT NULL,
  `sifj_browser_info` varchar(250) DEFAULT NULL,
  `sifj_created_at` timestamp NULL DEFAULT current_timestamp(),
  `sifj_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_invoice_for_jobs`
--

INSERT INTO `sale_invoice_for_jobs` (`sifj_user_id`, `sifj_id`, `sifj_remarks`, `sifj_cash_account`, `sifj_job_no`, `sifj_real_estimated_cost`, `sifj_estimated_cost`, `sifj_amount_paid`, `sifj_remaining_cost`, `sifj_discount`, `sifj_ip_address`, `sifj_browser_info`, `sifj_created_at`, `sifj_updated_at`) VALUES
(1, 1, NULL, 1, 1, 2000, 2000, 1000, 988, '12.00', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 07:37:14', '2022-01-15 07:37:14'),
(1, 2, NULL, 1, 1, 2000, 988, 88, 900, NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-15 07:37:33', '2022-01-15 07:37:33'),
(2, 3, 'sgdfdgsdfg', 1, NULL, 2018, 1818, 800, 1015, '3.00', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-17 09:57:26', '2022-01-17 09:57:26'),
(7, 5, NULL, 1, 1, 2000, 900, 200, 600, '100.00', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-24 12:29:28', '2022-01-24 12:29:28'),
(7, 6, NULL, 2, 1, 2000, 600, 100, 500, NULL, '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '2022-01-24 12:36:37', '2022-01-24 12:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice_items`
--

CREATE TABLE `sale_invoice_items` (
  `sii_user_id` int(11) UNSIGNED NOT NULL,
  `sii_id` int(11) UNSIGNED NOT NULL,
  `sii_si_id` int(11) UNSIGNED NOT NULL,
  `sii_part_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `sii_qty` int(11) NOT NULL,
  `sii_rate` int(11) NOT NULL,
  `sii_discount` int(11) DEFAULT NULL,
  `sii_amount` int(11) NOT NULL,
  `sii_ip_address` varchar(250) DEFAULT NULL,
  `sii_browser_info` varchar(250) DEFAULT NULL,
  `sii_created_at` timestamp NULL DEFAULT current_timestamp(),
  `sii_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_invoice_items`
--

INSERT INTO `sale_invoice_items` (`sii_user_id`, `sii_id`, `sii_si_id`, `sii_part_name`, `sii_qty`, `sii_rate`, `sii_discount`, `sii_amount`, `sii_ip_address`, `sii_browser_info`, `sii_created_at`, `sii_updated_at`) VALUES
(1, 1, 1, '2', 50, 40, NULL, 2000, NULL, NULL, '2022-01-15 07:53:25', NULL),
(1, 2, 1, '1', 2, 9, NULL, 18, NULL, NULL, '2022-01-15 07:53:25', NULL),
(1, 3, 2, '1', 2, 9, NULL, 18, NULL, NULL, '2022-01-15 11:05:18', NULL),
(1, 4, 2, '2', 3, 40, NULL, 120, NULL, NULL, '2022-01-15 11:05:18', NULL),
(2, 5, 3, '1', 45, 9, NULL, 405, NULL, NULL, '2022-01-17 09:02:53', NULL),
(2, 6, 4, '1', 12, 9, NULL, 108, NULL, NULL, '2022-01-17 09:58:47', NULL),
(2, 7, 4, '2', 5, 40, NULL, 200, NULL, NULL, '2022-01-17 09:58:47', NULL),
(7, 8, 5, '2', 200, 40, NULL, 8000, NULL, NULL, '2022-01-25 11:00:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `sto_ip_address` varchar(250) DEFAULT NULL,
  `sto_browser_info` varchar(250) DEFAULT NULL,
  `sto_id` int(11) UNSIGNED NOT NULL,
  `sto_par_id` int(11) UNSIGNED NOT NULL,
  `sto_job_id` int(11) UNSIGNED DEFAULT NULL,
  `sto_user_id` int(11) UNSIGNED NOT NULL,
  `sto_type` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `sto_type_id` int(11) DEFAULT NULL,
  `sto_in` decimal(50,2) DEFAULT 0.00,
  `sto_in_rate` decimal(50,2) DEFAULT 0.00,
  `sto_in_discount` decimal(50,2) DEFAULT NULL,
  `sto_in_amount` decimal(50,2) DEFAULT 0.00,
  `sto_out` decimal(50,2) DEFAULT 0.00,
  `sto_out_rate` decimal(50,2) DEFAULT 0.00,
  `sto_out_discount` decimal(50,2) DEFAULT NULL,
  `sto_out_amount` decimal(50,2) DEFAULT 0.00,
  `sto_hold` decimal(50,2) DEFAULT 0.00,
  `sto_hold_rate` decimal(50,2) DEFAULT 0.00,
  `sto_hold_amount` decimal(50,2) DEFAULT 0.00,
  `sto_total` decimal(50,2) DEFAULT 0.00,
  `sto_created_at` timestamp NULL DEFAULT current_timestamp(),
  `sto_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`sto_ip_address`, `sto_browser_info`, `sto_id`, `sto_par_id`, `sto_job_id`, `sto_user_id`, `sto_type`, `sto_type_id`, `sto_in`, `sto_in_rate`, `sto_in_discount`, `sto_in_amount`, `sto_out`, `sto_out_rate`, `sto_out_discount`, `sto_out_amount`, `sto_hold`, `sto_hold_rate`, `sto_hold_amount`, `sto_total`, `sto_created_at`, `sto_updated_at`) VALUES
(NULL, NULL, 1, 2, NULL, 1, 'Created', 2, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '2022-01-15 07:51:26', NULL),
(NULL, NULL, 2, 2, NULL, 1, 'Openning', 2, '400.00', '10.00', NULL, '4000.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '-400.00', '2022-01-15 07:52:07', NULL),
(NULL, NULL, 3, 2, NULL, 1, 'Sale_Invoice', 1, '0.00', '0.00', NULL, '0.00', '50.00', '40.00', NULL, '2000.00', '0.00', '0.00', '0.00', '-450.00', '2022-01-15 07:53:25', NULL),
(NULL, NULL, 4, 1, NULL, 1, 'Sale_Invoice', 1, '0.00', '0.00', NULL, '0.00', '2.00', '9.00', NULL, '18.00', '0.00', '0.00', '0.00', '2.00', '2022-01-15 07:53:25', NULL),
(NULL, NULL, 5, 1, NULL, 1, 'Purchase_Invoice', 1, '0.00', '0.00', NULL, '0.00', '5.00', '9.00', NULL, '45.00', '0.00', '0.00', '0.00', '7.00', '2022-01-15 08:03:32', NULL),
(NULL, NULL, 6, 1, NULL, 1, 'Assign', 1, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '12.00', '3.00', '36.00', '-5.00', '2022-01-15 09:33:13', NULL),
(NULL, NULL, 7, 1, NULL, 1, 'Sale_Invoice', 2, '0.00', '0.00', NULL, '0.00', '2.00', '9.00', NULL, '18.00', '0.00', '0.00', '0.00', '-7.00', '2022-01-15 11:05:18', NULL),
(NULL, NULL, 8, 2, NULL, 1, 'Sale_Invoice', 2, '0.00', '0.00', NULL, '0.00', '3.00', '40.00', NULL, '120.00', '0.00', '0.00', '0.00', '-453.00', '2022-01-15 11:05:18', NULL),
(NULL, NULL, 9, 1, NULL, 1, 'Purchase_Invoice', 4, '0.00', '0.00', NULL, '0.00', '3.00', '9.00', NULL, '27.00', '0.00', '0.00', '0.00', '-4.00', '2022-01-15 11:09:30', NULL),
(NULL, NULL, 10, 2, NULL, 1, 'Purchase_Invoice', 4, '0.00', '0.00', NULL, '0.00', '5.00', '40.00', NULL, '200.00', '0.00', '0.00', '0.00', '-448.00', '2022-01-15 11:09:30', NULL),
(NULL, NULL, 11, 1, NULL, 2, 'Sale_Invoice', 3, '0.00', '0.00', NULL, '0.00', '45.00', '9.00', NULL, '405.00', '0.00', '0.00', '0.00', '-49.00', '2022-01-17 09:02:53', NULL),
(NULL, NULL, 12, 1, NULL, 2, 'Sale_Invoice', 4, '0.00', '0.00', NULL, '0.00', '12.00', '9.00', NULL, '108.00', '0.00', '0.00', '0.00', '-61.00', '2022-01-17 09:58:47', NULL),
(NULL, NULL, 13, 2, NULL, 2, 'Sale_Invoice', 4, '0.00', '0.00', NULL, '0.00', '5.00', '40.00', NULL, '200.00', '0.00', '0.00', '0.00', '-453.00', '2022-01-17 09:58:47', NULL),
(NULL, NULL, 14, 3, NULL, 7, 'Created', 3, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '2022-01-22 07:19:08', NULL),
(NULL, NULL, 15, 1, NULL, 7, 'Assign', 2, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '1.00', '3.00', '3.00', '-62.00', '2022-01-24 08:24:35', NULL),
(NULL, NULL, 16, 1, NULL, 7, 'Assign', 3, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '-1.00', '3.00', '-3.00', '-61.00', '2022-01-24 08:25:21', NULL),
(NULL, NULL, 17, 2, NULL, 7, 'Assign', 4, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '-45.00', '10.00', '-450.00', '-408.00', '2022-01-24 09:28:42', NULL),
(NULL, NULL, 18, 2, NULL, 7, 'Assign', 5, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '12.00', '10.00', '120.00', '-420.00', '2022-01-24 10:10:44', NULL),
(NULL, NULL, 19, 1, NULL, 7, 'Assign', 6, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '45.00', '3.00', '135.00', '-106.00', '2022-01-24 10:10:59', NULL),
(NULL, NULL, 20, 1, NULL, 7, 'Assign', 7, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '1.00', '3.00', '3.00', '-107.00', '2022-01-24 10:12:30', NULL),
(NULL, NULL, 21, 1, NULL, 7, 'Return', 8, '4.00', '3.00', NULL, '12.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '-103.00', '2022-01-24 10:32:49', NULL),
(NULL, NULL, 22, 2, NULL, 7, 'Loss', 1, '0.00', '0.00', NULL, '0.00', '2000.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '-2420.00', '2022-01-24 11:04:34', NULL),
(NULL, NULL, 23, 1, NULL, 7, 'Loss', 2, '0.00', '0.00', NULL, '0.00', '100.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '-203.00', '2022-01-24 11:55:52', NULL),
(NULL, NULL, 24, 1, NULL, 7, 'Loss', 3, '0.00', '0.00', NULL, '0.00', '5.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '-208.00', '2022-01-24 11:56:37', NULL),
(NULL, NULL, 25, 1, NULL, 7, 'Loss', 4, '0.00', '0.00', NULL, '0.00', '5.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '-213.00', '2022-01-24 11:57:21', NULL),
(NULL, NULL, 26, 3, NULL, 7, 'Loss', 5, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '2022-01-24 12:02:28', NULL),
(NULL, NULL, 27, 1, NULL, 7, 'Recover', NULL, '250.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '37.00', '2022-01-24 12:02:41', NULL),
(NULL, NULL, 28, 2, NULL, 7, 'Recover', NULL, '60000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '57580.00', '2022-01-24 12:02:50', NULL),
(NULL, NULL, 29, 3, NULL, 7, 'Recover', NULL, '500.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '500.00', '2022-01-24 12:03:10', NULL),
(NULL, NULL, 30, 1, NULL, 7, 'Loss', 6, '0.00', '0.00', NULL, '0.00', '2.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '35.00', '2022-01-24 12:05:18', NULL),
(NULL, NULL, 31, 1, NULL, 7, 'Recover', NULL, '3.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '38.00', '2022-01-24 12:08:50', NULL),
(NULL, NULL, 32, 4, NULL, 7, 'Created', 4, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '2022-01-24 12:12:10', NULL),
(NULL, NULL, 33, 1, NULL, 7, 'Loss', 7, '0.00', '0.00', NULL, '0.00', '3.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '35.00', '2022-01-24 12:19:49', NULL),
(NULL, NULL, 34, 3, NULL, 7, 'Openning', 3, '500.00', '10.00', NULL, '5000.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '1000.00', '2022-01-24 13:32:34', NULL),
(NULL, NULL, 35, 4, NULL, 7, 'Openning', 4, '0.00', '10.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '2022-01-24 13:38:25', NULL),
(NULL, NULL, 36, 5, NULL, 7, 'Created', 5, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '2022-01-24 13:39:09', NULL),
(NULL, NULL, 37, 5, NULL, 7, 'Openning', 5, '156.00', '10.00', NULL, '1560.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '156.00', '2022-01-24 13:39:24', NULL),
(NULL, NULL, 38, 1, NULL, 7, 'Assign', 9, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '5.00', '3.00', '15.00', '30.00', '2022-01-25 07:40:52', NULL),
(NULL, NULL, 39, 5, NULL, 7, 'Assign', 10, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '2.00', '10.00', '20.00', '154.00', '2022-01-25 07:42:30', NULL),
(NULL, NULL, 40, 1, NULL, 7, 'Return', 11, '2.00', '3.00', NULL, '6.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '32.00', '2022-01-25 07:43:22', NULL),
(NULL, NULL, 41, 2, NULL, 7, 'Sale_Invoice', 5, '0.00', '0.00', NULL, '0.00', '200.00', '40.00', NULL, '8000.00', '0.00', '0.00', '0.00', '57380.00', '2022-01-25 11:00:15', NULL),
(NULL, NULL, 42, 3, NULL, 7, 'Purchase_Invoice', 5, '0.00', '0.00', NULL, '0.00', '20.00', '40.00', NULL, '800.00', '0.00', '0.00', '0.00', '1020.00', '2022-01-25 11:00:45', NULL),
(NULL, NULL, 43, 1, NULL, 7, 'Assign', 12, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '12.00', '3.00', '36.00', '20.00', '2022-01-25 11:16:36', NULL),
(NULL, NULL, 44, 3, 3, 7, 'Assign', 13, '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '20.00', '10.00', '200.00', '1000.00', '2022-01-25 11:20:35', NULL),
(NULL, NULL, 45, 3, NULL, 7, 'Loss', 8, '0.00', '0.00', NULL, '0.00', '5.00', '10.00', NULL, '50.00', '0.00', '0.00', '0.00', '995.00', '2022-01-25 11:58:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `tech_ip_address` varchar(250) DEFAULT NULL,
  `tech_browser_info` varchar(250) DEFAULT NULL,
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `status` bit(20) NOT NULL DEFAULT b'0',
  `tech_status` bit(20) NOT NULL DEFAULT b'0',
  `tech_user_id` int(11) UNSIGNED NOT NULL,
  `tech_created_at` timestamp NULL DEFAULT current_timestamp(),
  `tech_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`tech_ip_address`, `tech_browser_info`, `tech_id`, `tech_name`, `status`, `tech_status`, `tech_user_id`, `tech_created_at`, `tech_updated_at`) VALUES
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 1, 'admin', b'00000000000000000001', b'00000000000000000001', 2, '2022-01-15 06:15:19', '2022-01-15 01:15:19'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 'nabeel ahmed', b'00000000000000000001', b'00000000000000000001', 3, '2022-01-19 13:37:21', '2022-01-21 05:16:24'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 'aslam', b'00000000000000000001', b'00000000000000000000', 4, '2022-01-19 14:00:59', '2022-01-19 09:04:41'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 'hello', b'00000000000000000001', b'00000000000000000000', 5, '2022-01-19 14:12:17', '2022-01-19 09:12:17'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 'hello', b'00000000000000000001', b'00000000000000000000', 6, '2022-01-19 14:14:15', '2022-01-21 05:15:48'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 6, 'super', b'00000000000000000001', b'00000000000000000001', 7, '2022-01-21 10:20:53', '2022-01-22 02:04:05'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 7, 'nabeel ahmed wq edasf', b'00000000000000000001', b'00000000000000000001', 8, '2022-01-22 07:07:49', '2022-01-22 02:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ip_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser_info` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `f_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `confirm_password` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `login_status` bit(1) DEFAULT NULL,
  `gender` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_status` bit(1) DEFAULT NULL,
  `assign_modular_grp` varchar(500) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_status` bit(1) DEFAULT NULL,
  `role` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ip_address`, `browser_info`, `id`, `name`, `f_name`, `address`, `confirm_password`, `login_status`, `gender`, `email`, `employee_status`, `assign_modular_grp`, `number`, `cnic`, `email_verified_at`, `password`, `work_status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(NULL, NULL, 1, 'sadmin', NULL, NULL, NULL, NULL, NULL, 'sadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$yiqEtp2WjXwzwva.xJZsIevmka47sbjqB0lg5gv7fmV6EnV4qmWFq', NULL, NULL, NULL, '2022-01-15 01:12:40', '2022-01-15 01:12:40'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 2, 'admin', 'ad', NULL, '$2y$10$X5m7TuZ4XGY5b23EBom6ye/6i63MVAZeAUqPeA6Dfc8Wu42o00NSq', b'1', 'Male', 'admin@gmail.com', b'1', NULL, NULL, '35145-3453534-1', NULL, '$2y$10$egxIlaRp6QYqouqS.zOkDeHSgNvrphD7kohv0XeZdoelW6BiClTvS', b'1', NULL, NULL, '2022-01-15 01:15:19', '2022-01-15 06:15:19'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 3, 'nabeel ahmed', 'fdsfdsfdsf', 'cantt', '$2y$10$S.zNCbjvhhRxaC9Kd.2oIetQRYUaMY/uMgqi1mMbvlEELEU.V2pU2', b'1', 'Male', 'nabeeljj@gmail.com', b'1', NULL, '0231-0301350', '12321-3213213-2', NULL, '$2y$10$rkj4AyT24JMuOtHS1yOoxuAUE02ttQvQlbaEp/owDV0MJQkvUoBb2', b'1', NULL, NULL, '2022-01-19 08:37:21', '2022-01-21 10:16:24'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 4, 'aslam', 'dasfdas sdf', 'cantt', '$2y$10$DoUjE7ekT81ZwVmLfG/Zv.cLsLDEKm6YSv5L9odtHngfOT/9naggG', b'1', 'Male', NULL, b'1', NULL, NULL, '21321-3213213-2', NULL, '$2y$10$8J7nxt/SkHFT3789sAOhw.vaRhHhEuAv1QBfk1AwiiSExnNWUJbNu', b'0', NULL, NULL, '2022-01-19 09:00:59', '2022-01-19 14:04:41'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 5, 'hello', 'sdafdas', 'cantt', '$2y$10$IyZAhKVgbcUOSQjjLlS21eGdw8o/xFCqCyk80P0V8meUQ6.SNgLky', b'1', 'Male', NULL, b'1', NULL, NULL, '12321-3213213-2', NULL, '$2y$10$m8DWou/c4F2JHcHtbl8nyeiGy1Cin9.rPGRY1.EOtMxRuXQSU8iM2', b'0', '0', NULL, '2022-01-19 09:12:17', '2022-01-19 14:12:17'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 6, 'hello', 'asdfasd', 'cantt', '$2y$10$TvSWcMr06Jfz3RYjaLitWOSF4IyO2bQAZlwWH7/fTx0G4HZzc3AjO', b'1', 'Male', NULL, b'1', NULL, NULL, '32132-3232132-1', NULL, '$2y$10$6qIgFSnNak3fAa6zK/3tg.foGEIVaZRkj5y6ADIp7UJqQTBGjbWiG', b'0', NULL, NULL, '2022-01-19 09:14:15', '2022-01-21 10:15:48'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 7, 'super', 'afdsdsf', 'cantt', '$2y$10$tlhv/8ivQX7htMgfZp9b4OHiqpjBCRERTaNSrErH6Vcmt2/V2MnYG', b'1', 'Male', 'super@gmail.com', b'1', NULL, NULL, '21321-3123213-1', NULL, '$2y$10$/Y.UYEMKs4W7r.H5fVl9k.GSVtyCFBhM8GASVnxRZuXPDZJSpGkF.', b'1', NULL, NULL, '2022-01-21 05:20:53', '2022-01-22 07:04:05'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', 8, 'nabeel ahmed wq edasf', 'Muhammad Yaseen', 'cantt', '$2y$10$LbtBE/m3lx4NC27eiCtuFOHl/472EQ7R2CED0Jo3lLV.f9vMxH5Z.', b'0', 'Male', NULL, b'1', NULL, NULL, '21321-3213123-2', NULL, '$2y$10$om6bbdm0K2awL1ry3Tboz.LhS5dnyM6DlZM2rNyraoVJlaOQutsyG', b'1', '3', NULL, '2022-01-22 02:07:49', '2022-01-22 07:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `vendor_user_id` int(11) UNSIGNED DEFAULT NULL,
  `vendor_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `vendor_browser_info` varchar(250) DEFAULT NULL,
  `vendor_ip_address` varchar(250) DEFAULT NULL,
  `vendor_created_at` datetime DEFAULT current_timestamp(),
  `vendor_updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_user_id`, `vendor_name`, `vendor_browser_info`, `vendor_ip_address`, `vendor_created_at`, `vendor_updated_at`) VALUES
(1, 1, 'SalarMax Care Center', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.71', '127.0.0.1', '2022-01-15 11:19:20', '2022-01-15 11:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bra_id`),
  ADD UNIQUE KEY `brands_br_name_unique` (`bra_name`),
  ADD KEY `bra_user_id` (`bra_user_id`);

--
-- Indexes for table `cash_account`
--
ALTER TABLE `cash_account`
  ADD PRIMARY KEY (`ca_id`),
  ADD KEY `ca_user_id` (`ca_user_id`);

--
-- Indexes for table `cash_book`
--
ALTER TABLE `cash_book`
  ADD PRIMARY KEY (`cb_id`),
  ADD KEY `cb_user_id` (`cb_user_id`),
  ADD KEY `cb_job_id` (`cb_job_id`),
  ADD KEY `cb_jrv_id` (`cb_jrv_id`),
  ADD KEY `cb_jpv_id` (`cb_jpv_id`),
  ADD KEY `cash_book_ibfk_5` (`cb_ca_id`);

--
-- Indexes for table `cash_payment_voucher`
--
ALTER TABLE `cash_payment_voucher`
  ADD PRIMARY KEY (`jpv_id`),
  ADD KEY `jpv_user_id` (`jpv_user_id`),
  ADD KEY `jpv_job_no` (`jpv_job_no`);

--
-- Indexes for table `cash_receipt_voucher`
--
ALTER TABLE `cash_receipt_voucher`
  ADD PRIMARY KEY (`jrv_id`),
  ADD KEY `jrv_user_id` (`jrv_user_id`),
  ADD KEY `jrv_job_no` (`jrv_job_no`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_bra_id` (`cat_bra_id`),
  ADD KEY `cat_user_id` (`cat_user_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indexes for table `credit_purchase_invoice`
--
ALTER TABLE `credit_purchase_invoice`
  ADD PRIMARY KEY (`cpi_id`);

--
-- Indexes for table `credit_sale_invoice`
--
ALTER TABLE `credit_sale_invoice`
  ADD PRIMARY KEY (`csi_id`);

--
-- Indexes for table `estimate_versions`
--
ALTER TABLE `estimate_versions`
  ADD PRIMARY KEY (`ev_id`),
  ADD KEY `ev_user_id` (`ev_user_id`),
  ADD KEY `ev_job_no` (`ev_job_no`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issue_parts_to_job`
--
ALTER TABLE `issue_parts_to_job`
  ADD PRIMARY KEY (`iptj_id`),
  ADD KEY `iptj_user_id` (`iptj_user_id`),
  ADD KEY `iptj_job_no` (`iptj_job_no`);

--
-- Indexes for table `issue_parts_to_job_items`
--
ALTER TABLE `issue_parts_to_job_items`
  ADD PRIMARY KEY (`iptji_id`),
  ADD KEY `iptji_iptj_id` (`iptji_iptj_id`),
  ADD KEY `iptji_user_id` (`iptji_user_id`);

--
-- Indexes for table `job_accessories`
--
ALTER TABLE `job_accessories`
  ADD PRIMARY KEY (`ja_id`),
  ADD KEY `ja_user_id` (`ja_user_id`),
  ADD KEY `ja_ji_id` (`ja_ji_id`),
  ADD KEY `ja_ip_address` (`ja_ip_address`,`ja_browser_info`),
  ADD KEY `ja_user_id_2` (`ja_user_id`,`ja_accessories`);

--
-- Indexes for table `job_close`
--
ALTER TABLE `job_close`
  ADD PRIMARY KEY (`jc_id`),
  ADD KEY `jc_user_id` (`jc_user_id`),
  ADD KEY `jc_job_id` (`jc_job_no`);

--
-- Indexes for table `job_close_reason`
--
ALTER TABLE `job_close_reason`
  ADD PRIMARY KEY (`jcr_id`),
  ADD KEY `jcr_user_id` (`jcr_user_id`);

--
-- Indexes for table `job_complaint`
--
ALTER TABLE `job_complaint`
  ADD PRIMARY KEY (`jc_id`),
  ADD KEY `jc_user_id` (`jc_user_id`),
  ADD KEY `jc_ji_id` (`jc_ji_id`);

--
-- Indexes for table `job_hold`
--
ALTER TABLE `job_hold`
  ADD PRIMARY KEY (`jh_id`),
  ADD KEY `jh_user_id` (`jh_user_id`),
  ADD KEY `jh_job_no` (`jh_job_no`);

--
-- Indexes for table `job_hold_reason`
--
ALTER TABLE `job_hold_reason`
  ADD PRIMARY KEY (`jhr_id`),
  ADD KEY `jhr_user_id` (`jhr_user_id`);

--
-- Indexes for table `job_information`
--
ALTER TABLE `job_information`
  ADD PRIMARY KEY (`ji_id`),
  ADD KEY `ji_user_id` (`ji_user_id`),
  ADD KEY `ji_bra_id` (`ji_bra_id`),
  ADD KEY `ji_cat_id` (`ji_cat_id`),
  ADD KEY `ji_mod_id` (`ji_mod_id`),
  ADD KEY `ji_cli_id` (`ji_cli_id`);

--
-- Indexes for table `job_information_items`
--
ALTER TABLE `job_information_items`
  ADD PRIMARY KEY (`jii_id`),
  ADD KEY `jii_user_id` (`jii_user_id`),
  ADD KEY `jii_ji_id` (`jii_ji_id`);

--
-- Indexes for table `job_issue_to_technician`
--
ALTER TABLE `job_issue_to_technician`
  ADD PRIMARY KEY (`jitt_id`),
  ADD KEY `jitt_user_id` (`jitt_user_id`),
  ADD KEY `jitt_job_no` (`jitt_job_no`);

--
-- Indexes for table `job_parts_return`
--
ALTER TABLE `job_parts_return`
  ADD PRIMARY KEY (`jpr_id`),
  ADD KEY `jpr_user_id` (`jpr_user_id`),
  ADD KEY `jpr_job_no` (`jpr_job_no`);

--
-- Indexes for table `job_reopen`
--
ALTER TABLE `job_reopen`
  ADD PRIMARY KEY (`jro_id`),
  ADD KEY `jro_user_id` (`jro_user_id`),
  ADD KEY `jro_job_no` (`jro_job_no`);

--
-- Indexes for table `job_transfer`
--
ALTER TABLE `job_transfer`
  ADD PRIMARY KEY (`jt_id`),
  ADD KEY `jt_user_id` (`jt_user_id`),
  ADD KEY `jitt_id` (`jitt_id`),
  ADD KEY `jt_job_no` (`jt_job_no`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_table`
--
ALTER TABLE `model_table`
  ADD PRIMARY KEY (`mod_id`),
  ADD KEY `mod_bra_id` (`mod_bra_id`),
  ADD KEY `mod_cat_id` (`mod_cat_id`),
  ADD KEY `mod_user_id` (`mod_user_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`par_id`),
  ADD KEY `par_user_id` (`par_user_id`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_loss`
--
ALTER TABLE `product_loss`
  ADD PRIMARY KEY (`pl_id`),
  ADD KEY `pl_sto_id` (`pl_sto_id`),
  ADD KEY `pl_user_id` (`pl_user_id`),
  ADD KEY `pl_part_id` (`pl_part_id`);

--
-- Indexes for table `product_recover`
--
ALTER TABLE `product_recover`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `pr_user_id` (`pr_user_id`),
  ADD KEY `pr_sto_id` (`pr_sto_id`),
  ADD KEY `pr_part_id` (`pr_part_id`);

--
-- Indexes for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  ADD PRIMARY KEY (`pi_id`),
  ADD KEY `pi_user_id` (`pi_user_id`);

--
-- Indexes for table `purchase_invoice_items`
--
ALTER TABLE `purchase_invoice_items`
  ADD PRIMARY KEY (`pii_id`),
  ADD KEY `pii_pi_id` (`pii_pi_id`),
  ADD KEY `purchase_invoice_items_ibfk_1` (`pii_user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  ADD PRIMARY KEY (`si_id`),
  ADD KEY `si_user_id` (`si_user_id`);

--
-- Indexes for table `sale_invoice_for_jobs`
--
ALTER TABLE `sale_invoice_for_jobs`
  ADD PRIMARY KEY (`sifj_id`),
  ADD KEY `sifj_user_id` (`sifj_user_id`),
  ADD KEY `sifj_job_no` (`sifj_job_no`);

--
-- Indexes for table `sale_invoice_items`
--
ALTER TABLE `sale_invoice_items`
  ADD PRIMARY KEY (`sii_id`),
  ADD KEY `sii_si_id` (`sii_si_id`),
  ADD KEY `sale_invoice_items_ibfk_1` (`sii_user_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`sto_id`),
  ADD KEY `sto_job_id` (`sto_job_id`),
  ADD KEY `sto_user_id` (`sto_user_id`),
  ADD KEY `sto_par_id` (`sto_par_id`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`tech_id`),
  ADD KEY `tech_user_id` (`tech_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `vendor_user_id` (`vendor_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bra_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cash_account`
--
ALTER TABLE `cash_account`
  MODIFY `ca_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_book`
--
ALTER TABLE `cash_book`
  MODIFY `cb_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cash_payment_voucher`
--
ALTER TABLE `cash_payment_voucher`
  MODIFY `jpv_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_receipt_voucher`
--
ALTER TABLE `cash_receipt_voucher`
  MODIFY `jrv_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cli_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credit_purchase_invoice`
--
ALTER TABLE `credit_purchase_invoice`
  MODIFY `cpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credit_sale_invoice`
--
ALTER TABLE `credit_sale_invoice`
  MODIFY `csi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `estimate_versions`
--
ALTER TABLE `estimate_versions`
  MODIFY `ev_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_parts_to_job`
--
ALTER TABLE `issue_parts_to_job`
  MODIFY `iptj_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `issue_parts_to_job_items`
--
ALTER TABLE `issue_parts_to_job_items`
  MODIFY `iptji_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `job_accessories`
--
ALTER TABLE `job_accessories`
  MODIFY `ja_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_close`
--
ALTER TABLE `job_close`
  MODIFY `jc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_close_reason`
--
ALTER TABLE `job_close_reason`
  MODIFY `jcr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_complaint`
--
ALTER TABLE `job_complaint`
  MODIFY `jc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_hold`
--
ALTER TABLE `job_hold`
  MODIFY `jh_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_hold_reason`
--
ALTER TABLE `job_hold_reason`
  MODIFY `jhr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_information`
--
ALTER TABLE `job_information`
  MODIFY `ji_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_information_items`
--
ALTER TABLE `job_information_items`
  MODIFY `jii_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `job_issue_to_technician`
--
ALTER TABLE `job_issue_to_technician`
  MODIFY `jitt_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_parts_return`
--
ALTER TABLE `job_parts_return`
  MODIFY `jpr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_reopen`
--
ALTER TABLE `job_reopen`
  MODIFY `jro_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_transfer`
--
ALTER TABLE `job_transfer`
  MODIFY `jt_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_table`
--
ALTER TABLE `model_table`
  MODIFY `mod_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `par_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_loss`
--
ALTER TABLE `product_loss`
  MODIFY `pl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_recover`
--
ALTER TABLE `product_recover`
  MODIFY `pr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  MODIFY `pi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_invoice_items`
--
ALTER TABLE `purchase_invoice_items`
  MODIFY `pii_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  MODIFY `si_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_invoice_for_jobs`
--
ALTER TABLE `sale_invoice_for_jobs`
  MODIFY `sifj_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_invoice_items`
--
ALTER TABLE `sale_invoice_items`
  MODIFY `sii_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `sto_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_ibfk_1` FOREIGN KEY (`bra_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cash_account`
--
ALTER TABLE `cash_account`
  ADD CONSTRAINT `cash_account_ibfk_1` FOREIGN KEY (`ca_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cash_book`
--
ALTER TABLE `cash_book`
  ADD CONSTRAINT `cash_book_ibfk_1` FOREIGN KEY (`cb_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cash_book_ibfk_2` FOREIGN KEY (`cb_job_id`) REFERENCES `job_information` (`ji_id`),
  ADD CONSTRAINT `cash_book_ibfk_3` FOREIGN KEY (`cb_jrv_id`) REFERENCES `cash_receipt_voucher` (`jrv_id`),
  ADD CONSTRAINT `cash_book_ibfk_4` FOREIGN KEY (`cb_jpv_id`) REFERENCES `cash_payment_voucher` (`jpv_id`),
  ADD CONSTRAINT `cash_book_ibfk_5` FOREIGN KEY (`cb_ca_id`) REFERENCES `cash_account` (`ca_id`);

--
-- Constraints for table `cash_payment_voucher`
--
ALTER TABLE `cash_payment_voucher`
  ADD CONSTRAINT `cash_payment_voucher_ibfk_1` FOREIGN KEY (`jpv_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cash_payment_voucher_ibfk_2` FOREIGN KEY (`jpv_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `cash_receipt_voucher`
--
ALTER TABLE `cash_receipt_voucher`
  ADD CONSTRAINT `cash_receipt_voucher_ibfk_1` FOREIGN KEY (`jrv_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cash_receipt_voucher_ibfk_2` FOREIGN KEY (`jrv_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`cat_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `estimate_versions`
--
ALTER TABLE `estimate_versions`
  ADD CONSTRAINT `estimate_versions_ibfk_1` FOREIGN KEY (`ev_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `estimate_versions_ibfk_2` FOREIGN KEY (`ev_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `issue_parts_to_job`
--
ALTER TABLE `issue_parts_to_job`
  ADD CONSTRAINT `issue_parts_to_job_ibfk_1` FOREIGN KEY (`iptj_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `issue_parts_to_job_ibfk_2` FOREIGN KEY (`iptj_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `issue_parts_to_job_items`
--
ALTER TABLE `issue_parts_to_job_items`
  ADD CONSTRAINT `issue_parts_to_job_items_ibfk_1` FOREIGN KEY (`iptji_iptj_id`) REFERENCES `issue_parts_to_job` (`iptj_id`),
  ADD CONSTRAINT `issue_parts_to_job_items_ibfk_2` FOREIGN KEY (`iptji_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job_accessories`
--
ALTER TABLE `job_accessories`
  ADD CONSTRAINT `job_accessories_ibfk_1` FOREIGN KEY (`ja_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_accessories_ibfk_2` FOREIGN KEY (`ja_ji_id`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_close`
--
ALTER TABLE `job_close`
  ADD CONSTRAINT `job_close_ibfk_1` FOREIGN KEY (`jc_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_close_ibfk_2` FOREIGN KEY (`jc_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_close_reason`
--
ALTER TABLE `job_close_reason`
  ADD CONSTRAINT `job_close_reason_ibfk_1` FOREIGN KEY (`jcr_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job_complaint`
--
ALTER TABLE `job_complaint`
  ADD CONSTRAINT `job_complaint_ibfk_1` FOREIGN KEY (`jc_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_complaint_ibfk_2` FOREIGN KEY (`jc_ji_id`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_hold`
--
ALTER TABLE `job_hold`
  ADD CONSTRAINT `job_hold_ibfk_1` FOREIGN KEY (`jh_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_hold_ibfk_2` FOREIGN KEY (`jh_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_hold_reason`
--
ALTER TABLE `job_hold_reason`
  ADD CONSTRAINT `job_hold_reason_ibfk_1` FOREIGN KEY (`jhr_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job_information`
--
ALTER TABLE `job_information`
  ADD CONSTRAINT `job_information_ibfk_1` FOREIGN KEY (`ji_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_information_ibfk_2` FOREIGN KEY (`ji_bra_id`) REFERENCES `brands` (`bra_id`),
  ADD CONSTRAINT `job_information_ibfk_3` FOREIGN KEY (`ji_cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `job_information_ibfk_4` FOREIGN KEY (`ji_mod_id`) REFERENCES `model_table` (`mod_id`),
  ADD CONSTRAINT `job_information_ibfk_5` FOREIGN KEY (`ji_cli_id`) REFERENCES `client` (`cli_id`);

--
-- Constraints for table `job_information_items`
--
ALTER TABLE `job_information_items`
  ADD CONSTRAINT `job_information_items_ibfk_1` FOREIGN KEY (`jii_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_information_items_ibfk_2` FOREIGN KEY (`jii_ji_id`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_issue_to_technician`
--
ALTER TABLE `job_issue_to_technician`
  ADD CONSTRAINT `job_issue_to_technician_ibfk_1` FOREIGN KEY (`jitt_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_issue_to_technician_ibfk_2` FOREIGN KEY (`jitt_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_parts_return`
--
ALTER TABLE `job_parts_return`
  ADD CONSTRAINT `job_parts_return_ibfk_1` FOREIGN KEY (`jpr_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_parts_return_ibfk_2` FOREIGN KEY (`jpr_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_reopen`
--
ALTER TABLE `job_reopen`
  ADD CONSTRAINT `job_reopen_ibfk_1` FOREIGN KEY (`jro_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_reopen_ibfk_2` FOREIGN KEY (`jro_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `job_transfer`
--
ALTER TABLE `job_transfer`
  ADD CONSTRAINT `job_transfer_ibfk_1` FOREIGN KEY (`jt_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_transfer_ibfk_2` FOREIGN KEY (`jitt_id`) REFERENCES `job_issue_to_technician` (`jitt_id`),
  ADD CONSTRAINT `job_transfer_ibfk_3` FOREIGN KEY (`jt_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_table`
--
ALTER TABLE `model_table`
  ADD CONSTRAINT `model_table_ibfk_1` FOREIGN KEY (`mod_bra_id`) REFERENCES `brands` (`bra_id`),
  ADD CONSTRAINT `model_table_ibfk_2` FOREIGN KEY (`mod_cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `model_table_ibfk_3` FOREIGN KEY (`mod_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`par_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_loss`
--
ALTER TABLE `product_loss`
  ADD CONSTRAINT `product_loss_ibfk_1` FOREIGN KEY (`pl_sto_id`) REFERENCES `stock` (`sto_id`),
  ADD CONSTRAINT `product_loss_ibfk_2` FOREIGN KEY (`pl_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_loss_ibfk_3` FOREIGN KEY (`pl_part_id`) REFERENCES `parts` (`par_id`);

--
-- Constraints for table `product_recover`
--
ALTER TABLE `product_recover`
  ADD CONSTRAINT `product_recover_ibfk_1` FOREIGN KEY (`pr_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_recover_ibfk_2` FOREIGN KEY (`pr_sto_id`) REFERENCES `stock` (`sto_id`),
  ADD CONSTRAINT `product_recover_ibfk_3` FOREIGN KEY (`pr_part_id`) REFERENCES `parts` (`par_id`);

--
-- Constraints for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  ADD CONSTRAINT `purchase_invoice_ibfk_1` FOREIGN KEY (`pi_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `purchase_invoice_items`
--
ALTER TABLE `purchase_invoice_items`
  ADD CONSTRAINT `purchase_invoice_items_ibfk_1` FOREIGN KEY (`pii_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  ADD CONSTRAINT `sale_invoice_ibfk_1` FOREIGN KEY (`si_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sale_invoice_for_jobs`
--
ALTER TABLE `sale_invoice_for_jobs`
  ADD CONSTRAINT `sale_invoice_for_jobs_ibfk_1` FOREIGN KEY (`sifj_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sale_invoice_for_jobs_ibfk_2` FOREIGN KEY (`sifj_job_no`) REFERENCES `job_information` (`ji_id`);

--
-- Constraints for table `sale_invoice_items`
--
ALTER TABLE `sale_invoice_items`
  ADD CONSTRAINT `sale_invoice_items_ibfk_1` FOREIGN KEY (`sii_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`sto_job_id`) REFERENCES `job_information` (`ji_id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`sto_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`sto_par_id`) REFERENCES `parts` (`par_id`);

--
-- Constraints for table `technician`
--
ALTER TABLE `technician`
  ADD CONSTRAINT `technician_ibfk_1` FOREIGN KEY (`tech_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`vendor_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
