<?php
include("bbdd.php");
$conn = connect_database();
// Recuperar el tipo de componente de la URL
if(isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    
    // Realizar la consulta SQL dependiendo del tipo de componente
    switch($tipo) {
        case 'cpu':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN cpu c ON p.id_producto = c.id_producto";
            break;
        case 'ram':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN ram r ON p.id_producto = r.id_producto";
            break;
        case 'placa_base':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN placa_base pb ON p.id_producto = pb.id_producto";
            break;
        case 'tarjeta_grafica':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN tarjeta_grafica tg ON p.id_producto = tg.id_producto";
            break;
        case 'disco_duro':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN disco_duro d ON p.id_producto = d.id_producto";
            break;
        case 'fuente_alimentacion':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN fuente_alimentacion fa ON p.id_producto = fa.id_producto";
            break;
        case 'ventilador':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN ventilador v ON p.id_producto = v.id_producto";
            break;
        case 'caja':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN caja c ON p.id_producto = c.id_producto";
            break;
        case 'pantalla':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN pantalla pa ON p.id_producto = pa.id_producto";
            break;
        case 'teclado':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN teclado t ON p.id_producto = t.id_producto";
            break;
        case 'raton':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN raton r ON p.id_producto = r.id_producto";
            break;
        case 'cascos':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN cascos c ON p.id_producto = c.id_producto";
            break;
        case 'portatil':
            $sentencia = "SELECT p.nombre, p.imagen, p.disponible FROM producto p INNER JOIN portatil pr ON p.id_producto = pr.id_producto";
            break;
        default:
            echo "Tipo de componente no válido";
            return; // Salir de la función si el tipo de componente no es válido
    }

    $resultado = oci_parse($conn, $sentencia);
    oci_execute($resultado);
    
    // Almacenar los resultados en un array asociativo
    $componentes = array();
    while ($fila = oci_fetch_assoc($resultado)) {
        $componentes[] = $fila;
    }
    // Liberar los recursos
    oci_free_statement($resultado);
    oci_close($conn);

} else {
    echo "No se proporcionó el parámetro 'tipo' en la URL";
}



?>


<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" href="css/comun.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>
        <?php
            include "menu.php";
        ?>
        <script src="js/nav-script.js"></script>

        <section class="home">
            <div class="text">Busque entre los (aqui cossas de php) mas adecuados</div>
            
            <!-- El form oculto -->
            <?php
            include "formLogin.php";
            ?>

            <div class="container-galeria">
                <div class="search-box-galeria">
                    <i class="bx bx-search"></i>
                    <input type="text" placeholder="Busca tu componenete aqui">
                </div>
                <div class="images-galeria">
                    <?php
                    // Iterar sobre los resultados y generar el HTML dinámicamente
                    foreach ($componentes as $componente) {
			if ($componente['DISPONIBLE']==1) {
                        echo '<div class="image-box" data-name="' . $componente['NOMBRE'] . '">';
                        echo '<img src="img/' . $componente['IMAGEN'] . '" alt="">';
                        echo '<h6>' . $componente['NOMBRE'] . '</h6>';
                        echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>

        </section>
        <script src="js/form-script.js"></script>
        <script src="js/galeria-script.js"></script>
    </body>
</html>
