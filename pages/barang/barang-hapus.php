<?php
include_once("../../functions.php");

$id = $_GET['id_barang'];

if (getDeleteBarang($id) > 0) {
  setFlash('berhasil', 'dihapus', 'success');
  header('Location: ' . BASEURL . '/pages/barang/barang.php');
  exit;
} else {
  setFlash('gagal', 'dihapus', 'danger');
  header('Location: ' . BASEURL . '/pages/barang/barang.php');
  exit;
}
