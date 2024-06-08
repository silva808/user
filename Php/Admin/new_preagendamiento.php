<?php
require_once '../conexion.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Get the JSON data sent from the client and decode it
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data from the JSON object
    $null=" ";
    $valorant='0';
    $cita_idNumber = $data['cita_idNumber'];
    // $cita_docType = $data['cita_docType'];
    // $cita_name = $data['cita_name'];
    // $cita_age = $data['cita_age'];
    // $cita_afiliation = $data['cita_afiliation'];
    $cita_typeCita = $data['cita_typeCita'];
    $cita_date = $data['cita_date'];
    $cita_startTime = $data['cita_startTime'];
    $cita_endTime = $data['cita_endTime'];
    $cita_sendTime = $data['cita_sendTime'];
    // You can extract more fields as needed
    
    // Prepare and execute the SQL statement to insert data into the database
    $kali = mysqli_prepare($conn, "INSERT INTO preagendamiento (id_usuario, fecha, hora_inicio, valoracion, hora_fin, registro, id_tipo_cita) VALUES (?,?,?,?,?,?,?)");
    // $kali2 = mysqli_prepare($conn, "INSERT INTO preagendamiento (id_usuario, fecha, hora_inicio, hora_fin, registro, id_tipo_cita) VALUES (?,?,?,?,?,?)");

    mysqli_stmt_bind_param($kali, "ississi", $cita_idNumber, $cita_date, $cita_startTime, $valorant, $cita_endTime, $cita_sendTime, $cita_typeCita);

    
    // Check if the statement executed successfully
    if (mysqli_stmt_execute($kali)) {
        // Send a success response to the client
        echo "New CITA added successfully";
    } else {
        // Send an error response to the client
        echo "Error adding new CITA: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($kali);
    mysqli_close($conn);
}
?>
