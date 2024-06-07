<?php

class UpdateBD{

    public $Conexion;


    public function __construct($Conection) {
        $this->Conexion = $Conection;
    }

    public function ActualizarCitasAsignadas($Nodo){

        $id_preagendamiento =$Nodo->id;
        $FechaAsignada =$Nodo->datos["FechaSolicitada"];
        $HoraAsignada =$Nodo->datos["HoraAsignada"];
        $id_DoctorAsignado =$Nodo->datos["MedicoAsignado"];
        $Prioridad = $Nodo->peso;

        $SQL = mysqli_query($this->Conexion,"UPDATE citas_agendadas SET FechaAsignada='$FechaAsignada' , HoraAsignado='$HoraAsignada' , id_DoctorAsignado='$id_DoctorAsignado' , Prioridad='$Prioridad' WHERE id_preagendamiento ='$id_preagendamiento'");

        if($SQL){

            return true;

        }

        return false;

    }

    public function ActualizarCitasSugerencias($Nodo){

        $id_preagendamiento =$Nodo->id;
        $FechaAsignada =$Nodo->datos["FechaSolicitada"];
        $HoraAsignada =$Nodo->datos["HoraAsignada"];
        $id_DoctorAsignado =$Nodo->datos["MedicoAsignado"];
        $Prioridad = $Nodo->peso;

        $SQL = mysqli_query($this->Conexion,"UPDATE sugerencias_citas SET fecha='$FechaAsignada' , hora_reservada='$HoraAsignada' , doctor_asignado='$id_DoctorAsignado' , prioridad_sug='$Prioridad'  WHERE id_preagendamiento ='$id_preagendamiento'");

        if($SQL){

            return true;

        }

        return false;

    }

}

?>