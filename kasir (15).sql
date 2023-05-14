-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Bulan Mei 2023 pada 12.09
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
('1', '1', 100, 200, 8),
('15000', 'berhasil 2', 20000, 30000, 2),
('3', '3', 400, 600, 10),
('a', 'a', 5000, 10000, 100),
('B0001', 'WHITEBOARD', 5000, 20000, 989),
('B0090', 'BLACKBOARD', 5000, 10000, 139),
('babi001', 'daging babi', 70000, 100000, 10),
('bba', 'barang a', 5000, 10000, 3),
('bbc', 'barang c', 5000, 15000, 3),
('BGS001', 'BARANG BAGUS', 77000, 210000, 0),
('brh1', 'berhasil 1', 12000, 15000, 3),
('d', 'd', 5, 10, 2),
('DGA', 'daging a', 6000, 7000, 1),
('dgb', 'daging b', 7000, 10000, 0),
('dgc', 'daging c', 7000, 10000, 2),
('GDM001', 'gundam', 200000, 220000, 2),
('JK001', 'GREENBOARD', 6000, 7000, 1),
('k', 'k', 5000, 10000, 10),
('smg1', 'semoga 1', 456, 789, 2),
('smg2', 'semoga 2', 678, 789, 3),
('smg3', 'semoga 3', 123, 345, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `no_barang_masuk` varchar(255) DEFAULT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `banyak` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `status` enum('Lunas','Utang') DEFAULT NULL,
  `tanggal_beli` date DEFAULT NULL,
  `id_pengguna` varchar(255) DEFAULT NULL,
  `id_supplier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `no_barang_masuk`, `id_barang`, `banyak`, `diskon`, `subtotal`, `total`, `bayar`, `kembali`, `status`, `tanggal_beli`, `id_pengguna`, `id_supplier`) VALUES
(1, 'BRM0305001', 'B0090', 10, 0, 50000, 50000, 50000, 0, 'Lunas', '2023-05-03', 'USER0002', 'PT0001'),
(2, 'BRM0305002', 'B0001', 100, 0, 500000, 500000, 500000, 0, 'Lunas', '2023-05-03', 'USER0002', 'PT0001'),
(3, 'BRM0505003', 'JK001', 10, 0, 60000, 123000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(6, 'BRM0505005', 'DGA', 2, 0, 12000, 40000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(7, 'BRM0505005', 'dgb', 2, 0, 14000, 40000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(8, 'BRM0505005', 'dgc', 2, 0, 14000, 40000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(9, 'BRM0505006', 'bba', 2, 0, 10000, 20000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(10, 'BRM0505006', 'bbc', 2, 0, 10000, 20000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(11, 'BRM0505006', 'bba', 2, 0, 10000, 20000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(12, 'BRM0505006', 'bbc', 2, 0, 10000, 20000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(13, 'BRM0505007', 'a', 100, 0, 500000, 620000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(14, 'BRM0505008', 'k', 10, 0, 50000, 100000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(17, 'BRM0505010', '1', 2, 0, 200, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(18, 'BRM0505010', '3', 2, 0, 800, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(19, 'BRM0505010', '1', 2, 0, 200, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(20, 'BRM0505010', '3', 2, 0, 800, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(21, 'BRM0505010', '3', 2, 0, 800, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(22, 'BRM0505010', '1', 2, 0, 200, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(23, 'BRM0505010', '3', 2, 0, 800, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(24, 'BRM0505010', '1', 2, 0, 200, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(25, 'BRM0505010', '3', 2, 0, 800, 1000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(26, 'BRM0505011', 'brh1', 3, 0, 36000, 76000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(27, 'BRM0505011', '15000', 2, 0, 40000, 76000, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(28, 'BRM0505012', 'smg1', 2, 0, 912, 2946, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(29, 'BRM0505012', 'smg2', 3, 0, 2034, 2946, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(30, 'BRM0505013', 'smg3', 2, 0, 246, 246, 0, 0, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(31, 'BRM0505014', 'BGS001', 2, 0, 154000, 154000, 160000, 6000, 'Lunas', '2023-05-05', 'USER0002', 'PT0001'),
(32, 'BRM0605015', 'GDM001', 2, 0, 400000, 400000, 300000, 100000, 'Utang', '2023-05-06', 'USER0002', 'PT0001'),
(33, 'BRM0605016', 'B0090', 200, 0, 1000000, 1000000, 500000, 500000, 'Utang', '2023-05-06', 'USER0002', 'PT0001'),
(34, 'BRM0605017', 'B0001', 2, 0, 10000, 10000, 0, 0, '', '2023-05-06', 'USER0002', 'PT0001'),
(35, 'BRM1105018', 'B0001', 1000, 0, 5000000, 5000000, 4700000, -300000, 'Utang', '2023-05-11', 'USER0002', 'PT0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban`
--

CREATE TABLE `beban` (
  `id_beban` varchar(255) NOT NULL,
  `nama_beban` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `beban`
--

INSERT INTO `beban` (`id_beban`, `nama_beban`, `tanggal`, `biaya`) VALUES
('IB0001', 'naon', '2023-05-12', 70000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modal`
--

CREATE TABLE `modal` (
  `id_modal` varchar(255) NOT NULL,
  `nama_modal` varchar(255) NOT NULL,
  `tanggal_modal` date NOT NULL,
  `biaya` int(11) NOT NULL
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
('P0001', 'rozali'),
('P0002', 'andi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('pemilik','petugas') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `role`, `nama`) VALUES
('USER0001', 'salsabila', '$2y$10$1DwossENYxJrfvAjXUBMI.kljyv3bqceFkXihbNeQemorHfTslBkC', 'pemilik', 'salsabila'),
('USER0002', 'iman', '$2y$10$YvlIDy.QtTLDGSWH7kW3PelSRvdNob.BZVpLNMeq4wxbQIApdosCG', 'petugas', 'iman');

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
('DOM00001', 'fafjnjfajfja', '2023-05-03', '088787745'),
('DOM00002', 'abhbfafafa', '2023-05-03', '08327572727'),
('DOM00003', 'jkhjafhjajhfhjaf', '2023-05-03', '28471577252'),
('DOM00004', 'jkhjafhjajhfhjaf', '2023-05-03', '28471577252'),
('DOM00005', 'gwgwgjwgw', '2023-05-03', '08663363'),
('DOM00006', 'gssgbsbgbs', '2023-05-03', '08'),
('DOM00007', 'sgsgs', '2023-05-03', '08'),
('DOM00008', 'fkjafkakfak', '2023-05-03', '08257572'),
('DOM00009', 'cobaan', '2023-05-03', '08'),
('DOM00010', 'uhggh', '2023-05-03', '08'),
('DOM00011', 'gsfsfssf', '2023-05-03', '08'),
('DOM00012', 'agafagagaga', '2023-05-03', '08'),
('DOM00013', 'agagag', '2023-05-03', '08'),
('DOM00014', 'fff', '2023-05-03', '08'),
('DOM00015', 'fafafa', '2023-05-03', '08'),
('DOM00016', 'jj', '2023-05-03', '08'),
('DOM00017', 'hhh', '2023-05-03', '08'),
('DOM00018', 'hhh', '2023-05-03', '08'),
('DOM00019', 'ffff', '2023-05-03', '08'),
('DOM00020', 'ffff', '2023-05-03', '08'),
('DOM00021', 'hhh', '2023-05-05', '08'),
('DOM00022', 'gg', '2023-05-05', '08'),
('DOM00023', 'ff', '2023-05-05', '08'),
('DOM00024', 'gg', '2023-05-05', '08'),
('DOM00025', 'gg', '2023-05-05', '08'),
('DOM00026', 'jj', '2023-05-05', '08'),
('DOM00027', 'gg', '2023-05-05', '08'),
('DOM00028', 'gg', '2023-05-05', '08'),
('DOM00029', 'gg', '2023-05-05', '08'),
('DOM00030', 'gg', '2023-05-05', '08'),
('DOM00031', 'gg', '2023-05-05', '08'),
('DOM00032', 'gg', '2023-05-05', '08'),
('DOM00033', 'gg', '2023-05-05', '08'),
('DOM00034', 'gg', '2023-05-05', '08'),
('DOM00035', 'gg', '2023-05-05', '08'),
('DOM00036', 'gg', '2023-05-06', '08'),
('DOM00037', 'gg', '2023-05-06', '08'),
('DOM00038', 'gg', '2023-05-06', '08'),
('DOM00039', 'gg', '2023-05-06', '08'),
('DOM00040', 'gg', '2023-05-06', '08'),
('DOM00041', 'gg', '2023-05-06', '08'),
('DOM00042', 'gg', '2023-05-06', '08'),
('DOM00043', 'gg', '2023-05-06', '08'),
('DOM00044', 'ff', '2023-05-06', '08'),
('DOM00045', 'gg', '2023-05-06', '08'),
('DOM00046', 'gg', '2023-05-06', '08'),
('DOM00047', 'jh', '2023-05-06', '08'),
('DOM00048', 'jh', '2023-05-06', '08'),
('DOM00049', 'jh', '2023-05-06', '08'),
('DOM00050', 'jh', '2023-05-06', '08'),
('DOM00051', 'gg', '2023-05-06', '08'),
('DOM00052', 'g', '2023-05-06', '08'),
('DOM00053', 'g', '2023-05-06', '08'),
('DOM00054', 'g', '2023-05-06', '08'),
('DOM00055', 'g', '2023-05-06', '08'),
('DOM00056', 'hh', '2023-05-06', '08'),
('DOM00057', 'gg', '2023-05-06', '08'),
('DOM00058', 's', '2023-05-06', '08'),
('DOM00059', 'gg', '2023-05-06', '08'),
('DOM00060', 'gg', '2023-05-06', '08'),
('DOM00061', 'fdfefd', '2023-05-06', '08'),
('DOM00062', 'fdfefd', '2023-05-06', '08'),
('DOM00063', 'ff', '2023-05-06', '08'),
('DOM00064', 'ff', '2023-05-06', '08'),
('DOM00065', 'ff', '2023-05-06', '08'),
('DOM00066', 'ww', '2023-05-11', '08'),
('DOM00067', 'ww', '2023-05-11', '08'),
('DOM00068', 'ww', '2023-05-11', '08'),
('DOM00069', 'ss', '2023-05-11', '08'),
('DOM00070', 'hh', '2023-05-11', '08'),
('DOM00071', 'gg', '2023-05-14', '08'),
('DOM00072', 'ff', '2023-05-14', '08'),
('DOM00073', 'gg', '2023-05-14', '08'),
('DOM00074', 'jj', '2023-05-14', '08'),
('DOM00075', 'ss', '2023-05-14', '08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prive`
--

CREATE TABLE `prive` (
  `id_prive` varchar(255) NOT NULL,
  `nama_prive` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prive`
--

INSERT INTO `prive` (`id_prive`, `nama_prive`, `tanggal`, `biaya`) VALUES
('IP0001', 'jajan', '2023-05-12', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `telepon_supplier` varchar(13) DEFAULT NULL,
  `alamat_supplier` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `telepon_supplier`, `alamat_supplier`) VALUES
('PT0001', 'jaya kusuma', '08324672346', 'ahjfafabfajahf');

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
  `id_pengguna` varchar(255) DEFAULT NULL,
  `no_surat_jalan` varchar(255) DEFAULT NULL,
  `selisih` int(11) DEFAULT NULL,
  `totalSelisih` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_faktur`, `tanggal`, `jatuh_tempo`, `banyak`, `diskon`, `subtotal`, `total`, `bayar`, `kembali`, `status`, `id_pelanggan`, `id_barang`, `id_pengguna`, `no_surat_jalan`, `selisih`, `totalSelisih`) VALUES
(1, 'INV0305001', '2023-05-03', '2023-05-03', 2, 0, 20000, 20000, 100000, 80000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00001', 10000, 10000),
(2, 'INV0305002', '2023-05-03', '2023-05-03', 2, 0, 20000, 20000, 20000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00002', 10000, 10000),
(3, 'INV0305003', '2023-05-03', '2023-05-03', 2, 0, 40000, 90000, 100000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00003', 30000, 55000),
(4, 'INV0305003', '2023-05-03', '2023-05-03', 5, 0, 50000, 90000, 100000, 10000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00003', 25000, 55000),
(5, 'INV0305004', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 100000, 40000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00004', 30000, 30000),
(6, 'INV0305005', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00007', 30000, 30000),
(7, 'INV0305006', '2023-05-03', '2023-05-03', 10, 0, 200000, 200000, 200000, 0, 'Lunas', 'P0002', 'B0001', 'USER0002', 'DOM00008', 150000, 150000),
(8, 'INV0305007', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00009', 30000, 30000),
(9, 'INV0305008', '2023-05-03', '2023-05-03', 1, 0, 10000, 10000, 10000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00010', 5000, 5000),
(10, 'INV0305009', '2023-05-03', '2023-05-03', 10, 0, 200000, 200000, 250000, 50000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00012', 150000, 150000),
(11, 'INV0305010', '2023-05-03', '2023-05-03', 2, 0, 40000, 80000, 100000, 20000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00013', 30000, 30000),
(12, 'INV0305011', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 40000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00014', 30000, 30000),
(13, 'INV0305012', '2023-05-03', '2023-05-03', 10, 0, 200000, 200000, 200000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00015', 150000, 150000),
(14, 'INV0305013', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 300000, 260000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00016', 30000, 30000),
(15, 'INV0305014', '2023-05-03', '2023-05-03', 2, 0, 40000, 100000, 100000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00017', 30000, 75000),
(16, 'INV0305014', '2023-05-03', '2023-05-03', 3, 0, 60000, 100000, 100000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00017', 45000, 75000),
(17, 'INV0305015', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00018', 30000, 30000),
(18, 'INV0305016', '2023-05-03', '2023-05-03', 2, 0, 40000, 40000, 40000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00019', 30000, 30000),
(19, 'INV0305017', '2023-05-03', '2023-05-03', 1, 0, 20000, 80000, 80000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00020', 15000, 60000),
(20, 'INV0305017', '2023-05-03', '2023-05-03', 3, 0, 60000, 80000, 80000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00020', 45000, 60000),
(21, 'INV0505018', '2023-05-05', '2023-05-05', 2, 0, 40000, 40000, 250000, 210000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00021', 30000, 30000),
(22, 'INV0505019', '2023-05-05', '2023-05-05', 2, 10000, 420000, 410000, 500000, 90000, 'Lunas', 'P0001', 'BGS001', 'USER0002', 'DOM00025', 266000, 256000),
(23, 'INV0505020', '2023-05-05', '2023-06-05', 3, 15000, 60000, 65000, 60000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00026', 45000, 25000),
(24, 'INV0505020', '2023-05-05', '2023-06-05', 1, 15000, 15000, 65000, 60000, 0, 'Lunas', 'P0001', 'bbc', 'USER0002', 'DOM00026', 10000, 25000),
(25, 'INV050520230001', '2023-05-05', '2023-05-05', 1, 0, 7000, 27000, 30000, 3000, 'Lunas', 'P0001', 'DGA', 'USER0002', 'DOM00028', 1000, 7000),
(26, 'INV050520230001', '2023-05-05', '2023-05-05', 2, 0, 20000, 27000, 30000, 3000, 'Lunas', 'P0001', 'dgb', 'USER0002', 'DOM00028', 6000, 7000),
(27, 'INV050520230002', '2023-05-05', '2023-05-05', 1, 0, 20000, 20000, 20000, 0, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00029', 15000, 15000),
(28, 'INV050520230003', '2023-05-05', '2023-06-05', 2, 0, 40000, 40000, 20000, 20000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00030', 30000, 30000),
(29, 'INV050520230004', '2023-05-05', '2023-06-05', 2, 0, 40000, 40000, 30000, 10000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00031', 30000, 30000),
(30, 'INV050520230005', '2023-05-05', '2023-05-05', 2, 0, 40000, 54000, 60000, 6000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00032', 30000, 32000),
(31, 'INV050520230005', '2023-05-05', '2023-05-05', 2, 0, 14000, 54000, 60000, 6000, 'Lunas', 'P0001', 'JK001', 'USER0002', 'DOM00032', 2000, 32000),
(32, 'INV050520230006', '2023-05-05', '2023-05-05', 2, 0, 40000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00033', 30000, 30000),
(33, 'INV050520230007', '2023-05-05', '2023-06-05', 2, 0, 40000, 54000, 50000, 4000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00034', 30000, 32000),
(34, 'INV050520230007', '2023-05-05', '2023-06-05', 2, 0, 14000, 54000, 50000, 4000, 'Utang', 'P0001', 'JK001', 'USER0002', 'DOM00034', 2000, 32000),
(35, 'INV050520230008', '2023-05-05', '2023-06-05', 2, 0, 40000, 40000, 30000, 10000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00035', 30000, 30000),
(36, 'INV060520230009', '2023-05-06', '2023-05-06', 2, 0, 40000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00036', 30000, 30000),
(37, 'INV060520230010', '2023-05-06', '2023-05-06', 2, 0, 40000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00037', 30000, 30000),
(38, 'INV060520230011', '2023-05-06', '2023-05-06', 1, 0, 20000, 27000, 30000, 3000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00038', 15000, 16000),
(39, 'INV060520230011', '2023-05-06', '2023-05-06', 1, 0, 7000, 27000, 30000, 3000, 'Lunas', 'P0001', 'JK001', 'USER0002', 'DOM00038', 1000, 16000),
(40, 'INV060520230012', '2023-05-06', '2023-05-06', 2, 0, 40000, 40000, 70000, 30000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00040', 30000, 30000),
(41, 'INV060520230013', '2023-05-06', '2023-05-06', 2, 0, 40000, 47000, 50000, 3000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00041', 30000, 31000),
(42, 'INV060520230013', '2023-05-06', '2023-05-06', 1, 0, 7000, 47000, 50000, 3000, 'Lunas', 'P0001', 'JK001', 'USER0002', 'DOM00041', 1000, 31000),
(43, 'INV060520230014', '2023-05-06', '2023-06-06', 2, 0, 40000, 54000, 52000, 2000, 'Utang', 'P0002', 'B0001', 'USER0002', 'DOM00042', 30000, 32000),
(44, 'INV060520230014', '2023-05-06', '2023-06-06', 2, 0, 14000, 54000, 52000, 2000, 'Utang', 'P0002', 'JK001', 'USER0002', 'DOM00042', 2000, 32000),
(45, 'INV060520230015', '2023-05-06', '2023-05-06', 1, 0, 20000, 27000, 30000, 3000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00043', 15000, 16000),
(46, 'INV060520230015', '2023-05-06', '2023-05-06', 1, 0, 7000, 27000, 30000, 3000, 'Lunas', 'P0001', 'JK001', 'USER0002', 'DOM00043', 1000, 16000),
(47, 'INV060520230016', '2023-05-06', '2023-06-06', 2, 0, 20000, 20000, 5000, 15000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00044', 10000, 10000),
(48, 'INV060520230017', '2023-05-06', '2023-06-06', 2, 0, 40000, 40000, 10000, 30000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00045', 30000, 30000),
(49, 'INV060520230018', '2023-05-06', '2023-05-06', 2, 0, 20000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00046', 10000, 25000),
(50, 'INV060520230018', '2023-05-06', '2023-05-06', 1, 0, 20000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00046', 15000, 25000),
(51, 'INV060520230019', '2023-05-06', '2023-06-06', 1, 0, 10000, 10000, 5000, 5000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00047', 5000, 5000),
(52, 'INV060520230020', '2023-05-06', '2023-06-06', 2, 0, 20000, 60000, 50000, 10000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00048', 10000, 40000),
(53, 'INV060520230020', '2023-05-06', '2023-06-06', 2, 0, 40000, 60000, 50000, 10000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00048', 30000, 40000),
(54, 'INV060520230021', '2023-05-06', '2023-05-06', 2, 0, 20000, 20000, 20000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00049', 10000, 10000),
(55, 'INV060520230022', '2023-05-06', '2023-05-06', 2, 0, 20000, 34000, 50000, 16000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00051', 10000, 10000),
(56, 'INV060520230023', '2023-05-06', '2023-05-06', 1, 0, 10000, 30000, 50000, 20000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00052', 5000, 20000),
(57, 'INV060520230023', '2023-05-06', '2023-05-06', 1, 0, 20000, 30000, 50000, 20000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00052', 15000, 20000),
(58, 'INV060520230024', '2023-05-06', '2023-06-06', 1, 0, 20000, 20000, 10000, 10000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00053', 15000, 15000),
(59, 'INV060520230025', '2023-05-06', '2023-06-06', 2, 0, 40000, 70000, 50000, 20000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00054', 30000, 45000),
(60, 'INV060520230025', '2023-05-06', '2023-06-06', 1, 0, 10000, 70000, 50000, 20000, 'Utang', 'P0001', 'bba', 'USER0002', 'DOM00054', 5000, 45000),
(61, 'INV060520230025', '2023-05-06', '2023-06-06', 2, 0, 20000, 70000, 50000, 20000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00054', 10000, 45000),
(62, 'INV060520230026', '2023-05-06', '2023-06-06', 2, 0, 40000, 120000, 50000, 70000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00055', 30000, 80000),
(63, 'INV060520230026', '2023-05-06', '2023-06-06', 2, 0, 20000, 120000, 50000, 70000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00055', 10000, 80000),
(64, 'INV060520230026', '2023-05-06', '2023-06-06', 2, 0, 40000, 120000, 50000, 70000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00055', 30000, 80000),
(65, 'INV060520230026', '2023-05-06', '2023-06-06', 2, 0, 20000, 120000, 50000, 70000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00055', 10000, 80000),
(66, 'INV060520230027', '2023-05-06', '2023-05-06', 2, 0, 20000, 80000, 100000, 20000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00056', 10000, 50000),
(67, 'INV060520230027', '2023-05-06', '2023-05-06', 1, 0, 10000, 80000, 100000, 20000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00056', 5000, 50000),
(68, 'INV060520230027', '2023-05-06', '2023-05-06', 1, 0, 10000, 80000, 100000, 20000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00056', 5000, 50000),
(69, 'INV060520230027', '2023-05-06', '2023-05-06', 2, 0, 40000, 80000, 100000, 20000, 'Lunas', 'P0001', 'B0001', 'USER0002', 'DOM00056', 30000, 50000),
(70, 'INV060520230028', '2023-05-06', '2023-06-06', 1, 0, 10000, 10000, 5000, 5000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00058', 5000, 5000),
(71, 'INV060520230029', '2023-05-06', '2023-05-06', 2, 0, 20000, 20000, 20000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00059', 10000, 10000),
(72, 'INV060520230030', '2023-05-06', '2023-05-06', 2, 0, 20000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00060', 10000, 10000),
(73, 'INV060520230031', '2023-05-06', '2023-05-06', 1, 0, 10000, 20000, 20000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00061', 5000, 10000),
(74, 'INV060520230031', '2023-05-06', '2023-05-06', 1, 0, 10000, 20000, 20000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00061', 5000, 10000),
(75, 'INV060520230032', '2023-05-06', '2023-06-06', 1, 0, 10000, 10000, 5000, 5000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00062', 5000, 5000),
(76, 'INV060520230033', '2023-05-06', '2023-05-06', 2, 0, 20000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00063', 10000, 20000),
(77, 'INV060520230033', '2023-05-06', '2023-05-06', 2, 0, 20000, 40000, 50000, 10000, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00063', 10000, 20000),
(78, 'INV060520230034', '2023-05-06', '2023-05-06', 1, 0, 10000, 10000, 10000, 0, 'Lunas', 'P0001', 'B0090', 'USER0002', 'DOM00064', 5000, 5000),
(79, 'INV060520230035', '2023-05-06', '2023-06-06', 1, 0, 10000, 100000, 50000, 50000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00065', 5000, 50000),
(80, 'INV060520230035', '2023-05-06', '2023-06-06', 9, 0, 90000, 100000, 50000, 50000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00065', 45000, 50000),
(81, 'INV110520230036', '2023-05-11', '2023-06-11', 2, 0, 20000, 20000, 10000, 10000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00068', 10000, 10000),
(82, 'INV110520230037', '2023-05-11', '2023-06-11', 2, 0, 20000, 20000, 15000, -5000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00069', 10000, 10000),
(83, 'INV110520230038', '2023-05-11', '2023-06-11', 10, 0, 100000, 100000, 0, -100000, 'Utang', 'P0001', 'B0090', 'USER0002', 'DOM00070', 50000, 50000),
(84, 'INV140520230039', '2023-05-14', '2023-06-14', 3, 0, 60000, 60000, 20000, -40000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00072', 5000, 0),
(85, 'INV140520230040', '2023-05-14', '2023-06-14', 2, 0, 20000, 20000, 5000, -15000, 'Utang', 'P0001', 'B0090', 'USER0001', 'DOM00073', 10000, 10000),
(86, 'INV140520230041', '2023-05-14', '2023-06-14', 2, 0, 40000, 100000, 25000, -75000, 'Utang', 'P0001', 'B0001', 'USER0001', 'DOM00074', 30000, 75000),
(87, 'INV140520230041', '2023-05-14', '2023-06-14', 3, 0, 60000, 100000, 25000, -75000, 'Utang', 'P0001', 'B0001', 'USER0001', 'DOM00074', 45000, 75000),
(88, 'INV140520230042', '2023-05-14', '2023-06-14', 2, 0, 40000, 40000, 20000, -20000, 'Utang', 'P0001', 'B0001', 'USER0002', 'DOM00075', 30000, 30000);

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
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`id_beban`);

--
-- Indeks untuk tabel `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`id_modal`);

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
-- Indeks untuk tabel `prive`
--
ALTER TABLE `prive`
  ADD PRIMARY KEY (`id_prive`);

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
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `no_surat_jalan` (`no_surat_jalan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `barang_masuk_ibfk_4` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`no_surat_jalan`) REFERENCES `pengiriman` (`no_surat_jalan`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
