<?php

require_once('../controller/connection.php');

class CardFeeRepository{
    
    private $mySqli;

    public function __construct(){
        $connect = new Connection();
        $this->mySqli = $connect->connect(); 
    }

    public function findAll(){

        try{

            $sql = "SELECT id, installmentNumber, fee, applicableFee
                    FROM CardFee 
                    WHERE Fee > 0
                    ORDER BY installmentNumber ASC";

            $result = $this->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }
}

?>