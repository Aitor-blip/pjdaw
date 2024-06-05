<?php
    session_start();
    @include_once '../templates/head.php';
    @include_once '../clases/menu.php';
    $_SESSION['user'] = "logueado";
    $_SESSION['logueado'] = true;
    if($_SESSION['user']=="logueado"){
        $logueado = true;
    }
    $enlaceLogin = "";
    $enlaceRegistrarse="";
    $ruta = pathinfo("C:/xampp/htdocs/pagina web/admin/secciones/menu_usuario.php");
    $_SESSION["ruta"] = $ruta['dirname'];
    $_SESSION["fichero"] = $ruta['basename'];
    $ruta_total = $_SESSION["ruta"]."/".$_SESSION["fichero"];
    $_SESSION["ruta_total"] = $ruta_total;

    if($_POST){
        @$action = $_POST['action'];
        @$dni = $_POST['dni'];
    }
        @$nombreFoto = $_FILES["dni"]["name"];
        @$imagenTemporal = $_FILES["dni"]["tmp_name"];
        @$ruta = "../../imagenes/img_bd/".$nombreFoto;

        if(@$action=="Save Changes"){
            if(move_uploaded_file($imagenTemporal, $ruta)){
                $_SESSION['dniFoto'] = $nombreFoto;
                
            }else{
                echo "Fallo al cargar el dni";
            }
        }


    if($ruta == "C:/xampp/htdocs/pagina web/admin/secciones/menu_usuario.php"){
        $enlaceLogin = "login_usuario.php";
        $enlaceRegistrarse = "registro_usuario.php";
    }
?>

<header class="header header-min">
    <div class="row">
        
       
        <nav class=" navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-center align-items-center">

             <a href="#" class="logo d-flex justify-content-start">
                <img src="../../imagenes/logo.png" class="logo__img" alt="" width="200" height="200">
            </a>
        
            <ul class="nav-menu nav navbar-nav d-flex flex-column flex-lg-row h-100 justify-content-center justify-content-lg-end align-items-center w-100-lg">
                
               
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>

                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light fs-6" href="
                    <?php
                        
                        if($_SESSION['menu_lista'][$id] == "Home"){
                            $file = "../../index.php?logueado=0";
                            echo $file;
                        }
                        
                        if($_SESSION['menu_lista'][$id] == "Perros"){
                            $file = "animales_adopcion.php?logueado=0";
                            echo $file;
                        }
                        if($_SESSION['menu_lista'][$id]=="Centros de adopcion"):
                            $file = "perreras.php?logueado=0";
                            echo $file;
                       endif;

                       if($_SESSION['menu_lista'][$id]=="Cerrar Sesion"){
                            $file = "../clases/panel/usuarios/cerrarSesion.php?logueado=$logueado";
                            echo $file;
                        }
                             
                        
    
                          ?>"><?php echo $_SESSION['menu_lista'][$id];?></a>
                </li>

                

                <?php endforeach; ?>
                <div class="login d-flex justify-content-center align-items-center">
                    <a class="mx-3 text-white" href="./admin/secciones/login_usuario.php"><i class="fa-solid fa-user"></i></a>
                    <a class="mx-3 text-white" href="./admin/secciones/registro_usuario.php"><i class="fa-solid fa-right-to-bracket"></i></a>        
                </div>
               
                    
                </div>
            </ul>
        </nav>
        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dni</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <h5 class="text-center">Parte Delantera</h5>
                <input type="file" name="dni">
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary" name="action" data-bs-dismiss="modal" value="Close"/>
                    <input type="submit" class="btn btn-primary" name="action" value="Save Changes"/>
                </div>
            </form>
        
        </div>
        
        </div>
    </div>
    </div>
    <div class="header__container">

<!-- Button trigger modal -->
<button type="button" id="modalBtn" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
Pedir Informacion
</button>


<div class="header__textos">
    <h2 class="header__title">Find your new best friend</h2>
    <p class="header__paragraph">Browse pets from our network of over 14,500 shelters and rescues.</p>
</div>

<div class="header__form">
    <form action="./admin/clases/buscarPerro.php" method="post">
        <label for="animalPeso"></label>
        <input type="text" name="animalPeso" id="animal" placeholder="Introduce el peso del animal" require>
        <select name="raza" id="raza">
        <option value="raza" default>Seleccionar Raza</option>
        <?php foreach ($listaRazas as $id=>$raza):
                $idRaza = $listaRazas[$id]['idraza'];
                $nombreRaza = $listaRazas[$id]['nombreRaza'];
                ?>
            <option value="<?php echo $idRaza;?>"><?php echo $nombreRaza;?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Buscar" class="btn btn--enviar">
    </form>

<p class="header__form__paragraph">Si eres un protector o asociación <a href="./admin/secciones/registro_usuario.php"><span>Regístrate</span></a> y publica tus adoptables.</p>
</div>
</header>

<main>
    <section class="caracteristicas">
        <div class="dog__car">
            <h2 class="dog__title__carc">Caracteristicas</h2>
            <div class="dog__info__car">
                <p>Nuestra pagina web tiene muy buenas formas de transimirle la seguridad,flexibilidad y eficiencia del sitio web para
                    nuestros clientes
                </p>
            </div>
        </div>
        <div class="img">
            <img src="../../imagenes/dog2.jpg" alt="Imagen Perro">
        </div>
    </section>

    <section class="atributos attributo__container">
        <h2 class="h2 fs-2 text-center">Ventajas</h2>
        <div class="atributos__data">
            <div class="attributo">
                <i class="bi bi-check icono"><img src="../imagenes/svg/check.svg"/></i>
                <h2 class="attributo__name">Destreza</h2>
                <p class="attributo__info">Nuestra pagina web requiere destrza y habilidad para adaptarse a los cambios</p>
            </div>

            <div class="attributo">
                <i class="bi bi-check icono"><img src="../imagenes/svg/clock.svg"/></i>
                <h2 class="attributo__name">Tiempo</h2>
                <p class="attributo__info">Las perreras en caso de que hayas pasado los requerimientos para adpptar,las perreras te entregaran el perro en tiempo record</p>
            </div>

            <div class="attributo">
                <i class="bi bi-clock-fill icono"><img src="../imagenes/svg/up.svg"/></i>
                <h2 class="attributo__name">Tiempo</h2>
                <p class="attributo__info">Las perreras en caso de que hayas pasado los requerimientos para adpptar,las perreras te entregaran el perro en tiempo record</p>
            </div>
        </div>
    </section>
    

</main>


<footer class="bg-dark footer-menu text-white py-4 mt-5">
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


    <?php include '../../admin/templates/footer.php'; ?>
        





















