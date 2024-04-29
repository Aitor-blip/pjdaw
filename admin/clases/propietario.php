<?php
    class Propietario{
        public $dni;
        public $nombre;
        public $apellido;
        public $fechaNacimiento;
        public $ciudad;
        public $tlf;
        public $email;

        public function __construct($dni,$nombre,$apellido,$fechaNacimiento,$ciudad,$tlf,$email){
           $this->dni = $dni;
           $this->nombre = $nombre;
           $this->apellido = $apellido;
           $this->fechaNacimiento =  $fechaNacimiento;
           $this->ciudad = $ciudad;
           $this->tlf = $tlf;
           $this->email = $email;
        }

         function getDniPropietario(){
            return $this->dni;   
         }

         function getNombrePropietario(){
            return $this->nombre;
         }

         function getApellidoPropietario(){
            return $this->apellido;
         }

         function getFechaNacimientoPropietario(){
            return $this->fechaNacimiento;
         }

         function getCiudadPropietario(){
            return $this->ciudad;
         }

         function getTelefonoPropietario(){
            return $this->tlf;
         }

         function getEmailPropietario(){
            return $this->email;
         }
    }
?>