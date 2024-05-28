<?php
 session_start();
 @include_once '../../../bd/conexion.php';
 @include_once '../../../clases/perro.php';
 $bd = new BD();

 if($_POST){
     $nchip = $_POST['nChip'];
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'];
    $fNac = $_POST['fNac'];
    $fEntr = $_POST['fEntr'];
    $idPerrera = $_POST['perrera'];
    $peso = $_POST['peso'];
    $idRaza = $_POST['raza'];
    $adoptadoPost = $_POST['adoptado'];
    $enTramitePost = $_POST['tramite'];
    if($adoptadoPost != "on"){
        $adoptado=1;
        $tramite=0;
    }else{
        $adoptado = 0;
        $tramite = 0;
    }


 switch($accion){
     case 'Agregar':
         $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
         $perroInsertado = $bd->insertPerro($nchip,$_SESSION['dni'],$perro);
     break;
     case 'Modificar':
        $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
        $perroModificado = $bd->updatePerroDevolver($nchip,$perro,$adoptado,$tramite,$_SESSION['dni']);
        if($perroModificado){
            header("Location:../index.php");
        }
        break;
     case 'Eliminar':
         $bd->deletePerro($nchip,$_SESSION['dni']);
         break; 
     }
    }
?>