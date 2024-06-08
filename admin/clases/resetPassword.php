<?php
    include_once '../snippets/clases.php';
    include '../bd/conexion.php';
    $bd = new BD();
    $conexion = $bd->getConexion();
 

    if($_POST){
        $email = $_POST['email']; 
        $password = $_POST['pass']; 
        $datos = $bd->getEmailAndPasswordUsuarioByEmail($email);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $hasheada = isEncrypted($password,$hashed_password);
        if($hasheada){
            $_SESSION['hasheada'] = $hashed_password;
            if(count($datos) > 0) {
                $encriptado = isEncrypted($password,$_SESSION['hasheada']);
                $_SESSION['email'] = $datos[0]['email'];  
                $_SESSION['password'] = $password;
                $registrado = ($datos[0]['email'] == $email && $encriptado);
                if($registrado){
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