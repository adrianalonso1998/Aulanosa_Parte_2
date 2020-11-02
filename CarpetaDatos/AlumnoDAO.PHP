<?php
include_once "../carpetaModelo/Alumno.php";
include_once "../CarpetaDatos/UsuarioDAO.php";
//$usuDAO = new UsuarioDAO();
// $fecha = new DateTime('2001-08-17');
// $alumno1 = new Alumno(14, "Vanessa", "Señé", $fecha);
// $usu = $usuDAO->obtenerUsuario("admin", "1234");
// $alumDAO = new AlumnoDAO();
// $alu = $alumDAO->obtenerAlumno($usu);
// //$alumDAO->guardarAlumno($alumno1);
// $alumDAO->eliminarAlumno($alumno1);
// var_dump($alu);
// $alumDAO->guardarAlumno($usu);
// $alumDAO->eliminarAlumno($usu);
class AlumnoDAO
{
    function crearConexion()
    {
        $servidorBD = 'localhost';
        $usuarioBD = 'root';
        $passwordBD = '';
        $bd = 'Aulanosa';
        $con = new mysqli($servidorBD, $usuarioBD, $passwordBD, $bd);
        if ($con->connect_error) {
            echo ("Problemas conectando la BD");
        }
        return $con;
    }

    function obtenerAlumno($Usuario)
    {
        $id = $Usuario->getId();
        $con1 = $this->crearConexion();
        $sql = "SELECT * FROM alumno INNER JOIN usuario ON alumno.id=usuario.alumno_id WHERE usuario.id=?;";
        $consultaPreparada = $con1->prepare($sql);
        $consultaPreparada->bind_param("i", $id);
        $consultaPreparada->execute();
        $resultado = $consultaPreparada->get_result();
        $filas = $resultado->fetch_array();
        $con1->close();
        $alumno = new Alumno($filas[0], $filas[1], $filas[2], $filas[3]);
        return $alumno;
    }
    function guardarAlumno($Alumno)
    {
        $id = $Alumno->getId();
        if ($id === 0) {
            $nombre = $Alumno->getNombre();
            $apellidos = $Alumno->getApellidos(); //:D
            $fecha_nacimiento = $Alumno->getFecha_nacimiento();
            $fTexto=$fecha_nacimiento->format('Y-m-d');//pasamos el tipo date a string con el formato
            $con = $this->crearConexion();
            $sql1 = "INSERT INTO alumno (nombre, apellidos, fecha_nacimiento) Values (?,?,?)";
            $consultaPreparada = $con->prepare($sql1);
            $consultaPreparada->bind_param("sss", $nombre, $apellidos, $fTexto );
            $consultaPreparada->execute();
            $id = $con->insert_id;
            $Alumno->setId($id);
            var_dump($id);
            $con->close();
        } else {
            $id = $Alumno->getId();
            $nombre = $Alumno->getNombre();
            $apellidos = $Alumno->getApellidos();
            $fecha_nacimiento = $Alumno->getFecha_nacimiento(); //:D
            $fTexto=$fecha_nacimiento->format('Y-m-d');//pasamos el tipo date a string con el formato
            $con = $this->crearConexion();
            $sql1 = "UPDATE alumno set nombre=?, apellidos=?, fecha_nacimiento=? WHERE id=?";
            $consultaPreparada = $con->prepare($sql1);
            $consultaPreparada->bind_param("sssi", $nombre, $apellidos, $fTexto, $id);
            $consultaPreparada->execute();
            $con->close();
        }
    }
    function eliminarAlumno($Alumno)
    {
        $id = $Alumno->getId();
        $con = $this->crearConexion();
        $sql1 = "DELETE FROM alumno WHERE id=?";
        $consultaPreparada = $con->prepare($sql1);
        $consultaPreparada->bind_param("i", $id);
        $consultaPreparada->execute();
        $con->close();
    }
}
