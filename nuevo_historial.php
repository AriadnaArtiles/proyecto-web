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
    $consulta->prepare('INSERT INTO historial  (nombreUsuario,codigo, fecha) VALUES(?,?,?)');

    $error = "";

    $nombreUsuario = "";
    $codigo = "";
    $fecha = "";

    $validacion_nombreUsuario = $validacion_codigo = $validacion_fecha = false;

    if (empty($_POST['nombreUsuario'])) {
        $error .= "Se debe introducir el nombre<br>";
        $validacion_nombreUsuario = false;
    } else {
        if (preg_match('/[0-9]/', $_POST['nombreUsuario'])) { //ctype_alpha()
            $error .= "No Se debe introducir numero en el nombre<br>";
            $validacion_nombreUsuario = false;
        } else {
            $nombreUsuario = $_POST['nombreUsuario'];
            $validacion_nombreUsuario = true;
        }
    }


    if (empty($_POST['codigo'])) {
        $error .= "Se debe introducir el codigo<br>";
        $validacion_codigo = false;
    } else {
        $codigo = $_POST['codigo'];
        $validacion_codigo = true;
    }

    if (empty($_POST['fecha'])) {
        $error .= "Se debe introducir la fecha <br>";
        $validacion_fecha = false;
    } else {
        $fecha = $_POST['fecha'];
        $validacion_fecha = true;
    }



    if ($error != "") {
        $resultado = "<div class='alert alert-danger' role='alert'>" . $error . " </div>";
    }

    if ($validacion_nombreUsuario == true && $validacion_codigo == true  && $validacion_fecha == true) {
        $consulta->bind_param('sss',  $nombreUsuario, $codigo,  $fecha);

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
            <h3>Nuevo Historial</h3>
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
                                    Codigo
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="codigo" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12  col-md-6">
                                    Fecha en la se realiazo la compra
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="date" name="fecha" value="">
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