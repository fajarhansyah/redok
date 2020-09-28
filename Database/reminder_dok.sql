-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2020 at 10:18 AM
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
-- Table structure for table `histori_download_dokumen`
--

CREATE TABLE IF NOT EXISTS `histori_download_dokumen` (
  `id` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_download` varchar(225) NOT NULL,
  `kode_unik` varchar(225) NOT NULL,
  `peminta` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_download_dokumen`
--

INSERT INTO `histori_download_dokumen` (`id`, `id_dokumen`, `status`, `keterangan`, `log`, `tanggal_download`, `kode_unik`, `peminta`) VALUES
(1, 2, 'Berhasil', 'Tes tes', '2020-09-24 07:34:45', '09/24/2020', '-', 'Banjarsari');

-- --------------------------------------------------------

--
-- Table structure for table `histori_pembarui_dokumen`
--

CREATE TABLE IF NOT EXISTS `histori_pembarui_dokumen` (
  `id` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_pembarui_dokumen`
--

INSERT INTO `histori_pembarui_dokumen` (`id`, `id_dokumen`, `log`) VALUES
(1, 2, '2020-09-24 07:25:34');

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
  `upload_dokumen` varchar(255) NOT NULL,
  `pengingat` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `id_user`, `nama_dokumen`, `bag_or_keb`, `jenis_dok`, `masa_aktif`, `pic`, `akses_for`, `upload_dokumen`, `pengingat`) VALUES
(1, 1, 'Data Milik Admin', '1', '1', '09/26/2020 - 09/27/2020', 'fajar', '2,3', 'Aplikasi_Reminder_Masa_Aktif1.pdf', 1),
(2, 2, 'Dokumen Milik Tanaman', '2', '2', '10/23/2020 - 10/25/2020', 'Hansyah', '3', 'Aplikasi_Reminder_Masa_Aktif3.pdf', 1);

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
(1, 'STNK', 1, 1, 1),
(2, 'HGU', 1, 1, 1),
(3, 'Ijazah', 1, 1, 1);

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
  `role_id` int(11) NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `role_id`, `no_telp`) VALUES
(1, 'admin', '123', 1, ''),
(2, 'Tanaman', '123', 2, '087865018862'),
(3, 'Banjarsari', '123', 3, '087865018862');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_download_dokumen`
--
ALTER TABLE `histori_download_dokumen`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `histori_download_dokumen`
--
ALTER TABLE `histori_download_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `histori_pembarui_dokumen`
--
ALTER TABLE `histori_pembarui_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
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
