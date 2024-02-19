<?php
include("bbdd.php");
$conn = connect_database();
$tipo = $_GET['tipo'];
switch($tipo) {

    case 'cpu':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_cpu( $_POST["FRECUENCIA"],$_POST["CONSUMO"],$_POST["NUCLEOS"],$_POST["ID_PRODUCTO"]);
        break;

    case 'caja':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_caja( $_POST["DIMENSION"],$_POST["ID_PRODUCTO"]);
        break;

    case 'cascos':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_cascos( $_POST["INALAMBRICO"],$_POST["CANCELACION_RUIDO"],$_POST["MICROFONO"],$_POST["ID_PRODUCTO"]);
        break;

    case 'disco_duro':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_disco_duro( $_POST["ALMACENAMIENTO"],$_POST["VELOCIDAD"],$_POST["PESO"],$_POST["ID_PRODUCTO"]);
        break;

    case 'fuente_alimentacion':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_fuente_alimentacion( $_POST["CAPACIDAD"],$_POST["MODULAR"],$_POST["ID_PRODUCTO"]);
        break;

    case 'pantalla':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_pantalla( $_POST["DIMENSION"],$_POST["PUERTOS_VIDEO"],$_POST["TASA_REFRESCO"],$_POST["ID_PRODUCTO"]);
        break;

    case 'placa_base':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_placa_base( $_POST["TAMANO"],$_POST["GRAFICA"],$_POST["ID_PRODUCTO"]);

        break;

    case 'portatil':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_portatil( $_POST["TAMANO"],$_POST["RAM"],$_POST["GRAFICA"],$_POST["PROCESADOR"],$_POST["ID_PRODUCTO"]);

        break;

    case 'ram':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_ram( $_POST["TAMANO"],$_POST["FRECUENCIA"],$_POST["GENERACION"],$_POST["ID_PRODUCTO"]);
        break;

    case 'raton':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_raton( $_POST["PESO"],$_POST["INALAMBRICO"],$_POST["ID_PRODUCTO"]);
        break;

    case 'tarjeta_grafica':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_tarjeta_grafica( $_POST["CAPACIDAD"],$_POST["CONSUMO"],$_POST["PUERTOS_VIDEO"]$_POST["ID_PRODUCTO"]);
        break;

    case 'teclado':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_teclado( $_POST["DISTRIBUCION"],$_POST["PESO"],$_POST["INALAMBRICO"]$_POST["ID_PRODUCTO"]);
        break;
        
    case 'ventilador':
        update_producto($_POST["NOMBRE_PRODUCTO"], $_POST["DESCRIPCION"],$_POST["IMAGEN"],$_POST["ID_PRODUCTO"]);
        update_teclado( $_POST["TAMANO"],$_POST["ID_PRODUCTO"]);
        break;

    default:
        echo "Tipo de componente no válido";
        return; // Salir de la función si el tipo de componente no es válido
    }
// Ejecutar la consulta y obtener los datos del producto

header("Location:componentesAd.php");
    
?>

