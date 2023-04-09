<?php

include_once "../../dist/fpdf/fpdf.php";
include_once "../../functions.php";

$db = dbConnect();

if (isset($_POST['simpan'])) {
  // var_dump($_POST);
  // die;
  if (empty($_POST)) {
    setFlash('gagal', 'ditambahkan', 'danger');
    header('Location: ' . BASEURL . '/pages/barang-masuk/barang-masuk.php');
    exit;
  }
  // operasi INSERT ke database
  else {
    $no =  $_POST['no'] - 1;
    $id_supplier = mysqli_real_escape_string($db, trim($_POST['id_supplier']));
    $nama_supplier = mysqli_real_escape_string($db, trim($_POST['nama_supplier']));
    $telepon_supplier = mysqli_real_escape_string($db, trim($_POST['telepon_supplier']));
    $sql = mysqli_query($db, "SELECT id_supplier FROM pelanggan WHERE id_supplier = '$id_supplier'");
    if ($sql->num_rows == 0) {
      $query = "INSERT INTO supplier VALUES ('$id_supplier', '$nama_supplier', '$telepon_supplier')";
      $sql = mysqli_query($db, $query);
    }
    $surat_jalan = mysqli_real_escape_string($db, trim($_POST['surat_jalan']));
    $alamat_tujuan = mysqli_real_escape_string($db, trim($_POST['alamat_tujuan']));
    $tanggal_kirim = mysqli_real_escape_string($db, trim($_POST['tanggal_kirim']));
    $telepon = mysqli_real_escape_string($db, trim($_POST['telepon']));
    $sql = mysqli_query($db, "INSERT INTO pengiriman VALUES ('$surat_jalan', '$alamat_tujuan', '$tanggal_kirim', '$telepon')");
    for ($i = 0; $i < $no; $i++) {
      print_r($_POST['no']);
      $no_faktur = mysqli_real_escape_string($db, trim($_POST['no_faktur']));
      $tanggal = mysqli_real_escape_string($db, trim($_POST['tanggal']));
      $jatuh_tempo = mysqli_real_escape_string($db, trim($_POST['jatuh_tempo']));
      $banyak = mysqli_real_escape_string($db, trim($_POST['banyak'][$i]));
      $diskon = mysqli_real_escape_string($db, trim($_POST['diskon']));
      $subtotal = mysqli_real_escape_string($db, trim($_POST['subtotal'][$i]));
      $total = mysqli_real_escape_string($db, trim($_POST['total']));
      $bersih = $total - $diskon;
      $bayar = mysqli_real_escape_string($db, trim($_POST['bayar']));
      $kembalian = mysqli_real_escape_string($db, trim($_POST['kembalian']));
      // $kembalian = abs($kembalian);
      $id_barang = mysqli_real_escape_string($db, trim($_POST['idBarang'][$i]));
      $id_pengguna = mysqli_real_escape_string($db, trim($_SESSION['id_pengguna']));
      $status = mysqli_real_escape_string($db, trim($_POST['status']));

      // mengurangi stok barang
      $cekBarang = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
      $ambilStok = mysqli_fetch_array($cekBarang);
      $stok = $ambilStok['stok'];
      $sisaStok = $stok - $banyak;
      if ($stok < $banyak) {
        setFlash('gagal', 'stok kurang', 'danger');
        header('Location: ' . BASEURL . '/pages/transaksi/transaksi.php');
        exit;
      } else {
        // eksekusi query
        $stok = mysqli_query($db, "UPDATE barang SET stok='$sisaStok' WHERE id_barang = '$id_barang'");
        $query = "INSERT INTO transaksi VALUES ('', '$no_faktur', '$tanggal', '$jatuh_tempo', '$banyak', '$diskon', '$subtotal', '$bersih', '$bayar', '$kembalian', '$status', '$id_pelanggan', '$id_barang', '$id_pengguna', '$surat_jalan')";
        $sql = mysqli_query($db, $query);
      }
    }
    if ($sql) {
      $_SESSION['cetak'] = $_POST;
      // setFlash('berhasil', 'ditambahkan', 'primary');
      header('Location: ' . BASEURL . '/pages/transaksi/cetak-transaksi.php');
      exit;
    }
  }
}