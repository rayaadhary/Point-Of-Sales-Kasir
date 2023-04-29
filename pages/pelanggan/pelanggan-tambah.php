<?php
include_once "../../functions.php";
session_start();
if (!isset($_SESSION["id_pengguna"]))
    header(
        "Location: " . BASEURL
    );
if (isset($_POST['btn-simpan'])) {
    if (insertDataPelanggan($_POST) > 0) {
        setFlash('berhasil', 'ditambahkan', 'primary');
        header('Location: ' . BASEURL . '/pages/pelanggan/pelanggan.php');
        exit;
    } else {
        setFlash('gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/pages/pelanggan/pelanggan.php');
        exit;
    }
} else {
    header('location:pelanggan.php');
}
