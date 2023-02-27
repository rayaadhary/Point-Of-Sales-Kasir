<?php

include_once "functions.php";

$usernameBaru = $_POST['username'];
$passwordBaru = $_POST['password'];
$konfirmasiPassword = $_POST['konfirmasi'];

if (isset($_POST['btn_password'])) {
  if ($passwordBaru == $konfirmasiPassword) {
    if (gantiPassword($usernameBaru, $passwordBaru) > 0) {
      setFlash('berhasil', 'diubah', 'success');
      header('Location: ' . BASEURL);
      exit;
    } else {
      setFlash('gagal', 'diubah', 'danger');
      header('Location: ' . BASEURL . '/formUbahPassword.php');
      exit;
    }
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/formUbahPassword.php');
    exit;
  }
} else {
  header('Location: ' . BASEURL . '/formUbahPassword.php');
}
