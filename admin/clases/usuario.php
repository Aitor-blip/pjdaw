<?php
    class Usuario{
        public $email;
        public $password;
        public $idRol;

        public function __construct($email,$password,$idRol){
            $this->email = $email;
            $this->password = $password;
            $this->idRol = $idRol;
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
    }

?>