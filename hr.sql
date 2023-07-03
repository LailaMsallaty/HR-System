-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 07:32 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_payments`
--

CREATE TABLE `advance_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED DEFAULT NULL,
  `Previous_Salary` bigint(20) NOT NULL,
  `Statement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Advance_Amount` bigint(20) NOT NULL,
  `Remaining_Amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advance_payments`
--

INSERT INTO `advance_payments` (`id`, `Employee_Id`, `Previous_Salary`, `Statement`, `Advance_Amount`, `Remaining_Amount`, `created_at`, `updated_at`) VALUES
(27, 42, 300000, 'paid', 10000, 290000, '2021-09-28 19:39:50', '2021-09-28 19:39:50'),
(28, 41, 1000000, 'paid', 10000, 990000, '2021-10-03 05:42:20', '2021-10-03 05:42:20'),
(29, 41, 1000000, 'paid', 10000, 980000, '2021-10-03 18:55:32', '2021-10-03 18:56:49'),
(32, 41, 1000000, 'paid', 10000, 970000, '2021-10-20 18:24:40', '2021-10-20 18:24:40'),
(33, 51, 0, 'paid', 10000, -10000, '2021-10-20 18:39:07', '2021-10-20 18:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` bigint(20) UNSIGNED NOT NULL,
  `attachmentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `filename`, `attachmentable_id`, `attachmentable_type`, `created_at`, `updated_at`) VALUES
(6, '131586482_1200px-Visual_Studio_Code_1.35_icon.svg.png', 42, 'App\\Employee', '2021-09-28 19:39:32', '2021-09-28 19:39:32'),
(7, '373518290_Medical-School-Personal-Statement-Guide.jpg', 41, 'App\\Employee', '2021-10-03 05:41:51', '2021-10-03 05:41:51'),
(8, '02a7af5bbbdf80f2ca6720216983dd4c.jpg', 41, 'App\\Employee', '2021-10-20 18:24:01', '2021-10-20 18:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `Employee_Id`, `attendance_date`, `attendance_status`, `created_at`, `updated_at`) VALUES
(13, 41, '2021-09-27', 1, '2021-09-27 07:47:00', '2021-09-27 07:47:00'),
(14, 42, '2021-09-27', 0, '2021-09-27 07:47:28', '2021-09-27 07:47:28'),
(15, 44, '2021-09-27', 1, '2021-09-27 07:48:07', '2021-09-27 07:48:07'),
(16, 43, '2021-09-27', 0, '2021-09-27 07:48:25', '2021-09-27 07:48:25'),
(17, 45, '2021-09-27', 1, '2021-09-27 07:48:38', '2021-09-27 07:48:38'),
(18, 41, '2021-10-03', 0, '2021-10-03 19:12:43', '2021-10-03 19:12:43'),
(19, 51, '2021-10-03', 1, '2021-10-03 19:12:43', '2021-10-03 19:12:43'),
(20, 42, '2021-10-03', 1, '2021-10-03 19:13:08', '2021-10-03 19:13:08'),
(21, 44, '2021-10-03', 0, '2021-10-03 19:13:08', '2021-10-03 19:13:08'),
(22, 43, '2021-10-03', 0, '2021-10-03 19:13:36', '2021-10-03 19:13:36'),
(23, 48, '2021-10-03', 1, '2021-10-03 19:13:36', '2021-10-03 19:13:36'),
(24, 47, '2021-10-03', 1, '2021-10-03 19:13:56', '2021-10-03 19:13:56'),
(25, 47, '2021-10-07', 1, '2021-10-07 15:55:25', '2021-10-07 15:55:25'),
(26, 42, '2021-10-07', 0, '2021-10-07 15:55:52', '2021-10-07 15:55:52'),
(27, 44, '2021-10-07', 1, '2021-10-07 15:55:52', '2021-10-07 15:55:52'),
(28, 43, '2021-10-07', 1, '2021-10-07 15:56:16', '2021-10-07 15:56:16'),
(29, 48, '2021-10-07', 0, '2021-10-07 15:56:16', '2021-10-07 15:56:16'),
(30, 45, '2021-10-07', 1, '2021-10-07 15:56:35', '2021-10-07 15:56:35'),
(31, 41, '2021-10-07', 1, '2021-10-07 15:56:56', '2021-10-07 15:56:56'),
(32, 51, '2021-10-07', 1, '2021-10-07 15:56:56', '2021-10-07 15:56:56'),
(33, 42, '2021-10-08', 1, '2021-10-08 10:14:55', '2021-10-08 10:14:55'),
(34, 44, '2021-10-08', 0, '2021-10-08 10:14:55', '2021-10-08 10:14:55'),
(36, 43, '2021-10-08', 1, '2021-10-08 10:15:31', '2021-10-08 10:15:31'),
(37, 47, '2021-10-08', 1, '2021-10-08 15:12:10', '2021-10-08 15:12:10'),
(38, 48, '2021-10-08', 1, '2021-10-08 15:13:03', '2021-10-08 15:13:03'),
(40, 45, '2021-10-08', 0, '2021-10-08 15:13:20', '2021-10-08 15:13:20'),
(41, 41, '2021-10-08', 1, '2021-10-08 15:13:42', '2021-10-08 15:13:42'),
(42, 51, '2021-10-08', 0, '2021-10-08 15:13:42', '2021-10-08 15:13:42'),
(43, 47, '2021-10-09', 0, '2021-10-09 03:43:28', '2021-10-09 03:43:28'),
(44, 47, '2021-10-20', 1, '2021-10-20 18:52:54', '2021-10-20 18:52:54'),
(45, 60, '2021-10-20', 1, '2021-10-20 19:42:51', '2021-10-20 19:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `Name`, `Description`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"The Employee of the Month\",\"ar\":\"\\u0645\\u0648\\u0638\\u0641 \\u0627\\u0644\\u0634\\u0647\\u0631\"}', 'التفوق على الآخرين في مكان العمل خلال شهر معين', '2021-08-05 11:13:53', '2021-08-05 13:17:52'),
(2, '{\"en\":\"best Effort\",\"ar\":\"\\u0623\\u062f\\u0627\\u0621 \\u0645\\u062a\\u0645\\u064a\\u0632\"}', 'موظف بذل قصارى جهده للاستمرار في العمل', '2021-08-05 11:13:53', '2021-09-19 06:30:32'),
(3, '{\"en\":\"Extra Mile\",\"ar\":\"\\u0628\\u0630\\u0644 \\u062c\\u0647\\u062f \\u0625\\u0636\\u0627\\u0641\\u064a\"}', 'بذل جهد إضافي لإنجاز المهمة', '2021-08-05 11:13:53', '2021-09-19 06:29:46'),
(4, '{\"en\":\"best Performance\",\"ar\":\"\\u0623\\u0641\\u0636\\u0644 \\u0623\\u062f\\u0627\\u0621\"}', 'التعلم من الإخفاقات وتحسين المهارات في العمل', '2021-08-05 11:13:53', '2021-09-19 06:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Country_Id` bigint(20) UNSIGNED NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `Country_Id`, `Name`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"en\":\"Damascus\",\"ar\":\"\\u062f\\u0645\\u0634\\u0642\"}', '2021-08-02 16:07:32', '2021-08-02 16:07:32'),
(2, 3, '{\"en\":\"Cairo\",\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\"}', '2021-08-02 16:07:32', '2021-08-02 16:07:32'),
(3, 2, '{\"en\":\"Beirut\",\"ar\":\"\\u0628\\u064a\\u0631\\u0648\\u062a\"}', '2021-08-02 16:07:32', '2021-08-02 16:07:32'),
(4, 4, '{\"en\":\"Dubai\",\"ar\":\"\\u062f\\u0628\\u064a\"}', '2021-08-02 16:07:32', '2021-08-02 16:07:32'),
(5, 1, '{\"en\":\"Aleppo\",\"ar\":\"\\u062d\\u0644\\u0628\"}', '2021-08-02 16:07:32', '2021-08-02 16:07:32'),
(7, 1, '{\"en\":\"Lattakia\",\"ar\":\"\\u0627\\u0644\\u0644\\u0627\\u0630\\u0642\\u064a\\u0629\"}', '2021-10-03 06:09:34', '2021-10-03 06:09:34'),
(9, 9, '{\"en\":\"oman\",\"ar\":\"\\u0639\\u0645\\u0627\\u0646\"}', '2021-10-20 18:25:59', '2021-10-20 18:25:59'),
(10, 1, '{\"en\":\"homs\",\"ar\":\"\\u062d\\u0645\\u0635\"}', '2021-10-20 18:25:59', '2021-10-20 18:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `Name`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Syria\",\"ar\":\"\\u0633\\u0648\\u0631\\u064a\\u0627\"}', '2021-08-02 16:06:46', '2021-08-02 16:06:46'),
(2, '{\"en\":\"Lebanon\",\"ar\":\"\\u0644\\u0628\\u0646\\u0627\\u0646\"}', '2021-08-02 16:06:46', '2021-08-02 16:06:46'),
(3, '{\"en\":\"Egypt\",\"ar\":\"\\u0645\\u0635\\u0631\"}', '2021-08-02 16:06:46', '2021-08-02 16:06:46'),
(4, '{\"en\":\"Emarat\",\"ar\":\"\\u0627\\u0644\\u0625\\u0645\\u0627\\u0631\\u0627\\u062a\"}', '2021-08-02 16:06:46', '2021-08-02 16:06:46'),
(9, '{\"en\":\"jordan\",\"ar\":\"\\u0627\\u0644\\u0623\\u0631\\u062f\\u0646\"}', '2021-10-20 18:25:30', '2021-10-20 18:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `Name`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Web Application Development\",\"ar\":\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628\"}', '2021-08-02 16:09:11', '2021-08-02 16:09:11'),
(2, '{\"en\":\"Android Application Development\",\"ar\":\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a \\u0627\\u0644\\u0623\\u0646\\u062f\\u0631\\u0648\\u064a\\u062f\"}', '2021-08-02 16:09:11', '2021-08-02 16:09:11'),
(3, '{\"en\":\"Photoshop Design\",\"ar\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0641\\u0648\\u062a\\u0648\\u0634\\u0648\\u0628\"}', '2021-08-02 16:09:11', '2021-08-02 16:09:11'),
(4, '{\"en\":\"Desktop Application Development\",\"ar\":\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a \\u0633\\u0637\\u062d \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\"}', '2021-08-02 16:09:11', '2021-08-02 16:09:11'),
(5, '{\"en\":\"HR Management\",\"ar\":\"\\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0631\\u062f \\u0627\\u0644\\u0628\\u0634\\u0631\\u064a\\u0629\"}', '2021-09-24 17:37:37', '2021-09-24 17:37:37'),
(9, '{\"en\":\"Financial affairs\",\"ar\":\"\\u0627\\u0644\\u0634\\u0624\\u0648\\u0646 \\u0627\\u0644\\u0645\\u0627\\u0644\\u064a\\u0629\"}', '2021-10-20 18:26:25', '2021-10-20 18:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `department_location`
--

CREATE TABLE `department_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `Location_Id` bigint(20) UNSIGNED NOT NULL,
  `Department_Id` bigint(20) UNSIGNED NOT NULL,
  `Manager_Id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_location`
--

INSERT INTO `department_location` (`id`, `Location_Id`, `Department_Id`, `Manager_Id`, `created_at`, `updated_at`) VALUES
(35, 4, 5, NULL, '2021-09-24 17:38:34', '2021-10-08 15:06:54'),
(46, 7, 1, NULL, '2021-10-03 06:18:41', '2021-10-08 13:12:05'),
(47, 7, 2, 44, '2021-10-03 06:18:41', '2021-10-08 18:18:09'),
(51, 4, 3, NULL, '2021-10-08 18:19:09', '2021-10-08 18:23:00'),
(52, 4, 4, NULL, '2021-10-08 18:57:10', '2021-10-08 18:57:10'),
(53, 2, 3, NULL, '2021-10-08 19:20:10', '2021-10-08 19:20:10'),
(66, 2, 5, NULL, '2021-10-08 20:37:53', '2021-10-08 20:58:47'),
(72, 10, 2, NULL, '2021-10-20 18:34:56', '2021-10-20 18:34:56'),
(73, 10, 3, NULL, '2021-10-20 18:34:56', '2021-10-20 18:34:56'),
(74, 10, 4, NULL, '2021-10-20 18:34:56', '2021-10-20 18:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `FName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BirthDate` date NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salary` bigint(20) NOT NULL DEFAULT 0,
  `Location_Id` bigint(20) UNSIGNED NOT NULL,
  `Nationality_Employee_id` bigint(20) UNSIGNED NOT NULL,
  `Degree_Id` bigint(20) UNSIGNED NOT NULL,
  `Skills` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HireDate` date NOT NULL,
  `Address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Department_Id` bigint(20) UNSIGNED NOT NULL,
  `Manager` tinyint(4) NOT NULL,
  `Trainee` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Years_Of_Experience` int(11) NOT NULL,
  `ImageName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `FName`, `LName`, `BirthDate`, `email`, `Number`, `Code`, `Salary`, `Location_Id`, `Nationality_Employee_id`, `Degree_Id`, `Skills`, `Gender`, `HireDate`, `Address`, `Department_Id`, `Manager`, `Trainee`, `Years_Of_Experience`, `ImageName`, `deleted_at`, `created_at`, `updated_at`) VALUES
(41, 'laila', 'msallaty', '2021-09-20', 'lailamsallaty607@gmail.com', '51487541', '20319', 1000000, 7, 10353, 166, 'php laravel', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-09-23', 'cairo street', 1, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, '1012296303_personal-development-and-health-services-session-woman-kitty-ghen.jpg', NULL, '2021-09-23 08:04:45', '2021-10-08 13:12:05'),
(42, 'amar', 'msallaty', '2021-09-14', 'amar@gmail.com', '125987', '94006', 300000, 4, 10139, 166, 'illustarator', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-09-23', 'mazza', 3, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, '1073616124_images (1).jpg', NULL, '2021-09-23 08:34:25', '2021-10-03 15:35:18'),
(43, 'lujain', 'Alnaser', '2021-09-08', 'lujain@gmail.com', '23454678', '75920', 200000, 4, 10138, 166, 'c++', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-09-23', 'New Aleppo', 4, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, '2045507040_images (2).jpg', NULL, '2021-09-23 08:37:27', '2021-10-08 13:10:22'),
(44, 'kawkab', 'jeje', '2021-09-07', 'kawkab@gmail.com', '213452432', '74253', 500000, 7, 10138, 166, 'illustrator', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-09-24', 'Shahbaa', 2, 1, '{\"ar\":\"\\u0646\\u0639\\u0645\",\"en\":\"Yes\"}', 3, '629409270_emily-blunt-16x9.jpg', NULL, '2021-09-24 17:22:18', '2021-10-08 18:18:09'),
(45, 'joud', 'almuhamed', '2021-09-29', 'joud@gmail.com', '21345678', '86575', 200000, 4, 10131, 166, 'management', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-10-01', 'Gamilia', 5, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, '1938416799_images.jpg', NULL, '2021-09-24 17:32:48', '2021-09-24 17:41:19'),
(47, 'abdo', 'msallaty', '2021-10-18', 'abdo@gmail.com', '09875786', '24822', 300000, 2, 10347, 166, 'illustrator', '{\"ar\":\"\\u0630\\u0643\\u0631\",\"en\":\"Male\"}', '2021-10-02', 'mazza', 3, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, '470101004_images (5).jpg', NULL, '2021-10-02 17:50:24', '2021-10-03 15:20:13'),
(48, 'sana', 'humsi', '2021-09-26', 'sana@gmail.com', '76854632', '79563', 200000, 4, 10361, 166, 'c++', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-10-03', 'New Aleppo', 4, 0, '{\"ar\":\"\\u0646\\u0639\\u0645\",\"en\":\"Yes\"}', 2, 'Personal-Assistant11.jpg', NULL, '2021-10-03 06:44:50', '2021-10-03 06:54:31'),
(50, 'ahmed', 'msallaty', '2021-09-26', 'ahmed@gmail.com', '098667532', '47942', 400000, 1, 10140, 166, 'php', '{\"ar\":\"\\u0630\\u0643\\u0631\",\"en\":\"Male\"}', '2021-10-03', 'cairo street', 1, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, 'images (6).jpg', NULL, '2021-10-03 14:58:38', '2021-10-03 15:09:08'),
(51, 'noor', 'horan', '2021-09-26', 'noor@gmail.com', '987896543', '33851', 0, 7, 10137, 166, 'php', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-10-03', 'beirut street', 1, 0, '{\"ar\":\"\\u0646\\u0639\\u0645\",\"en\":\"Yes\"}', 2, '1330119138_photo_2020-09-21_20-49-25.jpg', NULL, '2021-10-03 15:25:24', '2021-10-03 15:25:24'),
(60, 'sara', 'ali', '1993-06-09', 'sara@gmail.com', '32456477', '24431', 1000000, 7, 10322, 166, 'php laravel', '{\"ar\":\"\\u0623\\u0646\\u062b\\u0649\",\"en\":\"Female\"}', '2021-10-21', 'beirut street', 1, 0, '{\"ar\":\"\\u0644\\u0627\",\"en\":\"No\"}', 2, '02a7af5bbbdf80f2ca6720216983dd4c.jpg', NULL, '2021-10-20 18:43:59', '2021-10-20 18:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `employee_awards`
--

CREATE TABLE `employee_awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `Award_Id` bigint(20) UNSIGNED NOT NULL,
  `Gift` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cash_Prize` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_awards`
--

INSERT INTO `employee_awards` (`id`, `Employee_Id`, `Award_Id`, `Gift`, `Cash_Prize`, `created_at`, `updated_at`) VALUES
(22, 41, 2, 'Notebook', 10000, '2021-09-23 16:44:24', '2021-09-23 16:44:24'),
(23, 42, 2, 'Notebook', 100000, '2021-09-29 08:27:09', '2021-09-29 08:27:09'),
(24, 42, 2, 'Notebook', 100000, '2021-09-29 08:27:44', '2021-09-29 08:27:44'),
(25, 42, 2, 'Notebook', 1000, '2021-09-29 18:27:53', '2021-09-29 18:27:53'),
(26, 42, 2, 'Notebook', 10000, '2021-09-29 18:29:25', '2021-09-29 18:29:25'),
(27, 42, 1, 'Notebook', 10000, '2021-09-30 05:34:22', '2021-09-30 05:34:22'),
(28, 42, 2, 'Notebook', 1000, '2021-09-30 05:50:13', '2021-09-30 05:50:13'),
(29, 42, 1, 'Notebook', 1000, '2021-09-30 16:04:51', '2021-09-30 16:04:51'),
(30, 48, 1, 'Notebook', 1000, '2021-10-03 19:38:38', '2021-10-03 19:38:38'),
(31, 43, 2, 'Notebook', 10000, '2021-10-04 08:22:39', '2021-10-04 08:22:39'),
(32, 43, 1, 'Notebook', 10000, '2021-10-04 08:23:23', '2021-10-04 08:23:23'),
(33, 43, 3, 'Notebook', 20000, '2021-10-04 08:23:43', '2021-10-04 08:23:43'),
(34, 43, 2, 'Notebook', 2000, '2021-10-04 08:24:32', '2021-10-04 08:24:32'),
(35, 44, 4, 'Notebook', 1000, '2021-10-05 16:02:00', '2021-10-05 16:02:00'),
(36, 42, 2, 'Notebook', 10000, '2021-10-08 10:21:30', '2021-10-08 10:21:30'),
(37, 41, 2, 'Notebook', 100000, '2021-10-20 19:00:54', '2021-10-20 19:00:54'),
(38, 60, 1, 'Notebook', 10000, '2021-10-20 19:01:42', '2021-10-20 19:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `employee_degree`
--

CREATE TABLE `employee_degree` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_degree`
--

INSERT INTO `employee_degree` (`id`, `Level`, `created_at`, `updated_at`) VALUES
(165, '{\"en\":\"Student\",\"ar\":\" \\u0637\\u0627\\u0644\\u0628\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(166, '{\"en\":\"Bachelor\\u2019s Degree\",\"ar\":\" \\u0628\\u0627\\u0643\\u0644\\u0648\\u0631\\u064a\\u0648\\u0633\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(167, '{\"en\":\"Master\\u2019s Degree\",\"ar\":\"\\u0645\\u0627\\u062c\\u064a\\u0633\\u062a\\u064a\\u0631\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(168, '{\"en\":\"Doctoral\",\"ar\":\" \\u062f\\u0643\\u062a\\u0648\\u0631\\u0627\\u0647\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `Leave_Id` bigint(20) UNSIGNED NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `TotalDays` double NOT NULL,
  `Status` int(50) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`id`, `Employee_Id`, `Leave_Id`, `Start_Date`, `End_Date`, `TotalDays`, `Status`, `created_at`, `updated_at`) VALUES
(17, 41, 1, '2021-09-26', '2021-10-02', 6, 0, '2021-09-23 16:49:09', '2021-09-23 16:49:09'),
(34, 42, 1, '2021-09-28', '2021-10-01', 3, 1, '2021-09-29 07:47:27', '2021-09-29 07:48:10'),
(35, 42, 1, '2021-09-29', '2021-10-09', 10, 0, '2021-09-30 05:40:50', '2021-09-30 05:40:50'),
(36, 42, 1, '2021-09-29', '2021-10-09', 10, 0, '2021-09-30 06:25:59', '2021-09-30 06:25:59'),
(37, 48, 1, '2021-10-03', '2021-10-07', 4, 1, '2021-10-03 06:56:29', '2021-10-03 06:57:37'),
(38, 48, 1, '2021-09-26', '2021-10-08', 12, 0, '2021-10-03 06:59:03', '2021-10-03 06:59:03'),
(39, 48, 1, '2021-10-01', '2021-10-06', 5, 0, '2021-10-03 07:04:51', '2021-10-03 07:04:51'),
(40, 48, 1, '2021-10-04', '2021-10-19', 15, 0, '2021-10-03 19:28:21', '2021-10-03 19:28:21'),
(41, 48, 1, '2021-10-04', '2021-10-13', 9, 1, '2021-10-03 19:31:22', '2021-10-03 19:33:22'),
(42, 42, 3, '2021-10-06', '2021-10-08', 2, 2, '2021-10-08 10:17:53', '2021-10-08 10:19:33'),
(43, 42, 3, '2021-10-21', '2021-10-23', 2, 1, '2021-10-20 18:56:31', '2021-10-20 18:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `employee_punishments`
--

CREATE TABLE `employee_punishments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `Punishment_Id` bigint(20) UNSIGNED NOT NULL,
  `Statement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_punishments`
--

INSERT INTO `employee_punishments` (`id`, `Employee_Id`, `Punishment_Id`, `Statement`, `created_at`, `updated_at`) VALUES
(12, 42, 2, 'توبيخ', '2021-09-23 08:58:17', '2021-09-23 08:58:17'),
(14, 41, 1, 'ايقاف مؤقت', '2021-09-23 15:37:38', '2021-10-07 17:30:11'),
(15, 42, 2, 'توبيخ', '2021-09-28 09:08:55', '2021-09-28 09:08:55'),
(16, 42, 2, 'توبيخ', '2021-09-28 09:16:00', '2021-09-28 09:16:00'),
(17, 42, 1, 'ايقاف مؤقت', '2021-09-28 09:18:58', '2021-10-07 17:29:51'),
(18, 42, 1, 'ايقاف مؤقت', '2021-09-28 14:10:37', '2021-09-28 14:10:37'),
(20, 42, 3, 'ناتج عن سوء تصرف', '2021-10-08 09:49:41', '2021-10-08 09:49:41'),
(21, 60, 1, 'stop working', '2021-10-20 18:46:49', '2021-10-20 18:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `employee_requests`
--

CREATE TABLE `employee_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `Request_Id` bigint(20) UNSIGNED NOT NULL,
  `Statement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Reply_Statement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HR_Comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_requests`
--

INSERT INTO `employee_requests` (`id`, `Employee_Id`, `Request_Id`, `Statement`, `Reply_Statement`, `HR_Comment`, `Status`, `created_at`, `updated_at`) VALUES
(20, 41, 217, '373518290_Medical-School-Personal-Statement-Guide.jpg', NULL, NULL, 1, '2021-09-23 17:22:19', '2021-10-08 15:21:48'),
(22, 41, 219, '1073616124_images (1).jpg', NULL, NULL, 1, '2021-09-26 14:30:09', '2021-10-08 15:21:53'),
(27, 42, 217, '1012296303_personal-development-and-health-services-session-woman-kitty-ghen.jpg', '126994782_مقدمة-إلى-برمجة-الخادم.jpg', 'hi', 1, '2021-09-29 08:59:09', '2021-09-29 15:11:56'),
(28, 42, 217, '373518290_Medical-School-Personal-Statement-Guide.jpg', NULL, NULL, 2, '2021-09-29 15:13:05', '2021-09-29 15:13:33'),
(29, 45, 217, '128010323_Ax87s.png', NULL, NULL, 2, '2021-09-29 16:13:26', '2021-10-08 15:21:58'),
(30, 48, 217, '373518290_Medical-School-Personal-Statement-Guide.jpg', NULL, NULL, 1, '2021-10-03 07:07:42', '2021-10-08 15:22:04'),
(31, 48, 217, '373518290_Medical-School-Personal-Statement-Guide.jpg', NULL, NULL, 1, '2021-10-03 07:09:22', '2021-10-08 15:22:09'),
(32, 48, 217, '373518290_Medical-School-Personal-Statement-Guide.jpg', NULL, NULL, 2, '2021-10-03 07:14:41', '2021-10-08 15:22:18'),
(33, 48, 217, '151696564_photo_2020-09-18_18-47-22.jpg', NULL, NULL, 1, '2021-10-03 07:18:31', '2021-10-08 15:22:21'),
(34, 48, 218, '373518290_Medical-School-Personal-Statement-Guide.jpg', NULL, NULL, 1, '2021-10-03 19:45:37', '2021-10-03 19:48:10'),
(36, 42, 218, '629409270_emily-blunt-16x9.jpg', '151696564_photo_2020-09-18_18-47-22.jpg', 'تم', 1, '2021-10-08 10:31:31', '2021-10-08 10:32:55'),
(37, 42, 217, '1073616124_images (1).jpg', '1012296303_personal-development-and-health-services-session-woman-kitty-ghen.jpg', 'تم', 2, '2021-10-08 10:33:56', '2021-10-08 15:22:29'),
(38, 42, 218, '1076688493_0d1cfff9d7c39fe3c4f5c67035e11334.jpg', '751041594_tmp_Dlvl6H_b33e8a79f54238ab_GettyImages-942347602.jpg', 'تم', 1, '2021-10-08 10:35:50', '2021-10-08 15:22:34'),
(39, 41, 218, 'slip.pdf', '1012296303_personal-development-and-health-services-session-woman-kitty-ghen.jpg', 'تم', 1, '2021-10-08 15:16:24', '2021-10-08 15:17:16'),
(40, 41, 217, 'Slip.pdf', NULL, NULL, 0, '2021-10-08 15:20:50', '2021-10-08 15:20:50'),
(41, 60, 218, 'photo_2021-09-15_23-35-39.jpg', 'photo_2021-09-15_23-35-50.jpg', 'اليك الرد', 1, '2021-10-20 19:08:09', '2021-10-20 19:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `Position_Id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_role`
--

INSERT INTO `employee_role` (`id`, `Position_Id`, `Employee_Id`, `created_at`, `updated_at`) VALUES
(48, 1, 41, '2021-09-23 08:04:45', '2021-09-23 08:04:45'),
(49, 3, 41, '2021-09-23 08:04:45', '2021-09-23 08:04:45'),
(50, 4, 42, '2021-09-23 08:34:25', '2021-09-23 08:34:25'),
(51, 5, 43, '2021-09-23 08:37:27', '2021-09-23 08:37:27'),
(54, 6, 45, '2021-09-24 17:41:19', '2021-09-24 17:41:19'),
(56, 4, 47, '2021-10-02 17:50:24', '2021-10-02 17:50:24'),
(57, 5, 48, '2021-10-03 06:44:50', '2021-10-03 06:44:50'),
(60, 1, 50, '2021-10-03 14:58:38', '2021-10-03 14:58:38'),
(61, 1, 51, '2021-10-03 15:25:24', '2021-10-03 15:25:24'),
(67, 2, 44, '2021-10-08 18:05:48', '2021-10-08 18:05:48'),
(91, 1, 60, '2021-10-20 18:43:59', '2021-10-20 18:43:59'),
(92, 3, 60, '2021-10-20 18:43:59', '2021-10-20 18:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `id` int(10) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `Sum_Advances` bigint(20) NOT NULL,
  `Taxes` double NOT NULL,
  `Insurance` double NOT NULL,
  `Bonus` double NOT NULL DEFAULT 0,
  `Total` double NOT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`id`, `Employee_Id`, `Sum_Advances`, `Taxes`, `Insurance`, `Bonus`, `Total`, `Start_Date`, `End_Date`, `created_at`, `updated_at`) VALUES
(34, 42, 0, 10, 10, 5, 235000, '2021-09-01', '2021-09-30', '2021-09-28 18:02:45', '2021-09-28 18:02:45'),
(35, 42, 0, 10, 10, 5, 235000, '2021-09-01', '2021-09-30', '2021-09-28 18:05:01', '2021-09-28 18:05:01'),
(37, 41, 20000, 10, 10, 5, 830000, '2021-10-01', '2021-10-31', '2021-10-03 19:11:05', '2021-10-03 19:11:05'),
(41, 42, 20000, 10, 5, 5, 250000, '2021-11-01', '2021-11-30', '2021-10-08 12:57:17', '2021-10-08 12:57:17'),
(42, 42, 20000, 10, 10, 5, 125000, '2021-10-01', '2021-10-31', '2021-10-08 12:57:49', '2021-10-08 12:57:49'),
(43, 48, 20000, 10, 10, 5, 56666.666666667, '2021-10-01', '2021-10-31', '2021-10-08 13:05:28', '2021-10-08 13:05:28'),
(44, 43, 20000, 10, 10, 5, 143333.33333333, '2021-10-01', '2021-10-31', '2021-10-08 14:07:29', '2021-10-08 14:07:29'),
(45, 43, 20000, 10, 10, 5, 160000, '2021-09-01', '2021-09-30', '2021-10-08 14:09:19', '2021-10-08 14:09:19'),
(46, 60, 30000, 10, 10, 5, 786666.66666667, '2021-10-01', '2021-10-31', '2021-10-20 18:48:17', '2021-10-20 18:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `created_at`, `updated_at`) VALUES
(3, '{\"en\":\"New Year Day\",\"ar\":\"\\u0639\\u0637\\u0644\\u0629 \\u0631\\u0623\\u0633 \\u0627\\u0644\\u0633\\u0646\\u0629 \\u0627\\u0644\\u0645\\u064a\\u0644\\u0627\\u062f\\u064a\\u0629\"}', '2022-01-01', '2022-01-01', '2021-09-12 18:56:46', '2021-10-20 18:27:05'),
(4, '{\"en\":\"Adha Eid\",\"ar\":\"\\u0639\\u0637\\u0644\\u0629 \\u0639\\u064a\\u062f \\u0627\\u0644\\u0627\\u0636\\u062d\\u0649\"}', '2021-09-13', '2021-09-13', '2021-09-12 18:57:02', '2021-09-13 16:16:27'),
(5, '{\"en\":\"October liberating war\",\"ar\":\"\\u062d\\u0631\\u0628 \\u062a\\u0634\\u0631\\u064a\\u0646 \\u0627\\u0644\\u062a\\u062d\\u0631\\u064a\\u0631\\u064a\\u0629\"}', '2021-10-06', '2021-10-06', '2021-10-07 17:36:50', '2021-10-07 17:36:50'),
(6, '{\"en\":\"Prophet\'s birthday\",\"ar\":\"\\u0639\\u064a\\u062f \\u0627\\u0644\\u0645\\u0648\\u0644\\u062f \\u0627\\u0644\\u0646\\u0628\\u0648\\u064a \\u0627\\u0644\\u0634\\u0631\\u064a\\u0641\"}', '2021-10-17', '2021-10-19', '2021-10-07 17:41:00', '2021-10-07 17:41:34'),
(7, '{\"en\":\"migration day\",\"ar\":\"\\u0631\\u0627\\u0633 \\u0627\\u0644\\u0633\\u0646\\u0629 \\u0627\\u0644\\u0647\\u062c\\u0631\\u064a\\u0629\"}', '2021-10-06', '2021-10-06', '2021-10-20 18:30:19', '2021-10-20 18:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `Name`, `Days`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"sick\",\"ar\":\"\\u0645\\u0631\\u064a\\u0636\"}', 21, '2021-08-02 16:48:11', '2021-09-19 06:26:21'),
(2, '{\"en\":\"marriage\",\"ar\":\"\\u0632\\u0648\\u0627\\u062c\"}', 7, '2021-08-02 16:48:11', '2021-09-19 06:26:39'),
(3, '{\"en\":\"holiday\",\"ar\":\"\\u0639\\u0637\\u0644\\u0629\"}', 10, '2021-08-02 16:48:37', '2021-08-02 16:48:37'),
(4, '{\"en\":\"A death case\",\"ar\":\"\\u062d\\u0627\\u0644\\u0629 \\u0648\\u0641\\u0627\\u0629\"}', 5, '2021-08-02 16:48:52', '2021-08-02 16:48:52'),
(6, '{\"en\":\"normal leave\",\"ar\":\"\\u0625\\u062c\\u0627\\u0632\\u0629 \\u0639\\u0627\\u062f\\u064a\\u0629\"}', 1, '2021-10-20 18:33:01', '2021-10-20 18:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `City_Id` bigint(20) UNSIGNED NOT NULL,
  `Address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `City_Id`, `Address`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"en\":\"New Egypt\",\"ar\":\"\\u0645\\u0635\\u0631 \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629\"}', '2021-08-02 16:09:32', '2021-08-02 16:09:32'),
(2, 1, '{\"en\":\"Hamra street\",\"ar\":\"\\u0634\\u0627\\u0631\\u0639 \\u0627\\u0644\\u062d\\u0645\\u0631\\u0627\"}', '2021-08-02 16:09:50', '2021-08-02 16:09:50'),
(4, 5, '{\"en\":\"Furkan\",\"ar\":\"\\u0627\\u0644\\u0641\\u0631\\u0642\\u0627\\u0646\"}', '2021-08-02 16:10:22', '2021-08-02 16:10:22'),
(7, 3, '{\"en\":\"Beirut Street\",\"ar\":\"\\u0634\\u0627\\u0631\\u0639 \\u0628\\u064a\\u0631\\u0648\\u062a\"}', '2021-10-03 06:18:41', '2021-10-03 06:18:41'),
(10, 7, '{\"en\":\"Project 7\",\"ar\":\"\\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639 \\u0627\\u0644\\u0633\\u0627\\u0628\\u0639\"}', '2021-10-20 18:34:56', '2021-10-20 18:34:56');

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
(4, '2021_03_29_170422_create_Positions_table', 1),
(5, '2021_04_03_174103_create_Departments_table', 1),
(6, '2021_04_03_174103_create_Employees_table', 1),
(7, '2021_04_08_212312_create_Employee_Degree_table', 1),
(8, '2021_04_11_180503_create_Employee_Role_table', 1),
(9, '2021_04_16_185833_create_Countries_table', 1),
(10, '2021_04_16_185833_create_nationalities_table', 1),
(11, '2021_04_17_185833_create_Cities_table', 1),
(12, '2021_04_17_230052_create_job_seekers_table', 1),
(13, '2021_04_17_232631_create_job_seeker_degrees_table', 1),
(14, '2021_04_20_215814_create_Department_Location_table', 1),
(15, '2021_04_20_215814_create_Locations_table', 1),
(16, '2021_04_27_212035_create_Employee_Salary_table', 1),
(17, '2021_05_07_204703_create_Attachments_table', 1),
(18, '2021_07_12_164047_create_Advance_Payments_table', 1),
(19, '2021_07_17_124348_create_attendances_table', 1),
(20, '2021_08_01_200155_create_leaves_table', 1),
(21, '2021_08_22_165746_create_Employee_Leaves_table', 1),
(22, '2021_08_23_174113_create_foreign_keys', 1),
(23, '2021_08_05_125351_create_awards_table', 2),
(24, '2021_08_05_165400_create_Employee_Awards_table', 3),
(25, '2021_08_12_160946_create_requests_table', 4),
(26, '2021_08_12_163142_create_employee_requests_table', 4),
(27, '2021_08_20_192631_create_tasks_table', 5),
(28, '2021_08_24_192643_create_punishments_table', 6),
(29, '2021_08_24_193127_employee__punishments', 6),
(30, '2021_09_04_200000_create_permission_tables', 7),
(31, '2021_09_11_201646_create_events_table', 8),
(32, '2021_09_14_215753_create_foreign__employee__user', 9),
(33, '2021_09_27_174601_create_notifications_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(28, 'App\\User', 54),
(29, 'App\\User', 53),
(29, 'App\\User', 57),
(29, 'App\\User', 58),
(29, 'App\\User', 59),
(29, 'App\\User', 61),
(29, 'App\\User', 62),
(29, 'App\\User', 71),
(30, 'App\\User', 56),
(31, 'App\\User', 55),
(31, 'App\\User', 69),
(32, 'App\\User', 52);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `Name`, `created_at`, `updated_at`) VALUES
(10128, '{\"en\":\"Afghan\",\"ar\":\"\\u0623\\u0641\\u063a\\u0627\\u0646\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10129, '{\"en\":\"Albanian\",\"ar\":\"\\u0623\\u0644\\u0628\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10130, '{\"en\":\"Aland Islander\",\"ar\":\"\\u0622\\u0644\\u0627\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10131, '{\"en\":\"Algerian\",\"ar\":\"\\u062c\\u0632\\u0627\\u0626\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10132, '{\"en\":\"American Samoan\",\"ar\":\"\\u0623\\u0645\\u0631\\u064a\\u0643\\u064a \\u0633\\u0627\\u0645\\u0648\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10133, '{\"en\":\"Andorran\",\"ar\":\"\\u0623\\u0646\\u062f\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10134, '{\"en\":\"Angolan\",\"ar\":\"\\u0623\\u0646\\u0642\\u0648\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10135, '{\"en\":\"Anguillan\",\"ar\":\"\\u0623\\u0646\\u063a\\u0648\\u064a\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10136, '{\"en\":\"Antarctican\",\"ar\":\"\\u0623\\u0646\\u062a\\u0627\\u0631\\u0643\\u062a\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10137, '{\"en\":\"Antiguan\",\"ar\":\"\\u0628\\u0631\\u0628\\u0648\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10138, '{\"en\":\"Argentinian\",\"ar\":\"\\u0623\\u0631\\u062c\\u0646\\u062a\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10139, '{\"en\":\"Armenian\",\"ar\":\"\\u0623\\u0631\\u0645\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10140, '{\"en\":\"Aruban\",\"ar\":\"\\u0623\\u0648\\u0631\\u0648\\u0628\\u0647\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10141, '{\"en\":\"Australian\",\"ar\":\"\\u0623\\u0633\\u062a\\u0631\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10142, '{\"en\":\"Austrian\",\"ar\":\"\\u0646\\u0645\\u0633\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10143, '{\"en\":\"Azerbaijani\",\"ar\":\"\\u0623\\u0630\\u0631\\u0628\\u064a\\u062c\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10144, '{\"en\":\"Bahamian\",\"ar\":\"\\u0628\\u0627\\u0647\\u0627\\u0645\\u064a\\u0633\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10145, '{\"en\":\"Bahraini\",\"ar\":\"\\u0628\\u062d\\u0631\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10146, '{\"en\":\"Bangladeshi\",\"ar\":\"\\u0628\\u0646\\u063a\\u0644\\u0627\\u062f\\u064a\\u0634\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10147, '{\"en\":\"Barbadian\",\"ar\":\"\\u0628\\u0631\\u0628\\u0627\\u062f\\u0648\\u0633\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10148, '{\"en\":\"Belarusian\",\"ar\":\"\\u0631\\u0648\\u0633\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10149, '{\"en\":\"Belgian\",\"ar\":\"\\u0628\\u0644\\u062c\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10150, '{\"en\":\"Belizean\",\"ar\":\"\\u0628\\u064a\\u0644\\u064a\\u0632\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10151, '{\"en\":\"Beninese\",\"ar\":\"\\u0628\\u0646\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10152, '{\"en\":\"Saint Barthelmian\",\"ar\":\"\\u0633\\u0627\\u0646 \\u0628\\u0627\\u0631\\u062a\\u064a\\u0644\\u0645\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10153, '{\"en\":\"Bermudan\",\"ar\":\"\\u0628\\u0631\\u0645\\u0648\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10154, '{\"en\":\"Bhutanese\",\"ar\":\"\\u0628\\u0648\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10155, '{\"en\":\"Bolivian\",\"ar\":\"\\u0628\\u0648\\u0644\\u064a\\u0641\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10156, '{\"en\":\"Bosnian \\/ Herzegovinian\",\"ar\":\"\\u0628\\u0648\\u0633\\u0646\\u064a\\/\\u0647\\u0631\\u0633\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10157, '{\"en\":\"Botswanan\",\"ar\":\"\\u0628\\u0648\\u062a\\u0633\\u0648\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10158, '{\"en\":\"Bouvetian\",\"ar\":\"\\u0628\\u0648\\u0641\\u064a\\u0647\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10159, '{\"en\":\"Brazilian\",\"ar\":\"\\u0628\\u0631\\u0627\\u0632\\u064a\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10160, '{\"en\":\"British Indian Ocean Territory\",\"ar\":\"\\u0625\\u0642\\u0644\\u064a\\u0645 \\u0627\\u0644\\u0645\\u062d\\u064a\\u0637 \\u0627\\u0644\\u0647\\u0646\\u062f\\u064a \\u0627\\u0644\\u0628\\u0631\\u064a\\u0637\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10161, '{\"en\":\"Bruneian\",\"ar\":\"\\u0628\\u0631\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10162, '{\"en\":\"Bulgarian\",\"ar\":\"\\u0628\\u0644\\u063a\\u0627\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10163, '{\"en\":\"Burkinabe\",\"ar\":\"\\u0628\\u0648\\u0631\\u0643\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10164, '{\"en\":\"Burundian\",\"ar\":\"\\u0628\\u0648\\u0631\\u0648\\u0646\\u064a\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10165, '{\"en\":\"Cambodian\",\"ar\":\"\\u0643\\u0645\\u0628\\u0648\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10166, '{\"en\":\"Cameroonian\",\"ar\":\"\\u0643\\u0627\\u0645\\u064a\\u0631\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10167, '{\"en\":\"Canadian\",\"ar\":\"\\u0643\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10168, '{\"en\":\"Cape Verdean\",\"ar\":\"\\u0627\\u0644\\u0631\\u0623\\u0633 \\u0627\\u0644\\u0623\\u062e\\u0636\\u0631\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10169, '{\"en\":\"Caymanian\",\"ar\":\"\\u0643\\u0627\\u064a\\u0645\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10170, '{\"en\":\"Central African\",\"ar\":\"\\u0623\\u0641\\u0631\\u064a\\u0642\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10171, '{\"en\":\"Chadian\",\"ar\":\"\\u062a\\u0634\\u0627\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10172, '{\"en\":\"Chilean\",\"ar\":\"\\u0634\\u064a\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10173, '{\"en\":\"Chinese\",\"ar\":\"\\u0635\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10174, '{\"en\":\"Christmas Islander\",\"ar\":\"\\u062c\\u0632\\u064a\\u0631\\u0629 \\u0639\\u064a\\u062f \\u0627\\u0644\\u0645\\u064a\\u0644\\u0627\\u062f\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10175, '{\"en\":\"Cocos Islander\",\"ar\":\"\\u062c\\u0632\\u0631 \\u0643\\u0648\\u0643\\u0648\\u0633\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10176, '{\"en\":\"Colombian\",\"ar\":\"\\u0643\\u0648\\u0644\\u0648\\u0645\\u0628\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10177, '{\"en\":\"Comorian\",\"ar\":\"\\u062c\\u0632\\u0631 \\u0627\\u0644\\u0642\\u0645\\u0631\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10178, '{\"en\":\"Congolese\",\"ar\":\"\\u0643\\u0648\\u0646\\u063a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10179, '{\"en\":\"Cook Islander\",\"ar\":\"\\u062c\\u0632\\u0631 \\u0643\\u0648\\u0643\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10180, '{\"en\":\"Costa Rican\",\"ar\":\"\\u0643\\u0648\\u0633\\u062a\\u0627\\u0631\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10181, '{\"en\":\"Croatian\",\"ar\":\"\\u0643\\u0648\\u0631\\u0627\\u062a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10182, '{\"en\":\"Cuban\",\"ar\":\"\\u0643\\u0648\\u0628\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10183, '{\"en\":\"Cypriot\",\"ar\":\"\\u0642\\u0628\\u0631\\u0635\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10184, '{\"en\":\"Curacian\",\"ar\":\"\\u0643\\u0648\\u0631\\u0627\\u0633\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10185, '{\"en\":\"Czech\",\"ar\":\"\\u062a\\u0634\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10186, '{\"en\":\"Danish\",\"ar\":\"\\u062f\\u0646\\u0645\\u0627\\u0631\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10187, '{\"en\":\"Djiboutian\",\"ar\":\"\\u062c\\u064a\\u0628\\u0648\\u062a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10188, '{\"en\":\"Dominican\",\"ar\":\"\\u062f\\u0648\\u0645\\u064a\\u0646\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10189, '{\"en\":\"Dominican\",\"ar\":\"\\u062f\\u0648\\u0645\\u064a\\u0646\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10190, '{\"en\":\"Ecuadorian\",\"ar\":\"\\u0625\\u0643\\u0648\\u0627\\u062f\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10191, '{\"en\":\"Egyptian\",\"ar\":\"\\u0645\\u0635\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10192, '{\"en\":\"Salvadoran\",\"ar\":\"\\u0633\\u0644\\u0641\\u0627\\u062f\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10193, '{\"en\":\"Equatorial Guinean\",\"ar\":\"\\u063a\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10194, '{\"en\":\"Eritrean\",\"ar\":\"\\u0625\\u0631\\u064a\\u062a\\u064a\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10195, '{\"en\":\"Estonian\",\"ar\":\"\\u0627\\u0633\\u062a\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10196, '{\"en\":\"Ethiopian\",\"ar\":\"\\u0623\\u062b\\u064a\\u0648\\u0628\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10197, '{\"en\":\"Falkland Islander\",\"ar\":\"\\u0641\\u0648\\u0643\\u0644\\u0627\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10198, '{\"en\":\"Faroese\",\"ar\":\"\\u062c\\u0632\\u0631 \\u0641\\u0627\\u0631\\u0648\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10199, '{\"en\":\"Fijian\",\"ar\":\"\\u0641\\u064a\\u062c\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10200, '{\"en\":\"Finnish\",\"ar\":\"\\u0641\\u0646\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10201, '{\"en\":\"French\",\"ar\":\"\\u0641\\u0631\\u0646\\u0633\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10202, '{\"en\":\"French Guianese\",\"ar\":\"\\u063a\\u0648\\u064a\\u0627\\u0646\\u0627 \\u0627\\u0644\\u0641\\u0631\\u0646\\u0633\\u064a\\u0629\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10203, '{\"en\":\"French Polynesian\",\"ar\":\"\\u0628\\u0648\\u0644\\u064a\\u0646\\u064a\\u0632\\u064a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10204, '{\"en\":\"French\",\"ar\":\"\\u0623\\u0631\\u0627\\u0636 \\u0641\\u0631\\u0646\\u0633\\u064a\\u0629 \\u062c\\u0646\\u0648\\u0628\\u064a\\u0629 \\u0648\\u0623\\u0646\\u062a\\u0627\\u0631\\u062a\\u064a\\u0643\\u064a\\u0629\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10205, '{\"en\":\"Gabonese\",\"ar\":\"\\u063a\\u0627\\u0628\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10206, '{\"en\":\"Gambian\",\"ar\":\"\\u063a\\u0627\\u0645\\u0628\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10207, '{\"en\":\"Georgian\",\"ar\":\"\\u062c\\u064a\\u0648\\u0631\\u062c\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10208, '{\"en\":\"German\",\"ar\":\"\\u0623\\u0644\\u0645\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10209, '{\"en\":\"Ghanaian\",\"ar\":\"\\u063a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10210, '{\"en\":\"Gibraltar\",\"ar\":\"\\u062c\\u0628\\u0644 \\u0637\\u0627\\u0631\\u0642\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10211, '{\"en\":\"Guernsian\",\"ar\":\"\\u063a\\u064a\\u0631\\u0646\\u0632\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10212, '{\"en\":\"Greek\",\"ar\":\"\\u064a\\u0648\\u0646\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10213, '{\"en\":\"Greenlandic\",\"ar\":\"\\u062c\\u0631\\u064a\\u0646\\u0644\\u0627\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10214, '{\"en\":\"Grenadian\",\"ar\":\"\\u063a\\u0631\\u064a\\u0646\\u0627\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10215, '{\"en\":\"Guadeloupe\",\"ar\":\"\\u062c\\u0632\\u0631 \\u062c\\u0648\\u0627\\u062f\\u0644\\u0648\\u0628\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10216, '{\"en\":\"Guamanian\",\"ar\":\"\\u062c\\u0648\\u0627\\u0645\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10217, '{\"en\":\"Guatemalan\",\"ar\":\"\\u063a\\u0648\\u0627\\u062a\\u064a\\u0645\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10218, '{\"en\":\"Guinean\",\"ar\":\"\\u063a\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10219, '{\"en\":\"Guinea-Bissauan\",\"ar\":\"\\u063a\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10220, '{\"en\":\"Guyanese\",\"ar\":\"\\u063a\\u064a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10221, '{\"en\":\"Haitian\",\"ar\":\"\\u0647\\u0627\\u064a\\u062a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10222, '{\"en\":\"Heard and Mc Donald Islanders\",\"ar\":\"\\u062c\\u0632\\u064a\\u0631\\u0629 \\u0647\\u064a\\u0631\\u062f \\u0648\\u062c\\u0632\\u0631 \\u0645\\u0627\\u0643\\u062f\\u0648\\u0646\\u0627\\u0644\\u062f\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10223, '{\"en\":\"Honduran\",\"ar\":\"\\u0647\\u0646\\u062f\\u0648\\u0631\\u0627\\u0633\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10224, '{\"en\":\"Hongkongese\",\"ar\":\"\\u0647\\u0648\\u0646\\u063a \\u0643\\u0648\\u0646\\u063a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10225, '{\"en\":\"Hungarian\",\"ar\":\"\\u0645\\u062c\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10226, '{\"en\":\"Icelandic\",\"ar\":\"\\u0622\\u064a\\u0633\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10227, '{\"en\":\"Indian\",\"ar\":\"\\u0647\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10228, '{\"en\":\"Manx\",\"ar\":\"\\u0645\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10229, '{\"en\":\"Indonesian\",\"ar\":\"\\u0623\\u0646\\u062f\\u0648\\u0646\\u064a\\u0633\\u064a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10230, '{\"en\":\"Iranian\",\"ar\":\"\\u0625\\u064a\\u0631\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10231, '{\"en\":\"Iraqi\",\"ar\":\"\\u0639\\u0631\\u0627\\u0642\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10232, '{\"en\":\"Irish\",\"ar\":\"\\u0625\\u064a\\u0631\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10233, '{\"en\":\"Italian\",\"ar\":\"\\u0625\\u064a\\u0637\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10234, '{\"en\":\"Ivory Coastian\",\"ar\":\"\\u0633\\u0627\\u062d\\u0644 \\u0627\\u0644\\u0639\\u0627\\u062c\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10235, '{\"en\":\"Jersian\",\"ar\":\"\\u062c\\u064a\\u0631\\u0632\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10236, '{\"en\":\"Jamaican\",\"ar\":\"\\u062c\\u0645\\u0627\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10237, '{\"en\":\"Japanese\",\"ar\":\"\\u064a\\u0627\\u0628\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10238, '{\"en\":\"Jordanian\",\"ar\":\"\\u0623\\u0631\\u062f\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10239, '{\"en\":\"Kazakh\",\"ar\":\"\\u0643\\u0627\\u0632\\u0627\\u062e\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10240, '{\"en\":\"Kenyan\",\"ar\":\"\\u0643\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10241, '{\"en\":\"I-Kiribati\",\"ar\":\"\\u0643\\u064a\\u0631\\u064a\\u0628\\u0627\\u062a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10242, '{\"en\":\"North Korean\",\"ar\":\"\\u0643\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10243, '{\"en\":\"South Korean\",\"ar\":\"\\u0643\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10244, '{\"en\":\"Kosovar\",\"ar\":\"\\u0643\\u0648\\u0633\\u064a\\u0641\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10245, '{\"en\":\"Kuwaiti\",\"ar\":\"\\u0643\\u0648\\u064a\\u062a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10246, '{\"en\":\"Kyrgyzstani\",\"ar\":\"\\u0642\\u064a\\u0631\\u063a\\u064a\\u0632\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10247, '{\"en\":\"Laotian\",\"ar\":\"\\u0644\\u0627\\u0648\\u0633\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10248, '{\"en\":\"Latvian\",\"ar\":\"\\u0644\\u0627\\u062a\\u064a\\u0641\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10249, '{\"en\":\"Lebanese\",\"ar\":\"\\u0644\\u0628\\u0646\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10250, '{\"en\":\"Basotho\",\"ar\":\"\\u0644\\u064a\\u0648\\u0633\\u064a\\u062a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10251, '{\"en\":\"Liberian\",\"ar\":\"\\u0644\\u064a\\u0628\\u064a\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10252, '{\"en\":\"Libyan\",\"ar\":\"\\u0644\\u064a\\u0628\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10253, '{\"en\":\"Liechtenstein\",\"ar\":\"\\u0644\\u064a\\u062e\\u062a\\u0646\\u0634\\u062a\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10254, '{\"en\":\"Lithuanian\",\"ar\":\"\\u0644\\u062a\\u0648\\u0627\\u0646\\u064a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10255, '{\"en\":\"Luxembourger\",\"ar\":\"\\u0644\\u0648\\u0643\\u0633\\u0645\\u0628\\u0648\\u0631\\u063a\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10256, '{\"en\":\"Sri Lankian\",\"ar\":\"\\u0633\\u0631\\u064a\\u0644\\u0627\\u0646\\u0643\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10257, '{\"en\":\"Macanese\",\"ar\":\"\\u0645\\u0627\\u0643\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10258, '{\"en\":\"Macedonian\",\"ar\":\"\\u0645\\u0642\\u062f\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10259, '{\"en\":\"Malagasy\",\"ar\":\"\\u0645\\u062f\\u063a\\u0634\\u0642\\u0631\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10260, '{\"en\":\"Malawian\",\"ar\":\"\\u0645\\u0627\\u0644\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10261, '{\"en\":\"Malaysian\",\"ar\":\"\\u0645\\u0627\\u0644\\u064a\\u0632\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10262, '{\"en\":\"Maldivian\",\"ar\":\"\\u0645\\u0627\\u0644\\u062f\\u064a\\u0641\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10263, '{\"en\":\"Malian\",\"ar\":\"\\u0645\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:56', '2021-09-23 08:02:56'),
(10264, '{\"en\":\"Maltese\",\"ar\":\"\\u0645\\u0627\\u0644\\u0637\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10265, '{\"en\":\"Marshallese\",\"ar\":\"\\u0645\\u0627\\u0631\\u0634\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10266, '{\"en\":\"Martiniquais\",\"ar\":\"\\u0645\\u0627\\u0631\\u062a\\u064a\\u0646\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10267, '{\"en\":\"Mauritanian\",\"ar\":\"\\u0645\\u0648\\u0631\\u064a\\u062a\\u0627\\u0646\\u064a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10268, '{\"en\":\"Mauritian\",\"ar\":\"\\u0645\\u0648\\u0631\\u064a\\u0634\\u064a\\u0648\\u0633\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10269, '{\"en\":\"Mahoran\",\"ar\":\"\\u0645\\u0627\\u064a\\u0648\\u062a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10270, '{\"en\":\"Mexican\",\"ar\":\"\\u0645\\u0643\\u0633\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10271, '{\"en\":\"Micronesian\",\"ar\":\"\\u0645\\u0627\\u064a\\u0643\\u0631\\u0648\\u0646\\u064a\\u0632\\u064a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10272, '{\"en\":\"Moldovan\",\"ar\":\"\\u0645\\u0648\\u0644\\u062f\\u064a\\u0641\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10273, '{\"en\":\"Monacan\",\"ar\":\"\\u0645\\u0648\\u0646\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10274, '{\"en\":\"Mongolian\",\"ar\":\"\\u0645\\u0646\\u063a\\u0648\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10275, '{\"en\":\"Montenegrin\",\"ar\":\"\\u0627\\u0644\\u062c\\u0628\\u0644 \\u0627\\u0644\\u0623\\u0633\\u0648\\u062f\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10276, '{\"en\":\"Montserratian\",\"ar\":\"\\u0645\\u0648\\u0646\\u062a\\u0633\\u064a\\u0631\\u0627\\u062a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10277, '{\"en\":\"Moroccan\",\"ar\":\"\\u0645\\u063a\\u0631\\u0628\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10278, '{\"en\":\"Mozambican\",\"ar\":\"\\u0645\\u0648\\u0632\\u0645\\u0628\\u064a\\u0642\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10279, '{\"en\":\"Myanmarian\",\"ar\":\"\\u0645\\u064a\\u0627\\u0646\\u0645\\u0627\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10280, '{\"en\":\"Namibian\",\"ar\":\"\\u0646\\u0627\\u0645\\u064a\\u0628\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10281, '{\"en\":\"Nauruan\",\"ar\":\"\\u0646\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10282, '{\"en\":\"Nepalese\",\"ar\":\"\\u0646\\u064a\\u0628\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10283, '{\"en\":\"Dutch\",\"ar\":\"\\u0647\\u0648\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10284, '{\"en\":\"Dutch Antilier\",\"ar\":\"\\u0647\\u0648\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10285, '{\"en\":\"New Caledonian\",\"ar\":\"\\u0643\\u0627\\u0644\\u064a\\u062f\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10286, '{\"en\":\"New Zealander\",\"ar\":\"\\u0646\\u064a\\u0648\\u0632\\u064a\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10287, '{\"en\":\"Nicaraguan\",\"ar\":\"\\u0646\\u064a\\u0643\\u0627\\u0631\\u0627\\u062c\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10288, '{\"en\":\"Nigerien\",\"ar\":\"\\u0646\\u064a\\u062c\\u064a\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10289, '{\"en\":\"Nigerian\",\"ar\":\"\\u0646\\u064a\\u062c\\u064a\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10290, '{\"en\":\"Niuean\",\"ar\":\"\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10291, '{\"en\":\"Norfolk Islander\",\"ar\":\"\\u0646\\u0648\\u0631\\u0641\\u0648\\u0644\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10292, '{\"en\":\"Northern Marianan\",\"ar\":\"\\u0645\\u0627\\u0631\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10293, '{\"en\":\"Norwegian\",\"ar\":\"\\u0646\\u0631\\u0648\\u064a\\u062c\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10294, '{\"en\":\"Omani\",\"ar\":\"\\u0639\\u0645\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10295, '{\"en\":\"Pakistani\",\"ar\":\"\\u0628\\u0627\\u0643\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10296, '{\"en\":\"Palauan\",\"ar\":\"\\u0628\\u0627\\u0644\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10297, '{\"en\":\"Palestinian\",\"ar\":\"\\u0641\\u0644\\u0633\\u0637\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10298, '{\"en\":\"Panamanian\",\"ar\":\"\\u0628\\u0646\\u0645\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10299, '{\"en\":\"Papua New Guinean\",\"ar\":\"\\u0628\\u0627\\u0628\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10300, '{\"en\":\"Paraguayan\",\"ar\":\"\\u0628\\u0627\\u0631\\u063a\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10301, '{\"en\":\"Peruvian\",\"ar\":\"\\u0628\\u064a\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10302, '{\"en\":\"Filipino\",\"ar\":\"\\u0641\\u0644\\u0628\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10303, '{\"en\":\"Pitcairn Islander\",\"ar\":\"\\u0628\\u064a\\u062a\\u0643\\u064a\\u0631\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10304, '{\"en\":\"Polish\",\"ar\":\"\\u0628\\u0648\\u0644\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10305, '{\"en\":\"Portuguese\",\"ar\":\"\\u0628\\u0631\\u062a\\u063a\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10306, '{\"en\":\"Puerto Rican\",\"ar\":\"\\u0628\\u0648\\u0631\\u062a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10307, '{\"en\":\"Qatari\",\"ar\":\"\\u0642\\u0637\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10308, '{\"en\":\"Reunionese\",\"ar\":\"\\u0631\\u064a\\u0648\\u0646\\u064a\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10309, '{\"en\":\"Romanian\",\"ar\":\"\\u0631\\u0648\\u0645\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10310, '{\"en\":\"Russian\",\"ar\":\"\\u0631\\u0648\\u0633\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10311, '{\"en\":\"Rwandan\",\"ar\":\"\\u0631\\u0648\\u0627\\u0646\\u062f\\u0627\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10312, '{\"ar\":\"Kittitian\\/Nevisian\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10313, '{\"en\":\"St. Martian(French)\",\"ar\":\"\\u0633\\u0627\\u064a\\u0646\\u062a \\u0645\\u0627\\u0631\\u062a\\u0646\\u064a \\u0641\\u0631\\u0646\\u0633\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10314, '{\"en\":\"St. Martian(Dutch)\",\"ar\":\"\\u0633\\u0627\\u064a\\u0646\\u062a \\u0645\\u0627\\u0631\\u062a\\u0646\\u064a \\u0647\\u0648\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10315, '{\"en\":\"St. Pierre and Miquelon\",\"ar\":\"\\u0633\\u0627\\u0646 \\u0628\\u064a\\u064a\\u0631 \\u0648\\u0645\\u064a\\u0643\\u0644\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10316, '{\"en\":\"Saint Vincent and the Grenadines\",\"ar\":\"\\u0633\\u0627\\u0646\\u062a \\u0641\\u0646\\u0633\\u0646\\u062a \\u0648\\u062c\\u0632\\u0631 \\u063a\\u0631\\u064a\\u0646\\u0627\\u062f\\u064a\\u0646\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10317, '{\"en\":\"Samoan\",\"ar\":\"\\u0633\\u0627\\u0645\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10318, '{\"en\":\"Sammarinese\",\"ar\":\"\\u0645\\u0627\\u0631\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10319, '{\"en\":\"Sao Tomean\",\"ar\":\"\\u0633\\u0627\\u0648 \\u062a\\u0648\\u0645\\u064a \\u0648\\u0628\\u0631\\u064a\\u0646\\u0633\\u064a\\u0628\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10320, '{\"en\":\"Saudi Arabian\",\"ar\":\"\\u0633\\u0639\\u0648\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10321, '{\"en\":\"Senegalese\",\"ar\":\"\\u0633\\u0646\\u063a\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10322, '{\"en\":\"Syrian\",\"ar\":\"\\u0633\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10323, '{\"en\":\"Serbian\",\"ar\":\"\\u0635\\u0631\\u0628\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10324, '{\"en\":\"Seychellois\",\"ar\":\"\\u0633\\u064a\\u0634\\u064a\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10325, '{\"en\":\"Sierra Leonean\",\"ar\":\"\\u0633\\u064a\\u0631\\u0627\\u0644\\u064a\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10326, '{\"en\":\"Singaporean\",\"ar\":\"\\u0633\\u0646\\u063a\\u0627\\u0641\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10327, '{\"en\":\"Slovak\",\"ar\":\"\\u0633\\u0648\\u0644\\u0641\\u0627\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10328, '{\"en\":\"Slovenian\",\"ar\":\"\\u0633\\u0648\\u0644\\u0641\\u064a\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10329, '{\"en\":\"Solomon Island\",\"ar\":\"\\u062c\\u0632\\u0631 \\u0633\\u0644\\u064a\\u0645\\u0627\\u0646\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10330, '{\"en\":\"Somali\",\"ar\":\"\\u0635\\u0648\\u0645\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10331, '{\"en\":\"South African\",\"ar\":\"\\u0623\\u0641\\u0631\\u064a\\u0642\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10332, '{\"en\":\"South Georgia and the South Sandwich\",\"ar\":\"\\u0644\\u0645\\u0646\\u0637\\u0642\\u0629 \\u0627\\u0644\\u0642\\u0637\\u0628\\u064a\\u0629 \\u0627\\u0644\\u062c\\u0646\\u0648\\u0628\\u064a\\u0629\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10333, '{\"en\":\"South Sudanese\",\"ar\":\"\\u0633\\u0648\\u0627\\u062f\\u0646\\u064a \\u062c\\u0646\\u0648\\u0628\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10334, '{\"en\":\"Spanish\",\"ar\":\"\\u0625\\u0633\\u0628\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10335, '{\"en\":\"St. Helenian\",\"ar\":\"\\u0647\\u064a\\u0644\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10336, '{\"en\":\"Sudanese\",\"ar\":\"\\u0633\\u0648\\u062f\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10337, '{\"en\":\"Surinamese\",\"ar\":\"\\u0633\\u0648\\u0631\\u064a\\u0646\\u0627\\u0645\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10338, '{\"en\":\"Svalbardian\\/Jan Mayenian\",\"ar\":\"\\u0633\\u0641\\u0627\\u0644\\u0628\\u0627\\u0631\\u062f \\u0648\\u064a\\u0627\\u0646 \\u0645\\u0627\\u064a\\u0646\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10339, '{\"en\":\"Swazi\",\"ar\":\"\\u0633\\u0648\\u0627\\u0632\\u064a\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10340, '{\"en\":\"Swedish\",\"ar\":\"\\u0633\\u0648\\u064a\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10341, '{\"en\":\"Swiss\",\"ar\":\"\\u0633\\u0648\\u064a\\u0633\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10342, '{\"en\":\"Syrian\",\"ar\":\"\\u0633\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10343, '{\"en\":\"Taiwanese\",\"ar\":\"\\u062a\\u0627\\u064a\\u0648\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10344, '{\"en\":\"Tajikistani\",\"ar\":\"\\u0637\\u0627\\u062c\\u064a\\u0643\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10345, '{\"en\":\"Tanzanian\",\"ar\":\"\\u062a\\u0646\\u0632\\u0627\\u0646\\u064a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10346, '{\"en\":\"Thai\",\"ar\":\"\\u062a\\u0627\\u064a\\u0644\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10347, '{\"en\":\"Timor-Lestian\",\"ar\":\"\\u062a\\u064a\\u0645\\u0648\\u0631\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10348, '{\"en\":\"Togolese\",\"ar\":\"\\u062a\\u0648\\u063a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10349, '{\"en\":\"Tokelaian\",\"ar\":\"\\u062a\\u0648\\u0643\\u064a\\u0644\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10350, '{\"en\":\"Tongan\",\"ar\":\"\\u062a\\u0648\\u0646\\u063a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10351, '{\"en\":\"Trinidadian\\/Tobagonian\",\"ar\":\"\\u062a\\u0631\\u064a\\u0646\\u064a\\u062f\\u0627\\u062f \\u0648\\u062a\\u0648\\u0628\\u0627\\u063a\\u0648\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10352, '{\"en\":\"Tunisian\",\"ar\":\"\\u062a\\u0648\\u0646\\u0633\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10353, '{\"en\":\"Turkish\",\"ar\":\"\\u062a\\u0631\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10354, '{\"en\":\"Turkmen\",\"ar\":\"\\u062a\\u0631\\u0643\\u0645\\u0627\\u0646\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10355, '{\"en\":\"Turks and Caicos Islands\",\"ar\":\"\\u062c\\u0632\\u0631 \\u062a\\u0648\\u0631\\u0643\\u0633 \\u0648\\u0643\\u0627\\u064a\\u0643\\u0648\\u0633\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10356, '{\"en\":\"Tuvaluan\",\"ar\":\"\\u062a\\u0648\\u0641\\u0627\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10357, '{\"en\":\"Ugandan\",\"ar\":\"\\u0623\\u0648\\u063a\\u0646\\u062f\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10358, '{\"en\":\"Ukrainian\",\"ar\":\"\\u0623\\u0648\\u0643\\u0631\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10359, '{\"en\":\"Emirati\",\"ar\":\"\\u0625\\u0645\\u0627\\u0631\\u0627\\u062a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10360, '{\"en\":\"British\",\"ar\":\"\\u0628\\u0631\\u064a\\u0637\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10361, '{\"en\":\"American\",\"ar\":\"\\u0623\\u0645\\u0631\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10362, '{\"en\":\"US Minor Outlying Islander\",\"ar\":\"\\u0623\\u0645\\u0631\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10363, '{\"en\":\"Uruguayan\",\"ar\":\"\\u0623\\u0648\\u0631\\u063a\\u0648\\u0627\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10364, '{\"en\":\"Uzbek\",\"ar\":\"\\u0623\\u0648\\u0632\\u0628\\u0627\\u0643\\u0633\\u062a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10365, '{\"en\":\"Vanuatuan\",\"ar\":\"\\u0641\\u0627\\u0646\\u0648\\u0627\\u062a\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10366, '{\"en\":\"Venezuelan\",\"ar\":\"\\u0641\\u0646\\u0632\\u0648\\u064a\\u0644\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10367, '{\"en\":\"Vietnamese\",\"ar\":\"\\u0641\\u064a\\u062a\\u0646\\u0627\\u0645\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10368, '{\"en\":\"American Virgin Islander\",\"ar\":\"\\u0623\\u0645\\u0631\\u064a\\u0643\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10369, '{\"en\":\"Vatican\",\"ar\":\"\\u0641\\u0627\\u062a\\u064a\\u0643\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10370, '{\"en\":\"Wallisian\\/Futunan\",\"ar\":\"\\u0641\\u0648\\u062a\\u0648\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10371, '{\"en\":\"Sahrawian\",\"ar\":\"\\u0635\\u062d\\u0631\\u0627\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10372, '{\"en\":\"Yemeni\",\"ar\":\"\\u064a\\u0645\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10373, '{\"en\":\"Zambian\",\"ar\":\"\\u0632\\u0627\\u0645\\u0628\\u064a\\u0627\\u0646\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(10374, '{\"en\":\"Zimbabwean\",\"ar\":\"\\u0632\\u0645\\u0628\\u0627\\u0628\\u0648\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('05ad4725-5acc-407b-a4cb-520da0ddc498', 'App\\Notifications\\ArriveTask', 'App\\User', 53, '{\"id\":\"05ad4725-5acc-407b-a4cb-520da0ddc498\",\"title\":\"Send_Task\",\"user\":\"laila msallaty\",\"url\":\"Receive_Task.index\"}', '2021-09-30 16:07:50', '2021-09-30 16:07:36', '2021-09-30 16:07:50'),
('05b5705a-3165-4062-a598-afe808cba25c', 'App\\Notifications\\ReceivePunishment', 'App\\User', 53, '{\"id\":\"05b5705a-3165-4062-a598-afe808cba25c\",\"title\":\"Receive_Punishment\",\"user\":\"joud almuhamed\",\"url\":\"Employee_punishment.index\"}', '2021-10-08 09:50:07', '2021-10-08 09:49:41', '2021-10-08 09:50:07'),
('06bac9b7-3c6b-45eb-8ee3-f53067e56acf', 'App\\Notifications\\ArriveAward', 'App\\User', 52, '{\"id\":\"06bac9b7-3c6b-45eb-8ee3-f53067e56acf\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', NULL, '2021-10-20 19:00:54', '2021-10-20 19:00:54'),
('081d8bac-def2-4ed5-baee-ed1042b314c5', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 71, '{\"id\":\"081d8bac-def2-4ed5-baee-ed1042b314c5\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', '2021-10-20 19:12:55', '2021-10-20 19:11:58', '2021-10-20 19:12:55'),
('0841869b-1c31-4dc5-aa8b-925b97f3b6a6', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"0841869b-1c31-4dc5-aa8b-925b97f3b6a6\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', '2021-10-08 10:26:31', '2021-10-08 10:26:16', '2021-10-08 10:26:31'),
('0e6944ef-cfd6-4be2-876e-e18e5aac4971', 'App\\Notifications\\ArriveLeave', 'App\\User', 52, '{\"id\":\"0e6944ef-cfd6-4be2-876e-e18e5aac4971\",\"title\":\"Receive_Leave\",\"user\":\"amar msallaty\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-20 18:56:31', '2021-10-20 18:56:31'),
('0fc763ee-4435-45aa-a9f7-72f8d7d7a72d', 'App\\Notifications\\ArriveLeave', 'App\\User', 56, '{\"id\":48,\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-03 07:04:51', '2021-10-03 07:04:51'),
('138b52f1-d7f5-4cba-a9b9-a9682ed5e0cf', 'App\\Notifications\\ArriveAward', 'App\\User', 71, '{\"id\":\"138b52f1-d7f5-4cba-a9b9-a9682ed5e0cf\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', '2021-10-20 19:06:11', '2021-10-20 19:01:42', '2021-10-20 19:06:11'),
('1611fb61-f73a-491b-83fb-d2df58ebcc03', 'App\\Notifications\\SlipPaid', 'App\\User', 59, '{\"id\":\"1611fb61-f73a-491b-83fb-d2df58ebcc03\",\"title\":\"Pay_Salary\",\"user\":\"joud almuhamed\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-08 13:05:28', '2021-10-08 13:05:28'),
('166b64b1-5f6b-4d96-81fd-ee293766a74a', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"166b64b1-5f6b-4d96-81fd-ee293766a74a\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:26:16', '2021-10-08 10:26:16'),
('16d2bc98-089d-4b8e-8495-63890f3b332f', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":\"16d2bc98-089d-4b8e-8495-63890f3b332f\",\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', '2021-10-03 07:15:50', '2021-10-03 06:56:31', '2021-10-03 07:15:50'),
('17ba12d0-2f27-4bb3-9cf9-063bd38a7fc4', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"17ba12d0-2f27-4bb3-9cf9-063bd38a7fc4\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:31:32', '2021-10-08 10:31:32'),
('1886617c-449f-441b-bcc6-b78c26129251', 'App\\Notifications\\ArriveTask', 'App\\User', 59, '{\"id\":\"1886617c-449f-441b-bcc6-b78c26129251\",\"title\":\"Send_Task\",\"user\":\"lujain Alnaser\",\"url\":\"Receive_Task.index\"}', NULL, '2021-10-03 20:07:30', '2021-10-03 20:07:30'),
('1ad053db-c9bc-4c9f-a80f-1a6e8b71d1b1', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 59, '{\"id\":\"1ad053db-c9bc-4c9f-a80f-1a6e8b71d1b1\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:22:18', '2021-10-08 15:22:18'),
('1cb63939-3d66-476b-bc54-aa23b049662a', 'App\\Notifications\\ArriveLeave', 'App\\User', 56, '{\"id\":\"1cb63939-3d66-476b-bc54-aa23b049662a\",\"title\":\"Receive_Leave\",\"user\":\"amar msallaty\",\"url\":\"Employee_Leave_Requests\"}', '2021-10-08 10:19:07', '2021-10-08 10:17:53', '2021-10-08 10:19:07'),
('1de5cfd8-6ed5-4dcb-ba65-c157eaab3062', 'App\\Notifications\\ArriveLeave', 'App\\User', 52, '{\"id\":\"1de5cfd8-6ed5-4dcb-ba65-c157eaab3062\",\"title\":\"Receive_Leave\",\"user\":\"amar msallaty\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-08 10:17:53', '2021-10-08 10:17:53'),
('1e13238c-0c7a-454f-ada8-259fe4da47ae', 'App\\Notifications\\ArriveLeave', 'App\\User', 56, '{\"id\":\"1e13238c-0c7a-454f-ada8-259fe4da47ae\",\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-03 06:59:03', '2021-10-03 06:59:03'),
('204e5116-f187-42d6-9cfc-0081dd2a6139', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"204e5116-f187-42d6-9cfc-0081dd2a6139\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:26:16', '2021-10-08 10:26:16'),
('240b9633-3585-441b-a898-1e7dbdd58c28', 'App\\Notifications\\AcceptRejectTask', 'App\\User', 53, '{\"id\":\"240b9633-3585-441b-a898-1e7dbdd58c28\",\"title\":\"Accept_Reject_Task\",\"user\":\"joud almuhamed\",\"url\":\"Receive_Task.index\"}', NULL, '2021-10-08 15:26:57', '2021-10-08 15:26:57'),
('290a962f-59d3-49d4-9778-96e1851333c0', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"290a962f-59d3-49d4-9778-96e1851333c0\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:31:32', '2021-10-08 10:31:32'),
('2b87fa4c-fb64-48ae-bcd2-617c15479ffe', 'App\\Notifications\\SlipPaid', 'App\\User', 71, '{\"id\":\"2b87fa4c-fb64-48ae-bcd2-617c15479ffe\",\"title\":\"Pay_Salary\",\"user\":\"laila msallaty\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-20 18:48:17', '2021-10-20 18:48:17'),
('3a57149b-1d87-41c6-ab13-386cb336ae1e', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"3a57149b-1d87-41c6-ab13-386cb336ae1e\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', '2021-10-03 19:30:31', '2021-10-03 07:18:31', '2021-10-03 19:30:31'),
('3b245689-582b-4270-b2a8-d6ee99013f12', 'App\\Notifications\\AcceptRejectTask', 'App\\User', 71, '{\"id\":\"3b245689-582b-4270-b2a8-d6ee99013f12\",\"title\":\"Accept_Reject_Task\",\"user\":\"laila msallaty\",\"url\":\"Receive_Task.index\"}', '2021-10-20 19:19:09', '2021-10-20 19:18:43', '2021-10-20 19:19:09'),
('3f24ce8a-2012-45e9-aa49-bad54037afa3', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"3f24ce8a-2012-45e9-aa49-bad54037afa3\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:31:32', '2021-10-08 10:31:32'),
('441c9ee6-e6fd-4751-87f8-c8feb1498aa7', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"441c9ee6-e6fd-4751-87f8-c8feb1498aa7\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-03 19:45:37', '2021-10-03 19:45:37'),
('44881572-3b1e-4857-923e-7c938ea928e8', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"44881572-3b1e-4857-923e-7c938ea928e8\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:35:50', '2021-10-08 10:35:50'),
('4dc0bb05-2197-4476-80e0-afba92cc432f', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 53, '{\"id\":\"4dc0bb05-2197-4476-80e0-afba92cc432f\",\"title\":\"Accept_Reject_Request\",\"user\":\"joud almuhamed\",\"url\":\"Send_Request.index\"}', '2021-10-08 10:35:19', '2021-10-08 10:32:55', '2021-10-08 10:35:19'),
('4de96093-85e8-472f-a172-638297e5dc66', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"4de96093-85e8-472f-a172-638297e5dc66\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-03 07:07:42', '2021-10-03 07:07:42'),
('4f2251c0-fdea-4161-91d6-d6c7154e3865', 'App\\Notifications\\ReplyRequest', 'App\\User', 53, '{\"id\":\"4f2251c0-fdea-4161-91d6-d6c7154e3865\",\"title\":\"Request_Reply\",\"user\":\"joud almuhamed\",\"url\":\"Employee_Requests\"}', '2021-10-08 10:36:43', '2021-10-08 10:36:07', '2021-10-08 10:36:43'),
('52d2ad0e-8c33-4dda-9c0f-7c588e2dd837', 'App\\Notifications\\ArriveTask', 'App\\User', 53, '{\"id\":\"52d2ad0e-8c33-4dda-9c0f-7c588e2dd837\",\"title\":\"Send_Task\",\"user\":\"joud almuhamed\",\"url\":\"Receive_Task.index\"}', '2021-10-08 15:25:00', '2021-10-08 15:24:48', '2021-10-08 15:25:00'),
('539725ff-d390-4b89-a465-614b48dd878c', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 53, '{\"id\":\"539725ff-d390-4b89-a465-614b48dd878c\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:22:29', '2021-10-08 15:22:29'),
('551bb31b-703f-4dde-a996-d3e1199fd258', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"551bb31b-703f-4dde-a996-d3e1199fd258\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:33:56', '2021-10-08 10:33:56'),
('58d7a573-5888-45b6-bd58-4eab3d43a991', 'App\\Notifications\\ArriveTask', 'App\\User', 59, '{\"id\":\"58d7a573-5888-45b6-bd58-4eab3d43a991\",\"title\":\"Send_Task\",\"user\":\"lujain Alnaser\",\"url\":\"Receive_Task.index\"}', NULL, '2021-10-03 20:15:18', '2021-10-03 20:15:18'),
('59d2057f-d7a3-477a-a0b6-e6313b446364', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"59d2057f-d7a3-477a-a0b6-e6313b446364\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-03 07:14:41', '2021-10-03 07:14:41'),
('603e046b-bef9-4962-a639-115309207990', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"603e046b-bef9-4962-a639-115309207990\",\"title\":\"Send_Request\",\"user\":\"laila msallaty\",\"url\":\"Employee_Requests\"}', '2021-10-08 15:16:38', '2021-10-08 15:16:24', '2021-10-08 15:16:38'),
('63772ad0-bc03-45fb-81b7-051531a8f71c', 'App\\Notifications\\AcceptRejectLeave', 'App\\User', 59, '{\"id\":\"63772ad0-bc03-45fb-81b7-051531a8f71c\",\"title\":\"Accept_Reject_Leave\",\"user\":\"lujain Alnaser\",\"url\":\"Leave_Request.index\"}', '2021-10-03 19:35:00', '2021-10-03 19:33:22', '2021-10-03 19:35:00'),
('65c11315-3b9a-488b-9cfb-fdce4815be52', 'App\\Notifications\\AcceptRejectLeave', 'App\\User', 53, '{\"id\":\"65c11315-3b9a-488b-9cfb-fdce4815be52\",\"title\":\"Accept_Reject_Leave\",\"user\":\"joud almuhamed\",\"url\":\"Leave_Request.index\"}', '2021-10-20 18:58:49', '2021-10-20 18:58:27', '2021-10-20 18:58:49'),
('679e9f2a-c143-4ef8-9a7b-a0adf3e6c338', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"679e9f2a-c143-4ef8-9a7b-a0adf3e6c338\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:35:50', '2021-10-08 10:35:50'),
('68244be2-17e7-4e94-920a-b08968143c8f', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"68244be2-17e7-4e94-920a-b08968143c8f\",\"title\":\"Send_Request\",\"user\":\"laila msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 15:20:50', '2021-10-08 15:20:50'),
('69b04f32-9aea-47c4-9f78-6547e65682fc', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":\"69b04f32-9aea-47c4-9f78-6547e65682fc\",\"title\":\"Receive_Leave\",\"user\":\"amar msallaty\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-08 10:17:53', '2021-10-08 10:17:53'),
('6a91d618-ac06-4e02-a06b-df981535e29d', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":\"6a91d618-ac06-4e02-a06b-df981535e29d\",\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-03 19:31:22', '2021-10-03 19:31:22'),
('6d1182e5-6587-461d-8b83-a89373e6589e', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 52, '{\"id\":\"6d1182e5-6587-461d-8b83-a89373e6589e\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:21:48', '2021-10-08 15:21:48'),
('6f402352-995d-4045-84ab-dfb2dde06dba', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 59, '{\"id\":\"6f402352-995d-4045-84ab-dfb2dde06dba\",\"title\":\"Accept_Reject_Request\",\"user\":\"lujain Alnaser\",\"url\":\"Send_Request.index\"}', '2021-10-03 19:48:43', '2021-10-03 19:48:10', '2021-10-03 19:48:43'),
('7089c2c6-0bce-4cf7-83ea-c54567f509c9', 'App\\Notifications\\SlipPaid', 'App\\User', 53, '{\"id\":\"7089c2c6-0bce-4cf7-83ea-c54567f509c9\",\"title\":\"Pay_Salary\",\"user\":\"joud almuhamed\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-08 12:57:49', '2021-10-08 12:57:49'),
('7593d0e9-2c72-4763-a156-53d2f81be8d0', 'App\\Notifications\\AcceptRejectLeave', 'App\\User', 53, '{\"id\":\"7593d0e9-2c72-4763-a156-53d2f81be8d0\",\"title\":\"Accept_Reject_Leave\",\"user\":\"joud almuhamed\",\"url\":\"Leave_Request.index\"}', '2021-10-08 10:19:49', '2021-10-08 10:19:33', '2021-10-08 10:19:49'),
('7844bee8-5d5f-4ffd-b431-7fa7089c4c1c', 'App\\Notifications\\TaskComplete', 'App\\User', 56, '{\"id\":\"7844bee8-5d5f-4ffd-b431-7fa7089c4c1c\",\"title\":\"Receive_Task\",\"user\":\"amar msallaty\",\"url\":\"Send_Task.index\"}', NULL, '2021-10-08 15:56:22', '2021-10-08 15:56:22'),
('7d33dacf-75f0-4c48-a0fd-faf44a9f9e78', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"7d33dacf-75f0-4c48-a0fd-faf44a9f9e78\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-03 07:09:22', '2021-10-03 07:09:22'),
('7e92520d-0aae-4838-9440-8a427f15f225', 'App\\Notifications\\SlipPaid', 'App\\User', 54, '{\"id\":\"7e92520d-0aae-4838-9440-8a427f15f225\",\"title\":\"Pay_Salary\",\"user\":\"laila msallaty\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-08 14:07:29', '2021-10-08 14:07:29'),
('7f6faab5-7586-4598-a084-5334b2f9e67a', 'App\\Notifications\\ArriveAward', 'App\\User', 54, '{\"id\":\"7f6faab5-7586-4598-a084-5334b2f9e67a\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', NULL, '2021-10-04 08:24:32', '2021-10-04 08:24:32'),
('81112b6a-6f62-47ec-9ead-95883edd8126', 'App\\Notifications\\ArriveAward', 'App\\User', 53, '{\"id\":\"81112b6a-6f62-47ec-9ead-95883edd8126\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', '2021-09-30 16:05:30', '2021-09-30 16:04:53', '2021-09-30 16:05:30'),
('82c56261-f686-4a09-bee9-03c20c85fdf1', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":\"82c56261-f686-4a09-bee9-03c20c85fdf1\",\"title\":\"Receive_Leave\",\"user\":\"amar msallaty\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-20 18:56:31', '2021-10-20 18:56:31'),
('82e52725-5d0c-4e48-9151-e20516a2e5ba', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 56, '{\"id\":\"82e52725-5d0c-4e48-9151-e20516a2e5ba\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:21:58', '2021-10-08 15:21:58'),
('83be9917-0ff2-4117-acfe-a41bc3693ba0', 'App\\Notifications\\SlipPaid', 'App\\User', 54, '{\"id\":\"83be9917-0ff2-4117-acfe-a41bc3693ba0\",\"title\":\"Pay_Salary\",\"user\":\"laila msallaty\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-05 15:38:36', '2021-10-05 15:38:36'),
('87d4b478-d25e-4134-95d3-c3be2d1e027f', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"87d4b478-d25e-4134-95d3-c3be2d1e027f\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:35:50', '2021-10-08 10:35:50'),
('883f285d-7fbe-42ee-b3f7-210939eee67f', 'App\\Notifications\\ArriveLeave', 'App\\User', 56, '{\"id\":\"883f285d-7fbe-42ee-b3f7-210939eee67f\",\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', NULL, '2021-10-03 06:56:31', '2021-10-03 06:56:31'),
('8b6268f2-d7ce-4d25-adf8-c48c44c95dca', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"8b6268f2-d7ce-4d25-adf8-c48c44c95dca\",\"title\":\"Send_Request\",\"user\":\"sara ali\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-20 19:08:09', '2021-10-20 19:08:09'),
('8b8f185a-1cab-4963-9b1f-dd58285e9f4f', 'App\\Notifications\\AcceptRejectLeave', 'App\\User', 59, '{\"id\":\"8b8f185a-1cab-4963-9b1f-dd58285e9f4f\",\"title\":\"Accept_Reject_Leave\",\"user\":\"laila msallaty\",\"url\":\"Leave_Request.index\"}', NULL, '2021-10-03 06:57:37', '2021-10-03 06:57:37'),
('8e2aa13f-8ad6-4fe8-97e2-2875ebca3cf6', 'App\\Notifications\\ArriveTask', 'App\\User', 53, '{\"id\":\"8e2aa13f-8ad6-4fe8-97e2-2875ebca3cf6\",\"title\":\"Send_Task\",\"user\":\"joud almuhamed\",\"url\":\"Receive_Task.index\"}', '2021-10-08 15:46:09', '2021-10-08 15:46:00', '2021-10-08 15:46:09'),
('93ffa436-6c22-487a-a08f-66fdb5a7e2ec', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"93ffa436-6c22-487a-a08f-66fdb5a7e2ec\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', '2021-10-03 07:15:50', '2021-10-03 07:09:22', '2021-10-03 07:15:50'),
('9921d27a-d1e1-43a8-9b4b-24c099e24a7b', 'App\\Notifications\\ArriveAward', 'App\\User', 54, '{\"id\":\"9921d27a-d1e1-43a8-9b4b-24c099e24a7b\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', NULL, '2021-10-04 08:23:43', '2021-10-04 08:23:43'),
('9cf3f149-d410-4614-94a4-4a1f135027cb', 'App\\Notifications\\ArriveAward', 'App\\User', 59, '{\"id\":\"9cf3f149-d410-4614-94a4-4a1f135027cb\",\"title\":\"Send_Award\",\"user\":\"lujain Alnaser\",\"url\":\"Employee_Awards\"}', '2021-10-03 19:39:04', '2021-10-03 19:38:38', '2021-10-03 19:39:04'),
('9ebc0a27-37ac-4e66-aeef-bc63e6aea16d', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"9ebc0a27-37ac-4e66-aeef-bc63e6aea16d\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', '2021-10-03 07:15:50', '2021-10-03 07:07:42', '2021-10-03 07:15:50'),
('9ee1fd1b-d197-4dfd-9261-609e5ee82c24', 'App\\Notifications\\SlipPaid', 'App\\User', 53, '{\"id\":\"9ee1fd1b-d197-4dfd-9261-609e5ee82c24\",\"title\":\"Pay_Salary\",\"user\":\"joud almuhamed\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-08 12:57:18', '2021-10-08 12:57:18'),
('a21071a0-4f3e-4258-9930-69e6c58e2dc0', 'App\\Notifications\\ArriveTask', 'App\\User', 59, '{\"id\":\"a21071a0-4f3e-4258-9930-69e6c58e2dc0\",\"title\":\"Send_Task\",\"user\":\"lujain Alnaser\",\"url\":\"Receive_Task.index\"}', '2021-10-03 20:04:37', '2021-10-03 20:04:16', '2021-10-03 20:04:37'),
('a3e6ce61-d089-490a-ae10-549d881b6aaa', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"a3e6ce61-d089-490a-ae10-549d881b6aaa\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', '2021-10-03 07:15:50', '2021-10-03 07:14:41', '2021-10-03 07:15:50'),
('a460f86a-ba1e-437e-9eb1-22575affb02f', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"a460f86a-ba1e-437e-9eb1-22575affb02f\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:33:56', '2021-10-08 10:33:56'),
('a51734d7-99fd-43ab-9efe-15af72ff1e2b', 'App\\Notifications\\ArriveAward', 'App\\User', 54, '{\"id\":\"a51734d7-99fd-43ab-9efe-15af72ff1e2b\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', NULL, '2021-10-04 08:22:39', '2021-10-04 08:22:39'),
('a6774aad-9511-413c-aeb3-9f7e990391d4', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"a6774aad-9511-413c-aeb3-9f7e990391d4\",\"title\":\"Send_Request\",\"user\":\"amar msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:33:56', '2021-10-08 10:33:56'),
('aa5db368-42f7-4bf9-ae0b-eebe65fa945a', 'App\\Notifications\\ReplyRequest', 'App\\User', 53, '{\"id\":\"aa5db368-42f7-4bf9-ae0b-eebe65fa945a\",\"title\":\"Request_Reply\",\"user\":\"joud almuhamed\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:32:14', '2021-10-08 10:32:14'),
('aa8cd627-faef-443d-b68d-002870428910', 'App\\Notifications\\TaskComplete', 'App\\User', 52, '{\"id\":\"aa8cd627-faef-443d-b68d-002870428910\",\"title\":\"Receive_Task\",\"user\":\"sara ali\",\"url\":\"Send_Task.index\"}', '2021-10-20 19:18:28', '2021-10-20 19:17:53', '2021-10-20 19:18:28'),
('ae24e311-41ca-4191-a40b-847345d1524e', 'App\\Notifications\\ReceivePunishment', 'App\\User', 63, '{\"id\":\"ae24e311-41ca-4191-a40b-847345d1524e\",\"title\":\"Receive_Punishment\",\"user\":\"joud almuhamed\",\"url\":\"Employee_punishment.index\"}', NULL, '2021-10-08 09:46:49', '2021-10-08 09:46:49'),
('ae82e521-f81e-4453-9478-8e7a55d25352', 'App\\Notifications\\ReplyRequest', 'App\\User', 53, '{\"id\":\"ae82e521-f81e-4453-9478-8e7a55d25352\",\"title\":\"Request_Reply\",\"user\":\"joud almuhamed\",\"url\":\"Employee_Requests\"}', '2021-10-08 10:35:02', '2021-10-08 10:34:22', '2021-10-08 10:35:02'),
('b501139a-d054-4a8b-b430-18aa56abbebc', 'App\\Notifications\\SendRequest', 'App\\User', 54, '{\"id\":\"b501139a-d054-4a8b-b430-18aa56abbebc\",\"title\":\"Send_Request\",\"user\":\"laila msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 15:16:24', '2021-10-08 15:16:24'),
('b50843c3-b7d6-41ac-9adc-7d9ffb80d8a9', 'App\\Notifications\\AcceptRejectTask', 'App\\User', 59, '{\"id\":\"b50843c3-b7d6-41ac-9adc-7d9ffb80d8a9\",\"title\":\"Accept_Reject_Task\",\"user\":\"lujain Alnaser\",\"url\":\"Receive_Task.index\"}', NULL, '2021-10-03 20:16:07', '2021-10-03 20:16:07'),
('b5089059-f001-48e6-84d9-8eacbc6ea09f', 'App\\Notifications\\ReplyRequest', 'App\\User', 53, '{\"id\":\"b5089059-f001-48e6-84d9-8eacbc6ea09f\",\"title\":\"Request_Reply\",\"user\":\"joud almuhamed\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 10:27:28', '2021-10-08 10:27:28'),
('ba288744-d687-454a-a0bb-e51f65c026bd', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 59, '{\"id\":\"ba288744-d687-454a-a0bb-e51f65c026bd\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:22:21', '2021-10-08 15:22:21'),
('bab7a70b-f5fb-4327-9462-4df9fd801381', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":\"bab7a70b-f5fb-4327-9462-4df9fd801381\",\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', '2021-10-03 07:15:50', '2021-10-03 06:59:03', '2021-10-03 07:15:50'),
('bb49ef29-e10d-4cce-a4ba-00733f3a0783', 'App\\Notifications\\ArriveTask', 'App\\User', 53, '{\"id\":\"bb49ef29-e10d-4cce-a4ba-00733f3a0783\",\"title\":\"Send_Task\",\"user\":\"joud almuhamed\",\"url\":\"Receive_Task.index\"}', NULL, '2021-10-08 15:48:34', '2021-10-08 15:48:34'),
('c3656ca5-f157-4dbd-94f3-bd1802ec79c9', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 52, '{\"id\":\"c3656ca5-f157-4dbd-94f3-bd1802ec79c9\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:17:16', '2021-10-08 15:17:16'),
('c5b77bd1-2e99-4734-bc12-253786e9b9de', 'App\\Notifications\\ArriveTask', 'App\\User', 53, '{\"id\":\"c5b77bd1-2e99-4734-bc12-253786e9b9de\",\"title\":\"Send_Task\",\"user\":\"laila msallaty\",\"url\":\"Receive_Task.index\"}', '2021-09-30 16:10:23', '2021-09-30 16:10:12', '2021-09-30 16:10:23'),
('c93c3268-8d00-4bbf-9def-449144db82c7', 'App\\Notifications\\ArriveAward', 'App\\User', 53, '{\"id\":\"c93c3268-8d00-4bbf-9def-449144db82c7\",\"title\":\"Send_Award\",\"user\":\"joud almuhamed\",\"url\":\"Employee_Awards\"}', '2021-10-08 10:21:52', '2021-10-08 10:21:30', '2021-10-08 10:21:52'),
('cbd6f7e1-c465-41f9-96af-dd06bfeb9470', 'App\\Notifications\\SlipPaid', 'App\\User', 54, '{\"id\":\"cbd6f7e1-c465-41f9-96af-dd06bfeb9470\",\"title\":\"Pay_Salary\",\"user\":\"laila msallaty\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-08 14:09:19', '2021-10-08 14:09:19'),
('cd493e6a-89fa-4e9c-b047-bde7b7b279eb', 'App\\Notifications\\TaskComplete', 'App\\User', 54, '{\"id\":\"cd493e6a-89fa-4e9c-b047-bde7b7b279eb\",\"title\":\"Receive_Task\",\"user\":\"sana humsi\",\"url\":\"Send_Task.index\"}', NULL, '2021-10-03 20:06:30', '2021-10-03 20:06:30'),
('ce4ab261-3c38-4f19-ad7c-26d3b1444da8', 'App\\Notifications\\ArriveLeave', 'App\\User', 56, '{\"id\":\"ce4ab261-3c38-4f19-ad7c-26d3b1444da8\",\"title\":\"Receive_Leave\",\"user\":\"amar msallaty\",\"url\":\"Employee_Leave_Requests\"}', '2021-10-20 18:58:07', '2021-10-20 18:56:31', '2021-10-20 18:58:07'),
('cfd23f8d-40ed-4d24-a52d-94370d121578', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"cfd23f8d-40ed-4d24-a52d-94370d121578\",\"title\":\"Send_Request\",\"user\":\"sara ali\",\"url\":\"Employee_Requests\"}', '2021-10-20 19:09:59', '2021-10-20 19:08:09', '2021-10-20 19:09:59'),
('d1deb5da-5ccf-4839-a853-7db06173bf41', 'App\\Notifications\\ArriveAward', 'App\\User', 54, '{\"id\":\"d1deb5da-5ccf-4839-a853-7db06173bf41\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', NULL, '2021-10-04 08:23:23', '2021-10-04 08:23:23'),
('d3a04e07-d86c-4ea6-a59f-fed76524f2d0', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 53, '{\"id\":\"d3a04e07-d86c-4ea6-a59f-fed76524f2d0\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:22:34', '2021-10-08 15:22:34'),
('e0193b87-6696-40e2-ad9a-5f3c0205e839', 'App\\Notifications\\ArriveAward', 'App\\User', 55, '{\"id\":\"e0193b87-6696-40e2-ad9a-5f3c0205e839\",\"title\":\"Send_Award\",\"user\":\"laila msallaty\",\"url\":\"Employee_Awards\"}', '2021-10-05 16:08:59', '2021-10-05 16:02:00', '2021-10-05 16:08:59'),
('e2376e0f-fb71-433d-b7b3-a9e35e4cb21e', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 53, '{\"id\":\"e2376e0f-fb71-433d-b7b3-a9e35e4cb21e\",\"title\":\"Accept_Reject_Request\",\"user\":\"joud almuhamed\",\"url\":\"Send_Request.index\"}', '2021-10-08 10:28:03', '2021-10-08 10:27:48', '2021-10-08 10:28:03'),
('e4033456-9a51-473e-8edc-9f1703999dd5', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":48,\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', '2021-10-03 07:15:50', '2021-10-03 07:04:51', '2021-10-03 07:15:50'),
('e76e4723-3a65-4d8e-b0b4-4d59bdc47c8e', 'App\\Notifications\\SendRequest', 'App\\User', 56, '{\"id\":\"e76e4723-3a65-4d8e-b0b4-4d59bdc47c8e\",\"title\":\"Send_Request\",\"user\":\"sana humsi\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-03 07:18:31', '2021-10-03 07:18:31'),
('e77b60f3-98c8-4c5a-ae53-0100555ee5be', 'App\\Notifications\\ArriveTask', 'App\\User', 71, '{\"id\":\"e77b60f3-98c8-4c5a-ae53-0100555ee5be\",\"title\":\"Send_Task\",\"user\":\"laila msallaty\",\"url\":\"Receive_Task.index\"}', '2021-10-20 19:16:47', '2021-10-20 19:15:37', '2021-10-20 19:16:47'),
('ece6a96f-36b7-4c13-ac5d-ca38acf2ec11', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 59, '{\"id\":\"ece6a96f-36b7-4c13-ac5d-ca38acf2ec11\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:22:04', '2021-10-08 15:22:04'),
('ef6793e6-6be2-4ab1-b78c-88f7feb60362', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 52, '{\"id\":\"ef6793e6-6be2-4ab1-b78c-88f7feb60362\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:21:53', '2021-10-08 15:21:53'),
('f3df91b3-e5c0-4a3e-a6bc-f55dd4890cee', 'App\\Notifications\\ArriveLeave', 'App\\User', 54, '{\"id\":\"f3df91b3-e5c0-4a3e-a6bc-f55dd4890cee\",\"title\":\"Receive_Leave\",\"user\":\"sana humsi\",\"url\":\"Employee_Leave_Requests\"}', '2021-10-03 19:30:45', '2021-10-03 19:28:21', '2021-10-03 19:30:45'),
('f403d05d-e9db-4b36-812b-220e935898ea', 'App\\Notifications\\ArriveTask', 'App\\User', 59, '{\"id\":\"f403d05d-e9db-4b36-812b-220e935898ea\",\"title\":\"Send_Task\",\"user\":\"lujain Alnaser\",\"url\":\"Receive_Task.index\"}', '2021-10-03 19:58:46', '2021-10-03 19:58:00', '2021-10-03 19:58:46'),
('f6d6c113-de28-404b-841d-d8469ae82afe', 'App\\Notifications\\SlipPaid', 'App\\User', 59, '{\"id\":\"f6d6c113-de28-404b-841d-d8469ae82afe\",\"title\":\"Pay_Salary\",\"user\":\"laila msallaty\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-03 07:06:32', '2021-10-03 07:06:32'),
('f9651972-cc46-4942-9adb-5a0416be1eb5', 'App\\Notifications\\AcceptRejectRequest', 'App\\User', 59, '{\"id\":\"f9651972-cc46-4942-9adb-5a0416be1eb5\",\"title\":\"Accept_Reject_Request\",\"user\":\"laila msallaty\",\"url\":\"Send_Request.index\"}', NULL, '2021-10-08 15:22:09', '2021-10-08 15:22:09'),
('f9f6225a-3da3-47e1-9aab-16434c0af2ce', 'App\\Notifications\\SendRequest', 'App\\User', 52, '{\"id\":\"f9f6225a-3da3-47e1-9aab-16434c0af2ce\",\"title\":\"Send_Request\",\"user\":\"laila msallaty\",\"url\":\"Employee_Requests\"}', NULL, '2021-10-08 15:20:50', '2021-10-08 15:20:50'),
('fd5938dd-804a-41a0-85a7-a32ef3581bfc', 'App\\Notifications\\ReceivePunishment', 'App\\User', 71, '{\"id\":\"fd5938dd-804a-41a0-85a7-a32ef3581bfc\",\"title\":\"Receive_Punishment\",\"user\":\"laila msallaty\",\"url\":\"Employee_punishment.index\"}', NULL, '2021-10-20 18:46:51', '2021-10-20 18:46:51'),
('fda72d97-45cc-49d5-b615-f17f15d18dd0', 'App\\Notifications\\SlipPaid', 'App\\User', 52, '{\"id\":\"fda72d97-45cc-49d5-b615-f17f15d18dd0\",\"title\":\"Pay_Salary\",\"user\":\"lujain Alnaser\",\"url\":\"employeesalary.index\"}', '2021-10-04 08:20:02', '2021-10-03 19:11:06', '2021-10-04 08:20:02'),
('ff0a64cd-8f8d-4d3d-8629-de8cc94e9263', 'App\\Notifications\\SlipPaid', 'App\\User', 53, '{\"id\":\"ff0a64cd-8f8d-4d3d-8629-de8cc94e9263\",\"title\":\"Pay_Salary\",\"user\":\"joud almuhamed\",\"url\":\"employeesalary.index\"}', NULL, '2021-10-08 10:07:55', '2021-10-08 10:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(548, '{\"en\":\"General_Management\",\"ar\":\"\\u0625\\u062f\\u0627\\u0631\\u0629_\\u0639\\u0627\\u0645\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(549, '{\"en\":\"Manage_Employees\",\"ar\":\"\\u0625\\u062f\\u0627\\u0631\\u0629_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(550, '{\"en\":\"Employee_Processes\",\"ar\":\"\\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a_\\u0639\\u0644\\u0649_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(551, '{\"en\":\"Reports\",\"ar\":\"\\u0627\\u0644\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(552, '{\"en\":\"Users\",\"ar\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(553, '{\"en\":\"Roles\",\"ar\":\"\\u0627\\u0644\\u0623\\u062f\\u0648\\u0627\\u0631\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(554, '{\"en\":\"Pay_Salary\",\"ar\":\"\\u062f\\u0641\\u0639_\\u0631\\u0627\\u062a\\u0628\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(555, '{\"en\":\"Salaries\",\"ar\":\"\\u0627\\u0644\\u0631\\u0648\\u0627\\u062a\\u0628\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(556, '{\"en\":\"Employee_Salaries\",\"ar\":\"\\u0631\\u0648\\u0627\\u062a\\u0628_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(557, '{\"en\":\"Salaries_List\",\"ar\":\"\\u0642\\u0627\\u0626\\u0645\\u0629_\\u0627\\u0644\\u0631\\u0648\\u0627\\u062a\\u0628\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(558, '{\"en\":\"Edit_Delete_Salary\",\"ar\":\"\\u062a\\u0639\\u062f\\u064a\\u0644_\\u062d\\u0630\\u0641_\\u0631\\u0627\\u062a\\u0628\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(559, '{\"en\":\"Pay_Advance\",\"ar\":\"\\u062f\\u0641\\u0639_\\u0633\\u0644\\u0641\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(560, '{\"en\":\"Edit_Advance\",\"ar\":\"\\u062a\\u0639\\u062f\\u064a\\u0644_\\u0633\\u0644\\u0641\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(561, '{\"en\":\"Delete_Advance\",\"ar\":\"\\u062d\\u0630\\u0641_\\u0633\\u0644\\u0641\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(562, '{\"en\":\"Resigned_Requests\",\"ar\":\"\\u0637\\u0644\\u0628\\u0627\\u062a_\\u0627\\u0644\\u0627\\u0633\\u062a\\u0642\\u0627\\u0644\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(563, '{\"en\":\"Add_Resignation\",\"ar\":\"\\u0625\\u0636\\u0627\\u0641\\u0629_\\u0627\\u0633\\u062a\\u0642\\u0627\\u0644\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(564, '{\"en\":\"Show_Resigned_Employees\",\"ar\":\"\\u0639\\u0631\\u0636_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646_\\u0627\\u0644\\u0645\\u0633\\u062a\\u0642\\u064a\\u0644\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(565, '{\"en\":\"Resigned_Employees_Processes\",\"ar\":\"\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646_\\u0627\\u0644\\u0645\\u0633\\u062a\\u0642\\u064a\\u0644\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(566, '{\"en\":\"Punishments\",\"ar\":\"\\u0627\\u0644\\u0639\\u0642\\u0648\\u0628\\u0627\\u062a\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(567, '{\"en\":\"Impose_Punishment\",\"ar\":\"\\u0641\\u0631\\u0636_\\u0639\\u0642\\u0648\\u0628\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(568, '{\"en\":\"Punishmented_Employee\",\"ar\":\"\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646_\\u0627\\u0644\\u0645\\u0639\\u0627\\u0642\\u0628\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(569, '{\"en\":\"Punishmented_Employee_Processes\",\"ar\":\"\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646_\\u0627\\u0644\\u0645\\u0639\\u0627\\u0642\\u0628\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(570, '{\"en\":\"Employee_Punishments\",\"ar\":\"\\u0639\\u0642\\u0648\\u0628\\u0627\\u062a_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(571, '{\"en\":\"Attendance_Register\",\"ar\":\"\\u062a\\u0633\\u062c\\u064a\\u0644_\\u0627\\u0644\\u062f\\u0648\\u0627\\u0645\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(572, '{\"en\":\"Leaves\",\"ar\":\"\\u0627\\u0644\\u0625\\u062c\\u0627\\u0632\\u0627\\u062a\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(573, '{\"en\":\"View_Leave_Requests\",\"ar\":\"\\u0639\\u0631\\u0636_\\u0637\\u0644\\u0628\\u0627\\u062a_\\u0627\\u0644\\u0625\\u062c\\u0627\\u0632\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(574, '{\"en\":\"Leave_Request\",\"ar\":\"\\u062a\\u0642\\u062f\\u064a\\u0645_\\u0637\\u0644\\u0628_\\u0625\\u062c\\u0627\\u0632\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(575, '{\"en\":\"Awards\",\"ar\":\"\\u0627\\u0644\\u062c\\u0648\\u0627\\u0626\\u0632\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(576, '{\"en\":\"Add_Awards\",\"ar\":\"\\u0625\\u0636\\u0627\\u0641\\u0629_\\u062c\\u0627\\u0626\\u0632\\u0629\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(577, '{\"en\":\"Employee_Awards\",\"ar\":\"\\u062c\\u0648\\u0627\\u0626\\u0632_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\"}', 'web', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(578, '{\"en\":\"Requests\",\"ar\":\"\\u0627\\u0644\\u0637\\u0644\\u0628\\u0627\\u062a\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(579, '{\"en\":\"Employees_Requests_Show\",\"ar\":\"\\u0639\\u0631\\u0636_\\u0637\\u0644\\u0628\\u0627\\u062a_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(580, '{\"en\":\"Send_Requests\",\"ar\":\"\\u0627\\u0631\\u0633\\u0627\\u0644_\\u0637\\u0644\\u0628\\u0627\\u062a\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(581, '{\"en\":\"Tasks\",\"ar\":\"\\u0627\\u0644\\u0645\\u0647\\u0627\\u0645\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(582, '{\"en\":\"Employees_Tasks_Show\",\"ar\":\"\\u0639\\u0631\\u0636_\\u0645\\u0647\\u0627\\u0645_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(583, '{\"en\":\"Employee_Tasks\",\"ar\":\"\\u0645\\u0647\\u0627\\u0645_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(584, '{\"en\":\"Show_Attendances_Calendar\",\"ar\":\"\\u0635\\u0644\\u0627\\u062d\\u064a\\u0629_\\u0639\\u0631\\u0636_\\u062a\\u0642\\u0648\\u064a\\u0645_\\u0627\\u0644\\u062f\\u0648\\u0627\\u0645\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(585, '{\"en\":\"Show_Tasks_Calendar\",\"ar\":\"\\u0635\\u0644\\u0627\\u062d\\u064a\\u0629_\\u0639\\u0631\\u0636_\\u062a\\u0642\\u0648\\u064a\\u0645_\\u0627\\u0644\\u0645\\u0647\\u0627\\u0645\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(586, '{\"en\":\"Show_Events\",\"ar\":\"\\u0635\\u0644\\u0627\\u062d\\u064a\\u0629_\\u0639\\u0631\\u0636_\\u062a\\u0642\\u0648\\u064a\\u0645_\\u0627\\u0644\\u0645\\u0646\\u0627\\u0633\\u0628\\u0627\\u062a\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(587, '{\"en\":\"Editing_To_Same_Location\",\"ar\":\"\\u062a\\u0639\\u062f\\u064a\\u0644_\\u0644\\u0646\\u0641\\u0633_\\u0627\\u0644\\u0645\\u0631\\u0643\\u0632\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(588, '{\"en\":\"Just_Employees_Processes\",\"ar\":\"\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a_\\u0639\\u0644\\u0649_\\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646_\\u0641\\u0642\\u0637\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(589, '{\"en\":\"Editing_To_Same_Department\",\"ar\":\"تعديل_لنفس_القسم\"}', 'web', '2021-09-30 17:12:39', '2021-09-30 17:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Salary` bigint(20) NOT NULL,
  `FT_PT` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Requirements` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Department_Id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `Role`, `Status`, `Salary`, `FT_PT`, `Requirements`, `Department_Id`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"web Design\",\"ar\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628\"}', 1, 400000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u0643\\u0627\\u0645\\u0644\",\"en\":\"Full Time\"}', 'html/css/js', 1, '2021-08-02 16:10:53', '2021-09-19 06:38:50'),
(2, '{\"en\":\"Android Programming\",\"ar\":\"\\u0628\\u0631\\u0645\\u062c\\u0629 \\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a \\u0627\\u0644\\u0623\\u0646\\u062f\\u0631\\u0648\\u064a\\u062f\"}', 1, 500000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u062c\\u0632\\u0626\\u064a\",\"en\":\"Part Time\"}', 'java', 2, '2021-08-02 16:11:18', '2021-08-02 16:11:18'),
(3, '{\"en\":\"web Programming\",\"ar\":\"\\u0628\\u0631\\u0645\\u062c\\u0629 \\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628\"}', 1, 600000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u0643\\u0627\\u0645\\u0644\",\"en\":\"Full Time\"}', 'php', 1, '2021-08-02 16:11:41', '2021-08-02 16:11:41'),
(4, '{\"en\":\"Logos Design\",\"ar\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0634\\u0639\\u0627\\u0631\\u0627\\u062a\"}', 1, 300000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u062c\\u0632\\u0626\\u064a\",\"en\":\"Part Time\"}', 'illustrator', 3, '2021-08-02 16:12:06', '2021-08-02 16:12:06'),
(5, '{\"en\":\"Desktop Programming\",\"ar\":\"\\u0628\\u0631\\u0645\\u062c\\u0629 \\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a \\u0633\\u0637\\u062d \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\"}', 1, 200000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u0643\\u0627\\u0645\\u0644\",\"en\":\"Full Time\"}', 'c#', 4, '2021-08-02 16:12:26', '2021-08-02 16:12:26'),
(6, '{\"en\":\"HR Manager\",\"ar\":\"\\u0645\\u062f\\u064a\\u0631 \\u0645\\u0648\\u0627\\u0631\\u062f\"}', 1, 200000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u0643\\u0627\\u0645\\u0644\",\"en\":\"Full Time\"}', 'إدارة عامة لموظفي الشركة', 5, '2021-09-24 17:40:18', '2021-09-24 17:40:18'),
(10, '{\"en\":\"fee officer\",\"ar\":\"\\u0645\\u0639\\u062a\\u0645\\u062f \\u0627\\u0644\\u0631\\u0633\\u0648\\u0645\"}', 0, 200000, '{\"ar\":\"\\u062f\\u0648\\u0627\\u0645 \\u0643\\u0627\\u0645\\u0644\",\"en\":\"Full Time\"}', 'محاسبة', 9, '2021-10-20 18:36:05', '2021-10-20 18:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `punishments`
--

CREATE TABLE `punishments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Deducted_Amount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `punishments`
--

INSERT INTO `punishments` (`id`, `Name`, `Description`, `Deducted_Amount`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Temporary suspension\",\"ar\":\"\\u0627\\u064a\\u0642\\u0627\\u0641 \\u0645\\u0624\\u0642\\u062a \\u0639\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\"}', 'فصل مؤقت من العمل', NULL, '2021-08-24 17:50:08', '2021-09-19 06:34:47'),
(2, '{\"en\":\"Oral Reprimand\",\"ar\":\"\\u062a\\u0648\\u0628\\u064a\\u062e \\u0634\\u0641\\u0648\\u064a\"}', 'توبيخ', 10000, '2021-09-13 16:21:36', '2021-09-13 16:21:36'),
(3, '{\"en\":\"Salary Reduction\",\"ar\":\"\\u062a\\u062e\\u0641\\u064a\\u0636 \\u0627\\u0644\\u0631\\u0627\\u062a\\u0628\"}', 'تخفيض الراتب', 100000, '2021-09-13 16:22:38', '2021-09-13 16:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `Name`, `created_at`, `updated_at`) VALUES
(217, '{\"en\":\"Request for Resignation\",\"ar\":\" \\u0625\\u0633\\u062a\\u0642\\u0627\\u0644\\u0629\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(218, '{\"en\":\"Transfer Request\",\"ar\":\" \\u0625\\u0646\\u062a\\u0642\\u0627\\u0644\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(219, '{\"en\":\"Paying Avanced Request\",\"ar\":\" \\u062f\\u0641\\u0639 \\u0633\\u0644\\u0641\\u0629\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(220, '{\"en\":\"Edit in an employee record\",\"ar\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0641\\u064a \\u0633\\u062c\\u0644 \\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(221, '{\"en\":\"Paycheck Pickup\",\"ar\":\"\\u0627\\u0633\\u062a\\u0644\\u0627\\u0645 \\u0634\\u064a\\u0643 \\u0627\\u0644\\u0631\\u0627\\u062a\\u0628\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57'),
(222, '{\"en\":\" Employment Verification\",\"ar\":\"\\u0625\\u062b\\u0628\\u0627\\u062a \\u0648\\u0638\\u064a\\u0641\\u064a\"}', '2021-09-23 08:02:57', '2021-09-23 08:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(28, '{\"ar\":\"\\u0627\\u0644\\u0645\\u062f\\u064a\\u0631\",\"en\":\"Admin\"}', 'web', '2021-09-23 08:02:58', '2021-09-23 08:02:58'),
(29, '{\"ar\":\"\\u0645\\u0648\\u0638\\u0641\",\"en\":\"Employee\"}', 'web', '2021-09-24 16:31:53', '2021-09-24 16:31:53'),
(30, '{\"ar\":\"\\u0645\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0631\\u062f \\u0627\\u0644\\u0628\\u0634\\u0631\\u064a\\u0629\",\"en\":\"HR Manager\"}', 'web', '2021-09-24 16:51:56', '2021-09-24 16:51:56'),
(31, '{\"ar\":\"\\u0645\\u062f\\u064a\\u0631 \\u0642\\u0633\\u0645\",\"en\":\"Department Manager\"}', 'web', '2021-09-24 16:57:32', '2021-09-24 16:57:32'),
(32, '{\"ar\":\"\\u0645\\u062e\\u062a\\u0628\\u0631\",\"en\":\"tester\"}', 'web', '2021-09-24 17:49:29', '2021-09-24 17:49:29');

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
(548, 28),
(548, 30),
(548, 32),
(549, 28),
(549, 30),
(549, 32),
(550, 28),
(550, 30),
(550, 32),
(551, 28),
(551, 30),
(551, 32),
(552, 28),
(552, 30),
(552, 32),
(553, 28),
(553, 32),
(554, 28),
(554, 30),
(554, 32),
(555, 28),
(555, 29),
(555, 30),
(555, 31),
(555, 32),
(556, 29),
(556, 31),
(557, 28),
(557, 29),
(557, 30),
(557, 31),
(557, 32),
(558, 28),
(558, 30),
(558, 32),
(559, 28),
(559, 30),
(559, 32),
(560, 28),
(560, 30),
(560, 32),
(561, 28),
(561, 30),
(561, 32),
(562, 28),
(562, 30),
(562, 32),
(563, 28),
(563, 30),
(563, 32),
(564, 28),
(564, 30),
(564, 32),
(565, 28),
(565, 30),
(565, 32),
(566, 28),
(566, 29),
(566, 30),
(566, 31),
(566, 32),
(567, 28),
(567, 30),
(567, 32),
(568, 28),
(568, 29),
(568, 30),
(568, 31),
(568, 32),
(569, 28),
(569, 30),
(569, 32),
(570, 29),
(570, 31),
(571, 28),
(571, 30),
(571, 32),
(572, 28),
(572, 29),
(572, 30),
(572, 31),
(572, 32),
(573, 28),
(573, 30),
(573, 32),
(574, 29),
(574, 30),
(574, 31),
(574, 32),
(575, 28),
(575, 29),
(575, 30),
(575, 31),
(575, 32),
(576, 28),
(576, 30),
(576, 32),
(577, 29),
(577, 30),
(577, 31),
(577, 32),
(578, 28),
(578, 29),
(578, 30),
(578, 31),
(578, 32),
(579, 28),
(579, 30),
(579, 32),
(580, 29),
(580, 30),
(580, 31),
(580, 32),
(581, 28),
(581, 29),
(581, 30),
(581, 31),
(581, 32),
(582, 28),
(582, 30),
(582, 31),
(582, 32),
(583, 29),
(583, 30),
(583, 31),
(583, 32),
(584, 29),
(584, 30),
(584, 31),
(584, 32),
(585, 29),
(585, 30),
(585, 31),
(585, 32),
(586, 28),
(586, 29),
(586, 30),
(586, 31),
(586, 32),
(587, 30),
(587, 31),
(588, 30),
(589, 31);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Employee_Id` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sent_Task_Attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Received_Task_Attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Duration` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `Sender_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `Employee_Id`, `Title`, `Description`, `Sent_Task_Attachment`, `Received_Task_Attachment`, `Comment`, `Start_Date`, `End_Date`, `Duration`, `Status`, `Sender_id`, `created_at`, `updated_at`) VALUES
(52, 48, '{\"ar\":\"\\u062c\\u0627\\u0641\\u0627\",\"en\":\"java\"}', NULL, '1012296303_personal-development-and-health-services-session-woman-kitty-ghen.jpg', '373518290_Medical-School-Personal-Statement-Guide.jpg', 'hi', '2021-10-03', '2021-10-16', 13, 1, 43, '2021-10-03 20:15:18', '2021-10-03 20:16:07'),
(53, 42, '{\"ar\":\"\\u062c\\u0627\\u0641\\u0627\",\"en\":\"java\"}', NULL, 'Slip.pdf', 'information.pdf', 'it\'s done', '2021-10-07', '2021-10-12', 5, 1, 45, '2021-10-08 15:24:48', '2021-10-08 15:26:57'),
(55, 42, '{\"ar\":\"\\u0627\\u0634 \\u062a\\u064a \\u0627\\u0645 \\u0627\\u0644\",\"en\":\"html\"}', NULL, '1653080154_—Pngtree—freelancer_3633969.png', 'yeti-blue-mac-background-hero.jpg', 'done', '2021-10-08', '2021-10-28', 20, 0, 45, '2021-10-08 15:48:34', '2021-10-08 15:56:22'),
(56, 60, '{\"ar\":\"\\u0645\\u0647\\u0645\\u0629 \\u0628\\u0631\\u0645\\u062c\\u0629  \\u0628\\u064a \\u0627\\u062a\\u0634 \\u0628\\u064a\",\"en\":\"php task\"}', NULL, 'شرح 1.pdf', 'ملخص.pdf', 'تم الانجاز', '2021-10-20', '2021-10-26', 6, 1, 41, '2021-10-20 19:15:37', '2021-10-20 19:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `Employee_Id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles_name`, `Status`, `Employee_Id`, `remember_token`, `created_at`, `updated_at`) VALUES
(52, 'laila msallaty', 'lailamsallaty607@gmail.com', NULL, '$2y$10$0RFaJtbI5Z2E5izQWrBKOeSWuIi2JR4DONdIX50JftH9TkRNQkv.S', '[\"32\"]', 1, 41, NULL, '2021-09-23 08:02:58', '2021-09-27 14:15:34'),
(53, 'amar msallaty', 'amar@gmail.com', NULL, '$2y$10$guv5TNb9Ue67bdJq4t6O9eI3N6g5MUSaOmWBPcpIDZ5Mg0ulW.XjG', '[\"29\"]', 1, 42, NULL, '2021-09-23 08:34:25', '2021-09-24 16:40:15'),
(54, 'lujain Alnaser', 'lujain@gmail.com', NULL, '$2y$10$GUgbYln6lpMQgci95GvoPOD.85biX4vncd1LX5rLgwHp36r1gq8o.', '[\"28\"]', 1, 43, NULL, '2021-09-23 08:37:27', '2021-10-02 17:39:10'),
(55, 'kawkab jeje', 'kawkab@gmail.com', NULL, '$2y$10$pmBHQGCr6nB.iTjizMuOlulA8olBakhS20VYAkioBsFKhPOa2QcNy', '[\"31\"]', 1, 44, NULL, '2021-09-24 17:22:18', '2021-10-02 17:38:46'),
(56, 'joud almuhamed', 'joud@gmail.com', NULL, '$2y$10$5CrkpmrbLKQ6ONR/WYxF/.GF9Ot4qWBMt8dyftO/EvW8T82iaE8p.', '[\"30\"]', 1, 45, NULL, '2021-09-24 17:32:48', '2021-09-24 17:34:50'),
(58, 'abdo msallaty', 'abdo@gmail.com', NULL, '$2y$10$cYNJGREXqVAJv5YWK/3Mjesm6lXHIBqcPPH8NAuusUCpd4wLypM7G', '[\"29\"]', 1, 47, NULL, '2021-10-02 17:50:24', '2021-10-08 19:46:48'),
(59, 'sana humsi', 'sana@gmail.com', NULL, '$2y$10$mncb1grQnBM.Xmxv7F7.7uoPQCW0NUL7NaFKS0jDy9ralCHifRkKC', '[\"29\"]', 1, 48, NULL, '2021-10-03 06:44:50', '2021-10-03 06:54:57'),
(61, 'ahmed msallaty', 'ahmed@gmail.com', NULL, '$2y$10$loIQ8jmdSqoUHvr.6xDER.zwD7uell1HbVXJBFMu/qxYgpzMxlWKe', '[\"29\"]', 1, 50, NULL, '2021-10-03 14:58:38', '2021-10-08 13:12:53'),
(62, 'noor horan', 'noor@gmail.com', NULL, '$2y$10$oVBOqIK/DQ9y.ymza6Wa7ODWHqobAyK6GjCEreftfmNp3bqniRau6', '[\"29\"]', 1, 51, NULL, '2021-10-03 15:25:24', '2021-10-08 13:13:17'),
(71, 'sara ali', 'sara@gmail.com', NULL, '$2y$10$xtDXw3RUrVqUZzKQCIOnfOboE.1NaLzhI.mwYULQ0p9.dXJu0l40y', '[\"29\"]', 1, 60, NULL, '2021-10-20 18:43:59', '2021-10-20 19:05:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advance_payments_employee_id_foreign` (`Employee_Id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_attachmentable_id_foreign` (`attachmentable_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`Employee_Id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`Country_Id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_location`
--
ALTER TABLE `department_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_location_location_id_foreign` (`Location_Id`),
  ADD KEY `department_location_department_id_foreign` (`Department_Id`),
  ADD KEY `department_location_manager_id_foreign` (`Manager_Id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_code_unique` (`Code`),
  ADD KEY `employees_department_id_foreign` (`Department_Id`),
  ADD KEY `employees_nationality_employee_id_foreign` (`Nationality_Employee_id`),
  ADD KEY `employees_degree_id_foreign` (`Degree_Id`),
  ADD KEY `employees_location_id_foreign` (`Location_Id`);

--
-- Indexes for table `employee_awards`
--
ALTER TABLE `employee_awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_awards_employee_id_foreign` (`Employee_Id`),
  ADD KEY `employee_awards_award_id_foreign` (`Award_Id`);

--
-- Indexes for table `employee_degree`
--
ALTER TABLE `employee_degree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_leaves_employee_id_foreign` (`Employee_Id`),
  ADD KEY `employee_leaves_leave_id_foreign` (`Leave_Id`);

--
-- Indexes for table `employee_punishments`
--
ALTER TABLE `employee_punishments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_punishments_employee_id_foreign` (`Employee_Id`),
  ADD KEY `employee_punishments_punishment_id_foreign` (`Punishment_Id`);

--
-- Indexes for table `employee_requests`
--
ALTER TABLE `employee_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_requests_employee_id_foreign` (`Employee_Id`),
  ADD KEY `employee_requests_request_id_foreign` (`Request_Id`);

--
-- Indexes for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_role_position_id_foreign` (`Position_Id`),
  ADD KEY `employee_role_employee_id_foreign` (`Employee_Id`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_salary_employee_id_foreign` (`Employee_Id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_city_id_foreign` (`City_Id`);

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
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positions_department_id_foreign` (`Department_Id`);

--
-- Indexes for table `punishments`
--
ALTER TABLE `punishments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_employee_id_foreign` (`Employee_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_employee_id_foreign` (`Employee_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_payments`
--
ALTER TABLE `advance_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `department_location`
--
ALTER TABLE `department_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `employee_awards`
--
ALTER TABLE `employee_awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `employee_degree`
--
ALTER TABLE `employee_degree`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `employee_punishments`
--
ALTER TABLE `employee_punishments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employee_requests`
--
ALTER TABLE `employee_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `employee_role`
--
ALTER TABLE `employee_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10375;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `punishments`
--
ALTER TABLE `punishments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD CONSTRAINT `advance_payments_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_attachmentable_id_foreign` FOREIGN KEY (`attachmentable_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`Country_Id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_location`
--
ALTER TABLE `department_location`
  ADD CONSTRAINT `department_location_department_id_foreign` FOREIGN KEY (`Department_Id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_location_location_id_foreign` FOREIGN KEY (`Location_Id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_location_manager_id_foreign` FOREIGN KEY (`Manager_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_degree_id_foreign` FOREIGN KEY (`Degree_Id`) REFERENCES `employee_degree` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`Department_Id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_location_id_foreign` FOREIGN KEY (`Location_Id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_nationality_employee_id_foreign` FOREIGN KEY (`Nationality_Employee_id`) REFERENCES `nationalities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_awards`
--
ALTER TABLE `employee_awards`
  ADD CONSTRAINT `employee_awards_award_id_foreign` FOREIGN KEY (`Award_Id`) REFERENCES `awards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_awards_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD CONSTRAINT `employee_leaves_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_leaves_leave_id_foreign` FOREIGN KEY (`Leave_Id`) REFERENCES `leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_punishments`
--
ALTER TABLE `employee_punishments`
  ADD CONSTRAINT `employee_punishments_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_punishments_punishment_id_foreign` FOREIGN KEY (`Punishment_Id`) REFERENCES `punishments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_requests`
--
ALTER TABLE `employee_requests`
  ADD CONSTRAINT `employee_requests_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_requests_request_id_foreign` FOREIGN KEY (`Request_Id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD CONSTRAINT `employee_role_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_role_position_id_foreign` FOREIGN KEY (`Position_Id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD CONSTRAINT `employee_salary_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_city_id_foreign` FOREIGN KEY (`City_Id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_department_id_foreign` FOREIGN KEY (`Department_Id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
