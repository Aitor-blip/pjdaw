<?php
    session_start();
    @include_once '../templates/headnocss.php';
    @include_once '../clases/menu.php';
    $_SESSION['user'] = "usuario";
    $_SESSION['logueado'] = true;
    $enlaceLogin = "";
    $enlaceRegistrarse="";
    $ruta = pathinfo("C:/xampp/htdocs/pagina web/admin/secciones/menu_usuario.php");
    $_SESSION["ruta"] = $ruta['dirname'];
    $_SESSION["fichero"] = $ruta['basename'];
    $ruta_total = $_SESSION["ruta"]."/".$_SESSION["fichero"];
    $_SESSION["ruta_total"] = $ruta_total;


    if($ruta == "C:/xampp/htdocs/pagina web/admin/secciones/menu_usuario.php"){
        $enlaceLogin = "login_usuario.php";
        $enlaceRegistrarse = "registro_usuario.php";
    }
?>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href=""><?php echo $_SESSION['menu_lista'][$id];?></a>
                </li>
                <?php endforeach; ?>     
                </div>
            </ul>
        </nav>
        
    </div>
</div>