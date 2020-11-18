<?php
include_once "Autenticacion.php";
include_once "ServicioAlumnos.php";
include_once "Usuario.php";
include_once "Alumno.php";
$correo = $_POST['correo'];
$password = $_POST['password'];
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$fecha=$_POST['fecha'];

 $alumnoReg=new Alumno(0,$nombre,$apellidos,new DateTime($fecha));
 $usuarioReg= new Usuario(0,$correo,$password,0);


$aunt= new Autenticacion();
$res = $aunt->comprobarLoginExiste($correo);
if ($res != false) {
    header("Location: ../CarpetaVista/FormularioAltaAlumno.php?usuarioUso=true");
}
else{
$servicioAlu= new ServicioAlumnos();
$servicioAlu->guardarAlumno($alumnoReg,$usuarioReg);

// echo '<script>alert("Gracias por registrarte")</script>';
// echo '<script>location.href="../CarpetaVista/ListadoAlumnos.php"</script>';

header("Location: ../CarpetaVista/datosAlumno.php?registro=true");
}