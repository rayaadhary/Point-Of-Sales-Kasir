<?php
require_once '../../functions.php';

if (isset($_POST['no_faktur'])) {
    $transaksiId = $_POST['no_faktur'];
    $db = dbConnect();
    
    $sql = "SELECT t.*, b.nama_barang, b.harga_beli 
            FROM transaksi t 
            JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
            JOIN barang b ON t.id_barang = b.id_barang  
            WHERE no_faktur = ?";
            
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $transaksiId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        // Hitung harga per item dari subtotal dan diskon
        $hargaTransaksi = ($row['subtotal'] + $row['diskon']) / $row['banyak'];
        
        $items[] = [
            'id_transaksi' => $row['id_transaksi'],
            'id_barang' => $row['id_barang'],
            'nama_barang' => $row['nama_barang'],
            'harga' => $hargaTransaksi, // Menggunakan harga hasil kalkulasi
            'harga_beli' => $row['harga_beli'],
            'banyak' => $row['banyak'],
            'diskon' => $row['diskon'],
            'subtotal' => $row['subtotal'],
            'selisih' => $row['selisih']
        ];
    }
    
    echo json_encode($items);
}
?>