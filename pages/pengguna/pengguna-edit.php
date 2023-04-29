<?php
include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
if (isset($_POST['btn-simpan'])) {
  // var_dump($_POST);
  // die;
  if (updateDataPengguna($_POST) > 0) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/pengguna/pengguna.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/pengguna/pengguna.php');
    exit;
  }
} else {
  header('location:pengguna.php');
}
