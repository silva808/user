<?php

require_once("../conexion.php");

session_start();
$id_preagendamiento=$_POST['id_preagendamiento'];

$sql2="DELETE FROM citas_agendadas WHERE id_preagendamiento='$id_preagendamiento'";
$consulta2= mysqli_query($conn,$sql2);
if($consulta2>0){
    $sql3="DELETE FROM preagendamiento WHERE id_preagendamiento='$id_preagendamiento'";
    $consulta3= mysqli_query($conn,$sql3);
    if($consulta3>0){
        echo "<script>window.location.href = '../user.php?success=3'</script>";
    }
}

?>