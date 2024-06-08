<?php
    include_once '../snippets/clases.php';
    include '../bd/conexion.php';
    $bd = new BD();
    $conexion = $bd->getConexion();
 

    if($_POST){
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $action = $_POST['accion'];

        switch($action){
            case "Sign In":
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
                            $idRol = $bd->getIdRolUserByIdUser($idUsuario);
                            if($idRol == 1){
                                header("location:../clases/panel/index.php");
                            }else{
                                if($idRol == 2){
                                    header("Location:../secciones/menu_usuario.php");
                                }elseif($idRol == 3){
                                    header("Location:../secciones/menu_usuario.php");
                                }
                            }
                    
                   
                        
                    }

                }
                break;
                case "Reset Password":
                    header("location:../secciones/password_recovery.php");
                    break;

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