<?php 
    session_start();
    $idRol = $_GET['idRol'];
    $ruta = $_GET['ruta'];
    echo $idRol;
    echo $ruta;
    session_destroy();
    header("location:".$ruta);
    

        

    