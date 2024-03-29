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
        
        <?php
            include "menu.php";
        ?>

        <script src="js/nav-script.js"></script>
        <section class="home">
            <div class="text">Seleccione el tipo de componente</div>
            <br>
            <div class="container-componentes">
                <div class="content-center">
                    <div class="images-componentes">
                        <div class="image-seleccion">
                            <img src="img/procesador.png" alt="">
                            <a href="borrarProducto.php?tipo=cpu" class="enlace-comp">Cpu</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/ram.png" alt="">
                            <a href="borrarProducto.php?tipo=ram" class="enlace-comp">Ram</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/tarjeta-madre.png" alt="">
                            <a href="borrarProducto.php?tipo=placa_base" class="enlace-comp">Motherboards</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/carta-grafica.png" alt="">
                            <a href="borrarProducto.php?tipo=tarjeta_grafica" class="enlace-comp">Graphic Cards</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/disco-duro.png" alt="">
                            <a href="borrarProducto.php?tipo=disco_duro" class="enlace-comp">Hard Drives</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/fuente-de-alimentacion.png" alt="">
                            <a href="borrarProducto.php?tipo=fuente_alimentacion" class="enlace-comp">Power Supply</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/turbina-eolica.png" alt="">
                            <a href="borrarProducto.php?tipo=ventilador" class="enlace-comp">Cooling Fans</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/torre-de-la-pc.png" alt="">
                            <a href="borrarProducto.php?tipo=caja" class="enlace-comp">Tower</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/pantalla.png" alt="">
                            <a href="borrarProducto.php?tipo=pantalla" class="enlace-comp">Screens</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/teclado.png" alt="">
                            <a href="borrarProducto.php?tipo=teclado" class="enlace-comp">Keyboards</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/raton.png" alt="">
                            <a href="borrarProducto.php?tipo=raton" class="enlace-comp">Mouses</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/auriculares.png" alt="">
                            <a href="borrarProducto.php?tipo=cascos" class="enlace-comp">Headphones</a>
                        </div>
                        <div class="image-seleccion">
                            <img src="img/ordenador-portatil.png" alt="">
                            <a href="borrarProducto.php?tipo=portatil" class="enlace-comp">Portable PCs</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- El form oculto -->
            <?php
            include "formLogin.php";
            ?>
            
        </section>
        <script src="js/form-script.js"></script>

    </body>
</html>
