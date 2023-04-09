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
    // var_dump($_POST);
    // die;
    $no =  $_POST['no'] - 1;
    $id_supplier = mysqli_real_escape_string($db, trim($_POST['id_supplier']));
    $nama_supplier = mysqli_real_escape_string($db, trim($_POST['nama_supplier']));
    $telepon_supplier = mysqli_real_escape_string($db, trim($_POST['telepon_supplier']));
    $sql = mysqli_query($db, "SELECT id_supplier FROM supplier WHERE id_supplier = '$id_supplier'");
    if ($sql->num_rows == 0) {
      $query = "INSERT INTO supplier VALUES ('$id_supplier', '$nama_supplier', '$telepon_supplier')";
      $sql = mysqli_query($db, $query);
    }

    // $surat_jalan = mysqli_real_escape_string($db, trim($_POST['surat_jalan']));
    // $alamat_tujuan = mysqli_real_escape_string($db, trim($_POST['alamat_tujuan']));
    // $tanggal_kirim = mysqli_real_escape_string($db, trim($_POST['tanggal_kirim']));
    // $telepon = mysqli_real_escape_string($db, trim($_POST['telepon']));
    // $sql = mysqli_query($db, "INSERT INTO pengiriman VALUES ('$surat_jalan', '$alamat_tujuan', '$tanggal_kirim', '$telepon')");


    for ($i = 0; $i < $no; $i++) {
      print_r($_POST['no']);
      $no_barang_masuk = mysqli_real_escape_string($db, trim($_POST['barang_masuk']));
      $harga_beli = mysqli_real_escape_string($db, trim($_POST['harga_beli'][$i]));
      $harga_jual = mysqli_real_escape_string($db, trim($_POST['harga_jual'][$i]));
      $tanggal_beli = mysqli_real_escape_string($db, trim($_POST['tanggal_beli']));
      $banyak = mysqli_real_escape_string($db, trim($_POST['banyak'][$i]));
      $diskon = mysqli_real_escape_string($db, trim($_POST['diskon']));
      $subtotal = mysqli_real_escape_string($db, trim($_POST['subtotal'][$i]));
      $total = mysqli_real_escape_string($db, trim($_POST['total']));
      $bersih = $total - $diskon;
      $bayar = mysqli_real_escape_string($db, trim($_POST['bayar']));
      $kembalian = mysqli_real_escape_string($db, trim($_POST['kembalian']));
      // $kembalian = abs($kembalian);
      $id_barang = mysqli_real_escape_string($db, trim($_POST['idBarang'][$i]));
      $nama_barang = mysqli_real_escape_string($db, trim($_POST['nama_barang'][$i]));
      $id_pengguna = mysqli_real_escape_string($db, trim($_SESSION['id_pengguna']));
      $status = mysqli_real_escape_string($db, trim($_POST['status']));
      $cekBarang = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
      $ambilBarang = mysqli_fetch_array($cekBarang);
      $stok = $ambilBarang['stok'];
      $sisaStok = $stok + $banyak;
      if ($cekBarang->num_rows > 0) {
        $stok = mysqli_query($db, "UPDATE barang SET harga_beli='$harga_beli',harga_jual='$harga_jual',  stok='$sisaStok' WHERE id_barang = '$id_barang'");
      } else {
        $barang = mysqli_query($db, "INSERT INTO barang VALUES ('$id_barang', '$nama_barang', '$harga_beli', '$harga_jual', '$banyak')");
      }
      $query = "INSERT INTO barang_masuk VALUES ('', '$no_barang_masuk', '$id_barang', '$banyak', '$diskon', '$subtotal', '$bersih', '$bayar', '$kembalian', '$status', '$tanggal_beli', '$id_pengguna', '$id_supplier')";
      $sql = mysqli_query($db, $query);
      // }
    }
    if ($sql) {
      $_SESSION['cetak'] = $_POST;
      // setFlash('berhasil', 'ditambahkan', 'primary');
      // header('Location: ' . BASEURL . '/pages/barang-masuk/cetak-barang-masuk.php');
      header('Location: ' . BASEURL . '/pages/barang-masuk/barang-masuk.php');
      exit;
    }
  }
}
