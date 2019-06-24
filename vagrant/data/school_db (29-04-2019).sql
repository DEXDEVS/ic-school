-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2019 at 07:14 PM
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
(14, 6, 'Income', 5, '2019-04-27 11:20:38', 'Amount Partially Paid By Voucher #: 1008', 4000, '2019-04-27 11:20:38', '0000-00-00 00:00:00', 4, 0);

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

--
-- Dumping data for table `emp_attendance`
--

INSERT INTO `emp_attendance` (`att_id`, `branch_id`, `emp_id`, `att_date`, `check_in`, `check_out`, `attendance`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 2, '2019-04-01', '10:34:36', '10:38:53', 'P', 1, 1, '2019-04-26 08:34:36', '2019-04-26 08:38:53'),
(4, 5, 1, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(5, 5, 3, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(6, 5, 4, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(7, 5, 5, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(8, 5, 6, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(9, 5, 7, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(10, 5, 8, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(11, 5, 9, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(12, 5, 11, '2019-04-01', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 08:46:43', '0000-00-00 00:00:00'),
(13, 5, 1, '2019-04-26', '00:00:00', '00:00:00', 'L', 1, 0, '2019-04-26 15:34:22', '0000-00-00 00:00:00'),
(14, 5, 1, '2019-04-27', '00:00:00', '00:00:00', 'L', 1, 0, '2019-04-26 15:34:22', '0000-00-00 00:00:00'),
(15, 5, 1, '2019-04-28', '00:00:00', '00:00:00', 'L', 1, 0, '2019-04-26 15:34:22', '0000-00-00 00:00:00'),
(16, 5, 3, '2019-04-26', '21:24:55', NULL, 'P', 1, 0, '2019-04-26 19:24:55', '0000-00-00 00:00:00'),
(17, 5, 2, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 1, '2019-04-26 19:34:06', '2019-04-26 19:36:26'),
(18, 5, 4, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(19, 5, 5, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(20, 5, 6, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(21, 5, 7, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(22, 5, 8, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(23, 5, 9, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(24, 5, 11, '2019-04-26', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-26 19:34:06', '0000-00-00 00:00:00'),
(25, 6, 12, '2019-04-27', '08:31:43', NULL, 'P', 4, 0, '2019-04-27 06:31:43', '0000-00-00 00:00:00');

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
  `emp_designation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_designation`
--

INSERT INTO `emp_designation` (`emp_designation_id`, `emp_designation`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(2, 'Vice Principal', '2019-04-27 08:49:01', '2018-10-31 08:17:30', 1, 1, 1),
(3, 'Coordinator', '2018-10-31 08:23:02', '0000-00-00 00:00:00', 1, 0, 1),
(4, 'Teacher', '2018-10-31 08:23:21', '0000-00-00 00:00:00', 1, 0, 1),
(5, 'Security Gaurd', '2018-10-31 09:55:43', '2018-10-31 09:55:43', 1, 1, 1),
(6, 'Accountant', '2018-12-07 06:29:32', '0000-00-00 00:00:00', 1, 0, 1),
(7, 'Librarian', '2019-01-14 17:59:26', '0000-00-00 00:00:00', 0, 0, 1),
(8, 'Office Boy', '2019-02-20 13:33:12', '0000-00-00 00:00:00', 9, 0, 1),
(9, 'HOD', '2019-02-22 07:33:33', '2019-02-22 07:33:33', 9, 8, 1);

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

--
-- Dumping data for table `emp_documents`
--

INSERT INTO `emp_documents` (`emp_document_id`, `emp_info_id`, `emp_document_name`, `emp_document`, `delete_status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(10, 2, '', 'uploads/2_DFD 0 level.PNG', 1, '2019-02-20 08:34:38', '0000-00-00 00:00:00', 9, 0),
(11, 2, '', 'uploads/2_DFD 1 level.PNG', 1, '2019-02-20 08:51:38', '0000-00-00 00:00:00', 9, 0),
(12, 2, '', 'uploads/2_CODING.jpg', 1, '2019-02-21 05:07:07', '0000-00-00 00:00:00', 9, 0),
(13, 1, '', 'uploads/1_ER Diagram of Hospital_DB.PNG', 1, '2019-02-21 05:27:58', '0000-00-00 00:00:00', 9, 0),
(14, 1, '', 'uploads/1_DFD 1 level.PNG', 1, '2019-02-21 05:30:06', '0000-00-00 00:00:00', 9, 0),
(15, 1, '', 'uploads/1_Cnic Backk.jpg', 1, '2019-02-21 05:33:21', '0000-00-00 00:00:00', 9, 0),
(16, 1, '', 'uploads/1_ER Diagram of Hospital_DB.PNG', 1, '2019-02-21 05:36:19', '0000-00-00 00:00:00', 9, 0),
(17, 1, '', 'uploads/1_DFD 1 level.PNG', 1, '2019-02-21 05:37:11', '0000-00-00 00:00:00', 9, 0),
(18, 3, 'BSCS Degree', 'uploads/3_Capture.PNG', 0, '2019-04-06 05:55:48', '2019-04-06 05:55:48', 9, 1),
(19, 3, 'Web Development Certificate', 'uploads/3Web Development Certificate_Anas Shafqat 10293858.jpg', 0, '2019-04-06 05:55:54', '2019-04-06 05:55:54', 9, 1),
(20, 3, 'Certificate Logo', 'uploads/3_Certified partner Banner.jpg', 0, '2019-04-06 05:56:00', '2019-04-06 05:56:00', 9, 1),
(21, 3, 'BForm', 'uploads/3_browser-market-shares-in (1).png', 0, '2019-04-06 05:56:06', '2019-04-06 05:56:06', 9, 1),
(22, 1, 'BSCS Degree', 'uploads/1_course_Page-1.jpg', 1, '2019-02-24 06:39:59', '0000-00-00 00:00:00', 9, 0),
(23, 2, 'Web Development Certificate', 'uploads/2_Anas Shafqat 10293858.jpg', 1, '2019-02-24 06:46:28', '0000-00-00 00:00:00', 9, 0),
(24, 5, 'BSCS Degree', 'uploads/5_My Updated Cv.pdf', 1, '2019-02-24 06:50:37', '0000-00-00 00:00:00', 9, 0),
(25, 7, 'MSC Degree', 'uploads/7_1.jpeg', 1, '2019-02-24 07:05:19', '0000-00-00 00:00:00', 9, 0),
(26, 7, 'Certificate Logo', 'uploads/7_WhatsApp Image 2018-08-08 at 1.14.06 PM.jpeg', 1, '2019-02-24 07:36:27', '0000-00-00 00:00:00', 9, 0),
(27, 7, 'BForm', 'uploads/7_Certified partner Banner.jpg', 1, '2019-02-24 07:37:38', '0000-00-00 00:00:00', 9, 0),
(28, 3, 'BSCS Degree', 'uploads/3_BSCS Degree.docx', 1, '2019-04-06 05:58:53', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE `emp_info` (
  `emp_id` int(11) NOT NULL,
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
  `emp_dept_id` varchar(11) NOT NULL,
  `emp_designation_id` int(11) NOT NULL,
  `emp_type_id` int(11) NOT NULL,
  `emp_salary_type` enum('Salaried','Per Lecture') NOT NULL,
  `group_by` enum('Faculty','Management','Clerical Staff','Office Boys','Security Guard') NOT NULL,
  `emp_branch_id` int(11) NOT NULL,
  `emp_email` varchar(84) NOT NULL,
  `emp_qualification` varchar(50) NOT NULL,
  `emp_passing_year` int(11) NOT NULL,
  `emp_institute_name` varchar(50) NOT NULL,
  `degree_scan_copy` varchar(200) NOT NULL,
  `emp_cv` varchar(200) NOT NULL,
  `emp_salary` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`emp_id`, `emp_reg_no`, `emp_name`, `emp_father_name`, `emp_cnic`, `emp_contact_no`, `emp_perm_address`, `emp_temp_address`, `emp_marital_status`, `emp_fb_ID`, `emp_gender`, `emp_photo`, `emp_dept_id`, `emp_designation_id`, `emp_type_id`, `emp_salary_type`, `group_by`, `emp_branch_id`, `emp_email`, `emp_qualification`, `emp_passing_year`, `emp_institute_name`, `degree_scan_copy`, `emp_cv`, `emp_salary`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 'EMP-Y19-1', 'Kinza Mustafa', 'G Mustafa', '45102-0511722-2', '+92-345-6789098', 'RYK', 'RYK', 'Single', 'Kinza@gmail.com', 'Female', 'uploads/Kinza Mustafa_emp_photo.jpg', '1', 2, 4, 'Salaried', 'Faculty', 5, 'kinza.fatima.522@gmail.com', 'BSCS', 2017, 'IUB', 'uploads/Kinza Mustafa_degree_scan_copy.jpg', '', 10000, '2019-04-27 07:24:43', '2019-04-06 06:01:51', 3, 1, 1),
(2, 'EMP-Y19-2', 'Nadia', 'Gull', '88888-8888888-8', '+92-345-6789999', 'ryk', 'ryk', 'Single', 'fghj@gmail.com', 'Female', 'uploads/nadia_emp_photo.jpg', '1', 4, 5, 'Per Lecture', 'Faculty', 5, 'fghj@gmail.com', 'BSCS', 2019, 'fghjk', 'uploads/Nadia_degree_scan_copy.png', '', 1300, '2019-04-06 05:40:28', '2019-04-06 05:40:28', 3, 4, 1),
(3, 'EMP-Y19-3', 'Nauman', 'shahid', '31303-0511722-2', '+92-331-5698895', 'RYK', 'RYK', 'Married', 'nauman@gmail.com', 'Male', 'uploads/Nauman_emp_photo.jpg', '1,7', 4, 5, 'Per Lecture', 'Faculty', 5, 'nauman@gmail.com', 'BSCS', 2108, 'Superior', 'uploads/Nauman_degree_scan_copy.jpg', '', 1000, '2019-04-18 07:07:22', '2019-04-06 06:05:48', 8, 1, 1),
(4, 'EMP-Y19-4', 'Ayesha', 'Ali', '46545-4654654-6', '+92-345-6787654', 'RYK', 'RYK', 'Single', 'ayesha@gmail.com', 'Female', 'uploads/Ayesha_emp_photo.png', '1', 9, 4, 'Salaried', 'Faculty', 5, 'ayesha@gmail.com', 'BSCS', 2018, 'Superior', 'uploads/Ayesha_degree_scan_copy.xps', '', 40000, '2019-04-20 08:15:20', '2019-04-20 08:15:20', 8, 3, 1),
(5, 'EMP-Y19-5', 'Qasim Khan', 'M. Ali Khan', '12345-6789098-7', '34', 'RYK', 'RYK', 'Married', 'qasim@gmail.com', 'Male', '0', '', 4, 4, 'Salaried', 'Faculty', 5, 'ali@gmail.com', 'BSCS', 2018, 'Superior College', '0', '', 25000, '2019-02-24 06:39:07', '0000-00-00 00:00:00', 9, 0, 1),
(6, 'EMP-Y19-6', 'Shahzaib Akram', 'Akram Ali', '12345-6543234-5', '92', 'Gulshan Iqbal', 'Gulshan Iqbal', 'Single', 'shahzaib@gmail.com', 'Male', '0', '', 4, 4, 'Salaried', 'Faculty', 5, 'shahzaib@gmail.com', 'MSC Maths', 2018, 'IUB', '0', '', 25000, '2019-02-24 07:02:07', '2019-02-24 07:02:07', 9, 9, 1),
(7, 'EMP-Y19-7', 'Adnan Akram', 'Akram Ali', '12345-6787654-3', '92', 'RYK', 'RYK', 'Single', 'adnan@gmail.com', 'Male', '0', '', 4, 4, 'Salaried', 'Faculty', 5, 'adnan@gmail.com', 'MSC Maths', 2018, 'IUB', '0', '', 25000, '2019-02-24 07:04:41', '2019-02-24 07:04:41', 9, 9, 1),
(8, 'EMP-Y19-8', 'Sajid Umar', 'Umar Khan', '12345-6787654-7', '92', 'Gulshan Iqbal', 'Gulshan Iqbal', 'Single', 'sajid@gmail.com', 'Male', 'uploads/Sajid Umar_emp_photo.jpeg', '', 4, 4, 'Salaried', 'Faculty', 5, 'sajid@gmail.com', 'MSC Maths', 2018, 'IUB', '0', '', 25000, '2019-02-24 07:01:02', '0000-00-00 00:00:00', 9, 0, 1),
(9, 'EMP-Y19-9', 'Zia ur Rehman', 'A. Rehman', '31303-2345678-8', '92', 'Gulshan Iqbal', 'Gulshan Iqbal', 'Single', 'zia@gmail.com', 'Male', 'uploads/Zia ur Rehman_emp_photo.jpg', '', 4, 4, 'Salaried', 'Faculty', 5, 'zia@gmail.com', 'MSC Physics', 2018, 'IUB', '0', '', 30000, '2019-02-25 04:39:20', '0000-00-00 00:00:00', 9, 0, 1),
(11, 'EMP-Y19-10', 'Sana Asad', 'Asad Ali', '31303-3456789-8', '+92-315-8410500', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Sana Asad_emp_photo.jpg', '', 4, 2, 'Salaried', 'Faculty', 5, 'sana@gmail.com', 'M.Phil', 2017, 'QAU', 'uploads/Sana Asad_degree_scan_copy.jpg', '', 15000, '2019-04-04 07:52:55', '0000-00-00 00:00:00', 1, 0, 1),
(12, 'EMP-Y19-12', 'Muhammad Saif ', 'Muhammed Arshad', '31303-4567687-6', '+92-308-3152045', 'RYK', 'RYK', 'Single', '', 'Male', 'uploads/Muhammad Saif _emp_photo.jpg', '', 4, 3, 'Salaried', 'Faculty', 6, 'saif@gmail.com', 'BSCS', 2019, 'IUB', 'uploads/Muhammad Saif _degree_scan_copy.jpg', '', 30000, '2019-04-27 06:25:53', '0000-00-00 00:00:00', 4, 0, 1),
(13, 'EMP-Y19-13', 'Farhan', 'Hashmi', '31303-1246789-2', '+92-300-6999824', 'RKY', 'RKY', 'Single', '', 'Male', 'uploads/Farhan_emp_photo.jpg', '', 6, 4, 'Salaried', '', 6, 'farhan@gmail.com', 'MCS', 2019, 'IUB', 'uploads/Farhan_degree_scan_copy.jpg', '', 10000, '2019-04-27 06:58:17', '0000-00-00 00:00:00', 4, 0, 1),
(14, 'EMP-Y19-14', 'Muhammad Saif Ur rehman', 'Muhammad Arishad', '31304-2076970-7', '+92-308-3152045', 'Chack no 145 p Rahim yar ', 'Ryk', 'Single', '', 'Male', 'uploads/Muhammad Saif Ur rehman_emp_photo.jpg', '', 3, 4, 'Salaried', '', 5, 'saifarshad.6987@gmail.com', 'master', 2016, 'IUB', 'uploads/Muhammad Saif Ur rehman_degree_scan_copy.jpg', 'uploads/Muhammad Saif Ur rehman_emp_cv.jpg', 25000, '2019-04-29 07:40:22', '2019-04-29 07:40:22', 1, 1, 1);

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
(1, 5, 1, 'Casual Leave', '2019-04-26', '2019-04-28', '2019-04-26', 3, 'Personal Reason', 'Accepted', 'Best of Luck...!!!', '2019-04-26 15:36:59', '2019-04-26 15:36:59', 68, 1),
(2, 5, 1, 'Medical Leave', '2019-04-29', '2019-04-26', '2019-04-26', 2, 'Medical Leave', 'Rejected', 'Rejected', '2019-04-26 14:55:01', '2019-04-26 14:55:01', 68, 1),
(3, 5, 3, 'Casual Leave', '2019-04-26', '2019-04-30', '2019-04-26', 5, 'awain', 'Pending', '', '2019-04-26 14:43:56', '0000-00-00 00:00:00', 69, 0),
(4, 6, 12, 'Medical Leave', '2019-04-28', '2019-04-28', '2019-04-27', 1, 'Tamy Pain', 'Accepted', 'Kill the waves.', '2019-04-27 07:33:27', '2019-04-27 07:33:27', 70, 1),
(5, 6, 12, 'Casual Leave', '2019-04-27', '2019-04-27', '2019-04-27', 3, 'xyz', 'Pending', '', '2019-04-27 09:17:23', '0000-00-00 00:00:00', 70, 0);

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
(1, 2, 'Sir Faraz', '35', '54687-4687465-4', 'CEO'),
(2, 4, 'Sir Ahmad', '32', '68798-7513465-4', 'KIPS Principal'),
(3, 8, 'Anas', '92', '31303-5678987-6', 'Teacher'),
(4, 9, 'Anas', '92', '31303-3456788-7', 'Teacher'),
(6, 11, 'Rana Faraz Ahmed', '92', '31303-0987654-5', 'CEO');

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
(6, 'December Test', 'December Test / Exams', '2019-03-11 09:36:44', '0000-00-00 00:00:00', 0, 0),
(7, 'Quiz', 'Subject Quiz', '2019-03-11 09:37:15', '0000-00-00 00:00:00', 0, 0),
(8, 'Assignment', 'Class Assignment', '2019-03-11 09:37:35', '0000-00-00 00:00:00', 0, 0),
(9, 'Presentation', 'Class Presentation', '2019-03-11 09:37:56', '0000-00-00 00:00:00', 0, 0),
(10, 'Sendups', 'Class Sendups', '2019-03-11 09:38:11', '0000-00-00 00:00:00', 0, 0);

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
  `exam_start_time` time NOT NULL,
  `exam_end_time` time NOT NULL,
  `exam_room` varchar(15) NOT NULL,
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

INSERT INTO `exams_criteria` (`exam_criteria_id`, `exam_category_id`, `class_id`, `exam_start_date`, `exam_end_date`, `exam_start_time`, `exam_end_time`, `exam_room`, `exam_status`, `exam_type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 6, '2019-04-12', '2019-04-19', '08:00:00', '11:00:00', 'Room-1', 'conducted', 'Regular', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `exams_schedule`
--

CREATE TABLE `exams_schedule` (
  `exam_schedule_id` int(11) NOT NULL,
  `exam_criteria_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_attendance` varchar(2) NOT NULL,
  `date` date NOT NULL,
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

INSERT INTO `exams_schedule` (`exam_schedule_id`, `exam_criteria_id`, `subject_id`, `emp_id`, `emp_attendance`, `date`, `full_marks`, `passing_marks`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 1, '', '2019-04-12', 100, 33, 'not', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3),
(2, 1, 2, 3, '', '2019-04-13', 100, 33, 'not', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3),
(3, 1, 4, 1, '', '2019-04-15', 100, 33, 'result prepared', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3),
(4, 1, 8, 1, '', '2019-04-16', 100, 33, 'not', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3),
(5, 1, 7, 4, '', '2019-04-17', 50, 17, 'not', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3),
(6, 1, 10, 3, '', '2019-04-18', 100, 33, 'not', '2019-04-19 19:13:16', '2019-04-19 19:13:16', 1, 3);

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
(1, 1001, '2019-03', 6500),
(2, 1002, '2019-03', 7000),
(3, 1003, '2019-03', 7000),
(4, 1004, '2019-03', 8000),
(5, 1005, '2019-03', 7000),
(6, 1006, '2019-04', 6000),
(7, 1007, '2019-04', 8000),
(8, 1008, '2019-04', 10000),
(9, 1009, '2019-04', 11000),
(10, 1010, '2019-04', 10000),
(11, 1011, '2019-03', 4910),
(12, 1012, '2019-03', 5000),
(13, 1013, '2019-03', 7000),
(14, 1014, '2019-03', 5000);

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
(1, 1, 1, 4000, 0, '2019-04-27 06:15:11', '0000-00-00 00:00:00', 0, 0, 1),
(2, 1, 2, 2500, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(3, 2, 1, 4000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(4, 2, 2, 3000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(5, 3, 1, 4000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(6, 3, 2, 3000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(7, 4, 1, 5000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(8, 4, 2, 3000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(9, 5, 1, 4000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(10, 5, 2, 3000, 0, '2019-04-27 06:15:12', '0000-00-00 00:00:00', 0, 0, 1),
(11, 6, 2, 2500, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(12, 6, 8, 3500, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(13, 7, 2, 3000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(14, 7, 8, 5000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(15, 8, 2, 3000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(16, 8, 8, 7000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(17, 9, 2, 3000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(18, 9, 8, 8000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(19, 10, 2, 3000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(20, 10, 8, 7000, 0, '2019-04-27 06:18:40', '0000-00-00 00:00:00', 0, 0, 1),
(21, 11, 1, 2955, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(22, 11, 2, 1955, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(23, 12, 1, 3000, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(24, 12, 2, 2000, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(25, 13, 1, 4000, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(26, 13, 2, 3000, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(27, 14, 1, 3000, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1),
(28, 14, 2, 2000, 0, '2019-04-29 08:00:21', '0000-00-00 00:00:00', 0, 0, 1);

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
(1, 1001, 6, 11, 6, 11, 1, 'zahid saeed', '', '2019-04-27 11:15:11', 6500, 3000, 3500, '2019-04-27 11:17:32', 'Added to next month', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(2, 1002, 6, 11, 6, 11, 30, 'Asmat Ara', '', '2019-04-27 11:15:12', 7000, 2000, 5000, '2019-04-27 11:17:53', 'Added to next month', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(3, 1003, 6, 11, 6, 11, 46, 'Wqas', '', '2019-04-27 11:15:12', 7000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(4, 1004, 6, 11, 6, 11, 54, 'Inam', '', '2019-04-27 11:15:12', 8000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(5, 1005, 6, 11, 6, 11, 47, 'Sheeza ', '', '2019-04-27 11:15:12', 7000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(6, 1006, 6, 11, 6, 11, 1, 'zahid saeed', '', '2019-04-27 11:18:40', 6000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(7, 1007, 6, 11, 6, 11, 30, 'Asmat Ara', '', '2019-04-27 11:18:40', 8000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(8, 1008, 6, 11, 6, 11, 46, 'Wqas', '', '2019-04-27 11:18:40', 10000, 4000, 6000, '2019-04-27 11:20:38', 'Added to next month', '2019-04-29 08:00:20', '0000-00-00 00:00:00', 4, 0, 1),
(9, 1009, 6, 11, 6, 11, 54, 'Inam', '', '2019-04-27 11:18:40', 11000, 3000, 8000, '2019-04-27 11:19:58', 'Added to next month', '2019-04-29 08:00:20', '0000-00-00 00:00:00', 4, 0, 1),
(10, 1010, 6, 11, 6, 11, 47, 'Sheeza ', '', '2019-04-27 11:18:40', 10000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-27 06:18:40', '0000-00-00 00:00:00', 4, 0, 1),
(11, 1011, 5, 1, 4, 3, 5, 'Aniqa Gull', '', '2019-04-29 13:00:20', 4910, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-29 08:00:20', '0000-00-00 00:00:00', 1, 0, 1),
(12, 1012, 5, 1, 4, 3, 8, 'Sadia Gull', '', '2019-04-29 13:00:21', 5000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-29 08:00:21', '0000-00-00 00:00:00', 1, 0, 1),
(13, 1013, 5, 1, 4, 3, 11, 'Fatima Bibi ', '', '2019-04-29 13:00:21', 7000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-29 08:00:21', '0000-00-00 00:00:00', 1, 0, 1),
(14, 1014, 5, 1, 4, 3, 18, 'Asra', '', '2019-04-29 13:00:21', 5000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-29 08:00:21', '0000-00-00 00:00:00', 1, 0, 1);

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
(2, 'ABC Learning School', 'uploads/ABC Learning School_photo.jpg', 'xyz, RYK', '2019-03-16 06:57:39', '2019-03-16 06:57:39', 1, 1, 1);

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
  `obtained_marks` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_details`
--

INSERT INTO `marks_details` (`marks_detail_id`, `marks_head_id`, `subject_id`, `obtained_marks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(7, 1, 4, '80', 68, 0, '2019-04-18 15:10:21', '0000-00-00 00:00:00'),
(8, 2, 4, '90', 68, 0, '2019-04-18 15:10:22', '0000-00-00 00:00:00'),
(9, 3, 4, 'A', 68, 3, '2019-04-18 15:13:13', '2019-04-18 15:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `marks_head`
--

CREATE TABLE `marks_head` (
  `marks_head_id` int(11) NOT NULL,
  `exam_criteria_id` int(11) NOT NULL,
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

--
-- Dumping data for table `marks_head`
--

INSERT INTO `marks_head` (`marks_head_id`, `exam_criteria_id`, `std_id`, `grand_total`, `percentage`, `grade`, `exam_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 0, '', '', '', 68, 0, '2019-04-13 06:48:20', '0000-00-00 00:00:00'),
(2, 1, 8, 0, '', '', '', 68, 0, '2019-04-13 06:48:20', '0000-00-00 00:00:00'),
(3, 1, 18, 0, '', '', '', 68, 0, '2019-04-13 06:48:21', '0000-00-00 00:00:00');

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
(1, 1, 1, 5, '2019-04-23 09:11:35', '0000-00-00 00:00:00', 1, 0),
(2, 1, 2, 5, '2019-04-23 09:11:35', '0000-00-00 00:00:00', 1, 0),
(3, 1, 3, 5, '2019-04-23 09:11:35', '0000-00-00 00:00:00', 1, 0),
(4, 1, 4, 5, '2019-04-23 09:11:35', '0000-00-00 00:00:00', 1, 0),
(5, 1, 6, 80, '2019-04-23 09:11:35', '0000-00-00 00:00:00', 1, 0),
(6, 2, 1, 5, '2019-04-23 12:26:23', '0000-00-00 00:00:00', 1, 0),
(7, 2, 2, 5, '2019-04-23 12:26:23', '0000-00-00 00:00:00', 1, 0),
(8, 2, 3, 5, '2019-04-23 12:26:23', '0000-00-00 00:00:00', 1, 0),
(9, 2, 4, 5, '2019-04-23 12:26:23', '0000-00-00 00:00:00', 1, 0),
(10, 2, 6, 80, '2019-04-23 12:26:23', '0000-00-00 00:00:00', 1, 0);

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
(1, 5, 4, 1, '2019-04-23 11:30:11', '0000-00-00 00:00:00', 1, 0),
(2, 5, 4, 2, '2019-04-23 12:26:23', '0000-00-00 00:00:00', 1, 0);

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
(1, 1, 11, 14, '6th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'signed', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1),
(4, 5, 1, 5, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'signed', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(7, 8, 1, 5, 'KG', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'signed', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(8, 11, 1, 5, '4th', 2018, 12345, 1100, 880, 'A', '80%', 'National Garrison ', 'signed', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(9, 12, 4, 8, '9th', 2018, 12345, 1100, 880, 'A', '80%', 'National Garrison ', 'unsign', '2019-03-29 16:28:53', '0000-00-00 00:00:00', 1, 0, 1),
(10, 14, 2, 6, '10th', 0, 12345, 111, 111, 'A+', '100%', 'Colony High School', 'unsign', '2019-04-06 07:48:09', '0000-00-00 00:00:00', 1, 0, 1),
(11, 18, 1, 5, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'National Garrison ', 'signed', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(12, 20, 4, 8, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-03-30 08:16:47', '0000-00-00 00:00:00', 1, 0, 1),
(13, 21, 4, 8, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-03-30 08:18:35', '0000-00-00 00:00:00', 1, 0, 1),
(14, 22, 4, 8, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-03-30 08:19:18', '0000-00-00 00:00:00', 1, 0, 1),
(15, 26, 6, 10, '9th', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'unsign', '2019-03-30 09:14:55', '0000-00-00 00:00:00', 1, 0, 1),
(16, 27, 8, 12, '10th', NULL, 12345, NULL, NULL, 'F', '', 'Colony High School', 'unsign', '2019-03-30 09:20:29', '0000-00-00 00:00:00', 1, 0, 1),
(17, 30, 11, 14, '4th', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'signed', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 1, 0, 1),
(18, 31, 3, 7, '', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'unsign', '2019-04-01 11:06:08', '0000-00-00 00:00:00', 1, 0, 1),
(19, 33, 6, 10, 'Matric', NULL, 265641, 1050, 2018, 'B+', '71%', 'National Garrison ', 'unsign', '2019-04-02 07:26:26', '0000-00-00 00:00:00', 1, 0, 1),
(20, 37, 6, 10, 'Matric', NULL, 265641, 1050, 2018, 'B+', '71%', 'National Garrison ', 'unsign', '2019-04-02 07:29:38', '0000-00-00 00:00:00', 1, 0, 1),
(21, 39, 6, 10, 'Matric', NULL, 265641, 1050, 2018, 'B+', '71%', 'National Garrison ', 'unsign', '2019-04-02 07:33:07', '0000-00-00 00:00:00', 1, 0, 1),
(22, 40, 6, 10, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'unsign', '2019-04-02 08:40:52', '0000-00-00 00:00:00', 17, 0, 1),
(23, 42, 6, 10, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'unsign', '2019-04-02 08:42:26', '0000-00-00 00:00:00', 17, 0, 1),
(24, 45, 6, 10, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'unsign', '2019-04-02 08:46:11', '0000-00-00 00:00:00', 17, 0, 1),
(25, 46, 11, 14, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'signed', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 17, 0, 1),
(26, 47, 11, 14, '', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'signed', '2019-04-27 06:11:29', '0000-00-00 00:00:00', 1, 0, 1),
(27, 48, 3, 7, 'Nursery', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'unsign', '2019-04-04 05:08:15', '0000-00-00 00:00:00', 1, 0, 1),
(28, 50, 3, 7, 'Nursery', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'unsign', '2019-04-04 05:11:53', '0000-00-00 00:00:00', 1, 0, 1),
(29, 52, 3, 7, 'Nursery', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'unsign', '2019-04-04 05:14:51', '0000-00-00 00:00:00', 1, 0, 1),
(30, 53, 2, 6, 'KG-1', NULL, NULL, NULL, NULL, 'F', '', 'National Garrison ', 'unsign', '2019-04-27 06:09:39', '0000-00-00 00:00:00', 1, 0, 1),
(31, 54, 11, 14, '', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'signed', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 1, 'STD-Y19-2', 'KG--Gr19-1', 5, 'Aniqa Gull', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1, 'STD-Y19-6', 'KG--Gr19-2', 8, 'Sadia Gull', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(3, 1, 'STD-Y19-9', 'KG--Gr19-3', 11, 'Fatima Bibi ', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(4, 1, 'STD-Y19-15', 'KG--Gr19-4', 18, 'Asra', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(5, 2, 'STD-Y19-1', '7th-Re19-1', 1, 'zahid saeed', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1),
(6, 2, 'STD-Y19-28', '7th-Re19-2', 30, 'Asmat Ara', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1),
(7, 2, 'STD-Y19-46', '7th-Re19-3', 46, 'Wqas', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1),
(9, 2, 'STD-Y19-54', '7th-Re19-5', 54, 'Inam', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1),
(10, 2, 'STD-Y19-47', '7th-Re19-6', 47, 'Sheeza ', '2019-04-27 06:11:28', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 5, 1, 4, 3, 'KG-1-2019 - 2020 -Green', '2019-04-27 06:02:28', '0000-00-00 00:00:00', 1, 0, 1),
(2, 6, 11, 6, 11, '7th-2019 - 2020-Red', '2019-04-27 06:10:14', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 1, 5000, 1000, 4000, 0, 2500, '2019-03-20 06:42:01', '0000-00-00 00:00:00', 4, 0, 1),
(2, 5, 3000, 45, 2955, 45, 1955, '2019-03-21 12:37:27', '0000-00-00 00:00:00', 1, 0, 1),
(4, 8, 3000, 0, 3000, 0, 2000, '2019-03-21 12:51:47', '0000-00-00 00:00:00', 1, 0, 1),
(5, 11, 4000, 0, 4000, 0, 3000, '2019-03-29 16:22:47', '0000-00-00 00:00:00', 1, 0, 1),
(6, 12, 4000, 0, 4000, 0, 3000, '2019-03-29 16:28:53', '0000-00-00 00:00:00', 1, 0, 1),
(7, 14, 3000, 0, 3000, 0, 2000, '2019-03-30 08:01:03', '0000-00-00 00:00:00', 1, 0, 1),
(8, 18, 3000, 0, 3000, 0, 2000, '2019-03-30 08:09:30', '0000-00-00 00:00:00', 1, 0, 1),
(9, 20, 4000, 0, 4000, 0, 3000, '2019-03-30 08:16:48', '0000-00-00 00:00:00', 1, 0, 1),
(10, 21, 4000, 0, 4000, 0, 3000, '2019-03-30 08:18:35', '0000-00-00 00:00:00', 1, 0, 1),
(11, 22, 4000, 0, 4000, 0, 3000, '2019-03-30 08:19:18', '0000-00-00 00:00:00', 1, 0, 1),
(12, 26, 4000, 0, 4000, 0, 3000, '2019-03-30 09:14:55', '0000-00-00 00:00:00', 1, 0, 1),
(13, 27, 4000, 0, 4000, 0, 3000, '2019-03-30 09:20:29', '0000-00-00 00:00:00', 1, 0, 1),
(14, 30, 4000, 0, 4000, 0, 3000, '2019-04-01 10:58:14', '0000-00-00 00:00:00', 1, 0, 1),
(15, 31, 3000, 0, 3000, 0, 2000, '2019-04-01 11:06:08', '0000-00-00 00:00:00', 1, 0, 1),
(16, 33, 4000, 0, 4000, 100, 2900, '2019-04-02 07:26:26', '0000-00-00 00:00:00', 1, 0, 1),
(17, 37, 4000, 0, 4000, 100, 2900, '2019-04-02 07:29:38', '0000-00-00 00:00:00', 1, 0, 1),
(18, 39, 4000, 0, 4000, 100, 2900, '2019-04-02 07:33:07', '0000-00-00 00:00:00', 1, 0, 1),
(19, 40, 4000, 0, 4000, 0, 3000, '2019-04-02 08:40:52', '0000-00-00 00:00:00', 17, 0, 1),
(20, 42, 4000, 0, 4000, 0, 3000, '2019-04-02 08:42:26', '0000-00-00 00:00:00', 17, 0, 1),
(21, 45, 4000, 0, 4000, 0, 3000, '2019-04-02 08:46:11', '0000-00-00 00:00:00', 17, 0, 1),
(22, 46, 4000, 0, 4000, 0, 3000, '2019-04-02 08:50:28', '0000-00-00 00:00:00', 17, 0, 1),
(23, 47, 4000, 0, 4000, 0, 3000, '2019-04-02 09:00:30', '0000-00-00 00:00:00', 1, 0, 1),
(24, 48, 3000, 0, 3000, 200, 1800, '2019-04-04 05:08:15', '0000-00-00 00:00:00', 1, 0, 1),
(25, 50, 3000, 0, 3000, 200, 1800, '2019-04-04 05:11:53', '0000-00-00 00:00:00', 1, 0, 1),
(26, 52, 3000, 0, 3000, 200, 1800, '2019-04-04 05:14:51', '0000-00-00 00:00:00', 1, 0, 1),
(27, 53, 3000, 0, 3000, 200, 1800, '2019-04-04 06:58:51', '0000-00-00 00:00:00', 1, 0, 1),
(28, 54, 5000, 0, 5000, 0, 3000, '2019-04-06 07:28:03', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 1, 'M Saeed', 'Father', '45678-9098765-4', 'ahmed@gmail.com', '+92-567-8987656', '+92-567-8987654', 45000, 'Govt. Employe', 'ghjnbv', '', '2019-03-20 06:42:01', '0000-00-00 00:00:00', 4, 0, 1),
(5, 5, 'M. Ahmed', 'Father', '31303-1234567-8', 'ahmed@gmail.com', '+92-300-7976242', '', 45000, 'Govt. Employe', '', '', '2019-04-18 08:10:10', '0000-00-00 00:00:00', 1, 0, 1),
(8, 8, 'M Saeed', 'Father', '31303-4567890-9', 'ahmed@gmail.com', '+92-345-6789009', '', 45000, 'Govt. Employe', '', '', '2019-03-21 12:51:46', '0000-00-00 00:00:00', 1, 0, 1),
(11, 11, 'M.Ibrahim', 'Father', '31303-6854548-9', 'ibrahim@yahoo.com', '+92-345-0784638', '+92-764-8378347', 60000, 'Self Business', '', '', '2019-03-29 16:22:46', '0000-00-00 00:00:00', 1, 0, 1),
(12, 12, 'M.Ibrahim', 'Father', '31303-2345678-9', 'ibrahim@yahoo.com', '+92-234-5678909', '', 60000, 'Govt. Employe', '', '', '2019-03-29 16:28:52', '0000-00-00 00:00:00', 1, 0, 1),
(14, 14, 'wwwwww', 'wwwwww', '22222-2222222-2', 'ahmed@gmail.com', '+22-222-2222222', '+22-222-2222222', 22222222, 'qqqqqqq', 'wwwwww', '', '2019-03-30 08:01:02', '0000-00-00 00:00:00', 1, 0, 1),
(15, 18, 'M. Ahmed', 'Father', '55555-5555555-5', 'ibrahim@yahoo.comj', '+55-555-5555555', '+88-888-8888888', 45000, 'Self Business', 'wwwwww', '', '2019-03-30 08:09:29', '0000-00-00 00:00:00', 1, 0, 1),
(17, 20, 'M.Ibrahimkbkjhj', 'Father', '44444-4444444-4', 'ahmed@gmail.comkkkk', '+55-555-5555555', '', 45000, 'Govt. Employe', '', '', '2019-03-30 08:16:46', '0000-00-00 00:00:00', 1, 0, 1),
(18, 21, 'M.Ibrahimkbkjhjkkk', 'Father', '44444-4444444-4', 'ahmed@gmail.comkkkkmm', '+55-555-5555555', '', 45000, 'Govt. Employe', '', '', '2019-03-30 08:18:34', '0000-00-00 00:00:00', 1, 0, 1),
(19, 22, 'M.Ibrahimkbkjhjkkksss', 'Father', '44444-4444444-4', 'ahmed@gmail.comkkkkmm111', '+55-555-5555555', '', 45000, 'Govt. Employe', '', '', '2019-03-30 08:19:17', '0000-00-00 00:00:00', 1, 0, 1),
(22, 26, 'M.Ibrahim', 'Father', '31303-3456789-1', 'ibrahim@gmail.com', '+92-234-5678907', '', NULL, '', '', '', '2019-03-30 09:14:54', '0000-00-00 00:00:00', 1, 0, 1),
(23, 27, 'Iftikhar Ali', 'Father', '31303-9876543-0', 'iftikhar@gmail.com', '+92-234-5678998', '', NULL, '', '', '', '2019-03-30 09:20:28', '0000-00-00 00:00:00', 1, 0, 1),
(26, 30, 'M.Shafi', 'Father', '98765-4312345-6', 'shafi@gmail.com', '+92-345-6789876', '', NULL, '', '', '', '2019-04-01 10:58:13', '0000-00-00 00:00:00', 1, 0, 1),
(27, 31, 'M.Ameen', 'Father', '34567-8909876-5', 'ameen@gmail.com', '+92-456-7899876', '', NULL, '', '', '', '2019-04-01 11:06:07', '0000-00-00 00:00:00', 1, 0, 1),
(28, 33, 'M Saeed', 'Father', '31303-0437738-3', 'anasshafqat@gmail.com', '+92-331-3772105', '', 45000, 'Govt. Employe', 'Engineer', '', '2019-04-02 07:26:25', '0000-00-00 00:00:00', 1, 0, 1),
(29, 37, 'M Saeed', 'Father', '31303-0437738-4', 'anasshafqat001@gmail.com', '+92-331-3772105', '', 45000, 'Govt. Employe', 'Engineer', '', '2019-04-02 07:29:37', '0000-00-00 00:00:00', 1, 0, 1),
(30, 39, 'M Saeed', 'Father', '31303-0438738-4', 'anasshafqat021@gmail.com', '+92-331-3772105', '', 45000, 'Govt. Employe', 'Engineer', '', '2019-04-02 07:33:06', '0000-00-00 00:00:00', 1, 0, 1),
(31, 40, 'Umer', 'Father', '31303-7655676-4', 'umer@gmail.com', '+92-315-8410500', '', NULL, '', '', '', '2019-04-02 08:40:51', '0000-00-00 00:00:00', 17, 0, 1),
(32, 42, 'Umer', 'Father', '31303-7655876-4', 'umer01@gmail.com', '+92-315-8410500', '', NULL, '', '', '', '2019-04-02 08:42:25', '0000-00-00 00:00:00', 17, 0, 1),
(33, 45, 'Umer', 'Father', '31303-8655876-4', 'umer02@gmail.com', '+92-315-8410500', '', NULL, '', '', '', '2019-04-02 08:46:10', '0000-00-00 00:00:00', 17, 0, 1),
(34, 46, 'Umer', 'Father', '31303-8675876-4', 'umer03@gmail.com', '+92-315-8410500', '', NULL, '', '', '', '2019-04-02 08:50:27', '0000-00-00 00:00:00', 17, 0, 1),
(35, 47, 'Umer', 'Father', '31303-6546676-7', 'mumer@gmail.com', '+92-456-7898765', '', NULL, '', '', '', '2019-04-02 09:00:29', '0000-00-00 00:00:00', 1, 0, 1),
(36, 48, 'M. Saeed', 'Father', '31303-0437738-3', '', '+92-331-7375027', '', 60000, 'Self Business', 'wwwwww', '', '2019-04-04 05:08:15', '0000-00-00 00:00:00', 1, 0, 1),
(37, 50, 'M. Saeed', 'Father', '31303-0437738-4', '', '+92-331-7375027', '', 60000, 'Self Business', 'wwwwww', '', '2019-04-04 05:11:53', '0000-00-00 00:00:00', 1, 0, 1),
(38, 52, 'M. Saeed', 'Father', '31303-0437738-5', '', '+92-331-7375027', '', 60000, 'Self Business', 'wwwwww', '', '2019-04-04 05:14:50', '0000-00-00 00:00:00', 1, 0, 1),
(39, 53, 'Asad Shafqat', 'Father', '31303-0437738-5', '', '+92-306-3772105', '', 45000, '', '', '1012', '2019-04-04 06:58:50', '0000-00-00 00:00:00', 1, 0, 1),
(40, 54, 'Umer', 'Father', '31303-5678987-8', '', '+92-331-7375027', '', 45000, '', '', '8238', '2019-04-06 07:28:02', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 1, 'Anas', 'Mamu Gjjlij', '+92-456-7899876', 'Gulshan Iqbal', '2019-03-20 06:42:01', 4, '0000-00-00 00:00:00', 0, 1),
(5, 5, 'Anas', 'Mamu Gjjlij', '+92-234-5678987', 'Gulshan Iqbal', '2019-03-21 12:37:27', 1, '0000-00-00 00:00:00', 0, 1),
(8, 8, 'Anas', 'Cousin', '+92-345-6789009', 'Gulshan Iqbal', '2019-03-21 12:51:46', 1, '0000-00-00 00:00:00', 0, 1),
(9, 11, 'Aniqa Gull', 'Dost ', '+92-678-0980808', 'Jaddah Town RYK', '2019-03-29 16:22:47', 1, '0000-00-00 00:00:00', 0, 1),
(10, 12, 'Anas', 'Cousin', '+92-234-5678765', 'Jaddah Town RYK', '2019-03-29 16:28:53', 1, '0000-00-00 00:00:00', 0, 1),
(12, 14, 'sss', 'sssss', '+22-222-2222222', 'sssssss', '2019-03-30 08:01:03', 1, '0000-00-00 00:00:00', 0, 1),
(13, 18, 'bbbbbbbb', 'Mamu Gjjlij', '+22-222-2222222', 'Gulshan Iqbal', '2019-03-30 08:09:30', 1, '0000-00-00 00:00:00', 0, 1),
(14, 20, 'kmklm', 'lkjnl', '+54-444-4444444', 'sssssss', '2019-03-30 08:16:47', 1, '0000-00-00 00:00:00', 0, 1),
(15, 21, 'kmklm', 'lkjnl', '+54-444-4444444', 'sssssss', '2019-03-30 08:18:35', 1, '0000-00-00 00:00:00', 0, 1),
(16, 22, 'kmklm', 'lkjnl', '+54-444-4444444', 'sssssss', '2019-03-30 08:19:18', 1, '0000-00-00 00:00:00', 0, 1),
(17, 26, 'bbbbbbbb', '', '', '', '2019-03-30 09:14:55', 1, '0000-00-00 00:00:00', 0, 1),
(18, 27, 'Aniqa Gull', '', '', '', '2019-03-30 09:20:29', 1, '0000-00-00 00:00:00', 0, 1),
(19, 30, 'Aniqa Gull', '', '', '', '2019-04-01 10:58:14', 1, '0000-00-00 00:00:00', 0, 1),
(20, 31, 'Shahid', '', '', '', '2019-04-01 11:06:08', 1, '0000-00-00 00:00:00', 0, 1),
(21, 33, 'Anas', '', '', '', '2019-04-02 07:26:26', 1, '0000-00-00 00:00:00', 0, 1),
(22, 37, 'Anas', '', '', '', '2019-04-02 07:29:38', 1, '0000-00-00 00:00:00', 0, 1),
(23, 39, 'Anas', '', '', '', '2019-04-02 07:33:07', 1, '0000-00-00 00:00:00', 0, 1),
(24, 40, 'Aniqa Gull', '', '', '', '2019-04-02 08:40:52', 17, '0000-00-00 00:00:00', 0, 1),
(25, 42, 'Aniqa Gull', '', '', '', '2019-04-02 08:42:26', 17, '0000-00-00 00:00:00', 0, 1),
(26, 45, 'Aniqa Gull', '', '', '', '2019-04-02 08:46:11', 17, '0000-00-00 00:00:00', 0, 1),
(27, 46, 'Aniqa Gull', '', '', '', '2019-04-02 08:50:28', 17, '0000-00-00 00:00:00', 0, 1),
(28, 47, 'Shahid', '', '', '', '2019-04-02 09:00:30', 1, '0000-00-00 00:00:00', 0, 1),
(29, 48, 'Anas', '', '', '', '2019-04-04 05:08:15', 1, '0000-00-00 00:00:00', 0, 1),
(30, 50, 'Anas', '', '', '', '2019-04-04 05:11:53', 1, '0000-00-00 00:00:00', 0, 1),
(31, 52, 'Anas', '', '', '', '2019-04-04 05:14:51', 1, '0000-00-00 00:00:00', 0, 1),
(32, 53, 'Anas', 'Uncle', '+92-331-7375027', '', '2019-04-04 06:58:51', 1, '0000-00-00 00:00:00', 0, 1),
(33, 54, 'Aniqa Gull', '', '', '', '2019-04-06 07:28:03', 4, '0000-00-00 00:00:00', 0, 1);

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
(1, 6, 'STD-Y19-1', 'zahid saeed', 'M saeed', '+92-567-8909876', '2019-03-20', 'Male', 'RYK', 'RYK', 'zahid@gmail.com', 'uploads/zahid saeed_photo.jpg', '92876-5456789-8', 'RYK', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '2019-03-20 06:42:01', '0000-00-00 00:00:00', 4, 0, 1),
(5, 5, 'STD-Y19-2', 'Aniqa Gull', 'Iftikhar Ali', '+92-345-6789876', '2019-03-21', 'Female', 'RYK', 'RYK', 'asra@gmail.com', 'uploads/Aniqa Gull_photo.jpg', '31303-3456789-8', 'RYK', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '2019-04-19 11:46:17', '2019-04-19 11:46:17', 1, 3, 1),
(8, 5, 'STD-Y19-6', 'Sadia Gull', 'Iftikhar Ali', '+92-456-7890987', '2019-03-21', 'Female', 'RYK', 'RYK', 'sadia@gmail.com', 'uploads/Sadia Gull_photo.jpg', '31303-3456789-0', 'RYK', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '2019-03-21 12:51:46', '0000-00-00 00:00:00', 1, 0, 1),
(11, 5, 'STD-Y19-9', 'Fatima Bibi ', 'M. Ibrahim ', '+92-098-7654326', '2019-03-29', 'Female', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'fatim44@gmail.com', 'uploads/Fatima Bibi _photo.jpg', '09876-5421223-4', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-29 16:22:45', '0000-00-00 00:00:00', 1, 0, 1),
(12, 5, 'STD-Y19-12', 'Ihsan-ul-Haq', 'M. Ahmed', '+92-876-5433456', '2019-03-29', 'Male', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'ihsan@gmail.com', 'uploads/Ihsan-ul-Haq_photo.jpg', '31303-9876543-3', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-29 16:28:50', '0000-00-00 00:00:00', 1, 0, 1),
(14, 5, 'STD-Y19-13', 'Testing 1', 'M. Ahmed', '', '2019-03-30', 'Male', 'wwwwwww', 'wwwwwwww', '', 'uploads/Testing 1_photo.jpg', '22222-2222222-2', 'asdsa', 'wwwwwww', 'wwwww', 'qqqqqq', '', 'Active', 'Active', '2019-03-30 08:01:01', '0000-00-00 00:00:00', 1, 0, 1),
(18, 5, 'STD-Y19-15', 'Asra', 'Mustafa', '', '2019-07-10', 'Male', 'RYK', 'RYK', 'fatim44@gmail.comj', 'uploads/Asra_photo.jpg', '55555-5555555-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '2019-03-30 08:09:28', '0000-00-00 00:00:00', 1, 0, 1),
(20, 5, 'STD-Y19-19', 'uygjgv', 'ggfg', '+32-222-2222222', '2019-03-05', 'Female', 'RYK', '', 'hdfgd@gvjv.com', 'uploads/uygjgv_photo.jpg', '55555-5555555-5', 'asdsa', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-30 08:16:45', '0000-00-00 00:00:00', 1, 0, 1),
(21, 5, 'STD-Y19-21', 'uygjgvhbhjbj', 'ggfg', '+32-222-2222222', '2019-03-05', 'Female', 'RYK', '', 'hdfgd@gvjv.commmm', 'uploads/uygjgvhbhjbj_photo.jpg', '55555-5555555-5', 'asdsa', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-30 08:18:32', '0000-00-00 00:00:00', 1, 0, 1),
(22, 5, 'STD-Y19-22', 'uygjgvhbhjbjmoiio', 'ggfg', '+32-222-2222222', '2019-03-05', 'Female', 'RYK', '', 'hdfgd@gvjv.commmm444', 'uploads/uygjgvhbhjbjmoiio_photo.jpg', '55555-5555555-5', 'asdsa', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-30 08:19:16', '0000-00-00 00:00:00', 1, 0, 1),
(26, 5, 'STD-Y19-23', 'zahid saeed', 'Mustafa', '+92-234-5678900', '2019-03-30', 'Male', 'Jinnah Park RYK', '', 'zahid@gmail.com', 'uploads/std_default.jpg', '31303-3456789-0', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-30 09:14:53', '0000-00-00 00:00:00', 1, 0, 1),
(27, 5, 'STD-Y19-27', 'Nadia Gull', 'Iftikhar Ali', '+92-345-6789098', '2019-03-30', 'Female', 'Jinnah Park RYK', '', 'nadia@gmail.com', 'uploads/std_default.jpg', '31303-1123456-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-03-30 09:20:27', '0000-00-00 00:00:00', 1, 0, 1),
(30, 6, 'STD-Y19-28', 'Asmat Ara', 'M.Shafi', '+92-345-6789098', '2019-04-01', 'Female', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'asmat@gmail.com', 'uploads/Asmat Ara_photo.jpg', '31303-2345698-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-27 06:06:27', '0000-00-00 00:00:00', 1, 0, 1),
(31, 5, 'STD-Y19-31', 'Aisha Ameen', 'M.Ameen', '+92-456-7898765', '2019-04-01', 'Female', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'aisha@gmail.com', 'uploads/Aisha Ameen_photo.jpg', '87654-3236789-0', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-01 11:06:06', '0000-00-00 00:00:00', 1, 0, 1),
(33, 5, 'STD-Y19-32', 'Saif-ur-Rehman', 'M. Khalil', '+92-333-3333333', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', 'Chak # 145/p, Adaam Sahaba', 'saif@gmail.com', 'uploads/std_default.jpg', '31303-4944949-4', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-02 07:26:24', '0000-00-00 00:00:00', 1, 0, 1),
(37, 5, 'STD-Y19-34', 'Saif-ur-Rehman', 'M. Khalil', '+92-333-3333333', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', 'Chak # 145/p, Adaam Sahaba', 'saif02@gmail.com', 'uploads/std_default.jpg', '31303-4944949-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-02 07:29:36', '0000-00-00 00:00:00', 1, 0, 1),
(39, 5, 'STD-Y19-38', 'Saif-ur-Rehman', 'M. Khalil', '+92-333-3333333', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', 'Chak # 145/p, Adaam Sahaba', 'saif03@gmail.com', 'uploads/std_default.jpg', '31303-4977949-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-02 07:33:05', '0000-00-00 00:00:00', 1, 0, 1),
(40, 5, 'STD-Y19-40', 'Wqas', 'Umer', '+92-345-6789098', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas@gmail.com', 'uploads/std_default.jpg', '31303-8765670-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-02 08:40:50', '0000-00-00 00:00:00', 17, 0, 1),
(42, 5, 'STD-Y19-41', 'Wqas', 'Umer', '+92-345-6789098', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas01@gmail.com', 'uploads/std_default.jpg', '31303-8765679-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-02 08:42:24', '0000-00-00 00:00:00', 17, 0, 1),
(45, 5, 'STD-Y19-43', 'Wqas', 'Umer', '+92-345-6789698', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas02@gmail.com', 'uploads/std_default.jpg', '31303-8785679-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-02 08:46:08', '0000-00-00 00:00:00', 17, 0, 1),
(46, 6, 'STD-Y19-46', 'Wqas', 'Umer', '+92-345-6789698', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas03@gmail.com', 'uploads/std_default.jpg', '31303-8385679-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-26 08:35:32', '0000-00-00 00:00:00', 17, 0, 1),
(47, 6, 'STD-Y19-47', 'Sheeza ', 'Umer', '', '2019-04-02', 'Female', 'Chak # 145/p, Adaam Sahaba', '', 'sheeza@gmail.com', 'uploads/Sheeza _photo.jpg', '31303-7654456-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-26 08:35:18', '0000-00-00 00:00:00', 1, 0, 1),
(48, 5, 'STD-Y19-48', 'Zahid Saeed', 'M. Saeed', '+92-331-7375025', '2015-02-03', 'Male', 'RYK', 'Chak # 145/p, Adaam Sahaba', 'zahid@gmail.com', 'uploads/Zahid Saeed_photo.jpg', '31303-8489489-4', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-04 05:08:14', '0000-00-00 00:00:00', 1, 0, 1),
(50, 5, 'STD-Y19-49', 'Zahid Saeed', 'M. Saeed', '+92-331-7375025', '2015-02-03', 'Male', 'RYK', 'Chak # 145/p, Adaam Sahaba', 'zahid@gmail.com', 'uploads/Zahid Saeed_photo.jpg', '31303-8489489-3', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-04 05:11:52', '0000-00-00 00:00:00', 1, 0, 1),
(52, 5, 'STD-Y19-51', 'Zahid Saeed', 'M. Saeed', '+92-331-7375025', '2015-02-03', 'Male', 'RYK', 'Chak # 145/p, Adaam Sahaba', 'zahid@gmail.com', 'uploads/Zahid Saeed_photo.jpg', '31303-8489489-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '2019-04-04 05:14:49', '0000-00-00 00:00:00', 1, 0, 1),
(53, 5, 'STD-Y19-53', 'M. Azaan', 'Asad Shafqat', '+92-333-3333333', '2019-04-04', 'Male', 'RYK', 'RYK', '', 'uploads/std_default.jpg', '31303-0561894-8', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'RYK', '9127', 'Active', 'Active', '2019-04-04 06:58:49', '0000-00-00 00:00:00', 1, 0, 1),
(54, 6, 'STD-Y19-54', 'Inam', 'Umer', '+92-345-6789987', '2019-04-06', 'Female', 'Jinnah Park RYK', '', '', 'uploads/std_default.jpg', '31303-4567777-7', 'RYK', 'Islam', 'Pakistani', 'RYK', '3561', 'Active', 'Active', '2019-04-06 07:28:01', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 1, 0, 2, 8, '2 Lectures', '2019-04-27 06:28:49', '0000-00-00 00:00:00', 4, 0, 1);

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
(1, 12, 'Muhammad Saif ', '2019-04-27 06:28:49', '0000-00-00 00:00:00', 4, 0, 1);

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
(5, 5, 'Ihsan-ul-Haq', '', 'Ihsan-ul-Haq', 'ihsan@gmail.com', 'Student', 'YhAUQBMAbxKoGoOKQUCYtRmSzeGVgTkC', '$2y$13$slaoR8WgBm/Cw8xf7s42uOpzu3rzlyQOA3IITvE..uJQq5q42boni', NULL, 'uploads/Ihsan-ul-Haq_photo.jpg', 1, 10, 1553876932, 1553876932),
(6, 5, 'M.Ibrahim', '', 'M.Ibrahim', 'ibrahim@yahoo.com', 'Parent', '1TDh1_yAaACE06N-3zYlwKkdSrd4XGZw', '$2y$13$foDb1DlWdzSNXASbTBydL.K8fg4W/gu6DpZJGvGdnQ2CLg2SHU5Ai', NULL, 'uploads/Ihsan-ul-Haq_photo.jpg', 1, 10, 1553876933, 1553876933),
(9, 5, 'Testing 1', '', 'Testing 1', '', 'Student', 'MqOnmKAzSW2OggPy8wlXEQPkxPVfMLP2', '$2y$13$BotKemaxfH9xIjzyLQtyV.LNhdpQ6MgFeppuzWzmfTFPkobjGW2Lq', NULL, 'uploads/Testing 1_photo.jpg', 1, 10, 1553932862, 1553932862),
(10, 5, 'wwwwww', '', 'wwwwww', 'ahmed@gmail.com', 'Parent', '3h5HuNHkjAoU-d7uxte1geh_siugXfNP', '$2y$13$LlUR6vVGeBn9US1fkDcpi.x1lqjhdceIK8yp.MsKBlClk7Cwq4bZK', NULL, 'uploads/Testing 1_photo.jpg', 1, 10, 1553932863, 1553932863),
(13, 5, 'Asra', '', 'Asra', 'fatim44@gmail.comj', 'Student', '9o0jc8p_YOyUptheKmEV_XvmfDt7WnCv', '$2y$13$Qd2VcVAtHxGZrEm/FvQK5uEBbg/NqmDC8a66sRDNLLWuGb2Gl7DAi', NULL, 'uploads/Asra_photo.jpg', 1, 10, 1553933369, 1553933369),
(14, 5, 'M. Ahmed', '', 'M. Ahmed', 'ibrahim@yahoo.comj', 'Parent', 'juKYwUgW8CyhFNIQdIOCntRrka5qDHob', '$2y$13$om93XmCfyTx0F9AfOZQgwu4jf/AOIgShbeQrqKezWNmkMRrmDXOyS', NULL, 'uploads/Asra_photo.jpg', 1, 10, 1553933370, 1553933370),
(17, 5, 'uygjgv', '', 'uygjgv', 'hdfgd@gvjv.com', 'Student', 'hGR0UHnx97AKmWSO3_NcCwsFR1oZyjLm', '$2y$13$58OkeEG22cvRwHhvpeJVaOnys1UqAF5LALAKliF2HOhqVv1QHr6nq', NULL, 'uploads/uygjgv_photo.jpg', 1, 10, 1553933806, 1553933806),
(18, 5, 'M.Ibrahimkbkjhj', '', 'M.Ibrahimkbkjhj', 'ahmed@gmail.comkkkk', 'Parent', 'nOCgxEh_8STPgjx_vMi8pQp6tS_UItaS', '$2y$13$Ug9jVMc0aYQsf9jN9pavTOnyBoY7JW1Zlp7mX//F4BCcsIiahOogW', NULL, 'uploads/uygjgv_photo.jpg', 1, 10, 1553933807, 1553933807),
(19, 5, 'uygjgvhbhjbj', '', 'uygjgvhbhjbj', 'hdfgd@gvjv.commmm', 'Student', '9EYMJGBEpQKPd_wDDKZjxzl3WBsLDYJn', '$2y$13$BmTWlHqsEwJzOCN2Hf6kO.Dbr204Xv3qzQVo1hkaZJXVnmzrs6HhW', NULL, 'uploads/uygjgvhbhjbj_photo.jpg', 1, 10, 1553933914, 1553933914),
(20, 5, 'M.Ibrahimkbkjhjkkk', '', 'M.Ibrahimkbkjhjkkk', 'ahmed@gmail.comkkkkmm', 'Parent', 'LzRb4Ds_F7qMvpAmKI0S4XXta0Z4_vdh', '$2y$13$XYSG02DE.dlvlI9.vzluuOacn3G7JrCy0YQL5AlPGZlDx7.q9cTu2', NULL, 'uploads/uygjgvhbhjbj_photo.jpg', 1, 10, 1553933915, 1553933915),
(21, 5, 'uygjgvhbhjbjmoiio', '', 'uygjgvhbhjbjmoiio', 'hdfgd@gvjv.commmm444', 'Student', 'qjBA_eMGQsS54ifne9j-Zn1VuxEqyo3O', '$2y$13$z15I8HlXcUehkiDpM3.L/uUXETzx5GZP4fexHgUo61/h4q.u.ockS', NULL, 'uploads/uygjgvhbhjbjmoiio_photo.jpg', 1, 10, 1553933957, 1553933957),
(22, 5, 'M.Ibrahimkbkjhjkkkss', '', 'M.Ibrahimkbkjhjkkksss', 'ahmed@gmail.comkkkkmm111', 'Parent', 'SuD6UXVFTcRZihpwbUFBHCRrnAluUJ6T', '$2y$13$Iat8R.a8hr9VpweedPOahuCZLkOGlgKJ/DgEPD4VJTsS1iTeru6SW', NULL, 'uploads/uygjgvhbhjbjmoiio_photo.jpg', 1, 10, 1553933958, 1553933958),
(28, 5, '', '', '31303-3456789-0', 'zahid@gmail.com', 'Student', 'c9-oZ7eEtUJhqdlwcQ4NEwKWTqs6xyMn', '$2y$13$5qx4neqgy7ZydQm0JKycUuwXWiuFUwtqAOYlPZgqPCD1R/eypVon6', NULL, 'uploads/std_default.jpg', 1, 10, 1553937294, 1553937294),
(29, 5, '', '', '31303-3456789-1', 'ibrahim@gmail.com', 'Parent', 'NgkBxjlFlm3yTt6OLQSJhN0bdgOhqgyN', '$2y$13$hCf1PZCtoH7XAYjSE5NVgua.wZ9E/h2TCVqDuc0iPJb847KeEHRmq', NULL, 'uploads/std_default.jpg', 1, 10, 1553937295, 1553937295),
(30, 5, '', '', '31303-1123456-7', 'nadia@gmail.com', 'Student', 'ys6HuC41jCc4oSMwsN0rICo3BU4gPDMR', '$2y$13$rclLNs7PcbhW9yTXZ7ELJ.Qmcs.AYyGA5gBHPcNn2znHARhcKQRwK', NULL, 'uploads/std_default.jpg', 1, 10, 1553937628, 1553937628),
(31, 5, '', '', '31303-9876543-0', 'iftikhar@gmail.com', 'Parent', 'HDJBFBmssXY-7Z-ArlQOETapWML_Vtq_', '$2y$13$xgn0P3tFIicypl.nXcvz2e9KV5RIKKRnRgbNZ0ESedkB.xbaHiISm', NULL, 'uploads/std_default.jpg', 1, 10, 1553937629, 1553937629),
(36, 5, '', '', '31303-2345698-7', 'asmat@gmail.com', 'Student', 'fRb3hJXoJ_jaciI7boaiUIdkkiwHXYXD', '$2y$13$s14gEFeBq5ByZDKICdhUs.OxGweNmNN0JGqUQnw8FCmsy31mdExOy', NULL, 'uploads/Asmat Ara_photo.jpg', 1, 10, 1554116293, 1554116293),
(37, 5, '', '', '98765-4312345-6', 'shafi@gmail.com', 'Parent', 'UER6Cj6gxltg6x4rzwd2Q1XIvQBW53VP', '$2y$13$13drBwftKaK/0sVSepurGOVUTYZu/.t/VnYf5zjLVGWQa3BZQD3ia', NULL, 'uploads/Asmat Ara_photo.jpg', 1, 10, 1554116294, 1554116294),
(38, 5, '', '', '87654-3236789-0', 'aisha@gmail.com', 'Student', 'h-jlmTGKCBbHNnuoSoPF2DEfI7W1QCzf', '$2y$13$kA6jM/ShH8NbH1fxIlys.OcKC4bjOWI.8WZcQImk50dziNZUkklgS', NULL, 'uploads/Aisha Ameen_photo.jpg', 1, 10, 1554116767, 1554116767),
(39, 5, '', '', '34567-8909876-5', 'ameen@gmail.com', 'Parent', '6-gkPVNjnEu9YHhngAR6Byo5Z8d_xnLt', '$2y$13$xHa/Rt0ecdBYqMGAumOgTOhxJZyhn.R4Um2TquV9tV0g9OoLbsbQK', NULL, 'uploads/Aisha Ameen_photo.jpg', 1, 10, 1554116768, 1554116768),
(41, 5, '', '', '31303-4944949-4', 'saif@gmail.com', 'Student', 'AZdVtNQSIMYr8Mskq8BSLdYx-k86j2vj', '$2y$13$KCQ1UwvqHhkYyGYLtJ04iuBHXBL2jOddDfIiN/SnMZBC3t1hCEFFa', NULL, 'uploads/std_default.jpg', 1, 10, 1554189985, 1554189985),
(42, 5, '', '', '31303-0437738-3', 'anasshafqat@gmail.com', 'Parent', '8hBoUwgV3BT5e7_Cr1ndQxowe4s6vkRj', '$2y$13$NfQxk1NyWH9uJOdu7qn7beKKDh2ZsbGCTqrhVMGFzp2yWV7Xcu0WO', NULL, 'uploads/std_default.jpg', 1, 10, 1554189986, 1554189986),
(45, 5, '', '', '31303-4944949-5', 'saif02@gmail.com', 'Student', 'Jz4Ct2vVt_PhKd_aE9LlCXEsHj_K_Qx7', '$2y$13$M9H.19qDcPJYDD5ewmdRWehUEIPsL9lTduol4gr4LTE5Irm9HE9M.', NULL, 'uploads/std_default.jpg', 1, 10, 1554190177, 1554190177),
(46, 5, '', '', '31303-0437738-4', 'anasshafqat001@gmail.com', 'Parent', 'yxCyJp-x1PXdNvPegxJTnEtgecuZ6lZ1', '$2y$13$QByXz/5taD.L63zRaXnciuWMb1fcztJLww6FZEOMhmdFe1jSmmOJi', NULL, 'uploads/std_default.jpg', 1, 10, 1554190178, 1554190178),
(47, 5, '', '', '31303-4977949-5', 'saif03@gmail.com', 'Student', 'DPY4qR1BloCcrtm05aBEvwbvzWUjrfzO', '$2y$13$YplVem/a.4G5alfJgq6ju.bNb4VVXsqS97jb6IsCNalWmqk0hsQvy', NULL, 'uploads/std_default.jpg', 1, 10, 1554190386, 1554190386),
(48, 5, '', '', '31303-0438738-4', 'anasshafqat021@gmail.com', 'Parent', 'AkjFHItltztxSvNGBgnpcaBbRz2QSR7_', '$2y$13$qHR4ylBTKs5Dp2zZJsvzJ.tuKZErQ9hXUIteK2zdiANAtzel/g1mC', NULL, 'uploads/std_default.jpg', 1, 10, 1554190387, 1554190387),
(49, 5, '', '', '31303-8765670-9', 'waqas@gmail.com', 'Student', 'aG1VzSxGkDFltyO-WtRV6-ER3Z-c3bTI', '$2y$13$A3U1Q3lh2EvABFSSk8uxK.G/WVO1Wl.iI6e6qS987xugYN26tOtQi', NULL, 'uploads/std_default.jpg', 1, 10, 1554194451, 1554194451),
(50, 5, '', '', '31303-7655676-4', 'umer@gmail.com', 'Parent', 'bfl-5ycyM_tCy3EFblr1UZVRQvtp9sP5', '$2y$13$YaW.T7SaAccegVhPFZWLwOX5sdGZAZFIQhUjcXjqZ.6FuMqDnxeP2', NULL, 'uploads/std_default.jpg', 1, 10, 1554194452, 1554194452),
(51, 5, '', '', '31303-8765679-9', 'waqas01@gmail.com', 'Student', 'frEz0ytpHO_gAdthytF4lQCF0Yy3pqtX', '$2y$13$VIb6IXuS82Od9NpxgoXpuO0s8sp.t/Uy7OGH6WfQZB.4gP0ZYKX12', NULL, 'uploads/std_default.jpg', 1, 10, 1554194545, 1554194545),
(52, 5, '', '', '31303-7655876-4', 'umer01@gmail.com', 'Parent', 'ohCn22tTF0a1vDlb1EmGN97oOaeuO91j', '$2y$13$OsZZShYl0AO6MQOvj.ax0edbt9e9iDemDqe9MV2Kj4ERRnj0HD5ZO', NULL, 'uploads/std_default.jpg', 1, 10, 1554194546, 1554194546),
(54, 5, '', '', '31303-8785679-9', 'waqas02@gmail.com', 'Student', 'kBsZRR5GQD1C3l82eWqGUWkhjyCA74v8', '$2y$13$AeEwzLB7Az7vyNjwvZTyselJKcoPhydclrm8oJfxunr55RTIPLZdK', NULL, 'uploads/std_default.jpg', 1, 10, 1554194770, 1554194770),
(55, 5, '', '', '31303-8655876-4', 'umer02@gmail.com', 'Parent', 'oGx3RiIEgHRVSYILZd8kD6eALjDZOXX0', '$2y$13$2SELQvUjzhs8SV0n/AXnM.NDMkCGwEpN3WK0NByZCAn8lqZ/ncIJO', NULL, 'uploads/std_default.jpg', 1, 10, 1554194771, 1554194771),
(56, 5, '', '', '31303-8385679-9', 'waqas03@gmail.com', 'Student', 'Y9QCyCECqIfe09soiHNTIJDRJTGBHrAC', '$2y$13$gvoIpYU0EylLZY/ugQ3Ty.DCzmXk55cbTOgrH7hKADdvdtWvxB2hm', NULL, 'uploads/std_default.jpg', 1, 10, 1554195027, 1554195027),
(57, 5, '', '', '31303-8675876-4', 'umer03@gmail.com', 'Parent', '9bPWjQEYIT24LzHKyOUds82AUhWoAuv7', '$2y$13$kKA2pngdTXisBRmzeNqRQOtHZOTyayWQMrRJWn0N6OxgrHAegeQ3W', NULL, 'uploads/std_default.jpg', 1, 10, 1554195028, 1554195028),
(58, 5, '', '', '31303-7654456-7', 'sheeza@gmail.com', 'Student', 'd5jVDFqxEjaMzVjky1_zHoBXKxHvm3dV', '$2y$13$J3zavmZIiSf1pdea3XkITeJNN37xoaOhWezofv8NnZ0Mxy9bF3NBO', NULL, 'uploads/Sheeza _photo.jpg', 1, 10, 1554195629, 1554195629),
(59, 5, '', '', '31303-6546676-7', 'mumer@gmail.com', 'Parent', 'hsBBvUCe-th9rbJKn5jp3oFmq2M4HIda', '$2y$13$mfgPvfqH5QNqNKeVbSAPk.HW7L/7PWfd4doX2VlFru3vrkCeuLAkq', NULL, 'uploads/Sheeza _photo.jpg', 1, 10, 1554195630, 1554195630),
(60, 5, '', '', '31303-8489489-4', 'zahid@gmail.com', 'Student', '98SjZ6mjC5LMGmp7kIx_FmR4yx5XY5Hv', '$2y$13$QqM8vOSY5k2kAyDlLCKwxOcxcClyvt0pziSujAtV5RpkmM99Y7KA2', NULL, 'uploads/Zahid Saeed_photo.jpg', 1, 10, 1554354495, 1554354495),
(61, 5, '', '', '31303-8489489-3', 'zahid@gmail.com', 'Student', 'RaTgt9C48sYZhN5ylGqTECTM0L74QxNj', '$2y$13$CT0tZ3Z6LkCThFmHo7jhRem67NtdwdftBTgwPLJvV85RRHVoszJlG', NULL, 'uploads/Zahid Saeed_photo.jpg', 1, 10, 1554354713, 1554354713),
(62, 5, '', '', '31303-8489489-5', 'zahid@gmail.com', 'Student', 'THFxW1QSP_EJRBMlEeo2s5nSipncKdRx', '$2y$13$MxegM3CywmKpEOX9H7YHBO1KDqjw0JfvhXw2x1vsFHPq7Ezxgoel2', NULL, '', 1, 10, 1554354890, 1554354890),
(63, 5, '', '', '31303-0437738-5', '', 'Parent', '2TbJGsB0LOu3SYnbzDSfFact4AX9Uwad', '$2y$13$RfJaNj86L2/aXS1ptQ0YEevhMK9W1yM0U7OOkJVL.cHdtf2hTI516', NULL, '', 1, 10, 1554354891, 1554354891),
(64, 5, '', '', '31303-0561894-8', '', 'Student', 'Gx3-xaO4KjFlLPEhlmUFPRcwltF2Kkii', '$2y$13$pxt2LJ.4H4dv9CMCgNN0kucgw/uNcakd/cZh7ZRnmjxWugG6BbxD.', NULL, 'uploads/std_default.jpg', 1, 10, 1554361130, 1554361130),
(65, 5, '', '', '31303-3456789-8', 'sana@gmail.com', 'Employee', 'CKU0oqIQ3BDUSHjxFuBHI2jvDjPsI4Ka', '$2y$13$gPcSdvqzjZQzLE9HK/YGneH95MRW7NTWZkxzs73WhTRT2MDQOhppq', NULL, 'uploads/Sana Asad_emp_photo.jpg', 1, 10, 1554363082, 1554363082),
(66, 6, '', '', '31303-4567777-7', '', 'Student', 'XLZkURQ6aK2UiaMkNilamhS_FRnDrYfR', '$2y$13$nnGJRkuULVto2Tly2hWxyeezgK3jqMmzkcslc2HjftfpV4EF9jEXS', NULL, 'uploads/std_default.jpg', 1, 10, 1554535682, 1554535682),
(67, 6, '', '', '31303-5678987-8', '', 'Parent', 'BMpNtagvU2BB8IB5WIcl3PvSEDCvTfAb', '$2y$13$28blbQRXfZvOnAyq1aJGP.RhpoWEp/BtGnw6UNvAmmQzesE.4RhKC', NULL, 'uploads/std_default.jpg', 1, 10, 1554535683, 1554535683),
(68, 5, 'Kinza', 'Mustafa', '45102-0511722-2', 'kinza.fatima.522@gmail.com', 'Teacher', 'qEH5YVuWfMLOZ3JgdoeYjokjZSkuaj2-', '$2y$13$kKWHsv4wBumdUKy4BcasVuoaH5CDd2OoelxrJ29fnC8f6R1HI40b.', NULL, 'userphotos/45102-0511722-2_photo.jpg', 1, 10, 1555571135, 1555571135),
(69, 5, 'Nauman', '', '31303-0511722-2', 'noman@gmail.com', 'Teacher', 'LkTwwUMGN5ESQtuzyjnzLAhDSHAgLwT-', '$2y$13$udjSFi6/Or.uC/JqZQs7suWvAGj0UH0bRMdjwStlKDsasqGgpnHPi', NULL, 'userphotos/31303-0511722-2_photo.jpg', 1, 10, 1555571173, 1555571173),
(70, 6, '', '', '31303-4567687-6', 'saif@gmail.com', 'Teacher', 'O2cZSyKd5nm-H-DGmB9OjxAi4WIdlDol', '$2y$13$p7yoPBJBw3WlOPkaOhk0be/dPRpNtRMh.tPH70LFHkTIztMe8cUx.', NULL, 'uploads/Muhammad Saif _emp_photo.jpg', 1, 10, 1556346354, 1556346354),
(71, 6, '', '', '31303-1246789-2', 'farhan@gmail.com', 'Employee', '4UdwZSW0955jtN7vgAuj5ascEFx9KD7Q', '$2y$13$Hrrp.OEScfjMlTPFCHvwHOfZPqv6lg4pL2DOtWrRsEOJRzlssRDIq', NULL, 'uploads/Farhan_emp_photo.jpg', 1, 10, 1556348298, 1556348298),
(72, 5, '', '', '31304-2076970-7', 'saifarshad.6987@gmail.com', 'Teacher', 'SMInuh13bUYqgXIOABZEYTmNKJJBO98C', '$2y$13$B.qmfLJJ3iSoQ6GyNYVKUuVhStW7GBPt1BR9uW.v1.BVhgJ3r6rN.', NULL, 'uploads/Muhammad Saif Ur rehman_emp_photo.jpg', 1, 10, 1556523439, 1556523439);

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
(11, 'Parent');

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
  ADD PRIMARY KEY (`emp_designation_id`);

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
  ADD KEY `emp_designation_id` (`emp_designation_id`),
  ADD KEY `emp_branch_id` (`emp_branch_id`),
  ADD KEY `emp_type_id` (`emp_type_id`),
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
-- Indexes for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  ADD PRIMARY KEY (`exam_schedule_id`),
  ADD KEY `exam_criteria_id` (`exam_criteria_id`,`subject_id`,`emp_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `emp_id` (`emp_id`);

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
-- Indexes for table `marks_head`
--
ALTER TABLE `marks_head`
  ADD PRIMARY KEY (`marks_head_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `exam_criteria_id` (`exam_criteria_id`);

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
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `emial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `emp_departments`
--
ALTER TABLE `emp_departments`
  MODIFY `emp_department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `emp_designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emp_documents`
--
ALTER TABLE `emp_documents`
  MODIFY `emp_document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `emp_info`
--
ALTER TABLE `emp_info`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emp_reference`
--
ALTER TABLE `emp_reference`
  MODIFY `emp_ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  MODIFY `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_month_detail`
--
ALTER TABLE `fee_month_detail`
  MODIFY `month_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fee_transaction_detail`
--
ALTER TABLE `fee_transaction_detail`
  MODIFY `fee_trans_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `fee_transaction_head`
--
ALTER TABLE `fee_transaction_head`
  MODIFY `fee_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `marks_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marks_head`
--
ALTER TABLE `marks_head`
  MODIFY `marks_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marks_weightage_details`
--
ALTER TABLE `marks_weightage_details`
  MODIFY `weightage_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marks_weightage_head`
--
ALTER TABLE `marks_weightage_head`
  MODIFY `marks_weightage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `std_academic_info`
--
ALTER TABLE `std_academic_info`
  MODIFY `academic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `std_attendance`
--
ALTER TABLE `std_attendance`
  MODIFY `std_attend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_class_name`
--
ALTER TABLE `std_class_name`
  MODIFY `class_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `std_enrollment_detail`
--
ALTER TABLE `std_enrollment_detail`
  MODIFY `std_enroll_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `std_enrollment_head`
--
ALTER TABLE `std_enrollment_head`
  MODIFY `std_enroll_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `std_fee_details`
--
ALTER TABLE `std_fee_details`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `std_guardian_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `std_ice_info`
--
ALTER TABLE `std_ice_info`
  MODIFY `std_ice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `std_inquiry`
--
ALTER TABLE `std_inquiry`
  MODIFY `std_inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `std_personal_info`
--
ALTER TABLE `std_personal_info`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `teacher_subject_assign_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_subject_assign_head`
--
ALTER TABLE `teacher_subject_assign_head`
  MODIFY `teacher_subject_assign_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `emp_departments`
--
ALTER TABLE `emp_departments`
  ADD CONSTRAINT `emp_departments_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`),
  ADD CONSTRAINT `emp_departments_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `emp_documents`
--
ALTER TABLE `emp_documents`
  ADD CONSTRAINT `emp_documents_ibfk_1` FOREIGN KEY (`emp_info_id`) REFERENCES `emp_info` (`emp_id`);

--
-- Constraints for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD CONSTRAINT `emp_info_ibfk_1` FOREIGN KEY (`emp_designation_id`) REFERENCES `emp_designation` (`emp_designation_id`),
  ADD CONSTRAINT `emp_info_ibfk_2` FOREIGN KEY (`emp_branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `emp_info_ibfk_3` FOREIGN KEY (`emp_type_id`) REFERENCES `emp_type` (`emp_type_id`);

--
-- Constraints for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD CONSTRAINT `emp_leave_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`),
  ADD CONSTRAINT `emp_leave_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `emp_reference`
--
ALTER TABLE `emp_reference`
  ADD CONSTRAINT `emp_reference_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`);

--
-- Constraints for table `exams_criteria`
--
ALTER TABLE `exams_criteria`
  ADD CONSTRAINT `exams_criteria_ibfk_1` FOREIGN KEY (`exam_category_id`) REFERENCES `exams_category` (`exam_category_id`),
  ADD CONSTRAINT `exams_criteria_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `std_class_name` (`class_name_id`);

--
-- Constraints for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  ADD CONSTRAINT `exams_schedule_ibfk_1` FOREIGN KEY (`exam_criteria_id`) REFERENCES `exams_criteria` (`exam_criteria_id`),
  ADD CONSTRAINT `exams_schedule_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `exams_schedule_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`);

--
-- Constraints for table `fee_transaction_detail`
--
ALTER TABLE `fee_transaction_detail`
  ADD CONSTRAINT `fee_transaction_detail_ibfk_2` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_type` (`fee_type_id`),
  ADD CONSTRAINT `fee_transaction_detail_ibfk_3` FOREIGN KEY (`fee_trans_detail_head_id`) REFERENCES `fee_month_detail` (`month_detail_id`);

--
-- Constraints for table `fee_transaction_head`
--
ALTER TABLE `fee_transaction_head`
  ADD CONSTRAINT `fee_transaction_head_ibfk_10` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `fee_transaction_head_ibfk_11` FOREIGN KEY (`class_name_id`) REFERENCES `std_class_name` (`class_name_id`),
  ADD CONSTRAINT `fee_transaction_head_ibfk_6` FOREIGN KEY (`session_id`) REFERENCES `std_sessions` (`session_id`),
  ADD CONSTRAINT `fee_transaction_head_ibfk_8` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`),
  ADD CONSTRAINT `fee_transaction_head_ibfk_9` FOREIGN KEY (`section_id`) REFERENCES `std_sections` (`section_id`);

--
-- Constraints for table `marks_details`
--
ALTER TABLE `marks_details`
  ADD CONSTRAINT `marks_details_ibfk_1` FOREIGN KEY (`marks_head_id`) REFERENCES `marks_head` (`marks_head_id`),
  ADD CONSTRAINT `marks_details_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `marks_head`
--
ALTER TABLE `marks_head`
  ADD CONSTRAINT `marks_head_ibfk_1` FOREIGN KEY (`exam_criteria_id`) REFERENCES `exams_criteria` (`exam_criteria_id`),
  ADD CONSTRAINT `marks_head_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`);

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
-- Constraints for table `std_academic_info`
--
ALTER TABLE `std_academic_info`
  ADD CONSTRAINT `std_academic_info_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`),
  ADD CONSTRAINT `std_academic_info_ibfk_3` FOREIGN KEY (`subject_combination`) REFERENCES `std_subjects` (`std_subject_id`),
  ADD CONSTRAINT `std_academic_info_ibfk_4` FOREIGN KEY (`class_name_id`) REFERENCES `std_class_name` (`class_name_id`);

--
-- Constraints for table `std_attendance`
--
ALTER TABLE `std_attendance`
  ADD CONSTRAINT `std_attendance_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `std_attendance_ibfk_2` FOREIGN KEY (`class_name_id`) REFERENCES `std_class_name` (`class_name_id`),
  ADD CONSTRAINT `std_attendance_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `std_sessions` (`session_id`),
  ADD CONSTRAINT `std_attendance_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `std_sections` (`section_id`),
  ADD CONSTRAINT `std_attendance_ibfk_5` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_subject_assign_head` (`teacher_subject_assign_head_id`),
  ADD CONSTRAINT `std_attendance_ibfk_6` FOREIGN KEY (`student_id`) REFERENCES `std_personal_info` (`std_id`),
  ADD CONSTRAINT `std_attendance_ibfk_7` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `std_class_name`
--
ALTER TABLE `std_class_name`
  ADD CONSTRAINT `std_class_name_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `std_enrollment_detail`
--
ALTER TABLE `std_enrollment_detail`
  ADD CONSTRAINT `std_enrollment_detail_ibfk_1` FOREIGN KEY (`std_enroll_detail_head_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`),
  ADD CONSTRAINT `std_enrollment_detail_ibfk_2` FOREIGN KEY (`std_enroll_detail_std_id`) REFERENCES `std_personal_info` (`std_id`);

--
-- Constraints for table `std_enrollment_head`
--
ALTER TABLE `std_enrollment_head`
  ADD CONSTRAINT `std_enrollment_head_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `std_enrollment_head_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `std_sessions` (`session_id`),
  ADD CONSTRAINT `std_enrollment_head_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `std_sections` (`section_id`),
  ADD CONSTRAINT `std_enrollment_head_ibfk_4` FOREIGN KEY (`class_name_id`) REFERENCES `std_class_name` (`class_name_id`);

--
-- Constraints for table `std_fee_details`
--
ALTER TABLE `std_fee_details`
  ADD CONSTRAINT `std_fee_details_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`);

--
-- Constraints for table `std_fee_installments`
--
ALTER TABLE `std_fee_installments`
  ADD CONSTRAINT `std_fee_installments_ibfk_1` FOREIGN KEY (`std_fee_id`) REFERENCES `std_fee_details` (`fee_id`),
  ADD CONSTRAINT `std_fee_installments_ibfk_2` FOREIGN KEY (`installment_no`) REFERENCES `installment` (`installment_id`);

--
-- Constraints for table `std_fee_pkg`
--
ALTER TABLE `std_fee_pkg`
  ADD CONSTRAINT `std_fee_pkg_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `std_class_name` (`class_name_id`),
  ADD CONSTRAINT `std_fee_pkg_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `std_sessions` (`session_id`);

--
-- Constraints for table `std_guardian_info`
--
ALTER TABLE `std_guardian_info`
  ADD CONSTRAINT `std_guardian_info_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`);

--
-- Constraints for table `std_ice_info`
--
ALTER TABLE `std_ice_info`
  ADD CONSTRAINT `std_ice_info_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`);

--
-- Constraints for table `std_inquiry`
--
ALTER TABLE `std_inquiry`
  ADD CONSTRAINT `std_inquiry_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `std_personal_info`
--
ALTER TABLE `std_personal_info`
  ADD CONSTRAINT `std_personal_info_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `std_sections`
--
ALTER TABLE `std_sections`
  ADD CONSTRAINT `std_sections_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `std_sections_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `std_sessions` (`session_id`);

--
-- Constraints for table `std_sessions`
--
ALTER TABLE `std_sessions`
  ADD CONSTRAINT `std_sessions_ibfk_1` FOREIGN KEY (`session_branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `std_subjects`
--
ALTER TABLE `std_subjects`
  ADD CONSTRAINT `std_subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `std_class_name` (`class_name_id`);

--
-- Constraints for table `teacher_subject_assign_detail`
--
ALTER TABLE `teacher_subject_assign_detail`
  ADD CONSTRAINT `teacher_subject_assign_detail_ibfk_1` FOREIGN KEY (`teacher_subject_assign_detail_head_id`) REFERENCES `teacher_subject_assign_head` (`teacher_subject_assign_head_id`),
  ADD CONSTRAINT `teacher_subject_assign_detail_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`),
  ADD CONSTRAINT `teacher_subject_assign_detail_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `teacher_subject_assign_head`
--
ALTER TABLE `teacher_subject_assign_head`
  ADD CONSTRAINT `teacher_subject_assign_head_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `emp_info` (`emp_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
