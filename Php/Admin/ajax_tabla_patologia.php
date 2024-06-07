<body>
<!-- -------------------------------MODAL PATOLOGIA------------------------------------------ -->

<?php
    require_once '../conexion.php';

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
</body>
    
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
                                        
                                        require_once '../conexion.php';

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
                                            <td><button class="delete" data-user-id="<?php echo $pato['id_patologia'];?>" data-role="patologia">Eliminar</button></td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>