<!-- --------------------------------UPDATE USERS------------------------------------ -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    require_once '../conexion.php';

    // Decode JSON data sent via AJAX
    $data = json_decode(file_get_contents("php://input"), true);

    // Prepare SQL statement
    $skibidi = "UPDATE tipo_cita SET 
                enombre = ?
                WHERE id = ?";

    $stmttype = mysqli_prepare($conn, $skibidi);

    // Check if the prepare statement was successful
    if ($stmttype) {
        // Bind parameters
        mysqli_stmt_bind_param(
            $stmttype,
            "si",
            $data['mtc_name'],
            $data['mtc_id']
        );

        // Execute statement
        mysqli_stmt_execute($stmttype);

        // Close statement
        mysqli_stmt_close($stmttype);
    } else {
        // If prepare statement failed, handle the error
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}

?>