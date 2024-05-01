<?php 
    session_start();
    include_once '../templates/headnocss.php';
    @include_once '../imagenes/variables.php';
    @include_once '../bd/conexion.php';                
  $bd = new BD();
  /* $perroData = $bd->getPerroByNchip(); */
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mt-5">
            <?php
                if($_GET){
                    $nChip = $_GET['nChip'];
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
                <div class="botones d-flex flex-row justify-content-center">
                    <a
                        name="adoptame"
                        class="btn btn-primary w-50 p-3 m-4"
                        href="#"
                        role="button"
                        >Adoptame</a
                    >

                    <a
                        name="favorito"
                        class="btn btn-primary w-50 p-3 m-4"
                        href="#"
                        role="button"
                        >Agregame a favoritos</a
                    >
                    
                </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php';?>