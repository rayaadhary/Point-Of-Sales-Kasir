<?php

include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
$db = dbConnect();

if (isset($_POST["update_utang"])) {
  $no_barang_masuk = mysqli_real_escape_string($db, trim($_POST["no_barang_masuk"]));
  // $diskon = mysqli_real_escape_string($db, trim(convert_to_number($_POST["diskon_baru"])));
  $bayar = mysqli_real_escape_string($db, trim(convert_to_number($_POST["bayar_baru"])));
  $kembalian = mysqli_real_escape_string($db, trim(convert_to_number($_POST["kembalian"])));
  $status = mysqli_real_escape_string($db, trim($_POST["status"]));
  $res = $db->prepare("UPDATE barang_masuk SET kembali=?, bayar=?, status=? WHERE no_barang_masuk=?");
  $res->bind_param("ssss",   $kembalian, $bayar, $status, $no_barang_masuk);
  $res->execute();
  if ($res) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/barang-masuk/barang-masuk-utang.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/barang-masuk/barang-masuk-utang.php');
    exit;
  }
  $db->close();
}
