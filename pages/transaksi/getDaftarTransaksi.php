<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../../functions.php";

// Database connection details
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);

// Define the SQL query for the DataTable with JOIN
$query = "
    SELECT 
        t.no_faktur,
        t.tanggal,
        t.jatuh_tempo,
        t.diskon,
        t.total,
        t.bayar,
        t.kembali,
        t.status,
        p.nama_pelanggan,
        t.no_surat_jalan
    FROM 
        transaksi AS t
    LEFT JOIN 
        pelanggan AS p ON t.id_pelanggan = p.id_pelanggan
";

// Get the total number of records before filtering
$totalData = getTotalRecords($sql_details, $query);

// Get the filtered records based on the request from DataTables
$filteredData = getFilteredRecords($sql_details, $query, $_GET);

// Combine the total and filtered data into the format DataTables expects
$data = [
    'draw' => intval($_GET['draw']),
    'recordsTotal' => $totalData,
    'recordsFiltered' => $filteredData['recordsFiltered'],
    'data' => formatData($filteredData['data'])
];

// Return the JSON response
echo json_encode($data);

// Function to get total records without filtering
function getTotalRecords($sql_details, $query) {
    $conn = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);
    $stmt = $conn->query("SELECT COUNT(*) FROM ({$query}) AS total");
    return $stmt->fetchColumn();
}

// Function to get filtered records
function getFilteredRecords($sql_details, $query, $request) {
    $conn = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);
    
    // You may want to add WHERE conditions based on the request
    // Example: Searching functionality (optional)
    $searchValue = $request['search']['value'];
    if (!empty($searchValue)) {
        $query .= " WHERE t.no_faktur LIKE :search OR p.nama_pelanggan LIKE :search";
    }
    
    // Get total filtered records
    $stmt = $conn->prepare($query);
    if (!empty($searchValue)) {
        $stmt->bindValue(':search', "%{$searchValue}%", PDO::PARAM_STR);
    }
    $stmt->execute();
    $recordsFiltered = $stmt->rowCount();

    // Paginate the results
    $start = intval($request['start']);
    $length = intval($request['length']);
    $query .= " LIMIT {$start}, {$length}";

    // Get the data
    $stmt = $conn->prepare($query);
    if (!empty($searchValue)) {
        $stmt->bindValue(':search', "%{$searchValue}%", PDO::PARAM_STR);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return [
        'recordsFiltered' => $recordsFiltered,
        'data' => $data
    ];
}

// Function to format data for the DataTable
function formatData($data) {
    foreach ($data as &$row) {
        $row = [
            'no_faktur' => $row['no_faktur'],
            'tanggal' => $row['tanggal'],
            'nama_pelanggan' => $row['nama_pelanggan'], // Include nama_pelanggan
            'jatuh_tempo' => $row['jatuh_tempo'],
            'diskon' => 'Rp. ' . number_format($row['diskon'], 0, ",", "."),
            'total' => 'Rp. ' . number_format($row['total'], 0, ",", "."),
            'bayar' => 'Rp. ' . number_format($row['bayar'], 0, ",", "."),
            'kembali' => 'Rp. ' . number_format($row['kembali'], 0, ",", "."),
            'status' => $row['status'],
            'actions' => '
                <a href="surat-jalan-list.php?idPengiriman=' . $row['no_surat_jalan'] . '&idTransaksi=' . $row['no_faktur'] . '" type="button" title="surat jalan" class="btn btn-info btn-circle btn-sm">
                    <i class="fas fa-shipping-fast"></i>
                </a>
                <a href="cetak-transaksi-list.php?idPengiriman=' . $row['no_surat_jalan'] . '&idTransaksi=' . $row['no_faktur'] . '" title="cetak transaksi" class="btn btn-success btn-circle btn-sm">
                    <i class="fas fa-money-check"></i>
                </a>
                <a href="transaksi-hapus.php?idPengiriman=' . $row['no_surat_jalan'] . '&idTransaksi=' . $row['no_faktur'] . '" class="btn btn-danger btn-circle btn-sm hapus" title="hapus transaksi">
                    <i class="fas fa-trash"></i>
                </a>
            '
        ];
    }
    return $data;
}
?>
