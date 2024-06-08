<?php
    include_once '../snippets/clases.php';
    include '../bd/conexion.php';
    $bd = new BD();

    $conexion = $bd->getConexion();
    
    if($_POST){
       
        $email = $_POST['email'];
        $password = $_POST['password'];
        $_SESSION['password'] = $password;
        $rol = 2;
        $_SESSION['rol'] = $rol;
        $dni = $_POST['dni'];
        $_SESSION['dni'] = $dni;

        if(!isset($conexion)){
            echo "Fallo al conectarse a la base de datos";
        }else{
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $hasheada = isEncrypted($password,$hashed_password);
            if($hasheada){
                $_SESSION['hasheada'] = $hashed_password;

                $usuario = new Usuario($email, $hashed_password,$rol,$dni);
                $insertado = $bd->insertUsuario($usuario);
                
            }else{
                echo "Fallo al insertar el usuario";
            }
            
        }
              
    }

    function isEncrypted($pass,$hashed_password){
        
        if (password_verify($pass,$hashed_password)) {
            return true;
         }else{
            return false;
         }
    }
?>