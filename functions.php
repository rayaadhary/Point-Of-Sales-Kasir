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

function getBarangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function insertDataBarang($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO barang VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_barang'], $data['nama_barang'], $data['harga'], $data['stok']);
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
  $res = $db->prepare("UPDATE barang SET nama_barang=?, harga=?, stok=? WHERE id_barang=?");
  $res->bind_param("ssss",  $data['nama_barang'], $data['harga'], $data['stok'], $data['id_barang']);
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
