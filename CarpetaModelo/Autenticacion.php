<?php
include_once "../CarpetaVista/autenticar.php";
include_once "usuario.php";
include_once "../CarpetaDatos/UsuarioDAO.php";

class Autenticacion
{
    function comprobarUsuario($login, $pass)
    {
        $usuDAO = new UsuarioDAO();
        $usuarios = $usuDAO->obtenerUsuario($login, $pass);
        if ($usuarios != false) {
            return $usuarios;
        } else {
            return false;
        }
    }
}
