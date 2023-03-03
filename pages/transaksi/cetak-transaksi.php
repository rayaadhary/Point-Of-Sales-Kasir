<?php

include_once "../../functions.php";
include_once "../../dist/fpdf/fpdf.php";

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'PT AJITA PANEL WIRA PERKASA', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 10, 'FAKTUR', 1, 1, 'C', false);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(200, 10, 'Ruko Summerville no 42 Taman Kopo Indah V Rahayu Margaasih', 0, 0);
$pdf->Cell(70, 5, 'INV.2302.00197', 1, 1, 'C', false);
$pdf->Cell(200, 10, '', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(35, 5, 'Tanggal', 1, 0, 'C');
$pdf->Cell(35, 5, 'Jatuh Tempo', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(200, 10, '', 0, 0,);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(35, 5, '' . $_SESSION['cetak']['tanggal'], 1, 0, 'C');
$pdf->Cell(35, 5, '' . $_SESSION['cetak']['jatuh_tempo'], 1, 1, 'C');
$pdf->Cell(200, 10, '', 0, 0,);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, 'No Surat Jalan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 10, 'Kepada :  Putra Subur Makmur', 0, 0,);
$pdf->Cell(70, 5, '', 1, 1);

$pdf->Ln(5);

$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(100, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(20, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(50, 5, 'Harga Satuan', 1, 0, 'C');
$pdf->Cell(60, 5, 'Total', 1, 1, 'C'); // Pindah ke baris baru
$pdf->SetFont('Arial', '', 11);
$no =  $_SESSION['cetak']['no'] - 1;
var_dump($_SESSION['cetak']);
die;
for ($i = 0; $i < $no; $i++) {
  $pdf->Cell(15, 5, '' . $i + 1, 1, 0, 'C');
  $pdf->Cell(100, 5, '' . $_SESSION['cetak']['nama_barang'][$i], 1, 0);
  $pdf->Cell(30, 5, '' . $_SESSION['cetak']['banyak'][$i], 1, 0, 'C');
  $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
  $pdf->Cell(50, 5, 'Rp. ' . number_format($_SESSION['cetak']['harga'][$i], 2, ',', '.'), 1, 0, 'R');
  $pdf->Cell(60, 5, 'Rp. ' . number_format($_SESSION['cetak']['subtotal'][$i], 2, ',', '.'), 1, 1, 'R'); // Pindah ke baris baru
}
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, 'Tanda Terima', 0, 0, 'C');
$pdf->Cell(60, 5, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->Cell(50, 5, 'Subtotal', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, 'Rp.' . number_format($_SESSION['cetak']['total'], 2, ',', '.'), 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Potongan', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Total', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Bayar', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 5, '(   Putra Subur Makmur   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, '(   PT AJITA PANELWIRA PERKASA   )', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'Sisa', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'R');
$pdf->Output();
