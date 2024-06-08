<?php
    session_start();
    include_once './admin/templates/head.php';
    include_once './admin/bd/conexion.php';
    $bd = new BD();
    $perros = $bd->getPerrosParaAdoptar();
    if($_POST){
        @$action = $_POST['action'];
        @$dni = $_POST['dni'];
    }
        @$nombreFoto = $_FILES["dni"]["name"];
        @$imagenTemporal = $_FILES["dni"]["tmp_name"];
        @$ruta = "./imagenes/img_bd/".$nombreFoto;

        if(@$action=="Save Changes"){
            if(move_uploaded_file($imagenTemporal, $ruta)){
                $_SESSION['dniFoto'] = $nombreFoto;
                
            }else{
                echo "Fallo al cargar el dni";
            }
        }

    $bd = new BD();

    $listaPerros = $bd->consultar("select * from perro");
    $listaRazas = $bd->consultar("select * from raza");

    $logueado =0;
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page project dogs daw</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./js/script.js" defer></script>
</head>
<body>
    <header class="header header-min">
    <div class="row">
        
       
        <nav class=" navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-center align-items-center">

             <a href="#" class="logo d-flex justify-content-start">
                <img src="./imagenes/logo.png" class="logo__img" alt="" width="200" height="200">
            </a>
        
            <ul class="nav-menu nav navbar-nav d-flex flex-column flex-lg-row h-100 justify-content-center justify-content-lg-end align-items-center w-100-lg">
                

                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="index.php">Home</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./admin/secciones/perreras.php">Perreras</a>
                </li>
              
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="./admin/secciones/animales_adopcion.php?logueado=<?php echo $logueado;?>">Perros</a>
                </li>
              

                <div class="login d-flex justify-content-center align-items-center">
                    <a class="mx-3 text-white" href="./admin/secciones/login_usuario.php"><i class="fa-solid fa-user"></i></a>
                    <a class="mx-3 text-white" href="./admin/secciones/registro_usuario.php"><i class="fa-solid fa-right-to-bracket"></i></a>        
                </div>
               
                    
                </div>
            </ul>
        </nav>
        
        </div>
        </div>
    </header>
<!-- Modal -->

    <div class="header__container">


            <div class="header__textos">
                <h2 class="header__title">Find your new best friend</h2>
                <p class="header__paragraph">Browse pets from our network of over 14,500 shelters and rescues.</p>
            </div>
            <p class="header__form__paragraph">Si eres un protector o asociación <a href="./admin/secciones/registro_usuario.php"><span>Regístrate</span></a> y publica tus adoptables.</p>
        </div>
    </header>

    <section class="adoptables mb-5" id="adoptables">
        <h2>Perros de la Semana</h2>
        <div class="animales container">
            
            <div class="animales_adoptables_special" id="animales__animal">
                
                
            </div>
            
        </div>
    </section>

    
    <div class="banner banner--test">
        <h3>Encuentra tu mascota ideal</h3>
        <p>¿Has pensado qué personalidad de mascota estás buscando?</p>
        <p>¡Sí! Los animales también tienen personalidades y se identifican con sus dueños y su estilo de vida.</p>
        <p>Averigua qué tipo de adoptable es mejor para ti.</p>
        <a href="" class="btn__banner btn__banner--test"></a>
    </div>

    <h2>Nuestros Patrocinadores</h2>
            <div class="patrocinadores-lista">
                <div class="patrocinador">
                    <img src="patrocinador1.jpg" alt="Patrocinador 1">
                </div>
                <div class="patrocinador">
                    <img src="patrocinador2.jpg" alt="Patrocinador 2">
                </div>
                <div class="patrocinador">
                    <img src="patrocinador3.jpg" alt="Patrocinador 3">
                </div>
                <!-- Agrega más patrocinadores según sea necesario -->
            </div>

    <footer class="bg-dark footer-menutext-white py-4 mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white fs-5">Home</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-unstyled">
                        <li><a href="./admin/secciones/animales_adopcion.php" class="text-white fs-5">Perros</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-unstyled">
                        <li><a href="politicaPrivacidad.html" class="text-white fs-5">Politica de Privacidad</a></li>
                        <li><a href="./admin/secciones/perreras.php" class="text-white fs-5">Centros de Adopción</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="mb-0">&copy; 2024 PETSFINDER. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>    
</body>
</html>