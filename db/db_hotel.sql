-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 02:24 PM
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
(3, 1, 3);

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
(3, 'Masjid');

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
(14, 1, 'docs/img/img_kamar/1636549764_019d2c6a2ebe5536051e.jpg');

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
(1, 1, 'Melati 1', 'kosong', 50000),
(2, 2, 'mawar 2', 'terisi', 130000);

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
(9, 11, 2, '2021-11-04 17:14:52', '2021-11-02 17:14:00', '2021-11-13 17:14:00', 'terkonfirmasi', 1430000),
(10, 12, 1, '2021-11-09 20:55:20', '2021-11-09 20:55:00', '2021-11-11 20:55:00', 'pengajuan', 100000);

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
(11, 'barulagi@gmail.com', 'hXGw2f3fVao11clVTZ+VFWYbNrjX+pRh1tALZX/gCH1jj6yzveurJ9RZd2ufd4j0ygz49Bq7nUqCiaDmVO7T3BQAlCt5PfyjBre7OL7AYzSdw+lrGtQ=', 'afif', 'afif@gmail.com', '089657489651', 'Jl Jamsaren 2, Kota Kediri, Jawa Timur', 'admin', 'docs/img/img_pengguna/1635172491_f4c522f0fb1448beab9e.jpg'),
(12, 'silla', 'hXGw2f3fVao11clVTZ+VFWYbNrjX+pRh1tALZX/gCH1jj6yzveurJ9RZd2ufd4j0ygz49Bq7nUqCiaDmVO7T3BQAlCt5PfyjBre7OL7AYzSdw+lrGtQ=', 'Silla', 'silla@gmail.com', '089342743823', 'Kota Madiun', 'customer', 'docs/img/img_pengguna/1636185463_90f2756c906d3769b9db.png'),
(13, 'angga', 'rOQSQJ3Z+IWPgRLsUdu5VsrdgRIXabrJwSNczS/E19/s+gPA6bhMTn4lYQUQ5Gg6aFRiZu8P//XThzTes9PFuEUNVxLMvd7pqLsRu5+wnhl3i2/dO3I=', 'angga jaya syaputra', 'angga@gmail.com', '123456789123', 'Kota Kediri', 'customer', 'docs/img/img_pengguna/1636188189_240700350bc099b73617.png');

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  ADD CONSTRAINT `detail_kamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_kamar_ibfk_2` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kamar` (`id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
