<?php
    session_start();
    include_once '../bd/conexion.php';
    $nchip = isset($_GET['nchip'])?$_GET['nchip']:'';
    $bd = new BD();
  
  
    $isPerroDeleted = $bd->deletePerro($nchip,$_SESSION['dni']);
    if($isPerroDeleted){
        header("location:../secciones/animales_adopcion.php");
    }


?>