<?php
  session_start();
  @include_once '../templates/head.php';
  @include_once '../clases/menu.php';
  @include_once '../imagenes/variables.php';
  @include_once '../bd/conexion.php';
  @include_once '../clases/gestionPerros.php';
  @$logueado = $_SESSION['logueado'];
  if($_SESSION['logueado']==null){
    $logueado=0;
  }
  $bd = new BD();
  $perros = $bd->getPerrosParaAdoptar();
  if(@$_GET['logueado']==1){
    
    @$_SESSION['user'] = "logueado";
    
  }else{
    @$_SESSION['logueado'] =false;
    @$_SESSION['user'] =="invitado";
  }   
  
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
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-center align-items-center">

        <a href="#" class="logo d-flex justify-content-start">
          <img src="../../imagenes/logo.png" class="logo__img" alt="" width="200" height="200">
        </a>

        <ul class="nav navbar-nav d-flex justify-content-end align-items-center w-100">
              <?php foreach($_SESSION['menu_lista'] as $id=>$item): 
                    
                                
                    if($_SESSION['menu_lista'][$id]=="Perros"){
                        $file = "animales_adopcion.php?logueado=$logueado";
                    }
                    if($_SESSION['menu_lista'][$id]=="Home"){
                    $file = "../../index.php";
                    }
                    if($_SESSION['menu_lista'][$id]=="Cerrar Sesion"):
                      session_destroy();
                      $logueado=1;
                      $file = "../../index.php?logueado=$logueado";
                    endif;
                    //
                    if($_SESSION['menu_lista'][$id]=="Centros de adopcion"):
                    $file = "perreras.php";
                endif;    
                        
                    ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-light fs-6" href="<?php echo $file;?>"><?php echo $_SESSION['menu_lista'][$id];?></a>
                    </li>
                    <?php endforeach; ?>    
              </ul>
          </nav>
    
    </header>

    <main>
      <div class="container">
        <div class="row">
          <div class="col-md-3 mt-5">
              <h2 class="text-center fs-3">Filtros de búsqueda</h2>
              <form action="" method="post">
                <div class="container">
                <div class="campos w-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="mb-3 w-100">
                      <label for="ciudad" class="form-label">Ciudad</label>
                      <input
                        type="text"
                        class="form-control"
                        name="ciudad"
                        placeholder="Introduce la ciudad"/>
                    </div>



                    <div class="mb-3 w-100">
                      <label for="raza" class="form-label">Raza</label>
                      <select
                      class="form-select" aria-label="Default select example"
                        name="raza"
                        id="razas">
                        <option selected>Pastor Belga</option>
                        <option value="malinois">Malinois</option>
                      </select>
                    </div>

                    
                    <div class="sizes w-100 pt-2">
                      <h3 class="text-center">Tamaños</h3>
                        <div class="form-check">
                          <input class="form-check-input" name="grande" type="checkbox" value="Grande"/>
                          <label class="form-check-label" for="grande">Grande</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" name="mediano" type="checkbox" value="Grande"/>
                          <label class="form-check-label" for="mediano">Mediano</label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" name="small" type="checkbox" value="Grande"/>
                          <label class="form-check-label" for="small">Pequeño</label>
                        </div>
                        
                        
                        
                      </h3>
                    </div>


                    <div class="edades w-100 pt-2">
                      <h3 class="text-center">Edad</h3>
                        <div class="form-check">
                          <input class="form-check-input" name="cachorro" type="checkbox" value="Grande"/>
                          <label class="form-check-label" for="cachorro">Cachorro</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" name="adulto" type="checkbox" value="Grande"/>
                          <label class="form-check-label" for="adulto">Adulto</label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" name="joven" type="checkbox" value="Grande"/>
                          <label class="form-check-label" for="joven">Joven</label>
                        </div>
                      </h3>
                    </div>
                    
                  </div>
                </div>
                <input type="submit" class="btn btn-primary mt-3 mx-3" value="Buscar">
              </form>
          </div>
          <div class="col-md-9 pt-5 d-flex flex-row justify-content-start align-items-center">
            

            <div class="col-9">
            <?php
                    if(count($perros)>0): 
                      foreach($perros as $id=>$perro):
                        @$nChip = $perros[$id]['nChip']; 
                        $nombre = $perros[$id]['nombrePerro'];
                        $idRaza = $perros[$id]['idRaza'];
                        $nombreRaza = $bd->getRazaByPerroIdRaza($idRaza);
                        $fotos = $bd->getFotosByNchip($nChip); 
                        $rutaBase = trim(isset($fotos['ruta'])?$fotos['ruta']:'');
                        $ruta = "../../imagenes/".$rutaBase;?>
            <div class="card" style="width: 18rem;">
            <?php if(!isset($ruta) || !isset($rutaBase)){

              }else{?>
              <img src=<?php echo $ruta;?> class="card-img-top" alt="...">
              <?php  } ?>
              <div class="card-body">
                <p class="card-text">Nombre : <strong><?php echo $nombre;?></strong></p>
                <p class="card-text">Raza : <strong><?php echo $nombreRaza;?></strong></p>
              <?php if($_SESSION['user'] == "logueado"){?>
                <a href="perro_data.php?nChip=<?php echo $nChip;?> &ruta=<?php echo $ruta;?>" class="btn btn-primary">Ver Más</a>
                <?php }else{?>
                <?php if($_SESSION['user']=="invitado"){}} ?>

              </div>
              <?php endforeach;endif;?>
                 
            </div>
          
                
            </div>
            </div>
            

            
          </div>
        </div>
        </main>

    
</body>
</html>