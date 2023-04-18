<?php
include_once "../../functions.php";
include_once "../../dist/fpdf/fpdf.php";

$pengirimanId = $_GET['idPengiriman'];
$transaksiId = $_GET['idTransaksi'];
$pengiriman = getPengirimanById($pengirimanId);
$transaksi = getTransaksiById($transaksiId);

$db = dbConnect();
$res = mysqli_query($db, "SELECT * FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan JOIN barang b ON t.id_barang = b.id_barang  WHERE no_faktur = '$transaksiId'");
// $tanggal = date_create($_SESSION['cetak']['tanggal']);
// $jatuh_tempo = date_create($_SESSION['cetak']['jatuh_tempo']);
$tanggal_kirim = date_create($pengiriman['tanggal_kirim']);


$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(200, 5, 'PT AJITA PANEL WIRA PERKASA', 0, 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(200, 5, 'Ruko Summerville no 42 Taman Kopo Indah V Rahayu Margaasih', 0, 1);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetX(130);
$pdf->Cell(200, 10, 'SURAT JALAN', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 5, 'No', 0, 0);
$pdf->Cell(120, 5, ': ' . $pengiriman['no_surat_jalan'], 0, 1);
$pdf->Cell(50, 5, 'Tanggal', 0, 0);
$pdf->Cell(120, 5, ': ' . date_format($tanggal_kirim, "d-m-Y"), 0, 1);
$pdf->Cell(50, 5, 'Telepon', 0, 0);
$pdf->Cell(120, 5, ': 08962742326', 0, 1);
$pdf->Cell(50, 5, 'Pelanggan', 0, 0);
$pdf->Cell(120, 5, ': ' . $transaksi['nama_pelanggan'], 0, 1);
$pdf->Cell(50, 5, 'Alamat', 0, 0);
$pdf->Cell(120, 5, ': ' . $pengiriman['alamat_tujuan'], 0, 1);
$pdf->Ln(5);
$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(30, 5, 'Kode', 1, 0, 'C');
$pdf->Cell(150, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(20, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(20, 5, 'Sub Item', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
// $no =  $_SESSION['cetak']['no'] - 1;
// var_dump($_SESSION['cetak']);
// die;

// var_dump($item['no_faktur']);
// die;
// for ($i = 0; $i < $no; $i++) {
$i = 1;
while ($item = mysqli_fetch_assoc($res)) {
  $pdf->Cell(15, 5, '' . $i, 1, 0, 'C');
  $pdf->Cell(30, 5, '' . $item['id_barang'], 1, 0, 'C');
  $pdf->Cell(150, 5, '' . $item['nama_barang'], 1, 0);
  $pdf->Cell(30, 5, '' . $item['banyak'], 1, 0, 'C');
  $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
  $pdf->Cell(20, 5, '', 1, 1, 'C');
  $i++;
}
$jumlah = 0;
$i = 0;
// while ($i < $no) {
$jumlah += $transaksi['banyak'];
// $i++;
// }
$pdf->Cell(180, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Jumlah', 0, 0);
$pdf->Cell(50, 5, '' . $jumlah, 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(80, 10, 'Tanda', 0, 0, 'C');
$pdf->Cell(80, 10, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(60, 10, 'Pengirim', 0, 0, 'C');
$pdf->Cell(60, 10, 'Penerima', 0, 1, 'C');
$pdf->Cell(80, 30, '', 1, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80, 50, '(   PT AJITA PANEL WIRA PERKASA   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 50, '(                          )', 0, 0, 'C');
$pdf->Cell(60, 50, '(   ' . $transaksi['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->Output();
