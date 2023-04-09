<?php
include_once("../../functions.php");

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
