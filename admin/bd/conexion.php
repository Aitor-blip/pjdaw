<?php
     @include_once '../snippets/clases.php';
     class BD{
        public  $instancia=null;
        public  $messageError = "";
        public $conexion = "";

        public function __construct(){
            $this->conexion = new PDO('mysql:host=localhost;dbname=perros;','root','');
        }

        public function getConexion(){
            return $this->conexion;
        }
        public  function crearInstancia(){
            if(!isset($this->conexion)){
                //Activamos el control de errores de la bd 
                //$this->conexion = new PDO('mysql:host='.SERVER.';dbname=perros;','root','aitor2002',$opciones);
                $this->conexion = new PDO('mysql:host=localhost;dbname=perros;','root','');
                //echo "<p class='subtitle'>Conexión a base de datos realizada</p>";
                
            }
        }



        public  function consultar($sql){
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();            
        }


        /*Perro */

        public  function getPerroByNchip($nchip){
            $sql = "select * from perro where nchip = '$nchip'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        public  function getPerrosSinAdoptar(){
            $sql="SELECT * FROM PERRO WHERE nChip IN(SELECT NCHIP FROM ADOPCION_PERROS)";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getPerrosParaAdoptar($dni){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE dniPropietario = '$dni'";
            
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getPerrosByPropietario($dni){
           $sql = "SELECT dniPropietario,nChip from adopcion_perros 
           where dniPropietario = '$dni'";
          // echo $sql;
           $consulta = $this->conexion->prepare($sql);
           $consulta->execute();
           return $consulta->fetchAll(); 
        }

        public function insertPerro($nchip,$perro,$foto,$propietario){
            //Datos perro
            $idRaza = $perro->getIdRaza();
            $idPerrera = $perro->getIdPerrera();
            $nombrePerro = $perro->getNombrePerro();
            $fechaNacimiento = $perro->getFechaNacimiento();
            $fechaEntrada = $perro->getFechaEntrada();
            $peso = $perro->getPeso();

            $ruta = $foto->getRutaFoto();

            $dni = $propietario->getDniPropietario();

            $sql1 = "INSERT INTO PERRO(nChip,nombrePerro,fechaNacimiento,fechaEntrada,idperrera,peso,idRaza)
             VALUES(:nChip,:nombrePerro,:fNac,:fEntr,:idPerrera,:peso,:idRaza)";

             $sql2 = "INSERT INTO FOTO (ruta,nchip) values (:ruta,:nchip)";

             $sql3 = "INSERT INTO PROPIETARIO (dniPropietario) VALUES (:dni)";

             $sql4 = "INSERT INTO ADOPCION_PERROS (nChip,dniPropietario) VALUES (:nchip,:dni)";


            try{
                $this->conexion->beginTransaction();

                $consulta =$this->conexion->prepare($sql1);
                $consulta->bindParam(":nChip",$nchip);
                $consulta->bindParam(":nombrePerro",$nombrePerro);
                $consulta->bindParam(":fNac",$fechaNacimiento);
                $consulta->bindParam(":fEntr",$fechaEntrada);
                $consulta->bindParam(":idPerrera",$idPerrera);
                $consulta->bindParam(":peso",$peso);
                $consulta->bindParam(":idRaza",$idRaza);
                $consulta->execute();


                $consulta =$this->conexion->prepare($sql2);
                $consulta->bindParam(":ruta",$ruta);
                $consulta->bindParam(":nchip",$nchip);
                $consulta->execute();

                $consulta =$this->conexion->prepare($sql3);
                $consulta->bindParam(":dni",$dni);
                $consulta->execute();

                $consulta =$this->conexion->prepare($sql4);
                $consulta->bindParam(":nchip",$nchip);
                $consulta->bindParam(":dni",$dni);
                $consulta->execute();


                $this->conexion->commit();

                return true;
            }catch(PDOException $e){
                return false;
                $this->conexion->rollBack();
                echo $e->getMessage();
            }



        }
    


        public  function updatePerro($perro){

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
                $consulta = $this->conexion->prepare($sql);
                
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

        public  function deletePerro($nChip){

            try {
            $sql="DELETE FROM PERRO WHERE nChip = :nChip"; 
            $consulta = $this->conexion->prepare($sql);
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
          
          public  function getPropietarios(){
            $sql="SELECT * FROM PROPIETARIOS";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getPropietarioByDni($dni){
            $sql="SELECT * FROM PROPIETARIO WHERE dniPropietario = '$dni'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getPropietarioByNombre($nombre){
            $sql="SELECT * FROM PROPIETARIO WHERE nombre = '$nombre'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function insertPropietario($propietario){

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

                $consulta = $this->conexion->prepare($sql);
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


        public  function updatePropietario($propietario ){

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
                $consulta = $this->conexion->prepare($sql);
                
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

        public  function deletePropietario($dni){

            try {
            $sql="DELETE FROM PROPIETARIO WHERE dnipropietario = :dni"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':dni',$dni);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }



        /*Raza*/
        public  function getRazas(){
            $sql="SELECT * FROM RAZA";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getRazaByNombreRaza($nombre){
            $sql="SELECT * FROM RAZA WHERE nombreRaza = '$nombre'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function getRazaByPerroIdRaza($idRaza){
            $sql = "select raza.nombreRaza,perro.idRaza from perro,raza where perro.idRaza = $idRaza";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_LAZY);
        }

        public  function getRazaByNombreRazaUbicacion($nombre,$ubicacion){
            $sql="SELECT * FROM RAZA WHERE nombreRaza = '$nombre' and ubicacionRaza = '$ubicacion'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function insertRaza($raza){

            try {
                $idRaza = $raza->getIdRaza();
                $nombre = $raza->getNombreRaza();
                $ubicacion = $raza->getUbicacionRaza();

                $sql="INSERT INTO raza (idRaza,nombreRaza,ubicacionRaza) VALUES (:id,:nombre,:ubicacion)";

                $consulta = $this->conexion->prepare($sql);
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


        public  function updateRaza($raza ){

            try {
                $idRaza = $raza->getIdRaza();
                $nombre = $raza->getNombreRaza();
                $ubicacion = $raza->getUbicacionRaza();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update perro set nombreRaza = :nombre,ubicacionRaza =:ubicacion where idRaza =:id";
                $consulta = $this->conexion->prepare($sql);
                
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

        public  function deleteRaza($id){

            try {
            $sql="DELETE FROM RAZA WHERE idRaza = :id"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }


        


        /* Perrera */
        public  function getPerreras(){
            $sql="SELECT * FROM PERRERA";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public  function getPerreraById($id){
            $sql="SELECT * FROM PERRERA WHERE idperrera = $id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getPerreraByNombre($nombre){
            $sql="SELECT * FROM PERRERA WHERE 
            nombrePerrera = '$nombre'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function insertPerrera($perrera){

            try {
                $idPerrera = $perrera->getIdPerrera();
                $nombrePerrera = $perrera->getNombrePerrera();
                $nPerrosPerrera = $perrera->getNPerros();
                $ubicacionPerrera = $perrera->getUbicacion();
                $valoracionPerrera = $perrera->getValoracion();

                $sql="INSERT INTO perrera (idperrera,nombrePerrera,nPerros,ubicacion,valoracion)
                 VALUES (:id,:nombre,:nperros,:ubicacion,:valoracion)";

                $consulta = $this->conexion->prepare($sql);
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


        public  function updatePerrera($perrera ){

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
                $consulta = $this->conexion->prepare($sql);
                
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

        public  function deletePerrera($id){

            try {
            $sql="DELETE FROM PERRERA WHERE idperrera = :id"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }


        /*Historial Médico */

         public  function getHistorialesMedicos(){
            $sql="SELECT * FROM HISTORIAL_MEDICO";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public  function getHistorialesMedicosById($id){
            $sql="SELECT * FROM HISTORIAL_MEDICO WHERE idHistorialMedico = $id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getHistorialesMedicosByFechaEntrada($fecha){
            $sql="SELECT * FROM HISTORIAL_MEDICO WHERE 
            fechaEntrada = '$fecha'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function insertHistorialMedico($historialMedico){

            try {
                $idHistorialMedico = $historialMedico->getIdHistorialMedico();
                $fechaEntradaHistorialMedico = $historialMedico->getFechaEntradaHistorialMedico();
                $observacionesHistorialMedico = $historialMedico->getObservacionesHistorialMedico();
                $nChipHistorialMedico = $historialMedico->getNChipHistorialMedico();

                $sql="INSERT INTO historial_medico (idHistorialMedico,fechaEntrada,observaciones,nChip)
                 VALUES (:id,:fecha,:observaciones,:nchip)";

                $consulta = $this->conexion->prepare($sql);
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


        public  function updateHistorialMedico($historialMedico ){

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
                $consulta = $this->conexion->prepare($sql);
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

        public  function deleteHistorialMedico($id){

            try {
            $sql="DELETE FROM historial_medico WHERE idHistorialMedico = :id"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }

        /*Foto */
        public  function getFotos(){
            $sql="SELECT * FROM FOTO";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public  function getFotosById($id){
            $sql="SELECT * FROM FOTO WHERE idFoto = $id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getFotosByNchip($nchip){
            $sql="SELECT ruta FROM FOTO WHERE nChip = '$nchip'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(); 
        }

        public  function getFotoByRuta($ruta){
            $sql="SELECT * FROM FOTO WHERE 
            ruta = '$ruta'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function insertFoto($foto){

            try {
                $idFoto = $foto->getIdFoto();
                $rutaFoto = $foto->getRutaFoto();
                $descripcionFoto = $foto->getDescripcionFoto();

                $sql="INSERT INTO foto (idFoto,ruta,descripcion)
                 VALUES (:id,:ruta,:descripcion)";

                $consulta = $this->conexion->prepare($sql);
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


        public  function updateFoto($foto){

            try {
                $idFoto = $foto->getIdFoto();
                $rutaFoto = $foto->getRutaFoto();
                $descripcionFoto = $foto->getDescripcionFoto();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update foto set ruta =:ruta,
                       descripcion=:nchip
                       where idFoto = :id";
                $consulta = $this->conexion->prepare($sql);
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

        public  function deleteFoto($id){

            try {
            $sql="DELETE FROM foto WHERE idFoto = :id"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }


        /*Adopcion Perros*/

        public  function getAdopcionPerros(){
            $sql="SELECT * FROM ADOPCION_PERROS";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public  function getAdopcionPerrosByNchip($nchip){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE nChip = '$nchip'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getAdopcionPerrosByDniPropietario($dni){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE dniPropietario = '$dni'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getAdopcionPerrosByDniPropietarioAndNChip($nchip,$dni){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE nChip = '$nchip' and 
                                                  dniPropietario = '$dni'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function getAdopcionPerrosByFechaAdopcion($fecha){
            $sql="SELECT * FROM ADOPCION_PERROS WHERE fechaAdopcion = '$fecha'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public  function insertAdopcionPerro($adopcionPerro){

            try {
                $nChipAdopcionPerros = $adopcionPerro->getNChipAdopcionPerros();
                $dniPropietarioAdopcionPerros = $adopcionPerro->getDniPropietarioAdopcionPerros();
                $fechaAdopcionPerros = $adopcionPerro->getFechaAdopcionPerros();

                $sql="INSERT INTO adopcion_perros (nChip,dniPropietario,fechaAdopcion)
                 VALUES (:nchip,:dni,:fecha)";

                $consulta = $this->conexion->prepare($sql);
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


        public  function updateAdopcionPerro($adopcionPerro){

            try {
                $nChipAdopcionPerros = $adopcionPerro->getNChipAdopcionPerros();
                $dniPropietarioAdopcionPerros = $adopcionPerro->getDniPropietarioAdopcionPerros();
                $fechaAdopcionPerros = $adopcionPerro->getFechaAdopcionPerros();

                //idRaza,nombreRaza,ubicacionRaza
                $sql= "update adopcion_perro set dniPropietario =:dni,
                       fechaAdopcion=:fecha
                       where nChip = :nchip";
                $consulta = $this->conexion->prepare($sql);
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

        public  function deleteAdopcionPerro($nchip){

            try {
            $sql="DELETE FROM adopcion_perro WHERE nChip = :nchip"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':nchip',$nchip);
            $consulta->execute();
            return true;

            }catch(PDOException $e){

                $code = $e->getCode();
                return false;
            }

        }

        /*Usuario */
        public function insertUsuario($usuario){

            try {
            $email = $usuario->getEmail();
            $password = $usuario->getPassword();
            $idRol = $usuario->getIdRol();
            
        
           $sql="INSERT INTO usuario (email,password,idRol) VALUES (:email,:pass,:idRol)";

            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':email',$email);
            $consulta->bindParam(':pass',$password);
            $consulta->bindParam(':idRol',$idRol);
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

        public function getEmailAndPasswordUsuarioByEmail($email){
            $sql="SELECT * FROM usuario WHERE email = '$email'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }



    }
?>