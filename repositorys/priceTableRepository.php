<?php

include_once('../controller/connection.php');

class PriceTableRepository{
    
    private $priceTable;
    public $mySqli;

    public function __construct(){
        $connect = new Connection();
        $this->mySqli = $connect->connect(); 
    }

    public function setPriceTable($priceTable){
        $this->priceTable = $priceTable;
    }

    public function findAll(){

        try{

            $sql = "SELECT id, costPrice, unitCost, variableCost, fixedCost, totalCost, finalPrice, markup, profitMargin 
                    FROM Price ORDER BY costPrice ASC";

            $result = $this->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }

    public function create(){

        try{

            if(!$this->priceTable) return null;

            $sql = "INSERT INTO Price(costPrice, unitCost, variableCost, fixedCost, totalCost, finalPrice, markup, profitMargin) 
                    VALUES (".$this->priceTable->getCostPrice().", ".$this->priceTable->getUnitCost().", ".$this->priceTable->getVariableCost().", ".$this->priceTable->getFixedCost().", ".$this->priceTable->getTotalCost().", ".$this->priceTable->getFinalPrice().", ".$this->priceTable->getMarkup().", ".$this->priceTable->getProfitMargin().")";

            $this->mySqli->query($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
?>