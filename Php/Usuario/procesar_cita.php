<?php

require_once("../conexion.php");


session_start();
date_default_timezone_set('America/Bogota');
$id_user=$_SESSION['id'];
$edad=$_SESSION['edad'];

$fecha = $_POST['fecha'];
$fecha2 = $_POST['fecha2'];

$hora_inicio = $_POST['hora_inicio'];
$hora_inicio2 = isset($_POST['hora_inicio_2']) ? $_POST['hora_inicio_2'] : null;

$hora_fin = $_POST['hora_fin'];
$hora_fin2 = isset($_POST['hora_fin2']) ? $_POST['hora_fin2'] : null;

$id_tipo_cita= $_POST['tipocita'];
$point_embarazo=0;
$point_patologia=0;
$sql="SELECT usuario.*, patologias.puntuacion AS puntuacion_patologia,
estado.puntuacion    AS puntuacion_embarazo FROM usuario INNER JOIN historia_clinica ON historia_clinica.id_usuario= usuario.id_usuario INNER JOIN patologias ON patologias.id_patologia= historia_clinica.id_patologia INNER JOIN estado ON estado.id_estado=historia_clinica.id_estado WHERE usuario.id_usuario='$id_user'";
$consulta= mysqli_query($conn,$sql);
$sql2="SELECT * FROM edades_rango WHERE $edad BETWEEN inicial AND final";
$consulta2= mysqli_query($conn,$sql2);

if(mysqli_num_rows($consulta)>0){
    $datos= mysqli_fetch_array($consulta);
    $point_patologia=$datos['puntuacion_patologia'];
    $point_embarazo=$datos['puntuacion_embarazo'];
    
}   
if(mysqli_num_rows($consulta2)>0){
    $datos2= mysqli_fetch_array($consulta2);
    $point_edad= $datos2['id_puntaje'];
}
$suma = $point_patologia + $point_embarazo + $point_edad;
$fechaHoraActual = date('Y-m-d H:i:s');
$ahora_mismo ="".$fechaHoraActual;
$validacion=mysqli_query($conn,"SELECT * FROM preagendamiento WHERE id_usuario='$id_user'");
    if(mysqli_num_rows($validacion)>0){
        header("Location: ../user.php?success=5");
    }else{
        $sql_insertar_cita = " INSERT INTO preagendamiento (id_usuario,id_tipo_cita,fecha,fecha_2,hora_inicio,valoracion,hora_fin,hora_inicio_2,hora_fin_2,registro)  VALUES ('$id_user','$id_tipo_cita','$fecha','$fecha2','$hora_inicio','$suma','$hora_fin','$hora_inicio2','$hora_fin2','$ahora_mismo')";
        $ejecutar_consulta = mysqli_query($conn,$sql_insertar_cita);
        if($ejecutar_consulta){
            $sql_ordenar_citas = " SELECT * FROM preagendamiento";
            $consulta_orden = mysqli_query($conn,$sql_ordenar_citas);
            if(mysqli_num_rows($consulta_orden)>0){
                $array_consulta = mysqli_fetch_array($consulta_orden);
                
                $a= count($array_consulta);
                // $to="riseofrochy@gmail.com";
                // $subject="Prueba correo";
                // $message="este es mi primer correo de prueba";
                // $headers='From: alejandra03fajardo@gmail.com'."\r\n".'Reply-To: fajardo@gmail.com';
                // if(mail($to,$subject,$message,$headers)){
                //     echo"Se ha mandado el correo exitosamente $to";
                // }else{
                //     echo"Algo paso :(";
                // }
            
                echo "<script>window.location.href = '../user.php?success=1'</script>";
            }
        }else{
            header("Location: ./user.php?success=0");
    
            echo "no sirve";
        }
    }


?>