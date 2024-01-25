-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 12:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes_kazee`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getnip` (`init` VARCHAR(1)) RETURNS VARCHAR(25) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
	DECLARE fkdcount varchar(30);
  DECLARE lasturut int(11);
  DECLARE furut int(11);
	DECLARE sthn varchar(5);
	
	SET furut = (SELECT
    IF(count = 9999999, 1, count + 1) AS count
  FROM m_counter
  WHERE nmcounter = 'nip');
	
	UPDATE m_counter
  SET count = furut
  WHERE nmcounter = 'nip';
	
	SET sthn = (SELECT DATE_FORMAT(NOW(),'%y%m'));
	
  SET fkdcount = (SELECT
        CASE
          WHEN count BETWEEN 0 AND 9 THEN CONCAT(init, sthn, '000000', count)
          WHEN count BETWEEN 10 AND 99 THEN CONCAT(init, sthn, '00000', count)
          WHEN count BETWEEN 100 AND 999 THEN CONCAT(init, sthn, '0000', count)
          WHEN count BETWEEN 1000 AND 9999 THEN CONCAT(init, sthn, '000', count)
          WHEN count BETWEEN 10000 AND 99999 THEN CONCAT(init, sthn, '00', count)
          WHEN count BETWEEN 100000 AND 999999 THEN CONCAT(init, sthn, '0', count)
					ELSE CONCAT(init, sthn, count)
        END AS fkdcount
  FROM m_counter
  WHERE nmcounter = 'nip');
	
RETURN fkdcount;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `get_iddept` (`init` VARCHAR(2)) RETURNS VARCHAR(25) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
	DECLARE fkdcount varchar(30);
  DECLARE lasturut int(11);
  DECLARE furut int(11);
	DECLARE sthn varchar(5);
	
	SET furut = (SELECT
    IF(count = 9999999, 1, count + 1) AS count
  FROM m_counter
  WHERE nmcounter = 'dept');
	
	UPDATE m_counter
  SET count = furut
  WHERE nmcounter = 'dept';
	
	SET sthn = (SELECT DATE_FORMAT(NOW(),'%y%m'));
	
  SET fkdcount = (SELECT
        CASE
          WHEN count BETWEEN 0 AND 9 THEN CONCAT(init, sthn, '000000', count)
          WHEN count BETWEEN 10 AND 99 THEN CONCAT(init, sthn, '00000', count)
          WHEN count BETWEEN 100 AND 999 THEN CONCAT(init, sthn, '0000', count)
          WHEN count BETWEEN 1000 AND 9999 THEN CONCAT(init, sthn, '000', count)
          WHEN count BETWEEN 10000 AND 99999 THEN CONCAT(init, sthn, '00', count)
          WHEN count BETWEEN 100000 AND 999999 THEN CONCAT(init, sthn, '0', count)
					ELSE CONCAT(init, sthn, count)
        END AS fkdcount
  FROM m_counter
  WHERE nmcounter = 'dept');
	
RETURN fkdcount;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `get_jabatan` (`init` VARCHAR(2)) RETURNS VARCHAR(25) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
	DECLARE fkdcount varchar(30);
  DECLARE lasturut int(11);
  DECLARE furut int(11);
	DECLARE sthn varchar(5);
	
	SET furut = (SELECT
    IF(count = 9999999, 1, count + 1) AS count
  FROM m_counter
  WHERE nmcounter = 'jabatan');
	
	UPDATE m_counter
  SET count = furut
  WHERE nmcounter = 'jabatan';
	
	SET sthn = (SELECT DATE_FORMAT(NOW(),'%y%m'));
	
  SET fkdcount = (SELECT
        CASE
          WHEN count BETWEEN 0 AND 9 THEN CONCAT(init, sthn, '000000', count)
          WHEN count BETWEEN 10 AND 99 THEN CONCAT(init, sthn, '00000', count)
          WHEN count BETWEEN 100 AND 999 THEN CONCAT(init, sthn, '0000', count)
          WHEN count BETWEEN 1000 AND 9999 THEN CONCAT(init, sthn, '000', count)
          WHEN count BETWEEN 10000 AND 99999 THEN CONCAT(init, sthn, '00', count)
          WHEN count BETWEEN 100000 AND 999999 THEN CONCAT(init, sthn, '0', count)
					ELSE CONCAT(init, sthn, count)
        END AS fkdcount
  FROM m_counter
  WHERE nmcounter = 'jabatan');
	
