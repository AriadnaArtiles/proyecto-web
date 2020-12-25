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

        .logo {
            position: relative;
            height: 75px;
        }


        select {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }

        table {
            width: 650px;
            font-size: 14px;
        }

        .footer {
            /* position: relative; */
            bottom: 0px;
            max-height: 200px;
            width: 100%;
        }

        html {
            overflow-x: hidden;
        }

        p {
            padding: 10px;
        }

        .tituloh6 {
            padding: 19px;
        }


        .cuerpo {
            background-color: #F5F5F4;
            min-height: 360px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        button[type='submit'] {
            border: none;
            outline: none;
            height: 35px;
            background: #FF8C8C;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
        }

        button[type='submit']:hover {
            cursor: pointer;
            background: #FEABAB;
            color: #000;
        }
    </style>

    <script language="JavaScript" type="text/javascript">
        function generar(seleccionados) {
            var xhr = new XMLHttpRequest();
            // función JavaScript que se ejecutará al recibir la respuesta PHP del server:
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabla").innerHTML = '<h1>' + this.responseText + '</h1>';
                }
            };
            xhr.open("POST", "ajax.php", true); // URL con parámetros
            //va si o si porque es por post
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var seleccion = "seleccionados=" + seleccionados.value;
            xhr.send(seleccion);
        }
    </script>
</head>

<?php

$aux = $_GET['usuario'];
session_name($aux);
session_start();

$_SESSION['usuario'] = $_GET['usuario'];

try {
    function select()
    {
        $base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT DISTINCT pais FROM vuelos;";
        $sentencia = $base->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();
        echo "<select name='select' onChange=generar(this)>";

        foreach ($registros as $registro) {
            echo "<option value='" . $registro['pais'] . "'>" . $registro['pais'] . "</option>";
        }
        echo "</select>";
    }

    if (isset($_POST['comprar'])) {
        $base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $encontrarId = false;
        $sqlCarrito = "SELECT * FROM carrito where id=" . $_POST['comprar'] . ";";
        $sentencia = $base->prepare($sqlCarrito);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();

        $sqlVuelos = "SELECT * FROM vuelos where id=" . $_POST['comprar'] . ";";
        $sentenciaVuelos = $base->prepare($sqlVuelos);
        $sentenciaVuelos->execute();
        $resultadoVuelos = $sentenciaVuelos->setFetchMode(PDO::FETCH_ASSOC);
        $registrosVuelos = $sentenciaVuelos->fetchAll();

        $cantidad = 1;
        foreach ($registros as $registro) {
            if ($registro['id'] == $_POST['comprar']) {
                $encontrarId = true;
                $cantidad = $registro['cantidad'];
            }
        }
        if ($encontrarId == false) {
            foreach ($registrosVuelos as $regis) {
                $insertar = "INSERT INTO carrito (id,cantidad, usuarioCarrito,pais,clase,precio,fecha_ida,fecha_vuelta,compania,codigo)
                    VALUES (" . $_POST['comprar'] . "," . $cantidad . ",'" . $_SESSION['usuario'] . "','" . $regis['pais'] . "','"
                    . $regis['clase'] . "','" . $regis['precio'] . "','" . $regis['fecha_ida'] . "','" . $regis['fecha_vuelta'] . "','"
                    . $regis['compania'] . "','" . $regis['codigo'] . "');";
                $sentencia = $base->prepare($insertar);
                $sentencia->execute();
            }
        } else {
            $cantidad += 1;
            foreach ($registros as $regis) {
                $actualizar = "UPDATE carrito SET cantidad =" . $cantidad . " WHERE id=" . $_POST['comprar'] . ";";
                $sentencia = $base->prepare($actualizar);
                $sentencia->execute();
            }
        }
    }
} catch (Exception $e) {
    die("Conexión fallida: " . $e->getMessage());
}

if (isset($_POST['comprar'])) {
    header('Location:compra.php?usuario=' . session_name());
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



                <h5> <?php echo "Bienvenido a tu cuenta " . session_name(); ?></h5>


                <div class="collapse navbar-collapse  submenu" id="opciones">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="compra.php?usuario=<?php echo session_name(); ?>">Ver carrito</a></li>
                        <li class="nav-item"><a class="nav-link" href="perfil.php?usuario=<?php echo session_name(); ?>">Ver perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesion</a></li>
                    </ul>

                </div>
            </nav>

            <div class="row">
                <div class="col-2 col-sm-2"> </div>
                <div class="col-9 col-sm-8"><br>
                    <h3>Haz tu reserva ya</h3>
                    <div class=" cuerpo">
                        <center>
                            <h6 class="tituloh6"><b>Encuentra vuelos baratos entre más de 600.000 destinos... ¡Haz las maletas! </b></h6>
                            <!-- <hr class="my-4"> -->
                            <b class="tituloh6">¿A que estas esperando? </b>
                        </center>
                        <div class="row">
                            <div class="col-2"> </div>
                            <div class="col-9"><br>
                                <div class="row">
                                    <div class="col-12  col-md-6">
                                        Elija el destino que desee:
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <?php
                                        select();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-1 col-sm-2"> </div>
                            <div class="col-10 col-sm-8"><br>

                                <div id="tabla"> </div>
                            </div>
                            <div class="col-1 col-sm-2"></div>

                        </div>




                    </div>



                </div>


                <div class="col-1 col-sm-2"></div>
            </div>














            <!-- --------------------------------------- -->

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