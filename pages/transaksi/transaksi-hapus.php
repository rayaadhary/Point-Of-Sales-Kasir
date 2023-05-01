<?php
include_once("../../functions.php");
if (!isset($_SESSION["id_pengguna"]))
    header(
        "Location: " . BASEURL
    );
$transaksi = $_GET['idTransaksi'];
$pengiriman = $_GET['idPengiriman'];

if (getDeleteTransaksi($transaksi, $pengiriman) > 0) {
    setFlash('berhasil', 'dihapus', 'primary');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi-list.php');
    exit;
} else {
    setFlash('gagal', 'dihapus', 'danger');
    header('Location: ' . BASEURL . '/pages/transaksi/transaksi-list.php');
    exit;
}
