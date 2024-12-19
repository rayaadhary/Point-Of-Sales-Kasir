<?php

// if (!isset($_SESSION['cetak']["id_pengguna"]))
//   header(
//     "Location: " . BASEURL
//   );
include_once "../../functions.php";
include_once "../../dist/fpdf/fpdf.php";

if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
$pengirimanId = $_GET['idPengiriman'];
$transaksiId = $_GET['idTransaksi'];
$pengiriman = getPengirimanById($pengirimanId);
$transaksi = getTransaksiById($transaksiId);


$db = dbConnect();
$res = mysqli_query($db, "SELECT * FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan JOIN barang b ON t.id_barang = b.id_barang  WHERE no_faktur = '$transaksiId'");

$tanggal = date_create($transaksi['tanggal']);
$jatuh_tempo = date_create($transaksi['jatuh_tempo']);

$pdf = new FPDF('L', 'mm', array(241.3, 139.7));
$pdf->AddPage();
$pdf->Image('../../dist/img/logo_psm.jpeg', 10, 5, 15,);
// $pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(15, 0, '', 0, 0);
$pdf->Cell(150, 0, 'PUTRA SUBUR MAKMUR', 0, 1);
$pdf->SetFont('Arial', 'B',  11);
$pdf->Cell(15, 10, '', 0, 0);
$pdf->Cell(120, 10, 'MELAYANI PARTAI/ECERAN', 0, 0);
$pdf->SetFont('Arial', '',  11);
$pdf->Cell(40, 5, 'Tanggal         : ' . date_format($tanggal, 'd-m-y'), 0, 1,  false);
$pdf->SetFont('Arial', '', 11);
// $pdf->Cell(150, 10, 'Jl Pameuntasan-Gajah Mekar Kab. Bandung Jawa Barat 40911', 0, 0);
$pdf->Cell(135, 10, 'Playwood/Triplek - Perlengkapan Meubel - Bahan Bahan Meubel - Dll', 0, 0);
// $pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, 'Jatuh Tempo : '  . date_format($jatuh_tempo, 'd-m-y'), 0, 1,  false);
$pdf->Cell(135, 10, 'WA : 085863099783 IG : putrasuburmakmur', 0, 0);
$pdf->Cell(70, 5, 'Kepada Yth,     ' . $transaksi['nama_pelanggan'], 0, 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(135, 10, 'Jl Pameuntasan-Gajah Mekar Kab. Bandung Jawa Barat 40911', 0, 0,);
// $pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, 'No Surat Jalan : ' . $pengiriman['no_surat_jalan'], 0, 0);
// $pdf->Cell(35, 5, '' . date_format($jatuh_tempo, 'd-m-y'), 1, 1, 'C');
$pdf->Cell(150, 10, '', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
// $pdf->Cell(70, 5, 'No Surat Jalan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
// $pdf->Cell(150, 10, 'Kepada :  ' . $transaksi['nama_pelanggan'], 0, 0,);
// $pdf->Cell(70, 5, '' . $pengiriman['no_surat_jalan'], 1, 1, 'C');

// $pdf->Ln(5);
$pdf->Cell(150, 5, 'Faktur :  ' . $transaksi['no_faktur'], 0, 1);
$pdf->SetFont('Arial', '', 11);

$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nama Barang', 1, 0);
$pdf->Cell(38, 5, 'Harga', 1, 0, 'C');
$pdf->Cell(15, 5, 'Qty', 1, 0, 'C');
$pdf->Cell(38, 5, 'Diskon', 1, 0, 'C'); // Pindah ke baris baru
$pdf->Cell(38, 5, 'Subtotal', 1, 1, 'C'); // Pindah ke baris baru
$pdf->SetFont('Arial', '', 11);
// var_dump($_SESSION['cetak']);
// die;
// ($_SESSION['cetak']['no'] = 2) ? $no =  $_SESSION['cetak']['no'] - 1 : $no =  $_SESSION['cetak']['no'] - 2;
$i = 1;
$subtotalSum = 0;
while ($item = mysqli_fetch_assoc($res)) {
  $subtotal = str_replace(['Rp. ', '.', ','], '', $item['subtotal']);
  $jumlahTransaksi = (int) str_replace(['Rp. ', '.', ','], '', $item['subtotal']) + (int) convert_to_number($item['diskon']);
  // $subtotalFormatted = number_format((int)$subtotal, 0, ',', '.');
  $subtotalInt = (int) $subtotal; // Pastikan subtotal dalam format angka

  // Jumlahkan subtotal ke subtotalSum
  $subtotalSum += $subtotalInt;

  $subtotalFormatted = number_format($subtotalInt, 2, ',', '.');
  $jumlahTransaksiFormatted = number_format($jumlahTransaksi, 2, ',', '.');

  $pdf->Cell(15, 5, '' . $i, 1, 0, 'C');
  $pdf->Cell(80, 5, '' . $item['nama_barang'], 1, 0);
  $hargaTransaksi = ($item['subtotal'] + $item['diskon']) / $item['banyak'];
  $pdf->Cell(38, 5, 'Rp. ' . number_format(convert_to_number($hargaTransaksi), 2, ',', '.'), 1, 0, 'R');
  $pdf->Cell(15, 5, '' . $item['banyak'], 1, 0, 'C');
  // $pdf->Cell(50, 5, 'Rp. ' . number_format(convert_to_number($item['subtotal'][$i]), 2, ',', '.'), 1, 1, 'R'); // Pindah ke baris baru
  $pdf->Cell(38, 5,  'Rp. ' . number_format(convert_to_number($item['diskon']), 2, ',', '.'), 1, 0, 'R');
  $pdf->Cell(38, 5,  'Rp. ' . $subtotalFormatted, 1, 1, 'R');
  $i++;
}
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, 'Tanda Terima', 0, 0, 'C');
$pdf->Cell(60, 5, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->Cell(30, 5, 'Jumlah', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . $jumlahTransaksiFormatted, 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Total Diskon', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($transaksi['totalDiskon']), 2, ',', '.'), 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Ongkos Kirim', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($transaksi['ongkosKirim']), 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Total', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($transaksi['total']), 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Bayar', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($transaksi['bayar']), 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 5, '(   ' . $transaksi['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, '(   Putra Subur Makmur   )', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Kembali', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($transaksi['kembali']), 2, ',', '.'), 0, 1, 'R');
$pdf->Output();