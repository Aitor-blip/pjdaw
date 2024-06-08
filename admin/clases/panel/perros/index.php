<?php
    session_start();
    include_once '../../../templates/headnocss.php';
    @include_once '../../../bd/conexion.php';
    @include_once '../perros/gestorPerrosPrincipal.php';
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
    $listaPerreras = $bd->consultar("select * from perrera");
    $listaRazas = $bd->consultar("select * from raza");
    $listaPerros = $bd->consultar("select * from perro");

    ?>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
            <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../index.php?logueado=<?php echo $logueado;?>">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../perreras/index.php?logueado=<?php echo $logueado;?>">Perreras</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../perros/index.php?logueado=<?php echo $logueado;?>">Perros</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../perros/perrosSinAdoptar.php?logueado=<?php echo $logueado;?>">Perros Sin Adoptar</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../perros/perrosParaTramite.php?logueado=<?php echo $logueado;?>">Perros En Tramite de Adopcion</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../perros/perrosParaAdoptar.php?logueado=<?php echo $logueado;?>">Perros Adoptados</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../usuarios/index.php?logueado=<?php echo $logueado;?>">Usuarios</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../usuarios/cerrarSesion.php?logueado=<?php echo $logueado;?>">Cerrar Sesoón</a>
                </li>  
                </div>
            </ul>
        </nav>

    </div>
