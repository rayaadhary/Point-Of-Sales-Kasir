<?php
include_once "../../functions.php";
session_start();
if (!isset($_SESSION["id_pengguna"]))
    header(
        "Location: " . BASEURL
    );
if (isset($_POST['btn-simpan'])) {
    if (updateDataPelanggan($_POST) > 0) {
        setFlash('berhasil', 'diubah', 'primary');
        header('Location: ' . BASEURL . '/pages/pelanggan/pelanggan.php');
        exit;
    } else {
        setFlash('gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/pages/pelanggan/pelanggan.php');
        exit;
    }
} else {
    header('location:pelanggan.php');
}
