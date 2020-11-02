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
        /*añadir los datos del alumno*/$aluDAO1=new AlumnoDAO();
        session_start();
        if (isset($_SESSION['sesion'])) {
        $usuario1=$_SESSION['sesion'];
       /*añadir los datos del alumno*/ $alumno1=$aluDAO1->obtenerAlumno($usuario1);
       echo "login:"; echo $usuario1->getLogin();echo "<br>";
       echo "Contraseña:"; echo $usuario1->getPassword();echo "<br>";
       echo "nombre:";  echo $alumno1->getNombre();echo "<br>";
       echo "apellidos:";  echo $alumno1->getApellidos();echo "<br>";
    }
        ?>
        <form action="deslogar.php" method="POST">
        <input type="submit" value="Cerrar Sesión">
        </form>
  
</div>
</body>

</html>