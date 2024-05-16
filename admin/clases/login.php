<?php
    include_once '../snippets/clases.php';
    include '../bd/conexion.php';
    $bd = new BD();
    $conexion = $bd->getConexion();

    if($_POST){
        $email = $_POST['email'];
        $password = $_POST['password'];        
        $datos = $bd->getEmailAndPasswordUsuarioByEmail($email);
        $dniBd = $bd->getDniByEmailUser($email);
        $_SESSION['dni'] = $dniBd;
        if(count($datos) > 0) {
            $_SESSION['email'] = $datos[0]['email'];  
            $logueado = ($datos[0]['email'] == $email) && (isEncrypted($password,$datos[0]['password']));
            if($logueado){
                if($_SESSION['rol'] == 1){
                    $_SESSION['user'] = "administrador";
                    header("location:../clases/panel/index.php");
                }else{
                    $_SESSION['user'] = "usuario";
                    $_SESSION['logueado'] = true;
                    $token = getToken();
                    header("Location:../secciones/menu_usuario.php?token=$token");
                }
                
            }else{
                $_SESSION['logueado'] = false;
                $_SESSION['loginError']="Error en la autenticación";
            }
        
        }else{
            $_SESSION['loginError'] = "No existe el usuario";
        }
    }

    function isEncrypted($pass,$hashed_password){
            
        if (password_verify($pass,$hashed_password)) {
            return true;
        }else{
            return false;
        }
    }

    function getToken(){
        $longitud=20;
        return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
    }

?>