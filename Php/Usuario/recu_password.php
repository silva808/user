<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
    <link rel="stylesheet" href="../../Css/style_recucontra1.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <form action="./recu_contraseña.php" method="post" >
            <div class="texto"><h2>Recuperar contraseña</h2> <a href="../../index.php"><i class="fa-solid fa-xmark" style="color: #050505;"></i></a></div>
       
            <input type="number" name="identificacion" id="identificacion" placeholder="Identificacion" required>

            <input type="email" name="correo" id="correo" placeholder="Correo Electronico" >

            <!-- <input type="password" name="pass" id="pass" placeholder="Contraseña" > -->
            <button type="submit">Enviar</button>
           
        </form>
    </div>
</body>
</html>
