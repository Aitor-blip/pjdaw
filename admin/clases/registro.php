<?php
    include '../bd/conexion.php';
    $bd = new BD();

    $conexion = $bd->getConexion();
    
    if($_POST){
       
        $email = $_POST['email'];
        $password = $_POST['password'];
        $idRol = 2;

        if(!isset($conexion)){
            echo "Fallo al conectarse a la base de datos";
        }else{
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $hasheada = isEncrypted($password,$hashed_password);
            if($hasheada){
                $usuario = new Usuario($email, $hashed_password,$idRol);
                $insertado = $bd->insertUsuario($usuario);
                if($insertado){
                    $_SESSION['user'] = "usuario";
                    header("Location:../secciones/login_usuario.php");
                }else{
                    echo "Fallo al insertar el usuario";
                }
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