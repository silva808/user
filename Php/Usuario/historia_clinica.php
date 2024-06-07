<?php
require_once ('../conexion.php');

if(isset($_POST['opcion_actual']) && isset($_POST['id_user'])) {
    $opcion_actual = $_POST['opcion_actual'];
    $id_user = $_POST['id_user'];

    function getHistoriaClinica($id_tipocita, $id_user, $conn) {
        $sql = "SELECT * FROM historia_clinica WHERE id_tipocita = '$id_tipocita' AND id_usuario = '$id_user'";
        $consulta = mysqli_query($conn, $sql);

        if(mysqli_num_rows($consulta) > 0){
            $result = '';
            while($datos = $consulta->fetch_assoc()){
                $result .= '<p class="p">N° Historia: ' . $datos['id_historia'] . '</p>';
                $result .= '<p class="p">Fecha ingreso: ' . $datos['fecha_ingreso'] . '</p>';
                $result .= '<p class="p">Fecha Folio: ' . $datos['fecha_ingreso'] . '</p>';
                $result .= '<p class="p">Folio: ' . $datos['numero_folio'] . '</p>';
            }
            return $result;
        } else {
            return '<p>No se encontraron resultados.</p>';
        }
    }

    echo getHistoriaClinica($opcion_actual, $id_user, $conn);
} else {
    echo '<p>Error: Datos incompletos.</p>';
}
?>
