<?php

include_once "Nodo.php";
include_once "Consultas.php";

class Grafo{

    public $nodos = array();
    public $Aristas = array();
    public $Conexion;

    public function __construct($Conexion) {
        $this->Conexion = $Conexion;
    }

    //Permite Agregar Un Nuevo Nodo al grafo
    public function AgregarNodo($nodo){

        $this->nodos[$nodo->id]=$nodo;

    }


    /* Ordena Los Nodos Apartir de los datos Del Nodo,
    Para este caso principalmente Valoracion Y si hay igualdad
    De Valoracion Entre Los Nodos, Se Toma Como Segunda variable
    La fecha y Hora Exactas del momento que se solicito la cita(Nodo) 
      */
    public function OrdenarNodos() {
    
        $nodosArray = array_values($this->nodos);

        usort($nodosArray, function($a, $b) {
        
            if ($b->datos["Valoracion"] == $a->datos["Valoracion"]) {       

                return $a->datos["Registro"] <=> $b->datos["Registro"];

            }
            return $b->datos["Valoracion"]<=> $a->datos["Valoracion"];

        });

        return $nodosArray;

    }

    /* Una vez Ordenados Los Nodos, Se Establece A Cada Nodo un Peso que es
    Equivalante a la posicion donde quedo +1 En Este Caso entre Menor Peso, Mayor prioridad */
    public function AsignarOrden(){

        $OrdenarNodos =$this->OrdenarNodos();

        for ($i=0;$i<count($OrdenarNodos);$i++){

            $OrdenarNodos[$i]->AsignarPeso($i+1);

        }

        return $OrdenarNodos;

    }

    /* Se Asigna La Menor Hora Posible Dependiendo del rango de horas 
    que se solicito en la cita(Nodo) */
    public function AsginarHora(){

        $consulta = new Consultas($this->Conexion);
        $NodosOrdenados = $this->AsignarOrden();
        $NodosFiltrados = array();

        for($i=0 ; $i<count($NodosOrdenados);$i++){

           $ArregloDeHoras = $consulta->HorasDisponiblesPorRango($NodosOrdenados[$i]->datos["HoraInicio"],$NodosOrdenados[$i]->datos["HoraFin"]);

           if($i==0){

            //$NodosOrdenados[$i]->AgregarDatoHora($ArregloDeHoras[$i]);
            $NodosOrdenados[$i]->ModificarHora($ArregloDeHoras[$i]);

           }else{

           // $NodosOrdenados[$i]->AgregarDatoHora(null);
            $HoraDisponibilidad =$this->CompararHorasNodos($NodosOrdenados[$i],$ArregloDeHoras,$NodosFiltrados);
            $NodosOrdenados[$i]->ModificarHora($HoraDisponibilidad);

            if ($NodosOrdenados[$i]->datos['HoraAsignada'] === null) {
                
                $datossinhora=$consulta->datos_filtro2($NodosOrdenados[$i]->id);
                $NodosOrdenados[$i] ->fecha2($datossinhora[0]);
                $NodosOrdenados[$i] ->ModificaInicio($datossinhora[1]);
                $NodosOrdenados[$i] ->ModificaFin($datossinhora[2]);
            }
           }

           array_push($NodosFiltrados,$NodosOrdenados[$i]);

        }

        
        return $NodosOrdenados;

    }
    public function filtro2(){
       
        $consulta = new Consultas($this->Conexion);
        $NodosOrdenados = $this->AsginarHora();
        $NodosFiltrados = array();
        $NodosFilter3= array();
        $Nodos_2Partes=array();
       //$band=0;
       
        for($i=0 ; $i<count($NodosOrdenados);$i++){

           $ArregloDeHoras = $consulta->HorasDisponiblesPorRango($NodosOrdenados[$i]->datos["HoraInicio"],$NodosOrdenados[$i]->datos["HoraFin"]);

           if($i==0){

            //$NodosOrdenados[$i]->AgregarDatoHora($ArregloDeHoras[$i]);
            $NodosOrdenados[$i]->ModificarHora($ArregloDeHoras[$i]);

           }else{

           // $NodosOrdenados[$i]->AgregarDatoHora(null);
            $HoraDisponibilidad =$this->CompararHorasNodos($NodosOrdenados[$i],$ArregloDeHoras,$NodosFiltrados);
            $NodosOrdenados[$i]->ModificarHora($HoraDisponibilidad);
            


                if ($NodosOrdenados[$i]->datos['HoraAsignada'] == null) {

                    array_push($NodosFilter3,$NodosOrdenados[$i]);
                    /*$NodosOrdenados[$i] ->ModificaInicio(1);
                    $NodosOrdenados[$i] ->ModificaFin(34);*/
                    


                    

                    
                    // $fecha = $NodosOrdenados[$i]->datos["FechaSolicitada"];
                    // $horaInicio = $NodosOrdenados[$i]->datos["HoraInicio"];
                    // $horaFin = $NodosOrdenados[$i]->datos["HoraFin"];
                    // $user = $NodosOrdenados[$i]->datos["idUsuario"];
                   
                    
                //     // Llamar a la función datos_filter3() con la fecha y horas como parámetros
                //     $horariosDisponibles = $consulta->datos_filter3($NodosOrdenados[$i]->id, $fecha, $horaInicio, $horaFin,$user);
                   
                //   //  $consulta->insertar_sugerencias($NodosOrdenados[$i]->datos['idUsuario'], $fecha,$horariosDisponibles[$band],'reservado',$NodosOrdenados[$i]->id);
                //       // Verificar si la clave existe en el array antes de acceder a ella
                //         if (isset($horariosDisponibles[0])) {
                //                // echo "band: " . $band . "<br>";
                //                 echo "id: " . $NodosOrdenados[$i]->id . " Horarios disponibles para la fecha " . $fecha . ": ";
                //                 print_r($horariosDisponibles);
                //                 echo "<br>";
                            
                //         } else {
                //             echo "band:   hay datos nulos<br>";

                //         }
                //        // $band++;
                   
                }
           }

           array_push($NodosFiltrados,$NodosOrdenados[$i]);
        }

        array_push($Nodos_2Partes,$NodosOrdenados);
        array_push($Nodos_2Partes,$NodosFilter3);
        
        return $NodosFiltrados;

    }


