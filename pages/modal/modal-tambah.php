<?php
include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
if (isset($_POST['btn-simpan'])) {
  if (insertDataModal($_POST) > 0) {
    setFlash('berhasil', 'ditambahkan', 'primary');
    header('Location: ' . BASEURL . '/pages/modal/modal.php');
    exit;
  } else {
    setFlash('gagal', 'ditambahkan', 'danger');
    header('Location: ' . BASEURL . '/pages/modal/modal.php');
    exit;
  }
} else {
  header('location:modal.php');
}
