<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        h1 {
            text-align: center;
        }

        .login {
            margin: 4%;
        }
    </style>
</head>
<div class="login">

    <body>
        <ul class="nav nav-tabs nav-justified">
            <?php
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
        <h1>Bienvenido de Nuevo</h1>
        <!-- Login:<?php// echo $_GET['login']; ?>
        <br>
        Contraseña:<?php //echo $_GET['contraseña']; 
                    ?>
        <br>
        nombre:<?php //echo $_GET['nombre1']; 
                ?>
        <br>
        apellidos:<?php //echo $_GET['apellidos1']; 
                    ?>
        <br> -->
        <?php

        //la alerta salga con un delay para no ver la págin en blanco mientras esta el alert
        if (isset($_GET['registro'])) {
            echo '<script>window.setTimeout(function(){ alert("Gracias por registrarte");},500);</script>';
        }
        /*añadir los datos del alumno*/
        $autenticacion = new Autenticacion();

        if (isset($_SESSION['sesion'])) {
            $usuario1 = $_SESSION['sesion'];
            /*añadir los datos del alumno*/
            $alumno1 = $autenticacion->obtenerAlumno($usuario1);
        }
        elseif (isset($_SESSION['datosUsuario'])) {
            $usuario1 = $_SESSION['datosUsuario'];
            /*añadir los datos del alumno*/
            $alumno1 = $_SESSION['datosAlumno'];
        }

        if ($alumno1 != false) {
            echo "login: ";
            echo $usuario1->getLogin();
            echo "<br>";
            echo "Contraseña: ";
            echo $usuario1->getPassword();
            echo "<br>";
            echo "nombre: ";
            echo $alumno1->getNombre();
            echo "<br>";
            echo "apellidos: ";
            echo $alumno1->getApellidos();
            echo "<br>";
        } else {
            echo "No se pudieron recuperar los datos del alumno";
        }

        ?>
        <form action="deslogar.php" method="POST">
            <input type="submit" value="Cerrar Sesión">
        </form>
        
        <!-- <form action="ListadoAlumnos.php" method="POST">
            <input type="submit" value="Listado Alumnos">
        </form> -->

</div>
</body>

</html>