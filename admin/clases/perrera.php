<?php
    class Perrera{
        public $idPerrera;
        public $nombrePerrera;
        public $nPerros;
        public $ubicacion;
        public $valoracion;

        public function __construct($idPerrera,$nombrePerrera,$nPerros,$ubicacion,$valoracion){
           $this->idPerrera = $idPerrera;
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

         function getNperros(){
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