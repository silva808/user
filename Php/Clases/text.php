<?php
// Fecha inicial
include_once "../conexion.php";


$fecha = '2024-05-17';
echo $fecha;


$datetime = new DateTime($fecha);


$datetime->modify('+1 day');


$fecha_modificada = $datetime->format('Y-m-d');


echo $fecha_modificada;




$sql = "INSERT INTO preagendamiento (
    id_usuario,
    fecha,
    fecha_2,
    hora_inicio,
    hora_inicio_2,
    valoracion,
    hora_fin,
    hora_fin_2,
    registro,
    id_tipo_cita
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


if ($stmt === false) {
    die("Error en la preparación: " . $conn->error);
}

// Asignar valores a los parámetros
$id_usuario = 1;
$fecha = '2024-06-04';
$fecha_2 = '2024-06-05';
$hora_inicio = 4;
$hora_inicio_2 = 5;
$valoracion = 5;
$hora_fin = 5;
$hora_fin_2 = 6;
$registro = '2024-06-01 16:34:52';
$id_tipo_cita = 1;

// Vincular los parámetros
$stmt->bind_param("issiiiiisi", $id_usuario, $fecha, $fecha_2, $hora_inicio, $hora_inicio_2, $valoracion, $hora_fin, $hora_fin_2, $registro, $id_tipo_cita);

// Ejecutar la sentencia 200 veces
//for ($i = 0; $i < 200; $i++) {
    if (!$stmt->execute()) {
        echo "Error en la ejecución: " . $stmt->error;
    }
//}


/*
$eliminar=mysqli_query($conn,"DELETE FROM citas_agendadas WHERE id_citas=id_citas");
$eliminar1=mysqli_query($conn,"DELETE FROM sugerencias_citas WHERE id=id");*/
?>
