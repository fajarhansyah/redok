-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Okt 2020 pada 04.28
-- Versi Server: 5.6.26
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
-- Struktur dari tabel `histori_download_dokumen`
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histori_download_dokumen`
--

INSERT INTO `histori_download_dokumen` (`id`, `id_dokumen`, `status`, `keterangan`, `log`, `tanggal_download`, `kode_unik`, `peminta`) VALUES
(1, 19, 'Ditolak', 'asdas', '2020-10-05 05:50:53', '', '-', 'Tanaman'),
(2, 19, 'Berhasil', 'asdasdsad', '2020-10-05 07:13:45', '10/06/2020', 'EosfR1Fz8mji', 'Tanaman'),
(3, 19, 'Request', 'banjar', '2020-10-05 05:50:01', '', 'pdo29NIKH7nD', 'Banjarsari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_pembarui_dokumen`
--

CREATE TABLE IF NOT EXISTS `histori_pembarui_dokumen` (
  `id` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hkm_dokumen`
--

CREATE TABLE IF NOT EXISTS `hkm_dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `user_upload` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `jenis_dokumen` varchar(20) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `akses_for` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `upload_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hkm_dokumen`
--

INSERT INTO `hkm_dokumen` (`id_dokumen`, `user_upload`, `nama_dokumen`, `jenis_dokumen`, `pic`, `status`, `akses_for`, `tanggal`, `upload_dokumen`) VALUES
(1, 0, 'Dokumen Hukum Tentang Hukum', 'Dokumen Hukum', '', 'Aktif', '0', 'tanggal', ''),
(2, 1, 'STNK MOTOR HONDA111', '1', 'Fajar11', 'Mencabut', '2', '06/10/2020', ''),
(3, 1, 'STNK MOTOR HONDA', '1', 'Fajar', 'Mencabut', '2', '06/10/2020', 'Laporan_Download_(49)2.pdf'),
(4, 1, 'asaa', '1', 'aaaa', 'Dicabut', '2,3', '06/10/2020', 'Laporan_Download_(49)1.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hkm_master_jenis_dokumen`
--

CREATE TABLE IF NOT EXISTS `hkm_master_jenis_dokumen` (
  `id_jenis_dokumen` int(11) NOT NULL,
  `nama_jenis_dokumen` varchar(255) NOT NULL,
  `status_jenis_dokumen` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hkm_master_jenis_dokumen`
--

INSERT INTO `hkm_master_jenis_dokumen` (`id_jenis_dokumen`, `nama_jenis_dokumen`, `status_jenis_dokumen`, `keterangan`) VALUES
(1, 'Dokumen Hukum', 'Aktif1', 'TES1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokumen`
--

CREATE TABLE IF NOT EXISTS `tb_dokumen` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_dokumen` text NOT NULL,
  `bag_or_keb` varchar(255) NOT NULL,
  `jenis_dok` text NOT NULL,
  `masa_aktif_awal` date NOT NULL,
  `masa_aktif_akhir` date NOT NULL,
  `pic` text NOT NULL,
  `akses_for` text NOT NULL,
  `upload_dokumen` varchar(255) NOT NULL,
  `pengingat` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id`, `id_user`, `nama_dokumen`, `bag_or_keb`, `jenis_dok`, `masa_aktif_awal`, `masa_aktif_akhir`, `pic`, `akses_for`, `upload_dokumen`, `pengingat`) VALUES
(19, 1, 'STNK MOTOR HONDA', '1', '1', '2020-10-05', '2020-10-05', 'Fajar', '2,3', 'Laporan_Download1.pdf', 0),
(20, 2, 'STNK MOTOR Yamaha', '2', '1', '2020-10-06', '2020-10-06', 'Fajar', '3', 'Laporan_Download2.pdf', 0),
(21, 1, 'aaaa', '1', '1', '2020-10-06', '2020-10-06', 'aaa', '1,2,3', 'Laporan_Download_(50).pdf', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_master_jenis_dok`
--

CREATE TABLE IF NOT EXISTS `tb_master_jenis_dok` (
  `id` int(11) NOT NULL,
  `nama_jenis_dokumen` varchar(255) NOT NULL,
  `durasi_tahun` int(11) NOT NULL,
  `durasi_bulan` int(11) DEFAULT NULL,
  `durasi_tgl` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_master_jenis_dok`
--

INSERT INTO `tb_master_jenis_dok` (`id`, `nama_jenis_dokumen`, `durasi_tahun`, `durasi_bulan`, `durasi_tgl`) VALUES
(1, 'STNK', 1, 1, 1),
(3, 'Ijazah', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE IF NOT EXISTS `tb_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'Bagian'),
(3, 'Kebun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
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
-- Indexes for table `hkm_dokumen`
--
ALTER TABLE `hkm_dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `hkm_master_jenis_dokumen`
--
ALTER TABLE `hkm_master_jenis_dokumen`
  ADD PRIMARY KEY (`id_jenis_dokumen`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `histori_pembarui_dokumen`
--
ALTER TABLE `histori_pembarui_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hkm_dokumen`
--
ALTER TABLE `hkm_dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hkm_master_jenis_dokumen`
--
ALTER TABLE `hkm_master_jenis_dokumen`
  MODIFY `id_jenis_dokumen` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
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
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
