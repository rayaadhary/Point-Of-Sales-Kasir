<?php

include_once "../../functions.php";

$db = dbConnect();

if (isset($_POST["update_utang"])) {
  $no_faktur = mysqli_real_escape_string($db, trim($_POST["no_faktur"]));
  $bayar = mysqli_real_escape_string($db, trim($_POST["bayar_baru"]));
  $kembalian = mysqli_real_escape_string($db, trim($_POST["kembalian"]));
  $status = mysqli_real_escape_string($db, trim($_POST["status"]));
  $res = $db->prepare("UPDATE transaksi SET kembali=?, bayar=?, status=? WHERE no_faktur=?");
  $res->bind_param("ssss",  $kembalian, $bayar, $status, $no_faktur);
  $res->execute();
  if ($res) {
    setFlash('berhasil', 'diubah', 'primary');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi-utang.php');
    exit;
  } else {
    setFlash('gagal', 'diubah', 'danger');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi-utang.php');
    exit;
  }
  $db->close();
}
