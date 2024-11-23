<?php

include_once "../../functions.php";

// Function to get data from the 'barang' table by id_barang
function getBarangByIds($id)
{
    // Connect to the database
    $db = dbConnect();

    // Prepare the query to avoid SQL injection
    $stmt = $db->prepare("SELECT * FROM barang WHERE id_barang = ?");
    
    // Bind the id parameter to the statement (assuming id_barang is a string)
    $stmt->bind_param("s", $id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch data as associative array
    $data = $result->fetch_assoc();
    
    // Free the result and close the connection
    $result->free();
    $stmt->close();
    $db->close();

    return $data;
}


// Check if 'id_barang' is set in the GET request
if (isset($_GET['id_barang'])) {
    // Sanitize the 'id_barang' input to prevent security issues
    $id_barang = htmlspecialchars($_GET['id_barang']); 

    // Call the function to get data based on the id
    $data = getBarangByIds($id_barang);

    // Check if data was found and return the result as JSON
    if ($data) {
        echo json_encode($data);
    } else {
        // Return error if no data is found
        echo json_encode(['error' => 'Data not found']);
    }
} else {
    // Return error if 'id_barang' is not set
    echo json_encode(['error' => 'id_barang parameter is missing']);
}

?>