    public function filtro3(){
       
        $consulta = new Consultas($this->Conexion);
        $NodosOrdenados = $this->filtro2();
        //$NodosOrdenados = $NodosOrdenados[1];
        $NodosFiltrados = array();

       
        for($i=0 ; $i<count($NodosOrdenados);$i++){

            if ($NodosOrdenados[$i]->datos['HoraAsignada'] == null) {
                $NodosOrdenados[$i] ->ModificaInicio(1);
                $NodosOrdenados[$i] ->ModificaFin(33);
            }
                $ArregloDeHoras = $consulta->HorasDisponiblesPorRango($NodosOrdenados[$i]->datos["HoraInicio"],$NodosOrdenados[$i]->datos["HoraFin"]);


                // $NodosOrdenados[$i]->AgregarDatoHora(null);
                    $NodosOrdenados[$i]->ModificarHora($ArregloDeHoras[0]);
                    $HoraDisponibilidad =$this->CompararHorasNodos($NodosOrdenados[$i],$ArregloDeHoras,$NodosFiltrados);
                    $NodosOrdenados[$i]->ModificarHora($HoraDisponibilidad);
                    


                        if ($NodosOrdenados[$i]->datos['HoraAsignada'] === null) {

                            

                            $datetime = new DateTime($NodosOrdenados[$i] ->datos["FechaSolicitada"]);

                            // Sumar un día a la fecha
                            $datetime->modify('+1 day');

                            // Obtener la fecha resultante en formato 'Y-m-d'
                            $Nueva_fecha = $datetime->format('Y-m-d');

                            $NodosOrdenados[$i] ->fecha2($Nueva_fecha);

                            $i--;
                            $this->eliminarObjeto($NodosFiltrados,$NodosOrdenados[$i]);
                        
                        }
                        array_push($NodosFiltrados,$NodosOrdenados[$i]);
                

            
            }
        

        
        return $NodosFiltrados;

    }

    public function filtro4(){
       
        $consulta = new Consultas($this->Conexion);
        $NodosOrdenados = $this->filtro2();
        $NodosYaConHoras = $this->FiltrarNodosNoNull($this->filtro2());
        $NodosFiltrados = array();

        foreach ($NodosYaConHoras as $num) {
            $index = array_search($num, $NodosOrdenados);
            if ($index !== false) {
                unset($NodosOrdenados[$index]);
            }
        }

        $NodosOrdenados = array_values($NodosOrdenados);

       
        for($i=0 ; $i<count($NodosOrdenados);$i++){

            if ($NodosOrdenados[$i]->datos['HoraAsignada'] == null) {
                $NodosOrdenados[$i] ->ModificaInicio(1);
                $NodosOrdenados[$i] ->ModificaFin(33);
            }
                $ArregloDeHoras = $consulta->HorasDisponiblesPorRango($NodosOrdenados[$i]->datos["HoraInicio"],$NodosOrdenados[$i]->datos["HoraFin"]);


                // $NodosOrdenados[$i]->AgregarDatoHora(null);
                    $NodosOrdenados[$i]->ModificarHora($ArregloDeHoras[0]);
                    $HoraDisponibilidad =$this->CompararHorasNodos($NodosOrdenados[$i],$ArregloDeHoras,$NodosYaConHoras);
                    $NodosOrdenados[$i]->ModificarHora($HoraDisponibilidad);
                    


                        if ($NodosOrdenados[$i]->datos['HoraAsignada'] === null) {

                            

                            $datetime = new DateTime($NodosOrdenados[$i] ->datos["FechaSolicitada"]);

                            // Sumar un día a la fecha
                            $datetime->modify('+1 day');

                            // Obtener la fecha resultante en formato 'Y-m-d'
                            $Nueva_fecha = $datetime->format('Y-m-d');

                            $NodosOrdenados[$i] ->fecha2($Nueva_fecha);

                            $i--;
                            $this->eliminarObjeto($NodosYaConHoras,$NodosOrdenados[$i]);
                        
                        }
                        array_push($NodosYaConHoras,$NodosOrdenados[$i]);
                

            
            }
        

        
        return $NodosYaConHoras;

    }

