<?php
session_start();

define('BASEURL', 'http://localhost/kasir/admin');


function waktu()
{
  date_default_timezone_set('Asia/Jakarta');
  return date('Y-d-m', time());
}


function dbConnect()
{
  $db = mysqli_connect('localhost', 'root', '', 'kasir');
  return $db;
}

function logout()
{
  session_start();
  session_destroy();
  header("Location: index.php");
}


function kodeFaktur($waktu)
{
  $db = dbConnect();
  $query = $db->query("SELECT max(no_faktur) as kodeTerbesar FROM transaksi");
  $data = $query->fetch_assoc();
  $kode_faktur = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_faktur, 11, 4);
  $urutan++;
  $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
  $waktu_formatted = date_format($waktu_formatted, 'dmY');
  $huruf = "INV";
  $kode_faktur = $huruf . $waktu_formatted . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_faktur;
}

function kodePembelian($waktu)
{
  $db = dbConnect();
  $query = $db->query("SELECT max(no_pembelian) as kodeTerbesar FROM masuk");
  $data = $query->fetch_assoc();
  $kode_pembelian = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_pembelian, 7, 3);
  $urutan++;
  $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
  $waktu_formatted = date_format($waktu_formatted, 'dm');
  $huruf = "INV";
  $kode_pembelian = $huruf . $waktu_formatted . sprintf("%03s", $urutan);
  $query->free();
  $db->close();
  return $kode_pembelian;
}

function nomorSuratJalan()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(no_surat_jalan) as kodeTerbesar FROM pengiriman");
  $data = $query->fetch_assoc();
  $surat_jalan = $data['kodeTerbesar'];
  $urutan = (int) substr($surat_jalan, 3, 5);
  $urutan++;
  $huruf = "DOM";
  $surat_jalan = $huruf . sprintf("%05s", $urutan);
  $query->free();
  $db->close();
  return $surat_jalan;
}

function barangMasuk($waktu)
{
  $db = dbConnect();
  $query = $db->query("SELECT max(no_barang_masuk) as kodeTerbesar FROM barang_masuk");
  $data = $query->fetch_assoc();
  $kode_faktur = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_faktur, 7, 3);
  $urutan++;
  $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
  $waktu_formatted = date_format($waktu_formatted, 'dm');
  $huruf = "BRM";
  $kode_faktur = $huruf . $waktu_formatted . sprintf("%03s", $urutan);
  $query->free();
  $db->close();
  return $kode_faktur;
}

function kodePelanggan()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(id_pelanggan) as kodeTerbesar FROM pelanggan");
  $data = $query->fetch_assoc();
  $kode_pelanggan = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_pelanggan, 1, 4);
  $urutan++;
  $huruf = "P";
  $kode_pelanggan = $huruf . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_pelanggan;
}

function kodePengguna()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(id_pengguna) as kodeTerbesar FROM pengguna");
  $data = $query->fetch_assoc();
  $kode_pengguna = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_pengguna, 4, 4);
  $urutan++;
  $huruf = "USER";
  $kode_pengguna = $huruf . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_pengguna;
}

function kodeSupplier()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(id_supplier) as kodeTerbesar FROM supplier");
  $data = $query->fetch_assoc();
  $kode_supplier = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_supplier, 2, 4);
  $urutan++;
  $huruf = "PT";
  $kode_supplier = $huruf . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_supplier;
}

function kodeBeban()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(id_beban) as kodeTerbesar FROM beban");
  $data = $query->fetch_assoc();
  $kode_beban = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_beban, 2, 4);
  $urutan++;
  $huruf = "IB";
  $kode_beban = $huruf . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_beban;
}

function kodePrive()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(id_prive) as kodeTerbesar FROM prive");
  $data = $query->fetch_assoc();
  $kode_prive = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_prive, 2, 4);
  $urutan++;
  $huruf = "IP";
  $kode_prive = $huruf . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_prive;
}

