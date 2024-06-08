<?php
    class Raza{
        public $idRaza;
        public $nombreRaza;
        public $ubicacion;

        public function __construct($idPerrera,$nombreRaza,$ubicacion){
           $this->idRaza = $idPerrera;
           $this->nombreRaza = $nombreRaza;
           $this->ubicacion = $ubicacion;
        }

        public function getIdRaza(){
            return $this->nombreRaza;
        }

        public function getNombreRaza(){
            return $this->nombreRaza;
        }

        public function getUbicacionRaza(){
            return $this->ubicacion;
        }
    }
?>