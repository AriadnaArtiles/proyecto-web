<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .divCabecera {
            background-color: #FD4F4F;
            /* FC9595 */
            width: 100%;
            height: 75px;
            margin: auto;
        }

        p {
            padding: 10px;
        }

        .footer {
            /* position: absolute; */
            bottom: 0;
            max-height: 200px;
            width: 100%;
        }

        .cuerpo {
            background-color: #F5F5F4;
            min-height: 400px;
            border-radius: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }

        input[type="password"],
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            outline: none;
            height: 40px;
            color: black;
            font-size: 16px;
            padding: 2px;
        }

        html {
            overflow-x: hidden;
        }

        input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: #FF6767;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            width: 120px;
        }

        input[type="submit"]:hover {
            cursor: pointer;
            background: #FC9595;
            color: #000;
        }

        .aviso {
            color: #FF6767
        }
    </style>
</head>

<?php

$aux = $_GET['usuario'];
session_name($aux);
session_start();

if (isset($_POST['volver'])) {
    header('Location:parteAdmin.php?usuario=' . session_name() . '');
}

// validacion

$resultado = "";

if (isset($_POST['enviar'])) {

    $conexion = new mysqli('localhost', 'root', '', 'vuelosviajes');
    $consulta = $conexion->stmt_init();
    $consulta->prepare('INSERT INTO carrito ( cantidad,usuarioCarrito, pais, clase, precio, fecha_ida, fecha_vuelta, compania,codigo) VALUES(?,?,?,?,?,?,?,?,?)');

    $error = "";

    $cantidad = "";
    $usuarioCarrito = "";
    $compania = "";
    $pais = "";
    $codigo = "";
    $precio = "";
    $clase = "";
    $fecha_ida = "";
    $fecha_vuelta = "";

    $validacion_cantidad = $validacion_usuarioCarrito = $validacion_compania = $validacion_pais = $validacion_codigo = $validacion_precio = $validacion_clase = $validacion_fecha_ida = $validacion_fecha_vuelta = false;



    if (empty($_POST['nombreUsuario'])) {
        $error .= "Se debe introducir el nombre<br>";
        $validacion_usuarioCarrito = false;
    } else {
        if (preg_match('/[0-9]/', $_POST['nombreUsuario'])) { //ctype_alpha()
            $error .= "No Se debe introducir numero en el nombre<br>";
            $validacion_usuarioCarrito = false;
        } else {
            $usuarioCarrito = $_POST['nombreUsuario'];
            $validacion_usuarioCarrito = true;
        }
    }


    if (empty($_POST['compania'])) {
        $error .= "Se debe introducir la compañia<br>";
        $validacion_compania = false;
    } else {
        $compania = $_POST['compania'];
        $validacion_compania = true;
    }

    if (empty($_POST['codigo'])) {
        $error .= "Se debe introducir el codigo<br>";
        $validacion_codigo = false;
    } else {
        $codigo = $_POST['codigo'];
        $validacion_codigo = true;
    }

    if (empty($_POST['pais'])) {
        $error .= "Se deben introducir el pais<br>";
        $validacion_pais = false;
    } else {
        if (preg_match('/[0-9]/', $_POST['pais'])) {
            $error .= "No Se debe introducir numeros en el pais<br>";
            $validacion_pais = false;
        } else {
            $pais = $_POST['pais'];
            $validacion_pais = true;
        }
    }

    if (empty($_POST['clase'])) {
        $error .= "Se deben introducir la clase<br>";
        $validacion_clase = false;
    } else {
        if (preg_match('/[0-9]/', $_POST['clase'])) {
            $error .= "No Se debe introducir numeros en la clase<br>";
            $validacion_clase = false;
        } else {
            $clase = $_POST['clase'];
            $validacion_clase = true;
        }
    }

    if (empty($_POST['precio'])) {
        $error .= "Se debe introducir el precio<br>";
        $validacion_precio = false;
    } else {
        if (preg_match('/^([0-9])*$/', $_POST['precio'])) {
            $precio = $_POST['precio'];
            $validacion_precio = true;
        } else {
            $error .= "Solo se permiten introducir numeros en el precio<br>";
            $validacion_precio = false;
        }
    }

    if (empty($_POST['fecha_ida'])) {
        $error .= "Se debe introducir la fecha de ida<br>";
        $validacion_fecha_ida = false;
    } else {
        $fecha_ida = $_POST['fecha_ida'];
        $validacion_fecha_ida = true;
    }

    if (empty($_POST['fecha_vuelta'])) {
        $error .= "Se debe introducir la fecha de vuelta<br>";
        $validacion_fecha_vuelta = false;
    } else {
        $fecha_vuelta = $_POST['fecha_vuelta'];
        $validacion_fecha_vuelta = true;
    }

    if (empty($_POST['cantidad'])) {
        $error .= "Se debe introducir la cantidad, no es posible introducir 0<br>";
        $validacion_cantidad = false;
    } else {
        if ($_POST['cantidad'] <= 0) {
            $error .= "La cantidad no puede ser menor o igual a cero<br>";
            $validacion_cantidad = false;
        } else {
            $cantidad = $_POST['cantidad'];
            $validacion_cantidad = true;
        }
    }

    if ($error != "") {
        $resultado = "<div class='alert alert-danger' role='alert'>" . $error . " </div>";
    }

    if ($validacion_usuarioCarrito == true && $validacion_cantidad == true && $validacion_compania == true && $validacion_pais == true && $validacion_codigo == true && $validacion_clase == true && $validacion_precio == true && $validacion_fecha_ida == true && $validacion_fecha_vuelta == true) {
        $consulta->bind_param('issssssss', $cantidad, $usuarioCarrito, $pais, $clase, $precio, $fecha_ida, $fecha_vuelta, $compania, $codigo);

        $consulta->execute();
        $consulta->close();
        $conexion->close();
        header('Location:parteAdmin.php?usuario=' . session_name() . '');
    }
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
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-2 col-sm-2"> </div>
        <div class="col-9 col-sm-8"><br>
            <h3>Nuevo Carrito</h3>
            <div class="cuerpo">
                <div class="row"><br>
                    <div class="col-2"> </div>
                    <div class="col-9"><br>

                        <?php echo $resultado; ?>
                        <p class="aviso">Todos los campos son obligatorios</p>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Nombre del usuario
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="nombreUsuario" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Compañia
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="compania" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Codigo
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="codigo" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Pais
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="pais" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Clase
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="clase" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Precio
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="precio" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Fecha ida
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="date" name="fecha_ida" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Fecha vuelta
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="date" name="fecha_vuelta" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Cantidad
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="number" name="cantidad" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    <br>
                                    <input type="submit" name="volver" value="Volver">
                                </div>
                                <div class="col-12 col-md-6">
                                    <br>
                                    <input type="submit" name="enviar" value="Insertar">
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

</body>

<?php

?>

</html>