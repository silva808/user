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
                                        
                                        require_once '../conexion.php';

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