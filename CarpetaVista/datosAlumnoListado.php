<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .login {
            margin: 4%;
        }

        .contenedor {
            text-align: center;
            margin-top: 5%;
        }
    </style>
</head>
<div class="login">

    <body>
        <ul class="nav nav-tabs nav-justified">
            <?php
            include_once "../CarpetaModelo/ServicioAlumnos.php";
            include_once "../CarpetaModelo/Usuario.php";
            include_once "../CarpetaModelo/Alumno.php";
            /*añadir los datos del alumno*/
            include_once "../CarpetaDatos/AlumnoDAO.php";
            include_once "../CarpetaModelo/Autenticacion.php";
            session_start();
            if (!isset($_SESSION['sesion']) && !isset($_SESSION['datosUsuario'])) {
                echo '<li class="pl-5"><a href="login.php">login </a></li>';
            }
            ?>
            <li class="pl-5"><a href="FormularioAltaAlumno.php">Formulario De Alta </a></li>
            <li class="pl-5"><a href="ListadoAlumnos.php">Listado De Alumnos </a></li>
            <li class="pl-5"><a href="datosAlumno.php">Datos Alumno </a></li>;
        </ul>
        <?php

        //la alerta salga con un delay para no ver la págin en blanco mientras esta el alert
        if (isset($_GET['registro'])) {
            echo '<script>window.setTimeout(function(){ alert("Gracias por registrarte");},500);</script>';
        }
        /*añadir los datos del alumno*/
        $autenticacion = new Autenticacion();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $servAlu = new ServicioAlumnos;
            $datosAlumnoListado = $servAlu->obtenerAlumnoPorId($id);
        } else {
            echo "Error 404";
        }
        if (isset($_GET['update'])) {
            echo '<script>window.setTimeout(function(){ alert("Update de los datos exitoso");},500);</script>';
        }

        if ($datosAlumnoListado != false) {
            $nom = $datosAlumnoListado->getNombre();
            $apell = $datosAlumnoListado->getApellidos();
            $fecha = $datosAlumnoListado->getFecha_nacimiento();
            $id2 = $datosAlumnoListado->getId();
            echo '<div class="contenedor">
        <h1>Formulario Update Alumno</h1>
        </br>
        <a href="login.php">Login</a>
    <form action="../CarpetaModelo/AltaAlumno.php" method="POST" enctype="multipart/form-data">
        <h2>Datos Alumno</h2>
        <label for="text">Nombre</label>
        <input type="text" value="' . $nom . '" name="nombre" id="nombre" placeholder="Pon aquí tu nombre" required><br>
        <label for="text">Apellidos</label>
        <input type="text" value="' . $apell . '" name="apellidos" id="apellidos" placeholder="Pon aquí tus Apellidos" required><br>
        <label for="text">Fecha nacimineto</label>
        <input type="date" value="' . $fecha . '" name="fecha" id="fecha" placeholder="Pon aquí Tu Fecha de nacimiento" required><br>
        <input type="hidden" value="' . $id2 . '" name="id" id="id"><br>
        <input type="submit"><br>
    </form>';
        } else {
            echo "No se pudieron recuperar los datos del alumno";
        }

        ?>
        <form action="deslogar.php" method="POST">
            <input type="submit" value="Cerrar Sesión">
        </form>

</div>
</body>

</html>