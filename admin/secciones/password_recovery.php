<?php 
    session_start();
    include_once '../templates/head.php';
    include_once '../clases/resetPassword.php';
?>

<form action="" method="post">

    
    <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input
            type="text"
            class="form-control"
            name="email"
            id="email"
        />
    </div>


    <div class="mb-3">
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

