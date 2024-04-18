<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales de Adopcion</title>
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="icon" href="../../imagenes/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="animal__adopcion__body">
    <header class="header__adopcion">
        <nav class="nav-menu nav__adopcion">
            <a href="" class="logo">
              <img src="../../imagenes/logo.jpg" alt="Logo">
            </a>
            <ul class="lista__enlaces__visible">
              <li class="item">
                <a href="index.html">
                  Adopta
                </a>
              </li>
              <li class="item">
                <a href="#">Dona</a>
              </li>
              
            </ul>
  
         <!--   <ul class="lista__enlaces__visible__first">
              <li class="item">
                <a href="#">Perros</a>
              </li>
               <li><a href="#">Gatos</a></li>
               <li>
                <a href="#">Centros de Adopción</a>
              </li>
               <li>
                <a href="#">Historial de Adopción</a>
              </li>
            </ul>
  
            <ul class="lista__enlaces__visible__second">
              <li class="item">
                <a href="#">Antes de Adoptar</a>
              </li>
               <li>
                <a href="#">Cuidados Básicos</a>
              </li>
               <li>
                <a href="#">Viviendo con tu mascota</a>
              </li>
               <li>
                <a href="#">Acerca de Nosotros</a>
              </li>
            </ul>
  
            <ul class="lista__enlaces__visible__paises">
              <li class="item">
                <a href="#">Argentina</a>
              </li>
               <li>
                <a href="#">Spain</a>
              </li>
               <li>
                <a href="#">Germany</a>
              </li>
               <li>
                <a href="#">Netherland</a>
              </li>
            </ul>
