<?php
// Koneksi Database
include_once "../../functions.php";
$db = dbConnect();

// cari dan tampilkan data ke AutoComplete
$searchTerm = $_GET['term'];
$query = $db->query("SELECT * FROM barang WHERE nama_barang LIKE '%" . $searchTerm . "%' ORDER BY nama_barang ASC");
while ($row = $query->fetch_assoc()) {
  $data[] = $row['nama_barang'];
}
echo json_encode($data);
