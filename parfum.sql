-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2025 at 11:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parfum`
--

-- --------------------------------------------------------

--
-- Table structure for table `parfum`
--

CREATE TABLE `parfum` (
  `id` int NOT NULL,
  `kode_parfum` varchar(10) NOT NULL,
  `nama_parfum` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parfum`
--

INSERT INTO `parfum` (`id`, `kode_parfum`, `nama_parfum`, `merk`, `harga`, `foto`, `stock`) VALUES
(1, 'PRF001', 'Chanel No. 5', 'Chanel', 1500000, '67a31b24db726_chanel no 5.jpg', 6),
(2, 'PRF002', 'Dior Sauvage', 'Dior', 1450000, '67a31d8f88474_Dior Sauvage.jpg', 7),
(3, 'PRF003', 'Acqua di Gio', 'Giorgio Armani', 1200000, '67a31d9a2d24d_Acqua di Gio.jpg', 8),
(4, 'PRF004', 'Eros', 'Versace', 1100000, '67a31da656bad_Versace Eros.jpeg', 9),
(5, 'PRF005', 'Bleu de Chanel', 'Chanel', 1550000, '67a31db1a724e_Bleu de Chanel.jpg', 7),
(6, 'PRF006', 'Light Blue', 'Dolce & Gabbana', 1000000, '67a31dc245e01_Dolce & Gabbana Light BLue.jpg', 10),
(7, 'PRF007', 'La Vie Est Belle', 'Lancôme', 1250000, '67a31de0a15fc_La Vie Est Belle.jpg', 10),
(8, 'PRF008', 'Black Opium', 'Yves Saint Laurent', 1400000, '67a31deaf03e7_ysl black opium.jpg', 8),
(9, 'PRF009', 'Flowerbomb', 'Viktor & Rolf', 1450000, '67a31df5895d6_Viktor & Rolf Flowerbomb.jpg', 10),
(10, 'PRF010', 'Good Girl blush', 'Carolina Herrera', 1350000, '67a31e00784c9_CH Good girl Blush.jpg', 8),
(11, 'PRF011', 'Fahrenheit', 'Dior', 1300000, '67a31e0b7f2f4_Dior Fahrenheit.jpg', 10),
(12, 'PRF012', 'The One', 'Dolce & Gabbana', 1150000, '67a31e197e945_Dolce & Gabbana the One.jpg', 10),
(13, 'PRF013', 'Gucci Bloom', 'Gucci', 1400000, '67a31e34045c2_gucci bloom.jpg', 10),
(14, 'PRF014', 'L\'Homme', 'Yves Saint Laurent', 1300000, '67a31e3d546c3_ysl L\'Homme.jpg', 10),
(15, 'PRF015', 'Invictus', 'Paco Rabanne', 1200000, '67a31e48d7df7_PR Invictus.jpg', 9),
(16, 'PRF016', 'Olympéa', 'Paco Rabanne', 1250000, '67a31e5310d99_PR Olympea.jpg', 10),
(17, 'PRF017', '212 VIP Men', 'Carolina Herrera', 1100000, '67a31e6e408a7_CH 212 VIP men.jpg', 10),
(18, 'PRF018', '1 Million', 'Paco Rabanne', 1350000, '67a31e5ec52c6_PR 1 Mil.jpg', 10),
(19, 'PRF019', 'Miss Dior', 'Dior', 1450000, '67a31e776000f_Miss dior.jpg', 10),
(20, 'PRF020', 'Y', 'Yves Saint Laurent', 1500000, '67a31e24f1adb_ysl y.jpeg', 7),
(21, 'PRF021', 'Supremacy Not Only Intense', 'AFNAN', 625000, '67a31e8123f41_snoi.jpg', 8),
(22, 'PRF022', 'Sharaf Blend', 'Zimaya', 325000, '67a31e8a52ce8_ziamaya SB.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int NOT NULL,
  `kode_pembeli` varchar(10) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id`, `kode_pembeli`, `nama_pembeli`, `jk`, `alamat`, `telepon`) VALUES
(1, 'PB001', 'Revan Fazry Huda', 'L', 'Cirebon', '081234567890'),
(2, 'PB002', 'Teppu Chimi', 'P', 'Bandung', '081345678901'),
(3, 'PB003', 'Sule', 'L', 'Surabaya', '081456789012'),
(4, 'PB004', 'Ayu Lestari', 'P', 'Yogyakarta', '081567890123'),
(5, 'PB005', 'Rizky Ramadhan', 'L', 'Medan', '081678901234'),
(6, 'PB006', 'J A N E', 'P', 'Denpasar', '081789012345'),
(7, 'PB007', 'Bottoms', 'L', 'Papua', '081890123456'),
(8, 'PB008', 'Rina Marlina', 'P', 'Semarang', '081901234567'),
(9, 'PB009', 'Fajar Nugraha', 'L', 'Palembang', '081234567890'),
(10, 'PB010', 'Lia Kartika', 'P', 'Malang', '081345678901'),
(11, 'PB011', 'Fransiska', 'P', 'Cirebon', '0852613312'),
(12, 'PB012', 'Rina', 'P', 'Banjar', '083521756721');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `kode_beli` varchar(10) NOT NULL,
  `kode_pembeli` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `dibeli` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_beli`, `kode_pembeli`, `tanggal_transaksi`, `dibeli`) VALUES
