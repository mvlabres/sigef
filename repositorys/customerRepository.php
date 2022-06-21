<?php

require_once('../controller/connection.php');

class CustomerRepository{
    
    private $customer;
    private $mySqli;

    public function __construct(){
        $connect = new Connection();
        $this->mySqli = $connect->connect(); 
    }

    public function setCustomer($customer){
        $this->customer = $customer;
    }

    public function create(){

        try{

            if(!$this->customer) return null;

            $sql = "INSERT INTO Customer(name, tel, cpf) 
                    VALUES ('".$this->customer->getName()."', '".$this->customer->getTel()."', '".$this->customer->getCpf()."')";

            $this->mySqli->query($sql);
            return true;

        }catch(Exception $e){
            return false;
        }
    }

    public function findByCpf($cpf){

        try{

            $sql = "SELECT id, name, tel, cpf
                    FROM Customer 
                    WHERE cpf = '".$cpf."'";

            $result = $this->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }

    /*public function findLastCreated(){

        try{

            $sql = "SELECT Product.id, Product.description, priceId, size, productFamilyId, Price.id AS priceId, ProductFamily.id AS productFamilyId 
                    FROM Product 
                    INNER JOIN Price ON priceId = Price.Id 
                    INNER JOIN ProductFamily ON productFamilyId = ProductFamily.id 
                    ORDER BY Product.id DESC LIMIT 1";


            $result = $this->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }*/
}

?>
