<?php

class Nodo{

    public $id;
    public $datos;
    public $peso;

    public function __construct($id,$datos=array(),$peso){
        $this->id = $id;
        $this->datos = $datos;
        $this->peso = $peso;
    }

    public function AsignarPeso($nuevo_peso){
        $this->peso=$nuevo_peso;
    }

    public function RangoHoras(){
        $Datos_Arreglos = $this->datos;
        
    }

    public function ModificarHora($NuevaHora){
        $this->datos["HoraAsignada"]=$NuevaHora;
    }

    public function ModificarMedico($NuevoMedico){
        $this->datos["MedicoAsignado"]=$NuevoMedico;
    }
// Metodos para filtro 2 
    public function fecha2($fecha2){
        $this->datos["FechaSolicitada"]=$fecha2;
    }
    public function ModificaInicio($NuevaHora2){
        $this->datos["HoraInicio"]=$NuevaHora2;
    }

    public function Modificafin($NuevaHorafin){
        $this->datos["HoraFin"]=$NuevaHorafin;
    }

}

?>