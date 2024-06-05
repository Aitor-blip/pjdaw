<?php 
    session_start();
    include_once '../templates/head.php';
    @include_once '../imagenes/variables.php';
    @include_once '../clases/perro.php';
    @include_once '../bd/conexion.php';              
    $bd = new BD();
    $_SESSION['user'] = "logueado";
    $mensaje = "";
    $arrayDataAdoptadoOTramite = $bd->isAdoptado();
    $arrayDatosPerroPropieatrio = $bd->isAdoptadoDni($_SESSION['dni']);
    
?>
    <header>
      <div class="container-fluid">
        <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-center align-items-center">

            <a href="#" class="logo d-flex justify-content-start">
                <img src="../../imagenes/logo.png" class="logo__img" alt="" width="200" height="200">
            </a>

            <ul class="nav navbar-nav d-flex justify-content-end align-items-center w-100">
                  <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>

                  <li class="nav-item mx-2">
                      <a class="nav-link fw-bold text-light" href="<?php 
                      if($_SESSION['menu_lista'][$id]=="Perros"){
                         $file = "animales_adopcion.php";
                         echo $file;
                      }
                      if($_SESSION['menu_lista'][$id]=="Home"){
                        $file = "../../index.php";
                        echo $file;
                     }

                     if($_SESSION['menu_lista'][$id]=="Favoritos"){
                        $file = "favoritos.php";
                        echo $file;
                     }
                     //
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
    <main>
        <div class="container mt-5">
        <div class="row">
        <div class="col-md-4 mt-5">
            <?php
                if($_GET){
                    $nChip = $_GET['nChip'];
                    $_SESSION['nChip'] = $nChip;
                    $ruta = $_GET['ruta'];
                    $perroData = $bd->getPerroByNchip($nChip);
                    $_SESSION['perro_data'] = $perroData;
                }
            ?>
            <img
                src="<?php echo $ruta;?>"
                class="img-fluid rounded-top"
                alt="Dog"
            />
            <div class="mini-imagenes pt-1">
                <img src="<?php echo $ruta;?>" 
                    class="img-fluid"
                    width="150"
                    height="150"
                    alt="Mini imagen">
            </div>
            

        </div>
        <div class="col-sm-8">
            <div class="perro_data">
                <div class="accordion mt-5 mx-3" id="accordionPerroData">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="datosPerro">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Datos del perro
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="datosPerro" data-bs-parent="#accordionPerroData">
                            <div class="accordion-body">
                                     <?php

                                        foreach ($perroData as $perro):
                                            $nombrePerro = $perro['nombrePerro'];
                                            $idRaza = $perro['idRaza']; 
                                            $nombreRaza = $bd->getRazaByPerroIdRaza($idRaza);
                                            $fNacimiento = $perro['fechaNacimiento'];
                                            $idPerrera = $perro['idperrera'];
                                            $peso = $perro['peso'];
                                            $nombrePerrera = $bd->getPerreraById($idPerrera);
                                        endforeach;?>
                                           <div class="perro_data">
                                   
                                       
                                          <p class="fw-bold fs-5">Nombre : <?php echo $nombrePerro; ?></p>
                                            <p class="fw-bold fs-5">Raza : <?php echo  $nombreRaza; ?></p>
                                            <p class="fw-bold fs-5">Perrera : <?php echo  $nombrePerrera; ?></p>
                                            <p class="fw-bold fs-5">Fecha de Nacimiento : <?php echo  $fNacimiento; ?></p>
                                    </div>                                    


                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="" method="post" class="w-100">
                            <input
                                type="submit"
                                class="btn btn-primary w-45 p-5"
                                value="Adoptame">
                                
                            </input>
                            
                        </form>

                        <?php 
                            if(count($arrayDataAdoptadoOTramite)==0  ){
                                if(count($arrayDatosPerroPropieatrio)==0):
                                $perro = new Adopcion($nChip,$_SESSION['dni'],$fNacimiento);
                                $insertado = $bd->insertAdopcionPerro($perro,0,1);
                                if($insertado):
                                $_SESSION['user'] = "solicitador";
                                $_SESSION['logueado'] = true;
                                $bd->updateRolUser($_SESSION['email'],3);
                            ?>
                            <div
                                class="alert alert-success alert-dismissible fade show"
                                role="alert">
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"
                                ></button>
                                <strong>Perro iniciando tramite para adopcion</strong>
                            </div>
                            
                            <script>
                                var alertList = document.querySelectorAll(".alert");
                                alertList.forEach(function (alert) {
                                    new bootstrap.Alert(alert);
                                });
                            </script>

                            <?php else: ?>
                    
                            <div
                                class="alert alert-danger alert-dismissible fade show"
                                role="alert">
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"
                                ></button>
                                <strong><?php echo $bd->errorMessage;?></strong>
                            </div>
                            
                            <script>
                                var alertList = document.querySelectorAll(".alert");
                                alertList.forEach(function (alert) {
                                    new bootstrap.Alert(alert);
                                });
                            </script>

                        <?php 
                        endif;endif;}?>
                    </div>
                </div>

                   
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include '../templates/footer.php';?>

    <footer class="bg-dark footer-menutext-white py-4 mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <ul class="list-unstyled">
                        <li><a href="perro_data.php" class="text-white fs-5">Home</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-unstyled">
                        <li><a href="animales_adopcion.php" class="text-white fs-5">Perros</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-unstyled">
                        <li><a href="politicaPrivacidad.html" class="text-white fs-5">Politica de Privacidad</a></li>
                        <li><a href="perreras.php" class="text-white fs-5">Centros de Adopción</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="mb-0">&copy; 2024 PETSFINDER. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>  

</body>
</html>