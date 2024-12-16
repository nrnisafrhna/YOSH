-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 04:40 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yoshmyfundactionmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `volunteerID` varchar(50) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`volunteerID`, `address1`, `address2`, `district`, `state`, `postcode`) VALUES
('55', '', '', '', '', '0'),
('56', '', '', '', '', '0'),
('65', '', '', '', '', '0'),
('66', '', '', '', '', '0'),
('67', '', '', '', '', '0'),
('68', '', '', '', '', '0'),
('69', '', '', '', '', '0'),
('70', '', '', '', '', '0'),
('71', '', '', '', '', '40150'),
('72', '', '', '', '', '0'),
('73', '', '', '', '', '0'),
('74', '', '', '', '', ''),
('75', 'no 17 jalan suasana 6', '', 'taman templer suasana ', 'rawang', '48000');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(50) NOT NULL,
  `attendanceDate` date NOT NULL,
  `attendanceTime` time NOT NULL,
  `attendanceStatus` varchar(20) NOT NULL,
  `eventStatus` varchar(20) NOT NULL,
  `eventID` varchar(50) NOT NULL,
  `volunteerID` varchar(50) NOT NULL,
  `markID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `attendanceDate`, `attendanceTime`, `attendanceStatus`, `eventStatus`, `eventID`, `volunteerID`, `markID`) VALUES
(7, '2024-07-15', '20:35:39', 'PRESENT', 'Ongoing', 'E001', '73', ''),
(8, '2024-07-15', '18:43:46', 'SELECT ATTENDANCE', 'Ongoing', 'E001', '72', ''),
(9, '2024-07-15', '19:33:13', 'SELECT ATTENDANCE', 'Ongoing', 'E001', '71', ''),
(10, '2024-07-15', '20:28:28', 'SELECT ATTENDANCE', 'Ongoing', 'E001', '74', ''),
(11, '2024-07-16', '04:01:05', 'PRESENT', 'Ongoing', 'E001', '75', ''),
(12, '2024-07-17', '04:00:40', 'SELECT ATTENDANCE', 'Ongoing', 'E001', '75', '');

-- --------------------------------------------------------

--
-- Table structure for table `commitment`
--

CREATE TABLE `commitment` (
  `volunteerID` varchar(50) NOT NULL,
  `prefferedTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commitment`
--

INSERT INTO `commitment` (`volunteerID`, `prefferedTime`) VALUES
('75', '2024-07-23 01:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `educationoccupation`
--

CREATE TABLE `educationoccupation` (
  `volunteerID` varchar(50) NOT NULL,
  `workStatus` varchar(100) NOT NULL,
  `maritalStatus` varchar(100) NOT NULL,
  `highestEducationLevel` varchar(100) NOT NULL,
  `previousUniversityCollege` varchar(50) NOT NULL,
  `previousHighSchool` varchar(50) NOT NULL,
  `companyName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educationoccupation`
--

INSERT INTO `educationoccupation` (`volunteerID`, `workStatus`, `maritalStatus`, `highestEducationLevel`, `previousUniversityCollege`, `previousHighSchool`, `companyName`) VALUES
('55', '', '', '', '', '', ''),
('56', '', '', '', '', '', ''),
('65', '', '', '', '', '', ''),
('66', '', '', '', '', '', ''),
('67', '', '', '', '', '', ''),
('68', '', '', '', '', '', ''),
('69', '', '', '', '', '', ''),
('70', '', '', '', '', '', ''),
('71', '', '', '', '', '', ''),
('72', '', '', '', '', '', ''),
('73', '', '', '', '', '', ''),
('74', '', '', '', '', '', ''),
('75', 'student', 'single', 'Diploma', 'UiTM', '', 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` varchar(50) NOT NULL,
  `eventPhoto` varchar(100) NOT NULL,
  `eventName` varchar(100) NOT NULL,
  `eventDate` date NOT NULL,
  `startEventTime` time NOT NULL,
  `endEventTime` time NOT NULL,
  `eventLocation` varchar(1000) NOT NULL,
  `registrationDue` date NOT NULL,
  `eventFee` decimal(10,2) NOT NULL,
  `eventStatus` varchar(50) NOT NULL,
  `eventDescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `eventPhoto`, `eventName`, `eventDate`, `startEventTime`, `endEventTime`, `eventLocation`, `registrationDue`, `eventFee`, `eventStatus`, `eventDescription`) VALUES
('E001', 'Poster-_I_Need_People_-_Cosway_-_AFA_3.png', 'I need People', '2025-01-29', '19:01:00', '22:00:00', 'Pasar Seni', '2025-01-27', '10.00', 'Active', 'I need people adalah program di mana kita akan menyantuni rakan jalanan ( feed the homeless).Antara aktviti kita akan menyantuni dengan memberikan makanan tahan lamaTempat: Pasar SeniMembawa makanan kering dan tahan lama seperti roti,biskut,barang kebersihan berus gigi,ubat gigi,sabun mandi.'),
('E002', 'rezekiUmmat.jpeg', 'Rezeki Ummat', '2023-05-03', '09:30:00', '12:30:00', 'Keramat,Bangi,Lembah Subang,Pandamaran Klang\r\n\r\n', '2024-05-01', '20.00', 'Expired', 'Membantu untuk mengambil data penerima bantuan,menyantuni yang tidak upaya'),
('E003', 'cultureExhange.jpeg', 'Culture Exchange', '2024-08-18', '08:00:00', '14:30:00', 'Masjid Kota Kemuning,Shah Alam\r\n\r\n\r\n', '2024-08-16', '0.00', 'Active', 'Meraikan pelbagai budaya berkongsi dan mengimarahkan Masjid di Kota Kemuning,menjadi fasi untuk pertandingan mewarna,mengenali budaya berlainan di dalam dan luar negara.\r\n\r\n'),
('E004', 'rezekiUmatBerkelompok.jpg', 'Rezeki Ummat Berkelompok', '2024-07-12', '09:30:00', '12:30:00', 'PPR Putra Ria Jalan Bangsar Kuala Lumpur.', '2024-07-10', '60.00', 'Active', 'Membantu untuk mengambil data penerima bantuan,menyantuni yang tidak upaya\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `eventparticipants`
--

CREATE TABLE `eventparticipants` (
  `volunteerID` varchar(50) NOT NULL,
  `ePaymentID` varchar(50) NOT NULL,
  `ePaymentStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventparticipants`
--

INSERT INTO `eventparticipants` (`volunteerID`, `ePaymentID`, `ePaymentStatus`) VALUES
('55', '1', 'Pending'),
('55', '2', 'Pending'),
('55', '3', 'Approved'),
('56', '4', 'Approved'),
('56', '5', 'Approved'),
('56', '6', 'Approved'),
('56', '7', 'Rejected'),
('56', '8', 'Approved'),
('56', '9', 'Approved'),
('66', '10', 'Approved'),
('67', '11', 'Approved'),
('67', '12', 'Approved'),
('66', '13', 'Pending'),
('67', '14', 'Approved'),
('71', '15', 'Approved'),
('72', '16', 'Approved'),
('72', '17', 'Approved'),
('72', '18', 'Approved'),
('71', '19', 'Approved'),
('73', '20', 'Approved'),
('73', '21', 'Approved'),
('73', '22', 'Approved'),
('73', '23', 'Approved'),
('73', '24', 'Approved'),
('72', '25', 'Approved'),
('72', '26', 'Approved'),
('72', '27', 'Approved'),
('72', '28', 'Approved'),
('71', '29', 'Approved'),
('71', '30', 'Approved'),
('71', '31', 'Approved'),
('73', '32', 'Approved'),
('73', '33', 'Approved'),
('73', '34', 'Approved'),
('74', '35', 'Approved'),
('74', '36', 'Approved'),
('74', '37', 'Approved'),
('74', '38', 'Approved'),
('73', '39', 'Approved'),
('73', '40', 'Approved'),
('73', '41', 'Approved'),
('72', '42', 'Approved'),
('73', '43', 'Rejected'),
('73', '44', 'Approved'),
('75', '45', 'Approved'),
('75', '46', 'Approved'),
('55', '1', 'Pending'),
('55', '2', 'Pending'),
('55', '3', 'Approved'),
('56', '4', 'Approved'),
('56', '5', 'Approved'),
('56', '6', 'Approved'),
('56', '7', 'Rejected'),
('56', '8', 'Approved'),
('56', '9', 'Approved'),
('66', '10', 'Approved'),
('67', '11', 'Approved'),
('67', '12', 'Approved'),
('66', '13', 'Pending'),
('67', '14', 'Approved'),
('71', '15', 'Approved'),
('72', '16', 'Approved'),
('72', '17', 'Approved'),
('72', '18', 'Approved'),
('71', '19', 'Approved'),
('73', '20', 'Approved'),
('73', '21', 'Approved'),
('73', '22', 'Approved'),
('73', '23', 'Approved'),
('73', '24', 'Approved'),
('72', '25', 'Approved'),
('72', '26', 'Approved'),
('72', '27', 'Approved'),
('72', '28', 'Approved'),
('71', '29', 'Approved'),
('71', '30', 'Approved'),
('71', '31', 'Approved'),
('73', '32', 'Approved'),
('73', '33', 'Approved'),
('73', '34', 'Approved'),
('74', '35', 'Approved'),
('74', '36', 'Approved'),
('74', '37', 'Approved'),
('74', '38', 'Approved'),
('73', '39', 'Approved'),
('73', '40', 'Approved'),
('73', '41', 'Approved'),
('72', '42', 'Approved'),
('73', '43', 'Rejected'),
('73', '44', 'Approved'),
('75', '45', 'Approved'),
('75', '46', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `eventpayment`
--

CREATE TABLE `eventpayment` (
  `ePaymentID` int(50) NOT NULL,
  `ePaymentProof` varchar(50) NOT NULL,
  `ePaymentDate` date NOT NULL,
  `ePaymentTime` time NOT NULL,
  `volunteerID` varchar(50) NOT NULL,
  `eventID` varchar(50) NOT NULL,
  `attendanceID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventpayment`
--

INSERT INTO `eventpayment` (`ePaymentID`, `ePaymentProof`, `ePaymentDate`, `ePaymentTime`, `volunteerID`, `eventID`, `attendanceID`) VALUES
(33, 'uploads/resumeDini1.pdf', '2024-07-15', '19:50:46', '73', 'E001', '7'),
(34, 'uploads/resumeDini1.pdf', '2024-07-15', '19:55:00', '73', 'E003', '7'),
(35, 'uploads/resumeDini1.pdf', '2024-07-15', '20:02:44', '74', 'E001', '10'),
(36, 'uploads/resumeDini1.pdf', '2024-07-15', '20:04:22', '74', 'E003', '10'),
(42, 'uploads/resumeDini1.pdf', '2024-07-15', '20:40:52', '72', 'E003', ''),
(44, 'uploads/resumeDini1.pdf', '2024-07-15', '22:29:02', '73', 'E004', '7'),
(45, 'uploads/adminYosh.jpg', '2024-07-16', '03:51:13', '75', 'E001', '12'),
(46, 'uploads/adminYosh.jpg', '2024-07-16', '05:16:54', '75', 'E003', '12');

-- --------------------------------------------------------

--
-- Table structure for table `eventpaymentstatus`
--

CREATE TABLE `eventpaymentstatus` (
  `staffID` int(11) DEFAULT NULL,
  `ePaymentID` varchar(50) NOT NULL,
  `approvalStatus` varchar(20) NOT NULL,
  `ePaymentStatusDate` date NOT NULL,
  `ePaymentStatusTime` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventpaymentstatus`
