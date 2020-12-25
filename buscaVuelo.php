<!DOCTYPE html>
<html>

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html {
            overflow-x: hidden;
        }

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
            min-height: 500px;
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


                    <h3> Pasajeros con necesidades especiales</h3>
                    <p>Porque queremos ofrecerte el mejor servicio durante tu viaje, te ponemos todas las facilidades.</p>
                    <div class="alert alert-secondary" role="alert">
                        <h4>¿Quién puede solicitar el servicio de asistencia en el aeropuerto?</h4>
                    </div>
                    <ul>
                        <li>Pasajeros que viajen en silla de ruedas</li>
                        <li>Pasajeros con dificultades de visión y/o auditiva</li>
                        <li>Pasajeros con extremidades escayoladas</li>
                        <li>Pasajeros con discapacidad intelectual</li>
                    </ul>
                    <h5>¿Cómo solicito el servicio de asistencia?</h5>
                    <p>Dependiendo de cuánto tiempo quede para la salida del vuelo, puedes solicitar tu asistencia a través de un canal u otro.</p>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card" style="margin:2px; min-height:230px">
                                <div class="card-body">
                                    <h5 class="card-title">Más de 48 horas para la salida del vuelo</h5>
                                    <hr>
                                    <p class="card-text">A través de nuestra web, durante la reserva del vuelo podrás indicar tu tipo de necesidad especial. Te enviaremos la confirmación de solicitud de asistencia tras finalizar.</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-12  col-lg-4">
                            <div class="card" style="margin:2px; min-height:230px">
                                <div class="card-body">
                                    <h5 class="card-title">Menos de 48 horas para la salida del vuelo</h5>
                                    <hr>
                                    <p class="card-text">Llamando a nuestro Centro de atención al cliente. Tras la llamada, te enviaremos la confirmación de tu asistencia.</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card" style="margin:2px; min-height:230px">
                                <div class="card-body">
                                    <h5 class="card-title">Menos de 24 horas para la salida del vuelo</h5>
                                    <hr>
                                    <p class="card-text">Ponte en contacto directamente con el aeropuerto para solicitar el servicio. Ellos mismos te enviarán la confirmación.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="alert alert-info" role="alert">
                        El número de personas con necesidades especiales que pueden viajar en un vuelo es limitado. Lo mejor es que hagas tu reserva cuanto antes para asegurar tu plaza en el vuelo que deseas.
                    </div>
                    <h5>¿Qué tengo que hacer el día del vuelo?</h5>
                    <p>Dirígete al punto de encuentro del aeropuerto dos horas antes de la salida del vuelo. Te recomendamos que te pongas en contacto con el aeropuerto unos días antes para fijar una hora para el encuentro. Si no lo has hecho, puedes usar el interfono que encontrarás en el punto de encuentro y el personal del aeropuerto vendrá a buscarte. También puedes acudir directamente a los mostradores de facturación de Vueling, y nosotros nos encargaremos de avisar al servicio de asistencia por ti. El personal de asistencia del aeropuerto te acompañará en todo momento: desde el check-in en el mostrador de facturación hasta tu asiento en el avión.</p>
                    <p>También puedes acudir directamente a los mostradores de facturación de Vueling, y nosotros nos encargaremos de avisar al servicio de asistencia por ti.</p>
                    <p>El personal de asistencia del aeropuerto te acompañará en todo momento: desde el check-in en el mostrador de facturación hasta tu asiento en el avión.

                    </p>
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