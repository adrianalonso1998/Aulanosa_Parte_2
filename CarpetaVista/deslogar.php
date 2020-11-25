<?php 
session_start();
unset($_SESSION['sesion']);
unset($_SESSION['datosUsuario']);
unset($_SESSION['datosAlumno']);
header("Location: login.php")?>
