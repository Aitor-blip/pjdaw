<?php
    session_start();
    include_once '../../templates/headnocss.php';
    include_once '../../clases/menu.php';
    include_once '../perreras/gestorPerreras.php';
    $logueado = 1;
?>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): 
                    
                                
                if($_SESSION['menu_lista'][$id]=="Perros"){
                    $file = "animales_adopcion.php?logueado=$logueado";
                }
                if($_SESSION['menu_lista'][$id]=="Home"){
                $file = "../../index.php";
                }

                if($_SESSION['menu_lista'][$id]=="Favoritos"){
                $file = "favoritos.php";
                }
                //
                if($_SESSION['menu_lista'][$id]=="Centros de adopcion"):
                $file = "perreras.php";
            endif;    
                    
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
                                <label for="nombre" class="form-label">Nombre</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nombre"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el nombre de la perrera"
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
                                    require
                                    />
                            </div>

                            <div class="mb-3">
                                <label for="pais" class="form-label">Pais de la perrera</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="pais"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el numero de perros de la perrera"
                                    require
                                    />
                            </div>

                            <div class="mb-3">
                                <label for="valoracion" class="form-label">Valoracion de la perrera</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="valoracion"
                                    aria-describedby="helpId"
                                    placeholder="Escribe el numero de perros de la perrera"
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
                                        <th scope="col">Column 1</th>
                                        <th scope="col">Column 2</th>
                                        <th scope="col">Column 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td scope="row">R1C1</td>
                                        <td>R1C2</td>
                                        <td>R1C3</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Item</td>
                                        <td>Item</td>
                                        <td>Item</td>
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