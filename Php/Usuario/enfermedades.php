<?php
require_once ('../conexion.php');

if(isset($_POST['opcion_actual']) && isset($_POST['id_user'])) {
    $opcion_actual = $_POST['opcion_actual'];
    $id_user = $_POST['id_user'];

    function getHistoriaClinica2($id_tipocita, $id_user, $conn) {
        $sql = "SELECT * FROM historia_clinica hc INNER JOIN patologias p ON hc.id_patologia = p.id_patologia INNER JOIN estado e ON e.id_estado= hc.id_estado WHERE id_tipocita = '$id_tipocita' AND id_usuario = '$id_user'";
        $consulta = mysqli_query($conn, $sql);

        if(mysqli_num_rows($consulta) > 0){
            $result = '';

            while($datos = $consulta->fetch_assoc()){
                // $result .= ' <div class="title2">ANAMNESIS</div>';

                $result .= '<p class="negrita2">Sintomático Respiratorio: </p><p class="demas">' . $datos['sintomatico_respiratorio'] . '</p>';
                $result .= '<p class="negrita2">Enfermedad Actual: </p><p class="demas">' . $datos['enfermedad_actual'] . '</p>';
                $result .= '<div class="title2">ASPECTO Y ESTADO GENERAL DEL PACIENTE</div>';

              
                $result .= '<p class="negrita2">Descripcion:</p><p class="demas">' . $datos['aspecto_general'] . '</p>';
                $result .= '<p class="negrita2">Estado:</p><p class="demas">' . $datos['estado'] . '</p>';

                $result .= '<div class="cont-2">';

                $result .= '<div class="cont_gravedad">';
                $result .= '<p class="negrita_grave">Patología:</p><p>' . $datos['nombre_patologia'] . '</p>';
                $result .= '</div>';

                $result .= '<div class="cont_gravedad">';
                $result .= '<p class="negrita_grave">Gravedad-patologia:</p><p>' . $datos['puntuacion'] . '</p>';
                $result .= '</div>';

                $result .= '</div>';


            }
            
            return $result;
        } else {
            return '<p>No se encontraron resultados.</p>';
        }
    }

    echo getHistoriaClinica2($opcion_actual, $id_user, $conn);

} else {
    echo '<p>Error: Datos incompletos.</p>';
}
?>
