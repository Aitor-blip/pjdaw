<?php
    
    include_once '../snippets/clases.php';
    include_once '../bd/conexion.php';

    $bd = new BD();
    
    $fechaNacimiento = date('Y-m-d');
    $idRaza = isset($_POST['raza'])?$_POST['raza']:'';
    $idPerrera = isset($_POST['perrera'])?$_POST['perrera']:'';
    $peso = isset($_POST['peso'])?$_POST['peso']:'';

    if($_POST){

        $nombrePerro = $_POST['nombre'];
        $nchipPerro = $_POST['nchip'];
        $nombreFoto = $_FILES['photo']['name'];
        $nombreTemporalFoto = $_FILES['photo']['tmp_name'];
        $ruta = $nombreFoto;
        move_uploaded_file($nombreTemporalFoto,$ruta);
        $perro = new Perro($nombrePerro,$fechaNacimiento,$fechaNacimiento,$peso,$idPerrera,$idRaza);
        $foto = new Foto($ruta);

        print_r($_POST);
        
        $updatedPerro = $bd->updatePerro($nchipPerro,$perro,$foto);
        
        if($updatedPerro){
            header("location:../secciones/animales_adopcion.php");
        }

        

        //print_r($_POST);
    }

   
    


?>