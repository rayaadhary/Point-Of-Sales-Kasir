<?php

include_once "../../functions.php";
include_once "../../dist/fpdf/fpdf.php";

$pengirimanId = $_GET['idPengiriman'];
$transaksiId = $_GET['idTransaksi'];
$pengiriman = getPengirimanById($pengirimanId);
$transaksi = getTransaksiById($transaksiId);


$db = dbConnect();
$res = mysqli_query($db, "SELECT * FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan JOIN barang b ON t.id_barang = b.id_barang  WHERE no_faktur = '$transaksiId'");

$tanggal = date_create($transaksi['tanggal']);
$jatuh_tempo = date_create($transaksi['jatuh_tempo']);

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'PT AJITA PANEL WIRA PERKASA', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 10, 'FAKTUR', 1, 1, 'C', false);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(200, 10, 'Ruko Summerville no 42 Taman Kopo Indah V Rahayu Margaasih', 0, 0);
$pdf->Cell(70, 5, '' . $transaksi['no_faktur'], 1, 1, 'C', false);
$pdf->Cell(200, 10, '', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(35, 5, 'Tanggal', 1, 0, 'C');
$pdf->Cell(35, 5, 'Jatuh Tempo', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(200, 10, '', 0, 0,);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(35, 5, '' . date_format($tanggal, 'd-m-Y'), 1, 0, 'C');
$pdf->Cell(35, 5, '' . date_format($jatuh_tempo, 'd-m-Y'), 1, 1, 'C');
$pdf->Cell(200, 10, '', 0, 0,);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, 'No Surat Jalan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 10, 'Kepada :  ' . $transaksi['nama_pelanggan'], 0, 0,);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, '' . $pengiriman['no_surat_jalan'], 1, 1, 'C');

$pdf->Ln(5);

$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(100, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(20, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(50, 5, 'Harga Satuan', 1, 0, 'C');
$pdf->Cell(60, 5, 'Total', 1, 1, 'C'); // Pindah ke baris baru
$pdf->SetFont('Arial', '', 11);
// $no =  $_SESSION['cetak']['no'] - 1;
// var_dump($_SESSION['cetak']);
// die;

// function harga_saat_transaksi($db, $transaksiId)
// {
//   $harga = 0;
//   $res = mysqli_query($db, "SELECT * FROM transaksi WHERE no_faktur = '$transaksiId'");
//   while ($item = mysqli_fetch_assoc($res)) {
//     $harga = $item['subtotal'] / $item['banyak'];
//   }
//   return $harga;
// }

// function jumlah_subtotal($db, $transaksiId)
// {
//   $jumlah = 0;
//   $res = mysqli_query($db, "SELECT * FROM transaksi WHERE no_faktur = '$transaksiId'");
//   while ($item = mysqli_fetch_assoc($res)) {
//     $jumlah += $item['subtotal'];
//   }
//   return $jumlah;
// }

// $harga = harga_saat_transaksi($db, $transaksiId);
// $jumlah = jumlah_subtotal($db, $transaksiId);

$i = 1;
while ($item = mysqli_fetch_assoc($res)) {
  $pdf->Cell(15, 5, '' . $i, 1, 0, 'C');
  $pdf->Cell(100, 5, '' . $item['nama_barang'], 1, 0);
  $pdf->Cell(30, 5, '' . $item['banyak'], 1, 0, 'C');
  $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
  $pdf->Cell(50, 5, 'Rp. ' . number_format($item['hargaTransaksi'], 2, ',', '.'), 1, 0, 'R');
  $pdf->Cell(60, 5, 'Rp. ' . number_format($item['subtotal'], 2, ',', '.'), 1, 1, 'R'); // Pindah ke baris baru
  $i++;
}



$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, 'Tanda Terima', 0, 0, 'C');
$pdf->Cell(60, 5, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->Cell(50, 5, 'Subtotal', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, 'Rp. ' . number_format($transaksi['jumlahBanyak'], 2, ',', '.'), 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Potongan', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, 'Rp. ' . number_format($transaksi['diskon'], 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Total', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, 'Rp. ' . number_format($transaksi['total'] - $transaksi['diskon'], 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Bayar', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, 'Rp. ' . number_format($transaksi['bayar'], 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 5, '(   ' . $transaksi['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, '(   PT AJITA PANELWIRA PERKASA   )', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Sisa', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, 'Rp. ' . number_format($transaksi['kembali'], 2, ',', '.'), 0, 1, 'R');
$pdf->Output();
