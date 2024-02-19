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

            <div class="text">Panel de creacion de productos</div>
            
            <form class="form_insertar" id="registro" action="producto.php" method="post" enctype="multipart/form-data"> <!-- ESte action y method lo ponemos paraa php -->
            
                <div class="input-container">
                    <label for="nombre">Nombre :</label>
                    <input class="inputBorder" type="text" name="nombre" id="nombre" required>
                </div>
                <br>
                <div class="input-container">
                    <label for="descripcion">Descripción :</label>
                    <textarea name="descripcion" id="descripcion" cols="60" rows="10" required></textarea>
                </div>
                <br>
                <div class="input-container">
                    <label for="imagen">Adjuntar imagen :</label>
                    <input type="file" name="imagen" id="imagen" required>
                </div>
                <br>
                <div class="input-container">
                    <label for="precio">Precio :</label>
                    <input type="number" name="precio" id="precio" required>
                </div>
                <br>
                <div class="input-container">
                <label for="Tproducto">Selccione marca :</label>
                    <select name="marca">
                        <?php
                        include "bbdd.php";
                        $marcas = obtener_marcas();
                        
                        foreach ($marcas as $marca) {
                            echo "<option value='{$marca['ID_MARCA']}'>{$marca['NOMBRE']}</option>";
                        }
                        ?>
                    </select>

                </div>
                <br>
                <div class="input-container">
                    <label for="Tproducto">Tipo de producto :</label>
                    <select name="Tproducto" id="productoSelect">
                        <option value="">Selecione un tipo de producto</option>
                        <option value="CPU">CPU</option>
                        <option value="RAM">RAM</option>
                        <option value="placa_base">PLACA BASE</option>
                        <option value="tarjeta_grafica">TARJETA GRÁFICA</option>                        
                        <option value="fuente_alimentacion">FUENTE ALIMENTACIÓN</option>
                        <option value="ventilador">VENTILADOR</option>
                        <option value="caja">CAJA</option>
                        <option value="pantalla">PANTALLA</option>
                        <option value="teclado">TECLADO</option>
                        <option value="raton">RATÓN</option>
                        <option value="cascos">CASCOS</option>
                        <option value="disco_duro">DISCO DURO</option>
                        <option value="portatil">PORTÁTIL</option>
                    </select>
                </div>
                <br>
                <div id="camposExtra">


                </div>
                <br>
                <div class="enviar">
                    <input type="submit" value="Insertar producto">
                </div>

            </form>

            <?php
            include "formLogin.php";
            ?>

        </section>
        <script src="js/form_insert.js"></script>

        <script src="js/form-script.js"></script>
        <script src="js/swiper-bundle.min.js"></script>
        <script src="js/slider-script.js"></script>

    </body>
</html>
