<?php
include_once("../../functions.php");

$id = $_GET['id_pengguna'];

if (getDeletePengguna($id) > 0) {
  setFlash('berhasil', 'dihapus', 'primary');
  header('Location: ' . BASEURL . '/pages/pengguna/pengguna.php');
  exit;
} else {
  setFlash('gagal', 'dihapus', 'danger');
  header('Location: ' . BASEURL . '/pages/pengguna/pengguna.php');
  exit;
}
