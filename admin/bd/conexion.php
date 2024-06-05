<?php
     @include_once '../snippets/clases.php';
     @include_once '../clases/perrera.php';
     class BD{
        public  $instancia=null;
        public  $messageError = "";
        public $conexion = "";
        public $errorMessage = "";

        public function __construct(){
            $this->conexion = new PDO('mysql:host=localhost;dbname=perros;','root','aitor2002');
        }

        public function getConexion(){
            return $this->conexion;
        }
        public  function crearInstancia(){
            if(!isset($this->conexion)){
                //Activamos el control de errores de la bd 
                //$this->conexion = new PDO('mysql:host='.SERVER.';dbname=perros;','root','aitor2002',$opciones);
                $this->conexion = new PDO('mysql:host=localhost;dbname=perros;','root','aitor2002');
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

        public function getRazaByPerroIdRaza($idRaza){
            $sql = "select raza.nombreRaza from raza inner JOIN perro on raza.idraza = perro.idRaza where perro.idRaza = $idRaza";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_LAZY)['nombreRaza'];
        }

        

        public  function getPerrosSinAdoptar(){
            $sql = "SELECT * FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip
            where adopcion_perros.adoptado=0 and 
                  adopcion_perros.enTramite=0";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }



        public  function getPerrosSinAdoptarAll(){
            $sql = "SELECT * FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function getPerrosParaAdoptar(){
            $sql = "SELECT perro.nChip,perro.nombrePerro,perro.fechaNacimiento,perro.fechaEntrada,perro.idperrera,perro.peso,perro.idRaza
            FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip where
             adopcion_perros.adoptado=0 and adopcion_perros.enTramite=0";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function getPerrosAdoptados($dni){
            $sql = "SELECT perro.nChip,perro.nombrePerro,perro.fechaNacimiento,perro.fechaEntrada,perro.idperrera,perro.peso,perro.idRaza
            FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip where
             adopcion_perros.adoptado=1 and adopcion_perros.enTramite=0
             and adopcion_perros.dniPropietario = '$dni'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function getPerrosEnTramiteAdopcion(){
            $sql = "SELECT perro.nChip,perro.nombrePerro,perro.fechaNacimiento,perro.fechaEntrada,perro.idperrera,perro.peso,perro.idRaza
            FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip where
             adopcion_perros.entramite=1 and adopcion_perros.adoptado=0";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function isAdoptado(){
            $sql = "SELECT perro.nChip,perro.nombrePerro,perro.fechaNacimiento,perro.fechaEntrada,perro.idperrera,perro.peso,perro.idRaza
            FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip where
             (adopcion_perros.entramite=0 and adopcion_perros.adoptado=1) or 
             (adopcion_perros.entramite=1 and adopcion_perros.adoptado=0) or
             (adopcion_perros.entramite=1 and adopcion_perros.adoptado=1);";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function isAdoptadoDni($dni){
            $sql = "SELECT perro.nChip,perro.nombrePerro,perro.fechaNacimiento,perro.fechaEntrada,perro.idperrera,perro.peso,perro.idRaza
            FROM perro
            INNER JOIN adopcion_perros
            ON perro.nChip = adopcion_perros.nChip where
             (adopcion_perros.entramite=0 and adopcion_perros.adoptado=1) or 
             (adopcion_perros.entramite=1 and adopcion_perros.adoptado=0) or
             (adopcion_perros.entramite=1 and adopcion_perros.adoptado=1)
             and adopcion_perros.dniPropietario = '$dni';";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function existenPerrosConDni($dni){
            $sql = "SELECT dniPropietario 
            FROM propietario
            INNER JOIN adopcion_perros
            ON propietario.dniPropietario = adopcion_perros.dniPropieatario
            where adopcion_perros.dniPropietario='$dni'
            and adopcion_perros.nChip";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }

        public function insertPerro($nchip,$dni,$perro,$foto){

            $adoptado = 0;
            $tramite =0;
            $nombre = $perro->getNombrePerro();
            $fNac = $perro->getFechaNacimiento();
            $fEntr = $perro->getFechaEntrada();
            $idPerrera = $perro->getIdPerrera();
            $peso = $perro->getPeso();
            $idRaza = $perro->getIdRaza();

            $sql1 = "INSERT INTO PERRO (nChip,nombrePerro,fechaNacimiento,fechaEntrada,idperrera,peso,idRaza) VALUES(:nchip,:nombre,:fNac,:fEntr,:idperrera,:peso,:idRaza)";
            $sql2 = "INSERT INTO FOTO (ruta) VALUES (:foto)";
            $sql3 = "INSERT INTO ADOPCION_PERROS (nChip,dniPropietario,fechaAdopcion,adoptado,enTramite) VALUES (:nchip,:dni,:fAdopcion,:adoptado,:tramite)";



            try{

                $this->conexion->beginTransaction();

                $consulta =$this->conexion->prepare($sql1);
                $consulta->bindParam(":nchip",$nchip);
                $consulta->bindParam(":nombre",$nombre);
                $consulta->bindParam(":fNac",$fNac);
                $consulta->bindParam(":fEntr",$fEntr);
                $consulta->bindParam(":idperrera",$idPerrera);
                $consulta->bindParam(":peso",$peso);
                $consulta->bindParam(":idRaza",$idRaza);
                $consulta->execute();

                $consulta = $this->conexion->prepare($sql2);
                $consulta->bindParam(":foto",$foto);
                $consulta->execute();

                $consulta =$this->conexion->prepare($sql3);
                $consulta->bindParam(":nchip",$nchip);
                $consulta->bindParam(":dni",$dni);
                $consulta->bindParam(":fAdopcion",$fEntr);
                $consulta->bindParam(":adoptado",$adoptado);
                $consulta->bindParam(":tramite",$tramite);
                $consulta->execute();


                $this->conexion->commit();

               return true;
            }catch(PDOException $e){

                echo $e->getMessage();
                $this->errorMessage = "Fallo al insertar el perro";
                //echo $e->getMessage();
                switch($e->getCode()){

                }
            }



        }


    


        public  function updatePerro($nchip,$perro,$adoptado,$enTramite=1,$dni,$foto){

                $nombrePerro = $perro->getNombrePerro();
                $fechaNacimiento = $perro->getFechaNacimiento();
                $fechaEntrada = $perro->getFechaEntrada();
                $peso = $perro->getPeso();
                $idPerrera = $perro->getIdPerrera();
                $idRaza = $perro->getIdRaza();

               
                $sql1 = "UPDATE adopcion_perros SET adoptado = :adoptado,enTramite=:tramite  where nChip = :nchip and dniPropietario=:dni";

                $sql2= "update perro set nombrePerro = :nombrePerro,fechaNacimiento = :fechaNacimiento,
                fechaEntrada = :fechaEntrada,peso=:peso,idperrera=:idPerrera,idRaza=:idRaza 
                where nChip = :nChip";

                $sql3 = "update foto set ruta = :ruta where nChip=:nChip";
            try {

                $this->conexion->beginTransaction();


                $consulta = $this->conexion->prepare($sql1);

                $consulta->bindParam(':adoptado',$adoptado);
                $consulta->bindParam(':tramite',$enTramite);
                $consulta->bindParam(':nchip',$nchip);
                $consulta->bindParam(':dni',$dni);   
                $consulta->execute(); 
          
                $consulta = $this->conexion->prepare($sql2);

                $consulta->bindParam(':nombrePerro',$nombrePerro);
                $consulta->bindParam(':fechaNacimiento',$fechaNacimiento);   
                $consulta->bindParam(':fechaEntrada',$fechaEntrada); 
                $consulta->bindParam(':peso',$peso);         
                $consulta->bindParam(':idPerrera',$idPerrera);
                $consulta->bindParam(':idRaza',$idRaza);
                $consulta->bindParam(':nChip',$nchip);
                $consulta->execute();   

                
                $consulta = $this->conexion->prepare($sql3);

                $consulta->bindParam(':ruta',$foto);
                $consulta->bindParam(':nChip',$nchip);  
                $consulta->execute(); 
                
                $this->conexion->commit();

                return true;

                }catch(PDOException $e){
                        echo $e->getMessage();
                    

                    echo $e->getCode();
                    $this->conexion->rollBack();
                    

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            $this->errorMessage = "No se puede actualizar el mismo perro dos veces";
                    }

                    return false;
                }
            

        }

        public  function updatePerroPrincipal($nchip,$perro,$adoptado,$tramite,$dni){

            $nombrePerro = $perro->getNombrePerro();
            $fechaNacimiento = $perro->getFechaNacimiento();
            $fechaEntrada = $perro->getFechaEntrada();
            $peso = $perro->getPeso();
            $idPerrera = $perro->getIdPerrera();
            $idRaza = $perro->getIdRaza();

           
            $sql1 = "UPDATE adopcion_perros SET adoptado=:adoptado,entramite = :tramite where nChip = :nchip and dniPropietario=:dni";

            $sql2= "update perro set nombrePerro = :nombrePerro,fechaNacimiento = :fechaNacimiento,
            fechaEntrada = :fechaEntrada,peso=:peso,idperrera=:idPerrera,idRaza=:idRaza 
            where nChip = :nChip";
        try {

            $this->conexion->beginTransaction();


            $consulta = $this->conexion->prepare($sql2);

            $consulta->bindParam(':nombrePerro',$nombrePerro);
            $consulta->bindParam(':fechaNacimiento',$fechaNacimiento);   
            $consulta->bindParam(':fechaEntrada',$fechaEntrada); 
            $consulta->bindParam(':peso',$peso);         
            $consulta->bindParam(':idPerrera',$idPerrera);
            $consulta->bindParam(':idRaza',$idRaza);
            $consulta->bindParam(':nChip',$nchip);
            $consulta->execute();  

            $consulta = $this->conexion->prepare($sql1);

            $consulta->bindParam(':adoptado',$adoptado);
            $consulta->bindParam(':tramite',$tramite);
            $consulta->bindParam(':nchip',$nchip);
            $consulta->bindParam(':dni',$dni);   
            $consulta->execute(); 


                
            
            
             

            $this->conexion->commit();

            return true;

            }catch(PDOException $e){
                    echo $e->getMessage();
                

                echo $e->getCode();
                $this->conexion->rollBack();
                

                $code = $e->getCode();

                switch($code){
                    case 23000 :
                        $this->errorMessage = "No se puede actualizar el mismo perro dos veces";
                }

                return false;
            }
        

    }


        public  function updatePerroTramiteAdopcion($nchip,$perro,$adoptado,$tramite,$dni){

            $nombrePerro = $perro->getNombrePerro();
            $fechaNacimiento = $perro->getFechaNacimiento();
            $fechaEntrada = $perro->getFechaEntrada();
            $peso = $perro->getPeso();
            $idPerrera = $perro->getIdPerrera();
            $idRaza = $perro->getIdRaza();

           
            $sql1 = "UPDATE adopcion_perros SET adoptado = :adoptado,enTramite=:tramite where nChip = :nchip and dniPropietario=:dni";

            $sql2= "update perro set nombrePerro = :nombrePerro,fechaNacimiento = :fechaNacimiento,
            fechaEntrada = :fechaEntrada,peso=:peso,idperrera=:idPerrera,idRaza=:idRaza 
            where nChip = :nChip";

            $sql3 = "update foto set ruta = :ruta where nChip=:nChip";
        try {

            $this->conexion->beginTransaction();

        
            $consulta = $this->conexion->prepare($sql2);

            $consulta->bindParam(':nombrePerro',$nombrePerro);
            $consulta->bindParam(':fechaNacimiento',$fechaNacimiento);   
            $consulta->bindParam(':fechaEntrada',$fechaEntrada); 
            $consulta->bindParam(':peso',$peso);         
            $consulta->bindParam(':idPerrera',$idPerrera);
            $consulta->bindParam(':idRaza',$idRaza);
            $consulta->bindParam(':nChip',$nchip);
            $consulta->execute();      
            
            
            $consulta = $this->conexion->prepare($sql1);

            $consulta->bindParam(':adoptado',$adoptado);
            $consulta->bindParam(':tramite',$tramite);
            $consulta->bindParam(':nchip',$nchip);
            $consulta->bindParam(':dni',$dni);   
            $consulta->execute();  

            $consulta = $this->conexion->prepare($sql3);

                $consulta->bindParam(':ruta',$foto);
                $consulta->bindParam(':nChip',$nchip);  
                $consulta->execute(); 

            $this->conexion->commit();

            return true;

            }catch(PDOException $e){
                    echo $e->getMessage();
                

                echo $e->getCode();
                $this->conexion->rollBack();
                

                $code = $e->getCode();

                switch($code){
                    case 23000 :
                        $this->errorMessage = "No se puede actualizar el mismo perro dos veces";
                }

                return false;
            }
        

    }


    
    public  function updatePerroDevolver($nchip,$perro,$adoptado,$tramite,$dni){

        $nombrePerro = $perro->getNombrePerro();
        $fechaNacimiento = $perro->getFechaNacimiento();
        $fechaEntrada = $perro->getFechaEntrada();
        $peso = $perro->getPeso();
        $idPerrera = $perro->getIdPerrera();
        $idRaza = $perro->getIdRaza();

       
        $sql1 = "UPDATE adopcion_perros SET adoptado = :adoptado,entramite=:tramite where nChip = :nchip and dniPropietario=:dni";

        $sql2= "update perro set nombrePerro = :nombrePerro,fechaNacimiento = :fechaNacimiento,
        fechaEntrada = :fechaEntrada,peso=:peso,idperrera=:idPerrera,idRaza=:idRaza 
        where nChip = :nChip";
    try {

        $this->conexion->beginTransaction();

    
        $consulta = $this->conexion->prepare($sql2);

        $consulta->bindParam(':nombrePerro',$nombrePerro);
        $consulta->bindParam(':fechaNacimiento',$fechaNacimiento);   
        $consulta->bindParam(':fechaEntrada',$fechaEntrada); 
        $consulta->bindParam(':peso',$peso);         
        $consulta->bindParam(':idPerrera',$idPerrera);
        $consulta->bindParam(':idRaza',$idRaza);
        $consulta->bindParam(':nChip',$nchip);
        $consulta->execute();      
        
        
        $consulta = $this->conexion->prepare($sql1);

        $consulta->bindParam(':adoptado',$adoptado);
        $consulta->bindParam(':tramite',$tramite);
        $consulta->bindParam(':nchip',$nchip);
        $consulta->bindParam(':dni',$dni);   
        $consulta->execute();  

        $this->conexion->commit();

        return true;

        }catch(PDOException $e){
                echo $e->getMessage();
            

            echo $e->getCode();
            $this->conexion->rollBack();
            

            $code = $e->getCode();

            switch($code){
                case 23000 :
                    $this->errorMessage = "No se puede actualizar el mismo perro dos veces";
            }

            return false;
        }
    

}


        public  function deletePerro($nChip){

            $sql1="DELETE FROM PERRO WHERE nChip = :nChip";
            $sql2 = "DELETE FROM FOTO WHERE nChip = :nChip";
            $sql3 = "DELETE FROM ADOPCION_PERROS WHERE nChip=:nChip"; 


            try {

                $this->conexion->beginTransaction();
            
                $consulta = $this->conexion->prepare($sql3);
                $consulta->bindParam(':nChip',$nChip);
                $consulta->execute();


                $consulta = $this->conexion->prepare($sql2);
                $consulta->bindParam(':nChip',$nChip);
                $consulta->execute();
                
                $consulta = $this->conexion->prepare($sql1);
                $consulta->bindParam(':nChip',$nChip);
                $consulta->execute();

                


                $this->conexion->commit();
                return true;

            }catch(PDOException $e){

                $this->conexion->rollBack();

                //echo $e->getMessage();

                $code = $e->getCode();

                switch($code){
                    case 23000 :
                        $this->errorMessage = "No se puede borrar el perro";
                }

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
                        $this->errorMessage = "No se puede insertar el mismo perro dos veces";
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
                            $this->errorMessage = "No se puede actualizar la misma raza dos veces";
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
                        $this->errorMessage = "No se puede insertar el mismo perro dos veces";
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
                            $this->errorMessage = "No se puede actualizar la misma raza dos veces";
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

        public  function getPerrerasById($id){
            $sql="SELECT * FROM PERRERA where idperrera = $id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(); 
        }
        
        public  function getPerreraById($id){
            $sql="SELECT nombrePerrera FROM PERRERA WHERE idperrera = $id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_LAZY)['nombrePerrera'];
        }

        public  function getPerreraByIdPerro($id){
            $sql="SELECT * FROM PERRERA WHERE idperrera = $id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_LAZY)['nombrePerrera']; 
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
                $nombrePerrera = $perrera->getNombrePerrera();
                $nPerrosPerrera = $perrera->getNPerros();
                $ubicacionPerrera = $perrera->getUbicacion();
                $valoracionPerrera = $perrera->getValoracion();

                $sql="INSERT INTO perrera (nombrePerrera,nPerros,ubicacion,valoracion)
                 VALUES (:nombre,:nperros,:ubicacion,:valoracion)";

                $consulta = $this->conexion->prepare($sql);
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
                        $this->errorMessage = "No se puede insertar el mismo perro dos veces";
                }

                return false;
            }

        }


        public  function updatePerrera($perrera,$id){

            $nombrePerrera = $perrera->getNombrePerrera();
            $nPerrosPerrera = $perrera->getNPerros();
            $ubicacionPerrera = $perrera->getUbicacion();
            $valoracionPerrera = $perrera->getValoracion();

            try {


                $sql= "update perrera set nombrePerrera=:nombre,
                                      nPerros=:nperros,
                                      ubicacion=:ubicacion,
                                      valoracion=:valoracion
                                      where idperrera=:id";
                $consulta = $this->conexion->prepare($sql);
                
                $consulta->bindParam(':nombre',$nombrePerrera);
                $consulta->bindParam(':nperros',$nPerrosPerrera);
                $consulta->bindParam(':ubicacion',$ubicacionPerrera);
                $consulta->bindParam(':valoracion',$valoracionPerrera);
                $consulta->bindParam(':id',$id);
                $consulta->execute();

                return true;

                }catch(PDOException $e){

                    echo $e->getMessage();

                    $code = $e->getCode();

                    switch($code){
                        case 23000 :
                            $this->errorMessage = "No se puede actualizar la misma raza dos veces";
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
                        $this->errorMessage = "No se puede insertar el mismo perro dos veces";
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
                            $this->errorMessage = "No se puede actualizar la misma raza dos veces";
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
                        $this->errorMessage = "No se puede insertar el mismo perro dos veces";
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
                            $this->errorMessage = "No se puede actualizar la misma raza dos veces";
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

        public  function getFotoByNChip($nchip){
            $sql="SELECT ruta FROM FOTO WHERE nChip = '$nchip'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_LAZY)['ruta'];
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

        public  function insertAdopcionPerro($adopcionPerro,$adoptado,$tramite){

            try {
                $nChipAdopcionPerros = $adopcionPerro->getNChipAdopcionPerros();
                $dniPropietarioAdopcionPerros = $adopcionPerro->getDniPropietarioAdopcionPerros();
                $fechaAdopcionPerros = $adopcionPerro->getFechaAdopcionPerros();

                $sql="INSERT INTO adopcion_perros (nChip,dniPropietario,fechaAdopcion,adoptado,enTramite)
                 VALUES (:nchip,:dni,:fecha,:adoptado,:tramite)";

                $consulta = $this->conexion->prepare($sql);
                $consulta->bindParam(':nchip',$nChipAdopcionPerros);
                $consulta->bindParam(':dni',$dniPropietarioAdopcionPerros);
                $consulta->bindParam(':fecha',$fechaAdopcionPerros);
                $consulta->bindParam(':adoptado',$adoptado);
                $consulta->bindParam(':tramite',$tramite);
                $consulta->execute();
                return true;

            }catch(PDOException $e){


                echo $e->getMessage();

                $code = $e->getCode();

                switch($code){
                    case 23000 :
                        $this->errorMessage = "No se puede insertar el mismo perro dos veces";
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
                            $this->errorMessage = "No se puede actualizar la misma raza dos veces";
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

            $email = $usuario->getEmail();
            $password = $usuario->getPassword();
            $idRol = $usuario->getIdRol();
            $dni = $usuario->getDni();
            
        
           $sql1="INSERT INTO usuario (email,password,dni,idRol) VALUES (:email,:pass,:dni,:idRol)";
           $sql2 = "INSERT INTO propietario (dniPropietario,email) VALUES (:dni,:email)";
           try {

               $this->conexion->beginTransaction();

               $consulta = $this->conexion->prepare($sql2);
               $consulta->bindParam(':dni',$dni);
               $consulta->bindParam(":email",$email);
               $consulta->execute();
          
               $consulta = $this->conexion->prepare($sql1);
               $consulta->bindParam(':email',$email);
               $consulta->bindParam(':pass',$password);
               $consulta->bindParam(':dni',$dni);
               $consulta->bindParam(':idRol',$idRol);
               $consulta->execute();

               $this->conexion->commit();

               return true;

           }catch(PDOException $e){

               $code = $e->getCode();
               
               switch($code){
                   case 23000 :
                        $this->errorMessage = "No se puede repetir el dni del usuario";
                    break;
            return false;
        }
         

        }
    }



    public function updateUsuario($usuario,$id){

        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $idRol = $usuario->getIdRol();
        $dni = $usuario->getDni();
        
    
       $sql1="UPDATE usuario set email =:email,
                    password =:password,
                    dni=:dni,
                    idRol =:idRol
                    where idUsuario = :id";
       $sql2 = "UPDATE propietario set email =:email
                        where dniPropietario =:dni";
       try {

           $this->conexion->beginTransaction();

          

           $consulta = $this->conexion->prepare($sql2);
           $consulta->bindParam(":email",$email);
           $consulta->bindParam(':dni',$dni);
           $consulta->execute();

           $consulta = $this->conexion->prepare($sql1);
           $consulta->bindParam(':email',$email);
           $consulta->bindParam(':password',$password);
           $consulta->bindParam(':dni',$dni);
           $consulta->bindParam(':idRol',$idRol);
           $consulta->bindParam(':id',$id);
           $consulta->execute();
          

           $this->conexion->commit();

           return true;

       }catch(PDOException $e){

        echo $e->getMessage();

           $code = $e->getCode();

           

           switch($code){
               case 23000 :
                    $this->errorMessage = "No se puede repetir el dni del usuario";
                break;
        return false;
    }
     

    }
}




    public  function deleteUsuario($id,$dni){
            $sql="DELETE FROM usuario WHERE idUsuario = :id"; 
            $sql2 = "DELETE FROM PROPIETARIO WHERE dniPropietario = :dni";
        try {

            $this->conexion->beginTransaction();

            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();

            $consulta = $this->conexion->prepare($sql2);
            $consulta->bindParam(':dni',$dni);
            $consulta->execute();

            $this->conexion->commit();
        return true;

        }catch(PDOException $e){

            $this->conexion->rollBack();
           // echo $e->getMessage();

            $code = $e->getCode();
            return false;
        }

    }

    public  function getUserDataByIdUsuario($id){
        try{
        $sql="SELECT * FROM usuario where idUsuario = $id";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(); 
        }catch(PDOException $e){
            $this->errorMessage = "Da a seleccionar para mostrar los datos del usuario";
        }
    }

    public function getIdUserByEmail($email){
        $sql="SELECT idUsuario FROM usuario WHERE email = '$email'";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_LAZY);
        return @$data['idUsuario'];
    }

    public function getIdRolUserByIdUser($id){
        $sql="SELECT idRol FROM usuario WHERE idUsuario = $id";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_LAZY);
        return @$data['idRol'];
    }


    public function getRolByIdRol($id){
        $sql="SELECT nombre FROM usuario_rol WHERE idRol = $id";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_LAZY);
        return @$data['nombre'];
    }


        public function getEmailAndPasswordUsuarioByEmail($email){
            $sql="SELECT * FROM usuario WHERE email = '$email'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        public function getDniByEmailUser($email){
            $sql="SELECT dni FROM usuario WHERE email = '$email'";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_LAZY);
            return @$data['dni'];
        }

        
       



        public function updateRolUser($email,$rol){
            try{
                $sql= "update usuario set idRol =:rol
                       where email = :email";
                $consulta = $this->conexion->prepare($sql);
                $consulta->bindParam(':rol',$rol);
                $consulta->bindParam(':email',$email);
                $consulta->execute();

                return true;

            }catch(PDOException $e){
                return false;
            }
        }

    }
?>