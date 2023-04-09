<?php
include_once("../../functions.php");

$id = $_GET['id_beban'];

if (getDeleteBeban($id) > 0) {
  setFlash('berhasil', 'dihapus', 'primary');
  header('Location: ' . BASEURL . '/pages/beban/beban.php');
  exit;
} else {
  setFlash('gagal', 'dihapus', 'danger');
  header('Location: ' . BASEURL . '/pages/beban/beban.php');
  exit;
}
