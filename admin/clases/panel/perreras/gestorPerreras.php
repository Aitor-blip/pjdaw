<?php
    @include_once '../../../bd/conexion.php';
    @include_once '../../../clases/perrera.php';
    $bd = new BD();
    if($_POST){
    $accion = $_POST['accion'];
    $nombrePerrera = $_POST['nombre'];
    $nPerrosPerrera = $_POST['nperros'];
    $direccion = $_POST['pais'];
    $valoracion = $_POST['valoracion'];
    $idPerrera = $_POST['idPerrera'];
    @$listaPerrerasPorId = $bd->getPerreraById($idPerrera);

    switch($accion){
        case 'Agregar':
            $perrera = new Perrera($nombrePerrera,$nPerrosPerrera,$direccion,$valoracion);
            $perreraInsertada = $bd->insertPerrera($perrera);
        break;
        case 'Modificar':
            $perrera = new Perrera($nombrePerrera,$nPerrosPerrera,$direccion,$valoracion);
            $perreraModificada = $bd->updatePerrera($perrera,intval($idPerrera));
            break;
        case 'Eliminar':
            $bd->deletePerrera($idPerrera);
            break; 
        }
    }
?>