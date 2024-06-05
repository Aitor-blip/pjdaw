<?php
    session_start();
    include_once '../templates/head.php';
    @include_once '../imagenes/variables.php';
    @include_once '../bd/conexion.php';              
    $bd = new BD();
?>
<header>
    <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-center align-items-center">

    <a href="#" class="logo d-flex justify-content-start">
    <img src="../../imagenes/logo.png" class="logo__img" alt="" width="200" height="200">
    </a>

    <ul class="nav navbar-nav d-flex justify-content-end align-items-center w-100">
        <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>

            <li class="nav-item mx-2">
            <a class="nav-link fw-bold text-light fs-6" href="<?php 
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
          