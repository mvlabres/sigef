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

            $sql = "INSERT INTO Stock(entryDate, quantity, productId, productCode) 
                    VALUES (CURDATE(), 1, '".$this->stock->getProductId()."', '".$this->stock->getProductCode()."')";

            $this->mySqli->query($sql);
            return true;

        }catch(Exception $e){
            return false;
        }
    }

    public function findAll(){

        try{

            $sql = "SELECT Stock.id, entryDate, departureDate, quantity, productId, productCode, Product.description AS product
                    FROM Stock 
                    INNER JOIN Product ON productId = Product.id
                    ORDER BY Product.description ASC";

            $result = $this->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }

    public function writeOffProduct($productCode){

        try{

            $sql = "UPDATE Stock SET departureDate = CURDATE(), quantity = 0
                    WHERE productCode = " . $productCode . " AND quantity > 0
                    LIMIT 1";

            $this->mySqli->query($sql);
            return true;

        }catch(Exception $e){
            return false;
        }
    }
}

?>
