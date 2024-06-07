<?php 
    session_start(); 
    require_once ('conexion.php');

    if($_SESSION["id"]==null){
        echo "<script>window.location.href = '../index.php'</script>";
    }else{
        $id_user = $_SESSION['id'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> <!--Libreria de awesone-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Añadir jQuery aquí -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <link rel="stylesheet" href="../Css/style_user9.css">
    <title>MedPriority</title>
</head>
<body>

    <div class="conheader"> <!-- contenedor header -->

        <div class="logo">
                <input type="checkbox" id="toggleMenu">
                <label for="toggleMenu"><i class="fa fa-bars" class="img_logo"></i></label>
            <div class="img_logo">         
               
            </div>

            <div class="letras_logo">
                <p>MEDPRIORITY</p>
            </div>
        </div>

        <div class="datos_barra">
            <div class="name"><p> <?php echo htmlspecialchars($_SESSION['nombre']) ?> </p>  
            <div class="img_notificaion"></div>   </div>
            <div class="img_usuario"></div>
        </div>

    </div>
    <div class="congeneral"><!--barra lateral -->

        <div class="con_menu"><!-- contenedor del menu -->
            <div class="check-boton" id="closemenu">
                <i class="fa-solid fa-xmark"></i>
            </div>


                <div class="inicio"><!-- contenedores de el menu -->
                    <a href="../index.php">
                        
                        <div class="con_imagen" id="icono"> </div>
                    
                        <div class="enunciado">  Inicio</div>
                    </a>
                </div>
                <div class="notificaciones"> <p class="letras">Sesion Notificaciones </p> <div class="linea"><p></p> </div> </div>

                <div class="combo1_notificacion" >
                    <a href="#notificaciones">
                            
                        <div class="con_imagen2" id="icono"> </div>
                    
                        <div class="enunciado2" id="notificacion">  Notificaciones</div>
                    </a>
                </div>
                <div class="notificaciones"> <p class="letras">Sesion Hisotria Clinica </p> <div class="linea"><p></p></div> </div>

                <div class="combo1_notificacion" >
                    <a href="#inicio">
                        
                        <div class="con_imagen3" id="icono"> </div>
                
                        <div class="enunciado2" id="historia_clinica">  Historia Clinica</div>
                    </a>
                </div>
              <div class="notificaciones"> <p class="letras">Sesion Citas </p> <div class="linea"><p></p></div> </div>
              
                <div class="combo1_notificacion">
                    <div class="menu-item">
                        <div class="menu-title">
                            <div class="con_imagen4" id="icono"> </div>
                            <div class="enunciado2">  Citas</div>
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <ul class="submenu">
                            <li><a href="#AgregarCita" id="add_cita">Agendar Citas</a></li>
                            <li><a href="#HistorialCitas">Historial de Citas</a></li>
                            <li><a href="#EstadoCitas" id="estado_cita">Estado Citas</a></li>
                        </ul>
                    </div>
                </div>

                
                <div class="close_sesion" >
                    <a href="cerrarsesion.php" class="texto_sesion">
                        <i class="fa-solid fa-power-off" style="color: #080808;"></i> <p>Cerrar Sesión</p>
                    </a>
                </div>
        </div>
        <main class="principal">
            <!--------- -----------------HISTORIA CLINICA---------------------- -->

            <div id="prueba2" class="historialcita">
                <div class="cont_titulo">
                    <p> Historia Clinica</p>
                </div>

                <div class="cont_general_all2" >
                    <div class="cont2_elegir" id="cont2_historial">
                            <h4>Elige el tipo de historia clinica:</h4>
                            
                            <div class="comb" id="form_1">
                                <input type="radio" name="consulta" id="radio" value="1" checked>
                                <p>Consulta Externa</p>
                            </div>  

                            <div class="comb">
                                <input type="radio" name="consulta" id="radio1" value="3">
                                <p>Consulta Odontológica</p>
                            </div>
                            <div class="comb">
                            <button id="download-pdf" >Descargar PDF</button>

                            </div>
                    </div>
                    <div class="historial_clinico" id="historial" >
                        <div class="cont_logo_name">
                            <div class="img_log"></div>
                            <p>MEDPRIORITY</p>
                        </div>
                        <p class="nit">Nit:  1122540000-1</p>

                        <div class="datos_historia" id="datos"> </div>
                        
                            <div class="title">DATOS PERSONALES</div>

                            <div class="general">
                                <?php
                                $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_user'";
                                $consulta = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($consulta) > 0){
                                    $datos = mysqli_fetch_assoc($consulta);
                                ?>
                                    <div class="container1">
                                         <div class="cont-1">    <p class="negrita">Nombre Paciente: </p> <p class="resultados"><?php echo $datos['nombre']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita">Fecha de Nacimiento: </p><p class="resultados"><?php echo $datos['fecha_nacimiento']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita">Dirección:</p><p class="resultados"><?php echo $datos['direccion']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita">Procedencia:</p><p class="resultados"><?php echo $datos['procedencia']; ?></p></div>
                                         <div class="cont-1">    <p class="negrita">Estado Civil:</p><p class="resultados"><?php echo $datos['estado_civil']; ?></p></div>
                                    </div>

                                    <div class="container1">
                                    <div class="cont-1">        <p class="negrita">Identificación:</p><p class="resultados"><?php echo $datos['id_usuario']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita">Edad: </p><p class="resultados"><?php echo $datos['edad']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita">Teléfono: </p><p class="resultados"><?php echo $datos['telefono']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita">Tipo de Documento: </p><p class="resultados"><?php echo $datos['estado_civil']; ?></p></div>
                                    <div class="cont-1">        <p class="negrita">Sexo: </p><p class="resultados"><?php echo $datos['genero']; ?></p></div>
    
                                </div>
                            </div>
                                    <div class="afil">
                                        <div class="title2">DATOS AFILIACION</div>
                                        <div class="cont-2">    <p class="afi">Tipo de Afiliación: </p> <p class="resultados"><?php echo $datos['tipo_afiliacion']; ?></p></div>

                                        <!-- <p class="afi">Tipo de Afiliación: <?php echo $datos['tipo_afiliacion']; ?></p> -->

                                    </div>
                                            <?php
                                            } else {
                                                echo '<p>No se encontraron resultados.</p>';
                                            }
                                            ?>
                            <div class="title">ANAMNESIS</div>

                            <div class="descripcion_paciente" id="anamesis">

                            <!-- <div class="title2">ASPECTO Y ESTADO GENERAL DEL PACIENTE</div> -->

                            </div>
                    </div>

                </div>
            </div>
            <!----------------------NOTIFICACIONES--------------------------------------- -->
            <div id="prueba" class="historialcita">
                <div class="cont_titulo">
                    <p>Estado Citas</p>
                </div>

                    <div class="cont_general_all">
                        <div class="notificacion">
                        <?php
                            $sql2 = "SELECT * FROM preagendamiento p
                                    INNER JOIN sugerencias_citas sc ON p.id_preagendamiento = sc.id_preagendamiento 
                                    WHERE p.id_usuario = '$id_user'";

                            $consulta_sugerencias = mysqli_query($conn, $sql2);
                            ?>

                            <?php if (mysqli_num_rows($consulta_sugerencias) > 0): ?>
                                <table class="tabla">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($resultado = mysqli_fetch_array($consulta_sugerencias)): ?>
                                        <tr>
                                            <td><?php echo $resultado['fecha']; ?></td>
                                            <td><?php echo $resultado['hora_reservada']; ?></td>
                                            <td><?php echo $resultado['estado']; ?></td>
                                            <td>
                                                <form method="POST" action="Usuario/sugerencias.php" style="display:inline;" id="agendar_suge">
                                                    <input type="hidden" name="id_sugerencia" value="<?php echo $resultado['id']; ?>">
                                                    <button type="submit" id="agendar_suge">Agendar</button>
                                                </form>
                                                <form method="POST" action="liberar_citas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit">No Agendar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="no-citas">
                                    <p>No se encontraron citas para este usuario.</p>
                                </div>
                            <?php endif; ?>
                
                       
                        </div>
                    </div>
            </div>

            <!----------------------Agendar Cita--------------------------------------- -->

            <div id="agregar_cita" class="historialcita">
                <div class="cont_titulo">
                    <p>Agregar Cita</p>
                </div>
                <div class="cont_general_all">
                    <div class="preguntas_formulario">
                        <div class="cont_preguntas">
                            <p>Identificación</p>
                            <input type="text" id="identificacion" name="identificacion" value="<?php echo $_SESSION['id'] ?>" disabled>
                        </div>
                        <div class="cont_preguntas" id="tipo_identificacion">
                            <p>Tipo de Identificación</p>
                            <input type="text" id="tipo_identificacion" name="tipo_identificacion" value="<?php echo $_SESSION['tipo_documento'] ?>" disabled>
                        </div>
                        <div class="cont_preguntas" id="nombre">
                            <p>Nombres</p>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre_completo'] ?>" disabled>
                        </div>
                    </div>
    
                    <form action="./Usuario/procesar_cita.php" method="post" class="contenedor_formulario" id="formulario_general">
                        
                        <div class="preguntas_formulario2">
                            <div class="cont_preguntas2">
                                <p>Edad</p>
                                <input type="text" id="edad" name="edad" value="<?php echo $_SESSION['edad'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas2" id="tipo_afiliacion">
                                <p>Tipo de Afiliación</p>
                                <input type="text" id="tipo_afiliacion" name="tipo_afiliacion" value="<?php echo $_SESSION['tipo_afiliacion'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas2" id="trabajo">
                                <p>Trabajo</p>
                                <input type="text" id="trabajo" name="trabajo" value="<?php echo $_SESSION['estado'] ?>" disabled>
                            </div>
                        </div>

                        <div class="preguntas_formulario2">
                            <div class="cont_preguntas2" id="enfermedads">
                                <p>Patología </p>
                                <input type="text" id="enfermedad" name="enfermedad" value="<?php echo $_SESSION['patologia'] ?>" disabled>
                            </div>
                            <div class="cont_preguntas" id="tipo_identificacion">
                            </div>
                            <div class="cont_preguntas2" id="nivel_gravedad">
                                <p>Nivel de Gravedad</p>
                                <input type="text" id="nivel_gravedad" name="nivel_gravedad"  disabled>
                            </div>
                        </div>

                        <!--Agendar cita-->

                    <div class="preguntas_formulario2">
                            <div class="cont_preguntas3">
                                <p>Tipo de Cita</p>
                                <select class="tipocita" name="tipocita">
                                <?php
                                        $validar_citas="SELECT * FROM citas_agendadas ca  INNER JOIN preagendamiento p ON ca.id_preagendamiento= p.id_preagendamiento WHERE id_usuario='$id_user'";
                                        $consul2= mysqli_query($conn,$validar_citas);
                                        $sql="SELECT * FROM tipo_cita";
                                        $consul= mysqli_query($conn,$sql);
                                        $num=0;
                                        if(mysqli_num_rows($consul2)>0){
                                            while($sihay= $consul2->fetch_assoc()){
                                                $dato=$sihay['id_tipo_cita'];
                                                    if($consul){
                                                        while($desplegar= $consul->fetch_assoc()){
                                                            if($desplegar['id']== $dato || $num==3){
                                                                echo "<option value='".$desplegar['id']."' disabled>".$desplegar['enombre']."</option>";
                                                            }else{
                                                                echo "<option value='".$desplegar['id']."'>".$desplegar['enombre']."</option>";
                                                            }
                                                        }
                                                    }
                                            }
                                        }else{
                                                    if($consul){
                                                        while($desplegar= $consul->fetch_assoc()){
                                                            echo "<option value='".$desplegar['id']."'>".$desplegar['enombre']."</option>";
                                                        }
                                                    }
                                        }
                                ?>
                                </select>

                            </div>
                        <div class="cont_preguntas3" id="fecha">
                            <p>Fecha</p>
                            <input type="date" id="fecha1" name="fecha"  min="<?php echo date('Y-m-d', strtotime('+2 day')); ?>" required>

                        </div>
                        <div class="cont_preguntas3" id="hora_inicio">
                            <p>Hora Inicio</p>
                            <select name="hora_inicio" id="hora_rango1" required>
                            <option value="">Seleccionar</option>

                            <?php
                                        $sql="SELECT * FROM horarios WHERE EXTRACT(MINUTE FROM hora_inicio) IN (0, 30);";
                                        $consul2= mysqli_query($conn,$sql);

                                        if($consul2){
                                            while($desplegar2= $consul2->fetch_assoc()){
                                                echo "<option value='".$desplegar2['id_horario']."'>".$desplegar2['hora_inicio']."</option>";
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="cont_preguntas3" id="hora_final">
                            <p>Hora Final</p>
                            <select name="hora_fin" id="rango" required></select>
                        </div>

                        <div class="cont_preguntas3_add">
                            <p>Añadir Cita: </p>
                            <div class="img"></div>
                        </div>

                    </div>
                    <div class="preguntas_formulario2">
                       
                        <div class="cont_preguntas2" id="fecha2_">
                            <p>Fecha</p>
                            <input type="date" id="fecha2" name="fecha2" >

                        </div>
                        <div class="cont_preguntas2" id="hora_inicio">
                            <p>Hora Inicio</p>

                            <select name="hora_inicio_2" id="hora_rango2" >
                                    <option value="">Seleccionar</option>
                            <?php
                                        $sql="SELECT * FROM horarios WHERE EXTRACT(MINUTE FROM hora_inicio) IN (0, 30);";
                                        $consul2= mysqli_query($conn,$sql);

                                        if($consul2){
                                            while($desplegar3= $consul2->fetch_assoc()){
                                                echo "<option value='".$desplegar3['id_horario']."'>".$desplegar3['hora_inicio']."</option>";
                                            }
                                        }
                                    ?>
                            </select>
                        </div>

                        <div class="cont_preguntas2" id="hora_final">
                            <p>Hora Final</p>
                            <select name="hora_fin2" id="rango_2"></select>
                        </div>


                    </div>
                    
                    <div class="cont_enviar"> <button type="" class="submit-btn" id="solicitar">Enviar</button></div> 

                    </form>
                </div>
            </div>
        
        <!----------------------------------Estado de la cita ------------------------------------->
                
        <div id="estadocita" class="historialcita">
            <div class="cont_titulo">
                <p>Estado Citas</p>
            </div>

            <div class="cont_general_all">
                <div class="notificacion">

                <?php
                $id_user = $_SESSION['id'];
                $sql1 = "SELECT * FROM preagendamiento p
                        INNER JOIN citas_agendadas ca ON p.id_preagendamiento = ca.id_preagendamiento 
                        INNER JOIN doctores d ON d.id_doctor = ca.id_DoctorAsignado 
                        INNER JOIN doctor_consultorio dc ON dc.id_doctor = d.id_doctor 
                        INNER JOIN usuario u ON u.id_usuario = d.id_usuario 
                        WHERE p.id_usuario = '$id_user'";

                $consulta_citas = mysqli_query($conn, $sql1);
                ?>

                <?php if (mysqli_num_rows($consulta_citas) > 0): ?>
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Fecha Asignada</th>
                                <th>Hora Asignada</th>
                                <th>Doctor</th>
                                <th>Consultorio</th>
                                <th>Estado</th>
                                <th>Cancelar</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($resultado = mysqli_fetch_array($consulta_citas)): ?>
                            <tr>
                                <td><?php echo $resultado['FechaAsignada']; ?></td>
                                <td><?php echo $resultado['HoraAsignado']; ?></td>
                                <td><?php echo $resultado['nombre']; ?></td>
                                <td><?php echo $resultado['id_consultorio']; ?></td>
                                <td>Procesando</td>
                                <td><form method="POST" action="Usuario/cancelar_cita.php" style="display:inline;">
                                    <input type="hidden" name="id_preagendamiento" value="<?php echo $resultado['id_preagendamiento']; ?>">
                                    <button type="submit">Cancelar Cita</button>
                                </form></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>

                    
                <?php else: ?>
                    <?php
                            $sql2 = "SELECT * FROM preagendamiento p
                                    INNER JOIN sugerencias_citas sc ON p.id_preagendamiento = sc.id_preagendamiento 
                                    WHERE p.id_usuario = '$id_user'";

                            $consulta_sugerencias = mysqli_query($conn, $sql2);
                            ?>

                            <?php if (mysqli_num_rows($consulta_sugerencias) > 0): ?>
                                <table class="tabla">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($resultado = mysqli_fetch_array($consulta_sugerencias)): ?>
                                        <tr>
                                            <td><?php echo $resultado['fecha']; ?></td>
                                            <td><?php echo $resultado['hora_reservada']; ?></td>
                                            <td><?php echo $resultado['estado']; ?></td>
                                            <td>
                                                <form method="POST" action="citas_confirmadas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit">Agendar</button>
                                                </form>
                                                <form method="POST" action="liberar_citas.php" style="display:inline;">
                                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                    <button type="submit">No Agendar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="no-citas">
                                    <p>No se encontraron citas para este usuario.</p>
                                </div>
                            <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    
        </main>
        <div id="custom-alert" class="custom-alert">
            <div class="alert-content">
                <h2 id="alert-title"></h2>
                <p id="alert-message"></p>
                <button id="close-alert">Aceptar</button>
            </div>
        </div>

    </div>  
    <script src="../Js/User/aler_cita_cancelar.js"></script>
    <script src="../Js/User/desplegar_menu.js"></script>
    <script src="../Js/User/desplegar_containers.js"></script>
    <script src="../Js/User/desabilitadias_calendario.js"></script>                    
    <script src="../Js/User/ajax.js"></script>
<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        // Seleccionar el contenedor que deseas convertir a PDF
        // var element =  document.getElementById('historial');

        // // Opciones de configuración para html2pdf
        // var opt = {
        //     margin:       1,
        //     filename:     'historial_clinico.pdf',
        //     image:        { type: 'jpeg', quality: 0.98 },
        //     html2canvas:  { scale: 2 },
        //     jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        // };

        // // Generar y descargar el PDF
        // html2pdf().set(opt).from(element).save();
            window.jsPDF = window.jspdf.jsPDF;


            //     // Crear una nueva instancia de jsPDF
            // const doc = new jsPDF();

            //     // Seleccionar el contenido HTML que queremos convertir en PDF
            // const content = document.getElementById('historial').innerHTML;

            //     // Agregar el contenido HTML al PDF
            // doc.text(content, 10, 10);

            //     // Descargar el PDF
            // doc.save('HistoriaClinica.pdf');

            const content = document.getElementById('historial');

            html2canvas(content).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const doc = new jsPDF();

                const imgProps = doc.getImageProperties(imgData);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                doc.save('documento.pdf');
            });
            
    });

