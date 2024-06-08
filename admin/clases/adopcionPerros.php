<?php
    class Adopcion{
        public $nChip;
        public $dniPropietario;
        public $fechaAdopcion;

        public function __construct($nChip,$dniPropietario,$fechaAdopcion){
           $this->nChip = $nChip;
           $this->dniPropietario = $dniPropietario;
           $this->fechaAdopcion = $fechaAdopcion;
        }

        public function getNChipAdopcionPerros(){
            return $this->nChip;
        }

        public function getDniPropietarioAdopcionPerros(){
            return $this->dniPropietario;
        }

        public function getFechaAdopcionPerros(){
            return $this->fechaAdopcion;
        }
    }
?>