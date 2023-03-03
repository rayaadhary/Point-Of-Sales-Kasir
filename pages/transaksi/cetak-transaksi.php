<?php

include_once "../../dist/fpdf/fpdf.php";

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(220, 10, 'PT AJITA PANEL WIRA PERKASA', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 10, 'FAKTUR', 1, 0, 'C', false);
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(220, 10, 'Ruko Summerville no 42 Taman Kopo Indah V Rahayu Margaasih', 0, 0,);
$pdf->Cell(50, 10, 'INV.2302.00197', 1, 0, 'C', false);
$pdf->Ln(10);
$pdf->Cell(30, 10, 'NPWP : 73.752.366.2-445.000', 0, 0,);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 10, 'Kepada :  Putra Subur Makmur', 0, 1,);

$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(100, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(15, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(40, 5, 'Harga Satuan', 1, 0, 'C');
$pdf->Cell(15, 5, 'Disc%', 1, 0, 'C');
$pdf->Cell(60, 5, 'Total', 1, 1, 'C'); // Pindah ke baris baru

// Isi data faktur/invoice di sini


$pdf->Output();
