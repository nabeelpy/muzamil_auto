-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 08:59 AM
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
(1, 'default', 'created', 'App\\Models\\User', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"sadmin\",\"f_name\":null,\"address\":null,\"login_status\":null,\"gender\":null,\"email\":\"sadmin@gmail.com\",\"employee_status\":null,\"number\":null,\"work_status\":null}}', NULL, '2022-02-04 02:10:43', '2022-02-04 02:10:43'),
(3, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"sadmin\",\"f_name\":\"sadmin\",\"address\":null,\"login_status\":1,\"gender\":\"Male\",\"email\":\"sadmin@gmail.com\",\"employee_status\":1,\"number\":null,\"work_status\":0},\"old\":{\"name\":\"sadmin\",\"f_name\":null,\"address\":null,\"login_status\":null,\"gender\":null,\"email\":\"sadmin@gmail.com\",\"employee_status\":null,\"number\":null,\"work_status\":null}}', NULL, '2022-02-04 02:22:04', '2022-02-04 02:22:04'),
(4, 'default', 'created', 'App\\Models\\User', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"admin\",\"f_name\":\"admin\",\"address\":null,\"login_status\":1,\"gender\":\"Male\",\"email\":\"admin@gmail.com\",\"employee_status\":1,\"number\":null,\"work_status\":0}}', NULL, '2022-02-04 02:27:33', '2022-02-04 02:27:33'),
(5, 'default', 'created', 'App\\Models\\Technician', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"tech_name\":\"admin\",\"status\":1,\"tech_status\":0}}', NULL, '2022-02-04 02:27:33', '2022-02-04 02:27:33'),
(6, 'default', 'created', 'App\\Models\\PartyModel', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"party_name\":\"Walk In Customer\",\"party_number\":\"0333-3333333\",\"party_address\":null}}', NULL, '2022-02-04 02:30:12', '2022-02-04 02:30:12');

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
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

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
(1, 'Walk In Customer', '0333-3333333', NULL, '1', '127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', '2022-02-04 07:30:12', '2022-02-04 07:30:12');

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
(1, 'Admin', 'web', '2022-02-04 02:12:18', '2022-02-04 02:12:18');

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
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1);

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
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 1, 'admin', b'00000000000000000001', b'00000000000000000000', 2, '2022-02-04 07:27:33', '2022-02-04 02:27:33');

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
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 1, 'sadmin', 'sadmin', NULL, '$2y$10$I21.deEZO7TlNIgz5MsPNe36TMLmW8YZ7ZqdOniSKJO2j3oBMj2wC', b'1', 'Male', 'sadmin@gmail.com', b'1', NULL, NULL, '33333-3333333-3', NULL, '$2y$10$uaJ3I4BQdUfho1Mfh1QEq.Y12DMxwA.IgoSwgMC7lvs6NzbEtSUQO', b'1', '1', NULL, '2022-02-04 02:10:43', '2022-02-04 07:22:04'),
('127.0.0.1', 'Desktop Device \r\nChrome browser | Version:- 97.0.4692.99', 2, 'admin', 'admin', NULL, '$2y$10$jhe13HAGjoC7ORCR8I6WJurV5OBYIkGQ92Wv.6aQ7IBFs1Gic/JFO', b'1', 'Male', 'admin@gmail.com', b'1', NULL, NULL, '33333-3333333-3', NULL, '$2y$10$UvQ0sA2kPGqFml4wRx3buOCuT2KLMRRGmJ5U0/0rcD8jpCLd9tMCy', b'1', '1', NULL, '2022-02-04 02:27:33', '2022-02-04 07:27:33');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bra_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_account`
--
ALTER TABLE `cash_account`
  MODIFY `ca_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_book`
--
ALTER TABLE `cash_book`
  MODIFY `cb_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_payment_voucher`
--
ALTER TABLE `cash_payment_voucher`
  MODIFY `jpv_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_receipt_voucher`
--
ALTER TABLE `cash_receipt_voucher`
  MODIFY `jrv_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cli_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_purchase_invoice`
--
ALTER TABLE `credit_purchase_invoice`
  MODIFY `cpi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_sale_invoice`
--
ALTER TABLE `credit_sale_invoice`
  MODIFY `csi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimate_versions`
--
ALTER TABLE `estimate_versions`
  MODIFY `ev_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_parts_to_job`
--
ALTER TABLE `issue_parts_to_job`
  MODIFY `iptj_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_parts_to_job_items`
--
ALTER TABLE `issue_parts_to_job_items`
  MODIFY `iptji_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_accessories`
--
ALTER TABLE `job_accessories`
  MODIFY `ja_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_close`
--
ALTER TABLE `job_close`
  MODIFY `jc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_close_reason`
--
ALTER TABLE `job_close_reason`
  MODIFY `jcr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_complaint`
--
ALTER TABLE `job_complaint`
  MODIFY `jc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_hold`
--
ALTER TABLE `job_hold`
  MODIFY `jh_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_hold_reason`
--
ALTER TABLE `job_hold_reason`
  MODIFY `jhr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_information`
--
ALTER TABLE `job_information`
  MODIFY `ji_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_information_items`
--
ALTER TABLE `job_information_items`
  MODIFY `jii_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_issue_to_technician`
--
ALTER TABLE `job_issue_to_technician`
  MODIFY `jitt_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_parts_return`
--
ALTER TABLE `job_parts_return`
  MODIFY `jpr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_reopen`
--
ALTER TABLE `job_reopen`
  MODIFY `jro_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_transfer`
--
ALTER TABLE `job_transfer`
  MODIFY `jt_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_table`
--
ALTER TABLE `model_table`
  MODIFY `mod_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `par_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `pl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_recover`
--
ALTER TABLE `product_recover`
  MODIFY `pr_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoice`
--
ALTER TABLE `purchase_invoice`
  MODIFY `pi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoice_items`
--
ALTER TABLE `purchase_invoice_items`
  MODIFY `pii_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  MODIFY `si_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_invoice_for_jobs`
--
ALTER TABLE `sale_invoice_for_jobs`
  MODIFY `sifj_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_invoice_items`
--
ALTER TABLE `sale_invoice_items`
  MODIFY `sii_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `sto_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
