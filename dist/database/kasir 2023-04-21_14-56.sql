
-- Database Backup --
-- Ver. : 1.0.1
-- Host : 127.0.0.1
-- Generating Time : Apr 21, 2023 at 09:56:18:AM



CREATE TABLE `barang` (
  `id_barang` varchar(255) NOT NULL COMMENT 'Primary Key',
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO barang VALUES
("B0001","kaca 02","20000","25000","235"),
("B0004","kaca 03","5000","7000","12"),
("KB003","kaca beling","7000","10000","12");




CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_supplier` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang_masuk`),
  KEY `id_barang` (`id_barang`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  CONSTRAINT `barang_masuk_ibfk_4` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;


INSERT INTO barang_masuk VALUES
("1","BRM2104001","KB003","10","0","70000","70000","100000","30000","Lunas","2023-04-21","1","PT0002");




CREATE TABLE `beban` (
  `id_beban` varchar(255) NOT NULL,
  `nama_beban` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_beban`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO beban VALUES
("ID0001","gaji","2023-04-17","1000000");




CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO pelanggan VALUES
("P0001","rayhan"),
("P0002","2"),
("P0003","danusan");




CREATE TABLE `pengguna` (
  `id_pengguna` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('pemilik','karyawan') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO pengguna VALUES
("1","admin","$2y$10$2NgJUSEunNmAhYA60A0jvOULreTDAxVZou5s3n3F1gCr4Xlrz0EyG","karyawan","admin"),
("USER0001","pemilik","$2y$10$zLfQbeoKVZBAEHysur1N2e8ilbuHpoAEom6y3uUvcebnNpHnY5uh6","pemilik","pemilik");




CREATE TABLE `pengiriman` (
  `no_surat_jalan` varchar(255) NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no_surat_jalan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO pengiriman VALUES
("DOM00001","","2023-04-06",""),
("DOM00002","","2023-04-06",""),
("DOM00003","icikiwir","2023-04-06",""),
("DOM00004","gagaahaha","2023-04-06",""),
("DOM00005","JL. Icikiwir","2023-04-06",""),
("DOM00006","Jl. Icikiwir no.1 Desa Herex","2023-04-07",""),
("DOM00007","Jl. Icikiwir no.1 Desa Herex","2023-04-07",""),
("DOM00008","Icikiwir","2023-04-08","081178654568"),
("DOM00009","Icikiwir","2023-04-13","087789765456"),
("DOM00010","icikiwir wkakwak","2023-04-13","089000"),
("DOM00011","ywghweghtghwghwghw","2023-04-17","084774736746734");




CREATE TABLE `prive` (
  `id_prive` varchar(255) NOT NULL,
  `nama_prive` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO prive VALUES
("PR0001","entah","2023-04-16","200000");




CREATE TABLE `supplier` (
  `id_supplier` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `telepon_supplier` varchar(13) DEFAULT NULL,
  `alamat_supplier` text DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO supplier VALUES
("PT0001","jaya wijaya","0838227642626","jhhjffbbnfaga"),
("PT0002","jaya kusuma","0782785267527","ahjfbhabhfahja");




CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id_transaksi`),
  KEY `id_barang` (`id_barang`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `no_surat_jalan` (`no_surat_jalan`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`no_surat_jalan`) REFERENCES `pengiriman` (`no_surat_jalan`),
  CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;


INSERT INTO transaksi VALUES
("2","INV0504001","2023-04-06","2023-04-06","2","0","10000","10000","10000","0","Lunas","P0001","B0001","1","DOM00001"),
("3","INV0504002","2023-04-06","2023-04-06","2","0","10000","10000","200000","190000","Lunas","P0001","B0001","1","DOM00002"),
("4","INV0504003","2023-04-06","2023-04-06","2","0","10000","10000","50000","40000","Lunas","P0001","B0001","1","DOM00003"),
("5","INV0604004","2023-04-06","2023-05-06","2","0","10000","10000","50000","40000","","P0001","B0001","1","DOM00004"),
("6","INV0604005","2023-04-06","2023-04-06","2","0","10000","60000","100000","40000","Lunas","P0001","B0001","1","DOM00005"),
("7","INV0604005","2023-04-06","2023-04-06","10","0","50000","60000","100000","40000","Lunas","P0001","B0001","1","DOM00005"),
("8","INV0704006","2023-04-07","2023-04-07","2","0","10000","10000","50000","40000","Lunas","P0003","B0001","1","DOM00006"),
("9","INV0704007","2023-04-07","2023-04-07","2","0","10000","35000","50000","15000","Lunas","P0003","B0001","1","DOM00007"),
("10","INV0704007","2023-04-07","2023-04-07","5","0","25000","35000","50000","15000","Lunas","P0003","B0001","1","DOM00007"),
("11","INV0804008","2023-04-08","2023-05-08","2","500","10000","9500","4500","-5000","","P0003","B0001","1","DOM00008"),
("12","INV1304009","2023-04-13","2023-05-13","2","5000","50000","45000","0","-5000","Lunas","P0001","B0001","1","DOM00009"),
("13","INV1304010","2023-04-13","2023-05-13","2","5000","50000","45000","45000","0","Lunas","P0001","B0001","1","DOM00010"),
("14","INV1704011","2023-04-17","2023-05-17","5","10000","125000","125000","25000","-10000","Utang","P0001","B0001","1","DOM00011");


