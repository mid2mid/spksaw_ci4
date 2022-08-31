-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2022 pada 19.49
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_spku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id_data` int(10) UNSIGNED NOT NULL,
  `id_project` int(10) UNSIGNED NOT NULL,
  `id_kriteria` int(10) UNSIGNED NOT NULL,
  `nama` text NOT NULL,
  `value` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`id_data`, `id_project`, `id_kriteria`, `nama`, `value`) VALUES
(1, 2, 1, 'hape a', 60),
(2, 2, 2, 'hape a', 60),
(3, 2, 1, 'hape b', 70),
(4, 2, 2, 'hape b', 70),
(7, 2, 1, 'hape c', 80),
(8, 2, 2, 'hape c', 80),
(9, 2, 1, 'hape d', 90),
(10, 2, 2, 'hape d', 90),
(11, 2, 5, 'hape a', 60),
(12, 2, 5, 'hape b', 70),
(13, 2, 5, 'hape c', 80),
(17, 2, 1, 'hape e', 100),
(18, 2, 2, 'hape e', 100),
(19, 2, 5, 'hape e', 100),
(20, 2, 5, 'hape d', 90),
(22, 2, 7, 'hape a', 100),
(23, 2, 7, 'hape b', 90),
(24, 2, 7, 'hape c', 80),
(25, 2, 7, 'hape d', 70),
(26, 2, 7, 'hape e', 60),
(27, 3, 9, 'laptop q', 75),
(28, 3, 10, 'laptop q', 20),
(29, 3, 11, 'laptop q', 30),
(30, 3, 12, 'laptop q', 60),
(31, 3, 9, 'asus d', 30),
(32, 3, 10, 'asus d', 50),
(33, 3, 11, 'asus d', 50),
(34, 3, 12, 'asus d', 40),
(35, 3, 9, 'hp a', 45),
(36, 3, 10, 'hp a', 68),
(37, 3, 11, 'hp a', 59),
(38, 3, 12, 'hp a', 78);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(10) UNSIGNED NOT NULL,
  `id_project` int(10) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `atribut` enum('cost','benefit') NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `bobot` tinyint(1) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_project`, `nama`, `atribut`, `deskripsi`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 2, 'harga', 'cost', 'harga', 20, '2022-05-02 14:39:06', '2022-05-06 01:36:53'),
(2, 2, 'jumlah', 'benefit', 'jumlah', 45, '2022-05-02 14:39:06', '2022-05-06 10:36:46'),
(5, 2, 'garansi', 'cost', 'garansi', 30, '2022-05-04 13:21:49', '2022-05-06 01:38:46'),
(7, 2, 'jago sekali', 'benefit', 'jago sekali', 5, '2022-05-06 10:36:31', '2022-05-06 10:36:31'),
(9, 3, 'harga', 'cost', 'harga', 40, '2022-05-07 11:45:00', '2022-05-07 11:45:00'),
(10, 3, 'jumlah juga cuy', 'benefit', 'jumlah', 20, '2022-05-07 11:46:58', '2022-05-07 11:46:58'),
(11, 3, 'jarjit sigh', 'cost', 'coba', 15, '2022-05-07 11:47:33', '2022-05-07 12:40:50'),
(12, 3, 'xxx', 'cost', 'xxx', 25, '2022-05-07 11:48:06', '2022-05-07 12:27:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id_project` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL CHECK (`nama` <> ''),
  `deskripsi` varchar(251) NOT NULL CHECK (`deskripsi` <> ''),
  `metode` enum('saw') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id_project`, `nama`, `deskripsi`, `metode`, `created_at`, `updated_at`) VALUES
(2, 'test 1', 'test 1', 'saw', '2022-04-30 23:45:43', '2022-05-06 10:46:48'),
(3, 'aaaaa', 'bbbb', 'saw', '2022-04-30 23:51:06', '2022-05-01 03:03:08'),
(5, 'bbbb', 'bbbb', 'saw', '2022-05-01 00:34:43', '2022-05-01 00:34:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `fk_data_project` (`id_project`),
  ADD KEY `fk_data_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id_data` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `fk_data_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_data_project` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
