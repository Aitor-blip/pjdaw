<?php
    if($_POST){
        $pesoAnimal = $_POST['animalPeso'];
        $nombreRaza = $_POST['raza'];
        header("location:../secciones/animales_adopcion.php?peso=$pesoAnimal&&raza=$nombreRaza");
    }
?>