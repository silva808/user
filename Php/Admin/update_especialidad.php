<!-- --------------------------------UPDATE USERS------------------------------------ -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require_once '../conexion.php';

    // Decode JSON data sent via AJAX
    $data = json_decode(file_get_contents("php://input"), true);

    // Prepare SQL statement
    $jjk = "UPDATE especialidades SET 
                especialidad = ?
                WHERE id_especialidad = ?";

    $stmtspecial = mysqli_prepare($conn, $jjk);

    // Check if the prepare statement was successful
    if ($stmtspecial) {
        // Bind parameters
        mysqli_stmt_bind_param(
            $stmtspecial,
            "si",
            $data['ms_name'],
            $data['ms_id']
        );

        // Execute statement
        mysqli_stmt_execute($stmtspecial);

        // Close statement
        mysqli_stmt_close($stmtspecial);
    } else {
        // If prepare statement failed, handle the error
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}

?>