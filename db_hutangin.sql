-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2022 pada 05.10
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hutangin`
--
CREATE DATABASE IF NOT EXISTS `db_hutangin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_hutangin`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_penghutang` varchar(30) NOT NULL,
  `nama_hutang` varchar(30) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sisa_hutang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`id`, `id_user`, `nama_penghutang`, `nama_hutang`, `tanggal_pinjam`, `jatuh_tempo`, `jumlah`, `sisa_hutang`) VALUES
(1, 1, 'Roberto', 'Konsumsi', '2022-06-18', '2022-07-18', 1000000, 900000),
(2, 1, 'John Cena', 'Makanan', '2022-06-18', '2022-07-18', 200000, 200000),
(3, 1, 'Megawat', 'Gas', '2022-06-18', '2022-07-18', 1000000, 1000000),
(4, 3, 'Margareta', 'Pakaian', '2022-06-18', '2022-07-18', 500000, 490000),
(5, 3, 'Joko', 'Infrastruktur', '2022-06-18', '2022-07-30', 10000000, 0),
(6, 3, 'Luhuta', 'Nikel', '2022-06-18', '2022-07-18', 10000000, 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_bayar`
--

CREATE TABLE `riwayat_bayar` (
  `id` int(11) NOT NULL,
  `id_hutang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_bayar`
--

INSERT INTO `riwayat_bayar` (`id`, `id_hutang`, `id_user`, `jumlah_bayar`, `status`, `tanggal`) VALUES
(1, 1, 1, 100000, 'Belum Lunas', '2022-06-18'),
(2, 4, 3, 10000, 'Belum Lunas', '2022-06-18'),
(3, 5, 3, 10000000, 'Lunas', '2022-06-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `verified`) VALUES
(1, 'Gina', 'gina@email.com', '7df27de84ed79a46d75c7c57ad00f76f', 1),
(2, 'James', 'jamesadam@email.com', 'b4cc344d25a2efe540adbf2678e2304c', 1),
(3, 'John', 'john@email.com', '527bd5b5d689e2c32ae974c6229ff785', 1),
(4, 'Sava Elegi', 'sava@email.com', '9cbdac81135e956ea0415a1d201147d9', 1),
(6, 'Ronaldo', 'ronaldo@email.com', 'c5aa3124b1adad080927ce4d144c6b33', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_bayar`
--
ALTER TABLE `riwayat_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `riwayat_bayar`
--
ALTER TABLE `riwayat_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