--

INSERT INTO `eventpaymentstatus` (`staffID`, `ePaymentID`, `approvalStatus`, `ePaymentStatusDate`, `ePaymentStatusTime`) VALUES
(1, '2', 'Approved', '2024-07-12', '05:04:56.000000'),
(1, '3', 'Approved', '2024-07-12', '05:49:47.000000'),
(1, '4', 'Approved', '2024-07-12', '05:59:40.000000'),
(1, '5', 'Approved', '2024-07-12', '05:59:48.000000'),
(1, '6', 'Approved', '2024-07-12', '06:20:09.000000'),
(1, '7', 'Rejected', '2024-07-12', '06:20:13.000000'),
(1, '8', 'Approved', '2024-07-12', '08:37:11.000000'),
(2, '9', 'Approved', '2024-07-12', '11:16:15.000000'),
(1, '10', 'Approved', '2024-07-14', '07:35:06.000000'),
(1, '11', 'Approved', '2024-07-13', '16:21:22.000000'),
(1, '12', 'Approved', '2024-07-15', '14:54:16.000000'),
(NULL, '13', 'Pending', '2024-07-14', '07:36:42.000000'),
(1, '14', 'Approved', '2024-07-15', '11:05:20.000000'),
(1, '15', 'Approved', '2024-07-15', '14:54:13.000000'),
(1, '16', 'Approved', '2024-07-15', '14:58:28.000000'),
(1, '17', 'Approved', '2024-07-15', '15:01:07.000000'),
(1, '18', 'Approved', '2024-07-15', '15:12:14.000000'),
(1, '19', 'Approved', '2024-07-15', '15:26:41.000000'),
(1, '20', 'Approved', '2024-07-15', '16:09:47.000000'),
(1, '21', 'Approved', '2024-07-15', '16:10:04.000000'),
(1, '22', 'Approved', '2024-07-15', '16:20:24.000000'),
(1, '23', 'Approved', '2024-07-15', '17:24:55.000000'),
(1, '24', 'Approved', '2024-07-15', '17:25:59.000000'),
(1, '25', 'Approved', '2024-07-15', '18:43:33.000000'),
(1, '26', 'Approved', '2024-07-15', '18:56:35.000000'),
(1, '27', 'Approved', '2024-07-15', '18:56:32.000000'),
(1, '28', 'Approved', '2024-07-15', '18:56:30.000000'),
(1, '29', 'Approved', '2024-07-15', '19:22:29.000000'),
(1, '30', 'Approved', '2024-07-15', '19:26:35.000000'),
(1, '31', 'Approved', '2024-07-15', '19:33:58.000000'),
(1, '32', 'Approved', '2024-07-15', '19:44:48.000000'),
(1, '33', 'Approved', '2024-07-15', '19:51:00.000000'),
(1, '34', 'Approved', '2024-07-15', '19:55:27.000000'),
(1, '35', 'Approved', '2024-07-15', '20:03:02.000000'),
(1, '36', 'Approved', '2024-07-15', '20:04:37.000000'),
(1, '37', 'Approved', '2024-07-15', '20:10:01.000000'),
(1, '38', 'Approved', '2024-07-15', '20:14:53.000000'),
(2, '39', 'Approved', '2024-07-15', '20:29:46.000000'),
(2, '40', 'Approved', '2024-07-15', '20:31:59.000000'),
(1, '41', 'Approved', '2024-07-15', '20:35:14.000000'),
(1, '42', 'Approved', '2024-07-15', '20:41:10.000000'),
(2, '43', 'Rejected', '2024-07-15', '22:22:19.000000'),
(1, '44', 'Approved', '2024-07-15', '22:29:16.000000'),
(3, '45', 'Approved', '2024-07-16', '03:52:13.000000'),
(3, '46', 'Approved', '2024-07-16', '18:05:03.000000'),
(1, '2', 'Approved', '2024-07-12', '05:04:56.000000'),
(1, '3', 'Approved', '2024-07-12', '05:49:47.000000'),
(1, '4', 'Approved', '2024-07-12', '05:59:40.000000'),
(1, '5', 'Approved', '2024-07-12', '05:59:48.000000'),
(1, '6', 'Approved', '2024-07-12', '06:20:09.000000'),
(1, '7', 'Rejected', '2024-07-12', '06:20:13.000000'),
(1, '8', 'Approved', '2024-07-12', '08:37:11.000000'),
(2, '9', 'Approved', '2024-07-12', '11:16:15.000000'),
(1, '10', 'Approved', '2024-07-14', '07:35:06.000000'),
(1, '11', 'Approved', '2024-07-13', '16:21:22.000000'),
(1, '12', 'Approved', '2024-07-15', '14:54:16.000000'),
(NULL, '13', 'Pending', '2024-07-14', '07:36:42.000000'),
(1, '14', 'Approved', '2024-07-15', '11:05:20.000000'),
(1, '15', 'Approved', '2024-07-15', '14:54:13.000000'),
(1, '16', 'Approved', '2024-07-15', '14:58:28.000000'),
(1, '17', 'Approved', '2024-07-15', '15:01:07.000000'),
(1, '18', 'Approved', '2024-07-15', '15:12:14.000000'),
(1, '19', 'Approved', '2024-07-15', '15:26:41.000000'),
(1, '20', 'Approved', '2024-07-15', '16:09:47.000000'),
(1, '21', 'Approved', '2024-07-15', '16:10:04.000000'),
(1, '22', 'Approved', '2024-07-15', '16:20:24.000000'),
(1, '23', 'Approved', '2024-07-15', '17:24:55.000000'),
(1, '24', 'Approved', '2024-07-15', '17:25:59.000000'),
(1, '25', 'Approved', '2024-07-15', '18:43:33.000000'),
(1, '26', 'Approved', '2024-07-15', '18:56:35.000000'),
(1, '27', 'Approved', '2024-07-15', '18:56:32.000000'),
(1, '28', 'Approved', '2024-07-15', '18:56:30.000000'),
(1, '29', 'Approved', '2024-07-15', '19:22:29.000000'),
(1, '30', 'Approved', '2024-07-15', '19:26:35.000000'),
(1, '31', 'Approved', '2024-07-15', '19:33:58.000000'),
(1, '32', 'Approved', '2024-07-15', '19:44:48.000000'),
(1, '33', 'Approved', '2024-07-15', '19:51:00.000000'),
(1, '34', 'Approved', '2024-07-15', '19:55:27.000000'),
(1, '35', 'Approved', '2024-07-15', '20:03:02.000000'),
(1, '36', 'Approved', '2024-07-15', '20:04:37.000000'),
(1, '37', 'Approved', '2024-07-15', '20:10:01.000000'),
(1, '38', 'Approved', '2024-07-15', '20:14:53.000000'),
(2, '39', 'Approved', '2024-07-15', '20:29:46.000000'),
(2, '40', 'Approved', '2024-07-15', '20:31:59.000000'),
(1, '41', 'Approved', '2024-07-15', '20:35:14.000000'),
(1, '42', 'Approved', '2024-07-15', '20:41:10.000000'),
(2, '43', 'Rejected', '2024-07-15', '22:22:19.000000'),
(1, '44', 'Approved', '2024-07-15', '22:29:16.000000'),
(3, '45', 'Approved', '2024-07-16', '03:52:13.000000'),
(3, '46', 'Approved', '2024-07-16', '18:05:03.000000');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqID` int(50) NOT NULL,
  `faqQuestion` varchar(1000) NOT NULL,
  `faqAnswer` varchar(1000) NOT NULL,
  `faqDate` date NOT NULL,
  `faqTime` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `volunteerID` varchar(50) NOT NULL,
  `mentorName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` varchar(50) NOT NULL,
  `reportTime` time(6) NOT NULL,
  `reportDate` date NOT NULL,
  `attendanceID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `volunteerID` varchar(50) NOT NULL,
  `drivingLicense` varchar(20) NOT NULL,
  `skills` varchar(1000) NOT NULL,
  `interests` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`volunteerID`, `drivingLicense`, `skills`, `interests`) VALUES
