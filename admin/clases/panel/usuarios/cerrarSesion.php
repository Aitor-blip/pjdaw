<?php
    unset($_SESSION['dni']);
    session_destroy();
    $logueado=1;
    header("Location:../../../../index.php");
?>