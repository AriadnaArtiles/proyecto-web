<html>

<head>
    <link href="bootStrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        .parrafo {
            text-align: center;
            font-style: italic;
        }

        .login-box input {
            width: 100%;
            margin-bottom: 20px;
        }

        .login-box input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: #FF6767;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
        }

        .login-box input[type="password"],
        .login-box input[type="text"] {
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            outline: none;
            height: 40px;
            color: black;
            font-size: 16px;
            padding: 2px;
        }

        .login-box input[type="submit"]:hover {
            cursor: pointer;
            background: #FC9595;
            color: #000;
        }

        .divCabecera {
            background-color: #FD4F4F;
            /* FC9595 */
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

        html {
            overflow-x: hidden;
        }

        .cuerpo {
            background-color: #F5F5F4;
            min-height: 200px;
            border-radius: 15px;
            padding: 40px 30px;
        }

        td {
            padding: 2px;
        }
    </style>
</head>
<?php

$usuario = "";
$contrasena = "";

if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
}

$base = new PDO("mysql:host=localhost; dbname=vuelosviajes", "root", "");

try {
    $resultado = "";
    if (isset($_POST['enviar'])) {
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios WHERE nombre= :usuario AND contrasena= :contrasena";
        $resultado = $base->prepare($sql);
        $usuario = htmlentities(addslashes($usuario));
        $contrasena = htmlentities(addslashes($contrasena));
        $resultado->bindValue(":usuario", $usuario);
        $resultado->bindValue(":contrasena", $contrasena);
        $resultado->execute();
        $numero_registro = $resultado->rowCount();
        if ($numero_registro == 1) {
            $valor = $_POST['usuario'];
            setcookie('recordarUsuario', $valor, time() + 3600);

            if ($usuario == 'ariadna') {
                header("Location: parteAdmin.php?usuario=$usuario");
            } else {
                header("Location: vuelos.php?usuario=$usuario");
            }
        } else {
            $resultado = "<p class='parrafo'>La contraseña y el usuario son incorrectos</p>";
        }
    }


    if (isset($_POST['registrarse'])) {
        header('location: registrarse.php');
    }
} catch (Exception $e) {
    die("Conexión fallida: " . $e->getMessage());
}

$base = null;

?>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="bootStrap/js/bootstrap.min.js"></script>

    <script src="js/login.js"></script>
    <div class="contenedor">
        <div class="container-fluid divCabecera">
            <nav class="navbar navbar-expand-sm navbar-light ">
                <a href="index.php" class="navbar-brand"><img src="img/logo.png" width="60px" height="60px"></a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#opciones">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  submenu" id="opciones">
                    <ul class="navbar-nav ">
                        <li>
                            <h2>Bienvenido</h2>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="check-in.php">Informacion de check-in</a></li>
                        <li class="nav-item"><a class="nav-link" href="buscaVuelo.php">Pasajeros con necesidades especiales</a></li>
                        <li class="nav-item"><a class="nav-link" href="otros.php">Otros servicios</a></li>
                    </ul>
                </div>
            </nav>
            <div class="row">
                <div class="col-2 col-sm-2 col-md-3  col-lg-4"> </div>
                <div class="col-8 col-sm-8 col-md-6  col-lg-4">
                    <br>
                    <h3>Entrar</h3>
                    <div class=" cuerpo">
                        <div class="login-box">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="formulario" id="formulario">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        Nombre del usuario:
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="text" name="usuario" required pattern="[A-Za-z]{2,15}" value="<?php if (isset($_COOKIE['recordarUsuario'])) {
                                                                                                                        echo $_COOKIE['recordarUsuario'];
                                                                                                                    } ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        Contraseña:
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="password" name="contrasena" required>
                                    </div>
                                </div>
                                <input type="submit" name="enviar" id="enviar" value="Enviar">
                            </form>
                            <hr>
                            <form action="" method="post">
                                <input type="submit" name="registrarse" value="Registrarse">
                            </form>
                            <?php echo $resultado; ?>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-sm-2 col-md-3 col-lg-4"> </div>
            </div>
            <br>
            <!-- ---------------------------------- -->
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