<?php
require_once('../conexion.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_suge=$_POST['id_sugerencia'];
    
    $sql= "SELECT * FROM sugerencias_citas WHERE id='$id_suge'";
    $resultado=mysqli_query($conn, $sql);
    echo "a";
    
    if(mysqli_num_rows($resultado)>0){
        echo "entro";
        $datos= $resultado->fetch_assoc();

        $id_preagendamiento =$datos["id_preagendamiento"];
        $FechaAsignada =$datos["fecha"];
        $HoraAsignada =$datos["hora_reservada"];
        $id_DoctorAsignado =$datos["doctor_asignado"];
        $Prioridad = $datos["prioridad_sug"];

            $SQL = mysqli_query($conn,"INSERT INTO citas_agendadas (id_preagendamiento,FechaAsignada,HoraAsignado,id_DoctorAsignado,Prioridad) VALUES ('$id_preagendamiento','$FechaAsignada' , '$HoraAsignada' ,'$id_DoctorAsignado','$Prioridad')");

            if($SQL){
                echo "entro 2";
                $sql2="DELETE FROM sugerencias_citas WHERE id='$id_suge'";
                $consulta2= mysqli_query($conn,$sql2);
                if($consulta2){
                    echo "elimino";
                }
                return true;
            }
            return false;

        }
    }
echo "no";


?>
