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


        $nchipPerro = $_POST['nchip'];
        $nombreFoto = $_FILES['photo']['name'];
        $nombreTemporalFoto = $_FILES['photo']['tmp_name'];
        $ruta = $nombreFoto;
        move_uploaded_file($nombreTemporalFoto,$ruta);
        $perro = new Perro($nchipPerro,$nombrePerro,$fechaNacimiento,$fechaNacimiento,$peso,$idPerrera,$idRaza);
        $foto = new Foto($ruta);

        
        $updatedPerro = $bd->updatePerro($perro,$foto);
        
        if($updatedPerro){
            header("location:../secciones/animales_adopcion.php");
        }

        

        //print_r($_POST);
    }

   
    


?>