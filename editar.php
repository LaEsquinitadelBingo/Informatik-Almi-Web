<?php
session_start();
include_once("bbdd.php");
session_abort();



if(isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
}


$conn = connect_database();


$id_proveedor = $_SESSION["id_usuario"];
$componentes = array();
// Recuperar el tipo de componente de la URL
if(isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    
    // Realizar la consulta SQL dependiendo del tipo de componente
    switch($tipo) {
        case 'cpu':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, c.id_cpu, c.frecuencia, c.consumo, c.nucleos
            FROM producto p
            INNER JOIN CPU c ON p.id_producto = c.id_producto";
            break;
        case 'ram':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, r.id_ram, r.tamano, r.frecuencia, r.generacion
            FROM producto p
            INNER JOIN ram r ON p.id_producto = r.id_producto";
            break;
        case 'placa_base':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, pl.id_placa_base, pl.tamano, pl.grafica
            FROM producto p
            INNER JOIN placa_base pl ON p.id_producto = pl.id_producto";
            break;
        case 'tarjeta_grafica':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, tg.id_tarjeta_grafica, tg.capacidad, tg.consumo, tg.puertos_video
            FROM producto p
            INNER JOIN tarjeta_grafica tg ON p.id_producto = tg.id_producto";
            break;
        case 'disco_duro':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, d.id_disco_duro, d.almacenamiento, d.velocidad, d.peso 
            FROM producto p
            INNER JOIN disco_duro d ON p.id_producto = d.id_producto";
            break;
        case 'fuente_alimentacion':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, f.id_fuente, f.capacidad, f.modular 
            FROM producto p
            INNER JOIN fuente_alimentacion f ON p.id_producto = f.id_producto";
            break;
        case 'ventilador':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, v.id_ventilador, v.tamano
            FROM producto p
            INNER JOIN ventilador v ON p.id_producto = v.id_producto";
            break;
        case 'caja':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, c.id_caja, c.dimension
            FROM producto p
            INNER JOIN caja c ON p.id_producto = c.id_producto";
            break;
        case 'pantalla':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, pa.id_pantalla, pa.dimension, pa.puertos_video, pa.tasa_refresco 
            FROM producto p
            INNER JOIN pantalla pa ON p.id_producto = pa.id_producto";
            break;
        case 'teclado':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, te.id_teclado, te.inalambrico, te.peso, te.distribucion
            FROM producto p
            INNER JOIN teclado te ON p.id_producto = te.id_producto";
            break;
        case 'raton':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, rt.id_raton, rt.inalambrico, rt.peso
            FROM producto p
            INNER JOIN raton rt ON p.id_producto = rt.id_producto";
            break;
        case 'cascos':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, c.id_cascos, c.inalambrico, c.cancelacion_ruido, c.microfono 
            FROM producto p
            INNER JOIN cascos c ON p.id_producto = c.id_producto";
            break;
        case 'portatil':
            $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, p.disponible, por.id_portatil, por.tamano, por.ram, por.grafica, por.procesador
            FROM producto p
            INNER JOIN portatil por ON p.id_producto = por.id_producto";
            break;
        default:
            echo "Tipo de componente no válido";
            return; // Salir de la función si el tipo de componente no es válido
    }
    if($_SESSION['usuario'] != "nek"){
        $sentencia = $sentencia . " where id_proveedor = $id_proveedor";
    }
    
    $resultado = oci_parse($conn, $sentencia);
    oci_execute($resultado);

    // Almacenar los resultados en un array asociativo
    while ($fila = oci_fetch_assoc($resultado)) {
        $componentes[] = $fila;
    }

    $columnas = oci_num_fields($resultado);
    $nombres_columnas = array();
    for ($i = 1; $i <= $columnas; $i++) {
        $nombres_columnas[] = oci_field_name($resultado, $i);
    }

    //var_dump($componentes);

    
    // Liberar los recursos
    oci_free_statement($resultado);
    oci_close($conn);

} else {
    echo "No se proporcionó el parámetro 'tipo' en la URL";
}





?>


