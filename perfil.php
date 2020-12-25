<!DOCTYPE html>
<html lang="en">

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .divCabecera {
            background-color: #FD4F4F;
            width: 100%;
            height: 75px;
            margin: auto;
        }

        .footer {
            /* position: absolute; */
            bottom: 0px;
            max-height: 200px;
            width: 100%;
        }

        .parrafoFooter {
            padding: 10px;
        }

        .cuerpo {
            background-color: #F5F5F4;
            min-height: 400px;
            border-radius: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }

        input[type="submit"],
        .btn {
            border: none;
            outline: none;
            height: 40px;
            background: #FF6767;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            width: 120px;
        }

        input[type="submit"]:hover,
        .btn:hover {
            cursor: pointer;
            background: #FC9595;
            color: #000;
        }

        html {
            overflow-x: hidden;
        }

        .card {
            min-width: 250px;
        }
    </style>
</head>

<?php

$aux = $_GET['usuario'];
session_name($aux);
session_start();

try {
    $base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlUsuarios = "SELECT * FROM usuarios WHERE nombre='" . session_name() . "'";
    $sentencia = $base->prepare($sqlUsuarios);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();

    $nombre = "";
    $apellidos = "";
    $correo = "";
    $telefono = "";
    $contrasena = "";
    $id = "";
    foreach ($registros as $registro) {
        $nombre = $registro['nombre'];
        $apellidos = $registro['apellidos'];
        $correo = $registro['correo'];
        $telefono = $registro['telefono'];
        $contrasena = $registro['contrasena'];
        $id = $registro['id'];
    }

    $sqlCarrito = "SELECT * FROM carrito WHERE usuarioCarrito='" . session_name() . "'";
    $sentencia = $base->prepare($sqlCarrito);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $row = $sentencia->rowCount();
    if ($row != 0) {
        $carrito = "<div class='table-responsive-lg'><table class='table-sm'><tr><th>Compañia</th>
        <th>Codigo</th><th>Pais</th><th>Clase</th><th>Precio</th><th>Fecha ida</th>
    <th>Fecha vuelta</th><th>Cantidad</th></tr>";
        foreach ($registros as $registro) {
            $carrito .= "<tr>";
            $carrito .= "<td>" . $registro['compania'] . "</td>";
            $carrito .= "<td>" . $registro['codigo'] . "</td>";
            $carrito .= "<td>" . $registro['pais'] . "</td>";
            $carrito .= "<td>" . $registro['clase'] . "</td>";
            $carrito .= "<td>" . $registro['precio'] .  "</td>";
            $carrito .= "<td>" . $registro['fecha_ida'] . "</td>";
            $carrito .= "<td>" . $registro['fecha_vuelta'] . "</td>";
            $carrito .= "<td>" . $registro['cantidad'] . "</td>";
            $carrito .= "</tr>";
        }
        $carrito .= "</table></div>";
    } else {
        $carrito = "No tiene vuelos en el carrito";
    }



    $sqHistorial = "SELECT * FROM historial WHERE nombreUsuario='" . session_name() . "' LIMIT 5";
    $sentencia = $base->prepare($sqHistorial);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $historial = "<table class='table'><tr><th>Codigo del vuelo</th><th>Fecha</th></tr>";
    foreach ($registros as $registro) {
        $historial .= "<tr>";
        $historial .= "<td>" . $registro['codigo'] . "</td>";
        $historial .= "<td>" . $registro['fecha'] . "</td>";

        $historial .= "</tr>";
    }
    $historial .= "</table>";


    if (isset($_POST['modificar'])) {
        header('location: modificarPerfil.php?usuario=' . session_name() . '&id=' . $id . '');
    }
    if (isset($_POST['volver'])) {
        header('location: vuelos.php?usuario=' . session_name() . '');
    }
} catch (Exception $e) {
    die("Conexión fallida: " . $e->getMessage());
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
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesion</a></li>
                    </ul>
                </div>
            </nav>

            <div class="row">
                <div class="col-2 col-sm-2"> </div>
                <div class="col-9 col-sm-8"><br>


                    <h3>Perfil del usuario</h3>
                    <div class=" cuerpo">
                        <div class="row"><br>
                            <div class="col-2"> </div>
                            <div class="col-9"><br>
                                <div class="row">
                                    <div class="col-12  col-md-6">
                                        <h5> Nombre</h5>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php echo $nombre; ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  col-md-6">
                                        <h5> Apellidos</h5>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php echo $apellidos; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  col-md-6">
                                        <h5>Correo Electronico</h5>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php echo $correo; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  col-md-6">
                                        <h5>Telefono</h5>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php echo $telefono; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  col-md-6">
                                        <h5> Contraseña</h5>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php echo  $contrasena; ?>
                                    </div>
                                </div>
                                <hr>
                                <br>

                                <div class="row">
                                    <div class="col-12 ">

                                        <div id="accordion">
                                            <!-- <div class='table-responsive-lg'> -->
                                            <div class="card ">
                                                <div class="card-header">
                                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                        Vuelos en el carrito
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?php echo $carrito; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                        Ultimos vuelos comprados
                                                    </a>
                                                </div>
                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?php echo $historial; ?>
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  col-md-6"><br>
                                        <form action="" method="post">
                                            <input type="submit" name="volver" value="Volver">
                                        </form>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <form action="" method="post">
                                            <br>
                                            <button type='button submit' class='btn btn-light' name='modificar' value="<?php echo $id; ?>">Modificar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 col-sm-2"></div>
            </div>
            <div class="row footer">
                <div class="container-fluid text-center text-md-left col-xs-12" style="background-color: black; color:white">
                    <div class="row">
                        <div class="col-md-6 mt-md-0 mt-3" style="padding: 15px;">
                            <center>
                                <h6 class="text-uppercase">Porque reservar con ...</h6>
                            </center>
                            <p class="parrafoFooter">En ... te llevamos a más de 130 destinos de las principales ciudades de España,
                                Europa, norte de África y Oriente Próximo. Es muy fácil: visita nuestra web,
                                elige tu destino y encuentra vuelos baratos.
                                <b>¡Siempre a los mejores precios!</b></p>
                        </div>
                        <hr class="clearfix w-100 d-md-none pb-3">
                        <div class="col-md-3 mb-md-0 mb-3 d-none d-md-block" style="padding: 15px;">
                            <h6 class="text-uppercase">Vuelos destacados</h6>
                            <ul class="list-unstyled">
                                <li>
                                    Madrid - Paris
                                </li>
                                <li>
                                    Barcelona - Atenas
                                </li>
                                <li>
                                    Gran Canaria - Madrid
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 mb-md-0 mb-3" style="padding: 15px;">
                            <h6 class="text-uppercase">Contacta con nosotros</h6>
                            <div class="row">
                                <img class="col-3 icon" src="img/ico/facebook.png" alt="Facebook">
                                <img class=" col-3 icon" src="img/ico/instagram.png" alt="instagram">
                                <img class="col-3 icon" src="img/ico/twitter.png" alt="twitter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>