<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['sesion'])) {
        header("Location: datosAlumno.php");
    }
    $cont1=1;
    if (!isset($_COOKIE["contador"])) {
        setcookie("contador", $cont1,time() + 10);
    }
    else {
        $cont1=$_COOKIE["contador"];
    }
    if($cont1==4){
        echo "demasiados intentos....espere";
    }
    
    else{
        echo $cont1."<br>";
        echo'
    <form action="autenticar.php" method="POST" enctype="multipart/form-data">
        <label for="text">Correo Electrónico</label>
        <input type="text" name="correo" id="correo" placeholder="Pon aquí el correo Electrónico" required><br>
        <label for="text">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Pon aquí la Contraseña" required><br>
        <input type="submit"><br>
    </form>';
    }?>
</body>

</html>