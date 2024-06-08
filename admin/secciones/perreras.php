<?php
    session_start();
    include_once '../templates/head.php';
    @include_once '../imagenes/variables.php';
    @include_once '../bd/conexion.php';              
    $bd = new BD();
    $dni = $_SESSION['dni'];
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



?>
<header>
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
</header>

<main>
    <div class="container-fluid mt-5">
      <div class="row">
      <?php 
                //Listar los perros favoritos acumulados
                $perreras = $bd->getPerreras();
                if(count($perreras)>0):
                    
                    foreach ($perreras as $id=>$perrera):
                    $idPerrera = $perreras[$id]['idperrera'];
                    $nombrePerrera = $perreras[$id]['nombrePerrera'];
                    $nPerros = $perreras[$id]['nPerros'];
                    $ubicacion = $perreras[$id]['ubicacion'];
                    $valoracion = $perreras[$id]['valoracion'];?> 
            <div class="col-12 col-md-8 w-100 col-sm-6 d-flex flex-row justify-content-start align-items-center">
           
                <div class="accordion mt-5 mx-3 w-100" id="accordionPerroData">
                    <div class="accordion-item w-100">
                        <h2 class="accordion-header" id="datosPerro">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Datos de la perrera <?php echo $idPerrera;?>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="datosPerro" data-bs-parent="#accordionPerroData">
                            <div class="accordion-body">
                                <div class="perro_data">
                                    
                

                                    <p class="fw-bold fs-5">Nombre : <?php echo  $nombrePerrera ?></p>
                                    <p class="fw-bold fs-5">Numero de perros : <?php echo  $nPerros ?></p>
                                    <p class="fw-bold fs-5">Ubicacion : <?php echo  $ubicacion ?></p>
                                    <p class="fw-bold fs-5">Valoracion : <?php echo  $valoracion ?></p>


                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
       
        <?php endforeach; endif;?>

</main>

<?php include_once '../templates/footer.php';?>
          