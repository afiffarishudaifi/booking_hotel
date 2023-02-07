-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2023 at 10:30 AM
-- Server version: 10.5.18-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silw8338_db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `file` varchar(150) NOT NULL,
  `level` enum('Admin','Super Admin') DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`, `nama_lengkap`, `no_hp`, `alamat`, `file`, `level`) VALUES
(1, 'admin@gmail.com', 'oabQK3rFK6UJLjilP97ciJujhT6ihgAA+dmxNZ2qYw47gD2gjTBvXMMpVWNy/msD9C7dPKdeFQ/uu6EORA3YCOi1bUEfHOqvOB+VXJVap6WcaaPS7JA=', 'Angga Prastiko', '087541365210', 'Jalan Raya Magetan Sarangan No. 8, Ngerong', 'docs/img/img_pengguna/1657636627_787b30d1072bfaf73450.jpg', 'Admin'),
(2, 'superadmin@gmail.com', 'aS5nommbB6nCoZYNm+cUF4/5XSDOU1Lx8Xw91ynSN9hmuhHmBDwHM2OQ5238GoqPUu3h4MR7hFM2nNlL+nfwu5bs29jBifIJbmLuxir8yVzciR000+4=', 'Hotel Purbaya', '087541365210', 'Jalan Raya Magetan Sarangan No. 8, Ngerong', 'docs/img/img_pengguna/1657636389_0e58dd4e06423425442e.jpg', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kamar`
--

