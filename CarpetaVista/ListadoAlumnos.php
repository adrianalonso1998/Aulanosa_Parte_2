<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrián alonso tabla</title>
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
            margin: 20% 20% 10% 20%;
        }
    </style>
</head>

<body>
    <div>
        <table>
            <?php
            //terminar tabla get en todos los campos y poner th
            include_once "../CarpetaModelo/ServicioAlumnos.php";
            if(isset ($_GET['registro'])){
                echo '<script>alert("Gracias por registrarte")</script>';
            }
            $serv = new ServicioAlumnos();
            $listado = $serv->obtenerListadoAlumnos();
           // var_dump($listado);
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha Nacimiento</th></tr>";
            foreach ($listado as $alumno) :
            ?>
                <tr>
                    <?php
                    echo "<td>" . $alumno->getNombre() . "</td>";
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

</body>

</html>