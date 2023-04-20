<?php

include_once "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$data = getPenggunaByUsername($username);

if (isset($_POST["btn_login"])) {
  if (password_verify($password, $data['password'])) {
    // if ($password == $data['password']) {
    $_SESSION['role'] = 'pemilik' || 'karyawan';
    $_SESSION['username'] = $data['username'];
    $_SESSION['id_pengguna'] = $data['id_pengguna'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];
    setFlash("berhasil", "login", "success");
    header('Location: ' . BASEURL . '/dashboard.php');
    //jika rememberme di klik
    if (!empty($_POST["remember"])) {
      //buat cookie
      setcookie("username", $_POST["username"], time() + (3600 * 365 * 24 * 60 * 60));
      setcookie("password", $_POST["password"], time() + (3600 * 365 * 24 * 60 * 60));
    } else {
      if (isset($_COOKIE["username"])) {
        setcookie("username", "");
      }
      if (isset($_COOKIE["password"])) {
        setcookie("password", "");
      }
    }
    // }
  } else {
    setFlash("gagal", "login", "danger");
    header('location:index.php');
  }
} else {
  header('location:index.php');
}