    public function eliminarObjeto(&$arreglo, $objeto) {
        foreach ($arreglo as $key => $value) {
            if ($value == $objeto) {
                unset($arreglo[$key]);
                break; 
            }
        }
        // Reindexar el arreglo
        $arreglo = array_values($arreglo);

    }
    

     
    /* Compara El Nodo al que se le asignara la hora, Con solo los nodos que ya tienen una hora asignada
    Compara Fecha Y Hora para Saber si hay y retornar disponibilidad */
    public function CompararHorasNodos($nodo,$ArregloHorasNodo,$NodosFiltrados){
        
        $NodosConHoras = $NodosFiltrados;
        $consulta = new Consultas($this->Conexion);
        $comparador = $consulta->ContarMEspecialidadActivo($consulta->EspecialidadPorCita($nodo->datos["IdTipoCita"]));
        $contador =0;
        $variable="";
        
        foreach($NodosConHoras as $OtrosNodos){
            
            if($nodo->datos["FechaSolicitada"] == $OtrosNodos->datos["FechaSolicitada"]){

                $contador++;

                if($contador==$comparador){


                    $clave = array_search($OtrosNodos->datos["HoraAsignada"], $ArregloHorasNodo);

                    if ($clave !== false) {
       
                        unset($ArregloHorasNodo[$clave]);  
                        $ArregloHorasNodo = array_values($ArregloHorasNodo);
                        $contador =0;
       
                    }
                }
            }
        }
        
        if(count($ArregloHorasNodo)<1){

            return null;

        }

        return $ArregloHorasNodo[0];

    }



    public function FiltrarNodosNoNull($Nodos){
        $NodosFiltrados = array_filter($Nodos,function($nodo){
            return $nodo->datos["HoraAsignada"] != null;
        });

        return $NodosFiltrados;
    }

    public function FiltrarNodosNull($Nodos){
        $NodosFiltrados = array_filter($Nodos,function($nodo){
            return $nodo->datos["HoraAsignada"] == null;
        });

        return $NodosFiltrados;
    }


    public function ValidarDisponibilidadDoctor($Nodo,$Medicos,$NodosConMedicos){

        $ArrayMedicos = $Medicos;

        foreach($NodosConMedicos as $NodosYaAsignados){

            if($Nodo->datos["FechaSolicitada"] == $NodosYaAsignados->datos["FechaSolicitada"] && $Nodo->datos["HoraAsignada"] == $NodosYaAsignados->datos["HoraAsignada"]){

                foreach($ArrayMedicos as $medicos=>$datosmedico){

                    if ($datosmedico["IdDoctor"] === $NodosYaAsignados->datos["MedicoAsignado"]) { 

                        unset($ArrayMedicos[$medicos]);
                        $ArrayMedicos = array_values($ArrayMedicos);

                    }

                }      

            }

        }

        if(count($ArrayMedicos)<1){

            return null;

        }
       
        return $ArrayMedicos[0]["IdDoctor"];

    }



    public function AsignarMedico($Nodos){
        $NodosConHoras = $Nodos; //$this->FiltrarNodosNoNull($this->filtro2());

        //$NodosConHoras = $this->AsginarHora();
        $Consultar = new Consultas($this->Conexion);
        $NodosYaAsignados = array();
        $contador=0;
        
        foreach($NodosConHoras as $NodosActuales){

           $Medicos=$Consultar->CMEspecialidadActivo($Consultar->EspecialidadPorCita($NodosActuales->datos["IdTipoCita"]));

           if($contador==0){

            $NodosActuales->ModificarMedico($Medicos[$contador]["IdDoctor"]);

           }else{

            $MedicoDisponible = $this->ValidarDisponibilidadDoctor($NodosActuales,$Medicos,$NodosYaAsignados);
            $NodosActuales->ModificarMedico($MedicoDisponible);

           }

           array_push($NodosYaAsignados,$NodosActuales);
           $contador++;

        }

        return $NodosConHoras;

    }

    public function AsignarMedicoNodos(){
        $Arreglo_final=array();
        $NodosAgendados=$this->AsignarMedico($this->FiltrarNodosNoNull($this->filtro2()));
        /*$NodosSugerencias=$this->AsignarMedico($this->filtro3());

        foreach ($NodosAgendados as $num) {
            $index = array_search($num, $NodosSugerencias);
            if ($index !== false) {
                unset($NodosSugerencias[$index]);
            }
        }*/
        array_push($Arreglo_final,$NodosAgendados);

        
        //$NodosSugerencias=$this->filtro4();
        $NodosSugerencias=$this->AsignarMedico($this->filtro4());

        foreach ($NodosAgendados as $num) {
            $index = array_search($num, $NodosSugerencias);
            if ($index !== false) {
                unset($NodosSugerencias[$index]);
            }
        }

        //$NodosSugerencias1=$this->AsignarMedico($NodosSugerencias);
        array_push($Arreglo_final,$NodosSugerencias);
        
        return $Arreglo_final;
    }

}

?>