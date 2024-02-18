
<?php
session_start();
// Verifica si hay un usuario almacenado en la sesión
if(isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
}
?>
<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <a href="<?php echo isset($_SESSION["usuario"]) ? 'indexAd.php' : 'index.php'; ?>">
                    <img src="img/logo-prueba.png" alt="logo">
                </a>
            </span>
            <div class="text header-text">
                <a href="<?php echo isset($_SESSION["usuario"]) ? 'indexAd.php' : 'index.php'; ?>" class="texto-index">
                    <span class="name">TikAlmi</span>
                </a>
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
                            <a href="packsPc.php">
                                <i class='bx bx-purchase-tag-alt icon' ></i>
                                <span class="text nav-text">Configuraciones PC</span>
                            </a>
                        </li>
                        <?php


                        if(isset($_SESSION["usuario"])) {
                        $usuario = $_SESSION["usuario"];
                        
                        echo "<li class='nav-link'>";
                        echo    "<a href='componentesAd.php'>"; //ComponentesAd cuando este logueado y componentes cuando no lo este
                        echo        "<i class='bx bx-basket icon'></i>";
                        echo        "<span class='text nav-text'>Componentes</span>";
                        echo    "</a>";
                        echo "</li>";
                                
                        
                        } else {
                        echo "<li class='nav-link'>";
                        echo    "<a href='componentes.php'>"; //ComponentesAd cuando este logueado y componentes cuando no lo este
                        echo        "<i class='bx bx-basket icon'></i>";
                        echo        "<span class='text nav-text'>Componentes</span>";
                        echo    "</a>";
                        echo "</li>";
                        }
                        
                        ?>
                    </ul>
                </div>
                
                <div class="bottom-content">
                    <?php
                                
                                if(isset($usuario) != true)
                                {
                                    echo "<li class=''>";
                                    echo    "<a id='form-open'>"; //Cuidado con el href aqui si se pone, lo coge raro y quita el "home show"
                                    echo        "<i class='bx bx-log-in icon'></i>"; 
                                    echo        "<span class='text nav-text'>LogIn</span>";
                                    echo    "</a>";
                                    echo "</li>";
                                } else {
                                    echo "<li class=''>";
                                    echo    "<a id='' href='logout.php'>"; //Cuidado con el href aqui si se pone, lo coge raro y quita el "home show"
                                    echo        "<i class='bx bx-log-out icon'></i>";
                                    echo        "<span class='text nav-text'>Logout</span>";
                                    echo    "</a>";
                                    echo "</li>";

                                }

                    ?>

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

        