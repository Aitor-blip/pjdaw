<?php
    session_start();
    include_once '../bd/conexion.php';

    $bd = new BD();

   
/*
        $nchipPerro = isset($_POST['nchip'])?$_POST['nchip']:'';
        $nombrePerro = isset($_POST['nombre'])?$_POST['nombre']:'';
        $fechaNacimientoPerro = isset($_POST['fnac'])?$_POST['fnac']:'';
        $raza = isset($_POST['raza'])?$_POST['raza']:1;
        $perrera = isset($_POST['perrera'])?$_POST['perrera']:1;
        $peso = isset($_POST['peso'])?$_POST['peso']:0; 


        $nombreFoto = $_FILES['photo']['name'];
        $nombreTemporalFoto = $_FILES['photo']['tmp_name'];
        $ruta = "../imagenes/img_bd/$nombreFoto";
        move_uploaded_file($nombreTemporalFoto,$ruta);
        $foto = new Foto($nombreFoto);
        $propietario = new Propietario($_SESSION['dni']);
        $perro = new Perro($nombrePerro,$fechaNacimientoPerro,$fechaNacimientoPerro,$peso,$perrera,$raza);
        $insertado = $bd->insertPerro($nchipPerro,$perro,$foto,$propietario);
        if($insertado){
                @$_SESSION['logueado'] = true;
                header("location:../../index.php");
        }
        */
    
    
 
    















?>