<?php
   session_start();
    include_once '../../../templates/headforms.php';
    include_once '../../../clases/menu.php';
    @include_once '../../../bd/conexion.php';
    @include_once '../usuarios/gestorUsuarios.php';
    $bd = new BD();
    $logueado = 1;
    @$listaUsuariosById = $bd->getUserDataByIdUsuario(@$idUsuario);
    $listaUsuarios = $bd->consultar("select * from usuario");
    $listaRoles = $bd->consultar("select * from usuario_rol");

   
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
                        <form action="" method="post" id="userForm">

                        <?php if(is_null(@$listaUsuariosById)){?>
                            <h2><?php echo $bd->errorMessage;?></h2>
                            <?php }else{
                            foreach(@$listaUsuariosById as $usuario):
                                @$emailUsuario = @$usuario['email'];
                                @$password = @$usuario['password'];
                                @$dniUsuario = @$usuario['dni'];
                                @$idRol = @$usuario['idRol'];
                        endforeach;
                        }?>


                                <div class="mb-3">
                                    <label for="idUsuario" class="form-label">Id Usuario</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="idUsuario"
                                        value=<?php echo @$idUsuario;?>
                                        min="1"/>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el email del usuario"
                                    value="<?php echo @$emailUsuario;?>"
                                    require
                                />
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="password"
                                    id="password"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el password del usuario"
                                    value="*******"
                                    require
                                />
                            </div>

                            <div class="mb-3">
                                <label for="dni" class="form-label">Dni</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="dni"
                                    id="dni"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el dni del usuario"
                                    value="<?php echo @$dniUsuario;?>"
                                    require
                                    />
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Ver Dni
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Dni del Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo "../../../../imagenes/img_bd/".$_SESSION['dniFoto'];?>" class="img-fluid" alt="Foto Dni Usuario">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                            </div>


                            <div class="mb-3">
                                <label for="rol" class="form-label">Rol del Usuario</label>
                                <select
                                    class="form-select form-select-lg"
                                    name="rol"
                                    id="rolesUsuario"
                              >
                              <?php if(!is_null($listaRoles)){
                                foreach($listaRoles as $rol):
                                    $idRol = $rol['idRol'];
                                    $nombreRol = $rol['nombre'];
                                ?>
                                <option value="<?php echo $idRol?>"><?php echo $nombreRol?></option>
                              <?php endforeach;}?>
                            </select>
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
                        <div class="table-responsive">
                            <table class="table table">
                                <thead>
                                    <tr>
                                        <th scope="col">IdUsuario</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Dni</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                            if(is_null(@$listaUsuarios)){

                            }else{
                            foreach(@$listaUsuarios as $usuario):
                                @$idUsuario = @$usuario['idUsuario'];
                                @$emailUsuario = @$usuario['email'];
                                @$dniUsuario = @$usuario['dni'];
                                @$idRol = @$usuario['idRol'];
                                @$password = @$usuario['password'];
                                $nombreRol = $bd->getRolByIdRol($idRol);
                            
                            ?>
                                    <tr class="">

                                        <td scope="row"><?php echo $idUsuario;?></td>
                                        <td><?php echo $emailUsuario;?></td>
                                        <td><?php 
                                        if($dniUsuario == null){echo "no";}else{
                                            echo $dniUsuario;
                                        }?></td>
                                        <td><?php echo $nombreRol;?></td>
                                        <td>
                                            <form action="" method="post">
                                                <div class="botones">
                                                <div class="mb-3">
                                                    <input
                                                        type="submit"
                                                        class="btn btn-success"
                                                        value="Seleccionar"
                                                    />

                                                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario;?>">
                                                </div>

                                            </div>
                                            </form>

                                        </td>
                                    </tr><?php endforeach;}?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</div>


<?php @include_once '../../../templates/footer.php';?>