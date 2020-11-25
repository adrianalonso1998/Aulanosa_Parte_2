<?php
include_once "Autenticacion.php";
include_once "ServicioAlumnos.php";
include_once "Usuario.php";
include_once "Alumno.php";
$correo = $_POST['correo'];
$password = $_POST['password'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fecha = $_POST['fecha'];
$id = 0;
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $alumnoReg = new Alumno($id, $nombre, $apellidos, new DateTime($fecha));
    $servicioAlu = new ServicioAlumnos();
    $opCorrecta = $servicioAlu->guardarAlumnoPorId($alumnoReg);
    header("Location: ../CarpetaVista/datosAlumnoListado.php?update=true&id=$id");
} else {
    $alumnoReg = new Alumno($id, $nombre, $apellidos, new DateTime($fecha));
    $usuarioReg = new Usuario(0, $correo, $password, 0);



    $aunt = new Autenticacion();
    $res = $aunt->comprobarLoginExiste($correo);
    if ($res != false) {
        header("Location: ../CarpetaVista/FormularioAltaAlumno.php?usuarioUso=true");
    } else {
        $servicioAlu = new ServicioAlumnos();
        $opCorrecta = $servicioAlu->guardarAlumno($alumnoReg, $usuarioReg);
        var_dump($opCorrecta);
        if ($opCorrecta == true) {
            session_start();
            //si ya exixte la sesion "sesion" y creo un usuario que salga la alerta de usuario creado
            if (isset($_SESSION['sesion'])) {
                header("Location: ../CarpetaVista/FormularioAltaAlumno.php?registroSecundario=true");
            } elseif (!isset($_SESSION['datosUsuario'])) {
                $_SESSION['datosUsuario'] = $usuarioReg;
                $_SESSION['datosAlumno'] = $alumnoReg;
                header("Location: ../CarpetaVista/datosAlumno.php?registro=true");
            } else {
                header("Location: ../CarpetaVista/FormularioAltaAlumno.php?registroSecundario=true");
            }
        }
        // echo '<script>alert("Gracias por registrarte")</script>';
        // echo '<script>location.href="../CarpetaVista/ListadoAlumnos.php"</script>';



    }
}
