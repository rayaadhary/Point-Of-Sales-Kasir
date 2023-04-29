<?php
include_once "../../functions.php";
session_start();
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
if (isset($_POST['btn-simpan'])) {
  if (insertDataPengguna($_POST) > 0) {
    setFlash('berhasil', 'ditambahkan', 'primary');
    header('Location: ' . BASEURL . '/pages/pengguna/pengguna.php');
    exit;
  } else {
    setFlash('gagal', 'ditambahkan', 'danger');
    header('Location: ' . BASEURL . '/pages/pengguna/pengguna.php');
    exit;
  }
} else {
  header('location:pengguna.php');
}