(1, 'FQCBS1KLOE', 'PB001', '2025-01-01', 1),
(2, 'PWD2RTJZIU', 'PB002', '2025-01-05', 1),
(3, 'O17LJ2ZZR8', 'PB006', '2025-01-04', 1),
(4, '2YD7I95Z3S', 'PB007', '2025-01-10', 1),
(7, 'MIR0HP7876', 'PB011', '2025-01-01', 0),
(15, 'YJ5A2OWJ1P', 'PB003', '2025-02-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksidetail`
--

CREATE TABLE `transaksidetail` (
  `id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `kode_parfum` varchar(20) NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksidetail`
--

INSERT INTO `transaksidetail` (`id`, `transaksi_id`, `kode_parfum`, `jumlah`) VALUES
(1, 1, 'PRF018', 1),
(2, 1, 'PRF020', 1),
(3, 2, 'PRF004', 1),
(4, 2, 'PRF010', 1),
(5, 3, 'PRF001', 1),
(6, 3, 'PRF001', 1),
(7, 3, 'PRF010', 1),
(8, 3, 'PRF015', 1),
(11, 4, 'PRF002', 3),
(12, 7, 'PRF003', 2),
(13, 7, 'PRF001', 1),
(14, 7, 'PRF018', 3),
(17, 15, 'PRF005', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','karyawan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `role`) VALUES
(5, 'FLuticaL', 'Revan', '$2y$10$GqorMdeqZv5bt.d/YrsiVu0./ugYVThBVXBzMRDDwUWf.Vg1TL6XS', 'admin'),
(6, 'bot', 'norman', '$2y$10$4OvQTvJnU.ZlFRkurP83HOPp9kkPDs9cLEMCXNZm3khrLOSa2TraC', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parfum`
--
ALTER TABLE `parfum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_parfum` (`kode_parfum`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pembeli` (`kode_pembeli`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_beli` (`kode_beli`),
  ADD KEY `transaksi_ibfk_1` (`kode_pembeli`);

--
-- Indexes for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksidetail_ibfk_1` (`kode_parfum`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parfum`
--
ALTER TABLE `parfum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_pembeli`) REFERENCES `pembeli` (`kode_pembeli`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksidetail`
--
ALTER TABLE `transaksidetail`
  ADD CONSTRAINT `transaksidetail_ibfk_1` FOREIGN KEY (`kode_parfum`) REFERENCES `parfum` (`kode_parfum`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaksidetail_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
