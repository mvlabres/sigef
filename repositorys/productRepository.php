<?php

// require_once('../controller/connection.php');

class ProductRepository{
    
    private $product;
    private $mySqli;

    public function __construct(){
        $connect = new Connection();
        $this->mySqli = $connect->connect(); 
    }

    public function setProduct($product){
        $this->product = $product;
    }

    public function create(){

        try{

            if(!$this->product) return null;

            $sql = "INSERT INTO Product(description, priceId, size, productFamilyId) 
                    VALUES ('".$this->product->getDescription()."', '".$this->product->getPriceTableId()."', '".$this->product->getSize()."', '".$this->product->getProductFamilyId()."')";

            $this->mySqli->query($sql);
            return true;

        }catch(Exception $e){
            return false;
        }
    }

    public function findLastCreated(){

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
    }
}

?>
