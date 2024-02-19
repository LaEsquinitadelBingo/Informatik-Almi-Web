<?php
include("bbdd.php");

quitar_Disponibilidad($_POST['ID_PRODUCTO']);
header("Location:componentesDel.php");
    
?>
