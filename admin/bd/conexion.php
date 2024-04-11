<?php
    include_once './variables_bd.php';
     class BD{
        public static $instancia=null;
        public static function crearInstancia(){
            if(!isset(self::$instancia)){
                //Activamos el control de errores de la bd 
                $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                //self::$instancia = new PDO('mysql:host='.SERVER.';dbname=perros;','root','aitor2002',$opciones);
                self::$instancia = new PDO('mysql:host=localhost;dbname=perros;','root','aitor2002',$opciones);
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


    }
?>