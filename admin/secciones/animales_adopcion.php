<?php
  session_start();
  @include_once '../templates/headnocss.php';
  @include_once '../clases/menu.php';
  @include_once '../imagenes/variables.php';
  @include_once '../bd/conexion.php';
  @include_once '../clases/gestionPerros.php';
  $logueado = $_SESSION['logueado'];
  $bd = new BD();
  if(@$_GET['logueado']==1){
    $perros = $bd->getPerrosPropietario($_SESSION['dni']);
    @$_SESSION['logueado'] = true;
  }else{
    $perros = $bd->consultar("select * from perro");
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
          <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end align-items-center">
              <ul class="nav navbar-nav">
              <?php foreach($_SESSION['menu_lista'] as $id=>$item): 
                    
                                
                    if($_SESSION['menu_lista'][$id]=="Perros"){
                        $file = "animales_adopcion.php?logueado=$logueado";
                    }
                    if($_SESSION['menu_lista'][$id]=="Home"){
                    $file = "../../index.php";
                    }
    
                    if($_SESSION['menu_lista'][$id]=="Favoritos"){
                    $file = "favoritos.php";
                    }
                    //
                    if($_SESSION['menu_lista'][$id]=="Centros de adopcion"):
                    $file = "perreras.php";
                endif;    
                        
                    ?>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-light" href="<?php echo $file;?>"><?php echo $_SESSION['menu_lista'][$id];?></a>
                    </li>
                    <?php endforeach; ?>    
                  </div>
              </ul>
          </nav>
        
        </div>
      </div>
    
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
      
           <div class="col-3 col-sm-2">
              <div class="mb-3">
                  <a href="crearPerro.php" class="btn btn-primary">Crear Perro</a>
                </div>
            </div>

            <div class="col-9 col-sm-11 sm-d-flex sm-flex-column d-flex flex-wrap flex-row justifiy-content-between align-items-center">
                <?php 
                  if(count($perros)>0): 
                    foreach($perros as $id=>$perro):
                      $nChip = $perros[$id]['nChip']; 
                      $nombre = $perros[$id]['nombrePerro'];
                      $idRaza = $perros[$id]['idRaza'];
                      $raza = $bd->getRazaByPerroIdRaza($idRaza);
                      $nombreRaza = $raza['nombreRaza'];
                      $fotos = $bd->getFotosByNchip($nChip); 
                      $rutaBase = trim(isset($fotos['ruta'])?$fotos['ruta']:'');
                      $ruta = "../imagenes/img_bd/".$rutaBase;
                    endforeach;
                  
                  ?>

            <div class="col-sm-4 m-5">
                <div class="perros">
                <div class="card mx-2">  
                  <div class="perro">
                  

                  <?php if(!isset($ruta) || !isset($rutaBase)){

                    }else{?>
                      <img class="card-img-top" src="<?php echo $ruta;?>" alt="Dog"  width="200"/>
                      <div class="card-body">
                    <?php  } ?>
                    
                      <h4 class="card-title perro__nombre">Nombre <span class="fw-bold"><?php echo $nombre ?></span></h4>
                      <p class="card-text perro__raza">Raza <span class="fw-bold"><?php echo $nombreRaza ?></span></p>
                      <input type="hidden" value=">" name="nChip"/>
                      <div class="botones d-flex justify-content-center">
                        <a
                        name="ver_mas"
                        class="btn btn-primary"
                        href="perro_data.php?nChip=<?php echo $nChip;?> &&ruta=<?php echo $ruta;?>"
                        role="button">Ver Más</a>
                      </div>
                      <?php       
                        else:?>
                          <h2>No hay perros</h2>
                        <?php
                        endif;
                      ?>
                      
                    </div>
                    
                  </div>
                  
                </div>
                
              </div>
            </div>
            

            
          </div>
            </div>

            
          

        
        </div>
      </div>
    </main>

    
</body>
</html>