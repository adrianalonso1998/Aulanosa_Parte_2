<?php
include_once "../CarpetaModelo/Autenticacion.php";
$correo = $_POST['correo'];
$password = $_POST['password'];
$aunt = new Autenticacion();
$aunt->comprobarUsuario($correo, $password);
$res = $aunt->comprobarUsuario($correo, $password);
if ($res != false) {
    setcookie("contador",0,time()+60);
    // $login = $res->getLogin();
    // $contraseña = $res->getPassword();
    // $nombre1 = $res->getNombre();
    // $apellidos1 = $res->getApellidos();
    // header("Location: datosUsuario.php?login=$login&contraseña=$contraseña&nombre1=$nombre1&apellidos1=$apellidos1"); //login creado dentro del if
    session_start();
    $_SESSION['sesion'] = $res;
    header("Location: datosAlumno.php?");

} else {
    $cont = 1;
    if (!isset($_COOKIE["contador"])) {
        setcookie("contador", $cont,time() + 10);
    } else {
        $cont=$_COOKIE["contador"];
        $cont++;
        setcookie("contador", $cont, time()+10);
    }


     header('Location: login.php?loginCorrecto=false');
    }
