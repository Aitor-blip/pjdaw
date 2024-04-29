<?php
    session_start();
    include_once '../templates/headnocss.php';
    include_once '../clases/menu.php';
?>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-info bg-gradient d-flex justify-content-end">
            <ul class="nav navbar-nav">
                <?php foreach($_SESSION['menu_lista'] as $id=>$item): ?>
                <li class="nav-item mx-2">
                    <a class="nav-link fw-bold text-light" href="#"><?php echo $_SESSION['menu_lista'][$id];?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        
    </div>
</div>