RETURN fkdcount;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `get_status` (`init` VARCHAR(2)) RETURNS VARCHAR(25) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
	DECLARE fkdcount varchar(30);
  DECLARE lasturut int(11);
  DECLARE furut int(11);
	DECLARE sthn varchar(5);
	
	SET furut = (SELECT
    IF(count = 9999999, 1, count + 1) AS count
  FROM m_counter
  WHERE nmcounter = 'status');
	
	UPDATE m_counter
  SET count = furut
  WHERE nmcounter = 'status';
	
	SET sthn = (SELECT DATE_FORMAT(NOW(),'%y%m'));
	
  SET fkdcount = (SELECT
        CASE
          WHEN count BETWEEN 0 AND 9 THEN CONCAT(init, sthn, '000000', count)
          WHEN count BETWEEN 10 AND 99 THEN CONCAT(init, sthn, '00000', count)
          WHEN count BETWEEN 100 AND 999 THEN CONCAT(init, sthn, '0000', count)
          WHEN count BETWEEN 1000 AND 9999 THEN CONCAT(init, sthn, '000', count)
          WHEN count BETWEEN 10000 AND 99999 THEN CONCAT(init, sthn, '00', count)
          WHEN count BETWEEN 100000 AND 999999 THEN CONCAT(init, sthn, '0', count)
					ELSE CONCAT(init, sthn, count)
        END AS fkdcount
  FROM m_counter
  WHERE nmcounter = 'status');
	
RETURN fkdcount;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_employee`
--

CREATE TABLE `log_employee` (
  `id` int(11) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `idactivity` varchar(10) NOT NULL,
  `timelog` datetime DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_employee`
--

