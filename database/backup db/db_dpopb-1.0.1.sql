-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 03:36 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dpopb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_administrator`
--

CREATE TABLE `tb_administrator` (
  `id_administrator` bigint(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_perhitungan`
--

CREATE TABLE `tb_detail_perhitungan` (
  `id_detail_perhitungan` bigint(20) NOT NULL,
  `id_perhitungan` bigint(20) NOT NULL,
  `iterasi` int(11) NOT NULL DEFAULT 1,
  `bobot_awal` longtext NOT NULL,
  `euclidean_distance` longtext NOT NULL,
  `bobot_akhir` longtext NOT NULL,
  `hasil_akhir` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pariwisata`
--

CREATE TABLE `tb_pariwisata` (
  `id_pariwisata` bigint(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `objek_wisata` varchar(100) NOT NULL,
  `wisnus` double NOT NULL,
  `wisman` double NOT NULL,
  `sarana_prasarana` double NOT NULL,
  `daya_tarik` double NOT NULL,
  `ditambahkan_oleh` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pariwisata`
--

INSERT INTO `tb_pariwisata` (`id_pariwisata`, `tahun`, `objek_wisata`, `wisnus`, `wisman`, `sarana_prasarana`, `daya_tarik`, `ditambahkan_oleh`) VALUES
(1, 2019, 'Wisata Pantai Bentar', 92528, 1119, 0.59, 3, NULL),
(2, 2019, 'Wisata Gunung Bromo', 149865, 20329, 1.07, 3, NULL),
(3, 2019, 'Wisata Tirta Ronggojalu', 3458, 0, 0.78, 2, NULL),
(4, 2019, 'Wisata Air Terjun Madakaripura', 24812, 3750, 0.64, 1, NULL),
(5, 2019, 'Wisata Ranu Segaran', 2855, 39, 0.66, 2, NULL),
(6, 2019, 'Wisata Ranu Agung', 2909, 0, 0.84, 1, NULL),
(7, 2019, 'Wisata Miniatur Ka\'bah', 20798, 1, 0.96, 1, NULL),
(8, 2019, 'Wisata Rafting Sungai Pekalen', 23223, 2233, 0.93, 2, NULL),
(9, 2019, 'Wisata Candi Jabung ', 45367, 572, 0.83, 1, NULL),
(10, 2019, 'Wisata Candi Kedaton', 3297, 107, 0.81, 1, NULL),
(11, 2019, 'Wisata Pemandian Jabung Tirta ', 43469, 39, 0.7, 1, NULL),
(12, 2019, 'Wisata Agro Kebun Teh Andung biru', 9152, 29, 0.45, 1, NULL),
(13, 2019, 'Wisata Agro Sumberbendo', 24785, 7, 0.9, 2, NULL),
(14, 2019, 'Wisata Pantai Duta', 71589, 95, 0.93, 1, NULL),
(15, 2019, 'Wisata Agro Strawberry', 122584, 10417, 0.71, 2, NULL),
(16, 2019, 'Wisata Pantai Tambaksari', 7108, 219, 0.9, 1, NULL),
(17, 2019, 'Wisata Air Terjun Umbulan', 449, 280, 0.87, 1, NULL),
(18, 2019, 'Wisata Gili Ketapang', 1086, 39, 1.07, 1, NULL),
(19, 2019, 'Wisata Tirto Ageng', 12512, 27, 0.83, 1, NULL),
(20, 2019, 'Wisata Hapy Waterboom', 48075, 0, 0.83, 1, NULL),
(21, 2019, 'Wisata Waterboom Ayu Rezeki Kerpangan', 108140, 0, 0.68, 2, NULL),
(22, 2019, 'Wisata Binor Harmony ', 38556, 1312, 0.82, 1, NULL),
(23, 2019, 'Wisata Pantai Bahak', 26706, 29, 0.83, 1, NULL),
(24, 2019, 'Wisata Bukit Kembang Puncaksari', 2913, 2, 0.84, 1, NULL),
(25, 2019, 'Wisata Tubing Desa Sentul', 4806, 23, 0.38, 1, NULL),
(26, 2019, 'Wisata Tubing Desa Gading Wetan', 1188, 16, 0.38, 1, NULL),
(27, 2019, 'Wisata Tubing Tiris', 2610, 0, 0.38, 1, NULL),
(28, 2019, 'Wisata Air Terjun Dewi Rengganis', 15961, 601, 1.09, 1, NULL),
(29, 2019, 'Wisata Air Terjun Kali Pedati', 8803, 200, 0.77, 1, NULL),
(30, 2019, 'Wisata Pantai Tugu ', 9310, 0, 0.88, 2, NULL),
(31, 2019, 'Wisata Madakaripura Forest Park', 5864, 1166, 0.58, 2, NULL),
(32, 2019, 'Wisata Dewi Sekar Anteng Greed Park', 8223, 226, 0.64, 1, NULL),
(33, 2019, 'Wisata Mahagoni Greed Park', 5357, 1, 1.3, 1, NULL),
(34, 2019, 'Wisata Petik Buah Sumberasih', 19946, 126, 0.71, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perhitungan`
--

CREATE TABLE `tb_perhitungan` (
  `id_perhitungan` bigint(20) NOT NULL,
  `tanggal_perhitungan` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_olah` longtext NOT NULL,
  `normalisasi` longtext NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_cluster` int(11) NOT NULL DEFAULT 3,
  `learning_rate` double NOT NULL,
  `jumlah_iterasi` int(11) NOT NULL,
  `ditambahkan_oleh` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_perhitungan`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_perhitungan` (
`id_detail_perhitungan` bigint(20)
,`id_perhitungan` bigint(20)
,`tanggal_perhitungan` timestamp
,`data_olah` longtext
,`normalisasi` longtext
,`tahun` year(4)
,`jumlah_cluster` int(11)
,`learning_rate` double
,`jumlah_iterasi` int(11)
,`id_administrator` bigint(20)
,`nama_lengkap` varchar(50)
,`username` varchar(30)
,`kata_sandi` varchar(255)
,`iterasi` int(11)
,`bobot_awal` longtext
,`euclidean_distance` longtext
,`bobot_akhir` longtext
,`hasil_akhir` longtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_perhitungan`
-- (See below for the actual view)
--
CREATE TABLE `v_perhitungan` (
`id_perhitungan` bigint(20)
,`tanggal_perhitungan` timestamp
,`data_olah` longtext
,`normalisasi` longtext
,`tahun` year(4)
,`jumlah_cluster` int(11)
,`learning_rate` double
,`jumlah_iterasi` int(11)
,`id_administrator` bigint(20)
,`nama_lengkap` varchar(50)
,`username` varchar(30)
,`kata_sandi` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `v_detail_perhitungan`
--
DROP TABLE IF EXISTS `v_detail_perhitungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_perhitungan`  AS SELECT `dp`.`id_detail_perhitungan` AS `id_detail_perhitungan`, `vp`.`id_perhitungan` AS `id_perhitungan`, `vp`.`tanggal_perhitungan` AS `tanggal_perhitungan`, `vp`.`data_olah` AS `data_olah`, `vp`.`normalisasi` AS `normalisasi`, `vp`.`tahun` AS `tahun`, `vp`.`jumlah_cluster` AS `jumlah_cluster`, `vp`.`learning_rate` AS `learning_rate`, `vp`.`jumlah_iterasi` AS `jumlah_iterasi`, `vp`.`id_administrator` AS `id_administrator`, `vp`.`nama_lengkap` AS `nama_lengkap`, `vp`.`username` AS `username`, `vp`.`kata_sandi` AS `kata_sandi`, `dp`.`iterasi` AS `iterasi`, `dp`.`bobot_awal` AS `bobot_awal`, `dp`.`euclidean_distance` AS `euclidean_distance`, `dp`.`bobot_akhir` AS `bobot_akhir`, `dp`.`hasil_akhir` AS `hasil_akhir` FROM (`tb_detail_perhitungan` `dp` join `v_perhitungan` `vp`) WHERE `dp`.`id_perhitungan` = `vp`.`id_perhitungan` ;

-- --------------------------------------------------------

--
-- Structure for view `v_perhitungan`
--
DROP TABLE IF EXISTS `v_perhitungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_perhitungan`  AS SELECT `p`.`id_perhitungan` AS `id_perhitungan`, `p`.`tanggal_perhitungan` AS `tanggal_perhitungan`, `p`.`data_olah` AS `data_olah`, `p`.`normalisasi` AS `normalisasi`, `p`.`tahun` AS `tahun`, `p`.`jumlah_cluster` AS `jumlah_cluster`, `p`.`learning_rate` AS `learning_rate`, `p`.`jumlah_iterasi` AS `jumlah_iterasi`, `a`.`id_administrator` AS `id_administrator`, `a`.`nama_lengkap` AS `nama_lengkap`, `a`.`username` AS `username`, `a`.`kata_sandi` AS `kata_sandi` FROM (`tb_perhitungan` `p` join `tb_administrator` `a`) WHERE `p`.`ditambahkan_oleh` = `a`.`id_administrator` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_administrator`
--
ALTER TABLE `tb_administrator`
  ADD PRIMARY KEY (`id_administrator`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_detail_perhitungan`
--
ALTER TABLE `tb_detail_perhitungan`
  ADD PRIMARY KEY (`id_detail_perhitungan`),
  ADD KEY `id_perhitungan` (`id_perhitungan`);

--
-- Indexes for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  ADD PRIMARY KEY (`id_pariwisata`),
  ADD KEY `ditambahkan_oleh` (`ditambahkan_oleh`);

--
-- Indexes for table `tb_perhitungan`
--
ALTER TABLE `tb_perhitungan`
  ADD PRIMARY KEY (`id_perhitungan`),
  ADD KEY `ditambahkan_oleh` (`ditambahkan_oleh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_administrator`
--
ALTER TABLE `tb_administrator`
  MODIFY `id_administrator` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_detail_perhitungan`
--
ALTER TABLE `tb_detail_perhitungan`
  MODIFY `id_detail_perhitungan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  MODIFY `id_pariwisata` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_perhitungan`
--
ALTER TABLE `tb_perhitungan`
  MODIFY `id_perhitungan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_perhitungan`
--
ALTER TABLE `tb_detail_perhitungan`
  ADD CONSTRAINT `tb_detail_perhitungan_ibfk_1` FOREIGN KEY (`id_perhitungan`) REFERENCES `tb_perhitungan` (`id_perhitungan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  ADD CONSTRAINT `tb_pariwisata_ibfk_1` FOREIGN KEY (`ditambahkan_oleh`) REFERENCES `tb_administrator` (`id_administrator`) ON DELETE SET NULL;

--
-- Constraints for table `tb_perhitungan`
--
ALTER TABLE `tb_perhitungan`
  ADD CONSTRAINT `tb_perhitungan_ibfk_1` FOREIGN KEY (`ditambahkan_oleh`) REFERENCES `tb_administrator` (`id_administrator`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
