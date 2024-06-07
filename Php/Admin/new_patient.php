<?php
require_once '../conexion.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get the JSON data sent from the client and decode it
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data from the JSON object
    $null = " ";
    $pat_docType = $data['pat_docType'];
    $role2 = '2';
    $pat_idNumber = $data['pat_idNumber'];
    $pat_name = $data['pat_name'];
    $pat_age = $data['pat_age'];
    $pat_phoneNumber = $data['pat_phoneNumber'];
    $pat_email = $data['pat_email'];
    $pat_sex = $data['pat_sex'];
    $pat_afiliation = $data['pat_afiliation'];
    // You can extract more fields as needed
    
    // Prepare and execute the SQL statement to insert data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO usuario (id_usuario, nombre, edad, telefono, correo, genero, tipo_documento, direccion, id_rol, tipo_afiliacion) VALUES (?,?,?,?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt, "ssssssssss", $pat_idNumber, $pat_name, $pat_age, $pat_phoneNumber, $pat_email, $pat_sex, $pat_docType, $null, $role2, $pat_afiliation);
    
    // Check if the statement executed successfully
    if (mysqli_stmt_execute($stmt)) {
        // Send a success response to the client
        echo "New user added successfully";
    } else {
        // Send an error response to the client
        echo "Error adding new user: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