CREATE TABLE `detail_kamar` (
  `id_detail` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_kamar`
--

INSERT INTO `detail_kamar` (`id_detail`, `id_kamar`, `id_fasilitas`) VALUES
(22, 10, 2),
(23, 10, 5),
(24, 10, 9),
(25, 11, 5),
(26, 11, 2),
(27, 11, 9),
(28, 12, 2),
(29, 12, 5),
(30, 12, 9),
(31, 13, 5),
(32, 13, 2),
(33, 13, 9),
(34, 14, 2),
(35, 14, 5),
(36, 14, 9),
(37, 15, 2),
(38, 15, 5),
(39, 15, 9),
(40, 16, 2),
(41, 16, 5),
(42, 16, 9),
(43, 17, 2),
(44, 17, 5),
(45, 17, 9),
(46, 18, 2),
(47, 18, 4),
(48, 18, 6),
(49, 18, 7),
(50, 18, 9),
(51, 18, 3),
(52, 19, 2),
(53, 19, 3),
(54, 19, 4),
(55, 19, 6),
(56, 19, 7),
(57, 19, 9),
(58, 20, 2),
(59, 20, 3),
(60, 20, 4),
(61, 20, 6),
(62, 20, 7),
(63, 20, 9),
(64, 21, 2),
(65, 21, 3),
(66, 21, 4),
(67, 21, 6),
(68, 21, 7),
(69, 21, 9),
(70, 23, 2),
(71, 23, 4),
(72, 23, 6),
(73, 23, 7),
(74, 23, 9),
(75, 22, 2),
(76, 22, 4),
(77, 22, 6),
(78, 22, 7),
(79, 22, 9),
(80, 24, 2),
(81, 24, 4),
(82, 24, 6),
(83, 24, 7),
(84, 24, 9),
(85, 25, 2),
(86, 25, 4),
(87, 25, 6),
(88, 25, 7),
(89, 25, 9),
(90, 26, 2),
(91, 26, 4),
(92, 26, 6),
(93, 26, 7),
(94, 26, 9),
(95, 27, 2),
(96, 27, 4),
(97, 27, 6),
(98, 27, 7),
(99, 27, 9),
(100, 28, 2),
(101, 28, 4),
(102, 28, 6),
(103, 28, 7),
(104, 28, 9);

-- --------------------------------------------------------

--
-- Table structure for table `detail_keranjang_pengunjung`
--

CREATE TABLE `detail_keranjang_pengunjung` (
  `id_detail_keranjang` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL DEFAULT 'Laki - Laki'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_keranjang_pengunjung`
--

INSERT INTO `detail_keranjang_pengunjung` (`id_detail_keranjang`, `id_keranjang`, `nama`, `jenis_kelamin`) VALUES
(9, 43, 'suci', 'Perempuan'),
(10, 43, 'alda', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `total_biaya` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail`, `id_pemesanan`, `id_kamar`, `tanggal_masuk`, `tanggal_keluar`, `total_biaya`) VALUES
(25, 25, 15, '2022-07-13', '2022-07-14', 75000),
(26, 26, 11, '2022-07-13', '2022-07-28', 1125000),
(27, 27, 10, '2022-07-15', '2022-07-20', 375000),
(28, 28, 16, '2022-07-22', '2022-07-24', 150000),
(29, 29, 19, '2022-07-20', '2022-07-21', 110000),
(30, 30, 12, '2022-07-20', '2022-07-21', 75000),
(31, 31, 10, '2022-07-20', '2022-07-21', 75000),
(32, 32, 10, '2022-07-15', '2022-07-17', 150000),
(33, 32, 10, '2022-09-02', '2022-09-05', 225000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengunjung_kamar`
--

CREATE TABLE `detail_pengunjung_kamar` (
  `id_pengunjung_kamar` int(11) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL DEFAULT 'Laki - Laki'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pengunjung_kamar`
--

INSERT INTO `detail_pengunjung_kamar` (`id_pengunjung_kamar`, `id_detail`, `nama`, `jenis_kelamin`) VALUES
(6, 25, 'raya', 'Laki - Laki'),
(7, 25, 'silla', 'Perempuan'),
(8, 26, 'cd', 'Laki - Laki'),
(9, 27, 'Dita', 'Perempuan'),
(10, 27, 'Suci', 'Perempuan'),
(11, 28, 'dita', 'Laki - Laki'),
(12, 28, 'alda', 'Laki - Laki'),
(13, 29, 'dita', 'Laki - Laki'),
(14, 29, 'alda', 'Laki - Laki'),
(15, 29, 'resi', 'Laki - Laki'),
(16, 30, 'dita', 'Laki - Laki'),
(17, 30, 'alda', 'Laki - Laki'),
(18, 31, 'dita', 'Laki - Laki'),
(19, 31, 'alda', 'Laki - Laki'),
(20, 32, 'suct', 'Perempuan'),
(21, 32, 'dita', 'Laki - Laki'),
(22, 32, 'suci', 'Perempuan'),
(23, 32, 'silla', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`) VALUES
(1, 'Mushola'),
(2, 'Kamar Mandi Dalam'),
(3, 'Air Panas'),
(4, 'Double Bad'),
(5, 'Single Bed'),
(6, 'Ruang Tamu'),
(7, 'Lemari'),
(8, 'Meja'),
(9, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `nama_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id_foto`, `id_kamar`, `nama_foto`) VALUES
(12, 10, 'docs/img/img_kamar/1657464893_ee1bc9f3f51aff889dfd.jpeg'),
(13, 10, 'docs/img/img_kamar/1657464908_b30f0e09fbcb7e2158de.jpeg'),
(14, 11, 'docs/img/img_kamar/1657464993_cb0f0e3a3cb08f34ca0e.jpeg'),
(15, 11, 'docs/img/img_kamar/1657465005_2e630b2c0dc10ad92097.jpeg'),
(16, 12, 'docs/img/img_kamar/1657465056_474ebf437a0d3af71b6c.jpeg'),
(17, 12, 'docs/img/img_kamar/1657465068_173abb34b8209e2d255e.jpeg'),
(18, 13, 'docs/img/img_kamar/1657465106_3411547f8f98497ee175.jpeg'),
(19, 13, 'docs/img/img_kamar/1657465118_f7be77757a38d6b7215b.jpeg'),
(20, 14, 'docs/img/img_kamar/1657465227_2b2f21982538963edbfc.jpeg'),
(21, 14, 'docs/img/img_kamar/1657465237_a5ed1e1652c721bb80d1.jpeg'),
(22, 15, 'docs/img/img_kamar/1657465254_fa9c358dcc8a7ac16092.jpeg'),
(23, 15, 'docs/img/img_kamar/1657465262_550398648bfd1074fb73.jpeg'),
(24, 16, 'docs/img/img_kamar/1657465281_deba906e1d63eaee3830.jpeg'),
(25, 16, 'docs/img/img_kamar/1657465292_d10184a305679144451c.jpeg'),
(26, 17, 'docs/img/img_kamar/1657465322_8aa5015ca97085bc343e.jpeg'),
(27, 17, 'docs/img/img_kamar/1657465331_e510b7bb321e8ec81826.jpeg'),
(28, 18, 'docs/img/img_kamar/1657469828_7dbec68788e2188df2fa.jpeg'),
(29, 18, 'docs/img/img_kamar/1657469841_8aa1f07b881e04cd9fc2.jpeg'),
(30, 18, 'docs/img/img_kamar/1657469851_1007a3b696377e373592.jpeg'),
(31, 19, 'docs/img/img_kamar/1657469937_5122dc5c7d86554931af.jpeg'),
(32, 19, 'docs/img/img_kamar/1657469946_2645af1327cb45c712bb.jpeg'),
(33, 19, 'docs/img/img_kamar/1657469957_fd5234295f1c5a0b31d1.jpeg'),
(34, 20, 'docs/img/img_kamar/1657470060_19e628d17f69d34969be.jpeg'),
(35, 20, 'docs/img/img_kamar/1657470069_c4c3d754750b22665a50.jpeg'),
(36, 20, 'docs/img/img_kamar/1657470081_e83c5143b71f263b3aba.jpeg'),
(37, 21, 'docs/img/img_kamar/1657470345_31e8bfd1ff6749291ba4.jpeg'),
(38, 21, 'docs/img/img_kamar/1657470358_c1def65ec13fe146a552.jpeg'),
(39, 21, 'docs/img/img_kamar/1657470367_a6226689ccf953177228.jpeg'),
(40, 22, 'docs/img/img_kamar/1657595741_d1b3fdbd8ab63cfdac87.jpeg'),
(41, 22, 'docs/img/img_kamar/1657595741_5d66925e2bcc79eea71e.jpeg'),
(42, 22, 'docs/img/img_kamar/1657595741_8e7c7100bca3df857675.jpeg'),
(43, 23, 'docs/img/img_kamar/1657595970_5d9a1dd0f812e5d7c852.jpeg'),
(44, 23, 'docs/img/img_kamar/1657595970_5fa832827136c223ec3b.jpeg'),
(45, 23, 'docs/img/img_kamar/1657595970_1828ce71e2d0eaf74c2b.jpeg'),
(46, 24, 'docs/img/img_kamar/1657596133_a7bb10626b561965a6f8.jpeg'),
(47, 24, 'docs/img/img_kamar/1657596133_ce832201e9b56503a411.jpeg'),
(48, 24, 'docs/img/img_kamar/1657596133_501f2e766e902f8beed1.jpeg'),
(49, 25, 'docs/img/img_kamar/1657596162_438d8b5321552b41d7cc.jpeg'),
(50, 25, 'docs/img/img_kamar/1657596162_59e9036fac42883e3298.jpeg'),
(51, 25, 'docs/img/img_kamar/1657596162_95d71d3d38f7b6270326.jpeg'),
(52, 26, 'docs/img/img_kamar/1657596186_ee964187d1a55b6d751a.jpeg'),
(53, 26, 'docs/img/img_kamar/1657596186_88f8d4b6ce5304369dbc.jpeg'),
(54, 26, 'docs/img/img_kamar/1657596186_88b90a3802aa2cb287ca.jpeg'),
(55, 27, 'docs/img/img_kamar/1657596205_b71311bde5e94f30ea9a.jpeg'),
(56, 27, 'docs/img/img_kamar/1657596205_024299d7f2e2ccc02c0d.jpeg'),
(57, 27, 'docs/img/img_kamar/1657596205_e67565c1fcdb5bf718a2.jpeg'),
(58, 28, 'docs/img/img_kamar/1657596226_3f60cc88fec2ec9aa368.jpeg'),
(59, 28, 'docs/img/img_kamar/1657596226_03006a7b51582156b065.jpeg'),
(60, 28, 'docs/img/img_kamar/1657596226_498542d1e93fd05ebbb3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_kamar` varchar(20) NOT NULL,
  `status_kamar` enum('terisi','kosong') NOT NULL,
  `biaya` int(11) NOT NULL,
  `isi` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_kategori`, `nama_kamar`, `status_kamar`, `biaya`, `isi`) VALUES
(10, 3, 'Mawar 01', 'terisi', 75000, 2),
(11, 3, 'Mawar 02', 'terisi', 75000, 2),
(12, 3, 'Mawar 03', 'kosong', 75000, 2),
(13, 3, 'Mawar 04', 'kosong', 75000, 2),
(14, 3, 'Mawar 05', 'kosong', 75000, 2),
(15, 3, 'Mawar 06', 'kosong', 75000, 2),
(16, 3, 'Mawar 07', 'terisi', 75000, 2),
(17, 3, 'Mawar 08', 'kosong', 75000, 2),
(18, 1, 'Tulip 01', 'kosong', 110000, 4),
(19, 1, 'Tulip 02', 'kosong', 110000, 4),
(20, 1, 'Tulip 03', 'kosong', 110000, 4),
(21, 1, 'Tulip 04', 'kosong', 110000, 4),
(22, 2, 'Anggrek 01', 'kosong', 95000, 4),
(23, 2, 'Anggrek 02', 'kosong', 95000, 4),
(24, 2, 'Anggrek 03', 'kosong', 95000, 4),
(25, 2, 'Anggrek 04', 'kosong', 95000, 4),
(26, 2, 'Anggrek 05', 'kosong', 95000, 4),
(27, 2, 'Anggrek 06', 'kosong', 95000, 4),
(28, 2, 'Anggrek 07', 'kosong', 95000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kamar`
--

CREATE TABLE `kategori_kamar` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_kamar`
--

INSERT INTO `kategori_kamar` (`id_kategori`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Tulip', 'Kamar tipe tulip sangat cocok untuk bermalam dengan keluarga. Dengan adanya 2 kasur yang cukup untuk 4 orang dan adanya ruang tamu yang cukup nyaman untuk mengobrol santai.'),
(2, 'Anggrek', 'Kamar tipe tulip sangat cocok untuk bermalam dengan keluarga. Dengan adanya 2 kasur yang cukup untuk 4 orang dan adanya ruang tamu yang cukup nyaman untuk mengobrol santai.'),
(3, 'Mawar', 'Kamar tipe mawar sangat cocok untuk bermalam dengan kerabat, saudara maupun pasangan. Karena kamar yang sangat simple membuat suasanan lebih nyaman.');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pengguna`, `id_kamar`, `tanggal_masuk`, `tanggal_keluar`, `total_biaya`) VALUES
(37, 4, 2, '2022-07-07', '2022-07-10', 420000),
(38, 5, 1, '2022-07-10', '2022-07-11', 15000),
(39, 5, 1, '2022-07-09', '2022-07-10', 15000),
(40, 5, 1, '2022-07-09', '2022-07-10', 15000),
(41, 5, 1, '2022-07-09', '2022-07-10', 15000),
(42, 5, 1, '2022-07-09', '2022-07-10', 15000),
(43, 5, 1, '2022-07-09', '2022-07-10', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `tanggal_pesan` datetime NOT NULL DEFAULT current_timestamp(),
  `status_pemesanan` enum('pengajuan','terkonfirmasi','selesai','batal') NOT NULL DEFAULT 'pengajuan',
  `bukti_transaksi` varchar(255) DEFAULT NULL,
  `alasan_ditolak` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pengguna`, `id_admin`, `tanggal_pesan`, `status_pemesanan`, `bukti_transaksi`, `alasan_ditolak`, `created_at`, `updated_at`) VALUES
(12, 1, 1, '2022-04-08 04:22:53', 'selesai', '1649562357_028babbdad8754006650.png', NULL, '2022-04-08 04:22:53', '0000-00-00 00:00:00'),
(13, 1, NULL, '2022-04-10 20:35:16', 'selesai', '1655297940_d7a65180c8e69c323359.png', NULL, '2022-04-08 04:53:16', '0000-00-00 00:00:00'),
(14, 1, NULL, '2022-04-10 20:42:08', 'selesai', '1655298340_1ec5be7e841e9ef93073.png', NULL, '2022-04-11 20:37:08', '0000-00-00 00:00:00'),
(24, 1, 1, '2022-06-22 19:50:18', 'selesai', '1656126605_7d2f3a0b1c174706dd10.png', NULL, '2022-06-22 19:50:18', '0000-00-00 00:00:00'),
(25, 4, 1, '2022-07-12 21:52:51', 'selesai', '1657637589_fd2469db68f5126f1e2a.jpg', NULL, '2022-07-12 21:52:51', '0000-00-00 00:00:00'),
(26, 6, 1, '2022-07-13 20:04:19', 'terkonfirmasi', '1657717474_6c664c09e28172e6a879.png', NULL, '2022-07-13 20:04:19', '0000-00-00 00:00:00'),
(27, 9, 1, '2022-07-14 08:44:30', 'selesai', '1657763091_5fd9d2d7d09fdb7fd548.jpg', NULL, '2022-07-14 08:44:30', '0000-00-00 00:00:00'),
(28, 4, 1, '2022-07-20 10:15:48', 'terkonfirmasi', '1658286983_133a5478489a7a9b0321.jpg', NULL, '2022-07-20 10:15:48', '0000-00-00 00:00:00'),
(29, 4, 1, '2022-07-20 10:18:39', 'selesai', '1658287146_a50a1bc3c51cccf6486f.jpg', NULL, '2022-07-20 10:18:39', '0000-00-00 00:00:00'),
(30, 4, 1, '2022-07-20 10:23:13', 'selesai', '1658287408_2e458c8520fde7f1133a.jpg', NULL, '2022-07-20 10:23:13', '0000-00-00 00:00:00'),
(31, 4, 1, '2022-07-20 10:26:36', 'selesai', '1658287610_37e1ced66914d65d7605.jpg', NULL, '2022-07-20 10:26:36', '0000-00-00 00:00:00'),
(32, 9, NULL, '2022-09-01 14:17:02', 'pengajuan', '1662016652_5859375f04474c03c1de.jpg', NULL, '2022-09-01 14:17:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengguna` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `oauth_id` varchar(50) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengguna`, `nik`, `oauth_id`, `email`, `password`, `nama_lengkap`, `no_hp`, `alamat`, `file`) VALUES
(1, '2147483647156455', '108858565960947332249', 'afiffaris5@gmail.com', '8zlGXi3aMWRNWt0LpGooND6wGc1G+angUdd+/0tbbr4CANwBpYsQfbvNot0t6FGzlpFlcujFD7kPxRijU/TESJkHwbYkw8/wHiN/P1mvpE5eCER4', 'Riskisalsabila', '089696628993', 'Jl Manggis No 09 Kota Madiun', 'docs/img/img_pengguna/1657596554_3d2b61fda3e2dcf2e1fd.jpg'),
(4, '7129181234672398', '114673811513484165131', 'ti.sillaaguirisia21@gmail.com', 'T262jPEdToQJTowz2YbEmyF8/KYODPTI7aIzN2QFJCBflI7JOWsZcGlScbwpJRIchNdCR13fEF1OwI7aN5UD3cL8BUeCHCJtZ7q0sqHJBdMMmn9jg/81btQ=', 'Silla', '+62 857-0438', 'madiun', 'docs/img/img_pengguna/1657186823_7f7810892ae275f58836.jpg'),
(5, '7129181234672398', '108305728223971999958', 'affryanaasilla@gmail.com', 'AIy59NMKv/OW3j7BDVa7IK9nErK/To7O3mXxZAdxLm6mCznymtmMMFANA6SmAfyCA37sZhEHT1Zc3hOTrgEe25Ri7ssT/sHAPpoI11POlVay9ng6F07Ovo8=', 'Silla', '+62 857-0438', 'madiun', 'docs/img/img_pengguna/1657349189_63ceaecc25d527c141bf.jpg'),
(6, '3544321113345421', '112025113164647996636', 'bagusferakunpnm@gmail.com', 'cfS4wzjYYuBaLL7Dx8+BBaDdABqkktn6yRbx7GkfbCeDX3dLSSzkmVFoRdAXHpaY8AMP+ecaYJc/1uJ6ZlgcIbk5odg71AKJMo90RipH9hihLQQcrAtwtQ==', 'bagus fer', '085316266123', 'madiun', 'docs/img/img_pengguna/1657715517_1ca71c0d04c84869f6f4.png'),
(7, NULL, '110029624089301641352', 'lesehanti@gmail.com', NULL, 'TI A 19 PNM', '0', NULL, 'n'),
(8, NULL, '107636569757289391218', 'agsaturichperfumery@gmail.com', NULL, 'Rich Perfumery', '0', NULL, 'n'),
(9, '7129181234672398', '111611876636042937004', 'aguirisiaaffryana@gmail.com', 'M7G2+xqA57BhO6KepfIUzZlzFNIJKIbx/NrQhuUs+xShlSKqoC+m5AP+b43ZH1wTP97rPRSbVhXNLPeIx0mouR2UnbkYRNjF9xXBOAlvU00dHz7tVjQ=', 'Silla Affryana', '085704388646', 'Jalan Diponegoro', 'docs/img/img_pengguna/1657762825_4e5c4f8463e0b7acb330.jpg'),
(10, NULL, '109297984699412223841', 'rakyat.jenaka@gmail.com', NULL, 'Rakyat Jenaka', '0', NULL, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `id_tempat` int(11) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL,
  `url_tempat` text NOT NULL,
  `alamat_tempat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jarak_tempat` int(11) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(35) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`id_tempat`, `nama_tempat`, `url_tempat`, `alamat_tempat`, `deskripsi`, `jarak_tempat`, `latitude`, `longitude`, `foto`) VALUES
(1, 'Telaga Sarangan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.065901477894!2d111.21649861436543!3d-7.676064678110807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798f2c571a4e9d%3A0x2f4b63b059521d69!2sTELAGA%20SARANGAN!5e0!3m2!1sen!2sid!4v1649572111229!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Ngluweng, Sarangan, Kec. Plaosan, Kabupaten Magetan, Jawa Timur', 'Telaga Sarangan, juga dikenal sebagai Telaga Pasir adalah telaga alami yang berada di ketinggian 1.200 meter di atas permukaan laut dan terletak di lereng Gunung Lawu,Kecamatan Plaosan, Kabupaten Magetan, Jawa Timur.[1] Telaga ini berjarak sekitar 16 kilometer arah barat Kota Magetan. Telaga ini luasnya sekitar 30 hektare dan berkedalaman 28 meter.Dengan suhu udara antara 15 hingga 20 derajat Celsius. Telaga Sarangan mampu menarik ratusan ribu pengunjung setiap tahunnya. Telaga Sarangan adalah objek wisata andalan Kabupaten Magetan Di sekeliling telaga terdapat dua hotel berbintang, 43 hotel kelas melati, dan 18 pondok wisata.Di samping puluhan kios cendera mata,pengunjung dapat pula menikmati indahnya Sarangan dengan berkuda mengitari telaga,atau mengendarai kapal cepat.Fasilitas objek wisata lainnya pun tersedia,misalnya rumah makan, tempat bermain,pasar wisata,tempat parkir,tempat ibadah,dan taman', 9, '-7.676179847383224', '111.21764925397356', '1649571392_de76f07a1d1212c430bd.jpg'),
(2, 'Wana Wisata Mojosemi', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1712113846907!2d111.21481291436527!3d-7.66473437797718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798c23c6af2dc3%3A0x169bacd2d0435b63!2sMojosemi%20Forest%20Park!5e0!3m2!1sen!2sid!4v1649572141742!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Kali Jumok, Sarangan, Kec. Plaosan, Kabupaten Magetan, Jawa Timur 63361', 'Mojosemi Forest Park adalah tempat wisata yang berada di tengah hutan pinus di kaki Gunung Lawu. Jika berkunjung kes sana dengan aman dan nyaman, Manager marketing Mojosemi Forest Park memiliki sejumlah tips yang bisa dilakukan oleh calon wisatawan', 10, '-7.664625745313563', '111.21723745899641', '1649571240_07bb7e43b741184b7a7b.jpg'),
(3, 'Tawangmangu Wonder Park', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126534.92450508477!2d111.07471896015281!3d-7.659868416679603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798ba0b4d3877d%3A0x5d05f4a0f42e5c16!2sTAWANGMANGU%20WONDER%20PARK!5e0!3m2!1sid!2sid!4v1657633463813!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Ombang- Ombang, Blumbang, Kec. Tawangmangu, Kabupaten Karanganyar, Jawa Tengah 57792', 'Tempat wisata ini memiliki berbagai atraksi wahana untuk orang dewasa dan anak-anak, dimulai dari berkemah, outbound, ATV, berkuda, hingga berpetualang dengan mobil jeep. ', 13, '-7.659299906652361', '111.14361294909645', '1657599677_bdef43500ba412e3e5e3.jpg'),
(4, 'The Lawu Park', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1722534586866!2d111.17419141432502!3d-7.664622177975749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798befd2ff9b77%3A0x9291d0fee671d8d2!2sTHE%20LAWU%20PARK!5e0!3m2!1sid!2sid!4v1657633788054!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Bulakrejo, Gondosuli Kidul, Gondosuli, Kec. Tawangmangu, Kabupaten Karanganyar, Jawa Tengah 57792', 'Tempat wisata yang satu ini termasuk salah satu wisata sekitar Telaga Sarangan yang sangat direkomendasikan untuk didatangi. Dapat mengunjunginya di daerah Bulakrejo, Gondosuli, Kecamatan Tawangmangu, Kabupaten Karanganyar, Jawa Tengah. Pengunjung akan dimanjakan dengan suasana yang masih sangat alami serta berbagai aktivitas menarik yang dapat dicoba. Bagi Anda pecinta foto, kawasan ini juga menawarkan spot-spot keren yang menjadi favorit wisatawan. Anda juga dapat memilih untuk bermalam di cottage yang telah disediakan. ', 8, '-7.663505894764239', '111.17625075103847', '1657633967_e5a252a41ea0fe6f456b.jpg'),
(5, 'Taman Ria Balekambang', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1888066555007!2d111.130804014011!3d-7.662839677954006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798b16cbdbff41%3A0xd3117fda1e9d2ebf!2sBalekambang%20Tawangmangu!5e0!3m2!1sid!2sid!4v1657634217510!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Jalan Raya Tawangmangu, Kalisoro, Tawangmangu, Solo, Kalisoro, Kec. Tawangmangu, Kabupaten Karanganyar, Jawa Tengah 57792', 'Tempat wisata ini menawarkan keindahan berbagai landmark dari belahan dunia. Kalau kamu suka berswafoto, kawasan ini cocok untuk kamu karena kamu bisa memilih berbagai spot foto yang keren. Di tempat ini, kamu akan merasa seperti sedang berkeliling dunia. Ketika pertama kali memasuki area wisata, kamu akan langsung disambut patung dinosaurus raksasa yang pasti akan disukai anak-anak. Setelah melewati pintu masuk, kamu akan berjumpa dengan berbagai tumbuhan segar yang menghiasi sepanjang jalan area wisata tersebut. Kemudian pada bagian sebelah kanan pintu masuk, ada 3D art studio yang bisa kamu gunakan sebagai spot berfoto ria.', 14, '-7.660874848734861', '111.13171889524274', '1657634449_443985788c373fdbbd72.jpg'),
(6, 'Bukit Sekipan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.14377672436!2d111.141941114011!3d-7.667687678011126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798bd3783bcc9b%3A0xbc0e2cd5cef346e7!2sWisata%20Bukit%20Sekipan%20Tawangmangu!5e0!3m2!1sid!2sid!4v1657634639535!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Jl. Sekipan, Kramat, Kalisoro, Kec. Tawangmangu, Kabupaten Karanganyar, Jawa Tengah 57792', 'Objek wisata Bukit Sekipan tergolong dalam kawasan wisata terpadu karena banyak fasilitas dan wahana permainan yang disuguhkan untuk pengunjung. Di sini, kamu bisa menikmati berbagai macam permainan seperti outbond dan wahana permainan air pada mini waterboom. Ditambah lagi, di area waterboom sudah disediakan aneka permainan air yang sangat menyenangkan. Selain itu, ada pula rumah halloween yang sangat menantang. Untuk yang memiliki anak, jangan khawatir karena ada area playground yang memang dikhususkan bagi anak-anak di bawah umur. Dijamin anak-anak akan sangat terhibur saat berkunjung ke Bukit Sekipan.', 13, '-7.664107291337447', '111.14345365040137', '1657634781_35d7aaac5f724cd36f29.jpg'),
(7, 'Sakura Hills', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31633.09116018178!2d111.17952676962199!3d-7.66848211409508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798baf7f592723%3A0x5a5e7108d86b523!2sSakura%20Hills!5e0!3m2!1sid!2sid!4v1657634844719!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Jl. Raya Matesih-Tawangmangu No.16, Gondosuli Kidul, Tawangmangu, Kec. Tawangmangu, Kabupaten Karanganyar, Jawa Tengah 57792', 'Sakura Hills adalah  satu satunya objek wisata dengan konsep ala Jepang di Tawangmangu. Tempat wisata ini baru diresmikan pada akhir tahun 2019 dan seketika namanya langsung melejit di kalangan muda-mudi Tawangmangu.\r\n\r\nDi sini, kamu akan menemukan bunga sakura, bangunan khas Jepang, hingga pakaian kimono yang bisa disewa untuk berfoto ria. Cocok untuk kamu yang menyukai kultur Jepang', 10, '-7.664271470713149', '111.18527742581732', '1657634988_131d5d5e8368bb40a65d.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indexes for table `detail_keranjang_pengunjung`
--
ALTER TABLE `detail_keranjang_pengunjung`
  ADD PRIMARY KEY (`id_detail_keranjang`),
  ADD KEY `id_keranjang` (`id_keranjang`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `detail_pengunjung_kamar`
--
ALTER TABLE `detail_pengunjung_kamar`
  ADD PRIMARY KEY (`id_pengunjung_kamar`),
  ADD KEY `id_detail_pemesanan` (`id_detail`),
  ADD KEY `id_detail` (`id_detail`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `detail_keranjang_pengunjung`
--
ALTER TABLE `detail_keranjang_pengunjung`
  MODIFY `id_detail_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `detail_pengunjung_kamar`
--
ALTER TABLE `detail_pengunjung_kamar`
  MODIFY `id_pengunjung_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_kamar`
--
ALTER TABLE `detail_kamar`
  ADD CONSTRAINT `detail_kamar_ibfk_1` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_kamar_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_keranjang_pengunjung`
--
ALTER TABLE `detail_keranjang_pengunjung`
  ADD CONSTRAINT `detail_keranjang_pengunjung_ibfk_1` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id_keranjang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_3` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pengunjung_kamar`
--
ALTER TABLE `detail_pengunjung_kamar`
  ADD CONSTRAINT `detail_pengunjung_kamar_ibfk_1` FOREIGN KEY (`id_detail`) REFERENCES `detail_pemesanan` (`id_detail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kamar` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengunjung` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
