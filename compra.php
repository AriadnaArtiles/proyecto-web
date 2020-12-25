<html>

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>
    h2 {
        font-family: 'Pacifico', cursive;
        text-align: center;
        color: #5638D7;
    }

    table {
        width: 750px;
        font-size: 14px;

    }

    .divCabecera {
        background-color: #FD4F4F;
        /* FC9595 */
        width: 100%;
        height: 75px;
        margin: auto;
    }

    .footer {
        /* position: relative; */
        bottom: 0px;
        max-height: 200px;
        width: 100%;
    }

    .cuerpo {
        background-color: #F5F5F4;
        min-height: 385px;
        border-radius: 15px;
        margin-bottom: 20px;
    }

    html {
        overflow-x: hidden;
    }

    button[class='colorBtn1'] {
        border: none;
        outline: none;
        height: 30px;
        background: #FF8C8C;
        color: #fff;
        font-size: 18px;
        border-radius: 20px;
    }

    button[class='colorBtn1']:hover {
        cursor: pointer;
        background: #FEABAB;
        color: #000;
    }

    button[class='colorBtn2'] {
        border: none;
        outline: none;
        height: 35px;
        background: #FF6767;
        color: #fff;
        font-size: 18px;
        border-radius: 20px;
        margin: 3px;
    }

    button[class='colorBtn2']:hover {
        cursor: pointer;
        background: #FC9595;
        color: #000;
    }
</style>
<?php
$aux = $_GET['usuario'];
session_name($aux);
session_start();

