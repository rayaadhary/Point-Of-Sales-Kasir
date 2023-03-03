<?php

include_once "../../dist/fpdf/fpdf.php";
include_once "../../functions.php";

$db = dbConnect();

if (isset($_POST['simpan'])) {
  var_dump($_POST);
  die;
  if (empty($_POST['no_faktur']) || empty($_POST['tanggal']) || empty($_POST['jatuh_tempo']) || empty($_POST['banyak']) || empty($_POST['subtotal']) || empty($_POST['total']) || empty($_POST['bayar']) || empty($_POST['kembalian']) || empty($_POST['idBarang']) || empty($_SESSION['id_pengguna'])) {
    setFlash('gagal', 'ditambahkan', 'danger');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi.php');
    exit;
  }
  // operasi INSERT ke database
  else {

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
        $_SESSION['cetak'] = [
          'no' => $no,
          'no_faktur' => $no_faktur,
          'nama_barang' => $_POST['nama_barang'][$i],
          'harga' => $_POST['harga'][$i],
          'tanggal' => $tanggal,
          'jatuh_tempo' => $jatuh_tempo,
          'banyak' => $banyak,
          'diskon' => $diskon,
          'subtotal' => $subtotal,
          'total' => $total,
          'bayar' => $bayar,
          'kembalian' => $kembalian,
          'id_barang' => $id_barang,
          'id_pengguna' => $id_pengguna
        ];
        // setFlash('berhasil', 'ditambahkan', 'primary');
        header('Location: ' . BASEURL . '/pages/transaksi/cetak-transaksi.php');
        exit;
      }
    }
  }
}
