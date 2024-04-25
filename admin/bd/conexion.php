<?php
     @include_once '../snippets/clases.php';
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


        /*Perro */

        public static function getPerroByNchip($nchip){
            $sql = "select * from perro where nchip = '$nchip'";
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

        public static function getPerrosByPropietario($dni){
           $sql = "SELECT dniPropietario,nChip from adopcion_perros 
           where dniPropietario = '$dni'";
          // echo $sql;
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

          /*Propietario*/
          
          public static function getPropietarios(){
            $sql="SELECT * FROM PROPIETARIOS";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getPropietarioByDni($dni){
            $sql="SELECT * FROM PROPIETARIO WHERE dniPropietario = '$dni'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getPropietarioByNombre($nombre){
            $sql="SELECT * FROM PROPIETARIO WHERE nombre = '$nombre'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertPropietario($propietario){

            try {
                $dni = $propietario->getDniPropietario();
                $nombre = $propietario->getNombrePropietario();
                $apellido = $propietario->getApellidoPropietario();
                $fechaNacimiento = $propietario->getFechaNacimientoPropietario();
                $ciudad = $propietario->getCiudadPropietario();
                $tlf = $propietario->getTelefonoPropietario();
                $email = $propietario->getEmailPropietario();

                $sql="INSERT INTO propietario (dniPropietario,nombre,apellido,fechaNacimiento,ciudad,tlf,email)
                 VALUES (:dni,:nombre,:apellido,:fecha,:ciudad,:tlf,:email)";

                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':dni',$dni);
                $consulta->bindParam(':nombre',$nombre);
                $consulta->bindParam(':apellido',$apellido);
                $consulta->bindParam(':fecha',$fechaNacimiento);
                $consulta->bindParam(':ciudad',$ciudad);
                $consulta->bindParam(':tlf',$tlf);
                $consulta->bindParam(':email',$email);
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


        public static function updatePropietario($propietario ){

            try {
                $dni = $propietario->getDniPropietario();
                $nombre = $propietario->getNombrePropietario();
                $apellido = $propietario->getApellidoPropietario();
                $fechaNacimiento = $propietario->getFechaNacimientoPropietario();
                $ciudad = $propietario->getCiudadPropietario();
                $tlf = $propietario->getTelefonoPropietario();
                $email = $propietario->getEmailPropietario();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update perro set nombreRaza = :nombre,
                       apellido =:apellido,
                       fechaNacimiento=:fecha,
                       ciudad =:ciudad,
                       tlf=:tlf,
                       email=:email where dniPropietario =:dni";
                $consulta = self::$instancia->prepare($sql);
                
                $consulta->bindParam(':nombre',$nombre);
                $consulta->bindParam(':apellido',$apellido);
                $consulta->bindParam(':fecha',$fechaNacimiento);
                $consulta->bindParam(':ciudad',$ciudad);
                $consulta->bindParam(':tlf',$tlf);
                $consulta->bindParam(':email',$email);   
                $consulta->bindParam(':dni',$dni);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar la misma raza dos veces";
                    }

                    return false;
                }
            

        }

        public static function deletePropietario($dni){

            try {
            $sql="DELETE FROM PROPIETARIO WHERE dnipropietario = :dni"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':dni',$dni);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }



        /*Raza*/
        public static function getRazas(){
            $sql="SELECT * FROM RAZA";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getRazaByNombreRaza($nombre){
            $sql="SELECT * FROM RAZA WHERE nombreRaza = '$nombre'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getRazaByNombreRazaUbicacion($nombre,$ubicacion){
            $sql="SELECT * FROM RAZA WHERE nombreRaza = '$nombre' and ubicacionRaza = '$ubicacion'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertRaza($raza){

            try {
                $idRaza = $raza->getIdRaza();
                $nombre = $raza->getNombreRaza();
                $ubicacion = $raza->getUbicacionRaza();

                $sql="INSERT INTO raza (idRaza,nombreRaza,ubicacionRaza) VALUES (:id,:nombre,:ubicacion)";

                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':id',$idRaza);
                $consulta->bindParam(':nombre',$nombre);
                $consulta->bindParam(':ubicacion',$ubicacion);
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


        public static function updateRaza($raza ){

            try {
                $idRaza = $raza->getIdRaza();
                $nombre = $raza->getNombreRaza();
                $ubicacion = $raza->getUbicacionRaza();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update perro set nombreRaza = :nombre,ubicacionRaza =:ubicacion where idRaza =:id";
                $consulta = self::$instancia->prepare($sql);
                
                $consulta->bindParam(':nombre',$nombre);
                $consulta->bindParam(':ubicacion',$ubicacion);   
                $consulta->bindParam(':id',$idRaza);         
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar la misma raza dos veces";
                    }

                    return false;
                }
            

        }

        public static function deleteRaza($id){

            try {
            $sql="DELETE FROM RAZA WHERE idRaza = :id"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }


        


        /* Perrera */
        public static function getPerreras(){
            $sql="SELECT * FROM PERRERA";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public static function getPerreraById($id){
            $sql="SELECT * FROM PROPIETARIO WHERE idperrera = $id";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getPerreraByNombre($nombre){
            $sql="SELECT * FROM PROPIETARIO WHERE 
            nombrePerrera = '$nombre'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertPerrera($perrera){

            try {
                $idPerrera = $perrera->getIdPerrera();
                $nombrePerrera = $perrera->getNombrePerrera();
                $nPerrosPerrera = $perrera->getNPerros();
                $ubicacionPerrera = $perrera->getUbicacion();
                $valoracionPerrera = $perrera->getValoracion();

                $sql="INSERT INTO perrera (idperrera,nombrePerrera,nPerros,ubicacion,valoracion)
                 VALUES (:id,:nombre,:nperros,:ubicacion,:valoracion)";

                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':id',$idPerrera);
                $consulta->bindParam(':nombre',$nombrePerrera);
                $consulta->bindParam(':nperros',$nPerrosPerrera);
                $consulta->bindParam(':ubicacion',$ubicacionPerrera);
                $consulta->bindParam(':valoracion',$valoracionPerrera);
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


        public static function updatePerrera($perrera ){

            try {
                $idPerrera = $perrera->getIdPerrera();
                $nombrePerrera = $perrera->getNombrePerrera();
                $nPerrosPerrera = $perrera->getNPerros();
                $ubicacionPerrera = $perrera->getUbicacion();
                $valoracionPerrera = $perrera->getValoracion();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update perrera set nombrePerrera = :nombre,
                       nPerros =:nperros,
                       ubicacion=:ubicacion,
                       valoracion =:valoracion
                       where idperrera =:id";
                $consulta = self::$instancia->prepare($sql);
                
                $consulta->bindParam(':nombre',$nombrePerrera);
                $consulta->bindParam(':nperros',$nPerrosPerrera);
                $consulta->bindParam(':ubicacion',$ubicacionPerrera);
                $consulta->bindParam(':valoracion',$valoracionPerrera);
                $consulta->bindParam(':id',$idPerrera);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar la misma raza dos veces";
                    }

                    return false;
                }
            

        }

        public static function deletePerrera($id){

            try {
            $sql="DELETE FROM PERRERA WHERE idperrera = :id"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }


        /*Historial Médico */

         public static function getHistorialesMedicos(){
            $sql="SELECT * FROM HISTORIAL_MEDICO";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public static function getHistorialesMedicosById($id){
            $sql="SELECT * FROM HISTORIAL_MEDICO WHERE idHistorialMedico = $id";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getHistorialesMedicosByFechaEntrada($fecha){
            $sql="SELECT * FROM HISTORIAL_MEDICO WHERE 
            fechaEntrada = '$fecha'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertHistorialMedico($historialMedico){

            try {
                $idHistorialMedico = $historialMedico->getIdHistorialMedico();
                $fechaEntradaHistorialMedico = $historialMedico->getFechaEntradaHistorialMedico();
                $observacionesHistorialMedico = $historialMedico->getObservacionesHistorialMedico();
                $nChipHistorialMedico = $historialMedico->getNChipHistorialMedico();

                $sql="INSERT INTO historial_medico (idHistorialMedico,fechaEntrada,observaciones,nChip)
                 VALUES (:id,:fecha,:observaciones,:nchip)";

                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':id',$idHistorialMedico);
                $consulta->bindParam(':fecha',$fechaEntradaHistorialMedico);
                $consulta->bindParam(':observaciones',$observacionesHistorialMedico);
                $consulta->bindParam(':nchip',$nChipHistorialMedico);
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


        public static function updateHistorialMedico($historialMedico ){

            try {
                $idHistorialMedico = $historialMedico->getIdHistorialMedico();
                $fechaEntradaHistorialMedico = $historialMedico->getFechaEntradaHistorialMedico();
                $observacionesHistorialMedico = $historialMedico->getObservacionesHistorialMedico();
                $nChipHistorialMedico = $historialMedico->getNChipHistorialMedico();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update historial_medico set fechaEntrada = :fecha,
                       observaciones =:observaciones,
                       nChip=:nchip
                       where idHistorialMedico =:id";
                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':fecha',$fechaEntradaHistorialMedico);
                $consulta->bindParam(':observaciones',$observacionesHistorialMedico);
                $consulta->bindParam(':nchip',$nChipHistorialMedico);
                $consulta->bindParam(':id',$idHistorialMedico);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar la misma raza dos veces";
                    }

                    return false;
                }
            

        }

        public static function deleteHistorialMedico($id){

            try {
            $sql="DELETE FROM historial_medico WHERE idHistorialMedico = :id"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }

        /*Foto */
        public static function getFotos(){
            $sql="SELECT * FROM FOTO";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public static function getFotosById($id){
            $sql="SELECT * FROM FOTO WHERE idFoto = $id";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getFotosByNchip($nchip){
            $sql="SELECT ruta FROM FOTO WHERE nChip = '$nchip'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(); 
        }

        public static function getFotoByRuta($ruta){
            $sql="SELECT * FROM FOTO WHERE 
            ruta = '$ruta'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertFoto($foto){

            try {
                $idFoto = $foto->getIdFoto();
                $rutaFoto = $foto->getRutaFoto();
                $descripcionFoto = $foto->getDescripcionFoto();

                $sql="INSERT INTO foto (idFoto,ruta,descripcion)
                 VALUES (:id,:ruta,:descripcion)";

                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':id',$idFoto);
                $consulta->bindParam(':ruta',$rutaFoto);
                $consulta->bindParam(':descripcion',$descripcionFoto);
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


        public static function updateFoto($foto){

            try {
                $idFoto = $foto->getIdFoto();
                $rutaFoto = $foto->getRutaFoto();
                $descripcionFoto = $foto->getDescripcionFoto();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update foto set ruta =:ruta,
                       descripcion=:nchip
                       where idFoto = :id";
                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':ruta',$rutaFoto);
                $consulta->bindParam(':descripcion',$descripcionFoto);
                $consulta->bindParam(':id',$idFoto);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar la misma raza dos veces";
                    }

                    return false;
                }
            

        }

        public static function deleteFoto($id){

            try {
            $sql="DELETE FROM foto WHERE idFoto = :id"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }


        /*Adopcion Perros*/

        public static function getAdopcionPerros(){
            $sql="SELECT * FROM ADOPCION_PERROS";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public static function getAdopcionPerrosByNchip($nchip){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE nChip = '$nchip'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getAdopcionPerrosByDniPropietario($dni){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE dniPropietario = '$dni'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getAdopcionPerrosByDniPropietarioAndNChip($nchip,$dni){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE nChip = '$nchip' and 
                                                  dniPropietario = '$dni'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function getAdopcionPerrosByFechaAdopcion($fecha){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE fechaAdopcion = '$fecha'";
            $consulta = self::$instancia->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public static function insertAdopcionPerro($adopcionPerro){

            try {
                $nChipAdopcionPerros = $adopcionPerro->getNChipAdopcionPerros();
                $dniPropietarioAdopcionPerros = $adopcionPerro->getDniPropietarioAdopcionPerros();
                $fechaAdopcionPerros = $adopcionPerro->getFechaAdopcionPerros();

                $sql="INSERT INTO adopcion_perros (nChip,dniPropietario,fechaAdopcion)
                 VALUES (:nchip,:dni,:fecha)";

                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':nchip',$nChipAdopcionPerros);
                $consulta->bindParam(':dni',$dniPropietarioAdopcionPerros);
                $consulta->bindParam(':fecha',$fechaAdopcionPerros);
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


        public static function updateAdopcionPerro($adopcionPerro){

            try {
                $nChipAdopcionPerros = $adopcionPerro->getNChipAdopcionPerros();
                $dniPropietarioAdopcionPerros = $adopcionPerro->getDniPropietarioAdopcionPerros();
                $fechaAdopcionPerros = $adopcionPerro->getFechaAdopcionPerros();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update adopcion_perro set dniPropietario =:dni,
                       fechaAdopcion=:fecha
                       where nChip = :nchip";
                $consulta = self::$instancia->prepare($sql);
                $consulta->bindParam(':dni',$dniPropietarioAdopcionPerros);
                $consulta->bindParam(':fecha',$fechaAdopcionPerros);
                $consulta->bindParam(':nchip',$nChipAdopcionPerros);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            self::$messageError = "No se puede actualizar la misma raza dos veces";
                    }

                    return false;
                }
            

        }

        public static function deleteAdopcionPerro($nchip){

            try {
            $sql="DELETE FROM adopcion_perro WHERE nChip = :nchip"; 
            $consulta = self::$instancia->prepare($sql);
            $consulta->bindParam(':nchip',$nchip);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }




    }
?>