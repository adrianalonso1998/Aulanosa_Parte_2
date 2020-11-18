<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
        }
        .login{
            margin: 4%;
        }
    </style>
</head>
<div class="login">

    <body>
        <h1>Bienvenido de Nuevo</h1>
        <!-- Login:<?php// echo $_GET['login']; ?>
        <br>
        Contraseña:<?php //echo $_GET['contraseña']; ?>
        <br>
        nombre:<?php //echo $_GET['nombre1']; ?>
        <br>
        apellidos:<?php //echo $_GET['apellidos1']; ?>
        <br> -->
        <?php
        include_once "../CarpetaModelo/Usuario.php";
        include_once "../CarpetaModelo/Alumno.php";
        /*añadir los datos del alumno*/include_once "../CarpetaDatos/AlumnoDAO.php";
        include_once "../CarpetaModelo/Autenticacion.php";
        if(isset ($_GET['registro'])){
            echo '<script>alert("Gracias por registrarte")</script>';
        }
        /*añadir los datos del alumno*/$autenticacion=new Autenticacion();
        session_start();
        if (isset($_SESSION['sesion'])) {
        $usuario1=$_SESSION['sesion'];
       /*añadir los datos del alumno*/ $alumno1=$autenticacion->obtenerAlumno($usuario1);
       if ($alumno1 != false) {
        echo "login:"; echo $usuario1->getLogin();echo "<br>";
        echo "Contraseña:"; echo $usuario1->getPassword();echo "<br>";
        echo "nombre:";  echo $alumno1->getNombre();echo "<br>";
        echo "apellidos:";  echo $alumno1->getApellidos();echo "<br>";
    } else {
        echo "No se pudieron recuperar los datos del alumno";
    }
       
    }
        ?>
        <form action="deslogar.php" method="POST">
        <input type="submit" value="Cerrar Sesión">
        </form>
        <form action="ListadoAlumnos.php" method="POST">
        <input type="submit" value="Listado Alumnos">
        </form>
  
</div>
</body>

</html>