<?php
include("bbdd.php");
$conn = connect_database();
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
            <div class="text">Seleccione el tipo de componente</div>
            <br>
            <div class="container-componentes">
                <div class="content-center">
                    <div class="images-componentes">
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=cpu" class="enlace-comp">Cpu</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=ram" class="enlace-comp">Ram</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=placa_base" class="enlace-comp">Motherboards</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=tarjeta_grafica" class="enlace-comp">Graphic Cards</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=disco_duro" class="enlace-comp">Hard Drives</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=fuente_alimentacion" class="enlace-comp">Power Supply</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=ventilador" class="enlace-comp">Cooling Fans</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=caja" class="enlace-comp">Tower</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=pantalla" class="enlace-comp">Screens</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=teclado" class="enlace-comp">Keyboards</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=raton" class="enlace-comp">Mouses</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=cascos" class="enlace-comp">Headphones</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/logo-prueba.png" alt="">
                            <a href="editar.php?tipo=portatil" class="enlace-comp">Portable PCs</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- El form oculto -->
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
        </section>
        <script src="js/form-script.js"></script>

    </body>
</html>
