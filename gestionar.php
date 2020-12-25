<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h2 {
            font-family: 'Pacifico', cursive;
            text-align: center;
            color: #5638D7;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin: 45px;
            width: 600px;
            text-align: left;
            border-collapse: collapse;
        }

        th {
            font-size: 13px;
            font-weight: normal;
            padding: 8px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: #039;
        }

        td {
            padding: 8px;
            background: #e8edff;
            border-bottom: 1px solid #fff;
            color: #669;
            border-top: 1px solid transparent;
        }

        tr:hover td {
            background: #d0dafd;
            color: #339;
        }
    </style>
</head>

<body>

    <?php
    $aux = $_GET['usuario'];
    session_name($aux);
    session_start();

    $conexion = new mysqli('localhost', 'root', '', 'vuelosviajes');
    $consulta = $conexion->stmt_init();
    $consulta->prepare('SELECT * FROM vuelos');
    $consulta->execute();
    $consulta->bind_result($id, $pais, $clase, $precio, $fecha_ida, $fecha_vuelta);
    echo "<h2>Vuelos</h2>";
    echo "<center><table><tr><th>Pais</th><th>Clase</th><th>Precio</th><th>Fecha ida</th><th>Fecha vuelta</th></tr>";
    while ($consulta->fetch()) {
        echo "<tr><td>" . $pais . "</td>";
        echo "<td>" . $clase . "</td>";
        echo "<td>" . $precio . "</td>";
        echo "<td>" . $fecha_ida . "</td>";
        echo "<td>" . $fecha_vuelta . "</td>";
        echo "</tr>";
    }
    echo "</table></center>";

    $consulta->close();
    $conexion->close();

    if (isset($_POST['volver'])) {
        header('Location: historial.php?usuario=' . session_name() . '&pagina=1');
    }

    ?>
    <form action="" method="post">
        <center>
            <input type="submit" name="volver" value="Volver">
            <input type="submit" name="nuevo" value="Nuevo">
        </center>

    </form>

    <?php

    if (isset($_POST['nuevo'])) {
        echo "<form action='' method='post'><center>  <p>*campo obligatorio</p> <table> 
    <tr>
                <td>Pais</td>
                <td> <input type='text' name='pais'> *</td>
            </tr>
            <tr>
                <td>Clase</td>
                <td><input type='text' name='clase'>*</td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input type='number' name='precio'>*</td>
            </tr>
            <tr>
                <td>Fecha ida</td>
                <td><input type='date' name='fecha_ida'>*</td>
            </tr>
            <tr>
                <td>Fecha vuelta</td>
                <td><input type='date' name='fecha_vuelta'>*</td>
            </tr>
        </table>
        <input type='submit' name='enviar' value='Enviar'></center></form>";
    }

    if (isset($_POST['enviar'])) {
        $conexion = new mysqli('localhost', 'root', '', 'vuelosviajes');
        $consulta = $conexion->stmt_init();
        $consulta->prepare('INSERT INTO vuelos (pais,clase, precio, fecha_ida,fecha_vuelta) values (?,?,?,?,?)');
        echo "<center>";

        $pais = "";
        $clase = "";
        $precio = "";
        $fecha_ida = "";
        $fecha_vuelta = "";
        if (isset($_POST['pais'])) {
            $pais = $_POST['pais'];
        } else {
            echo "Debe introducir el pais";
        }
        if (isset($_POST['clase'])) {
            $clase = $_POST['clase'];
        } else {
            echo "Debe introducir una clase";
        }
        if (isset($_POST['precio'])) {
            $precio = $_POST['precio'];
        } else {
            echo "Debe introducir un precio";
        }
        if (isset($_POST['fecha_ida'])) {
            $fecha_ida = $_POST['fecha_ida'];
        } else {
            echo "Debe introducir una fecha de ida ";
        }
        if (isset($_POST['fecha_vuelta'])) {
            $fecha_vuelta = $_POST['fecha_vuelta'];
        } else {
            echo "Debe introducir una fecha de vuelta";
        }

        echo "</center>";

        $consulta->bind_param('ssiss', $pais, $clase, $precio, $fecha_vuelta, $fecha_ida);
        $consulta->execute();
        $consulta->close();
        $conexion->close();
        header('Location:gestionar.php?usuario=' . session_name() . '');
    }
    ?>
</body>

</html>