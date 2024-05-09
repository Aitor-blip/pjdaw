<?php
    class Perro{
        public $nChip;
        public $nombrePerro;
        public $fechaNacimiento;
        public $fechaEntrada;
        public $peso;
        public $idPerrera;
        public $idRaza;
        public $idFoto;
        public $dniPropietario;
        
        public function __construct($nChip,$nombrePerro,$fechaNacimiento,$fechaEntrada,$peso,
                                    $idPerrera,$idRaza){
           $this->nChip = $nChip;
           $this->nombrePerro = $nombrePerro;
           $this->fechaNacimiento = $fechaNacimiento;
           $this->fechaEntrada = $fechaEntrada;
           $this->peso = $peso;
           $this->idPerrera = $idPerrera;
           $this->idRaza = $idRaza;
        }
        



        function getNchip(){
           return $this->nChip;   
        }
        function getNombrePerro(){
            return $this->nombrePerro;
        }

        function getFechaNacimiento(){
            return $this->fechaNacimiento; 
         }

         function getFechaEntrada(){
            return $this->fechaEntrada;   
         }

         function getIdPerrera(){
            return $this->idPerrera;   
         }

         function getIdRaza(){
            return $this->idRaza;   
         }

         function getIdFoto(){
            return $this->idFoto;   
         }

         function getPeso(){
            return $this->peso;
         }

         function getDniPropietario(){
            return $this->dniPropietario;   
         }
    }
?>