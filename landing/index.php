<?php
    include_once '../admin/bd/conexion.php';
    $conexion = bd::crearInstancia();


    $sql="select * from perro";
    $listaPerros = bd::consultar($sql);
    $listaPerrosSinAdoptar = bd::getPerrosSinAdoptar();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Dog Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    

<div class="container">
    <div class="container col-4 col-md-4"></div>
    <div class="container col-4 col-md-4">
        <div class="card">
            <div class="card-header">Dog</div>
            <div class="card-body">
                <?php foreach($listaPerros as $perro){?>
                    <h2 class="card-title">Nombre : <?php echo $perro['nombrePerro']?></h2>
                <?php } ?>
            </div>
        </div>
        
    </div>
    <div class="container col-4 col-md-4"></div>
</div>
</body>
</html>












