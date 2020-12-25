<html>

<head>
</head>
<style>
    h2 {
        font-family: 'Pacifico', cursive;
        text-align: center;
        color: #5638D7;
    }

    th {
        text-align: center;
        font-style: italic;
    }

    a:active,
    a:link,
    a:visited {
        color: #fff;
        background-color: #9D86FF;
        background-size: 2px;
        border-radius: 10%;
        padding: 10px;
        text-decoration: none;
    }

    table {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;
        margin: 45px;
        width: 480px;
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

    .footer {
        position: absolute;
        bottom: 0px;
        max-height: 200px;
        width: 100%;
    }

    .divCabecera {
        background-color: #FD4F4F;

        width: 100%;
        height: 75px;
        margin: auto;
    }
</style>
<?php

$aux = $_GET['usuario'];
session_name($aux);
session_start();

try {
    $base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM historial where nombreUsuario ='" . $aux . "'";

    $sentencia = $base->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();

    $numFilas = $sentencia->rowCount();
    $tamanoPaginas = 3;
    $empezar = ((int) $_GET['pagina'] - 1) * $tamanoPaginas;

    $totalPaginas = ceil($numFilas / $tamanoPaginas);

    $sqlLimit = "SELECT * FROM historial where nombreUsuario ='" . $aux . "' limit $empezar,$tamanoPaginas";  //desde donde empiezo ,cuantos quieros

    $sentencia = $base->prepare($sqlLimit);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();

    echo "<br><br><center><table><tr><td colspan='3'><h2>Historial</h2></td></tr>";
    echo "<tr><th>Fecha</th><th>Nombre Vuelo</th><th>Nombre Usuario</th></tr>";
    foreach ($registros as $registro) {
        echo "<tr>";
        echo "<td>" . $registro['fecha'] . "</td>";
        echo "<td>";
        echo  $registro['nombreVuelo'];
        echo "</td>";
        echo "<td>";
        echo $registro['nombreUsuario'];
        echo "</td>";
        echo "</tr>";
    }
    echo "</table></center>";

    function volver($usuario)
    {
        header("Location: login.php?usuario=" . session_name() . "");
    }
} catch (Exception $e) {
    die("Conexión fallida: " . $e->getMessage());
}

echo "<center>";
echo "<br>";
echo "<br>";
for ($i = 1; $i < $totalPaginas + 1; $i++) {
    echo "<a class='button' href='historial.php?usuario=" . session_name() . "&pagina=" . $i . "'>&nbsp;&nbsp;" . $i . "&nbsp;&nbsp;</a>&nbsp;";
}
echo "</center>";

$base = null;


if (isset($_POST['gestion'])) {
    header('Location:gestionar.php?usuario=' . session_name() . '');
}
?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="bootStrap/js/bootstrap.min.js"></script>

    <div class="contenedor">
        <div class="container-fluid divCabecera">

            <nav class="navbar navbar-expand-sm navbar-light ">
                <a href="index.php" class="navbar-brand"><img src="img/logo.png" width="60px" height="60px"></a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#opciones">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  submenu" id="opciones">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="check-in.php">Informacion de check-in</a></li>
                        <li class="nav-item"><a class="nav-link" href="buscaVuelo.php">Pasajeros con necesidades especiales</a></li>
                        <li class="nav-item"><a class="nav-link" href="otros.php">Otros servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Inicia Sesion</a></li>
                    </ul>
                </div>
            </nav>

            <form action="" method="POST" align=center>
                <br>
                <button name='volver' type='submit' value="">Volver </button>
                <button name='gestion' type='submit' value="">Gestionar vuelos </button>
                <?php
                if (isset($_POST['volver'])) {
                    volver(session_name());
                }
                ?>
            </form>
</body>

</html>