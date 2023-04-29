<?php
include_once("../../functions.php");
session_start();
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
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
