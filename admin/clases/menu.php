<?php
        if($_SESSION['user'] == "usuario" || $_SESSION['user'] =="invitado"){
            $_SESSION['menu_lista'] = array();
            array_push($_SESSION['menu_lista'] , "Home");
            array_push($_SESSION['menu_lista'] , "Perros");
            array_push($_SESSION['menu_lista'] , "Centros de adopcion");
            array_push($_SESSION['menu_lista'] , "Favoritos");
        }

        if($_SESSION['logueado']){
            array_push($_SESSION['menu_lista'] , "Cerrar Sesion");
        }
        
        
        
?>
        
