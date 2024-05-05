<?php
include_once '../../functions.php';
if (!isset($_SESSION["id_pengguna"]))
  header("Location: " . BASEURL);
if (isset($_POST['tahun'])) {
  $tahun = $_POST['tahun'];
  $db = dbConnect();
  $query = "SELECT 
    bulan,
    totalSelisih,
    beban,
    (totalSelisih) - (beban) AS total
FROM (
    SELECT 
        MONTH(t1.tanggal) AS bulan,
        SUM(t1.totalSelisih) AS totalSelisih,
        (SELECT SUM(biaya) FROM beban WHERE MONTH(beban.tanggal) 
        = MONTH(t1.tanggal)) AS beban
    FROM 
        (SELECT DISTINCT no_faktur, totalSelisih, tanggal FROM transaksi) AS t1 
    WHERE 
        YEAR(t1.tanggal) = '$tahun'
    GROUP BY 
        MONTH(t1.tanggal)
) AS subquery
GROUP BY 
    bulan
ORDER BY 
    bulan;";
  $res = mysqli_query($db, $query);
  $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
  mysqli_free_result($res);
  mysqli_close($db);
  echo json_encode($data);
}
