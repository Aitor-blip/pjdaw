<?php
    class Usuario{
        public $email;
        public $password;
        public $idRol;
        public $dni;

        public function __construct($email,$password,$idRol,$dni){
            $this->email = $email;
            $this->password = $password;
            $this->idRol = $idRol;
            $this->dni = $dni;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getIdRol(){
            return $this->idRol;
        }

        public function getDni(){
            return $this->dni;
        }
    }

?>