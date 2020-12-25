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
            /* position: absolute; */
            bottom: 0;
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
            min-height: 270px;
        }

        .contenedor2 {
            width: 100%;
            background-color: #FFF1F1;

        }

        .slider-contenedor {
            width: 100%;
            display: flex;
        }

        .contenido-slider {
            width: 100%;
            height: 600px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-shrink: 0;
        }

        .contenido-slider>img {
            width: 400px;
        }

        .contenido-slider>div {
            width: 40%;
        }

        .contenido-slider h2 {
            font-weight: 300;
            text-align: justify;
            line-height: 30px;
        }

        .contenido-slider a {
            border: none;
            outline: none;
            height: 33px;
            background: #FF6767;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 3px;
            text-decoration: none;
        }

        html {
            overflow-x: hidden;
        }

        @media screen and (max-width:600px) {
            .contenido-slider {
                flex-direction: column-reverse;
            }

            .contenido-slider>div {
                width: 80%;
            }

            .contenido-slider h2 {
                font-size: 23px;
            }
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

            <div class="cuerpo">
                <div class="row ">
                    <div class="divBienvenida">
                        <div class="centrado">
                            <h1 class="titulo">HAZ TU RESERVA YA</h1>
                        </div>
                        <div class="centrado">
                            <p align="center">Encuentra vuelos baratos entre más de 600.000 destinos... ¡Haz las maletas! </p>
                        </div>
                        <div class="centrado">
                            <p>¿A que estas esperando?</p>
                        </div>
                    </div>
                </div>
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
                <div class="row">
                    <div class="contenedor2">
                        <div class="slider-contenedor" id="slider-contenedor">
                            <section class="contenido-slider">
                                <div>
                                    <h2> Pasajeros con necesidades especiales</h2>
                                    <p>Porque queremos ofrecerte el mejor servicio durante tu viaje, te ponemos todas las facilidades.</p>
                                    <p>¿Quién puede solicitar el servicio de asistencia en el aeropuerto?</p>
                                    <a href="buscaVuelo.php">Informate</a>
                                </div>
                                <img src="svg/animacion.svg" alt="">
                            </section>
                            <section class="contenido-slider">
                                <div>
                                    <h2>Otros servicios</h2>
                                    <p>Te ofrecemos una gran variedad de servicios que pueden adaptarse a sus necidades perfectamente.</p>
                                    <a href="otros.php">Informate</a>
                                </div>
                                <img src="svg/animacion2.svg" alt="">
                            </section>
                            <section class="contenido-slider">
                                <div>
                                    <h2>Check-in online</h2>
                                    <p>Ahorra tiempo y evita colas en el aeropuerto</p>
                                    <p>El check-in online es el proceso mediante el cual obtienes la tarjeta de embarque y confirmas tu número de asiento a través de la web o el móvil.</p>
                                    <p>¿Cuándo puedo hacer el check-in online?</p>
                                    <a href="check-in.php">Informate</a>
                                </div>
                                <img src="svg/animacion3.svg" alt="">
                            </section>
                            <section class="contenido-slider">
                                <div>
                                    <h2> Pasajeros con necesidades especiales</h2>
                                    <p>Porque queremos ofrecerte el mejor servicio durante tu viaje, te ponemos todas las facilidades.</p>
                                    <p>¿Quién puede solicitar el servicio de asistencia en el aeropuerto?</p>
                                    <a href="buscaVuelo.php">Informate</a>
                                </div>
                                <img src="svg/animacion.svg" alt="">
                            </section>
                        </div>
                    </div>
                </div>
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
    <script src="js/index.js"></script>
</body>

</html>