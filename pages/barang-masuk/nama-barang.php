<?php
// db Database
include_once "../../functions.php";
$db = dbConnect();
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
if (isset($_GET['term'])) {
  $searchTerm = mysqli_real_escape_string($db, $_GET['term']);
  $query = "SELECT * FROM barang WHERE nama_barang LIKE '%" . $searchTerm . "%' ORDER BY nama_barang ASC";
  $result = mysqli_query($db, $query);
  $data = array();
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = array(
        'id_barang' => $row['id_barang'],
        'harga_jual' => $row['harga_jual'],
        'harga_beli' => $row['harga_beli'],
        'value' => $row['nama_barang']
      );
    }
  } else {
    $data[] = array(
      // 'id_barang' => kodePelanggan(),
      'value' => $searchTerm
    );
  }
  echo json_encode($data);
}
