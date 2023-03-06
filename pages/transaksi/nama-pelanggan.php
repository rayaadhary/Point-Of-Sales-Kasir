<?php
// db Database
include_once "../../functions.php";
$db = dbConnect();

if (isset($_GET['term'])) {
  $searchTerm = mysqli_real_escape_string($db, $_GET['term']);
  $query = "SELECT * FROM pelanggan WHERE nama_pelanggan LIKE '%" . $searchTerm . "%' ORDER BY nama_pelanggan ASC";
  $result = mysqli_query($db, $query);
  $data = array();
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = array(
        'id_pelanggan' => $row['id_pelanggan'],
        'value' => $row['nama_pelanggan']
      );
    }
  } else {
    $data[] = array(
      'id_pelanggan' => kodePelanggan(),
      'value' => $searchTerm
    );
  }
  echo json_encode($data);
  // while ($row = mysqli_fetch_assoc($result)) {
  //   $data[] = array(
  //     'id_pelanggan' => $row['id_pelanggan'],
  //     'value' => $row['nama_pelanggan']
  //   );
  // }
}
