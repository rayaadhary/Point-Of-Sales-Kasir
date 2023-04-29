 
 <?php
  include_once '../../functions.php';
  session_start();
  if (!isset($_SESSION["id_pengguna"]))
    header(
      "Location: " . BASEURL
    );
  $db = dbConnect();
  if (isset($_POST["no_barang_masuk"])) {
    $no_barang_masuk = mysqli_real_escape_string($db, trim($_POST['no_barang_masuk']));
    $query = $db->query("SELECT * FROM barang_masuk WHERE no_barang_masuk = '" . $no_barang_masuk . "'");
    $data = $query->fetch_array();
    echo json_encode($data);
  }
