<?php
include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
if (isset($_POST['btn-simpan'])) {
  if (updateDataModal($_POST) > 0) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/modal/modal.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/modal/modal.php');
    exit;
  }
} else {
  header('location:modal.php');
}
