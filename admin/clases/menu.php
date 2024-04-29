<?php
    if($_GET['token']!=null){
        if($_SESSION['user'] == "usuario" || $_SESSION['user'] =="invitado"){
            $_SESSION['menu_lista'] = array();
            array_push($_SESSION['menu_lista'] , "Perros");
            array_push($_SESSION['menu_lista'] , "Adopta");
            array_push($_SESSION['menu_lista'] , "Centros de adopcion");
        }
    }
?>