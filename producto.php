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
$Tproducto=$_POST['Tproducto'];

if (isset($_FILES['imagen'])) {
    // Si la condición de longitud es válida y se ha enviado un archivo, realizar la inserción
    $temp = $_FILES['imagen']['tmp_name'];
    $imagen = date("Y_m_d_H_i_s").basename($_FILES['imagen']['name']);
    $path = strtolower($Tproducto) . "/" . $imagen;


    if (move_uploaded_file($temp, "img/". $path)) {
        chmod($path, 0777);  
    }
    else {
        echo "Error al subir la imagen";
    }

    $id_usuario = $_SESSION['id_usuario'];
    switch ($Tproducto) {
        case 'CPU':
            $frecuencia=$_POST['frecuencia'];
            $consumo=$_POST['consumo'];
            $nucleos=$_POST['nucleos'];

            $result = insertar_cpu($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$frecuencia, $consumo, $nucleos);
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

            $result = insertar_ram($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$frecuencia, $generacion, $tamano);
            if($result){
                header('location:componentes.php');
            }else{
                header('location:subirProducto.php');
            }
            break;
        case 'placa_base':
            $grafica=$_POST['grafica'];
            $tamano=$_POST['tamano'];

            $result = insertar_placa_base($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$grafica, $tamano);
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

            $result = insertar_tarjeta_grafica($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$capacidad, $consumo, $puertos_video);
            if($result){
                header('location:componentes.php');
            }else{
                header('location:subirProducto.php');
            }
            break;
        case 'fuente_alimentacion':
            $capacidad=$_POST['capacidad'];
            $modular=$_POST['modular'];

            $result = insertar_fuente_alimentacion($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$capacidad, $modular);
            if($result){
                header('location:componentes.php');
            }else{
                header('location:subirProducto.php');
            }
            break;
        case 'ventilador':
            $tamano=$_POST['tamano'];

            $result = insertar_ventilador($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$tamano);
            if($result){
                header('location:componentes.php');
            }else{
                header('location:subirProducto.php');
            }
            break;
        case 'caja':
            $dimension=$_POST['dimension'];

            $result = insertar_caja($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$dimension);
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

            $result = insertar_pantalla($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$dimension, $puertos_video, $tasa_refresco);
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

            $result = insertar_teclado($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$distribucion, $peso, $inalambrico);
            if($result){
                header('location:componentes.php');
            }else{
                header('location:subirProducto.php');
            }
            break;
        case 'raton':
            $peso=$_POST['peso'];
            $inalambrico=$_POST['inalambrico'];

            $result = insertar_raton($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$peso, $inalambrico);
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


            $result = insertar_cascos($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$cancelacion_ruido, $inalambrico, $microfono);
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


            $result = insertar_disco_duro($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$almacenamiento, $velocidad, $peso);
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

            $result = insertar_portatil($nombre, $descripcion, $precio, $path, $marca, $id_usuario,$tamano, $ram, $grafica, $procesador);
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

// Si llegamos aquí, es porque hubo un error en la inserción o no se enviaron archivos
header('location:subirProducto.php');
exit(); 
?>