<!doctype html>
<html lang="es">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" href="css/comun.css">
        <link rel="stylesheet" href="css/swiper-bundle.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>
        <?php
            include "menu.php";
        ?>
        <script src="js/nav-script.js"></script>

        <section class="home">
            <div class="text">Bienvenido a TikAlmi</div>
            <!-- El eslider de 3 -->

            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                    <?php
                        // Iterar sobre los resultados y generar el HTML dinámicamente
                        foreach ($componentes as $componente) {
                            if ($componente['DISPONIBLE'] == 1) {
                                echo '<div class="card-slide swiper-slide">';
                                echo '<div class="image-slide">';
                                echo '<span class="overlay"></span>';
                                echo '<div class="card-image">';
                                echo '<img src="img/' . $componente['IMAGEN'] . '" alt="" class="card-img">';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="class-content">';
                                echo '<br>';
                                echo '<h2 class="name-slide">'.$componente['NOMBRE_PRODUCTO'].'</h2>';
                                echo '<br>';
                                echo '<p class="descripcion">'.$componente['DESCRIPCION'].'</p>';
                                echo '<br>';
                                // Dentro del bucle foreach para generar los enlaces "Cargar registro"
                                echo '<a href="editar.php?tipo=' . $tipo . '&id_producto=' . $componente['ID_PRODUCTO'] . '" class="name-slidex2">Cargar registro</a>';
                                echo '<br>';
                                echo '<br>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>

            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <!-- El form de modificar -->
            <div class="form_modificar">
            <?php
            $conn = connect_database();
                echo '<form action= "mod.php?tipo='.$tipo.'" method="post">';
                        
                        // Verificar si se ha recibido el parámetro 'id_producto' y realizar la consulta SQL correspondiente
                        if (isset($_GET['id_producto'])) {
                        // Obtener el ID del producto desde los parámetros de consulta
                        $id_producto = $_GET['id_producto'];
                        
                        // Realizar la consulta SQL para obtener los datos del producto según el ID
                        switch($tipo) {
                            case 'cpu':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, c.id_cpu, c.frecuencia, c.consumo, c.nucleos
                                FROM producto p
                                INNER JOIN CPU c ON p.id_producto = c.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'ram':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, r.id_ram, r.tamano, r.frecuencia, r.generacion
                                FROM producto p
                                INNER JOIN ram r ON p.id_producto = r.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'placa_base':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, pl.id_placa_base, pl.tamano, pl.grafica
                                FROM producto p
                                INNER JOIN placa_base pl ON p.id_producto = pl.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'tarjeta_grafica':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, tg.id_tarjeta_grafica, tg.capacidad, tg.consumo, tg.puertos_video
                                FROM producto p
                                INNER JOIN tarjeta_grafica tg ON p.id_producto = tg.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'disco_duro':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, d.id_disco_duro, d.almacenamiento, d.velocidad, d.peso 
                                FROM producto p
                                INNER JOIN disco_duro d ON p.id_producto = d.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'fuente_alimentacion':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, f.id_fuente, f.capacidad, f.modular 
                                FROM producto p
                                INNER JOIN fuente_alimentacion f ON p.id_producto = f.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'ventilador':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, v.id_ventilador, v.tamano
                                FROM producto p
                                INNER JOIN ventilador v ON p.id_producto = v.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'caja':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, c.id_caja, c.dimension
                                FROM producto p
                                INNER JOIN caja c ON p.id_producto = c.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'pantalla':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, pa.id_pantalla, pa.dimension, pa.puertos_video, pa.tasa_refresco 
                                FROM producto p
                                INNER JOIN pantalla pa ON p.id_producto = pa.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'teclado':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, te.id_teclado, te.inalambrico, te.peso, te.distribucion
                                FROM producto p
                                INNER JOIN teclado te ON p.id_producto = te.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'raton':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, rt.id_raton, rt.inalambrico, rt.peso
                                FROM producto p
                                INNER JOIN raton rt ON p.id_producto = rt.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'cascos':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, c.id_cascos, c.inalambrico, c.cancelacion_ruido, c.microfono 
                                FROM producto p
                                INNER JOIN cascos c ON p.id_producto = c.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            case 'portatil':
                                $sentencia = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.imagen, por.id_portatil, por.tamano, por.ram, por.grafica, por.procesador
                                FROM producto p
                                INNER JOIN portatil por ON p.id_producto = por.id_producto
                                WHERE p.id_producto = $id_producto";
                                break;
                            default:
                                echo "Tipo de componente no válido";
                                return; // Salir de la función si el tipo de componente no es válido
                        }

                        // Ejecutar la consulta y obtener los datos del producto
                        $resultado = oci_parse($conn, $sentencia);
                        oci_execute($resultado);
                        $producto = oci_fetch_assoc($resultado);
                        $primero = 0; 

                        // Generar los campos del formulario y completarlos con los datos del producto
                        foreach ($producto as $nombre_columna => $valor) {
                            echo '<label for="' . $nombre_columna . '">' . ucfirst($nombre_columna) . '</label>';
                            if($primero == 0 || $primero == 4 ){
                                echo '<input type="text" id="' . $nombre_columna . '" name="' . $nombre_columna . '" value="' . $valor . '" required readonly>';
                                
                            }else{
                                echo '<input type="text" id="' . $nombre_columna . '" name="' . $nombre_columna . '" value="' . $valor . '" required>';
                            }
                            $primero = $primero +1; 
                        }
                        // Campo oculto para enviar el ID del producto
                        echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
                        // Campo oculto para enviar el tipo de componente
                        echo '<input type="hidden" name="tipo" value="' . $tipo . '">';
                        echo '<button type="submit">Modificar</button>';
                        // Liberar los recursos
                        oci_free_statement($resultado);
                        } else {
                            //echo "No se proporcionó el parámetro 'id_producto' en la URL";
                        }
                    ?>
                </form>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>

            <!-- El form oculto -->
            <?php
            include "formLogin.php";
            ?>

        </section>
        <script src="js/form-script.js"></script>
        <script src="js/swiper-bundle.min.js"></script>
        <script src="js/slider-script.js"></script>

    </body>
</html>
