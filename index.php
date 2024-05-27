<?php
    session_start();
    $_SESSION['user'] = "invitado";
    $_SESSION['logueado'] = false;
    include_once './admin/templates/headnocss.php';
    include_once './admin/clases/menu.php';
    include_once './admin/bd/conexion.php';


    $bd = new BD();

    $listaPerros = $bd->consultar("select * from perro");
    $listaRazas = $bd->consultar("select * from raza");
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page project dogs daw</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
    <header class="header header-min">
    <div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end align-items-center">
            <ul class="nav navbar-nav d-flex justify-content-center align-items-center">
                
               
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>

                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light fs-6" href="
                    <?php
                        if($_SESSION['menu_lista'][$id] == "Perros"){
                            $file = "./admin/secciones/animales_adopcion.php?logueado=0";
                            echo $file;
                        }
                        if($_SESSION['menu_lista'][$id]=="Centros de adopcion"):
                            $file = "./admin/secciones/perreras.php";
                            echo $file;
                        endif;
    
                          ?>"><?php 
                          if($_SESSION['menu_lista'][$id]=="Favoritos"):?>
                            <img src="<?php echo "../imagenes/svg/heart.svg"?>" alt="">
                            <?php
                            else:
                                 echo $_SESSION['menu_lista'][$id];
                            
                            endif;?></a>
                </li>

                

                <?php endforeach; ?>
                <div class="login d-flex justify-content-center align-items-center">
                    <a class="mx-3 text-white" href="./admin/secciones/login_usuario.php"><i class="fa-solid fa-user"></i></a>
                    <a class="mx-3 text-white" href="./admin/secciones/registro_usuario.php"><i class="fa-solid fa-right-to-bracket"></i></a>        
                </div>
               
                    
                </div>
            </ul>
        </nav>
        
    </div>
</div>
    <div class="header__container">

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

            </div>
            <p class="header__form__paragraph">Si eres un protector o asociación <a href="#"><span>Regístrate</span></a> y publica tus adoptables.</p>
        </div>
    </header>

    <main>

        

    <section class="hype">
        <h2>Hype de la semana</h2>
        <div class="animales__landing container">
            
          <div class="animal">
            <?php foreach($listaPerros as $id=>$perro):
                @$nChip = $listaPerros[$id]['nChip']; 
                $nombre = $listaPerros[$id]['nombrePerro'];
                $idRaza = $listaPerros[$id]['idRaza'];
                $raza = $bd->getRazaByPerroIdRaza($idRaza);
                $nombreRaza = $raza['nombreRaza'];
                $fotos = $bd->getFotosByNchip($nChip); 
                $rutaBase = trim(isset($fotos['ruta'])?$fotos['ruta']:'');
                $ruta = $rutaBase;?>
            <img class="animal__img" src="./admin/imagenes/img_bd/dog.jpg" alt="Perro">
            <div class="animal__info">
                <p class="animal__name">Nombre perro : <?php echo $nombre;?></p>
                <div class="animal__data"></div>
            </div>
          <?php endforeach;?>

                
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

    </main>
    <section class="adoptables">
        <h2>Adoptables de la semana</h2>
        <div class="animales container">
            
            <div class="animal">
                <img src="./imagenes/dog5.jpg" class="animal__img" alt="Imagen animal">
                <div class="header__textos">
                    <p class="animal__info">Animal Info</p>
                </div>
            </div>
            <div class="animal">
                <img src="./imagenes/dog5.jpg" class="animal__img" alt="Imagen animal">
                <div class="header__textos">
                    <p class="animal__info">Animal Info</p>
                </div>
            </div>
            <div class="animal">
                <img src="./imagenes/dog5.jpg" class="animal__img" alt="Imagen animal">
                <div class="header__textos">
                    <p class="animal__info">Animal Info</p>
                </div>
            </div>
            <div class="animal">
                <img src="./imagenes/dog5.jpg" class="animal__img" alt="Imagen animal">
                <div class="header__textos">
                    <p class="animal__info">Animal Info</p>
                </div>
            </div>
        </div>
    </section>

    <div class="banner banner--patrocinadores">
            <h3>Nuestros patrocinadores</h3>
        </div>


    <footer class="footer">
        <nav>
            <ul class="lista__nav">
                <li class="lista__element"><a href="#">Blog</a></li>
                <li class="lista__element"><a href="#">Política de privacidad</a></li>
                <li class="lista__element"><a href="#">Derechos Reservados 2024, Fundación BuscaFuska A.C.</a></li>
            </ul>
        </nav>
    </footer>

    <?php include './admin/templates/footer.php'; ?>
    
</body>
</html>