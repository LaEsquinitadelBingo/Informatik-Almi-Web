<?php
//PARA CONECTARSE A LA BASE DE DATOS:

error_reporting(E_ALL);
ini_set('display_errors', '1');


function connect_database()
{
    if (!extension_loaded('oci8')) {
        die('La extensión OCI8 no está habilitada. Verifica la configuración de PHP.');
    }
    
    $usuario = 'RETO2';
    $contrasena = 'almi123';
    $host = '52.206.166.129';
    $puerto = '1521';
    $sid = 'orcl';
    
    $conexion_string = "//{$host}:{$puerto}/{$sid}";
    
    $conn = oci_connect($usuario, $contrasena, $conexion_string);
    
    if (!$conn) {
        $error = oci_error();
        echo "Error de conexión: " . $error['message'];
        exit;  // Sale del script si hay un error de conexión
    }
    return $conn;
}



//FUNCIÓN PARA LOGIN:

function login($usuario, $pass)
{
    $conn = connect_database();

    $sql = "SELECT id_proveedor FROM proveedor WHERE usuario = :usuario AND password = :passw";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_bind_by_name($stmt, ':passw', $pass);

    if (!oci_execute($stmt)) {
        $e = oci_error($stmt);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $result = false;
    if ($row = oci_fetch_assoc($stmt)) {
        $result = $row['ID_PROVEEDOR'];
    }

    oci_free_statement($stmt);
    oci_close($conn);

    return $result;
}

//FUNCIÓN PARA RECUPERAR EL ID DE PRODUCTO RECIEN INSERTADO
function obtener_id_producto($imagen)
{
    $conn = connect_database();

    $sql = "SELECT id_producto FROM producto WHERE imagen = :imagen";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':imagen', $imagen);

    if (!oci_execute($stmt)) {
        $e = oci_error($stmt);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $result = false;
    if ($row = oci_fetch_assoc($stmt)) {
        $result = $row['ID_PRODUCTO'];
    }

    oci_free_statement($stmt);
    oci_close($conn);

    return $result;
}

//FUNCION PARA OBTENER MARCA
function obtener_marcas()
{
    $conn = connect_database();

    $sql = "SELECT * FROM marca";

    $stmt = oci_parse($conn, $sql);

    if (!oci_execute($stmt)) {
        $e = oci_error($stmt);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $result = array();
    while ($row = oci_fetch_assoc($stmt)) {
        $result[] = $row;
    }

    oci_free_statement($stmt);
    oci_close($conn);

    return $result;
}




//FUNCIÓN PARA INSERTAR UN PRODUCTO:
function insertar_producto($nombre, $descripcion, $precio, $imagen, $id_marca, $stock)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'INSERT INTO producto (nombre, descripcion, precio, imagen, id_marca, stock) VALUES (:nombre, :descripcion, :precio, :imagen, :id_marca, :stock)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':stock', $stock);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}




//FUNCIÓN PARA INSERTAR CPU:
function insertar_cpu($frecuencia, $consumo, $nucleos, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'INSERT INTO CPU (frecuencia, consumo, nucleos, id_producto) VALUES (:frecuencia, :consumo, :nucleos, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':frecuencia', $frecuencia);
    oci_bind_by_name($stmt, ':consumo', $consumo);
    oci_bind_by_name($stmt, ':nucleos', $nucleos);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "CPU insertado correctamente.";
    } else {
        return "Error al insertar CPU.";
    }
}




//FUNCIÓN PARA INSERTAR RAM:
function insertar_ram($frecuencia, $generacion, $tamano, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'INSERT INTO RAM (frecuencia, generacion, tamano, id_producto) VALUES (:frecuencia, :generacion, :tamano, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':frecuencia', $frecuencia);
    oci_bind_by_name($stmt, ':generacion', $generacion);
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}





//FUNCIÓN PARA INSERTAR PLACA BASE:
function insertar_placa_base($tamano, $grafica, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'INSERT INTO placa_base (tamano, grafica, id_producto) VALUES (:tamano, :grafica, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':grafica', $grafica);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}




//FUNCIÓN PARA INSERTAR TARJETA GRAFICA:
function insertar_tarjeta_grafica($capacidad, $consumo, $puertos_video, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO tarjeta_grafica (capacidad, consumo, puertos_video, id_producto) VALUES (:capacidad, :consumo, :puertos_video, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':capacidad', $capacidad);
    oci_bind_by_name($stmt, ':consumo', $consumo);
    oci_bind_by_name($stmt, ':puertos_video', $puertos_video);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR FUENTE ALIMENTACION:
function insertar_fuente_alimentacion($capacidad, $modular, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO fuente_alimentacion (capacidad, modular, id_producto) VALUES (:capacidad, :modular,:id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':capacidad', $capacidad);
    oci_bind_by_name($stmt, ':modular', $modular);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR VENTILADOR:
function insertar_ventilador($tamano, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO ventilador (tamano, id_producto) VALUES (:tamano,:id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR CAJA:
function insertar_caja($dimension, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO caja (dimesion, id_producto) VALUES (:dimesion,:id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':dimension', $dimension);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR PANTALLA:
function insertar_pantalla($dimension, $puertos_video, $tasa_refresco, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO pantalla (dimesion, puertos_video, tasa_refresco, id_producto) VALUES (:dimesion, :puertos_video, :tasa_refresco, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':dimension', $dimension);
    oci_bind_by_name($stmt, ':puertos_video', $puertos_video);
    oci_bind_by_name($stmt, ':tasa_refresco', $tasa_refresco);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR TECLADO:
function insertar_teclado($distribucion, $peso, $inalanbrico, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO teclado (distribucion, peso, inalanbrico, id_producto) VALUES (:distribucion, :peso, :inalanbrico, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':distribucion', $distribucion);
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':inalanbrico', $inalanbrico);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR RATHOWNA:
function insertar_raton($peso, $inalanbrico, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO raton (peso, inalanbrico, id_producto) VALUES (:peso, :inalanbrico, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':inalanbrico', $inalanbrico);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR CASCOS:
function insertar_cascos($inalanbrico, $cancelacion_ruido, $microfono, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO cascos (inalanbrico, cancelacion_ruido, microfono, id_producto) VALUES (:inalanbrico, :cancelacion_ruido, :microfono, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':inalanbrico', $inalanbrico);
    oci_bind_by_name($stmt, ':cancelacion_ruido', $cancelacion_ruido);
    oci_bind_by_name($stmt, ':microfono', $microfono);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR DISCO DURO:
function insertar_disco_duro($almacenamiento, $velocidad, $peso, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO disco_duro (almacenamiento, velocidad, peso, id_producto) VALUES (:almacenamiento, :velocidad, :peso, :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':almacenamiento', $almacenamiento);
    oci_bind_by_name($stmt, ':velocidad', $velocidad);
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA INSERTAR PORTAIL:
function insertar_portatil($tamano, $ram, $grafica, $procesador, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO portatil (tamano, ram, grafica, procesador,id_producto) VALUES (:tamano, :ram, :grafica, :procesador :id_producto)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':ram', $ram);
    oci_bind_by_name($stmt, ':grafica', $grafica);
    oci_bind_by_name($stmt, ':procesador', $procesador);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}
//FUNCIÓN PARA UPDATEAR PRODUCTO:
function update_producto($nombre, $descripcion, $imagen, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'UPDATE producto SET nombre = :nombre, descripcion = :descripcion, imagen = :imagen WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR CPU:
function update_cpu($frecuencia, $consumo, $nucleos, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'UPDATE CPU SET frecuencia = :frecuencia, consumo = :consumo, nucleos = :nucleos WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':frecuencia', $frecuencia);
    oci_bind_by_name($stmt, ':consumo', $consumo);
    oci_bind_by_name($stmt, ':nucleos', $nucleos);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "CPU insertado correctamente.";
    } else {
        return "Error al insertar CPU.";
    }
}
//FUNCIÓN PARA UPDATEAR RAM:
function update_ram($tamano,$frecuencia,$generacion , $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'UPDATE ram set tamano = :tamano, frecuencia = :frecuencia, generacion = :generacion WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':frecuencia', $frecuencia);
    oci_bind_by_name($stmt, ':generacion', $generacion);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "CPU insertado correctamente.";
    } else {
        return "Error al insertar CPU.";
    }
}

//FUNCIÓN PARA UPDATEAR PLACA BASE:
function update_placa_base($tamano, $grafica, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'UPDATE placa_base set tamano = :tamano, grafica = :grafica, WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':grafica', $grafica);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR CAJA:
function update_caja($dimension, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE caja set dimension = :dimension, WHERE id_producto = :id_producto');

    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':dimension', $dimension);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR CASCOS:
function update_cascos($inalanbrico, $cancelacion_ruido, $microfono, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE cascos set inalambrico = :inalambrico, cancelacion_ruido = :cancelacion_ruido, microfono = :microfono WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':inalanbrico', $inalanbrico);
    oci_bind_by_name($stmt, ':cancelacion_ruido', $cancelacion_ruido);
    oci_bind_by_name($stmt, ':microfono', $microfono);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }

}

//FUNCIÓN PARA UPDATEAR FUENTE ALIMENTACION:
function update_fuente_alimentacion($capacidad, $modular, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE fuente_alimentacion set capacidad = :capacidad, modular = :modular WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':capacidad', $capacidad);
    oci_bind_by_name($stmt, ':modular', $modular);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR DISCO DURO:
function update_disco_duro($almacenamiento, $velocidad, $peso, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE disco_duro set almacenamiento = :almacenamiento, velocidad = :velocidad, peso = :peso  WHERE id_producto = :id_producto');
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':almacenamiento', $almacenamiento);
    oci_bind_by_name($stmt, ':velocidad', $velocidad);
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR PANTALLA:
function update_pantalla($dimension, $puertos_video, $tasa_refresco, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE pantalla set dimesion = :dimesion, puertos_video = :puertos_video, tasa_refresco = :tasa_refresco  WHERE id_producto = :id_producto');   
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':dimension', $dimension);
    oci_bind_by_name($stmt, ':puertos_video', $puertos_video);
    oci_bind_by_name($stmt, ':tasa_refresco', $tasa_refresco);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR PORTAIL:
function update_portatil($tamano, $ram, $grafica, $procesador, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE portatil set tamano = :tamano, ram = :ram, grafica = :grafica, procesador = :procesador  WHERE id_producto = :id_producto');     
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':ram', $ram);
    oci_bind_by_name($stmt, ':grafica', $grafica);
    oci_bind_by_name($stmt, ':procesador', $procesador);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR RATON:
function update_raton($peso, $inalanbrico, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE raton set peso = :peso, inalanbrico = :inalanbrico WHERE id_producto = :id_producto');     
     
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':inalanbrico', $inalanbrico);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}


//FUNCIÓN PARA UPDATEAR TARJETA GRAFICA:
function update_tarjeta_grafica($capacidad, $consumo, $puertos_video, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE tarjeta_grafica set capacidad = :capacidad, consumo = :consumo, puertos_video = :puertos_video WHERE id_producto = :id_producto');         
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':capacidad', $capacidad);
    oci_bind_by_name($stmt, ':consumo', $consumo);
    oci_bind_by_name($stmt, ':puertos_video', $puertos_video);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}


//FUNCIÓN PARA UPDATEAR TECLADO:
function update_teclado($distribucion, $peso, $inalanbrico, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE teclado set distribucion = :distribucion, peso = :peso, inalanbrico = :inalanbrico WHERE id_producto = :id_producto');    
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':distribucion', $distribucion);
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':inalanbrico', $inalanbrico);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

//FUNCIÓN PARA UPDATEAR VENTILADOR:
function update_ventilador($tamano, $id_producto)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE ventilador set tamano = :tamano WHERE id_producto = :id_producto');    
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

function crear_Pedido($id_proveedor, $id_producto, $cantidad)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'INSERT INTO pedido_proveedor (fecha_entrada, id_proveedor, id_producto, cantidad) VALUES (sysdate, :id_proveedor, :id_producto, :cantidad)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);
    oci_bind_by_name($stmt, ':cantidad', $cantidad);


    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Producto insertado correctamente.";
    } else {
        return "Error al insertar el producto.";
    }
}

?>



