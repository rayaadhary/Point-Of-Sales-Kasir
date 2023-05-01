<?php

// if (!isset($_SESSION['cetak']["id_pengguna"]))
//   header(
//     "Location: " . BASEURL
//   );
include_once "../../functions.php";
include_once "../../dist/fpdf/fpdf.php";

$tanggal = date_create($_SESSION['cetak']['tanggal']);
$jatuh_tempo = date_create($_SESSION['cetak']['jatuh_tempo']);
$tanggal_kirim = date_create($_SESSION['cetak']['tanggal_kirim']);

$pdf = new FPDF('L', 'mm', array(241.3, 139.7));
$pdf->AddPage();
$pdf->Image('../../dist/img/logo_psm.jpeg', 10, 5, 15);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(150, 10, 'Putra Subur Makmur', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 10, 'FAKTUR', 1, 1, 'C', false);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 10, 'Jl Pameuntasan-Gajah Mekar Kab. Bandung Jawa Barat 40911', 0, 0);
$pdf->Cell(70, 5, '' . $_SESSION['cetak']['no_faktur'], 1, 1, 'C', false);
$pdf->Cell(150, 10, '085863099783', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(35, 5, 'Tanggal', 1, 0, 'C');
$pdf->Cell(35, 5, 'Jatuh Tempo', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 10, '', 0, 0,);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(35, 5, '' . date_format($tanggal, 'd-m-Y'), 1, 0, 'C');
$pdf->Cell(35, 5, '' . date_format($jatuh_tempo, 'd-m-Y'), 1, 1, 'C');
$pdf->Cell(150, 10, '', 0, 0,);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, 'No Surat Jalan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 10, 'Kepada :  ' . $_SESSION['cetak']['nama_pelanggan'], 0, 0,);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, '' . $_SESSION['cetak']['surat_jalan'], 1, 1, 'C');

$pdf->Ln(5);

$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(20, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(40, 5, 'Harga Satuan', 1, 0, 'C');
$pdf->Cell(40, 5, 'Total', 1, 1, 'C'); // Pindah ke baris baru
$pdf->SetFont('Arial', '', 11);
$no =  $_SESSION['cetak']['no'] - 1;
// var_dump($_SESSION['cetak']);
// die;
for ($i = 0; $i < $no; $i++) {
  $pdf->Cell(15, 5, '' . $i + 1, 1, 0, 'C');
  $pdf->Cell(80, 5, '' . $_SESSION['cetak']['nama_barang'][$i], 1, 0);
  $pdf->Cell(30, 5, '' . $_SESSION['cetak']['banyak'][$i], 1, 0, 'C');
  $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
  $pdf->Cell(40, 5, 'Rp. ' . number_format($_SESSION['cetak']['harga'][$i], 2, ',', '.'), 1, 0, 'R');
  $pdf->Cell(40, 5, 'Rp. ' . number_format($_SESSION['cetak']['subtotal'][$i], 2, ',', '.'), 1, 1, 'R'); // Pindah ke baris baru
}
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, 'Tanda Terima', 0, 0, 'C');
$pdf->Cell(60, 5, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->Cell(30, 5, 'Subtotal', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(array_sum($_SESSION['cetak']['subtotal']), 2, ',', '.'), 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Potongan', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format($_SESSION['cetak']['diskon'], 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Total', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format($_SESSION['cetak']['total'] - $_SESSION['cetak']['diskon'], 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Bayar', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format($_SESSION['cetak']['bayar'], 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 5, '(   ' . $_SESSION['cetak']['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, '(   Putra Subur Makmur   )', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Sisa', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format($_SESSION['cetak']['kembalian'], 2, ',', '.'), 0, 1, 'R');
$pdf->AddPage();
$pdf->Image('../../dist/img/logo_psm.jpeg', 10, 5, 15);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(200, 5, 'Putra Subur Makmur', 0, 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(200, 5, 'Jl Pameuntasan-Gajah Mekar Kab. Bandung Jawa Barat 40911', 0, 1);
$pdf->Cell(200, 5, '085863099783', 0, 1);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetX(100);
$pdf->Cell(200, 10, 'SURAT JALAN', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'No', 0, 0);
$pdf->Cell(60, 5, ': ' . $_SESSION['cetak']['surat_jalan'], 0, 0);
$pdf->Cell(50, 5, 'Telepon', 0, 0);
$pdf->Cell(120, 5, ': 08962742326', 0, 1);
$pdf->Cell(50, 5, 'Tanggal', 0, 0);
$pdf->Cell(60, 5, ': ' . date_format($tanggal_kirim, "d-m-Y"), 0, 0);
$pdf->Cell(50, 5, 'Pelanggan', 0, 0);
$pdf->Cell(120, 5, ': ' . $_SESSION['cetak']['nama_pelanggan'], 0, 1);
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Alamat', 0, 0);
$pdf->Cell(120, 5, ': ' . $_SESSION['cetak']['alamat_tujuan'], 0, 0);
$pdf->Ln(5);
$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(30, 5, 'Kode', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(20, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(20, 5, 'Sub Item', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$no =  $_SESSION['cetak']['no'] - 1;
// var_dump($_SESSION['cetak']);
// die;
for ($i = 0; $i < $no; $i++) {
  $pdf->Cell(15, 5, '' . $i + 1, 1, 0, 'C');
  $pdf->Cell(30, 5, '' . $_SESSION['cetak']['idBarang'][$i], 1, 0, 'C');
  $pdf->Cell(80, 5, '' . $_SESSION['cetak']['nama_barang'][$i], 1, 0);
  $pdf->Cell(30, 5, '' . $_SESSION['cetak']['banyak'][$i], 1, 0, 'C');
  $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
  $pdf->Cell(20, 5, '', 1, 1, 'C');
}
$jumlah = 0;
$i = 0;
while ($i < $no) {
  $jumlah += $_SESSION['cetak']['banyak'][$i];
  $i++;
}
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Jumlah', 0, 0);
$pdf->Cell(50, 5, '' . $jumlah, 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(60, 5, 'Pengirim', 0, 0, 'C');
$pdf->Cell(60, 5, 'Penerima', 0, 1, 'C');
$pdf->Cell(30, 30, '', 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 30, '(   Putra Subur Makmur   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 30, '(                          )', 0, 0, 'C');
$pdf->Cell(60, 30, '(   ' . $_SESSION['cetak']['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->Output();
