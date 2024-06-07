<?php
require_once '../conexion.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get the JSON data sent from the client and decode it
    $dataaa = json_decode(file_get_contents("php://input"), true);

    // Extract data from the JSON object
    $namecita = $dataaa['typec_name'];
    // You can extract more fields as needed
    
    // Prepare and execute the SQL statement to insert data into the database
    $stmt_cita_type = mysqli_prepare($conn, "INSERT INTO tipo_cita (enombre) VALUES (?)");

    mysqli_stmt_bind_param($stmt_cita_type, "s", $namecita);

    
    // Check if the statement executed successfully
    if (mysqli_stmt_execute($stmt_cita_type)) {
        // Send a success response to the client
        echo "New CITA TYPE added successfully";
    } else {
        // Send an error response to the client
        echo "Error adding new CITA TYPE: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt_cita_type);
    mysqli_close($conn);
}
?>
