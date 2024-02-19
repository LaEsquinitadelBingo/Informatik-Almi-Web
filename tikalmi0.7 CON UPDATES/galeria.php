<?php
include("bbdd.php");
$conn = connect_database();
// Recuperar el tipo de componente de la URL
if(isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    
    // Realizar la consulta SQL dependiendo del tipo de componente
    switch($tipo) {
        case 'cpu':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN cpu c ON p.id_producto = c.id_producto";
            break;
        case 'ram':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN ram r ON p.id_producto = r.id_producto";
            break;
        case 'placa_base':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN placa_base pb ON p.id_producto = pb.id_producto";
            break;
        case 'tarjeta_grafica':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN tarjeta_grafica tg ON p.id_producto = tg.id_producto";
            break;
        case 'disco_duro':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN disco_duro d ON p.id_producto = d.id_producto";
            break;
        case 'fuente_alimentacion':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN fuente_alimentacion fa ON p.id_producto = fa.id_producto";
            break;
        case 'ventilador':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN ventilador v ON p.id_producto = v.id_producto";
            break;
        case 'caja':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN caja c ON p.id_producto = c.id_producto";
            break;
        case 'pantalla':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN pantalla pa ON p.id_producto = pa.id_producto";
            break;
        case 'teclado':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN teclado t ON p.id_producto = t.id_producto";
            break;
        case 'raton':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN raton r ON p.id_producto = r.id_producto";
            break;
        case 'cascos':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN cascos c ON p.id_producto = c.id_producto";
            break;
        case 'portatil':
            $sentencia = "SELECT p.nombre, p.imagen FROM producto p INNER JOIN portatil pr ON p.id_producto = pr.id_producto";
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
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="img/logo-prueba.png" alt="logo">
                    </span>

                    <div class="text header-text">
                        <span class="name">TikAlmi</span>
                        <span class="profession">Tu solucion en un Tik</span>
                    </div>
                </div>
                <i class='bx bx-chevron-right toggle'></i>
            </header>


            <div class="menu-bar">
                <div class="menu">
                    <li class="search-box">
                        <i class='' ></i>
                    </li>
                    <ul class="menu-links">
                        <li class="nav-link">
                            <a href="">
                                <i class='bx bx-purchase-tag-alt icon' ></i>
                                <span class="text nav-text">Configuraciones PC</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="">
                                <i class='bx bx-basket icon'></i>
                                <span class="text nav-text">Componentes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="bottom-content">

                    <li class="">
                        <a id="form-open"> <!-- Cuidado con el href aqui si se pone, lo coge raro y quita el "home show" -->
                            <i class='bx bx-log-in icon'></i>
                            <span class="text nav-text">LogIn</span>
                        </a>
                    </li>

                    <li class="mode">
                        <div class="moon-sun">
                            <i class='bx bx-moon icon moon' ></i>
                            <i class='bx bx-sun icon sun' ></i>
                        </div>
                        <span class="mode-text text">Dark Mode</span>

                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </li>
                </div>
            </div>
        </nav>
        <script src="js/nav-script.js"></script>

        <section class="home">
            <div class="text">Busque entre los (aqui cossas de php) mas adecuados</div>
            <div class="form_container">
                <i class='bx bx-x-circle form_close'></i>
                <!-- El Login -->
                <div class="form login_form">
                    <form action="">
                        <h2>Inicia Sesion</h2>

                        <div class="input_box">
                            <input type="email" placeholder="Introduzca su mail" required>
                            <i class='bx bxs-envelope email'></i>
                        </div>
                        <div class="input_box">
                            <input type="password" placeholder="Introduzca su password" required>
                            <i class='bx bxs-lock-alt password'></i>
                            <i class='bx bxs-lock-open-alt pw_hide' ></i>
                        </div>
                        <div class="option_field">
                            <span class="checkbox">
                                <input type="checkbox" id="check">
                                <label for="check">Recuerdame</label>
                            </span>
                            <a href="" class="forgot_pw">Olvidaste tu contraseña?</a>
                        </div>
                        
                        <button class="button">Inicia Sesion</button>
                        <div class="login_signup">Todavia sin cuenta? Unete a nosotros! <a href="#" id="signup">Registrate</a></div>
                    </form>
                </div>
                <!-- El registros -->
                <div class="form signup_form">
                    <form action="">
                        <h2>Registrate</h2>

                        <div class="input_box">
                            <input type="email" placeholder="Introduzca su mail" required>
                            <i class='bx bxs-envelope email'></i>
                        </div>
                        <div class="input_box">
                            <input type="password" placeholder="Cree su password" required>
                            <i class='bx bxs-lock-alt password'></i>
                            <i class='bx bxs-lock-open-alt pw_hide' ></i>
                        </div>
                        <div class="input_box">
                            <input type="password" placeholder="Confirme su password" required>
                            <i class='bx bxs-lock-alt password'></i>
                            <i class='bx bxs-lock-open-alt pw_hide' ></i>
                        </div>
                        
                        <button class="button">Registrate</button>


                        <div class="login_signup">Ya tiene suna cuenta? <a href="#" id="login">Incica Sesion</a></div>
                    </form>
                </div>
            </div>

            <div class="container-galeria">
                <div class="search-box-galeria">
                    <i class="bx bx-search"></i>
                    <input type="text" placeholder="Busca tu componenete aqui">
                </div>
                <div class="images-galeria">
                    <?php
                    // Iterar sobre los resultados y generar el HTML dinámicamente
                    foreach ($componentes as $componente) {
                        echo '<div class="image-box" data-name="' . $componente['NOMBRE'] . '">';
                        echo '<img src="img/' . $componente['IMAGEN'] . '" alt="">';
                        echo '<h6>' . $componente['NOMBRE'] . '</h6>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

        </section>
        <script src="js/form-script.js"></script>
        <script src="js/galeria-script.js"></script>
    </body>
</html>