//     window.jsPDF = window.jspdf.jsPDF;

// function generatePDF() {
//     // Crear una nueva instancia de jsPDF
//     const doc = new jsPDF();

//     // Seleccionar el contenido HTML que queremos convertir en PDF
//     const content = document.getElementById('historial').innerHTML;

//     // Agregar el contenido HTML al PDF
//     doc.text(content, 10, 10);

//     // Descargar el PDF
//     doc.save('documento.pdf');
//}

</script>

    <script>
        
          document.addEventListener('DOMContentLoaded', function() {
        // Función para enviar la opción seleccionada
        function enviarOpcionSeleccionada(opcionSeleccionada) {
            $.ajax({
                url: "./Usuario/historia_clinica.php",
                type: "POST",
                data: { 
                    opcion_actual: opcionSeleccionada,
                    id_user: <?php echo json_encode($id_user); ?>
                },
                success: function(respon3) {
                    console.log("Respuesta del servidor:", respon3);
                    document.getElementById('datos').innerHTML = respon3;
                },
                error: function() {
                    alert("Error al cargar la opción seleccionada");
                }
            });
        }
        function enviarOpcionSeleccionada2(opcionSeleccionada) {
            $.ajax({
                url: "./Usuario/enfermedades.php",
                type: "POST",
                data: { 
                    opcion_actual: opcionSeleccionada,
                    id_user: <?php echo json_encode($id_user); ?>
                },
                success: function(respon3) {
                    console.log("Respuesta del servidor2-------:", respon3);
                    document.getElementById('anamesis').innerHTML = respon3;
                },
                error: function() {
                    alert("Error al cargar la opción seleccionada");
                }
            });
        }
        // Enviar la opción por defecto al cargar la página
        const opcionPorDefecto = document.querySelector('input[name="consulta"]:checked').value;
        enviarOpcionSeleccionada(opcionPorDefecto);
        enviarOpcionSeleccionada2(opcionPorDefecto);

        // Asignar evento click a los radios
        document.querySelectorAll('input[name="consulta"]').forEach(radio => {
            radio.addEventListener('click', () => {
                const opcionSeleccionada = radio.value;
                console.log('Valor seleccionado:', opcionSeleccionada);
                enviarOpcionSeleccionada(opcionSeleccionada);
                enviarOpcionSeleccionada2(opcionSeleccionada);

            });
        });
    });




</script>
</body>
</html>
