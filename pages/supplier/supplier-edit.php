<?php
include_once "../../functions.php";

if (isset($_POST['btn-simpan'])) {
    if (updateDataSupplier($_POST) > 0) {
        setFlash('berhasil', 'diubah', 'primary');
        header('Location: ' . BASEURL . '/pages/supplier/supplier.php');
        exit;
    } else {
        setFlash('gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/pages/supplier/supplier.php');
        exit;
    }
} else {
    header('location:supplier.php');
}
