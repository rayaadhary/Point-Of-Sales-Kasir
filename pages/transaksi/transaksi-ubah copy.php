<?php
include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"])) {
  header("Location: " . BASEURL);
  exit;
}

$db = dbConnect();

// var_dump($_POST);
// die;

if (isset($_POST['simpan'])) {
  $no_faktur = mysqli_real_escape_string($db, trim($_POST['no_faktur']));
  $update_time = date('Y-m-d H:i:s');

  // Mulai transaksi database
  mysqli_begin_transaction($db);
  try {
    // Tandai data transaksi sebelumnya dengan timestamp `isupdated`
    $stmt = $db->prepare("UPDATE transaksi SET isupdated = ? WHERE no_faktur = ? AND isupdated IS NULL");
    $stmt->bind_param("ss", $update_time, $no_faktur);
    $stmt->execute();

    // Kembalikan stok untuk transaksi sebelumnya
    $stmt = $db->prepare("SELECT id_barang, banyak FROM transaksi WHERE no_faktur = ? AND isupdated = ?");
    $stmt->bind_param("ss", $no_faktur, $update_time);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($item = $result->fetch_assoc()) {
      $stmtUpdateStock = $db->prepare("UPDATE barang SET stok = stok + ? WHERE id_barang = ?");
      $stmtUpdateStock->bind_param("is", $item['banyak'], $item['id_barang']);
      $stmtUpdateStock->execute();
    }

    // Proses transaksi baru atau update
    foreach ($_POST['idBarang'] as $index => $id_barang) {
      if (empty($id_barang)) continue;

      $banyak = convert_to_number($_POST['banyak'][$index]);
      // var_dump($banyak);
      // die;
      $diskon = convert_to_number($_POST['diskon'][$index]);
      $subtotal = convert_to_number($_POST['subtotal'][$index]);
      $selisih = convert_to_number($_POST['selisih'][$index]);

      // Validasi stok
      $stokResult = $db->prepare("SELECT stok FROM barang WHERE id_barang = ?");
      $stokResult->bind_param("s", $id_barang);
      $stokResult->execute();
      $stokData = $stokResult->get_result()->fetch_assoc();

      // if ($stokData['stok'] < $banyak) {
      //   throw new Exception("Stok tidak mencukupi untuk barang ID: $id_barang");
      // }

      // // Cek apakah ID barang sudah ada di transaksi sebelumnya
      $cekBarang = $db->prepare("SELECT id_transaksi, banyak FROM transaksi WHERE no_faktur = ? AND id_barang = ? AND isupdated IS NOT NULL");
      $cekBarang->bind_param("ss", $no_faktur, $id_barang);
      $cekBarang->execute();
      $barangResult = $cekBarang->get_result();

      if ($barangResult->num_rows > 0) {
        // Update transaksi jika ID barang sudah ada
        $existingTransaksi = $barangResult->fetch_assoc();
        $newBanyak = $banyak - convert_to_number($existingTransaksi['banyak']);
        $stokUpdate = convert_to_number($stokData['stok']) - $newBanyak;
        // var_dump($stokUpdate);
        // die;
        $stmtUpdateTransaksi = $db->prepare("UPDATE transaksi SET 
                tanggal = ?, 
                jatuh_tempo = ?, 
                banyak = ?, 
                diskon = ?, 
                totalDiskon = ?, 
                subtotal = ?, 
                total = ?, 
                bayar = ?, 
                kembali = ?, 
                status = ?, 
                id_pengguna = ?, 
                selisih = ?, 
                totalSelisih = ?, 
                ongkosKirim = ?, 
                isupdated = ? 
            WHERE id_transaksi = ?");
        $stmtUpdateTransaksi->bind_param(
          // "ssiiiiiiissiiisi",
          "ssiiiiiiissiiiss",
          $_POST['tanggal'],
          $_POST['jatuh_tempo'],
          // $newBanyak,
          $banyak,
          $diskon,
          convert_to_number($_POST['totalDiskon']),
          $subtotal,
          convert_to_number($_POST['total']),
          convert_to_number($_POST['bayar']),
          convert_to_number($_POST['kembalian']),
          $_POST['status'],
          $_SESSION['id_pengguna'],
          $selisih,
          convert_to_number($_POST['totalSelisih']),
          convert_to_number($_POST['ongkosKirim']),
          $update_time,
          $existingTransaksi['id_transaksi']
        );
        $stmtUpdateTransaksi->execute();
      } else {
        // Insert transaksi baru jika ID barang belum ada
        $stmtInsert = $db->prepare("INSERT INTO transaksi (
                    no_faktur, tanggal, jatuh_tempo, banyak, diskon, totalDiskon, subtotal, total, bayar, kembali,
                    status, id_pelanggan, id_barang, id_pengguna, no_surat_jalan, selisih, totalSelisih, ongkosKirim, isupdated
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmtInsert->bind_param(
          "sssiiiiiiisssssiiis",
          $no_faktur,
          $_POST['tanggal'],
          $_POST['jatuh_tempo'],
          $banyak,
          $diskon,
          convert_to_number($_POST['totalDiskon']),
          $subtotal,
          convert_to_number($_POST['total']),
          convert_to_number($_POST['bayar']),
          convert_to_number($_POST['kembalian']),
          $_POST['status'],
          $_POST['id_pelanggan'],
          $id_barang,
          $_SESSION['id_pengguna'],
          $_POST['surat_jalan'],
          $selisih,
          convert_to_number($_POST['totalSelisih']),
          convert_to_number($_POST['ongkosKirim']),
          $update_time
        );

        $stmtInsert->execute();
      }

      // Kurangi stok barang
      $stmtUpdateStock = $db->prepare("UPDATE barang SET stok = ? WHERE id_barang = ?");
      $stmtUpdateStock->bind_param("is", $stokUpdate, $id_barang);
      $stmtUpdateStock->execute();
    }

    // Commit transaksi
    mysqli_commit($db);

    // Simpan data untuk cetak transaksi
    $_SESSION['cetak'] = $_POST;

    // Redirect ke halaman cetak
    header('Location: ' . BASEURL . '/pages/transaksi/cetak-transaksi.php');
    exit;
  } catch (Exception $e) {
    // Rollback jika terjadi kesalahan
    mysqli_rollback($db);
    setFlash('gagal', $e->getMessage(), 'danger');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi.php');
    exit;
  }
}
