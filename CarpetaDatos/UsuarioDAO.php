<?php
include_once "../carpetaModelo/Usuario.php";
// $login = "admin";
// $password = "1234";
//$usu=new Usuario(12,"ElPepe","EteSetch",1);
//$usuDAO=new UsuarioDAO();
// $usu=$usuDAO->obtenerUsuario($login, $password);
// var_dump($usu);
//$usuDAO->guardarUsuario($usu);
//$usuDAO->eliminarUsuario($usu);
class UsuarioDAO
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
    public function obtenerUsuario($login, $password)
    {
        $con1 = $this->crearConexion();
        $sql = "SELECT id,login,password,alumno_id FROM usuario WHERE login=? AND password=?;";
        $consultaPreparada = $con1->prepare($sql);
        $consultaPreparada->bind_param("ss", $login, $password);
        $consultaPreparada->execute();
        $resultado = $consultaPreparada->get_result();
        $filas = $resultado->fetch_array();
        $con1->close();
        if ($filas != null) {
            $usuario = new Usuario($filas[0], $filas[1], $filas[2], $filas[3]);
            return $usuario;
        } else {
            return false;
        }
    }
    function obtenerComprobacionUsuario($login)///////comprobar si ya exixte el login
    {
        $con1 = $this->crearConexion();
        $sql = "SELECT id,login,password,alumno_id FROM usuario WHERE login=?;";
        $consultaPreparada = $con1->prepare($sql);
        $consultaPreparada->bind_param("s", $login);
        $consultaPreparada->execute();
        $resultado = $consultaPreparada->get_result();
        $filas = $resultado->fetch_array();
        $con1->close();
        if ($filas != null) {
            return true;
        } else {
            return false;
        }
    }
    function guardarUsuario($Usuario, $con = null)
    {
        $cerrarConexion = false;
        if ($con == null) {
            $con = $this->crearConexion();
            $cerrarConexion = true;
        }
        $id = $Usuario->getId();
        //insertar en base de datos, se le pasa un objeto y si no tene id es o por lo cual entra y lo registra
        if ($id === 0) {
            $login = $Usuario->getLogin();
            $password = $Usuario->getPassword();
            $alumno_id = $Usuario->getAlumno_id(); //:D
            $sql1 = "INSERT INTO usuario (login, password, alumno_id) Values (?,?,?)";
            $consultaPreparada = $con->prepare($sql1);
            $consultaPreparada->bind_param("ssi", $login, $password, $alumno_id);
            $consultaPreparada->execute();
            $id = $con->insert_id;
            $Usuario->setId($id);
            if ($cerrarConexion == true) {
                $con->close();
            }
        }
        //si ya esta creado lo actualiza
        else {
            $id = $Usuario->getId();
            $login = $Usuario->getLogin();
            $password = $Usuario->getPassword();
            $alumno_id = $Usuario->getAlumno_id(); //:D
            $sql1 = "UPDATE usuario set login=?, password=? WHERE id=?";
            $consultaPreparada = $con->prepare($sql1);
            $consultaPreparada->bind_param("ssi", $login, $password, $id);
            $consultaPreparada->execute();
            if ($cerrarConexion == true) {
                $con->close();
            }
        }
    }
    function eliminarUsuario($Usuario)
    {
        $id = $Usuario->getId();
        $con = $this->crearConexion();
        $sql1 = "DELETE FROM usuario WHERE id=?";
        $consultaPreparada = $con->prepare($sql1);
        $consultaPreparada->bind_param("i", $id);
        $consultaPreparada->execute();
        $con->close();
    }
}
