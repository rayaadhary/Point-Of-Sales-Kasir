<?php
include_once "../../functions.php";

if (isset($_POST['btn-simpan'])) {
  if (insertDataBarang($_POST) > 0) {
    setFlash('berhasil', 'ditambahkan', 'primary');
    header('Location: ' . BASEURL . '/pages/barang/barang.php');
    exit;
  } else {
    setFlash('gagal', 'ditambahkan', 'danger');
    header('Location: ' . BASEURL . '/pages/barang/barang.php');
    exit;
  }
} else {
  header('location:barang.php');
}
