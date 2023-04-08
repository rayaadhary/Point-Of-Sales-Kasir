-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2023 pada 12.06
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(255) NOT NULL COMMENT 'Primary Key',
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`) VALUES
('B0001', 'kaca 02', 2000, 5000, 145);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `no_barang_masuk` varchar(255) NOT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `banyak` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `status` enum('Lunas','Utang') DEFAULT NULL,
  `tanggal_beli` date DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_supplier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`) VALUES
('P0001', 'rayhan'),
('P0002', '2'),
('P0003', 'danu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('pemilik','karyawan') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `role`, `nama`) VALUES
(1, 'admin', '$2y$10$cboEHApwidC/IQMBVHwuGunOEEUOfRTF9fcCfebIUiJcOZrhdQA3K', 'karyawan', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `no_surat_jalan` varchar(255) NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`no_surat_jalan`, `alamat_tujuan`, `tanggal_kirim`, `telepon`) VALUES
('DOM00001', '', '2023-04-06', NULL),
('DOM00002', '', '2023-04-06', NULL),
('DOM00003', 'icikiwir', '2023-04-06', NULL),
('DOM00004', 'gagaahaha', '2023-04-06', NULL),
('DOM00005', 'JL. Icikiwir', '2023-04-06', NULL),
('DOM00006', 'Jl. Icikiwir no.1 Desa Herex', '2023-04-07', NULL),
('DOM00007', 'Jl. Icikiwir no.1 Desa Herex', '2023-04-07', NULL),
('DOM00008', 'Icikiwir', '2023-04-08', '081178654568');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_faktur` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `banyak` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `status` enum('Lunas','Utang') DEFAULT NULL,
  `id_pelanggan` varchar(255) DEFAULT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `no_surat_jalan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_faktur`, `tanggal`, `jatuh_tempo`, `banyak`, `diskon`, `subtotal`, `total`, `bayar`, `kembali`, `status`, `id_pelanggan`, `id_barang`, `id_pengguna`, `no_surat_jalan`) VALUES
(2, 'INV0504001', '2023-04-06', '2023-04-06', 2, 0, 10000, 10000, 10000, 0, 'Lunas', 'P0001', 'B0001', 1, 'DOM00001'),
(3, 'INV0504002', '2023-04-06', '2023-04-06', 2, 0, 10000, 10000, 200000, 190000, 'Lunas', 'P0001', 'B0001', 1, 'DOM00002'),
(4, 'INV0504003', '2023-04-06', '2023-04-06', 2, 0, 10000, 10000, 50000, 40000, 'Lunas', 'P0001', 'B0001', 1, 'DOM00003'),
(5, 'INV0604004', '2023-04-06', '2023-05-06', 2, 0, 10000, 10000, 50000, 40000, '', 'P0001', 'B0001', 1, 'DOM00004'),
(6, 'INV0604005', '2023-04-06', '2023-04-06', 2, 0, 10000, 60000, 100000, 40000, 'Lunas', 'P0001', 'B0001', 1, 'DOM00005'),
(7, 'INV0604005', '2023-04-06', '2023-04-06', 10, 0, 50000, 60000, 100000, 40000, 'Lunas', 'P0001', 'B0001', 1, 'DOM00005'),
(8, 'INV0704006', '2023-04-07', '2023-04-07', 2, 0, 10000, 10000, 50000, 40000, 'Lunas', 'P0003', 'B0001', 1, 'DOM00006'),
(9, 'INV0704007', '2023-04-07', '2023-04-07', 2, 0, 10000, 35000, 50000, 15000, 'Lunas', 'P0003', 'B0001', 1, 'DOM00007'),
(10, 'INV0704007', '2023-04-07', '2023-04-07', 5, 0, 25000, 35000, 50000, 15000, 'Lunas', 'P0003', 'B0001', 1, 'DOM00007'),
(11, 'INV0804008', '2023-04-08', '2023-05-08', 2, 500, 10000, 9500, 4500, -5000, '', 'P0003', 'B0001', 1, 'DOM00008');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`no_barang_masuk`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`no_surat_jalan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `no_surat_jalan` (`no_surat_jalan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`no_surat_jalan`) REFERENCES `pengiriman` (`no_surat_jalan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
