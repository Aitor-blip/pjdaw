<?php
     include_once './admin/clases/perro.php';
     class BD{
        public static $instancia=null;
        public static $messageError = "";
        public static function crearInstancia(){
            if(!isset(self::$instancia)){
                //Activamos el control de errores de la bd 
                $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                //self::$instancia = new PDO('mysql:host='.SERVER.';dbname=perros;','root','aitor2002',$opciones);
                self::$instancia = new PDO('mysql:host=localhost;dbname=perros;','root','',$opciones);
                //echo "<p class='subtitle'>Conexión a base de datos realizada</p>";
                
            }
        }

        public static function consultar($sql){
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();            
        }

        public static function getPerrosSinAdoptar(){
            $sql="SELECT * FROM PERRO WHERE nChip NOT IN(SELECT NCHIP FROM ADOPCION_PERROS)";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getPerrosParaAdoptar($dni){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE dniPropietario = '$dni'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertPerro($perro){

            try {
            $nChip = $perro->getNchip();
            $nombrePerro = $perro->getNombrePerro();
            $fechaNacimiento = $perro->getFechaNacimiento();
            $fechaEntrada = $perro->getFechaEntrada();
            $idPerrera = $perro->getIdPerrera();
            $idRaza = $perro->getIdRaza();
            $idFoto = $perro->getIdFoto();
            $dniPropietario = $perro->getDniPropietario();
            
        
           $sql="INSERT INTO perro (nchip,nombrePerro,fechaNacimiento,fechaEntrada,idperrera,idRaza,idFoto,dniPropietario) 
           VALUES (:nChip,:nombrePerro,:fechaNacimiento,:fechaEntrada,:idPerrera,:idRaza,:idFoto,:dniPropietario)";

            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':nChip',$nChip);
            $consulta->bindParam(':nombrePerro',$nombrePerro);
            $consulta->bindParam(':fechaEntrada',$fechaEntrada);
            $consulta->bindParam(':fechaNacimiento',$fechaNacimiento);            
            $consulta->bindParam(':idPerrera',$idPerrera);
            $consulta->bindParam(':idRaza',$idRaza);
            $consulta->bindParam(':idFoto',$idFoto);
            $consulta->bindParam(':dniPropietario',$dniPropietario);
            $consulta->execute();

            return true;

            }catch(PDOException $e){

                $code = $e->getCode();

                switch($code){
                    case 23000 :
                        self::$messageError = "No se puede insertar el mismo perro dos veces";
                }

                return false;
            }

        }


        public static function updatePerro($perro){

            try {
             /*   echo $perro->getNchip()."\n";
                echo $perro->getNombrePerro()."\n";
                echo $perro->getFechaNacimiento()."\n";
                echo $perro->getFechaEntrada()."\n";
                echo $perro->getIdPerrera()."\n";
                echo $perro->getIdRaza()."\n";
                echo $perro->getIdFoto()."\n";
                echo $perro->getDniPropietario()."\n";
               */ 
                $nChip = $perro->getNchip();
                $nombrePerro = $perro->getNombrePerro();
                $fechaNacimiento = $perro->getFechaNacimiento();
                $fechaEntrada = $perro->getFechaEntrada();
                $idPerrera = $perro->getIdPerrera();
                $idRaza = $perro->getIdRaza();
                $idFoto = $perro->getIdFoto();
                $dniPropietario = $perro->getDniPropietario();

                $sql= "update perro set nombrePerro = :nombrePerro,fechaNacimiento = :fechaNacimiento,
                fechaEntrada = :fechaEntrada,idperrera=:idPerrera,idRaza=:idRaza,idFoto=:idFoto,
                dniPropietario = :dniPropietario where nChip = :nChip";
                $consulta = self::$instancia->prepare($sql);
                
                $consulta->bindParam(':nombrePerro',$nombrePerro);
                $consulta->bindParam(':fechaNacimiento',$fechaNacimiento);   
                $consulta->bindParam(':fechaEntrada',$fechaEntrada);         
                $consulta->bindParam(':idPerrera',$idPerrera);
                $consulta->bindParam(':idRaza',$idRaza);
                $consulta->bindParam(':idFoto',$idFoto);
                $consulta->bindParam(':dniPropietario',$dniPropietario);
                $consulta->bindParam(':nChip',$nChip);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar el mismo perro dos veces";
                    }

                    return false;
                }
            

        }

        public static function deletePerro($nChip){

            try {
            $sql="DELETE FROM PERRO WHERE nChip = :nChip"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':nChip',$nChip);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                echo $code;

                /* switch($code){
                    case 23000 :
                        self::$messageError = "No se puede borrar el perro";
                } */

                return false;
            }

        }


    }
?>