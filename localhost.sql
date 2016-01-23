-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 22 Jan 2016 pada 04.28
-- Versi Server: 5.5.42
-- PHP Version: 5.4.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_londria`
--
CREATE DATABASE IF NOT EXISTS `db_londria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_londria`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_comments`
--

DROP TABLE IF EXISTS `tb_comments`;
CREATE TABLE IF NOT EXISTS `tb_comments` (
  `id` int(11) NOT NULL,
  `id_laundry` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_comments`
--

INSERT INTO `tb_comments` (`id`, `id_laundry`, `id_sender`, `time`, `message`) VALUES
(1, 1, 2, '2016-01-20 13:26:00', 'komentar neh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laundry`
--

DROP TABLE IF EXISTS `tb_laundry`;
CREATE TABLE IF NOT EXISTS `tb_laundry` (
  `id` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `buka` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  `foto_cover` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `bisa_kiloan` tinyint(1) NOT NULL,
  `bisa_dryCleaning` tinyint(1) NOT NULL,
  `bisa_satuan` tinyint(1) NOT NULL,
  `transaksi` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_laundry`
--

INSERT INTO `tb_laundry` (`id`, `id_layanan`, `nama`, `alamat`, `latitude`, `longitude`, `buka`, `foto`, `foto_cover`, `desc`, `rating`, `bisa_kiloan`, `bisa_dryCleaning`, `bisa_satuan`, `transaksi`, `telp`) VALUES
(1, 1, 'Laundry Pertamax', 'jl alamat palsu', -6.1253871, 106.2249587, 'dari jam segini sampai segitu', 'avatar.png', 'avatar1.png', 'ini adalah deskripsi', 5, 1, 1, 1, 12, '12121212'),
(2, 0, 'Laundry kedua', '', 0, 0, '', '', '', '', 2, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_layanan`
--

DROP TABLE IF EXISTS `tb_layanan`;
CREATE TABLE IF NOT EXISTS `tb_layanan` (
  `id` int(11) NOT NULL,
  `id_laundry` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `tipe` tinyint(1) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_layanan`
--

INSERT INTO `tb_layanan` (`id`, `id_laundry`, `id_layanan`, `tipe`, `harga`) VALUES
(1, 1, 0, 0, 6000),
(2, 1, 1, 1, 13000),
(3, 1, 3, 2, 8000),
(4, 1, 3, 3, 9500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rating`
--

DROP TABLE IF EXISTS `tb_rating`;
CREATE TABLE IF NOT EXISTS `tb_rating` (
  `id` int(11) NOT NULL,
  `id_laundry` int(11) NOT NULL,
  `_1` int(11) NOT NULL,
  `_2` int(11) NOT NULL,
  `_3` int(11) NOT NULL,
  `_4` int(11) NOT NULL,
  `_5` int(11) NOT NULL,
  `_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_rating`
--

INSERT INTO `tb_rating` (`id`, `id_laundry`, `_1`, `_2`, `_3`, `_4`, `_5`, `_count`) VALUES
(1, 1, 1, 2, 3, 4, 0, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama_lengkap`, `telp`, `email`, `gender`, `latitude`, `longitude`) VALUES
(1, 'Alula', '', '', 1, 0, 0),
(2, 'Rudi', '', '', 1, 0, 0),
(3, 'Rudi', '', '', 1, 0, 0),
(4, 'Alul', '', '', 1, 0, 0),
(5, 'Ayu', '', '', 1, 0, 0),
(6, 'Icon', '', '', 1, 0, 0),
(7, 'Icon', '', '', 1, 0, 0),
(8, 'kiki', '', '', 1, 0, 0),
(9, 'kiki', '', '', 1, 0, 0),
(10, 'kiki', '', '', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_comments`
--
ALTER TABLE `tb_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_laundry`
--
ALTER TABLE `tb_laundry`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rating`
--
ALTER TABLE `tb_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_comments`
--
ALTER TABLE `tb_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_laundry`
--
ALTER TABLE `tb_laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_rating`
--
ALTER TABLE `tb_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
