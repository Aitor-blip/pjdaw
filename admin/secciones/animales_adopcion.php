<?php
  session_start();
  @include_once '../templates/headnocss.php';
  @include_once '../clases/menu.php';
  @include_once '../imagenes/variables.php';
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
                      ?>"><?php echo $_SESSION['menu_lista'][$id];?></a>
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
          <div class="col-md-9 pt-5">
            <div class="perros d-flex justify-content-center align-items-center">
              <div class="card mx-2">
                <img class="card-img-top" src="<?php echo ADOPCION;?>dog1.jpg" alt="Dog"  width="200"/>
                <div class="card-body">
                  <div class="perro">
                    <h4 class="card-title perro__nombre">Nombre</h4>
                    <p class="card-text perro__raza">Raza</p>
                    <a
                      name="ver_mas"
                      class="btn btn-primary"
                      href="#"
                      role="button">Leer Más</a>
                    
                  </div>
                  
                </div>
              </div>
              <div class="card mx-2">
                <img class="card-img-top" src="<?php echo ADOPCION;?>dog1.jpg" alt="Dog"  width="200"/>
                <div class="card-body">
                  <div class="perro">
                    <h4 class="card-title perro__nombre">Nombre</h4>
                    <p class="card-text perro__raza">Raza</p>
                    <a
                      name="ver_mas"
                      class="btn btn-primary"
                      href="#"
                      role="button">Leer Más</a>
                    
                  </div>
                  
                </div>
              </div>
              <div class="card mx-2">
                <img class="card-img-top" src="<?php echo ADOPCION;?>dog1.jpg" alt="Dog"  width="200"/>
                <div class="card-body">
                  <div class="perro">
                    <h4 class="card-title perro__nombre">Nombre</h4>
                    <p class="card-text perro__raza">Raza</p>
                    <a
                      name="ver_mas"
                      class="btn btn-primary"
                      href="#"
                      role="button">Leer Más</a>
                    
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