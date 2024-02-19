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
        <link rel="stylesheet" href="css/swiper-bundle.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>
        <?php
            include "menu.php";
        ?>
        <script src="js/nav-script.js"></script>

        <section class="home">
            <div class="text">Wellcome to Tikalmi Task Manager</div>
            <br>
            <br>
            <br>
            <br>
            <div class="container-landing">
                <div class="content-center">
                    <div class="images-landig">
                        <div class="image-landing">
                            <img src="img/admin.png" alt="">
                        </div>
                    </div>

                </div>
                <div class="text-landing">
                        
                        <p>
                            Bienvenido al panel de administracion, que deseas hacer? 
                        </p>
                        <br>

                        <a href="componentesAd.php">
                            <button type="submit">Modificar</button>
                        </a>

                        <a href="componentesAd.php">
                            <button type="submit">Crear</button>
                        </a>

                        <a href="componentesAd.php">
                            <button type="submit">Eliminar</button>
                        </a>

                    </div>
            </div>

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