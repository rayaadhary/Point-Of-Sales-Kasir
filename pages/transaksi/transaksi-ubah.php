<?php
include_once "../../functions.php";
if (!isset($_SESSION["id_pengguna"])) {
  header("Location: " . BASEURL);
  exit;
}

$db = dbConnect();

if (isset($_POST['simpan'])) {
  // var_dump($_POST);
  // die;
  $no_faktur = mysqli_real_escape_string($db, trim($_POST['no_faktur']));
  $update_time = date('Y-m-d H:i:s');

  mysqli_begin_transaction($db);
  try {
    foreach ($_POST['idBarang'] as $index => $id_barang) {
      if (empty($id_barang)) continue;

      $banyak = convert_to_number($_POST['banyak'][$index]);
      $diskon = convert_to_number($_POST['diskon'][$index]);
      $subtotal = convert_to_number($_POST['subtotal'][$index]);
      $selisih = convert_to_number($_POST['selisih'][$index]);

      $stokResult = $db->prepare("SELECT stok FROM barang WHERE id_barang = ?");
      $stokResult->bind_param("s", $id_barang);
      $stokResult->execute();
      $stokData = $stokResult->get_result()->fetch_assoc();

      $cekBarang = $db->prepare("SELECT id_transaksi, banyak FROM transaksi WHERE no_faktur = ? AND id_barang = ?");
      $cekBarang->bind_param("ss", $no_faktur, $id_barang);
      $cekBarang->execute();
      $barangResult = $cekBarang->get_result();

      if ($barangResult->num_rows > 0) {
        $found = false;
        while ($existingTransaksi = $barangResult->fetch_assoc()) {
          if ($existingTransaksi['id_transaksi'] == $_POST['idTransaksi'][$index]) {
            $stokSebelumnya = convert_to_number($stokData['stok']) + convert_to_number($existingTransaksi['banyak']);
            $stokUpdate = $stokSebelumnya - $banyak;

            if ($stokUpdate < 0) {
              throw new Exception("Stok tidak mencukupi untuk barang ID: $id_barang");
            }

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

            // $stmtUpdateTransaksi->bind_param(
            //   "ssiiiiiiissiiiss",
            //   $_POST['tanggal'],
            //   $_POST['jatuh_tempo'],
            //   $banyak,
            //   $diskon,
            //   convert_to_number($_POST['totalDiskon']),
            //   $subtotal,
            //   convert_to_number($_POST['total']),
            //   convert_to_number($_POST['bayar']),
            //   convert_to_number($_POST['kembalian']),
            //   $_POST['status'],
            //   $_SESSION['id_pengguna'],
            //   $selisih,
            //   convert_to_number($_POST['totalSelisih']),
            //   convert_to_number($_POST['ongkosKirim']),
            //   $update_time,
            //   $existingTransaksi['id_transaksi']
            // );

            $totalDiskon = convert_to_number($_POST['totalDiskon']);
            $total = convert_to_number($_POST['total']);
            $bayar = convert_to_number($_POST['bayar']);
            $kembalian = convert_to_number($_POST['kembalian']);
            $totalSelisih = convert_to_number($_POST['totalSelisih']);
            $ongkosKirim = convert_to_number($_POST['ongkosKirim']);

            $stmtUpdateTransaksi->bind_param(
              "ssiiiiiiissiiiss",
              $_POST['tanggal'],
              $_POST['jatuh_tempo'],
              $banyak,
              $diskon,
              $totalDiskon,
              $subtotal,
              $total,
              $bayar,
              $kembalian,
              $_POST['status'],
              $_SESSION['id_pengguna'],
              $selisih,
              $totalSelisih,
              $ongkosKirim,
              $update_time,
              $existingTransaksi['id_transaksi']
            );


            $stmtUpdateTransaksi->execute();
            $found = true;
            break;
          }
        }

        if (!$found) {
          $stokUpdate = convert_to_number($stokData['stok']) - $banyak;
          if ($stokUpdate < 0) {
            throw new Exception("Stok tidak mencukupi untuk barang ID: $id_barang");
          }

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
      } else {
        $stokUpdate = convert_to_number($stokData['stok']) - $banyak;
        if ($stokUpdate < 0) {
          throw new Exception("Stok tidak mencukupi untuk barang ID: $id_barang");
        }

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

      $stmtUpdateStock = $db->prepare("UPDATE barang SET stok = ? WHERE id_barang = ?");
      $stmtUpdateStock->bind_param("is", $stokUpdate, $id_barang);
      $stmtUpdateStock->execute();
    }

    mysqli_commit($db);
    $_SESSION['cetak'] = $_POST;
    header('Location: ' . BASEURL . '/pages/transaksi/cetak-transaksi.php');
    exit;
  } catch (Exception $e) {
    mysqli_rollback($db);
    setFlash('gagal', $e->getMessage(), 'danger');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi.php');
    exit;
  }
}
