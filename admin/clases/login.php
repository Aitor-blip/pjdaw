<?php
    @session_start();
    include_once '../snippets/clases.php';
    include '../bd/conexion.php';
    $bd = new BD();
    $conexion = $bd->getConexion();
 

    if($_POST){
        $email = $_POST['email'];
        $password = $_POST['password']; 
       
        $datos = $bd->getEmailAndPasswordUsuarioByEmail($email);
        $dniBd = $bd->getDniByEmailUser($email);
        
        @$_SESSION['dni'] = $dniBd;
        if(count($datos) > 0) {
            $encriptado = isEncrypted(@$_SESSION['password'],@$_SESSION['hasheada']);
            $_SESSION['email'] = $datos[0]['email'];  
                @$_SESSION['password'] = $password;
                $logueado = ($datos[0]['email'] == $email && $encriptado);
                if($logueado){
                    $idUsuario = $bd->getIdUserByEmail($email);
                    $_SESSION['rol'] = $bd->getIdRolUserByIdUser($idUsuario);
                    if($_SESSION['rol'] == 1){
                        $_SESSION['user'] = "administrador";
                        $_SESSION['logueado'] = true;
                        header("location:../clases/panel/index.php");
                    }else{
                        if($_SESSION['rol'] == 2){
                            $_SESSION['user'] = "usuario";
                            $_SESSION['logueado'] = true;
                            header("Location:../secciones/menu_usuario.php?token=$token");
                        }
                    }
            
           
                
            }else{
                $_SESSION['user'] = "invitado";
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