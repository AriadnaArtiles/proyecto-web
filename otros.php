<!DOCTYPE html>
<html>

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .divCabecera {
            background-color: #FD4F4F;
            /* FC9595 */
            width: 100%;
            height: 75px;
            margin: auto;
        }

        html {
            overflow-x: hidden;
        }

        p {
            padding: 10px;
        }

        .footer {
            bottom: 0px;
            max-height: 200px;
            width: 100%;
        }

        .icon {
            width: 20px;
            height: 40px;
            margin: 2px;
        }

        .logo {
            width: 90px;
            height: 90px;
        }

        .cuerpo {
            min-height: 320px;
            background-color: #F5F5F4;
            padding-right: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            padding-left: 15px;
            padding-top: 15px;
            padding-bottom: 20px;
        }
    </style>
</head>

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
            <div class="row">
                <div class="col-2 col-sm-2"> </div>
                <div class="col-9 col-sm-8"><br>
                    <h3>Otros servicios</h3>
                    <div class="cuerpo">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="card">
                                    <img class="card-img-top" src="img/candado.PNG" alt="Card image" height="200px">
                                    <div class="card-body">
                                        <center>
                                            <p class="card-text">Bloquea tu precio.</p>

                                            <button type="button" class="btn btn-primary btn-sm">Acceder</button>

                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="card">
                                    <img class="card-img-top" src="img/porcentaje.PNG" alt="Card image" height="200px">
                                    <div class="card-body">
                                        <center>
                                            <p class="card-text">Tus reservas My25%.</p>

                                            <button type="button" class="btn btn-primary btn-sm">Acceder</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="card">
                                    <img class="card-img-top" src="img/escribe.jpg" alt="Card image" height="200px">
                                    <div class="card-body">
                                        <center>
                                            <p class="card-text">Factura de servicios</p>

                                            <button type="button" class="btn btn-primary btn-sm">Acceder</button>
                                        </center>
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