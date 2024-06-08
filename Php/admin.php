<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medpriority ADMIN</title>
    <link rel="stylesheet" href="../Css/admin3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<!-- -------------------------------MODAL------------------------------------------ -->

<?php
    require_once 'conexion.php';

    $bruh = "SELECT * FROM usuario WHERE id_rol='3' OR id_rol='2'";   //jiji
    $q = mysqli_query( $conn, $bruh );
        if(mysqli_num_rows($q)>0){
            while($ff =mysqli_fetch_assoc($q)){
                $modalId = 'modal_' . $ff['id_usuario'];
                $identi = $ff['id_usuario'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($ff['nombre'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">Tipo de Documento
            <input type="text" required name=m_id_type value="<?php echo htmlspecialchars($ff['tipo_documento'])?>">
        </div>
        <div class="edit-modal">Numero de Documento
            <input type="text" disabled required name=m_id value="<?php echo htmlspecialchars($ff['id_usuario'])?>">
        </div>
        <div class="edit-modal">Nombre
            <input type="text" required name=m_name value="<?php echo htmlspecialchars($ff['nombre'])?>">
        </div>
        <div class="edit-modal">Edad
            <input type="text" required name=m_age value="<?php echo htmlspecialchars($ff['edad'])?>">
        </div>
        <div class="edit-modal">Sexo
            <input type="text" required name=m_sexmoneyfeelingsdie value="<?php echo htmlspecialchars($ff['genero'])?>">
        </div>
        <div class="edit-modal">Direccion
            <input type="text" required name=m_address value="<?php echo htmlspecialchars($ff['direccion'])?>">
        </div>
        <div class="edit-modal">Telefono
            <input type="text" required name=m_pickupyophonebaby value="<?php echo htmlspecialchars($ff['telefono'])?>">
        </div>
        <div class="edit-modal">Correo Electronico
            <input type="email" required name=m_email value="<?php echo htmlspecialchars($ff['correo'])?>">
        </div>
        <div class="edit-modal">Tipo de Afiliacion
            <input type="text" required name=m_afi value="<?php echo htmlspecialchars($ff['tipo_afiliacion'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-user" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>
<div id="overlay"></div>

<!-- -------------------------------MODAL CITAS------------------------------------------ -->

<?php
    require_once 'conexion.php';

    $mod_cita = "SELECT * FROM preagendamiento p
    INNER JOIN usuario u ON p.id_usuario = u.id_usuario
    INNER JOIN tipo_cita tc ON p.id_tipo_cita = tc.id
    INNER JOIN horarios h ON h.id_horario = p.hora_inicio";   //cita   //  TEST MODAL CITAS

    $que = mysqli_query( $conn, $mod_cita );
        if(mysqli_num_rows($que)>0){
            while($mcita =mysqli_fetch_assoc($que)){
                $modalcId = 'modalci_' . $mcita['id_preagendamiento'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalcId?>">
    <div class="modal-header">
        <span>Cita de <?php echo htmlspecialchars($mcita['nombre'])?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Cita
            <input type="text" disabled required name=mc_idcita value="<?php echo htmlspecialchars($mcita['id_preagendamiento'])?>">
        </div>
        <div class="edit-modal">Identificacion Paciente
            <input type="text" disabled required name=mc_idpaciente value="<?php echo htmlspecialchars($mcita['id_usuario'])?>">
        </div>
        <div class="edit-modal">Nombre Paciente
            <input type="text" disabled required name=mc_namepaciente value="<?php echo htmlspecialchars($mcita['nombre'])?>">
        </div>
        <div class="edit-modal">Tipo de Cita
            <select name=mc_tipocita>
                <?php 
                    $q_mcita = "SELECT * FROM tipo_cita";
                    $selmcita = mysqli_query( $conn, $q_mcita );
                    if(mysqli_num_rows($selmcita)>0){
                        while($selectmcita = mysqli_fetch_assoc($selmcita)){

                        $bot = ($selectmcita['id'] == $mcita['id']) ? 'selected' : '';
                ?>        
                    <option value="<?php echo $selectmcita['id']; ?>" <?php echo $bot?>>
                    <?php echo htmlspecialchars($selectmcita['enombre'])?>
                    </option>

                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="edit-modal">Fecha (preagendamiento)
            <input type="date" required name=mc_date value="<?php echo htmlspecialchars($mcita['fecha'])?>">
        </div>
        <?php 
            $default = $mcita['id_horario'];
            $horafin = $mcita['hora_fin'];
        ?>
        <div class="edit-modal">Hora inicio (preagendamiento)
            <select name=mc_start_time> 
                <?php 
                    $q_sel_horas = "SELECT * FROM horarios";
                    $quesel = mysqli_query( $conn, $q_sel_horas );
                    if(mysqli_num_rows($quesel)>0){
                        while($select = mysqli_fetch_assoc($quesel)){

                            $selected = ($select['id_horario'] == $default) ? 'selected' : '';
                ?>        
                    <option value="<?php echo $select['id_horario']; ?>" <?php echo $selected?>>
                    <?php echo htmlspecialchars($select['hora_inicio'])?>
                    </option>

                <?php
                        }
                    }
                ?>
            </select>
        </div>
        
        <div class="edit-modal">Hora fin (preagendamiento)
            <?php 
                    $query_sel_horas = "SELECT * FROM horarios WHERE id_horario = $horafin";

                    $queryselect = mysqli_query( $conn, $query_sel_horas );
                    if(mysqli_num_rows($queryselect)>0){
                        while($select_end = mysqli_fetch_assoc($queryselect)){

                            $value = $select_end['id_horario'];
                        }
                    }
            ?>

            <select name=mc_end_time> 
                <?php 
                    $q_sel_horas = "SELECT * FROM horarios";
                    $quesel = mysqli_query( $conn, $q_sel_horas );
                    if(mysqli_num_rows($quesel)>0){
                        while($select = mysqli_fetch_assoc($quesel)){

                            $selected = ($select['id_horario'] == $value) ? 'selected' : '';
                ?>        
                    <option value="<?php echo $select['id_horario']; ?>" <?php echo $selected?>>
                    <?php echo htmlspecialchars($select['hora_inicio'])?>
                    </option>

                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="edit-modal">Valoracion
            <input type="text" required name=mc_valor value="<?php echo htmlspecialchars($mcita['valoracion'])?>">
        </div>
        
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-preagendamiento" data-modal-id="<?php echo $modalcId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>

<!-- -------------------------------MODAL PATOLOGIA------------------------------------------ -->

<?php
    require_once 'conexion.php';

    $mod_pato = "SELECT * FROM patologias";   //jiji
    $q = mysqli_query( $conn, $mod_pato );
        if(mysqli_num_rows($q)>0){
            while($quack =mysqli_fetch_assoc($q)){
                $modalId = 'modalpato_' . $quack['id_patologia'];
                $identi = $quack['id_patologia'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($quack['nombre_patologia'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Patologia
            <input type="email" disabled name=mp_id value="<?php echo htmlspecialchars($quack['id_patologia'])?>">
        </div>
        <div class="edit-modal">Nombre Patologia
            <input type="email" required name=mp_name value="<?php echo htmlspecialchars($quack['nombre_patologia'])?>">
        </div>
        <div class="edit-modal">Puntuacion
            <input type="text" required name=mp_score value="<?php echo htmlspecialchars($quack['puntuacion'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-patologia" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>

<!-- -------------------------------MODAL TIPO CITA------------------------------------------ -->

<?php
    require_once 'conexion.php';

    $mod_typecita = "SELECT * FROM tipo_cita";
    $queso = mysqli_query( $conn, $mod_typecita );
        if(mysqli_num_rows($queso)>0){
            while($mytype =mysqli_fetch_assoc($queso)){
                $modalId = 'modaltipocita_' . $mytype['id'];
                $identi = $mytype['id'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($mytype['enombre'])?></span>
        <span><?php echo htmlspecialchars($identi)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Tipo Cita
            <input type="email" disabled name=mtc_id value="<?php echo htmlspecialchars($mytype['id'])?>">
        </div>
        <div class="edit-modal">Nombre Patologia
            <input type="email" required name=mtc_name value="<?php echo htmlspecialchars($mytype['enombre'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-typecita" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>

<!-- -------------------------------MODAL ESPECIALIDAD------------------------------------------ -->

<?php
    require_once 'conexion.php';

    $mod_especial = "SELECT * FROM especialidades";   //jiji
    $query_special = mysqli_query( $conn, $mod_especial );
        if(mysqli_num_rows($query_special)>0){
            while($special =mysqli_fetch_assoc($query_special)){
                $modalId = 'modalspecial_' . $special['id_especialidad'];
                $identispe = $special['id_especialidad'];

                // --------------------------------------
?>

<div class="modal" id="<?php echo $modalId?>">
    <div class="modal-header">
        <span><?php echo htmlspecialchars($special['especialidad'])?></span>
        <span><?php echo htmlspecialchars($identispe)?></span>
        <button id=chao data-close-button class="close-button">&times;</button>
    </div>
    
    <div class="modal-body">
        <div class="edit-modal">ID Especialidad
            <input type="email" disabled name=ms_id value="<?php echo htmlspecialchars($special['id_especialidad'])?>">
        </div>
        <div class="edit-modal">Nombre Especialidad
            <input type="email" required name=ms_name value="<?php echo htmlspecialchars($special['especialidad'])?>">
        </div>
        <div class="modal-savebutton">
            <input type="hidden" name="id_a_cambiar">
            <button class="save-button" id="save-especial" data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
    
            </div>
<?php
            }
        }
?>

<!-- -----------------------------------------CONTENT----------------------------------- -->
<!-- -----------------------------------------CONTENT----------------------------------- -->
<!-- -----------------------------------------CONTENT----------------------------------- -->
<!-- -----------------------------------------CONTENT----------------------------------- -->
<!-- -----------------------------------------CONTENT----------------------------------- -->
    <section class="general_todo">
        <div class="conheader">  <!-- contenedor header o barra principal -->


            <div class="logo"><!-- contenedor del logo y la letras del logo -->
                <div class="img_logo"></div>
                <div class="letras_logo">
                    <p>MEDPRIORITY</p>
                </div>
            </div>

            <div class="datos_barra">
                <p><?php echo htmlspecialchars($_SESSION['nombre']) ?></p>

                <div class="img_notificaion"></div>
    
                <div class="img_usuario"></div>
            </div>

        </div>

        <div class="congeneral"><!--contendor 2 general para el menu y los formularios -->

            <div class="con_menu"><!-- contenedor del menu -->
                <div class="cont_menu_sub">


                
                <div class="inicio"><!-- contenedores de el menu -->
                    <a href="#inicio">
                        <div class="con_imagen" id="icono"> <img src="../Img/casa.png" alt=""></div>
                    </a>
                    <a href="../index.php">
                        <div class="con_opcion">
                            <h4>Inicio</h4>
                        </div>
                    </a>
                </div>


                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar medicos</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_med">
                        <div class="con_imagen" id="icono"> <img src="../Img/resume.png" alt=""></div>
                    </a>
                    <a href="#reg_med">
                        <div class="con_opcion">
                            <h4>Registrar medico</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_med">
                        <div class="con_imagen" id="icono"> <img src="../Img/customer.png" alt=""></div>
                    </a>
                    <a href="#panel_med">
                        <div class="con_opcion">
                            <h4>Panel medicos</h4>
                        </div>
                    </a>
                </div>

                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar pacientes</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_pac">
                        <div class="con_imagen" id="icono"> <img src="../Img/historiaclinica.png" alt=""></div>
                    </a>
                    <a href="#reg_pac">
                        <div class="con_opcion">
                            <h4>Registrar paciente</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_pac">
                        <div class="con_imagen" id="icono"> <img src="../Img/user_panel.png" alt=""></div>
                    </a>
                    <a href="#panel_pac">
                        <div class="con_opcion">
                            <h4>Panel pacientes</h4>
                        </div>
                    </a>
                </div>

                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar citas</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_cita">
                        <div class="con_imagen" id="icono"> <img src="../Img/calendar.png" alt=""></div>
                    </a>
                    <a href="#reg_cita">
                        <div class="con_opcion">
                            <h4>Registrar cita</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_cita">
                        <div class="con_imagen" id="icono"> <img src="../Img/time-planning.png" alt=""></div>
                    </a>
                    <a href="#panel_cita">
                        <div class="con_opcion">
                            <h4>Panel citas solicitadas</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_cita_agendada">
                        <div class="con_imagen" id="icono"> <img src="../Img/appointment.png" alt=""></div>
                    </a>
                    <a href="#panel_cita_agendada">
                        <div class="con_opcion">
                            <h4>Panel citas agendadas</h4>
                        </div>
                    </a>
                </div>

                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar patologias</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_pato">
                        <div class="con_imagen" id="icono"> <img src="../Img/paper.png" alt=""></div>
                    </a>
                    <a href="#reg_pato">
                        <div class="con_opcion">
                            <h4>Registrar patologia</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_pato">
                        <div class="con_imagen" id="icono"> <img src="../Img/disease.png" alt=""></div>
                    </a>
                    <a href="#panel_pato">
                        <div class="con_opcion">
                            <h4>Panel patologias</h4>
                        </div>
                    </a>
                </div>

                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar tipos cita</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_tcita">
                        <div class="con_imagen" id="icono"> <img src="../Img/type.png" alt=""></div>
                    </a>
                    <a href="#reg_tcita">
                        <div class="con_opcion">
                            <h4>Registrar tipo de cita</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_tcita">
                        <div class="con_imagen" id="icono"> <img src="../Img/med-list.png" alt=""></div>
                    </a>
                    <a href="#panel_tcita">
                        <div class="con_opcion">
                            <h4>Panel tipo de citas</h4>
                        </div>
                    </a>
                </div>

                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar especialidades</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>
                <div class="inicio">
                    <a href="#reg_especi">
                        <div class="con_imagen" id="icono"> <img src="../Img/add-file.png" alt=""></div>
                    </a>
                    <a href="#reg_especi">
                        <div class="con_opcion">
                            <h4>Registrar especialidades</h4>
                        </div>
                    </a>
                </div>

                <div class="inicio">
                    <a href="#panel_especi">
                        <div class="con_imagen" id="icono"> <img src="../Img/list.png" alt=""></div>
                    </a>
                    <a href="#panel_especi">
                        <div class="con_opcion">
                            <h4>Panel especialidades</h4>
                        </div>
                    </a>
                </div>


                <!-- ---------------------------------------------- -->
                <div class="secion1">
                    <div class="seci_notificaiones">
                        <h2>Gestionar roles</h2>
                    </div>
                    <div class="linecita">
                        <hr>
                    </div>
                </div>

                <div class="inicio">
                    <a href="#panel_roles">
                        <div class="con_imagen" id="icono"> <img src="../Img/user_panel.png" alt=""></div>
                    </a>
                    <a href="#panel_roles">
                        <div class="con_opcion">
                            <h4>Panel roles</h4>
                        </div>
                    </a>
                </div>

                </div>
            </div> 


            <!--   contenedor main donde se recargaran los contenedores  -->
            <main>

                    <!-- ---------------REGISTRO MEDICOS---------------- -->
                    <div id="reg_med" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar medico</p>
                        </div>
                        
                            <div class="cont_general_all">

                                <div class="survey-container">
                                    <div class="question">
                                        <label for="id-number">No. Identificación</label>
                                        <input type="text" name="doc_id-number" required>
                                    </div>
                                    <div class="question">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="doc_name" required>
                                    </div>
                                    <div class="question">
                                        <label for="age">Edad</label>
                                        <input type="text" name="doc_age" required>
                                    </div>
                                    <div class="question">
                                        <label for="phone-number">Teléfono</label>
                                        <input type="text" name="doc_phone-number" required>
                                    </div>
                                    <div class="question">
                                        <label for="email">Correo Electronico</label>
                                        <input type="email" name="doc_email" required>
                                    </div>
                                    <div class="question">
                                        <label for="sex">Sexo</label>
                                        <input type="text" name="doc_sex" required>
                                    </div>
                                    <div class="save">
                                        <div class="save-button" id="guardar-button">
                                        <a href="#">Guardar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>

                    <!-- --------------PANEL MEDICOS----------------- -->
                    <div id="panel_med" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel medicos</p>
                            <div class="search-container">
                                <input type="text" id="doctor_search">
                                <div class="search-img"></div>
                            </div>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tablas"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Identificación</th>
                                        <th>Nombres</th>
                                        <th>Edad</th>
                                        <th>Teléfono</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql = "SELECT * FROM usuario WHERE id_rol='3'";    //medico
                                        $consulta = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($consulta)>0){
                                            while($fila =mysqli_fetch_assoc($consulta)){
                                        ?>
                                        <tr id=table_row_<?php echo $fila['id_usuario']?>>
                                            <td> <?php echo $fila['id_usuario'];?></td>
                                            <td> <?php echo $fila['nombre'];?></td>
                                            <td> <?php echo $fila['edad'];?></td>
                                            <td> <?php echo $fila['telefono'];?></td>
                                            <td><button data-modal-target="#modal_<?php echo $fila['id_usuario'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $fila['id_usuario'];?>" data-role='medico'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- --------------REGISTRO PACIENTES-------------- -->
                    <div id="reg_pac" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar paciente</p>
                        </div>
                            <div class="cont_general_all">

                                    <div class="pat-survey-container">
                                        <div class="pat-question">
                                            <label for="pat-id-type">Tipo de Documento</label>
                                            <select name="pat-id-type" id="pat-id-type">
                                                <option value="null"></option>
                                                <option value="Cedula de Ciudadania">Cédula de Ciudadanía</option>
                                                <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                                <option value="Registro Civil">Registro Civil</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                            </select>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-id-number">No. Documento</label>
                                            <input type="text" name="pat_id-number" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-name">Nombres</label>
                                            <input type="text" name="pat_name" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-email">Correo Electronico</label>
                                            <input type="text" name="pat_email" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-age">Edad</label>
                                            <input type="text" name="pat_age" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-phone-number">Teléfono</label>
                                            <input type="text" name="pat_phone-number" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-sex">Genero</label>
                                            <input type="text" name="pat_sex" required>
                                        </div>
                                        <div class="pat-question">
                                            <label for="pat-residence-area">Tipo de Afiliacion</label>
                                            <select name="pat-afi" id="pat-afi">
                                                <option value="null"></option>
                                                <option value="Contributivo">Contributivo</option>
                                                <option value="Subsidiado">Subsidiado</option>
                                            </select>
                                        </div>
                                        <div class="save-patient">
                                            <div class="save-pat-button" id="paciente-nuevo">
                                                <a href="#">Guardar</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>

                    <!-- ------------PANEL PACIENTES--------------- -->
                    <div id="panel_pac" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel pacientes</p>
                        </div>
                            <div class="cont_general_all">
                            <div class="patient-main" id="contain_tablas_pac">
                        <table>
                            <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombres</th>
                                <th>Edad</th>
                                <th>Género</th>
                                <th>Tipo de Afiliación</th>
                                <th style="width: 15%;"></th>
                                <th style="width: 15%;"></th>
                            </tr>
                            </thead>
                            
                            <tbody>

                            <?php

                            require_once  'conexion.php';
 
                            $sql2 = "SELECT * FROM usuario WHERE id_rol='2'";   //paciente
                            $query = mysqli_query($conn, $sql2 );
                            if(mysqli_num_rows($query)>0){
                                while($row = mysqli_fetch_assoc($query)){

                            ?>
                                <tr id=table_row_<?php echo $row['id_usuario']?>>
                                    <td><?php echo $row['id_usuario'];?></td>
                                    <td><?php echo $row['nombre'];?></td>
                                    <td><?php echo $row['edad'];?></td>
                                    <td><?php echo $row['genero'];?></td>
                                    <td><?php echo $row['tipo_afiliacion'];?></td>
                                    <td><button data-modal-target="#modal_<?php echo $row['id_usuario'];?>">Detalles</button></td>
                                    <td><button class="delete" id=delete data-user-id="<?php echo $row['id_usuario'];?>" data-role='usuario'>Eliminar</button></td>
                                </tr>
                                    
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                        </div>

                    </div>

                    <!-- ---------------REGISTRO CITAS---------------- -->
                    <div id="reg_cita" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar citas</p>
                        </div>

                        <div class="cont_general_all">
                                
                            <div class="preguntas_formulario">
                                <div class="cont_preguntas_search"> 
                                    <label for="identificacion">Identificación:</label>
                                    <div class="search">
                                        <input type="text" name="identi_cita" id="identi_cita">
                                        <div class="search-img" id="search_paciente"></div>
                                    </div>
                                </div>
                                <div class="cont_preguntas">
                                    <label for="tipo_identificacion">Tipo de Identificación:</label>
                                    <input type="text" disabled name="type_id_cita">
                                </div>
                                <div class="cont_preguntas"> 
                                    <label for="nombre">Nombres:</label>
                                    <input type="text" disabled name="name_cita">
                                </div>
                            </div>

                            <div class="preguntas_formulario">
                                <div class="cont_preguntas"> 
                                    <label for="edad">Edad:</label>
                                    <input type="number" disabled name="edad_cita">
                                </div>
                                <div class="cont_preguntas">
                                    <label for="tipo_afiliacion">Tipo de Afiliación:</label>
                                    <input disabled name="tipo_afiliacion_cita">
                                </div>
                                <div class="cont_preguntas"> 
                                    <label for="trabajo">Trabajo:</label> <!-- NOT IN DATABASE -->
                                    <input disabled type="text" name="trabajo_cita">
                                </div>
                            </div>

                            <div class="preguntas_formulario">
                                <div class="cont_preguntas">
                                    <label for="enfermedad">Enfermedad:</label> <!-- NOT IN DATABASE -->
                                    <input type="text" name="enfermedad">
                                </div>
                                <div class="cont_preguntas"> 
                                    <label for="nivel_gravedad">Nivel de Gravedad:</label> <!-- NOT IN DATABASE -->
                                    <input type="text" name="nivel_gravedad">
                                </div>
                                <div class="cont_preguntas"></div>
                            </div>

                            <div class="preguntas_formulario"> 
                                <div class="cont_preguntas">
                                    <label for="tipo_cita">Tipo de Cita:</label>
                                    <select name="tipo_cita" disabled>
                                        <?php 
                                            $q_cita = "SELECT * FROM tipo_cita";
                                            $selcita = mysqli_query( $conn, $q_cita );
                                            if(mysqli_num_rows($selcita)>0){
                                                while($selectcita = mysqli_fetch_assoc($selcita)){
                                        ?>        
                                            <option value="<?php echo $selectcita['id']; ?>">
                                            <?php echo htmlspecialchars($selectcita['enombre'])?>
                                            </option>

                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="cont_preguntas">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" id="date" name="fecha_cita" min="<?php echo date('Y-m-d'); ?>" onchange="validateDate()" disabled>
                                </div>
                                <div class="cont_preguntas">
                                    <label for="hora_inicio">Hora de Inicio:</label>
                                    <select name="hora_inicio" id="hora_rango1" disabled>
                                        <?php 
                                            $q_horas = "SELECT * FROM horarios";
                                            $sel = mysqli_query( $conn, $q_horas );
                                            if(mysqli_num_rows($sel)>0){
                                                while($select = mysqli_fetch_assoc($sel)){
                                        ?>        
                                            <option value="<?php echo $select['id_horario']; ?>">
                                            <?php echo htmlspecialchars($select['hora_inicio'])?>
                                            </option>

                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="cont_preguntas">
                                    <label for="hora_final">Hora Final:</label>
                                    <select name="hora_final" id="rango" disabled>
                                    <?php 
                                        $q_horas = "SELECT * FROM horarios";
                                        $sel = mysqli_query( $conn, $q_horas );
                                        if(mysqli_num_rows($sel)>0){
                                            while($select = mysqli_fetch_assoc($sel)){
                                    ?>        
                                        <option value="<?php echo $select['id_horario']; ?>">
                                        <?php echo htmlspecialchars($select['hora_inicio'])?>
                                        </option>

                                    <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                    
                            </div>
                            <div class="save">
                                <div class="save-button" id="cita-nueva">
                                    <a href="#">Agregar Cita</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- --------------PANEL CITAS SOLICITADAS (PREAGENDAMIENTO)----------------- -->
                    <div id="panel_cita" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel citas solicitadas</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tabla_preagendamiento"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Id PreAgendamiento</th>
                                        <th>Nombre Paciente</th>
                                        <th>Fecha</th>
                                        <th>Registro</th>
                                        <th>Tipo Cita</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql99 = "SELECT * FROM preagendamiento
                                                INNER JOIN usuario ON preagendamiento.id_usuario = usuario.id_usuario
                                                INNER JOIN tipo_cita ON preagendamiento.id_tipo_cita = tipo_cita.id
                                                ORDER BY preagendamiento.id_preagendamiento ASC";   //cita
                                        $cita_query = mysqli_query($conn, $sql99);
                                        if(mysqli_num_rows($cita_query)>0){
                                            while($modalci = mysqli_fetch_assoc($cita_query)){
                                        ?>
                                        <tr id=precitatable_row_<?php echo $modalci['id_usuario']?>>
                                            <td> <?php echo $modalci['id_preagendamiento'];?></td>
                                            <td> <?php echo $modalci['nombre'];?></td>
                                            <td> <?php echo $modalci['fecha'];?></td>
                                            <td> <?php echo $modalci['registro'];?></td>
                                            <td> <?php echo htmlspecialchars($modalci['enombre']);?></td>
                                            <td><button data-modal-target="#modalci_<?php echo $modalci['id_preagendamiento'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $modalci['id_preagendamiento'];?>" data-role='preagendamiento'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- --------------PANEL CITAS AGENDADAS----------------- -->
                    <div id="panel_cita_agendada" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel citas agendadas</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tabla_citas"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID CITA</th>
                                        <th>Ident. Paciente</th>
                                        <th>Nombre Paciente</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Doctor</th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql7 = "SELECT c.id_citas, p.id_usuario, u.nombre as usuario_nombre, c.FechaAsignada, c.HoraAsignado, d.id_doctor ,du.nombre as doctor_nombre
                                        FROM citas_agendadas c
                                        INNER JOIN preagendamiento p ON c.id_preagendamiento = p.id_preagendamiento
                                        INNER JOIN doctores d ON c.id_DoctorAsignado = d.id_doctor
                                        INNER JOIN usuario u ON p.id_usuario = u.id_usuario
                                        INNER JOIN usuario du ON d.id_usuario = du.id_usuario";   //cita
                                        $citasoli_query = mysqli_query($conn, $sql7);
                                        if(mysqli_num_rows($citasoli_query)>0){
                                            while($citasoli = mysqli_fetch_assoc($citasoli_query)){
                                        ?>
                                        <tr id=citatable_row_<?php echo $citasoli['id_citas']?>>
                                            <td> <?php echo $citasoli['id_citas'];?></td>
                                            <td> <?php echo $citasoli['id_usuario'];?></td>
                                            <td> <?php echo $citasoli['usuario_nombre'];?></td>
                                            <td> <?php echo $citasoli['FechaAsignada'];?></td>
                                            <td> <?php echo $citasoli['HoraAsignado'];?></td>
                                            <td> <?php echo $citasoli['doctor_nombre'];?></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $citasoli['id_citas'];?>" data-role='cita'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ---------------REGISTRO PATOLOGIA---------------- -->
                    <div id="reg_pato" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar patologias</p>
                        </div>

                        <div class="cont_general_all">
                        
                            <div class="survey-container">
                                <div class="question">
                                    <label for="name">Nombre Patologia</label>
                                    <input type="text" name="pato_name" required>
                                </div>
                                <div class="question">
                                    <label for="age">Puntuacion</label>
                                    <input type="text" name="pato_score" required>
                                </div>
                                <div class="save">
                                    <div class="save-button" id="guardar-pato">
                                    <a href="#" id="guardar-pato">Guardar</a>
                                    </div>
                                </div>
                            </div>


                        </div>    
                    </div>

                    <!-- --------------PANEL PATOLOGIAS----------------- -->
                    <div id="panel_pato" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel patologias</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tablas_pato"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID Patologia</th>
                                        <th>Nombre Patologia</th>
                                        <th>Puntuacion</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql4 = "SELECT * FROM patologias";   //patologias
                                        $pato_query = mysqli_query($conn, $sql4);
                                        if(mysqli_num_rows($pato_query)>0){
                                            while($pato =mysqli_fetch_assoc($pato_query)){
                                        ?>
                                        <tr id=patotable_row_<?php echo $pato['id_patologia']?>>
                                            <td> <?php echo $pato['id_patologia'];?></td>
                                            <td> <?php echo $pato['nombre_patologia'];?></td>
                                            <td> <?php echo $pato['puntuacion'];?></td>
                                            <td><button data-modal-target="#modalpato_<?php echo $pato['id_patologia'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $pato['id_patologia'];?>" data-role="patologia">Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ---------------REGISTRO TIPO CITAS---------------- -->
                    <div id="reg_tcita" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar tipo de citas</p>
                        </div>

                        <div class="cont_general_all">
                        
                            <div class="survey-container">
                                <div class="question">
                                    <label for="name">Nombre Tipo de Cita</label>
                                    <input type="text" name="name_citatype" required>
                                </div>
                                <div class="save">
                                    <div class="save-button" id="guardar-citatype">
                                    <a href="#" id="guardar-citatype">Guardar</a>
                                    </div>
                                </div>
                            </div>
                        
                        </div>    
                    </div>

                    <!-- --------------PANEL TIPO CITAS----------------- -->
                    <div id="panel_tcita" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel tipo de citas</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tablas_tipocita"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID Tipo Cita</th>
                                        <th>Tipo de Cita</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql5 = "SELECT * FROM tipo_cita";   //tipo citas
                                        $tcita_query = mysqli_query($conn, $sql5);
                                        if(mysqli_num_rows($tcita_query)>0){
                                            while($citaa =mysqli_fetch_assoc($tcita_query)){
                                        ?>
                                        <tr id='tipoctable_row_<?php echo $citaa['id']?>'>
                                            <td> <?php echo $citaa['id'];?></td>
                                            <td> <?php echo $citaa['enombre'];?></td>
                                            <td><button data-modal-target="#modaltipocita_<?php echo $citaa['id'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $citaa['id'];?>" data-role="tipocita" >Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ---------------REGISTRO ESPECIALIDADES---------------- -->
                    <div id="reg_especi" class="contain_main">
                        <div class="cont_titulo">
                            <p>Registrar especialidades</p>
                        </div>

                        <div class="cont_general_all">
                        
                            <div class="survey-container">
                                    <div class="question">
                                        <label for="name">Nombre Especialidad</label>
                                        <input type="text" name="espe_name" required>
                                    </div>
                                    <div class="save">
                                        <div class="save-button" id="guardar-espe">
                                        <a href="#" id="guardar-espe">Guardar</a>
                                        </div>
                                    </div>
                            </div>

                        </div>    
                    </div>

                    <!-- --------------PANEL ESPECIALIDADES----------------- -->
                    <div id="panel_especi" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel especialidades</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tablas_especialidad"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID Especialidad</th>
                                        <th>Nombre Especialidad</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql6 = "SELECT * FROM especialidades";   //especialidades
                                        $consulta = mysqli_query($conn, $sql6);
                                        if(mysqli_num_rows($consulta)>0){
                                            while($especi =mysqli_fetch_assoc($consulta)){
                                        ?>
                                        <tr id=specialtable_row_<?php echo $especi['id_especialidad']?>>
                                            <td> <?php echo $especi['id_especialidad'];?></td>
                                            <td> <?php echo $especi['especialidad'];?></td>
                                            <td><button data-modal-target="#modalspecial_<?php echo $especi['id_especialidad'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $especi['id_especialidad'];?>" data-role="especialidad">Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- --------------PANEL ROLES----------------- -->
                    <div id="panel_roles" class="contain_main">
                        <div class="cont_titulo">
                            <p>Panel citas</p>
                        </div>
                        <div class="cont_general_all">

                            <div class="panel-main" id="contain_tablas_role"> 
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID Rol</th>
                                        <th>Nombre Rol</th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        
                                        require_once 'conexion.php';

                                        $sql7 = "SELECT * FROM roles";   //patologias
                                        $consulta = mysqli_query($conn, $sql7);
                                        if(mysqli_num_rows($consulta)>0){
                                            while($roles =mysqli_fetch_assoc($consulta)){
                                        ?>
                                        <tr id=roletable_row_<?php echo $roles['id_rol']?>>
                                            <td> <?php echo $roles['id_rol'];?></td>
                                            <td> <?php echo $roles['nombre_rol'];?></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $roles['id_rol'];?>" data-role="rol">Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

            </main>
        </div>
    </section>

</body>
<script src="../Js/Admin/sql8.js"></script>
<script src="../Js/User/ajax.js"></script>
</html>