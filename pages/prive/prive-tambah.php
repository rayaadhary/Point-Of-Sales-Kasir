<?php
include_once "../../functions.php";

if (isset($_POST['btn-simpan'])) {
  if (insertDataPrive($_POST) > 0) {
    setFlash('berhasil', 'ditambahkan', 'primary');
    header('Location: ' . BASEURL . '/pages/prive/prive.php');
    exit;
  } else {
    setFlash('gagal', 'ditambahkan', 'danger');
    header('Location: ' . BASEURL . '/pages/prive/prive.php');
    exit;
  }
} else {
  header('location:prive.php');
}
