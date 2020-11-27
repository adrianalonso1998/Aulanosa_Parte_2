<?php

include_once "../CarpetaDatos/AlumnoDAO.php";
class ServicioAlumnos
{
    //esto es copiado cambiar

    function obtenerListadoAlumnos()
    {
        $aluDAO3 = new AlumnoDAO();
        $listaAlumnos = $aluDAO3->obtenerListadoAlumnosDAO();
        return $listaAlumnos;
    }
    function obtenerAlumnoPorId($id)
    {
        $aluDAO3 = new AlumnoDAO();
        $datosAlumnoListado = $aluDAO3->obtenerAlumnoPorId($id);
        return $datosAlumnoListado;
    }

    function guardarAlumno($alumno, $usuario)
    {
        $aluDAO4 = new AlumnoDAO();
        $retorno = $aluDAO4->guardadoRegistroAlumno($alumno, $usuario);
        //var_dump($retorno);
        return $retorno;
    }

    function guardarAlumnoPorId($alumno)
    {
        $aluDAO4 = new AlumnoDAO();
        $retorno = $aluDAO4->guardarAlumno($alumno, null);
        return $retorno;
    }
}


?>