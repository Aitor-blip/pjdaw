<?php
    session_start();
    include_once '../../../templates/headnocss.php';
    include_once '../../../clases/menu.php';
    @include_once '../../../bd/conexion.php';
    @include_once '../perreras/gestorPerreras.php';
    @include_once '../../../clases/perrera.php';
    $bd = new BD();
    $logueado = 1;
    $listaPerreras = $bd->getPerreras();
   
    ?>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): 

                if($_SESSION['menu_lista'][$id]=="Home"){
                        $file = "../index.php?logueado=$logueado";
                }     

                if($_SESSION['menu_lista'][$id]=="Perreras"){
                        $file = "../index.php?logueado=$logueado";
                }
                
                if($_SESSION['menu_lista'][$id]=="Perros"){
                    $file = "../perros/index.php?logueado=$logueado";
            }

                ?>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="<?php echo $file;?>"><?php echo $_SESSION['menu_lista'][$id];?></a>
                </li>
                <?php endforeach; ?>     
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
                        <form action="" method="post">


                                <div class="mb-3">
                                    <label for="idperrera" class="form-label">Id Perrera</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="idPerrera"
                                        value=<?php echo @$idPerrera;?>
                                        min="1"/>
                            </div>

                        <?php 
                            if(is_null(@$listaPerrerasPorId)){

                            }else{
                            foreach(@$listaPerrerasPorId as $perrera):
                                @$nombrePerrera = @$perrera['nombrePerrera'];
                                @$nPerros = @$perrera['nPerros'];
                                @$ubicacion = @$perrera['ubicacion'];
                                @$valoracion = @$perrera['valoracion'];
                        endforeach;
                        }
                            ?>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nombre"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el nombre de la perrera"
                                    value="<?php echo @$nombrePerrera;?>"
                                    require
                                />
                            </div>

                            <div class="mb-3">
                                <label for="nperros" class="form-label">Numero de Perros</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="nperros"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el numero de perros de la perrera"
                                    value="<?php echo $nPerros;?>"
                                    require
                                    />
                            </div>

                            <div class="mb-3">
                                <label for="pais" class="form-label">Pais de la perrera</label>
                                <select
                                    class="form-select form-select-lg"
                                    name="pais"
                                    id="paisPerrera"
                              >
                              <?php if(!is_null($ubicacion)){?>
                                <option value="<?php echo $ubicacion?>"><?php echo $ubicacion?></option>
                              <?php }else{?>
                                <option value="Espana">Espana</option>
                                <option value="Francia">Francia</option>
                                <option value="Alemania">Alemania</option>
                                <option value="Holanda">Holanda</option>
                            <?php }?>
                            </select>
                            </div>

                            <div class="mb-3">
                                <label for="valoracion" class="form-label">Valoracion de la perrera</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="valoracion"
                                    aria-describedby="helpId"
                                    min="1"
                                    placeholder="Escribe el numero de perros de la perrera"
                                    value="<?php echo $valoracion;?>"
                                />
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
                                        <th scope="col">Nombre Perrera</th>
                                        <th scope="col">Numero de Perros</th>
                                        <th scope="col">Ubicacion</th>
                                        <td scope="col">Valoracion</td>
                                        <td scope="col">Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       
                                         foreach($listaPerreras as $perrera):
                                            $idPerrera = $perrera['idperrera'];
                                            $nombrePerrera = $perrera['nombrePerrera'];
                                            $nPerros = $perrera['nPerros'];
                                            $ubicacion = $perrera['ubicacion'];
                                            $valoracion = $perrera['valoracion'];?>
                                    <tr class="">

                                        <td scope="row"><?php echo $nombrePerrera;?></td>
                                        <td><?php echo $nPerros;?></td>
                                        <td><?php echo $ubicacion;?></td>
                                        <td><?php echo $valoracion?></td>
                                        <td>
                                            <form action="" method="post">
                                                <div class="botones">
                                                <div class="mb-3">
                                                    <input
                                                        type="submit"
                                                        class="btn btn-success"
                                                        value="Seleccionar"
                                                    />

                                                    <input type="hidden" name="idPerrera" value="<?php echo $idPerrera;?>">
                                                </div>

                                            </div>
                                            </form>

                                        </td>
                                    </tr><?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</div>
<?php @include_once '../../templates/footer.php';?>