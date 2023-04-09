<?php
include_once "../../functions.php";

if (isset($_POST['btn-simpan'])) {
  if (updateDataPrive($_POST) > 0) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/prive/prive.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/prive/prive.php');
    exit;
  }
} else {
  header('location:prive.php');
}
