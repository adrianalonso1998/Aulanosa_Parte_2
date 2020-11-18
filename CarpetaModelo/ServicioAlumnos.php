
<?php

include_once "../CarpetaDatos/AlumnoDAO.php";
class ServicioAlumnos{
//esto es copiado cambiar

function obtenerListadoAlumnos(){
    $aluDAO3= new AlumnoDAO();
    $listaAlumnos=$aluDAO3->obtenerListadoAlumnosDAO();
    return $listaAlumnos;
}

function guardarAlumno($alumno,$usuario){
    $aluDAO4= new AlumnoDAO();
    $aluDAO4->guardadoRegistroAlumno($alumno, $usuario);
}
}


?>