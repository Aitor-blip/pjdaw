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
    $nombreFotoBd = $bd->getFotoByNChip($nchip);
    @$nombreFoto = $_FILES["foto"]["name"];
    $_SESSION['foto'] = $nombreFoto;
    @$imagenTemporal = $_FILES["foto"]["tmp_name"];
    if($nombreFoto==null || $nombreFoto==""){
        $nombreFoto = $nombreFotoBd;
    }else{
        @$ruta = "../../../../imagenes/img_bd/".$nombreFotoBd;
        $_SESSION['ruta'] = $ruta;
        if($ruta == null || $ruta == ""){
            $ruta = $_SESSION['ruta'];
        }
    }
    if($adoptadoPost != "on"){
        $tramite = 1;
        $adoptado = 0;
    }else{
        $tramite=0;
        $adoptado = 1;
    }


 switch($accion){
     case 'Agregar':
         $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
         $perroInsertado = $bd->insertPerro($nchip,$_SESSION['dni'],$perro,$nombreFoto);
     break;
     case 'Modificar':
        $perro = new Perro($nombre,$fNac,$fEntr,$peso,$idPerrera,$idRaza);
        $perroModificado = $bd->updatePerroTramiteAdopcion($nchip,$perro,$adoptado,$tramite,$_SESSION['dni'],$nombreFoto);
        break;
     case 'Eliminar':
         $bd->deletePerro($nchip,$_SESSION['dni']);
         break; 
     }
    }
?>