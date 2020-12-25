<!DOCTYPE html>
<html lang="en">

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .divCabecera {
            background-color: #FD4F4F;
            width: 100%;
            height: 75px;
            margin: auto;
        }

        .logo {
            position: relative;
            height: 75px;
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
            position: relative;
            width: 250px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        div.container {
            padding: 10px;
        }

        #body {
            margin: auto;
            margin-top: 60px;
            width: 900px;
            height: 300px;
        }

        .footer {
            position: relative;
            bottom: 0px;
            max-height: 200px;
            width: 100%;
        }

        p {
            padding: 10px;
        }

        .cuerpo {
            min-height: 270px;
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

        html {
            overflow-x: hidden;
        }

        input[type="submit"]:hover {
            cursor: pointer;
            background: #FC9595;
            color: #000;
        }
    </style>
    </style>
</head>

<?php
$aux = $_GET['usuario'];
session_name($aux);
session_start();

if (isset($_POST['volver'])) {
    header("Location:vuelos.php?usuario=" . session_name() . "");
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

            <br>
            <br>



            <center>
                <h1>Su compra se ha realizado correctamente</h1>
                <form action="" method="post">
                    <input type="submit" name="volver" value="Volver a la tienda">
                </form>
            </center>


            <div class="cuerpo">

                <div class="row cuerpo" align="center">
                    <div class="col-md-4">
                        <div class="polaroid">
                            <img src="img/madrid.jpg" alt="Madrid" style="width:100%; height:150px;">

                            <p class="nombre">Madrid</p>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="polaroid">
                            <img src="img/hawaii.jpg" alt="Hawaii" style="width:100%; height:150px;">

                            <p class="nombre">Hawaii</p>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="polaroid">
                            <img src="img/londres.jpg" alt="Londres" style="width:100% ; height:150px;">

                            <p class="nombre">Londres</p>

                        </div>
                    </div>

                </div>
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