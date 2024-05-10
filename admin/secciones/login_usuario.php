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
                        <?php if($logueado):
                            else:?>
                             <div
                                class="alert alert-danger"
                                role="alert">
                                <strong><?php echo  $_SESSION['loginError'];?></strong>
                            </div>
                        <?php endif;?>

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

                        <div class="mb-3 d-flex justify-content-center">
                            <input
                                type="submit"
                                class="btn btn-primary"
                                value="Sign In"
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