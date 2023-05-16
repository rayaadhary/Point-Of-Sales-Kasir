<?php
include_once '../../functions.php';
if (!isset($_SESSION["id_pengguna"]))
  header("Location: " . BASEURL);
if (isset($_POST['tahun'])) {
  $tahun = $_POST['tahun'];
  $db = dbConnect();
  $query = "SELECT MONTH(t.tanggal) AS bulan, SUM(DISTINCT t.totalSelisih) AS totalSelisih, SUM(DISTINCT b.biaya) AS beban, SUM(DISTINCT t.totalSelisih) - SUM(DISTINCT b.biaya) AS total
FROM transaksi t
JOIN beban b ON MONTH(t.tanggal) = MONTH(b.tanggal)
WHERE YEAR(t.tanggal) = '$tahun'
GROUP BY MONTH(t.tanggal)
ORDER BY MONTH(t.tanggal)";
  $res = mysqli_query($db, $query);
  $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
  mysqli_free_result($res);
  mysqli_close($db);
  echo json_encode($data);
}
