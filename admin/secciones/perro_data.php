<?php 
    session_start();
    include_once '../templates/head.php';
    include_once '../imagenes/variables.php';
    include_once '../clases/perro.php';
    include_once '../bd/conexion.php';              
    $bd = new BD();
    @$dni = $_SESSION['dni'];
    if (!isset($_SESSION['dni'])) {
      // Asignar valor a la variable de sesión solo una vez
      $_SESSION['dni'] = $dni;
      $logueado=0;
    }

    if(isset($_SESSION['dni'])){
        $dni = $_SESSION['dni'];
        $idRol = $bd->getIdRolUserByDni($dni);
        $rol = $bd->getRolByIdRol($idRol);
        $logueado = 1;
    }

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

            <ul class="nav navbar-nav d-flex justify-content-end align-items-center w-100 me-5">

    <?php if(isset($_SESSION['dni'])){?>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="menu_usuario.php?logueado=<?php echo $logueado;?>">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="perreras.php?logueado=<?php echo $logueado;?>">Perreras</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="animales_adopcion.php?logueado==<?php echo $logueado;?>">Perros</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../clases/cerrarSesion.php?idRol=<?php echo $idRol;?>&&ruta=<?php echo "../../index.php";?>">Cerrar Sesión</a>
                </li>
              <?php }else{?>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../../index.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="perreras.php?logueado=<?php echo $logueado;?>">Perreras</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="animales_adopcion.php?logueado==<?php echo $logueado;?>">Perros</a>
                </li>
                <?php } ?>        

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
                                $perro = new Adopcion($nChip,$_SESSION['dni'],$fNacimiento);
                                $insertado = $bd->insertAdopcionPerro($perro,0,1);
                                if($insertado):
                            ?>

                                <div class="alert alert-success" role="alert">
                                     Perro solicitado
                                </div>
                            <?php else:?>
                            <div class="alert alert-warning" role="alert">
                               Fallo al adoptar al perro
                            </div>
                        <?php endif;?>

                         
                            
                            
                    </div>
                </div>

                   
                </div>
            </div>
        </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>