-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 12:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`id`, `order_id`, `file_name`, `file_path`, `updated_on`) VALUES
(6, 11, '', 'https://assignnmentinneed.com/terms/uploads/UKS17705.docx', '2021-11-26 08:32:44'),
(7, 11, '', 'https://assignnmentinneed.com/terms/uploads/UKS17705___Important.pdf', '2021-11-26 08:32:44'),
(8, 150, '', 'https://assignnmentinneed.com/terms/uploads/UKS17844.docx', '2021-11-27 02:15:30'),
(9, 150, '', 'https://assignnmentinneed.com/terms/uploads/UKS17844_plag_report.pdf', '2021-11-27 02:15:30'),
(10, 216, '', 'https://assignnmentinneed.com/terms/uploads/UKS17910.docx', '2021-11-27 04:42:11'),
(11, 216, '', 'https://assignnmentinneed.com/terms/uploads/UKS17910.pdf', '2021-11-27 04:42:21'),
(12, 132, '', 'https://assignnmentinneed.com/terms/uploads/Fwd_UKS17826_(2).docx', '2021-11-27 08:08:18'),
(13, 132, '', 'https://assignnmentinneed.com/terms/uploads/UKS17826.pdf', '2021-11-27 08:08:18'),
(14, 221, '', 'https://assignnmentinneed.com/terms/uploads/UKS17915_(1).docx', '2021-11-28 00:51:44'),
(15, 221, '', 'https://assignnmentinneed.com/terms/uploads/Fwd__UKS17915_PLAG.pdf', '2021-11-28 00:51:44'),
(16, 197, '', 'https://assignnmentinneed.com/terms/uploads/UKS17891_task1.docx', '2021-11-30 04:17:39'),
(17, 197, '', 'https://assignnmentinneed.com/terms/uploads/UKS17891_plag.pdf', '2021-11-30 04:17:39'),
(18, 227, '', 'https://assignnmentinneed.com/terms/uploads/UKS17920.docx', '2021-11-30 06:14:55'),
(19, 176, '', 'https://assignnmentinneed.com/terms/uploads/UKS17870.docx', '2021-11-30 09:01:32'),
(20, 176, '', 'https://assignnmentinneed.com/terms/uploads/Turnitin_Report.pdf', '2021-11-30 09:01:32'),
(21, 136, '', 'https://assignnmentinneed.com/terms/uploads/UKS17830.docx', '2021-11-30 20:34:49'),
(22, 136, '', 'https://assignnmentinneed.com/terms/uploads/UKS17830.pptx', '2021-11-30 20:34:49'),
(23, 136, '', 'https://assignnmentinneed.com/terms/uploads/UKS17830_TurnitinReport.pdf', '2021-11-30 20:34:49'),
(24, 263, '', 'https://assignnmentinneed.com/terms/uploads/UKS17956.docx', '2021-12-01 04:33:26'),
(25, 263, '', 'https://assignnmentinneed.com/terms/uploads/UKS17956-6%.pdf', '2021-12-01 04:33:26'),
(26, 60, '', 'https://assignnmentinneed.com/terms/uploads/UKS17754_part_2.pptx', '2021-12-02 03:10:50'),
(27, 60, '', 'https://assignnmentinneed.com/terms/uploads/UKS17754_part_2.pdf', '2021-12-02 03:10:50'),
(28, 60, '', 'https://assignnmentinneed.com/terms/uploads/UKS17754_Turnitin_Report1.pdf', '2021-12-02 03:10:50'),
(29, 60, '', 'https://assignnmentinneed.com/terms/uploads/UKS17754_part_21.docx', '2021-12-02 03:10:50'),
(30, 60, '', 'https://assignnmentinneed.com/terms/uploads/UKS177541.docx', '2021-12-02 03:10:50'),
(31, 206, '', 'https://assignnmentinneed.com/terms/uploads/UKS17900.docx', '2021-12-02 10:19:15'),
(32, 206, '', 'https://assignnmentinneed.com/terms/uploads/UKS17900.pdf', '2021-12-02 10:19:15'),
(33, 206, '', 'https://assignnmentinneed.com/terms/uploads/Starting_and_Managing_an_Entrepreneurial_Venture.pptx', '2021-12-02 10:19:15'),
(34, 211, '', 'https://assignnmentinneed.com/terms/uploads/uks_-_17905.pdf', '2021-12-03 04:56:39'),
(35, 211, '', 'https://assignnmentinneed.com/terms/uploads/UKS17905.docx', '2021-12-03 04:56:39'),
(36, 211, '', 'https://assignnmentinneed.com/terms/uploads/gantt_chart.pod', '2021-12-03 04:56:39'),
(37, 209, '', 'https://assignnmentinneed.com/terms/uploads/UKS17903_TurnitinReport.pdf', '2021-12-03 05:06:04'),
(38, 209, '', 'https://assignnmentinneed.com/terms/uploads/UKS17903.docx', '2021-12-03 05:06:04'),
(39, 328, '', 'https://assignnmentinneed.com/terms/uploads/UKS18020.pdf', '2021-12-05 00:37:59'),
(40, 328, '', 'https://assignnmentinneed.com/terms/uploads/UKS18020.docx', '2021-12-05 00:37:59'),
(41, 343, '', 'https://assignnmentinneed.com/terms/uploads/SAMPLE_Fwd_UKS18034.pptx', '2021-12-05 23:19:21'),
(42, 343, '', 'https://assignnmentinneed.com/terms/uploads/SAMPLE_Fwd_UKS18034.docx', '2021-12-05 23:19:21'),
(43, 343, '', 'https://assignnmentinneed.com/terms/uploads/Fwd_UKS18034.pdf', '2021-12-05 23:19:21'),
(44, 342, '', 'https://assignnmentinneed.com/terms/uploads/UKS18033.pptx', '2021-12-06 00:04:14'),
(45, 342, '', 'https://assignnmentinneed.com/terms/uploads/UKS18033.docx', '2021-12-06 00:04:14'),
(46, 342, '', 'https://assignnmentinneed.com/terms/uploads/UKS18033.pdf', '2021-12-06 00:04:14'),
(47, 344, '', 'https://assignnmentinneed.com/terms/uploads/UKS18035.docx', '2021-12-06 00:05:22'),
(48, 344, '', 'https://assignnmentinneed.com/terms/uploads/Fwd__UKS18035.pdf', '2021-12-06 00:05:22'),
(49, 225, '', 'https://assignnmentinneed.com/terms/uploads/UKS17919.docx', '2021-12-06 23:04:07'),
(50, 225, '', 'https://assignnmentinneed.com/terms/uploads/UKS17919.pdf', '2021-12-06 23:04:07'),
(51, 164, '', 'https://assignnmentinneed.com/terms/uploads/UKS17858.docx', '2021-12-07 00:21:17'),
(52, 164, '', 'https://assignnmentinneed.com/terms/uploads/UKS17858_Turnitin_Report.pdf', '2021-12-07 00:21:17'),
(53, 310, '', 'https://assignnmentinneed.com/terms/uploads/UKS18003_ppt_(1).pptx', '2021-12-09 01:18:15'),
(54, 310, '', 'https://assignnmentinneed.com/terms/uploads/UKS18003_ppt_(1).docx', '2021-12-09 01:18:15'),
(55, 310, '', 'https://assignnmentinneed.com/terms/uploads/UKS18003_ppt_TurnitinReport_(2).pdf', '2021-12-09 01:18:15'),
(56, 310, '', 'https://assignnmentinneed.com/terms/uploads/UKS18003.docx', '2021-12-09 01:18:15'),
(57, 310, '', 'https://assignnmentinneed.com/terms/uploads/UKS18003_Turnitin_Report.pdf', '2021-12-09 01:18:15'),
(58, 235, '', 'https://assignnmentinneed.com/terms/uploads/UKS17928.docx', '2021-12-09 01:33:37'),
(59, 235, '', 'https://assignnmentinneed.com/terms/uploads/UKS17928.xlsx', '2021-12-09 01:33:37'),
(60, 235, '', 'https://assignnmentinneed.com/terms/uploads/UKS17928_TurnitinReport.pdf', '2021-12-09 01:33:37'),
(61, 381, '', 'https://assignnmentinneed.com/terms/uploads/UKS18068_report.docx', '2021-12-09 01:55:55'),
(62, 381, '', 'https://assignnmentinneed.com/terms/uploads/UKS18068_ppt.docx', '2021-12-09 01:55:55'),
(63, 381, '', 'https://assignnmentinneed.com/terms/uploads/UKS18068_part_2.pptx', '2021-12-09 01:55:55'),
(64, 381, '', 'https://assignnmentinneed.com/terms/uploads/UKS18068_part_2_TurnitinReport.pdf', '2021-12-09 01:55:55'),
(65, 381, '', 'https://assignnmentinneed.com/terms/uploads/UKS18068_TurnitinRepot.pdf', '2021-12-09 01:55:55'),
(66, 476, '', 'https://assignnmentinneed.com/terms/uploads/UKS18162.docx', '2021-12-27 19:37:53'),
(67, 476, '', 'https://assignnmentinneed.com/terms/uploads/UKS18162.pdf', '2021-12-27 19:37:53'),
(68, 874, '', 'https://assignnmentinneed.com/terms/uploads/UKS18551_R1.docx', '2022-01-02 02:23:26'),
(69, 874, '', 'https://assignnmentinneed.com/terms/uploads/UKS18551_R1_TurnitinReport.pdf', '2022-01-02 02:23:26'),
(70, 1000, '', 'https://assignnmentinneed.com/terms/uploads/UKS18669.pdf', '2022-01-02 21:44:39'),
(71, 1000, '', 'https://assignnmentinneed.com/terms/uploads/UKS18669.docx', '2022-01-02 21:44:39'),
(72, 926, '', 'https://assignnmentinneed.com/terms/uploads/UKS18598_Plag_Report.pdf', '2022-01-02 21:51:34'),
(73, 926, '', 'https://assignnmentinneed.com/terms/uploads/UKS18598.docx', '2022-01-02 21:51:34'),
(74, 826, '', 'https://assignnmentinneed.com/terms/uploads/Plag_Report.pdf', '2022-01-02 21:54:16'),
(75, 826, '', 'https://assignnmentinneed.com/terms/uploads/UKS18500.docx', '2022-01-02 21:54:16'),
(76, 887, '', 'https://assignnmentinneed.com/terms/uploads/Plag_Report_UKS18560.pdf', '2022-01-03 00:43:50'),
(77, 887, '', 'https://assignnmentinneed.com/terms/uploads/UKS18560_ppt.pptx', '2022-01-03 00:43:50'),
(78, 887, '', 'https://assignnmentinneed.com/terms/uploads/UKS18560.docx', '2022-01-03 00:43:50'),
(79, 779, '', 'https://assignnmentinneed.com/terms/uploads/GAT_2.pdf', '2022-01-03 02:04:50'),
(80, 779, '', 'https://assignnmentinneed.com/terms/uploads/GAT_2.docx', '2022-01-03 02:04:50'),
(81, 779, '', 'https://assignnmentinneed.com/terms/uploads/Book2_(1).xlsx', '2022-01-03 02:04:50'),
(82, 947, '', 'https://assignnmentinneed.com/terms/uploads/Plag_Report_(2).pdf', '2022-01-03 04:03:18'),
(83, 947, '', 'https://assignnmentinneed.com/terms/uploads/UKS18618.docx', '2022-01-03 04:03:18'),
(84, 947, '', 'https://assignnmentinneed.com/terms/uploads/Section_B_(1).xlsx', '2022-01-03 04:03:18'),
(85, 947, '', 'https://assignnmentinneed.com/terms/uploads/Section_C.xlsx', '2022-01-03 04:03:18'),
(86, 947, '', 'https://assignnmentinneed.com/terms/uploads/Section_B_(2).xlsx', '2022-01-03 04:03:18'),
(87, 657, '', 'https://assignnmentinneed.com/terms/uploads/UKS18332.pdf', '2022-01-03 04:39:33'),
(88, 657, '', 'https://assignnmentinneed.com/terms/uploads/UKS18332.docx', '2022-01-03 04:39:33'),
(89, 5570, '', 'https://assignnmentinneed.com/terms/uploads/UKS23197.docx', '2022-06-26 07:01:10'),
(90, 5570, '', 'https://assignnmentinneed.com/terms/uploads/UKS23197.pdf', '2022-06-26 07:01:10'),
(91, 5570, '', 'https://assignnmentinneed.com/terms/uploads/UKS23197.pptx', '2022-06-26 07:01:10'),
(92, 10186, '', 'https://assignnmentinneed.com/admin/uploads/employees.sql', '2023-01-02 13:54:17'),
(93, 10186, '', 'https://assignnmentinneed.com/admin/uploads/employees1.sql', '2023-01-02 13:54:26'),
(94, 10186, '', 'https://assignnmentinneed.com/admin/uploads/Poster_template_with_guidance_(2).docx', '2023-01-02 13:54:35'),
(95, 10186, '', 'https://assignnmentinneed.com/admin/uploads/files_db_(2).sql', '2023-01-02 19:54:44'),
(96, 10186, '', 'https://assignnmentinneed.com/terms/uploads/Poster_template_with_guidance_(2)_(1).docx', '2023-01-03 21:41:52'),
(97, 10133, '', 'https://assignnmentinneed.com/admin/uploads/Poster_template_with_guidance_(2)1.docx', '2023-01-03 18:50:50'),
(98, 10343, '', 'https://assignnmentinneed.com/admin/uploads/files_db_(5).sql', '2023-01-04 13:40:50'),
(99, 10343, '', 'https://assignnmentinneed.com/admin/uploads/Poster_template_with_guidance_(2)_(3).docx', '2023-01-04 13:40:50'),
(100, 10522, '', 'https://assignnmentinneed.com/admin/uploads/users-data-2022-12-29_(1).csv', '2023-01-04 15:45:36'),
(101, 10080, '', 'https://assignnmentinneed.com/admin/uploads/employees_(1)1_(1)1.sql', '2023-01-04 16:58:05'),
(103, 10459, '', 'https://assignnmentinneed.com/admin/uploads/PORTFOLIO_Template_Resit.docx', '2023-01-10 19:57:16'),
(104, 10522, '', 'https://assignnmentinneed.com/admin/uploads/1927_SOCW.docx', '2023-01-11 15:28:20'),
(105, 10522, '', 'https://assignnmentinneed.com/admin/uploads/Business_Consultancy_Project_Guide.docx', '2023-01-11 15:33:43'),
(106, 10086, '', 'https://assignnmentinneed.com/admin/uploads/UKS27770.pdf', '2023-01-11 15:57:20'),
(107, 10086, '', 'https://assignnmentinneed.com/admin/uploads/10MB.zip', '2023-01-11 15:59:46'),
(108, 10522, '', 'https://assignnmentinneed.com/admin/uploads/10MB1.zip', '2023-01-11 16:02:34'),
(109, 10086, '', 'https://assignnmentinneed.com/admin/uploads/Assignment_1.docx', '2023-01-11 16:22:55'),
(110, 10522, '', 'https://assignnmentinneed.com/admin/uploads/Assignment_11.docx', '2023-01-11 16:36:11'),
(111, 10522, '', 'https://assignnmentinneed.com/admin/uploads/Archer_C50(EU)_V6_211108.zip', '2023-01-11 16:36:29'),
(112, 10117, '', 'https://assignnmentinneed.com/admin/uploads/5MB.zip', '2023-01-11 17:02:07'),
(113, 10820, '', 'https://assignnmentinneed.com/admin/uploads/Assignment_13.docx', '2023-01-11 17:37:03'),
(114, 10725, '', 'https://assignnmentinneed.com/admin/uploads/UKS28339.docx', '2023-01-11 17:57:54'),
(115, 10725, '', 'https://assignnmentinneed.com/admin/uploads/UKS28339_plag.pdf', '2023-01-11 17:57:54'),
(116, 10779, '', 'https://assignnmentinneed.com/admin/uploads/UKS28393.docx', '2023-01-12 15:18:48'),
(118, 10085, '', 'https://assignnmentinneed.com/admin/uploads/UKS27706.pptx', '2023-01-12 16:22:52'),
(119, 10085, '', 'https://assignnmentinneed.com/admin/uploads/UKS27706_Turnitin_Report.pdf', '2023-01-12 16:22:59'),
(120, 10744, '', 'https://assignnmentinneed.com/admin/uploads/UKS28358_Part_1.docx', '2023-01-12 16:31:59'),
(121, 10744, '', 'https://assignnmentinneed.com/admin/uploads/UKS28358_Part_2.docx', '2023-01-12 16:32:13'),
(122, 10744, '', 'https://assignnmentinneed.com/admin/uploads/UKS28358_Part_3.docx', '2023-01-12 16:32:20'),
(123, 10744, '', 'https://assignnmentinneed.com/admin/uploads/UKS28358_infogarphics.pdf', '2023-01-12 16:32:33'),
(124, 10744, '', 'https://assignnmentinneed.com/admin/uploads/UKS28358_TurnitinReport.pdf', '2023-01-12 16:33:12'),
(125, 10744, '', 'https://assignnmentinneed.com/admin/uploads/Reference_list_(14).docx', '2023-01-12 16:33:29'),
(126, 10681, '', 'https://assignnmentinneed.com/admin/uploads/UKS28295.docx', '2023-01-12 17:07:27'),
(127, 10681, '', 'https://assignnmentinneed.com/admin/uploads/Strategic_Leadership_ppt.pptx', '2023-01-12 17:07:36'),
(128, 10657, '', 'https://assignnmentinneed.com/admin/uploads/UKS28272.docx', '2023-01-12 17:19:20'),
(129, 10657, '', 'https://assignnmentinneed.com/admin/uploads/UKS28272.pdf', '2023-01-12 17:19:33'),
(130, 10229, '', 'https://assignnmentinneed.com/admin/uploads/UKS27845.docx', '2023-01-12 17:29:15'),
(131, 10229, '', 'https://assignnmentinneed.com/admin/uploads/UKS27845.pdf', '2023-01-12 17:29:29'),
(132, 10230, '', 'https://assignnmentinneed.com/admin/uploads/UKS27846.docx', '2023-01-12 17:30:25'),
(133, 10230, '', 'https://assignnmentinneed.com/admin/uploads/UREC2_Low_Risk_Human_Participants_2022-23v2_Final.doc', '2023-01-12 17:30:32'),
(134, 10230, '', 'https://assignnmentinneed.com/admin/uploads/UKS27846.pdf', '2023-01-12 17:30:39'),
(135, 10289, '', 'https://assignnmentinneed.com/admin/uploads/UKS27905.docx', '2023-01-12 17:38:29'),
(136, 10289, '', 'https://assignnmentinneed.com/admin/uploads/UKS27905.pdf', '2023-01-12 17:38:36'),
(137, 10564, '', 'https://assignnmentinneed.com/admin/uploads/BookShop.zip', '2023-01-12 17:44:26'),
(138, 10564, '', 'https://assignnmentinneed.com/admin/uploads/Video.mp4', '2023-01-12 17:44:48'),
(139, 10564, '', 'https://assignnmentinneed.com/admin/uploads/UKS28179.docx', '2023-01-12 17:45:08'),
(140, 10564, '', 'https://assignnmentinneed.com/admin/uploads/UKS28179.pdf', '2023-01-12 17:45:23'),
(141, 10258, '', 'https://assignnmentinneed.com/admin/uploads/UKS27874.docx', '2023-01-12 18:03:24'),
(142, 10258, '', 'https://assignnmentinneed.com/admin/uploads/UKS27874.pdf', '2023-01-12 18:03:36'),
(143, 10600, '', 'https://assignnmentinneed.com/admin/uploads/UKS28215.docx', '2023-01-12 18:14:57'),
(144, 10606, '', 'https://assignnmentinneed.com/admin/uploads/UKS28221.pdf', '2023-01-12 20:10:51'),
(145, 10606, '', 'https://assignnmentinneed.com/admin/uploads/UKS28221.docx', '2023-01-12 20:10:58'),
(146, 10682, '', 'https://assignnmentinneed.com/admin/uploads/UKS28296.pdf', '2023-01-12 20:17:42'),
(147, 10682, '', 'https://assignnmentinneed.com/admin/uploads/UKS28296.docx', '2023-01-12 20:17:49'),
(148, 10211, '', 'https://assignnmentinneed.com/admin/uploads/UKS27827.pdf', '2023-01-12 20:21:48'),
(149, 10211, '', 'https://assignnmentinneed.com/admin/uploads/UKS27827.docx', '2023-01-12 20:21:58'),
(150, 10724, '', 'https://assignnmentinneed.com/admin/uploads/UKS28338.pdf', '2023-01-12 20:23:52'),
(151, 10724, '', 'https://assignnmentinneed.com/admin/uploads/UKS28338.docx', '2023-01-12 20:24:14'),
(152, 10344, '', 'https://assignnmentinneed.com/admin/uploads/UKS27960.docx', '2023-01-12 20:40:07'),
(153, 10344, '', 'https://assignnmentinneed.com/admin/uploads/UKS27960.xlsx', '2023-01-12 20:40:17'),
(154, 10344, '', 'https://assignnmentinneed.com/admin/uploads/UKS27960.pdf', '2023-01-12 20:40:33'),
(155, 10729, '', 'https://assignnmentinneed.com/admin/uploads/UKS28343.pdf', '2023-01-12 21:03:18'),
(156, 10729, '', 'https://assignnmentinneed.com/admin/uploads/UKS28343.docx', '2023-01-12 21:03:27'),
(157, 10463, '', 'https://assignnmentinneed.com/admin/uploads/UKS28079.docx', '2023-01-13 13:22:34'),
(158, 10463, '', 'https://assignnmentinneed.com/admin/uploads/UKS28079_TurnitinReport.pdf', '2023-01-13 13:22:54'),
(159, 10794, '', 'https://assignnmentinneed.com/admin/uploads/UKS28408.docx', '2023-01-13 19:27:32'),
(160, 10761, '', 'https://assignnmentinneed.com/admin/uploads/UKS28375.docx', '2023-01-14 14:20:53'),
(161, 10761, '', 'https://assignnmentinneed.com/admin/uploads/UKS28375.pptx', '2023-01-14 14:21:00'),
(162, 10761, '', 'https://assignnmentinneed.com/admin/uploads/UKS28375.pdf', '2023-01-14 14:21:09'),
(163, 10672, '', 'https://assignnmentinneed.com/admin/uploads/Compiled_UKS28286.docx', '2023-01-14 14:42:04'),
(164, 10672, '', 'https://assignnmentinneed.com/admin/uploads/UKS28286.pdf', '2023-01-14 14:42:59'),
(165, 10475, '', 'https://assignnmentinneed.com/admin/uploads/UKS28091_Turnitin_Report.pdf', '2023-01-14 14:54:13'),
(166, 10475, '', 'https://assignnmentinneed.com/admin/uploads/UKS28091.docx', '2023-01-14 14:54:34'),
(167, 10868, '', 'https://assignnmentinneed.com/admin/uploads/UKS28482.docx', '2023-01-14 16:06:56'),
(168, 10868, '', 'https://assignnmentinneed.com/admin/uploads/UKS28482.pptx', '2023-01-14 16:07:04'),
(169, 10488, '', 'https://assignnmentinneed.com/admin/uploads/UKS28104.pdf', '2023-01-14 20:32:30'),
(170, 10488, '', 'https://assignnmentinneed.com/admin/uploads/UKS28104.docx', '2023-01-14 20:32:48'),
(171, 10188, '', 'https://assignnmentinneed.com/admin/uploads/right-check.jpg', '2023-01-14 20:38:55'),
(172, 10188, '', 'https://assignnmentinneed.com/admin/uploads/kernel32_(1).zip', '2023-01-14 20:39:25'),
(173, 10704, '', 'https://assignnmentinneed.com/admin/uploads/UKS28318.pdf', '2023-01-14 21:04:29'),
(174, 10704, '', 'https://assignnmentinneed.com/admin/uploads/UKS28318.docx', '2023-01-14 21:04:44'),
(175, 10556, '', 'https://assignnmentinneed.com/admin/uploads/UKS28171.pdf', '2023-01-14 21:12:19'),
(176, 10556, '', 'https://assignnmentinneed.com/admin/uploads/UKS28171.docx', '2023-01-14 21:12:31'),
(177, 10553, '', 'https://assignnmentinneed.com/admin/uploads/UKS28169.docx', '2023-01-15 19:49:05'),
(178, 10553, '', 'https://assignnmentinneed.com/admin/uploads/UKS28169n_Plag.pdf', '2023-01-15 19:49:05'),
(179, 10553, '', 'https://assignnmentinneed.com/admin/uploads/sport_club_tables.sql', '2023-01-15 19:49:05'),
(180, 10553, '', 'https://assignnmentinneed.com/admin/uploads/Sport_club_diagrams.drawio', '2023-01-15 19:49:05'),
(181, 10553, '', 'https://assignnmentinneed.com/admin/uploads/relation_sport_club.sql', '2023-01-15 19:49:05'),
(182, 10377, '', 'https://assignnmentinneed.com/admin/uploads/UKS27993.pdf', '2023-01-16 19:05:44'),
(183, 10377, '', 'https://assignnmentinneed.com/admin/uploads/UKS27993.docx', '2023-01-16 19:05:55'),
(184, 10376, '', 'https://assignnmentinneed.com/admin/uploads/UKS27992.pdf', '2023-01-16 19:08:28'),
(185, 10376, '', 'https://assignnmentinneed.com/admin/uploads/UKS27992.docx', '2023-01-16 19:08:42'),
(186, 10555, '', 'https://assignnmentinneed.com/admin/uploads/UKS28170.docx', '2023-01-17 15:53:11'),
(187, 10476, '', 'https://assignnmentinneed.com/admin/uploads/UKS28092_Turnitin_Report.pdf', '2023-01-17 17:32:26'),
(188, 10476, '', 'https://assignnmentinneed.com/admin/uploads/UKS28092.docx', '2023-01-17 17:32:40'),
(189, 10477, '', 'https://assignnmentinneed.com/admin/uploads/UKS28093_TurnitinReport.pdf', '2023-01-17 17:34:10'),
(190, 10477, '', 'https://assignnmentinneed.com/admin/uploads/UKS28093.docx', '2023-01-17 17:34:23'),
(191, 10926, '', 'https://assignnmentinneed.com/admin/uploads/UKS28540.pdf', '2023-01-17 19:13:26'),
(192, 10926, '', 'https://assignnmentinneed.com/admin/uploads/UKS28540.docx', '2023-01-17 19:13:44'),
(193, 10895, '', 'https://assignnmentinneed.com/admin/uploads/UKS28509.pdf', '2023-01-17 19:21:11'),
(194, 10895, '', 'https://assignnmentinneed.com/admin/uploads/UKS28509.pptx', '2023-01-17 19:21:25'),
(195, 10895, '', 'https://assignnmentinneed.com/admin/uploads/UKS28509.docx', '2023-01-17 19:21:38'),
(196, 10946, '', 'https://assignnmentinneed.com/admin/uploads/UKS28560.pdf', '2023-01-17 20:33:55'),
(197, 10946, '', 'https://assignnmentinneed.com/admin/uploads/UKS28560.docx', '2023-01-17 20:34:08'),
(198, 10940, '', 'https://assignnmentinneed.com/admin/uploads/UKS28554.pdf', '2023-01-17 20:35:23'),
(199, 10940, '', 'https://assignnmentinneed.com/admin/uploads/UKS28554.docx', '2023-01-17 20:35:28'),
(200, 10683, '', 'https://assignnmentinneed.com/admin/uploads/gantt_chart.mpp', '2023-01-17 20:36:58'),
(201, 10683, '', 'https://assignnmentinneed.com/admin/uploads/UKS28297.docx', '2023-01-17 20:37:10'),
(202, 10683, '', 'https://assignnmentinneed.com/admin/uploads/Diagram.rar', '2023-01-17 20:37:15'),
(203, 11286, '', 'https://assignnmentinneed.com/admin/uploads/id-card_sawal_ramRJ-JL002922.pdf', '2023-03-27 23:18:40'),
(204, 11288, '', 'https://assignnmentinneed.com/admin/uploads/orders.sql', '2023-04-10 00:45:29'),
(205, 11288, '', 'https://assignnmentinneed.com/admin/uploads/Ansh_Resume_(3)_2.pdf', '2023-04-10 00:46:07'),
(206, 11286, '', 'https://assignnmentinneed.com/user_login/uploads/id-card_sawal_ramRJ-JL0029221.pdf', '2023-04-11 07:17:51'),
(207, 11283, '', 'https://assignnmentinneed.com/user_login/uploads/Ansh_Resume_(3)_21.pdf', '2023-04-14 05:00:58'),
(208, 11280, '', 'https://assignnmentinneed.com/user_login/uploads/Ansh_Resume_(3)_(1).pdf', '2023-04-14 05:47:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
