<?php
    session_start();
    include_once "bbdd.php";
    $sesionCorrecta = login($_POST["usuario"], $_POST["password"]);

    if($sesionCorrecta)
    {
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["id_usuario"] = $sesionCorrecta;

        header("location: indexAd.php");
    } else
    {
        header("location: index.php");
        
    }
?>