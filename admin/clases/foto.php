<?php
    class Foto{
        public $idFoto;
        public $rutaFoto;
        public $descripcionFoto;

        public function __construct($rutaFoto){
           $this->rutaFoto = $rutaFoto;
        }

        public function getIdFoto(){
            return $this->idFoto;
        }

        public function getRutaFoto(){
            return $this->rutaFoto;
        }

        public function getDescripcionFoto(){
            return $this->descripcionFoto;
        }
    }
?>