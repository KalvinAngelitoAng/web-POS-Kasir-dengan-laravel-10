-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 07:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_02_28_022959_barang', 1),
(4, '2023_02_28_023014_jenis_barang', 1),
(5, '2023_02_28_023054_transaksi', 1),
(6, '2023_02_28_023102_detail_transaksi', 1),
(7, '2023_02_28_023726_diskon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `id_jenis`, `nama_barang`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(2, 2, 'Kinder Joy', 10000, 78, '2023-03-04 01:14:33', '2023-03-07 19:54:31'),
(3, 2, 'Chitato', 15000, 90, '2023-03-04 01:14:51', '2023-03-06 01:58:33'),
(4, 3, 'Tamiya', 20000, 7, '2023-03-04 01:15:20', '2023-03-07 19:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_transaksi`
--

CREATE TABLE `tbl_detail_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_detail_transaksi`
--

INSERT INTO `tbl_detail_transaksi` (`id`, `no_transaksi`, `id_barang`, `qty`, `created_at`, `updated_at`) VALUES
(8, 'NT-001', 2, 2, '2023-03-06 01:58:33', '2023-03-06 01:58:33'),
(9, 'NT-001', 3, 10, '2023-03-06 01:58:33', '2023-03-06 01:58:33'),
(10, 'NT-002', 2, 15, '2023-03-06 20:40:28', '2023-03-06 20:40:28'),
(11, 'NT-002', 4, 2, '2023-03-06 20:40:28', '2023-03-06 20:40:28'),
(12, 'NT-003', 2, 5, '2023-03-07 19:54:31', '2023-03-07 19:54:31'),
(13, 'NT-003', 4, 2, '2023-03-07 19:54:31', '2023-03-07 19:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diskon`
--

CREATE TABLE `tbl_diskon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_belanja` bigint(20) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_diskon`
--

INSERT INTO `tbl_diskon` (`id`, `total_belanja`, `diskon`, `created_at`, `updated_at`) VALUES
(1, 100000, 10, NULL, '2023-03-04 01:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_barang`
--

CREATE TABLE `tbl_jenis_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jenis_barang`
--

INSERT INTO `tbl_jenis_barang` (`id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(2, 'Makanan', '2023-03-02 19:28:54', '2023-03-02 19:28:54'),
(3, 'Mainan', '2023-03-02 19:29:02', '2023-03-02 19:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `subtotal` bigint(20) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `kembalian` bigint(20) DEFAULT NULL,
  `uang_pembeli` bigint(20) DEFAULT NULL,
  `total_bayar` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `no_transaksi`, `tgl_transaksi`, `subtotal`, `diskon`, `kembalian`, `uang_pembeli`, `total_bayar`, `created_at`, `updated_at`) VALUES
(5, 'NT-001', '2023-03-06', 170000, 17000, 47000, 200000, 153000, '2023-03-06 01:58:33', '2023-03-06 01:58:33'),
(6, 'NT-002', '2023-03-07', 190000, 19000, 29000, 200000, 171000, '2023-03-06 20:40:28', '2023-03-06 20:40:28'),
(7, 'NT-003', '2023-03-08', 90000, 0, 10000, 100000, 90000, '2023-03-07 19:54:31', '2023-03-07 19:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$L0ZoAiRO6u9/m9V/OwaMb.m/84ZCjO3MwdxvXPJmGIIXnA2leO/Ia', 'admin', NULL, '2023-03-07 08:08:10'),
(2, 'kasir', 'kasir@gmail.com', '$2y$10$l.ZS2TJvJOrXe3QWtpzxq.m/8vY08sZXs36INgGODu6EcNn4EjHbq', 'kasir', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_diskon`
--
ALTER TABLE `tbl_diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_diskon`
--
ALTER TABLE `tbl_diskon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
