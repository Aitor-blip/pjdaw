<?php
        $_SESSION['menu_lista'] = array();
        if($_SESSION['user'] == "usuario" || $_SESSION['user'] =="invitado"){
            
            foreach($_SESSION['menu_lista'] as $id=>$valor){
                unset($_SESSION['menu_lista'][$id]);
            }
            array_push($_SESSION['menu_lista'] , "Home");
            array_push($_SESSION['menu_lista'] , "Perros");
            array_push($_SESSION['menu_lista'] , "Centros de adopcion");
            array_push($_SESSION['menu_lista'] , "Favoritos");
        }

        if($_SESSION['user'] == "logueado"){
            foreach($_SESSION['menu_lista'] as $id=>$valor){
                unset($_SESSION['menu_lista'][$id]);
            }
            array_push($_SESSION['menu_lista'] , "Home");
            array_push($_SESSION['menu_lista'] , "Perros");
            array_push($_SESSION['menu_lista'] , "Centros de adopcion");
            array_push($_SESSION['menu_lista'] , "Favoritos");
            array_push($_SESSION['menu_lista'] , "Cerrar Sesion");
        }


        if($_SESSION['user'] == "solicitador"){
            foreach($_SESSION['menu_lista'] as $id=>$valor){
                unset($_SESSION['menu_lista'][$id]);
            }
            array_push($_SESSION['menu_lista'] , "Home");
            array_push($_SESSION['menu_lista'] , "Perros");
            array_push($_SESSION['menu_lista'] , "Centros de Adopcion");
            array_push($_SESSION['menu_lista'] , "Tus Perros");
            array_push($_SESSION['menu_lista'] , "Cerrar Sesion");
        }


        if($_SESSION['user'] == "administrador"){
            foreach($_SESSION['menu_lista'] as $id=>$valor){
                unset($_SESSION['menu_lista'][$id]);
            }
            array_push($_SESSION['menu_lista'] , "Home");
            array_push($_SESSION['menu_lista'] , "Perreras");
            array_push($_SESSION['menu_lista'] , "Perros");
            array_push($_SESSION['menu_lista'] , "Perros Sin Adoptar");
            array_push($_SESSION['menu_lista'] , "Perros En Tramite de Adopcion");
            array_push($_SESSION['menu_lista'] , "Perros Adoptados");
            array_push($_SESSION['menu_lista'] , "Usuarios");
            array_push($_SESSION['menu_lista'] , "Cerrar Sesion");
        }
        
        
        
?>
        
