<?php
  session_start();
  @include_once '../templates/headnocss.php';
  @include_once '../clases/menu.php';
  @include_once '../imagenes/variables.php';
  @include_once '../clases/editarPerro.php';
  @include_once '../bd/conexion.php';                
  $bd = new BD();
  $listaPerreras = $bd->getPerreras();
  $listaRazas = $bd->getRazas();

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales de Adopcion</title>
    <link rel="icon" href="../../imagenes/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="">
    <header>
      <div class="container-fluid">
        <div class="row">
          <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end align-items-center">
              <ul class="nav navbar-nav">
                  <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>

                  <li class="nav-item mx-2">
                      <a class="nav-link fw-bold text-light" href="<?php 
                      if($_SESSION['menu_lista'][$id]=="Perros"){
                         $file = "animales_adopcion.php";
                         echo $file;
                      }
                      if($_SESSION['menu_lista'][$id]=="Centros de adopcion"):
                        $file = "perreras.php";
                        echo $file;
                    endif;

                      ?>"><?php 
                      if($_SESSION['menu_lista'][$id]=="Favoritos"):?>
                        <img src="<?php echo "../imagenes/svg/heart.svg"?>" alt="">
                        <?php
                        else:
                             echo $_SESSION['menu_lista'][$id];
                        
                        endif;?>
                      </a>
                  </li>

                  

                  <?php endforeach; ?>     
                  </div>
              </ul>
          </nav>
        
        </div>
      </div>
    
    </header>


    <body>
      <main>

        <div class="container mt-5">
          <div class="row">
            <div class="col-12">
              <form action="" method="post" enctype="multipart/form-data">

                <?php foreach($_SESSION['perro_data'] as $perro):
                    $nChip = $perro['nChip'];
                    $nombre = $perro['nombrePerro'];
                    $idRaza = $perro['idRaza']; 
                    $raza = $bd->getRazaByPerroIdRaza($idRaza);
                    @$nombreRaza = $raza['nombreRaza'];
                    $peso = $perro['peso'];
                    $fNacimiento = $perro['fechaNacimiento'];
                    $idPerrera = $perro['idperrera'];
                    $perrera = $bd->getPerreraById($idPerrera);
                    @$nombrePerrera = $perrera[$id]['nombrePerrera'];
                    $peso = $perro['peso'];
                endforeach;?>
              
                <div class="mb-3">
                    <label for="nchip" class="form-label">NChip</label>
                    <input
                      type="number"
                      class="form-control"
                      name="nchip"
                      aria-describedby="helpId"
                      placeholder=""
                      value="<?php echo $nChip;?>"                    />
                    <small id="helpId" class="form-text text-muted">Solo numeros</small>
                  </div>

                  <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del perro</label>
                    <input
                      type="text"
                      class="form-control"
                      name="nombre"
                      aria-describedby="helpId"
                      placeholder=""
                      value="<?php echo $nombre;?>"
                    />
                  </div>

                  <div class="mb-3">
                    <label for="fnac" class="form-label">Fecha de Nacimiento</label>
                    <input
                      type="date"
                      class="form-control"
                      name="fnac"
                      aria-describedby="helpId"
                      placeholder=""
                      value="<?php echo $fechaNacimientoPerro;?>"
                    />
                  </div>


                 <div class="mb-3">
                    <label for="photo" class="form-label">Foto/s del perro</label>
                    <input
                      type="file"
                      class="form-control"
                      name="photo"
                      accept="image/png, image/jpeg"
                    />
                  </div>


                  <div class="mb-3">
                    <label for="raza" class="form-label">Raza del perro</label>
                    <select
                      class="form-select form-select-lg"
                      name="raza"
                      id="razas"
                    >
                    <?php 
                        foreach($listaRazas as $raza){
                          $nombreRaza = $raza['nombreRaza'];
                          $idraza = $raza['idraza'];?>
                        <option value="<?php echo $idraza;?>"><?php echo $nombreRaza;?></option>
                        <?php }?>
                        ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="perrera" class="form-label">Perrera</label>
                    <select
                      class="form-select form-select-lg"
                      name="perrera"
                      id="perrera"
                    >
                      <?php 
                        foreach($listaPerreras as $perrera){
                          $nombrePerrera = $perrera['nombrePerrera'];
                          $idperrera = $perrera['idperrera'];?>
                        <option value="<?php echo $idperrera;?>"><?php echo $nombrePerrera;?></option>
                        <?php }?>
                        ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="peso" class="form-label">Peso del perro</label>
                    <input
                      type="number"
                      class="form-control"
                      name="peso"
                      placeholder="0"
                      value="<?php echo $peso;?>"
                    />
                    <small id="helpId" class="form-text text-muted">Solo numeros</small>

                  </div>
                  
                  

                  <input type="submit" value="Actualizar Perro" class="btn btn-primary">
                  
              </form>
            </div>
          </div>
        </div>
























      </main>
    </body>
  </html>
    