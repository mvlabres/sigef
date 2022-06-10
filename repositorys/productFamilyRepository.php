<?php

require('../controller/connection.php');

class ProductFamilyRepository{
    
        private $productFamily;
        public $mySqli;

        public function __construct(){
            $connect = new Connection();
            $this->mySqli = $connect->connect(); 
        }

        public function setProductFamily($productFamily){
            $this->productFamily = $productFamily;
        }

        public function findAll(){

            try{

                $sql = "SELECT id, description FROM ProductFamily ORDER BY description ASC";

                $result = $this->mySqli->query($sql);
                return $result;

            }catch(Exception $e){
                return false;
            }
        }

        public function create(){

            try{

                if(!$this->productFamily) return null;

                $sql = "INSERT INTO ProductFamily(description) VALUES ('".$this->productFamily->getDescription()."')";

                $this->mySqli->query($sql);
                return true;
            }catch(Exception $e){
                return false;
            }
        }
    }
?>