-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2024 pada 08.43
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
  `jumlah_orang` int(255) NOT NULL,
  `jenis_meja` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `catatan_khusus` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `reservasi_form`
--

INSERT INTO `reservasi_form` (`nama`, `tanggal`, `waktu`, `jumlah_orang`, `jenis_meja`, `id`, `catatan_khusus`, `status`) VALUES
('FEBRIAN REZKI HEMETO', '2024-05-31', '14:14:00', 2, 'Ancol', 25, 'Belum Isi', 'Dikonfirmasi'),
('Cliffor', '2024-05-31', '14:28:00', 5, 'Dufan Ancol', 26, 'Belum Isi', 'Dikonfirmasi'),
('Jennifer', '2024-05-31', '14:28:00', 4, 'Sea World Ancol', 27, 'Belum Isi', 'Dikonfirmasi');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