('55', '', '', ''),
('56', '', '', ''),
('65', '', '', ''),
('66', '', '', ''),
('67', '', '', ''),
('68', '', '', ''),
('69', '', '', ''),
('70', '', '', ''),
('71', '', '', ''),
('72', '', '', ''),
('73', '', '', ''),
('74', '', '', ''),
('75', 'D', 'A', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(50) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `staffPhone` varchar(12) NOT NULL,
  `staffPassword` varchar(50) NOT NULL,
  `staffStatus` varchar(20) NOT NULL,
  `staffDate` date NOT NULL,
  `staffTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `staffPhone`, `staffPassword`, `staffStatus`, `staffDate`, `staffTime`) VALUES
(1, 'Dini', '0123744272', 'doli', 'Admin', '0000-00-00', '00:00:00'),
(2, 'doli', '0123444', '123', 'Admin', '0000-00-00', '00:00:00'),
(3, 'nisa', '01113009726', 'nisa', 'Admin', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionfee`
--

CREATE TABLE `subscriptionfee` (
  `subID` int(50) NOT NULL,
  `subProof` varchar(100) NOT NULL,
  `subDate` date NOT NULL,
  `subTime` time NOT NULL,
  `volunteerID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptionfee`
--

INSERT INTO `subscriptionfee` (`subID`, `subProof`, `subDate`, `subTime`, `volunteerID`) VALUES
(1, 'uploads/yoshLogo.png', '2024-07-12', '05:02:40', '55'),
(2, 'uploads/yoshLogo.png', '2024-07-12', '05:06:41', '56'),
(4, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-12', '07:26:05', '58'),
(5, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-12', '07:40:32', '59'),
(6, 'uploads/yoshLogo.png', '2024-07-12', '07:45:06', '60'),
(9, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-12', '08:08:33', '63'),
(10, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-12', '08:11:05', '64'),
(11, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-12', '08:18:03', '65'),
(12, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-13', '13:31:50', '66'),
(13, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-13', '16:14:18', '67'),
(14, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-15', '12:52:27', '68'),
(15, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-15', '12:55:04', '69'),
(16, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-15', '13:13:00', '70'),
(17, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-15', '14:51:47', '71'),
(18, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-15', '14:56:13', '72'),
(19, 'uploads/YuranKolej_bilelektriksem3.pdf', '2024-07-15', '16:07:23', '73'),
(20, 'uploads/resumeDini1.pdf', '2024-07-15', '19:57:47', '74'),
(21, 'uploads/adminYosh.jpg', '2024-07-16', '03:47:47', '75');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionstatus`
--

CREATE TABLE `subscriptionstatus` (
  `StaffID` varchar(50) DEFAULT NULL,
  `subID` varchar(50) NOT NULL,
  `approvalSubscribeStatus` varchar(50) NOT NULL,
  `subStatusDate` date NOT NULL,
  `subStatusTime` time(6) NOT NULL,
  `yoshID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptionstatus`
--

INSERT INTO `subscriptionstatus` (`StaffID`, `subID`, `approvalSubscribeStatus`, `subStatusDate`, `subStatusTime`, `yoshID`) VALUES
('1', '16', 'Approved', '2024-07-15', '13:13:36.000000', ''),
('1', '1', 'Approved', '2024-07-12', '05:05:44.000000', ''),
('1', '2', 'Approved', '2024-07-12', '05:51:51.000000', ''),
('1', '4', 'Approved', '2024-07-12', '07:27:28.000000', ''),
('1', '6', 'Approved', '2024-07-12', '07:45:33.000000', ''),
(NULL, '63', 'Pending', '2024-07-12', '08:08:33.000000', ''),
(NULL, '64', 'Pending', '2024-07-12', '08:11:05.000000', ''),
('1', '11', 'Approved', '2024-07-12', '08:19:54.000000', ''),
('1', '12', 'Approved', '2024-07-13', '13:32:30.000000', ''),
('1', '13', 'Approved', '2024-07-13', '16:16:39.000000', ''),
('1', '14', 'Approved', '2024-07-15', '12:53:23.000000', ''),
('1', '15', 'Approved', '2024-07-15', '12:55:24.000000', ''),
('1', '17', 'Approved', '2024-07-15', '14:52:11.000000', 'YM0001'),
('1', '18', 'Approved', '2024-07-15', '14:56:52.000000', 'YM0002'),
('1', '19', 'Approved', '2024-07-15', '16:07:44.000000', 'YM0003'),
('1', '20', 'Approved', '2024-07-15', '19:58:11.000000', 'YM0004'),
('3', '21', 'Approved', '2024-07-16', '03:48:14.000000', 'YM0005'),
('1', '16', 'Approved', '2024-07-15', '13:13:36.000000', ''),
('1', '1', 'Approved', '2024-07-12', '05:05:44.000000', ''),
('1', '2', 'Approved', '2024-07-12', '05:51:51.000000', ''),
('1', '4', 'Approved', '2024-07-12', '07:27:28.000000', ''),
('1', '6', 'Approved', '2024-07-12', '07:45:33.000000', ''),
(NULL, '63', 'Pending', '2024-07-12', '08:08:33.000000', ''),
(NULL, '64', 'Pending', '2024-07-12', '08:11:05.000000', ''),
('1', '11', 'Approved', '2024-07-12', '08:19:54.000000', ''),
('1', '12', 'Approved', '2024-07-13', '13:32:30.000000', ''),
('1', '13', 'Approved', '2024-07-13', '16:16:39.000000', ''),
('1', '14', 'Approved', '2024-07-15', '12:53:23.000000', ''),
('1', '15', 'Approved', '2024-07-15', '12:55:24.000000', ''),
('1', '17', 'Approved', '2024-07-15', '14:52:11.000000', 'YM0001'),
('1', '18', 'Approved', '2024-07-15', '14:56:52.000000', 'YM0002'),
('1', '19', 'Approved', '2024-07-15', '16:07:44.000000', 'YM0003'),
('1', '20', 'Approved', '2024-07-15', '19:58:11.000000', 'YM0004'),
('3', '21', 'Approved', '2024-07-16', '03:48:14.000000', 'YM0005');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `volunteerID` int(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `yearBorn` date NOT NULL,
  `ICNumber` varchar(12) NOT NULL,
  `volunteerPhone` varchar(12) NOT NULL,
  `volunteerEmail` varchar(50) NOT NULL,
  `volunteerDate` date NOT NULL,
  `volunteerTime` time NOT NULL,
  `subscriptionStatus` varchar(50) NOT NULL,
  `yoshID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`volunteerID`, `password`, `name`, `gender`, `yearBorn`, `ICNumber`, `volunteerPhone`, `volunteerEmail`, `volunteerDate`, `volunteerTime`, `subscriptionStatus`, `yoshID`) VALUES
(71, 'c4ca4238a0b923820dcc509a6f75849b', 'dini', '', '0000-00-00', '20167', '20201', 'dd@gmail.com', '0000-00-00', '00:00:00', '', 'YM0001'),
(72, 'c4ca4238a0b923820dcc509a6f75849b', 'ahma', '', '0000-00-00', '02030403', '0203404', 'ah@gmai.com', '0000-00-00', '00:00:00', '', 'YM0002'),
(73, 'c4ca4238a0b923820dcc509a6f75849b', 'q', '', '0000-00-00', '12345', '11222334', 'q@gmail.com', '0000-00-00', '00:00:00', '', 'YM0003'),
(74, 'c4ca4238a0b923820dcc509a6f75849b', 'aa', '', '0000-00-00', '', '', 'w@gmail.com', '0000-00-00', '00:00:00', '', 'YM0004'),
(75, '202cb962ac59075b964b07152d234b70', 'NUR NISA FARHANA BINTI MOHAMAD FADIL', 'FEMALE', '2024-07-25', '031007140666', '011113009726', 'nnfarhanamf@gmail.com', '0000-00-00', '00:00:00', '', 'YM0005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`volunteerID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`);

--
-- Indexes for table `commitment`
--
ALTER TABLE `commitment`
  ADD PRIMARY KEY (`volunteerID`);

--
-- Indexes for table `educationoccupation`
--
ALTER TABLE `educationoccupation`
  ADD PRIMARY KEY (`volunteerID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `eventpayment`
--
ALTER TABLE `eventpayment`
  ADD PRIMARY KEY (`ePaymentID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`volunteerID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `subscriptionfee`
--
ALTER TABLE `subscriptionfee`
  ADD PRIMARY KEY (`subID`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`volunteerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eventpayment`
--
ALTER TABLE `eventpayment`
  MODIFY `ePaymentID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptionfee`
--
ALTER TABLE `subscriptionfee`
  MODIFY `subID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `volunteerID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
