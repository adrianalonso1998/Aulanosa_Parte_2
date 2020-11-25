<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .contenedor {
            text-align: center;
            margin-top: 5%;
        }
    </style>
</head>

<body>
<ul class="nav nav-tabs nav-justified">
   <?php
   session_start();
        if (!isset($_SESSION['sesion']) && !isset($_SESSION['datosUsuario'])) {
            echo '<li class="pl-5"><a href="login.php">login </a></li>';
        }
        ?>
  <li class="pl-5"><a href="FormularioAltaAlumno.php">Formulario De Alta  </a></li>
  <?php
   if (isset($_SESSION['sesion'])||isset($_SESSION['datosUsuario'])) {
    echo '<li class="pl-5"><a href="datosAlumno.php">Datos Alumno  </a></li>';
    echo '<li class="pl-5"><a href="ListadoAlumnos.php">Listado De Alumnos  </a></li>';
}
  ?>
</ul>
    <?php
    //comprobar si el usuario y la contraseña ya existen
    if (isset($_GET['usuarioUso'])) {
        $usuarioUso = $_GET['usuarioUso'];
        if ($usuarioUso == true) {
            echo '<script>window.setTimeout(function(){ alert("Usuario o contraseña ya estan en uso");},500);</script>';
        }
    }
    if(isset($_GET['registroSecundario'])){
        echo '<script>window.setTimeout(function(){ alert("Usuario Creado");},500);</script>';
    }
    
    // if (isset($_SESSION['sesion'])) {
    //     header("Location: datosAlumno.php");
    // } else {
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
    //}
     ?>
      <?php
        if (isset($_SESSION['sesion']) && !isset($_SESSION['datosUsuario'])) {
            echo '<form action="deslogar.php" method="POST">
            <input type="submit" value="Cerrar Sesión">
        </form>';
        }
        ?>
</body>

</html>