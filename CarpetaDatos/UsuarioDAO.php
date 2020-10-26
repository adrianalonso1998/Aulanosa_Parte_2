<?php 
include_once "../carpetaModelo/Usuario.php";
$login = "admin";
$password = "1234";
$usu=new Usuario("","admin2","1111",2);
$usuDAO=new UsuarioDAO();
$usuDAO->obtenerUsuario($login, $password);
$usuDAO->guardarUsuario($usu);
class UsuarioDAO{





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
function obtenerUsuario($login, $password)
{
    $con1 = $this->crearConexion();
    $sql = "SELECT id,login,password,alumno_id FROM Usuario WHERE login=? AND password=?;";
    $consultaPreparada = $con1->prepare($sql);
    $consultaPreparada->bind_param("ss", $login, $password);
    $consultaPreparada->execute();
    $resultado = $consultaPreparada->get_result();
    $filas = $resultado->fetch_array();
    var_dump($filas);
    $con1->close();
}
function guardarUsuario($Usuario)
{
    $login=$Usuario->getLogin();
    $password=$Usuario->getPassword();
    $alumno_id=$Usuario->getAlumno_id();//:D
    $con = $this->crearConexion();   
    $sql1 = "INSERT INTO usuario (login, password, alumno_id) Values (?,?,?)";
    $consultaPreparada = $con->prepare($sql1);
    $consultaPreparada->bind_param("ssi", $login, $password,$alumno_id);
    $consultaPreparada->execute();
    $id=$con->insert_id;
    var_dump($id);
    $con->close();

}
function eliminarUsuario($Usuario)
{
}
}