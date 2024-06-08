<?php
    session_start();
    include_once '../../templates/headnocss.php';
    include_once '../../bd/conexion.php';  
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
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="index.php?logueado=<?php echo $logueado;?>">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./perreras/index.php?logueado=<?php echo $logueado;?>">Perreras</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./perros/index.php?logueado=$logueado<?php echo $logueado;?>">Perros</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./perros/perrosSinAdoptar.php?logueado=<?php echo $logueado;?>">Perros Sin Adoptar</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./perros/perrosParaTramite.php?logueado=<?php echo $logueado;?>">Perros En Tramite</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./perros/perrosParaAdoptar.php?logueado=<?php echo $logueado;?>">Perros Adoptados</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="../panel/usuarios/cerrarSesion.php">Cerrar Sesión</a>
                </li>
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
