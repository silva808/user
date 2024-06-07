
<?php

include_once "Consultas.php";
include_once "ActualizarBD.php";

class InsertarBD{

    public $Conexion;


    public function __construct($Conection) {
        $this->Conexion = $Conection;
    }

    public function InsertarCitasOrdenadas($Nodo){

        $id_preagendamiento =$Nodo->id;
        $FechaAsignada =$Nodo->datos["FechaSolicitada"];
        $HoraAsignada =$Nodo->datos["HoraAsignada"];
        $id_DoctorAsignado =$Nodo->datos["MedicoAsignado"];
        $Prioridad = $Nodo->peso;

        $SQL = mysqli_query($this->Conexion,"INSERT INTO citas_agendadas (id_preagendamiento,FechaAsignada,HoraAsignado,id_DoctorAsignado,Prioridad) VALUES ('$id_preagendamiento','$FechaAsignada' , '$HoraAsignada' ,'$id_DoctorAsignado','$Prioridad')");

        if($SQL){

            return true;
        }
        return false;
    }

    public function InsertarCitasSugerencias($Nodo){

        $consulta = new Consultas($this->Conexion);
        $actualizar = new UpdateBD($this->Conexion);
        $id_preagendamiento =$Nodo->id;
        $idUsuario=$Nodo->datos["idUsuario"];
        $FechaAsignada =$Nodo->datos["FechaSolicitada"];
        $HoraAsignada =$Nodo->datos["HoraAsignada"];
        $id_DoctorAsignado =$Nodo->datos["MedicoAsignado"];
        $Prioridad = $Nodo->peso;
        
        if($consulta->ValidarExistenciaCita($Nodo->id)){
            $actualizar->ActualizarCitasAsignadas($Nodo);
        }else{

            $SQL = mysqli_query($this->Conexion,"INSERT INTO sugerencias_citas (id_usuario,fecha,hora_reservada,estado,id_preagendamiento,doctor_asignado,prioridad_sug) VALUES ('$idUsuario','$FechaAsignada','$HoraAsignada','Reservado','$id_preagendamiento','$id_DoctorAsignado','$Prioridad')");
    
            if($SQL){
    
                return true;
            }
            return false;
        }

    }

}

?>