function gantiPassword($username, $password)
{
  $db = dbConnect();
  $password = password_hash($password, PASSWORD_DEFAULT);
  $res = mysqli_query($db, "UPDATE pengguna SET password = '$password' WHERE username = '$username'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getAllPelanggan()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBarang()
{
  $db = dbConnect();
  $res = mysqli_query($db, "select * from barang, barang_masuk, supplier where barang.id_barang = barang_masuk.id_barang AND supplier.id_supplier = barang_masuk.id_supplier");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBeban()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM beban ORDER BY tanggal DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllPrive()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM prive ORDER BY tanggal DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllSupplier()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM supplier");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllPengguna()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT *,  SUM(banyak) as jumlahBanyak, subtotal / banyak AS hargaTransaksi FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan GROUP BY no_faktur ORDER BY tanggal DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllTransaksiUtang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM transaksi, pelanggan WHERE pelanggan.id_pelanggan = transaksi.id_pelanggan AND status = 'utang' GROUP BY no_faktur");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getTotalTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(DISTINCT bayar) as totalTransaksi FROM transaksi");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalTransaksi'];
}

function getTotalBarangMasuk()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(bayar) as totalBarangMasuk FROM barang_masuk");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalBarangMasuk'];
}

function getTotalBeban()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(biaya) as totalBeban FROM beban");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalBeban'];
}

function getTotalPrive()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(biaya) as totalPrive FROM prive");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalPrive'];
}

function hitungTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(DISTINCT no_faktur) AS jumlahTransaksi FROM transaksi");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahTransaksi'];
}

function hitungBarang()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(id_barang) AS jumlahBarang FROM barang");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahBarang'];
}

function hitungPelanggan()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(id_pelanggan) AS jumlahPelanggan FROM pelanggan");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahPelanggan'];
}

function hitungSupplier()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(id_supplier) AS jumlahSupplier FROM supplier");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahSupplier'];
}

