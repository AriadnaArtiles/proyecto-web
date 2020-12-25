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

        .submit {
            border: none;
            outline: none;
            height: 40px;
            background: #FF6767;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            width: 120px;
        }

        .submit:hover {
            cursor: pointer;
            background: #FC9595;
            color: #000;
        }

        .card {
            min-width: 250px;
        }

        input[type="password"],
        input[type="text"] {
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            outline: none;
            height: 40px;
            color: black;
            font-size: 16px;
            padding: 2px;
        }

        .aviso {
            color: #FF6767
        }

        html {
            overflow-x: hidden;
        }

        .btn-light:hover {
            background-color: #FFB0B0;
        }
    </style>
</head>

<?php

$aux = $_GET['usuario'];
session_name($aux);
session_start();

$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['volver'])) {
    header('Location:perfil.php?usuario=' . session_name() . '');
}

$mysqli = new mysqli('localhost', 'root', '', 'vuelosviajes');
if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$nombre_selec = "";
$apellidos_selec = "";
$correo_selec = "";
$telefono_selec = "";
$contrasena_selec = "";
$repetida_selec = "";
if ($resultado = $mysqli->query('SELECT * FROM usuarios WHERE id="' . $id . '"')) {
    while ($fila = $resultado->fetch_assoc()) {
        $nombre_selec = $fila['nombre'];
        $apellidos_selec = $fila['apellidos'];
        $correo_selec = $fila['correo'];
        $telefono_selec = $fila['telefono'];
        $contrasena_selec = $fila['contrasena'];
        $repetida_selec = $fila['repetida'];
    }
}

$resultadoError = "";

if (isset($_POST['enviar'])) {
    $conexion = new mysqli('localhost', 'root', '', 'vuelosviajes');
    $consulta = $conexion->stmt_init();
    $consulta->prepare('UPDATE usuarios SET nombre=?, contrasena=?, apellidos=?, correo=?, telefono=?, repetida=? 
    WHERE id=?');

    $error = "";
    $nombre = "";
    $apellidos = "";
    $correo = "";
    $telefono = "";
    $contrasena = "";
    $repatida = "";

    $validacion_nombre = $validacion_apellidos = $validacion_correo = $validacion_telefono =
        $validacion_contrasena = $validacion_repetida = false;

    if (empty($_POST['nombre'])) {
        $error .= "Se debe introducir el nombre<br>";
        $validacion_nombre = false;
    } else {
        if (preg_match('/[0-9]/', $_POST['nombre'])) { //ctype_alpha()
            $error .= "No Se debe introducir numero en el nombre<br>";
            $validacion_nombre = false;
        } else {
            $nombre = $_POST['nombre'];
            $validacion_nombre = true;
        }
    }

    if (empty($_POST['apellidos'])) {
        $error .= "Se deben introducir los apellidos<br>";
        $validacion_apellidos = false;
    } else {
        if (preg_match('/[0-9]/', $_POST['apellidos'])) {
            $error .= "No Se debe introducir numeros en el Apellido<br>";
            $validacion_apellidos = false;
        } else {
            $apellidos = $_POST['apellidos'];
            $validacion_apellidos = true;
        }
    }

    if (empty($_POST['correo'])) {
        $error .= "Se debe introducir el correo electronico<br>";
        $validacion_correo = false;
    } else {
        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['correo'])) {
            $correo = $_POST['correo'];
            $validacion_correo = true;
        } else {
            $error .= "El corrreo electronico es incorrecto<br>";
            $validacion_correo = false;
        }
    }

    if (empty($_POST['telefono'])) {
        $error .= "Se debe introducir el telefono<br>";
        $validacion_telefono = false;
    } else {
        if (is_numeric($_POST['telefono'])) {
            $telefono = $_POST['telefono'];
            $validacion_telefono = true;
        } else {
            $error .= "No se permiten letras, Se debe introducir numeros en el campo telefono<br>";
            $validacion_telefono = false;
        }
    }

    if (empty($_POST['contrasena'])) {
        $error .= "Se debe introducir la contraseña<br>";
        $validacion_contrasena = false;
    } else {
        if (strlen($_POST['contrasena']) < 8) { //ctype_alpha() 
            $error .= "La contraseña debe tener mas de 8 caracteres<br>";
            $validacion_contrasena = false;
        } else {
            $contrasena = $_POST['contrasena'];
            $validacion_contrasena = true;
        }
    }
    if (empty($_POST['repetida'])) {
        $error .= "Se debe introducir la contraseña repetida<br>";
        $validacion_repetida = false;
    } else {
        if (strlen($_POST['repetida']) < 8) { //ctype_alpha() 
            $error .= "La contraseña repetida debe tener mas de 8 caracteres<br>";
            $validacion_repetida = false;
        } else {
            if ($contrasena != $_POST['repetida']) {
                $error .=  "La contraseña repetida debe ser igual que la contraseña<br>";
                $validacion_repetida = false;
            } else {
                $validacion_repetida = true;
                $repetida = $_POST['repetida'];
            }
        }
    }
    if ($error != "") {
        $resultadoError = "<div class='alert alert-danger' role='alert'>" . $error . " </div>";
    }

    if (
        $validacion_nombre == true && $validacion_apellidos == true && $validacion_correo == true &&
        $validacion_telefono == true && $validacion_contrasena == true && $validacion_repetida == true
    ) {
        $consulta->bind_param('sssssss', $nombre, $contrasena, $apellidos, $correo, $telefono, $repetida, $id);
        $consulta->execute();
        $consulta->close();
        $conexion->close();
        header('Location:perfil.php?usuario=' . session_name() . '');
    }
}

