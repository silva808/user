<body>
<!-- -------------------------------MODAL CITAS------------------------------------------ -->

<?php
    require_once '../conexion.php';

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
</body>
                        
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
                                        
                                        require_once '../conexion.php';

                                        $sql99 = "SELECT * FROM preagendamiento
                                                INNER JOIN usuario ON preagendamiento.id_usuario = usuario.id_usuario
                                                INNER JOIN tipo_cita ON preagendamiento.id_tipo_cita = tipo_cita.id";   //cita
                                        $cita_query = mysqli_query($conn, $sql99);
                                        if(mysqli_num_rows($cita_query)>0){
                                            while($modalci = mysqli_fetch_assoc($cita_query)){
                                        ?>
                                        <tr id=precitatable_row_<?php echo $modalci['id_usuario']?>>
                                            <td> <?php echo $modalci['id_preagendamiento'];?></td>
                                            <td> <?php echo $modalci['nombre'];?></td>
                                            <td> <?php echo $modalci['fecha'];?></td>
                                            <td> <?php echo $modalci['registro'];?></td>
                                            <td> <?php echo $modalci['enombre'];?></td>
                                            <td><button data-modal-target="#modalci_<?php echo $modalci['id_preagendamiento'];?>">Detalles</button></td>
                                            <td><button class="delete" id=delete data-user-id="<?php echo $modalci['id_preagendamiento'];?>" data-role='preagendamiento'>Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>