try {
    $base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM carrito where usuarioCarrito ='" . $aux . "'";
    $sentencia = $base->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
    $registros = $sentencia->fetchAll();
    $tabla = " <div class='table-responsive-lg'><table class='table table-hover'><tr><th>Compañia</th><th>Codigo
    </th><th>Pais</th><th>Clase</th><th>Precio</th><th>Fecha ida</th>
    <th>Fecha vuelta</th><th>Cantidad</th><th></th><th></th><th></th></tr>";
    foreach ($registros as $registro) {
        $tabla .= "<tr>";
        $tabla .= "<td>" . $registro['compania'] . "</td>";
        $tabla .= "<td>" . $registro['codigo'] . "</td>";
        $tabla .= "<td>" . $registro['pais'] . "</td>";
        $tabla .= "<td>" . $registro['clase'] . "</td>";
        $tabla .= "<td>" . ($registro['precio'] * $registro['cantidad']) .  " €</td>";
        $tabla .= "<td>" . $registro['fecha_ida'] .  "</td>";
        $tabla .= "<td>" . $registro['fecha_vuelta'] . "</td>";
        $tabla .= "<td>" . $registro['cantidad'] . "<br>";
        $tabla .= "</td>";
        $tabla .= "<td>";

        $tabla .= "<form action=''method='POST'>";
        $tabla .= "<button name='incrementar' class='colorBtn1' type='submit' value='" . $registro['id'] . "'>+</button>";
        $tabla .= "</form>";
        $tabla .= "</td>";
        $tabla .= "<td>";

        $tabla .= "<form action=''method='POST'>";
        $tabla .= "<button name='decrementar' class='colorBtn1' type='submit' value='" . $registro['id'] . "'>-</button>";
        $tabla .= "</form>";
        $tabla .= "</td>";
        $tabla .= "<td>";

        $tabla .= "<form action=''method='POST'>";
        $tabla .= "<button class='colorBtn1' name='boton' type='submit' value='" . $registro['id'] . "'>Eliminar </button>";
        $tabla .= "</form>";
        $tabla .= "</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</table></div>";

    $encontrarId = false;
    $incrementar = 0;
    $decrementar = 0;

    if (isset($_POST['incrementar'])) {
        $incrementar = $_POST['incrementar'];
    }
    if (isset($_POST['decrementar'])) {
        $decrementar = $_POST['decrementar'];
    }

    $cantidad = 1;

    foreach ($registros as $registro) {
        if ($registro['id'] == $incrementar || $registro['id'] == $decrementar) {
            $encontrarId = true;
            $cantidad = $registro['cantidad'];
        }
    }

    if ($encontrarId) {
        if (isset($_POST['incrementar'])) {
            $incrementarCantidad = $cantidad + 1;
            $actualizarCarrito = "UPDATE carrito SET cantidad =" . $incrementarCantidad . "
                 WHERE id=" . $_POST['incrementar'] . ";";
            $sentencia = $base->prepare($actualizarCarrito);
            $sentencia->execute();
            header("Location: compra.php?usuario=" . session_name() . "");
        } else if (isset($_POST['decrementar'])) {
            $decrementarCantidad = $cantidad - 1;
            if ($decrementarCantidad >= 1) {
                $actualizarCarrito = "UPDATE carrito SET cantidad =" . $decrementarCantidad . " 
                    WHERE id=" . $_POST['decrementar'] . ";";
                $sentencia = $base->prepare($actualizarCarrito);
                $sentencia->execute();
                header("Location: compra.php?usuario=" . session_name() . "");
            } else {
                $cantidad = 1;
            }
        }
    }

    if (isset($_POST['boton'])) {
        $sql2 = "SELECT * FROM carrito where id=" . $_POST['boton'] . "";
        $sentencia = $base->prepare($sql2);
        $sentencia->execute();
        $resultado = $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $registros = $sentencia->fetchAll();

        foreach ($registros as $registro) {
            if ($registro['id'] == $_POST['boton']) {
                $eliminar = "DELETE FROM carrito WHERE id=" . $_POST['boton'] . ";";
                $sentencia = $base->prepare($eliminar);
                $sentencia->execute();
                header("Location: compra.php?usuario=" . session_name() . "");
            }
        }
    }

    if (isset($_POST['borrar'])) {
        $borrar = "DELETE FROM carrito where true;";
        $sentencia = $base->prepare($borrar);
        $sentencia->execute();
        header("Location: vuelos.php?usuario=" . session_name() . "");
    }

    if (isset($_POST['comprar'])) {
        $dia =  date('d');
        $mes = date('m');
        $year = date('Y');
        $fecha = $year . "-" . $mes . "-" . $dia;
        foreach ($registros as $registro) {
            $insertarDelCarrito = "INSERT INTO historial (nombreUsuario, codigo,fecha) 
                VALUES ('" . session_name() . "','" . $registro["codigo"] . "','" . $fecha . "')";
            $sentencia = $base->prepare($insertarDelCarrito);
            $sentencia->execute();

            $eliminarDelCarrito = "DELETE FROM carrito WHERE usuarioCarrito='" . session_name() . "';";
            $sentencia = $base->prepare($eliminarDelCarrito);
            $sentencia->execute();
        }
        header("Location: gracias.php?usuario=" . session_name() . "");
    }

    if (isset($_POST['volver'])) {
        header("Location: vuelos.php?usuario=" . session_name() . "");
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
                    <ul class="navbar-nav  ml-auto">

                        <li class="nav-item"><a class="nav-link" href="perfil.php?usuario=<?php echo session_name(); ?>">Ver perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesion</a></li>

                    </ul>
                </div>
            </nav>
            <div class="row">
                <div class="col-2 col-sm-2"> </div>
                <div class="col-9 col-sm-8"><br>
                    <h3>Su carrito</h3>
                    <div class=" cuerpo">
                        <div class="row">
                            <div class="col-1"> </div>
                            <div class="col-9"><br>
                                <div class="row">
                                    <div class="col-12 ">
                                        <?php echo $tabla; ?>
                                    </div>
                                </div>
                                <center>
                                    <form action="<?php echo 'compra.php?usuario=' . session_name(); ?>" method="POST">
                                        <div class="row">


                                            <div class="col-2"></div>
                                            <div class="col-12 col-lg-4">
                                                <button name='borrar' class="colorBtn2" type='submit' value="">Borrar carrito</button>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <button name='volver' class="colorBtn2" type='submit' value="">Volver a la tienda</button>
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <button name='comprar' class="colorBtn2" type='submit' value="">Comprar</button>
                                            </div>


                                        </div>

                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 col-sm-2"></div>
            </div>
            <!-- ----------------------------- -->


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