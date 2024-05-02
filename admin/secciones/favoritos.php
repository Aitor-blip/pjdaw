<?php
    session_start();
    include_once '../templates/headnocss.php';
    @include_once '../imagenes/variables.php';
    @include_once '../bd/conexion.php';              
    $bd = new BD();
?>
<header>
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
</header>

<main>
    <div class="container mt-5">
        <?php 
            //Listar los perros favoritos acumulados
            if($_GET):
                $nChip = $_GET["nchip"];
                $ruta = $_GET["ruta"];
                $perroData = $bd->getPerroByNchip($nChip);
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
                endforeach;?>

        <div class="row">
            <div class="col-12 col-md-8 col-sm-6 d-flex flex-row justify-content-start align-items-center">
                <div class="col-sm-6">
                    <img class="img-fluid" src="<?php echo $ruta;?>" alt="Dog">
                </div>
                <div class="col-sm-6 w-100">
                <div class="accordion mx-3" id="accordionPerroData">
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
                </div>
            </div>
        </div>
        <?php else :?>
            <h1 class="text-center">No hay perros como favoritos</h1>
        <?php endif ;?>
    </div>
</main>
<?php include_once '../templates/footer.php';?>
          