-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 01:24 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reminder_dok`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_pembarui_dokumen`
--

CREATE TABLE IF NOT EXISTS `histori_pembarui_dokumen` (
  `id` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_pembarui_dokumen`
--

INSERT INTO `histori_pembarui_dokumen` (`id`, `id_dokumen`, `status`, `log`) VALUES
(1, 16, 'Request', '2020-09-07 00:45:38'),
(2, 16, 'Ditolak', '2020-09-07 00:45:38'),
(3, 17, 'Request', '2020-09-07 00:45:38'),
(4, 16, '', '2020-09-07 01:24:23'),
(5, 16, '', '2020-09-07 05:12:31'),
(6, 16, '', '2020-09-07 05:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE IF NOT EXISTS `tb_dokumen` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_dokumen` text NOT NULL,
  `bag_or_keb` varchar(255) NOT NULL,
  `jenis_dok` text NOT NULL,
  `masa_aktif` varchar(225) NOT NULL,
  `pic` text NOT NULL,
  `akses_for` text NOT NULL,
  `upload_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `id_user`, `nama_dokumen`, `bag_or_keb`, `jenis_dok`, `masa_aktif`, `pic`, `akses_for`, `upload_dokumen`) VALUES
(16, 2, 'Dokumen Sesuatu', '1', '1', '09/18/2020 - 09/26/2020', 'Fajar', '1', 'API_Input_Produksi_PT_IGG_Input_(3)3.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_bag_keb`
--

CREATE TABLE IF NOT EXISTS `tb_master_bag_keb` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_bag_keb`
--

INSERT INTO `tb_master_bag_keb` (`id`, `nama`, `level`) VALUES
(1, 'Bagian Pengadaan & Umum', '1'),
(2, 'Jatirono', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_jenis_dok`
--

CREATE TABLE IF NOT EXISTS `tb_master_jenis_dok` (
  `id` int(11) NOT NULL,
  `nama_jenis_dokumen` varchar(255) NOT NULL,
  `durasi_tahun` int(11) NOT NULL,
  `durasi_bulan` int(11) DEFAULT NULL,
  `durasi_tgl` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_jenis_dok`
--

INSERT INTO `tb_master_jenis_dok` (`id`, `nama_jenis_dokumen`, `durasi_tahun`, `durasi_bulan`, `durasi_tgl`) VALUES
(1, 'STNK', 2, 2, 2),
(3, 'HGU', 6, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE IF NOT EXISTS `tb_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'Bagian'),
(3, 'Kebun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', '123', 1),
(2, 'Tanaman', '123', 2),
(3, 'Banjarsari', '123', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_pembarui_dokumen`
--
ALTER TABLE `histori_pembarui_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokumen` (`id_dokumen`);

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_master_bag_keb`
--
ALTER TABLE `tb_master_bag_keb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_master_jenis_dok`
--
ALTER TABLE `tb_master_jenis_dok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_pembarui_dokumen`
--
ALTER TABLE `histori_pembarui_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tb_master_bag_keb`
--
ALTER TABLE `tb_master_bag_keb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_master_jenis_dok`
--
ALTER TABLE `tb_master_jenis_dok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
