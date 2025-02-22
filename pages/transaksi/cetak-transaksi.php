<?php

// if (!isset($_SESSION['cetak']["id_pengguna"]))
//   header(
//     "Location: " . BASEURL
//   );
include_once "../../functions.php";
include_once "../../dist/fpdf/fpdf.php";

// var_dump($_SESSION['cetak']);
// die;


$tanggal = date_create($_SESSION['cetak']['tanggal']);
$jatuh_tempo = date_create($_SESSION['cetak']['jatuh_tempo']);
$tanggal_kirim = date_create($_SESSION['cetak']['tanggal_kirim']);

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
$pdf->Cell(70, 5, 'Kepada Yth,     ' . $_SESSION['cetak']['nama_pelanggan'], 0, 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(135, 10, 'Jl Pameuntasan-Gajah Mekar Kab. Bandung Jawa Barat 40911', 0, 0,);
// $pdf->SetFont('Arial', '', 11);
$pdf->Cell(70, 5, 'No Surat Jalan : ' . $_SESSION['cetak']['surat_jalan'], 0, 0);
// $pdf->Cell(35, 5, '' . date_format($jatuh_tempo, 'd-m-y'), 1, 1, 'C');
$pdf->Cell(150, 10, '', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
// $pdf->Cell(70, 5, 'No Surat Jalan', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
// $pdf->Cell(150, 10, 'Kepada :  ' . $transaksi['nama_pelanggan'], 0, 0,);
// $pdf->Cell(70, 5, '' . $pengiriman['no_surat_jalan'], 1, 1, 'C');

// $pdf->Ln(5);
$pdf->Cell(150, 5, 'Faktur :  ' . $_SESSION['cetak']['no_faktur'], 0, 1);
$pdf->SetFont('Arial', '', 11);

$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nama Barang', 1, 0);
$pdf->Cell(38, 5, 'Harga', 1, 0, 'C');
$pdf->Cell(15, 5, 'Qty', 1, 0, 'C');
$pdf->Cell(38, 5, 'Diskon', 1, 0, 'C'); // Pindah ke baris baru
$pdf->Cell(38, 5, 'Subtotal', 1, 1, 'C'); // Pindah ke baris baru
$pdf->SetFont('Arial', '', 11);
$no =  (int)$_SESSION['cetak']['no'] - 2;

// var_dump($no);
// die;
($no === 0) ? $no = 1 : $no;


$jumlahTransaksi = (int) str_replace(['Rp. ', '.', ','], '', $_SESSION['cetak']['jumlah']);
$jumlahTransaksiFormatted = number_format($jumlahTransaksi, 2, ',', '.');

// var_dump($no);
// die;
// ($_SESSION['cetak']['no'] = 2) ? $no =  $_SESSION['cetak']['no'] - 1 : $no =  $_SESSION['cetak']['no'] - 2;
$subtotalSum = 0; // Untuk menjumlahkan semua subtotal
$i = 0;

// Loop while untuk membaca data selama elemen tersedia
while (isset($_SESSION['cetak']['nama_barang'][$i])) {
    // Skip jika data tidak valid
    if (
        empty($_SESSION['cetak']['nama_barang'][$i]) &&
        empty($_SESSION['cetak']['banyak'][$i]) &&
        empty($_SESSION['cetak']['harga'][$i]) &&
        empty($_SESSION['cetak']['subtotal'][$i])
    ) {
        $i++;
        continue;
    }

    // Konversi subtotal ke integer
    $subtotal = str_replace(['Rp. ', '.', ','], '', $_SESSION['cetak']['subtotal'][$i]);
    $subtotalInt = (int)$subtotal;

    // Tambahkan subtotal ke total
    $subtotalSum += $subtotalInt;

    // Format subtotal
    $subtotalFormatted = number_format($subtotalInt, 2, ',', '.');

    // Cetak ke PDF
    $pdf->Cell(15, 5, '' . ($i + 1), 1, 0, 'C');
    $pdf->Cell(80, 5, '' . $_SESSION['cetak']['nama_barang'][$i], 1, 0);
    $pdf->Cell(38, 5, 'Rp. ' . number_format((int)str_replace(['Rp. ', '.', ','], '', $_SESSION['cetak']['harga'][$i]), 2, ',', '.'), 1, 0, 'R');
    $pdf->Cell(15, 5, '' . $_SESSION['cetak']['banyak'][$i], 1, 0, 'C');
    $pdf->Cell(38, 5, 'Rp. ' . number_format((int)str_replace(['Rp. ', '.', ','], '', $_SESSION['cetak']['diskon'][$i]), 2, ',', '.'), 1, 0, 'R');
    $pdf->Cell(38, 5, 'Rp. ' . $subtotalFormatted, 1, 1, 'R');

    $i++; // Increment index
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
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($_SESSION['cetak']['totalDiskon']), 2, ',', '.'), 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Ongkos Kirim', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($_SESSION['cetak']['ongkosKirim']), 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Total', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($_SESSION['cetak']['total']), 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Bayar', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($_SESSION['cetak']['bayar']), 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(60, 5, '(   ' . $_SESSION['cetak']['nama_pelanggan'] . '   )', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, '(   Putra Subur Makmur   )', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 5, 'Kembali', 0, 0);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, 'Rp. ' . number_format(convert_to_number($_SESSION['cetak']['kembalian']), 2, ',', '.'), 0, 1, 'R');
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
$pdf->Cell(20, 5, 'No', 0, 0);
$pdf->Cell(90, 5, ': ' . $_SESSION['cetak']['surat_jalan'], 0, 0);
$pdf->Cell(20, 5, 'Telepon', 0, 0);
$pdf->Cell(120, 5, ': 08962742326', 0, 1);
$pdf->Cell(20, 5, 'Tanggal', 0, 0);
$pdf->Cell(90, 5, ': ' . date_format($tanggal_kirim, "d-m-Y"), 0, 0);
$pdf->Cell(20, 5, 'Pelanggan', 0, 0);
$pdf->Cell(120, 5, ': ' . $_SESSION['cetak']['nama_pelanggan'], 0, 1);
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(20, 5, 'Alamat', 0, 0);
$pdf->Cell(120, 5, ': ' . $_SESSION['cetak']['alamat_tujuan'], 0, 0);
$pdf->Ln(5);
$pdf->Cell(15, 5, 'No', 1, 0, 'C');
$pdf->Cell(30, 5, 'Kode', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nama Barang', 1, 0);
$pdf->Cell(30, 5, 'Banyak', 1, 0, 'C');
$pdf->Cell(20, 5, 'Unit', 1, 0, 'C');
$pdf->Cell(20, 5, 'Sub Item', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
// $no =  $_SESSION['cetak']['no'] - 2;
// var_dump($_SESSION['cetak']);
// die;
$i = 0;
$jumlah = 0;

while (isset($_SESSION['cetak']['nama_barang'][$i])) {
    // Skip jika data tidak valid
    if (
        empty($_SESSION['cetak']['idBarang'][$i]) &&
        empty($_SESSION['cetak']['banyak'][$i]) &&
        empty($_SESSION['cetak']['nama_barang'][$i])
    ) {
        $i++;
        continue;
    }

    // Cetak data ke PDF
    $pdf->Cell(15, 5, '' . ($i + 1), 1, 0, 'C');
    $pdf->Cell(30, 5, '' . $_SESSION['cetak']['idBarang'][$i], 1, 0, 'C');
    $pdf->Cell(80, 5, '' . $_SESSION['cetak']['nama_barang'][$i], 1, 0);
    $pdf->Cell(30, 5, '' . $_SESSION['cetak']['banyak'][$i], 1, 0, 'C');
    $pdf->Cell(20, 5, 'pcs', 1, 0, 'C');
    $pdf->Cell(20, 5, '', 1, 1, 'C');

    $jumlah += $_SESSION['cetak']['banyak'][$i];

    $i++; // Increment index
}
// $i = 0;
// while (isset($_SESSION['cetak']['nama_barang'][$i])) {
//   $i++;
// }
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
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 20, 'BCA : 3790 - 474 - 588 (SALSABILA SHAFA PUJA)', 0, 1, 'C');
$pdf->Output();
