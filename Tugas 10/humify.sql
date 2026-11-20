-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2026 at 07:24 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `humify`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_id` int UNSIGNED DEFAULT NULL,
  `attendance_date` date NOT NULL,
  `check_in_time` datetime DEFAULT NULL,
  `check_in_lat` double DEFAULT NULL,
  `check_in_lng` double DEFAULT NULL,
  `check_in_photo_url` text COLLATE utf8mb4_unicode_ci,
  `check_in_face_verified` tinyint(1) DEFAULT NULL,
  `check_in_face_score` decimal(5,2) DEFAULT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `check_out_lat` double DEFAULT NULL,
  `check_out_lng` double DEFAULT NULL,
  `check_out_photo_url` text COLLATE utf8mb4_unicode_ci,
  `check_out_face_verified` tinyint(1) DEFAULT NULL,
  `check_out_face_score` decimal(5,2) DEFAULT NULL,
  `status` enum('hadir','terlambat','pulang_cepat','izin','sakit','cuti','alpha','libur') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hadir',
  `late_minutes` int NOT NULL DEFAULT '0',
  `early_leave_minutes` int NOT NULL DEFAULT '0',
  `work_minutes` int DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `review_status` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reviewed_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `review_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `shift_id`, `attendance_date`, `check_in_time`, `check_in_lat`, `check_in_lng`, `check_in_photo_url`, `check_in_face_verified`, `check_in_face_score`, `check_out_time`, `check_out_lat`, `check_out_lng`, `check_out_photo_url`, `check_out_face_verified`, `check_out_face_score`, `status`, `late_minutes`, `early_leave_minutes`, `work_minutes`, `notes`, `review_status`, `reviewed_by`, `reviewed_at`, `review_note`, `created_at`, `updated_at`) VALUES
