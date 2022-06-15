 
<?php
 
class Stock{

    private $id;
    private $entryDate;
    private $departureDate;
    private $quantity;
    private $productId;
    private $productDescription;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setEntryDate($entryDate){
        $this->entryDate = $entryDate;
    }

    public function getEntryDate(){
        return $this->entryDate;
    }

    public function setDepartureDate($departureDate){
        $this->departureDate = $departureDate;
    }

    public function getDepartureDate(){
        return $this->departureDate;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setProductId($productId){
        $this->productId = $productId;
    }

    public function getProductId(){
        return $this->productId;
    }

    public function setProductDescription($productDescription){
        $this->productDescription = $productDescription;
    }

    public function getProductDescription(){
        return $this->productDescription;
    }
}

?>