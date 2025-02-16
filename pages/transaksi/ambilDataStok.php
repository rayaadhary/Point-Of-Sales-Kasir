<?php
// get_stok.php


include_once "../../functions.php";
header('Content-Type: application/json');

if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];

    // Koneksi database
    $db = dbConnect();

    if ($db->connect_error) {
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    // Query untuk mendapatkan stok
    $query = $db->prepare("SELECT stok FROM barang WHERE id_barang = ?");
    $query->bind_param("s", $id_barang);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['stok' => $data['stok']]);
    } else {
        echo json_encode(['error' => 'Item not found']);
    }

    $query->close();
    $db->close();
} else {
    echo json_encode(['error' => 'id_barang is required']);
}
