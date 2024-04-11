<?php
    include_once './admin/bd/conexion.php';
    $conexion = bd::crearInstancia();
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
        <nav class="nav-menu">
            <a href="./index.php" class="logo">
                <img src="./imagenes/logo.png" alt="Imagen Logo" class="logo__img">
            </a>

           

            

            <ul class="lista__nav lista--header ">
                <i class="fa-solid fa-heart heart"></i>
                <div class="barra"></div>
                <li class="lista__element">
                    <a href="#">Adopta</a>
                </li>
                <li class="lista__element">
                    <a href="#">Sign Up</a>
                </li>
                <li class="lista__element">
                    <a href="#">Login</a>
                </li>
            </ul>
        </nav>

    <div class="header__container">

            <div class="header__textos">
                <h2 class="header__title">Find your new best friend</h2>
                <p class="header__paragraph">Browse pets from our network of over 14,500 shelters and rescues.</p>
            </div>

           <div class="header__form">
                <form action="" method="post">
                    <label for="animal"></label>
                    <input type="text" name="animal" id="animal" placeholder="Introduce el animal" require>
                    <select name="animal" id="animal">
                        <option value="animal">animal</option>
                        <option value="gato">Gato</option>
                    </select>
                    <select name="raza" id="raza">
                        <option value="raza">Raza</option>
                        <option value="malinois">Malinois</option>
                    </select>
                    <select name="size" id="size">
                        <option value="size(opcional)">Tamaño(opcional)</option>
                        <option value="big">Grande</option>
                        <option value="middle">Mediano</option>
                        <option value="small">Pequeño</option>
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
    
</body>
</html>