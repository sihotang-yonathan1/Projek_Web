-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2024 pada 10.55
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_form`
--

CREATE TABLE `reservasi_form` (
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `jumlah_tiket` int(255) NOT NULL,
  `jenis_tiket` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `catatan_khusus` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `reservasi_form`
--

INSERT INTO `reservasi_form` (`nama`, `tanggal`, `waktu`, `jumlah_tiket`, `jenis_tiket`, `id`, `catatan_khusus`, `status`) VALUES
('Cliffor', '2024-06-05', '16:23:00', 2, 'Sea World Ancol', 30, 'Belum Isi', 'Dikonfirmasi'),
('Clifford', '2024-06-05', '16:47:00', 2, 'Ancol', 31, 'Belum Isi', 'Dikonfirmasi'),
('Clifford', '2024-06-05', '16:51:00', 3, 'Dufan Ancol', 32, 'Belum Isi', 'Dikonfirmasi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `reservasi_form`
--
ALTER TABLE `reservasi_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `reservasi_form`
--
ALTER TABLE `reservasi_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
