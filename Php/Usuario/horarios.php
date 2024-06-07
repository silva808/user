<?php
require_once("../conexion.php");

if(isset($_POST['opcion_actual'])){
    $rango1= $_POST['opcion_actual'];
echo "Primer rango id ", $rango1;

$sql="SELECT * FROM horarios WHERE EXTRACT(MINUTE FROM hora_inicio) IN (0, 30) AND  id_horario > '$rango1'";
$consul2= mysqli_query($conn,$sql);

    if($rango1=='selec'){
        
    }else{ 
            if($rango1==19){
                 echo "<option disabled>Rango no permitido</option>";
        }else{
            if($consul2){
                while($desplegar2= $consul2->fetch_assoc()){

                    echo "<option value='".$desplegar2['id_horario']."'>".$desplegar2['hora_inicio']."</option>";                
                }
            }
       }
    }
}
if(isset($_POST['opcion_actual2'])){
   $rango2= $_POST['opcion_actual2'];
   echo "Primer rango id ", $rango2;
   
   $sql="SELECT * FROM horarios WHERE EXTRACT(MINUTE FROM hora_inicio) IN (0, 30) AND  id_horario > '$rango2'";
   $consul3= mysqli_query($conn,$sql);

   if($rango2=='selec'){

    }else{
        if($rango1==19){
            echo "<option disabled>Rango no permitido</option>";
        }    
        else{
                if($consul3){
                    while($desplegar3= $consul3->fetch_assoc()){
                        echo "<option value='".$desplegar3['id_horario']."'>".$desplegar3['hora_inicio']."</option>";
                    }
                }
            }
    }
}
   ?>
