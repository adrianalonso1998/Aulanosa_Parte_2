<?php
include_once "../carpetaModelo/Alumno.php";
include_once "../CarpetaDatos/UsuarioDAO.php";
$usuDAO=new UsuarioDAO();
$fecha=new DateTime('1921-11-11');
$alumno1=new Alumno(1,"prueba3","prueba4",$fecha);
$usu=$usuDAO->obtenerUsuario("admin","1234");
$alumDAO = new AlumnoDAO();
$alu=$alumDAO->obtenerAlumno($usu);
$alumDAO->guardarAlumno($alumno1);
var_dump($alu);
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
        $alumno=new Alumno($filas[0],$filas[1],$filas[2],$filas[3]);
        return $alumno;
    }
    function guardarAlumno($Alumno)//terminar practicamente todo->aqui
    {
        $id=$Alumno->getId();
        if($id===0){
        $login=$Alumno->getLogin();
        $password=$Alumno->getPassword();
        $alumno_id=$Alumno->getAlumno_id();//:D
        $con = $this->crearConexion();   
        $sql1 = "INSERT INTO usuario (login, password, alumno_id) Values (?,?,?)";
        $consultaPreparada = $con->prepare($sql1);
        $consultaPreparada->bind_param("ssi", $login, $password,$alumno_id);
        $consultaPreparada->execute();
        $id=$con->insert_id;
        $Alumno->setId($id);
        var_dump($id);
        $con->close();
    }
    else{
        $id=$Alumno->getId();
        $login=$Alumno->getLogin();
        $password=$Alumno->getPassword();
        $alumno_id=$Alumno->getAlumno_id();//:D
        $con = $this->crearConexion();   
        $sql1 = "UPDATE usuario set login=?, password=? WHERE id=?";
        $consultaPreparada = $con->prepare($sql1);
        $consultaPreparada->bind_param("ssi", $login, $password,$id);
        $consultaPreparada->execute();
        $con->close();
    }
    }
    function eliminarAlumno($Alumno)
    {
    }
}
