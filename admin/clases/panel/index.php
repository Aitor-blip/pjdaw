<?php
    session_start();
    include_once '../../templates/headnocss.php';
    include_once '../../clases/menu.php';
    $logueado = 1;
?>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): 
                    
                                
                if($_SESSION['menu_lista'][$id]=="Home"){
                $file = "../../index.php";
                }
                if($_SESSION['menu_lista'][$id]=="Perreras"){
                    $file = "animales_adopcion.php?logueado=$logueado";
                }
                if($_SESSION['menu_lista'][$id]=="Perros"){
                    $file = "./perros/index.php?logueado=$logueado";
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


    <div class="container">
        <div class="col-12">
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Bienvenido al panel de control de administracion de tu perrera</h1>
                    <p class="col-md-8 fs-4">
                        En este panel podras administrar tu perrera de forma eficaz.
                    </p>
                    <a href="./perreras/index.php">
                        <button class="btn btn-primary btn-lg" type="button">
                        Iniciar
                    </button>
                    </a>
                </div>
            </div>
            
        </div>
</body>

<?php include_once '../../templates/footer.php';?>
