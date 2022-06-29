<?php

    require_once('../controller/connection.php');

    class RegisterRepository{

        private $register;
        private $mySqli;
        private $INIIAL_REGISTER_VALUE = 250.00;
    
        public function __construct(){
            $connect = new Connection();
            $this->mySqli = $connect->connect(); 
        }
    
        public function setRegister($register){
            $this->register = $register;
        }

        public function findCurrentOpen($status){

            try{
    
                $sql = "SELECT id, status, totalPayments, openDate, closeDate, initialValue
                        FROM Register 
                        WHERE status = '".$status."'";
    
                $result = $this->mySqli->query($sql);
                return $result;
    
            }catch(Exception $e){
                return false;
            }
        }

        public function findById($id){

            try{
    
                $sql = "SELECT id, status, totalPayments, openDate, closeDate, initialValue
                        FROM Register 
                        WHERE id = ".$id;
    
                $result = $this->mySqli->query($sql);
                return $result;
    
            }catch(Exception $e){
                return false;
            }
        }

        public function findAll(){

            try{
    
                $sql = "SELECT id, status, totalPayments, openDate, closeDate, initialValue
                        FROM Register 
                        ORDER BY openDate DESC";
    
                $result = $this->mySqli->query($sql);
                return $result;
    
            }catch(Exception $e){
                return false;
            }
        }

        public function createOpen(){

            try{
    
                $sql = "INSERT INTO register(status, openDate, initialValue) 
                        VALUES ('open', CURDATE(), ". $this->INIIAL_REGISTER_VALUE .")";
    
                $this->mySqli->query($sql);
                return $this->mySqli->insert_id;
    
            }catch(Exception $e){
                return false;
            }
        }

        public function close($id){

            try{
    
                $sql = "UPDATE Register SET status = 'close', closeDate = CURDATE()
                        WHERE id = ".$id;
    
                $this->mySqli->query($sql);
                return true;
    
            }catch(Exception $e){
                return false;
            }
        }
    }
?>