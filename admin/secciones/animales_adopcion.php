<?php
  session_start();
  @include_once '../templates/headnocss.php';
  @include_once '../clases/menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales de Adopcion</title>
    <link rel="icon" href="../../imagenes/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body">
    <header>
      <div class="container-fluid">
        <div class="row">
          <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end align-items-center">
              <ul class="nav navbar-nav">
                  <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>

                  <li class="nav-item mx-2">
                      <a class="nav-link fw-bold text-light" href="<?php 
                      if($_SESSION['menu_lista'][$id]=="Perros"){
                         $file = "animales_adopcion.php";
                         echo $file;
                      }
                      ?>"><?php echo $_SESSION['menu_lista'][$id];?></a>
                  </li>

                  

                  <?php endforeach; ?>     
                  </div>
              </ul>
          </nav>
        
        </div>
      </div>
    
    </header>

    
</body>
</html>