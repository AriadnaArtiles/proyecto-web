
<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mysqli = new mysqli('localhost', 'root', '', 'vuelosviajes');
    if ($mysqli->connect_error) {
        die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    $seleccionado = $_POST['seleccionados'];
    if ($resultado = $mysqli->query("SELECT * FROM vuelos")) {
        echo " <div class='table-responsive-lg'>    <table  class='table table-hover'>
        <tr><td colspan='3'><h4>" . $seleccionado . "</h4></td><td></td><td></td><td></td><td></td></tr>";
        echo "<tr><th>Compañia</th><th>Codigo</th><th>Clase</th> <th>Precio</th> <th>Fecha ida</th> <th>Fecha vuelta</th><th></th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            if ($fila['pais'] == $seleccionado) {
                echo "<tr>";
                echo "<td>" . $fila['compania'] . "</td>";
                echo "<td>" . $fila['codigo'] . "</td>";
                echo "<td>" . $fila['clase'] . "</td>";
                echo "<td>" . $fila['precio'] .  "</td>";
                echo "<td>" . $fila['fecha_ida'] . "</td>";
                echo "<td>" . $fila['fecha_vuelta'] . "</td>";
                echo "<td><form method='post'><button name='comprar' type='submit' value='" . $fila['id'] . "'>Comprar</button></form>";
                echo "</tr>";
            }
        }
        echo "</table></div>";
    }
    $mysqli->close();
}


?>
