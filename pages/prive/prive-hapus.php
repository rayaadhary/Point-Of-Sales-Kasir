<?php
include_once("../../functions.php");
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
$id = $_GET['id_prive'];

if (getDeletePrive($id) > 0) {
  setFlash('berhasil', 'dihapus', 'primary');
  header('Location: ' . BASEURL . '/pages/prive/prive.php');
  exit;
} else {
  setFlash('gagal', 'dihapus', 'danger');
  header('Location: ' . BASEURL . '/pages/prive/prive.php');
  exit;
}
