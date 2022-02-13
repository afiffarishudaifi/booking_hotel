-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2022 at 07:26 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_kamar`
--

CREATE TABLE `detail_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_kamar`
--

INSERT INTO `detail_kamar` (`id`, `id_kamar`, `id_fasilitas`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(7, 3, 2),
(5, 4, 1),
(4, 4, 2),
(9, 6, 5),
(8, 6, 6),
(11, 7, 5),
(10, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`) VALUES
(1, 'Meeting Room'),
(2, 'Kolam Renang Umum'),
(3, 'Masjid'),
(5, 'Kamar Mandi Dalam'),
(6, 'AC'),
(7, 'Kipas Angin');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `nama_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `id_kamar`, `nama_foto`) VALUES
(11, 1, 'docs/img/img_kamar/1636549681_8448b307f87fa41b316c.jpg'),
(12, 1, 'docs/img/img_kamar/1636549734_85d705fed4c056a07025.jpg'),
(13, 1, 'docs/img/img_kamar/1636549752_f6f5f5280bb9297b3925.jpg'),
(14, 1, 'docs/img/img_kamar/1636549764_019d2c6a2ebe5536051e.jpg'),
(15, 2, 'docs/img/img_kamar/1636634002_182db8383c5ff36b2c63.jpg'),
(16, 2, 'docs/img/img_kamar/1636634013_82ed93684bbc9062ac6a.jpg'),
(17, 2, 'docs/img/img_kamar/1636634025_306d4d4ed10a8ea4cbd0.jpg'),
(18, 4, 'docs/img/img_kamar/1636863268_bebf8bc5dfc98079d4c5.jpg'),
(19, 4, 'docs/img/img_kamar/1636863277_693355c2206fa3b0fdca.jpg'),
(20, 3, 'docs/img/img_kamar/1636863315_a89ba7731e6c4d217af6.jpg'),
(21, 3, 'docs/img/img_kamar/1636863304_a47275af96e85548adf0.jpg'),
(22, 6, 'docs/img/img_kamar/1636863828_37b03bd08e5f38a6ee08.jpg'),
(23, 6, 'docs/img/img_kamar/1636863874_b95993fcee45bc526e61.jpg'),
(24, 7, 'docs/img/img_kamar/1636863888_a7692f1241a76d8b8b6e.jpg'),
(25, 7, 'docs/img/img_kamar/1636863896_45c51ec15d3ae96f56b2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `foto_tempat`
--

CREATE TABLE `foto_tempat` (
  `id_foto` int(11) NOT NULL,
  `id_tempat` int(11) NOT NULL,
  `nama_foto` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `status_kamar` enum('terisi','kosong') NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `id_kategori`, `nama_kamar`, `status_kamar`, `biaya`) VALUES
(1, 1, 'Melati 1', 'terisi', 50000),
(2, 2, 'mawar 2', 'terisi', 130000),
(3, 1, 'Melati 2', 'kosong', 50000),
(4, 2, 'Mawar 1', 'kosong', 130000),
(6, 2, 'Mawar 3', 'kosong', 50000),
(7, 1, 'Melati 3', 'kosong', 130000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kamar`
--

CREATE TABLE `kategori_kamar` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_kamar`
--

INSERT INTO `kategori_kamar` (`id`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Melati', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'Mawar', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(4, 'Matahari 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(5, 'Mawar 3', 'memiliki banyak sekali kamar ya');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `tanggal_pesan` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `status_pemesanan` enum('pengajuan','terkonfirmasi','selesai') NOT NULL,
  `total_biaya` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pengguna`, `id_kamar`, `tanggal_pesan`, `tanggal_masuk`, `tanggal_keluar`, `status_pemesanan`, `total_biaya`) VALUES
