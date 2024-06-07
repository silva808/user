<?php
require_once '../conexion.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get the JSON data sent from the client and decode it
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data from the JSON object
    $null=" ";
    $namePatologia = $data['pato_name'];
    $scorePatologia = $data['pato_score'];
    // You can extract more fields as needed
    
    // Prepare and execute the SQL statement to insert data into the database
    $stmt13 = mysqli_prepare($conn, "INSERT INTO patologias (nombre_patologia, puntuacion) VALUES (?,?)");

    mysqli_stmt_bind_param($stmt13, "ss", $namePatologia, $scorePatologia);

    
    // Check if the statement executed successfully
    if (mysqli_stmt_execute($stmt13)) {
        // Send a success response to the client
        echo "New patologia added successfully";
    } else {
        // Send an error response to the client
        echo "Error adding new patologia: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt13);
    mysqli_close($conn);
}
?>