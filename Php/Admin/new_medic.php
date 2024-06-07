<?php
require_once '../conexion.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get the JSON data sent from the client and decode it
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data from the JSON object
    $null=" ";
    $docType = "Cedula de Ciudadania";
    $role = '3';
    $idNumber = $data['idNumber'];
    $name = $data['name'];
    $age = $data['age'];
    $phoneNumber = $data['phoneNumber'];
    $email = $data['email'];
    $sex = $data['sex'];
    // You can extract more fields as needed
    
    // Prepare and execute the SQL statement to insert data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO usuario (id_usuario, nombre, edad, telefono, correo, genero, tipo_documento, direccion, id_rol, tipo_afiliacion) VALUES (?,?,?,?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt, "ssssssssss", $idNumber, $name, $age, $phoneNumber, $email, $sex, $docType, $null, $role, $null);

    
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
