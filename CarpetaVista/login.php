<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>



<body>
    <?php session_start(); ?>
    <ul class="nav nav-tabs nav-justified">
        <?php
        if (!isset($_SESSION['sesion']) && !isset($_SESSION['datosUsuario'])) {
            echo '<li class="pl-5"><a href="login.php">login </a></li>';
        }
        ?>
        <li class="pl-5"><a href="FormularioAltaAlumno.php">Formulario De Alta </a></li>
        <?php
        if (isset($_SESSION['sesion']) || isset($_SESSION['datosUsuario'])) {
            echo '<li class="pl-5"><a href="datosAlumno.php">Datos Alumno  </a></li>';
            echo '<li class="pl-5"><a href="ListadoAlumnos.php">Listado De Alumnos  </a></li>';
        }
        ?>
    </ul>

    <?php

    if (isset($_SESSION['sesion']) || isset($_SESSION['datosAlumno'])) {
        header("Location: datosAlumno.php");
    }
    $cont1 = 1;
    if (!isset($_COOKIE["contador"])) {
        setcookie("contador", $cont1, time() + 10);
    } else {
        $cont1 = $_COOKIE["contador"];
    }
    if ($cont1 == 4) {
        echo "demasiados intentos....espere";
    } else {
        echo $cont1 . "<br>";
        echo '<h1>Datos de login</h1>
        <a href="FormularioAltaAlumno.php">Entra para registrase</a>
        </br>
        </br>
    <form action="autenticar.php" method="POST" enctype="multipart/form-data">
        <label for="text">Correo Electrónico</label>
        <input type="text" name="correo" id="correo" placeholder="Pon aquí el correo Electrónico" required><br>
        <label for="text">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Pon aquí la Contraseña" required><br>
        <input type="submit"><br>
    </form>';
    }
    //la alerta salga con un delay para no ver la págin en blanco mientras esta el alert
    if (isset($_GET['loginCorrecto'])) {
        echo '<script>window.setTimeout(function(){ alert("Usuario o contraseña erroreos");},500);</script>';
    } ?>
</body>

</html>