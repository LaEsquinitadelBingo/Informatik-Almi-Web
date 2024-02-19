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
function insertar_producto($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

   
    
    $stmt = oci_parse($conn, 'INSERT INTO producto (nombre, descripcion, precio, imagen, id_marca,id_proveedor, stock) VALUES (:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, 0)');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);


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
function insertar_cpu($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor,$frecuencia, $consumo, $nucleos)
{
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_CPU(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :frecuencia, :consumo, :nucleos); END;');
           
    // Vincular parámetros comunes
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':frecuencia', $frecuencia);
    oci_bind_by_name($stmt, ':consumo', $consumo);
    oci_bind_by_name($stmt, ':nucleos', $nucleos);

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

function insertar_ram($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $frecuencia, $generacion, $tamaño) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_RAM(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :frecuencia, :generacion, :tamaño); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':frecuencia', $frecuencia);
    oci_bind_by_name($stmt, ':generacion', $generacion);
    oci_bind_by_name($stmt, ':tamaño', $tamaño);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "RAM insertado correctamente.";
    } else {
        return "Error al insertar RAM.";
    }
}

function insertar_placa_base($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $grafica, $tamano) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_PLACA_BASE(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :grafica, :tamano); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':grafica', $grafica);
    oci_bind_by_name($stmt, ':tamano', $tamano);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Placa Base insertada correctamente.";
    } else {
        return "Error al insertar Placa Base.";
    }
}

function insertar_tarjeta_grafica($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $capacidad, $consumo, $puertos_video) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_TARJETA_GRAFICA(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :capacidad, :consumo, :puertos_video); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':capacidad', $capacidad);
    oci_bind_by_name($stmt, ':consumo', $consumo);
    oci_bind_by_name($stmt, ':puertos_video', $puertos_video);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Tarjeta Gráfica insertada correctamente.";
    } else {
        return "Error al insertar Tarjeta Gráfica.";
    }
}

function insertar_fuente_alimentacion($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $capacidad, $modular) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_FUENTE_ALIMENTACION(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :capacidad, :modular); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':capacidad', $capacidad);
    oci_bind_by_name($stmt, ':modular', $modular);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Fuente de Alimentación insertada correctamente.";
    } else {
        return "Error al insertar Fuente de Alimentación.";
    }
}

function insertar_ventilador($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $tamano) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_VENTILADOR(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :tamano); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':tamano', $tamano);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Ventilador insertado correctamente.";
    } else {
        return "Error al insertar Ventilador.";
    }
}

function insertar_caja($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $dimension) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_CAJA(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :dimension); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':dimension', $dimension);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Placa Base insertada correctamente.";
    } else {
        return "Error al insertar Placa Base.";
    }
}

function insertar_pantalla($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $dimension, $puertos_video, $tasa_refresco) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_PANTALLA(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :dimension, :puertos_video, :tasa_refresco); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':dimension', $dimension);
    oci_bind_by_name($stmt, ':puertos_video', $puertos_video);
    oci_bind_by_name($stmt, ':tasa_refresco', $tasa_refresco);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Pantalla insertada correctamente.";
    } else {
        return "Error al insertar Pantalla.";
    }
}

function insertar_teclado($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $distribucion, $peso, $inalambrico) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_TECLADO(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :distribucion, :peso, :inalambrico); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':distribucion', $distribucion);
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':inalambrico', $inalambrico);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Teclado insertado correctamente.";
    } else {
        return "Error al insertar Teclado.";
    }
}

function insertar_raton($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $peso, $inalambrico) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_RATON(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :peso, :inalambrico); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':peso', $peso);
    oci_bind_by_name($stmt, ':inalambrico', $inalambrico);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Ratón insertado correctamente.";
    } else {
        return "Error al insertar Ratón.";
    }
}

function insertar_cascos($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $cancelacion_ruido, $inalambrico, $microfono) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_CASCOS(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :cancelacion_ruido, :inalambrico, :microfono); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':cancelacion_ruido', $cancelacion_ruido);
    oci_bind_by_name($stmt, ':inalambrico', $inalambrico);
    oci_bind_by_name($stmt, ':microfono', $microfono);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Cascos insertados correctamente.";
    } else {
        return "Error al insertar Cascos.";
    }
}

function insertar_disco_duro($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $almacenamiento, $velocidad, $peso) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_DISCO_DURO(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :almacenamiento, :velocidad, :peso); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':almacenamiento', $almacenamiento);
    oci_bind_by_name($stmt, ':velocidad', $velocidad);
    oci_bind_by_name($stmt, ':peso', $peso);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Disco Duro insertado correctamente.";
    } else {
        return "Error al insertar Disco Duro.";
    }
}

function insertar_portatil($nombre, $descripcion, $precio, $imagen, $id_marca, $id_proveedor, $tamano, $ram, $grafica, $procesador) {
    // Conectar a la base de datos Oracle
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'BEGIN INSERTAR_PORTATIL(:nombre, :descripcion, :precio, :imagen, :id_marca, :id_proveedor, :tamano, :ram, :grafica, :procesador); END;');
           
    // Vincular parámetros
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':imagen', $imagen);
    oci_bind_by_name($stmt, ':id_marca', $id_marca);
    oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
    oci_bind_by_name($stmt, ':tamano', $tamano);
    oci_bind_by_name($stmt, ':ram', $ram);
    oci_bind_by_name($stmt, ':grafica', $grafica);
    oci_bind_by_name($stmt, ':procesador', $procesador);

    // Ejecutar la sentencia
    $result = oci_execute($stmt);

    // Cerrar la conexión
    oci_close($conn);

    if ($result) {
        return "Portátil insertado correctamente.";
    } else {
        return "Error al insertar Portátil.";
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

function quitar_Disponibilidad($id_producto) {
    $conn = connect_database();
    
    // Verificar la conexión
    if (!$conn) {
        return "Error de conexión";
    }

    $stmt = oci_parse($conn, 'UPDATE producto SET disponible = 0 WHERE id_producto = :id_producto');
           
    // Vincular parámetros comunes
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

?>



