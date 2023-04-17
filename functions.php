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
  $urutan = (int) substr($kode_faktur, 7, 3);
  $urutan++;
  $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
  $waktu_formatted = date_format($waktu_formatted, 'dm');
  $huruf = "INV";
  $kode_faktur = $huruf . $waktu_formatted . sprintf("%03s", $urutan);
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


function gantiPassword($username, $password)
{
  $db = dbConnect();
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
  $res = mysqli_query($db, "SELECT * FROM barang");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBeban()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM beban");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllPrive()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM prive");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllTransaksiUtang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM transaksi WHERE status = 'utang' GROUP BY no_faktur");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBarangMasukUtang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM barang_masuk WHERE status = 'utang' GROUP BY no_barang_masuk");
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

function updateDataBarang($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE barang SET nama_barang=?, beli=?, jual=?, stok=? WHERE id_barang=?");
  $res->bind_param("ssss",  $data['nama_barang'], $data['beli'], $data['jual'], $data['stok'], $data['id_barang']);
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


function getDeleteBarang($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM barang WHERE id_barang = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
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

function getPelangganById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan WHERE id = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPenggunaById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna WHERE username = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
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
