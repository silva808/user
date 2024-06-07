<?php
session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/style_index2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> <!--Libreria de awesone-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--Libreria de sweetalert-->
    <title>MedPriority</title>
</head>

<body>
    <header>
        <nav class="barra"> <!--barra de navegación-->
            <div class="cont-logo_name">
                <div class="logo">
                    <i></i>
                    <p class="nombre">MEDPRIORITY</p>
                </div>
            </div>
            <input type="checkbox" id="check">
            <label for="check" class="check-boton">
                <i class="fa-solid fa-bars" style="color: #010101;" id="menu"></i>
            </label>

            <div class="opciones">
               <label for="check" class="check-boton" id="close">
                    <i class="fa-solid fa-xmark" style="color: #0a0a0a;"></i>
                </label>
            <a href="#somos" class="opcion1">Quienes Somos</a>
            <a href="#section_1" class="opcion1">Servicios</a>
             
                <?php if(isset ($_SESSION['autenticado']) && $_SESSION['autenticado']==true):?>

                    <a href="./Php/user.php" class="opcion1">Agendar Cita</a>
                    <a href="#" class="sesion" id="user"><?php echo htmlspecialchars($_SESSION['nombre']) ?></a> <!--Boton de sesion-->
                    <a href="#" class="sesion" id="sesion1" style="display:none">Iniciar Sesión</a> <!--Boton de sesion-->

                    <?php else: ?>
                    <a href="#" class="opcion1" id="cita">Agendar Cita</a>
                    <a href="#" class="sesion" id="sesion1">Iniciar Sesión</a> <!--Boton de sesion-->
                   
               <?php endif; ?>
            
                
                
            </div>
        </nav>
        <div class="container_verde">
            <div class="cont_doctores">
                <div class="acomodar3"> <!--para acomodar los signos mas que estan en el fondo-->
                    <div class="plus3"></div> <!--Contenedor de la imagen -->
                </div>
                <div class="acomodar2"> <!--para acomodar los signos mas que estan en el fondo-->
                    <div class="plus2"></div> <!--Contenedor de la imagen -->
                </div>

                <div class="img"></div> <!--Contenedor de la imagen de doctores-->

                <div class="acomodar">    <!--para acomodar los signos mas que estan en el fondo-->
                    <div class="plus2"></div> <!--Contenedor de la imagen -->
                    <div class="plus"></div> 
                </div>
            </div>
            <div class="cont_letras">
                <h1> ¡ Tú Salud es Primero !</h1>
                <div class="acomo">
                    <p>Primer servicio de atención medica que se preocupa por tus comodidades.</p>
                </div>
                <div class="cont_boton">
                    <div class="organizar">
                        <div class="boton">+ Calidad</div>
                        <div class="boton">+ Eficiencia</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="box">
        <h1>Sobre nuestros profesionales</h1>
        <p>Seleccionamos a los profesionales en nuestra plataforma en función de su experiencia y calidad de atención.
            Garantizamos que los doctores y odontólogos sean altamente calificados y brinden atención excepcional a
            nuestros usuarios.
        </p>
    </div>
    <!----------------------- SECCION MEDICOS----------------->
    <section class="section1" id="section_1">
        <div class="Slide1">
            <div class="contain_slider">
                <h1>Medicina General</h1>
                <div class="cont_arreglar">
                    <div class="container_letras" id="slider1">
                        <p class="parrafo_1">Los doctores de medicina general son expertos en diagnosticar, tratar y
                            prevenir una amplia variedad de condiciones médicas, desde resfriados hasta enfermedades
                            crónicas.</p>
                        <br>
                        <br>
                        <p class="parrafo_2">Su enfoque holístico garantiza atención integral para pacientes de todas
                            las edades, derivándolos a especialistas según sea necesario.</p>
                        <div class="flechas">
                            <div class="flecha_unido">
                                <button id="left"><i class="fa-solid fa-arrow-left-long"></i></button>

                                <button onclick="changeSlide(1)" id="derecha"><i
                                        class="fa-solid fa-arrow-right-long"></i></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="container_boxes">
                        <div class="caja1">
                            <div class="box1"><i></i>
                                <p>Medicina General</p>
                            </div>
                        </div>
                        <div class="caja2">
                            <div class="box2"><i></i>
                                <p>Odontologia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contain_slider">
                <h1>Odontologia</h1>
                <div class="cont_arreglar">
                    <div class="container_letras" id="slider2">

                        <p class="parrafo_1">Los odontólogos son especialistas en cuidado bucal, desde limpiezas de
                            rutina hasta procedimientos avanzados como implantes dentales. </p>
                        <br>
                        <p class="parrafo_2">Su enfoque preventivo y restaurador promueve una buena salud oral y
                            estética dental.
                        </p>
                        <div class="flechas">
                            <div class="flecha_unido">
                                <button onclick="changeSlide(-1)" id="left"><i
                                        class="fa-solid fa-arrow-left-long"></i></button>
                                <button id="derecha"><i class="fa-solid fa-arrow-right-long"></i></button>

                            </div>
                        </div>
                    </div>
                    <div class="container_boxes">
                        <div class="caja1_2">
                            <div class="box1_2"><i></i>
                                <p>Medicina General</p>
                            </div>
                        </div>
                        <div class="caja2_2">
                            <div class="box2_2"><i></i>
                                <p>Odontologia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!------------------------QUIENES SOMOS---------------------->

    <section class="section3" id="somos">
        <div class="subcontainer">
            <div class="mision">
                <div class="sub_mision">
                    <h1>Misión</h1>
                    <div class="cont_info">
                        <p> Nuestra misión es ofrecer un acceso rápido y conveniente a la atención médica y
                            odontológica, eliminando las largas esperas y simplificando el proceso de agendamiento de
                            citas.
                            <br>
                            <br>
                            Nos comprometemos a mejorar la experiencia del paciente, proporcionando un servicio que se
                            adapte a sus necesidades y mejore su bienestar general.
                        </p>
                    </div>
                </div>
                <div class="cont-img">
                    <div class="diana"></div>
                </div>
            </div>

            <div class="vision">
                <div class="cont-img2">
                    <div class="number_one"></div>
                </div>
                <div class="subvision">
                    <h1>Visión</h1>
                    <div class="cont_infovision">
                        <p>
                            Nos visualizamos como pioneros en la transformación de la atención médica a través de la
                            tecnología donde la comodidad y las necesidades del paciente sean nuestra máxima prioridad.
                            <br>
                            <br>
                            Aspiramos a ser reconocidos como líderes en la industria, creando un entorno donde la
                            atención médica sea accesible, eficiente y centrada en el paciente.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="final">
        <p>
            MedPriority, la primera plataforma de citas en línea que prioriza las necesidades y comodidades del
            paciente; nos enorgullece ofrecer una experiencia integral y accesible en atención médica.
        </p>
    </div>
    <!-----------Footer------------>
    <footer id="footer">
        <div class="foo1">
            <strong>Nos Ubicamos en:</strong>
            <p>Centro Tecnologico de la Amazonia</p>
            <div class="map"><iframe id="gmap_canvas"
                    src="https://maps.google.com/maps?q=sena+florencia-caqueta&t=&z=11&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>

        </div>
        <div class="foo2">
            <strong>Horario de atención</strong>
            <p>Agendamiento de citas de luenes a viernes de 7:00am a 5:00pm</p>
            <br>
            <strong>Redes Sociales :</strong>
            <div class="logosfo">
                <a href=""><i class="fa-brands fa-facebook" style="color: #6e6e6e;"></i></a>
                <a href=""><i class="fa-brands fa-instagram" style="color: #6e6e6e;"></i></a>
                <a href=""><i class="fa-brands fa-twitter" style="color: #6e6e6e;"></i></a>
            </div>

            <br>
            <p>© 2024 MedPriority EPS en Liquidación. Todos los derechos reservados.</p>
        </div>
    </footer>
    <!-- --------------Formulario de inicio sesion--------------- -->
    <div class="modal">
        <div class="container">
            <br>
            <form action="./Php/validar_ingresar1.php" class="form_sesion" method="post">
                <div class="se_text">
                    <h2>Iniciar Sesión</h2> <i id="o_p"><i class="fa-solid fa-xmark" style="color: #050505;"></i></i>
                </div>
                <input type="email" name="correo" placeholder="Correo" required>

                <input type="password" name="pass" id="pass" placeholder="Contraseña">
                <p>Si olvido su contraseña da click <a href="./Php/Usuario/recu_password.php">Recuperar</a></p>

                <button type="submit" class="boto">Enviar</button>
                <div class="raya">
                        
                </div>

            </form>
        </div>
    </div>
    <!--Cerrar sesion-->
    <form action="./Php/cerrarsesion.php" method="post" id="cerrarsesion">
                <button type="submit" class="boto">Cerrar Sesion</button>
                <button type="button" class="boto" id="cancell">Cancelar</button>
    </form>
    <!--Alerta por que el sweetalert no sirvio-->
    <div class="alerta_modal" id="alerta">
        <div class="cont-alert">
            <div class="icon"><i class="fa-solid fa-exclamation"></i></div>
            <div class="mensaje"><p>Debe Iniciar Sesión </p></div>
            <button type="submit" id="close1" onclick="cerrar2()" >Ok</button>
        </div>
    </div>
</body>

</html>
<script src="./Js/Slider.js"></script> <!--slide medico aun defectuoso cada que se recarga la pagina se alcanza a mirar el section de odontologia que se supone que esta escondido-->
<script src="./Js/alertas1.js"></script> <!--abrir debe iniciar sesion-->
<script src="./Js/abrir_iniciar_sesion1.js"></script> <!--abrir formulario-->
