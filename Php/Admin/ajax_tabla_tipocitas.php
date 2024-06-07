<body>
<!-- -------------------------------MODAL TIPO CITA------------------------------------------ -->

<?php
    require_once '../conexion.php';

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
</body>
    
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
                                        
                                        require_once '../conexion.php';

                                        $sql5 = "SELECT * FROM tipo_cita";   //tipo citas
                                        $tcita_query = mysqli_query($conn, $sql5);
                                        if(mysqli_num_rows($tcita_query)>0){
                                            while($tcita =mysqli_fetch_assoc($tcita_query)){
                                        ?>
                                        <tr id=tipoctable_row_<?php echo $tcita['id']?>>
                                            <td> <?php echo $tcita['id'];?></td>
                                            <td> <?php echo $tcita['enombre'];?></td>
                                            <td><button data-modal-target="#modaltipocita_<?php echo $tcita['id'];?>">Detalles</button></td>
                                            <td><button class="delete" data-user-id="<?php echo $tcita['id'];?>" data-role="tipocita" >Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>