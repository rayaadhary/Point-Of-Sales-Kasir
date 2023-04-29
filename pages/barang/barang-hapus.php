<?php
include_once("../../functions.php");
session_start();
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );

$id = $_GET['id_barang'];

if (getDeleteBarang($id) > 0) {
  setFlash('berhasil', 'dihapus', 'primary');
  header('Location: ' . BASEURL . '/pages/barang/barang.php');
  exit;
} else {
  setFlash('gagal', 'dihapus', 'danger');
  header('Location: ' . BASEURL . '/pages/barang/barang.php');
  exit;
}
