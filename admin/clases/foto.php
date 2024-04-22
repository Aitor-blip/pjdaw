<?php
    class Foto{
        public $idFoto;
        public $rutaFoto;
        public $descripcionFoto;

        public function __construct($idFoto,$rutaFoto,$descripcionFoto){
           $this->idFoto = $idFoto;
           $this->rutaFoto = $rutaFoto;
           $this->descripcionFoto = $descripcionFoto;
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