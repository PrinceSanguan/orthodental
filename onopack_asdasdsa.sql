-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 08:40 PM
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
-- Database: `onopack_asdasdsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL DEFAULT 'Staff',
  `fname` varchar(200) NOT NULL,
  `mname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `position`, `fname`, `mname`, `lname`) VALUES
(11, 'ADMIN', 'admin@gmail.com', '$2y$10$dwwcPvpailvQga3/IZj/CuRsr8WFSyoGAclXxpzxfeZg28cbEmfDq', 'Super Admin', 'Victor', 'Natassa', 'Herrera'),
(35, 'rein123', 'rein@gmail.com', '$2y$10$7XZRcOaQtKYmdqNjKDGFL.al2UNbTIfjYF4RXmqOJkP9110el0V0O', 'Staff', 'Rein', 'Pana', 'Luna'),
(36, 'Paulo123', 'paulo@gmail.com', '$2y$10$AwVPYvyq4AvKZDVb9NOtZOPfIfBAeqONqRI26a6kddY//WJTAG3F2', 'Staff', 'Paulo', 'Miguel', 'Guiraldo'),
(37, 'Test123', 'Test@gmail.com', '$2y$10$IWV.h2u6ZvT8wJJXCIpgHuYh6ED8pLVCKL94R180mWRJLTKjsLwf2', 'Staff', 'Test', 'Middle', 'LastName'),
(38, 'Testagain123', 'test@gmail.com.ph', '$2y$10$U6h7m/6WoO1bnUASGu99FO/LsgCRHWEFm/6Md5i/mkKsbAhrNhYA2', 'Staff', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_user` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `appointment_service` varchar(200) NOT NULL,
  `appointment_status` varchar(200) NOT NULL,
  `why` varchar(200) NOT NULL,
  `course` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_desc`
--

CREATE TABLE `appointment_desc` (
  `appointment_desc_id` int(11) NOT NULL,
  `appointment_id` varchar(200) NOT NULL,
  `appointment_desc` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `why` varchar(200) NOT NULL,
  `appointment_update_by` varchar(200) NOT NULL,
  `appointment_status` varchar(200) NOT NULL,
  `feeling_well` varchar(200) NULL,
  `fever_cough` varchar(200) NULL,
  `nausea` varchar(200) NULL,
  `tooth_gum_pain` varchar(200) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment_desc`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `chat_user` varchar(200) NOT NULL,
  `chat_reps_u_id` varchar(200) NOT NULL,
  `chat_user_id` varchar(200) NOT NULL,
  `chat_message` longtext NOT NULL,
  `chat_time` varchar(200) NOT NULL,
  `chat_to` varchar(200) NOT NULL,
  `view` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dental_history`
--

CREATE TABLE `dental_history` (
  `dental_history_id` int(20) NOT NULL,
  `dental_user` varchar(200) NOT NULL,
  `dental_file` varchar(200) NOT NULL,
  `dental_brace` varchar(200) DEFAULT NULL,
  `dental_comment` varchar(200) DEFAULT NULL,
  `dental_status` varchar(200) NOT NULL,
  `dental_date` varchar(200) NOT NULL,
  `appointment_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dental_history`
--

INSERT INTO `dental_history` (`dental_history_id`, `dental_user`, `dental_file`, `dental_brace`, `dental_comment`, `dental_status`, `dental_date`, `appointment_desc`) VALUES
(1, '75', '2', 'braces and teeth services', 'sdsdsd', 'ssdddsd', 'September 22,2024 - 10:54:26 PM', ''),
(2, '75', '1', 'teeth services', 'dfdffdfdfd', 'fdfdfd', 'September 22,2024 - 10:54:41 PM', ''),
(3, '11', '1', 'teeth services', 'gffggf', 'gfgfgf', 'September 22,2024 - 11:04:29 PM', ''),
(4, '11', '', 'brace adjument only', 'fggffg', 'fgfg', 'September 22,2024 - 11:04:41 PM', ''),
(5, '11', '7', 'braces and teeth services', 'hgghgh', 'dfd', 'September 22,2024 - 11:05:04 PM', ''),
(6, '75', '', 'brace adjument only', 'jshsjd', 'sdsds', 'September 30,2024 - 12:28:49 AM', ''),
(7, '75', '1', 'braces and teeth services', 'sd', 'ss', 'September 30,2024 - 12:29:37 AM', ''),
(8, '75', '', 'brace adjument only', 'jj', 'kh', 'September 30,2024 - 12:33:56 AM', ''),
(9, '75', '1', 'braces and teeth services', 'ml', 'lml', 'September 30,2024 - 12:34:14 AM', ''),
(10, '82', '', 'brace adjument only', 'Good', 'Completed', 'September 30,2024 - 01:11:56 AM', ''),
(11, '82', '3', 'braces and teeth services', 'asd', 'Completed', 'September 30,2024 - 01:12:09 AM', ''),
(12, '75', '1', 'teeth services', 'asdasdas', 'success', 'September 30,2024 - 01:26:02 AM', '72'),
(13, '75', 'Array', 'teeth services', 'asdasd', 'ongoing', 'September 30,2024 - 01:32:36 AM', '72'),
(14, '75', 'Array', 'teeth services', 'asda', 'success', 'September 30,2024 - 01:32:46 AM', ''),
(15, '75', '', 'brace adjument only', 'nice\r\n', 'ongoing', 'September 30,2024 - 01:33:04 AM', ''),
(16, '75', 'Array', 'teeth services', 'asd', 'success', 'September 30,2024 - 01:33:11 AM', ''),
(17, '75', '2', 'teeth services', 'asd', 'success', 'September 30,2024 - 01:37:56 AM', ''),
(18, '75', 'Array', 'teeth services', 'multiple', 'success', 'September 30,2024 - 01:39:45 AM', ''),
(19, '75', '3', 'teeth services', 'asd', 'success', 'September 30,2024 - 01:42:28 AM', ''),
(20, '82', '1', 'teeth services', 'Nice', 'ongoing', 'September 30,2024 - 01:50:53 AM', '107'),
(21, '87', '1', 'teeth services', 'remove\r\n', 'success', 'September 30,2024 - 01:56:17 AM', ''),
(22, '87', '2', 'teeth services', 'remove', 'success', 'September 30,2024 - 01:56:24 AM', ''),
(23, '87', '', 'brace adjument only', 'adjusted', 'success', 'September 30,2024 - 01:56:37 AM', '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `inventory_name` varchar(200) NOT NULL,
  `inventory_qty` varchar(200) NOT NULL,
  `inventory_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `inventory_name`, `inventory_qty`, `inventory_status`) VALUES
(7, 'Band Aid', '184', '1'),
(8, 'Candy', '84', '1');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `med_id` int(20) NOT NULL,
  `med_date` varchar(200) NOT NULL,
  `med_prev_dent` varchar(200) NOT NULL,
  `med_last_vi` varchar(200) NOT NULL,
  `one` varchar(200) NOT NULL,
  `two` varchar(200) NOT NULL,
  `two_answer` varchar(200) NOT NULL,
  `three` varchar(200) NOT NULL,
  `three_answer` varchar(200) NOT NULL,
  `four` varchar(200) NOT NULL,
  `four_answer` varchar(200) NOT NULL,
  `five` varchar(200) NOT NULL,
  `five_answer` varchar(200) NOT NULL,
  `six` varchar(200) NOT NULL,
  `seven` varchar(200) NOT NULL,
  `allergies_str` longtext NOT NULL,
  `pregnant` varchar(200) NOT NULL,
  `nursing` varchar(200) NOT NULL,
  `pills` varchar(200) NOT NULL,
  `blood_type` varchar(200) NOT NULL,
  `conditions_str` longtext NOT NULL,
  `u_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`med_id`, `med_date`, `med_prev_dent`, `med_last_vi`, `one`, `two`, `two_answer`, `three`, `three_answer`, `four`, `four_answer`, `five`, `five_answer`, `six`, `seven`, `allergies_str`, `pregnant`, `nursing`, `pills`, `blood_type`, `conditions_str`, `u_id`) VALUES
(2, 'August 02,2024 20:38: PM', 'PREVIOUS DENTIST DOCTOR:', 'LAST DENTAL VISIT:', 'Yes', 'Yes', 'yes', 'Yes', 'yes', 'Yes', 'yes', 'Yes', 'yes', 'Yes', 'Yes', 'Local Anesthetic, Penicilin, Antibiotics, Aspinn, Latex, Sulfa drugs, Others: yes', 'Yes', 'Yes', 'Yes', 'yes', 'High Blood Pressure, Hepatitis/Jaundice, Low Blood Pressure, Tuberculosis, Epilepsy/Convulsions, Swolen ankles/Kidney disease, AIDS or HIV Infection, Asthma, Sexually Transmitted disease, Emphysema, S', '38'),
(13, 'August 27,2024 12:31: PM', 'dr james ', 'dr james clinic', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Others: n/a', 'No', 'No', 'No', '', 'Others: ', '73'),
(14, 'August 27,2024 12:36: PM', 'Dr. James', 'January 2023', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Others: none', 'No', 'No', 'No', 'unknown', 'Others: none', '72'),
(15, 'August 28,2024 10:27: AM', '1231', '31321313', 'Yes', 'Yes', '12312', 'Yes', '312312312', 'Yes', '123123213', 'Yes', '12312312312312', 'Yes', 'Yes', 'Local Anesthetic', 'Yes', 'Yes', 'Yes', 'asdasdasd', 'High Blood Pressure', '75'),
(16, 'August 28,2024 15:03: PM', 'Dr. Herrera', 'August 1, 2024', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Others: none', 'No', 'No', 'No', 'unknown', 'Others: none', '72'),
(17, 'September 07,2024 13:20: PM', 'my dentist', 'dr james clinic', 'Yes', 'Yes', 'n/a', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Aspinn', 'No', 'No', 'No', '0+', 'Epilepsy/Convulsions, Others: n/a', '73'),
(18, 'September 08,2024 17:42: PM', 'Dr. James', 'January 27, 2024', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Others: none', 'No', 'No', 'No', 'o', 'Others: none', '77'),
(19, 'September 09,2024 19:30: PM', 'asa', 'sdds', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', '', 'No', 'No', 'No', 'o+', '', '78'),
(20, 'September 10,2024 18:22: PM', 'rein', 'rein dental clinic ', 'No', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Local Anesthetic, Penicilin, Antibiotics, Aspinn, Latex, Sulfa drugs', 'No', 'No', 'No', 'asd', 'Hepatitis/Jaundice', '78'),
(21, 'September 11,2024 05:04: AM', 'Rein Luna', 'Rein Dental Clinic', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', '', 'No', 'No', 'No', '', '', '81'),
(22, 'September 16,2024 21:57: PM', 'as', 'dasd', 'No', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Aspinn', 'No', 'No', 'No', '', 'Heart Surgery', '80'),
(23, 'September 26,2024 04:29: AM', 'as', 'dasd', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Latex', 'No', 'No', 'No', 'asd', 'High Blood Pressure', ''),
(26, '2024-09-29', 'CJ Dental Services', 'Hello Dentist', 'Yes', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', 'Yes', '', 'Yes', 'Yes', 'Yes', 'O+', 'Blood Diseases, Respiratory Problems, Cancer/Tumors', '82'),
(28, '2024-09-12', 'Jisu Dental Cares Legit', 'ngayon bukas oki', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', '', 'No', 'No', 'No', 'AB-', 'High Blood Pressure, Low Blood Pressure, Epilepsy/Convulsions, Rapid Weight Loss, Heart Surgery, Anemia', '82'),
(29, '2024-09-02', 'Dr. James Bond pinasuasdads', 'James Bond Dental Services coprasdasd', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Penicilin, Antibiotics, Aspinn, Sulfa drugs', 'No', 'No', 'No', '', 'Tuberculosis, Swolen ankles/Kidney disease, Asthma', '82'),
(30, 'October 02,2024 01:50: AM', 'Rein Ganda', 'Yasmin Dental Service', 'Yes', 'No', '', 'No', '', 'No', '', 'No', '', 'No', 'No', 'Sulfa drugs', 'No', 'No', 'No', 'Unknown', '', '87');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `recipient_id` varchar(200) NOT NULL,
  `text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `recipient_id`, `text`, `timestamp`) VALUES
(1, 'user', '', '32131231', '2024-08-10 04:51:47'),
(2, 'admin', '', '1232131', '2024-08-10 04:51:51'),
(3, 'user', '', '312312312', '2024-08-10 04:52:17'),
(4, 'asdasda', '', '12313131', '2024-08-10 05:54:07'),
(5, 'asdasda', '', 'asdasd', '2024-08-10 05:54:32'),
(6, '32', '', 'asd', '2024-08-10 05:56:10'),
(7, 'admin', '', 'asdasda', '2024-08-10 05:56:36'),
(8, '11', '', 'asdasd', '2024-08-10 06:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `process_desc`
--

CREATE TABLE `process_desc` (
  `process_desc_id` int(11) NOT NULL,
  `process_list_id` int(11) NOT NULL,
  `process_desc_inventory` varchar(200) NOT NULL,
  `process_desc_psc` varchar(200) NOT NULL,
  `process_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `process_desc`
--

INSERT INTO `process_desc` (`process_desc_id`, `process_list_id`, `process_desc_inventory`, `process_desc_psc`, `process_status`) VALUES
(7, 3, '7', '2', '0'),
(8, 3, '8', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `process_list`
--

CREATE TABLE `process_list` (
  `process_list_id` int(11) NOT NULL,
  `process_list_tags` varchar(200) NOT NULL,
  `process_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `process_list`
--

INSERT INTO `process_list` (`process_list_id`, `process_list_tags`, `process_status`) VALUES
(3, 'First Aid Process', '1'),
(4, 'Physical Test', '1'),
(5, 'Medical Test', '1');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `services_name` varchar(200) NOT NULL,
  `services_cost` varchar(200) NOT NULL,
  `services_tools_id` varchar(200) NOT NULL,
  `services_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `services_name`, `services_cost`, `services_tools_id`, `services_status`) VALUES
(16, 'Tooth extraction', '1500', '', '0'),
(17, 'Tooth Braces', '5000', '', '0'),
(18, 'Pasta ', '1500', '', '0'),
(19, 'Cleaning', '500', '', '0'),
(20, 'Adding Tooth ', '1000', '', '1'),
(21, 'Teeth Whitening', '900', '', '1'),
(22, 'Teeth Adjustment ', '1000', '', '0'),
(23, 'Teeth Whitening', '900', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tooths`
--

CREATE TABLE `tooths` (
  `id` int(11) NOT NULL,
  `appointment_id` varchar(255) DEFAULT NULL,
  `patient_id` varchar(255) DEFAULT NULL,
  `teeth` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_account1`
--

CREATE TABLE `user_account1` (
  `u_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `bdate` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `verification_code` int(6) NOT NULL,
  `suffix` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account1`
--

INSERT INTO `user_account1` (`u_id`, `username`, `email`, `password`, `fname`, `mname`, `lname`, `position`, `contact`, `bdate`, `gender`, `address`, `verification_code`, `suffix`) VALUES
(69, 'joshuaenore74', 'joshuaenore74@gmail.com', '$2y$10$pGYx5YbvmrHtAyigm1Y5yeYQWE4RGcgdhsh1WAvWi9lfItCfd0O8.', 'joshua ellis', 'dizon', 'enore', '', '09204353341', '2024-08-21', 'Male', 'Binan', 0, ''),
(70, '2000', 'famousbbb232@gamil.com', '$2y$10$XfWMv.g0xTwCBpJQBasRbOeOU2mB4CWunJV7uJFTYjTsFOwUqNM8e', '00', '', '0731', '082724394412', '09123456789', '2004-06-28', 'Female', 'BULIHAN,SILANG ,CAVITE', 0, ''),
(71, 'Chichi', 'chiela123456789@gmail.com', '$2y$10$NkC6r3ZJwi6t9RBzU8ADt.gj00IzPQsRxcEl7QCbvpW1xsLbvndBm', 'Chiela Faye', 'Yupa', 'Bustillo', '082724522911', '09100083337', '2003-01-06', 'Female', 'Blk 8A Lot 50 Brgy. N. Virata G.M.A. Cavite', 0, ''),
(72, 'Mariz', 'marizrabanal16@gmail.com', '$2y$10$IUPS/IzoYa41W8Af/GUnw.HxNgigNrYWVZRuoXNTnXyFJQth8b6le', 'Mara Charisse', 'Manarog', 'Rabanal', '', '9273228948', '2001-12-19', 'Female', 'Bancal', 0, ''),
(73, 'Paulo', 'otakuzetsuo@gmail.com', '$2y$10$o9erMbyhEVUrB4jb9Tpa8.A5IfURaJgfhkxLCI.nFcCr88i3jIaIy', 'miguel', 'guiraldo', 'paulo', '', '09277640556', '2001-11-07', 'Male', 'blk 12 lot 15 carmona townhomes carmona cavite', 0, ''),
(75, 'joshuaenore24', 'joshuaenore24@gmail.com', '$2y$10$gajtMV.1wqwAdNgUJ0q4P.8S.Ns7CRmniwG7u1qOjN65JrV3K738a', 'Juan', ' ', 'Delacruz', '', '09204353341', '1997-08-27', 'Male', 'test address', 0, ''),
(77, 'peypey', 'rabanalmariz1925@gmail.com', '$2y$10$ahz28xDljfwx/nIjDgInO.SCa9ERzkNLDnSxK9riWo/GPZoHGoX5W', 'Faye', '', 'Bustillo', '', '09123456789', '2003-01-06', 'Female', 'Earth', 0, ''),
(78, 'cardodalisay1', 'defif88225@esterace.com', '$2y$10$uXnubsqEuZXitGFYv7WsQuLqe5KpqIdIjcf3wdgH9DZgpXeqx9LkS', 'cardo', 'g', 'dalisay', '090924054212', '09954182831', '2000-10-01', 'Male', 'gma', 0, ''),
(79, 'Jao', 'pjbaguio0@gmail.com', '$2y$10$8jXD8JjUei4jmzYcW6PTNOknfXBDFSlivIsd/5UGTqPprj0xP/rDq', 'João', 'a', 'Souza Silva', '090924004605', '09999999999', '2022-10-04', 'Male', 'Rua Inexistente, 2000', 0, ''),
(81, 'junieee', 'junie@gmail.com', '$2y$10$am/GKEQvRI6d7xigrmoZ8OyGH.4gwi8U0Qd0TcLsPYiASuxr6rti.', 'Boy', 'C', 'Junie', '091124020305', '1231231231', '2001-12-12', 'Male', 'asd', 0, ''),
(82, 'asd', 'xipacow999@abatido.com', 'ASDasdasd1', 'World', 'Yeah', 'Hello', '', '1231231231231', '1990-11-23', 'Male', 'asdasd', 437000, ''),
(83, 'zxc', 'xipacow999@abatido.com', 'ASDasdasd1', 'Ako', 'Si', 'Natoy', '', '1231231231231', '2000-12-31', 'Male', 'zxc', 695072, ''),
(87, 'Skaibloo', 'pjbaguio0@gmail.com', 'ASDasdasd1', 'Pj', 'Middle', 'Baguio', '', '1231231', '2017-09-27', 'Male', 'qq', 438351, 'PhD'),
(91, 'Jame1', 'loter27382@skrak.com', 'ASDasdasd1', 'Jamessd', 'Leoas', 'Manyysds', '', '9954617859', '2017-09-06', 'Male', 'GMA Cavite', 294789, 'PhD'),
(92, 'asdqwe', 'xemito5266@jameagle.com', 'ASDasdasd1', 'jhasd', 'oaksdasd', 'jasd', '', '1239102312', '2001-10-04', 'Male', 'asdads', 808781, 'pk'),
(95, 'user123', 'fixerob219@anypng.com', 'ASDasdasd1', 'asdasd', 'dasda', 'asdas', '', '12312312312', '2001-10-04', 'Male', 'asdasd', 362515, 'asdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointment_desc`
--
ALTER TABLE `appointment_desc`
  ADD PRIMARY KEY (`appointment_desc_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `dental_history`
--
ALTER TABLE `dental_history`
  ADD PRIMARY KEY (`dental_history_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_desc`
--
ALTER TABLE `process_desc`
  ADD PRIMARY KEY (`process_desc_id`);

--
-- Indexes for table `process_list`
--
ALTER TABLE `process_list`
  ADD PRIMARY KEY (`process_list_id`),
  ADD UNIQUE KEY `process_list_id` (`process_list_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `tooths`
--
ALTER TABLE `tooths`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_account1`
--
ALTER TABLE `user_account1`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `appointment_desc`
--
ALTER TABLE `appointment_desc`
  MODIFY `appointment_desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `dental_history`
--
ALTER TABLE `dental_history`
  MODIFY `dental_history_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `med_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `process_desc`
--
ALTER TABLE `process_desc`
  MODIFY `process_desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `process_list`
--
ALTER TABLE `process_list`
  MODIFY `process_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tooths`
--
ALTER TABLE `tooths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_account1`
--
ALTER TABLE `user_account1`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