</div>
<body>

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="col-4 mx-5 mt-5">
                <div class="row">
                    <div class="col-12">
                        <form action="" method="post" enctype="multipart/form-data">


                                <div class="mb-3">
                                    <label for="nChip" class="form-label">Nchip</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="nChip"
                                        value="<?php echo @$nchip;?>"
                                        min="1"/>
                            </div>

                            <?php
                                $listaPerrosByNchip = $bd->getPerroByNchip(@$nchip); 
                                foreach($listaPerrosByNchip as $perro):
                                    @$nChip = $perro['nChip'];
                                    @$nombrePerro = $perro['nombrePerro'];
                                    @$fNacimiento = $perro['fechaNacimiento'];
                                    @$fEntrada = $perro['fechaEntrada'];
                                    //@$idPerrera = $perro['idperrera'];
                                  //  @$nombrePerrera = $bd->getPerreraByIdPerro($idPerrera);
                                    @$peso = $perro['peso'];
                                   // @$idRaza = $perro['idRaza'];
                                   // @$nombreRaza = $bd->getRazaByPerroIdRaza($idRaza);
                                    @$adoptado = $perro['adoptado'];
                                endforeach;
                                    ?> 
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Perro</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nombre"
                            aria-describedby="helpId"
                            placeholder="Escribe el nombre de la perrera"
                            value="<?php echo @$nombrePerro;?>"
                            require
                        />
                    </div>

                    <div class="mb-3">
                        <label for="fNac" class="form-label">Fecha Nacimiento</label>
                        <input
                            type="date"
                            class="form-control"
                            name="fNac"
                            aria-describedby="helpId"
                            placeholder="Escribe el numero de perros de la perrera"
                            value="<?php echo $fNacimiento;?>"
                            require
                            />
                    </div>
                    
                    <div class="mb-3">
                        <label for="fEntr" class="form-label">Fecha de Entrada</label>
                        <input
                            type="date"
                            class="form-control"
                            name="fEntr"
                            aria-describedby="helpId"
                            placeholder="Escribe el numero de perros de la perrera"
                            value="<?php echo $fEntrada;?>"
                            require
                            />
                    </div>

                    <h5 class="text-center">Foto Perro</h5>
                    <input type="file" name="foto">

                   <div class="mb-3">
                    <label for="perrera" class="form-label">Perrera</label>
                    <select
                        class="form-select form-select-lg"
                        name="perrera">
                        <?php foreach($listaPerreras as $perrera):
                            $idPerrera = $perrera['idperrera'];
                            $nombrePerrera = $perrera['nombrePerrera'];?>
                        <option value="<?php echo @$idPerrera;?>"><?php echo @$nombrePerrera;?></option>
                        <?php endforeach;?>
                    </select>
                   </div>

                   <div class="mb-3">
                        <label for="peso" class="form-label">Peso</label>
                        <input
                            type="number"
                            class="form-control"
                            name="peso"
                            aria-describedby="helpId"
                            placeholder="Escribe el peso del perro"
                            value="<?php echo $peso;?>"
                            require
                            />
                    </div>


                    <div class="mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <select
                        class="form-select form-select-lg"
                        name="raza">
                        <?php foreach($listaRazas as $raza):
                            $idRaza = $raza['idraza'];
                            $nombreRaza = $raza['nombreRaza'];?>
                        <option value="<?php echo @$idRaza;?>"><?php echo @$nombreRaza;?></option>
                        <?php endforeach;?>
                    </select>
                   </div>

                   <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="adoptado" id="adoptado"
                        <?php if(@$adoptado != "on"){
                        }else{?>
                        checked <?php } ?>>
                        <label class="form-check-label" for="adoptado">¿Esta Adoptado?</label>
                    </div>

                   



                   <div class="botones mt-3">
                        <input type="submit" class="btn btn-primary" name="accion" value="Agregar">
                        <input type="submit" class="btn btn-success" name="accion" value="Modificar"/>
                        <input type="submit" class="btn btn-warning" name="accion" value="Eliminar"/>
                   </div>





                  
                </form>
                    </div>
                </div>
            </div>
            <div class="col-6 mx-3">
                <div class="row">
                    <div class="col-12">
                            <div class="card">
                                
                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                
                            </div>
                        <div class="table-responsive">
                            <table class="table table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nchip</th>
                                        <th scope="col">Nombre Perro</th>
                                        <th scope="col">Fecha Nacimiento</th>
                                        <th scope="col">Raza</th>
                                        <td scope="col">Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>

                                   <?php foreach($listaPerros as $perro):
                                            $nChip = $perro['nChip'];
                                            $nombrePerro = $perro['nombrePerro'];
                                            $fNacimiento = $perro['fechaNacimiento'];
                                            $fEntrada = $perro['fechaEntrada'];
                                            $idPerrera = $perro['idperrera'];
                                            $nombrePerrera = $bd->getPerreraByIdPerro($idPerrera);
                                            $peso = $perro['peso'];
                                            $idRaza = $perro['idRaza'];
                                            $nombreRaza = $bd->getRazaByPerroIdRaza($idRaza);
                                       
                                            ?> 
                                         <tr class="">
                                         
                                            <td scope="row"><?php echo $nChip;?></td>
                                            <td><?php echo $nombrePerro;?></td>
                                            <td><?php echo $fNacimiento;?></td>
                                            <td><?php echo $nombreRaza;?></td>
                                            <td>
                                            <form action="" method="post">
                                                <div class="botones">
                                                <div class="mb-3">
                                                    <input
                                                        type="submit"
                                                        class="btn btn-success"
                                                        value="Seleccionar"
                                                    />

                                                    <div class="mb-3 mt-3">
                                                    <input
                                                        type="button"
                                                        class="btn btn-success"
                                                        value="Ver Foto"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#fotoPerro"
                                                    />
                                                    </div>

                                                    <div
                                    class="modal fade"
                                    id="fotoPerro"
                                    tabindex="-1"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"
                                    
                                    role="dialog"
                                    aria-labelledby="modalTitleId"
                                    aria-hidden="true"
                                >
                                    <div
                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                        role="document"
                                    >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    Foto del Perro
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body w-100">
                                              
                                                    <img
                                                        src="<?php echo $ruta;?>"
                                                        class="img-fluid"
                                                        alt="Imagen Perro"
                                                    />
                                               
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Optional: Place to the bottom of scripts -->
                                <script>
                                    const myModal = new bootstrap.Modal(
                                        document.getElementById("modalId"),
                                        options,
                                    );
                                </script>
                                

                                                    <input type="hidden" name="nChip" value="<?php echo $nChip;?>">
                                                </div>

                                            </div>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</div>
<?php @include_once '../../../templates/footer.php';?>