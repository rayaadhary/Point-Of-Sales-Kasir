<?php

include_once "../../functions.php";

$db = dbConnect();

if (isset($_POST['simpan'])) {
  // var_dump($_POST);
  // die;
  $no = $_POST['no'] - 1;
  for ($i = 0; $i < $no; $i++) {
    print_r($_POST['no']);
    $no_faktur = mysqli_real_escape_string($db, trim($_POST['no_faktur']));
    $tanggal = mysqli_real_escape_string($db, trim($_POST['tanggal']));
    $jatuh_tempo = mysqli_real_escape_string($db, trim($_POST['jatuh_tempo']));
    $banyak = mysqli_real_escape_string($db, trim($_POST['banyak'][$i]));
    $diskon = mysqli_real_escape_string($db, trim($_POST['diskon']));
    $subtotal = mysqli_real_escape_string($db, trim($_POST['subtotal'][$i]));
    $total = mysqli_real_escape_string($db, trim($_POST['total']));
    $bayar = mysqli_real_escape_string($db, trim($_POST['bayar']));
    $kembalian = mysqli_real_escape_string($db, trim($_POST['kembalian']));
    // $id_pelanggan = mysqli_real_escape_string($db, trim($_POST['id_pelanggan']));
    $id_barang = mysqli_real_escape_string($db, trim($_POST['idBarang'][$i]));
    $id_pengguna = mysqli_real_escape_string($db, trim($_SESSION['id_pengguna']));

    $query = "INSERT INTO transaksi VALUES ('', '$no_faktur', '$tanggal', '$jatuh_tempo', '$banyak', '$diskon', '$subtotal', '$total', '$bayar', '$kembalian', '1', '$id_barang', '$id_pengguna')";
    $sql = mysqli_query($db, $query);
    if ($sql) {
      setFlash('berhasil', 'ditambahkan', 'primary');
      header('Location: ' . BASEURL . '/pages/transaksi/transaksi.php');
      exit;
    } else {
      setFlash('gagal', 'ditambahkan', 'danger');
      header('Location: ' . BASEURL . '/pages/transaksi/transaksi.php');
      exit;
    }
  }
}