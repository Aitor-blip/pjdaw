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


    $nombreFotoBd = $bd->getFotoByNChip($nchip);
    $nombreFoto = $_FILES["foto"]["name"];
    $imagenTemporal = $_FILES["foto"]["tmp_name"];
    $ruta = "../../../../imagenes/img_bd/".$nombreFoto;
    
   
    $adoptado = 0;
    if($adoptadoPost != "on"){
        $tramite =0;
    }else{
        $tramite=1;
    }
 switch($accion){
     case 'Agregar':
         if(move_uploaded_file($imagenTemporal, $ruta)){
            $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
            $perroInsertado = $bd->insertPerro($nchip,$_SESSION['dni'],$perro,$nombreFoto);
         }
     break;
     case 'Modificar':
        if(move_uploaded_file($imagenTemporal, $ruta)){
            $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
            $perroModificado = $bd->updatePerro($nchip,$perro,$adoptado,$tramite,$_SESSION['dni'],$nombreFoto);
        }
         break;
     case 'Eliminar':
         $bd->deletePerro($nchip);
         break; 
     }
    }
?>