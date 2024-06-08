<?php
    session_start();
    $_SESSION['user'] = "invitado";
    include_once '../templates/headnocss.php';
    include_once '../clases/registro.php';
   
    
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-4 col-md-4 col-sm-2"></div>
        <div class="col-4 col-md-4 col-sm-2">
            <div class="card">
                
                <?php
                
                if($_POST){
                    if(@$insertado){
                        $_SESSION['user'] = "logueado";
                        header("Location:../secciones/login_usuario.php");
                        
                    }else{?>
              

                    <div
                        class="alert alert-danger"
                        role="alert"
                    >
                        <strong><?php echo $bd->errorMessage;?></strong>
                    </div>
                <?php } ?>
                
            <?php } ?>
                <div class="card-header">
                    <h3 class="text-center fw-bold">Sign Up</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="registroForm">
                       
                    <div class="mb-3">
                            <label for="dni" class="form-label"><span class="fw-bold">Dni</span></label>
                            <input
                                type="text"
                                class="form-control"
                                name="dni"
                                minlength="1"
                                maxlength="9"
                                id="dni"
                               
                            />
                        </div>
                    
                    <div class="mb-3">
                            <label for="email" class="form-label"><span class="fw-bold">Email</span></label>
                            <input
                                type="text"
                                class="form-control"
                                name="email"
                                id="email"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><span class="fw-bold">Password</span></label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="password"
                            />
                        </div>                        

                        <div class="mb-3 d-flex justify-content-center">
                            <input
                                type="submit"
                                class="btn btn-primary"
                                value="Sign Up"
                            />
                            
                            
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