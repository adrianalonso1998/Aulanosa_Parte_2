<?php

include_once "ServicioAlumnos.php";
$serv = new ServicioAlumnos();
$listado = $serv->obtenerListadoAlumnos();
$numero = 1;
$datosAlumnoXml='';
$cabeceraXml='<?xml version="1.0" encoding="UTF-8"?>
<alumnos>';
foreach ($listado as $alumno) :
    $datosAlumnoXml='
    <alumno id="'.$alumno->getId().'">
        <nombre>'.$alumno->getNombre().'</nombre>    
        <apellidos>'.$alumno->getApellidos().'</apellidos>   
        <fecha_nacimiento>'.$alumno->getFecha_nacimiento().'</fecha_nacimiento>
    </alumno>';
    $cabeceraXml=$cabeceraXml.$datosAlumnoXml;
endforeach;
$cabeceraXml=$cabeceraXml."\n"."</alumnos>";
header('content-type: text/xml');//indicar que es un xml
header('content-Disposition: attachment; filename="alumnos.xml"');// descarga del xml en el local
echo $cabeceraXml;
?>