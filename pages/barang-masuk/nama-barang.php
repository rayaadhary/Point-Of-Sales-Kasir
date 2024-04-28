<?php
// db Database
include_once "../../functions.php";
$db = dbConnect();
if (!isset($_SESSION["id_pengguna"])) {
  header("Location: " . BASEURL);
  exit(); // pastikan untuk keluar setelah mengirim header Location
}

if (isset($_POST['term'])) {
  $searchTerm = mysqli_real_escape_string($db, $_POST['term']);
  $query = "SELECT * FROM barang WHERE nama_barang LIKE '%" . $searchTerm . "%' ORDER BY nama_barang ASC";
  $result = mysqli_query($db, $query);
  $data = array();
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = array(
        'id_barang' => $row['id_barang'],
        'value' => $row['nama_barang'],
        'harga_beli' => $row['harga_beli'],
        'harga_jual' => $row['harga_jual'],
      );
    }
  } else {
    // Jika sesi belum diinisialisasi
    if (!isset($_SESSION['latest_pelanggan_id'])) {
      // Ambil kode pelanggan terbaru
      $next_id = kodePelanggan();
    } else {
      // Ambil kode pelanggan terbesar dari sesi
      $next_id = $_SESSION['latest_pelanggan_id'];

      // Menambahkannya dengan 1 untuk membuat kode barang yang baru
      $last_number = (int)substr($next_id, 1);
      $next_number = $last_number + 1;

      // Membuat kode barang yang baru dengan format yang diinginkan
      $next_id = 'P' . sprintf("%04s", $next_number);
    }

    // Simpan ID terbaru di sesi
    $_SESSION['latest_pelanggan_id'] = $next_id;

    $data[] = array(
      'id_barang' => $next_id,
      'value' => $searchTerm
    );
  }
  echo json_encode($data);
}
