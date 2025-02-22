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
        barang.id_barang, 
        barang_masuk.no_barang_masuk, 
        barang_masuk.tanggal_beli, 
        barang.nama_barang, 
        barang_masuk.banyak,
        barang.harga_beli, 
        barang.harga_jual, 
        barang.stok, 
        supplier.nama_supplier
    FROM 
        barang
    JOIN 
        barang_masuk ON barang.id_barang = barang_masuk.id_barang
    JOIN 
        supplier ON supplier.id_supplier = barang_masuk.id_supplier
";

// Get the total number of records before filtering
$totalData = getTotalRecords($sql_details, $query);

// Limit the total records displayed to 50
$maxRecords = 50;
$totalData = min($totalData, $maxRecords);

// Get the filtered records based on the request from DataTables
$filteredData = getFilteredRecords($sql_details, $query, $_GET, $maxRecords);

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
function getTotalRecords($sql_details, $query)
{
    $conn = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);
    $stmt = $conn->query("SELECT COUNT(*) FROM ({$query}) AS total");
    return $stmt->fetchColumn();
}

// Function to get filtered records
function getFilteredRecords($sql_details, $query, $request, $maxRecords)
{
    $conn = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);

    // Base query for total filtered records
    $baseQuery = $query;

    $baseQuery .= " WHERE (barang.status_enable IS NULL OR barang.status_enable = 'true')
    AND (barang_masuk.status_enable IS NULL OR barang_masuk.status_enable = 'true')";

    $tanggalAwal = $request['start_date'];
    $tanggalAkhir = $request['end_date'];

    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
        $baseQuery .= " AND barang_masuk.tanggal_beli BETWEEN '$tanggalAwal' AND '$tanggalAkhir'";
    }

    // Searching functionality
    $searchValue = $request['search']['value'];
    if (!empty($searchValue)) {
        $baseQuery .= " AND (barang.nama_barang LIKE :search OR supplier.nama_supplier LIKE :search)";
    }


    // Get total filtered records
    $stmt = $conn->prepare($baseQuery);
    if (!empty($searchValue)) {
        $stmt->bindValue(':search', "%{$searchValue}%", PDO::PARAM_STR);
    }
    $stmt->execute();
    $recordsFiltered = min($stmt->rowCount(), $maxRecords); // Limit filtered records to max 50

    // Paginate the results
    $start = intval($request['start']);
    $length = intval($request['length']);

    // Adjust pagination to fit within maxRecords
    if ($recordsFiltered > $maxRecords) {
        $length = min($length, $maxRecords - $start);
    }

    $baseQuery .= " ORDER BY barang.nama_barang ASC LIMIT {$start}, {$length}";

    // Get the data
    $stmt = $conn->prepare($baseQuery);
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
function formatData($data)
{
    foreach ($data as &$row) {
        $row = [
            'id_barang' => $row['id_barang'],
            'no_barang_masuk' => $row['no_barang_masuk'],
            'banyak' => $row['banyak'],
            'tanggal_beli' => $row['tanggal_beli'],
            'nama_barang' => $row['nama_barang'],
            'harga_beli' => 'Rp. ' . number_format($row['harga_beli'], 0, ",", "."),
            'harga_jual' => 'Rp. ' . number_format($row['harga_jual'], 0, ",", "."),
            'stok' => $row['stok'],
            'nama_supplier' => $row['nama_supplier']
        ];
    }
    return $data;
}
