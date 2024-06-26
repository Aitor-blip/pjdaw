<?php
    session_start();
    $_SESSION['user'] = "invitado";
    include_once '../templates/headnocss.php';
    include_once '../clases/login.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-4 col-md-4 col-sm-2"></div>
        <div class="col-4 col-md-4 col-sm-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center fw-bold">Login</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php  if($_POST){
                    if(@$logueado){
                        if($_SESSION['user'] == "administrador"){
                            $_SESSION['user'] = "administrador";
                            header("Location:../clases/panel/index.php");
                        }else{
                            if($_SESSION['user'] == "usuario"){
                                $_SESSION['user'] = "logueado";
                                header("Location:menu_usuario.php");
                            }
                        }
                        
                        
                        
                    }else{?>
                    <div
                        class="alert alert-danger"
                        role="alert">
                        <strong><?php
                        if($bd->errorMessage==null){
                            echo "Fallo al loguearse";
                        } ?></strong>
                    </div>
                <?php }} ?>

                        <div class="mb-3">
                            <label for="email" class="form-label"><span class="fw-bold">Email</span></label>
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><span class="fw-bold">Password</span></label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                aria-describedby="helpId"                                

                            />
                            <a href="registro_usuario.php">
                                <small id="helpId" class="form-text text-muted">Registrar Usuario</small>
                            </a>
                        </div>

                        <div class="mb-3 d-flex justify-content-center w-100">
                            <input
                                type="submit"
                                class="btn btn-primary w-30 me-5"
                                value="Sign In"
                                name="accion"
                            />

                            <input
                                type="submit"
                                class="btn btn-primary w-30 ms-5"
                                value="Reset Password"
                                name="accion"
                            />
                            
                            <br>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
            
        </div>
        <div class="col-4 col-md-4 col-sm-2"></div>
    </div>
</div>

<?php
    include_once '../templates/footer.php';
?>