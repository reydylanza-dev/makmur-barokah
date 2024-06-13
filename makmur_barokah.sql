-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2024 pada 12.16
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makmur_barokah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admincredentials`
--

CREATE TABLE `admincredentials` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admincredentials`
--

INSERT INTO `admincredentials` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$3RNyGcGSxMWpfjGKPo9u5.qegfADZiDCZFQ4XbdhZnTPn7gjtZUhy', '2024-06-11 10:28:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','Lainnya') DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten_kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `status_akun` enum('Aktif','Tidak Aktif','Diblokir','Tertunda') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image_url`) VALUES
('08e3f80382b49ac3bb556662b4bc7996d', 'Pop Mie Ayam Bawang [Dus]', '100000.00', 'https://i.imgur.com/BRyCn1p.png'),
('1416d4692b43a4e9e03c6662b7458e3aa', 'Aqua 600 ml [1 Dus]', '50000.00', 'https://i.imgur.com/2XrbsXr.jpeg'),
('1f5967a75543d65ff1206662b43c76ec8', 'Pop Mie Kari Ayam [1 Dus]', '130000.00', 'https://i.imgur.com/Pd6YDTm.jpeg'),
('2b99ede5aef2612cc6996662b7088fcfe', 'Giv 76gr [1 Dus]', '190000.00', 'https://i.imgur.com/f58zfw9.jpeg'),
('2ba0cbe0eb179fb0dcec6662b79613263', 'Sania 1 Liter [1 Dus]', '220000.00', 'https://i.imgur.com/vVXKPmp.jpeg'),
('3f6b943239ce258806076662afe9bd476', 'Dancow 3+ Vanilla [3 pcs]', '300000.00', 'https://i.imgur.com/ADLU45Y.png'),
('448015c7a8f3ce85461d6662b40d05831', 'Sedaap Ayam Jerit [1 Dus]', '105000.00', 'https://i.imgur.com/xLTqdia.jpeg'),
('4b0037e91e0b42d601ab6662b7794e990', 'Nabati Keju [1 Dus]', '98000.00', 'https://i.imgur.com/imLddGc.jpeg'),
('8392237ea201feec432f6662b498892dd', 'Pop Mie Ayam [1 Dus]', '110000.00', 'https://i.imgur.com/kym1omr.jpeg'),
('a77c098a3aa3bb40cc526662b763afc65', 'Mama lemon 680ml [1 Dus]', '110000.00', 'https://i.imgur.com/fDCo8Wb.jpeg'),
('e84215a39be33ecb7f236662b6b69e679', 'Frisian Flag SKM Putih (1 Dus)', '540000.00', 'https://i.imgur.com/Q65onf2.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaction_id` varchar(255) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_barang` decimal(10,2) DEFAULT NULL,
  `biaya_ongkir` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `trx_id` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `channel_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admincredentials`
--
ALTER TABLE `admincredentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admincredentials`
--
ALTER TABLE `admincredentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
