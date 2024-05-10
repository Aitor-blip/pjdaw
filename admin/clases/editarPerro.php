<?php
    
    include_once '../snippets/clases.php';
    include_once '../bd/conexion.php';

    $bd = new BD();
    
    $nChip = isset($_POST['nchip'])?$_POST['nchip']:'';
    $nombrePerro = isset($_POST['nombre'])?$_POST['nombre']:'';
    $fechaNacimiento = date('Y-m-d');
    $idRaza = isset($_POST['raza'])?$_POST['raza']:'';
    $idPerrera = isset($_POST['perrera'])?$_POST['perrera']:'';
    $peso = isset($_POST['peso'])?$_POST['peso']:'';

    if($_POST){
        $perro = new Perro($nChip,$nombrePerro,$fechaNacimiento,$fechaNacimiento,$peso,$idPerrera,$idRaza);

        $bd->updatePerro($perro);
    
        $updatedPerro = $bd->updatePerro($perro);
        
        if($updatedPerro){
            header("location:../secciones/animales_adopcion.php");
        }
    }

   
    


?>