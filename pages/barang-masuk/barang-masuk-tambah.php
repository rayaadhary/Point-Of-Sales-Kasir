<?php

include_once "../../dist/fpdf/fpdf.php";
include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
$db = dbConnect();
$db->autocommit(FALSE);

try {
  if (isset($_POST['simpan'])) {
    if (empty($_POST)) {
      throw new Exception("No data submitted");
    }

    $no = $_POST['no'] - 2;

    // Supplier handling
    $id_supplier = mysqli_real_escape_string($db, trim($_POST['id_supplier']));
    $nama_supplier = mysqli_real_escape_string($db, trim($_POST['nama_supplier']));
    $telepon_supplier = mysqli_real_escape_string($db, trim($_POST['telepon_supplier']));
    $alamat_supplier = mysqli_real_escape_string($db, trim($_POST['alamat_supplier']));

    $sql = mysqli_query($db, "SELECT * FROM supplier WHERE id_supplier = '$id_supplier'");
    $ambilSupplier = mysqli_fetch_assoc($sql);

    if ($sql->num_rows > 0) {
      if ($nama_supplier != $ambilSupplier['nama_supplier']) {
        throw new Exception("Nama Supplier tidak sesuai");
      }
    } else {
      if (!mysqli_query($db, "INSERT INTO supplier VALUES ('$id_supplier', '$nama_supplier', '$telepon_supplier', '$alamat_supplier')")) {
        throw new Exception("Error inserting supplier: " . mysqli_error($db));
      }
    }

    // Items handling
    for ($i = 0; $i <= $no; $i++) {
      if (empty($_POST['idBarang'][$i])) continue;

      $id_barang = mysqli_real_escape_string($db, trim($_POST['idBarang'][$i]));
      $nama_barang = mysqli_real_escape_string($db, trim($_POST['nama_barang'][$i]));
      $harga_beli = mysqli_real_escape_string($db, trim(convert_to_number($_POST['harga_beli'][$i])));
      $harga_jual = mysqli_real_escape_string($db, trim(convert_to_number($_POST['harga_jual'][$i])));
      $banyak = mysqli_real_escape_string($db, trim($_POST['banyak'][$i]));

      $cekBarang = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
      $ambilBarang = mysqli_fetch_array($cekBarang);

      if ($cekBarang->num_rows > 0) {
        if ($nama_barang != $ambilBarang['nama_barang']) {
          throw new Exception("ID Barang sudah digunakan");
        }
        $sisaStok = $ambilBarang['stok'] + $banyak;
        if (!mysqli_query($db, "UPDATE barang SET harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$sisaStok' WHERE id_barang = '$id_barang'")) {
          throw new Exception("Error updating barang: " . mysqli_error($db));
        }
      } else {
        if (!mysqli_query($db, "INSERT INTO barang (id_barang, nama_barang, harga_beli, harga_jual, stok) VALUES ('$id_barang', '$nama_barang', '$harga_beli', '$harga_jual', '$banyak')")) {
          throw new Exception("Error inserting barang: " . mysqli_error($db));
        }
      }

      // Insert barang_masuk
      $no_barang_masuk = mysqli_real_escape_string($db, trim($_POST['barang_masuk']));
      $diskon = mysqli_real_escape_string($db, trim(convert_to_number($_POST['diskon'])));
      $subtotal = mysqli_real_escape_string($db, trim(convert_to_number($_POST['subtotal'][$i])));
      $total = mysqli_real_escape_string($db, trim(convert_to_number($_POST['total'])));
      $bersih = $total - $diskon;
      $bayar = mysqli_real_escape_string($db, trim(convert_to_number($_POST['bayar'])));
      $kembalian = mysqli_real_escape_string($db, trim(convert_to_number($_POST['kembalian'])));
      $tanggal_beli = mysqli_real_escape_string($db, trim($_POST['tanggal_beli']));
      $id_pengguna = mysqli_real_escape_string($db, trim($_SESSION['id_pengguna']));
      $status = mysqli_real_escape_string($db, trim($_POST['status']));

      if (!mysqli_query($db, "INSERT INTO barang_masuk (no_barang_masuk, id_barang, banyak, diskon, subtotal, total, bayar, kembali, status, tanggal_beli, id_pengguna, id_supplier, status_enable) VALUES ('$no_barang_masuk', '$id_barang', '$banyak', '$diskon', '$subtotal', '$bersih', '$bayar', '$kembalian', '$status', '$tanggal_beli', '$id_pengguna', '$id_supplier', 'true')")) {
        throw new Exception("Error inserting barang_masuk: " . mysqli_error($db));
      }
    }

    $db->commit();
    $_SESSION['cetak'] = $_POST;
    setFlash('berhasil', 'ditambahkan', 'primary');
    header('Location: ' . BASEURL . '/pages/barang-masuk/barang-masuk.php');
    exit;
  }
} catch (Exception $e) {
  $db->rollback();
  setFlash('gagal', $e->getMessage(), 'danger');
  header('Location: ' . BASEURL . '/pages/barang-masuk/barang-masuk.php');
  exit;
} finally {
  $db->close();
}
