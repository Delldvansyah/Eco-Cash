-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2024 pada 22.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecocash`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `nia` varchar(9) NOT NULL DEFAULT '',
  `nama` varchar(20) NOT NULL,
  `telepon` varchar(12) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `level` enum('Master-admin','Admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`nia`, `nama`, `telepon`, `email`, `password`, `level`) VALUES
('admin123', 'administrator', '081222333123', 'admin@gmail.com', 'admin123', 'Master-admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `nin` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `rt` int(1) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `saldo` int(8) DEFAULT NULL,
  `sampah` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `nasabah`
--

INSERT INTO `nasabah` (`nin`, `nama`, `rt`, `alamat`, `telepon`, `email`, `password`, `saldo`, `sampah`) VALUES
('NSB1712001', 'Ihsmi ', 2, 'Jl. murai 8, C.45/4', '085617287718', 'ihsmiica@gmail.com', 'user123', 0, 1),
('NSB1712002', 'Sabrina  ', 4, 'Jl. murai 8, C.45/4', '085617287718', 'sabrina123@gmail.com', '12345678', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah`
--

CREATE TABLE `sampah` (
  `jenis_sampah` varchar(15) NOT NULL,
  `satuan` enum('KG','PC','LT') NOT NULL,
  `harga` int(5) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `deskripsi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `sampah`
--

INSERT INTO `sampah` (`jenis_sampah`, `satuan`, `harga`, `gambar`, `deskripsi`) VALUES
('HVS', 'KG', 9000, 'hvs.png', 'Semua Jenis HVS'),
('kaleng', 'KG', 3000, 'Pocari_Sweat_Kaleng_Dus_ISI_24.jpg', 'semua jenis kaleng'),
('Kardus', 'KG', 8000, 'kardus.jpg', 'Semua Jenis Kardus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(5) NOT NULL,
  `tanggal_setor` date NOT NULL,
  `nin` varchar(10) NOT NULL,
  `jenis_sampah` varchar(15) NOT NULL,
  `berat` int(4) NOT NULL,
  `harga` int(6) NOT NULL,
  `total` int(8) NOT NULL,
  `nia` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `setor`
--

INSERT INTO `setor` (`id_setor`, `tanggal_setor`, `nin`, `jenis_sampah`, `berat`, `harga`, `total`, `nia`) VALUES
(1, '2024-06-11', 'Ihsmi ', 'HVS', 3, 9000, 0, 'NIA'),
(2, '2024-06-11', 'Ihsmi ', 'kaleng', 5, 3000, 2000, 'NIA'),
(3, '2024-06-11', 'Ihsmi ', 'kaleng', 2, 3000, 6000, ''),
(4, '2024-06-11', 'Ihsmi ', 'Kardus', 2, 8000, 16000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarik`
--

CREATE TABLE `tarik` (
  `id_tarik` int(3) NOT NULL,
  `tanggal_tarik` date NOT NULL,
  `nin` varchar(10) NOT NULL,
  `saldo` int(7) NOT NULL,
  `jumlah_tarik` int(7) NOT NULL,
  `nia` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tarik`
--

INSERT INTO `tarik` (`id_tarik`, `tanggal_tarik`, `nin`, `saldo`, `jumlah_tarik`, `nia`) VALUES
(0, '2024-06-12', 'Ihsmi ', 32000, 10000, 'some_nia_'),
(0, '2024-06-12', 'Ihsmi ', 34000, 10000, 'some_nia_');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarik_tunai`
--

CREATE TABLE `tarik_tunai` (
  `id_tarik` int(11) NOT NULL,
  `nin` varchar(20) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `tanggal_tarik` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tarik_tunai`
--

INSERT INTO `tarik_tunai` (`id_tarik`, `nin`, `jumlah`, `tanggal_tarik`) VALUES
(1, 'Ihsmi ', 10.00, '2024-06-12 03:14:10'),
(2, 'Ihsmi ', 10000.00, '2024-06-12 03:15:48'),
(3, 'Ihsmi ', 10000.00, '2024-06-12 03:18:46'),
(4, 'Ihsmi ', 10000.00, '2024-06-12 03:39:16'),
(5, 'Ihsmi ', 10000.00, '2024-06-12 03:40:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nia`);

--
-- Indeks untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`nin`);

--
-- Indeks untuk tabel `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`jenis_sampah`);

--
-- Indeks untuk tabel `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Indeks untuk tabel `tarik_tunai`
--
ALTER TABLE `tarik_tunai`
  ADD PRIMARY KEY (`id_tarik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tarik_tunai`
--
ALTER TABLE `tarik_tunai`
  MODIFY `id_tarik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
