<?php
// db Database
include_once "../../functions.php";
$db = dbConnect();
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );

// cari dan tampilkan data ke AutoComplete
// $searchTerm = $_GET['term'];
// $query = $db->query("SELECT * FROM barang WHERE nama_barang LIKE '%" . $searchTerm . "%' ORDER BY nama_barang ASC");
// while ($row = $query->fetch_assoc()) {
//   $data[] = array(
//     'id_barang' => $row['id_barang'],
//     'nama_barang' => $row['nama_barang']
//   );
// }
// echo json_encode($data);


if (isset($_GET['term'])) {
  $searchTerm = mysqli_real_escape_string($db, $_GET['term']);
  $query = "SELECT * FROM barang WHERE nama_barang LIKE '%" . $searchTerm . "%' ORDER BY nama_barang ASC";
  $result = mysqli_query($db, $query);
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
      'id_barang' => $row['id_barang'],
      'nama_barang' => $row['nama_barang'],
      'harga' => $row['harga_jual'],
      'harga_beli' => $row['harga_beli'],
      'stok' => $row['stok']
    );
  }
  echo json_encode($data);
}
