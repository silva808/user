<?php
require_once '../conexion.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get the JSON data sent from the client and decode it
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data from the JSON object
    $especialidad = $data['special_name'];
    // You can extract more fields as needed
    
    // Prepare and execute the SQL statement to insert data into the database
    $stmtspecial = mysqli_prepare($conn, "INSERT INTO especialidades (especialidad) VALUES (?)");

    mysqli_stmt_bind_param($stmtspecial, "s", $especialidad);

    
    // Check if the statement executed successfully
    if (mysqli_stmt_execute($stmtspecial)) {
        // Send a success response to the client
        echo "New ESPECIALIDAAD added successfully";
    } else {
        // Send an error response to the client
        echo "Error adding new ESPECIALIDAD: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmtspecial);
    mysqli_close($conn);
}
?>
