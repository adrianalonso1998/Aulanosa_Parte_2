<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián alonso tabla</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        table {
            border: solid green 5%;
        }

        th {
            color: white;
            background: rgb(95, 99, 96);
            border: rgb(96, 145, 18) 1px solid;
            padding: 5%;
            font-size: x-large;
        }

        td {
            background: white;
            text-align: center;
            border: rgb(96, 145, 18) 1px solid;
            width: 10%;
            padding: 3%;
        }

        body {
            background: rgb(219, 214, 214);
        }

        table {
            border-collapse: collapse;
        }

        div {
            margin: 3% 15%;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>
    <ul class="nav nav-tabs nav-justified">
        <?php
        if (!isset($_SESSION['sesion']) && !isset($_SESSION['datosUsuario'])) {
            echo '<li class="pl-5"><a href="login.php">login </a></li>';
        }
        ?>
        <li class="pl-5"><a href="FormularioAltaAlumno.php">Formulario De Alta </a></li>
        <?php
        if (isset($_SESSION['sesion']) || isset($_SESSION['datosUsuario'])) {
            echo '<li class="pl-5"><a href="datosAlumno.php">Datos Alumno  </a></li>';
            echo '<li class="pl-5"><a href="ListadoAlumnos.php">Listado De Alumnos  </a></li>';
        }
        ?>
        <li class="pl-5"><a href="../CarpetaModelo/generadorXml.php">Descargar Xml</a></li>
    </ul>

    <div>
        <table>

            <?php
            include_once "../CarpetaModelo/ServicioAlumnos.php";
            $serv = new ServicioAlumnos();
            $listado = $serv->obtenerListadoAlumnos();
            // var_dump($listado);
            echo "<tr><th class='text-center'>Nombre</th><th class='text-center'>Apellidos</th><th class='text-center'>Fecha Nacimiento</th></tr>";
            foreach ($listado as $alumno) :
            ?>
                <tr>
                    <?php
                    $nuevoId = $alumno->getId();
                    echo "<td>" . "<a href='datosAlumnoListado.php?id=$nuevoId'>" . $alumno->getNombre() . '</a>' . "</td>";
                    ?>
                    <?php
                    echo "<td>" . $alumno->getApellidos() . "</td>";
                    ?>
                    <?php
                    echo "<td>" . $alumno->getFecha_nacimiento() . "</td>";
                    ?>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <form action="deslogar.php" method="POST">
                <input type="submit" value="Cerrar Sesión" >
        </div>
    </div>
    </form>
</body>

</html>