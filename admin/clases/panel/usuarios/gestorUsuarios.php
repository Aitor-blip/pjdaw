<?php
 @include_once '../../../bd/conexion.php';
 @include_once '../../../clases/usuario.php';
 $bd = new BD();

 if($_POST){
    @$email = $_POST['email'];
    @$password = $_POST['passsword'];
    @$accion = $_POST['accion'];
    @$dni = $_POST['dni'];
    @$rolUsuario = $_POST['rol'];
    @$idUsuario = $_POST['idUsuario'];
    @$dniOld = $bd->getDniByEmailUser($email);

 switch($accion){
     case 'Agregar':
            //$_SESSION['password'] = $password;
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $hasheada = isEncrypted($password,$hashed_password);
            if($hasheada){
               // $_SESSION['hasheada'] = $hashed_password;
                $usuario = new Usuario($email, $hashed_password,$rolUsuario,$dni);
                $usuarioInsertado = $bd->insertUsuario($usuario);
                
            }else{
                echo "Fallo al insertar el usuario";
            }
     break;
     case 'Modificar':
            
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $hasheada = isEncrypted($password,$hashed_password);
            if($hasheada){
                $_SESSION['password'] = $password;
                $_SESSION['hasheada'] = $hashed_password;
                $usuario = new Usuario($email, $hashed_password,$rolUsuario,$dni);
                //echo $hashed_password;
                $usuarioModificado = $bd->updateUsuario($usuario,$idUsuario);
                
            }else{
                echo "Fallo al modificar el usuario";
            }
         break;
     case 'Eliminar':
         $bd->deleteUsuario($idUsuario,$dni);
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
?>