<?php
//añadir debajo el metodo nuevo para registrar
include_once "../carpetaModelo/Alumno.php";
include_once "../CarpetaDatos/UsuarioDAO.php";
//$usuDAO = new UsuarioDAO();
// $fecha = new DateTime('2001-08-17');
// $alumno1 = new Alumno(14, "Gustavo", "Señé", $fecha);
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
        $consultaPreparada->execute();/**/
        $resultado = $consultaPreparada->get_result();
        $filas = $resultado->fetch_array();
        $con1->close();
        $alumno = new Alumno($filas[0], $filas[1], $filas[2], $filas[3]);
        return $alumno;
    }
    function obtenerAlumnoPorId($id)
    {
        $con1 = $this->crearConexion();
        $sql = "SELECT * FROM alumno WHERE id=?;";
        $consultaPreparada = $con1->prepare($sql);
        $consultaPreparada->bind_param("i", $id);
        $consultaPreparada->execute();/**/
        $resultado = $consultaPreparada->get_result();
        $filas = $resultado->fetch_array();
        $con1->close();
        $alumno = new Alumno($filas[0], $filas[1], $filas[2], $filas[3]);
        return $alumno;
    }
    function guardarAlumno($Alumno, $con = null)
    {
        try {
            if ($con == null) {
                $con = $this->crearConexion();
            }

            $id = $Alumno->getId();
            if ($id === 0) {
                $nombre = $Alumno->getNombre();
                $apellidos = $Alumno->getApellidos(); //:D
                $fecha_nacimiento = $Alumno->getFecha_nacimiento();
                $fTexto = $fecha_nacimiento->format('Y-m-d'); //pasamos el tipo date a string con el formato
                $sql1 = "INSERT INTO alumno (nombre, apellidos, fecha_nacimiento) Values (?,?,?)";
                $consultaPreparada = $con->prepare($sql1);
                $consultaPreparada->bind_param("sss", $nombre, $apellidos, $fTexto);
                $consultaPreparada->execute();
                $id = $con->insert_id;
                $Alumno->setId($id);
                //var_dump($id);
                $con->close();
            } else {
                $id = $Alumno->getId();
                $nombre = $Alumno->getNombre();
                $apellidos = $Alumno->getApellidos();
                $fecha_nacimiento = $Alumno->getFecha_nacimiento(); //:D
                $fTexto = $fecha_nacimiento->format('Y-m-d'); //pasamos el tipo date a string con el formato
                $sql1 = "UPDATE alumno set nombre=?, apellidos=?, fecha_nacimiento=? WHERE id=?";
                $consultaPreparada = $con->prepare($sql1);
                $consultaPreparada->bind_param("sssi", $nombre, $apellidos, $fTexto, $id);
                $consultaPreparada->execute();
                $con->close();
            }
        } catch (Exception $e) {
            return false;
        }
        return;
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

    function guardadoRegistroAlumno($AlumnoReg, $UsuarioReg)
    {
        $con1 = $this->crearConexion();
        $con1->autocommit(false);
        $con1->begin_transaction();
        try {
            $nombre = $AlumnoReg->getNombre();
            $apellidos = $AlumnoReg->getApellidos(); //:D
            $fecha_nacimiento = $AlumnoReg->getFecha_nacimiento();
            //var_dump($AlumnoReg->getFecha_nacimiento());        
            $fTexto = $fecha_nacimiento->format('Y-m-d'); //pasamos el tipo date a string con el formato
            $sql1 = "INSERT INTO alumno (nombre, apellidos, fecha_nacimiento) Values (?,?,?)";
            $consultaPreparada = $con1->prepare($sql1);
            $consultaPreparada->bind_param("sss", $nombre, $apellidos, $fTexto);
            $consultaPreparada->execute();
            $id = $con1->insert_id;
            $AlumnoReg->setId($id);

            $UsuarioReg->setAlumno_id($id);
            $usuReg = new UsuarioDAO();
            $usuReg->guardarUsuario($UsuarioReg, $con1);
            $con1->commit();
            return true;
        } catch (Exception $e) {
            $con1->rollback();
            return false;
        }

        return true;
    }

    function obtenerListadoAlumnosDAO($select = null, $ordenar = null)
    {
        $con1 = $this->crearConexion();
        $resultado = true;
        $listaAlumnos = array();

        if ($select == null || $ordenar == null) {
            $sql = "SELECT * FROM alumno;";
            $resultado = $con1->query($sql);
            foreach ($resultado as $fila) {
                //construirte un objeto de tipo Alumno
                $al = new Alumno($fila['id'], $fila['nombre'], $fila['apellidos'], $fila['fecha_nacimiento']);
                //Añadir el objeto a $listaAlumnos
                $listaAlumnos[] = $al;
            }
        } else {
            if ($select == "comienzaPor") {
                $sql = "SELECT * FROM alumno where apellidos like ?;";
                $ordenar = "$ordenar%";
            }
            if ($select == "terminaPor") {
                $sql = "SELECT * FROM alumno where apellidos like ?;";
                $ordenar = "%$ordenar";
            }
            if ($select == "esIgual") {
                $sql = "SELECT * FROM alumno where apellidos like ?;";
            }
            if ($select == "menorIgual") {
                $sql = "SELECT * FROM alumno where apellidos <= ? ORDER BY apellidos;";
            }
            if ($select == "mayorIgual") {
                $sql = "SELECT * FROM alumno where apellidos >= ? ORDER BY apellidos;";
            }if ($select == "sinFiltro") {
                $sql = "SELECT * FROM alumno where 1=1 or ?='aasasd'";
            }
            //bind_param
            $consultaPreparada = $con1->prepare($sql);
            $consultaPreparada->bind_param("s", $ordenar);
            $consultaPreparada->execute();

            $resultado = $consultaPreparada->get_result();
            while (($fila  = $resultado->fetch_array()) != null) {
                $al = new Alumno($fila['id'], $fila['nombre'], $fila['apellidos'], $fila['fecha_nacimiento']);
                //Añadir el objeto a $listaAlumnos
                $listaAlumnos[] = $al;
            }
        }
        $con1->close();
        return $listaAlumnos;
    }
}