(8, 11, 1, '2021-11-03 19:38:37', '2021-11-02 19:38:00', '2021-11-04 20:18:00', 'selesai', 50000),
(9, 11, 2, '2021-11-04 17:14:52', '2021-11-02 17:14:00', '2021-11-11 17:14:00', 'selesai', 1430000),
(10, 12, 1, '2021-11-09 20:55:20', '2021-11-09 20:55:00', '2021-11-11 19:26:00', 'selesai', 100000),
(11, 12, 1, '2021-11-11 19:34:42', '2021-11-11 19:34:00', '2021-11-11 19:36:00', 'selesai', 0),
(12, 12, 1, '2021-11-11 19:37:34', '2021-11-10 19:37:00', '2021-11-11 19:39:00', 'selesai', 50000),
(21, 12, 2, '2021-11-11 20:33:36', '2021-11-10 20:33:00', '2021-11-11 20:36:00', 'selesai', 130000),
(22, 12, 2, '2021-11-11 20:36:08', '2021-11-10 20:35:00', '2021-11-12 20:36:00', 'selesai', 260000),
(23, 12, 1, '2021-11-11 20:37:01', '2021-11-10 20:36:00', '2021-11-11 20:50:00', 'selesai', 100000),
(24, 12, 2, '2021-11-13 12:51:23', '2021-11-12 12:51:00', '2021-11-15 12:51:00', 'selesai', 390000),
(25, 12, 1, '2021-12-04 12:34:50', '2021-12-03 12:34:00', '2021-12-05 12:34:00', 'selesai', 100000),
(26, 12, 1, '2022-02-01 18:15:02', '2022-02-01 18:14:00', '2022-02-05 18:14:00', 'pengajuan', 200000),
(27, 12, 2, '2022-02-02 18:28:03', '2022-02-02 18:27:00', '2022-02-04 18:27:00', 'pengajuan', 260000);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `status` enum('admin','customer') NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama_lengkap`, `email`, `no_hp`, `alamat`, `status`, `file`) VALUES
(11, 'admin', 'hXGw2f3fVao11clVTZ+VFWYbNrjX+pRh1tALZX/gCH1jj6yzveurJ9RZd2ufd4j0ygz49Bq7nUqCiaDmVO7T3BQAlCt5PfyjBre7OL7AYzSdw+lrGtQ=', 'Hotel Purbaya', 'hotelpurbaya@gmail.com', '(0351) 888097', 'Jalan Raya Magetan Sarangan No. 8, Ngerong', 'admin', 'docs/img/img_pengguna/1635172491_f4c522f0fb1448beab9e.jpg'),
(12, 'silla', 'hXGw2f3fVao11clVTZ+VFWYbNrjX+pRh1tALZX/gCH1jj6yzveurJ9RZd2ufd4j0ygz49Bq7nUqCiaDmVO7T3BQAlCt5PfyjBre7OL7AYzSdw+lrGtQ=', 'Silla', 'silla@gmail.com', '+62 857-0438-8646', 'Kota Madiun', 'customer', 'docs/img/img_pengguna/1636185463_90f2756c906d3769b9db.png'),
(13, 'angga', 'rOQSQJ3Z+IWPgRLsUdu5VsrdgRIXabrJwSNczS/E19/s+gPA6bhMTn4lYQUQ5Gg6aFRiZu8P//XThzTes9PFuEUNVxLMvd7pqLsRu5+wnhl3i2/dO3I=', 'angga jaya syaputra', 'angga@gmail.com', '123456789123', 'Kota Kediri', 'customer', 'docs/img/img_pengguna/1636188189_240700350bc099b73617.png');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_lain`
--

CREATE TABLE `tempat_lain` (
  `id_tempat` int(11) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL,
  `alamat_tempat` text NOT NULL,
  `long_tempat` varchar(50) NOT NULL,
  `lat_tempat` varchar(50) NOT NULL,
  `url_tempat` text NOT NULL,
  `deskripsi` text NOT NULL,
  `jarak_tempat` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `total_transaksi` bigint(20) NOT NULL,
  `bukti_transaksi` varchar(100) NOT NULL,
  `status_transaksi` enum('Lunas','Belum Lunas') NOT NULL DEFAULT 'Belum Lunas',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`,`id_fasilitas`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `foto_tempat`
--
ALTER TABLE `foto_tempat`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_tempat` (`id_tempat`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`,`id_kamar`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempat_lain`
--
ALTER TABLE `tempat_lain`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `foto_tempat`
--
ALTER TABLE `foto_tempat`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tempat_lain`
--
ALTER TABLE `tempat_lain`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  ADD CONSTRAINT `detail_kamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`),
  ADD CONSTRAINT `detail_kamar_ibfk_2` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id`);

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`);

--
-- Constraints for table `foto_tempat`
--
ALTER TABLE `foto_tempat`
  ADD CONSTRAINT `foto_tempat_ibfk_1` FOREIGN KEY (`id_tempat`) REFERENCES `tempat_lain` (`id_tempat`);

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kamar` (`id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
