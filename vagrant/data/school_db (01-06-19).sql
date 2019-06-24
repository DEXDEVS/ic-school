-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2019 at 06:54 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

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
(10, 5, 'Income', 5, '2019-04-26 22:02:34', 'Amount Paid By Voucher #: 1014', 3000, '2019-04-26 22:02:34', '0000-00-00 00:00:00', 1, 0);

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
(25, 5, 2, '2019-04-27', '10:49:23', NULL, 'P', 1, 0, '2019-04-27 08:49:23', '0000-00-00 00:00:00'),
(26, 5, 3, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(27, 5, 4, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(28, 5, 5, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(29, 5, 6, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(30, 5, 7, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(31, 5, 8, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(32, 5, 9, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(33, 5, 11, '2019-04-27', '00:00:00', '00:00:00', 'A', 1, 0, '2019-04-27 08:51:34', '0000-00-00 00:00:00'),
(34, 5, 2, '2019-05-13', '11:23:08', '11:24:29', 'P', 1, 1, '2019-05-13 06:23:08', '2019-05-13 06:24:29'),
(35, 5, 1, '2019-05-13', '23:26:36', '19:40:30', 'P', 1, 1, '2019-05-13 18:26:36', '2019-05-13 14:40:30'),
(36, 5, 3, '2019-05-04', '11:33:40', NULL, 'P', 1, 0, '2019-05-04 06:33:40', '0000-00-00 00:00:00'),
(37, 5, 2, '2019-05-18', '11:51:03', NULL, 'P', 1, 0, '2019-05-18 06:51:03', '0000-00-00 00:00:00'),
(38, 5, 2, '2019-05-20', '12:11:36', NULL, 'P', 1, 0, '2019-05-20 07:11:36', '0000-00-00 00:00:00');

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
(1, 'Principal', '2018-10-31 08:17:08', '2018-10-31 08:17:08', 1, 1, 1),
(2, 'Vise Principal', '2018-10-31 08:17:30', '2018-10-31 08:17:30', 1, 1, 1),
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
  `barcode` longblob NOT NULL,
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

INSERT INTO `emp_info` (`emp_id`, `emp_reg_no`, `emp_name`, `emp_father_name`, `emp_cnic`, `emp_contact_no`, `emp_perm_address`, `emp_temp_address`, `emp_marital_status`, `emp_fb_ID`, `emp_gender`, `emp_photo`, `barcode`, `emp_dept_id`, `emp_designation_id`, `emp_type_id`, `emp_salary_type`, `group_by`, `emp_branch_id`, `emp_email`, `emp_qualification`, `emp_passing_year`, `emp_institute_name`, `degree_scan_copy`, `emp_cv`, `emp_salary`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 'EMP-Y19-1', 'Kinza Mustafa', 'G Mustafa', '45102-0511722-2', '+92-345-6789098', 'RYK', 'RYK', 'Single', 'Kinza@gmail.com', 'Female', 'uploads/Kinza Mustafa_emp_photo.jpg', '', '1', 1, 4, 'Salaried', 'Faculty', 5, 'kinza.fatima.522@gmail.com', 'BSCS', 2017, 'IUB', 'uploads/Kinza Mustafa_degree_scan_copy.jpg', '', 10000, '2019-04-18 07:06:58', '2019-04-06 06:01:51', 3, 1, 1),
(2, 'EMP-Y19-2', 'Nadia', 'Gull', '88888-8888888-8', '+92-345-6789999', 'ryk', 'ryk', 'Single', 'fghj@gmail.com', 'Female', 'uploads/nadia_emp_photo.jpg', '', '1', 4, 5, 'Per Lecture', 'Faculty', 6, 'fghj@gmail.com', 'BSCS', 2019, 'fghjk', 'uploads/Nadia_degree_scan_copy.png', '', 1300, '2019-05-31 04:54:51', '2019-04-06 05:40:28', 3, 4, 1),
(3, 'EMP-Y19-3', 'Nauman', 'shahid', '31303-0511722-2', '+92-331-5698895', 'RYK', 'RYK', 'Married', 'nauman@gmail.com', 'Male', 'uploads/Nauman_emp_photo.jpg', '', '1,7', 4, 5, 'Per Lecture', 'Faculty', 5, 'nauman@gmail.com', 'BSCS', 2108, 'Superior', 'uploads/Nauman_degree_scan_copy.jpg', '', 1000, '2019-04-18 07:07:22', '2019-04-06 06:05:48', 8, 1, 1),
(4, 'EMP-Y19-4', 'Ayesha', 'Ali', '46545-4654654-6', '+92-345-6787654', 'RYK', 'RYK', 'Single', 'ayesha@gmail.com', 'Female', 'uploads/Ayesha_emp_photo.png', '', '1', 9, 4, 'Salaried', 'Faculty', 6, 'ayesha@gmail.com', 'BSCS', 2018, 'Superior', 'uploads/Ayesha_degree_scan_copy.xps', '', 40000, '2019-05-31 04:55:35', '2019-04-20 08:15:20', 8, 3, 1),
(5, 'EMP-Y19-5', 'Qasim Khan', 'M. Ali Khan', '12345-6789098-7', '34', 'RYK', 'RYK', 'Married', 'qasim@gmail.com', 'Male', '0', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'ali@gmail.com', 'BSCS', 2018, 'Superior College', '0', '', 25000, '2019-02-24 06:39:07', '0000-00-00 00:00:00', 9, 0, 1),
(6, 'EMP-Y19-6', 'Shahzaib Akram', 'Akram Ali', '12345-6543234-5', '92', 'Gulshan Iqbal', 'Gulshan Iqbal', 'Single', 'shahzaib@gmail.com', 'Male', '0', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'shahzaib@gmail.com', 'MSC Maths', 2018, 'IUB', '0', '', 25000, '2019-02-24 07:02:07', '2019-02-24 07:02:07', 9, 9, 1),
(7, 'EMP-Y19-7', 'Adnan Akram', 'Akram Ali', '12345-6787654-3', '92', 'RYK', 'RYK', 'Single', 'adnan@gmail.com', 'Male', '0', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'adnan@gmail.com', 'MSC Maths', 2018, 'IUB', '0', '', 25000, '2019-02-24 07:04:41', '2019-02-24 07:04:41', 9, 9, 1),
(8, 'EMP-Y19-8', 'Sajid Umar', 'Umar Khan', '12345-6787654-7', '92', 'Gulshan Iqbal', 'Gulshan Iqbal', 'Single', 'sajid@gmail.com', 'Male', 'uploads/Sajid Umar_emp_photo.jpeg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'sajid@gmail.com', 'MSC Maths', 2018, 'IUB', '0', '', 25000, '2019-02-24 07:01:02', '0000-00-00 00:00:00', 9, 0, 1),
(9, 'EMP-Y19-9', 'Zia ur Rehman', 'A. Rehman', '31303-2345678-8', '92', 'Gulshan Iqbal', 'Gulshan Iqbal', 'Single', 'zia@gmail.com', 'Male', 'uploads/Zia ur Rehman_emp_photo.jpg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'zia@gmail.com', 'MSC Physics', 2018, 'IUB', '0', '', 30000, '2019-02-25 04:39:20', '0000-00-00 00:00:00', 9, 0, 1),
(11, 'EMP-Y19-10', 'Sana Asad', 'Asad Ali', '31303-3456789-8', '+92-315-8410500', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Sana Asad_emp_photo.jpg', '', '', 4, 2, 'Salaried', 'Faculty', 5, 'sana@gmail.com', 'M.Phil', 2017, 'QAU', 'uploads/Sana Asad_degree_scan_copy.jpg', '', 15000, '2019-04-04 07:52:55', '0000-00-00 00:00:00', 1, 0, 1),
(12, 'EMP-Y19-12', 'Hira Tahir', 'M Tahir', '31303-9879879-8', '+92-374-6783___', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Hira Tahir_emp_photo.jpg', '', '', 1, 4, 'Salaried', 'Faculty', 6, 'hira07@gmail.com', 'BSCS', 2017, 'IUB', 'uploads/Hira Tahir_degree_scan_copy.jpg', 'uploads/Hira Tahir_emp_cv.jpg', 50000, '2019-05-20 06:56:58', '0000-00-00 00:00:00', 1, 0, 1),
(13, 'EMP-Y19-13', 'Laraib Mariyam', 'M Matloob', '31303-1231231-2', '+92-987-6543234', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Laraib Mariyam_emp_photo.jpg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'hira07@gmail.com', 'BSCS', 2017, 'IUB', 'uploads/Laraib Mariyam_degree_scan_copy.jpg', 'uploads/Laraib Mariyam_emp_cv.jpg', 50000, '2019-05-20 07:48:03', '0000-00-00 00:00:00', 1, 0, 1),
(15, 'EMP-Y19-14', 'Nawal Shareef', 'M Shareef', '87556-8765676-5', '+76-543-4567___', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Nawal Shareef_emp_photo.jpg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'nawal@gmail.com', 'BSCS', 2017, 'iub', 'uploads/Nawal Shareef_degree_scan_copy.jpg', 'uploads/Nawal Shareef_emp_cv.jpg', 60000, '2019-05-21 06:26:13', '0000-00-00 00:00:00', 1, 0, 1),
(16, 'EMP-Y19-16', 'Musaab Shareef', 'M Shareef', '23456-7898765-4', '+98-765-4323456', 'RYK', 'RYK', 'Single', '', 'Male', 'uploads/Musaab Shareef_emp_photo.jpg', '', '', 4, 1, 'Salaried', 'Faculty', 5, 'nawal@gmail.com', 'BSCS', 2017, 'iub', 'uploads/Musaab Shareef_degree_scan_copy.jpg', 'uploads/Musaab Shareef_emp_cv.jpg', 60000, '2019-05-22 05:48:29', '2019-05-22 05:48:29', 1, 1, 1),
(17, 'EMP-Y19-17', 'Nawal Shareef', 'M Shareef', '34567-8987654-3', '+98-765-4323456', 'RYK', 'RYK', 'Single', '', 'Female', 'uploads/Nawal Shareef_emp_photo.jpg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'nawal@gmail.com', 'BSCS', 2017, 'iub', 'uploads/Nawal Shareef_degree_scan_copy.jpg', 'uploads/Nawal Shareef_emp_cv.jpg', 40000, '2019-05-22 05:48:03', '0000-00-00 00:00:00', 1, 0, 1),
(19, 'EMP-Y19-18', 'ertyui', 'rtyui', '87654-3456788-7', '+98-765-4345678', 'RYK', 'RYK', 'Single', '', 'Male', 'uploads/ertyui_emp_photo.jpg', '', '', 5, 1, 'Salaried', 'Faculty', 5, 'musaab03@gmail.com', 'BSCS', 2017, 'iub', 'uploads/ertyui_degree_scan_copy.jpg', 'uploads/ertyui_emp_cv.jpg', 60000, '2019-05-22 06:06:10', '0000-00-00 00:00:00', 1, 0, 1),
(21, 'EMP-Y19-20', 'Adeela Atif', 'M Irshad', '67548-6547864-3', '+92-876-5433456', 'RYK', 'RYK', 'Married', '', 'Female', 'uploads/Adeela Atif_emp_photo.jpg', '', '', 3, 4, 'Salaried', 'Faculty', 5, 'adeela@gmail.com', 'BSCS', 2017, 'IUB RYK', '0', 'uploads/Adeela Atif_emp_cv.jpg', 7000, '2019-05-22 08:16:55', '0000-00-00 00:00:00', 1, 0, 1),
(22, 'EMP-Y19-22', 'Hira Farhan', 'M Irshad', '77788-6669966-6', '+92-987-6543456', 'RYK', 'RYK', 'Married', '', 'Female', 'uploads/Hira Farhan_emp_photo.jpg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'hira@gmail.com', 'MCS', 2000, 'KFUITE', 'uploads/Hira Farhan_degree_scan_copy.jpg', 'uploads/Hira Farhan_emp_cv.jpg', 30000, '2019-05-22 08:27:12', '0000-00-00 00:00:00', 1, 0, 1),
(23, 'EMP-Y19-23', 'Ali Irshad', 'M Irshad', '89646-7892536-8', '+98-765-43456__', 'RYK', 'RYK', 'Married', '', 'Male', 'uploads/Ali Irshad_emp_photo.jpg', '', '', 4, 4, 'Salaried', 'Faculty', 5, 'ali09@gmail.com', 'BSCS', 2017, 'KFUITE', 'uploads/Ali Irshad_degree_scan_copy.jpg', 'uploads/Ali Irshad_emp_cv.jpg', 30000, '2019-05-22 08:39:35', '0000-00-00 00:00:00', 1, 0, 1),
(24, 'EMP-Y19-24', 'Saad Shareef', 'M Shareef', '46897-6456775-4', '+92-876-5434567', 'RYK', 'RYK', 'Married', '', 'Male', 'uploads/Saad Shareef_emp_photo.jpg', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414e494141414261434159414141444e65676a334141414850556c455156523458753264506378745178534733314d536e55496e6f6946525342514b4a4552444e424b466e2f68705249686f4a4472684374464a4e4349524a51714e52434d6f75416b536859614b526b524e532f6e4a2b733473333977354d3376576e44756e6d6d636e4e2f664c506e76507a3776584f2b396161362b39393037533566525062434141416b6368634f394f3068767033314574634249496749417551535373414153754867474964505559306749496f456a5941416a4d514142466d6f45696253795041455261336751415941594345476b47697253785041495161586b544149415a4345436b47536a5378764949514b546c545141415a6941416b5761675342764c497743526c6a6342414a69424145536167534a744c4938415246726542414267426749516151614b744c45384168427065524d4167426b49514b515a4b4e4c4738676841704f564e4141426d494143525a7142494738736a4543665332646e5a575153753357346e4f39542b74383150382f32324c7a2b6d50486272754e467a7666396a2b32754e5a617664664c367434364c7a79444563485575746a32692f355848526564534f69353772646844424c344a4c314161444e723033357659476b586f454c786543326b5573696571474f47704545554d38317368723834677559744635524d592f6776654d686243336d454f6b69764b5646326e4768594249463535466138466f45584a7230576d704934715571493172742f65416a7a47697949714f496c305a4e765155446b577178464b6a506a364b6442477634747064784f61354865486134646f4e7139376f5172546c736b5664336d683852624b686f445375486135647a515a3638525645676b674836587869704d4e6249424170455958375348336a6947594e6f7935573548374a694f7355376666596845596b57644a4c4470433149327633767a4b6853503146682f52334a3831426a45534d5249793051524a63752f3471693275334c776d4453424470774243696164365272464d30566946474f69526d744b794a577274306636686d62464544374d556f45514f7445614e33587756465170487359324f6247363464726c30766855335762762f56506f695556557567535032464935496d48306e5052785639784b50772f764f786c6e2f3362482f6e486259503544474b6b667361754862627458736f456f7030767461557273766f773354524654556136305657337045565039707652476d69535a695238555878692b4243736f466b773262362b46676a702f716236752b44696f4865765171796468633368626469765767714f616f7175486134647268323259335559315550496b456b694153526d6a6b35736e62704c5561314a454b3565704a7375436a74515a477535425245676b68586c4479527464756e37376d504e50684f76466151504a492b6a615a35716257727632306f6d71675977572f6b2b6e46446c706566564e2f4a634b7a62526671623944667037776d4a414967456b534153524f6f2b3539534c2f3871344b4b2b696f4e6175654d66344b55704d694a46343079705a4f374a325a4f303648334c6f715646534d6c3669583559545263746965497943787969635a436753696f51696f5569486a7a5830416b706970485a31416c6b37736e5a6b37636a616b6257726c575163572f75474968302b486a46534f54434b582b2b4a344d6a4e345a48786e634b6a6f4c4b4279675971477962457542414a496b456b694d54486d4775466c623058725551656a4975345536334541713464316438483565396272385631673648366d792f323464726832754861346472683275486131542b6133484e762b5435537171666773793538316f57765557785538504875373337745766512b5344546f6a7a774a4f6e4b664a74727673516d4e534c494552584c4e375a544c6f6b676f456f714549764639704f4c6c49434f78486f7245652b334f6c7844652f5831346e7755696e6473467a795078504e4a3252666a4d4f4178465170465170416b563568414a496b456b694e544d454f44615462677a7a73745065506e4a56434a3173743738444149724978442f394f584b4b444633454f6767414a457745524359674142456d67416954594141524d49475147414341684270416f6730415149514352734167516b49514b514a494e49454345436b696731634c2b6b3937617339666b752f7679627054556c6653587053306a2b5333705830764b51504a4c30733656394a643076365070317a6a3652664a583069365947736e36665376724c72577952394b756c325365557831762f76365477625839366d39664f4470504c384c787439573738665a3533376e42374d3975647a717448452b6a4a3858704c304e7a7753524b6f5977634f536e7042304b52484a69474f624761397652706962306a372f33517a3352556e76534c7057307475535873304d3752704a7230683676324a38526f3779654f2f4c6a4e61492b6c31477045636b665a694e5a2b74384f367a56647a34506d376352337865504c583759654778632b66785735684e454b71362b47636444616438586b76365539494b6b4f7955396e716e50485157522f704430567a72586c4d6f324d7a5a72777733546a4e59325534397973392f755436706e76376e4b4f41462b6b58526449704b50306675783431766e353851762b3761326e35623055564c5463727774596c686674306d366f62456f7245676f694a526439587a5666696152774d695275336e6d596e32547947424b5a43375336354c655369763073306e4a544a48793837625579495a676264316361636555783068716d79746737734c6c626c6e7466484d334932706b37627637616e2b3333453954506c4e645531582f4839644f75486235366d6e4762455a726975477273796c53376f36354b325247367a474c7134475279636e31733651664d3966486a503957535a2b6e447374594b69654b472f37586b75354b73566a756775566a3976303262696461535a7979627a2f2f4f556d6656647a4d2f4879506d32772b6a7958466461567575616b6f306f6f4970446d5841627a7464754e354e464d685679527a3964787471376c61356235652f474848753572646d5034324e544731793764534b54772b2b366c7976735634316b61746235747647576435503631344b3164435039595663585656777256724c423535764a43547a4e3234664a38547a74544c4d336d35676658634f683943726d61322b75644266363549755a726c326258612b5647337a6f377a73656378576d74746a6335706c62555a49713179705a6e6e53524741534365466c385a585151416972584b6c6d65644a455942494a345758786c6442344a784933307136764d714d6d5363496e4143422b2f34446c735875364c527a68774141414141415355564f524b35435949493d, '', 4, 3, 'Salaried', 'Faculty', 5, 'saad@gmail.com', 'MCS', 2017, 'KFUITE', 'uploads/Saad Shareef_degree_scan_copy.jpg', 'uploads/Saad Shareef_emp_cv.jpg', 55000, '2019-05-22 08:42:23', '0000-00-00 00:00:00', 1, 0, 1);

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
(4, 5, 3, 'Medical Leave', '2019-05-25', '2019-05-28', '2019-05-25', 3, 'I am sick', 'Accepted', 'Best of luck', '2019-05-25 06:04:13', '2019-05-25 06:04:13', 69, 1);

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
(6, 11, 'Rana Faraz Ahmed', '92', '31303-0987654-5', 'CEO'),
(7, 16, 'Anas', '+87-654-3234567', '23456-7898765-4', 'Teacher'),
(8, 17, 'Anas', '+98-765-4323456', '98765-4323456-7', 'uhhu'),
(10, 19, '', '', '', ''),
(12, 21, '', '', '', ''),
(13, 22, '', '', '', ''),
(14, 23, '', '', '', ''),
(15, 24, '', '', '', '');

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
(5, 'Final Term Examination', 'Final Term Exams', '2019-05-22 19:11:12', '0000-00-00 00:00:00', 0, 0),
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

INSERT INTO `exams_criteria` (`exam_criteria_id`, `exam_category_id`, `class_id`, `exam_start_date`, `exam_end_date`, `exam_room`, `exam_status`, `exam_type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 1, '2019-05-30', '2019-06-08', '', 'Inactive', 'Regular', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1);

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
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_room`
--

INSERT INTO `exams_room` (`exam_room_id`, `exam_schedule_id`, `class_head_id`, `exam_room`, `emp_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(2, 1, 3, 8, 3, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(3, 1, 4, 7, 7, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(4, 2, 2, 4, 4, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(5, 2, 3, 7, 6, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(6, 2, 4, 4, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(7, 3, 2, 4, 3, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(8, 3, 3, 4, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(9, 3, 4, 6, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(10, 4, 2, 5, 4, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(11, 4, 3, 11, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(12, 4, 4, 6, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(13, 5, 2, 3, 4, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(14, 5, 3, 11, 6, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(15, 5, 4, 2, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(16, 6, 2, 4, 1, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(17, 6, 3, 6, 7, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00'),
(18, 6, 4, 4, 5, 1, 0, '2019-05-30 07:45:31', '0000-00-00 00:00:00');

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
(1, 1, 1, '2019-05-30', '08:00:00', '11:00:00', 100, 33, 'not', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1),
(2, 1, 2, '2019-05-31', '08:00:00', '11:00:00', 100, 33, 'not', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1),
(3, 1, 4, '2019-06-01', '08:00:00', '11:00:00', 100, 33, 'not', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1),
(4, 1, 8, '2019-06-03', '08:00:00', '11:00:00', 100, 33, 'not', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1),
(5, 1, 7, '2019-06-05', '08:00:00', '11:00:00', 50, 33, 'not', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1),
(6, 1, 10, '2019-06-08', '08:00:00', '11:00:00', 50, 33, 'not', '2019-05-31 05:04:21', '2019-05-31 05:04:21', 1, 1);

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
(1, 1001, '2019-01', 4910),
(2, 1002, '2019-01', 5000),
(3, 1003, '2019-01', 5000),
(4, 1004, '2019-03', 6865),
(5, 1005, '2019-03', 7000),
(6, 1006, '2019-03', 7000),
(7, 1007, '2019-04', 8820),
(8, 1007, '2019-05', 1955),
(9, 1008, '2019-04', 9000),
(10, 1008, '2019-05', 2000),
(11, 1009, '2019-04', 9000),
(12, 1009, '2019-05', 2000),
(13, 1010, '2019-01', 6500),
(14, 1011, '2019-01', 7000),
(15, 1012, '2019-01', 7000),
(16, 1013, '2019-06', 12730),
(17, 1014, '2019-06', 3000),
(18, 1015, '2019-06', 13000);

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
(1, 1, 1, 2955, 0, '2019-04-18 07:14:23', '0000-00-00 00:00:00', 0, 0, 1),
(2, 1, 2, 1955, 0, '2019-04-18 07:14:23', '0000-00-00 00:00:00', 0, 0, 1),
(3, 2, 1, 3000, 0, '2019-04-18 07:14:23', '0000-00-00 00:00:00', 0, 0, 1),
(4, 2, 2, 2000, 0, '2019-04-18 07:14:23', '0000-00-00 00:00:00', 0, 0, 1),
(5, 3, 1, 3000, 0, '2019-04-18 07:14:23', '0000-00-00 00:00:00', 0, 0, 1),
(6, 3, 2, 2000, 0, '2019-04-18 07:14:23', '0000-00-00 00:00:00', 0, 0, 1),
(7, 4, 2, 1955, 0, '2019-04-18 07:35:43', '0000-00-00 00:00:00', 0, 0, 1),
(8, 4, 8, 4910, 0, '2019-04-18 07:35:43', '0000-00-00 00:00:00', 0, 0, 1),
(9, 5, 2, 2000, 0, '2019-04-18 07:35:43', '0000-00-00 00:00:00', 0, 0, 1),
(10, 5, 8, 5000, 0, '2019-04-18 07:35:43', '0000-00-00 00:00:00', 0, 0, 1),
(11, 6, 2, 2000, 0, '2019-04-18 07:35:43', '0000-00-00 00:00:00', 0, 0, 1),
(12, 6, 8, 5000, 0, '2019-04-18 07:35:43', '0000-00-00 00:00:00', 0, 0, 1),
(13, 7, 2, 1955, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(14, 7, 8, 6865, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(15, 8, 2, 1955, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(16, 9, 2, 2000, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(17, 9, 8, 7000, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(18, 10, 2, 2000, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(19, 11, 2, 2000, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(20, 11, 8, 7000, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(21, 12, 2, 2000, 0, '2019-04-18 07:41:26', '0000-00-00 00:00:00', 0, 0, 1),
(22, 13, 1, 4000, 0, '2019-04-26 08:40:15', '0000-00-00 00:00:00', 0, 0, 1),
(23, 13, 2, 2500, 0, '2019-04-26 08:40:15', '0000-00-00 00:00:00', 0, 0, 1),
(24, 14, 1, 4000, 0, '2019-04-26 08:40:15', '0000-00-00 00:00:00', 0, 0, 1),
(25, 14, 2, 3000, 0, '2019-04-26 08:40:15', '0000-00-00 00:00:00', 0, 0, 1),
(26, 15, 1, 4000, 0, '2019-04-26 08:40:16', '0000-00-00 00:00:00', 0, 0, 1),
(27, 15, 2, 3000, 0, '2019-04-26 08:40:16', '0000-00-00 00:00:00', 0, 0, 1),
(28, 16, 2, 1955, 0, '2019-04-26 17:01:06', '0000-00-00 00:00:00', 0, 0, 1),
(29, 16, 8, 10775, 0, '2019-04-26 17:01:06', '0000-00-00 00:00:00', 0, 0, 1),
(30, 17, 2, 2000, 0, '2019-04-26 17:01:06', '0000-00-00 00:00:00', 0, 0, 1),
(31, 17, 8, 1000, 0, '2019-04-26 17:01:06', '0000-00-00 00:00:00', 0, 0, 1),
(32, 18, 2, 2000, 0, '2019-04-26 17:01:06', '0000-00-00 00:00:00', 0, 0, 1),
(33, 18, 8, 11000, 0, '2019-04-26 17:01:06', '0000-00-00 00:00:00', 0, 0, 1);

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
(1, 1001, 5, 1, 4, 3, 5, 'Aniqa Gull', '', '2019-04-18 12:14:23', 4910, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-18 07:35:43', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1002, 5, 1, 4, 3, 8, 'Sadia Gull', '', '2019-04-18 12:14:23', 5000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-18 07:35:43', '0000-00-00 00:00:00', 1, 0, 1),
(3, 1003, 5, 1, 4, 3, 18, 'Asra', '', '2019-04-18 12:14:23', 5000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-18 07:35:43', '0000-00-00 00:00:00', 1, 0, 1),
(4, 1004, 5, 1, 4, 3, 5, 'Aniqa Gull', '', '2019-04-18 12:35:43', 6865, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-18 07:41:25', '0000-00-00 00:00:00', 1, 0, 1),
(5, 1005, 5, 1, 4, 3, 8, 'Sadia Gull', '', '2019-04-18 12:35:43', 7000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-18 07:41:26', '0000-00-00 00:00:00', 1, 0, 1),
(6, 1006, 5, 1, 4, 3, 18, 'Asra', '', '2019-04-18 12:35:43', 7000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-18 07:41:26', '0000-00-00 00:00:00', 1, 0, 1),
(7, 1007, 5, 1, 4, 3, 5, 'Aniqa Gull', '', '2019-04-18 12:41:26', 10775, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-26 17:01:06', '0000-00-00 00:00:00', 1, 0, 1),
(8, 1008, 5, 1, 4, 3, 8, 'Sadia Gull', '', '2019-04-18 12:41:26', 11000, 10000, 1000, '2019-04-26 14:21:13', 'Added to next month', '2019-04-26 17:01:06', '0000-00-00 00:00:00', 1, 0, 1),
(9, 1009, 5, 1, 4, 3, 18, 'Asra', '', '2019-04-18 12:41:26', 11000, 0, 0, '0000-00-00 00:00:00', 'Added to next month', '2019-04-26 17:01:06', '0000-00-00 00:00:00', 1, 0, 1),
(10, 1010, 6, 11, 6, 5, 1, 'zahid saeed', '', '2019-04-26 13:40:15', 6500, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-26 08:40:15', '0000-00-00 00:00:00', 4, 0, 1),
(11, 1011, 6, 11, 6, 5, 46, 'Wqas', '', '2019-04-26 13:40:15', 7000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-26 08:40:15', '0000-00-00 00:00:00', 4, 0, 1),
(12, 1012, 6, 11, 6, 5, 47, 'Sheeza ', '', '2019-04-26 13:40:16', 7000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-26 08:40:16', '0000-00-00 00:00:00', 4, 0, 1),
(13, 1013, 5, 1, 4, 3, 5, 'Aniqa Gull', '', '2019-04-26 22:01:06', 12730, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-26 17:01:06', '0000-00-00 00:00:00', 1, 0, 1),
(14, 1014, 5, 1, 4, 3, 8, 'Sadia Gull', '', '2019-04-26 22:01:06', 3000, 3000, 0, '2019-04-26 22:02:34', 'Paid', '2019-04-26 17:02:34', '0000-00-00 00:00:00', 1, 0, 1),
(15, 1015, 5, 1, 4, 3, 18, 'Asra', '', '2019-04-26 22:01:06', 13000, 0, 0, '0000-00-00 00:00:00', 'Unpaid', '2019-04-26 17:01:06', '0000-00-00 00:00:00', 1, 0, 1);

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
(129, 56, 6, 50, '2019-05-22 19:37:10', '0000-00-00 00:00:00', 1, 0),
(130, 57, 6, 80, '2019-05-22 20:04:08', '0000-00-00 00:00:00', 1, 0);

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
(7, 3, 2, 1, '2019-05-22 19:06:46', '0000-00-00 00:00:00', 1, 0),
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
(56, 5, 14, 7, '2019-05-22 19:37:10', '0000-00-00 00:00:00', 1, 0),
(57, 5, 2, 1, '2019-05-22 20:04:08', '0000-00-00 00:00:00', 1, 0);

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
(1, 1, 11, 14, '6th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'signed', '2019-04-26 08:38:29', '0000-00-00 00:00:00', 4, 0, 1),
(4, 5, 1, 7, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'signed', '2019-04-06 07:57:36', '0000-00-00 00:00:00', 1, 0, 1),
(7, 8, 1, 6, 'KG', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'signed', '2019-04-06 07:57:36', '0000-00-00 00:00:00', 1, 0, 1),
(8, 11, 8, 12, '4th', 2018, 12345, 1100, 880, 'A', '80%', 'National Garrison ', 'signed', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(9, 12, 4, 8, '9th', 2018, 12345, 1100, 880, 'A', '80%', 'National Garrison ', 'signed', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(10, 14, 2, 6, '10th', 0, 12345, 111, 111, 'A+', '100%', 'Colony High School', 'signed', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(11, 18, 1, 5, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'National Garrison ', 'signed', '2019-04-06 08:17:48', '0000-00-00 00:00:00', 1, 0, 1),
(12, 20, 4, 8, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-03-30 08:16:47', '0000-00-00 00:00:00', 1, 0, 1),
(13, 21, 4, 8, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-03-30 08:18:35', '0000-00-00 00:00:00', 1, 0, 1),
(14, 22, 4, 8, '10th', 2018, 12345, 1100, 880, 'A', '80%', 'Colony High School', 'unsign', '2019-03-30 08:19:18', '0000-00-00 00:00:00', 1, 0, 1),
(15, 26, 6, 10, '9th', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'signed', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(16, 27, 8, 12, '10th', NULL, 12345, NULL, NULL, 'F', '', 'Colony High School', 'signed', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(17, 30, 8, 12, '4th', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'signed', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(18, 31, 3, 7, '', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'signed', '2019-05-08 05:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(19, 33, 6, 10, 'Matric', NULL, 265641, 1050, 2018, 'B+', '71%', 'National Garrison ', 'signed', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(20, 37, 6, 10, 'Matric', NULL, 265641, 1050, 2018, 'B+', '71%', 'National Garrison ', 'unsign', '2019-04-02 07:29:38', '0000-00-00 00:00:00', 1, 0, 1),
(21, 39, 6, 10, 'Matric', NULL, 265641, 1050, 2018, 'B+', '71%', 'National Garrison ', 'unsign', '2019-04-02 07:33:07', '0000-00-00 00:00:00', 1, 0, 1),
(22, 40, 6, 10, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'unsign', '2019-04-02 08:40:52', '0000-00-00 00:00:00', 17, 0, 1),
(23, 42, 6, 10, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 17, 0, 1),
(24, 45, 6, 10, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'unsign', '2019-04-02 08:46:11', '0000-00-00 00:00:00', 17, 0, 1),
(25, 46, 11, 14, '', NULL, NULL, NULL, NULL, '', '', 'National Garrison ', 'signed', '2019-04-26 08:38:29', '0000-00-00 00:00:00', 17, 0, 1),
(26, 47, 11, 14, '', NULL, NULL, NULL, NULL, '', '', 'Colony High School', 'signed', '2019-04-26 08:38:29', '0000-00-00 00:00:00', 1, 0, 1),
(27, 48, 3, 7, 'Nursery', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'signed', '2019-05-08 05:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(28, 50, 3, 7, 'Nursery', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'unsign', '2019-04-04 05:11:53', '0000-00-00 00:00:00', 1, 0, 1),
(29, 52, 3, 7, 'Nursery', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(30, 53, 2, 6, 'KG-1', NULL, NULL, NULL, NULL, 'F', '', 'National Garrison ', 'signed', '2019-04-04 17:18:16', '0000-00-00 00:00:00', 1, 0, 1),
(31, 54, 13, 1, '', NULL, NULL, NULL, NULL, 'F', '', 'Colony High School', 'signed', '2019-04-06 07:49:06', '0000-00-00 00:00:00', 4, 0, 1),
(32, 55, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'unsign', '2019-05-18 04:31:31', '0000-00-00 00:00:00', 1, 0, 1),
(33, 59, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(34, 60, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(35, 61, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(36, 62, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(37, 63, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'unsign', '2019-05-18 06:05:06', '0000-00-00 00:00:00', 1, 0, 1),
(38, 64, 1, 5, '', NULL, NULL, NULL, NULL, 'F', '', 'TCI', 'signed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1);

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
(4, 5, '1st', 'One', 'Active', '2019-05-24 04:53:12', '2019-03-16 01:28:33', 1, 1, 1),
(5, 5, '2nd', 'Two', 'Active', '2019-05-24 04:53:17', '2019-03-16 01:28:45', 1, 1, 1),
(6, 5, '3rd', 'Three', 'Active', '2019-05-24 04:53:23', '2019-03-16 01:28:56', 1, 1, 1),
(7, 5, '4th', 'Four', 'Active', '2019-05-24 04:53:27', '2019-03-16 01:29:09', 1, 1, 1),
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
(1, 1, 'STD-Y19-31', 'Pre-Gr19-1', 31, 'Aisha Ameen', '2019-05-08 05:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1, 'STD-Y19-48', 'Pre-Gr19-2', 48, 'Zahid Saeed', '2019-05-08 05:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(3, 2, 'STD-Y19-2', 'KG--Re19-1', 5, 'Aniqa Gull', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(4, 2, 'STD-Y19-6', 'KG--Re19-2', 8, 'Sadia Gull', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(5, 2, 'STD-Y19-9', 'KG--Re19-3', 11, 'Fatima Bibi ', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(6, 2, 'STD-Y19-12', 'KG--Re19-4', 12, 'Ihsan-ul-Haq', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(7, 2, 'STD-Y19-13', 'KG--Re19-5', 14, 'Testing 1', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(8, 2, 'STD-Y19-15', 'KG--Re19-6', 18, 'Asra', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(9, 3, 'STD-Y19-23', 'KG--Bl19-1', 26, 'zahid saeed', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(10, 3, 'STD-Y19-27', 'KG--Bl19-2', 27, 'Nadia Gull', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(11, 3, 'STD-Y19-28', 'KG--Bl19-3', 30, 'Asmat Ara', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(12, 3, 'STD-Y19-31', 'KG--Bl19-4', 31, 'Aisha Ameen', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(13, 3, 'STD-Y19-32', 'KG--Bl19-5', 33, 'Saif-ur-Rehman', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(14, 4, 'STD-Y19-41', 'KG--Gr19-1', 42, 'Wqas', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(15, 4, 'STD-Y19-51', 'KG--Gr19-2', 52, 'Zahid Saeed', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(16, 4, 'STD-Y19-53', 'KG--Gr19-3', 53, 'M. Azaan', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(17, 4, 'STD-Y19-56', 'KG--Gr19-4', 59, 'Ali', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(18, 4, 'STD-Y19-60', 'KG--Gr19-5', 60, 'Anas Shafqat', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(19, 4, 'STD-Y19-61', 'KG--Gr19-6', 61, 'esha', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(20, 4, 'STD-Y19-62', 'KG--Gr19-7', 62, 'Ali', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1),
(21, 4, 'STD-Y19-64', 'KG--Gr19-8', 64, 'Sana', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1);

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
(1, 5, 3, 4, 3, 'Prep-2019 - 2020 -Green', '2019-05-08 05:19:21', '0000-00-00 00:00:00', 1, 0, 1),
(2, 5, 1, 4, 1, 'KG-1-2019 - 2020 -Red', '2019-05-23 04:08:33', '0000-00-00 00:00:00', 1, 0, 1),
(3, 5, 1, 4, 2, 'KG-1-2019 - 2020 -Blue', '2019-05-23 04:09:41', '0000-00-00 00:00:00', 1, 0, 1),
(4, 5, 1, 4, 3, 'KG-1-2019 - 2020 -Green', '2019-05-23 04:11:15', '0000-00-00 00:00:00', 1, 0, 1);

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
(28, 54, 5000, 0, 5000, 0, 3000, '2019-04-06 07:28:03', '0000-00-00 00:00:00', 4, 0, 1),
(29, 55, 3000, 0, 3000, 0, 2000, '2019-05-18 04:31:31', '0000-00-00 00:00:00', 1, 0, 1),
(30, 59, 3000, 0, 3000, 0, 2000, '2019-05-18 04:34:58', '0000-00-00 00:00:00', 1, 0, 1),
(31, 60, 3000, 0, 3000, 0, 2000, '2019-05-18 04:55:40', '0000-00-00 00:00:00', 1, 0, 1),
(32, 61, 3000, 0, 3000, 0, 2000, '2019-05-18 05:15:58', '0000-00-00 00:00:00', 1, 0, 1),
(33, 62, 3000, 0, 3000, 0, 2000, '2019-05-18 05:25:07', '0000-00-00 00:00:00', 1, 0, 1),
(34, 63, 3000, 0, 3000, 0, 2000, '2019-05-18 06:05:06', '0000-00-00 00:00:00', 1, 0, 1),
(35, 64, 3000, 0, 3000, 0, 2000, '2019-05-20 06:29:23', '0000-00-00 00:00:00', 1, 0, 1);

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
(40, 54, 'Umer', 'Father', '31303-5678987-8', '', '+92-331-7375027', '', 45000, '', '', '8238', '2019-04-06 07:28:02', '0000-00-00 00:00:00', 4, 0, 1),
(41, 55, 'M Yaqoob', 'Father', '98765-4345678-9', '', '+98-765-4323456', '', NULL, '', '', '7589', '2019-05-18 04:31:31', '0000-00-00 00:00:00', 1, 0, 1),
(42, 59, 'M Yaqoob', 'Father', '98765-4345678-9', '', '+98-765-4323456', '', NULL, '', '', '1125', '2019-05-18 04:34:58', '0000-00-00 00:00:00', 1, 0, 1),
(43, 60, 'M Shafquat', 'Father', '31303-9999999-9', 'shafquat@gmail.com', '+92-300-7976242', '', NULL, '', '', '7980', '2019-05-18 04:55:38', '0000-00-00 00:00:00', 1, 0, 1),
(44, 61, 'M Yaqoob', 'Father', '97654-3234567-8', '', '+92-300-7976242', '', NULL, '', '', '9774', '2019-05-18 05:15:57', '0000-00-00 00:00:00', 1, 0, 1),
(45, 62, 'M Yaqoob', 'Father', '98765-4323456-7', 'yaqoob2@gmail.com', '+92-300-7976242', '', NULL, '', '', '7449', '2019-05-18 05:25:06', '0000-00-00 00:00:00', 1, 0, 1),
(46, 63, 'M Yaqoob', 'Father', '88766-7767676-7', '', '+43-456-7898765', '', NULL, '', '', '3152', '2019-05-18 06:05:04', '0000-00-00 00:00:00', 1, 0, 1),
(47, 64, 'M Jamshaid', 'Father', '31303-1234567-8', 'J@gmail.com', '+92-234-567765_', '+87-654-3456787', 90000, 'engineer', 'employee', '3101', '2019-05-20 06:29:22', '0000-00-00 00:00:00', 1, 0, 1);

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
(33, 54, 'Aniqa Gull', '', '', '', '2019-04-06 07:28:03', 4, '0000-00-00 00:00:00', 0, 1),
(34, 55, 'Kinza Mustafa', '', '', '', '2019-05-18 04:31:31', 1, '0000-00-00 00:00:00', 0, 1),
(35, 59, 'Kinza Mustafa', '', '', '', '2019-05-18 04:34:58', 1, '0000-00-00 00:00:00', 0, 1),
(36, 60, 'Kinza Mustafa', 'Friend', '', '', '2019-05-18 04:55:39', 1, '0000-00-00 00:00:00', 0, 1),
(37, 61, 'Kinza Mustafa', 'Friend', '', '', '2019-05-18 05:15:58', 1, '0000-00-00 00:00:00', 0, 1),
(38, 62, 'Kinza Mustafa', 'Friend', '', '', '2019-05-18 05:25:07', 1, '0000-00-00 00:00:00', 0, 1),
(39, 63, 'Kinza Mustafa', '', '', '', '2019-05-18 06:05:06', 1, '0000-00-00 00:00:00', 0, 1),
(40, 64, 'Kinza Mustafa', 'Friend', '+98-765-4334567', 'RYK', '2019-05-20 06:29:23', 1, '0000-00-00 00:00:00', 0, 1);

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
  `barcode` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_personal_info`
--

INSERT INTO `std_personal_info` (`std_id`, `branch_id`, `std_reg_no`, `std_name`, `std_father_name`, `std_contact_no`, `std_DOB`, `std_gender`, `std_permanent_address`, `std_temporary_address`, `std_email`, `std_photo`, `std_b_form`, `std_district`, `std_religion`, `std_nationality`, `std_tehseel`, `std_password`, `status`, `academic_status`, `barcode`, `created_at`, `updated_at`, `created_by`, `updated_by`, `delete_status`) VALUES
(1, 6, 'STD-Y19-1', 'zahid saeed', 'M saeed', '+92-567-8909876', '2019-03-20', 'Male', 'RYK', 'RYK', 'zahid@gmail.com', 'uploads/zahid saeed_photo.jpg', '92876-5456789-8', 'RYK', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '', '2019-03-20 06:42:01', '0000-00-00 00:00:00', 4, 0, 1),
(5, 5, 'STD-Y19-2', 'Aniqa Gull', 'Iftikhar Ali', '+92-345-6789876', '2019-03-21', 'Female', 'RYK', 'RYK', 'asra@gmail.com', 'uploads/Aniqa Gull_photo.jpg', '31303-3456789-8', 'RYK', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '', '2019-04-19 11:46:17', '2019-04-19 11:46:17', 1, 3, 1),
(8, 5, 'STD-Y19-6', 'Sadia Gull', 'Iftikhar Ali', '+92-456-7890987', '2019-03-21', 'Female', 'RYK', 'RYK', 'sadia@gmail.com', 'uploads/Sadia Gull_photo.jpg', '31303-3456789-0', 'RYK', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '', '2019-03-21 12:51:46', '0000-00-00 00:00:00', 1, 0, 1),
(11, 5, 'STD-Y19-9', 'Fatima Bibi ', 'M. Ibrahim ', '+92-098-7654326', '2019-03-29', 'Female', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'fatim44@gmail.com', 'uploads/Fatima Bibi _photo.jpg', '09876-5421223-4', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-29 16:22:45', '0000-00-00 00:00:00', 1, 0, 1),
(12, 5, 'STD-Y19-12', 'Ihsan-ul-Haq', 'M. Ahmed', '+92-876-5433456', '2019-03-29', 'Male', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'ihsan@gmail.com', 'uploads/Ihsan-ul-Haq_photo.jpg', '31303-9876543-3', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-29 16:28:50', '0000-00-00 00:00:00', 1, 0, 1),
(14, 5, 'STD-Y19-13', 'Testing 1', 'M. Ahmed', '', '2019-03-30', 'Male', 'wwwwwww', 'wwwwwwww', '', 'uploads/Testing 1_photo.jpg', '22222-2222222-2', 'asdsa', 'wwwwwww', 'wwwww', 'qqqqqq', '', 'Active', 'Active', '', '2019-03-30 08:01:01', '0000-00-00 00:00:00', 1, 0, 1),
(18, 5, 'STD-Y19-15', 'Asra', 'Mustafa', '', '2019-07-10', 'Male', 'RYK', 'RYK', 'fatim44@gmail.comj', 'uploads/Asra_photo.jpg', '55555-5555555-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'RYK', '', 'Active', 'Active', '', '2019-03-30 08:09:28', '0000-00-00 00:00:00', 1, 0, 1),
(20, 5, 'STD-Y19-19', 'uygjgv', 'ggfg', '+32-222-2222222', '2019-03-05', 'Female', 'RYK', '', 'hdfgd@gvjv.com', 'uploads/uygjgv_photo.jpg', '55555-5555555-5', 'asdsa', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-30 08:16:45', '0000-00-00 00:00:00', 1, 0, 1),
(21, 5, 'STD-Y19-21', 'uygjgvhbhjbj', 'ggfg', '+32-222-2222222', '2019-03-05', 'Female', 'RYK', '', 'hdfgd@gvjv.commmm', 'uploads/uygjgvhbhjbj_photo.jpg', '55555-5555555-5', 'asdsa', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-30 08:18:32', '0000-00-00 00:00:00', 1, 0, 1),
(22, 5, 'STD-Y19-22', 'uygjgvhbhjbjmoiio', 'ggfg', '+32-222-2222222', '2019-03-05', 'Female', 'RYK', '', 'hdfgd@gvjv.commmm444', 'uploads/uygjgvhbhjbjmoiio_photo.jpg', '55555-5555555-5', 'asdsa', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-30 08:19:16', '0000-00-00 00:00:00', 1, 0, 1),
(26, 5, 'STD-Y19-23', 'zahid saeed', 'Mustafa', '+92-234-5678900', '2019-03-30', 'Male', 'Jinnah Park RYK', '', 'zahid@gmail.com', 'uploads/std_default.jpg', '31303-3456789-0', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-30 09:14:53', '0000-00-00 00:00:00', 1, 0, 1),
(27, 5, 'STD-Y19-27', 'Nadia Gull', 'Iftikhar Ali', '+92-345-6789098', '2019-03-30', 'Female', 'Jinnah Park RYK', '', 'nadia@gmail.com', 'uploads/std_default.jpg', '31303-1123456-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-03-30 09:20:27', '0000-00-00 00:00:00', 1, 0, 1),
(30, 5, 'STD-Y19-28', 'Asmat Ara', 'M.Shafi', '+92-345-6789098', '2019-04-01', 'Female', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'asmat@gmail.com', 'uploads/Asmat Ara_photo.jpg', '31303-2345698-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-01 10:58:12', '0000-00-00 00:00:00', 1, 0, 1),
(31, 5, 'STD-Y19-31', 'Aisha Ameen', 'M.Ameen', '+92-456-7898765', '2019-04-01', 'Female', 'Jinnah Park RYK', 'Jinnah  Park RYK', 'aisha@gmail.com', 'uploads/Aisha Ameen_photo.jpg', '87654-3236789-0', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-01 11:06:06', '0000-00-00 00:00:00', 1, 0, 1),
(33, 5, 'STD-Y19-32', 'Saif-ur-Rehman', 'M. Khalil', '+92-333-3333333', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', 'Chak # 145/p, Adaam Sahaba', 'saif@gmail.com', 'uploads/std_default.jpg', '31303-4944949-4', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-02 07:26:24', '0000-00-00 00:00:00', 1, 0, 1),
(37, 5, 'STD-Y19-34', 'Saif-ur-Rehman', 'M. Khalil', '+92-333-3333333', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', 'Chak # 145/p, Adaam Sahaba', 'saif02@gmail.com', 'uploads/std_default.jpg', '31303-4944949-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-02 07:29:36', '0000-00-00 00:00:00', 1, 0, 1),
(39, 5, 'STD-Y19-38', 'Saif-ur-Rehman', 'M. Khalil', '+92-333-3333333', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', 'Chak # 145/p, Adaam Sahaba', 'saif03@gmail.com', 'uploads/std_default.jpg', '31303-4977949-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-02 07:33:05', '0000-00-00 00:00:00', 1, 0, 1),
(40, 5, 'STD-Y19-40', 'Wqas', 'Umer', '+92-345-6789098', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas@gmail.com', 'uploads/std_default.jpg', '31303-8765670-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-02 08:40:50', '0000-00-00 00:00:00', 17, 0, 1),
(42, 5, 'STD-Y19-41', 'Wqas', 'Umer', '+92-345-6789098', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas01@gmail.com', 'uploads/std_default.jpg', '31303-8765679-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-02 08:42:24', '0000-00-00 00:00:00', 17, 0, 1),
(45, 5, 'STD-Y19-43', 'Wqas', 'Umer', '+92-345-6789698', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas02@gmail.com', 'uploads/std_default.jpg', '31303-8785679-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-02 08:46:08', '0000-00-00 00:00:00', 17, 0, 1),
(46, 6, 'STD-Y19-46', 'Wqas', 'Umer', '+92-345-6789698', '2019-04-02', 'Male', 'Chak # 145/p, Adaam Sahaba', '', 'waqas03@gmail.com', 'uploads/std_default.jpg', '31303-8385679-9', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-26 08:35:32', '0000-00-00 00:00:00', 17, 0, 1),
(47, 6, 'STD-Y19-47', 'Sheeza ', 'Umer', '', '2019-04-02', 'Female', 'Chak # 145/p, Adaam Sahaba', '', 'sheeza@gmail.com', 'uploads/Sheeza _photo.jpg', '31303-7654456-7', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-26 08:35:18', '0000-00-00 00:00:00', 1, 0, 1),
(48, 5, 'STD-Y19-48', 'Zahid Saeed', 'M. Saeed', '+92-331-7375025', '2015-02-03', 'Male', 'RYK', 'Chak # 145/p, Adaam Sahaba', 'zahid@gmail.com', 'uploads/Zahid Saeed_photo.jpg', '31303-8489489-4', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-04 05:08:14', '0000-00-00 00:00:00', 1, 0, 1),
(50, 5, 'STD-Y19-49', 'Zahid Saeed', 'M. Saeed', '+92-331-7375025', '2015-02-03', 'Male', 'RYK', 'Chak # 145/p, Adaam Sahaba', 'zahid@gmail.com', 'uploads/Zahid Saeed_photo.jpg', '31303-8489489-3', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-04 05:11:52', '0000-00-00 00:00:00', 1, 0, 1),
(52, 5, 'STD-Y19-51', 'Zahid Saeed', 'M. Saeed', '+92-331-7375025', '2015-02-03', 'Male', 'RYK', 'Chak # 145/p, Adaam Sahaba', 'zahid@gmail.com', 'uploads/Zahid Saeed_photo.jpg', '31303-8489489-5', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'Rahim Yar Khan', '', 'Active', 'Active', '', '2019-04-04 05:14:49', '0000-00-00 00:00:00', 1, 0, 1),
(53, 5, 'STD-Y19-53', 'M. Azaan', 'Asad Shafqat', '+92-333-3333333', '2019-04-04', 'Male', 'RYK', 'RYK', '', 'uploads/std_default.jpg', '31303-0561894-8', 'Rahim Yar Khan ', 'Islam', 'Pakistani', 'RYK', '9127', 'Active', 'Active', '', '2019-04-04 06:58:49', '0000-00-00 00:00:00', 1, 0, 1),
(54, 6, 'STD-Y19-54', 'Inam', 'Umer', '+92-345-6789987', '2019-04-06', 'Female', 'Jinnah Park RYK', '', '', 'uploads/std_default.jpg', '31303-4567777-7', 'RYK', 'Islam', 'Pakistani', 'RYK', '3561', 'Active', 'Active', '', '2019-04-06 07:28:01', '0000-00-00 00:00:00', 4, 0, 1),
(55, 5, 'STD-Y19-55', 'Ali', 'Yaqoob', '+87-654-3345678', '2019-05-18', 'Female', 'RYK', 'RYK', 'ali@gmail.com', 'uploads/std_default.jpg', '98765-4456789-8', 'RYK', 'Islam', 'Pakistani', 'RYK', '2940', 'Active', 'Active', 0x75706c6f6164732f7374645f64656661756c742e6a7067, '2019-05-18 04:31:30', '0000-00-00 00:00:00', 1, 0, 1),
(59, 5, 'STD-Y19-56', 'Ali', 'Yaqoob', '+87-654-3345678', '2019-05-18', 'Female', 'RYK', 'RYK', 'ali@gmail.com', 'uploads/std_default.jpg', '99999-9999999-9', 'RYK', 'Islam', 'Pakistani', 'RYK', '4429', 'Active', 'Active', 0x75706c6f6164732f7374645f64656661756c742e6a7067, '2019-05-18 04:34:57', '0000-00-00 00:00:00', 1, 0, 1),
(60, 5, 'STD-Y19-60', 'Anas Shafqat', 'Shafquat', '+92-345-6788765', '2019-05-18', 'Male', 'RYK', 'RYK', 'anas@gmail.com', 'uploads/std_default.jpg', '31303-4567898-7', 'RYK', 'Islam', 'Pakistani', 'RYK', '6764', 'Active', 'Active', 0x75706c6f6164732f7374645f64656661756c742e6a7067, '2019-05-18 04:55:37', '0000-00-00 00:00:00', 1, 0, 1),
(61, 5, 'STD-Y19-61', 'esha', 'Yaqoob', '+98-765-4345678', '2019-05-18', 'Male', 'RYK', 'RYK', 'esha@gmail.com', 'uploads/std_default.jpg', '45102-9876543-4', 'RYK', 'Islam', 'Pakistani', 'RYK', '3954', 'Active', 'Active', 0x75706c6f6164732f7374645f64656661756c742e6a7067, '2019-05-18 05:15:56', '0000-00-00 00:00:00', 1, 0, 1),
(62, 5, 'STD-Y19-62', 'Ali', 'Yaqoob', '+65-434-5678765', '2019-05-18', 'Male', 'RYK', 'RYK', 'anas@gmail.com', 'uploads/std_default.jpg', '45102-7654327-6', 'RYK', 'Islam', 'Pakistani', 'RYK', '1965', 'Active', 'Active', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414f59414141426b4341594141414353456b786f41414148646b6c4551565234587532645034676c52524447767863715a68714c6d61474a6d594a69497069494a694c2b535551454d524530457231564d524e4d5242417855674d5451304544505467464939464d4578467a5577315879753236563976584d31317a3739316a2f7677654c4c733755394e642f58562f58645656506631326b713657482f45424152435942514950375353646c5a395a614951534941414375674978475155674d443845494f62382b67534e5141434c7952674167546b69674d576359362b67302b5952674a6962487749414d456345494f5963657757644e6f3841784e7a38454143414f5349414d6566594b2b693065515167357561484141444d455147494f6364655161664e497741784e7a38454147434f4345444d4f66594b4f6d3065415969352b53454141484e4541474c4f7356665161664d49514d7a4e447745416d434d4345484f4f76594a4f6d306341596d352b43414441484247416d4850734658546150414a35597036666e35396e344e7274646a4a522b323066663879763237556f5538734f79586c5a39624e4435593370304b6f2f36706d7471796658757a2f5539696c595a657559696e4d5056792b7637742f59373150377370592f7447325a4d5a6763307865442b585166694e6b61594e6b42305a5072335965592b306e386b4834597737466e48444a63327a6e444d384c486b59475968777949487646363979456d78427a674d6353456d4a65584669304c4d2b54365a313356326930656d7242775a612f5446474a4354496a5a387a35785a5576514b424e513641564943503463466d516a2b4c4f6e4b3853456d4e636a3271334a7162556d7a61356a696372754a366f34366653735a5a456c4b707464743241784c36656b736d6d6b6d736844367a38734a68627a55733454596c3451446f75357a345066374b5244486a503441327777754e6948305571304832765369565950562f624744533154786943753741517251504148697a6c6c596d4f4451574a366d544a62745753505a56574979684b56785a58466c57314755374e755a6c614f71477a656b386a7531303759476c7557454a584659684c386d6270477835564e54432b347367522f73696d5a5937336c417a456835715658316e6f75614f382b6d396a5a784435414b66624b736c65577662493965384d616b793135624d6b72372b4f544c70484f6450457a2b754545672f33614d657543347371326f366844755044613133554b3473726979754c4b396f7753726979754c4b347372717a4e4531684d4c4359574534735a5a734e4969454e4f567575396e7554726d5a3463702b514e6e327a4930534c732f426c3835536b6253426b69504d52737637395a347a4a6c4973767530687171677730476737596156785a58466c635756785a5874766b4339465276494d6f6638757a593633555a44774f4c3261503054642f48596d4978735a67392b70417549563143756f523043656d536f624e6b737535685436353350377544614379436e613244552f49344a59387646654c4d6e31484c7a3561386e76504d426f4e6265764a413170706c35546a4267424d4d627141306d396a5a784e374c4f3035316c33766c48544a68636252495257464f4d4f4145673570516244446f75713631414f6b533069576b5333713049563143756f523043656b533069576b533462587a657a38326474524c4359574534754a78635269596a47786d4c33315a6645634f504135757a4736393431596645554358354841567953456159643043656b533069555a4f7a77715137714564416e706b68364e435034512f434834512f434834412f424834492f5057744a384565367154635365766b32582b2f303544694d69384f34686b694b4b3473726979754c4b3473726979754c4b347372753576324c6c33326a59536569346f72752f386933436e6e392f5a776255577a65653072512f4f55444f6b533069576b533370555959334a47704d314a6d744d317069734d566c6a39717a6c374e4d6c6d5159674177496763425145386d764d6f3152484953414141686b45494759474a575241344d5149514d775441303531494a424241474a6d554549474245364d414d51384d6542554277495a4243426d4269566b514f44454345444d45774e4f64534351515142694e6c433655394b486b73346b2f53377041556b2f464c6c764a44306a36652f79762f333970365166792f3952396c6c4a583154502b3757365769766e38334452362f6c483067655358704c30736152584a643165796e32307944385936713931663150534f3558636261464d722b63755356394b75692f6f454d754e2b73593244736c6b42683879777768417a4159326a30743657744b5651457754632f4c5a33305941493532527777656e44666a584a483155796e78503068766c2f72666c6d743933597265367867622b5061563849395a336a6271666c50524a516e63584d5831666c76532b704c736c6d61362f6c456e443632724a2f6c765663612b6b46776f3239543249646a774549475a6a34443157726e316469466c62786668497647654431703431433265662b726c49334346696d73787a6b6a34726c7448495a455331436541745365394b71757478666679362f652b36312f64634e3738654a77472f5a685054623658743956437a652f624d36354a2b6c665455674e7a786875673253344b596f64386a635a3450677a75366d55344f6632774b4d63634933694b4b456333633656636b6d55763774715250693643376e64486c64577363646263795450616e34675a484b78657471463976585976554d41762b5233445248796d5478546270632b74614454454474704534747061727259364a3174637a78507935574e46725a5542624f5550727442636c665658577344564a577352326932646c2b6c71337058736b75566c72653835494674664c72706639647266644a7957336a766548656e6f6b766e58446476306c51387a537833484e364e31657532706d556431715756436f646c6574444639586d6f567257624378495758507837566a724f2b76527431652f7832536e696a7537706a75726f384665714c4c4858574b45304e4c56794f3057386e34392f717063746f5751737742764b5056695a484e4f716f36467057316f4a4374315478493546574e52547672514979376f68597462555635505649625856545833636a7345563272322b757449384178327573426f7248416a754e52523668504f335458585276455848662f307271464967417846397078714c31754243446d757675583169305541596935304935443758556a4144485833622b3062714549514d79466468787172787342694c6e752f715631433055415969363034314237335168417a4858334c3631624b4149516336456468397272526742697272742f6164314345594359432b3034314634334168427a3366314c3678614b414d5263614d656839726f522b4a2b593330753675753532306a6f5157425143442f38486c7772383646567161544541414141415355564f524b35435949493d, '2019-05-18 05:25:05', '0000-00-00 00:00:00', 1, 0, 1),
(63, 5, 'STD-Y19-63', 'btfgbgtftg', 'drvrd', '+45-45_-_______', '2019-05-18', 'Female', 'RYK', 'RYK', 'ali@gmail.com', 'uploads/std_default.jpg', '76543-7887654-3', 'RYK', 'Islam', 'Pakistani', 'RYK', '4850', 'Active', 'Active', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414e494141414261434159414141444e65676a3341414147596b6c45515652345875326476367464525244487637645537477973524e4a6f4a3169496f42424a49316861714b43576f6f694e5943654a6957496e32496767597155574e7061436a515a55734c445253687678443942577978636d64796476337234395a2f66634f77624466673438386e4c762f706a7a50664d3938324e6e392b306b5853382f3467494245446749675973375356664c7a30456a30416b4551454276517953304141534f52774169485938684934414146676b644149454d424c42494753677978765149514b5470565141414d68434153426b6f4d7362304345436b36565541414449516745675a4b444c4739416841704f6c5641414179454942494753677978765149514b5470565141414d68434153426b6f4d7362304345436b36565541414449516745675a4b444c4739416841704f6c5641414179454942494753677978765149514b5470565141414d68434153426b6f4d736230434977543665546b35475145727431754a3274712f39726c3366787a2b79793271622b502f587274366e6d4f3762736d53307675577237364876332b652f6652613766302f65683853396a33356e56386277664f6353374875695666533665576e734f49446737713946365a6c792b4956442b736d6a42624831776b3436696939747042705057584d305171316d744a6558747638747678706f52493535583476374438574b544b334f4861375433674c63714752546f6c61382b69623332783963494c584c74474c4c5a46655676576a4268707239424c3857416b66492f38612f4856326877517156416269345246617355737656675531773758626a454c4f6672573772556a32554379676652335751706f76584758334d74443039716a684275646c2f5433336b7273504759672f54336d39784d6a45534f3175414b52676a555943614168456b534353465531785346725542414a496b456b69485254422b713435706a596a42694a474b6c627a386336306d6b7435434857753564705a42317049544e4230657235596c754b5676664679577457622f534678546f53363069734979556b6453415352494a4945496c74464c33536c6131466b7231617362584d344a4b624e4a704547473348677579706d3037524b6b57727479796872354642704c50784768763746744b344934757132646b6b4c424c376b6168735350446449524a45676b67516154553166597a31507159762b354547496a503249374566696631494b305268515a5946325769467345686e79454c366d2f54335964554a45416b696e566c4168556751715265786b477767325543796f584e49615939455a636d4641794c58546e68746e547055723157522f6962396a555843496d475273456a2f443938646934524677694a686b6242495743517330745a69564970574b56706454556c765352686b72322f6732754861346472683275486134647268327548616e5438566161754830476f666c7a685952324a6a48787637716f4e58316f706c612f4c45634b46484a6c7737584474634f317737584474634f3177372f68687a2b4750557662506665706e47306254326144734f502b48776b334e4858395831636a326c33486f43364e62676c6c4f4532767532656c58326e477458525772736b4757484c44746b56394958374a426c683279304b746d574834754552654b6b315954734b4553435342414a496e466d517938494a746c417252304c73676c76536f67456b534153524b4b7967636f474b68756f624b437967636f474b68733248587447316f367348566d3742426361496b456b6941535278745066765430626641384345794d416b535a2b2b4e7836486749514b51394c52706f59415967303863506e31764d516745683557444c537841684170496b66507265656877424579734f536b535a4741434a4e2f5043353954774549464c413867564a6e34662f6679504a50767462306d564a37306a797a367a5a46354b654b7532666b50526a364776742f796874764b39395862667a4c6b747a507954706832714f75795239494f6b565352394c656b50534d78746b2f796630743646664c484b364c46483257745565442f4a636b6652756e69376530534e42704958485a77727a514645775533496e6a6a652f74796a764a34332b4478626c2f723553554f767a6d7154334a6632376f6a592b393165533370543055576e376e7153334a426d35316d54727957354566456e535a7730356c6d5276695773452f6c72533733633042584b456830674e484b4f6932646576536e7055307650424174777636656e795a6f3944574639542f6c386c33564d52795a533031616675373070756e3063694f516b6671596a305a37434749374c667655446f4e646c726d4c79746b647773397577585247706f5148796a6d785835554e4c5638755931742b64625358394a2b6c4c53773848644d3455793632574b625a646244534f5174663270574b6f52613252756f313032762f312b6e36546e7774766658634861765271522f6266676c763453786d334a33694b51755a575056664a41704b496b70696863657752656c6d52756c52476a66764e47525857382f4c4f666738567074544e4347633676462f65736a6e337175574e37693275755366705530724d682f724a354c6f56595a6176736269584e52584e7257627547466a644777706d634871655a6578686a77316c314349745550666c57374f4e577942516d2f753564505961365542495363636759795066636f587275326858306d4d5155336d4f54324f5951325a32494a724d6c55355a6b627848454c5268456b69425370534574532b4c756c57586f334a574b325376506e4557584c53594d504d4e6d5579316c37657937317477786d2b647a52336d69705269563356334e326932744c6179376c7847696c6a797a577146343378414a4c5143424241516755674b494441454345416b644149454542434253416f674d4151493369665364704f7467415149676344414354393441666f7a65364c775843647341414141415355564f524b35435949493d, '2019-05-18 06:05:02', '0000-00-00 00:00:00', 1, 0, 1),
(64, 5, 'STD-Y19-64', 'Sana', 'Jamshaid', '+98-765-4323456', '2019-05-20', 'Female', 'RYK', 'RYK', 'sana@gmail.com', 'uploads/Sana_photo.jpg', '45102-1234567-8', 'RYK', 'Islam', 'Pakistani', 'RYK', '2125', 'Active', 'Active', 0x646174613a696d6167652f706e673b6261736536342c6956424f5277304b47676f414141414e5355684555674141414e494141414261434159414141444e65676a334141414771556c45515652345875326476597374525244467a77324e4e5259784d54517845425155417755544d305555457848425241517a306563485a6f4b4a43415a47616d41696d4169612b45444e486f4b5a4a75492f6f4b47474b37573361312f64766a3154506666324a71392f463562646e592b656e6e5072394b6d717270375a5362705a66735148424544674a41516532306c36742f79633141496e6751414936415a457767704134487745494e4c35474e4943434b4249324141496a45414152527142496d314d6a7742456d7434454147414541684270424971304d54304345476c3645774341455168417042456f307362304345436b3655304141455967414a46476f45676230794d416b6159334151415967514245476f45696255795041455361336751415941514345476b45697251785051495161586f54414941524345436b45536a5378765149514b547054514141526941416b55616753427654493942507049754c69347365754861376e6578512b3230665038323332375a3454483373306e4865566e3375556e747266576864502f617a3931725a635576374d34797965347a74746a426575722f346e597a4165665233576666707576434e2f653630366230784c3338676b684d4f4968304f66686d5a367747794e5468734a537445436b7a4e527476526f78694b644b7a364b464b2f5634516946526353496b476b6e6f476a647565692b6d566b32726c506a477533442b2f57414d65317737566234676c45576b68346b477a596b365956353251426669756d6a4e764f535767514978456a585755716535517469794f7a514a2b73336436374f44557253746175704e5637526b5853333764565a305247726555616a3034636f55676f456f72556d442f63366a35434a4967456b53425333305030715777347a76786c67666d70506a7778306e6f4d3543376c716667534978456a4851585a626b77393666317a4d6d7245534b757a545a514955534a304f4c2b57715778506f7164756f795a687069535a346d54377336776f696f51696f55696c647072304e395866427855575061375a326f6a65637a377037385034466b56436b56416b464b6c646b734a36704c7a6f46455736586330396f6e494552554b525543515543555671466376327844676f456f724555764f47696d627057535a6b6d5a424e4d314b6a4378327a69636965455839726a646453584e6662446b54617834586e4c6d664a35714e696972794f69316a59463271363170346251505533316438514b5153557661502f306769484968305336745371413071454b424671726752744553387250656b7464636e61776258447456756c355a4b684c666d6e317a586a7674565165324d62694e544f6e724855584253745572524b3057716d446a7a386849656648475848694a474f362b346755694d707365526d5a476e796e744954584474637577585334647268327548616f55676f3071554e394d796e58556478384f6a4a3961314a48795a6b71306e563055756779646f64756d44586c52324653466461686d754861346472683275486134647264304a5263443276435a4567456b5343534e64584130614d524979305672534d497246436c685779724a426c685377725a4e6666775554364f3052726d5673314f6d5761565378736d57664a71726170624b437967636f4733746a58664b6651317347424a3630327163513845764e497a434f522f69623954667162394466703736566e43764155495a346978464f454271526e49524a45676b675136637264354e57586a65694c4e2f62787872354d4b6339647173453845764e4976454f5764386a7944746d7449324876732f5a4f585869576a667978335330547a71505866593265584e2f36505a794b4c375632314e7052617a6367426f564945416b695153534b56696c617057673171364a6750776a4d6a45422f7264334d4b484876494a4167414a457745524159674142454767416954594141524d4947514741414168427041496730415149514352734167514549514b5142494e49454345436b686733634c656b54366249473851394a6a306a3675527a33766151584a5031642f72652f2f354c30532f6b2f48767569704b2b71383333626b756e5a2b666556382b7759612f2f4c6376436a35547278477539492b69413031747633427952394c656c425364616e572b462f62383676462f74366c3653504a62307136544e4a62306a36447835746547506652474139492b6c35535463436b657a326e537a3274786d736b655170535735775a6d52765376713059505768704c664b2f682f4b4e742f76524852596f34453632577a626b354b2b4c64643754644a486c654761495839582b6d6c74396662642b316233772b2b746453336246346c754a4c655034544437423057714c4d42473671664c4e6a6651576e58694b5847666e32736a7471744a564b7449744a594231345961723250457259323762712b33373061474a79533958796d6458382f492b4873675a2b784854615234667a4f5443534b46627a3861356b746870492f755665314b6253485347694739473756723539756a3872683650537a7075574c77572f70752f62692f754952477670654c2b70714c31694a73545244486f385943497056345947596761675770586161575164666e4c436e53727957752b436d345154484f69624649545352334953304f6971366c5864734a3955574a7131776473723766452b4b77577458732b766278617a6c706669756b665662536e7948324d32574c4d6471734e6f51696c57382b786a7875444734386c6e4277773331503075664237596b715932313437504676694a6569756d5747466f6e553477726139662b523948714a3133723662736534437431624b6449726b72344a795a53367635476b3963435233647564764238694c58793730574465447646456e5856627939715a306c697334556b4a7631517247395a7937574a6d7a6659377352384b6d6279576539585439317070624c446f6365766967464d504e48637955624a376730675a5175774867513445494649485342774341686b4345436c446950306730494541524f6f4169554e41494550676b6b672f5372715a48636c2b45414342525151652f78393241752f6f4a635476364141414141424a52553545726b4a6767673d3d, '2019-05-20 06:29:21', '0000-00-00 00:00:00', 1, 0, 1);

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
(4, 5, '2019 - 2020 ', '2019-03-01', '2020-03-31', 'Active', 4, '2019-05-25 18:29:22', '2019-03-16 07:04:49', 1, 1, 1),
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
(6, 2, 'Math,English A,Urdu A,Drawing'),
(7, 3, 'Math,English A,Urdu A,Islamiat,Computer'),
(8, 4, 'Math,English A,Islamiat'),
(9, 5, 'Math,Urdu A,Islamiat'),
(10, 6, 'English A,Urdu A,Islamiat'),
(11, 7, 'Math,English A,Computer'),
(12, 8, 'Math,Science,Islamiat'),
(13, 9, 'Math,English A,English B'),
(14, 11, 'Math,Urdu B,Urdu A,Islamiat'),
(15, 12, 'Pak-Studies,Urdu A,Islamiat');

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
(1, 1, 0, 2, 1, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(2, 1, 0, 3, 1, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(3, 1, 0, 4, 1, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(4, 1, 0, 2, 8, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(5, 1, 0, 3, 8, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(6, 1, 0, 4, 8, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(7, 1, 0, 2, 10, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(8, 1, 0, 3, 10, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(9, 1, 0, 4, 10, '1 Lecture', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(10, 2, 0, 2, 2, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(11, 2, 0, 3, 2, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(12, 2, 0, 4, 2, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(13, 2, 0, 2, 4, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(14, 2, 0, 3, 4, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(15, 2, 0, 4, 4, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(16, 2, 0, 2, 7, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(17, 2, 0, 3, 7, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1),
(18, 2, 0, 4, 7, '1 Lecture', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1);

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
(1, 1, 'Kinza Mustafa', '2019-05-23 04:13:13', '0000-00-00 00:00:00', 1, 0, 1),
(2, 3, 'Nauman', '2019-05-23 04:13:41', '0000-00-00 00:00:00', 1, 0, 1);

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
(70, 5, '', '', '98765-4456789-8', 'ali@gmail.com', 'Student', 'W3GDqi3Jmy_DV2Gu3Yx13hyN8D3aBSBs', '$2y$13$cyMfIJft7ywHpIjVSyiCnuxXXLw499lWARumLQaXgKzp4rG3WuksS', NULL, 'uploads/std_default.jpg', 1, 10, 1558153891, 1558153891),
(71, 5, '', '', '98765-4345678-9', '', 'Parent', 'W4uhkfDVMdQ_91gqFduxYmnkjedjkUCN', '$2y$13$8LpiJ9fSGBMQ2FZ83DdW4.sOkVcr9Q3JgZF1cIyc.gWl/L1eXpGI6', NULL, 'uploads/std_default.jpg', 1, 10, 1558153891, 1558153891),
(73, 5, '', '', '99999-9999999-9', 'ali@gmail.com', 'Student', 'qtjx9YoipziNS-2DSDQe6ipdNNpw3xte', '$2y$13$SsL5V/ylMKVNf9Av2dUyKeXgigNu5yntIgc91bhbTE3HOzu6Pk3sG', NULL, 'uploads/std_default.jpg', 1, 10, 1558154098, 1558154098),
(74, 5, '', '', '31303-4567898-7', 'anas@gmail.com', 'Student', '16HU1ctpdhXi_uhCr8UxUAMm9Lb7WRhS', '$2y$13$Lsp05UG2mkjL7ByfTMru1./w7IPLJ80O.fXz.bYJpukOVMxtGH896', NULL, 'uploads/std_default.jpg', 1, 10, 1558155338, 1558155338),
(75, 5, '', '', '31303-9999999-9', 'shafquat@gmail.com', 'Parent', '9VtgcyTcwfT4pTOqZBCLc8tkeP3tKx_q', '$2y$13$zu1vXGz7vx1dyyTrJ1Fs6exqdEEFSgB/0bDhcrFQ0lp3bZiHyY2ee', NULL, 'uploads/std_default.jpg', 1, 10, 1558155339, 1558155339),
(76, 5, '', '', '45102-9876543-4', 'esha@gmail.com', 'Student', 'KEpuhlNnDBZxH3ZbKSA1Kia3CmW19ONt', '$2y$13$zW8WKra3GMOicnk04ZqTV.9s4a3hqYvPOaXLqXFLjM863hEhHlLBi', NULL, 'uploads/std_default.jpg', 1, 10, 1558156557, 1558156557),
(77, 5, '', '', '97654-3234567-8', '', 'Parent', 'dCMrspFNmiv-0iu-y8lbddzMVecM3hAr', '$2y$13$9KLlzbjGwSsOneOH9Y/UpOVm5xlAnwJMQ9eNOoDOEC54SgUbSp0he', NULL, 'uploads/std_default.jpg', 1, 10, 1558156558, 1558156558),
(78, 5, '', '', '45102-7654327-6', 'anas@gmail.com', 'Student', 'JsAKIrilxfbG_1C_F7g0oNWtMxOEW7qp', '$2y$13$5vJ3nJAcdvVXsVsPYpdxBe5GXkCp.jPh4nzz3Vx6uKCbu7vyAtBOu', NULL, 'uploads/std_default.jpg', 1, 10, 1558157106, 1558157106),
(79, 5, '', '', '98765-4323456-7', 'yaqoob2@gmail.com', 'Parent', 'CS_baCyXQ-i-S_1YdqqAobZ6W03VLAR5', '$2y$13$UtFfLbj7zoLabSr/nIXE5uxRSJORpQjlKsXGFFrz8wpTzKbCHMGz2', NULL, 'uploads/std_default.jpg', 1, 10, 1558157107, 1558157107),
(80, 5, '', '', '76543-7887654-3', 'ali@gmail.com', 'Student', 'jAeefAtIw2lg1xFpEDUqAXPV8I_y8C4p', '$2y$13$egCk36p/RKveGc9qd0zX7.HbGBWa5uWLKKku6QhMlC4zP6cg6cmni', NULL, 'uploads/std_default.jpg', 1, 10, 1558159504, 1558159504),
(81, 5, '', '', '88766-7767676-7', '', 'Parent', 'FcAbwynw9o7pJd8zWsG-gqnHc7HPv9u7', '$2y$13$AuukaiQIYO1xFCpENF19kOeaqy3RpEsKtkP/ZOTvqkF40TXw/wtkS', NULL, 'uploads/std_default.jpg', 1, 10, 1558159506, 1558159506),
(82, 5, '', '', '45102-1234567-8', 'sana@gmail.com', 'Student', 'kFgRtXZW_kcwwbnsuTuJ8xGfTktgdTLb', '$2y$13$Fg2JySSUJ6ui58f.Iruiy.7okbGdJrf9Sr2qE7vNq1bcosrW3G.j.', NULL, 'uploads/Sana_photo.jpg', 1, 10, 1558333762, 1558333762),
(83, 5, '', '', '31303-1234567-8', 'J@gmail.com', 'Parent', 'lYVbQL4KXHg0BsTMoRGu-sskYW7i6I19', '$2y$13$kUWn4jFpcAn9mhCIrnuefOgO41IOMnM4/LTPf8wutn3bN7dq/d.Ea', NULL, 'uploads/Sana_photo.jpg', 1, 10, 1558333763, 1558333763),
(84, 6, '', '', '31303-9879879-8', 'hira07@gmail.com', 'Teacher', 'o3wpz8nkafSysFh_sQFzjhaUx6Hb4Qv9', '$2y$13$SXeO/5nGlCPfA790n8Z/JONAGfVMRtwD1kTpbCeqiV9nlYtA2XNWq', NULL, 'uploads/Hira Tahir_emp_photo.jpg', 1, 10, 1558335419, 1558335419),
(85, 5, '', '', '31303-1231231-2', 'hira07@gmail.com', 'Teacher', 'I74cz6DnDzckHjA-z5scw5I3xC5lhCp-', '$2y$13$gz4ItTKinJuXo3KFI6MIdug6MWHzORBPV9fDHXy2DjRvwD5dRz./2', NULL, 'uploads/Laraib Mariyam_emp_photo.jpg', 1, 10, 1558338484, 1558338484),
(87, 5, '', '', '87556-8765676-5', 'nawal@gmail.com', 'Teacher', '2cWZD1JATKh0Z6B5EHlDGCyW87hCCPB_', '$2y$13$KdxGWVfEWyoAhyWhEgrGKO2uM.B4sa8oXI015XxbIvpmFF8v5o/jO', NULL, 'uploads/Nawal Shareef_emp_photo.jpg', 1, 10, 1558419974, 1558419974),
(88, 5, '', '', '23456-7898765-4', 'nawal@gmail.com', 'Teacher', 'dMUoOYFiR1V0rSdkTe5ox7DPWJvc3Z5p', '$2y$13$rxjoLGleK5mEyG2UwNY97uAHboLm5onCDq9LFH7ln6.LF1nSBItui', NULL, 'uploads/Musaab Shareef_emp_photo.jpg', 1, 10, 1558503680, 1558503680),
(89, 5, '', '', '34567-8987654-3', 'nawal@gmail.com', 'Teacher', '6ky2b6m8TMPhU1WbeDmO8spvJl9T8_qq', '$2y$13$62p.582GXDklQ76TJZ2ZGO2f/sMkYltIta9umra/ystXd2htKV2T6', NULL, 'uploads/Nawal Shareef_emp_photo.jpg', 1, 10, 1558504085, 1558504085),
(91, 5, '', '', '87654-3456788-7', 'musaab03@gmail.com', 'Teacher', 'RIov9ieAmm7mxBj6bN0SdJuZHo9TLnPH', '$2y$13$vVPti/EHh1eKM6albQTEieegDjEwVufUqC2XRmJ1QAlje/O3tuyyi', NULL, 'uploads/ertyui_emp_photo.jpg', 1, 10, 1558505171, 1558505171),
(93, 5, '', '', '67548-6547864-3', 'adeela@gmail.com', 'Teacher', 'qiHIw7XwhEMcZHBM-jm4aOG8m0QTKCb1', '$2y$13$KGb0AJJOZEmmdRn5Uq4sgOJQuG2fMSwUbfQkRYwDLW2FHhRFOvTgS', NULL, 'uploads/Adeela Atif_emp_photo.jpg', 1, 10, 1558513016, 1558513016),
(94, 5, '', '', '77788-6669966-6', 'hira@gmail.com', 'Teacher', 'PpI1X2AuwiIcZ50XjnfH9DQc5gjaz4jI', '$2y$13$9rVstqNohIStR5NxTSsyDOiKvGCS/losOPXdYRsxxWsUechxkTXXa', NULL, 'uploads/Hira Farhan_emp_photo.jpg', 1, 10, 1558513633, 1558513633),
(95, 5, '', '', '89646-7892536-8', 'ali09@gmail.com', 'Teacher', 'rI4lSJH27t92-vzPnqpAO8UsbUKew5Xk', '$2y$13$iEshCWvtT3TzfxeRQovJhehS8g0G3KkyRlgTGdKwEx0Wb75K43slC', NULL, 'uploads/Ali Irshad_emp_photo.jpg', 1, 10, 1558514376, 1558514376),
(96, 5, '', '', '46897-6456775-4', 'saad@gmail.com', 'Teacher', 'UAG9dHpiqQjDTU3ySEHDS-Se31yQUAO-', '$2y$13$vOOCf9VIhaXUzS93.o6Eq.uDj0Af85kBf2a.RxAaq8pGdQb6uT.s2', NULL, 'uploads/Saad Shareef_emp_photo.jpg', 1, 10, 1558514544, 1558514544);

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
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
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
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `emp_reference`
--
ALTER TABLE `emp_reference`
  MODIFY `emp_ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
  MODIFY `exam_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `month_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `fee_transaction_detail`
--
ALTER TABLE `fee_transaction_detail`
  MODIFY `fee_trans_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `fee_transaction_head`
--
ALTER TABLE `fee_transaction_head`
  MODIFY `fee_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
-- AUTO_INCREMENT for table `marks_head`
--
ALTER TABLE `marks_head`
  MODIFY `marks_head_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marks_weightage_details`
--
ALTER TABLE `marks_weightage_details`
  MODIFY `weightage_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `marks_weightage_head`
--
ALTER TABLE `marks_weightage_head`
  MODIFY `marks_weightage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
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
  MODIFY `academic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
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
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
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
  MODIFY `std_guardian_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `std_ice_info`
--
ALTER TABLE `std_ice_info`
  MODIFY `std_ice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `std_inquiry`
--
ALTER TABLE `std_inquiry`
  MODIFY `std_inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `std_personal_info`
--
ALTER TABLE `std_personal_info`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
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
  MODIFY `teacher_subject_assign_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `teacher_subject_assign_head`
--
ALTER TABLE `teacher_subject_assign_head`
  MODIFY `teacher_subject_assign_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- Constraints for table `exams_room`
--
ALTER TABLE `exams_room`
  ADD CONSTRAINT `exams_room_ibfk_1` FOREIGN KEY (`exam_schedule_id`) REFERENCES `exams_schedule` (`exam_schedule_id`),
  ADD CONSTRAINT `exams_room_ibfk_2` FOREIGN KEY (`class_head_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`),
  ADD CONSTRAINT `exams_room_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `emp_info` (`emp_id`),
  ADD CONSTRAINT `exams_room_ibfk_4` FOREIGN KEY (`exam_room`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `exams_schedule`
--
ALTER TABLE `exams_schedule`
  ADD CONSTRAINT `exams_schedule_ibfk_1` FOREIGN KEY (`exam_criteria_id`) REFERENCES `exams_criteria` (`exam_criteria_id`),
  ADD CONSTRAINT `exams_schedule_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

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
  ADD CONSTRAINT `marks_head_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `std_personal_info` (`std_id`),
  ADD CONSTRAINT `marks_head_ibfk_3` FOREIGN KEY (`class_head_id`) REFERENCES `std_enrollment_head` (`std_enroll_head_id`);

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

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
