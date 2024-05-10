<?php

    include_once '../snippets/clases.php';
    include_once '../bd/conexion.php';

    $bd = new BD();

    $nchipPerro = isset($_POST['nchip'])?$_POST['nchip']:'';
    $nombrePerro = isset($_POST['nombre'])?$_POST['nombre']:'';
    $fechaNacimientoPerro = isset($_POST['fnac'])?$_POST['fnac']:'';
    $raza = isset($_POST['raza'])?$_POST['raza']:'';
    $perrera = isset($_POST['perrera'])?$_POST['perrera']:'';
    $peso = isset($_POST['peso'])?$_POST['peso']:0; 
    $dni = isset($_POST['dni'])?$_POST['dni']:'';


        $nombreFoto = $_FILES['photo']['name'];
        $nombreTemporalFoto = $_FILES['photo']['tmp_name'];
        $ruta = "../imagenes/img_bd/$nombreFoto";
        move_uploaded_file($nombreTemporalFoto,$ruta);
        $foto = new Foto($nombreFoto);
        $propietario = new Propietario($dni);
        $perro = new Perro($nchipPerro,$nombrePerro,$fechaNacimientoPerro,$fechaNacimientoPerro,$peso,$perrera,$raza);
        $insertado = $bd->insertPerro($nchipPerro,$perro,$foto,$propietario);
        if($insertado){
                @$_SESSION['logueado'] = true;
                @$_SESSION['dni'] = $dni;
                header("location:../../index.php");
        }

    
    















?>