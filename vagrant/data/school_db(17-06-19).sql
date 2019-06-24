-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 10:03 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_nature`
--

CREATE TABLE `account_nature` (
  `account_nature_id` int(11) NOT NULL,
  `account_nature_name` varchar(64) NOT NULL,
  `account_nature_status` enum('+ve','-ve') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_nature`
--

INSERT INTO `account_nature` (`account_nature_id`, `account_nature_name`, `account_nature_status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Expense', '-ve', '2016-03-12 00:00:00', '2016-03-12 00:00:00', 1, 1),
(2, 'Income', '+ve', '2016-03-12 00:00:00', '2016-03-12 00:00:00', 1, 1),
(3, 'Capital', '+ve', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(4, 'Liability', '-ve', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(5, 'Assets', '+ve', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_register`
--

CREATE TABLE `account_register` (
  `account_register_id` int(11) NOT NULL,
  `account_nature_id` int(11) NOT NULL,
  `account_name` varchar(64) NOT NULL,
  `account_description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_register`
--

INSERT INTO `account_register` (`account_register_id`, `account_nature_id`, `account_name`, `account_description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 1, 'Utility Bill', 'dfghjjhbgvvgh', '2018-10-02 14:06:50', '0000-00-00 00:00:00', 2, 0),
(3, 1, 'Refreshment', 'dfghjkjhgfdfgh', '2018-10-02 14:09:42', '0000-00-00 00:00:00', 2, 0),
(4, 1, 'Internet Bill', 'dfghjkjhcvb', '2018-10-02 14:14:21', '0000-00-00 00:00:00', 2, 0),
(5, 2, 'Student Fee', 'Student Tuition Fee ', '2019-03-07 17:02:36', '0000-00-00 00:00:00', 3, 0),
(6, 1, 'Furniture', 'Purchase Chair', '2019-04-06 14:15:39', '2019-04-26 20:49:14', 1, 4),
(7, 3, 'Building', 'Institute own building.', '2019-04-15 12:06:06', '0000-00-00 00:00:00', 3, 0),
(8, 2, 'Fun Fair', 'Student fun fair annual party', '2019-04-26 21:12:16', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_transactions`
--

CREATE TABLE `account_transactions` (
  `trans_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `account_nature` varchar(11) NOT NULL,
  `account_register_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(200) NOT NULL,
  `total_amount` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_transactions`
--

INSERT INTO `account_transactions` (`trans_id`, `branch_id`, `account_nature`, `account_register_id`, `date`, `description`, `total_amount`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 6, 'Expense', 2, '2019-04-26 01:47:44', 'Utility Bill', 123, '2019-04-26 13:48:00', '0000-00-00 00:00:00', 4, 0),
(3, 6, 'Income', 5, '2019-04-26 14:16:17', 'Amount P By Voucher #: 1008', 1000, '2019-04-26 14:16:17', '0000-00-00 00:00:00', 4, 0),
(4, 6, 'Income', 5, '2019-04-26 14:17:41', 'Amount Partially Paid By Voucher #: 1008', 1000, '2019-04-26 14:17:41', '0000-00-00 00:00:00', 4, 0),
(5, 6, 'Income', 5, '2019-04-26 14:21:13', 'Amount Partially Paid By Voucher #: 1008', 10000, '2019-04-26 14:21:13', '0000-00-00 00:00:00', 4, 0),
(6, 6, 'Expense', 6, '2019-05-12 08:45:30', 'Purchase 10 student chairs', 2000, '2019-04-26 20:50:20', '0000-00-00 00:00:00', 4, 0),
(7, 5, 'Expense', 2, '2019-04-26 08:54:08', 'Utility Bill', 10000, '2019-04-26 20:54:27', '0000-00-00 00:00:00', 1, 0),
(8, 5, 'Income', 8, '2019-04-26 09:12:36', 'Fun fair amount of main campus', 5000, '2019-04-26 21:13:13', '0000-00-00 00:00:00', 1, 0),
(9, 5, 'Expense', 4, '2019-05-07 09:10:27', 'Internet Bill', 1000, '2019-04-26 21:14:18', '0000-00-00 00:00:00', 1, 0),
(10, 5, 'Income', 5, '2019-04-26 22:02:34', 'Amount Paid By Voucher #: 1014', 3000, '2019-04-26 22:02:34', '0000-00-00 00:00:00', 1, 0),
(11, 6, 'Income', 5, '2019-04-27 11:17:32', 'Amount Partially Paid By Voucher #: 1', 3000, '2019-04-27 11:17:32', '0000-00-00 00:00:00', 4, 0),
(12, 6, 'Income', 5, '2019-04-27 11:17:53', 'Amount Partially Paid By Voucher #: 2', 2000, '2019-04-27 11:17:53', '0000-00-00 00:00:00', 4, 0),
(13, 6, 'Income', 5, '2019-04-27 11:19:58', 'Amount Partially Paid By Voucher #: 9', 3000, '2019-04-27 11:19:58', '0000-00-00 00:00:00', 4, 0),
(14, 6, 'Income', 5, '2019-04-27 11:20:38', 'Amount Partially Paid By Voucher #: 1008', 4000, '2019-04-27 11:20:38', '0000-00-00 00:00:00', 4, 0),
(15, 5, 'Income', 5, '2019-05-04 10:57:36', 'Amount Partially Paid By Voucher #: 1007', 4000, '2019-05-04 10:57:36', '0000-00-00 00:00:00', 1, 0),
(16, 5, 'Income', 5, '2019-05-04 10:58:24', 'Amount Paid By Voucher #: 1008', 7000, '2019-05-04 10:58:24', '0000-00-00 00:00:00', 1, 0),
(17, 5, 'Income', 5, '2019-05-04 10:59:01', 'Amount Partially Paid By Voucher #: 6', 3000, '2019-05-04 10:59:01', '0000-00-00 00:00:00', 1, 0),
(18, 6, 'Income', 5, '2019-05-04 01:16:47', 'Student', 20000, '2019-05-04 13:17:06', '0000-00-00 00:00:00', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Accountant', '6', NULL),
('dexdevs', '1', NULL),
('dexdevs2', '4', NULL),
('Inquiry Head', '48', NULL),
('Principal', '7', NULL),
('Superadmin', '3', NULL),
('Vice Principal', '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Accountant', 1, 'can login', NULL, NULL, NULL, NULL),
('add-institute', 1, 'create institute Name', NULL, NULL, NULL, NULL),
('dexdevs', 1, 'Admin of the application', NULL, NULL, NULL, NULL),
('dexdevs2', 1, NULL, NULL, NULL, NULL, NULL),
('Inquiry Head', 1, 'Inquiry Head can manage activities of student inquiries only.', NULL, NULL, NULL, NULL),
('inquiry-nav', 1, 'can access this nav', NULL, NULL, NULL, NULL),
('login', 1, 'The user can login in the admin panel.', NULL, NULL, NULL, NULL),
('navigation ', 1, 'Navigation can be access authorized users only.', NULL, NULL, NULL, NULL),
('Principal', 1, 'Principal can manage whole activities in the application except account department', NULL, NULL, NULL, NULL),
('Superadmin', 1, 'Superadmin can manage whole activities in the application.', NULL, NULL, NULL, NULL),
('update-institute-name', 1, 'can update the institute name.', NULL, NULL, NULL, NULL),
('Vice Principal', 1, 'Can view whole reports.', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Accountant', 'login'),
('dexdevs', 'login'),
('dexdevs', 'navigation '),
('dexdevs2', 'login'),
('dexdevs2', 'navigation '),
('Inquiry Head', 'add-institute'),
('Inquiry Head', 'inquiry-nav'),
('Inquiry Head', 'login'),
('Principal', 'login'),
('Principal', 'navigation '),
('Superadmin', 'login'),
('Superadmin', 'navigation '),
('Vice Principal', 'login'),
('Vice Principal', 'navigation ');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `branch_code` varchar(32) NOT NULL,
  `branch_name` varchar(32) NOT NULL,
  `branch_type` enum('Franchise','Group') NOT NULL,
  `branch_location` varchar(50) NOT NULL,
  `branch_contact_no` varchar(32) NOT NULL,
  `branch_email` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `branch_head_name` varchar(50) NOT NULL,
  `branch_head_contact_no` varchar(15) NOT NULL,
  `branch_head_email` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `institute_id`, `branch_code`, `branch_name`, `branch_type`, `branch_location`, `branch_contact_no`, `branch_email`, `status`, `branch_head_name`, `branch_head_contact_no`, `branch_head_email`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(5, 2, 'RYK01', 'Main Branch', 'Group', 'Dawood Pull, Habib Colony ', '068-58-75860', 'abclearning@gmail.com', 'Active', 'Ma\'am Nasreen Akram', '+92-333-7668866', 'nasreenakram@gmail.com', '2019-03-16 07:01:14', '2019-03-16 07:01:14', 1, 1, 1),
(6, 2, 'RYK02', 'Sub Campus', 'Group', 'Business Man Colony', '068-58-87526', 'subcampus@gmail.com', 'Active', 'Ma\'am Nadia Gull', '+92-345-3456787', 'nadiagull@gmail.com', '2019-03-16 07:03:19', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `concession`
--

CREATE TABLE `concession` (
  `concession_id` int(11) NOT NULL,
  `concession_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concession`
--

INSERT INTO `concession` (`concession_id`, `concession_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, '100% Concession ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 1),
(2, '90% Concession ', '2019-01-10 08:16:15', '0000-00-00 00:00:00', 1, 1, 1),
(3, '80% Concession', '2019-01-10 08:16:39', '2019-01-10 08:16:39', 1, 1, 1),
(4, '70% Concession', '2019-01-10 08:16:54', '2019-01-10 08:16:54', 1, 1, 1),
(5, '60% Concession', '2019-01-10 08:17:28', '0000-00-00 00:00:00', 1, 0, 1),
(6, '50% Concession', '2019-01-10 08:17:47', '0000-00-00 00:00:00', 1, 0, 1),
(7, '40% Concession ', '2019-01-10 08:18:40', '2019-01-10 08:18:40', 1, 1, 1),
(8, '30% Concession', '2019-01-10 08:18:08', '0000-00-00 00:00:00', 1, 0, 1),
(9, '25% Concession', '2019-01-10 08:18:19', '0000-00-00 00:00:00', 1, 0, 1),
(10, 'Kinship', '2019-01-10 08:18:27', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `custom_sms`
--

CREATE TABLE `custom_sms` (
  `id` int(11) NOT NULL,
  `send_to` text NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_sms`
--

INSERT INTO `custom_sms` (`id`, `send_to`, `message`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '923063772105', '<p>Hello,</p><p>This is testing <b><i>SMS.</i></b></p>', '2019-03-08 15:24:28', '0000-00-00 00:00:00', 8, 0),
(2, '923063772106', '<p>\r\n\r\nTesting <b><i>SMS.</i></b>\r\n\r\n<br></p>', '2019-03-08 16:02:54', '0000-00-00 00:00:00', 8, 0),
(3, '923317375027', '<p>Testing SMS from web application.</p>', '2019-03-08 16:08:41', '0000-00-00 00:00:00', 8, 0),
(4, '923063772106', 'This is testing SMS from Brookfield.', '2019-03-08 16:14:43', '0000-00-00 00:00:00', 8, 0),
(5, '923063772105', 'Testing SMS.', '2019-03-08 16:23:59', '0000-00-00 00:00:00', 8, 0),
(6, '923063772106', 'Testing SMS.', '2019-03-08 16:26:31', '0000-00-00 00:00:00', 8, 0),
(8, '923063772106', 'Testing SMS.', '2019-03-08 16:36:02', '0000-00-00 00:00:00', 8, 0),
(9, '923041422508', 'This is testing SMS by DEXDEVS from Brookfield web application.', '2019-03-08 16:37:40', '0000-00-00 00:00:00', 8, 0),
(10, '923063772105', 'This is testing SMS by DEXDEVS from Brookfield web application.', '2019-03-08 16:39:10', '0000-00-00 00:00:00', 8, 0),
(11, '923356383287', 'This is testing SMS by DEXDEVS from Brookfield web application.', '2019-03-08 16:40:13', '0000-00-00 00:00:00', 8, 0),
(12, '923006773327', 'This is testing SMS by DEXDEVS from Brookfield web application.', '2019-03-08 16:41:07', '0000-00-00 00:00:00', 8, 0),
(13, '923006999824', 'This is testing SMS by DEXDEVS from Brookfield web application.\r\n\r\nTask completed by Nauman & Anas.', '2019-03-08 16:42:14', '0000-00-00 00:00:00', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_description` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Computer Science Department', 'Computer Science Department', '2019-02-19 05:42:48', '0000-00-00 00:00:00', 3, 0),
(2, 'Biology Department', 'Biology Department', '2019-02-19 05:43:07', '0000-00-00 00:00:00', 3, 0),
(3, 'Chemistry Department', 'Chemistry Department', '2019-02-19 05:43:25', '0000-00-00 00:00:00', 3, 0),
(4, 'Physics Department', 'Physics Department', '2019-02-19 05:43:44', '0000-00-00 00:00:00', 3, 0),
(5, 'Mathematics Department', 'Mathematics Department', '2019-02-19 05:44:16', '0000-00-00 00:00:00', 3, 0),
(6, 'Urdu Department', 'Urdu Department', '2019-02-19 05:44:42', '0000-00-00 00:00:00', 3, 0),
(7, 'English Department', 'English Department', '2019-02-19 05:45:05', '0000-00-00 00:00:00', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(2, 'Vice Principal', '2019-04-27 08:49:01', '2018-10-31 08:17:30', 1, 1, 1),
(3, 'Coordinator', '2018-10-31 08:23:02', '0000-00-00 00:00:00', 1, 0, 1),
(4, 'Teacher', '2018-10-31 08:23:21', '0000-00-00 00:00:00', 1, 0, 1),
(5, 'Security Gaurd', '2018-10-31 09:55:43', '2018-10-31 09:55:43', 1, 1, 1),
(6, 'Accountant', '2018-12-07 06:29:32', '0000-00-00 00:00:00', 1, 0, 1),
(7, 'Librarian', '2019-01-14 17:59:26', '0000-00-00 00:00:00', 0, 0, 1),
(8, 'Office Boy', '2019-02-20 13:33:12', '0000-00-00 00:00:00', 9, 0, 1),
(9, 'HOD', '2019-02-22 07:33:33', '2019-02-22 07:33:33', 9, 8, 1),
(10, 'Clerical Staff', '2019-05-02 09:30:04', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `emial_id` int(11) NOT NULL,
  `receiver_name` varchar(60) NOT NULL,
  `receiver_email` varchar(120) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_content` text NOT NULL,
  `email_attachment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`emial_id`, `receiver_name`, `receiver_email`, `email_subject`, `email_content`, `email_attachment`, `created_at`, `created_by`, `updated_at`, `updated_by`, `delete_status`) VALUES
(1, 'Anas', 'anasshafqat01@gmail.com', 'Welcome', 'This is testing email from yii2...!', 'attachments/1545482896.png', '2018-12-22 12:48:24', 0, '0000-00-00 00:00:00', 0, 1),
(3, 'Anas Shafqat', 'anasshafqat01@gmail.com', 'Wellcome to DEXDEVS', 'This is testing email from Yii2...!', 'attachments/1545483278.png', '2018-12-22 12:54:44', 1, '0000-00-00 00:00:00', 0, 1),
(4, 'Saif ur Rehman', 'saifarshad.6987@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email from Yii2...!', 'attachments/1545483348.png', '2018-12-22 12:55:52', 1, '0000-00-00 00:00:00', 0, 1),
(5, 'Nauman Shahid', 'hwhasmhi1625@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email from Yii2...!', 'attachments/1545483409.png', '2018-12-22 12:56:55', 1, '0000-00-00 00:00:00', 0, 1),
(6, 'Nauman Shahid', 'hwhashmi1625@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email with file attachment from Yii2...!', 'attachments/1545483610.png', '2018-12-22 13:00:16', 1, '0000-00-00 00:00:00', 0, 1),
(7, 'Nadia Gull', 'nadiagull285@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email with file attachment from Yii2...!', 'attachments/1545483685.png', '2018-12-22 13:01:39', 1, '0000-00-00 00:00:00', 0, 1),
(8, 'Kinza Fatima', 'kinza.fatima522@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email with file attachment from Yii2...!', 'attachments/1545483773.png', '2018-12-22 13:02:59', 1, '0000-00-00 00:00:00', 0, 1),
(9, 'Rana Faraz', 'ranafarazahmed@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email with file attachment from Yii2...!	', 'attachments/1545484174.png', '2018-12-22 13:09:38', 1, '0000-00-00 00:00:00', 0, 1),
(10, 'Anas Shafqat', 'anasshafqat01@gmail.com', 'Wellcome To DEXDEVS', 'This is testing email with file attachment from Yii2...!', 'attachments/1545484846.jpg', '2018-12-31 10:46:04', 1, '2018-12-31 10:46:04', 1, 0),
(11, 'anas', 'anasshafqat01@gmail.com', 'helli', 'mlklkk', 'attachments/1545761723.jpg', '2018-12-31 10:44:52', 1, '2018-12-31 10:44:52', 1, 0),
(12, 'Anas', 'anasshafqat01@gmail.com', 'Hello', 'heloo heloo heloo heloo', 'attachments/1545764108.jpg', '2018-12-31 11:11:53', 1, '2018-12-31 11:11:53', 1, 0),
(13, 'Anas', 'anasshafqat01@gmail.com', 'Hello', 'Testing Email....', 'attachments/1545804180.jpg', '2018-12-26 06:03:14', 1, '0000-00-00 00:00:00', 0, 1),
(14, 'khh', 'anasshafqat01@gmail.com', 'hello', 'jkhjkh', 'attachments/1545816221.sql', '2018-12-26 09:23:48', 1, '0000-00-00 00:00:00', 0, 1),
(15, 'Mehtab', 'chmehtab4@gmail.com', 'Hello', 'This is testing Email with file attachment from Yii2....', 'attachments/1546064434.png', '2018-12-29 06:21:12', 1, '0000-00-00 00:00:00', 0, 1),
(16, 'Anas Shafqat', 'anasshafqat01@gmail.com', 'Wellcome', 'Testing Email...', 'attachments/1546066690.png', '2018-12-29 06:58:16', 1, '0000-00-00 00:00:00', 0, 1),
(17, 'Anas Shafqat', 'anasshafqat01@gmail.com', 'Hello', '<h2>Hello Sir,</h2><p><b><i>This is testing email from yii2...</i></b><br></p><p><b><i><br></i></b></p><p><b></b>Regards<b></b></p><p><b><i>Anas Shafqat</i></b></p>', 'attachments/1546068232.mp4', '2018-12-29 07:26:27', 1, '0000-00-00 00:00:00', 0, 1),
(18, 'Rana Faraz', 'ranafarazahmed@gmail.com', 'Testing Email', '<h2><b>Hello Sir,</b></h2><p><b><i></i><i>This is testing Email from Yii2 with text formatting.</i><i></i></b><b></b></p><p><b><i><br></i></b></p><p><b>Note:</b></p><p><ol><li><i>jkhjhj</i></li><li><i>erwrwe</i></li><li><i>werwe</i></li><li><i>were</i></li><li><i>werwerwr</i></li></ol><p>Regards,<br></p><p><b><i>Anas Shafqat</i></b></p></p>', 'attachments/1546069705.jpg', '2018-12-29 07:48:30', 1, '0000-00-00 00:00:00', 0, 1),
(19, 'ans', 'anasshafqat01@gmail.com', 'hello', '<p><b><i>anasshafqat01@gmail.com</i></b><br></p>', 'attachments/1548138607.jpg', '2019-01-22 06:30:23', 9, '0000-00-00 00:00:00', 0, 1),
(20, 'Kinza Mustafah', 'kinza@gmail.com', 'Wellcome', 'Hello....', '', '2019-03-04 09:49:21', 0, '0000-00-00 00:00:00', 0, 1),
(21, 'Kinza Mustafah', 'kinza@gmail.com', 'Wellcome', 'Hello....', '', '2019-03-04 09:49:40', 0, '0000-00-00 00:00:00', 0, 1),
(22, 'Rana Faraz', 'ranafarazahmed@gmail.com', 'Testing', '<p>lkjhgfdsdfghjk</p>', 'attachments/1551947170.jpg', '2019-03-07 08:26:26', 3, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `att_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `att_date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `attendance` varchar(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_departments`
--

CREATE TABLE `emp_departments` (
  `emp_department_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_departments`
--

INSERT INTO `emp_departments` (`emp_department_id`, `emp_id`, `dept_id`) VALUES
(1, 4, 1),
(2, 1, 5),
(3, 5, 1),
(4, 8, 5),
(5, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `emp_designation`
--

CREATE TABLE `emp_designation` (
  `emp_designation_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `emp_type_id` int(11) NOT NULL,
  `group_by` enum('Faculty','Non-Faculty') NOT NULL,
  `emp_salary` double NOT NULL,
  `designation_status` enum('Registered','Promotion','Demotion') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_designation`
--

INSERT INTO `emp_designation` (`emp_designation_id`, `emp_id`, `designation_id`, `emp_type_id`, `group_by`, `emp_salary`, `designation_status`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 4, 4, 'Faculty', 20000, 'Registered', 'Active', '2019-05-04 10:21:32', '0000-00-00 00:00:00', 4, 0),
(2, 2, 3, 5, 'Faculty', 40000, 'Registered', 'Active', '2019-05-04 10:59:04', '2019-05-04 10:59:04', 4, 1),
(3, 3, 9, 4, 'Faculty', 30000, 'Registered', 'Inactive', '2019-05-04 11:04:55', '2019-05-04 11:04:55', 1, 1),
(4, 4, 4, 5, 'Faculty', 20000, 'Registered', 'Inactive', '2019-05-04 10:47:30', '2019-05-04 10:47:30', 1, 1),
(6, 3, 3, 5, 'Faculty', 25000, 'Demotion', 'Active', '2019-05-04 10:55:38', '0000-00-00 00:00:00', 1, 0),
(7, 3, 4, 4, 'Faculty', 2000, 'Demotion', 'Active', '2019-05-04 11:04:55', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_documents`
--

CREATE TABLE `emp_documents` (
  `emp_document_id` int(11) NOT NULL,
  `emp_info_id` int(11) NOT NULL,
  `emp_document_name` varchar(30) NOT NULL,
  `emp_document` varchar(120) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE `emp_info` (
  `emp_id` int(11) NOT NULL,
  `emp_branch_id` int(11) NOT NULL,
  `emp_reg_no` varchar(50) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_father_name` varchar(50) NOT NULL,
  `emp_cnic` varchar(15) NOT NULL,
  `emp_contact_no` varchar(15) NOT NULL,
  `emp_perm_address` varchar(200) NOT NULL,
  `emp_temp_address` varchar(200) NOT NULL,
  `emp_marital_status` enum('Single','Married') NOT NULL,
  `emp_fb_ID` varchar(30) NOT NULL,
  `emp_gender` enum('Male','Female') NOT NULL,
  `emp_photo` varchar(200) NOT NULL,
  `emp_dept_id` int(11) NOT NULL,
  `emp_salary_type` enum('Salaried','Per Lecture') NOT NULL,
  `emp_email` varchar(84) NOT NULL,
  `emp_qualification` varchar(50) NOT NULL,
  `emp_passing_year` int(11) NOT NULL,
  `emp_institute_name` varchar(50) NOT NULL,
  `degree_scan_copy` varchar(200) NOT NULL,
  `emp_cv` varchar(200) NOT NULL,
  `emp_status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`emp_id`, `emp_branch_id`, `emp_reg_no`, `emp_name`, `emp_father_name`, `emp_cnic`, `emp_contact_no`, `emp_perm_address`, `emp_temp_address`, `emp_marital_status`, `emp_fb_ID`, `emp_gender`, `emp_photo`, `emp_dept_id`, `emp_salary_type`, `emp_email`, `emp_qualification`, `emp_passing_year`, `emp_institute_name`, `degree_scan_copy`, `emp_cv`, `emp_status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 6, 'EMP-Y19-1', 'Nadia Gull', 'Iftkhar Ali', '31303-1234567-8', '+92-315-8410500', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Nadia Gull_emp_photo.jpg', 1, 'Salaried', 'nadiagull285@gmail.com', 'BSCS', 2019, 'Superior College', 'uploads/Nadia Gull_degree_scan_copy.jpg', 'uploads/Nadia Gull_emp_cv.jpg', 'Active', '2019-05-04 05:29:47', '0000-00-00 00:00:00', 4, 0, 1),
(2, 6, 'EMP-Y19-2', 'Anas Shafqat', 'M Shafqat', '31303-7654345-6', '+92-300-7976242', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Anas Shafqat_emp_photo.jpg', 2, 'Per Lecture', 'anas@gmail.com', 'BSCS', 2019, 'SperiorCollege', 'uploads/Anas Shafqat_degree_scan_copy.jpg', 'uploads/Anas Shafqat_emp_cv.jpg', 'Active', '2019-05-04 09:12:09', '0000-00-00 00:00:00', 4, 0, 1),
(3, 5, 'EMP-Y19-3', 'Kinza Mustafa', 'Ghulam Mustafa', '45102-0511722-2', '+92-300-7976242', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Kinza Mustafa_emp_photo.jpg', 1, 'Per Lecture', 'kinza.fatima.522@gmail.com', 'BSCS', 2017, 'IUB', 'uploads/Kinza Mustafa_degree_scan_copy.jpg', 'uploads/Kinza Mustafa_emp_cv.jpg', 'Active', '2019-05-04 05:41:41', '0000-00-00 00:00:00', 1, 0, 1),
(4, 5, 'EMP-Y19-4', 'Numan Hashmi', 'M.Shahid', '31303-0511722-2', '+92-315-8410500', 'RYK', 'RYK', 'Single', '', 'Male', 'uploads/Numan Hashmi_emp_photo.jpg', 1, 'Salaried', 'nauman@gmail.com', 'BSCS', 2018, 'Superior College', 'uploads/Numan Hashmi_degree_scan_copy.jpg', 'uploads/Numan Hashmi_emp_cv.jpg', 'Active', '2019-05-04 05:50:20', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE `emp_leave` (
  `app_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_type` enum('Casual Leave','Medical Leave','','') NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `applying_date` date NOT NULL,
  `no_of_days` int(5) NOT NULL,
  `leave_purpose` varchar(100) NOT NULL,
  `status` enum('Accepted','Rejected','Pending') NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`app_id`, `branch_id`, `emp_id`, `leave_type`, `starting_date`, `ending_date`, `applying_date`, `no_of_days`, `leave_purpose`, `status`, `remarks`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 3, 'Casual Leave', '2019-05-07', '2019-05-10', '2019-05-04', 4, 'Some reason', 'Pending', '', '2019-05-04 08:05:15', '0000-00-00 00:00:00', 94, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_reference`
--

CREATE TABLE `emp_reference` (
  `emp_ref_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `ref_name` varchar(50) NOT NULL,
  `ref_contact_no` varchar(15) NOT NULL,
  `ref_cnic` varchar(15) NOT NULL,
  `ref_designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_reference`
--

INSERT INTO `emp_reference` (`emp_ref_id`, `emp_id`, `ref_name`, `ref_contact_no`, `ref_cnic`, `ref_designation`) VALUES
(1, 3, 'Nadia', '+92-315-8410500', '31303-4567898-7', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `emp_type`
--

CREATE TABLE `emp_type` (
  `emp_type_id` int(11) NOT NULL,
  `emp_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_type`
--

INSERT INTO `emp_type` (`emp_type_id`, `emp_type`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 'Daily Wages', '2019-03-16 06:47:32', '0000-00-00 00:00:00', 1, 0, 1),
(2, 'Weekly Wages', '2019-03-16 06:47:44', '2019-03-16 06:47:44', 1, 1, 1),
(3, 'Contract Basis', '2019-01-14 18:24:23', '0000-00-00 00:00:00', 1, 0, 1),
(4, 'Permanent ', '2018-12-14 07:52:24', '0000-00-00 00:00:00', 1, 0, 1),
(5, 'Visiting', '2019-02-26 05:02:48', '2019-02-26 05:02:48', 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'Hello', 'Something in the description', '2019-01-27 17:14:06'),
(2, 'Another Event', 'Another Event Description', '2019-01-27 19:10:28'),
(3, 'Another Event 2', 'Another Event 2 Description', '2019-01-27 19:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(80) NOT NULL,
  `event_detail` text NOT NULL,
  `event_venue` varchar(100) NOT NULL,
  `event_start_datetime` datetime NOT NULL,
  `event_end_datetime` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `event_detail`, `event_venue`, `event_start_datetime`, `event_end_datetime`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_status`) VALUES
(1, 'Last Day', 'Last Day of Janvi', '', '2015-05-30 00:00:00', '2015-05-30 00:00:00', '2015-05-27 15:34:53', 1, '2015-05-27 15:40:30', 1, 'Inactive'),
(2, 'Janvi BDay', 'Happy Birthday Janvi ', '', '2015-07-05 00:00:00', '2015-07-05 00:00:00', '2015-05-27 15:35:38', 1, '2015-05-27 15:40:48', 1, 'Inactive'),
(3, 'Happy Bday', 'Happy Birthday KarmrajSir', '', '2015-07-25 00:00:00', '2015-07-25 00:00:00', '2019-04-20 13:14:50', 3, '0000-00-00 00:00:00', 0, 'Inactive'),
(4, 'Launching New Application', 'Launch of Edusec Yii2', '', '2015-06-02 09:30:00', '2015-06-02 10:00:00', '2015-05-27 15:37:00', 1, '2015-05-27 15:39:37', 1, ''),
(5, 'Meeting for staff ', 'All Staff Members-Meeting', '', '2015-06-09 00:00:00', '2015-06-09 00:00:00', '2015-05-27 15:37:42', 1, NULL, NULL, ''),
(7, 'Celebration Time', 'Celebration Time', '', '2015-06-25 00:00:00', '2015-06-25 00:00:00', '2015-05-27 15:39:12', 1, NULL, NULL, ''),
(8, 'Sports Week', 'Annual sports week of Brookfield Group of Colleges.', 'Shiekh Zaid Sports Complex', '2019-01-31 08:00:05', '2019-02-04 05:00:05', '2019-01-30 16:57:53', 9, '2019-01-30 17:00:43', 9, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `exams_category`
--

CREATE TABLE `exams_category` (
  `exam_category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_category`
--

INSERT INTO `exams_category` (`exam_category_id`, `category_name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Daily Test', 'Daily Class Tests', '2019-03-11 09:34:22', '0000-00-00 00:00:00', 0, 0),
(2, 'Weekly Tests', 'Weekly Class Tests', '2019-03-11 09:34:40', '0000-00-00 00:00:00', 0, 0),
(3, 'First Term', 'First Term Exams', '2019-03-11 09:35:27', '0000-00-00 00:00:00', 0, 0),
(4, 'Mid Term', 'Mid Term Exams', '2019-03-11 09:35:49', '0000-00-00 00:00:00', 0, 0),
(5, 'Final Term', 'Final Term Exams', '2019-03-11 09:36:04', '0000-00-00 00:00:00', 0, 0),
(6, 'December Test', 'December Test / Exams', '2019-03-11 09:36:44', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exams_criteria`
--

CREATE TABLE `exams_criteria` (
  `exam_criteria_id` int(11) NOT NULL,
  `exam_category_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_start_date` date NOT NULL,
  `exam_end_date` date NOT NULL,
  `exam_status` varchar(50) NOT NULL,
  `exam_type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_criteria`
--

INSERT INTO `exams_criteria` (`exam_criteria_id`, `exam_category_id`, `class_id`, `exam_start_date`, `exam_end_date`, `exam_status`, `exam_type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 1, '2019-05-30', '2019-06-08', 'Conducted', 'Regular', '2019-06-13 06:15:46', '2019-06-10 07:57:48', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exams_room`
--

CREATE TABLE `exams_room` (
  `exam_room_id` int(11) NOT NULL,
  `exam_schedule_id` int(11) NOT NULL,
  `class_head_id` int(11) NOT NULL,
  `exam_room` int(15) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `invigilator_attend` varchar(2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_room`
--

INSERT INTO `exams_room` (`exam_room_id`, `exam_schedule_id`, `class_head_id`, `exam_room`, `emp_id`, `invigilator_attend`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 'no', 1, 0, '2019-06-03 05:36:08', '0000-00-00 00:00:00'),
(2, 1, 3, 21, 3, 'no', 1, 1, '2019-06-03 05:36:00', '2019-06-01 01:59:05'),
(3, 1, 4, 7, 1, 'no', 1, 0, '2019-06-03 05:36:18', '0000-00-00 00:00:00'),
(4, 2, 2, 4, 3, '', 1, 0, '2019-06-13 11:17:41', '0000-00-00 00:00:00'),
(5, 2, 3, 7, 4, '', 1, 1, '2019-06-01 01:59:05', '2019-06-01 01:59:05'),
(6, 2, 4, 4, 2, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(7, 3, 2, 4, 3, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(8, 3, 3, 4, 4, '', 1, 1, '2019-06-01 01:59:05', '2019-06-01 01:59:05'),
(9, 3, 4, 6, 1, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(10, 4, 2, 5, 4, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(11, 4, 3, 11, 1, '', 1, 1, '2019-06-01 01:59:05', '2019-06-01 01:59:05'),
(12, 4, 4, 6, 1, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(13, 5, 2, 3, 3, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(14, 5, 3, 11, 1, '', 1, 1, '2019-06-01 01:59:05', '2019-06-01 01:59:05'),
(15, 5, 4, 2, 3, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(16, 6, 2, 4, 1, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00'),
(17, 6, 3, 22, 3, '', 1, 1, '2019-06-01 01:59:05', '2019-06-01 01:59:05'),
(18, 6, 4, 4, 3, '', 1, 0, '2019-05-30 02:45:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exams_schedule`
--

CREATE TABLE `exams_schedule` (
  `exam_schedule_id` int(11) NOT NULL,
  `exam_criteria_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `exam_start_time` time NOT NULL,
  `exam_end_time` time NOT NULL,
  `full_marks` int(5) NOT NULL,
  `passing_marks` int(5) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_schedule`
--

INSERT INTO `exams_schedule` (`exam_schedule_id`, `exam_criteria_id`, `subject_id`, `date`, `exam_start_time`, `exam_end_time`, `full_marks`, `passing_marks`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, '2019-05-30', '08:00:00', '11:00:00', 100, 33, 'not', '2019-06-13 16:09:57', '2019-06-10 07:57:48', 1, 1),
(2, 1, 2, '2019-05-31', '08:00:00', '11:00:00', 100, 33, 'not', '2019-06-10 07:57:48', '2019-06-10 07:57:48', 1, 1),
(3, 1, 4, '2019-06-01', '08:00:00', '11:00:00', 100, 33, 'not', '2019-06-10 07:57:48', '2019-06-10 07:57:48', 1, 1),
(4, 1, 8, '2019-06-03', '08:00:00', '11:00:00', 100, 33, 'not', '2019-06-14 04:24:36', '2019-06-10 07:57:48', 1, 1),
(5, 1, 7, '2019-06-04', '08:00:00', '11:00:00', 50, 18, 'not', '2019-06-14 04:25:05', '2019-06-10 07:57:48', 1, 1),
(6, 1, 10, '2019-06-08', '08:00:00', '11:00:00', 50, 18, 'result prepared', '2019-06-14 04:33:50', '2019-06-10 07:57:48', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_month_detail`
--

CREATE TABLE `fee_month_detail` (
  `month_detail_id` int(11) NOT NULL,
  `voucher_no` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `monthly_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_month_detail`
--

INSERT INTO `fee_month_detail` (`month_detail_id`, `voucher_no`, `month`, `monthly_amount`) VALUES
(1, 1001, '2019-03', 5000),
(2, 1002, '2019-03', 5000),
(3, 1003, '2019-03', 5000),
(4, 1004, '2019-03', 5000),
(5, 1005, '2019-04', 7000),
(6, 1006, '2019-04', 7000),
(7, 1007, '2019-04', 7000),
(8, 1008, '2019-04', 7000),
(9, 1009, '2019-05', 9000),
(10, 1010, '2019-05', 6000),
(11, 1011, '2019-05', 5000),
(12, 1012, '2019-05', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `fee_transaction_detail`
--

CREATE TABLE `fee_transaction_detail` (
  `fee_trans_detail_id` int(11) NOT NULL,
  `fee_trans_detail_head_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `fee_amount` double DEFAULT NULL,
  `collected_fee_amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_transaction_detail`
--

INSERT INTO `fee_transaction_detail` (`fee_trans_detail_id`, `fee_trans_detail_head_id`, `fee_type_id`, `fee_amount`, `collected_fee_amount`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1, 1, 3000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(2, 1, 2, 2000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(3, 2, 1, 3000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(4, 2, 2, 2000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(5, 3, 1, 3000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(6, 3, 2, 2000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(7, 4, 1, 3000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(8, 4, 2, 2000, 0, '2019-05-04 05:55:22', '0000-00-00 00:00:00', 0, 0, 1),
(9, 5, 2, 2000, 0, '2019-05-04 05:56:34', '0000-00-00 00:00:00', 0, 0, 1),
(10, 5, 8, 5000, 0, '2019-05-04 05:56:34', '0000-00-00 00:00:00', 0, 0, 1),
(11, 6, 2, 2000, 0, '2019-05-04 05:56:34', '0000-00-00 00:00:00', 0, 0, 1),
(12, 6, 8, 5000, 0, '2019-05-04 05:56:35', '0000-00-00 00:00:00', 0, 0, 1),
(13, 7, 2, 2000, 0, '2019-05-04 05:56:35', '0000-00-00 00:00:00', 0, 0, 1),
(14, 7, 8, 5000, 0, '2019-05-04 05:56:35', '0000-00-00 00:00:00', 0, 0, 1),
(15, 8, 2, 2000, 0, '2019-05-04 05:56:35', '0000-00-00 00:00:00', 0, 0, 1),
(16, 8, 8, 5000, 0, '2019-05-04 05:56:35', '0000-00-00 00:00:00', 0, 0, 1),
(17, 9, 2, 2000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1),
(18, 9, 8, 7000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1),
(19, 10, 2, 2000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1),
(20, 10, 8, 4000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1),
(21, 11, 2, 2000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1),
(22, 11, 8, 3000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1),
(23, 12, 2, 2000, 0, '2019-05-04 05:59:17', '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_transaction_head`
--

CREATE TABLE `fee_transaction_head` (
  `fee_trans_id` int(11) NOT NULL,
  `voucher_no` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `class_name_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `std_name` varchar(75) NOT NULL,
  `month` varchar(20) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL,
  `remaining` double NOT NULL,
  `collection_date` datetime NOT NULL,
  `status` enum('Paid','Unpaid','Partially Paid','Added to next month') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_transaction_head`
--

INSERT INTO `fee_transaction_head` (`fee_trans_id`, `voucher_no`, `branch_id`, `class_name_id`, `session_id`, `section_id`, `std_id`, `std_name`, `month`, `transaction_date`, `total_amount`, `paid_amount`, `remaining`, `collection_date`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1001, 5, 1, 4, 3, 1, 'Anas', '', '2019-05-04 10:55:22', 5000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-05-04 05:56:34', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1002, 5, 1, 4, 3, 2, 'Noman Shahid', '', '2019-05-04 10:55:22', 5000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-05-04 05:56:34', '0000-00-00 00:00:00', 1, 0, 1),
(3, 1003, 5, 1, 4, 3, 3, 'Nadia Gull', '', '2019-05-04 10:55:22', 5000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-05-04 05:56:35', '0000-00-00 00:00:00', 1, 0, 1),
(4, 1004, 5, 1, 4, 3, 4, 'Saif-ur-Rehman', '', '2019-05-04 10:55:22', 5000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-05-04 05:56:35', '0000-00-00 00:00:00', 1, 0, 1),
(5, 1005, 5, 1, 4, 3, 1, 'Anas', '', '2019-05-04 10:56:34', 7000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-05-04 05:59:16', '0000-00-00 00:00:00', 1, 0, 1),
(6, 1006, 5, 1, 4, 3, 2, 'Noman Shahid', '', '2019-05-04 10:56:34', 7000, 3000, 4000, '2019-05-04 10:59:01', 'Added to next month', '2019-05-04 05:59:16', '0000-00-00 00:00:00', 1, 0, 1),
(7, 1007, 5, 1, 4, 3, 3, 'Nadia Gull', '', '2019-05-04 10:56:35', 7000, 4000, 3000, '2019-05-04 10:57:36', 'Added to next month', '2019-05-04 05:59:16', '0000-00-00 00:00:00', 1, 0, 1),
(8, 1008, 5, 1, 4, 3, 4, 'Saif-ur-Rehman', '', '2019-05-04 10:56:35', 7000, 7000, 0, '2019-05-04 10:58:24', 'Paid', '2019-05-04 05:58:24', '0000-00-00 00:00:00', 1, 0, 1),
(9, 1009, 5, 1, 4, 3, 1, 'Anas', '', '2019-05-04 10:59:16', 9000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-05-04 05:59:16', '0000-00-00 00:00:00', 1, 0, 1),
(10, 1010, 5, 1, 4, 3, 2, 'Noman Shahid', '', '2019-05-04 10:59:17', 6000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-05-04 05:59:17', '0000-00-00 00:00:00', 1, 0, 1),
(11, 1011, 5, 1, 4, 3, 3, 'Nadia Gull', '', '2019-05-04 10:59:17', 5000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-05-04 05:59:17', '0000-00-00 00:00:00', 1, 0, 1),
(12, 1012, 5, 1, 4, 3, 4, 'Saif-ur-Rehman', '', '2019-05-04 10:59:17', 2000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-05-04 05:59:17', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_type`
--

CREATE TABLE `fee_type` (
  `fee_type_id` int(11) NOT NULL,
  `fee_type_name` varchar(64) NOT NULL,
  `fee_type_description` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_type`
--

INSERT INTO `fee_type` (`fee_type_id`, `fee_type_name`, `fee_type_description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 'Admission Fee', 'Student have to pay admission fee only one time', '2018-11-03 06:36:22', '0000-00-00 00:00:00', 1, 0, 1),
(2, 'Tuition Fee', 'Paid on monthly bases', '2018-11-03 06:48:34', '0000-00-00 00:00:00', 1, 0, 1),
(3, 'Absent Fine', 'Absent Fine', '2019-04-09 07:33:52', '2019-04-09 07:33:52', 1, 1, 1),
(4, 'Activity Dues', 'Activity Dues', '2019-04-09 07:33:09', '2019-04-09 07:33:09', 1, 1, 1),
(5, 'Stationary Dues', 'Stationary Dues', '2019-04-09 07:32:21', '2019-04-09 07:32:21', 1, 1, 1),
(6, 'Board/University Fee', 'Board/University Fee', '2019-04-09 07:31:49', '2019-04-09 07:31:49', 1, 1, 1),
(7, 'Exams Fee', 'Examination Fee', '2019-02-28 05:03:40', '0000-00-00 00:00:00', 3, 0, 1),
(8, 'Arrears', 'Previous Pending Dues', '2019-04-09 07:29:28', '2019-04-09 07:29:28', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(5) NOT NULL,
  `grade_from` int(5) NOT NULL,
  `grade_to` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade_name`, `grade_from`, `grade_to`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'A+', 80, 100, '2019-04-20 07:28:36', '0000-00-00 00:00:00', 1, 3),
(2, 'A', 70, 79, '2019-04-20 07:28:36', '2019-04-20 07:20:57', 1, 3),
(3, 'B', 60, 69, '2019-04-20 07:28:36', '0000-00-00 00:00:00', 1, 3),
(4, 'C', 50, 59, '2019-04-20 07:28:36', '0000-00-00 00:00:00', 1, 3),
(5, 'D', 40, 49, '2019-04-20 07:28:36', '0000-00-00 00:00:00', 1, 3),
(6, 'F', 33, 39, '2019-04-20 07:28:36', '0000-00-00 00:00:00', 1, 3),
(7, 'Fail', 1, 32, '2019-04-20 07:28:37', '2019-04-20 07:20:34', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `installment_id` int(11) NOT NULL,
  `installment_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`installment_id`, `installment_name`) VALUES
(1, '1st Installment'),
(2, '2nd Installment'),
(3, '3rd Installment'),
(4, '4th Installment'),
(5, '5th Installment'),
(6, '6th Installment');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `institute_id` int(11) NOT NULL,
  `institute_name` varchar(65) NOT NULL,
  `institute_logo` varchar(200) NOT NULL,
  `institute_account_no` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`institute_id`, `institute_name`, `institute_logo`, `institute_account_no`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(2, 'ABC Learning School', 'uploads/ABC Learning School_photo.jpg', 'xyz, RYK', '2019-05-02 18:09:01', '2019-05-02 18:09:01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `institute_name`
--

CREATE TABLE `institute_name` (
  `Institute_name_id` int(11) NOT NULL,
  `Institute_name` varchar(100) NOT NULL,
  `Institutte_address` varchar(120) NOT NULL,
  `Institute_contact_no` varchar(12) NOT NULL,
  `head_name` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute_name`
--

INSERT INTO `institute_name` (`Institute_name_id`, `Institute_name`, `Institutte_address`, `Institute_contact_no`, `head_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'NIMS School System', 'RYK', '923345678988', 'Sir Nadeem', 0, 0, '2019-03-12 06:07:06', '0000-00-00 00:00:00'),
(2, 'National Garission School System', 'RYK', '923456789023', 'fghjklkj', 0, 0, '2019-03-12 06:10:12', '0000-00-00 00:00:00'),
(3, 'Lahore School System', 'RYK', '923456348256', 'fghjklghj', 0, 0, '2019-03-12 06:11:07', '0000-00-00 00:00:00'),
(4, 'The New Horizons School', 'RYK', '923569872345', 'fghjhgfghj', 0, 0, '2019-03-12 06:11:59', '0000-00-00 00:00:00'),
(5, 'Rehnuma Public School', 'RYK', '923564337866', 'fghjkjnhgfvg', 0, 0, '2019-03-12 06:12:30', '0000-00-00 00:00:00'),
(6, 'ABC Learning School', 'RYK', '923786547856', 'dfghjkhg', 0, 0, '2019-03-12 06:13:19', '0000-00-00 00:00:00'),
(7, 'ESNA Public School', 'RYK', '923456789876', 'dfghjkljmhn', 0, 0, '2019-03-12 06:13:57', '0000-00-00 00:00:00'),
(8, 'Govt. Girls Model Girls High School', 'RYK', '923456789765', 'fdghjgfghj', 0, 0, '2019-03-12 06:15:20', '0000-00-00 00:00:00'),
(9, 'Allied School', 'RYK', '923345678987', 'fghjkgbhj', 0, 0, '2019-03-12 06:15:48', '0000-00-00 00:00:00'),
(10, 'The Spirit School', 'RYK', '923456789876', 'ghjkfghjk', 0, 0, '2019-03-12 06:16:12', '0000-00-00 00:00:00'),
(11, 'TCI School System', 'RYK', '923567898765', 'fghjkljhg', 0, 0, '2019-03-12 06:16:35', '0000-00-00 00:00:00'),
(12, 'Colony High School', 'RYK', '923456789098', 'fghjkj', 0, 0, '2019-03-12 06:17:11', '0000-00-00 00:00:00'),
(13, 'Pilot High School', 'RYK', '923456789098', 'frghjkjnhb', 0, 0, '2019-03-12 06:17:29', '0000-00-00 00:00:00'),
(14, 'Comprehensive School', 'RYK', '923678998765', 'dcfghjklkjh', 0, 0, '2019-03-12 06:18:02', '0000-00-00 00:00:00'),
(15, 'Govt Girls High School', 'RYK', '234567887656', 'abc', 0, 0, '2019-03-12 18:21:40', '0000-00-00 00:00:00'),
(16, 'National Garrison School', 'Satelite Town', '922345676767', 'Sir Zahid', 0, 0, '2019-03-12 18:37:52', '0000-00-00 00:00:00'),
(17, 'Docters Public School', 'Ryk', '123456789098', 'Sir', 0, 0, '2019-03-12 19:38:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `marks_details`
--

CREATE TABLE `marks_details` (
  `marks_detail_id` int(11) NOT NULL,
  `marks_head_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks_details_weightage`
--

CREATE TABLE `marks_details_weightage` (
  `marks_details_weightage_id` int(11) NOT NULL,
  `marks_details_id` int(11) NOT NULL,
  `weightage_type_id` int(11) NOT NULL,
  `obtained_marks` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks_head`
--

CREATE TABLE `marks_head` (
  `marks_head_id` int(11) NOT NULL,
  `exam_criteria_id` int(11) NOT NULL,
  `class_head_id` int(10) NOT NULL,
  `std_id` int(11) NOT NULL,
  `grand_total` double NOT NULL,
  `percentage` varchar(10) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `exam_status` varchar(6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks_weightage_details`
--

CREATE TABLE `marks_weightage_details` (
  `weightage_detail_id` int(11) NOT NULL,
  `weightage_head_id` int(11) NOT NULL,
  `weightage_type_id` int(11) NOT NULL,
  `marks` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_weightage_details`
--

INSERT INTO `marks_weightage_details` (`weightage_detail_id`, `weightage_head_id`, `weightage_type_id`, `marks`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 5, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(2, 1, 2, 5, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(3, 1, 3, 5, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(4, 1, 4, 5, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(5, 1, 5, 10, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(6, 1, 6, 70, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(7, 2, 1, 5, '2019-05-19 14:37:47', '0000-00-00 00:00:00', 1, 0),
(8, 2, 2, 5, '2019-05-19 14:37:47', '0000-00-00 00:00:00', 1, 0),
(9, 2, 5, 10, '2019-05-19 14:37:47', '0000-00-00 00:00:00', 1, 0),
(10, 2, 6, 80, '2019-05-19 14:37:47', '0000-00-00 00:00:00', 1, 0),
(11, 3, 1, 5, '2019-05-19 14:38:55', '0000-00-00 00:00:00', 1, 0),
(12, 3, 2, 5, '2019-05-19 14:38:55', '0000-00-00 00:00:00', 1, 0),
(13, 3, 6, 90, '2019-05-19 14:38:55', '0000-00-00 00:00:00', 1, 0),
(14, 4, 1, 5, '2019-05-19 14:40:51', '0000-00-00 00:00:00', 1, 0),
(15, 4, 2, 5, '2019-05-19 14:40:51', '0000-00-00 00:00:00', 1, 0),
(16, 4, 7, 20, '2019-05-19 14:40:51', '0000-00-00 00:00:00', 1, 0),
(17, 4, 6, 70, '2019-05-19 14:40:51', '0000-00-00 00:00:00', 1, 0),
(18, 5, 1, 5, '2019-05-19 14:42:02', '0000-00-00 00:00:00', 1, 0),
(19, 5, 2, 5, '2019-05-19 14:42:02', '0000-00-00 00:00:00', 1, 0),
(20, 5, 6, 40, '2019-05-19 14:42:02', '0000-00-00 00:00:00', 1, 0),
(21, 6, 1, 5, '2019-05-19 14:42:59', '0000-00-00 00:00:00', 1, 0),
(22, 6, 2, 5, '2019-05-19 14:42:59', '0000-00-00 00:00:00', 1, 0),
(23, 6, 6, 40, '2019-05-19 14:42:59', '0000-00-00 00:00:00', 1, 0),
(24, 7, 1, 5, '2019-05-22 19:06:46', '0000-00-00 00:00:00', 1, 0),
(25, 7, 4, 5, '2019-05-22 19:06:46', '0000-00-00 00:00:00', 1, 0),
(26, 7, 3, 5, '2019-05-22 19:06:46', '0000-00-00 00:00:00', 1, 0),
(27, 7, 2, 5, '2019-05-22 19:06:46', '0000-00-00 00:00:00', 1, 0),
(28, 7, 6, 80, '2019-05-22 19:06:46', '0000-00-00 00:00:00', 1, 0),
(29, 8, 1, 5, '2019-05-22 19:09:03', '0000-00-00 00:00:00', 1, 0),
(30, 8, 5, 5, '2019-05-22 19:09:03', '0000-00-00 00:00:00', 1, 0),
(31, 8, 3, 5, '2019-05-22 19:09:03', '0000-00-00 00:00:00', 1, 0),
(32, 8, 4, 5, '2019-05-22 19:09:03', '0000-00-00 00:00:00', 1, 0),
(33, 8, 6, 80, '2019-05-22 19:09:03', '0000-00-00 00:00:00', 1, 0),
(34, 9, 1, 5, '2019-05-22 19:09:54', '0000-00-00 00:00:00', 1, 0),
(35, 9, 2, 5, '2019-05-22 19:09:54', '0000-00-00 00:00:00', 1, 0),
(36, 9, 4, 5, '2019-05-22 19:09:54', '0000-00-00 00:00:00', 1, 0),
(37, 9, 5, 5, '2019-05-22 19:09:54', '0000-00-00 00:00:00', 1, 0),
(38, 9, 6, 80, '2019-05-22 19:09:54', '0000-00-00 00:00:00', 1, 0),
(39, 10, 6, 40, '2019-05-22 19:10:37', '0000-00-00 00:00:00', 1, 0),
(40, 10, 7, 20, '2019-05-22 19:10:37', '0000-00-00 00:00:00', 1, 0),
(41, 11, 1, 5, '2019-05-22 19:16:50', '0000-00-00 00:00:00', 1, 0),
(42, 11, 2, 5, '2019-05-22 19:16:50', '0000-00-00 00:00:00', 1, 0),
(43, 11, 6, 90, '2019-05-22 19:16:50', '0000-00-00 00:00:00', 1, 0),
(44, 12, 1, 5, '2019-05-22 19:18:38', '0000-00-00 00:00:00', 1, 0),
(45, 12, 2, 5, '2019-05-22 19:18:38', '0000-00-00 00:00:00', 1, 0),
(46, 12, 3, 5, '2019-05-22 19:18:38', '0000-00-00 00:00:00', 1, 0),
(47, 12, 5, 5, '2019-05-22 19:18:38', '0000-00-00 00:00:00', 1, 0),
(48, 12, 6, 80, '2019-05-22 19:18:38', '0000-00-00 00:00:00', 1, 0),
(49, 13, 1, 5, '2019-05-22 19:19:14', '0000-00-00 00:00:00', 1, 0),
(50, 13, 2, 5, '2019-05-22 19:19:14', '0000-00-00 00:00:00', 1, 0),
(51, 13, 6, 90, '2019-05-22 19:19:14', '0000-00-00 00:00:00', 1, 0),
(52, 14, 5, 5, '2019-05-22 19:19:50', '0000-00-00 00:00:00', 1, 0),
(53, 14, 3, 5, '2019-05-22 19:19:50', '0000-00-00 00:00:00', 1, 0),
(54, 14, 6, 40, '2019-05-22 19:19:50', '0000-00-00 00:00:00', 1, 0),
(55, 15, 7, 10, '2019-05-22 19:20:37', '0000-00-00 00:00:00', 1, 0),
(56, 15, 6, 40, '2019-05-22 19:20:37', '0000-00-00 00:00:00', 1, 0),
(57, 16, 1, 5, '2019-05-22 19:21:09', '0000-00-00 00:00:00', 1, 0),
(58, 16, 2, 5, '2019-05-22 19:21:09', '0000-00-00 00:00:00', 1, 0),
(59, 16, 3, 5, '2019-05-22 19:21:09', '0000-00-00 00:00:00', 1, 0),
(60, 16, 4, 5, '2019-05-22 19:21:09', '0000-00-00 00:00:00', 1, 0),
(61, 16, 6, 80, '2019-05-22 19:21:09', '0000-00-00 00:00:00', 1, 0),
(62, 17, 1, 5, '2019-05-22 19:21:31', '0000-00-00 00:00:00', 1, 0),
(63, 17, 2, 5, '2019-05-22 19:21:31', '0000-00-00 00:00:00', 1, 0),
(64, 17, 6, 90, '2019-05-22 19:21:31', '0000-00-00 00:00:00', 1, 0),
(65, 18, 5, 5, '2019-05-22 19:21:49', '0000-00-00 00:00:00', 1, 0),
(66, 18, 6, 45, '2019-05-22 19:21:49', '0000-00-00 00:00:00', 1, 0),
(67, 19, 1, 5, '2019-05-22 19:22:14', '0000-00-00 00:00:00', 1, 0),
(68, 19, 2, 5, '2019-05-22 19:22:14', '0000-00-00 00:00:00', 1, 0),
(69, 19, 6, 90, '2019-05-22 19:22:14', '0000-00-00 00:00:00', 1, 0),
(70, 20, 6, 75, '2019-05-22 19:22:34', '0000-00-00 00:00:00', 1, 0),
(71, 21, 5, 10, '2019-05-22 19:22:51', '0000-00-00 00:00:00', 1, 0),
(72, 21, 6, 40, '2019-05-22 19:22:51', '0000-00-00 00:00:00', 1, 0),
(73, 22, 1, 5, '2019-05-22 19:23:52', '0000-00-00 00:00:00', 1, 0),
(74, 22, 2, 5, '2019-05-22 19:23:52', '0000-00-00 00:00:00', 1, 0),
(75, 22, 3, 5, '2019-05-22 19:23:52', '0000-00-00 00:00:00', 1, 0),
(76, 22, 6, 85, '2019-05-22 19:23:52', '0000-00-00 00:00:00', 1, 0),
(77, 23, 1, 5, '2019-05-22 19:24:31', '0000-00-00 00:00:00', 1, 0),
(78, 23, 2, 5, '2019-05-22 19:24:31', '0000-00-00 00:00:00', 1, 0),
(79, 23, 6, 65, '2019-05-22 19:24:31', '0000-00-00 00:00:00', 1, 0),
(80, 24, 6, 50, '2019-05-22 19:24:43', '0000-00-00 00:00:00', 1, 0),
(81, 25, 7, 20, '2019-05-22 19:25:05', '0000-00-00 00:00:00', 1, 0),
(82, 25, 6, 80, '2019-05-22 19:25:05', '0000-00-00 00:00:00', 1, 0),
(83, 26, 1, 5, '2019-05-22 19:25:37', '0000-00-00 00:00:00', 1, 0),
(84, 26, 2, 5, '2019-05-22 19:25:37', '0000-00-00 00:00:00', 1, 0),
(85, 26, 3, 5, '2019-05-22 19:25:37', '0000-00-00 00:00:00', 1, 0),
(86, 26, 6, 85, '2019-05-22 19:25:37', '0000-00-00 00:00:00', 1, 0),
(87, 27, 7, 10, '2019-05-22 19:25:57', '0000-00-00 00:00:00', 1, 0),
(88, 27, 6, 40, '2019-05-22 19:25:57', '0000-00-00 00:00:00', 1, 0),
(89, 28, 2, 20, '2019-05-22 19:26:24', '0000-00-00 00:00:00', 1, 0),
(90, 28, 6, 80, '2019-05-22 19:26:24', '0000-00-00 00:00:00', 1, 0),
(91, 29, 7, 30, '2019-05-22 19:27:14', '0000-00-00 00:00:00', 1, 0),
(92, 29, 6, 70, '2019-05-22 19:27:14', '0000-00-00 00:00:00', 1, 0),
(93, 30, 6, 50, '2019-05-22 19:27:27', '0000-00-00 00:00:00', 1, 0),
(94, 31, 3, 10, '2019-05-22 19:27:58', '0000-00-00 00:00:00', 1, 0),
(95, 31, 2, 10, '2019-05-22 19:27:58', '0000-00-00 00:00:00', 1, 0),
(96, 31, 6, 80, '2019-05-22 19:27:58', '0000-00-00 00:00:00', 1, 0),
(97, 32, 6, 80, '2019-05-22 19:28:18', '0000-00-00 00:00:00', 1, 0),
(98, 33, 6, 50, '2019-05-22 19:28:31', '0000-00-00 00:00:00', 1, 0),
(99, 34, 2, 10, '2019-05-22 19:29:09', '0000-00-00 00:00:00', 1, 0),
(100, 34, 3, 10, '2019-05-22 19:29:09', '0000-00-00 00:00:00', 1, 0),
(101, 34, 6, 80, '2019-05-22 19:29:09', '0000-00-00 00:00:00', 1, 0),
(102, 35, 6, 50, '2019-05-22 19:29:24', '0000-00-00 00:00:00', 1, 0),
(103, 36, 3, 20, '2019-05-22 19:29:53', '0000-00-00 00:00:00', 1, 0),
(104, 36, 6, 80, '2019-05-22 19:29:53', '0000-00-00 00:00:00', 1, 0),
(105, 37, 6, 50, '2019-05-22 19:30:06', '0000-00-00 00:00:00', 1, 0),
(106, 38, 6, 50, '2019-05-22 19:30:29', '0000-00-00 00:00:00', 1, 0),
(107, 39, 2, 5, '2019-05-22 19:30:57', '0000-00-00 00:00:00', 1, 0),
(108, 39, 6, 70, '2019-05-22 19:30:57', '0000-00-00 00:00:00', 1, 0),
(109, 40, 6, 50, '2019-05-22 19:31:08', '0000-00-00 00:00:00', 1, 0),
(110, 41, 6, 75, '2019-05-22 19:32:05', '0000-00-00 00:00:00', 1, 0),
(111, 42, 6, 75, '2019-05-22 19:32:18', '0000-00-00 00:00:00', 1, 0),
(112, 43, 7, 25, '2019-05-22 19:33:11', '0000-00-00 00:00:00', 1, 0),
(113, 43, 6, 75, '2019-05-22 19:33:11', '0000-00-00 00:00:00', 1, 0),
(114, 44, 6, 80, '2019-05-22 19:33:25', '0000-00-00 00:00:00', 1, 0),
(115, 45, 6, 50, '2019-05-22 19:33:40', '0000-00-00 00:00:00', 1, 0),
(116, 46, 6, 100, '2019-05-22 19:33:57', '0000-00-00 00:00:00', 1, 0),
(117, 47, 6, 50, '2019-05-22 19:34:09', '0000-00-00 00:00:00', 1, 0),
(118, 48, 6, 50, '2019-05-22 19:34:21', '0000-00-00 00:00:00', 1, 0),
(119, 49, 7, 25, '2019-05-22 19:35:16', '0000-00-00 00:00:00', 1, 0),
(120, 49, 6, 75, '2019-05-22 19:35:16', '0000-00-00 00:00:00', 1, 0),
(121, 50, 7, 25, '2019-05-22 19:35:35', '0000-00-00 00:00:00', 1, 0),
(122, 50, 6, 75, '2019-05-22 19:35:35', '0000-00-00 00:00:00', 1, 0),
(123, 51, 7, 25, '2019-05-22 19:35:51', '0000-00-00 00:00:00', 1, 0),
(124, 51, 6, 75, '2019-05-22 19:35:51', '0000-00-00 00:00:00', 1, 0),
(125, 52, 6, 80, '2019-05-22 19:36:06', '0000-00-00 00:00:00', 1, 0),
(126, 53, 6, 50, '2019-05-22 19:36:21', '0000-00-00 00:00:00', 1, 0),
(127, 54, 6, 100, '2019-05-22 19:36:36', '0000-00-00 00:00:00', 1, 0),
(128, 55, 6, 50, '2019-05-22 19:36:57', '0000-00-00 00:00:00', 1, 0),
(129, 56, 6, 50, '2019-05-22 19:37:10', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `marks_weightage_head`
--

CREATE TABLE `marks_weightage_head` (
  `marks_weightage_id` int(11) NOT NULL,
  `exam_category_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subjects_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_weightage_head`
--

INSERT INTO `marks_weightage_head` (`marks_weightage_id`, `exam_category_id`, `class_id`, `subjects_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 1, 1, '2019-05-19 14:34:23', '0000-00-00 00:00:00', 1, 0),
(2, 5, 1, 2, '2019-05-19 14:37:47', '0000-00-00 00:00:00', 1, 0),
(3, 5, 1, 4, '2019-05-19 14:38:55', '0000-00-00 00:00:00', 1, 0),
(4, 5, 1, 8, '2019-05-19 14:40:51', '0000-00-00 00:00:00', 1, 0),
(5, 5, 1, 7, '2019-05-19 14:42:02', '0000-00-00 00:00:00', 1, 0),
(6, 5, 1, 10, '2019-05-19 14:42:59', '0000-00-00 00:00:00', 1, 0),
(7, 5, 2, 1, '2019-06-11 07:40:55', '0000-00-00 00:00:00', 1, 0),
(8, 5, 2, 2, '2019-05-22 19:09:03', '0000-00-00 00:00:00', 1, 0),
(9, 5, 2, 4, '2019-05-22 19:09:54', '0000-00-00 00:00:00', 1, 0),
(10, 5, 2, 10, '2019-05-22 19:10:37', '0000-00-00 00:00:00', 1, 0),
(11, 5, 3, 1, '2019-05-22 19:16:50', '0000-00-00 00:00:00', 1, 0),
(12, 5, 3, 2, '2019-05-22 19:18:38', '0000-00-00 00:00:00', 1, 0),
(13, 5, 3, 4, '2019-05-22 19:19:14', '0000-00-00 00:00:00', 1, 0),
(14, 5, 3, 9, '2019-05-22 19:19:50', '0000-00-00 00:00:00', 1, 0),
(15, 5, 3, 8, '2019-05-22 19:20:37', '0000-00-00 00:00:00', 1, 0),
(16, 5, 4, 1, '2019-05-22 19:21:09', '0000-00-00 00:00:00', 1, 0),
(17, 5, 4, 2, '2019-05-22 19:21:31', '0000-00-00 00:00:00', 1, 0),
(18, 5, 4, 9, '2019-05-22 19:21:49', '0000-00-00 00:00:00', 1, 0),
(19, 5, 5, 1, '2019-05-22 19:22:14', '0000-00-00 00:00:00', 1, 0),
(20, 5, 5, 4, '2019-05-22 19:22:34', '0000-00-00 00:00:00', 1, 0),
(21, 5, 5, 9, '2019-05-22 19:22:51', '0000-00-00 00:00:00', 1, 0),
(22, 5, 6, 2, '2019-05-22 19:23:52', '0000-00-00 00:00:00', 1, 0),
(23, 5, 6, 4, '2019-05-22 19:24:31', '0000-00-00 00:00:00', 1, 0),
(24, 5, 6, 9, '2019-05-22 19:24:43', '0000-00-00 00:00:00', 1, 0),
(25, 5, 7, 1, '2019-05-22 19:25:05', '0000-00-00 00:00:00', 1, 0),
(26, 5, 7, 2, '2019-05-22 19:25:37', '0000-00-00 00:00:00', 1, 0),
(27, 5, 7, 8, '2019-05-22 19:25:57', '0000-00-00 00:00:00', 1, 0),
(28, 5, 8, 1, '2019-05-22 19:26:24', '0000-00-00 00:00:00', 1, 0),
(29, 5, 8, 6, '2019-05-22 19:27:14', '0000-00-00 00:00:00', 1, 0),
(30, 5, 8, 9, '2019-05-22 19:27:27', '0000-00-00 00:00:00', 1, 0),
(31, 5, 9, 1, '2019-05-22 19:27:58', '0000-00-00 00:00:00', 1, 0),
(32, 5, 9, 2, '2019-05-22 19:28:18', '0000-00-00 00:00:00', 1, 0),
(33, 5, 9, 3, '2019-05-22 19:28:31', '0000-00-00 00:00:00', 1, 0),
(34, 5, 11, 1, '2019-05-22 19:29:09', '0000-00-00 00:00:00', 1, 0),
(35, 5, 11, 5, '2019-05-22 19:29:24', '0000-00-00 00:00:00', 1, 0),
(36, 5, 11, 4, '2019-05-22 19:29:53', '0000-00-00 00:00:00', 1, 0),
(37, 5, 11, 9, '2019-05-22 19:30:06', '0000-00-00 00:00:00', 1, 0),
(38, 5, 12, 7, '2019-05-22 19:30:29', '0000-00-00 00:00:00', 1, 0),
(39, 5, 12, 4, '2019-05-22 19:30:57', '0000-00-00 00:00:00', 1, 0),
(40, 5, 12, 9, '2019-05-22 19:31:08', '0000-00-00 00:00:00', 1, 0),
(41, 5, 13, 11, '2019-05-22 19:32:05', '0000-00-00 00:00:00', 1, 0),
(42, 5, 13, 13, '2019-05-22 19:32:18', '0000-00-00 00:00:00', 1, 0),
(43, 5, 13, 12, '2019-05-22 19:33:11', '0000-00-00 00:00:00', 1, 0),
(44, 5, 13, 2, '2019-05-22 19:33:25', '0000-00-00 00:00:00', 1, 0),
(45, 5, 13, 3, '2019-05-22 19:33:40', '0000-00-00 00:00:00', 1, 0),
(46, 5, 13, 4, '2019-05-22 19:33:57', '0000-00-00 00:00:00', 1, 0),
(47, 5, 13, 5, '2019-05-22 19:34:09', '0000-00-00 00:00:00', 1, 0),
(48, 5, 13, 9, '2019-05-22 19:34:21', '0000-00-00 00:00:00', 1, 0),
(49, 5, 14, 11, '2019-05-22 19:35:16', '0000-00-00 00:00:00', 1, 0),
(50, 5, 14, 13, '2019-05-22 19:35:35', '0000-00-00 00:00:00', 1, 0),
(51, 5, 14, 12, '2019-05-22 19:35:51', '0000-00-00 00:00:00', 1, 0),
(52, 5, 14, 2, '2019-05-22 19:36:06', '0000-00-00 00:00:00', 1, 0),
(53, 5, 14, 3, '2019-05-22 19:36:21', '0000-00-00 00:00:00', 1, 0),
(54, 5, 14, 4, '2019-05-22 19:36:36', '0000-00-00 00:00:00', 1, 0),
(55, 5, 14, 5, '2019-05-22 19:36:57', '0000-00-00 00:00:00', 1, 0),
(56, 5, 14, 7, '2019-05-22 19:37:10', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `marks_weightage_type`
--

CREATE TABLE `marks_weightage_type` (
  `weightage_type_id` int(11) NOT NULL,
  `weightage_type_name` varchar(30) NOT NULL,
  `weightage_type_description` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_weightage_type`
--

INSERT INTO `marks_weightage_type` (`weightage_type_id`, `weightage_type_name`, `weightage_type_description`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Attendance', '', '2019-04-22 06:55:40', '0000-00-00 00:00:00', 3, 0),
(2, 'Assignment', '', '2019-04-22 06:55:55', '0000-00-00 00:00:00', 3, 0),
(3, 'Presentation', '', '2019-04-22 06:56:08', '0000-00-00 00:00:00', 3, 0),
(4, 'Dressing', '', '2019-04-22 06:56:16', '0000-00-00 00:00:00', 3, 0),
(5, 'Behaviour', '', '2019-04-22 06:56:27', '0000-00-00 00:00:00', 3, 0),
(6, 'Theory', '', '2019-04-22 06:56:37', '0000-00-00 00:00:00', 3, 0),
(7, 'Practical', '', '2019-04-22 06:57:06', '0000-00-00 00:00:00', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1538846625),
('m130524_201442_init', 1538846629);

-- --------------------------------------------------------

--
-- Table structure for table `msg_of_day`
--

CREATE TABLE `msg_of_day` (
  `msg_of_day_id` int(11) NOT NULL,
  `msg_details` varchar(100) NOT NULL,
  `msg_user_type` enum('Students','Parents','Employees','Others') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_status` enum('Active','Inactive') NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `msg_of_day`
--

INSERT INTO `msg_of_day` (`msg_of_day_id`, `msg_details`, `msg_user_type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_status`, `delete_status`) VALUES
(1, 'Each Day is a GIFT don\'t send it BACK unopened.  Have a nice Day !', 'Students', '2015-05-27 15:21:01', 1, NULL, NULL, 'Active', 1),
(2, 'Every day may not be GOOD but there is something GOOD in every day.', 'Parents', '2015-05-27 15:21:22', 1, NULL, NULL, 'Active', 1),
(3, 'Every ONE wants happiness, No ONE needs pain, But its not possible to get a rainbow.', 'Employees', '2015-05-27 15:21:41', 1, NULL, NULL, 'Active', 1),
(4, 'Smile is the Electricity and Life is a Battery whenever you Smile the Battery gets Charges.', 'Students', '2015-05-27 15:21:59', 1, '2018-12-26 18:11:26', 1, 'Active', 1),
(5, 'The Best for the Group comes when everyone in the group does what’s best for himself AND the group.', 'Students', '2015-05-27 15:22:20', 1, NULL, NULL, 'Active', 1),
(6, 'In life, as in football, you won\'t go far unless you know where the goalposts are.-- Arnold Glasow', 'Students', '2015-05-27 15:24:54', 1, '2018-12-26 18:11:18', 1, 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(25) NOT NULL,
  `notice_description` text,
  `notice_start` datetime NOT NULL,
  `notice_end` datetime NOT NULL,
  `notice_user_type` enum('Students','Parents','Employees','Others') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_title`, `notice_description`, `notice_start`, `notice_end`, `notice_user_type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_status`) VALUES
(1, 'Final Term Exams ', 'Final Term Exams will be conducted on coming monday. All The Best !', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Students', '2015-05-27 15:26:29', 1, '2019-01-26 11:59:21', 9, 'Active'),
(2, 'Monthly Report', 'All Employee have to submit their report on month end.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Employees', '2015-05-27 15:27:23', 1, '2018-12-26 18:43:37', 1, 'Inactive'),
(3, 'Summer Vacation', 'Summer Vacation starts from June to  2nd week of July.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Students', '2015-05-27 15:28:37', 1, '2018-12-26 18:44:16', 1, 'Inactive'),
(4, 'Attendance Report', 'All Employees collect their class wise  attendance report', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Employees', '2015-05-27 15:30:35', 1, '2018-12-26 18:44:19', 1, 'Inactive'),
(5, 'Exam From Fill', 'All Students come and fill their exam forms', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Students', '2015-05-27 15:33:07', 1, '2018-12-26 18:44:03', 1, 'Active'),
(6, 'Roll No Slip', 'Collect your roll no slips from the exams department.', '2019-01-30 04:10:44', '1900-12-02 03:00:00', 'Students', '2019-01-30 15:04:08', 9, '2019-01-30 16:12:50', 9, 'Active'),
(7, 'Meeting', 'Meeting at 5:00 Pm for final exams conduction.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Employees', '2019-01-30 15:11:30', 9, '0000-00-00 00:00:00', 0, 'Inactive'),
(9, 'PTM', 'Parent teacher meeting on 01-Feb-2019 at 5:00 Pm.<br><b>Venue: Brookfield Group of Colleges</b>.', '2019-01-30 04:01:59', '2019-02-01 05:00:53', 'Parents', '2019-01-30 16:02:23', 9, '2019-01-30 16:36:13', 9, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `remarks_head`
--

CREATE TABLE `remarks_head` (
  `remarks_head_id` int(11) NOT NULL,
  `remarks_head_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Room-1', '2019-05-25 19:47:51', '0000-00-00 00:00:00', 0, 0),
(2, 'Room-2', '2019-05-25 19:49:27', '0000-00-00 00:00:00', 0, 0),
(3, 'Room-3', '2019-05-25 19:49:56', '0000-00-00 00:00:00', 1, 0),
(4, 'Room-4', '2019-05-25 19:50:04', '0000-00-00 00:00:00', 1, 0),
(5, 'Room-5', '2019-05-25 19:50:20', '0000-00-00 00:00:00', 0, 0),
(6, 'Room-6', '2019-05-25 19:50:34', '0000-00-00 00:00:00', 1, 0),
(7, 'Room-7', '2019-05-25 19:50:41', '0000-00-00 00:00:00', 1, 0),
(8, 'Room-8', '2019-05-25 19:50:48', '0000-00-00 00:00:00', 1, 0),
(9, 'Room-9', '2019-05-25 19:50:56', '0000-00-00 00:00:00', 1, 0),
(10, 'Room-10', '2019-05-25 19:51:00', '0000-00-00 00:00:00', 1, 0),
(11, 'Room-11', '2019-05-25 19:51:05', '0000-00-00 00:00:00', 1, 0),
(12, 'Room-12', '2019-05-25 19:51:10', '0000-00-00 00:00:00', 1, 0),
(13, 'Room-13', '2019-05-25 19:51:13', '0000-00-00 00:00:00', 1, 0),
(14, 'Room-14', '2019-05-25 19:51:19', '0000-00-00 00:00:00', 1, 0),
(15, 'Room-15', '2019-05-25 19:51:22', '0000-00-00 00:00:00', 1, 0),
(16, 'Room-16', '2019-05-25 19:51:26', '0000-00-00 00:00:00', 1, 0),
(17, 'Room-17', '2019-05-25 19:51:32', '0000-00-00 00:00:00', 1, 0),
(18, 'Room-18', '2019-05-25 19:51:38', '0000-00-00 00:00:00', 1, 0),
(19, 'Room-19', '2019-05-25 19:51:55', '0000-00-00 00:00:00', 1, 0),
(20, 'Room-20', '2019-05-25 19:51:59', '0000-00-00 00:00:00', 1, 0),
(21, 'Computer Lab-1', '2019-05-25 19:52:17', '0000-00-00 00:00:00', 1, 0),
(22, 'Computer Lab-2', '2019-05-25 19:52:25', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `sms_id` int(11) NOT NULL,
  `sms_name` varchar(120) NOT NULL,
  `sms_template` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`sms_id`, `sms_name`, `sms_template`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 'Absent Message', 'Absent Message', '2019-03-07 08:20:16', '0000-00-00 00:00:00', 3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_academic_info`
--

CREATE TABLE `std_academic_info` (
  `academic_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `class_name_id` int(11) NOT NULL,
  `subject_combination` int(11) NOT NULL,
  `previous_class` varchar(50) NOT NULL,
  `passing_year` int(32) DEFAULT NULL,
  `previous_class_rollno` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `obtained_marks` int(11) DEFAULT NULL,
  `grades` varchar(10) NOT NULL,
  `percentage` varchar(5) DEFAULT NULL,
  `Institute` varchar(50) NOT NULL,
  `std_enroll_status` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_academic_info`
--

INSERT INTO `std_academic_info` (`academic_id`, `std_id`, `class_name_id`, `subject_combination`, `previous_class`, `passing_year`, `previous_class_rollno`, `total_marks`, `obtained_marks`, `grades`, `percentage`, `Institute`, `std_enroll_status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1, 1, 5, '10th', 2018, 12345, 505, 408, 'A', '81%', 'Colony High School', 'signed', '2019-05-04 05:53:56', '0000-00-00 00:00:00', 1, 0, 1),
(2, 2, 1, 5, '', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'signed', '2019-05-04 05:53:56', '0000-00-00 00:00:00', 1, 0, 1),
(3, 3, 1, 5, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'signed', '2019-05-04 05:53:56', '0000-00-00 00:00:00', 1, 0, 1),
(4, 4, 1, 5, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'signed', '2019-05-04 05:53:56', '0000-00-00 00:00:00', 1, 0, 1),
(5, 5, 11, 14, '6th', 2018, 12345, 505, 408, 'A', '81%', 'National Garrison ', 'unsign', '2019-05-04 05:19:34', '0000-00-00 00:00:00', 4, 0, 1),
(6, 6, 11, 14, '6th', 2019, 265641, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-05-04 05:21:35', '0000-00-00 00:00:00', 4, 0, 1),
(7, 7, 11, 14, '6th', 2019, 265641, 505, 408, 'A', '81%', 'Colony High School', 'unsign', '2019-05-04 05:23:35', '0000-00-00 00:00:00', 4, 0, 1),
(8, 8, 11, 14, '6th', 2018, 12345, 505, 408, 'A', '81%', 'Colony High School', 'unsign', '2019-05-04 05:25:31', '0000-00-00 00:00:00', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_attendance`
--

CREATE TABLE `std_attendance` (
  `std_attend_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_name_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_attendance`
--

INSERT INTO `std_attendance` (`std_attend_id`, `branch_id`, `teacher_id`, `class_name_id`, `session_id`, `section_id`, `subject_id`, `date`, `student_id`, `status`) VALUES
(1, 5, 3, 1, 4, 3, 1, '2019-05-04 00:00:00', 1, 'P'),
(2, 5, 3, 1, 4, 3, 1, '2019-05-04 00:00:00', 2, 'P'),
(3, 5, 3, 1, 4, 3, 1, '2019-05-04 00:00:00', 3, 'P'),
(4, 5, 3, 1, 4, 3, 1, '2019-05-04 00:00:00', 4, 'P'),
(5, 5, 3, 1, 4, 3, 2, '2019-05-04 00:00:00', 1, 'P'),
(6, 5, 3, 1, 4, 3, 2, '2019-05-04 00:00:00', 2, 'P'),
(7, 5, 3, 1, 4, 3, 2, '2019-05-04 00:00:00', 3, 'P'),
(8, 5, 3, 1, 4, 3, 2, '2019-05-04 00:00:00', 4, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `std_class_name`
--

CREATE TABLE `std_class_name` (
  `class_name_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `class_name` varchar(120) NOT NULL,
  `class_name_description` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_class_name`
--

INSERT INTO `std_class_name` (`class_name_id`, `branch_id`, `class_name`, `class_name_description`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 5, 'KG-1', 'KG-1', 'Active', '2019-03-16 01:27:49', '2019-03-16 01:27:49', 1, 1, 1),
(2, 5, 'Nursery', 'Nursery', 'Active', '2019-03-16 01:28:12', '2019-03-16 01:28:12', 1, 1, 1),
(3, 5, 'Prep', 'Prep', 'Active', '2019-03-16 01:28:25', '2019-03-16 01:28:25', 1, 1, 1),
(4, 5, 'One', 'One', 'Active', '2019-03-16 01:28:33', '2019-03-16 01:28:33', 1, 1, 1),
(5, 5, 'Two', 'Two', 'Active', '2019-03-16 01:28:45', '2019-03-16 01:28:45', 1, 1, 1),
(6, 5, 'Three', 'Three', 'Active', '2019-03-16 01:28:56', '2019-03-16 01:28:56', 1, 1, 1),
(7, 5, 'Four', 'Four', 'Active', '2019-03-16 01:29:09', '2019-03-16 01:29:09', 1, 1, 1),
(8, 5, '5th', '5th', 'Active', '2019-03-18 05:31:59', '2019-03-16 01:29:26', 1, 1, 1),
(9, 6, '6th', '6th', 'Active', '2019-03-18 05:30:32', '2019-03-16 01:29:36', 1, 1, 1),
(11, 6, '7th', '7th', 'Active', '2019-03-18 05:45:19', '2019-03-18 05:45:19', 1, 1, 1),
(12, 6, '8th ', '8th ', 'Active', '2019-03-18 05:45:28', '2019-03-18 05:45:28', 3, 1, 1),
(13, 6, '9th', '9th', 'Active', '2019-03-18 05:45:36', '2019-03-18 05:45:36', 3, 1, 1),
(14, 6, '10th', '10th', 'Inactive', '2019-04-20 08:12:28', '2019-04-20 08:12:28', 1, 3, 1),
(16, 5, 'Play Group', 'Play Group', 'Active', '2019-03-20 05:02:23', '0000-00-00 00:00:00', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_enrollment_detail`
--

CREATE TABLE `std_enrollment_detail` (
  `std_enroll_detail_id` int(11) NOT NULL,
  `std_enroll_detail_head_id` int(11) NOT NULL,
  `std_reg_no` varchar(15) NOT NULL,
  `std_roll_no` varchar(32) NOT NULL,
  `std_enroll_detail_std_id` int(11) NOT NULL,
  `std_enroll_detail_std_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_enrollment_detail`
--

INSERT INTO `std_enrollment_detail` (`std_enroll_detail_id`, `std_enroll_detail_head_id`, `std_reg_no`, `std_roll_no`, `std_enroll_detail_std_id`, `std_enroll_detail_std_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1, 'STD-Y19-31', 'Pre-Gr19-1', 31, 'Aisha Ameen', '2019-05-08 00:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1, 'STD-Y19-48', 'Pre-Gr19-2', 48, 'Zahid Saeed', '2019-05-08 00:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(3, 2, 'STD-Y19-2', 'KG--Re19-1', 5, 'Aniqa Gull', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(4, 2, 'STD-Y19-6', 'KG--Re19-2', 8, 'Sadia Gull', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(5, 2, 'STD-Y19-9', 'KG--Re19-3', 11, 'Fatima Bibi ', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(6, 2, 'STD-Y19-12', 'KG--Re19-4', 12, 'Ihsan-ul-Haq', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(7, 2, 'STD-Y19-13', 'KG--Re19-5', 14, 'Testing 1', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(8, 2, 'STD-Y19-15', 'KG--Re19-6', 18, 'Asra', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(9, 3, 'STD-Y19-23', 'KG--Bl19-1', 26, 'zahid saeed', '2019-05-22 23:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(10, 3, 'STD-Y19-27', 'KG--Bl19-2', 27, 'Nadia Gull', '2019-05-22 23:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(11, 3, 'STD-Y19-28', 'KG--Bl19-3', 30, 'Asmat Ara', '2019-05-22 23:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(12, 3, 'STD-Y19-31', 'KG--Bl19-4', 31, 'Aisha Ameen', '2019-05-22 23:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(13, 3, 'STD-Y19-32', 'KG--Bl19-5', 33, 'Saif-ur-Rehman', '2019-05-22 23:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(14, 4, 'STD-Y19-41', 'KG--Gr19-1', 42, 'Wqas', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(15, 4, 'STD-Y19-51', 'KG--Gr19-2', 52, 'Zahid Saeed', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(16, 4, 'STD-Y19-53', 'KG--Gr19-3', 53, 'M. Azaan', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(17, 4, 'STD-Y19-56', 'KG--Gr19-4', 59, 'Ali', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(18, 4, 'STD-Y19-60', 'KG--Gr19-5', 60, 'Anas Shafqat', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(19, 4, 'STD-Y19-61', 'KG--Gr19-6', 61, 'esha', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(20, 4, 'STD-Y19-62', 'KG--Gr19-7', 62, 'Ali', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(21, 4, 'STD-Y19-64', 'KG--Gr19-8', 64, 'Sana', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_enrollment_head`
--

CREATE TABLE `std_enrollment_head` (
  `std_enroll_head_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `class_name_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `std_enroll_head_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_enrollment_head`
--

INSERT INTO `std_enrollment_head` (`std_enroll_head_id`, `branch_id`, `class_name_id`, `session_id`, `section_id`, `std_enroll_head_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 5, 3, 4, 3, 'Prep-2019 - 2020 -Green', '2019-05-08 00:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(2, 5, 1, 4, 1, 'KG-1-2019 - 2020 -Red', '2019-05-22 23:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(3, 5, 1, 4, 2, 'KG-1-2019 - 2020 -Blue', '2019-05-22 23:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(4, 5, 1, 4, 3, 'KG-1-2019 - 2020 -Green', '2019-05-22 23:11:15', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_fee_details`
--

CREATE TABLE `std_fee_details` (
  `fee_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `admission_fee` double NOT NULL,
  `addmission_fee_discount` int(11) NOT NULL,
  `net_addmission_fee` double NOT NULL,
  `concession_id` int(11) NOT NULL,
  `tuition_fee` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_fee_details`
--

INSERT INTO `std_fee_details` (`fee_id`, `std_id`, `admission_fee`, `addmission_fee_discount`, `net_addmission_fee`, `concession_id`, `tuition_fee`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1, 3000, 0, 3000, 0, 2000, '2019-05-04 04:46:17', '0000-00-00 00:00:00', 1, 0, 1),
(2, 2, 3000, 0, 3000, 0, 2000, '2019-05-04 04:56:42', '0000-00-00 00:00:00', 1, 0, 1),
(3, 3, 3000, 0, 3000, 0, 2000, '2019-05-04 05:04:29', '0000-00-00 00:00:00', 1, 0, 1),
(4, 4, 3000, 0, 3000, 0, 2000, '2019-05-04 05:07:38', '0000-00-00 00:00:00', 1, 0, 1),
(5, 5, 5000, 0, 5000, 0, 3000, '2019-05-04 05:19:34', '0000-00-00 00:00:00', 4, 0, 1),
(6, 6, 5000, 0, 5000, 0, 3000, '2019-05-04 05:21:35', '0000-00-00 00:00:00', 4, 0, 1),
(7, 7, 5000, 0, 5000, 0, 3000, '2019-05-04 05:23:35', '0000-00-00 00:00:00', 4, 0, 1),
(8, 8, 5000, 0, 5000, 0, 3000, '2019-05-04 05:25:31', '0000-00-00 00:00:00', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_fee_installments`
--

CREATE TABLE `std_fee_installments` (
  `fee_installment_id` int(11) NOT NULL,
  `std_fee_id` int(11) NOT NULL,
  `installment_no` int(11) NOT NULL,
  `installment_amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `std_fee_pkg`
--

CREATE TABLE `std_fee_pkg` (
  `std_fee_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `admission_fee` double NOT NULL,
  `tutuion_fee` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_fee_pkg`
--

INSERT INTO `std_fee_pkg` (`std_fee_id`, `session_id`, `class_id`, `admission_fee`, `tutuion_fee`, `created_at`, `created_by`, `updated_at`, `updated_by`, `delete_status`) VALUES
(1, 4, 1, 3000, 2000, '2019-03-20 05:36:41', 1, '0000-00-00 00:00:00', 0, 1),
(2, 4, 16, 3000, 2000, '2019-04-20 08:05:04', 1, '2019-04-20 08:05:04', 3, 1),
(3, 4, 2, 3000, 2000, '2019-03-20 05:37:44', 1, '0000-00-00 00:00:00', 0, 1),
(4, 4, 3, 3000, 2000, '2019-03-20 05:38:02', 1, '0000-00-00 00:00:00', 0, 1),
(5, 4, 4, 4000, 3000, '2019-03-20 05:38:18', 1, '0000-00-00 00:00:00', 0, 1),
(6, 4, 5, 4000, 3000, '2019-03-20 05:38:52', 1, '0000-00-00 00:00:00', 0, 1),
(7, 4, 6, 4000, 3000, '2019-03-20 05:39:19', 1, '0000-00-00 00:00:00', 0, 1),
(8, 4, 7, 4000, 3000, '2019-03-20 05:40:57', 1, '2019-03-20 05:40:57', 1, 1),
(9, 4, 8, 4000, 3000, '2019-03-20 05:40:37', 1, '0000-00-00 00:00:00', 0, 1),
(10, 6, 9, 5000, 3000, '2019-03-20 05:42:20', 4, '0000-00-00 00:00:00', 0, 1),
(11, 6, 11, 5000, 3000, '2019-03-20 05:42:37', 4, '0000-00-00 00:00:00', 0, 1),
(12, 6, 12, 5000, 3000, '2019-03-20 05:42:54', 4, '0000-00-00 00:00:00', 0, 1),
(13, 6, 13, 5000, 4000, '2019-03-20 05:43:14', 4, '0000-00-00 00:00:00', 0, 1),
(14, 6, 14, 5000, 4000, '2019-03-20 05:43:32', 4, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_guardian_info`
--

CREATE TABLE `std_guardian_info` (
  `std_guardian_info_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `guardian_relation` varchar(50) NOT NULL,
  `guardian_cnic` varchar(15) NOT NULL,
  `guardian_email` varchar(84) NOT NULL,
  `guardian_contact_no_1` varchar(15) NOT NULL,
  `guardian_contact_no_2` varchar(15) NOT NULL,
  `guardian_monthly_income` int(11) DEFAULT NULL,
  `guardian_occupation` varchar(50) NOT NULL,
  `guardian_designation` varchar(100) NOT NULL,
  `guardian_password` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_guardian_info`
--

INSERT INTO `std_guardian_info` (`std_guardian_info_id`, `std_id`, `guardian_name`, `guardian_relation`, `guardian_cnic`, `guardian_email`, `guardian_contact_no_1`, `guardian_contact_no_2`, `guardian_monthly_income`, `guardian_occupation`, `guardian_designation`, `guardian_password`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1, 'M Shafqat', 'Father', '31303-4598637-0', 'shafqat@gmail.com', '+92-300-7976242', '+92-333-5498658', 45000, 'Govt. Employe', 'employee', '4439', '2019-05-04 04:46:16', '0000-00-00 00:00:00', 1, 0, 1),
(2, 2, 'M Shahid', 'Father', '31303-9876543-2', 'shahid@gmail.com', '+92-315-8410500', '+92-333-4567890', 20000, 'Govt. Employe', 'Engineer', '5464', '2019-05-04 04:56:41', '0000-00-00 00:00:00', 1, 0, 1),
(3, 3, 'Iftikhar Ali', 'Father', '31303-2345678-9', '', '+92-300-7976242', '+92-333-2345678', NULL, '', '', '1336', '2019-05-04 05:04:28', '0000-00-00 00:00:00', 1, 0, 1),
(4, 4, 'M. Ahmed', 'Father', '45102-9876543-2', 'ahmed@gmail.com', '+92-300-7976242', '+92-333-8765432', 45000, 'Govt. Employe', 'Engineer', '7038', '2019-05-04 05:07:37', '0000-00-00 00:00:00', 1, 0, 1),
(5, 5, 'G Mustafa', 'Father', '31303-9473976-5', '', '+92-315-8410500', '+92-334-4456788', NULL, '', '', '7653', '2019-05-04 05:19:33', '0000-00-00 00:00:00', 4, 0, 1),
(6, 6, 'Iftikhar Ali', 'Father', '31303-9876543-4', '', '+92-300-7976242', '', NULL, '', '', '9056', '2019-05-04 05:21:34', '0000-00-00 00:00:00', 4, 0, 1),
(7, 7, 'G Mustafa', 'Father', '45102-8765432-3', '', '+92-300-7976242', '', NULL, '', '', '7719', '2019-05-04 05:23:34', '0000-00-00 00:00:00', 4, 0, 1),
(8, 8, 'Iftikhar Ali', 'Father', '31323-9876543-8', '', '+92-315-8410500', '', NULL, '', '', '1395', '2019-05-04 05:25:30', '0000-00-00 00:00:00', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_ice_info`
--

CREATE TABLE `std_ice_info` (
  `std_ice_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `std_ice_name` varchar(64) NOT NULL,
  `std_ice_relation` varchar(64) NOT NULL,
  `std_ice_contact_no` varchar(15) NOT NULL,
  `std_ice_address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_ice_info`
--

INSERT INTO `std_ice_info` (`std_ice_id`, `std_id`, `std_ice_name`, `std_ice_relation`, `std_ice_contact_no`, `std_ice_address`, `created_at`, `created_by`, `updated_at`, `updated_by`, `delete_status`) VALUES
(1, 1, 'Asad Shafqat', 'Brother', '+92-334-8765432', 'Gulshan Iqbal', '2019-05-04 04:46:17', 1, '0000-00-00 00:00:00', 0, 1),
(2, 2, 'Anas', 'Friend', '+92-334-5678998', 'Gulshan Iqbal', '2019-05-04 04:56:42', 1, '0000-00-00 00:00:00', 0, 1),
(3, 3, 'Aniqa Gull', 'Sister', '', '', '2019-05-04 05:04:29', 1, '0000-00-00 00:00:00', 0, 1),
(4, 4, 'Anas', 'Dost ', '+92-335-4567898', 'Jaddah Town RYK', '2019-05-04 05:07:38', 1, '0000-00-00 00:00:00', 0, 1),
(5, 5, 'Kinza', 'Sister', '', '', '2019-05-04 05:19:34', 4, '0000-00-00 00:00:00', 0, 1),
(6, 6, 'Nadia Gull', 'Sister', '', '', '2019-05-04 05:21:35', 4, '0000-00-00 00:00:00', 0, 1),
(7, 7, 'Aniqa Gull', 'Sister', '', '', '2019-05-04 05:23:35', 4, '0000-00-00 00:00:00', 0, 1),
(8, 8, 'Nadia Gull', 'Sister', '+92-345-6789009', '', '2019-05-04 05:25:31', 4, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_inquiry`
--

CREATE TABLE `std_inquiry` (
  `std_inquiry_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `std_inquiry_no` varchar(15) NOT NULL,
  `inquiry_session` varchar(20) NOT NULL,
  `std_name` varchar(32) NOT NULL,
  `std_father_name` varchar(32) NOT NULL,
  `gender` enum('Female','Male') NOT NULL,
  `std_contact_no` varchar(15) NOT NULL,
  `std_father_contact_no` varchar(15) NOT NULL,
  `std_inquiry_date` date NOT NULL,
  `std_intrested_class` varchar(50) NOT NULL,
  `std_previous_class` varchar(32) NOT NULL,
  `previous_institute` varchar(120) NOT NULL,
  `std_roll_no` varchar(10) NOT NULL,
  `std_obtained_marks` int(4) NOT NULL,
  `std_total_marks` int(4) NOT NULL,
  `std_percentage` varchar(6) NOT NULL,
  `refrence_name` varchar(32) NOT NULL,
  `refrence_contact_no` varchar(15) NOT NULL,
  `refrence_designation` varchar(30) NOT NULL,
  `std_address` varchar(200) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `inquiry_status` enum('Inquiry','Registered') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_inquiry`
--

INSERT INTO `std_inquiry` (`std_inquiry_id`, `branch_id`, `std_inquiry_no`, `inquiry_session`, `std_name`, `std_father_name`, `gender`, `std_contact_no`, `std_father_contact_no`, `std_inquiry_date`, `std_intrested_class`, `std_previous_class`, `previous_institute`, `std_roll_no`, `std_obtained_marks`, `std_total_marks`, `std_percentage`, `refrence_name`, `refrence_contact_no`, `refrence_designation`, `std_address`, `comment`, `inquiry_status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 'STD-Y19-01', '2019 - 2021', 'nauman', 'shahid', 'Male', '+92-333-7486345', '+92-300-6738133', '2019-02-13', 'Nursery', 'Nursery', 'ESNA Public School', '025', 900, 1100, '82%', 'Anas', '+90-331-7375765', 'MD DEXDEVS', 'RYK', '', 'Inquiry', '2019-04-20 05:04:32', '2019-04-20 05:04:32', 9, 3),
(2, 5, 'STD-Y19-02', '2019 - 2021', 'Farhan', 'Shahid', 'Male', '+92-331-5993454', '+92-331-5848948', '2019-03-06', 'ICS (Part - I)', 'Matric', 'ESNA Public School', '12345', 850, 1100, '77%', 'Nauman', '+92-333-7486765', 'MD', 'Satelite Town, Rahim Yar Khan', '', 'Inquiry', '2019-03-12 12:45:51', '2019-03-12 12:44:27', 3, 3),
(3, 5, 'STD-Y19-03', '2019 - 2021', 'Kinza', 'Mustafa', 'Female', '+92-345-6789234', '+92-456-7890987', '2019-03-07', 'FSC Pre-Medical (Part - I)', 'metric', 'The New Horizons School', '12365', 800, 1100, '73%', 'Nadia', '+92-987-6543765', 'hgh', 'lkjhgfdfghj', '', 'Inquiry', '2019-03-12 12:45:57', '2019-03-12 12:37:11', 3, 3),
(4, 5, 'STD-Y19-04', '2019 - 2021', 'Saif-ur-Rehman', 'M. Khalil', 'Male', '+92-308-3152045', '+92-302-3836145', '2019-03-12', 'ICS (Part - I)', 'Matric', 'Lahore School System', '265641', 743, 1050, '71%', 'Anas Shafqat', '+92-331-7375027', 'MD DEXDEVS', 'Chak # 145/p, Adaam Sahaba', '', 'Inquiry', '2019-03-12 12:46:05', '2019-03-12 12:38:57', 3, 3),
(5, 6, 'STD-Y19-05', '2019 - 2021', 'Nadia gull', 'Iftikhar ali', 'Female', '+92-315-8410500', '+92-303-8635458', '2019-03-12', 'FSC Pre-Engineering (Part - II)', 'Matric', 'Lahore School System', '1278', 780, 1050, '74%', 'Asmat Ara ', '+92-987-6545678', 'Ammi', 'kjhgfd', '', 'Inquiry', '2019-03-12 12:46:50', '2019-03-12 12:46:50', 3, 3),
(6, 6, 'STD-Y19-06', '2019 - 2021', 'Shahzad ', 'Saeed', 'Male', '+92-300-1234567', '+92-310-1234567', '2019-03-12', 'ICS (Part - I)', 'Metric', 'The New Horizons School', '263214', 743, 1050, '71%', 'Saif Ur Rehman', '+92-308-3152045', 'student', 'Chack No 51 p ', '', 'Inquiry', '2019-03-12 12:46:22', '2019-03-12 12:37:38', 3, 3),
(7, 6, 'STD-Y19-07', '2019 - 2021', 'Sadia ', 'Iftikhar ali', 'Female', '+92-987-6545678', '+92-234-5678987', '2019-03-13', 'FSC Pre-Medical (Part - I)', '10th', 'Lahore School System', '8765498765', 897, 1050, '85%', 'Aniqa', '+87-654-3456787', ',jnhbgvfd', 'lkjhgfd', 'lkjhgfdsdfghjklkjhbgv', 'Inquiry', '2019-03-13 05:32:47', '0000-00-00 00:00:00', 21, 0),
(8, 6, 'STD-Y19-08', '2019 - 2020', 'tfgyhuj', 'ihuhuihiu', 'Female', '+92-654-9848949', '+92-216-5189181', '2019-03-18', '8th ', '7th', 'Lahore School System', '123', 450, 500, '90%', 'iuytrfd', '+92-315-6894986', 'jnjn', 'bubj', 'omoimoim', 'Inquiry', '2019-03-18 09:17:53', '2019-03-18 09:11:18', 4, 4),
(9, 6, 'STD-Y19-09', '2019 - 2020', 'tygbbuhbHU', 'UHIUJIU', 'Male', '+92-316-5165197', '+92-333-3333333', '2019-03-18', 'Four', 'Three', 'Lahore School System', '123', 450, 500, '90%', 'HUK', '+92-361-6198619', 'DRTYFUGH IU', 'NJNOL', 'EDTRFYGUYH', 'Inquiry', '2019-03-18 09:20:32', '0000-00-00 00:00:00', 4, 0),
(10, 6, 'STD-Y19-010', '2019 - 2020', 'Aniqa', 'Gull', 'Female', '+92-654-3456789', '+92-876-5434567', '2019-03-18', 'Four', 'Three', 'Rehnuma Public School', '678', 450, 500, '90%', 'Ali', '+92-345-6789876', 'kjhgfds', 'nhbgfdsa', 'jhgfdsdvbnytrrftgyujikl\r\njhgfdsxcvbhjkoiuytrer6', 'Inquiry', '2019-03-18 12:44:25', '0000-00-00 00:00:00', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_personal_info`
--

CREATE TABLE `std_personal_info` (
  `std_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `std_reg_no` varchar(50) NOT NULL,
  `std_name` varchar(50) NOT NULL,
  `std_father_name` varchar(50) NOT NULL,
  `std_contact_no` varchar(15) NOT NULL,
  `std_DOB` date NOT NULL,
  `std_gender` enum('Male','Female') NOT NULL,
  `std_permanent_address` varchar(255) NOT NULL,
  `std_temporary_address` varchar(255) NOT NULL,
  `std_email` varchar(84) NOT NULL,
  `std_photo` varchar(200) NOT NULL,
  `std_b_form` varchar(255) NOT NULL,
  `std_district` varchar(50) NOT NULL,
  `std_religion` varchar(50) NOT NULL,
  `std_nationality` varchar(50) NOT NULL,
  `std_tehseel` varchar(50) NOT NULL,
  `std_password` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `academic_status` enum('Active','Promote','Left','Struck off') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_personal_info`
--

INSERT INTO `std_personal_info` (`std_id`, `branch_id`, `std_reg_no`, `std_name`, `std_father_name`, `std_contact_no`, `std_DOB`, `std_gender`, `std_permanent_address`, `std_temporary_address`, `std_email`, `std_photo`, `std_b_form`, `std_district`, `std_religion`, `std_nationality`, `std_tehseel`, `std_password`, `status`, `academic_status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 5, 'STD-Y19-1', 'Anas', 'Shafqat', '+92-333-2345433', '2007-05-14', 'Male', 'RYK', 'Jinnah  Park RYK', 'anas@gmail.com', 'uploads/Anas_photo.jpg', '31303-8976567-8', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '1643', 'Active', 'Active', '2019-05-04 04:46:15', '0000-00-00 00:00:00', 1, 0, 1),
(2, 5, 'STD-Y19-2', 'Noman Shahid', 'M Shahid', '+92-333-5678987', '2000-09-18', 'Male', 'RYK', 'RYK', 'nauman@gmail.com', 'uploads/Noman Shahid_photo.jpg', '31303-8765445-6', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '5517', 'Active', 'Active', '2019-05-04 04:59:46', '2019-05-04 04:59:46', 1, 1, 1),
(3, 5, 'STD-Y19-3', 'Nadia Gull', 'Iftikhar Ali', '+92-333-3456788', '2000-02-01', 'Female', 'RYK', 'RYK', 'nadia@gmail.com', 'uploads/Nadia Gull_photo.jpg', '31303-8765434-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '7239', 'Active', 'Active', '2019-05-04 05:04:27', '0000-00-00 00:00:00', 1, 0, 1),
(4, 5, 'STD-Y19-4', 'Saif-ur-Rehman', 'M. Ahmed', '+92-333-3456789', '2000-01-14', 'Male', 'RYK', 'RYK', 'saif@gmail.com', 'uploads/Saif-ur-Rehman_photo.jpg', '31303-9876545-6', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '7689', 'Active', 'Active', '2019-05-04 05:07:36', '0000-00-00 00:00:00', 1, 0, 1),
(5, 6, 'STD-Y19-5', 'Asra', 'Mustafa', '+92-398-7654456', '2019-05-04', 'Female', 'RYK', 'RYK', 'asra@gmail.com', 'uploads/Asra_photo.jpg', '31303-5793467-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '6762', 'Active', 'Active', '2019-05-04 05:19:32', '0000-00-00 00:00:00', 4, 0, 1),
(6, 6, 'STD-Y19-6', 'Sadia Gull', 'Iftikhar Ali', '+31-304-2632478', '2019-05-04', 'Female', 'RYK', 'RYK', '', 'uploads/Sadia Gull_photo.jpg', '31303-3456789-8', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '3776', 'Active', 'Active', '2019-05-04 05:21:33', '0000-00-00 00:00:00', 4, 0, 1),
(7, 6, 'STD-Y19-7', 'Zarwa Mustafa', 'G Mustafa', '+92-334-5678909', '2019-05-04', 'Female', 'RYK', 'RYK', 'zarwa@gmail.com', 'uploads/Zarwa Mustafa_photo.jpg', '31303-8765456-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'RYK', '3518', 'Active', 'Active', '2019-05-04 05:23:33', '0000-00-00 00:00:00', 4, 0, 1),
(8, 6, 'STD-Y19-8', 'Aniqa Gull', 'Iftikhar Ali', '+92-334-5678998', '2019-05-04', 'Female', 'RYK', 'RYK', 'asra@gmail.com', 'uploads/Aniqa Gull_photo.jpg', '45102-8765435-6', 'RYK', 'Islam', 'Pakistani', 'Rahim Yar Khan', '6848', 'Active', 'Active', '2019-05-04 05:25:29', '0000-00-00 00:00:00', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_remarks`
--

CREATE TABLE `std_remarks` (
  `std_remarks_id` int(11) NOT NULL,
  `remarks_head_id` int(11) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `std_sections`
--

CREATE TABLE `std_sections` (
  `section_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `section_description` varchar(100) NOT NULL,
  `section_intake` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_sections`
--

INSERT INTO `std_sections` (`section_id`, `branch_id`, `session_id`, `section_name`, `section_description`, `section_intake`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 5, 4, 'Red', 'Red', 25, '2019-04-26 17:22:05', '2019-03-16 07:10:30', 3, 1, 1),
(2, 5, 4, 'Blue', 'Blue', 25, '2019-04-26 17:22:11', '2019-03-16 07:10:47', 3, 1, 1),
(3, 5, 4, 'Green', 'Green', 20, '2019-04-26 19:10:10', '2019-04-26 19:10:10', 3, 1, 1),
(4, 5, 4, 'Pink', 'Pink', 30, '2019-04-26 19:09:34', '2019-04-26 19:09:34', 3, 1, 1),
(5, 6, 6, 'Green', 'Green ', 30, '2019-04-26 18:57:35', '2019-04-26 18:57:35', 3, 4, 1),
(11, 6, 6, 'Red', 'Red', 25, '2019-04-26 19:04:22', '0000-00-00 00:00:00', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_sessions`
--

CREATE TABLE `std_sessions` (
  `session_id` int(11) NOT NULL,
  `session_branch_id` int(11) NOT NULL,
  `session_name` varchar(32) NOT NULL,
  `session_start_date` date NOT NULL,
  `session_end_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `installment_cycle` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_sessions`
--

INSERT INTO `std_sessions` (`session_id`, `session_branch_id`, `session_name`, `session_start_date`, `session_end_date`, `status`, `installment_cycle`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(4, 5, '2019 - 2020 ', '2019-03-01', '2020-03-31', 'Active', 4, '2019-03-16 07:04:49', '2019-03-16 07:04:49', 1, 1, 1),
(6, 6, '2019 - 2020', '2019-03-01', '2020-03-31', 'Active', 0, '2019-03-16 07:05:16', '0000-00-00 00:00:00', 1, 0, 1),
(7, 5, '2020 - 2021', '2019-03-19', '2019-03-19', 'Inactive', 0, '2019-04-26 17:15:40', '2019-04-26 17:15:40', 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_subjects`
--

CREATE TABLE `std_subjects` (
  `std_subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `std_subject_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_subjects`
--

INSERT INTO `std_subjects` (`std_subject_id`, `class_id`, `std_subject_name`) VALUES
(1, 13, 'Biology,Chemistry,Physics,English A,English B,Urdu A,Urdu B,Islamiat'),
(2, 14, 'Biology,Chemistry,Physics,English A,English B,Urdu A,Urdu B,Pak-Studies'),
(3, 13, 'Computer,Chemistry,Physics,English A,English B,Urdu A,Urdu B,Islamiat'),
(4, 14, 'Computer,Chemistry,Physics,English A,English B,Urdu A,Urdu B,Pak-Studies'),
(5, 1, 'Math,English A,Urdu A,Computer,Pak-Studies,Drawing'),
(6, 2, 'Math,English A,Urdu A,Islamiat'),
(7, 3, 'Math,English A,Urdu A,Islamiat'),
(8, 4, 'Math,English A,Urdu A,Islamiat'),
(9, 5, 'Math,English A,Urdu A,Islamiat'),
(10, 6, 'Math,English A,Urdu A,Islamiat'),
(11, 7, 'Math,English A,Urdu A,Islamiat'),
(12, 8, 'Math,English A,Urdu A,Islamiat'),
(13, 9, 'Math,English A,Urdu A,Islamiat'),
(14, 11, 'Math,English A,Urdu A,Islamiat'),
(15, 12, 'Math,English A,Urdu A,Islamiat');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(32) NOT NULL,
  `subject_alias` varchar(10) NOT NULL,
  `subject_description` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_alias`, `subject_description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 'Math', 'M', 'Math', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(2, 'English A', 'Ea', 'English A', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(3, 'English B', 'Eb', 'English B', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(4, 'Urdu A', 'Ua', 'Urdu A', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(5, 'Urdu B', 'Ub', 'Urdu B', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(6, 'Science', 'S', 'Science', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(7, 'Pak-Studies', 'Ps', 'History / Pak-Studies', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(8, 'Computer', 'Cm', 'Computer', '2019-04-20 07:54:14', '0000-00-00 00:00:00', 1, 0, 1),
(9, 'Islamiat', 'I', 'Islamiat', '2019-04-20 07:54:14', '2018-12-31 11:57:46', 1, 1, 0),
(10, 'Drawing', 'D', 'Drawing', '2019-04-18 06:57:07', '0000-00-00 00:00:00', 9, 0, 1),
(11, 'Biology', 'B', 'Biology', '2019-04-20 07:54:15', '0000-00-00 00:00:00', 1, 0, 1),
(12, 'Physics', 'P', 'Physics', '2019-04-20 07:54:15', '0000-00-00 00:00:00', 1, 0, 1),
(13, 'Chemistry', 'Ch', 'Chemistry', '2019-04-20 07:54:15', '0000-00-00 00:00:00', 1, 0, 1),
(14, 'Islamiat (Elective)', 'I(ele)', 'Islamiat (Elective)', '2019-04-20 07:54:15', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject_assign_detail`
--

CREATE TABLE `teacher_subject_assign_detail` (
  `teacher_subject_assign_detail_id` int(11) NOT NULL,
  `teacher_subject_assign_detail_head_id` int(11) NOT NULL,
  `incharge` tinyint(4) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `no_of_lecture` enum('1 Lecture','2 Lectures','3 Lectures','4 Lectures','5 Lectures','6 Lectures','Full Week') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject_assign_detail`
--

INSERT INTO `teacher_subject_assign_detail` (`teacher_subject_assign_detail_id`, `teacher_subject_assign_detail_head_id`, `incharge`, `class_id`, `subject_id`, `no_of_lecture`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 1, 1, 1, 1, '1 Lecture', '2019-05-04 06:05:44', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1, 0, 1, 2, '1 Lecture', '2019-05-04 06:06:55', '0000-00-00 00:00:00', 1, 0, 1),
(3, 1, 0, 1, 4, '1 Lecture', '2019-05-04 06:06:55', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject_assign_head`
--

CREATE TABLE `teacher_subject_assign_head` (
  `teacher_subject_assign_head_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `teacher_subject_assign_head_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject_assign_head`
--

INSERT INTO `teacher_subject_assign_head` (`teacher_subject_assign_head_id`, `teacher_id`, `teacher_subject_assign_head_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 3, 'Kinza Mustafa', '2019-05-04 06:05:44', '0000-00-00 00:00:00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `time_table_detail`
--

CREATE TABLE `time_table_detail` (
  `time_table_d_id` int(11) NOT NULL,
  `time_table_h_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table_detail`
--

INSERT INTO `time_table_detail` (`time_table_d_id`, `time_table_h_id`, `subject_id`, `start_time`, `end_time`, `room`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 5, 8, '08:00:00', '08:40:00', 'Room-1', 1, 0, '2019-05-10 06:31:30', '0000-00-00 00:00:00'),
(3, 5, 9, '08:40:00', '09:20:00', 'Room-1', 1, 0, '2019-05-10 06:31:30', '0000-00-00 00:00:00'),
(4, 5, 2, '09:20:00', '10:00:00', 'Room-1', 1, 0, '2019-05-10 06:31:30', '0000-00-00 00:00:00'),
(5, 5, 4, '10:20:00', '11:00:00', 'Room-1', 1, 0, '2019-05-10 06:31:30', '0000-00-00 00:00:00'),
(6, 5, 1, '11:00:00', '11:40:00', 'Room-1', 1, 0, '2019-05-10 06:31:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `time_table_head`
--

CREATE TABLE `time_table_head` (
  `time_table_h_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `days` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table_head`
--

INSERT INTO `time_table_head` (`time_table_h_id`, `class_id`, `days`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 1, 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', 'Active', 1, 0, '2019-05-10 06:31:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'example@gmail.com',
  `user_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_photo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_block` tinyint(4) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `branch_id`, `first_name`, `last_name`, `username`, `email`, `user_type`, `auth_key`, `password_hash`, `password_reset_token`, `user_photo`, `is_block`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Dexterous', 'Developers', 'dexdevs', 'anas@dexdevs.com', 'dexdevs', 'pQEdYTAVV_wLtqIALoSZ-vELIA0mdsOx', '$2y$13$ClHehtUhZZQqsocCsPnEwer2wfQd4gTcpwSOJTkWnvoMD/oFzfCpG', NULL, 'userphotos/dexdevs_photo.png', 1, 10, 1552727256, 1552727256),
(3, 5, 'Super', 'Admin', 'Superadmin', 'superadmin@gmail.com', 'Superadmin', 'xqZuT3vxOiZ-rsN56V6wjZhi7VXMpKnD', '$2y$13$9TnNqeWAHECax0kmKSBzK.tGW/ePQm6IkutslR9ITYIXocjs4nnX.', NULL, 'userphotos/Superadmin_photo.png', 1, 10, 1552883449, 1552883449),
(4, 6, 'Dexterous', 'Developers', 'dexdevsdeveloper', 'admin@dexdevs.com', 'dexdevs2', 'm4vI7EWTZ61_eTBrJf_tliCWdgRfCKzM', '$2y$13$k6pJmBNM4hrkgZh0SYhcC.dZLxMLOjsJtVo55TV4QiVIJ4F6t7lIW', NULL, 'userphotos/dexdevs2_photo.png', 1, 10, 1552894313, 1552894313),
(76, 5, '', '', '31303-8976567-8', 'anas@gmail.com', 'Student', 'afdNhh9mHN0uj72DpcftEDdoYNKFC6FJ', '$2y$13$79joRdGwMvadCDnsTN5iZOmWfHn1TbuU8pKfZdmS6wo8URXfpvUji', NULL, 'uploads/Anas_photo.jpg', 1, 10, 1556945176, 1556945176),
(77, 5, '', '', '31303-4598637-0', 'shafqat@gmail.com', 'Parent', '-bPGwbSMAdmeKG_gYAwFaP1SH7xcclhC', '$2y$13$6fYTllCXYCwDPiCVrNdule4Nk0fshkthYooQnEjUMY1trZI6SfKn.', NULL, 'uploads/Anas_photo.jpg', 1, 10, 1556945177, 1556945177),
(78, 5, '', '', '31303-8765445-6', '', 'Student', 'xGL6IcawivZUOPG4nxbkH6c3xU7OCq9D', '$2y$13$9rXEiB9h2zqzcDzBA8moMutgNld4y4MdHVRGqXqePcnMv/Wd86hxK', NULL, 'uploads/Noman Shahid_photo.jpg', 1, 10, 1556945801, 1556945801),
(79, 5, '', '', '31303-9876543-2', 'shahid@gmail.com', 'Parent', 'He6nYvJRFvYKbBR3O8tSi69H-_QPRcSt', '$2y$13$U/WnbnXMNfP0CAeOJP/WauERMgdfxJBXqbtfx9Bn7y5eEkcxg0lIG', NULL, 'uploads/Noman Shahid_photo.jpg', 1, 10, 1556945802, 1556945802),
(80, 5, '', '', '31303-8765434-5', 'nadia@gmail.com', 'Student', '6LtDVxGfQwOAau12VVcMNKXLM5w15gqr', '$2y$13$reMF3hTmsvMG4B.J9NohCeYRSLCMr5Lzhg0igK8ry2zAoFbKbnGtq', NULL, 'uploads/Nadia Gull_photo.jpg', 1, 10, 1556946268, 1556946268),
(81, 5, '', '', '31303-2345678-9', '', 'Parent', 'Cqdk9mgk4pKnRdpmxGE_Gdm6W3mzrB07', '$2y$13$wBFGA9m0Dl/7m5./ODaqpO1x7aL5jCBf7YQPD/9FA6oZ2/G.c/QCa', NULL, 'uploads/Nadia Gull_photo.jpg', 1, 10, 1556946269, 1556946269),
(82, 5, '', '', '31303-9876545-6', 'saif@gmail.com', 'Student', 'U6SIUgtbLpfRFD9Xk3ZnncDgm2CaAYxi', '$2y$13$ZZK/o/lRAL/sXI5iLeo6WuCUo0Pq0LyWe5ab1LMq3kunf2yvpA1x.', NULL, 'uploads/Saif-ur-Rehman_photo.jpg', 1, 10, 1556946457, 1556946457),
(83, 5, '', '', '45102-9876543-2', 'ahmed@gmail.com', 'Parent', 'EABt_jHnzocUVQMFW8l_-4Izk-t5rc0G', '$2y$13$WYHNMmPG6x7bfJvwUuHKi.wFSCEia09GNkmzZfTA4hsihLgWBcoEC', NULL, 'uploads/Saif-ur-Rehman_photo.jpg', 1, 10, 1556946458, 1556946458),
(84, 6, '', '', '31303-5793467-9', 'asra@gmail.com', 'Student', 'P2fqTiUmwpXq4_aYnmVy60AwHhmHQnqM', '$2y$13$oxTpDkGCKqPGgRAC0E17iepPss8xq.7XJ6gMdKjuFDBQtklCJt7RC', NULL, 'uploads/Asra_photo.jpg', 1, 10, 1556947173, 1556947173),
(85, 6, '', '', '31303-9473976-5', '', 'Parent', 'H1jkc_o80WTYfzQp8uaRDgR0NcXKN0Sr', '$2y$13$5MlfCqlud.qJ/f76oJ1xDOBVtL6E9rWp7hmM16ZhHx6IMnPzfmBBW', NULL, 'uploads/Asra_photo.jpg', 1, 10, 1556947174, 1556947174),
(86, 6, '', '', '31303-3456789-8', '', 'Student', 'm-gGqeyhSfCO4t-3-rYKdMbFWd2a7IUC', '$2y$13$CnKFjuKCdGRzVc/TTt.0Suom2Gy6KSxqpMFp1a6q1FCv5RKzFASn6', NULL, 'uploads/Sadia Gull_photo.jpg', 1, 10, 1556947294, 1556947294),
(87, 6, '', '', '31303-9876543-4', '', 'Parent', 'oMy0KVpVoK29xtDDrE8dXsRZhF99RpfN', '$2y$13$/7QTQ0LTtvluhyoUG/795OsC0y7eI6fQlHKNweTbYE81CWhbClpBG', NULL, 'uploads/Sadia Gull_photo.jpg', 1, 10, 1556947295, 1556947295),
(88, 6, '', '', '31303-8765456-7', 'zarwa@gmail.com', 'Student', 'VoerVaDLuewb2IUzlyoIvI_70KRMpUlz', '$2y$13$Dy3LIXlCLDLmo0REJLhdpOLTvPloh7Hmhb79KNB1tdr.WT/oO3UVi', NULL, 'uploads/Zarwa Mustafa_photo.jpg', 1, 10, 1556947414, 1556947414),
(89, 6, '', '', '45102-8765432-3', '', 'Parent', 'k0bg5TK66upO2A-GOVmcd_cIkU4XgIdb', '$2y$13$BIWDeAnYweWPzdegtlQ4LOyOTyR2/1SP0pNVx61KASh/ygv9K/qUO', NULL, 'uploads/Zarwa Mustafa_photo.jpg', 1, 10, 1556947415, 1556947415),
(90, 6, '', '', '45102-8765435-6', 'asra@gmail.com', 'Student', 'YbXlGDTDZd4p0elqRMtlfAatbE8GYuk3', '$2y$13$7oWvsnqMEk5oe8V6.5C3z.QEQP5nMgibmQ9L0HJAWe4u3ipkJYrUq', NULL, 'uploads/Aniqa Gull_photo.jpg', 1, 10, 1556947530, 1556947530),
(91, 6, '', '', '31323-9876543-8', '', 'Parent', 'y1xIB3XYdMvDqgTy4Rq11rOV_P5x-uOq', '$2y$13$WWwo8nCKYQE2Ey97TwFwG.cy/pO7CsJ8c8fgFyUGYxLs.sT8NoitW', NULL, 'uploads/Aniqa Gull_photo.jpg', 1, 10, 1556947531, 1556947531),
(92, 6, '', '', '31303-1234567-8', 'nadiagull285@gmail.com', 'Teacher', 'hMG9_ODxGoul7gmJpyyuO4FPvnfRGhz1', '$2y$13$BaDsPcmIbMcmy0UdLiA.eeZJCoQ1TxpxphIlgS5FKsizyCkI/dGFu', NULL, 'uploads/Nadia Gull_emp_photo.jpg', 1, 10, 1556947788, 1556947788),
(93, 6, '', '', '31303-7654345-6', 'anas@gmail.com', 'Teacher', 'oRTvxYO6WsEpdH0jvpSAz2uA9iHz9ZdA', '$2y$13$e0LHPfDH9WaEvA660UM6PeQjbkAh7QPRcUdRDjwfkWrgPO0UGPrMa', NULL, 'uploads/Anas Shafqat_emp_photo.jpg', 1, 10, 1556948043, 1556948043),
(94, 5, '', '', '45102-0511722-2', 'kinza.fatima.522@gmail.com', 'Teacher', '780IQdeAG-7zbU1hPr78QYYLu0a-3hob', '$2y$13$TxvaK0Nggikoobfw3rXSbeKCPProPS.bnJ3Avs0P1jxQUcAXgwHDO', NULL, 'uploads/Kinza Mustafa_emp_photo.jpg', 1, 10, 1556948502, 1556948502),
(95, 5, '', '', '31303-0511722-2', 'nauman@gmail.com', 'Teacher', 'RE1lklnLtDi-syIt48a9eZyAi5eaPyMh', '$2y$13$SGSe7ERGlA77PJfQlwTYre6BztQGv..nPH2UvWT55FQUL99AbdWlO', NULL, 'uploads/Numan Hashmi_emp_photo.jpg', 1, 10, 1556949021, 1556949021),
(96, 5, '', '', 'Executive', 'executive@abc.com', 'Executive', '0nZjH6QF5WhUz_Df-8X21kKCVCIgi8AI', '$2y$13$emHj93Oxj0nIaLIIF1N0/uK3461diDYunNDYQCH95TdNDW/s9evAW', NULL, 'userphotos/Executive_photo.jpg', 1, 10, 1556957679, 1556957679);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`) VALUES
(1, 'Principal'),
(2, 'Admin'),
(3, 'Vice Principal'),
(4, 'Superadmin'),
(5, 'Inquiry Head'),
(6, 'Registrar'),
(7, 'Accountant'),
(8, 'Exams Controller'),
(9, 'Student'),
(10, 'Teacher'),
(11, 'Parent'),
(12, 'Executive');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `visitor_name` varchar(30) NOT NULL,
  `visitor_contact_no` varchar(15) NOT NULL,
  `visitor_photo` varchar(200) NOT NULL,
  `visitor_cnic` varchar(15) NOT NULL,
  `visit_purpose` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `visitor_name`, `visitor_contact_no`, `visitor_photo`, `visitor_cnic`, `visit_purpose`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Kinza Mustafa', '+92-300-7976242', '', '45102-0511722-2', 'meeting with principle', 1, 1, '2019-06-16 19:57:31', '2019-06-16 19:57:31'),
(2, 'Nauman Hashmi', '+92-333-7486807', '', '31303-4519566-9', 'want to visit admission office\r\n', 1, 1, '2019-06-16 19:58:51', '2019-06-16 19:58:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_nature`
--
ALTER TABLE `account_nature`
  ADD PRIMARY KEY (`account_nature_id`);

--
-- Indexes for table `account_register`
--
ALTER TABLE `account_register`
  ADD PRIMARY KEY (`account_register_id`),
  ADD KEY `account_register_account_nature_id` (`account_nature_id`);

--
-- Indexes for table `account_transactions`
--
ALTER TABLE `account_transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `trans_head_account_id` (`account_nature`),
  ADD KEY `trans_head_voucher_type_id` (`account_register_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `concession`
--
ALTER TABLE `concession`
  ADD PRIMARY KEY (`concession_id`);

--
-- Indexes for table `custom_sms`
--
ALTER TABLE `custom_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`emial_id`);

--
-- Indexes for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `emp_departments`
--
ALTER TABLE `emp_departments`
  ADD PRIMARY KEY (`emp_department_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `department_id` (`dept_id`);

--
-- Indexes for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD PRIMARY KEY (`emp_designation_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `designation_id` (`designation_id`),
  ADD KEY `emp_type_id` (`emp_type_id`);

--
-- Indexes for table `emp_documents`
--
ALTER TABLE `emp_documents`
  ADD PRIMARY KEY (`emp_document_id`),
  ADD KEY `emp_info_id` (`emp_info_id`);

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_branch_id` (`emp_branch_id`),
  ADD KEY `emp_dept_id` (`emp_dept_id`);

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `emp_reference`
--
ALTER TABLE `emp_reference`
  ADD PRIMARY KEY (`emp_ref_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `emp_type`
--
ALTER TABLE `emp_type`
  ADD PRIMARY KEY (`emp_type_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `exams_category`
--
ALTER TABLE `exams_category`
  ADD PRIMARY KEY (`exam_category_id`);

--
-- Indexes for table `exams_criteria`
--
ALTER TABLE `exams_criteria`
  ADD PRIMARY KEY (`exam_criteria_id`),
  ADD KEY `exam_category_id` (`exam_category_id`,`class_id`),
  ADD KEY `std_enroll_head_id` (`class_id`);

--
-- Indexes for table `exams_room`
--
ALTER TABLE `exams_room`
  ADD PRIMARY KEY (`exam_room_id`),
  ADD KEY `exams_room_ibfk_2` (`class_head_id`),
  ADD KEY `exams_room_ibfk_1` (`exam_schedule_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `exam_room` (`exam_room`);

--
-- Indexes for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  ADD PRIMARY KEY (`exam_schedule_id`),
  ADD KEY `exam_criteria_id` (`exam_criteria_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `fee_month_detail`
--
ALTER TABLE `fee_month_detail`
  ADD PRIMARY KEY (`month_detail_id`);

--
-- Indexes for table `fee_transaction_detail`
--
ALTER TABLE `fee_transaction_detail`
  ADD PRIMARY KEY (`fee_trans_detail_id`),
  ADD KEY `fee_trans_detail_head_id` (`fee_trans_detail_head_id`),
  ADD KEY `fee_type_id` (`fee_type_id`);

--
-- Indexes for table `fee_transaction_head`
--
ALTER TABLE `fee_transaction_head`
  ADD PRIMARY KEY (`fee_trans_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `month_id` (`month`),
  ADD KEY `class_name_id` (`class_name_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `fee_type`
--
ALTER TABLE `fee_type`
  ADD PRIMARY KEY (`fee_type_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`installment_id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`institute_id`);

--
-- Indexes for table `institute_name`
--
ALTER TABLE `institute_name`
  ADD PRIMARY KEY (`Institute_name_id`);

--
-- Indexes for table `marks_details`
--
ALTER TABLE `marks_details`
  ADD PRIMARY KEY (`marks_detail_id`),
  ADD KEY `marks_head_id` (`marks_head_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `marks_details_weightage`
--
ALTER TABLE `marks_details_weightage`
  ADD PRIMARY KEY (`marks_details_weightage_id`),
  ADD KEY `marks_details_id` (`marks_details_id`),
  ADD KEY `weightage_type_id` (`weightage_type_id`);

--
-- Indexes for table `marks_head`
--
ALTER TABLE `marks_head`
  ADD PRIMARY KEY (`marks_head_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `exam_criteria_id` (`exam_criteria_id`),
  ADD KEY `class_head_id` (`class_head_id`);

--
-- Indexes for table `marks_weightage_details`
--
ALTER TABLE `marks_weightage_details`
  ADD PRIMARY KEY (`weightage_detail_id`),
  ADD KEY `weightage_head_id` (`weightage_head_id`),
  ADD KEY `weightage_type_id` (`weightage_type_id`);

--
-- Indexes for table `marks_weightage_head`
--
ALTER TABLE `marks_weightage_head`
  ADD PRIMARY KEY (`marks_weightage_id`),
  ADD KEY `exam_category_id` (`exam_category_id`),
  ADD KEY `subjects_id` (`subjects_id`),
  ADD KEY `marks_weightage_head_ibfk_2` (`class_id`);

--
-- Indexes for table `marks_weightage_type`
--
ALTER TABLE `marks_weightage_type`
  ADD PRIMARY KEY (`weightage_type_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `msg_of_day`
--
ALTER TABLE `msg_of_day`
  ADD PRIMARY KEY (`msg_of_day_id`),
  ADD UNIQUE KEY `msg_details` (`msg_details`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `remarks_head`
--
ALTER TABLE `remarks_head`
  ADD PRIMARY KEY (`remarks_head_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `std_academic_info`
--
ALTER TABLE `std_academic_info`
  ADD PRIMARY KEY (`academic_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `class_name_id` (`class_name_id`),
  ADD KEY `subject_combination` (`subject_combination`);

--
-- Indexes for table `std_attendance`
--
ALTER TABLE `std_attendance`
  ADD PRIMARY KEY (`std_attend_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_name_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `std_class_name`
--
ALTER TABLE `std_class_name`
  ADD PRIMARY KEY (`class_name_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `std_enrollment_detail`
--
ALTER TABLE `std_enrollment_detail`
  ADD PRIMARY KEY (`std_enroll_detail_id`),
  ADD KEY `std_enroll_detail_head_id` (`std_enroll_detail_head_id`),
  ADD KEY `std_enroll_detail_std_id` (`std_enroll_detail_std_id`);

--
-- Indexes for table `std_enrollment_head`
--
ALTER TABLE `std_enrollment_head`
  ADD PRIMARY KEY (`std_enroll_head_id`),
  ADD KEY `class_name_id` (`class_name_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `std_fee_details`
--
ALTER TABLE `std_fee_details`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `std_fee_installments`
--
ALTER TABLE `std_fee_installments`
  ADD PRIMARY KEY (`fee_installment_id`),
  ADD KEY `std_fee_id` (`std_fee_id`),
  ADD KEY `installment_no` (`installment_no`);

--
-- Indexes for table `std_fee_pkg`
--
ALTER TABLE `std_fee_pkg`
  ADD PRIMARY KEY (`std_fee_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `std_guardian_info`
--
ALTER TABLE `std_guardian_info`
  ADD PRIMARY KEY (`std_guardian_info_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `std_ice_info`
--
ALTER TABLE `std_ice_info`
  ADD PRIMARY KEY (`std_ice_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `std_inquiry`
--
ALTER TABLE `std_inquiry`
  ADD PRIMARY KEY (`std_inquiry_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `std_personal_info`
--
ALTER TABLE `std_personal_info`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `std_reg_no` (`std_reg_no`),
  ADD KEY `std_name` (`std_name`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `std_remarks`
--
ALTER TABLE `std_remarks`
  ADD PRIMARY KEY (`std_remarks_id`),
  ADD KEY `remarks_head_id` (`remarks_head_id`);

--
-- Indexes for table `std_sections`
--
ALTER TABLE `std_sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `std_sessions`
--
ALTER TABLE `std_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_branch_id` (`session_branch_id`);

--
-- Indexes for table `std_subjects`
--
ALTER TABLE `std_subjects`
  ADD PRIMARY KEY (`std_subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher_subject_assign_detail`
--
ALTER TABLE `teacher_subject_assign_detail`
  ADD PRIMARY KEY (`teacher_subject_assign_detail_id`),
  ADD KEY `teacher_subject_assign_detail_head_id` (`teacher_subject_assign_detail_head_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `teacher_subject_assign_head`
--
ALTER TABLE `teacher_subject_assign_head`
  ADD PRIMARY KEY (`teacher_subject_assign_head_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `time_table_detail`
--
ALTER TABLE `time_table_detail`
  ADD PRIMARY KEY (`time_table_d_id`),
  ADD KEY `time_table_h_id` (`time_table_h_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `time_table_head`
--
ALTER TABLE `time_table_head`
  ADD PRIMARY KEY (`time_table_h_id`),
  ADD KEY `time_table_head_ibfk_1` (`class_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_nature`
--
ALTER TABLE `account_nature`
  MODIFY `account_nature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_register`
--
ALTER TABLE `account_register`
  MODIFY `account_register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `account_transactions`
--
ALTER TABLE `account_transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `concession`
--
ALTER TABLE `concession`
  MODIFY `concession_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `custom_sms`
--
ALTER TABLE `custom_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `emial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_departments`
--
ALTER TABLE `emp_departments`
  MODIFY `emp_department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `emp_designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emp_documents`
--
ALTER TABLE `emp_documents`
  MODIFY `emp_document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_info`
--
ALTER TABLE `emp_info`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_reference`
--
ALTER TABLE `emp_reference`
  MODIFY `emp_ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_type`
--
ALTER TABLE `emp_type`
  MODIFY `emp_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exams_category`
--
ALTER TABLE `exams_category`
  MODIFY `exam_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exams_criteria`
--
ALTER TABLE `exams_criteria`
  MODIFY `exam_criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams_room`
--
ALTER TABLE `exams_room`
  MODIFY `exam_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  MODIFY `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_month_detail`
--
ALTER TABLE `fee_month_detail`
  MODIFY `month_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fee_transaction_detail`
--
ALTER TABLE `fee_transaction_detail`
  MODIFY `fee_trans_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `fee_transaction_head`
--
ALTER TABLE `fee_transaction_head`
  MODIFY `fee_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fee_type`
--
ALTER TABLE `fee_type`
  MODIFY `fee_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `installment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `institute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institute_name`
--
ALTER TABLE `institute_name`
  MODIFY `Institute_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `marks_details`
--
ALTER TABLE `marks_details`
  MODIFY `marks_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks_details_weightage`
--
ALTER TABLE `marks_details_weightage`
  MODIFY `marks_details_weightage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks_head`
--
ALTER TABLE `marks_head`
  MODIFY `marks_head_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks_weightage_details`
--
ALTER TABLE `marks_weightage_details`
  MODIFY `weightage_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `marks_weightage_head`
--
ALTER TABLE `marks_weightage_head`
  MODIFY `marks_weightage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `marks_weightage_type`
--
ALTER TABLE `marks_weightage_type`
  MODIFY `weightage_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `msg_of_day`
--
ALTER TABLE `msg_of_day`
  MODIFY `msg_of_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `remarks_head`
--
ALTER TABLE `remarks_head`
  MODIFY `remarks_head_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `std_academic_info`
--
ALTER TABLE `std_academic_info`
  MODIFY `academic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_attendance`
--
ALTER TABLE `std_attendance`
  MODIFY `std_attend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_class_name`
--
ALTER TABLE `std_class_name`
  MODIFY `class_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `std_enrollment_detail`
--
ALTER TABLE `std_enrollment_detail`
  MODIFY `std_enroll_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `std_enrollment_head`
--
ALTER TABLE `std_enrollment_head`
  MODIFY `std_enroll_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `std_fee_details`
--
ALTER TABLE `std_fee_details`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_fee_installments`
--
ALTER TABLE `std_fee_installments`
  MODIFY `fee_installment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_fee_pkg`
--
ALTER TABLE `std_fee_pkg`
  MODIFY `std_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `std_guardian_info`
--
ALTER TABLE `std_guardian_info`
  MODIFY `std_guardian_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_ice_info`
--
ALTER TABLE `std_ice_info`
  MODIFY `std_ice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_inquiry`
--
ALTER TABLE `std_inquiry`
  MODIFY `std_inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `std_personal_info`
--
ALTER TABLE `std_personal_info`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `std_remarks`
--
ALTER TABLE `std_remarks`
  MODIFY `std_remarks_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_sections`
--
ALTER TABLE `std_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `std_sessions`
--
ALTER TABLE `std_sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `std_subjects`
--
ALTER TABLE `std_subjects`
  MODIFY `std_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teacher_subject_assign_detail`
--
ALTER TABLE `teacher_subject_assign_detail`
  MODIFY `teacher_subject_assign_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_subject_assign_head`
--
ALTER TABLE `teacher_subject_assign_head`
  MODIFY `teacher_subject_assign_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_table_detail`
--
ALTER TABLE `time_table_detail`
  MODIFY `time_table_d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `time_table_head`
--
ALTER TABLE `time_table_head`
  MODIFY `time_table_h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_register`
--
ALTER TABLE `account_register`
  ADD CONSTRAINT `account_register_ibfk_1` FOREIGN KEY (`account_nature_id`) REFERENCES `account_nature` (`account_nature_id`);

--
-- Constraints for table `account_transactions`
--
ALTER TABLE `account_transactions`
  ADD CONSTRAINT `account_transactions_ibfk_2` FOREIGN KEY (`account_register_id`) REFERENCES `account_register` (`account_register_id`),
  ADD CONSTRAINT `account_transactions_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`institute_id`);

--
-- Constraints for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD CONSTRAINT `emp_attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`),
  ADD CONSTRAINT `emp_attendance_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD CONSTRAINT `emp_designation_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`),
  ADD CONSTRAINT `emp_designation_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`designation_id`),
  ADD CONSTRAINT `emp_designation_ibfk_3` FOREIGN KEY (`emp_type_id`) REFERENCES `emp_type` (`emp_type_id`);

--
-- Constraints for table `exams_criteria`
--
ALTER TABLE `exams_criteria`
  ADD CONSTRAINT `exams_criteria_ibfk_1` FOREIGN KEY (`exam_category_id`) REFERENCES `exams_category` (`exam_category_id`),
  ADD CONSTRAINT `exams_criteria_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `std_class_name` (`class_name_id`);

--
-- Constraints for table `exams_room`
--
ALTER TABLE `exams_room`
  ADD CONSTRAINT `exams_room_ibfk_1` FOREIGN KEY (`exam_schedule_id`) REFERENCES `exams_schedule` (`exam_schedule_id`),
  ADD CONSTRAINT `exams_room_ibfk_2` FOREIGN KEY (`exam_room`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `exams_room_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`),
  ADD CONSTRAINT `exams_room_ibfk_4` FOREIGN KEY (`class_head_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`);

--
-- Constraints for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  ADD CONSTRAINT `exams_schedule_ibfk_1` FOREIGN KEY (`exam_criteria_id`) REFERENCES `exams_criteria` (`exam_criteria_id`),
  ADD CONSTRAINT `exams_schedule_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `marks_details`
--
ALTER TABLE `marks_details`
  ADD CONSTRAINT `marks_details_ibfk_1` FOREIGN KEY (`marks_head_id`) REFERENCES `marks_head` (`marks_head_id`),
  ADD CONSTRAINT `marks_details_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `marks_details_weightage`
--
ALTER TABLE `marks_details_weightage`
  ADD CONSTRAINT `marks_details_weightage_ibfk_1` FOREIGN KEY (`marks_details_id`) REFERENCES `marks_details` (`marks_detail_id`),
  ADD CONSTRAINT `marks_details_weightage_ibfk_2` FOREIGN KEY (`weightage_type_id`) REFERENCES `marks_weightage_type` (`weightage_type_id`);

--
-- Constraints for table `marks_head`
--
ALTER TABLE `marks_head`
  ADD CONSTRAINT `marks_head_ibfk_1` FOREIGN KEY (`exam_criteria_id`) REFERENCES `exams_criteria` (`exam_criteria_id`),
  ADD CONSTRAINT `marks_head_ibfk_2` FOREIGN KEY (`class_head_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`),
  ADD CONSTRAINT `marks_head_ibfk_3` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`);

--
-- Constraints for table `marks_weightage_details`
--
ALTER TABLE `marks_weightage_details`
  ADD CONSTRAINT `marks_weightage_details_ibfk_1` FOREIGN KEY (`weightage_head_id`) REFERENCES `marks_weightage_head` (`marks_weightage_id`),
  ADD CONSTRAINT `marks_weightage_details_ibfk_2` FOREIGN KEY (`weightage_type_id`) REFERENCES `marks_weightage_type` (`weightage_type_id`);

--
-- Constraints for table `marks_weightage_head`
--
ALTER TABLE `marks_weightage_head`
  ADD CONSTRAINT `marks_weightage_head_ibfk_1` FOREIGN KEY (`exam_category_id`) REFERENCES `exams_category` (`exam_category_id`),
  ADD CONSTRAINT `marks_weightage_head_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `std_class_name` (`class_name_id`),
  ADD CONSTRAINT `marks_weightage_head_ibfk_3` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `std_enrollment_head`
--
ALTER TABLE `std_enrollment_head`
  ADD CONSTRAINT `std_enrollment_head_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `std_enrollment_head_ibfk_2` FOREIGN KEY (`class_name_id`) REFERENCES `std_class_name` (`class_name_id`),
  ADD CONSTRAINT `std_enrollment_head_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `std_sessions` (`session_id`),
  ADD CONSTRAINT `std_enrollment_head_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `std_sections` (`section_id`);

--
-- Constraints for table `std_remarks`
--
ALTER TABLE `std_remarks`
  ADD CONSTRAINT `std_remarks_ibfk_1` FOREIGN KEY (`remarks_head_id`) REFERENCES `remarks_head` (`remarks_head_id`);

--
-- Constraints for table `time_table_detail`
--
ALTER TABLE `time_table_detail`
  ADD CONSTRAINT `time_table_detail_ibfk_1` FOREIGN KEY (`time_table_h_id`) REFERENCES `time_table_head` (`time_table_h_id`),
  ADD CONSTRAINT `time_table_detail_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `time_table_head`
--
ALTER TABLE `time_table_head`
  ADD CONSTRAINT `time_table_head_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
