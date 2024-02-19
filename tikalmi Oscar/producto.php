<?php

//ADAPTAR ESTO A ORACLE Y A LOS PRODUCTOS PARA PODER HACER INSERT

session_start(); /* ????? */

if ($_SESSION['id_usuario']==null) {
    header('location:index.php');
 }


error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'bbdd.php';

$imagen = '';
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$fecha= date("Y-m-d H:i:s");
$precio=$_POST['precio'];
$marca=$_POST['marca'];
$stock=$_POST['stock'];


$Tproducto=$_POST['Tproducto'];

if (isset($_FILES['imagen'])) {
    // Si la condición de longitud es válida y se ha enviado un archivo, realizar la inserción
    $imagen = date("Y-m-d H:i:s").basename($_FILES['imagen']['name']);
    $path = "images/" . $imagen;

    move_uploaded_file($_FILES['imagen']['tmp_name'], "$path");

    $resultado = insertar_producto($nombre, $descripcion, $precio, $imagen, $marca, $stock);

    if ($resultado) {
         $id_producto = obtener_id_producto($imagen);
         if($id_producto){
            switch ($Tproducto) {
                case 'CPU':
                    $frecuencia=$_POST['frecuencia'];
                    $consumo=$_POST['consumo'];
                    $nucleos=$_POST['nucleos'];

                    $result = insertar_cpu($frecuencia, $consumo, $nucleos, $id_producto);
                        if($result){
                            header('location:componentes.php');
                        }else{
                            header('location:subirProducto.php');

                        }
                    break;
                case 'RAM':
                    $frecuencia=$_POST['frecuencia'];
                    $generacion=$_POST['generacion'];
                    $tamano=$_POST['tamano'];

                    $result = insertar_ram($frecuencia, $generacion, $tamano, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'placa_base':
                    $grafica=$_POST['grafica'];
                    $tamano=$_POST['tamano'];

                    $result = insertar_placa_base($tamano, $grafica, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'tarjeta_grafica':
                    $capacidad=$_POST['capacidad'];
                    $consumo=$_POST['consumo'];
                    $puertos_video=$_POST['puertos_video'];

                    $result = insertar_tarjeta_grafica($capacidad, $consumo, $puertos_video, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'fuente_alimentacion':
                    $capacidad=$_POST['capacidad'];
                    $modular=$_POST['modular'];

                    $result = insertar_fuente_alimentacion($capacidad, $modular,  $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'ventilador':
                    $tamano=$_POST['tamano'];

                    $result = insertar_ventilador($tamano,  $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'caja':
                    $dimension=$_POST['dimension'];

                    $result = insertar_caja($dimension,  $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'pantalla':
                    $dimension=$_POST['dimension'];
                    $puertos_video=$_POST['puertos_video'];
                    $tasa_refresco=$_POST['tasa_refresco'];

                    $result = insertar_pantalla($dimension, $puertos_video, $tasa_refresco, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'teclado':
                    $distribucion=$_POST['distribucion'];
                    $peso=$_POST['peso'];
                    $inalambrico=$_POST['inalambrico'];

                    $result = insertar_teclado($distribucion, $peso, $inalambrico, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'raton':
                    $peso=$_POST['peso'];
                    $inalambrico=$_POST['inalambrico'];

                    $result = insertar_raton($peso, $inalambrico, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'cascos':
                    $cancelacion_ruido=$_POST['cancelacion_ruido'];
                    $inalambrico=$_POST['inalambrico'];
                    $microfono=$_POST['microfono'];


                    $result = insertar_cascos($inalambrico, $cancelacion_ruido, $microfono, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'disco_duro':
                    $almacenamiento=$_POST['almacenamiento'];
                    $velocidad=$_POST['velocidad'];
                    $peso=$_POST['peso'];


                    $result = insertar_disco_duro($almacenamiento, $velocidad, $peso, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                case 'portatil':
                    $tamano=$_POST['tamano'];
                    $ram=$_POST['ram'];
                    $grafica=$_POST['grafica'];
                    $procesador=$_POST['procesador'];



                    $result = insertar_portatil($tamano, $ram, $grafica, $procesador, $id_producto);
                    if($result){
                        header('location:componentes.php');
                    }else{
                        header('location:subirProducto.php');

                    }
                    break;
                default:
                    // Manejar el caso por defecto o mostrar un mensaje de error
                    break;
            }
         }
    }
}

// Si llegamos aquí, es porque hubo un error en la inserción o no se enviaron archivos
header('location:subirProducto.php');
exit(); 


?>