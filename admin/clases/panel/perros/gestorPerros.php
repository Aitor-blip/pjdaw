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

 switch($accion){
     case 'Agregar':
         $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
         $perroInsertado = $bd->insertPerro($nchip,$_SESSION['dni'],$perro);
     break;
     case 'Modificar':
         //$perrera = new Perrera($nombrePerrera,$nPerrosPerrera,$direccion,$valoracion);
        // $perreraModificada = $bd->updatePerrera($perrera,$idPerrera);
         break;
     case 'Eliminar':
         //$bd->deletePerrera($idPerrera);
         break; 
     }
    }
?>