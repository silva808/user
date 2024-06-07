<?php 
session_start(); 
require_once ('../conexion.php');



//Buscar Paciente------------------------------------------
if(isset($_POST["btn_medicosP"])){

    $patron=$_POST["btn_medicosP"];
    $sql = "SELECT * FROM usuario u 
        INNER JOIN roles r ON u.id_rol = r.id_rol 
        WHERE u.nombre LIKE '%$patron%' 
        OR u.edad LIKE '%$patron%' 
        OR u.telefono LIKE '%$patron%' 
        OR u.correo LIKE '%$patron%' 
        OR u.genero LIKE '%$patron%' 
        OR u.tipo_documento LIKE '%$patron%' 
        OR u.estado_civil LIKE '%$patron%' 
        OR u.direccion LIKE '%$patron%' 
        OR u.id_rol LIKE '%$patron%' 
        OR u.tipo_afiliacion LIKE '%$patron%'";

    $buscar=mysqli_query($conn,$sql);

    if ($buscar) {
        while($ff =mysqli_fetch_assoc($buscar)){
            $modalId = 'modal_' . $ff['id_usuario'];
            $identi = $ff['id_usuario'];
        
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
            <button class="save-button"  data-modal-id="<?php echo $modalId;?>">Aplicar cambios</button>
        </div>
    </div>
            </div>
<?php
            }
        
?>
    
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
        <?php
            
            $buscar1=mysqli_query($conn,$sql);

            while($fila =mysqli_fetch_assoc($buscar1)){
        
            ?>

        <tbody>
            <tr id=table_row_<?php echo $fila['id_usuario']?>>
                <td> <?php echo $fila['id_usuario'];?></td>
                <td> <?php echo $fila['nombre'];?></td>
                <td> <?php echo $fila['edad'];?></td>
                <td> <?php echo $fila['telefono'];?></td>
                <td><button data-modal-target="#modal_<?php echo $fila['id_usuario'];?>">Detalles</button></td>
                <td><button class="delete" data-user-id="<?php echo $fila['id_usuario'];?>" data-role='medico'>Eliminar</button></td>
            </tr>

            <?php
                
            }
        }else {
            echo "Error: ".mysqli_error($con);
        }
            ?>
        </tbody>
    </table>

    <?php
                
            }
?>