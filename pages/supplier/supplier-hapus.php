<?php
include_once("../../functions.php");

$id = $_GET['id_supplier'];

if (getDeleteSupplier($id) > 0) {
    setFlash('berhasil', 'dihapus', 'primary');
    header('Location: ' . BASEURL . '/pages/supplier/supplier.php');
    exit;
} else {
    setFlash('gagal', 'dihapus', 'danger');
    header('Location: ' . BASEURL . '/pages/supplier/supplier.php');
    exit;
}