(1, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-11-04', '2026-11-04 08:45:00', NULL, NULL, NULL, 1, 96.50, '2026-11-04 17:10:00', NULL, NULL, NULL, NULL, NULL, 'hadir', 0, 0, NULL, 'Presensi mobile regular', 'disetujui', 'c022c944-690d-4983-aecb-ede655982ec6', '2026-11-04 15:02:50', NULL, '2026-11-04 14:36:46', '2026-11-04 15:02:50'),
(2, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-11-03', '2026-11-03 08:46:00', NULL, NULL, NULL, 1, 96.50, '2026-11-03 17:10:00', NULL, NULL, NULL, NULL, NULL, 'hadir', 0, 0, NULL, 'Presensi mobile regular', 'disetujui', NULL, NULL, NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
(3, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-11-02', '2026-11-02 08:47:00', NULL, NULL, NULL, 1, 96.50, '2026-11-02 17:10:00', NULL, NULL, NULL, NULL, NULL, 'terlambat', 15, 0, NULL, 'Presensi mobile regular', 'disetujui', NULL, NULL, NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
(4, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-10-30', '2026-10-30 08:50:00', NULL, NULL, NULL, 1, 96.50, '2026-10-30 17:10:00', NULL, NULL, NULL, NULL, NULL, 'hadir', 0, 0, NULL, 'Presensi mobile regular', 'disetujui', NULL, NULL, NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
(5, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-10-29', '2026-10-29 08:51:00', NULL, NULL, NULL, 1, 96.50, '2026-10-29 17:10:00', NULL, NULL, NULL, NULL, NULL, 'hadir', 0, 0, NULL, 'Presensi mobile regular', 'disetujui', NULL, NULL, NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
(6, 'ee86d41e-6886-4357-bb0c-596d5c0f0533', 1, '2026-11-04', '2026-11-04 08:55:00', NULL, NULL, NULL, 1, 94.00, NULL, NULL, NULL, NULL, NULL, NULL, 'hadir', 0, 0, NULL, 'Presensi mobile regular', 'disetujui', 'c022c944-690d-4983-aecb-ede655982ec6', '2026-11-04 15:02:41', NULL, '2026-11-04 14:37:47', '2026-11-04 15:02:41'),
(7, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', NULL, '2026-11-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cuti', 0, 0, NULL, NULL, 'pending', NULL, NULL, NULL, '2026-11-04 22:03:19', '2026-11-04 22:03:19'),
(8, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', NULL, '2026-11-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cuti', 0, 0, NULL, NULL, 'pending', NULL, NULL, NULL, '2026-11-04 22:03:19', '2026-11-04 22:03:19'),
(9, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', NULL, '2026-11-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cuti', 0, 0, NULL, NULL, 'pending', NULL, NULL, NULL, '2026-11-04 22:03:19', '2026-11-04 22:03:19'),
(10, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-11-14', '2026-11-14 01:13:35', -6.2087634, 106.845599, NULL, 1, 96.80, '2026-11-14 01:14:37', -6.2087634, 106.845599, NULL, 1, 96.50, 'hadir', 0, 945, 1, 'Presensi mobile regular', 'disetujui', NULL, NULL, NULL, '2026-11-13 18:13:35', '2026-11-14 01:14:37');

--
-- Triggers `attendances`
--
DELIMITER $$
CREATE TRIGGER `trg_validate_attendance_shift_insert` BEFORE INSERT ON `attendances` FOR EACH ROW BEGIN
                DECLARE v_is_shift_worker BOOLEAN DEFAULT NULL;
                DECLARE v_category VARCHAR(20) DEFAULT NULL;

                IF NEW.shift_id IS NOT NULL THEN
                    SELECT is_shift_worker
                      INTO v_is_shift_worker
                      FROM employees
                     WHERE id = NEW.employee_id;

                    SELECT category
                      INTO v_category
                      FROM work_shifts
                     WHERE id = NEW.shift_id;

                    IF v_is_shift_worker = TRUE AND v_category <> 'shifting' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan shifting hanya boleh memilih shift shifting';
                    ELSEIF v_is_shift_worker = FALSE AND v_category <> 'regular' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan regular hanya boleh memilih shift regular';
                    END IF;
                END IF;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_validate_attendance_shift_update` BEFORE UPDATE ON `attendances` FOR EACH ROW BEGIN
                DECLARE v_is_shift_worker BOOLEAN DEFAULT NULL;
                DECLARE v_category VARCHAR(20) DEFAULT NULL;

                IF NEW.shift_id IS NOT NULL THEN
                    SELECT is_shift_worker
                      INTO v_is_shift_worker
                      FROM employees
                     WHERE id = NEW.employee_id;

                    SELECT category
                      INTO v_category
                      FROM work_shifts
                     WHERE id = NEW.shift_id;

                    IF v_is_shift_worker = TRUE AND v_category <> 'shifting' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan shifting hanya boleh memilih shift shifting';
                    ELSEIF v_is_shift_worker = FALSE AND v_category <> 'regular' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan regular hanya boleh memilih shift regular';
                    END IF;
                END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Teknologi Informasi', '{\"name\":\"Kantor Pusat Humify\",\"address\":\"Gedung Cyber 2, Kuningan Barat\",\"latitude\":-6.2088,\"longitude\":106.8456,\"radius_meters\":150,\"updated_at\":\"2026-11-18T00:38:13+07:00\",\"updated_by\":\"f47ba2dd-840a-4ace-9d1a-baaa37cad26d\"}', '2026-11-04 14:34:16'),
(2, 'Sumber Daya Manusia', '{\"name\":\"Kantor Pusat Humify\",\"address\":\"Gedung Cyber 2, Kuningan Barat\",\"latitude\":-6.2088,\"longitude\":106.8456,\"radius_meters\":150,\"updated_at\":\"2026-11-18T00:38:13+07:00\",\"updated_by\":\"f47ba2dd-840a-4ace-9d1a-baaa37cad26d\"}', '2026-11-04 14:34:16'),
(3, 'Operasional', '{\"name\":\"Kantor Pusat Humify\",\"address\":\"Gedung Cyber 2, Kuningan Barat\",\"latitude\":-6.2088,\"longitude\":106.8456,\"radius_meters\":150,\"updated_at\":\"2026-11-18T00:38:13+07:00\",\"updated_by\":\"f47ba2dd-840a-4ace-9d1a-baaa37cad26d\"}', '2026-11-04 14:34:16'),
(4, 'Product Design', '{\"name\":\"Kantor Pusat Humify\",\"address\":\"Gedung Cyber 2, Kuningan Barat\",\"latitude\":-6.2088,\"longitude\":106.8456,\"radius_meters\":150,\"updated_at\":\"2026-11-18T00:38:13+07:00\",\"updated_by\":\"f47ba2dd-840a-4ace-9d1a-baaa37cad26d\"}', '2026-11-04 14:36:46'),
(5, 'Engineering', '{\"name\":\"Kantor Pusat Humify\",\"address\":\"Gedung Cyber 2, Kuningan Barat\",\"latitude\":-6.2088,\"longitude\":106.8456,\"radius_meters\":150,\"updated_at\":\"2026-11-18T00:38:13+07:00\",\"updated_by\":\"f47ba2dd-840a-4ace-9d1a-baaa37cad26d\"}', '2026-11-04 14:36:46'),
(6, 'Operations', '{\"name\":\"Kantor Pusat Humify\",\"address\":\"Gedung Cyber 2, Kuningan Barat\",\"latitude\":-6.2088,\"longitude\":106.8456,\"radius_meters\":150,\"updated_at\":\"2026-11-18T00:38:13+07:00\",\"updated_by\":\"f47ba2dd-840a-4ace-9d1a-baaa37cad26d\"}', '2026-11-04 14:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_place` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `face_reference_photo_url` text COLLATE utf8mb4_unicode_ci,
  `face_registered_at` datetime DEFAULT NULL,
  `department_id` int UNSIGNED DEFAULT NULL,
  `position_id` int UNSIGNED DEFAULT NULL,
  `supervisor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_type` enum('tetap','kontrak','magang','harian') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tetap',
  `employee_status` enum('aktif','nonaktif','resign','cuti_panjang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `is_shift_worker` tinyint(1) NOT NULL DEFAULT '0',
  `hire_date` date NOT NULL,
  `resign_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_code`, `full_name`, `email`, `phone`, `gender`, `birth_place`, `birth_date`, `address`, `photo_url`, `face_reference_photo_url`, `face_registered_at`, `department_id`, `position_id`, `supervisor_id`, `employment_type`, `employee_status`, `is_shift_worker`, `hire_date`, `resign_date`, `created_at`, `updated_at`) VALUES
('1b19b938-b8f4-46a5-bc8b-2b701944b8dd', 'EMP-SHF01', 'Rian Karyawan Shifting', 'rian@humify.test', '081234567894', 'L', 'Yogyakarta', '1997-07-25', 'Jl. Kemang Raya No. 20, Jakarta', NULL, NULL, NULL, 3, 5, 'c9d6607c-1364-4a0a-8ae4-f7dab5acf2d5', 'kontrak', 'aktif', 1, '2023-02-01', NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('2e65ad1d-ed00-45c4-a79a-1796a676c217', 'EMP-HR01', 'Siti Admin HR', 'adminhr@humify.test', '081234567891', 'P', 'Bandung', '1990-08-20', 'Jl. Gatot Subroto No. 10, Jakarta', NULL, NULL, NULL, 2, 2, NULL, 'tetap', 'aktif', 0, '2022-03-01', NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('4baa273b-2bc2-4d52-9301-f1cbd6d3fa5a', 'EMP-004', 'Daniel Brooks', 'daniel.brooks@humify.test', '+62 812 3456 7004', 'L', 'Jakarta', '1985-02-14', 'Jl. Mega Kuningan Barat No. 3, Jakarta Selatan', NULL, NULL, NULL, 5, 9, NULL, 'tetap', 'aktif', 0, '2019-08-01', NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
('52411a65-9e74-485c-9fe4-0f883ed5aa73', 'EMP-003', 'Sofia Patel', 'sofia.patel@humify.test', '+62 812 3456 7003', 'P', 'Medan', '1987-09-05', 'Jl. TB Simatupang No. 25, Jakarta Selatan', NULL, NULL, NULL, 6, 8, NULL, 'tetap', 'aktif', 0, '2020-01-15', NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
('57efc355-d883-4620-a2a7-dc3efe4a373f', 'EMP-SA01', 'Budi Super Admin', 'superadmin@humify.test', '081234567890', 'L', 'Jakarta', '1985-05-15', 'Jl. Jenderal Sudirman No. 1, Jakarta', NULL, NULL, NULL, 1, 1, NULL, 'tetap', 'aktif', 0, '2022-01-01', NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('7a03c9c7-0d5a-4636-9069-edfc1b72f964', 'EMP-REG01', 'Andi Karyawan Regular', 'andi@humify.test', '081234567893', 'L', 'Semarang', '1995-03-12', 'Jl. Tebet Raya No. 12, Jakarta', NULL, NULL, NULL, 3, 4, 'c9d6607c-1364-4a0a-8ae4-f7dab5acf2d5', 'tetap', 'aktif', 0, '2023-01-10', NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 'EMP-001', 'Alex Morgan', 'alex.morgan@humify.test', '6281234567001', 'L', 'Jakarta', '1994-11-18', 'JL. Nakula 6', NULL, NULL, NULL, 4, 6, 'fca1a42e-d444-4e0a-9812-97ae47409eb2', 'tetap', 'aktif', 0, '2022-06-01', NULL, '2026-11-04 14:36:46', '2026-11-14 00:33:05'),
('c9d6607c-1364-4a0a-8ae4-f7dab5acf2d5', 'EMP-MGR01', 'Doni Manager', 'manager@humify.test', '081234567892', 'L', 'Surabaya', '1988-11-10', 'Jl. Rasuna Said No. 5, Jakarta', NULL, NULL, NULL, 3, 3, NULL, 'tetap', 'aktif', 0, '2022-02-01', NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('ca3eed4c-ace7-4b16-9aa0-427e35cebd61', 'EMP-029', 'Veydayen Fatzla Al Fiansyach', 'veydayen.fatzla18@gmail.com', '085713280480', 'L', 'Jakarta', '2003-02-02', 'Jl Nakula 6 Babelan', NULL, NULL, NULL, 5, 4, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 'kontrak', 'aktif', 0, '2026-11-12', NULL, '2026-11-12 06:56:22', '2026-11-14 01:27:51'),
('ee86d41e-6886-4357-bb0c-596d5c0f0533', 'EMP-005', 'Sarah Connor', 'sarah.connor@humify.test', '+62 812 3456 7005', 'P', 'Surabaya', '1996-04-12', 'Jl. Bangka IX No. 8, Jakarta Selatan', NULL, NULL, NULL, 4, 6, 'fca1a42e-d444-4e0a-9812-97ae47409eb2', 'tetap', 'aktif', 0, '2023-01-10', NULL, '2026-11-04 14:36:46', '2026-11-04 14:37:47'),
('fca1a42e-d444-4e0a-9812-97ae47409eb2', 'EMP-002', 'Maya Chen', 'maya.chen@humify.test', '+62 812 3456 7002', 'P', 'Jakarta', '1989-07-22', 'Jl. Senopati No. 42, Jakarta Selatan', NULL, NULL, NULL, 4, 7, NULL, 'tetap', 'aktif', 0, '2021-03-15', NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `leave_balances`
--

CREATE TABLE `leave_balances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type_id` int UNSIGNED NOT NULL,
  `year` smallint NOT NULL,
  `total_days` decimal(5,1) NOT NULL DEFAULT '0.0',
  `used_days` decimal(5,1) NOT NULL DEFAULT '0.0',
  `remaining_days` decimal(5,1) GENERATED ALWAYS AS ((`total_days` - `used_days`)) STORED,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_balances`
--

INSERT INTO `leave_balances` (`id`, `employee_id`, `leave_type_id`, `year`, `total_days`, `used_days`, `created_at`, `updated_at`) VALUES
(1, '57efc355-d883-4620-a2a7-dc3efe4a373f', 1, 2026, 12.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(2, '57efc355-d883-4620-a2a7-dc3efe4a373f', 2, 2026, 3.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(3, '2e65ad1d-ed00-45c4-a79a-1796a676c217', 1, 2026, 12.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(4, '2e65ad1d-ed00-45c4-a79a-1796a676c217', 2, 2026, 3.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(5, 'c9d6607c-1364-4a0a-8ae4-f7dab5acf2d5', 1, 2026, 12.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(6, 'c9d6607c-1364-4a0a-8ae4-f7dab5acf2d5', 2, 2026, 3.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(7, '7a03c9c7-0d5a-4636-9069-edfc1b72f964', 1, 2026, 12.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(8, '7a03c9c7-0d5a-4636-9069-edfc1b72f964', 2, 2026, 3.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(9, '1b19b938-b8f4-46a5-bc8b-2b701944b8dd', 1, 2026, 12.0, 0.0, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
(10, '1b19b938-b8f4-46a5-bc8b-2b701944b8dd', 2, 2026, 3.0, 0.0, '2026-11-04 14:34:17', '2026-11-04 14:34:17'),
(11, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, 2026, 12.0, 7.0, '2026-11-04 14:36:46', '2026-11-04 22:03:19'),
(12, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 2, 2026, 3.0, 1.0, '2026-11-04 14:36:46', '2026-11-04 14:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type_id` int UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` decimal(5,1) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `attachment_url` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','disetujui','ditolak','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `approved_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type_id`, `start_date`, `end_date`, `total_days`, `reason`, `attachment_url`, `status`, `approved_by`, `approved_at`, `rejection_reason`, `created_at`, `updated_at`) VALUES
(1, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-11-09', '2026-11-11', 3.0, 'Family vacation in Bali', NULL, 'disetujui', 'c022c944-690d-4983-aecb-ede655982ec6', '2026-11-04 15:03:19', NULL, '2026-11-04 14:36:46', '2026-11-04 15:03:19'),
(2, 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 1, '2026-10-15', '2026-10-16', 2.0, 'Personal matters and renewal of documents', NULL, 'disetujui', 'c022c944-690d-4983-aecb-ede655982ec6', '2026-10-14 14:36:46', NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46');

--
-- Triggers `leave_requests`
--
DELIMITER $$
CREATE TRIGGER `trg_apply_leave_balance` AFTER UPDATE ON `leave_requests` FOR EACH ROW BEGIN
                DECLARE v_date DATE;

                IF NEW.status = 'disetujui' AND OLD.status <> 'disetujui' THEN

                    UPDATE leave_balances
                       SET used_days = used_days + NEW.total_days
                     WHERE employee_id = NEW.employee_id
                       AND leave_type_id = NEW.leave_type_id
                       AND `year` = YEAR(NEW.start_date);

                    SET v_date = NEW.start_date;

                    WHILE v_date <= NEW.end_date DO
                        INSERT INTO attendances (employee_id, attendance_date, status)
                        VALUES (NEW.employee_id, v_date, 'cuti')
                        ON DUPLICATE KEY UPDATE status = 'cuti';

                        SET v_date = DATE_ADD(v_date, INTERVAL 1 DAY);
                    END WHILE;

                END IF;

                IF OLD.status = 'disetujui'
                   AND NEW.status IN ('ditolak', 'dibatalkan') THEN

                    UPDATE leave_balances
                       SET used_days = used_days - OLD.total_days
                     WHERE employee_id = OLD.employee_id
                       AND leave_type_id = OLD.leave_type_id
                       AND `year` = YEAR(OLD.start_date);

                END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '1',
  `max_days_per_year` int DEFAULT NULL,
  `requires_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `is_paid`, `max_days_per_year`, `requires_attachment`, `created_at`) VALUES
(1, 'Annual leave', 1, 12, 0, '2026-11-04 14:34:15'),
(2, 'Personal leave', 1, 3, 0, '2026-11-04 14:34:15'),
(3, 'Sick', 1, NULL, 1, '2026-11-04 14:34:16'),
(4, 'Permission', 1, NULL, 0, '2026-11-04 14:34:16'),
(5, 'Unpaid', 0, NULL, 0, '2026-11-04 14:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_01_01_000001_create_departments_table', 1),
(2, '2026_01_01_000002_create_positions_table', 1),
(3, '2026_01_01_000003_create_employees_table', 1),
(4, '2026_01_01_000004_create_users_table', 1),
(5, '2026_01_01_000005_create_work_shifts_table', 1),
(6, '2026_01_01_000006_create_attendances_table', 1),
(7, '2026_01_01_000007_create_leave_types_table', 1),
(8, '2026_01_01_000008_create_leave_balances_table', 1),
(9, '2026_01_01_000009_create_leave_requests_table', 1),
(10, '2026_01_01_000010_create_hris_triggers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int UNSIGNED NOT NULL,
  `department_id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` smallint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `department_id`, `name`, `level`, `created_at`) VALUES
(1, 1, 'IT Director', 3, '2026-11-04 14:34:16'),
(2, 2, 'HR Staff', 1, '2026-11-04 14:34:16'),
(3, 3, 'Operations Manager', 2, '2026-11-04 14:34:16'),
(4, 3, 'Customer Service Regular', 1, '2026-11-04 14:34:16'),
(5, 3, 'Customer Service Shifting', 1, '2026-11-04 14:34:16'),
(6, 4, 'Product Designer', 1, '2026-11-04 14:36:46'),
(7, 4, 'Design Manager', 2, '2026-11-04 14:36:46'),
(8, 6, 'HR Manager', 2, '2026-11-04 14:36:46'),
(9, 5, 'System Administrator', 3, '2026-11-04 14:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('super_admin','admin_hr','manager','karyawan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password_hash`, `role`, `is_active`, `last_login_at`, `created_at`, `updated_at`) VALUES
('12293dad-ef9a-4b4c-a50c-7b13cbfada71', '7a03c9c7-0d5a-4636-9069-edfc1b72f964', 'karyawan', '$2y$12$ZGc8//qFr2knhP6GS2klhebKeY/Tl1G2TdhzRDnExTls6I0iGsja.', 'karyawan', 1, NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('7524e03d-2b32-4fde-8ca7-5cfb30c41ef8', '57efc355-d883-4620-a2a7-dc3efe4a373f', 'superadmin', '$2y$12$ZGc8//qFr2knhP6GS2klhebKeY/Tl1G2TdhzRDnExTls6I0iGsja.', 'super_admin', 1, NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('88e93ee3-e8a5-44e0-9cb5-c88d2dc66d7b', 'c9d6607c-1364-4a0a-8ae4-f7dab5acf2d5', 'manager', '$2y$12$ZGc8//qFr2knhP6GS2klhebKeY/Tl1G2TdhzRDnExTls6I0iGsja.', 'manager', 1, NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('97652887-47a7-442f-a1b1-99f7cd6df9b8', '4baa273b-2bc2-4d52-9301-f1cbd6d3fa5a', 'daniel.brooks', '$2y$12$5T3RGSKFGllsf7y8ADuLiegAPX7QZltJXR.6vgRfvB6fm6bLjA/O2', 'super_admin', 1, NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
('a71d3594-a468-45b4-b812-cd43169d607a', '2e65ad1d-ed00-45c4-a79a-1796a676c217', 'adminhr', '$2y$12$ZGc8//qFr2knhP6GS2klhebKeY/Tl1G2TdhzRDnExTls6I0iGsja.', 'admin_hr', 1, '2026-11-12 06:04:15', '2026-11-04 14:34:16', '2026-11-12 06:04:15'),
('b5ce3331-d0c6-4219-b5a0-76981bf19e32', 'c62cf0cb-d85c-4cc4-b588-3673d11cd9bd', 'alex.morgan', '$2y$12$5T3RGSKFGllsf7y8ADuLiegAPX7QZltJXR.6vgRfvB6fm6bLjA/O2', 'karyawan', 1, '2026-11-14 01:14:36', '2026-11-04 14:36:46', '2026-11-14 01:14:36'),
('c022c944-690d-4983-aecb-ede655982ec6', 'fca1a42e-d444-4e0a-9812-97ae47409eb2', 'maya.chen', '$2y$12$5T3RGSKFGllsf7y8ADuLiegAPX7QZltJXR.6vgRfvB6fm6bLjA/O2', 'manager', 1, '2026-11-13 18:12:06', '2026-11-04 14:36:46', '2026-11-13 18:12:06'),
('c50f6509-1616-4ae7-b0e7-562fe9e35314', '1b19b938-b8f4-46a5-bc8b-2b701944b8dd', 'karyawanshift', '$2y$12$ZGc8//qFr2knhP6GS2klhebKeY/Tl1G2TdhzRDnExTls6I0iGsja.', 'karyawan', 1, NULL, '2026-11-04 14:34:16', '2026-11-04 14:34:16'),
('e81a67e6-c71b-4f46-9504-c76380988943', 'ca3eed4c-ace7-4b16-9aa0-427e35cebd61', 'dayen-dels', '$2y$12$BXEF.ZraPS9mgTJ9vM.k3uU89QGKjUi2fk6CsDQCdg52qbLno8ScG', 'karyawan', 1, '2026-11-14 01:27:15', '2026-11-12 09:45:29', '2026-11-14 01:27:15'),
('e93dc73b-c143-4224-b6a8-757a8bbfd3bd', 'ee86d41e-6886-4357-bb0c-596d5c0f0533', 'sarah.connor', '$2y$12$5T3RGSKFGllsf7y8ADuLiegAPX7QZltJXR.6vgRfvB6fm6bLjA/O2', 'karyawan', 1, NULL, '2026-11-04 14:36:46', '2026-11-04 14:36:46'),
('f47ba2dd-840a-4ace-9d1a-baaa37cad26d', '52411a65-9e74-485c-9fe4-0f883ed5aa73', 'sofia.patel', '$2y$12$5T3RGSKFGllsf7y8ADuLiegAPX7QZltJXR.6vgRfvB6fm6bLjA/O2', 'admin_hr', 1, '2026-11-18 00:38:11', '2026-11-04 14:36:46', '2026-11-18 00:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `work_shifts`
--

CREATE TABLE `work_shifts` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `category` enum('regular','shifting') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_overnight` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_shifts`
--

INSERT INTO `work_shifts` (`id`, `name`, `start_time`, `end_time`, `category`, `is_overnight`, `is_active`, `created_at`) VALUES
(1, 'Regular', '08:00:00', '17:00:00', 'regular', 0, 1, '2026-11-04 14:34:15'),
(2, 'Shift 1', '06:00:00', '14:00:00', 'shifting', 0, 1, '2026-11-04 14:34:15'),
(3, 'Shift 2', '14:00:00', '22:00:00', 'shifting', 0, 1, '2026-11-04 14:34:15'),
(4, 'Shift 3', '22:00:00', '06:00:00', 'shifting', 1, 1, '2026-11-04 14:34:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_attendance_employee_date` (`employee_id`,`attendance_date`),
  ADD KEY `fk_attendance_shift` (`shift_id`),
  ADD KEY `fk_attendance_reviewer` (`reviewed_by`),
  ADD KEY `idx_attendances_date` (`attendance_date`),
  ADD KEY `idx_attendances_employee_date` (`employee_id`,`attendance_date`),
  ADD KEY `idx_attendances_status` (`status`),
  ADD KEY `idx_attendances_pending_review` (`review_status`,`attendance_date`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employee_code_unique` (`employee_code`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `fk_employees_position` (`position_id`),
  ADD KEY `idx_employees_department` (`department_id`),
  ADD KEY `idx_employees_status` (`employee_status`),
  ADD KEY `fk_employees_supervisor` (`supervisor_id`);

--
-- Indexes for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_leave_balance_employee_type_year` (`employee_id`,`leave_type_id`,`year`),
  ADD KEY `fk_leave_balances_type` (`leave_type_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_leave_requests_type` (`leave_type_id`),
  ADD KEY `fk_leave_requests_approver` (`approved_by`),
  ADD KEY `idx_leave_requests_employee` (`employee_id`,`status`),
  ADD KEY `idx_leave_requests_dates` (`start_date`,`end_date`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leave_types_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_positions_department_name` (`department_id`,`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_employee_id_unique` (`employee_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `work_shifts`
--
ALTER TABLE `work_shifts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `work_shifts_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_balances`
--
ALTER TABLE `leave_balances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `work_shifts`
--
ALTER TABLE `work_shifts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `fk_attendance_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_attendance_reviewer` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_attendance_shift` FOREIGN KEY (`shift_id`) REFERENCES `work_shifts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employees_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_employees_position` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_employees_supervisor` FOREIGN KEY (`supervisor_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD CONSTRAINT `fk_leave_balances_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_leave_balances_type` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `fk_leave_requests_approver` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_leave_requests_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_leave_requests_type` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `fk_positions_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
