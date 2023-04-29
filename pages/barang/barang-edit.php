<?php
include_once "../../functions.php";
session_start();
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
if (isset($_POST['btn-simpan'])) {
  if (updateDataBarang($_POST) > 0) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/barang/barang.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/barang/barang.php');
    exit;
  }
} else {
  header('location:barang.php');
}
