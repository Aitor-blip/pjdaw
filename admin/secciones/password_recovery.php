<?php 
    session_start();
    include_once '../templates/head.php';
    include_once '../clases/resetPassword.php';
?>


<div class="container">
    <div class="card col-12 mt-5">
        <div class="card-body d-flex justify-center align-items-center flex-column">
            <h5 class="card-title text-center fs-3 text-center text-bold">Reset Password</h5>
            <form action="" method="post">
            <div class="mb-3 w-99">
                <label for="" class="form-label">Email</label>
                <input
                    type="text"
                    class="form-control"
                    name="email"
                    id="email"
                />
            </div>


            <div class="mb-3 w-99">
                <label for="" class="form-label">Password</label>
                <input
                    type="text"
                    class="form-control"
                    name="pass"
                    id="pass"
                    maxlength="20"
                    placeholder=""
                />
            </div>

            <div class="mb-3">
                <input
                    type="submit"
                    class="btn btn-primary"
                    value="Reset Password"
                />
            </div>

        </form>
        </div>
    </div>
</div>


<?php include_once '../templates/footer.php';?>





    
      