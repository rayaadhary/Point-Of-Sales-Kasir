<?php
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
// $tanggal = date_create($_SESSION['cetak']['tanggal']);
// $jatuh_tempo = date_create($_SESSION['cetak']['jatuh_tempo']);
$tanggal_kirim = date_create($pengiriman['tanggal_kirim']);


$pdf = new FPDF('L', 'mm', array(241.3, 139.7));
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
$pdf->Cell(50, 5, 'No', 0, 0);
$pdf->Cell(60, 5, ': ' . $pengiriman['no_surat_jalan'], 0, 0);
$pdf->Cell(50, 5, 'Telepon', 0, 0);
$pdf->Cell(120, 5, ': 08962742326', 0, 1);
$pdf->Cell(50, 5, 'Tanggal', 0, 0);
$pdf->Cell(60, 5, ': ' . date_format($tanggal_kirim, "d-m-Y"), 0, 0);
$pdf->Cell(50, 5, 'Pelanggan', 0, 0);
$pdf->Cell(120, 5, ': ' . $transaksi['nama_pelanggan'], 0, 1);
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Alamat', 0, 0);
$pdf->Cell(120, 5, ': ' . $pengiriman['alamat_tujuan'], 0, 1);
$pdf->Ln(5);
$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(30, 5, 'Kode', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nama Barang', 1, 0);
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
  $pdf->Cell(80, 5, '' . $item['nama_barang'], 1, 0);
  $pdf->Cell(30, 5, '' . $item['banyak'], 1, 0, 'C');
  $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
  $pdf->Cell(20, 5, '', 1, 1, 'C');
  $i++;
}

// function jumlah($db, $transaksiId)
// {
//   $total_banyak = 0;
//   $res = mysqli_query($db, "SELECT * FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan JOIN barang b ON t.id_barang = b.id_barang  WHERE no_faktur = '$transaksiId'");
//   while ($item = mysqli_fetch_assoc($res)) {
//     $total_banyak += $item['banyak'];
//   }
//   return $total_banyak;
// }

// $totalJumlah = jumlah($db, $transaksiId);

$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(30, 5, 'Jumlah', 0, 0);
$pdf->Cell(50, 5, '' . $transaksi['jumlahBanyak'], 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, 'Hormat Kami', 0, 0, 'C');
$pdf->Cell(60, 5, 'Pengirim', 0, 0, 'C');
$pdf->Cell(60, 5, 'Penerima', 0, 1, 'C');
$pdf->Cell(30, 30, '', 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 40, '(   Putra Subur Makmur   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 40, '(                          )', 0, 0, 'C');
$pdf->Cell(60, 40, '(   ' . $transaksi['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->Output();
