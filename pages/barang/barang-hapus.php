<?php
include_once("../../functions.php");
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );

$id_barang = $_GET['id_barang'];
$no_barang_masuk = $_GET['no_barang_masuk'];

if (getDeleteBarang($id_barang, $no_barang_masuk) > 0) {
  setFlash('berhasil', 'dihapus', 'primary');
  header('Location: ' . BASEURL . '/pages/barang/barang.php');
  exit;
} else {
  setFlash('gagal', 'dihapus', 'danger');
  header('Location: ' . BASEURL . '/pages/barang/barang.php');
  exit;
}
