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
$pdf->Cell(15, 5, '' . $_SESSION['cetak']['no'], 1, 0, 'C');
$pdf->Cell(100, 5, '' . $_SESSION['cetak']['nama_barang'], 1, 0);
$pdf->Cell(30, 5, '' . $_SESSION['cetak']['banyak'], 1, 0, 'C');
$pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
$pdf->Cell(50, 5, 'Rp.' . number_format($_SESSION['cetak']['harga'], 2, ',', '.'), 1, 0, 'C');
$pdf->Cell(60, 5, 'Rp.' .  number_format($_SESSION['cetak']['subtotal'], 2, ',', '.'), 1, 1, 'C'); // Pindah ke baris baru

// Isi data faktur/invoice di sini


$pdf->Output();
