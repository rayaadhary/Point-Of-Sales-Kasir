 
 <?php
  include_once '../../functions.php';
  session_start();
  if (!isset($_SESSION["id_pengguna"]))
    header(
      "Location: " . BASEURL
    );
  $db = dbConnect();
  if (isset($_POST["no_faktur"])) {
    $no_faktur = mysqli_real_escape_string($db, trim($_POST['no_faktur']));
    $query = $db->query("SELECT * FROM transaksi WHERE no_faktur = '" . $no_faktur . "'");
    $data = $query->fetch_array();
    echo json_encode($data);
  }
