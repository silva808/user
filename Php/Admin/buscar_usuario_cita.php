<?php
// connection
require_once '../conexion.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT tipo_documento, nombre, edad, tipo_afiliacion, nombre_rol FROM usuario INNER JOIN roles ON usuario.id_rol = roles.id_rol WHERE id_usuario = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(null);
    }
}

$conn->close();
?>
