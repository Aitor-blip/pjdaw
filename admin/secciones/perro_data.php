<?php 
    session_start();
    include_once '../templates/headnocss.php';
    @include_once '../imagenes/variables.php';
    @include_once '../clases/gestionPerros.php';
    @include_once '../bd/conexion.php';              
    $bd = new BD();
    $mensaje = "";
    $insertado = $bd->insertPerroUsuario($_SESSION['nChip'],$_SESSION['dni'],1);
    if($insertado){
        $updatedRolUser = $bd->updateRolUser($_SESSION['email'],3);
    }else{
        $mensaje = "Fallo al adoptar.Consulte con el administrador";
    }
?>
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
                                <div class="perro_data">
                                    <?php
                                        $perroData = $bd->getPerroByNchip($nChip);
                                        $_SESSION['perro_data'] = $perroData;
                                        foreach ($perroData as $id=>$perro):
                                            $nombre = $perroData[$id]['nombrePerro'];
                                            $idRaza = $perroData[$id]['idRaza']; 
                                            $raza = $bd->getRazaByPerroIdRaza($idRaza);
                                            $nombreRaza = $raza['nombreRaza'];
                                            $peso = $perroData[$id]['peso'];
                                            $fNacimiento = $perroData[$id]['fechaNacimiento'];
                                            $idPerrera = $perroData[$id]['idperrera'];
                                            $perrera = $bd->getPerreraById($idPerrera);
                                            $nombrePerrera = $perrera[$id]['nombrePerrera'];
                                        endforeach;
                                    ?>

                                    <p class="fw-bold fs-5">Nombre : <?php echo  $nombre ?></p>
                                    <p class="fw-bold fs-5">Raza : <?php echo  $nombreRaza ?></p>
                                    <p class="fw-bold fs-5">Perrera : <?php echo  $nombrePerrera ?></p>
                                    <p class="fw-bold fs-5">Fecha de Nacimiento : <?php echo  $fNacimiento ?></p>


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
                            <input
                                type="submit"
                                class="btn btn-primary w-45 p-5"
                                value=" Añadir a favoritos">
                               
                            </input>
                            
                        </form>

                        <?php if($insertado):?>
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
                            
                        <?php else:?>

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

                        <?php endif;?>
                    </div>
                </div>

                   
                </div>
            </div>
        </div>
        </div>
    </main>
    
</div>

<?php include '../templates/footer.php';?>