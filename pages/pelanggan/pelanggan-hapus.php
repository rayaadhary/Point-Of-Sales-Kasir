<?php
include_once("../../functions.php");

$id = $_GET['id_pelanggan'];

if (getDeletePelanggan($id) > 0) {
    setFlash('berhasil', 'dihapus', 'primary');
    header('Location: ' . BASEURL . '/pages/pelanggan/pelanggan.php');
    exit;
} else {
    setFlash('gagal', 'dihapus', 'danger');
    header('Location: ' . BASEURL . '/pages/pelanggan/pelanggan.php');
    exit;
}
