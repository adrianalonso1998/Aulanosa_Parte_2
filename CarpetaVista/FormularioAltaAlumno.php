<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Alumno</title>
    <style>
        .contenedor {
            text-align: center;
            margin-top: 5%;
        }
    </style>
</head>

<body>
    <?php
    //comprobar si el usuario y la contraseña ya existen
    if (isset($_GET['usuarioUso'])) {
        $usuarioUso = $_GET['usuarioUso'];
        if ($usuarioUso == true) {
            echo 'Usuario o contraseña ya estan en uso';
        }
    }
    session_start();
    if (isset($_SESSION['sesion'])) {
        header("Location: datosAlumno.php");
    } else {
        echo '<div class="contenedor">
        <h1>Formulario de Registro</h1>
        </br>
        <a href="login.php">Login</a>
    <form action="../CarpetaModelo/AltaAlumno.php" method="POST" enctype="multipart/form-data">
        <h2>Datos Usuario</h2>
        <label for="text">Correo Electrónico</label>
        <input type="text" name="correo" id="correo" placeholder="Pon aquí el correo Electrónico" required><br>
        <label for="text">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Pon aquí la Contraseña" required><br>
        </br>
        <h2>Datos Alumno</h2>
        <label for="text">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Pon aquí tu nombre" required><br>
        <label for="text">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" placeholder="Pon aquí tus Apellidos" required><br>
        <label for="text">Fecha nacimineto</label>
        <input type="date" name="fecha" id="fecha" placeholder="Pon aquí Tu Fecha de nacimiento" required><br>
        <input type="submit"><br>
    </form>';
    } ?>
</body>

</html>