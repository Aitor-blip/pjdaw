<?php
    session_start();
    include_once '../../../templates/headnocss.php';
    include_once '../../../clases/menu.php';
    @include_once '../../../bd/conexion.php';
    @include_once '../perros/gestorPerros.php';
    $bd = new BD();
    $logueado = 1;
    $listaPerros = $bd->getPerrosSinAdoptar();
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
                        $file = "./index.php?logueado=$logueado";
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
                                    <label for="nChip" class="form-label">Nchip</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="nChip"
                                        value="<?php echo $nChip;?>"
                                        min="1"/>
                            </div>
                            
                            <?php foreach($listaPerros as $perro):
                                            $nChip = $perro['nChip'];
                                            $nombrePerro = $perro['nombrePerro'];
                                            $fNacimiento = $perro['fechaNacimiento'];
                                            $fEntrada = $perro['fechaEntrada'];
                                            $idPerrera = $perro['idperrera'];
                                            $nombrePerrera = $bd->getPerreraById($idPerrera);
                                            $peso = $perro['peso'];
                                            $idRaza = $perro['idRaza'];
                                            $nombreRaza = $bd->getRazaByPerroIdRaza($idRaza);
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
                                    value="<?php echo $nombrePerro;?>"
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
                                    value="<?php echo $fNac;?>"
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

                           <div class="mb-3">
                            <label for="perrera" class="form-label">Perrera</label>
                            <select
                                class="form-select form-select-lg"
                                name="perrera">
                                <option value="<?php echo $idPerrera;?>"><?php echo $nombrePerrera;?></option>
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
                                <option value="<?php echo $idRaza;?>"><?php echo $nombreRaza;?></option>
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
                                        <th scope="col">Nchip</th>
                                        <th scope="col">Nombre Perro</th>
                                        <th scope="col">Fecha Nacimiento</th>
                                        <th scope="col">Fecha Entrada</th>
                                        <th scope="col">Perrera</th>
                                        <th scope="col">Peso</th>
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
                                            $nombrePerrera = $bd->getPerreraById($idPerrera);
                                            $peso = $perro['peso'];
                                            $idRaza = $perro['idRaza'];
                                            $nombreRaza = $bd->getRazaByPerroIdRaza($idRaza);
                                    endforeach;
                                            ?> 
                                         <tr class="">
                                            <td scope="row"><?php echo $nChip;?></td>
                                            <td><?php echo $nombrePerro;?></td>
                                            <td><?php echo $fNacimiento;?></td>
                                            <td><?php echo $fEntrada?></td>
                                            <td><?php echo $nombrePerrera;?></td>
                                            <td><?php echo $peso?></td>
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

                                                    <input type="hidden" name="nChip" value="<?php echo $nChip;?>">
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
</div>
<?php include_once '../../templates/footer.php';?>