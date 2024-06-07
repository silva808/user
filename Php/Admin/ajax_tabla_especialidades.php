<body>
<!-- -------------------------------MODAL ESPECIALIDAD------------------------------------------ -->

<?php
    require_once '../conexion.php';

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
</body>
    
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
                                        
                                        require_once '../conexion.php';

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