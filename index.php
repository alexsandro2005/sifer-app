<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN INICIO DE SESION || SIFER - APP</title>
    <link rel="stylesheet" href="controller/CSS/login_style.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="shortcut icon" href="controller/image/favicon.png" type="image/x-icon">
</head>
<body onload="form1.usuario.focus()">

    <video autoplay loop muted poster="controller/image/Skyscrapers-buildings-illumination-night-city-river_3840x2160.jpg" > <source src="controller/image/universo-13100.mp4" type="video/mp4"></video> 

    <div class="container_all">
        <div class="ctn-form">
            <img src="controller/image/favicon.png" alt="" class="logo">
            <h1 class="title"> <span>INICIAR SESION</span></h1>

            <form action="controller/inicio.php" method="POST" autocomplete="off">
                <label for="user">Nombre de Usuario</label>
                <input type="text"  required name="username" placeholder="Ingrese su nombre de usuario">
                <label for="documento">Numero de documento</label>
                <input type="number" required name="document" placeholder="Ingrese su nombre de documento">
                <label for="password">Contraseña</label>
                <input type="password" required name="password" placeholder="Ingrese su contraseña">
                <input type="submit" value="Iniciar">
                
            </form>
            <span class="text-footer">¿Aun no se encuentra registrado? <a href="register_user.php">Registrarse</a></span>
            <span class="text-footer">¿Olvido su contraseña? <a href="register_user.php">Olvido contraseña</a></span>

        </div>

        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description">Bienvenido <span class="multiple-text"></span><span class="usuario"></h1>
            <p class="textdescription">Lo que más quieres en el mundo tiene nombre, placa y cilindraje, son parte de nuestro día a día, ningún cuidado es suficiente para demostrarle cuánto las amamos, por eso somos tu mejor eleccion.</p>
        </div>
    </div>

    <!-- TYPED JS -->


    <script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script>

    <script src="js/typed.js"></script>
</body>
</html>

</body>
</html>