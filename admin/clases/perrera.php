<?php
    class Perrera{
        public $idPerrera;
        public $nombrePerrera;
        public $nPerros;
        public $ubicacion;
        public $valoracion;

        public function __construct($nombrePerrera,$nPerros,$ubicacion,$valoracion){
           $this->nombrePerrera = $nombrePerrera;
           $this->nPerros = $nPerros;
           $this->ubicacion = $ubicacion;
           $this->valoracion = $valoracion;
        }

         function getIdPerrera(){
            return $this->idPerrera;   
         }

         function getNombrePerrera(){
            return $this->nombrePerrera;
         }

         function getNPerros(){
            return $this->nPerros;
         }

         function getUbicacion(){
            return $this->ubicacion;
         }

         function getValoracion(){
            return $this->valoracion;
         }
    }
?>