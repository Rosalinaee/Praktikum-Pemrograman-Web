-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2025 pada 18.21
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
-- Database: `pemesanan_tiket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `maskapai`
--

CREATE TABLE `maskapai` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `maskapai`
--

INSERT INTO `maskapai` (`id`, `nama`, `harga`) VALUES
(1, 'Global Wings', 2500000),
(2, 'Unity Airlines', 1200000),
(3, 'Cendrawasi Air', 1000000),
(4, 'SwiftAir', 1500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_pesawat`
--

CREATE TABLE `tiket_pesawat` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `dari` varchar(100) NOT NULL,
  `ke` varchar(100) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `maskapai` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tiket_pesawat`
--

INSERT INTO `tiket_pesawat` (`id`, `nama_pemesan`, `dari`, `ke`, `tanggal_berangkat`, `jumlah_tiket`, `maskapai`, `harga`) VALUES
(8, 'Rosa', 'yogyakarta', 'Samarinda', '2000-09-23', 1, 'Global Wings', 2500000),
(11, 'Rosalina', 'Yogyakarta', 'Samarinda', '2025-06-24', 1, 'Global Wings', 2500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Rosa', '$2y$10$XBfPGDVNTXVYW3q.TiPOMej/mT1136dCvaHhrVtDFAkdzj9i7Sg3.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