function getAllBarangMasuk()
{
  $db = dbConnect();
  $res = $db->query("SELECT *, SUM(banyak) as jumlahBanyak FROM barang_masuk bm JOIN supplier s ON bm.id_supplier = s.id_supplier GROUP BY no_barang_masuk ORDER BY tanggal_beli DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBarangMasukUtang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM barang_masuk, barang, supplier WHERE barang.id_barang = barang_masuk.id_barang AND supplier.id_supplier = barang_masuk.id_supplier AND status = 'utang' GROUP BY no_barang_masuk");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getGroupBarang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM barang GROUP BY nama_barang");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}



function getJumlahBarang()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(stok) AS jumlah_barang FROM barang GROUP BY nama_barang");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getGroupTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT tanggal AS tanggal_transaksi FROM transaksi GROUP BY tanggal");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getJumlahTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(no_faktur) AS jumlah_transaksi FROM transaksi GROUP BY tanggal");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getBarangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function getTransaksiUtangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM transaksi WHERE no_faktur = '$id' AND status = 'utang'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function getBarangMasukUtangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM barang_masuk WHERE no_barang_masuk = '$id' AND status = 'utang'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getBebanById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM beban WHERE id_beban = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPriveById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM prive WHERE id_prive = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function getPengirimanById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengiriman WHERE no_surat_jalan = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getSupplierById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM supplier WHERE id_supplier = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getTransaksiById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT *, SUM(banyak) as jumlahBanyak, subtotal / banyak AS hargaTransaksi FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan  WHERE no_faktur = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function insertDataBarang($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO barang VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_barang'], $data['nama_barang'], $data['beli'], $data['stok']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataBeban($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO beban VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_beban'], $data['nama_beban'], $data['tanggal'], $data['biaya']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataPrive($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO prive VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_prive'], $data['nama_prive'], $data['tanggal'], $data['biaya']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataSupplier($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO supplier VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_supplier'], $data['nama_supplier'], $data['telepon_supplier'], $data['alamat_supplier']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataPelanggan($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO pelanggan VALUES (?, ?)");
  $res->bind_param("ss", $data['id_pelanggan'], $data['nama_pelanggan']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataPengguna($data)
{
  $db = dbConnect();
  $password = password_hash($data['password'], PASSWORD_DEFAULT);
  $res = $db->prepare("INSERT INTO pengguna VALUES (?, ?, ?, ?, ?)");
  $res->bind_param("sssss", $data['id_pengguna'], $data['username'], $password, $data['role'], $data['nama']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataBarang($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE barang SET nama_barang=?, harga_jual=? WHERE id_barang=?");
  $res->bind_param("sss",  $data['nama_barang'], $data['harga_jual'], $data['id_barang']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataPrive($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE prive SET nama_prive=?, tanggal=?, biaya=? WHERE id_prive=?");
  $res->bind_param("ssss",  $data['nama_prive'], $data['tanggal'], $data['biaya'], $data['id_prive']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataSupplier($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE supplier SET nama_supplier=?, telepon_supplier=?, alamat_supplier=? WHERE id_supplier=?");
  $res->bind_param("ssss",  $data['nama_supplier'], $data['telepon_supplier'], $data['alamat_supplier'], $data['id_prive']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataBeban($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE beban SET nama_beban=?, tanggal=?, biaya=? WHERE id_beban=?");
  $res->bind_param("ssss",  $data['nama_beban'], $data['tanggal'], $data['biaya'], $data['id_beban']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataPelanggan($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE pelanggan SET nama_pelanggan=? WHERE id_pelanggan=?");
  $res->bind_param("ss",  $data['nama_pelanggan'],  $data['id_pelanggan']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataPengguna($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE pengguna SET username=?, role=?, nama=?  WHERE id_pengguna=?");
  $res->bind_param("ssss",  $data['username'], $data['role'], $data['nama'],   $data['id_pengguna']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}


function getDeleteBarang($id_barang, $no_barang_masuk)
{
  $db = dbConnect();
  $res1 = mysqli_query($db, "DELETE FROM barang_masuk WHERE no_barang_masuk = '$no_barang_masuk'");
  if ($res1) {
    $res2 = mysqli_query($db, "DELETE FROM barang WHERE id_barang = '$id_barang'");
    if ($res2) {
      return 1;
    }
  } else {
    return 0;
  }
  $db->close();
}

function getDeleteBeban($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM beban WHERE id_beban = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeletePrive($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM prive WHERE id_prive = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeleteSupplier($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM supplier WHERE id_supplier = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeletePelanggan($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM pelanggan WHERE id_pelanggan = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeletePengguna($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM pengguna WHERE id_pengguna = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeleteTransaksi($transaksi, $pengiriman)
{
  $db = dbConnect();
  $db->autocommit(FALSE);
  $query_stok = "SELECT id_barang, banyak FROM transaksi WHERE no_faktur = '$transaksi'";
  $result_stok = $db->query($query_stok);
  if ($result_stok->num_rows > 0) {
    // Jika ada data stok barang, tambahkan stok pada tabel barang
    while ($row_stok = $result_stok->fetch_assoc()) {
      $id_barang = $row_stok['id_barang'];
      $banyak = $row_stok['banyak'];
      $query_barang = "UPDATE barang SET stok = stok + $banyak WHERE id_barang = '$id_barang'";
      $result_barang = $db->query($query_barang);
      if (!$result_barang) {
        // Jika gagal memperbarui stok barang, lakukan rollback dan keluar dari fungsi
        $db->rollback();
        $db->close();
        return 0;
      }
    }
  }

  $id_barang = getTransaksiById($transaksi)['id_barang'];
  $banyak = getTransaksiById($transaksi)['banyak'];
  $query1 = "DELETE FROM transaksi WHERE no_faktur = '$transaksi'";
  $result1 = $db->query($query1);
  $query2 = "DELETE FROM pengiriman WHERE no_surat_jalan = '$pengiriman'";
  $result2 = $db->query($query2);


  if ($result1 && $result2) {
    $db->commit();
    $db->close();
    return 1;
  } else {
    $db->rollback();
    $db->close();
    return 0;
  }
}


function getPelangganById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPenggunaById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna WHERE id_pengguna = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPenggunaByUsername($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna WHERE username = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function tombolHapus($id)
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang WHERE id_barang='$id' AND NOT EXISTS (SELECT * FROM transaksi, barang_masuk WHERE transaksi.id_barang = barang.id_barang AND barang_masuk.id_barang = barang.id_barang)";
  $result = mysqli_query($db, $sql);
  $res = $result->num_rows;
  return $res;
  $result->free();
  $db->close();
}

function bisa($db, $query)
{
  $db = mysqli_query($db, $query);

  if ($db) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function convert_to_number($rupiah)
{
  return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
}

function setFlash($pesan, $aksi, $tipe)
{
  $_SESSION['flash'] = [
    'pesan' => $pesan,
    'aksi' => $aksi,
    'tipe' => $tipe
  ];
}

function flash()
{
  if (isset($_SESSION['flash'])) {
    echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
      Data <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    unset($_SESSION['flash']);
  }
}
