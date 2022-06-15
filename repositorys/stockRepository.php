<?php

require_once('../controller/connection.php');

class StockRepository{
    
    private $stock;
    private $mySqli;

    public function __construct(){
        $connect = new Connection();
        $this->mySqli = $connect->connect(); 
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    public function create(){

        try{

            if(!$this->stock) return null;

            $sql = "INSERT INTO Stock(entryDate, quantity, productId) 
                    VALUES (CURDATE(), 1, '".$this->stock->getProductId()."')";

            $this->mySqli->query($sql);
            return true;

        }catch(Exception $e){
            return false;
        }
    }

    public function findAll(){

        try{

            $sql = "SELECT Stock.id, entryDate, departureDate, quantity, productId, Product.description AS product
                    FROM Stock 
                    INNER JOIN Product ON productId = Product.id
                    ORDER BY Product.description ASC";

            $result = $this->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }

    // public function findById($id){

    //     try{

    //         $sql = "SELECT id, description, priceId, size, productFamilyId
    //                 FROM Product
    //                 WHERE id = ".$id;

    //         $result = $this->mySqli->query($sql);
    //         return $result;

    //     }catch(Exception $e){
    //         return false;
    //     }
    // }

    // public function findLastCreated(){

    //     try{

    //         $sql = "SELECT Product.id, Product.description, priceId, size, productFamilyId, Price.id AS priceId, ProductFamily.id AS productFamilyId 
    //                 FROM Product 
    //                 INNER JOIN Price ON priceId = Price.Id 
    //                 INNER JOIN ProductFamily ON productFamilyId = ProductFamily.id 
    //                 ORDER BY Product.id DESC LIMIT 1";


    //         $result = $this->mySqli->query($sql);
    //         return $result;

    //     }catch(Exception $e){
    //         return false;
    //     }
    // }
}

?>
