<?php

    class Customer{

        private $id;
        private $name;
        private $cpf;
        private $tel;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;
        }

        public function getTel(){
            return $this->tel;
        }

        public function setTel($tel){
            $this->tel = $tel;
        }
    }
?>