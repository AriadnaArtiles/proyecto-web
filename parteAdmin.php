<!DOCTYPE html>
<html>

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .divCabecera {
            background-color: #FD4F4F;
            width: 100%;
            height: 75px;
            margin: auto;
        }

        .divBienvenida {
            color: #FF1B1B;
            width: 100%;
            height: 175px;
            font-weight: 150;
            font-family: Vegur, 'PT Sans', Verdana, Sans-serif;
        }

        .titulo {
            margin: 5px;
        }

        .centrado {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        div.polaroid {
            width: 250px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin: 10px;
        }

        p {
            padding: 10px;
        }

        .footer {
            position: relative;
            bottom: 0;
            max-height: 200px;
            width: 100%;
        }

        .icon {
            width: 20px;
            height: 40px;
            margin: 2px;
        }

        .iconTabla {
            width: 20px;
            height: 30px;
            margin: 2px;
        }

        .logo {
            width: 90px;
            height: 90px;
        }

        .cuerpo {
            min-height: 360px;
            background-color: #F5F5F4;
            padding-right: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            padding-left: 40px;
            /* margin-left: 15px; */
            padding-top: 15px;
            padding-bottom: 20px;
        }

        .btn-light:hover {
            background-color: #FFB0B0;
        }

        input[type="submit"] {
            border: none;
            outline: none;
            height: 33px;
            background: #FF6767;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            margin-top: 20px;
            margin-bottom: 20px;

        }

        input[type="submit"]:hover {
            cursor: pointer;
            background: #FC9595;
            color: #000;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #FD4F4F;
        }

        td,
        th {
            margin: 10px;
        }

        .respon {
            max-width: 350px;
        }

        html {
            overflow-x: hidden;
        }

        table {
            width: 850px;
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

    // carrito

    $sqlCarrito = "SELECT * FROM carrito";
    $sentencia = $base->prepare($sqlCarrito);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $row = $sentencia->rowCount();
    $carrito = "  <div class='row'> <p>Escriba algo en el campo de entrada para buscar en la tabla</p>  
    <input class='form-control' id='myInputCarrito' type='text' placeholder='Buscar en el carrito..'><br>";
    $carrito .= "<div class='respon'> <div class='table-responsive-lg'> <table class='table-xs'><form action='' 
    method='post'><tr><td> <input type='submit' name='nuevoCarrito' value='Nuevo registro'></td></tr>
    <tr><th>Nombre del usuario</th><th>Compañia</th><th>Codigo</th><th>Pais</th><th>Clase</th><th>Precio</th>
    <th>Fecha ida</th><th>Fecha vuelta</th><th>Cantidad</th><th></th><th></th><th></th></tr>";
    if ($row != 0) {
        foreach ($registros as $registro) {
            $carrito .= "<tbody id='myTableCarrito'><tr>";
            $carrito .= "<td>" . $registro['usuarioCarrito'] . "</td>";
            $carrito .= "<td>" . $registro['compania'] . "</td>";
            $carrito .= "<td>" . $registro['codigo'] . "</td>";
            $carrito .= "<td>" . $registro['pais'] . "</td>";
            $carrito .= "<td>" . $registro['clase'] . "</td>";
            $carrito .= "<td>" . $registro['precio'] .  "</td>";
            $carrito .= "<td>" . $registro['fecha_ida'] . "</td>";
            $carrito .= "<td>" . $registro['fecha_vuelta'] . "</td>";
            $carrito .= "<td>" . $registro['cantidad'] . "</td>";
            $carrito .= "<td><button type='button submit' class='btn btn-light' name='editarCarrito' value='" .
                $registro['id'] . "'>Editar</button>";
            $carrito .= "<td><button type='button submit' class='btn btn-light' onclick='return deleteCarrito()'
             name='borrarCarrito' value='" . $registro['id'] . "'>Borrar</button>";
            $carrito .= "</tr>";
        }
    } else {
        $carrito .= "<form action='' method='post'>";
    }
    $carrito .= " </tbody></form></table></div></div></div>";

    if (isset($_POST['editarCarrito'])) {
        header("Location: editar_carrito.php?usuario=" . session_name() . "&idCarrito=" . $_POST['editarCarrito'] . "");
    }


    // usuarios

    $sqlUsuarios = "SELECT * FROM usuarios ";
    $sentencia = $base->prepare($sqlUsuarios);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $usuarios = " <div class='row'> <p>Escriba algo en el campo de entrada para buscar en la tabla</p>  
    <input class='form-control' id='myInputUsuario' type='text' placeholder='Buscar usuario..'><br>";
    $usuarios .= "<div class='respon'> <div class='table-responsive-lg'> <table class='table-xs'><form action='' method='post'>
     <tr><td> <input type='submit' name='nuevoUsuario' value='Nuevo registro'></td></tr><tr><th>Nombre</th><th>Apellidos</th>
     <th>Correo electronico</th><th>Telefono</th><th>Contraseña</th><th>Contraseña repetida</th><th></th></tr>";
    foreach ($registros as $registro) {
        $usuarios .= " <tbody id='myTableUsuario'><tr>";
        $usuarios .= "<td>" . $registro['nombre'] . "</td>";
        $usuarios .= "<td>" . $registro['apellidos'] . "</td>";
        $usuarios .= "<td>" . $registro['correo'] . "</td>";
        $usuarios .= "<td>" . $registro['telefono'] . "</td>";
        $usuarios .= "<td>" . $registro['contrasena'] . "</td>";
        $usuarios .= "<td>" . $registro['repetida'] . "</td>";
        $usuarios .= "<td><button type='button submit' class='btn btn-light' name='editarUsuarios' value='" .
            $registro['id'] . "'>Editar</button>";
        $usuarios .= "<td><button type='button submit' class='btn btn-light'  onclick='return deleteUsuario()' 
        name='borrarUsuarios' value='" . $registro['id'] . "'>Borrar</button>";
        $usuarios .= "</tr>";
    }
    $usuarios .= "</tbody></form></table></div></div></div>";



    if (isset($_POST['editarUsuarios'])) {
        header("Location: editar_usuarios.php?usuario=" . session_name() . "&idUsuarios=" . $_POST['editarUsuarios'] . "");
    }

    // historial

    $sqHistorial = "SELECT * FROM historial ";
    $sentencia = $base->prepare($sqHistorial);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $historial = "<div class='row'><p>Escriba algo en el campo de entrada para buscar en la tabla</p>  
    <input class='form-control' id='myInputHistorial' type='text' placeholder='Buscar en el historial..'><br>";
    $historial .= "<div class='respon'> <div class='table-responsive-lg'> <table class='table-xs'><form action='' 
    method='post'><tr><td> <input type='submit' name='nuevoHistorial' value='Nuevo registro'></td></tr>
    <tr><th>Nombre del usuario</th><th>Codigo del vuelo</th><th>Fecha</th><th></th></tr>";
    foreach ($registros as $registro) {
        $historial .= " <tbody id='myTableHistorial'><tr>";
        $historial .= "<td>" . $registro['nombreUsuario'] . "</td>";
        $historial .= "<td>" . $registro['codigo'] . "</td>";
        $historial .= "<td>" . $registro['fecha'] . "</td>";
        $historial .= "<td><button type='button submit' class='btn btn-light' name='editarHistorial' value='" .
            $registro['id'] . "'>Editar</button>";
        $historial .= "<td><button type='button submit' class='btn btn-light' onclick='return deleteHistorial()'  
        name='borrarHistorial'  value='" . $registro['id'] . "'>Borrar</button>";
        $historial .= "</tr>";
    }
    $historial .= "</tbody></form></table></div></div></div>";


    if (isset($_POST['editarHistorial'])) {
        header("Location: editar_historial.php?usuario=" . session_name() . "&idHistorial=" . $_POST['editarHistorial'] . "");
    }

    // vuelos
    $sqVuelos = "SELECT * FROM vuelos";
    $sentencia = $base->prepare($sqVuelos);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $vuelos = "<div class='row'><p>Escriba algo en el campo de entrada para buscar en la tabla</p>  
    <input class='form-control' id='myInputVuelo' type='text' placeholder='Buscar Vuelo..'><br>";
    $vuelos .= "<div class='respon'> <div class='table-responsive-lg'> <table class='table-xs'>";
    $vuelos .= "<form action='' method='post'> <tr><td> <input type='submit' name='nuevoVuelo' 
    value='Nuevo registro'></td></tr><tr><th>Compañia</th><th>Codigo</th><th>Pais</th><th>Clase</th>
    <th>Precio</th><th>Fecha ida</th><th>Fecha vuelta</th><th></th></tr>";
    foreach ($registros as $registro) {
        $vuelos .= "<tbody id='myTableVuelo'><tr>";
        $vuelos .= "<td>" . $registro['compania'] . "</td>";
        $vuelos .= "<td>" . $registro['codigo'] . "</td>";
        $vuelos .= "<td>" . $registro['pais'] . "</td>";
        $vuelos .= "<td>" . $registro['clase'] . "</td>";
        $vuelos .= "<td>" . $registro['precio'] . "</td>";
        $vuelos .= "<td>" . $registro['fecha_ida'] . "</td>";
        $vuelos .= "<td>" . $registro['fecha_vuelta'] . "</td>";
        $vuelos .= "<td><button type='button submit' class='btn btn-light' name='editarVuelos' value='" .
            $registro['id'] . "'>Editar</button>";
        $vuelos .= "<td><button type='button submit' class='btn btn-light' onclick='return deleteVuelo()' 
        name='borrarVuelos' value='" . $registro['id'] . "'>Borrar</button>";
        $vuelos .= "</tr>";
    }
    $vuelos .= "</tbody></form></table></div></div></div>";

    if (isset($_POST['editarVuelos'])) {
        header("Location: editar_vuelos.php?usuario=" . session_name() . "&idVuelos=" . $_POST['editarVuelos'] . "");
    }



    // borrar

    if (isset($_POST['borrarUsuarios'])) {
        $sql2 = "SELECT * FROM usuarios where id=" . $_POST['borrarUsuarios'] . "";
        $sentencia = $base->prepare($sql2);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();

        foreach ($registros as $registro) {
            if ($registro['id'] == $_POST['borrarUsuarios']) {
                $eliminar = "DELETE FROM usuarios WHERE id=" . $_POST['borrarUsuarios'] . ";";
                $sentencia = $base->prepare($eliminar);
                $sentencia->execute();
                header("Location: parteAdmin.php?usuario=" . session_name() . "");
            }
        }
    }

    if (isset($_POST['borrarVuelos'])) {
        $sql3 = "SELECT * FROM vuelos where id=" . $_POST['borrarVuelos'] . "";
        $sentencia = $base->prepare($sql3);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();

        foreach ($registros as $registro) {
            if ($registro['id'] == $_POST['borrarVuelos']) {
                $eliminar = "DELETE FROM vuelos WHERE id=" . $_POST['borrarVuelos'] . ";";
                $sentencia = $base->prepare($eliminar);
                $sentencia->execute();
                header("Location: parteAdmin.php?usuario=" . session_name() . "");
            }
        }
    }

    if (isset($_POST['borrarHistorial'])) {
        $sql4 = "SELECT * FROM historial where id=" . $_POST['borrarHistorial'] . "";
        $sentencia = $base->prepare($sql4);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();

        foreach ($registros as $registro) {
            if ($registro['id'] == $_POST['borrarHistorial']) {
                $eliminar = "DELETE FROM historial WHERE id=" . $_POST['borrarHistorial'] . ";";
                $sentencia = $base->prepare($eliminar);
                $sentencia->execute();
                header("Location: parteAdmin.php?usuario=" . session_name() . "");
            }
        }
    }
    if (isset($_POST['borrarCarrito'])) {
        $sql5 = "SELECT * FROM carrito where id=" . $_POST['borrarCarrito'] . "";
        $sentencia = $base->prepare($sql5);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();

        foreach ($registros as $registro) {
            if ($registro['id'] == $_POST['borrarCarrito']) {
                $eliminar = "DELETE FROM carrito WHERE id=" . $_POST['borrarCarrito'] . ";";
                $sentencia = $base->prepare($eliminar);
                $sentencia->execute();
                header("Location: parteAdmin.php?usuario=" . session_name() . "");
            }
        }
    }

    if (isset($_POST['nuevoUsuario'])) {
        header("Location: nuevo_usuario.php?usuario=" . session_name() . "");
    }
    if (isset($_POST['nuevoVuelo'])) {
        header("Location: nuevo_vuelo.php?usuario=" . session_name() . "");
    }

    if (isset($_POST['nuevoCarrito'])) {
        header("Location: nuevo_carrito.php?usuario=" . session_name() . "");
    }

    if (isset($_POST['nuevoHistorial'])) {
        header("Location: nuevo_historial.php?usuario=" . session_name() . "");
    }
} catch (Exception $e) {
    die("Conexión fallida: " . $e->getMessage());
}


?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="bootStrap/js/bootstrap.min.js"></script>
    <script src="js/parteAdmin.js"></script>

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
            <!-- Cuerpo -->
            <div class="row">
                <div class="col-2 col-sm-2"> </div>
                <div class="col-9 col-sm-8"><br>
                    <h3>Administración</h3>
                    <div class="cuerpo">
                        <div class="row">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-usuarios-tab" data-toggle="pill" href="#pills-usuarios" role="tab" aria-controls="pills-usuarios" aria-selected="true">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-vuelos-tab" data-toggle="pill" href="#pills-vuelos" role="tab" aria-controls="pills-vuelos" aria-selected="false">Vuelos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-carrito-tab" data-toggle="pill" href="#pills-carrito" role="tab" aria-controls="pills-carrito" aria-selected="false">Carrito</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-historial-tab" data-toggle="pill" href="#pills-historial" role="tab" aria-controls="pills-historial" aria-selected="false">Historial</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-usuarios" role="tabpanel" aria-labelledby="pills-usuarios-tab"><br>
                                    <div class="col-12 ">

                                        <?php echo $usuarios; ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-vuelos" role="tabpanel" aria-labelledby="pills-vuelos-tab"><br>
                                    <div class="col-12 ">
                                        <?php echo $vuelos; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-carrito" role="tabpanel" aria-labelledby="pills-carrito-tab"><br>
                                    <div class="col-12 ">
                                        <?php echo $carrito; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-historial" role="tabpanel" aria-labelledby="pills-historial-tab"><br>
                                    <div class="col-12 ">
                                        <?php echo $historial; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                ?>

                <div class="col-1 col-sm-2"></div>
            </div>



            <!-- Footer -->

            <div class="row footer">
                <div class="container-fluid text-center text-md-left col-xs-12" style="background-color: black; color:white">
                    <div class="row">
                        <div class="col-md-6 mt-md-0 mt-3" style="padding: 15px;">
                            <center>
                                <h6 class="text-uppercase">Porque reservar con ...</h6>
                            </center>
                            <p>En ... te llevamos a más de 130 destinos de las principales ciudades de España,
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