INSERT INTO `log_employee` (`id`, `nip`, `idactivity`, `timelog`, `ket`) VALUES
(1, 'ADMIN', 'LA001', '2024-01-25 04:14:39', 'A24010000001'),
(4, 'ADMIN', 'LA002', '2024-01-25 04:48:23', 'A24010000001'),
(5, 'ADMIN', 'LA001', '2024-01-25 04:53:15', 'A24010000002'),
(6, 'ADMIN', 'LA003', '2024-01-25 04:54:06', 'A24010000002'),
(7, 'admin', 'LA004', '2024-01-25 19:47:13', ''),
(8, 'admin', 'LA004', '2024-01-25 20:13:57', ''),
(9, 'admin', 'LA004', '2024-01-25 20:14:17', ''),
(10, 'admin', 'LA004', '2024-01-25 20:42:04', ''),
(11, '0', 'LA001', '2024-01-25 23:33:06', 'A24010000003'),
(12, 'admin', 'LA004', '2024-01-25 23:35:00', ''),
(13, 'admin', 'LA004', '2024-01-25 23:48:40', ''),
(14, 'admin', 'LA004', '2024-01-25 23:49:14', ''),
(15, 'admin', 'LA003', '2024-01-26 00:15:02', 'A24010000003'),
(16, 'admin', 'LA001', '2024-01-26 00:16:28', 'A24010000004'),
(17, 'admin', 'LA002', '2024-01-26 01:07:20', 'A24010000004'),
(18, 'admin', 'LA002', '2024-01-26 01:13:16', 'A24010000004'),
(19, 'A24010000001', 'LA005', '2024-01-26 01:25:46', 'IT'),
(20, 'admin', 'LA005', '2024-01-26 03:26:10', 'Finance'),
(21, 'admin', 'LA005', '2024-01-26 03:27:06', 'General Affair'),
(22, 'admin', 'LA005', '2024-01-26 03:28:06', 'Human Resources'),
(23, 'admin', 'LA005', '2024-01-26 03:29:18', 'Accounting'),
(24, 'admin', 'LA006', '2024-01-26 03:38:33', 'KONTRAK'),
(25, 'admin', 'LA006', '2024-01-26 03:39:56', 'PART TIME'),
(26, 'admin', 'LA005', '2024-01-26 05:25:48', 'Marketing'),
(27, 'admin', 'LA006', '2024-01-26 05:26:02', 'KONTRAK'),
(28, 'admin', 'LA007', '2024-01-26 05:32:31', 'Fullstack Developer'),
(29, 'admin', 'LA002', '2024-01-26 05:34:49', 'A24010000004'),
(30, 'admin', 'LA007', '2024-01-26 06:03:20', 'Staff HR'),
(31, 'admin', 'LA001', '2024-01-26 06:04:14', 'A24010000005'),
(32, 'A24010000005', 'LA004', '2024-01-26 06:08:56', ''),
(33, 'admin', 'LA004', '2024-01-26 06:09:17', '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_activity_log`
--

CREATE TABLE `m_activity_log` (
  `idactivity` varchar(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nuxticon` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_activity_log`
--

INSERT INTO `m_activity_log` (`idactivity`, `nama`, `nuxticon`, `color`) VALUES
('LA001', 'Tambah Pegawai', 'material-symbols:person-add', '#006f37'),
('LA002', 'Edit Karyawan', 'material-symbols:person-edit', '#f48139'),
('LA003', 'Hapus Karyawan', 'material-symbols:person-remove', '#CC1A0B'),
('LA004', 'Akses Manajemen Karyawan', 'ic:baseline-log-in', '#3F4E4F'),
('LA005', 'Tambah Departemen', 'mdi:file-document-plus', '#006f37'),
('LA006', 'Tambah Status', 'mdi:file-document-plus', '#006f37'),
('LA007', 'Tambah Jabatan', 'mdi:file-document-plus', '#006f37');

-- --------------------------------------------------------

--
-- Table structure for table `m_counter`
--

CREATE TABLE `m_counter` (
  `nmcounter` varchar(25) NOT NULL,
  `count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_counter`
--

INSERT INTO `m_counter` (`nmcounter`, `count`) VALUES
('dept', 7),
('jabatan', 3),
('nip', 5),
('status', 4);

-- --------------------------------------------------------

--
-- Table structure for table `m_departemen`
--

CREATE TABLE `m_departemen` (
  `id_dept` varchar(20) NOT NULL,
  `namadept` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_departemen`
--

INSERT INTO `m_departemen` (`id_dept`, `namadept`) VALUES
('DP24010000001', 'ADMIN'),
('DP24010000002', 'IT'),
('DP24010000003', 'Finance'),
('DP24010000004', 'General Affair'),
('DP24010000005', 'Human Resources'),
('DP24010000006', 'Accounting'),
('DP24010000007', 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `m_employee`
--

CREATE TABLE `m_employee` (
  `nip` varchar(25) NOT NULL,
  `nmlengkap` varchar(75) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `tmplahir` varchar(50) DEFAULT NULL,
  `jnskelamin` varchar(10) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(25) DEFAULT NULL,
  `tglbekerja` date DEFAULT NULL,
  `tglakhirkontrak` date DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `dept` varchar(25) DEFAULT NULL,
  `jabatan` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `statusmenikah` varchar(10) DEFAULT NULL,
  `addby` varchar(25) DEFAULT NULL,
  `addat` datetime DEFAULT NULL,
  `lastupdateby` varchar(25) DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_employee`
--

INSERT INTO `m_employee` (`nip`, `nmlengkap`, `tgllahir`, `tmplahir`, `jnskelamin`, `alamat`, `telepon`, `tglbekerja`, `tglakhirkontrak`, `status`, `dept`, `jabatan`, `email`, `agama`, `statusmenikah`, `addby`, `addat`, `lastupdateby`, `updateat`, `password`) VALUES
('A24010000001', 'ADMIN2', '2024-01-25', 'Bandung', 'PRIA', '-', '12345678990', '2024-01-25', NULL, 'ST24010000001', 'DP24010000001', 'JB24010000001', 'admin@admin.aa', 'Islam', 'Belum', 'ADMIN', '2024-01-25 04:14:39', 'ADMIN', '2024-01-25 04:48:23', '$2y$12$.5gtGwg./TLUiyeNE3TjvOBEjKY.sP5h3bwbB86tUae369fNNpIPe'),
('A24010000004', 'Tubagus Rahman Ramadan', '2024-01-26', 'Bandung', 'PRIA', 'Komp. Taman Raflesia No. E46', '082116822007', '2024-01-26', NULL, 'ST24010000001', 'DP24010000002', 'JB24010000002', 'tubagusrahmanr@gmail.com', 'Islam', 'Belum', 'admin', '2024-01-26 00:16:28', 'admin', '2024-01-26 05:34:49', '$2y$12$2bNsfmpE874hK9xL.d3fcO9BjoWo33ODH0yyftEy.7WcEo7tpioVC'),
('A24010000005', 'Rama', '1998-01-08', 'Bandung', 'PRIA', 'Komp. Taman Raflesia No. E46', '082116822007', '2024-01-26', NULL, 'ST24010000001', 'DP24010000005', 'JB24010000003', 'tbrama98@gmail.com', 'Islam', 'belum', 'admin', '2024-01-26 06:04:14', 'admin', '2024-01-26 06:04:14', '$2y$12$AfE3/.iuoBYLTA/gb0fI2.vo9MhKm9REqRZKw977xrL2LaSPh2QEG'),
('admin', 'SUPER ADMIN', '2024-01-25', 'Bandung', 'PRIA', '-', '12345678990', '2024-01-25', NULL, 'ST24010000001', 'DP24010000001', 'JB24010000001', 'admin@admin.aa', 'Islam', 'Belum', 'ADMIN', '2024-01-25 03:23:29', 'ADMIN', '2024-01-25 03:23:29', '$2y$12$iqW/D9KmA6tAKIjIj57cx.aZGKe59JYgNkPp.hqGKo4iexQkRVpva');

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE `m_jabatan` (
  `idjabatan` varchar(25) NOT NULL,
  `iddept` varchar(25) NOT NULL,
  `namajabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`idjabatan`, `iddept`, `namajabatan`) VALUES
('JB24010000001', 'DP24010000001', 'ADMIN'),
('JB24010000002', 'DP24010000002', 'Fullstack Developer'),
('JB24010000003', 'DP24010000005', 'Staff HR');

-- --------------------------------------------------------

--
-- Table structure for table `m_status`
--

CREATE TABLE `m_status` (
  `idstatus` varchar(25) NOT NULL,
  `namastatus` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_status`
--

INSERT INTO `m_status` (`idstatus`, `namastatus`) VALUES
('ST24010000001', 'TETAP'),
('ST24010000003', 'PART TIME'),
('ST24010000004', 'KONTRAK');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(7, 'App\\Models\\User', 0, 'auth-token', 'e6006af8176a7abd033831de9778e6ed05d60bd79178d7d205aa2287288de4f8', '[\"*\"]', NULL, NULL, '2024-01-25 09:48:40', '2024-01-25 09:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `log_employee`
--
ALTER TABLE `log_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_activity_log`
--
ALTER TABLE `m_activity_log`
  ADD PRIMARY KEY (`idactivity`);

--
-- Indexes for table `m_counter`
--
ALTER TABLE `m_counter`
  ADD PRIMARY KEY (`nmcounter`);

--
-- Indexes for table `m_departemen`
--
ALTER TABLE `m_departemen`
  ADD PRIMARY KEY (`id_dept`) USING BTREE;

--
-- Indexes for table `m_employee`
--
ALTER TABLE `m_employee`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `m_status`
--
ALTER TABLE `m_status`
  ADD PRIMARY KEY (`idstatus`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_employee`
--
ALTER TABLE `log_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