-->
        </nav>
    </header>

    <main>
        <section class="animales__adopcion no-margin">
            <div class="container animales__adopcion__container">
                <div class="filtros">
                    <h2>Filtrar por:</h2>
                    <form action="" method="post" class="form__action">
                        <label for="ciudad">Ciudad,municipio o delegación:</label>
                        <input type="text" name="ciudad" id="ciudad" class="animal__input__text">

                        <select name="animales__tipo" id="animales__tipo" class="animales__tipo">
                            <option value="perro">Perro</option>
                            <option value="gato">Gato</option>
                        </select>

                        <select name="animales__raza" id="animales__raza" class="animales__raza">
                            <option value="raza">Raza</option>
                            <option value="otra">Otra</option>
                        </select>

                        <h4 class="form__titulo">Tamaños :</h4>
                        <div class="sizes">
                            <label for="grande">Grande
                               <input type="checkbox" name="grande" value="grande">
                            </label>
                            <label for="mediano">Mediano
                              <input type="checkbox" name="mediano" id="mediano" value="mediano">
                            </label>                            
                            <label for="small">Pequeño
                              <input type="checkbox" name="small" id="small" value="small">
                            </label>
                        </div>
                        <hr class="linea">
                        <h4 class="form__titulo">Caracteristicas :</h4>
                        <p>Edad:</p>
                        <div class="caracteristicas">
                            <label for="cachorro">Cachorro
                              <input type="checkbox" name="cachorro" value="Cachorro">
                            </label>
                            <label for="adulto">Adulto
                                <input type="checkbox" name="adulto" value="Adulto">
                            </label>
                            <label for="joven">Joven
                                <input type="checkbox" name="joven" value="Joven">                            
                            </label>
                        </div>
                        <hr class="linea">

                       <!-- <h4>Perronalidad</h4>
                        <div class="perros">
                            <div class="perro">
                                <img src="" alt="" class="perro__img">
                                <p class="perro__name__caracteristica">Independiente</p>
                            </div>
                        </div>
                      -->
                    </form>
                </div>
                <div class="animales">
                    
                  <div class="animal__card">
                    <a href="#" class="animal__a">
                        <img src="../../imagenes/dog1.jpg" alt="Perro" class="animal__img">
                    </a>
                    <div class="animal__card__info">
                        <div class="animal__textos">
                          <p class="raza">Perro</p>
                          <i class="fa-solid fa-heart love"></i>
                          <p class="name">DELA</p>
                          <p class="Caracteristicas">Hembra, Adulto, Mediano</p>
                          <p class="lugar">Sevilla, Andalucía</p>
                        </div>
                        
                        <form action="" method="post">
                            <input type="submit" value="Dinámico" class="btn__animal__state">
                            <div class="botones">
                                <input type="submit" value="Ver Más" class="btn__animal__more">
                                <input type="submit" value="Buscar" class="btn__animal__more">
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="animal__card">
                    <a href="#" class="animal__a">
                        <img src="../../imagenes/dog1.jpg" alt="Perro" class="animal__img">
                    </a>
                    <div class="animal__card__info">
                        <div class="animal__textos">
                          <p class="raza">Perro</p>
                          <i class="fa-solid fa-heart love"></i>
                          <p class="name">DELA</p>
                          <p class="Caracteristicas">Hembra, Adulto, Mediano</p>
                          <p class="lugar">Sevilla, Andalucía</p>
                        </div>
                        
                        <form action="" method="post">
                            <input type="submit" value="Dinámico" class="btn__animal__state">
                            <div class="botones">
                                <input type="submit" value="Ver Más" class="btn__animal__more">
                                <input type="submit" value="Buscar" class="btn__animal__more">
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="animal__card">
                  <a href="#" class="animal__a">
                      <img src="../../imagenes/dog1.jpg" alt="Perro" class="animal__img">
                  </a>
                  <div class="animal__card__info">
                      <div class="animal__textos">
                        <p class="raza">Perro</p>
                        <i class="fa-solid fa-heart love"></i>
                        <p class="name">DELA</p>
                        <p class="Caracteristicas">Hembra, Adulto, Mediano</p>
                        <p class="lugar">Sevilla, Andalucía</p>
                      </div>
                      
                      <form action="" method="post">
                          <input type="submit" value="Dinámico" class="btn__animal__state">
                          <div class="botones">
                              <input type="submit" value="Ver Más" class="btn__animal__more">
                              <input type="submit" value="Buscar" class="btn__animal__more">
                          </div>
                      </form>
                  </div>
                  </div>
                  <div class="animal__card">
                    <a href="#" class="animal__a">
                        <img src="../../imagenes/dog1.jpg" alt="Perro" class="animal__img">
                    </a>
                    <div class="animal__card__info">
                        <div class="animal__textos">
                          <p class="raza">Perro</p>
                          <i class="fa-solid fa-heart love"></i>
                          <p class="name">DELA</p>
                          <p class="Caracteristicas">Hembra, Adulto, Mediano</p>
                          <p class="lugar">Sevilla, Andalucía</p>
                        </div>
                        
                        <form action="" method="post">
                            <input type="submit" value="Dinámico" class="btn__animal__state">
                            <div class="botones">
                                <input type="submit" value="Ver Más" class="btn__animal__more">
                                <input type="submit" value="Buscar" class="btn__animal__more">
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="animal__card">
                    <a href="#" class="animal__a">
                        <img src="../../imagenes/dog1.jpg" alt="Perro" class="animal__img">
                    </a>
                    <div class="animal__card__info">
                        <div class="animal__textos">
                          <p class="raza">Perro</p>
                          <i class="fa-solid fa-heart love"></i>
                          <p class="name">DELA</p>
                          <p class="Caracteristicas">Hembra, Adulto, Mediano</p>
                          <p class="lugar">Sevilla, Andalucía</p>
                        </div>
                        
                        <form action="" method="post">
                            <input type="submit" value="Dinámico" class="btn__animal__state">
                            <div class="botones">
                                <input type="submit" value="Ver Más" class="btn__animal__more">
                                <input type="submit" value="Buscar" class="btn__animal__more">
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="animal__card">
                  <a href="#" class="animal__a">
                      <img src="../../imagenes/dog1.jpg" alt="Perro" class="animal__img">
                  </a>
                  <div class="animal__card__info">
                      <div class="animal__textos">
                        <p class="raza">Perro</p>
                        <i class="fa-solid fa-heart love"></i>
                        <p class="name">DELA</p>
                        <p class="Caracteristicas">Hembra, Adulto, Mediano</p>
                        <p class="lugar">Sevilla, Andalucía</p>
                      </div>
                      
                      <form action="" method="post">
                          <input type="submit" value="Dinámico" class="btn__animal__state">
                          <div class="botones">
                              <input type="submit" value="Ver Más" class="btn__animal__more">
                              <input type="submit" value="Buscar" class="btn__animal__more">
                          </div>
                      </form>
                  </div>
                  </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>