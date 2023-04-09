<?php
include_once "../../functions.php";

if (isset($_POST['btn-simpan'])) {
  if (updateDataBeban($_POST) > 0) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/beban/beban.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/beban/beban.php');
    exit;
  }
} else {
  header('location:beban.php');
}
