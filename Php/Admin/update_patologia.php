<!-- --------------------------------UPDATE USERS------------------------------------ -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require_once '../conexion.php';

    // Decode JSON data sent via AJAX
    $data = json_decode(file_get_contents("php://input"), true);

    // Prepare SQL statement
    $fortnite = "UPDATE patologias SET 
                nombre_patologia = ?, 
                puntuacion = ?
                WHERE id_patologia = ?";

    $stmtpat = mysqli_prepare($conn, $fortnite);

    // Check if the prepare statement was successful
    if ($stmtpat) {
        // Bind parameters
        mysqli_stmt_bind_param(
            $stmtpat,
            "sii",
            $data['mp_name'],
            $data['mp_score'],
            $data['mp_id']
        );

        // Execute statement
        mysqli_stmt_execute($stmtpat);

        // Close statement
        mysqli_stmt_close($stmtpat);
    } else {
        // If prepare statement failed, handle the error
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}

?>