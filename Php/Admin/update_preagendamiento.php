<!-- --------------------------------UPDATE USERS------------------------------------ -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require_once '../conexion.php';

    // Decode JSON data sent via AJAX
    $data = json_decode(file_get_contents("php://input"), true);

    // Prepare SQL statement 
    $esonoedeganstel = "UPDATE preagendamiento SET 
                id_tipo_cita = ?, 
                fecha = ?, 
                hora_inicio = ?, 
                hora_fin = ?, 
                valoracion = ? 
                WHERE id_preagendamiento = ?";

    $stmtcitas = mysqli_prepare($conn, $esonoedeganstel);

    // Check if the prepare statement was successful
    if ($stmtcitas) {
        // Bind parameters
        mysqli_stmt_bind_param(
            $stmtcitas,
            "isssii",
            $data['mc_tipocita'],
            $data['mc_date'],
            $data['mc_start_time'],
            $data['mc_end_time'],
            $data['mc_valor'],
            $data['mc_idcita']
        );

        // Execute statement
        if (mysqli_stmt_execute($stmtcitas)) {
            echo "Record updated successfully";
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmtcitas);
        }

        // Close statement
        mysqli_stmt_close($stmtcitas);
    } else {
        // If prepare statement failed, handle the error
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}

?>