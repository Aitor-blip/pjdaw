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
                <div class="card-header">
                    <h3 class="text-center fw-bold">Sign Up</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
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