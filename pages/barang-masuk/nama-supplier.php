<?php
// db Database
include_once "../../functions.php";
$db = dbConnect();

if (isset($_GET['term'])) {
  $searchTerm = mysqli_real_escape_string($db, $_GET['term']);
  $query = "SELECT * FROM supplier WHERE nama_supplier LIKE '%" . $searchTerm . "%' ORDER BY nama_supplier ASC";
  $result = mysqli_query($db, $query);
  $data = array();
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = array(
        'id_supplier' => $row['id_supplier'],
        'value' => $row['nama_supplier']
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
