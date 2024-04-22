<?php
    class HistorialMedico{
        public $idHistorialMedico;
        public $fechaEntrada;
        public $observaciones;
        public $nChip;

        public function __construct($fechaEntrada,$observaciones,$nChip){
           $this->fechaEntrada = $fechaEntrada;
           $this->observaciones = $observaciones;
           $this->nChip = $nChip;
        }

        public function getIdHistorialMedico(){
            return $this->idHistorialMedico;
        }

        public function getFechaEntradaHistorialMedico(){
            return $this->fechaEntrada;
        }

        public function getObservacionesHistorialMedico(){
            return $this->observaciones;
        }

        public function getNChip(){
            return $this->nChip;
        }
    }
?>