try {

    $base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlCarrito = "SELECT * FROM carrito WHERE usuarioCarrito='" . session_name() . "'";
    $sentencia = $base->prepare($sqlCarrito);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $row = $sentencia->rowCount();

    $carrito = "";
    if ($row != 0) {
        $carrito = "<div class='table-responsive-lg'><table class='table-sm'><tr><th>Compañia</th><th>Codigo</th>
        <th>Pais</th><th>Clase</th><th>Precio</th><th>Fecha ida</th><th>Fecha vuelta</th><th>Cantidad</th><th></th></tr>";
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
            $carrito .= "<td><button type='button submit' onclick='return deleteCarrito()' class='btn btn-light'
             name='borrarCarrito' value='" . $registro['id'] . "'>Borrar</button>";
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
                header('location: modificarPerfil.php?usuario=' . session_name() . '&id=' . $id . '');
            }
        }
    }
} catch (Exception $e) {
    die("Conexión fallida: " . $e->getMessage());
}


?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="bootStrap/js/bootstrap.min.js"></script>
    <script src="js/modificarPerfil.js"></script>

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
                    <h3>Editar Usuario</h3>
                    <div class="cuerpo">
                        <div class="row"><br>
                            <div class="col-2"> </div>
                            <div class="col-9"><br>

                                <?php echo $resultadoError;
                                ?>
                                <p class="aviso">Todos los campos son obligatorios</p>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            Nombre
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="nombre" value="<?php echo $nombre_selec; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            Apellidos
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="apellidos" value="<?php echo $apellidos_selec; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            Correo Electronico
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="correo" value="<?php echo $correo_selec; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            Telefono
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="telefono" value="<?php echo $telefono_selec; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            Contraseña
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="password" name="contrasena" value="<?php echo $contrasena_selec; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            Repetir contraseña
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="password" name="repetida" value="<?php echo $repetida_selec; ?>">
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 ">
                                            <div id="accordion">

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

                                                <div class="card ">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12  col-md-6">
                                            <br>
                                            <input type="submit" class="submit" name="volver" value="Volver">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <br>
                                            <input type="submit" class="submit" name="enviar" value="Modificar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-1"></div>
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