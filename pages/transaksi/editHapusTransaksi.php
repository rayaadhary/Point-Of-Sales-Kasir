<?php
include_once "../../functions.php";

if (!isset($_SESSION["id_pengguna"])) {
    header("Location: " . BASEURL);
    exit;
}

$db = dbConnect();
$response = ['success' => false, 'message' => ''];

if (isset($_POST['id_transaksi'])) {
    $id_transaksi = mysqli_real_escape_string($db, $_POST['id_transaksi']);
    
    mysqli_begin_transaction($db);
    try {
        // Get transaction details before deletion
        $stmt = $db->prepare("SELECT id_barang, banyak FROM transaksi WHERE id_transaksi = ?");
        $stmt->bind_param("s", $id_transaksi);
        $stmt->execute();
        $result = $stmt->get_result();
        $transaction = $result->fetch_assoc();
        
        if ($transaction) {
            // Return stock
            $stmtUpdateStock = $db->prepare("UPDATE barang SET stok = stok + ? WHERE id_barang = ?");
            $stmtUpdateStock->bind_param("is", $transaction['banyak'], $transaction['id_barang']);
            $stmtUpdateStock->execute();
            
            // Delete the transaction
            $stmtDelete = $db->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
            $stmtDelete->bind_param("s", $id_transaksi);
            $stmtDelete->execute();
            
            mysqli_commit($db);
            $response['success'] = true;
            $response['message'] = 'Transaction deleted successfully';
        } else {
            throw new Exception("Transaction not found");
        }
    } catch (Exception $e) {
        mysqli_rollback($db);
        $response['message'] = $e->getMessage();
    }
}

echo json_encode($response);