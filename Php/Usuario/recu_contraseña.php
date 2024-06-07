<?php
require_once('../conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $identificacion=$_POST['identificacion'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['pass'];
    
 $sql= "SELECT * FROM usuario WHERE id_usuario='$identificacion' AND correo='$correo'";
 $resultado=mysqli_query($conn, $sql);
 
 if($resultado->num_rows){
    while($dato= $resultado->fetch_assoc()){

        $to=$correo;
        $subject="Recuperación de contraseña MEDPRIORITY";
        $message="Su contraseña es:".$dato['contrasena'];
        $headers='From: alejandra03fajardo@gmail.com'."\r\n".'Reply-To: fajardo@gmail.com';
        if(mail($to,$subject,$message,$headers)){
            echo"Se ha mandado el correo exitosamente $to";
        }else{
            echo"Algo paso :(";
        }
        echo "<script> alert('La contraseña a sido actualizada');location.replace('../../index.php') </script>";
    }
 }
 else {
    echo "<script> alert('La identificacion y el correo no son correctos');location.replace('./recu_password.php') </script>";

 }
}


?>
